<?php

	require_once(__DIR__ . "/../includes/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {

        $projeckts = [];
        // Generate Project Reference
        $rows = DB::query("SELECT * FROM projecklist WHERE user_id = ?", $_SESSION['id']);
        if (count($rows) > 0)
        {
            foreach ($rows as $row)
            {    
                $t = strtotime($row['lastmodified_datetime']);
                $projeckts[] = [
                    "projeckt_id"               => $row['id'],
                    "projeckt_ref"              => $row['projeckt_ref'],
                    "fld_project_name"          => $row['fld_project_name'],
                    "lastmodified_datetime"     => date('Y/m/d',$t)
                ];
            }


            render("archive.php", _("Archive"),[
                'projeckts'  => $projeckts
            ]);

        }
        else
        {
            render("archive.php", _("Archive"));
        }

    }
    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // Sanitize $_POST and check for submit key
        $post = sanitizeForm($_POST);

        // Delete a projekt record
        if(isset($post['delete'])) 
        {
            $deletion = DB::query("DELETE FROM projecklist WHERE id = ?", $post['delete']);
            if (count($deletion) != 0)
            {
                // CAN't Decrement or this affects projects reference numbers...
                // $users = DB::query("SELECT * FROM users WHERE id = ?", $_SESSION['id']);
                // if (count($users) != 0)
                // {
                //     $count = $users[0]['project_count'] - 1;
                //     $updateDate = DB::query("UPDATE users SET project_count = ? WHERE id = ?", $count, $_SESSION['id']);
                //     if (count($updateDate) == 0)
                //     {
                //         userErrorHandler(0, "projeckt", "unable to decrement users project count.");
                //     }
                // }

                $output = [
                    'del_id'    => '#' . $post['delete']
                ];
                echo(json_encode($output));
                exit;
            }
            else
            {
                $output = [
                    'data'      => _('Unable to delete your project at this time.'),
                    'modal'     => true
                ];
                echo(json_encode($output));
                exit;
            }
        }

        // Delete a projekt record
        else if(isset($post['send'])) 
        {
            // Generate Project Reference
            $rows = DB::query("SELECT * FROM projecklist WHERE id = ?", $post['send']);
            if (count($rows) != 0)
            {
                $getVal = projectFilter($rows[0]);

                $textFile = formatAttachment($getVal['value'], "txt");
                $file_txt = createAttachment($textFile, "txt", $rows[0]['id']);

                $markdownFile = formatAttachment($getVal['value'], "md");
                $file_md = createAttachment($markdownFile, "md", $rows[0]['id']);

                // SEND MAIL
                if ($file_txt != false && $file_md != false)
                {
                    $users = DB::query("SELECT * FROM users WHERE id = ?", $_SESSION['id']);
                    if (count($users) != 0)
                    {
                        // Send Email
                        $file_txt_name = "Projecklist_ref_" . $file_txt . ".txt";
                        $file_md_name = "Projecklist_ref_" . $file_md . ".md";

                        //put info into an array to send to the function
                        $info = array(
                            'locale'    => $_SESSION['lang'],
                            'template'  => 'submit_template',
                            'subject'   => _('Project ID: ') . $rows[0]['projeckt_ref'] . " " . $rows[0]['fld_project_name'],
                            'username'  => $users[0]["firstname"],
                            'email'     => $users[0]["user_email"],
                            'f_txt'     => $file_txt_name,
                            'f_md'      => $file_md_name,
                            'pref'      => ", ref: " . $rows[0]['projeckt_ref'] . ", ",
                            'pname'     => $rows[0]['fld_project_name']
                        );

                        $output = [
                            'data'          => _('Project sucessfully sent. Check your mailbox!'),
                            'modal'         => true,
                            'redirect'      => true,
                            'location'      => 'archive.php',
                            'notification'  => notificationMail($info)
                        ];
                        echo(json_encode($output));
                        exit;
                    }
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
    else
    {

    }

?>