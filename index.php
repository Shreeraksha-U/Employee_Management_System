<?php
session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link href="resorce/css/style.css" rel="stylesheet">

    <title>Employee Management System</title>
    <style>
    body, html {
    height: 100%;
    margin: 0;
    }

.bg {
  background-image: url("bg.png");
  height: 100%; 
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  
}

</style>
  </head>
  <body>
    <div class="bg border">
      <div class="login-form-bg h-100">
        <div class="container h-100">
          <div class="row justify-content-center h-100">
            <div class="col-xl-6">
              <div class="form-input-content">
                <div class="card login-form mt-5">
                  <div class="card-body shadow">   
                    <h2 class="text-center pb-4">Employee Management System</h2>
                    <div class="container mt-4">
                      <form method="post" action="login.php">
                        <div class="form-group">
                          <input type="email" class="form-control" name="email" placeholder="Enter Email" required value="<?php echo isset($_SESSION['login_email']) ? $_SESSION['login_email'] : ''; ?>">
                        </div>
                        <div class="form-group">
                          <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                        <div class="form-group">
                          <button type="submit" class="btn btn-primary btn-lg btn-block">Log In</button>
                        </div>
                        <?php
                        // Display error message if any
                        if (isset($_SESSION['login_err'])) {
                          echo $_SESSION['login_err'];
                          unset($_SESSION['login_err']); // Clear the error message after displaying
                        }
                        ?>
                      </form>
                    </div>   
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="./resorce/plugins/common/common.min.js"></script>
    <script src="./resorce/js/custom.min.js"></script>
    <script src="./resorce/js/settings.js"></script>
    <script src="./resorce/js/gleek.js"></script>
    <script src="./resorce/js/styleSwitcher.js"></script>
  </body>
</html>
