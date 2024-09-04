<?php

    define("HOSTNAME","127.0.0.1");
    define("USERNAME","root");
    define("PASSWORD","");
    define("DATABASE","studentDB");
   
    
    // Create connection
    $connection =mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DATABASE);
    
    // Check connection
    if (!$connection) {
        die("Connection failed ");
    }else{
      //  echo "YESS";
    }

    
 ?>