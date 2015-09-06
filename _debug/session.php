<?php
/**
 * File name: _debug-session.php
 *
 * This file is part of PROJECKLIST
 *
 * Copyright (c) 2015 Daniel Racine
 * You should have received a copy of the MIT License
 * along with PROJECKLIST. If not, see <https://en.wikipedia.org/wiki/MIT_License>.
 */
?>




<li>
    <div>
    <h6><?php echo _( '_debug-lang' ); ?></h6>
    <ul>
        <li><a href="?lang=fr-CA">Français (Canada)</a></li>
        <li><a href="?lang=en-CA">English (Canada)</a></li>
    </ul>
    </div>
</li>





<li>
    <div>
    <h6>Debug Links</h6>
    <ul>
        <li><a href="debug/phpinfo.php">phpinfo.php</a></li>
    </ul>
    </div>
</li>





<li>
    <div>
    <h6><?php echo _( '_debug-plural-ttl' ); ?></h6>
    <ul>
        <?php

            // _debug variables 
            $a = rand(0,2); $b = rand(0,2); $c = rand(0,2); 

        ?>
        <li><?php echo sprintf( ngettext( '_debug-plural-single-%d', '_debug-plural-plural-%d', $a ), $a); ?></li>
        <li><?php echo sprintf( ngettext( '_debug-plural-start-single-%d', '_debug-plural-start-plural-%d', $b ), $b); echo sprintf( ngettext( '_debug-plural-end-single-%d', '_debug-plural-end-plural-%d', $c ), $c); ?></li>
    </ul>
    </div>
</li>

      



<li>
    <?php 

        function extractValues($val) {

            $return_val;
            if (is_array($val))
            {
                $return_val = "<ul>";
                foreach ($val as $key => $value) {
                    $return_val .= "<li>";
                    $return_val .= $key." -> ".$value;
                    $return_val .= "</li>";
                }
                $return_val .= "</ul>";
            }
            else {
                $return_val = $val;
            }

            return $return_val;
        }

        echo "<h6>\$_GET</h6>";
        echo "<ul>";
        foreach ($_GET as $key => $value) {
            echo "<li>";
            echo $key." -> ".extractValues($value);
            echo "</li>";
        }
        echo "</ul>";

    ?>
</li>





<li>
    <?php 

        echo "<h6>\$_SESSION</h6>";
        echo "<ul>";
        foreach ($_SESSION as $key => $value) {
            echo "<li>";
            echo $key." -> ".extractValues($value);
            echo "</li>";
        }
        echo "</ul>";

    ?>
</li>





<li>
    <?php 

        echo "<h6>\$_COOKIE</h6>";
        echo "<ul>";
        foreach ($_COOKIE as $key => $value) {
            echo "<li>";
            echo $key." -> ".extractValues($value);
            echo "</li>";
        }
        echo "</ul>";

    ?>
</li>









