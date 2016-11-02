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


        if(!$mail->send()) {
            // DEBUG
            // echo 'Message could not be sent.';
            // echo 'Mailer Error: ' . $mail->ErrorInfo;
            // exit;
            return false;
        } else {
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

        $template = preg_replace('/{SITEPATH}/','http://dracine.local/~dracine/xdev/projecklist/public', $template);
        $template = preg_replace('/{SITEPATH_ROOT}/','http://dracine.local/~dracine/xdev/projecklist', $template);
        $template = preg_replace('/{YEAR}/', date('Y'), $template);
        $template = preg_replace('/{ADMIN_EMAIL}/', 'projecklist@gmail.com', $template);
             
        //return the html of the template
        return $template;
     
    }



    
    // function submitEmail($_postArray) {

    //     $_post = labelvalueSplit($_postArray);

    //     // Get the email template and store it in a variable
    //     ob_start();
    //     require(__DIR__ . "/../mail/email_html.php");
    //     $email_html = ob_get_clean();

    //     // Get the plain email template and store it in a variable
    //     ob_start();
    //     require(__DIR__ . "/../mail/email_plain.php");
    //     $email_plain = ob_get_clean();

    //     // Get the plain email template and store it in a variable
    //     ob_start();
    //     echo debug_SubmitTable($_post);
    //     $email_htmltable = ob_get_clean();

    //     $attach_dir = __DIR__."/../mail/attach";
    //     $attach_name = _( 'process_email_attach_name' );
    //     $file_plain = $attach_dir . "/" . $attach_name . ".txt";
    //     $file_htmltable = $attach_dir . "/" . $attach_name . ".html";

    //     if( chmod($attach_dir, 0755) )
    //     {
    //         chmod($attach_dir, 0777);

    //         // Write the contents back to the file
    //         file_put_contents($file_plain, $email_plain, LOCK_EX);
    //         file_put_contents($file_htmltable, $email_htmltable, LOCK_EX);

    //         if( chmod($attach_dir, 0777) ) {
    //             chmod($attach_dir, 0755);
    //         }
    //     }

    //     $plain_attachment = chunk_split(base64_encode(file_get_contents($file_plain)));
    //     $htmltable_attachment = chunk_split(base64_encode(file_get_contents($file_htmltable)));
        
    //     $email_subject = "New Form Submission from " . $_post['value']['fld_contact_primary_fn'] . " " . $_post['value']['fld_contact_primary_ln'] . " | " . $_post['value']['fld_project_name'];
        
    //     // boundarie
    //     $semi_rand = md5(time()); 
    //     $mime_boundary = "BOUNDARY_mixed_{$semi_rand}"; 
    //     $alt_mime_boundary = "BOUNDARY_alt_{$semi_rand}"; 

    //     $email_headers  = "From: " . "do_not_reply@danwebco.ca" . "\r\n";
    //     $email_headers .= "Reply-To: " . $_post['value']['eml_contact_primary_email'] . "\r\n";
    //     // $email_headers .= "Cc: " . $_post['value']['eml_contact_primary_email'] . "\r\n";
    //     $email_headers .= "Content-Type: multipart/mixed; boundary=\"{$mime_boundary}\"\r\n";
    //     // $email_headers .= "MIME-Version: 1.0\r\n"; // if I add this header, gmail tag it as spam... no clue how to fix this

    //     $email_message = "\r\n--{$mime_boundary}\r\n";
    //     $email_message .= "Content-Type: multipart/alternative; boundary=\"{$alt_mime_boundary}\"\r\n";
        
    //     $email_message .= "\r\n--{$alt_mime_boundary}\r\n";
    //     $email_message .= "Content-Type: text/plain; charset=UTF-8; format=\"fixed\"\r\n".
    //                       // "Content-Transfer-Encoding: 7bit\r\n".
    //                       "Content-Transfer-Encoding: quoted-printable\r\n".
    //                       "Content-Disposition: inline\r\n".
    //                       $email_plain;

    //     $email_message .= "\r\n--{$alt_mime_boundary}\r\n";
    //     $email_message .= "Content-Type: text/html; charset=UTF-8\r\n".
    //                       // "Content-Transfer-Encoding: 7bit\r\n".
    //                       "Content-Transfer-Encoding: quoted-printable\r\n".
    //                       "Content-Disposition: inline\r\n".
    //                       $email_html;
    //     $email_message .= "\r\n--{$alt_mime_boundary}--\r\n";
        
    //     $email_message .= "\r\n--{$mime_boundary}\r\n";
    //     $email_message .= "Content-Type: text/plain; charset=UTF-8; name=\"" . $attach_name . ".txt\"\r\n".
    //                       "Content-Disposition: attachment; filename=\"" . $attach_name . ".txt\"\r\n".
    //                       "Content-Transfer-Encoding: base64\r\n".
    //                       "\r\n".
    //                       $plain_attachment;

    //     $email_message .= "\r\n--{$mime_boundary}\r\n";
    //     $email_message .= "Content-Type: text/html; charset=UTF-8; name=\"" . $attach_name . ".html\"\r\n".
    //                       "Content-Disposition: attachment; filename=\"" . $attach_name . ".html\"\r\n".
    //                       "Content-Transfer-Encoding: base64\r\n".
    //                       "\r\n".
    //                       $htmltable_attachment;
        
    //     $email_message .= "\r\n--{$mime_boundary}--\r\n";

    //     //send the email
    //     $mail = mail( $_post['value']['eml_contact_primary_email'], $email_subject , $email_message, $email_headers );


    //     if( chmod($attach_dir, 0755) )
    //     {
    //         chmod($attach_dir, 0777);
    //         unlink($file_plain);
    //         unlink($file_htmltable);

    //         if( chmod($attach_dir, 0777) )
    //         {
    //             chmod($attach_dir, 0755);
    //         }
    //     }

    //     // DEBUG Ouput the result of sending the email in the cron notification email
    //     echo $mail ? "\n\nMail sent\n\n" : "\n\nMail failed\n\n";

    // }

