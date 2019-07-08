<?php
if(isset($_POST["save1"])){		
	$nature=clean($_POST["nature"]);$monogram=clean($_POST["monogram"]);$tools=clean($_POST["tools"]);$workshop=clean($_POST["workshop"]);$facilities=clean($_POST["facilities"]);$elect_energy=clean($_POST["elect_energy"]);$is_loan_detail=clean($_POST["is_loan_detail"]);$bankers=clean($_POST["bankers"]);$reg_number=clean($_POST["reg_number"]);$is_applied=clean($_POST["is_applied"]);$is_proposed=clean($_POST["is_proposed"]);$approval=clean($_POST["approval"]);$inspection=clean($_POST["inspection"]);$hidden_value=clean($_POST["hidden_value"]);

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

	$sql=$clm->query("select form_id from clm_form1 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$clm->query("insert into clm_form1(user_id,sub_date,nature,fact,monogram,tools,workshop,facilities,elect_energy,is_loan_detail,bankers,reg_number,is_applied,is_applied_details,is_proposed,approval,inspection,type,persons) values ('$swr_id','$today', '$nature', '$fact', '$monogram','$tools', '$workshop', '$facilities', '$elect_energy','$is_loan_detail','$bankers','$reg_number','$is_applied','$is_applied_details','$is_proposed','$approval','$inspection','$type','$persons')") OR die("Error: ".$clm->error);
			$form_id=$clm->insert_id;
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$family_name=$_POST["family_name".$i.""];$address=$_POST["address".$i.""];$pincode=$_POST["pincode".$i.""];$contact=$_POST["contact".$i.""];
				$query1=$clm->query("INSERT INTO clm_form1_members(id,form_id,sl_no,name,family_name,address,pincode,contact) VALUES ('','$form_id','$i','$name','$family_name','$address','$pincode','$contact')") or die("error1 in insertion clm_form1_members".$clm->error);
				
			}
	}else{
		$form_id=$row["form_id"];	
		$query=$clm->query("update clm_form1 set sub_date='$today', nature='$nature', fact='$fact', monogram='$monogram',tools='$tools', workshop='$workshop', facilities='$facilities', elect_energy='$elect_energy', is_loan_detail='$is_loan_detail', bankers='$bankers' , reg_number='$reg_number', is_applied='$is_applied', is_applied_details='$is_applied_details', is_proposed='$is_proposed', approval='$approval', inspection='$inspection' , type='$type', persons='$persons' where form_id=$form_id") OR die("Error: ".$clm->error);
		for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$family_name=$_POST["family_name".$i.""];$address=$_POST["address".$i.""];$pincode=$_POST["pincode".$i.""];$contact=$_POST["contact".$i.""];
			
				$query1=$clm->query("update clm_form1_members set name='$name',family_name='$family_name',address='$address',pincode='$pincode',contact='$contact' where form_id='$form_id' and sl_no='$i'") or die("error in insertion clm_form1_members".$clm->error);
		}
	}				
	if($query){
		$formFunctions->insert_incomplete_forms('clm','1'); //clm-- dept name and 1 -- form no
			echo "<script>
				alert('Successfully saved.');
				window.location.href = 'preview.php?token=1';
			</script>";
			
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'clm_form1.php';
			</script>";
	}			
}
if(isset($_POST["proceed1"])){
	$query=$clm->query("select form_id,save_mode,courier_details from clm_form1 where user_id='$swr_id' and active='1'") or die("Error :". $clm->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'clm_form1.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'clm','1');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$clm->query("update clm_form1 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($clm->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=clm&form=1';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=1';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$formFunctions->updateSubmit($uain,$form_id);
			$formFunctions->insert_applications($uain);
			$str=$formFunctions->getEmail_str($uain);
			/////////////////////////////SEND MAIL////////////////////////////////
			$user_email=$formFunctions->get_usermail($swr_id);
			$dept_email="esgoa.clm@gmail.com";
			require_once "clm_form1_print.php"; 
			$mypdf=uniqid(rand()).".pdf";
			/*---------mpdf logic-----------*/
			require_once "../../../mpdf60/mpdf.php"; 
			$mpdf=new mPDF('c','A4','','' , 10 , 10 , 10 , 10 , 0 , 0); 
			$mpdf->SetDisplayMode('fullpage');
			// 1 or 0 - whether to indent the first level of a list 
			$mpdf->list_indent_first_level = 0;
			$mpdf->WriteHTML($printContents);         
			$mpdf->Output($mypdf,'F');
			require_once "../../../mailsending/sendAttachment.php";		
			$emal=$dept_email.",".$user_email;
			send_attachment($emal,$str,$mypdf);
			unlink($mypdf);		
		
			if($save_query){
				echo "<script>
					alert('Successfully Submitted....');
					window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=1&dept=clm';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'clm_form1.php';
				</script>";
			}
		}else{
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=1';
				</script>";
		}
	}
}
if(isset($_POST["save2"])){		
	$is_lease_doc=clean($_POST["is_lease_doc"]);$area=clean($_POST["area"]);$previous=clean($_POST["previous"]);$machinery=clean($_POST["machinery"]);$elect_energy=clean($_POST["elect_energy"]);$sufficient=clean($_POST["sufficient"]);$reg_number=clean($_POST["reg_number"]);$weights_measure=clean($_POST["weights_measure"]);$is_applied=clean($_POST["is_applied"]);$hidden_value=clean($_POST["hidden_value"]);
	
	
	if(!empty($_POST["fact"]))	 $fact=json_encode($_POST["fact"]);
	else	$fact=NULL;
	if(!empty($_POST["persons"]))	 $persons=json_encode($_POST["persons"]);
	else	$persons=NULL;
	if($is_applied=="Y"){
		$is_applied_details=clean($_POST["is_applied_details"]);
	}else{
		$is_applied_details="";
	}
	$sql=$clm->query("select form_id from clm_form2 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$clm->query("insert into clm_form2(user_id,sub_date,is_lease_doc,fact,area,previous,machinery,elect_energy,sufficient,reg_number,is_applied,is_applied_details,weights_measure,persons) values ('$swr_id','$today', '$is_lease_doc', '$fact', '$area','$previous', '$machinery','$elect_energy','$sufficient','$reg_number','$is_applied','$is_applied_details','$weights_measure','$persons')") OR die("Error:".$clm->error);
			$form_id=$clm->insert_id;
			for($i=1;$i<=$hidden_value;$i++){ 
				$name=$_POST["name".$i.""];$family_name=$_POST["family_name".$i.""];$address=$_POST["address".$i.""];$pincode=$_POST["pincode".$i.""];$contact=$_POST["contact".$i.""];
				$query1=$clm->query("INSERT INTO clm_form2_members(id,form_id,sl_no,name,family_name,address,pincode,contact) VALUES ('','$form_id','$i','$name','$family_name','$address','$pincode','$contact')") or die("error1 in insertion clm_form2_members".$clm->error);
				
			}
	}else{
		$form_id=$row["form_id"];	
		$query=$clm->query("update clm_form2 set sub_date='$today', is_lease_doc='$is_lease_doc', fact='$fact', area='$area',previous='$previous', machinery='$machinery', elect_energy='$elect_energy', sufficient='$sufficient', reg_number='$reg_number', is_applied='$is_applied', is_applied_details='$is_applied_details', weights_measure='$weights_measure', persons='$persons' where form_id=$form_id") OR die("Error: ".$clm->error);
		for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$family_name=$_POST["family_name".$i.""];$address=$_POST["address".$i.""];$pincode=$_POST["pincode".$i.""];$contact=$_POST["contact".$i.""];
			
				$query1=$clm->query("update clm_form2_members set name='$name',family_name='$family_name',address='$address',pincode='$pincode',contact='$contact' where form_id='$form_id' and sl_no='$i'") or die("error in insertion clm_form2_members".$clm->error);
		}
	}				
	if($query){
		$formFunctions->insert_incomplete_forms('clm','2'); //clm-- dept name and 1 -- form no
			echo "<script>
				alert('Successfully saved.');
				window.location.href = 'preview.php?token=2';
			</script>";
			
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'clm_form2.php';
			</script>";
	}			
}
if(isset($_POST["proceed2"])){
	$query=$clm->query("select form_id,save_mode,courier_details from clm_form2 where user_id='$swr_id' and active='1'") or die("Error :". $clm->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'clm_form2.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'clm','2');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$clm->query("update clm_form2 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($clm->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=clm&form=2';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=2';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$formFunctions->updateSubmit($uain,$form_id);
			$formFunctions->insert_applications($uain);
			$str=$formFunctions->getEmail_str($uain);
			/////////////////////////////SEND MAIL////////////////////////////////
			$user_email=$formFunctions->get_usermail($swr_id);
			$dept_email="esgoa.clm@gmail.com";
			require_once "clm_form2_print.php"; 
			$mypdf=uniqid(rand()).".pdf";
			/*---------mpdf logic-----------*/
			require_once "../../../mpdf60/mpdf.php"; 
			$mpdf=new mPDF('c','A4','','' , 10 , 10 , 10 , 10 , 0 , 0); 
			$mpdf->SetDisplayMode('fullpage');
			// 1 or 0 - whether to indent the first level of a list 
			$mpdf->list_indent_first_level = 0;
			$mpdf->WriteHTML($printContents);         
			$mpdf->Output($mypdf,'F');
			require_once "../../../mailsending/sendAttachment.php";		
			$emal=$dept_email.",".$user_email;
			send_attachment($emal,$str,$mypdf);
			unlink($mypdf);		
		
			if($save_query){
				echo "<script>
					alert('Successfully Submitted....');
					window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=2&dept=clm';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'clm_form2.php';
				</script>";
			}
		}else{
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=2;
				</script>";
		}
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
	$sql=$clm->query("select form_id from clm_form3 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$clm->query("insert into clm_form3(user_id,sub_date,fact,weights_measure,reg_number,is_intend,source_supply,monogram,lic_num,regis_impoter,model_impoter,is_applied,is_applied_details) values ('$swr_id','$today', '$fact', '$weights_measure','$reg_number','$is_intend', '$source_supply','$monogram','$lic_num','$regis_impoter','$model_impoter','$is_applied','$is_applied_details')") OR die("Error: 1".$clm->error);
			$form_id=$clm->insert_id;
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$family_name=$_POST["family_name".$i.""];$address=$_POST["address".$i.""];$pincode=$_POST["pincode".$i.""];$contact=$_POST["contact".$i.""];
				$query1=$clm->query("INSERT INTO clm_form3_members(id,form_id,sl_no,name,family_name,address,pincode,contact) VALUES ('','$form_id','$i','$name','$family_name','$address','$pincode','$contact')") or die("error1 in insertion clm_form3_members".$clm->error);
				
			}
	}else{
		$form_id=$row["form_id"];	
		$query=$clm->query("update clm_form3 set sub_date='$today',  fact='$fact',weights_measure='$weights_measure',reg_number='$reg_number',is_intend='$is_intend', source_supply='$source_supply', monogram='$monogram', lic_num='$lic_num', regis_impoter='$regis_impoter',model_impoter='$model_impoter',  is_applied='$is_applied', is_applied_details='$is_applied_details' where form_id=$form_id") OR die("Error: ".$clm->error);
		for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$family_name=$_POST["family_name".$i.""];$address=$_POST["address".$i.""];$pincode=$_POST["pincode".$i.""];$contact=$_POST["contact".$i.""];
			
				$query1=$clm->query("update clm_form3_members set name='$name',family_name='$family_name',address='$address',pincode='$pincode',contact='$contact' where form_id='$form_id' and sl_no='$i'") or die("error in insertion clm_form3_members".$clm->error);
		}
	}				
	if($query){
		$formFunctions->insert_incomplete_forms('clm','3'); //clm-- dept name and 3 -- form no
			echo "<script>
				alert('Successfully saved.');
				window.location.href = 'preview.php?token=3';
			</script>";
			
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'clm_form3.php';
			</script>";
	}			
}
if(isset($_POST["proceed3"])){
	$query=$clm->query("select form_id,save_mode,courier_details from clm_form3 where user_id='$swr_id' and active='1'") or die("Error :". $clm->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'clm_form3.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'clm','3');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$clm->query("update clm_form3 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($clm->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=clm&form=3';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=3';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$formFunctions->updateSubmit($uain,$form_id);
			$formFunctions->insert_applications($uain);
			$str=$formFunctions->getEmail_str($uain);
			/////////////////////////////SEND MAIL////////////////////////////////
			$user_email=$formFunctions->get_usermail($swr_id);
			$dept_email="esgoa.clm@gmail.com";
			require_once "clm_form3_print.php"; 
			$mypdf=uniqid(rand()).".pdf";
			/*---------mpdf logic-----------*/
			require_once "../../../mpdf60/mpdf.php"; 
			$mpdf=new mPDF('c','A4','','' , 10 , 10 , 10 , 10 , 0 , 0); 
			$mpdf->SetDisplayMode('fullpage');
			// 1 or 0 - whether to indent the first level of a list 
			$mpdf->list_indent_first_level = 0;
			$mpdf->WriteHTML($printContents);         
			$mpdf->Output($mypdf,'F');
			require_once "../../../mailsending/sendAttachment.php";		
			$emal=$dept_email.",".$user_email;
			send_attachment($emal,$str,$mypdf);
			unlink($mypdf);		
		
			if($save_query){
				echo "<script>
					alert('Successfully Submitted....');
					window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=3&dept=clm';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'clm_form3.php';
				</script>";
			}
		}else{
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=3;
				</script>";
		}
	}
}
if(isset($_POST["save4"])){		
	$license_no=clean($_POST["license_no"]);$type_weight=clean($_POST["type_weight"]);$type_changes=clean($_POST["type_changes"]);$weight_trademark=clean($_POST["weight_trademark"]);$workshop_details=clean($_POST["workshop_details"]);$production_details=clean($_POST["production_details"]);$shop_reg_no=clean($_POST["shop_reg_no"]);$shop_reg_date=clean($_POST["shop_reg_date"]);
	$tax_reg_no=clean($_POST["tax_reg_no"]);$state=clean($_POST["state"]);$license_fee=clean($_POST["license_fee"]);$license_fee_words=clean($_POST["license_fee_words"]);$license_fee_date=clean($_POST["license_fee_date"]);
		
	$sql=$clm->query("select form_id from clm_form4 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	$input_size=clean($_POST["hidden_value"]);
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$clm->query("insert into clm_form4(user_id,sub_date,license_no,type_weight,type_changes,weight_trademark,workshop_details,production_details,shop_reg_no,shop_reg_date,tax_reg_no,state,license_fee,license_fee_words,license_fee_date) values ('$swr_id','$today', '$license_no', '$type_weight', '$type_changes','$weight_trademark', '$workshop_details', '$production_details', '$shop_reg_no','$shop_reg_date','$tax_reg_no','$state','$license_fee','$license_fee_words','$license_fee_date')") OR die("Error:".$clm->error);
			$form_id=$clm->insert_id;
			for($i=1;$i<=$input_size;$i++){
				$name=$_POST["name".$i.""];$family_name=$_POST["family_name".$i.""];$address=$_POST["address".$i.""];$pincode=$_POST["pincode".$i.""];$contact=$_POST["contact".$i.""];
				$query1=$clm->query("INSERT INTO clm_form4_members(id,form_id,sl_no,name,family_name,address,pincode,contact) VALUES ('','$form_id','$i','$name','$family_name','$address','$pincode','$contact')") or die("error1 in insertion clm_form4_members".$clm->error);
				
			}
	}else{
		$form_id=$row["form_id"];	
		$query=$clm->query("update clm_form4 set sub_date='$today', license_no='$license_no', type_weight='$type_weight', type_changes='$type_changes',weight_trademark='$weight_trademark', workshop_details='$workshop_details', production_details='$production_details', shop_reg_no='$shop_reg_no', shop_reg_date='$shop_reg_date', tax_reg_no='$tax_reg_no' , state='$state', license_fee='$license_fee', license_fee_words='$license_fee_words', license_fee_date='$license_fee_date' where form_id=$form_id") OR die("Error: ".$clm->error);
		for($i=1;$i<=$input_size;$i++){
				$name=$_POST["name".$i.""];$family_name=$_POST["family_name".$i.""];$address=$_POST["address".$i.""];$pincode=$_POST["pincode".$i.""];$contact=$_POST["contact".$i.""];
			
				$query1=$clm->query("update clm_form4_members set name='$name',family_name='$family_name',address='$address',pincode='$pincode',contact='$contact' where form_id='$form_id' and sl_no='$i'") or die("error in insertion clm_form4_members".$clm->error);
		}
	}				
	if($query){
		$formFunctions->insert_incomplete_forms('clm','4'); //clm-- dept name and 4 -- form no
			echo "<script>
				alert('Successfully saved.');
				window.location.href = 'preview.php?token=4';
			</script>";
			
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'clm_form4.php';
			</script>";
	}			
}
if(isset($_POST["proceed4"])){
	$query=$clm->query("select form_id,save_mode,courier_details from clm_form4 where user_id='$swr_id' and active='1'") or die("Error :". $clm->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'clm_form4.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'clm','4');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$clm->query("update clm_form4 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($clm->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=clm&form=4';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=4';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$formFunctions->updateSubmit($uain,$form_id);
			$formFunctions->insert_applications($uain);
			$str=$formFunctions->getEmail_str($uain);
			/////////////////////////////SEND MAIL////////////////////////////////
			$user_email=$formFunctions->get_usermail($swr_id);
			$dept_email="esgoa.clm@gmail.com";
			require_once "clm_form4_print.php"; 
			$mypdf=uniqid(rand()).".pdf";
			/*---------mpdf logic-----------*/
			require_once "../../../mpdf60/mpdf.php"; 
			$mpdf=new mPDF('c','A4','','' , 10 , 10 , 10 , 10 , 0 , 0); 
			$mpdf->SetDisplayMode('fullpage');
			// 1 or 0 - whether to indent the first level of a list 
			$mpdf->list_indent_first_level = 0;
			$mpdf->WriteHTML($printContents);         
			$mpdf->Output($mypdf,'F');
			require_once "../../../mailsending/sendAttachment.php";		
			$emal=$dept_email.",".$user_email;
			send_attachment($emal,$str,$mypdf);
			unlink($mypdf);		
		
			if($save_query){
				echo "<script>
					alert('Successfully Submitted....');
					window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=4&dept=clm';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'clm_form4.php';
				</script>";
			}
		}else{
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=4';
				</script>";
		}
	}
}
if(isset($_POST["save5"])){		
	$repairer_lic=clean($_POST["repairer_lic"]);$tl_reg_no=clean($_POST["tl_reg_no"]);$tl_date=clean($_POST["tl_date"]);$it_reg_no=clean($_POST["it_reg_no"]);$type_wm=clean($_POST["type_wm"]);$any_change=clean($_POST["any_change"]);$op_area=clean($_POST["op_area"]);$hav_u=clean($_POST["hav_u"]);$stamp_details=clean($_POST["stamp_details"]);$state=clean($_POST["state"]);$lic_fee=clean($_POST["lic_fee"]);$lic_fee_words=clean($_POST["lic_fee_words"]);$bank_sub_date=clean($_POST["bank_sub_date"]);$hidden_value=clean($_POST["hidden_value"]);
	
	$sql=$clm->query("select form_id from clm_form5 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$clm->query("insert into clm_form5(user_id,sub_date,repairer_lic,tl_reg_no,tl_date,it_reg_no,type_wm,any_change,op_area,hav_u,stamp_details,state,lic_fee,lic_fee_words,bank_sub_date) values ('$swr_id','$today', '$repairer_lic', '$tl_reg_no', '$tl_date','$it_reg_no', '$type_wm', '$any_change', '$op_area','$hav_u','$stamp_details','$state','$lic_fee','$lic_fee_words','$bank_sub_date')") OR die("Error:".$clm->error);
			$form_id=$clm->insert_id;
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$family_name=$_POST["family_name".$i.""];$address=$_POST["address".$i.""];$pincode=$_POST["pincode".$i.""];$contact=$_POST["contact".$i.""];
				$query1=$clm->query("INSERT INTO clm_form5_members(id,form_id,sl_no,name,family_name,address,pincode,contact) VALUES ('','$form_id','$i','$name','$family_name','$address','$pincode','$contact')") or die("error1 in insertion clm_form1_members".$clm->error);
				
			}
	}else{
		$form_id=$row["form_id"];	
		$query=$clm->query("update clm_form5 set sub_date='$today', repairer_lic='$repairer_lic', tl_reg_no='$tl_reg_no', tl_date='$tl_date', it_reg_no='$it_reg_no', type_wm='$type_wm', any_change='$any_change', op_area='$op_area',hav_u='$hav_u',stamp_details='$stamp_details',state='$state',lic_fee='$lic_fee',lic_fee_words='$lic_fee_words',bank_sub_date='$bank_sub_date' where form_id=$form_id") OR die("Error: ".$clm->error);
		for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$family_name=$_POST["family_name".$i.""];$address=$_POST["address".$i.""];$pincode=$_POST["pincode".$i.""];$contact=$_POST["contact".$i.""];
			
				$query1=$clm->query("update clm_form5_members set name='$name',family_name='$family_name',address='$address',pincode='$pincode',contact='$contact' where form_id='$form_id' and sl_no='$i'") or die("error in insertion clm_form1_members".$clm->error);
		}
	}				
	if($query){
		$formFunctions->insert_incomplete_forms('clm','5'); //clm-- dept name and 5 -- form no
			echo "<script>
				alert('Successfully saved.');
				window.location.href = 'preview.php?token=5';
			</script>";
			
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'clm_form5.php';
			</script>";
	}			
}
if(isset($_POST["proceed5"])){
	$query=$clm->query("select form_id,save_mode,courier_details from clm_form5 where user_id='$swr_id' and active='1'") or die("Error :". $clm->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'clm_form5.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'clm','5');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$clm->query("update clm_form5 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($clm->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=clm&form=5';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=5';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$formFunctions->updateSubmit($uain,$form_id);
			$formFunctions->insert_applications($uain);
			$str=$formFunctions->getEmail_str($uain);
			/////////////////////////////SEND MAIL////////////////////////////////
			$user_email=$formFunctions->get_usermail($swr_id);
			$dept_email="esgoa.clm@gmail.com";
			require_once "clm_form5_print.php"; 
			$mypdf=uniqid(rand()).".pdf";
			/*---------mpdf logic-----------*/
			require_once "../../../mpdf60/mpdf.php"; 
			$mpdf=new mPDF('c','A4','','' , 10 , 10 , 10 , 10 , 0 , 0); 
			$mpdf->SetDisplayMode('fullpage');
			// 1 or 0 - whether to indent the first level of a list 
			$mpdf->list_indent_first_level = 0;
			$mpdf->WriteHTML($printContents);         
			$mpdf->Output($mypdf,'F');
			require_once "../../../mailsending/sendAttachment.php";		
			$emal=$dept_email.",".$user_email;
			send_attachment($emal,$str,$mypdf);
			unlink($mypdf);		
		
			if($save_query){
				echo "<script>
					alert('Successfully Submitted....');
					window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=5&dept=clm';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'clm_form5.php';
				</script>";
			}
		}else{
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=5';
				</script>";
		}
	}
}
if(isset($_POST["save6"])){		
	$license_no=clean($_POST["license_no"]);$date=clean($_POST["date"]);$reg_no=clean($_POST["reg_no"]);$reg_date=clean($_POST["reg_date"]);$categories=clean($_POST["categories"]);$tax_reg=clean($_POST["tax_reg"]);$manu_details=clean($_POST["manu_details"]);
	$state=clean($_POST["state"]);$license_fee=clean($_POST["license_fee"]);$license_fee_words=clean($_POST["license_fee_words"]);$license_fee_date=clean($_POST["license_fee_date"]);

	$sql=$clm->query("select form_id from clm_form6 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	$input_size=clean($_POST["hidden_value"]);
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$clm->query("insert into clm_form6(user_id,sub_date,license_no,date,reg_no,reg_date,categories,tax_reg,manu_details,state,license_fee,license_fee_words,license_fee_date) values ('$swr_id','$today', '$license_no', '$date', '$reg_no','$reg_date', '$categories', '$tax_reg', '$manu_details','$state','$license_fee','$license_fee_words','$license_fee_date')") OR die("Error:".$clm->error);
			$form_id=$clm->insert_id;
			for($i=1;$i<=$input_size;$i++){
				$name=$_POST["name".$i.""];$family_name=$_POST["family_name".$i.""];$address=$_POST["address".$i.""];$pincode=$_POST["pincode".$i.""];$contact=$_POST["contact".$i.""];
				$query1=$clm->query("INSERT INTO clm_form6_members(id,form_id,sl_no,name,family_name,address,pincode,contact) VALUES ('','$form_id','$i','$name','$family_name','$address','$pincode','$contact')") or die("error1 in insertion clm_form6_members".$clm->error);
				
			}
	}else{
		$form_id=$row["form_id"];	
		$query=$clm->query("update clm_form6 set sub_date='$today', license_no='$license_no', date='$date', reg_no='$reg_no',reg_date='$reg_date', categories='$categories', tax_reg='$tax_reg', manu_details='$manu_details',state='$state', license_fee='$license_fee', license_fee_words='$license_fee_words', license_fee_date='$license_fee_date' where form_id=$form_id") OR die("Error: ".$clm->error);
		for($i=1;$i<=$input_size;$i++){
				$name=$_POST["name".$i.""];$family_name=$_POST["family_name".$i.""];$address=$_POST["address".$i.""];$pincode=$_POST["pincode".$i.""];$contact=$_POST["contact".$i.""];
			
				$query1=$clm->query("update clm_form6_members set name='$name',family_name='$family_name',address='$address',pincode='$pincode',contact='$contact' where form_id='$form_id' and sl_no='$i'") or die("error in insertion clm_form6_members".$clm->error);
		}
	}				
	if($query){
		$formFunctions->insert_incomplete_forms('clm','6'); //clm-- dept name and 6 -- form no
			echo "<script>
				alert('Successfully saved.');
				window.location.href = 'preview.php?token=6';
			</script>";
			
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'clm_form6.php';
			</script>";
	}			
}
if(isset($_POST["proceed6"])){
	$query=$clm->query("select form_id,save_mode,courier_details from clm_form6 where user_id='$swr_id' and active='1'") or die("Error :". $clm->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'clm_form6.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'clm','6');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$clm->query("update clm_form6 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($clm->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=clm&form=6';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=6';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$formFunctions->updateSubmit($uain,$form_id);
			$formFunctions->insert_applications($uain);
			$str=$formFunctions->getEmail_str($uain);
			/////////////////////////////SEND MAIL////////////////////////////////
			$user_email=$formFunctions->get_usermail($swr_id);
			$dept_email="esgoa.clm@gmail.com";
			require_once "clm_form6_print.php"; 
			$mypdf=uniqid(rand()).".pdf";
			/*---------mpdf logic-----------*/
			require_once "../../../mpdf60/mpdf.php"; 
			$mpdf=new mPDF('c','A4','','' , 10 , 10 , 10 , 10 , 0 , 0); 
			$mpdf->SetDisplayMode('fullpage');
			// 1 or 0 - whether to indent the first level of a list 
			$mpdf->list_indent_first_level = 0;
			$mpdf->WriteHTML($printContents);         
			$mpdf->Output($mypdf,'F');
			require_once "../../../mailsending/sendAttachment.php";		
			$emal=$dept_email.",".$user_email;
			send_attachment($emal,$str,$mypdf);
			unlink($mypdf);		
		
			if($save_query){
				echo "<script>
					alert('Successfully Submitted....');
					window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=6&dept=clm';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'clm_form6.php';
				</script>";
			}
		}else{
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=6';
				</script>";
		}
	}
}
if(isset($_POST["save7"])){		
	$brnch_nm=clean($_POST["brnch_nm"]);$commodities=clean($_POST["commodities"]);$cst_no=clean($_POST["cst_no"]);
	$hidden_value=clean($_POST["hidden_value"]);
	
	if(!empty($_POST["fac"]))	 $fac=json_encode($_POST["fac"]);
	else	$fac=NULL;
	$sql=$clm->query("select form_id from clm_form7 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$clm->query("insert into clm_form7(user_id,sub_date,fac,brnch_nm,commodities,cst_no,reg_fees) values ('$swr_id','$today', '$fac', '$brnch_nm', '$commodities', '$cst_no', '100')") OR die("Error:".$clm->error);
			$form_id=$clm->insert_id;
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$family_name=$_POST["family_name".$i.""];$address=$_POST["address".$i.""];$pincode=$_POST["pincode".$i.""];$contact=$_POST["contact".$i.""];
				$query1=$clm->query("INSERT INTO clm_form7_members(id,form_id,sl_no,name,family_name,address,pincode,contact) VALUES ('','$form_id','$i','$name','$family_name','$address','$pincode','$contact')") or die("error1 in insertion clm_form1_members".$clm->error);
				
			}
	}else{
		$form_id=$row["form_id"];	
		$query=$clm->query("update clm_form7 set sub_date='$today', fac='$fac',brnch_nm='$brnch_nm',commodities='$commodities',cst_no='$cst_no',reg_fees='100' where form_id=$form_id") OR die("Error: ".$clm->error);
		for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$family_name=$_POST["family_name".$i.""];$address=$_POST["address".$i.""];$pincode=$_POST["pincode".$i.""];$contact=$_POST["contact".$i.""];
			
				$query1=$clm->query("update clm_form7_members set name='$name',family_name='$family_name',address='$address',pincode='$pincode',contact='$contact' where form_id='$form_id' and sl_no='$i'") or die("error in insertion clm_form1_members".$clm->error);
		}
	}				
	if($query){
		$formFunctions->insert_incomplete_forms('clm','7'); //clm-- dept name and 8 -- form no
			echo "<script>
				alert('Successfully saved.');
				window.location.href = 'preview.php?token=7';
			</script>";
			
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'clm_form7.php';
			</script>";
	}			
}
if(isset($_POST["proceed7"])) {
	$query=$clm->query("select form_id,save_mode,courier_details from clm_form7 where user_id='$swr_id' and active='1'") or die("Error :". $clm->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'clm_form7.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'clm','7');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$clm->query("update clm_form7 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($clm->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=clm&form=7';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=7';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){			
			$save_query=$clm->query("update clm_form7 set sub_date='$today',uain='$uain',save_mode='P' where form_id='$form_id'") or die($clm->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'payment_section.php?token=7';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=7';
				</script>";
			}
		}else{
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=7';
				</script>";
		}
	}
}
if(isset($_POST["payment7"])){	
	$query=$clm->query("select uain,form_id from clm_form7 where user_id='$swr_id' and save_mode='P'") or die("Error :". $clm->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'payment_section.php?token=7';
			</script>";
	}else{
		if(empty($_POST["offline_challan"]) || $_POST["offline_challan"]=='2' || $_POST["offline_challan"]=='3'){
			echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'payment_section.php?token=7';
			</script>";
		}else{
			$row=$query->fetch_array();
			$form_id=$row["form_id"];$uain=$row["uain"];	
			$offline_challan=$_POST["offline_challan"];$payment_mode=0;
			$save_query=$clm->query("update clm_form7 set offline_challan='$offline_challan',payment_mode='$payment_mode',save_mode='C',sub_date='$today' where form_id='$form_id'") or die($clm->error);
			if($save_query){
				$formFunctions->insert_applications($uain);
				$str=$formFunctions->getEmail_str($uain);
				/////////////////////////////SEND MAIL////////////////////////////////
				$user_email=$formFunctions->get_usermail($swr_id);
				$dept_email="esgoa.clm@gmail.com";
				require_once "clm_form7_print.php"; 
				$mypdf=uniqid(rand()).".pdf";
				/*---------mpdf logic-----------*/
				require_once "../../../mpdf60/mpdf.php"; 
				$mpdf=new mPDF('c','A4','','' , 10 , 10 , 10 , 10 , 0 , 0); 
				$mpdf->SetDisplayMode('fullpage');
				// 1 or 0 - whether to indent the first level of a list 
				$mpdf->list_indent_first_level = 0;
				$mpdf->WriteHTML($printContents);         
				$mpdf->Output($mypdf,'F');
				require_once "../../../mailsending/sendAttachment.php";		
				$emal=$dept_email.",".$user_email;
				send_attachment($emal,$str,$mypdf);
				unlink($mypdf);		
			
				if($save_query){
					echo "<script>
						alert('Successfully Submitted....');
						window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=7&dept=clm';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'clm_form7.php';
					</script>";
				}
			}else{
				echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'clm_form7.php';
					</script>";
			}			
		}
	}
}
if(isset($_POST["save8"])){		
	$com_details=clean($_POST["com_details"]);$c_name=clean($_POST["c_name"]);$hidden_value=clean($_POST["hidden_value"]);
	
	if(!empty($_POST["ware"])) $ware=json_encode($_POST["ware"]);
	else $ware=NULL;
	
	$sql=$clm->query("select form_id from clm_form8 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$clm->query("insert into clm_form8(user_id,sub_date,ware,com_details,c_name) values ('$swr_id','$today', '$ware', '$com_details', '$c_name')") OR die("Error:".$clm->error);
			$form_id=$clm->insert_id;
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$family_name=$_POST["family_name".$i.""];$address=$_POST["address".$i.""];$pincode=$_POST["pincode".$i.""];$contact=$_POST["contact".$i.""];
				$query1=$clm->query("INSERT INTO clm_form8_members(id,form_id,sl_no,name,family_name,address,pincode,contact) VALUES ('','$form_id','$i','$name','$family_name','$address','$pincode','$contact')") or die("error1 in insertion clm_form8_members".$clm->error);
				
			}
	}else{
		$form_id=$row["form_id"];	
		$query=$clm->query("update clm_form8 set sub_date='$today', ware='$ware', com_details='$com_details', c_name='$c_name' where form_id=$form_id") OR die("Error: ".$clm->error);
		for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$family_name=$_POST["family_name".$i.""];$address=$_POST["address".$i.""];$pincode=$_POST["pincode".$i.""];$contact=$_POST["contact".$i.""];
			
				$query1=$clm->query("update clm_form8_members set name='$name',family_name='$family_name',address='$address',pincode='$pincode',contact='$contact' where form_id='$form_id' and sl_no='$i'") or die("error in insertion clm_form8_members".$clm->error);
		}
	}				
	if($query){
		$formFunctions->insert_incomplete_forms('clm','8'); //clm-- dept name and 8 -- form no
			echo "<script>
				alert('Successfully saved.');
				window.location.href = 'preview.php?token=8';
			</script>";
			
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'clm_form8.php';
			</script>";
	}			
}
if(isset($_POST["proceed8"])){
	$query=$clm->query("select form_id,save_mode,courier_details from clm_form8 where user_id='$swr_id' and active='1'") or die("Error :". $clm->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'clm_form8.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'clm','8');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$clm->query("update clm_form8 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($clm->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=clm&form=8';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=8';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$formFunctions->updateSubmit($uain,$form_id);
			$formFunctions->insert_applications($uain);
			$str=$formFunctions->getEmail_str($uain);
			/////////////////////////////SEND MAIL////////////////////////////////
			$user_email=$formFunctions->get_usermail($swr_id);
			$dept_email="esgoa.clm@gmail.com";
			require_once "clm_form8_print.php"; 
			$mypdf=uniqid(rand()).".pdf";
			/*---------mpdf logic-----------*/
			require_once "../../../mpdf60/mpdf.php"; 
			$mpdf=new mPDF('c','A4','','' , 10 , 10 , 10 , 10 , 0 , 0); 
			$mpdf->SetDisplayMode('fullpage');
			// 1 or 0 - whether to indent the first level of a list 
			$mpdf->list_indent_first_level = 0;
			$mpdf->WriteHTML($printContents);         
			$mpdf->Output($mypdf,'F');
			require_once "../../../mailsending/sendAttachment.php";		
			$emal=$dept_email.",".$user_email;
			send_attachment($emal,$str,$mypdf);
			unlink($mypdf);		
		
			if($save_query){
				echo "<script>
					alert('Successfully Submitted....');
					window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=8&dept=clm';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'clm_form8.php';
				</script>";
			}
		}else{
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=8';
				</script>";
		}
	}
}

