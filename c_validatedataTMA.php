<?php
if (!defined('ISITSAFETORUN'))
  {
  die('');
  } //!defined('ISITSAFETORUN')
?>
<div class="report">Start of c_validatedata.php</div>
<p class="report">This script will validate data on the server.</p>
<?php
$formerror['firstname'] = '';
$formerror['lastname']  = '';
$formerror['email']     = '';
$formerror['comments'] = '';
$valid                  = TRUE; // set a variable to true at the start. If we find and error change it to false. At the end if there are any error messages, return the form and data and messages, but don't save.
//$firstname = $webdata['firstname'];
if (isset($webdata['firstname']))
  {
  if (!preg_match("/^[a-zA-Z ]{1,30}$/", $webdata['firstname']))
    {
    $formerror['firstname'] = '<span class="warn" >Not valid on server: Only letters and white space allowed </span>';
    //echo "Only letters and white space allowed";
    $valid                  = FALSE;
    } //!preg_match("/^[a-zA-Z ]{1,30}$/", $webdata['firstname'])
  } //isset($webdata['firstname'])
if (isset($webdata['lastname']))
  {
  if (!preg_match("/^[a-zA-Z ]{1,30}$/", $webdata['lastname']))
    {
    $formerror['lastname'] = '<span class="warn" >Not valid on server: Only letters and white space allowed</span>';
    $valid                 = FALSE;
    } //!preg_match("/^[a-zA-Z ]{1,30}$/", $webdata['lastname'])
  } //isset($webdata['lastname'])
if (isset($webdata['email']))
  {
  if (!filter_var($webdata['email'], FILTER_VALIDATE_EMAIL))
    {
    $formerror['email'] = '<span class="warn" >Not valid on server: invalid email format</span>';
    //echo "Invalid email format";
    $valid              = FALSE;
    } //!filter_var($webdata['email'], FILTER_VALIDATE_EMAIL)
  } //isset($webdata['email'])
if (isset($webdata['comments'])) //validation for the 'comments' field to accept all characters except for '&' and '#'.
  {
    if (!preg_match("/\&|\#/", $webdata['comments']))
      {

      } //(!preg_match("\&|\#/", $webdata['comments']))
      else{
        $formerror['comments'] = '<span class="warn" >Not valid on server: All characters except & and # </span>';
        //echo "All characters except & and #";
        $valid                  = FALSE;
      }
  }
function validateDate($date, $format = 'Y-m-d H:i:s')
  {
  $d = DateTime::createFromFormat($format, $date);
  return $d && $d->format($format) == $date;
  $valid = FALSE;
  } //http://php.net/manual/en/function.checkdate.php
//validateDate('2012-02-28', 'Y-m-d')
//validateDate('2012-02-28 12:12:12')
//validateDate('2012-02-28T12:12:12+02:00', 'Y-m-d\TH:i:sP')
?>
<div class="report">End of c_validatedata.php   $valid holds the value:<?php
echo $valid;
?> </div>
