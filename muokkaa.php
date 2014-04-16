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
					<li><a href="#">Kuvat ja videot</a></li>
					 
				  </ul>
				  
			
				</div>
				<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
				  <h1 class="page-header">Artikkelit <a class="btn btn-success" href="uusi.php">Kirjoita uusi</a></h1>

				<?php
					
					
					$site_id = htmlentities($_SESSION['site_id']);				
					$post_id = $_GET['id'];
					$testi = '/^[0-9]{1,11}$/i';
					
					if(preg_match($testi, $post_id)):
					
					if(isset($_GET['poista'])){
						if(!empty($_GET['id'])){					
							$config = HTMLPurifier_Config::createDefault();
							$purifier = new HTMLPurifier($config);
							$post_id2 = $purifier->purify($_GET['id']);
							$image_url = ' ';

							if(preg_match($testi, $post_id2)){							
								$data = array($image_url);
								$STH = $DBH->prepare("UPDATE simple_posts SET image_url = ? WHERE ID = '$post_id2' AND site_ID = '$site_id';");
								$STH->execute($data);
								header('Location: ./muokkaa.php?id='.$post_id2.'');
							} else {
								header('Location: ./artikkelit.php');	
							}
						}
					}
					
					$SQL = "SELECT * FROM simple_posts WHERE ID = '$post_id' AND site_ID = '$site_id';";
								
					$STH = @$DBH->query($SQL);
					$STH->setFetchMode(PDO::FETCH_OBJ);
					while($row = $STH->fetch()):
				 ?>
				  <form action="muokkaaArtikkeliUpload.php" method="post" enctype="multipart/form-data">
					<h3>Otsikko</h3>
					<input type="text" name="title" value="<?php echo $row->title; ?>" /><br/><br/>
					<h3>Teksti</h3>
					<textarea name="content" rows="10" cols="100"><?php echo $row->content; ?></textarea><br/>
					<h3>Artikkeleihin voi myös liittää halutessa kuvan</h3>
					<input type="file" name="image"/><br/>
					<input type="hidden" name="id" value="<?php echo $post_id; ?>" />
					<input type="submit" name="submit" value="Tallenna muutokset artikkeliin" />
				  </form><br/><br/>
				  <form action="<?php echo $_SERVER['PHP_SELF']; ?>">
				  	<input type="hidden" name="id" value="<?php echo $post_id; ?>" />
					<input type="submit" name="poista" value="Poista artikkelin kuva" />
				  </form>
				 <?php endwhile; else: header('Location: ./artikkelit.php'); endif; ?>
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
