<?php
if(isset($_POST["save1"])){		
	$nature=clean($_POST["nature"]);$monogram=clean($_POST["monogram"]);$tools=clean($_POST["tools"]);$workshop=clean($_POST["workshop"]);$facilities=clean($_POST["facilities"]);$elect_energy=clean($_POST["elect_energy"]);$is_loan_detail=clean($_POST["is_loan_detail"]);$bankers=clean($_POST["bankers"]);$reg_number=clean($_POST["reg_number"]);$is_applied=clean($_POST["is_applied"]);$is_proposed=clean($_POST["is_proposed"]);$approval=clean($_POST["approval"]);$inspection=clean($_POST["inspection"]);$hidden_value=clean($_POST["hidden_value"]);$total_turnover=clean($_POST["total_turnover"]);

	if(!empty($_POST["fact"]))	 $fact=json_encode($_POST["fact"]);
	else	$fact=NULL;
	if(!empty($_POST["type"]))	 $type=json_encode($_POST["type"]);
	else	$type=NULL;
	if(!empty($_POST["persons"]))	 $persons=json_encode($_POST["persons"]);
	else	$persons=NULL;
	if($is_applied=="Y"){
		$is_applied_details=clean($_POST["is_applied_details"]);
	}else{
		$is_applied_details="";
	}

	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,nature,fact,monogram,tools,workshop,facilities,elect_energy,is_loan_detail,bankers,reg_number,total_turnover,is_applied,is_applied_details,is_proposed,approval,inspection,type,persons) values ('$swr_id','$today', '$nature', '$fact', '$monogram','$tools', '$workshop', '$facilities', '$elect_energy','$is_loan_detail','$bankers','$reg_number','$total_turnover','$is_applied','$is_applied_details','$is_proposed','$approval','$inspection','$type','$persons')");
		$form_id=$query;
		for($i=1;$i<=$hidden_value;$i++){
			$name=$_POST["name".$i.""];$family_name=$_POST["family_name".$i.""];$address=$_POST["address".$i.""];$pincode=$_POST["pincode".$i.""];$contact=$_POST["contact".$i.""];
			$query1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_members(id,form_id,sl_no,name,family_name,address,pincode,contact) VALUES ('','$form_id','$i','$name','$family_name','$address','$pincode','$contact')");
			
		}
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', nature='$nature', fact='$fact', monogram='$monogram',tools='$tools',workshop='$workshop',facilities='$facilities',elect_energy='$elect_energy', is_loan_detail='$is_loan_detail',bankers='$bankers',reg_number='$reg_number',total_turnover='$total_turnover',is_applied='$is_applied', is_applied_details='$is_applied_details', is_proposed='$is_proposed',approval='$approval', inspection='$inspection' , type='$type',persons='$persons' where form_id=$form_id");
		for($i=1;$i<=$hidden_value;$i++){
			$name=$_POST["name".$i.""];$family_name=$_POST["family_name".$i.""];$address=$_POST["address".$i.""];$pincode=$_POST["pincode".$i.""];$contact=$_POST["contact".$i.""];
		
			$query1=$formFunctions->executeQuery($dept,"update ".$table_name."_members set name='$name',family_name='$family_name',address='$address',pincode='$pincode',contact='$contact' where form_id='$form_id' and sl_no='$i'");
		}
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
			echo "<script>
				alert('Successfully saved.');
				window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
			</script>";			
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php';
			</script>";
	}			
}

