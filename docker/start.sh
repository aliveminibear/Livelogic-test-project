#!/bin/sh
set -e
cd /var/www/html

# Ensure .env exists
if [ ! -f .env ]; then
    echo "Creating .env file..."
    cp .env.example .env 2>/dev/null || cat > .env <<'EOF'
APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_TIMEZONE=UTC
APP_URL=http://localhost:12000
DB_CONNECTION=sqlite
DB_DATABASE=/var/www/html/database/database.sqlite
EOF
fi

# Generate APP_KEY only if missing
if ! grep -q "APP_KEY=base64:" .env; then
    echo "Generating APP_KEY..."
    php artisan key:generate --force
fi


if ! grep -q "JWT_SECRET=" .env; then
    echo "Generating JWT_SECRET..."
    php artisan jwt:secret --force
fi

# Ensure database exists
if [ ! -f /var/www/html/database/database.sqlite ]; then
    echo "Creating SQLite database..."
    touch /var/www/html/database/database.sqlite
fi

php artisan migrate --force || echo "Migrations skipped."

php artisan config:clear
php artisan config:cache
php artisan route:clear
php artisan route:cache
php artisan view:clear
php artisan view:cache

echo "Starting Apache..."
exec apache2-foreground
