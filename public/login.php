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
            render("login_form.php", "Sign in", [
                'user_email'    => $_GET['user_email']
            ]);  
        }
        else
        {
            render("login_form.php", "Sign in");
        }
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {   
        // Sanitize $_POST and check for submit key
        $post = sanitizeForm($_POST);
        if(isset($post['submit'])) 
        {
            $login_email = strtolower($post["fld_login_email"]);
            // query database for user
            $rows = DB::query("SELECT * FROM users WHERE user_email = ?", $login_email);

            // if we found user, check password
            if (count($rows) == 1)
            {
                // first (and only) row
                $row = $rows[0];

                if ($row['activated'] != true)
                {
                    $get = [
                        'user_id'       => $row['id'],
                        'user_email'    => $row['user_email']
                    ];
                    // transfer to registered page if account not activated
                    $output = [
                        'transfer'      => true,
                        'transferData'  => http_build_query($get),
                        'redirect'      => true,
                        'location'      => 'registered.php'
                    ];
                    echo(json_encode($output));
                    exit;
                }

                // compare hash of user's input against hash that's in database
                else if (password_verify($post["fld_login_psw"], $row["hash"]))
                {
                    $now = date('Y-m-d H:i:s');

                    // If this is a temporary password. Redirect user to password update screens...
                    if ($row['psw_reset_date'] != NULL)
                    {
                        $currentDate = new DateTime(date('Y/m/d')); 
                        $resetDate   = new DateTime($row['psw_reset_date']);
                        $interval = $currentDate->diff($resetDate);
                        $dateDiff = $interval->format('%a');

                        // Check if temporary password has expired
                        if ($dateDiff < 2)
                        {
                            // remember that user's now logged in by storing user's ID in session
                            $_SESSION["id"] = $row["id"];
                            $_SESSION["user_name"] = $row["firstname"];

                            // Reset password attempt counter on successful sign in
                            $attemptReset = DB::query("UPDATE users SET psw_attempt = 0, psw_unlock_datetime = NULL, last_loggedin_date = ? WHERE user_email = ?", $now, $login_email);
                            if (count($attemptReset) == 0)
                            {
                                // ERROR
                                userErrorHandler(0, "login", "Password attempt reset failed 1");
                            }

                            // Login history log
                            $history = DB::query("INSERT INTO login_history (user_id, login_datetime) VALUES(?, ?)", $_SESSION["id"], $now);
                            if (count($history) == 0)
                            {
                                // ERROR
                                userErrorHandler(0, "login", "unable to log 'sign in' history");
                            }

                            // SUCCES, redirect to profile page
                            $output = [
                                'data'      => gettext('Please change the temporary password before it expires on your profile page.'),
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
                            $attemptReset = DB::query("UPDATE users SET psw_attempt = 0 WHERE user_email = ?", $login_email);
                            if (count($attemptReset) == 0)
                            {
                                // ERROR
                                userErrorHandler(0, "login", "Password attempt reset failed 2");
                            }

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
                    else if ($row['psw_unlock_datetime'] != NULL)
                    {
                        $nowStamp = date('Y-m-d H:i:s');
                        $now = new DateTime($nowStamp);
                        $unlockDatetime = new DateTime($row['psw_unlock_datetime']);

                        // If lock expired
                        if ($now > $unlockDatetime)
                        {
                            // remember that user's now logged in by storing user's ID in session
                            $_SESSION["id"] = $row["id"];
                            $_SESSION["user_name"] = $row["firstname"];

                            // Reset password attempt counter on successful sign in
                            $attemptReset = DB::query("UPDATE users SET psw_attempt = 0, psw_unlock_datetime = NULL, last_loggedin_date = ? WHERE user_email = ?", $nowStamp, $login_email);
                            if (count($attemptReset) == 0)
                            {
                                // ERROR
                                userErrorHandler(0, "login", "Password attempt reset failed 3");
                            }

                            // Login history log
                            $history = DB::query("INSERT INTO login_history (user_id, login_datetime) VALUES(?, ?)", $_SESSION["id"], $nowStamp);
                            if (count($history) == 0)
                            {
                                // ERROR
                                userErrorHandler(0, "login", "unable to log 'sign in' history");
                            }

                            $output = [
                                'redirect' => true,
                                'location' => 'index.php'
                            ];
                            echo(json_encode($output));
                            exit;
                        }

                        // If unlock not expired
                        else
                        {
                            $output = [
                                'data' => gettext("Maximum password attempts reached.<br/><span style=\"font-weight: normal;\">Your account is locked for ") . getTimeLapse($now, $unlockDatetime) . gettext(". Please try again later or reset your password manually.</span> (1)"),
                                    'reset' => true
                            ];
                            echo(json_encode($output));
                            exit;
                        }
                    }

                    // Successful sign in
                    else
                    {
                        // remember that user's now logged in by storing user's ID in session
                        $_SESSION["id"] = $row["id"];
                        $_SESSION["user_name"] = $row["firstname"];

                        // Reset password attempt counter on successful sign in
                        $attemptReset = DB::query("UPDATE users SET psw_attempt = 0, psw_unlock_datetime = NULL, last_loggedin_date = ? WHERE user_email = ?", $now, $login_email);
                        if (count($attemptReset) == 0)
                        {
                            // ERROR
                            userErrorHandler(0, "login", "Password attempt reset failed 3");
                        }

                        // Login history log
                        $history = DB::query("INSERT INTO login_history (user_id, login_datetime) VALUES(?, ?)", $_SESSION["id"], $now);
                        if (count($history) == 0)
                        {
                            // ERROR
                            userErrorHandler(0, "login", "unable to log 'sign in' history");
                        }

                        $output = [
                            'redirect' => true,
                            'location' => 'index.php'
                        ];
                        echo(json_encode($output));
                        exit;
                    }
                }

                // Password is invalid
                else
                {
                    // Password Attemps Check
                    $attempt_count = DB::query("SELECT psw_attempt FROM users WHERE user_email = ?", $login_email);
                    if (count($attempt_count) == 0)
                    {
                        // ERROR
                        userErrorHandler(0, "register", "unable to get attempts count");
                    }

                    $attempt_count = $attempt_count[0] == 0 ? $attempt_count[0] : 0;
                    $minutes_to_add = $attempt_count['psw_attempt'] < 15 ? ($attempt_count['psw_attempt'] * 17) : (15 * 17);

                    // Increment psw attempts up to 5 attemps
                    if ($attempt_count['psw_attempt'] < 4)
                    {
                        // Increment attempt count 
                        $attempts = $attempt_count['psw_attempt'] + 1;
                        $increment = DB::query("UPDATE users SET psw_attempt = ? WHERE user_email = ?", $attempts, $login_email);
                        if (count($increment) == 0)
                        {
                            // ERROR unable to increment first psw attempt count
                        }

                        $output = [
                            'data'  => gettext('Invalid username and/or password.'),
                            'reset' => true
                        ];
                        echo(json_encode($output));
                        exit;
                    }

                    // If attempts exceeded 5
                    else
                    {
                        // Check if account already locked
                        if ($row['psw_unlock_datetime'] == NULL)
                        {
                            $now = new DateTime(date('Y-m-d H:i:s'));
                            $unlockDatetime = new DateTime(date('Y-m-d H:i:s'));
                            $unlockDatetime->add(new DateInterval('PT' . 17 . 'M')); // +17min
                            $unlockTimestamp = $unlockDatetime->format('Y-m-d H:i:s');

                            // Set new attempt count and update lock and unlock date (+17 min)
                            $attempts = $attempt_count['psw_attempt'] + 1;
                            $increment = DB::query("UPDATE users SET psw_attempt = ?, psw_unlock_datetime = ? WHERE user_email = ?", $attempts, $unlockTimestamp, $login_email);
                            if (count($increment) == 0)
                            {
                                userErrorHandler(0, "register", "unable to set an unlock date");
                            }

                            $output = [
                                'data'  => gettext("Maximum password attempts reached.<br/><span style=\"font-weight: normal;\">Your account is locked for ") . getTimeLapse($now, $unlockDatetime) . gettext(". Please try again later or reset your password manually.</span> (2)"),
                                'reset' => true
                            ];
                            echo(json_encode($output));
                            exit;
                        }

                        // Account locked
                        else
                        {
                            $now = new DateTime(date('Y-m-d H:i:s'));
                            $unlockDatetime = new DateTime($row['psw_unlock_datetime']);
                            $unlockTimestamp = $unlockDatetime->format('Y-m-d H:i:s');
                            $timeInterval = $now->diff($unlockDatetime);
                            $dayDiff = $timeInterval->format('%d');

                            // If unlock date is less than 24 hours, update existing unlock date
                            if ($now < $unlockDatetime && $dayDiff < 1)
                            {
                                $unlockDatetime->add(new DateInterval('PT' . $minutes_to_add . 'M'));
                                $unlockTimestamp = $unlockDatetime->format('Y-m-d H:i:s');

                                // Set new attempt count and update unlocked date (+17min)
                                $attempts = $attempt_count['psw_attempt'] + 1;
                                $increment = DB::query("UPDATE users SET psw_attempt = ?, psw_unlock_datetime = ? WHERE user_email = ?", $attempts, $unlockTimestamp, $login_email);
                                if (count($increment) == 0)
                                {
                                    userErrorHandler(0, "register", "unable to update existing unlock date");
                                }

                                $output = [
                                    'data'  => gettext("Maximum password attempts reached.<br/><span style=\"font-weight: normal;\">Your account is locked for ") . getTimeLapse($now, $unlockDatetime) . gettext(". Please try again later or reset your password manually.</span> (3)"),
                                    'reset' => true
                                ];
                                echo(json_encode($output));
                                exit;
                            }

                            // If unlock date is more than 24 hours, just outpur an error message to user
                            else if ($now < $unlockDatetime )
                            {
                                $output = [
                                    'data'  => gettext("Maximum password attempts reached.<br/><span style=\"font-weight: normal;\">Your account is locked for ") . getTimeLapse($now, $unlockDatetime) . gettext(". Please try again later or reset your password manually.</span> (4)"),
                                    'reset' => true
                                ];
                                echo(json_encode($output));
                                exit;
                            }

                            // If unlock date is passed, set a new unlock date
                            else
                            {
                                $unlockDatetime = new DateTime(date('Y-m-d H:i:s'));
                                $unlockDatetime->add(new DateInterval('PT' . $minutes_to_add . 'M'));
                                $unlockTimestamp = $unlockDatetime->format('Y-m-d H:i:s');

                                // Set new attempt count and update lock and unlock date (+17 min)
                                $attempts = $attempt_count['psw_attempt'] + 1;
                                $increment = DB::query("UPDATE users SET psw_attempt = ?, psw_unlock_datetime = ? WHERE user_email = ?", $attempts, $unlockTimestamp, $login_email);
                                if (count($increment) == 0)
                                {
                                    userErrorHandler(0, "register", "unable to set 'new' unlock date");
                                }

                                $output = [
                                    'data'  => gettext("Maximum password attempts reached.<br/><span style=\"font-weight: normal;\">Your account is locked for ") . getTimeLapse($now, $unlockDatetime) . gettext(". Please try again later or reset your password manually.</span> (5)"),
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

                $get = [
                    'user_email'    => $login_email
                ];

                // transfer to register page if email provided is not already registered
                $output = [
                    'modal'         => true,
                    'data'          => 'This email is not registered.',
                    'transfer'      => true,
                    'transferData'  => http_build_query($get),
                    'location'      => 'register.php'
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