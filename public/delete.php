<?php

    // configuration
    require("../includes/config.php"); 

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        if (isset($_GET['key']))
        {
            $key = getDeleteKey();
            if ($_GET['key'] == $key)
            {
                render("delete_form.php", "Delete Account", [
                    'key' => $key
                ]);
            }
        }
        redirect("/");
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {   
        $post = sanitizeForm($_POST);
        if(isset($post['submit'])) 
        {
            if (isset($post['fld_delete_key']))
            {
                if ($post['fld_delete_key'] == getDeleteKey())
                {
                    // query database for user
                    $users = DB::query("SELECT * FROM users WHERE id = ?", $_SESSION["id"]);
                    if (count($users) != 0)
                    {
                        $user = $users[0];
                        $deltable = DB::query(
                            "INSERT INTO deleted_users (user_id, user_email, firstname, lastname, created_date, deleted_date, delete_comment) 
                            VALUES(?, ?, ?, ?, ?, ?, ?)", 
                            $_SESSION["id"],
                            $user["user_email"], 
                            $user["firstname"], 
                            $user["lastname"], 
                            $user["created_date"],
                            date('Y-m-d H:i:s'),
                            $post["txt_profile_delete"]
                        );

                        // DB update error check
                        if (count($deltable) == 0)
                        {
                            // TODO: log errors internally somehow
                        }

                        $deluser = DB::query("DELETE FROM users WHERE id = ?", $_SESSION["id"]);
                        if (count($deluser) != 0)
                        {
                            $output = [
                                'data'      => gettext('Your account has been deleted. You will now be redirected to the home page.'),
                                'modal'     => true,
                                'redirect'  => true,
                                'location'  => 'logout.php',
                                'notification' => submitMail($user["user_email"], "Account Deletion Notification", "Your account has been successfully deleted with all its data.", "Plain text goes here")
                            ];
                            echo(json_encode($output));
                            exit;
                        }
                    }
                }
            }

            $output = [
                'data'      => gettext('Unable to delete the account at this time. Please try again later'),
                'modal'     => true,
                'redirect'  => true,
                'location'  => 'logout.php'
            ];
            echo(json_encode($output));
            exit;
        }
    }
    else
    {
        // TODO: log errors internally somehow
        redirect("/logout.php");
    }