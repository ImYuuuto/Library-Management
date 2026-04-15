# Library Management System

A simple PHP/MySQL web application to manage books and borrow requests.

This project provides:
- User authentication (register, login, logout)
- Book browsing and details pages
- Borrow requests with approval workflow
- Admin dashboard for book and borrow management

## Tech Stack

- PHP (plain PHP, session-based auth)
- MySQL (via PDO)
- HTML/CSS
- XAMPP (recommended local environment)

## Features

### User Features
- Register and login
- Browse all books
- View a single book details page
- Send borrow request
- View approved borrowed books

### Admin Features
- Access admin dashboard
- Add, edit, delete books
- Filter books by category in management page
- Manage borrow requests:
  - Approve request
  - Reject request
  - Remove approval (set approved request back to pending)

## Project Structure

```text
public/
  app/
    auth/              # Login/Register pages and handlers
    dashboard/         # Admin pages and actions
    includes/          # Shared auth/header/footer includes
    pages/             # User pages
  config/              # DB and env loading config
  database/project.sql # Database schema
  index.php            # Front controller / router
```

## Requirements

- PHP 8.0+
- MySQL 5.7+ (or MariaDB equivalent)
- XAMPP / Apache

## Installation

1. Clone the repository inside your XAMPP htdocs directory:

   ```bash
   git clone <your-repo-url> gb
   ```

2. Create the database and tables:
   - Open phpMyAdmin (or MySQL CLI)
   - Run the SQL file:
     - `public/database/project.sql`

3. Create a `.env` file at the project root (`gb/.env`) with:

   ```env
   DB_HOST="??"
   DB_NAME="??"
   DB_USER="??"
   DB_PASS="??"
   ```

4. Start Apache and MySQL from XAMPP.

5. Open the app in browser:
   - [http://localhost/gb/public/](http://localhost/gb/public/)

## Routing

Routing is handled in `public/index.php` using the `page` query parameter.

Examples:
- `?page=home`
- `?page=books`
- `?page=dashboard`
- `?page=gestion_emprunts`

## Notes

- Authentication and role checks are handled in `public/app/includes/auth.php`.
- Admin-only pages/actions require `requireAdmin()`.
- Environment variables are loaded from `.env` by `public/config/config.php`.


