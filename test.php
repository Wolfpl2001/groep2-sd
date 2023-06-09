<?php
              if ($result == true) {
                if ($result->num_rows > 0) {
                // output data of each row
                echo "<table class='table-db'><tr class='stick'><th>".$lang['ID']."</th><th>".$lang['Name']."</th><th>".$lang['insertion']."</th><th>".$lang['Lname']."</th><th>".$lang['Birth']."</th><th>".$lang['Function']."</th><th>".$lang['Wemail']."</th><th>".$lang['Office']."</th></tr>";
                while($row = $result->fetch_assoc()) {
                    $id = $row['ID'];
                    $name = $row['Voornaam'];
                    $tussenvoegsel = $row['Tussenvoegsel'];
                    $achternaam = $row['Achternaam'];
                    $gebortedatum = $row['Geboortedatum'];
                    $functie = $row['Functie'];
                    $werkemail = $row['Werkmail'];
                    $rumte = $row['Kantoorruimte'];
                    echo "<tr><td><a href=bla.php?id=".$id.">". $id."</a></td><td><a href=bla.php?id=".$id.">" .$name. "</a></td><td><a href=bla.php?id=".$id.">" . $tussenvoegsel ."</a></td><td><a href=bla.php?id=".$id.">" . $achternaam. "</a></td><td><a href=bla.php?id=".$id.">" . $gebortedatum."</a></td><td><a href=bla.php?id=".$id.">" . $functie."</a></td><td><a href=bla.php?id=".$id.">" . $werkemail. "</a></td><td><a href=bla.php?id=".$id.">". $rumte."</a></td></tr>";
                    echo "</table>";
                    } else {
                    echo "0 results";
                }
                } else {
                echo "Error";
                }
            }
            ?>