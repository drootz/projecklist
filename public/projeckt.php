<?php

	require_once(__DIR__ . "/../includes/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        if (isset($_GET['pid']) && isset($_GET['ref']))
        {
            render("projeckt_form.php", _("Projeckt Form"),[
                'pid' => $_GET['pid'],
                'ref' => $_GET['ref'],
                'pname' => $_GET['pname']
            ]);   
        }
        else
        {
            render("projeckt_form.php", _("Projeckt Form"));   
        }
    }
    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
		if(isset($_POST['submit'])) 
        {
            $post = sanitizeForm($_POST);

            // IF USER AUTHENTICATED => SAVE
            if ($post['submit'] == 'save' && isset($_SESSION['id']))
            {
                // IF EXISTING PROJECT
                if(isset($post['f_pid_exist']))
                {
                    // query database for projekt name for this user
                    $exist = DB::query("SELECT id FROM projecklist WHERE user_id = ? AND fld_project_name = ?", $_SESSION['id'], $post['fld_project_name']);
                    // If name exist
                    if (count($exist) != 0)
                    {
                        if ($exist[0]['id'] != $post['f_pid_exist'])
                        {
                            // ERROR
                            $output = [
                                'data'      => _('This Project name is already registered.')
                            ];
                            echo(json_encode($output));
                            exit;
                        }
                    }


                    // Clear table of all possible post values
                    $clean = DB::query("SELECT * FROM projecklist WHERE id = ?", $post['f_pid_exist']);
                    // If name exist
                    if (count($clean) != 0)
                    {
                        // Clear existing post values
                        foreach ($clean[0] as $key => $value) {
                            if ($key != 'id' && $key != 'user_id' && $key != 'projeckt_ref' && $key != 'lastmodified_datetime')
                            {
                                $q = "UPDATE projecklist SET " . $key . " = NULL WHERE id = ?";
                                $dels = DB::query($q, $post['f_pid_exist']);
                                if (count($dels) == 0)
                                {
                                    userErrorHandler(0, "projeckt", $key." value was not deleted from the database.");
                                }   
                            }
                        }
                    }


                    // update existing row
                    $updateRow = DB::query("UPDATE projecklist SET lastmodified_datetime = ? WHERE id = ?", date('Y-m-d H:i:s'), $post['f_pid_exist']);
                    if (count($updateRow) == 0)
                    {
                        userErrorHandler(0, "projeckt", "unable to update lastmodified_datetime.");   
                    }


                    foreach ($post as $key => $value) {
                        if ($key != 'submit' && $key != 'f_pid_exist')
                        {
                            if ($value != "")
                            {
                                $q = "UPDATE projecklist SET " . $key . " = ? WHERE id = ?";
                                $adds = DB::query($q, $value, $post['f_pid_exist']);
                                if (count($adds) == 0)
                                {
                                    // ERROR
                                    $output = [
                                        'data'      => _('Unable to save all form fields at this time. Please try again.'),
                                        'modal'     => true,
                                        'redirect'  => true,
                                        'location'  => 'projeckt.php',
                                        'error'     => userErrorHandler(0, "projeckt", $key." value was not added to the database.")
                                    ];
                                    echo(json_encode($output));
                                    exit;
                                }   
                            }
                        }
                    }

                    // SUCCESS
                    $output = [
                        'data'          => _('Project ID ') . $clean[0]['projeckt_ref'] . _(' Saved!'),
                        'modal'         => true,
                        'redirect'      => true,
                        'location'      => 'archive.php'
                    ];
                    echo(json_encode($output));
                    exit;
                }

                // IF NEW PROJECT
                else
                {
                    // query database for projeckt name for this user if it exist already
                    $exist = DB::query("SELECT id FROM projecklist WHERE user_id = ? AND fld_project_name = ?", $_SESSION['id'], $post['fld_project_name']);
                            
                    // If name exist
                    if (count($exist) != 0)
                    {   
                        // Name exist
                        $output = [
                            'data'      => _('This Project name is already registered.'),
                            'modal'     => true
                        ];
                        echo(json_encode($output));
                        exit;
                    }

                    // Generate Project Reference
                    $rows = DB::query("SELECT * FROM users WHERE id = ?", $_SESSION['id']);
                    if (count($rows) != 0)
                    {
                        $count = $rows[0]['project_count'] + 1;
                        $newcount = DB::query("UPDATE users SET project_count = ? WHERE id = ?", $count, $_SESSION['id']);
                        if (count($newcount) == 0)
                        {
                            userErrorHandler(0, "projeckt", "unable to increment users project count.");
                        }

                        $today = date('ymd');
                        $project_ref = $today . "-" . $count;
                    }
                    else
                    {
                        $project_ref = "YYMMDD-9999";
                    }

                    // Add new row
                    $newRow = DB::query("INSERT INTO projecklist (user_id, projeckt_ref, lastmodified_datetime) VALUES(?, ?, ?)", $_SESSION['id'], $project_ref, date('Y-m-d H:i:s'));
                    if (count($newRow) == 0)
                    {
                        $output = [
                            'data'      => _('Unable to proceed with your request at this time.'),
                            'modal'     => true,
                            'redirect'  => true,
                            'location'  => 'projeckt.php',
                            'error'     => userErrorHandler(0, "projeckt", "user_id row was not added to the database.")
                        ];
                        echo(json_encode($output));
                        exit;
                    }

                    // Select last inserted ID
                    $lastInsert = DB::query("SELECT LAST_INSERT_ID() AS id");
                    if (count($lastInsert) == 0)
                    {
                        // ERROR
                        $output = [
                            'data'      => _('Unable to proceed with your request at this time.'),
                            'modal'     => true,
                            'redirect'  => true,
                            'location'  => 'projeckt.php',
                            'error'     => userErrorHandler(0, "projeckt", "unable to select last inserted ID.")
                        ];
                        echo(json_encode($output));
                        exit;
                    }
                    else
                    {

                        foreach ($post as $key => $value) {
                            
                            if ($key != 'submit')
                            {
                                if ($value != "")
                                {
                                    $q = "UPDATE projecklist SET " . $key . " = ? WHERE id = ?";
                                    $adds = DB::query($q, $value, $lastInsert[0]['id']);
                                    if (count($adds) == 0)
                                    {
                                        // ERROR
                                        $output = [
                                            'data'      => _('Unable to save all form fields at this time. Please try again.'),
                                            'modal'     => true,
                                            'redirect'  => true,
                                            'location'  => 'projeckt.php',
                                            'error'     => userErrorHandler(0, "projeckt", $key." value was not added to the database.")
                                        ];
                                        echo(json_encode($output));
                                        exit;
                                    }   
                                }
                            }
                        }
                    }

                    // SUCCESS
                    $output = [
                        'data'          => _('Saved!'),
                        'modal'         => true,
                        'redirect'      => true,
                        'location'      => 'archive.php'
                    ];
                    echo(json_encode($output));
                    exit;
                }
            }

            // IF USER UNAUTHENTICATED => SUBMIT
            else if ($post['submit'] == 'submit')
            {
                if (empty($_SESSION['id']))
                {
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

                }

                $getVal = projectFilter($post);

                $textFile = formatAttachment($getVal['value'], "txt");
                $file_txt = createAttachment($textFile, "txt");

                $markdownFile = formatAttachment($getVal['value'], "md");
                $file_md = createAttachment($markdownFile, "md");

                // SEND MAIL
                if ($file_txt != false && $file_md != false)
                {
                    // Send Email
                    $file_txt_name = "Projecklist_ref_" . $file_txt . ".txt";
                    $file_md_name = "Projecklist_ref_" . $file_md . ".md";

                    //put info into an array to send to the function
                    $info = array(
                        'locale'    => $_SESSION['lang'],
                        'template'  => 'submit_template',
                        'subject'   => _('Project Name: ') . $post['fld_project_name'],
                        'username'  => $post["fld_contact_primary_fn"],
                        'email'     => $post["eml_contact_primary_email"],
                        'f_txt'     => $file_txt_name,
                        'f_md'      => $file_md_name,
                        'pref'      => "",
                        'pname'     => $post['fld_project_name']
                    );

                    $output = [
                        'data'          => _('Project sucessfully sent. Check your mailbox!'),
                        'modal'         => true,
                        'redirect'      => true,
                        'location'      => 'projeckt.php',
                        'notification'  => notificationMail($info)
                    ];
                    echo(json_encode($output));
                    exit;
                }

                // ERROR
                else
                {
                    $output = [
                        'data'      => _('Unable to submit your project at this time.'),
                        'modal'     => true
                    ];
                    echo(json_encode($output));
                    exit;
                }
            }
		}
    }

?>