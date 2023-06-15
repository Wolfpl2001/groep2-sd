<?php
session_start();
// Include things from config.php
include '../config.php';

if (!isset($_SESSION['user_name']))
  header('Location: index.php');

$utype = $_SESSION['user_type'];
$name = "";
$lname = "";
$adres = "";
$tel = "";
$uname = $_SESSION['user_name'];
// searching information from data base
if (empty($_GET['search'])) {
  $sql = "SELECT * FROM `klanten`";
} else {
  $search_query = mysqli_real_escape_string($conn, $_GET['search']);
  $sql = "SELECT * FROM `klanten` WHERE ID LIKE '%$search_query%' OR Achternaam LIKE '%$search_query%' Or  Adres LIKE '%$search_query%' OR  Voornaam LIKE '%$search_query%' OR Tel LIKE '%$search_query%'";
}

$result = $conn->query($sql);
if (isset($_POST['logout']))
  session_destroy() . header('Location: ../index.php');
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
      <?php include '../nav_user.php'; ?>
      <form>
        <div class="inputbox">
          <input type="text" name="search" required>
          <label for="">
            <?php echo $lang['search'] ?>
          </label>
          <a href="customers_user.php"><ion-icon name="close-outline"></ion-icon></a>
        </div>
      </form>
    </div>
    <div class="main-menu">
      <img src="../img/logo.jpg" alt="logo" class="logo">
      <!-- Lang Change -->
      <a href="customers_user.php?lang=en"><img src="../img/eng.png" alt="Eng Lang Flag" class="flag-en"></a>
      <a href="customers_user.php?lang=nl"><img src="../img/nl.png" alt="NL Lang Flag" class="flag-nl"></a>
      <form method="post" class='formlout'>
        <button name='logout' class='logout'><ion-icon name="log-out-outline" class='logouticon'></ion-icon></button>
      </form>
    </div>
    <!-- Database Informations -->
    <div class="db">
      <h1 class=h1><?php echo $lang['db_info'] ?>: <?php echo $lang['Customers'] ?></h1>
      <!-- searching site -->

      <!-- informations from datebase are seeing  on site -->
      <?php
      if ($result == true) {
        if ($result->num_rows > 0) {
          // output data of each row
          echo "<table class='table-db'><tr class='stick'><th>" . $lang['ID'] . "</th><th>" . $lang['Name'] . "</th><th>" . $lang['Lname'] . "</th><th>" . $lang['adres'] . "</th><th>" . $lang['pnumber'] . "</th></tr>";
          while ($row = $result->fetch_assoc()) {
            $id = $row['ID'];
            $name = $row['Voornaam'];
            $lname = $row['Achternaam'];
            $adres = $row['Adres'];
            $tel = $row['Tel'];
            echo "<tr><td>" . $id . "</td><td>" . $name . "</td><td>" . $lname . "</td><td>" . $adres . "</td><td>" . $tel . "</a></td></tr>";
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