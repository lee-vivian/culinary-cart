<!DOCTYPE html>

<html>

<head>
  <title>Add Ingredients</title>

  <link href = "style.css" type = "text/css" rel = "stylesheet">
</head>

<body>

  <?php include("navbar.html"); ?>

<div style="margin-left:18%;padding:1px 16px;height:1000px;">

  <div class = "add-ingredients">

    <h1>Add Ingredients</h1>

    <form action = "insert-ingredients.php" method = "post">
      Ingredient Name:<br>
        <input type = "text" name = "iname" placeholder="Ingredient" required>
        <br><br>
      Quantity:<br>
        <input type = "number" name = "quantity" min = "0" step = "0.01"
          placeholder="0.00" required>
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
      <input type = "submit" value = "Add Ingredient">
      <input type = "reset" value = "Clear">
    </form>

    <form action = "add-steps.php">
      <input type = "submit" value = "Add Steps">
    </form>

  </div>

</div>

</body>
</html>
