
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
                <script type="text/javascript" src="sha512.js"></script>
                <script type="text/javascript" src="forms.js"></script>
                <link rel="stylesheet" type="text/css" href="style.css"/>
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
                <form action="process_login.php" method="post" name="login_form">
                Email: <input type="text" name="email" /> <br/>
                Password: <input type="password" name="password" id="password" /> <br/>
                <input type="button" value="Kirjaudu sisään" onclick="formhash(this.form, this.form.password);" />
        </body>
</html>
