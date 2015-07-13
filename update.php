<?php
    //Including database class
    include_once './Db.php';
    
    //Creating object of database class
    $obj = new Db();
    
    //Defining array
    $in_data = [];
    
    //Assigning table name
    $table = 'department';
    
    //Assigning condition
    $condition = "department_id = '10' ";
    
    //Initializing column names and values to be inserted
    $in_data['department_name'] = 'accounts';
    $in_data['department_location'] = 'amritsar';
    $in_data['status'] = 'ACTIVE';
    
    //It will update all rows
    //if($obj->update($in_data, $table))
    
    //It will update selected rows according to condition
    if($obj->update($in_data, $table, $condition))
    {
        echo "Record Updated";
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
