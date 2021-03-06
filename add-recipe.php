<!DOCTYPE html>
<html>

<head>
  <title>Add Recipe</title>

  <link href = "style.css" type = "text/css" rel = "stylesheet">
</head>

<body>

  <?php include("navbar.html"); ?>

<div style="margin-left:18%;padding:1px 16px;height:1000px;">

  <div class = "add-recipe">

  <h1>Add Recipe</h1>

  <form action = "insert-recipe.php" method = "post">
    Recipe Name:<br>
      <input type = "text" name = "name" placeholder="Recipe" required> <br><br>
    Prep Time:<br>
      <input type = "number" name = "prep" min = "0" placeholder="0" required> min.<br><br>
    Cook Time:<br>
      <input type = "number" name = "cook" min = "0" placeholder=" 0" required> min.<br><br>
    Cuisine:<br>
      <input type = "text" name = "cuisine" placeholder="Cuisine"> <br><br>
    Dietary Restrictions:<br>
    <select name = "diet">
      <option value = "none">none</option>
      <option value = "vegetarian">vegetarian</option>
      <option value = "vegan">vegan</option>
      <option value = "gluten free">gluten free</option>
      <option value = "paleo">paleo</option>
      <option value = "kosher">kosher</option>
      <option value = "pescetarian">pescetarian</option>
      <option value = "nut allergies">nut allergies</option>
    </select>
    <br><br>
    Meal Type:<br>
    <select name = "type">
      <option value = "meal">meal</option>
      <option value = "drink">drink</option>
      <option value = "snack">snack</option>
    </select>
    <br><br>
    Servings:<br>
      <input type = "number" name = "servings" min = "1" required placeholder="0">
    <br><br>
    <input type = "submit" value = "Next">

    <input type = "reset" value = "Clear">
  </form>

  </div>

</div>

</body>

</html>
