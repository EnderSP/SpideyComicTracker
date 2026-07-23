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

// SET current IssueName TO DISPLAY

 $_SESSION['currentIssue']= getIssueName($conn,$tableName,$_SESSION['current']);
$_SESSION['currentStart']= getIssueStart($conn,$tableName,$_SESSION['current']);
$_SESSION['currentEnd']= getIssueEnd($conn,$tableName,$_SESSION['current']);       
}
function getImagePath($conn, $tableName, $comicID)
{
    
    $result = $conn->query(" SELECT ImagePath FROM $tableName WHERE ComicId = $comicID");
        if($result->num_rows>0)
            {
                return $result->fetch_assoc()['ImagePath'];
            }
        return "images/blank.jpg";
}



function getIssueName($conn, $tableName, $comicID)
{
    $result = $conn->query("SELECT ComicName FROM $tableName WHERE ComicId =$comicID");
    if($result ->num_rows>0)
        {
            return $result->fetch_assoc()['ComicName'];
        }
    return "Issue Name";
}
function getIssueStart($conn, $tableName, $comicID)
{
    $result = $conn->query("SELECT IssueStart FROM $tableName WHERE ComicId =$comicID");
    if($result ->num_rows>0)
        {
            return $result->fetch_assoc()['IssueStart'];
        }
    return "Issue 1";
}
function getIssueEnd($conn,$tableName,$comicID)
{
    $result =$conn->query("SELECT IssueEnd FROM $tableName WHERE ComicId=$comicID");
    if($result->num_rows>0)
        {
            return $result->fetch_assoc()['IssueEnd'];
        }
     
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
                $_SESSION['backgroundColor']="linear-gradient(to bottom, #29335C, #708cf8);";
                $_SESSION['readStatus']="Completed!";

            }
        else
            {
                $_SESSION['backgroundColor']="linear-gradient(to bottom, #29335C, #29335C);";
                $_SESSION['readStatus']="Incomplete";
            }
}

if (isset($_POST['next']))
    {
    $tableName= $_SESSION['comicDB'];
    $sql= "SELECT 1 FROM $tableName WHERE ComicId = ?";
    $stmt= $conn ->prepare($sql);
    if (!$stmt)
        {
           die("couldnt prepare query". $conn->error);
        }
    $nextRow=$_SESSION['current']+1;
    $stmt -> bind_param("i", $nextRow);
     $stmt -> execute();
    $result =$stmt->get_result();
    
    if ($result->num_rows>0)
        {
            $_SESSION['current'] +=1;
            
        }
    else{
        $_SESSION['current'];
        
    }
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
            $stmt2=$conn->prepare("DELETE FROM userreadlist WHERE Email=? AND Sid=? AND ComicID=? ");//using bind parsm to prevent ill intent emial injectins as well as to convert variables irectly to string on creation
            $stmt2->bind_param("ssi", $_SESSION['Email'], $_SESSION['comicDB'],$_SESSION['current']);
            $stmt2->execute();
            $stmt2->close();

            
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
            $stmt1->execute();
            $stmt1->close();

             header("Location: Tracker.php");

            //Add text update
        exit();
        }
    }

loadCImgs($conn);
setBackground($conn);

// Mark


     

?>