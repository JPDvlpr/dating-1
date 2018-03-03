<?php
/**
 * Created by PhpStorm.
 * User: zrose
 * Date: 2/28/2018
 * Time: 12:38 PM
 */
?>

<!doctype html>
<html lang="en">
<head>
    <!--
    Zachary Rosenlund
    1/19/18
    home.html
    The view for the index page of my dating site
    -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="styles/admin.css">
    <title>Lovify | Find Love Today</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="../dating/">Lovify</a>
    <a class="navbar-brand" href="#">Admin</a>
</nav>

<div class="container">
    <div class="card mx-auto" id="main">
        <h2>Membership</h2>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Age</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Email</th>
                    <th scope="col">State</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Seeking</th>
                    <th scope="col">Premium</th>
                    <th scope="col">Interests</th>
                </tr>
            </thead>
            <tbody>
                <repeat group="{{ @tableData }}" value="{{ @row }}">
                    <tr>
                        <td>{{ @row['member_id'] }}</td>
                        <td>{{ @row['fname'] }} {{ @row['lname'] }}</td>
                        <td>{{ @row['age'] }}</td>
                        <td>{{ @row['phone'] }}</td>
                        <td>{{ @row['email'] }}</td>
                        <td>{{ @row['state'] }}</td>
                        <td>{{ @row['gender'] }}</td>
                        <td>{{ @row['seeking'] }}</td>
                        <td>
                            <check if="{{ @row['premium'] == 'yes' }}">
                                <img src="images/checked-checkbox.png" alt="checked">
                            </check>
                            <check if="{{ @row['premium'] == 'no' }}">
                                <img src="images/unchecked-checkbox.png" alt="checked">
                            </check>
                        </td>
                        <td>{{ @row['interests'] }}</td>
                    </tr>
                </repeat>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
