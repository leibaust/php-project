<?php
    //resume session
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
    <h1> Student Database </h1>
</header>
    <main>    
    <section>
    <?php
    // prevents fatal errors if page is refreshed or re-accessed after logout
    try {
        if (!isset($_SESSION['username'])) {
            throw new Exception("page accessed after session ended, no username found");
        }
        $username = $_SESSION['username'];  // Get the logged-in username
    } catch (Exception $e) {
        $username = "guest";
    }
//see if there are messages to display
if(isset($_SESSION['messages'])){    

    foreach($_SESSION['messages'] as $message){
        echo "$message";
    }

     
    //now that they'ev been displayed,
    //clear them from the session
    unset($_SESSION['messages']);
}

//clear session variables
$_SESSION = array();
//end session



        
        echo "<p>Thanks for stopping by $username, you have successfully logged out.</p>";
        session_destroy();
        ?> 
        <p><a href="index.php">Login</a></p>
    </section>        
    </main>
    <footer>
        <p>Copyright 2025 <span>&copy;</span> - Leibrandt Austria</p>
    </footer>

</div>
    
</body>
</html>
</html>