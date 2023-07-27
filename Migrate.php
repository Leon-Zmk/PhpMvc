<?php

require_once "./core/Connection.php";
require_once "./core/Functions.php";

$query="SHOW  TABLES";
$sql=run($query);
$rows=[];

while($row=mysqli_fetch_assoc($sql)){
    $rows[]=$row;
}

foreach ($rows as $key => $row) {
   $query="DROP TABLE IF EXISTS ".$row['Tables_in_myschool'];
   if(run($query)){
    logger("TABLES DROPPED SUCCESSFULLY");
   }
}

print_r($rows);

createTable("studets","name varchar(255) DEFAULT NULL","nation_short varchar(50) DEFAULT NULL","date_of_birth datetime DEFAULT NULL","gender varchar(255) DEFAULT NULL","class varchar(255) DEFAULT NULL","weight varchar(100) DEFAULT NULL");


