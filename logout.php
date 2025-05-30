<?php
session_start();
$_SESSION =[];
$_SESSION['message']="Je bent Uitgelogd!";
header('Location: index.php');

?>