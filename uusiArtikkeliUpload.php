<?php
include_once 'db_connect.php';
include_once 'functions.php';
require_once 'library/HTMLPurifier.auto.php';
require_once 'uploadPHP.php';
require_once 'easyphpthumbnail.php';
SSLon();
sec_session_start();

if (login_check($mysqli) == true):

$site_id = htmlentities($_SESSION['site_id']);

if($_FILES['image']['size'] != 0 ){

	// Banner upload							
    //Haetaan kuvatiedosto post methodista
   	$upload = Upload::factory('uploads');
   	$upload->file($_FILES['image']);
   	//Määritetään tiedoston enimmäis koko megabitteinä
  	$upload->set_max_file_size(8.58);

	//Arrayhin lisätään ehdot (mime type), jotka se hyväksyy eli siis jpeg, png ja gif
    $upload->set_allowed_mime_types(array('image/jpeg', 'image/png', 'image/gif'));
    $results = $upload->upload();
	
	$image_url = $results["full_path"];

	$thumb = new easyphpthumbnail;
	$thumb -> Thumblocation = 'thumb/';
	$thumb -> Thumbsize = 150;
	$thumb -> Createthumb($image_url, 'file');
	
	$pikkukuva = $results["filename"];
	$thumb_url= 'thumb/'.$pikkukuva;
	
	if(!empty($_POST['title']) && !empty($_POST['content'])){
							
		$config = HTMLPurifier_Config::createDefault();
		$purifier = new HTMLPurifier($config);
		$title = $purifier->purify($_POST['title']);
		$content = $purifier->purify($_POST['content']);
							
		$testi1 = '/^[A-Za-z0-9\s\W]{2,50}$/i';
		$testi2 = '/^[A-Za-z0-9\s\W\/.,:<>_]{20,3000}$/i';

		if(preg_match($testi1, $title) && preg_match($testi2, $content)){
			$postDate = date("Y-m-d"); 
			$data = array($site_id, $title, $image_url ,$content, $postDate);
			$STH = $DBH->prepare("INSERT INTO simple_posts (site_ID, title, image_url, content, date) VALUES (?,?,?,?,?);");
			$STH->execute($data);
			header('Location: ./artikkelit.php');
		} else {
			header('Location: ./artikkelit.php');	
		}	
	} else {
		header('Location: ./artikkelit.php');
	}
	
} else {

	if(!empty($_POST['title']) && !empty($_POST['content'])){
							
		$config = HTMLPurifier_Config::createDefault();
		$purifier = new HTMLPurifier($config);
		$title = $purifier->purify($_POST['title']);
		$content = $purifier->purify($_POST['content']);
							
		$testi1 = '/^[A-Za-z0-9\s\W]{2,50}$/i';
		$testi2 = '/^[A-Za-z0-9\s\W\/.,:<>_]{20,3000}$/i';

		if(preg_match($testi1, $title) && preg_match($testi2, $content)){
			$postDate = date("Y-m-d"); 
			$data = array($site_id, $title, ' ' ,$content, $postDate);
			$STH = $DBH->prepare("INSERT INTO simple_posts (site_ID, title, image_url, content, date) VALUES (?,?,?,?,?);");
			$STH->execute($data);
			header('Location: ./artikkelit.php');
		} else {
			header('Location: ./artikkelit.php');	
		}	
	} else {
		header('Location: ./artikkelit.php');
	}
}
?>
 <?php else : header('Location: ./login.php'); endif; ?>
