# Wedding Venue Reservation System

This repository contains the source code and database schema for a Wedding Venue Reservation System. The system allows users to reserve venues for weddings, list bookings, and handle administrative tasks related to venue management.

## Project Structure

The project consists of the following components:

### Database Schema

The MySQL database schema is defined in the SQL dump file (`venue_database.sql`). It includes the following tables:

- `admin`: Stores information about administrators managing the system.
- `booked_info`: Contains details of booked reservations.
- `customer`: Stores customer information.
- `hotel`: Represents hotel details and bookings.
- `management`: Manages roles and permissions for administrators.
- `reservation`: Holds reservation details.
- `users`: Stores user authentication information.
- `venue`: Contains venue information including availability and pricing.
- `venue_lister`: Stores information about venue listers.

### Web Application Files

The web application is built using PHP and includes the following files:

- `adminprofile.php`: Admin profile management page.
- `cancellation.php`: Cancellation handling page.
- `config.php`: Configuration file containing database connection details.
- `confirmation.php`: Confirmation page for reservation.
- `crown_hotel.jpeg`, `sofi.jpg`, `star.jpeg`, `starlight.jpeg`: Image files used in the application.
- `index.php`: Main landing page.
- `logout.php`: Logout functionality.
- `payment.php`: Payment processing page.
- `process_reservation.php`: Backend script for processing reservations.
- `reservation.php`: Reservation page.
- `reset-password.php`: Password reset page.
- `signup_admin.php`, `signup_customer.php`, `signup_lister.php`: Sign up pages for different user roles.
- `style.css`: Cascading Style Sheets for styling the web pages.
- `venuelisting.php`: Venue listing page.
- `viewdetails.php`: Page for viewing venue details.

## Usage

To set up the project locally, follow these steps:

1. Import the database schema (`venue_database.sql`) into your MySQL environment using phpMyAdmin or MySQL Workbench.
2. Update the database connection details in `config.php` with your MySQL credentials.
3. Place all PHP files in your web server directory (e.g., `htdocs` for XAMPP).
4. Access the application through your web browser.

## Contributors

- Divyva B K (https://github.com/divya954) - Project Developer

## Contact

For any questions or suggestions regarding this project, please contact divyabk54@gmail.com


