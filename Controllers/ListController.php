<?php

function index(){

    $query="SELECT * FROM students  ";
     

     if(!empty($_GET['q'])){
        $q=$_GET['q'];
        $query .= " WHERE LOWER(name) LIKE '%$q%' ";
     }
    

     $data=pagination($query);
    return view('list/index',$data);
}

function create(){
    return view("list/create");
}

function store(){
        $name=$_POST['name'];
        $gender=$_POST['gender'];
        $class=$_POST['class'];
        $nation=$_POST['nation'];
        $query="INSERT INTO students (name,gender,class,nation_short) VALUES ('$name','$gender','$class','$nation')";
        $insertstatus=run($query);
        sessionSet("Student Add Successfully");
        redirect(route("/"));  
}

function delete(){
    $id=$_POST['id'];
    $sql="DELETE FROM students WHERE id=$id";

    if(mysqli_query(con(),$sql)){
        sessionSet("Student Delete Successfully");
        return redirect($_SERVER['HTTP_REFERER']);
       
    }else{
        Echo "ERROR";
    }
}

function edit(){

    $id=$_GET['id'];
    $query="SELECT * FROM students WHERE id=$id";
    $row=first($query);
    if(!$row){
        dd("There is No such student");
        return;
    }

    return view("list/edit",["student"=>$row]);

}

function update(){
    $name=$_POST['name'];
    $gender=$_POST['gender'];
    $class=$_POST['class'];
    $nation=$_POST['nation'];
    $query="UPDATE  students SET name='$name',gender='$gender',class='$class',nation_short='$nation'";
    $insertstatus=run($query);
    sessionSet("Student Updated Successfully");
    redirect(route("/"));  
}

function all(string $query):array{
    $sql=run($query);
    $rows=[];

    while($row=mysqli_fetch_assoc($sql)){
        $rows[]=$row;
    }
    return $rows;

}

function first(string $query):array{
    $sql=run($query);
    $row=mysqli_fetch_assoc($sql);

    return $row;
}

