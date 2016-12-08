<?
	class mailer {
		public $message; //the message body
		public $to;
		public $bcc; //literal list, tom@tom-mcgee.com, thomas.a.mcgee@gmail.com. These will 
		public $cc; //literal list
		public $sender;
		public $subject;
		private $headers;
		public $result;
		public $config;
		
		public function __construct($config, $sender, $to, $cc, $bcc, $subject, $message) {
			//echo 'constructing...';
			include_once ("Mail.php");
			$headers['To'] = $to;
			$headers['Subject'] = $subject;
			$headers['Mime-Version'] = '1.0';
			$headers['Content-type'] = 'text/html';
			$headers['charsset'] = 'iso-8859-1';
			$headers['From'] = $sender;
			$recipients = $to;
			if ( !empty($cc) ) {
				$headers['Cc'] = $cc;
				$recipients .= ',' . $cc;
			}
			if ( !empty($bcc) ) $recipients .= ', ' . $bcc;
			$this->result = $this->sendMessage($config, $recipients, $headers, $message);
		}
		
		public function __toString() {
			return $this->result;
		}
		
		private function sendMessage($config, $recipients, $headers, $message) {
			//print_r($headers);
			//echo 'sending ' . implode('<br />', array($recipients, $message));
			//print_r($config);
			$smtpinfo = array('host'=>$config['mailhost'], 'port'=>$config['mailport']);
			//print_r($smtpinfo);
			$smtp = Mail::factory('smtp', $smtpinfo);
			$mail = $smtp->send($recipients, $headers, $message);
			
			if (PEAR::isError($mail)) {
			  return("<p>" . $mail->getMessage() . "</p>");
			 } else {
			  return("Message successfully sent");
			 }
		}
	}
?>