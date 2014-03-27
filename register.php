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
        <h1>Register with us</h1>
        <?php
			if (!empty($error_msg)) {
				echo $error_msg;
			}
        ?>
        <ul>
            <li>Usernames may contain only digits, upper and lower case letters and underscores</li>
            <li>Emails must have a valid email format</li>
            <li>Passwords must be at least 6 characters long</li>
            <li>Passwords must contain
                <ul>
                    <li>At least one upper case letter (A..Z)</li>
                    <li>At least one lower case letter (a..z)</li>
                    <li>At least one number (0..9)</li>
                </ul>
            </li>
            <li>Your password and confirmation must match exactly</li>
        </ul>
        <form method="post" name="registration_form" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" class="form-signin">
            Username: <input id="username" name="username" type="text" class="form-control" 
						     placeholder="Käyttäjätunnus" ><br>
			Email: <input id="email" name="email" type="text" class="form-control" 
					      placeholder="Sähkäpostiosoite" ><br>
            Password:  <input id="password" name="password" type="password" class="form-control" 
							  placeholder="Salasana" ><br>
            Confirm password:<input id="confirmpwd" name="confirmpwd" type="password" class="form-control"
									placeholder="Salasana uudelleen"><br><br>
      
            <input type="button" 
                   value="Rekisteröidy" 
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
