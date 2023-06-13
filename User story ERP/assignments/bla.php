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
$sql = "SELECT * FROM `opdrachten` WHERE id = $ids";

$utype = $_SESSION['user_type'];
$id = "";
$klantid = "";
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
            $klant = $row['medewerkers.ID'];
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
    $klant = $_GET['medewerkers.ID'];
    $title = $_GET['Titel'];
    $om = $_GET['Omschrijving'];
    $date = $_GET['Aanvraagdatum'];
    $bk = $_GET['Benodigde_kennis'];
    $contact = $_GET['Contact'];
    $tel = $_GET['Telefoon_Nummer'];




    $select = "SELECT * FROM opdrachten WHERE ID = '$ids'";

    $result = mysqli_query($conn, $select);
    if ($npass == $npassc && $pass != $npass) {
        $update = "UPDATE `medewerkers` SET `Voornaam`='$name',`Tussenvoegsel`='$ins',`Achternaam`='$lname',`Geboortedatum`='$birth',`Functie`='$function',`Werkmail`='$wemail',`Kantoorruimte`='$office',`password`='$password',`user_type`='$utype' WHERE ID='$ids'";
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
                            <ion-icon name="person-outline"></ion-icon>
                            <input type="text" name="name" value="<?= $klant ?>" required>
                            <label for="">
                                <?php echo $lang['Name'] ?>
                            </label>
                        </div>
                        <div class="inputbox">
                            <ion-icon name="person-outline"></ion-icon>
                            <input type="text" name="ins" value="<?php echo $title; ?>">
                            <label for="">
                                <?php echo $lang['insertion'] ?>
                            </label>
                        </div>
                    </div>
                    <div class='secondtable'>
                        <div class="inputbox">
                            <ion-icon name="person-outline"></ion-icon>
                            <input type="text" name="Lname" value="<?php echo $om; ?>" required>
                            <label for="">
                                <?php echo $lang['Lname'] ?>
                            </label>
                        </div>
                        <div class="inputbox">
                            <input type="date" name="birth" value="<?php echo $date; ?>">
                            <label for="">
                                <?php echo $lang['Birth'] ?>
                            </label>
                        </div>
                    </div>
                    <div class='secondtable'>
                        <div class="inputbox">
                            <ion-icon name="build-outline"></ion-icon>
                            <input type="Text" name="Function" value="<?php echo $contact; ?>" required>
                            <label for="">
                                <?php echo $lang['Function'] ?>
                            </label>
                        </div>
                        <div class="inputbox">
                            <ion-icon name="mail-outline"></ion-icon>
                            <input type="number" name="Wemail" value="<?php echo $tel; ?>" required>
                            <label for="">
                                <?php echo $lang['Wemail'] ?>
                            </label>
                        </div>
                    </div>
                    <div class='secondtable'>
                        <div class="inputbox1">
                            <textarea type="Text" name="Function" rows="0" cols="90"required><?php echo $bk; ?></textarea>
                            <label for="">
                                <?php echo $lang['Function'] ?>
                            </label>
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