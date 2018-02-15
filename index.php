<?php
/*
 * Zachary Rosenlund
 * 1/19/18
 * index.php
 * This starts fat-free and sets the routes for my dating website
 */
ini_set("display_errors", 1);
error_reporting(E_ALL);

//Require the autoload file
require_once('vendor/autoload.php');

session_start();

//Create an instance of the Base class
$f3 = Base::instance();

//set debug level
$f3->set('DEBUG', 3);

//Define a default route
$f3->route('GET /', function($f3) {
    if(isset($_SESSION['errors']))
    {
        session_destroy();
    }

    $template = new Template();
    echo $template->render('pages/home.html');
}
);

$f3->route('GET|POST /myinfo', function($f3) {
    if (isset($_SESSION['errors'])) {
        $f3->set('firstName', $_SESSION['firstName']);
        $f3->set('lastName', $_SESSION['lastName']);
        $f3->set('age', $_SESSION['age']);
        $f3->set('genderMale', $_SESSION['genderMale']);
        $f3->set('genderFemale', $_SESSION['genderFemale']);
        $f3->set('phone', $_SESSION['phone']);
        $f3->set('premium', $_SESSION['premium']);

        $errors = $_SESSION['errors'];
        $f3->set('errors', $errors);
    }

    $template = new Template();
    echo $template->render('pages/personal-info.php');
}
);

$f3->route('GET|POST /profile', function($f3) {
    if(isset($_POST['submit'])) {
        $firstName = $_POST['inputFirstName'];
        $lastName = $_POST['inputLastName'];
        $age = $_POST['inputAge'];
        if (isset($_POST['inputGender']) && $_POST['inputGender'] == "Male"){
            $genderMale = "checked";
            $genderFemale = "";
        } else if (isset($_POST['inputGender']) && $_POST['inputGender'] == "Female"){
            $genderFemale = "checked";
            $genderMale = "";
        } else{
            $genderFemale = "";
            $genderMale = "";
        }
        if (isset($_POST['inputPremium'])) {
            $premium = "checked";
        } else {
            $premium = "";
        }
        $phone = $_POST['inputPhone'];
        $_SESSION['firstName'] = $firstName;
        $_SESSION['lastName'] = $lastName;
        $_SESSION['age'] = $age;
        $_SESSION['gender'] = $_POST['inputGender'];
        $_SESSION['genderMale'] = $genderMale;
        $_SESSION['genderFemale'] = $genderFemale;
        $_SESSION['phone'] = $phone;
        $_SESSION['premium'] = $premium;

        include('model/validation.php');

        if(!validName($firstName)) {
            $errors['firstName'] = 'Please enter a valid first name.';
        }

        if(!validName($lastName)) {
            $errors['lastName'] = 'Please enter a valid last name.';
        }

        if(!validAge($age)) {
            $errors['age'] = 'Please enter a valid age.';
        }

        if(!validPhone($phone)) {
            $errors['phone'] = 'Please enter a valid phone number (ex. 5555555555).';
        }

        if (sizeof($errors) > 0) {
            $_SESSION['errors'] = $errors;
            header("location: myinfo");
        }

        if (isset($_POST['inputPremium'])) {
            $_SESSION['account'] = new PremiumMember($firstName, $lastName, $age, $_SESSION['gender'], $phone);
            $f3->set('premiumPath', 'interests');
            //print_r($_SESSION['account']);
        } else {
            $_SESSION['account'] = new Member($firstName, $lastName, $age, $_SESSION['gender'], $phone);
            $f3->set('premiumPath', 'summary');
            //print_r($_SESSION['account']);
        }
    }

    echo Template::instance()->render('pages/profile.php');
}
);

$f3->route('GET|POST /interests', function() {
    $_SESSION['email'] = $_POST['inputEmail'];
    $_SESSION['state'] = $_POST['inputState'];
    $_SESSION['seeking'] = $_POST['inputSeeking'];
    $_SESSION['biography'] = $_POST['inputBiography'];

    $_SESSION['account']->setEmail($_SESSION['email']);
    $_SESSION['account']->setState($_SESSION['state']);
    $_SESSION['account']->setSeeking($_SESSION['seeking']);
    $_SESSION['account']->setBio($_SESSION['biography']);

    $template = new Template();
    echo $template->render('pages/interests.php');
}
);

$f3->route('GET|POST /summary', function($f3) {
    if ($_SESSION['premium'] == "checked") {
        $indoorArray = $_POST['inputIndoor'];
        $outdoorArray = $_POST['inputOutdoor'];
        $_SESSION['mute'] = "";

        include('model/validation.php');

        if (!empty($indoorArray) && !empty($outdoorArray)) {
            if (!validIndoor($indoorArray)) {
                $errors['indoor'] = 'Please enter valid indoor items.';
            }

            if (!validOutdoor($outdoorArray)) {
                $errors['phone'] = 'Please enter valid outdoor items';
            }

            if (sizeof($errors) > 0) {
                $_SESSION['errors'] = $errors;
                header("location: interests");
            }
        }

        $f3->set("indoor", $indoorArray);
        $f3->set("outdoor", $outdoorArray);
        $f3->set("muteClass", "");

        //print_r($_SESSION['account']);
    } else{
        $_SESSION['email'] = $_POST['inputEmail'];
        $_SESSION['state'] = $_POST['inputState'];
        $_SESSION['seeking'] = $_POST['inputSeeking'];
        $_SESSION['biography'] = $_POST['inputBiography'];
        $_SESSION['mute'] = "For Premium Members Only!";
        $_SESSION['account']->setEmail($_SESSION['email']);
        $_SESSION['account']->setState($_SESSION['state']);
        $_SESSION['account']->setSeeking($_SESSION['seeking']);
        $_SESSION['account']->setBio($_SESSION['biography']);
        $f3->set("muteClass", "mute");

        //print_r($_SESSION['account']);
    }

    $f3->set("firstName", $_SESSION['account']->getFname());
    $f3->set("lastName", $_SESSION['lastName']);
    $f3->set("age", $_SESSION['age']);
    $f3->set("gender", $_SESSION['gender']);
    $f3->set("phone", $_SESSION['phone']);
    $f3->set("email", $_SESSION['email']);
    $f3->set("state", $_SESSION['state']);
    $f3->set("seeking", $_SESSION['seeking']);
    $f3->set("biography", $_SESSION['biography']);
    $f3->set("mute", $_SESSION['mute']);

    $template = new Template();
    echo $template->render('pages/summary.php');
}
);

//Run fat free
$f3->run();