<?php


include_once 'db_connect.php';
include_once 'functions.php';
 
		sec_session_start();
 
	if (login_check($mysqli) == true) {
		$logged = 'in';
	} else {
		$logged = 'out';
	}

?>


<!DOCTYPE html>
<html>
        <head>
                <title> Log In </title>
                <script type="text/javascript" src="js/sha512.js"></script>
                <script type="text/javascript" src="js/forms.js"></script>
                <link href="css/bootstrap.min.css" rel="stylesheet">
				<link href="css/login.css" rel="stylesheet">
        </head>
        <body>
            <?php
				require_once('process_login.php');
				require_once('db_connect.php');
				require_once('functions.php');
				
                if(isset($_GET['error'])){
                        echo ' Error Logging IN!';
                }
				
				sec_session_start();
				if(login_check($mysqli) == true){
					echo 'mitä vaan <br/>';
				} else{
					echo 'You are not authorized to access this page, please login. <br/>';
				}
                ?> 
                <form class="form-signin" action="process_login.php" method="post" name="login_form">
				<h2 class="form-signin-heading">Kirjaudu sisään</h2>
                Email: <input type="text" name="email" class="form-control" placeholder="Sähköpostiosoite"  /> <br/>
                Password: <input type="password" name="password" class="form-control" placeholder="Salasana" id="password" /> <br/>
                <input class="btn btn-lg btn-primary btn-block" type="button" value="Kirjaudu sisään" onclick="formhash(this.form, this.form.password);" />
				<a href="#">Unohtuiko salasana?</a>
				</form>
        </body>
</html>
