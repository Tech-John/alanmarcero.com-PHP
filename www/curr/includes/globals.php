<?php	
	define('PAYPAL_TEST', false);
	define('ADMIN_EMAIL', "alanmarcero@gmail.com");
	define('PAYPAL_TEST_EMAIL', "alanma_1243449237_biz@gmail.com");	
	
	// production server database info
	define('MYSQL_HOST', 'amarcero.db.7128071.hostedresource.com');
	define('MYSQL_USERNAME', 'amarcero');
	define('MYSQL_PASSWORD', 'Aero1smith');
	define('MYSQL_DB', 'amarcero');

	// directory info
	if(PAYPAL_TEST)
		define('PATH_BASE', '/home/content/71/7128071/html/beta/');
	else
		define('PATH_BASE', '/home/content/71/7128071/html/');
	define('PATH_TEMPLATES', PATH_BASE . '/templates/');
	define('PATH_LIBRARY', PATH_BASE . '/library/');
	define('PATH_INCLUDES', PATH_BASE . '/includes/');
	define('PATH_SMARTY', PATH_BASE . 'Smarty/');
	
	// create the db global
	require_once(PATH_INCLUDES . 'db.php');
	$GLOBALS['db'] = new DB();
	
	// create the mailer sendMail global
	require_once(PATH_INCLUDES . 'send_mail.php');
	$GLOBALS['sendMail'] = new SendMail();
	
	// create the smarty global
	require_once(PATH_SMARTY . 'libs/Smarty.class.php');
	$GLOBALS['smarty'] = new Smarty();
	$GLOBALS['smarty']->template_dir = PATH_TEMPLATES;
	$GLOBALS['smarty']->compile_dir = PATH_BASE . 'templates_c';
	$GLOBALS['smarty']->cache_dir = PATH_BASE . 'cache';
	$GLOBALS['smarty']->config_dir = PATH_BASE . 'configs';
	$GLOBALS['smarty']->caching = FALSE;
	$GLOBALS['smarty']->force_compile = TRUE;
	$GLOBALS['smarty']->clear_all_cache();

	// set the session data
	if(!isset($_SESSION))
		session_start();
		
	if(!isset($_SESSION['cart']))
		$_SESSION['cart'] = array();
	
	
?>
