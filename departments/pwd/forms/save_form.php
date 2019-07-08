<?php
if(isset($_POST["save1"])){	
	$uni_identification_no=clean($_POST["uni_identification_no"]);
	$road_width=clean($_POST["road_width"]);$overhead_type=clean($_POST["overhead_type"]);$license_no=clean($_POST["license_no"]);$licensee_name=clean($_POST["licensee_name"]);
	
	if(!empty($_POST["permission"]))	$permission=json_encode($_POST["permission"]);
		else $permission=NULL;
	if(!empty($_POST["road_details"]))	 $road_details=json_encode($_POST["road_details"]);
		else	$road_details=NULL;		
	if(!empty($_POST["cost_of_cutting"]))	$cost_of_cutting=json_encode($_POST["cost_of_cutting"]);
		else $cost_of_cutting=NULL;

	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,uni_identification_no,permission,road_details,road_width,overhead_type,license_no,licensee_name,cost_of_cutting) values ('$swr_id','$today', '$uni_identification_no', '$permission', '$road_details','$road_width', '$overhead_type', '$license_no', '$licensee_name', '$cost_of_cutting')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',uni_identification_no='$uni_identification_no',permission='$permission', road_details='$road_details',road_width='$road_width', overhead_type='$overhead_type',license_no='$license_no', licensee_name='$licensee_name',cost_of_cutting='$cost_of_cutting' where form_id=$form_id");	
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";		
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php';
		</script>";
	}						
}

