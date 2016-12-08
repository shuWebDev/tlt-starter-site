<?
class basicForm {
	
	public $form;
	public $method;
	public $action;
	public $enctype;
	public $id;
	private $fieldsetindex=0;
	private $fieldsets = array();
	private $footer;
	
	public function addFieldset() {
		#++$this->fieldsetindex;
		$this->fieldsets[] = '';	
		return $this->fieldsetindex++;
	}
	public function addLegend($fieldset, $legend) {
		$this->fieldsets[$fieldset] .= "<legend>$legend</legend>";
	}
	
	//$form->addTextInput(1,"Your Name", "yourname", "nameinput", "explanation of what this should be" [, 1, 1]);
	public function addTextInput($fieldset, $caption, $name, $id='', $othertext='', $required='', $disabled='') {
		$this->fieldsets[$fieldset] .= '<div class="control-group">' . "\n";
		$this->fieldsets[$fieldset] .= '<label for="'. $name . '" class="control-label">' . $caption . '</label>' . "\n";
		$this->fieldsets[$fieldset] .= '<div class="controls">' . "\n";
		$this->fieldsets[$fieldset] .= '	<input type="text" class="form-control" id="' . $id . '" name="'. $name . '"';
		if ( !empty($required) ) $this->fieldsets[$fieldset] .= ' required';
		if ( !empty($disabled) ) $this->fieldsets[$fieldset] .= ' disabled="disabled"';
		$this->fieldsets[$fieldset] .= ' />' . "<br />\n";
		if ( !empty($othertext) ) $this->fieldsets[$fieldset] .= '<span class="help-block">' . $othertext . '</span>';
		$this->fieldsets[$fieldset] .= '</div>' . "\n";
		$this->fieldsets[$fieldset] .= '</div>' . "\n";
		$this->fieldsets[$fieldset] .= "\n\n";
	}
	
	//$form->addTextArea(1,"Your Name", "yourname", "nameinput", "explanation of what this should be" [, 1, 1]);
	public function addTextArea($fieldset, $caption, $name, $id='', $othertext='', $required='', $disabled='') {
		$this->fieldsets[$fieldset] .= '<div class="control-group">' . "\n";
		$this->fieldsets[$fieldset] .= '<label for="'. $name . '" class="control-label">' . $caption . '</label>' . "\n";
		$this->fieldsets[$fieldset] .= '<div class="controls">' . "\n";
		$this->fieldsets[$fieldset] .= '	<textarea class="form-control span6" rows="8" id="' . $id . '" name="'. $name . '"';
		if ( !empty($required) ) $this->fieldsets[$fieldset] .= ' required';
		if ( !empty($disabled) ) $this->fieldsets[$fieldset] .= ' disabled="disabled"';
		$this->fieldsets[$fieldset] .= '></textarea>' . "<br />\n";
		if ( !empty($othertext) ) $this->fieldsets[$fieldset] .= '<span class="help-block">' . $othertext . '</span>';
		$this->fieldsets[$fieldset] .= '</div>' . "\n";
		$this->fieldsets[$fieldset] .= '</div>' . "\n";
		$this->fieldsets[$fieldset] .= "\n\n";
	}
		
	//$firm->addSelect(1, "Pick One", "pickone", "ID", "explanation of this", array("this"=>"This", "that"=>"That Other") [,1, 1]);
	public function addSelect($fieldset, $caption, $name, $id='', $othertext='', $selectors, $required='', $disabled='') {
		if ( sizeof($selectors) == 0 ) return;
		$this->fieldsets[$fieldset] .= '<div class="control-group">' . "\n";
		$this->fieldsets[$fieldset] .= '<label for="'. $name . '" class="control-label">' . $caption . '</label>' . "\n";
		$this->fieldsets[$fieldset] .= '<div class="controls">' . "\n";
		$this->fieldsets[$fieldset] .= '<select  class="form-control" id="' . $id . '" name="'. $name . '"';
		if ( !empty($required) ) $this->fieldsets[$fieldset] .= ' required';
		if ( !empty($disabled) ) $this->fieldsets[$fieldset] .= ' disabled="disabled"';
		$this->fieldsets[$fieldset] .= '>' . "\n";
		$this->fieldsets[$fieldset] .= '<option>Select One</option>' . "\n";
		foreach ( $selectors as $value=>$htmldisplay ) {
			$this->fieldsets[$fieldset] .= '<option value="' . $value . '">' . $htmldisplay . '</option>' . "\n";
		}
		$this->fieldsets[$fieldset] .= '</select>' . "\n";
		if ( !empty($othertext) ) $this->fieldsets[$fieldset] .= '<span class="help-block">' . $othertext . '</span>';
		$this->fieldsets[$fieldset] .= '</div>' . "\n";
		$this->fieldsets[$fieldset] .= '</div>' . "\n";
		$this->fieldsets[$fieldset] .= "\n\n";
		
	}

