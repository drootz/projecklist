<?php
/**
 * File name: config.php
 *
 * This file is part of PROJECKLIST
 *
 * Copyright (c) 2015 Daniel Racine
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
    $currentLanguage = array_key_exists( array_search($_SESSION['lang'], $_SESSION['form_PO_support']), $_SESSION['form_PO_support'] ) ? array_search($_SESSION['lang'], $_SESSION['form_PO_support']) : _( 'header-menuli-lang' );

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
    $html_lang = "lang=\"".$_SESSION['htmllang']."\"";

    // Set Theme Dark/Light
    $html_theme = "class=\"".setTheme()."\"";

?>