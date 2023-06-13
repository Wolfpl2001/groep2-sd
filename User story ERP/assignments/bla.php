<?php
session_start();
if (!isset($_SESSION['user_type']))
    header('Location: ../index.php');
if ($_SESSION['user_type'] == 'user')
    header('Location: ../index.php');

include '../config.php';

$ids = $_GET['id'];

//$search = $_GET['search'];
// Retrieve data for the specified ID
$sql = "SELECT opdrachten.ID, opdrachten.KlantID,opdrachten.Titel, opdrachten.Omschrijving, opdrachten.Aanvraagdatum, opdrachten.Benodigde_kennis, opdrachten.Contact, opdrachten.Telefoon_Nummer, opdrachten.KlantID  FROM klanten INNER JOIN opdrachten ON klanten.ID = opdrachten.KlantID";

$utype = $_SESSION['user_type'];
$ids = "";
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
            $ids = $row['ID'];
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

    $ids = $row['ID'];
    $klant = $_GET['klantID'];
    $title = $_GET['Titel'];
    $om = $_GET['Omschrijving'];
    $date = $_GET['Aanvraagdatum'];
    $bk = $_GET['Benodigde_kennis'];
    $contact = $_GET['Contact'];
    $tel = $_GET['Telefoon_Nummer'];




    $select = "SELECT opdrachten.ID, klanten.Voornaam,opdrachten.Titel, opdrachten.Omschrijving, opdrachten.Aanvraagdatum, opdrachten.Benodigde_kennis, opdrachten.Contact, opdrachten.Telefoon_Nummer  FROM klanten INNER JOIN opdrachten ON klanten.ID = opdrachten.KlantID";

    $result = mysqli_query($conn, $select);
    if ($npass == $npassc && $pass != $npass) {
        $update = "UPDATE `medewerkers` SET `Voornaam`='$klant',`Tussenvoegsel`='$title',`Achternaam`='$om',`Geboortedatum`='$date',`Functie`='$bk',`Werkmail`='$contact',`Kantoorruimte`='$tel'WHERE ID='$ids'";
        mysqli_query($conn, $update);
        header('location:medewerkers.php');

    }
}
if (isset($_POST['delete'])) {
    $select = "SELECT * FROM medewerkers WHERE ID = '$ids' && password = '$pass' ";
    $result = mysqli_query($conn, $select);
    if (isset($_POST['delete'])) {
        $update = "DELETE FROM medewerkers WHERE `medewerkers`.`ID` = $ids";
        mysqli_query($conn, $update);
        header('location:medewerkers.php');

    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../CSS/bla.css">
    <title>GildeDEVops Database</title>
</head>

<body>
    <section>
        <div class="form-box1">
            <div class="form-value">
                <form action="" method="POST">
                    <button name="delete" class='delete'><ion-icon name="trash-outline"></ion-icon></button>
                </form>
                <form action="" method="post">
                    <h2>
                        <?php echo $lang['Change'] ?>
                    </h2>

                    <div class='secondtable'>
                        <div class="inputbox">
                            <?php
                            $info = "SELECT `ID`, `Achternaam`, `Voornaam` FROM `klanten`";
                            $result1 = mysqli_query($conn, $info);
                            if ($result1 == true) {
                                if ($result1->num_rows > 0) {
                                    // output data of each row
                                    echo "<select>";
                                    while ($row = $result1->fetch_assoc()) { // Corrected variable name to $result1
                                        $id = $row['ID'];
                                        $fname = $row['Voornaam'];
                                        $lastn = $row['Achternaam'];
                                        echo "<option value=" . $id . ($id == $klant ? " selected" : "") . ">" . $id."&nbsp". $fname."&nbsp". $lastn . "</option>";
                                    }
                                    echo "</select>";
                                } else {
                                    echo "0";
                                }
                            }
                            ?>
                        </div>
                        <div class="inputbox">
                            <ion-icon name="person-outline"></ion-icon>
                            <input type="text" name="Titel" value="<?php echo $title; ?>">
                            <label for="">
                                <?php echo $lang['title'] ?>
                            </label>
                        </div>
                    </div>
                    <div class='secondtable'>
                        <div class="inputbox">
                            <ion-icon name="person-outline"></ion-icon>
                            <input type="text" name="description" value="<?php echo $om; ?>" required>
                            <label for="">
                                <?php echo $lang['description'] ?>
                            </label>
                        </div>
                        <div class="inputbox">
                            <input type="date" name="Aanvraagdatum" value="<?php echo $date; ?>">
                            <label for="">
                                <?php echo $lang['adate'] ?>
                            </label>
                        </div>
                    </div>
                    <div class='secondtable'>
                        <div class="inputbox">
                            <ion-icon name="build-outline"></ion-icon>
                            <input type="Text" name="Contact" value="<?php echo $contact; ?>" required>
                            <label for="">
                                <?php echo $lang['contact'] ?>
                            </label>
                        </div>
                        <div class="inputbox">
                            <ion-icon name="mail-outline"></ion-icon>
                            <input type="number" name="Telefoon_Nummer" value="<?php echo $tel; ?>" required>
                            <label for="">
                                <?php echo $lang['pnumber'] ?>
                            </label>
                        </div>
                    </div>
                    <div class='secondtable'>
                        <div class="inputbox1">
                            <label for=""><?php echo $lang['rknowledge'] ?></label>
                            <textarea type="Text" name="Function" rows="0" cols="90"
                                required><?php echo $bk; ?></textarea>
                        </div>
                    </div>
                    <p></p>
                    <button type="submit" name='change' class='button'>
                        <?php echo $lang['Change'] ?>
                    </button>
                </form>
            </div>
        </div>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>