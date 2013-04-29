<?php
session_start();

if (isset($_SESSION['als_regUser'])) {
    $display = "You just registered " . $_SESSION['als_regUser'];
    session_destroy();
	session_start();
} else {
    if (isset($_SESSION['als_error'])) {
        $display   = $_SESSION['als_error'];
        switch ($display) {
            case "blank":
                $display = "A field was left blank";
                break;
            case "nameExists":
                $display = "Username or Email already in use";
                break;
            case "loginFailed":
                $display = "Incorrect Credentials";
                break;
            case "noSpec":
                $display = "Only alphanumeric characters permitted in usernames";
                break;
            case "email":
                $display = "Email not valid";
                break;
			case "length":
				$display = "Username or Password too long";
				break;
            default:
                break;
        }
        unset($_SESSION['als_error']);
    }
}
if (isset($display)) {
    echo $display;
}
?>