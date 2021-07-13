<?php
declare(strict_types=1);
error_reporting(-1);

require_once __DIR__ . '/vendor/autoload.php';

function debug($arr)
{
    echo '<pre>'; var_dump($arr); echo '</pre>';
}


