<?php
include_once 'db_connect.php';
include_once 'functions.php';
SSLon();
sec_session_start();


$site_id = htmlentities($_SESSION['site_id']);
$user_id = htmlentities($_SESSION['user_id']);
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
				  <li ></li>
				   <li><a href="blogisivu.php?id=<?php echo htmlentities($_SESSION['user_id']); ?>">Oma blogi</a></li>
					<li><a href="logout.php">Kirjaudu ulos</a></li>
					<li></li>
				  </ul>
				</div>
			  </div>
			</div>

			<div class="container-fluid">
			  <div class="row">
				<div class="col-sm-3 col-md-2 sidebar ">
				  <ul class="nav nav-sidebar">
					<p>Tervetuloa <?php echo htmlentities($_SESSION['username']); ?>!</p>
					<li><h3>Asetukset</h3></li>
					<li><a href="sivuAsetukset.php">Sivun tiedot</a></li>
					<li><a href="artikkelit.php">Artikkelit</a></li>
					<li class="active"><a href="ulkonako.php">Ulkonäkö</a></li>
					<HR> 
					<li class=""><a href="blogisivu.php?id=<?php echo htmlentities($_SESSION['user_id']); ?>">Oma Blogi &raquo;</a></li>
				  </ul>

				</div>
				<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

				  <h1 class="page-header">Ulkonäkö</h1>
				  	
					<?php
						//Muutokset tallennettu
						if (isset($_GET['submit'])==Hyvaksy) {
							echo '<p style="color:green">Muutokset tallennettu. <a href="./blogisivu.php?id='.$user_id.'">Katso Blogi</a></p>';
						}
						
					
						if(isset($_GET['submit'])){
							if(!empty($_GET['teema'])&& !empty($_GET['fontti'])){
								$data = array();
								$data['theme'] = $_GET['teema'];
								$data['font'] = $_GET['fontti'];
								
								$teema_testi = '/^[1-5]{1}$/i';
								$fontti_testi = '/^[1-4]{1}$/i';
								
								if(preg_match($teema_testi, $data['theme'])&&preg_match($fontti_testi, $data['font'])){
									$STH = $DBH->prepare("UPDATE simple_sites SET font_id = :font,
									theme_id = :theme WHERE ID = '$site_id';");
									$STH->execute($data);
								}else{
									header('Location: ulkonako.php');
								}
							}else{
								header('Location: ulkonako.php');
							}				
						}
					?>	
					<form action="<?php echo $_SERVER['PHP_SELF']; ?>">
						<h3 class="subtitle">Teema</h3>
						<input type='radio' name='teema' value='1' class="teemanapit" id="vaaleaTeema" required><label for="vaaleaTeema" >Vaalea</label><span> </span>
						<br/>
						<input type='radio' name='teema' value='2' class="teemanapit" id="tummanSininenTeema"/><label for="tummanSininenTeema" >Tummansininen</label> <span> </span>
						<br/>
						<input type='radio' name='teema' value='3' class="teemanapit" id="sunnyTeema"/><label for="sunnyTeema" >Aurinkoinen</label> <span> </span>

						<h3 class="subtitle">Fontti</h3>

						<ul class="list-group">
							<li class="list-group-item"><input type="radio" name="fontti" value="1" required ><span style="font-family: verdana; margin-left: 5px;">Verdana</span></li>
							<li class="list-group-item"><input type="radio" name="fontti" value="2"><span style="font-family: times, 'Times New Roman', serif; margin-left: 5px;">Times New Roman</span></li>
							<li class="list-group-item"><input type="radio" name="fontti" value="3"><span style="font-family: Georgia; margin-left: 5px;">Georgia</span></li>
							<li class="list-group-item"><input type="radio" name="fontti" value="4"><span style="font-family: 'Comic Sans MS', cursive, sans-serif; margin-left: 5px;">Comic Sans</span></li>
						</ul>

						<input type="submit" name="submit" class="btn btn-success" value="Hyvaksy"></input>
						<button class="btn">Peruuta</button>
					</form>


					
				</div>  <!-- div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" -->

			  </div>  <!-- div row -->


			</div>  <!-- div container-fluid -->

					<div class="dashboard-footer">
						<ul class="nav navbar-nav navbar-right" role="menu">
							<li><h3>Asetukset</h3></li>
							<li><a href="sivuAsetukset.php">Sivun tiedot</a></li>
							<li><a href="artikkelit.php">Artikkelit</a></li>
							<li class="active"><a href="ulkonako.php">Ulkonäkö</a></li>
						</ul>
					</div> <!-- div footer -->

			<!-- Bootstrap core JavaScript
			================================================== -->
			<!-- Placed at the end of the document so the pages load faster -->


			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


			 <script src="./js/bootstrap.js"></script>
			<script src="./js/docs.min.js"></script>
         <?php else : header('Location: ./login.php'); endif; ?>
		 <script>
	
		 </script>
    </body>
</html>
