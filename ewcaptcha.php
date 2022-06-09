<?php
namespace PHPMaker2019\project4;

// Session
session_start();

// Autoload
include_once "autoload.php";

// Captcha
$captcha = new Captcha("aftershock");
$_SESSION[SESSION_CAPTCHA_CODE] = $captcha->show();
?>