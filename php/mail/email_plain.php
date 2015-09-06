<?php
/**
 * File name: email_plain.php
 *
 * This file is part of PROJECKLIST
 *
 * Copyright (c) 2015 Daniel Racine
 * You should have received a copy of the MIT License
 * along with PROJECKLIST. If not, see <https://en.wikipedia.org/wiki/MIT_License>.
 */





echo "\n\nDanielRacine.ca\n\n";

echo "Form submission from website\n\n\n";


echo "FORM DETAILS\n\n";

echo $_post['label']['fld_project_name']." ". $_post['value']['fld_project_name'] . "\n\n";

echo "    - ".$_post['label']['fld_project_name']." ".$_post['value']['fld_project_name']."\n";
echo "    - ".$_post['label']['fld_contact_primary_fn']." ".$_post['value']['fld_contact_primary_fn']."\n";
echo "    - ".$_post['label']['fld_contact_primary_ln']." ".$_post['value']['fld_contact_primary_ln']."\n";
echo "    - ".$_post['label']['tel_contact_primary_tel']." ".$_post['value']['tel_contact_primary_tel']."\n";
echo "    - ".$_post['label']['eml_contact_primary_email']." ".$_post['value']['eml_contact_primary_email']."\n";

// echo $plainActivity;


echo "\n";

echo "DanielRacine.ca\n";

?>
