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
$sql = "SELECT werkzaamheden.ID, werkzaamheden.medewerkerID,werkzaamheden.Datum, werkzaamheden.Werkzaamheden, werkzaamheden.Totaal_Uren FROM medewerkers INNER JOIN werkzaamheden ON medewerkers.ID = werkzaamheden.medewerkerID WHERE werkzaamheden.ID = $ids";

$utype = $_SESSION['user_type'];
$ids = $_GET['id'];
$klant = '';
$indate = '';
$stime = '';
$br = '';
$etime = '';
$work = '';
$tu = '';
$uname = $_SESSION['user_name'];
// $sql = "SELECT * FROM `medewerkers` WHERE name LIKE '%$search%' OR achternaam LIKE '%search%';";

$result = $conn->query($sql);
if ($result == true) {
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $mid = $row['medewerkerID'];
            $indate = $row['Datum'];
            $work = $row['Werkzaamheden'];
            $tu = $row['Totaal_Uren'];
        }
    } else {
        echo "0 results";
    }
} else {
    echo "Error";
}

if (isset($_POST['change'])) {

    $mid = $_POST['WorkerID'];
    $indate = $_POST['Datum'];
    $work = $_POST['Werkzaamheden'];
    $tu = $_POST['Totaal'];
  



    $select = "SELECT werkzaamheden.ID, werkzaamheden.medewerkerID,werkzaamheden.Datum, werkzaamheden.Werkzaamheden, werkzaamheden.Totaal_Uren FROM medewerkers INNER JOIN werkzaamheden ON medewerkers.ID = werkzaamheden.medewerkerID WHERE werkzaamheden.ID = $ids";

    $result = mysqli_query($conn, $select);
    if ($mid==$mid) {
        $update = "UPDATE `werkzaamheden` SET `medewerkerID`='$mid',`Datum`='$indate',`Werkzaamheden`='$work' WHERE ID = $ids";
        mysqli_query($conn, $update);
        header('location:activities.php');

    }
}
if (isset($_POST['delete'])) {
    $select = "SELECT * FROM werkzaamheden WHERE ID = '$ids'";
    $result = mysqli_query($conn, $select);
    if (isset($_POST['delete'])) {
        $update = "DELETE FROM `werkzaamheden` WHERE ID = '$ids'";
        mysqli_query($conn, $update);
        header('location:activities.php');

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
                            $info = "SELECT `ID`, `Achternaam`, `Voornaam` FROM `medewerkers`";
                            $result1 = mysqli_query($conn, $info);
                            if ($result1 == true) {
                                if ($result1->num_rows > 0) {
                                    // output data of each row
                                    echo "<select name= 'WorkerID'>";
                                    while ($row = $result1->fetch_assoc()) { // Corrected variable name to $result1
                                        $id = $row['ID'];
                                        $fname = $row['Voornaam'];
                                        $lastn = $row['Achternaam'];
                                        echo "<option value=" . $id . ($mid == $id ? " selected" : "") . ">" . $id."&nbsp". $fname."&nbsp". $lastn . "</option>";
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
                            <input type="text" name="Datum" value="<?php echo $indate; ?>">
                            <label for="">
                                <?php echo $lang['date'] ?>
                            </label>
                        </div>
                    </div>
                    <div class='secondtable'>
                        <div class="inputbox">
                            <input type="text" name="Werkzaamheden" value="<?php echo $work; ?>">
                            <label for="">
                                <?php echo $lang['Activities'] ?>
                            </label>
                        </div>
                        <div class="inputbox">
                            <ion-icon name="mail-outline"></ion-icon>
                            <input type="text" name="Totaal" value="<?php echo $tu; ?>" disabled>
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