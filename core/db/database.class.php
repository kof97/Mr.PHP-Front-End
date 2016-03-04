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

class Database
{
    /**
     * get db obj.
     *
     * @return object
     */
    public function conn()
    {
        return Mr::getClass("dbClass");

    }

    /**
     * get self.
     *
     * @return object
     */
    public function db()
    {
        return Mr::getClass("db");

    }

}