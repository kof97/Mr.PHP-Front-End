<?php 
/**
 * Mr PHP
 *
 * PHP version 5
 *
 * @category PHP
 * @package  Core.base
 * @author   LYJ <1048434786@qq.com>
 * @license  
 * @version  
 * @link     
 */
if (!defined('ACC')) exit('this script access allowed');

class MrPdo extends Database
{

    /**
     * single query.
     * 
     * @param string $sql sql query string。
     * @param string $mode the query mode type. Currently supported:
     *          count, array, arrayAll, object 
     * @return mixed
     */
    public function query($sql = "", $mode = "arrayAll")
    {
        if (trim($sql == "")) {
            showError("sql query needs one param to query !");
        }

        $query = $this->db()->query($sql);
        if (!$query) {
            showError("please check your sql string !");
        }

        if (strpos(strtolower($sql), "select") === false) {
            return $query;
        }
        
        switch ($mode) {
            case 'array': 
                $res = $query->fetch(PDO::FETCH_ASSOC); break;
            case 'object': 
                $res = $query->fetchObject(); break;
            case 'count': 
                $res = $query->rowCount(); break;

            default: $res = $query->fetchAll(PDO::FETCH_ASSOC); break;

        }

        return $res;
        
    }




}