<?

class sidebar {
	protected $location;
	public function __construct($location) {
		if ( 'true' != $_SESSION['loggedin'] ) {
		echo '<div id="greeting">';
		
			
			echo '<h3>Please Log In</h3>';
			echo '<form action="login.php" method="post" name="auth">' . "\n";
			echo '<input type="hidden" name="redirect" value="' . $location . '" />' . "\n";
			echo '<input type="text" name="username" /><br />' . "\n";
			echo '<input type="password" name="pw" /><br />' . "\n";
			echo '<button class="btn" name="submit" type="submit">Log In</button>' . "\n";
			echo '</form>' . "\n";
					
		
		//echo $thisuser->userinfo;
		echo '</div>';
		}
	}
	


}