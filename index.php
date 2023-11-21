<?php

//login
session_start();

if (!isset($_SESSION["login_user"])) {
    header("location: login/login.php");
    exit();
}
