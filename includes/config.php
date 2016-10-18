<?php
/**
 * File name: config.php
 *
 * This file is part of PROJECKLIST
 *
 * @author Daniel Racine <mailto.danielracine@gmail.com>
 * @link --
 * @package PROJECKLIST
 * @version 1
 *
 * Copyright (c) 2016 Daniel Racine
 * You should have received a copy of the MIT License
 * along with PROJECKLIST. If not, see <https://en.wikipedia.org/wiki/MIT_License>.
 */

    // display errors, warnings, and notices
    ini_set("display_errors", true);
    error_reporting(E_ALL);

    require_once(__DIR__ . "/../_debug/functions.php");
    require_once("functions.php");

    require_once("DB.php");
    DB::init(__DIR__ . "/../config.json");

    require_once("session.php");

    // Set your default timezone here
    // http://php.net/manual/en/timezones.php
    $timezone = 'America/Montreal';
    date_default_timezone_set($timezone);
?>