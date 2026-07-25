<?php

session_start();
require_once 'config.php';

if(isset($_POST['Register']))
    {
        unset($_SESSION['login-error']);
        $username = trim($_POST['UserName']);
        $email = trim($_POST['Email']);
        $password = password_hash($_POST['Password'], PASSWORD_DEFAULT);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $_SESSION['register_error'] = 'Please enter a valid email address';
            $_SESSION['active-form'] = 'register';
            header("Location: Login.php");
            exit();
        }
    
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
            $conn->query("INSERT INTO userlr(Email, Sid) VALUES('$email', 'S616')");
            $conn->query("INSERT INTO userlr(Email, Sid) VALUES('$email', 'S2000')");
            $conn->query("INSERT INTO userlr(Email, Sid) VALUES('$email', 'S2018')");
            
        }
     header("Location: Login.php");
    exit();
    }
?>
<?php
if (isset($_POST['Login']))
    {
        unset($_SESSION['register-error']);
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
            $_SESSION['login_error']='Incorrect Pasword';
        }


    
    $_SESSION['login_error']='Incorrect email ';
    $_SESSION['active-form']='login';
    header("Location: Login.php");
    exit();
}
?>