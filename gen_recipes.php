<?php

// Connect to SQL database
include("connect.php");

echo "Connected successfully";

// Queries
$recipesql = 'SELECT recipe_id
        FROM recipes';

$recipequery = mysqli_query($conn, $recipesql);

if (!recipequery) {
  die ('SQL Error: ' . mysqli_error($conn));
}

echo "Recipe query ok";

$ingredientssql = 'SELECT *
        FROM ingredients';

$ingredientsquery = mysqli_query($conn, $ingredientssql);

if (!ingredientsquery) {
  die ('SQL Error: ' . mysqli_error($conn));
}

echo "Ingredients query ok";

// Call proc


 ?>
