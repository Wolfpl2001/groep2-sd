<?php
session_start();

include '../config.php';

$workhours = 
print_r($workhours);

$sql = "INSERT INTO werkzaamheden(Werknemer_ID, Aantal_Uren, Projectnaam, Omschrijving_Werkzaamheden) 
    VALUES ('$Werknemer_ID', '$Aantal_Uren','$Projectnaam','$Omschrijving_Werkzaamheden')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: werkzaamheden.php?msg=New record created succesfully");
    } else {
        echo "Failed: " . mysqli_error($conn);
    }   
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../CSS/URS.css">
    <title>GildeDEVops Database</title>
</head>

<body>
    <section>
        <div class="form-box">
            <div class="form-value">
                <form action="index.php" method="post">
                    <a href= "../mains/main.php"><ion-icon name="arrow-back-outline" class="arrow"></ion-icon></a>
                    <a href= "URS.php?lang=nl"><img src="../img/NL.png" alt="NL Flag" class="flag-nl" href="nl-index.html"></a>
                    <a href= "URS.php?lang=en"> <img src="../img/eng.png" alt="ENG Flag" class="flag-en used"></a>
                    <h2><?php echo $lang['reg_hours']?></h2>
                    <?php
                    if (isset($error)) {
                        foreach ($error as $error) {
                            echo '<span class="error-msg">' . $error . '</span>';
                        }
                        ;
                    }
                    ;
                    ?>
                </form>
                <form>
                <imput type=number id=demo name=output value="<?php echo '<p id=demo></>' ?>"> </imput>
                
                </form>
                <br>
                <button id="start"><?php echo $lang['start_werk']?></button>
                <br>
                <br>
                <button id="stopbtn"><?php echo $lang['pauze']?> </button> <br> <br>
                <form>
                <button id="reset"><?php echo $lang['eind_werk']?></button>
                </form>
                

            </div>
        </div>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="scriptsURS.js"></script>
</body>

</html>