<?php


function dd(mixed $data=null):void{
    echo "<pre style='background-color:black;padding:100px;color:white;'>";
    print_r($data);
    echo "</pre>";
}

function url(string $path):string{

    if(isset($_SERVER["HTTPS"])){
    $url="https";
    }
    else{
     $url="http";
    }

    $url .="://";
    $url .=$_SERVER['HTTP_HOST'];
    if($path){
        $url .= $path;
    }
    return $url;
}


function view(string $file,mixed $data = null):void{

    $data=$data;
    require_once(viewDir.$file.".view.php");

}

function Controller(string $control):void{
    $control=explode('@',$control);
    $file=$control[0];
    $function=$control[1];

    require_once(controllerDir.$file.".php");
    
    call_user_func($function);

}


function checkRouteMethod(string $method){

    $status=false;
    if($method=="POST" && $_SERVER["REQUEST_METHOD"]=="POST"){
         $status=true;
    }
    elseif($method=="PUT" && !empty($_POST['_method']) && $_POST['_method'] == "PUT" && $_SERVER["REQUEST_METHOD"] == "POST"){
         $status=true;
    }
    elseif($method=="DELETE" && !empty($_POST['_method']) && $_POST['_method'] == "DELETE" && $_SERVER["REQUEST_METHOD"] == "POST"){
         $status=true;
    }
    return $status;
}

function route(string $path, array $query =null):string{
    if($query){
        $url=url($path);
        $url .="?".http_build_query($query);
        return $url;
    }
    return url($path);
}

function redirect($url){
    header("location:$url");
}

