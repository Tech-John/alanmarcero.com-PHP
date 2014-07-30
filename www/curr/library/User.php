<?php


class User {
	
	var $url_parameters;
	var $db;
	var $smarty;
	var $sendMail;

	function User() {
		$this->db = &$GLOBALS['db'];
		$this->smarty = &$GLOBALS['smarty'];
		$this->sendMail = &$GLOBALS['sendMail'];
		
		$bool_criteria = array('regex' => '/true/');
		$numbers_criteria = array('regex'=>'/[\d]+/');
		$text_criteria = array('required' => '');
		$price_criteria = array('regex'=>'/[0-9.,]+/');
		$password_criteria = array('regex'=>'/^[0-9a-zA-Z\-_@\.]+$/');
		$email_criteria = array('regex'=>'/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/');
		
		# Current Page
		$this->url_parameters['page'] = $this->val_or_default(@strtolower(@trim(@$_GET['page'])), $text_criteria, false);
		
		# Store variables
		$this->url_parameters['add_to_cart'] = $this->val_or_default(@strtolower(@trim(@$_GET['add_to_cart'])), $bool_criteria, false);
		$this->url_parameters['remove_from_cart'] = $this->val_or_default(@strtolower(@trim(@$_GET['remove_from_cart'])), $bool_criteria, false);
		$this->url_parameters['free_purchase'] = $this->val_or_default(@strtolower(@trim(@$_POST['free_purchase'])), $bool_criteria, false);
		$this->url_parameters['item_id'] = $this->val_or_default(@strtolower(@trim(@$_GET['item_id'])), $numbers_criteria, false);
		$this->url_parameters['price'] = $this->val_or_default(@strtolower(@trim(@$_GET['price'])), $price_criteria, false);
			# format price
			if($this->url_parameters['price']) $this->url_parameters['price'] = money_format('%i', (float) $this->url_parameters['price']);
	
		# PayPal variables
		$this->url_parameters['receiver_email'] = $this->val_or_default(@strtolower(@trim(@$_POST['receiver_email'])), $email_criteria, false);
		$this->url_parameters['payer_email'] = $this->val_or_default(@strtolower(@trim(@$_POST['payer_email'])), $email_criteria, false);
		
		# get the item numbers
		$this->url_parameters['item_numbers'] = array();
		
		# is it for an auction?
		$this->url_parameters['for_auction'] = $this->val_or_default(@strtolower(@trim(@$_POST['for_auction'])), $bool_criteria, false);
		if($this->url_parameters['for_auction']) {
			$this->url_parameters['item_name'] = $this->val_or_default(@strtolower(@trim(@$_POST['item_name1'])), $text_criteria, false);
			$item_id = $this->db->getOne("select store_entry_id from auction_items where auction_title = '{$this->url_parameters['item_name']}'");
			array_push($this->url_parameters['item_numbers'], $item_id);
		} else {
			$this->url_parameters['num_cart_items'] = $this->val_or_default(@strtolower(@trim(@$_POST['num_cart_items'])), $numbers_criteria, false);
				# typecast to int	
				$this->url_parameters['num_cart_items'] = (int) $this->url_parameters['num_cart_items'];
			
			for($i=1; $i <= $this->url_parameters['num_cart_items']; $i++) {
				array_push($this->url_parameters['item_numbers'], $this->val_or_default(@strtolower(@trim(@$_POST['item_number'.$i])), $numbers_criteria, false));
			}
		}
		
		
		# Login variables
		if(!isset($_SESSION['email']))
			$this->url_parameters['email'] = $this->val_or_default(@strtolower(@trim(@$_POST['email'])), $email_criteria, false);
		else
			$this->url_parameters['email'] = $_SESSION['email'];
		$this->url_parameters['password'] = $this->val_or_default(@strtolower(@trim(@$_POST['password'])), $password_criteria, false);
		$this->url_parameters['authorize'] = $this->val_or_default(@strtolower(@trim(@$_POST['authorize'])), $bool_criteria, false);
		$this->url_parameters['retrieve_pw'] = $this->val_or_default(@strtolower(@trim(@$_GET['retrieve_pw'])), $bool_criteria, false);
		$this->url_parameters['retrieve_pw_email'] = $this->val_or_default(@strtolower(@trim(@$_GET['retrieve_pw_email'])), $email_criteria, false);

		# email to opt out
		$this->url_parameters['opt_out'] = $this->val_or_default(@strtolower(@trim(@$_GET['opt_out'])), $email_criteria, false);

		# admin section variable
		$this->url_parameters['content'] = $this->val_or_default(stripslashes(@$_POST['content']), $text_criteria, false);
		$this->url_parameters['test'] = $this->val_or_default(@strtolower(@trim(@$_POST['test'])), $bool_criteria, false);
		$this->url_parameters['subject'] = $this->val_or_default(stripslashes(@$_POST['subject']), $text_criteria, false);
		
		

	}
	
	
	function echo_template($content, $admin = false) {
		$this->smarty->assign('content', $content);
		
		# get the store information
		$data = array();
		if(isset ($_SESSION['email']))
			$data['session_email'] = $_SESSION['email'];
		else
			$data['session_emal'] = false;

		$data['customer_count'] = number_format($this->db->getOne("SELECT count(*) FROM customers"));
		$data['item_count'] = number_format($this->db->getOne("SELECT count(*) FROM purchased_items"));
		$created_at = strtotime($this->db->getOne("SELECT created_at from purchased_items order by created_at desc limit 1"));
		$data['last_item'] = date('F j, o', $created_at) . " (" . $this->prettyTime($created_at) . ")";
		
		$this->smarty->assign('data', $data);
		echo $this->smarty->fetch(PATH_TEMPLATES . 'main.html');
	}
	
	
	function validate($field, $criteria) {
		
		// new field; reset error flag.
		$error = 0;
					
		// pass through all the criteria of this value
		foreach ($criteria as $criterium => $crit_value) {
			if ($criterium == 'required') {
				// required.  if doesn't exist, fail. 
				if (!$field) {
					$error = 1;
					break 1;
				}
			}
			elseif ($criterium == 'regex') {
				// check against a regular expression 
				if (!preg_match($crit_value, @$field)) {
					$error = 1;
					break 1;
				}
			} 
			elseif ($criterium == 'length') {
				$min = strtok($crit_value, '-');
				$max = strtok('-');
				if (strlen($field) < $min) {
					$error = 1;
					break;
				}
				if (strlen($field) > $max) {
					$error = 1;
					break;
				}
			}
			elseif ($criterium == 'range') {
				$min = strtok($crit_value, '-');
				$max = strtok('-');
				if ($field < $min) {
					$error = 1;
					break;
				}
				if ($field > $max) {
					$error = 1;
					break;
				}
			}
			elseif ($criterium == 'max_size') {
				if ($field > $crit_value) {
					$error = 1;
					break 1;
				} 
			}
		}
	
		// return true if all fields passed validation.
		if ($error == 0) 
			return true;
		else
			return false;
			
	} 	
	
	
	function val_or_default($field, $criteria, $default = '') {
		if ($this->validate($field, $criteria)) 
			return $field;
		else 
			return $default;
	}
    
    
    function get_customer($email) {
    	$customer_id = $this->db->getOne("select id from customers where email = '{$email}'");
    	if(!$customer_id) {
    		$random_password = $this->random_password();
    		
    		$this->db->query("insert into customers set email = '{$email}', password = '{$random_password}'");
    		$this->db->query("insert into promotional_emails set email = '{$email}'");

	    	$customer_id = $this->db->getOne("select id from customers where email = '{$email}'");
	    	
	    	$this->sendMail->account_information($email, $random_password);
	    #	$this->sendMail->opt_in($email);
    	}
    	return $customer_id;
    }
    
    
    function get_purchased_items($email) {
    	$customer_id = $this->get_customer($email);
    	$item_ids = $this->db->getCol("select store_entry_id from purchased_items where customer_id = {$customer_id}");
    	
    	$ids_string;
    	foreach($item_ids as $item_id) {
    		$ids_string .= "," . $item_id;
    	}
    	$ids_string = substr($ids_string, 1); # strip the first ", ";
    	return $this->db->getAll("select * from store_entries where id in ({$ids_string})");
    }
    
    
    function random_password() {
 		$chars = array("a", "b", "c", "d", "e", "f", "g", "h", "p", "r", "s", "t", "u", "v", "w", "x", "y", "z",
 						"2", "3", "4", "5", "6", "7", "8", "9",
 						"A", "B", "C", "D", "E", "F", "G", "H", "P", "R", "S", "T", "U", "V", "W", "X", "Y", "Z",
 						"2", "3", "4", "5", "6", "7", "8", "9");
 		$random_password = "";
 		for($i = 0; $i < 6; $i++) {
 			$random_password .= $chars[rand(0, count($chars) - 1)]; # -1 because count starts at 1
 		}
 		return $random_password;
    }
    
    
    function purchase_item($email, $item_id) {
    	$customer_id = $this->get_customer($email);
    	
    	# make sure the user didn't already buy the item
    	$query = "select id from purchased_items where customer_id = {$customer_id} AND store_entry_id = {$item_id}";
    	$result = $this->db->getOne($query);
    	if($result) { # already purchased, just update teh date
    		$query = "update purchased_items set created_at = now() where customer_id = {$customer_id} AND store_entry_id = {$item_id}";
    		$this->db->query($query);
    	} else { # haven't yet purchased, buy it!
    		$query = "insert into purchased_items set customer_id = {$customer_id}, store_entry_id = {$item_id}, created_at = now()";
    		$this->db->query($query);
     	}
    }
    
  	function is_admin($email) {
		$result = $this->db->getOne("select email from administrators where email = '{$email}'");
		if($result != '')	
			return true;
		else
			return false;
	}
	
	// input date must be in the past
	function prettyTime($timestamp) {
	    $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
	    $lengths = array("60","60","24","7","4.35","12","10");
	    $difference = time() - $timestamp;
	   
	    for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
	        $difference /= $lengths[$j];
	    }
	    
	    $difference = round($difference);
	    if($difference != 1) $periods[$j].= "s";
	    
	    return $difference . " " . $periods[$j] . " ago";
	}
	
}