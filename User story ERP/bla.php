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
    }
} else {
echo "0 results";
}
} else {
echo "Error";
}

if(isset($_POST['submit'])){

    $names = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $user_type = $_POST['user_type'];

    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0){

        $error[] = $lang['error_user'];

    }else{
        if($pass != $cpass){
            $error[] = $lang['error_password'];
        }else{
            $insert = "UPDATE user_form SET Voornaam='$_post[name]', Tussenvoegsel='$_post[tussenvoegsel], Achternaam='$_post[achternaam],Geboortedatum='$_post[Geboortedatum],Functie='$_post[functie],Werkemail='$_post[werkemail],Kantoorruimte='$_post[rumte]' WHERE id = $ids";
            mysqli_query($conn, $insert);
            header('location:admin_page.php');
        }

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
        <div class="form-box">
            <div class="form-value">
                <?php
  //while($row = $result->fetch_assoc()) {
    echo "<h1>ID: ".$ids."</br>Name: ". $name."</br>Tussenvoegsel: ". $tussenvoegsel."</br>Achternaam: ". $achternaam."</br>Geboortedatum: ". $gebortedatum."</br>Functie: ". $functie."</br>Werkmail: ". $werkemail."</br>Kantoorruimte: ". $rumte."</h1>";
                ?>
            </div>
        </div>
        <div class="form-box1">
            <div class="form-value">
            <form action="register.php" method="post">
                        <h2><?php echo $lang['Change']?></h2>
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
                    <div class="inputbox">
                        <ion-icon name="person-outline"></ion-icon>
                        <input type="text" name="Lname" value="<?php echo $achternaam; ?>" required>
                        <label for=""><?php echo $lang['Lname']?></label>
                    </div>
                    <div class="inputbox">
                    <input type="text" name="input" value="<?php echo $gebortedatum; ?>" required pattern="(?:19|20)/[0-9\]{2}-(?:(?:0\[1-9\]|1\[0-2\])/(?:0\[1-9\]|1\[0-9\]|2\[0-9\])|(?:(?!02)(?:0\[1-9\]|1\[0-2\])/(?:30))|(?:(?:0\[13578\]|1\[02\])-31))" title="Enter a date in this format YYYY/MM/DD"/>
                        <label for=""><?php echo $lang['Birth']?></label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="Text" name="Function" value="<?php echo $functie; ?>" required>
                        <label for=""><?php echo $lang['Function']?></label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="email" name="Wemail" value="<?php echo $werkemail; ?>" required>
                        <label for=""><?php echo $lang['Wemail']?></label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="test" name="Office" value="<?php echo $rumte; ?>" required>
                        <label for=""><?php echo $lang['Office']?></label>
                    </div>
                    <p></p>
                    <button type="submit" name='submit'><?php echo $lang['Change']?></button>
                </form>
            </div>
        </div>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
