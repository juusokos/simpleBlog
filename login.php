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
                <script src="./js/jquery-2.0.3.min.js"></script>
                <link href="css/bootstrap.min.css" rel="stylesheet">
				<link href="css/login.css" rel="stylesheet">
        </head>
        <body>
		<a id="luoBlogi" class="btn btn-success" href="register.php">Luo Blogi</a>
			<div id="logo">
				<a class="brand" href="index.php"><img src="img/logo.png" alt="Simple Blog logo" width= "200px"></a>
            </div>
			
                <form class="form-signin" action="process_login.php" method="post" name="login_form">
				<?php
				if (isset($_GET['error'])) {
					echo '<p style="color:red">Sisäänkirjautuminen epäonnistui. Salasana tai sähköpostiosoite on väärin.</p>';
				}
				if (isset($_GET['register'])) {
					echo '<p style="color:green">Rekisteröityminen onnistui! Kirjaudu sisään luomallasi tunnuksella.</p>';
				}
				if (isset($_GET['newpass'])) {
					echo '<p style="color:green">Uusi salasana lähetetty sähköpostiisi!</p>';
				}
				?> 
				<h2 class="form-signin-heading">Kirjaudu sisään</h2>
                Email: <input type="text" name="email" class="form-control" placeholder="Sähköpostiosoite"  /> <br/>
                Password: <input type="password" name="password" class="form-control" placeholder="Salasana" id="password" /> <br/>
                <input class="btn btn-lg btn-primary btn-block" type="button" value="Kirjaudu sisään" onclick="formhash(this.form, this.form.password);" />
				<a href="unohtui.php">Unohtuiko salasana?</a>
				</form>
        </body>
</html>
<?php 
else:
	header('Location: index.php');
endif;
?>
