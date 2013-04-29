<?php
session_start();
require "als_settings.php";

if (!empty($_POST["als_regUser"]) && !empty($_POST["als_regPass"]) && !empty($_POST["als_regEmail"])) {
    $user  = trim(mysqli_real_escape_string($con, $_POST["als_regUser"]));
    $pass  = mysqli_real_escape_string($con, $_POST["als_regPass"]);
    $email = trim(mysqli_real_escape_string($con, $_POST["als_regEmail"]));
    
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        if (strlen($pass) > 72) {
            die();
            $_SESSION['als_error'] = "length";
        } else {
            $tempuser = preg_replace('#\W#', '', str_replace(' ', '', $user));
            if ($als_noSpecialCharacters && ($tempuser == $user)) {
                $user   = $tempuser;
                $result = "SELECT * FROM $als_table WHERE username='$user' OR email='$email'";
                $realResult = mysqli_query($con, $result) or die(mysqli_error($con));
                if (mysqli_num_rows($realResult) == $zero) {
                    $hash = $PHPass->HashPassword($pass);
                    $key  = getToken(20);
                    $sql1 = "INSERT INTO $als_table (username, hash, altkey, email) VALUES ('$user', '$hash', '$key', '$email')";
                    if (!mysqli_query($con, $sql1)) {
                        die('Error: ' . mysqli_error($con));
                    } else {
                        $_SESSION['als_regUser'] = $user;
                    }
                } else {
                    $_SESSION['als_error'] = "nameExists";
                }
            } else {
                $_SESSION['als_error'] = "noSpec";
            }
        }
    } else {
        $_SESSION['als_error'] = "email";
    }
    mysqli_close($con);
    
} else {
    $_SESSION['als_error'] = "blank";
}
if($als_returnToPrevious){
	if($als_returnToPreviousFix){
		$_SESSION['returnURL'] = str_replace("www.", "", $_SESSION['returnURL']);
	}
	
	header("Location: " . $_SESSION['returnURL']);
	//echo "<script language=javascript>window.location = \"" . $_SESSION['returnURL'] . "\"</script>";
}
?>