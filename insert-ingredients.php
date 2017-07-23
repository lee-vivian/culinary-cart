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

$iname = "'" . $_POST['iname'] . "'";
$quantity = $_POST['quantity'];
$unitType = "'" . $_POST['unitType'] . "'";
$weightUnit = "'" . $_POST['weightUnit'] . "'";
$volumeUnit = "'" . $_POST['volumeUnit'] . "'";

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

$sql = sprintf('INSERT INTO ingredients(ingredient_name, quantity, unit_type,
  weight_unit, volume_unit, recipe_id) VALUES (%s,%d,%s,%s,%s,%d)',
  $iname, $quantity, $unitType, $weightUnit, $volumeUnit, $recipe_id);

$query = mysqli_query($conn, $sql);

if (!query) {
  die ('SQL Error: ' . mysqli_error($conn));
}

header('Location: add-ingredients.html');
?>
