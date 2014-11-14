<?php

session_start();

ini_set('display_errors', 1); //comment line out when page is "online".

require 'database/connect.php';
require 'functions/general.php';
require 'functions/users.php';

$errors = array();


?>