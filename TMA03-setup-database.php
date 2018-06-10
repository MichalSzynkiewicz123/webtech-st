<?php
define('ISITSAFETORUN', TRUE);
error_reporting(E_ALL);
ini_set('display_errors', 1);
$databasename ='techdefs.sqlite';
$stylesheet = '';
$javascript ='';
$mycss='';
$pagetitle = 'Create Database and Tables';
require 'html5head.php';
$db = new SQLite3($databasename);
echo"<p>Creating  SQLite database tables on the server</p>";

/*This cannot run without first including the code to open the database */
$sql = 'CREATE TABLE IF NOT EXISTS "mydefinitions" ("term" TEXT PRIMARY KEY NOT NULL , "definition" TEXT )';
$db->exec($sql) or die('Create table failed');

/*Each line above creates one table in the database */
echo "<p>Database created.</p>";

$sql = "INSERT OR REPLACE INTO 'mydefinitions' VALUES ('AJAX','Acronym for Asynchronous JavaScript and XML, which allows data exchange between web browser and server without a web page being reloaded.')";
$db->exec($sql) or die('add data failed');

$sql = "INSERT OR REPLACE INTO 'mydefinitions' VALUES ('Cache','Stored data that can be accessed locally from a web application.')";
$db->exec($sql) or die('add data failed');

$sql = "INSERT OR REPLACE INTO 'mydefinitions' VALUES ('client','A client is an application or system that requests and accesses a service made available by a server.')";
$db->exec($sql) or die('add data failed');

$sql = "INSERT OR REPLACE INTO 'mydefinitions' VALUES ('CSS','Cascading Style sheets - CSS The style language used with HTML 4.1 and XHTML 1.0')";
$db->exec($sql) or die('add data failed');

$sql = "INSERT OR REPLACE INTO 'mydefinitions' VALUES ('dynamic','Website content that changes over time or in response to user interactions and/or preferences')";
$db->exec($sql) or die('add data failed');

$sql = "INSERT OR REPLACE INTO 'mydefinitions' VALUES ('GPX','An XML data format for the interchange of GPS data.')";
$db->exec($sql) or die('add data failed');


require 'html5tail.php';
?>
