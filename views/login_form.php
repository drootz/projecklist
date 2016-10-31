<div class="view-login th-divider">
    
    <form id="login" method="post" action="?" autocomplete="off">
        <div class="m-login">
            <fieldset>

                <h3><?= _( 'Sign in' ); ?></h3>

                <div id="js-form-output" class="m-form-output"></div>

                <fieldset>
                    <div class="row">
                        <div class="col-pad-12">
                            <?php if (isset($user_email)): ?> 
                                <input type="email" name="fld_login_email" id="f-login-email" required aria-required="true" <?= _("placeholder=\"Email\""); ?> maxlength="50" autocomplete="off" value="<?= $user_email ?>" />
                            <?php else: ?>
                                <input type="email" name="fld_login_email" id="f-login-email" required aria-required="true" placeholder="<?= _('Email'); ?>" maxlength="50" autocomplete="off" />
                            <?php endif; ?>
                        </div>
                        <div class="col-pad-12">
                            <input type="password" name="fld_login_psw" id="f-login-psw" required aria-required="true" <?= _("placeholder=\"Password\""); ?> maxlength="50" />
                        </div>
                    </div> <!-- .row END -->

                </fieldset>

                <div class="m-login-button">
                    <br/>
                    <button class="button" type="submit" value="submit" name="submit"><?= _("Sign in"); ?></button>
                    <span>&nbsp;<?= _("or"); ?>&nbsp;&nbsp;<a href="register.php"><?= _("Register"); ?></a></span>
                    <div><span><a href="forgot.php"><?= _("Forgot your password?"); ?></a></span></div>
                </div>

            </fieldset>

        </div>
    </form>

</div>