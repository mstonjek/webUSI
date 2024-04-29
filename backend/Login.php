<?php
namespace pages;



// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if both username and password are provided
    if (isset($_POST['username']) && isset($_POST['password'])) {
        // Validate the username and password (you should add more validation and security measures)
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Here, you would typically query your database to verify the username and password
        // For simplicity, let's assume the correct credentials are hardcoded
        $correctUsername = 'admin';
        $correctPassword = 'password';

        // Check if the provided credentials match the correct ones
        if ($username === $correctUsername && $password === $correctPassword) {
            // Authentication successful
            // Set a session variable to indicate that the user is logged in
            $_SESSION['logged_in'] = true;

            // Redirect the user to a protected page or display a success message
            header('Location: dashboard.php');
            exit;
        } else {
            // Authentication failed
            // Redirect the user back to the login page with an error message
            header('Location: ../pages/homepage.php?error=invalid_credentials');
            exit;
        }
    }
}

// If the form was not submitted properly, redirect the user back to the login page
header('Location: ../login.php');
exit;

