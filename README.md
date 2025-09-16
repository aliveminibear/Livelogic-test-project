#### Livelogic-test-project ####

A comprehensive Todo and Poll management application built with Laravel 11 and Vue.js 3.


## Features

### Authentication & Security
- **JWT Authentication** - Secure token-based authentication
- **User Registration & Login** - Complete user management system
- **Protected Routes** - API endpoints secured with JWT middleware
- **Session Management** - Automatic token refresh and logout

### Task Management
- **Create Tasks** - Add tasks with title, description, priority, and due dates
- **Task Priorities** - High, Medium, Low priority levels with visual indicators
- **Due Date Tracking** - Set and track task deadlines with overdue notifications
- **Task Completion** - Mark tasks as complete/incomplete with visual feedback
- **Edit & Delete** - Full CRUD operations for task management
- **User-Specific Tasks** - Each user sees only their own tasks

### Poll Creation & Management
- **Create Polls** - Create interactive polls with custom questions and multiple options
- **Dynamic Options** - Add or remove poll options with real-time form updates
- **Unique Poll Links** - Each poll gets a unique slug-based URL for easy sharing
- **Vote Management** - Secure voting system with duplicate vote prevention
- **Real-time Results** - Live poll results with visual progress bars and percentages
- **Poll Analytics** - View total vote counts and percentage breakdowns
- **User Poll Dashboard** - Manage all your created polls in one place
- **Public Voting** - Anyone can vote on polls without requiring registration
- **Vote Tracking** - Prevent duplicate votes using IP address and user ID tracking
- **Responsive Poll Interface** - Beautiful, mobile-friendly poll creation and voting experience

### User Interface
- **Modern Design** - Clean, responsive UI with Tailwind CSS
- **Interactive Components** - Smooth animations and hover effects
- **Task Filtering** - Filter by status, priority, and overdue tasks
- **Modal Editing** - In-place task editing with modal dialogs
- **Visual Priority Indicators** - Color-coded priority levels
- **Responsive Layout** - Works perfectly on desktop and mobile

### Technical Features
- **RESTful API** - Well-structured API endpoints
- **Database Optimization** - Efficient queries with proper indexing
- **Input Validation** - Both client-side and server-side validation
- **Error Handling** - Comprehensive error handling and user feedback
- **Modern Build Tools** - Vite for fast development and building

## Technology Stack

### Backend
- **Laravel 11** - PHP framework
- **JWT Auth** - Token-based authentication
- **SQLite** - Lightweight database (easily switchable to MySQL/PostgreSQL)
- **Eloquent ORM** - Database abstraction layer

### Frontend
- **Vue.js 3** - Progressive JavaScript framework
- **Inertia.js** - Modern monolith approach
- **Tailwind CSS** - Utility-first CSS framework
- **Vite** - Fast build tool and dev server
- **Axios** - HTTP client for API calls

## Prerequisites

- PHP 8.2 or higher
- Composer
- Node.js 18+ and npm
- SQLite (or MySQL/PostgreSQL if preferred)

## Installation Instructions

### 1. Clone the Repository

```bash
git clone <repository-url>
cd todo-app
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install Node.js Dependencies

```bash
npm install
```

### 4. Environment Setup

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Generate JWT secret
php artisan jwt:secret
```

### 5. Database Setup

```bash
# Create database file (SQLite)
touch database/database.sqlite

# Run migrations
php artisan migrate
```

### 6. Build Frontend Assets

```bash
# For development
npm run dev

# For production
npm run build
```

### 7. Start the Application

```bash
# Start Laravel development server
php artisan serve --host=0.0.0.0 --port=12000

# In another terminal, start Vite dev server (for development)
npm run dev
```

The application will be available at:
- **Laravel Backend**: http://localhost:12000
- **Vite Dev Server**: http://localhost:12001 (development only)

## Configuration

### Database Configuration
The application uses SQLite by the default. To use MySQL or PostgreSQL:

1. Update `.env` file:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=todoapp
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

2. Run migrations:
```bash
php artisan migrate
```

### JWT Configuration
JWT settings can be modified in `config/jwt.php`:
- Token TTL (Time To Live)
- Refresh TTL
- Algorithm settings

## API Documentation

