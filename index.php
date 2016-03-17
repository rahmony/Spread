<?php

include "include/function/function.php";
include "session.php";


$LangTerms = Set_Lang_Terms();

PrintTemplate("header" ,null);
PrintTemplate("navbar" , null);
PrintTemplate("index",null);
PrintTemplate("footer" , null);

?>