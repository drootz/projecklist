<div class="view-login th-divider">
    
    <form id="login" method="post" action="?" autocomplete="off">
    <!-- <form action="login.php" method="post"> -->

            <div class="m-login">
                <fieldset>

                    <h3><?php echo _( 'Sign in' ); ?></h3>

                    <fieldset>
                        <div class="row">
                            <div class="col-pad-12">
                                <input type="email" name="fld_login_email" id="f-login-email" required aria-required="true" placeholder="Email" maxlength="50" autocomplete="off" />
                            </div>
                            <div class="col-pad-12">
                                <input type="password" name="fld_login_psw" id="f-login-psw" required aria-required="true" placeholder="Password" maxlength="50" />
                            </div>
                        </div> <!-- .row END -->

                    </fieldset>

                    <div class="m-login-button">
                        <br/>
                        <button class="button" type="submit" value="Submit" id="f-submit" name="submit">Sign in</button>
                        <span>&nbsp;or&nbsp;&nbsp;<a href="register.php">Register</a></span>
                    </div>

                    <!-- Will output the RECAPTCHA results from process.php here -->
                    <div id="results-container">
                        <div id="results"></div>
                    </div>

                </fieldset>
            </div>
        

    </form>

</div>