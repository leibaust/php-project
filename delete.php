<?php
session_start();
require_once 'dbinfo.php';
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the record to get details for the message
    $result = $conn->query("SELECT * FROM students WHERE id='$id'");
    $record = $result->fetch_assoc();

    $sql = "DELETE FROM students WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        $affectedRows = $conn->affected_rows;
        $_SESSION['messages'][] = "Record with ID $id was deleted. $affectedRows row(s) affected.";
        header("Location: site.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>