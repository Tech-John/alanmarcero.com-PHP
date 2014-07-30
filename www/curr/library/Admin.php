<?php

set_time_limit(0);

class Admin {
	
	var $db;
	var $smarty;
	var $user;
	var $sendMail;
	
	var $content;
	
	function Admin() {
		$this->db = &$GLOBALS['db'];
		$this->smarty = &$GLOBALS['smarty'];
		$this->user = new User();
		$this->sendMail = &$GLOBALS['sendMail'];
		
		if(isset($_SESSION['email']) && $this->user->is_admin($_SESSION['email'])) {
			if($this->user->url_parameters['subject']) {
				$this->send_promo_email($this->user->url_parameters['test']);
			}
			$this->content = $this->smarty->fetch(PATH_TEMPLATES . "send_promotional_email.html");	
		} else
			header("Location: login.php");
			
		$this->user->echo_template($this->content, true);
	}
	
	function send_promo_email($test) {
		$message = '';
		$email_content = '';
		$this->smarty->assign('content', $this->user->url_parameters['content']);
		if($test) {
			$this->smarty->assign('email', ADMIN_EMAIL);
			$email_content = $this->smarty->fetch(PATH_TEMPLATES . "mail/promotional_email.html");
			$this->sendMail->promotional_email($this->user->url_parameters['subject'], $email_content, ADMIN_EMAIL);
			$message = 'A test email has been sent to only ' . ADMIN_EMAIL . '.';
		} else {
			$emails = $this->db->getCol('select email from promotional_emails');
			foreach($emails as $email) {
				$this->smarty->assign('email', $email);
				$email_content = $this->smarty->fetch(PATH_TEMPLATES . "mail/promotional_email.html");
				$this->sendMail->promotional_email($this->user->url_parameters['subject'], $email_content, $email);				
				$message = 'The promotional email has been sent to all recipients.';
			}
		}
		
		$this->smarty->assign('message', $message);
	}
}
?>