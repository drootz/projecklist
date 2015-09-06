<?php
/**
 * File name: _debug-function.php
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



















	// Function use in emailSpit(); -> Process and extract the "hours of operation" data in a single string
	function formatHours($hours_set_name, $posts, $option)
	{
		$hours_setID;
		$re_setID = '/\B[1-7]{1}\B/';
		$isLabel = $option == "LAB";
		$return_string;

		if (preg_match($re_setID, $hours_set_name, $matches)) 
	    {
			$hours_setID = $matches[0];

			// If hours range value is set
			if ( $posts['opt_hours_regular_set_'. $hours_setID .'_range'] !== "n/a" )
			{
				// If the CLOSED checkbox is checked
				if ( isset( $posts['cbx_hours_regular_set_'. $hours_setID .'_closed'] ) )
				{
				  	// If this iteration is to set the LABEL value
					if ($isLabel)
					{	
						$return_string = $posts['opt_hours_regular_set_'. $hours_setID .'_range'];
					}
					// If this iteration is to set the VALUE data
					else
					{
				  		$return_string = sprintf(  _( 'fld_hours_closed' ) );
					}
				}

				// If the CLOSED checkbox is NOT checked
				else
				{
					$identifier = [ "_range", "_start_h", "_start_m", "_end_h", "_end_m" ];
					for ($i = 0, $j = count($identifier); $i < $j ; $i++) {

						$id[$identifier[$i]] = isset( $posts['opt_hours_regular_set_'. $hours_setID . $identifier[$i] ] )
											   ? $posts['opt_hours_regular_set_'. $hours_setID . $identifier[$i] ]
											   : "_debug: No Range Selected";
					}

				  	// If this iteration is to set the LABEL value
					if ($isLabel) 
					{
						$return_string  = $id["_range"];
					}
					// If this iteration is to set the VALUE data
					else
					{
						$return_string  = sprintf( _( 'fld_hours_opened' ) );
						$return_string .= " ";
						$return_string .= sprintf( _( 'fld_hours_from' ) );
						$return_string .= " ";
						$return_string .= $id["_start_h"];
						$return_string .= $id["_start_m"];
						$return_string .= " ";
						$return_string .= sprintf( _( 'fld_hours_to' ) );
						$return_string .= " ";
						$return_string .= $id["_end_h"];
						$return_string .= $id["_end_m"];
					}

				}

			}

			// If hours range value is NOT set
			else
			{
				// no range slected
				$return_string = sprintf( _( '_debug-hours-norange' ) );
			}

			return $return_string;
	    }
	    else 
	    {
	      return sprintf( _( '_debug-hours-invalidrange' ) );  
	    }
	}











	function debug_emailSpit($_postArray)
	{
		$_posts = $_postArray;
		$_postsLabel = [];
		$_postsValue = [];

		// Replace NULL values with "n/a"
		foreach ($_posts as $key => $value)
		{
			if (!$value)
			{
				$_posts[$key] = "n/a";
			}
		}

		// Process submission post for output in email layout
		foreach ($_posts as $key => $value)
		{
			// Exclude procedural key/pairs values not required in email/file output
			$isOutputField = $key != "eml_contact_primary_email_verification" &&
							 $key != "eml_contact_alt_email_verification" &&
							 $key != "eml_billing_email_verification" &&
							 $key != "bol_t_and_c_reviewed" &&
							 $key != "g-recaptcha-response" &&
							 $key != "submit" &&
							 $value != "n/a" &&
							 $value != NULL;

			if ($isOutputField)
			{
				// "Hours of operation" data require separate handling bcause of the multiple input fields for hours and minutes selection.
		        if ( preg_match('/^opt_hours_regular_set_\d_range$/', $key, $match) )
		        {
			        $rangeName = substr($match[0], 0, 23);

		    		// RANGE
		    		$_postsLabel[$match[0]] = _($match[0]);
			    	$_postsValue[$match[0]] = formatHours($key, $_posts, "LAB");

			    	// HOURS
			    	$id = $rangeName."_hours";
		    		$_postsLabel[$id] = _($id);
			    	$_postsValue[$id] = formatHours($key, $_posts, "VAL");
		        }

		        // Handling the remaining post items in two arays to facilitate L18N integration.
		        else if ( !preg_match('/^opt_hours_regular_set_\d_(start|end)_(h|m)$/', $key, $match) && !preg_match('/^cbx_hours_regular_set_\d_closed$/', $key, $match) ) 
		        {
			    	$_postsLabel[$key] = _($key);
				    $_postsValue[$key] = $value;
		        }
			}

		}

    	$returned_array = array(

    		"label" => $_postsLabel,
    		"value"	=> $_postsValue

    	);

    	return $returned_array;

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