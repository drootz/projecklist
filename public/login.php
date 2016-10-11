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
    else if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("login_form.php", "Log In");
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {   
        if(isset($_POST['submit'])) 
        {
            $ajaxMsg  = "<h3>Submission Error.</h3><p>Please review the following field(s):</p>";
            $ajaxMsg .= "<ul>";

            // query database for user
            $rows = DB::query("SELECT * FROM users WHERE user_email = ?", $_POST["fld_login_email"]);

            // if we found user, check password
            if (count($rows) == 1)
            {
                // first (and only) row
                $row = $rows[0];

                // compare hash of user's input against hash that's in database
                if (password_verify($_POST["fld_login_psw"], $row["hash"]))
                {
                    // remember that user's now logged in by storing user's ID in session
                    $_SESSION["id"] = $row["id"];
                    $_SESSION["user_name"] = $row["firstname"];

                    // output result status to ajax call
                    echo("SUCCESS");
                    exit;
                }
                else
                {
                    // TODO gettext
                    $ajaxMsg .= "<li>Invalid username and/or password.</li>";
                    $ajaxMsg .= "<ul>";
                    echo($ajaxMsg);
                    exit;
                }
            }
            else
            {
                // TODO gettext
                $ajaxMsg .= "<li>Invalid username and/or password.</li>";
                $ajaxMsg .= "<ul>";
                echo($ajaxMsg);
                exit;
            }
        }
    }

?>
