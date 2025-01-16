<?php
    session_start();
    require_once("config.php");
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
    // ensure user is allowed to view this page
    require_once("security.php");
    if(isset($_SESSION['messages'])){    
        echo "<ul>";
        foreach($_SESSION['messages'] as $message){
            echo "<li>$message</li>";
        }
        echo "</ul>";
        unset($_SESSION['messages']);
    }   
    
    ?>
            <a href="site.php">Show All Students</a>
        <br>
        <a href="search.php">Search</a>
    </section>    

    <section>  
        <h2>Search</h2>
        <p>Only 1 field required</p>
        <form action="searchResults.php" method="post">
            <fieldset>
        <div>
            <label for="studentnum">Student Number</label>
            <input type="text" name="studentnum" id="studentnum">
        </div>
        <div>
            <label for="firstname">First Name</label>
            <input type="text" name="firstname" id="firstname">
        </div>
        <div>
            <label for="lastname">Last Name</label>
            <input type="text" name="lastname" id="lastname">
        </div>
        <input type="submit" value="Submit">
        </fieldset>
        </form>
        </section> 
        <section>
            <a href="logout.php" class="logout">Logout</a>  
            </section> 
    </main>
    <footer>
        <p>Copyright 2025 <span>&copy;</span> - Leibrandt Austria</p>
    </footer>

</div>
    
</body>
</html>
</html>