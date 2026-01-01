# Task Management System

A simple Laravel 11 CRUD app that allows users to create, view, edit, and delete tasks.

## Features
- Add, Edit, Delete Tasks  
- Mark tasks as Completed or Pending  
- Priority levels (Low, Medium, High)
- isplay **Due Date** column & sort tasks by due date
- Show **progress bar** (% of tasks completed)
- Clean, responsive UI built with Bootstrap 5  

## Setup Instructions
1. Clone this repository
2. Create `.env` file and update DB credentials
3. Run migrations:
   ```bash
   php artisan migrate
   ```
4. Start the server:
   ```bash
   php artisan serve
   ```
5. Visit [http://127.0.0.1:8000/tasks](http://127.0.0.1:8000/tasks)

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
