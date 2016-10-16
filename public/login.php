<?php

    // configuration
    require("../includes/config.php"); 

    // if user already logged in redirect to home page
    if (!empty($_SESSION["id"]))
    {
        // redirect user
        redirect("/");
    }

    // if user reached page via GET (as by clicking a link or via redirect)
    else if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("login_form.php", "Log In");
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {   
        $sanitizedPost = sanitizeForm($_POST);
        if(isset($sanitizedPost['submit'])) 
        {
            // query database for user
            $rows = DB::query("SELECT * FROM users WHERE user_email = ?", $sanitizedPost["fld_login_email"]);

            // if we found user, check password
            if (count($rows) == 1)
            {
                // first (and only) row
                $row = $rows[0];
                // compare hash of user's input against hash that's in database
                if (password_verify($sanitizedPost["fld_login_psw"], $row["hash"]))
                {
                    // If this is a temporary password. Redirect user to password update screens...
                    if ($row['reset_date'] != NULL)
                    {
                        $currentDate = new DateTime(date('Y/m/d')); 
                        $resetDate   = new DateTime($row['reset_date']);
                        $interval = $currentDate->diff($resetDate);
                        $dateDiff = $interval->format('%a');

                        // Check if temporary password has expired
                        if ($dateDiff < 2)
                        {
                            // remember that user's now logged in by storing user's ID in session
                            $_SESSION["id"] = $row["id"];
                            $_SESSION["user_name"] = $row["firstname"];

                            // Reset password attempt counter on successful sign in
                            $attemptReset = DB::query("UPDATE users SET psw_attempt = 0 WHERE user_email = ?", $sanitizedPost["fld_login_email"]);

                            $output = [
                                'data'      => gettext('Don\'t forget to change your temporary password before it expires.'),
                                'modal'     => true,
                                'redirect'  => true,
                                'location'  => 'profile.php'
                            ];
                            echo(json_encode($output));
                            exit;
                        }
                        // If password has expired, user need to resumbmit a password reset request
                        else 
                        {
                            // Reset password attempt counter on successful sign in
                            $attemptReset = DB::query("UPDATE users SET psw_attempt = 0 WHERE user_email = ?", $sanitizedPost["fld_login_email"]);

                            $output = [
                                'data'      => gettext('The temporary password has exired.'),
                                'modal'     => true,
                                'redirect'  => true,
                                'location'  => 'forgot.php'
                            ];
                            echo(json_encode($output));
                            exit;
                        }
                    }
                    else
                    {
                        // remember that user's now logged in by storing user's ID in session
                        $_SESSION["id"] = $row["id"];
                        $_SESSION["user_name"] = $row["firstname"];

                        // Reset password attempt counter on successful sign in
                        $attemptReset = DB::query("UPDATE users SET psw_attempt = 0 WHERE user_email = ?", $sanitizedPost["fld_login_email"]);

                        $output = [
                            'redirect' => true,
                            'location' => 'index.php'
                        ];
                        echo(json_encode($output));
                        exit;
                    }
                }
                else
                {
                    // Password Attemps Check
                    $attempt_count = DB::query("SELECT psw_attempt FROM users WHERE user_email = ?", $sanitizedPost["fld_login_email"]);

                    if (count($attempt_count) != 0)
                    {
                        $attempt_count = $attempt_count[0];

                        // Check if password attempt limit is exceeded
                        if ($attempt_count['psw_attempt'] > 4)
                        {
                            $output = [
                                'data'      => gettext('Maximum Password Attempts. Please reset your password.'),
                                'modal'     => true,
                                'redirect'  => true,
                                'location'  => 'forgot.php',
                                'notification' => submitMail($sanitizedPost["fld_login_email"], "Account Locked Notification", "Your account is locked because the login attempt exceeded the maximum number of attempt. You can reset your password via this link: LINK", "Plain text goes here")
                            ];
                            echo(json_encode($output));
                            exit;
                        }

                        // Increment the password attempt count (this is reset on successful login)
                        else
                        {
                            $attempts = $attempt_count['psw_attempt'] + 1;
                            $increment = DB::query("UPDATE users SET psw_attempt = ? WHERE user_email = ?", $attempts, $sanitizedPost["fld_login_email"]);

                            if (count($increment) != 0)
                            {
                                $output = [
                                    'data'  => gettext('Invalid username and/or password.'),
                                    'reset' => true
                                ];
                                echo(json_encode($output));
                                exit;
                            }
                        }
                    }
                }
            }
            else
            {
                // transfer to register page if email provided is not already registered
                $output = [
                    'modal'         => true,
                    'data'          => 'This email is not registered.',
                    'transfer'      => true,
                    'transferData'  => $sanitizedPost["fld_login_email"],
                    'location'      => 'register.php'
                ];
                echo(json_encode($output));
                exit;
            }
        }
    }
?>