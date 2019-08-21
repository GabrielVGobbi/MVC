<?php
require 'environment.php';

global $config;
$config = array();
if(ENVIRONMENT == 'development') {
	define("BASE_URL", "http://www2.mvc.com.br/admin/");
	$config['dbname'] = 'cena';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'root';
	$config['dbpass'] = '';
} else {
	define("BASE_URL", "");
	$config['dbname'] = 'soare416_dbMarcio';
	$config['host'] = 'ns528.hostgator.com.br';
	$config['dbuser'] = 'soare416_marcio';
	$config['dbpass'] = 'GGv27080';
}
?>