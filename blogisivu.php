<?php

include_once 'db_connect.php';
include_once 'functions.php';
 
sec_session_start();
if ( !empty($_GET['id']) ){
	$SQL = "SELECT * FROM simple_sites
    INNER JOIN simple_themes ON simple_sites.theme_ID = simple_themes.ID
    INNER JOIN simple_posts ON simple_posts.site_ID = simple_sites.ID
	INNER JOIN simple_users ON simple_sites.user_ID = simple_users.ID
	WHERE simple_users.ID=".$_GET['id'].";";
	
	$STH = @$DBH->query($SQL);
	$STH->setFetchMode(PDO::FETCH_OBJ);
	$page = $STH->fetch();
	
} else {

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

    <title>Blog Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link id="pagestyle" href="css/blog.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<script type="text/javascript">
function swapStyleSheet(sheet){
document.getElementById('pagestyle').setAttribute('href', sheet);
}

</script>

  </head>

  <body>

    <div class="blog-masthead">
      <div class="container">
        <nav class="blog-nav">
          <a class="blog-nav-item active blog-nav-logo" href="#">SIMPLE BLOG</a>
			
		  <?php if (login_check($mysqli) == true) : ?>
			<a class="blog-nav-new" href="artikkelit.php">Asetukset</a>
			<a class="blog-nav-login" href="logout.php">Kirjaudu ulos</a>
		  <?php else : ?>
			<a class="blog-nav-new" href="register.php">Luo blogi</a>
			<a class="blog-nav-login" href="login.php">Kirjaudu sisään</a>
		  <?php endif; ?>
        </nav>
      </div>
    </div>

    <div class="container container2">

	<div class="blog-cover-image"></div>
<div class="paddingfix">	
      <div class="blog-header">
	  
        <h1 class="blog-title"><?php echo $page->blog_title; ?></h1>
        <p class="lead blog-description"><?php echo $page->blog_description; ?></p>
      </div>

      <div class="row">

        <div class="col-sm-8 blog-main">
		  <?php
			
		  $SQL = "SELECT * FROM simple_posts WHERE site_ID = ".$page->site_ID.";";
			
          $STH = @$DBH->query($SQL);
          $STH->setFetchMode(PDO::FETCH_OBJ);
		  while ($pages = $STH->fetch()):
			
		  ?>
          <div class="blog-post">
            <h2 class="blog-post-title"><?php echo $pages->title; ?></h2>
            <p class="blog-post-meta"><?php echo $pages->date; ?> <a href="#">Jacob</a></p>
			<img src="<?php echo $pages->image_url; ?>"></img>
            <p><?php echo $pages->content; ?></p>
          </div><!-- /.blog-post -->
		  <?php 
		  	endwhile; 
		  ?>
          

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
		<button onclick="swapStyleSheet('css/sini.css')"> Sininen</button>
		<button onclick="swapStyleSheet('css/blog.css')">Vihreä</button>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/docs.min.js"></script>
  </body>
</html>
