<?php

	require_once(__DIR__ . "/../includes/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        render("projeckt_form.php", _("Projeckt Form"));
    }
    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
		if(isset($_POST['submit'])) {

			$sanitized_post = validateForm($_POST);

            echo("SUCCESS");
		}
    }

?>