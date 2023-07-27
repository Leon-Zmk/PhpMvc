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
    elseif($method=="UPDATE" && !empty($_POST['_method']) && $_POST['_method'] == "UPDATE" && $_SERVER["REQUEST_METHOD"] == "POST"){
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

function run(string $query, bool $con=false):bool|object{

    $sql=mysqli_query(con(),$query);
    $con == true ? mysqli_close(con()):"";

    return $sql;

}

function redirect($url):void{
    header("location:$url");
}

function sessionStart():void{
    session_start();
}

function sessionSet(string $message,string $key= "message" ):void{
     $_SESSION[$key]=$message;
}

function getSession(string $key):string{
    $message=$_SESSION["$key"];
    session_unset();
    return $message;
}

function showSession(string $key="message"){
    if(!empty($_SESSION["$key"])){
        return alert(getSession($key));
    }
}


function alert(string $message, string $color="success"):string{
    return "
    <div class='alert my-4 alert-$color' role='alert'>
           $message
    </div>
        ";
}

function pagination(string $query):array{
    
    $total=first(str_replace("*","COUNT(*) AS total",$query))['total'];
    $limit=50;
    $toatlpage= $total / $limit;
    $currentPage= isset($_GET['p']) ? $_GET['p'] : 1;
    $offset= ($currentPage - 1) * $limit;
    $query .= " LIMIT $offset,$limit";

    $rows=all($query);

    $links=[];

    for($i=1; $i <= $toatlpage ; $i++){

        $queries=$_GET;
        $queries['p'] = $i;
        $url=url($GLOBALS['path'])."?".http_build_query($queries);

        $links[]=[
            "link"=>$url,
            "is_active"=>$currentPage == $i? "active":"",
            "page_number"=>$i
        ];
    }

    $data=[
        "total" => $total,
        "limit" => $limit,
        "toalpage" => $toatlpage,
        "currentPage" => $currentPage,
        "links" => $links,
        "students" => $rows
    ];
    return $data;
}

function paginator(array $data){
   
    $li= "";

    foreach($data['links'] as $link){
       $li .= "<li class='page-item {$link["is_active"]}'><a href='{$link["link"]}' class='page-link'>{$link['page_number']}</a></li>";
    }
   
   return "
   
   <nav class='page navigation example'>
   <ul class='pagination'>
      .$li.
   </ul>
  
   </nav>
   
   ";
}

function logger(string $message , int $color=32):void{
    echo "\e[39m[LOG]"."\e[{$color}m".$message;
}

function createTable(string $name,...$columns){


 $sql= "CREATE TABLE `$name` (
    `id` mediumint(8) UNSIGNED NOT NULL,
    ".join(",",$columns).",
    `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
    `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

 
   if(run($sql)){
    logger("$name Table Created Successfully");
   }
   
}