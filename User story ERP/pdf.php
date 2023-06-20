<?php
session_start();
require_once __DIR__ . '/vendor/autoload.php';

include 'config.php';
$id = $_GET['OpdrachtID'];
$stylesheet = file_get_contents('CSS/mpdfbootstrap.css');
$sql = "SELECT
opdrachten.ID,
klanten.Voornaam AS VoornaamKlant,
klanten.Achternaam AS Achternaamklant,
klanten.Adres,
klanten.Tel,
opdrachten.Titel,
opdrachten.Omschrijving,
opdrachten.Aanvraagdatum
FROM
`opdrachten`
INNER JOIN klanten ON klanten.ID = opdrachten.KlantID
WHERE
opdrachten.ID = '$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

$kname = $row['VoornaamKlant'];
$klname = $row['Achternaamklant'];
$kadres = $row['Adres'];
$tel = $row['Tel'];
$ids = $row['ID'];
$title = $row['Titel'];
$om = $row['Omschrijving'];
$adate = $row['Aanvraagdatum'];



$pdf = "
<img src='img/logo.png' alt='Italian Trulli' class='logo'>
<h1 class='info-text'>" . $lang['Factuur'] . "</h1>
<hr>
<h1 class='center'>" . $lang['cinfo'] . "</h1>
<table class=table>
    <tr>
        <th>" . $lang['Name'] . "</th>
        <th>" . $lang['Lname'] . "</th>
        <th>" . $lang['adres'] . "</th>
        <th>" . $lang['pnumber'] . "</th>
    </tr>
    <tr>
        <td>" . $kname . "</td>
        <td>" . $klname . "</td>
        <td>" . $kadres . "</td>
        <td>" . $tel . "</td>
    </tr>
</table>
<hr>
<h1 class='center'>" . $lang['Activities'] . "</h1>
<table class=table>";

$iduser = $_GET['IDUser'];
$sql1 = "SELECT werkzaamheden.ID, medewerkers.Voornaam, werkzaamheden.Datum,werkzaamheden.Werkzaamheden,werkzaamheden.opdrachtID, werkzaamheden.Totaal_Uren FROM `werkzaamheden` INNER JOIN medewerkers ON werkzaamheden.medewerkerID = medewerkers.ID  WHERE werkzaamheden.ID IN ($iduser)";
$result1 = mysqli_query($conn, $sql1);
$row = mysqli_fetch_array($result1);
if ($result1->num_rows > 0) {
    $pdf .= "<tr class='stick'><th>" . $lang['ID'] . "</th><th>" . $lang['Name'] . "</th><th>" . $lang['date'] . "</th><th>" . $lang['Activities'] . "</th><th>" . $lang['thours'] . "</th></tr>";
    while ($row = $result1->fetch_assoc()) {
        $id = $row['ID'];
        $name = $row['Voornaam'];
        $date = $row['Datum'];
        $work = $row['Werkzaamheden'];
        $thours = $row['Totaal_Uren'];
        $total += $thours;
        $tpris = ($total * 20);
        $opdid = $row['opdrachtID'];
        $pdf .= "<tr><td>" . $id . "</td><td>" . $name . "</td><td>" . $date . "</td><td>" . $work . "</td><td>" . $thours . "</td></tr>";

    }
} else {
    $pdf .= "0 results";
}
;

$pdf .= "
</table>
<hr>
<h1 class='center'>" . $lang['Assignments'] . "</h1>
<table class=table>
    <tr>
        <th>" . $lang['title'] . "</th>
        <th>" . $lang['description'] . "</th>
        <th>" . $lang['adate'] . "</th>
    </tr>
    <tr>
        <td>" . $title . "</td>
        <td>" . $om . "</td>
        <td>" . $adate . "</td>
    </tr>
</table>
<h1 class='center'>" . $lang['Costs'] . "</h1>
<table class=table>
    <tr>
        <th>" . $lang['thours'] . "</th>
        <th>" . $lang['Costshours'] . "</th>
        <th>" . $lang['tcosts'] . "</th>
    </tr>
    <tr>
        <td>$total" . $lang['hours'] . "</td>
        <td>€20</td>
        <td>€$tpris</td>
    </tr>
</table>
";

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->WriteHTML($pdf);
$mpdf->Output();


?>