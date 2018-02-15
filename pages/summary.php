<!doctype html>
<html lang="en">
<head>
    <!--
    Zachary Rosenlund
    1/30/18
    summary.html
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
            <div class="row">
                <div class="col-md-6 justify-content-start" >
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td>Name: {{ @SESSION['account']->getFname() }} {{ @SESSION['account']->getLname() }}</td>
                            </tr>
                            <tr>
                                <td>Gender: {{ @SESSION['account']->getGender() }} </td>
                            </tr>
                            <tr>
                                <td>Age: {{ @SESSION['account']->getAge() }}</td>
                            </tr>
                            <tr>
                                <td>Phone: {{ @SESSION['account']->getPhone() }}</td>
                            </tr>
                            <tr>
                                <td>Email: {{ @SESSION['account']->getEmail() }}</td>
                            </tr>
                            <tr>
                                <td>State: {{ @SESSION['account']->getState() }}</td>
                            </tr>
                            <tr>
                                <td>Seeking: {{ @SESSION['account']->getSeeking() }}</td>
                            </tr>
                            <tr class="{{ @muteClass }}">
                                <td>Interests: <repeat group="{{ @SESSION['account']->getInDoorInterests() }}" value="{{ @indoorItem }}">
                                        {{ trim(@indoorItem) }}
                                    </repeat> <repeat group="{{ @SESSION['account']->getOutDoorInterests() }}" value="{{ @outdoorItem }}">
                                        {{ trim(@outdoorItem) }}
                                    </repeat>{{ @mute }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                    <img src="../dating/images/account.svg" alt="account" id="accountImg">
                    <div class="container justify-content-center text-center">
                        <h3>Biography</h3>
                        <p>
                            {{ @SESSION['account']->getBio() }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="d-flex mx-auto justify-content-center">
                <button class="btn btn-primary">Contact Me!</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>