<?php

session_start();
require_once 'config.php';

if(isset($_POST['btn_616']))
    {
        $comicDB= "S616";
        $_SESSION['comicDB']= $comicDB;
        header("Location: Tracker.php");
    }
if(isset($_POST['btn_2000']))
    {
        $comicDB= "S2000";
        $_SESSION['comicDB']= $comicDB;
        header("Location: Tracker.php");
    }
if(isset($_POST['btn_2018']))
    {
        $comicDB= "S2018";
        $_SESSION['comicDB']= $comicDB;
        header("Location: Tracker.php");
    }
exit();
?>