if(isset($_POST["save2"])){		
	$is_lease_doc=clean($_POST["is_lease_doc"]);$area=clean($_POST["area"]);$previous=clean($_POST["previous"]);$machinery=clean($_POST["machinery"]);$elect_energy=clean($_POST["elect_energy"]);$sufficient=clean($_POST["sufficient"]);$reg_number=clean($_POST["reg_number"]);$is_applied=clean($_POST["is_applied"]);$hidden_value=clean($_POST["hidden_value"]);$total_turnover=clean($_POST["total_turnover"]);
	
	if(!empty($_POST["weights_measure"]))	 $weights_measure=json_encode($_POST["weights_measure"]);
	else	$weights_measure=NULL;
	if(!empty($_POST["fact"]))	 $fact=json_encode($_POST["fact"]);
	else	$fact=NULL;
	if(!empty($_POST["persons"]))	 $persons=json_encode($_POST["persons"]);
	else	$persons=NULL;
	if($is_applied=="Y"){
		$is_applied_details=clean($_POST["is_applied_details"]);
	}else{
		$is_applied_details="";
	}
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,is_lease_doc,fact,area,previous,machinery,elect_energy,sufficient,reg_number,total_turnover,is_applied,is_applied_details,weights_measure,persons) values ('$swr_id','$today', '$is_lease_doc', '$fact', '$area','$previous', '$machinery','$elect_energy','$sufficient','$reg_number','$total_turnover','$is_applied','$is_applied_details','$weights_measure','$persons')");
			$form_id=$query;
			for($i=1;$i<=$hidden_value;$i++){ 
				$name=$_POST["name".$i.""];$family_name=$_POST["family_name".$i.""];$address=$_POST["address".$i.""];$pincode=$_POST["pincode".$i.""];$contact=$_POST["contact".$i.""];
				$query1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_members(id,form_id,sl_no,name,family_name,address,pincode,contact) VALUES ('','$form_id','$i','$name','$family_name','$address','$pincode','$contact')");
				
			}
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', is_lease_doc='$is_lease_doc', fact='$fact', area='$area',previous='$previous', machinery='$machinery', elect_energy='$elect_energy', sufficient='$sufficient', reg_number='$reg_number',total_turnover='$total_turnover',is_applied='$is_applied', is_applied_details='$is_applied_details', weights_measure='$weights_measure', persons='$persons' where form_id=$form_id");
		for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$family_name=$_POST["family_name".$i.""];$address=$_POST["address".$i.""];$pincode=$_POST["pincode".$i.""];$contact=$_POST["contact".$i.""];
			
				$query1=$formFunctions->executeQuery($dept,"update ".$table_name."_members set name='$name',family_name='$family_name',address='$address',pincode='$pincode',contact='$contact' where form_id='$form_id' and sl_no='$i'");
		}
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
			echo "<script>
				alert('Successfully saved.');
				window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
			</script>";
			
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php';
			</script>";
	}			
}
if(isset($_POST["save3"])){		
	$weights_measure=clean($_POST["weights_measure"]);$reg_number=clean($_POST["reg_number"]);$is_intend=clean($_POST["is_intend"]);$is_applied=clean($_POST["is_applied"]);
	$hidden_value=clean($_POST["hidden_value"]);
	if(!empty($_POST["fact"]))	 $fact=json_encode($_POST["fact"]);
	else	$fact=NULL;
	if($is_applied=="Y"){
		$is_applied_details=clean($_POST["is_applied_details"]);
	}else{
		$is_applied_details="";
	}
	if($is_intend=="Y"){
		$source_supply=clean($_POST["source_supply"]);$monogram=clean($_POST["monogram"]);$lic_num=clean($_POST["lic_num"]);$regis_impoter=clean($_POST["regis_impoter"]);$model_impoter=clean($_POST["model_impoter"]);
	}else{
		$source_supply="";$monogram="";$lic_num="";$regis_impoter="Nill";$model_impoter="Nill";
	}
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,fact,weights_measure,reg_number,is_intend,source_supply,monogram,lic_num,regis_impoter,model_impoter,is_applied,is_applied_details) values ('$swr_id','$today', '$fact', '$weights_measure','$reg_number','$is_intend', '$source_supply','$monogram','$lic_num','$regis_impoter','$model_impoter','$is_applied','$is_applied_details')");
			$form_id=$query;
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$family_name=$_POST["family_name".$i.""];$address=$_POST["address".$i.""];$pincode=$_POST["pincode".$i.""];$contact=$_POST["contact".$i.""];
				$query1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_members(id,form_id,sl_no,name,family_name,address,pincode,contact) VALUES ('','$form_id','$i','$name','$family_name','$address','$pincode','$contact')");
				
			}
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', fact='$fact',weights_measure='$weights_measure',reg_number='$reg_number',is_intend='$is_intend', source_supply='$source_supply', monogram='$monogram', lic_num='$lic_num', regis_impoter='$regis_impoter',model_impoter='$model_impoter',  is_applied='$is_applied', is_applied_details='$is_applied_details' where form_id=$form_id");
		for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$family_name=$_POST["family_name".$i.""];$address=$_POST["address".$i.""];$pincode=$_POST["pincode".$i.""];$contact=$_POST["contact".$i.""];
			
				$query1=$formFunctions->executeQuery($dept,"update ".$table_name."_members set name='$name',family_name='$family_name',address='$address',pincode='$pincode',contact='$contact' where form_id='$form_id' and sl_no='$i'");
		}
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); //clm-- dept name and 3 -- form no
			echo "<script>
				alert('Successfully saved.');
				window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
			</script>";
			
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php';
			</script>";
	}			
}

