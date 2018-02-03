<?php
session_start();

//error reporting
ini_set('display-errors',1);
error_reporting(E_ALL);

if (isset($_POST['submit'])) {
    $isValid = true;

    //first name
    if (!empty($_POST['inputEmail'])) {
        $_SESSION['email'] = $_POST['inputEmail'];
        $_SESSION['emailError'] = false;
    } else {
        $isValid = false;
        $_SESSION['email'] = "";
        $_SESSION['emailError'] = true;
    }

    //last name
    if (!empty($_POST['inputState'])) {
        $_SESSION['state'] = $_POST['inputState'];
        $_SESSION['stateError'] = false;
    } else {
        $isValid = false;
        $_SESSION['state'] = "";
        $_SESSION['stateError'] = true;
    }

    //age
    if (!empty($_POST['seeking'])) {
        $_SESSION['seeking'] = $_POST['seeking'];
        $_SESSION['seekingError'] = false;
    } else {
        $isValid = false;
        $_SESSION['seeking'] = "";
        $_SESSION['seekingError'] = true;
    }

    //gender
    if (!empty($_POST['inputBiography'])) {
        $_SESSION['biography'] = $_POST['inputBiography'];
        $_SESSION['biographyError'] = false;
    } else {
        $isValid = false;
        $_SESSION['biography'] = "";
        $_SESSION['biographyError'] = true;
    }

    if(!$isValid) {
        header("location: ../dating/profile");
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <!--
    Zachary Rosenlund
    1/30/18
    interests.php
    The view for the index page of my dating site
    -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/styles.css">
    <title>Lovify | Find Love Today</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="../dating/">Lovify</a>
</nav>

<div class="container">
    <div class="card mx-auto" id="main">
        <div class="card-block">
            <h2>Interests</h2>
            <hr>
            <form action="summary" method="post">
                <div class="row h-100">
                    <div class="col-md-11 justify-content-start" id="formInfo">
                        <div class="form-group">
                            <label>Indoor Interests</label>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="inputIndoor[]" value="tv" id="tv">
                                        <label class="form-check-label" for="tv">
                                            tv
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="inputIndoor[]" value="puzzles" id="puzzles">
                                        <label class="form-check-label" for="puzzles">
                                            puzzles
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="inputIndoor[]" value="movies" id="movies">
                                        <label class="form-check-label" for="tv">
                                            movies
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="inputIndoor[]" value="reading" id="reading">
                                        <label class="form-check-label" for="puzzles">
                                            reading
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="inputIndoor[]" value="cooking" id="cooking">
                                        <label class="form-check-label" for="tv">
                                            cooking
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="inputIndoor[]" value="playing cards" id="playing cards">
                                        <label class="form-check-label" for="puzzles">
                                            playing cards
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="inputIndoor[]" value="board games" id="board games">
                                        <label class="form-check-label" for="tv">
                                            board games
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="inputIndoor[]" value="video games" id="video games">
                                        <label class="form-check-label" for="puzzles">
                                            video games
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Out-door Interests</label>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="inputOutdoor[]" value="hikinh" id="hiking">
                                        <label class="form-check-label" for="tv">
                                            hiking
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="inputOutdoor[]" value="walking" id="walking">
                                        <label class="form-check-label" for="puzzles">
                                            walking
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="inputOutdoor[]" value="biking" id="biking">
                                        <label class="form-check-label" for="tv">
                                            biking
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="inputOutdoor[]" value="climbing" id="climbing">
                                        <label class="form-check-label" for="puzzles">
                                            climbing
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="inputOutdoor[]" value="swimming" id="swimming">
                                        <label class="form-check-label" for="tv">
                                            swimming
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="inputOutdoor[]" value="collecting" id="collecting">
                                        <label class="form-check-label" for="tv">
                                            collecting
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="d-flex align-items-end justify-content-end h-100 w-100">
                            <button class="btn btn-primary" name="submit" id="submit">Next ></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>