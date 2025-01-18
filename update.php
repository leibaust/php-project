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
                <p><a href="site.php">Home</a></p>
                <p><a href="add.php">Add Record</a></p>
            </section>
            <section>
                <?php
                require_once("security.php");
                require_once 'dbinfo.php';
                $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

                if (isset($_GET['id'])) {
                    $id = $conn->real_escape_string($_GET['id']);


                    // Fetch the current record
                    $result = $conn->query("SELECT * FROM students WHERE id='$id'");
                    $record = $result->fetch_assoc();
                }

                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $id = $conn->real_escape_string($_POST['id']);
                    $new_id = $conn->real_escape_string($_POST['new_id']);
                    $firstname = $conn->real_escape_string($_POST['firstname']);
                    $lastname = $conn->real_escape_string($_POST['lastname']);

                    // Check if new ID is unique
                    $check_result = $conn->query("SELECT * FROM students WHERE id='$new_id'");
                    if ($check_result->num_rows > 0 && $new_id != $id) {
                        $_SESSION['messages'][] = "Student ID $new_id already exists. Please choose a unique ID.";
                        header("Location: site.php");
                        exit();
                    }

                    // Update the record
                    $sql = "UPDATE students SET id='$new_id', firstname='$firstname', lastname='$lastname' WHERE id='$id'";
                    if ($conn->query($sql) === TRUE) {
                        $_SESSION['messages'][] = "Record with ID $id was updated to $new_id.";
                        header("Location: site.php");
                        exit();
                    } else {
                        echo "Error updating record: " . $conn->error;
                    }
                }
                ?>
                <p>Update Information Below</p>
            </section>

            <section>
                <form action="update.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $record['id']; ?>">
                    <div>
                        <label for="new_id">Student ID</label>
                        <input type="text" name="new_id" id="new_id" value="<?php echo $record['id']; ?>">
                    </div>
                    <div>
                        <label for="firstname">Firstname</label>
                        <input type="text" name="firstname" id="firstname" value="<?php echo $record['firstname']; ?>">
                    </div>
                    <div>
                        <label for="lastname">Lastname</label>
                        <input type="text" name="lastname" id="lastname" value="<?php echo $record['lastname']; ?>">
                    </div>
                    <input type="submit" value="Update">
                </form>
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