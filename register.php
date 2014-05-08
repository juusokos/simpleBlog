<?php
include_once 'register.inc.php';
include_once 'functions.php';
SSLon();
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
		<link href="css/login.css" rel="stylesheet">
		<script type="text/JavaScript" src="js/forms.js"></script>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    </head>
    <body>
	<div id="container">
        <!-- Registration form to be output if the POST variables are not
        set or if the registration script caused an error. -->
		<div id="logo">
				<a class="brand" href="index.php"><img src="img/logo.png" alt="Simple Blog logo" width= "200px"></a>
            </div>
     		
        <?php
			if (!empty($error_msg)) {
				echo $error_msg;
			}
        ?>
		
		 <h1>Rekisteröidy</h1>
		
		<!--Ohjemodaali-->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Ohjeet</h4>
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
				<input id="username" data-content="Käyttäjätunnus saa sisältää ainoastaan numeroita, isoja ja pieniä alkukirjaimia sekä alaviivoja" data-placement="right" name="username" type="text" class="form-control" 
						     placeholder="Käyttäjätunnus" ><br>
			
			</div>
			 <div id="form-group col-sm-2">
			 <label for="email" class="control-label">Sähköpostiosoite:</label>
			 <input id="email" name="email" type="text" class="form-control" 
					      placeholder="Sähköpostiosoite" ><br>
			</div>

			 <div id="form-group col-sm-2">
				<label for="password" class="control-label">Salasana:</label>
				<input id="password" data-content="Salasanassa tulee olla vähintään kuusi merkkiä.
							Salasanan tulee sisältää
							vähintään yksi iso kirjain,
							pieni kirjain ja
							numero." data-placement="right"
					   name="password" type="password" class="form-control" 
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
			<p class="help-block">Palaa <a href="index.php">etusivulle</a>.</p>
			
        </form>		
	</div> <!-- /container -->
	<script src="./js/jquery-2.0.3.min.js"></script>
	 <script src="./js/bootstrap.min.js"></script>
	 
	 <!-- poistaa täyttöohjeet -->
	 <script>
		$("#username").popover({ trigger: "click" });
		
		$('#password').popover();

		$('#password').on('click', function (e) {
			$('#username').not(this).popover('hide');
		});
		
		$('#username').on('click', function (e) {
			$('#password').not(this).popover('hide');
		});
		
		$(document).mouseup(function (e) {
			var container = $("#password, #username");

			if (!container.is(e.target) // if the target of the click isn't the container...
			&& container.has(e.target).length === 0) // ... nor a descendant of the container
			{
				container.popover('hide');
			}
	});
		
	 </script>
    </body>
</html>
<?php 
else:
	header('Location: ./index.php');
endif;
?>
