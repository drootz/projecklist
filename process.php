<?php
/**
 * File name: process.php
 *
 * This file is part of PROJECKLIST
 *
 * Copyright (c) 2015 Daniel Racine
 * You should have received a copy of the MIT License
 * along with PROJECKLIST. If not, see <https://en.wikipedia.org/wiki/MIT_License>.
 */




    // Include settings.php $default variables
    include 'php/_settings.php';

	//**** functions 
	include 'php/functions.php';

	//**** DEBUG processed data -> development mode
	include '_debug/functions.php';

	//**** L18N support
	include 'php/localize.php';




    date_default_timezone_set($timezone);

	// execution starts here
	if(isset($_POST['submit'])) {
		// call form handler
		$errorMsg = validateForm($_POST);
	}








	

?>

