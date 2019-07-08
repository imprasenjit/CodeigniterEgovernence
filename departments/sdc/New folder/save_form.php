<?php
if(isset($_POST["save1"])) {	
	$location=clean($_POST["location"]);$category=clean($_POST["category"]);$particulars=clean($_POST["particulars"]);
	
	
	
	if(empty($_POST["mfile1"]) || empty($_POST["mfile2"]) || empty($_POST["mfile3"]) || empty($_POST["mfile4"]) || empty($_POST["mfile5"]) || empty($_POST["mfile6"]) || empty($_POST["mfile7"]) || empty($_POST["mfile8"]) || $_POST["mfile1"]=='2' || $_POST["mfile2"]=='2' || $_POST["mfile3"]=='2' || $_POST["mfile4"]=='2' || $_POST["mfile5"]=='2' || $_POST["mfile6"]=='2' || $_POST["mfile7"]=='2' || $_POST["mfile8"]=='2' || $_POST["mfile1"]=='3' || $_POST["mfile2"]=='3' || $_POST["mfile3"]=='3' || $_POST["mfile4"]=='3' || $_POST["mfile5"]=='3' || $_POST["mfile6"]=='3' || $_POST["mfile7"]=='3' || $_POST["mfile8"]=='3'){
		echo "<script>
			alert('Error in file / You didnot select any option.');
			window.location.href = 'sdc_form1.php';
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
	
	
	if(!empty($_POST["supervision"]))	 $supervision=json_encode($_POST["supervision"]);
	else	$supervision=NULL;
	$reg_fees="40";
	$sql=$sdc->query("select form_id from sdc_form1 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
	       $query=$sdc->query("insert into sdc_form1(user_id,sub_date,location,supervision,category,particulars,reg_fees,file1,file2,file3,file4,file5,file6,file7,file8) values ('$swr_id','$today', '$location','$supervision', '$category', '$particulars', '$reg_fees', '$file1', '$file2', '$file3', '$file4', '$file5', '$file6', '$file7', '$file8')") OR die("Error: ".$sdc->error);
	}else{  ////////////table is not empty//////////////
			$form_id=$row["form_id"];	
			$query=$sdc->query("update sdc_form1 set sub_date='$today', location='$location', supervision='$supervision', category='$category', particulars='$particulars', reg_fees='$reg_fees', file1='$file1', file2='$file2', file3='$file3', file4='$file4', file5='$file5', file6='$file6', file7='$file7', file8='$file8' where form_id=$form_id") OR die("Error: ".$sdc->error);
	}
	
	
	
	if($query){
		
		if($file1=="SC" || $file2=="SC" ||  $file3=="SC" ||  $file4=="SC" ||  $file5=="SC" ||  $file6=="SC" ||  $file7=="SC" ||  $file8=="SC"){
			$save_query=$sdc->query("update sdc_form1 set courier_details='1',received_date=NULL, sub_date='$today' where form_id='$form_id'") or die($sdc->error);
		}else{
			$save_query=$sdc->query("update sdc_form1 set sub_date='$today',received_date='$today',courier_details=NULL where form_id='$form_id'") or die($sdc->error);
		}
		if($save_query){
			$formFunctions->file_update($file1);$formFunctions->file_update($file2);$formFunctions->file_update($file3);$formFunctions->file_update($file4);$formFunctions->file_update($file5);$formFunctions->file_update($file6);$formFunctions->file_update($file7);$formFunctions->file_update($file8);
			
			$formFunctions->insert_incomplete_forms('sdc','1'); //sdc-- dept name and 1 -- form no
			echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'preview.php?token=1';
			</script>";
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href ='sdc_form1.php';
			</script>";
		}			
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'sdc_form1.php';
		</script>";
	}						
}
if(isset($_POST["proceed1"])){
	$query=$sdc->query("select form_id,save_mode,courier_details from sdc_form1 where user_id='$swr_id' and active='1'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'sdc_form1.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'sdc','1');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$sdc->query("update sdc_form1 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=sdc&form=1';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=1';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$sdc->query("update sdc_form1 set sub_date='$today',uain='$uain',save_mode='P' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'payment_section.php?token=1';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=1';
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
if(isset($_POST["payment1"])){	
	$query=$sdc->query("select uain,form_id from sdc_form1 where user_id='$swr_id' and save_mode='P'") or die("Error :". $sdc->error);
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
			$save_query=$sdc->query("update sdc_form1 set offline_challan='$offline_challan',payment_mode='$payment_mode',save_mode='C',sub_date='$today' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				$formFunctions->file_update($offline_challan);
				$formFunctions->insert_applications($uain);
				$str=$formFunctions->getEmail_str($uain);
				/////////////////////////////SEND MAIL////////////////////////////////
				$user_email=$formFunctions->get_usermail($swr_id);
				$dept_email="esgoa.sdc@gmail.com";
				require_once "sdc_form1_print.php"; 
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
						window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=1&dept=sdc';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form1.php';
					</script>";
				}
			}else{
				echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form1.php';
					</script>";
			}			
		}
	}
}
if(isset($_POST["save21"])) {	
	$location=clean($_POST["location"]);$category=clean($_POST["category"]);$particulars=clean($_POST["particulars"]);
	if(!empty($_POST["supervision"]))	 $supervision=json_encode($_POST["supervision"]);
	else	$supervision=NULL;
	$reg_fees="40";
	$sql=$sdc->query("select form_id from sdc_form21 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
	       $query=$sdc->query("insert into sdc_form21(user_id,sub_date,location,supervision,category,particulars,reg_fees) values ('$swr_id','$today', '$location','$supervision', '$category', '$particulars', '$reg_fees')") OR die("Error: ".$sdc->error);
	}else{  ////////////table is not empty//////////////
			$form_id=$row["form_id"];	
			$query=$sdc->query("update sdc_form21 set sub_date='$today', location='$location', supervision='$supervision', category='$category', particulars='$particulars', reg_fees='$reg_fees' where form_id=$form_id") OR die("Error: ".$sdc->error);
	}	
	if($query){
		$formFunctions->insert_incomplete_forms('sdc','1'); //sdc-- dept name and 1 -- form no
		echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'preview.php?token=21';
			</script>";			
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'sdc_form21.php';
		</script>";
	}						
}
if(isset($_POST["proceed21"])){
	$query=$sdc->query("select form_id,save_mode,courier_details from sdc_form21 where user_id='$swr_id' and active='1'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'sdc_form21.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'sdc','21');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$sdc->query("update sdc_form21 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=sdc&form=1';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=1';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$sdc->query("update sdc_form21 set sub_date='$today',uain='$uain',save_mode='P' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'payment_section.php?token=21';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=21';
				</script>";
			}
		}else{
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=21';
				</script>";
		}
	}
}
if(isset($_POST["payment21"])){	
	$query=$sdc->query("select uain,form_id from sdc_form21 where user_id='$swr_id' and save_mode='P'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'payment_section.php?token=21';
			</script>";
	}else{
		if(empty($_POST["offline_challan"]) || $_POST["offline_challan"]=='2' || $_POST["offline_challan"]=='3'){
			echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'payment_section.php?token=21';
			</script>";
		}else{
			$row=$query->fetch_array();
			$form_id=$row["form_id"];$uain=$row["uain"];	
			$offline_challan=$_POST["offline_challan"];$payment_mode=0;
			$save_query=$sdc->query("update sdc_form21 set offline_challan='$offline_challan',payment_mode='$payment_mode',save_mode='C',sub_date='$today' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				$formFunctions->file_update($offline_challan);
				$formFunctions->insert_applications($uain);
				$str=$formFunctions->getEmail_str($uain);
				/////////////////////////////SEND MAIL////////////////////////////////
				$user_email=$formFunctions->get_usermail($swr_id);
				$dept_email="esgoa.sdc@gmail.com";
				require_once "sdc_form21_print.php"; 
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
						window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=21&dept=sdc';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form21.php';
					</script>";
				}
			}else{
				echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form21.php';
					</script>";
			}			
		}
	}
}
if(isset($_POST["save2"])){		
	$location=clean($_POST["location"]);$situated=clean($_POST["situated"]);$drug_name=clean($_POST["drug_name"]);$particulars=clean($_POST["particulars"]);
	
	
	
	if(empty($_POST["mfile1"]) || empty($_POST["mfile2"]) || empty($_POST["mfile3"]) || empty($_POST["mfile4"]) || empty($_POST["mfile5"]) || empty($_POST["mfile6"]) || empty($_POST["mfile7"]) || empty($_POST["mfile8"]) || $_POST["mfile1"]=='2' || $_POST["mfile2"]=='2' || $_POST["mfile3"]=='2' || $_POST["mfile4"]=='2' || $_POST["mfile5"]=='2' || $_POST["mfile6"]=='2' || $_POST["mfile7"]=='2' || $_POST["mfile8"]=='2' || $_POST["mfile1"]=='3' || $_POST["mfile2"]=='3' || $_POST["mfile3"]=='3' || $_POST["mfile4"]=='3' || $_POST["mfile5"]=='3' || $_POST["mfile6"]=='3' || $_POST["mfile7"]=='3' || $_POST["mfile8"]=='3'){
		echo "<script>
			alert('Error in file / You didnot select any option.');
			window.location.href = 'sdc_form1.php';
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
	$sql=$sdc->query("select form_id from sdc_form2 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$sdc->query("insert into sdc_form2(user_id,sub_date,location,situated,drug_name,particulars,dealer,reg_fees) values ('$swr_id','$today', '$location', '$situated', '$drug_name', '$particulars', '$dealer','$reg_fees')") OR die("Error: ".$sdc->error);
	}else{
		$form_id=$row["form_id"];	
		$query=$sdc->query("update sdc_form2 set sub_date='$today', location='$location',  situated='$situated',drug_name='$drug_name', particulars='$particulars', dealer='$dealer',reg_fees='$reg_fees' where form_id=$form_id") OR die("Error: ".$sdc->error);
	}				
	if($query){
		$formFunctions->insert_incomplete_forms('sdc','2'); //sdc-- dept name and 2 -- form no 
					echo "<script>
						alert('Successfully Saved....');
						window.location.href = 'preview.php?token=2';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href ='sdc_form2.php';
					</script>";
				}	
}
if(isset($_POST["proceed2"])){
	$query=$sdc->query("select form_id,save_mode,courier_details from sdc_form2 where user_id='$swr_id' and active='1'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'sdc_form2.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'sdc','2');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$sdc->query("update sdc_form2 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=sdc&form=2';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=2';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$sdc->query("update sdc_form2 set sub_date='$today',uain='$uain',save_mode='P' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'payment_section.php?token=2';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=2';
				</script>";
			}
		}else{
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=2';
				</script>";
		}
	}
}
if(isset($_POST["payment2"])){	
	$query=$sdc->query("select uain,form_id from sdc_form2 where user_id='$swr_id' and save_mode='P'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'payment_section.php?token=2';
			</script>";
	}else{
		if(empty($_POST["offline_challan"]) || $_POST["offline_challan"]=='2' || $_POST["offline_challan"]=='3'){
			echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'payment_section.php?token=2';
			</script>";
		}else{
			$row=$query->fetch_array();
			$form_id=$row["form_id"];$uain=$row["uain"];	
			$offline_challan=$_POST["offline_challan"];$payment_mode=0;
			$save_query=$sdc->query("update sdc_form2 set offline_challan='$offline_challan',payment_mode='$payment_mode',save_mode='C',sub_date='$today' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				$formFunctions->file_update($offline_challan);
				$formFunctions->insert_applications($uain);
				$str=$formFunctions->getEmail_str($uain);
				/////////////////////////////SEND MAIL////////////////////////////////
				$user_email=$formFunctions->get_usermail($swr_id);
				$dept_email="esgoa.sdc@gmail.com";
				require_once "sdc_form2_print.php"; 
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
						window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=2&dept=sdc';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form2.php';
					</script>";
				}
			}else{
				echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form2.php';
					</script>";
			}			
		}
	}
}
if(isset($_POST["save22"])){		
	$location=clean($_POST["location"]);$situated=clean($_POST["situated"]);$drug_name=clean($_POST["drug_name"]);$particulars=clean($_POST["particulars"]);
	if(!empty($_POST["dealer"]))	 $dealer=json_encode($_POST["dealer"]);
	else	$dealer=NULL;
	$reg_fees="40";
	$sql=$sdc->query("select form_id from sdc_form22 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$sdc->query("insert into sdc_form22(user_id,sub_date,location,situated,drug_name,particulars,dealer,reg_fees) values ('$swr_id','$today', '$location', '$situated', '$drug_name', '$particulars', '$dealer','$reg_fees')") OR die("Error: ".$sdc->error);
	}else{
		$form_id=$row["form_id"];	
		$query=$sdc->query("update sdc_form22 set sub_date='$today', location='$location',  situated='$situated',drug_name='$drug_name', particulars='$particulars', dealer='$dealer',reg_fees='$reg_fees' where form_id=$form_id") OR die("Error: ".$sdc->error);
	}				
	if($query){
		$formFunctions->insert_incomplete_forms('sdc','22'); //sdc-- dept name and 22 -- form no 
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
				window.location.href = 'payment_section.php?token=22';
			</script>";
	}else{
		if(empty($_POST["offline_challan"]) || $_POST["offline_challan"]=='2' || $_POST["offline_challan"]=='3'){
			echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'payment_section.php?token=22';
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
if(isset($_POST["save3"])){		
	$reg_no=clean($_POST["reg_no"]);$catrgories=clean($_POST["catrgories"]);$storage_acc=clean($_POST["storage_acc"]);
	if(!empty($_POST["supervision"]))	 $supervision=json_encode($_POST["supervision"]);
	else	$supervision=NULL;
	$reg_fees="40";
	$sql=$sdc->query("select form_id from sdc_form3 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$sdc->query("insert into sdc_form3(user_id,sub_date,reg_no,catrgories,reg_fees,storage_acc) values ('$swr_id','$today', '$reg_no', '$catrgories', '$reg_fees','$storage_acc')") OR die("Error: ".$sdc->error);
	}else{
		$form_id=$row["form_id"];	
		$query=$sdc->query("update sdc_form3 set sub_date='$today', reg_no='$reg_no',  catrgories='$catrgories',reg_fees='$reg_fees',storage_acc='$storage_acc' where form_id=$form_id") OR die("Error: ".$sdc->error);
	}				
	if($query){
		$formFunctions->insert_incomplete_forms('sdc','3'); //sdc-- dept name and 1 -- form no
		echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'preview.php?token=3';
			</script>";			
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'sdc_form3.php';
		</script>";
	}	
}
if(isset($_POST["proceed3"])){
	$query=$sdc->query("select form_id,save_mode,courier_details from sdc_form3 where user_id='$swr_id' and active='1'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'sdc_form3.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'sdc','3');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$sdc->query("update sdc_form3 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=sdc&form=3';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=3';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$sdc->query("update sdc_form3 set sub_date='$today',uain='$uain',save_mode='P' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'payment_section.php?token=3';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=3';
				</script>";
			}
		}else{
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=3';
				</script>";
		}
	}
}
if(isset($_POST["payment3"])){	
	$query=$sdc->query("select uain,form_id from sdc_form3 where user_id='$swr_id' and save_mode='P'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'payment_section.php?token=3';
			</script>";
	}else{
		if(empty($_POST["offline_challan"]) || $_POST["offline_challan"]=='2' || $_POST["offline_challan"]=='3'){
			echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'payment_section.php?token=3';
			</script>";
		}else{
			$row=$query->fetch_array();
			$form_id=$row["form_id"];$uain=$row["uain"];	
			$offline_challan=$_POST["offline_challan"];$payment_mode=0;
			$save_query=$sdc->query("update sdc_form3 set offline_challan='$offline_challan',payment_mode='$payment_mode',save_mode='C',sub_date='$today' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				$formFunctions->file_update($offline_challan);
				$formFunctions->insert_applications($uain);
				$str=$formFunctions->getEmail_str($uain);
				/////////////////////////////SEND MAIL////////////////////////////////
				$user_email=$formFunctions->get_usermail($swr_id);
				$dept_email="esgoa.sdc@gmail.com";
				require_once "sdc_form3_print.php"; 
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
						window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=3&dept=sdc';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form3.php';
					</script>";
				}
			}else{
				echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form3.php';
					</script>";
			}			
		}
	}
}
if(isset($_POST["save23"])){		
	$reg_no=clean($_POST["reg_no"]);$catrgories=clean($_POST["catrgories"]);$storage_acc=clean($_POST["storage_acc"]);
	if(!empty($_POST["supervision"]))	 $supervision=json_encode($_POST["supervision"]);
	else	$supervision=NULL;
	$reg_fees="40";
	$sql=$sdc->query("select form_id from sdc_form23 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$sdc->query("insert into sdc_form23(user_id,sub_date,reg_no,catrgories,reg_fees,storage_acc) values ('$swr_id','$today', '$reg_no', '$catrgories', '$reg_fees','$storage_acc')") OR die("Error: ".$sdc->error);
	}else{
		$form_id=$row["form_id"];	
		$query=$sdc->query("update sdc_form23 set sub_date='$today', reg_no='$reg_no',  catrgories='$catrgories',reg_fees='$reg_fees',storage_acc='$storage_acc' where form_id=$form_id") OR die("Error: ".$sdc->error);
	}				
	if($query){
		$formFunctions->insert_incomplete_forms('sdc','23'); //sdc-- dept name and 1 -- form no
		echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'preview.php?token=23';
			</script>";			
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'sdc_form23.php';
		</script>";
	}	
}
if(isset($_POST["proceed23"])){
	$query=$sdc->query("select form_id,save_mode,courier_details from sdc_form23 where user_id='$swr_id' and active='1'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'sdc_form23.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'sdc','23');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$sdc->query("update sdc_form23 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=sdc&form=23';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=23';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$sdc->query("update sdc_form23 set sub_date='$today',uain='$uain',save_mode='P' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'payment_section.php?token=23';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=23';
				</script>";
			}
		}else{
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=23';
				</script>";
		}
	}
}
if(isset($_POST["payment23"])){	
	$query=$sdc->query("select uain,form_id from sdc_form23 where user_id='$swr_id' and save_mode='P'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'payment_section.php?token=23';
			</script>";
	}else{
		if(empty($_POST["offline_challan"]) || $_POST["offline_challan"]=='2' || $_POST["offline_challan"]=='3'){
			echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'payment_section.php?token=23';
			</script>";
		}else{
			$row=$query->fetch_array();
			$form_id=$row["form_id"];$uain=$row["uain"];	
			$offline_challan=$_POST["offline_challan"];$payment_mode=0;
			$save_query=$sdc->query("update sdc_form23 set offline_challan='$offline_challan',payment_mode='$payment_mode',save_mode='C',sub_date='$today' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				$formFunctions->file_update($offline_challan);
				$formFunctions->insert_applications($uain);
				$str=$formFunctions->getEmail_str($uain);
				/////////////////////////////SEND MAIL////////////////////////////////
				$user_email=$formFunctions->get_usermail($swr_id);
				$dept_email="esgoa.sdc@gmail.com";
				require_once "sdc_form23_print.php"; 
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
						window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=23&dept=sdc';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form23.php';
					</script>";
				}
			}else{
				echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form23.php';
					</script>";
			}			
		}
	}
}
if(isset($_POST["save4"])){		
	$licence=clean($_POST["licence"]);$name_incharge=clean($_POST["name_incharge"]);
	$sql=$sdc->query("select form_id from sdc_form4 where user_id='$swr_id' and active='1'");
	$reg_fees="40";
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$sdc->query("insert into sdc_form4(user_id,sub_date,licence,name_incharge,reg_fees) values ('$swr_id','$today', '$licence', '$name_incharge','$reg_fees')") OR die("Error: ".$sdc->error);
	}else{
		$form_id=$row["form_id"];	
		$query=$sdc->query("update sdc_form4 set sub_date='$today', licence='$licence',  name_incharge='$name_incharge',reg_fees='$reg_fees' where form_id=$form_id") OR die("Error: ".$sdc->error);
	}				
	if($query){
		$formFunctions->insert_incomplete_forms('sdc','4'); //sdc-- dept name and 3 -- form no 
					echo "<script>
						alert('Successfully Saved....');
						window.location.href = 'preview.php?token=4';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href ='sdc_form4.php';
					</script>";
				}	
}
if(isset($_POST["proceed4"])){
	$query=$sdc->query("select form_id,save_mode,courier_details from sdc_form4 where user_id='$swr_id' and active='1'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'sdc_form4.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'sdc','4');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$sdc->query("update sdc_form4 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=sdc&form=4';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=4';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$sdc->query("update sdc_form4 set sub_date='$today',uain='$uain',save_mode='P' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'payment_section.php?token=4';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=4';
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
if(isset($_POST["payment4"])){	
	$query=$sdc->query("select uain,form_id from sdc_form4 where user_id='$swr_id' and save_mode='P'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'payment_section.php?token=4';
			</script>";
	}else{
		if(empty($_POST["offline_challan"]) || $_POST["offline_challan"]=='2' || $_POST["offline_challan"]=='3'){
			echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'payment_section.php?token=4';
			</script>";
		}else{
			$row=$query->fetch_array();
			$form_id=$row["form_id"];$uain=$row["uain"];	
			$offline_challan=$_POST["offline_challan"];$payment_mode=0;
			$save_query=$sdc->query("update sdc_form4 set offline_challan='$offline_challan',payment_mode='$payment_mode',save_mode='C',sub_date='$today' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				$formFunctions->file_update($offline_challan);
				$formFunctions->insert_applications($uain);
				$str=$formFunctions->getEmail_str($uain);
				/////////////////////////////SEND MAIL////////////////////////////////
				$user_email=$formFunctions->get_usermail($swr_id);
				$dept_email="esgoa.sdc@gmail.com";
				require_once "sdc_form4_print.php"; 
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
						window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=4&dept=sdc';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form4.php';
					</script>";
				}
			}else{
				echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form4.php';
					</script>";
			}			
		}
	}
}
if(isset($_POST["save24"])){		
	$licence=clean($_POST["licence"]);$name_incharge=clean($_POST["name_incharge"]);
	$sql=$sdc->query("select form_id from sdc_form24 where user_id='$swr_id' and active='1'");
	$reg_fees="40";
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$sdc->query("insert into sdc_form24(user_id,sub_date,licence,name_incharge,reg_fees) values ('$swr_id','$today', '$licence', '$name_incharge','$reg_fees')") OR die("Error: ".$sdc->error);
	}else{
		$form_id=$row["form_id"];	
		$query=$sdc->query("update sdc_form24 set sub_date='$today', licence='$licence',  name_incharge='$name_incharge',reg_fees='$reg_fees' where form_id=$form_id") OR die("Error: ".$sdc->error);
	}				
	if($query){
		$formFunctions->insert_incomplete_forms('sdc','24'); //sdc-- dept name and 24 -- form no 
					echo "<script>
						alert('Successfully Saved....');
						window.location.href = 'preview.php?token=24';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href ='sdc_form24.php';
					</script>";
				}	
}
if(isset($_POST["proceed24"])){
	$query=$sdc->query("select form_id,save_mode,courier_details from sdc_form24 where user_id='$swr_id' and active='1'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'sdc_form24.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'sdc','24');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$sdc->query("update sdc_form24 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=sdc&form=24';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=24';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$sdc->query("update sdc_form24 set sub_date='$today',uain='$uain',save_mode='P' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'payment_section.php?token=24';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=24';
				</script>";
			}
		}else{
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=24';
				</script>";
		}
	}
}
if(isset($_POST["payment24"])){	
	$query=$sdc->query("select uain,form_id from sdc_form24 where user_id='$swr_id' and save_mode='P'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'payment_section.php?token=24';
			</script>";
	}else{
		if(empty($_POST["offline_challan"]) || $_POST["offline_challan"]=='2' || $_POST["offline_challan"]=='3'){
			echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'payment_section.php?token=24';
			</script>";
		}else{
			$row=$query->fetch_array();
			$form_id=$row["form_id"];$uain=$row["uain"];	
			$offline_challan=$_POST["offline_challan"];$payment_mode=0;
			$save_query=$sdc->query("update sdc_form24 set offline_challan='$offline_challan',payment_mode='$payment_mode',save_mode='C',sub_date='$today' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				$formFunctions->file_update($offline_challan);
				$formFunctions->insert_applications($uain);
				$str=$formFunctions->getEmail_str($uain);
				/////////////////////////////SEND MAIL////////////////////////////////
				$user_email=$formFunctions->get_usermail($swr_id);
				$dept_email="esgoa.sdc@gmail.com";
				require_once "sdc_form24_print.php"; 
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
						window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=24&dept=sdc';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form24.php';
					</script>";
				}
			}else{
				echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form24.php';
					</script>";
			}			
		}
	}
}
if(isset($_POST["save5"])){		
	$category=clean($_POST["category"]);$particulars=clean($_POST["particulars"]);
	if(!empty($_POST["supervision"]))	 $supervision=json_encode($_POST["supervision"]);
	else	$supervision=NULL;
	$reg_fees="40";
	$sql=$sdc->query("select form_id from sdc_form5 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$sdc->query("insert into sdc_form5(user_id,sub_date,category,supervision,particulars,reg_fees) values ('$swr_id','$today', '$category', '$supervision', '$particulars', '$reg_fees')") OR die("Error: ".$sdc->error);
	}else{
		$form_id=$row["form_id"];	
		$query=$sdc->query("update sdc_form5 set sub_date='$today',  category='$category', supervision='$supervision',  particulars='$particulars', reg_fees='$reg_fees' where form_id=$form_id") OR die("Error: ".$sdc->error);
	}				
	if($query){
		$formFunctions->insert_incomplete_forms('sdc','5'); //sdc-- dept name and 5 -- form no 
					echo "<script>
						alert('Successfully Saved....');
						window.location.href = 'preview.php?token=5';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href ='sdc_form5.php';
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
if(isset($_POST["save25"])){		
	$category=clean($_POST["category"]);$particulars=clean($_POST["particulars"]);
	if(!empty($_POST["supervision"]))	 $supervision=json_encode($_POST["supervision"]);
	else	$supervision=NULL;
	$reg_fees="40";
	$sql=$sdc->query("select form_id from sdc_form25 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$sdc->query("insert into sdc_form25(user_id,sub_date,category,supervision,particulars,reg_fees) values ('$swr_id','$today', '$category', '$supervision', '$particulars', '$reg_fees')") OR die("Error: ".$sdc->error);
	}else{
		$form_id=$row["form_id"];	
		$query=$sdc->query("update sdc_form25 set sub_date='$today',  category='$category', supervision='$supervision',  particulars='$particulars', reg_fees='$reg_fees' where form_id=$form_id") OR die("Error: ".$sdc->error);
	}				
	if($query){
		$formFunctions->insert_incomplete_forms('sdc','25'); //sdc-- dept name and 25 -- form no 
					echo "<script>
						alert('Successfully Saved....');
						window.location.href = 'preview.php?token=25';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href ='sdc_form25.php';
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
if(isset($_POST["save6"])){		
	$drug_name=clean($_POST["drug_name"]);
	$input_size=$_POST["hiddenval"];
	$reg_fees="40";
	$sql=$sdc->query("select form_id from sdc_form6 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$sdc->query("insert into sdc_form6(user_id,sub_date,drug_name,reg_fees) values ('$swr_id','$today', '$drug_name', '$reg_fees')") OR die("Error: ".$sdc->error);
			$form_id=$sdc->insert_id;
	}else{
		$form_id=$row["form_id"];	
		$query=$sdc->query("update sdc_form6 set sub_date='$today', drug_name='$drug_name', reg_fees='$reg_fees' where form_id=$form_id") OR die("Error: ".$sdc->error);		
	}				
	if($query){
		$formFunctions->insert_incomplete_forms('sdc','6'); //sdc-- dept name and 1 -- form no 
			if($input_size!=0){					
			$k=$sdc->query("delete from sdc_form6_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$part1=$sdc->query("INSERT INTO sdc_form6_t1(id,form_id,slno,name,qualification,experience) VALUES ('','$form_id','$i','$valb','$valc','$vald')") or die("error in insertion sdc_form6_t1".$sdc->error);
				}
			}
		echo "<script>
		alert('Successfully Saved....');
		window.location.href = 'preview.php?token=6';
	</script>";	
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
if(isset($_POST["save26"])){		
	$drug_name=clean($_POST["drug_name"]);
	$input_size=$_POST["hiddenval"];
	$reg_fees="40";
	$sql=$sdc->query("select form_id from sdc_form26 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$sdc->query("insert into sdc_form26(user_id,sub_date,drug_name,reg_fees) values ('$swr_id','$today', '$drug_name', '$reg_fees')") OR die("Error: ".$sdc->error);
			$form_id=$sdc->insert_id;
	}else{
		$form_id=$row["form_id"];	
		$query=$sdc->query("update sdc_form26 set sub_date='$today', drug_name='$drug_name', reg_fees='$reg_fees' where form_id=$form_id") OR die("Error: ".$sdc->error);		
	}				
	if($query){
		$formFunctions->insert_incomplete_forms('sdc','26'); //sdc-- dept name and 1 -- form no 
			if($input_size!=0){					
			$k=$sdc->query("delete from sdc_form26_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$part1=$sdc->query("INSERT INTO sdc_form26_t1(id,form_id,slno,name,qualification,experience) VALUES ('','$form_id','$i','$valb','$valc','$vald')") or die("error in insertion sdc_form26_t1".$sdc->error);
				}
			}
		echo "<script>
		alert('Successfully Saved....');
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

if(isset($_POST["save7"])){		
	$co_name=clean($_POST["co_name"]);$drug_name=clean( $_POST["drug_name"]);
	$input_size=$_POST["hiddenval"];$reg_fees="40";
	$sql=$sdc->query("select form_id from sdc_form7 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$sdc->query("insert into sdc_form7(user_id,sub_date,co_name,drug_name,reg_fees) values ('$swr_id','$today', '$co_name', '$drug_name','$reg_fees')") OR die("Error: ".$sdc->error);
			$form_id=$sdc->insert_id;
	}else{
		$form_id=$row["form_id"];	
		$query=$sdc->query("update sdc_form7 set sub_date='$today', co_name='$co_name', drug_name='$drug_name',reg_fees='$reg_fees' where form_id=$form_id") OR die("Error: ".$sdc->error);		
	}				
	if($query){
		$formFunctions->insert_incomplete_forms('sdc','7'); //sdc-- dept name and 1 -- form no 
			if($input_size!=0){					
			$k=$sdc->query("delete from sdc_form7_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$part1=$sdc->query("INSERT INTO sdc_form7_t1(id,form_id,slno,name,qualification,experience) VALUES ('','$form_id','$i','$valb','$valc','$vald')") or die("error in insertion sdc_form7_t1".$sdc->error);
				}
			}
		echo "<script>
						alert('Successfully Saved....');
						window.location.href = 'preview.php?token=7';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href ='sdc_form7.php?tab=2';
					</script>";
				}			
}

if(isset($_POST["proceed7"])){
	$query=$sdc->query("select form_id,save_mode,courier_details from sdc_form7 where user_id='$swr_id' and active='1'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'sdc_form7.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'sdc','7');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$sdc->query("update sdc_form7 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=sdc&form=7';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=7';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$sdc->query("update sdc_form7 set sub_date='$today',uain='$uain',save_mode='P' where form_id='$form_id'") or die($sdc->error);
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
	$query=$sdc->query("select uain,form_id from sdc_form7 where user_id='$swr_id' and save_mode='P'") or die("Error :". $sdc->error);
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
			$save_query=$sdc->query("update sdc_form7 set offline_challan='$offline_challan',payment_mode='$payment_mode',save_mode='C',sub_date='$today' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				$formFunctions->file_update($offline_challan);
				$formFunctions->insert_applications($uain);
				$str=$formFunctions->getEmail_str($uain);
				/////////////////////////////SEND MAIL////////////////////////////////
				$user_email=$formFunctions->get_usermail($swr_id);
				$dept_email="esgoa.sdc@gmail.com";
				require_once "sdc_form7_print.php"; 
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
						window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=7&dept=sdc';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form7.php';
					</script>";
				}
			}else{
				echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form7.php';
					</script>";
			}			
		}
	}
}
if(isset($_POST["save27"])){		
	$co_name=clean($_POST["co_name"]);$drug_name=clean( $_POST["drug_name"]);
	$input_size=$_POST["hiddenval"];$reg_fees="40";
	$sql=$sdc->query("select form_id from sdc_form27 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$sdc->query("insert into sdc_form27(user_id,sub_date,co_name,drug_name,reg_fees) values ('$swr_id','$today', '$co_name', '$drug_name','$reg_fees')") OR die("Error: ".$sdc->error);
			$form_id=$sdc->insert_id;
	}else{
		$form_id=$row["form_id"];	
		$query=$sdc->query("update sdc_form27 set sub_date='$today', co_name='$co_name', drug_name='$drug_name',reg_fees='$reg_fees' where form_id=$form_id") OR die("Error: ".$sdc->error);		
	}				
	if($query){
		$formFunctions->insert_incomplete_forms('sdc','27'); //sdc-- dept name and 1 -- form no 
			if($input_size!=0){					
			$k=$sdc->query("delete from sdc_form27_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$part1=$sdc->query("INSERT INTO sdc_form27_t1(id,form_id,slno,name,qualification,experience) VALUES ('','$form_id','$i','$valb','$valc','$vald')") or die("error in insertion sdc_form27_t1".$sdc->error);
				}
			}
		echo "<script>
						alert('Successfully Saved....');
						window.location.href = 'preview.php?token=27';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href ='sdc_form27.php?tab=2';
					</script>";
				}			
}

if(isset($_POST["proceed27"])){
	$query=$sdc->query("select form_id,save_mode,courier_details from sdc_form27 where user_id='$swr_id' and active='1'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'sdc_form27.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'sdc','27');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$sdc->query("update sdc_form27 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=sdc&form=27';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=27';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$sdc->query("update sdc_form27 set sub_date='$today',uain='$uain',save_mode='P' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'payment_section.php?token=27';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=27';
				</script>";
			}
		}else{
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=27';
				</script>";
		}
	}
}
if(isset($_POST["payment27"])){	
	$query=$sdc->query("select uain,form_id from sdc_form27 where user_id='$swr_id' and save_mode='P'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'payment_section.php?token=27';
			</script>";
	}else{
		if(empty($_POST["offline_challan"]) || $_POST["offline_challan"]=='2' || $_POST["offline_challan"]=='3'){
			echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'payment_section.php?token=27';
			</script>";
		}else{
			$row=$query->fetch_array();
			$form_id=$row["form_id"];$uain=$row["uain"];	
			$offline_challan=$_POST["offline_challan"];$payment_mode=0;
			$save_query=$sdc->query("update sdc_form27 set offline_challan='$offline_challan',payment_mode='$payment_mode',save_mode='C',sub_date='$today' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				$formFunctions->file_update($offline_challan);
				$formFunctions->insert_applications($uain);
				$str=$formFunctions->getEmail_str($uain);
				/////////////////////////////SEND MAIL////////////////////////////////
				$user_email=$formFunctions->get_usermail($swr_id);
				$dept_email="esgoa.sdc@gmail.com";
				require_once "sdc_form27_print.php"; 
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
						window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=27&dept=sdc';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form27.php';
					</script>";
				}
			}else{
				echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form27.php';
					</script>";
			}			
		}
	}
}
if(isset($_POST["save8"])) {	
	$location=clean($_POST["location"]);$names_of_drugs=clean($_POST["names_of_drugs"]);$input_size=$_POST["hiddenval"];
	$reg_fees="40";
	$sql=$sdc->query("select form_id from sdc_form8 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
	       $query=$sdc->query("insert into sdc_form8(user_id,sub_date,location,names_of_drugs,reg_fees) values ('$swr_id','$today', '$location','$names_of_drugs','$reg_fees')") OR die("Error: ".$sdc->error);
		   $form_id=$sdc->insert_id;
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
if(isset($_POST["save28"])) {	
	$location=clean($_POST["location"]);$names_of_drugs=clean($_POST["names_of_drugs"]);$input_size=$_POST["hiddenval"];
	$reg_fees="40";
	$sql=$sdc->query("select form_id from sdc_form28 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
	       $query=$sdc->query("insert into sdc_form28(user_id,sub_date,location,names_of_drugs,reg_fees) values ('$swr_id','$today', '$location','$names_of_drugs','$reg_fees')") OR die("Error: ".$sdc->error);
		   $form_id=$sdc->insert_id;
	}else{  ////////////table is not empty//////////////
			$form_id=$row["form_id"];	
			$query=$sdc->query("update sdc_form28 set sub_date='$today', location='$location', names_of_drugs='$names_of_drugs',reg_fees='$reg_fees' where form_id=$form_id") OR die("Error: ".$sdc->error);
	}	
	if($query){
		$formFunctions->insert_incomplete_forms('sdc','28'); //sdc-- dept name and 1 -- form no 
		if($input_size!=0){					
		$k=$sdc->query("delete from sdc_form28_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$part1=$sdc->query("INSERT INTO sdc_form28_t1(id,form_id,slno,name,qualification,experience) VALUES ('','$form_id','$i','$valb','$valc','$vald')") or die("error in insertion sdc_form28_t1".$sdc->error);
				}
			}
		echo "<script>
						alert('Successfully Saved....');
						window.location.href = 'preview.php?token=28';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href ='sdc_form28.php';
					</script>";
				}			
}

if(isset($_POST["proceed28"])){
	$query=$sdc->query("select form_id,save_mode,courier_details from sdc_form28 where user_id='$swr_id' and active='1'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'sdc_form28.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'sdc','28');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$sdc->query("update sdc_form28 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=sdc&form=28';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=28';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$sdc->query("update sdc_form28 set sub_date='$today',uain='$uain',save_mode='P' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'payment_section.php?token=28';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=28';
				</script>";
			}
		}else{
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=28';
				</script>";
		}
	}
}
if(isset($_POST["payment28"])){	
	$query=$sdc->query("select uain,form_id from sdc_form28 where user_id='$swr_id' and save_mode='P'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'payment_section.php?token=28';
			</script>";
	}else{
		if(empty($_POST["offline_challan"]) || $_POST["offline_challan"]=='2' || $_POST["offline_challan"]=='3'){
			echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'payment_section.php?token=28';
			</script>";
		}else{
			$row=$query->fetch_array();
			$form_id=$row["form_id"];$uain=$row["uain"];	
			$offline_challan=$_POST["offline_challan"];$payment_mode=0;
			$save_query=$sdc->query("update sdc_form28 set offline_challan='$offline_challan',payment_mode='$payment_mode',save_mode='C',sub_date='$today' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				$formFunctions->file_update($offline_challan);
				$formFunctions->insert_applications($uain);
				$str=$formFunctions->getEmail_str($uain);
				/////////////////////////////SEND MAIL////////////////////////////////
				$user_email=$formFunctions->get_usermail($swr_id);
				$dept_email="esgoa.sdc@gmail.com";
				require_once "sdc_form28_print.php"; 
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
						window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=28&dept=sdc';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form28.php';
					</script>";
				}
			}else{
				echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form28.php';
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
		   $form_id=$sdc->insert_id;
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
if(isset($_POST["save29"])) {	
	$licence_no=clean($_POST["licence_no"]);$location=clean($_POST["location"]);$homoeopathic=clean($_POST["homoeopathic"]);$input_size=$_POST["hiddenval"];
	$reg_fees="40";
	$sql=$sdc->query("select form_id from sdc_form29 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
	       $query=$sdc->query("insert into sdc_form29(user_id,sub_date,licence_no,location,homoeopathic,reg_fees) values ('$swr_id','$today', '$licence_no','$location','$homoeopathic','$reg_fees')") OR die("Error: ".$sdc->error);
		   $form_id=$sdc->insert_id;
	}else{  ////////////table is not empty//////////////
			$form_id=$row["form_id"];	
			$query=$sdc->query("update sdc_form29 set sub_date='$today', licence_no='$licence_no', location='$location', homoeopathic='$homoeopathic',reg_fees='$reg_fees' where form_id=$form_id") OR die("Error: ".$sdc->error);
	}	
	if($query){
		$formFunctions->insert_incomplete_forms('sdc','29'); //sdc-- dept name and 1 -- form no 
		if($input_size!=0){					
		$k=$sdc->query("delete from sdc_form29_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$part1=$sdc->query("INSERT INTO sdc_form29_t1(id,form_id,slno,name,qualification,experience,responsible) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')") or die("error in insertion sdc_form29_t1".$sdc->error);
				}
			}
		echo "<script>
						alert('Successfully Saved....');
						window.location.href = 'preview.php?token=29';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href ='sdc_form29.php';
					</script>";
				}			
}

if(isset($_POST["proceed29"])){
	$query=$sdc->query("select form_id,save_mode,courier_details from sdc_form29 where user_id='$swr_id' and active='1'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'sdc_form29.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'sdc','29');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$sdc->query("update sdc_form29 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=sdc&form=29';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=29';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$sdc->query("update sdc_form29 set sub_date='$today',uain='$uain',save_mode='P' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'payment_section.php?token=29';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=29';
				</script>";
			}
		}else{
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=29';
				</script>";
		}
	}
}
if(isset($_POST["payment29"])){	
	$query=$sdc->query("select uain,form_id from sdc_form29 where user_id='$swr_id' and save_mode='P'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'payment_section.php?token=29';
			</script>";
	}else{
		if(empty($_POST["offline_challan"]) || $_POST["offline_challan"]=='2' || $_POST["offline_challan"]=='3'){
			echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'payment_section.php?token=29';
			</script>";
		}else{
			$row=$query->fetch_array();
			$form_id=$row["form_id"];$uain=$row["uain"];	
			$offline_challan=$_POST["offline_challan"];$payment_mode=0;
			$save_query=$sdc->query("update sdc_form29 set offline_challan='$offline_challan',payment_mode='$payment_mode',save_mode='C',sub_date='$today' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				$formFunctions->file_update($offline_challan);
				$formFunctions->insert_applications($uain);
				$str=$formFunctions->getEmail_str($uain);
				/////////////////////////////SEND MAIL////////////////////////////////
				$user_email=$formFunctions->get_usermail($swr_id);
				$dept_email="esgoa.sdc@gmail.com";
				require_once "sdc_form29_print.php"; 
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
						window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=29&dept=sdc';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form29.php';
					</script>";
				}
			}else{
				echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form29.php';
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
		   $form_id=$sdc->insert_id;
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
				$part1=$sdc->query("INSERT INTO sdc_form10_t1(id,form_id,slno,name,qualification,experience,responsible) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')") or die("error in insertion sdc_form10_t1".$sdc->error);
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
if(isset($_POST["save30"])) {	
	$drug=clean($_POST["drug"]);$input_size=$_POST["hiddenval"];
	$reg_fees="40";
	$sql=$sdc->query("select form_id from sdc_form30 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
	       $query=$sdc->query("insert into sdc_form30(user_id,sub_date,drug,reg_fees) values ('$swr_id','$today', '$drug','$reg_fees')") OR die("Error: ".$sdc->error);
		   $form_id=$sdc->insert_id;
	}else{  ////////////table is not empty//////////////
			$form_id=$row["form_id"];	
			$query=$sdc->query("update sdc_form30 set sub_date='$today', drug='$drug',reg_fees='$reg_fees' where form_id=$form_id") OR die("Error: ".$sdc->error);
	}	
	if($query){
		$formFunctions->insert_incomplete_forms('sdc','30'); //sdc-- dept name and 1 -- form no 
		if($input_size!=0){					
		$k=$sdc->query("delete from sdc_form30_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$part1=$sdc->query("INSERT INTO sdc_form30_t1(id,form_id,slno,name,qualification,experience,responsible) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')") or die("error in insertion sdc_form30_t1".$sdc->error);
				}
			}
		echo "<script>
						alert('Successfully Saved....');
						window.location.href = 'preview.php?token=30';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href ='sdc_form30.php';
					</script>";
				}			
}

if(isset($_POST["proceed30"])){
	$query=$sdc->query("select form_id,save_mode,courier_details from sdc_form30 where user_id='$swr_id' and active='1'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'sdc_form30.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'sdc','30');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$sdc->query("update sdc_form30 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=sdc&form=30';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=30';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$sdc->query("update sdc_form30 set sub_date='$today',uain='$uain',save_mode='P' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'payment_section.php?token=30';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=30';
				</script>";
			}
		}else{
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=30';
				</script>";
		}
	}
}
if(isset($_POST["payment30"])){	
	$query=$sdc->query("select uain,form_id from sdc_form30 where user_id='$swr_id' and save_mode='P'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'payment_section.php?token=30';
			</script>";
	}else{
		if(empty($_POST["offline_challan"]) || $_POST["offline_challan"]=='2' || $_POST["offline_challan"]=='3'){
			echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'payment_section.php?token=30';
			</script>";
		}else{
			$row=$query->fetch_array();
			$form_id=$row["form_id"];$uain=$row["uain"];	
			$offline_challan=$_POST["offline_challan"];$payment_mode=0;
			$save_query=$sdc->query("update sdc_form30 set offline_challan='$offline_challan',payment_mode='$payment_mode',save_mode='C',sub_date='$today' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				$formFunctions->file_update($offline_challan);
				$formFunctions->insert_applications($uain);
				$str=$formFunctions->getEmail_str($uain);
				/////////////////////////////SEND MAIL////////////////////////////////
				$user_email=$formFunctions->get_usermail($swr_id);
				$dept_email="esgoa.sdc@gmail.com";
				require_once "sdc_form30_print.php"; 
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
						window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=30&dept=sdc';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form30.php';
					</script>";
				}
			}else{
				echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form30.php';
					</script>";
			}			
		}
	}
}
if(isset($_POST["save11"])){		
	$drug_name=clean($_POST["drug_name"]);$inspection_date=clean( $_POST["inspection_date"]);
	$input_size=$_POST["hiddenval"];$reg_fees="40";
	$sql=$sdc->query("select form_id from sdc_form11 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$sdc->query("insert into sdc_form11(user_id,sub_date,drug_name,inspection_date,reg_fees) values ('$swr_id','$today', '$drug_name','$inspection_date','$reg_fees')") OR die("Error: ".$sdc->error);
			$form_id=$sdc->insert_id;
	}else{
		$form_id=$row["form_id"];	
		$query=$sdc->query("update sdc_form11 set sub_date='$today',  drug_name='$drug_name',inspection_date='$inspection_date',reg_fees='$reg_fees' where form_id=$form_id") OR die("Error: ".$sdc->error);		
	}				
	if($query){
		$formFunctions->insert_incomplete_forms('sdc','11'); //sdc-- dept name and 1 -- form no 
			if($input_size!=0){					
			$k=$sdc->query("delete from sdc_form11_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$part1=$sdc->query("INSERT INTO sdc_form11_t1(id,form_id,slno,name,qualification,experience,responsible) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')") or die("error in insertion sdc_form11_t1".$sdc->error);
				}
			}
		echo "<script>
						alert('Successfully Saved....');
						window.location.href = 'preview.php?token=11';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href ='sdc_form11.php?tab=2';
					</script>";
				}			
}
if(isset($_POST["proceed11"])){
	$query=$sdc->query("select form_id,save_mode,courier_details from sdc_form11 where user_id='$swr_id' and active='1'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'sdc_form11.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'sdc','11');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$sdc->query("update sdc_form11 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=sdc&form=11';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=11';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$sdc->query("update sdc_form11 set sub_date='$today',uain='$uain',save_mode='P' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'payment_section.php?token=11';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=11';
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
if(isset($_POST["payment11"])){	
	$query=$sdc->query("select uain,form_id from sdc_form11 where user_id='$swr_id' and save_mode='P'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'payment_section.php?token=11';
			</script>";
	}else{
		if(empty($_POST["offline_challan"]) || $_POST["offline_challan"]=='2' || $_POST["offline_challan"]=='3'){
			echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'payment_section.php?token=11';
			</script>";
		}else{
			$row=$query->fetch_array();
			$form_id=$row["form_id"];$uain=$row["uain"];	
			$offline_challan=$_POST["offline_challan"];$payment_mode=0;
			$save_query=$sdc->query("update sdc_form11 set offline_challan='$offline_challan',payment_mode='$payment_mode',save_mode='C',sub_date='$today' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				$formFunctions->file_update($offline_challan);
				$formFunctions->insert_applications($uain);
				$str=$formFunctions->getEmail_str($uain);
				/////////////////////////////SEND MAIL////////////////////////////////
				$user_email=$formFunctions->get_usermail($swr_id);
				$dept_email="esgoa.sdc@gmail.com";
				require_once "sdc_form11_print.php"; 
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
						window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=11&dept=sdc';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form11.php';
					</script>";
				}
			}else{
				echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form11.php';
					</script>";
			}			
		}
	}
}
if(isset($_POST["save31"])){		
	$drug_name=clean($_POST["drug_name"]);$inspection_date=clean( $_POST["inspection_date"]);
	$input_size=$_POST["hiddenval"];$reg_fees="40";
	$sql=$sdc->query("select form_id from sdc_form31 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$sdc->query("insert into sdc_form31(user_id,sub_date,drug_name,inspection_date,reg_fees) values ('$swr_id','$today', '$drug_name','$inspection_date','$reg_fees')") OR die("Error: ".$sdc->error);
			$form_id=$sdc->insert_id;
	}else{
		$form_id=$row["form_id"];	
		$query=$sdc->query("update sdc_form31 set sub_date='$today',  drug_name='$drug_name',inspection_date='$inspection_date',reg_fees='$reg_fees' where form_id=$form_id") OR die("Error: ".$sdc->error);		
	}				
	if($query){
		$formFunctions->insert_incomplete_forms('sdc','31'); //sdc-- dept name and 1 -- form no 
			if($input_size!=0){					
			$k=$sdc->query("delete from sdc_form31_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$part1=$sdc->query("INSERT INTO sdc_form31_t1(id,form_id,slno,name,qualification,experience,responsible) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')") or die("error in insertion sdc_form31_t1".$sdc->error);
				}
			}
		echo "<script>
						alert('Successfully Saved....');
						window.location.href = 'preview.php?token=31';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href ='sdc_form31.php?tab=2';
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
if(isset($_POST["save12"])){		
	$drug_name=clean($_POST["drug_name"]);$co_name=clean( $_POST["co_name"]);
	$input_size=$_POST["hiddenval"];$reg_fees="40";
	$sql=$sdc->query("select form_id from sdc_form12 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$sdc->query("insert into sdc_form12(user_id,sub_date,drug_name,co_name,reg_fees) values ('$swr_id','$today', '$drug_name','$co_name','$reg_fees')") OR die("Error: ".$sdc->error);
			$form_id=$sdc->insert_id;
	}else{
		$form_id=$row["form_id"];	
		$query=$sdc->query("update sdc_form12 set sub_date='$today',  drug_name='$drug_name',co_name='$co_name',reg_fees='$reg_fees' where form_id=$form_id") OR die("Error: ".$sdc->error);		
	}				
	if($query){
		$formFunctions->insert_incomplete_forms('sdc','12'); //sdc-- dept name and 1 -- form no 
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
				window.location.href = 'payment_section.php?token=12;
			</script>";
	}else{
		if(empty($_POST["offline_challan"]) || $_POST["offline_challan"]=='2' || $_POST["offline_challan"]=='3'){
			echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'payment_section.php?token=12;
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
if(isset($_POST["save32"])){		
	$drug_name=clean($_POST["drug_name"]);$co_name=clean( $_POST["co_name"]);
	$input_size=$_POST["hiddenval"];$reg_fees="40";
	$sql=$sdc->query("select form_id from sdc_form32 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$sdc->query("insert into sdc_form32(user_id,sub_date,drug_name,co_name,reg_fees) values ('$swr_id','$today', '$drug_name','$co_name','$reg_fees')") OR die("Error: ".$sdc->error);
			$form_id=$sdc->insert_id;
	}else{
		$form_id=$row["form_id"];	
		$query=$sdc->query("update sdc_form32 set sub_date='$today',  drug_name='$drug_name',co_name='$co_name',reg_fees='$reg_fees' where form_id=$form_id") OR die("Error: ".$sdc->error);		
	}				
	if($query){
		$formFunctions->insert_incomplete_forms('sdc','32'); //sdc-- dept name and 1 -- form no 
			if($input_size!=0){					
			$k=$sdc->query("delete from sdc_form32_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$part1=$sdc->query("INSERT INTO sdc_form32_t1(id,form_id,slno,name,qualification,experience,responsible) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')") or die("error in insertion sdc_form32_t1".$sdc->error);
				}
			}
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
				window.location.href = 'payment_section.php?token=32;
			</script>";
	}else{
		if(empty($_POST["offline_challan"]) || $_POST["offline_challan"]=='2' || $_POST["offline_challan"]=='3'){
			echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'payment_section.php?token=32;
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
if(isset($_POST["save13"])){		
	$drug_name=clean($_POST["drug_name"]);$staff_manuf=clean( $_POST["staff_manuf"]);
	$input_size=$_POST["hiddenval"];$reg_fees="40";
	$sql=$sdc->query("select form_id from sdc_form13 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$sdc->query("insert into sdc_form13(user_id,sub_date,drug_name,staff_manuf,reg_fees) values ('$swr_id','$today', '$drug_name','$staff_manuf','$reg_fees')") OR die("Error: ".$sdc->error);
			$form_id=$sdc->insert_id;
	}else{
		$form_id=$row["form_id"];	
			$query=$sdc->query("update sdc_form13 set sub_date='$today',  drug_name='$drug_name',staff_manuf='$staff_manuf',reg_fees='$reg_fees' where form_id=$form_id") OR die("Error: ".$sdc->error);			
	}				
	if($query){
		$formFunctions->insert_incomplete_forms('sdc','13'); //sdc-- dept name and 1 -- form no 
			if($input_size!=0){					
			$k=$sdc->query("delete from sdc_form13_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$part1=$sdc->query("INSERT INTO sdc_form13_t1(id,form_id,slno,name,qualification,experience,responsible) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')") or die("error in insertion sdc_form13_t1".$sdc->error);
				}
			}
		echo "<script>
						alert('Successfully Saved....');
						window.location.href = 'preview.php?token=13';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href ='sdc_form13.php';
					</script>";
				}			
}
		
if(isset($_POST["proceed13"])){
	$query=$sdc->query("select form_id,save_mode,courier_details from sdc_form13 where user_id='$swr_id' and active='1'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'sdc_form13.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'sdc','13');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$sdc->query("update sdc_form13 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=sdc&form=13';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=13';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$sdc->query("update sdc_form13 set sub_date='$today',uain='$uain',save_mode='P' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'payment_section.php?token=13';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=13';
				</script>";
			}
		}else{
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=13';
				</script>";
		}
	}
}
if(isset($_POST["payment13"])){	
	$query=$sdc->query("select uain,form_id from sdc_form13 where user_id='$swr_id' and save_mode='P'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'payment_section.php?token=13;
			</script>";
	}else{
		if(empty($_POST["offline_challan"]) || $_POST["offline_challan"]=='2' || $_POST["offline_challan"]=='3'){
			echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'payment_section.php?token=13;
			</script>";
		}else{
			$row=$query->fetch_array();
			$form_id=$row["form_id"];$uain=$row["uain"];	
			$offline_challan=$_POST["offline_challan"];$payment_mode=0;
			$save_query=$sdc->query("update sdc_form13 set offline_challan='$offline_challan',payment_mode='$payment_mode',save_mode='C',sub_date='$today' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				$formFunctions->file_update($offline_challan);
				$formFunctions->insert_applications($uain);
				$str=$formFunctions->getEmail_str($uain);
				/////////////////////////////SEND MAIL////////////////////////////////
				$user_email=$formFunctions->get_usermail($swr_id);
				$dept_email="esgoa.sdc@gmail.com";
				require_once "sdc_form13_print.php"; 
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
						window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=13&dept=sdc';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form13.php';
					</script>";
				}
			}else{
				echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form13.php';
					</script>";
			}			
		}
	}
}
if(isset($_POST["save14"])){		
	$license_no=clean($_POST["license_no"]);$license_date=clean( $_POST["license_date"]);$staff_manuf=clean( $_POST["staff_manuf"]);
	$input_size=$_POST["hiddenval"];$input_size2=$_POST["hiddenval2"];$reg_fees="40";
	$sql=$sdc->query("select form_id from sdc_form14 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$sdc->query("insert into sdc_form14(user_id,sub_date,license_no,license_date,staff_manuf,reg_fees) values ('$swr_id','$today', '$license_no','$license_date','$staff_manuf','$reg_fees')") OR die("Error: ".$sdc->error);
			$form_id=$sdc->insert_id;
	}else{
		$form_id=$row["form_id"];	
		$query=$sdc->query("update sdc_form14 set sub_date='$today',  license_no='$license_no',license_date='$license_date',staff_manuf='$staff_manuf',reg_fees='$reg_fees' where form_id=$form_id") OR die("Error: ".$sdc->error);		
	}				
	if($query){
		$formFunctions->insert_incomplete_forms('sdc','14'); //sdc-- dept name and 1 -- form no 
			if($input_size!=0){					
			$k=$sdc->query("delete from sdc_form14_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txttB".$i];
				$part1=$sdc->query("INSERT INTO sdc_form14_t1(id,form_id,slno,name) VALUES ('','$form_id','$i','$valb')") or die("error in insertion sdc_form14_t1".$sdc->error);
				}
			}
			if($input_size2!=0){					
			$k=$sdc->query("delete from sdc_form14_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$part2=$sdc->query("INSERT INTO sdc_form14_t2(id,form_id,slno,name,qualification,experience,responsible) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')") or die("error in insertion sdc_form14_t2".$sdc->error);
				}
			}
		echo "<script>
						alert('Successfully Saved....');
						window.location.href = 'preview.php?token=14';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href ='sdc_form14.php';
					</script>";
				}			
}
if(isset($_POST["proceed14"])){
	$query=$sdc->query("select form_id,save_mode,courier_details from sdc_form14 where user_id='$swr_id' and active='1'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'sdc_form14.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'sdc','14');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$sdc->query("update fcs_form14 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=sdc&form=14';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=14';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$sdc->query("update sdc_form14 set sub_date='$today',uain='$uain',save_mode='P' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'payment_section.php?token=14';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=14';
				</script>";
			}
		}else{
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=14';
				</script>";
		}
	}
}
if(isset($_POST["payment14"])){	
	$query=$sdc->query("select uain,form_id from sdc_form14 where user_id='$swr_id' and save_mode='P'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'payment_section.php?token=14;
			</script>";
	}else{
		if(empty($_POST["offline_challan"]) || $_POST["offline_challan"]=='2' || $_POST["offline_challan"]=='3'){
			echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'payment_section.php?token=14;
			</script>";
		}else{
			$row=$query->fetch_array();
			$form_id=$row["form_id"];$uain=$row["uain"];	
			$offline_challan=$_POST["offline_challan"];$payment_mode=0;
			$save_query=$sdc->query("update sdc_form14 set offline_challan='$offline_challan',payment_mode='$payment_mode',save_mode='C',sub_date='$today' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				$formFunctions->file_update($offline_challan);
				$formFunctions->insert_applications($uain);
				$str=$formFunctions->getEmail_str($uain);
				/////////////////////////////SEND MAIL////////////////////////////////
				$user_email=$formFunctions->get_usermail($swr_id);
				$dept_email="esgoa.sdc@gmail.com";
				require_once "sdc_form14_print.php"; 
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
						window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=14&dept=sdc';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'fcs_form14.php';
					</script>";
				}
			}else{
				echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'fcs_form14.php';
					</script>";
			}			
		}
	}
}
if(isset($_POST["save15"])){		
	$license_no=clean($_POST["license_no"]);$license_date=clean( $_POST["license_date"]);$inspection=clean( $_POST["inspection"]);
	$input_size=$_POST["hiddenval"];$input_size1=$_POST["hiddenval2"];$reg_fees="40";
	$sql=$sdc->query("select form_id from sdc_form15 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$sdc->query("insert into sdc_form15(user_id,sub_date,license_no,license_date,inspection,reg_fees) values ('$swr_id','$today', '$license_no','$license_date','$inspection','$reg_fees')") OR die("Error: ".$sdc->error);
		$form_id=$sdc->insert_id;
	}else{
		$form_id=$row["form_id"];	
		$query=$sdc->query("update sdc_form15 set sub_date='$today', license_no='$license_no',license_date='$license_date',inspection='$inspection',reg_fees='$reg_fees' where form_id=$form_id") OR die("Error: ".$sdc->error);		
	}				
	if($query){
		$formFunctions->insert_incomplete_forms('sdc','15'); //sdc-- dept name and 1 -- form no 
			if($input_size!=0){					
			$k=$sdc->query("delete from sdc_form15_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txttB".$i];
				$part1=$sdc->query("INSERT INTO sdc_form15_t1(id,form_id,slno,name) VALUES ('','$form_id','$i','$valb')") or die("error in insertion sdc_form15_t1".$sdc->error);
				}
			}
			if($input_size1!=0){					
			$k=$sdc->query("delete from sdc_form15_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size1;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$part1=$sdc->query("INSERT INTO sdc_form15_t2(id,form_id,slno,name,qualification,experience,responsible) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')") or die("error in insertion sdc_form15_t2".$sdc->error);
				}
			}
		echo "<script>
						alert('Successfully Saved....');
						window.location.href = 'preview.php?token=15';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href ='sdc_form15.php';
					</script>";
				}			
}
if(isset($_POST["proceed15"])){
	$query=$sdc->query("select form_id,save_mode,courier_details from sdc_form15 where user_id='$swr_id' and active='1'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'sdc_form15.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'sdc','15');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$sdc->query("update sdc_form15 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=sdc&form=15';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=15';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$sdc->query("update sdc_form15 set sub_date='$today',uain='$uain',save_mode='P' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'payment_section.php?token=15';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=15';
				</script>";
			}
		}else{
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=15';
				</script>";
		}
	}
}
if(isset($_POST["payment15"])){	
	$query=$sdc->query("select uain,form_id from sdc_form15 where user_id='$swr_id' and save_mode='P'") or die("Error :". $sdc->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'payment_section.php?token=15;
			</script>";
	}else{
		if(empty($_POST["offline_challan"]) || $_POST["offline_challan"]=='2' || $_POST["offline_challan"]=='3'){
			echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'payment_section.php?token=15;
			</script>";
		}else{
			$row=$query->fetch_array();
			$form_id=$row["form_id"];$uain=$row["uain"];	
			$offline_challan=$_POST["offline_challan"];$payment_mode=0;
			$save_query=$sdc->query("update sdc_form15 set offline_challan='$offline_challan',payment_mode='$payment_mode',save_mode='C',sub_date='$today' where form_id='$form_id'") or die($sdc->error);
			if($save_query){
				$formFunctions->file_update($offline_challan);
				$formFunctions->insert_applications($uain);
				$str=$formFunctions->getEmail_str($uain);
				/////////////////////////////SEND MAIL////////////////////////////////
				$user_email=$formFunctions->get_usermail($swr_id);
				$dept_email="esgoa.sdc@gmail.com";
				require_once "sdc_form15_print.php"; 
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
						window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=15&dept=sdc';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form15.php';
					</script>";
				}
			}else{
				echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'sdc_form15.php';
					</script>";
			}			
		}
	}
}
if(isset($_POST["save16"])){		
	$cosmetics_names=clean($_POST["cosmetics_names"]);
	$input_size=$_POST["hiddenval"];$reg_fees="40";
	$sql=$sdc->query("select form_id from sdc_form16 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$sdc->query("insert into sdc_form16(user_id,sub_date,cosmetics_names,reg_fees) values ('$swr_id','$today', '$cosmetics_names','$reg_fees')") OR die("Error: ".$sdc->error);
			$form_id=$sdc->insert_id;
	}else{
		$form_id=$row["form_id"];	
		$query=$sdc->query("update sdc_form16 set sub_date='$today',  cosmetics_names='$cosmetics_names',reg_fees='$reg_fees' where form_id=$form_id") OR die("Error: ".$sdc->error);		
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
if(isset($_POST["save17"])){		
	$cosmetics_names=clean($_POST["cosmetics_names"]);$co_name=clean($_POST["co_name"]);
	$input_size=$_POST["hiddenval"];$reg_fees="40";
	$sql=$sdc->query("select form_id from sdc_form17 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$sdc->query("insert into sdc_form17(user_id,sub_date,cosmetics_names,co_name,reg_fees) values ('$swr_id','$today', '$cosmetics_names','$co_name','$reg_fees')") OR die("Error: ".$sdc->error);
			$form_id=$sdc->insert_id;
	}else{
		$form_id=$row["form_id"];	
		$query=$sdc->query("update sdc_form17 set sub_date='$today',  cosmetics_names='$cosmetics_names',co_name='$co_name',reg_fees='$reg_fees' where form_id=$form_id") OR die("Error: ".$sdc->error);		
	}				
	if($query){
		$formFunctions->insert_incomplete_forms('sdc','17'); //sdc-- dept name and 1 -- form no 			
			if($input_size!=0){					
			$k=$sdc->query("delete from sdc_form17_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$part1=$sdc->query("INSERT INTO sdc_form17_t1(id,form_id,slno,name,qualification,experience,responsible) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')") or die("error in insertion sdc_form17_t1".$sdc->error);
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
if(isset($_POST["save20a"])) {	
	$edu_qualification=clean($_POST["edu_qualification"]);$incharge=clean($_POST["incharge"]);$business_past=clean($_POST["business_past"]);$is_engaged=clean($_POST["is_engaged"]);$is_engaged_detail=clean($_POST["is_engaged_detail"]);$business_present=clean($_POST["business_present"]);$is_license=clean($_POST["is_license"]);$lic_granted=clean($_POST["lic_granted"]);$particulars_license=clean($_POST["particulars_license"]);$is_warned=clean($_POST["is_warned"]);$is_act1940=clean($_POST["is_act1940"]);$is_act1930=clean($_POST["is_act1930"]);$is_act1919=clean($_POST["is_act1919"]);$is_act1948=clean($_POST["is_act1948"]);$other_act=clean($_POST["other_act"]);
	$hidden_value=clean($_POST["hidden_value"]);
	$sql=$sdc->query("select form_id from sdc_form20 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
	       $query=$sdc->query("insert into sdc_form20(user_id,sub_date,edu_qualification,incharge,business_past,is_engaged,is_engaged_detail,business_present,is_license,lic_granted,particulars_license,is_warned,is_act1940,is_act1930,is_act1919,is_act1948,other_act) values ('$swr_id','$today', '$edu_qualification','$incharge',  '$business_past', '$is_engaged','$is_engaged_detail','$business_present','$is_license','$lic_granted','$particulars_license','$is_warned','$is_act1940','$is_act1930','$is_act1919','$is_act1948','$other_act')") OR die("Error: ".$sdc->error);
		$form_id=$sdc->insert_id;
		for($i=1;$i<=$hidden_value;$i++){
			$name=$_POST["name".$i.""];$address=$_POST["address".$i.""];$pincode=$_POST["pincode".$i.""];$contact=$_POST["contact".$i.""];
			$query1=$sdc->query("INSERT INTO sdc_form20_members(id,form_id,sl_no,name,address,pincode,contact) VALUES ('','$form_id','$i','$name','$address','$pincode','$contact')") or die("error1 in insertion sdc_form20_members".$sdc->error);	
		}
	}else{  ////////////table is not empty//////////////
			$form_id=$row["form_id"];	
			$query=$sdc->query("update sdc_form20 set sub_date='$today', edu_qualification='$edu_qualification', incharge='$incharge',  business_past='$business_past', is_engaged='$is_engaged',is_engaged_detail='$is_engaged_detail',business_present='$business_present' ,is_license='$is_license',lic_granted='$lic_granted',particulars_license='$particulars_license',is_warned='$is_warned',is_act1940='$is_act1940',is_act1930='$is_act1930',is_act1919='$is_act1919',is_act1948='$is_act1948',other_act='$other_act' where form_id=$form_id") OR die("Error: ".$sdc->error);
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$address=$_POST["address".$i.""];$pincode=$_POST["pincode".$i.""];$contact=$_POST["contact".$i.""];			
				$query1=$sdc->query("update sdc_form20_members set name='$name',address='$address',pincode='$pincode',contact='$contact' where form_id='$form_id' and sl_no='$i'") or die("error in insertion sdc_form20_members".$sdc->error);
			}
	}	
	if($query){
		$formFunctions->insert_incomplete_forms('sdc','20'); //sdc-- dept name and 1 -- form no
		echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'sdc_form20.php?tab=2';
			</script>";			
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'sdc_form20.php?tab=1';
		</script>";
	}						
}
if(isset($_POST["save20b"])) {	
	$is_imported=clean($_POST["is_imported"]);$statement=clean($_POST["statement"]);$is_distributor=clean($_POST["is_distributor"]);$distributor=clean($_POST["distributor"]);$firm_cat=clean($_POST["firm_cat"]);$area_room=clean($_POST["area_room"]);$classes_drug=clean($_POST["classes_drug"]);$commodities=clean($_POST["commodities"]);$liquor=clean($_POST["liquor"]);$hours_days=clean($_POST["hours_days"]);
	if(!empty($_POST["premises"]))	 $premises=json_encode($_POST["premises"]);
	else	$premises=NULL;
	$sql=$sdc->query("select form_id from sdc_form20 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
	       $query=$sdc->query("insert into sdc_form20(user_id,sub_date,is_imported,statement,is_distributor,distributor,firm_cat,area_room,premises,classes_drug,commodities,liquor,hours_days) values ('$swr_id','$today', '$is_imported','$statement', '$is_distributor', '$distributor','$firm_cat','$area_room','$premises','$classes_drug','$commodities','$liquor','$hours_days')") OR die("Error: ".$sdc->error);
		  
	}else{  ////////////table is not empty//////////////
			$form_id=$row["form_id"];	
			$query=$sdc->query("update sdc_form20 set sub_date='$today', is_imported='$is_imported', statement='$statement',  is_distributor='$is_distributor', distributor='$distributor',firm_cat='$firm_cat',area_room='$area_room' ,premises='$premises',classes_drug='$classes_drug',commodities='$commodities',liquor='$liquor',hours_days='$hours_days' where form_id=$form_id") OR die("Error: ".$sdc->error);
			
	}	
	if($query){
		$formFunctions->insert_incomplete_forms('sdc','20'); //sdc-- dept name and 1 -- form no
		echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'preview.php?token=20';
			</script>";			
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'sdc_form20.php?tab=2';
		</script>";
	}						
}
if(isset($_POST["proceed20"])){
	$form_id=$sdc->query("select form_id from sdc_form20 where user_id='$swr_id' and active='1'")->fetch_object()->form_id;
	$uain=$formFunctions->create_uain($form_id,'sdc','20');
	$save_query=$sdc->query("update sdc_form20 set save_mode='C',uain='$uain' where form_id='$form_id'") OR die("Error: ".$sdc->error);	
			/////////////////////////////SEND MAIL////////////////////////////////
	if($save_query){
		$formFunctions->insert_applications($uain);
		$str=$formFunctions->getEmail_str($uain);
		$user_email=$formFunctions->get_usermail($swr_id);
		
		$dept_email="esgoa.sdc@gmail.com";
		require_once "sdc_form20_print.php"; 
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
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=20&dept=sdc';
			</script>";
	}else{
			echo "<script>
				alert('Invalid Entry');
				window.location.href = 'sdc_form20.php';
			</script>";
	}
}
?>