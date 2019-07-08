<?php
if(isset($_POST["save16"])){
	$week_end=clean($_POST["week_end"]);$serial_no=clean($_POST["serial_no"]);$nature=clean($_POST["nature"]);$group_no=clean($_POST["group_no"]);$transfers=clean($_POST["transfers"]);$holidays=clean($_POST["holidays"]);$lost_day=clean($_POST["lost_day"]);$remarks=clean($_POST["remarks"]);	
	
	if(!empty($_POST["worker"])) $worker=json_encode($_POST["worker"]);
	else $worker=NULL;
	if(!empty($_POST["in1"])) $in1=json_encode($_POST["in1"]);
	else $in1=NULL;
	if(!empty($_POST["in2"]))	 $in2=json_encode($_POST["in2"]);
	else	$in2=NULL;
	if(!empty($_POST["in3"]))	 $in3=json_encode($_POST["in3"]);
	else	$in3=NULL;
	if(!empty($_POST["in4"]))	 $in4=json_encode($_POST["in4"]);
	else	$in4=NULL;
	if(!empty($_POST["out1"]))	 $out1=json_encode($_POST["out1"]);
	else	$out1=NULL;
	if(!empty($_POST["out2"]))	 $out2=json_encode($_POST["out2"]);
	else	$out2=NULL;
	if(!empty($_POST["out3"]))	 $out3=json_encode($_POST["out3"]);
	else	$out3=NULL;
	if(!empty($_POST["out4"]))	 $out4=json_encode($_POST["out4"]);
	else	$out4=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,week_end,serial_no,nature,group_no,transfers,holidays,lost_day,remarks,worker,in1,in2,in3,in4,out1,out2,out3,out4) values ('$swr_id','$today','$week_end','$serial_no','$nature','$group_no','$transfers','$holidays','$lost_day','$remarks','$worker','$in1','$in2','$in3','$in4','$out1','$out2','$out3','$out4')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',week_end='$week_end',serial_no='$serial_no',nature='$nature',group_no='$group_no',transfers='$transfers',holidays='$holidays',lost_day='$lost_day',remarks='$remarks',worker='$worker',in1='$in1',in2='$in2',in3='$in3',in4='$in4',out1='$out1',out2='$out2',out3='$out3',out4='$out4' where form_id=$form_id");		
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php';
		</script>";
	}	
}

if(isset($_POST["save17"])){
	$serial_no=clean($_POST["serial_no"]);$father_name=clean($_POST["father_name"]);$first_dt=clean($_POST["first_dt"]);$letter=clean($_POST["letter"]);$remarks=clean($_POST["remarks"]);$relay_no=clean($_POST["relay_no"]);$token_no=clean($_POST["token_no"]);
	
	if(!empty($_POST["worker"])) $worker=json_encode($_POST["worker"]);
	else $worker=NULL;
	if(!empty($_POST["certificate"])) $certificate=json_encode($_POST["certificate"]);
	else $certificate=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,serial_no,father_name,first_dt,letter,remarks,worker,certificate,relay_no,token_no) values ('$swr_id','$today','$serial_no','$father_name','$first_dt','$letter','$remarks','$worker','$certificate','$relay_no','$token_no')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',serial_no='$serial_no',father_name='$father_name',first_dt='$first_dt',letter='$letter',remarks='$remarks',worker='$worker',certificate='$certificate',relay_no='$relay_no',token_no='$token_no' where form_id=$form_id");		
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php';
		</script>";
	}	
}

