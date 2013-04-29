<?php
session_start();
require "als_settings.php";

if (!empty($_POST["als_loginUser"]) && !empty($_POST["als_loginPass"])) {
    
    $user = trim(mysqli_real_escape_string($con, $_POST["als_loginUser"])); //Set entered username
    $pass = mysqli_real_escape_string($con, $_POST["als_loginPass"]); //Set entered password
    
    $getresult = "SELECT * FROM $als_table WHERE username='$user'";
    $realResult = mysqli_query($con, $getresult) or die(mysqli_error());
    
    if (mysqli_num_rows($realResult) == $zero) {
        $_SESSION['als_error'] = "loginFailed"; //Username not found
    } else {
        $hash = db_result($realResult, $zero, "hash");
        if ($PHPass->CheckPassword($pass, $hash)) { //Check the password using PHPass
            $_SESSION['als_loggedInAs'] = $user;
        } else {
            $_SESSION['als_error'] = "loginFailed"; //Password does not match
        }
    }
} else {
    $_SESSION['als_error'] = "blank"; //Login or Password field is blank
}

if($als_returnToPrevious){
	if($als_returnToPreviousFix){
		$_SESSION['returnURL'] = str_replace("www.", "", $_SESSION['returnURL']);
	}
	
	header("Location: " . $_SESSION['returnURL']);
	
	//Javascript Redirect Alternative
	//echo "<script language=javascript>window.location = \"" . $_SESSION['returnURL'] . "\"</script>";
}

?>