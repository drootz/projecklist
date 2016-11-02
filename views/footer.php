        <section id="f-section-footer" class="f-section-footnotes th-bg-alt">

            <div class="l-wrapper">

                <div class="l-sub-section-wrapper">

                    <div class="l-sub-section th-divider-light">

                        <div class="row">

                            <div class="col-pad-04 m-footer-block">
                                <div class="m-share">
                                    <h4><?= _("Share"); ?></h4>
                                    <ul>
                                        <li><a <?= "href=\"" . _( 'footer-fb-share-link' ) . "\""; ?>><span class="fa fa-facebook-square fa-2x"></span></a></li>
                                        <li><a <?= "href=\"" . _( 'footer-tw-share-link' ) . "\""; ?>><span class="fa fa-twitter-square fa-2x"></span></a></li>
                                        <li><a <?= "href=\"" . _( 'footer-in-share-link' ) . "\""; ?>><span class="fa fa-linkedin-square fa-2x"></span></a></li>
                                        <!-- <li><a href="https://twitter.com/intent/tweet?text=WEB PROJECT EVALUATION FORM&via=projecklist&url=http%3A%2F%2Fwww.projecklist.oneprojct.space%2F%3Flang%3Den_CA">Tweet</a></li> testing tw link sharing -->
                                    </ul>
                                </div>
                            </div>

                            <div class="col-pad-04 m-footer-block">
                                <div class="m-github">

                                    <h4>Github</h4>                                    
                                    <ul>
                                        <li>
                                            <!-- Place this tag where you want the button to render. -->
                                            <a class="github-button" href="https://github.com/dracine-hub/projecklist" data-icon="octicon-eye" data-style="mega" aria-label="Watch dracine-hub/projecklist on GitHub">Watch</a>
                                        </li>
                                        <li>
                                            <!-- Place this tag where you want the button to render. -->
                                            <a class="github-button" href="https://github.com/dracine-hub/projecklist" data-icon="octicon-star" data-style="mega" aria-label="Star dracine-hub/projecklist on GitHub">Star</a>
                                        </li>
                                        <li>
                                            <!-- Place this tag where you want the button to render. -->
                                            <a class="github-button" href="https://github.com/dracine-hub/projecklist/fork" data-icon="octicon-git-branch" data-style="mega" aria-label="Fork dracine-hub/projecklist on GitHub">Fork</a>
                                        </li>
                                    </ul>
                                    <!-- Place this tag right after the last button or just before your close body tag. -->
                                    <script async defer id="github-bjs" src="https://buttons.github.io/buttons.js"></script>
                                </div>
                            </div>

                            <div class="col-pad-04 m-info-block">

                                <h4>Projecklist</h4>
                                <ul class="m-info">
                                    <li class="m-menu-li-drop is-not-toggled" <?= "title=\"" . _( 'form-navbar-titleAttr-langSwitch' ) . "\""; ?> >
                                        <!-- $_SESSION['lang'] -->
                                        <?= htmlspecialchars($_SESSION['currentLanguage']) . "<span class=\"fa fa-globe fa-lg\"></span>"; ?>
                                        <!-- <span class=\"m-currentlanguage\"></span> -->
                                        <?= setLanguageMenu(); ?>
                                    </li>

                                    <?php if (!empty($_SESSION["id"])): ?>
                                        <li><a href="contact.php"><?= _('Contact Us'); ?><span class="fa fa-envelope fa-lg"></span></a></li>
                                    <?php endif ?>

                                </ul>
                            </div>

                            <div class="col-12 m-copyright">
                                <p><?= _( 'footer-copy' ); ?> &copy; <?= date("Y")?></p>
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




<!-- End Document –––––––––––––––––––––––––––––––––––––––––––––––––– -->

    <!-- All libraries concatenated and minified in main-min.js -->
    <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script> -->
    <!-- <script src="http://cdn.jsdelivr.net/jquery.validation/1.13.1/jquery.validate.js"></script> -->
    <!-- <script src="js/vendor/autogrow/autogrow.min.js" async></script> -->
    <!-- <script src="js/plugins-min.js" async></script> -->

    <script src="js/main-min.js"></script>

    <script type="text/javascript">

        var htmltag = document.getElementsByTagName('html');
        var langAttr = htmltag[0].getAttribute('lang');
        if (langAttr === "fr_CA")
        {
            document.write('<script src="js/vendor/jqueryValidate/localization/messages_fr.min.js" async defer><\/script>')
        }
        // Default jQuery Validate labels to english


        // reCAPTCHA api
        if($('#captcha').length)
        {
            var widgetId1;
            var c_theme = $("body").hasClass("th-light") ? "light" : "dark";
            var onloadCallback = function() {
                widgetId1 = grecaptcha.render('captcha', {
                    'sitekey' : '6LfS5ggTAAAAAERF8SrqqTaWKt4nYpvh0nCwiEmT',
                    'theme' : c_theme
                });
            };

            if (langAttr === "fr_CA")
            {
                document.write('<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit&hl=fr-CA" async defer><\/script>')
            }
            // Default ot english
            else
            {
                document.write('<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer><\/script>')
            }
        }

    </script>

</body>
</html>
