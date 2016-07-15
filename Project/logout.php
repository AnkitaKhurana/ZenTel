<?php
session_start();
$_SESSION["UID"] = -1;
$_SESSION["Flag"] = 0;
header('Location: index.php');
?>