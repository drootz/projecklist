<div class="view-register th-divider">

    <form id="register" method="post" action="?" autocomplete="off">
        <div class="m-login">
            <fieldset>

                <h3><?= _( 'Register' ); ?></h3>

                <div id="js-form-output" class="m-form-output"></div>

                <fieldset>
                    <div class="row">
                        <div class="col-pad-12">
                            <input type="email" name="fld_register_email" id="f-register-email" required aria-required="true" placeholder="Email" maxlength="50" autocomplete="off" <?= isset($transferData) ? "value=\"" . $transferData . "\"" : "" ?> />
                        </div>
                        <div class="col-pad-12">
                            <input type="email" name="fld_register_email_confirm" id="f-register-email-confirm" required aria-required="true" placeholder="Confirm Email" maxlength="50" autocomplete="off" />
                        </div>
                        <div class="col-pad-12">
                            <input type="text" name="fld_register_fn" id="f-register-fn" required aria-required="true" placeholder="First Name" maxlength="50" autocomplete="off" />
                        </div>
                        <div class="col-pad-12">
                            <input type="text" name="fld_register_ln" id="f-register-ln" required aria-required="true" placeholder="Last Name" maxlength="50" autocomplete="off" />
                        </div>
                        <div class="col-pad-12">
                            <input type="password" name="fld_register_psw" id="f-register-password" required aria-required="true" placeholder="Password" maxlength="50" />
                        </div>
                        <div class="col-pad-12">
                            <input type="password" name="fld_register_psw_confirm" id="f-register-psw-confirm" required aria-required="true" placeholder="Confirm Password" maxlength="50" />
                        </div>
                    </div> <!-- .row END -->

                </fieldset>

                <div class="m-center-block">
                    <div id="captcha"></div>
                </div>

                <div class="m-login-button">
                    <br />
                    <button class="button" type="submit" value="submit" name="submit">Register</button>
                    <span>&nbsp;or&nbsp;&nbsp;<a href="login.php">Sign in</a></span>
                </div>

            </fieldset>
        </div>
    </form>

</div>