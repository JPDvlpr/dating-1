<?php
/*
 * Zachary Rosenlund
 * 1/19/18
 * index.pjp
 * This starts fat-free and sets the routes for my dating website
 */
//Require the autoload file
require_once('vendor/autoload.php');

//Create an instance of the Base class
$f3 = Base::instance();

//Define a default route
$f3->route('GET /', function() {
    $view = new View;
    echo $view->render('pages/home.html');
}
);

$f3->route('GET /myinfo', function() {
    $view = new View;
    echo $view->render('pages/personal-info.html');
}
);

//Run fat free
$f3->run();