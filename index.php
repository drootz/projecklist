<?php
/**
 * File name: index.php
 *
 * This file is part of PROJECKLIST
 *
 * Copyright (c) 2015 Daniel Racine
 * You should have received a copy of the MIT License
 * along with PROJECKLIST. If not, see <https://en.wikipedia.org/wiki/MIT_License>.
 */
?>





<?php

    // Set your default timezone here
    // http://php.net/manual/en/timezones.php
    $timezone = 'America/Montreal';
    date_default_timezone_set($timezone);

    //**** L18N support
    include 'php/localize.php';

    //**** L18N support
    include 'php/functions.php';

    // Define html lang attribute
    $html_lang = "lang=\"".$_SESSION['htmllang']."\"";

    // Set Theme Dark/Light
    $html_theme = "class=\"".setTheme()."\"";



?>





<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php echo $html_lang; ?>> <!--<![endif]-->

<head>

    <!-- Basic Page Needs
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo _( 'form-htmltag-ttl' ); ?></title>
    <meta name="description" <?php echo "content=\""._( 'form-htmlmeta-description' )."\""; ?> >
    <link rel="author" href="humans.txt" />

    <!-- Mobile Specific Metas
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <meta name="viewport" content="width=device-width, initial-scale=1, minimal-ui">

    

    <!-- Schema.org markup for Facebook -->
    <meta property="og:title" <?php echo "content=\"" . _( 'head-og-fb-title' ) . "\""; ?>/>
    <meta property="og:image" <?php echo "content=\"" . _( 'head-og-fb-image' ) . "\""; ?>/>
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image:width" content="2000">
    <meta property="og:image:height" content="1050">
    <meta property="og:url" content="http://www.projecklist.oneprojct.space"/>
    <meta property="og:site_name" content="Projecklist"/>
    <meta property="og:locale:alternate" <?php echo "content=\"" . _( 'head-og-fb-locale' ) . "\""; ?>/>
    <meta property="og:description" <?php echo "content=\"" . _( 'head-og-fb-description' ) . "\""; ?>/>

    <!-- Schema.org markup for Twitter -->
   <!--  <meta name="twitter:card" content="photo"/>
    <meta name="twitter:site" content="@creationsCyn">
    <meta name="twitter:creator" content="@creationsCyn">
    <meta name="twitter:title" content="CréationsC - Design intérieur | Home staging | Décoration"/>
    <meta name="twitter:description" content="site web"/>
    <meta name="twitter:domain" content="creationsc.com"/>
    <meta name="twitter:image" content="http://creationsc.com/assets/logo-tw.jpg"/>
    <meta name="twitter:image:width" content="560">
    <meta name="twitter:image:height" content="560"> -->


    <!-- Place favicon.ico and apple-touch-icon.png in the root directory
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->

    <link rel="apple-touch-icon" href="touch-icon-iphone.png">
    <link rel="apple-touch-icon" sizes="76x76" href="touch-icon-ipad.png">
    <link rel="apple-touch-icon" sizes="120x120" href="touch-icon-iphone-retina.png">
    <link rel="apple-touch-icon" sizes="152x152" href="touch-icon-ipad-retina.png">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />

    <!-- FONT
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <!-- <link href='http://fonts.googleapis.com/css?family=Raleway:400,200,600' rel='stylesheet' type='text/css'> -->
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,200,600,900' rel='stylesheet' type='text/css'>

    <!-- CSS
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/page.css">
    <!--[if lt IE 9]>
    <link rel="stylesheet" href="css/style-ie.css"/>
    <![endif]-->    

    <!-- DEBUG css file -> to be deleted from production -->
    <link rel="stylesheet" href="css/ipad_dev.css">



    <script src="js/vendor/modernizr-2.6.2.min.js"></script>