if(isset($_POST["save2a"])){	
	$vendor_name=clean($_POST["vendor_name"]);$reg_number=clean($_POST["reg_number"]);$application_number=clean($_POST["application_number"]);$vendor_type=clean($_POST["vendor_type"]);$fathers_name=clean($_POST["fathers_name"]);$caste=clean($_POST["caste"]);$religion=clean($_POST["religion"]);$date_of_birth=clean($_POST["date_of_birth"]);$nationality=clean($_POST["nationality"]);$pwrd_wing=clean($_POST["pwrd_wing"]);$financial_det_year=clean($_POST["financial_det_year"]);$pan_no=clean($_POST["pan_no"]);$gst_no=clean($_POST["gst_no"]);$bank_name=clean($_POST["bank_name"]);$branch_name=clean($_POST["branch_name"]);$acc_no=clean($_POST["acc_no"]);$category_class=clean($_POST["category_class"]);
	
	if(!empty($_POST["permanent_address"]))	$permanent_address=json_encode($_POST["permanent_address"]);
		else $permanent_address=NULL;
	if(!empty($_POST["present_address"]))	$present_address=json_encode($_POST["present_address"]);
		else $present_address=NULL;
	
	$date_of_birth=date("Y-m-d",strtotime($date_of_birth));
		
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,vendor_name,reg_number,application_number,vendor_type,fathers_name,caste,religion,date_of_birth,nationality,pwrd_wing,permanent_address,present_address,category_class,financial_det_year,pan_no,gst_no,bank_name,branch_name,acc_no) values ('$swr_id','$today', '$vendor_name', '$reg_number', '$application_number','$vendor_type', '$fathers_name', '$caste', '$religion', '$date_of_birth', '$nationality', '$pwrd_wing', '$permanent_address','$present_address', '$category_class', '$financial_det_year','$pan_no', '$gst_no', '$bank_name', '$branch_name', '$acc_no')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',vendor_name='$vendor_name',reg_number='$reg_number', application_number='$application_number',vendor_type='$vendor_type', fathers_name='$fathers_name',caste='$caste',religion='$religion',date_of_birth='$date_of_birth',nationality='$nationality',pwrd_wing='$pwrd_wing',permanent_address='$permanent_address',present_address='$present_address',category_class='$category_class',financial_det_year='$financial_det_year',pan_no='$pan_no',gst_no='$gst_no',bank_name='$bank_name',branch_name='$branch_name',acc_no='$acc_no' where form_id=$form_id");	
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		echo "<script>
			alert('Successfully Saved..');
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
	$reg_date=clean($_POST["reg_date"]);$reg_renewal_date=clean($_POST["reg_renewal_date"]);
	$reg_date=date("Y-m-d",strtotime($reg_date));
	$reg_renewal_date=date("Y-m-d",strtotime($reg_renewal_date));
	
	$hidden_value=clean($_POST["hidden_value"]);	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		echo "<script>
			alert('Please Fill up the first part of the form .');
			window.location.href = '".$table_name.".php';
		</script>";
	}else{		
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET  sub_date='$today',reg_date='$reg_date',reg_renewal_date='$reg_renewal_date' WHERE form_id='$form_id'");

		$members_check=$formFunctions->executeQuery($dept,"select id from ".$table_name."_members where form_id='$form_id'");
		if($members_check->num_rows>0){
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$age=$_POST["age".$i.""];$address=$_POST["address".$i.""];
				
				$query1=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_members set name='$name',age='$age',address='$address' where form_id='$form_id' and sl_no='$i'");
			}
		}else{
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_members where form_id='$form_id'");
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$age=$_POST["age".$i.""];$address=$_POST["address".$i.""];
				
				$query1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_members(form_id,sl_no,name,age,address) VALUES ('$form_id','$i','$name','$age','$address')");
			}			
		}		
	}
	if($query==true && $query1==true){
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
if(isset($_POST["save2c"])){	
	$input_size1=clean($_POST["hiddenval"]);$input_size2=clean($_POST["hiddenval2"]);$input_size3=clean($_POST["hiddenval3"]);$input_size4=clean($_POST["hiddenval4"]);
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		echo "<script>
			alert('Please Fill up the first part of the form .');
			window.location.href = '".$table_name.".php';
		</script>";
	}else{		
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET  sub_date='$today' WHERE form_id='$form_id'");
	}	
	if($query){
		if($input_size1!=0){
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size1;$i++){
				//$vala=$_POST["txtA".$i];	
				$valb=$_POST["text1B".$i];
				$valc=$_POST["text1C".$i];
				$vald=$_POST["text1D".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,slno,contractor_type,project_name,details) VALUES ('','$form_id','$i','$valb','$valc','$vald')");				
			}
		}
		if($input_size2!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				//$vala=$_POST["textA".$i];	
				$valb=$_POST["text2B".$i];
				$valc=$_POST["text2C".$i];
				$vald=$_POST["text2D".$i];
				$vale=$_POST["text2E".$i];
				
				$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(id,form_id,slno,contractor_type,work_item,quantity,fin_year) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}
		if($input_size3!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t3 where form_id='$form_id'");
			for($i=1;$i<$input_size3;$i++){
				//$vala=$_POST["textA".$i];	
				$valb=$_POST["text3B".$i];
				$valc=$_POST["text3C".$i];
				$vald=$_POST["text3D".$i];
				$part3=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t3(id,form_id,slno,contractor_type,project_name,details) VALUES ('','$form_id','$i','$valb','$valc','$vald')");
			}
		}
		if($input_size4!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t4 where form_id='$form_id'");
			for($i=1;$i<$input_size4;$i++){
				//$vala=$_POST["textA".$i];	
				$valb=$_POST["text4B".$i];
				$valc=$_POST["text4C".$i];
				$vald=$_POST["text4D".$i];
				$vale=$_POST["text4E".$i];
				
				$part4=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t4(id,form_id,slno,work_position,personnel_name,qualification,experience) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}
		echo "<script>
			alert('Successfully Saved..');
			window.location.href =  '".$table_name.".php?tab=4';
		</script>";	
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=3';
		</script>";
	}	
}
if(isset($_POST["save2d"])){	
	$input_size5=clean($_POST["hiddenval5"]);$input_size6=clean($_POST["hiddenval6"]);$input_size7=clean($_POST["hiddenval7"]);$input_size8=clean($_POST["hiddenval8"]);
	$brief_desc=clean($_POST["brief_desc"]);
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		echo "<script>
			alert('Please Fill up the first part of the form .');
			window.location.href = '".$table_name.".php';
		</script>";
	}else{		
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET  sub_date='$today',brief_desc='$brief_desc' WHERE form_id='$form_id'");	
		}	
	if($query){
		if($input_size5!=0){
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t5 where form_id='$form_id'");
			for($i=1;$i<$input_size5;$i++){
				//$vala=$_POST["txtA".$i];	
				$valb=$_POST["text5B".$i];
				$valc=$_POST["text5C".$i];
				$vald=$_POST["text5D".$i];
				$part5=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t5(id,form_id,slno,type_of_equipment,numbers_owned,machinery_details) VALUES ('','$form_id','$i','$valb','$valc','$vald')");			
			}
		}
		if($input_size6!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t6 where form_id='$form_id'");
			for($i=1;$i<$input_size6;$i++){
				//$vala=$_POST["textA".$i];	
				$valb=$_POST["text6B".$i];
				$valc=$_POST["text6C".$i];
				$part6=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t6(id,form_id,slno,financial_year,turnover) VALUES ('','$form_id','$i','$valb','$valc')");
			}
		}
		if($input_size7!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t7 where form_id='$form_id'");
			for($i=1;$i<$input_size7;$i++){
				//$vala=$_POST["textA".$i];	
				$valb=$_POST["text7B".$i];
				$valc=$_POST["text7C".$i];
				$vald=$_POST["text7D".$i];
				$part7=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t7(id,form_id,slno,employer,cause_of_dispute,status) VALUES ('','$form_id','$i','$valb','$valc','$vald')");
			}
		}
		if($input_size8!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t8 where form_id='$form_id'");
			for($i=1;$i<$input_size8;$i++){
				//$vala=$_POST["textA".$i];	
				$valb=$_POST["text8B".$i];
				$valc=$_POST["text8C".$i];
				$vald=date("Y-m-d",strtotime($_POST["text8D".$i]));
				$part8=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t8(id,form_id,slno,class1,action1,date1) VALUES ('','$form_id','$i','$valb','$valc','$vald')");
			}
		}
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=4';
		</script>";
	}	
}