if(isset($_POST["save4"])){		
	$license_no=clean($_POST["license_no"]);$type_changes=clean($_POST["type_changes"]);$weight_trademark=clean($_POST["weight_trademark"]);$workshop_details=clean($_POST["workshop_details"]);$production_details=clean($_POST["production_details"]);$shop_reg_no=clean($_POST["shop_reg_no"]);$total_turnover=clean($_POST["total_turnover"]);
	if(!empty($_POST["type"]))	 $type=json_encode($_POST["type"]);
	else	$type=NULL;
	$shop_reg_date=clean($_POST["shop_reg_date"]);
	if($shop_reg_date!=""){
		$shop_reg_date=date("Y-m-d",strtotime($shop_reg_date));
	}else{
		$shop_reg_date=NULL;
	}	
	$tax_reg_no=clean($_POST["tax_reg_no"]);$state=clean($_POST["state"]);
		
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	$input_size=clean($_POST["hidden_value"]);
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,license_no,type,type_changes,weight_trademark,workshop_details,production_details,shop_reg_no,shop_reg_date,tax_reg_no,total_turnover,state) values ('$swr_id','$today', '$license_no', '$type', '$type_changes','$weight_trademark', '$workshop_details', '$production_details', '$shop_reg_no','$shop_reg_date','$tax_reg_no','$total_turnover','$state')");
			$form_id=$query;
			for($i=1;$i<=$input_size;$i++){
				$name=$_POST["name".$i.""];$family_name=$_POST["family_name".$i.""];$address=$_POST["address".$i.""];$pincode=$_POST["pincode".$i.""];$contact=$_POST["contact".$i.""];
				$query1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_members(id,form_id,sl_no,name,family_name,address,pincode,contact) VALUES ('','$form_id','$i','$name','$family_name','$address','$pincode','$contact')");
				
			}
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', license_no='$license_no', type='$type', type_changes='$type_changes',weight_trademark='$weight_trademark', workshop_details='$workshop_details', production_details='$production_details', shop_reg_no='$shop_reg_no', shop_reg_date='$shop_reg_date', tax_reg_no='$tax_reg_no',  total_turnover='$total_turnover',state='$state' where form_id=$form_id");
		for($i=1;$i<=$input_size;$i++){
				$name=$_POST["name".$i.""];$family_name=$_POST["family_name".$i.""];$address=$_POST["address".$i.""];$pincode=$_POST["pincode".$i.""];$contact=$_POST["contact".$i.""];
			
				$query1=$formFunctions->executeQuery($dept,"update ".$table_name."_members set name='$name',family_name='$family_name',address='$address',pincode='$pincode',contact='$contact' where form_id='$form_id' and sl_no='$i'");
		}
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); //clm-- dept name and 4 -- form no
			echo "<script>
				alert('Successfully saved.');
				window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
			</script>";
			
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php';
			</script>";
	}			
}

