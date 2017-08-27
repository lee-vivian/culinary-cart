<!DOCTYPE html>

<?php

  // Connect to SQL database
  include("connect.php");

  // Get recipe id
  $recipe_id = $_GET['rid'];

  // Get recipe name
  $sql = sprintf('SELECT recipe_name
                  FROM recipes
                  WHERE recipe_id = %s',$recipe_id);

  $query = mysqli_query($conn, $sql);
  if (!query) {
    die ('SQL Error: ' . mysqli_error($conn));
  }

  while ($row = mysqli_fetch_array($query)){
    $recipe_name = $row['recipe_name'];
  }
?>

<html>
<head>
  <title><?php echo $recipe_name ?></title>

  <link href = "style.css" type = "text/css" rel = "stylesheet">
  <link href = "table-style.css" type = "text/css" rel = "stylesheet">
</head>

<body>

  <nav>
    <a href = "index.html">Home</a>
    <li class = "dropdown">
      <a href="#" class = "dropbtn">Recipes</a>
      <div class = "dropdown-content">
        <a href = "search-recipes.php">Search</a>
        <a href = "add-recipe.html">Add</a>
      </div>
    </li>
    <a href="pantry.php">Pantry</a>
    <a href="plan.php">Weekly Plan</a>
    <a href="list.php">Grocery List</a>
    <a href="history.php">History</a>
    <a href="convert-units.html">Converter</a>
    <a href="aboutus.html">About Us</a>
  </nav>

<div style="margin-left:18%;padding:1px 16px;height:1000px;">

  <h1><?php echo $recipe_name ?><br><br></h1>

  <h3>Ingredients:</h3>
      <?php
      // Get recipe ingredients
      $sql = sprintf("SELECT ingredient_name, quantity, unit_type, weight_unit, volume_unit
                      FROM ingredients
                      WHERE recipe_id = %s",$recipe_id);
      $query = mysqli_query($conn, $sql);
      if (!query) {
        die ('SQL Error: ' . mysqli_error($conn));
      }

      echo '<ul>';

      while ($row = mysqli_fetch_array($query)) {
        $unit_type = $row['unit_type'];
        switch($unit_type) {
          case "weight":
            $unit = $row['weight_unit'];
            break;
          case "volume":
            $unit = $row['volume_unit'];
            break;
          default:
            $unit = "";
            break;
        }

        echo "<li>" . $row['quantity'] . " " . $unit . " " .
          $row['ingredient_name'] . "</li>";
      }
      echo "</ul>";
     ?>

  <h3>Steps:</h3>
  <?php
    // Get recipe steps
    $sql = sprintf('SELECT description
                    FROM steps
                    WHERE recipe_id = %s
                    ORDER BY step_num',$recipe_id);
    $query = mysqli_query($conn, $sql);
    if (!query) {
      die ('SQL Error: ' . mysqli_error($conn));
    }
    echo "<ol>";
    while ($row = mysqli_fetch_array($query)) {
      echo "<li>" . $row['description'] . "</li>";
    }
    echo "</ol>";
   ?>

</div>
</body>
</html>
