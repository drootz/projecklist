<div class="view-delete th-divider">

    <form id="delete" method="post" action="?" autocomplete="off">
        <div class="m-login">
            <fieldset>

                <h3><?= _( 'Delete Account' ); ?></h3>

                <!-- <div id="js-form-output" class="m-form-output"></div> -->

                <fieldset>
                    <div class="row">
                        <div class="col-pad-12">
                            <p><?= _( 'Are you sure you want to delete your account and along with all its data? This action is defenitive and the information can\'t be recovered.' ); ?></p>
                            <button id="js-delete-cancelbtn" class="button"><?= _("Cancel"); ?></button>
                            <hr />
                            <p><?= _( 'Please let us know why your are leaving us so we can get better and get you back!' ); ?></p>

                            <input type="number" class="visuallyhidden" name="fld_delete_key" id="f-delete-key" required aria-required="true" value="<?= $key ?>" maxlength="500" />

                            <textarea name="txt_profile_delete" id="f-profile-delete" rows="2" maxlength="500"></textarea>
                        </div>
                    </div> <!-- .row END -->
                </fieldset>

                <div class="m-login-button">
                    <br/>
                    <button class="button" type="submit" value="submit" id="f-delete-account" name="submit"><?= _("Delete Now"); ?></button>
                </div>

            </fieldset>
        </div>
    </form>

</div>