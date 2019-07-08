<?php
/* if(basename ($_SERVER['PHP_SELF'])!="tcp_form8.php" && basename ($_SERVER['PHP_SELF'])!="tcp_form9.php" && basename ($_SERVER['PHP_SELF'])!="tcp_form7.php"){
	$is_rtp_query=$tcp->query("select a.form_id from tcp_form8 a, tcp_form8_process b where a.user_id='$swr_id' and a.save_mode='C' and b.form_id=a.form_id and b.process_type='I'") or die($tcp->error);
	if($is_rtp_query->num_rows==0){
		$is_rtp_query2=$tcp->query("select a.form_id from tcp_form9 a, tcp_form9_process b where a.user_id='$swr_id' and a.save_mode='C' and b.form_id=a.form_id and b.process_type='I'") or die($tcp->error);
		if($is_rtp_query2->num_rows==0){
			echo "<script>
					alert('Please fill up the Application for Enrollment as Competent Technical Personnel first and then apply for this application.');
					window.location.href = 'http://tcp.eodbassam.in/category/online-services/';
				</script>";
		}
	}
} */



if(isset($_POST["save1a"])){		
	$app_cat=clean($_POST["app_cat"]);$fm_name=clean($_POST["fm_name"]);$spouse_nm=clean($_POST["spouse_nm"]);	
	
	
	$sql=$tcp->query("select form_id from tcp_form1 where user_id='$swr_id' and active='1'") or die("Error :".$tcp->error);
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
	  $query=$tcp->query("insert into tcp_form1(user_id,sub_date,app_cat,fm_name,spouse_nm) values ('$swr_id','$today','$app_cat','$fm_name','$spouse_nm')") OR die("Error: ".$tcp->error);
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$tcp->query("update tcp_form1 set sub_date='$today', app_cat='$app_cat',fm_name='$fm_name', spouse_nm='$spouse_nm' where form_id=$form_id") OR die("Error: ".$tcp->error);	
	}					
	if($query){
			$formFunctions->insert_incomplete_forms('tcp','1'); //tcp commer-- dept name and 1 -- form no
			echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'tcp_form1.php?tab=2';
			</script>";
	}else{
			echo "<script>
				alert('Invalid Entry');
				window.location.href = 'tcp_form1.php?tab=1';
			</script>";
	}	
}
if(isset($_POST["save1b"])){
	$own_name=clean($_POST["own_name"]);$j_own_name=clean($_POST["j_own_name"]);$vill_revenue=clean($_POST["vill_revenue"]);$locality=clean($_POST["locality"]);$land_use=clean($_POST["land_use"]);$road_name=clean($_POST["road_name"]);$road_width=clean($_POST["road_width"]);
	
	if(!empty($_POST["prop"]))	 $prop=json_encode($_POST["prop"]);
		else	$prop=NULL;
	if(!empty($_POST["adjoin"]))	 $adjoin=json_encode($_POST["adjoin"]);
		else	$adjoin=NULL;
	
	$query=$tcp->query("select form_id from tcp_form1 where user_id='$swr_id' and active='1'") or die("Error :". $tcp->error);
	$row=$query->fetch_array();
	if($query->num_rows<1){   ////////////If first part is filled up////////////// 
		$query=$tcp->query("insert into tcp_form1 (sub_date,own_name,j_own_name,prop,vill_revenue,locality,land_use,road_name,road_width,adjoin) values('$today','$own_name','$j_own_name','$prop','$vill_revenue','$locality','$land_use','$road_name','$road_width','$adjoin')")OR die("Error : ".$tcp->error);
	}else{
		$form_id=$row["form_id"];
		$query=$tcp->query("UPDATE tcp_form1 SET  sub_date='$today',own_name='$own_name',j_own_name='$j_own_name',prop='$prop',vill_revenue='$vill_revenue',locality='$locality',land_use='$land_use',road_name='$road_name',road_width='$road_width',adjoin='$adjoin' WHERE user_id='$swr_id' AND form_id='$form_id'") OR die("Error : ".$tcp->error);
		
		if($query){
					echo "<script>
					alert('Successfully Saved.');
				    window.location.href = 'tcp_form1.php?tab=3';
			    </script>";
		    }else{
				echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'tcp_form1.php?tab=2';
			</script>";
		}
	
	}
}
if(isset($_POST["save1c"])){
	$build_cat=clean($_POST["build_cat"]);$prop_use=clean($_POST["prop_use"]);$plot_area=clean($_POST["plot_area"]);$build_area=clean($_POST["build_area"]);$con_type=clean($_POST["con_type"]);$no_of_floor=clean($_POST["no_of_floor"]);$total_area=clean($_POST["total_area"]);$b_wall=clean($_POST["b_wall"]);$length=clean($_POST["length"]);$height=clean($_POST["height"]);$is_v_ext=clean($_POST["is_v_ext"]);$is_h_ext=clean($_POST["is_h_ext"]);$reg_no=clean($_POST["reg_no"]);$rtp_name=clean($_POST["rtp_name"]);$tp_mobile_no=clean($_POST["tp_mobile_no"]);$tp_email=clean($_POST["tp_email"]);

	($is_v_ext=="Y")?$v_no_floor=clean($_POST["v_no_floor"]):$v_no_floor="";
	($is_h_ext=="Y")?$h_no_floor=clean($_POST["h_no_floor"]):$h_no_floor="";

	if(!empty($_POST["margin"]))	 $margin=json_encode($_POST["margin"]);
		else	$margin=NULL;
	if(!empty($_POST["canti"]))	 $canti=json_encode($_POST["canti"]);
		else	$canti=NULL;
	if(!empty($_POST["park_no"]))	 $park_no=json_encode($_POST["park_no"]);
		else	$park_no=NULL;
	if(!empty($_POST["park_area"]))	 $park_area=json_encode($_POST["park_area"]);
		else	$park_area=NULL;
	if(!empty($_POST["area"]))	 $area=json_encode($_POST["area"]);
		else	$area=NULL;
	
	$query=$tcp->query("select form_id from tcp_form1 where user_id='$swr_id' and active='1'") or die("Error :". $tcp->error);
	$row=$query->fetch_array();
	if($query->num_rows<1){   ////////////If first part is filled up////////////// 
		$query=$tcp->query("insert into tcp_form1 (sub_date,build_cat,prop_use,plot_area,build_area,con_type,no_of_floor,total_area,b_wall,length,height,is_v_ext,v_no_floor,is_h_ext,h_no_floor,reg_no,rtp_name,tp_mobile_no,tp_email,margin,canti,park_no,park_area,area) values('$today','$build_cat','$prop_use','$plot_area','$build_area','$con_type','$no_of_floor','$total_area','$b_wall','$length','$height','$is_v_ext','$v_no_floor','$is_h_ext','$h_no_floor','$reg_no','$rtp_name','$tp_mobile_no','$tp_email','$margin','$canti','$park_no','$park_area','$area')")OR die("Error : ".$tcp->error);
	}else{
		$form_id=$row["form_id"];
		$query=$tcp->query("UPDATE tcp_form1 SET  sub_date='$today',build_cat='$build_cat',prop_use='$prop_use',plot_area='$plot_area',build_area='$build_area',con_type='$con_type',no_of_floor='$no_of_floor',total_area='$total_area',b_wall='$b_wall',length='$length',height='$height',is_v_ext='$is_v_ext',v_no_floor='$v_no_floor',is_h_ext='$is_h_ext',h_no_floor='$h_no_floor',reg_no='$reg_no',rtp_name='$rtp_name',tp_mobile_no='$tp_mobile_no',tp_email='$tp_email',margin='$margin',canti='$canti',park_no='$park_no',park_area='$park_area',area='$area' WHERE user_id='$swr_id' AND form_id='$form_id'") OR die("Error : ".$tcp->error);
		
		if($query){
					echo "<script>
					alert('Successfully Saved.');
				    window.location.href = 'tcp_form1.php?tab=4';
			    </script>";
		    }else{
				echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'tcp_form1.php?tab=3';
			</script>";
		}
	
	}
}

