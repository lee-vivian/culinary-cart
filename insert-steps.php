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

$stepNum = $_POST['stepNum'];
$description = "''" . $_POST['description'] . "''";

$sql = 'SELECT recipe_id
  FROM recipes
  ORDER BY recipe_id DESC
  LIMIT 1';

$query = mysqli_query($conn, $sql);
if (!query) {
  die ('SQL Error: ' . mysqli_error($conn));
}

while ($row = mysqli_fetch_array($query)){
  $recipe_id = $row['recipe_id'];
}

$sql = sprintf('INSERT INTO steps(recipe_id, step_num, description)
  VALUES(%d,%d,%s)',$recipe_id, $stepNum, $description);

$query = mysqli_query($conn, $sql);

if (!query) {
  die ('SQL Error: ' . mysqli_error($conn));
}

header('Location: add-steps.html');
 ?>
