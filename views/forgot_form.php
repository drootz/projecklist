<div class="view-forgot th-divider">

    <form id="forgot" method="post" action="?" autocomplete="off">
        <div class="m-login">
            <fieldset>

                <h3><?= _( 'Forgot your password?' ); ?></h3>

                <div id="js-form-output" class="m-form-output"></div>

                <fieldset>
                    <div class="row">
                        <div class="col-pad-12">
                            <p><?= _( 'Enter your email address to reset your password. You may need to check your spam folder or unblock the "no-reply" email address.' ); ?></p>
                            <input type="email" name="fld_login_email" id="f-login-email" required aria-required="true" <?= _("placeholder=\"Email\""); ?> maxlength="50" autocomplete="off" />
                        </div>
                    </div> <!-- .row END -->
                </fieldset>

                <div class="m-center-block">
                    <div id="captcha"></div>
                </div>

                <div class="m-login-button">
                    <br/>
                    <button class="button" type="submit" value="submit" name="submit"><?= _("Submit"); ?></button>
                </div>

            </fieldset>
        </div>
    </form>

</div>