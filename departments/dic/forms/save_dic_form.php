<?php
if(isset($_POST["save1a"])){		
	$nature=clean($_POST["nature"]);$ancillary=clean($_POST["ancillary"]);$installation_date=clean($_POST["installation_date"]);
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,nature,ancillary,installation_date) values ('$swr_id','$today', '$nature', '$ancillary', '$installation_date')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', nature='$nature', ancillary='$ancillary', installation_date='$installation_date' where form_id=$form_id");
	}				
	if($query){		
		$formFunctions->insert_incomplete_forms($dept,$form); 
		echo "<script>
			alert('Successfully saved.');
			window.location.href = '".$table_name.".php?tab=2';
		</script>";			
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php';
		</script>";
	}			
}
if(isset($_POST["save1b"])){		
	$cat_enter=clean($_POST["cat_enter"]);$input_size=$_POST["hiddenval"];
	if(!empty($_POST["manuf"]))	 $manuf=json_encode($_POST["manuf"]);
	else	$manuf=NULL;
	if(!empty($_POST["fixed_asset"]))	 $fixed_asset=json_encode($_POST["fixed_asset"]);
	else	$type=NULL;
	if(!empty($_POST["power"]))	 $power=json_encode($_POST["power"]);
	else	$power=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		echo "<script>
			alert('Invalid Page Access !!!');
			window.location.href = '".$table_name.".php';
		</script>";
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', cat_enter='$cat_enter', manuf='$manuf', fixed_asset='$fixed_asset', power='$power' where form_id=$form_id");
		
		if($query){
			if($input_size!=0){	
				$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
				for($i=1;$i<$input_size;$i++){
					//$vala=$_POST["txtA".$i];		
					$valb=$_POST["txtB".$i];
					$valc=$_POST["txtC".$i];
					$vald=$_POST["txtD".$i];
					$vale=$_POST["txtE".$i];
					$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,slno,name,code,quantity,unit) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')");
				}
			}
			echo "<script>
				alert('Successfully saved.');
				window.location.href = '".$table_name.".php?tab=3';
			</script>";			
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php';
			</script>";
		}
	}				
}
if(isset($_POST["save1c"])){		
	$expect_date=clean($_POST["expect_date"]);
	if($expect_date!=""){
		$expect_date=date("Y-m-d",strtotime($expect_date));
	}else{
		$expect_date=NULL;
	}
	$hidden_value=clean($_POST["hidden_value"]);$input_size2=$_POST["hiddenval2"];
	
	if(!empty($_POST["source"]))	 $source=json_encode($_POST["source"]);
	else	$source=NULL;
	if(!empty($_POST["expected"]))	 $expected=json_encode($_POST["expected"]);
	else	$expected=NULL;

	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		echo "<script>
			alert('Invalid Page Access !!!');
			window.location.href = '".$table_name.".php';
		</script>";
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', expect_date='$expect_date', source='$source' , expected='$expected' where form_id='$form_id'");
		$k=$formFunctions->executeQuery($dept,"select id from ".$table_name."_members where form_id='$form_id'");
		if($k->num_rows>0){
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$gender=$_POST["gender".$i.""];$edu=$_POST["edu".$i.""];$caste=$_POST["caste".$i.""];$equity_rs=$_POST["equity_rs".$i.""];$equity_per=$_POST["equity_per".$i.""];$is_stack=$_POST["is_stack".$i.""];
			
				$query1=$formFunctions->executeQuery($dept,"update ".$table_name."_members set name='$name',gender='$gender',caste='$caste',edu='$edu',equity_rs='$equity_rs',equity_per='$equity_per',is_stack='$is_stack' where form_id='$form_id' and slno='$i'");
			}
		}else{		
			for($i=1;$i<=$hidden_value;$i++){
			$name=$_POST["name".$i.""];$gender=$_POST["gender".$i.""];$edu=$_POST["edu".$i.""];$caste=$_POST["caste".$i.""];$equity_rs=$_POST["equity_rs".$i.""];$equity_per=$_POST["equity_per".$i.""];$is_stack=$_POST["is_stack".$i.""];
			
			$query1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_members(id,form_id,slno,name,gender,caste,edu,equity_rs,equity_per,is_stack) VALUES ('','$form_id','$i','$name','$gender','$caste','$edu','$equity_rs','$equity_per','$is_stack')");
			}
		}
	}				
	if($query){
		if($input_size2!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
			//$vala=$_POST["textA".$i];			
			$valb=$_POST["textB".$i];
			$valc=$_POST["textC".$i];
			$vald=$_POST["textD".$i];			
			$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(id,form_id,slno,name,quantity,unit) VALUES ('','$form_id','$i','$valb','$valc','$vald')");
			}
		}
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";						
	}else{
		   echo "<script>
		   alert('Invalid Entry');
		   window.location.href = '".$table_name.".php';
		</script>";
	}				
}

if(isset($_POST["save2a"])){		
	$hidden_value=clean($_POST["hidden_value"]);
	if(!empty($_POST["ack"]))	 $ack=json_encode($_POST["ack"]);
	else	$ack=NULL;
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,ack) values ('$swr_id','$today', '$ack')");	
		$form_id=$query;
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_members where form_id='$form_id'");
		for($i=1;$i<=$hidden_value;$i++){
			$name=$_POST["name".$i.""];$sn1=$_POST["sn1".$i.""];$sn2=$_POST["sn2".$i.""];$v=$_POST["v".$i.""];$d=$_POST["d".$i.""];$p=$_POST["p".$i.""];
			
			$query1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_members(id,form_id,slno,name,sn1,sn2,v,d,p) VALUES ('','$form_id','$i','$name','$sn1','$sn2','$v','$d','$p')");
		}
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', ack='$ack' where form_id=$form_id");
		for($i=1;$i<=$hidden_value;$i++){
			$name=$_POST["name".$i.""];$sn1=$_POST["sn1".$i.""];$sn2=$_POST["sn2".$i.""];$v=$_POST["v".$i.""];$d=$_POST["d".$i.""];$p=$_POST["p".$i.""];
			
			$query1=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_members set name='$name',sn1='$sn1',sn2='$sn2',v='$v',d='$d',p='$p' where form_id='$form_id' and slno='$i'");
		}
	}		
	if($query){	
		$formFunctions->insert_incomplete_forms($dept,$form); 
			echo "<script>
				alert('Successfully saved.');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
			
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=1';
			</script>";
	}			
}
if(isset($_POST["save2b"])){		
	$power=clean($_POST["power"]);$raw_meterial=clean($_POST["raw_meterial"]);
	$input_size=$_POST["hiddenval"];$total_investment=$_POST["total_investment"];
	if(!empty($_POST["fixed_amount"]))	 $fixed_amount=json_encode($_POST["fixed_amount"]);
	else	$type=NULL;
	if(!empty($_POST["proposed"]))	 $proposed=json_encode($_POST["proposed"]);
	else	$proposed=NULL;

	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,power,raw_meterial,fixed_amount,total_investment,proposed) values ('$swr_id','$today', '$power', '$raw_meterial', '$fixed_amount','$total_investment', '$proposed')");
			
	}else{
			$form_id=$row["form_id"];	
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',power='$power', raw_meterial='$raw_meterial',fixed_amount='$fixed_amount',total_investment='$total_investment', proposed='$proposed' where form_id=$form_id");
	}			
	if($query){
		if($input_size!=0){					
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
		for($i=1;$i<$input_size;$i++){
			//$vala=$_POST["txtA".$i];		
			$valb=$_POST["txtB".$i];
			$valc=$_POST["txtC".$i];
			$vald=$_POST["txtD".$i];
			$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,slno,name,quantity,rupees) VALUES ('','$form_id','$i','$valb','$valc','$vald')");
			}
		}
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";						
	}else{
		   echo "<script>
		   alert('Invalid Entry');
		   window.location.href = '".$table_name.".php';
		</script>";
	}		
}

if(isset($_POST["save3a"])){		
	$hidden_value=clean($_POST["hidden_value"]);
	if(!empty($_POST["pmt"]))	 $pmt=json_encode($_POST["pmt"]);
	else	$pmt=NULL;
	if(!empty($_POST["fixed_amount"]))	 $fixed_amount=json_encode($_POST["fixed_amount"]);
	else	$fixed_amount=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,fixed_amount,pmt) values ('$swr_id','$today', '$fixed_amount', '$pmt')");
		$form_id=$query;	
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_members where form_id='$form_id'");
		for($i=1;$i<=$hidden_value;$i++){
			$name=$_POST["name".$i.""];$sn1=$_POST["sn1".$i.""];$sn2=$_POST["sn2".$i.""];$v=$_POST["v".$i.""];$d=$_POST["d".$i.""];$p=$_POST["p".$i.""];
			
			$query1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_members(id,form_id,slno,name,sn1,sn2,v,d,p) VALUES ('','$form_id','$i','$name','$sn1','$sn2','$v','$d','$p')");
		}
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', fixed_amount='$fixed_amount', pmt='$pmt' where form_id=$form_id");
	
		for($i=1;$i<=$hidden_value;$i++){
			$name=$_POST["name".$i.""];$sn1=$_POST["sn1".$i.""];$sn2=$_POST["sn2".$i.""];$v=$_POST["v".$i.""];$d=$_POST["d".$i.""];$p=$_POST["p".$i.""];			
			
			$query1=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_members set name='$name',sn1='$sn1',sn2='$sn2',v='$v',d='$d',p='$p' where form_id='$form_id' and slno='$i'");
		}
	}				
	if($query){		
		$formFunctions->insert_incomplete_forms($dept,$form); 
		echo "<script>
			alert('Successfully saved.');
			window.location.href = '".$table_name.".php?tab=2';
		</script>";			
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=1';
		</script>";
	}			
}
if(isset($_POST["save3b"])){		
	$input_size=$_POST["hiddenval"];
	$input_size2=$_POST["hiddenval2"];
	
	if(!empty($_POST["land"]))	 $land=json_encode($_POST["land"]);
	else	$land=NULL;
	if(!empty($_POST["building"]))	 $building=json_encode($_POST["building"]);
	else	$building=NULL;
	if(!empty($_POST["electricity"]))	 $electricity=json_encode($_POST["electricity"]);
	else	$electricity=NULL;
	if(!empty($_POST["proposed"]))	 $proposed=json_encode($_POST["proposed"]);
	else	$proposed=NULL;

	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		echo "<script>
			alert('Invalid Page Access !!!');
			window.location.href = '".$table_name.".php';
		</script>";
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', land='$land' , building='$building', electricity='$electricity', proposed='$proposed' where form_id='$form_id'");
	}				
	if($query){
		if($input_size!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
			//$vala=$_POST["textA".$i];			
			$valb=$_POST["txtB".$i];
			$valc=$_POST["txtC".$i];
			$vald=$_POST["txtD".$i];			
			$vale=$_POST["txtE".$i];			
			$valf=$_POST["txtF".$i];			
			$part=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,slno,name,quantity1,rupees1,quantity2,rupees2) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale','$valf')");
			}
		}
		if($input_size2!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
			//$vala=$_POST["textA".$i];			
			$valb=$_POST["textB".$i];
			$valc=$_POST["textC".$i];
			$vald=$_POST["textD".$i];	
			$vale=$_POST["textE".$i];			
			$valf=$_POST["textF".$i];
			$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(id,form_id,slno,name,quantity1,rupees1,quantity2,rupees2) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale','$valf')");
			}
		}
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";						
	}else{
		   echo "<script>
		   alert('Invalid Entry');
		   window.location.href = '".$table_name.".php';
		</script>";
	}				
}

if(isset($_POST["save4a"])){
	
	$acknowledge_number=clean($_POST["acknowledge_number"]);
	$issue_em=clean($_POST["issue_em"]);
	$nature=clean($_POST["nature"]);$ancillary=clean($_POST["ancillary"]);$installation_date=clean($_POST["installation_date"]);$fact_act=clean($_POST["fact_act"]);$area_r=clean($_POST["area_r"]);
	
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$save_query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,acknowledge_number,issue_em,nature,ancillary,installation_date,fact_act,area_r) values ('$swr_id','$today', '$acknowledge_number', '$issue_em','$nature', '$ancillary', '$installation_date', '$fact_act', '$area_r')");
	}else{
		$form_id=$row["form_id"];
		$save_query=$formFunctions->executeQuery($dept,"update ".$table_name." set acknowledge_number='$acknowledge_number',issue_em='$issue_em',nature='$nature',ancillary='$ancillary',installation_date='$installation_date',fact_act='$fact_act',area_r='$area_r' where form_id='$form_id'");
	}				
	if($save_query){		
		$formFunctions->insert_incomplete_forms($dept,$form); 
		echo "<script>
			alert('Successfully saved.');
			window.location.href = '".$table_name.".php?tab=2';
		</script>";			
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php';
		</script>";
	}			
}
if(isset($_POST["save4b"])){		
	$cat_enter=clean($_POST["cat_enter"]);$input_size=$_POST["hiddenval"];$input_size2=$_POST["hiddenval2"];
	$source_reason=clean($_POST["source_reason"]);
	
	if(!empty($_POST["manuf"]))	 $manuf=json_encode($_POST["manuf"]);
	else	$manuf=NULL;
	if(!empty($_POST["fixed_asset"]))	 $fixed_asset=json_encode($_POST["fixed_asset"]);
	else	$fixed_asset=NULL;
	if(!empty($_POST["power"]))	 $power=json_encode($_POST["power"]);
	else	$power=NULL;
	if(!empty($_POST["source"]))	 $source=json_encode($_POST["source"]);
	else	$source=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		echo "<script>
			alert('Invalid Page Access !!!');
			window.location.href = '".$table_name.".php';
		</script>";
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', cat_enter='$cat_enter', manuf='$manuf', fixed_asset='$fixed_asset', power='$power',source='$source',source_reason='$source_reason' where form_id=$form_id");
	}	
	if($query){
			if($input_size!=0){					
				$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
				for($i=1;$i<$input_size;$i++){
					//$vala=$_POST["txtA".$i];		
					$valb=$_POST["txtB".$i];
					$valc=$_POST["txtC".$i];
					$vald=$_POST["txtD".$i];
					$vale=$_POST["txtE".$i];
					$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,slno,name,code,quantity,unit) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')");
				}
			}
			if($input_size2!=0){					
				$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
				for($i=1;$i<$input_size2;$i++){
				//$vala=$_POST["textA".$i];			
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$vald=$_POST["textD".$i];			
				$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(id,form_id,slno,name,quantity,unit) VALUES ('','$form_id','$i','$valb','$valc','$vald')");
				}
			}
			echo "<script>
				alert('Sucessfully Saved...');
				window.location.href = '".$table_name.".php?tab=3';
			</script>";		
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}
}				
if(isset($_POST["save4c"])){		
	$annual_rupees=clean($_POST["annual_rupees"]);$export_rupees=clean($_POST["export_rupees"]);$expect_date=clean($_POST["expect_date"]);
	if($expect_date!=""){
		$expect_date=date("Y-m-d",strtotime($expect_date));
	}else{
		$expect_date=NULL;
	}
	$is_unit_computer=clean($_POST["is_unit_computer"]);
	$hidden_value=clean($_POST["hidden_value"]);
	if(!empty($_POST["expected"]))	 $expected=json_encode($_POST["expected"]);
	else	$expected=NULL;

	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		echo "<script>
			alert('Please fill up the first part of the form !!!');
			window.location.href = '".$table_name.".php';
		</script>"; 
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', annual_rupees='$annual_rupees',export_rupees='$export_rupees',expected='$expected',expect_date='$expect_date',is_unit_computer='$is_unit_computer' where form_id='$form_id'");
		$k=$formFunctions->executeQuery($dept,"select id from ".$table_name."_members where form_id='$form_id'");
		if($k->num_rows>0){
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$gender=$_POST["gender".$i.""];$edu=$_POST["edu".$i.""];$caste=$_POST["caste".$i.""];$equity_rs=$_POST["equity_rs".$i.""];$equity_per=$_POST["equity_per".$i.""];$is_stack=$_POST["is_stack".$i.""];
			
				$query1=$formFunctions->executeQuery($dept,"update ".$table_name."_members set name='$name',gender='$gender',caste='$caste',edu='$edu',equity_rs='$equity_rs',equity_per='$equity_per',is_stack='$is_stack' where form_id='$form_id' and slno='$i'");
			}
		}else{
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$gender=$_POST["gender".$i.""];$edu=$_POST["edu".$i.""];$caste=$_POST["caste".$i.""];$equity_rs=$_POST["equity_rs".$i.""];$equity_per=$_POST["equity_per".$i.""];$is_stack=$_POST["is_stack".$i.""];
			
				$query1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_members(id,form_id,slno,name,gender,caste,edu,equity_rs,equity_per,is_stack) VALUES ('','$form_id','$i','$name','$gender','$caste','$edu','$equity_rs','$equity_per','$is_stack')");
			}
		}
			
	}			
	if($query){
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";						
	}else{
		   echo "<script>
		   alert('Invalid Entry');
		   window.location.href = '".$table_name.".php';
		</script>";
	}				
}				

