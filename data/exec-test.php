<?php
	
	shell_exec("./getFile.sh");

	$fraudDetect = shell_exec("./fraudDetect transactions.csv");
	echo $fraudDetect;


?>