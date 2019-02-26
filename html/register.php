<?php
	error_reporting(0);
	$json = $_GET['json'];
	$json = json_decode($json);
	
	$name = pg_escape_string($json->name);
	$password = hash("sha256", pg_escape_string($json->password));
	$email_id = pg_escape_string($json->email);
	$phno = pg_escape_string($json->phno);
	$city = pg_escape_string($json->city);

	$con = pg_connect ("host=localhost port=5432 dbname=healthyoda user=postgres password=xpert101");
	$qry = "INSERT INTO tbl_user(user_name, email_id, phno, pass, city) VALUES ('".$name."','".$email_id."','".$phno."','".$password."','".$city."');";
	$insert = pg_query ($con, $qry);

	if($insert){
		$res->e_code = 0;
		$res->e_msg = "Registration Successful";
	}
	else{
		$res->e_code = 1;
		$res->e_msg = "User already registered";
	}
	
	echo "[".json_encode($res)."]";
?>