if(isset($_POST["save3a"])){	
	$vendor_name=clean($_POST["vendor_name"]);$reg_number=clean($_POST["reg_number"]);$application_number=clean($_POST["application_number"]);$vendor_type=clean($_POST["vendor_type"]);$fathers_name=clean($_POST["fathers_name"]);$caste=clean($_POST["caste"]);$religion=clean($_POST["religion"]);$date_of_birth=clean($_POST["date_of_birth"]);$nationality=clean($_POST["nationality"]);$pwrd_wing=clean($_POST["pwrd_wing"]);
	$financial_det_year=clean($_POST["financial_det_year"]);$pan_no=clean($_POST["pan_no"]);$gst_no=clean($_POST["gst_no"]);$bank_name=clean($_POST["bank_name"]);$branch_name=clean($_POST["branch_name"]);$acc_no=clean($_POST["acc_no"]);
	
	if(!empty($_POST["permanent_address"]))	$permanent_address=json_encode($_POST["permanent_address"]);
		else $permanent_address=NULL;
	if(!empty($_POST["present_address"]))	$present_address=json_encode($_POST["present_address"]);
		else $present_address=NULL;
	//if(!empty($_POST["category_class"]))	 $category_class=json_encode($_POST["category_class"]);
	//	else	$category_class=NULL;
	$date_of_birth=date("Y-m-d",strtotime($date_of_birth));
		
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,vendor_name,reg_number,application_number,vendor_type,fathers_name,caste,religion,date_of_birth,nationality,pwrd_wing,permanent_address,present_address,financial_det_year,pan_no,gst_no,bank_name,branch_name,acc_no) values ('$swr_id','$today', '$vendor_name', '$reg_number', '$application_number','$vendor_type', '$fathers_name', '$caste', '$religion', '$date_of_birth', '$nationality', '$pwrd_wing', '$permanent_address','$present_address','$financial_det_year','$pan_no', '$gst_no', '$bank_name', '$branch_name', '$acc_no')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',vendor_name='$vendor_name',reg_number='$reg_number', application_number='$application_number',vendor_type='$vendor_type', fathers_name='$fathers_name',caste='$caste',religion='$religion',date_of_birth='$date_of_birth',nationality='$nationality',pwrd_wing='$pwrd_wing',permanent_address='$permanent_address',present_address='$present_address',financial_det_year='$financial_det_year',pan_no='$pan_no',gst_no='$gst_no',bank_name='$bank_name',branch_name='$branch_name',acc_no='$acc_no' where form_id=$form_id");	
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		echo "<script>
			alert('Successfully Saved..');
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
	$reg_date=clean($_POST["reg_date"]);$reg_renewal_date=clean($_POST["reg_renewal_date"]);
	$reg_date=date("Y-m-d",strtotime($reg_date));
	$reg_renewal_date=date("Y-m-d",strtotime($reg_renewal_date));
	$hidden_value=clean($_POST["hidden_value"]);	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		echo "<script>
			alert('Please Fill up the first part of the form .');
			window.location.href = '".$table_name.".php';
		</script>";
	}else{		
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET  sub_date='$today',reg_date='$reg_date',reg_renewal_date='$reg_renewal_date' WHERE form_id='$form_id'");
		$members_check=$formFunctions->executeQuery($dept,"select id from ".$table_name."_members where form_id='$form_id'");
		if($members_check->num_rows>0){
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$age=$_POST["age".$i.""];$address=$_POST["address".$i.""];
				$query1=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_members set name='$name',age='$age',address='$address' where form_id='$form_id' and sl_no='$i'");
			}
		}else{
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_members where form_id='$form_id'");
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$age=$_POST["age".$i.""];$address=$_POST["address".$i.""];
				$query1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_members(form_id,sl_no,name,age,address) VALUES ('$form_id','$i','$name','$age','$address')");
			}			
		}		
	}
	if($query==true && $query1==true){
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
if(isset($_POST["save3c"])){	
	$input_size1=clean($_POST["hiddenval"]);$input_size2=clean($_POST["hiddenval2"]);$input_size3=clean($_POST["hiddenval3"]);$input_size4=clean($_POST["hiddenval4"]);
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		echo "<script>
			alert('Please Fill up the first part of the form .');
			window.location.href = '".$table_name.".php';
		</script>";
	}else{		
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET  sub_date='$today' WHERE form_id='$form_id'");	
		}	
	if($query){
		if($input_size1!=0){
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size1;$i++){
				//$vala=$_POST["txtA".$i];	
				$valb=$_POST["text1B".$i];
				$valc=$_POST["text1C".$i];
				$vald=$_POST["text1D".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,slno,contractor_type,project_name,details) VALUES ('','$form_id','$i','$valb','$valc','$vald')");
			}
		}
		if($input_size2!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				//$vala=$_POST["textA".$i];	
				$valb=$_POST["text2B".$i];
				$valc=$_POST["text2C".$i];
				$vald=$_POST["text2D".$i];
				$vale=$_POST["text2E".$i];
				$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(id,form_id,slno,contractor_type,work_item,quantity,fin_year) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}
		if($input_size3!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t3 where form_id='$form_id'");
			for($i=1;$i<$input_size3;$i++){
				//$vala=$_POST["textA".$i];	
				$valb=$_POST["text3B".$i];
				$valc=$_POST["text3C".$i];
				$vald=$_POST["text3D".$i];
				$part3=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t3(id,form_id,slno,contractor_type,project_name,details) VALUES ('','$form_id','$i','$valb','$valc','$vald')");
			}
		}
		if($input_size4!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t4 where form_id='$form_id'");
			for($i=1;$i<$input_size4;$i++){
				//$vala=$_POST["textA".$i];	
				$valb=$_POST["text4B".$i];
				$valc=$_POST["text4C".$i];
				$vald=$_POST["text4D".$i];
				$vale=$_POST["text4E".$i];
				$part4=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t4(id,form_id,slno,work_position,personnel_name,qualification,experience) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}
		echo "<script>
			alert('Successfully Saved..');
			window.location.href =  '".$table_name.".php?tab=4';
		</script>";	
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=3';
		</script>";
	}	
}
if(isset($_POST["save3d"])){	
	$input_size5=clean($_POST["hiddenval5"]);$input_size6=clean($_POST["hiddenval6"]);$input_size7=clean($_POST["hiddenval7"]);$input_size8=clean($_POST["hiddenval8"]);
	$brief_desc=clean($_POST["brief_desc"]);
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		echo "<script>
			alert('Please Fill up the first part of the form .');
			window.location.href = '".$table_name.".php';
		</script>";
	}else{		
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET  sub_date='$today',brief_desc='$brief_desc' WHERE form_id='$form_id'");	
		}	
	if($query){
		if($input_size5!=0){
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t5 where form_id='$form_id'");
			for($i=1;$i<$input_size5;$i++){
				//$vala=$_POST["txtA".$i];	
				$valb=$_POST["text5B".$i];
				$valc=$_POST["text5C".$i];
				$vald=$_POST["text5D".$i];
				$part5=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t5(id,form_id,slno,type_of_equipment,numbers_owned,machinery_details) VALUES ('','$form_id','$i','$valb','$valc','$vald')");
			}
		}
		if($input_size6!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t6 where form_id='$form_id'");
			for($i=1;$i<$input_size6;$i++){
				//$vala=$_POST["textA".$i];	
				$valb=$_POST["text6B".$i];
				$valc=$_POST["text6C".$i];
				$part6=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t6(id,form_id,slno,financial_year,turnover) VALUES ('','$form_id','$i','$valb','$valc')");
			}
		}
		if($input_size7!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t7 where form_id='$form_id'");
			for($i=1;$i<$input_size7;$i++){
				//$vala=$_POST["textA".$i];	
				$valb=$_POST["text7B".$i];
				$valc=$_POST["text7C".$i];
				$vald=$_POST["text7D".$i];
				$part7=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t7(id,form_id,slno,employer,cause_of_dispute,status) VALUES ('','$form_id','$i','$valb','$valc','$vald')");
			}
		}
		if($input_size8!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t8 where form_id='$form_id'");
			for($i=1;$i<$input_size8;$i++){
				//$vala=$_POST["textA".$i];	
				$valb=$_POST["text8B".$i];
				$valc=$_POST["text8C".$i];
				$vald=date("Y-m-d",strtotime($_POST["text8D".$i]));
				$part8=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t8(id,form_id,slno,class1,action1,date1) VALUES ('','$form_id','$i','$valb','$valc','$vald')");
			}
		}
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=4';
		</script>";
	}	
}

