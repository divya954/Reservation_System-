<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

// Include config file
require_once "config.php";

// Fetch approved venues
$sql = "SELECT * FROM venue WHERE approval_status = 1";
$result = $link->query($sql);

// Close the database connection
$link->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReserveVenue - View</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"> <!-- for social media icons-->

    <link rel="stylesheet" href="style.css"> <!-- this one is our external style sheet that we can customize-->


    <style>
   

        .container {
            margin-top: 50px;
        }

        h2 {
            text-align: center;
        }

        .venue-box {
            margin: 20px;
            padding: 20px;
            border: 1px solid #ddd;
        }

        .venue-box img {
            width: 100%;
            height: auto;
            border-radius: 10px;
            margin-bottom: 10px;
        }

        .venue-box h3 {
            text-align: center;
        }

        .venue-box a {
            display: block;
            margin-top: 15px;
        }


        .custom-header {
            text-align: center;
            font-size: 1.5rem;
            font-family: cursive; /* Specify your preferred cursive font */
          /*  margin-top: 2vh; /* Adjust the top margin to center vertically */
        }


    </style>



</head>
<body>

    <!--navbar starts-->

    <nav class="navbar navbar-expand-lg navbar-light bg-orange">
  <a class="navbar-brand" href="#">Reserve Venue</a>

<!-- search bar and filters starts-->


    <form class="form-inline ml-auto">
        <div class="form-group">
            <label for="locationFilter" class="mr-2">Location:</label>
            <select class="form-control" id="locationFilter">
                <option value="all">All Locations</option>
                <option value="location1">Sydney</option>
                <option value="location2">Melborne</option>
                <option value="location2">Brisbane</option>
                <option value="location1">Perth</option>
                <option value="location2">Adelaide</option>
                <option value="location2">Gold Coast</option>
                <option value="location2">Byron Bay</option>
                <option value="location1">Hunter Valley</option>
                <option value="location2">Noosa</option>
                <option value="location2">Canberra</option>



            </select>
        </div>
        <div class="form-group ml-3">
            <label for="capacityFilter" class="mr-2">Capacity:</label>
            <select class="form-control" id="capacityFilter">
                <option value="all">All Capacities</option>
                <option value="capacity1">50 - 100 guests</option>
                <option value="capacity1">100 - 200 guests</option>
                <option value="capacity1">200 - 300 guests</option>
                <option value="capacity1">300 - 400 guests</option>
                <option value="capacity1">400 - 500+ guests</option>


                <option value="capacity2"></option>


            </select>
        </div>
        <div class="form-group ml-3">
            <label for="priceRangeFilter" class="mr-2">Price Range:</label>
            <select class="form-control" id="priceRangeFilter">
                <option value="all">All Price Ranges</option>
                <option value="range1">$500 - $1000</option>
                <option value="range2">$1000 - $2000</option>
                <option value="range2">$2000 - $3000</option>
                <option value="range2">$3000 - $4000</option>
                <option value="range2">$4000 - $5000+</option>



            </select>
        </div>
        <button class="btn btn-primary ml-3" type="button">Search</button>
    </form>


<!-- search bar and filters ends-->


  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="testview.php">Home</a>
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


    <div class="container">
        <div class="custom-header">
            Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.
        </div>
    </div>
  


  <!--out new venue box starts-->


    <div class="container mt-5">
        <h2>Popular Wedding Venues</h2>
        <div class="row">
            <?php
            while ($row = $result->fetch_assoc()) {
                echo "<div class='col-md-4 mb-4'>";
                echo "<div class='card venue-box'>";
 
                echo "<img src='data:image/jpeg;base64," . base64_encode($row['venue_image']) . "' alt='{$row['name']}' class='img-fluid' class='card-img-top'>";
     
                echo "<div class='card-body'>";
                echo "<h3 class='card-title'>{$row['name']}</h3>";

                echo "<a href='viewdetails.php?venueID={$row['venueID']}' class='btn btn-primary'>View Details</a>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
            ?>
        </div>
    </div>


    <!--out new venue box ends-->


    




<!--footer starts-->


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



                <!-- social media ends-->
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


<!--footer ends-->


</body>
</html>
