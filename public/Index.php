<?php

require_once ("../Index.php");

$uri=$_SERVER['REQUEST_URI'];
$parse=parse_url($uri);
$path=$parse['path'];

switch($path){
    
    case "/";
    Controller("ListController@index");
    break;

    case "/create";
    Controller("ListController@create");
    break;

    case "/store";
    Controller("ListController@store");
    break;
}
