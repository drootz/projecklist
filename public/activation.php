<?php

    // configuration
    require("../includes/config.php"); 

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        //quick/simple validation
        if(empty($_GET['email']) || empty($_GET['key']))
        {
            // redirect user
            redirect("/");         
        }

        $action = array();
        $action['result'] = null;

        //cleanup the variables
        $_get = sanitizeForm($_GET);
        $email = $_get['email'];
        $key = $_get['key'];

        // query database for user and key
        $check_key = DB::query("SELECT * FROM activation WHERE user_email = ? AND user_key = ?", $email, $key);
         
        if (count($check_key) != 0)
        {
            $confirm_info = $check_key[0];

            //delete the confirm row
            $update_users = DB::query("DELETE FROM activation WHERE id = ?", $confirm_info['id']);
            if(count($update_users) == 0)
            {
                userErrorHandler(0, "activation", "unable to delete activation record");
            }

            //confirm the email and update the users database
            $update_users = DB::query("UPDATE users SET activated = 1 WHERE id = ?", $confirm_info['user_id']);
            if(count($update_users) == 0)
            {
                $action['result'] = _('Account Activation Failed');
                $action['text'] = _('We are unable to activate the account registered with ') . $email . _(' at this time. Please try again later.');
                userErrorHandler(0, "activation", "unable to activate user");
            }
            else
            {
                $action['result'] = _('Account Activated');
                $action['text'] = _('The account registered with ') . $email . _(' is now activated. Thank you!');
                // $action['text'] = 'The user could not be updated Reason: '.mysql_error();
            }
        }
        else
        {
            $action['result'] = _('Oops!');
            $action['text'] = _('This link seems to have expired.');
            userErrorHandler(0, "activation", "unable to check activation key - already activated");
        }

        // else render form//setup some variables
        render("activation.php", "Account Activation", [
            'result'    => $action['result'],
            'text'      => $action['text']
        ]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {   
        userErrorHandler(0, "activation", "Page should not be reached by POST");
        redirect("/logout.php");
    }

    // ERROR
    else
    {
        userErrorHandler(0, "activation", "Server request is not GET or POST");
        redirect("/logout.php");
    }