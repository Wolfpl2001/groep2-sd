<?php
session_start();
// Include things from config.php
include 'config.php';
$name = "";
$tussenvoegsel = "";
$achternaam = "";
$gebortedatum = "";
$functie = "";
$werkemail = "";
$rumte = "";
$id = "";
// searching information from data base
if (empty($_GET['search'])) {
  $sql = "SELECT * FROM `medewerkers`";
} else {
  $search_query = mysqli_real_escape_string($conn, $_GET['search']);
  $sql = "SELECT * FROM `medewerkers` WHERE Voornaam LIKE '%$search_query%' OR Achternaam LIKE '%$search_query%' Or Tussenvoegsel LIKE '%$search_query%' OR Geboortedatum LIKE '%$search_query%' OR Functie LIKE '%$search_query%' OR id LIKE '%$search_query%' OR Werkmail LIKE '%$search_query%' OR Kantoorruimte LIKE '%$search_query%'";
}

$result = $conn->query($sql);

?>


<!DOCTYPE html>
<html lang="en">
  <meta content="width=device-width">
<head>
  <link rel="stylesheet" href="CSS/user-site.css">
  <link rel="icon" type="image/x-icon" href="../img/icon.ico">
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
          <h3><?php echo $lang['Welcome']."<h3 class=Color>". $lang['admin'] ."</h3>"?></h3><h3 class=color></h3>
          <!-- searching site -->
          <form action="">
            <div class="inputbox">
              <input type="text" name="search">
              <label for=""><?php echo $lang['search']?></label>
            </div>
          </form>
          <!-- informations from datebase are seeing  on site -->
          <?php
              if ($result == true) {
                if ($result->num_rows > 0) {
                // output data of each row
                echo "<table class='table-db'><tr class='stick'><th>".$lang['ID']."</th><th>".$lang['Name']."</th><th>".$lang['insertion']."</th><th>".$lang['Lname']."</th><th>".$lang['Birth']."</th><th>".$lang['Function']."</th><th>".$lang['Wemail']."</th><th>".$lang['Office']."</th></tr>";
                while($row = $result->fetch_assoc()) {
                    $id = $row['ID'];
                    $name = $row['Voornaam'];
                    $tussenvoegsel = $row['Tussenvoegsel'];
                    $achternaam = $row['Achternaam'];
                    $gebortedatum = $row['Geboortedatum'];
                    $functie = $row['Functie'];
                    $werkemail = $row['Werkmail'];
                    $rumte = $row['Kantoorruimte'];
                    echo "<tr><td><a href=bla.php?id=".$id.">". $id."</a></td><td><a href=bla.php?id=".$id.">" .$name. "</a></td><td><a href=bla.php?id=".$id.">" . $tussenvoegsel ."</a></td><td><a href=bla.php?id=".$id.">" . $achternaam. "</a></td><td><a href=bla.php?id=".$id.">" . $gebortedatum."</a></td><td><a href=bla.php?id=".$id.">" . $functie."</a></td><td><a href=bla.php?id=".$id.">" . $werkemail. "</a></td><td><a href=bla.php?id=".$id.">". $rumte."</a></td></tr>";
                }
                echo "</table>";
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