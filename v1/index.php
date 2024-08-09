<?php

/* 
 * Developed by Ashfaaq Mahroof
 * GMA Printers
 * Main System Routing File
 */

//starting page session
session_start();

//loading page name and action
if(isset($_GET['page']) && !empty($_GET['page'])){
    $page = preg_replace("/[^A-Za-z0-9]+/", "", $_GET['page']);
}else{
    $page = "home"; //default
}
if(isset($_GET['action']) && !empty($_GET['action'])){
    $action = preg_replace("/[^A-Za-z0-9]+/", "", $_GET['action']);
}else{
    $action = "index"; //default
}
//debug only ***
//echo "Page is: ".$page."<br>Action is: ".$action;

//loading core files
include 'core/core_functions.php';
include 'core/configuration.php';

//loading the requested controller
$con_name = 'controllers/'.$page.'_controller.php';
if(file_exists($con_name)){
    include $con_name;
}else{
    include 'controllers/404_controller.php';
}


?>