if(isset($_POST["save5a"])){
	$hidden_value=clean($_POST["hidden_value"]);$is_implementaion=clean($_POST["is_implementaion"]);$is_owned=clean($_POST["is_owned"]);$area_sq_mtr=clean($_POST["area_sq_mtr"]);$area_project=clean($_POST["area_project"]);$location=clean($_POST["location"]);
	
	if(!empty($_POST["act"])) $act=json_encode($_POST["act"]);else $act=NULL;		
	if(!empty($_POST["provisional"])) $provisional=json_encode($_POST["provisional"]);else $provisional=NULL;
	if(!empty($_POST["permanent"])) $permanent=json_encode($_POST["permanent"]);else $permanent=NULL;
	if(!empty($_POST["indus"])) $indus=json_encode($_POST["indus"]);else $indus=NULL;
	if(!empty($_POST["consultant"])) $consultant=json_encode($_POST["consultant"]);else $consultant=NULL;
	if(!empty($_POST["organization"])) $organization=json_encode($_POST["organization"]);else $organization=NULL;
	if(!empty($_POST["detail_l"])) $detail_l=json_encode($_POST["detail_l"]);else $detail_l=NULL;
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		 $query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,act,provisional,permanent,indus,consultant,organization,is_implementaion,is_owned,area_sq_mtr,area_project,location,detail_l) values('$swr_id','$act','$provisional','$permanent','$indus','$consultant','$organization','$is_implementaion','$is_owned','$area_sq_mtr','$area_project','$location','$detail_l')");
		 $form_id=$query;
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_members where form_id='$form_id'");
		for($i=1;$i<=$hidden_value;$i++){
			$name=$_POST["name".$i.""];$sn1=$_POST["sn1".$i.""];$sn2=$_POST["sn2".$i.""];$vill=$_POST["vill".$i.""];$dist=$_POST["dist".$i.""];$pin=$_POST["pin".$i.""];$pan=$_POST["pan".$i.""];
			
			$query1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_members(id,form_id,sl_no,name,sn1,sn2,vill,dist,pin,pan) VALUES ('','$form_id','$i','$name','$sn1','$sn2','$vill','$dist','$pin','$pan')");
		}
		
	}else{
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET  sub_date='$today',act='$act',provisional='$provisional',permanent='$permanent',indus='$indus',consultant='$consultant',organization='$organization',is_implementaion='$is_implementaion',is_owned='$is_owned',area_sq_mtr='$area_sq_mtr',area_project='$area_project',location='$location',detail_l='$detail_l' WHERE form_id='$form_id'");	
		for($i=1;$i<=$hidden_value;$i++){ 
			$name=$_POST["name".$i.""];$sn1=$_POST["sn1".$i.""];$sn2=$_POST["sn2".$i.""];$vill=$_POST["vill".$i.""];$dist=$_POST["dist".$i.""];$pin=$_POST["pin".$i.""];$pan=$_POST["pan".$i.""];
			
			$query1=$formFunctions->executeQuery($dept,"update ".$table_name."_members set name='$name',sn1='$sn1',sn2='$sn2',vill='$vill',dist='$dist',pin='$pin',pan='$pan' where form_id='$form_id' and sl_no='$i'");
		}
	}	
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
			echo "<script>
				alert('Successfully Saved..');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}else{
			echo "<script>
				alert('Invalid Entry');
				window.location.href = '".$table_name.".php';
			</script>";
	}
}
if(isset($_POST["save5b"])){
	$no_purchase_deed=clean($_POST["no_purchase_deed"]);
	$reg_purchase_deed=clean($_POST["reg_purchase_deed"]);
	if($reg_purchase_deed!=""){
		$reg_purchase_deed=date("Y-m-d",strtotime($reg_purchase_deed));
	}else{
		$reg_purchase_deed=NULL;
	}
	$premium=clean($_POST["premium"]);
	$date_possesion=clean($_POST["date_possesion"]);
	if($date_possesion!=""){
		$date_possesion=date("Y-m-d",strtotime($date_possesion));
	}else{
		$date_possesion=NULL;
	}
	$lease_duration=clean($_POST["lease_duration"]);
	$start_date_civconstruct=clean($_POST["start_date_civconstruct"]);
	if($start_date_civconstruct!=""){
		$start_date_civconstruct=date("Y-m-d",strtotime($start_date_civconstruct));
	}else{
		$start_date_civconstruct=NULL;
	}
	$end_date_civconstruct=clean($_POST["end_date_civconstruct"]);
	if($end_date_civconstruct!=""){
		$end_date_civconstruct=date("Y-m-d",strtotime($end_date_civconstruct));
	}else{
		$end_date_civconstruct=NULL;
	}
	$tot_area_underconstruct=clean($_POST["tot_area_underconstruct"]);$tot_cost_construct=clean($_POST["tot_cost_construct"]);$cost_manufacturing=clean($_POST["cost_manufacturing"]);$agency_area_covered=clean($_POST["agency_area_covered"]);$agency_annual_rent=clean($_POST["agency_annual_rent"]);$agency_regnum=clean($_POST["agency_regnum"]);
	$agency_regdate=clean($_POST["agency_regdate"]);
	if($agency_regdate!=""){
		$agency_regdate=date("Y-m-d",strtotime($agency_regdate));
	}else{
		$agency_regdate=NULL;
	}
	$agency_loc=clean($_POST["agency_loc"]);
	$agency_lease_period=clean($_POST["agency_lease_period"]);
	if($agency_lease_period!=""){
		$agency_lease_period=date("Y-m-d",strtotime($agency_lease_period));
	}else{
		$agency_lease_period=NULL;
	}
	$capital_invest_total=clean($_POST["capital_invest_total"]);
	
	if(!empty($_POST["reg_auth"])) $reg_auth=json_encode($_POST["reg_auth"]);else $reg_auth=NULL;
	if(!empty($_POST["owner"])) $owner=json_encode($_POST["owner"]);else $owner=NULL;		
	if(!empty($_POST["rent_auth"])) $rent_auth=json_encode($_POST["rent_auth"]);else $rent_auth=NULL;		
	if(!empty($_POST["agency"])) $agency=json_encode($_POST["agency"]);else $agency=NULL;		
	if(!empty($_POST["capital_invest"])) $capital_invest=json_encode($_POST["capital_invest"]);else $capital_invest=NULL;		
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,owner,no_purchase_deed,reg_purchase_deed,reg_auth,premium,date_possesion,lease_duration,start_date_civconstruct,end_date_civconstruct,tot_area_underconstruct,tot_cost_construct,cost_manufacturing,agency,agency_area_covered,agency_annual_rent,agency_regnum,agency_regdate,rent_auth,agency_loc,agency_lease_period,capital_invest,capital_invest_total) values('$swr_id','$owner','$no_purchase_deed','$reg_purchase_deed','$reg_auth','$premium','$date_possesion','$lease_duration','$start_date_civconstruct','$end_date_civconstruct','$tot_area_underconstruct','$tot_cost_construct','$cost_manufacturing','$agency','$agency_area_covered','$agency_annual_rent','$agency_regnum','$agency_regdate','$rent_auth','$agency_loc','$agency_lease_period','$capital_invest','$capital_invest_total')");
	}else{
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET  sub_date='$today', owner='$owner',no_purchase_deed='$no_purchase_deed',reg_purchase_deed='$reg_purchase_deed',reg_auth='$reg_auth',premium='$premium',date_possesion='$date_possesion',lease_duration='$lease_duration',start_date_civconstruct='$start_date_civconstruct',end_date_civconstruct='$end_date_civconstruct',tot_area_underconstruct='$tot_area_underconstruct',tot_cost_construct='$tot_cost_construct',cost_manufacturing='$cost_manufacturing',agency='$agency',agency_area_covered='$agency_area_covered',agency_annual_rent='$agency_annual_rent',agency_regnum='$agency_regnum',agency_regdate='$agency_regdate',rent_auth='$rent_auth',agency_loc='$agency_loc',agency_lease_period='$agency_lease_period',capital_invest='$capital_invest',capital_invest_total='$capital_invest_total' WHERE form_id='$form_id'");	
	}
	if($query){
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$table_name.".php?tab=3';
		</script>";
	}else{
		echo "<script>
			alert('Invalid Entry');
			window.location.href = '".$table_name.".php?tab=2';
		</script>";
	}
}
if(isset($_POST["save5c"])){
	
	$sources_f_finance_total=clean($_POST["sources_f_finance_total"]);$pow_line_expen=clean($_POST["pow_line_expen"]);$dg_details=clean($_POST["dg_details"]);$dg_make=clean($_POST["dg_make"]);$dg_rating=clean($_POST["dg_rating"]);$cost_of_dgset=clean($_POST["cost_of_dgset"]);
	$installation_date=clean($_POST["installation_date"]);
	if($installation_date!=""){
		$installation_date=date("Y-m-d",strtotime($installation_date));
	}else{
		$installation_date=NULL;
	}	
	$date_comm_prod=clean($_POST["date_comm_prod"]);
	if($date_comm_prod!=""){
		$date_comm_prod=date("Y-m-d",strtotime($date_comm_prod));
	}else{
		$date_comm_prod=NULL;
	}
	if(!empty($_POST["sources_f_finance"])) $sources_f_finance=json_encode($_POST["sources_f_finance"]);else $sources_f_finance=NULL;		
	if(!empty($_POST["financial_details"])) $financial_details=json_encode($_POST["financial_details"]);else $financial_details=NULL;
	if(!empty($_POST["details_f_power"])) $details_f_power=json_encode($_POST["details_f_power"]);else $details_f_power=NULL;
	if(!empty($_POST["aseb"])) $aseb=json_encode($_POST["aseb"]);else $aseb=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		echo "<script>
			alert('Please fill up the first part of the form !!!');
			window.location.href = '".$table_name.".php';
		</script>";
	}else{		
		$form_id=$row["form_id"];
		$sql1=$formFunctions->executeQuery($dept,"select id from ".$table_name."_part1 where form_id='$form_id'");
		$row1=$sql1->fetch_array();
		if($sql1->num_rows<1){   ////////////table is empty//////////////
			$query=$formFunctions->executeQuery($dept,"insert into ".$table_name."_part1(form_id,sources_f_finance,sources_f_finance_total,financial_details,details_f_power,aseb,pow_line_expen,dg_details,dg_make,dg_rating,cost_of_dgset,installation_date,date_comm_prod) values('$form_id','$sources_f_finance','$sources_f_finance_total','$financial_details','$details_f_power','$aseb','$pow_line_expen','$dg_details','$dg_make','$dg_rating','$cost_of_dgset','$installation_date','$date_comm_prod')");	
		}else{
			$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_part1 SET sources_f_finance='$sources_f_finance',sources_f_finance_total='$sources_f_finance_total',financial_details='$financial_details',details_f_power='$details_f_power',aseb='$aseb',pow_line_expen='$pow_line_expen',dg_details='$dg_details',dg_make='$dg_make',dg_rating='$dg_rating',cost_of_dgset='$cost_of_dgset',installation_date='$installation_date',date_comm_prod='$date_comm_prod' WHERE form_id='$form_id'");	
		}		
	}	
	if($query){
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$table_name.".php?tab=4';
		</script>";
	}else{
		echo "<script>
			alert('Invalid Entry');
			window.location.href = '".$table_name.".php?tab=3';
		</script>";
	}
}
if(isset($_POST["save5d"])){ 
	$details_prod=clean($_POST["details_prod"]);$input_size1=clean($_POST["hiddenval"]);$input_size2=clean($_POST["hiddenval2"]);$input_size3=clean($_POST["hiddenval3"]);$input_size4=clean($_POST["hiddenval4"]);$input_size4=clean($_POST["hiddenval4"]);$input_size5=clean($_POST["hiddenval5"]);$total_assam=clean($_POST["total_assam"]);$total_outsiders=clean($_POST["total_outsiders"]);$gross_total=clean($_POST["gross_total"]);$gross_remarks=clean($_POST["gross_remarks"]);$utilized_mandays=clean($_POST["utilized_mandays"]);
	
	if(!empty($_POST["managerial"])) $managerial=json_encode($_POST["managerial"]);else $managerial=NULL;		
	if(!empty($_POST["supervisory"])) $supervisory=json_encode($_POST["supervisory"]);else $supervisory=NULL;
	if(!empty($_POST["skilled"])) $skilled=json_encode($_POST["skilled"]);else $skilled=NULL;
	if(!empty($_POST["semi_skilled"])) $semi_skilled=json_encode($_POST["semi_skilled"]);else $semi_skilled=NULL;
	if(!empty($_POST["unskilled"])) $unskilled=json_encode($_POST["unskilled"]);else $unskilled=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		echo "<script>
			alert('Please fill up the first part of the form !!!');
			window.location.href = '".$table_name.".php';
		</script>";
	}else{		
		$form_id=$row["form_id"];
		$sql1=$formFunctions->executeQuery($dept,"select id from ".$table_name."_part1 where form_id='$form_id'");
		$row1=$sql1->fetch_array();
		if($sql1->num_rows<1){   ////////////table is empty//////////////
			echo "<script>
				alert('Please fill up the third part of the form !!!');
				window.location.href = '".$table_name.".php?tab=3';
			</script>";
		}else{
			$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_part1 SET  details_prod='$details_prod',managerial='$managerial',supervisory='$supervisory',skilled='$skilled',semi_skilled='$semi_skilled',unskilled='$unskilled',total_assam='$total_assam',total_outsiders='$total_outsiders',gross_total='$gross_total',gross_remarks='$gross_remarks',utilized_mandays='$utilized_mandays' WHERE form_id='$form_id'");	
		}		
	}
		
	if($query){
		if($input_size1!=0){					
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size1;$i++){
				//$vala=$_POST["txtA".$i];	
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$valf=$_POST["txtF".$i];
				$valg=$_POST["txtG".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,slno,items,annual_quantity,annual_rupees,actual_quantity,actual_rupees,remark) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg')");
			}
		}
		if($input_size2!=0){					
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				//$vala=$_POST["textA".$i];	
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$vald=$_POST["textD".$i];	
				$vale=$_POST["textE".$i];	
				$valf=$_POST["textF".$i];	
				$valg=$_POST["textG".$i];	
				$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(id,form_id,slno,items,annual_quantity,annual_rupees,utlised_quantity,utlised_rupees,remark) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg')");
			}
		}
		if($input_size3!=0){					
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t3 where form_id='$form_id'");
			for($i=1;$i<$input_size3;$i++){
				//$vala=$_POST["txxtA".$i];		
				$valb=$_POST["txxtB".$i];
				$valc=$_POST["txxtC".$i];
				$vald=$_POST["txxtD".$i];				
				$vale=$_POST["txxtE".$i];				
				$part3=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t3(id,form_id,slno,item,source,name,address) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')") or die($dic->error);
			}
		}
		if($input_size4!=0){					
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t4 where form_id='$form_id'");
			for($i=1;$i<$input_size4;$i++){
				//$vala=$_POST["txttA".$i];		
				$valb=$_POST["txttB".$i];
				$valc=$_POST["txttC".$i];
				$vald=$_POST["txttD".$i];				
				$vale=$_POST["txttE".$i];			
				$valf=$_POST["txttF".$i];				
				$valg=$_POST["txttG".$i];				
				$part4=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t4(id,form_id,slno,item,within_assam_quantity,within_assam_rupees,outside_assam_quantity,outside_assam_rupees,remarks) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg')");
			}
		}
		if($input_size5!=0){					
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t5 where form_id='$form_id'");
			for($i=1;$i<$input_size5;$i++){
				//$vala=$_POST["ttxtA".$i];		
				$valb=$_POST["ttxtB".$i];
				$valc=$_POST["ttxtC".$i];				
				$part5=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t5(id,form_id,slno,name,quantity) VALUES ('','$form_id','$i','$valb','$valc')");
			}
		}
		if((isset($part1) && $part1==false) || (isset($part2) && $part2==false) || (isset($part3) && $part3==false) || (isset($part4) && $part4==false) || (isset($part5) && $part5=false)){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=4';
			</script>";
		}else{
			 echo "<script>
				alert('Successfully Saved..');
				window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
			</script>";
		}	
	}else{
		   echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=3';
			   </script>";
	}		
}

