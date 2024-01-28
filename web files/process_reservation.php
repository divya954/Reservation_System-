<?php
// Assuming you have a database connection file, include it here.
include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize Venue Reservation Data
    $reservationDate = filter_input(INPUT_POST, "reservationDate", FILTER_SANITIZE_STRING);
    $numberOfGuests = filter_input(INPUT_POST, "numberOfGuests", FILTER_VALIDATE_INT);
    $additionalRequests = filter_input(INPUT_POST, "additionalRequests", FILTER_SANITIZE_STRING);

    // Validate Hotel Reservation Data
    $numberOfRooms = filter_input(INPUT_POST, "numberOfRooms", FILTER_VALIDATE_INT);
    $checkInDate = filter_input(INPUT_POST, "checkInDate", FILTER_SANITIZE_STRING);
    $checkOutDate = filter_input(INPUT_POST, "checkOutDate", FILTER_SANITIZE_STRING);
    $noHotelRoom = isset($_POST["noHotelRoom"]) ? 1 : 0;

    // Check if any of the required fields are empty or validation fails
    if (
        empty($reservationDate) || $numberOfGuests === false || empty($additionalRequests) ||
        $numberOfRooms === false || empty($checkInDate) || empty($checkOutDate)
    ) {
        // Handle validation errors, you can redirect back to the reservation page with an error message
        header("Location: reservation.php?error=1");

        exit();
    }

    // Check if the selected date is already booked
    $availabilityCheckQuery = "SELECT COUNT(*) FROM booked_info WHERE reservation_date = ?";
    $availabilityCheckStatement = $link->prepare($availabilityCheckQuery);
    $availabilityCheckStatement->bind_param("s", $reservationDate);
    $availabilityCheckStatement->execute();
    $availabilityCheckStatement->bind_result($reservationCount);
    $availabilityCheckStatement->fetch();
    $availabilityCheckStatement->close();

    // If the date is already booked, redirect with an error
    if ($reservationCount > 0) {
        header("Location: reservation.php?error=2");
        exit();
    }





    
    // Insert data into 'booked_info' table
    $bookedInfoInsertQuery = "INSERT INTO booked_info (reservation_date, guest_no, add_request) VALUES (?, ?, ?)";
    $bookedInfoStatement = $link->prepare($bookedInfoInsertQuery);
    $bookedInfoStatement->bind_param("sis", $reservationDate, $numberOfGuests, $additionalRequests);
    $bookedInfoStatement->execute();

    // Get the last inserted booked_info ID
    $bookedInfoID = $bookedInfoStatement->insert_id;

    // Insert data into 'hotel' table
    $hotelInsertQuery = "INSERT INTO hotel ( booking_quantity, check_in_date, check_out_date) VALUES ( ?, ?, ?)";
    $hotelStatement = $link->prepare($hotelInsertQuery);
    $hotelStatement->bind_param("iss", $numberOfRooms, $checkInDate, $checkOutDate);
    $hotelStatement->execute();

    // Close prepared statements
    $bookedInfoStatement->close();
    $hotelStatement->close();

    // Close database connection
    $link->close();

    // Redirect to a success page or do further processing
    header("Location: payment.php");
    exit();
} else {
    // Handle invalid requests
    echo "Invalid request!";
}

?>
