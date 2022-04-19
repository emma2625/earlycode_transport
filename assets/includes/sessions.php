<?php 
    session_start();

    function errorMessage(){
        if (isset($_SESSION['errormessage'])) {
           $message = "<div class=\"alert text-center text-light fw-bold bg-danger\" role=\"alert\">";
           $message .= htmlentities($_SESSION['errormessage']);
           $message .= "</div>";

           $_SESSION['errormessage'] = null;
           return $message;
        }
    }

    function successMessage(){
        if (isset($_SESSION['successmessage'])) {
            $message = "<div class=\"alert text-center text-light fw-bold bg-success\" role=\"alert\">";
            $message .= htmlentities($_SESSION['successmessage']);
            $message .= "</div>";

            $_SESSION['successmessage'] = null;
            return $message;
         }
    }

