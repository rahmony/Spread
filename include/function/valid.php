<?php


// ####################### SET PHP ENVIRONMENT ###########################
define("VALID"   , "VALID"  , true) ;
define("FILTERE" , "FILTERE" , true) ;

define("DIGIT"   , "DIGIT" , true) ;
define("NUMRIC"  , "NUMRIC" , true) ;
define("STRING"  , "STRING" , true) ;
define("ENALPHA" , "ENALPHA" , true) ;
define("EMAIL"   , "EMAIL" , true) ;

define("ENALPHANUMRIC" , "ENALPHANUMRIC" , true) ;

define("MOBILE" , "MOBILE" , true) ;




// #######################################################################
// ######################## START MAIN SCRIPT ############################
// #######################################################################


/** This function is to check the empty of variables OR arrays
*/
function Check_Empty($Var)
{
    $Flaq = true ;
    
    // Check if the Var is array or NOT
    if(is_array($Var))
    {
        foreach($Var as $Value)
        {
            if(empty($Value) && '0' !== $Value)
            {
                $Flaq = false ;
                break ;
            }
        }
    }
    else
    {
        if(trim($Var) == "")
            $Flaq = false ;
    }
    
    return $Flaq ;
}






/** This function is to check the Zero Value of variables OR arrays
*/
function Check_Zero_Value($Var)
{
    $Flaq = true ;
    
    // Check if the Var is array or NOT
    if(is_array($Var))
    {
        foreach($Var as $Value)
        {
            if($Value != "0")
            {
                $Flaq = false ;
                break ;
            }
        }
    }
    else
    {
        if($Var != "0")
            $Flaq = false ;
    }
    
    return $Flaq ;
}



/** This function is to check the empty of Variables
*/
function Validate( $Method , $Type , $Var )
{
    /*
        STEP #1
        Check Empty  
    */
    if(!Check_Empty($Var))
    return false ; 
    
    
    /*
        STEP #2
        Trim The Variable 
    */ 
    if(!is_array($Var))
    $Var = trim($Var) ;
    //
    
    
    /*
        STEP #3
        Validate & Filtering The Variable 
    */
      
    if($Method == "VALID")
    {
        
        if($Type == "DIGIT")     // Just Numers
        {
            if(preg_match("/[^0-9]/i" , $Var))
                return true ;
        }
        if($Type == "NUMRIC")   // Just Numbers & "."
        {
            if(preg_match("/^-?(?:\d+|\d*\.\d+)$/",$Var))
                return true ;
        }
        if($Type == "STRING")    // Every thing ECPECT HTML and Specal Chatr
        {
            if(!preg_match("/<[^<]+>/",$Var))
                return true ;
        }
        if($Type == "ENALPHA")
        {
            //if(preg_match("/[A-Za-z]+/" , $Var))
            if(ctype_alpha($Var))
                return true ;
        }
        if($Type == "ENALPHANUMRIC")
        {
            //if(preg_match("/[a-z0-9]+/" , $Var))
            if(ctype_alnum($Var))
                return true ;
        }
        if($Type == "EMAIL")
        {
            if(preg_match("/^[\w-\._\+%]+@(?:[\w-]+\.)+[\w]{2,6}$/" , $Var))
                return true ;            
        }
        if($Type == "MOBILE")
        {
            if((strlen($Var)== 10) && (substr($Var,0,2) == "05"))
                return true ;
            if((strlen($Var)== 12) && (substr($Var,0,4) == "9665"))
                return true ;
            if((strlen($Var)== 14) && (substr($Var,0,6) == "009665"))
                return true ;
        }
    }
    
    else if ($Method == "FILTERE")
    {
        if($Type == "DIGIT")
        {
            return preg_replace('/[^0-9]/', "", $Var);  
        }
        if($Type == "NUMRIC")
        {
            return preg_replace('/[^.0-9]/i', "", $Var);            
        }
        if($Type == "STRING")
        {
            $Var = Escape($Var , "ENCODE") ;
            $Var = filter_var($Var , FILTER_SANITIZE_STRING , FILTER_FLAG_STRIP_LOW) ;
            $Var = nl2br($Var) ;
            return $Var ;
        }
        if($Type == "ENALPHA")
        {
            return preg_replace('/[^a-z]/i', "", $Var);
        }
        if($Type == "ENALPHANUMRIC")
        {
            return preg_replace("/[^\da-z]/i", "", $Var);
        }
        if($Type == "HTML")
        {
            $Search = array(
            '@<script[^>]*?>.*?</script>@si',   // Strip out javascript 
            '/<link\s.*?\/>/is',                // Strip out link tags
            '/<meta\s.*?\/>/is',                // Strip out meta tags
            /*'@<[\/\!]*?[^<>]*?>@si',          // Strip out HTML tags*/ 
            '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly 
            '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments including CDATA 
            ); 
            //$Var = filter_var($Var , FILTER_SANITIZE_MAGIC_QUOTES , FILTER_FLAG_STRIP_LOW) ;
            //$Var = Escape($Var , "ENCODE") ;
            $Var = preg_replace($Search, '', $Var); 
            //$Var = str_replace("'", "\'", $Var); 
            return $Var; 
        }
        if($Type == "TEXT")
        {
            $Var = strip_tags ($Var) ;
            return $Var ;
        }
        
        if($Type == "MOBILE")
        {
                 if(strlen($Var) == 10 AND substr($Var,0,2) == "05")      $Var = "966" . substr($Var , 1) ;
            else if(strlen($Var) == 9  AND substr($Var,0,1) != "0")       $Var = "966" . $Var  ;
            else if(strlen($Var) == 14 AND substr($Var,0,5) == "00966")   $Var = substr($Var , 2) ;
            else if(strlen($Var) == 13 AND substr($Var,0,4) == "9660")    $Var = "966" . substr($Var , 4) ;
            else if(strlen($Var) == 13 AND substr($Var,0,5) == "00965")   $Var = "966" . substr($Var , 4) ;
            else if(strlen($Var) == 12 AND substr($Var,0,3) == "996")     $Var = "966" . substr($Var , 3) ;
            else if(strlen($Var) == 15 AND substr($Var,0,6) == "006690")  $Var = "966" . substr($Var , 6) ;
            else if(strlen($Var) == 15 AND substr($Var,0,6) == "009660")  $Var = "966" . substr($Var , 6) ;
            
            return $Var ; 
        }
    }
    
    else
        return false ;
            
}



/** This function is to Escape the HTML Strings in Variables
*/
function Escape($Var , $Method)
{
    if($Method == "ENCODE")
    return @strtr($Var, array(
        "\0" => "",
        "'"  => "&#39;",
        "\"" => "&#34;",
        "\\" => "&#92;",
        
        // More Secure
        "<"  => "&lt;",
        ">"  => "&gt;"
    ));
    
    else if($Method == "DECODE")
    return html_entity_decode($Var) ;
}



/** This function is to Match the Variables
*/
function Match($Type , $Var)
{
    if($Type == "SUBMIT")
    {
        if($Var == "Submit")
        return true ;
    }


    return false ;
}


?>