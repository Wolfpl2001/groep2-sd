<?php 
require_once __DIR__ . '/vendor/autoload.php';
include 'config.php';

$stylesheet = file_get_contents('CSS/mpdfbootstrap.css');
$sql = "SELECT
werkzaamheden.ID,
medewerkers.Voornaam,
medewerkers.Tussenvoegsel,
medewerkers.Achternaam,
werkzaamheden.Datum,
werkzaamheden.Werkzaamheden,
werkzaamheden.Totaal_Uren,
klanten.Voornaam as VoornaamKlant,
klanten.Achternaam as Achternaamklant,
klanten.Adres,
klanten.Tel,
opdrachten.ID,
opdrachten.Titel,
opdrachten.Omschrijving,
opdrachten.Aanvraagdatum
FROM
`werkzaamheden`
INNER JOIN medewerkers ON werkzaamheden.medewerkerID = medewerkers.ID
INNER JOIN opdrachten ON opdrachten.ID = werkzaamheden.opdrachtID
INNER JOIN klanten ON klanten.ID = opdrachten.KlantID";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

$id = $_GET['OpdrachtID'];
$kname = $row['VoornaamKlant'];
$klname = $row['Achternaamklant'];
$kadres = $row['Adres'];
$tel = $row['Tel'];
$ids = $row['ID'];
$mname = $row['Voornaam'];
$mins = $row['Tussenvoegsel'];
$mlname = $row['Achternaam'];
$date = $row['Datum'];



$pdf = "
<img src='img/logo.png' alt='Italian Trulli' class='logo'>
<h1 class='info-text'>" . $lang['Factuur'] . "</h1>
<hr>
<h1 class='center'>" . $lang['cinfo'] . "</h1>
<table class=table>
    <tr>
        <td>" . $lang['Name'] . "</td>
        <td>" . $lang['Lname'] . "</td>
        <td>" . $lang['adres'] . "</td>
        <td>" . $lang['pnumber'] . "</td>
    </tr>
    <tr>
        <td>" . $kname . "</td>
        <td>" . $klname . "</td>
        <td>".$kadres."</td>
        <td>".$tel."</td>
    </tr>
</table>
<hr>
<h1 class='center'>" . $lang['Assignments'] . "</h1>
<table class=table>
    <tr>
        <td>" . $lang['Titel'] . "</td>
        <td>" . $lang['description'] . "</td>
        <td>" . $lang['adres'] . "</td>
        <td>" . $lang['pnumber'] . "</td>
    </tr>
    <tr>
        <td>" . $kname . "</td>
        <td>" . $klname . "</td>
        <td>".$kadres."</td>
        <td>".$tel."</td>
    </tr>
</table>
<hr>
<h1 class='center'>" . $lang['Activities'] . "</h1>
<table class=table>
    <tr>
        <td>" . $lang['Titel'] . "</td>
        <td>" . $lang['description'] . "</td>
        <td>" . $lang['adres'] . "</td>
        <td>" . $lang['pnumber'] . "</td>
    </tr>
    <tr>
        <td>" . $kname . "</td>
        <td>" . $klname . "</td>
        <td>".$kadres."</td>
        <td>".$tel."</td>
    </tr>
</table>
<hr>
<h1 class='center'>" . $lang['Costs'] . "</h1>
<table class=table>
    <tr>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
    </tr>
</table>
";

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->WriteHTML($pdf);
$mpdf->Output();


?>