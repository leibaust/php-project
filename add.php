<?php
session_start();
require_once("dbinfo.php");

// if connecting is good continue
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    // error check if fail
    if ($conn->connect_errno) {
        die("<p>Could not connect to DB: " . $conn->connect_error . "</p>");
    }

    // protect from sql injection
    $id = $conn->real_escape_string($_POST['id']);
    $firstname = $conn->real_escape_string($_POST['firstname']);
    $lastname = $conn->real_escape_string($_POST['lastname']);

    $checkSql = "SELECT * FROM students WHERE id='$id'";
    $result = $conn->query($checkSql);

    if ($result->num_rows > 0) {
        $_SESSION['messages'][] = "Error: Student ID $id already exists. Choose a different ID.";
    } else {
        $sql = "INSERT INTO students (id, firstname, lastname) VALUES ('$id', '$firstname', '$lastname')";

        if ($conn->query($sql) === TRUE) {
            // Success message if student is added
            $_SESSION['messages'][] = "Student added successfully with ID $id!";
            header("Location: site.php"); // Redirect to site.php on success
            exit();
        } else {
            $_SESSION['messages'][] = "Error adding student: " . $conn->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/styles.css">
    <title>Add Student - PHP Final Project</title>
</head>

<body>
    <div>
        <header>
            <h1>Add New Student</h1>
        </header>
        <main>
            <section>
                <p><a href="site.php">Back to Student List</a></p>
            </section>
            <section>
                <?php
                if (isset($_SESSION['messages'])) {
                    foreach ($_SESSION['messages'] as $message) {
                        echo "<p>$message</p>";
                    }
                    unset($_SESSION['messages']);
                }
                ?>
                <form action="add.php" method="POST">
                    <label for="id">Student ID</label>
                    <input type="text" name="id" id="id" required>
                    <br>
                    <label for="firstname">First Name:</label>
                    <input type="text" name="firstname" id="firstname" required>
                    <br>
                    <label for="lastname">Last Name:</label>
                    <input type="text" name="lastname" id="lastname" required>
                    <br>
                    <button type="submit">Add Student</button>
                </form>
            </section>
        </main>
        <footer>
            <p>Copyright 2025 <span>&copy;</span> - Leibrandt Austria & Nicholas Neophytou</p>
        </footer>
    </div>
</body>

</html>
