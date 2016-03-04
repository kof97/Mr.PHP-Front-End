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

class MrApplication
{
    /**
     * start function.
     *
     * @return void
     */
    public function start()
    {
        if (AUTO_START_SESSION) {
            session_start();
        }

        $this->runController();

    }

    /**
     * default controller.
     * 
     * @param $route uri route, defaule empty.
     * @return mixed
     */
    public function runController()
    {
        $getRoute = processRoute();  
        $route = explode("/", $getRoute);
        array_shift($route);

        $filterRoute = preg_grep("/^[a-zA-Z]/", $route);

        // if don't have controller then default
        if (count($filterRoute) == 0) {
            // process the default controller
            $default = DEFAULT_CONTROLLER;
            if (strpos($default, "/") || strpos($default, "\\")) {
                $default = str_replace("/", DS, $default);
                $default = str_replace("\\", DS, $default);
            }

            array_unshift($route, $default);
            $filterRoute = preg_grep("/^[a-zA-Z]/", $route);
        }

        // get the class that can be used
        $classPath = "";
        foreach ($filterRoute as $key => $value) {
            $classPath .= DS . $value;
            $fileName = MAIN_PATH . "controller" . $classPath . ".php";

            if (!file_exists($fileName)) {
                continue;
            }
            
            importClass($fileName);
            // get the class name
            if (strpos($value, DS)) {
                $value = substr($value, strrpos($value, DS) + 1);
            }

            $class = ucfirst($value);
            if (class_exists($class)) {
                $classKey = $class;

                if (!Mr::getClass($classKey)) {
                    Mr::setClass($classKey, new $class);
                }

                // get the method and judge whether it is out of the range, default
                if (($key + 1) >= count($route)) {
                    $method = DEFAULT_METHOD;
                } else {
                    if (preg_match("/^[a-zA-Z]/", $route[$key + 1])) {
                        $method = $route[$key + 1];
                    } else {
                        $method = DEFAULT_METHOD;
                    }
                }

                // whether the method exists
                if (method_exists(Mr::getClass($classKey), $method)) {
                    return Mr::getClass($classKey)->$method();
                }  
            }
          
        }

        showError("controller or method couldn't find, please check your request uri !");
        return false;

    }

}