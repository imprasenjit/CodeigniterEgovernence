<?php
if(isset($_POST["save25a"])){		
	$Voltage=clean($_POST["Voltage"]);$Location=clean($_POST["Location"]);$point=clean($_POST["point"]);$pur_constructed=clean($_POST["pur_constructed"]);
	$Length=clean($_POST["Length"]);$Quantum=clean($_POST["Quantum"]);$no_Spans=clean($_POST["no_Spans"]);$length_Spans=clean($_POST["length_Spans"]);
	$max_len_Spans=clean($_POST["max_len_Spans"]);$Type_conductor=clean($_POST["Type_conductor"]);$size_conductor=clean($_POST["size_conductor"]);$Type_Support=clean($_POST["Type_Support"]);
    $Materials=clean($_POST["Materials"]);$t_Supports=clean($_POST["t_Supports"]);$Type_Insulators=clean($_POST["Type_Insulators"]);$Type_Cross=clean($_POST["Type_Cross"]);
	$Cross_size=clean($_POST["Cross_size"]);$acr_street=clean($_POST["acr_street"]);$a_street=clean($_POST["a_street"]);$Elsewhere=clean($_POST["Elsewhere"]);
	

	$sql=$cei->query("select form_id from cei_form25 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$cei->query("insert into cei_form1(user_id,sub_date,Voltage,Location,point,pur_constructed,Length,Quantum,no_Spans,length_Spans,max_len_Spans,Type_conductor,Type_Support,Materials,t_Supports,Type_Insulators,Type_Cross,Cross_size,acr_street,a_street,Elsewhere) values ('$swr_id','$today', '$Voltage', '$Location', '$point','$pur_constructed', '$Length', '$Quantum', '$no_Spans','$length_Spans','$max_len_Spans', '$Type_conductor', '$Type_Support', '$Materials','$t_Supports', '$Type_Insulators', '$Type_Cross', '$Cross_size','$acr_street', '$a_street','$Elsewhere')") OR die("Error : ".$cei->error);
	}else{
		$form_id=$row["form_id"];	
		$query=$cei->query("update cei_form1 set sub_date='$today', Voltage='$Voltage', Location='$Location', point='$point',pur_constructed='$pur_constructed', Length='$Length',Quantum='$Quantum',no_Spans='$no_Spans', length_Spans='$length_Spans', max_len_Spans='$max_len_Spans',Type_conductor='$Type_conductor',Type_Support='$Type_Support', Materials='$Materials',t_Supports='$t_Supports',Type_Insulators='$Type_Insulators', Type_Cross='$Type_Cross',Cross_size='$Cross_size',acr_street='$acr_street', a_street='$a_street',Elsewhere='$Elsewhere' where form_id=$form_id") OR die("Error: ".$cei->error);	
	}				
	if($query){
		$formFunctions->insert_incomplete_forms('cei','25'); //cei-- dept name and 25 -- form no 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = 'cei_form25.php?tab=2';
		</script>";
		
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'cei_form25.php?tab=1';
		</script>";
	}						
}
		
