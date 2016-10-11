<?php
/**
 * File name: _debug/function.php
 *
 * This file is part of PROJECKLIST
 *
 * Copyright (c) 2015 Daniel Racine
 * You should have received a copy of the MIT License
 * along with PROJECKLIST. If not, see <https://en.wikipedia.org/wiki/MIT_License>.
 */

	function debug_rawTable($_postArray)
	{
		$posts = $_postArray;

		// Replace NULL values with 'n/a'
		foreach ($posts as $key => $value)
		{
			if (!$value)
			{
				$posts[$key] = "n/a";
			}
		}

		echo "<h3>RAW TABLE</h3>";
    	echo "<table class=\"debug-posts\">";
    	echo 	"<tr>";
    	echo 		"<th>KEY</th>";
    	echo 		"<th>VALUE</th>";
    	echo 	"</tr>";
    	foreach ($posts as $key => $value) {
    		if ( $value !== "n/a" )
    		{
	        	echo "<tr><td>".$key."</td><td>".$value."</td></tr>";
    		}
    		else
    		{
	        	echo "<tr class=\"data-na\"><td>".$key."</td><td>".$value."</td></tr>";
    		}
    	}
    	echo "</table>";
	}


	function debug_SubmitTable($arr) {

		// _DEBUG output of data
		echo "<h3>VALUE PAIRS</h3>";
		echo "<dl class=\"dl-posts\">";
		foreach ($arr['value'] as $key => $value) {
			if ( $value !== "n/a" )
			{
				echo "<dt>".$arr['label'][$key]."</dt><dd>".$value."</dd>";
			}
			else
			{
				echo "<dt class=\"data-na\">".$arr['label'][$key]."</dt><dd class=\"data-na\">".$value."</dd>";
			}
		}
		echo "</dl>";

	}

 ?>