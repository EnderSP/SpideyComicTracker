<?php

session_start();
require_once 'config.php';
$ip= $_SERVER['REMOTE_ADDR'];
if(isset($_POST['Register']))
    {
        unset($_SESSION['login_error']);
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
        
        //check how many times this ip has attempted to login use stmt to ensure ip can not inject anything malicious into statement
        $stmt = $conn->prepare(" SELECT COUNT(*) FROM login_attempts WHERE ip_Address =? AND attempt_Time >NOW()- INTERVAL 15 minute");
        $stmt -> bind_param("s", $ip);
        $stmt->execute();
        // standard  call excpet using count plus indexed table with ip plus timestamp to save
        //time means there is only one row for results and it contains total attempts in last 15 min
        $results= $stmt->get_result();
        
        $attempts = $results->fetch_row()[0]

        if($attempts >=5)
            {
                $_SESSION['login_error'] = 'Too many login attempts. wait 15 min';
                $_SESSION['active-form']= 'login';
                header("Location: Login.php");
                exit();
            }








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
    //add new login attemt to db to read later
    $stmt = $conn->prepare(" INSERT INTO login_attempts(ip_Address) VALUES(?)");
    $stmt -> bind_param("s", $ip);
    $stmt -> execute();

    
    $_SESSION['login_error']='Incorrect information  ';
    $_SESSION['active-form']='login';
    header("Location: Login.php");
    exit();
}
?>