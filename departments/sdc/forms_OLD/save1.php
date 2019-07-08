<?php
if(isset($_POST["save8"])) {	
	$location=clean($_POST["location"]);$names_of_drugs=clean($_POST["names_of_drugs"]);$input_size=$_POST["hiddenval"];
	$reg_fees="40";
	$sql=$sdc->query("select form_id from sdc_form8 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
	       $query=$sdc->query("insert into sdc_form8(user_id,sub_date,location,names_of_drugs,reg_fees) values ('$swr_id','$today', '$location','$names_of_drugs','$reg_fees')") OR die("Error: ".$sdc->error);
	}else{  ////////////table is not empty//////////////
			$form_id=$row["form_id"];	
			$query=$sdc->query("update sdc_form8 set sub_date='$today', location='$location', names_of_drugs='$names_of_drugs',reg_fees='$reg_fees' where form_id=$form_id") OR die("Error: ".$sdc->error);
	}	
	if($query){
		$formFunctions->insert_incomplete_forms('sdc','8'); //sdc-- dept name and 1 -- form no 
		if($input_size!=0){					
		$k=$sdc->query("delete from sdc_form8_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$part1=$sdc->query("INSERT INTO sdc_form8_t1(id,form_id,slno,name,qualification,experience) VALUES ('','$form_id','$i','$valb','$valc','$vald')") or die("error in insertion sdc_form8_t1".$sdc->error);
				}
			}
		echo "<script>
						alert('Successfully Saved....');
						window.location.href = 'preview.php?token=8';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href ='sdc_form8.php';
					</script>";
				}			
}

