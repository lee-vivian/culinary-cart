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

// Queries
$sql = 'SELECT meal_plan_id, recipe_id, recipe_name, which_day
        FROM meal_plan';

$query = mysqli_query($conn, $sql);

if (!query) {
  die ('SQL Error: ' . mysqli_error($conn));
}

// Check the connection
//echo "Connected successfully";
 ?>

<html>
  <head>
    <title>Weekly Plan</title>

    <link href = "style.css" type = "text/css" rel = "stylesheet">
    <link href = "table-style.css" type = "text/css" rel = "stylesheet">
  </head>

  <body>

    <?php include("navbar.html"); ?>

  <div style="margin-left:18%;padding:1px 16px;height:1000px;">

    <h1>My Meal Plan<br><br></h1>

    <table class = "data-table">
      <caption class = "title">Wishlist</caption>
      <thead>
        <tr>
          <th>Meal ID</th>
          <th>Recipe ID</th>
          <th>Recipe</th>
          <th>Day</th>
        </tr>
      </thead>
      <tbody>
        <?php
        while($row = mysqli_fetch_array($query))
          echo '<tr>
                 <td>'.$row['meal_plan_id'].'</td>
                 <td>'.$row['recipe_id'].'</td>
                 <td>'.$row['recipe_name'].'</td>
                 <td>'.$row['which_day'].'</td>
               </tr>';
         ?>
      </tbody>
    </table>


  </div>

  </body>
</html>