if(isset($_POST["save6a"])){		
	$office_mob=clean($_POST["office_mob"]);$office_email=clean($_POST["office_email"]);$hidden_value=clean($_POST["hidden_value"]);

	if(!empty($_POST["act"])) $act=json_encode($_POST["act"]);else $act=NULL;		
	if(!empty($_POST["provisional"])) $provisional=json_encode($_POST["provisional"]);else $provisional=NULL;
	if(!empty($_POST["permanent"])) $permanent=json_encode($_POST["permanent"]);else $permanent=NULL;
	if(!empty($_POST["indus"])) $indus=json_encode($_POST["indus"]);else $indus=NULL;
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,office_mob,office_email,act,provisional,permanent,indus) values('$swr_id','$office_mob','$office_email','$act','$provisional','$permanent','$indus')");
		$form_id=$query;
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_members where form_id='$form_id'");
		for($i=1;$i<=$hidden_value;$i++){
			$name=$_POST["name".$i.""];$sn1=$_POST["sn1".$i.""];$sn2=$_POST["sn2".$i.""];$vill=$_POST["vill".$i.""];$dist=$_POST["dist".$i.""];$pin=$_POST["pin".$i.""];$pan=$_POST["pan".$i.""];
			
			$query1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_members(id,form_id,sl_no,name,sn1,sn2,vill,dist,pin,pan) VALUES ('','$form_id','$i','$name','$sn1','$sn2','$vill','$dist','$pin','$pan')");
		}
		$query2=$formFunctions->executeQuery($dept,"insert into ".$table_name."_part1(form_id) values('$form_id')");
		$query3=$formFunctions->executeQuery($dept,"insert into ".$table_name."_upload(form_id) values('$form_id')");
	}else{
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET  sub_date='$today', office_mob='$office_mob',office_email='$office_email',act='$act',provisional='$provisional',permanent='$permanent',indus='$indus' WHERE form_id='$form_id'");	
		for($i=1;$i<=$hidden_value;$i++){
			$name=$_POST["name".$i.""];$sn1=$_POST["sn1".$i.""];$sn2=$_POST["sn2".$i.""];$vill=$_POST["vill".$i.""];$dist=$_POST["dist".$i.""];$pin=$_POST["pin".$i.""];$pan=$_POST["pan".$i.""];
			
			$query1=$formFunctions->executeQuery($dept,"UPDATE  ".$table_name."_members set name='$name',sn1='$sn1',sn2='$sn2',vill='$vill',dist='$dist',pin='$pin',pan='$pan' where form_id='$form_id' and sl_no='$i'");
		}
	}
	if($query==true && $query1==true){
		$formFunctions->insert_incomplete_forms($dept,$form); 
			echo "<script>
				alert('Successfully Saved..');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
		}
	else{
			echo "<script>
				alert('Invalid Entry');
				window.location.href = '".$table_name.".php?tab=1';
			</script>";
	}
}
if(isset($_POST["save6b"])){		
	$intimation_letter_no=clean($_POST["intimation_letter_no"]);
	$intimation_date=clean($_POST["intimation_date"]);
	if($intimation_date!=""){
		$intimation_date=date("Y-m-d",strtotime($intimation_date));
	}else{
		$intimation_date=NULL;
	}
	$note_substantial=clean($_POST["note_substantial"]);$ec_no=clean($_POST["ec_no"]);
	$ec_date=clean($_POST["ec_date"]);
	if($ec_date!=""){
		$ec_date=date("Y-m-d",strtotime($ec_date));
	}else{
		$ec_date=NULL;
	}
	$land_owned=clean($_POST["land_owned"]);$total_area=clean($_POST["total_area"]);$area_under_use=clean($_POST["area_under_use"]);$area_loc=clean($_POST["area_loc"]);$no_pur_deed=clean($_POST["no_pur_deed"]);
	$dor_pur_deed=clean($_POST["dor_pur_deed"]);
	if($dor_pur_deed!=""){
		$dor_pur_deed=date("Y-m-d",strtotime($dor_pur_deed));
	}else{
		$dor_pur_deed=NULL;
	}
	$pur_price=clean($_POST["pur_price"]);$pur_reg_fee=clean($_POST["pur_reg_fee"]);$stamp_duty=clean($_POST["stamp_duty"]);$date_possesion=clean($_POST["date_possesion"]);
	if($date_possesion!=""){
		$date_possesion=date("Y-m-d",strtotime($date_possesion));
	}else{
		$date_possesion=NULL;
	}
	$lease_from=clean($_POST["lease_from"]);
	if($lease_from!=""){
		$lease_from=date("Y-m-d",strtotime($lease_from));
	}else{
		$lease_from=NULL;
	}
	$lease_to=clean($_POST["lease_to"]);
	if($lease_to!=""){
		$lease_to=date("Y-m-d",strtotime($lease_to));
	}else{
		$lease_to=NULL;
	}
	if(!empty($_POST["consultant"])) $consultant=json_encode($_POST["consultant"]);else $consultant=NULL;
	if(!empty($_POST["land_detail"])) $land_detail=json_encode($_POST["land_detail"]);else $land_detail=NULL;
	if(!empty($_POST["land_owner"])) $land_owner=json_encode($_POST["land_owner"]);else $land_owner=NULL;
	if(!empty($_POST["auth"])) $auth=json_encode($_POST["auth"]);else $auth=NULL;
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		echo "<script>
			alert('Please Fill up the first part of the form .');
			window.location.href = '".$table_name.".php';
		</script>";
	}else{		
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET  sub_date='$today', intimation_letter_no='$intimation_letter_no',intimation_date='$intimation_date',note_substantial='$note_substantial',consultant='$consultant',ec_no='$ec_no',ec_date='$ec_date',land_owned='$land_owned',total_area='$total_area',area_under_use='$area_under_use',area_loc='$area_loc',land_detail='$land_detail',land_owner='$land_owner',no_pur_deed='$no_pur_deed',dor_pur_deed='$dor_pur_deed',auth='$auth',pur_price='$pur_price',pur_reg_fee='$pur_reg_fee',stamp_duty='$stamp_duty',date_possesion='$date_possesion',lease_from='$lease_from',lease_to='$lease_to' WHERE form_id='$form_id'");	
	}	
	if($query){
			echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$table_name.".php?tab=3';
		</script>";
	}else{
			echo "<script>
			alert('Invalid Entry');
			window.location.href = '".$table_name.".php?tab=2';
		</script>";
	}
}
if(isset($_POST["save6c"])){		
	$tot_cov_area=clean($_POST["tot_cov_area"]);$ann_rent=clean($_POST["ann_rent"]);$build_loc=clean($_POST["build_loc"]);$total_f_coloumn=clean($_POST["total_f_coloumn"]);$total_fixed_capital=clean($_POST["total_fixed_capital"]);
	
	if(!empty($_POST["building_construction"])) $building_construction=json_encode($_POST["building_construction"]);
	else $building_construction=NULL;
	if(!empty($_POST["govt_agency"])) $govt_agency=json_encode($_POST["govt_agency"]);else $govt_agency=NULL;
	if(!empty($_POST["build_reg"])) $build_reg=json_encode($_POST["build_reg"]);else $build_reg=NULL;
	if(!empty($_POST["val_period"])) $val_period=json_encode($_POST["val_period"]);else $val_period=NULL;
	if(!empty($_POST["land"])) $land=json_encode($_POST["land"]);else $land=NULL;
	if(!empty($_POST["site"])) $site=json_encode($_POST["site"]);else $site=NULL;
	if(!empty($_POST["fact_direct"])) $fact_direct=json_encode($_POST["fact_direct"]);else $fact_direct=NULL;
	if(!empty($_POST["office_direct"])) $office_direct=json_encode($_POST["office_direct"]);else $office_direct=NULL;
	if(!empty($_POST["plant"])) $plant=json_encode($_POST["plant"]);else $plant=NULL;
	if(!empty($_POST["equip"])) $equip=json_encode($_POST["equip"]);else $equip=NULL;
	if(!empty($_POST["power"])) $power=json_encode($_POST["power"]);else $power=NULL;
	if(!empty($_POST["electrical"])) $electrical=json_encode($_POST["electrical"]);else $electrical=NULL;
	if(!empty($_POST["utility"])) $utility=json_encode($_POST["utility"]);else $utility=NULL;
	if(!empty($_POST["misc"])) $misc=json_encode($_POST["misc"]);else $misc=NULL;
	if(!empty($_POST["prelim"])) $prelim=json_encode($_POST["prelim"]);else $prelim=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		echo "<script>
			alert('Please Fill up the first part of the form .');
			window.location.href = '".$table_name.".php';
		</script>";
	}else{
		$form_id=$row["form_id"];
        $sql1=$formFunctions->executeQuery($dept,"select id from ".$table_name."_part1 where form_id='$form_id'");
		$row1=$sql1->fetch_array();
		if($sql1->num_rows<1){   ////////////table is empty//////////////
			$query=$formFunctions->executeQuery($dept,"insert into ".$table_name."_part1(form_id,building_construction,govt_agency,tot_cov_area,ann_rent,build_reg,build_loc,val_period,land,site,fact_direct,office_direct,plant,equip,power,electrical,utility,misc,prelim,total_f_coloumn,total_fixed_capital) values('$form_id','$building_construction','$govt_agency','$tot_cov_area','$ann_rent','$build_reg','$build_loc','$val_period','$land','$site','$fact_direct','$office_direct','$plant','$equip','$power','$electrical','$utility','$misc','$prelim','$total_f_coloumn','$total_fixed_capital')");	
        }else{
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_part1 SET building_construction='$building_construction',govt_agency='$govt_agency',tot_cov_area='$tot_cov_area',ann_rent='$ann_rent',build_reg='$build_reg',build_loc='$build_loc',val_period='$val_period',land='$land',site='$site',fact_direct='$fact_direct',office_direct='$office_direct',plant='$plant',equip='$equip',power='$power',electrical='$electrical',utility='$utility',misc='$misc',prelim='$prelim',total_f_coloumn='$total_f_coloumn',total_fixed_capital='$total_fixed_capital' WHERE form_id='$form_id'");	
	}
 }
	if($query){
			echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$table_name.".php?tab=4';
		</script>";
	}else{
			echo "<script>
			alert('Invalid Entry');
			window.location.href = '".$table_name.".php?tab=3';
		</script>";
	}
}
if(isset($_POST["save6d"])){
	$total_contribution=clean($_POST["total_contribution"]);
	
	if(!empty($_POST["sources_f_finance"])) $sources_f_finance=json_encode($_POST["sources_f_finance"]); else $sources_f_finance=NULL;
	if(!empty($_POST["financial_ins"])) $financial_ins=json_encode($_POST["financial_ins"]); else $financial_ins=NULL;
	if(!empty($_POST["term"])) $term=json_encode($_POST["term"]);else $term=NULL;
	if(!empty($_POST["wc"])) $wc=json_encode($_POST["wc"]);else $wc=NULL;
	if(!empty($_POST["tl"])) $tl=json_encode($_POST["tl"]);else $tl=NULL;
	if(!empty($_POST["roi_tl"])) $roi_tl=json_encode($_POST["roi_tl"]);else $roi_tl=NULL;
	if(!empty($_POST["repayment"])) $repayment=json_encode($_POST["repayment"]);else $repayment=NULL;
	if(!empty($_POST["tl_amt"])) $tl_amt=json_encode($_POST["tl_amt"]);else $tl_amt=NULL;
	if(!empty($_POST["tl_date"])) $tl_date=json_encode($_POST["tl_date"]);else $tl_date=NULL;
	if(!empty($_POST["wor_cap"])) $wor_cap=json_encode($_POST["wor_cap"]);else $wor_cap=NULL;
	if(!empty($_POST["wor_dat"])) $wor_dat=json_encode($_POST["wor_dat"]);else $wor_dat=NULL;
	if(!empty($_POST["quant"])) $quant=json_encode($_POST["quant"]);else $quant=NULL;
	if(!empty($_POST["quant_let"])) $quant_let=json_encode($_POST["quant_let"]);else $quant_let=NULL;
	if(!empty($_POST["quant_dat"])) $quant_dat=json_encode($_POST["quant_dat"]);else $quant_dat=NULL;
	if(!empty($_POST["elec"])) $elec=json_encode($_POST["elec"]);else $elec=NULL;
	if(!empty($_POST["elec_dat"])) $elec_dat=json_encode($_POST["elec_dat"]);else $elec_dat=NULL;
	if(!empty($_POST["ser_en"])) $ser_en=json_encode($_POST["ser_en"]);else $ser_en=NULL;
	if(!empty($_POST["est_amt"])) $est_amt=json_encode($_POST["est_amt"]);else $est_amt=NULL;
	if(!empty($_POST["est_mr"])) $est_mr=json_encode($_POST["est_mr"]);else $est_mr=NULL;
	if(!empty($_POST["est_dat"])) $est_dat=json_encode($_POST["est_dat"]);else $est_dat=NULL;
	if(!empty($_POST["sub_expan"])) $sub_expan=json_encode($_POST["sub_expan"]);else $sub_expan=NULL;
	if(!empty($_POST["sub_dat"])) $sub_dat=json_encode($_POST["sub_dat"]);else $sub_dat=NULL;
	if(!empty($_POST["mr_subexpan"])) $mr_subexpan=json_encode($_POST["mr_subexpan"]);else $mr_subexpan=NULL;
	if(!empty($_POST["mr_subexpan_dat"])) $mr_subexpan_dat=json_encode($_POST["mr_subexpan_dat"]);else $mr_subexpan_dat=NULL;
	if(!empty($_POST["total_expenditure"])) $total_expenditure=json_encode($_POST["total_expenditure"]);else $total_expenditure=NULL;
	
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		echo "<script>
			alert('Please Fill up the first part of the form .');
			window.location.href = '".$table_name.".php';
		</script>";
	}else{
		$form_id=$row["form_id"];
        $sql1=$formFunctions->executeQuery($dept,"select id from ".$table_name."_part1 where form_id='$form_id'");
		$row1=$sql1->fetch_array();
		if($sql1->num_rows<1){ 
        echo "<script>
				alert('Please fill up the third part of the form !!!');
				window.location.href = '".$table_name.".php?tab=3';
			</script>";
		}else{
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_part1 SET sources_f_finance='$sources_f_finance',total_contribution='$total_contribution', financial_ins='$financial_ins',term='$term',wc='$wc',tl='$tl',roi_tl='$roi_tl',repayment='$repayment',tl_amt='$tl_amt',tl_date='$tl_date',wor_cap='$wor_cap',wor_dat='$wor_dat', quant='$quant',quant_let='$quant_let',quant_dat='$quant_dat',elec='$elec',elec_dat='$elec_dat',ser_en='$ser_en',est_amt='$est_amt',est_mr='$est_mr',est_dat='$est_dat',sub_expan='$sub_expan',sub_dat='$sub_dat',mr_subexpan='$mr_subexpan',mr_subexpan_dat='$mr_subexpan_dat',total_expenditure='$total_expenditure' WHERE form_id='$form_id'");	
	}
}
	if($query){
			echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$table_name.".php?tab=5';
		</script>";
	}else{
			echo "<script>
			alert('Invalid Entry');
			window.location.href = '".$table_name.".php?tab=4';
		</script>";
	}
}
if(isset($_POST["save6e"])){ 
	$bef_sub_expan=clean($_POST["bef_sub_expan"]);
	if($bef_sub_expan!=""){
		$bef_sub_expan=date("Y-m-d",strtotime($bef_sub_expan));
	}else{
		$bef_sub_expan=NULL;
	}
	$after_sub_expan=clean($_POST["after_sub_expan"]);
	if($after_sub_expan!=""){
		$after_sub_expan=date("Y-m-d",strtotime($after_sub_expan));
	}else{
		$after_sub_expan=NULL;
	}
	$input_size1=clean($_POST["hiddenval"]);$input_size2=clean($_POST["hiddenval2"]);$input_size3=clean($_POST["hiddenval3"]);$input_size4=clean($_POST["hiddenval4"]);$input_size5=clean($_POST["hiddenval5"]);$total_12d_prod=clean($_POST["total_12d_prod"]);
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){  ////////////table is empty//////////////
		echo "<script>
			alert('Please fill up the first part of the form .');
			window.location.href = '".$table_name.".php';
		</script>";
	}else{
		$form_id=$row["form_id"];
        $sql1=$formFunctions->executeQuery($dept,"select id from ".$table_name."_part1 where form_id='$form_id'");
		$row1=$sql1->fetch_array();
		if($sql1->num_rows<1){ 
        echo "<script>
				alert('Please fill up the third part of the form !!!');
				window.location.href = '".$table_name.".php?tab=4';
			</script>";
		}else{
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_part1 SET bef_sub_expan='$bef_sub_expan',after_sub_expan='$after_sub_expan',total_12d_prod='$total_12d_prod' WHERE form_id='$form_id'");	
	}	
}
	if($query){
		if($input_size1!=0){					
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size1;$i++){
				//$vala=$_POST["txtA".$i];	
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$valf=$_POST["txtF".$i];
				$valg=$_POST["txtG".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,slno,items,annual_quantity,annual_rupees,actual_quantity,actual_rupees,percentage) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg')");
			}
		}
		if($input_size2!=0){					
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				//$vala=$_POST["textA".$i];	
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$vald=$_POST["textD".$i];	
				$vale=$_POST["textE".$i];	
				$valf=$_POST["textF".$i];	
				$valg=$_POST["textG".$i];	
				$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(id,form_id,slno,items,annual_quantity,annual_rupees,actual_quantity,actual_rupees,percentage) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg')");
			}
		}
		if($input_size3!=0){					
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t3 where form_id='$form_id'");
			for($i=1;$i<$input_size3;$i++){
				//$vala=$_POST["txxtA".$i];		
				$valb=$_POST["txxtB".$i];
				$valc=$_POST["txxtC".$i];
				$vald=$_POST["txxtD".$i];				
				$vale=$_POST["txxtE".$i];				
				$part3=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t3(id,form_id,slno,items,physical_qty,cost_per_unit,total_value) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')") or die($dic->error);
			}
		}
		if($input_size4!=0){					
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t4 where form_id='$form_id'");
			for($i=1;$i<$input_size4;$i++){
				//$vala=$_POST["txttA".$i];		
				$valb=$_POST["txttB".$i];
				$valc=$_POST["txttC".$i];
				$vald=$_POST["txttD".$i];				
				$vale=$_POST["txttE".$i];							
				$part4=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t4(id,form_id,slno,items,physical_qty,cost_per_unit,total_value) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')") or die($dic->error);
			}
		}
		if($input_size5!=0){					
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t5 where form_id='$form_id'");
			for($i=1;$i<$input_size5;$i++){
				//$vala=$_POST["ttxtA".$i];		
				$valb=$_POST["ttxtB".$i];
				$valc=$_POST["ttxtC".$i];	
				$vald=$_POST["ttxtD".$i];	
				$vale=$_POST["ttxtE".$i];	
				$valf=$_POST["ttxtF".$i];				
				$valg=$_POST["ttxtG".$i];
				$part5=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t5(id,form_id,slno,items,actual_quantity,actual_rupees,utilise_quantity,utilise_rupees,remark) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg')");
			}
		}
		if((isset($part1) && $part1==false) || (isset($part2) && $part2==false) || (isset($part3) && $part3==false) || (isset($part4) && $part4==false) || (isset($part5) && $part5==false)){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=5';
			</script>";
		}else{
			 echo "<script>
				alert('Successfully Saved..');
				window.location.href =  '".$table_name.".php?tab=6';
			</script>";
		}	
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=5';
		</script>";
	}	
}
if(isset($_POST["save6f"])){ 
	$input_size6=clean($_POST["hiddenval6"]);$input_size7=clean($_POST["hiddenval7"]);$input_size8=clean($_POST["hiddenval8"]);$input_size9=clean($_POST["hiddenval9"]);$input_size10=clean($_POST["hiddenval10"]);$mandays_utilized=clean($_POST["mandays_utilized"]);
	
	if(!empty($_POST["managerial"])) $managerial=json_encode($_POST["managerial"]);else $managerial=NULL;
	if(!empty($_POST["super"])) $super=json_encode($_POST["super"]);else $super=NULL;
	if(!empty($_POST["skilled"])) $skilled=json_encode($_POST["skilled"]);else $skilled=NULL;
	if(!empty($_POST["semiskilled"])) $semiskilled=json_encode($_POST["semiskilled"]);else $semiskilled=NULL;
	if(!empty($_POST["unskilled"])) $unskilled=json_encode($_POST["unskilled"]);else $unskilled=NULL;
	if(!empty($_POST["total"])) $total=json_encode($_POST["total"]);else $total=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){  ////////////table is empty//////////////
		echo "<script>
			alert('Please fill up the first part of the form .');
			window.location.href = '".$table_name.".php';
		</script>";
	}else{
		$form_id=$row["form_id"];
        $sql1=$formFunctions->executeQuery($dept,"select id from ".$table_name."_part1 where form_id='$form_id'");
		$row1=$sql1->fetch_array();
		if($sql1->num_rows<1){ 
        echo "<script>
				alert('Please fill up the third part of the form !!!');
				window.location.href = '".$table_name.".php?tab=5';
			</script>";
		}else{
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_part1 SET managerial='$managerial',super='$super',skilled='$skilled',semiskilled='$semiskilled',unskilled='$unskilled',total='$total',mandays_utilized='$mandays_utilized' WHERE form_id='$form_id'");	
	}	
}
	if($query){
		if($input_size6!=0){					
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t6 where form_id='$form_id'");
			for($i=1;$i<$input_size6;$i++){
				//$vala=$_POST["txtA".$i];	
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$valf=$_POST["txtF".$i];
				$valg=$_POST["txtG".$i];
				$part6=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t6(id,form_id,slno,items,actual_quantity,actual_rupees,utilise_quantity,utilise_rupees,remark) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg')");
			}
		}
		if($input_size7!=0){					
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t7 where form_id='$form_id'");
			for($i=1;$i<$input_size7;$i++){
				//$vala=$_POST["textA".$i];	
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$vald=$_POST["textD".$i];	
				$vale=$_POST["textE".$i];	
				$valf=$_POST["textF".$i];	
				$valg=$_POST["textG".$i];	
				$valh=$_POST["textH".$i];	
				$part7=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t7(id,form_id,slno,items,source,name,hno,vill,dist,pin) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg','$valh')");
			}
		}
		if($input_size8!=0){					
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t8 where form_id='$form_id'");
			for($i=1;$i<$input_size8;$i++){
				//$vala=$_POST["txxtA".$i];		
				$valb=$_POST["txxtB".$i];
				$valc=$_POST["txxtC".$i];
				$vald=$_POST["txxtD".$i];				
				$vale=$_POST["txxtE".$i];				
				$valf=$_POST["txxtF".$i];				
				$valg=$_POST["txxtG".$i];				
				$part8=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t8(id,form_id,slno,items,within_assam_quantity,within_assam_value,outside_assam_quantity,outside_assam_value,remark) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg')");
			}
		}
		if($input_size9!=0){					
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t9 where form_id='$form_id'");
			for($i=1;$i<$input_size9;$i++){
				//$vala=$_POST["txttA".$i];		
				$valb=$_POST["txttB".$i];
				$valc=$_POST["txttC".$i];
				$vald=$_POST["txttD".$i];				
				$vale=$_POST["txttE".$i];							
				$valf=$_POST["txttF".$i];							
				$valg=$_POST["txttG".$i];							
				$part9=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t9(id,form_id,slno,items,within_assam_quantity,within_assam_value,outside_assam_quantity,outside_assam_value,remark) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg')");
			}
		}
		if($input_size10!=0){					
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t10 where form_id='$form_id'");
			for($i=1;$i<$input_size10;$i++){
				//$vala=$_POST["ttxtA".$i];		
				$valb=$_POST["ttxtB".$i];
				$valc=$_POST["ttxtC".$i];
				$part10=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t10(id,form_id,slno,name,remark) VALUES ('','$form_id','$i','$valb','$valc')");
			}
		}
		if((isset($part6) && $part6==false) || (isset($part7) && $part7==false) || (isset($part8) && $part8==false) || (isset($part9) && $part9==false) || (isset($part10) && $part10==false)){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=6';
			</script>";
		}else{
			 echo "<script>
				alert('Successfully Saved..');
				window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
			</script>";
			}	
	}else{
	   echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=6';
		   </script>";
	}	
}

