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
      
      // Verifies file is a CSV
      if(in_array($file_ext,$extensions)=== false){
         $error = "File extension not allowed, please select a CSV file.";
      }
      
      // Verfies file is less than 20MB
      if($file_size > 20971520){
         $error ='File size must be smaller than 20 MB';
      }
      
      if(empty($error)==true){
         if (move_uploaded_file($file_tmp,"data/transactions.csv")){

            // Generate notification for successful processing of transaction data
            $notfication_username = $_SESSION['username'];
            $notfication_message = "Transaction data uploaded for processing at " . date("F j, Y, g:i a") . ".";
            require_once "generatenotification.php";
                        
            // Process transactions CSV file with fraudDetect
            require_once "data/exec-fraud.php";

            $result = "Transactions processed succesfully.";
         
         }else{
            
            $error = "Upload failed. Please try again later.";
         
         }
      }
   }

?>