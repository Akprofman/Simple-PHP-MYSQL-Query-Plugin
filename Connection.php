<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Connection
 *
 * @author bawasaab
 */
class Connection 
{
    public function __construct() 
    {
        $host = 'localhost';
        $user_name = 'root';
        $pwd = '';
        $db_name = 'dr';
        $conn = mysql_connect($host, $user_name, $pwd) or die('Connection Defined Unproperly');
        $db = mysql_select_db($db_name, $conn) or die('Database Not Found');
    }
    
    public static function conn_close()
    {
        mysql_close();
    }
}
