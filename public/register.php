<?php

    require_once(__DIR__ . "/../includes/config.php");

    // if user already logged in redirect to home page
    if (!empty($_SESSION["id"]))
    {
        // redirect user
        redirect("/");
    }
    // if user reached page via GET (as by clicking a link or via redirect)
    else if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("register_form.php", "Registration");
    }
    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(isset($_POST['submit'])) 
        {
            $sanitized_post = validateRegistration($_POST);

            $rows = DB::query("INSERT IGNORE INTO users (user_email, firstname, lastname, hash) VALUES(?, ?, ?, ?)", $sanitized_post["email"], $sanitized_post["first_name"], $sanitized_post["last_name"], password_hash($sanitized_post["password"], PASSWORD_DEFAULT));
            if ($rows != 0)
            {
                // remember that user's now logged in by storing user's ID in session
                $rows = DB::query("SELECT LAST_INSERT_ID() AS id");
                $_SESSION["id"] = $rows[0]["id"];

                $rows = DB::query("SELECT firstname FROM users WHERE id = ?", $_SESSION["id"]);
                if ($rows != 0)
                {
                    // remember that user's now logged in by storing username or firstname in session
                    $_SESSION["user_name"] = $rows[0]["firstname"];

                    // output result status to ajax call
                    echo("SUCCESS");
                }
                else
                {
                    // output result status to ajax call
                    echo("SUCCESS");
                }
            }
            else
            {
                // else apologize
                $ajaxMsg  = "<h3>Submission Error.</h3><p>Please review the following field(s):</p>";
                $ajaxMsg .= "<ul>";
                $ajaxMsg .= "<li>The email address \"". $sanitized_post["email"] . "\" is already registered.</li>";
                $ajaxMsg .= "<ul>";
                echo($ajaxMsg);
            }
        }
    }