<?php
require_once "config.php";

// Initialize variables
$username = $password = $role = $contactNumber = $department = "";
$username_err = $password_err = $role_err = $contactNumber_err = $department_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } else {
        $username = cleanInput($_POST["username"]);
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } else {
        $password = cleanInput($_POST["password"]);
    }

    // Validate role
    if (empty(trim($_POST["role"]))) {
        $role_err = "Please enter a role.";
    } else {
        $role = cleanInput($_POST["role"]);
    }

    // Validate contact number
    if (empty(trim($_POST["contactNumber"]))) {
        $contactNumber_err = "Please enter a contact number.";
    } else {
        $contactNumber = cleanInput($_POST["contactNumber"]);
    }

    // Validate department
    if (empty(trim($_POST["department"]))) {
        $department_err = "Please enter a department.";
    } else {
        $department = cleanInput($_POST["department"]);
    }

    // Check input errors before inserting into database
    if (empty($username_err) && empty($password_err) && empty($role_err) && empty($contactNumber_err) && empty($department_err)) {
        // Insert data into users table
        $sql_user = "INSERT INTO users (username, password, user_type) VALUES (?, ?, ?)";
        if ($stmt_user = $link->prepare($sql_user)) {
            $user_type = "admin"; // set default user type
            $stmt_user->bind_param("sss", $param_username, $param_password, $param_user_type);
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            $param_user_type = $user_type;
            if ($stmt_user->execute()) {
                
                // Get the inserted user's id

                $user_id = $stmt_user->insert_id;

                // Insert data into admin table
                $sql_admin = "INSERT INTO admin (adminRole, contactNumber, department, id) VALUES (?, ?, ?, ?)";
                if ($stmt_admin = $link->prepare($sql_admin)) {
                    $stmt_admin->bind_param("sssi", $param_role, $param_contactNumber, $param_department, $param_id);
                    $param_role = $role;
                    $param_contactNumber = $contactNumber;
                    $param_department = $department;
                    $param_id = $user_id;
                    if ($stmt_admin->execute()) {
                        header("location: index.php");
                    } else {
                        echo "Something went wrong. Please try again later.";
                    }
                    $stmt_admin->close();
                }
            } else {
                echo "Something went wrong. Please try again later.";
            }
            $stmt_user->close();
        }
    }
    $link->close();
}

function cleanInput($input)
{
    return htmlspecialchars(stripslashes(trim($input)));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Signup</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            max-width: 400px;
            margin: 100px auto;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-center mb-4">Admin Signup</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" required>
                <span class="text-danger"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
                <span class="text-danger"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label for="role">Role:</label>
                <input type="text" class="form-control" id="role" name="role" required>
                <span class="text-danger"><?php echo $role_err; ?></span>
            </div>
            <div class="form-group">
                <label for="contactNumber">Contact Number:</label>
                <input type="tel" class="form-control" id="contactNumber" name="contactNumber" required>
                <span class="text-danger"><?php echo $contactNumber_err; ?></span>
            </div>
            <div class="form-group">
                <label for="department">Department:</label>
                <input type="text" class="form-control" id="department" name="department" required>
                <span class="text-danger"><?php echo $department_err; ?></span>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
            </div>
            <p class="text-center">Already have an account? <a href="index.php">Login here</a>.</p>
        </form>
    </div>

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>
