<?php

$system=php_uname();
$system=explode(" ",$system);
$port=rand(9000,9999);

if($system[0]=="Windows"){
    system("cd public & php -S localhost:$port");
}else{
    system("cd public;php -S localhost:$port");
}