if(isset($_POST["save9"])){	
	$meeting_date=clean($_POST["meeting_date"]);$meeting_place=clean($_POST["meeting_place"]);

	$sql=$clm->query("select form_id from clm_form9 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$clm->query("insert into clm_form9(user_id,sub_date,meeting_date,meeting_place) values ('$swr_id','$today','$meeting_date','$meeting_place')") OR die("Error: ".$clm->error);
	}else{
		$form_id=$row["form_id"];	
		$query=$clm->query("update clm_form9 set sub_date='$today', meeting_date='$meeting_date', meeting_place='$meeting_place' where form_id=$form_id") OR die("Error: ".$clm->error);
	}				
	if($query){
		$formFunctions->insert_incomplete_forms('clm','9'); //clm-- dept name and 9 -- form no
			echo "<script>
				alert('Successfully saved.');
				window.location.href = 'preview.php?token=9';
			</script>";
			
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'clm_form9.php';
			</script>";
	}			
}
if(isset($_POST["proceed9"])){
	$query=$clm->query("select form_id,save_mode,courier_details from clm_form9 where user_id='$swr_id' and active='1'") or die("Error :". $clm->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'clm_form9.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'clm','9');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$clm->query("update clm_form9 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($clm->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=clm&form=9';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=9';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$formFunctions->updateSubmit($uain,$form_id);
			$formFunctions->insert_applications($uain);
			$str=$formFunctions->getEmail_str($uain);
			/////////////////////////////SEND MAIL////////////////////////////////
			$user_email=$formFunctions->get_usermail($swr_id);
			$dept_email="esgoa.clm@gmail.com";
			require_once "clm_form9_print.php"; 
			$mypdf=uniqid(rand()).".pdf";
			/*---------mpdf logic-----------*/
			require_once "../../../mpdf60/mpdf.php"; 
			$mpdf=new mPDF('c','A4','','' , 10 , 10 , 10 , 10 , 0 , 0); 
			$mpdf->SetDisplayMode('fullpage');
			// 1 or 0 - whether to indent the first level of a list 
			$mpdf->list_indent_first_level = 0;
			$mpdf->WriteHTML($printContents);         
			$mpdf->Output($mypdf,'F');
			require_once "../../../mailsending/sendAttachment.php";		
			$emal=$dept_email.",".$user_email;
			send_attachment($emal,$str,$mypdf);
			unlink($mypdf);		
		
			if($save_query){
				echo "<script>
						alert('Successfully Submitted....');
						window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=9&dept=clm';
					</script>";
			}else{
				echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'clm_form9.php';
					</script>";
			}
		}else{
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=9';
				</script>";
		}
	}
}

