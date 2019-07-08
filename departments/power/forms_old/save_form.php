<?php 
if(isset($_POST["save"])){
	$reg_fees=100;
	$required_power=clean($_POST["required_power"]);$service_requested=clean($_POST["service_requested"]);$consumer_category=clean($_POST["consumer_category"]);$mouza_no=clean($_POST["mouza_no"]);$dag_no=clean($_POST["dag_no"]);
	$exist_con_no=clean($_POST["exist_con_no"]);
	$extract_exist_con_no=substr($exist_con_no, 0, 3);
	$results=$power->query("SELECT * FROM nearest_cons_esd WHERE cons_no='$extract_exist_con_no'") OR die("Error: ".$power->error);
	if($results->num_rows == 0){ 
		$esd="";
	}else{
		$esd=$results->fetch_object()->consumer_loc; 
	} 
	if(!empty($_POST["billing"]))	 $billing=json_encode($_POST["billing"]);
	else	$billing=NULL;
	
	if(empty($_POST["mfile1"]) || empty($_POST["mfile2"]) || $_POST["mfile1"]=='2' || $_POST["mfile2"]=='2' || $_POST["mfile1"]=='3' || $_POST["mfile2"]=='3'){
		echo "<script>
			alert('Error in file / You didnot select any option.');
			window.location.href = 'factory_form3.php?tab=3';
		</script>";
		exit();
	}
	$file1=clean($_POST["mfile1"]);$file2=clean($_POST["mfile2"]);
	
	$sql=$power->query("select form_id from power_form1 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////		
		$query=$power->query("insert into power_form1(user_id,save_mode,sub_date,required_power,consumer_category,service_requested,exist_con_no,esd,reg_fees,billing,mouza_no,dag_no,file1,file2) values ('$swr_id','D','$today', '$required_power','$consumer_category', '$service_requested', '$exist_con_no','$esd', '$reg_fees', '$billing','$mouza_no','$dag_no','$file1','$file2')") OR die("Error: ".$power->error);
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$power->query("update power_form1 set sub_date='$today', required_power='$required_power',consumer_category='$consumer_category', service_requested='$service_requested', exist_con_no='$exist_con_no',esd='$esd',reg_fees='$reg_fees', billing='$billing', mouza_no='$mouza_no', dag_no='$dag_no' , file1='$file1', file2='$file2' where form_id='$form_id'") OR die("Error: ".$power->error);				
	}
	if($query){
		$formFunctions->file_update($file1);$formFunctions->file_update($file2);
		$formFunctions->insert_incomplete_forms('power','1'); //power-- dept name and 1 -- form no
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = 'preview.php?token=1';
		</script>";
	}else{
		echo "<script>
			alert('Something went wrong !!');
			window.location.href = 'form1.php';
		</script>";
	}						
}
if(isset($_POST["proceed1"])){
	$query=$power->query("select form_id,save_mode,courier_details from power_form1 where user_id='$swr_id' and active='1'") or die("Error :". $power->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'power_form1.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'power','1');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$power->query("update power_form1 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($power->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=power&form=1';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=1';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$power->query("update power_form1 set sub_date='$today', received_date='$today',uain='$uain',save_mode='P' where form_id='$form_id'") or die($power->error);
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
if(isset($_POST["submit1"])){
	$query=$power->query("select uain,form_id from power_form1 where user_id='$swr_id' and save_mode='P'") or die("Error :". $power->error);
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
			$save_query=$power->query("update power_form1 set offline_challan='$offline_challan',payment_mode='$payment_mode',save_mode='C',sub_date='$today' where form_id='$form_id'") or die($power->error);
			if($save_query){
				$formFunctions->insert_applications($uain);
				$str=$formFunctions->getEmail_str($uain);
				/////////////////////////////SEND MAIL////////////////////////////////
				$user_email=$formFunctions->get_usermail($swr_id);
				$dept_email="esgoa.power@gmail.com";
				require_once "power_form1_print.php"; 
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
						window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=1&dept=power';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'power_form1.php';
					</script>";
				}
			}else{
				echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'power_form1.php';
					</script>";
			}			
		}
	}
}
?>