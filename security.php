<?php
session_start();
require_once 'dbinfo.php';  // Include the database connection info
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: index.php");  // Redirect to login if not logged in
    exit();
} else {
    echo "<p>Hello <strong>" . ucfirst(strtolower($_SESSION['username'])) . "</strong>. Your account is verified</p>";
}

$username = $_SESSION['username'];  // Get the logged-in username

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$timeout = 3600;  // Set session timeout limit (in seconds)

if (isset($_SESSION['last_activity'])) {
    // If the session has been idle for longer than the timeout period, destroy the session
    if ((time() - $_SESSION['last_activity']) > $timeout) {
        if (!isset($_SESSION['messages'])) {
            $_SESSION['messages'] = [];
        }
        $_SESSION['messages'][] = "<p>$username logged out due to inactivity</p>";
        header("Location: logout.php");  // Redirect to login page
        exit();
    }
}

// Update the last activity timestamp on every page load to track session time
$_SESSION['last_activity'] = time();
