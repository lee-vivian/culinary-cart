<!DOCTYPE html>

<?php
// Connect to MySQL Database
$servername = "127.0.0.1";
$username = "root";
$password = "root";
$dbname = "culinarycart";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$recipe_id = $_GET['rid'];
$action = $_GET['action'];

if ($action == 'delete') {
  $sql = sprintf('DELETE FROM recipes WHERE recipe_id = %d', $recipe_id);
}
$query = mysqli_query($conn, $sql);
if (!query) {
  die ('SQL Error: ' . mysqli_error($conn));
}

// Jump back to search-recipes.php
 ?>
