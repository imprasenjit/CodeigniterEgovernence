<?php
if(isset($_POST["save5"])){
       if((isset($_POST["details_upload"]) && empty($_POST["details_upload"])) || (isset($_POST["details_upload"]) && $_POST["details_upload"]=='2') || (isset($_POST["details_upload"]) && $_POST["details_upload"]=='3')){	
        echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'boiler_form5.php?tab=2';
			</script>";
	}else{
		$is_firm=clean($_POST["is_firm"]);
		$is_copy_report=clean($_POST["is_copy_report"]);
		$is_firm_prepared=clean($_POST["is_firm_prepared"]);
		$is_internal_quality=clean($_POST["is_internal_quality"]);
		$numeric_power_stn=clean($_POST["numeric_power_stn"]);
		$is_conservant=clean($_POST["is_conservant"]);
		$is_instruments=clean($_POST["is_instruments"]);
		$testing=clean($_POST["testing"]);
		$is_recording=clean($_POST["is_recording"]);
	    $details_upload=clean($_POST['details_upload']);
		$input_size1=$_POST["hiddenval"];$input_size2=$_POST["hiddenval2"];
		
			$sql=$boiler->query("select form_id from boiler_form5 where user_id='$swr_id' and active='1'");
			$row=$sql->fetch_array();
			if($sql->num_rows<1){   ////////////table is empty//////////////
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'boiler_form5.php';
		</script>";
		}else{ 
				$form_id=$row["form_id"];
				if($details_upload=="SC")
					$query=$boiler->query("update boiler_form5 set sub_date='$today', is_copy_report='$is_copy_report',is_firm_prepared='$is_firm_prepared',is_firm='$is_firm',is_internal_quality='$is_internal_quality',numeric_power_stn='$numeric_power_stn', is_conservant='$is_conservant',is_instruments='$is_instruments',testing='$testing',is_recording='$is_recording' where user_id='$swr_id' and form_id='$form_id'") OR die("Error 2: ".$boiler->error);
				
				}else{
					
					$query=$boiler->query("update boiler_form5 set sub_date='$today', is_copy_report='$is_copy_report',is_firm_prepared='$is_firm_prepared',is_firm='$is_firm',is_internal_quality='$is_internal_quality',numeric_power_stn='$numeric_power_stn', is_conservant='$is_conservant',is_instruments='$is_instruments',testing='$testing',is_recording='$is_recording' where user_id='$swr_id' and form_id='$form_id'") OR die("Error 2: ".$boiler->error);	
				}				
		if($query){
		$formFunctions->insert_incomplete_forms('boiler','5'); //boiler-- dept name and 3 -- form no 
		if($input_size1!=0){					
			$k=$boiler->query("delete from boiler_form5_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size1;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vald=$_POST["txtE".$i];
				$part1=$boiler->query("INSERT INTO boiler_form5_t1(id,form_id,slno,details_technical,details_supervisory,qualification,experience) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')") or die("error in insertion boiler_form3_t1".$boiler->error);
				}
			}
			if($input_size2!=0){					
			$k=$boiler->query("delete from boiler_form5_t2 where form_id='$form_id'");
				for($i=1;$i<$input_size2;$i++){
					/*$vala=$_POST["txtA".$i];	*/		
					$valb=$_POST["txtB".$i];
					$valc=$_POST["txtC".$i];
					
					$part2=$boiler->query("INSERT INTO boiler_form3_t2(id,form_id,slno,name,experience) VALUES ('','$form_id','$i','$valb','$valc')") or die($boiler->error);
				}
			}
			
			
			
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = 'boiler_form5.php?tab=2';
		</script>";		
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'boiler_form5.php?tab=1';
		</script>";
	}			
	}
}
	
	#Submit
	
	if(isset($_POST["submit5"])){
	if((isset($_POST["mfile1"]) && empty($_POST["mfile1"])) || 
	(isset($_POST["mfile2"]) && empty($_POST["mfile2"])) || 
	(isset($_POST["mfile3"]) && empty($_POST["mfile3"])) ||
	(isset($_POST["mfile4"]) && empty($_POST["mfile4"])) || 
	(isset($_POST["mfile1"]) && $_POST["mfile1"]=='2') || 
	(isset($_POST["mfile2"]) && $_POST["mfile2"]=='2') || 
	(isset($_POST["mfile3"]) && $_POST["mfile3"]=='2') ||
	(isset($_POST["mfile4"]) && $_POST["mfile4"]=='2') ||
	(isset($_POST["mfile1"]) && $_POST["mfile1"]=='3') || 
	(isset($_POST["mfile2"]) && $_POST["mfile2"]=='3') ||
	(isset($_POST["mfile3"]) && $_POST["mfile3"]=='3') ||
	(isset($_POST["mfile4"]) && $_POST["mfile4"]=='3'))
	 
	{
			echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'boiler_form5.php?tab=2';
			</script>";
	}else{
		$file1=clean($_POST["mfile1"]);
		$file2=clean($_POST["mfile2"]);
		$file3=clean($_POST["mfile3"]);
		$file4=clean($_POST["mfile4"]);
		$sql=$boiler->query("select form_id from boiler_form5 where user_id='$swr_id' and active='1'");		
			if($sql->num_rows<1){				
				echo "<script>
					alert('Please fill the first part of the form.');
					window.location.href = 'boiler_form5.php';
				</script>";
			}else{
				$row=$sql->fetch_array();
				$form_id=$row["form_id"];
				$savequery=$boiler->query("update boiler_form5 set file1='$file1',file2='$file2',file3='$file3',file4='$file4'where form_id='$form_id'") or die($boiler->error);
			}				
			if($savequery){
				$formFunctions->file_update($file1);
				$formFunctions->file_update($file2);
				$formFunctions->file_update($file3);
				$formFunctions->file_update($file4);
				
				if($file1=="SC" || $file2=="SC" || $file3=="SC" || $file4=="SC" ){
					$save_query=$boiler->query("update boiler_form5 set courier_details='1', sub_date='$today' where form_id='$form_id'") or die($boiler->error);
				}else{
					//$courier_details=NULL;
					$save_query=$boiler->query("update boiler_form5 set sub_date='$today',courier_details=NULL where form_id='$form_id'") or die($boiler->error);
				}
				if($save_query){
					echo "<script>
						alert('Successfully Saved....');
						window.location.href = 'preview.php?token=5';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href ='boiler_form5.php?tab=1';
					</script>";
				}			
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href ='boiler_form5.php?tab=1';
				</script>";
			}
		}
		
}

