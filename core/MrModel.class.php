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

class MrModel
{

    public function __construct()
    {

    }

    /**
     * call db.
     *
     * @param string $method method.
     * @param string $args args.
     * @return mixed
     */
    public function __call($method, $args)
    {
        if ($dbClass = Mr::getClass("dbClass")) {

            if (method_exists($dbClass, $method)) {
                return $dbClass->$method();
            }

        }

        showError("method dosn't exist ! Please check your conf/database.php !");
    }

    /**
     * call db or conn.
     *
     * @param string $name method.
     * @return method
     */
    public function __get($name)
    {
        return $this->$name();
        
    }

}