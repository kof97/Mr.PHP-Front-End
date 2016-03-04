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

// defind ACCESS
defined('ACC') or define('ACC', true);

// 开启调试 是
defined('DEBUG') or define('DEBUG', true);
// 自启动session 是
defined('AUTO_START_SESSION') or define('AUTO_START_SESSION', true);
// 默认 controller
defined('DEFAULT_CONTROLLER') or define('DEFAULT_CONTROLLER', 'index');
// 默认 method
defined('DEFAULT_METHOD') or define('DEFAULT_METHOD', 'show');

// 目录分隔符
defined('DS') or define('DS', DIRECTORY_SEPARATOR);
// 框架目录
defined('FRAME_PATH') or define('FRAME_PATH', dirname(__FILE__) . DS);
// 核心目录
defined('CORE_PATH') or define('CORE_PATH', FRAME_PATH . 'core' . DS);
// 主目录
defined('MAIN_PATH') or define('MAIN_PATH', FRAME_PATH . 'application' . DS);
// 配置文件目录
defined('CONF_PATH') or define('CONF_PATH', FRAME_PATH . 'application' . DS . 'conf' . DS);
// 项目目录名
defined('ITEM_NAME') or define('ITEM_NAME', substr(dirname(__FILE__), strrpos(dirname(__FILE__), DS) + 1));
// 项目uri地址
defined('BASE_URI') or define('BASE_URI', "http://" . $_SERVER['SERVER_NAME'] . substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], "index.php") ? strpos($_SERVER['REQUEST_URI'], "index.php") : strlen($_SERVER['REQUEST_URI'])));
// 用户自定义扩展目录
defined('EXT_PATH') or define('EXT_PATH', FRAME_PATH . 'application' . DS . 'ext' . DS);

require_once(CORE_PATH . 'Mr.class.php');

function loader($className) 
{
    $fileName = CORE_PATH . $className . ".class.php";
    
    if (!file_exists($fileName)) {

        $fileName = EXT_PATH . $className . ".php";
        if (!file_exists($fileName)) {

        	$fileName = CORE_PATH . "db" . DS . $className . ".class.php";
            if (!file_exists($fileName)) {
            	return false;
            }
        }
    } 

    include_once($fileName);

}

spl_autoload_register("loader");

Mr::init();