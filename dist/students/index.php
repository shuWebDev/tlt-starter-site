<?
session_start(oid);
define('BASE_PAGE', true );
$_SESSION['active'] = true;
$_SESSION['shuID'] = $_SERVER['AUTHENTICATE_EMPLOYEEID'];

include_once('/var/www/html/projects/laptops/includes/db.php');
$debug = 0;


if ( ! $statusResults = $link->prepare("SELECT parentalConsent, returnPolicy, technologyUsage, termsConditions, laptopSelection, students.minor 
	FROM formResponses LEFT JOIN students ON formResponses.ID=students.ID WHERE formResponses.ID=? LIMIT 1")) {
	if ( 1 == $debug ) echo "Prepare failed: (" . $link->errno . ") " . $link->error . "\n";
}
if ( ! $statusResults->bind_param('s', $_SESSION['shuID'] ) ) {
	if ( 1 == $debug ) echo "Bind param failed: (" . $link->errno . ") " . $link->error . "\n";
}
if ( ! $statusResults->execute() ) {
	if ( 1 == $debug ) echo "Execute failed: (" . $link->errno . ") " . $link->error . "\n";
}

if ( ! $statusResults->bind_result($pc, $rp, $tu, $tc, $selection, $minor) ) {
	if ( 1 == $debug ) echo "Bind result failed: (" . $link->errno . ") " . $link->error . "\n";
}
if ( ! $statusResults->fetch() ) {
	if ( 1 == $debug ) echo "Fetch failed: (" . $link->errno . ") " . $link->error . "\n";
}
if ( ! $statusResults->close() ) {
	if ( 1 == $debug ) echo "Close failed: (" . $link->errno . ") " . $link->error . "\n";
}

//echo "$pc, $rp, $tu, $tc, $minor\n";
	?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Laptop Distribution Forms</title>

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/custom.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->     
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->     
    <!--[if lt IE 9]>       
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>       
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>     
    <![endif]-->   
  </head>   
<body id="homePage">   
  
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
<h1>Laptop Distribution</h1>           
 
<h2>Mandatory Laptop Forms</h2>
<p>Here is the status of the forms you need to complete.</p>
<? if (  'N'!= $minor ) { ?>
<p><input type="checkbox" value="permission" <?
	if ( '0000-00-00 00:00:00' != $pc ) echo ' checked=checked';
?> disabled='disabled' /> <a href="../permission.php?shuid=<? echo $_SESSION['shuID'] ?>">Laptop Permission Form for 
Parents of Minor Students</a></p>
<? } ?>
<p><input type="checkbox" value="terms" <?
	if ( '0000-00-00 00:00:00' != $tc ) echo ' checked=checked';
?> disabled='disabled' /> <a href="TermsAndConditions.php">Terms and Conditions</a></p>
<p><input type="checkbox" value="return" <?
	if ( '0000-00-00 00:00:00' != $rp ) echo ' checked=checked';
?> disabled='disabled' /> <a href="ReturnPolicy.php">Return Policy</a></p>
<p><input type="checkbox" value="usage" <?
	if ( '0000-00-00 00:00:00' != $tu ) echo ' checked=checked';
?> disabled='disabled' /> <a href="TechnologyUsagePolicy.php">Technology Usage Policy</a></p>

<!-- 
 <h2>Laptop Selection</h2> 
<? if ( empty($selection) ) { ?>
<p>Every incoming student will receive a Seton Hall laptop at Pirate Adventure in June. <strong>But did you know 
  that you can now choose between two laptop options?</strong></p>
  <p>Visit the <a href="selection.php">Class of 2020 Laptop Selection</a> page to learn more about your options. 
    When you're ready to make your choice, visit the selection page and make your choice. <strong>The deadline for freshmen to choose a laptop is May 9, 2016.</strong></p>
<? } 
  else {
    echo "<p>You have selected the <strong>Lenovo $selection Ultrabook</strong> as your laptop computer.</p>";
  }
?>
-->

<p>Please contact the Asset Management Office (contact info to the right) if you have any questions.</p>
<p>We look forward to seeing you in June!</p>
    
<h2>Key Dates</h2>

<ol>
 <!-- <li>May 9:    Laptop Selection Due</li> -->
  <li>June 10:    Deadline for all laptop forms</li>
</ol>


<h4>Orientation Dates</h4>
<ul>
<li>August 2016 Transfer Orientation:  Wednesday, August 24th</li>
<li>New Students Move-in: Thursday, August 25th </li>
<li>Pirate Adventure #5: Thursday, August 25th (for those who didn’t attend in June)</li>
<li>Orientation: Friday &mdash; Sunday, August 26th &mdash; August 28th </li>
<li>Convocation: Sunday, August 28th </li>
<li>Classes Begin: Monday, August 29th</li>
</ul>


    </div>     <!-- end left column -->

    <div class="col-lg-3  col-md-5 col-sm-12 col-xs-12"> 
   <h3>Seton Hall Mobile Computing</h3>     
      <h4>Asset Management Office</h4>
<address>Corrigan Hall, Room 27<br>
Seton Hall University<br>
400 South Orange Ave<br>
South Orange, NJ 07079<br>
Phone: 973-313-6181<br>
Email: <a href="mailto:assets@shu.edu">assets@shu.edu</a></address>


<h3>Additional Resources</h3>
<ul><li><a href="http://blogs.shu.edu/technology" target="_blank">SHU Technology Blog</a> </li>
<li><a href="/browsercheck" target="_blank">Browsers and Plugin Check</a> </li>
</ul>


    </div>
  </div> <!-- end container -->

  


</div><!-- End container-fluid -->

<? include('../includes/footer.htm') ?>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/custom.js"></script>
  </body>
</html> 