if(isset($_POST["save18"])){											
	$serial_no=clean($_POST["serial_no"]);$child=clean($_POST["child"]);$department=clean($_POST["department"]);$name_child=clean($_POST["name_child"]);$child_serial=clean($_POST["child_serial"]);$father_name=clean($_POST["father_name"]);$entry_dt=clean($_POST["entry_dt"]);$discharge_dt=clean($_POST["discharge_dt"]);$service_year=clean($_POST["service_year"]);$is_leave=clean($_POST["is_leave"]);$balance=clean($_POST["balance"]);$remarks=clean($_POST["remarks"]);
	
	if(!empty($_POST["payment"])) $payment=json_encode($_POST["payment"]);
	else $payment=NULL;
	if(!empty($_POST["period"])) $period=json_encode($_POST["period"]);
	else $period=NULL;
	if(!empty($_POST["wage"]))	 $wage=json_encode($_POST["wage"]);
	else	$wage=NULL;
	if(!empty($_POST["days"]))	 $days=json_encode($_POST["days"]);
	else	$days=NULL;
	if(!empty($_POST["credit"]))	 $credit=json_encode($_POST["credit"]);
	else	$credit=NULL;
	if(!empty($_POST["leaves"]))	 $leaves=json_encode($_POST["leaves"]);
	else	$leaves=NULL;
	if(!empty($_POST["rate"]))	 $rate=json_encode($_POST["rate"]);
	else	$rate=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,serial_no,child,department,name_child,child_serial,father_name,entry_dt,discharge_dt,service_year,is_leave,balance,remarks,payment,period,wage,days,credit,leaves,rate) values ('$swr_id','$today','$serial_no','$child','$department','$name_child','$child_serial','$father_name','$entry_dt','$discharge_dt','$service_year','$is_leave','$balance','$remarks','$payment','$period','$wage','$days','$credit','$leaves','$rate')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',serial_no='$serial_no',child='$child',department='$department',name_child='$name_child',child_serial='$child_serial',father_name='$father_name',entry_dt='$entry_dt',discharge_dt='$discharge_dt',service_year='$service_year',is_leave='$is_leave',balance='$balance',remarks='$remarks',payment='$payment',period='$period',wage='$wage',days='$days',credit='$credit',leaves='$leaves',rate='$rate' where form_id=$form_id");		
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php';
		</script>";
	}	
}

if(isset($_POST["save20"])){											
	$serial_no=clean($_POST["serial_no"]);$child=clean($_POST["child"]);$department=clean($_POST["department"]);$name_child=clean($_POST["name_child"]);$child_serial=clean($_POST["child_serial"]);$father_name=clean($_POST["father_name"]);$entry_dt=clean($_POST["entry_dt"]);$discharge_dt=clean($_POST["discharge_dt"]);$service_year=clean($_POST["service_year"]);$is_leave=clean($_POST["is_leave"]);$balance=clean($_POST["balance"]);$remarks=clean($_POST["remarks"]);
	
	if(!empty($_POST["payment"])) $payment=json_encode($_POST["payment"]);
	else $payment=NULL;
	if(!empty($_POST["period"])) $period=json_encode($_POST["period"]);
	else $period=NULL;
	if(!empty($_POST["wage"]))	 $wage=json_encode($_POST["wage"]);
	else	$wage=NULL;
	if(!empty($_POST["days"]))	 $days=json_encode($_POST["days"]);
	else	$days=NULL;
	if(!empty($_POST["credit"]))	 $credit=json_encode($_POST["credit"]);
	else	$credit=NULL;
	if(!empty($_POST["leaves"]))	 $leaves=json_encode($_POST["leaves"]);
	else	$leaves=NULL;
	if(!empty($_POST["rate"]))	 $rate=json_encode($_POST["rate"]);
	else	$rate=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,serial_no,child,department,name_child,child_serial,father_name,entry_dt,discharge_dt,service_year,is_leave,balance,remarks,payment,period,wage,days,credit,leaves,rate) values ('$swr_id','$today','$serial_no','$child','$department','$name_child','$child_serial','$father_name','$entry_dt','$discharge_dt','$service_year','$is_leave','$balance','$remarks','$payment','$period','$wage','$days','$credit','$leaves','$rate')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',serial_no='$serial_no',child='$child',department='$department',name_child='$name_child',child_serial='$child_serial',father_name='$father_name',entry_dt='$entry_dt',discharge_dt='$discharge_dt',service_year='$service_year',is_leave='$is_leave',balance='$balance',remarks='$remarks',payment='$payment',period='$period',wage='$wage',days='$days',credit='$credit',leaves='$leaves',rate='$rate' where form_id=$form_id");		
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php';
		</script>";
	}	
}