if(isset($_POST["save7a"])){
	$manufac_service=clean($_POST["manufac_service"]);$post_office=clean($_POST["post_office"]);
	if(!empty($_POST["office_address"])) $office_address=json_encode($_POST["office_address"]);else $office_address=NULL;		
	if(!empty($_POST["partner_address"])) $partner_address=json_encode($_POST["partner_address"]);else $partner_address=NULL;
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,post_office,office_address,partner_address,manufac_service) values('$swr_id','$post_office','$office_address','$partner_address','$manufac_service')");
	}else{
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET  sub_date='$today', post_office='$post_office',office_address='$office_address',partner_address='$partner_address',manufac_service='$manufac_service' WHERE form_id='$form_id'");	
	}
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$table_name.".php?tab=2';
		</script>";
	}else{
		echo "<script>
			alert('Invalid Entry');
			window.location.href = '".$table_name.".php';
		</script>";
	}
}
if(isset($_POST["save7b"])){
	$mandtory_cert=clean($_POST["mandtory_cert"]);$registration_no=clean($_POST["registration_no"]);$total=clean($_POST["total"]);
		
	if(!empty($_POST["new_unit"])) $new_unit=json_encode($_POST["new_unit"]);else $new_unit=NULL;
	if(!empty($_POST["exist_unit"])) $exist_unit=json_encode($_POST["exist_unit"]);else $exist_unit=NULL;		
	if(!empty($_POST["land"])) $land=json_encode($_POST["land"]);else $land=NULL	;
	if(!empty($_POST["site"])) $site=json_encode($_POST["site"]);else $site=NULL	;
	if(!empty($_POST["off_building"])) $off_building=json_encode($_POST["off_building"]);else $off_building=NULL	;
	if(!empty($_POST["fac_building"])) $fac_building=json_encode($_POST["fac_building"]);else $fac_building=NULL	;
	if(!empty($_POST["plant_item"])) $plant_item=json_encode($_POST["plant_item"]);else $plant_item=NULL	;
	if(!empty($_POST["elec_ins"])) $elec_ins=json_encode($_POST["elec_ins"]);else $elec_ins=NULL	;
	if(!empty($_POST["operative"])) $operative=json_encode($_POST["operative"]);else $operative=NULL	;
	if(!empty($_POST["fixed_asset"])) $fixed_asset=json_encode($_POST["fixed_asset"]);else $fixed_asset=NULL	;
	if(!empty($_POST["total_invest"])) $total_invest=json_encode($_POST["total_invest"]);else $total_invest=NULL	;
	if(!empty($_POST["soruces"])) $soruces=json_encode($_POST["soruces"]);else $soruces=NULL	;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,new_unit,exist_unit,mandtory_cert,registration_no,land,site,off_building,fac_building,plant_item,elec_ins,operative,fixed_asset,total_invest,soruces,total) values('$swr_id','$new_unit','$exist_unit','$mandtory_cert','$registration_no','$land','$site','$off_building','$fac_building','$plant_item','$elec_ins','$operative','$fixed_asset','$total_invest','$soruces','$total')");
	}else{
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET  sub_date='$today',new_unit='$new_unit', exist_unit='$exist_unit',mandtory_cert='$mandtory_cert',land='$land',registration_no='$registration_no',site='$site',off_building='$off_building',fac_building='$fac_building',plant_item='$plant_item',elec_ins='$elec_ins',operative='$operative',fixed_asset='$fixed_asset',total_invest='$total_invest',soruces='$soruces',total='$total' WHERE form_id='$form_id'");	
	}
	if($query){
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$table_name.".php?tab=3';
		</script>";
	}else{
		echo "<script>
			alert('Invalid Entry');
			window.location.href = '".$table_name.".php?tab=2';
		</script>";
	}
}
if(isset($_POST["save7c"])){
	$input_size1=clean($_POST["hiddenval"]);$input_size2=clean($_POST["hiddenval2"]);$input_size3=clean($_POST["hiddenval3"]);
	$purchase_dt=clean($_POST["purchase_dt"]);
	if($purchase_dt!=""){
		$purchase_dt=date("Y-m-d",strtotime($purchase_dt));
	}else{
		$purchase_dt=NULL;
	}
	$dt_of_reg=clean($_POST["dt_of_reg"]);
	if($dt_of_reg!=""){
		$dt_of_reg=date("Y-m-d",strtotime($dt_of_reg));
	}else{
		$dt_of_reg=NULL;
	}	
	$is_building=clean($_POST["is_building"]);$built_up_area=clean($_POST["built_up_area"]);$statement=clean($_POST["statement"]);

	if(!empty($_POST["ownland_area"])) $ownland_area=json_encode($_POST["ownland_area"]);else $ownland_area=NULL;
	if(!empty($_POST["power_a"])) $power_a=json_encode($_POST["power_a"]);else $power_a=NULL;
	if(!empty($_POST["under_expan"])) $under_expan=json_encode($_POST["under_expan"]);else $under_expan=NULL;		
	if(!empty($_POST["land_alloted"])) $land_alloted=json_encode($_POST["land_alloted"]);else $land_alloted=NULL	;
	if(!empty($_POST["lease_land"])) $lease_land=json_encode($_POST["lease_land"]);else $lease_land=NULL	;
	
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,power_a,under_expan,ownland_area,purchase_dt,dt_of_reg,land_alloted,lease_land,is_building,built_up_area,statement,operative,fixed_asset,total_invest,soruces,total) values('$swr_id','$power_a','$under_expan','$ownland_area','$purchase_dt','$dt_of_reg','$land_alloted','$lease_land','$is_building','$built_up_area','$statement','$operative','$fixed_asset','$total_invest','$soruces','$total')");
	}else{
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET  sub_date='$today',power_a='$power_a', under_expan='$under_expan',ownland_area='$ownland_area',purchase_dt='$purchase_dt',dt_of_reg='$dt_of_reg',land_alloted='$land_alloted',lease_land='$lease_land',is_building='$is_building',built_up_area='$built_up_area',statement='$statement' WHERE form_id='$form_id'");	
	}
	if($query){
		if($input_size1!=0){					
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size1;$i++){
				$vala=$_POST["txtA".$i];	
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,bank_name,amount_of_term,letter_no,loan_disbursed) VALUES ('','$form_id','$vala','$valb','$valc','$vald')");
			}
		}
		if($input_size2!=0){					
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				$vala=$_POST["textA".$i];	
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$vald=$_POST["textD".$i];	
				$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(id,form_id,name,amount,pan_no,payment_mode) VALUES ('','$form_id','$vala','$valb','$valc','$vald')");
				//$part4=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2 VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')") or die($dic->error);
			}
		}
		if($input_size3!=0){					
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t3 where form_id='$form_id'");
			for($i=1;$i<$input_size3;$i++){
				$vala=$_POST["txxtA".$i];		
				$valb=$_POST["txxtB".$i];
				$valc=$_POST["txxtC".$i];
				$vald=$_POST["txxtD".$i];				
				$part3=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t3(id,form_id,name,amount,pan_no,payment_mode) VALUES ('','$form_id','$vala','$valb','$valc','$vald')");
			}
		}
		if(isset($part1) && $part1==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=4';
			</script>";
		}else if(isset($part2) && $part2==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=4';
			</script>";
		}else if(isset($part3) && $part3==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=4';
			</script>";
		}else{
			 echo "<script>
				alert('Successfully Saved..');
				window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
			</script>";
			}	
	}else{
	   echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=3';
		   </script>";
	   }	
}