if(isset($_POST["save4a"])){	
	$vendor_name=clean($_POST["vendor_name"]);$reg_number=clean($_POST["reg_number"]);$application_number=clean($_POST["application_number"]);$vendor_type=clean($_POST["vendor_type"]);$fathers_name=clean($_POST["fathers_name"]);$caste=clean($_POST["caste"]);$religion=clean($_POST["religion"]);$date_of_birth=clean($_POST["date_of_birth"]);$nationality=clean($_POST["nationality"]);$pwrd_wing=clean($_POST["pwrd_wing"]);
	$financial_det_year=clean($_POST["financial_det_year"]);$pan_no=clean($_POST["pan_no"]);$gst_no=clean($_POST["gst_no"]);$bank_name=clean($_POST["bank_name"]);$branch_name=clean($_POST["branch_name"]);$acc_no=clean($_POST["acc_no"]);
	
	if(!empty($_POST["permanent_address"]))	$permanent_address=json_encode($_POST["permanent_address"]);
		else $permanent_address=NULL;
	if(!empty($_POST["present_address"]))	$present_address=json_encode($_POST["present_address"]);
		else $present_address=NULL;
	//if(!empty($_POST["category_class"]))	 $category_class=json_encode($_POST["category_class"]);
	//	else	$category_class=NULL;
	$date_of_birth=date("Y-m-d",strtotime($date_of_birth));
		
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,vendor_name,reg_number,application_number,vendor_type,fathers_name,caste,religion,date_of_birth,nationality,pwrd_wing,permanent_address,present_address,financial_det_year,pan_no,gst_no,bank_name,branch_name,acc_no) values ('$swr_id','$today', '$vendor_name', '$reg_number', '$application_number','$vendor_type', '$fathers_name', '$caste', '$religion', '$date_of_birth', '$nationality', '$pwrd_wing', '$permanent_address','$present_address','$financial_det_year','$pan_no', '$gst_no', '$bank_name', '$branch_name', '$acc_no')");
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',vendor_name='$vendor_name',reg_number='$reg_number', application_number='$application_number',vendor_type='$vendor_type', fathers_name='$fathers_name',caste='$caste',religion='$religion',date_of_birth='$date_of_birth',nationality='$nationality',pwrd_wing='$pwrd_wing',permanent_address='$permanent_address',present_address='$present_address',financial_det_year='$financial_det_year',pan_no='$pan_no',gst_no='$gst_no',bank_name='$bank_name',branch_name='$branch_name',acc_no='$acc_no' where form_id=$form_id");	
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$table_name.".php?tab=2';
		</script>";		
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=1';
		</script>";
	}						
}
if(isset($_POST["save4b"])){	
	$reg_date=clean($_POST["reg_date"]);$reg_renewal_date=clean($_POST["reg_renewal_date"]);
	$reg_date=date("Y-m-d",strtotime($reg_date));
	$reg_renewal_date=date("Y-m-d",strtotime($reg_renewal_date));
	$hidden_value=clean($_POST["hidden_value"]);	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		echo "<script>
			alert('Please Fill up the first part of the form .');
			window.location.href = '".$table_name.".php';
		</script>";
	}else{		
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET  sub_date='$today',reg_date='$reg_date',reg_renewal_date='$reg_renewal_date' WHERE form_id='$form_id'");

		$members_check=$formFunctions->executeQuery($dept,"select id from ".$table_name."_members where form_id='$form_id'");
		if($members_check->num_rows>0){
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$age=$_POST["age".$i.""];$address=$_POST["address".$i.""];
				
				$query1=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_members set name='$name',age='$age',address='$address' where form_id='$form_id' and sl_no='$i'");
			}
		}else{
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_members where form_id='$form_id'");
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$age=$_POST["age".$i.""];$address=$_POST["address".$i.""];
				
				$query1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_members(form_id,sl_no,name,age,address) VALUES ('$form_id','$i','$name','$age','$address')");
			}			
		}		
	}
	if($query==true && $query1==true){
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
if(isset($_POST["save4c"])){	
	$input_size1=clean($_POST["hiddenval"]);$input_size2=clean($_POST["hiddenval2"]);$input_size3=clean($_POST["hiddenval3"]);$input_size4=clean($_POST["hiddenval4"]);
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		echo "<script>
			alert('Please Fill up the first part of the form .');
			window.location.href = '".$table_name.".php';
		</script>";
	}else{		
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET  sub_date='$today' WHERE form_id='$form_id'");	
	}	
	if($query){
		if($input_size1!=0){
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size1;$i++){
				//$vala=$_POST["txtA".$i];	
				$valb=$_POST["text1B".$i];
				$valc=$_POST["text1C".$i];
				$vald=$_POST["text1D".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,slno,contractor_type,project_name,details) VALUES ('','$form_id','$i','$valb','$valc','$vald')");
			}
		}
		if($input_size2!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				//$vala=$_POST["textA".$i];	
				$valb=$_POST["text2B".$i];
				$valc=$_POST["text2C".$i];
				$vald=$_POST["text2D".$i];
				$vale=$_POST["text2E".$i];
				$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(id,form_id,slno,contractor_type,work_item,quantity,fin_year) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}
		if($input_size3!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t3 where form_id='$form_id'");
			for($i=1;$i<$input_size3;$i++){
				//$vala=$_POST["textA".$i];	
				$valb=$_POST["text3B".$i];
				$valc=$_POST["text3C".$i];
				$vald=$_POST["text3D".$i];
				$part3=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t3(id,form_id,slno,contractor_type,project_name,details) VALUES ('','$form_id','$i','$valb','$valc','$vald')");
			}
		}
		if($input_size4!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t4 where form_id='$form_id'");
			for($i=1;$i<$input_size4;$i++){
				//$vala=$_POST["textA".$i];	
				$valb=$_POST["text4B".$i];
				$valc=$_POST["text4C".$i];
				$vald=$_POST["text4D".$i];
				$vale=$_POST["text4E".$i];
				$part4=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t4(id,form_id,slno,work_position,personnel_name,qualification,experience) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}
		echo "<script>
			alert('Successfully Saved..');
			window.location.href =  '".$table_name.".php?tab=4';
		</script>";	
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=3';
		</script>";
	}	
}
if(isset($_POST["save4d"])){	
	$input_size5=clean($_POST["hiddenval5"]);$input_size6=clean($_POST["hiddenval6"]);$input_size7=clean($_POST["hiddenval7"]);$input_size8=clean($_POST["hiddenval8"]);
	$brief_desc=clean($_POST["brief_desc"]);
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		echo "<script>
			alert('Please Fill up the first part of the form .');
			window.location.href = '".$table_name.".php';
		</script>";
	}else{		
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET  sub_date='$today',brief_desc='$brief_desc' WHERE form_id='$form_id'");	
	}	
	if($query){
		if($input_size5!=0){
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t5 where form_id='$form_id'");
			for($i=1;$i<$input_size5;$i++){
				//$vala=$_POST["txtA".$i];	
				$valb=$_POST["text5B".$i];
				$valc=$_POST["text5C".$i];
				$vald=$_POST["text5D".$i];
				$part5=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t5(id,form_id,slno,type_of_equipment,numbers_owned,machinery_details) VALUES ('','$form_id','$i','$valb','$valc','$vald')");
			}
		}
		if($input_size6!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t6 where form_id='$form_id'");
			for($i=1;$i<$input_size6;$i++){
				//$vala=$_POST["textA".$i];	
				$valb=$_POST["text6B".$i];
				$valc=$_POST["text6C".$i];
				$part6=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t6(id,form_id,slno,financial_year,turnover) VALUES ('','$form_id','$i','$valb','$valc')");
			}
		}
		if($input_size7!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t7 where form_id='$form_id'");
			for($i=1;$i<$input_size7;$i++){
				//$vala=$_POST["textA".$i];	
				$valb=$_POST["text7B".$i];
				$valc=$_POST["text7C".$i];
				$vald=$_POST["text7D".$i];
				$part7=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t7(id,form_id,slno,employer,cause_of_dispute,status) VALUES ('','$form_id','$i','$valb','$valc','$vald')");
			}
		}
		if($input_size8!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t8 where form_id='$form_id'");
			for($i=1;$i<$input_size8;$i++){
				//$vala=$_POST["textA".$i];	
				$valb=$_POST["text8B".$i];
				$valc=$_POST["text8C".$i];
				$vald=date("Y-m-d",strtotime($_POST["text8D".$i]));
				$part8=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t8(id,form_id,slno,class1,action1,date1) VALUES ('','$form_id','$i','$valb','$valc','$vald')");
			}
		}
		 echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=4';
		</script>";
	}	
}
?>