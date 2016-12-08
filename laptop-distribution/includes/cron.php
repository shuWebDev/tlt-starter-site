<? 
/* Version 1.1 */
/* Modified sender address, added paragraphs to message body */

define('BASE_PAGE', true );
$_SESSION['active'] = true;

include_once('/var/www/html/projects/laptops/includes/db.php');
include_once('/var/www/html/projects/laptops/classes/mailer.php');

$debug    = 0;	
$messages = array();
$subject  = "Introduction to Laptop Distribution at Seton Hall's Pirate Adventure";
$sender   = 'Department of Information Technology <doit@shu.edu>';
$bcc      = ''; // 'Thomas McGee <thomas.mcgee@shu.edu>';
$config   = parse_ini_file('/var/www/html/projects/laptops/includes/config.ini');
$messageCount = 0;

$logfile = fopen('/var/www/html/projects/laptops/uploads/log' . time() . '.txt', 'a');
if ( !$logfile ) echo "Can't open log file";
else if ( 1 == $debug ) echo "Opened Log File.\n";

fwrite($logfile, "\n\n" . date('h:i a, F j, Y') . "\n");

if ( 1 == $debug ) $handle = @fopen("/var/www/html/projects/laptops/uploads/tltc_test_extract.txt","r");
else $handle = @fopen("/var/www/html/projects/laptops/uploads/tltc_zfrsman_extract.txt", "r");

if ( $handle ) { 
	if ( 1 == $debug ) echo 'opened handle file' . "\n";
	if ( ! $stmt = $link->prepare("
		INSERT INTO students (ID,sn,fn,mi,term,major_accepted,shortname,shu_email,
			conf_orientation_dt,stu_type,trans_credit,minor,pers_email,address_1,address_2,city,state,zip) 
		VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)
		ON DUPLICATE KEY UPDATE 
			sn=VALUES(sn),
			fn=VALUES(fn),
			mi=VALUES(mi),
			term=VALUES(term),
			major_accepted=VALUES(major_accepted),
			shortname=VALUES(shortname),
			shu_email=VALUES(shu_email),
			conf_orientation_dt=VALUES(conf_orientation_dt),
			stu_type=VALUES(stu_type),
			trans_credit=VALUES(trans_credit),
			minor=VALUES(minor),
			pers_email=VALUES(pers_email),
			address_1=VALUES(address_1),
			address_2=VALUES(address_2),
			city=VALUES(city),
			state=VALUES(state),
			zip=VALUES(zip)")) {
		fwrite($logfile, "\n\nPrepare of student table query failed: (" . $link->errno . ") " . $link->error . "\n");
	}
	if ( ! $stmt2 = $link->prepare("INSERT IGNORE INTO formResponses (ID) VALUES (?)")) {

		fwrite($logfile, "\n\nPrepare of formResponses table query failed: (" . $link->errno . ") " . $link->error . "\n");

	}

	while ( $line = fgets($handle) ) { 
		if ( preg_match('/^shuid/',  $line ) ) {
			continue;
		}
		if ( 1==$debug ) echo $line . "\n";
		list($shuid, $lastname, $firstname, $mi, $term, $major_accepted, $shortname,
			$shu_email, $conf_orientation_dt,
			$stu_type, $trans_cred, $minor, $pers_email,
			$address_1, $address_2, $city, $state, $zip) = explode(",", $line);
		if ( empty($shuid) ) { //skip empty lines
			continue;
		}
		else {
			if ( ! $stmt->bind_param("ssssssssssssssssss", $shuid, $lastname, $firstname, $mi, 
				$term, $major_accepted, $shortname,	$shu_email, 
				$conf_orientation_dt, $stu_type, $trans_cred, $minor, 
				$pers_email, $address_1, $address_2, $city, 
				$state, $zip)) {
					fwrite($logfile, "\n\nBind failed: (" . $link->errno . ") " . $link->error . "\n");
			}	
			if ( ! $stmt->execute() ) {
				fwrite($logfile, "\n\nExecute failed students table: (" . $link->errno . ") " . $link->error . "\n");
			}
			else if ( $stmt->affected_rows == 1 ) {
				//these will be rows that were added and not updated
				//add them to the mailing list for first-timers
				buildMessages($firstname, $pers_email, $shu_email, $shuid, $minor);

			}
			if ( ! $stmt2->bind_param("s", $shuid) ) {
				fwrite($logfile, "\n\nBind failed at formResponses: (" . $link->errno . ") " . $link->error . "\n");
			}		
			if ( ! $stmt2->execute() ) {
				fwrite($logfile, "\n\nExecute failed formResponses table: (" . $link->errno . ") " . $link->error . "\n");
			}
		}
	}	
	if ( ! $stmt->close() ) {
				fwrite($logfile, "\n\nClose of stmt failed: (" . $link->errno . ") " . $link->error . "\n");
			}	
	if ( ! $stmt2->close() ) {
				fwrite($logfile, "\n\nClose of stmt2 failed: (" . $link->errno . ") " . $link->error . "\n");
			}	
}