if(isset($_POST["save5"])){		
	$repairer_lic=clean($_POST["repairer_lic"]);$tl_reg_no=clean($_POST["tl_reg_no"]);
	$tl_date=clean($_POST["tl_date"]);$total_turnover=clean($_POST["total_turnover"]);
		
	if($tl_date!=""){
		$tl_date=date("Y-m-d",strtotime($tl_date));
	}else{
		$tl_date=NULL;
	}
	$it_reg_no=clean($_POST["it_reg_no"]);$any_change=clean($_POST["any_change"]);$op_area=clean($_POST["op_area"]);$hav_u=clean($_POST["hav_u"]);$stamp_details=clean($_POST["stamp_details"]);$state=clean($_POST["state"]);
	
	if(!empty($_POST["type_wm"]))	 $type_wm=json_encode($_POST["type_wm"]);
	else	$type_wm=NULL;
	$hidden_value=clean($_POST["hidden_value"]);
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,repairer_lic,tl_reg_no,tl_date,it_reg_no,total_turnover,type_wm,any_change,op_area,hav_u,stamp_details,state) values ('$swr_id','$today', '$repairer_lic', '$tl_reg_no', '$tl_date','$it_reg_no','$total_turnover','$type_wm', '$any_change', '$op_area','$hav_u','$stamp_details','$state')");
			$form_id=$query;
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$family_name=$_POST["family_name".$i.""];$address=$_POST["address".$i.""];$pincode=$_POST["pincode".$i.""];$contact=$_POST["contact".$i.""];
				$query1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_members(id,form_id,sl_no,name,family_name,address,pincode,contact) VALUES ('','$form_id','$i','$name','$family_name','$address','$pincode','$contact')");
				
			}
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', repairer_lic='$repairer_lic', tl_reg_no='$tl_reg_no', tl_date='$tl_date', it_reg_no='$it_reg_no',total_turnover='$total_turnover',type_wm='$type_wm', any_change='$any_change', op_area='$op_area',hav_u='$hav_u',stamp_details='$stamp_details',state='$state' where form_id=$form_id");
		for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$family_name=$_POST["family_name".$i.""];$address=$_POST["address".$i.""];$pincode=$_POST["pincode".$i.""];$contact=$_POST["contact".$i.""];
			
				$query1=$formFunctions->executeQuery($dept,"update ".$table_name."_members set name='$name',family_name='$family_name',address='$address',pincode='$pincode',contact='$contact' where form_id='$form_id' and sl_no='$i'");
		}
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); //clm-- dept name and 5 -- form no
			echo "<script>
				alert('Successfully saved.');
				window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
			</script>";
			
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php';
			</script>";
	}			
}

