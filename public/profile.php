<?php
    require_once(__DIR__ . "/../includes/config.php");
    
    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // query database for user
        $rows = DB::query("SELECT * FROM users WHERE id = ?", $_SESSION["id"]);

        if ($rows != 0)
        {
            // else render form
            render("profile_form.php", "Profile", [
                "email" => $rows[0]["user_email"],
                "firstname" => $rows[0]["firstname"],
                "lastname" => $rows[0]["lastname"]
            ]);
        }
        else
        {
            redirect("/logout.php");
        }
    }
    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $sanitized_post = sanitizeForm($_POST);
        if(isset($sanitized_post['save'])) 
        {
            // Update Firstname and Lastname
            if ($sanitized_post['save'] === "name")
            {
                $rows = DB::query("
                    UPDATE users SET
                        firstname = ?,
                        lastname = ?
                    WHERE id = ?",
                    $sanitized_post['fld_profile_fn'], $sanitized_post['fld_profile_ln'], $_SESSION["id"]);

                    $_SESSION["user_name"] = $sanitized_post['fld_profile_fn'];

                // Update Done
                if ($rows != 0)
                {
                    $output = [
                        'status'    => true,
                        'firstname' => $sanitized_post['fld_profile_fn'],
                        'lastname'  => $sanitized_post['fld_profile_ln'],
                        'data'      => gettext('Name Updated!')
                    ];
                    echo(json_encode($output));
                    exit;
                }
                // Update Fail
                else
                {
                    $output = [
                        'data'  => gettext('Name Updated!')
                    ];
                    echo(json_encode($output));
                    exit;
                }
            }

            // Update Email
            else if ($sanitized_post['save'] === "email")
            {
                // Check if email confrimation match
                if ($sanitized_post['fld_profile_email'] != $sanitized_post['fld_profile_email_confirm'])
                {
                    $output = [
                        'status'    => false,
                        'data'      => gettext('Email confirmation missmatch!')
                    ];
                    echo(json_encode($output));
                    exit;
                }

                // query database for user
                $rows = DB::query("SELECT * FROM users WHERE id = ?", $_SESSION["id"]);
                $row = $rows[0];
                if (count($rows) == 1)
                {
                    // Check if the requested email is already registered
                    $checkEmail = DB::query("SELECT * FROM users WHERE user_email = ?", $sanitized_post['fld_profile_email']);
                    if (count($checkEmail) > 0) {
                        $output = [
                            'status'    => false,
                            'data'      => gettext('This email is already registered!')
                        ];
                        echo(json_encode($output));
                        exit;
                    }

                    // Check if password is valid
                    if (password_verify($sanitized_post["fld_profile_email_psw"], $row["hash"]))
                    {   
                        $updates = DB::query("UPDATE users SET user_email = ? WHERE id = ?", $sanitized_post['fld_profile_email'], $_SESSION["id"]);

                        if (count($updates) != 0)
                        {
                            $output = [
                                'status'        => true,
                                'email'         => $sanitized_post['fld_profile_email'],
                                'data'          => gettext('Email updated!'),
                                'notification'  => submitMail($row["user_email"], "Email Change Notification", "Your email was updated and changed to " . $sanitized_post['fld_profile_email'], "Plain text Goes Here")
                            ];
                            echo(json_encode($output));
                            exit;
                        }
                        else
                        {
                            $output = [
                                'status'    => false,
                                'data'      => gettext('Email updated!')
                            ];
                            echo(json_encode($output));
                            exit;
                        }
                    }
                    else
                    {   
                        $output = [
                            'status'    => false,
                            'data'      => gettext('Invalid password!')
                        ];
                        echo(json_encode($output));
                        exit;
                    }
                }
                else
                {
                    $output = [
                        'status'    => false,
                        'data'      => gettext('We are unable to fullfil your request at this time. Please try again later.')
                    ];
                    echo(json_encode($output));
                    exit;
                }

            }

            // Update Password
            else if ($sanitized_post['save'] === "password")
            {
                // Check if email confrimation match
                if ($sanitized_post['fld_profile_new_psw'] != $sanitized_post['fld_profile_psw_confirm'])
                {
                    $output = [
                        'status'    => false,
                        'data'      => gettext('Password confirmation missmatch!')
                    ];
                    echo(json_encode($output));
                    exit;
                }

                // query database for user
                $rows = DB::query("SELECT * FROM users WHERE id = ?", $_SESSION["id"]);
                if (count($rows) == 1)
                {
                    // Check if password is valid
                    $row = $rows[0];
                    if (password_verify($sanitized_post["fld_profile_current_psw"], $row["hash"]))
                    {
                        $updates = DB::query("UPDATE users SET hash = ?, reset_date = NULL, psw_attempt = 0 WHERE id = ?",
                            password_hash($sanitized_post["fld_profile_new_psw"], PASSWORD_DEFAULT), $_SESSION["id"]);

                        if (count($updates) != 0)
                        {
                            $output = [
                                'status'    => true,
                                'data'      => gettext('Password updated!'),
                                'notification' => submitMail($row["user_email"], "Password Change Notification", "Your password was updated! If you did not change your password we recommend you to reset your password now via this link: LINK", "Plain text goes here")
                            ];
                            echo(json_encode($output));
                            exit;
                        }
                        else
                        {
                            $output = [
                                'status'    => false,
                                'data'      => gettext('Password updated!'),
                                'notification' => submitMail($row["user_email"], "Password Change Notification", "Your password was updated! If you did not change your password we recommend you to reset your password now via this link: LINK", "Plain text goes here")
                            ];
                            echo(json_encode($output));
                            exit;
                        }
                    }
                    else
                    {
                        $output = [
                            'status'    => false,
                            'data'      => gettext('Invalid password!')
                        ];
                        echo(json_encode($output));
                        exit;
                    }
                }
                else
                {
                    $output = [
                        'status'    => false,
                        'data'      => gettext('We are unable to fullfil your request at this time. Please try again later.')
                    ];
                    echo(json_encode($output));
                    exit;
                }

            }
            else
            {
                $output = [
                    'status'    => false,
                    'data'      => gettext('We are unable to fullfil your request at this time. Please try again later.')
                ];
                echo(json_encode($output));
                exit;
            }
        }
        else
        {
            $output = [
                'status'    => false,
                'data'      => gettext('We are unable to fullfil your request at this time. Please try again later.')
            ];
            echo(json_encode($output));
            exit;
        }
    }