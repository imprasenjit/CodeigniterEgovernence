<?php
/* FORM 5 */

if(isset($_POST["save5"])){		
	$location=clean($_POST["location"]);$situated=clean($_POST["situated"]);$drug_name=clean($_POST["drug_name"]);$particulars=clean($_POST["particulars"]);
	
	
	if(empty($_POST["mfile1"]) || empty($_POST["mfile2"]) || empty($_POST["mfile3"]) || empty($_POST["mfile4"]) || empty($_POST["mfile5"]) || empty($_POST["mfile6"]) || empty($_POST["mfile7"]) || $_POST["mfile1"]=='2' || $_POST["mfile2"]=='2' || $_POST["mfile3"]=='2' || $_POST["mfile4"]=='2' || $_POST["mfile5"]=='2' || $_POST["mfile6"]=='2' || $_POST["mfile7"]=='2' || $_POST["mfile1"]=='3' || $_POST["mfile2"]=='3' || $_POST["mfile3"]=='3' || $_POST["mfile4"]=='3' || $_POST["mfile5"]=='3' || $_POST["mfile6"]=='3' || $_POST["mfile7"]=='3'){
		echo "<script>
			alert('Error in file / You didnot select any option.');
			window.location.href = 'sdc_form5.php';
		</script>";
	}else{		
		$file1=clean($_POST["mfile1"]);
		$file2=clean($_POST["mfile2"]);
		$file3=clean($_POST["mfile3"]);
		$file4=clean($_POST["mfile4"]);
		$file5=clean($_POST["mfile5"]);
		$file6=clean($_POST["mfile6"]);
		$file7=clean($_POST["mfile7"]);
		
	}
	
	if(!empty($_POST["dealer"]))	 $dealer=json_encode($_POST["dealer"]);
	else	$dealer=NULL;
	$reg_fees="40";
	$sql=$sdc->query("select form_id from sdc_form5 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$sdc->query("insert into sdc_form5(user_id,sub_date,location,situated,drug_name,particulars,dealer,reg_fees, file1, file2, file3, file4, file5, file6, file7) values ('$swr_id','$today', '$location', '$situated', '$drug_name', '$particulars', '$dealer','$reg_fees', '$file1', '$file2', '$file3', '$file4', '$file5', '$file6', '$file7')") OR die("Error: ".$sdc->error);
	}else{
		$form_id=$row["form_id"];	
		$query=$sdc->query("update sdc_form5 set sub_date='$today', location='$location',  situated='$situated',drug_name='$drug_name', particulars='$particulars', dealer='$dealer',reg_fees='$reg_fees', file1='$file1', file2='$file2', file3='$file3', file4='$file4', file5='$file5', file6='$file6', file7='$file7' where form_id=$form_id") OR die("Error: ".$sdc->error);
	}				
	
	if($query){
		
		if($file1=="SC" || $file2=="SC" ||  $file3=="SC" ||  $file4=="SC" ||  $file5=="SC" ||  $file6=="SC" ||  $file7=="SC" ){
			$save_query=$sdc->query("update sdc_form5 set courier_details='1',received_date=NULL, sub_date='$today' where form_id='$form_id'") or die($sdc->error);
			
		}else{
			$save_query=$sdc->query("update sdc_form5 set sub_date='$today',received_date='$today',courier_details=NULL where form_id='$form_id'") or die($sdc->error);
		}
		if($save_query){
			$formFunctions->file_update($file1);$formFunctions->file_update($file2);$formFunctions->file_update($file3);$formFunctions->file_update($file4);$formFunctions->file_update($file5);$formFunctions->file_update($file6);$formFunctions->file_update($file7);
			
			$formFunctions->insert_incomplete_forms('sdc','5'); //sdc-- dept name and 2 -- form no
			echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'preview.php?token=5';
			</script>";
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href ='sdc_form5.php';
			</script>";
		}			
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'sdc_form5.php';
		</script>";
	}	
	
}