if(isset($_POST["save8a"])){
	$claim_period_form=clean($_POST["claim_period_form"]);
	if($claim_period_form!=""){
		$claim_period_form=date("Y-m-d",strtotime($claim_period_form));
	}else{
		$claim_period_form=NULL;
	}
	$claim_period_to=clean($_POST["claim_period_to"]);
	if($claim_period_to!=""){
		$claim_period_to=date("Y-m-d",strtotime($claim_period_to));
	}else{
		$claim_period_to=NULL;
	}
	$promoters_name=clean($_POST["promoters_name"]);$item_of_product=clean($_POST["item_of_product"]);
	if(!empty($_POST["office_address"])) $office_address=json_encode($_POST["office_address"]);else $office_address=NULL;		
	if(!empty($_POST["promoters_address"])) $promoters_address=json_encode($_POST["promoters_address"]);else $promoters_address=NULL;
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'") ;
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,office_address,claim_period_form,claim_period_to,promoters_name,promoters_address,item_of_product) values('$swr_id','$office_address','$claim_period_form','$claim_period_to','$promoters_name','$promoters_address','$item_of_product')");
	}else{
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET  sub_date='$today', office_address='$office_address',claim_period_form='$claim_period_form',claim_period_to='$claim_period_to',promoters_name='$promoters_name',promoters_address='$promoters_address',item_of_product='$item_of_product' WHERE form_id='$form_id'");	
	}
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$table_name.".php?tab=2';
		</script>";
	}else{
		echo "<script>
			alert('Invalid Entry');
			window.location.href = '".$table_name.".php';
		</script>";
	}
}
if(isset($_POST["save8b"])){
	$date_of_comm=clean($_POST["date_of_comm"]);
	if($date_of_comm!=""){
		$date_of_comm=date("Y-m-d",strtotime($date_of_comm));
	}else{
		$date_of_comm=NULL;
	}
	$date_of_service=clean($_POST["date_of_service"]);
	if($date_of_service!=""){
		$date_of_service=date("Y-m-d",strtotime($date_of_service));
	}else{
		$date_of_service=NULL;
	}
	$cert_no=clean($_POST["cert_no"]);
	$cert_date=clean($_POST["cert_date"]);
	if($cert_date!=""){
		$cert_date=date("Y-m-d",strtotime($cert_date));
	}else{
		$cert_date=NULL;
	}
	$period_from=clean($_POST["period_from"]);
	if($period_from!=""){
		$period_from=date("Y-m-d",strtotime($period_from));
	}else{
		$period_from=NULL;
	}	
	$period_to=clean($_POST["period_to"]);
	if($period_to!=""){
		$period_to=date("Y-m-d",strtotime($period_to));
	}else{
		$period_to=NULL;
	}	
	$percentage_of_increase=clean($_POST["percentage_of_increase"]);
	if(!empty($_POST["new_unit"])) $new_unit=json_encode($_POST["new_unit"]);else $new_unit=NULL;		
	if(!empty($_POST["exist_unit"])) $exist_unit=json_encode($_POST["exist_unit"]);else $exist_unit=NULL;
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,courier_details,date_of_comm,date_of_service,cert_no,cert_date,period_from,period_to,new_unit,exist_unit,percentage_of_increase) values('$swr_id','$today','1','$date_of_comm','$date_of_service','$cert_no','$cert_date','$period_from','$period_to','$new_unit','$exist_unit','$percentage_of_increase')");
		$form_id=$query;
	}else{	////////////table is not empty//////////////			
		$form_id=$row["form_id"];		
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET  sub_date='$today',received_date='$today' , date_of_comm='$date_of_comm',date_of_service='$date_of_service',cert_no='$cert_no',cert_date='$cert_date',period_from='$period_from',period_to='$period_to',new_unit='$new_unit',exist_unit='$exist_unit',percentage_of_increase='$percentage_of_increase' WHERE form_id='$form_id'");
	}
	if($query){
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";
	}else{
		echo "<script>
			alert('Invalid Entry');
			window.location.href = '".$table_name.".php?tab=2';
		</script>";
	}
}

