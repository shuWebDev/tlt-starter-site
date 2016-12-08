<? 

session_start('oid');
// Send reminder messages on demand to all users who haven't completed their forms.

$debug = 0;

define('BASE_PAGE', dirname(__FILE__) );
$_SESSION['active'] = true;

header('Content-type: application/json');

include_once('/var/www/html/projects/laptops/includes/db.php');
include_once('/var/www/html/projects/laptops/classes/mailer.php');

$response['success'] = "success";
$messages = array();
$subject  = "Reminder: Laptop Distribution at Seton Hall's Pirate Adventure";
$sender   = 'Department of Information Technology <doit@shu.edu>';
$bcc      = 'Thomas McGee <thomas.mcgee@shu.edu>';
$config   = parse_ini_file('/var/www/html/projects/laptops/includes/config.ini');
$messagesSent = 0;

//Build the query

if ( ! $reminders = $link->prepare("SELECT parentalConsent, returnPolicy, technologyUsage, termsConditions, students.ID,
   students.fn, students.shu_email, students.pers_email, students.minor 
	FROM students LEFT JOIN formResponses ON students.ID=formResponses.ID WHERE 
  ( parentalConsent='0000-00-00 00:00:00' AND minor='Y' ) OR returnPolicy='0000-00-00 00:00:00' 
  OR technologyUsage='0000-00-00 00:00:00' OR termsConditions='0000-00-00 00:00:00'") ) {
			$response['success'] = 'fail';
			$response['errors'][] = "Prepare of select query failed: (" . $link->errno . ") " . $link->error . "\n";
}

if ( ! $reminders->execute() ) {
	
			$response['success'] = 'fail';
			$response['errors'][] =  "Execute failed: (" . $link->errno . ") " . $link->error . "\n";
}

if ( ! $reminders->bind_result($pc, $rp, $tu, $tc, $id, $fn, $shumail, $email, $minor) ) {
	
			$response['success'] = 'fail';
			$response['errors'][] =  "Bind result failed: (" . $link->errno . ") " . $link->error . "\n";
}

while ( $reminders->fetch() ) {
	//stack up the messages into an array to be emailed out. 
	buildMessage($pc, $rp, $tu, $tc, $id, $fn, $shumail, $email, $minor);
}

$reminders->close();

//Log (and send) the messages
$log = fopen('/var/www/html/projects/laptops/uploads/logfile' . time() . '.txt', 'a');
fwrite($log, "\n\n" . date('h:i a, F j, Y') . "\n");

foreach( $messages as $email=>$messg ) {
	//send it to the email loop and record positive or negative
	mailNotice($email, $messg);
	//log it
	fwrite( $log, "to $email: $messg\n\n" );

}

//todo: change to reflect success and failure
fwrite($log, "$messagesSent sent " . date("F j, Y, g:i a"));
fclose($log);

$response['updates'] = $messagesSent;

echo json_encode($response);

/*
*** functions ***
*/

function buildMessage($pc, $rp, $tu, $tc, $id, $fn, $shumail, $email, $minor) {

	global $messages;

	$message = "<p>Dear $fn,</p>\n\n";
	$message .= "This is a reminder that you haven't completed all of the required consent forms for Seton Hall's 
		laptop distribution.\n\n";
	$message .= "<p>The form(s) you are missing are:\n<ul>";
	if ( $pc=='0000-00-00 00:00:00' && $minor=='Y')	{
		$message .= '<li><a href="https://tltc.shu.edu/projects/laptops/permission.php?shuid=' . $id . '">Parental Consent</a> (a parent or guardian will need to complete this).' . "</li>\n";
	}
	if ( $rp=='0000-00-00 00:00:00' ) {
		$message .= '<li><a href="https://tltc.shu.edu/projects/laptops/students/ReturnPolicy.php">Return Policy</a>.' . "</li>\n";

	}
	if ( $tc=='0000-00-00 00:00:00' ) {
		$message .= '<li><a href="https://tltc.shu.edu/projects/laptops/students/TermsAndConditions.php">Terms and Conditions</a>.' . "</li>\n";
		
	}

	if ( $tu=='0000-00-00 00:00:00' ) {
		$message .= '<li><a href="https://tltc.shu.edu/projects/laptops/students/technologyUsage.php">Technology Usage Policy</a>.' . "</li>\n";
		
	}
	$message .= '</ul>';
/*
	$message .= "<p>Also remember every incoming student will receive a Seton Hall laptop at Pirate Adventure in June. 
		You can choose between two laptop options.</p>
  		<p>Visit the <a href='https://tltc.shu.edu/projects/laptops/students/selection.php'>Class of 2020 Laptop Selection</a> page to learn more about your options. 
    When you're ready to make your choice, visit the selection page and make your choice. 
    <strong>The deadline for freshmen to choose a laptop is May 9, 2016.</strong></p>";
*/
	$message .= "<p>You can <a href='https://tltc.shu.edu/projects/laptops/students/'>review all your forms here</a>. Please be sure to complete all of them before your Pirate Adventure date. Thank you!</p>\n\n";
	$message .= "<p>Seton Hall Mobile Computing<br />
Asset Management Office<br />
Corrigan Hall, Room 27<br />
Seton Hall University<br />
400 South Orange Ave<br />
South Orange, NJ 07079<br />
Phone: <a href='tel:973-313-6181'>973-313-6181</a><br />
Email: <a href='mailto:asset@shu.edu'>asset@shu.edu</a></p>\n";

 	empty($email) ? $sendto=$shumail : $sendto=$email;
 	$messages[$sendto] = $message;

}


function mailNotice($address, $thisMessage) {
	global $subject;
	global $sender;
	global $bcc;
	global $log;
	global $config;
	global $messagesSent;
	//todo: work in mail function
	$res = new mailer($config, $sender, $address, null, $bcc, $subject, $thisMessage);

	if ( 'Message successfully sent' == $res ) {
		fwrite($log, "Successfully sent to $address\n");
		//this is assuming positive. todo: change 
		++$messagesSent;
	}

	else {

		fwrite($log, "Failed sending to $address: $res\n");
	}

}
