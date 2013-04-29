<?php
session_start();

//DO NOT REMOVE
require "als_settings.php";

if (!empty($_POST["als_loginUser"]) && !empty($_POST["als_loginPass"])) {
    
    $user = trim(mysqli_real_escape_string($con, $_POST["als_loginUser"]));
    $pass = mysqli_real_escape_string($con, $_POST["als_loginPass"]);
    
    $getresult = "SELECT * FROM $als_table WHERE username='$user'";
    $realResult = mysqli_query($con, $getresult) or die(mysqli_error());
    
    if (mysqli_num_rows($realResult) == $zero) {
        $_SESSION['als_error'] = "loginFailed";
    } else {
        $hash = db_result($realResult, $zero, "hash");
        if ($PHPass->CheckPassword($pass, $hash)) {
            $_SESSION['als_loggedInAs'] = $user;
        } else {
            $_SESSION['als_error'] = "loginFailed";
        }
    }
} else {
    $_SESSION['als_error'] = "blank";
}

if($als_returnToPrevious){
	if($als_returnToPreviousFix){
		$_SESSION['returnURL'] = str_replace("www.", "", $_SESSION['returnURL']);
	}
	
	echo "<script language=javascript>window.location = \"" . $_SESSION['returnURL'] . "\"</script>";
}

?>