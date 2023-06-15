<?php
session_start();
if (!isset($_SESSION['user_type']))
    header('Location: ../index.php');

include '../config.php';



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
        $update = "INSERT INTO `opdrachten`( `KlantID`, `Titel`, `Omschrijving`, `Aanvraagdatum`, `Benodigde_kennis`, `Contact`, `Telefoon_Nummer`) VALUES ('$klant','$title','$om','$date','$bk','$contact','$tel')";
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
                <form action="" method="post">
                    <h2>
                        <?php echo $lang['Register'] ?>
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
                            <input type="text" name="titel" required>
                            <label for="">
                                <?php echo $lang['title'] ?>
                            </label>
                        </div>
                    </div>
                    <div class='secondtable'>
                        <div class="inputbox">
                            <ion-icon name="person-outline"></ion-icon>
                            <input type="text" name="omschrijving" required>
                            <label for="">
                                <?php echo $lang['description'] ?>
                            </label>
                        </div>
                        <div class="inputbox">
                            <input type="date" name="aanvraagdatum">
                            <label for="">
                                <?php echo $lang['adate'] ?>
                            </label>
                        </div>
                    </div>
                    <div class='secondtable'>
                        <div class="inputbox">
                            <ion-icon name="build-outline"></ion-icon>
                            <input type="Text" name="contact" required>
                            <label for="">
                                <?php echo $lang['contact'] ?>
                            </label>
                        </div>
                        <div class="inputbox">
                            <ion-icon name="mail-outline"></ion-icon>
                            <input type="number" name="telefoon_Nummer" required>
                            <label for="">
                                <?php echo $lang['pnumber'] ?>
                            </label>
                        </div>
                    </div>
                    <div class='secondtable'>
                        <div class="inputbox1">
                            <label for=""><?php echo $lang['rknowledge'] ?></label>
                            <textarea type="Text" name="benodigde_kennis" rows="0" cols="90"required></textarea>
                        </div>
                    </div>
                    <p></p>
                    <button type="submit" name='change' class='button'>
                        <?php echo $lang['Register'] ?>
                    </button>
                </form>
            </div>
        </div>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>