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
            render("profile_form.php", _("Profile"), [
                "email" => $rows[0]["user_email"],
                "language" => $rows[0]["language"],
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
                        'data'      => _('Name Updated!')
                    ];
                    echo(json_encode($output));
                    exit;
                }
                // Update Fail
                else
                {
                    $output = [
                        'status'    => true,
                        'data'      => _('Name Updated!')
                        // 'error'     => userErrorHandler(0, "profile", "unable to update username in database")
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
                        'data'      => _('Email confirmation missmatch!')
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
                    $checkEmail = DB::query("SELECT * FROM users WHERE user_email = ?", strtolower($post['fld_profile_email']));
                    if (count($checkEmail) > 0) {
                        $output = [
                            'status'    => false,
                            'data'      => _('This email is already registered!')
                        ];
                        echo(json_encode($output));
                        exit;
                    }

                    // Check if password is valid
                    if (password_verify($post["fld_profile_email_psw"], $row["hash"]))
                    {   
                        $updates = DB::query("UPDATE users SET user_email = ? WHERE id = ?", strtolower($post['fld_profile_email']), $_SESSION["id"]);

                        $history = DB::query("INSERT INTO email_history (email_previous, email_new, change_datetime) VALUES(?, ?, ?)", $row["user_email"], strtolower($post['fld_profile_email']), date('Y-m-d H:i:s'));
                        if (count($history) == 0)
                        {
                            // ERROR
                            userErrorHandler(0, "profile", "unable to log email history");
                        }

                        if (count($updates) != 0)
                        {
                            //put info into an array to send to the function
                            $info = array(
                                'locale'    => $_SESSION['lang'],
                                'template'  => 'emailchange_template',
                                'subject'   => _('Your account email changed'),
                                'altemail' => strtolower($post['fld_profile_email']),
                                'username'  => $row["firstname"],
                                'email'     => $row["user_email"]
                            );

                            $output = [
                                'status'        => true,
                                'email'         => $post['fld_profile_email'],
                                'data'          => _('Email updated!'),
                                'notification'  => notificationMail($info)
                            ];
                            echo(json_encode($output));
                            exit;
                        }
                        else
                        {
                            $output = [
                                'status'    => false,
                                'data'      => _('Email updated!')
                            ];
                            echo(json_encode($output));
                            exit;
                        }
                    }
                    else
                    {   
                        $output = [
                            'status'    => false,
                            'data'      => _('Invalid password!')
                        ];
                        echo(json_encode($output));
                        exit;
                    }
                }
                else
                {
                    $output = [
                        'status'    => false,
                        'data'      => _('We are unable to fullfil your request at this time. Please try again later.'),
                        'error'     => userErrorHandler(0, "profile", "unable to query user: " . $post['save'])
                    ];
                    echo(json_encode($output));
                    exit;
                }
            }

            // Update Language
            else if ($post['save'] === "lang")
            {

                $updates = DB::query("UPDATE users SET language = ? WHERE id = ?", $post['opt_lang'], $_SESSION["id"]);

                if (count($updates) != 0)
                {
                    $_SESSION['lang'] = $post['opt_lang'];

                    $get = [
                        'lang'       => $post['opt_lang']
                    ];

                    $output = [
                        'status'    => true,
                        'language'  => array_search($post['opt_lang'], $_SESSION['form_PO_support']),
                        'data'      => _('Language Updated!'),
                        'transfer'      => true,
                        'transferData'  => http_build_query($get),
                        'redirect'      => true,
                        'location'      => 'profile.php'
                    ];
                    echo(json_encode($output));
                    exit;
                }
                else
                {
                    $output = [
                        'status'    => false,
                        'data'      => _('Email updated!')
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
                        'data'      => _('Password confirmation missmatch!')
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
                        $updates = DB::query("UPDATE users SET hash = ?, psw_reset_date = NULL, psw_attempt = 0, psw_unlock_datetime = NULL WHERE id = ?",
                            password_hash($post["fld_profile_new_psw"], PASSWORD_DEFAULT), $_SESSION["id"]);

                        if (count($updates) > 0)
                        {
                            //put info into an array to send to the function
                            $info = array(
                                'locale'    => $_SESSION['lang'],
                                'template'  => 'pswchange_template',
                                'subject'   => _('Your password changed'),
                                'username'  => $row["firstname"],
                                'email'     => $row["user_email"]
                            );

                            $output = [
                                'status'    => true,
                                'data'      => _('Password updated!'),
                                'notification'  => notificationMail($info)
                            ];
                            echo(json_encode($output));
                            exit;
                        }
                        else
                        {
                            $output = [
                                'status'    => false,
                                'data'      => _('We are unable to fullfil your request at this time. Please try again later.'),
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
                            'data'      => _('Invalid password!')
                        ];
                        echo(json_encode($output));
                        exit;
                    }
                }
                else
                {
                    $output = [
                        'status'    => false,
                        'data'      => _('We are unable to fullfil your request at this time. Please try again later.'),
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
                            'data'      => _('Invalid password!')
                        ];
                        echo(json_encode($output));
                        exit;
                    }
                }
                else
                {
                    $output = [
                        'status'    => false,
                        'data'      => _('We are unable to fullfil your request at this time. Please try again later.'),
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