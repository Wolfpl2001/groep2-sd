<?php
session_start();
// Include things from config.php
include '../config.php';

if (!isset($_SESSION['user_name']))
  header('Location: ../index.php');
if ($_SESSION['user_type'] == 'user')
  header('Location: ../index.php');

$utype = $_SESSION['user_type'];
$id = "";
$klantid = "";
$title = "";
$om = "";
$bk = "";
$contact = "";
$tel = "";
$uname = $_SESSION['user_name'];
// searching information from data base
if (empty($_GET['search'])) {
  $sql = "SELECT opdrachten.ID, klanten.Voornaam,opdrachten.Titel, opdrachten.Omschrijving, opdrachten.Aanvraagdatum, opdrachten.Benodigde_kennis, opdrachten.Contact, opdrachten.Telefoon_Nummer  FROM klanten INNER JOIN opdrachten ON klanten.ID = opdrachten.KlantID";
} else {
  $search_query = mysqli_real_escape_string($conn, $_GET['search']);
  $sql = "SELECT opdrachten.ID, klanten.Voornaam,opdrachten.Titel, opdrachten.Omschrijving, opdrachten.Aanvraagdatum, opdrachten.Benodigde_kennis, opdrachten.Contact, opdrachten.Telefoon_Nummer  FROM klanten INNER JOIN opdrachten ON klanten.ID = opdrachten.KlantID WHERE `opdrachten`.`ID` LIKE '%$search_query%' OR `klanten`.`Voornaam` LIKE '%$search_query%' OR `opdrachten`.`Titel` LIKE '%$search_query%' OR `opdrachten`.`Omschrijving` LIKE '%$search_query%' OR `opdrachten`.`Aanvraagdatum` LIKE '%$search_query%' OR `opdrachten`.`Benodigde_kennis` LIKE '%$search_query%' OR `opdrachten`.`Contact` LIKE '%$search_query%' OR `opdrachten`.`Telefoon_Nummer` LIKE '%$search_query%'";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<meta content="width=device-width">

<head>
  <link rel="stylesheet" href="../CSS/admin-site.css">
  <link rel="icon" type="image/x-icon" href="../img/icon.ico">
  <title>GildeDEVops</title>
</head>

<body>
  <section>
    <!-- Main menu line on top of site -->
    <div class='nav'>
      <?php include '../nav.php'; ?>
      <form>
        <div class="inputbox">
          <input type="text" name="search" required>
          <label for="">
            <?php echo $lang['search'] ?>
          </label>
          <a href="assignmensts.php"><ion-icon name="close-outline"></ion-icon></a>
        </div>
      </form>
    </div>
    <div class="main-menu">
      <img src="../img/logo.jpg" alt="logo" class="logo">
      <!-- Lang Change -->
      <a href="assignmensts.php?lang=en"><img src="../img/eng.png" alt="Eng Lang Flag" class="flag-en"></a>
      <a href="assignmensts.php?lang=nl"><img src="../img/nl.png" alt="NL Lang Flag" class="flag-nl"></a>
      <a href="register.php"><ion-icon name="add-circle-outline" class="add"></ion-icon></a>
      <form method="post" class='formlout'>
        <button name='logout' class='logout'><ion-icon name="log-out-outline" class='logouticon'></ion-icon></button>
      </form>
    </div>
    <!-- Database Informations -->
    <div class="db">
      <h1 class=h1><?php echo $lang['db_info'] ?>: <?php echo $lang['Assignments'] ?></h1>
      <!-- searching site -->

      <!-- informations from datebase are seeing  on site -->
      <?php
      if ($result == true) {
        if ($result->num_rows > 0) {
          // output data of each row
          echo "<table class='table-db'><tr class='stick'><th>" . $lang['ID'] . "</th><th>" . $lang['kname'] . "</th><th>" . $lang['title'] . "</th><th>" . $lang['description'] . "</th><th>" . $lang['rknowledge'] . "</th><th>" . $lang['contact'] . "</th><th>" . $lang['pnumber'] . "</th></tr>";
          while ($row = $result->fetch_assoc()) {
            $id = $row['ID'];
            $klantid = $row['Voornaam'];
            $title = $row['Titel'];
            $om = $row['Omschrijving'];
            $bk = $row['Benodigde_kennis'];
            $contact = $row['Contact'];
            $tel = $row['Telefoon_Nummer'];
            echo "<tr><td><a href=bla.php?id=" . $id . ">" . $id . "</a></td><td><a href=bla.php?id=" . $id . ">" . $klantid . "</a></td><td><a href=bla.php?id=" . $id . ">" . $title . "</a></td><td><a href=bla.php?id=" . $id . ">" . $om . "</a></td><td><a href=bla.php?id=" . $id . ">" . $bk . "</a></td><td><a href=bla.php?id=" . $id . ">" . $contact . "</td><td><a href=bla.php?id=" . $id . ">" . $tel . "</tr>";
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