if(isset($_POST["proceed8"])){
	$query=$sdc->query("select form_id,save_mode,courier_details from sdc_form8 where user_id='$swr_id' and active='1'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'sdc_form8.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'sdc','8');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$sdc->query("update sdc_form8 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=sdc&form=8';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=8';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$sdc->query("update sdc_form8 set sub_date='$today',uain='$uain',save_mode='P' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'payment_section.php?token=8';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=8';
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
if(isset($_POST["payment8"])){	
	$query=$sdc->query("select uain,form_id from sdc_form8 where user_id='$swr_id' and save_mode='P'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'payment_section.php?token=8';
			</script>";
	}else{
		if(empty($_POST["offline_challan"]) || $_POST["offline_challan"]=='2' || $_POST["offline_challan"]=='3'){
			echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'payment_section.php?token=8';
			</script>";
		}else{
			$row=$query->fetch_array();
			$form_id=$row["form_id"];$uain=$row["uain"];	
			$offline_challan=$_POST["offline_challan"];$payment_mode=0;
			$save_query=$sdc->query("update sdc_form8 set offline_challan='$offline_challan',payment_mode='$payment_mode',save_mode='C',sub_date='$today' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				$formFunctions->file_update($offline_challan);
				$formFunctions->insert_applications($uain);
				$str=$formFunctions->getEmail_str($uain);
				/////////////////////////////SEND MAIL////////////////////////////////
				$user_email=$formFunctions->get_usermail($swr_id);
				$dept_email="esgoa.sdc@gmail.com";
				require_once "sdc_form8_print.php"; 
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
						window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=8&dept=sdc';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form8.php';
					</script>";
				}
			}else{
				echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form8.php';
					</script>";
			}			
		}
	}
}
if(isset($_POST["save9"])) {	
	$licence_no=clean($_POST["licence_no"]);$location=clean($_POST["location"]);$homoeopathic=clean($_POST["homoeopathic"]);$input_size=$_POST["hiddenval"];
	$reg_fees="40";
	$sql=$sdc->query("select form_id from sdc_form9 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
	       $query=$sdc->query("insert into sdc_form9(user_id,sub_date,licence_no,location,homoeopathic,reg_fees) values ('$swr_id','$today', '$licence_no','$location','$homoeopathic','$reg_fees')") OR die("Error: ".$sdc->error);
	}else{  ////////////table is not empty//////////////
			$form_id=$row["form_id"];	
			$query=$sdc->query("update sdc_form9 set sub_date='$today', licence_no='$licence_no', location='$location', homoeopathic='$homoeopathic',reg_fees='$reg_fees' where form_id=$form_id") OR die("Error: ".$sdc->error);
	}	
	if($query){
		$formFunctions->insert_incomplete_forms('sdc','9'); //sdc-- dept name and 1 -- form no 
		if($input_size!=0){					
		$k=$sdc->query("delete from sdc_form9_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$part1=$sdc->query("INSERT INTO sdc_form9_t1(id,form_id,slno,name,qualification,experience,responsible) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')") or die("error in insertion sdc_form9_t1".$sdc->error);
				}
			}
		echo "<script>
						alert('Successfully Saved....');
						window.location.href = 'preview.php?token=9';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href ='sdc_form9.php';
					</script>";
				}			
}

if(isset($_POST["proceed9"])){
	$query=$sdc->query("select form_id,save_mode,courier_details from sdc_form9 where user_id='$swr_id' and active='1'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'sdc_form9.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'sdc','9');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$sdc->query("update sdc_form9 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=sdc&form=9';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=9';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$sdc->query("update sdc_form9 set sub_date='$today',uain='$uain',save_mode='P' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'payment_section.php?token=9';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=9';
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
if(isset($_POST["payment9"])){	
	$query=$sdc->query("select uain,form_id from sdc_form9 where user_id='$swr_id' and save_mode='P'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'payment_section.php?token=9';
			</script>";
	}else{
		if(empty($_POST["offline_challan"]) || $_POST["offline_challan"]=='2' || $_POST["offline_challan"]=='3'){
			echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'payment_section.php?token=9';
			</script>";
		}else{
			$row=$query->fetch_array();
			$form_id=$row["form_id"];$uain=$row["uain"];	
			$offline_challan=$_POST["offline_challan"];$payment_mode=0;
			$save_query=$sdc->query("update sdc_form9 set offline_challan='$offline_challan',payment_mode='$payment_mode',save_mode='C',sub_date='$today' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				$formFunctions->file_update($offline_challan);
				$formFunctions->insert_applications($uain);
				$str=$formFunctions->getEmail_str($uain);
				/////////////////////////////SEND MAIL////////////////////////////////
				$user_email=$formFunctions->get_usermail($swr_id);
				$dept_email="esgoa.sdc@gmail.com";
				require_once "sdc_form9_print.php"; 
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
						window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=9&dept=sdc';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form9.php';
					</script>";
				}
			}else{
				echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form9.php';
					</script>";
			}			
		}
	}
}
if(isset($_POST["save10"])) {	
	$drug=clean($_POST["drug"]);$input_size=$_POST["hiddenval"];
	$reg_fees="40";
	$sql=$sdc->query("select form_id from sdc_form10 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
	       $query=$sdc->query("insert into sdc_form10(user_id,sub_date,drug,reg_fees) values ('$swr_id','$today', '$drug','$reg_fees')") OR die("Error: ".$sdc->error);
	}else{  ////////////table is not empty//////////////
			$form_id=$row["form_id"];	
			$query=$sdc->query("update sdc_form10 set sub_date='$today', drug='$drug',reg_fees='$reg_fees' where form_id=$form_id") OR die("Error: ".$sdc->error);
	}	
	if($query){
		$formFunctions->insert_incomplete_forms('sdc','10'); //sdc-- dept name and 1 -- form no 
		if($input_size!=0){					
		$k=$sdc->query("delete from sdc_form10_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$part1=$sdc->query("INSERT INTO sdc_form10_t1(id,form_id,slno,name,qualification,experience,responsible) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')") or die("error in insertion sdc_form9_t1".$sdc->error);
				}
			}
		echo "<script>
						alert('Successfully Saved....');
						window.location.href = 'preview.php?token=10';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href ='sdc_form10.php';
					</script>";
				}			
}

if(isset($_POST["proceed10"])){
	$query=$sdc->query("select form_id,save_mode,courier_details from sdc_form10 where user_id='$swr_id' and active='1'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'sdc_form10.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'sdc','10');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$sdc->query("update sdc_form10 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=sdc&form=10';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=10';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$sdc->query("update sdc_form10 set sub_date='$today',uain='$uain',save_mode='P' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'payment_section.php?token=10';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=10';
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
if(isset($_POST["payment10"])){	
	$query=$sdc->query("select uain,form_id from sdc_form10 where user_id='$swr_id' and save_mode='P'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'payment_section.php?token=10';
			</script>";
	}else{
		if(empty($_POST["offline_challan"]) || $_POST["offline_challan"]=='2' || $_POST["offline_challan"]=='3'){
			echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'payment_section.php?token=10';
			</script>";
		}else{
			$row=$query->fetch_array();
			$form_id=$row["form_id"];$uain=$row["uain"];	
			$offline_challan=$_POST["offline_challan"];$payment_mode=0;
			$save_query=$sdc->query("update sdc_form10 set offline_challan='$offline_challan',payment_mode='$payment_mode',save_mode='C',sub_date='$today' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				$formFunctions->file_update($offline_challan);
				$formFunctions->insert_applications($uain);
				$str=$formFunctions->getEmail_str($uain);
				/////////////////////////////SEND MAIL////////////////////////////////
				$user_email=$formFunctions->get_usermail($swr_id);
				$dept_email="esgoa.sdc@gmail.com";
				require_once "sdc_form10_print.php"; 
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
						window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=10&dept=sdc';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form10.php';
					</script>";
				}
			}else{
				echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form10.php';
					</script>";
			}			
		}
	}
}
?>