if(isset($_POST["save6"])){ 	
	$license_no=clean($_POST["license_no"]);$total_turnover=clean($_POST["total_turnover"]);
	$date=clean($_POST["date"]);
	if($date!=""){
		$date=date("Y-m-d",strtotime($date));
	}else{
		$date=NULL;
	}
	$reg_no=clean($_POST["reg_no"]);
	$reg_date=clean($_POST["reg_date"]);
	if($reg_date!=""){
		$reg_date=date("Y-m-d",strtotime($reg_date));
	}else{
		$reg_date=NULL;
	}
	$tax_reg=clean($_POST["tax_reg"]);$manu_details=clean($_POST["manu_details"]);
	$state=clean($_POST["state"]);
	if(!empty($_POST["categories"])){
		$categories=json_encode($_POST["categories"]);
	}else{
		$categories=NULL;
	}
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	$input_size=clean($_POST["hidden_value"]);
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,license_no,date,reg_no,reg_date,categories,tax_reg,total_turnover,manu_details,state) values ('$swr_id','$today', '$license_no', '$date', '$reg_no','$reg_date', '$categories', '$tax_reg','$total_turnover','$manu_details','$state')");
			$form_id=$query;
			for($i=1;$i<=$input_size;$i++){
				$name=$_POST["name".$i.""];$family_name=$_POST["family_name".$i.""];$address=$_POST["address".$i.""];$pincode=$_POST["pincode".$i.""];$contact=$_POST["contact".$i.""];
				$query1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_members(id,form_id,sl_no,name,family_name,address,pincode,contact) VALUES ('','$form_id','$i','$name','$family_name','$address','$pincode','$contact')");
				
			}
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', license_no='$license_no',date='$date',reg_no='$reg_no',reg_date='$reg_date', categories='$categories',tax_reg='$tax_reg',total_turnover='$total_turnover',manu_details='$manu_details',state='$state' where form_id=$form_id");
		for($i=1;$i<=$input_size;$i++){
				$name=$_POST["name".$i.""];$family_name=$_POST["family_name".$i.""];$address=$_POST["address".$i.""];$pincode=$_POST["pincode".$i.""];$contact=$_POST["contact".$i.""];
			
				$query1=$formFunctions->executeQuery($dept,"update ".$table_name."_members set name='$name',family_name='$family_name',address='$address',pincode='$pincode',contact='$contact' where form_id='$form_id' and sl_no='$i'");
		}
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); //clm-- dept name and 6 -- form no
			echo "<script>
				alert('Successfully saved.');
				window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
			</script>";
			
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php';
			</script>";
	}			
}

if(isset($_POST["save7"])){		
	$brnch_nm=clean($_POST["brnch_nm"]);$commodities=clean($_POST["commodities"]);$cst_no=clean($_POST["cst_no"]);
	$hidden_value=clean($_POST["hidden_value"]);
	
	if(!empty($_POST["fac"]))	 $fac=json_encode($_POST["fac"]);
	else	$fac=NULL;
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,fac,brnch_nm,commodities,cst_no) values ('$swr_id','$today', '$fac', '$brnch_nm', '$commodities', '$cst_no')");
			$form_id=$query;
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$family_name=$_POST["family_name".$i.""];$address=$_POST["address".$i.""];$pincode=$_POST["pincode".$i.""];$contact=$_POST["contact".$i.""];
				$query1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_members(id,form_id,sl_no,name,family_name,address,pincode,contact) VALUES ('','$form_id','$i','$name','$family_name','$address','$pincode','$contact')");
				
			}
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', fac='$fac',brnch_nm='$brnch_nm',commodities='$commodities',cst_no='$cst_no' where form_id=$form_id");
		for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$family_name=$_POST["family_name".$i.""];$address=$_POST["address".$i.""];$pincode=$_POST["pincode".$i.""];$contact=$_POST["contact".$i.""];
			
				$query1=$formFunctions->executeQuery($dept,"update ".$table_name."_members set name='$name',family_name='$family_name',address='$address',pincode='$pincode',contact='$contact' where form_id='$form_id' and sl_no='$i'");
		}
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); //clm-- dept name and 7 -- form no
			echo "<script>
				alert('Successfully saved.');
				window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
			</script>";
			
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php';
			</script>";
	}			
}

