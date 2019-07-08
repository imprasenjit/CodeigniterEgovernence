<?php 
if(isset($_POST["save21"])){
	$input_size1=clean($_POST["hiddenval"]);
	$lic_no=clean($_POST["lic_no"]);$year=clean($_POST["year"]);$tonns=clean($_POST["tonns"]);$mineral=clean($_POST["mineral"]);$quantity=clean($_POST["quantity"]);$mineral_name=clean($_POST["mineral_name"]);$date=clean($_POST["date"]);
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,lic_no,year,tonns,mineral,quantity,mineral_name,date) values ('$swr_id','$today','$lic_no','$year','$tonns','$mineral', '$quantity','$mineral_name','$date')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',lic_no='$lic_no',year='$year',tonns='$tonns',mineral='$mineral',quantity='$quantity',mineral_name='$mineral_name',date='$date' where form_id=$form_id");		
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
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,slno,amount,challan,date) VALUES ('','$form_id','$i','$valb','$valc','$vald')");				
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
	$father_name=clean($_POST["father_name"]);$partner_name=clean($_POST["partner_name"]);$partner_add=clean($_POST["partner_add"]);$place_of_business=clean($_POST["place_of_business"]);$financial_status=clean($_POST["financial_status"]);$purpose=clean($_POST["purpose"]);$mineral_name=clean($_POST["mineral_name"]);$procured_name=clean($_POST["procured_name"]);$procured_add=clean($_POST["procured_add"]);
	
	if(!empty($_POST["period"]))	 $period=json_encode($_POST["period"]);
	else	$period=NULL;
	
	$query=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$query->fetch_array();
	if($query->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,father_name,partner_name,partner_add,place_of_business,financial_status,purpose,mineral_name,procured_name,procured_add,period) values ('$swr_id','$today','$father_name','$partner_name','$partner_add','$place_of_business', '$financial_status', '$purpose','$mineral_name','$procured_name','$procured_add','$period')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',father_name='$father_name',partner_name='$partner_name',partner_add='$partner_add',place_of_business='$place_of_business',financial_status='$financial_status',purpose='$purpose',mineral_name='$mineral_name',procured_name='$procured_name',procured_add='$procured_add',period='$period' where form_id=$form_id");		
	}	
	
	if($query){
		echo "<script>
			alert('Successfully Saved.');
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
	$father_name=clean($_POST["father_name"]);$partner_name=clean($_POST["partner_name"]);$partner_add=clean($_POST["partner_add"]);$place_of_business=clean($_POST["place_of_business"]);$financial_status=clean($_POST["financial_status"]);$purpose=clean($_POST["purpose"]);$mineral_name=clean($_POST["mineral_name"]);$procured_name=clean($_POST["procured_name"]);$procured_add=clean($_POST["procured_add"]);$reg_no=clean($_POST["reg_no"]);$reg_date=clean($_POST["reg_date"]);
	
	if(!empty($_POST["period"]))	 $period=json_encode($_POST["period"]);
	else	$period=NULL;
	
	$query=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$query->fetch_array();
	if($query->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,father_name,partner_name,partner_add,place_of_business,financial_status,purpose,mineral_name,procured_name,procured_add,period,reg_no,reg_date) values ('$swr_id','$today','$father_name','$partner_name','$partner_add','$place_of_business', '$financial_status', '$purpose','$mineral_name','$procured_name','$procured_add','$period','$reg_no','$reg_date')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',father_name='$father_name',partner_name='$partner_name',partner_add='$partner_add',place_of_business='$place_of_business',financial_status='$financial_status',purpose='$purpose',mineral_name='$mineral_name',procured_name='$procured_name',procured_add='$procured_add',period='$period',reg_no='$reg_no',reg_date='$reg_date' where form_id=$form_id");		
	}	
	
	if($query){
		echo "<script>
			alert('Successfully Saved.');
		    window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php';
		</script>";
	}
}

if(isset($_POST["save24"])){
	$input_size1=clean($_POST["hiddenval"]);
	$regn_no=clean($_POST["regn_no"]);$date_of_regn=clean($_POST["date_of_regn"]);$name_of_minerals=clean($_POST["name_of_minerals"]);$name_of_plant=clean($_POST["name_of_plant"]);	
	
	if(!empty($_POST["period"]))	 $period=json_encode($_POST["period"]);
	else	$period=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,regn_no,date_of_regn,period,name_of_minerals,name_of_plant) values ('$swr_id','$today','$regn_no','$date_of_regn','$period','$name_of_minerals','$name_of_plant')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',regn_no='$regn_no',date_of_regn='$date_of_regn',period='$period',name_of_minerals='$name_of_minerals',name_of_plant='$name_of_plant' where form_id=$form_id");		
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
				$valf=$_POST["txtF".$i];
				$valg=$_POST["txtG".$i];
				$valh=$_POST["txtH".$i];
				$vali=$_POST["txtI".$i];
	
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,slno,name,date,balance,mineral,ore,quantity,closing,remarks) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg','$valh','$vali')");	
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
 
if(isset($_POST["save25"])){
	$input_size1=clean($_POST["hiddenval"]);
	$regn_no=clean($_POST["regn_no"]);$license_date=clean($_POST["license_date"]);$name_of_mineral=clean($_POST["name_of_mineral"]);$place_of_transport=clean($_POST["place_of_transport"]);$amount=clean($_POST["amount"]);	
	
	if(!empty($_POST["period"]))	 $period=json_encode($_POST["period"]);
	else	$period=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,regn_no,license_date,period,name_of_mineral,place_of_transport,amount) values ('$swr_id','$today','$regn_no','$license_date','$period','$name_of_mineral','$place_of_transport','$amount')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',regn_no='$regn_no',license_date='$license_date',period='$period',name_of_mineral='$name_of_mineral',place_of_transport='$place_of_transport',amount='$amount' where form_id=$form_id");		
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
				$valf=$_POST["txtF".$i];
				$valg=$_POST["txtG".$i];
				$valh=$_POST["txtH".$i];
				$vali=$_POST["txtI".$i];
	
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,slno,month,date,opening,quantity,transit,destination,closing,remarks) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg','$valh','$vali')");	
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

if(isset($_POST["save26"])){
	$input_size1=clean($_POST["hiddenval"]);
	
	if(!empty($_POST["period"]))	 $period=json_encode($_POST["period"]);
	else	$period=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,period) values ('$swr_id','$today','$period')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',period='$period' where form_id=$form_id");		
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
				$valf=$_POST["txtF".$i];
				$valg=$_POST["txtG".$i];
				$valh=$_POST["txtH".$i];
				$vali=$_POST["txtI".$i];
				$valj=$_POST["txtJ".$i];
	
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,slno,opening,qty_received,challan_no,challan_date,qty_sold,details,closing_no,closing_date,remarks) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg','$valh','$vali','$valj')");	
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