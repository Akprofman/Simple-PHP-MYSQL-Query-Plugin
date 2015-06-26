<?php
/**
 
 * @author Deepak Bawa
 */
class HelpMe 
{
    public static function CleanIt($param)
    {
        return $param = trim(htmlentities(htmlspecialchars($param)));
    }
    
    public static function SanitizeMe($param)
    {
        $data = array();
        
        if(is_array($param))
        {
            foreach ($param as $key => $value) 
            {
                $data[$key] = self::CleanIt($value);
            }
            
            return $data;
        }
        elseif(is_string($param))
        {
            return $param = self::CleanIt($param);
        }
        elseif(is_numeric($param))
        {
            return $param = self::CleanIt($param);
        }
        else
        {
            return $param;
        }
    }
    
    public static function InsertMe($data, $table)
    {
        $flag = 0;
    		$data = self::SanitizeMe($data);
        $ColumnNames = '';
        $Values = '';
        
        if(!is_array($data) || empty($table))
        {
            return FALSE;
        }
        else 
        {
    	      foreach($data AS $key => $val)
            {
                $val1 = self::SanitizeMe($key);
                $val2 = self::SanitizeMe($val);

                if($val1 == $key && $val2 == $val)
                {
                    $ColumnNames .= $key.",";
                    $Values .= "'".$val."',";
                }
                else
                {
                    $flag = 1;
                    echo "<script> alert('It Seems that Someone Attempts To Insert Infected Data'); </script>";
                    break;
                }
            }
            
            if($flag != 1)
            {
                $ColumnNames = trim($ColumnNames, ',');
                $Values = trim($Values, ',');
                
                $QueryStr = "INSERT INTO ".$table."(".$ColumnNames.") VALUES(".$Values.")";
                //Execute Query
                echo $ExeQuery = mysql_query($QueryStr) or die(mysql_error());
    	        if($ExeQuery)
    	        {
    	            return TRUE;
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
    
    public static function SelectMe($data, $table, $Condition = 1)  
    {
        $datta = array();
        $i = 0;
        $ColumnNames = '';
        
        if(!is_array($data) || empty($table))
        {
            return FALSE;
        }
        else
        {
            foreach($data AS $key => $val)
            {
                $ColumnNames .= $val.",";
            }
            
            $ColumnNames = trim($ColumnNames, ',');
            
            $QueryStr = "SELECT ".$ColumnNames." FROM ".$table." WHERE ".$Condition;
            $ExeQuery = mysql_query($QueryStr);
            if($ExeQuery)
            {
                if(mysql_num_rows($ExeQuery) > 0)
                {
                    while($row = mysql_fetch_array($ExeQuery))
                    {
                        foreach($data AS $key => $val)
                        {
                            $datta[$i][$val] = $row[$val];
                        }
                        $i++;
                    }
                    
                    return $datta;
                }
            }
            else
            {
                return FALSE;
            }
        }
    }
    
    public static function UpdateMe($data, $table, $Condition = 1)
    {
        $Set = '';
        $flag = 0;
        
        if(!is_array($data) || empty($table))
        {
            return FALSE;
        }
        else 
        {
            foreach($data AS $key => $val)
            {
                $val1 = self::SanitizeMe($key);
                $val2 = self::SanitizeMe($val);
                
                if($val1 == $key && $val2 == $val)
                {
                    $Set .= $key." = '".$val."',";
                }
                else
                {
                    $flag = 1;
                    echo "<script> alert('It Seems that Someone Attempts To Insert Infected Data'); </script>";
                    break;
                }
            }
            
            $Set = trim($Set, ',');
            
            $QueryStr = "UPDATE ".$table." SET ".$Set." WHERE ".$Condition;
            //Execute Query Here
            $ExeQuery = mysql_query($QueryStr);
            if($ExeQuery)
            {
                return TRUE;
            }
            else
            {
                return FALSE;
            }
        }
    }
}
?>
