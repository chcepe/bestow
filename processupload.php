<?php
define('IN_BLOG', true);
include($_SERVER["DOCUMENT_ROOT"].'/includes/functions.php');
header('Content-Type: application/json');

if(isset($_POST) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' && (isset($_FILES['background_file']) || isset($_FILES['thumbnail_file']) || isset($_FILES['answer_image']) || isset($_FILES['logo']) || isset($_FILES['fav']) || isset($_FILES['thumbnail'])) && isset($_GET['key']) && isset($_GET['type'])){
	if($_GET['type']=="thumb" || $_GET['type']=="bg" || $_GET['type']=="result" || $_GET['type']=="thumbnail"){
		$imgWidth = 630;
		$imgHeight = 330;
	}else if($_GET['type']=="crop"){
		$imgWidth = 300;
		$imgHeight = 300;
	}else if($_GET['type']=="logo"){
		//$imgWidth = 390;
		//$imgHeight = 55;
		$filename = $_FILES['logo']['tmp_name'];
		list($imgWidth, $imgHeight) = getimagesize($filename);
	}else if($_GET['type']=="fav"){
		$imgWidth = 16;
		$imgHeight = 16;
	}
	$source = @imagecreatetruecolor($imgWidth, $imgHeight);
	if(isset($_FILES['thumbnail_file'])){
		$filename = "thumb_".$_GET['key'];
		$img = $_FILES['thumbnail_file']['tmp_name'];
		$mime = pathinfo($_FILES['thumbnail_file']['name'], PATHINFO_EXTENSION);
	}elseif(isset($_FILES['background_file'])){
		$filename = "bg_".$_GET['key'];
		$img = $_FILES['background_file']['tmp_name'];
		$mime = pathinfo($_FILES['background_file']['name'], PATHINFO_EXTENSION);
	}elseif(isset($_FILES['logo'])){
		$filename = "logo";
		$img = $_FILES['logo']['tmp_name'];
		$mime = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
	}elseif(isset($_FILES['fav'])){
		$filename = "fav";
		$img = $_FILES['fav']['tmp_name'];
		$mime = pathinfo($_FILES['fav']['name'], PATHINFO_EXTENSION);
	}elseif(isset($_FILES['thumbnail'])){
		$filename = "thumbnail";
		$img = $_FILES['thumbnail']['tmp_name'];
		$mime = pathinfo($_FILES['thumbnail']['name'], PATHINFO_EXTENSION);
	}elseif(isset($_FILES['answer_image'])){
		$filename = "ans_". $_GET['key']."_".pathinfo($_FILES['answer_image']['name'], PATHINFO_FILENAME);
		if($_GET['type']=="result"){
			$filename = "ans_". $_GET['key']."_".pathinfo($_FILES['answer_image']['name'], PATHINFO_FILENAME);
		}else if($_GET['type']=="crop"){
			$filename = "ans_". $_GET['key']."_".pathinfo($_FILES['answer_image']['name'], PATHINFO_FILENAME);
		}
		$img = $_FILES['answer_image']['tmp_name'];
		$mime = pathinfo($_FILES['answer_image']['name'], PATHINFO_EXTENSION);
	}

	$regex = "((https?|ftp)\:\/\/)?"; // SCHEME 
	$regex .= "([a-z0-9+!*(),;?&=\$_.-]+(\:[a-z0-9+!*(),;?&=\$_.-]+)?@)?"; // User and Pass 
	$regex .= "([a-z0-9-.]*)\.([a-z]{2,3})"; // Host or IP 
	$regex .= "(\:[0-9]{2,5})?"; // Port 
	$regex .= "(\/([a-z0-9+\$_-]\.?)+)*\/?"; // Path 
	$regex .= "(\?[a-z+&\$_.-][a-z0-9;:@&%=+\/\$_.-]*)?"; // GET Query 
	$regex .= "(#[a-z_.-][a-z0-9+\$_.-]*)?"; // Anchor 

	if(preg_match("/^$regex$/", $img)) { 
		   $img = redirected($img);
	} 

	switch($mime){
			case 'gif':
				$image = imagecreatefromgif($img);
				break;
	 
			case 'png':
				$image = imagecreatefrompng($img);
				break;
	 
			case 'jpg':
				$image = imagecreatefromjpeg($img);
				break;
			default:
				return false;
				break;
	}

	list($width, $height, $type) = GetImageSize($img);
	$bigImage = array($imgWidth, $imgHeight);
	$source_aspect_ratio = $width / $height;
	$big_aspect_ratio = $bigImage[0] / $bigImage[1];
	if( $source_aspect_ratio > $big_aspect_ratio ){
			$temp_height = $bigImage[1];
			$temp_width = ( int ) ( $bigImage[1] * $source_aspect_ratio );
	} else {
			$temp_width = $bigImage[0];
			$temp_height = ( int ) ( $bigImage[0] / $source_aspect_ratio );
	}
	$temp_img = imagecreatetruecolor($temp_width, $temp_height);
	imagealphablending($temp_img, false);
	imagesavealpha($temp_img, true);
	imagecopyresampled($temp_img, $image, 0, 0, 0, 0, $temp_width, $temp_height, $width, $height);
	 
	$bx0 = ($temp_width - $bigImage[0]) / 2;
	$by0 = ($temp_height - $bigImage[1]) / 2;
	 
	$desired = imagecreatetruecolor($bigImage[0], $bigImage[1]);
	imagealphablending($source, false);
	imagesavealpha($source, true);
	imagecopy($source, $temp_img, 0, 0, $bx0, $by0, $bigImage[0], $bigImage[1]);

	if($_GET['type']=="logo" || $_GET['type']=="fav"){
		$directory = "images/".$filename.".png";
		imagepng($source,"../".$directory);
	}else if($_GET['type']=="thumbnail"){
		$directory = "images/".$filename.".png";
		imagepng($source,"../".$directory);
	}else{
		$directory = "temp/".$filename.".jpg";
		imagejpeg($source,"../".$directory,100);
	}
	imagedestroy($source);

	if (file_exists("../".$directory)) {
		$response = array('success' => true, 'img' => $_SERVER['SERVER_NAME']."/".$directory);
		echo json_encode($response);
	} else {
		$response = array('success' => false, 'msg' => "Image not saved.");
		echo json_encode($response);
	}
}else{
	$response = array('success' => false, 'msg' => "Method \"GET\" is not allowed");
	echo json_encode($response);
}
?>