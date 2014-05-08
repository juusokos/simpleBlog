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
			$id = htmlentities($_SESSION['user_id']);
	
			$SQL = "SELECT * FROM simple_sites
					INNER JOIN simple_themes ON simple_sites.theme_ID = simple_themes.ID
					INNER JOIN simple_users ON simple_sites.user_ID = simple_users.ID
					WHERE simple_users.ID = '$id';";
							
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
					<li><a href="logout.php">Kirjaudu ulos</a></li>
				  </ul>
				</div>
			  </div>
			</div>

			<div class="container-fluid">
			  <div class="row">
				<div class="col-sm-3 col-md-2 sidebar">
				  <ul class="nav nav-sidebar">
				   <p>Tervetuloa <?php echo htmlentities($_SESSION['username']);?>!</p>
				  <li><h3>Asetukset</h3></li>
					<li><a href="sivuAsetukset.php">Sivun tiedot</a></li>
					<li class="active"><a href="artikkelit.php">Artikkelit</a></li>
					<li><a href="ulkonako.php">Ulkonäkö</a></li>
					<hr>
					<li class=""><a href="blogisivu.php?id=<?php echo htmlentities($_SESSION['user_id']); ?>">Oma Blogi &raquo;</a></li>
				  
				  </ul>
				  
			
				</div>
				<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
				  <h1 class="page-header">Artikkelit <a class="btn btn-success" href="uusi.php">Kirjoita uusi</a></h1>

				
				 
				   
				  <div class="table-responsive">
					<table class="table table-striped">
					  <thead>
						<tr>
						  <th>Otsikko</th>
						  <th>Päivämäärä</th>
						  <th>Toiminnot</th>
						  <th></th>
						</tr>
					  </thead>
					  <tbody>											
						<?php
							$site_id = htmlentities($_SESSION['site_id']);
							$SQL = "SELECT * FROM simple_posts WHERE site_ID = '$site_id' ORDER BY date DESC;";
								
							
							$STH = @$DBH->query($SQL);
							$STH->setFetchMode(PDO::FETCH_OBJ);

							if($STH->rowCount() == 0):
							
						 ?>
						 <tr>
						  <th></th>
						  <th></th>
						  <th>Sinulla ei ole artikkeleita!</th>
						  <th></th>
						  <th></th>
						</tr>
					
						<?php 
				
							else:	
							while ($pages = $STH->fetch()):
								$time = strtotime($pages->date);
								$formatedTime = date('d.m.Y',$time);
						?>
						 <tr>
						   <td><?php echo $pages->title; ?></td>
						   <td><?php echo $formatedTime; ?></td>
						   <td><a href="muokkaa.php?id=<?php echo $pages->ID; ?>">Muokkaa</a></td>
						   <td><a href="poista.php?id=<?php echo $pages->ID; ?>">Poista</a></td>
						</tr>
						<?php
							endwhile; 
							endif;
						?>
					  </tbody>
					</table>
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
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
			<script src="./js/bootstrap.js"></script>
			<script src="./js/docs.min.js"></script>
         <?php else : header('Location: ./login.php'); endif; ?> 
    </body>
</html>
