<?php

session_start();
require_once 'config.php';

if(isset($_POST['btn_616']))
    {
        $comicDB= "S616";
        $_SESSION['comicDB']= $comicDB;
        
       
        $currentResult= $conn->query("SELECT LastRead FROM userlr WHERE Email='{$_SESSION['Email']}' AND Sid ='{$_SESSION['comicDB']}'");
            if($currentResult ->num_rows>0)
            {
                $currentRow= $currentResult->fetch_assoc();
                $_SESSION['current']= $currentRow['LastRead'];
            }
            else{
                $_SESSION['current']=1;
            }
        header("Location: Tracker.php");
    }
if(isset($_POST['btn_2000']))
    {
        $comicDB= "S2000";
        $_SESSION['comicDB']= $comicDB;
        
        
        $currentResult= $conn->query("SELECT LastRead FROM userlr WHERE Email='{$_SESSION['Email']}' AND Sid ='{$_SESSION['comicDB']}'");
            if($currentResult ->num_rows>0)
            {
                $currentRow= $currentResult->fetch_assoc();
                $_SESSION['current']= $currentRow['LastRead'];
            }
            else{
                $_SESSION['current']=1;
            }
        header("Location: Tracker.php");
    }
if(isset($_POST['btn_2018']))
    {
        $comicDB= "S2018";
        $_SESSION['comicDB']= $comicDB;
        
        
        $currentResult= $conn->query("SELECT LastRead FROM userlr WHERE Email='{$_SESSION['Email']}' AND Sid ='{$_SESSION['comicDB']}'");
            if($currentResult ->num_rows>0)
            {
                $currentRow= $currentResult->fetch_assoc();
                $_SESSION['current']= $currentRow['LastRead'];
            }
            else{
                $_SESSION['current']=1;
            }
        header("Location: Tracker.php");
    }
exit();
?>