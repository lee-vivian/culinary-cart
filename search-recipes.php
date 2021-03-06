<!DOCTYPE html>

<?php
// Connect to SQL database
include("connect.php");

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

    <?php include("navbar.html"); ?>

  <div style="margin-left:18%;padding:1px 16px;height:1000px;">

    <h1>Search Recipes<br><br></h1>

    <table id = 'recipes-table' class = "data-table">
      <caption class = "title">Recipes</caption>
      <thead>
        <tr>
          <th>  </th>
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
          $rID = $row['recipe_id'];
          $rName = $row['recipe_name'];
          $viewLink = 'display-recipe.php?rid='.$rID;
          $editLink = 'edit-recipe.php?rid='.$rID;
        echo "<tr>
               <td><a href='".$viewLink."'>View</a>/<a href='".
                $editLink."'>Edit</a></td>
          		 <td>".$rID.'</td>
               <td class = "description">'.$rName.'</td>
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
