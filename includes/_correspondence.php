<?php
/**
 * File name: functions.php
 *
 * This file is part of PROJECKLIST
 *
 * @author Daniel Racine <mailto.danielracine@gmail.com>
 * @link --
 * @package PROJECKLIST
 * @version 1
 *
 * Copyright (c) 2016 Daniel Racine
 * You should have received a copy of the MIT License
 * along with PROJECKLIST. If not, see <https://en.wikipedia.org/wiki/MIT_License>.
 */


    require_once("../vendor/PHPMailer/PHPMailerAutoload.php"); 


    function notificationMail($info) {

        //format each email
        $_body = formatNotificationEmail($info,'html');
        $_body_plain_txt = formatNotificationEmail($info,'txt');
        

        $mail = new PHPMailer();
        $mail->CharSet = 'UTF-8';
        // $mail->CharSet = 'ISO-8859-15';
        
                              
        //Set PHPMailer to use SMTP.
        $mail->isSMTP();            
        //Set SMTP host name                          
        $mail->Host = "smtp.gmail.com";
        //Set this to true if SMTP host requires authentication to send email
        $mail->SMTPAuth = true;                          
        //Provide username and password     
        $mail->Username = "noreply.tetsingstuff@gmail.com";                 
        $mail->Password = "4gFg49CbAuowAC9msKNTyU82CFtdqEP2hcZsEMZU+7Wi8bsC3g";                           
        //If SMTP requires TLS encryption then set it
        $mail->SMTPSecure = "tls";                           
        //Set TCP port to connect to 
        $mail->Port = 587;      

        $mail->setFrom('noreply.tetsingstuff@gmail.com', 'Projecklist');


        if (isset($info['email']) && isset($info['username']))
        {
            $mail->addAddress($info['email'], $info['username']);
        }
        else
        {
            userErrorHandler(0, '_correspondence.php', 'no email and username specified');
            exit;
        }

        // If this is a "contact us" correspondence, change the reply email
        if (isset($info['bcc_projecklist']) && $info['bcc_projecklist'])
        {
            $eml = 'projecklist@gmail.com';
            $mail->addReplyTo($eml, 'Projecklist');
            $mail->addBCC($eml);
        }


        $mail->isHTML(true);

        if (isset($info['subject']))
        {
            $mail->Subject = $info['subject'];
        }
        else
        {
            $mail->Subject = "Notification";
        }


        $mail->Body    = $_body;
        $mail->AltBody = $_body_plain_txt;


        $attach_dir = __DIR__.'/send/';
        if (isset($info['f_txt']))
        {   
            $mail->addAttachment($attach_dir.$info['f_txt']);
        }

        if (isset($info['f_md']))
        {
            $mail->addAttachment($attach_dir.$info['f_md']);
        }

        // Send Mail
        if(!$mail->send())
        {
            return false;
        } 
        else 
        {
            
            if (isset($info['f_txt']))
            {
                unlink($attach_dir.$info['f_txt']);
            }

            if (isset($info['f_md']))
            {
                unlink($attach_dir.$info['f_md']);
            }

            return true;
        }
    }

    function formatNotificationEmail($info, $format) {
     
        //set the root
        // Store DEV server root
        // $server_root = 'http://dracine.local/~dracine/xdev/projecklist/mail';
        if (isset($info['locale']))
        {
            $server_root = dirname(__FILE__) . '/correspondence/locales/' . $info['locale'];
        }
        else
        {
            $server_root = dirname(__FILE__) . '/correspondence/locales/en_CA';
        }
     
        //grab the template content
        if (isset($info['template']))
        {
            $template = file_get_contents($server_root.'/' . $info['template'] . '.' . $format);
        }
        else
        {
            userErrorHandler(0, '_correspondence.php', 'no email template specified');
            exit;
        }
                 
        //replace all the tags
        if (isset($info['username']))
        {
            $template = preg_replace('/{USERNAME}/', $info['username'], $template);
        }

        if (isset($info['email']))
        {
            $template = preg_replace('/{EMAIL}/', $info['email'], $template);
        }

        if (isset($info['key']))
        {
            $template = preg_replace('/{KEY}/', $info['key'], $template);
        }

        if (isset($info['psw']))
        {
            $template = preg_replace('/{PSW}/', $info['psw'], $template);
        }

        if (isset($info['altemail']))
        {
            $template = preg_replace('/{ALTEMAIL}/', $info['altemail'], $template);
        }

        if (isset($info['locale']))
        {
            $template = preg_replace('/{LOCALE}/', $info['locale'], $template);
        }

        if (isset($info['reason']))
        {
            $template = preg_replace('/{REASON}/', $info['reason'], $template);
        }

        if (isset($info['correspondence']))
        {
            $template = preg_replace('/{CORR}/', $info['correspondence'], $template);
        }

        if (isset($info['pref']))
        {
            $template = preg_replace('/{PROJECTREF}/', $info['pref'], $template);
        }

        if (isset($info['pname']))
        {
            $template = preg_replace('/{PROJECTNAME}/', $info['pname'], $template);
        }

        $template = preg_replace('/{SITEPATH}/','http://www.projecklist.oneprojct.space', $template);
        $template = preg_replace('/{YEAR}/', date('Y'), $template);
        $template = preg_replace('/{ADMIN_EMAIL}/', 'projecklist@gmail.com', $template);
             
        //return the html of the template
        return $template;
     
    }


    function formatAttachment($arr, $extension) {

        if ($extension !== "txt" && $extension !== "md")
        {
            return false;
        }

        $spx1 = " ";
        $spx2 = "  ";
        $spx3 = "   ";
        $spx4 = "    ";
        $nlx1 = "  \r\n";
        $nlx2 = $nlx1.$nlx1;
        $nlx3 = $nlx1.$nlx1.$nlx1;
        $nlx4 = $nlx1.$nlx1.$nlx1.$nlx1;
        $ttl = "# ";
        $h1 = "## ";
        $h2 = "### ";
        $h3 = "#### ";
        $bullet = "- ";
        $pad = "    ";
        $spliter = "";

        // Beging of content line
        $cnt = "";

        $txtOut = "";
        if ($extension === 'txt')
        {
            $pad = "    ";
            $spliter = "";
            $mdbr = $nlx1;
            $mdpad = "    ";
        }
        else if ($extension === 'md')
        {
            $pad = "";
            $spliter = "***";
            $mdbr = "<br>" . $nlx1;
            $mdpad = "    ";
        }

        /**********************/

        $txtOut .= $ttl . $arr['fld_project_name'] . $nlx1;
        if (isset($arr['projeckt_ref'])) { $txtOut .= $arr['projeckt_ref'] . $nlx1; }
        $txtOut .= $nlx2;

        


        if ($extension === 'md')
        {
            $txtOut .= $nlx2;
            $txtOut .= $h1 . _( 'Table of Contents' ) . $nlx1;
            $txtOut .= "1. [" . strtoupper(_( 'form-planning-ttl' )) . "](#" . strtolower(_( 'form-planning-ttl' )) . ")" . $nlx1;
            $txtOut .= "2. [" . strtoupper(_( 'form-design-ttl' )) . "](#" . strtolower(_( 'form-design-ttl' )) . ")" . $nlx1;
            $txtOut .= "3. [" . strtoupper(_( 'form-technology-ttl' )) . "](#" . strtolower(_( 'form-technology-ttl' )) . ")" . $nlx1;
            $txtOut .= $nlx2;
        }



        /**********************/

        $txtOut .= $nlx2;
        $txtOut .= $h1 . _( 'form-planning-ttl' ) . $nlx1;
        $txtOut .= $spliter . $nlx1;
        $txtOut .= $nlx1;

        /**********************/

        $txtOut .= $h2 . _('form-planning-contact-ttl') . $nlx1;
        $txtOut .= $nlx1;
        $txtOut .= $h3 . _('form-planning-contact-primary-ttl') . $nlx1;
        $txtOut .= $cnt; if ($arr['fld_contact_primary_fn'] !== "n/a") { $txtOut .= $arr['fld_contact_primary_fn']; } $txtOut .= $spx1; if ($arr['fld_contact_primary_ln'] !== "n/a") { $txtOut .= $arr['fld_contact_primary_ln']; } $txtOut .= $nlx1;
        $txtOut .= $cnt . _("Phone: "); if ($arr['tel_contact_primary_tel'] !== "n/a") {      $txtOut .= $arr['tel_contact_primary_tel']; }   $txtOut .= $nlx1;
        $txtOut .= $cnt . _("Email: "); if ($arr['eml_contact_primary_email'] !== "n/a") {    $txtOut .= $arr['eml_contact_primary_email']; } $txtOut .= $nlx1;
        $txtOut .= $nlx1;

        /**********************/

        $txtOut .= $h3 . _('form-planning-contact-alternate-ttl') . $nlx1;
        $txtOut .= $cnt; if ($arr['fld_contact_alt_fn'] !== "n/a") { $txtOut .= $arr['fld_contact_alt_fn']; } $txtOut .= $spx1; if ($arr['fld_contact_alt_ln'] !== "n/a") { $txtOut .= $arr['fld_contact_alt_ln']; } $txtOut .= $nlx1;
        $txtOut .= $cnt . _("Phone: "); if ($arr['tel_contact_alt_contact_tel'] !== "n/a") {  $txtOut .= $arr['tel_contact_alt_contact_tel']; }   $txtOut .= $nlx1;
        $txtOut .= $cnt . _("Email: "); if ($arr['eml_contact_alt_email'] !== "n/a") {        $txtOut .= $arr['eml_contact_alt_email']; }         $txtOut .= $nlx1;
        $txtOut .= $nlx2;

        /**********************/

        $txtOut .= $h2 . _('form-planning-familiarity-ttl') . $nlx1;
        $txtOut .= $nlx1;
        $txtOut .= $cnt . $arr['opt_familiarity'] . $nlx1;
        $txtOut .= $nlx2;

        /**********************/

        $txtOut .= $h2 . _('form-planning-timeline-ttl') . $nlx1;
        $txtOut .= $nlx1;
        $txtOut .= $cnt . $arr['opt_timeline'] . $nlx1;
        $txtOut .= $nlx2;

        /**********************/

        $txtOut .= $h2 . _('form-planning-budget-ttl') . $nlx1;
        $txtOut .= $nlx1;
        $txtOut .= $cnt . $arr['opt_budget'] . $nlx1;
        $txtOut .= $nlx2;

        /**********************/

        $txtOut .= $h2 . _('form-planning-billing-ttl') . $nlx1;
        $txtOut .= $nlx1;
        $txtOut .= $h3 . _('form-planning-billing-stl-attn') . $nlx1;
        $txtOut .= $cnt; if ($arr['fld_billing_fn'] !== "n/a") {      $txtOut .= $arr['fld_billing_fn']; }     $txtOut .= $spx1; if ($arr['fld_billing_ln'] !== "n/a") { $txtOut .= $arr['fld_billing_ln']; } $txtOut .= $nlx1;
        $txtOut .= $cnt; if ($arr['fld_billing_coname'] !== "n/a") {  $txtOut .= $arr['fld_billing_coname']; } $txtOut .= $nlx1;
        $txtOut .= $cnt; if ($arr['fld_billing_area'] !== "n/a") {    $txtOut .= $arr['fld_billing_area']; }   $txtOut .= $nlx1;
        $txtOut .= $cnt . _("Phone: "); if ($arr['tel_billing_tel'] !== "n/a") {      $txtOut .= $arr['tel_billing_tel']; }   $txtOut .= $nlx1;
        $txtOut .= $cnt . _("Fax: ");   if ($arr['tel_billing_fax'] !== "n/a") {      $txtOut .= $arr['tel_billing_fax']; }   $txtOut .= $nlx1;
        $txtOut .= $cnt . _("Email: "); if ($arr['eml_billing_email'] !== "n/a") {    $txtOut .= $arr['eml_billing_email']; } $txtOut .= $nlx1;
        $txtOut .= $nlx1;

        /**********************/

        $txtOut .= $h3 . _('form-planning-billing-stl-address') . $nlx1;

        $i = 0;
        if ($arr['fld_billing_address'] !== "n/a") {     $i++; $txtOut .= $cnt . $arr['fld_billing_address'] . $nlx1; }
        if ($arr['fld_billing_address_2'] !== "n/a") {   $i++; $txtOut .= $cnt . $arr['fld_billing_address_2'] . $nlx1; }
        
        if ($arr['fld_billing_city'] !== "n/a") {        $i++; $txtOut .= $cnt . $arr['fld_billing_city'] . "," . $spx1; }
        if ($arr['fld_billing_province'] !== "n/a") {    $i++; $txtOut .= $cnt . $arr['fld_billing_province'] . $spx2; }
        if ($arr['fld_billing_postalcode'] !== "n/a") {  $i++; $txtOut .= $cnt . $arr['fld_billing_postalcode']; }
        if ($arr['fld_billing_country'] !== "n/a") {     $i++; $txtOut .= $cnt . $arr['fld_billing_country']; }
        
        if ($i == 0) { $txtOut .= $cnt . "n/a" . $nlx1; }
        $txtOut .= $nlx2;

        /**********************/

        $i = 0;
        $txtOut .= $h2 . _('form-content-info-ttl') . $nlx1;
        $txtOut .= $nlx1;
        $txtOut .= $cnt . _('fld_info_legal');      if ($arr['fld_info_legal'] !== "n/a") {   $i++; $txtOut .= $spx1 . $arr['fld_info_legal'] . $nlx1; } else { $txtOut .= $nlx1; }
        $txtOut .= $cnt . _('fld_info_brand');      if ($arr['fld_info_brand'] !== "n/a") {   $i++; $txtOut .= $spx1 . $arr['fld_info_brand'] . $nlx1; } else { $txtOut .= $nlx1; }
        $txtOut .= $cnt . _('fld_info_tagline');    if ($arr['fld_info_tagline'] !== "n/a") { $i++; $txtOut .= $spx1 . $arr['fld_info_tagline'] . $nlx1; } else { $txtOut .= $nlx1; }
        $txtOut .= $cnt . _("Phone:");              if ($arr['tel_info_tel'] !== "n/a") {     $i++; $txtOut .= $spx1 . $arr['tel_info_tel'] . $nlx1; } else { $txtOut .= $nlx1; }
        $txtOut .= $cnt . _("Fax:");                if ($arr['tel_info_fax'] !== "n/a") {     $i++; $txtOut .= $spx1 . $arr['tel_info_fax'] . $nlx1; } else { $txtOut .= $nlx1; }
        $txtOut .= $cnt . _("Email:");              if ($arr['eml_info_email'] !== "n/a") {   $i++; $txtOut .= $spx1 . $arr['eml_info_email'] . $nlx1; } else { $txtOut .= $nlx1; }
        $txtOut .= $nlx1;

        $txtOut .= $h3 . _('form-content-info-adress-stl') . $nlx1;
        if ($arr['fld_info_address'] !== "n/a") {     $i++; $txtOut .= $cnt . $arr['fld_info_address'] . $nlx1; }
        if ($arr['fld_info_address_2'] !== "n/a") {   $i++; $txtOut .= $cnt . $arr['fld_info_address_2'] . $nlx1; }
        
        $j = 0;
        if ($arr['fld_info_city'] !== "n/a") {        $i++; $j++; $txtOut .= $cnt . $arr['fld_info_city'] . "," . $spx1; }
        if ($arr['fld_info_province'] !== "n/a") {    $i++; $j++; $txtOut .= $cnt . $arr['fld_info_province'] . $spx2; }
        if ($arr['fld_info_postalcode'] !== "n/a") {  $i++; $j++; $txtOut .= $cnt . $arr['fld_info_postalcode']; }
        if ($j != 0) { $txtOut .= $nlx1; }
        
        if ($arr['fld_info_postalcode'] !== "n/a") {  $i++; $txtOut .= $cnt . $arr['fld_info_country'] . $nlx1; }
        if ($i == 0) { $txtOut .= $cnt . "n/a" . $nlx1; }
        $txtOut .= $nlx1;

        $txtOut .= $h3 . _('txt_info_description') . $nlx1;
        $txtOut .= $cnt . $arr['txt_info_description'] . $nlx1;
        $txtOut .= $nlx2;

        /**********************/

        $i = 0;
        $txtOut .= $h2 . _( 'form-content-hours-ttl' ) . $nlx1;
        $txtOut .= $nlx1;
        if ($arr['hra_hours_1'] !== "n/a")
        {
            $i++;
            $txtOut .= $cnt . $arr['hra_hours_1'] . $nlx1;
            $txtOut .= $cnt . $arr['hra_hours_1_hours'] . $nlx1;
            $txtOut .= $nlx1;
        }
        if ($arr['hra_hours_2'] !== "n/a")
        {
            $i++;
            $txtOut .= $cnt . $arr['hra_hours_2'] . $nlx1;
            $txtOut .= $cnt . $arr['hra_hours_2_hours'] . $nlx1;
            $txtOut .= $nlx1;
        }
        if ($arr['hra_hours_3'] !== "n/a")
        {
            $i++;
            $txtOut .= $cnt . $arr['hra_hours_3'] . $nlx1;
            $txtOut .= $cnt . $arr['hra_hours_3_hours'] . $nlx1;
            $txtOut .= $nlx1;
        }
        if ($arr['hra_hours_4'] !== "n/a")
        {
            $i++;
            $txtOut .= $cnt . $arr['hra_hours_4'] . $nlx1;
            $txtOut .= $cnt . $arr['hra_hours_4_hours'] . $nlx1;
            $txtOut .= $nlx1;
        }
        if ($arr['hra_hours_5'] !== "n/a")
        {
            $i++;
            $txtOut .= $cnt . $arr['hra_hours_5'] . $nlx1;
            $txtOut .= $cnt . $arr['hra_hours_5_hours'] . $nlx1;
            $txtOut .= $nlx1;
        }
        if ($arr['hra_hours_6'] !== "n/a")
        {
            $i++;
            $txtOut .= $cnt . $arr['hra_hours_6'] . $nlx1;
            $txtOut .= $cnt . $arr['hra_hours_6_hours'] . $nlx1;
            $txtOut .= $nlx1;
        }
        if ($arr['hra_hours_7'] !== "n/a")
        {
            $i++;
            $txtOut .= $cnt . $arr['hra_hours_7'] . $nlx1;
            $txtOut .= $cnt . $arr['hra_hours_7_hours'] . $nlx1;
            $txtOut .= $nlx1;
        }
        if ($i == 0) { $txtOut .= $cnt . "n/a" . $nlx2; }
        $txtOut .= $nlx1;

        /**********************/

        $txtOut .= $h2 . _('form-content-holiday-ttl') . $nlx1;
        $txtOut .= $nlx1;
        $txtOut .= $cnt . $arr['txt_hours_holidays'] . $nlx1;
        $txtOut .= $nlx2;

        /**********************/

        $i = 0;
        $txtOut .= $h2 . _('form-content-product-ttl') . $nlx1;
        $txtOut .= $nlx1;
        if ($arr['fld_product_1'] !== "n/a") { $i++; $txtOut .= $cnt . $bullet . $arr['fld_product_1'] . $nlx1; }
        if ($arr['fld_product_2'] !== "n/a") { $i++; $txtOut .= $cnt . $bullet . $arr['fld_product_2'] . $nlx1; }
        if ($arr['fld_product_3'] !== "n/a") { $i++; $txtOut .= $cnt . $bullet . $arr['fld_product_3'] . $nlx1; }
        if ($i == 0) { $txtOut .= $cnt . "n/a" . $nlx1; }
        $txtOut .= $nlx2;

        /**********************/

        $i = 0;
        $txtOut .= $h2 . _('form-content-asset-ttl') . $nlx1;
        $txtOut .= $nlx1;
        if (isset($arr['rdo_existing_asset'])) {    $txtOut .= $cnt . $arr['rdo_existing_asset'] . $nlx2; } else { $txtOut .= $cnt . "n/a" . $nlx1; }
        if (isset($arr['cbx_asset_logo']) && $arr['cbx_asset_logo'] !== "n/a") {        $txtOut .= $cnt . $bullet . $arr['cbx_asset_logo'] . $nlx1; }
        if (isset($arr['cbx_asset_img']) && $arr['cbx_asset_img'] !== "n/a") {         $txtOut .= $cnt . $bullet . $arr['cbx_asset_img'] . $nlx1; }
        if (isset($arr['cbx_asset_audio']) && $arr['cbx_asset_audio'] !== "n/a") {       $txtOut .= $cnt . $bullet . $arr['cbx_asset_audio'] . $nlx1; }
        if (isset($arr['cbx_asset_video']) && $arr['cbx_asset_video'] !== "n/a") {       $txtOut .= $cnt . $bullet . $arr['cbx_asset_video'] . $nlx1; }
        if (isset($arr['cbx_asset_docs']) && $arr['cbx_asset_docs'] !== "n/a") {        $txtOut .= $cnt . $bullet . $arr['cbx_asset_docs'] . $nlx1; }
        if ($arr['txt_asset_othercomments'] !== "n/a")
        {
            $txtOut .= $cnt . $bullet . _( 'txt_asset_othercomments' ) . $nlx1;
            $txtOut .= $cnt . $pad . $arr['txt_asset_othercomments'] . $nlx1;
        }
        $txtOut .= $nlx2;

        /**********************/

        $i = 0;
        $txtOut .= $h2 . _('form-content-content-ttl') . $nlx1;
        $txtOut .= $nlx1;
        if (isset($arr['cbx_content_copywriting']) && $arr['cbx_content_copywriting'] !== "n/a") {   $i++; $txtOut .= $cnt . $bullet . $arr['cbx_content_copywriting'] . $nlx1; }
        if (isset($arr['cbx_content_graphicdesign']) && $arr['cbx_content_graphicdesign'] !== "n/a") { $i++; $txtOut .= $cnt . $bullet . $arr['cbx_content_graphicdesign'] . $nlx1; }
        if (isset($arr['cbx_content_photography']) && $arr['cbx_content_photography'] !== "n/a") {   $i++; $txtOut .= $cnt . $bullet . $arr['cbx_content_photography'] . $nlx1; }
        if (isset($arr['cbx_content_none']) && $arr['cbx_content_none'] !== "n/a") {          $i++; $txtOut .= $cnt . $bullet . $arr['cbx_content_none'] . $nlx1; }
        if ($arr['txt_content_othercomments'] !== "n/a")
        {
            $i++;
            $txtOut .= $cnt . $bullet . _( 'xxx_content_otherdetails' ) . $nlx1;
            $txtOut .= $cnt . $pad . $arr['txt_content_othercomments'] . $nlx1;
        }
        if ($i == 0) { $txtOut .= $cnt . "n/a" . $nlx1; }
        $txtOut .= $nlx2;

        /**********************/

        $i = 0;
        $txtOut .= $h2 . _('form-content-feature-ttl') . $nlx1;
        $txtOut .= $nlx1;
        if (isset($arr['cbx_feature_forum']) && $arr['cbx_feature_forum'] !== "n/a") { $i++; $txtOut .= $cnt . $bullet . $arr['cbx_feature_forum'] . ":" . $nlx1; }
        if (isset($arr['cbx_feature_forum']) && $arr['cbx_feature_forum'] !== "n/a")
        {
            if (isset($arr['txt_feature_forum'])) { $txtOut .= $cnt . $pad . $arr['txt_feature_forum'] . $nlx1; } //else { $txtOut .= $cnt . $pad . "no comment specified" . $nlx1; }  
            $txtOut .= $mdbr;
        }
        if (isset($arr['cbx_feature_login']) && $arr['cbx_feature_login'] !== "n/a") { $i++; $txtOut .= $cnt . $bullet . $arr['cbx_feature_login'] . ":" . $nlx1; }
        if (isset($arr['cbx_feature_login']) && $arr['cbx_feature_login'] !== "n/a")
        {
            if (isset($arr['txt_feature_login'])) { $txtOut .= $cnt . $pad . $arr['txt_feature_login'] . $nlx1; } //else { $txtOut .= $cnt . $pad . "no comment specified" . $nlx1; }
            $txtOut .= $mdbr;
        }
        if (isset($arr['cbx_feature_chart']) && $arr['cbx_feature_chart'] !== "n/a") { $i++; $txtOut .= $cnt . $bullet . $arr['cbx_feature_chart'] . ":" . $nlx1; }
        if (isset($arr['cbx_feature_chart']) && $arr['cbx_feature_chart'] !== "n/a")
        {
            if (isset($arr['txt_feature_chart'])) { $txtOut .= $cnt . $pad . $arr['txt_feature_chart'] . $nlx1; } //else { $txtOut .= $cnt . $pad . "no comment specified" . $nlx1; }
            $txtOut .= $mdbr;
        }
        if (isset($arr['cbx_feature_catalog']) && $arr['cbx_feature_catalog'] !== "n/a") { $i++; $txtOut .= $cnt . $bullet . $arr['cbx_feature_catalog'] . ":" . $nlx1; }
        if (isset($arr['cbx_feature_catalog']) && $arr['cbx_feature_catalog'] !== "n/a")
        {
            if (isset($arr['txt_feature_catalog'])) { $txtOut .= $cnt . $pad . $arr['txt_feature_catalog'] . $nlx1; } //else { $txtOut .= $cnt . $pad . "no comment specified" . $nlx1; }
            $txtOut .= $mdbr;
        }
        if (isset($arr['cbx_feature_comparechart']) && $arr['cbx_feature_comparechart'] !== "n/a") { $i++; $txtOut .= $cnt . $bullet . $arr['cbx_feature_comparechart'] . ":" . $nlx1; }
        if (isset($arr['cbx_feature_comparechart']) && $arr['cbx_feature_comparechart'] !== "n/a")
        {                                                                                                               
            if (isset($arr['txt_feature_comparechart'])) { $txtOut .= $cnt . $pad . $arr['txt_feature_comparechart'] . $nlx1; } //else { $txtOut .= $cnt . $pad . "no comment specified" . $nlx1; } 
            $txtOut .= $mdbr;                                                                               
        }                                                                                           
        if (isset($arr['cbx_feature_form']) && $arr['cbx_feature_form'] !== "n/a") { $i++; $txtOut .= $cnt . $bullet . $arr['cbx_feature_form'] . ":" . $nlx1; }
        if (isset($arr['cbx_feature_form']) && $arr['cbx_feature_form'] !== "n/a")
        {
            if (isset($arr['txt_feature_form'])) { $txtOut .= $cnt . $pad . $arr['txt_feature_form'] . $nlx1; } //else { $txtOut .= $cnt . $pad . "no comment specified" . $nlx1; }
            $txtOut .= $mdbr;
        }
        if (isset($arr['cbx_feature_advancedform']) && $arr['cbx_feature_advancedform'] !== "n/a") { $i++; $txtOut .= $cnt . $bullet . $arr['cbx_feature_advancedform'] . ":" . $nlx1; }
        if (isset($arr['cbx_feature_advancedform']) && $arr['cbx_feature_advancedform'] !== "n/a")
        {
            if (isset($arr['txt_feature_advancedform'])) { $txtOut .= $cnt . $pad . $arr['txt_feature_advancedform'] . $nlx1; } //else { $txtOut .= $cnt . $pad . "no comment specified" . $nlx1; }
            $txtOut .= $mdbr;
        }
        if (isset($arr['cbx_feature_animation']) && $arr['cbx_feature_animation'] !== "n/a") { $i++; $txtOut .= $cnt . $bullet . $arr['cbx_feature_animation'] . ":" . $nlx1; }
        if (isset($arr['cbx_feature_animation']) && $arr['cbx_feature_animation'] !== "n/a")
        {
            if (isset($arr['txt_feature_animation'])) { $txtOut .= $cnt . $pad . $arr['txt_feature_animation'] . $nlx1; } //else { $txtOut .= $cnt . $pad . "no comment specified" . $nlx1; }
            $txtOut .= $mdbr;
        }
        if (isset($arr['cbx_feature_search']) && $arr['cbx_feature_search'] !== "n/a") { $i++; $txtOut .= $cnt . $bullet . $arr['cbx_feature_search'] . ":" . $nlx1; }
        if (isset($arr['cbx_feature_search']) && $arr['cbx_feature_search'] !== "n/a")
        {
            if (isset($arr['txt_feature_search'])) { $txtOut .= $cnt . $pad . $arr['txt_feature_search'] . $nlx1; } //else { $txtOut .= $cnt . $pad . "no comment specified" . $nlx1; }
            $txtOut .= $mdbr;
        }
        if (isset($arr['cbx_feature_advancedsearch']) && $arr['cbx_feature_advancedsearch'] !== "n/a") { $i++; $txtOut .= $cnt . $bullet . $arr['cbx_feature_advancedsearch'] . ":" . $nlx1; }
        if (isset($arr['cbx_feature_advancedsearch']) && $arr['cbx_feature_advancedsearch'] !== "n/a")
        {
            if (isset($arr['txt_feature_advancedsearch'])) { $txtOut .= $cnt . $pad . $arr['txt_feature_advancedsearch'] . $nlx1; } //else { $txtOut .= $cnt . $pad . "no comment specified" . $nlx1; }
            $txtOut .= $mdbr;
        }
        if (isset($arr['cbx_feature_social']) && $arr['cbx_feature_social'] !== "n/a") { $i++; $txtOut .= $cnt . $bullet . $arr['cbx_feature_social'] . ":" . $nlx1; }
        if (isset($arr['cbx_feature_social']) && $arr['cbx_feature_social'] !== "n/a")
        {
            if (isset($arr['txt_feature_social'])) { $txtOut .= $cnt . $pad . $arr['txt_feature_social'] . $nlx1; } //else { $txtOut .= $cnt . $pad . "no comment specified" . $nlx1; }
            $txtOut .= $mdbr;
        }
        if (isset($arr['cbx_feature_blog']) && $arr['cbx_feature_blog'] !== "n/a") { $i++; $txtOut .= $cnt . $bullet . $arr['cbx_feature_blog'] . ":" . $nlx1; }
        if (isset($arr['cbx_feature_blog']) && $arr['cbx_feature_blog'] !== "n/a")
        {
            if (isset($arr['txt_feature_blog'])) { $txtOut .= $cnt . $pad . $arr['txt_feature_blog'] . $nlx1; } //else { $txtOut .= $cnt . $pad . "no comment specified" . $nlx1; }
            $txtOut .= $mdbr;
        }
        if (isset($arr['cbx_feature_timeline']) && $arr['cbx_feature_timeline'] !== "n/a") { $i++; $txtOut .= $cnt . $bullet . $arr['cbx_feature_timeline'] . ":" . $nlx1; }
        if (isset($arr['cbx_feature_timeline']) && $arr['cbx_feature_timeline'] !== "n/a")
        {
            if (isset($arr['txt_feature_timeline'])) { $txtOut .= $cnt . $pad . $arr['txt_feature_timeline'] . $nlx1; } //else { $txtOut .= $cnt . $pad . "no comment specified" . $nlx1; }
            $txtOut .= $mdbr;
        }
        if (isset($arr['cbx_feature_newsletter']) && $arr['cbx_feature_newsletter'] !== "n/a") { $i++; $txtOut .= $cnt . $bullet . $arr['cbx_feature_newsletter'] . ":" . $nlx1; }
        if (isset($arr['cbx_feature_newsletter']) && $arr['cbx_feature_newsletter'] !== "n/a")
        {
            if (isset($arr['txt_feature_newsletter'])) { $txtOut .= $cnt . $pad . $arr['txt_feature_newsletter'] . $nlx1; } //else { $txtOut .= $cnt . $pad . "no comment specified" . $nlx1; }
            $txtOut .= $mdbr;
        }
        if (isset($arr['cbx_feature_calculator']) && $arr['cbx_feature_calculator'] !== "n/a") { $i++; $txtOut .= $cnt . $bullet . $arr['cbx_feature_calculator'] . ":" . $nlx1; }
        if (isset($arr['cbx_feature_calculator']) && $arr['cbx_feature_calculator'] !== "n/a")
        {
            if (isset($arr['txt_feature_calculator'])) { $txtOut .= $cnt . $pad . $arr['txt_feature_calculator'] . $nlx1; } //else { $txtOut .= $cnt . $pad . "no comment specified" . $nlx1; }
            $txtOut .= $mdbr;
        }
        if (isset($arr['cbx_feature_otherdetails']) && $arr['cbx_feature_otherdetails'] !== "n/a") { $i++; $txtOut .= $cnt . $bullet . $arr['cbx_feature_otherdetails'] . $nlx1; }
        if (isset($arr['cbx_feature_otherdetails']) && $arr['cbx_feature_otherdetails'] !== "n/a")
        {
            if (isset($arr['txt_feature_otherdetails'])) { $txtOut .= $cnt . $pad . $arr['txt_feature_otherdetails'] . $nlx1; } //else { $txtOut .= $cnt . $pad . "no comment specified" . $nlx1; }
            $txtOut .= $nlx1;
        }
        if ($i == 0) { $txtOut .= $cnt . "n/a" . $nlx1; }
        $txtOut .= $nlx2;




        





        /**********************/

        $txtOut .= $nlx2;
        $txtOut .= $h1 . _( 'form-design-ttl' ) . $nlx1;
        $txtOut .= $spliter . $nlx1;
        $txtOut .= $nlx1;

        /**********************/

        $i = 0;
        $txtOut .= $h2 . _('form-design-siteGoal-ttl') . $nlx1;
        $txtOut .= $nlx1;
        if (isset($arr['txt_site_goal_1'])) { $i++; $txtOut .= $cnt . _( 'txt_site_goal_1' ) . $nlx1; }
        if (isset($arr['txt_site_goal_1']))
        {
            $txtOut .= $cnt . $pad . $arr['txt_site_goal_1'] . $nlx1;
            $txtOut .= $nlx1;
        }
        if (isset($arr['txt_site_goal_2'])) { $i++; $txtOut .= $cnt . _( 'txt_site_goal_2' ) . $nlx1; }
        if (isset($arr['txt_site_goal_2']))
        {
            $txtOut .= $cnt . $pad . $arr['txt_site_goal_2'] . $nlx1;
            $txtOut .= $nlx1;
        }
        if (isset($arr['txt_site_goal_3'])) { $i++; $txtOut .= $cnt . _( 'txt_site_goal_3' ) . $nlx1; }
        if (isset($arr['txt_site_goal_3']))
        {
            $txtOut .= $cnt . $pad . $arr['txt_site_goal_3'] . $nlx1;
            $txtOut .= $nlx1;
        }
        if (isset($arr['txt_site_goal_4'])) { $i++; $txtOut .= $cnt . _( 'txt_site_goal_4' ) . $nlx1; }
        if (isset($arr['txt_site_goal_4']))
        {
            $txtOut .= $cnt . $pad . $arr['txt_site_goal_4'] . $nlx1;
            $txtOut .= $nlx1;
        }
        if ($i == 0) { $txtOut .= $cnt . $bullet . "n/a" . $nlx1; }
        $txtOut .= $nlx2;

        /**********************/

        $i = 0;
        $txtOut .= $h2 . _('form-design-action-ttl') . $nlx1;
        $txtOut .= $nlx1;
        if (isset($arr['cbx_action_call']) && $arr['cbx_action_call'] !== "n/a") {           $i++; $txtOut .= $cnt . $bullet . $arr['cbx_action_call'] . $nlx1; }
        if (isset($arr['cbx_action_mail']) && $arr['cbx_action_mail'] !== "n/a") {           $i++; $txtOut .= $cnt . $bullet . $arr['cbx_action_mail'] . $nlx1; }
        if (isset($arr['cbx_action_fillform']) && $arr['cbx_action_fillform'] !== "n/a") {       $i++; $txtOut .= $cnt . $bullet . $arr['cbx_action_fillform'] . $nlx1; }
        if (isset($arr['cbx_action_socialshare']) && $arr['cbx_action_socialshare'] !== "n/a") {    $i++; $txtOut .= $cnt . $bullet . $arr['cbx_action_socialshare'] . $nlx1; }
        if (isset($arr['cbx_action_subscribeemail']) && $arr['cbx_action_subscribeemail'] !== "n/a") { $i++; $txtOut .= $cnt . $bullet . $arr['cbx_action_subscribeemail'] . $nlx1; }
        if (isset($arr['cbx_action_article']) && $arr['cbx_action_article'] !== "n/a") {        $i++; $txtOut .= $cnt . $bullet . $arr['cbx_action_article'] . $nlx1; }
        if (isset($arr['cbx_action_searchinfo']) && $arr['cbx_action_searchinfo'] !== "n/a") {     $i++; $txtOut .= $cnt . $bullet . $arr['cbx_action_searchinfo'] . $nlx1; }
        if (isset($arr['cbx_action_purchase']) && $arr['cbx_action_purchase'] !== "n/a") {       $i++; $txtOut .= $cnt . $bullet . $arr['cbx_action_purchase'] . $nlx1; }
        if ($arr['txt_action_othercomments'] !== "n/a")
        {
            $i++;
            $txtOut .= $cnt . $bullet . _( 'txt_action_othercomments' ) . $nlx1;
            $txtOut .= $cnt . $pad . $arr['txt_action_othercomments'] . $nlx1;
        }
        if ($i == 0) {    $txtOut .= $cnt . "n/a" . $nlx1; }
        $txtOut .= $nlx2;

        /**********************/

        $i = 0;
        $txtOut .= $h2 . _('form-design-adjective-ttl') . $nlx1;
        $txtOut .= $nlx1;
        if ($arr['fld_adjective_1'] !== "n/a") { $i++; $txtOut .= $cnt . $bullet . $arr['fld_adjective_1'] . $nlx1; }
        if ($arr['fld_adjective_2'] !== "n/a") { $i++; $txtOut .= $cnt . $bullet . $arr['fld_adjective_2'] . $nlx1; }
        if ($arr['fld_adjective_3'] !== "n/a") { $i++; $txtOut .= $cnt . $bullet . $arr['fld_adjective_3'] . $nlx1; }
        if ($i == 0) { $txtOut .= $cnt . "n/a" . $nlx1; }
        $txtOut .= $nlx2;

        /**********************/

        $txtOut .= $h2 . _('form-design-target-ttl') . $nlx1;
        $txtOut .= $nlx1;
        
        $i = 0;
        $txtOut .= $h3 . _('form-design-target-stl-age') . $nlx1;
        if (isset($arr['cbx_audience_age_kids']) && $arr['cbx_audience_age_kids'] !== "n/a") { $i++; $txtOut .= $cnt . $bullet . $arr['cbx_audience_age_kids'] . $nlx1; }
        if (isset($arr['cbx_audience_age_teen']) && $arr['cbx_audience_age_teen'] !== "n/a") { $i++; $txtOut .= $cnt . $bullet . $arr['cbx_audience_age_teen'] . $nlx1; }
        if (isset($arr['cbx_audience_age_young']) && $arr['cbx_audience_age_young'] !== "n/a") { $i++; $txtOut .= $cnt . $bullet . $arr['cbx_audience_age_young'] . $nlx1; }
        if (isset($arr['cbx_audience_age_adult']) && $arr['cbx_audience_age_adult'] !== "n/a") { $i++; $txtOut .= $cnt . $bullet . $arr['cbx_audience_age_adult'] . $nlx1; }
        if (isset($arr['cbx_audience_age_senior']) && $arr['cbx_audience_age_senior'] !== "n/a") { $i++; $txtOut .= $cnt . $bullet . $arr['cbx_audience_age_senior'] . $nlx1; }
        if ($i == 0) { $txtOut .= $cnt . "n/a" . $nlx2; } else { $txtOut .= $nlx1; }
        
        $i = 0;
        $txtOut .= $h3 . _('form-design-target-stl-geographic') . $nlx1;
        if (isset($arr['cbx_audience_geo_local']) && $arr['cbx_audience_geo_local'] !== "n/a") { $i++; $txtOut .= $cnt . $bullet . $arr['cbx_audience_geo_local'] . $nlx1; }
        if (isset($arr['cbx_audience_geo_city']) && $arr['cbx_audience_geo_city'] !== "n/a") { $i++; $txtOut .= $cnt . $bullet . $arr['cbx_audience_geo_city'] . $nlx1; }
        if (isset($arr['cbx_audience_geo_province']) && $arr['cbx_audience_geo_province'] !== "n/a") { $i++; $txtOut .= $cnt . $bullet . $arr['cbx_audience_geo_province'] . $nlx1; }
        if (isset($arr['cbx_audience_geo_country']) && $arr['cbx_audience_geo_country'] !== "n/a") { $i++; $txtOut .= $cnt . $bullet . $arr['cbx_audience_geo_country'] . $nlx1; }
        if (isset($arr['cbx_audience_geo_world']) && $arr['cbx_audience_geo_world'] !== "n/a") { $i++; $txtOut .= $cnt . $bullet . $arr['cbx_audience_geo_world'] . $nlx1; }
        if ($i == 0) { $txtOut .= $cnt . "n/a" . $nlx2; } else { $txtOut .= $nlx1; }
        
        $i = 0;
        $txtOut .= $h3 . _('form-design-target-stl-education') . $nlx1;
        if (isset($arr['cbx_audience_education_hschool']) && $arr['cbx_audience_education_hschool'] !== "n/a") { $i++; $txtOut .= $cnt . $bullet . $arr['cbx_audience_education_hschool'] . $nlx1; }
        if (isset($arr['cbx_audience_education_college']) && $arr['cbx_audience_education_college'] !== "n/a") { $i++; $txtOut .= $cnt . $bullet . $arr['cbx_audience_education_college'] . $nlx1; }
        if (isset($arr['cbx_audience_education_undergrad']) && $arr['cbx_audience_education_undergrad'] !== "n/a") { $i++; $txtOut .= $cnt . $bullet . $arr['cbx_audience_education_undergrad'] . $nlx1; }
        if (isset($arr['cbx_audience_education_grad']) && $arr['cbx_audience_education_grad'] !== "n/a") { $i++; $txtOut .= $cnt . $bullet . $arr['cbx_audience_education_grad'] . $nlx1; }
        if (isset($arr['cbx_audience_education_none']) && $arr['cbx_audience_education_none'] !== "n/a") { $i++; $txtOut .= $cnt . $bullet . $arr['cbx_audience_education_none'] . $nlx1; }
        if ($i == 0) { $txtOut .= $cnt . "n/a" . $nlx2; } else { $txtOut .= $nlx1; }
        
        $i = 0;
        $txtOut .= $h3 . _('form-design-target-stl-job') . $nlx1;
        if (isset($arr['cbx_audience_job_salaried']) && $arr['cbx_audience_job_salaried'] !== "n/a") { $i++; $txtOut .= $cnt . $bullet . $arr['cbx_audience_job_salaried'] . $nlx1; }
        if (isset($arr['cbx_audience_job_self']) && $arr['cbx_audience_job_self'] !== "n/a") { $i++; $txtOut .= $cnt . $bullet . $arr['cbx_audience_job_self'] . $nlx1; }
        if (isset($arr['cbx_audience_job_professional']) && $arr['cbx_audience_job_professional'] !== "n/a") { $i++; $txtOut .= $cnt . $bullet . $arr['cbx_audience_job_professional'] . $nlx1; }
        if (isset($arr['cbx_audience_job_entrepreneur']) && $arr['cbx_audience_job_entrepreneur'] !== "n/a") { $i++; $txtOut .= $cnt . $bullet . $arr['cbx_audience_job_entrepreneur'] . $nlx1; }
        if (isset($arr['cbx_audience_job_unemployed']) && $arr['cbx_audience_job_unemployed'] !== "n/a") { $i++; $txtOut .= $cnt . $bullet . $arr['cbx_audience_job_unemployed'] . $nlx1; }
        if ($i == 0) { $txtOut .= $cnt . "n/a" . $nlx2; } else { $txtOut .= $nlx1; }
        
        $i = 0;
        $txtOut .= $h3 . _('form-design-target-stl-wealth') . $nlx1;
        if (isset($arr['cbx_audience_wealth_below']) && $arr['cbx_audience_wealth_below'] !== "n/a") { $i++; $txtOut .= $cnt . $bullet . $arr['cbx_audience_wealth_below'] . $nlx1; }
        if (isset($arr['cbx_audience_wealth_average']) && $arr['cbx_audience_wealth_average'] !== "n/a") { $i++; $txtOut .= $cnt . $bullet . $arr['cbx_audience_wealth_average'] . $nlx1; }
        if (isset($arr['cbx_audience_wealth_above']) && $arr['cbx_audience_wealth_above'] !== "n/a") { $i++; $txtOut .= $cnt . $bullet . $arr['cbx_audience_wealth_above'] . $nlx1; }
        if ($i == 0) { $txtOut .= $cnt . "n/a" . $nlx2; } else { $txtOut .= $nlx1; }
        
        $i = 0;
        $txtOut .= $h3 . _('form-design-target-stl-gender') . $nlx1;
        if (isset($arr['cbx_audience_gender_man']) && $arr['cbx_audience_gender_man'] !== "n/a") { $i++; $txtOut .= $cnt . $bullet . $arr['cbx_audience_gender_man'] . $nlx1; }
        if (isset($arr['cbx_audience_gender_woman']) && $arr['cbx_audience_gender_woman'] !== "n/a") { $i++; $txtOut .= $cnt . $bullet . $arr['cbx_audience_gender_woman'] . $nlx1; }
        if ($i == 0) { $txtOut .= $cnt . "n/a" . $nlx2; } else { $txtOut .= $nlx1; }

        $txtOut .= $h3 . _('txt_audience_description') . $nlx1;
        $txtOut .= $cnt . $arr['txt_audience_description'] . $nlx1;
        $txtOut .= $nlx2;

        /**********************/

        $i = 0;
        $txtOut .= $h2 . _('form-design-design-ttl') . $nlx1;
        $txtOut .= $nlx1;
        if ($arr['txt_design_colour'] != "n/a") { $i++; $txtOut .= $cnt . _( 'txt_design_colour' ) . $nlx1; }
        if ($arr['txt_design_colour'] != "n/a") { $txtOut .= $cnt . $pad . $arr['txt_design_colour'] . $nlx1 . $mdbr; }

        if ($arr['txt_design_theme'] != "n/a") { $i++; $txtOut .= $cnt . _( 'txt_design_theme' ) . $nlx1; }
        if ($arr['txt_design_theme'] != "n/a") { $txtOut .= $cnt . $pad . $arr['txt_design_theme'] . $nlx1 . $mdbr; }

        if ($arr['txt_design_style'] != "n/a") { $i++; $txtOut .= $cnt . _( 'txt_design_style' ) . $nlx1; }
        if ($arr['txt_design_style'] != "n/a") { $txtOut .= $cnt . $pad . $arr['txt_design_style'] . $nlx1 . $mdbr; }

        if ($arr['txt_design_brand'] != "n/a") { $i++; $txtOut .= $cnt . _( 'txt_design_brand' ) . $nlx1; }
        if ($arr['txt_design_brand'] != "n/a") { $txtOut .= $cnt . $pad . $arr['txt_design_brand'] . $nlx1 . $mdbr; }

        if ($arr['txt_design_othercomments'] != "n/a") { $i++; $txtOut .= $cnt . _( 'txt_design_othercomments' ) . $nlx1; }
        if ($arr['txt_design_othercomments'] != "n/a") { $txtOut .= $cnt . $pad . $arr['txt_design_othercomments'] . $nlx1; }
        if ($i == 0) { $txtOut .= $cnt . "n/a" . $nlx1; }
        $txtOut .= $nlx2;


        /**********************/

        $i = 0;
        $txtOut .= $h2 . _('form-design-competitor-ttl') . $nlx1;
        $txtOut .= $nlx1;
        if ($arr['fld_competitor_1'] !== "n/a") { $i++; $txtOut .= $cnt . $bullet . $arr['fld_competitor_1'] . $nlx1; }
        if ($arr['fld_competitor_2'] !== "n/a") { $i++; $txtOut .= $cnt . $bullet . $arr['fld_competitor_2'] . $nlx1; }
        if ($arr['fld_competitor_3'] !== "n/a") { $i++; $txtOut .= $cnt . $bullet . $arr['fld_competitor_3'] . $nlx1; }
        if ($arr['fld_competitor_4'] !== "n/a") { $i++; $txtOut .= $cnt . $bullet . $arr['fld_competitor_4'] . $nlx1; }
        if ($arr['fld_competitor_5'] !== "n/a") { $i++; $txtOut .= $cnt . $bullet . $arr['fld_competitor_5'] . $nlx1; }
        if ($arr['fld_competitor_6'] !== "n/a") { $i++; $txtOut .= $cnt . $bullet . $arr['fld_competitor_6'] . $nlx1; }
        if ($i == 0) { $txtOut .= $cnt . "n/a" . $nlx1; }
        $txtOut .= $nlx2;

        /**********************/

        $i = 0;
        $txtOut .= $h2 . _('form-design-like-ttl') . $nlx1;
        $txtOut .= $nlx1;

        if ($arr['fld_like_1_url'] !== "n/a")
        {
            $txtOut .= $h3 . _( 'form-design-like-stl-site-1' ) . $nlx1;
            $txtOut .= $cnt . _( 'fld_like_1_url' ) . " ";      if ($arr['fld_like_1_url'] !== "n/a")     { $i++; $txtOut .= $arr['fld_like_1_url']; }      $txtOut .= $nlx1;
            $txtOut .= $cnt . _( 'fld_like_1_like' ) . " ";     if ($arr['fld_like_1_like'] !== "n/a")    { $i++; $txtOut .= $arr['fld_like_1_like']; }     $txtOut .= $nlx1;
            $txtOut .= $cnt . _( 'fld_like_1_improve' ) . " ";  if ($arr['fld_like_1_improve'] !== "n/a") { $i++; $txtOut .= $arr['fld_like_1_improve']; }  $txtOut .= $nlx1;   
            $txtOut .= $nlx1;
        }

        if ($arr['fld_like_2_url'] !== "n/a")
        {
            $txtOut .= $h3 . _( 'form-design-like-stl-site-2' ) . $nlx1;
            $txtOut .= $cnt . _( 'fld_like_2_url' ) . " ";      if ($arr['fld_like_2_url'] !== "n/a")     { $i++; $txtOut .= $arr['fld_like_2_url']; }      $txtOut .= $nlx1;
            $txtOut .= $cnt . _( 'fld_like_2_like' ) . " ";     if ($arr['fld_like_2_like'] !== "n/a")    { $i++; $txtOut .= $arr['fld_like_2_like']; }     $txtOut .= $nlx1;
            $txtOut .= $cnt . _( 'fld_like_2_improve' ) . " ";  if ($arr['fld_like_2_improve'] !== "n/a") { $i++; $txtOut .= $arr['fld_like_2_improve']; }  $txtOut .= $nlx1;   
            $txtOut .= $nlx1;
        }

        if ($arr['fld_like_3_url'] !== "n/a")
        {
            $txtOut .= $h3 . _( 'form-design-like-stl-site-3' ) . $nlx1;
            $txtOut .= $cnt . _( 'fld_like_3_url' ) . " ";      if ($arr['fld_like_3_url'] !== "n/a")     { $i++; $txtOut .= $arr['fld_like_3_url']; }      $txtOut .= $nlx1;
            $txtOut .= $cnt . _( 'fld_like_3_like' ) . " ";     if ($arr['fld_like_3_like'] !== "n/a")    { $i++; $txtOut .= $arr['fld_like_3_like']; }     $txtOut .= $nlx1;
            $txtOut .= $cnt . _( 'fld_like_3_improve' ) . " ";  if ($arr['fld_like_3_improve'] !== "n/a") { $i++; $txtOut .= $arr['fld_like_3_improve']; }  $txtOut .= $nlx1;   
            $txtOut .= $nlx1;
        }

        if ($arr['fld_like_4_url'] !== "n/a")
        {
            $txtOut .= $h3 . _( 'form-design-like-stl-site-4' ) . $nlx1;
            $txtOut .= $cnt . _( 'fld_like_4_url' ) . " ";      if ($arr['fld_like_4_url'] !== "n/a")     { $i++; $txtOut .= $arr['fld_like_4_url']; }      $txtOut .= $nlx1;
            $txtOut .= $cnt . _( 'fld_like_4_like' ) . " ";     if ($arr['fld_like_4_like'] !== "n/a")    { $i++; $txtOut .= $arr['fld_like_4_like']; }     $txtOut .= $nlx1;
            $txtOut .= $cnt . _( 'fld_like_4_improve' ) . " ";  if ($arr['fld_like_4_improve'] !== "n/a") { $i++; $txtOut .= $arr['fld_like_4_improve']; }  $txtOut .= $nlx1;   
            $txtOut .= $nlx1;
        }

        if ($i == 0) { $txtOut .= $cnt . "n/a" . $nlx2; }
        $txtOut .= $nlx1;

        /**********************/

        $i = 0;
        $txtOut .= $h2 . _('form-design-dislike-ttl') . $nlx1;
        $txtOut .= $nlx1;

        if ($arr['fld_dislike_1_url'] !== "n/a")
        {
            $txtOut .= $h3 . _( 'form-design-dislike-stl-site-1' ) . $nlx1;
            $txtOut .= $cnt . _( 'fld_dislike_1_url' ) . " ";      if ($arr['fld_dislike_1_url'] !== "n/a")       { $i++; $txtOut .= $arr['fld_dislike_1_url']; }     $txtOut .= $nlx1;
            $txtOut .= $cnt . _( 'fld_dislike_1_dislike' ) . " ";  if ($arr['fld_dislike_1_dislike'] !== "n/a")   { $i++; $txtOut .= $arr['fld_dislike_1_dislike']; } $txtOut .= $nlx1;
            $txtOut .= $nlx1;
        }

        if ($arr['fld_dislike_2_url'] !== "n/a")
        {
            $txtOut .= $h3 . _( 'form-design-dislike-stl-site-2' ) . $nlx1;
            $txtOut .= $cnt . _( 'fld_dislike_2_url' ) . " ";      if ($arr['fld_dislike_2_url'] !== "n/a")       { $i++; $txtOut .= $arr['fld_dislike_2_url']; }     $txtOut .= $nlx1;
            $txtOut .= $cnt . _( 'fld_dislike_2_dislike' ) . " ";  if ($arr['fld_dislike_2_dislike'] !== "n/a")   { $i++; $txtOut .= $arr['fld_dislike_2_dislike']; } $txtOut .= $nlx1;
            $txtOut .= $nlx1;
        }

        if ($arr['fld_dislike_3_url'] !== "n/a")
        {
            $txtOut .= $h3 . _( 'form-design-dislike-stl-site-3' ) . $nlx1;
            $txtOut .= $cnt . _( 'fld_dislike_3_url' ) . " ";      if ($arr['fld_dislike_3_url'] !== "n/a")       { $i++; $txtOut .= $arr['fld_dislike_3_url']; }     $txtOut .= $nlx1;
            $txtOut .= $cnt . _( 'fld_dislike_3_dislike' ) . " ";  if ($arr['fld_dislike_3_dislike'] !== "n/a")   { $i++; $txtOut .= $arr['fld_dislike_3_dislike']; } $txtOut .= $nlx1;
            $txtOut .= $nlx1;
        }

        if ($arr['fld_dislike_4_url'] !== "n/a")
        {
            $txtOut .= $h3 . _( 'form-design-dislike-stl-site-4' ) . $nlx1;
            $txtOut .= $cnt . _( 'fld_dislike_4_url' ) . " ";      if ($arr['fld_dislike_4_url'] !== "n/a")       { $i++; $txtOut .= $arr['fld_dislike_4_url']; }     $txtOut .= $nlx1;
            $txtOut .= $cnt . _( 'fld_dislike_4_dislike' ) . " ";  if ($arr['fld_dislike_4_dislike'] !== "n/a")   { $i++; $txtOut .= $arr['fld_dislike_4_dislike']; } $txtOut .= $nlx1;
            $txtOut .= $nlx1;
        }

        if ($i == 0) { $txtOut .= $cnt . "n/a" . $nlx2; }
        $txtOut .= $nlx1;

        /**********************/

        $txtOut .= $h2 . _('form-design-remark-ttl') . $nlx1;
        $txtOut .= $nlx1;
        if (isset($arr['rdo_remark'])) { $txtOut .= $cnt . $arr['rdo_remark'] . $nlx2; } else { $txtOut .= $cnt . "n/a" . $nlx1; }
        if ($arr['txt_definite_no'] !== "n/a")
        {
            $txtOut .= $cnt . $pad . $arr['txt_definite_no'] . $nlx1;
        }
        $txtOut .= $nlx2;




        





        /**********************/

        $txtOut .= $nlx2;
        $txtOut .= $h1 . _( 'form-technology-ttl' ) . $nlx1;
        $txtOut .= $spliter . $nlx1;
        $txtOut .= $nlx1;

        /**********************/

        $txtOut .= $h2 . _('form-technology-architecture-ttl') . $nlx1;
        $txtOut .= $nlx1;
        if (isset($arr['rdo_architecture_layout']))         { $txtOut .= $cnt . $bullet . $arr['rdo_architecture_layout'] . $nlx2; }
        if (isset($arr['cbx_architecture_hd']) && $arr['cbx_architecture_hd'] !== "n/a")             { $txtOut .= $cnt . $bullet . $arr['cbx_architecture_hd'] . $nlx1; }
        if (isset($arr['cbx_architecture_legacysupport']) && $arr['cbx_architecture_legacysupport'] !== "n/a")  { $txtOut .= $cnt . $bullet . $arr['cbx_architecture_legacysupport'] . $nlx1; }
        if ($arr['txt_architecture_othercomments'] !== "n/a")
        {
            $txtOut .= $cnt . $bullet . _( 'txt_architecture_othercomments' ) . $nlx1;
            $txtOut .= $cnt . $pad . $arr['txt_architecture_othercomments'] . $nlx1;
        }
        $txtOut .= $nlx2;

        /**********************/

        $i = 0;
        $txtOut .= $h2 . _('form-technology-accessibility-ttl') . $nlx1;
        $txtOut .= $nlx1;
        if (isset($arr['cbx_accessibility_eyesight']) && $arr['cbx_accessibility_eyesight'] !== "n/a")      { $i++; $txtOut .= $cnt . $bullet . $arr['cbx_accessibility_eyesight'] . $nlx1; }
        if (isset($arr['cbx_accessibility_mobility']) && $arr['cbx_accessibility_mobility'] !== "n/a")      { $i++; $txtOut .= $cnt . $bullet . $arr['cbx_accessibility_mobility'] . $nlx1; }
        if (isset($arr['cbx_accessibility_readinglevel']) && $arr['cbx_accessibility_readinglevel'] !== "n/a")  { $i++; $txtOut .= $cnt . $bullet . $arr['cbx_accessibility_readinglevel'] . $nlx1; }
        if ($arr['txt_accessibility_othercomments'] !== "n/a")
        {
            $i++;
            $txtOut .= $cnt . $bullet . _( 'txt_accessibility_othercomments' ) . $nlx1;
            $txtOut .= $cnt . $pad . $arr['txt_accessibility_othercomments'] . $nlx1;
        }
        if ($i == 0) { $txtOut .= $cnt . "n/a" . $nlx1; }
        $txtOut .= $nlx2;

        /**********************/

        $txtOut .= $h2 . _('form-technology-seo-instruction') . $nlx1;
        $txtOut .= $nlx1;

        $i = 0;
        if ((isset($arr['cbx_seo_tool_google']) && $arr['cbx_seo_tool_google'] !== "n/a") || (isset($arr['cbx_seo_tool_bing']) && $arr['cbx_seo_tool_bing'] !== "n/a") || (isset($arr['cbx_seo_tool_yandex']) && $arr['cbx_seo_tool_yandex'] !== "n/a"))
        {
            $txtOut .= $cnt . $bullet . _( 'Webmaster Tool(s):' ) . $nlx1;
        }
        if (isset($arr['cbx_seo_tool_google']) && $arr['cbx_seo_tool_google'] !== "n/a") { $i++; $txtOut .= $cnt . $mdpad . $bullet . $arr['cbx_seo_tool_google'] . $nlx1; }
        if (isset($arr['cbx_seo_tool_bing']) && $arr['cbx_seo_tool_bing'] !== "n/a") { $i++; $txtOut .= $cnt . $mdpad . $bullet . $arr['cbx_seo_tool_bing'] . $nlx1; }
        if (isset($arr['cbx_seo_tool_yandex']) && $arr['cbx_seo_tool_yandex'] !== "n/a") { $i++; $txtOut .= $cnt . $mdpad . $bullet . $arr['cbx_seo_tool_yandex'] . $nlx1; }
        if ($i > 0) { $txtOut .= $mdbr; }
            
        $i = 0;
        if ((isset($arr['cbx_seo_opengraph_fb']) && $arr['cbx_seo_opengraph_fb'] !== "n/a") || (isset($arr['cbx_seo_opengraph_tw']) && $arr['cbx_seo_opengraph_tw'] !== "n/a") || (isset($arr['cbx_seo_opengraph_gplus']) && $arr['cbx_seo_opengraph_gplus'] !== "n/a") || (isset($arr['cbx_seo_opengraph_linkedin']) && $arr['cbx_seo_opengraph_linkedin'] !== "n/a") || (isset($arr['cbx_seo_opengraph_pinterest']) && $arr['cbx_seo_opengraph_pinterest'] !== "n/a"))
        {
            $txtOut .= $cnt . $bullet . _( 'Open Graph(s):' ) . $nlx1;
        }
        if (isset($arr['cbx_seo_opengraph_fb']) && $arr['cbx_seo_opengraph_fb'] !== "n/a") { $i++; $txtOut .= $cnt . $mdpad . $bullet . $arr['cbx_seo_opengraph_fb'] . $nlx1; }
        if (isset($arr['cbx_seo_opengraph_tw']) && $arr['cbx_seo_opengraph_tw'] !== "n/a") { $i++; $txtOut .= $cnt . $mdpad . $bullet . $arr['cbx_seo_opengraph_tw'] . $nlx1; }
        if (isset($arr['cbx_seo_opengraph_gplus']) && $arr['cbx_seo_opengraph_gplus'] !== "n/a") { $i++; $txtOut .= $cnt . $mdpad . $bullet . $arr['cbx_seo_opengraph_gplus'] . $nlx1; }
        if (isset($arr['cbx_seo_opengraph_linkedin']) && $arr['cbx_seo_opengraph_linkedin'] !== "n/a") { $i++; $txtOut .= $cnt . $mdpad . $bullet . $arr['cbx_seo_opengraph_linkedin'] . $nlx1; }
        if (isset($arr['cbx_seo_opengraph_pinterest']) && $arr['cbx_seo_opengraph_pinterest'] !== "n/a") { $i++; $txtOut .= $cnt . $mdpad . $bullet . $arr['cbx_seo_opengraph_pinterest'] . $nlx1; }
        if ($i > 0) { $txtOut .= $mdbr; }

        if (isset($arr['cbx_seo_url_optimization']) && $arr['cbx_seo_url_optimization'] !== "n/a")      { $i++; $txtOut .= $cnt . $bullet . $arr['cbx_seo_url_optimization'] . $nlx1; }
        if (isset($arr['cbx_seo_structured_data']) && $arr['cbx_seo_structured_data'] !== "n/a")      { $i++; $txtOut .= $cnt . $bullet . $arr['cbx_seo_structured_data'] . $nlx1; }
        if (isset($arr['cbx_seo_localization']) && $arr['cbx_seo_localization'] !== "n/a")  { $i++; $txtOut .= $cnt . $bullet . $arr['cbx_seo_localization'] . $nlx1; }
        if (isset($arr['cbx_seo_mobile_meta']) && $arr['cbx_seo_mobile_meta'] !== "n/a")  { $i++; $txtOut .= $cnt . $bullet . $arr['cbx_seo_mobile_meta'] . $nlx1; }
        if (isset($arr['cbx_seo_analytic']) && $arr['cbx_seo_analytic'] !== "n/a")  { $i++; $txtOut .= $cnt . $bullet . $arr['cbx_seo_analytic'] . $nlx1; }
        $txtOut .= $nlx2;

        /**********************/

        $i = 0;
        $txtOut .= $h2 . _('form-technology-domain-ttl') . $nlx1;
        $txtOut .= $nlx1;
        if ($arr['fld_domain_1'] !== "n/a") { $i++; $txtOut .= $cnt . $bullet . $arr['fld_domain_1'] . $nlx1; }
        if ($arr['fld_domain_2'] !== "n/a") { $i++; $txtOut .= $cnt . $bullet . $arr['fld_domain_2'] . $nlx1; }
        if ($arr['fld_domain_3'] !== "n/a") { $i++; $txtOut .= $cnt . $bullet . $arr['fld_domain_3'] . $nlx1; }
        if ($arr['fld_domain_4'] !== "n/a") { $i++; $txtOut .= $cnt . $bullet . $arr['fld_domain_4'] . $nlx1; }
        if ($arr['fld_domain_5'] !== "n/a") { $i++; $txtOut .= $cnt . $bullet . $arr['fld_domain_5'] . $nlx1; }
        if ($arr['fld_domain_6'] !== "n/a") { $i++; $txtOut .= $cnt . $bullet . $arr['fld_domain_6'] . $nlx1; }
        if ($i == 0) { $txtOut .= $cnt . "n/a" . $nlx1; }
        $txtOut .= $nlx2;

        /**********************/

        $i = 0;
        $txtOut .= $h2 . _('form-technology-hosting-ttl') . $nlx1;
        $txtOut .= $nlx1;
        if (isset($arr['rdo_requirehosting'])) { $i++; $txtOut .= $cnt . $arr['rdo_requirehosting'] . $nlx2; }
        if ($i == 0) { $txtOut .= $cnt . "n/a" . $nlx1; }
        $txtOut .= $nlx2;

        /**********************/

        $i = 0;
        $txtOut .= $h2 . _('form-technology-email-ttl') . $nlx1;
        $txtOut .= $nlx1;
        if (isset($arr['rdo_domain_mailmatch'])) { $i++; $txtOut .= $cnt . $arr['rdo_domain_mailmatch'] . $nlx2; }
        if ($i == 0) { $txtOut .= $cnt . "n/a" . $nlx1; }
        $txtOut .= $nlx2;

        /**********************/

        $txtOut .= $h2 . _('form-technology-maintenance-ttl') . $nlx1;
        $txtOut .= $nlx1;
        $txtOut .= $cnt . $arr['txt_maintenance_details'] . $nlx1;
        $txtOut .= $nlx2;










        /**********************/

        $txtOut .= $nlx2;
        $txtOut .= $h1 . _( 'form-other-ttl' ) . $nlx1;
        $txtOut .= $spliter . $nlx1;
        $txtOut .= $nlx1;

        /**********************/

        $txtOut .= $h2 . _('form-other-future') . $nlx1;
        $txtOut .= $nlx1;
        $txtOut .= $cnt . $arr['txt_future_comments'] . $nlx1;
        $txtOut .= $nlx2;

        /**********************/

        $txtOut .= $h2 . _('form-other-comment') . $nlx1;
        $txtOut .= $nlx1;
        $txtOut .= $cnt . $arr['txt_additional_comments'] . $nlx1;
        $txtOut .= $nlx2;

        /**********************/

        $txtOut .= $nlx2;

        if ($extension === 'txt')
        {
                $txtOut .= "Form generated by Projecklist. Copyright " . date('Y') . ", All rights reserved." . $nlx1;
                $txtOut .= $_SESSION["server_root"];
        }
        else if ($extension === 'md')
        { 
            $txtOut .= $mdbr . $mdbr . $mdbr . $mdbr;
            $txtOut .= "Form generated by [Projecklist](" . $_SESSION["server_root"] . "), Copyright " . date('Y') . ", All rights reserved.";
        }

        // // DEBUG
        // $output = ['data' => "DEBUG within\n\n" . $txtOut,'modal' => true]; echo(json_encode($output)); exit;

        return $txtOut;
    }