if(isset($_POST["submit1"])){
	if(empty($_POST["mfile1"]) || empty($_POST["mfile2"]) || empty($_POST["mfile3"]) || empty($_POST["mfile4"]) || empty($_POST["mfile5"]) || empty($_POST["mfile6"]) || empty($_POST["mfile7"]) || empty($_POST["mfile8"]) || empty($_POST["mfile9"]) || $_POST["mfile1"]=='2' || $_POST["mfile2"]=='2' || $_POST["mfile3"]=='2' ||  $_POST["mfile4"]=='2' ||  $_POST["mfile5"]=='2' ||  $_POST["mfile6"]=='2' || $_POST["mfile7"]=='2' || $_POST["mfile8"]=='2' || $_POST["mfile9"]=='2' || $_POST["mfile1"]=='3' || $_POST["mfile2"]=='3' || $_POST["mfile3"]=='3' ||  $_POST["mfile4"]=='3' || $_POST["mfile5"]=='3' || $_POST["mfile6"]=='3' || $_POST["mfile7"]=='3' || $_POST["mfile8"]=='3' || $_POST["mfile9"]=='3' )
	{
	echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'tcp_form1.php?tab=4';
			</script>";
	}
	
	$file1=clean($_POST["mfile1"]);
	$file2=clean($_POST["mfile2"]);
	$file3=clean($_POST["mfile3"]);
	$file4=clean($_POST["mfile4"]);
	$file5=clean($_POST["mfile5"]);
	$file6=clean($_POST["mfile6"]);
	$file7=clean($_POST["mfile7"]);
	$file8=clean($_POST["mfile8"]);
	$file9=clean($_POST["mfile9"]);

	if(isset($_POST["courier_details"]) && !empty($_POST["courier_details"])) $courier_details=json_encode($_POST["courier_details"]);
	else $courier_details=NULL;
			
	$query=$tcp->query("select form_id from tcp_form1 where user_id=$swr_id") or die("Error :". $tcp->error);
	if($query->num_rows>0){
		$form_id=$query->fetch_object()->form_id;
		$formFunctions->file_update($file1);$formFunctions->file_update($file2);$formFunctions->file_update($file3);$formFunctions->file_update($file4);
		$formFunctions->file_update($file5);$formFunctions->file_update($file6);$formFunctions->file_update($file7);$formFunctions->file_update($file8);$formFunctions->file_update($file9);
		if($file1=="SC" || $file2=="SC" || $file3=="SC" || $file4=="SC" || $file5=="SC" || $file6=="SC" || $file7=="SC" || $file8=="SC" || $file9=="SC"){
			$save_query=$tcp->query("update tcp_form1 set received_date='$today', file1='$file1',file2='$file2',file3='$file3',file4='$file4',file5='$file5',file6='$file6',file7='$file7',file8='$file8',file9='$file9', reg_fees='100',courier_details='1' where form_id='$form_id'") or die("Error : ".$tcp->error);
		}else{
			//$courier_details=NULL;
			$save_query=$tcp->query("update tcp_form1 set file1='$file1',file2='$file2',file3='$file3',file4='$file4',file5='$file5',file6='$file6',file7='$file7',file8='$file8',file9='$file9',reg_fees='100',courier_details=NULL where form_id='$form_id'") or die("Error : ".$tcp->error);
		}
		if($save_query){
			echo "<script>
				alert('Successfully Uploaded.');
				window.location.href = 'preview.php?token=1';
			</script>";
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'tcp_form1.php?tab=4';
			</script>";
		}
	}else{
		echo "<script>
				alert('Invalid Entry, Please Fill up the first part of the form');
				window.location.href = 'tcp_form1.php';
			</script>";
	}			
}
if(isset($_POST["proceed1"])){
	$sql=$tcp->query("select form_id,save_mode,courier_details from tcp_form1 where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'tcp_form1.php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'tcp','1');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$tcp->query("update tcp_form1 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($tcp->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=tcp&form=1';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=1';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){			
			$save_query=$tcp->query("update tcp_form1 set sub_date='$today',uain='$uain',save_mode='P' where form_id='$form_id'") or die($tcp->error);
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
	$query=$tcp->query("select uain,form_id from tcp_form1 where user_id='$swr_id' and save_mode='P'") or die("Error :". $tcp->error);
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
			$save_query=$tcp->query("update tcp_form1 set offline_challan='$offline_challan',payment_mode='$payment_mode',save_mode='C',sub_date='$today' where form_id='$form_id'") or die($tcp->error);
			if($save_query){
				$formFunctions->insert_applications($uain);
				$str=$formFunctions->getEmail_str($uain);
				/////////////////////////////SEND MAIL////////////////////////////////
				$user_email=$formFunctions->get_usermail($swr_id);
				$dept_email="esgoa.tcp@gmail.com";
				require_once "tcp_form1_print.php"; 
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
						window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=1&dept=tcp';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'tcp_form1.php';
					</script>";
				}
			}else{
				echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'tcp_form1.php';
					</script>";
			}			
		}
	}
}
if(isset($_POST["save2"])){		
	$ref_no=clean($_POST["ref_no"]);$submit_dt=clean($_POST["submit_dt"]);$receive_dt=clean($_POST["receive_dt"]);$officer_name=clean($_POST["officer_name"]);	$add_line1=clean($_POST["add_line1"]);$add_line2=clean($_POST["add_line2"]);$engineer=clean($_POST["engineer"]);$engineer_address=clean($_POST["engineer_address"]);$owner_name=clean($_POST["owner_name"]);$owner_address=clean($_POST["owner_address"]);
	
	
	$sql=$tcp->query("select form_id from tcp_form2 where user_id='$swr_id' and active='1'") or die("Error :".$tcp->error);
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
	  $query=$tcp->query("insert into tcp_form2(user_id,sub_date,ref_no,submit_dt,receive_dt,officer_name,add_line1,add_line2,engineer,engineer_address,owner_name,owner_address) values ('$swr_id','$today','$ref_no','$submit_dt','$receive_dt','$officer_name','$add_line1','$add_line2','$engineer','$engineer_address','$owner_name','$owner_address')") OR die("Error: ".$tcp->error);
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$tcp->query("update tcp_form2 set sub_date='$today', ref_no='$ref_no',submit_dt='$submit_dt',receive_dt='$receive_dt',officer_name='$officer_name',add_line1='$add_line1',add_line2='add_line2',engineer='$engineer',engineer_address='$engineer_address',owner_name='$owner_name',owner_address='$owner_address' where form_id=$form_id") OR die("Error: ".$tcp->error);	
	}					
	if($query){
			$formFunctions->insert_incomplete_forms('tcp','2'); //tcp commer-- dept name and 1 -- form no
			echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'preview.php?token=2';
			</script>"; 
	}else{
			echo "<script>
				alert('Invalid Entry');
				window.location.href = 'tcp_form2.php?tab=1';
			</script>";
	}	
}
if(isset($_POST["proceed2"])){
	$sql=$tcp->query("select form_id,save_mode,courier_details from tcp_form2 where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'tcp_form2.php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'tcp','2');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$tcp->query("update tcp_form2 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($tcp->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=tcp&form=2';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=2';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$formFunctions->updateSubmit($uain,$form_id);
			$formFunctions->insert_applications($uain);
			$str=$formFunctions->getEmail_str($uain);
			/////////////////////////////SEND MAIL////////////////////////////////
			$user_email=$formFunctions->get_usermail($swr_id);
			$dept_email="esgoa.tcp@gmail.com";
			require_once "tcp_form2_print.php"; 
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
					window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=2&dept=tcp';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'tcp_form2.php';
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
if(isset($_POST["save3"])){		
	$ref_no=clean($_POST["ref_no"]);$submit_dt=clean($_POST["submit_dt"]);$receive_dt=clean($_POST["receive_dt"]);$officer_name=clean($_POST["officer_name"]);	$add_line1=clean($_POST["add_line1"]);$add_line2=clean($_POST["add_line2"]);$engineer=clean($_POST["engineer"]);$engineer_address=clean($_POST["engineer_address"]);$owner_name=clean($_POST["owner_name"]);$owner_address=clean($_POST["owner_address"]);
	
	
	$sql=$tcp->query("select form_id from tcp_form3 where user_id='$swr_id' and active='1'") or die("Error :".$tcp->error);
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
	  $query=$tcp->query("insert into tcp_form3(user_id,sub_date,ref_no,submit_dt,receive_dt,officer_name,add_line1,add_line2,engineer,engineer_address,owner_name,owner_address) values ('$swr_id','$today','$ref_no','$submit_dt','$receive_dt','$officer_name','$add_line1','$add_line2','$engineer','$engineer_address','$owner_name','$owner_address')") OR die("Error: ".$tcp->error);
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$tcp->query("update tcp_form3 set sub_date='$today', ref_no='$ref_no',submit_dt='$submit_dt',receive_dt='$receive_dt',officer_name='$officer_name',add_line1='$add_line1',add_line2='add_line2',engineer='$engineer',engineer_address='$engineer_address',owner_name='$owner_name',owner_address='$owner_address' where form_id=$form_id") OR die("Error: ".$tcp->error);	
	}					
	if($query){
			$formFunctions->insert_incomplete_forms('tcp','3'); //tcp commer-- dept name and 1 -- form no
			echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'preview.php?token=3';
			</script>"; 
	}else{
			echo "<script>
				alert('Invalid Entry');
				window.location.href = 'tcp_form3.php?tab=1';
			</script>";
	}	
}
if(isset($_POST["proceed3"])){
	$sql=$tcp->query("select form_id,save_mode,courier_details from tcp_form3 where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'tcp_form3.php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'tcp','3');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$tcp->query("update tcp_form3 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($tcp->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=tcp&form=3';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=3';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$formFunctions->updateSubmit($uain,$form_id);
			$formFunctions->insert_applications($uain);
			$str=$formFunctions->getEmail_str($uain);
			/////////////////////////////SEND MAIL////////////////////////////////
			$user_email=$formFunctions->get_usermail($swr_id);
			$dept_email="esgoa.tcp@gmail.com";
			require_once "tcp_form3_print.php"; 
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
					window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=3&dept=tcp';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'tcp_form3.php';
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
if(isset($_POST["save4"])){		
	$ref_no=clean($_POST["ref_no"]);$submit_dt=clean($_POST["submit_dt"]);$receive_dt=clean($_POST["receive_dt"]);$officer_name=clean($_POST["officer_name"]);	$add_line1=clean($_POST["add_line1"]);$add_line2=clean($_POST["add_line2"]);$engineer=clean($_POST["engineer"]);$engineer_address=clean($_POST["engineer_address"]);$owner_name=clean($_POST["owner_name"]);$owner_address=clean($_POST["owner_address"]);$drawings=clean($_POST["drawings"]);
	
	
	$sql=$tcp->query("select form_id from tcp_form4 where user_id='$swr_id' and active='1'") or die("Error :".$tcp->error);
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
	  $query=$tcp->query("insert into tcp_form4(user_id,sub_date,ref_no,submit_dt,receive_dt,officer_name,add_line1,add_line2,engineer,engineer_address,owner_name,owner_address,drawings) values ('$swr_id','$today','$ref_no','$submit_dt','$receive_dt','$officer_name','$add_line1','$add_line2','$engineer','$engineer_address','$owner_name','$owner_address','$drawings')") OR die("Error: ".$tcp->error);
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$tcp->query("update tcp_form4 set sub_date='$today', ref_no='$ref_no',submit_dt='$submit_dt',receive_dt='$receive_dt',officer_name='$officer_name',add_line1='$add_line1',add_line2='add_line2',engineer='$engineer',engineer_address='$engineer_address',owner_name='$owner_name',owner_address='$owner_address',drawings='$drawings' where form_id=$form_id") OR die("Error: ".$tcp->error);	
	}					
	if($query){
			$formFunctions->insert_incomplete_forms('tcp','4'); //tcp commer-- dept name and 1 -- form no
			echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'preview.php?token=4';
			</script>"; 
	}else{
			echo "<script>
				alert('Invalid Entry');
				window.location.href = 'tcp_form4.php?tab=1';
			</script>";
	}	
}
if(isset($_POST["proceed4"])){
	$sql=$tcp->query("select form_id,save_mode,courier_details from tcp_form4 where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'tcp_form4.php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'tcp','4');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$tcp->query("update tcp_form4 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($tcp->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=tcp&form=4';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=4';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$formFunctions->updateSubmit($uain,$form_id);
			$formFunctions->insert_applications($uain);
			$str=$formFunctions->getEmail_str($uain);
			/////////////////////////////SEND MAIL////////////////////////////////
			$user_email=$formFunctions->get_usermail($swr_id);
			$dept_email="esgoa.tcp@gmail.com";
			require_once "tcp_form4_print.php"; 
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
					window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=4&dept=tcp';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'tcp_form4.php';
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
if(isset($_POST["save5"])){		
	$ref_no=clean($_POST["ref_no"]);$submit_dt=clean($_POST["submit_dt"]);$receive_dt=clean($_POST["receive_dt"]);$officer_name=clean($_POST["officer_name"]);	$add_line1=clean($_POST["add_line1"]);$add_line2=clean($_POST["add_line2"]);$engineer=clean($_POST["engineer"]);$engineer_address=clean($_POST["engineer_address"]);$owner_name=clean($_POST["owner_name"]);$owner_address=clean($_POST["owner_address"]);$drawings=clean($_POST["owner_address"]);
	
	
	$sql=$tcp->query("select form_id from tcp_form5 where user_id='$swr_id' and active='1'") or die("Error :".$tcp->error);
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
	  $query=$tcp->query("insert into tcp_form5(user_id,sub_date,ref_no,submit_dt,receive_dt,officer_name,add_line1,add_line2,engineer,engineer_address,owner_name,owner_address,drawings) values ('$swr_id','$today','$ref_no','$submit_dt','$receive_dt','$officer_name','$add_line1','$add_line2','$engineer','$engineer_address','$owner_name','$owner_address','$drawings')") OR die("Error: ".$tcp->error);
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$tcp->query("update tcp_form5 set sub_date='$today', ref_no='$ref_no',submit_dt='$submit_dt',receive_dt='$receive_dt',officer_name='$officer_name',add_line1='$add_line1',add_line2='add_line2',engineer='$engineer',engineer_address='$engineer_address',owner_name='$owner_name',owner_address='$owner_address',drawings='$drawings' where form_id=$form_id") OR die("Error: ".$tcp->error);	
	}					
	if($query){
			$formFunctions->insert_incomplete_forms('tcp','5'); //tcp commer-- dept name and 1 -- form no
			echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'preview.php?token=5';
			</script>"; 
	}else{
			echo "<script>
				alert('Invalid Entry');
				window.location.href = 'tcp_form5.php?tab=1';
			</script>";
	}	
}
if(isset($_POST["proceed5"])){
	$sql=$tcp->query("select form_id,save_mode,courier_details from tcp_form5 where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'tcp_form5.php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'tcp','5');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$tcp->query("update tcp_form5 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($tcp->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=tcp&form=5';
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
			$dept_email="esgoa.tcp@gmail.com";
			require_once "tcp_form5_print.php"; 
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
					window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=5&dept=tcp';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'tcp_form5.php';
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
if(isset($_POST["save6"])){		
	$ref_no=clean($_POST["ref_no"]);$submit_dt=clean($_POST["submit_dt"]);$receive_dt=clean($_POST["receive_dt"]);$officer_name=clean($_POST["officer_name"]);	$add_line1=clean($_POST["add_line1"]);$add_line2=clean($_POST["add_line2"]);$engineer=clean($_POST["engineer"]);$engineer_address=clean($_POST["engineer_address"]);$owner_name=clean($_POST["owner_name"]);$owner_address=clean($_POST["owner_address"]);$drawings=clean($_POST["owner_address"]);
	
	
	$sql=$tcp->query("select form_id from tcp_form6 where user_id='$swr_id' and active='1'") or die("Error :".$tcp->error);
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
	  $query=$tcp->query("insert into tcp_form6(user_id,sub_date,ref_no,submit_dt,receive_dt,officer_name,add_line1,add_line2,engineer,engineer_address,owner_name,owner_address,drawings) values ('$swr_id','$today','$ref_no','$submit_dt','$receive_dt','$officer_name','$add_line1','$add_line2','$engineer','$engineer_address','$owner_name','$owner_address','$drawings')") OR die("Error: ".$tcp->error);
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$tcp->query("update tcp_form6 set sub_date='$today', ref_no='$ref_no',submit_dt='$submit_dt',receive_dt='$receive_dt',officer_name='$officer_name',add_line1='$add_line1',add_line2='$add_line2',engineer='$engineer',engineer_address='$engineer_address',owner_name='$owner_name',owner_address='$owner_address',drawings='$drawings' where form_id=$form_id") OR die("Error: ".$tcp->error);	
	}					
	if($query){
			$formFunctions->insert_incomplete_forms('tcp','6'); //tcp commer-- dept name and 1 -- form no
			echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'preview.php?token=6';
			</script>"; 
	}else{
			echo "<script>
				alert('Invalid Entry');
				window.location.href = 'tcp_form6.php?tab=1';
			</script>";
	}	
}
if(isset($_POST["proceed6"])){
	$sql=$tcp->query("select form_id,save_mode,courier_details from tcp_form6 where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'tcp_form6.php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'tcp','6');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$tcp->query("update tcp_form6 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($tcp->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=tcp&form=6';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=6';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$formFunctions->updateSubmit($uain,$form_id);
			$formFunctions->insert_applications($uain);
			$str=$formFunctions->getEmail_str($uain);
			/////////////////////////////SEND MAIL////////////////////////////////
			$user_email=$formFunctions->get_usermail($swr_id);
			$dept_email="esgoa.tcp@gmail.com";
			require_once "tcp_form6_print.php"; 
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
					window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=6&dept=tcp';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'tcp_form6.php';
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
if(isset($_POST["save7"])){		
	$address=clean($_POST["address"]);$conforms_to=clean($_POST["conforms_to"]);$inst_address=clean($_POST["inst_address"]);$zone=clean($_POST["zone"]);	
	
	
	$sql=$tcp->query("select form_id from tcp_form7 where user_id='$swr_id' and active='1'") or die("Error :".$tcp->error);
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
	  $query=$tcp->query("insert into tcp_form7(user_id,sub_date,address,conforms_to,inst_address,zone) values ('$swr_id','$today','$address','$conforms_to','$inst_address','$zone')") OR die("Error: ".$tcp->error);
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$tcp->query("update tcp_form7 set sub_date='$today', address='$address',conforms_to='$conforms_to', inst_address='$inst_address', zone='$zone' where form_id=$form_id") OR die("Error: ".$tcp->error);	
	}					
	if($query){
			$formFunctions->insert_incomplete_forms('tcp','7'); //tcp commer-- dept name and 1 -- form no
			echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'preview.php?token=7';
			</script>";
	}else{
			echo "<script>
				alert('Invalid Entry');
				window.location.href = 'tcp_form7.php';
			</script>";
	}	
}
if(isset($_POST["proceed7"])){
	$sql=$tcp->query("select form_id,save_mode,courier_details from tcp_form7 where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'tcp_form7.php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'tcp','7');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$tcp->query("update tcp_form7 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($tcp->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=tcp&form=7';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=7';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$formFunctions->updateSubmit($uain,$form_id);
			$formFunctions->insert_applications($uain);
			$str=$formFunctions->getEmail_str($uain);
			/////////////////////////////SEND MAIL////////////////////////////////
			$user_email=$formFunctions->get_usermail($swr_id);
			$dept_email="esgoa.tcp@gmail.com";
			require_once "tcp_form7_print.php"; 
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
					window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=7&dept=tcp';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'tcp_form7.php';
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
if(isset($_POST["save8"])){		
	$supervision=clean($_POST["supervision"]);$name=clean($_POST["name"]);$edu_quali=clean($_POST["edu_quali"]);$past_exp=clean($_POST["past_exp"]);$father_name=clean($_POST["father_name"]);$dob=clean($_POST["dob"]);$owner_age=clean($_POST["owner_age"]);$pan=clean($_POST["pan"]);
	if(!empty($_POST["authority_addres"]))	 $authority_addres=json_encode($_POST["authority_addres"]);
	else	$authority_addres=NULL;
	if(!empty($_POST["pre_add"]))	 $pre_add=json_encode($_POST["pre_add"]);
	else	$pre_add=NULL;
	if(!empty($_POST["fees"]))	 $fees=json_encode($_POST["fees"]);
	else	$fees=NULL;
	
	if(empty($_POST["mfile1"]) ){
		echo "<script>
			alert('Error in file / You didnot select any option.');
			window.location.href = 'tcp_form8.php';
		</script>";
	}else{		
		$file1=clean($_POST["mfile1"]);
	}
	
	$sql=$tcp->query("select form_id from tcp_form8 where user_id='$swr_id' and active='1'") or die("Error :".$tcp->error);
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
	  $query=$tcp->query("insert into tcp_form8(user_id,sub_date,authority_addres,supervision,name,edu_quali,past_exp,father_name,dob,owner_age,pre_add,fees,file1,pan) values ('$swr_id','$today','$authority_addres','$supervision','$name','$edu_quali','$past_exp','$father_name','$dob','$owner_age','$pre_add','$fees','$file1','$pan')") OR die("Error: ".$tcp->error);
	  $form_id=$tcp->insert_id;
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$tcp->query("update tcp_form8 set sub_date='$today', authority_addres='$authority_addres',supervision='$supervision', name='$name', edu_quali='$edu_quali', past_exp='$past_exp', father_name='$father_name', dob='$dob', owner_age='$owner_age', pre_add='$pre_add', fees='$fees', file1='$file1', pan='$pan' where form_id=$form_id") OR die("Error: ".$tcp->error);	
	}					
	if($query){
		if($file1=="SC"){
			$save_query=$tcp->query("update tcp_form8 set courier_details='1',received_date=NULL, sub_date='$today' where form_id='$form_id'") or die($tcp->error);
		}else{
			$save_query=$tcp->query("update tcp_form8 set sub_date='$today',received_date='$today',courier_details=NULL where form_id='$form_id'") or die($tcp->error);
		}
		if($save_query){
			$formFunctions->insert_incomplete_forms('tcp','8'); //tcp commer-- dept name and 1 -- form no
			echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'preview.php?token=8';
			</script>";
		}else{
				echo "<script>
					alert('Invalid Entry');
					window.location.href = 'tcp_form8.php';
				</script>";
		}	
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href ='tcp_form9.php';
		</script>";
	}	
}
if(isset($_POST["proceed8"])){
	$sql=$tcp->query("select form_id,save_mode,courier_details from tcp_form8 where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'tcp_form8.php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'tcp','8');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$tcp->query("update tcp_form8 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($tcp->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=tcp&form=8';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=8';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$formFunctions->updateSubmit($uain,$form_id);
			$formFunctions->insert_applications($uain);
			$str=$formFunctions->getEmail_str($uain);
			/////////////////////////////SEND MAIL////////////////////////////////
			$user_email=$formFunctions->get_usermail($swr_id);
			$dept_email="esgoa.tcp@gmail.com";
			require_once "tcp_form8_print.php"; 
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
					window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=8&dept=tcp';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'tcp_form8.php';
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
if(isset($_POST["save9"])){		
	$supervision=clean($_POST["supervision"]);$agency=clean($_POST["agency"]);$pan=clean($_POST["pan"]);
	 $input_size=$_POST["hiddenval"];
	if(!empty($_POST["authority_addres"]))	 $authority_addres=json_encode($_POST["authority_addres"]);
	else	$authority_addres=NULL;
	if(!empty($_POST["pre_add"]))	 $pre_add=json_encode($_POST["pre_add"]);
	else	$pre_add=NULL;
	
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
	  $query=$tcp->query("insert into tcp_form9(user_id,sub_date,authority_addres,supervision,agency,pan,file1,pre_add) values ('$swr_id','$today','$authority_addres','$supervision','$agency','$pan','$file1','$pre_add')") OR die("Error: ".$tcp->error);
	  $form_id=$tcp->insert_id;
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$tcp->query("update tcp_form9 set sub_date='$today', authority_addres='$authority_addres',supervision='$supervision', agency='$agency', pan='$pan', file1='$file1',  pre_add='$pre_add' where form_id=$form_id") OR die("Error: ".$tcp->error);	
	}	
	if($query){
		if($file1=="SC"){
			$save_query=$tcp->query("update tcp_form9 set courier_details='1',received_date=NULL, sub_date='$today' where form_id='$form_id'") or die($tcp->error);
		}else{
			$save_query=$tcp->query("update tcp_form9 set sub_date='$today',received_date='$today',courier_details=NULL where form_id='$form_id'") or die($tcp->error);
		}
		if($save_query){
				$formFunctions->insert_incomplete_forms('tcp','9'); //tcp commer-- dept name and 1 -- form no
				if($input_size!=0){					
				$k=$tcp->query("delete from tcp_form9_t1 where form_id='$form_id'");
				for($i=1;$i<$input_size;$i++){
					//$vala=$_POST["txtA".$i];		
					$valb=$_POST["txtB".$i];
					$valc=$_POST["txtC".$i];
					$vald=$_POST["txtD".$i];
					$part1=$tcp->query("INSERT INTO tcp_form9_t1(id,form_id,slno,name,personal_cap,rank) VALUES ('','$form_id','$i','$valb','$valc','$vald')") or die("error in insertion tcp_form9_t1".$tcp->error);
					}
				}
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