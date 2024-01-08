<?php
require_once 'dbconfig.php';
session_start(); // 세션 시작
// var_dump($_SESSION);

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] != true ){
    header("Location: /AgroupLogin.php");
    exit();
}

?>