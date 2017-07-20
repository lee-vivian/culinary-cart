<!DOCTYPE html>

<?php
//
// Connect to MySQL Database
$servername = "127.0.0.1";
$username = "root";
$password = "root";
$dbname = "michef";

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

$sql = sprintf('INSERT INTO recipes(recipe_id, recipe_name, username, prep_time,
  cook_time, cuisine, diet_restriction, recipe_type, num_servings)
  VALUES (0, %s, "abc123", %d, %d, %s, %s, %s, %d)',
  $name, $prep, $cook, $cuisine, $diet, $type, $servings);

  $query = mysqli_query($conn, $sql);

  if (!query) {
    die ('SQL Error: ' . mysqli_error($conn));
  }
  else {
    //echo "New record inserted successfully: " . $sql;
  }

  $sql = 'SELECT recipe_id
    FROM recipes
    ORDER BY recipe_id DESC
    LIMIT 1';

  $query = mysqli_query($conn, $sql);
  if (!query) {
    die ('SQL Error: ' . mysqli_error($conn));
  }
  else {
    //echo "Found most recent recipe_id successfully";
  }
 ?>

<html>

<head>
  <title>Add Ingredients</title>

  <link href = "style.css" type = "text/css" rel = "stylesheet">
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
    <a href="converter.php">Converter</a>
    <a href="aboutus.html">About Us</a>
  </nav>

<div style="margin-left:18%;padding:1px 16px;height:1000px;">

  <div class = "add-ingredients">

    <h1>Add Ingredients</h1>

    <form action = "add-steps.php" method = "post">
      Ingredient Name:<br>
        <input type = "text" name = "iname" placeholder="Ingredient" required>
        <br><br>
      Quantity:<br>
        <input type = "number" name = "quantity" min = "0" placeholder="0.00" required>
        <br><br>
      Unit Type:<br><br>
        <input type = "radio" name = "unitType" value="count" checked> Count<br>
        <input type = "radio" name = "unitType" value="weight"> Weight<br>
        <input type = "radio" name = "unitType" value="volume"> Volume
        <br><br>
      Weight Unit:<br>
      <select name = "weightUnit">
        <option value = "null">n/a</option>
        <option value = "lb">lb</option>
        <option value = "oz">oz</option>
        <option value = "g">g</option>
        <option value = "kg">kg</option>
      </select>
      <br><br>
      Volume Unit:<br>
      <select name = "volumeUnit">
        <option value = "null">n/a</option>
        <option value = "tsp">tsp</option>
        <option value = "tbsp">tbsp</option>
        <option value = "cup">cup</option>
        <option value = "pint">pint</option>
        <option value = "qt">quart</option>
        <option value = "gal">gal</option>
        <option value = "fl oz">fl oz</option>
        <option value = "l">liter</option>
        <option value = "cubic in">cubic in</option>
      </select>
      <br><br>
      <input type = "submit" value = "Next">
      <input type = "reset" value = "Clear">
    </form>

  <?php
    while ($row = mysqli_fetch_array($query)){
      $id = $row['recipe_id'];
    }

    //echo "RECIPE ID: ".$id;

   ?>

    <!--REG BUTTON = ADD Ingredient to php array, SUBMIT BUTTON = DONE/GO TO INSERT STEPS PG-->

  </div>

</div>

</body>
</html>
