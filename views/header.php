<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php echo $_SESSION['html_lang'] ?> prefix="og: http://ogp.me/ns#"> <!--<![endif]-->

<head>

    <!-- Basic Page Needs
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <?php if (isset($title)): ?>
        <title><?php echo _( 'form-htmltag-ttl' ); ?>: <?= htmlspecialchars($title) ?></title>
    <?php else: ?>
        <title><?php echo _( 'form-htmltag-ttl' ); ?></title>
    <?php endif ?>

    <meta name="description" <?php echo "content=\""._( 'form-htmlmeta-description' )."\""; ?> >
    <link rel="author" href="humans.txt" />

    <!-- Mobile Specific Metas
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <meta name="viewport" content="width=device-width, initial-scale=1, minimal-ui">

    <!-- Schema.org markup for Facebook -->
    <meta property="og:title" <?php echo "content=\"" . _( 'head-og-title' ) . "\""; ?>/>
    <meta property="og:image" <?php echo "content=\"" . _( 'head-og-image' ) . "\""; ?>/>
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image:width" content="2000">
    <meta property="og:image:height" content="1050">
    <meta property="og:url" <?php echo "content=\"" . _( 'head-og-url' ) . "\""; ?>/> <!-- http://www.projecklist.oneprojct.space/?lang=en_CA -->
    <meta property="og:site_name" content="Projecklist"/>
    <meta property="og:locale:alternate" <?php echo "content=\"" . _( 'head-og-fb-locale' ) . "\""; ?>/>
    <meta property="og:description" <?php echo "content=\"" . _( 'head-og-description' ) . "\""; ?>/>

    <!-- Schema.org markup for Twitter -->
    <meta name="twitter:card" content="summary_large_image"/>
    <meta name="twitter:site" content="@projecklist">
    <meta name="twitter:creator" content="@_dracine">
    <meta name="twitter:title" <?php echo "content=\"" . _( 'head-og-title' ) . "\""; ?>/>
    <meta name="twitter:description" <?php echo "content=\"" . _( 'head-og-description' ) . "\""; ?>/>
    <meta name="twitter:image" <?php echo "content=\"" . _( 'head-og-image' ) . "\""; ?>/>

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
    <!-- <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"> -->
    <script src="https://use.fontawesome.com/57fd7ffc48.js"></script>
    <link rel="stylesheet" href="css/page.css">
    <!--[if lt IE 9]>
    <link rel="stylesheet" href="css/style-ie.css"/>
    <![endif]-->    

    <!-- DEBUG css file -> to be deleted from production -->
    <link rel="stylesheet" href="css/ipad_dev.css">
    <script src="js/vendor/modernizr-2.6.2.min.js"></script>

</head>

<body <?php echo $_SESSION['html_theme'] ?>>
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
                // include '../_debug/session.php';
            ?>
        </ul>
    </div>
    -->

    <!-- // Dialog box overlay -->
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
                    <div class="js-menu-theme" <?php echo "title=\"" . _( 'form-navbar-titleAttr-langSwitch' ) . "\""; ?>><span class="fa fa-lg"></span></div>
                </div>
            </div>
        </div>

        <div class="m-theme-indicator"></div>

        <nav class="m-navbar">
            <div class="l-wrapper-nav clearfix is-relative">
                <div class="m-brand-container clearfix">
                    <div class="m-logo"><a href="index.php"><img src="img/logos/placeholder.svg" alt="logo"></a></div>
                    <div class="m-coname"><span>Projecklist</span></div>
                </div>
                <div class="m-mobile-menu"><span class="fa fa-lg fa-bars" aria-hidden="true"></span></div class="m-mobile-menu">
                <ul class="m-menu">
                    <!-- <li id="f-debug-fill-form" title="debug -> fill form button"><span class="fa fa-bug fa-lg"></span></li> -->
                    <li <?php echo "title=\"" . _( 'form-navbar-titleAttr-getStarted' ) . "\""; ?>><a href="projeckt.php"><span class="fa fa-lg fa-rocket" aria-hidden="true"></span></a></li>
                    <!-- fa icon loaded on pageload JS loadTheme(); -->
                    <li class="js-menu-theme" <?php echo "title=\"" . _( 'form-navbar-titleAttr-toggleTheme' ) . "\""; ?>><span class="fa fa-lg"></span></li>
                </ul>
            </div>

            <div class="l-wrapper-nav clearfix is-relative">
                <ul class="m-nav-login">
                    <li><span><?= _( 'Hello' ); ?></span>, <span id="js-display-name"><?= $s_displayname ?></span></li>
                    <?php if (empty($_SESSION["id"])): ?>
                        <!-- <li <?php //echo "title=\"" . _( 'form-navbar-titleAttr-signIn' ) . "\""; ?>>Sign in&nbsp;&nbsp;<a href="login.php"><span class="fa fa-lg fa-sign-in" aria-hidden="true"></span></a></li> -->
                    <?php endif ?>
                    <?php if (!empty($_SESSION["id"])): ?>
                        <li <?php echo "title=\"" . _( 'form-navbar-titleAttr-logOut' ) . "\""; ?>><a href="logout.php"><span class="fa fa-lg fa-sign-out" aria-hidden="true"></span></a></li>
                        <li <?php echo "title=\"" . _( 'form-navbar-titleAttr-profile' ) . "\""; ?>><a href="profile.php"><span class="fa fa-lg fa-user" aria-hidden="true"></span></a></li>
                    <?php endif ?>
                </ul>
            </div>
        </nav>

