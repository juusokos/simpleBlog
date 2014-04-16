<?php SSLon(); ?>
<!DOCTYPE html>
<html>
    <head>
       
		  <meta charset="UTF-8">
        <title>Secure Login: luo blogi</title>
        <script type="text/JavaScript" src="js/sha512.js"></script> 
        <link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/register.css" rel="stylesheet">
		<!-- <script type="text/JavaScript" src="js/forms.js"></script> -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="js/bootstrap.js"></script>
    </head>
    <body>
		<div id="container">
			<div id="header"> <h1>Luo Blogi</h1></div>
        <h1>Rekisteröinti onnistui!</h1>
		
         <form enctype="multipart/form-data" role="form" method="post" name="registration_form" action="<?php $_SERVER['PHP_SELF']?>" class="form-horizontal">
            <div id="form-group col-sm-2">
				<label for="username" class="control-label">Blogin nimi:</label>
				<input id="username" name="username" type="text" class="form-control" 
						     placeholder="Blogin nimi" ><br>
			
			</div>
			 <div id="form-group col-sm-2">
			 <label for="email" class="control-label">Blogin alaotsikko:</label>
			 <input id="email" name="email" type="text" class="form-control" 
					      placeholder="Alaotsikko" ><br>
			</div>

			 <div id="form-group col-sm-2">
				<label for="password" class="control-label">Kuvaus:</label>
				<textarea id="kuvaus" name="kuvaus" type="textarea" class="form-control" rows="5"
							  placeholder="Kuvaus blogista tai sinusta" ></textarea><br>
			</div>			
			 <div id="form-group col-sm-2">		
			<label for="confirmpwd" class=" control-label">Salasana uudelleen:</label><br>
            <input id="confirmpwd" name="confirmpwd" type="password" class="form-control"
									placeholder="Salasana uudelleen"><br><br>
			</div>
			<div class="form-group">
				<label for="lisaaKuva">Valitse kansikuva</label>
				<ul>
				
				</ul>
				<input type="file" name="test">
			
				
			</div>
            <input type="submit" value="Lataa"
				   class="btn btn-lg btn-primary btn-block col-sm-2"
                    /> 
			<p class="help-block">Palaa <a href="index.php">kirjautumissivulle</a>.</p>
			
			</form>
		
		</div>
    </body>
</html>
