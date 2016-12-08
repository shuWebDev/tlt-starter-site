<?
session_start(oid);
define('BASE_PAGE', true );
$_SESSION['active'] = true;
$_SESSION['shuID'] = $_SERVER['AUTHENTICATE_EMPLOYEEID'];

include_once('/var/www/html/projects/laptops/includes/db.php');
$debug = 0;


if ( ! $statusResults = $link->prepare("SELECT formResponses.parentalConsent, formResponses.returnPolicy, 
  formResponses.technologyUsage, formResponses.termsConditions, formResponses.laptopSelection, 
  students.ID, students.fn, students.mi, students.sn, students.pers_email, students.minor 
	FROM students LEFT JOIN formResponses ON students.ID=formResponses.ID")) {
	if ( 1 == $debug ) echo "Prepare failed: (" . $link->errno . ") " . $link->error . "\n";
}
if ( ! $statusResults->execute() ) {
	if ( 1 == $debug ) echo "Execute failed: (" . $link->errno . ") " . $link->error . "\n";
}

if ( ! $statusResults->bind_result($pc, $rp, $tu, $tc, $selection, $id, $fn, $mi, $sn, $email, $minor) ) {
	if ( 1 == $debug ) echo "Bind result failed: (" . $link->errno . ") " . $link->error . "\n";
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
    <title>Laptop Distribution Administration</title>

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/custom.css">
    <link rel="stylesheet" type="text/css" href="../css/datatables.min.css"/>
    <link rel="stylesheet" type="text/css" href="../js/Buttons-1.1.2/css/buttons.dataTables.min.css"/>

 

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
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">           
<h1>Laptop Distribution Responses</h1>           

<div class="reminderButtons">
<button id="reminders" class="btn btn-primary"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>Send Reminder Messages</button>
<br />
<div id="resultMessage"></div>
</div>

<table class="table table-striped" id="resultsTable">
<thead>
<tr><th>ID</th><th>Student</th><th>Parental Consent</th><th>Terms &amp; Conditions</th>
  <th>Return Policy</th><th>Technology Usage Policy</th><th>Selection</th></tr> 
</thead>
<tbody>
<? 
while ( $statusResults->fetch() ) {
  echo '<tr>';
  echo "<td>$id</td>\n";
  printf ("<td><a href='mailto:%s'>%s, %s %s</a></td>\n", $email, $sn, $fn, $mi); 
  echo '<td>';
  if ( 'Y' == $minor && '0000-00-00 00:00:00' != $pc ) { 
    echo '<a href="permission.php?shuid=' . $id . '">' . date('Y-m-d', strtotime($pc)) . '</a>';
  }
  else if ( 'Y' == $minor && '0000-00-00 00:00:00' == $pc ) { 
    echo "Incomplete";
  }
  else echo "n/a";
    echo "</td>\n";

  echo '<td>';
  if ( '0000-00-00 00:00:00' != $tc ) { 
    echo '<a href="TermsAndConditions.php?shuid=' . $id . '">' . date('Y-m-d', strtotime($tc)) . '</a>';
  }
  else echo "Incomplete";
    echo "</td>\n";

  echo '<td>';
  if ( '0000-00-00 00:00:00' != $rp ) { 
    echo '<a href="ReturnPolicy.php?shuid=' . $id . '">' . date('Y-m-d', strtotime($rp)) . '</a>';
  }
  else echo "Incomplete";
    echo "</td>\n";

  echo '<td>';
  if ( '0000-00-00 00:00:00' != $tu ) { 
    echo '<a href="TechnologyUsagePolicy.php?shuid=' . $id . '">' . date('Y-m-d', strtotime($tu)) . '</a>';
  }
  else echo "Incomplete";
    echo "</td>\n";
  echo "<td>";
  echo $selection;
  echo "</td>\n";
  echo "</tr>\n";

}
?>
</tbody>
</table>  

<?
if ( ! $statusResults->close() ) {
  if ( 1 == $debug ) echo "Close failed: (" . $link->errno . ") " . $link->error . "\n";
}
?>

    </div>     <!-- end left column -->


  </div>


</div><!-- End container-fluid -->

<? include('../includes/footer.htm') ?>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/customAdmin.js"></script>
    <script type="text/javascript" src="../js/datatables.min.js"></script>
    <script type="text/javascript" src="../js/Buttons-1.1.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="../js/Buttons-1.1.2/js/buttons.colVis.min.js"></script>
    <script type="text/javascript" src="../js/Buttons-1.1.2/js/buttons.flash.min.js"></script>
    <script type="text/javascript" src="../js/Buttons-1.1.2/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="../js/Buttons-1.1.2/js/buttons.print.min.js"></script>


    <script type="text/javascript">
      $(document).ready(function() {
        var table = $('#resultsTable').DataTable({
        "iDisplayLength": 50,
        "sDom": '<"top"lfip>rt<"bottom"p><"clear">',
        "sPaginationType": "full_numbers",
        "aaSorting":[]
      });
        new $.fn.DataTable.Buttons( table, {
          buttons: [ 'copy','csv','pdf' ]
        });
         table.buttons( 0, null ).container().prependTo(
        table.table().container()
    );
      } );
    </script>

  </body>
</html> 