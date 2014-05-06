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
$user_id = htmlentities($_SESSION['user_id']);

if($_FILES['banner']['size'] != 0 ){

	// Banner upload							
    //Haetaan kuvatiedosto post methodista
   	$upload = Upload::factory('uploads');
   	$upload->file($_FILES['banner']);
   	//Määritetään tiedoston enimmäis koko megabitteinä
  	$upload->set_max_file_size(8.58);

	//Arrayhin lisätään ehdot (mime type), jotka se hyväksyy eli siis jpeg, png ja gif
    $upload->set_allowed_mime_types(array('image/jpeg', 'image/png', 'image/gif'));
    $results = $upload->upload();
	
	$banner_url = $results["full_path"];

	$thumb = new easyphpthumbnail;
	$thumb -> Thumblocation = 'thumb/';
	$thumb -> Thumbsize = 150;
	$thumb -> Createthumb($banner_url, 'file');
	
	$pikkukuva = $results["filename"];
	$thumb_url= 'thumb/'.$pikkukuva;
	if(!empty($_POST['blog_title']) && !empty($_POST['about'])){
							
		$config = HTMLPurifier_Config::createDefault();
		$purifier = new HTMLPurifier($config);
		$blog_title = $purifier->purify($_POST['blog_title']);
		$blog_description = $purifier->purify($_POST['blog_description']);
		$about = $purifier->purify($_POST['about']);
							
		$testi1 = '/^[A-Za-z0-9\s\W]{2,50}$/i';
		$testi2 = '/^[A-Za-z0-9\s\W]{0,500}$/i';
		$testi3 = '/^[A-Za-z0-9\s\W]{20,500}$/i';
							
		if(preg_match($testi1, $blog_title) && preg_match($testi2, $blog_description) && preg_match($testi3, $about)){
			$data = array($blog_title, $blog_description, $about);
			$STH = $DBH->prepare("UPDATE simple_sites SET blog_title = ?, blog_description = ?, about = ? WHERE ID = '$site_id';");
			$STH->execute($data);
			
			$data = array($banner_url, $thumb_url);
			$STH = $DBH->prepare("UPDATE simple_banner SET banner_url = ?, banner_url_thumb = ? WHERE site_ID = '$site_id';");
			$STH->execute($data);
			header('Location: ./sivuAsetukset.php?ok=ok');	
		} 	else {
			header('Location: ./sivuAsetukset.php');	
		}
	} else {
		header('Location: ./sivuAsetukset.php');
	}
	
} else {
	if(!empty($_POST['blog_title']) && !empty($_POST['about'])){
							
		$config = HTMLPurifier_Config::createDefault();
		$purifier = new HTMLPurifier($config);
		$blog_title = $purifier->purify($_POST['blog_title']);
		$blog_description = $purifier->purify($_POST['blog_description']);
		$about = $purifier->purify($_POST['about']);
							
		$testi1 = '/^[A-Za-z0-9\s\W]{2,50}$/i';
		$testi2 = '/^[A-Za-z0-9\s\W]{0,500}$/i';
		$testi3 = '/^[A-Za-z0-9\s\W]{20,500}$/i';
							
		if(preg_match($testi1, $blog_title) && preg_match($testi2, $blog_description) && preg_match($testi3, $about)){
			$data = array($blog_title, $blog_description, $about);
			$STH = $DBH->prepare("UPDATE simple_sites SET blog_title = ?, blog_description = ?, about = ? WHERE ID = '$site_id';");
			$STH->execute($data);
			
			header('Location: ./sivuAsetukset.php?ok=ok');
			//header('Location: ./blogisivu.php?id='.$user_id);
		} 	else {
			header('Location: ./sivuAsetukset.php');	
		}
	} else {
		header('Location: ./sivuAsetukset.php');
	}	
}
				
?>
<?php else : header('Location: ./login.php'); endif; ?>
