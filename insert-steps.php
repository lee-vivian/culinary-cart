<?php

// Connect to SQL database
include("connect.php");

$stepNum = $_POST['stepNum'];
$description = "'" . $_POST['description'] . "'";

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

header('Location: add-steps.php');
 ?>
