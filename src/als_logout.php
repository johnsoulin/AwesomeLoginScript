<?php
require "als_settings.php";
session_start();
session_destroy();
header("Location: " . $als_logoutRedirectURL); //Can be set in als_settings.php
?>