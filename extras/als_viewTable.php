<?php

require "als_settings.php";

$getAll = "SELECT * FROM $als_table";
$table = mysqli_query($con, $getAll) or die(mysqli_error());

echo "id // username // hash // altkey // cookie // email <br/>";
for($i = 0; $i < mysqli_num_rows($table); $i++){
	echo db_result($table, $i, "id") . " // ";
	echo db_result($table, $i, "username") . " // ";
	echo db_result($table, $i, "hash") . " // ";
	echo db_result($table, $i, "altkey") . " // ";
	echo db_result($table, $i, "cookie") . " // ";
	echo db_result($table, $i, "email") . " // ";
	echo "</br>";
}

?>