if(isset($_POST["save9a"])){
	$hidden_value=clean($_POST["hidden_value"]);$input_size1=clean($_POST["hiddenval"]);$post_office=clean($_POST["post_office"]);$reg_no=clean($_POST["reg_no"]);
	$reg_date=clean($_POST["reg_date"]);
	if($reg_date!=""){
		$reg_date=date("Y-m-d",strtotime($reg_date));
	}else{
		$reg_date=NULL;
	}
	$investment=clean($_POST["investment"]);$total_invest=clean($_POST["total_invest"]);$plant_machinery=clean($_POST["plant_machinery"]);
	if(!empty($_POST["office_address"])) $office_address=json_encode($_POST["office_address"]);else $office_address=NULL;		
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,post_office,office_address,reg_no,reg_date,investment,total_invest,plant_machinery) values('$swr_id','$post_office','$office_address','$reg_no','$reg_date','$investment','$total_invest','$plant_machinery')");
		$form_id=$query;
		for($i=1;$i<=$hidden_value;$i++){
			$partner_name=$_POST["partner_name".$i.""];$partner_address=$_POST["partner_address".$i.""];$partner_pan_no=$_POST["partner_pan_no".$i.""];
			$query1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_partners(id,form_id,sl_no,partner_name,partner_address,partner_pan_no) VALUES ('','$form_id','$i','$partner_name','$partner_address','$partner_pan_no')");
		}
	}else{
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET  sub_date='$today', post_office='$post_office',office_address='$office_address',reg_no='$reg_no',reg_date='$reg_date',investment='$investment',total_invest='$total_invest',plant_machinery='$plant_machinery' WHERE form_id='$form_id'");
		for($i=1;$i<=$hidden_value;$i++){
			$partner_name=$_POST["partner_name".$i.""];$partner_address=$_POST["partner_address".$i.""];$partner_pan_no=$_POST["partner_pan_no".$i.""];
			$query1=$formFunctions->executeQuery($dept,"update ".$table_name."_partners set partner_name='$partner_name',partner_address='$partner_address',partner_pan_no='$partner_pan_no' where form_id='$form_id' and sl_no='$i'");
		}
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
				$vale=$_POST["txtE".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,sl_no,bank_name,amount_of_term,working_capital,working_capital_limit) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}		
		if(isset($part1) && $part1==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=1';
			</script>";
		
		}else{
			 echo "<script>
				alert('Successfully Saved..');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
			}	
	}else{
	   echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=1';
		   </script>";
	   }	
}
if(isset($_POST["save9b"])){
	$input_size2=clean($_POST["hiddenval2"]);$input_size3=clean($_POST["hiddenval3"]);$input_size4=clean($_POST["hiddenval4"]);$s1=clean($_POST["s1"]);$reg_details=clean($_POST["reg_details"]);
	$date_of_production=clean($_POST["date_of_production"]);
	if($date_of_production!=""){
		$date_of_production=date("Y-m-d",strtotime($date_of_production));
	}else{
		$date_of_production=NULL;
	}
	$other_incentives=clean($_POST["other_incentives"]);$total_amount=clean($_POST["total_amount"]);$total_year=clean($_POST["total_year"]);$transport_regno=clean($_POST["transport_regno"]);
	$period_of_val_f=clean($_POST["period_of_val_f"]);
	if($period_of_val_f!=""){
		$period_of_val_f=date("Y-m-d",strtotime($period_of_val_f));
	}else{
		$period_of_val_f=NULL;
	}
	$period_of_val_t=clean($_POST["period_of_val_t"]);
	if($period_of_val_t!=""){
		$period_of_val_t=date("Y-m-d",strtotime($period_of_val_t));
	}else{
		$period_of_val_t=NULL;
	}
	if(!empty($_POST["pmt_reg"])) $pmt_reg=json_encode($_POST["pmt_reg"]);else $pmt_reg=NULL;		
	if(!empty($_POST["under_neipp"])) $under_neipp=json_encode($_POST["under_neipp"]);else $under_neipp=NULL;
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,s1,reg_details,pmt_reg,date_of_production,other_incentives,under_neipp,total_amount,total_year,transport_regno,period_of_val_f,period_of_val_t) values('$swr_id','$s1','$reg_details','$pmt_reg','$date_of_production','$other_incentives','$under_neipp','$total_amount','$total_year','$transport_regno','$period_of_val_f','$period_of_val_t')");
	}else{
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET  sub_date='$today', s1='$s1',reg_details='$reg_details',pmt_reg='$pmt_reg',date_of_production='$date_of_production',other_incentives='$other_incentives',under_neipp='$under_neipp',total_amount='$total_amount',total_year='$total_year',transport_regno='$transport_regno',period_of_val_f='$period_of_val_f',period_of_val_t='$period_of_val_t' WHERE form_id='$form_id'");	
	}
	if($query){
		if($input_size2!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				//$vala=$_POST["textA".$i];	
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$vald=$_POST["textD".$i];	
				$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(id,form_id,sl_no,incentive_name,amount,year) VALUES ('','$form_id','$i','$valb','$valc','$vald')");
			}
		}
		if($input_size3!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t3 where form_id='$form_id'");
			for($i=1;$i<$input_size3;$i++){
				//$vala=$_POST["txxtA".$i];		
				$valb=$_POST["txxtB".$i];
				$valc=$_POST["txxtC".$i];
				$vald=$_POST["txxtD".$i];				
				$vale=$_POST["txxtE".$i];				
				$part3=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t3(id,form_id,sl_no,item_name,ins_cap,value,capacity) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}
		if($input_size4!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t4 where form_id='$form_id'");
			for($i=1;$i<$input_size4;$i++){
				//$vala=$_POST["txttA".$i];		
				$valb=$_POST["txttB".$i];
				$valc=$_POST["txttC".$i];
				$vald=$_POST["txttD".$i];				
				$vale=$_POST["txttE".$i];				
				$part4=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t4(id,form_id,sl_no,raw_material,annual_req,value,joint_capacity) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}
		if(isset($part2) && $part2==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
		
		}else if(isset($part3) && $part3==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
		
		}else if(isset($part4) && $part4==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
		
		}else{
			 echo "<script>
				alert('Successfully Saved..');
				window.location.href = '".$table_name.".php?tab=3';
			</script>";
			}	
	}else{
	   echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=2';
		   </script>";
	   }	
}
if(isset($_POST["save9c"])){
	$input_size5=clean($_POST["hiddenval5"]);$input_size6=clean($_POST["hiddenval6"]);$input_size7=clean($_POST["hiddenval7"]);$no_of_employee=clean($_POST["no_of_employee"]);$emp_under_contractor=clean($_POST["emp_under_contractor"]);$tan_n_unit=clean($_POST["tan_n_unit"]);$central_excise=clean($_POST["central_excise"]);$vat_reg=clean($_POST["vat_reg"]);$dist_f_focal=clean($_POST["dist_f_focal"]);$dist_f_rstation=clean($_POST["dist_f_rstation"]);$product_ext_from=clean($_POST["product_ext_from"]);
	if(!empty($_POST["power"])) $power=json_encode($_POST["power"]);else $power=NULL;		
	if(!empty($_POST["claim"])) $claim=json_encode($_POST["claim"]);else $claim=NULL;
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,no_of_employee,emp_under_contractor,tan_n_unit,central_excise,vat_reg,power,claim,dist_f_focal,dist_f_rstation,product_ext_from) values('$swr_id','$no_of_employee','$emp_under_contractor','$tan_n_unit','$central_excise','$vat_reg','$power','$claim','$dist_f_focal','$dist_f_rstation','$product_ext_from')");
	}else{
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET  sub_date='$today', no_of_employee='$no_of_employee',emp_under_contractor='$emp_under_contractor',tan_n_unit='$tan_n_unit',central_excise='$central_excise',vat_reg='$vat_reg',power='$power',claim='$claim',dist_f_focal='$dist_f_focal',dist_f_rstation='$dist_f_rstation',product_ext_from='$product_ext_from' WHERE user_id='$swr_id' AND form_id='$form_id'");	
	}
	if($query){
		if($input_size5!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t5 where form_id='$form_id'");
			for($i=1;$i<$input_size5;$i++){
				//$vala=$_POST["txttA".$i];		
				$valb=$_POST["txttB".$i];
				$valc=$_POST["txttC".$i];
				if($valc!=""){
					$valc=date("Y-m-d",strtotime($valc));
				}else{
					$valc=NULL;
				}
				$vald=$_POST["txttD".$i];				
				$part5=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t5(id,form_id,sl_no,item,date,amount) VALUES ('','$form_id','$i','$valb','$valc','$vald')");
			}
		}
		if($input_size6!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t6 where form_id='$form_id'");
			for($i=1;$i<$input_size6;$i++){
				//$vala=$_POST["txxtA".$i];		
				$valb=$_POST["txxtB".$i];
				$valc=$_POST["txxtC".$i];
				$vald=$_POST["txxtD".$i];				
				$vale=$_POST["txxtE".$i];				
				$valf=$_POST["txxtF".$i];				
				$part6=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t6(id,form_id,sl_no,raw_mat,qty,value,transport_charge,transport_charge_paid) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale','$valf')");
			}
		}
		if($input_size7!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t7 where form_id='$form_id'");
			for($i=1;$i<$input_size7;$i++){
				//$vala=$_POST["textA".$i];	
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$vald=$_POST["textD".$i];	
				$vale=$_POST["textE".$i];	
				$valf=$_POST["textF".$i];	
				$part7=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t7(id,form_id,sl_no,product_name,quantity,value,transport_charge,transport_charge_paid) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale','$valf')");
			}
		}
		if(isset($part5) && $part5==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=3';
			</script>";
		
		}else if(isset($part6) && $part6==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=3';
			</script>";
		
		}else if(isset($part7) && $part7==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=3';
			</script>";
		
		}else{
			 echo "<script>
				alert('Successfully Saved..');
				window.location.href = '".$table_name.".php?tab=4';
			</script>";
			}	
	}else{
	   echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=3';
		   </script>";
	   }	
			
}
if(isset($_POST["save9d"])){
	$input_size8=clean($_POST["hiddenval8"]);$input_size9=clean($_POST["hiddenval9"]);$input_size10=clean($_POST["hiddenval10"]);$input_size11=clean($_POST["hiddenval11"]);$unit_consumed=clean($_POST["unit_consumed"]);$dg_set_rating=clean($_POST["dg_set_rating"]);$diesel_consumed=clean($_POST["diesel_consumed"]);$dg_unit_consumed=clean($_POST["dg_unit_consumed"]);$total_elec_unit=clean($_POST["total_elec_unit"]);
	if(!empty($_POST["bank_details"])) $bank_details=json_encode($_POST["bank_details"]);else $bank_details=NULL;		
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,unit_consumed,dg_set_rating,diesel_consumed,dg_unit_consumed,total_elec_unit,bank_details) values('$swr_id','$unit_consumed','$dg_set_rating','$diesel_consumed','$dg_unit_consumed','$total_elec_unit','$bank_details')");
	}else{
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET  sub_date='$today', unit_consumed='$unit_consumed',dg_set_rating='$dg_set_rating',diesel_consumed='$diesel_consumed',dg_unit_consumed='$dg_unit_consumed',total_elec_unit='$total_elec_unit',bank_details='$bank_details' WHERE user_id='$swr_id' AND form_id='$form_id'");	
	}
	if($query){
		if($input_size8!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t8 where form_id='$form_id'");
			for($i=1;$i<$input_size8;$i++){
				//$vala=$_POST["textA".$i];	
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$vald=$_POST["textD".$i];	
				$vale=$_POST["textE".$i];
				$part8=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t8(id,form_id,sl_no,raw_mat,outside_qty,utilized_qty,subsidy_amount) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}
		if($input_size9!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t9 where form_id='$form_id'");
			for($i=1;$i<$input_size9;$i++){
				//$vala=$_POST["txxtA".$i];		
				$valb=$_POST["txxtB".$i];
				$valc=$_POST["txxtC".$i];
				$vald=$_POST["txxtD".$i];				
				$vale=$_POST["txxtE".$i];								
				$part9=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t9(id,form_id,sl_no,product_name,sold_qty,sold_during,amount) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}
		if($input_size10!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t10 where form_id='$form_id'");
			for($i=1;$i<$input_size10;$i++){
				//$vala=$_POST["txttA".$i];		
				$valb=$_POST["txttB".$i];
				$valc=$_POST["txttC".$i];
				$vald=$_POST["txttD".$i];				
				$vale=$_POST["txttE".$i];				
				$part10=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t10(id,form_id,sl_no,raw_mat,within_ner_qty,utilized_qty,amount) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}
		if($input_size11!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t11 where form_id='$form_id'");
			for($i=1;$i<$input_size11;$i++){
				//$vala=$_POST["txtA".$i];	
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t11(id,form_id,sl_no,product_name,sold_ner_qty,sold_during,amount) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}	
		if(isset($part8) && $part8==false){
				echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=4';
			</script>";
		
		}else if(isset($part9) && $part9==false){
				echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=4';
			</script>";
		
		}else if(isset($part10) && $part10==false){
				echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=4';
			</script>";
		
		}else if(isset($part11) && $part11==false){
				echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=4';
			</script>";
		
		}else{
				echo "<script>
				alert('Successfully Saved..');
				window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
			</script>";
		}	
	}else{
			echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=4';
		   </script>";
	}			
	
}

if(isset($_POST["save10"])){
	$indus_land=clean($_POST["indus_land"]);$actual_area=clean($_POST["actual_area"]);$lic_no=clean($_POST["lic_no"]);	$lic_date=clean($_POST["lic_date"]);$authority=clean($_POST["authority"]);$dicc_district_id=clean($_POST["dicc_district_id"]);
	if($lic_date!=""){
		$lic_date=date("Y-m-d",strtotime($lic_date));
	}else{
		$lic_date=NULL;
	}	
	
	$_SESSION["authority"] = $authority;
	$_SESSION["indus_land"] = $indus_land;
	$_SESSION["district_id"] = $dicc_district_id;
	
	
	
	$item_name=clean($_POST["item_name"]);$production_capacity=clean($_POST["production_capacity"]);$prod_export=clean($_POST["prod_export"]);$civil_works=clean($_POST["civil_works"]);$plant_n_machinery=clean($_POST["plant_n_machinery"]);$other_fixed_assets=clean($_POST["other_fixed_assets"]);$actual_prod_area=clean($_POST["actual_prod_area"]);$godown=clean($_POST["godown"]);$other_services=clean($_POST["other_services"]);$power_req=clean($_POST["power_req"]);$water_req=clean($_POST["water_req"]);$if_any=clean($_POST["if_any"]);
	
	if($if_any=="Y") $PI_indicate=clean($_POST["PI_indicate"]);
	else $PI_indicate="";
	
	if($authority=="DICC"){
		$district = $formFunctions->executeQuery("dicc","select dist_name from districts where dist_id='$dicc_district_id'")->fetch_object()->dist_name;
		
		$officer_id = $formFunctions->executeQuery($dept,"select a.user_id from users as a LEFT JOIN offices as b ON b.id=a.office_id where b.district='$district' and a.utype='2'")->fetch_object()->user_id;
		
	}else{
		
		$officer_id = $formFunctions->executeQuery($dept,"select a.user_id from users as a LEFT JOIN offices as b ON b.id=a.office_id where b.office_name='$authority' and a.utype='2'")->fetch_object()->user_id;
	}
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
		if($sql->num_rows<1){   ////////////table is empty//////////////
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id, authority,indus_land,dicc_district_id,officer_id,actual_area,lic_no,lic_date,item_name,production_capacity,prod_export,civil_works,plant_n_machinery,other_fixed_assets,actual_prod_area,godown,other_services,power_req,water_req,if_any,PI_indicate) values('$swr_id','$authority','$indus_land','$dicc_district_id','$officer_id','$actual_area','$lic_no','$lic_date','$item_name','$production_capacity','$prod_export','$civil_works','$plant_n_machinery','$other_fixed_assets','$actual_prod_area','$godown','$other_services','$power_req','$water_req','$if_any','$PI_indicate')");
		}else{
			$form_id=$row["form_id"];
			$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET  sub_date='$today', authority='$authority', indus_land='$indus_land', dicc_district_id='$dicc_district_id',officer_id='$officer_id',actual_area='$actual_area',lic_no='$lic_no',lic_date='$lic_date',item_name='$item_name',production_capacity='$production_capacity',prod_export='$prod_export',civil_works='$civil_works',plant_n_machinery='$plant_n_machinery',other_fixed_assets='$other_fixed_assets',actual_prod_area='$actual_prod_area',godown='$godown',other_services='$other_services',power_req='$power_req',water_req='$water_req',if_any='$if_any',PI_indicate='$PI_indicate' WHERE user_id='$swr_id' AND form_id='$form_id'");	
		}
		if($query){
			
			$formFunctions->insert_incomplete_forms($dept,$form); 
			echo "<script>
				alert('Successfully Saved..');
				window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
			</script>";
		}else{
			echo "<script>
				alert('Invalid Entry');
				window.location.href = '".$table_name.".php';
			</script>";
		}
		
}

if(isset($_POST["save11"])){
	$indus_land=clean($_POST["indus_land"]);$actual_area=clean($_POST["actual_area"]);$lic_no=clean($_POST["lic_no"]);	$lic_date=clean($_POST["lic_date"]);$authority=clean($_POST["authority"]);$dicc_district_id=clean($_POST["dicc_district_id"]);
	if($lic_date!=""){
		$lic_date=date("Y-m-d",strtotime($lic_date));
	}else{
		$lic_date=NULL;
	}
	
	$_SESSION["authority"] = $authority;
	$_SESSION["indus_land"] = $indus_land;
	$_SESSION["district_id"] = $dicc_district_id;
	
	$item_name=clean($_POST["item_name"]);$production_capacity=clean($_POST["production_capacity"]);$prod_export=clean($_POST["prod_export"]);$civil_works=clean($_POST["civil_works"]);$plant_n_machinery=clean($_POST["plant_n_machinery"]);$other_fixed_assets=clean($_POST["other_fixed_assets"]);$actual_prod_area=clean($_POST["actual_prod_area"]);$godown=clean($_POST["godown"]);$other_services=clean($_POST["other_services"]);$power_req=clean($_POST["power_req"]);$water_req=clean($_POST["water_req"]);$if_any=clean($_POST["if_any"]);
	
	if($if_any=="Y") $PI_indicate=clean($_POST["PI_indicate"]);
			else $PI_indicate="";
	
	if($authority=="DICC"){
		$district = $formFunctions->executeQuery("dicc","select dist_name from districts where dist_id='$dicc_district_id'")->fetch_object()->dist_name;
		
		$officer_id = $formFunctions->executeQuery($dept,"select a.user_id from users as a LEFT JOIN offices as b ON b.id=a.office_id where b.district='$district' and a.utype='2'")->fetch_object()->user_id;
		
	}else{
		
		$officer_id = $formFunctions->executeQuery($dept,"select a.user_id from users as a LEFT JOIN offices as b ON b.id=a.office_id where b.office_name='$authority' and a.utype='2'")->fetch_object()->user_id;
	}
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
		if($sql->num_rows<1){   ////////////table is empty//////////////
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,authority,dicc_district_id,officer_id,indus_land,actual_area,lic_no,lic_date,item_name,production_capacity,prod_export,civil_works,plant_n_machinery,other_fixed_assets,actual_prod_area,godown,other_services,power_req,water_req,if_any,PI_indicate) values('$swr_id','$authority','$dicc_district_id','$officer_id','$indus_land','$actual_area','$lic_no','$lic_date','$item_name','$production_capacity','$prod_export','$civil_works','$plant_n_machinery','$other_fixed_assets','$actual_prod_area','$godown','$other_services','$power_req','$water_req','$if_any','$PI_indicate')");
		}else{
			$form_id=$row["form_id"];
			$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET  sub_date='$today', authority='$authority', dicc_district_id='$dicc_district_id', officer_id='$officer_id', indus_land='$indus_land',actual_area='$actual_area',lic_no='$lic_no',lic_date='$lic_date',item_name='$item_name',production_capacity='$production_capacity',prod_export='$prod_export',civil_works='$civil_works',plant_n_machinery='$plant_n_machinery',other_fixed_assets='$other_fixed_assets',actual_prod_area='$actual_prod_area',godown='$godown',other_services='$other_services',power_req='$power_req',water_req='$water_req',if_any='$if_any',PI_indicate='$PI_indicate' WHERE user_id='$swr_id' AND form_id='$form_id'");	
		}
		if($query){
			$formFunctions->insert_incomplete_forms($dept,$form); 
			echo "<script>
				alert('Successfully Saved..');
				window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
			</script>";
		}else{
			echo "<script>
				alert('Invalid Entry');
				window.location.href = '".$table_name.".php';
			</script>";
		}
}

if(isset($_POST["save12a"])){		
	$substantial_exp=clean($_POST["substantial_exp"]);$office_mob=clean($_POST["office_mob"]);$act_reg_date=clean($_POST["act_reg_date"]);$nature=clean($_POST["nature"]);$new_units_dt=clean($_POST["new_units_dt"]);$existing_units_dt=clean($_POST["existing_units_dt"]);
	$hidden_value=clean($_POST["hidden_value"]);
	
	if($act_reg_date!=""){
		$act_reg_date=date("Y-m-d",strtotime($act_reg_date));
	}else{
		$act_reg_date=NULL;
	}
		
	if(!empty($_POST["man_units"])) $man_units=json_encode($_POST["man_units"]);else $man_units=NULL;		
	if(!empty($_POST["ser_sector"])) $ser_sector=json_encode($_POST["ser_sector"]);else $ser_sector=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,substantial_exp,office_mob,act_reg_date,nature,new_units_dt,existing_units_dt,man_units,ser_sector) values('$swr_id','$substantial_exp','$office_mob','$act_reg_date','$nature','$new_units_dt','$existing_units_dt','$man_units','$ser_sector')");
		$form_id=$query;
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_members where form_id='$form_id'");
		for($i=1;$i<=$hidden_value;$i++){
			$name=$_POST["name".$i.""];$sn1=$_POST["sn1".$i.""];$sn2=$_POST["sn2".$i.""];$vill=$_POST["vill".$i.""];$dist=$_POST["dist".$i.""];$pin=$_POST["pin".$i.""];
			
			$query1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_members(id,form_id,sl_no,name,sn1,sn2,vill,dist,pin) VALUES ('','$form_id','$i','$name','$sn1','$sn2','$vill','$dist','$pin')");
		}
		
	}else{
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET  sub_date='$today',substantial_exp='$substantial_exp', office_mob='$office_mob',act_reg_date='$act_reg_date',nature='$nature',new_units_dt='$new_units_dt',existing_units_dt='$existing_units_dt',man_units='$man_units',ser_sector='$ser_sector' WHERE form_id='$form_id'");	
		for($i=1;$i<=$hidden_value;$i++){
			$name=$_POST["name".$i.""];$sn1=$_POST["sn1".$i.""];$sn2=$_POST["sn2".$i.""];$vill=$_POST["vill".$i.""];$dist=$_POST["dist".$i.""];$pin=$_POST["pin".$i.""];
			
			$query1=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_members set name='$name',sn1='$sn1',sn2='$sn2',vill='$vill',dist='$dist',pin='$pin' where form_id='$form_id' and sl_no='$i'");
		}
	}
	if($query==true && $query1==true){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$table_name.".php?tab=2';
		</script>";
	}else{
		echo "<script>
			alert('Invalid Entry');
			window.location.href = '".$table_name.".php?tab=1';
		</script>";
	}
}
if(isset($_POST["save12b"])){	
	
	$input_size1=clean($_POST["hiddenval"]);$input_size2=clean($_POST["hiddenval2"]);	
	
	$bnk_ac_no=clean($_POST["bnk_ac_no"]);
	$acc_type=clean($_POST["acc_type"]);$bnk_name=clean($_POST["bnk_name"]);$bnk_branch=clean($_POST["bnk_branch"]);
	
	
	if(!empty($_POST["em_part1"])) $em_part1=json_encode($_POST["em_part1"]);else $em_part1=NULL;
	if(!empty($_POST["em_part2"])) $em_part2=json_encode($_POST["em_part2"]);else $em_part2=NULL;
	if(!empty($_POST["elig_cert"])) $elig_cert=json_encode($_POST["elig_cert"]);else $elig_cert=NULL;
	if(!empty($_POST["gstn"])) $gstn=json_encode($_POST["gstn"]);else $gstn=NULL;
	if(!empty($_POST["pan"])) $pan=json_encode($_POST["pan"]);else $pan=NULL;
	
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	
	if($sql->num_rows<1){   ////////////table is empty//////////////
		echo "<script>
			alert('Please Fill up the first part of the form .');
			window.location.href = '".$table_name.".php';
		</script>";
	}else{		
		$form_id=$row["form_id"];
		
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET  sub_date='$today', bnk_ac_no='$bnk_ac_no',acc_type='$acc_type',bnk_name='$bnk_name',bnk_branch='$bnk_branch',em_part1='$em_part1',em_part2='$em_part2',elig_cert='$elig_cert',gstn='$gstn',pan='$pan' WHERE form_id='$form_id'");	
	}	
	if($query){
		if($input_size1!=0){
				
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
		
			for($i=1;$i<$input_size1;$i++){
				//$vala=$_POST["txtA".$i];	
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,slno,hsn_code,desc1) VALUES ('','$form_id','$i','$valb','$valc')");
				
			}
		}
		if($input_size2!=0){					
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				//$vala=$_POST["textA".$i];	
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(id,form_id,slno,nic_code,desc2) VALUES ('','$form_id','$i','$valb','$valc')");
			}
		}
		
			 echo "<script>
				alert('Successfully Saved..');
				window.location.href =  '".$table_name.".php?tab=3';
			</script>";	
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=2';
		</script>";
	}	
}
if(isset($_POST["save12c"])){

	$ins_name=clean($_POST["ins_name"]);
	
	if(!empty($_POST["ins"])) $ins=json_encode($_POST["ins"]);else $ins=NULL;
	
	$comm_dt_first_fire=clean($_POST["comm_dt_first_fire"]);
	
	if(!empty($_POST["period_of_ins"])) $period_of_ins=json_encode($_POST["period_of_ins"]);else $period_of_ins=NULL;
	
	$fire_policy_no=clean($_POST["fire_policy_no"]);$basis_sum_insured=clean($_POST["basis_sum_insured"]);$tot_sum_ins1=clean($_POST["tot_sum_ins1"]);
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		echo "<script>
			alert('Please Fill up the first part of the form .');
			window.location.href = '".$table_name.".php';
		</script>";
	}else{
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET ins_name='$ins_name',ins='$ins',comm_dt_first_fire='$comm_dt_first_fire',period_of_ins='$period_of_ins',fire_policy_no='$fire_policy_no',basis_sum_insured='$basis_sum_insured',tot_sum_ins1='$tot_sum_ins1' WHERE form_id='$form_id'");	
	}
	if($query){
			echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$table_name.".php?tab=4';
		</script>";
	}else{
			echo "<script>
			alert('Invalid Entry');
			window.location.href = '".$table_name.".php?tab=3';
		</script>";
	}
}
if(isset($_POST["save12d"])){
	$boundary_wall=clean($_POST["boundary_wall"]);$buildings=clean($_POST["buildings"]);$plant_machinery=clean($_POST["plant_machinery"]);$misc_fixed_assets=clean($_POST["misc_fixed_assets"]);$net_pre_paid=clean($_POST["net_pre_paid"]);$amount_of_refund=clean($_POST["amount_of_refund"]);$is_cert_policy=clean($_POST["is_cert_policy"]);$reim_ins_premium=clean($_POST["reim_ins_premium"]);$work_capital_bnk_name=clean($_POST["work_capital_bnk_name"]);$work_capital_branch=clean($_POST["work_capital_branch"]);$cash_credit_acc_no=clean($_POST["cash_credit_acc_no"]);$work_capital_limit=clean($_POST["work_capital_limit"]);$sanction_number=clean($_POST["sanction_number"]);$sanction_dt2=clean($_POST["sanction_dt2"]);$tot_interest_charged_bnk=clean($_POST["tot_interest_charged_bnk"]);$tot_interest_subsidy_elig=clean($_POST["tot_interest_subsidy_elig"]);
	
	if($sanction_dt2!=""){
		$sanction_dt2=date("Y-m-d",strtotime($sanction_dt2));
	}else{
		$sanction_dt2=NULL;
	}
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		echo "<script>
			alert('Please Fill up the first part of the form .');
			window.location.href = '".$table_name.".php';
		</script>";
	}else{
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET boundary_wall='$boundary_wall',buildings='$buildings', plant_machinery='$plant_machinery',misc_fixed_assets='$misc_fixed_assets',net_pre_paid='$net_pre_paid',amount_of_refund='$amount_of_refund',is_cert_policy='$is_cert_policy',reim_ins_premium='$reim_ins_premium',work_capital_bnk_name='$work_capital_bnk_name',work_capital_branch='$work_capital_branch',cash_credit_acc_no='$cash_credit_acc_no',work_capital_limit='$work_capital_limit', sanction_number='$sanction_number',sanction_dt2='$sanction_dt2',tot_interest_charged_bnk='$tot_interest_charged_bnk',tot_interest_subsidy_elig='$tot_interest_subsidy_elig' WHERE form_id='$form_id'");	
	}
	if($query){
			echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$table_name.".php?tab=5';
		</script>";
	}else{
			echo "<script>
			alert('Invalid Entry');
			window.location.href = '".$table_name.".php?tab=4';
		</script>";
	}
}
if(isset($_POST["save12e"])){ 
	
	if(!empty($_POST["capital_investment"]))	 $capital_investment=json_encode($_POST["capital_investment"]);
	else	$capital_investment=NULL;
	
	$source_of_fin1=clean($_POST["source_of_fin1"]);
	$source_of_fin2=clean($_POST["source_of_fin2"]);$source_of_fin3=clean($_POST["source_of_fin3"]);$source_of_fin4=clean($_POST["source_of_fin4"]);$source_of_fin5=clean($_POST["source_of_fin5"]);$source_of_fin6=clean($_POST["source_of_fin6"]);
	
	$input_size3=clean($_POST["hiddenval3"]);$input_size4=clean($_POST["hiddenval4"]);$input_size5=clean($_POST["hiddenval5"]);
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){  ////////////table is empty//////////////
		echo "<script>
			alert('Please fill up the first part of the form .');
			window.location.href = '".$table_name.".php';
		</script>";
	}else{
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET capital_investment='$capital_investment',source_of_fin1='$source_of_fin1',source_of_fin2='$source_of_fin2',source_of_fin3='$source_of_fin3',source_of_fin4='$source_of_fin4',source_of_fin5='$source_of_fin5',source_of_fin6='$source_of_fin6' WHERE form_id='$form_id'");	
	}	
	if($query){
		if($input_size3!=0){					
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t3 where form_id='$form_id'");
			for($i=1;$i<$input_size3;$i++){
				//$vala=$_POST["txtA".$i];	
				$valb=$_POST["taB".$i];
				$valc=$_POST["taC".$i];
				$vald=$_POST["taD".$i];
				$vale=$_POST["taE".$i];
				$valf=$_POST["taF".$i];
				
				$part3=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t3(id,form_id,slno,bnk_fin_name,term_amount,sanction_letter_no,sanction_date_no,working_cap_term_amt) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale','$valf')");
			}
		}
		if($input_size4!=0){					
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t4 where form_id='$form_id'");
			for($i=1;$i<$input_size4;$i++){
				//$vala=$_POST["textA".$i];	
				$valb=$_POST["tbB".$i];
				$valc=$_POST["tbC".$i];
				$vald=$_POST["tbD".$i];	
				$vale=$_POST["tbE".$i];	
					
				$part4=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t4(id,form_id,slno,name_person,amt,pan_no,pay_mode) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}
		if($input_size5!=0){					
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t5 where form_id='$form_id'");
			for($i=1;$i<$input_size5;$i++){
				//$vala=$_POST["txxtA".$i];		
				$valb=$_POST["tcB".$i];
				$valc=$_POST["tcC".$i];
				$vald=$_POST["tcD".$i];				
				$vale=$_POST["tcE".$i];				
				$part5=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t5(id,form_id,slno,name_person2,amt2,pan_no2,pay_mode2) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}
		
		if((isset($part3) && $part3==false) || (isset($part4) && $part4==false) || (isset($part5) && $part5==false)){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=5';
			</script>";
		}else{
			 echo "<script>
				alert('Successfully Saved..');
				window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
			</script>";
		}	
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=5';
		</script>";
	}	
}

if(isset($_POST["save13a"])){
    $office_mob=clean($_POST["office_mob"]);	
	$act_reg_date=clean($_POST["act_reg_date"]);
	$hidden_value=clean($_POST["hidden_value"]);
	
	if($act_reg_date!=""){
		$act_reg_date=date("Y-m-d",strtotime($act_reg_date));
	}else{
		$act_reg_date=NULL;
	}
	
	if(!empty($_POST["head"])) $head=json_encode($_POST["head"]);
	else $head=NULL;
	if(!empty($_POST["ack"])) $ack=json_encode($_POST["ack"]);
	else $ack=NULL;
		
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	
	if($sql->num_rows<1){ 
	////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,office_mob,act_reg_date,head,ack) values('$swr_id','$today','$office_mob','$act_reg_date','$head','$ack')");
		$form_id=$query;
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_members where form_id='$form_id'");
		for($i=1;$i<=$hidden_value;$i++){
			$name=$_POST["name".$i.""];$sn1=$_POST["sn1".$i.""];$sn2=$_POST["sn2".$i.""];$vill=$_POST["vill".$i.""];$dist=$_POST["dist".$i.""];$pin=$_POST["pin".$i.""];
			
			$query1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_members(id,form_id,sl_no,name,sn1,sn2,vill,dist,pin) VALUES ('','$form_id','$i','$name','$sn1','$sn2','$vill','$dist','$pin')");
		}
	}else{
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET  sub_date='$today',office_mob='$office_mob',act_reg_date='$act_reg_date',head='$head',ack='$ack' WHERE form_id='$form_id'");	
		for($i=1;$i<=$hidden_value;$i++){
			$name=$_POST["name".$i.""];$sn1=$_POST["sn1".$i.""];$sn2=$_POST["sn2".$i.""];$vill=$_POST["vill".$i.""];$dist=$_POST["dist".$i.""];$pin=$_POST["pin".$i.""];
			
			$query1=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_members set name='$name',sn1='$sn1',sn2='$sn2',vill='$vill',dist='$dist',pin='$pin' where form_id='$form_id' and sl_no='$i'");
		}
	}
	if($query==true && $query1==true){
		$formFunctions->insert_incomplete_forms($dept,$form);  
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$table_name.".php?tab=2';
		</script>";
	}else{
		echo "<script>
			alert('Invalid Entry');
			window.location.href = '".$table_name.".php?tab=1';
		</script>";
	}
}
if(isset($_POST["save13b"])){
	$if_any=clean($_POST["if_any"]);$new_units_dt=clean($_POST["new_units_dt"]);$if_any1=clean($_POST["if_any1"]);$nature=clean($_POST["nature"]);$if_any2=clean($_POST["if_any2"]);$if_any3=clean($_POST["if_any3"]);$PI_indicate=clean($_POST["PI_indicate"]);$conn_load=clean($_POST["conn_load"]);$new_production=clean($_POST["new_production"]);
	$date_commencement2=clean($_POST["date_commencement2"]);$capital_investment=clean($_POST["capital_investment"]);
	$date_commencement2=date("Y-m-d",strtotime($date_commencement2));
	$saction_date=clean($_POST["saction_date"]);
	$saction_date=date("Y-m-d",strtotime($saction_date));
	$act_date=clean($_POST["act_date"]);
	$act_date=date("Y-m-d",strtotime($act_date));
	$input_size=$_POST["hiddenval"];
	if(!empty($_POST["fixed_amount"]))$fixed_amount=json_encode($_POST["fixed_amount"]);
	else	$type=NULL;
	if(!empty($_POST["proposed"]))	 $proposed=json_encode($_POST["proposed"]);
	else	$proposed=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,if_any,new_units_dt,date_commencement2,capital_investment,fixed_amount,if_any1,nature,if_any2,if_any3,PI_indicate,saction_date,conn_load,act_date,new_production) values ('$swr_id','$today','$if_any','$new_units_dt','$date_commencement2','$capital_investment','$fixed_amount','$if_any1','$nature','$if_any2','$if_any3','$PI_indicate','$saction_date','$conn_load','$act_date','$new_production')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',if_any='$if_any',new_units_dt='$new_units_dt',date_commencement2='$date_commencement2',capital_investment='$capital_investment',fixed_amount='$fixed_amount',if_any1='$if_any1',nature='$nature',if_any2='$if_any2',if_any3='$if_any3',PI_indicate='$PI_indicate',saction_date='$saction_date',conn_load='$conn_load',act_date='$act_date',new_production='$new_production' where form_id=$form_id");
	}			
	if($query){
		if($input_size!=0){					
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
		for($i=1;$i<$input_size;$i++){
			//$vala=$_POST["txtA".$i];		
			$valb=$_POST["txtB".$i];
			$valc=$_POST["txtC".$i];
			$vald=$_POST["txtD".$i];
			$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,slno,name,quantity,production) VALUES ('','$form_id','$i','$valb','$valc','$vald')");
			}
		}
		echo "<script>
			alert('Successfully saved.');
			window.location.href = '".$table_name.".php?tab=3';
		</script>";
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=2';
		</script>";				
	}
}
if(isset($_POST["save13c"])){		
	$date_commencement1=clean($_POST["date_commencement1"]);
	$date_commencement1=date("Y-m-d",strtotime($date_commencement1));
	
	$fire_policy_no=clean($_POST["fire_policy_no"]);$basis_sum_insured=clean($_POST["basis_sum_insured"]);$boundary_wall=clean($_POST["boundary_wall"]);$buildings=clean($_POST["buildings"]);$plant_machinery=clean($_POST["plant_machinery"]);$misc_fixed_assets=clean($_POST["misc_fixed_assets"]);$net_pre_paid=clean($_POST["net_pre_paid"]);$amount_of_refund=clean($_POST["amount_of_refund"]);$is_cert_policy=clean($_POST["is_cert_policy"]);$reim_ins_premium=clean($_POST["reim_ins_premium"]);$work_capital_bnk_name=clean($_POST["work_capital_bnk_name"]);$work_capital_branch=clean($_POST["work_capital_branch"]);$cash_credit_acc_no=clean($_POST["cash_credit_acc_no"]);
	if(!empty($_POST["fixed_amount"]))	 $fixed_amount=json_encode($_POST["fixed_amount"]);
	else	$type=NULL;
	if(!empty($_POST["period_of_ins"])) $period_of_ins=json_encode($_POST["period_of_ins"]);else $period_of_ins=NULL;
	
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,date_commencement1,period_of_ins,fire_policy_no,basis_sum_insured,boundary_wall,buildings, plant_machinery,misc_fixed_assets,net_pre_paid,amount_of_refund,is_cert_policy,reim_ins_premium,work_capital_bnk_name,work_capital_branch,cash_credit_acc_no) values ('$swr_id','$today','$date_commencement1','$period_of_ins','$fire_policy_no','$basis_sum_insured','$boundary_wall','$buildings','$plant_machinery','$misc_fixed_assets','$net_pre_paid','$amount_of_refund','$is_cert_policy','$reim_ins_premium','$work_capital_bnk_name','$work_capital_branch','$cash_credit_acc_no')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',date_commencement1='$date_commencement1',period_of_ins='$period_of_ins',fire_policy_no='$fire_policy_no',basis_sum_insured='$basis_sum_insured',boundary_wall='$boundary_wall',buildings='$buildings',plant_machinery='$plant_machinery',misc_fixed_assets='$misc_fixed_assets',net_pre_paid='$net_pre_paid',amount_of_refund='$amount_of_refund',is_cert_policy='$is_cert_policy',reim_ins_premium='$reim_ins_premium',work_capital_bnk_name='$work_capital_bnk_name',work_capital_branch='$work_capital_branch',cash_credit_acc_no='$cash_credit_acc_no' where form_id=$form_id");
	}			
	if($query){
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";
	}else{
		echo "<script>
			alert('Invalid Entry');
			window.location.href = '".$table_name.".php?tab=3';
		</script>";
	}
}

