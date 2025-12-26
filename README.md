# Efficient Employee Management System:

A Laravel-powered Solution with Robust Security and Seamless Operations

The application is built using Laravel for both frontend and backend, with roles managed by Spatie. Routes are secured with authentication and roles middleware, and all operations use AJAX with robust error handling. Admin-exclusive tasks include adding/editing employees. A welcome email, utilizing Laravel's queue, is sent to new employees with ID and name. Employee access is limited to viewing other employees, and Eloquent relations with eager loading optimize the loading of the complete employee list.

# Laravel Dockerized Application

This project is a Laravel application fully Dockerized using:
- PHP 8.1 (PHP-FPM)
- Nginx
- MySQL
- Docker Compose
- Vite for frontend assets

---

## Prerequisites

Make sure you have installed:
- Docker Desktop (running)
- Node.js (v16+ recommended)
- Git

---

## Project Setup (Step-by-Step)

### 1. Clone the repository
```bash
git clone <your-repository-url>
cd laravel-docker-app

### 2. Create .env file
```bash
cp .env.example .env

### 3. Update .env file 

- DB_HOST=mysql
- DB_USERNAME=laravel
- DB_PASSWORD=secret

### 4. Build and start Docker containers
docker compose up -d --build

### 5. Install frontend dependencies
npm install

### 6. Build frontend assets
npm run build

### 7. Install backend dependencies
docker compose exec php composer install

### 8. Generate application key
docker compose exec php php artisan key:generate

### 9. Run database migrations
docker compose exec php php artisan migrate

### 10. Access the application

Open your browser:

http://localhost:8000

