<?php

session_start();
require_once 'config.php';

//set current to Last Read for seriese
$currentResult = $conn->query("SELECT LastRead FROM userlr WHERE Email = '{$_SESSION['Email']}' AND Sid = '{$_SESSION['comicDB']}'");

if ($currentResult ->num_rows>0)
    {
        //confirmed row existed that matched then save the actual information to a proper row var 
        $userReadData= $currentResult->fetch_assoc();

        //set the currenttly readng var to whatever users last read comic segment was as order id
        $_SESSION['current']= $userReadData['LastRead'];
    }
    //no fall back because last read is default set to 1


    //no we  use similar method to set image url to session var
    $tableName=$_SESSION['comicDB'];
    //save table to another current row
    $currentImgRow= $conn->query("Select ImagePath FROM $tableName WHERE ComicId= '{$_SESSION['current']}'");
    if($currentImgRow->num_rows>0)
        {
            //save actual aociated row data to var to pull from
            $comicData=$currentImgRow->fetch_assoc();
            $_SESSION['currentImg']= $comicData['ImagePath'];

        }
    else{
        $_SESSION['currentImg']="images\S616_1.jpg";
    }










?>