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
$sql = "SELECT opdrachten.ID, opdrachten.KlantID,opdrachten.Titel, opdrachten.Omschrijving, opdrachten.Aanvraagdatum, opdrachten.Benodigde_kennis, opdrachten.Contact, opdrachten.Telefoon_Nummer, opdrachten.KlantID  FROM klanten INNER JOIN opdrachten ON klanten.ID = opdrachten.KlantID WHERE opdrachten.ID='$ids'";

$utype = $_SESSION['user_type'];
$ids = $_GET['id'];
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

    $id = $_GET['id'];
    $klant = $_POST['KID'];
    $title = $_POST['titel'];
    $om = $_POST['omschrijving'];
    $date = $_POST['aanvraagdatum'];
    $bk = $_POST['benodigde_kennis'];
    $contact = $_POST['contact'];
    $tel = $_POST['telefoon_Nummer'];




    $select = "SELECT opdrachten.ID, klanten.Voornaam,opdrachten.Titel, opdrachten.Omschrijving, opdrachten.Aanvraagdatum, opdrachten.Benodigde_kennis, opdrachten.Contact, opdrachten.Telefoon_Nummer  FROM klanten INNER JOIN opdrachten ON klanten.ID = opdrachten.KlantID WHERE opdrachten.ID='$id'";

    $result = mysqli_query($conn, $select);
    if ($id==$ids) {
        $update = "UPDATE `opdrachten` SET `KlantID`='$klant',`Titel`='$title',`Omschrijving`='$om',`Aanvraagdatum`='$date',`Benodigde_kennis`='$bk',`Contact`='$contact',`Telefoon_Nummer`='$tel' WHERE ID='$id'";
        mysqli_query($conn, $update);
        header('location:assignmensts.php');

    }
}
if (isset($_POST['delete'])) {
    $select = "SELECT * FROM opdrachten WHERE ID = '$id'";
    $result = mysqli_query($conn, $select);
    if (isset($_POST['delete'])) {
        $update = "DELETE FROM opdrachten WHERE `opdrachten`.`ID` = $ids";
        mysqli_query($conn, $update);
        header('location:assignmensts.php');

    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../CSS/bla.css">
    <link rel="icon" type="image/x-icon" href="../img/icon.ico">
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
                                    echo "<select name= 'KID'>";
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
                            <input type="text" name="titel" value="<?php echo $title; ?>">
                            <label for="">
                                <?php echo $lang['title'] ?>
                            </label>
                        </div>
                    </div>
                    <div class='secondtable'>
                        <div class="inputbox">
                            <ion-icon name="person-outline"></ion-icon>
                            <input type="text" name="omschrijving" value="<?php echo $om; ?>" required>
                            <label for="">
                                <?php echo $lang['description'] ?>
                            </label>
                        </div>
                        <div class="inputbox">
                            <input type="date" name="aanvraagdatum" value="<?php echo $date; ?>">
                            <label for="">
                                <?php echo $lang['adate'] ?>
                            </label>
                        </div>
                    </div>
                    <div class='secondtable'>
                        <div class="inputbox">
                            <ion-icon name="build-outline"></ion-icon>
                            <input type="Text" name="contact" value="<?php echo $contact; ?>" required>
                            <label for="">
                                <?php echo $lang['contact'] ?>
                            </label>
                        </div>
                        <div class="inputbox">
                            <ion-icon name="mail-outline"></ion-icon>
                            <input type="number" name="telefoon_Nummer" value="<?php echo $tel; ?>" required>
                            <label for="">
                                <?php echo $lang['pnumber'] ?>
                            </label>
                        </div>
                    </div>
                    <div class='secondtable'>
                        <div class="inputbox1">
                            <label for=""><?php echo $lang['rknowledge'] ?></label>
                            <textarea type="Text" name="benodigde_kennis" rows="0" cols="90"
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