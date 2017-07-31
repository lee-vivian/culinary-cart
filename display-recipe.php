<!DOCTYPE html>

<?php
  $recipe_id;
  $recipe_name;
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

</div>
</body>
</html>
