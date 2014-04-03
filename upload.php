<?php
require_once('funktiot.php');
require_once('db_connect.php');

// Luodaan uploads ja thumb kansio, jos ne on jo olemassa niin ilmoitetaan siitä eikä luoda uudestaan.
$upload = 'uploads';
$thumb = 'thumb';

if(!file_exists($upload)){
	mkdir('uploads', 0755);
	exit;
} else {
	echo '<script>console.log("Uploads kansio on jo luotu");</script>';
}

if(!file_exists($thumb)){
	mkdir('thumb', 0755);
	exit;
} else {
	echo '<script>console.log("Thumbs kansio on jo luotu");</script>';
}


//jos haluaa em. kansiot poistaa: rmdir.

// kuvan näyttö
if (!empty($_FILES['test'])) {
	
	//Haetaan kuvatiedosto post methodista
    $upload = Upload::factory('uploads');
    $upload->file($_FILES['test']);

    //Määritetään tiedoston enimmäis koko megabitteinä
    $upload->set_max_file_size(8.58);

	//Arrayhin lisätään ehdot (mime type), jotka se hyväksyy eli siis jpeg, png ja gif
    $upload->set_allowed_mime_types(array('image/jpeg', 'image/png', 'image/gif'));


    $results = $upload->upload();

	//kommentoin var_dumpin pois, mutta siinä olisi kaikki kuvasta luodut tiedot.
    //var_dump($results);
	
	//Haetaan $results arrayn rivi full_path jonka echoamalla imagetagin sisällä saadaan kuva näkyviin.
	
	$banneri = $results["full_path"];

	echo ("<br/><img src=\"$banneri\">");

	$thumb = new easyphpthumbnail;
	$thumb -> Thumblocation = 'thumb/';
	$thumb -> Thumbsize = 150;
	$thumb -> Createthumb($banneri, 'file');

	$pikkukuva = $results["filename"];
	
	echo ("<br/><img src=\"thumb/$pikkukuva\">");
	
	//LATAA kuva tietokantaan
	$data = array();
	$data['banner'] = $banneri;
	$data['thumb'] = $pikkukuva;
	$data['ID'] = 1;
	
	/*
	$SQL = "UPDATE simple_banner SET banner_url_thumb = ".$pikkukuva.",
					banner_url = ".$banneri." WHERE ID =:ID";
	
	$STH = $DBH->prepare(SQL);
	
 $STH->execute($data) */
 
 
$sql= "INSERT INTO `juusokos`.`simple_banner` 
	(`ID`, `banner_url`, `banner_url_thumb`)
	VALUES 
	(' ',
	'".$banneri."', 
	'".$pikkukuva."'
	);";
	
	$STH = $DBH->prepare($sql);
	
	$STH->execute($data);	

}
?>
