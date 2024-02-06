<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aniclo";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $conn->real_escape_string($_POST['email']);
$name = $conn->real_escape_string($_POST['name']);
$suggestions = $conn->real_escape_string($_POST['suggestions']);

$sql = "INSERT INTO suggestions (name, email, suggestions) VALUES ('$name', '$email', '$suggestions')";


if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Thank you, $name, for submitting your suggestion. Have a nice day!'); window.location.href = 'index.html';</script>";
} else {
    echo "<script>alert('Error: " . $sql . "\\n" . $conn->error . "'); window.location.href = 'index.html';</script>";
}

$conn->close();
?>
