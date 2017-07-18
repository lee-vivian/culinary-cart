<!DOCTYPE html>

<?php
// Connect to MySQL Database
$servername = "127.0.0.1";
$username = "root";
$password = "root";
$dbname = "michef";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Queries
$sql = 'SELECT recipe_id, recipe_name, cuisine, num_servings, diet_restriction, prep_time, cook_time, recipe_type
        FROM recipes';

$query = mysqli_query($conn, $sql);

if (!query) {
  die ('SQL Error: ' . mysqli_error($conn));
}

// Check the connection
//echo "Connected successfully";
 ?>

<html>
  <head>
    <title>Search Recipes</title>

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
      <a href="converter.php">Converter</a>
      <a href="aboutus.html">About Us</a>
    </nav>

  <div style="margin-left:18%;padding:1px 16px;height:1000px;">

    <h1>Search Recipes<br><br></h1>

    <table class = "data-table">
      <caption class = "title">Recipes</caption>
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Cuisine</th>
          <th>Servings</th>
          <th>Dietary Restrictions</th>
          <th>Prep Time</th>
          <th>Cook Time</th>
          <th>Type</th>
        </tr>
      </thead>
      <tbody>

        <?php
        while ($row = mysqli_fetch_array($query))
        {
          echo '<tr>
          					<td>'.$row['recipe_id'].'</td>
                    <td class = "description">'.$row['recipe_name'].'</td>
                    <td>'.$row['cuisine'].'</td>
                    <td>'.$row['num_servings'].'</td>
                    <td>'.$row['diet_restriction'].'</td>
                    <td>'.$row['prep_time'].'</td>
                    <td>'.$row['cook_time'].'</td>
                    <td>'.$row['recipe_type'].'</td>
          				</tr>';
        }?>
      </tbody>
    </table>


  </div>

  </body>
</html>
