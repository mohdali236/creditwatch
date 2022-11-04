<?php

  // Validate message length
  if(empty(trim($_POST["message"]))){
      $message_err = $result = "Please enter message.";     
  } elseif(strlen(trim($_POST["message"])) > 500){
      $message_err = $result = "Message length too long. 500 character max.";
  } else{
      $message = trim($_POST["message"]);
  }


?>