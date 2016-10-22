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
        // Sanitize $_POST and check for submit key
        $post = sanitizeForm($_POST);
        if(isset($post['save'])) 
        {
            $post['fld_profile_email'] = strtolower($post['fld_profile_email']);
            
            // Update Firstname and Lastname
            if ($post['save'] === "name")
            {
                $rows = DB::query("
                    UPDATE users SET
                        firstname = ?,
                        lastname = ?
                    WHERE id = ?",
                    $post['fld_profile_fn'], $post['fld_profile_ln'], $_SESSION["id"]);

                    $_SESSION["user_name"] = $post['fld_profile_fn'];

                // Update Done
                if ($rows != 0)
                {
                    $output = [
                        'status'    => true,
                        'firstname' => $post['fld_profile_fn'],
                        'lastname'  => $post['fld_profile_ln'],
                        'data'      => gettext('Name Updated!')
                    ];
                    echo(json_encode($output));
                    exit;
                }
                // Update Fail
                else
                {
                    $output = [
                        'status'    => true,
                        'data'      => gettext('Name Updated!'),
                        'error'     => userErrorHandler(0, "profile", "unable to update username in database")
                    ];
                    echo(json_encode($output));
                    exit;
                }
            }

            // Update Email
            else if ($post['save'] === "email")
            {
                // Check if email confrimation match
                if ($post['fld_profile_email'] != $post['fld_profile_email_confirm'])
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
                    $checkEmail = DB::query("SELECT * FROM users WHERE user_email = ?", $post['fld_profile_email']);
                    if (count($checkEmail) > 0) {
                        $output = [
                            'status'    => false,
                            'data'      => gettext('This email is already registered!')
                        ];
                        echo(json_encode($output));
                        exit;
                    }

                    // Check if password is valid
                    if (password_verify($post["fld_profile_email_psw"], $row["hash"]))
                    {   
                        $updates = DB::query("UPDATE users SET user_email = ? WHERE id = ?", $post['fld_profile_email'], $_SESSION["id"]);

                        if (count($updates) != 0)
                        {
                            $output = [
                                'status'        => true,
                                'email'         => $post['fld_profile_email'],
                                'data'          => gettext('Email updated!'),
                                'notification'  => submitMail($row["user_email"], "Email Change Notification", "Your email was updated and changed to " . $post['fld_profile_email'], "Plain text Goes Here")
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
                        'data'      => gettext('We are unable to fullfil your request at this time. Please try again later.'),
                        'error'     => userErrorHandler(0, "profile", "unable to query user: " . $post['save'])
                    ];
                    echo(json_encode($output));
                    exit;
                }
            }

            // Update Password
            else if ($post['save'] === "password")
            {
                // Check if email confrimation match
                if ($post['fld_profile_new_psw'] != $post['fld_profile_psw_confirm'])
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
                    if (password_verify($post["fld_profile_current_psw"], $row["hash"]))
                    {
                        $updates = DB::query("UPDATE users SET hash = ?, psw_reset_date = NULL, psw_attempt = 0 WHERE id = ?",
                            password_hash($post["fld_profile_new_psw"], PASSWORD_DEFAULT), $_SESSION["id"]);

                        if (count($updates) > 0)
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
                                'data'      => gettext('We are unable to fullfil your request at this time. Please try again later.'),
                                'error'     => userErrorHandler(0, "profile", "unable to update psw")
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
                        'data'      => gettext('We are unable to fullfil your request at this time. Please try again later.'),
                        'error'     => userErrorHandler(0, "profile", "unable to query user: " . $post['save'])
                    ];
                    echo(json_encode($output));
                    exit;
                }
            }

            // Delete Account
            else if ($post['save'] === "delete")
            {
                // query database for user
                $rows = DB::query("SELECT * FROM users WHERE id = ?", $_SESSION["id"]);
                if (count($rows) == 1)
                {
                    // Check if password is valid
                    $row = $rows[0];
                    if (password_verify($post['fld_profile_psw_delete'], $row["hash"]))
                    {
                        $output = [
                            'status'        => true,
                            'transfer'      => true,
                            // 'key'           => $key,
                            'key'           => getDeleteKey(),
                            'location'      => 'delete.php'
                        ];
                        echo(json_encode($output));
                        exit;
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
                        'data'      => gettext('We are unable to fullfil your request at this time. Please try again later.'),
                        'error'     => userErrorHandler(0, "profile", "unable to query user: " . $post['save'])
                    ];
                    echo(json_encode($output));
                    exit;
                }
            }

            // ERROR
            else
            {
                userErrorHandler(0, "profile", "POST 'save' type invalid");
                redirect("/logout.php");
            }
        }

        // ERROR
        else
        {
            userErrorHandler(0, "profile", "POST submitted without the post key 'submit' set.");
            redirect("/logout.php");
        }
    }

    // ERROR
    else
    {
        userErrorHandler(0, "profile", "Server request is not GET or POST");
        redirect("/logout.php");
    }