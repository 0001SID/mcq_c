<?php
    $username = "root";
    $password = "sql@9091";
    $host = "localhost";
    $database = "mcq_c";
try{
  $conn = new PDO("mysql:host=".$host.";dbname=".$database,$username,$password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $err){
  echo 'connection failed'.$err->getMessage();
}
?>