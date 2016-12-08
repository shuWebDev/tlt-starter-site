<?
session_start(oid);
define('BASE_PAGE', true );
$_SESSION['active'] = true;
$_SESSION['shuID'] = $_SERVER['AUTHENTICATE_EMPLOYEEID'];

include_once('/var/www/html/projects/laptops/includes/db.php');
$debug = 0;

if ( ! $statusResults = $link->prepare("SELECT technologyUsage
  FROM formResponses  WHERE formResponses.ID=? LIMIT 1")) {
  if ( 1 == $debug ) echo "Prepare failed: (" . $link->errno . ") " . $link->error . "\n";
}
if ( ! $statusResults->bind_param('s', $_SESSION['shuID'] ) ) {
  if ( 1 == $debug ) echo "Bind param failed: (" . $link->errno . ") " . $link->error . "\n";
}
if ( ! $statusResults->execute() ) {
  if ( 1 == $debug ) echo "Execute failed: (" . $link->errno . ") " . $link->error . "\n";
}

if ( ! $statusResults->bind_result($tu) ) {
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
    <title>Technology Usage Policy</title>

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
<body id="tup">   
  
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
<h1>Technology Usage Policy: User Responsibilities Form</h1>  
 
<p>All users of the University’s computer systems must handle essential University information in a professional and secure manner. Individuals may access only information and systems they have authorization for, and may use information only for appropriate business or academic purposes. Specific responsibilities include:</p>
<ol type="1">
  <li>  Users are forbidden from disclosing sensitive information to anyone who does not have a business or academic need to know, including:
<ol type="a"><li>  Personally identifiable information (names, Social Security numbers, addresses, telephone numbers, driver’s license numbers, credit card information, etc.) that they may have access to in the normal course of doing business; and</li>
<li>  Confidential University information (enrollment projections, budget projections, grades, payroll information, etc.) that they may have access to in the normal course of doing business.</li>
<li>  Information protected by state and federal regulation, such as students’ academic and financial records.</li>
</ol>
</li>
<li>  Network and application passwords must:
  <ol type="a">
<li>  Never be shared with anyone.</li>
<li>  Not be composed so that they can be easily guessed; they should be a minimum of eight characters long, with at least one uppercase and one lowercase alphabetic character plus at least one numeric character, with not more than two consecutive repeating characters; and</li>
<li>  Be changed at least every 180 days to a password not previously associated with that account.</li>
</ol>
</li>
<li>  Users must not make, accept, or use unauthorized copies of software or download any unauthorized programs from the Internet and ensure that license agreements are not purposefully violated.</li>
<li>  All downloads and media should be scanned for viruses prior to use, and all virus and security incidents must be reported immediately after occurrence.</li>
<li>  Confidential information should not be sent unprotected over the Internet, stored unencrypted on an unsecured computer or an unsecured external storage medium or device, or communicated using a unauthorized third party email or social networking system.</li>
<li>  Vital information on standalone PCs or workstation hard drives should be backed up when it is created and whenever it is significantly changed; copies should be moved as soon as possible to a physically secure location, such as a network drive or a hard drive in a secured location.</li>
<li>  Security incidents or suspected violations of the security policy should be reported to the University’s Information Security Officer or other appropriate manager.</li>
</ol>



<!-- end list -->

<!-- begin form -->

<form id="formAcceptance">
<fieldset>
  <legend>Agreement</legend>
          <div class="form-group col-xs-6">
          <label for="studentName">Student Name: </label>
          <input type="text" disabled="disabled" class="form-control" value="<? echo $_SERVER['AUTHENTICATE_GIVENNAME'] . ' ';
  if ( ! empty( $_SERVER['AUTHENTICATE_MI'] ) ) echo $_SERVER['AUTHENTICATE_MI'] . ' ';
  echo $_SERVER['AUTHENTICATE_SN']; ?>" name="studentName" />
        </div>
 
  <div class="form-group col-xs-4">
          <label for="sigDate">Date</label>   
          <input type="text" class="form-control" id="sigDate" name="sigDate" value="<? 
            if ( '0000-00-00 00:00:00' == $tu ) echo date('F j, Y');
            else echo date('F j, Y', strtotime($tu));

            ?>">
        </div>

</fieldset>
<fieldset>

  <label><input type="checkbox" name="accept" value="yes" id="accept"<? if ( '0000-00-00 00:00:00' != $tu ) echo ' checked="checked" disabled="disabled"'; ?> />By checking this box, as a user of SHU Technology assets, I acknowledge the above and will comply with the best of my ability.</label> 

<button type="button" id="verification" class="access btn btn-lg btn-primary" disabled="disabled"><? 
      if ( '0000-00-00 00:00:00' != $tu ) echo 'Thank you, this form has been completed';
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