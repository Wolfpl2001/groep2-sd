<?php
session_start();
if (!isset($_SESSION['user_type']))
    header('Location: ../index.php');
if ($_SESSION['user_type'] == 'user')
    header('Location: ../index.php');

include '../config.php';

$ids = $_GET['id'];
$name = "";
$lname = "";
$tel = "";
$adres = "";
//$search = $_GET['search'];
// Retrieve data for the specified ID
$sql = "SELECT * FROM `klanten` WHERE id = $ids";

// $sql = "SELECT * FROM `medewerkers` WHERE name LIKE '%$search%' OR achternaam LIKE '%search%';";

$result = $conn->query($sql);
if ($result == true) {
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $ids = $_GET['id'];
            $name = $row['Voornaam'];
            $lname = $row['Achternaam'];
            $tel = $row['Tel'];
            $adres = $row['Adres'];
        }
    } else {
        echo "0 results";
    }
} else {
    echo "Error";
}

if (isset($_POST['change'])) {

    $ids = $_GET['id'];
    $name = $_POST['name'];
    $lname = $_POST['Lname'];
    $tel = $_POST['tel'];
    $adres = $_POST['adres'];




    $select = "SELECT * FROM `klanten` WHERE ID = '$ids'";

    $result = mysqli_query($conn, $select);
    if (1 == 1) {
        $update = "UPDATE `klanten` SET `ID`='$ids',`Achternaam`='$lname',`Voornaam`='$name',`Adres`='$adres',`Tel`='$tel' WHERE ID = '$ids'";
        mysqli_query($conn, $update);
        header('location:customers.php');

    }
}
if (isset($_POST['delete'])) {
    $select = "SELECT * FROM klanten WHERE ID = '$ids' && password = '$pass' ";
    $result = mysqli_query($conn, $select);
    if (isset($_POST['delete'])) {
        $update = "DELETE FROM klanten WHERE `klanten`.`ID` = $ids";
        mysqli_query($conn, $update);
        header('location:customers.php');

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
                        <div class="inputbox">
                            <ion-icon name="person-outline"></ion-icon>
                            <input type="text" name="name" value="<?= $name ?>" required>
                            <label for="">
                                <?php echo $lang['Name'] ?>
                            </label>
                        </div>
                        <div class="inputbox">
                            <ion-icon name="person-outline"></ion-icon>
                            <input type="text" name="Lname" value="<?php echo $lname; ?>">
                            <label for="">
                                <?php echo $lang['Lname'] ?>
                            </label>
                        </div>
                        <div class="inputbox">
                            <ion-icon name="person-outline"></ion-icon>
                            <input type="text" name="adres" value="<?php echo $adres; ?>" required>
                            <label for="">
                                <?php echo $lang['adres'] ?>
                            </label>
                        </div>
                        <div class="inputbox">
                            <input type="number" name="tel" value="<?php echo $tel; ?>">
                            <label for="">
                                <?php echo $lang['pnumber'] ?>
                            </label>
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