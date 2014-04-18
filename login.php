<?php
include_once 'db_connect.php';
include_once 'functions.php';
SSLon();
sec_session_start();
if (login_check($mysqli) != true) :
?>
<!DOCTYPE html>
<html>
        <head>
                <title> Log In </title>
				<meta charset="utf-8">
                <script type="text/javascript" src="js/sha512.js"></script>
                <script type="text/javascript" src="js/forms.js"></script>
                <link href="css/bootstrap.min.css" rel="stylesheet">
				<link href="css/login.css" rel="stylesheet">
        </head>
        <body>
			 <a class="brand" href="index.php"><img src="img/logo.png" alt="Simple Blog logo" width= "200px"></a>
            <?php
				if (isset($_GET['error'])) {
					echo '<p class="error">Error Logging In!</p>';
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
<?php 
else:
	header('Location: moi.php');
endif;
?>
