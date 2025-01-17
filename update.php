<?php
    require_once("dbinfo.php");   
    
    $database = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        /* determine if connection was successful */
        if( mysqli_connect_errno() != 0 ){
            die("<p>Could not connect to DB</p>");	
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/styles.css">
    <title>PHP Final Project</title>
</head>
<body>
<div id="wrapper">
<header>
    <h1> Update a Record - Leibrandt Austria & Nicholas Neophytou</h1>
</header>
    <main>      
        <section>
<p>Welcome to the database</p>
<?php
require_once("security.php");
?>
<p>Add records below</p>
        </section>
        <section>
            <p><a href="site.php">View Records</a></p>
            <p><a href="add.php">Add to table</a></p>
            <p><a href="update.php">Update a record</a></p>
            <p><a href="delete.php">Delete a record</a></p>
        </section>


    <section>
            <a href="logout.php" class="logout">Logout</a>  
            </section>   
    </main>
    <footer>
        <p>Copyright 2025 <span>&copy;</span> - Leibrandt Austria & Nicholas Neophytou</p>
    </footer>

</div>
    
</body>
</html>