if(isset($_POST["proceed5"])){
	$query=$sdc->query("select form_id,save_mode,courier_details from sdc_form5 where user_id='$swr_id' and active='1'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'sdc_form5.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'sdc','5');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$sdc->query("update sdc_form5 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=sdc&form=5';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=5';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$sdc->query("update sdc_form5 set sub_date='$today',uain='$uain',save_mode='P' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'payment_section.php?token=5';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=5';
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
if(isset($_POST["payment5"])){	
	$query=$sdc->query("select uain,form_id from sdc_form5 where user_id='$swr_id' and save_mode='P'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'payment_section.php?token=5';
			</script>";
	}else{
		if(empty($_POST["offline_challan"]) || $_POST["offline_challan"]=='2' || $_POST["offline_challan"]=='3'){
			echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'payment_section.php?token=5';
			</script>";
		}else{
			$row=$query->fetch_array();
			$form_id=$row["form_id"];$uain=$row["uain"];	
			$offline_challan=$_POST["offline_challan"];$payment_mode=0;
			$save_query=$sdc->query("update sdc_form5 set offline_challan='$offline_challan',payment_mode='$payment_mode',save_mode='C',sub_date='$today' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				$formFunctions->file_update($offline_challan);
				$formFunctions->insert_applications($uain);
				$str=$formFunctions->getEmail_str($uain);
				/////////////////////////////SEND MAIL////////////////////////////////
				$user_email=$formFunctions->get_usermail($swr_id);
				$dept_email="esgoa.sdc@gmail.com";
				require_once "sdc_form5_print.php"; 
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
						window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=5&dept=sdc';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form5.php';
					</script>";
				}
			}else{
				echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form5.php';
					</script>";
			}			
		}
	}
}
/* FORM 6 */

if(isset($_POST["save6"])){		
	$location=clean($_POST["location"]);$situated=clean($_POST["situated"]);$drug_name=clean($_POST["drug_name"]);$particulars=clean($_POST["particulars"]);
	
	
	if(empty($_POST["mfile1"]) || empty($_POST["mfile2"]) || empty($_POST["mfile3"]) || empty($_POST["mfile4"]) || empty($_POST["mfile5"]) || empty($_POST["mfile6"]) || empty($_POST["mfile7"]) || empty($_POST["mfile8"]) || $_POST["mfile1"]=='2' || $_POST["mfile2"]=='2' || $_POST["mfile3"]=='2' || $_POST["mfile4"]=='2' || $_POST["mfile5"]=='2' || $_POST["mfile6"]=='2' || $_POST["mfile7"]=='2' || $_POST["mfile8"]=='2' || $_POST["mfile1"]=='3' || $_POST["mfile2"]=='3' || $_POST["mfile3"]=='3' || $_POST["mfile4"]=='3' || $_POST["mfile5"]=='3' || $_POST["mfile6"]=='3' || $_POST["mfile7"]=='3' || $_POST["mfile8"]=='3'){
		echo "<script>
			alert('Error in file / You didnot select any option.');
			window.location.href = 'sdc_form6.php';
		</script>";
	}else{		
		$file1=clean($_POST["mfile1"]);
		$file2=clean($_POST["mfile2"]);
		$file3=clean($_POST["mfile3"]);
		$file4=clean($_POST["mfile4"]);
		$file5=clean($_POST["mfile5"]);
		$file6=clean($_POST["mfile6"]);
		$file7=clean($_POST["mfile7"]);
		$file8=clean($_POST["mfile8"]);
		
	}
	
	if(!empty($_POST["dealer"]))	 $dealer=json_encode($_POST["dealer"]);
	else	$dealer=NULL;
	$reg_fees="40";
	$sql=$sdc->query("select form_id from sdc_form6 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$sdc->query("insert into sdc_form6(user_id,sub_date,location,situated,drug_name,particulars,dealer,reg_fees, file1, file2, file3, file4, file5, file6, file7, file8) values ('$swr_id','$today', '$location', '$situated', '$drug_name', '$particulars', '$dealer','$reg_fees', '$file1', '$file2', '$file3', '$file4', '$file5', '$file6', '$file7', '$file8')") OR die("Error: ".$sdc->error);
	}else{
		$form_id=$row["form_id"];	
		$query=$sdc->query("update sdc_form6 set sub_date='$today', location='$location',  situated='$situated',drug_name='$drug_name', particulars='$particulars', dealer='$dealer',reg_fees='$reg_fees', file1='$file1', file2='$file2', file3='$file3', file4='$file4', file5='$file5', file6='$file6', file7='$file7', file8='$file8' where form_id=$form_id") OR die("Error: ".$sdc->error);
	}				
	
     if($query){
		
		if($file1=="SC" || $file2=="SC" ||  $file3=="SC" ||  $file4=="SC" ||  $file5=="SC" ||  $file6=="SC" ||  $file7=="SC" || $file8=="SC"){
			$save_query=$sdc->query("update sdc_form6 set courier_details='1',received_date=NULL, sub_date='$today' where form_id='$form_id'") or die($sdc->error);
			$form_id=$sdc->insert_id;
			
		}else{
			$save_query=$sdc->query("update sdc_form6 set sub_date='$today',received_date='$today',courier_details=NULL where form_id='$form_id'") or die($sdc->error);
		}
		if($save_query){
			$formFunctions->file_update($file1);$formFunctions->file_update($file2);$formFunctions->file_update($file3);$formFunctions->file_update($file4);$formFunctions->file_update($file5);$formFunctions->file_update($file6);$formFunctions->file_update($file7);$formFunctions->file_update($file8);
			
			$formFunctions->insert_incomplete_forms('sdc','6'); //sdc-- dept name and 6 -- form no
			echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'preview.php?token=6';
			</script>";
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href ='sdc_form6.php';
			</script>";
		}			
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'sdc_form6.php';
		</script>";
	}									
}
if(isset($_POST["proceed6"])){
	$query=$sdc->query("select form_id,save_mode,courier_details from sdc_form6 where user_id='$swr_id' and active='1'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'sdc_form6.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'sdc','6');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$sdc->query("update sdc_form6 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=sdc&form=6';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=6';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$sdc->query("update sdc_form6 set sub_date='$today',uain='$uain',save_mode='P' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'payment_section.php?token=6';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=6';
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
if(isset($_POST["payment6"])){	
	$query=$sdc->query("select uain,form_id from sdc_form6 where user_id='$swr_id' and save_mode='P'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'payment_section.php?token=6';
			</script>";
	}else{
		if(empty($_POST["offline_challan"]) || $_POST["offline_challan"]=='2' || $_POST["offline_challan"]=='3'){
			echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'payment_section.php?token=6';
			</script>";
		}else{
			$row=$query->fetch_array();
			$form_id=$row["form_id"];$uain=$row["uain"];	
			$offline_challan=$_POST["offline_challan"];$payment_mode=0;
			$save_query=$sdc->query("update sdc_form6 set offline_challan='$offline_challan',payment_mode='$payment_mode',save_mode='C',sub_date='$today' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				$formFunctions->file_update($offline_challan);
				$formFunctions->insert_applications($uain);
				$str=$formFunctions->getEmail_str($uain);
				/////////////////////////////SEND MAIL////////////////////////////////
				$user_email=$formFunctions->get_usermail($swr_id);
				$dept_email="esgoa.sdc@gmail.com";
				require_once "sdc_form6_print.php"; 
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
						window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=6&dept=sdc';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form6.php';
					</script>";
				}
			}else{
				echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form6.php';
					</script>";
			}			
		}
	}
}
/* FORM 31 */

if(isset($_POST["save31"])){		
	$location=clean($_POST["location"]);$situated=clean($_POST["situated"]);$drug_name=clean($_POST["drug_name"]);$particulars=clean($_POST["particulars"]);
	
	
	if(empty($_POST["mfile1"]) || empty($_POST["mfile2"]) || $_POST["mfile1"]=='2' || $_POST["mfile2"]=='2' || $_POST["mfile1"]=='3' || $_POST["mfile2"]=='3'){
		echo "<script>
			alert('Error in file / You didnot select any option.');
			window.location.href = 'sdc_form31.php';
		</script>";
	}else{		
		$file1=clean($_POST["mfile1"]);
		$file2=clean($_POST["mfile2"]);
	
	}
	
	if(!empty($_POST["dealer"]))	 $dealer=json_encode($_POST["dealer"]);
	else	$dealer=NULL;
	$reg_fees="40";
	$sql=$sdc->query("select form_id from sdc_form31 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$sdc->query("insert into sdc_form31(user_id,sub_date,location,situated,drug_name,particulars,dealer,reg_fees, file1, file2) values ('$swr_id','$today', '$location', '$situated', '$drug_name', '$particulars', '$dealer','$reg_fees', '$file1', '$file2')") OR die("Error: ".$sdc->error);
	}else{
		$form_id=$row["form_id"];	
		$query=$sdc->query("update sdc_form31 set sub_date='$today', location='$location',  situated='$situated',drug_name='$drug_name', particulars='$particulars', dealer='$dealer',reg_fees='$reg_fees', file1='$file1', file2='$file2' where form_id=$form_id") OR die("Error: ".$sdc->error);
	}				
	if($query){
		$formFunctions->insert_incomplete_forms('sdc','31'); //sdc-- dept name and 31 -- form no 
					echo "<script>
						alert('Successfully Saved....');
						window.location.href = 'preview.php?token=31';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href ='sdc_form31.php';
					</script>";
				}	
			if($query){
		
		if($file1=="SC" || $file2=="SC" ){
			$save_query=$sdc->query("update sdc_form31 set courier_details='1',received_date=NULL, sub_date='$today' where form_id='$form_id'") or die($sdc->error);
		}else{
			$save_query=$sdc->query("update sdc_form31 set sub_date='$today',received_date='$today',courier_details=NULL where form_id='$form_id'") or die($sdc->error);
		}
		if($save_query){
			$formFunctions->file_update($file1);$formFunctions->file_update($file2);
			
			$formFunctions->insert_incomplete_forms('sdc','31'); //sdc-- dept name and 1 -- form no
			echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'preview.php?token=31';
			</script>";
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href ='sdc_form31.php';
			</script>";
		}			
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'sdc_form31.php';
		</script>";
	}							
}
if(isset($_POST["proceed31"])){
	$query=$sdc->query("select form_id,save_mode,courier_details from sdc_form31 where user_id='$swr_id' and active='1'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'sdc_form31.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'sdc','31');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$sdc->query("update sdc_form31 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=sdc&form=31';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=31';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$sdc->query("update sdc_form31 set sub_date='$today',uain='$uain',save_mode='P' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'payment_section.php?token=31';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=31';
				</script>";
			}
		}else{
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=31';
				</script>";
		}
	}
}
if(isset($_POST["payment31"])){	
	$query=$sdc->query("select uain,form_id from sdc_form31 where user_id='$swr_id' and save_mode='P'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'payment_section.php?token=31';
			</script>";
	}else{
		if(empty($_POST["offline_challan"]) || $_POST["offline_challan"]=='2' || $_POST["offline_challan"]=='3'){
			echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'payment_section.php?token=31';
			</script>";
		}else{
			$row=$query->fetch_array();
			$form_id=$row["form_id"];$uain=$row["uain"];	
			$offline_challan=$_POST["offline_challan"];$payment_mode=0;
			$save_query=$sdc->query("update sdc_form31 set offline_challan='$offline_challan',payment_mode='$payment_mode',save_mode='C',sub_date='$today' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				$formFunctions->file_update($offline_challan);
				$formFunctions->insert_applications($uain);
				$str=$formFunctions->getEmail_str($uain);
				/////////////////////////////SEND MAIL////////////////////////////////
				$user_email=$formFunctions->get_usermail($swr_id);
				$dept_email="esgoa.sdc@gmail.com";
				require_once "sdc_form31_print.php"; 
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
						window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=31&dept=sdc';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form31.php';
					</script>";
				}
			}else{
				echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form31.php';
					</script>";
			}			
		}
	}
}
/* FORM 32 */

if(isset($_POST["save32"])){		
	$location=clean($_POST["location"]);$situated=clean($_POST["situated"]);$drug_name=clean($_POST["drug_name"]);$particulars=clean($_POST["particulars"]);
	
	
	if(empty($_POST["mfile1"]) || empty($_POST["mfile2"]) || $_POST["mfile1"]=='2' || $_POST["mfile2"]=='2' || $_POST["mfile1"]=='3' || $_POST["mfile2"]=='3'){
		echo "<script>
			alert('Error in file / You didnot select any option.');
			window.location.href = 'sdc_form32.php';
		</script>";
	}else{		
		$file1=clean($_POST["mfile1"]);
		$file2=clean($_POST["mfile2"]);
	
	}
	
	if(!empty($_POST["dealer"]))	 $dealer=json_encode($_POST["dealer"]);
	else	$dealer=NULL;
	$reg_fees="40";
	$sql=$sdc->query("select form_id from sdc_form32 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$sdc->query("insert into sdc_form32(user_id,sub_date,location,situated,drug_name,particulars,dealer,reg_fees, file1, file2) values ('$swr_id','$today', '$location', '$situated', '$drug_name', '$particulars', '$dealer','$reg_fees', '$file1', '$file2')") OR die("Error: ".$sdc->error);
	}else{
		$form_id=$row["form_id"];	
		$query=$sdc->query("update sdc_form32 set sub_date='$today', location='$location',  situated='$situated',drug_name='$drug_name', particulars='$particulars', dealer='$dealer',reg_fees='$reg_fees', file1='$file1', file2='$file2' where form_id=$form_id") OR die("Error: ".$sdc->error);
	}				
	if($query){
		$formFunctions->insert_incomplete_forms('sdc','32'); //sdc-- dept name and 32 -- form no 
					echo "<script>
						alert('Successfully Saved....');
						window.location.href = 'preview.php?token=32';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href ='sdc_form32.php';
					</script>";
				}	
	if($query){
		
		if($file1=="SC" || $file2=="SC" ){
			$save_query=$sdc->query("update sdc_form32 set courier_details='1',received_date=NULL, sub_date='$today' where form_id='$form_id'") or die($sdc->error);
		}else{
			$save_query=$sdc->query("update sdc_form32 set sub_date='$today',received_date='$today',courier_details=NULL where form_id='$form_id'") or die($sdc->error);
		}
		if($save_query){
			$formFunctions->file_update($file1);$formFunctions->file_update($file2);
			
			$formFunctions->insert_incomplete_forms('sdc','32'); //sdc-- dept name and 1 -- form no
			echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'preview.php?token=32';
			</script>";
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href ='sdc_form32.php';
			</script>";
		}			
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'sdc_form32.php';
		</script>";
	}							
}
if(isset($_POST["proceed32"])){
	$query=$sdc->query("select form_id,save_mode,courier_details from sdc_form32 where user_id='$swr_id' and active='1'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'sdc_form32.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'sdc','32');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$sdc->query("update sdc_form32 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=sdc&form=32';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=32';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$sdc->query("update sdc_form32 set sub_date='$today',uain='$uain',save_mode='P' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'payment_section.php?token=32';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=32';
				</script>";
			}
		}else{
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=32';
				</script>";
		}
	}
}
if(isset($_POST["payment32"])){	
	$query=$sdc->query("select uain,form_id from sdc_form32 where user_id='$swr_id' and save_mode='P'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'payment_section.php?token=32';
			</script>";
	}else{
		if(empty($_POST["offline_challan"]) || $_POST["offline_challan"]=='2' || $_POST["offline_challan"]=='3'){
			echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'payment_section.php?token=32';
			</script>";
		}else{
			$row=$query->fetch_array();
			$form_id=$row["form_id"];$uain=$row["uain"];	
			$offline_challan=$_POST["offline_challan"];$payment_mode=0;
			$save_query=$sdc->query("update sdc_form32 set offline_challan='$offline_challan',payment_mode='$payment_mode',save_mode='C',sub_date='$today' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				$formFunctions->file_update($offline_challan);
				$formFunctions->insert_applications($uain);
				$str=$formFunctions->getEmail_str($uain);
				/////////////////////////////SEND MAIL////////////////////////////////
				$user_email=$formFunctions->get_usermail($swr_id);
				$dept_email="esgoa.sdc@gmail.com";
				require_once "sdc_form32_print.php"; 
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
						window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=32&dept=sdc';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form32.php';
					</script>";
				}
			}else{
				echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form32.php';
					</script>";
			}			
		}
	}
}

