<?php
require "als_settings.php";
session_start();
session_destroy();
header("Location: " . $als_logoutRedirectURL);
?>