<div class="view-contact th-divider">

    <form id="contact" method="post" action="?" autocomplete="off">
        <div class="m-login">
            <fieldset>

                <h3><?= _( 'Contact Us' ); ?></h3>

                <!-- <div id="js-form-output" class="m-form-output"></div> -->

                <fieldset>
                    <div class="row">
                        <div class="col-pad-12">

                            <select style="width: 100%;" name="opt_reason" id="f-contact-reason" required>
                                <option disabled selected><?= _(" -- select an option -- "); ?></option>
                                <option <?= _("value=\"General Inquiry\""); ?>><?= _('Genreal Inquiry'); ?></option>
                            </select>

                            <textarea name="txt_contact" id="f-contact-text" rows="3" maxlength="500" required ></textarea>

                        </div>
                    </div> <!-- .row END -->
                </fieldset>

                <div class="m-login-button">
                    <button class="button" type="submit" value="submit" id="f-contact-submit" name="submit"><?= _("Submit"); ?></button>
                </div>
                
                <input type="number" class="visuallyhidden" name="fld_contact_id" id="f-contact-id" required aria-required="true" value="<?= $_SESSION['id'] ?>" maxlength="6" />

            </fieldset>
        </div>
    </form>

</div>