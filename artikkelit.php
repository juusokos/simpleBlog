
<?php

include_once 'db_connect.php';
include_once 'functions.php';
 
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
					<li class="active"><a href="artikkelit.html">Artikkelit</a></li>
					<li><a href="ulkonako.php">Ulkonäkö</a></li>
					<li><a href="#">Kuvat ja videot</a></li>
					 
				  </ul>
				  
			
				</div>
				<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
				  <h1 class="page-header">Artikkelit <button class="btn btn-success">Kirjoita uusi</button></h1>

				
				 
				   
				  <div class="table-responsive">
					<table class="table table-striped">
					  <thead>
						<tr>
						  <th>Otsikko</th>
						  <th>Päivämäärä</th>
						  <th>Toiminnot</th>
						  <th></th>
						  <th>Kategoria</th>
						</tr>
					  </thead>
					  <tbody>
						<tr>
						  <td>Lorem</td>
							<td>30.03.2014</td>
						   <td><a href="#">Muokkaa</a></td>
						  <td><a href="#">Poista</a></td>
						  <td><a href="#">ipsum</a></td>
						</tr>
						 <tr>
						  <td>ipsum</td>
						  <td>15.03.2014</td>
						   <td><a href="#">Muokkaa</a></td>
						  <td><a href="#">Poista</a></td>
						  <td><a href="#">ipsum</a></td>
						</tr>
						 <tr>
						  <td>dolore</td>
						   <td>01.03.2014</td>
						   <td><a href="#">Muokkaa</a></td>
						  <td><a href="#">Poista</a></td>
						   <td><a href="#">ipsum</a></td>
						</tr>
					  </tbody>
					</table>
				  </div>
				</div>
			  </div>
			</div>
					<div class="dashboard-footer">
						<ul class="nav navbar-nav navbar-right" role="menu">
							<li><h3>Asetukset</h3></li>
							<li><a href="artikkelit.html">Artikkelit</a></li>
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