if(isset($_POST["proceed5"])){
	$query=$boiler->query("select form_id,save_mode,courier_details from boiler_form5 where user_id='$swr_id' and active='1'") or die("Error :". $boiler->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'boiler_form5.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'boiler','5');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$boiler->query("update boiler_form5 set sub_date='$today',uain='$uain',save_mode='F',received_date=NULL where form_id='$form_id'") or die($boiler->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=boiler&form=5';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=5';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$boiler->query("update boiler_form5 set sub_date='$today',uain='$uain',save_mode='P',received_date='$today' where form_id='$form_id'") or die($boiler->error);
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
	
	$query=$boiler->query("select uain,form_id from boiler_form5 where user_id='$swr_id' and save_mode='P'") or die("Error :". $boiler->error);
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
			$form_id=$row["form_id"];				
			$uain=$row["uain"];				
			$offline_challan=$_POST["offline_challan"];
			
			$payment_mode=clean($_POST["payment_mode"]);
			$txn_date=clean($_POST["txn_date"]);
			$bank_name=clean($_POST["bank_name"]);
			$ref_no=clean($_POST["ref_no"]);
			$reg_fees=clean($_POST["reg_fees"]);
			
			$formFunctions->file_update($offline_challan);
			$update_result=$formFunctions->insert_offline_payment_details("boiler",$uain,$reg_fees,$ref_no,$txn_date,$bank_name,"A");
			if($update_result==1){	
				$save_query=$boiler->query("update boiler_form5 set offline_challan='$offline_challan',payment_mode='$payment_mode',save_mode='C',sub_date='$today' where form_id='$form_id'") or die($boiler->error);
				if($save_query){				
					$formFunctions->insert_applications($uain);
					$str=$formFunctions->getEmail_str($uain);
					/////////////////////////////SEND MAIL////////////////////////////////
					$user_email=$formFunctions->get_usermail($swr_id);
					$dept_email="esgoa.boiler@gmail.com";
					require_once "boiler_form5_print.php"; 
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
							window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=5&dept=boiler';
						</script>";
				}else{
					echo "<script>alert('Something went wrong !!!');window.location.href = 'payment_section.php?token=5';</script>";
				}
			}else{
				echo "<script>alert('Something went wrong !!!');window.location.href = 'payment_section.php?token=5';</script>";
			}
		}								
	}
}
?>
