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
$f3->route('GET|POST /', function() {
    $view = new View;
    echo $view->render('pages/home.html');
}
);

$f3->route('GET|POST /myinfo', function() {
    $template = new Template();
    echo $template->render('pages/personal-info.php');
}
);

$f3->route('GET|POST /profile', function() {
    $template = new Template();
    echo $template->render('pages/profile.php');
}
);

$f3->route('GET|POST /interests', function() {
    $template = new Template();
    echo $template->render('pages/interests.php');
}
);

$f3->route('GET|POST /summary', function() {
    $template = new Template();
    echo $template->render('pages/summary.php');
}
);

//Run fat free
$f3->run();