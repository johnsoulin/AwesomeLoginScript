<?php
//Saves the URL of the location of the form - can be removed if redirection is disabled.
$pageURL = 'http';
if ($_SERVER["HTTPS"] == "on") {
    $pageURL .= "s";
}
$pageURL .= "://";
if ($_SERVER["SERVER_PORT"] != "80") {
    $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
} else {
    $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
}
$_SESSION['returnURL'] = $pageURL;
?>
<p>
Register an account:
</p>
<form style="position:relative;" action="als_register.php" method="post">
<input type="text" name="als_regUser" placeholder="Username" />
<input type="text" name="als_regEmail" placeholder="Email Address" />
<input type="password" name="als_regPass" placeholder="Password" />
<input type="submit" name="als_register" />
</form>
</div>