<?php 
if(isset($_POST["save10"])){		
	$order_num=clean($_POST["order_num"]);
	$order_date=clean($_POST["order_date"]);
	$auth_representative=clean($_POST["auth_representative"]);
	$ground_appeal=($_POST["ground_appeal"]);

	$sql=$clm->query("select form_id from clm_form10 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$clm->query("insert into clm_form10(user_id,sub_date,order_num,order_date,auth_representative,ground_appeal) values ('$swr_id','$today','$order_num','$order_date','$auth_representative','$ground_appeal')") OR die("Error: ".$clm->error);
	}else{
		$form_id=$row["form_id"];	
		$query=$clm->query("update clm_form10 set sub_date='$today', order_num='$order_num', order_date='$order_date',auth_representative='$auth_representative',ground_appeal='$ground_appeal' where form_id=$form_id") OR die("Error: ".$clm->error);
	}				
	if($query){
		$formFunctions->insert_incomplete_forms('clm','10'); //clm-- dept name and 1 -- form no
			echo "<script>
				alert('Successfully saved.');
				window.location.href = 'preview.php?token=10';
			</script>";
			
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'clm_form10.php';
			</script>";
	}			
}
if(isset($_POST["proceed1"])){
	$query=$clm->query("select form_id,save_mode,courier_details from clm_form1 where user_id='$swr_id' and active='1'") or die("Error :". $clm->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'clm_form1.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'clm','1');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$clm->query("update clm_form1 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($clm->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=clm&form=1';
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
			/////////////////////////////SEND MAIL////////////////////////////////
			$user_email=$formFunctions->get_usermail($swr_id);
			$dept_email="esgoa.clm@gmail.com";
			require_once "clm_form1_print.php"; 
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
					window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=1&dept=clm';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'clm_form1.php';
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
?>