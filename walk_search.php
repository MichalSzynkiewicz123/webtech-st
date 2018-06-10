<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width" />
  <title>Open University Running Club</title>
  <link href="walk_proposal_form.css" rel="stylesheet"  type="text/css"/>
</head>
<body>
  <div id="page">
    <header id="header">
      <div id="loginsB">
        <button id="sign">Sign in</button>
        <button id="login">Login</button>
      </div>
      <div id="title"><span>Open University Running Club</span></div>

    </header>
    <div id="navbar" >
            <div class="hmenu" ><a href="">Home</a></div>
            <div class="hmenu"><a href="">Add Walk</a></div>
            <div class="hmenu"><a href="">Profile</a></div>
            <div class="hmenu"><a href="">New member Request</a></div>
    </div>
    <main>
      <div id="page_content">
        <div id="formHolder">
          <form name="formSearch" class="" action="walk_search.php" method="post" id="form">
              <h2 style="text-align: center;">Walk Search</h2>
              <p>Number of days from now:<input type="Number" name="days" /></p>
              <p><input type="submit" name="Search" value="Search"/>
              <?php
                echo $formerror['number'];
              ?>
            </form>
            <div id="result" style="overflow:auto; height:60vh;">
            <?php
              if(isset($_POST['Search'])){
                define('ISITSAFETORUN', TRUE);
                error_reporting(E_ALL);
                ini_set('display_errors', 1);
                $formerror['number'] = '';
                $valid = TRUE;
                if (isset($_POST['days'])){
                  if (!preg_match("/^-?[0-9]\d*(\.\d+)?$/", $_POST['days'])){
                    $formerror['number'] = '<span class="warn" >Not valid on server: Only white space and numbers allowed</span>';
                    $valid   = FALSE;
                    }
                }
                if($valid){
                  $databasename ='walkingclub.sqlite';
                  $db = new SQLite3($databasename);
                  $limit = new DateTime();
                  $limit->modify($_POST['days'] . ' day');
                  $limit = $limit->format('Y-m-d');
                  if($_POST['days'] < 0){
                    $sql='select * from walk where walk_date < :today and walk_date > :limit' ;
                    $stmt = $db->prepare( $sql);
                    $stmt->bindValue(":today" , date("Y-m-d") , SQLITE3_TEXT);
                    $stmt->bindValue(":limit" , $limit , SQLITE3_TEXT);
                  }elseif ($_POST['days'] > 0) {
                    $sql='select * from walk where walk_date > :today and walk_date < :limit';
                    $stmt = $db->prepare( $sql);
                    $stmt->bindValue(":today" , date("Y-m-d") , SQLITE3_TEXT);
                    $stmt->bindValue(":limit" , $limit , SQLITE3_TEXT);
                  }
                  $result = $stmt->execute();
                  while ($row = $result->fetchArray()){
            ?>
                    <table style="width: 70%; border: 1px solid black; margin: 0 auto; background-color:white; min-width:400px; margin-bottom: 20px; margin-top: 5px; max-width: 500px;">
                      <tr  style="outline: thin solid">
                        <td  style="width: 50%;">Name of the walk</td>
                        <td><?php echo '<p>' . htmlspecialchars($row['name']); ?></td>
                      </tr>
                      <tr  style="outline: thin solid">
                        <td style="width: 50%;">Date</td>
                        <td><?php echo '<p>' . htmlspecialchars($row['walk_date']); ?></td>
                      </tr>
                      <tr  style="outline: thin solid">
                        <td style="width: 50%;">Start time</td>
                        <td><?php echo '<p>' . htmlspecialchars($row['start_time']); ?></td>
                      </tr>
                      <tr  style="outline: thin solid">
                        <td style="width: 50%;">Leader</td>
                        <td><?php echo '<p>' . htmlspecialchars($row['leader']); ?></td>
                      </tr>
                      <tr  style="outline: thin solid">
                        <td style="width: 50%;">Meeting point</td>
                        <td><?php echo '<p>' . htmlspecialchars($row['meeting_point']); ?></td>
                      </tr>
                      <tr  style="outline: thin solid">
                        <td style="width: 50%;">Lat long</td>
                        <td><?php echo '<p>' . htmlspecialchars($row['meeting_latlong']);?></td>
                      </tr>
                      <tr  style="outline: thin solid">
                        <td style="width: 50%;">Distance for the walk in miles</td>
                        <td><?php echo '<p>' . htmlspecialchars($row['distance']); ?></td>
                      </tr>
                      <tr  style="outline: thin solid">
                        <td style="width: 50%;">Route</td>
                        <td><?php echo '<p>' . htmlspecialchars($row['route']); ?></td>
                      </tr>
                      <tr  style="outline: thin solid">
                        <td style="width: 50%;">Notes</td>
                        <td><?php echo '<p>' . htmlspecialchars($row['notes']); ?></td>
                      </tr>
                      <tr style="outline: thin solid">
                        <td style="width: 50%;">Status</td>
                        <td><?php echo '<p>' . htmlspecialchars($row['status']); ?></td>
                      </tr>
                    </table>
              <?php
                  }
               }
             }
            ?>
          </div>
        </div>
      </main>
    </div>
    <footer id="footer">
      <a href="">Privacy</a> |
      <a href="">Contact</a> |
      <a href="">FAQs</a> |
      <a href="">Copyright</a> |
      <a href="">Conditions of use</a>
    </footer>
  </body>
