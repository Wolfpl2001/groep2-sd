<!DOCTYPE html>
<?php
  //Connect to Database
  include "../config.php";
  $sql = "SELECT * FROM werkzaamheden;";
  $result = mysqli_query($conn, $sql);
  $resultCheck = mysqli_num_rows($result);
?>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="medewerkers.css">
        <!--Connect to Bootstrap-->
        <link href=https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src=https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    </head>
    <body>

        <table class='table'> <!--Automatically generated table from mySQL Database-->
            <thead>
                <tr>
                <th>ID</th>
                <th>Voornaam</th>
                <th>Tussenvoegsel</th>
                <th>Achternaam</th>
                <th>Geboortedatum</th>
                <th>Functie</th>
                <th>Werkmail</th>
                <th>Kantoorruimte</th>
                </tr>
            </thead>

            <tbody>
                <?php
                if ($resultCheck > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                    echo
                        "<tr>" .
                        "<th>" . $row['ID'] . "</th>" . 
                        "<td>" . $row['Voornaam'] . "</td>" . 
                        "<td>" . $row['Tussenvoegsel'] . "</td>" . 
                        "<td>" . $row['Achternaam'] . "</td>" . 
                        "<td>" . $row['Geboortedatum'] . "</td>" . 
                        "<td>" . $row['Functie'] . "</td>" .
                        "<td>" . $row['Werkmail'] . "</td>" .
                        "<td>" . $row['Kantoorruimte'] . "</td>" .
                        "</tr>";
                    }
                }
                ?>
            <tbody>
        </table>
        
    </body>
</html>

