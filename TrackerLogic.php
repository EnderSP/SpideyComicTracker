<?php

session_start();
require_once 'config.php';




//This will run anytime next is clicked

//set current to Last Read for seriese
$currentResult = $conn->query("SELECT LastRead FROM userlr WHERE Email = '{$_SESSION['Email']}' AND Sid = '{$_SESSION['comicDB']}'");

if ($currentResult ->num_rows>0)
    {
        //confirmed row existed that matched then save the actual information to a proper row var 
        $userReadRow= $currentResult->fetch_assoc();

        //set the currenttly readng var to whatever users last read comic segment was as order id
        $_SESSION['current']= $userReadRow['LastRead'];
        //Also set nextread and preRead, to pull imagesfrom
        $_SESSION['next']= $userReadRow['LastRead']+1;
        $_SESSION['pre']= $userReadRow['LastRead']-1;
    }
    //no fall back because last read is default set to 1


    //no we  use similar method to set image url to session var
    $tableName=$_SESSION['comicDB'];
    //save table to another current row
    //this section saves current image
    $currentImgResult= $conn->query("Select ImagePath FROM $tableName WHERE ComicId= '{$_SESSION['current']}'");
    if($currentImgResult->num_rows>0)
        {
            //save actual aociated row data to var to pull from
            $currentImgRow=$currentImgResult->fetch_assoc();
            $_SESSION['currentImg']= $currentImgRow['ImagePath'];

        }
    else{
        $_SESSION['currentImg']="images\OIP.webp";
    }
    //using the sam elogic and checks for current image we seach for the same table with a id of one graterthan the current id to pull future image
    $nextImgResults= $conn->query("SELECT ImagePath FROM $tableName WHERE ComicId= '{$_SESSION['next']}'");
    if($nextImgResults ->num_rows>0)
        {
            $nextimgRow=$nextImgResults->fetch_assoc();
            $_SESSION['nextImg']= $nextimgRow['ImagePath'];
        }
    else{
        $_SESSION['nextImg']="images\OIP.webp";
    }
?>