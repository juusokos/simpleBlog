<?php
include_once 'db_connect.php';
include_once 'functions.php';
require_once 'library/HTMLPurifier.auto.php';
require_once 'uploadPHP.php';
require_once 'easyphpthumbnail.php';
 
sec_session_start();

if (login_check($mysqli) == true):

$site_id = htmlentities($_SESSION['site_id']);
$post_id = $_POST['id'];
$testi = '/^[0-9]{1,11}$/i';
if(preg_match($testi, $post_id)){

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
		$testi2 = '/^[A-Za-z0-9\s\W]{20,3000}$/i';

		if(preg_match($testi1, $title) && preg_match($testi2, $content)){
			$data = array($title, $image_url ,$content);
			$STH = $DBH->prepare("UPDATE simple_posts SET title = ?, image_url = ?, content = ? WHERE ID = '$post_id' AND site_ID = '$site_id';");
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
		$testi2 = '/^[A-Za-z0-9\s\W]{20,3000}$/i';

		if(preg_match($testi1, $title) && preg_match($testi2, $content)){
			$data = array($title, $content);
			$STH = $DBH->prepare("UPDATE simple_posts SET title = ?, content = ? WHERE ID = '$post_id' AND site_ID = '$site_id';");
			$STH->execute($data);
			header('Location: ./artikkelit.php');
		} else {
			header('Location: ./artikkelit.php');	
		}	
	} else {
		header('Location: ./artikkelit.php');
	}
}
} else {
	header('Location: ./artikkelit.php');
}
?>
<?php else: header('Location: ./login.php'); endif; ?>


