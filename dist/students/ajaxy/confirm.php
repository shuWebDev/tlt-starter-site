<?
//confirmation of submissions 

$debug = 0;

session_start('oid');
define('BASE_PAGE', dirname(__FILE__) );
$_SESSION['active'] = true;

header('Content-type: application/json');

include_once('/var/www/html/projects/laptops/includes/db.php');

$response['response'] = 'success';

$thisStudent = $_SESSION['shuID'];
switch ( $_REQUEST['form'] ) {
	case 'ReturnPolicy.php':
		$thisColumn = 'returnPolicy';
		break;
	case 'TechnologyUsagePolicy.php':
		$thisColumn = 'technologyUsage';
		break;
	case 'TermsAndConditions.php':
		$thisColumn = 'termsConditions';
		break;
	case 'permission.php':	
		$thisColumn = 'parentalConsent';
		break;
	default:
		$response['errors'][] = 'wrong form URL ' . $_REQUEST['myForm'];
		$response['response'] = 'error';			

}

if ( $debug == 1 ) {
	$response['details']['form'] = $_REQUEST['myForm'];
	$response['details']['column'] = $thisColumn;
	$response['details']['submitter'] = $thisStudent;
}

//create the update query
if ( 'parentalConsent' == $thisColumn ) {
	if ( ! $stmt = $link->prepare("UPDATE formResponses SET parentalConsent=NOW(), parentSignature=? WHERE ID=? LIMIT 1") ) {
		$response['errors'][] = "Prepare of formResponses table query failed: (" . $link->errno . ") " . $link->error . "\n";
		$response['response'] = 'error';			
	}
	if ( ! $stmt->bind_param("ss", $_REQUEST['parentSignature'], $thisStudent) ) {
		$response['errors'][] = "Bind failed: (" . $link->errno . ") " . $link->error . "\n";
		$response['response'] = 'error';			
	}
	if ( ! $stmt->execute() ) {
		echo "Execute failed formResponses table: (" . $link->errno . ") " . $link->error . "\n";
		$response['response'] = 'error';			
	}
}

else {
	if ( ! $stmt = $link->prepare("UPDATE formResponses SET $thisColumn=NOW() WHERE ID=? LIMIT 1") ) {
		$response['errors'][] = "Prepare of formResponses table query failed: (" . $link->errno . ") " . $link->error . "\n";
		$response['response'] = 'error';			
	}
	if ( ! $stmt->bind_param("s", $thisStudent) ) {
		$response['errors'][] = "Bind failed: (" . $link->errno . ") " . $link->error . "\n";
		$response['response'] = 'error';			
	}
	if ( ! $stmt->execute() ) {
		echo "Execute failed formResponses table: (" . $link->errno . ") " . $link->error . "\n";
		$response['response'] = 'error';			
	}
}

echo json_encode($response);
