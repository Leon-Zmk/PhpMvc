<?php


function con(){

    $con=mysqli_connect("localhost","root","","myschool");
    return $con;

}

con();