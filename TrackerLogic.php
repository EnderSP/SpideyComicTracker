<?php

session_start();
require_once 'config.php';

//createa function to run very time i wanna reload images
function loadCImgs($conn)
{
    $tableName= $_SESSION['comicDB'];
    if(!isset($_SESSION['current']))
        {
            $currentResult= $conn->query("SELECT LastRead FROM userlr WHERE Email='{$_SESSION['Email']}' AND Sid ='{$_SESSION['comicDB']}'");
            if($currentResult ->num_rows>0)
            {
                $currentRow= $currentResult->fetch_assoc();
                $_SESSION['current']= $currentRow['LastRead'];
            }
            else{
                $_SESSION['current']=1;
            }
        }

    $_SESSION['next']=$_SESSION['current'] +1;
    $_SESSION['pre']=$_SESSION['current'] -1;

    $_SESSION['currentImg']= getImagePath($conn, $tableName, $_SESSION['current']);
    $_SESSION['nextImg'] =getImagePath($conn, $tableName, $_SESSION['next']);
    $_SESSION['preImg'] =getImagePath($conn, $tableName, $_SESSION['pre']);
        
}
function getImagePath($conn, $tableName, $comicID)
{
    
    $result = $conn->query(" SELECT ImagePath FROM $tableName WHERE ComicId = $comicID");
        if($result->num_rows>0)
            {
                return $result->fetch_assoc()['ImagePath'];
            }
        return "images/OIP.webp";
}


if (isset($_POST['next']))
    {
        $_SESSION['current'] +=1;
        header("Location: Tracker.php");
    }
if (isset($_POST['prev']))
    {
        $_SESSION['current'] -=1;
        header("Location: Tracker.php");
    }

loadCImgs($conn);

echo $_SESSION['current'];
    

?>