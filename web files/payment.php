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
        /* Add any custom CSS styles here */

 
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
      <!-- Add more links here -->
    </ul>
  </div>
</nav>


    <!--navbar ends-->

<div class="container mt-5">
    <h2>Payment</h2>
    <form action="confirmation.php">
        <div class="form-group">
            <label for="paymentMethod">Select Payment Method</label>
            <select class="form-control" id="paymentMethod">
                <option value="creditCard">Credit Card</option>
                <option value="debitCard">Debit Card</option>
                <option value="visa">Visa</option>
                <option value="masterCard">Mastercard</option>
            </select>
        </div>
        <div class="form-group">
            <label for="cardNumber">Card Number</label>
            <input type="text" class="form-control" id="cardNumber">
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="expiryDate">Expiry Date</label>
                <input type="text" class="form-control" id="expiryDate" placeholder="MM/YY">
            </div>
            <div class="form-group col-md-6">
                <label for="securityCode">Security Code (CVV)</label>
                <input type="text" class="form-control" id="securityCode">
            </div>
        </div>
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="saveCard">
            <label class="form-check-label" for="saveCard">Save this card for future use</label>
        </div>
        <button type="submit" class="btn btn-success">Confirm Payment</button>
    </form>
</div>
  
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
