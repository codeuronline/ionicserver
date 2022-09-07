<?php 
function check_image_mime($tmpname){
	$finfo = finfo_open(FILEINFO_MIME_TYPE);
	$mtype = finfo_file($finfo, $tmpname);

   //error_log($mtype);
   
	if(strpos($mtype, 'image/') === 0){
		return true;
	} else {
		return false;
	}
	finfo_close($finfo);
}

error_log(print_r($_FILES),1);
if(isset($_FILES['photo']['name'])){
   // file name
   // Valid extensions
   $valid_ext = array("gif","jpg","png","jpeg","webp","jfif");
   $filename = $_POST['id'];
   // Location
   // necessite de recupere son vrai nom
   $location = 'upload/'.$filename;

   // file extension
   $file_extension = pathinfo($location, PATHINFO_EXTENSION);
   $file_extension = strtolower($file_extension);

   $response = 0;
   if(in_array($file_extension,$valid_ext)){
      if(check_image_mime($_FILES['photo']['tmp_name'])==true){
   // if(in_array(mime_content_type($file_extension),$valid_ext)){
   // Upload file
   error_log($location);
      if(move_uploaded_file($_FILES['photo']['tmp_name'],$location)){
         $response = 1;
      } 
   }
}
   echo $response;
   exit;
}