<?php
session_start();
if(!isset($_SESSION['user_type'])) header('Location: index.php');
if($_SESSION['user_type'] == 'user') header('Location: index.php');

include 'config.php';

if(isset($_POST['lang'])){}

if(isset($_POST['submit'])){

    $name = mysqli_real_escape_string($conn, $_POST['FirstName']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $pass = md5($_POST['password']);
    $cpass = md5($_POST['cpassword']);
    $user_type = $_POST['user_type'];
    $bday = $_POST['bday'];
    $infix = $_POST['infix'];
    $workplace = $_POST['workplace'];
    $function = $_POST['function'];

    $select = "SELECT * FROM medewerkers WHERE Werkmail = '$email' && password = '$pass' ";

    $result = mysqli_query($conn, $select);

    if(mysqli_num_rows($result) > 0){

        $error[] = $lang['error_user'];

    }else{
        if($pass != $cpass){
            $error[] = $lang['error_password'];
        }else{
            $insert = "INSERT INTO medewerkers(Achternaam, Tussenvoegsel, Voornaam, password, user_type, Werkmail, Geboortedatum, Kantoorruimte, Functie) VALUES ('$lname','$infix','$name','$pass','$user_type','$email','$bday','$workplace','$function')";
            mysqli_query($conn, $insert);
            header('location:main.php');
        }

    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="CSS/register.css">
  <title>GildeDEVops Database</title>
</head>
<body>
    <section>
        <div class="form-box">
            <div class="form-value">
                <div name="lang">
                    <a href="main.php"><ion-icon name="arrow-back-outline" class="arrow"></ion-icon></a>
                    <a href="register.php?lang=nl"><img src="img/NL.png" alt="NL Flag" class="flag-nl" href="nl-index.html" name="lang"></a>
                    <a href="register.php?lang=en"><img src="img/eng.png" alt="ENG Flag" class="flag-en used"></a>
                </div>
                    <form action="register.php" method="post">
                        <h2><?php echo $lang['Register']?></h2>
                        <?php
                        if(isset($error)){
                            foreach($error as $error){
                                echo '<span class="error-msg">' .$error. '</span>';
                            };
                        };
                        ?>
                        <div class="inputbox">
                            <ion-icon name="person-outline"></ion-icon>
                            <input type="text" name="FirstName" required>
                            <label for=""><?php echo $lang['Name']?></label>
                        </div>
                        <div class="inputbox">
                            <ion-icon name="person-outline"></ion-icon>
                            <input type="text" name="infix">
                            <label for=""><?php echo $lang['insertion']?></label>
                        </div>
                        <div class="inputbox">
                            <ion-icon name="person-outline"></ion-icon>
                            <input type="text" name="lname" required>
                            <label for=""><?php echo $lang['Lname']?></label>
                        </div>
                    <div class="inputbox">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input type="email" name="email" required>
                        <label for=""><?php echo $lang['E-mail']?></label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="password" name="password" min="5" required>
                        <label for=""><?php echo $lang['passwor']?></label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="password" name="cpassword" min="5" required>
                        <label for=""><?php echo $lang['Confirm_Password']?></label>
                    </div>
                    <div class="inputbox">
                            <ion-icon name="person-outline"></ion-icon>
                            <input type="date" name="bday"  required>
                            <label for=""><?php echo $lang['Birth']?></label>
                    <div>
                    <div class="inputbox">
                            <ion-icon name="person-outline"></ion-icon>
                            <input type="text" name="function" required>
                            <label for=""><?php echo $lang['Function']?></label>
                        </div>
                        <div class="inputbox">
                            <ion-icon name="person-outline"></ion-icon>
                            <input type="text" name="workplace" required>
                            <label for=""><?php echo $lang['Office']?></label>
                        </div>
                        <select name="user_type">
                            <option value="user"><?php echo $lang['user']?></option>
                            <option value="admin"><?php echo $lang['admin']?></option>
                        </select>
                    </div>
                    <p></p>
                    <button type="submit" name='submit'><?php echo $lang['Register']?></button>
                </form>
            </div>
        </div>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>