<?php 
include_once 'funktiot/db_connect.php';
include_once 'funktiot/funktiot.php';
 
	sec_session_start();	

		$SQL = "SELECT * FROM simple_sites INNER JOIN simple_users ON simple_sites.user_ID = simple_users.ID LIMIT 0, 6";

			$STH = @$DBH->query($SQL);
			$STH->setFetchMode(PDO::FETCH_OBJ);
			
			
			//$page = $STH->fetch();

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

    <title>SIMPLE BLOG</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/offcanvas.css" rel="stylesheet">
	  <link href="css/dashboard.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <div class="navbar navbar-fixed-top navbar-inverse" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Klik</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">SIMPLE BLOG</a>
        </div>
        <div class="collapse navbar-collapse navbar-right">
          <ul class="nav navbar-nav">
              <?php if (login_check($mysqli) == true) : ?>
			<li><a href="blogisivu.php?id=<?php echo htmlentities($_SESSION['user_id']); ?>">Oma blogi</a></li>
			<li><a class="blog-nav-new" href="artikkelit.php">Asetukset</a></li>
			<li><a class="blog-nav-login" href="logout.php">Kirjaudu ulos</a></li>
		  <?php else : ?>
			<li><a class="blog-nav-new" href="register.php">Luo blogi</a></li>
			<li><a class="blog-nav-login" href="login.php">Kirjaudu sisään</a></li>
		  <?php endif; ?>
          </ul>
        </div><!-- /.nav-collapse -->
      </div><!-- /.container -->
    </div><!-- /.navbar -->

    <div class="container">

      <div class="row row-offcanvas row-offcanvas-right">

        <div class="col-xs-12 col-sm-9">
          <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Valikko</button>
          </p>
          <div class="jumbotron">
            <h1>Hei, sinä!</h1>
            <p> Luo uusi blogi tai lue muiden blogeja</p>
			<a href="register.php" class="btn btn-success"> Luo uusi blogi </a>
			<a href="login.php" class="btn btn-default"> Kirjaudu sisään </a>
		
          </div>
          <div class="row">
		  <h1>Uusimmat blogit:</h1>
		  <?php while($row = $STH->fetch()): ?>
            <div class="col-6 col-sm-6  blogit">
			 <h2><?php echo $row->blog_title; ?></h2>
			 <p><i><?php echo $row->blog_description; ?></i></p> <br/>
              <p><?php echo $row->about; ?></p>
              <a class="btn btn-info " href="blogisivu.php?id=<?php echo $row->user_ID  ?>" role="button">Katso blogi &raquo;</a>
            </div><!--/span-->
			<?php endwhile; ?>
          </div><!--/row-->
		  <a href="blogilista.php" class="text-right">Kaikki Blogit &raquo;</a>
          
        </div><!--/span-->
		

        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
          <div class="list-group">
            <a href="index.php" class="list-group-item active">Etusivu</a>
			 <a href="blogilista.php" class="list-group-item ">Blogilistaus</a>
			
          </div>
        </div><!--/span-->
      </div><!--/row-->

      <hr>

      <footer>
        <p>&copy; Simple Blog 2014</p>
      </footer>

    </div><!--/.container-->



    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/offcanvas.js"></script>
  </body>
</html>