if(isset($_POST["save21"])){
	$input_size1=$_POST["hiddenval"];$input_size2=$_POST["hiddenval2"];
	$serial_no=clean($_POST["serial_no"]);$works_no=clean($_POST["works_no"]);$worker_name=clean($_POST["worker_name"]);$sex=clean($_POST["sex"]);$age=clean($_POST["age"]);$employ_date=clean($_POST["employ_date"]);$leave_date=clean($_POST["leave_date"]);$reason=clean($_POST["reason"]);$nature=clean($_POST["nature"]);$raw_material=clean($_POST["raw_material"]);$sus_period=clean($_POST["sus_period"]);$sus_reason=clean($_POST["sus_reason"]);$resume_dt=clean($_POST["resume_dt"]);$is_issued=clean($_POST["is_issued"]);$surgeon_sign=clean($_POST["surgeon_sign"]);	
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,serial_no,works_no,worker_name,sex,age,employ_date,leave_date,reason,nature,raw_material,sus_period,sus_reason,resume_dt,is_issued,surgeon_sign) values ('$swr_id','$today','$serial_no','$works_no','$worker_name','$sex','$age','$employ_date','$leave_date','$reason','$nature','$raw_material','$sus_period','$sus_reason','$resume_dt','$is_issued','$surgeon_sign')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',serial_no='$serial_no',works_no='$works_no',worker_name='$worker_name',sex='$sex',age='$age',employ_date='$employ_date',leave_date='$leave_date',reason='$reason',nature='$nature',raw_material='$raw_material',sus_period='$sus_period',sus_reason='$sus_reason',resume_dt='$resume_dt',is_issued='$is_issued',surgeon_sign='$surgeon_sign' where form_id=$form_id");		
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form);  
		if($input_size1!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size1;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,slno,name,from_dt,to_dt) VALUES ('','$form_id','$i','$valb','$valc','$vald')") ;
			}
		}
		if($input_size2!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				//$vala=$_POST["textA".$i];		
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(id,form_id,slno,exam_dt,result) VALUES ('','$form_id','$i','$valb','$valc')") ;
			}
		}
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php';
		</script>";
	}	
}

if(isset($_POST["save22"])){
	$worker_name=clean($_POST["worker_name"]);$serial_no=clean($_POST["serial_no"]);$father_name=clean($_POST["father_name"]);$age=clean($_POST["age"]);$birth_date=clean($_POST["birth_date"]);$nature=clean($_POST["nature"]);$qual=clean($_POST["qual"]);$remarks=clean($_POST["remarks"]);$occupier_sign=clean($_POST["occupier_sign"]);	
	
	if(!empty($_POST["patient"])) $patient=json_encode($_POST["patient"]);
	else $patient=NULL;	
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,worker_name,serial_no,father_name,age,birth_date,nature,qual,remarks,occupier_sign) values ('$swr_id','$today','$worker_name','$serial_no','$father_name','$age','$birth_date','$nature','$qual','$remarks','$occupier_sign')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',worker_name='$worker_name',serial_no='$serial_no',father_name='$father_name',age='$age',birth_date='$birth_date',nature='$nature',qual='$qual',remarks='$remarks',occupier_sign='$occupier_sign' where form_id=$form_id");		
	}				
	if($query){
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php';
		</script>";
	}	
}

if(isset($_POST["save23"])){											
	$system=clean($_POST["system"]);$transport=clean($_POST["transport"]);$defects=clean($_POST["defects"]);$certify_dt=clean($_POST["certify_dt"]);$sign=clean($_POST["sign"]);$qual=clean($_POST["qual"]);$address=clean($_POST["address"]);
	
	if(!empty($_POST["hood"])) $hood=json_encode($_POST["hood"]);
	else $hood=NULL;
	if(!empty($_POST["pressure"])) $pressure=json_encode($_POST["pressure"]);
	else $pressure=NULL;
	if(!empty($_POST["device"]))	 $device=json_encode($_POST["device"]);
	else	$device=NULL;
	if(!empty($_POST["fan"]))	 $fan=json_encode($_POST["fan"]);
	else	$fan=NULL;
	if(!empty($_POST["motor"]))	 $motor=json_encode($_POST["motor"]);
	else	$motor=NULL;
	if(!empty($_POST["employ"]))	 $employ=json_encode($_POST["employ"]);
	else	$employ=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,system,transport,defects,certify_dt,sign,qual,address,hood,pressure,device,fan,motor,employ) values ('$swr_id','$today','$system','$transport','$defects','$certify_dt','$sign','$qual','$address','$hood','$pressure','$device','$fan','$motor','$employ')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',system='$system',transport='$transport',defects='$defects',certify_dt='$certify_dt',sign='$sign',qual='$qual',address='$address',hood='$hood',pressure='$pressure',device='$device',fan='$fan',motor='$motor',employ='$employ' where form_id=$form_id");		
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php';
		</script>";
	}	
}

if(isset($_POST["save26"])){
	$days_worked=clean($_POST["days_worked"]);$rupees=clean($_POST["rupees"]);$deduction=clean($_POST["deduction"]);$amount=clean($_POST["amount"]);$sign=clean($_POST["sign"]);$designation=clean($_POST["designation"]);
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,days_worked,rupees,deduction,amount,sign,designation) values ('$swr_id','$today','$days_worked','$rupees','$deduction','$amount','$sign','$designation')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',days_worked='$days_worked',rupees='$rupees',deduction='$deduction',amount='$amount',sign='$sign',designation='$designation' where form_id=$form_id");		
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php';
		</script>";
	}	
}

?>
