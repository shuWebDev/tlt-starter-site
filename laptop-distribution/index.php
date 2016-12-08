<?php require_once($_SERVER["DOCUMENT_ROOT"] . 'tlt-globals/libs/paths.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
<!--       <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!- - The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags - ->
    <title>Laptop Distribution Home</title>

    <!- - Bootstrap - ->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/custom.css">

    <!- - HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries - ->
    <!- - WARNING: Respond.js doesn't work if you view the page via file:// - ->
    <!- -[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]- ->
    -->

<?php require_once(PATH_GLOBAL_VIEWS_DIR . 'head.tpl') ?>

<link rel="stylesheet" type="text/css" href="css/custom.css">

</head>


<body id="homePage">

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
<h1>Laptop Distribution</h1>
<h2>Mandatory Laptop Forms</h2>
<p>All students must confirm their acceptance of the Terms and Conditions, Return Policy and Technology Usage Policy.
  Students who will be minors at the time of their laptop distribution must also have a parental consent form.</p>
<p><a href="students/index.php">Log in here to check the status</a> of your forms, and for links to complete them.</p>


<h2>Pirate Adventure and Orientation 2016</h2>
<h3>Key Dates</h3>

<h4>Pirate Adventure Dates</h4>
<ol>
  <li>Monday &amp; Tuesday,  June 20 &amp; 21:    Math, Science majors</li>
  <li>Thursday &amp; Friday, June 23 &amp; 24:    Stillman, Communications &amp; The Arts</li>
  <li>Monday &amp; Tuesday,  June 27 &amp; 28:    Education, Nursing, Diplomacy, Theology</li>
  <li>Thursday &amp; Friday, June 30 &amp; July 1:  Arts &amp; Sciences </li>
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
<ul>
  <li><a href="http://blogs.shu.edu/technology" target="_blank">SHU Technology Blog</a> </li>
  <li><a href="/browsercheck" target="_blank">Browsers and Plugin Check</a> </li>

</ul>


    </div>
  </div>


</div><!-- End container-fluid -->

<? include('includes/footer.htm') ?>

<?php require_once(PATH_GLOBAL_VIEWS_DIR . 'footer.tpl') ?>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
  </body>
</html>
