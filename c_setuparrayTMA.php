
<div class="report">Setting up an array to match each column in the database table. In script c_setuparray.php</div>
<?php
//setup our clean data array to match form fields
$thisquery = "SHOW COLUMNS FROM $mytable";
$result = mysqli_query( $dbhandle, $thisquery ) or die (" Could not action the query " . $thisquery );
while ($row = mysqli_fetch_array($result)) {
	
	//echo "<p>Column: " . $row[0] . "</p>"; //note that there is only one item in each row, so the first item is item zero
	$webdata[ $row[0] ] = ""; //create an empty array value for each column in database
}

?>
<div class="report">The array to match each column in the database table has been created. In script c_setuparray.php</div>
