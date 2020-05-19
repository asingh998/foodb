<?php

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require the autoload file
require_once("vendor/autoload.php");
require_once("model/data-layer.php");

//Start a session AFTER requiring autoload.php
session_start();

//Instantiate the F3 Base class
$f3 = Base::instance();
$validator = new Validate();
$controller = new Controller($f3, $validator);

//Default route
$f3->route('GET /', function() {
    $GLOBALS['controller']->home();
});

//Order route
$f3->route('GET|POST /order', function($f3) {
    $GLOBALS['controller']->order();
});

//Order 2 route
$f3->route('GET|POST /order2', function($f3) {
    $GLOBALS['controller']->order2();
});

//summary route
$f3->route('GET /summary', function() {
    $GLOBALS['controller']->summary();
});

//Run F3
$f3->run();