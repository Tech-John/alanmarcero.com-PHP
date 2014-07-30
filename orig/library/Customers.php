<?php

class Customers {
	
	var $db;
	var $smarty;
	var $user;
	
	var $content;
	
	function Customers() {
		$this->db = &$GLOBALS['db'];
		$this->smarty = &$GLOBALS['smarty'];
		$this->user = new User();
			
		if(isset($_SESSION['email']))
			$this->show_items($_SESSION['email']);
		else
			header("Location: login.php");
			
		$this->user->echo_template($this->content);
	}
	
	
	function show_items($email) {
		$purchased_items = $this->user->get_purchased_items($email);
		
		$this->smarty->assign('purchased_items', $purchased_items);
		$this->smarty->assign('admin_email', ADMIN_EMAIL);
		$this->content = $this->smarty->fetch(PATH_TEMPLATES . 'purchased_items.html');
	}
}
?>