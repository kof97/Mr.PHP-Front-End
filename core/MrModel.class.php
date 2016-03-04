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
     * get the database object.
     * 
     * @return mixed
     */
    public function db()
    {
        if (Mr::getClass("db")) {
            return Mr::getClass("db");
        } else {
            showError("check your database.php to ensure that you make your db enable !");
        }
        
    }

}