if(isset($_POST["save12"])) {	
	$licence_no=clean($_POST["licence_no"]);$location=clean($_POST["location"]);$homoeopathic=clean($_POST["homoeopathic"]);$input_size=$_POST["hiddenval"];
	
	
	if(empty($_POST["mfile1"]) || empty($_POST["mfile2"]) || empty($_POST["mfile3"]) || empty($_POST["mfile4"]) || empty($_POST["mfile5"]) || empty($_POST["mfile6"]) || empty($_POST["mfile7"]) || $_POST["mfile1"]=='2' || $_POST["mfile2"]=='2' || $_POST["mfile3"]=='2' || $_POST["mfile4"]=='2' || $_POST["mfile5"]=='2' || $_POST["mfile6"]=='2' || $_POST["mfile7"]=='2' || $_POST["mfile1"]=='3' || $_POST["mfile2"]=='3' || $_POST["mfile3"]=='3' || $_POST["mfile4"]=='3' || $_POST["mfile5"]=='3' || $_POST["mfile6"]=='3' || $_POST["mfile7"]=='3'){
		echo "<script>
			alert('Error in file / You didnot select any option.');
			window.location.href = 'sdc_form12.php';
		</script>";
	}else{		
		$file1=clean($_POST["mfile1"]);
		$file2=clean($_POST["mfile2"]);
		$file3=clean($_POST["mfile3"]);
		$file4=clean($_POST["mfile4"]);
		$file5=clean($_POST["mfile5"]);
		$file6=clean($_POST["mfile6"]);
		$file7=clean($_POST["mfile7"]);
		
	}
	
	$reg_fees="40";
	$sql=$sdc->query("select form_id from sdc_form12 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
	      $query=$sdc->query("insert into sdc_form12(user_id,sub_date,licence_no,location,homoeopathic,reg_fees, file1, file2, file3, file4, file5, file6, file7) values ('$swr_id','$today', '$licence_no','$location','$homoeopathic','$reg_fees', '$file1', '$file2', '$file3', '$file4', '$file5', '$file6', '$file7')") OR die("Error: ".$sdc->error);
		   $form_id=$sdc->insert_id;
	}else{  ////////////table is not empty//////////////
			$form_id=$row["form_id"];	
			$query=$sdc->query("update sdc_form12 set sub_date='$today', licence_no='$licence_no', location='$location', homoeopathic='$homoeopathic',reg_fees='$reg_fees' file1='$file1', file2='$file2', file3='$file3', file4='$file4', file5='$file5', file6='$file6', file7='$file7' where form_id=$form_id") OR die("Error: ".$sdc->error);
	}	
	if($query){
		$formFunctions->insert_incomplete_forms('sdc','12'); //sdc-- dept name and 12 -- form no 
		if($input_size!=0){					
		$k=$sdc->query("delete from sdc_form12_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$part1=$sdc->query("INSERT INTO sdc_form12_t1(id,form_id,slno,name,qualification,experience,responsible) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')") or die("error in insertion sdc_form12_t1".$sdc->error);
				}
			}
		echo "<script>
						alert('Successfully Saved....');
						window.location.href = 'preview.php?token=12';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href ='sdc_form12.php';
					</script>";
				}	
     if($query){
		
		if($file1=="SC" || $file2=="SC" ||  $file3=="SC" ||  $file4=="SC" ||  $file5=="SC" ||  $file6=="SC" || $file7=="SC" ){
			$save_query=$sdc->query("update sdc_form12 set courier_details='1',received_date=NULL, sub_date='$today' where form_id='$form_id'") or die($sdc->error);
		}else{
			$save_query=$sdc->query("update sdc_form12 set sub_date='$today',received_date='$today',courier_details=NULL where form_id='$form_id'") or die($sdc->error);
		}
		if($save_query){
			$formFunctions->file_update($file1);$formFunctions->file_update($file2);$formFunctions->file_update($file3);$formFunctions->file_update($file4);$formFunctions->file_update($file5);$formFunctions->file_update($file6);
			$formFunctions->file_update($file7);
			$formFunctions->insert_incomplete_forms('sdc','12'); //sdc-- dept name and 2 -- form no
			echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'preview.php?token=12';
			</script>";
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href ='sdc_form12.php';
			</script>";
		}			
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'sdc_form12.php';
		</script>";
	}					
				
}

