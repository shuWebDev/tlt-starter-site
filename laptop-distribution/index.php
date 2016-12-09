<?php
	require_once('../globals/libs/paths.php');
	$page_title = "Laptop Distribution Home";
?>

<!DOCTYPE html>
<html class="no-js" lang="en">
	<head>

		<?php require_once(PATH_GLOBAL_VIEWS_DIR . 'head.tpl') ?>

		<link rel="stylesheet" type="text/css" href="css/custom.css">

	</head>


	<body id="homePage">
		<header id="header" class="main-header">
			<?php include(PATH_GLOBAL_VIEWS_DIR . 'header.tpl') ?>
		</header>

		<section id="main-app">

			<? include('includes/navbar.htm') ?>

			<div class="row">
				<div class="small-12 medium-7 large-9 columns">
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

				<div class="small-12 medium-5 large-3 columns">
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

			<? include('includes/footer.htm') ?>
		</section>

		<?php require_once(PATH_GLOBAL_VIEWS_DIR . 'footer.tpl') ?>

		<script src="<?php echo URI_GLOBAL_VENDOR . 'foundation/js/vendor/jquery.js' ?>"></script>
		<script src="<?php echo URI_GLOBAL_VENDOR . 'foundation/js/vendor/what-input.js' ?>"></script>
		<script src="<?php echo URI_GLOBAL_VENDOR . 'foundation/js/vendor/foundation.min.js' ?>"></script>
		<script src="<?php echo URI_GLOBAL_ASSETS . 'js/app.min.js' ?>"></script>

		<!-- NOTE: Application specific JS -->
		<script src="js/custom.js"></script>
	</body>
</html>