### Authentication Endpoints
```
POST /api/auth/register    - User registration
POST /api/auth/login       - User login
POST /api/auth/logout      - User logout
POST /api/auth/refresh     - Refresh JWT token
GET  /api/auth/user-profile - Get user profile
```

### Task Endpoints
```
GET    /api/tasks           - Get all user tasks
POST   /api/tasks           - Create new task
GET    /api/tasks/{id}      - Get specific task
PUT    /api/tasks/{id}      - Update task
DELETE /api/tasks/{id}      - Delete task
POST   /api/tasks/{id}/toggle - Toggle task completion
```

### Poll Endpoints
```
POST   /api/polls           - Create new poll (authenticated)
GET    /api/polls/{poll}    - Get poll details and options
POST   /api/polls/{poll}/vote - Submit vote for poll option
GET    /api/polls/{poll}/results - Get poll results with vote counts
GET    /api/my/polls        - Get user's created polls (authenticated)
```

### Request Examples

#### Register User
```bash
curl -X POST http://localhost:12000/api/auth/register \
  -H "Content-Type: application/json" \
  -d '{
    "name": "",
    "email": "",
    "password": "",
    "password_confirmation": ""
  }'
```

#### Create Task
```bash
curl -X POST http://localhost:12000/api/tasks \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer YOUR_JWT_TOKEN" \
  -d '{
    "title": "Complete project",
    "description": "Finish the todo application",
    "priority": 3,
    "due_date": "2024-12-31"
  }'
```

#### Create Poll
```bash
curl -X POST http://localhost:12000/api/polls \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer YOUR_JWT_TOKEN" \
  -d '{
    "question": "What is your favorite programming language?",
    "options": ["JavaScript", "Python", "PHP", "Java", "C++"]
  }'
```

#### Vote on Poll
```bash
curl -X POST http://localhost:12000/api/polls/1/vote \
  -H "Content-Type: application/json" \
  -d '{
    "poll_option_id": 2
  }'
```

## UI Features

### Dashboard
- Welcome screen with application overview
- Choice between Todo List and Poll Creator
- Clean, modern design with feature highlights
- Quick access to all application features

### Task Management Interface
- **Add Task Form** - Comprehensive form with all task fields
- **Task List** - Beautiful card-based layout with priority indicators
- **Filtering System** - Filter by status, priority, and overdue tasks
- **Edit Modal** - In-place editing without page refresh
- **Visual Feedback** - Loading states, success messages, and error handling

### Poll Management Interface
- **Poll Creation Form** - Dynamic form to create polls with multiple options
- **Option Management** - Add/remove poll options with real-time updates
- **Voting Interface** - Clean, intuitive voting interface with radio buttons
- **Results Visualization** - Beautiful progress bars and percentage displays
- **Poll Dashboard** - Manage all your created polls with quick access links
- **Share Links** - Easy-to-share poll URLs for public voting

### Responsive Design
- Mobile-first approach
- Tablet and desktop optimized layouts
- Touch-friendly interface elements

## Security Features

- **JWT Token Authentication** - Secure, stateless authentication
- **Input Validation** - Server-side validation for all inputs
- **CSRF Protection** - Built-in Laravel CSRF protection
- **SQL Injection Prevention** - Eloquent ORM prevents SQL injection
- **XSS Protection** - Input sanitization and output escaping
- **Authorization Checks** - Users can only access their own tasks

## Testing

### Manual Testing
1. Register a new user account
2. Login with credentials
3. Create tasks with different priorities and due dates
4. Test task completion toggle
5. Edit and delete tasks
6. Test filtering functionality
7. Create polls with multiple options
8. Test voting functionality
9. View poll results and analytics
10. Test logout and re-login

### API Testing with Postman
Import the API endpoints and test all CRUD operations with proper JWT tokens.

## Deployment

### Production Build
```bash
# Build frontend assets
npm run build

# Optimize Laravel
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Environment Variables for Production
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.com

# Database configuration
DB_CONNECTION=mysql
DB_HOST=your-db-host
DB_DATABASE=your-db-name
DB_USERNAME=your-db-user
DB_PASSWORD=your-db-password

# JWT Secret (generate new one)
JWT_SECRET=your-production-jwt-secret
```

## Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

