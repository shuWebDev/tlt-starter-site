<?
session_start(oid);
define('BASE_PAGE', true );
$_SESSION['active'] = true;
$_SESSION['shuID'] = $_SERVER['AUTHENTICATE_EMPLOYEEID'];

include_once('/var/www/html/projects/laptops/includes/db.php');
$debug = 0;


if ( ! $statusResults = $link->prepare("SELECT laptopSelection 
	FROM formResponses WHERE formResponses.ID=? LIMIT 1")) {
	if ( 1 == $debug ) echo "Prepare failed: (" . $link->errno . ") " . $link->error . "\n";
}
if ( ! $statusResults->bind_param('s', $_SESSION['shuID'] ) ) {
	if ( 1 == $debug ) echo "Bind param failed: (" . $link->errno . ") " . $link->error . "\n";
}
if ( ! $statusResults->execute() ) {
	if ( 1 == $debug ) echo "Execute failed: (" . $link->errno . ") " . $link->error . "\n";
}

if ( ! $statusResults->bind_result($selection) ) {
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
    <title>Laptop Selection</title>

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
<h1>Mobile Computing Laptops Selection</h1>           

<p>Welcome to Seton Hall University as a member of the class of 2020!</p>
<p>As a student here at SHU, <strong>you will receive a Lenovo ThinkPad T460s Ultrabook</strong> at your Pirate Adventure
  session in June. However, you can opt to receive a Lenovo ThinkPad Yoga 260 Ultrabook. By submitting your selection
  you are committing yourself to the option selected for the next two years.</p>
<?
  if ( !empty($selection)) echo '<p><strong>You have already selected the Lenovo ' . $selection . ' Ultrabook as your laptop. 
    No futher action is necessary.</strong></p>';
  else { 
    ?>
<p><strong>Your response is due by <em>Monday, May 9, 2016</em></strong>. If you do not submit a response by Monday, May
  9, 2016, we will assume that you wish to receive a Lenovo T460s Ultrabook, and the University will order a T460s Ultrabook
  for your use.</p>

<? } ?>

<p>If you have any questions about the selection, please contact the Asset Management Office at the number to the right.</p>      

    </div>     <!-- end left column -->

    <div class="col-lg-3  col-md-5 col-sm-12 col-xs-12"> 
   <h3>Seton Hall Mobile Computing</h3>     
      <h4>Asset Management Office</h4>
<address>Corrigan Hall, Room 27<br>
Seton Hall University<br>
400 South Orange Ave<br>
South Orange, NJ 07079<br>
Phone: 973-313-6181<br>
Email: <a href="mailto:asset@shu.edu">asset@shu.edu</a></address>

<h3>Additional Resources</h3>
<ul>
  <li><a href="http://blogs.shu.edu/technology" target="_blank">SHU Technology Blog</a> </li>
<li><a href="https://en-us.help.blackboard.com/Learn/9.1_2014_04/Student/015_Browser_Support/Browser_Checker" target="_blank">Browsers and Plugin Check</a> </li>

</ul>


    </div>
  </div><!-- end container -->
</div>

<div class="container">
 <div class="row"> <!-- specifications -->
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">   
          <h4>Lenovo ThinkPad T460s Ultrabook</h4>
          <img src="../img/think-pad-T460s.jpg" alt="14-inch Professional Ultrabook"  
            class="img-rounded img-responsive" alt="Lenovo ThinkPad T460s Ultrabook" />
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">  
           <h4>Lenovo ThinkPad Yoga 260 Ultrabook</h4>
           <img src="../img/think-pad-yoga-260.jpg" class="img-rounded img-responsive" 
              alt="Lenovo ThinkPad Yoga 260 Ultrabook" />       
        </div>

        <!-- pseudo row -->
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">  
          <h5>Lenovo ThinkPad T460s Ultrabook</h5>
          <dl><dt>Screen Size:</dt><dd>14" FHD Touch</dd>
            <dt>Available Ports:</dt><dd>(3) USB ports</dd></dl>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">  
          <h5>Lenovo ThinkPad Yoga 260 Ultrabook</h5>
          <dl><dt>Screen Size:</dt><dd>12.5" FHD Touch, pen-enabled</dd>
            <dt>Available Ports:</dt><dd>(2) USB ports</dd></dl>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <dl><dt>What to think about:</dt><dd>A larger screen is easier on the eyes, especially since you use your computer for 
  more than just classwork. If you are a <strong>science major</strong>, you might prefer the pen-enabled screen, which
  allows you to write your class notes directly on the screen and save them to your computer. Additional ports can be 
  used to charge your phone or other device.</dd></dl>
          <p><a href="https://www13.shu.edu/offices/technology/mobile-computing-class-of-2020.cfm" 
            target="_blank">Review the full specs ...</a></p>
         </div>


       
         <!-- end specifications section -->


         <!-- begin form -->
        <form id="selectorForm" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <h3>Make Your Selection...</h3>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">  
          <div class="radio">
            <label for="selection">
            <input type="radio" class="form-control" name="selection" value="T460s"<?
              if ( "T460s" == $selection )  echo ' checked="true"'; 
              if ( !empty($selection)) echo ' disabled="true"';
            ?> />Select the Lenovo ThinkPad T460s Ultrabook</label>
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">   
          <div class="radio">  
            <label for="selection">
            <input type="radio" class="form-control" name="selection" value="Yoga 260"<?
              if ( "Yoga 260" == $selection )  echo ' checked="true"'; 
              if ( !empty($selection)) echo ' disabled="true"';
            ?> />Select the Lenovo Yoga 260 Ultrabook</label>
          </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          &nbsp;<br />
          <button <?
          if ( !empty($selection)) echo ' disabled="true"'; ?> class="center-block btn btn-lg btn-primary col-lg-12 col-md-12 col-sm-12 col-xs-12" id="makeSelection">
          <? 
          if ( !empty($selection)) echo 'You have selected the Lenovo ' . $selection . ' Ultrabook';
          else echo 'Make Your Selection'; 
          ?></button>
<div> &nbsp; </div>

<div id="backlinks"><h4><a href="/projects/laptops/students">Return to form list</a>.</h4></div>
        </div>         
        </form>       


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