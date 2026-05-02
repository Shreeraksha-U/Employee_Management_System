<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    require_once "connection.php";

    // Retrieve user's input from the form
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Clear any previous login session data
    unset($_SESSION['login_err']);
    unset($_SESSION['login_email']);

    // Query the database to check user's credentials
    $sql_query_admin = "SELECT * FROM admin WHERE email='$email' AND password='$password'";
    $sql_query_employee = "SELECT * FROM employee WHERE email='$email' AND password='$password'";
    $sql_query_manager = "SELECT * FROM manager WHERE email='$email' AND password='$password'";

    $result_admin = mysqli_query($conn, $sql_query_admin);
    $result_employee = mysqli_query($conn, $sql_query_employee);
    $result_manager = mysqli_query($conn, $sql_query_manager);

    // Check if user is an admin
    if (mysqli_num_rows($result_admin) > 0) {
        $_SESSION["email"] = $email;
        header("Location: admin/dashboard.php");
        exit();
    } 
    // Check if user is an employee
    elseif (mysqli_num_rows($result_employee) > 0) {
        $_SESSION["email"] = $email;
        header("Location: employee/dashboard.php");
        exit();
    } 
    // Check if user is a manager
    elseif (mysqli_num_rows($result_manager) > 0) {
        $_SESSION["email"] = $email;
        header("Location: manager/dashboard.php");
        exit();
    } 
    // If user's credentials are invalid
    else {
        // Set error message in session
        $_SESSION['login_err'] = "<div class='alert alert-warning alert-dismissible fade show'>
            <strong>Invalid Email/Password</strong>
            <button type='button' class='close' data-dismiss='alert' >
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
        $_SESSION['login_email'] = $email; // Preserve entered email in session
        header("Location: index.php"); // Redirect back to login page
        exit();
    }

    mysqli_close($conn);
}
?>