if(isset($_POST["save8"])){		
	$details_f_pack=clean($_POST["details_f_pack"]);$imp_country=clean($_POST["imp_country"]);$hidden_value=clean($_POST["hidden_value"]);
	
	if(!empty($_POST["warehouse_addr"])) $warehouse_addr=json_encode($_POST["warehouse_addr"]);
	else $warehouse_addr=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,warehouse_addr,details_f_pack,imp_country) values ('$swr_id','$today', '$warehouse_addr', '$details_f_pack', '$imp_country')");
			$form_id=$query;
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$family_name=$_POST["family_name".$i.""];$address=$_POST["address".$i.""];$mem_pincode=$_POST["mem_pincode".$i.""];$contact=$_POST["contact".$i.""];
				$query1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_members(id,form_id,sl_no,name,family_name,address,mem_pincode,contact) VALUES ('','$form_id','$i','$name','$family_name','$address','$mem_pincode','$contact')");
				
			}
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', warehouse_addr='$warehouse_addr', details_f_pack='$details_f_pack', imp_country='$imp_country' where form_id=$form_id");
		for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$family_name=$_POST["family_name".$i.""];$address=$_POST["address".$i.""];$mem_pincode=$_POST["mem_pincode".$i.""];$contact=$_POST["contact".$i.""];
			
				$query1=$formFunctions->executeQuery($dept,"update ".$table_name."_members set name='$name',family_name='$family_name',address='$address',mem_pincode='$mem_pincode',contact='$contact' where form_id='$form_id' and sl_no='$i'");
		}
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); //clm-- dept name and 8 -- form no
			echo "<script>
				alert('Successfully saved.');
				window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
			</script>";
			
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php';
			</script>";
	}			
}

if(isset($_POST["save9"])){	
	$meeting_date=clean($_POST["meeting_date"]);$meeting_place=clean($_POST["meeting_place"]);

	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,meeting_date,meeting_place) values ('$swr_id','$today','$meeting_date','$meeting_place')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', meeting_date='$meeting_date', meeting_place='$meeting_place' where form_id=$form_id");
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form);  //clm-- dept name and 9 -- form no
			echo "<script>
				alert('Successfully saved.');
				window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
			</script>";
			
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php';
			</script>";
	}			
}

if(isset($_POST["save10"])){	
	$form_against=clean($_POST["form_against"]);$order_num=clean($_POST["order_num"]);
	$order_date=clean($_POST["order_date"]);
	if($order_date!=""){
		$order_date=date("Y-m-d",strtotime($order_date));
	}else{
		$order_date=NULL;
	}
	$auth_representative=clean($_POST["auth_representative"]);$ground_appeal=($_POST["ground_appeal"]);

	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,form_against,order_num,order_date,auth_representative,ground_appeal) values ('$swr_id','$today','$form_against','$order_num','$order_date','$auth_representative','$ground_appeal')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', form_against='$form_against', order_num='$order_num', order_date='$order_date',auth_representative='$auth_representative',ground_appeal='$ground_appeal' where form_id=$form_id");
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); //clm-- dept name and 10 -- form no
			echo "<script>
					alert('Successfully saved.');
					window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
				</script>";
			
	}else{
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = '".$table_name.".php';
				</script>";
	}			
}

