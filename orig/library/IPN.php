<?php

class IPN {
	
	var $db;
	var $user;
	var $sendMail;
	
	function IPN() {
		$this->db = &$GLOBALS['db'];
		$this->user = new User();
		$this->sendMail = &$GLOBALS['sendMail'];
		
		if(($this->user->url_parameters['receiver_email'] == ADMIN_EMAIL || PAYPAL_TEST) && count($this->user->url_parameters['item_numbers']) > 0) {
			$cart = array();
			foreach($this->user->url_parameters['item_numbers'] as $item_id) {
				$this->user->purchase_item($this->user->url_parameters['payer_email'], $item_id);
				array_push($cart, $this->db->getRow("select * from store_entries where id = {$item_id}"));
			}
			$password = $this->db->getOne("select password from customers where email = '" . $this->user->url_parameters['payer_email'] . "'");
			$this->sendMail->purchase_confirm($cart, $this->user->url_parameters['payer_email'], $password);
		} 
	}

}