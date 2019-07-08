<?php
if(isset($_POST["save51a"])){		
	$land_premises=clean($_POST["land_premises"]);$natio_nality=clean($_POST["natio_nality"]);$survey_no=clean($_POST["survey_no"]);$khasra_no=clean($_POST["khasra_no"]);$approximate_date=clean($_POST["approximate_date"]);
	$expected_date=clean($_POST["expected_date"]);  $total_no_employee=clean($_POST["total_no_employee"]);$is_licence=clean($_POST["is_licence"]);$is_licence_details=clean($_POST["is_licence_details"]);$person_authorised=clean($_POST["person_authorised"]);$person_upload=clean($_POST["person_upload"]);
	$licence_annual_capacity=clean($_POST["licence_annual_capacity"]);   $dome_stic=clean($_POST["dome_stic"]);  $indus_trial=clean($_POST["indus_trial"]);$effluents_upload=clean($_POST["effluents_upload"]);$quality_of_effluent=clean($_POST["quality_of_effluent"]);$monitoring_arrangemen=clean($_POST["monitoring_arrangemen"]);
	$is_treatment_plant=clean($_POST["is_treatment_plant"]);
	$details_upload=clean($_POST["details_upload"]);
	
	if(!empty($_POST["wc_values"]))  $wc_values=json_encode($_POST["wc_values"]);
	else	$wc_values=NULL;
	
	
	
	
	$sql=$pcb->query("select form_id from pcb_form51 where user_id='$swr_id' and active='1'") or die("Error :". $pcb->error);
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$pcb->query("insert into pcb_form51(user_id,land_premises,natio_nality,survey_no,khasra_no,approximate_date,expected_date,total_no_employee,is_licence,is_licence_details,person_authorised,person_upload,licence_annual_capacity,dome_stic,indus_trial,effluents_upload,quality_of_effluent,monitoring_arrangemen,is_treatment_plant,details_upload,wc_values) values('$swr_id','$land_premises','$natio_nality','$survey_no','$khasra_no','$approximate_date','$expected_date','$total_no_employee','$is_licence','$is_licence_details','$person_authorised','$person_upload','$licence_annual_capacity','$dome_stic','$indus_trial','$effluents_upload','$quality_of_effluent','$monitoring_arrangemen','$is_treatment_plant','$details_upload','$wc_values')") or die("Error: ".$form_id=$pcb->insert_id;
		$k=$pcb->query("delete from pcb_form51_members where form_id='$form_id'");
		for($i=1;$i<=$hidden_value;$i++){
			$name=$_POST["name".$i.""];$sn1=$_POST["sn1".$i.""];$sn2=$_POST["sn2".$i.""];$vill=$_POST["vill".$i.""];$dist=$_POST["dist".$i.""];$pin=$_POST["pin".$i.""];
			
			$query1=$pcb->query("INSERT INTO pcb_form51_members(id,form_id,sl_no,name,sn1,sn2,vill,dist,pin) VALUES ('','$form_id','$i','$name','$sn1','$sn2','$vill','$dist','$pin')") or die($pcb->error);
		}
		
	}else{
		$form_id=$row["form_id"];
		$query=$pcb->query("UPDATE pcb_form51 SET  sub_date='$today',land_premises='$land_premises', natio_nality='$natio_nality',survey_no='$survey_no',khasra_no='$khasra_no',approximate_date='$approximate_date',expected_date='$expected_date',total_no_employee='$total_no_employee',is_licence='$is_licence',is_licence_details='$is_licence_details', person_authorised='$person_authorised',person_upload='$person_upload',licence_annual_capacity='$licence_annual_capacity',dome_stic='$dome_stic',indus_trial='$indus_trial',effluents_upload='$effluents_upload',quality_of_effluent='$quality_of_effluent',monitoring_arrangemen='$monitoring_arrangemen',is_treatment_plant='$is_treatment_plant',details_upload='$details_upload',wc_values='$wc_values' WHERE form_id='$form_id'") OR die("Error: ".$pcb->error);	
		for($i=1;$i<=$hidden_value;$i++){
			$name=$_POST["name".$i.""];$sn1=$_POST["sn1".$i.""];$sn2=$_POST["sn2".$i.""];$vill=$_POST["vill".$i.""];$dist=$_POST["dist".$i.""];$pin=$_POST["pin".$i.""];
			
			$query1=$pcb->query("UPDATE pcb_form51_members set name='$name',sn1='$sn1',sn2='$sn2',vill='$vill',dist='$dist',pin='$pin' where form_id='$form_id' and sl_no='$i'") or die($pcb->error);
		}
	}
	if($query==true && $query1==true){
			
			$formFunctions->insert_incomplete_forms('pcb','51'); //pcb-- dept name and 51 -- form no
			echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'pcb_form51.php?tab=2';
			</script>";
		}
		else
		{
			echo "<script>
				alert('Invalid Entry');
				window.location.href = 'pcb_form51.php?tab=1';
			</script>";
		}
}
if(isset($_POST["save51b"])){	

	if(!empty($_POST["sold_wastes"]))	 $sold_wastes=json_encode($_POST["sold_wastes"]);
	else	$sold_wastes=NULL;
	
	$sql=$pcb->query("select form_id from pcb_form51 where user_id='$swr_id' and active='1'") or die("Error bhanita :". $pcb->error);
	$row=$sql->fetch_array();
	
	if($sql->num_rows<1){   ////////////table is empty//////////////
		echo "<script>
			alert('Please Fill up the first part of the form .');
			window.location.href = 'pcb_form51.php';
		</script>";
	}else{		
		$form_id=$row["form_id"];
		
		$query=$pcb->query("UPDATE pcb_form51 SET  sub_date='$today', sold_wastes='$sold_wastes' WHERE form_id='$form_id'") OR die("Error bhani1: ".$pcb->error);	
	}	
	
		
			 echo "<script>
				alert('Successfully Saved..');
				window.location.href =  'pcb_form51.php?tab=3';
			</script>";	
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'pcb_form51.php?tab=2';
		</script>";
	}	
}
if(isset($_POST['submit51'])){
	 $file4=$_POST["mfile4"]; 
	
	if(empty($_POST["mfile4"]))
	{
		echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'pcb_form51.php?tab=2';
			</script>";
	}else{
			
		$file2=clean($_POST["mfile2"]);$formFunctions->file_update($file2);
		
					
		$query=$pcb->query("select form_id from pcb_form51 where user_id='$swr_id' and active='1'") or die("Error :". $pcb->error);
		if($query->num_rows<1){
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'pcb_form51.php';
				</script>";
		}else{
			$form_id=$query->fetch_object()->form_id;
			$uain=$formFunctions->create_uain($form_id,'pcb','11');
			$query2=$pcb->query("select * from pcb_form51 where form_id='$form_id'") or die("Error :". $pcb->error);
			if($query2->num_rows >0){
				
				$save_query=$pcb->query("update pcb_form51 set file2='$file2',courier_details='' where form_id='$form_id'") or die($pcb->error);
			  
			}			
			if($file2=="SC" ){
				//$received_date=NULL;
				
				$save_query1=$pcb->query("update pcb_form51 set courier_details='1',received_date=NULL, sub_date='$today' where form_id='$form_id'") or die($pcb->error);
				
			}else{
				//$courier_details=NULL;
				$save_query=$pcb->query("update pcb_form11 set sub_date='$today',received_date='$today',courier_details=NULL where form_id='$form_id'") or die($pcb->error);
			}			
			if($save_query==true ){
				
			echo "<script>
				alert('Successfully Submitted....');
				window.location.href = 'preview.php?token=51';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'pcb_form51.php?tab=2';
				</script>";
			}		
		}
	}
}

if(isset($_POST["proceed51"])){
	$query=$pcb->query("select form_id,save_mode,courier_details from pcb_form51 where user_id='$swr_id' and active='1'") or die("Error :". $pcb->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'pcb_form51.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'pcb','51');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$pcb->query("update pcb_form51 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($pcb->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=pcb&form=51';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=51';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$formFunctions->updateSubmit($uain,$form_id);
			$formFunctions->insert_applications($uain);
			$str=$formFunctions->getEmail_str($uain);
			/////////////////////////////SEND MAIL////////////////////////////////
			$user_email=$formFunctions->get_usermail($swr_id);
			$dept_email="esgoa.pcb@gmail.com";
			require_once "pcb_form51_print.php"; 
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
					window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=51&dept=pcb';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'pcb_form51.php';
				</script>";
			}
		}else{
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=51';
				</script>";
		}
	}
}
?>