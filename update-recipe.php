<?php

// Connect to SQL database
include("connect.php");

$recipe_id = $_GET['rid'];
$action = $_GET['action'];

if ($action == 'deleteRecipe') {
  $sql = sprintf('DELETE FROM recipes WHERE recipe_id = %d', $recipe_id);
  $query = mysqli_query($conn, $sql);
  if (!query) {
    die ('SQL Error: ' . mysqli_error($conn));
  }
}

/*
elseif($action = 'deleteIngredient') {
  $iname = $_GET['iname'];
  $sql = sprintf('DELETE FROM ingredients WHERE recipe_id = %d AND ingredient_name = %s',
  $recipe_id, $iname);
  $query = mysqli_query($conn, $sql);
  if (!query) {
    die('SQL Error: ' . mysqli_error($conn));
  }
  // Jump back to edit recipe's ingredients page
  header("Location: edit-recipe.php");
}
*/

elseif ($action == 'edit') {

  $tab = $_GET['tab'];

  if ($tab == 'overview') {
    $recipe_name = "'" . $_POST['name'] . "'";
    $prep_time = $_POST['prep'];
    $cook_time = $_POST['cook'];
    $cuisine = "'" . $_POST['cuisine'] . "'";
    $diet_restriction = "'" . $_POST['diet'] . "'";
    $recipe_type = "'" . $_POST['type'] . "'";
    $num_servings = $_POST['servings'];

    $sql = sprintf('UPDATE recipes
      SET recipe_name = %s,
      prep_time = %d,
      cook_time = %d,
      cuisine = %s,
      diet_restriction = %s,
      recipe_type = %s,
      num_servings = %d
      WHERE recipe_id = %d',
      $recipe_name, $prep_time, $cook_time, $cuisine, $diet_restriction,
      $recipe_type, $num_servings, $recipe_id);
      $query = mysqli_query($conn, $sql);
      if (!query) {
        die ('SQL Error: ' . mysqli_error($conn));
      }
    }
    elseif($tab == 'ingredients') {
      $ingredientsToDelete = $_POST['ingredientsToDelete'];
      $hasNewIngredientName = isset($_POST['newIngredientName']);
      $hasNewIngredientQuantity = isset($_POST['newIngredientQuantity']);

      // Delete selected ingredients from recipe
      foreach($ingredientsToDelete as $i) {
        $sql = sprintf('DELETE FROM ingredients WHERE recipe_id = %d AND ingredient_name = %s', $recipe_id, "'" . $i . "'");
        $query = mysqli_query($conn, $sql);
        if (!query) {
          die ('SQL Error: ' . mysqli_error($conn));
        }
      }

      // Add new ingredients to recipe

      if ($hasNewIngredientName && $hasNewIngredientQuantity) {

        $newIngredientName = $_POST['newIngredientName'];
        $newIngredientQuantity = $_POST['newIngredientQuantity'];
        $newIngredientUnitType = $_POST['newIngredientUnitType'];
        $newIngredientWeightUnit = $_POST['newIngredientWeightUnit'];
        $newIngredientVolumeUnit = $_POST['newIngredientVolumeUnit'];

        for($i = 0; $i < sizeof($_POST['newIngredientName']); $i++) {

          if ($newIngredientName[$i] == "") {}
          elseif ($newIngredientQuantity[$i] == "") {}
          else {

            $name = "'" . $newIngredientName[$i] . "'";
            $unitType = "'" . $newIngredientUnitType[$i] . "'";
            $weightUnit = "'" . $newIngredientWeightUnit[$i] . "'";
            $volumeUnit = "'" . $newIngredientVolumeUnit[$i] . "'";

            $sql = sprintf("INSERT INTO ingredients (`ingredient_name`,
              `quantity`, `unit_type`, `weight_unit`, `volume_unit`, `recipe_id`)
              VALUES (%s, %d, %s, %s, %s, %d)", $name, $newIngredientQuantity[$i],
              $unitType, $weightUnit, $volumeUnit, $recipe_id);

            $query = mysqli_query($conn,$sql);
            if (!query) {
              die ('SQL Error: ' . mysqli_error($conn));
            }
          }
        }
      }
    }
    elseif($tab == 'steps') {

      $hasOldSteps = isset($_POST['originalSteps']);
      $hasNewSteps = isset($_POST['newSteps']);

      if ($hasOldSteps && $hasNewSteps) {
        $total_steps = array_merge($_POST['originalSteps'],$_POST['newSteps']);
      }
      elseif($hasOldSteps) {
        $total_steps = $_POST['originalSteps'];
      }
      else {
        $total_steps = $_POST['newSteps'];
      }

      // Delete old steps for current $recipe_id
      $sql = sprintf('DELETE FROM steps WHERE recipe_id = %d', $recipe_id);
      $query = mysqli_query($conn, $sql);
      if (!query) {
        die ('SQL Error: ' . mysqli_error($conn));
      }

      // Insert new steps for current $recipe_id
      $step_counter = 1;
      foreach($total_steps as $s) {
        if ($s!="") {
          $sql = sprintf("INSERT INTO steps (`recipe_id`,`step_num`,`description`)
          VALUES (%d, %d, '%s')", $recipe_id, $step_counter, $s);
          $query = mysqli_query($conn,$sql);
          if (!query) {
            die ('SQL Error: ' . mysqli_error($conn));
          }
          $step_counter = $step_counter + 1;
        }
      }
    }
  }

  // Jump back to search-recipes.php
  header("Location: search-recipes.php");
  ?>
