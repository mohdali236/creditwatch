<?php

    // Validate security question and answer input
    if(empty(trim($_POST["sec_question"]))){
        $sec_question_err = "Please enter an security question of your choice.";
    } elseif(empty(trim($_POST["sec_answer"]))){
        $sec_answer_err = "Please provide an answer for your security question.";
    } else{
        $sec_question = trim($_POST["sec_question"]);
        $sec_answer = strtolower(trim($_POST["sec_answer"]));
    }

?>