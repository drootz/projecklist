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
            if ($post['submit'] == 'projektCheck')
            {
                // query database for projekt name for this user
                $exist = DB::query("SELECT id FROM projecklist WHERE user_id = ? AND fld_project_name = ?", $_SESSION['id'], $post['name']);
                        
                // If name exist
                if (count($exist) != 0)
                {   
                    // Name exist
                    $output = [
                        'exist' => true,
                        'pid'  => $exist[0]['id']
                    ];
                    echo(json_encode($output));
                    exit;
                }
                // Does not exist
                else
                {
                    $output = [
                        'exist' => false
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