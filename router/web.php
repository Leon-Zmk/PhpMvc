<?php



$uri=$_SERVER['REQUEST_URI'];
$parse=parse_url($uri);
$path=$parse['path'];

$routes=[

    "/"=>"ListController@index",
    "/create"=>"ListController@create",
    "/store"=>["POST","ListController@store"],
    "/delete"=>["DELETE","ListController@delete"],
    "/edit"=>"ListController@edit",
    "/update"=>["UPDATE","ListController@update"],
];

if(array_key_exists($path,$routes) && is_array($routes[$path]) && checkRouteMethod($routes[$path][0])){
    echo "YES";
    Controller($routes[$path][1]);
}
else if(array_key_exists($path,$routes) && !is_array($routes[$path])){
    Controller($routes[$path]);
   
}else{
    dd("There is no such route");
}
