<?php

session_start();

require_once("./Core/misc/Captcha.class.php");

$captcha = new SimpleCaptcha();
$text = $captcha->createImage();

$_SESSION['captcha_session_key'] = strtolower($text); 