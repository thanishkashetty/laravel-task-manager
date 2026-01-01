# Task Management System

A simple Laravel 12 CRUD app that allows users to create, view, edit, and delete tasks.

## Features
- Add, Edit, Delete Tasks  
- Mark tasks as Completed or Pending  
- Priority levels (Low, Medium, High)
- Display **Due Date** column & sort tasks by due date
- Show **progress bar** (% of tasks completed)
- Clean, responsive UI built with Bootstrap 5  

## Setup Instructions

1.Clone this repository:

git clone https://github.com/thanishkashetty/laravel-task-manager.git
cd laravel-task-manager


2.Install all dependencies using Composer:

composer install


3.Create a new .env file and update your database credentials:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=task_manager
DB_USERNAME=root
DB_PASSWORD=


4.Generate the application key:

php artisan key:generate


5.Create a new database named task_manager in phpMyAdmin.

6.Run database migrations:

php artisan migrate


7.Start the development server:

php artisan serve


8.Open the application in your browser:
http://127.0.0.1:8000/tasks

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
