<?php 

try{  // another method to try the exception

    //host
    if (!defined('HOSTNAME')) define("HOSTNAME", "localhost");

    //DBNAME
    if (!defined('DBNAME')) define("DBNAME", "estate");

    //user
    if (!defined('USER')) define("USER", "root");

    //pass
    if (!defined('PASS')) define ("PASS", ''); //makes sure all credential defined if not defined



    $conn = new PDO("mysql:host=" .HOSTNAME."; dbname=" .DBNAME.";", USER, PASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //release exception when any wrong in credentials


}   catch(PDOException $e)
    {
        die("Database connection failed: " . $e->getMessage());
    }

    // //check connection of database
    // if($conn == true){
    //     echo "Db connected";
    // }else{
    //     echo "error";
    // }


?>