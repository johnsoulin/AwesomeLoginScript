<?php
session_start();
require "als_settings.php";

if (!empty($_POST["als_regUser"]) && !empty($_POST["als_regPass"]) && !empty($_POST["als_confirmPass"]) && !empty($_POST["als_regEmail"])) {
    $user  = trim(mysqli_real_escape_string($con, $_POST["als_regUser"]));
    $pass  = mysqli_real_escape_string($con, $_POST["als_regPass"]);
	$confirm = mysqli_real_escape_string($con, $_POST["als_confirmPass"]);
    $email = trim(mysqli_real_escape_string($con, $_POST["als_regEmail"]));
    
    if (filter_var($email, FILTER_VALIDATE_EMAIL) && $pass === $confirm) {
        if (strlen($pass) > 72) {
            die();
            $_SESSION['als_error'] = "length"; //Password too long (PHPass restrictions)
        } else {
            $tempuser = preg_replace('#\W#', '', str_replace(' ', '', $user)); //Strip non-alphanumeric characters
            if ($als_noSpecialCharacters && ($tempuser === $user)) { //Check username before and after
                $user   = $tempuser;
                $result = "SELECT * FROM $als_table WHERE username='$user' OR email='$email'"; //Search for matching username and/or email address
                $realResult = mysqli_query($con, $result) or die(mysqli_error($con));
                if (mysqli_num_rows($realResult) == $zero) {
                    $hash = $PHPass->HashPassword($pass); //Hash the password via PHPass
                    $key  = getToken(20); //Generate an alphanumeric string 20 characters long
                    $sql1 = "INSERT INTO $als_table (username, hash, altkey, email) VALUES ('$user', '$hash', '$key', '$email')";
                    if (!mysqli_query($con, $sql1)) {
                        die('Error: ' . mysqli_error($con));
                    } else {
                        $_SESSION['als_regUser'] = $user; //User successfully registered
                    }
                } else {
                    $_SESSION['als_error'] = "nameExists"; //Row with matching username or email exists
                }
            } else {
                $_SESSION['als_error'] = "noSpec"; //Username cannot special characters (can be disabled in als_settings.php)
            }
        }
    } else {
        $_SESSION['als_error'] = "emailPassWrong"; //Email address not valid AND/OR passwords do not match
    }
    mysqli_close($con);
    
} else {
    $_SESSION['als_error'] = "blank"; //Field left blank
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