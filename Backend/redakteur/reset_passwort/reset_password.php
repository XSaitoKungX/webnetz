<?php
/* 
   Hier gibt es nur zwei Prozesse: 
   1. Vorgang zum Zurücksetzen des Passworts
   2. Aktualisiert die Datenbank mit dem neuen Benutzerkennwort
*/
require_once '../../../SQL/db.php';
session_start();

// Hey! Make sure the form is being submitted with method="post"
if ($_SERVER['REQUEST_METHOD'] == 'POST') { 

    // Hey! Make sure the two passwords match
    if ( $_POST['newpassword'] == $_POST['confirmpassword'] ) { 

        $new_password = password_hash($_POST['newpassword'], PASSWORD_BCRYPT);
        
        //Yeah! We get $_POST['email'] and $_POST['hash'] from the hidden input field of reset.php form
        $email = $mysqli->escape_string($_POST['email']);
        $hash = $mysqli->escape_string($_POST['hash']);
        
        $sql = "UPDATE users SET password='$new_password', hash='$hash' WHERE email='$email'";

        if ( $mysqli->query($sql) ) {

        $_SESSION['message'] = "Ihr Passwort wurde erfolgreich zurückgesetzt!";
        header("location: ../../../verify/success.php");    

        }

    }
    else {
        $_SESSION['message'] = "Zwei von Ihnen eingegebene Passwörter stimmen nicht überein. Versuchen Sie es erneut!";
        header("location: ../../../error/error.php");  //This will only run if you there's an error
    }

}
