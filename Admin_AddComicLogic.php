<?php
session_Start();
require_once 'config.php';

//dif isset for each comic 
if(isset($_POST['btn_616']))

    {
        $name= $_POST['ComicName'];
        $start= $_POST['Start'];
        $end= $_POST['End'];
        $img= $_POST['Image'];
        if ($name===''||$start===''||$img==='')
            {
                exit('fill in everything please');
            }
        $conn->query("INSERT INTO s616(ComicName, IssueStart,IssueEnd,ImagePath) VALUES ('$name','$start','$end','$img')");
        header("Location: Admin_AddComic.php");
    }
    if(isset($_POST['btn_2000']))
    {
        $name= $_POST['ComicName'];
        $start= $_POST['Start'];
        $end= $_POST['End'];
        $img= $_POST['Image'];
        if ($name===''||$start===''||$img==='')
            {
                exit('fill in everything please');
            }
        $conn->query("INSERT INTO s2000(ComicName, IssueStart,IssueEnd,ImagePath) VALUES ('$name','$start','$end','$img')");
        header("Location: Admin_AddComic.php");
        }
if(isset($_POST['btn_2018']))
    {
        $name= $_POST['ComicName'];
        $start= $_POST['Start'];
        $end= $_POST['End'];
        $img= $_POST['Image'];
        if ($name===''||$start===''||$img==='')
            {
                exit('fill in everything please');
            }
        $conn->query("INSERT INTO s2018(ComicName, IssueStart,IssueEnd,ImagePath) VALUES ('$name','$start','$end','$img')");
        header("Location: Admin_AddComic.php");
    }




















?>