<?php

	$tobecopied = 'https://www.ohmydar.win/creditwatch/data/transactions.csv';
	$target = $_SERVER['DOCUMENT_ROOT'] . '/fraudDetect/transactions.csv';

	copy($tobecopied, $target);
	
	$fraudDetect = shell_exec("./fraudDetect transactions.csv");
	echo $fraudDetect;

	unlink($target);

?>
