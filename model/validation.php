<?php

function validName($name)
{
    if(ctype_alpha($name) && !empty($name))
    {
        return true;
    }
    return false;
}

function validAge($age)
{
    if(ctype_alnum($age) && $age >= 18)
    {
        return true;
    }
    return false;
}

function validPhone($phone)
{
    if (strlen($phone) == 10)
    {
        return true;
    }
    return false;
}

function validOutdoor($outdoorItems)
{
    $outdoorList = array("hiking", "biking", "swimming", "climbing", "walking", "collecting");
    foreach ($outdoorItems as $item)
    {
        if(!in_array($item, $outdoorList))
            return false;
    }
    return true;
}

function validIndoor($indoorItems)
{
    $indoorList = array("tv", "movies", "cooking", "board games", "puzzles", "reading", "playing cards", "video games");
    foreach ($indoorItems as $item)
    {
        if(!in_array($item, $indoorList))
            return false;
    }
    return true;
}

$errors = array();



$success = sizeof($errors) == 0;



