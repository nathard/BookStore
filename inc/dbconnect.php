<?php
  /* Set oracle user login and password info */
  $dbuser = "nlha";  /* your deakin login */
  $dbpass = "12345";  /* your deakin password */
  $dbname = "SSID"; 
  $db = OCILogon($dbuser, $dbpass, $dbname); 

  if (!$db)  {
    echo "An error occurred connecting to the database"; 
    exit; 
  }

?>