if(isset($_POST["proceed12"])){
	$query=$sdc->query("select form_id,save_mode,courier_details from sdc_form12 where user_id='$swr_id' and active='1'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'sdc_form12.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'sdc','12');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$sdc->query("update sdc_form12 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=sdc&form=12';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=12';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$sdc->query("update sdc_form12 set sub_date='$today',uain='$uain',save_mode='P' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'payment_section.php?token=12';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=12';
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
if(isset($_POST["payment12"])){	
	$query=$sdc->query("select uain,form_id from sdc_form12 where user_id='$swr_id' and save_mode='P'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'payment_section.php?token=12';
			</script>";
	}else{
		if(empty($_POST["offline_challan"]) || $_POST["offline_challan"]=='2' || $_POST["offline_challan"]=='3'){
			echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'payment_section.php?token=12';
			</script>";
		}else{
			$row=$query->fetch_array();
			$form_id=$row["form_id"];$uain=$row["uain"];	
			$offline_challan=$_POST["offline_challan"];$payment_mode=0;
			$save_query=$sdc->query("update sdc_form12 set offline_challan='$offline_challan',payment_mode='$payment_mode',save_mode='C',sub_date='$today' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				$formFunctions->file_update($offline_challan);
				$formFunctions->insert_applications($uain);
				$str=$formFunctions->getEmail_str($uain);
				/////////////////////////////SEND MAIL////////////////////////////////
				$user_email=$formFunctions->get_usermail($swr_id);
				$dept_email="esgoa.sdc@gmail.com";
				require_once "sdc_form12_print.php"; 
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
						window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=12&dept=sdc';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form12.php';
					</script>";
				}
			}else{
				echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form12.php';
					</script>";
			}			
		}
	}
}
if(isset($_POST["save38"])) {	
	$licence_no=clean($_POST["licence_no"]);$location=clean($_POST["location"]);$homoeopathic=clean($_POST["homoeopathic"]);$input_size=$_POST["hiddenval"];
	
	
	if(empty($_POST["mfile1"]) || empty($_POST["mfile2"]) || $_POST["mfile1"]=='2' || $_POST["mfile2"]=='2' || $_POST["mfile1"]=='3' || $_POST["mfile2"]=='3'){
		echo "<script>
			alert('Error in file / You didnot select any option.');
			window.location.href = 'sdc_form38.php';
		</script>";
	}else{		
		$file1=clean($_POST["mfile1"]);
		$file2=clean($_POST["mfile2"]);
		
		
	}
	
	$reg_fees="40";
	$sql=$sdc->query("select form_id from sdc_form38 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
	      $query=$sdc->query("insert into sdc_form38(user_id,sub_date,licence_no,location,homoeopathic,reg_fees, file1, file2) values ('$swr_id','$today', '$licence_no','$location','$homoeopathic','$reg_fees', '$file1', '$file2')") OR die("Error: ".$sdc->error);
		   $form_id=$sdc->insert_id;
	}else{  ////////////table is not empty//////////////
			$form_id=$row["form_id"];	
			$query=$sdc->query("update sdc_form38 set sub_date='$today', licence_no='$licence_no', location='$location', homoeopathic='$homoeopathic',reg_fees='$reg_fees' file1='$file1', file2='$file2' where form_id=$form_id") OR die("Error: ".$sdc->error);
	}	
	if($query){
		$formFunctions->insert_incomplete_forms('sdc','38'); //sdc-- dept name and 38 -- form no 
		if($input_size!=0){					
		$k=$sdc->query("delete from sdc_form38_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$part1=$sdc->query("INSERT INTO sdc_form38_t1(id,form_id,slno,name,qualification,experience,responsible) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')") or die("error in insertion sdc_form38_t1".$sdc->error);
				}
			}
		echo "<script>
						alert('Successfully Saved....');
						window.location.href = 'preview.php?token=38';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href ='sdc_form38.php';
					</script>";
				}			
}

if(isset($_POST["proceed38"])){
	$query=$sdc->query("select form_id,save_mode,courier_details from sdc_form38 where user_id='$swr_id' and active='1'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'sdc_form38.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'sdc','38');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$sdc->query("update sdc_form38 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=sdc&form=38';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=38';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$sdc->query("update sdc_form38 set sub_date='$today',uain='$uain',save_mode='P' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'payment_section.php?token=38';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=38';
				</script>";
			}
		}else{
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=38';
				</script>";
		}
	}
}
if(isset($_POST["payment38"])){	
	$query=$sdc->query("select uain,form_id from sdc_form38 where user_id='$swr_id' and save_mode='P'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'payment_section.php?token=38';
			</script>";
	}else{
		if(empty($_POST["offline_challan"]) || $_POST["offline_challan"]=='2' || $_POST["offline_challan"]=='3'){
			echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'payment_section.php?token=38';
			</script>";
		}else{
			$row=$query->fetch_array();
			$form_id=$row["form_id"];$uain=$row["uain"];	
			$offline_challan=$_POST["offline_challan"];$payment_mode=0;
			$save_query=$sdc->query("update sdc_form38 set offline_challan='$offline_challan',payment_mode='$payment_mode',save_mode='C',sub_date='$today' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				$formFunctions->file_update($offline_challan);
				$formFunctions->insert_applications($uain);
				$str=$formFunctions->getEmail_str($uain);
				/////////////////////////////SEND MAIL////////////////////////////////
				$user_email=$formFunctions->get_usermail($swr_id);
				$dept_email="esgoa.sdc@gmail.com";
				require_once "sdc_form38_print.php"; 
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
						window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=38&dept=sdc';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form38.php';
					</script>";
				}
			}else{
				echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form38.php';
					</script>";
			}			
		}
	}
}



