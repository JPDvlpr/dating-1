<?php
/**
 * Created by PhpStorm.
 * User: zrose
 * Date: 2/27/2018
 * Time: 12:56 PM
 */

/*
 * CREATE TABLE Members (member_id INT(20) AUTO_INCREMENT PRIMARY KEY,
 *        fname VARCHAR(50), lname VARCHAR(50), age INT(3), gender CHAR(1),
 *        phone INT(10), email VARCHAR(50), state CHAR(2), seeking CHAR(1),
 *        bio VARCHAR(300), premium TINYINT(3), image VARCHAR(300), interests VARCHAR(500));
 */
function connect()
{
    try {
        //Instantiate a database object
        $dbh = new PDO(DB_DSN, DB_USERNAME,
            DB_PASSWORD );
        //echo "Connected to database!!!";
        return $dbh;
    }
    catch (PDOException $e) {
        echo $e->getMessage();
        return;
    }
}

function getMembers()
{
    global $dbh;
    //1. Define the query
    $sql = "SELECT * FROM Members ORDER BY lname";
    //2. Prepare the statement
    $statement = $dbh->prepare($sql);
    //3. Bind parameters
    //4. Execute the query
    $statement->execute();
    //5. Get the results
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    //print_r($result);
    return $result;
}

function insertMember($fname, $lname, $age, $gender, $phone, $email, $state, $seeking, $bio, $premium, $image, $interests)
{
    global $dbh;

    //Define the query
    $sql = "INSERT INTO Members(fname, lname, age, gender, phone, email, state,
        seeking, bio, premium, image, interests)
        VALUES (:fname, :lname, :age, :gender, :phone, :email, :state,
        :seeking, :bio, :premium, :image, :interests)";

    //Prepare the statement
    $statement = $dbh->prepare($sql);
    $statement->bindParam(':fname', $fname, PDO::PARAM_STR);
    $statement->bindParam(':lname', $lname, PDO::PARAM_STR);
    $statement->bindParam(':age', $age, PDO::PARAM_INT);
    $statement->bindParam(':gender', $gender, PDO::PARAM_STR);
    $statement->bindParam(':phone', $phone, PDO::PARAM_STR);
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->bindParam(':state', $state, PDO::PARAM_STR);
    $statement->bindParam(':seeking', $seeking, PDO::PARAM_STR);
    $statement->bindParam(':bio', $bio, PDO::PARAM_INT);
    $statement->bindParam(':premium', $premium, PDO::PARAM_STR);
    $statement->bindParam(':image', $image, PDO::PARAM_INT);
    $statement->bindParam(':interests', $interests, PDO::PARAM_STR);

    //4. Execute the query
    $result = $statement->execute();

    //5. Return the result
    return $result;
}