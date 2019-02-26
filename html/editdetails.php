<?php
	error_reporting(0);
	$json = $_GET['json'];
	$json = json_decode($json);

	$con = pg_connect("host=localhost port=5432 dbname=healthyoda user=postgres password=xpert101");

	$user = $json->uid;
	$gender = $json->gender;
	$a = $json->age;
	$b = $json->vit_d;
	$c = $json->cholesterol;
	$d = $json->glucose;
	$e = $json->bp;
	$f = $json->bmi;

	$cmd = "/home/shashankh/anaconda3/bin/python3 /var/www/html/python/check.py $a $b $c $d $e $f";
	
	$out = shell_exec($cmd);

	if($gender){
		$out = $out * 0.75;
	}
	$out = ceil($out);

	$qry = "INSERT INTO tbl_report(user_id, gender, age, vit_d, cholesterol, glucose, bp, bmi, calorie_target) VALUES ($user,$gender,$a,$b,$c,$d,$e,$f,$out);";	
	pg_query($con, $qry);

	echo $out;
?>