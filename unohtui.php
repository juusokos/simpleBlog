<?php
include "db_connect.php"; //connects to the database
include "new_password.php";
?>

<html>
   <head>
                <title> Salasana unohtui </title>

				<meta charset="utf-8">
                <script type="text/javascript" src="js/sha512.js"></script>
                <script type="text/javascript" src="js/forms.js"></script>
     				<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
                <link href="css/bootstrap.min.css" rel="stylesheet">
				<link href="css/login.css" rel="stylesheet">
        </head>
<body>

		<a id="luoBlogi" class="btn btn-success" href="register.php">Luo Blogi</a>
			<div id="logo">
				<a class="brand" href="index.php"><img src="img/logo.png" alt="Simple Blog logo" width= "200px"></a>
            </div>


	<form id="passform" class="form-signin" method="post" name="pass_form" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>">

		<h1 class="form-signin-heading">Luo uusi salasana</h1>

		<p>Syötä sähköpostiosoitteesi, lähetämme sinulle uuden salasanan</p>

		<p>Sähköpostiosoite: <input class="form-control" type="text" name="email" size="20″ maxlength="40″ value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" /></p>

		<input class="btn btn-lg btn-primary btn-block" type="button" name="submit" value="Lähetä" onclick="return formhash(this.form,<?php generate_password(); ?>"/>

	</form>

</body>
</html>
