<?php
/**
 * File name: L18N_support.php
 *
 * This file is part of PROJECKLIST
 *
 * Copyright (c) 2015 Daniel Racine
 * You should have received a copy of the MIT License
 * along with PROJECKLIST. If not, see <https://en.wikipedia.org/wiki/MIT_License>.
 */


/**
 * This file is part of the Nette Framework (http://nette.org)
 * Copyright (c) 2004 David Grudl (http://davidgrudl.com)
 */





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










    // Current L18N lanuage support -> The first item of this array = default locale
    $_SESSION['form_PO_support'] = array(

        "English (Canada)"      => "en_CA",
        "Français (Canada)"     => "fr_CA"

    );
    $_SESSION['default_locale'] = reset($_SESSION['form_PO_support']);











    if (!(isset($_SESSION)))
    {   
        session_start();
        header('Cache-control: private'); // IE 6 FIX
        header('Vary: Accept-Language'); // might have IE issues
    }










    if ( isset( $_GET['lang'] ) )
    {
        $lang = $_GET['lang'];
        setLanguage( $lang );
        setcookie('lang', $lang, time() + (3600 * 24 * 30));
    }
    else if ( isset( $_SESSION['lang'] ) )
    {
        $lang = $_SESSION['lang'];
        setLanguage( $lang );
    }
    else if ( isset( $_COOKIE['lang'] ) )
    {
        $lang = $_COOKIE['lang'];
        setLanguage( $lang );
    }
    else
    {
        $locale = getDefaultLanguage();
        setLanguage( $locale );
        setcookie('lang', $_SESSION['lang'], time() + (3600 * 24 * 30));
    }











    // Flush gettext cache fix in development environment -> remove for production
    // $domain = "nothing";
    // bindtextdomain($domain, "nothing");
    // bind_textdomain_codeset($domain, "UTF-8");
    // textdomain($domain);

    // PO gettext() ini
    $domain = "projecklist";
    bindtextdomain($domain, "locales/nocache");
    bindtextdomain($domain, "locales");
    bind_textdomain_codeset($domain, "UTF-8");
    textdomain($domain);

    // Current Language Variable -> To display on site language menu
    $currentLanguage = array_key_exists( array_search($_SESSION['lang'], $_SESSION['form_PO_support']), $_SESSION['form_PO_support'] ) ? array_search($_SESSION['lang'], $_SESSION['form_PO_support']) : _( 'header-menuli-lang' );










?>