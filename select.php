<?php
    //Including database class
    include_once './Db.php';
    
    //Creating object of database class
    $obj = new Db();
    
    //Defining array
    $in_data = [];
    $out_data = [];
    
    //Assigning table name
    $table = 'department';
    
    //Assigning condition
    $condition1 = "department_id = '10' ";
    $condition2 = "status = 'ACTIVE' ";
    
    //Initializing column names and values to be inserted
    $in_data[] = 'department_id';
    $in_data[] = 'department_name';
    $in_data[] = 'department_location';
    
    //It will select all rows without any condition
    //if($out_data = $obj->select($in_data, $table))
    
    //It will select a row according to condition
    //if($out_data = $obj->select($in_data, $table, $condition1))
    
    //It will select multiple rows according to condition
    if($out_data = $obj->select($in_data, $table, $condition2))
    {
        echo "<pre>";
        print_r($out_data);
        echo "</pre>";
    }
    else
    {
        echo 'Error<br>';
        echo mysql_error();
    }
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        ?>
    </body>
</html>
