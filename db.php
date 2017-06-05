<?php
/* 
 * Db Connection file
 * @info :Include the files to connect to the database
 *
*/
$username="id530820_admin"; // DB USERNAME
$password="admin@1234"; // DB PASSWORD
$database="id530820_testmw"; // DB NAME
mysql_connect("localhost",$username,$password);
@mysql_select_db($database) or die( "Unable to select database");

?>