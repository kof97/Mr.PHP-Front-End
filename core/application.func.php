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

/**
 * process route.
 *
 * @return string
 */
function processRoute()
{
    $requestUri = $_SERVER["REQUEST_URI"];

    // $flag if exists index.php
    $judgeIndex = strpos($requestUri, "index.php");
    if ($judgeIndex) {
        $pathInfo = substr($requestUri, $judgeIndex + 9);
    } else {
        // if whole uri
        $judgeUri = strpos($requestUri, ITEM_NAME);
        if ($judgeUri) {
            $pathInfo = substr($requestUri, $judgeUri + strlen(ITEM_NAME));
        } else {
            $pathInfo = $requestUri;
        }
    }

    return $pathInfo;

}

/**
 * get the post data.
 * 
 * @param string $key key
 * @return mixed
 */
function post($key = "")
{
    if (trim($key) == "") {
        $post = $_POST;
    } else {
        if (isset($_POST[$key])) {
            $post = $_POST[$key];
        } else {
            $post = null;
        }
        
    }

    return $post;

}

/**
 * get the request data.
 * 
 * @param string $key key
 * @return mixed
 */
function request($key = "")
{
    if (trim($key) == "") {
        $request = $_REQUEST;
    } else {
        if (array_key_exists($key, $_REQUEST)) {
            $request = $_REQUEST[$key];
        } else {
            $request = null;
        }
        
    }

    return $request;

}

/**
 * get the get data.
 * 
 * @param string $key key
 * @return mixed
 */
function get($key = "")
{
    if (trim($key) == "") {
        $get = $_GET;
    } else {
        if (isset($_GET[$key])) {
            $get = $_GET[$key];
        } else {
            $get = null;
        }
        
    }

    return $get;

}

/**
 * get uri segment.
 * 
 * @param int $segment the uri segment.
 * @return string
 */
function uriSegment($segment)
{
    $getRoute = processRoute();
    $route = explode('/', $getRoute);

    if ($segment >= count($route)) {
        return "";
    } else {
        return $route[$segment];
    }   

}

/**
 * get the request url by controller.
 * 
 * @param string $controller controller.
 * @return string
 */
function siteUrl($controller = "")
{
    $url = BASE_URI . "index.php" . DS . $controller;

    // replace with '/'
    if (strpos($url, "\\")) {
        $url = str_replace("\\", "/", $url);
    }
    return $url;

}

/**
 * show the error message.
 * 
 * @param string $error error message.
 * @return void
 */
function showError($error = "")
{
    echo "<h2 style=''>$error</h2>";
    exit;   

}

/**
 * import file.
 * 
 * @param string $path file path.
 * @param boolean $show whether show error message.
 * @return mixed
 */
function importClass($path, $show = true)
{
    if (file_exists($path)) {
        include_once($path);
    } else {
        if ($show) {
            showError("couldn't find the file which is imported, please check your file path !");
        } else {
            return false;
        }
    }

}
