<?php
include_once 'db_connect.php';
include_once 'functions.php';
require_once 'library/HTMLPurifier.auto.php';
SSLon(); 
sec_session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Asetukset</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="shortcut icon" href="../../assets/ico/favicon.ico">

	   <!-- Bootstrap core CSS -->
		<link href="./css/bootstrap.min.css" rel="stylesheet">

		<!-- Custom styles for this template -->
		<link href="./css/dashboard.css" rel="stylesheet">
    </head>
    <body>
        <?php if (login_check($mysqli) == true) : ?>
             <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			  <div class="container-fluid">
				<div class="navbar-header">
				  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				  </button>
				  <a class="navbar-brand" href="index.php">SIMPLE BLOG</a>
				</div>
				<div class="navbar-collapse collapse">
				  <ul class="nav navbar-nav navbar-right">
				   <li><a href="blogisivu.php?id=<?php echo htmlentities($_SESSION['user_id']); ?>">Oma blogi</a></li>
					<li><a href="#">Profiili</a></li>
					<li><a href="logout.php">Kirjaudu ulos</a></li>
				  </ul>
				</div>
			  </div>
			</div>

			<div class="container-fluid">
			  <div class="row">
				<div class="col-sm-3 col-md-2 sidebar">
				  <ul class="nav nav-sidebar">
				   <p>Tervetuloa <?php echo htmlentities($_SESSION['username']); ?>!</p>
				    <li><h3>Asetukset</h3></li>
					<li><a href="sivuAsetukset.php">Sivun tiedot</a></li>
					<li class="active"><a href="artikkelit.php">Artikkelit</a></li>
					<li><a href="ulkonako.php">Ulkonäkö</a></li>					 
				  </ul>
				  
			
				</div>
				<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
				  <h1 class="page-header">Artikkelit</h1>

				  <form id="uusiArtikkeli" action="uusiArtikkeliUpload.php" method="post" enctype="multipart/form-data">
					<input type="text" name="title" placeholder="Otsikkosi" /><br/><br/>
					<textarea class="editable" placeholder="Kirjoita tekstisi tänne" name="content" rows="10" cols="100"></textarea><br/>
					<h3>Lisää kuva:</h3>
					<input type="file" name="image"/><br/>
					<input class="btn btn-primary" type="submit" name="submit" value="Tallenna artikkeli" />
				  </form>
				
				  <div class="table-responsive">
					
				  </div>
				</div>
			  </div>
			</div>
					<div class="dashboard-footer">
						<ul class="nav navbar-nav navbar-right" role="menu">
							<li><h3>Asetukset</h3></li>
							<li><a href="sivuAsetukset.php">Sivun tiedot</a></li>
							<li class="active"><a href="artikkelit.php">Artikkelit</a></li>
							<li><a href="ulkonako.php">Ulkonäkö</a></li>
						</ul>
					</div> <!-- div footer -->
			<!-- Bootstrap core JavaScript
			================================================== -->
			<!-- Placed at the end of the document so the pages load faster -->
			<script src="./js/jquery-2.0.3.min.js"></script>
			<script src="./js/jquery.validate.min.js"></script>
			<script src="./js/bootstrap.js"></script>
			<script src="./js/docs.min.js"></script>
			<script src="./js/tinymce.min.js"></script>
			<script>
			$(function() {	
			$("#uusiArtikkeli").validate({
				rules: {
					title: {
						required: true,
						minlength: 2,
						maxlength: 50
					},			
					content: {
						required: true,
						minlength: 0,
						maxlength: 3000
					},
				},
				messages: {
					title: {
						required: " Anna artikkelille otsikko",
						minlength: " Otsikon on oltava vähintään 2 merkkiä pitkä",
						maxlength: " Otsikon on oltava enintään 50 numeroa pitkä"
					},
					content: {
						required: " Anna artikkelille otsikko",
						minlength: " ",
						maxlength: " Artikkelin on oltava enintään 3000 numeroa pitkä"
					},
				},
				submitHandler: function(form) {
   	        		form.submit();
   	     		}
			});
					tinymce.init({
				selector: "textarea.editable",
				plugins: [
					"advlist autolink lists link image charmap print preview anchor",
					"searchreplace visualblocks code fullscreen",
					"insertdatetime media table contextmenu paste"
				],
				toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent link image",
				menubar: false
			});

			});
			</script>
         <?php else : header('Location: ./login.php'); endif; ?>
    </body>
</html>
