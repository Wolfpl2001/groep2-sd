<?php
session_start();
include 'config.php';
if(!isset($_SESSION['user_name'])) header('Location: index.php');
if($_SESSION['user_type'] == 'user') header('Location: index.php');
$uname = $_SESSION['user_name'];
$utype = $_SESSION['user_type'];
$lname = $_SESSION['user_lname'];
$name = "";
$tussenvoegsel = "";
$achternaam = "";
$gebortedatum = "";
$functie = "";
$werkemail = "";
$rumte = "";
$id = "";
if(isset($_POST['logout'])) session_destroy() .  header('Location: index.php');
$sql = "SELECT * FROM opdrachten order by `ID` DESC LIMIT 5";
?>
<!DOCTYPE html>
<html lang="en">
  <meta content="width=device-width">
<head>
  <link rel="stylesheet" href="CSS/main.css">
  <link rel="icon" type="image/x-icon" href="../img/icon.ico">
  <title>GildeDEVops</title>
</head>
<body>
    <section>
      <!-- Main menu line on top of site -->
        <div class="main-menu">
          <a href="https://www.gildeopleidingen.nl"><img src="img/logo.jpg" alt="logo" class="logo"></a>
          <!-- Main table with links to sites -->
          <div class="text">
          <h3 class="center"><?php echo $lang['Welcome']?> <?php echo $utype ?> <?php echo $uname?> <?php echo $lname?></h3><h3 class=color></h3>
          </div>
          <!-- Lang Change -->
          <a href="main.php?lang=en"><img src="img/eng.png" alt="Eng Lang Flag" class="flag-en"></a>
          <a href="main.php?lang=nl"><img src="img/nl.png" alt="NL Lang Flag" class="flag-nl"></a>
          <form method="post">
          <button name='logout' class='logout'><ion-icon name="log-out-outline" class='logouticon'></ion-icon></button>
          </form>
        </div>
        <table class="table">
              <tr class="center">
              </tr>
              <tr class="table">
                <th><a href="admin_page.php"><?php echo $lang['staff']?></a></th>
                <th><a href="Werkzaamheden.php"><?php echo $lang['Activities']?></a></th>
                <th><a href="Opdrachten.php"><?php echo $lang['Assignments']?></a></th>
                <th><a href="Klanten.php"> <?php echo $lang['Customers']?></a></th>
                <th><a href="indexURS.php"> <?php echo $lang['reg_hours']?></a>
              </tr>
            </table>
          <?php
              if ($result == true) {
                if ($result->num_rows > 0) {
                // output data of each row
                echo "<table class='table-db'><tr class='stick'><th>".$lang['ID']."</th><th>".$lang['Name']."</th><th>".$lang['insertion']."</th><th>".$lang['Lname']."</th><th>".$lang['Birth']."</th><th>".$lang['Function']."</th><th>".$lang['Wemail']."</th><th>".$lang['Office']."</th></tr>";
                while($row = $result->fetch_assoc()) {
                    $id = $row['ID'];
                    $kid = $row['KlantID'];
                    $Titel = $row['Titel'];
                    $Omschrijving = $row['Omschrijving'];
                    $Aanvraagdatum = $row['Aanvraagdatum'];
                    $Benodigde = $row['Benodigde kennis'];
                    $Contact = $row['Contact'];
                    $tel = $row['Telefoon Nummer'];
                    echo "<tr><td>". $id."</td><td>" .$kid. "</td><td>" . $Titel ."</td><td>" . $Omschrijving. "</td><td>" . $Aanvraagdatum."</td><td>" . $Benodigde."</td><td>" . $Contact. "</td><td>". $tel."</td></tr>";
                }
                echo "</table>";
            } else {
                echo "0 results";
            }
            } else {
            echo "Error";
            }
            ?>
        </div>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>