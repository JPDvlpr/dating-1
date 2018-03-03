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
require("/home/zrosenlu/config.php");
require_once("model/dbFunctions.php");

session_start();

//Connect to database
$dbh = connect();

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

//Define personal info route
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

//Define profile route
$f3->route('GET|POST /profile', function($f3) {
    if(isset($_POST['submit'])) {
        $firstName = $_POST['inputFirstName'];
        $lastName = $_POST['inputLastName'];
        $age = $_POST['inputAge'];
        $gender = $_POST['inputGender'];
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

        //put these variables in sessions for checkbox stickiness
        $_SESSION['firstName'] = $firstName;
        $_SESSION['lastName'] = $lastName;
        $_SESSION['age'] = $age;
        $_SESSION['genderMale'] = $genderMale;
        $_SESSION['genderFemale'] = $genderFemale;
        $_SESSION['phone'] = $phone;
        $_SESSION['premium'] = $premium;

        require_once('model/validation.php');

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
            $_SESSION['account'] = new PremiumMember($firstName, $lastName, $age, $gender, $phone);
            $f3->set('premiumPath', 'interests');
            //print_r($_SESSION['account']);
        } else {
            $_SESSION['account'] = new Member($firstName, $lastName, $age, $gender, $phone);
            $f3->set('premiumPath', 'summary');
            //print_r($_SESSION['account']);
        }
    }

    echo Template::instance()->render('pages/profile.php');
}
);

//Define interests route
$f3->route('GET|POST /interests', function() {
    $_SESSION['account']->setEmail($_POST['inputEmail']);
    $_SESSION['account']->setState($_POST['inputState']);
    $_SESSION['account']->setSeeking($_POST['inputSeeking']);
    $_SESSION['account']->setBio($_POST['inputBiography']);

    $template = new Template();
    echo $template->render('pages/interests.php');
}
);

//Define summary route
$f3->route('GET|POST /summary', function($f3) {


    if ($_SESSION['premium'] == "checked") {
        $indoorArray = $_POST['inputIndoor'];
        $outdoorArray = $_POST['inputOutdoor'];
        $_SESSION['account']->setIndoorInterests($indoorArray);
        $_SESSION['account']->setOutdoorInterests($outdoorArray);
        $_SESSION['mute'] = "";

        require_once('model/validation.php');

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

        if ($_SESSION['account']->getGender() === "Male") {
            $gender = 'M';
        } else {
            $gender = 'F';
        }

        $fname = $_SESSION['account']->getFname();
        $lname = $_SESSION['account']->getLname();
        $age = $_SESSION['account']->getAge();
        $phone = $_SESSION['account']->getPhone();
        $email = $_SESSION['account']->getEmail();
        $state = $_SESSION['account']->getState();
        $seeking = $_SESSION['account']->getSeeking();
        $bio = $_SESSION['account']->getBio();
        $premium = "yes";
        $image = $_SESSION['account']->getImagePath();
        $interests = implode(", ", $_SESSION['account']->getInDoorInterests()) . ", " . implode(", ", $_SESSION['account']->getOutDoorInterests());

        $result = insertMember($fname, $lname, $age, $gender, $phone, $email, $state, $seeking, $bio, $premium, $image, $interests);

        $f3->set("muteClass", "");
        $f3->set("premium", true);

        //print_r($_SESSION['account']);
    } else{
        $_SESSION['mute'] = "For Premium Members Only!";
        $_SESSION['account']->setEmail($_POST['inputEmail']);
        $_SESSION['account']->setState($_POST['inputState']);
        $_SESSION['account']->setSeeking($_POST['inputSeeking']);
        $_SESSION['account']->setBio($_POST['inputBiography']);
        $f3->set("muteClass", "mute");
        $f3->set("premium", false);

        if ($_SESSION['account']->getGender() === "Male") {
            $gender = 'M';
        } else {
            $gender = 'F';
        }

        $fname = $_SESSION['account']->getFname();
        $lname = $_SESSION['account']->getLname();
        $age = $_SESSION['account']->getAge();
        $phone = $_SESSION['account']->getPhone();
        $email = $_SESSION['account']->getEmail();
        $state = $_SESSION['account']->getState();
        $seeking = $_SESSION['account']->getSeeking();
        $bio = $_SESSION['account']->getBio();
        $premium = "no";
        $image = null;
        $interests = null;

        $result = insertMember($fname, $lname, $age, $gender, $phone, $email, $state, $seeking, $bio, $premium, $image, $interests);

        //print_r($_SESSION['account']);
    }
    $f3->set("mute", $_SESSION['mute']);

    $template = new Template();
    echo $template->render('pages/summary.php');
}
);

$f3->route("GET /admin", function($f3) {

    $f3->set("tableData", getMembers());

    $template = new Template();
    echo $template->render('pages/admin.php');
});

//Run fat free
$f3->run();