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

  // Link to edit recipe
  $editLink = "'update-recipe.php?rid=".$recipe_id."&action=edit'";

  // Get recipe fields
  $sql = sprintf('SELECT recipe_name, prep_time, cook_time, cuisine, diet_restriction,
                  recipe_type, num_servings
                  FROM recipes
                  WHERE recipe_id = %s',$recipe_id);

  $query = mysqli_query($conn, $sql);
  if (!query) {
    die ('SQL Error: ' . mysqli_error($conn));
  }

  while ($row = mysqli_fetch_array($query)){
    $recipe_name = $row['recipe_name'];
    $prep_time = $row['prep_time'];
    $cook_time = $row['cook_time'];
    $cuisine = $row['cuisine'];
    $diet_restriction = $row['diet_restriction'];
    $recipe_type = $row['recipe_type'];
    $num_servings = $row['num_servings'];
  }

  // Select input form function to select proper default value
  function selectDefault($input, $actual) {
    if ($input == $actual) {
      $selected = ' selected';
    }
    else {
      $selected = '';
    }
    echo "<option value = '" . $input . "'>" . $input . "</option>";
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

     <h3>Overview:</h3>

     <form action = <?php echo $editLink?> method = "post">
       Recipe Name:<br>
         <input type = "text" name = "name" value = <?php echo "'" . $recipe_name . "'"?> required> <br><br>
       Prep Time:<br>
         <input type = "number" name = "prep" min = "0" value = <?php echo $prep_time?> required> min.<br><br>
       Cook Time:<br>
         <input type = "number" name = "cook" min = "0" value = <?php echo $cook_time?> required> min.<br><br>
       Cuisine:<br>
         <input type = "text" name = "cuisine" value = <?php echo "'" . $cuisine . "'"?>>
       <br><br>
       Dietary Restrictions:<br>
       <select name = "diet">
         <?php selectDefault("none", $diet_restriction)?>
         <?php selectDefault("vegetarian", $diet_restriction)?>
         <?php selectDefault("vegan", $diet_restriction)?>
         <?php selectDefault("gluten free", $diet_restriction)?>
         <?php selectDefault("kosher", $diet_restriction)?>
         <?php selectDefault("pescetarian", $diet_restriction)?>
         <?php selectDefault("nut allergies", $diet_restriction)?>
      </select>
       <br><br>
       Recipe Type:<br>
       <select name = "type">
         <?php selectDefault("meal", $recipe_type)?>
         <?php selectDefault("drink", $recipe_type)?>
         <?php selectDefault("snack", $recipe_type)?>
       </select>
       <br><br>
       Servings:<br>
         <input type = "number" name = "servings" min = "1" value = <?php echo $num_servings?> required>
       <br><br>

    <h3>Ingredients:</h3>

    <?php
    /*
    // Get recipe ingredients array
    $sql = sprintf('SELECT ingredient_name, quantity, unit_type, weight_unit, volume_unit
                    FROM ingredients
                    WHERE recipe_id = %s',$recipe_id);
    $query = mysqli_query($conn, $sql);
    if (!query) {
      die ('SQL Error: ' . mysqli_error($conn));
    }

    while ($row = mysqli_fetch_array($query)) {

    }
     ?>
    <br><br>
    <h3>Steps:</h3>

    <?php
    // Get recipe steps array
    $sql = sprintf('SELECT step_num, description
                    FROM steps
                    WHERE recipe_id = %s
                    ORDER BY step_num',$recipe_id);
    $query = mysqli_query($conn, $sql);
    if (!query) {
      die ('SQL Error: ' . mysqli_error($conn));
    }
    while ($row = mysqli_fetch_array($query)) {

    }
    */
     ?>

       <input type = "submit" value = "Save Changes">
       <input type = "reset" value = "Undo Changes">
     </form>

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