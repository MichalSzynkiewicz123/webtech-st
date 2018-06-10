<?php
define('ISITSAFETORUN', TRUE);

error_reporting(E_ALL);
ini_set('display_errors', 1);

$databasename ='walkingclub.sqlite';
$db = new SQLite3($databasename);

echo '<p><b>Removing any existing SQLite walk database table...</b></p>';

$sql = 'DROP TABLE IF EXISTS "walk"';
$db->exec($sql) or die('Drop table failed');

echo '<p>Walk database table removed.</p>'; 
echo '<p><b>Creating new SQLite walk database table...</b></p>';

$columns = '"id" INTEGER PRIMARY KEY NOT NULL , "name" TEXT, "walk_date" TEXT, "start_time" TEXT, "leader" TEXT, "meeting_point" TEXT, "meeting_latlong" TEXT, "distance" TEXT, "route" TEXT , "notes" TEXT, "status" TEXT';

$sql = 'CREATE TABLE "walk" (' . $columns . ')';
$db->exec($sql) or die('Create table failed');

echo '<p>Walk database table created with columns:</p>'; 
echo "<p>$columns</p>";
echo '<p><b>Adding example data to the database table...</b></p>';

$sql="INSERT INTO walk VALUES (1,'South West Coast Path', '2018-01-13', '10:30:00', 'Peter T', 'Watcombe CP, off Watcombe beach road', '50.49642, -3.52058', '9', 'Watcombe to Shaldon via coast path and return on higher path', 'Steep hills and can be slippery', 'approved')";
$db->exec($sql) or die('Add data failed');

$sql="INSERT INTO walk VALUES (2,'Stake Pass', '2018-02-10', '10:30:00', 'James R', 'Old Dungeon Ghyll NT CP', '54.44543, -3.10186', '10', 'High Raise, Harrison Stickle, Pike of Stickle, Stake Pass', 'Icy on the tops but tremendous views', 'approved')";
$db->exec($sql) or die('Add data failed');

$sql="INSERT INTO walk VALUES (3,'Penyghent', '2018-03-17', '10:30:00', 'Sylvia D', 'Dale Head', '54.138672,-2.2433551', '10', 'Penyghent, Plover Hill, Foxup Moor, Penyghent Gill', 'Roadside parking', 'approved')";
$db->exec($sql) or die('Add data failed');

$sql="INSERT INTO walk VALUES (4,'Ickneild way and Chiltern way', '2018-04-14', '10:30:00', 'John F', 'Ivinghoe Common near Ringshall', '51.818477,-0.5792338', '8', 'Ickneild way and Chiltern way', 'Good views on a clear day', 'approved')";
$db->exec($sql) or die('Add data failed');

$sql="INSERT INTO walk VALUES (5,'Three Shires Head', '2018-05-19', '10:30:00', 'Joan M', 'Wildboarclough, near the church', '53.215863,-2.025255', '8.5', 'Wildboarclough and Three Shires Head', '', 'approved')";
$db->exec($sql) or die('Add data failed');

$sql="INSERT INTO walk VALUES (6,'Kinder Scout', '2018-06-16', '10:30:00', 'Chris L', 'Bowden Bridge car park near Hayfield', '53.379405,-1.9289984', '8', 'Kinder Scout circular walk', 'Rough path in places', '')";
$db->exec($sql) or die('Add data failed');

echo '<p>Data added to table:</p>'; 

echo '<pre>';
$results = $db->query("SELECT * FROM walk");
while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
    var_dump($row);
}
echo '</pre>';

?>
