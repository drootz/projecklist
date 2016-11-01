<?php

    // configuration
    require("../includes/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // redirect user
        redirect("/");
    }
    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // Sanitize $_POST and check for submit key
        $post = sanitizeForm($_POST);
        if(isset($post['submit'])) 
        {
            if ($post['submit'] == 'usernameCheck')
            {
                // query database for user
                $exist = DB::query("SELECT * FROM users WHERE user_email = ?", $post["user_email"]);
                        
                // If email exist
                if (count($exist) != 0)
                {   
                    // User exist
                    $output = [
                        'data' => true
                    ];
                    echo(json_encode($output));
                    exit;
                }
                // Does not exist
                else
                {
                    $output = [
                        'data' => false
                    ];
                    echo(json_encode($output));
                    exit;
                }
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