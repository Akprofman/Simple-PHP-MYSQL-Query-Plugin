<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author bawasaab
 */
interface iRules 
{
    /**

     * This is used to insert a row
     * @param array $in_data Array type variable holds keys-value pairs of column and data respectively.
     * @param string $table holds name of the table
     * @return bool TRUE if row inserted FALSE otherwise
     */
    public function insert($in_data, $table);
    
    /**

     * This is used to update a row or number of rows with or without conditions.
     * @param array $in_data Array type variable holds keys-value pairs of column and data respectively.
     * @param string $table holds name of the table
     * @param string $condition holds the condition, that how a data is to be updated. By default it is equal to 1, incase user does not have any condition.
     * @return bool TRUE if row inserted FALSE otherwise
     */
    public function update($in_data, $table, $condition = 1);
    
    /**

     * This is used to fetch multiple rows at a time
     * @param string $in_data holds column names
     * @param string $table holds name of the table
     * @param string $condition holds the condition, that how a data is to be selected. By default it is equal to 1, incase user does not have any condition.
     * @param int $offset Description
     * @return associative_array returns result as associative array TRUE if executed FALSE otherwise
     */
    public function select($in_data, $table, $condition = 1, $perpage, $offset = FALSE);
    
    /**

     * This is used to fetch a row
     * @param string $in_data Array type variable holds keys-value pairs of column and data respectively.
     * @param string $table holds name of the table
     * @param string $condition holds the condition, that how a data is to be selected. By default it is equal to 1, incase user does not have any condition.
     */
    public function select_row($in_data, $table, $condition = 1);
}
