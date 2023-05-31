
<?php
session_start();

include 'config.php';
if(isset($_POST['Reset'])){

    $Personid = $_POST['Personid'];
    $pass = md5($_POST['password']);
    $npass = md5($_POST['npassword']);
    $npassc = md5($_POST['cnpassword']);
    
    $select = "SELECT * FROM medewerkers WHERE ID = '$Personid' && password = '$pass' ";
    
    $result = mysqli_query($conn, $select);
    if($npass == $npassc && $pass != $npass) {
        $update = "UPDATE `medewerkers` SET `password`='$npass' WHERE ID=$Personid";
        mysqli_query($conn, $update);
        header('location:index.php');

    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="CSS/password.css">
  <title>GildeDEVops Database</title>
</head>
<body>
    <section>
        <div class="form-box">
            <div class="form-value">
                <form action="" method="post">
                    <a href= "index.php"><ion-icon name="arrow-back-outline" class="arrow"></ion-icon></a>
                    <a href= "index.php?lang=nl"><img src="img/NL.png" alt="NL Flag" class="flag-nl" href="nl-index.html"></a>
                    <a href= "index.php?lang=en"> <img src="img/eng.png" alt="ENG Flag" class="flag-en used"></a>
                    <h2><?php echo $lang['reset_password']?></h2>
                    <?php
                    if(isset($error)){
                        foreach($error as $error){
                            echo '<span class="error-msg">' .$error. '</span>';
                        };
                    };
                    ?>
                    <div class="inputbox">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input type="number" name="Personid" required>
                        <label for=""><?php echo $lang['Personeel_ID']?></label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="password" name="password" required>
                        <label for=""><?php echo $lang['oudpasswor']?></label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="password" name="npassword" required>
                        <label for=""><?php echo $lang['npasswor']?></label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="password" name="cnpassword" required>
                        <label for=""><?php echo $lang['cnpasswor']?></label>
                    </div>
                    <button name='Reset'><?php echo $lang['loggi']?></button>
                </form>
            </div>
        </div>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>