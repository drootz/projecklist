<?php
/**
 * File name: functions.php
 *
 * This file is part of PROJECKLIST
 *
 * @author Daniel Racine <mailto.danielracine@gmail.com>
 * @link --
 * @package PROJECKLIST
 * @version 1
 *
 * Copyright (c) 2016 Daniel Racine
 * You should have received a copy of the MIT License
 * along with PROJECKLIST. If not, see <https://en.wikipedia.org/wiki/MIT_License>.
 */


    /**
     * Apologizes to user with message.
     */
    function apologize($message)
    {
        render("_apology.php", "Ouppps!", ["message" => $message]);
    }

    /**
     * Facilitates debugging by dumping contents of argument(s)
     * to browser.
     */
    function dump()
    {
        $arguments = func_get_args();
        require("../views/_dump.php");
        exit;
    }

    /**
     * Logs out current user, if any.  Based on Example #1 at
     * http://us.php.net/manual/en/function.session-destroy.php.
     */
    function logout()
    {
        // Store DEV server root
        $server_root = $_SESSION["server_root"];

        // unset any session variables
        $_SESSION = [];

        // expire cookie
        if (!empty($_COOKIE[session_name()]))
        {
            setcookie(session_name(), "", time() - 42000);
        }

        // destroy session
        session_destroy();

        // redirect to server root
        redirect($server_root."/");
    }

    /**
     * Redirects user to location, which can be a URL or
     * a relative path on the local host.
     *
     * http://stackoverflow.com/a/25643550/5156190
     *
     * Because this function outputs an HTTP header, it
     * must be called before caller outputs any HTML.
     */
    function redirect($location)
    {
        if (headers_sent($file, $line))
        {
            trigger_error("HTTP headers already sent at {$file}:{$line}", E_USER_ERROR);
        }

        // dev environemnt root
        if (isset($_SESSION["server_root"]))
        {
            $redirect = $_SESSION["server_root"] . $location;
        }
        else
        {
            $redirect = $location;   
        }

        header("Location: {$redirect}", true);
        // echo "<script>window.top.location='". $redirect ."'</script>";
        exit;
    }

    /**
     * Renders view, passing in values.
     */
    function render($view, $pagename, $values = [])
    {
        // if view exists, render it
        if (file_exists("../views/{$view}"))
        {
            $s_displayname = empty($_SESSION["id"]) ? "<a class=\"login_link\" href=\"login.php\">" . _("Sign in") . "</a><span class=\"register_link\"> " . _("or") . " <a href=\"register.php\">" . _("Register") . "</a></span>" : $_SESSION["user_name"];
            
            $_SESSION["view"] = substr($view, 0, -4);
            $title = $pagename;
            
            // extract variables into local scope
            extract($values);

            // render view (between header and footer)
            if ($view == "activation.php" || $view == "registered.php")
            {
                require("../views/header_registration.php");
            }
            else
            {
                require("../views/header.php");
            }
            require("../views/{$view}");
            require("../views/footer.php");
            exit;
        }

        // else err
        else
        {
            trigger_error("Invalid view: {$view}", E_USER_ERROR);
        }
    }




    #########################################################
    # Copyright © 2008 Darrin Yeager                        #
    # https://www.dyeager.org/                               #
    # Licensed under BSD license.                           #
    # https://www.dyeager.org/downloads/license-bsd.txt    #
    #########################################################
    function parseDefaultLanguage($http_accept, $deflang = "en") {
       if(isset($http_accept) && strlen($http_accept) > 1)  {
          # Split possible languages into array
          $x = explode(",",$http_accept);
          foreach ($x as $val) {
             #check for q-value and create associative array. No q-value means 1 by rule
             if(preg_match("/(.*);q=([0-1]{0,1}.\d{0,4})/i",$val,$matches))
                $lang[$matches[1]] = (float)$matches[2];
             else
                $lang[$val] = 1.0;
          }

          #return default language (highest q-value)
          $qval = 0.0;
          foreach ($lang as $key => $value) {
             if ($value > $qval) {
                $qval = (float)$value;
                $deflang = $key;
             }
          }
       }
       return strtolower($deflang);
    }




    function getDefaultLanguage() {
       if (isset($_SERVER["HTTP_ACCEPT_LANGUAGE"]))
          return parseDefaultLanguage($_SERVER["HTTP_ACCEPT_LANGUAGE"]);
       else
          return parseDefaultLanguage(NULL);
    }




    function setLanguage($lang) {

        // Extract language value from browser $locale
        $re_lang = '/^\p{L}{1,2}/u';
        if (preg_match($re_lang, $lang, $match))
        {
            $lang_code = $match[0];
        }
        else
        {
            $lang_code = "en";
        }

        // Extract locale value from browser $locale
        $re_locale = '/(?<=\p{Pd})\p{L}+$/u';
        if (preg_match($re_locale, $lang, $match))
        {
            $locale_code = $match[0];
        }
        else
        {
            $locale_code = "CA";
        }

        // Check if L18N exist for user locale, if not default to $default_locale
        $po_lang = $lang_code."_".$locale_code;
        if ( !in_array( $po_lang, $_SESSION['form_PO_support'] ) )
        {
            $po_lang = $_SESSION['default_locale'];
        }

        // register the session and set the cookie
        $_SESSION['lang'] = $po_lang;
        $_SESSION['htmllang'] = $lang;

        // PO I18N support information here
        putenv("LANG=".$_SESSION['lang']);
        setlocale(LC_ALL, $_SESSION['lang']);

    }




    function setLanguageMenu() {

    	if (isset($_SESSION['form_PO_support']) && count($_SESSION['form_PO_support']) != 0)
    	{
    		$codeBloc = "<ul class=\"is-not-toggled\">";
            
            // // Debug Language Menu
            //     $codeBloc .=        "<li>";
            //     $codeBloc .=            "<a href=\"?lang=" . "en_CA" . "\">"."Checkoslovac ( Comrad Testing )"."<span class=\"fa fa-globe fa-lg\"></span>"."</a>";
            //     $codeBloc .=        "</li>";

    		foreach ($_SESSION['form_PO_support'] as $display => $code) {
    			$codeBloc .= "<li>";
    			// $codeBloc .= "<a href=\"?lang=" . $code . "\">" . $display ."</a>";
                $codeBloc .= "<a href=\"?lang=" . $code . "\">" . $display . "&nbsp;<span class=\"fa fa-globe fa-lg\"></span>"."</a>";
    			$codeBloc .= "</li>";
    		}
    		$codeBloc .= "</ul>";
    		return $codeBloc;
    	}
    	else
    	{
    		return;
    	}
    }



    // Used on the Profile page
    function setLangPreference() {

        if (isset($_SESSION['form_PO_support']) && count($_SESSION['form_PO_support']) != 0)
        {
            $codeBloc  = "<select style=\"width:100%;\" name=\"opt_lang\">";
            $codeBloc .= "<option disabled selected>" . _(" -- select an option -- ") . "</option>";
            
            foreach ($_SESSION['form_PO_support'] as $display => $code) {
                $codeBloc .= "<option value=\"" . $code . "\">";
                $codeBloc .= $display;
                $codeBloc .= "</option>";
            }
            $codeBloc .= "</select>";
            return $codeBloc;
        }
        else
        {
            return;
        }
    }




    function getDeleteKey()
    {
        // query database for user
        $rows = DB::query("SELECT * FROM users WHERE id = ?", $_SESSION["id"]);
        if (count($rows) != 0)
        {
            // Validate key to access delete.php page
            $row = $rows[0];
            $user_name = $row['firstname'] + + $row['lastname'];
            $key = $_SESSION["id"];
            for( $i = 0; $i <= strlen($user_name); $i++ )
            {
                $key = $key + ord(substr($user_name, $i, 1));
            }
            return $key;
        }
    }


    function getActivationKey($id)
    {
        // query database for user
        $rows = DB::query("SELECT * FROM users WHERE id = ?", $id);
        if (count($rows) != 0)
        {
            // Validate key to access delete.php page
            $row = $rows[0];

            //create a random key
            $key = $row['firstname'] . $row['lastname'] . date('mydhis');
            $key = md5($key);

            return $key;
        }
        else
        {
            // ERROR
            userErrorHandler(0, "registerFunction", "Unable to get last inserted ID" . mysql_error());
            return 0;
        }
    }




    function reCheck($pattern, $value)
    {
    	if (preg_match($pattern, $value, $matches)) 
        {
          return $matches[0];
        }
        else 
        {
          return "invalid_data";  
        }
    }




    function checkboxCheck($value)
    {
        if ($value)
        {
          return "true";
        }
        else 
        {
          return "invalid_data";  
        }
    }




    function validateValue($value, $flag)
    {
    	switch ($flag) {
    	    case "EMAIL":
        		$pattern = '/^[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})$/';
    	        break;
    	    case "PHONE":
        		$pattern = '/^((([0-9]{1})*[- .(]*([0-9]{3})[- .)]*[0-9]{3}[- .]*[0-9]{4})+)*$/';
    	        break;
    	    case "ALPHA":
        		$pattern = '/^[[:space:]\p{L}\p{Pd}()]*$/u';
    	        break;
    	    case "ALPHANUMERIC":
        		$pattern = '/^[[:space:]\p{L}\p{Pd}\p{P}()0-9!]*$/u';
    	        break;
    	    case "BOX":
    	    	return checkboxCheck($value);
    	        break;
    	}
    	return reCheck($pattern, $value);
    }




    function sanitizeForm($_postArray)
    {
    	$sanitizedForm = array();
    	foreach ($_postArray as $key => $value)
        {
    		$xxx = strpos($key, 'xxx_');
    		if ($xxx === false) {
        		$sanitizedForm[$key] = isset( $value ) 
    	           					   ? strip_tags( nl2br(trim( $value )), "<br>" ) 
    	           					   : NULL;
    		}
    	}
    	return $sanitizedForm;
    }



    function validateForm($_postArray)
    {
        $sanitizedValues = sanitizeForm($_postArray);
        $_required = [ 
            "Project Name"
                => validateValue( $sanitizedValues['fld_project_name'], "ALPHANUMERIC" ),
            "Primary Contact First Name"
                => validateValue( $sanitizedValues['fld_contact_primary_fn'], "ALPHA" ),
            "Primary Contact Last Name"
                => validateValue( $sanitizedValues['fld_contact_primary_ln'], "ALPHA" ),
            "Primary Contact Phone Number"
                => validateValue( $sanitizedValues['tel_contact_primary_tel'], "PHONE" ),
            "Primary Contact Email" 
                => validateValue( $sanitizedValues['eml_contact_primary_email'], "EMAIL" ),
            "Primary Contact Email Verification"
                => validateValue( $sanitizedValues['eml_contact_primary_email_verification'], "EMAIL" ),
            // "Terms & Condition"
            //     => validateValue( $sanitizedValues['bol_t_and_c_reviewed'], "BOX" ),
            "captcha" 
                => $sanitizedValues['g-recaptcha-response']
        ];
        
        $ajaxMsg  = "<h4>Submission Error</h4><p>Please review the following field(s):</p>";
        $ajaxMsg .= "<ul>";
        
        $requiredCheck = 0;
        foreach ($_required as $key => $value) {
            if (!$value)
            {
                $requiredCheck++;
                switch ($key) {
                    case "Project Name":
                        $ajaxMsg .= "<li>The <a href=\"#f-project-name\">".htmlspecialchars($key)."</a> is required.</li>";
                        break;
                    case "Primary Contact First Name":
                        $ajaxMsg .= "<li>The <a href=\"#f-contact-firstname-1\">".htmlspecialchars($key)."</a> is required.</li>";
                        break;
                    case "Primary Contact Last Name":
                        $ajaxMsg .= "<li>The <a href=\"#f-contact-lastname-1\">".htmlspecialchars($key)."</a> is required.</li>";
                        break;
                    case "Primary Contact Phone Number":
                        $ajaxMsg .= "<li>The <a href=\"#f-contact-phone-1\">".htmlspecialchars($key)."</a> is required.</li>";
                        break;
                    case "Primary Contact Email":
                        $ajaxMsg .= "<li>The <a href=\"#f-contact-email-verification-1\">".htmlspecialchars($key)."</a> is required.</li>";
                        break;
                    case "Primary Contact Email Verification":
                        $ajaxMsg .= "<li>The <a href=\"#f-contact-email-validator-1\">".htmlspecialchars($key)."</a> is required.</li>";
                        break;
                    // case "Terms & Condition":
                    //     $ajaxMsg .= "<li>The <a href=\"#f-condition\">".htmlspecialchars($key)."</a> checkbox is required.</li>";
                    //     break;
                    case "captcha":
                        $ajaxMsg .= "<li>The <a href=\"#captcha\">".htmlspecialchars($key)."</a> checkbox is required.</li>";
                        break;
                }
            }
            else if ($value == "invalid_data")
            {
                $requiredCheck++;
                switch ($key) {
                    case "Project Name":
                        $ajaxMsg .= "<li>The <a href=\"#f-project-name\">".htmlspecialchars($key)."</a> is not valid.</li>";
                        break;
                    case "Primary Contact First Name":
                        $ajaxMsg .= "<li>The <a href=\"#f-contact-firstname-1\">".htmlspecialchars($key)."</a> is not valid.</li>";
                        break;
                    case "Primary Contact Last Name":
                        $ajaxMsg .= "<li>The <a href=\"#f-contact-lastname-1\">".htmlspecialchars($key)."</a> is not valid.</li>";
                        break;
                    case "Primary Contact Phone Number":
                        $ajaxMsg .= "<li>The <a href=\"#f-contact-phone-1\">".htmlspecialchars($key)."</a> is not valid.</li>";
                        break;
                    case "Primary Contact Email":
                        $ajaxMsg .= "<li>The <a href=\"#f-contact-email-verification-1\">".htmlspecialchars($key)."</a> is not valid.</li>";
                        break;
                    case "Primary Contact Email Verification":
                        $ajaxMsg .= "<li>The <a href=\"#f-contact-email-validator-1\">".htmlspecialchars($key)."</a> is not valid.</li>";
                        break;
                    // case "Terms & Condition":
                    //     $ajaxMsg .= "<li>The <a href=\"#f-condition\">".htmlspecialchars($key)."</a> checkbox is not properly checked.</li>";
                    //     break;
                }
            }
        }
        
        $ajaxMsg .= "</ul>";

        if ($requiredCheck != 0) {

            echo($ajaxMsg);
            exit;
        }

        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LfS5ggTAAAAAKR6w3mDTrT9i7edXNxnmhBl4Kl9&response=".$_required['captcha']."&remoteip=".$_SERVER['REMOTE_ADDR']);
        if($response==false)
        {
            echo('<h4>Unable to proceed with your request.</h4>');
            exit;
        }
        else
        {
            // submitEmail($sanitizedValues);
            return $sanitizedValues;
        }
    }


    function setTheme() {

        if (isset($_COOKIE['theme']))
        {
            setcookie('theme', $_COOKIE['theme'], time() + (3600 * 24 * 30));
            return $_COOKIE['theme'];
        }
        else
        {
            $theme = "th-light";
            setcookie('theme', $theme, time() + (3600 * 24 * 30));
            return $theme;
        }
    }


    function pseudostring($length = 8) {

        // Generate arrays with characters and numbers
        $lowerAlpha = range('a', 'z');
        $upperAlpha = range('A', 'Z');
        $numeric = range('0', '9');

        // Merge the arrays
        $workArray = array_merge($numeric, array_merge($lowerAlpha, $upperAlpha));
        $returnString = "";

        // Add random characters from the created array to a string
        for ($i = 0; $i < $length; $i++) {
            $character = $workArray[rand(0, 61)];
            $returnString .= $character;
        }

        return $returnString;
    }


    function getTimeLapse($firstDate, $secondDate) {

        $interval = $firstDate->diff($secondDate);
        $days = $interval->format('%d');
        $hours = $interval->format('%h');
        $minutes = $interval->format('%i');

        $_days = $days > 0 ? $days . gettext(" day, ") : "";
        $_hours = $hours > 0 ? $hours > 1 ? $hours . gettext(" hours, ") : $hours . gettext(" hour, ") : "";
        $_minutes = $minutes > 0 ? $minutes > 1 ? $minutes . gettext(" minutes") : $minutes . gettext(" minute") : "";

        return $_days . $_hours . $_minutes;
    }


    function userErrorHandler($errno, $errfile, $errstring)
    {
        $errid = isset($_SESSION['id']) ? $_SESSION['id'] : 0;
        $insert = DB::query("INSERT INTO user_errors (user_id, err_num, err_file, err_string, err_time) VALUES(?, ?, ?, ?, ?)", 
            $errid, 
            $errno, 
            $errfile, 
            $errstring, 
            date('Y-m-d H:i:s'));  

        if (count($insert) > 0)
        {
            return true;
        }   
        else
        {
            return false;
        }
    }


    // Function use in projectFilter() -> Process and extract the "hours of operation" data in a single string
    function formatHours($hours_set_name, $posts)
    {
        $hours_setID;
        $re_setID = '/(\d+)(?!.*\d)/';
        $return_string;

        if (preg_match($re_setID, $hours_set_name, $matches)) 
        {
            $hours_setID = $matches[0];

            // If hours range value is set
            if ( $posts['hra_hours_'. $hours_setID ] !== "not specified" )
            {
                // If the CLOSED checkbox is checked
                if ( isset( $posts['cbx_hours_closed_'. $hours_setID] ) )
                {
                    $return_string = _('Closed');
                }

                // If the CLOSED checkbox is NOT checked
                else
                {
                    $identifier = ["_sh_", "_sm_", "_eh_", "_em_" ];
                    for ($i = 0, $j = count($identifier); $i < $j ; $i++) {

                        $id[$identifier[$i]] = isset( $posts['hhm_hours'. $identifier[$i] . $hours_setID ] )
                                               ? $posts['hhm_hours'. $identifier[$i] . $hours_setID ]
                                               : '00';
                    }

                    $return_string  = _( 'Open' );
                    $return_string .= " ";
                    $return_string .= _( 'from' );
                    $return_string .= " ";
                    $return_string .= $id["_sh_"].'h';
                    $return_string .= $id["_sm_"];
                    $return_string .= " ";
                    $return_string .= _( 'to' );
                    $return_string .= " ";
                    $return_string .= $id["_eh_"].'h';
                    $return_string .= $id["_em_"];
                }
            }

            // If hours range value is NOT set
            else
            {
                $return_string = "not specified";
            }

            return $return_string;
        }
        else 
        {
          return "not specified";  
        }
    }

    // Split Label / Values in key/value pair array
    function projectFilter($_postArray)
    {
        $_posts = $_postArray;
        $_postsLabel = [];
        $_postsValue = [];

        // Replace NULL values with "not specified"
        foreach ($_posts as $key => $value)
        {
            if (!$value)
            {
                $_posts[$key] = "not specified";
            }
        }

        // Process submission post for output in email layout
        foreach ($_posts as $key => $value)
        {
            // Exclude procedural key/pairs values not required in email/file output
            $isOutputField = $key != "eml_contact_primary_email_verification" &&
                             $key != "eml_contact_alt_email_verification" &&
                             $key != "eml_billing_email_verification" &&
                             $key != "g-recaptcha-response" &&
                             $key != "f_pid_exist" &&
                             $key != "submit" &&
                             $key != "pid" &&
                             $key != "id" &&
                             $key != "user_id" &&
                             $key != "lastmodified_datetime" &&
                             // $value != "not specified" &&
                             $value != NULL; 

            if ($isOutputField)
            {
                // "Hours of operation" data require separate handling bcause of the multiple input fields for hours and minutes selection.
                if ( preg_match('/\bhra_.\w*\b/', $key, $match) === 1 )
                {
                    $rangeName = $match[0];

                    // RANGE
                    $_postsLabel[$rangeName] = $rangeName;
                    $_postsValue[$rangeName] = $value;

                    // HOURS
                    $id = $rangeName."_hours";
                    $_postsLabel[$id] = $id;
                    $_postsValue[$id] = formatHours($key, $_posts);
                }

                // Handling the remaining post items in two arays to facilitate L18N integration.
                else if ( preg_match('/hhm_hours_(sh|sm|eh|em)_\d/', $key, $match) === 0 && preg_match('/cbx_hours_closed_\d/', $key, $match) === 0 ) 
                {
                    $_postsLabel[$key] = $key;
                    $_postsValue[$key] = $value;
                }
            }
        }

        $returned_array = array(
            "label" => $_postsLabel,
            "value" => $_postsValue
        );

        return $returned_array;
    }


    function sendtotxt($array) {

        $_postsLabel = [];
        $_postsValue = [];
        foreach ($array as $key => $value) {
            $_postsLabel[$key] = $key;
            $_postsValue[$key] = $value;
        }

        $output = array(
            "label" => $_postsLabel,
            "value" => $_postsValue
        );

        $uid = date('ymdhiss');

        $attach_dir = __DIR__.'/send/';
        $fp = fopen($attach_dir . 'send_' . $uid. '.txt', 'w');

        $write = "Email Attachment" . "\n\n";
        foreach ($_postsValue as $key => $value) {
            $write .= $key . "\n";
            $write .= $value . "\n";
            $write .= "\n";
        }

        fwrite($fp, $write);
        fclose($fp);

    }


    function createAttachment($data, $ext, $id = 0) {

            $ref = date('ymi');
            if ($id != 0)
            {
                // Generate Project Reference
                $rows = DB::query("SELECT projeckt_ref FROM projecklist WHERE id = ?", $id);
                if (count($rows) != 0)
                {
                    $ref = $rows[0]['projeckt_ref'];
                }
            }

            $attach_dir = __DIR__.'/send/';

            if ($ext === 'txt')
            {
                $fp = fopen($attach_dir . "Projecklist_text_ref_" . $ref . "." . "txt", "w");
                fwrite($fp, $data);
                fclose($fp);
                return $ref;
            }
            else if ($ext === 'md')
            {
                $fp = fopen($attach_dir . "Projecklist_markdown_ref_" . $ref . "." . "md", "w");
                fwrite($fp, $data);
                fclose($fp);
                return $ref;
            }
            else
            {
                return false;
            }

    }
