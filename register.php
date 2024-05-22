<?php
// Start or resume the existing session
session_start();

// Check if the user is already logged in and redirect to movieLists.php if logged in
if (isset($_SESSION['user_email'])) {
    header("Location: moviepage.php");
    exit();
}

// Check if the registration form is submitted
if (isset($_POST['register'])) {
    // Retrieve user credentials from the registration form
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $type = $_POST['type'];

    // Include the database configuration
    require_once "db.php";

    // Check connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // Validate email format using filter_var
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_msg = "Invalid email format. Please try again.";
    } elseif (strlen($password) < 8 || !preg_match("/[a-zA-Z]/", $password) || !preg_match("/[0-9]/", $password)) {
        // Validate password format (at least 8 characters with letters and numbers)
        $error_msg = "Password must be at least 8 characters long and contain both letters and numbers. Please try again.";
    } else {
        // Hash the password using password_hash for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Use prepared statement to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO tbl_232_users (Name, Email, Password, Type) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $email, $hashed_password, $type);

        if ($stmt->execute()) {
            // Registration successful, perform login action (e.g., set session variable)
            $_SESSION['user_email'] = $email; // Save the user email in the session
            header("Location: movieLists.php"); // Redirect to movieLists.php
            exit(); // Stop further execution of the script
        } else {
            // Registration failed, show error message
            $error_msg = "Registration failed. Please try again.";
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <!-- Add your CSS stylesheets and other head section content here -->
</head>
<body>
    <div class="register-container">
        <h2>Register</h2>
        <?php if (isset($error_msg)) { ?>
            <p class="error-message"><?php echo $error_msg; ?></p>
        <?php } ?>
        <form action="register.php" method="post">
            <input type="text" name="username" placeholder="User Name" required>
            <input type="text" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <label>Are you a movie viewer?</label>
            <input type="radio" name="type" value="yes" required>Yes
            <input type="radio" name="type" value="no" required>No
            <input type="submit" name="register" value="Register">
        </form>
    </div>
</body>
</html>