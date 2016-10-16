<?php
/**
 * File name: ajax_localization.php
 *
 * This file is part of PROJECKLIST
 *
 * @author Daniel Racine <mailto.danielracine@gmail.com>
 * @link --
 * @package PROJECKLIST
 * @version 1
 *
 * Copyright (c) 2015 Daniel Racine
 * You should have received a copy of the MIT License
 * along with PROJECKLIST. If not, see <https://en.wikipedia.org/wiki/MIT_License>.
 */

    $output = [
        'en' => [
                    'string1' => 'string-1',
                    'string2' => 'string-2'
        ],
        'fr' =>  [
                    'string1' => 'texte-1',
                    'string2' => 'texte-2'
        ]
    ];
    echo(json_encode($output));
    exit;

?>