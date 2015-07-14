<?php

include_once './Connection.php';
include_once './iRules.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of db
 *
 * @author bawasaab
 */
class Db extends Connection implements iRules
{
    public function __construct() 
    {
        parent::__construct();
    }
    
    /**

     * This is used to insert a row
     * @param array $in_data Array type variable holds keys-value pairs of column and data respectively.
     * @param string $table holds name of the table
     * @return bool TRUE if row inserted FALSE otherwise
     */
    public function insert($in_data, $table) 
    {
        $ColumnNames = '';
        $Values = '';
        
        if(!is_array($in_data) || empty($table))
        {
            return FALSE;
        }
        else 
        {
            foreach($in_data AS $key => $val)
            {
                $ColumnNames .= $key.",";
                $Values .= "'".mysql_real_escape_string($val)."',";
            }

            $QueryStr = "INSERT INTO ".$table."(".trim($ColumnNames, ',').") VALUES(".trim($Values, ',').")";
            $ExeQry = mysql_query($QueryStr);
            return $ExeQry;
        }
    }
    
    /**

     * This is used to fetch multiple rows at a time
     * @param string $in_data holds column names
     * @param string $table holds name of the table
     * @param string $condition holds the condition, that how a data is to be selected. By default it is equal to 1, incase user does not have any condition.
     * @param int $offset Description
     * @return associative_array returns result as associative array TRUE if executed FALSE otherwise
     */
    public function select($in_data, $table, $condition = 1, $perpage = FALSE, $offset = FALSE)
    {
        $out_data = array();
        $ColumnNames = '';
        $i = 0;
        
        if(!is_array($in_data) || empty($table))
        {
            return FALSE;
        }
        else
        {
            foreach($in_data AS $key => $val)
            {
                $ColumnNames .= $val.",";
            }
            
            $ColumnNames = trim($ColumnNames, ',');
            
            if($perpage != FALSE && $offset != FALSE)
            {
                $QueryStr = "SELECT ".$ColumnNames." FROM ".$table." WHERE ".$condition." ".$offset.",".$perpage;
            }
            else
            {
                echo $QueryStr = "SELECT ".$ColumnNames." FROM ".$table." WHERE ".$condition;
            }
            
            $ExeQuery = mysql_query($QueryStr);
            if($ExeQuery)
            {
                if(mysql_num_rows($ExeQuery) > 0)
                {
                    while($row = mysql_fetch_array($ExeQuery))
                    {
                        foreach($in_data AS $key => $val)
                        {
                            $out_data[$i][$val] = $row[$val];
                        }
                        $i += 1;
                    }
                    
                    return $out_data;
                }
		else
		{
                    return FALSE;
		}
            }
            else
            {
                return FALSE;
            }
        }
    }
    
    /**

     * This is used to fetch a row
     * @param string $in_data Array type variable holds keys-value pairs of column and data respectively.
     * @param string $table holds name of the table
     * @param string $condition holds the condition, that how a data is to be selected. By default it is equal to 1, incase user does not have any condition.
     */
    public function select_row($in_data, $table, $condition = 1)
    {
        $out_data = array();
        $ColumnNames = '';
        
        if(!is_array($in_data) || empty($table))
        {
            return FALSE;
        }
        else
        {
            foreach($in_data AS $key => $val)
            {
                $ColumnNames .= $val.",";
            }
            
            $ColumnNames = trim($ColumnNames, ',');
            
            $QueryStr = "SELECT ".$ColumnNames." FROM ".$table." WHERE ".$condition;
            $ExeQuery = mysql_query($QueryStr);
            if($ExeQuery)
            {
                if(mysql_num_rows($ExeQuery) > 0)
                {
                    while($row = mysql_fetch_array($ExeQuery))
                    {
                        foreach($in_data AS $key => $val)
                        {
                            $out_data[$val] = $row[$val];
                        }
                    }
                    
                    return $out_data;
                }
		else
		{
                    return FALSE;
		}
            }
            else
            {
                return FALSE;
            }
        }
    }
    
