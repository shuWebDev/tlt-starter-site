<?
//the basic header information common to the project
class head {
	public function __construct($title) {
		$this->title = $title;
		$this->meta = '<meta name="viewport" content="width=device-width, initial-scale=1.0">' . "\n";
		$this->css = <<<'END'
<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />
<link type="text/css" rel="stylesheet" href="css/bootstrap-responsive.min.css" />
<link type="text/css" rel="stylesheet" href="css/bootstrap-select.min.css" />
<link type="text/css" rel="stylesheet" href="css/jquery-ui-1.10.4.custom.min.css" />
<link type="text/css" rel="stylesheet" href="css/tabs.css" />
<link type="text/css" rel="stylesheet" href="css/style.css" />
		
END;

		$this->js = <<<'EJS'
<script src="js/jquery-1.11.0.min.js" type="text/javascript"></script>
<script src="js/jquery.validate.min.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<script src="js/bootstrap-select.min.js" type="text/javascript"></script>
<script src="js/jquery-ui-1.10.4.custom.min.js" type="text/javascript"></script>
<script src="js/additional-methods.min.js" type="text/javascript"></script>	

EJS;
			
	}
    public function add_css($css) { //relative path, as above
    	$this->css .= '<link type="text/css" rel="stylesheet" href="' . $css .'" />' . "\n";
    }
    
    public function add_js($js) { //relative path, as above
    	$this->js .= '<script src="' . $js .'" type="text/javascript"></script>' . "\n";
    }
        
    public function add_meta($nm,$vl) {
    	$this->meta .= '<meta name="' . $nm . '" content="' . $vl . '">' . "\n" ;
    }
        
    public function print_title() {
    	return $this->title;
    }
    
    public function print_css() {
    	return $this->css;
    }
    
    public function print_js() {
    	return $this->js;
     }
     
    public function print_meta() {
     	return $this->meta;
     }
     
     
}