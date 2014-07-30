<?php

class Login {
	
	var $db;
	var $smarty;
	var $user;
	var $sendMail;
	
	var $content;
	var $is_admin;
	
	function Login() {
		$this->db = &$GLOBALS['db'];
		$this->smarty = &$GLOBALS['smarty'];
		$this->user = new User();
		$this->sendMail = &$GLOBALS['sendMail'];
		
		if($this->user->url_parameters['retrieve_pw'] || $this->user->url_parameters['retrieve_pw_email'])
			$this->retrieve_pw($this->user->url_parameters['retrieve_pw_email']);
		elseif(!isset($_SESSION['email'])) {
			if($this->user->url_parameters['authorize']) {
				
				# see if the user is an admin
				$this->is_admin = $this->user->is_admin($this->user->url_parameters['email']);
				
				# authorize the user as either admin or customer
				$authorized = $this->authorize($this->user->url_parameters['email'], $this->user->url_parameters['password']);
				
				# the authorization failed
				if(!$authorized)
					$this->show_login_form(true);
				else { 
					# create session and redirect
					$_SESSION['email'] = $this->user->url_parameters['email'];
					if($this->is_admin)
						header("Location: admin.php");
					else
						header("Location: customers.php");
				}
			} else {
				$this->show_login_form();
			}
		} else	
			header("Location: customers.php");
			
		$this->user->echo_template($this->content);
	}
	
	
	function show_login_form($login_failed = false) {
		$this->smarty->assign('login_failed', $login_failed);
		$this->content = $this->smarty->fetch(PATH_TEMPLATES . "login.html");
	}
		
	function authorize($email, $password) {
		
		if($this->is_admin)
			$query = "select email from administrators where email = '{$email}' and password = md5('{$password}')";
		else
			$query = "select email from customers where email = '{$email}' and password = '{$password}'";
		$result = $this->db->getOne($query);
		
		if($result)
			return true;
		else
			return false;
	}
	
	function retrieve_pw($email) {
		$message = '';
		if($email) {
			$password = $this->db->getOne("select password from customers where email = '{$email}'");
			if($password != '') {
				$this->sendMail->account_information($email, $password);
				$message = "Your login and password has been sent to {$email}.";
			}
			else
				$message = "The email you entered, {$email}, is not associated with AlanMarcero.com.";
		} else {
			$message = "Please enter your email address.  This is typically the same address you have associated with PayPal.";
		}
		
		$this->smarty->assign('message', $message);
		$this->content = $this->smarty->fetch(PATH_TEMPLATES . "retrieve_pw.html");	
	}
	
}
?>