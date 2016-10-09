<?php
/**
 * File name: config.php
 *
 * This file is part of PROJECKLIST
 *
 * Copyright (c) 2015 Daniel Racine
 * You should have received a copy of the MIT License
 * along with PROJECKLIST. If not, see <https://en.wikipedia.org/wiki/MIT_License>.
 */

    // Set your default timezone here
    // http://php.net/manual/en/timezones.php
    $timezone = 'America/Montreal';
    date_default_timezone_set($timezone);

    // Define your default variables here
    $default = array(
      'email'           =>  'daniel.racine@danwebco.ca',
      'do_not_reply'    => 'do_not_reply@danwebco.ca'
    );

?>