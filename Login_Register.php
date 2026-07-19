<?php

session_start();
require_once 'config.php';

if(isset($_POST['Register']))
    {
        $username =$_POST['UserName'];
        $email=$_POST['Email'];
        $password= password_hash($_POST['Password'],PASSWORD_DEFAULT);
        
    
    $checkEmail = $conn->query("SELECT Email FROM users WHERE Email= '$email'" );
    $checkUsername = $conn->query("SELECT Username FROM users WHERE Username= '$username'" );
     if ($checkEmail -> num_rows>0)
        {
            $_SESSION['register_error']= 'Email is already in use';
            $_SESSION['active-form']= 'register';
        }
    else if($checkUsername-> num_rows>0)
        {
            $_SESSION['register_error']= 'username is already in use';
            $_SESSION['active-form']= 'register';
            
        }
    else
        {
            $conn->query("INSERT INTO users(Username, Email, Password) VALUES('$username', '$email', '$password')");
            
        }
     header("Location: Login.php");
    exit();
    }
?>
<?php
if (isset($_POST['Login']))
    {
    $password =$_POST['Password'];
    $name=$_POST['EmailUser'];

    $result = $conn->query("SELECT * from users WHERE Username='$name'OR Email='$name'");
    
    if($result->num_rows>0)
        {
            
            $user=$result->fetch_assoc();
            if(password_verify($password,$user['Password']))
                {
                    $_SESSION['Name']= $user['Username'];
                    $_SESSION['Email']= $user['Email'];

                    header("Location: SelectionScreen.php");
                    exit();
                }
        }


    
    $_SESSION['Login_error']='Incorrect email or password';
    $_SESSION['active-form']='login';
    header("Location: Login.php");
    exit();
}
?>