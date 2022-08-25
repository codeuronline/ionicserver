<?php 
error_log(print_r($_FILES),1);
if(isset($_FILES['photo']['name'])){
   // file name
   
   $filename = $_POST['id'];
   // Location
   // necessite de recupere son vrai nom
   $location = 'upload/'.$filename;

   // file extension
   $file_extension = pathinfo($location, PATHINFO_EXTENSION);
   $file_extension = strtolower($file_extension);

   // Valid extensions
   $valid_ext = array("gif","jpg","png","jpeg");

   $response = 0;
   if(in_array(mime_content_type($file_extension),$valid_ext)){
      // Upload file
      if(move_uploaded_file($_FILES['photo']['tmp_name'],$location)){
         $response = 1;
      } 
   }

   echo $response;
   exit;
}
?>