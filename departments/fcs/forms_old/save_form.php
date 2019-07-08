<?php
if(isset($_POST["save1"])){
	$father_name=clean($_POST["father_name"]);$age=clean($_POST["age"]);$caste=clean($_POST["caste"]);$name_lic=clean($_POST["name_lic"]);$is_lic_prev=clean($_POST["is_lic_prev"]);$trading=clean($_POST["trading"]);$stocks=clean($_POST["stocks"]);$is_convicted=clean($_POST["is_convicted"]);$particulars=clean($_POST["particulars"]);
	$is_declared=clean($_POST["is_declared"]);
	$hidden_value=clean($_POST["hidden_value"]); $input_size=$_POST["hiddenval"];
	if(!empty($_POST["business"]))	 $business=json_encode($_POST["business"]);
	else	$business=NULL;
	if(!empty($_POST["licence"]))	 $licence=json_encode($_POST["licence"]);
	else	$licence=NULL;
	if(!empty($_POST["address"]))	 $address=json_encode($_POST["address"]);
	else	$address=NULL;
	$sql=$fcs->query("select form_id from fcs_form1 where user_id='$swr_id' and active='1'") or die("Error :".$fcs->error);
	$row=$sql->fetch_array();
	
	if($sql->num_rows<1){   ////////////table is empty//////////////
		
		$query=$fcs->query("insert into fcs_form1(user_id,sub_date,father_name,age,caste,name_lic,	business,is_lic_prev,licence,trading,stocks,address,is_convicted,particulars,is_declared) values ('$swr_id','$today','$father_name', '$age', '$caste', '$name_lic', '$business', '$is_lic_prev', '$licence','$trading', '$stocks', '$address', '$is_convicted', '$particulars', '$is_declared')") OR die("Error: ".$fcs->error);$form_id=$fcs->insert_id;
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$fat_name=$_POST["fat_name".$i.""];$age=$_POST["age".$i.""];$address=$_POST["address".$i.""];$contact=$_POST["contact".$i.""];
				$query1=$fcs->query("INSERT INTO fcs_form1_members(id,form_id,sl_no,name,fat_name,age,address,contact) VALUES ('','$form_id','$i','$name','$fat_name','$age','$address','$contact')") or die("error1 in insertion fcs_form1_members".$fcs->error);				
			}				
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$fcs->query("update fcs_form1 set sub_date='$today', father_name='$father_name', age='$age', caste='$caste', name_lic='$name_lic', business='$business', is_lic_prev='$is_lic_prev' , licence='$licence', trading='$trading', stocks='$stocks', address='$address', is_convicted='$is_convicted', particulars='$particulars', is_declared='$is_declared' where form_id='$form_id'") OR die("Error: ".$fcs->error);
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$fat_name=$_POST["fat_name".$i.""];$age=$_POST["age".$i.""];$address=$_POST["address".$i.""];$contact=$_POST["contact".$i.""];
				$query1=$fcs->query("update fcs_form1_members set name='$name',fat_name='$fat_name',age='$age',address='$address',contact='$contact' where form_id='$form_id' and sl_no='$i'") or die("error in insertion fcs_form1_members".$fcs->error);			
			}	
	}	
			
	if($query){
		$formFunctions->insert_incomplete_forms('fcs','1'); //fcs-- dept name and 1 -- form no
			if($input_size!=0){					
			$k=$fcs->query("delete from fcs_form1_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$part1=$fcs->query("INSERT INTO fcs_form1_t1(id,form_id,slno,wholesaler,impoter,retailer) VALUES ('','$form_id','$i','$valb','$valc','$vald')") or die("error in insertion fcs_form1_t1".$fcs->error);
				}
			}
		echo "<script>
			 alert('Successfully Saved..');
			window.location.href = 'preview.php?token=1';
			 </script>";					
	}else{
		   echo "<script>
		   alert('Invalid Entry');
		   window.location.href = 'fcs_form1.php';
		</script>";
	}		
}				