if(isset($_POST["save25"])){		
	$reg_no=clean($_POST["reg_no"]);$catrgories=clean($_POST["catrgories"]);$storage_acc=clean($_POST["storage_acc"]);
	
	
	
	if(empty($_POST["mfile1"]) || empty($_POST["mfile2"]) || empty($_POST["mfile3"]) || empty($_POST["mfile4"]) || empty($_POST["mfile5"]) || empty($_POST["mfile6"]) || $_POST["mfile1"]=='2' || $_POST["mfile2"]=='2' || $_POST["mfile3"]=='2' || $_POST["mfile4"]=='2' || $_POST["mfile5"]=='2' || $_POST["mfile6"]=='2' || $_POST["mfile1"]=='3' || $_POST["mfile2"]=='3' || $_POST["mfile3"]=='3' || $_POST["mfile4"]=='3' || $_POST["mfile5"]=='3' || $_POST["mfile6"]=='3'){
		echo "<script>
			alert('Error in file / You didnot select any option.');
			window.location.href = 'sdc_form25.php';
		</script>";
	}else{		
		$file1=clean($_POST["mfile1"]);
		$file2=clean($_POST["mfile2"]);
		$file3=clean($_POST["mfile3"]);
		$file4=clean($_POST["mfile4"]);
		$file5=clean($_POST["mfile5"]);
		$file6=clean($_POST["mfile6"]);
		
	}
	
	
	
	if(!empty($_POST["supervision"]))	 $supervision=json_encode($_POST["supervision"]);
	else	$supervision=NULL;
	$reg_fees="40";
	$sql=$sdc->query("select form_id from sdc_form25 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////	

$query=$sdc->query("insert into sdc_form25(user_id,sub_date,reg_no,catrgories,reg_fees,storage_acc,file1,file2,file3,file4,file5,file6) values ('$swr_id','$today', '$reg_no', '$catrgories', '$reg_fees','$storage_acc', '$file1', '$file2', '$file3', '$file4', '$file5', '$file6')") OR die("Error: ".$sdc->error);
	}else{
		$form_id=$row["form_id"];	
		$query=$sdc->query("update sdc_form25 set sub_date='$today', reg_no='$reg_no',  catrgories='$catrgories',reg_fees='$reg_fees',storage_acc='$storage_acc', file1='$file1', file2='$file2', file3='$file3', file4='$file4', file5='$file5', file6='$file6' where form_id=$form_id") OR die("Error: ".$sdc->error);
	}				
	if($query){
		$formFunctions->insert_incomplete_forms('sdc','25'); //sdc-- dept name and 1 -- form no
		echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'preview.php?token=25';
			</script>";			
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'sdc_form25.php';
		</script>";
	}
   if($query){
		
		if($file1=="SC" || $file2=="SC" ||  $file3=="SC" ||  $file4=="SC" ||  $file5=="SC" ||  $file6=="SC" ){
			$save_query=$sdc->query("update sdc_form25 set courier_details='1',received_date=NULL, sub_date='$today' where form_id='$form_id'") or die($sdc->error);
		}else{
			$save_query=$sdc->query("update sdc_form25 set sub_date='$today',received_date='$today',courier_details=NULL where form_id='$form_id'") or die($sdc->error);
		}
		if($save_query){
			$formFunctions->file_update($file1);$formFunctions->file_update($file2);$formFunctions->file_update($file3);$formFunctions->file_update($file4);$formFunctions->file_update($file5);$formFunctions->file_update($file6);
			
			$formFunctions->insert_incomplete_forms('sdc','25'); //sdc-- dept name and 1 -- form no
			echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'preview.php?token=25';
			</script>";
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href ='sdc_form25.php';
			</script>";
		}			
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'sdc_form25.php';
		</script>";
	}							
}
if(isset($_POST["proceed25"])){
	$query=$sdc->query("select form_id,save_mode,courier_details from sdc_form25 where user_id='$swr_id' and active='1'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'sdc_form25.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'sdc','25');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$sdc->query("update sdc_form25 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=sdc&form=25';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=25';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$sdc->query("update sdc_form25 set sub_date='$today',uain='$uain',save_mode='P' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'payment_section.php?token=25';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=25';
				</script>";
			}
		}else{
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=25';
				</script>";
		}
	}
}
if(isset($_POST["payment25"])){	
	$query=$sdc->query("select uain,form_id from sdc_form25 where user_id='$swr_id' and save_mode='P'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'payment_section.php?token=25';
			</script>";
	}else{
		if(empty($_POST["offline_challan"]) || $_POST["offline_challan"]=='2' || $_POST["offline_challan"]=='3'){
			echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'payment_section.php?token=25';
			</script>";
		}else{
			$row=$query->fetch_array();
			$form_id=$row["form_id"];$uain=$row["uain"];	
			$offline_challan=$_POST["offline_challan"];$payment_mode=0;
			$save_query=$sdc->query("update sdc_form25 set offline_challan='$offline_challan',payment_mode='$payment_mode',save_mode='C',sub_date='$today' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				$formFunctions->file_update($offline_challan);
				$formFunctions->insert_applications($uain);
				$str=$formFunctions->getEmail_str($uain);
				/////////////////////////////SEND MAIL////////////////////////////////
				$user_email=$formFunctions->get_usermail($swr_id);
				$dept_email="esgoa.sdc@gmail.com";
				require_once "sdc_form25_print.php"; 
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
						window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=25&dept=sdc';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form25.php';
					</script>";
				}
			}else{
				echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form25.php';
					</script>";
			}			
		}
	}
}
if(isset($_POST["save26"])){		
	$reg_no=clean($_POST["reg_no"]);$catrgories=clean($_POST["catrgories"]);$storage_acc=clean($_POST["storage_acc"]);
	
	
	
	/*if(empty($_POST["mfile1"]) || empty($_POST["mfile2"]) || empty($_POST["mfile3"]) || empty($_POST["mfile4"]) || empty($_POST["mfile5"]) || empty($_POST["mfile6"]) || $_POST["mfile1"]=='2' || $_POST["mfile2"]=='2' || $_POST["mfile3"]=='2' || $_POST["mfile4"]=='2' || $_POST["mfile5"]=='2' || $_POST["mfile6"]=='2' || $_POST["mfile1"]=='3' || $_POST["mfile2"]=='3' || $_POST["mfile3"]=='3' || $_POST["mfile4"]=='3' || $_POST["mfile5"]=='3' || $_POST["mfile6"]=='3'){
		echo "<script>
			alert('Error in file / You didnot select any option.');
			window.location.href = 'sdc_form26.php';
		</script>";
	}else{		
		$file1=clean($_POST["mfile1"]);
		$file2=clean($_POST["mfile2"]);
		$file3=clean($_POST["mfile3"]);
		$file4=clean($_POST["mfile4"]);
		$file5=clean($_POST["mfile5"]);
		$file6=clean($_POST["mfile6"]);
		
	}*/
	
	
	
	if(!empty($_POST["supervision"]))	 $supervision=json_encode($_POST["supervision"]);
	else	$supervision=NULL;
	$reg_fees="40";
	$sql=$sdc->query("select form_id from sdc_form26 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////	

$query=$sdc->query("insert into sdc_form26(user_id,sub_date,reg_no,catrgories,reg_fees,storage_acc) values ('$swr_id','$today', '$reg_no', '$catrgories', '$reg_fees','$storage_acc')") OR die("Error: ".$sdc->error);
	}else{
		$form_id=$row["form_id"];	
		$query=$sdc->query("update sdc_form26 set sub_date='$today', reg_no='$reg_no',  catrgories='$catrgories',reg_fees='$reg_fees',storage_acc='$storage_acc' where form_id=$form_id") OR die("Error: ".$sdc->error);
	}				
	if($query){
		$formFunctions->insert_incomplete_forms('sdc','26'); //sdc-- dept name and 26 -- form no
		echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'preview.php?token=26';
			</script>";			
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'sdc_form26.php';
		</script>";
	}	
			
}
if(isset($_POST["proceed26"])){
	$query=$sdc->query("select form_id,save_mode,courier_details from sdc_form26 where user_id='$swr_id' and active='1'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'sdc_form26.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'sdc','26');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$sdc->query("update sdc_form26 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=sdc&form=26';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=26';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$sdc->query("update sdc_form26 set sub_date='$today',uain='$uain',save_mode='P' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'payment_section.php?token=26';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=26';
				</script>";
			}
		}else{
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=26';
				</script>";
		}
	}
}
if(isset($_POST["payment26"])){	
	$query=$sdc->query("select uain,form_id from sdc_form26 where user_id='$swr_id' and save_mode='P'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'payment_section.php?token=26';
			</script>";
	}else{
		if(empty($_POST["offline_challan"]) || $_POST["offline_challan"]=='2' || $_POST["offline_challan"]=='3'){
			echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'payment_section.php?token=26';
			</script>";
		}else{
			$row=$query->fetch_array();
			$form_id=$row["form_id"];$uain=$row["uain"];	
			$offline_challan=$_POST["offline_challan"];$payment_mode=0;
			$save_query=$sdc->query("update sdc_form26 set offline_challan='$offline_challan',payment_mode='$payment_mode',save_mode='C',sub_date='$today' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				$formFunctions->file_update($offline_challan);
				$formFunctions->insert_applications($uain);
				$str=$formFunctions->getEmail_str($uain);
				/////////////////////////////SEND MAIL////////////////////////////////
				$user_email=$formFunctions->get_usermail($swr_id);
				$dept_email="esgoa.sdc@gmail.com";
				require_once "sdc_form26_print.php"; 
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
						window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=26&dept=sdc';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form26.php';
					</script>";
				}
			}else{
				echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form26.php';
					</script>";
			}			
		}
	}
}
if(isset($_POST["save16"])){		
	$drug_name=clean($_POST["drug_name"]);$staff_manuf=clean( $_POST["staff_manuf"]);
	
	if(empty($_POST["mfile1"]) || empty($_POST["mfile2"]) || empty($_POST["mfile3"]) || empty($_POST["mfile4"]) || empty($_POST["mfile5"]) || empty($_POST["mfile6"]) || empty($_POST["mfile7"]) || empty($_POST["mfile8"]) || empty($_POST["mfile9"])|| $_POST["mfile1"]=='2' || $_POST["mfile2"]=='2' || $_POST["mfile3"]=='2' || $_POST["mfile4"]=='2' || $_POST["mfile5"]=='2' || $_POST["mfile6"]=='2' || $_POST["mfile7"]=='2' || $_POST["mfile8"]=='2' || $_POST["mfile9"]=='2' || $_POST["mfile1"]=='3' || $_POST["mfile2"]=='3' || $_POST["mfile3"]=='3' || $_POST["mfile4"]=='3' || $_POST["mfile5"]=='3' || $_POST["mfile6"]=='3' || $_POST["mfile7"]=='3' || $_POST["mfile8"]=='3' || $_POST["mfile9"]=='3' ){
		echo "<script>
			alert('Error in file / You didnot select any option.');
			window.location.href = 'sdc_form16.php';
		</script>";
	}else{		
		$file1=clean($_POST["mfile1"]);
		$file2=clean($_POST["mfile2"]);
		$file3=clean($_POST["mfile3"]);
		$file4=clean($_POST["mfile4"]);
		$file5=clean($_POST["mfile5"]);
		$file6=clean($_POST["mfile6"]);
		$file7=clean($_POST["mfile7"]);
		$file8=clean($_POST["mfile8"]);
		$file9=clean($_POST["mfile9"]);
	}
	
	$input_size=$_POST["hiddenval"];$reg_fees="40";
	$sql=$sdc->query("select form_id from sdc_form16 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$sdc->query("insert into sdc_form16(user_id,sub_date,drug_name,staff_manuf,reg_fees, file1,file2, file3, file4, file5, file6, file7, file8, file9 ) values ('$swr_id','$today', '$drug_name','$staff_manuf','$reg_fees', '$file1', '$file2', '$file3', '$file4', '$file5', '$file6', '$file7', '$file8', '$file9')") OR die("Error: ".$sdc->error);
			$form_id=$sdc->insert_id;
	}else{
		$form_id=$row["form_id"];	
			$query=$sdc->query("update sdc_form16 set sub_date='$today',  drug_name='$drug_name',staff_manuf='$staff_manuf',reg_fees='$reg_fees', file1='$file1', file2='$file2', file3='$file3', file4='$file4', file5='$file5', file6='$file6', file7='$file7', file8='$file8', file9='$file9' where form_id=$form_id") OR die("Error: ".$sdc->error);			
	}				
	if($query){
		$formFunctions->insert_incomplete_forms('sdc','16'); //sdc-- dept name and 1 -- form no 
			if($input_size!=0){					
			$k=$sdc->query("delete from sdc_form16_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$part1=$sdc->query("INSERT INTO sdc_form16_t1(id,form_id,slno,name,qualification,experience,responsible) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')") or die("error in insertion sdc_form16_t1".$sdc->error);
				}
			}
		echo "<script>
						alert('Successfully Saved....');
						window.location.href = 'preview.php?token=16';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href ='sdc_form16.php';
					</script>";
				}		
      	if($query){
		
		if($file1=="SC" || $file2=="SC" ||  $file3=="SC" ||  $file4=="SC" ||  $file5=="SC" ||  $file6=="SC" || $file7=="SC" || $file8=="SC" || $file9=="SC" ){
			$save_query=$sdc->query("update sdc_form8 set courier_details='1',received_date=NULL, sub_date='$today' where form_id='$form_id'") or die($sdc->error);
		}else{
			$save_query=$sdc->query("update sdc_form8 set sub_date='$today',received_date='$today',courier_details=NULL where form_id='$form_id'") or die($sdc->error);
		}
		if($save_query){
			$formFunctions->file_update($file1);$formFunctions->file_update($file2);$formFunctions->file_update($file3);$formFunctions->file_update($file4);$formFunctions->file_update($file5);$formFunctions->file_update($file6);
			$formFunctions->file_update($file7);$formFunctions->file_update($file8);
			$formFunctions->file_update($file9);
			$formFunctions->insert_incomplete_forms('sdc','16'); //sdc-- dept name and 2 -- form no
			echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'preview.php?token=16';
			</script>";
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href ='sdc_form16.php';
			</script>";
		}			
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'sdc_form16.php';
		</script>";
	}					
}
		
