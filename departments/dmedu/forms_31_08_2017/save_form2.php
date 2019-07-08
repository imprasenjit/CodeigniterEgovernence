<?php
if(isset($_POST["save2"])){		
	$constitution=clean($_POST["constitution"]);$objectives=clean($_POST["objectives"]);
	if(!empty($_POST["reg"]))	 $reg=json_encode($_POST["reg"]);
	else	$reg=NULL;
	if(!empty($_POST["permission"]))	 $permission=json_encode($_POST["permission"]);
	else	$permission=NULL;
	if(!empty($_POST["affliation"]))	 $affliation=json_encode($_POST["affliation"]);
	else	$affliation=NULL;
	if(!empty($_POST["banker"]))	 $banker=json_encode($_POST["banker"]);
	else	$banker=NULL;
	$sql=$dmedu->query("select form_id from dmedu_form2 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$dmedu->query("insert into dmedu_form2(user_id,sub_date,constitution,objectives,reg,banker,affliation,permission,reg_fees) values ('$swr_id','$today', '$constitution', '$objectives', '$reg', '$banker',  '$affliation', '$permission', '200000')") OR die("Error: ".$dmedu->error);
	}else{
		$form_id=$row["form_id"];	
		$query=$dmedu->query("update dmedu_form2 set sub_date='$today', constitution='$constitution',  objectives='$objectives',reg='$reg', banker='$banker',  affliation='$affliation', permission='$permission', reg_fees='200000' where form_id=$form_id") OR die("Error: ".$dmedu->error);		
	}				
	if($query){
		$formFunctions->insert_incomplete_forms('dmedu','2'); //dmedu-- dept name and 1 -- form no 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = 'dmedu_form2.php?tab=2';
		</script>";		
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'dmedu_form2.php?tab=1';
		</script>";
	}			
}
if(isset($_POST["submit2"])){
	if(empty($_POST["mfile1"]) || empty($_POST["mfile2"]) || empty($_POST["mfile3"]) || empty($_POST["mfile4"]) || empty($_POST["mfile5"]) || empty($_POST["mfile6"]) || empty($_POST["mfile7"]) || empty($_POST["mfile8"]) || empty($_POST["mfile9"]) || $_POST["mfile1"]=='2' || $_POST["mfile2"]=='2' || $_POST["mfile3"]=='2' || $_POST["mfile4"]=='2' || $_POST["mfile5"]=='2' || $_POST["mfile6"]=='2' || $_POST["mfile7"]=='2' || $_POST["mfile8"]=='2' || $_POST["mfile9"]=='2' || $_POST["mfile1"]=='3' || $_POST["mfile2"]=='3' || $_POST["mfile3"]=='3' || $_POST["mfile4"]=='3' || $_POST["mfile5"]=='3' || $_POST["mfile6"]=='3' || $_POST["mfile7"]=='3' || $_POST["mfile8"]=='3' || $_POST["mfile9"]=='3' ){
			echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'dmedu_form2.php?tab=2';
			</script>";
	}else{
		$file1=clean($_POST["mfile1"]);$file2=clean($_POST["mfile2"]);$file3=clean($_POST["mfile3"]);$file4=clean($_POST["mfile4"]);$file5=clean($_POST["mfile5"]);$file6=clean($_POST["mfile6"]);$file7=clean($_POST["mfile7"]);$file8=clean($_POST["mfile8"]);$file9=clean($_POST["mfile9"]);
		$sql=$dmedu->query("select form_id from dmedu_form2 where user_id='$swr_id' and active='1'");		
			if($sql->num_rows<1){				
				echo "<script>
					alert('Please fill the first part of the form.');
					window.location.href = 'dmedu_form2.php';
				</script>";
			}else{
				$row=$sql->fetch_array();
				$form_id=$row["form_id"];
				$savequery=$dmedu->query("update dmedu_form2 set file1='$file1',file2='$file2',file3='$file3',file4='$file4',file5='$file5',file6='$file6',file7='$file7',file8='$file8',file9='$file9' where form_id='$form_id'") or die($dmedu->error);
			}		
			if($savequery){
				$formFunctions->file_update($file1);$formFunctions->file_update($file2);$formFunctions->file_update($file3);$formFunctions->file_update($file4);$formFunctions->file_update($file5);$formFunctions->file_update($file6);$formFunctions->file_update($file7);$formFunctions->file_update($file8);$formFunctions->file_update($file9);
				
				if($file1=="SC" || $file2=="SC" ||  $file3=="SC" ||  $file4=="SC"||  $file5=="SC"|| $file6=="SC" ||  $file7=="SC" ||  $file8=="SC"||  $file9=="SC"){
					$save_query=$dmedu->query("update dmedu_form2 set courier_details='1', sub_date='$today' where form_id='$form_id'") or die($dmedu->error);
				}else{
					//$courier_details=NULL;
					$save_query=$dmedu->query("update dmedu_form2 set sub_date='$today',courier_details=NULL where form_id='$form_id'") or die($dmedu->error);
				}
				if($save_query){
					echo "<script>
						alert('Successfully Saved....');
						window.location.href = 'preview.php?token=2';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href ='dmedu_form2.php?tab=2';
					</script>";
				}			
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href ='dmedu_form2.php?tab=2';
				</script>";
			}
		}		
}
if(isset($_POST["proceed2"])){
	$sql=$dmedu->query("select form_id,save_mode,courier_details from dmedu_form2 where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'dmedu_form2.php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'dmedu','2');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$dmedu->query("update dmedu_form2 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($dmedu->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=dmedu&form=2';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=2';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){			
			$save_query=$dmedu->query("update dmedu_form2 set sub_date='$today',uain='$uain',save_mode='P' where form_id='$form_id'") or die($dmedu->error);
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
	
	$query=$dmedu->query("select uain,form_id from dmedu_form2 where user_id='$swr_id' and save_mode='P'") or die("Error :". $dmedu->error);
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
			$form_id=$row["form_id"];				
			$uain=$row["uain"];				
			$offline_challan=$_POST["offline_challan"];
			
			$payment_mode=clean($_POST["payment_mode"]);
			$txn_date=clean($_POST["txn_date"]);
			$bank_name=clean($_POST["bank_name"]);
			$ref_no=clean($_POST["ref_no"]);
			$reg_fees=clean($_POST["reg_fees"]);
			
			$formFunctions->file_update($offline_challan);
			$update_result=$formFunctions->insert_offline_payment_details("dmedu",$uain,$reg_fees,$ref_no,$txn_date,$bank_name,"A");
			if($update_result==1){	
				$save_query=$dmedu->query("update dmedu_form2 set offline_challan='$offline_challan',payment_mode='$payment_mode',save_mode='C',sub_date='$today' where form_id='$form_id'") or die($dmedu->error);
				if($save_query){				
					$formFunctions->insert_applications($uain);
					$str=$formFunctions->getEmail_str($uain);
					/////////////////////////////SEND MAIL////////////////////////////////
					$user_email=$formFunctions->get_usermail($swr_id);
					$dept_email="esgoa.dmedu@gmail.com";
					require_once "dmedu_form2_print.php"; 
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
				
					echo "<script>
							alert('Successfully Submitted....');
							window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=2&dept=dmedu';
						</script>";
				}else{
					echo "<script>alert('Something went wrong !!!');window.location.href = 'payment_section.php?token=2';</script>";
				}
			}else{
				echo "<script>alert('Something went wrong !!!');window.location.href = 'payment_section.php?token=2';</script>";
			}
		}								
	}
}
?>