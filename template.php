<!DOCTYPE html>
<html lang = "en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="template.css">
  <title>Responsive page template</title>
</head>
<body>
  <nav id="menu">
    <ul id="main-menu">
      <li><a href="">Search</a></li>
      <li><a href="">Add</a></li>
      <li><a href="">Edit/Delete</a></li>
    </ul>
  </nav>
<main class="main-content">
  <form name="formSearch" class="" action="template.php" method="post">Search for Term
    <p>Term:<input type="text" name="term" /></p>
    <p><input type="submit" name="Search" value="Search"/>
  </form>
  <div id="result">
    <?php
    if(isset($_POST['Search']))
    {
      define('ISITSAFETORUN', TRUE);
      error_reporting(E_ALL);
      ini_set('display_errors', 1);
      $databasename ='techdefs.sqlite';
      $stylesheet = '';
      $javascript ='';
      $mycss='';
      $pagetitle = 'Extract data from Table';
      require 'html5head.php';//do not edit this row
      require 'opendatabase.php';//do not edit this row
      require 'sformdata.php';//do not edit this row
      $webdata['term'] = $_POST['term'];;// this row sets your search term to be any term that contains the letter 's'.
      echo "<p>Database opened. Now reading some data back from the database to confirm it is working</p>";
      $sql='select term , definition from mydefinitions where term like :term'; //do not edit this row
      $stmt = $db->prepare( $sql); //do not edit this row
      $stmt->bindValue(":term" , '%'.$webdata['term'].'%' , SQLITE3_TEXT); //do not edit this row
      $result = $stmt->execute(); //do not edit this row
      while ($row = $result->fetchArray()){ //do not edit this row
          echo '<p>' . htmlspecialchars($row['term'])  . " : " . htmlspecialchars($row['definition']).'</p>';
      }
    }
    ?>

  </div>
  <form name="formAdd" class="" action="template.php" method="post">Add new Term
    <p>Term:<input type="text"/></p>
    <p>Definition:<input type="text"/></p>
    <p><input type="button" name="Add" value="Add"/>
  </form>
  <form name="formEditDelete" class="" action="template.php" method="post">Edit or Delete Term
    <p>Term:<input type="text"/></p>
    <p>Definition:<input type="text"/></p>
    <p><input type="submit" name="Edit" value="Edit"/>
    <p><input type="submit" name="Delete" value="Delete"/>
  </form>
</main>
<footer>
</footer>
</body>
</html>
