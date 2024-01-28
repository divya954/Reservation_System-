<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, otherwise redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate new password
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Please enter the new password.";     
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "Password must have atleast 6 characters.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm the password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
        
    // Check input errors before updating the database
    if(empty($new_password_err) && empty($confirm_password_err)){
        // Prepare an update statement
        $sql = "UPDATE users SET password = ? WHERE id = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);
            
            // Set parameters
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Password updated successfully. Destroy the session, and redirect to login page
                session_destroy();
                header("location: index.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>


<!DOCTYPE html>
<html>
<head>


    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"> <!-- for social media icons-->

 
    <link rel="stylesheet" href="style.css"> <!-- this one is our external style sheet that we can customize-->




    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>


    <title>ReserveVenue</title>



    <style>
        /* Add any custom CSS styles here */


    </style>

</head>
<body>

    <!--navbar starts-->

    <nav class="navbar navbar-expand-lg navbar-light bg-orange">
  <a class="navbar-brand" href="#">ReserveVneue - Wedding Venue Reservation</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto">
      
            <!-- <li class="nav-item">
        <a class="nav-link" href="view.php">Home</a>
      </li>-->


        <li class="nav-item">
        <a href="logout.php" class="nav-link">Sign Out</a>
        </li>


      <!-- Add more links here -->
    </ul>
  </div>
</nav>


    <!--navbar ends-->




<!--reset password form starts-->

<div class="container">
  <div class="row">
    <div class="col-md-6 mx-auto">
      <div class="card mt-5">
        <div class="card-header">
          <h2>Reset Password</h2>
        </div>
        <div class="card-body">

        <p>Please fill out this form to reset your password.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
            <div class="form-group">
                <label>New Password</label>
                <input type="password" name="new_password" class="form-control <?php echo (!empty($new_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_password; ?>">
                <span class="invalid-feedback"><?php echo $new_password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <a class="btn btn-link ml-2" href="logout.php">Cancel</a>
            </div>
        </form>

        </div>
      </div>
    </div>
  </div>
</div>

<!-- reset password form ends-->

<script>
  document.getElementById("showSignupForm").addEventListener("click", function() {
    document.getElementById("loginForm").style.display = "none";
    document.getElementById("signupForm").style.display = "block";
  });
</script>




<footer class="bg-dark text-light mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h5>Connect with us</h5>
                <!-- social media links starts here -->


                <a href="https://www.instagram.com/your_instagram_page/" class="text-light mr-3">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="https://www.facebook.com/your_facebook_page/" class="text-light mr-3">
                    <i class="fab fa-facebook"></i>
                </a>
                <a href="https://twitter.com/your_twitter_page" class="text-light">
                    <i class="fab fa-twitter"></i>
                </a>



                <!-- social media links ends-->
            </div>
            <div class="col-md-6">
                <h5>Contact Info</h5>
                <p>Email: info@ReserveVenue.com</p>
                <p>Phone: +61 4 4785 8339.</p>
                <p>&copy; 2023 ReserveVenue</p>
            </div>
        </div>
    </div>
</footer>

<!--login form 2 ends-->

    <!-- Optional JavaScript --
    -- jQuery first, then Popper.js, then Bootstrap JS --
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
-->


</body>
</html>