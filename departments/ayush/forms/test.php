<?php
if(isset($_POST["save5a"])){	
	
		 $dec1=clean($_POST["dec1"]);
		
		$input_size1=$_POST["hiddenval"];$input_size2=$_POST["hiddenval2"];
		
		$reg_fees=1015;		
		$sql=$ayush->query("select form_id from ayush_form5 where user_id='$swr_id' and active='1'");
		$row=$sql->fetch_array();
		if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$ayush->query("insert into ayush_form5(user_id,sub_date,dec1,reg_fees) values ('$swr_id','$today', '$dec1','$reg_fees')") OR die("Error: ".$ayush->error);
			$form_id=$ayush->insert_id;
		}else{
			$form_id=$row["form_id"];	
			$query=$ayush->query("update ayush_form5 set sub_date='$today', dec1='$dec1', reg_fees='$reg_fees' where form_id='$form_id'") OR die("Error: ".$ayush->error);	
		}
		if($query){
		$formFunctions->insert_incomplete_forms('ayush','5'); //ayush-- dept name and 1 -- form no 
		if($input_size1!=0){					
			$k=$ayush->query("delete from ayush_form5_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size1;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$part1=$ayush->query("INSERT INTO ayush_form5_t1(id,form_id,slno,drugs_name,drugs_det) VALUES ('','$form_id','$i','$valb','$valc')") or die("error in insertion ayush_form5_t1".$ayush->error);
				}
			}
			if($input_size2!=0){					
			$k=$ayush->query("delete from ayush_form5_t2 where form_id='$form_id'");
				for($i=1;$i<$input_size2;$i++){
					/*$vala=$_POST["txtA".$i];	*/		
					$valb=$_POST["txtB".$i];
					$valc=$_POST["txtC".$i];
					$vald=$_POST["txtD".$i];
					$part2=$ayush->query("INSERT INTO ayush_form5_t2(id,form_id,slno,name,qualification,experience) VALUES ('','$form_id','$i','$valb','$valc','$vald')") or die($ayush->error);
				}
			}
		echo "<script>
				alert('Successfully Saved....');
				window.location.href = 'ayush_form5.php?tab=2';
		</script>";
		
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'ayush_form5.php?tab=1';
		</script>";
	}				
}
if(isset($_POST["save3b"])){	

     $business_carried=clean($_POST["business_carried"]); $is_engaged=clean($_POST["is_engaged"]); $is_engaged_det=clean($_POST["is_engaged_det"]); $business_crri=clean($_POST["business_crri"]); $license_yr=clean($_POST["license_yr"]); $licenses_granted=clean($_POST["licenses_granted"]); $is_rejected=clean($_POST["is_rejected"]); $is_rejected_det=clean($_POST["is_rejected_det"]); $is_selling_goods=clean($_POST["is_selling_goods"]); $is_spirituous_medicinal=clean($_POST["is_spirituous_medicinal"]); $is_spirituous_medicinal_det=clean($_POST["is_spirituous_medicinal_det"]); $is_license_previously=clean($_POST["is_license_previously"]); $rooms_storage=clean($_POST["rooms_storage"]); $floor_area=clean($_POST["floor_area"]); $room_sketch=clean($_POST["room_sketch"]); $is_license_previously_det=clean($_POST["is_license_previously_det"]); $is_agent_distributor=clean($_POST["is_agent_distributor"]); $is_license=clean($_POST["is_license"]);$educational_qualifications=clean($_POST["educational_qualifications"]);$is_agent_distributor_det=clean($_POST["is_agent_distributor_det"]);
	 
	 $hidden_value=clean($_POST["hidden_value"]);
	 
	if(!empty($_POST["premises_convicted"]))	 $premises_convicted=json_encode($_POST["premises_convicted"]);
	 else	$premises_convicted=NULL;
	 
	if(!empty($_POST["licensing_authority"]))	 $licensing_authority=json_encode($_POST["licensing_authority"]);
	 else	$licensing_authority=NULL;
	
    $sql=$ayush->query("select form_id from ayush_form5 where user_id='$swr_id' and active='1'") or die("Error :". $ayush->error);
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$ayush->query("insert into ayush_form5(user_id,sub_date,business_carried,educational_qualifications,is_engaged,is_engaged_det,business_crri,is_license,license_yr,licenses_granted,is_rejected,is_rejected_det,is_selling_goods,premises_convicted,is_spirituous_medicinal,is_spirituous_medicinal_det,is_license_previously,is_license_previously_det,is_agent_distributor,is_agent_distributor_det,licensing_authority,rooms_storage,floor_area,room_sketch) values ('$swr_id','$today','$business_carried','$educational_qualifications','$is_engaged','$is_engaged_det','$business_crri','$is_license','$license_yr','$licenses_granted','$is_rejected','$is_rejected_det', '$is_selling_goods','$premises_convicted','$is_spirituous_medicinal','$is_spirituous_medicinal_det','$is_license_previously', '$is_license_previously_det','$is_agent_distributor','$is_agent_distributor_det','$licensing_authority','$rooms_storage','$floor_area','$room_sketch')") or die("Error: ".$ayush->error);
		$form_id=$ayush->insert_id;
		die("a");
		$k=$ayush->query("delete from ayush_form5_members where form_id='$form_id'");
		for($i=1;$i<=$hidden_value;$i++){
			$name=$_POST["name".$i.""];$sn1=$_POST["sn1".$i.""];$sn2=$_POST["sn2".$i.""];$vill=$_POST["vill".$i.""];$dist=$_POST["dist".$i.""];$pin=$_POST["pin".$i.""];
			
			$query1=$ayush->query("INSERT INTO ayush_form5_members(form_id,sl_no,name,sn1,sn2,vill,dist,pin) VALUES ('$form_id','$i','$name','$sn1','$sn2','$vill','$dist','$pin')") or die($ayush->error);
		}
		
	}else{
		$form_id=$row["form_id"];
		$query=$ayush->query("update ayush_form5 set sub_date='$today',business_carried='$business_carried',educational_qualifications='$educational_qualifications', is_engaged='$is_engaged',is_engaged_det='$is_engaged_det', business_crri='$business_crri',is_license='$is_license',license_yr='$license_yr',licenses_granted='$licenses_granted', is_rejected='$is_rejected',is_rejected_det='$is_rejected_det', is_selling_goods='$is_selling_goods', premises_convicted='$premises_convicted',is_spirituous_medicinal='$is_spirituous_medicinal',is_spirituous_medicinal_det='$is_spirituous_medicinal_det', is_license_previously='$is_license_previously', is_license_previously_det='$is_license_previously_det',is_agent_distributor='$is_agent_distributor',is_agent_distributor_det='$is_agent_distributor_det',licensing_authority='$licensing_authority',rooms_storage='$rooms_storage',floor_area='$floor_area',room_sketch='$room_sketch' where form_id='$form_id'") OR die("Error: ".$ayush->error);	
	
		$members_check=$ayush->query("select id from ayush_form5_members where form_id='$form_id'");
		if($members_check->num_rows>0){
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$sn1=$_POST["sn1".$i.""];$sn2=$_POST["sn2".$i.""];$vill=$_POST["vill".$i.""];$dist=$_POST["dist".$i.""];$pin=$_POST["pin".$i.""];
				
				$query1=$ayush->query("UPDATE ayush_form5_members set name='$name',sn1='$sn1',sn2='$sn2',vill='$vill',dist='$dist',pin='$pin' where form_id='$form_id' and sl_no='$i'") or die($ayush->error);
			}
		}else{
			$k=$ayush->query("delete from ayush_form5_members where form_id='$form_id'");
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$sn1=$_POST["sn1".$i.""];$sn2=$_POST["sn2".$i.""];$vill=$_POST["vill".$i.""];$dist=$_POST["dist".$i.""];$pin=$_POST["pin".$i.""];
				
				$query1=$ayush->query("INSERT INTO ayush_form5_members(form_id,sl_no,name,sn1,sn2,vill,dist,pin) VALUES ('$form_id','$i','$name','$sn1','$sn2','$vill','$dist','$pin')") or die($ayush->error);
			}			
		}		
	}
	if($query==true && $query1==true){
			
			$formFunctions->insert_incomplete_forms('ayush','5'); //ayush-- dept name and 1 -- form no
			echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'ayush_form5.php?tab=3';
			</script>";
		}
		else
		{
			echo "<script>
				alert('Invalid Entry');
				window.location.href = 'ayush_form5.php?tab=2';
			</script>";
		}
}
if(isset($_POST["save3c"])){	
	
     $spirits_village=clean($_POST["spirits_village"]); $spirits_medicinal=clean($_POST["spirits_medicinal"]); $hours_business=clean($_POST["hours_business"]); $trade_association=clean($_POST["trade_association"]);

	 $input_size3=$_POST["hiddenval3"];$input_size4=$_POST["hiddenval4"];
	 
	if(!empty($_POST["drugs_stocked"]))	 $drugs_stocked=json_encode($_POST["drugs_stocked"]);
	else	$drugs_stocked=NULL;
	
	
		$sql=$ayush->query("select form_id from ayush_form5 where user_id='$swr_id' and active='1'");
		$row=$sql->fetch_array();
		if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$ayush->query("insert into ayush_form5(user_id,sub_date,drugs_stocked,spirits_village,spirits_medicinal,hours_business,trade_association) values ('$swr_id','$today', '$premises_part','$drugs_stocked','$spirits_village','$spirits_medicinal','$hours_business','$trade_association')") OR die("Error: ".$ayush->error);
			$form_id=$ayush->insert_id;
		}else{
			$form_id=$row["form_id"];	
			$query=$ayush->query("update ayush_form5 set sub_date='$today',drugs_stocked='$drugs_stocked',spirits_village='$spirits_village',spirits_medicinal='$spirits_medicinal', hours_business='$hours_business',trade_association='$trade_association' where form_id='$form_id'") OR die("Error: ".$ayush->error);	
		}
		
    if($query){
		$formFunctions->insert_incomplete_forms('ayush','5'); //ayush-- dept name and 1 -- form no 
		if($input_size3!=0){					
			$k=$ayush->query("delete from ayush_form5_t3 where form_id='$form_id'");
			for($i=1;$i<$input_size3;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txxxtB".$i];
				$valc=$_POST["txxxtC".$i];
				$vald=$_POST["txxxtD".$i];
				$part3=$ayush->query("INSERT INTO ayush_form5_t3(id,form_id,slno,address_1,address_2,address_3) VALUES ('','$form_id','$i','$valb','$valc','$vald')") or die("error in insertion ayush_form5_t3".$ayush->error);
				}
			}
			if($input_size4!=0){					
			$k=$ayush->query("delete from ayush_form5_t4 where form_id='$form_id'");
				for($i=1;$i<$input_size4;$i++){
					/*$vala=$_POST["txtA".$i];	*/		
					$valb=$_POST["txxtB".$i];
					$part4=$ayush->query("INSERT INTO ayush_form5_t4(id,form_id,slno,class_commo) VALUES ('','$form_id','$i','$valb')") or die($ayush->error);
				}
			}
		echo "<script>
				alert('Successfully Saved....');
				window.location.href = 'ayush_form5.php?tab=4';
		</script>";
		
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'ayush_form5.php?tab=3';
		</script>";
	}				
}


