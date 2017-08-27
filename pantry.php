<!DOCTYPE html>

<?php
// Connect to SQL database
include("connect.php");

// Queries
$sql = 'SELECT ingredient_name, quantity, unit_type, weight_unit, volume_unit
        FROM pantry';

$query = mysqli_query($conn, $sql);

if (!query) {
  die ('SQL Error: ' . mysqli_error($conn));
}

// Check the connection
//echo "Connected successfully";
 ?>

<html>
  <head>
    <title>My Pantry</title>

    <link href = "style.css" type = "text/css" rel = "stylesheet">
    <link href = "table-style.css" type = "text/css" rel = "stylesheet">
  </head>

  <body>

    <?php include("navbar.html"); ?>

  <div style="margin-left:18%;padding:1px 16px;height:1000px;">

    <h1>My Pantry<br><br></h1>

    <table class = "data-table">
      <caption class = "title">Ingredients</caption>
      <thead>
        <tr>
          <th>Name</th>
          <th>Quantity</th>
          <th>Unit</th>
        </tr>
      </thead>
      <tbody>

        <?php
        while ($row = mysqli_fetch_array($query))
        {

         $unit;

         if (strcmp($row['unit_type'], "count") == 0) {
           $unit = "units";
         }
         elseif(strcmp($row['unit_type'], "weight") == 0) {
           $unit = $row['weight_unit'];
         }
         else {
           $unit = $row['volume_unit'];
         }

          echo '<tr>
          					<td class = "description">'.$row['ingredient_name'].'</td>
                    <td>'.$row['quantity'].'</td>
                    <td>'.$unit.'</td>
          				</tr>';

        }?>
      </tbody>
    </table>


  </div>

  </body>
</html>
