<?php

namespace pages;

session_start();

use \repository\Database;
require_once "../repository/Database.php";
$database = new \repository\Database();

$events = $database->getAllEvents();
include_once("../includes/header.php");
?>
