<?php

    // configuration
    require("../includes/config.php"); 

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // Render Form
        render("contact_form.php", _("Contact Us"));
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {   
        // Sanitize $_POST and check for submit key
        $post = sanitizeForm($_POST);
        if(isset($post['submit'])) 
        {
            // query database for user
            $users = DB::query("SELECT * FROM users WHERE id = ?", $_SESSION["id"]);
            if (count($users) != 0)
            {
                $user = $users[0];
                $contacts = DB::query(
                    "INSERT INTO contact_us (user_id, reason, text_body, contact_datetime) VALUES(?, ?, ?, ?)", 
                    $_SESSION["id"], $post["opt_reason"], $post["txt_contact"], date('Y-m-d H:i:s') );
                // DB update error check
                if (count($contacts) == 0)
                {
                    userErrorHandler(0, "contact_us", "unable to add correspondence to contact_us table");
                    redirect("/logout.php");
                }

                // Send activation email to user
                $added = DB::query("SELECT LAST_INSERT_ID() AS id");
                if (count($added) == 0)
                {
                    userErrorHandler(0, "contact_us", "unable to select last inserted id");
                    redirect("/logout.php");
                }

                $contextRef = '000';
                $uniqueRef = $added[0]["id"];
                $subject = _('Contact Us Ref# ') . $contextRef . $uniqueRef . " | " . $post["opt_reason"];

                //put info into an array to send to the function
                $info = array(
                    'locale'            => $_SESSION['lang'],
                    'template'          => 'contact_template',
                    'subject'           => $subject,
                    'username'          => $user["firstname"],
                    'email'             => $user["user_email"],
                    'reason'            => $post["opt_reason"],
                    'correspondence'    => $post["txt_contact"],
                    'bcc_projecklist'   => true
                );

                $output = [
                    'data'           => _('Thank you for contacting us. Check your mailbox for the acknowledgement email and reference number.'),
                    'modal'          => true,
                    'redirect'       => true,
                    'location'       => 'profile.php',
                    'notification'   => notificationMail($info)
                ];
                echo(json_encode($output));
                exit;
            }

        }

        // ERROR Unable to query user
        else
        {
            userErrorHandler(0, "contact_us", "unable to query user");
            redirect("/logout.php");
        }
    }

    // ERROR
    else
    {
        userErrorHandler(0, "contact_us", "Server request is not GET or POST");
        redirect("/logout.php");
    }