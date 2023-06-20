<?php
session_start();
if (!isset($_SESSION['user_type']))
    header('Location: index.php');
if ($_SESSION['user_type'] == 'user')
    header('Location: index.php');

include 'config.php';


//$search = $_GET['search'];
// Retrieve data for the specified ID
$sql = "SELECT opdrachten.ID, opdrachten.KlantID,opdrachten.Titel, opdrachten.Omschrijving, opdrachten.Aanvraagdatum, opdrachten.Benodigde_kennis, opdrachten.Contact, opdrachten.Telefoon_Nummer, opdrachten.KlantID  FROM klanten INNER JOIN opdrachten ON klanten.ID = opdrachten.KlantID";

$utype = $_SESSION['user_type'];
$klant = "";
$title = "";
$om = "";
$bk = "";
$contact = "";
$tel = "";
$uname = $_SESSION['user_name'];
// $sql = "SELECT * FROM `medewerkers` WHERE name LIKE '%$search%' OR achternaam LIKE '%search%';";

$result = $conn->query($sql);
if ($result == true) {
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $klant = $row['KlantID'];
            $title = $row['Titel'];
            $om = $row['Omschrijving'];
            $date = $row['Aanvraagdatum'];
            $bk = $row['Benodigde_kennis'];
            $contact = $row['Contact'];
            $tel = $row['Telefoon_Nummer'];
        }
    } else {
        echo "0 results";
    }
} else {
    echo "Error";
}

if (isset($_POST['change'])) {

    $klant = $_POST['KID'];
    $oid = $_POST['ID'];
    $langs = $_POST['langs'];
    print_r($_POST);
    header('location:pdf.php?OpdrachtID='.$klant.'&IDUser='.$oid.'&lang='.$langs);

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="CSS/factuur.css">
    <link rel="icon" type="image/x-icon" href="img/icon.ico">
    <title>GildeDEVops Database</title>
</head>

<body>
    <section>
        <div class="form-box1">
            <div class="form-value">
                <form action="" method="post">
                    <h2>
                        <?php echo $lang['Factuur'] ?>
                    </h2>

                    <div class='secondtable'>
                        <div class="inputbox">
                            <?php
                            $info = "SELECT opdrachten.ID ,klanten.Voornaam, klanten.Achternaam , opdrachten.Titel FROM `opdrachten`INNER JOIN klanten ON opdrachten.KlantID = klanten.ID";
                            $result1 = mysqli_query($conn, $info);
                            if ($result1 == true) {
                                if ($result1->num_rows > 0) {
                                    // output data of each row
                                    echo "<select name= 'KID'>";
                                    while ($row = $result1->fetch_assoc()) { // Corrected variable name to $result1
                                        $id = $row['ID'];
                                        $fname = $row['Voornaam'];
                                        $lastn = $row['Achternaam'];
                                        $title1 = $row['Titel'];
                                        echo  "<option value=".$id.">" . $id."&nbsp". $fname."&nbsp". $lastn ."&nbsp". $title1 . "</option>";
                                    }
                                    echo "</select>";
                                } else {
                                    echo "0";
                                }
                            }
                            ?>
                        </div>
                        <div class="inputbox">
                            <select name ='langs'>
                                <option value='EN'>Lang EN</option>
                                <option value='NL'>Lang NL</option>
                            </select>
                        </div>
                    </div>
                    <div class='secondtable'>
                        <div class="inputbox">
                        <input type='text' name='ID' required title="use , to set anther id">
                        <label for=""><?php echo $lang['fID'] ?></label>
                        </div>
                    </div>
                    <div class='secondtable'>
                    <?php
                            $info = "SELECT werkzaamheden.ID,medewerkers.Voornaam,werkzaamheden.Datum, werkzaamheden.Werkzaamheden FROM `werkzaamheden` INNER JOIN medewerkers ON werkzaamheden.medewerkerID = medewerkers.ID";
                            $result1 = mysqli_query($conn, $info);
                            echo "<table>";
                            if ($result1 == true) {
                                if ($result1->num_rows > 0) {
                                    // output data of each row
                                    echo "<td><tr><th>".$lang['ID']."</th><th>".$lang['Name']."</th><th>".$lang['date']."<th>".$lang['Activities']."</th></tr></td>";

                                    while ($row = $result1->fetch_assoc()) { // Corrected variable name to $result1
                                        $id = $row['ID'];
                                        $fname = $row['Voornaam'];
                                        $sdate = $row['Datum'];
                                        $wz = $row['Werkzaamheden'];
                                        echo  "<td><tr><th>". $id."</th><th>". $fname."</th><th>".$sdate."</th><th>". $title1 . "</th></tr></td>";
                                    }
                                } else {
                                    echo "0";
                                }
                            }
                            echo "</table>"
                            ?>
                    
                    </div>
                    <button type="submit" name='change' class='button'>
                        <?php echo $lang['gfactuur'] ?>
                    </button>
                </form>
            </div>
        </div>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>