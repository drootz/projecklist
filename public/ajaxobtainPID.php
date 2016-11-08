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
		if(isset($_POST['submit'])) 
        {
            $post = sanitizeForm($_POST);
            if ($post['submit'] == 'getData')
            {
            
                $rows = DB::query("SELECT * FROM projecklist WHERE id = ?", $post['projeckt_id']);
                if (count($rows) == 0)
                {
                    // Don't return any data and exit
                    $output = [
                        'exist' => false
                    ];
                    echo(json_encode($output));
                    exit;
                }
                else
                {
                    if($_SESSION['id'] != $rows[0]['user_id'])
                    {
                        // Don't return any data and exit
                        $output = [
                            'exist' => false
                        ];
                        echo(json_encode($output));
                        exit;
                    }
                    else
                    {
                        // Valid Request
                        $output = [
                            'exist' => true,
                            'projeckt'  => $rows[0]
                        ];
                        echo(json_encode($output));
                        exit;
                    }
                }
            }
            else
            {
                // Don't return any data and exit
                $output = [
                    'exist' => false
                ];
                echo(json_encode($output));
                exit;
            }
		}
        else
        {
            // Don't return any data and exit
            $output = [
                'exist' => false
            ];
            echo(json_encode($output));
            exit;
        }
    }
    else
    {
        // Don't return any data and exit
        $output = [
            'exist' => false
        ];
        echo(json_encode($output));
        exit;
    }

?>