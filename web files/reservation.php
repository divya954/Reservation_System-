<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReserveVenue - Reservation</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"> <!-- for social media icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"> <!-- for date picker -->
    <link rel="stylesheet" href="style.css"> <!-- your custom styles -->
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
                <!-- Add more links here -->
            </ul>
        </div>
    </nav>
    <!--navbar ends-->

    <!--reservation starts-->
    <div class="container mt-5">
        <h1>Make a Reservation</h1>
        <form action="process_reservation.php" method="post">
            <div class="row">
                <!-- Venue Reservation Section -->
                <div class="col-md-6">
                    <div class="reservation-section">
                        <h4>Venue Reservation</h4>
                        <div class="form-group">
                            <label for="reservationDate">Select Reservation Date</label>
                            <input type="date" class="form-control" id="reservationDate" name="reservationDate">
                        </div>
                        <div class="form-group">
                            <label for="numberOfGuests">Number of Guests - For The Venue</label>
                            <input type="number" class="form-control" id="numberOfGuests" name="numberOfGuests" min="1">
                        </div>
                        <div class="form-group">
                            <label for="additionalRequests">Additional Requests</label>
                            <textarea class="form-control" id="additionalRequests" name="additionalRequests" rows="4"></textarea>
                        </div>
                    </div>
                </div>
                <!-- Hotel Reservation Section -->
                <div class="col-md-6">
                    <div class="reservation-section">
                        <h4>Hotel Reservation</h4>
                        <div class="form-group">
                            <label for="numberOfRooms">Number of Hotel Rooms</label>
                            <input type="number" class="form-control" id="numberOfRooms" name="numberOfRooms" min="0">
                        </div>
                        <div class="form-group">
                            <label for="checkInDate">Check-in Date (for hotel)</label>
                            <input type="date" class="form-control" id="checkInDate" name="checkInDate">
                        </div>
                        <div class="form-group">
                            <label for="checkOutDate">Check-out Date (for hotel)</label>
                            <input type="date" class="form-control" id="checkOutDate" name="checkOutDate">
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="noHotelRoom" name="noHotelRoom">
                            <label class="form-check-label" for="noHotelRoom">I don't need a hotel room</label>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success">Submit Reservation</button>
        </form>
    </div>
    <!--reservation ends-->

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


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

</body>
</html>