if(isset($_POST["save25b"])){		
	$Where_conductors=clean($_POST["Where_conductors"]);$Cradle_guard=clean($_POST["Cradle_guard"]);$Mention_voltage=clean($_POST["Mention_voltage"]);$Horizontal=clean($_POST["Horizontal"]);
	$Vertical=clean($_POST["Vertical"]);$Has_guard=clean($_POST["Has_guard"]);$angle_crossing=clean($_POST["angle_crossing"]);$overhead_line=clean($_POST["overhead_line"]);
	$necessary_clearance=clean($_POST["necessary_clearance"]);
	

	$sql=$cei->query("select form_id from cei_form25 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$cei->query("insert into cei_form25(user_id,sub_date,Where_conductors,Cradle_guard,Mention_voltage,Horizontal,Vertical,Has_guard,angle_crossing,overhead_line,necessary_clearance) values ('$swr_id','$today', '$Where_conductors', '$Cradle_guard', '$Mention_voltage','$Horizontal', '$Vertical', '$Has_guard', '$angle_crossing','$overhead_line','$necessary_clearance' )") OR die("Error : ".$cei->error);
	}else{
		$form_id=$row["form_id"];	
		$query=$cei->query("update cei_form25 set sub_date='$today', Where_conductors='$Where_conductors', Cradle_guard='$Cradle_guard', Mention_voltage='$Mention_voltage',Horizontal='$Horizontal', Vertical='$Vertical',Has_guard='$Has_guard',angle_crossing='$angle_crossing', overhead_line='$overhead_line', necessary_clearance='$necessary_clearance' where form_id=$form_id") OR die("Error: ".$cei->error);	
	}				
	if($query){
		$formFunctions->insert_incomplete_forms('cei','25'); //cei-- dept name and 25 -- form no 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = 'cei_form25.php?tab=2';
		</script>";
		
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'cei_form25.php?tab=1';
		</script>";
	}						
}

if(isset($_POST["save25c"])){
	$ph_earth=clean($_POST["ph_earth"]);$phas_ph=clean($_POST["phas_ph"]);$voltage_Insulation=clean($_POST["voltage_Insulation"]);$type_size_guard=clean($_POST["type_size_guard"]);
	$earth_wire=clean($_POST["earth_wire"]);$earth_wire_ear=clean($_POST["earth_wire_ear"]);$metallic_supports=clean($_POST["metallic_supports"]);$permanently_earthed=clean($_POST["permanently_earthed"]);
	$overhead_line=clean($_POST["overhead_line"]);
	
	$Specifications=clean($_POST["Specifications"]);$Make=clean($_POST["Make"]);$protection=clean($_POST["protection"]);$Normal_setting=clean($_POST["Normal_setting"]);$anti_climbing=clean($_POST["anti_climbing"]);
	
	$lightning_a=clean($_POST["lightning_a"]);$lightning_b=clean($_POST["lightning_b"]);$lightning_c=clean($_POST["lightning_c"]);$lightning_d=clean($_POST["lightning_d"]);$lightning_e=clean($_POST["lightning_e"]);$in_location=clean($_POST["in_location"]);
	
	}
	$sql=$cei->query("select form_id from cei_form25 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();

	if($sql->num_rows<1){////////////table is empty//////////////
		if($details_earthing=="SC"||$details_fire=="SC"||$details_light=="SC"||$details_test=="SC"||$is_generator_plan2_upload=="SC"){
			$query=$cei->query("insert into cei_form26(user_id,sub_date,courier_details,received_date,name_contractor,contractor_address,details_earthing,is_generator,is_generator_plan,is_generator_plan1,is_generator_plan2,is_generator_plan2_upload,details_light,details_fire ,details_test ) values ('$swr_id','$today','1', NULL,'$name_contractor','$contractor_address','$details_earthing', '$is_generator', '$is_generator_plan','$is_generator_plan1','$is_generator_plan2','$is_generator_plan2_upload','$details_light','$details_fire','$details_test')") OR die("Error: ".$cei->error);
		}else{
			$query=$cei->query("insert into cei_form26(user_id,sub_date,received_date,courier_details,name_contractor,contractor_address,details_earthing,is_generator,is_generator_plan,is_generator_plan1,is_generator_plan2,is_generator_plan2_upload,details_light,details_fire,details_test) values ('$swr_id','$today','$today',NULL,'$name_contractor','$contractor_address','$details_earthing','$is_generator','$is_generator_plan','$is_generator_plan1','$is_generator_plan2','$is_generator_plan2_upload','$details_light','$details_fire','$details_test')") OR die("Error: ".$cei->error);
		}
		$form_id=$cei->insert_id;
	}else{	////////////table is not empty//////////////			
		$form_id=$row["form_id"];		
		if($details_earthing=="SC"||$details_fire=="SC"||$details_light=="SC"||$details_test=="SC"||$is_generator_plan2_upload=="SC"){
			$query=$cei->query("update cei_form26 set sub_date='$today', received_date=NULL,courier_details='1', name_contractor='$name_contractor',contractor_address='$contractor_address',details_earthing='$details_earthing', is_generator='$is_generator', is_generator_plan='$is_generator_plan', is_generator_plan1='$is_generator_plan1', is_generator_plan2='$is_generator_plan2',is_generator_plan2_upload='$is_generator_plan2_upload', details_light='$details_light',details_fire='$details_fire',details_test='$details_test' where user_id='$swr_id' and form_id='$form_id'") OR die("Error: ".$cei->error);
		}else{
			$query=$cei->query("update cei_form26 set sub_date='$today',received_date='$today' , courier_details=NULL,name_contractor='$name_contractor',contractor_address='$contractor_address', details_earthing='$details_earthing', is_generator='$is_generator', is_generator_plan='$is_generator_plan', is_generator_plan1='$is_generator_plan1',is_generator_plan2='$is_generator_plan2',is_generator_plan2_upload='$is_generator_plan2_upload',details_light='$details_light',details_fire='$details_fire',details_test='$details_test'  where user_id='$swr_id' and form_id='$form_id'") OR die("Error: ".$cei->error);
		}
	}
	if($query){
		$formFunctions->file_update($details_earthing);$formFunctions->file_update($details_fire);$formFunctions->file_update($details_light);$formFunctions->file_update($details_test);$formFunctions->file_update($is_generator_plan2_upload);
		$formFunctions->insert_incomplete_forms('cei','3'); //cei-- dept name and 26 -- form no
			echo "<script>
				alert('Successfully saved.');
				window.location.href ='cei_form26.php?tab=4';
			</script>";
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'cei_form26.php?tab=3';
			</script>";
	}			
}

