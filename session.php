<?php

/* #######################################################################
*  ################### Session ###########################################
*/ #######################################################################


// Start the session
session_start();

if( !in_array( $_SESSION["Website_Lang"] , array("ar","en"))) {

    /*
     * Get the default user language
     */
    // Get the contents of the Accept-Language: header from the current request, if there is one
    $Lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    Switch ($Lang) {
        case "ar" :
            // Set Arabic language as  default language
            $_SESSION["Website_Lang"] = "ar";
            break;
        case "en" :
            // Set English language as  default language
            $_SESSION["Website_Lang"] = "en";
            break;
        default:
            // Set English language as  default language
            $_SESSION["Website_Lang"] = "en";
            break;
    }

}
else
    $_SESSION["Website_Lang"] = $_SESSION["Website_Lang"] ;



?>