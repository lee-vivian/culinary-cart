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

$name = "'" . $_POST['name'] . "'";
$prep = $_POST['prep'];
$cook = $_POST['cook'];
$cuisine = "'" . $_POST['cuisine'] . "'";
$diet = "'" . $_POST['diet'] . "'";
$type = "'" . $_POST['type'] . "'";
$servings = $_POST['servings'];
$username = "'abc123'";

$sql = sprintf('INSERT INTO recipes(recipe_id, recipe_name, username, prep_time,
  cook_time, cuisine, diet_restriction, recipe_type, num_servings)
  VALUES (0, %s, %s, %d, %d, %s, %s, %s, %d)',
  $name, $username, $prep, $cook, $cuisine, $diet, $type, $servings);

  $query = mysqli_query($conn, $sql);

  if (!query) {
    die ('SQL Error: ' . mysqli_error($conn));
  }

header('Location: add-ingredients.php');

 ?>
