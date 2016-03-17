<?php

/* #######################################################################
*  ################### Main Function OF Languages and Print ##############
*/ #######################################################################




/** Get the default user language
*/
Function Set_Lang_Terms ()
{
    // Get Function Arguments
    $FunArgs = func_get_args();

    // set language file
    $LangFile = "include/lang/" . $_SESSION["Website_Lang"]  . ".lang";
    
    // Get Language Translation File
    $LangFile = explode("\n", file_get_contents($LangFile));
    
    // Define LangTerms variable
    $LangTerms = array();

  // Looping to all Language Terms File
    foreach ($LangFile as $Term) {
    if (!empty($Term)) {
        $LangArray = explode("<;>" , $Term) ;

		// Check if the Array Key is NOT empty (ex: First Line)
		if (!empty($LangArray[0]))
            $LangTerms["[" . @trim($LangArray[0]) . "]"] = @trim($LangArray[1]);
	}

}
    // return Final Terms Array
    return $LangTerms ;
}


/** Print Template
*/
function PrintTemplate()
{
    // Get Function Arguments
    $FunArgs = func_get_args();

    // Get $LangTerms
    global $LangTerms ;

    // Get File Name Template , It will be the first argument
    $FileTemplate = file_get_contents("template/" . strtolower(strtolower($FunArgs[0])) . ".html") ;

    // Convert CustomTerms to array
    $CustomTerms = (array)$FunArgs[1];

    // Replace the Language Terms inside CustomTerms
    $CustomTerms = str_replace(array_keys($LangTerms) , array_values($LangTerms) , $CustomTerms) ;

    // Merge array
    $LangTerms = array_merge($LangTerms , $CustomTerms) ;

    // Replace the Language Terms
    $FileTemplate = str_replace(array_keys($LangTerms) , array_values($LangTerms) , $FileTemplate) ;

    // Print out the template
    print $FileTemplate ;

}



/** Print Message Bar
*/
Function PrintMessageBar()
{

    // Get Function Arguments
    $FunArgs = func_get_args();

    // Set Page of Message
    $MessagesFile = "template/message.html" ;

    // Get LangTerms
    global $LangTerms ;
    
    if(in_array( $FunArgs[0] , array("success", "warning", "danger")))
    $LangTerms["[MessageType]"] = $FunArgs[0] ;
    else
    $LangTerms["[MessageType]"] = null ;



    // replace [MessageBar]
    $LangTerms["[MessageBar]"] .= str_replace(array_keys($LangTerms) , array_values($LangTerms) , str_replace("[Message]" , "[".$FunArgs[1]."]" , file_get_contents($MessagesFile))) ;
    
    
    return  ;


}

/** This function is check the valid of password
 */
function CheckValidPassword($Password)
{

    // the pattern of password
    // more than 8 less than 25 , at least one upper case and one lower case and one numeric
    $Pattern = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,25}$/';


    if (preg_match($Pattern, $Password))
        return true;
     else
        return false;


}


/** Get Salt
 */
Function GetSalt () {
    // created salt encryption
    return "RaHmOnY6Smf%nY$@2586faWaz";
}


// Function that encrypt the password
Function Encrypting ($EmployeeID , $Password){


    $NewPassword = md5($Password); // md5 is a ready encryption function
    $Salt = $EmployeeID . GetSalt();
    $FinalPassword1 = md5($Salt,$NewPassword); // another mde encryption to the encrypted ^.*

    // Return the value of the final encrypted password !
    return $FinalPassword1;
}


/** Function check if password correct or not
 */
Function IsPassword ($EmployeeID , $Password) {

    $NewPassword = md5($Password);// md5 is a ready encryption function
    $Salt = $EmployeeID . GetSalt();
    $FinalPassword = md5($Salt,$NewPassword); // another mde encryption to the encrypted ^.*

    $Query = MyQuery("SELECT `Password`  FROM employee WHERE `EmployeeID` = $EmployeeID ");
    if ($FinalPassword == $Query){
        // return true if the decrypted password equals the select of the database
        return true;
    }
    else  return  false ;
}


?>