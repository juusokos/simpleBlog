<?php

include_once 'db_connect.php';
include_once 'functions.php';
 
sec_session_start();
if ( !empty($_GET['id']) ){
	$testi = '/^[0-9]{1,11}$/i';
	$user_id = $_GET['id'];
	
	if(preg_match($testi, $user_id)){
		$user_id = $_GET['id'];
		$SQL = "SELECT * FROM simple_sites
		INNER JOIN simple_themes ON simple_sites.theme_ID = simple_themes.ID
		INNER JOIN simple_banner ON simple_sites.ID = simple_banner.site_ID
		INNER JOIN simple_users ON simple_sites.user_ID = simple_users.ID
		WHERE simple_users.ID = '$user_id';";
	
		$STH = @$DBH->query($SQL);
		$STH->setFetchMode(PDO::FETCH_OBJ);
		
		if($STH->rowCount() != 0){
			$page = $STH->fetch();
		} else {
			header('Location: ./index.php');
		}				
	// INNER JOIN simple_posts ON simple_posts.site_ID = simple_sites.ID
	}else{
		header('Location: ./index.php');
	}	
} else {
	header('Location: ./index.php');
}

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>simpleBlog: <?php echo $page->blog_title; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo $page->theme_url; ?>" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<script src="js/jquery-2.0.3.min.js"></script>
	<script>
	$(function() {
		$(".blog-cover-image").css("background-image","url(<?php echo $page->banner_url ?>)");
	});
	</script>
  </head>

  <body>

    <div class="blog-masthead">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">SIMPLE BLOG</a>
        </div>
        <div class="collapse navbar-collapse navbar-right">
          <ul class="nav navbar-nav">
            <?php if (login_check($mysqli) == true) : ?>
			<li><a class="blog-nav-new" href="sivuAsetukset.php">Asetukset</a></li>
			<li><a class="blog-nav-login" href="logout.php">Kirjaudu ulos</a></li>
		  <?php else : ?>
			<li><a class="blog-nav-new" href="register.php">Luo blogi</a></li>
			<li><a class="blog-nav-login" href="login.php">Kirjaudu sisään</a></li>
		  <?php endif; ?>
          </ul>
        </div><!-- /.nav-collapse -->
      </div>
    </div>

    <div class="container container2">

	<div class="blog-cover-image"></div>
<div class="paddingfix">	
      <div class="blog-header">
	  
        <h1 class="blog-title"><?php echo $page->blog_title; ?></h1>
		<?php if(!empty($page->blog_description)):?>
        <p class="lead blog-description"><?php echo $page->blog_description; ?></p>
		<?php endif; ?>
      </div>

      <div class="row">

        <div class="col-sm-8 blog-main">
		  <?php
			
		  $SQL = "SELECT * FROM simple_posts
				INNER JOIN simple_sites ON simple_sites.ID = simple_posts.site_ID
				INNER JOIN simple_users ON simple_sites.user_ID = simple_users.ID
				WHERE simple_users.ID = '$user_id' ORDER BY date DESC";
			
          $STH = @$DBH->query($SQL);
          $STH->setFetchMode(PDO::FETCH_OBJ);
		  if($STH->rowCount() != 0):
			  while ($pages = $STH->fetch()):
			  
				$time = strtotime($pages->date);
				$formatedTime = date('d.m.Y',$time);
				
			  ?>
			  <div class="blog-post">
				<h2 class="blog-post-title"><?php echo $pages->title; ?></h2>
				<p class="blog-post-meta"><?php echo $formatedTime; ?> <?php echo $page->username; ?></p>
				<?php if(!empty($pages->image_url)):?>
				<img src="<?php echo $pages->image_url; ?>"></img>
				<?php endif; ?>
				<p><?php echo $pages->content; ?></p>
			  </div><!-- /.blog-post -->
		  <?php 
				endwhile; 
			else:
		  ?>
			<h2>Et ole kirjoittaut yhtäkään artikkelia! <a href="uusi.php">Kirjoita artikkeleja painamalla tätä linkkiä.</a></h2>
		  <?php endif; ?>
          <ul class="pager">
            <li><a href="#">Previous</a></li>
            <li><a href="#">Next</a></li>
          </ul>

        </div><!-- /.blog-main -->

        <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
          <div class="sidebar-module sidebar-module-inset">
            <h4>About</h4>
            <p><?php echo $page->about; ?></p>
          </div>
          <div class="sidebar-module">
            <h4>Archives</h4>
            <ol class="list-unstyled">
              <li><a href="#">January 2014</a></li>
              <li><a href="#">December 2013</a></li>
              <li><a href="#">November 2013</a></li>
              <li><a href="#">October 2013</a></li>
              <li><a href="#">September 2013</a></li>
              <li><a href="#">August 2013</a></li>
              <li><a href="#">July 2013</a></li>
              <li><a href="#">June 2013</a></li>
              <li><a href="#">May 2013</a></li>
              <li><a href="#">April 2013</a></li>
              <li><a href="#">March 2013</a></li>
              <li><a href="#">February 2013</a></li>
            </ol>
          </div>
          <div class="sidebar-module">
            <h4>Elsewhere</h4>
            <ol class="list-unstyled">
              <li><a href="#">GitHub</a></li>
              <li><a href="#">Twitter</a></li>
              <li><a href="#">Facebook</a></li>
            </ol>
          </div>
        </div><!-- /.blog-sidebar -->

      </div><!-- /.row -->
		</div><!-- /.paddingfix -->
    </div><!-- /.container -->

    <div class="blog-footer">
      <p>Blog template built for <a href="http://getbootstrap.com">Bootstrap</a> by <a href="https://twitter.com/mdo">@mdo</a>.</p>
      <p>
        <a href="#">Back to top</a>
      </p>
    </div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/docs.min.js"></script>
  </body>
</html>
