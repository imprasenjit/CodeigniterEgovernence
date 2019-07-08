<?php
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



if(isset($_POST["save6"])){		
	$license_no=clean($_POST["license_no"]);
	$date=clean($_POST["date"]);
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
	$categories=clean($_POST["categories"]);$tax_reg=clean($_POST["tax_reg"]);$manu_details=clean($_POST["manu_details"]);
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
if(isset($_POST["save11"])){		
	$input_size1=clean($_POST["hiddenval"]);$input_size2=clean($_POST["hiddenval2"]);
	$sql=$clm->query("select form_id from clm_form11 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$clm->query("insert into clm_form11(user_id,sub_date) values ('$swr_id','$today')") OR die("Error:".$clm->error);
			$form_id=$clm->insert_id;
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