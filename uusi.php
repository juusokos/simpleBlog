<?php

include_once 'db_connect.php';
include_once 'functions.php';
require_once 'htmlpurifier/library/HTMLPurifier.auto.php';

// HTML purifier
$content = $dirty_html;
$config = HTMLPurifier_Config::createDefault();
$purifier = new HTMLPurifier($config);
$clean_html = $purifier->purify($dirty_html); 
$clean_html = 'kontentti OK'; 	
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
				  <a class="navbar-brand" href="#">SIMPLE BLOG</a>
				</div>
				<div class="navbar-collapse collapse">
				  <ul class="nav navbar-nav navbar-right">
				   <li><a href="blogisivu.php?id=<?php echo htmlentities($_SESSION['user_id']); ?>">Oma blogi</a></li>
					<li><a href="#">Profiili</a></li>
					<li><a href="logout.php">Kirjaudu ulos</a></li>
				  </ul>
				  <form class="navbar-form navbar-right">
					<input type="text" class="form-control" placeholder="Search...">
				  </form>
				</div>
			  </div>
			</div>

			<div class="container-fluid">
			  <div class="row">
				<div class="col-sm-3 col-md-2 sidebar">
				  <ul class="nav nav-sidebar">
				   <p>Tervetuloa <?php echo htmlentities($_SESSION['username']); ?>!</p>
				  <li><h3>Asetukset</h3></li>
					<li class="active"><a href="artikkelit.php">Artikkelit</a></li>
					<li><a href="ulkonako.php">Ulkonäkö</a></li>
					<li><a href="#">Kuvat ja videot</a></li>
					 
				  </ul>
				  
			
				</div>
				<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
				  <h1 class="page-header">Artikkelit</h1>

				<?php
				
					$site_id = htmlentities($_SESSION['site_id']);
					
					if(isset($_GET['submit'])){

						
						$data = array($site_id, $_GET['title'], 'dummy' ,$_GET['content'], $_GET['date']);
						$STH = $DBH->prepare("INSERT INTO simple_posts (site_ID, title, image_url, content, date) VALUES (?,?,?,?,?);");
						$STH->execute($data);
						header('Location: ./artikkelit.php');						
					}
					
					
				 ?>
				  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" >
					
					<input type="text" name="title" placeholder="Otsikkosi" /><br/><br/>
					<textarea placeholder="Kirjoita tekstisi tänne" name="content" rows="10" cols="100"></textarea><br/>
					<input type="date" name="date" value="<?php echo date('Y-m-d'); ?>"/><br/><br/>
					<input type="submit" name="submit" value="Tallenna" />
				  </form>
				
				<?php
				
					
				
				if( !empty($_POST['submit']) ){
					$title = $_POST['title'];
					$content = $_POST['content'];
					
					$testi1 = '/^[A-Za-z0-9\s\W]{2,50}$/i';
					
				
				if( preg_match($testi1, $title) ){
					echo 'titteli OK<br/>';
				} else {
					echo 'titteli ei ole OK<br/>';	
				}
				
					$testi2 = '/^[A-Za-z0-9\s\W]{20,3000}$/i';
					
				if( preg_match($testi2, $content) ){
							echo ''. $clean_html .'<br/>';
				} else {
						echo 'kontentti ei ole OK<br/>';	
				}
				
				} 
				
				/*if( isset($_POST['submit'])) {
					$dirty_html = $_POST['content'];
				}*/
				
				?>
				
				  <div class="table-responsive">
					
				  </div>
				</div>
			  </div>
			</div>
					<div class="dashboard-footer">
						<ul class="nav navbar-nav navbar-right" role="menu">
							<li><h3>Asetukset</h3></li>
							<li><a href="artikkelit.php">Artikkelit</a></li>
							<li class="active"><a href="ulkonako.php">Ulkonäkö</a></li>
							<li><a href="#">Kuvat ja videot</a></li>
						</ul>
					</div> <!-- div footer -->
			<!-- Bootstrap core JavaScript
			================================================== -->
			<!-- Placed at the end of the document so the pages load faster -->
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
			<script src="./js/bootstrap.js"></script>
			<script src="./js/docs.min.js"></script>
        <?php else : ?>
            <p>
                <span class="error">You are not authorized to access this page.</span> Please <a href="login.php">login</a>.
            </p>
        <?php endif; ?>
    </body>
</html>
