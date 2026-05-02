<?php 
require_once "include/header.php";
?>

<?php  
$nameErr = $emailErr = $passErr = $salaryErr = $dobErr = $genderErr = "";
$name = $email = $dob = $gender = $pass = $salary = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_REQUEST["gender"])) {
        $genderErr = "<p style='color:red'> * Gender is required</p>";
        $gender = "";
    } else {
        $gender = $_REQUEST["gender"];
    }

    if (empty($_REQUEST["dob"])) {
        $dobErr = "<p style='color:red'> * Date of Birth is required</p>";
        $dob = "";
    } else {
        $dob = $_REQUEST["dob"];
        // Validate DOB
        $currentDate = date("Y-m-d");
        $dobDateTime = new DateTime($dob);
        $currentDateTime = new DateTime($currentDate);
        
        if ($dob === $currentDate) {
            $dobErr = "<p style='color:red'> * Date of Birth cannot be today's date</p>";
        } else {
            $age = $currentDateTime->diff($dobDateTime)->y;
            if ($age < 21 || $age > 40) {
                $dobErr = "<p style='color:red'> * Age must be between 21 and 40 years</p>";
            }
        }
    }

    if (empty($_REQUEST["name"])) {
        $nameErr = "<p style='color:red'> * Name is required</p>";
    } else {
        $name = $_REQUEST["name"];
    }

    if (empty($_REQUEST["salary"])) {
        $salaryErr = "<p style='color:red'> * Salary is required</p>";
        $salary = "";
    } else {
        $salary = $_REQUEST["salary"];
    }

    if (empty($_REQUEST["email"])) {
        $emailErr = "<p style='color:red'> * Email is required</p>";
    } else {
        $email = $_REQUEST["email"];
    }

    if (empty($_REQUEST["pass"])) {
        $passErr = "<p style='color:red'> * Password is required</p>";
    } else {
        $pass = $_REQUEST["pass"];
        // Password validation
        if (!preg_match('/^(?=.*[A-Z])(?=.*\W).{8,}$/', $pass)) {
            $passErr = "<p style='color:red'> * Password must be at least 8 characters long and contain at least one uppercase letter and one special character</p>";
        }
    }

    if (!empty($name) && !empty($email) && !empty($pass) && !empty($salary) && empty($dobErr) && empty($passErr) && empty($genderErr)) {

        // database connection
        require_once "../connection.php";

        $sql_select_query = "SELECT email FROM employee WHERE email = '$email'";
        $r = mysqli_query($conn, $sql_select_query);

        if (mysqli_num_rows($r) > 0) {
            $emailErr = "<p style='color:red'> * Email Already Registered</p>";
        } else {
            $sql = "INSERT INTO employee(name, email, password, dob, gender, salary) VALUES('$name', '$email', '$pass', '$dob', '$gender', '$salary')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $name = $email = $dob = $gender = $pass = $salary = "";
                echo "<script>
                $(document).ready(function(){
                    $('#showModal').modal('show');
                    $('#modalHead').hide();
                    $('#linkBtn').attr('href', 'manage-employee.php');
                    $('#linkBtn').text('View Employees');
                    $('#addMsg').text('Employee Added Successfully!');
                    $('#closeBtn').text('Add More?');
                })
                </script>";
            }
        }
    }
}
?>

<div style=""> 
<div class="login-form-bg h-100">
    <div class="container h-100">
        <div class="row justify-content-center h-100">
            <div class="col-xl-6">
                <div class="form-input-content">
                    <div class="card login-form mb-0">
                        <div class="card-body pt-4 shadow">                       
                            <h4 class="text-center">Add New Employee</h4>
                            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                <div class="form-group">
                                    <label>Full Name :</label>
                                    <input type="text" class="form-control" value="<?php echo $name; ?>" name="name">
                                    <?php echo $nameErr; ?>
                                </div>
                                <div class="form-group">
                                    <label>Email :</label>
                                    <input type="email" class="form-control" value="<?php echo $email; ?>" name="email">
                                    <?php echo $emailErr; ?>
                                </div>
                                <div class="form-group">
                                    <label>Password: </label>
                                    <input type="password" class="form-control" value="<?php echo $pass; ?>" name="pass">
                                    <?php echo $passErr; ?>
                                </div>
                                <div class="form-group">
                                    <label>Salary :</label>
                                    <input type="number" class="form-control" value="<?php echo $salary; ?>" name="salary">
                                    <?php echo $salaryErr; ?>
                                </div>
                                <div class="form-group">
                                    <label>Date-of-Birth :</label>
                                    <input type="date" class="form-control" value="<?php echo $dob; ?>" name="dob">
                                    <?php echo $dobErr; ?>
                                </div>
                                <div class="form-group form-check form-check-inline">
                                    <label class="form-check-label">Gender :</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" <?php if($gender == "Male"){ echo "checked"; } ?> value="Male">
                                    <label class="form-check-label">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" <?php if($gender == "Female"){ echo "checked"; } ?> value="Female">
                                    <label class="form-check-label">Female</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" <?php if($gender == "Other"){ echo "checked"; } ?> value="Other">
                                    <label class="form-check-label">Other</label>
                                </div>
                                <?php echo $genderErr; ?>
                                <br>
                                <button type="submit" class="btn btn-primary btn-block">Add</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<?php 
require_once "include/footer.php";
?>
