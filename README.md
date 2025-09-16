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