	//$form->addRadioSet(1, "Radio One", "pickone", "ID", "explanation of this", array("this"=>"This", "that"=>"That Other") ,1, 1);
	public function addRadioSet($fieldset, $caption, $name, $id='', $othertext='', $selectors, $required='', $disabled=''){
		if ( sizeof($selectors) == 0 ) return;
		$this->fieldsets[$fieldset] .= '<div class="control-group">' . "\n";
  		$this->fieldsets[$fieldset] .= '<label for="' . $name . '" class="control-label">' . $caption . '</label>' . "\n";
  		$this->fieldsets[$fieldset] .= '<div id="' . $id . '" class="controls">' . "\n";
		foreach ( $selectors as $value=>$htmldisplay ) {
  			$this->fieldsets[$fieldset] .= '<label class="radio">' . "\n";
    		$this->fieldsets[$fieldset] .= '<input type="radio" value="' . $value . '" name="' . $name . '">' . $htmldisplay  . "\n";
     		$this->fieldsets[$fieldset] .= '</label>' . "\n";
		}
		if ( !empty($othertext) ) $this->fieldsets[$fieldset] .= '<span class="help-block">' . $othertext . '</span>';
      	$this->fieldsets[$fieldset] .= '</div>' . "\n";
  		$this->fieldsets[$fieldset] .= '</div>' . "\n";	
	}
	
	public function addText($fieldset, $text) {
		if ( strlen($text) == 0 ) return;
		$this->fieldsets[$fieldset] .= '<div>' . $text . '</div>' . "\n";
		}
	
	//$form->closingBlock(array('submit'=>'Submit Your Work','save'=>'Save Your Work','reset'=>'Reset'));
	//buttons will be IDd like "footer_save", "footer_submit" etc. 
	//use the bootstrap 2.3.2 definitions http://getbootstrap.com/2.3.2/base-css.html#buttons
	/* if this first member of a pair is ---- it will display -> ---------.
	''			-> black on grey
	'primary'	-> white on dark blue
	'info'		-> white on light blue
	'success'	-> white on green
	'warning'	-> white on orange
	'danger'	-> white on red
	'inverse' 	-> white on black
	'link'		-> blue on transparent, no border
	
	submit will transpose to success (green for go), save to info, and reset to warning
	*/
	public function closingBlock($elements) {
		$this->footer = '<div>';
		$i = 0;
		foreach ( $elements as $element=>$label ) {
			++$i;
			$this->footer .= '<button id="footer_' . $element . '" class="btn';
			if ( $element != '' ) $this->footer .= ' btn-';
			if ( $element == 'submit' ) $this->footer .= 'success';
			elseif ( $element == 'save' ) $this->footer .= 'info';
			elseif ( $element == 'reset' ) $this->footer .= 'warning';
			else $this->footer .= $element;
			$this->footer .= '">' . $label . '</button>&nbsp;';
		}
		$this->footer .= "</div>\n";
		//hidden response block can be used to display results of an ajax call
		$this->footer .= '<div class="alert-message" id="resultmessage"></div>' . "\n";
		//be sure to add the appropriate .js calls in the header, as well as your own functions to handle responses!
	}
	
	public function echoForm() {
		echo '<form method="' . $this->method . '" action="' . $this->action . '" id="' . $this->id . '" enctype="' . $this->enctype . '">' . "\n";;
		foreach ( $this->fieldsets as $fieldset ) {
			echo '<fieldset>';
			echo $fieldset;
			echo '</fieldset>' . "\n";	
		}
		echo $this->footer;
		echo '</form>' . "\n";
	}
	
	
}