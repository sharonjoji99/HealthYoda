<?php
	error_reporting(0);
	$json = $_GET['json'];
	$json = json_decode($json);

	$phno = pg_escape_string($json->phno);
	$password = hash("sha256", pg_escape_string($json->password));//pg_escape_string($json->password));
	
	$con = pg_connect("host=localhost port=5432 dbname=healthyoda user=postgres password=xpert101");
	$qry = "SELECT pass FROM tbl_user WHERE phno = '".$phno."'";
	$select = pg_query($con, $qry);

	if(pg_num_rows($select)){
		$check = pg_fetch_row($select)[0];
		if($password == $check){
			$res->e_code = 0;
			$res->e_msg = "User login successfull";
		}
		else{
			$res->e_code = 1;
			$res->e_msg = "Wrong user credentials";
		}
	}
	else{
		$res->e_code = 2;
		$res->e_msg = "User not registered";
	}

	echo "[".json_encode($res)."]";
?>