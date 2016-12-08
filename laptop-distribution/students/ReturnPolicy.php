<?
session_start('oid');
define('BASE_PAGE', true );
$_SESSION['active'] = true;
$_SESSION['shuID'] = $_SERVER['AUTHENTICATE_EMPLOYEEID'];

include_once('/var/www/html/projects/laptops/includes/db.php');
$debug = 0;

if ( ! $statusResults = $link->prepare("SELECT returnPolicy
  FROM formResponses  WHERE formResponses.ID=? LIMIT 1")) {
  if ( 1 == $debug ) echo "Prepare failed: (" . $link->errno . ") " . $link->error . "\n";
}
if ( ! $statusResults->bind_param('s', $_SESSION['shuID'] ) ) {
  if ( 1 == $debug ) echo "Bind param failed: (" . $link->errno . ") " . $link->error . "\n";
}
if ( ! $statusResults->execute() ) {
  if ( 1 == $debug ) echo "Execute failed: (" . $link->errno . ") " . $link->error . "\n";
}

if ( ! $statusResults->bind_result($rp) ) {
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
    <title>Laptop Return Policy</title>

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/custom.css">
    <link rel="stylesheet" media="print" type="text/css" href="../css/print.css" />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->     
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->     
    <!--[if lt IE 9]>       
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>       
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>     
    <![endif]-->   
  </head>   
<body id="rp">   
  
  <? include('../includes/navbar.htm') ?>

  <div class="container-fluid">
       <div class="row logo">
          <div class="col-lg-12">
            <strong class="logo"><a href="http://www.shu.edu"><span class="hidden">Seton Hall University</span><img alt="Seton Hall University" src="../img/university-logo-desktop.png"></a></strong>
          </div>
       </div>
     </div>
     <div class="container">
       <div class="row">
              <div class="col-lg-9 col-md-7 col-sm-12 col-xs-12">           
<h1>Laptop Return Policy</h1>  
 
<!-- begin list -->
<p>As a full-time undergraduate student at Seton Hall, you will be participating in the Mobile Computing Program.  As a participant, you will be issued a laptop to use during your studies at Seton Hall University.  </p>
<p>Seton Hall University has decided to distribute laptops during Pirate Adventure before the start of semester.  This will give the students the opportunity to become familiar with the laptop during the summer months so that you can hit the ground running in August. In return, we ask that if you decide not to attend Seton Hall University, that you return the laptop along with all of the accessories issued with the computer no later than August 4, 2016.  Please sign and date this document to verify that you have read, understand and agree to the conditions outlined below:</p>
<ul>
<li> I understand that I will pick up the laptop during Pirate Adventure.  </li>
<li> If I decide not to attend Seton Hall University, I understand that it is my responsibility to return the laptop, along with all of the accessories received, to Seton Hall University.  </li>
<li> I understand that I must return the laptop to the Asset Management Office located in Corrigan Hall Room 27 no later than 4:00 pm on Thursday, August 4, 2016.  The hours of operation for the Asset Management Office are Monday &ndash; Thursday, 9:00 am &ndash; 4:00 pm and Friday, 9:00 am &ndash; 12:00 pm.</li>
<li> If I am not able to return the laptop in person, it is my responsibility to contact the Asset Management Office to make alternate arrangements so that the laptop is returned by 4:00 pm on August 4, 2016.  The Asset Management Office phone number is 973-313-6181.</li>
<li> I understand that if I decide not to attend Seton Hall University for the Fall 2016 semester and I fail to return the laptop by 4:00 pm on August 4, 2016, I am liable for the full cost of the laptop and accessories. </li>
<li> I understand that once I have been charged the full cost for failure to return the laptop, the fee is non-refundable and I will no longer be able to return the laptop to Seton Hall University.</li>
</ul>


<!-- end list -->

<!-- begin form -->

<form id="formAcceptance">
<fieldset>
  <legend>Agreement</legend>
          <div class="form-group col-xs-6">
          <label for="studentName">Student Name</label>
          <input type="text" disabled="disabled" class="form-control" value="<? echo $_SERVER['AUTHENTICATE_GIVENNAME'] . ' ';
  if ( ! empty( $_SERVER['AUTHENTICATE_MI'] ) ) echo $_SERVER['AUTHENTICATE_MI'] . ' ';
  echo $_SERVER['AUTHENTICATE_SN']; ?>"/>
        </div>
 
  <div class="form-group col-xs-4">
          <label for="sigDate">Date</label>   
          <input type="text" class="form-control" id="sigDate" name="sigDate" value="<? 
            if ( '0000-00-00 00:00:00' == $rp ) echo date('F j, Y');
            else echo date('F j, Y', strtotime($rp));

            ?>">
        </div>

</fieldset>
<fieldset>

  <label><input type="checkbox" name="accept" value="yes" id="accept" 
    <? if ( '0000-00-00 00:00:00' != $rp ) echo ' checked="checked" disabled="disabled"'; ?> />By checking this box, 
    I accept the terms and conditions outlined above and agree to abide by them.</label> 

<button type="button" id="verification" class="access btn btn-lg btn-primary" disabled="disabled"><? 
      if ( '0000-00-00 00:00:00' != $rp ) echo 'Thank you, this form has been completed';
      else echo 'Please Check The Box';
      ?></button></fieldset>
</form>

<div id="resultMessage"></div>

<div id="backlinks"><h4><a href="/projects/laptops/students">Return to form list</a>.</h4></div>
<!-- end form -->



    </div>     <!-- end left column -->

    <div class="col-lg-3  col-md-5 col-sm-12 col-xs-12 sidebar"> 


   <h3>Seton Hall Mobile Computing</h3>     
      <h4>Asset Management Office</h4>
<address>Corrigan Hall, Room 27<br>
Seton Hall University<br>
400 South Orange Ave<br>
South Orange, NJ 07079<br>
Phone: 973-313-6181<br>
Email: <a href="mailto:assets@shu.edu">assets@shu.edu</a></address>


    </div>
  </div>


</div><!-- End container-fluid -->

<? include('../includes/footer.htm') ?>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/custom.js"></script>
  </body>
</html> 