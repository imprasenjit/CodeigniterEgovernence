<?php
if(isset($_POST["save9"])){		
	$supervision=clean($_POST["supervision"]);$agency=clean($_POST["agency"]);$pan=clean($_POST["pan"]);
	if(!empty($_POST["authority_addres"]))	 $authority_addres=json_encode($_POST["authority_addres"]);
	else	$authority_addres=NULL;
	if(!empty($_POST["pre_add"]))	 $pre_add=json_encode($_POST["pre_add"]);
	else	$pre_add=NULL;
	if(!empty($_POST["fees"]))	 $fees=json_encode($_POST["fees"]);
	else	$fees=NULL;
	
	if(empty($_POST["mfile1"]) ){
		echo "<script>
			alert('Error in file / You didnot select any option.');
			window.location.href = 'tcp_form9.php';
		</script>";
	}else{		
		$file1=clean($_POST["mfile1"]);
	}
	
	$sql=$tcp->query("select form_id from tcp_form9 where user_id='$swr_id' and active='1'") or die("Error :".$tcp->error);
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
	  $query=$tcp->query("insert into tcp_form8(user_id,sub_date,authority_addres,supervision,agency,pan,file1,father_name,dob,owner_age,pre_add,fees,file1) values ('$swr_id','$today','$authority_addres','$supervision','$agency','$pan','$file1','$father_name','$dob','$owner_age','$pre_add','$fees','$file1')") OR die("Error: ".$tcp->error);
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$tcp->query("update tcp_form9 set sub_date='$today', authority_addres='$authority_addres',supervision='$supervision', agency='$agency', pan='$pan', file1='$file1', father_name='$father_name', dob='$dob', owner_age='$owner_age', pre_add='$pre_add', fees='$fees', file1='$file1' where form_id=$form_id") OR die("Error: ".$tcp->error);	
	}	
	if($query){
		if($file1=="SC" || $file2=="SC"){
			$save_query=$tcp->query("update tcp_form9 set courier_details='1',received_date=NULL, sub_date='$today' where form_id='$form_id'") or die($tcp->error);
		}else{
			$save_query=$tcp->query("update tcp_form9 set sub_date='$today',received_date='$today',courier_details=NULL where form_id='$form_id'") or die($tcp->error);
		}
		if($save_query){
				$formFunctions->insert_incomplete_forms('tcp','9'); //tcp commer-- dept name and 1 -- form no
				echo "<script>
					alert('Successfully Saved..');
					window.location.href = 'preview.php?token=9';
				</script>";
		}else{
				echo "<script>
					alert('Invalid Entry');
					window.location.href = 'tcp_form9.php';
				</script>";
		}
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href ='tcp_form9.php';
		</script>";
	}	
}
if(isset($_POST["proceed9"])){
	$sql=$tcp->query("select form_id,save_mode,courier_details from tcp_form9 where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'tcp_form9.php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'tcp','9');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$tcp->query("update tcp_form9 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($tcp->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=tcp&form=9';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=9';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$formFunctions->updateSubmit($uain,$form_id);
			$formFunctions->insert_applications($uain);
			$str=$formFunctions->getEmail_str($uain);
			/////////////////////////////SEND MAIL////////////////////////////////
			$user_email=$formFunctions->get_usermail($swr_id);
			$dept_email="esgoa.tcp@gmail.com";
			require_once "tcp_form9_print.php"; 
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
					window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=9&dept=tcp';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'tcp_form9.php';
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
?>