if(isset($_POST["save14a"])){
	$claim_no=clean($_POST["claim_no"]);$period_of_claim_from=clean($_POST["period_of_claim_from"]);	
	$period_of_claim_to=clean($_POST["period_of_claim_to"]);
	$dor=clean($_POST["dor"]);
	if($period_of_claim_from!=""){
		$period_of_claim_from=date("Y-m-d",strtotime($period_of_claim_from));
	}else{
		$period_of_claim_from=NULL;
	}
	if($period_of_claim_to!=""){
		$period_of_claim_to=date("Y-m-d",strtotime($period_of_claim_to));
	}else{
		$period_of_claim_to=NULL;
	}
	if($dor!=""){
		$dor=date("Y-m-d",strtotime($dor));
	}else{
		$dor=NULL;
	}
	
	$reg_no=clean($_POST["reg_no"]);
	$reg_no1=clean($_POST["reg_no1"]);
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){ 
	////////////table is empty/////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,claim_no,period_of_claim_from,period_of_claim_to,reg_no,dor,reg_no1) values('$swr_id','$today','$claim_no','$period_of_claim_from','$period_of_claim_to','$reg_no','$dor','$reg_no1')");
	}else{
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET  sub_date='$today',claim_no='$claim_no',period_of_claim_from='$period_of_claim_from',period_of_claim_to='$period_of_claim_to',reg_no='$reg_no',dor='$dor',reg_no1='$reg_no1' WHERE form_id='$form_id'");	
	}
	
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
			echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$table_name.".php?tab=2';
		</script>";
	}else{
			echo "<script>
			alert('Invalid Entry');
			window.location.href = '".$table_name.".php?tab=1';
		</script>";
	}
}
if(isset($_POST["save14b"])){

	if(!empty($_POST["existing_expansional_date"])) $existing_expansional_date=json_encode($_POST["existing_expansional_date"]);
	else $existing_expansional_date=NULL;
	if(!empty($_POST["ack"])) $ack=json_encode($_POST["ack"]);
	else $ack=NULL;
	
    $cert=clean($_POST["cert"]);
    $man_product=clean($_POST["man_product"]);
	$service_product=clean($_POST["service_product"]);
	$man_dt=clean($_POST["man_dt"]);
	$service_dt=clean($_POST["service_dt"]);
	$hidden_value=clean($_POST["hidden_value"]);
	
	if($man_dt!=""){
		$man_dt=date("Y-m-d",strtotime($man_dt));
	}else{
		$man_dt=NULL;
	}
	if($service_dt!=""){
		$service_dt=date("Y-m-d",strtotime($service_dt));
	}else{
		$service_dt=NULL;
	}
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   
		echo "<script>
			alert('Please Fill up the first part of the form .');
			window.location.href = '".$table_name.".php';
		</script>";
	
	 }else{
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET sub_date='$today',ack='$ack',cert='$cert',man_product='$man_product',service_product='$service_product',man_dt='$man_dt',service_dt='$service_dt',existing_expansional_date='$existing_expansional_date' WHERE form_id='$form_id'");	
		
		$check_members_table=$formFunctions->executeQuery($dept,"select name from ".$table_name."_members where form_id='$form_id'");
		if($check_members_table->num_rows>0){
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$sn1=$_POST["sn1".$i.""];$sn2=$_POST["sn2".$i.""];$vill=$_POST["vill".$i.""];$dist=$_POST["dist".$i.""];$pin=$_POST["pin".$i.""];
				
				$query1=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_members set name='$name',sn1='$sn1',sn2='$sn2',vill='$vill',dist='$dist',pin='$pin' where form_id='$form_id' and sl_no='$i'");		
			}
		}else{
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$sn1=$_POST["sn1".$i.""];$sn2=$_POST["sn2".$i.""];$vill=$_POST["vill".$i.""];$dist=$_POST["dist".$i.""];$pin=$_POST["pin".$i.""];
				$query1=$formFunctions->executeQuery($dept,"insert into ".$table_name."_members(form_id,sl_no,name,sn1,sn2,vill,dist,pin) values ('$form_id','$i','$name','$sn1','$sn2','$vill','$dist','$pin')");		
			}
		}
		
		if($query==true && $query1==true){			
			echo "<script>
				alert('Successfully Saved..');
				window.location.href = '".$table_name.".php?tab=3';
			</script>";
		}else{
			echo "<script>
				alert('Invalid Entry');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
		}
	}
}
if(isset($_POST["save14c"])){
	$input_size1=clean($_POST["hiddenval"]);$input_size2=clean($_POST["hiddenval2"]);	
	if(!empty($_POST["capital_investment"]))	 $capital_investment=json_encode($_POST["capital_investment"]);
	else	$capital_investment=NULL;
	$service_product1=clean($_POST["service_product1"]);
	$turnover=clean($_POST["turnover"]);
	$turnover1=clean($_POST["turnover1"]);
	$turnover2=clean($_POST["turnover2"]);
	
	$work_capital_bnk_name=clean($_POST["work_capital_bnk_name"]);
	$work_capital_branch=clean($_POST["work_capital_branch"]);
	$work_capital_limit=clean($_POST["work_capital_limit"]);
	$cash_credit_acc_no=clean($_POST["cash_credit_acc_no"]);
	$sanction_number=clean($_POST["sanction_number"]);
	$sanction_dt2=clean($_POST["sanction_dt2"]);
	$sanction_dt2=date("Y-m-d",strtotime($sanction_dt2));
	
	$tot_interest_charged_bnk=clean($_POST["tot_interest_charged_bnk"]);
	$tot_interest_subsidy_elig=clean($_POST["tot_interest_subsidy_elig"]);
	$remarks=clean($_POST["remarks"]);
	$employment_generation=clean($_POST["employment_generation"]);
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////
		echo "<script>
			alert('Please Fill up the first part of the form .');
			window.location.href = '".$table_name.".php';
		</script>";
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',capital_investment='$capital_investment',service_product1='$service_product1',turnover='$turnover',turnover1='$turnover1',turnover2='$turnover2',work_capital_bnk_name='$work_capital_bnk_name',work_capital_branch='$work_capital_branch',work_capital_limit='$work_capital_limit',cash_credit_acc_no='$cash_credit_acc_no',sanction_number='$sanction_number',sanction_dt2='$sanction_dt2',tot_interest_charged_bnk='$tot_interest_charged_bnk',tot_interest_subsidy_elig='$tot_interest_subsidy_elig',remarks='$remarks',employment_generation='$employment_generation' WHERE form_id='$form_id'");	
	}			
	if($query){
		if($input_size1!=0){
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size1;$i++){
				//$vala=$_POST["txtA".$i];	
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,slno,name1,qty1,value1) VALUES ('','$form_id','$i','$valb','$valc','$vald')");
			}
		}
		if($input_size2!=0){					
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				//$vala=$_POST["textA".$i];	
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$vald=$_POST["textD".$i];
				$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(id,form_id,slno,name2,qty2,value2) VALUES ('','$form_id','$i','$valb','$valc','$vald')");
			}
		}
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=3';
		</script>";
	}	
}

