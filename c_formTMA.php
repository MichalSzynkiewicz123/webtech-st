 <?php
if ( !defined( 'ISITSAFETORUN' ) ) {
  //http_response_code(404);
  die( '' ); // and issue a 404 page not found
}
?>
<div class="report">Generating an input form to match the columns in the table <?php
echo $mytable;
?> . In script c_form.php</div>
<?php
//setup an empty data array to match form fields
$section   = "";
$thisquery = "SHOW COLUMNS FROM $mytable";
$result = mysqli_query( $dbhandle, $thisquery ) or die( " Could not action the query " . $thisquery );
while ( $myrow = mysqli_fetch_array( $result ) ) {
  $row[ $myrow[ 0 ] ] = ""; //create an empty array value for each column in database
}
?>
<div class="report">Check first to see if we are editing an existing record. Note we should also authenticate the user before we permit edit or update of any record.</div>
<?php
if ( !$valid ) {
  echo "<h1>Errors in form - message from server</h1>";
}
//if($valid){echo "<h1>No errors in form - message from server</h1>";}
if ( !empty( $webdata[ 'action' ] ) ) {
  if ( $webdata[ 'action' ] == 'save' ) {
    $webdata[ 'editid' ] = "";
  }
}
if ( !empty( $webdata[ 'editid' ] ) ) {
  $sql = "SELECT id, firstname, lastname , email, comments FROM $mytable WHERE id = ?";
  if ( $stmt = $dbhandle->prepare( $sql ) ) {
    $stmt->bind_param( "s", $webdata[ 'editid' ] );
    $stmt->execute();
    $result = $stmt->get_result();
    if ( $result->num_rows > 0 ) {
      $row = $result->fetch_array( MYSQLI_ASSOC );
    }
  }
  if ( $webdata[ 'action' ] == 'delete' ) {
?>
   <div class="report">Action to delete has been confirmed.In script c_form.php</div>
    <h2>Confirm delete this existing data record</h2>
    <form method="post" action="<?php
    echo htmlspecialchars( $_SERVER[ "PHP_SELF" ] );
?>"  name = "tt284guestformdelete<?php
    echo $row[ "id" ];
?>" >
    <input type="hidden" name= "editid" id= "editid" value="<?php
    echo $row[ "id" ];
?>" >
    <input type="hidden" name= "action" id= "confirmdelete" value="confirmdelete" >
    <p class="delete"><label for="submitdelete">DELETE: <?php
    echo $row[ "id" ] . "  " . htmlspecialchars( $row[ "firstname" ] ) . "  " . htmlspecialchars( $row[ "lastname" ] );
?></label><input type="submit" class="delete" name="submitdelete" id="submitdelete" value="Confirm Delete:  <?php
    echo $row[ "id" ] . "  " . htmlspecialchars( $row[ "firstname" ] ) . "  " . htmlspecialchars( $row[ "lastname" ] );
?>"></p>
    </form>
    <?php
  } elseif ( $webdata[ 'action' ] == 'edit' ) {
    //Create a form that allows this row to be deleted, and then create the form to edit the data item.
?>

    <form method="post" action="<?php
    echo htmlspecialchars( $_SERVER[ "PHP_SELF" ] );
?>"  name = "tt284guestformdelete<?php
    echo $row[ "id" ];
?>" >
    <input type="hidden" name= "editid" id= "editid" value="<?php
    echo $row[ "id" ];
?>" >
    <input type="hidden" name= "action" id= "action" value="delete" >
    <p><label for="delete">Delete: </label><input type="submit" name="delete" id="delete" value="Delete Record:  <?php
    echo $row[ "id" ] . "  " . htmlspecialchars( $row[ "firstname" ] ) . "  " . htmlspecialchars( $row[ "lastname" ] );
?>"></p>
    </form>
    <div class="report">Action to edit has been confirmed.In script c_form.php</div>
     <h2>Edit an existing data record</h2>
<?php
  }
} else {
  if ( $valid ) {
?>

    <p> </p>
    <label for="sectionb" class="showhide">Show Hide: Enter a new record</label>
    <input type="checkbox" id="sectionb" value="button" style="display:none;"/>
    <section id="bsection">
    <h3>Data Entry Form</h3>
     <?php
    $section = "</section>";
  }
}
?>

<form method="post" action="
<?php
  echo htmlspecialchars( $_SERVER[ "PHP_SELF" ] );
?>"
onsubmit = "return validate()" name = "tt284guestform
<?php
  echo $row[ "id" ];
?>" >
    <label for="firstname">First name: </label>
    <input type="text" name="firstname" id="firstname" placeholder="firstname" required maxlength="30" minlength="1" value="<?php
if ( $valid ) {
  echo htmlspecialchars( $row[ "firstname" ] );
} else {
  echo htmlspecialchars( $webdata[ "firstname" ] );
}
?>" onchange="myFunction(this.id , this.value, 'as')">
    <span id="fbfirstname">
    </span><?php
if ( !$valid ) {
  echo $formerror[ "firstname" ];
}
?>
   <p><label for="lastname">Last name: </label>
    <input type="text" name="lastname" id="lastname" placeholder="lastname" required maxlength="30" minlength="1" value="<?php
if ( $valid ) {
  echo htmlspecialchars( $row[ "lastname" ] );
} else {
  echo htmlspecialchars( $webdata[ "lastname" ] );
}
?>" onchange="myFunction(this.id , this.value, 'lnamereg')"><!-- NEW code for last name -->
    <span id="fblastname">  </span>
    <?php
if ( !$valid ) {
  echo $formerror[ "lastname" ];
}
?></p>
    <p><label for="email">Email: </label>
    <input type="email" name="email" id="email" placeholder="email"  maxlength="50" minlength="4" value="<?php
if ( $valid ) {
  echo htmlspecialchars( $row[ "email" ] );
} else {
  echo htmlspecialchars( $webdata[ "email" ] );
}
?>" onchange="myFunction(this.id , this.value, 'reg')">
    <span id="fbemail">  </span><?php
if ( !$valid ) {
  echo $formerror[ "email" ];
}
?></p>
<!-- NEW code for display comments -->
<p><label for="comments">Comments: </label>
    <textarea cols="30" rows="30" name="comments" id="comments" placeholder="comments" maxlength="65000" onchange="myFunction(this.id , this.value, 'as')" ><?php
if ( $valid ) {
    echo htmlspecialchars( $row[ "comments" ] );
} else {
    echo htmlspecialchars( $webdata[ "comments" ] );
}
?></textarea>
    <span id="fbcomments">  </span></p>
    <?php
    if ( !$valid ) {
    echo $formerror[ "comments" ];
    }
    ?>
    <p><label for="submit">Submit: </label>
    <input type="submit" name="submit<?php
echo $row[ "id" ];
?>" id="submit" value="Check and Submit from <?php
echo htmlspecialchars( $_SERVER[ "PHP_SELF" ] );
?>"></p>
    <input type ="hidden" name = "editid" id= "editid" value = "<?php
if ( $valid ) {
  echo $row[ "id" ];
} else {
  echo $webdata[ "id" ];
}
?>" >
    <input type ="hidden" name = "action" id= "action" value = "save" >
</form><script>validateall();</script>
<?php
echo $section;
?>
