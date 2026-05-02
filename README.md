# Employee Management System

PHP and MySQL based employee management system with admin, manager, and employee roles.

## Requirements

- PHP 7.x or 8.x
- MySQL or MariaDB
- Apache
- XAMPP is the easiest option on Windows

## Local Setup

1. Clone or download the project.
2. Place the project inside your web server directory such as `htdocs`.
3. Create a file named `connection.php` in the project root.
4. Copy the contents of `connection.example.php` into `connection.php`.
5. Update the database username and password in `connection.php` if needed.
6. Create a database named `employee_management`.
7. Import `database/employee_management.sql`.
8. Open the project in your browser, for example: `http://localhost/EMS/`

## Demo Login

The SQL file includes demo accounts for testing. Change or replace them after import if you do not want to keep the sample data.

## Important Notes

- Passwords in this project are currently stored in plain text.
- Login queries are not using prepared statements.
- This project is suitable as a learning/demo project, not for production use without security improvements.

## Recommended Before Public Release

- Replace demo user data in the SQL file if it contains anything personal.
- Change all demo passwords.
- Migrate passwords to `password_hash()` / `password_verify()`.
- Convert login and update queries to prepared statements.
