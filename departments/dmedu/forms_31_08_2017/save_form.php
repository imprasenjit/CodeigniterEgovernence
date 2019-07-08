<?php
if(isset($_POST["save1"])){	
	
		$father_name=clean($_POST["father_name"]);$completion_date=clean($_POST["completion_date"]);$registration=clean($_POST["registration"]);	
		
			
		$input_size1=$_POST["hiddenval"];
		
			$sql=$dmedu->query("select form_id from dmedu_form1 where user_id='$swr_id' and active='1'");
			$row=$sql->fetch_array();
			
				if($sql->num_rows<1){   ////////////table is empty//////////////				
					$query=$dmedu->query("insert into dmedu_form1(user_id,sub_date,father_name,completion_date,registration) values ('$swr_id','$today','$father_name','$completion_date','$registration')") OR die("Error 1: ".$dmedu->error);
					$form_id=$dmedu->insert_id;
				}else{
					$form_id=$row["form_id"];	
					$query=$dmedu->query("update dmedu_form1 set sub_date='$today', father_name='$father_name',completion_date='$completion_date',registration='$registration' where user_id='$swr_id' and form_id='$form_id'") OR die("Error 2: ".$dmedu->error);	
				}				
		if($query){
		$formFunctions->insert_incomplete_forms('dmedu','1'); //dmedu-- dept name and 1-- form no 
		if($input_size1!=0){					
			$k=$dmedu->query("delete from dmedu_form1_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size1;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txxtB".$i];
				$valc=$_POST["txxtC".$i];
				
				$part1=$dmedu->query("INSERT INTO dmedu_form1_t1(id,form_id,slno,qualification,pass_date) VALUES ('','$form_id','$i','$valb','$valc')") or die("error in insertion dmedu_form1".$dmedu->error);
				}
			}
			
			
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = 'dmedu_form1.php?tab=2';
		</script>";		
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'dmedu_form1.php?tab=1';
		</script>";
	}				
}

if(isset($_POST["submit1"])){
	if((isset($_POST["mfile1"]) && empty($_POST["mfile1"])) || (isset($_POST["mfile2"]) && empty($_POST["mfile2"])) || (isset($_POST["mfile1"]) && $_POST["mfile1"]=='2') || (isset($_POST["mfile2"]) && $_POST["mfile2"]=='2') || (isset($_POST["mfile1"]) && $_POST["mfile1"]=='3') || (isset($_POST["mfile2"]) && $_POST["mfile2"]=='3') ){
			echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'dmedu_form1.php?tab=2';
			</script>";
	}else{
		$file1=clean($_POST["mfile1"]);
		$file2=clean($_POST["mfile2"]);
		$sql=$dmedu->query("select form_id from dmedu_form1 where user_id='$swr_id' and active='1'");		
			if($sql->num_rows<1){				
				echo "<script>
					alert('Please fill the first part of the form.');
					window.location.href = 'dmedu_form1.php';
				</script>";
			}else{
				$row=$sql->fetch_array();
				$form_id=$row["form_id"];
				$savequery=$dmedu->query("update dmedu_form1 set file1='$file1',file2='$file2' where form_id='$form_id'") or die($dmedu->error);
			}				
			if($savequery){
				$formFunctions->file_update($file1);
				$formFunctions->file_update($file2);
				
				if($file1=="SC" || $file2=="SC" ){
					$save_query=$dmedu->query("update dmedu_form1 set courier_details='1', sub_date='$today' where form_id='$form_id'") or die($dmedu->error);
				}else{
					//$courier_details=NULL;
					$save_query=$dmedu->query("update dmedu_form1 set sub_date='$today',courier_details=NULL where form_id='$form_id'") or die($dmedu->error);
				}
				if($save_query){
					echo "<script>
						alert('Successfully Saved....');
						window.location.href = 'preview.php?token=1';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href ='dmedu_form1.php?tab=1';
					</script>";
				}			
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href ='dmedu_form1.php?tab=1';
				</script>";
			}
		}
		
}

if(isset($_POST["proceed1"])){
	$sql=$dmedu->query("select form_id,save_mode,courier_details from dmedu_form1 where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'dmedu_form1.php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'dmedu','1');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$dmedu->query("update dmedu_form1 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($dmedu->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=dmedu&form=1';
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
			/*----------------SEND MAIL-----------------*/
			$user_email=$formFunctions->get_usermail($swr_id);
			$dept_email="esgoa.dmedu@gmail.com";
			
			require_once "dmedu_form1_print.php"; 
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
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=1&dept=dmedu';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'dmedu_form1.php';
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
	
	$query=$dmedu->query("select uain,form_id from dmedu_form1 where user_id='$swr_id' and save_mode='P'") or die("Error :". $dmedu->error);
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
			$formFunctions->file_update($offline_challan);
			$save_query=$dmedu->query("update dmedu_form1 set offline_challan='$offline_challan',payment_mode='$payment_mode',save_mode='C',sub_date='$today' where form_id='$form_id'") or die($dmedu->error);
			if($save_query){
				$formFunctions->file_update($offline_challan);
				$formFunctions->insert_applications($uain);
				$str=$formFunctions->getEmail_str($uain);
				/////////////////////////////SEND MAIL////////////////////////////////
				$user_email=$formFunctions->get_usermail($swr_id);
				$dept_email="esgoa.dmedu@gmail.com";
				require_once "dmedu_form1_print.php"; 
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
						window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=1&dept=dmedu';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'dmedu_form1.php';
					</script>";
				}
			}else{
				echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'dmedu_form1.php';
					</script>";
			}			
		}
	}
}
?>