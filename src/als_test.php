<?php

require "als_settings.php";

$getAll = "SELECT * FROM $als_table";
if(!mysqli_query($con, $getAll)){
	echo "Something went wrong.";
	mysqli_error($con);
}else{
	echo "Setup complete!";
}

?>