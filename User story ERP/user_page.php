<?php
session_start();
// Include thinks from config.php
include 'config.php';
//detabase connection from sheet medewerkers
$sql = "SELECT id, Voornaam, Tussenvoegsel, Achternaam, Geboortedatum, Functie, Werkmail, Kantoorruimte FROM `medewerkers`";
?>

<!DOCTYPE html>
<html lang="en">
  <meta content="width=device-width">
<head>
  <link rel="stylesheet" href="CSS/user-site.css">
  <title>GildeDEVops</title>
</head>
<body>
    <section>
      <!-- Main menu line on top of site -->
        <div class="main-menu">
          <img src="img/logo.jpg" alt="logo" class="logo">
          <!-- Main table with links to sites -->
            <table class="table">
              <tr class="table">
                <th><a href=""><?php echo $lang['staff']?></a></th>
                <th><a href="Werkzaamheden.php"><?php echo $lang['Activities']?></a></th>
                <th><a href="Opdrachten.php"><?php echo $lang['Assignments']?></a></th>
                <th><a href="Klanten.php"> <?php echo $lang['Customers']?></a></th>
              </tr>
            </table>
          <!-- Lang Change -->
          <a href="admin_page.php?lang=en"><img src="img/eng.png" alt="Eng Lang Flag" class="flag-en"></a>
          <a href="admin_page.php?lang=nl"><img src="img/nl.png" alt="NL Lang Flag" class="flag-nl"></a>
        </div>
        <!-- Database Informations -->
        <div class="db">
          <h1 class=h1><?php echo $lang['db_info']?>: <?php echo $lang['staff']?></h1>
          <!-- informations from datebase are seeing  on site -->
          <?php
          include 'config.php';
          $result = $conn->query($sql);
          if ($result == true) {
            if ($result->num_rows > 0) {
              echo "<table class='table-db'><tr class='stick'><th>ID</th><th>Name</th><th>Tussenvoegsel</th><th>Achternaam</th><th>Geboortedatum</th><th>Functie</th><th>Werkmail</th><th>Kantoorruimte</th></tr>";
            // output data of each row
            while($row = $result->fetch_assoc()) {
              echo "<tr><td><a href=bla.php?id=".$row["id"].">". $row["id"]."</a></td><td><a href=bla.php?id=".$row["id"].">" . $row["Voornaam"]. "</a></td><td><a href=bla.php?id=".$row["id"].">" . $row["Tussenvoegsel"] ."</a></td><td><a href=bla.php?id=".$row["id"].">" . $row["Achternaam"]. "</a></td><td><a href=bla.php?id=".$row["id"].">" . $row["Geboortedatum"]."</a></td><td><a href=bla.php?id=".$row["id"].">" . $row["Functie"]."</a></td><td><a href=bla.php?id=".$row["id"].">" . $row["Werkmail"]. "</a></td><td><a href=bla.php?id=".$row["id"].">". $row["Kantoorruimte"]."</a></td></tr>";
              }
            } else {
              echo "0 results";
            }
          } else {
            echo "Error";
          }
?>
</table>
        </div>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>