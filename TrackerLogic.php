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
//decalre new session vars forimage path here and assign them using getimage function
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
//boolean check to see if user has read issue







/*CODE IN EMAIL BIND PARAMS TO PREVENT INJECTIONS  */
function isRead($conn, $Email,$Sid, $comicID)
{
    $sql= "SELECT 1 FROM userreadlist WHERE Email = ? AND Sid = ? AND ComicId = ?";
    $stmt= $conn ->prepare($sql);
    if (!$stmt)
        {
           die("couldnt prepare query". $conn->error);
        }
    $stmt -> bind_param("ssi", $Email, $Sid, $comicID);// (converts any user input(specificlaly Email to a string to prevent injections) plugs values into pre query request
    $stmt -> execute();
    $result =$stmt->get_result();

    return $result->num_rows > 0;
}
function setBackground($conn)
{
    if(isRead($conn,$_SESSION['Email'] ,$_SESSION['comicDB'],$_SESSION['current']))
            {
                $_SESSION['backgroundColor']="#417219";

            }
        else
            {
                $_SESSION['backgroundColor']="#29335C";
            }
}

if (isset($_POST['next']))
    {
        $_SESSION['current'] +=1;
        header("Location: Tracker.php");
        exit();
    }
if (isset($_POST['prev']))
    {
        if($_SESSION['current']!=1)
            {
        $_SESSION['current'] -=1;
        header("Location: Tracker.php");
        exit();
            }
        header("Location: Tracker.php");
        exit();
    }
if (isset($_POST['readCheck']))
    {
        if(isRead($conn,$_SESSION['Email'] ,$_SESSION['comicDB'],$_SESSION['current']))
            {
                // alreadye xists Remove from table// unread

                header("Location: Tracker.php");
        exit();
            }
        else{
            //not read
            //add to table to mark as read
            $stmt=$conn->prepare("INSERT INTO userreadlist(Email,Sid,ComicId) VALUES (?,?,?)");//using bind parsm to prevent ill intent emial injectins as well as to convert variables irectly to string on creation
            $stmt->bind_param("sss", $_SESSION['Email'], $_SESSION['comicDB'],$_SESSION['current']);
            $stmt->execute();
            $stmt->close();

            //turn to last read
            $stmt1=$conn->prepare("UPDATE userlr SET LastRead =? WHERE Email= ? AND Sid =?");
            $stmt1->bind_param("iss",$_SESSION['current'], $_SESSION['Email'], $_SESSION['comicDB']);
            $stmt->execute();
            $stmt->close();



            //Add text update
        exit();
        }
    }

loadCImgs($conn);
setBackground($conn);

// Mark

echo $_SESSION['current'];
     

?>