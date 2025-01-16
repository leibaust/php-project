<?php
session_start();
require_once("dbinfo.php"); 
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

//Form information variables & error messages
$username = "";
$password = "";
$errorMessages = array();

// Check for connection errors
if (mysqli_connect_errno() != 0) {
    die("<p>Could not connect to database</p>");
}

//Check Form Data
if( isset($_POST['username']) &&  
    isset($_POST['password']) ){

    //normalize the form data,
    //store in local variables
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    //validate form data
    if(empty($username) ){
        //add a message to the errors array
        $errorMessages[] = "Fill in the username field.";
    }
    if(empty($password) ){
        //add a message to the errors array
        $errorMessages[] = "Fill in the password field.";
    }
    
}else{
    $errorMessages[] = "Please log in to access the content.";
}

//see if any errors were detected
if (empty($errorMessages)) {
    $query = "SELECT username, password FROM users WHERE BINARY username='$username';";
    $result = $mysqli->query($query);

    // Check if username exists
    if ($result->num_rows > 0) {
        $record = $result->fetch_assoc(); // Fetch result as an associative array
        if($password === $record['password']) {
            // Successful login
            $_SESSION['username'] = $username;
            $_SESSION['time-logged-in'] = time();
            $_SESSION['time-last-active'] = time();

            // Forward to site
            header("location: site.php");
            exit;
        } else {
            $errorMessages[] = "Incorrect password for user: $username";
        }
    } else {
        $errorMessages[] = "$username not found";
    }
}

// Handle errors or login
if (!empty($errorMessages)) {
    // Save errors in the session and redirect
    $_SESSION['messages'] = $errorMessages;
    header("location: index.php");
    exit;
}
?>