if(isset($_POST["save11"])){		
	$input_size1=clean($_POST["hiddenval"]);$input_size2=clean($_POST["hiddenval2"]);
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date) values ('$swr_id','$today')");
			$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today' where form_id=$form_id");
	}				
	if($query){
			$formFunctions->insert_incomplete_forms($dept,$form); //clm-- dept name and 11 -- form no
				if($input_size1!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
				for($i=1;$i<$input_size1;$i++){
					//$vala=$_POST["txtA".$i];	
					$valb=$_POST["txtB".$i];
					$valc=$_POST["txtC".$i];
					$vald=$_POST["txtD".$i];
					$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,sl_no,make,model_no,sl_f_du) VALUES ('$form_id','$i','$valb','$valc','$vald')");
				}
			}
			if($input_size2!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
				for($i=1;$i<$input_size2;$i++){
					//$vala=$_POST["textA".$i];	
					$valb=$_POST["textB".$i];
					$valc=$_POST["textC".$i];
					$vald=$_POST["textD".$i];	
					$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(form_id,sl_no,make,model_no,sl_f_du) VALUES ('$form_id','$i','$valb','$valc','$vald')");
				}
			}
			if(isset($part1) && $part1==false){
					echo "<script>
					alert('Something went wrong !!!');
					window.location.href = '".$table_name.".php';
					</script>";
			}else if(isset($part2) && $part2==false){
					echo "<script>
					alert('Something went wrong !!!');
					window.location.href = '".$table_name.".php';
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
				window.location.href = '".$table_name.".php';
			   </script>";
		   }	
}
if(isset($_POST["save12"])){		
	$make=clean($_POST["make"]);$model=clean($_POST["model"]);$accuracy=clean($_POST["accuracy"]);$machine=clean($_POST["machine"]);$platform=clean($_POST["platform"]);$max_capacity=clean($_POST["max_capacity"]);$min_capacity=clean($_POST["min_capacity"]);$e_value=clean($_POST["e_value"]);
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,make,model,accuracy,machine,platform,max_capacity,min_capacity,e_value) values ('$swr_id','$today','$make','$model','$accuracy','$machine','$platform','$max_capacity','$min_capacity','$e_value')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',make='$make',model='$model',accuracy='$accuracy',machine='$machine',platform='$platform',max_capacity='$max_capacity',min_capacity='$min_capacity',e_value='$e_value' where form_id=$form_id");
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); //clm-- dept name and 12 -- form no
			echo "<script>
				alert('Successfully saved.');
				window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
			</script>";
			
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php';
			</script>";
	}			
}

if(isset($_POST["save13"])){		
	$make=clean($_POST["make"]);$model=clean($_POST["model"]);$accuracy=clean($_POST["accuracy"]);$machine=clean($_POST["machine"]);$platform=clean($_POST["platform"]);$max_capacity=clean($_POST["max_capacity"]);$min_capacity=clean($_POST["min_capacity"]);$e_value=clean($_POST["e_value"]);
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,make,model,accuracy,machine,platform,max_capacity,min_capacity,e_value) values ('$swr_id','$today','$make','$model','$accuracy','$machine','$platform','$max_capacity','$min_capacity','$e_value')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',make='$make',model='$model',accuracy='$accuracy',machine='$machine',platform='$platform',max_capacity='$max_capacity',min_capacity='$min_capacity',e_value='$e_value' where form_id=$form_id");
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); //clm-- dept name and 13 -- form no
			echo "<script>
				alert('Successfully saved.');
				window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
			</script>";
			
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php';
			</script>";
	}			
}

if(isset($_POST["save14"])){		
	$input_size1=clean($_POST["hiddenval"]);$input_size2=clean($_POST["hiddenval2"]);
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date) values ('$swr_id','$today')") OR die("Error:".$clm->error);
			$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today' where form_id=$form_id");
	}				
	if($query){
			$formFunctions->insert_incomplete_forms($dept,$form);//clm-- dept name and 11 -- form no
				if($input_size1!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
				for($i=1;$i<$input_size1;$i++){
					//$vala=$_POST["txtA".$i];	
					$valb=$_POST["txtB".$i];
					$valc=$_POST["txtC".$i];
					$vald=$_POST["txtD".$i];
					$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,sl_no,make,model_no,sl_f_du) VALUES ('$form_id','$i','$valb','$valc','$vald')");
				}
			}
			if($input_size2!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
				for($i=1;$i<$input_size2;$i++){
					//$vala=$_POST["textA".$i];	
					$valb=$_POST["textB".$i];
					$valc=$_POST["textC".$i];
					$vald=$_POST["textD".$i];	
					$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(form_id,sl_no,make,model_no,sl_f_du) VALUES ('$form_id','$i','$valb','$valc','$vald')");
				}
			}
			if(isset($part1) && $part1==false){
					echo "<script>
					alert('Something went wrong !!!');
					window.location.href = '".$table_name.".php';
					</script>";
			}else if(isset($part2) && $part2==false){
					echo "<script>
					alert('Something went wrong !!!');
					window.location.href = '".$table_name.".php';
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
				window.location.href = '".$table_name.".php';
			   </script>";
		}	
}

?>