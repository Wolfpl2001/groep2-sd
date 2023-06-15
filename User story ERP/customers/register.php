<?php
session_start();
if (!isset($_SESSION['user_type']))
    header('Location: ../index.php');
if ($_SESSION['user_type'] == 'user')
    header('Location: ../index.php');

include '../config.php';

$name = "";
$lname = "";
$tel = "";
$adres = "";
//$search = $_GET['search'];
// Retrieve data for the specified ID
$sql = "SELECT * FROM `klanten`";

// $sql = "SELECT * FROM `medewerkers` WHERE name LIKE '%$search%' OR achternaam LIKE '%search%';";

$result = $conn->query($sql);
if ($result == true) {
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
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


    $name = $_POST['name'];
    $lname = $_POST['Lname'];
    $tel = $_POST['tel'];
    $adres = $_POST['adres'];




    $select = "SELECT * FROM `klanten`";

    $result = mysqli_query($conn, $select);
    if (1 == 1) {
        $update = "INSERT INTO `klanten`(`Achternaam`, `Voornaam`, `Adres`, `Tel`) VALUES ('$name','$lname','$adres','$tel')";
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
                <form action="" method="post">
                    <h2>
                        <?php echo $lang['Register'] ?>
                    </h2>
                        <div class="inputbox">
                            <ion-icon name="person-outline"></ion-icon>
                            <input type="text" name="name"  required>
                            <label for="">
                                <?php echo $lang['Name'] ?>
                            </label>
                        </div>
                        <div class="inputbox">
                            <ion-icon name="person-outline"></ion-icon>
                            <input type="text" name="Lname"required>
                            <label for="">
                                <?php echo $lang['Lname'] ?>
                            </label>
                        </div>
                        <div class="inputbox">
                            <ion-icon name="person-outline"></ion-icon>
                            <input type="text" name="adres" required>
                            <label for="">
                                <?php echo $lang['adres'] ?>
                            </label>
                        </div>
                        <div class="inputbox">
                            <input type="number" name="tel">
                            <label for="">
                                <?php echo $lang['pnumber'] ?>
                            </label>
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