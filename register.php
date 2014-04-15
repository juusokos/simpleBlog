<?php
include_once 'register.inc.php';
include_once 'functions.php';

sec_session_start();
if (login_check($mysqli) != true):
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Secure Login: Registration Form</title>
        <script type="text/JavaScript" src="js/sha512.js"></script> 
        <link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/register.css" rel="stylesheet">
		<script type="text/JavaScript" src="js/forms.js"></script>
		<script src="js/jquery-2.0.3.min.js"></script>
    </head>
    <body>
	<div id="container">
        <!-- Registration form to be output if the POST variables are not
        set or if the registration script caused an error. -->
        <h1>Rekisteröidy
			<button class="btn btn-primary "data-toggle="modal" data-target="#myModal">?</button>
		</h1>
		
        <?php
			if (!empty($error_msg)) {
				echo $error_msg;
			}
        ?>
		
		<!--Ohjemodaali-->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Ohjeet</h4>
					</div>
					<div class="modal-body">
						<ul>
							<li>Käyttäjätunnus saa sisältää ainoastaan numeroita, isoja ja pieniä alkukirjaimia sekä alaviivoja</li>
							<li>Sähköpostiosoite pitää olla  muotoa esim. aila@gmail.com </li>
							<li>Salasanassa tulee olla vähintään kuusi merkkiä</li>
							<li>Salasanan tulee sisältää:</li> 
							<ul>
								<li>Vähintään yksi iso kirjain (A..Z)</li>
								<li>Vähintään yksi pieni kirjain (a..z)</li>
								<li>Vähintään yksi numero (0..9)</li>
							</ul> 
						</ul>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Sulje</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

	
		
        <form role="form" method="post" name="registration_form" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" class="form-horizontal">
            <div id="form-group col-sm-2">
				<label for="username" class="control-label">Käyttäjätunnus:</label>
				<input id="username" name="username" type="text" class="form-control" 
						     placeholder="Käyttäjätunnus" ><br>
			
			</div>
			 <div id="form-group col-sm-2">
			 <label for="email" class="control-label">Sähköpostiosoite:</label>
			 <input id="email" name="email" type="text" class="form-control" 
					      placeholder="Sähköpostiosoite" ><br>
			</div>

			 <div id="form-group col-sm-2">
				<label for="password" class="control-label">Salasana:</label>
				<input id="password" name="password" type="password" class="form-control" 
							  placeholder="Salasana" ><br>
			</div>			
			 <div id="form-group col-sm-2">		
			<label for="confirmpwd" class=" control-label">Salasana uudelleen:</label><br>
            <input id="confirmpwd" name="confirmpwd" type="password" class="form-control"
									placeholder="Salasana uudelleen"><br><br>
			</div>
            <input type="button" 
                   value="Rekisteröidy" 
				   class="btn btn-lg btn-primary btn-block col-sm-2"
                   onclick="return regformhash(this.form,
                                   this.form.username,
                                   this.form.email,
                                   this.form.password,
                                   this.form.confirmpwd);" /> 
			<p class="help-block">Palaa <a href="index.php">kirjautumissivulle</a>.</p>
			
        </form>
		
        
		
		
		
		
	</div> <!-- /container -->
	 <script src="js/bootstrap.min.js"></script>
    </body>
</html>
<?php 
else:
	header('Location: ./index.php');
endif;
?>
