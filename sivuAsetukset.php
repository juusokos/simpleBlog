<?php

include_once 'db_connect.php';
include_once 'functions.php';
require_once 'library/HTMLPurifier.auto.php';

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
					<li><a href="#">Kuvat ja videot</a></li>
					 
				  </ul>
				  
			
				</div>
				<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
				  <h1 class="page-header">Sivun Tiedot <a class="btn btn-success" href="uusi.php">Kirjoita uusi</a></h1>

				<?php
					
					$site_id = htmlentities($_SESSION['site_id']);
					
					if(isset($_GET['submit'])){
						if(!empty($_GET['blog_title']) && !empty($_GET['about'])){
							$config = HTMLPurifier_Config::createDefault();
							$purifier = new HTMLPurifier($config);
							$blog_title = $purifier->purify($_GET['blog_title']);
							$blog_description = $purifier->purify($_GET['blog_description']);
							$about = $purifier->purify($_GET['about']);
							
							$testi1 = '/^[A-Za-z0-9\s\W]{2,50}$/i';
							$testi2 = '/^[A-Za-z0-9\s\W]{0,500}$/i';
							$testi3 = '/^[A-Za-z0-9\s\W]{20,500}$/i';

							if(preg_match($testi1, $blog_title) && preg_match($testi2, $blog_description) && preg_match($testi3, $about)){
								$data = array($blog_title, $blog_description, $about);
								$STH = $DBH->prepare("UPDATE simple_sites SET blog_title = ?, blog_description = ?, about = ? WHERE ID = '$site_id';");
								$STH->execute($data);
								header('Location: ./sivuAsetukset.php');
							} else {
								echo 'Täytä kentät oikein!<br/>';	
							}
						}
					}
					
					$SQL = "SELECT * FROM simple_sites WHERE ID = '$site_id';";
								
					$STH = @$DBH->query($SQL);
					$STH->setFetchMode(PDO::FETCH_OBJ);
					while($row = $STH->fetch()):
				 ?>
				  <form action="<?php echo $_SERVER['PHP_SELF']; ?>">
					<h3>Blogin otsikko</h3>
					<input type="text" name="blog_title" value="<?php echo $row->blog_title; ?>" /><br/><br/>
					<h3>Blogin kuvaus</h3>
					<textarea name="blog_description" rows="10" cols="100"><?php echo $row->blog_description; ?></textarea><br/>
					<h3>Kuvaus itsestäsi</h3>
					<textarea name="about" rows="10" cols="100"><?php echo $row->about; ?></textarea><br/>
					<input type="submit" name="submit" value="Tallenna" />
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
							<li><a href="#">Kuvat ja videot</a></li>
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
