<?php
/* Displays all error messages */
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Error - 404</title>
    <link rel="stylesheet" type="text/css" href="../CSS/style.css">
</head>

<body>
    <!--Site-Logo oben anzeigen-->
    <a href="https://www.web-netz.de"><img src="../Images/logos/web-netz.png"></a>

    <div class="form">
        <h1>Error</h1>
        <p>
            <?php
            if (isset($_SESSION['message']) and !empty($_SESSION['message'])) :
                echo $_SESSION['message'];
            else :
                header("location: /webnetz/Backend/redakteur/index.php");
            endif;
            ?>
        </p>
        <a href="/webnetz/Backend/redakteur/index.php"><button class="button button-block" />Home</button></a>
    </div>
</body>

</html>