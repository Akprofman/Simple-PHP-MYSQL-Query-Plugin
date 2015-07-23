<?php
    include_once './helper.php';
    
    $data = [];
    
    $data['host_name'] = 'localhost';
    $data['user_name'] = 'root';
    $data['password'] = '';
    $data['database_name'] = 'dr';
    
    $obj = new helper($data);
    
    $in_data = [];
    $in_data['department_name'] = "num's";
    $in_data['department_location'] = 'locals';
    $in_data['status'] = 'DELETED';
    
    //echo $res = $obj->insert($in_data, 'department');
    //echo $res = $obj->insert("INSERT INTO department(department_name,department_location,status) VALUE('num','local','ACTIVE')");
    
    //echo $res = $obj->update($in_data, 'department', " department_id = '14' ");
    //echo $res = $obj->update("UPDATE department SET department_name = 'numsi',department_location = 'localsi',status = 'ACTIVE' WHERE department_id = '14' ");
    
    /*$qry = 'SELECT * FROM department';
    $res = $obj->fire($qry);
    print_r($res);
    if($res)
    {
        echo "executed";
    }
    else
    {
        echo mysqli_error($obj);
    }*/
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