if(isset($_POST["proceed16"])){
	$query=$sdc->query("select form_id,save_mode,courier_details from sdc_form16 where user_id='$swr_id' and active='1'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'sdc_form16.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'sdc','16');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$sdc->query("update sdc_form16 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=sdc&form=16';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=16';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$sdc->query("update sdc_form16 set sub_date='$today',uain='$uain',save_mode='P' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'payment_section.php?token=16';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=16';
				</script>";
			}
		}else{
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=16';
				</script>";
		}
	}
}
if(isset($_POST["payment16"])){	
	$query=$sdc->query("select uain,form_id from sdc_form16 where user_id='$swr_id' and save_mode='P'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'payment_section.php?token=16;
			</script>";
	}else{
		if(empty($_POST["offline_challan"]) || $_POST["offline_challan"]=='2' || $_POST["offline_challan"]=='3'){
			echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'payment_section.php?token=16;
			</script>";
		}else{
			$row=$query->fetch_array();
			$form_id=$row["form_id"];$uain=$row["uain"];	
			$offline_challan=$_POST["offline_challan"];$payment_mode=0;
			$save_query=$sdc->query("update sdc_form16 set offline_challan='$offline_challan',payment_mode='$payment_mode',save_mode='C',sub_date='$today' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				$formFunctions->file_update($offline_challan);
				$formFunctions->insert_applications($uain);
				$str=$formFunctions->getEmail_str($uain);
				/////////////////////////////SEND MAIL////////////////////////////////
				$user_email=$formFunctions->get_usermail($swr_id);
				$dept_email="esgoa.sdc@gmail.com";
				require_once "sdc_form16_print.php"; 
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
						window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=16&dept=sdc';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form16.php';
					</script>";
				}
			}else{
				echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form16.php';
					</script>";
			}			
		}
	}
}
if(isset($_POST["save42"])){		
	$drug_name=clean($_POST["drug_name"]);$staff_manuf=clean( $_POST["staff_manuf"]);
	
	if(empty($_POST["mfile1"]) || empty($_POST["mfile2"]) || $_POST["mfile1"]=='2' || $_POST["mfile2"]=='2' || $_POST["mfile1"]=='3' || $_POST["mfile2"]=='3'){
		echo "<script>
			alert('Error in file / You didnot select any option.');
			window.location.href = 'sdc_form42.php';
		</script>";
	}else{		
		$file1=clean($_POST["mfile1"]);
		$file2=clean($_POST["mfile2"]);
	
	}
	
	$input_size=$_POST["hiddenval"];$reg_fees="40";
	$sql=$sdc->query("select form_id from sdc_form42 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$sdc->query("insert into sdc_form42(user_id,sub_date,drug_name,staff_manuf,reg_fees, file1,file2) values ('$swr_id','$today', '$drug_name','$staff_manuf','$reg_fees', '$file1', '$file2')") OR die("Error: ".$sdc->error);
			$form_id=$sdc->insert_id;
	}else{
		$form_id=$row["form_id"];	
			$query=$sdc->query("update sdc_form42 set sub_date='$today',  drug_name='$drug_name',staff_manuf='$staff_manuf',reg_fees='$reg_fees', file1='$file1', file2='$file2' where form_id=$form_id") OR die("Error: ".$sdc->error);			
	}

	if($query){
		if($file1=="SC" || $file2=="SC"){
			$save_query=$sdc->query("update sdc_form42 set courier_details='1',received_date=NULL, sub_date='$today' where form_id='$form_id'") or die($sdc->error);
		}else{
			$save_query=$sdc->query("update sdc_form42 set sub_date='$today',received_date='$today',courier_details=NULL where form_id='$form_id'") or die($sdc->error);
		}
		if($save_query){
			$formFunctions->file_update($file1);$formFunctions->file_update($file2);
			$formFunctions->insert_incomplete_forms('sdc','42'); //sdc-- dept name and 42 -- form no 
			if($input_size!=0){					
			$k=$sdc->query("delete from sdc_form42_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$part1=$sdc->query("INSERT INTO sdc_form42_t1(id,form_id,slno,name,qualification,experience,responsible) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')") or die("error in insertion sdc_form42_t1".$sdc->error);
				}
			}
		echo "<script>
						alert('Successfully Saved....');
						window.location.href = 'preview.php?token=42';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href ='sdc_form42.php';
					</script>";
				}			
}
		
if(isset($_POST["proceed42"])){
	$query=$sdc->query("select form_id,save_mode,courier_details from sdc_form42 where user_id='$swr_id' and active='1'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'sdc_form42.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'sdc','42');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$sdc->query("update sdc_form42 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=sdc&form=42';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=42';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$sdc->query("update sdc_form42 set sub_date='$today',uain='$uain',save_mode='P' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'payment_section.php?token=42';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=42';
				</script>";
			}
		}else{
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=42';
				</script>";
		}
	}
}
if(isset($_POST["payment42"])){	
	$query=$sdc->query("select uain,form_id from sdc_form42 where user_id='$swr_id' and save_mode='P'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'payment_section.php?token=42;
			</script>";
	}else{
		if(empty($_POST["offline_challan"]) || $_POST["offline_challan"]=='2' || $_POST["offline_challan"]=='3'){
			echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'payment_section.php?token=42;
			</script>";
		}else{
			$row=$query->fetch_array();
			$form_id=$row["form_id"];$uain=$row["uain"];	
			$offline_challan=$_POST["offline_challan"];$payment_mode=0;
			$save_query=$sdc->query("update sdc_form42 set offline_challan='$offline_challan',payment_mode='$payment_mode',save_mode='C',sub_date='$today' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				$formFunctions->file_update($offline_challan);
				$formFunctions->insert_applications($uain);
				$str=$formFunctions->getEmail_str($uain);
				/////////////////////////////SEND MAIL////////////////////////////////
				$user_email=$formFunctions->get_usermail($swr_id);
				$dept_email="esgoa.sdc@gmail.com";
				require_once "sdc_form42_print.php"; 
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
						window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=42&dept=sdc';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form42.php';
					</script>";
				}
			}else{
				echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form42.php';
					</script>";
			}			
		}
	}
}
if(isset($_POST["save17"])){		
	$license_no=clean($_POST["license_no"]);$license_date=clean( $_POST["license_date"]);$staff_manuf=clean( $_POST["staff_manuf"]);
	
	if(empty($_POST["mfile1"]) || empty($_POST["mfile2"]) || empty($_POST["mfile3"]) || empty($_POST["mfile4"]) || empty($_POST["mfile5"]) || empty($_POST["mfile6"]) || empty($_POST["mfile7"]) || $_POST["mfile1"]=='2' || $_POST["mfile2"]=='2' || $_POST["mfile3"]=='2' || $_POST["mfile4"]=='2' || $_POST["mfile5"]=='2' || $_POST["mfile6"]=='2' || $_POST["mfile7"]=='2' ||  $_POST["mfile1"]=='3' || $_POST["mfile2"]=='3' || $_POST["mfile3"]=='3' || $_POST["mfile4"]=='3' || $_POST["mfile5"]=='3' || $_POST["mfile6"]=='3' || $_POST["mfile7"]=='3'){
		echo "<script>
			alert('Error in file / You didnot select any option.');
			window.location.href = 'sdc_form17.php';
		</script>";
	}else{		
		$file1=clean($_POST["mfile1"]);
		$file2=clean($_POST["mfile2"]);
		$file3=clean($_POST["mfile3"]);
		$file4=clean($_POST["mfile4"]);
		$file5=clean($_POST["mfile5"]);
		$file6=clean($_POST["mfile6"]);
		$file7=clean($_POST["mfile7"]);
		
	}
	
	$input_size=$_POST["hiddenval"];$input_size2=$_POST["hiddenval2"];$reg_fees="40";
	$sql=$sdc->query("select form_id from sdc_form17 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$sdc->query("insert into sdc_form17(user_id,sub_date,license_no,license_date,staff_manuf,reg_fees, file1, file2, file3, file4, file5, file6, file7) values ('$swr_id','$today', '$license_no','$license_date','$staff_manuf','$reg_fees', '$file1', '$file2', '$file3', '$file4', '$file5', '$file6', '$file7')") OR die("Error: ".$sdc->error);
			$form_id=$sdc->insert_id;
	}else{
		$form_id=$row["form_id"];	
		$query=$sdc->query("update sdc_form17 set sub_date='$today',  license_no='$license_no',license_date='$license_date',staff_manuf='$staff_manuf',reg_fees='$reg_fees', file1='$file1', file2='$file2', file3='$file3', file4='$file4', file5='$file5', file6='$file6', file7='$file7' where form_id=$form_id") OR die("Error: ".$sdc->error);		
	}				
	if($query){
		$formFunctions->insert_incomplete_forms('sdc','17'); //sdc-- dept name and 17 -- form no 
			if($input_size!=0){					
			$k=$sdc->query("delete from sdc_form17_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txttB".$i];
				$part1=$sdc->query("INSERT INTO sdc_form17_t1(id,form_id,slno,name) VALUES ('','$form_id','$i','$valb')") or die("error in insertion sdc_form17_t1".$sdc->error);
				}
			}
			if($input_size2!=0){					
			$k=$sdc->query("delete from sdc_form17_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$part2=$sdc->query("INSERT INTO sdc_form17_t2(id,form_id,slno,name,qualification,experience,responsible) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')") or die("error in insertion sdc_form17_t2".$sdc->error);
				}
			}
		echo "<script>
						alert('Successfully Saved....');
						window.location.href = 'preview.php?token=17';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href ='sdc_form17.php';
					</script>";
				}	
        if($query){
		
		if($file1=="SC" || $file2=="SC" ||  $file3=="SC" ||  $file4=="SC" ||  $file5=="SC" ||  $file6=="SC"  || $file7=="SC"){
			$save_query=$sdc->query("update sdc_form17 set courier_details='1',received_date=NULL, sub_date='$today' where form_id='$form_id'") or die($sdc->error);
		}else{
			$save_query=$sdc->query("update sdc_form17 set sub_date='$today',received_date='$today',courier_details=NULL where form_id='$form_id'") or die($sdc->error);
		}
		if($save_query){
			$formFunctions->file_update($file1);$formFunctions->file_update($file2);$formFunctions->file_update($file3);$formFunctions->file_update($file4);$formFunctions->file_update($file5);$formFunctions->file_update($file6);
			$formFunctions->file_update($file7);
			$formFunctions->insert_incomplete_forms('sdc','17'); //sdc-- dept name and 2 -- form no
			echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'preview.php?token=17';
			</script>";
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href ='sdc_form17.php';
			</script>";
		}			
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'sdc_form17.php';
		</script>";
	}								
}
if(isset($_POST["proceed17"])){
	$query=$sdc->query("select form_id,save_mode,courier_details from sdc_form17 where user_id='$swr_id' and active='1'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'sdc_form17.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'sdc','17');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$sdc->query("update sdc_form17 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=sdc&form=17';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=17';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$sdc->query("update sdc_form17 set sub_date='$today',uain='$uain',save_mode='P' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'payment_section.php?token=17';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=17';
				</script>";
			}
		}else{
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=17';
				</script>";
		}
	}
}
if(isset($_POST["payment17"])){	
	$query=$sdc->query("select uain,form_id from sdc_form17 where user_id='$swr_id' and save_mode='P'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'payment_section.php?token=17;
			</script>";
	}else{
		if(empty($_POST["offline_challan"]) || $_POST["offline_challan"]=='2' || $_POST["offline_challan"]=='3'){
			echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'payment_section.php?token=17;
			</script>";
		}else{
			$row=$query->fetch_array();
			$form_id=$row["form_id"];$uain=$row["uain"];	
			$offline_challan=$_POST["offline_challan"];$payment_mode=0;
			$save_query=$sdc->query("update sdc_form17 set offline_challan='$offline_challan',payment_mode='$payment_mode',save_mode='C',sub_date='$today' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				$formFunctions->file_update($offline_challan);
				$formFunctions->insert_applications($uain);
				$str=$formFunctions->getEmail_str($uain);
				/////////////////////////////SEND MAIL////////////////////////////////
				$user_email=$formFunctions->get_usermail($swr_id);
				$dept_email="esgoa.sdc@gmail.com";
				require_once "sdc_form17_print.php"; 
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
						window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=17&dept=sdc';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form17.php';
					</script>";
				}
			}else{
				echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form17.php';
					</script>";
			}			
		}
	}
}
if(isset($_POST["save43"])){		
	$license_no=clean($_POST["license_no"]);$license_date=clean( $_POST["license_date"]);$staff_manuf=clean( $_POST["staff_manuf"]);
	
	if(empty($_POST["mfile1"]) || empty($_POST["mfile2"]) || empty($_POST["mfile3"]) || $_POST["mfile1"]=='2' || $_POST["mfile2"]=='2' || $_POST["mfile3"]=='2' ||  $_POST["mfile1"]=='3' || $_POST["mfile2"]=='3' || $_POST["mfile3"]=='3'){
		echo "<script>
			alert('Error in file / You didnot select any option.');
			window.location.href = 'sdc_form43.php';
		</script>";
	}else{		
		$file1=clean($_POST["mfile1"]);
		$file2=clean($_POST["mfile2"]);
		$file3=clean($_POST["mfile3"]);
		
		
	}
	
	$input_size=$_POST["hiddenval"];$input_size2=$_POST["hiddenval2"];$reg_fees="40";
	$sql=$sdc->query("select form_id from sdc_form43 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$sdc->query("insert into sdc_form43(user_id,sub_date,license_no,license_date,staff_manuf,reg_fees, file1, file2, file3) values ('$swr_id','$today', '$license_no','$license_date','$staff_manuf','$reg_fees', '$file1', '$file2', '$file3')") OR die("Error: ".$sdc->error);
			$form_id=$sdc->insert_id;
	}else{
		$form_id=$row["form_id"];	
		$query=$sdc->query("update sdc_form43 set sub_date='$today',  license_no='$license_no',license_date='$license_date',staff_manuf='$staff_manuf',reg_fees='$reg_fees', file1='$file1', file2='$file2', file3='$file3' where form_id=$form_id") OR die("Error: ".$sdc->error);		
	}				
	if($query){
		if($file1=="SC" || $file2=="SC" || $file3=="SC" ){
			$save_query=$sdc->query("update sdc_form43 set courier_details='1',received_date=NULL, sub_date='$today' where form_id='$form_id'") or die($sdc->error);
		}else{
			$save_query=$sdc->query("update sdc_form43 set sub_date='$today',received_date='$today',courier_details=NULL where form_id='$form_id'") or die($sdc->error);
		}
		if($save_query){
			$formFunctions->file_update($file1);$formFunctions->file_update($file2);$formFunctions->file_update($file3);
			$formFunctions->insert_incomplete_forms('sdc','43'); //sdc-- dept name and 43 -- form no 
			if($input_size!=0){					
			$k=$sdc->query("delete from sdc_form43_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txttB".$i];
				$part1=$sdc->query("INSERT INTO sdc_form43_t1(id,form_id,slno,name) VALUES ('','$form_id','$i','$valb')") or die("error in insertion sdc_form43_t1".$sdc->error);
				}
			}
			if($input_size2!=0){					
			$k=$sdc->query("delete from sdc_form43_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$part2=$sdc->query("INSERT INTO sdc_form43_t2(id,form_id,slno,name,qualification,experience,responsible) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')") or die("error in insertion sdc_form43_t2".$sdc->error);
				}
			}
			echo "<script>
						alert('Successfully Saved....');
						window.location.href = 'preview.php?token=43';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href ='sdc_form43.php';
					</script>";
				}
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href ='sdc_form43.php';
		</script>";
	}	
 					
}
if(isset($_POST["proceed43"])){
	$query=$sdc->query("select form_id,save_mode,courier_details from sdc_form43 where user_id='$swr_id' and active='1'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'sdc_form43.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'sdc','43');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$sdc->query("update sdc_form43 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=sdc&form=43';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=43';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$sdc->query("update sdc_form43 set sub_date='$today',uain='$uain',save_mode='P' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'payment_section.php?token=43';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=43';
				</script>";
			}
		}else{
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=43';
				</script>";
		}
	}
}
if(isset($_POST["payment43"])){	
	$query=$sdc->query("select uain,form_id from sdc_form43 where user_id='$swr_id' and save_mode='P'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'payment_section.php?token=43;
			</script>";
	}else{
		if(empty($_POST["offline_challan"]) || $_POST["offline_challan"]=='2' || $_POST["offline_challan"]=='3'){
			echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'payment_section.php?token=43;
			</script>";
		}else{
			$row=$query->fetch_array();
			$form_id=$row["form_id"];$uain=$row["uain"];	
			$offline_challan=$_POST["offline_challan"];$payment_mode=0;
			$save_query=$sdc->query("update sdc_form43 set offline_challan='$offline_challan',payment_mode='$payment_mode',save_mode='C',sub_date='$today' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				$formFunctions->file_update($offline_challan);
				$formFunctions->insert_applications($uain);
				$str=$formFunctions->getEmail_str($uain);
				/////////////////////////////SEND MAIL////////////////////////////////
				$user_email=$formFunctions->get_usermail($swr_id);
				$dept_email="esgoa.sdc@gmail.com";
				require_once "sdc_form43_print.php"; 
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
						window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=43&dept=sdc';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form43.php';
					</script>";
				}
			}else{
				echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form43.php';
					</script>";
			}			
		}
	}
}
if(isset($_POST["save22"])){		
	$cosmetics_names=clean($_POST["cosmetics_names"]);$co_name=clean($_POST["co_name"]);
	
	if(empty($_POST["mfile1"]) || empty($_POST["mfile2"]) || empty($_POST["mfile3"]) || empty($_POST["mfile4"]) || $_POST["mfile1"]=='2' || $_POST["mfile2"]=='2' || $_POST["mfile3"]=='2' || $_POST["mfile4"]=='2' || $_POST["mfile1"]=='3' || $_POST["mfile2"]=='3' || $_POST["mfile3"]=='3' || $_POST["mfile4"]=='3'){
		echo "<script>
			alert('Error in file / You didnot select any option.');
			window.location.href = 'sdc_form22.php';
		</script>";
	}else{		
		$file1=clean($_POST["mfile1"]);
		$file2=clean($_POST["mfile2"]);
		$file3=clean($_POST["mfile3"]);
		$file4=clean($_POST["mfile4"]);
		
	}
	
	$input_size=$_POST["hiddenval"];$reg_fees="40";
	$sql=$sdc->query("select form_id from sdc_form22 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$sdc->query("insert into sdc_form22(user_id,sub_date,cosmetics_names,co_name,reg_fees, file1, file2, file3, file4) values ('$swr_id','$today', '$cosmetics_names','$co_name','$reg_fees', '$file1', '$file2', '$file3', '$file4')") OR die("Error: ".$sdc->error);
			$form_id=$sdc->insert_id;
	}else{
		$form_id=$row["form_id"];	
		$query=$sdc->query("update sdc_form22 set sub_date='$today',  cosmetics_names='$cosmetics_names',co_name='$co_name',reg_fees='$reg_fees', file1='$file1', file2='$file2', file3='$file3', file4='$file4' where form_id=$form_id") OR die("Error: ".$sdc->error);		
	}				
	if($query){
		$formFunctions->insert_incomplete_forms('sdc','22'); //sdc-- dept name and 22 -- form no 			
			if($input_size!=0){					
			$k=$sdc->query("delete from sdc_form22_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$part1=$sdc->query("INSERT INTO sdc_form22_t1(id,form_id,slno,name,qualification,experience,responsible) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')") or die("error in insertion sdc_form22_t1".$sdc->error);
				}
			}
		echo "<script>
						alert('Successfully Saved....');
						window.location.href = 'preview.php?token=22';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href ='sdc_form22.php';
					</script>";
				}	
	if($query){
		
		if($file1=="SC" || $file2=="SC" ||  $file3=="SC" ||  $file4=="SC"  ){
			$save_query=$sdc->query("update sdc_form22 set courier_details='1',received_date=NULL, sub_date='$today' where form_id='$form_id'") or die($sdc->error);
		}else{
			$save_query=$sdc->query("update sdc_form22 set sub_date='$today',received_date='$today',courier_details=NULL where form_id='$form_id'") or die($sdc->error);
		}
		if($save_query){
			$formFunctions->file_update($file1);$formFunctions->file_update($file2);$formFunctions->file_update($file3);$formFunctions->file_update($file4);
			$formFunctions->insert_incomplete_forms('sdc','22'); //sdc-- dept name and 2 -- form no
			echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'preview.php?token=22';
			</script>";
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href ='sdc_form22.php';
			</script>";
		}			
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'sdc_form22.php';
		</script>";
	}									
}
if(isset($_POST["proceed22"])){
	$query=$sdc->query("select form_id,save_mode,courier_details from sdc_form22 where user_id='$swr_id' and active='1'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'sdc_form22.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'sdc','22');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$sdc->query("update sdc_form22 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=sdc&form=22';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=22';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$sdc->query("update sdc_form22 set sub_date='$today',uain='$uain',save_mode='P' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'payment_section.php?token=22';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=22';
				</script>";
			}
		}else{
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=22';
				</script>";
		}
	}
}
if(isset($_POST["payment22"])){	
	$query=$sdc->query("select uain,form_id from sdc_form22 where user_id='$swr_id' and save_mode='P'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'payment_section.php?token=22;
			</script>";
	}else{
		if(empty($_POST["offline_challan"]) || $_POST["offline_challan"]=='2' || $_POST["offline_challan"]=='3'){
			echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'payment_section.php?token=22;
			</script>";
		}else{
			$row=$query->fetch_array();
			$form_id=$row["form_id"];$uain=$row["uain"];	
			$offline_challan=$_POST["offline_challan"];$payment_mode=0;
			$save_query=$sdc->query("update sdc_form22 set offline_challan='$offline_challan',payment_mode='$payment_mode',save_mode='C',sub_date='$today' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				$formFunctions->file_update($offline_challan);
				$formFunctions->insert_applications($uain);
				$str=$formFunctions->getEmail_str($uain);
				/////////////////////////////SEND MAIL////////////////////////////////
				$user_email=$formFunctions->get_usermail($swr_id);
				$dept_email="esgoa.sdc@gmail.com";
				require_once "sdc_form22_print.php"; 
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
						window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=22&dept=sdc';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form22.php';
					</script>";
				}
			}else{
				echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form22.php';
					</script>";
			}			
		}
	}
}
if(isset($_POST["save48"])){		
	$cosmetics_names=clean($_POST["cosmetics_names"]);$co_name=clean($_POST["co_name"]);
	
	if(empty($_POST["mfile1"]) || empty($_POST["mfile2"]) || $_POST["mfile1"]=='2' || $_POST["mfile2"]=='2' || $_POST["mfile1"]=='3' || $_POST["mfile2"]=='3' ){
		echo "<script>
			alert('Error in file / You didnot select any option.');
			window.location.href = 'sdc_form48.php';
		</script>";
	}else{		
		$file1=clean($_POST["mfile1"]);
		$file2=clean($_POST["mfile2"]);
		
		
	}
	
	$input_size=$_POST["hiddenval"];$reg_fees="40";
	$sql=$sdc->query("select form_id from sdc_form48 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$sdc->query("insert into sdc_form48(user_id,sub_date,cosmetics_names,co_name,reg_fees, file1, file2, file3, file4) values ('$swr_id','$today', '$cosmetics_names','$co_name','$reg_fees', '$file1', '$file2', '$file3', '$file4')") OR die("Error: ".$sdc->error);
			$form_id=$sdc->insert_id;
	}else{
		$form_id=$row["form_id"];	
		$query=$sdc->query("update sdc_form48 set sub_date='$today',  cosmetics_names='$cosmetics_names',co_name='$co_name',reg_fees='$reg_fees', file1='$file1', file2='$file2', file3='$file3', file4='$file4' where form_id=$form_id") OR die("Error: ".$sdc->error);		
	}				
	if($query){
		$formFunctions->insert_incomplete_forms('sdc','48'); //sdc-- dept name and 48 -- form no 			
			if($input_size!=0){					
			$k=$sdc->query("delete from sdc_form48_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$part1=$sdc->query("INSERT INTO sdc_form48_t1(id,form_id,slno,name,qualification,experience,responsible) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')") or die("error in insertion sdc_form22_t1".$sdc->error);
				}
			}
		echo "<script>
						alert('Successfully Saved....');
						window.location.href = 'preview.php?token=48';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href ='sdc_form48.php';
					</script>";
				}	
	if($query){
		
		if($file1=="SC" || $file2=="SC" ){
			$save_query=$sdc->query("update sdc_form48 set courier_details='1',received_date=NULL, sub_date='$today' where form_id='$form_id'") or die($sdc->error);
		}else{
			$save_query=$sdc->query("update sdc_form48 set sub_date='$today',received_date='$today',courier_details=NULL where form_id='$form_id'") or die($sdc->error);
		}
		if($save_query){
			$formFunctions->file_update($file1);$formFunctions->file_update($file2);
			$formFunctions->insert_incomplete_forms('sdc','48'); //sdc-- dept name and 48 -- form no
			echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'preview.php?token=48';
			</script>";
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href ='sdc_form48.php';
			</script>";
		}			
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'sdc_form48.php';
		</script>";
	}									
}
if(isset($_POST["proceed48"])){
	$query=$sdc->query("select form_id,save_mode,courier_details from sdc_form48 where user_id='$swr_id' and active='1'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'sdc_form48.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'sdc','48');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$sdc->query("update sdc_form48 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=sdc&form=48';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=48';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$sdc->query("update sdc_form48 set sub_date='$today',uain='$uain',save_mode='P' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'payment_section.php?token=48';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=48';
				</script>";
			}
		}else{
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=48';
				</script>";
		}
	}
}
if(isset($_POST["payment48"])){	
	$query=$sdc->query("select uain,form_id from sdc_form48 where user_id='$swr_id' and save_mode='P'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'payment_section.php?token=48;
			</script>";
	}else{
		if(empty($_POST["offline_challan"]) || $_POST["offline_challan"]=='2' || $_POST["offline_challan"]=='3'){
			echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'payment_section.php?token=48;
			</script>";
		}else{
			$row=$query->fetch_array();
			$form_id=$row["form_id"];$uain=$row["uain"];	
			$offline_challan=$_POST["offline_challan"];$payment_mode=0;
			$save_query=$sdc->query("update sdc_form48 set offline_challan='$offline_challan',payment_mode='$payment_mode',save_mode='C',sub_date='$today' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				$formFunctions->file_update($offline_challan);
				$formFunctions->insert_applications($uain);
				$str=$formFunctions->getEmail_str($uain);
				/////////////////////////////SEND MAIL////////////////////////////////
				$user_email=$formFunctions->get_usermail($swr_id);
				$dept_email="esgoa.sdc@gmail.com";
				require_once "sdc_form48_print.php"; 
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
						window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=48&dept=sdc';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form48.php';
					</script>";
				}
			}else{
				echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form48.php';
					</script>";
			}			
		}
	}
}
?>