if(isset($_POST["save26d"])){
	$name_contractor=clean($_POST["name_contractor"]);
	$details_earthing=clean($_POST["details_earthing"]);$is_generator_plan=clean($_POST["is_generator_plan"]);$is_generator=clean($_POST["is_generator"]);$is_generator_plan1=clean($_POST["is_generator_plan1"]);$is_generator_plan2=clean($_POST["is_generator_plan2"]);$is_generator_plan2_upload=clean($_POST["is_generator_plan2_upload"]);$details_light=clean($_POST["details_light"]);$details_fire=clean($_POST["details_fire"]);$details_test=clean($_POST["details_test"]);	
	if(!empty($_POST["contractor_address"])) $contractor_address=json_encode($_POST["contractor_address"]);
	else $contractor_address=NULL;
	if($is_generator_plan2=="Y"){
		$is_generator_plan2_upload=clean($_POST["is_generator_plan2_upload"]);
	}else{
		$is_generator_plan2_upload='';
	}
	$sql=$cei->query("select form_id from cei_form26 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();

	if($sql->num_rows<1){////////////table is empty//////////////
		if($details_earthing=="SC"||$details_fire=="SC"||$details_light=="SC"||$details_test=="SC"||$is_generator_plan2_upload=="SC"){
			$query=$cei->query("insert into cei_form26(user_id,sub_date,courier_details,received_date,name_contractor,contractor_address,details_earthing,is_generator,is_generator_plan,is_generator_plan1,is_generator_plan2,is_generator_plan2_upload,details_light,details_fire ,details_test ) values ('$swr_id','$today','1', NULL,'$name_contractor','$contractor_address','$details_earthing', '$is_generator', '$is_generator_plan','$is_generator_plan1','$is_generator_plan2','$is_generator_plan2_upload','$details_light','$details_fire','$details_test')") OR die("Error: ".$cei->error);
		}else{
			$query=$cei->query("insert into cei_form26(user_id,sub_date,received_date,courier_details,name_contractor,contractor_address,details_earthing,is_generator,is_generator_plan,is_generator_plan1,is_generator_plan2,is_generator_plan2_upload,details_light,details_fire,details_test) values ('$swr_id','$today','$today',NULL,'$name_contractor','$contractor_address','$details_earthing','$is_generator','$is_generator_plan','$is_generator_plan1','$is_generator_plan2','$is_generator_plan2_upload','$details_light','$details_fire','$details_test')") OR die("Error: ".$cei->error);
		}
		$form_id=$cei->insert_id;
	}else{	////////////table is not empty//////////////			
		$form_id=$row["form_id"];		
		if($details_earthing=="SC"||$details_fire=="SC"||$details_light=="SC"||$details_test=="SC"||$is_generator_plan2_upload=="SC"){
			$query=$cei->query("update cei_form26 set sub_date='$today', received_date=NULL,courier_details='1', name_contractor='$name_contractor',contractor_address='$contractor_address',details_earthing='$details_earthing', is_generator='$is_generator', is_generator_plan='$is_generator_plan', is_generator_plan1='$is_generator_plan1', is_generator_plan2='$is_generator_plan2',is_generator_plan2_upload='$is_generator_plan2_upload', details_light='$details_light',details_fire='$details_fire',details_test='$details_test' where user_id='$swr_id' and form_id='$form_id'") OR die("Error: ".$cei->error);
		}else{
			$query=$cei->query("update cei_form26 set sub_date='$today',received_date='$today' , courier_details=NULL,name_contractor='$name_contractor',contractor_address='$contractor_address', details_earthing='$details_earthing', is_generator='$is_generator', is_generator_plan='$is_generator_plan', is_generator_plan1='$is_generator_plan1',is_generator_plan2='$is_generator_plan2',is_generator_plan2_upload='$is_generator_plan2_upload',details_light='$details_light',details_fire='$details_fire',details_test='$details_test'  where user_id='$swr_id' and form_id='$form_id'") OR die("Error: ".$cei->error);
		}
	}
	if($query){
		$formFunctions->file_update($details_earthing);$formFunctions->file_update($details_fire);$formFunctions->file_update($details_light);$formFunctions->file_update($details_test);$formFunctions->file_update($is_generator_plan2_upload);
		$formFunctions->insert_incomplete_forms('cei','3'); //cei-- dept name and 26 -- form no
			echo "<script>
				alert('Successfully saved.');
				window.location.href ='cei_form26.php?tab=4';
			</script>";
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'cei_form26.php?tab=3';
			</script>";
	}			
}
if(isset($_POST["submit26"])){
	if((isset($_POST["mfile1"]) && empty($_POST["mfile1"])) || (isset($_POST["mfile2"]) && empty($_POST["mfile2"])) || (isset($_POST["mfile3"]) && empty($_POST["mfile3"])) || (isset($_POST["mfile4"]) && empty($_POST["mfile4"])) || (isset($_POST["mfile5"]) && empty($_POST["mfile5"])) || (isset($_POST["mfile6"]) && empty($_POST["mfile6"])) || (isset($_POST["mfile7"]) && empty($_POST["mfile7"])) || (isset($_POST["mfile8"]) && empty($_POST["mfile8"])) || (isset($_POST["mfile9"]) && empty($_POST["mfile9"])) || (isset($_POST["mfile1"]) && $_POST["mfile1"]=='2') || (isset($_POST["mfile2"]) && $_POST["mfile2"]=='2') || (isset($_POST["mfile3"]) && $_POST["mfile3"]=='2') || (isset($_POST["mfile4"]) && $_POST["mfile4"]=='2') || (isset($_POST["mfile5"]) && $_POST["mfile5"]=='2') || (isset($_POST["mfile6"]) && $_POST["mfile6"]=='2') || (isset($_POST["mfile7"]) && $_POST["mfile7"]=='2') || (isset($_POST["mfile8"]) && $_POST["mfile8"]=='2') || (isset($_POST["mfile9"]) && $_POST["mfile9"]=='2') || (isset($_POST["mfile1"]) && $_POST["mfile1"]=='3') || (isset($_POST["mfile2"]) && $_POST["mfile2"]=='3') || (isset($_POST["mfile3"]) && $_POST["mfile3"]=='3') || (isset($_POST["mfile4"]) && $_POST["mfile4"]=='3') || (isset($_POST["mfile5"]) && $_POST["mfile5"]=='3') || (isset($_POST["mfile6"]) && $_POST["mfile6"]=='3') || (isset($_POST["mfile7"]) && $_POST["mfile7"]=='3') || (isset($_POST["mfile8"]) && $_POST["mfile8"]=='3') || (isset($_POST["mfile9"]) && $_POST["mfile9"]=='3') ){
			echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'cei_form26.php?tab=5';
			</script>";
	}else{
		$sql1=$cei->query("select * from cei_form26 where user_id='$swr_id' and active='1'");
		$row1=$sql1->fetch_array();
		
		$file1=clean($_POST["mfile1"]);$file2=clean($_POST["mfile2"]);$file3=clean($_POST["mfile3"]);$file4=clean($_POST["mfile4"]);$file5=clean($_POST["mfile5"]);$file6=clean($_POST["mfile6"]);$file7=clean($_POST["mfile7"]);$file8=clean($_POST["mfile8"]);$file9=clean($_POST["mfile9"]);
		$sql=$cei->query("select form_id from cei_form26 where user_id='$swr_id' and active='1'");
			if($sql->num_rows<1){				
				echo "<script>
					alert('Please fill the first part of the form.');
					window.location.href = 'cei_form26.php';
				</script>";
			}else{
				$row=$sql->fetch_array();
				$form_id=$row["form_id"];
				$savequery=$cei->query("update cei_form26 set file1='$file1',file2='$file2',file3='$file3',file4='$file4',file5='$file5',file6='$file6',file7='$file7',file8='$file8',file9='$file9' where form_id='$form_id'") or die($cei->error);
			}		
			if($savequery){
				$formFunctions->file_update($file1);$formFunctions->file_update($file2);$formFunctions->file_update($file3);$formFunctions->file_update($file4);$formFunctions->file_update($file5);$formFunctions->file_update($file6);$formFunctions->file_update($file7);$formFunctions->file_update($file8);$formFunctions->file_update($file9);
				
				if($file1=="SC" || $file2=="SC" ||  $file3=="SC" ||  $file4=="SC" || $file5=="SC" || $file6=="SC" || $file7=="SC" || $file8=="SC" || $file9=="SC"){
					$save_query=$cei->query("update cei_form26 set courier_details='1', sub_date='$today' where form_id='$form_id'") or die($cei->error);
				}else{
					//$courier_details=NULL;
					$save_query=$cei->query("update cei_form26 set sub_date='$today',courier_details=NULL where form_id='$form_id'") or die($cei->error);
				}
				if($save_query){
					echo "<script>
						alert('Successfully Saved....');
						window.location.href = 'preview.php?token=26';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href ='cei_form26.php?tab=4';
					</script>";
				}			
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href ='cei_form26.php?tab=4';
				</script>";
			}
		}
		
}
if(isset($_POST["proceed26"])){
	$query=$cei->query("select form_id,save_mode,courier_details from cei_form26 where user_id='$swr_id' and active='1'") or die("Error :". $cei->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'cei_form26.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'cei','26');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$cei->query("update cei_form26 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($cei->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=cei&form=26';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href ='preview.php?token=26';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$formFunctions->updateSubmit($uain,$form_id);
			$formFunctions->insert_applications($uain);
			$str=$formFunctions->getEmail_str($uain);
			/////////////////////////////SEND MAIL////////////////////////////////
			$user_email=$formFunctions->get_usermail($swr_id);
			$dept_email="esgoa.cei@gmail.com";
			require_once "cei_form26_print.php"; 
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
					window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=26&dept=cei';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'cei_form26.php';
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

?>