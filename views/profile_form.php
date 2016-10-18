<div class="view-profile th-divider">
    <div class="m-profile">
        
        <h3><?php echo _( 'Profile' ); ?></h3>

        <div class="row">
            <div class="col-pad-06">
                <div><span class="js-profile-fn"><?= $firstname ?></span> <span class="js-profile-ln"><?= $lastname ?></span></div>
                <div><a class="js-profile-changebtn" href="#">change</a></div>
            </div>
            <div class="col-pad-06">
                <form id="profile-name" class="is-hidden" method="post" action="?" autocomplete="off">
                    <fieldset>
                        <input type="text" name="fld_profile_fn" id="f-profile-fn" required aria-required="true" placeholder="First Name" value="<?= $firstname ?>" maxlength="50" autocomplete="off" tabindex="1" />
                        <input type="text" name="fld_profile_ln" id="f-profile-ln" required aria-required="true" placeholder="Last Name" value="<?= $lastname ?>" maxlength="50" autocomplete="off" tabindex="2" />
                    </fieldset>
                    <button type="submit" class="button" name="save" value="name" tabindex="3">Save</button>
                    <button class="button js-profile-cancelbtn" name="cancel" tabindex="4">Cancel</button>
                </form>
                <div id="js-result-name" class="js-result is-hidden"><span></span></div>
            </div>
        </div>

        <div class="row">
            <div class="col-pad-06">
                <div><span class="m-profile-subttl"><?php echo _( 'Login email' ); ?></span></div>
                <div><span class="js-profile-email"><?= $email ?></span></div>
                <div><a class="js-profile-changebtn" href="#">change</a></div>
            </div>
            <div class="col-pad-06">
                <form id="profile-email" class="is-hidden" method="post" action="?" autocomplete="off">
                    <fieldset>
                        <input type="email" name="fld_profile_email" id="f-profile-email" required aria-required="true" placeholder="New Email" maxlength="50" autocomplete="off" tabindex="5" />
                        <input type="email" name="fld_profile_email_confirm" id="f-profile-email-confirm" required aria-required="true" placeholder="Confirm Email" maxlength="50" autocomplete="off" tabindex="6" />
                        <input type="password" name="fld_profile_email_psw" id="f-profile-email-password" required aria-required="true" placeholder="Password" maxlength="50" tabindex="7" />
                    </fieldset>
                    <button type="submit" class="button" name="save" value="email" tabindex="8">Save</button>
                    <button class="button js-profile-cancelbtn" name="cancel" tabindex="9">Cancel</button>
                </form>
                <div id="js-result-email" class="js-result is-hidden"><span></span></div>
            </div>
        </div>

        <div class="row">
            <div class="col-pad-06">
                <div><a class="js-profile-changebtn" href="#">Change Password</a></div>
                <div><span><a href="forgot.php"><?php echo _( 'Forgot Password?' ); ?></a></span></div>
            </div>
            <div class="col-pad-06">
                <form id="profile-password" class="is-hidden" method="post" action="?" autocomplete="off">
                    <fieldset>
                        <input type="password" name="fld_profile_current_psw" id="f-profile-current-password" required aria-required="true" placeholder="Current Password" maxlength="50" tabindex="10" />
                        <input type="password" name="fld_profile_new_psw" id="f-profile-new-password" required aria-required="true" placeholder="New Password" maxlength="50" tabindex="11" />
                        <input type="password" name="fld_profile_psw_confirm" id="f-profile-psw-confirm" required aria-required="true" placeholder="Confirm Password" maxlength="50" tabindex="12" />
                    </fieldset>
                    <button type="submit" class="button" name="save" value="password" tabindex="13">Save</button>
                    <button class="button js-profile-cancelbtn" name="cancel" tabindex="14">Cancel</button>
                </form>
                <div id="js-result-password" class="js-result is-hidden"><span><?= $notification ?></span></div>
            </div>
        </div> <!-- .row END -->

        <div class="row">
            <div class="col-pad-12">
                <hr />
            </div>
        </div>

        <div class="row">
            <div class="col-pad-06">
                <div><a class="js-profile-changebtn" href="#">Delete Account</a></div>
            </div>
            <div class="col-pad-06">
                <form id="profile-delete" class="is-hidden" method="post" action="?" autocomplete="off">
                    <fieldset>
                        <label for="f-profile-psw-delete" class="m-sub-inputlabel"><?= _( 'Enter password to delete your account' ); ?></label>
                        <input type="password" name="fld_profile_psw_delete" id="f-profile-psw-delete" required aria-required="true" placeholder="Password" maxlength="50" tabindex="15" />
                    </fieldset>
                    <button type="submit" class="button" name="save" value="delete" tabindex="16">Delete</button>
                    <button class="button js-profile-cancelbtn" name="cancel" tabindex="17">Cancel</button>
                </form>
                <div id="js-result-delete" class="js-result is-hidden error"><span><?= $notification ?></span></div>
            </div>
        </div> <!-- .row END -->

    </div>
    <div class="l-wrapper">
            <div id="js-form-output" class="m-form-output"></div>
    </div>
</div>