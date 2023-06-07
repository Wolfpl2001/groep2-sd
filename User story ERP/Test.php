<?php
session_start();
// Include things from config.php
include 'config.php';

if(!isset($_SESSION['user_name'])) header('Location: index.php');
if($_SESSION['user_type'] == 'user') header('Location: index.php');

$utype= $_SESSION['user_type'];
$name = "";
$tussenvoegsel = "";
$achternaam = "";
$gebortedatum = "";
$functie = "";
$werkemail = "";
$rumte = "";
$id = "";
$uname= $_SESSION['user_name'];
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
  <link rel="stylesheet" href="CSS/admin-site.css">
  <link rel="icon" type="image/x-icon" href="../img/icon.ico">
  <title>GildeDEVops</title>
</head>
<body>
    <section>
      <!-- Main menu line on top of site -->
      <div class='nav'>
                <?php include 'nav.php';?>
                <div class="inputbox">
                  <input type="text" name="search" required>
                  <label for=""><?php echo $lang['search']?></label>
                  <a href="medewerkers.php"><ion-icon name="close-outline"></ion-icon></a>
                </div>
              </form>
        </div>
        <div class="main-menu">
          <img src="img/logo.jpg" alt="logo" class="logo">
          <!-- Lang Change -->
          <a href="medewerkers.php?lang=en"><img src="img/eng.png" alt="Eng Lang Flag" class="flag-en"></a>
          <a href="medewerkers.php?lang=nl"><img src="img/nl.png" alt="NL Lang Flag" class="flag-nl"></a>
          <a href="register.php"><ion-icon name="person-add-outline" class="add"></ion-icon></a>
          <form method="post" class='formlout'>
            <button name='logout' class='logout'><ion-icon name="log-out-outline" class='logouticon'></ion-icon></button>
          </form>
        </div>
        <!-- Database Informations -->
        <div class="db">
          <h1 class=h1><?php echo $lang['db_info']?>: <?php echo $lang['staff']?></h1>
          <!-- searching site -->
          
          <!-- informations from datebase are seeing  on site -->
          <?php
          if ($result == true) {
            if ($result->num_rows > 0) {
              // output data of each row
              echo "<table class='table-db'><tr class='stick'><th>" . $lang['ID'] . "</th><th>" . $lang['Name'] . "</th><th>" . $lang['insertion'] . "</th><th>" . $lang['Lname'] . "</th><th>" . $lang['Birth'] . "</th><th>" . $lang['Function'] . "</th><th>" . $lang['Wemail'] . "</th><th>" . $lang['Office'] . "</th></tr>";
              while ($row = $result->fetch_assoc()) {
                $id = $row['ID'];
                $name = $row['Voornaam'];
                $tussenvoegsel = $row['Tussenvoegsel'];
                $achternaam = $row['Achternaam'];
                $gebortedatum = $row['Geboortedatum'];
                $functie = $row['Functie'];
                $werkemail = $row['Werkmail'];
                $rumte = $row['Kantoorruimte'];
                echo "<tr><td><a href=bla.php?id=" . $id . ">" . $id . "</a></td><td><a href=bla.php?id=" . $id . ">" . $name . "</a></td><td><a href=bla.php?id=" . $id . ">" . $tussenvoegsel . "</a></td><td><a href=bla.php?id=" . $id . ">" . $achternaam . "</a></td><td><a href=bla.php?id=" . $id . ">" . $gebortedatum . "</a></td><td><a href=bla.php?id=" . $id . ">" . $functie . "</a></td><td><a href=bla.php?id=" . $id . ">" . $werkemail . "</a></td><td><a href=bla.php?id=" . $id . ">" . $rumte . "</a></td></tr>";
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