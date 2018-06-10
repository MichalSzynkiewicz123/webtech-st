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
            <form method="post" action="
                <?php
                  echo htmlspecialchars( $_SERVER[ "PHP_SELF" ] );
                ?>" id="form" >
                <input type=hidden name=sessionID value="ABCDEF012345">
                <h3 style="text-align:  center;">Walk Proposal Form</h3>

                <p><label for="walk">Walk</label>
        				  <input type="text" name="walk"   id="walk"  oninvalid="this.setCustomValidity('Please set a walk name')" onchange="this.setCustomValidity('')" required maxlength="20" minlength="2" value="" >
                  <span>&nbsp;</span>
        				</p>

        				<p><label for="dateofwalk">Date of Walk</label>
        				  <input type="date" name="walk_date" id="walk_date" oninvalid="this.setCustomValidity('Please put valid date.')" onchange="this.setCustomValidity('')" required >
                  <script>
                    var today = new Date();
                    var dd = today.getDate();
                    var mm = today.getMonth()+1;
                    var yyyy = today.getFullYear();
                     if(dd<10){
                            dd='0'+dd
                        }
                        if(mm<10){
                            mm='0'+mm
                        }
                    today = yyyy+'-'+mm+'-'+dd;
                    document.getElementById("walk_date").setAttribute("min", today);
                  </script>
                  <span>&nbsp;</span>
                </p>

                <p><label for="timeofwalk">Time of Walk</label>
                  <input type="time" name="start_time"  oninvalid="this.setCustomValidity('Please put valid time.')" onchange="this.setCustomValidity('')" required >
                  <span>&nbsp;</span>
                </p>

                <p><label for="leader">Leader</label>
        				  <input type="text" name="leader"  oninvalid="this.setCustomValidity('We do need your the name of leader')" onchange="this.setCustomValidity('')" required maxlength="20" minlength="2" value="" >
                      <span>&nbsp;</span>
        				</p>

                <p><label for="meetingPoint">Meeting point</label>
        				  <input type="text" name="meetingPoint" oninvalid="this.setCustomValidity('Please provide adrress')" onchange="this.setCustomValidity('')" required maxlength="20" minlength="2" value="" >
                  <span>&nbsp;</span>
                </p>

                <p>
                  <input type=hidden name=meeting_latlong value="" oninvalid="this.setCustomValidity('Please mark the meeting point')" onchange="this.setCustomValidity('')" required>
                  <div id="map" style="width:100%;height:300px;"></div>
                  <script>
                  var marker;
                  var infowindow;

                  function myMap() {

                    var mapCanvas = document.getElementById("map");
                    var myCenter=new google.maps.LatLng(51.508742,-0.120850);
                    var mapOptions = {center: myCenter, zoom: 5};
                    var map = new google.maps.Map(mapCanvas, mapOptions);
                    google.maps.event.addListener(map, 'click', function(event) {
                      placeMarker(map, event.latLng);
                    });
                  }
                  function placeMarker(map, location) {
                    if(marker == null){
                      marker = new google.maps.Marker({position: location, map: map  });
                    }else{
                      marker.setPosition(location);
                    }
                    if(infowindow == null){
                      infowindow = new google.maps.InfoWindow({ content: 'Latitude: ' + location.lat() + '<br>Longitude: ' + location.lng() });
                      infowindow.open(map,marker);
                    }else{
                      infowindow.setContent('Latitude: ' + location.lat() + '<br>Longitude: ' + location.lng());
                    }
                    document.getElementById("meeting_latlong").value = location.lat() + ', ' + location.lng()
                  }

                  </script>
                  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyANdp6QZhatL-875-CmoO4G4qGg8qbDQa0&callback=myMap"></script>
                </p>

                <p><label for="distance">Distance</label>
                  <input type="text" name="distance" oninvalid="this.setCustomValidity('Please provide distance')" onchange="this.setCustomValidity('')" required maxlength="20" minlength="2" value="" >
                  <span>&nbsp;</span>
                </p>

                <p><label for="route">Route</label>
                  <input type="text" name="route"  oninvalid="this.setCustomValidity('Please provide route')" onchange="this.setCustomValidity('')" required maxlength="20" minlength="2" value="" >
                  <span>&nbsp;</span>
                </p>

                <p><label for="notes">Notes</label>
                  <input type="text" name="notes" >
                </p>
                <div  style="text-align: right;">
                  <input type="reset" name="reset" value="Reset" />
                  <input type="submit" value="Submit" name="Submit">
                </div>
                <div id="result">
                <?php
                    if(isset($_POST['Submit'])){
                      define('ISITSAFETORUN', TRUE);
                      $databasename ='walkingclub.sqlite';
                      $db = new SQLite3($databasename);
                      if (!empty($_POST)){
                        error_reporting(E_ALL);
                        ini_set('display_errors', 1);
                        $status = 'PROPOSED';
                  			$smt = $db->prepare("INSERT INTO walk ( name, walk_date, start_time, leader, meeting_point, meeting_latlong, distance, route, notes, status) values (  :name, :walk_date, :start_time, :leader, :meeting_point, :meeting_latlong, :distance, :route, :notes, :status)");
                  			$smt->bindValue(':name', $_POST['walk'], SQLITE3_TEXT);
                  			$smt->bindValue(':walk_date', $_POST['walk_date'], SQLITE3_TEXT);
                  			$smt->bindValue(':start_time', $_POST['start_time'], SQLITE3_TEXT);
                  			$smt->bindValue(':leader', $_POST['leader'], SQLITE3_TEXT);
                  			$smt->bindValue(':meeting_point', $_POST['meetingPoint'], SQLITE3_TEXT);
                  			$smt->bindValue(':meeting_latlong',$_POST['meeting_latlong'], SQLITE3_TEXT);
                  			$smt->bindValue(':distance', $_POST['distance'], SQLITE3_TEXT);
                  			$smt->bindValue(':route', $_POST['route'], SQLITE3_TEXT);
                  			$smt->bindValue(':notes', $_POST['notes'], SQLITE3_TEXT);
                        $smt->bindValue(':status',$status, SQLITE3_TEXT);
                  			$smt->execute() or die('Add data failed');
                      }
                    }
                ?>
              </div>
            </form>
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
