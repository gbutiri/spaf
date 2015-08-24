<?php 
global $dbi;
$dbi = mysqli_connect(_DBHOST,_DBUSER,_DBPASS,_DBNAME);

function sql_run ($sql, $types = "", $params = array(), $debug = false, $getData = false) {
	sql_get($sql, $types, $params, $debug, $getData);
}

function sql_run_get_id ($sql, $types = "", $params = array(), $debug = false, $getData = false, $getId = true) {
	return sql_get($sql, $types, $params, $debug, $getData, $getId);
}

function sql_get ($sql, $types = "", $params = array(), $debug = false, $getData = true, $getId = false) {
	if (!is_array($params)) {
		var_dump( "Error! Make your parameters an array!" );
		return array();
	}
	global $dbi;
	
    $dbi->set_charset("utf8");
    $stmt = $dbi->prepare($sql);
	
	if (false === $stmt) {
		var_dump(array(
            "errno" => $dbi->errno, 
            "error" => $dbi->error,
			"sql-error" => true,
			"sql" => $sql,
			"params" => $params
		));
		echo $sql;
	}
	
	if ($types !== "" && count($params) > 0) {
		$bind_names[] = $types;
		for ($i = 0; $i < count($params); $i++) {
			$bind_name = "bind" . $i;
			$$bind_name = $params[$i];
			$bind_names[] = &$$bind_name;
		}
		call_user_func_array(array($stmt, 'bind_param'), $bind_names);
	}
	
	$stmt->execute();
	
	if ($getId) {
		$retId = $stmt->insert_id;
		$stmt->close();
		return $retId;
	}
	
	
	if ($getData) {
		$res = $stmt->get_result();
		
		$vntRet = array();
		
		while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
			$vntRet[] = $row;
		}
		if ($debug) {
			echo ('<pre>');
			var_dump($vntRet);
			echo ('</pre>');
		}
		
		$stmt->close();
		return $vntRet;
	} else {
		$stmt->close();
	}
}
?>