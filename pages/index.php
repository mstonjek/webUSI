<?php


namespace pages;


session_start();

use \repository\Database;

require_once "../repository/Database.php";




$events = new \repository\Database();


// Output after database operations


