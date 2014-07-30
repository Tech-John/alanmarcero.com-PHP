<?php

class Store {
	
	var $db;
	var $smarty;
	var $user;
	var $sendMail;
	
	var $content;
	
	function Store() {
		$this->db = &$GLOBALS['db'];
		$this->smarty = &$GLOBALS['smarty'];
		$this->user = new User();
		$this->sendMail = &$GLOBALS['sendMail'];
			
		if($this->user->url_parameters['add_to_cart']) 
			$this->add_to_cart($this->user->url_parameters['item_id'], $this->user->url_parameters['price']);
		elseif($this->user->url_parameters['remove_from_cart']) 
			$this->remove_from_cart($this->user->url_parameters['item_id']);
		elseif($this->user->url_parameters['free_purchase'])
			$this->free_purchase($this->user->url_parameters['email']);
		elseif($this->user->url_parameters['page'] == 'about')
			$this->show_about();
		else
			$this->show_store();
			
		$this->user->echo_template($this->content);
	}
	
	
	function calculate_subtotal() {
		$subtotal = 0.00;
		foreach($_SESSION['cart'] as $item)
			$subtotal += $item['price'];
			
		return $subtotal;
	}
	
	
	function add_to_cart($item_id, $price) {
		# don't add it if the item is already in the cart, just change the price
		$add_item = true;
		for($i=0; $i < count($_SESSION['cart']); $i++) {
			if($_SESSION['cart'][$i]['item_id'] == $item_id) {
				$_SESSION['cart'][$i]['price'] = $price;
				$add_item = false;
			}
		}
		
		$item = array("item_id" => $item_id, "price" => $price);
		if($add_item) {
			array_push($_SESSION['cart'], $item);
		}
		$this->show_cart();
	}
	
	
	function remove_from_cart($item_id) {
		$new_cart = array();
		for($i=0; $i < count($_SESSION['cart']); $i++) {
			if($_SESSION['cart'][$i]['item_id'] != $item_id) {
				array_push($new_cart, $_SESSION['cart'][$i]);
			}
		}
		$_SESSION['cart'] = $new_cart;
		$this->show_cart();
	}
	
	function free_purchase($email) {
		$cart = array();
		foreach($_SESSION['cart'] as $item) {
			$result = $this->db->getRow('select * from store_entries where id = ' . $item['item_id']);
			$result['price'] = $item['price'];
			array_push($cart, $result);
			if($email) $this->user->purchase_item($email, $item['item_id']);
		}
		
		if($email) $password = $this->db->getOne("select password from customers where email = '" . $email . "'");
		if($email) $this->sendMail->purchase_confirm($cart, $email, $password, true);
		
		$this->smarty->assign('cart', $cart);
		$this->smarty->assign('subtotal', $this->calculate_subtotal());
		$this->smarty->assign('email', $email);
		if($email) $_SESSION['email'] = $email;
		if($email) $_SESSION['cart'] = null;
		
		$this->content = $this->smarty->fetch(PATH_TEMPLATES . 'free_purchase.html');
	}
	
	
	function show_store() {
		$items = $this->db->getAll('select * from store_entries order by display_position');
		$this->smarty->assign('items', $items);
		$this->content = $this->smarty->fetch(PATH_TEMPLATES . 'store.html');
	}
	
	
	function show_about() {
		$this->content = $this->smarty->fetch(PATH_TEMPLATES . 'about.html');
	}
	
	
	function show_cart($free_purchase = false) {
		$cart = array();
		foreach($_SESSION['cart'] as $item) {
			$result = $this->db->getRow('select * from store_entries where id = ' . $item['item_id']);
			$result['price'] = $item['price'];
			array_push($cart, $result);
		}
		
		$this->smarty->assign('cart', $cart);
		$this->smarty->assign('subtotal', $this->calculate_subtotal());
		$this->smarty->assign('paypal_test', PAYPAL_TEST);
		if(PAYPAL_TEST)
			$this->smarty->assign('admin_email', PAYPAL_TEST_EMAIL);
		else
			$this->smarty->assign('admin_email', ADMIN_EMAIL);
		$this->content = $this->smarty->fetch(PATH_TEMPLATES . 'cart.html');
	}
}
?>