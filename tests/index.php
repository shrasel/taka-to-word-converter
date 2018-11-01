<?php 
require_once __DIR__."/../vendor/autoload.php";

$obj = new TakaToWordConverter\WordConverter();
echo $obj->convert(1212121221.12);
