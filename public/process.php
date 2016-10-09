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

	//**** DEBUG
	require(__DIR__ . "/../_debug/functions.php");

	//**** functions 
	require(__DIR__ . "/../includes/functions.php");

	//**** config
	require(__DIR__ . "/../includes/config.php");

	// execution starts here
	if(isset($_POST['submit'])) {
		// call form handler
		$errorMsg = validateForm($_POST);
	}

?>

