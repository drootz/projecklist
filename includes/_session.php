<?php
/**
 * File name: session.php
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

    if (!(isset($_SESSION)))
    {   
        session_start();
        header('Cache-control: private'); // IE 6 FIX
        header('Vary: Accept-Language'); // might have IE issues

	    // Current L18N lanuage support -> The first item of this array = default locale
	    $_SESSION['form_PO_support'] = array(
	        "English (Canada)"      => "en_CA",
	        "Français (Canada)"     => "fr_CA"
	    );
	    $_SESSION['default_locale'] = reset($_SESSION['form_PO_support']);

        // DEV environemnt root:
        // var_dump($_SESSION["server_root"]);
        $_SESSION["server_root"] = "/~dracine/xdev/projecklist/public";
        

    }


    if ( isset( $_GET['lang'] ) )
    {
        $lang = $_GET['lang'];
        setLanguage( $lang );
        setcookie('lang', $lang, time() + (3600 * 24 * 30));
    }
    if ( isset( $_SESSION['lang'] ) )
    {
        $lang = $_SESSION['lang'];
        setLanguage( $lang );
        setcookie('lang', $lang, time() + (3600 * 24 * 30));
    }
    else if ( isset( $_COOKIE['lang'] ) )
    {
        $lang = $_COOKIE['lang'];
        setLanguage( $lang );
        setcookie('lang', $lang, time() + (3600 * 24 * 30));
    }
    else
    {
        $locale = getDefaultLanguage();
        setLanguage( $locale );
        setcookie('lang', $_SESSION['lang'], time() + (3600 * 24 * 30));
    }

    // Current Language Variable -> To display on site language menu
    $_SESSION['currentLanguage'] = array_key_exists( array_search($_SESSION['lang'], $_SESSION['form_PO_support']), $_SESSION['form_PO_support'] ) ? array_search($_SESSION['lang'], $_SESSION['form_PO_support']) : _( 'header-menuli-lang' );

    // Flush gettext cache fix in development environment -> remove for production
    // $domain = "nothing";
    // bindtextdomain($domain, "nothing");
    // bind_textdomain_codeset($domain, "UTF-8");
    // textdomain($domain);

    // PO gettext() ini
    $domain = "projecklist";
    bindtextdomain($domain, "../locales/nocache");
    bindtextdomain($domain, "../locales");
    bind_textdomain_codeset($domain, "UTF-8");
    textdomain($domain);

    // Define html lang attribute
    $_SESSION['html_lang'] = "lang=\"".$_SESSION['htmllang']."\"";

    // Set Theme Dark/Light
    $_SESSION['html_theme'] = "class=\"".setTheme()."\"";

    // require authentication for all pages except /login.php, /logout.php, activation.php and /register.php
    if (!in_array($_SERVER["PHP_SELF"], [$_SESSION["server_root"]."/login.php", $_SESSION["server_root"]."/logout.php", $_SESSION["server_root"]."/register.php", $_SESSION["server_root"]."/index.php", $_SESSION["server_root"]."/forgot.php", $_SESSION["server_root"]."/projeckt.php", $_SESSION["server_root"]."/activation.php", $_SESSION["server_root"]."/registered.php", $_SESSION["server_root"]."/ajaxcheckemail.php"]))
    {
        if (empty($_SESSION["id"]))
        {
            redirect("/");
        }
    }



    // http://thisinterestsme.com/expire-php-sessions/
    //Expire the session if user is inactive for 180
    //minutes or more.
    $expireAfter = 180;
     
    //Check to see if our "last action" session
    //variable has been set.
    if(isset($_SESSION['last_action'])){
        
        //Figure out how many seconds have passed
        //since the user was last active.
        $secondsInactive = time() - $_SESSION['last_action'];
        
        //Convert our minutes into seconds.
        $expireAfterSeconds = $expireAfter * 60;
        
        //Check to see if they have been inactive for too long.
        if($secondsInactive >= $expireAfterSeconds){
            //User has been inactive for too long.
            //Kill their session.
            session_unset();
            session_destroy();
            redirect("/~dracine/xdev/projecklist/public/login.php");
        }

        //Assign the current timestamp as the user's
        //latest activity
        $_SESSION['last_action'] = time();
    }
     

    
    // Set your default timezone here
    // http://php.net/manual/en/timezones.php
    $timezone = 'America/Montreal';
    date_default_timezone_set($timezone);