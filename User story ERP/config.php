<?php

if(!isset($_SESSION['lang']) && !isset($_GET['lang'])){
    $_SESSION['lang'] = "nl";
}
else if(isset($_GET['lang']) && $_SESSION['lang'] != $_GET['lang'] && !empty($_GET['lang'])) {
    if ($_GET['lang'] == "en") $_SESSION['lang'] = "en";
    elseif ($_GET['lang'] == "nl") $_SESSION['lang'] = "nl";

}

require_once "languages/" . $_SESSION['lang'] . ".php";

if(!isset($_SESSION['table']) && !isset($_GET['table'])){
    $_SESSION['table'] = "staff";
}
else if(isset($_GET['table']) && $_SESSION['table'] != $_GET['table'] && !empty($_GET['table'])) {
    if ($_GET['table'] == "staff") $_SESSION['table'] = "staff";
    elseif ($_GET['table'] == "klant") $_SESSION['table'] = "klant";
        elseif ($_GET['table'] == "opd") $_SESSION['table'] = "opd";
            elseif ($_GET['table'] == "work") $_SESSION['table'] = "work";
                elseif ($_GET['table'] == "user") $_SESSION['table'] = "user";


}

require_once "tables/" . $_SESSION['table'] . ".php";

$conn = mysqli_connect('localhost','root','','user_db');
if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

?>