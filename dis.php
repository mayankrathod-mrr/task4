<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "task";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT name, review, rating FROM reviews";
$result = $conn->query($sql);


$avg_sql = "SELECT AVG(rating) as avg_rating FROM reviews";
$avg_result = $conn->query($avg_sql);
$avg_row = $avg_result->fetch_assoc();
$average_rating = round($avg_row["avg_rating"], 1);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews and Ratings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
            body{
            font-family: Arial, sans-serif;
            background-image: linear-gradient(to right , #bbc5e7, #919eb6, #5b96b1, #416fb4, #0068a4);
    background-size: cover;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 90vh;
    margin: 0;
}
.container {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border-radius: 10px;
    padding: 20px;
    max-width: 400px;
    width: 100%;
    align-items: center;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .list_group:hover {
            background-color: #e6b800;
        }
</style>
<body>
    <div class="container">
        <h2>Average Rating: <?php echo $average_rating; ?> ★</h2>
        <h3>All Reviews</h3>
        <ul class="list-group">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<li class="list-group-item">';
                    echo '<strong>' . $row["name"] . '</strong>: ';
                    echo $row["review"] . ' - ';
                    echo str_repeat('★', $row["rating"]) . str_repeat('☆', 5 - $row["rating"]);
                    echo '</li>';
                }
            } else {
                echo "<p>No reviews yet.</p>";
            }
            ?>
        </ul>
    </div>
</body>
</html>

<?php
$conn->close();
?>
