<?php

function index(){

    $query="SELECT * FROM students  ";
     

     if(!empty($_GET['q'])){
        $q=$_GET['q'];
        $query .= " WHERE LOWER(name) LIKE '%$q%' ";
     }
    

    $total=first(str_replace("*","COUNT(*) AS total",$query))['total'];
    $limit=10;
    $toatlpage= $total / $limit;
    $currentPage= isset($_GET['p']) ? $_GET['p'] : 1;
    $offset= ($currentPage - 1) * $limit;
    $query .= " LIMIT $offset,$limit";

    $rows=all($query);

    $links=[];

    for($i=1; $i <= $toatlpage ; $i++){

        $links[]=[
            "links"=>url($GLOBALS['path'])."?p=$i",
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
        return redirect(route("/"));
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