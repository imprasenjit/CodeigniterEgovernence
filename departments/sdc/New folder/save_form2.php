<?php 
if(isset($_POST["save33"])){		
	$drug_name=clean($_POST["drug_name"]);$staff_manuf=clean( $_POST["staff_manuf"]);
	$input_size=$_POST["hiddenval"];$reg_fees="40";
	$sql=$sdc->query("select form_id from sdc_form33 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$sdc->query("insert into sdc_form33(user_id,sub_date,drug_name,staff_manuf,reg_fees) values ('$swr_id','$today', '$drug_name','$staff_manuf','$reg_fees')") OR die("Error: ".$sdc->error);
			$form_id=$sdc->insert_id;
	}else{
		$form_id=$row["form_id"];	
			$query=$sdc->query("update sdc_form33 set sub_date='$today',  drug_name='$drug_name',staff_manuf='$staff_manuf',reg_fees='$reg_fees' where form_id=$form_id") OR die("Error: ".$sdc->error);			
	}				
	if($query){
		$formFunctions->insert_incomplete_forms('sdc','33'); //sdc-- dept name and 1 -- form no 
			if($input_size!=0){					
			$k=$sdc->query("delete from sdc_form33_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$part1=$sdc->query("INSERT INTO sdc_form33_t1(id,form_id,slno,name,qualification,experience,responsible) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')") or die("error in insertion sdc_form33_t1".$sdc->error);
				}
			}
		echo "<script>
						alert('Successfully Saved....');
						window.location.href = 'preview.php?token=33';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href ='sdc_form33.php';
					</script>";
				}			
}
		
