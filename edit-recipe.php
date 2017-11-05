<!DOCTYPE html>
<?php

// Connect to SQL database
include("connect.php");

// Get recipe id
$recipe_id = $_GET['rid'];

// Link to edit recipe
$editLink = "'update-recipe.php?rid=".$recipe_id."&action=edit'";

// Get recipe overview fields
$sql = sprintf('SELECT recipe_name, prep_time, cook_time, cuisine, diet_restriction,
  recipe_type, num_servings
  FROM recipes
  WHERE recipe_id = %d',$recipe_id);

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

  // Get recipe ingredients
  $sql = sprintf('SELECT ingredient_name, quantity, unit_type, weight_unit,
    volume_unit
    FROM ingredients
    WHERE recipe_id = %d',$recipe_id);

    $ingredients = mysqli_query($conn, $sql);
    if(!ingredients) {
      die ('SQL Error: ' . mysqli_error($conn));
    }

    // Get recipe steps
    $sql = sprintf('SELECT description
      FROM steps
      WHERE recipe_id = %d
      ORDER BY step_num',$recipe_id);

      $steps = mysqli_query($conn, $sql);
      if(!steps) {
        die ('SQL Error: ' . mysqli_error($conn));
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
        <link href = "tabs.css" type = "text/css" rel = "stylesheet"></link>
      </head>

      <body>

        <?php include("navbar.html") ?>

        <div style="margin-left:18%;padding:1px 16px;height:1000px;">
          <h1>Edit: <?php echo $recipe_name ?><br><br></h1>

          <div class="tab">
            <button class="tablinks" onclick="openRecipeTab(event, 'Overview')"
            id="overview-tab">Overview</button>
            <button class="tablinks" onclick="openRecipeTab(event, 'Ingredients')"
            id = "ingredients-tab">Ingredients</button>
            <button class="tablinks" onclick="openRecipeTab(event, 'Steps')"
            id = "steps-tab">Steps</button>
          </div>

          <!-- Overview tab form -->

          <div id="Overview" class="tabcontent">

            <?php
            $editOverviewLink = substr($editLink,0,strlen($editLink)-1) . "&tab=overview'";
            ?>

            <form action= <?php echo $editOverviewLink?> method = "post">
              <br>

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

              <input type = "submit" value = "Save Changes">
              <input type = "reset" value = "Undo Changes">
            </form>
          </div>

          <!-- Ingredients tab form -->

          <div id = "Ingredients" class = "tabcontent">

            <?php
            $editIngredientsLink = substr($editLink,0,strlen($editLink)-1) . "&tab=ingredients'";

            $listOfIngredients = array();

            while ($row = mysqli_fetch_array($ingredients)) {

              if ($row['unit_type']=="weight") {
                $unit = $row['weight_unit'];
              }
              elseif($row['unit_type']=="volume") {
                $unit = $row["volume_unit"];
              }
              else {
                $unit = "";
              }

              $listOfIngredients[] = array("ingredient_name"=>$row['ingredient_name'],
              "quantity"=>$row['quantity'],
              "unit"=>$unit);
            }
            ?>

            <form action= <?php echo $editIngredientsLink?> method = "post">
              <br>

              Select Ingredients to Delete:<br><br>

              <?php

              foreach($listOfIngredients as $ingredients_array) {

                $temp_name = $ingredients_array['ingredient_name'];
                $temp_quantity = $ingredients_array['quantity'];
                if($ingredients_array['unit'] != "") {
                  $temp_unit = " " . $ingredients_array['unit'] . " ";
                }
                else {
                  $temp_unit = " ";
                }

                echo sprintf("<input type = 'checkbox' name = 'ingredientsToDelete[]' value = '%s'> %.2f%s%s<br>",
                $temp_name, $temp_quantity, $temp_unit, $temp_name);

              }
              ?>
              <br>

              <div id = "dynamicIngredientsInput">
              </div>

              <br>

              <button type = "button" onclick = "addIngredient('dynamicIngredientsInput')">Add Ingredient</button>

              <button type = "button" onclick = "undoAddIngredient('dynamicIngredientsInput')">Undo</button>
              <br>

              <br><br>

              <input type = "submit" value = "Save Changes">
              <input type = "reset" value = "Undo Changes">
            </form>

          </div>

          <!-- Steps tab form -->

          <div id = "Steps" class = "tabcontent">

            <?php
            $editStepsLink = substr($editLink,0,strlen($editLink)-1) . "&tab=steps'";

            $numSteps = 0;
            $listOfSteps = array();

            while ($row = mysqli_fetch_array($steps)) {
              array_push($listOfSteps, $row['description']);
            }
            ?>

            <form action= <?php echo $editStepsLink?> method = "post">
              <br>
              <?php
              foreach($listOfSteps as $step) {
                $numSteps = $numSteps + 1;
                echo "Step " . $numSteps . ". <br><br> <textarea name = 'originalSteps[]' rows = '3'
                cols = '80'>" . $step . "</textarea> <br><br>";
              }
              ?>

              <div id = "dynamicStepsInput">
              </div>

              <button type = "button" onclick = "addStep('dynamicStepsInput')">Add Step</button>

              <br><br>

              <input type = "submit" value = "Save Changes">
              <input type = "reset" value = "Undo Changes">
            </form>

          </div>

          <!-- Delete Recipe button -->

          <br>
          <button type = "button" onclick = "deleteRecipe('<?php echo $recipe_id?>','<?php echo $recipe_name?>')">Delete Recipe</button>

          <script>
          function deleteRecipe(recipe_id, recipe_name) {
            var msg = "Are you sure you want to delete: " + recipe_name + "?";
            var updateWindow = "update-recipe.php?rid=" + recipe_id + "&action=deleteRecipe";
            if (confirm(msg)) {
              window.location = updateWindow;
            }
            else {
              window.location = "search-recipes.php";
            }
          }

          function addIngredient(divName) {
            var newDivNameQuantity = document.createElement('div');
            var newDivUnit = document.createElement('div');
            var iname = "<input type = 'text' name = 'newIngredientName[]' placeholder='ingredient name'> ";
            var iquantity = "<input type = 'number' name = 'newIngredientQuantity[]' min = '0' step = '0.01' placeholder='0.00'> ";
            var iunittype = "<select name = 'newIngredientUnitType[]'> <option value = 'count' selected>count</option> <option value = 'weight'>weight</option> <option value = 'volume'>volume</option> </select> ";
            var iweightunit = "<select name = 'newIngredientWeightUnit[]'> <option value = 'null'>n/a</option> <option value = 'lb'>lb</option> <option value = 'oz'>oz</option> <option value = 'g'>g</option> <option value = 'kg'>kg</option> </select> ";
            var ivolumeunit = "<select name = 'newIngredientVolumeUnit[]'> <option value = 'null'>n/a</option> <option value = 'tsp'>tsp</option> <option value = 'tbsp'>tbsp</option> <option value = 'cup'>cup</option> <option value = 'pint'>pint</option> <option value = 'qt'>qt</option> <option value = 'gal'>gal</option> <option value = 'fl oz'>fl oz</option> <option value = 'l'>l</option> <option value = 'cubic in'>cubic in</option> </select> ";
            newDivNameQuantity.innerHTML = iname + iquantity;
            newDivUnit.innerHTML = iunittype + iweightunit + ivolumeunit;
            document.getElementById(divName).appendChild(newDivNameQuantity);
            document.getElementById(divName).appendChild(newDivUnit);
          }

          function undoAddIngredient(divName) {
            var element = document.getElementById(divName);
            element.removeChild(element.lastChild);
            element.removeChild(element.lastChild);
          }

          var stepNumCounter = <?php echo $numSteps?>;

          function addStep(divName) {
            var newdiv = document.createElement('div');
            newdiv.innerHTML = "Step " + (++stepNumCounter) +  ". <br><br><textarea name = 'newSteps[]' rows = '3' cols = '80'>";
            document.getElementById(divName).appendChild(newdiv);
          }

          function openRecipeTab(evt, recipeTab) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
              tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for(i = 0; i < tablinks.length; i++) {
              tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(recipeTab).style.display = "block";
            evt.currentTarget.className += " active";
          }

          // Get the element with id = "overview-tab" and click on it
          document.getElementById("overview-tab").click();
          </script>

        </div>
      </body>
      </html>
