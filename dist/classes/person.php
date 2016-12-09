<?

/*
This class handles the basic functions of logging in a user, and setting session variables
Some functions will also add new users to the database, in association with the users class
Session variables set include:
$_SESSION['userlevel'] the admin/faculty/whatever user role
$_SESSION['user'] which contains the 'shortname'
$_SESSION['firstname'], so we can say hello
*/
class person { 
	public $userinfo;
	public $config;
	public $result = array();
	protected $link;
	
	public function __construct($link) { 
	
		$this->link = $link;
		
		//for search-and-add operations
		//for initial log-ins
		if ( 'true' == $_SESSION['loggedin'] ) {
			//echo 'logged in';
			if ( isset( $_SESSION['firstname'] ) ) {
				//echo 'we have a firstname<br />'; //there is a logged in user we know, 
				//echo 'have a firstname, ' . $_SESSION['firstname'];
			}
			//either because they're in the database or because we looked them up in ldap
			
			else {
				//echo 'looking up...';
				$this->userinfo = $this->getUserInfo($_SESSION['user'],'', 'sAMAccountName');
			    if ( !isset($_SESSION['firstname']) ) $_SESSION['firstname'] = $this->userinfo['firstName'];
				//echo 'looked up';
			}
		}
	}
	

		
	protected function getUserInfo($username, $password, $searchparam) {
		//First pass is to look up user in the database
		$this->config = parse_ini_file( dirname(__FILE__) . '/config.ini', true);
		$personQuery = "SELECT * FROM people WHERE shortname='$username' OR employeeid='$username' LIMIT 1";
		$persons = $this->link->query($personQuery);
		
		if ( $persons->num_rows > 0 ) {
			$user_info = $persons->fetch_assoc();
			$user_info['status'] = 'existing';
			//get permission level, if any
			$permQuery = "SELECT role FROM permissions WHERE id='" . $user_info['shortname'] . "' ORDER BY role DESC LIMIT 1";
			$permissions = $this->link->query($permQuery);
			$permission = $permissions->fetch_assoc();
			$_SESSION['userlevel'] = $permission['role'];
		}
		
		else { 
			//echo 'looking up LDAP data<br />';
			$ldap = array('ldaphost' => $this->config['ldaphost'],
				'ldapport' => $this->config['ldapport'],
				'domain'   => $this->config['domain'],
				'dn'       => $this->config['dn'],
				'binduser' => $this->config['binduser'],
				'bindpass' => $this->config['bindpass']
				);	
			$ldapconn  = ldap_connect($ldap['ldaphost'],$ldap['ldapport']);
			ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
			ldap_set_option($ldapconn, LDAP_OPT_REFERRALS, 0);
			
			$proxyBind = ldap_bind($ldapconn, $ldap['binduser'], $ldap['bindpass']);
			
			if (!$proxyBind) {
				return "[invalidLDAPProxy]";
			}
			// search for the supplied username in the base DN
			//samaccountname = shortname
			//sn = surname
			//description = employee, student etc etc. 
			//givenname = first name
			//mail = email
			//employeeid = SHU ID (even for students)
			$ldapSearchResult = ldap_search($ldapconn, $ldap['dn'], "($searchparam=$username)" , array( "givenname","middlename","sn","mail","telephonenumber", "description","title","department", "physicaldeliveryofficename","employeeid","samaccountname","memberof","whenchanged" ));
			$ldapEntries      = ldap_get_entries($ldapconn, $ldapSearchResult);
			
			if ($ldapEntries["count"] < 1) {
				return null;
			}
			
			$userdn = $ldapEntries[0]["dn"];
					
			$user_info = array();
			$user_info['fullName']  	= $ldapEntries[0]["givenname"][0]." ".$ldapEntries[0]["sn"][0];
			$user_info['firstName'] 	= $ldapEntries[0]["givenname"][0];
			$user_info['middleName']  	= $ldapEntries[0]["middlename"][0];
			$user_info['lastName']  	= $ldapEntries[0]["sn"][0];
			$user_info['email']      	= $ldapEntries[0]["mail"][0];
			$user_info['telephone']		= $ldapEntries[0]["telephonenumber"][0];
			$user_info['description']   = $ldapEntries[0]["description"][0];
			$user_info['title']   		= $ldapEntries[0]["title"][0];
			$user_info['department']    = $ldapEntries[0]["department"][0];
			$user_info['office']        = $ldapEntries[0]["physicaldeliveryofficename"][0];
			$user_info['employeeid']    = $ldapEntries[0]["employeeid"][0];
			$user_info['shortname'] 	= $ldapEntries[0]["samaccountname"][0];
			$user_info['memberof'] 		= implode(',',$ldapEntries[0]["memberof"]);
			$user_info['whenchanged']	= $ldapEntries[0]["whenchanged"][0];
			
			if ( !isset($_SESSION['firstname']) ) $_SESSION['firstname'] = $user_info['firstName'];
			ldap_unbind($ldapconn);
			
			//add them to the database for next time
			$res = $this->addUserToDatabase($user_info);
			$user_info['status'] = 'new';
			$user_info['result'] = $res;
		}
			return $user_info; 
	}
	
	protected function addUserToDatabase($user_info) {
			$addUserQuery = 'INSERT INTO people VALUES(';
			$addUserQuery .= "'" . $user_info['shortname'] 	. "',";
			$addUserQuery .= "'" . $user_info['employeeid'] . "',"; 
			$addUserQuery .= "'" . $user_info['firstName'] 	. "',"; 
			$addUserQuery .= "'" . $user_info['middleName'] . "',";
			$addUserQuery .= "'" . $user_info['lastName'] 	. "',";
			$addUserQuery .= "'" . $user_info['email'] 		. "',";
			$addUserQuery .= "'" . $user_info['telephone'] 	. "',";
			$addUserQuery .= "'" . $user_info['description']. "',";
			$addUserQuery .= "'" . $user_info['title'] 		. "',";
			$addUserQuery .= "'" . $user_info['department'] . "',";
			$addUserQuery .= "'" . $user_info['office'] 	. "',";
			$addUserQuery .= "'" . $user_info['memberof'] 	. "',";    
			$addUserQuery .= "'" . $user_info['whenchanged']. "')";     
			
			$res = $this->link->query($addUserQuery); 
			
			return $res;
	}
	
}