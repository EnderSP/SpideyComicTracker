<?php
session_start();
$username = isset($_SESSION['Name']) ? $_SESSION['Name'] : 'Guest';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="SelectionScreenStyle.css">
    <title>webslinger</title>
</head>
<body style="background-color: #DB2B39;">

<h1>Welcome, <?php echo htmlspecialchars($username); ?></h1>



     <div class = "background-Box">
     </div>
     <div class = "background-Box2">
     </div>
          <form  class = "selectionMenu" action ="SelectionLogic.php" method = "post">
               
               
                    <div class = "comic" id="Spider-Man_616">
                         
                              <button class=" button" name ="btn_616">
                                   <img class="OG" src= "images\616Vol1.jpg" alt="616">
                              </button>
                              
                              
                    </div>
                    <div class ="comic" id="Spider-Man_2000">
                              <button class="button" name ="btn_2000">
                                   <img class="NOG" src= "images\UltimateVol1.jpg" alt="2000">
                              </button>
                              
                    </div>
                    <div class ="comic" id="Spider-Man_2018">
                              <button  class="button" name = "btn_2018">
                                   <img class="NNOG" src= "images\NewUltimateVol1.jpg" alt="2018">
                              </button>
                              

                              
                    </div>
                    
          </form>
     </div>

</body>
 <script src =SelectionScreen.js></script>
</html>



