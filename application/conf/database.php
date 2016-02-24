<?php 

if (!defined('ACC')) exit('this script access allowed');

/**
 * -------------------------------------------------------------------
 * DATABASE SETTINGS
 * -------------------------------------------------------------------
 * This file will contain the settings needed to access your database.
 * -------------------------------------------------------------------
 * EXPLANATION OF VARIABLES
 * -------------------------------------------------------------------
 *
 *	['enable'] whether enable the database, ture or false.
 *	['hostname'] The hostname of your database server.
 *	['port'] connect port. default 3306.
 *	['username'] The username used to connect to the database.
 *	['password'] The password used to connect to the database.
 *	['database'] The name of the database you want to connect to.
 *	['dbdriver'] The database type. ie: mysql.  Currently supported:
 *				 mysqli, pdo
 *	['charset'] The character set used in communicating with the database.
 */

	$db["enable"] = true;
	$db["hostname"] = "localhost";
	$db["port"] = "3306";
	$db["username"] = "root";
	$db["password"] = "kof97";
	$db["database"] = "test";
	$db["dbdriver"] = "pdo";
	$db["charset"] = "utf8";

