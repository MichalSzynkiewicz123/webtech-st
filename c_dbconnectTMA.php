<div class="report">Start of script  c_dbconnect.php connecting to database</div>
<?php
$dbhandle = mysqli_connect( $hostname, $username, $password ) or die( "Unable to connect to MySQL");
$selected = mysqli_select_db(  $dbhandle, $mydatabase ) or die("Unable to connect to " . $mydatabase );
echo "<div class=\"report\">Connected to MySQL database {$mydatabase}</div>"
?>
