<?php
/* Zeigt alle erfolgreichen Nachrichten an */
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Erfolg</title>
  <link href='../CSS/style.css' rel='stylesheet' type='text/css'>
</head>
<body>
<!-- Site-Logo oben anzeigen -->
<a href="https://www.web-netz.de"><img src="../Images/logos/web-netz.png"></a> 
<div class="form">
    <h1><?= 'Success'; ?></h1>
    <p>
    <?php 
    if( isset($_SESSION['message']) AND !empty($_SESSION['message']) ):
        echo $_SESSION['message'];    
    else:
        header( "location: /webnetz/Backend/redakteur/index.php" );
    endif;
    ?>
    </p>
    <a href="/webnetz/Frontend/index.php"><button class="button button-block"/>Übersicht</button></a>
</div>
</body>
</html>