if(isset($_POST["submit3"])){
	if((isset($_POST["mfile1"]) && empty($_POST["mfile1"])) || (isset($_POST["mfile2"]) && empty($_POST["mfile2"])) || (isset($_POST["mfile3"]) && empty($_POST["mfile3"])) || (isset($_POST["mfile4"]) && empty($_POST["mfile4"])) || (isset($_POST["mfile5"]) && empty($_POST["mfile5"])) || (isset($_POST["mfile1"]) && $_POST["mfile1"]=='2') || (isset($_POST["mfile2"]) && $_POST["mfile2"]=='2') || (isset($_POST["mfile3"]) && $_POST["mfile3"]=='2') || (isset($_POST["mfile4"]) && $_POST["mfile4"]=='2') || (isset($_POST["mfile5"]) && $_POST["mfile5"]=='2') || (isset($_POST["mfile1"]) && $_POST["mfile1"]=='3') || (isset($_POST["mfile2"]) && $_POST["mfile2"]=='3') || (isset($_POST["mfile3"]) && $_POST["mfile3"]=='3') || (isset($_POST["mfile4"]) && $_POST["mfile4"]=='3') || (isset($_POST["mfile5"]) && $_POST["mfile5"]=='3') ){
			echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'ayush_form5.php?tab=4';
			</script>";
	}else{
		$file1=clean($_POST["mfile1"]);$file2=clean($_POST["mfile2"]);$file3=clean($_POST["mfile3"]);$file4=clean($_POST["mfile4"]);$file5=clean($_POST["mfile5"]);
		$sql=$ayush->query("select form_id from ayush_form5 where user_id='$swr_id' and active='1'");		
			if($sql->num_rows<1){				
				echo "<script>
					alert('Please fill the first part of the form.');
					window.location.href = 'ayush_form5.php';
				</script>";
			}else{
				$row=$sql->fetch_array();
				$form_id=$row["form_id"];
				$savequery=$ayush->query("update ayush_form5 set file1='$file1',file2='$file2',file3='$file3',file4='$file4',file5='$file5' where form_id='$form_id'") or die($ayush->error);
			}		
			if($savequery){
				$formFunctions->file_update($file1);$formFunctions->file_update($file2);$formFunctions->file_update($file3);$formFunctions->file_update($file4);$formFunctions->file_update($file5);
				
				if($file1=="SC" || $file2=="SC" ||  $file3=="SC" ||  $file4=="SC" ||  $file5=="SC"){
					$save_query=$ayush->query("update ayush_form5 set courier_details='1', sub_date='$today' where form_id='$form_id'") or die($ayush->error);
				}else{
					//$courier_details=NULL;
					$save_query=$ayush->query("update ayush_form5 set sub_date='$today',courier_details=NULL where form_id='$form_id'") or die($ayush->error);
				}
				if($save_query){
					echo "<script>
						alert('Successfully Saved....');
						window.location.href = 'preview.php?token=5';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href ='ayush_form5.php?tab=4';
					</script>";
				}			
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href ='ayush_form5.php?tab=4';
				</script>";
			}
		}
		
}
if(isset($_POST["proceed3"])){
	$query=$ayush->query("select form_id,save_mode,courier_details from ayush_form5 where user_id='$swr_id' and active='1'") or die("Error :". $ayush->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'ayush_form5.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'ayush','5');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$ayush->query("update ayush_form5 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($ayush->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=ayush&form=5';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=5';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$formFunctions->updateSubmit($uain,$form_id);
			$formFunctions->insert_applications($uain);
			$str=$formFunctions->getEmail_str($uain);
			/////////////////////////////SEND MAIL////////////////////////////////
			$user_email=$formFunctions->get_usermail($swr_id);
			$dept_email="esgoa.ayush@gmail.com";
			require_once "ayush_form5_print.php"; 
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
					window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=5&dept=ayush';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'ayush_form5.php?tab=4';
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
?>