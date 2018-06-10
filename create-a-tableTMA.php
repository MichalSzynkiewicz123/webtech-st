<?php
define( 'ISITSAFETORUN', TRUE );
?>
<!doctype html>
<head>
</head>
<body>
<h1>create-a-table.php</h1> 
<?php
echo "Confirm that PHP is running on this server";
?>
<p>Now connect to the database - insert your own details in the file mydatabaseTMA.php. These details are on the welcome page of your server</p>
<?php
require "mydatabaseTMA.php";
//connect to this host
$dbhandle = mysqli_connect( $hostname, $username, $password ) or die( "Unable to connect to MySQL" );
echo "<p>Connected to MySQL</p>";
?>
<?php
//select a database to work with
$selected = mysqli_select_db( $dbhandle, $mydatabase ) or die( "Unable to connect to " . $mydatabase );
echo "<p>Connected to MySQL database " . $mydatabase . "</p>";
?>
<p>Now let's see what is in the database</p>
<?php
$thisquery = "SHOW TABLES FROM " . $mydatabase; // This is the SQL instruction
$result = mysqli_query( $dbhandle, $thisquery ) or die( " Could not action the query " . $thisquery );
while ( $row = mysqli_fetch_array( $result ) ) {
  echo "<p>Table: " . $row[ 0 ] . "</p>"; //note that there is only one item in each row, so the first item is item zero
}
?>

<p>Now create our own table for testing. </p>

<?php
// sql to create table
$sql = "CREATE TABLE IF NOT EXISTS ms29946 (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
firstname VARCHAR(30) NOT NULL,
lastname VARCHAR(30) NOT NULL,
email VARCHAR(50),
comments TEXT
)";
if ( mysqli_query( $dbhandle, $sql ) ) {
  echo "Table ms29946 created successfully, or already exists";
} else {
  echo "Error creating table: " . mysqli_error( $dbhandle );
}
mysqli_close( $dbhandle );
?>
</body>
</html>


