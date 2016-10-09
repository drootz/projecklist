<?php
/**
 * File name: main_functions.php
 *
 * This file is part of PROJECKLIST
 *
 * Copyright (c) 2015 Daniel Racine
 * You should have received a copy of the MIT License
 * along with PROJECKLIST. If not, see <https://en.wikipedia.org/wiki/MIT_License>.
 */

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
			$codeBloc .= "<a href=\"?lang=" . $code . "\">" . $display . "<span class=\"fa fa-globe fa-lg\"></span>"."</a>";
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











function submitEmail($_postArray) {

    $_post = debug_emailSpit($_postArray);

    // Get the email template and store it in a variable
    ob_start();
    include 'mail/email_html.php';
    $email_html = ob_get_clean();

    // Get the plain email template and store it in a variable
    ob_start();
    include 'mail/email_plain.php';
    $email_plain = ob_get_clean();

    // Get the plain email template and store it in a variable
    ob_start();
    echo debug_SubmitTable($_post);
    $email_htmltable = ob_get_clean();

    $attach_dir = "php/mail/attach";
    $attach_name = _( 'process_email_attach_name' );
    $file_plain = $attach_dir . "/" . $attach_name . ".txt";
    $file_htmltable = $attach_dir . "/" . $attach_name . ".html";

    if( chmod($attach_dir, 0755) )
    {
        chmod($attach_dir, 0777);

        // Write the contents back to the file
        file_put_contents($file_plain, $email_plain, LOCK_EX);
        file_put_contents($file_htmltable, $email_htmltable, LOCK_EX);

        if( chmod($attach_dir, 0777) ) {
            chmod($attach_dir, 0755);
        }
    }

    $plain_attachment = chunk_split(base64_encode(file_get_contents($file_plain)));
    $htmltable_attachment = chunk_split(base64_encode(file_get_contents($file_htmltable)));
    
    $email_subject = "New Form Submission from " . $_post['value']['fld_contact_primary_fn'] . " " . $_post['value']['fld_contact_primary_ln'] . " | " . $_post['value']['fld_project_name'];
    
    // boundarie
    $semi_rand = md5(time()); 
    $mime_boundary = "BOUNDARY_mixed_{$semi_rand}"; 
    $alt_mime_boundary = "BOUNDARY_alt_{$semi_rand}"; 

    $email_headers  = "From: " . $default['do_not_reply'] . "\r\n";
    $email_headers .= "Reply-To: " . $_post['value']['eml_contact_primary_email'] . "\r\n";
    // $email_headers .= "Cc: " . $_post['value']['eml_contact_primary_email'] . "\r\n";
    $email_headers .= "Content-Type: multipart/mixed; boundary=\"{$mime_boundary}\"\r\n";
    // $email_headers .= "MIME-Version: 1.0\r\n"; // if I add this header, gmail tag it as spam... no clue how to fix this

    $email_message = "\r\n--{$mime_boundary}\r\n";
    $email_message .= "Content-Type: multipart/alternative; boundary=\"{$alt_mime_boundary}\"\r\n";
    
    $email_message .= "\r\n--{$alt_mime_boundary}\r\n";
    $email_message .= "Content-Type: text/plain; charset=UTF-8; format=\"fixed\"\r\n".
                      // "Content-Transfer-Encoding: 7bit\r\n".
                      "Content-Transfer-Encoding: quoted-printable\r\n".
                      "Content-Disposition: inline\r\n".
                      $email_plain;

    $email_message .= "\r\n--{$alt_mime_boundary}\r\n";
    $email_message .= "Content-Type: text/html; charset=UTF-8\r\n".
                      // "Content-Transfer-Encoding: 7bit\r\n".
                      "Content-Transfer-Encoding: quoted-printable\r\n".
                      "Content-Disposition: inline\r\n".
                      $email_html;
    $email_message .= "\r\n--{$alt_mime_boundary}--\r\n";
    
    $email_message .= "\r\n--{$mime_boundary}\r\n";
    $email_message .= "Content-Type: text/plain; charset=UTF-8; name=\"" . $attach_name . ".txt\"\r\n".
                      "Content-Disposition: attachment; filename=\"" . $attach_name . ".txt\"\r\n".
                      "Content-Transfer-Encoding: base64\r\n".
                      "\r\n".
                      $plain_attachment;

    $email_message .= "\r\n--{$mime_boundary}\r\n";
    $email_message .= "Content-Type: text/html; charset=UTF-8; name=\"" . $attach_name . ".html\"\r\n".
                      "Content-Disposition: attachment; filename=\"" . $attach_name . ".html\"\r\n".
                      "Content-Transfer-Encoding: base64\r\n".
                      "\r\n".
                      $htmltable_attachment;
    
    $email_message .= "\r\n--{$mime_boundary}--\r\n";

    //send the email
    $mail = mail( $default['email'], $email_subject , $email_message, $email_headers );

    // Ouput the result of sending the email in the cron notification email
    echo $mail ? "\n\nMail sent\n\n" : "\n\nMail failed\n\n";

    if( chmod($attach_dir, 0755) )
    {
        chmod($attach_dir, 0777);
        unlink($file_plain);
        unlink($file_htmltable);

        if( chmod($attach_dir, 0777) )
        {
            chmod($attach_dir, 0755);
        }
    }

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
                             
        "Terms & Condition"
        => validateValue( $sanitizedValues['bol_t_and_c_reviewed'], "BOX" ),
                             
        "captcha" 
        => $sanitizedValues['g-recaptcha-response']
           
    ];
    
    
    $process_msg  = "<div class=\"process-error\">";
    $process_msg .= "<p>Please review the following field(s):</p>";
    $process_msg .= "<ul>";
    
    $requiredCheck = 0;
    foreach ($_required as $key => $value) {
        // echo "-- Key: $key; Value: $value<br />\n";
        if (!$value)
        {
            $requiredCheck++;
            switch ($key) {
                case "Project Name":
                    $process_msg .= "<li>The <a href=\"#f-project-name\">".htmlspecialchars($key)."</a> is required.</li>";
                    break;
                case "Primary Contact First Name":
                    $process_msg .= "<li>The <a href=\"#f-contact-firstname-1\">".htmlspecialchars($key)."</a> is required.</li>";
                    break;
                case "Primary Contact Last Name":
                    $process_msg .= "<li>The <a href=\"#f-contact-lastname-1\">".htmlspecialchars($key)."</a> is required.</li>";
                    break;
                case "Primary Contact Phone Number":
                    $process_msg .= "<li>The <a href=\"#f-contact-phone-1\">".htmlspecialchars($key)."</a> is required.</li>";
                    break;
                case "Primary Contact Email":
                    $process_msg .= "<li>The <a href=\"#f-contact-email-verification-1\">".htmlspecialchars($key)."</a> is required.</li>";
                    break;
                case "Primary Contact Email Verification":
                    $process_msg .= "<li>The <a href=\"#f-contact-email-validator-1\">".htmlspecialchars($key)."</a> is required.</li>";
                    break;
                case "Terms & Condition":
                    $process_msg .= "<li>The <a href=\"#f-condition\">".htmlspecialchars($key)."</a> checkbox is required.</li>";
                    break;
                case "captcha":
                    $process_msg .= "<li>The <a href=\"#captcha\">".htmlspecialchars($key)."</a> checkbox is required.</li>";
                    break;
            }
        }
        else if ($value == "invalid_data")
        {
            $requiredCheck++;
            switch ($key) {
                case "Project Name":
                    $process_msg .= "<li>The <a href=\"#f-project-name\">".htmlspecialchars($key)."</a> is not valid.</li>";
                    break;
                case "Primary Contact First Name":
                    $process_msg .= "<li>The <a href=\"#f-contact-firstname-1\">".htmlspecialchars($key)."</a> is not valid.</li>";
                    break;
                case "Primary Contact Last Name":
                    $process_msg .= "<li>The <a href=\"#f-contact-lastname-1\">".htmlspecialchars($key)."</a> is not valid.</li>";
                    break;
                case "Primary Contact Phone Number":
                    $process_msg .= "<li>The <a href=\"#f-contact-phone-1\">".htmlspecialchars($key)."</a> is not valid.</li>";
                    break;
                case "Primary Contact Email":
                    $process_msg .= "<li>The <a href=\"#f-contact-email-verification-1\">".htmlspecialchars($key)."</a> is not valid.</li>";
                    break;
                case "Primary Contact Email Verification":
                    $process_msg .= "<li>The <a href=\"#f-contact-email-validator-1\">".htmlspecialchars($key)."</a> is not valid.</li>";
                    break;
                case "Terms & Condition":
                    $process_msg .= "<li>The <a href=\"#f-condition\">".htmlspecialchars($key)."</a> checkbox is not properly checked.</li>";
                    break;
            }
        }
    }
    
    $process_msg .= "</ul>";
    $process_msg .= "</div>"; // .process-response END



    

    if ($requiredCheck != 0) {

        print_r($process_msg);

        debug_emailSpit($sanitizedValues);

        debug_SubmitTable(debug_emailSpit($sanitizedValues));

        debug_rawTable($sanitizedValues);

        exit;
    }


    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LfS5ggTAAAAAKR6w3mDTrT9i7edXNxnmhBl4Kl9&response=".$_required['captcha']."&remoteip=".$_SERVER['REMOTE_ADDR']);
    if($response==false)
    {
      print_r('<h2>You are spammer ! Get the @$%K out</h2>');
    }
    else
    {
      submitEmail($sanitizedValues);
    }
}


function setTheme() {
    if ( isset( $_SESSION['theme'] ) )
    {
        $theme = $_SESSION['theme'];
        setcookie('theme', $theme, time() + (3600 * 24 * 30));
        return $theme;
    }
    else if ( isset( $_COOKIE['theme'] ) )
    {
        $theme = $_COOKIE['theme'];
        setcookie('theme', $theme, time() + (3600 * 24 * 30));
        return $theme;
    }
    else
    {
        $theme = "th-light";
        setcookie('theme', $theme, time() + (3600 * 24 * 30));
        return $theme;
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


?>









