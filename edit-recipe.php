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
  <title>Edit: <?php echo $recipe_name ?></title>

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
    <h1>Edit: <?php echo $recipe_name ?><br><br></h1>

    <h3>Ingredients:</h3>

    <h3>Steps:</h3>

     <button type = "button" onclick = "deleteRecipe('<?php echo $recipe_id?>','<?php echo $recipe_name?>')">Delete Recipe</button>

    <script>
      function deleteRecipe(recipe_id, recipe_name) {
        var msg = "Are you sure you want to delete: " + recipe_name + "?";
        var updateWindow = "update-recipe.php?rid=" + recipe_id + "&action=delete";
        if (confirm(msg)) {
          window.location = updateWindow;
        }
        else {
          window.location = "search-recipes.php";
        }
      }
    </script>

  </div>
</body>

</html>
