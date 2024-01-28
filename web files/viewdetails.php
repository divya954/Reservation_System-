<?php
// Include config file
require_once "config.php";

// Check if venue ID is provided in the URL
if (isset($_GET['venueID'])) {
    $venueId = $_GET['venueID'];

    // Fetch venue details
    $sql = "SELECT * FROM venue WHERE venueID = $venueId";
    $result = $link->query($sql);

    if ($result->num_rows > 0) {
        $venue = $result->fetch_assoc();
    } else {
        // Redirect to view.php if the venue is not found
        header("Location: testview.php");
        exit();
    }
} else {
    // Redirect to view.php if venue ID is not provided
    header("Location: testview.php");
    exit();
}

// Close the database connection
$link->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venue Details - reserveVenue</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"> <!-- for social media icons-->

    <link rel="stylesheet" href="style.css"> <!-- this one is our external style sheet that we can customize-->



    <style>
       .venue-details {
            margin-top: 20px;
        }

        .venue-details img {
            max-width: 100%;
            height: auto;
        }


               .cover-bg {
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
            height: 100%;
        }


        .container {
            margin-top: 50px;
        }

        .venue-details {
            background-color: #f8f9fa; /* Light gray background color */
            padding: 20px;
            border-radius: 10px;
            overflow: hidden;
        }

        .venue-details img {
            max-width: 100%;
            height: auto;
            float: right;
            margin-left: 20px; /* Adjust margin as needed */
        }

        .venue-info {
            float: left;
        }

        .venue-info h2 {
            margin-bottom: 20px;
        }

    </style>
</head>

<body>
  <!--navbar starts-->

    <nav class="navbar navbar-expand-lg navbar-light bg-orange">
  <a class="navbar-brand" href="#">ReserveVenue - Wedding Venue Reservation</a>
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

    </ul>
  </div>
</nav>


    <!--navbar ends-->



<!---after php integration code starts -->

        <div class="container">
        <h1><?= $venue['name'] ?></h1>
        <div class="venue-details">
            <img src="data:image/jpeg;base64,<?= base64_encode($venue['venue_image']) ?>" alt="<?= $venue['name'] ?>" class="img-fluid">
            <div class="venue-info">
              
                <p><strong>Location:</strong> <?= $venue['location'] ?></p>
                <p><strong>Capacity:</strong> <?= $venue['capacity'] ?> guests</p>
                <p><strong>Hotel Type:</strong> <?= $venue['hotel_type'] ?></p>
                <p><strong>Price Range:</strong> $<?= $venue['priceRangeLow'] ?> - $<?= $venue['priceRangeHigh'] ?></p>
                <p><strong>Description:</strong> <?= $venue['venue_description'] ?></p>
                <p><a href="reservation.php" class="btn btn-success">Make a Reservation</a></p>
            </div>

               
        </div>
        </div>



    <!---after php integration code ends -->



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









    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>



</body>

</html>
