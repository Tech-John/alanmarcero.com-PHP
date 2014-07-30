<?php

class Logout {
	
	function Logout() {
		$_SESSION['email'] = null;

		header("Location: index.php");	
	}
	
}
?>