<?php

class OptOut {
	
	var $db;
	var $smarty;
	var $user;
	var $sendMail;
	
	var $content;
	
	function OptOut() {
		$this->db = &$GLOBALS['db'];
		$this->smarty = &$GLOBALS['smarty'];
		$this->user = new User();
		$this->sendMail = &$GLOBALS['sendMail'];
		
		$this->db->query("delete from promotional_emails where email = '" . $this->user->url_parameters['opt_out'] . "'");
		
		$this->smarty->assign('email', $this->user->url_parameters['opt_out']);
		$this->content = $this->smarty->fetch(PATH_TEMPLATES . "opt_out.html");
		$this->sendMail->opt_out($this->user->url_parameters['opt_out']);
		
		$this->user->echo_template($this->content);
	}
	
}
?>