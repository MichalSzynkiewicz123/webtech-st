<?php define('ISITSAFETORUN', TRUE); ?>
<!doctype html>
<head>
</head>
<body>
<h1>show-columns-in-table.php - Now we will just look at ms29946 Table</h1> 
<h2> Check the code files carefully to see how the code produces the result, and read the comments in the code.</h2>
<?php 
echo"Confirm that PHP is running on this server";
?>
<p>Now connect to the database </p>
<?php
require "mydatabaseTMA.php";
//connect to this host
$dbhandle = mysqli_connect( $hostname, $username, $password ) or die( "Unable to connect to MySQL");
echo "<p>Connected to MySQL</p>"
?>
<?php
//select a database to work with
$selected = mysqli_select_db(  $dbhandle, $mydatabase ) or die("Unable to connect to " . $mydatabase );
echo "<p>Connected to MySQL database {$mydatabase}</p>"
?>
<p>Now let's see what is in the Table</p>
<?php
$thisquery = "SHOW COLUMNS FROM ms29946";
$result = mysqli_query( $dbhandle, $thisquery ) or die (" Could not action the query " . $thisquery );
while ($row = mysqli_fetch_array($result)) {
	echo "<p>Column: {$row[0]}</p>"; //note that there is only one item in each row, so the first item is item zero
}
?>
</body>
</html>


