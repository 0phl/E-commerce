<?php
// received user input
$fullname = $_POST["fullName"];
$username = $_POST["username"];
$password = $_POST["password"];
$confirmPassword = $_POST["confirmPassword"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // verify password and confirmPassword match
    if (trim($password) == trim($confirmPassword)) {
        // connect database
        $host = "localhost";
        $database = "ecommerce";
        $dbusername = "root";
        $dbpassword = "";

        // DSN for PDO
        $dsn = "mysql:host=$host;dbname=$database;";

        try {
            $conn = new PDO($dsn, $dbusername, $dbpassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Check if the username already exists
            $stmt = $conn->prepare("SELECT * FROM users WHERE username = :p_username");
            $stmt->bindParam(':p_username', $username);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                // Username exists, redirect with error
                header("location: /registration.php?error=username_taken");
                exit();
            } else {
                // Hash the password
                $hashedPassword = password_hash(trim($password), PASSWORD_BCRYPT);

                // Insert the new user record
                $stmt = $conn->prepare("INSERT INTO users (fullname, username, password, created_at, updated_at) 
                                        VALUES (:p_fullname, :p_username, :p_password, NOW(), NOW())");
                $stmt->bindParam(':p_fullname', $fullname);
                $stmt->bindParam(':p_username', $username);
                $stmt->bindParam(':p_password', $hashedPassword);

                if ($stmt->execute()) {
                    echo "Registration successful";
                    // Redirect to the login page or another page if needed
                    // header("location: /login.php");
                    // exit();
                } else { 
                    echo "Insert Error";
                }
            }

        } catch (Exception $e) {
            echo "Connection Failed: " . $e->getMessage();
        }
    } else {
        // Redirect if passwords do not match
        header("location: /registration.php?error=password_mismatch");
        exit();
    }
}
?>
