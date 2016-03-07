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

class MrMysqli extends Database
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
            return true;
        }

        switch ($mode) {
            case 'array': 
                $res = $query->fetch_assoc(); break;
            case 'object': 
                $res = $query->fetch_object(); break;
            case 'count': 
                $res = $query->num_rows; break;

            default: 
                $res = array();
                while ($r = $query->fetch_assoc()) {
                    array_push($res, $r); 
                }
                break;

        }

        return $res;
    }


}