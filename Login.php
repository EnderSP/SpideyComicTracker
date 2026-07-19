<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="Login.css">
    <title>Webslinger Login</title>
</head>
<body>

        <div class ="container">
            <div class="form-box active"  id ="loginForm">
                <form class="form"  action ="Login_register.php" method="post">
                    <h2> Login</h2>
                 <div class="inD">
                    <input type="text" name="EmailUser"placeholder="Enter UserName or Email:">
                </div>
                <div class="inD">
                    <input type="text" name="Password"placeholder="Enter Password:">
                </div>
                <p> no account?<a href="#" onclick="showForm('RegisterForm')" >register</a> </p> 
                    <button type="submit" name="Login">Login</button>
                    
                 </form>
                   
                
            </div>
            <div class="form-box" id ="RegisterForm">
                <!-- Action will choose wht pho file to send the info to -->
                <form class="form"  action ="Login_Register.php" method="post"><!-- Post is the method to pull the data from the form later on in
                    php code to the query searhc the sql db, will not need for comic databases as it will not include user inputs -->
                    <h2> Register</h2>
                <div class="inD">
                    <input type="text" name="UserName"placeholder="Enter UserName:">
                </div>
                 <div class="inD">
                    <input type="text" name="Email"placeholder="Enter Email:">
                </div>
                <div class="inD">
                    <input type="text" name="Password"placeholder="Enter Password:">
                </div>
                <p> Already have an accoun?<a href="#" onclick ="showForm('loginForm')">Login</a></p> 
                    <button type="submit" name="Register" >Register</button>
                    
                 </form>
                   
                
            </div>
                   
                
            </div>
       </div>
      <script src="Login.js">  </script>
</body>
</html>