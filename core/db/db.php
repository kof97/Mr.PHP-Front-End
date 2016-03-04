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
 * get db connection.
 *
 * @return mixed
 */
function getDb()
{   
    // get the database config
    $dbConfig = CONF_PATH . "database.php";
    if (file_exists($dbConfig)) {
        include_once($dbConfig);
    }
    
    if (!empty($db)) {
        if (trim(strtolower($db['enable']))) {

            // create db object
            $dbdriver = trim(strtolower($db['dbdriver']));
            if ($dbdriver == "mysqli") {
                $d =  createMysqli($db);
                dbClass($dbdriver);

            } else if ($dbdriver == "pdo") {
                $d =  createPdo($db);
                dbClass($dbdriver);

            } else {
                showError("please check your database.php to ensure that dbdriver is right !");
            }

            return $d;
        }
    }   
    return null;

}

/**
 * create mysqli connection.
 *
 * @param array $db database config.
 * @return object
 */
function createMysqli($db)
{
    $mysqli = new mysqli();
    $mysqli->connect($db['hostname'], $db['username'], $db['password'], $db['database'], $db['port']);
    $mysqli->set_charset($db['charset']);

    return $mysqli;

}

/**
 * create pdo connection.
 *
 * @param array $db database config.
 * @return mixed
 */
function createPdo($db)
{
    $dsn = 'mysql:dbname=' . $db['database'] . ';host=' . $db['hostname'] . ';charset=' . $db['charset'] . ';port=' . $db['port'];
    $user = $db['username'];
    $password = $db['password'];

    try {
         $dbh = new PDO($dsn, $user, $password);
    } catch (PDOException $e) {
        showError($e -> getMessage());
    }

    return $dbh;

}

/**
 * create database class
 * 
 * @return void
 */
function dbClass($dbdriver)
{
    if ($dbdriver == "mysqli") {
        $dbClass = new MrMysqli();   
    } else if ($dbdriver == "pdo") {
        $dbClass = new MrPdo();   
    }
     
    if (!Mr::getClass("dbClass")) {
        Mr::setClass("dbClass", $dbClass);
    } 

}



