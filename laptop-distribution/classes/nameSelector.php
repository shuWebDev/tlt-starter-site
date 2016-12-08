<?

class nameSelector {
	public $config;
	protected $showRoleSelectors;
	protected $roleSelectors;
	protected $link;	
	private $divid;
	private $form;
	
	public function __construct($divid,$link=null) { 
		$this->divid = $divid;
		if ( isset($link) ) {
				$this->showRoleSelectors = true;
				$this->link = $link;
		}
		
	}
	
	protected function buildForm() {
		if ( true == $this->showRoleSelectors ) { 
			$this->roleSelectors = $this->buildRoleSelector();
			
		}
		$this->form = '<div id="add">';
		$this->form .= '<h3>Add Users</h3>';
        $this->form .= '<div id="' . $this->divid . '_tabs">';
        $this->form .= '<ul class="tabs">';
        $this->form .= '<li><a href="#search">Search</a></li>';
        $this->form .= '<li><a href="#upload">Upload</a></li>';
        $this->form .= '</ul>';

$this->form .= <<<EOF
<div id="search">
<p>Search on students' last names, then drag-and-drop them into the area on the right. Repeat until you've got your list, then select whether these are new or returning applicants. Then click the "Add" button.</p>


<form id="searchfornames" class="form-search">
<fieldset id="alternate">
<div class="clearfix" id="nameselector">
<input type="text" name="searchname" id="searchname" placeholder="Enter a last name" class="form-search" /><button id="searchfor" class="btn btn-primary">Search</button>
</div>
</fieldset>
</form>

<form id="awardnames" class="form">
<fieldset>
<div class="clearfix">
<ul id="sortable1" class='droptrue'>
	
	<li class="ui-state-default ui-state-disabled">select from here...</li>
	
</ul>



<ul id="selections" class='droptrue'>
	<li class="ui-state-default ui-state-disabled">...drag them here</li>
	
</ul>
</div>
</fieldset>
<div class="form-actions">
$this->roleSelectors
<input type="hidden" name="formmethod" id="formmethod" value="search" />
<button id="submitRequest" type="submit" name="submit" class="btn" disabled="disabled">Add</button>
<div id="resultmessage" class="alert alert-message"></div>

</div>
</form>

</div>

<div id="upload">
<p>Copy-and-paste a list of SHU ID numbers, or eight-letter shortnames, into the box, then click the "Add" button.</p>
<form id="bulknamesform" class="form-search">
<fieldset>
<legend>Identifiers</legend>
<div class="clearfix">
<textarea name="bulknames" id="bulknames"></textarea>
</div>
</fieldset>
<div class="form-actions">

$this->roleSelectors

<input type="hidden" name="bulkmethod" id="bulkmethod" value="bulk" />
<button id="submitBulk" type="submit" name="submitbulk" class="btn" disabled="disabled">Add</button>
<div id="bulkresultmessage" class="alert alert-message"></div>

</div>
</form>
</div>


</div>

</div>
                
EOF;

$this->form .=  '<script>';
$this->form .=  '$(document).ready(function() { ';
$this->form .=  '  $("#' . $this->divid . '_tabs").tabs(); ';
$this->form .=  '});';
$this->form .=  '</script>';

	}
	
	public function addToForm($line) {
		$this->form .= $line;	
	}
	
	public function echoForm() {
		
		$this->buildForm();
		return $this->form;
		
	}
	
	public function buildRoleSelector() { 
		$this->config = parse_ini_file( dirname(__FILE__) . '/config.ini', true);
		$query = "SELECT * FROM roles WHERE roles.ID <= (SELECT role FROM permissions WHERE id='" . $_SESSION['user'] . "' ORDER BY role DESC LIMIT 1)";
		$roles = $this->link->query($query);
		if ( $roles->num_rows > 0 ) {
			$selector = '<div class="clearfix">';
			while ( $user_rights = $roles->fetch_assoc() ) {
					++$i;
					$selector .= '<label class="checkbox" for="appType">' . "\n";
					$selector .= '<input id="nameSelector_' . $i . '" type="radio" value="' . $user_rights['ID'] . '" name="appType"> ';
					$selector .= $user_rights['name'];
					$selector .= '</label>' . "<br />\n";
			}
			$selector .= '</div>';
		}
		return $selector;
	}
}