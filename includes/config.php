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

    require_once("_DB.php");
    DB::init(__DIR__ . "/../config.json");
    
    // DEBUG
    require_once(__DIR__ . "/../_debug/functions.php");

    require_once("_functions.php");
    require_once("_correspondence.php");
    
    require_once("_session.php");

?>