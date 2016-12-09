<?
defined('BASE_PAGE') or die('Restricted access');
if ( ! isset($_SESSION['active']) ) exit;

//CONFIGURATION
//customize these
//echo '../classes/config.ini';
$config = parse_ini_file( '/var/www/html/projects/laptops/includes/config.ini', true);
//print_r($config);
/*
$pass 	= 'seton5150';
$user 	= 'joe_sample';
$server	= 'tltc-db1-prod.shu.edu';
$db		= 'sample_db';
*/

$link = new mysqli($config['dbserver'], $config['dbuser'], $config['dbpw']);
// Check connection
if ($link->connect_errno)
  {
  echo "Failed to connect to MySQL: " . $link->connect_error;
  } 
  
$link->select_db($config['db']) or $errors .= $link->errno;
  
