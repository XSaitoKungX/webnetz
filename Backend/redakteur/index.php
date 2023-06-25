<!--Ein Code zur Erstellung der Produktion
    Kontoerstellung und Anmeldevorgang
 -->
<!--**************************************-->

<?php
/* Hauptseite mit zwei Formularen: Registrieren und Anmelden */
require_once '../../SQL/db.php'; // read from the database
require_once __DIR__ . '/../../Functions/session.php'; // read from the database
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['login'])) {
    // Benutzeranmeldung
    login($_POST['email'], $_POST['password']);
  } elseif (isset($_POST['register'])) {
    // Benutzerregistrierung
    require_once 'register.php';
  }
}

?>
<!DOCTYPE html>
<html>

<head>
  <title>Signup - Login</title>
  <link href='../../CSS/style.css' rel='stylesheet' type='text/css'>
</head>

<body>

  <a href="https://www.web-netz.de"><img src="/webnetz/Images/logos/web-netz.png"></a> <!--Site Logo-->
  <div id="full-body"> <!--Site background-->


    <div class="form">
      <ul class="tab-group">
        <li class="tab"><a href="#signup">Sign Up</a></li>
        <li class="tab active"><a href="#login">Log In</a></li>
      </ul>

      <div class="tab-content">

        <!--Start Login Form-->
        <div id="login">
          <h1>WILLKOMMEN!</h1>

          <!--Launching Login Form-->
          <form action="index.php" method="post" autocomplete="off">
            <div class="field-wrap">
              <label>
                <span class="req">*</span>
              </label>
              <input type="email" required autocomplete="off" name="email" placeholder="Email.." />
            </div>

            <div class="field-wrap">
              <label>
                <span class="req">*</span>
              </label>
              <input type="password" required autocomplete="off" name="password" placeholder=" Passwort.." />
            </div>

            <p class="forgot"><a href="/webnetz/Backend/redakteur/reset_passwort/forgot.php">Passwort vergessen?</a></p>

            <button class="button button-block" name="login" />Log In</button>

          </form>
          <!--Terminating Login Form-->

        </div>
        <!--End Login Form-->


        <!--Note: Das Anmeldeformular wird online geladen, da die Cloudfare-Datei Jquery.min.js online geladen wird-->
        <!--Start SignUp Form-->
        <div id="signup">
          <h1>Konto erstellen</h1>

          <!--Launching SignUp Form-->
          <form action="register.php" method="post" autocomplete="off">

            <div class="top-row">
              <div class="field-wrap">
                <label>
                  Vorname<span class="req">*</span>
                </label>
                <input type="text" required autocomplete="off" name='firstname' />
              </div>

              <div class="field-wrap">
                <label>
                  Nachname<span class="req">*</span>
                </label>
                <input type="text" required autocomplete="off" name='lastname' />
              </div>
            </div>

            <div class="field-wrap">
              <label>
                Benutzername<span class="req">*</span>
              </label>
              <input type="text" required autocomplete="off" name='username' />
            </div>

            <div class="field-wrap">
              <label>
                Email Address<span class="req">*</span>
              </label>
              <input type="email" required autocomplete="off" name='email' />
            </div>

            <div class="field-wrap">
              <label>
                Passwort<span class="req">*</span>
              </label>
              <input type="password" required autocomplete="off" name='password' />
            </div>

            <button type="submit" class="button button-block" name="register" />Registrieren</button>

          </form>
          <!--Terminating SignUp Form-->

        </div>
        <!--End SignUp Form-->


      </div><!-- tab-content -->

    </div> <!-- /form -->


  </div>

  <footer>
    <p>
      <a href="https://www.web-netz.de">&copy; 2023-<?php echo date("Y"); ?> Nattapat Pongsuwan</a>
      <span style="color: black">, All Rights Reserved.</span>
      <span style="color: black">|</span>
      <a href="terms.php">Terms</a>
      <span style="color: black">|</span>
      <a href="privacy.php">Privacy</a>
      <span style="color: black">|</span>
      <a href="contact.php">Contact</a>
    </p>
  </footer>


  <!--Load Cloudflare jquery.min.js online-->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <!--Load index.js from the resource folder-->
  <script src="../../JS/index.js"></script>


</body>

</html>