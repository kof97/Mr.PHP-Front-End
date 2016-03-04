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

class Mr
{
    // application list
    static private $_a;
	
    // class list
    static private $_class;

    /**
     * init application.
     *
     * @return mixed
     */
    static public function init()
    {
        if (!DEBUG) {
            error_reporting(0);
        }
        
        // load application function
        Mr::import(CORE_PATH . 'application.func.php');

        // load database
        Mr::import(CORE_PATH . "db" . DS . "db.php");
        $db = getDb();    
        if (!Mr::getClass("db")) {
            Mr::setClass("db", $db);
        }    

        MrRun::run();

    }

    /**
     * import file or path.
     *
     * @param string  $path 	 file path.
     * @param boolean $testExist allow test exist.
     * @return mixed
     */
    static public function import($path, $testExist = true)
    {
        static $succeedImportFile = array();

        if (is_file($path)) {
            $status = include_once($path);

            $fileName = substr($path, (strrpos($path, DS) + 1));
            $succeedImportFile[$fileName] = (boolean)$status;
    		
            return $succeedImportFile[$fileName];
        } else {
            if ($testExist) {
                //throw new MrException('import not found file :' . $path);
                showError("couldn't find the file which is imported !");
            } else {
                return array();
            }
        }

    }

    /**
     * set application.
     *
     * @param string $key key.
     * @param object $val key value.
     * @return void
     */
    static public function setA($key, $val)
    {
        $applicationKey = strtolower($key);
        self::$_a[$applicationKey] = $val;

    }

    /**
     * get application.
     *
     * @param string $key application key.
     * @return mixed
     */
    static public function getA($key)
    {
        $applicationKey = strtolower($key);
        return isset(self::$_a[$applicationKey]) ? self::$_a[$applicationKey] : null;

    }

    /**
     * set class.
     *
     * @param string $key key.
     * @param object $val key value.
     * @return void
     */
    static public function setClass($key, $val)
    {
        $classKey = strtolower($key);
        self::$_class[$classKey] = $val;

    }

    /**
     * get class.
     *
     * @param string $key class key.
     * @return mixed
     */
    static public function getClass($key)
    {
        $classKey = strtolower($key);
        return isset(self::$_class[$classKey]) ? self::$_class[$classKey] : null;

    }

}