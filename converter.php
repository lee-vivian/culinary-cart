<!DOCTYPE html>

<html>

<head>
  <title>Measurement Converter</title>

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

<div class = "converter">

  <h1>Measurement Converter</h1>

  <form action = "connect.php" method = "post">
    Unit Type:<br>
    <select name = "unit-type">
      <option value = "count">Count</option>
      <option value = "weight">Weight</option>
      <option value = "volume">Volume</option>
    </select>
    <br><br>

    Quantity:<br>
    <input type = "text" name = "quantity" placeholder="0.00"> <br><br>

    Weight Before:<br>
    <select name = "weight-before">
      <option value = "null">null</option>
      <option value = "lb">lb</option>
      <option value = "oz">oz</option>
      <option value = "g">g</option>
      <option value = "kg">kg</option>
    </select>
    <br><br>

    Weight After:<br>
    <select name = "weight-after">
      <option value = "null">null</option>
      <option value = "lb">lb</option>
      <option value = "oz">oz</option>
      <option value = "g">g</option>
      <option value = "kg">kg</option>
    </select>
    <br><br>

    Volume Before:<br>
    <select name = "volume-before">
      <option value = "null">null</option>
      <option value = "tsp">tsp</option>
      <option value = "tbsp">tbsp</option>
      <option value = "cup">cup</option>
      <option value = "pint">pint</option>
      <option value = "qt">qt</option>
      <option value = "gal">gal</option>
      <option value = "fl oz">fl oz</option>
      <option value = "l">l</option>
      <option value = "cubic in">cubic in</option>
    </select>
    <br><br>

    Volume After:<br>
    <select name = "volume-after">
      <option value = "null">null</option>
      <option value = "tsp">tsp</option>
      <option value = "tbsp">tbsp</option>
      <option value = "cup">cup</option>
      <option value = "pint">pint</option>
      <option value = "qt">qt</option>
      <option value = "gal">gal</option>
      <option value = "fl oz">fl oz</option>
      <option value = "l">l</option>
      <option value = "cubic in">cubic in</option>
    </select>
    <br><br>

    <input type = "submit" value = "Convert">
    <input type = "reset" value = "Reset">

  </form>

</div>
</div>

</body>


</html>
