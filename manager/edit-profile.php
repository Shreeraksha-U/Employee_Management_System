<?php
require_once "include/header.php";
?>

<?php
// Database connection
require_once "../connection.php";

$session_email = $_SESSION["email"];
$sql = "SELECT * FROM manager WHERE email= ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $session_email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($rows = $result->fetch_assoc()) {
        $name = $rows["name"];
        $email = $rows["email"];
        $dob = $rows["dob"];
        $gender = $rows["gender"];
    }
}

$nameErr = $emailErr = $dobErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_REQUEST["gender"])) {
        $gender = "";
    } else {
        $gender = $_REQUEST["gender"];
    }

    if (empty($_REQUEST["dob"])) {
        $dobErr = "<p style='color:red'> * Date of Birth is required</p>";
        $dob = "";
    } else {
        $dob = $_REQUEST["dob"];
        // Validate Date of Birth
        $today = date("Y-m-d");
        if ($dob == $today) {
            $dobErr = "<p style='color:red'> * Date of Birth cannot be today's date</p>";
            $dob = "";
        }
    }

    if (empty($_REQUEST["name"])) {
        $nameErr = "<p style='color:red'> * Name is required</p>";
        $name = "";
    } else {
        $name = $_REQUEST["name"];
    }

    if (empty($_REQUEST["email"])) {
        $emailErr = "<p style='color:red'> * Email is required</p>";
        $email = "";
    } else {
        $email = $_REQUEST["email"];
    }

    // Age Validation (25 to 40 years)
    if (!empty($dob)) {
        $birthdate = new DateTime($dob);
        $today = new DateTime();
        $age = $birthdate->diff($today)->y;

        if ($age < 25 || $age > 40) {
            $dobErr = "<p style='color:red'> * Age must be between 25 and 40 years</p>";
        }
    }

    if (!empty($name) && !empty($email) && empty($nameErr) && empty($emailErr) && empty($dobErr)) {
        $sql_select_query = "SELECT email FROM manager WHERE email = ? AND email != ?";
        $stmt = $conn->prepare($sql_select_query);
        $stmt->bind_param("ss", $email, $session_email);
        $stmt->execute();
        $r = $stmt->get_result();

        if ($r->num_rows > 0) {
            $emailErr = "<p style='color:red'> * Email Already Register</p>";
        } else {
            $sql = "UPDATE manager SET name = ?, email = ?, dob = ?, gender = ? WHERE email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssss", $name, $email, $dob, $gender, $session_email);
            $result = $stmt->execute();

            if ($result) {
                $_SESSION['email'] = $email;
                echo "<script>
                    $(document).ready(function() {
                        $('#showModal').modal('show');
                        $('#modalHead').hide();
                        $('#linkBtn').attr('href', 'profile.php');
                        $('#linkBtn').text('View Profile');
                        $('#addMsg').text('Profile Edited Successfully!!');
                        $('#closeBtn').hide();
                    });
                </script>";
            }
        }
    }
}
?>

<div style="">
    <div class="login-form-bg h-100">
        <div class="container mt-5 h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5 shadow">
                                <h4 class="text-center">Edit Your Profile</h4>
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
                                        <label>Date-of-Birth :</label>
                                        <input type="date" class="form-control" value="<?php echo $dob; ?>" name="dob">
                                        <?php echo $dobErr; ?>
                                    </div>
                                    <div class="form-group form-check form-check-inline">
                                        <label class="form-check-label">Gender :</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" <?php if ($gender == "Male") { echo "checked"; } ?> value="Male">
                                        <label class="form-check-label">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" <?php if ($gender == "Female") { echo "checked"; } ?> value="Female">
                                        <label class="form-check-label">Female</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" <?php if ($gender == "Other") { echo "checked"; } ?> value="Other">
                                        <label class="form-check-label">Other</label>
                                    </div>
                                    <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
                                        <div class="btn-group">
                                            <input type="submit" value="Edit & Update" class="btn btn-primary w-20" name="save_changes">
                                        </div>
                                        <div class="input-group">
                                            <a href="profile.php" class="btn btn-primary w-20">Close</a>
                                        </div>
                                    </div>
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
