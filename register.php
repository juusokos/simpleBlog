<?php
include_once 'register.inc.php';
include_once 'functions.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Secure Login: Registration Form</title>
        <script type="text/JavaScript" src="js/sha512.js"></script> 
        <script type="text/JavaScript" src="js/forms.js"></script>
        <link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/register.css" rel="stylesheet">
    </head>
    <body>
        <!-- Registration form to be output if the POST variables are not
        set or if the registration script caused an error. -->
        <h1>Rekisteröidy</h1>
        <?php
			if (!empty($error_msg)) {
				echo $error_msg;
			}
        ?>
        <ul>
            <li>Käyttäjätunnus saa sisältää ainoastaan numeroita, isoja ja pieniä alkukirjaimia sekä alaviivoja</li>
            <li>Sähköpostiosoite pitää olla  muotoa esim. aila@gmail.com </li>
            <li>Salasanassa tulee olla vähintään kuusi merkkiä</li>
            <li>Salasanan pitää sisältää
                <ul>
                    <li>Vähintään yksi iso kirjain (A..Z)</li>
                    <li>Vähintään yksi pieni kirjain (a..z)</li>
                    <li>Vähintään yksi numero (0..9)</li>
                </ul>
            </li>
            
        </ul>
        <form method="post" name="registration_form" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" class="form-signin">
            Username: <input id="username" name="username" type="text" class="form-control" 
						     placeholder="KÃ¤yttÃ¤jÃ¤tunnus" ><br>
			Email: <input id="email" name="email" type="text" class="form-control" 
					      placeholder="SÃ¤hkÃ¤postiosoite" ><br>
            Password:  <input id="password" name="password" type="password" class="form-control" 
							  placeholder="Salasana" ><br>
            Confirm password:<input id="confirmpwd" name="confirmpwd" type="password" class="form-control"
									placeholder="Salasana uudelleen"><br><br>
      
            <input type="button" 
                   value="RekisterÃ¶idy" 
				   class="btn btn-lg btn-primary btn-block"
                   onclick="return regformhash(this.form,
                                   this.form.username,
                                   this.form.email,
                                   this.form.password,
                                   this.form.confirmpwd);" /> 
        </form>
        <p>Return to the <a href="index.php">login page</a>.</p>
    </body>
</html>
