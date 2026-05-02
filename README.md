# Employee Management System
• Developed an ERP system utilizing PHP, MySQL, JavaScript, Bootstrap and CSS.

• Built full-stack HRMS system with CRUD operations and role-based workflows.

• Implemented Employee Leave management to replace traditional leave application.

• Optimized employee data handling for administrative efficiency.


PHP and MySQL based employee management system with admin, manager, and employee roles.

# Module description
1. Admin: Admin module can manage the entire application. It includes management 
of manager and employee. It can also update employee details and change the 
password. It can also do the same for admin.

2. Employee: Employee can apply for leave, check leave status and check salary with 
proper authentication. They can also update their profile and change account 
password.

3. Manager: Manager can check leave, check timesheet and can approve or reject 
leaves with proper authentication. Manager can also update his profile and change 
account password.

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
<img width="751" height="448" alt="1" src="https://github.com/user-attachments/assets/9d3c30fd-23d4-4c54-ac57-2bfba0cb2706" />
<img width="739" height="435" alt="2" src="https://github.com/user-attachments/assets/91e26cff-f3bd-49e2-8dc3-15400d6f316b" />
<img width="727" height="433" alt="3" src="https://github.com/user-attachments/assets/64db04c1-28b3-4f25-8285-cf262bb652f8" />
<img width="724" height="415" alt="4" src="https://github.com/user-attachments/assets/dfdeed8c-dc49-4eab-8364-0462187aaf36" />
<img width="726" height="433" alt="5" src="https://github.com/user-attachments/assets/d05d4cf5-63df-496c-b91e-fe72d6a510aa" />
<img width="722" height="413" alt="6" src="https://github.com/user-attachments/assets/e3de0f80-b00a-465c-8e6c-50d6fdad7a33" />
<img width="727" height="428" alt="7" src="https://github.com/user-attachments/assets/722a6985-58e0-44c8-b8ba-427c52bc4a4b" />
<img width="719" height="427" alt="8" src="https://github.com/user-attachments/assets/d6a2919e-971c-418d-b9b7-243fdcef2f69" />

