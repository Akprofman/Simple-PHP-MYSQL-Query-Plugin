<?php
    //Including database class
    include_once './Db.php';
    
    //Creating object of database class
    $obj = new Db();
    
    //Defining array
    $in_data = [];
    $alias = [];
    $out_data = [];
    
    //Assigning table name
    $table = 'department d INNER JOIN employeemaster e ON d.department_id = e.department_id';
    
    //Assigning condition
    $condition1 = "d.department_id = '1' ";
    $condition2 = "e.status = 'ACTIVE' ";
    
    //Initializing column names and values to be inserted
    $in_data[] = 'd.department_id AS department_id';
    $in_data[] = 'd.department_name AS department_name';
    $in_data[] = 'd.department_location AS department_location';
    $in_data[] = 'e.employeename AS employeename';
    $in_data[] = 'e.employee_mail_id AS employee_mail_id';
    
    //Initializing alias
    $alias[] = 'department_id';
    $alias[] = 'department_name';
    $alias[] = 'department_location';
    $alias[] = 'employeename';
    $alias[] = 'employee_mail_id';
    
    //It will selecte a row according to condition
    if($out_data = $obj->select_rowj($in_data, $table, $condition1, $alias))
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
