<?
session_start('oid');
$_SESSION['active'] = true;
define('BASE_PAGE', true );

$studentID = $_GET['shuid'];
//echo $studentID;
//if ( ! preg_match('/[0-9]{8}/', $studentID, $match) ) die "bogus entry";

if ( ! preg_match('/[0-9]{8}/', $studentID, $match) ) {
  //no student is logged in;
}
//else echo $studentID;
$thisStudent = $match[0];
//echo ' now ' . $thisStudent;
define('BASE_PAGE', true );
$debug = 0;

if ( 1 == $debug ) {
  if ( is_file('/var/www/html/projects/laptops/includes/db.php')) echo "file exists";
  else echo "file does not exist";
}

if ( ! include_once('/var/www/html/projects/laptops/includes/db.php') ) echo "couldn't include file.";
elseif ( 1 == $debug ) echo 'included db.php';

if ( ! $statusResults = $link->prepare("SELECT formResponses.parentalConsent, formResponses.parentSignature, 
  students.sn, students.fn, students.mi
  FROM formResponses  LEFT JOIN students ON 
  formResponses.ID=students.ID WHERE formResponses.ID=? LIMIT 1")) {
  if ( 1 == $debug ) echo "Prepare failed: (" . $link->errno . ") " . $link->error . "\n";
}
if ( ! $statusResults->bind_param('s', $thisStudent ) ) {
  if ( 1 == $debug ) echo "Bind param failed: (" . $link->errno . ") " . $link->error . "\n";
}
if ( ! $statusResults->execute() ) {
  if ( 1 == $debug ) echo "Execute failed: (" . $link->errno . ") " . $link->error . "\n";
}

if ( ! $statusResults->bind_result($pc,$ps,$sn,$fn,$mi) ) { //$pc is a date
  if ( 1 == $debug ) echo "Bind result failed: (" . $link->errno . ") " . $link->error . "\n";
}
if ( ! $statusResults->fetch() ) {
  if ( 1 == $debug ) echo "Fetch failed: (" . $link->errno . ") " . $link->error . "\n";
}
if ( ! $statusResults->close() ) {
  if ( 1 == $debug ) echo "Close failed: (" . $link->errno . ") " . $link->error . "\n";
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Laptop Permission Form for Minor Students</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/custom.css">
    <link rel="stylesheet" media="print" type="text/css" href="/projects/laptops/css/print.css" />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->     
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->     
    <!--[if lt IE 9]>       
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>       
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>     
    <![endif]-->   
  </head>   
<body id="permissionPage">   
  
  <? include('includes/navbar.htm') ?>
  <div class="container-fluid">
       <div class="row logo">
          <div class="col-lg-12">
            <strong class="logo"><a href="http://www.shu.edu"><span class="hidden">Seton Hall University</span><img alt="Seton Hall University" src="img/university-logo-desktop.png"></a></strong>
          </div>
       </div>
     </div>
     <div class="container">
       <div class="row">
              <div class="col-lg-9 col-md-7 col-sm-12 col-xs-12">           
<h1>Laptop Permission Form for Minor Students</h1> 
     
 
<p>Welcome to Seton Hall University!  As a full-time undergraduate student at Seton Hall University, your son or
daughter will be participating in the Mobile Computing Program.  As a participant in the Mobile Computing Program, your
son / daughter will be issued a laptop.  If your son / daughter is under 18 years of age, making him / her a minor, you
must sign this form to indicate that you are giving your permission for your son or daughter to pick up the SHU issued
laptop and to sign the License Agreement.  <strong>Students under the age of 18 will not be able to pick up the laptop
until we receive this form.</strong>  </p>

<form id="permissionForm">
   <fieldset>
        <legend>I hereby give permission for my daughter / son 
        </legend>
        To sign a license
agreement for a Seton Hall University issued laptop. I understand she / he will be signing a contract to license the use
of a laptop from the university and will have to abide by the terms and conditions outlined in that agreement. 
        <div class="form-group">
          <label for="parentName">Parent Name</label>
          <input type="text" class="form-control" id="parentName" name="parentName" <?
            if ( ! empty($ps) ) {
              echo 'value="' . $ps . '" disabled="disabled"';
              }
              else {
              echo 'placeholder="Your Name" ';
           } ?> />
        </div>
        <div class="form-group">
          <label for="sigDate">Date</label>   
          <input type="text" class="form-control" id="sigDate" name="sigDate" value="<? 
            if ( $pc == '0000-00-00 00:00:00' ) {
              echo date('F j, Y') ;
            }
            else {
              echo date('F j, Y', strtotime($pc));

            }
        ?>" disabled="disabled" />
        </div>
        <div class="form-group">
          <label for="studentName">Student Name</label>
          <input type="text" class="form-control" id="studentName" name="studentName" value="<? 
            echo "$fn ";
            if ( strlen($mi) > 0 ) echo "$mi ";
            echo "$sn"
            ?>" disabled="true" />
        </div>

        <div class="form-group">
          <label for="studentID">Student's SHU ID Number</label>
          <input type="text" class="form-control" id="studentID" name="studentID" value="<? echo $thisStudent ?>" disabled="true" />
        </div>

  </fieldset>
  <fieldset>
    <button type="button" id="permissionGranted" class="access btn btn-lg btn-primary" disabled="disabled"><? 
      if ( $pc == '0000-00-00 00:00:00' ) {
        echo "Please Complete Above";  
      } 
      else echo "Thank you for your permission"; ?></button>
  </fieldset>
</form>


<div id="resultMessage"></div>


    </div>     <!-- end left column -->

    <div class="col-lg-3  col-md-5 col-sm-12 col-xs-12 sidebar"> 
      <h3>Seton Hall Mobile Computing</h3>     
      <h4>Asset Management Office</h4>
<p>Corrigan Hall, Room 27<br>
Seton Hall University<br>
400 South Orange Ave<br>
South Orange, NJ 07079<br>
Phone: 973-313-6181<br>
Email: <a href="mailto:assets@shu.edu">assets@shu.edu</a>
</p>
    </div>
  </div>


</div><!-- End container-fluid -->
<? include('includes/footer.htm') ?>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
  </body>
</html> 