if(isset($_POST["proceed1"])){
	$form_id=$fcs->query("select form_id from fcs_form1 where user_id='$swr_id' and active='1'")->fetch_object()->form_id;
	$uain=$formFunctions->create_uain($form_id,'fcs','1');
	$save_query=$fcs->query("update fcs_form1 set save_mode='C',sub_date='$today',received_date='$today',uain='$uain' where form_id='$form_id'") OR die("Error: ".$fcs->error);
	
			/////////////////////////////SEND MAIL////////////////////////////////
	if($save_query){
		$formFunctions->insert_applications($uain);
		$str=$formFunctions->getEmail_str($uain);
		$user_email=$formFunctions->get_usermail($swr_id);
		
		$dept_email="esgoa.fcs@gmail.com";
		require_once "fcs_form1_print.php"; 
		$mypdf=uniqid(rand()).".pdf";
		require_once "../../../mpdf60/mpdf.php"; 
		$mpdf=new mPDF('c','A4','','' , 10 , 10 , 10 , 10 , 0 , 0); 
		$mpdf->SetDisplayMode('fullpage');
		$mpdf->list_indent_first_level = 0;  // 1 or 0 - whether to indent the first level of a list 
		$mpdf->WriteHTML($printContents);         
		$mpdf->Output($mypdf,'F');
		require_once "../../../mailsending/sendAttachment.php"; 
		$emal1=$dept_email.",".$user_email;
		send_attachment($emal1,$str,$mypdf);
		unlink($mypdf);	
		echo "<script>
				alert('Successfully Submitted....');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=1&dept=fcs';
			</script>";
	}else{
			echo "<script>
				alert('Invalid Entry');
				window.location.href = 'fcs_form1.php';
			</script>";
	}
}
/*
if(isset($_POST["payment1"])){	
	$query=$fcs->query("select uain,form_id from fcs_form1 where user_id='$swr_id' and save_mode='P'") or die("Error :". $fcs->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'payment_section.php?token=1';
			</script>";
	}else{
		if(empty($_POST["offline_challan"]) || $_POST["offline_challan"]=='2' || $_POST["offline_challan"]=='3'){
			echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'payment_section.php?token=1';
			</script>";
		}else{
			$row=$query->fetch_array();
			$form_id=$row["form_id"];$uain=$row["uain"];	
			$offline_challan=$_POST["offline_challan"];$payment_mode=0;
			$save_query=$fcs->query("update fcs_form1 set offline_challan='$offline_challan',payment_mode='$payment_mode',save_mode='C',sub_date='$today' where form_id='$form_id'") or die($fcs->error);
			if($save_query){
				$formFunctions->file_update($offline_challan);
				$formFunctions->insert_applications($uain);
				$str=$formFunctions->getEmail_str($uain);
				/////////////////////////////SEND MAIL////////////////////////////////
				$user_email=$formFunctions->get_usermail($swr_id);
				$dept_email="esgoa.fcs@gmail.com";
				require_once "fcs_form1_print.php"; 
				$mypdf=uniqid(rand()).".pdf";
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
						window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=1&dept=fcs';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'fcs_form1.php';
					</script>";
				}
			}else{
				echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'fcs_form1.php';
					</script>";
			}			
		}
	}
}
*/
if(isset($_POST["save2"])) {	
	$stock_point=clean($_POST["stock_point"]);$lice_type=clean($_POST["lice_type"]);$lice_type_other=clean($_POST["lice_type_other"]);
	
	if(!empty($_POST["supplier"]))	 $supplier=json_encode($_POST["supplier"]);
	else	$supplier=NULL;
	if($lice_type=='NL'){
			$lice_type='NL';
		}else if($lice_type=='R'){
			$lice_type='R';
		}else{
			$lice_type=$lice_type_other;
		}
	$sql=$fcs->query("select form_id from fcs_form2 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
	       $query=$fcs->query("insert into fcs_form2(user_id,sub_date,supplier,stock_point,lice_type) values ('$swr_id','$today','$supplier', '$stock_point', '$lice_type')") OR die("Error: ".$fcs->error);
	}else{  ////////////table is not empty//////////////
			$form_id=$row["form_id"];	
			$query=$fcs->query("update fcs_form2 set sub_date='$today',  supplier='$supplier', stock_point='$stock_point', lice_type='$lice_type' where form_id=$form_id") OR die("Error: ".$fcs->error);		
	}	
	if($query){
		$formFunctions->insert_incomplete_forms('fcs','2'); //fcs-- dept name and 5 -- form no
		echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'preview.php?token=2';
			</script>";			
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'fcs_form2.php';
		</script>";
	}						
}
if(isset($_POST["proceed2"])){
	$form_id=$fcs->query("select form_id from fcs_form2 where user_id='$swr_id' and active='1'")->fetch_object()->form_id;
	$uain=$formFunctions->create_uain($form_id,'fcs','2');
	$save_query=$fcs->query("update fcs_form2 set save_mode='C',uain='$uain' where form_id='$form_id'") OR die("Error: ".$fcs->error);
			/////////////////////////////SEND MAIL////////////////////////////////
	if($save_query){
		$formFunctions->insert_applications($uain);
		$str=$formFunctions->getEmail_str($uain);
		$user_email=$formFunctions->get_usermail($swr_id);
		$dept_email="esgoa.fcs@gmail.com";
		require_once "fcs_form2_print.php"; 
		$mypdf=uniqid(rand()).".pdf";
		require_once "../../../mpdf60/mpdf.php"; 
		$mpdf=new mPDF('c','A4','','' , 10 , 10 , 10 , 10 , 0 , 0); 
		$mpdf->SetDisplayMode('fullpage');
		$mpdf->list_indent_first_level = 0;  // 1 or 0 - whether to indent the first level of a list 
		$mpdf->WriteHTML($printContents);         
		$mpdf->Output($mypdf,'F');
		require_once "../../../mailsending/sendAttachment.php"; 
		$emal1=$dept_email.",".$user_email;
		send_attachment($emal1,$str,$mypdf);
		unlink($mypdf);	
		echo "<script>
				alert('Successfully Submitted....');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=2&dept=fcs';
			</script>";
	}else{
			echo "<script>
				alert('Invalid Entry');
				window.location.href = 'fcs_form2.php';
			</script>";
	}
}
if(isset($_POST["save3"])) {	
	$auth_address=clean($_POST["auth_address"]);$license_no=clean($_POST["license_no"]);$expiry_date=clean($_POST["expiry_date"]);$license_stands=clean($_POST["license_stands"]);$renewal_desired=clean($_POST["renewal_desired"]);$details_action=clean($_POST["details_action"]);
	
	$sql=$fcs->query("select form_id from fcs_form3 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
	       $query=$fcs->query("insert into fcs_form3(user_id,sub_date,auth_address,license_no,expiry_date,license_stands,renewal_desired,details_action) values ('$swr_id','$today','$auth_address', '$license_no', '$expiry_date', '$license_stands', '$renewal_desired', '$details_action')") OR die("Error: ".$fcs->error);
	}else{  ////////////table is not empty//////////////
			$form_id=$row["form_id"];	
			$query=$fcs->query("update fcs_form3 set sub_date='$today',  auth_address='$auth_address', license_no='$license_no', expiry_date='$expiry_date', license_stands='$license_stands', renewal_desired='$renewal_desired', details_action='$details_action' where form_id=$form_id") OR die("Error: ".$fcs->error);		
	}	
	if($query){
		$formFunctions->insert_incomplete_forms('fcs','3'); //fcs-- dept name and 3 -- form no
		echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'preview.php?token=3';
			</script>";			
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'fcs_form3.php';
		</script>";
	}						
}
if(isset($_POST["proceed3"])){
	$form_id=$fcs->query("select form_id from fcs_form3 where user_id='$swr_id' and active='1'")->fetch_object()->form_id;
	$uain=$formFunctions->create_uain($form_id,'fcs','3');
	$save_query=$fcs->query("update fcs_form3 set save_mode='C',uain='$uain', save_mode='C' where form_id='$form_id'") OR die("Error: ".$fcs->error);
			/////////////////////////////SEND MAIL////////////////////////////////
	if($save_query){
		$formFunctions->insert_applications($uain);
		$str=$formFunctions->getEmail_str($uain);
		$user_email=$formFunctions->get_usermail($swr_id);
		$dept_email="esgoa.fcs@gmail.com";
		require_once "fcs_form3_print.php"; 
		$mypdf=uniqid(rand()).".pdf";
		require_once "../../../mpdf60/mpdf.php"; 
		$mpdf=new mPDF('c','A4','','' , 10 , 10 , 10 , 10 , 0 , 0); 
		$mpdf->SetDisplayMode('fullpage');
		$mpdf->list_indent_first_level = 0;  // 1 or 0 - whether to indent the first level of a list 
		$mpdf->WriteHTML($printContents);         
		$mpdf->Output($mypdf,'F');
		require_once "../../../mailsending/sendAttachment.php"; 
		$emal1=$dept_email.",".$user_email;
		send_attachment($emal1,$str,$mypdf);
		unlink($mypdf);	
		echo "<script>
				alert('Successfully Submitted....');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=3&dept=fcs';
			</script>";
	}else{
			echo "<script>
				alert('Invalid Entry');
				window.location.href = 'fcs_form3.php';
			</script>";
	}
}

