<?php

function index(){

    $query="SELECT * FROM students where 1";
    $sql=mysqli_query(con(),$query);
    $rows=[];

    while($row=mysqli_fetch_assoc($sql)){
        $rows[]=$row;
    }

    return view('list/index',["students"=>$rows]);
}

function create(){
    return view("list/create");
}

function store(){
        $name=$_POST['name'];
        $gender=$_POST['gender'];
        $class=$_POST['class'];
        $nation=$_POST['nation'];

        $sql="INSERT INTO students (name,gender,class,nation_short) VALUES ('$name','$gender','$class','$nation')";
        echo $sql;
        $insertstatus=mysqli_query(con(),$sql);
        redirect(route("/"));  
}