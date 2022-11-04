<?php

   // File upload form that allows only CSV files less than 20 MB

   if(isset($_FILES['csv'])){
      $result = '';
      $error = '';
      $file_name = $_FILES['csv']['name'];
      $file_size =$_FILES['csv']['size'];
      $file_tmp =$_FILES['csv']['tmp_name'];
      $file_type=$_FILES['csv']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['csv']['name'])));
      
      $extensions= array("csv");
      
      if(in_array($file_ext,$extensions)=== false){
         $error = "File extension not allowed, please select a CSV file.";
      }
      
      if($file_size > 20971520){
         $error ='File size must be smaller than 20 MB';
      }
      
      if(empty($error)==true){
         if (move_uploaded_file($file_tmp,"data/".$file_name)){
            $result = "Success";
         }else{
            $error = "Upload failed. Please try again later.";
         }
      }
   }

?>