if(isset($_POST["save4"])) {	
	$auth_address=clean($_POST["auth_address"]);$license_no=clean($_POST["license_no"]);$expiry_date=clean($_POST["expiry_date"]);$license_stands=clean($_POST["license_stands"]);$renewal_desired=clean($_POST["renewal_desired"]);$details_action=clean($_POST["details_action"]);
	
	$sql=$fcs->query("select form_id from fcs_form4 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
	       $query=$fcs->query("insert into fcs_form4(user_id,sub_date,auth_address,license_no,expiry_date,license_stands,renewal_desired,details_action) values ('$swr_id','$today','$auth_address', '$license_no', '$expiry_date', '$license_stands', '$renewal_desired', '$details_action')") OR die("Error: ".$fcs->error);
	}else{  ////////////table is not empty//////////////
			$form_id=$row["form_id"];	
			$query=$fcs->query("update fcs_form4 set sub_date='$today',  auth_address='$auth_address', license_no='$license_no', expiry_date='$expiry_date', license_stands='$license_stands', renewal_desired='$renewal_desired', details_action='$details_action' where form_id=$form_id") OR die("Error: ".$fcs->error);		
	}	
	if($query){
		$formFunctions->insert_incomplete_forms('fcs','4'); //fcs-- dept name and 4-- form no
		echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'fcs_form4.php?tab=2';
			</script>";			
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'fcs_form4.php';
		</script>";
	}						
}
if(isset($_POST["submit4"])){
	if((isset($_POST["mfile1"]) && empty($_POST["mfile1"])) || (isset($_POST["mfile1"]) && $_POST["mfile1"]=='2') ||  (isset($_POST["mfile1"]) && $_POST["mfile1"]=='3') ){
			echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'fcs_form4.php?tab=2';
			</script>";
	}else{
		$file1=clean($_POST["mfile1"]);
		$sql=$fcs->query("select form_id from fcs_form4 where user_id='$swr_id' and active='1'");		
			if($sql->num_rows<1){				
				echo "<script>
					alert('Please fill the first part of the form.');
					window.location.href = 'fcs_form4.php';
				</script>";
			}else{
				$row=$sql->fetch_array();
				$form_id=$row["form_id"];
				$savequery=$fcs->query("update fcs_form4 set file1='$file1' where form_id='$form_id'") or die($fcs->error);
			}		
			if($savequery){
				$formFunctions->file_update($file1);
				
				if($file1=="SC"){
					$save_query=$fcs->query("update fcs_form4 set courier_details='1', sub_date='$today' where form_id='$form_id'") or die($fcs->error);
				}else{
					$courier_details=NULL;
					$save_query=$fcs->query("update fcs_form4 set sub_date='$today',courier_details='$courier_details' where form_id='$form_id'") or die($fcs->error);
				}
				if($save_query){
					echo "<script>
						alert('Successfully Saved....');
						window.location.href = 'preview.php?token=4';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href ='fcs_form4.php?tab=2';
					</script>";
				}			
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href ='fcs_form4.php?tab=2';
				</script>";
			}
		}		
}
if(isset($_POST["proceed4"])){
	$form_id=$fcs->query("select form_id from fcs_form4 where user_id='$swr_id' and active='1'")->fetch_object()->form_id;
	$uain=$formFunctions->create_uain($form_id,'fcs','4');
	$save_query=$fcs->query("update fcs_form4 set save_mode='C',uain='$uain', save_mode='C' where form_id='$form_id'") OR die("Error: ".$fcs->error);
			/////////////////////////////SEND MAIL////////////////////////////////
	if($save_query){
		
		$formFunctions->insert_applications($uain);
		$str=$formFunctions->getEmail_str($uain);
		$user_email=$formFunctions->get_usermail($swr_id);
		$dept_email="esgoa.fcs@gmail.com";
		
		require_once "fcs_form4_print.php"; 
		$mypdf=uniqid(rand()).".pdf";
		require_once "../../../mpdf60/mpdf.php"; 
		$mpdf=new mPDF('c','A4','','' , 10 , 10 , 10 , 10 , 0 , 0); 
		$mpdf->SetDisplayMode('fullpage');
		$mpdf->list_indent_first_level = 0;  // 1 or 0 - whether to indent the first level of a list 
		$mpdf->WriteHTML($printContents);         
		$mpdf->Output($mypdf,'F');
		require_once "../../../mailsending/sendAttachment.php"; 
		$emal1=$dept_email.",".$user_email;
		send_attachment($emal1,$str,$mypdf);
		unlink($mypdf);	
		echo "<script>
				alert('Successfully Submitted....');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=4&dept=fcs';
			</script>";
	}else{
			echo "<script>
				alert('Invalid Entry');
				window.location.href = 'fcs_form4.php';
			</script>";
	}
}
?>