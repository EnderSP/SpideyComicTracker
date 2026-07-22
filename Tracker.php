<?php
require_once 'TrackerLogic.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="TrackerStyle.css">
    <title>Tracker</title>
</head>
<body style="background-color: #DB2B39;">
    <div class="container">

     <div class="layout" id="header">

        <button class ="hbutton" id="back">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="Arrow-Button-Circle-Left--Streamline-Ultimate" height="24" width="24"><path d="M12 0a12 12 0 1 0 12 12A12 12 0 0 0 12 0Zm4 17.14a0.5 0.5 0 0 1 -0.25 0.43 0.5 0.5 0 0 1 -0.5 0l-9 -5.14a0.49 0.49 0 0 1 0 -0.86l9 -5.14a0.5 0.5 0 0 1 0.5 0 0.5 0.5 0 0 1 0.25 0.43Z" fill="#000000" stroke-width="1"></path>
            </svg>
        </button>

        <div class ="read"> 
            currently reading
        </div>
        <button class ="hbutton" id="log"> 
            log
        </button>
        
     </div>
     <div class="layout" id="main" style="background-color: <?php echo htmlspecialchars($_SESSION['backgroundColor']); ?>;">

            <img class="comic" src="<?php echo htmlspecialchars($_SESSION['currentImg']); ?>" alt="current Comic">

     </div>
    <form class="footer" action="TrackerLogic.Php" id="footer" method="post">

            <button class ="submit" id ="prev" name="prev"> 
                <img  src="<?php echo htmlspecialchars($_SESSION['preImg']); ?>" alt="previous Comic">
                    
            </button>
            <button class ="submit" id="readCheck" name="readCheck"> mark as read</button>
            <button class ="submit" id ="next" name="next" >
                  <img  src="<?php echo htmlspecialchars($_SESSION['nextImg']); ?>" alt="nextComic">
            </button>

    </form>

        

    </div>


    
    
</body>
<script src =Tracker.js></script>
</html>