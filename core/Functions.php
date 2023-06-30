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

function route($path):string{
    return url($path);
}

function redirect($url){
    header("location:$url");
}