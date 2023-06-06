<?php
session_start();

include 'config.php';

$ids = $_GET['id'];
$name = "";
$tussenvoegsel = "";
$achternaam = "";
$gebortedatum = "";
$functie = "";
$werkemail = "";
$rumte = "";
//$search = $_GET['search'];
// Retrieve data for the specified ID
$sql = "SELECT * FROM `medewerkers` WHERE id = $ids";

// $sql = "SELECT * FROM `medewerkers` WHERE name LIKE '%$search%' OR achternaam LIKE '%search%';";

$result = $conn->query($sql);
if ($result == true) {
    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $name = $row['Voornaam'];
        $tussenvoegsel = $row['Tussenvoegsel'];
        $achternaam = $row['Achternaam'];
        $gebortedatum = $row['Geboortedatum'];
        $functie = $row['Functie'];
        $werkemail = $row['Werkmail'];
        $rumte = $row['Kantoorruimte'];
        $pass = md5($row['password']);
        $utype1 = $row['user_type'];
    }
} else {
echo "0 results";
}
} else {
echo "Error";
}

if(isset($_POST['change'])){

    $ids = $_GET['id'];
    $name = $_POST['name'];
    $ins = $_POST['ins'];
    $lname = $_POST['Lname'];
    $birth = $_POST['birth'];
    $function = $_POST['Function'];
    $wemail = $_POST['Wemail'];
    $office = $_POST['Office'];
    $password = md5($_POST['password']);
    $utype = $_POST['user_type'];
    


    
    $select = "SELECT * FROM medewerkers WHERE ID = '$Personid' && password = '$pass' ";
    
    $result = mysqli_query($conn, $select);
    if($npass == $npassc && $pass != $npass) {
        $update = "UPDATE `medewerkers` SET `Voornaam`='$name',`Tussenvoegsel`='$ins',`Achternaam`='$lname',`Geboortedatum`='$birth',`Functie`='$function',`Werkmail`='$wemail',`Kantoorruimte`='$office',`password`='$password',`user_type`='$utype' WHERE ID='$ids'";
        mysqli_query($conn, $update);
        header('location:medewerkers.php');

    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="CSS/bla.css">
  <title>GildeDEVops Database</title>
</head>
<body>
    <section>
        <div class="form-box1">
            <div class="form-value">
            <form action="" method="post">
                        <h2><?php echo $lang['Change']?></h2>
                    <div class='secondtable'>
                        <div class="inputbox">
                            <ion-icon name="person-outline"></ion-icon>
                            <input type="text" name="name" value="<?= $name ?>" required>
                            <label for=""><?php echo $lang['Name']?></label>
                        </div>
                    <div class="inputbox">
                        <ion-icon name="person-outline"></ion-icon>
                            <input type="text" name="ins" value="<?php echo $tussenvoegsel; ?>">
                            <label for=""><?php echo $lang['insertion']?></label>
                        </div>
                    </div>
                    <div class='secondtable'>
                        <div class="inputbox">
                            <ion-icon name="person-outline"></ion-icon>
                            <input type="text" name="Lname" value="<?php echo $achternaam; ?>" required>
                            <label for=""><?php echo $lang['Lname']?></label>
                        </div>
                        <div class="inputbox">
                            <input type="date" name="birth" value="<?php echo $gebortedatum; ?>">
                            <label for=""><?php echo $lang['Birth']?></label>
                        </div>
                    </div>
                    <div class='secondtable'>
                        <div class="inputbox">
                            <ion-icon name="build-outline"></ion-icon>
                            <input type="Text" name="Function" value="<?php echo $functie; ?>" required>
                            <label for=""><?php echo $lang['Function']?></label>
                        </div>
                        <div class="inputbox">
                            <ion-icon name="mail-outline"></ion-icon>
                            <input type="email" name="Wemail" value="<?php echo $werkemail; ?>" required>
                            <label for=""><?php echo $lang['Wemail']?></label>
                        </div>
                    </div>
                    <div class='secondtable'>
                        <div class="inputbox">
                            <ion-icon name="business-outline"></ion-icon>
                            <input type="test" name="Office" value="<?php echo $rumte; ?>" required>
                            <label for=""><?php echo $lang['Office']?></label>
                        </div>
                        <div class="inputbox">
                            <ion-icon name="lock-closed-outline"></ion-icon>
                            <input type="test" name="password" required>
                            <label for=""><?php echo $lang['passwor']?></label>
                        </div>
                    </div>
                    <select name="user_type" value="<?php echo $utype1?>">
                            <option value="user"><?php echo $lang['user']?></option>
                            <option value="admin"><?php echo $lang['admin']?></option>
                        </select>
                    <p></p>
                    <button type="submit" name='change'><?php echo $lang['Change']?></button>
                </form>
            </div>
        </div>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
