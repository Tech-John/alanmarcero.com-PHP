<?php

class PayPal {
	
	var $db;
	var $user;
	var $smarty;
	
	var $content;
	
	function PayPal() {
		$this->db = &$GLOBALS['db'];
		$this->smarty = &$GLOBALS['smarty'];
		$this->user = new User();
		
		$_SESSION['cart'] = null;
		
		$this->content = $this->smarty->fetch(PATH_TEMPLATES . 'paypal.html');
		$this->user->echo_template($this->content);
	}

}