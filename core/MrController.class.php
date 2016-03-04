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

class MrController
{
    // model list
    static private $_model = array();

    /** 
     * get model.
     * 
     * @param string $modelName model name.
     * @return mixed
     */
    public function model($modelName)
    {
        $model = explode("/", $modelName);

        $filterModel = preg_grep("/^[a-zA-Z]/", $model);

        // if don't have model
        if (count($filterModel) == 0) {
            showError("couldn't find the model that you requested, please check your model uri !");
            return false;
        }

        // get the model that can be used
        $modelPathU = "";
        $modelPathL = "";
        foreach ($filterModel as $key => $value) {
            $modelPathL .= DS . lcfirst($value);
            $fileName = MAIN_PATH . "model" . $modelPathL . ".php";

            if (!file_exists($fileName)) {

                $modelPathU .= DS . ucfirst($value);
                $fileName = MAIN_PATH . "model" . $modelPathU . ".php";
                
                if (!file_exists($fileName)) {
                    continue;
                }
                
            }

            importClass($fileName);

            $modelKey = ucfirst($value);
            if (class_exists($modelKey)) {

                if (!$this->getModel($modelKey)) {
                    $this->setModel($modelKey, new $modelKey);
                }

                return $this->getModel($modelKey);
            }                
            
        }

        showError("couldn't find the model that you requested, please check your model uri !");
        return false;

    }

    /**
     * get view.
     * 
     * @param string $viewName view path. 
     * @param array $data data vars. 
     * @return mixed
     */
    public function view($viewName, $data = array())
    {   
        if (is_object($data)) {
            $data = get_object_vars($data);
        }

        // get data vars
        foreach ($data as $key => $value) {
            $$key = isset($data[$key]) ? $value : "";
        }

        if (trim($viewName) == "") {
            $viewName = "index.php";
        }
        // replace with directory separator
        if (strpos($viewName, "/") || strpos($viewName, "\\")) {
            $viewName = str_replace("/", DS, $viewName);
            $viewName = str_replace("\\", DS, $viewName);
        }
        $viewPath = MAIN_PATH . "view" . DS . $viewName;

        if (file_exists($viewPath)) {
            include_once($viewPath);
        } else {
            showError("the view you requested is not find, please check your request !");
        }

    }

    /**
     * redirect uri.
     *
     * @param string $route route uri.
     * @param int $http_response_code http reponse code.
     * @return void
     */
    public function redirect($route, $http_response_code = 302)
    {
        $uri = BASE_URI . "index.php/" . $route;
        header("Location: " . $uri, TRUE, $http_response_code);

    }

    /**
     * set model.
     *
     * @param string $key key.
     * @param object $val key value.
     * @return void
     */
    public function setModel($key, $val)
    {
        $modelKey = strtolower($key);
        self::$_model[$modelKey] = $val;

    }

    /**
     * get model.
     *
     * @param string $key model key.
     * @return mixed
     */
    public function getModel($key)
    {
        $modelKey = strtolower($key);
        return isset(self::$_model[$modelKey]) ? self::$_model[$modelKey] : null;

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
