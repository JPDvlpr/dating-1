<!doctype html>
<html lang="en">
<head>
    <!--
    Zachary Rosenlund
    1/30/18
    profile.php
    The view for the profile page of my dating site
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
            <h2>Profile</h2>
            <hr>
            <form action="interests" method="post">
                <div class="row h-100">
                    <div class="col-md-6 justify-content-start" id="formInfo">
                            <div class="form-group">
                                <label for="inputEmail">Email</label>
                                <input type="email" class="form-control" name="inputEmail" id="inputEmail" placeholder="Enter Email">
                            </div>
                            <div class="form-group">
                                <label for="inputState">State</label>
                                <select class="form-control" name="inputState" id="inputState">
                                    <option value="WASHINGTON">WASHINGTON</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Seeking</label>
                                <br>
                                <div class="container" id="genderGroup">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inputSeeking" id="male" value="Male">
                                        <label class="form-check-label" for="male">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline" id="femaleGroup">
                                        <input class="form-check-input" type="radio" name="inputSeeking" id="female" value="Female">
                                        <label class="form-check-label" for="female">Female</label>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputBiography">Biography</label>
                            <textarea class="form-control" name="inputBiography" id="inputBiography" rows="7"></textarea>
                        </div>
                        <div class="d-flex align-items-end justify-content-end w-100">
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