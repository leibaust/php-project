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
    <h1> Record View - Leibrandt Austria & Nicholas Neophytou</h1>
</header>
    <main>      
        <section>
<?php
require_once("security.php"); 
?>
        </section>
        <section>
            <p><a href="site.php">View Records</a></p>
            <p><a href="add.php">Add to table</a></p>
            <p><a href="update.php">Update a record</a></p>
            <p><a href="delete.php">Delete a record</a></p>
        </section>

    <?php

    //query the database for all students and order by lastname
    $query = "SELECT id, firstname, lastname FROM students ORDER BY lastname DESC ";
    $result = $database->query( $query );
    
    
    /*
    --------------------------------
    process query results
    --------------------------------
    */
    /* since this was a SELECT query, there may be several 
        records in the result. the num_rows property will 
        return an integer describing how many 
    */
    $numberOfRecordsInResult = $result->num_rows;
    echo "<p>Total Records:".$numberOfRecordsInResult ."</p>";
    
    /* 
        process SELECT query results 
        iterate over the result set
        each call to fetch_row() will return the next record as an Array
    */
    echo "<table>"; //ouput the table data as an HTML table, of course!
    
    /*
    we can use fetch_fields() to access field names
    which can be used as table headings for more semantic HTML
    */
    $arrayOfFieldNames =  $result->fetch_fields();	//get an array of 'field' Objects
    echo "<tr>";
    foreach($arrayOfFieldNames  as $oneFieldAsAnObject){	 //loop through the array
        //each item in this array is an Object
        //so use the -> operator to access the Object's values...
        echo "<th>" . $oneFieldAsAnObject->name . "</th>";		 
    }
    echo "</tr>";
    
    //now that the table headings are displayed, 
    ///we can iterate over each record (one per row)
    while( $oneRecord = $result->fetch_row() ){
        echo "<tr>";
        foreach($oneRecord as $field){
            echo "<td>" .$field . "</td>"; 
        }
        echo "</tr>";	
    }
    echo "</table>";
    ?>
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