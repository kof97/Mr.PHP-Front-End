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

class MrRun
{
    /**
     * run application.
     *
     * @return void
     */
    static public function run()
    {
        $app = self::_createApplication('MrApplication');
        $app->start();
        
    }

    /**
     * run application.
     *
     * @param string $class className.
     * @return object
     */
    static private function _createApplication($class)
    {
        $applicationKey = strtolower($class);

        if (!Mr::getA($applicationKey)) {
            Mr::setA($applicationKey, new $class);
        }
        return Mr::getA($applicationKey);

    }

}