else fwrite($logfile, "Can't open $handle\n");

foreach( $messages as $email=>$messg ) {
	//send it to the email loop and record positive or negative
	mailNotice($email, $messg);
	//log it
	fwrite( $logfile, "to $email: $messg\n\n" );

}

//todo: change to reflect success and failure
fwrite($logfile, "$messageCount sent " . date("F j, Y, g:i a"));
fclose($logfile);

fclose($handle);				
				

function buildMessages($firstname, $pers_email, $shu_email, $shuid, $minor) {

	global $messages;

	$message = "<p>Dear $firstname,</p>\n\n";
	$message .= "<p>Welcome to Seton Hall University!</p>\n\n";
	$message .= '<p>As a full-time undergraduate student at Seton Hall, you will be participating in the Mobile 
		Computing Program.  All participants will be issued a laptop. The laptops will be distributed to the 
		students during your scheduled Pirate Adventure visit.  </p>';
	$message .= "<p>In order to receive the laptop during your Pirate Adventure session, <a href='https://tltc.shu.edu/projects/laptops/students/'>review the status of your forms here</a> to complete the forms 
		no later than June 10, 2016.  </p>\n\n";
	$message .= '<ol>';
	$message .= '<li><strong>Laptop Return Policy</strong> - Seton Hall University distributes the laptops during 
		Pirate Adventure in June of 2016.  Understanding that there is a possibility that you may decide not to 
		attend SHU in the Fall, this document outlines the return policy regarding the laptop that you will be 
		picking up in June.</li>';
	$message .= '<li><strong>Laptop Terms and Conditions</strong> - These are the terms and conditions of the use 
		that all students must read and understand.</li>';	
	$message .= '<li><strong>Technology Usage Policy</strong> - This form outlines the responsibilities of a user of 
		SHU technology assets.  </li>';	
	if ( 'Y' == $minor ) {
		$message .= '<li><strong>Laptop Permission Form for Minor Students</strong> - If you are under 18 years 
		of age at the time of your Pirate Adventure session, you need to have a parent or guardian sign this form.  
		As a minor, this form authorizes you to sign the license agreement during your distribution session.</li>';
	}
	$message .= '</ol>';	
/*
	$message .= "<p>Every incoming student will receive a Seton Hall laptop at Pirate Adventure in June. 
		<strong>But did you know 
  		that you can now choose between two laptop options?</strong></p>
  		<p>Visit the <a href='https://tltc.shu.edu/projects/laptops/students/selection.php'>Class of 2020 Laptop Selection</a> page to learn more about your options. 
    When you're ready to make your choice, visit the selection page and make your choice. 
    <strong>The deadline for freshmen to choose a laptop is May 9, 2016.</strong></p>";
*/
	$message .= "<p>Seton Hall Mobile Computing<br />
Asset Management Office<br />
Corrigan Hall, Room 27<br />
Seton Hall University<br />
400 South Orange Ave<br />
South Orange, NJ 07079<br />
Phone: <a href='tel:973-313-6181'>973-313-6181</a><br />
Email: <a href='mailto:assets@shu.edu'>assets@shu.edu</a></p>\n";

 	empty($pers_email) ? $sendto=$shu_mail : $sendto=$pers_email;
 	$messages[$sendto] = $message;
}


function mailNotice($address, $thisMessage) {
	global $subject;
	global $sender;
	global $bcc;
	global $logfile;
	global $config;
	global $messageCount;
	//todo: work in mail function
	$res = new mailer($config, $sender, $address, null, $bcc, $subject, $thisMessage);

	if ( 'Message successfully sent' == $res ) {
		fwrite($logfile, "Successfully sent to $address\n");
		//this is assuming positive. todo: change 
		++$messageCount;
	}

	else {

		fwrite($logfile, "Failed sending to $address: $res\n");
	}

}
