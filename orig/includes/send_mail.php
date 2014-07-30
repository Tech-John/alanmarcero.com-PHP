<?php

class SendMail {
	
	var $smarty;
	
	function SendMail() {
		$this->smarty = &$GLOBALS['smarty'];
	}
	
	function purchase_confirm($cart, $email, $password, $free) {
		$subject = "Your AlanMarcero.com Purchase";
		$this->smarty->assign('cart', $cart);
		$this->smarty->assign('email', $email);
		$this->smarty->assign('password', $password);
		$content = $this->smarty->fetch(PATH_TEMPLATES . '/mail/purchase_confirm.html');
		if(PAYPAL_TEST) mail(ADMIN_EMAIL, $subject, $content, "From: " . ADMIN_EMAIL);
		elseif($free) mail($email, $subject, $content, "From: " . ADMIN_EMAIL);
		else mail($email, $subject, $content, "From: " . ADMIN_EMAIL . "\r\n" . "Cc: " . ADMIN_EMAIL . "\r\n");
	}


	function account_information($email, $password)	 {
		$subject = "Your AlanMarcero.com Account Information";
		$this->smarty->assign('email', $email);
		$this->smarty->assign('password', $password);
		$content = $this->smarty->fetch(PATH_TEMPLATES . '/mail/account_information.html');
		if(PAYPAL_TEST) mail(ADMIN_EMAIL, $subject, $content, "From: " . ADMIN_EMAIL);
		else mail($email, $subject, $content, "From: " . ADMIN_EMAIL);
	}

	
	function opt_in($email) {
		$subject = "AlanMarcero.com Product Notification Opt-In";
		$this->smarty->assign('email', $email);
		$content = $this->smarty->fetch(PATH_TEMPLATES . '/mail/opt_in.html');
		if(PAYPAL_TEST) mail(ADMIN_EMAIL, $subject, $content, "From: " . ADMIN_EMAIL);
		else mail($email, $subject, $content, "From: " . ADMIN_EMAIL);
	}
	
	
	function opt_out($email) {
		$subject = "AlanMarcero.com Product Notification Opt-Out";
		$this->smarty->assign('email', $email);
		$content = $this->smarty->fetch(PATH_TEMPLATES . '/mail/opt_out.html');
		if(PAYPAL_TEST) mail(ADMIN_EMAIL, $subject, $content, "From: " . ADMIN_EMAIL);
		else mail($email, $subject, $content, "From: " . ADMIN_EMAIL);
	}
	
	
	function account_information_altered($email, $password) {
		$subject = "Your AlanMarcero.com Account Information";
		$this->smarty->assign('email', $email);
		$this->smarty->assign('password', $password);
		$content = $this->smarty->fetch(PATH_TEMPLATES . '/mail/account_information_altered.html');
		if(PAYPAL_TEST) mail(ADMIN_EMAIL, $subject, $content, "From: " . ADMIN_EMAIL);
		else mail($email, $subject, $content, "From: " . ADMIN_EMAIL);
	}
	
	
	function promotional_email($subject, $content, $email) {
		if(PAYPAL_TEST) mail(ADMIN_EMAIL, $subject, $content, "From: " . ADMIN_EMAIL);
		else mail($email, $subject, $content, "From: " . ADMIN_EMAIL);
	}

}

?>