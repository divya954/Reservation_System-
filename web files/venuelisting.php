<?php
// Include config file
require_once "config.php";



// Define variables and initialize with empty values
$venueName = $venueLocation = $venueCapacity = $priceRangeLow = $priceRangeHigh = $venueAddress = $hotelType = $venueDescription = "";
$venueImage = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $venueName = htmlspecialchars($_POST['venueName']);
    $venueLocation = htmlspecialchars($_POST['venueLocation']);
    $venueCapacity = intval($_POST['venueCapacity']);
    $priceRangeLow = intval($_POST['priceRangeLow']);
    $priceRangeHigh = intval($_POST['priceRangeHigh']);
    $venueAddress = htmlspecialchars($_POST['venueAddress']);
    $hotelType = htmlspecialchars($_POST['hotelType']);
    $venueDescription = htmlspecialchars($_POST['venueDescription']);

    // Image upload handling
    if (isset($_FILES['venueImage']) && $_FILES['venueImage']['error'] === UPLOAD_ERR_OK) {
        $venueImage = file_get_contents($_FILES['venueImage']['tmp_name']);
    }

    // SQL query to insert data into the "venue" table
    $stmt = $link->prepare("INSERT INTO venue (name, location, capacity, hotel_type, priceRangeLow, priceRangeHigh, venue_description, venue_image) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssississ", $venueName, $venueLocation, $venueCapacity, $hotelType, $priceRangeLow, $priceRangeHigh, $venueDescription, $venueImage);
    
    if ($stmt->execute()) {
        echo "Venue information submitted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$link->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lister Profile - reserveVenue</title>
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
        <a class="nav-link" href="venuelisting.php">Home</a>
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
        <h1>Lister Profile</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <!-- Venue Information Form -->
            <div class="form-group">
                <label for="venueName">Name of the Venue</label>
                <input type="text" class="form-control" id="venueName" name="venueName" required>
            </div>
            <div class="form-group">
                <label for="venueLocation">Location</label>
                <select class="form-control" id="venueLocation" name="venueLocation" required>
                    <option value="Sydney">Sydney</option>
                    <option value="Melbourne">Melbourne</option>
                    <option value="Brisbane">Brisbane</option>
                    <option value="Perth">Perth</option>
                    <option value="Adelaide">Adelaide</option>
                    <option value="Gold Coast">Gold Coast</option>
                    <option value="Byron Bay">Byron Bay</option>
                    <option value="Hunter Valley">Hunter Valley</option>
                    <option value="Noosa">Noosa</option>
                    <option value="Canberra">Canberra</option>
                </select>
            </div>
            <div class="form-group">
                <label for="venueCapacity">Capacity (Minimum 50 guests)</label>
                <input type="number" class="form-control" id="venueCapacity" name="venueCapacity" min="50" required>
            </div>
            <div class="form-group">
                <label for="priceRangeLow">Price Range (Low)</label>
                <input type="number" class="form-control" id="priceRangeLow" name="priceRangeLow" min="500" required>
            </div>
            <div class="form-group">
                <label for="priceRangeHigh">Price Range (High)</label>
                <input type="number" class="form-control" id="priceRangeHigh" name="priceRangeHigh" required>
            </div>
            <div class="form-group">
                <label for="venueAddress">Address of the Venue</label>
                <input type="text" class="form-control" id="venueAddress" name="venueAddress" required>
            </div>
            <div class="form-group">
                <label for="hotelType">Hotel Type</label>
                <select class="form-control" id="hotelType" name="hotelType" required>
                    <option value="Nearby Hotel">Nearby Hotel</option>
                    <option value="Hotel Within">Hotel Within</option>
                </select>
            </div>
            <div class="form-group">
                <label for="venueDescription">Venue Description</label>
                <textarea class="form-control" id="venueDescription" name="venueDescription" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label for="venueImage">Upload Image</label>
                <input type="file" class="form-control-file" id="venueImage" name="venueImage">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit Venue</button>
        </form>
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
