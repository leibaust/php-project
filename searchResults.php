<?php
require("dbinfo.php");
session_start();

    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    /* determine if connection was successful */
    if( mysqli_connect_errno() != 0 ){
        die("<p>Could not connect to DB</p>");	
    }
    $studentNumber = isset($_POST['studentnum']) ? trim($_POST['studentnum']) : '';
    $firstname = isset($_POST['firstname']) ? trim($_POST['firstname']) : '';
    $lastname = isset($_POST['lastname']) ? trim($_POST['lastname']) : '';
    $errorsDiscovered = [];
    $result = null;
    
    // Validation
    if (empty($studentNumber) && empty($firstname) && empty($lastname)) {
        $errorsDiscovered[] = "Please fill in at least one field to search.";
    } 
    else {
        if (!empty($studentNumber)) {
            $searchQuery = "SELECT id, firstname, lastname FROM students WHERE id='$studentNumber';";
        } elseif (!empty($firstname)) {
            $searchQuery = "SELECT id, firstname, lastname FROM students WHERE firstname= '$firstname';";
        } elseif (!empty($lastname)) {
            $searchQuery = "SELECT id, firstname, lastname FROM students WHERE lastname='$lastname';";
        }
    
        // Execute the query
        $result = $mysqli->query($searchQuery);
    }
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
            <section>
                <?php
                require_once("security.php");
                ?>
            <p><a href="site.php">Show all students</a></p>
            <p><a href="search.php">Search</a></p>
            </section>
            <h2>Results</h2>
            <?php  
            // Display error messages, if any
            if (!empty($errorsDiscovered)) {
                echo "<ul>";
                foreach ($errorsDiscovered as $error) {
                    echo "<li>" . $error . "</li>";
                }
                echo "</ul>";
            } elseif ($result && $result->num_rows > 0) {
                // Display records found
                echo "<p>Record(s) found:</p>";
                echo "<table border='1'>";
                echo "<tr><th>Student Number</th><th>First Name</th><th>Last Name</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . ($row['id']) . "</td>";
                    echo "<td>" . ($row['firstname']) . "</td>";
                    echo "<td>" . ($row['lastname']) . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No records found.</p>";
            }
            ?>

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
    