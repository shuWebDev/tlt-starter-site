<?
class simpleTable {
	
	private $id; //this is going to be the table ID
	private $headers; //the 'th' row
	private $table;
	private $footer;
	private $columns;
	
	public function __construct($tableid) { 	
		$this->id = $tableid;
	}
	
	public function createHeaders($fields) {
		$this->columns = sizeof($fields);
		foreach ( $fields as $header ) { 
			$this->headers .= '<th>' . $header . '</th>';
		}
		
	}
	
	public function addData($data, $id='') { //one row at a time
		$this->table .= '<tr id="' . $id . '">';
		//instead of iterating over $data, this way produces proper empty cells
		for ( $i=0; $i<$this->columns; ++$i ) {
			$this->table .= '<td>' . $data[$i] . '</td>';	
		}
		$this->table .= "</tr>\n";
		//if a row is too long, the sort and search functions will break.
		
			
	}
	public function addFooter($text) { //this is optional
		$this->footer = "<tfoot>\n<tr>\n";
		$this->footer .= '<td colspan="' . $this->columns . '">' . $text . '</td>';
		$this->footer .= "</tr>\n";
		$this->footer .= "</tfoot>\n";
	}
	
	public function drawTable() {
		echo '<table class="table table-striped" id="' . $this->id . '">';
		echo '<thead>';
		echo '<tr>' . $this->headers . '</tr>';
		echo '</thead>' . "\n";
		echo '<tbody>' . "\n";
		echo $this->table;
		echo '</tbody>' . "\n";
		echo $this->footer;
		echo '</table>';
		echo '<script type="text/javascript">
		$(document).ready(function() { 
			var oTable = $(\'#';
		echo $this->id;	
		echo '\').dataTable({
				"iDisplayLength": 50,
				"sDom": \'<"top"lfip>rt<"bottom"p><"clear">\',
				"sPaginationType": "full_numbers",
				"aaSorting":[]
			});
        
    } );
     
    
</script>';
			
	}
}