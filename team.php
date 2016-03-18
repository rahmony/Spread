<?php

// Report all errors except E_NOTICE
error_reporting(E_ALL & ~E_NOTICE);


include "include/function/function.php";
include "session.php";

$LangTerms = Set_Lang_Terms();

PrintTemplate("header" ,null);
PrintTemplate("navbar" , null);
PrintTemplate("team",null);
PrintTemplate("footer" , null);

?>