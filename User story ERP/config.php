<?php

if(!isset($_SESSION['lang']) && !isset($_GET['lang'])){
    $_SESSION['lang'] = "nl";
}
else if(isset($_GET['lang']) && $_SESSION['lang'] != $_GET['lang'] && !empty($_GET['lang'])) {
    if ($_GET['lang'] == "en") $_SESSION['lang'] = "en";
    elseif ($_GET['lang'] == "nl") $_SESSION['lang'] = "nl";

}

require_once "languages/" . $_SESSION['lang'] . ".php";


$conn = mysqli_connect('localhost','root','','user_db');
if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

?>