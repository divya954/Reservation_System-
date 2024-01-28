<?php
// Include config file
require_once "config.php";

// Check if the user is logged in as an admin (you need to implement authentication)
// For example, you can have a session variable set when an admin logs in
session_start();
/*
if (!isset($_SESSION["admin_logged_in"]) || $_SESSION["admin_logged_in"] !== true) {
    // Redirect to the login page if not logged in
    header("location: admin_login.php");
    exit;
}*/

// Function to update the approval status of a venue
function updateApprovalStatus($venueID, $status)
{
    global $link;

    $stmt = $link->prepare("UPDATE venue SET approval_status = ? WHERE venueID = ?");
    $stmt->bind_param("ii", $status, $venueID);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["approve"])) {
        $venueID = $_POST["venue_id"];
        updateApprovalStatus($venueID, 1); // Approve
    } elseif (isset($_POST["reject"])) {
        $venueID = $_POST["venue_id"];
        updateApprovalStatus($venueID, 2); // Reject
    }
}

// Fetch venue listings
$sql = "SELECT * FROM venue WHERE approval_status = 0";
$result = $link->query($sql);

// Close the database connection
$link->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - reserveVenue</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <!--added -->



      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"> <!-- for social media icons-->

 
    <link rel="stylesheet" href="style.css"> <!-- this one is our external style sheet that we can customize-->




    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>




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

         <li class="nav-item">
        <a class="nav-link" href="adminprofile.php">Home</a>
      </li>


        <li class="nav-item">
        <a href="reset-password.php" class="nav-link">Reset</a>
        </li>


        <li class="nav-item">
        <a href="logout.php" class="nav-link">Sign Out</a>
        </li>

      <!-- Add more links here -->
    </ul>
  </div>
</nav>


    <!--navbar ends-->



    <div class="container mt-5">
        <h1>Admin Panel</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Location</th>
                    <th>Capacity</th>
                    <th>Price Range (Low)</th>
                    <th>Price Range (High)</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['name']}</td>";
                    echo "<td>{$row['location']}</td>";
                    echo "<td>{$row['capacity']}</td>";
                    echo "<td>{$row['priceRangeLow']}</td>";
                    echo "<td>{$row['priceRangeHigh']}</td>";
                    echo "<td>
                            <form action='' method='post'>
                                <input type='hidden' name='venue_id' value='{$row['venueID']}'>
                                <button type='submit' class='btn btn-success' name='approve'>Approve</button>
                                <button type='submit' class='btn btn-danger' name='reject'>Reject</button>
                            </form>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
      
    </div>


   <!-- footer starts -->


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



    <!-- footer ends -->


    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>
