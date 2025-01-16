<?php 
include_once 'dbinfo.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/styles.css">
    <title>Assignment 10</title>
</head>
<body>
<div id="wrapper">
<header>
    <h1> Sign In </h1>
</header>
<main>
    <section>
    <?php
//check to see if there are any errors
if( isset($_SESSION['errorMessages']) ){
    //if so, display the error messages
    echo $_SESSION['errorMessages'];
    //clear the error message after we display it,
    //so that we dont later on read the same error and think its new 
    unset($_SESSION['errorMessages']);
}
?>
        <p>Enter account details below</p>
    <form action="authenticator.php" method="post">
    <div>
        <label for="username">Username</label>
        <input type="text" name="username" id="username">
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
    </div>

    <input type="submit" value="Submit">
        </form>
        </section>

</main>
<footer>
        <p>Copyright 2025 <span>&copy;</span> - Leibrandt Austria</p>
    </footer>

</div>
    
</body>
</html>