<?php

    // Confirm security question answer is not empty
    if(empty(trim($_POST["sec_answer"]))){
        $sec_answer_err = "Please enter an answer for your security question.";
    } else{
        $sec_answer = strtolower(trim($_POST["sec_answer"]));
    }

?>