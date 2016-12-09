<?

class users extends person {
	public $users;
	public $config;
	protected $link;
	
	public function __construct($link) {
		//overloads the persoo construct
		$this->link = $link;
		$this->config = parse_ini_file( dirname(__FILE__) .  '/config.ini', true);
		
	}
	
	public function __toString() {
		return $this->result;
	}
		
	public function userList($list,$method,$role=null) {
		//here's where we cycle through the list of registrants
		//if it's from the search tab, we've already got the users in the form we want them
		if ( $method == 'search' ) {
			foreach ($list as $item=>$name) {
				//echo "\nlist is $item... registrant is " . $name . "\n";
				if ( preg_match('/\d{6,8}/', $item ) ) {
					//echo 'found ' . $item . "\n";
					$indResult = $this->getUserInfo($item, '', 'employeeid');
					$this->result[] = $indResult;
					if ( !empty($role) && !empty($indResult['shortname']) ) $this->userRole($indResult['shortname'], $role);
				}
			}
		}

		else if ( $method == 'bulk' ) { 
			//echo 'bulk adding ' . $list;
			$userids = $list['bulknames'];
			$userids = preg_split('/[^A-z0-9]/', $userids); 
			//print_r($userids);
			foreach ( $userids as $userid ) {
				//echo $userid . "<br />\n";
				if ( $userid == '' ) continue;
				if ( strlen($userid) > 8 ) continue;
				if ( $userid == 'bulk' ) continue;
				$user_information = array();
				if ( preg_match('/\d{6,8}/', $userid ) ) $test = 'employeeid';	
				else if ( preg_match('/[a-z]{6,8}/', strtolower($userid) ) ) {
					$test = 'samaccountname';
					$userid = strtolower($userid);
				}
				else {
					echo "No match for $userid<br />\n";
					continue;	
				}
				
				$indResult = $this->getUserInfo($userid, '', $test);
				$this->result[]  = $indResult;
				if ( !empty($role) ) $this->userRole($indResult['shortname'], $role);
				
			}
			//exit;
		
		}
		
	}
	
	public function userRole($user, $role) {
		$existingRole = "SELECT * FROM permissions WHERE id='$user' AND role='$role'";
		$res = $this->link->query($existingRole);
		if ( $res->num_rows < 1 ) {
			$addRole = "INSERT INTO permissions VALUES('$user','$role')";
			$this->link->query($addRole);	
		}
		
	}
	
	
	
}