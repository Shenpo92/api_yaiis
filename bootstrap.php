<?php
require 'vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule();
$capsule->addConnection([
    "driver"     => "mysql",
    "host"       => "10.80.5.1",
    "database"   => "inscription-compta",
    "username"   => "yaiis",
    "password"   => "Yaiis42sh@",
    "charset"    => "utf8",
    "collation"  => "utf8_general_ci"
]);

$capsule->bootEloquent();

?>
