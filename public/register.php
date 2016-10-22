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
        // Make data transfered from other page via GET avaialble
        if (isset($_GET['transferData']))
        {
            render("register_form.php", "Registration", [
                'transferData'  => $_GET['transferData']
            ]);  
        }
        // else render form
        else
        {
            render("register_form.php", "Registration");   
        }
    }
    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // Sanitize $_POST and check for submit key
        $post = sanitizeForm($_POST);
        if(isset($post['submit'])) 
        {
            // Check for email confirmation
            if ($post['fld_register_email'] != $post['fld_register_email_confirm'])
            {
                $output = [
                    'data'   => gettext('Email Confirmation Missmatch')
                ];
                echo(json_encode($output));
                exit;
            }

            // Check for password confirmation
            if ($post['fld_register_psw'] != $post['fld_register_psw_confirm'])
            {
                $output = [
                    'data'      => gettext('Password Confirmation Missmatch'),
                    'reset'     => true
                ];
                echo(json_encode($output));
                exit;
            }

            // Check for reCaptcha checkbox
            if (!$post['g-recaptcha-response'])
            {
                $output = [
                    'data' => gettext('The reCAPTCHA checkbox is required')
                ];
                echo(json_encode($output));
                exit;
            }

            // Check for reCaptcha response
            $captcha = $post['g-recaptcha-response'];
            $secretKey = "6LfS5ggTAAAAAKR6w3mDTrT9i7edXNxnmhBl4Kl9";
            $ip = $_SERVER['REMOTE_ADDR'];
            $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
            $responseKeys = json_decode($response,true);
            if(intval($responseKeys["success"]) !== 1)
            {
                // ERROR
                $output = [
                    'data'      => gettext('Unable to proceed with your request at this time.'),
                    'reset'     => true,
                    'modal'     => true,
                    'redirect'  => true,
                    'location'  => 'index.php',
                    'error'     => userErrorHandler(0, "register", "reCaptcha error, potential bot")
                ];
                echo(json_encode($output));
                exit;
            }


            // query database for user
            $exist = DB::query("SELECT id FROM users WHERE user_email = ?", $post["fld_register_email"]);
            if (count($exist) == 0)
            {
                // create new account
                $currentDate = date('Y-m-d H:i:s');
                $rows = DB::query("INSERT INTO users (user_email, firstname, lastname, hash, created_date, last_loggedin_date) VALUES(?, ?, ?, ?, ?, ?)", $post["fld_register_email"], $post["fld_register_fn"], $post["fld_register_ln"], password_hash($post["fld_register_psw"], PASSWORD_DEFAULT), $currentDate, $currentDate);
                
                if (count($rows) != 0)
                {
                    // remember that user's now logged in by storing user's ID in session
                    $added = DB::query("SELECT LAST_INSERT_ID() AS id");
                    if (count($added) != 0)
                    {
                        $_SESSION["id"] = $added[0]["id"];

                        $history = DB::query("INSERT INTO login_history (user_id, login_datetime) VALUES(?, ?)", $_SESSION["id"], $currentDate);
                        // DB update error check
                        if (count($history) == 0)
                        {
                            // ERROR
                            userErrorHandler(0, "register", "unable to log 'sign in' history");
                        }

                        // Get user firstname
                        $name = DB::query("SELECT firstname FROM users WHERE id = ?", $_SESSION["id"]);
                        if (count($name) != 0)
                        {
                            // SUCCESS
                            $_SESSION["user_name"] = $name[0]["firstname"];
                            $output = [
                                'data'          => gettext('Registration Successful'),
                                'modal'         => true,
                                'redirect'      => true,
                                'location'      => 'index.php',
                                'notification'  => submitMail($post["fld_register_email"], "Registration Notification", "Thank you to register! Your sign in email is " . $post["fld_register_email"] . " Note that you can reset your password anytime via this link: LINK", "Plain text goes here")
                            ];
                            echo(json_encode($output));
                            exit;
                        }
                        else
                        {
                            // SUCCESS with bug
                            $output = [
                                'data' => gettext('Registration Successful'),
                                'modal'         => true,
                                'redirect'      => true,
                                'location'      => 'logout.php',
                                'notification'  => submitMail($post["fld_register_email"], "Registration Notification", "Thank you to register! Your sign in email is " . $post["fld_register_email"] . " Note that you can reset your password anytime via this link: LINK", "Plain text goes here"),
                                'error'         => userErrorHandler(0, "register", "New Account Registered but unable to select the last inserted firstname")
                            ];
                            echo(json_encode($output));
                            exit;
                        }
                    }
                    else
                    {
                        // SUCCESS with bug
                        $output = [
                            'data' => gettext('Registration Successful'),
                            'modal'         => true,
                            'redirect'      => true,
                            'location'      => 'logout.php',
                            'notification'  => submitMail($post["fld_register_email"], "Registration Notification", "Thank you to register! Your sign in email is " . $post["fld_register_email"] . " Note that you can reset your password anytime via this link: LINK", "Plain text goes here"),
                            'error'         => userErrorHandler(0, "register", "New Account Registered but unable to select the last inserted id")
                        ];
                        echo(json_encode($output));
                        exit;
                    }
                }

                // ERROR if not able to create new user
                else
                {   
                    // ERROR
                    $output = [
                        'data'      => gettext('Unable to proceed with your request at this time.'),
                        'modal'     => true,
                        'redirect'  => true,
                        'location'  => 'logout.php',
                        'error'     => userErrorHandler(0, "register", "unable to insert registration in the database: " . $post["fld_register_email"])
                    ];
                    echo(json_encode($output));
                    exit;
                }

            }

            // ERROR if user email exist
            else
            {
                $output = [
                    'data'      => gettext('The email address submitted is already registered.'),
                    'modal'     => true,
                    'redirect'  => true,
                    'location'  => 'logout.php',
                    'error'     => userErrorHandler(0, "register", "email address already registered: ". $post["fld_register_email"])
                ];
                echo(json_encode($output));
                exit;
            }
        }

        // ERROR
        else
        {
            userErrorHandler(0, "register", "POST submitted without the post key 'submit' set.");
            redirect("/logout.php");
        }
    }

    // ERROR
    else
    {
        userErrorHandler(0, "register", "Server request is not GET or POST");
        redirect("/logout.php");
    }