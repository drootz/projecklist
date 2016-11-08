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
                    'data'      => _('Unable to delete your projeckt at this time.'),
                    'modal'     => true
                ];
                echo(json_encode($output));
                exit;
            }
        }
    }
    else
    {

    }

?>