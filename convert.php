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

$uB = $_POST['unitBefore'];
$uA = $_POST['unitAfter'];

$unitType = "'" . $_POST['unitType'] . "'";
$quantity = $_POST['quantity'];
$unitBefore = "'" . $uB . "'";
$unitAfter = "'" . $uA . "'";

if ($unitType == ("'" . weight . "'")) {
  $sql = sprintf("SELECT measurement_converter(%s,%d,%s,%s,%s,%s) AS 'result'",
    $unitType, $quantity, $unitBefore, $unitAfter, 'null', 'null');
}
else {
  $sql = sprintf("SELECT measurement_converter(%s,%d,%s,%s,%s,%s) AS 'result'",
    $unitType, $quantity, 'null', 'null', $unitBefore, $unitAfter);
}

$query = mysqli_query($conn, $sql);
if (!query) {
  die ('SQL Error: ' . mysqli_error($conn));
}

while ($row = mysqli_fetch_array($query)){
  $result = $row['result'];
}
 ?>

<html>

<head>
  <title>Measurement Converter</title>
  <link><link href = "style.css" type = "text/css" rel = "stylesheet"></link>
  <link><link href = "tabs.css" type = "text/css" rel = "stylesheet"></link>
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
    <h1>Conversion</h1>

    <?php
      $reply = $quantity . " " . $uB . " = " . $result . " " . $uA;
      echo '<h4>'.$reply.'</h4>';
     ?>

  </div>

</body>
</html>
