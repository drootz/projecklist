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
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {

        // Make data transfered from other page via GET avaialble
        if (isset($_GET['user_id']) && isset($_GET['user_email']))
        {
            if (isset($_GET['new']) && $_GET['new'])
            {
                $title = gettext('Successful Registration');
            }
            else
            {
                $title = gettext('Account Not Activated');
            }

            render("registered.php", "Registration", [
                'bodyTitle'     => $title,
                'user_id'       => $_GET['user_id'],
                'user_email'    => $_GET['user_email']
            ]);  
        }
        else
        {
            // redirect user
            redirect("/");
        }
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {   
        // Sanitize $_POST and check for submit key
        $post = sanitizeForm($_POST);
        if(isset($post['submit'])) 
        {

            // query database for user
            $activations = DB::query("SELECT * FROM activation WHERE user_id = ?", $post['submit']);
            if (count($activations) == 0)
            {
                // ERROR
            }
            $activation = $activations[0];

            $info = [
                'username' => $activation['user_name'],
                'email' => $activation['user_email'],
                'key' => $activation['user_key']
            ];

            $get = [
                'user_email'    => $activation['user_email']
            ];

            $output = [
                'data'          => gettext('Please check your mailbox for your registration confirmation email and click on the activation link to be able to access your account.'),
                'modal'         => true,
                'transfer'      => true,
                'transferData'  => http_build_query($get),
                'redirect'      => true,
                'location'      => 'login.php',
                'notification'  => signupMail($info)
            ];
            echo(json_encode($output));
            exit;
        }
    }

    // ERROR
    else
    {
        userErrorHandler(0, "registered", "Server request is not GET or POST");
        redirect("/logout.php");
    }