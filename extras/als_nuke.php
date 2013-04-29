<?php

require "als_settings.php";
if(!mysqli_query($con, "TRUNCATE TABLE $als_table")){
	echo "LAUNCH ABORTED!";
}else{
	echo "TARGET DESTROYED.";
}

?>