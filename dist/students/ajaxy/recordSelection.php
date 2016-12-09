<?

$debug = 0;

session_start('oid');
define('BASE_PAGE', dirname(__FILE__) );
$_SESSION['active'] = true;

header('Content-type: application/json');

include_once('/var/www/html/projects/laptops/includes/db.php');

$response['response'] = 'success';

$thisStudent = $_SESSION['shuID'];
$formData = $_POST['selection'];
$instructions['studentid'] = $thisStudent;
$instructions['selection'] = $formData;

if ( ! $insertSelectionQuery = $link->prepare("UPDATE formResponses SET laptopSelection=? WHERE ID=? LIMIT 1") ) {
	$instructions['errors'][] = "Prepare of formResponses table query failed: (" . $link->errno . ") " . $link->error . "\n";
	$response['response'] = 'error';
}	

if ( ! $insertSelectionQuery->bind_param('ss', $formData, $thisStudent ) ) { 
	$instructions['errors'][] = "Bind failed: (" . $link->errno . ") " . $link->error . "\n";
	$response['response'] = 'error';			

}

if ( !$insertSelectionQuery->execute()  ) {
	$instructions['errors'] .= "Execute failed formResponses table: (" . $link->errno . ") " . $link->error . "\n";
	$response['response'] = 'error';
	}

$insertSelectionQuery->close();

if ( empty($instructions['errors']) ) $instructions['success'] = "success";

echo json_encode($instructions);
?>
