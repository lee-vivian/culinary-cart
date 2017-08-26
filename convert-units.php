<!DOCTYPE html>

<html>

<head>
  <title>Measurement Converter</title>
  <link><link href = "style.css" type = "text/css" rel = "stylesheet"></link>
  <link><link href = "tabs.css" type = "text/css" rel = "stylesheet"></link>
</head>

<body>
  <?php include("navbar.html"); ?>

  <div style="margin-left:18%;padding:1px 16px;height:1000px;">

    <h1>Measurement Converter</h1><br>

    <div class="tab">
      <button class="tablinks" onclick="openUnitType(event, 'Weight')"
        id="defaultOpen">Weight</button>
      <button class="tablinks" onclick="openUnitType(event, 'Volume')">Volume</button>
    </div>

    <div id="Weight" class="tabcontent">
      <form action="convert.php" method = "post">
        <input type = "hidden" name = "unitType" value="weight">
        Quantity:<br>
        <input type = "number" name = "quantity" min = "0" step = "0.01"
          placeholder="0.00" required> <br><br>

        Weight Before:<br>
        <select name = "unitBefore">
          <option value = "lb">lb</option>
          <option value = "oz">oz</option>
          <option value = "g">g</option>
          <option value = "kg">kg</option>
        </select>
        <br><br>

        Weight After:<br>
        <select name = "unitAfter">
          <option value = "lb">lb</option>
          <option value = "oz">oz</option>
          <option value = "g">g</option>
          <option value = "kg">kg</option>
        </select>
        <br><br>

        <input type = "submit" value = "Convert">
        <input type = "reset" value = "Reset">
      </form>
    </div>

    <div id="Volume" class="tabcontent">
      <form action="convert.php" method = "post">
        <input type = "hidden" name = "unitType" value="volume">
        Quantity:<br>
        <input type = "number" name = "quantity" min = "0" placeholder="0.00" required> <br><br>

        Volume Before:<br>
        <select name = "unitBefore">
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
        <select name = "unitAfter">
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

    <script>
    function openUnitType(evt, unitType) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(unitType).style.display = "block";
        evt.currentTarget.className += " active";
    }

    // Get the element with id = "defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
    </script>

  </div>

</body>
</html>
