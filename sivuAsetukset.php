<?php
include_once 'db_connect.php';
include_once 'functions.php';
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
        <?php if (login_check($mysqli) == true) : 
			$user_id = htmlentities($_SESSION['user_id']);

			$SQL = "SELECT * FROM simple_sites
					INNER JOIN simple_users ON simple_sites.user_ID = simple_users.ID
					WHERE simple_users.ID = '$user_id';";

			$STH = @$DBH->query($SQL);
			$STH->setFetchMode(PDO::FETCH_OBJ);
			$page = $STH->fetch();
		?>
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
					<li class="active"><a href="sivuAsetukset.php">Sivun tiedot</a></li>
					<li><a href="artikkelit.php">Artikkelit</a></li>
					<li><a href="ulkonako.php">Ulkonäkö</a></li>					 
				  	<hr>
					<li class=""><a href="blogisivu.php?id=<?php echo htmlentities($_SESSION['user_id']); ?>">Oma Blogi &raquo;</a></li>
				  </ul>			
				</div>
				<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
				  <h1 class="page-header">Sivun Tiedot</h1>
				<?php

					$site_id = htmlentities($_SESSION['site_id']);
					$SQL = "SELECT * FROM simple_sites WHERE ID = '$site_id';";								
					$STH = @$DBH->query($SQL);
					$STH->setFetchMode(PDO::FETCH_OBJ);
					 
					if (isset($_GET['ok'])==ok) {
						echo '<p style="color:green">Muutokset tallennettu. <a href="./blogisivu.php?id='.$user_id.'">Katso Blogi</a></p> ';
					}
			
					while($row = $STH->fetch()):
				 ?>
				 <form id="sivuAsetukset" action="sivuAsetuksetUpload.php" method="post" enctype="multipart/form-data">
					<h3>Blogin otsikko</h3>
					<input type="text" name="blog_title" value="<?php echo $row->blog_title; ?>" /><br/><br/>
					<h3>Blogin kuvaus</h3>
					<textarea name="blog_description" rows="10" cols="100"><?php echo $row->blog_description; ?></textarea><br/>
					<h3>Kuvaus itsestäsi</h3>
					<textarea name="about" rows="10" cols="100"><?php echo $row->about; ?></textarea><br/>
					<h3>Blogin banner kuva</h3>
					<input type="file" name="banner" /><br/>
					<input class="btn btn-primary" type="submit" name="submit" value="Tallenna muutokset" />
				  </form>
				  <?php endwhile; ?>
				  <div class="table-responsive">
					
				  </div>
				
				  
				</div>
			  </div>
			</div>
					<div class="dashboard-footer">
						<ul class="nav navbar-nav navbar-right" role="menu">
							<li><h3>Asetukset</h3></li>
							<li class="active"><a href="sivuAsetukset.php">Sivun tiedot</a></li>
							<li><a href="artikkelit.php">Artikkelit</a></li>
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
			<script>
			$(function() {	
			$("#sivuAsetukset").validate({
				rules: {
				blog_title: {
					required: true,
					minlength: 2,
					maxlength: 50
				},			
				about: {
					required: true,
					minlength: 20,
					maxlength: 500
				}
			},
			messages: {
				blog_title: {
					required: '<span style="color: red"> Anna blogille nimi</span>',
					minlength: '<span style="color: red"> Nimen on oltava vähintään 2 merkkiä pitkä</span>',
					maxlength: '<span style="color: red"> Nimen on oltava enintään 50 numeroa pitkä</span>'
				},
				about: {
					required: '<span style="color: red"> Lisää blogiin kuvaus itsestäsi</span>',
					minlength: '<span style="color: red"> Kuvauksen on oltava vähintään 20 merkkiä pitkä</span>',
					maxlength: '<span style="color: red"> Kuvauksen on oltava enintään 500 numeroa pitkä</span>'
				}
			},
			submitHandler: function(form) {
           		form.submit();
        	}
		});
		});
		</script>
         <?php else : header('Location: ./login.php'); endif; ?>
    </body>
</html>
