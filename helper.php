<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of helper
 *
 * @author Deepak Bawa
 */
class helper {
    
    private $host_name = '';
    private $user_name = '';
    private $password = '';
    private $database_name = '';
    private $db = '';

    public function __construct($param = array()) {
        $this->initialize($param);
    }
    
    private function initialize($param = array()) {
        if(count($param)){
            foreach($param AS $k => $v){
                if(property_exists('helper',$k)){
                    $this->$k = $v;
                }
            }
        }
        $this->connect();
    }
    
    private function connect(){
        $this->db = new mysqli($this->host_name, $this->user_name, $this->password, $this->database_name);
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            echo "<br><br>Kindly confirm wheather you have enter following correctly!";
            $str = "<ol>";
            $str .= "<li>host_name</li>";
            $str .= "<li>user_name</li>";
            $str .= "<li>password</li>";
            $str .= "<li>database_name</li>";
            $str .= "</ol>";
            echo $str;
            exit();
        }
    }
    
    //htmlentities($str, ENT_QUOTES | ENT_IGNORE, "UTF-8");
    
    private function sanitize($param){
        $data = [];
        if(is_string($param) || is_numeric($param) ){
            return $aparam = mysqli_real_escape_string($this->db, htmlentities(trim($param), ENT_IGNORE, "UTF-8"));
        } elseif(is_array($param)) {
            foreach ($param as $key => $value) {
                $data[$key] = mysqli_real_escape_string($this->db, htmlentities(trim($param), ENT_IGNORE, "UTF-8"));
            }
            return $data;
        } else {
            return $param;
        }
    }
    
    public function insert($in_data, $table = FALSE){
        $k = '';
        $v = '';
        if (isset($table) && !empty($table) && $table != FALSE){
            if(isset($in_data) && is_array($in_data)){
                foreach ($in_data as $key => $value) {
                    $k .= $key.",";
                    $v .= "'".  $this->sanitize($value)."',";
                }
                $qry = "INSERT INTO ".$table."(".trim($k, ",").") VALUE(".trim($v, ",").")";  
                return $exe = $this->db->query($qry) or die(mysqli_error($this->db));
            } 
        } elseif ($table === FALSE && !empty ($in_data) && is_string($in_data)) {
            return $exe = $this->db->query($in_data) or die(mysqli_error($this->db));
        } else {
            return FALSE;
        }
    }
    
    public function update($in_data, $table = FALSE, $Condition = 1){
        $Set = '';
        if (isset($table) && !empty($table) && $table != FALSE){
            if(isset($in_data) && is_array($in_data)){
                foreach ($in_data as $key => $value) {
                    $Set .= $key." = '". $this->sanitize($value) ."',";
                }
                $qry = "UPDATE ".$table." SET ".trim($Set, ",")." WHERE ".$Condition;
                return $exe = $this->db->query($qry) or die(mysqli_error($this->db));
            } 
        } elseif ($table === FALSE && !empty ($in_data) && is_string($in_data)) {
            return $exe = $this->db->query($in_data) or die(mysqli_error($this->db));
        } else {
            return FALSE;
        }
    }
    
    public function fire($qry){
        if(isset($qry) && !empty($qry) && is_string($qry)){
            return $exe = $this->db->query($qry) or die(mysqli_error($this->db));
        } else {
            return FALSE;
        }
    }

    public function __destruct() {
        mysqli_close($this->db);
    }
}
