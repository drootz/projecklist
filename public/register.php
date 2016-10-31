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
        if (isset($_GET['user_email']))
        {
            render("register_form.php", "Registration", [
                'transferData'  => $_GET['user_email']
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
                    'data' => _('Email Confirmation Missmatch')
                ];
                echo(json_encode($output));
                exit;
            }

            // Check for password confirmation
            if ($post['fld_register_psw'] != $post['fld_register_psw_confirm'])
            {
                $output = [
                    'data'  => _('Password Confirmation Missmatch'),
                    'reset' => true
                ];
                echo(json_encode($output));
                exit;
            }

            // Check for reCaptcha checkbox
            if (!$post['g-recaptcha-response'])
            {
                $output = [
                    'data' => _('The reCAPTCHA checkbox is required')
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
                    'data'      => _('Unable to proceed with your request at this time.'),
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
            $exist = DB::query("SELECT * FROM users WHERE user_email = ?", $post["fld_register_email"]);
                    
            // If email exist
            if (count($exist) != 0)
            {   
                $user = $exist[0];
                $nowDate = new DateTime(date('Y-m-d H:i:s')); 
                $createdDate = new DateTime($user['created_date']);
                $interval = $nowDate->diff($createdDate);
                $dateDiff = $interval->format('%a');

                if ($user['activated'] == 0 && $dateDiff > 1)
                {
                    $deluser = DB::query("DELETE FROM users WHERE id = ?", $user["id"]);
                    if (count($deluser) == 0)
                    {
                        // ERROR
                        userErrorHandler(0, "register", "unable to delete user row. " . mysql_error());
                    }

                    $delactivation = DB::query("DELETE FROM activation WHERE user_id = ?", $user["id"]);
                    if (count($delactivation) == 0)
                    {
                        // ERROR
                        userErrorHandler(0, "register", "unable to delete activation row. " . mysql_error());
                    }
                }
                else
                {
                    // TODO: insert ajax lookup on field blur

                    $get = [
                        'user_email'    => $user["user_email"]
                    ];

                    // SUCCESS
                    $output = [
                        'data'          => _('The email address submitted is already registered.'),
                        'modal'         => true,
                        'transfer'      => true,
                        'transferData'  => http_build_query($get),
                        'redirect'      => true,
                        'location'      => 'login.php'
                    ];
                    echo(json_encode($output));
                    exit;
                }
            }

            // create new account
            $currentDate = date('Y-m-d H:i:s');
            $rows = DB::query("INSERT INTO users (user_email, firstname, lastname, hash, language, created_date, last_loggedin_date, activated) VALUES(?, ?, ?, ?, ?, ?, ?, ?)", strtolower($post["fld_register_email"]), $post["fld_register_fn"], $post["fld_register_ln"], password_hash($post["fld_register_psw"], PASSWORD_DEFAULT), $_SESSION['lang'], $currentDate, $currentDate, 0);
            
            if (count($rows) == 0)
            {  
                // ERROR
                $output = [
                    'data'      => _('Unable to proceed with your request at this time.'),
                    'modal'     => true,
                    'redirect'  => true,
                    'location'  => 'logout.php',
                    'error'     => userErrorHandler(0, "register", "unable to insert registration in the database: " . $post["fld_register_email"])
                ];
                echo(json_encode($output));
                exit;
            }
            // Send activation email to user
            $added = DB::query("SELECT LAST_INSERT_ID() AS id");
            if (count($added) != 0)
            {
                //create a random key
                $key = $post["fld_register_fn"] . $post["fld_register_email"] . date('mydhis');
                $key = md5($key);
                             
                //add confirm row
                $activation = DB::query("INSERT INTO activation (user_id, user_email, user_name, user_key) VALUES(?, ?, ?, ?)", $added[0]["id"], strtolower($post["fld_register_email"]), $post["fld_register_fn"], $key);
                if (count($activation) == 0)
                {
                    // ERROR
                    userErrorHandler(0, "register", "Activation row was not added to the database." . mysql_error());
                }

                //put info into an array to send to the function
                $info = array(
                    'locale'    => $_SESSION['lang'],
                    'template'  => 'signup_template',
                    'subject'   => _('Welcome to Projecklist!'),
                    'username'  => $post["fld_register_fn"],
                    'email'     => strtolower($post["fld_register_email"]),
                    'key'       => $key
                );

                $history = DB::query("INSERT INTO login_history (user_id, login_datetime) VALUES(?, ?)", $added[0]["id"], $currentDate);
                // DB update error check
                if (count($history) == 0)
                {
                    // ERROR
                    userErrorHandler(0, "register", "unable to log 'sign in' history");
                }


                $get = [
                    'user_id'       => $added[0]["id"],
                    'user_email'    => strtolower($post["fld_register_email"]),
                    'new'           => true
                ];

                // SUCCESS
                $output = [
                    'transfer'      => true,
                    'transferData'  => http_build_query($get),
                    'redirect'      => true,
                    'location'      => 'registered.php',
                    'notification'  => notificationMail($info)
                ];
                echo(json_encode($output));
                exit;
            }
            else
            {
                userErrorHandler(0, "register", "registration failed, unable to select last inserted id");
                redirect("/logout.php");
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