if(isset($_POST["proceed33"])){
	$query=$sdc->query("select form_id,save_mode,courier_details from sdc_form33 where user_id='$swr_id' and active='1'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'sdc_form33.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'sdc','33');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$sdc->query("update sdc_form33 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=sdc&form=33';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=33';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$sdc->query("update sdc_form33 set sub_date='$today',uain='$uain',save_mode='P' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'payment_section.php?token=33';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=33';
				</script>";
			}
		}else{
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=33';
				</script>";
		}
	}
}
if(isset($_POST["payment33"])){	
	$query=$sdc->query("select uain,form_id from sdc_form33 where user_id='$swr_id' and save_mode='P'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'payment_section.php?token=33;
			</script>";
	}else{
		if(empty($_POST["offline_challan"]) || $_POST["offline_challan"]=='2' || $_POST["offline_challan"]=='3'){
			echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'payment_section.php?token=33;
			</script>";
		}else{
			$row=$query->fetch_array();
			$form_id=$row["form_id"];$uain=$row["uain"];	
			$offline_challan=$_POST["offline_challan"];$payment_mode=0;
			$save_query=$sdc->query("update sdc_form33 set offline_challan='$offline_challan',payment_mode='$payment_mode',save_mode='C',sub_date='$today' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				$formFunctions->file_update($offline_challan);
				$formFunctions->insert_applications($uain);
				$str=$formFunctions->getEmail_str($uain);
				/////////////////////////////SEND MAIL////////////////////////////////
				$user_email=$formFunctions->get_usermail($swr_id);
				$dept_email="esgoa.sdc@gmail.com";
				require_once "sdc_form33_print.php"; 
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
						window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=33&dept=sdc';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form33.php';
					</script>";
				}
			}else{
				echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form33.php';
					</script>";
			}			
		}
	}
}
if(isset($_POST["save34"])){		
	$license_no=clean($_POST["license_no"]);$license_date=clean( $_POST["license_date"]);$staff_manuf=clean( $_POST["staff_manuf"]);
	$input_size=$_POST["hiddenval"];$input_size2=$_POST["hiddenval2"];$reg_fees="40";
	$sql=$sdc->query("select form_id from sdc_form34 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$sdc->query("insert into sdc_form34(user_id,sub_date,license_no,license_date,staff_manuf,reg_fees) values ('$swr_id','$today', '$license_no','$license_date','$staff_manuf','$reg_fees')") OR die("Error: ".$sdc->error);
			$form_id=$sdc->insert_id;
	}else{
		$form_id=$row["form_id"];	
		$query=$sdc->query("update sdc_form34 set sub_date='$today',  license_no='$license_no',license_date='$license_date',staff_manuf='$staff_manuf',reg_fees='$reg_fees' where form_id=$form_id") OR die("Error: ".$sdc->error);		
	}				
	if($query){
		$formFunctions->insert_incomplete_forms('sdc','34'); //sdc-- dept name and 1 -- form no 
			if($input_size!=0){					
			$k=$sdc->query("delete from sdc_form34_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txttB".$i];
				$part1=$sdc->query("INSERT INTO sdc_form34_t1(id,form_id,slno,name) VALUES ('','$form_id','$i','$valb')") or die("error in insertion sdc_form34_t1".$sdc->error);
				}
			}
			if($input_size2!=0){					
			$k=$sdc->query("delete from sdc_form34_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$part2=$sdc->query("INSERT INTO sdc_form34_t2(id,form_id,slno,name,qualification,experience,responsible) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')") or die("error in insertion sdc_form34_t2".$sdc->error);
				}
			}
		echo "<script>
						alert('Successfully Saved....');
						window.location.href = 'preview.php?token=34';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href ='sdc_form34.php';
					</script>";
				}			
}
if(isset($_POST["proceed34"])){
	$query=$sdc->query("select form_id,save_mode,courier_details from sdc_form34 where user_id='$swr_id' and active='1'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'sdc_form34.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'sdc','34');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$sdc->query("update fcs_form34 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=sdc&form=34';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=34';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$sdc->query("update sdc_form34 set sub_date='$today',uain='$uain',save_mode='P' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'payment_section.php?token=34';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=34';
				</script>";
			}
		}else{
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=34';
				</script>";
		}
	}
}
if(isset($_POST["payment34"])){	
	$query=$sdc->query("select uain,form_id from sdc_form34 where user_id='$swr_id' and save_mode='P'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'payment_section.php?token=34;
			</script>";
	}else{
		if(empty($_POST["offline_challan"]) || $_POST["offline_challan"]=='2' || $_POST["offline_challan"]=='3'){
			echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'payment_section.php?token=34;
			</script>";
		}else{
			$row=$query->fetch_array();
			$form_id=$row["form_id"];$uain=$row["uain"];	
			$offline_challan=$_POST["offline_challan"];$payment_mode=0;
			$save_query=$sdc->query("update sdc_form34 set offline_challan='$offline_challan',payment_mode='$payment_mode',save_mode='C',sub_date='$today' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				$formFunctions->file_update($offline_challan);
				$formFunctions->insert_applications($uain);
				$str=$formFunctions->getEmail_str($uain);
				/////////////////////////////SEND MAIL////////////////////////////////
				$user_email=$formFunctions->get_usermail($swr_id);
				$dept_email="esgoa.sdc@gmail.com";
				require_once "sdc_form34_print.php"; 
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
						window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=34&dept=sdc';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'fcs_form34.php';
					</script>";
				}
			}else{
				echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'fcs_form34.php';
					</script>";
			}			
		}
	}
}
if(isset($_POST["save35"])){		
	$license_no=clean($_POST["license_no"]);$license_date=clean( $_POST["license_date"]);$inspection=clean( $_POST["inspection"]);
	$input_size=$_POST["hiddenval"];$input_size1=$_POST["hiddenval2"];$reg_fees="40";
	$sql=$sdc->query("select form_id from sdc_form35 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$sdc->query("insert into sdc_form35(user_id,sub_date,license_no,license_date,inspection,reg_fees) values ('$swr_id','$today', '$license_no','$license_date','$inspection','$reg_fees')") OR die("Error: ".$sdc->error);
		$form_id=$sdc->insert_id;
	}else{
		$form_id=$row["form_id"];	
		$query=$sdc->query("update sdc_form35 set sub_date='$today', license_no='$license_no',license_date='$license_date',inspection='$inspection',reg_fees='$reg_fees' where form_id=$form_id") OR die("Error: ".$sdc->error);		
	}				
	if($query){
		$formFunctions->insert_incomplete_forms('sdc','35'); //sdc-- dept name and 1 -- form no 
			if($input_size!=0){					
			$k=$sdc->query("delete from sdc_form35_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txttB".$i];
				$part1=$sdc->query("INSERT INTO sdc_form35_t1(id,form_id,slno,name) VALUES ('','$form_id','$i','$valb')") or die("error in insertion sdc_form35_t1".$sdc->error);
				}
			}
			if($input_size1!=0){					
			$k=$sdc->query("delete from sdc_form35_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size1;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$part1=$sdc->query("INSERT INTO sdc_form35_t2(id,form_id,slno,name,qualification,experience,responsible) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')") or die("error in insertion sdc_form35_t2".$sdc->error);
				}
			}
		echo "<script>
						alert('Successfully Saved....');
						window.location.href = 'preview.php?token=35';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href ='sdc_form35.php';
					</script>";
				}			
}
if(isset($_POST["proceed35"])){
	$query=$sdc->query("select form_id,save_mode,courier_details from sdc_form35 where user_id='$swr_id' and active='1'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'sdc_form35.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'sdc','35');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$sdc->query("update sdc_form35 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=sdc&form=35';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=35';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$sdc->query("update sdc_form35 set sub_date='$today',uain='$uain',save_mode='P' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'payment_section.php?token=35';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=35';
				</script>";
			}
		}else{
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=35';
				</script>";
		}
	}
}
if(isset($_POST["payment35"])){	
	$query=$sdc->query("select uain,form_id from sdc_form35 where user_id='$swr_id' and save_mode='P'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'payment_section.php?token=35;
			</script>";
	}else{
		if(empty($_POST["offline_challan"]) || $_POST["offline_challan"]=='2' || $_POST["offline_challan"]=='3'){
			echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'payment_section.php?token=35;
			</script>";
		}else{
			$row=$query->fetch_array();
			$form_id=$row["form_id"];$uain=$row["uain"];	
			$offline_challan=$_POST["offline_challan"];$payment_mode=0;
			$save_query=$sdc->query("update sdc_form35 set offline_challan='$offline_challan',payment_mode='$payment_mode',save_mode='C',sub_date='$today' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				$formFunctions->file_update($offline_challan);
				$formFunctions->insert_applications($uain);
				$str=$formFunctions->getEmail_str($uain);
				/////////////////////////////SEND MAIL////////////////////////////////
				$user_email=$formFunctions->get_usermail($swr_id);
				$dept_email="esgoa.sdc@gmail.com";
				require_once "sdc_form35_print.php"; 
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
						window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=35&dept=sdc';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form35.php';
					</script>";
				}
			}else{
				echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form35.php';
					</script>";
			}			
		}
	}
}
if(isset($_POST["save37"])){		
	$cosmetics_names=clean($_POST["cosmetics_names"]);$co_name=clean($_POST["co_name"]);
	$input_size=$_POST["hiddenval"];$reg_fees="40";
	$sql=$sdc->query("select form_id from sdc_form37 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$sdc->query("insert into sdc_form37(user_id,sub_date,cosmetics_names,co_name,reg_fees) values ('$swr_id','$today', '$cosmetics_names','$co_name','$reg_fees')") OR die("Error: ".$sdc->error);
			$form_id=$sdc->insert_id;
	}else{
		$form_id=$row["form_id"];	
		$query=$sdc->query("update sdc_form37 set sub_date='$today',  cosmetics_names='$cosmetics_names',co_name='$co_name',reg_fees='$reg_fees' where form_id=$form_id") OR die("Error: ".$sdc->error);		
	}				
	if($query){
		$formFunctions->insert_incomplete_forms('sdc','37'); //sdc-- dept name and 1 -- form no 			
			if($input_size!=0){					
			$k=$sdc->query("delete from sdc_form37_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$part1=$sdc->query("INSERT INTO sdc_form37_t1(id,form_id,slno,name,qualification,experience,responsible) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')") or die("error in insertion sdc_form37_t1".$sdc->error);
				}
			}
		echo "<script>
						alert('Successfully Saved....');
						window.location.href = 'preview.php?token=37';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href ='sdc_form37.php';
					</script>";
				}			
}
if(isset($_POST["proceed37"])){
	$query=$sdc->query("select form_id,save_mode,courier_details from sdc_form37 where user_id='$swr_id' and active='1'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'sdc_form37.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'sdc','37');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$sdc->query("update sdc_form37 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=sdc&form=37';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=37';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$sdc->query("update sdc_form37 set sub_date='$today',uain='$uain',save_mode='P' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'payment_section.php?token=37';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=37';
				</script>";
			}
		}else{
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=37';
				</script>";
		}
	}
}
if(isset($_POST["payment37"])){	
	$query=$sdc->query("select uain,form_id from sdc_form37 where user_id='$swr_id' and save_mode='P'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'payment_section.php?token=37;
			</script>";
	}else{
		if(empty($_POST["offline_challan"]) || $_POST["offline_challan"]=='2' || $_POST["offline_challan"]=='3'){
			echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'payment_section.php?token=37;
			</script>";
		}else{
			$row=$query->fetch_array();
			$form_id=$row["form_id"];$uain=$row["uain"];	
			$offline_challan=$_POST["offline_challan"];$payment_mode=0;
			$save_query=$sdc->query("update sdc_form37 set offline_challan='$offline_challan',payment_mode='$payment_mode',save_mode='C',sub_date='$today' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				$formFunctions->file_update($offline_challan);
				$formFunctions->insert_applications($uain);
				$str=$formFunctions->getEmail_str($uain);
				/////////////////////////////SEND MAIL////////////////////////////////
				$user_email=$formFunctions->get_usermail($swr_id);
				$dept_email="esgoa.sdc@gmail.com";
				require_once "sdc_form37_print.php"; 
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
						window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=37&dept=sdc';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form37.php';
					</script>";
				}
			}else{
				echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form37.php';
					</script>";
			}			
		}
	}
}
if(isset($_POST["save36"])){		
	$cosmetics_names=clean($_POST["cosmetics_names"]);
	$input_size=$_POST["hiddenval"];$reg_fees="40";
	$sql=$sdc->query("select form_id from sdc_form36 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$sdc->query("insert into sdc_form36(user_id,sub_date,cosmetics_names,reg_fees) values ('$swr_id','$today', '$cosmetics_names','$reg_fees')") OR die("Error: ".$sdc->error);
			$form_id=$sdc->insert_id;
	}else{
		$form_id=$row["form_id"];	
		$query=$sdc->query("update sdc_form36 set sub_date='$today',  cosmetics_names='$cosmetics_names',reg_fees='$reg_fees' where form_id=$form_id") OR die("Error: ".$sdc->error);		
	}				
	if($query){
		$formFunctions->insert_incomplete_forms('sdc','36'); //sdc-- dept name and 1 -- form no 			
			if($input_size!=0){					
			$k=$sdc->query("delete from sdc_form36_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$part1=$sdc->query("INSERT INTO sdc_form36_t1(id,form_id,slno,name,qualification,experience,responsible) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')") or die("error in insertion sdc_form36_t1".$sdc->error);
				}
			}
		echo "<script>
						alert('Successfully Saved....');
						window.location.href = 'preview.php?token=36';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href ='sdc_form36.php';
					</script>";
				}			
}
if(isset($_POST["proceed36"])){
	$query=$sdc->query("select form_id,save_mode,courier_details from sdc_form36 where user_id='$swr_id' and active='1'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'sdc_form36.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'sdc','36');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$sdc->query("update sdc_form36 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=sdc&form=36';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=36';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$sdc->query("update sdc_form36 set sub_date='$today',uain='$uain',save_mode='P' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'payment_section.php?token=36';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=36';
				</script>";
			}
		}else{
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=36';
				</script>";
		}
	}
}
if(isset($_POST["payment36"])){	
	$query=$sdc->query("select uain,form_id from sdc_form36 where user_id='$swr_id' and save_mode='P'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'payment_section.php?token=36;
			</script>";
	}else{
		if(empty($_POST["offline_challan"]) || $_POST["offline_challan"]=='2' || $_POST["offline_challan"]=='3'){
			echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'payment_section.php?token=36;
			</script>";
		}else{
			$row=$query->fetch_array();
			$form_id=$row["form_id"];$uain=$row["uain"];	
			$offline_challan=$_POST["offline_challan"];$payment_mode=0;
			$save_query=$sdc->query("update sdc_form36 set offline_challan='$offline_challan',payment_mode='$payment_mode',save_mode='C',sub_date='$today' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				$formFunctions->file_update($offline_challan);
				$formFunctions->insert_applications($uain);
				$str=$formFunctions->getEmail_str($uain);
				/////////////////////////////SEND MAIL////////////////////////////////
				$user_email=$formFunctions->get_usermail($swr_id);
				$dept_email="esgoa.sdc@gmail.com";
				require_once "sdc_form36_print.php"; 
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
						window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=36&dept=sdc';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form36.php';
					</script>";
				}
			}else{
				echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form36.php';
					</script>";
			}			
		}
	}
}
if(isset($_POST["save40a"])) {	
	$edu_qualification=clean($_POST["edu_qualification"]);$incharge=clean($_POST["incharge"]);$business_past=clean($_POST["business_past"]);$is_engaged=clean($_POST["is_engaged"]);$is_engaged_detail=clean($_POST["is_engaged_detail"]);$business_present=clean($_POST["business_present"]);$is_license=clean($_POST["is_license"]);$lic_granted=clean($_POST["lic_granted"]);$particulars_license=clean($_POST["particulars_license"]);$is_warned=clean($_POST["is_warned"]);$is_act1940=clean($_POST["is_act1940"]);$is_act1930=clean($_POST["is_act1930"]);$is_act1919=clean($_POST["is_act1919"]);$is_act1948=clean($_POST["is_act1948"]);$other_act=clean($_POST["other_act"]);
	$hidden_value=clean($_POST["hidden_value"]);
	$sql=$sdc->query("select form_id from sdc_form40 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
	       $query=$sdc->query("insert into sdc_form40(user_id,sub_date,edu_qualification,incharge,business_past,is_engaged,is_engaged_detail,business_present,is_license,lic_granted,particulars_license,is_warned,is_act1940,is_act1930,is_act1919,is_act1948,other_act) values ('$swr_id','$today', '$edu_qualification','$incharge',  '$business_past', '$is_engaged','$is_engaged_detail','$business_present','$is_license','$lic_granted','$particulars_license','$is_warned','$is_act1940','$is_act1930','$is_act1919','$is_act1948','$other_act')") OR die("Error: ".$sdc->error);
		$form_id=$sdc->insert_id;
		for($i=1;$i<=$hidden_value;$i++){
			$name=$_POST["name".$i.""];$address=$_POST["address".$i.""];$pincode=$_POST["pincode".$i.""];$contact=$_POST["contact".$i.""];
			$query1=$sdc->query("INSERT INTO sdc_form40_members(id,form_id,sl_no,name,address,pincode,contact) VALUES ('','$form_id','$i','$name','$address','$pincode','$contact')") or die("error1 in insertion sdc_form40_members".$sdc->error);	
		}
	}else{  ////////////table is not empty//////////////
			$form_id=$row["form_id"];	
			$query=$sdc->query("update sdc_form40 set sub_date='$today', edu_qualification='$edu_qualification', incharge='$incharge',  business_past='$business_past', is_engaged='$is_engaged',is_engaged_detail='$is_engaged_detail',business_present='$business_present' ,is_license='$is_license',lic_granted='$lic_granted',particulars_license='$particulars_license',is_warned='$is_warned',is_act1940='$is_act1940',is_act1930='$is_act1930',is_act1919='$is_act1919',is_act1948='$is_act1948',other_act='$other_act' where form_id=$form_id") OR die("Error: ".$sdc->error);
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$address=$_POST["address".$i.""];$pincode=$_POST["pincode".$i.""];$contact=$_POST["contact".$i.""];			
				$query1=$sdc->query("update sdc_form40_members set name='$name',address='$address',pincode='$pincode',contact='$contact' where form_id='$form_id' and sl_no='$i'") or die("error in insertion sdc_form40_members".$sdc->error);
			}
	}	
	if($query){
		$formFunctions->insert_incomplete_forms('sdc','40'); //sdc-- dept name and 1 -- form no
		echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'sdc_form40.php?tab=2';
			</script>";			
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'sdc_form40.php?tab=1';
		</script>";
	}						
}
if(isset($_POST["save40b"])) {	
	$is_imported=clean($_POST["is_imported"]);$statement=clean($_POST["statement"]);$is_distributor=clean($_POST["is_distributor"]);$distributor=clean($_POST["distributor"]);$firm_cat=clean($_POST["firm_cat"]);$area_room=clean($_POST["area_room"]);$classes_drug=clean($_POST["classes_drug"]);$commodities=clean($_POST["commodities"]);$liquor=clean($_POST["liquor"]);$hours_days=clean($_POST["hours_days"]);
	if(!empty($_POST["premises"]))	 $premises=json_encode($_POST["premises"]);
	else	$premises=NULL;
	$sql=$sdc->query("select form_id from sdc_form40 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
	       $query=$sdc->query("insert into sdc_form40(user_id,sub_date,is_imported,statement,is_distributor,distributor,firm_cat,area_room,premises,classes_drug,commodities,liquor,hours_days) values ('$swr_id','$today', '$is_imported','$statement', '$is_distributor', '$distributor','$firm_cat','$area_room','$premises','$classes_drug','$commodities','$liquor','$hours_days')") OR die("Error: ".$sdc->error);
		  
	}else{  ////////////table is not empty//////////////
			$form_id=$row["form_id"];	
			$query=$sdc->query("update sdc_form40 set sub_date='$today', is_imported='$is_imported', statement='$statement',  is_distributor='$is_distributor', distributor='$distributor',firm_cat='$firm_cat',area_room='$area_room' ,premises='$premises',classes_drug='$classes_drug',commodities='$commodities',liquor='$liquor',hours_days='$hours_days' where form_id=$form_id") OR die("Error: ".$sdc->error);
			
	}	
	if($query){
		$formFunctions->insert_incomplete_forms('sdc','40'); //sdc-- dept name and 1 -- form no
		echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'preview.php?token=40';
			</script>";			
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'sdc_form40.php?tab=2';
		</script>";
	}						
}
if(isset($_POST["proceed40"])){
	$form_id=$sdc->query("select form_id from sdc_form40 where user_id='$swr_id' and active='1'")->fetch_object()->form_id;
	$uain=$formFunctions->create_uain($form_id,'sdc','40');
	$save_query=$sdc->query("update sdc_form40 set save_mode='C',uain='$uain' where form_id='$form_id'") OR die("Error: ".$sdc->error);	
			/////////////////////////////SEND MAIL////////////////////////////////
	if($save_query){
		$formFunctions->insert_applications($uain);
		$str=$formFunctions->getEmail_str($uain);
		$user_email=$formFunctions->get_usermail($swr_id);
		
		$dept_email="esgoa.sdc@gmail.com";
		require_once "sdc_form40_print.php"; 
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
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=40&dept=sdc';
			</script>";
	}else{
			echo "<script>
				alert('Invalid Entry');
				window.location.href = 'sdc_form40.php';
			</script>";
	}
}
?>