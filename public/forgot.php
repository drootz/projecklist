<?php

    // configuration
    require("../includes/config.php"); 

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("forgot_form.php", "Forgot Password");
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {   
        $post = sanitizeForm($_POST);
        if(isset($post['submit'])) 
        {

            if (!$post['g-recaptcha-response'])
            {
                $output = [
                    'data' => gettext('The reCAPTCHA checkbox is required')
                ];
                echo(json_encode($output));
                exit;
            }

            $captcha = $post['g-recaptcha-response'];
            $secretKey = "6LfS5ggTAAAAAKR6w3mDTrT9i7edXNxnmhBl4Kl9";
            $ip = $_SERVER['REMOTE_ADDR'];
            $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
            $responseKeys = json_decode($response,true);

            if(intval($responseKeys["success"]) !== 1)
            {
                $output = [
                    'data'      => gettext('Unable to proceed with your request at this time.'),
                    'reset'     => true,
                    'modal'     => true,
                    'redirect' => true,
                    'location'  => 'index.php'
                ];
                echo(json_encode($output));
                exit;
            }

            // query database for user
            $rows = DB::query("SELECT * FROM users WHERE user_email = ?", $post["fld_login_email"]);

            // if we found user, check password
            if (count($rows) == 1)
            {
                // first (and only) row
                $row = $rows[0];
                $tempPsw = pseudostring(8);
                $currentDate = date('Y/m/d');

                // DEBUG tmp
                $tempPsw = "12345";

                $reset = DB::query("UPDATE users SET hash = ?, psw_reset_date = ?, psw_attempt = 0 WHERE user_email = ?", password_hash($tempPsw, PASSWORD_DEFAULT), $currentDate, $row["user_email"]);

                if (count($reset) != 0)
                {
                    $output = [
                        'data'          => gettext('Your password has been sent by email successfully and will exipre in 24 hours. Check your mail!'),
                        'modal'         => true,
                        'redirect'      => true,
                        'location'      => 'index.php',
                        'notification'  => submitMail($row["user_email"], "Password Reset Notification", "Reset TMP: " . $tempPsw, "Plain text goes here")
                    ];
                    echo(json_encode($output));
                    exit;
                }
                else
                {
                    $output = [
                        'data'  => gettext('Unable to reset your password at this time. Please try again.'),
                        'reset' => true
                    ];
                    echo(json_encode($output));
                    exit;
                }
            }
            else
            {
                $output = [
                    'data'  => gettext('Invalid email address.'),
                    'reset' => true
                ];
                echo(json_encode($output));
                exit;
            }
        }
        else
        {
            // TODO: log errors internally somehow
            redirect("/logout.php");
        }
    }
    else
    {
        // TODO: log errors internally somehow
        redirect("/logout.php");
    }