</head>
<body <?php echo $html_theme; ?>>
    <!--[if lt IE 9]>
        <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->










    <!-- Media queries helper module -->
    <!-- 
    <ul class="breakpoints clearfix">
        <li class="landscape">landscape</li>
        <li class="portrait">portrait</li>
        <li class="mobileonly">mobileonly</li>
        <li class="mobileonly-portrait">mobileonly-portrait</li>
        <li class="mobileonly-landscape">mobileonly-landscape</li>
        <li class="phablet">phablet</li>
        <li class="phablet-portrait">phablet-portrait</li>
        <li class="phablet-landscape">phablet-landscape</li>
        <li class="tablet">tablet</li>
        <li class="tablet-portrait">tablet-portrait</li>
        <li class="tablet-landscape">tablet-landscape</li>
        <li class="laptop">laptop</li>
        <li class="desktop">desktop</li>
        <li class="js-viewport-size"><span id="js-vw"></span> x <span id="js-vh"></span></li>
    </ul> -->
   



    <!--
    <div class="debug-header l-wrapper">
        <ul>


            <?php      

                //**** _debug output -> $_GET, %_SESSION, $_COOKIE, gettext plurals, phpinfo.php, languages
                // include 'debug/session.php';

            ?>

        </ul>
    </div>
    -->










    <div id="overlay">
        <div id="overlay-safety" onclick="overlay()" value="0"></div>
        <div id="overlay-container" class="overlay-container spring-out">
            <p class="js-dialog-contact is-hidden"><?php echo _( 'form-dialogbox-pra-contact' ); ?></p>
            <p class="js-dialog-hours is-hidden"><?php echo _( 'form-dialogbox-pra-hours' ); ?></p>
            <p class="js-dialog-competitors is-hidden"><?php echo _( 'form-dialogbox-pra-competitors' ); ?></p>
            <p class="js-dialog-weblist is-hidden"><?php echo _( 'form-dialogbox-pra-weblist' ); ?></p>
            <p class="js-dialog-domain is-hidden"><?php echo _( 'form-dialogbox-pra-domain' ); ?></p>
            <p class="js-dialog-primary is-hidden"><?php echo _( 'form-dialogbox-pra-primary' ); ?></p>
            <p class="js-dialog-noprimary is-hidden"><?php echo _( 'form-dialogbox-pra-noprimary' ); ?></p>
            <button class="button overlay m-accept is-visible" onclick="overlay(this)" value="1"><?php echo _( 'form-dialogbox-btn-accept' ); ?></button>
            <button class="button overlay m-decline is-visible" onclick="overlay(this)" value="0"><?php echo _( 'form-dialogbox-btn-decline' ); ?></button>
            <button class="button overlay m-alert is-hidden" onclick="overlay(this)" value="1"><?php echo _( 'form-dialogbox-btn-ok' ); ?></button>
        </div>
    </div>




    <div id="f-container" class="l-form-container is-clear">
        

        <div class="m-float-btn">
            <div class="l-wrapper is-relative">
                <div class="m-float-radial">
                    <!-- fa icon loaded on pageload JS loadTheme(); -->
                    <div class="menu-theme" title="toggle day mode"><span class="fa fa-lg"></span></div>
                </div>
            </div>
        </div>
        

        <div class="m-hero">

        <div class="m-theme-indicator"></div>

        <nav class="m-navbar">
            <div class="l-wrapper-nav clearfix is-relative">
                <div class="m-brand-container clearfix">
                    <div class="m-logo"><img src="img/logos/placeholder.svg" alt="logo"></div>
                    <div class="m-coname"><span>Projecklist</span></div>
                </div>
                <ul class="m-menu">
                    <!-- <li id="f-debug-fill-form" title="debug -> fill form button"><span class="fa fa-bug fa-lg"></span></li> -->
                    <li class="m-menu-li-drop is-not-toggled" <?php echo "title=\"" . _( 'form-navbar-titleAttr-langSwitch' ) . "\""; ?> >
                        <!-- $_SESSION['lang'] -->
                        <?php echo "<span class=\"fa fa-globe fa-lg\"></span><span class=\"m-currentlanguage\">" . htmlspecialchars($currentLanguage) . "</span>"; ?>
                        <?php echo setLanguageMenu(); ?>
                    </li>
                    <!-- fa icon loaded on pageload JS loadTheme(); -->
                    <li class="menu-theme" title="toggle day mode"><span class="fa fa-lg"></span></li>
                </ul>
            </div>
        </nav>
            <div class="l-wrapper">

                <div class="row">
                    
                    <div class="col-06 m-hero-block">

                        <div>
                            <h1><?php echo _( 'hero-ttl-h1' ); ?></h1>

                            
                            <div class="m-badge-container">

                                <div class="l-blocktext-wrapper">
                                    <p><?php echo _( 'hero-pra-description' ); ?></p>
                                </div>

                                <div class="m-hero-aside">
                                    <div class="l-blocktext-wrapper m-hero-badge js-badge">
                                        <div class="m-text-wrap">
                                            <div class="m-badge-description"><?php echo _( 'hero-pra-action-description' ); ?></div>
                                            <a href="#" target="_BLANK"><div class="button m-badge-example"><?php echo _( 'hero-pra-action-button' ); ?></div></a>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col-06"></div>

                </div>

            </div>
        </div>


        <section id="section-action" class="section-action">

            
            <div class="l-wrapper l-action-wrapper">

                <div class="action-banner animate"></div>

                <div class="row">
                    
                    <div class="col-04 m-action-block">

                        <button class="js-ico-debug">toggle debug</button>
                        <div class="m-ico-container m-ico-square js-action-first">
                            <div class="m-ico-wrapper">
                                <div class="m-ico-module">
                                    <div class="m-ico-label"><span>1</span></div>
                                    <div class="m-ico-label"></div>
                                    <div class="m-ico-label"><span class="fa fa-check"></span></div>
                                    <div class="m-ico-label"></div>
                                </div>
                            </div>
                        </div>

                        <h4 class="js-ico-debug"><span><?php echo _( 'action-first-ttl' ); ?></span></h4>
                        <p><?php echo _( 'action-first-txt' ); ?></p>
                    </div>
                    <div class="col-04 m-action-block">

                        <button class="js-ico-debug">toggle debug</button>
                        <div class="m-ico-container m-ico-square js-action-second">
                            <div class="m-ico-wrapper">
                                <div class="m-ico-module">
                                    <div class="m-ico-label"><span>2</span></div>
                                    <div class="m-ico-label"></div>
                                    <div class="m-ico-label"><span class="fa fa-filter"></span></div>
                                    <div class="m-ico-label"></div>
                                </div>
                            </div>
                        </div>

                        <h4 class="js-ico-debug"><span><?php echo _( 'action-second-ttl' ); ?></span></h4>
                        <p><?php echo _( 'action-second-txt' ); ?></p>
                        
                    </div>
                    <div class="col-04 m-action-block">
                    
                        <button class="js-ico-debug">toggle debug</button>
                        <div class="m-ico-container m-ico-square js-action-third">
                            <div class="m-ico-wrapper">
                                <div class="m-ico-module">
                                    <div class="m-ico-label"><span>3</span></div>
                                    <div class="m-ico-label"></div>
                                    <div class="m-ico-label"><span class="fa fa-share"></span></div>
                                    <div class="m-ico-label"></div>
                                </div>
                            </div>
                        </div>

                        <h4 class="js-ico-debug"><span><?php echo _( 'action-third-ttl' ); ?></span></h4>
                        <p><?php echo _( 'action-third-txt' ); ?></p>
                        
                    </div>

                </div>
                
            </div>

        </section>


        <!-- <div class="th-dark-grid-vertical"></div> -->

        <section id="section-intro" class="section-intro">
                
            <div class="l-wrapper">

                <div class="row">

                    <div class="col-02 l-desktop">&nbsp;</div>

                    <div class="col-08 m-intro-art">
                                
                        <h2><?php echo _( 'form-intro-ttl' ); ?></h2>

                        <p><?php echo _( 'form-intro-pra-validate' ); ?></p>

                        <p><?php echo _( 'form-intro-pra-design' ); ?></p>

                        <p><?php echo _( 'form-intro-pra-confirm' ); ?></p>

                        <p><?php echo _( 'form-intro-pra-article' ); ?></p>

                        <p><?php echo _( 'form-intro-pra-end' ); ?></p>

                    </div>

                    <div class="col-02 l-desktop">&nbsp;</div>

                </div>

                <hr class="th-hr-dark" />

                <blockquote class="l-bq-header">
                    <p><?php echo _( 'form-intro-pra-privacy' ); ?></p>
                </blockquote>
            </div>

        </section>







    <div id="f-section-form" class="f-section-form th-divider">

        <form class="form" method="post" name="projecklist" id="projecklist" autocomplete="off">



            <section id="f-section-planning" class="f-section-planning">

                <div class="l-wrapper">
                    <h3><?php echo _( 'form-planning-ttl' ); ?></h3>
                </div>

                <div class="l-wrapper">
                    <span class="required_notification"><span class="f-red">*</span> <?php echo _( 'form-planning-note-required' ); ?></span>
                </div>


            <div class="l-sub-section-wrapper">
            <div class="l-sub-section th-divider-dark">
                
                <div id="f-main-fieldset-projectName" class="js-f-main-fieldset l-main-fieldset">
                    <fieldset>
                        <div class="m-inquiry-block">
                            <legend class="m-inquiry-title">
                                <span class="js-toggle-info js-hint m-btn-info fa fa-info fa-lg"></span>
                                <span><?php echo _( 'form-planning-projectName-ttl' ); ?></span>
                            </legend>

                            <div class="m-block-info">
                                <blockquote class="slide-left">
                                    <p><?php echo _( 'form-planning-projectName-info' ); ?></p>
                                </blockquote>
                            </div>
                        </div>
                        
                        <div class="m-inputfield-wrapper">
                            <div class="m-site">
                                <div class="js-fieldset-1 is-visible">
                                    <div>
                                        <label for="f-project-name" class="f-required"><?php echo _( 'fld_project_name' ); ?></label>
                                        <input type="text" name="fld_project_name" id="f-project-name" autocomplete="off" maxlength="150" required />
                                    </div>
                                </div>
                            </div>
                        </div>



                    </fieldset>
                </div>

            </div> <!-- l-sub-section th-divider-dark END -->


            <div class="l-sub-section th-divider-dark">
                <div id="f-main-fieldset-contact" class="js-f-main-fieldset l-main-fieldset">
                <fieldset>
                    <div class="m-inquiry-block">
                        <legend class="m-inquiry-title">
                            <span class="js-toggle-info m-btn-info fa fa-info fa-lg"></span>
                            <span><?php echo _( 'form-planning-contact-ttl' ); ?></span>
                        </legend>

                        <div class="m-block-info">
                            <blockquote class="slide-left">
                                <p><?php echo _( 'form-planning-contact-info' ); ?></p>
                            </blockquote>
                        </div>
                    </div>


                    <div class="m-sub-wrapper">
                    
                    <div class="js-fieldset-1 is-visible m-sub-fieldset-container">
                    <fieldset class="m-sub-fieldset-inquiry">
                        <legend class="m-sub-inquiry-title"><?php echo _( 'form-planning-contact-primary-ttl' ); ?></legend>
                        
                        <fieldset>

                                <legend class="f-required m-inputlabel"><?php echo _( 'form-planning-contact-primary-stl-name' ); ?></legend>
                                <div class="row">
                                    <div class="col-pad-06">

                                        <label for="f-contact-firstname-1" class="m-sub-inputlabel"><?php echo _( 'fld_contact_primary_fn' ); ?></label>
                                        <input type="text" name="fld_contact_primary_fn" id="f-contact-firstname-1" required aria-required="true" maxlength="100" />

                                    </div>
                                    <div class="col-pad-06">

                                        <label for="f-contact-lastname-1" class="m-sub-inputlabel"><?php echo _( 'fld_contact_primary_ln' ); ?></label>
                                        <input type="text" name="fld_contact_primary_ln" id="f-contact-lastname-1" required aria-required="true" maxlength="100" />
                                    </div>
                                </div> <!-- .row END -->

                        </fieldset>


                        <div class="row">

                            <div class="col-pad-06">
                                <label for="f-contact-phone-1" class="f-required m-inputlabel"><?php echo _( 'tel_contact_primary_tel' ); ?></label>
                                <input type="tel" name="tel_contact_primary_tel" id="f-contact-phone-1" placeholder="ex: (000) 000-0000" required aria-required="true" pattern="(?:\(\d{3}\)|\d{3})[- ]?\d{3}[- ]?\d{4}" maxlength="14" />
                            </div>

                            <div class="col-pad-06">
                                <fieldset class="js-fieldset-email">

                                    
                                        <div class="js-email-verification">

                                            <label for="f-contact-email-verification-1" class="f-required m-inputlabel"><?php echo _( 'eml_contact_primary_email' ); ?></label>
                                            <input type="email" name="eml_contact_primary_email" id="f-contact-email-verification-1" required aria-required="true" maxlength="100" />

                                        </div>
                                        <div class="js-email-validation is-hidden">

                                            <label for="f-contact-email-validator-1" class="f-required m-inputlabel"><span class="fa fa-exclamation-triangle js-hint-no-match"></span>&nbsp;&nbsp;<?php echo _( 'eml_contact_primary_email_verification' ); ?></label>
                                            <input type="email" name="eml_contact_primary_email_verification" id="f-contact-email-validator-1" class="js-not-valid" required aria-required="true" maxlength="100" />

                                        </div>
                                    

                                </fieldset>
                            </div>

                        </div>


                    
                    </fieldset>


                    </div>
                    



                    <div class="js-fieldset-2 is-hidden m-sub-fieldset-container">
                    <fieldset class="m-sub-fieldset-inquiry">
                        <legend class="m-sub-inquiry-title"><?php echo _( 'form-planning-contact-alternate-ttl' ); ?></legend>

                            <fieldset>

                                <legend class="m-inputlabel"><?php echo _( 'form-planning-contact-alternate-stl-name' ); ?></legend>
                                <div class="row">

                                    <div class="col-pad-06">
                                        <label for="f-contact-firstname-2" class="m-sub-inputlabel"><?php echo _( 'fld_contact_alt_fn' ); ?></label>
                                        <input type="text" name="fld_contact_alt_fn" id="f-contact-firstname-2" maxlength="100" />
                                    </div>

                                    <div class="col-pad-06">
                                        <label for="f-contact-lastname-2" class="m-sub-inputlabel"><?php echo _( 'fld_contact_alt_ln' ); ?></label>
                                        <input type="text" name="fld_contact_alt_ln" id="f-contact-lastname-2" maxlength="100" />
                                    </div>

                                </div> <!-- .row END -->

                            </fieldset>


                            <div class="row">

                                <div class="col-pad-06">
                                    <label for="f-contact-phone-2" class="m-inputlabel"><?php echo _( 'tel_contact_alt_contact_tel' ); ?></label>
                                    <input type="tel" name="tel_contact_alt_contact_tel" id="f-contact-phone-2" placeholder="ex: (000) 000-0000" pattern="(?:\(\d{3}\)|\d{3})[- ]?\d{3}[- ]?\d{4}" maxlength="14" />
                                </div>
                                
                                <div class="col-pad-06">
                                    <fieldset class="js-fieldset-email">

                                        
                                            <div class="js-email-verification">

                                                <label for="f-contact-email-verification-2" class="m-inputlabel"><?php echo _( 'eml_contact_alt_email' ); ?></label>
                                                <input type="email" name="eml_contact_alt_email" id="f-contact-email-verification-2" maxlength="100" />

                                            </div>
                                            <div class="js-email-validation is-hidden">

                                                <label for="f-contact-email-validator-2" class="f-required m-inputlabel"><span class="fa fa-exclamation-triangle js-hint-no-match"></span>&nbsp;&nbsp;<?php echo _( 'eml_contact_alt_email_verification' ); ?></label>
                                                <input type="email" name="eml_contact_alt_email_verification" id="f-contact-email-validator-2" class="js-not-valid" maxlength="100" />

                                            </div>
                                        

                                    </fieldset>
                                </div>

                            </div>
                    
                    </fieldset>
                    </div>

                    <div class="m-sub-fieldset-container">
                    <div class="m-button-block">
                        <div class="row">
                            <div class="col-06-btn">
                                <div class="button js-btn-show is-active"><span class="fa fa-plus fa-lg"></span>&nbsp;&nbsp;<?php echo _( 'form-subFields-btn-add' ); ?></div>
                            </div>
                            <div class="col-06-btn">
                                <div class="button js-btn-hide is-disabled"><span class="fa fa-times fa-lg"></span>&nbsp;&nbsp;<?php echo _( 'form-subFields-btn-remove' ); ?></div>
                            </div>
                        </div>
                    </div>
                    </div>

                    </div>
                    
                </fieldset>
                </div>

            </div> <!-- l-sub-section th-divider-dark END -->




            <div class="l-sub-section th-divider-dark">

                <div id="f-main-fieldset-familiarity" class="js-f-main-fieldset l-main-fieldset">
                <fieldset>
                    <div class="m-inquiry-block">
                        <legend class="m-inquiry-title">
                            <span class="js-toggle-info m-btn-info fa fa-info fa-lg"></span>
                            <span><?php echo _( 'form-planning-familiarity-ttl' ); ?></span>
                        </legend>

                        <div class="m-block-info">
                            <blockquote class="slide-left">
                                <p><?php echo _( 'form-planning-familiarity-info' ); ?></p>
                            </blockquote>
                        </div>
                    </div>

                    <div class="m-inputfield-wrapper">
                        <select id="f-familiarity" name="opt_familiarity">
                            <option value=""><?php echo _( 'form-planning-familiarity-opt-choose' ); ?></option>
                            <option value="Not comfortable"><?php echo _( 'form-planning-familiarity-opt-notComfortable' ); ?></option>
                            <option value="Comfortable"><?php echo _( 'form-planning-familiarity-opt-comfortable' ); ?></option>
                            <option value="Very comfortable"><?php echo _( 'form-planning-familiarity-opt-veryComfortable' ); ?></option>
                        </select>
                    </div>

                </fieldset>
                </div>

            </div> <!-- l-sub-section th-divider-dark END -->




            <div class="l-sub-section th-divider-dark">

                    <div id="f-main-fieldset-timeline" class="js-f-main-fieldset l-main-fieldset">
                    <fieldset>
                        <div class="m-inquiry-block">
                            <legend class="m-inquiry-title">
                                <span class="js-toggle-info m-btn-info fa fa-info fa-lg"></span>
                                <span><?php echo _( 'form-planning-timeline-ttl' ); ?></span>
                            </legend>

                            <div class="m-block-info">
                                <blockquote class="slide-left">
                                    <p><?php echo _( 'form-planning-timeline-info' ); ?></p>
                                </blockquote>
                            </div>
                        </div>

                        <div class="m-inputfield-wrapper">
                            <select id="f-timeline" name="opt_timeline">
                                <option value=""><?php echo _( 'form-planning-timeline-opt-choose' ); ?></option>
                                <option <?php echo "value=\"" . _( 'form-planning-timeline-opt-none' ) . "\"";          ?> ><?php echo _( 'form-planning-timeline-opt-none' ); ?></option>
                                <option <?php echo "value=\"" . _( 'form-planning-timeline-opt-weeks_0_5' ) . "\"";     ?> ><?php echo _( 'form-planning-timeline-opt-weeks_0_5' ); ?></option>
                                <option <?php echo "value=\"" . _( 'form-planning-timeline-opt-months_1_3' ) . "\"";    ?> ><?php echo _( 'form-planning-timeline-opt-months_1_3' ); ?></option>
                                <option <?php echo "value=\"" . _( 'form-planning-timeline-opt-months_3_6' ) . "\"";    ?> ><?php echo _( 'form-planning-timeline-opt-months_3_6' ); ?></option>
                                <option <?php echo "value=\"" . _( 'form-planning-timeline-opt-months_6plus' ) . "\"";  ?> ><?php echo _( 'form-planning-timeline-opt-months_6plus' ); ?></option>
                            </select>
                        </div>
                    </fieldset>
                    </div>

            </div> <!-- l-sub-section th-divider-dark END -->




            <div class="l-sub-section th-divider-dark">

                <div id="f-main-fieldset-budget" class="js-f-main-fieldset l-main-fieldset">
                <fieldset>
                    <div class="m-inquiry-block">
                        <legend class="m-inquiry-title">
                            <span class="js-toggle-info m-btn-info fa fa-info fa-lg"></span>
                            <span><?php echo _( 'form-planning-budget-ttl' ); ?></span>
                        </legend>

                        <div class="m-block-info">
                            <blockquote class="slide-left">
                                <p><?php echo _( 'form-planning-budget-info' ); ?></p>
                            </blockquote>
                        </div>
                    </div>


                    <div class="m-inputfield-wrapper">
                        <select id="f-budget" name="opt_budget">
                            <option value=""><?php echo _( 'form-planning-budget-opt-choose' ); ?></option>
                            <option <?php echo "value=\"" . _( 'form-planning-budget-opt-none' ) . "\"";    ?> ><?php echo _( 'form-planning-budget-opt-none' ); ?></option>
                            <option <?php echo "value=\"" . _( 'form-planning-budget-opt-1k' ) . "\"";      ?> ><?php echo _( 'form-planning-budget-opt-1k' ); ?></option>
                            <option <?php echo "value=\"" . _( 'form-planning-budget-opt-2k' ) . "\"";      ?> ><?php echo _( 'form-planning-budget-opt-2k' ); ?></option>
                            <option <?php echo "value=\"" . _( 'form-planning-budget-opt-5k' ) . "\"";      ?> ><?php echo _( 'form-planning-budget-opt-5k' ); ?></option>
                            <option <?php echo "value=\"" . _( 'form-planning-budget-opt-10k' ) . "\"";     ?> ><?php echo _( 'form-planning-budget-opt-10k' ); ?></option>
                            <option <?php echo "value=\"" . _( 'form-planning-budget-opt-10kplus' ) . "\""; ?> ><?php echo _( 'form-planning-budget-opt-10kplus' ); ?></option>
                        </select>
                    </div>

                </fieldset>
                </div>

            </div> <!-- l-sub-section th-divider-dark END -->




            <div class="l-sub-section th-divider-dark">

                <div id="f-main-fieldset-billing" class="js-f-main-fieldset l-main-fieldset">
                <fieldset>
                    <div class="m-inquiry-block">
                        <legend class="m-inquiry-title">
                            <span class="js-toggle-info m-btn-info fa fa-info fa-lg"></span>
                            <span><?php echo _( 'form-planning-billing-ttl' ); ?></span>
                        </legend>

                        <div class="m-block-info">
                            <blockquote class="slide-left">
                                <p><?php echo _( 'form-planning-billing-info' ); ?></p>
                            </blockquote>
                        </div>
                    </div>
                    

                    <div class="m-inputfield-wrapper">

                        <div class="l-check-container m-sameas">
                            <input type="checkbox" name="xxx_billing_sameas_primary" id="f-sameas-primary" value="true" />
                            <label for="f-sameas-primary"><?php echo _( 'xxx_billing_sameas_primary' ); ?></label>
                        </div>



                        <fieldset>

                            <legend class="m-inputlabel"><?php echo _( 'form-planning-billing-stl-attn' ); ?></legend>
                            <div class="row">

                                <div class="col-pad-06">
                                    <label for="f-billing-fn" class="m-sub-inputlabel"><?php echo _( 'fld_billing_fn' ); ?></label>
                                    <input type="text" name="fld_billing_fn" id="f-billing-fn" autocomplete="off" maxlength="100" />
                                </div>

                                <div class="col-pad-06">
                                    <label for="f-billing-ln" class="m-sub-inputlabel"><?php echo _( 'fld_billing_ln' ); ?></label>
                                    <input type="text" name="fld_billing_ln" id="f-billing-ln" autocomplete="off" maxlength="100" />
                                </div>

                            </div> <!-- .row END -->

                        </fieldset>


                        <div class="row">
                            <div class="col-pad-06">

                                <label for="f-billing-coname" class="m-inputlabel"><?php echo _( 'fld_billing_coname' ); ?></label>
                                <input type="text" name="fld_billing_coname" id="f-billing-coname" autocomplete="off" maxlength="100" />

                            </div>
                            <div class="col-pad-06">

                                <label for="f-billing-area" class="m-inputlabel"><?php echo _( 'fld_billing_area' ); ?></label>
                                <input type="text" name="fld_billing_area" id="f-billing-area" placeholder="" autocomplete="off" maxlength="100" />

                            </div>
                        </div>


                        <div class="row">
                            <div class="col-pad-06">

                                <label for="f-billing-phone" class="m-inputlabel"><?php echo _( 'tel_billing_tel' ); ?></label>
                                <input type="tel" name="tel_billing_tel" id="f-billing-phone" placeholder="ex: (000) 000-0000" autocomplete="off" maxlength="14" />

                            </div>
                            <div class="col-pad-06">

                                <label for="f-billing-fax" class="m-inputlabel"><?php echo _( 'tel_billing_fax' ); ?></label>
                                <input type="tel" name="tel_billing_fax" id="f-billing-fax" placeholder="ex: (000) 000-0000" autocomplete="off" maxlength="14" />

                            </div>
                        </div>


                        <fieldset class="">
                            <legend class="m-inputlabel"><?php echo _( 'form-planning-billing-stl-address' ); ?></legend>
                            <div class="row">

                                <div class="col-pad-06">
                                    <label for="f-billing-address" class="m-sub-inputlabel"><?php echo _( 'fld_billing_address' ); ?></label>
                                    <input type="text" name="fld_billing_address" id="f-billing-address" autocomplete="off" maxlength="100" />
                                </div>

                                <div class="col-pad-06">
                                    <label for="f-billing-address-2" class="m-sub-inputlabel"><?php echo _( 'fld_billing_address_2' ); ?></label>
                                    <input type="text" name="fld_billing_address_2" id="f-billing-address-2" autocomplete="off" maxlength="100" />
                                </div>

                            </div>
                            <div class="row">

                                <div class="col-pad-06">
                                    <label for="f-billing-city" class="m-sub-inputlabel"><?php echo _( 'fld_billing_city' ); ?></label>
                                    <input type="text" name="fld_billing_city" id="f-billing-city" autocomplete="off" maxlength="50" />
                                </div>

                                <div class="col-pad-06">
                                    <label for="f-billing-province" class="m-sub-inputlabel"><?php echo _( 'opt_billing_province' ); ?></label>
                                    <input type="text" name="fld_billing_province" id="f-billing-province" autocomplete="off" maxlength="50" />
                                </div>

                            </div>
                            <div class="row">

                                <div class="col-pad-06">
                                    <label for="f-billing-postal" class="m-sub-inputlabel"><?php echo _( 'fld_billing_postalcode' ); ?></label>
                                    <input type="text" name="fld_billing_postalcode" id="f-billing-postal" autocomplete="off" maxlength="7" />
                                </div>

                                <div class="col-pad-06">
                                    <label for="f-billing-country" class="m-sub-inputlabel"><?php echo _( 'fld_billing_country' ); ?></label>
                                    <input type="text" name="fld_billing_country" id="f-billing-country" autocomplete="off" maxlength="50" />
                                </div>

                            </div>

                        </fieldset>

                        <fieldset class="js-fieldset-email">

                            <div class="row">
                            <div class="col-pad-06 js-email-verification">

                                <label for="f-billing-email-verification" class="m-inputlabel"><?php echo _( 'eml_billing_email' ); ?></label>
                                <input type="email" name="eml_billing_email" id="f-billing-email-verification" maxlength="100"/>

                            </div>
                            <div class="col-pad-06 js-email-validation is-hidden">

                                <label for="f-billing-email-validator" class="m-inputlabel"><span class="fa fa-exclamation-triangle js-hint-no-match"></span>&nbsp;&nbsp;<?php echo _( 'eml_billing_email_verification' ); ?></label>
                                <input type="email" name="eml_billing_email_verification" id="f-billing-email-validator" class="js-not-valid" maxlength="100"/>

                            </div>
                            </div>

                        </fieldset>

                    </div> <!-- END FIELDSET -->


                </fieldset>
                </div> <!-- .row END -->

            </div> <!-- l-sub-section th-divider-dark END -->




            <div class="l-sub-section th-divider-dark">

                <div class="l-main-fieldset">
                    <fieldset>
                        <div class="m-inquiry-block">
                            <legend class="m-inquiry-title">
                                <span class="js-toggle-info m-btn-info fa fa-info fa-lg"></span>
                                <span><?php echo _( 'form-planning-tc-ttl' ); ?></span>
                            </legend>

                            <div class="m-block-info">
                                <blockquote class="slide-left">
                                    <p><?php echo _( 'form-planning-tc-info' ); ?></p>
                                </blockquote>
                            </div>
                        </div>
                        
                        <div class="m-inputfield-wrapper">
                            <div class="l-check-container f-tc-container">
                                <label for="f-condition" class="f-required f-tc-label"><?php echo _( 'bol_t_and_c_reviewed' ); ?></label>
                                <input type="checkbox" name="bol_t_and_c_reviewed" id="f-condition" class="f-tc-cbx" value="true" required />
                            </div>
                        </div>

                    </fieldset>
                </div>

            </div> <!-- l-sub-section th-divider-dark END -->
            </div> <!-- l-sub-section-wrapper END -->
                
            </section>










            <section id="f-section-content" class="f-section-content th-divider">

                <div class="l-wrapper">
                    <h3><?php echo _( 'form-content-ttl' ); ?></h3>
                </div>
                

            <div class="l-sub-section-wrapper">
            <div class="l-sub-section th-divider-dark">

                <div id="f-main-fieldset-info" class="js-f-main-fieldset l-main-fieldset">
                <fieldset>
                    <div class="m-inquiry-block">
                        <legend class="m-inquiry-title">
                            <span class="js-toggle-info m-btn-info fa fa-info fa-lg"></span>
                            <span><?php echo _( 'form-content-info-ttl' ); ?></span>
                        </legend>

                        <div class="m-block-info">
                            <blockquote class="slide-left">
                                <p><?php echo _( 'form-content-info-info' ); ?></p>
                            </blockquote>
                        </div>
                    </div>
                    
                    <div class="m-inputfield-wrapper">

                        <div class="row">
                            <div class="col-pad-06">
                                <label for="f-info-legal" class="m-inputlabel"><?php echo _( 'fld_info_legal' ); ?></label>
                                <input type="text" name="fld_info_legal" id="f-info-legal" autocomplete="off" maxlength="100" />
                            </div>


                            <div class="col-pad-06">
                                <label for="f-info-brand" class="m-inputlabel"><?php echo _( 'fld_info_brand' ); ?></label>
                                <input type="text" name="fld_info_brand" id="f-info-brand" autocomplete="off" maxlength="100" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-pad-06">
                                <label for="f-info-tagline" class="m-inputlabel"><?php echo _( 'fld_info_tagline' ); ?></label>
                                <input type="text" name="fld_info_tagline" id="f-info-tagline" autocomplete="off" maxlength="100" />
                            </div>


                            <div class="col-pad-06">
                                <label for="f-info-email" class="m-inputlabel"><?php echo _( 'eml_info_email' ); ?></label>
                                <input type="email" name="eml_info_email" id="f-info-email" autocomplete="off" maxlength="100" />
                            </div>

                        </div>
                        <div class="row">

                            <div class="col-pad-06">
                                <label for="f-info-phone" class="m-inputlabel"><?php echo _( 'tel_info_tel' ); ?></label>
                                <div>
                                    <input type="tel" name="tel_info_tel" id="f-info-phone" placeholder="ex: (000) 000-0000" autocomplete="off" maxlength="14" />
                                </div>
                            </div>


                            <div class="col-pad-06">
                                <label for="f-info-fax" class="m-inputlabel"><?php echo _( 'tel_info_fax' ); ?></label>
                                <div>
                                    <input type="tel" name="tel_info_fax" id="f-info-fax" placeholder="ex: (000) 000-0000" autocomplete="off" maxlength="14" />
                                </div>
                            </div>
                        </div> <!-- .row END -->

                        <fieldset>
                            <legend class="m-inputlabel"><?php echo _( 'form-content-info-adress-stl' ); ?></legend>
                            <div class="row">

                                <div class="col-pad-06">
                                    <label for="f-info-address" class="m-sub-inputlabel"><?php echo _( 'fld_info_address' ); ?></label>
                                    <input type="text" name="fld_info_address" id="f-info-address" autocomplete="off" maxlength="100" />
                                </div>

                                <div class="col-pad-06">
                                    <label for="f-info-address-2" class="m-sub-inputlabel"><?php echo _( 'fld_info_address_2' ); ?></label>
                                    <input type="text" name="fld_info_address_2" id="f-info-address-2" autocomplete="off" maxlength="100" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-pad-06">
                                    <label for="f-info-city" class="m-sub-inputlabel"><?php echo _( 'fld_info_city' ); ?></label>
                                    <input type="text" name="fld_info_city" id="f-info-city" autocomplete="off" maxlength="50" />
                                </div>

                                <div class="col-pad-06">   
                                    <label for="f-info-province" class="m-sub-inputlabel"><?php echo _( 'opt_info_province' ); ?></label>
                                    <input type="text" name="fld_info_province" id="f-info-province" autocomplete="off" maxlength="50" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-pad-06">
                                    <label for="f-info-postal" class="m-sub-inputlabel"><?php echo _( 'fld_info_postalcode' ); ?></label>
                                    <input type="text" name="fld_info_postalcode" id="f-info-postal" autocomplete="off" maxlength="7" />
                                </div>

                                <div class="col-pad-06">
                                    <label for="f-info-country" class="m-sub-inputlabel"><?php echo _( 'fld_info_country' ); ?></label>
                                    <input type="text" name="fld_info_country" id="f-info-country" autocomplete="off" maxlength="50" />
                                </div>
                            </div> <!-- .row END -->

                        </fieldset>

                        <div>
                            <label for="f-info-description" class="m-inputlabel"><?php echo _( 'txt_info_description' ); ?></label>
                            <textarea name="txt_info_description" id="f-info-description" rows="2" maxlength="500"></textarea>
                        </div>

                    </div>

                </fieldset>
                </div>

            </div> <!-- l-sub-section th-divider-dark END -->




            <div class="l-sub-section th-divider-dark">

                <div id="f-main-fieldset-hours" class="js-f-main-fieldset l-main-fieldset">
                <fieldset class="l-hours">
                        <div class="m-inquiry-block">
                            <legend class="m-inquiry-title">
                                <span class="js-toggle-info m-btn-info fa fa-info fa-lg"></span>
                                <span><?php echo _( 'form-content-hours-ttl' ); ?></span>
                            </legend>

                            <div class="m-block-info">
                                <blockquote class="slide-left">
                                    <p><?php echo _( 'form-content-hours-info' ); ?></p>
                                </blockquote>
                            </div>
                        </div>


                    <div class="m-sub-wrapper">

                        <div class="js-fieldset-1 is-visible m-sub-fieldset-container">
                        <fieldset class="is-relative m-sub-fieldset-inquiry">
                            <div class="m-hours-block m-range js-hours-block">
                                <label for="f-hours-set-1" class="m-hours-label"><?php echo _( 'form-planning-hours-stl-range' ); ?></label>
                                <select id="f-hours-set-1" name="opt_hours_regular_set_1_range">
                                    <!-- <optgroup 
                                    <?php 
                                    // echo "label=\"" . _( 'form-planning-hours-range-lbl-default' ) . "\""; 
                                    ?> 
                                    > --> <!-- default -->
                                        <option value=""><?php echo _( 'form-planning-hours-range-opt-choose' ); ?></option>
                                    <!-- </optgroup> -->
                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-range-lbl-days' ) . "\""; ?> > <!-- Range -->
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-everyday' ) . "\"";       ?> ><?php echo _( 'form-planning-hours-range-opt-everyday' );       ?></option>
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-weekend' ) . "\"";        ?> ><?php echo _( 'form-planning-hours-range-opt-weekend' );        ?></option>
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-mondayToFriday' ) . "\""; ?> ><?php echo _( 'form-planning-hours-range-opt-mondayToFriday' ); ?></option>
                                    </optgroup>
                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-range-lbl-day' ) . "\""; ?> > <!-- Single Days -->
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-mon' ) . "\""; ?> ><?php echo _( 'form-planning-hours-range-opt-mon' ); ?></option>
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-tue' ) . "\""; ?> ><?php echo _( 'form-planning-hours-range-opt-tue' ); ?></option>
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-wed' ) . "\""; ?> ><?php echo _( 'form-planning-hours-range-opt-wed' ); ?></option>
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-thu' ) . "\""; ?> ><?php echo _( 'form-planning-hours-range-opt-thu' ); ?></option>
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-fri' ) . "\""; ?> ><?php echo _( 'form-planning-hours-range-opt-fri' ); ?></option>
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-sat' ) . "\""; ?> ><?php echo _( 'form-planning-hours-range-opt-sat' ); ?></option>
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-sun' ) . "\""; ?> ><?php echo _( 'form-planning-hours-range-opt-sun' ); ?></option>
                                    </optgroup>
                                </select>

                            </div>




                            <div class="m-hours-block m-from">
                            <label for="f-hours-set-start-hour-1" class="m-hours-label"><?php echo _( 'form-planning-hours-stl-from' ); ?></label>
                            <select id="f-hours-set-start-hour-1" name="opt_hours_regular_set_1_start_h">
                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-from-lbl-hours' ) . "\""; ?> > <!-- Hour -->
                                        <option disabled selected value="">--</option>
                                        <option value="00h">00h</option>
                                        <option value="01h">01h</option>
                                        <option value="02h">02h</option>
                                        <option value="03h">03h</option>
                                        <option value="04h">04h</option>
                                        <option value="05h">05h</option>
                                        <option value="06h">06h</option>
                                        <option value="07h">07h</option>
                                        <option value="08h">08h</option>
                                        <option value="09h">09h</option>
                                        <option value="10h">10h</option>
                                        <option value="11h">11h</option>
                                        <option value="12h">12h</option>
                                        <option value="13h">13h</option>
                                        <option value="14h">14h</option>
                                        <option value="15h">15h</option>
                                        <option value="16h">16h</option>
                                        <option value="17h">17h</option>
                                        <option value="18h">18h</option>
                                        <option value="19h">19h</option>
                                        <option value="20h">20h</option>
                                        <option value="21h">21h</option>
                                        <option value="22h">22h</option>
                                        <option value="23h">23h</option>
                                    </optgroup>
                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-from-lbl-closed' ) . "\""; ?> > <!-- Closed -->                                           
                                        <option value="" class="js-opt-closed">--</option>
                                    </optgroup>
                            </select>

                            <select id="f-hours-set-start-min-1" name="opt_hours_regular_set_1_start_m">
                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-from-lbl-minutes' ) . "\""; ?> > <!-- Minute -->
                                        <option disabled selected value="">--</option>
                                        <option value="00">00</option>
                                        <option value="15">15</option>
                                        <option value="30">30</option>
                                        <option value="45">45</option>
                                    </optgroup>
                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-from-lbl-closed' ) . "\""; ?> >                                            
                                        <option value="" class="js-opt-closed">--</option>
                                    </optgroup>
                            </select>
                            <span class="m-hours-dash">-</span>
                            </div>


                            <div class="m-hours-block m-to">
                            <label for="f-hours-set-end-hour-1" class="m-hours-label"><?php echo _( 'form-planning-hours-stl-to' ); ?></label>
                            <select id="f-hours-set-end-hour-1" name="opt_hours_regular_set_1_end_h">
                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-from-lbl-hours' ) . "\""; ?> >
                                        <option disabled selected value="">--</option>
                                        <option value="00h">00h</option>
                                        <option value="01h">01h</option>
                                        <option value="02h">02h</option>
                                        <option value="03h">03h</option>
                                        <option value="04h">04h</option>
                                        <option value="05h">05h</option>
                                        <option value="06h">06h</option>
                                        <option value="07h">07h</option>
                                        <option value="08h">08h</option>
                                        <option value="09h">09h</option>
                                        <option value="10h">10h</option>
                                        <option value="11h">11h</option>
                                        <option value="12h">12h</option>
                                        <option value="13h">13h</option>
                                        <option value="14h">14h</option>
                                        <option value="15h">15h</option>
                                        <option value="16h">16h</option>
                                        <option value="17h">17h</option>
                                        <option value="18h">18h</option>
                                        <option value="19h">19h</option>
                                        <option value="20h">20h</option>
                                        <option value="21h">21h</option>
                                        <option value="22h">22h</option>
                                        <option value="23h">23h</option>
                                    </optgroup>
                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-from-lbl-closed' ) . "\""; ?> >                                            
                                        <option value="" class="js-opt-closed">--</option>
                                    </optgroup>
                            </select>

                            <select id="f-hours-set-end-min-1" name="opt_hours_regular_set_1_end_m">
                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-from-lbl-minutes' ) . "\""; ?> >
                                        <option disabled selected value="">--</option>
                                        <option value="00">00</option>
                                        <option value="15">15</option>
                                        <option value="30">30</option>
                                        <option value="45">45</option>
                                    </optgroup>
                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-from-lbl-closed' ) . "\""; ?> >                                            
                                        <option value="" class="js-opt-closed">--</option>
                                    </optgroup>
                            </select>
                            </div>

                            <div class="l-check-container m-hours-block m-closed">
                                <input type="checkbox" name="cbx_hours_regular_set_1_closed" id="f-hours-set-closed-1" class="js-hours-closed" value="closed">
                                <label for="f-hours-set-closed-1"><?php echo _( 'cbx_hours_regular_set_1_closed' ); ?></label>
                            </div>

                        </fieldset>
                        </div>




                        <div class="js-fieldset-2 is-hidden m-sub-fieldset-container">
                        <fieldset class="is-relative m-sub-fieldset-inquiry">

                            <div class="m-hours-block m-range js-hours-block">
                                <label for="f-hours-set-2" class="m-hours-label"><?php echo _( 'form-planning-hours-stl-range' ); ?></label>
                                <select id="f-hours-set-2" name="opt_hours_regular_set_2_range">

                                    <option value=""><?php echo _( 'form-planning-hours-range-opt-choose' ); ?></option>

                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-range-lbl-days' ) . "\""; ?> >
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-everyday' ) . "\"";       ?> ><?php echo _( 'form-planning-hours-range-opt-everyday' );       ?></option>
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-weekend' ) . "\"";        ?> ><?php echo _( 'form-planning-hours-range-opt-weekend' );        ?></option>
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-mondayToFriday' ) . "\""; ?> ><?php echo _( 'form-planning-hours-range-opt-mondayToFriday' ); ?></option>
                                    </optgroup>
                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-range-lbl-day' ) . "\""; ?> >
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-mon' ) . "\""; ?> ><?php echo _( 'form-planning-hours-range-opt-mon' ); ?></option>
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-tue' ) . "\""; ?> ><?php echo _( 'form-planning-hours-range-opt-tue' ); ?></option>
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-wed' ) . "\""; ?> ><?php echo _( 'form-planning-hours-range-opt-wed' ); ?></option>
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-thu' ) . "\""; ?> ><?php echo _( 'form-planning-hours-range-opt-thu' ); ?></option>
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-fri' ) . "\""; ?> ><?php echo _( 'form-planning-hours-range-opt-fri' ); ?></option>
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-sat' ) . "\""; ?> ><?php echo _( 'form-planning-hours-range-opt-sat' ); ?></option>
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-sun' ) . "\""; ?> ><?php echo _( 'form-planning-hours-range-opt-sun' ); ?></option>
                                    </optgroup>
                                </select>
                            </div>

                            <div class="m-hours-block m-from">
                            <label for="f-hours-set-start-hour-2" class="m-hours-label"><?php echo _( 'form-planning-hours-stl-from' ); ?></label>
                            <select id="f-hours-set-start-hour-2" name="opt_hours_regular_set_2_start_h">
                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-from-lbl-hours' ) . "\""; ?> >
                                        <option disabled selected value="">--</option>
                                        <option value="00h">00h</option>
                                        <option value="01h">01h</option>
                                        <option value="02h">02h</option>
                                        <option value="03h">03h</option>
                                        <option value="04h">04h</option>
                                        <option value="05h">05h</option>
                                        <option value="06h">06h</option>
                                        <option value="07h">07h</option>
                                        <option value="08h">08h</option>
                                        <option value="09h">09h</option>
                                        <option value="10h">10h</option>
                                        <option value="11h">11h</option>
                                        <option value="12h">12h</option>
                                        <option value="13h">13h</option>
                                        <option value="14h">14h</option>
                                        <option value="15h">15h</option>
                                        <option value="16h">16h</option>
                                        <option value="17h">17h</option>
                                        <option value="18h">18h</option>
                                        <option value="19h">19h</option>
                                        <option value="20h">20h</option>
                                        <option value="21h">21h</option>
                                        <option value="22h">22h</option>
                                        <option value="23h">23h</option>
                                    </optgroup>
                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-from-lbl-closed' ) . "\""; ?> >                                            
                                        <option value="" class="js-opt-closed">--</option>
                                    </optgroup>
                            </select>

                            <select id="f-hours-set-start-min-2" name="opt_hours_regular_set_2_start_m">
                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-from-lbl-minutes' ) . "\""; ?> >
                                        <option disabled selected value="">--</option>
                                        <option value="00">00</option>
                                        <option value="15">15</option>
                                        <option value="30">30</option>
                                        <option value="45">45</option>
                                    </optgroup>
                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-from-lbl-closed' ) . "\""; ?> >                                            
                                        <option value="" class="js-opt-closed">--</option>
                                    </optgroup>
                            </select>
                            <span class="m-hours-dash">-</span>
                            </div>


                            <div class="m-hours-block m-to">
                            <label for="f-hours-set-end-hour-2" class="m-hours-label"><?php echo _( 'form-planning-hours-stl-to' ); ?></label>
                            <select id="f-hours-set-end-hour-2" name="opt_hours_regular_set_2_end_h">
                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-from-lbl-hours' ) . "\""; ?> >
                                        <option disabled selected value="">--</option>
                                        <option value="00h">00h</option>
                                        <option value="01h">01h</option>
                                        <option value="02h">02h</option>
                                        <option value="03h">03h</option>
                                        <option value="04h">04h</option>
                                        <option value="05h">05h</option>
                                        <option value="06h">06h</option>
                                        <option value="07h">07h</option>
                                        <option value="08h">08h</option>
                                        <option value="09h">09h</option>
                                        <option value="10h">10h</option>
                                        <option value="11h">11h</option>
                                        <option value="12h">12h</option>
                                        <option value="13h">13h</option>
                                        <option value="14h">14h</option>
                                        <option value="15h">15h</option>
                                        <option value="16h">16h</option>
                                        <option value="17h">17h</option>
                                        <option value="18h">18h</option>
                                        <option value="19h">19h</option>
                                        <option value="20h">20h</option>
                                        <option value="21h">21h</option>
                                        <option value="22h">22h</option>
                                        <option value="23h">23h</option>
                                    </optgroup>
                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-from-lbl-closed' ) . "\""; ?> >                                            
                                        <option value="" class="js-opt-closed">--</option>
                                    </optgroup>
                            </select>

                            <select id="f-hours-set-end-min-2" name="opt_hours_regular_set_2_end_m">
                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-from-lbl-minutes' ) . "\""; ?> >
                                        <option disabled selected value="">--</option>
                                        <option value="00">00</option>
                                        <option value="15">15</option>
                                        <option value="30">30</option>
                                        <option value="45">45</option>
                                    </optgroup>
                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-from-lbl-closed' ) . "\""; ?> >                                            
                                        <option value="" class="js-opt-closed">--</option>
                                    </optgroup>
                            </select>
                            </div>

                            <div class="l-check-container m-hours-block m-closed">
                                <input type="checkbox" name="cbx_hours_regular_set_2_closed" id="f-hours-set-closed-2" class="js-hours-closed" value="closed">
                                <label for="f-hours-set-closed-2"><?php echo _( 'cbx_hours_regular_set_2_closed' ); ?></label>
                            </div>

                        </fieldset>
                        </div>




                        <div class="js-fieldset-3 is-hidden m-sub-fieldset-container">
                        <fieldset class="is-relative m-sub-fieldset-inquiry">

                            <div class="m-hours-block m-range js-hours-block">
                                <label for="f-hours-set-3" class="m-hours-label"><?php echo _( 'form-planning-hours-stl-range' ); ?></label>
                                <select id="f-hours-set-3" name="opt_hours_regular_set_3_range">
                                    
                                    <option value=""><?php echo _( 'form-planning-hours-range-opt-choose' ); ?></option>
                                    
                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-range-lbl-days' ) . "\""; ?> >
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-everyday' ) . "\"";       ?> ><?php echo _( 'form-planning-hours-range-opt-everyday' );       ?></option>
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-weekend' ) . "\"";        ?> ><?php echo _( 'form-planning-hours-range-opt-weekend' );        ?></option>
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-mondayToFriday' ) . "\""; ?> ><?php echo _( 'form-planning-hours-range-opt-mondayToFriday' ); ?></option>
                                    </optgroup>
                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-range-lbl-day' ) . "\""; ?> >
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-mon' ) . "\""; ?> ><?php echo _( 'form-planning-hours-range-opt-mon' ); ?></option>
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-tue' ) . "\""; ?> ><?php echo _( 'form-planning-hours-range-opt-tue' ); ?></option>
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-wed' ) . "\""; ?> ><?php echo _( 'form-planning-hours-range-opt-wed' ); ?></option>
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-thu' ) . "\""; ?> ><?php echo _( 'form-planning-hours-range-opt-thu' ); ?></option>
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-fri' ) . "\""; ?> ><?php echo _( 'form-planning-hours-range-opt-fri' ); ?></option>
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-sat' ) . "\""; ?> ><?php echo _( 'form-planning-hours-range-opt-sat' ); ?></option>
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-sun' ) . "\""; ?> ><?php echo _( 'form-planning-hours-range-opt-sun' ); ?></option>
                                    </optgroup>
                                </select>
                            </div>

                            <div class="m-hours-block m-from">
                            <label for="f-hours-set-start-hour-3" class="m-hours-label"><?php echo _( 'form-planning-hours-stl-from' ); ?></label>
                            <select id="f-hours-set-start-hour-3" name="opt_hours_regular_set_3_start_h">
                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-from-lbl-hours' ) . "\""; ?> >
                                        <option disabled selected value="">--</option>
                                        <option value="00h">00h</option>
                                        <option value="01h">01h</option>
                                        <option value="02h">02h</option>
                                        <option value="03h">03h</option>
                                        <option value="04h">04h</option>
                                        <option value="05h">05h</option>
                                        <option value="06h">06h</option>
                                        <option value="07h">07h</option>
                                        <option value="08h">08h</option>
                                        <option value="09h">09h</option>
                                        <option value="10h">10h</option>
                                        <option value="11h">11h</option>
                                        <option value="12h">12h</option>
                                        <option value="13h">13h</option>
                                        <option value="14h">14h</option>
                                        <option value="15h">15h</option>
                                        <option value="16h">16h</option>
                                        <option value="17h">17h</option>
                                        <option value="18h">18h</option>
                                        <option value="19h">19h</option>
                                        <option value="20h">20h</option>
                                        <option value="21h">21h</option>
                                        <option value="22h">22h</option>
                                        <option value="23h">23h</option>
                                    </optgroup>
                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-from-lbl-closed' ) . "\""; ?> >                                            
                                        <option value="" class="js-opt-closed">--</option>
                                    </optgroup>
                            </select>

                            <select id="f-hours-set-start-min-3" name="opt_hours_regular_set_3_start_m">
                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-from-lbl-minutes' ) . "\""; ?> >
                                        <option disabled selected value="">--</option>
                                        <option value="00">00</option>
                                        <option value="15">15</option>
                                        <option value="30">30</option>
                                        <option value="45">45</option>
                                    </optgroup>
                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-from-lbl-closed' ) . "\""; ?> >                                            
                                        <option value="" class="js-opt-closed">--</option>
                                    </optgroup>
                            </select>
                            <span class="m-hours-dash">-</span>
                            </div>


                            <div class="m-hours-block m-to">
                            <label for="f-hours-set-end-hour-3" class="m-hours-label"><?php echo _( 'form-planning-hours-stl-to' ); ?></label>
                            <select id="f-hours-set-end-hour-3" name="opt_hours_regular_set_3_end_h">
                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-from-lbl-hours' ) . "\""; ?> >
                                        <option disabled selected value="">--</option>
                                        <option value="00h">00h</option>
                                        <option value="01h">01h</option>
                                        <option value="02h">02h</option>
                                        <option value="03h">03h</option>
                                        <option value="04h">04h</option>
                                        <option value="05h">05h</option>
                                        <option value="06h">06h</option>
                                        <option value="07h">07h</option>
                                        <option value="08h">08h</option>
                                        <option value="09h">09h</option>
                                        <option value="10h">10h</option>
                                        <option value="11h">11h</option>
                                        <option value="12h">12h</option>
                                        <option value="13h">13h</option>
                                        <option value="14h">14h</option>
                                        <option value="15h">15h</option>
                                        <option value="16h">16h</option>
                                        <option value="17h">17h</option>
                                        <option value="18h">18h</option>
                                        <option value="19h">19h</option>
                                        <option value="20h">20h</option>
                                        <option value="21h">21h</option>
                                        <option value="22h">22h</option>
                                        <option value="23h">23h</option>
                                    </optgroup>
                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-from-lbl-closed' ) . "\""; ?> >                                            
                                        <option value="" class="js-opt-closed">--</option>
                                    </optgroup>
                            </select>

                            <select id="f-hours-set-end-min-3" name="opt_hours_regular_set_3_end_m">
                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-from-lbl-minutes' ) . "\""; ?> >
                                        <option disabled selected value="">--</option>
                                        <option value="00">00</option>
                                        <option value="15">15</option>
                                        <option value="30">30</option>
                                        <option value="45">45</option>
                                    </optgroup>
                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-from-lbl-closed' ) . "\""; ?> >                                            
                                        <option value="" class="js-opt-closed">--</option>
                                    </optgroup>
                            </select>
                            </div>

                            <div class="l-check-container m-hours-block m-closed">
                                <input type="checkbox" name="cbx_hours_regular_set_3_closed" id="f-hours-set-closed-3" class="js-hours-closed" value="closed">
                                <label for="f-hours-set-closed-3"><?php echo _( 'cbx_hours_regular_set_3_closed' ); ?></label>
                            </div>

                        </fieldset>
                        </div>




                        <div class="js-fieldset-4 is-hidden m-sub-fieldset-container">
                        <fieldset class="is-relative m-sub-fieldset-inquiry">

                            <div class="m-hours-block m-range js-hours-block">
                                <label for="f-hours-set-4" class="m-hours-label"><?php echo _( 'form-planning-hours-stl-range' ); ?></label>
                                <select id="f-hours-set-4" name="opt_hours_regular_set_4_range">

                                    <option value=""><?php echo _( 'form-planning-hours-range-opt-choose' ); ?></option>

                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-range-lbl-days' ) . "\""; ?> >
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-everyday' ) . "\"";       ?> ><?php echo _( 'form-planning-hours-range-opt-everyday' );       ?></option>
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-weekend' ) . "\"";        ?> ><?php echo _( 'form-planning-hours-range-opt-weekend' );        ?></option>
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-mondayToFriday' ) . "\""; ?> ><?php echo _( 'form-planning-hours-range-opt-mondayToFriday' ); ?></option>
                                    </optgroup>
                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-range-lbl-day' ) . "\""; ?> >
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-mon' ) . "\""; ?> ><?php echo _( 'form-planning-hours-range-opt-mon' ); ?></option>
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-tue' ) . "\""; ?> ><?php echo _( 'form-planning-hours-range-opt-tue' ); ?></option>
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-wed' ) . "\""; ?> ><?php echo _( 'form-planning-hours-range-opt-wed' ); ?></option>
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-thu' ) . "\""; ?> ><?php echo _( 'form-planning-hours-range-opt-thu' ); ?></option>
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-fri' ) . "\""; ?> ><?php echo _( 'form-planning-hours-range-opt-fri' ); ?></option>
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-sat' ) . "\""; ?> ><?php echo _( 'form-planning-hours-range-opt-sat' ); ?></option>
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-sun' ) . "\""; ?> ><?php echo _( 'form-planning-hours-range-opt-sun' ); ?></option>
                                    </optgroup>
                                </select>
                            </div>

                            <div class="m-hours-block m-from">
                            <label for="f-hours-set-start-hour-4" class="m-hours-label"><?php echo _( 'form-planning-hours-stl-from' ); ?></label>
                            <select id="f-hours-set-start-hour-4" name="opt_hours_regular_set_4_start_h">
                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-from-lbl-hours' ) . "\""; ?> >
                                        <option disabled selected value="">--</option>
                                        <option value="00h">00h</option>
                                        <option value="01h">01h</option>
                                        <option value="02h">02h</option>
                                        <option value="03h">03h</option>
                                        <option value="04h">04h</option>
                                        <option value="05h">05h</option>
                                        <option value="06h">06h</option>
                                        <option value="07h">07h</option>
                                        <option value="08h">08h</option>
                                        <option value="09h">09h</option>
                                        <option value="10h">10h</option>
                                        <option value="11h">11h</option>
                                        <option value="12h">12h</option>
                                        <option value="13h">13h</option>
                                        <option value="14h">14h</option>
                                        <option value="15h">15h</option>
                                        <option value="16h">16h</option>
                                        <option value="17h">17h</option>
                                        <option value="18h">18h</option>
                                        <option value="19h">19h</option>
                                        <option value="20h">20h</option>
                                        <option value="21h">21h</option>
                                        <option value="22h">22h</option>
                                        <option value="23h">23h</option>
                                    </optgroup>
                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-from-lbl-closed' ) . "\""; ?> >                                            
                                        <option value="" class="js-opt-closed">--</option>
                                    </optgroup>
                            </select>

                            <select id="f-hours-set-start-min-4" name="opt_hours_regular_set_4_start_m">
                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-from-lbl-minutes' ) . "\""; ?> >
                                        <option disabled selected value="">--</option>
                                        <option value="00">00</option>
                                        <option value="15">15</option>
                                        <option value="30">30</option>
                                        <option value="45">45</option>
                                    </optgroup>
                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-from-lbl-closed' ) . "\""; ?> >                                            
                                        <option value="" class="js-opt-closed">--</option>
                                    </optgroup>
                            </select>
                            <span class="m-hours-dash">-</span>
                            </div>


                            <div class="m-hours-block m-to">
                            <label for="f-hours-set-end-hour-4" class="m-hours-label"><?php echo _( 'form-planning-hours-stl-to' ); ?></label>
                            <select id="f-hours-set-end-hour-4" name="opt_hours_regular_set_4_end_h">
                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-from-lbl-hours' ) . "\""; ?> >
                                        <option disabled selected value="">--</option>
                                        <option value="00h">00h</option>
                                        <option value="01h">01h</option>
                                        <option value="02h">02h</option>
                                        <option value="03h">03h</option>
                                        <option value="04h">04h</option>
                                        <option value="05h">05h</option>
                                        <option value="06h">06h</option>
                                        <option value="07h">07h</option>
                                        <option value="08h">08h</option>
                                        <option value="09h">09h</option>
                                        <option value="10h">10h</option>
                                        <option value="11h">11h</option>
                                        <option value="12h">12h</option>
                                        <option value="13h">13h</option>
                                        <option value="14h">14h</option>
                                        <option value="15h">15h</option>
                                        <option value="16h">16h</option>
                                        <option value="17h">17h</option>
                                        <option value="18h">18h</option>
                                        <option value="19h">19h</option>
                                        <option value="20h">20h</option>
                                        <option value="21h">21h</option>
                                        <option value="22h">22h</option>
                                        <option value="23h">23h</option>
                                    </optgroup>
                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-from-lbl-closed' ) . "\""; ?> >                                            
                                        <option value="" class="js-opt-closed">--</option>
                                    </optgroup>
                            </select>

                            <select id="f-hours-set-end-min-4" name="opt_hours_regular_set_4_end_m">
                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-from-lbl-minutes' ) . "\""; ?> >
                                        <option disabled selected value="">--</option>
                                        <option value="00">00</option>
                                        <option value="15">15</option>
                                        <option value="30">30</option>
                                        <option value="45">45</option>
                                    </optgroup>
                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-from-lbl-closed' ) . "\""; ?> >                                            
                                        <option value="" class="js-opt-closed">--</option>
                                    </optgroup>
                            </select>
                            </div>

                            <div class="l-check-container m-hours-block m-closed">
                                <input type="checkbox" name="cbx_hours_regular_set_4_closed" id="f-hours-set-closed-4" class="js-hours-closed" value="closed">
                                <label for="f-hours-set-closed-4"><?php echo _( 'cbx_hours_regular_set_4_closed' ); ?></label>
                            </div>

                        </fieldset>
                        </div>




                        <div class="js-fieldset-5 is-hidden m-sub-fieldset-container">
                        <fieldset class="is-relative m-sub-fieldset-inquiry">

                            <div class="m-hours-block m-range js-hours-block">
                                <label for="f-hours-set-5" class="m-hours-label"><?php echo _( 'form-planning-hours-stl-range' ); ?></label>
                                <select id="f-hours-set-5" name="opt_hours_regular_set_5_range">

                                    <option value=""><?php echo _( 'form-planning-hours-range-opt-choose' ); ?></option>

                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-range-lbl-days' ) . "\""; ?> >
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-everyday' ) . "\"";       ?> ><?php echo _( 'form-planning-hours-range-opt-everyday' );       ?></option>
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-weekend' ) . "\"";        ?> ><?php echo _( 'form-planning-hours-range-opt-weekend' );        ?></option>
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-mondayToFriday' ) . "\""; ?> ><?php echo _( 'form-planning-hours-range-opt-mondayToFriday' ); ?></option>
                                    </optgroup>
                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-range-lbl-day' ) . "\""; ?> >
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-mon' ) . "\""; ?> ><?php echo _( 'form-planning-hours-range-opt-mon' ); ?></option>
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-tue' ) . "\""; ?> ><?php echo _( 'form-planning-hours-range-opt-tue' ); ?></option>
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-wed' ) . "\""; ?> ><?php echo _( 'form-planning-hours-range-opt-wed' ); ?></option>
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-thu' ) . "\""; ?> ><?php echo _( 'form-planning-hours-range-opt-thu' ); ?></option>
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-fri' ) . "\""; ?> ><?php echo _( 'form-planning-hours-range-opt-fri' ); ?></option>
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-sat' ) . "\""; ?> ><?php echo _( 'form-planning-hours-range-opt-sat' ); ?></option>
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-sun' ) . "\""; ?> ><?php echo _( 'form-planning-hours-range-opt-sun' ); ?></option>
                                    </optgroup>
                                </select>
                            </div>

                            <div class="m-hours-block m-from">
                            <label for="f-hours-set-start-hour-5" class="m-hours-label"><?php echo _( 'form-planning-hours-stl-from' ); ?></label>
                            <select id="f-hours-set-start-hour-5" name="opt_hours_regular_set_5_start_h">
                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-from-lbl-hours' ) . "\""; ?> >
                                        <option disabled selected value="">--</option>
                                        <option value="00h">00h</option>
                                        <option value="01h">01h</option>
                                        <option value="02h">02h</option>
                                        <option value="03h">03h</option>
                                        <option value="04h">04h</option>
                                        <option value="05h">05h</option>
                                        <option value="06h">06h</option>
                                        <option value="07h">07h</option>
                                        <option value="08h">08h</option>
                                        <option value="09h">09h</option>
                                        <option value="10h">10h</option>
                                        <option value="11h">11h</option>
                                        <option value="12h">12h</option>
                                        <option value="13h">13h</option>
                                        <option value="14h">14h</option>
                                        <option value="15h">15h</option>
                                        <option value="16h">16h</option>
                                        <option value="17h">17h</option>
                                        <option value="18h">18h</option>
                                        <option value="19h">19h</option>
                                        <option value="20h">20h</option>
                                        <option value="21h">21h</option>
                                        <option value="22h">22h</option>
                                        <option value="23h">23h</option>
                                    </optgroup>
                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-from-lbl-closed' ) . "\""; ?> >                                            
                                        <option value="" class="js-opt-closed">--</option>
                                    </optgroup>
                            </select>

                            <select id="f-hours-set-start-min-5" name="opt_hours_regular_set_5_start_m">
                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-from-lbl-minutes' ) . "\""; ?> >
                                        <option disabled selected value="">--</option>
                                        <option value="00">00</option>
                                        <option value="15">15</option>
                                        <option value="30">30</option>
                                        <option value="45">45</option>
                                    </optgroup>
                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-from-lbl-closed' ) . "\""; ?> >                                            
                                        <option value="" class="js-opt-closed">--</option>
                                    </optgroup>
                            </select>
                            <span class="m-hours-dash">-</span>
                            </div>


                            <div class="m-hours-block m-to">
                            <label for="f-hours-set-end-hour-5" class="m-hours-label"><?php echo _( 'form-planning-hours-stl-to' ); ?></label>
                            <select id="f-hours-set-end-hour-5" name="opt_hours_regular_set_5_end_h">
                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-from-lbl-hours' ) . "\""; ?> >
                                        <option disabled selected value="">--</option>
                                        <option value="00h">00h</option>
                                        <option value="01h">01h</option>
                                        <option value="02h">02h</option>
                                        <option value="03h">03h</option>
                                        <option value="04h">04h</option>
                                        <option value="05h">05h</option>
                                        <option value="06h">06h</option>
                                        <option value="07h">07h</option>
                                        <option value="08h">08h</option>
                                        <option value="09h">09h</option>
                                        <option value="10h">10h</option>
                                        <option value="11h">11h</option>
                                        <option value="12h">12h</option>
                                        <option value="13h">13h</option>
                                        <option value="14h">14h</option>
                                        <option value="15h">15h</option>
                                        <option value="16h">16h</option>
                                        <option value="17h">17h</option>
                                        <option value="18h">18h</option>
                                        <option value="19h">19h</option>
                                        <option value="20h">20h</option>
                                        <option value="21h">21h</option>
                                        <option value="22h">22h</option>
                                        <option value="23h">23h</option>
                                    </optgroup>
                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-from-lbl-closed' ) . "\""; ?> >                                            
                                        <option value="" class="js-opt-closed">--</option>
                                    </optgroup>
                            </select>

                            <select id="f-hours-set-end-min-5" name="opt_hours_regular_set_5_end_m">
                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-from-lbl-minutes' ) . "\""; ?> >
                                        <option disabled selected value="">--</option>
                                        <option value="00">00</option>
                                        <option value="15">15</option>
                                        <option value="30">30</option>
                                        <option value="45">45</option>
                                    </optgroup>
                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-from-lbl-closed' ) . "\""; ?> >                                            
                                        <option value="" class="js-opt-closed">--</option>
                                    </optgroup>
                            </select>
                            </div>

                            <div class="l-check-container m-hours-block m-closed">
                                <input type="checkbox" name="cbx_hours_regular_set_5_closed" id="f-hours-set-closed-5" class="js-hours-closed" value="closed">
                                <label for="f-hours-set-closed-5"><?php echo _( 'cbx_hours_regular_set_5_closed' ); ?></label>
                            </div>

                        </fieldset>
                        </div>




                        <div class="js-fieldset-6 is-hidden m-sub-fieldset-container">
                        <fieldset class="is-relative m-sub-fieldset-inquiry">

                            <div class="m-hours-block m-range js-hours-block">
                                <label for="f-hours-set-6" class="m-hours-label"><?php echo _( 'form-planning-hours-stl-range' ); ?></label>
                                <select id="f-hours-set-6" name="opt_hours_regular_set_6_range">

                                    <option value=""><?php echo _( 'form-planning-hours-range-opt-choose' ); ?></option>

                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-range-lbl-days' ) . "\""; ?> >
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-everyday' ) . "\"";       ?> ><?php echo _( 'form-planning-hours-range-opt-everyday' );       ?></option>
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-weekend' ) . "\"";        ?> ><?php echo _( 'form-planning-hours-range-opt-weekend' );        ?></option>
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-mondayToFriday' ) . "\""; ?> ><?php echo _( 'form-planning-hours-range-opt-mondayToFriday' ); ?></option>
                                    </optgroup>
                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-range-lbl-day' ) . "\""; ?> >
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-mon' ) . "\""; ?> ><?php echo _( 'form-planning-hours-range-opt-mon' ); ?></option>
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-tue' ) . "\""; ?> ><?php echo _( 'form-planning-hours-range-opt-tue' ); ?></option>
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-wed' ) . "\""; ?> ><?php echo _( 'form-planning-hours-range-opt-wed' ); ?></option>
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-thu' ) . "\""; ?> ><?php echo _( 'form-planning-hours-range-opt-thu' ); ?></option>
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-fri' ) . "\""; ?> ><?php echo _( 'form-planning-hours-range-opt-fri' ); ?></option>
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-sat' ) . "\""; ?> ><?php echo _( 'form-planning-hours-range-opt-sat' ); ?></option>
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-sun' ) . "\""; ?> ><?php echo _( 'form-planning-hours-range-opt-sun' ); ?></option>
                                    </optgroup>
                                </select>
                            </div>

                            <div class="m-hours-block m-from">
                            <label for="f-hours-set-start-hour-6" class="m-hours-label"><?php echo _( 'form-planning-hours-stl-from' ); ?></label>
                            <select id="f-hours-set-start-hour-6" name="opt_hours_regular_set_6_start_h">
                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-from-lbl-hours' ) . "\""; ?> >
                                        <option disabled selected value="">--</option>
                                        <option value="00h">00h</option>
                                        <option value="01h">01h</option>
                                        <option value="02h">02h</option>
                                        <option value="03h">03h</option>
                                        <option value="04h">04h</option>
                                        <option value="05h">05h</option>
                                        <option value="06h">06h</option>
                                        <option value="07h">07h</option>
                                        <option value="08h">08h</option>
                                        <option value="09h">09h</option>
                                        <option value="10h">10h</option>
                                        <option value="11h">11h</option>
                                        <option value="12h">12h</option>
                                        <option value="13h">13h</option>
                                        <option value="14h">14h</option>
                                        <option value="15h">15h</option>
                                        <option value="16h">16h</option>
                                        <option value="17h">17h</option>
                                        <option value="18h">18h</option>
                                        <option value="19h">19h</option>
                                        <option value="20h">20h</option>
                                        <option value="21h">21h</option>
                                        <option value="22h">22h</option>
                                        <option value="23h">23h</option>
                                    </optgroup>
                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-from-lbl-closed' ) . "\""; ?> >                                            
                                        <option value="" class="js-opt-closed">--</option>
                                    </optgroup>
                            </select>

                            <select id="f-hours-set-start-min-6" name="opt_hours_regular_set_6_start_m">
                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-from-lbl-minutes' ) . "\""; ?> >
                                        <option disabled selected value="">--</option>
                                        <option value="00">00</option>
                                        <option value="15">15</option>
                                        <option value="30">30</option>
                                        <option value="45">45</option>
                                    </optgroup>
                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-from-lbl-closed' ) . "\""; ?> >                                            
                                        <option value="" class="js-opt-closed">--</option>
                                    </optgroup>
                            </select>
                            <span class="m-hours-dash">-</span>
                            </div>


                            <div class="m-hours-block m-to">
                            <label for="f-hours-set-end-hour-6" class="m-hours-label"><?php echo _( 'form-planning-hours-stl-to' ); ?></label>
                            <select id="f-hours-set-end-hour-6" name="opt_hours_regular_set_6_end_h">
                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-from-lbl-hours' ) . "\""; ?> >
                                        <option disabled selected value="">--</option>
                                        <option value="00h">00h</option>
                                        <option value="01h">01h</option>
                                        <option value="02h">02h</option>
                                        <option value="03h">03h</option>
                                        <option value="04h">04h</option>
                                        <option value="05h">05h</option>
                                        <option value="06h">06h</option>
                                        <option value="07h">07h</option>
                                        <option value="08h">08h</option>
                                        <option value="09h">09h</option>
                                        <option value="10h">10h</option>
                                        <option value="11h">11h</option>
                                        <option value="12h">12h</option>
                                        <option value="13h">13h</option>
                                        <option value="14h">14h</option>
                                        <option value="15h">15h</option>
                                        <option value="16h">16h</option>
                                        <option value="17h">17h</option>
                                        <option value="18h">18h</option>
                                        <option value="19h">19h</option>
                                        <option value="20h">20h</option>
                                        <option value="21h">21h</option>
                                        <option value="22h">22h</option>
                                        <option value="23h">23h</option>
                                    </optgroup>
                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-from-lbl-closed' ) . "\""; ?> >                                            
                                        <option value="" class="js-opt-closed">--</option>
                                    </optgroup>
                            </select>

                            <select id="f-hours-set-end-min-6" name="opt_hours_regular_set_6_end_m">
                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-from-lbl-minutes' ) . "\""; ?> >
                                        <option disabled selected value="">--</option>
                                        <option value="00">00</option>
                                        <option value="15">15</option>
                                        <option value="30">30</option>
                                        <option value="45">45</option>
                                    </optgroup>
                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-from-lbl-closed' ) . "\""; ?> >                                            
                                        <option value="" class="js-opt-closed">--</option>
                                    </optgroup>
                            </select>
                            </div>

                            <div class="l-check-container m-hours-block m-closed">
                                <input type="checkbox" name="cbx_hours_regular_set_6_closed" id="f-hours-set-closed-6" class="js-hours-closed" value="closed">
                                <label for="f-hours-set-closed-6"><?php echo _( 'cbx_hours_regular_set_6_closed' ); ?></label>
                            </div>

                        </fieldset>
                        </div>




                        <div class="js-fieldset-7 is-hidden m-sub-fieldset-container">
                        <fieldset class="is-relative m-sub-fieldset-inquiry">

                            <div class="m-hours-block m-range js-hours-block">
                                <label for="f-hours-set-7" class="m-hours-label"><?php echo _( 'form-planning-hours-stl-range' ); ?></label>
                                <select id="f-hours-set-7" name="opt_hours_regular_set_7_range">

                                    <option value=""><?php echo _( 'form-planning-hours-range-opt-choose' ); ?></option>

                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-range-lbl-days' ) . "\""; ?> >
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-everyday' ) . "\"";       ?> ><?php echo _( 'form-planning-hours-range-opt-everyday' );       ?></option>
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-weekend' ) . "\"";        ?> ><?php echo _( 'form-planning-hours-range-opt-weekend' );        ?></option>
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-mondayToFriday' ) . "\""; ?> ><?php echo _( 'form-planning-hours-range-opt-mondayToFriday' ); ?></option>
                                    </optgroup>
                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-range-lbl-day' ) . "\""; ?> >
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-mon' ) . "\""; ?> ><?php echo _( 'form-planning-hours-range-opt-mon' ); ?></option>
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-tue' ) . "\""; ?> ><?php echo _( 'form-planning-hours-range-opt-tue' ); ?></option>
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-wed' ) . "\""; ?> ><?php echo _( 'form-planning-hours-range-opt-wed' ); ?></option>
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-thu' ) . "\""; ?> ><?php echo _( 'form-planning-hours-range-opt-thu' ); ?></option>
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-fri' ) . "\""; ?> ><?php echo _( 'form-planning-hours-range-opt-fri' ); ?></option>
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-sat' ) . "\""; ?> ><?php echo _( 'form-planning-hours-range-opt-sat' ); ?></option>
                                        <option <?php echo "value=\"" . _( 'form-planning-hours-range-opt-sun' ) . "\""; ?> ><?php echo _( 'form-planning-hours-range-opt-sun' ); ?></option>
                                    </optgroup>
                                </select>
                            </div>

                            <div class="m-hours-block m-from">
                            <label for="f-hours-set-start-hour-7" class="m-hours-label"><?php echo _( 'form-planning-hours-stl-from' ); ?></label>
                            <select id="f-hours-set-start-hour-7" name="opt_hours_regular_set_7_start_h">
                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-from-lbl-hours' ) . "\""; ?> >
                                        <option disabled selected value="">--</option>
                                        <option value="00h">00h</option>
                                        <option value="01h">01h</option>
                                        <option value="02h">02h</option>
                                        <option value="03h">03h</option>
                                        <option value="04h">04h</option>
                                        <option value="05h">05h</option>
                                        <option value="06h">06h</option>
                                        <option value="07h">07h</option>
                                        <option value="08h">08h</option>
                                        <option value="09h">09h</option>
                                        <option value="10h">10h</option>
                                        <option value="11h">11h</option>
                                        <option value="12h">12h</option>
                                        <option value="13h">13h</option>
                                        <option value="14h">14h</option>
                                        <option value="15h">15h</option>
                                        <option value="16h">16h</option>
                                        <option value="17h">17h</option>
                                        <option value="18h">18h</option>
                                        <option value="19h">19h</option>
                                        <option value="20h">20h</option>
                                        <option value="21h">21h</option>
                                        <option value="22h">22h</option>
                                        <option value="23h">23h</option>
                                    </optgroup>
                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-from-lbl-closed' ) . "\""; ?> >                                            
                                        <option value="" class="js-opt-closed">--</option>
                                    </optgroup>
                            </select>

                            <select id="f-hours-set-start-min-7" name="opt_hours_regular_set_7_start_m">
                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-from-lbl-minutes' ) . "\""; ?> >
                                        <option disabled selected value="">--</option>
                                        <option value="00">00</option>
                                        <option value="15">15</option>
                                        <option value="30">30</option>
                                        <option value="45">45</option>
                                    </optgroup>
                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-from-lbl-closed' ) . "\""; ?> >                                            
                                        <option value="" class="js-opt-closed">--</option>
                                    </optgroup>
                            </select>
                            <span class="m-hours-dash">-</span>
                            </div>


                            <div class="m-hours-block m-to">
                            <label for="f-hours-set-end-hour-7" class="m-hours-label"><?php echo _( 'form-planning-hours-stl-to' ); ?></label>
                            <select id="f-hours-set-end-hour-7" name="opt_hours_regular_set_7_end_h">
                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-from-lbl-hours' ) . "\""; ?> >
                                        <option disabled selected value="">--</option>
                                        <option value="00h">00h</option>
                                        <option value="01h">01h</option>
                                        <option value="02h">02h</option>
                                        <option value="03h">03h</option>
                                        <option value="04h">04h</option>
                                        <option value="05h">05h</option>
                                        <option value="06h">06h</option>
                                        <option value="07h">07h</option>
                                        <option value="08h">08h</option>
                                        <option value="09h">09h</option>
                                        <option value="10h">10h</option>
                                        <option value="11h">11h</option>
                                        <option value="12h">12h</option>
                                        <option value="13h">13h</option>
                                        <option value="14h">14h</option>
                                        <option value="15h">15h</option>
                                        <option value="16h">16h</option>
                                        <option value="17h">17h</option>
                                        <option value="18h">18h</option>
                                        <option value="19h">19h</option>
                                        <option value="20h">20h</option>
                                        <option value="21h">21h</option>
                                        <option value="22h">22h</option>
                                        <option value="23h">23h</option>
                                    </optgroup>
                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-from-lbl-closed' ) . "\""; ?> >                                            
                                        <option value="" class="js-opt-closed">--</option>
                                    </optgroup>
                            </select>

                            <select id="f-hours-set-end-min-7" name="opt_hours_regular_set_7_end_m">
                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-from-lbl-minutes' ) . "\""; ?> >
                                        <option disabled selected value="">--</option>
                                        <option value="00">00</option>
                                        <option value="15">15</option>
                                        <option value="30">30</option>
                                        <option value="45">45</option>
                                    </optgroup>
                                    <optgroup <?php echo "label=\"" . _( 'form-planning-hours-from-lbl-closed' ) . "\""; ?> >                                            
                                        <option value="" class="js-opt-closed">--</option>
                                    </optgroup>
                            </select>
                            </div>

                            <div class="l-check-container m-hours-block m-closed">
                                <input type="checkbox" name="cbx_hours_regular_set_7_closed" id="f-hours-set-closed-7" class="js-hours-closed" value="closed">
                                <label for="f-hours-set-closed-7"><?php echo _( 'cbx_hours_regular_set_7_closed' ); ?></label>
                            </div>

                        </fieldset>
                        </div>



                        <div class="m-sub-fieldset-container">
                        <div class="m-button-block">
                            <div class="row">
                                <div class="col-06-btn">
                                    <div class="button js-btn-show is-active"><span class="fa fa-plus fa-lg"></span>&nbsp;&nbsp;<?php echo _( 'form-subFields-btn-add' ); ?></div>
                                </div>
                                <div class="col-06-btn">
                                    <div class="button js-btn-hide is-disabled"><span class="fa fa-times fa-lg"></span>&nbsp;&nbsp;<?php echo _( 'form-subFields-btn-remove' ); ?></div>
                                </div>
                            </div>
                        </div>
                        </div>

                    </div> <!-- m-sub-wrapper END -->
                
                </fieldset>
                </div>

            </div> <!-- l-sub-section th-divider-dark END -->




            <div class="l-sub-section th-divider-dark">

                <div id="f-main-fieldset-holiday" class="js-f-main-fieldset l-main-fieldset">
                <fieldset class="l-hours">
                        <div class="m-inquiry-block">
                            <legend class="m-inquiry-title">
                                <span class="js-toggle-info m-btn-info fa fa-info fa-lg"></span>
                                <span><?php echo _( 'form-content-holiday-ttl' ); ?></span>
                            </legend>

                            <div class="m-block-info">
                                <blockquote class="slide-left">
                                    <p><?php echo _( 'form-content-holiday-info' ); ?></p>
                                </blockquote>
                            </div>
                        </div>

                        <div class="m-inputfield-wrapper">
                            <textarea name="txt_hours_holidays" id="f-hours-holidays" rows="2" maxlength="500"></textarea> 
                        </div>

                </fieldset>
                </div>

            </div> <!-- l-sub-section th-divider-dark END -->




            <div class="l-sub-section th-divider-dark">

                <div id="f-main-fieldset-product" class="js-f-main-fieldset l-main-fieldset">
                <fieldset>
                    <div class="m-inquiry-block">
                        <legend class="m-inquiry-title">
                            <span class="js-toggle-info m-btn-info fa fa-info fa-lg"></span>
                            <span><?php echo _( 'form-content-product-ttl' ); ?></span>
                        </legend>

                        <div class="m-block-info">
                            <blockquote class="slide-left">
                                <p><?php echo _( 'form-content-product-info' ); ?></p>
                            </blockquote>
                        </div>
                    </div>

                    <div class="m-inputfield-wrapper">

                        <div>
                            <div>
                                <input type="text" name="fld_product_1" id="f-product-1" placeholder="1." maxlength="100" />
                            </div>
                        </div>

                        <div>
                            <div>
                                <input type="text" name="fld_product_2" id="f-product-2" placeholder="2." maxlength="100" />
                            </div>
                        </div>

                        <div>
                            <div>
                                <input type="text" name="fld_product_3" id="f-product-3" placeholder="3." maxlength="100" />
                            </div>
                        </div>

                    </div>
                    
                    
                </fieldset>
                </div> <!-- .row END -->

            </div> <!-- l-sub-section th-divider-dark END -->


                

            <div class="l-sub-section th-divider-dark">

                <div id="f-main-fieldset-asset" class="js-f-main-fieldset l-main-fieldset">
                <fieldset>
                    <div class="m-inquiry-block">
                        <legend class="m-inquiry-title">
                            <span class="js-toggle-info m-btn-info fa fa-info fa-lg"></span>
                            <span><?php echo _( 'form-content-asset-ttl' ); ?></span>
                        </legend>

                        <div class="m-block-info">
                            <blockquote class="slide-left">
                                <p><?php echo _( 'form-content-asset-info' ); ?></p>
                            </blockquote>
                        </div>
                    </div>
                    
                    <div class="m-inputfield-wrapper">

                        <div class="l-check-container">
                            <input type="radio" name="rdo_existing_asset" id="f-asset-yes" <?php echo "value=\"" . _( 'rdo_existing_asset-yes' ) . "\""; ?> />
                            <label for="f-asset-yes"><?php echo _( 'rdo_existing_asset-yes' ); ?></label>

                                    <!-- Conditional radio btn selection -->
                                    <fieldset class="js-toggle-area is-hidden l-sub-check m-sub-fieldset-inquiry">
                                        <legend class="m-sub-passive-title"><?php echo _( 'form-content-asset-stl-select' ); ?></legend>
                                        
                                        <div class="l-check-container">
                                            <input type="checkbox" name="cbx_asset_logo" id="f-asset-logo" <?php echo "value=\"" . _( 'cbx_asset_logo' ) . "\""; ?> />
                                            <label for="f-asset-logo"><?php echo _( 'cbx_asset_logo' ); ?></label>
                                        </div>
                                        <div class="l-check-container">
                                            <input type="checkbox" name="cbx_asset_img" id="f-asset-img" <?php echo "value=\"" . _( 'cbx_asset_img' ) . "\""; ?> />
                                            <label for="f-asset-img"><?php echo _( 'cbx_asset_img' ); ?></label>
                                        </div>
                                        <div class="l-check-container">
                                            <input type="checkbox" name="cbx_asset_audio" id="f-asset-audio" <?php echo "value=\"" . _( 'cbx_asset_audio' ) . "\""; ?> />
                                            <label for="f-asset-audio"><?php echo _( 'cbx_asset_audio' ); ?></label>
                                        </div>
                                        <div class="l-check-container">
                                            <input type="checkbox" name="cbx_asset_video" id="f-asset-video" <?php echo "value=\"" . _( 'cbx_asset_video' ) . "\""; ?> />
                                            <label for="f-asset-video"><?php echo _( 'cbx_asset_video' ); ?></label>
                                        </div>
                                        <div class="l-check-container">
                                            <input type="checkbox" name="cbx_asset_docs" id="f-asset-docs" <?php echo "value=\"" . _( 'cbx_asset_docs' ) . "\""; ?> />
                                            <label for="f-asset-docs"><?php echo _( 'cbx_asset_docs' ); ?></label>
                                        </div>
                                        <div class="l-check-container">
                                            <input type="checkbox" name="xxx_asset_otherdetails" id="f-asset-odcheck" class="js-other-details" value="true" />
                                            <label for="f-asset-odcheck"><?php echo _( 'txt_asset_othercomments' ); ?></label>
                                                <!-- Conditional textarea -->
                                                <div class="m-odtext">
                                                    <textarea name="txt_asset_othercomments" id="f-asset-odtext" class="is-hidden" rows="2" maxlength="500"></textarea>
                                                </div>
                                        </div>
                                        
                                    </fieldset>
                                    
                        </div>
                        <div class="l-check-container">
                            <input type="radio" name="rdo_existing_asset" id="f-asset-no" <?php echo "value=\"" . _( 'rdo_existing_asset-no' ) . "\""; ?> />
                            <label for="f-asset-no"><?php echo _( 'rdo_existing_asset-no' ); ?></label>
                        </div>

                    </div>
                    
                </fieldset>
                </div>

            </div> <!-- l-sub-section th-divider-dark END -->




            <div class="l-sub-section th-divider-dark">

                <div id="f-main-fieldset-content" class="js-f-main-fieldset l-main-fieldset">
                    <fieldset>
                        <div class="m-inquiry-block">
                            <legend class="m-inquiry-title">
                                <span class="js-toggle-info m-btn-info fa fa-info fa-lg"></span>
                                <span><?php echo _( 'form-content-content-ttl' ); ?></span>
                            </legend>

                            <div class="m-block-info">
                                <blockquote class="slide-left">
                                    <p><?php echo _( 'form-content-content-info-1' ); ?></p>
                                    <p><?php echo _( 'form-content-content-info-2' ); ?></p>
                                </blockquote>
                            </div>
                        </div>

                        <div class="m-inputfield-wrapper">

                            <div class="l-check-container">
                                <input type="checkbox" name="cbx_content_copywriting" id="f-content-1" <?php echo "value=\"" . _( 'cbx_content_copywriting' ) . "\""; ?> />
                                <label for="f-content-1"><?php echo _( 'cbx_content_copywriting' ); ?></label>
                            </div>
                            <div class="l-check-container">
                                <input type="checkbox" name="cbx_content_graphicdesign" id="f-content-2" <?php echo "value=\"" . _( 'cbx_content_graphicdesign' ) . "\""; ?> />
                                <label for="f-content-2"><?php echo _( 'cbx_content_graphicdesign' ); ?></label>
                            </div>
                            <div class="l-check-container">
                                <input type="checkbox" name="cbx_content_photography" id="f-content-3" <?php echo "value=\"" . _( 'cbx_content_photography' ) . "\""; ?> />
                                <label for="f-content-3"><?php echo _( 'cbx_content_photography' ); ?></label>
                            </div>
                            <div class="l-check-container">
                                <input type="checkbox" name="cbx_content_none" id="f-content-4" <?php echo "value=\"" . _( 'cbx_content_none' ) . "\""; ?> />
                                <label for="f-content-4"><?php echo _( 'cbx_content_none' ); ?></label>
                            </div>
                            <div class="l-check-container">
                                <input type="checkbox" name="xxx_content_otherdetails" id="f-content-odcheck" class="js-other-details" value="true" />
                                <label for="f-content-odcheck"><?php echo _( 'xxx_content_otherdetails' ); ?></label>
                                    <!-- Conditional textarea -->
                                    <div class="m-odtext">
                                        <textarea name="txt_content_othercomments" id="f-content-odtext" class="is-hidden" rows="2" maxlength="500"></textarea>
                                    </div>
                            </div>

                        </div>
                        
                    </fieldset>
                </div>

            </div> <!-- l-sub-section th-divider-dark END -->





            <div class="l-sub-section th-divider-dark">
                
                <div id="f-main-fieldset-feature" class="js-f-main-fieldset l-main-fieldset">
                    <fieldset>
                        <div class="m-inquiry-block">
                            <legend class="m-inquiry-title">
                                <span class="js-toggle-info m-btn-info fa fa-info fa-lg"></span>
                                <span><?php echo _( 'form-content-feature-ttl' ); ?></span>
                            </legend>

                            <div class="m-block-info">
                                <blockquote class="slide-left">
                                    <p><?php echo _( 'form-content-feature-info' ); ?></p>
                                </blockquote>
                            </div>
                        </div>


                        <div class="m-inputfield-wrapper">
                            <p><?php echo _( 'form-content-feature-par-instruction' ); ?></p>
                            
                            <div class="row row-fix">
                            <div class="col-pad-06">
                                <div class="l-check-container">
                                    <input type="checkbox" name="cbx_feature_forum" id="f-feat-forum" class="js-other-details" <?php echo "value=\"" . _( 'cbx_feature_forum' ) . "\""; ?> />
                                    <label for="f-feat-forum"><?php echo _( 'cbx_feature_forum' ); ?></label>
                                        <!-- Conditional textarea -->
                                        <div class="m-odtext">
                                            <textarea name="txt_feature_forum" id="f-feat-forum-odtext" class="is-hidden" rows="2" maxlength="500"></textarea>
                                        </div>
                                </div>
                                <div class="l-check-container">
                                    <input type="checkbox" name="cbx_feature_login" id="f-feat-login" class="js-other-details" <?php echo "value=\"" . _( 'cbx_feature_login' ) . "\""; ?> />
                                    <label for="f-feat-login"><?php echo _( 'cbx_feature_login' ); ?></label>
                                        <!-- Conditional textarea -->
                                        <div class="m-odtext">
                                            <textarea name="txt_feature_login" id="f-feat-login-odtext" class="is-hidden" rows="2" maxlength="500"></textarea>
                                        </div>
                                </div>

                                <div class="l-check-container">
                                    <input type="checkbox" name="cbx_feature_chart" id="f-feat-chart" class="js-other-details" <?php echo "value=\"" . _( 'cbx_feature_chart' ) . "\""; ?> />
                                    <label for="f-feat-chart"><?php echo _( 'cbx_feature_chart' ); ?></label>
                                        <!-- Conditional textarea -->
                                        <div class="m-odtext">
                                            <textarea name="txt_feature_chart" id="f-feat-chart-odtext" class="is-hidden" rows="2" maxlength="500"></textarea>
                                        </div>
                                </div>
                                <div class="l-check-container">
                                    <input type="checkbox" name="cbx_feature_catalog" id="f-feat-catalog" class="js-other-details" <?php echo "value=\"" . _( 'cbx_feature_catalog' ) . "\""; ?> />
                                    <label for="f-feat-catalog"><?php echo _( 'cbx_feature_catalog' ); ?></label>
                                        <!-- Conditional textarea -->
                                        <div class="m-odtext">
                                            <textarea name="txt_feature_catalog" id="f-feat-catalog-odtext" class="is-hidden" rows="2" maxlength="500"></textarea>
                                        </div>
                                </div>
                                <div class="l-check-container">
                                    <input type="checkbox" name="cbx_feature_comparechart" id="f-feat-comparechart" class="js-other-details" <?php echo "value=\"" . _( 'cbx_feature_comparechart' ) . "\""; ?> />
                                    <label for="f-feat-comparechart"><?php echo _( 'cbx_feature_comparechart' ); ?></label>
                                        <!-- Conditional textarea -->
                                        <div class="m-odtext">
                                            <textarea name="txt_feature_comparechart" id="f-feat-comparechart-odtext" class="is-hidden" rows="2" maxlength="500"></textarea>
                                        </div>
                                </div>
                                <div class="l-check-container">
                                    <input type="checkbox" name="cbx_feature_form" id="f-feat-form" class="js-other-details" <?php echo "value=\"" . _( 'cbx_feature_form' ) . "\""; ?> />
                                    <label for="f-feat-form"><?php echo _( 'cbx_feature_form' ); ?></label>
                                        <!-- Conditional textarea -->
                                        <div class="m-odtext">
                                            <textarea name="txt_feature_form" id="f-feat-form-odtext" class="is-hidden" rows="2" maxlength="500"></textarea>
                                        </div>
                                </div>
                                <div class="l-check-container">
                                    <input type="checkbox" name="cbx_feature_advancedform" id="f-feat-advancedform" class="js-other-details" <?php echo "value=\"" . _( 'cbx_feature_advancedform' ) . "\""; ?> />
                                    <label for="f-feat-advancedform"><?php echo _( 'cbx_feature_advancedform' ); ?></label>
                                        <!-- Conditional textarea -->
                                        <div class="m-odtext">
                                            <textarea name="txt_feature_advancedform" id="f-feat-advancedform-odtext" class="is-hidden" rows="2" maxlength="500"></textarea>
                                        </div>
                                </div>
                                <div class="l-check-container">
                                    <input type="checkbox" name="cbx_feature_animation" id="f-feat-animation" class="js-other-details" <?php echo "value=\"" . _( 'cbx_feature_animation' ) . "\""; ?> />
                                    <label for="f-feat-animation"><?php echo _( 'cbx_feature_animation' ); ?></label>
                                        <!-- Conditional textarea -->
                                        <div class="m-odtext">
                                            <textarea name="txt_feature_animation" id="f-feat-animation-odtext" class="is-hidden" rows="2" maxlength="500"></textarea>
                                        </div>
                                </div>
                            </div>


                            <div class="col-pad-06">
                                <div class="l-check-container">
                                    <input type="checkbox" name="cbx_feature_search" id="f-feat-search" class="js-other-details" <?php echo "value=\"" . _( 'cbx_feature_search' ) . "\""; ?> />
                                    <label for="f-feat-search"><?php echo _( 'cbx_feature_search' ); ?></label>
                                        <!-- Conditional textarea -->
                                        <div class="m-odtext">
                                            <textarea name="txt_feature_search" id="f-feat-search-odtext" class="is-hidden" rows="2" maxlength="500"></textarea>
                                        </div>
                                </div>
                                <div class="l-check-container">
                                    <input type="checkbox" name="cbx_feature_advancedsearch" id="f-feat-advancedsearch" class="js-other-details" <?php echo "value=\"" . _( 'cbx_feature_advancedsearch' ) . "\""; ?> />
                                    <label for="f-feat-search"><?php echo _( 'cbx_feature_advancedsearch' ); ?></label>
                                        <!-- Conditional textarea -->
                                        <div class="m-odtext">
                                            <textarea name="txt_feature_advancedsearch" id="f-feat-advancedsearch-odtext" class="is-hidden" rows="2" maxlength="500"></textarea>
                                        </div>
                                </div>
                                <div class="l-check-container">
                                    <input type="checkbox" name="cbx_feature_social" id="f-feat-social" class="js-other-details" <?php echo "value=\"" . _( 'cbx_feature_social' ) . "\""; ?> />
                                    <label for="f-feat-social"><?php echo _( 'cbx_feature_social' ); ?></label>
                                        <!-- Conditional textarea -->
                                        <div class="m-odtext">
                                            <textarea name="txt_feature_social" id="f-feat-social-odtext" class="is-hidden" rows="2" maxlength="500"></textarea>
                                        </div>
                                </div>
                                <div class="l-check-container">
                                    <input type="checkbox" name="cbx_feature_blog" id="f-feat-blog" class="js-other-details" <?php echo "value=\"" . _( 'cbx_feature_blog' ) . "\""; ?> />
                                    <label for="f-feat-blog"><?php echo _( 'cbx_feature_blog' ); ?></label>
                                        <!-- Conditional textarea -->
                                        <div class="m-odtext">
                                            <textarea name="txt_feature_blog" id="f-feat-blog-odtext" class="is-hidden" rows="2" maxlength="500"></textarea>
                                        </div>
                                </div>

                                <div class="l-check-container">
                                    <input type="checkbox" name="cbx_feature_timeline" id="f-feat-timeline" class="js-other-details" <?php echo "value=\"" . _( 'cbx_feature_timeline' ) . "\""; ?> />
                                    <label for="f-feat-timeline"><?php echo _( 'cbx_feature_timeline' ); ?></label>
                                        <!-- Conditional textarea -->
                                        <div class="m-odtext">
                                            <textarea name="txt_feature_timeline" id="f-feat-timeline-odtext" class="is-hidden" rows="2" maxlength="500"></textarea>
                                        </div>
                                </div>
                                <div class="l-check-container">
                                    <input type="checkbox" name="cbx_feature_newsletter" id="f-feat-newsletter" class="js-other-details" <?php echo "value=\"" . _( 'cbx_feature_newsletter' ) . "\""; ?> />
                                    <label for="f-feat-newsletter"><?php echo _( 'cbx_feature_newsletter' ); ?></label>
                                        <!-- Conditional textarea -->
                                        <div class="m-odtext">
                                            <textarea name="txt_feature_newsletter" id="f-feat-newsletter-odtext" class="is-hidden" rows="2" maxlength="500"></textarea>
                                        </div>
                                </div>
                                <div class="l-check-container">
                                    <input type="checkbox" name="cbx_feature_calculator" id="f-feat-calculator" class="js-other-details" <?php echo "value=\"" . _( 'cbx_feature_calculator' ) . "\""; ?> />
                                    <label for="f-feat-calculator"><?php echo _( 'cbx_feature_calculator' ); ?></label>
                                        <!-- Conditional textarea -->
                                        <div class="m-odtext">
                                            <textarea name="txt_feature_calculator" id="f-feat-calculator-odtext" class="is-hidden" rows="2" maxlength="500"></textarea>
                                        </div>
                                </div>
                                <div class="l-check-container">
                                    <input type="checkbox" name="cbx_feature_otherdetails" id="f-feat-odcheck" class="js-other-details" <?php echo "value=\"" . _( 'cbx_feature_otherdetails' ) . "\""; ?> />
                                    <label for="f-feat-odcheck"><?php echo _( 'cbx_feature_otherdetails' ); ?></label>
                                        <!-- Conditional textarea -->
                                        <div class="m-odtext">
                                            <textarea name="txt_feature_otherdetails" id="f-feat-odtext" class="is-hidden" rows="2" maxlength="500"></textarea>
                                        </div>
                                </div>
                            </div>
                            </div>


                        </div>
                        
                    </fieldset>
                </div>

            </div> <!-- l-sub-section th-divider-dark END -->




            </section>




















            <section id="f-section-design" class="f-section-design th-divider">

                <div class="l-wrapper">
                    <h3><?php echo _( 'form-design-ttl' ); ?></h3>
                </div>
















            <div class="l-sub-section-wrapper">

            <div class="l-sub-section th-divider-dark">

                <div id="f-main-fieldset-goal" class="js-f-main-fieldset l-main-fieldset">
                    <fieldset>
                        <div class="m-inquiry-block">
                            <legend class="m-inquiry-title">
                                <span class="js-toggle-info m-btn-info fa fa-info fa-lg"></span>
                                <span><?php echo _( 'form-design-siteGoal-ttl' ); ?></span>
                            </legend>

                            <div class="m-block-info">
                                <blockquote class="slide-left">
                                    <p><?php echo _( 'form-design-siteGoal-info' ); ?></p>
                                </blockquote>
                            </div>
                        </div>

                        <div class="m-inputfield-wrapper">

                            <div class="l-check-container">
                                <input type="checkbox" name="xxx_site_goal_1" id="f-goal-1" class="js-other-details" value="true" />
                                <label for="f-goal-1"><?php echo _( 'txt_site_goal_1' ); ?></label>
                                    <!-- Conditional textarea -->
                                <div class="m-odtext">
                                        <textarea name="txt_site_goal_1" id="f-goal-1-odtext" class="is-hidden" rows="2" maxlength="500"></textarea>
                                </div>
                            </div>

                            <div class="l-check-container">
                                <input type="checkbox" name="xxx_site_goal_2" id="f-goal-2" class="js-other-details" value="true" />
                                <label for="f-goal-2"><?php echo _( 'txt_site_goal_2' ); ?></label>
                                    <!-- Conditional textarea -->
                                <div class="m-odtext">
                                        <textarea name="txt_site_goal_2" id="f-goal-2-odtext" class="is-hidden" rows="2" maxlength="500"></textarea>
                                </div>
                            </div>

                            <div class="l-check-container">
                                <input type="checkbox" name="xxx_site_goal_3" id="f-goal-3" class="js-other-details" value="true" />
                                <label for="f-goal-3"><?php echo _( 'txt_site_goal_3' ); ?></label>
                                    <!-- Conditional textarea -->
                                <div class="m-odtext">
                                        <textarea name="txt_site_goal_3" id="f-goal-3-odtext" class="is-hidden" rows="2" maxlength="500"></textarea>
                                </div>
                            </div>

                            <div class="l-check-container">
                                <input type="checkbox" name="xxx_site_goal_4" id="f-goal-4" class="js-other-details" value="true" />
                                <label for="f-goal-4"><?php echo _( 'txt_site_goal_4' ); ?></label>
                                    <!-- Conditional textarea -->
                                <div class="m-odtext">
                                        <textarea name="txt_site_goal_4" id="f-goal-4-odtext" class="is-hidden" rows="2" maxlength="500"></textarea>
                                </div>
                            </div>

                        </div>
                        
                    </fieldset>
                </div>

            </div> <!-- l-sub-section th-divider-dark END -->




            <div class="l-sub-section th-divider-dark">

                <div id="f-main-fieldset-action" class="js-f-main-fieldset l-main-fieldset">
                    <fieldset>
                        <div class="m-inquiry-block">
                            <legend class="m-inquiry-title">
                                <span class="js-toggle-info m-btn-info fa fa-info fa-lg"></span>
                                <span><?php echo _( 'form-design-action-ttl' ); ?></span>
                            </legend>

                            <div class="m-block-info">
                                <blockquote class="slide-left">
                                    <p><?php echo _( 'form-design-action-info' ); ?></p>
                                </blockquote>
                            </div>
                        </div>

                        <div class="m-inputfield-wrapper">

                            <p><?php echo _( 'form-design-action-pra-apply' ); ?></p>

                            
                            <div class="row row-fix">
                            <div class="col-06 l-check-container">
                                <input type="checkbox" name="cbx_action_call" id="f-action-call" <?php echo "value=\"" . _( 'cbx_action_call' ) . "\""; ?> />
                                <label for="f-action-call"><?php echo _( 'cbx_action_call' ); ?></label>
                            </div>
                            <div class="col-06 l-check-container">
                                <input type="checkbox" name="cbx_action_mail" id="f-action-mail" <?php echo "value=\"" . _( 'cbx_action_mail' ) . "\""; ?> />
                                <label for="f-action-mail"><?php echo _( 'cbx_action_mail' ); ?></label>
                            </div>
                            <div class="col-06 l-check-container">
                                <input type="checkbox" name="cbx_action_fillform" id="f-action-form" <?php echo "value=\"" . _( 'cbx_action_fillform' ) . "\""; ?> />
                                <label for="f-action-form"><?php echo _( 'cbx_action_fillform' ); ?></label>
                            </div>
                            <div class="col-06 l-check-container">
                                <input type="checkbox" name="cbx_action_socialshare" id="f-action-share" <?php echo "value=\"" . _( 'cbx_action_socialshare' ) . "\""; ?> />
                                <label for="f-action-share"><?php echo _( 'cbx_action_socialshare' ); ?></label>
                            </div>
                            <div class="col-06 l-check-container">
                                <input type="checkbox" name="cbx_action_subscribeemail" id="f-action-list" <?php echo "value=\"" . _( 'cbx_action_subscribeemail' ) . "\""; ?> />
                                <label for="f-action-list"><?php echo _( 'cbx_action_subscribeemail' ); ?></label>
                            </div>
                            <div class="col-06 l-check-container">
                                <input type="checkbox" name="cbx_action_article" id="f-action-article" <?php echo "value=\"" . _( 'cbx_action_article' ) . "\""; ?> />
                                <label for="f-action-article"><?php echo _( 'cbx_action_article' ); ?></label>
                            </div>
                            <div class="col-06 l-check-container">
                                <input type="checkbox" name="cbx_action_searchinfo" id="f-action-search" <?php echo "value=\"" . _( 'cbx_action_searchinfo' ) . "\""; ?> />
                                <label for="f-action-search"><?php echo _( 'cbx_action_searchinfo' ); ?></label>
                            </div>
                            <div class="col-06 l-check-container">
                                <input type="checkbox" name="cbx_action_purchase" id="f-action-purchase" <?php echo "value=\"" . _( 'cbx_action_purchase' ) . "\""; ?> />
                                <label for="f-action-purchase"><?php echo _( 'cbx_action_purchase' ); ?></label>
                            </div>
                            <div class="col-12 l-check-container">
                                <input type="checkbox" name="xxx_action_otherdetails" id="f-action-odcheck" class="js-other-details" value="true" />
                                <label for="f-action-odcheck"><?php echo _( 'txt_action_othercomments' ); ?></label>
                                    <!-- Conditional textarea -->
                                    <div class="m-odtext">
                                        <textarea name="txt_action_othercomments" id="f-action-odtext" class="is-hidden" rows="2" maxlength="500"></textarea>
                                    </div>

                            </div>
                            </div> <!-- .row END -->

                        </div>
                        
                    </fieldset>
                </div>

            </div> <!-- l-sub-section th-divider-dark END -->





            <div class="l-sub-section th-divider-dark">
                
                <div id="f-main-fieldset-adjective" class="js-f-main-fieldset l-main-fieldset">
                    <fieldset>
                        <div class="m-inquiry-block">
                            <legend class="m-inquiry-title">
                                <span class="js-toggle-info m-btn-info fa fa-info fa-lg"></span>
                                <span><?php echo _( 'form-design-adjective-ttl' ); ?></span>
                            </legend>

                            <div class="m-block-info">
                                <blockquote class="slide-left">
                                    <p><?php echo _( 'form-design-adjective-info' ); ?></p>
                                </blockquote>
                            </div>
                        </div>

                        <div class="m-inputfield-wrapper">

                            <div>
                                <input type="text" name="fld_adjective_1" id="f-adjective-1" placeholder="1." maxlength="100" />
                            </div>
                            <div>
                                <input type="text" name="fld_adjective_2" id="f-adjective-2" placeholder="2." maxlength="100" />
                            </div>
                            <div>
                                <input type="text" name="fld_adjective_3" id="f-adjective-3" placeholder="3." maxlength="100" />
                            </div>

                        </div>

                    </fieldset>
                </div>

            </div> <!-- l-sub-section th-divider-dark END -->





            <div class="l-sub-section th-divider-dark">

                <div id="f-main-fieldset-target" class="js-f-main-fieldset l-main-fieldset">
                    <fieldset>
                        <div class="m-inquiry-block">
                            <legend class="m-inquiry-title">
                                <span class="js-toggle-info m-btn-info fa fa-info fa-lg"></span>
                                <span><?php echo _( 'form-design-target-ttl' ); ?></span>
                            </legend>

                            <div class="m-block-info">
                                <blockquote class="slide-left">
                                    <p><?php echo _( 'form-design-target-info' ); ?></p>
                                </blockquote>
                            </div>
                        </div>

                        <div class="m-sub-wrapper">
                        <div class="row">
                            <div class="col-pad-06">
                            <div class="m-sub-fieldset-container">
                                <fieldset class="m-sub-fieldset-inquiry">
                                    <legend class="m-sub-inquiry-title"><?php echo _( 'form-design-target-stl-age' ); ?></legend>
                                    
                                    <div class="l-check-container">
                                        <input type="checkbox" name="cbx_audience_age_kids" id="f-age-kids" <?php echo "value=\"" . _( 'cbx_audience_age_kids' ) . "\""; ?> />
                                        <label for="f-age-kids"><?php echo _( 'cbx_audience_age_kids' ); ?></label>
                                    </div>
                                    <div class="l-check-container">
                                        <input type="checkbox" name="cbx_audience_age_teen" id="f-age-teen" <?php echo "value=\"" . _( 'cbx_audience_age_teen' ) . "\""; ?> />
                                        <label for="f-age-teen"><?php echo _( 'cbx_audience_age_teen' ); ?></label>
                                    </div>
                                    <div class="l-check-container">
                                        <input type="checkbox" name="cbx_audience_age_young" id="f-age-young" <?php echo "value=\"" . _( 'cbx_audience_age_young' ) . "\""; ?> />
                                        <label for="f-age-young"><?php echo _( 'cbx_audience_age_young' ); ?></label>
                                    </div>
                                    <div class="l-check-container">
                                        <input type="checkbox" name="cbx_audience_age_adult" id="f-age-adult" <?php echo "value=\"" . _( 'cbx_audience_age_adult' ) . "\""; ?> />
                                        <label for="f-age-adult"><?php echo _( 'cbx_audience_age_adult' ); ?></label>
                                    </div>
                                    <div class="l-check-container">
                                        <input type="checkbox" name="cbx_audience_age_senior" id="f-age-senior" <?php echo "value=\"" . _( 'cbx_audience_age_senior' ) . "\""; ?> />
                                        <label for="f-age-senior"><?php echo _( 'cbx_audience_age_senior' ); ?></label>
                                    </div>
                                
                                </fieldset>
                            </div>
                            </div>


                            <div class="col-pad-06">
                            <div class="m-sub-fieldset-container">
                                <fieldset class="m-sub-fieldset-inquiry">
                                    <legend class="m-sub-inquiry-title"><?php echo _( 'form-design-target-stl-geographic' ); ?></legend>
                                    
                                    <div class="l-check-container">
                                        <input type="checkbox" name="cbx_audience_geo_local" id="f-geo-local" <?php echo "value=\"" . _( 'cbx_audience_geo_local' ) . "\""; ?> />
                                        <label for="f-geo-local"><?php echo _( 'cbx_audience_geo_local' ); ?></label>
                                    </div>
                                    <div class="l-check-container">
                                        <input type="checkbox" name="cbx_audience_geo_city" id="f-geo-city" <?php echo "value=\"" . _( 'cbx_audience_geo_city' ) . "\""; ?> />
                                        <label for="f-geo-city"><?php echo _( 'cbx_audience_geo_city' ); ?></label>
                                    </div>
                                    <div class="l-check-container">
                                        <input type="checkbox" name="cbx_audience_geo_province" id="f-geo-province" <?php echo "value=\"" . _( 'cbx_audience_geo_province' ) . "\""; ?> />
                                        <label for="f-geo-province"><?php echo _( 'cbx_audience_geo_province' ); ?></label>
                                    </div>
                                    <div class="l-check-container">
                                        <input type="checkbox" name="cbx_audience_geo_country" id="f-geo-country" <?php echo "value=\"" . _( 'cbx_audience_geo_country' ) . "\""; ?> />
                                        <label for="f-geo-country"><?php echo _( 'cbx_audience_geo_country' ); ?></label>
                                    </div>
                                    <div class="l-check-container">
                                        <input type="checkbox" name="cbx_audience_geo_world" id="f-geo-world" <?php echo "value=\"" . _( 'cbx_audience_geo_world' ) . "\""; ?> />
                                        <label for="f-geo-world"><?php echo _( 'cbx_audience_geo_world' ); ?></label>
                                    </div>
                                
                                </fieldset>                 
                            </div>
                            </div>

                            </div>
                            <div class="row">


                            <div class="col-pad-06">
                            <div class="m-sub-fieldset-container">
                                <fieldset class="m-sub-fieldset-inquiry">
                                    <legend class="m-sub-inquiry-title"><?php echo _( 'form-design-target-stl-education' ); ?></legend>
                                    
                                    <div class="l-check-container">
                                        <input type="checkbox" name="cbx_audience_education_hschool" id="f-education-hschool" <?php echo "value=\"" . _( 'cbx_audience_education_hschool' ) . "\""; ?> />
                                        <label for="f-education-hschool"><?php echo _( 'cbx_audience_education_hschool' ); ?></label>
                                    </div>
                                    <div class="l-check-container">
                                        <input type="checkbox" name="cbx_audience_education_college" id="f-education-college" <?php echo "value=\"" . _( 'cbx_audience_education_college' ) . "\""; ?> />
                                        <label for="f-education-college"><?php echo _( 'cbx_audience_education_college' ); ?></label>
                                    </div>
                                    <div class="l-check-container">
                                        <input type="checkbox" name="cbx_audience_education_undergrad" id="f-education-undergrad" <?php echo "value=\"" . _( 'cbx_audience_education_undergrad' ) . "\""; ?> />
                                        <label for="f-education-undergrad"><?php echo _( 'cbx_audience_education_undergrad' ); ?></label>
                                    </div>
                                    <div class="l-check-container">
                                        <input type="checkbox" name="cbx_audience_education_grad" id="f-education-grad" <?php echo "value=\"" . _( 'cbx_audience_education_grad' ) . "\""; ?> />
                                        <label for="f-education-grad"><?php echo _( 'cbx_audience_education_grad' ); ?></label>
                                    </div>
                                    <div class="l-check-container">
                                        <input type="checkbox" name="cbx_audience_education_none" id="f-education-none" <?php echo "value=\"" . _( 'cbx_audience_education_none' ) . "\""; ?> />
                                        <label for="f-education-none"><?php echo _( 'cbx_audience_education_none' ); ?></label>
                                    </div>
                                
                                </fieldset>
                            </div>
                            </div>


                            <div class="col-pad-06">
                            <div class="m-sub-fieldset-container">
                                <fieldset class="m-sub-fieldset-inquiry">
                                    <legend class="m-sub-inquiry-title"><?php echo _( 'form-design-target-stl-job' ); ?></legend>
                                    
                                    <div class="l-check-container">
                                        <input type="checkbox" name="cbx_audience_job_salaried" id="f-job-salaried" <?php echo "value=\"" . _( 'cbx_audience_job_salaried' ) . "\""; ?> />
                                        <label for="f-job-salaried"><?php echo _( 'cbx_audience_job_salaried' ); ?></label>
                                    </div>
                                    <div class="l-check-container">
                                        <input type="checkbox" name="cbx_audience_job_self" id="f-job-self" <?php echo "value=\"" . _( 'cbx_audience_job_self' ) . "\""; ?> />
                                        <label for="f-job-self"><?php echo _( 'cbx_audience_job_self' ); ?></label>
                                    </div>
                                    <div class="l-check-container">
                                        <input type="checkbox" name="cbx_audience_job_professional" id="f-job-professional" <?php echo "value=\"" . _( 'cbx_audience_job_professional' ) . "\""; ?> />
                                        <label for="f-job-professional"><?php echo _( 'cbx_audience_job_professional' ); ?></label>
                                    </div>
                                    <div class="l-check-container">
                                        <input type="checkbox" name="cbx_audience_job_entrepreneur" id="f-job-entrepreneur" <?php echo "value=\"" . _( 'cbx_audience_job_entrepreneur' ) . "\""; ?> />
                                        <label for="f-job-entrepreneur"><?php echo _( 'cbx_audience_job_entrepreneur' ); ?></label>
                                    </div>
                                    <div class="l-check-container">
                                        <input type="checkbox" name="cbx_audience_job_unemployed" id="f-job-unemployed" <?php echo "value=\"" . _( 'cbx_audience_job_unemployed' ) . "\""; ?> />
                                        <label for="f-job-unemployed"><?php echo _( 'cbx_audience_job_unemployed' ); ?></label>
                                    </div>
                                
                                </fieldset> 
                            </div>

                            </div>
                            </div>
                            <div class="row">


                            <div class="col-pad-06">
                            <div class="m-sub-fieldset-container">
                                <fieldset class="m-sub-fieldset-inquiry">
                                    <legend class="m-sub-inquiry-title"><?php echo _( 'form-design-target-stl-wealth' ); ?></legend>
                                    
                                    <div class="l-check-container">
                                        <input type="checkbox" name="cbx_audience_wealth_below" id="f-wealth-below" <?php echo "value=\"" . _( 'cbx_audience_wealth_below' ) . "\""; ?> />
                                        <label for="f-wealth-below"><?php echo _( 'cbx_audience_wealth_below' ); ?></label>
                                    </div>
                                    <div class="l-check-container">
                                        <input type="checkbox" name="cbx_audience_wealth_average" id="f-wealth-average" <?php echo "value=\"" . _( 'cbx_audience_wealth_average' ) . "\""; ?> />
                                        <label for="f-wealth-average"><?php echo _( 'cbx_audience_wealth_average' ); ?></label>
                                    </div>
                                    <div class="l-check-container">
                                        <input type="checkbox" name="cbx_audience_wealth_above" id="f-wealth-above" <?php echo "value=\"" . _( 'cbx_audience_wealth_above' ) . "\""; ?> />
                                        <label for="f-wealth-above"><?php echo _( 'cbx_audience_wealth_above' ); ?></label>
                                    </div>
                                
                                </fieldset>
                            </div>
                            </div>




                            <div class="col-pad-06">
                            <div class="m-sub-fieldset-container">
                                <fieldset class="m-sub-fieldset-inquiry">
                                    <legend class="m-sub-inquiry-title"><?php echo _( 'form-design-target-stl-gender' ); ?></legend>
                                    
                                    <div class="l-check-container">
                                        <input type="checkbox" name="cbx_audience_gender_man" id="f-gender-man" <?php echo "value=\"" . _( 'cbx_audience_gender_man' ) . "\""; ?> />
                                        <label for="f-gender-man"><?php echo _( 'cbx_audience_gender_man' ); ?></label>
                                    </div>
                                    <div class="l-check-container">
                                        <input type="checkbox" name="cbx_audience_gender_woman" id="f-gender-woman" <?php echo "value=\"" . _( 'cbx_audience_gender_woman' ) . "\""; ?> />
                                        <label for="f-gender-woman"><?php echo _( 'cbx_audience_gender_woman' ); ?></label>
                                    </div>
                                    <div class="l-check-container invisible">
                                        <input type="checkbox" name="xxx_gender_placeholder" id="f-gender-placeholder" value="true" />
                                        <label for="f-gender-placeholder"><?php echo _( 'xxx_gender_placeholder' ); ?></label>
                                    </div>
                                
                                </fieldset>
                            </div>
                            </div>


                            </div>


                            <div class="row">
                                
                            <div class="col-pad-12">
                            <div class="m-sub-fieldset-container">
                            <fieldset class="m-sub-fieldset-inquiry">
                                <!-- <legend class="m-sub-inquiry-title">Description</legend> -->

                                    <label for="f-average-user"><?php echo _( 'txt_audience_description' ); ?></label>
                                    <textarea name="txt_audience_description" id="f-average-user" rows="2" maxlength="500"></textarea>
                            
                            </fieldset>
                            </div>
                            </div>

                            </div>

                            </div>



                    </fieldset>
                </div>

            </div> <!-- l-sub-section th-divider-dark END -->




            <div class="l-sub-section th-divider-dark">
                
                <div id="f-main-fieldset-design" class="js-f-main-fieldset l-main-fieldset">
                    <fieldset>
                        <div class="m-inquiry-block">
                            <legend class="m-inquiry-title">
                                <span class="js-toggle-info m-btn-info fa fa-info fa-lg"></span>
                                <span><?php echo _( 'form-design-design-ttl' ); ?></span>
                            </legend>

                            <div class="m-block-info">
                                <blockquote class="slide-left">
                                    <p><?php echo _( 'form-design-design-info' ); ?></p>
                                </blockquote>
                            </div>
                        </div>


                        <div class="m-inputfield-wrapper">

                            <div class="l-check-container">
                                <input type="checkbox" name="xxx_design_colour" id="f-look-colour" class="js-other-details" value="true" />
                                <label for="f-look-colour"><?php echo _( 'txt_design_colour' ); ?></label>
                                    <!-- Conditional textarea -->
                                    <div class="m-odtext">
                                        <textarea name="txt_design_colour" id="f-look-colour-odtext" class="is-hidden" rows="2" maxlength="500"></textarea>
                                    </div>
                            </div>
                            <div class="l-check-container">
                                <input type="checkbox" name="xxx_design_theme" id="f-look-theme" class="js-other-details" value="true" />
                                <label for="f-look-theme"><?php echo _( 'txt_design_theme' ); ?></label>
                                    <!-- Conditional textarea -->
                                    <div class="m-odtext">
                                        <textarea name="txt_design_theme" id="f-look-theme-odtext" class="is-hidden" rows="2" maxlength="500"></textarea>
                                    </div>
                            </div>
                            <div class="l-check-container">
                                <input type="checkbox" name="xxx_design_style" id="f-look-style" class="js-other-details" value="true" />
                                <label for="f-look-style"><?php echo _( 'txt_design_style' ); ?></label>
                                    <!-- Conditional textarea -->
                                    <div class="m-odtext">
                                        <textarea name="txt_design_style" id="f-look-style-odtext" class="is-hidden" rows="2" maxlength="500"></textarea>
                                    </div>
                            </div>
                            <div class="l-check-container">
                                <input type="checkbox" name="xxx_design_brand" id="f-look-brand" class="js-other-details" value="true" />
                                <label for="f-look-brand"><?php echo _( 'txt_design_brand' ); ?></label>
                                    <!-- Conditional textarea -->
                                    <div class="m-odtext">
                                        <textarea name="txt_design_brand" id="f-look-brand-odtext" class="is-hidden" rows="2" maxlength="500"></textarea>
                                    </div>
                            </div>
                            <div class="l-check-container">
                                <input type="checkbox" name="xxx_design_otherdetails" id="f-look-odcheck" class="js-other-details" value="true" />
                                <label for="f-look-odcheck"><?php echo _( 'txt_design_othercomments' ); ?></label>
                                    <!-- Conditional textarea -->
                                    <div class="m-odtext">
                                        <textarea name="txt_design_othercomments" id="f-look-odtext" class="is-hidden" rows="2" maxlength="500"></textarea>
                                    </div>
                            </div>

                        </div>
                        
                    </fieldset>
                </div>

            </div> <!-- l-sub-section th-divider-dark END -->




            <div class="l-sub-section th-divider-dark">
                
                <div id="f-main-fieldset-competitors" class="js-f-main-fieldset l-main-fieldset">
                    <fieldset>
                        <div class="m-inquiry-block">
                            <legend class="m-inquiry-title">
                                <span class="js-toggle-info m-btn-info fa fa-info fa-lg"></span>
                                <span><?php echo _( 'form-design-competitor-ttl' ); ?></span>
                            </legend>

                            <div class="m-block-info">
                                <blockquote class="slide-left">
                                    <p><?php echo _( 'form-design-competitor-info' ); ?></p>
                                </blockquote>
                            </div>
                        </div>
                        
                        <div class="row m-inputfield-wrapper">
                        <div class="col-pad-06 m-site">
                            <div class="js-fieldset-1 is-visible">
                                <div>
                                    <input type="text" name="fld_competitor_1" id="f-competitor-url-1" placeholder="www." autocomplete="off" maxlength="150" />
                                </div>
                            </div>
                            <div class="js-fieldset-2 is-hidden">
                                <div>
                                    <input type="text" name="fld_competitor_2" id="f-competitor-url-2" placeholder="www." autocomplete="off" maxlength="150" />
                                </div>
                            </div>
                            <div class="js-fieldset-3 is-hidden">
                                <div>
                                    <input type="text" name="fld_competitor_3" id="f-competitor-url-3" placeholder="www." autocomplete="off" maxlength="150" />
                                </div>
                            </div>
                        </div>


                        <div class="col-pad-06 m-site">
                            <div class="js-fieldset-4 is-hidden">
                                <div>
                                    <input type="text" name="fld_competitor_4" id="f-competitor-url-4" placeholder="www." autocomplete="off" maxlength="150" />
                                </div>
                            </div>
                            <div class="js-fieldset-5 is-hidden">
                                <div>
                                    <input type="text" name="fld_competitor_5" id="f-competitor-url-5" placeholder="www." autocomplete="off" maxlength="150" />
                                </div>
                            </div>
                            <div class="js-fieldset-6 is-hidden">
                                <div>
                                    <input type="text" name="fld_competitor_6" id="f-competitor-url-6" placeholder="www." autocomplete="off" maxlength="150" />
                                </div>
                            </div>
                        </div>
                        </div> <!-- .row END -->


                        <div class="m-inputfield-wrapper">
                            <div class="m-button-block">
                                <div class="row">
                                        <div class="col-06-btn">
                                            <div class="button js-btn-show is-active"><span class="fa fa-plus fa-lg"></span>&nbsp;&nbsp;<?php echo _( 'form-subFields-btn-add' ); ?></div>
                                        </div>
                                        <div class="col-06-btn">
                                            <div class="button js-btn-hide is-disabled"><span class="fa fa-times fa-lg"></span>&nbsp;&nbsp;<?php echo _( 'form-subFields-btn-remove' ); ?></div>
                                        </div>
                                </div>
                            </div>
                        </div>


                    </fieldset>
                </div>

            </div> <!-- l-sub-section th-divider-dark END -->




            <div class="l-sub-section th-divider-dark">
                
                <div id="f-main-fieldset-like" class="js-f-main-fieldset l-main-fieldset">
                    <fieldset>
                        <div class="m-inquiry-block">
                            <legend class="m-inquiry-title">
                                <span class="js-toggle-info m-btn-info fa fa-info fa-lg"></span>
                                <span><?php echo _( 'form-design-like-ttl' ); ?></span>
                            </legend>

                            <div class="m-block-info">
                                <blockquote class="slide-left">
                                    <p><?php echo _( 'form-design-like-info' ); ?></p>
                                </blockquote>
                            </div>
                        </div>


                        <div class="m-inputfield-wrapper">
                            <p><?php echo _( 'form-design-like-par-instruction' ); ?></p>
                        </div>
                        
                        
                        <div class="m-sub-wrapper">
                        <div class="row">
                        <div class="col-pad-06 js-fieldset-1 is-visible m-site">
                            <div class="m-sub-fieldset-container">
                            <fieldset class="is-relative m-sub-fieldset-inquiry">
                                <legend class="m-sub-passive-title"><?php echo _( 'form-design-like-stl-site-1' ); ?></legend>

                                <div>
                                    <label for="f-like-url-1"><?php echo _( 'fld_like_1_url' ); ?></label>
                                    <input type="text" name="fld_like_1_url" id="f-like-url-1"  placeholder="www." autocomplete="off" maxlength="150" />
                                </div>
                                <div>
                                    <label for="f-like-like-1"><?php echo _( 'fld_like_1_like' ); ?></label>
                                    <input type="text" name="fld_like_1_like" id="f-like-like-1" maxlength="100" />
                                </div>
                                <div>
                                    <label for="f-like-improve-1"><?php echo _( 'fld_like_1_improve' ); ?></label>
                                    <input type="text" name="fld_like_1_improve" id="f-like-improve-1" maxlength="100" />
                                </div>
                                
                            </fieldset>
                            </div>
                        </div>
                        <div class="col-pad-06 js-fieldset-2 js-fieldset-lock is-visible m-site">
                            <div class="m-sub-fieldset-container">
                            <fieldset class="is-relative m-sub-fieldset-inquiry">
                                <legend class="m-sub-passive-title"><?php echo _( 'form-design-like-stl-site-2' ); ?></legend>

                                <div>
                                    <label for="f-like-url-2"><?php echo _( 'fld_like_2_url' ); ?></label>
                                    <input type="text" name="fld_like_2_url" id="f-like-url-2"  placeholder="www." autocomplete="off" maxlength="150" />
                                </div>
                                <div>
                                    <label for="f-like-like-2"><?php echo _( 'fld_like_2_like' ); ?></label>
                                    <input type="text" name="fld_like_2_like" id="f-like-like-2" maxlength="100" />
                                </div>
                                <div>
                                    <label for="f-like-improve-2"><?php echo _( 'fld_like_2_improve' ); ?></label>
                                    <input type="text" name="fld_like_2_improve" id="f-like-improve-2" maxlength="100" />
                                </div>
                                
                            </fieldset>
                            </div>
                        </div>
                        </div>

                        <div class="row">
                        <div class="col-pad-06 js-fieldset-3 is-hidden m-site">
                            <div class="m-sub-fieldset-container">
                            <fieldset class="is-relative m-sub-fieldset-inquiry">
                                <legend class="m-sub-passive-title"><?php echo _( 'form-design-like-stl-site-3' ); ?></legend>

                                <div>
                                    <label for="f-like-url-3"><?php echo _( 'fld_like_3_url' ); ?></label>
                                    <input type="text" name="fld_like_3_url" id="f-like-url-3"  placeholder="www." autocomplete="off" maxlength="150" />
                                </div>
                                <div>
                                    <label for="f-like-like-3"><?php echo _( 'fld_like_3_like' ); ?></label>
                                    <input type="text" name="fld_like_3_like" id="f-like-like-3" maxlength="100" />
                                </div>
                                <div>
                                    <label for="f-like-improve-3"><?php echo _( 'fld_like_3_improve' ); ?></label>
                                    <input type="text" name="fld_like_3_improve" id="f-like-improve-3" maxlength="100" />
                                </div>
                                
                            </fieldset>
                            </div>
                        </div>
                        <div class="col-pad-06 js-fieldset-4 is-hidden m-site">
                            <div class="m-sub-fieldset-container">
                            <fieldset class="is-relative m-sub-fieldset-inquiry">
                                <legend class="m-sub-passive-title"><?php echo _( 'form-design-like-stl-site-4' ); ?></legend>

                                <div>
                                    <label for="f-like-url-4"><?php echo _( 'fld_like_4_url' ); ?></label>
                                    <input type="text" name="fld_like_4_url" id="f-like-url-4"  placeholder="www." autocomplete="off" maxlength="150" />
                                </div>
                                <div>
                                    <label for="f-like-like-4"><?php echo _( 'fld_like_4_like' ); ?></label>
                                    <input type="text" name="fld_like_4_like" id="f-like-like-4" maxlength="100" />
                                </div>
                                <div>
                                    <label for="f-like-improve-4"><?php echo _( 'fld_like_4_improve' ); ?></label>
                                    <input type="text" name="fld_like_4_improve" id="f-like-improve-4" maxlength="100" />
                                </div>
                                
                            </fieldset>
                            </div>
                        </div>
                        </div> <!-- .row END -->


                        <div class="m-sub-fieldset-container">
                        <div class="m-button-block">
                            <div class="row">
                                    <div class="col-06-btn">
                                        <div class="button js-btn-show is-active"><span class="fa fa-plus fa-lg"></span>&nbsp;&nbsp;<?php echo _( 'form-subFields-btn-add' ); ?></div>
                                    </div>
                                    <div class="col-06-btn">
                                        <div class="button js-btn-hide is-disabled"><span class="fa fa-times fa-lg"></span>&nbsp;&nbsp;<?php echo _( 'form-subFields-btn-remove' ); ?></div>
                                    </div>
                            </div>
                        </div>
                        </div>


                        </div>
                        

                    
                    </fieldset>
                </div>

            </div> <!-- l-sub-section th-divider-dark END -->




            <div class="l-sub-section th-divider-dark">

                <div id="f-main-fieldset-dislike" class="js-f-main-fieldset l-main-fieldset">
                    <fieldset>
                        <div class="m-inquiry-block">
                            <legend class="m-inquiry-title">
                                <span class="js-toggle-info m-btn-info fa fa-info fa-lg"></span>
                                <span><?php echo _( 'form-design-dislike-ttl' ); ?></span>
                            </legend>

                            <div class="m-block-info">
                                <blockquote class="slide-left">
                                    <p><?php echo _( 'form-design-dislike-info' ); ?></p>
                                </blockquote>
                            </div>
                        </div>

                        <div class="m-inputfield-wrapper">
                            <p><?php echo _( 'form-design-dislike-par-instruction' ); ?></p>
                        </div>
                        

                        <div class="m-sub-wrapper">
                        <div class="row">
                        <div class="col-pad-06 js-fieldset-1 is-visible m-site">
                            <div class="m-sub-fieldset-container">
                            <fieldset class="is-relative m-sub-fieldset-inquiry">
                                <legend class="m-sub-passive-title"><?php echo _( 'form-design-dislike-stl-site-1' ); ?></legend>
                                
                                <div>
                                    <label for="f-dislike-url-1"><?php echo _( 'fld_dislike_1_url' ); ?></label>
                                    <input type="text" name="fld_dislike_1_url" id="f-dislike-url-1" placeholder="www." autocomplete="off" maxlength="150" />
                                </div>
                                <div>
                                    <label for="f-dislike-dislike-1"><?php echo _( 'fld_dislike_1_dislike' ); ?></label>
                                    <input type="text" name="fld_dislike_1_dislike" id="f-dislike-dislike-1" maxlength="100" />
                                </div>
                                
                            </fieldset>
                            </div>
                        </div>
                        <div class="col-pad-06 js-fieldset-2 js-fieldset-lock is-visible m-site">
                            <div class="m-sub-fieldset-container">
                            <fieldset class="is-relative m-sub-fieldset-inquiry">
                                <legend class="m-sub-passive-title"><?php echo _( 'form-design-dislike-stl-site-2' ); ?></legend>
                                
                                <div>
                                    <label for="f-dislike-url-2"><?php echo _( 'fld_dislike_2_url' ); ?></label>
                                    <input type="text" name="fld_dislike_2_url" id="f-dislike-url-2"  placeholder="www." autocomplete="off" maxlength="150" />
                                </div>
                                <div>
                                    <label for="f-dislike-dislike-2"><?php echo _( 'fld_dislike_2_dislike' ); ?></label>
                                    <input type="text" name="fld_dislike_2_dislike" id="f-dislike-dislike-2" maxlength="100" />
                                </div>
                                
                            </fieldset>
                            </div>
                        </div>
                        </div>


                        <div class="row">

                            <div class="col-pad-06 js-fieldset-3 is-hidden m-site">
                                <div class="m-sub-fieldset-container">
                                <fieldset class="is-relative m-sub-fieldset-inquiry">
                                    <legend class="m-sub-passive-title"><?php echo _( 'form-design-dislike-stl-site-3' ); ?></legend>
                                    
                                    <div>
                                        <label for="f-dislike-url-3"><?php echo _( 'fld_dislike_3_url' ); ?></label>
                                        <input type="text" name="fld_dislike_3_url" id="f-dislike-url-3"  placeholder="www." autocomplete="off" maxlength="150" />
                                    </div>
                                    <div>
                                        <label for="f-dislike-dislike-3"><?php echo _( 'fld_dislike_3_dislike' ); ?></label>
                                        <input type="text" name="fld_dislike_3_dislike" id="f-dislike-dislike-3" maxlength="100" />
                                    </div>
                                    
                                </fieldset>
                                </div>
                            </div>

                            <div class="col-pad-06 js-fieldset-4 is-hidden m-site">
                                <div class="m-sub-fieldset-container">
                                <fieldset class="is-relative m-sub-fieldset-inquiry">
                                    <legend class="m-sub-passive-title"><?php echo _( 'form-design-dislike-stl-site-4' ); ?></legend>
                                    
                                    <div>
                                        <label for="f-dislike-url-4"><?php echo _( 'fld_dislike_4_url' ); ?></label>
                                        <input type="text" name="fld_dislike_4_url" id="f-dislike-url-4"  placeholder="www." autocomplete="off" maxlength="150" />
                                    </div>
                                    <div>
                                        <label for="f-dislike-dislike-4"><?php echo _( 'fld_dislike_4_dislike' ); ?></label>
                                        <input type="text" name="fld_dislike_4_dislike" id="f-dislike-dislike-4" maxlength="100" />
                                    </div>
                                    
                                </fieldset>
                                </div>
                            </div>

                        </div> <!-- .row END -->


                        <div class="m-sub-fieldset-container">
                        <div class="m-button-block">
                            <div class="row">
                                    <div class="col-06-btn">
                                        <div class="button js-btn-show is-active"><span class="fa fa-plus fa-lg"></span>&nbsp;&nbsp;<?php echo _( 'form-subFields-btn-add' ); ?></div>
                                    </div>
                                    <div class="col-06-btn">
                                        <div class="button js-btn-hide is-disabled"><span class="fa fa-times fa-lg"></span>&nbsp;&nbsp;<?php echo _( 'form-subFields-btn-remove' ); ?></div>
                                    </div>
                            </div>
                        </div>
                        </div>

                        </div>
                        

                    </fieldset>
                </div>

            </div> <!-- l-sub-section th-divider-dark END -->







            <div class="l-sub-section th-divider-dark">
                
                <div id="f-main-fieldset-remark" class="js-f-main-fieldset l-main-fieldset">
                    <fieldset>
                        <div class="m-inquiry-block">
                            <legend class="m-inquiry-title">
                                <span class="js-toggle-info m-btn-info fa fa-info fa-lg"></span>
                                <span><?php echo _( 'form-design-remark-ttl' ); ?></span>
                            </legend>

                            <div class="m-block-info">
                                <blockquote class="slide-left">
                                    <p><?php echo _( 'form-design-remark-info' ); ?></p>
                                </blockquote>
                            </div>
                        </div>


                        <div class="m-inputfield-wrapper">

                            <div class="l-check-container">
                                <input type="radio" name="rdo_remark" id="f-remark-yes" class="js-other-details" <?php echo "value=\"" . _( 'rdo_remark_yes' ) . "\""; ?> />
                                <label for="f-remark-yes"><?php echo _( 'rdo_remark_yes' ); ?></label>
                                    <!-- Conditional textarea -->
                                    <div class="m-odtext">
                                        <textarea name="txt_definite_no" id="f-remark-odtext" class="is-hidden" rows="2" maxlength="1000"></textarea>
                                    </div>

                                        
                            </div>
                            <div class="l-check-container">
                                <input type="radio" name="rdo_remark" id="f-remark-no" class="js-other-details" <?php echo "value=\"" . _( 'rdo_remark_no' ) . "\""; ?> />
                                <label for="f-remark-no"><?php echo _( 'rdo_remark_no' ); ?></label>
                            </div>

                        </div>
                        
                    </fieldset>
                </div>

            </div> <!-- l-sub-section th-divider-dark END -->

            </div> <!-- l-sub-section-wrapper END -->
                
            </section>










            <section id="f-section-technology" class="f-section-technology th-divider">

                <div class="l-wrapper">
                    <h3><?php echo _( 'form-technology-ttl' ); ?></h3>
                </div>

            <div class="l-sub-section-wrapper">
            <div class="l-sub-section th-divider-dark">

                <div id="f-main-fieldset-architecture" class="js-f-main-fieldset l-main-fieldset">
                    <fieldset>
                        <div class="m-inquiry-block">
                            <legend class="m-inquiry-title">
                                <span class="js-toggle-info m-btn-info fa fa-info fa-lg"></span>
                                <span><?php echo _( 'form-technology-architecture-ttl' ); ?></span>
                            </legend>

                            <div class="m-block-info">
                                <blockquote class="slide-left">
                                    <p><?php echo _( 'form-technology-architecture-info' ); ?></p>
                                </blockquote>
                            </div>
                        </div>

                        <div class="m-inputfield-wrapper">

                            <p><?php echo _( 'form-technology-architecture-instruction' ); ?></p>
                            
                            <div class="l-check-container">
                                <input type="radio" name="rdo_architecture_layout" id="f-browser-mobile" <?php echo "value=\"" . _( 'rdo_architecture_mobile' ) . "\""; ?> />
                                <label for="f-browser-mobile"><?php echo _( 'rdo_architecture_mobile' ); ?></label>
                            </div>
                            <div class="l-check-container">
                                <input type="radio" name="rdo_architecture_layout" id="f-browser-desktop" <?php echo "value=\"" . _( 'rdo_architecture_desktop' ) . "\""; ?> />
                                <label for="f-browser-desktop"><?php echo _( 'rdo_architecture_desktop' ); ?></label>
                            </div>
                            <div class="l-check-container">
                                <input type="radio" name="rdo_architecture_layout" id="f-browser-responsive" <?php echo "value=\"" . _( 'rdo_architecture_responsive' ) . "\""; ?> />
                                <label for="f-browser-responsive"><?php echo _( 'rdo_architecture_responsive' ); ?><?php echo _( 'rdo_architecture_responsive_note' ); ?></label>
                            </div>

                            <hr class="th-hr-dark" />

                            <div class="l-check-container">
                                <input type="checkbox" name="cbx_architecture_hd" id="f-architechture-hd" <?php echo "value=\"" . _( 'cbx_architecture_hd' ) . "\""; ?> />
                                <label for="f-architechture-hd"><?php echo _( 'cbx_architecture_hd' ); ?></label>
                            </div>
                            <div class="l-check-container">
                                <input type="checkbox" name="cbx_architecture_legacysupport" id="f-browser-legacy" <?php echo "value=\"" . _( 'cbx_architecture_legacysupport' ) . "\""; ?> />
                                <label for="f-browser-legacy"><?php echo _( 'cbx_architecture_legacysupport' ); ?><?php echo _( 'cbx_architecture_legacysupport_note' ); ?></label>
                            </div>
                            <div class="l-check-container">
                                <input type="checkbox" name="xxx_architecture_othercomments" id="f-browser-odcheck" class="js-other-details" value="true" />
                                <label for="f-browser-odcheck"><?php echo _( 'txt_architecture_othercomments' ); ?></label>
                                    <!-- Conditional textarea -->
                                    <div class="m-odtext">
                                        <textarea name="txt_architecture_othercomments" id="f-browser-odtext" class="is-hidden" rows="2" maxlength="500"></textarea>
                                    </div>
                            </div>

                        </div>

                    </fieldset>
                </div>

            </div> <!-- l-sub-section th-divider-dark END -->




            <div class="l-sub-section th-divider-dark">
                
                <div id="f-main-fieldset-accessibility" class="js-f-main-fieldset l-main-fieldset">
                    <fieldset>
                        <div class="m-inquiry-block">
                            <legend class="m-inquiry-title">
                                <span class="js-toggle-info m-btn-info fa fa-info fa-lg"></span>
                                <span><?php echo _( 'form-technology-accessibility-ttl' ); ?></span>
                            </legend>

                            <div class="m-block-info">
                                <blockquote class="slide-left">
                                    <p><?php echo _( 'form-technology-accessibility-info' ); ?></p>
                                </blockquote>
                            </div>
                        </div>

                        <div class="m-inputfield-wrapper">

                            <p><?php echo _( 'form-technology-accessibility-instruction' ); ?></p>

                            <div class="l-check-container">
                                <input type="checkbox" name="cbx_accessibility_eyesight" id="f-access-eyesight" <?php echo "value=\"" . _( 'cbx_accessibility_eyesight' ) . "\""; ?> />
                                <label for="f-access-eyesight"><?php echo _( 'cbx_accessibility_eyesight' ); ?><?php echo _( 'cbx_accessibility_eyesight_note' ); ?></label>
                            </div>
                            <div class="l-check-container">
                                <input type="checkbox" name="cbx_accessibility_mobility" id="f-access-mobility" <?php echo "value=\"" . _( 'cbx_accessibility_mobility' ) . "\""; ?> />
                                <label for="f-access-mobility"><?php echo _( 'cbx_accessibility_mobility' ); ?><?php echo _( 'cbx_accessibility_mobility_note' ); ?></label>
                            </div>
                            <div class="l-check-container">
                                <input type="checkbox" name="cbx_accessibility_readinglevel" id="f-access-readinglevel" <?php echo "value=\"" . _( 'cbx_accessibility_readinglevel' ) . "\""; ?> />
                                <label for="f-access-readinglevel"><?php echo _( 'cbx_accessibility_readinglevel' ); ?></label>
                            </div>
                            <div class="l-check-container">
                                <input type="checkbox" name="xxx_accessibility_othercomments" id="f-access-odcheck" class="js-other-details" value="true" />
                                <label for="f-access-odcheck"><?php echo _( 'txt_accessibility_othercomments' ); ?></label>
                                    <!-- Conditional textarea -->
                                    <div class="m-odtext">
                                        <textarea name="txt_accessibility_othercomments" id="f-access-odtext" class="is-hidden" rows="2" maxlength="500"></textarea>
                                    </div>
                            </div>

                        </div>

                    </fieldset>
                </div>

            </div> <!-- l-sub-section th-divider-dark END -->




            <div class="l-sub-section th-divider-dark">
                
                <div id="f-main-fieldset-seo" class="js-f-main-fieldset l-main-fieldset">
                    <fieldset>
                        <div class="m-inquiry-block">
                            <legend class="m-inquiry-title">
                                <span class="js-toggle-info m-btn-info fa fa-info fa-lg"></span>
                                <span><?php echo _( 'form-technology-seo-ttl' ); ?></span>
                            </legend>

                            <div class="m-block-info">
                                <blockquote class="slide-left">
                                    <p><?php echo _( 'form-technology-seo-info-1' ); ?></p>
                                    <p><?php echo _( 'form-technology-seo-info-2' ); ?></p>
                                </blockquote>
                            </div>
                        </div>

                        <div class="m-inputfield-wrapper">

                            <p><?php echo _( 'form-technology-seo-instruction' ); ?></p>
                                
                            
                            <div class="l-check-container">
                                <input type="checkbox" name="xxx_seo_tool" id="f-seo-tool" value="true" />
                                <label for="f-seo-tool"><?php echo _( 'xxx_seo_tool' ); ?> <sup><a id="ffn2" href="#fn2" class="footnote">2</a></sup> (<em><?php echo _( 'xxx_seo_tool_note' ); ?></em>)</label>

                                        <!-- Conditional radio btn selection -->
                                        <fieldset class="row js-toggle-area is-hidden l-sub-check m-sub-fieldset-inquiry">
                                            <legend class="m-sub-passive-title"><?php echo _( 'form-technology-seo-stl-wmt' ); ?></legend>
                                            
                                            <div class="col-06 l-check-container">
                                                <input type="checkbox" name="cbx_seo_tool_google" id="f-seo-tool-google" <?php echo "value=\"" . _( 'cbx_seo_tool_google' ) . "\""; ?> />
                                                <label for="f-seo-tool-google">
                                                    <a <?php echo "href=\"" . _( 'https://www.google.ca/webmasters/' ) . "\""; ?> target="_blank"><?php echo _( 'cbx_seo_tool_google' ); ?></a>
                                                </label>
                                            </div>
                                            <div class="col-06 l-check-container">
                                                <input type="checkbox" name="cbx_seo_tool_bing" id="f-seo-tool-bing" <?php echo "value=\"" . _( 'cbx_seo_tool_bing' ) . "\""; ?> />
                                                <label for="f-seo-tool-bing">
                                                    <a <?php echo "href=\"" . _( 'http://www.bing.com/toolbox/webmaster' ) . "\""; ?> target="_blank"><?php echo _( 'cbx_seo_tool_bing' ); ?></a>
                                                </label>
                                            </div>
                                            <div class="col-06 l-check-container">
                                                <input type="checkbox" name="cbx_seo_tool_yandex" id="f-seo-tool-yandex" <?php echo "value=\"" . _( 'cbx_seo_tool_yandex' ) . "\""; ?> />
                                                <label for="f-seo-tool-yandex">
                                                    <a <?php echo "href=\"" . _( 'https://webmaster.yandex.com' ) . "\""; ?> target="_blank"><?php echo _( 'cbx_seo_tool_yandex' ); ?></a>
                                                </label>
                                            </div>
                                            
                                        </fieldset>
                            </div>
                            <div class="l-check-container">
                                <input type="checkbox" name="cbx_seo_url_optimization" id="f-seo-url" value="URL optimization and canonicalization" />
                                <label for="f-seo-url"><?php echo _( 'cbx_seo_url_optimization' ); ?> <sup><a id="ffn3" href="#fn3" class="footnote">3</a></sup> (<em><?php echo _( 'cbx_seo_url_optimization_note' ); ?></em>)</label>
                            </div>
                            <div class="l-check-container">
                                <input type="checkbox" name="cbx_seo_structured_data" id="f-seo-rich" value="Rich Snippets and Structured Data" />
                                <label for="f-seo-rich"><?php echo _( 'cbx_seo_structured_data' ); ?> <sup><a id="ffn4" href="#fn4" class="footnote">4</a></sup> (<em><?php echo _( 'cbx_seo_structured_data_note' ); ?></em>)</label>
                            </div>
                            <div class="l-check-container">
                                <input type="checkbox" name="cbx_seo_localization" id="f-seo-lang" value="Target Multiple Languages" />
                                <label for="f-seo-lang"><?php echo _( 'cbx_seo_localization' ); ?> (<em><?php echo _( 'cbx_seo_localization_note' ); ?> <sup><a id="ffn5" href="#fn5" class="footnote">5</a></sup></em>)</label>
                            </div>
                            <div class="l-check-container">
                                <input type="checkbox" name="cbx_seo_mobile_meta" id="f-seo-mobile" value="Mobile web development meta tag configuration with subdomains" />
                                <label for="f-seo-mobile"><?php echo _( 'cbx_seo_mobile_meta' ); ?> <sup><a id="ffn6" href="#fn6" class="footnote">6</a></sup> (<em><?php echo _( 'cbx_seo_mobile_meta_note' ); ?></em>)</label>
                            </div>
                            <div class="l-check-container">
                                <input type="checkbox" name="xxx_seo_opengraph" id="f-seo-social" value="true" />
                                <label for="f-seo-social"><?php echo _( 'xxx_seo_opengraph' ); ?> <sup><a id="ffn7" href="#fn7" class="footnote">7</a></sup> (<?php echo _( 'xxx_seo_opengraph_note' ); ?>)</label>

                                        <!-- Conditional radio btn selection -->
                                        <fieldset class="row js-toggle-area is-hidden l-sub-check m-sub-fieldset-inquiry">
                                            <legend class="m-sub-passive-title"><?php echo _( 'form-technology-seo-stl-opengraph' ); ?></legend>

                                            <div class="col-04 l-check-container">
                                                <label for="f-seo-social-fb">
                                                    <input type="checkbox" name="cbx_seo_opengraph_fb" id="f-seo-social-fb" <?php echo "value=\"" . _( 'cbx_seo_opengraph_fb' ) . "\""; ?> />
                                                    <a <?php echo "href=\"" . _( 'https://www.facebook.com' ) . "\""; ?> target="_blank"><?php echo _( 'cbx_seo_opengraph_fb' ); ?></a>
                                                </label>
                                            </div>
                                            <div class="col-04 l-check-container">
                                                <label for="f-seo-social-tw">
                                                    <input type="checkbox" name="cbx_seo_opengraph_tw" id="f-seo-social-tw" <?php echo "value=\"" . _( 'cbx_seo_opengraph_tw' ) . "\""; ?> />
                                                    <a <?php echo "href=\"" . _( 'https://twitter.com' ) . "\""; ?> target="_blank"><?php echo _( 'cbx_seo_opengraph_tw' ); ?></a>
                                                </label>
                                            </div>
                                            <div class="col-04 l-check-container">
                                                <label for="f-seo-social-gplus">
                                                    <input type="checkbox" name="cbx_seo_opengraph_gplus" id="f-seo-social-gplus" <?php echo "value=\"" . _( 'cbx_seo_opengraph_gplus' ) . "\""; ?> />
                                                    <a <?php echo "href=\"" . _( 'https://plus.google.com' ) . "\""; ?> target="_blank"><?php echo _( 'cbx_seo_opengraph_gplus' ); ?></a>
                                                </label>
                                            </div>
                                            <div class="col-04 l-check-container">
                                                <label for="f-seo-social-linkedin">
                                                    <input type="checkbox" name="cbx_seo_opengraph_linkedin" id="f-seo-social-linkedin" <?php echo "value=\"" . _( 'cbx_seo_opengraph_linkedin' ) . "\""; ?> />
                                                    <a <?php echo "href=\"" . _( 'https://ca.linkedin.com/nhome/' ) . "\""; ?> target="_blank"><?php echo _( 'cbx_seo_opengraph_linkedin' ); ?></a>
                                                </label>
                                            </div>
                                            <div class="col-04 l-check-container">
                                                <label for="f-seo-social-pinterest">
                                                    <input type="checkbox" name="cbx_seo_opengraph_pinterest" id="f-seo-social-pinterest" <?php echo "value=\"" . _( 'cbx_seo_opengraph_pinterest' ) . "\""; ?> />
                                                    <a <?php echo "href=\"" . _( 'https://www.pinterest.com' ) . "\""; ?> target="_blank"><?php echo _( 'cbx_seo_opengraph_pinterest' ); ?></a>
                                                </label>
                                            </div>
                                            
                                        </fieldset>
                            </div>
                            <div class="l-check-container">
                                <input type="checkbox" name="cbx_seo_analytic" id="f-seo-analytic" value="Google Analytics" />
                                <label for="f-seo-analytic"><?php echo _( 'cbx_seo_analytic' ); ?> <sup><a id="ffn8" href="#fn8" class="footnote">8</a></sup> <?php echo _( 'cbx_seo_analytic_note' ); ?></label>
                            </div>

                        </div>

                    </fieldset>
                </div>

            </div> <!-- l-sub-section th-divider-dark END -->


            <div class="l-sub-section th-divider-dark">
                
                <div id="f-main-fieldset-domain" class="js-f-main-fieldset l-main-fieldset">
                    <fieldset>
                        <div class="m-inquiry-block">
                            <legend class="m-inquiry-title">
                                <span class="js-toggle-info m-btn-info fa fa-info fa-lg"></span>
                                <span><?php echo _( 'form-technology-domain-ttl' ); ?></span>
                            </legend>

                            <div class="m-block-info">
                                <blockquote class="slide-left">
                                    <p><?php echo _( 'form-technology-domain-info' ); ?> <a <?php echo "href=\"" . _( 'https://www.namecheap.com' ) . "\""; ?> target="_BLANK"><?php echo _( 'Namecheap.com' ); ?></a></p>
                                </blockquote>
                            </div>
                        </div>

                        <div class="row m-inputfield-wrapper">
                        <div class="col-pad-06 m-site">
                            <div class="js-fieldset-1 is-visible">
                                <div>
                                    <input type="text" name="fld_domain_1" id="f-domain-1" placeholder="www." autocomplete="off" maxlength="150" />
                                </div>
                            </div>
                            <div class="js-fieldset-2 is-hidden">
                                <div>
                                    <input type="text" name="fld_domain_2" id="f-domain-2" placeholder="www." autocomplete="off" maxlength="150" />
                                </div>
                            </div>
                            <div class="js-fieldset-3 is-hidden">
                                <div>
                                    <input type="text" name="fld_domain_3" id="f-domain-3" placeholder="www." autocomplete="off" maxlength="150" />
                                </div>
                            </div>
                        </div>


                        <div class="col-pad-06 m-site">
                            <div class="js-fieldset-4 is-hidden">
                                <div>
                                    <input type="text" name="fld_domain_4" id="f-domain-4" placeholder="www." autocomplete="off" maxlength="150" />
                                </div>
                            </div>
                            <div class="js-fieldset-5 is-hidden">
                                <div>
                                    <input type="text" name="fld_domain_5" id="f-domain-5" placeholder="www." autocomplete="off" maxlength="150" />
                                </div>
                            </div>
                            <div class="js-fieldset-6 is-hidden">
                                <div>
                                    <input type="text" name="fld_domain_6" id="f-domain-6" placeholder="www." autocomplete="off" maxlength="150" />
                                </div>
                            </div>
                        </div>
                        </div> <!-- .row END -->


                        <div class="m-inputfield-wrapper">
                        <div class="m-button-block">
                            <div class="row">
                                    <div class="col-06-btn">
                                        <div class="button js-btn-show is-active"><span class="fa fa-plus fa-lg"></span>&nbsp;&nbsp;<?php echo _( 'form-subFields-btn-add' ); ?></div>
                                    </div>
                                    <div class="col-06-btn">
                                        <div class="button js-btn-hide is-disabled"><span class="fa fa-times fa-lg"></span>&nbsp;&nbsp;<?php echo _( 'form-subFields-btn-remove' ); ?></div>
                                    </div>
                            </div>
                        </div>
                        </div>


                    </fieldset>
                </div>

            </div> <!-- l-sub-section th-divider-dark END -->




            <div class="l-sub-section th-divider-dark">

                <div id="f-main-fieldset-hosting" class="js-f-main-fieldset l-main-fieldset">
                    <fieldset>
                        <div class="m-inquiry-block">
                            <legend class="m-inquiry-title">
                                <span class="js-toggle-info m-btn-info fa fa-info fa-lg"></span>
                                <span><?php echo _( 'form-technology-hosting-ttl' ); ?></span>
                            </legend>

                            <div class="m-block-info">
                                <blockquote class="slide-left">
                                    <p><?php echo _( 'form-technology-hosting-info' ); ?></p>
                                </blockquote>
                            </div>
                        </div>
                        

                        <div class="m-inputfield-wrapper">
                            <div class="l-check-container">
                                <input type="radio" name="rdo_requirehosting" id="f-hosting-yes" <?php echo "value=\"" . _( 'rdo_requirehosting_yes' ) . "\""; ?> />
                                <label for="f-hosting-yes"><?php echo _( 'rdo_requirehosting_yes' ); ?></label>
                            </div>
                            <div class="l-check-container">
                                <input type="radio" name="rdo_requirehosting" id="f-hosting-no" <?php echo "value=\"" . _( 'rdo_requirehosting_no' ) . "\""; ?> />
                                <label for="f-hosting-no"><?php echo _( 'rdo_requirehosting_no' ); ?></label>
                            </div>
                        </div>

                    </fieldset>
                </div>

            </div> <!-- l-sub-section th-divider-dark END -->




            <div class="l-sub-section th-divider-dark">

                <div id="f-main-fieldset-email" class="js-f-main-fieldset l-main-fieldset">
                    <fieldset>
                        <div class="m-inquiry-block">
                            <legend class="m-inquiry-title">
                                <span class="js-toggle-info m-btn-info fa fa-info fa-lg"></span>
                                <span><?php echo _( 'form-technology-email-ttl' ); ?></span>
                            </legend>

                            <div class="m-block-info">
                                <blockquote class="slide-left">
                                    <p><?php echo _( 'form-technology-email-info' ); ?></p>
                                </blockquote>
                            </div>
                        </div>
                        
                        <div class="m-inputfield-wrapper">
                            <div class="l-check-container">
                                <input type="radio" name="rdo_domain_mailmatch" id="f-domain-mailmatch-yes" <?php echo "value=\"" . _( 'rdo_domain_mailmatch_yes' ) . "\""; ?> />
                                <label for="f-domain-mailmatch-yes"><?php echo _( 'rdo_domain_mailmatch_yes' ); ?></label>
                            </div>
                            <div class="l-check-container">
                                <input type="radio" name="rdo_domain_mailmatch" id="f-domain-mailmatch-no" <?php echo "value=\"" . _( 'rdo_domain_mailmatch_no' ) . "\""; ?> />
                                <label for="f-domain-mailmatch-no"><?php echo _( 'rdo_domain_mailmatch_no' ); ?></label>
                            </div>
                        </div>

                    </fieldset>
                </div>

            </div> <!-- l-sub-section th-divider-dark END -->




            <div class="l-sub-section th-divider-dark">
                
                <div id="f-main-fieldset-maintenance" class="js-f-main-fieldset l-main-fieldset">
                    <fieldset>
                        <div class="m-inquiry-block">
                            <legend class="m-inquiry-title">
                                <span class="js-toggle-info m-btn-info fa fa-info fa-lg"></span>
                                <span><?php echo _( 'form-technology-maintenance-ttl' ); ?></span>
                            </legend>

                            <div class="m-block-info">
                                <blockquote class="slide-left">
                                    <p><?php echo _( 'form-technology-maintenance-info' ); ?></p>
                                </blockquote>
                            </div>
                        </div>


                        <div class="m-inputfield-wrapper">
                            <label for="f-maintenance-odtext">
                                <textarea name="txt_maintenance_details" id="f-maintenance-odtext" rows="2" maxlength="500"></textarea>
                            </label>
                        </div>


                    </fieldset>
                </div>
                
            </div> <!-- l-sub-section th-divider-dark END -->
            </div> <!-- l-sub-section-wrapper END -->

            </section>










            <section id="f-section-other" class="f-section-other th-divider">

                <div class="l-wrapper">
                    <h3><?php echo _( 'form-other-ttl' ); ?></h3>
                </div>

                <div class="l-sub-section-wrapper">
                <div class="l-sub-section th-divider-dark">

                    <div id="f-main-fieldset-future" class="js-f-main-fieldset l-main-fieldset">
                        <fieldset>
                            <div class="m-inquiry-block">
                                <legend class="m-inquiry-title">
                                    <span class="js-toggle-info m-btn-info fa fa-info fa-lg"></span>
                                    <span><?php echo _( 'form-other-future' ); ?></span>
                                </legend>

                                <div class="m-block-info">
                                    <blockquote class="slide-left">
                                        <p><?php echo _( 'form-other-future-info' ); ?></p>
                                    </blockquote>
                                </div>
                            </div>

                            <div class="m-inputfield-wrapper">
                                <textarea name="txt_future_comments" id="f-future-odtext" rows="2" maxlength="2000"></textarea>
                            </div>
                        </fieldset>
                    </div>

                </div>

                <div class="l-sub-section th-divider-dark">

                    <div id="f-main-fieldset-comment" class="js-f-main-fieldset l-main-fieldset">
                        <fieldset>
                            <div class="m-inquiry-block">
                                <legend class="m-inquiry-title">
                                    <span class="js-toggle-info m-btn-info fa fa-info fa-lg"></span>
                                    <span><?php echo _( 'form-other-comment' ); ?></span>
                                </legend>

                                <div class="m-block-info">
                                    <blockquote class="slide-left">
                                        <p><?php echo _( 'form-other-comment-info' ); ?></p>
                                    </blockquote>
                                </div>
                            </div>

                            <div class="m-inputfield-wrapper">
                                <textarea name="txt_additional_comments" id="f-comment-odtext" rows="2" maxlength="2000"></textarea>
                            </div>
                        </fieldset>
                    </div>

                </div>
                </div> <!-- l-sub-section-wrapper END -->

                
            </section>


            <div id="f-section-submit" class="f-section-submit th-divider">

                <div class="l-wrapper">
                    <h3><?php echo _( 'form-submit-ttl' ); ?></h3>
                </div>

                <div class="l-main-fieldset">
                    <div class="m-inputfield-wrapper">
                        <div class="m-center-block">
                            <div id="captcha"></div>
                        </div>
                    </div>
                </div>


                <div class="l-main-fieldset">
                    <div class="m-inputfield-wrapper">
                    <div class="l-txt-center">
                        <button class="button" type="submit" value="Submit" id="f-submit" name="submit"><?php echo _( 'form-btn-submit' ); ?></button>
                        <button class="button" type="reset" value="Reset" id="f-reset" name="reset"><?php echo _( 'form-btn-reset' ); ?></button>
                    </div>
                    </div>
                </div>

                <!-- Will output the results from process.php here -->
                <div id="results-container">
                    <div id="results" class="l-main-fieldset"></div>
                </div>



            </div>




        </form>
        </div>




            <section id="f-section-footnotes" class="f-section-footnotes th-bg-alt">

                <div class="l-wrapper">

                    <div class="l-sub-section-wrapper">
                    <div class="l-sub-section th-divider-light">

                        <div class="row">

                            <div class="col-pad-12 m-footer-block">
                                <ol id="footnotes">
                                    <li id="fn1"><?php echo _( 'form-footnote-fn1' ); ?> <a href="#ffn1">&#8617;</a></li>
                                    <li id="fn2"><?php echo _( 'form-footnote-fn2' ); ?> <a href="#ffn2">&#8617;</a></li>
                                    <li id="fn3"><?php echo _( 'form-footnote-fn3' ); ?> <a href="#ffn3">&#8617;</a></li>
                                    <li id="fn4"><?php echo _( 'form-footnote-fn4' ); ?> <a href="#ffn4">&#8617;</a></li>
                                    <li id="fn5"><?php echo _( 'form-footnote-fn5' ); ?> <a href="#ffn5">&#8617;</a></li>
                                    <li id="fn6"><?php echo _( 'form-footnote-fn6' ); ?> <a href="#ffn6">&#8617;</a></li>
                                    <li id="fn7"><?php echo _( 'form-footnote-fn7' ); ?> <a href="#ffn7">&#8617;</a></li>
                                    <li id="fn8"><?php echo _( 'form-footnote-fn8' ); ?> <a href="#ffn8">&#8617;</a></li>
                                    <li id="fn9"><?php echo _( 'form-footnote-fn9' ); ?> <a href="#ffn9">&#8617;</a></li>
                                </ol>
                            </div>

                        </div>  <!-- row END -->

                    </div> <!-- l-sub-section END -->

                    <div class="l-sub-section th-divider-light">

                        <div class="row">

                            <div class="col-pad-06 m-footer-block">
                                <div class="m-share">
                                    <h4>Share</h4>
                                    <ul>
                                        <li><a href="https://www.facebook.com/sharer/sharer.php?u=www.projecklist.oneprojct.space"><span class="fa fa-facebook-square fa-2x"></span></a></li>
                                        <li><a href="#"><span class="fa fa-twitter-square fa-2x"></span></a></li>
                                        <li><a href="#"><span class="fa fa-linkedin-square fa-2x"></span></a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-pad-06 m-footer-block">
                                <div class="m-github">

                                    <h4>Github</h4>                                    
                                    <ul>
                                        <li>
                                            <!-- Place this tag where you want the button to render. -->
                                            <a class="github-button" href="https://github.com/ntkme/github-buttons" data-icon="octicon-eye" data-style="mega" aria-label="Watch ntkme/github-buttons on GitHub">Watch</a>
                                        </li>
                                        <li>
                                            <!-- Place this tag where you want the button to render. -->
                                            <a class="github-button" href="https://github.com/ntkme/github-buttons" data-icon="octicon-star" data-style="mega" aria-label="Star ntkme/github-buttons on GitHub">Star</a>
                                        </li>
                                        <li>
                                            <!-- Place this tag where you want the button to render. -->
                                            <a class="github-button" href="https://github.com/ntkme/github-buttons/fork" data-icon="octicon-git-branch" data-style="mega" aria-label="Fork ntkme/github-buttons on GitHub">Fork</a>
                                        </li>
                                    </ul>
                                    <!-- Place this tag right after the last button or just before your close body tag. -->
                                    <script async defer id="github-bjs" src="https://buttons.github.io/buttons.js"></script>
                                </div>
                            </div>
                            <div class="col-12 m-copyright">
                                <p>Created in Montreal &copy; <?php echo date("Y")?></p>
                                <a href="humans.txt" target="_BLANK"><img src="img/humans/humanstxt-isolated-orange.gif" alt="humans.org"></a>
                            </div>

                        </div> <!-- row END -->

                        </div> <!-- l-sub-section END -->
                    </div> <!-- l-sub-section-wrapper END -->


                </div> <!-- l-wrapper END -->


            </section>

         <!--    <section id="f-footer" class="f-footer" >
                <div class="l-wrapper">
                </div>
            </section> -->


    </div> <!-- l-form-container END -->




<!-- End Document
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
    <script src="http://cdn.jsdelivr.net/jquery.validation/1.13.1/jquery.validate.js"></script>


    <!-- reCAPTCHA api
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <script type="text/javascript">

        var verifyCallback = function(response) {
            // console.log(response);
            console.log("captcha: PASS");
        };


        var widgetId1;
        var c_theme = $("body").hasClass("th-light") ? "light" : "dark";
        var onloadCallback = function() {
            widgetId1 = grecaptcha.render('captcha', {
                'sitekey' : '6LfS5ggTAAAAAERF8SrqqTaWKt4nYpvh0nCwiEmT',
                'theme' : c_theme,
                'callback' : verifyCallback
            });
        };


        var htmlLang = $("html").attr("lang");
        if (htmlLang === "fr_CA")
        {
            document.write('<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit&hl=fr-CA" async defer><\/script>')
        }
        else
        {
            document.write('<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer><\/script>')
        }

    </script>

    <script src="js/min/plugins-min.js" async></script>
    <script src="js/main.js" async></script>

</body>
</html>
