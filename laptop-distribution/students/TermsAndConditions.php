<?
session_start(oid);
define('BASE_PAGE', true );
$_SESSION['active'] = true;
$_SESSION['shuID'] = $_SERVER['AUTHENTICATE_EMPLOYEEID'];

include_once('/var/www/html/projects/laptops/includes/db.php');
$debug = 0;

if ( ! $statusResults = $link->prepare("SELECT termsConditions
  FROM formResponses  WHERE formResponses.ID=? LIMIT 1")) {
  if ( 1 == $debug ) echo "Prepare failed: (" . $link->errno . ") " . $link->error . "\n";
}
if ( ! $statusResults->bind_param('s', $_SESSION['shuID'] ) ) {
  if ( 1 == $debug ) echo "Bind param failed: (" . $link->errno . ") " . $link->error . "\n";
}
if ( ! $statusResults->execute() ) {
  if ( 1 == $debug ) echo "Execute failed: (" . $link->errno . ") " . $link->error . "\n";
}

if ( ! $statusResults->bind_result($tc) ) {
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
    <title>Computer License Agreement Terms &amp; Conditions</title>

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
<body id="tc">   
  
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
<h1>Computer License Agreement Terms &amp; Conditions</h1>  
<h2>Freshmen</h2>         
 
<!-- begin list -->

<p>By accepting possession of the computer, peripherals and software (equipment), I agree to the following terms and
conditions: Throughout the agreement, I shall use the equipment in accordance with the Seton Hall University policies on
the appropriate use of computer resources located on the web at http://www.shu.edu/offices/policies-procedures/pcss-
student-mc-policies.cfm.</p>

<p>I DO NOT OWN THE EQUIPMENT; I have a “license” to use it only.  I AM REQUIRED TO RETURN THE EQUIPMENT TO THE UNIVERSITY
AS DESCRIBED BELOW.  I shall not permit any other person to possess or use this equipment.  Commercial use of this
equipment is prohibited.</p>

<ol>
<li>  I understand that I am only authorized to keep the laptop during the winter and summer breaks if I am registered as
a full time student for the following semester.  <strong>If I fail to pre-register, I understand that I must return my laptop to
the Asset Management Office in Corrigan Hall within 24 hours of my last final exam for that semester. </strong> I understand that
I will not be issued a replacement laptop until I am registered as a full time student.  <strong>Failure to return the laptop
immediately will result in the actions described in item #4.</strong></li>

<li>  I understand that the <strong>equipment must be returned immediately</strong> if there is any change in my status as a student in
good standing at the University.  These changes in status include, but are not limited to, withdrawal (official or
unofficial) with or without intention to return at a later date, non-registration for a semester with or without
intention to return at a later date, leave of absence, transfer or a reduction to part time status.  <strong>Failure to return
the laptop immediately will result in the actions described in item #4.</strong></li>

<li>  If I pre-register each semester and there is no change in my status as a student in good standing, I agree to return
the equipment to the University <strong>at the end of my sophomore year (4 semesters) or at the scheduled refresh appointment</strong> in
the same condition as at the beginning of this agreement, less reasonable wear and tear, and in accordance with current
University policy. <strong>Earlier return of the laptop is required if item #1 and/or item #2 apply.</strong></li>

<li>  <strong>If I fail to return the equipment by the due date indicated in item #1, item #2, or item #3, whichever applies, I
understand that I will be assessed a non-refundable buy-out fee for the full replacement cost of the equipment and that
I may be subject to criminal prosecution or civil liability.</strong></li>

<li>  <strong>I understand that University email is the official form of all communication during my participation in the Mobile
Computing Program.</strong></li>

<li>  It is my responsibility to fill out a Change in Personal Data Form at the Department of Enrollment Services in
Bayley Hall to indicate any <strong>change in my permanent home address or phone number</strong> during the period of this license
agreement or until the equipment is returned to the university.</li>

<li>  I understand that <strong>if I plan to study abroad</strong>, it is my responsibility to notify the Asset Management Office located
in Corrigan Hall prior to leaving for my semester(s) <strong>abroad</strong>.</li>

<li>  <strong>I understand that I will be required to check-in my laptop periodically throughout the academic year</strong>, and that I
will be notified of the check-in details via University email.  Failure to check-in during the designated <strong>laptop check-
in period each semester will result in a $1,000 fine which will only be reduced</strong> to a $50 fine upon late check-in.</li>

<li>  <strong>I understand that I do not own this equipment and that it is the property of Seton Hall University. </strong> I must not
personalize the equipment with stickers, graffiti or any other type markings as it may be issued to someone else in the
future.</li>

<li> <strong>I am responsible for loss or theft of the equipment.</strong>  I understand that I will be charged a replacement fee for any
lost or stolen equipment up to $1000 per incident.</li>

<li> I understand that any incidents of <strong>loss or theft must be reported</strong> to the University Public Safety and Security
Office as soon as possible, but no later than <strong>48 hours after the incident</strong>.  If the incident occurs off-campus, it is my
responsibility to also report it to the local police department and get a copy of the report.  It is also my
responsibility to deliver copies of these reports to the Asset Management Office in Corrigan Hall and to pick up my
replacement laptop.</li>

<li> <strong>I am responsible for any non-warranty, accidental damage to the equipment</strong>.  I understand I will be charged up to
$125.00 per incident for any non-warranty, accidental damage to the equipment.  The amount charged per incident will
depend on the cost of the parts needed to repair the equipment but will not exceed $125.00 per incident.</li>

<li> <strong>I am responsible for all non-warranty, non-accidental damage to the equipment</strong>.  I understand that I will be charged
the full cost to repair any non-warranty, non-accidental damage to the equipment.  The amount charged per incident will
depend on the cost of the parts needed to repair the equipment.  If the cost to repair the damaged parts exceeds the
value of the equipment, I will be charged the full replacement value of the equipment.</li>

<li> I understand that <strong>all repairs must be made through PC Support Services</strong>.  If circumstances make it difficult for me
to have the laptop repaired at Seton Hall, I must get authorization from PCSS to use another IBM/Lenovo certified repair
shop prior to any repairs.</li>

<li> I understand that if there is a hardware or software problem with my laptop that the technician is not able to
resolve immediately, <strong>I will turn in the laptop and will be issued a loaner to use until this laptop is repaired</strong>.</li>

<li> <strong>I understand that PC Support Services will only support the University Standard hardware and software</strong>.  If there is
a software issue that requires that the laptop be re-imaged, PC Support Services will only restore academic data.  I am
responsible for restoring any of my own software or non-academic data.</li>

<li> I understand that <strong>I am required to use a cushioned laptop carrying case with my laptop</strong> and that I will be held
responsible for any damage that occurs to the laptop as a result of my failure to use this case.</li>

<li> I understand that <strong>enrollment in the Mobile Computing Program for my degree is mandatory</strong>; that there is a per-
semester program fee, and that failure to actively participate in the Mobile Computing Program may have an adverse
effect on my academic standing at the University.  If I elect not to participate I will still be charged the program
fee.</li>

</ol>
<p>The University reserves the right to recall the equipment prior to the final return date.  The University reserves the
right to modify the Mobile Computing Program and issue revised License Agreements.</p>

<p>The University hereby disclaims all express and implied warranties, including, without limitation, the implied
warranties relating to the equipment merchantability and fitness for a particular use.  I agree to accept the equipment
“as is.”  In no event shall the University be liable for any incidental, special, indirect, or consequential damage of
whatever nature arising out of any claim alleging the University’s failure to perform its obligations under which this
agreement or its alleged breach of any duty.</p>

<!-- end list -->

<!-- begin form -->

<form id="formAcceptance">
<fieldset>
  <legend>Agreement</legend>
  <div class="form-group col-xs-6">
    <label for="studentName">Your Name:</label> 
    <input type="text" disabled="disabled" class="form-control" value="<? echo $_SERVER['AUTHENTICATE_GIVENNAME'] . ' ';
    if ( ! empty( $_SERVER['AUTHENTICATE_MI'] ) ) echo $_SERVER['AUTHENTICATE_MI'] . ' ';
  echo $_SERVER['AUTHENTICATE_SN']; ?>" name="studentName" id="studentName" />
</div>
  <div class="form-group col-xs-4">
          <label for="sigDate">Date</label>   
          <input type="text" class="form-control" id="sigDate" name="sigDate" value="<? 
            if ( '0000-00-00 00:00:00' == $tc ) echo date('F j, Y');
            else echo date('F j, Y', strtotime($tc));

            ?>">
        </div>
  </fieldset>
  <fieldset>
    <label><input type="checkbox" name="accept" value="yes" id="accept"<? if ( '0000-00-00 00:00:00' != $tc ) echo '  checked="checked" disabled="disabled"'; ?> />By checking this box, I am verifying that I have read and understand all the terms and conditions on the back of this Computer License Agreement.  I agree to abide by them.</label>
  </fieldset>
  <fieldset>
    <button type="button" id="verification" class="access btn btn-lg btn-primary" disabled="disabled"><? 
      if ( '0000-00-00 00:00:00' != $tc ) echo 'Thank you, this form has been completed';
      else echo 'Please Check The Box';
      ?></button>
  </fieldset>


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