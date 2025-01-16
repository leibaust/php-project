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

//see if there are messages to display
if(isset($_SESSION['messages'])){    
    echo "<ul>";
    foreach($_SESSION['messages'] as $message){
        echo "<li>$message</li>";
    }
    echo "</ul>";

    //now that they'ev been displayed,
    //clear them from the session
    unset($_SESSION['messages']);
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