if(isset($_POST["save15a"])){
	/* echo $table_name;
	echo "<pre>";print_r($_POST);
	die(); */	
	$hidden_value=clean($_POST["hidden_value"]);
	$branch_address=clean($_POST["branch_address"]);$enterprise_pan=clean($_POST["enterprise_pan"]);$em_no=clean($_POST["em_no"]);$em_dt=clean($_POST["em_dt"]);$items=clean($_POST["items"]);$service=clean($_POST["service"]);$capacity=clean($_POST["capacity"]);$vat_no=clean($_POST["vat_no"]);$vat_dt=clean($_POST["vat_dt"]);$excise_no=clean($_POST["excise_no"]);$excise_dt=clean($_POST["excise_dt"]);$service_no=clean($_POST["service_no"]);$service_dt=clean($_POST["service_dt"]);$entry_no=clean($_POST["entry_no"]);$entry_dt=clean($_POST["entry_dt"]);
	
	if(!empty($_POST["office"]))	 $office=json_encode($_POST["office"]);
	else	$office=NULL;
	if(!empty($_POST["capital"]))	 $capital=json_encode($_POST["capital"]);
	else	$capital=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,branch_address,enterprise_pan,em_no,em_dt,items,service,capacity,vat_no,vat_dt,excise_no,excise_dt,service_no,service_dt,entry_no,entry_dt,office,capital) values ('$swr_id','$today','$branch_address','$enterprise_pan','$em_no','$em_dt', '$items','$service','$capacity','$vat_no','$vat_dt','$excise_no','$excise_dt','$service_no', '$service_dt','$entry_no','$entry_dt','$office','$capital')");
		$form_id=$query;
	
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_members where form_id='$form_id'");
		for($i=1;$i<=$hidden_value;$i++){
			$name=$_POST["name".$i.""];$sn=$_POST["sn".$i.""];$vill=$_POST["vill".$i.""];$dist=$_POST["dist".$i.""];$pin=$_POST["pin".$i.""];$mobile=$_POST["mobile".$i.""];$pan=$_POST["pan".$i.""];
			
			$query1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_members(id,form_id,slno,name,sn,vill,dist,pin,mobile,pan) VALUES ('','$form_id','$i','$name','$sn','$vill','$dist','$pin','$mobile','$pan')");
			
		}	
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',branch_address='$branch_address',enterprise_pan='$enterprise_pan',em_no='$em_no',em_dt='$em_dt',items='$items',service='$service',capacity='$capacity',vat_no='$vat_no',vat_dt='$vat_dt',excise_no='$excise_no',excise_dt='$excise_dt',service_no='$service_no',service_dt='$service_dt',entry_no='$entry_no',entry_dt='$entry_dt',office='$office',capital='$capital' where form_id=$form_id");
		
		for($i=1;$i<=$hidden_value;$i++){
			$name=$_POST["name".$i.""];$sn=$_POST["sn".$i.""];$vill=$_POST["vill".$i.""];$dist=$_POST["dist".$i.""];$pin=$_POST["pin".$i.""];$mobile=$_POST["mobile".$i.""];$pan=$_POST["pan".$i.""];		
			
			$query1=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_members set name='$name',sn='$sn',vill='$vill',dist='$dist',pin='$pin',mobile='$mobile',pan='$pan' where form_id='$form_id' and slno='$i'");
		}
	}				
	if($query){		
		$formFunctions->insert_incomplete_forms($dept,$form); 
		echo "<script>
			alert('Successfully saved.');
			window.location.href = '".$table_name.".php?tab=2';
		</script>";			
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=1';
		</script>";
	}			
}
if(isset($_POST["save15b"])){
	$input_size=clean($_POST["hiddenval"]);$input_size2=clean($_POST["hiddenval2"]);
 	$no_of_workers=clean($_POST["no_of_workers"]);$local_percent=clean($_POST["local_percent"]);$reg_no=clean($_POST["reg_no"]);$reg_dt=clean($_POST["reg_dt"]);$applicant_name=clean($_POST["applicant_name"]);
	
	if(!empty($_POST["fees"]))	$fees=json_encode($_POST["fees"]);
	else	$fees=NULL;	
	
	$query=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$query->fetch_array();			
	if($query->num_rows<1){   ////////////table is empty////////////// 				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,no_of_workers,local_percent,reg_no,reg_dt,applicant_name,fees)values('$swr_id','$no_of_workers','$local_percent','$reg_no', '$reg_dt','$applicant_name','$fees')");
		$form_id=$query;	
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set no_of_workers='$no_of_workers',local_percent='$local_percent',reg_no='$reg_no',reg_dt='$reg_dt',applicant_name='$applicant_name',fees='$fees' where form_id=$form_id");		
	}				
	if($query){
		if($input_size!=0){
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");		
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];	
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,slno,name,capacity,prod,remarks) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')");				
			}
		}
		if($input_size2!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				//$vala=$_POST["textA".$i];	
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$vald=$_POST["textD".$i];
				$vale=$_POST["textE".$i];
				$valf=$_POST["textF".$i];
				$valg=$_POST["textG".$i];
				$valh=$_POST["textH".$i];
				$vali=$_POST["textI".$i];
				$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(id,form_id,slno,name,purchase,no,date,qty,rate,value,payment) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg','$valh','$vali')");
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

?>