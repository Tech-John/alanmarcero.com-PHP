<?php

class DB {
	
	function DB() {
		$connection = mysql_connect(MYSQL_HOST, MYSQL_USERNAME, MYSQL_PASSWORD);
		mysql_select_db(MYSQL_DB, $connection);
	}
	
	
	function getOne($q) {
		$result = $this->query($q);
		$row = mysql_fetch_row($result);
		if($row)
			return $row[0];
		else
			return $row;
	}
	
	
	function getRow($q) {
		$result = $this->query($q);
		$row = mysql_fetch_array($result);
		return $row;
	}
	
	
	function getAll($q) {
		$result = $this->query($q);
		
		$full_table = array();
		while ($row = mysql_fetch_array($result)) {
			$full_table[] = $row;
		}
		return $full_table;
	}
	
	
	function getCol($q, $col = 0) {
		$result = $this->getAll($q);
		$col_array = array();
		foreach ($result as $row) {
			$col_array[] = $row[$col];
		} 
		return $col_array;
	}
	
	
	function query($q) {
		$result = mysql_query($q);
		if(!$result) {
#			mail(ADMIN_EMAIL, 'query error', mysql_error() . '         ' . $q);
		} else {
			return $result;
		}
	}

}

?>