<?php

function index(){

    $query="SELECT * FROM students WHERE 1 ORDER BY ID DESC";
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

function delete(){
    $id=$_POST['id'];
    $sql="DELETE FROM students WHERE id=$id";

    if(mysqli_query(con(),$sql)){
        return redirect(route("/"));
    }else{
        Echo "ERROR";
    }
}

function edit(){

    $id=$_GET['id'];
    $query="SELECT * FROM students WHERE id=$id";
    $sql=mysqli_query(con(),$query);
    $row=mysqli_fetch_assoc($sql);

    if(!$row){
        dd("There is No such student");
        return;
    }

    return view("list/edit",["student"=>$row]);

}