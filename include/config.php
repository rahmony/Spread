<?php
/*======================================================================*\
|| #################################################################### ||
|| # Management Plans Student Activity                  Version 3.2   # ||
|| # ---------------------------------------------------------------- # ||
|| # All PHP code in this file is ©2011-2016  Logic Technology Ltd.   # ||
|| # This file is not be redistributed in whole or significant part.  # ||
|| # ------------------ THIS IS NOT FREE SOFTWARE ------------------- # ||
|| # Abdulrhman Alshehry  966555516410  |   http://about.me/alshehry  # ||
|| #################################################################### ||
\*======================================================================*/

/*-------------------------------------------------------*\
| ****** NOTE REGARDING THE VARIABLES IN THIS FILE ****** |
+---------------------------------------------------------+
| If you get any errors while attempting to connect to    |
| MySQL, you will need to email your webhost because we   |
| cannot tell you the correct values for the variables    |
| in this file.                                           |
\*-------------------------------------------------------*/



// FUNCTION TO PROCESS THE SQL QUERY
// All SQL Query Have To Process Trhou This Function
function MyQuery($Query)
{
    global $MySQLi ;


    // ****** DATABASE NAME ******
    // This is the name of the database where system will be located.
    // This must be created by your webhost.
    
    $Config['Database']['dbname'] = 'rahmony_task';
    
    // ****** DATABASE SERVER NAME AND PORT ******
    // This is the hostname or IP address and port of the database server.
    // If you are unsure of what to put here, leave the default values.
    
    $Config['Database']['servername'] = 'rahmony.net';
    
    // ****** DATABASE USERNAME & PASSWORD ******
    // This is the username and password you use to access MySQL.
    // These must be obtained through your webhost.
    
    $Config['Database']['username'] = 'rahmony_admin';
    $Config['Database']['password'] = 'admin';


    // SET Variable
	$DB_Server   = $Config['Database']['servername'] ;
	$DB_Username = $Config['Database']['username'] ;
	$DB_Password = $Config['Database']['password'] ;
	$DB_Name     = $Config['Database']['dbname'] ;
	
    
    // Start Mysqli 
    $MySQLi = mysqli_connect("$DB_Server","$DB_Username","$DB_Password","$DB_Name");
    // $connection = mysql_connect($$DB_Server, $DB_Username, $DB_Password, $DB_Name);
    
    // Check connection 
    if(mysqli_connect_error())
    {
        printf("Connect ERROR ! %s\n",mysqli_connect_error());
        exit();
    }
	
    // Process The Query
    if(!empty($Query))
    {
        // Optmise The Data to be UST-8
        $MySQLi->query("SET CHARACTER SET utf8") ;
        $MySQLi->query("SET NAMES utf8") ;

        //print real_escape_string($Query) ;
    	//$MySQLi->real_escape_string($Query);
    	$Result = $MySQLi->query($Query);
    
        // Get & Return the Result
    	return $Result ;
    }
}

/*======================================================================*\
|| ####################################################################
|| # Downloaded: 20:19, Wed Mar 8th 2006
|| # CVS: $RCSfile: config.php.new,v $ - $Revision: 1.31.2.3 $
|| ####################################################################
\*======================================================================*/
?>