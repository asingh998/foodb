<?php

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Start a session
session_start();

//Require the autoload file
require_once("vendor/autoload.php");
require_once("model/data-layer.php");
require_once("model/validate.php");

//Instantiate the F3 Base class
$f3 = Base::instance();

//Default route
$f3->route('GET /', function() {
    //echo '<h1>Welcome to my Food Page</h1>';

    $view = new Template();
    echo $view->render('views/home.html');
});

//Order route
$f3->route('GET|POST /order', function($f3) {

    //If the form has been submitted
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        var_dump($_POST);
        //["food"]=>"tacos" ["meal"]=>"lunch"

        //Validate food
        if (!validFood($_POST['food'])) {

            //Set an error variable in the F3 hive
            $f3->set('errors["food"]', "Invalid food item");
        }
        if (!validMeal($_POST['meal'])) {

            //Set an error variable in the F3 hive
            $f3->set('errors["meal"]', "Invalid meal.");
        }
        //Data is valid
        if (empty($f3->get('errors'))) {

            //Store the data in the session array
            $_SESSION['food'] = $_POST['food'];
            $_SESSION['meal'] = $_POST['meal'];

            //Redirect to Order 2 page
            $f3->reroute('order2');
        }
    }

    $f3->set('meals', getMeals());
    $f3->set('food', $_POST['food']);
    $f3->set('selectedMeal', $_POST['meal']);
    $view = new Template();
    echo $view->render('views/order.html');

});

//Order route
$f3->route('GET|POST /order2', function($f3) {

    $conds = getCondiments();

    //If the form has been submitted
    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        //Store the data in the session array
        $_SESSION['conds'] = $_POST['conds'];

        //Redirect to summary page
        $f3->reroute('summary');
    }

    $f3->set('conds', $conds);
    $view = new Template();
    echo $view->render('views/orderForm2.html');
});

//Breakfast route
$f3->route('GET /summary', function() {
    //echo '<h1>Thank you for your order!</h1>';

    $view = new Template();
    echo $view->render('views/summary.html');

    session_destroy();
});

//Run F3
$f3->run();