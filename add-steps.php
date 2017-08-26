<!DOCTYPE html>
<html>

<head>
  <title>Add Steps</title>
  <link href = "style.css" type = "text/css" rel = "stylesheet">
</head>

<body>
  <?php include("navbar.html"); ?>

  <div style="margin-left:18%;padding:1px 16px;height:1000px;">

    <div class = "add-steps">

    <h1>Add Steps</h1>

    <form action = "insert-steps.php" method = "post">
      Step Number:<br>
      <input type = "number" name = "stepNum" min = "1" required>
      <br><br>
      Description:<br><br>
      <textarea name = "description" rows="5" cols="80" required></textarea>
      <br><br>
      <input type = "submit" value = "Add Step">
      <input type = "reset" value = "Clear">
   </form>

   <form action = "search-recipes.php">
     <input type = "submit" value = "Finish">
   </form>

  </div>

  </div>
</body>

</html>
