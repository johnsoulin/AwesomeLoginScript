<?php
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
Login:
</p>
<form action="als_login.php" method="post">
Username <input type="text" name="als_loginUser" /><br />
Password <input type="password" name="als_loginPass" /><br />
<input type="submit" name="als_login" />
</form>