<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "task"; 

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST["name"]);
    $review = $conn->real_escape_string($_POST["review"]);
    $rating = intval($_POST["rating"]);

    
    if ($name && $review && $rating >= 1 && $rating <= 5) {
        $sql = "INSERT INTO reviews (name, review, rating) VALUES ('$name', '$review', $rating)";

        if ($conn->query($sql) === TRUE) {
            echo"<BR><h1>Thank You !</h1><br>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Invalid input.";
    }
}

$conn->close();
?>
<style>
            body{
            font-family: Arial, sans-serif;
            background-image:   radial-gradient(at 47% 33%, hsl(162.00, 77%, 40%) 0, transparent 59%), 
            radial-gradient(at 82% 65%, hsl(218.00, 39%, 11%) 0, transparent 55%);
    background-size: cover;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 90vh;
    margin: 0;
}

    h1{
        font-size: 62px;
        text-align: center;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
    }
 
</style>