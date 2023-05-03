<?php  

session_start();
  
require "config/autoload.php";  
  
$router = new Router();  
  
if(isset($_GET["path"]))  
{  
    $router->checkRoute($_GET["path"]);  
}  
else  
{  
    $router->checkRoute("");
}