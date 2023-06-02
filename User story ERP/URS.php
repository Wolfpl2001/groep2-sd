<?php
session_start();

include 'config.php';
if(isset($_POST['Login'])){

    $Personid = mysqli_real_escape_string($conn,$_POST['Personid']);
    $pass = md5($_POST['password']);
    
    $select = "SELECT * FROM user_form WHERE Personid = '$Personid' && password = '$pass' ";
    
    $result = mysqli_query($conn, $select);
    
    if(mysqli_num_rows($result) > 0){
    
        $row = mysqli_fetch_array($result);
    
        if($row['user_type'] == 'admin'){
    
            $_SESSION['user_name'] = $row['FirstName'];
            $_SESSION['user_type'] = $row['user_type'];
            $_SESSION['user_lname'] = $row['LastName'];
            header('Location: main.php');
          
    
        }elseif($row['user_type'] == 'user'){
    
            $_SESSION['user_name'] = $row['FirstName'];
            $_SESSION['user_type'] = $row['user_type'];
            $_SESSION['user_lname'] = $row['LastName'];
            header('location:user_main.php');
        }
    }elseif(
        $error[] = $lang['error_loggin']
        );
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="CSS/URS.css">
  <title>GildeDEVops Database</title>
</head>
<body>
    <section>
        <div class="form-box">
            <div class="form-value">
                <form action="index.php" method="post">
                    <a href= "main.php"><ion-icon name="arrow-back-outline" class="arrow"></ion-icon></a>
                    <a href= "URS.php?lang=nl"><img src="img/NL.png" alt="NL Flag" class="flag-nl" href="nl-index.html"></a>
                    <a href= "URS.php?lang=en"> <img src="img/eng.png" alt="ENG Flag" class="flag-en used"></a>
                    <h2><?php echo $lang['reg_hours']?></h2>
                    <?php
                    if(isset($error)){
                        foreach($error as $error){
                            echo '<span class="error-msg">' .$error. '</span>';
                        };
                    };
                    ?>
                </form>
                  <p id = demo></p>
                  <br>  
                  <button id = "start"> start timer </button>
                  <br>
                  <br>              
                  <button id = "stop"> stop timer </button> <br> <br>
                  <button id = "reset">reset timer </button>
            
            </div>
        </div>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="scriptsURS.js"></script>
</body>
</html>
