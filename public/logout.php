<?php
include 'scripts/init.php';
deactivateAccount($_SESSION['username']);
session_destroy();
header('Location: index.php');
?>