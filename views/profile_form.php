<div class="view-profile th-divider">
    <div class="m-profile">
        
        <h3><?= _( 'Profile' ); ?></h3>

        <div class="row">
            <div class="col-pad-06">
                <div><span class="js-profile-fn"><?= $firstname ?></span> <span class="js-profile-ln"><?= $lastname ?></span></div>
                <div><a class="js-profile-changebtn" href="#"><?= _("change"); ?></a></div>
            </div>
            <div class="col-pad-06">
                <form id="profile-name" class="is-hidden" method="post" action="?" autocomplete="off">
                    <fieldset>
                        <input type="text" name="fld_profile_fn" id="f-profile-fn" required aria-required="true" placeholder="First Name" value="<?= $firstname ?>" maxlength="50" autocomplete="off"  />
                        <input type="text" name="fld_profile_ln" id="f-profile-ln" required aria-required="true" placeholder="Last Name" value="<?= $lastname ?>" maxlength="50" autocomplete="off"  />
                    </fieldset>
                    <button type="submit" class="button" name="save" value="name" ><?= _("Save"); ?></button>
                    <button class="button js-profile-cancelbtn" name="cancel" ><?= _("Cancel"); ?></button>
                </form>
                <div id="js-result-name" class="js-result is-hidden"><span></span></div>
            </div>
        </div>

        <div class="row">
            <div class="col-pad-06">
                <div><span class="m-profile-subttl"><?= _( 'Login email' ); ?></span></div>
                <div><span class="js-profile-email"><?= $email ?></span></div>
                <div><a class="js-profile-changebtn" href="#"><?= _("change"); ?></a></div>
            </div>
            <div class="col-pad-06">
                <form id="profile-email" class="is-hidden" method="post" action="?" autocomplete="off">
                    <fieldset>
                        <input type="email" name="fld_profile_email" id="f-profile-email" required aria-required="true" <?= _("placeholder=\"New Email\""); ?> maxlength="50" autocomplete="off"  />
                        <input type="email" name="fld_profile_email_confirm" id="f-profile-email-confirm" required aria-required="true" <?= _("placeholder=\"Confirm Email\""); ?> maxlength="50" autocomplete="off"  />
                        <input type="password" name="fld_profile_email_psw" id="f-profile-email-password" required aria-required="true" <?= _("placeholder=\"Password\""); ?> maxlength="50"  />
                    </fieldset>
                    <button type="submit" class="button" name="save" value="email" ><?= _("Save"); ?></button>
                    <button class="button js-profile-cancelbtn" name="cancel" ><?= _("Cancel"); ?></button>
                </form>
                <div id="js-result-email" class="js-result is-hidden"><span></span></div>
            </div>
        </div>

        <div class="row">
            <div class="col-pad-06">
                <div><span class="m-profile-subttl"><?= _( 'Prefered Language' ); ?></span></div>
                <div><span class="js-profile-lang"><?= array_search($language, $_SESSION['form_PO_support']) ?></span></div>
                <div><a class="js-profile-changebtn" href="#"><?= _("change"); ?></a></div>
            </div>
            <div class="col-pad-06">
                <form id="profile-lang" class="is-hidden" method="post" action="?" autocomplete="off">
                    <fieldset>
                        <?= setLangPreference(); ?>
                    </fieldset>
                    <button type="submit" class="button" name="save" value="lang" ><?= _("Save"); ?></button>
                    <button class="button js-profile-cancelbtn" name="cancel" ><?= _("Cancel"); ?></button>
                </form>
                <div id="js-result-lang" class="js-result is-hidden"><span></span></div>
            </div>
        </div>

        <div class="row">
            <div class="col-pad-06">
                <div><a class="js-profile-changebtn" href="#"><?= _("Change Password"); ?></a></div>
                <div><span><a href="forgot.php"><?= _( 'Forgot Password?' ); ?></a></span></div>
            </div>
            <div class="col-pad-06">
                <form id="profile-password" class="is-hidden" method="post" action="?" autocomplete="off">
                    <fieldset>
                        <input type="password" name="fld_profile_current_psw" id="f-profile-current-password" required aria-required="true" <?= _("placeholder=\"Current Password\""); ?> maxlength="50" tabindex="10" />
                        <input type="password" name="fld_profile_new_psw" id="f-profile-new-password" required aria-required="true" <?= _("placeholder=\"New Password\""); ?> maxlength="50" tabindex="11" />
                        <input type="password" name="fld_profile_psw_confirm" id="f-profile-psw-confirm" required aria-required="true" <?= _("placeholder=\"Confirm Password\""); ?> maxlength="50" tabindex="12" />
                    </fieldset>
                    <button type="submit" class="button" name="save" value="password" tabindex="13"><?= _("Save"); ?></button>
                    <button class="button js-profile-cancelbtn" name="cancel" tabindex="14"><?= _("Cancel"); ?></button>
                </form>
                <div id="js-result-password" class="js-result is-hidden"><span><?= $notification ?></span></div>
            </div>
        </div> <!-- .row END -->

        <div class="row">
            <div class="col-pad-06">
                <div><span><a href="contact.php"><?= _( 'Contact Us' ); ?></a></span></div>
            </div>
        </div> <!-- .row END -->


        <div class="row">
            <div class="col-pad-12">
                <hr />
            </div>
        </div>

        <div class="row">
            <div class="col-pad-06">
                <div><a class="js-profile-changebtn" href="#"><?= _("Delete Account"); ?></a></div>
            </div>
            <div class="col-pad-06">
                <form id="profile-delete" class="is-hidden" method="post" action="?" autocomplete="off">
                    <fieldset>
                        <label for="f-profile-psw-delete" class="m-sub-inputlabel"><?= _( 'Enter password to delete your account' ); ?></label>
                        <input type="password" name="fld_profile_psw_delete" id="f-profile-psw-delete" required aria-required="true" <?= _("placeholder=\"Password\""); ?> maxlength="50" tabindex="15" />
                    </fieldset>
                    <button type="submit" class="button" name="save" value="delete" tabindex="16"><?= _("Delete"); ?></button>
                    <button class="button js-profile-cancelbtn" name="cancel" tabindex="17"><?= _("Cancel"); ?></button>
                </form>
                <div id="js-result-delete" class="js-result is-hidden error"><span><?= $notification ?></span></div>
            </div>
        </div> <!-- .row END -->

    </div>
    <div class="l-wrapper">
            <div id="js-form-output" class="m-form-output"></div>
    </div>
</div>