if(isset($_POST["save10"])){	
	$form_against=clean($_POST["form_against"]);$order_num=clean($_POST["order_num"]);$order_date=clean($_POST["order_date"]);$auth_representative=clean($_POST["auth_representative"]);$ground_appeal=($_POST["ground_appeal"]);

	$sql=$clm->query("select form_id from clm_form10 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$clm->query("insert into clm_form10(user_id,sub_date,form_against,order_num,order_date,auth_representative,ground_appeal) values ('$swr_id','$today','$form_against','$order_num','$order_date','$auth_representative','$ground_appeal')") OR die("Error: ".$clm->error);
	}else{
		$form_id=$row["form_id"];	
		$query=$clm->query("update clm_form10 set sub_date='$today', form_against='$form_against', order_num='$order_num', order_date='$order_date',auth_representative='$auth_representative',ground_appeal='$ground_appeal' where form_id=$form_id") OR die("Error: ".$clm->error);
	}				
	if($query){
		$formFunctions->insert_incomplete_forms('clm','10'); //clm-- dept name and 10 -- form no
			echo "<script>
					alert('Successfully saved.');
					window.location.href = 'preview.php?token=10';
				</script>";
			
	}else{
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'clm_form10.php';
				</script>";
	}			
}
if(isset($_POST["proceed10"])){
	$query=$clm->query("select form_id,save_mode,courier_details from clm_form10 where user_id='$swr_id' and active='1'") or die("Error :". $clm->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'clm_form10.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'clm','10');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$clm->query("update clm_form10 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($clm->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=clm&form=10';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=10';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$formFunctions->updateSubmit($uain,$form_id);
			$formFunctions->insert_applications($uain);
			$str=$formFunctions->getEmail_str($uain);
			/////////////////////////////SEND MAIL////////////////////////////////
			$user_email=$formFunctions->get_usermail($swr_id);
			$dept_email="esgoa.clm@gmail.com";
			require_once "clm_form10_print.php"; 
			$mypdf=uniqid(rand()).".pdf";
			/*---------mpdf logic-----------*/
			require_once "../../../mpdf60/mpdf.php"; 
			$mpdf=new mPDF('c','A4','','' , 10 , 10 , 10 , 10 , 0 , 0); 
			$mpdf->SetDisplayMode('fullpage');
			// 1 or 0 - whether to indent the first level of a list 
			$mpdf->list_indent_first_level = 0;
			$mpdf->WriteHTML($printContents);         
			$mpdf->Output($mypdf,'F');
			require_once "../../../mailsending/sendAttachment.php";		
			$emal=$dept_email.",".$user_email;
			send_attachment($emal,$str,$mypdf);
			unlink($mypdf);		
		
			if($save_query){
				echo "<script>
					alert('Successfully Submitted....');
					window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=10&dept=clm';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'clm_form10.php';
				</script>";
			}
		}else{
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=10';
				</script>";
		}
	}
}
if(isset($_POST["save11"])){		
	$input_size1=clean($_POST["hiddenval"]);$input_size2=clean($_POST["hiddenval2"]);
	$sql=$clm->query("select form_id from clm_form11 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	$input_size=clean($_POST["hidden_value"]);
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$clm->query("insert into clm_form11(user_id,sub_date) values ('$swr_id','$today')") OR die("Error:".$clm->error);
	}else{
		$form_id=$row["form_id"];	
		$query=$clm->query("update clm_form11 set sub_date='$today' where form_id=$form_id") OR die("Error: ".$clm->error);
	}				
	if($query){
			$formFunctions->insert_incomplete_forms('clm','11'); //clm-- dept name and 11 -- form no
				if($input_size1!=0){					
			$k=$clm->query("delete from clm_form11_t1 where form_id='$form_id'");
				for($i=1;$i<$input_size1;$i++){
					//$vala=$_POST["txtA".$i];	
					$valb=$_POST["txtB".$i];
					$valc=$_POST["txtC".$i];
					$vald=$_POST["txtD".$i];
					$part1=$clm->query("INSERT INTO clm_form11_t1(id,form_id,sl_no,make,model_no,sl_f_du) VALUES ('','$form_id','$i','$valb','$valc','$vald')") or die($clm->error);
				}
			}
			if($input_size2!=0){					
			$k=$clm->query("delete from clm_form11_t2 where form_id='$form_id'");
				for($i=1;$i<$input_size2;$i++){
					//$vala=$_POST["textA".$i];	
					$valb=$_POST["textB".$i];
					$valc=$_POST["textC".$i];
					$vald=$_POST["textD".$i];	
					$part2=$clm->query("INSERT INTO clm_form11_t2(id,form_id,sl_no,make,model_no,sl_f_du) VALUES ('','$form_id','$i','$valb','$valc','$vald')") or die($clm->error);
				}
			}
			if(isset($part1) && $part1==false){
					echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'clm_form11.php';
					</script>";
			}else if(isset($part2) && $part2==false){
					echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'clm_form11.php';
					</script>";
			}else{
					echo "<script>
					alert('Successfully Saved..');
					window.location.href = 'preview.php?token=11';
					</script>";
			}	
		}else{
				echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'clm_form11.php';
			   </script>";
		   }	
}
if(isset($_POST["proceed11"])){
	$query=$clm->query("select form_id,save_mode,courier_details from clm_form11 where user_id='$swr_id' and active='1'") or die("Error :". $clm->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'clm_form11.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'clm','11');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$clm->query("update clm_form11 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($clm->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=clm&form=11';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=11';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$formFunctions->updateSubmit($uain,$form_id);
			$formFunctions->insert_applications($uain);
			$str=$formFunctions->getEmail_str($uain);
			/////////////////////////////SEND MAIL////////////////////////////////
			$user_email=$formFunctions->get_usermail($swr_id);
			$dept_email="esgoa.clm@gmail.com";
			require_once "clm_form11_print.php"; 
			$mypdf=uniqid(rand()).".pdf";
			/*---------mpdf logic-----------*/
			require_once "../../../mpdf60/mpdf.php"; 
			$mpdf=new mPDF('c','A4','','' , 10 , 10 , 10 , 10 , 0 , 0); 
			$mpdf->SetDisplayMode('fullpage');
			// 1 or 0 - whether to indent the first level of a list 
			$mpdf->list_indent_first_level = 0;
			$mpdf->WriteHTML($printContents);         
			$mpdf->Output($mypdf,'F');
			require_once "../../../mailsending/sendAttachment.php";		
			$emal=$dept_email.",".$user_email;
			send_attachment($emal,$str,$mypdf);
			unlink($mypdf);		
		
			if($save_query){
				echo "<script>
					alert('Successfully Submitted....');
					window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=11&dept=clm';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'clm_form11.php';
				</script>";
			}
		}else{
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=11';
				</script>";
		}
	}
}
if(isset($_POST["save12"])){		
	$make=clean($_POST["make"]);$model=clean($_POST["model"]);$accuracy=clean($_POST["accuracy"]);$machine=clean($_POST["machine"]);$platform=clean($_POST["platform"]);$max_capacity=clean($_POST["max_capacity"]);$min_capacity=clean($_POST["min_capacity"]);$e_value=clean($_POST["e_value"]);
	
	$sql=$clm->query("select form_id from clm_form12 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	$input_size=clean($_POST["hidden_value"]);
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$clm->query("insert into clm_form12(user_id,sub_date,make,model,accuracy,machine,platform,max_capacity,min_capacity,e_value) values ('$swr_id','$today','$make','$model','$accuracy','$machine','$platform','$max_capacity','$min_capacity','$e_value')") OR die("Error:".$clm->error);
			$form_id=$clm->insert_id;
			for($i=1;$i<=$input_size;$i++){
				$name=$_POST["name".$i.""];$family_name=$_POST["family_name".$i.""];$address=$_POST["address".$i.""];$pincode=$_POST["pincode".$i.""];$contact=$_POST["contact".$i.""];
				$query1=$clm->query("INSERT INTO clm_form12_members(id,form_id,sl_no,name,family_name,address,pincode,contact) VALUES ('','$form_id','$i','$name','$family_name','$address','$pincode','$contact')") or die("error1 in insertion clm_form12_members".$clm->error);
				
			}
	}else{
		$form_id=$row["form_id"];	
		$query=$clm->query("update clm_form12 set sub_date='$today',make='$make',model='$model',accuracy='$accuracy',machine='$machine',platform='$platform',max_capacity='$max_capacity',min_capacity='$min_capacity',e_value='$e_value' where form_id=$form_id") OR die("Error: ".$clm->error);
		for($i=1;$i<=$input_size;$i++){
				$name=$_POST["name".$i.""];$family_name=$_POST["family_name".$i.""];$address=$_POST["address".$i.""];$pincode=$_POST["pincode".$i.""];$contact=$_POST["contact".$i.""];
			
				$query1=$clm->query("update clm_form12_members set name='$name',family_name='$family_name',address='$address',pincode='$pincode',contact='$contact' where form_id='$form_id' and sl_no='$i'") or die("error in insertion clm_form12_members".$clm->error);
		}
	}				
	if($query){
		$formFunctions->insert_incomplete_forms('clm','12'); //clm-- dept name and 12 -- form no
			echo "<script>
				alert('Successfully saved.');
				window.location.href = 'preview.php?token=12';
			</script>";
			
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'clm_form12.php';
			</script>";
	}			
}
if(isset($_POST["proceed12"])){
	$query=$clm->query("select form_id,save_mode,courier_details from clm_form12 where user_id='$swr_id' and active='1'") or die("Error :". $clm->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'clm_form12.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'clm','12');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$clm->query("update clm_form12 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($clm->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=clm&form=12';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=12';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$formFunctions->updateSubmit($uain,$form_id);
			$formFunctions->insert_applications($uain);
			$str=$formFunctions->getEmail_str($uain);
			/////////////////////////////SEND MAIL////////////////////////////////
			$user_email=$formFunctions->get_usermail($swr_id);
			$dept_email="esgoa.clm@gmail.com";
			require_once "clm_form12_print.php"; 
			$mypdf=uniqid(rand()).".pdf";
			/*---------mpdf logic-----------*/
			require_once "../../../mpdf60/mpdf.php"; 
			$mpdf=new mPDF('c','A4','','' , 10 , 10 , 10 , 10 , 0 , 0); 
			$mpdf->SetDisplayMode('fullpage');
			// 1 or 0 - whether to indent the first level of a list 
			$mpdf->list_indent_first_level = 0;
			$mpdf->WriteHTML($printContents);         
			$mpdf->Output($mypdf,'F');
			require_once "../../../mailsending/sendAttachment.php";		
			$emal=$dept_email.",".$user_email;
			send_attachment($emal,$str,$mypdf);
			unlink($mypdf);		
		
			if($save_query){
				echo "<script>
					alert('Successfully Submitted....');
					window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=12&dept=clm';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'clm_form12.php';
				</script>";
			}
		}else{
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=12';
				</script>";
		}
	}
}
?>