    /**

     * This is used to update a row or number of rows with or without conditions.
     * @param array $in_data Array type variable holds keys-value pairs of column and data respectively.
     * @param string $table holds name of the table
     * @param string $condition holds the condition, that how a data is to be updated. By default it is equal to 1, incase user does not have any condition.
     * @return bool TRUE if row inserted FALSE otherwise
     */
    public function update($in_data, $table, $condition = 1)
    {
        $Set = '';
        
        if(!is_array($in_data) || empty($table))
        {
            return FALSE;
        }
        else 
        {
            foreach($in_data AS $key => $val)
            {
                $Set .= $key." = '".mysql_real_escape_string($val)."',";
            }

            echo $QueryStr = "UPDATE ".$table." SET ".trim($Set, ',')." WHERE ".$condition;
            $ExeQry = mysql_query($QueryStr);
            return $ExeQry;
        }
    }
    
    /**

     * This is used to fetch multiple rows at a time with joins and alias
     * @param string $in_data holds column names
     * @param string $table holds name of the table
     * @param string $condition holds the condition, that how a data is to be selected. By default it is equal to 1, incase user does not have any condition.
     * @param array $alias aliases for the joined columns
     * @param int $offset Fetch row index from, by default it is FALSE
     * @param int $perpage Fetch this number of rows defined in $perpage
     * @return associative_array returns result as associative array TRUE if executed FALSE otherwise
     */
    public function selectj($in_data, $table, $condition = 1, $alias, $perpage = FALSE, $offset = FALSE)
    {
        $out_data = array();
        $ColumnNames = '';
        $i = 0;
        
        if(!is_array($in_data) || empty($table) || !is_array($alias))
        {
            return FALSE;
        }
        else
        {
            foreach($in_data AS $key => $val)
            {
                $ColumnNames .= $val.",";
            }
            
            $ColumnNames = trim($ColumnNames, ',');
            
            if($perpage != FALSE && $offset != FALSE)
            {
                $QueryStr = "SELECT ".$ColumnNames." FROM ".$table." WHERE ".$condition." ".$offset.",".$perpage;
            }
            else
            {
                echo $QueryStr = "SELECT ".$ColumnNames." FROM ".$table." WHERE ".$condition;
            }
            
            $ExeQuery = mysql_query($QueryStr);
            if($ExeQuery)
            {
                if(mysql_num_rows($ExeQuery) > 0)
                {
                    while($row = mysql_fetch_array($ExeQuery))
                    {
                        foreach($alias AS $key => $val)
                        {
                            $out_data[$i][$val] = $row[$val];
                        }
                        $i += 1;
                    }
                    
                    return $out_data;
                }
		else
		{
                    return FALSE;
		}
            }
            else
            {
                return FALSE;
            }
        }
    }
    
    /**

     * This is used to fetch a rows at a time with joins and alias
     * @param string $in_data Array type variable holds keys-value pairs of column and data respectively.
     * @param string $table holds name of the table
     * @param string $condition holds the condition, that how a data is to be selected. By default it is equal to 1, incase user does not have any condition.
     * @param array $alias aliases for the joined columns
     */
    public function select_rowj($in_data, $table, $condition = 1, $alias)
    {
        $out_data = array();
        $ColumnNames = '';
        
        if(!is_array($in_data) || empty($table) || !is_array($alias))
        {
            return FALSE;
        }
        else
        {
            foreach($in_data AS $key => $val)
            {
                $ColumnNames .= $val.",";
            }
            
            $ColumnNames = trim($ColumnNames, ',');
            
            $QueryStr = "SELECT ".$ColumnNames." FROM ".$table." WHERE ".$condition;
            $ExeQuery = mysql_query($QueryStr);
            if($ExeQuery)
            {
                if(mysql_num_rows($ExeQuery) > 0)
                {
                    while($row = mysql_fetch_array($ExeQuery))
                    {
                        foreach($alias AS $key => $val)
                        {
                            $out_data[$val] = $row[$val];
                        }
                    }
                    
                    return $out_data;
                }
		else
		{
                    return FALSE;
		}
            }
            else
            {
                return FALSE;
            }
        }
    }
    
    public function __destruct() 
    {
        $this->conn_close();
    }
}
