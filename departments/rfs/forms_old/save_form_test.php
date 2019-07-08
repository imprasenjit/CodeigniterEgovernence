<?php
if(isset($_POST["save11"])){		
	if(isset($_POST["reg_no"]) || isset($_POST["reg_date"])|| isset($_POST["propsociety"])){
		$reg_no=$_POST["reg_no"];$reg_date=date("Y-m-d",strtotime($_POST["reg_date"]));
	}else{
		$previous_details=$rfs->query("select * from rfs_form2 a,rfs_form2_certificates b where a.user_id='$swr_id' and a.save_mode='C' and b.form_id=a.form_id") or die("Error1 : ".$rfs->error);
		if($previous_details->num_rows>0){
			$prev_results=$previous_details->fetch_assoc();
			$uain=$prev_results->uain;$reg_date=$prev_results->upload_date;
		}else{
			echo "<script>
					alert('Something went wrong!!! Please try again');
				</script>";
			exit();
		}
	}
	$post_office=$_POST["post_office"];$police_station=$_POST["police_station"];
	
	$sql=$rfs->query("select form_id from rfs_form11 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$rfs->query("insert into rfs_form11(user_id,sub_date,reg_no,reg_date,post_office,police_station) values ('$swr_id','$today', '$reg_no', '$reg_date', '$post_office','$police_station')") OR die("Error : ".$rfs->error);
	}else{
		$form_id=$row["form_id"];	
		$query=$rfs->query("update rfs_form11 set sub_date='$today', reg_no='$reg_no', reg_date='$reg_date', post_office='$post_office',police_station='$police_station'  where form_id=$form_id") OR die("Error: ".$rfs->error);	
	}				
	if($query){
		$formFunctions->insert_incomplete_forms('rfs','11'); //rfs-- dept name and 1 -- form no 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = 'rfs_form11.php?tab=2';
		</script>";
		
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'rfs_form11.php?tab=1';
		</script>";
	}
}
if(isset($_POST["submit11"])){
	if((isset($_POST["mfile1"]) && empty($_POST["mfile1"])) || (isset($_POST["mfile2"]) && empty($_POST["mfile2"])) || (isset($_POST["mfile3"]) && empty($_POST["mfile3"])) || (isset($_POST["mfile4"]) && empty($_POST["mfile4"])) || (isset($_POST["mfile5"]) && empty($_POST["mfile5"]))  || (isset($_POST["mfile1"]) && $_POST["mfile1"]=='2') || (isset($_POST["mfile2"]) && $_POST["mfile2"]=='2') || (isset($_POST["mfile3"]) && $_POST["mfile3"]=='2') || (isset($_POST["mfile4"]) && $_POST["mfile4"]=='2') || (isset($_POST["mfile5"]) && $_POST["mfile5"]=='2') ||   (isset($_POST["mfile1"]) && $_POST["mfile1"]=='3') || (isset($_POST["mfile2"]) && $_POST["mfile2"]=='3') || (isset($_POST["mfile3"]) && $_POST["mfile3"]=='3') || (isset($_POST["mfile4"]) && $_POST["mfile4"]=='3') || (isset($_POST["mfile5"]) && $_POST["mfile5"]=='3') ){
			echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'rfs_form11.php?tab=2';
			</script>";

	
	
	}else{
		$file1=clean($_POST["mfile1"]);$file2=clean($_POST["mfile2"]);$file3=clean($_POST["mfile3"]);$file4=clean($_POST["mfile4"]);$file5=clean($_POST["mfile5"]);
		$formFunctions->file_update($file1);$formFunctions->file_update($file2);$formFunctions->file_update($file3);$formFunctions->file_update($file4);$formFunctions->file_update($file5);
		$query=$rfs->query("select form_id from rfs_form11 where user_id='$swr_id' and active='1'") or die("Error3 :". $rfs->error);
		if($query->num_rows>0){
			$values=$query->fetch_object();
			$form_id=$values->form_id;
		
			if($file1=="SC" || $file2=="SC" ||  $file3=="SC" ||  $file4=="SC" ||  $file5=="SC" ){
				$save_query=$rfs->query("update rfs_form11 set courier_details='1',sub_date='$today',file1='$file1',file2='$file2',file3='$file3',file4='$file4',file5='$file5' where form_id='$form_id'") or die($rfs->error);
			}else{
				$courier_details=NULL;
				$save_query=$rfs->query("update rfs_form11 set save_mode='D',courier_details='$courier_details', sub_date='$today',received_date='$today',file1='$file1',file2='$file2',file3='$file3',file4='$file4',file5='$file5' where form_id='$form_id'") or die($rfs->error);
			}				
			if($save_query){
				echo "<script>
				alert('Successfully Saved.');
				window.location.href = 'preview.php?token=11';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'rfs_form11.php?tab=2';
				</script>";
			}							
		}
	}
}

if(isset($_POST["proceed11"])){
	$sql=$rfs->query("select form_id,save_mode,courier_details from rfs_form11 where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'rfs_form11.php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'rfs','11');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$rfs->query("update rfs_form11 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($rfs->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=rfs&form=11';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=11';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$formFunctions->updateSubmit($uain,$form_id);	
			$formFunctions->insert_applications($uain);
			$str=$formFunctions->getEmail_str($uain);
			/*----------------SEND MAIL-----------------*/
			$user_email=$formFunctions->get_usermail($swr_id);
			$dept_email="esgoa.rfs@gmail.com";
			
			require_once "rfs_form11_print.php"; 
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
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=11&dept=rfs';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'rfs_form11.php';
				</script>";
			}
		}else{
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=11';
				</script>";
		}
	}
}	
if(isset($_POST["save3"])){	
	if(isset($_POST["reg_no"]) ||
	isset($_POST["reg_date"]) ||
	isset($_POST["b_mouza"]) || 
	isset($_POST["b_circle"]) || 
	isset($_POST["b_patta"]) || 
	isset($_POST["b_dag"]) ||
	isset($_POST["b_area"]) ||
	isset($_POST["b_locality"]) || 
	isset($_POST["b_village"]) || 
	isset($_POST["b_postoffice"])||
	isset($_POST["b_policestation"]) ||
	isset($_POST["b_district"]) ||
	isset($_POST["b_pincode1"]) ||
	isset($_POST["b_mobile"]) || 
    isset($_POST["b_email1"])||
	isset($_POST["deed"])||
    isset($_POST["date"])||
	isset($_POST["place_deed"])||
	isset($_POST["deed1"])||
	isset($_POST["date1"])||
	isset($_POST["place_deed1"])||
	isset($_POST["certificate"])||
	isset($_POST["issue"])||
	isset($_POST["date_issue"]))
	{
		$b_mouza=$_POST["b_mouza"];$b_circle=$_POST["b_circle"];$b_patta=$_POST["b_patta"];$_POST["b_dag"];$b_area=$_POST["b_area"];$b_locality=$_POST["b_locality"];$deed=$_POST["deed"];$date=date("Y-m-d",strtotime($_POST["date"]));$place_deed=$_POST["place_deed"];$deed1=$_POST["deed1"];$date1=date("Y-m-d",strtotime($_POST["date1"]));$place_deed1=$_POST["place_deed1"];$certificate=$_POST["certificate"];$issue=$_POST["issue"];$date_issue=date("Y-m-d",strtotime($_POST["date_issue"]));
		$b_village=$_POST["b_village"];$b_postoffice=$_POST["b_postoffice"];$b_policestation=$_POST["b_policestation"];$b_district=$_POST["b_district"];$b_pincode1=$_POST["b_pincode1"];$b_mobile=	$_POST["b_mobile"];$b_email1=$_POST["b_email1"];	$reg_no=$_POST["reg_no"];$propsociety=$_POST["propsociety"];$reg_date=date("Y-m-d",strtotime($_POST["reg_date"]));
	}
	//else{
		//$previous_details=$rfs->query("select * from rfs_form2 a,rfs_form2_certificates b where a.user_id='$swr_id' and a.save_mode='C' and b.form_id=a.form_id") or die("Error : ".$rfs->error);
		//if($previous_details->num_rows>0){
		//	$prev_results=$previous_details->fetch_assoc();
			//$uain=$prev_results->uain;$reg_date=$prev_results->upload_date;
		//}else{
		//	echo "<script>
					//alert('Something went wrong!!! Please try again');
					//windows.location.href='rfs_form3.php';
				//</script>";
			//exit();
		//}
	//}
	$post_office=$_POST["post_office"];$police_station=$_POST["police_station"];$propsociety=$_POST["propsociety"];$b_mouza=$_POST["b_mouza"];$b_circle=$_POST["b_circle"];$b_patta=$_POST["b_patta"];$_POST["b_dag"];$b_area=$_POST["b_area"];$b_locality=$_POST["b_locality"];$b_village=$_POST["b_village"];$b_postoffice=$_POST["b_postoffice"];$b_policestation=$_POST["b_policestation"];$b_district=$_POST["b_district"];$b_pincode1=$_POST["b_pincode1"];$b_mobile=	$_POST["b_mobile"];$b_email1=$_POST["b_email1"];	$reg_no=$_POST["reg_no"];$propsociety=$_POST["propsociety"];$deed=$_POST["deed"];$date=date("Y-m-d",strtotime($_POST["date"]));$place_deed=$_POST["place_deed"];$deed1=$_POST["deed1"];$date1=date("Y-m-d",strtotime($_POST["date1"]));$place_deed1=$_POST["place_deed1"];$certificate=$_POST["certificate"];$issue=$_POST["issue"];$date_issue=date("Y-m-d",strtotime($_POST["date_issue"]));
	
	$sql=$rfs->query("select form_id from rfs_form3 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$rfs->query("insert into rfs_form3(user_id,sub_date,reg_no,reg_date,post_office,police_station,propsociety,b_mouza,b_circle,b_patta,b_dag,b_area,b_locality,b_village,b_postoffice,b_policestation,b_district,b_pincode1,b_mobile,b_email1,deed,deed1,date,date1,place_deed,place_deed1,certificate,issue,date_issue) values ('$swr_id','$today', '$reg_no', '$reg_date', '$post_office','$propsociety','$police_station''$b_mouza','$b_circle','$b_patta','$b_dag','$b_area','$b_locality','$b_village','$b_postoffice,'$b_policestation','$b_district','$b_pincode1','$b_mobile','$b_email1','$deed','$deed1','$date','$date1','$place_deed','$place_deed1','$certificate','$issue','$date_issue'") OR die("Error: ".$rfs->error);
	}else{
		$form_id=$row["form_id"];	
		$query=$rfs->query("update rfs_form3 set sub_date='$today', reg_no='$reg_no', reg_date='$reg_date', post_office='$post_office',police_station='$police_station' ,b_mouza='$b_mouza',b_circle='$b_circle',b_patta='$b_patta',b_dag='$b_dag',b_area='$b_area',b_locality='$b_locality',b_village='$b_village',postoffice='$b_postoffice',b_policestation='$b_policestation',b_district='$b_district',b_pincode1='$b_pincode1',b_mobile='$b_mobile',b_email1=
		'$b_email1',propsociety='$propsociety' ,deed='$deed',deed1='$deed1',date='$date',date1='$date1',place_deed='$place_deed',place_deed1='$place_deed1',certificate='$certificate',issue='$issue',date_issue='$date_issue'where form_id=$form_id") OR die("Error: ".$rfs->error);	
	}				
	if($query){
		$formFunctions->insert_incomplete_forms('rfs','3'); //rfs-- dept name and 1 -- form no 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = 'rfs_form3.php?tab=2';
		</script>";
		
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'rfs_form3.php?tab=1';
		</script>";
	}
}
if(isset($_POST["submit3"])){
if((isset($_POST["mfile1"]) && empty($_POST["mfile1"])) || 
(isset($_POST["mfile2"]) && empty($_POST["mfile2"])) || 
(isset($_POST["mfile3"]) && empty($_POST["mfile3"])) ||
(isset($_POST["mfile4"]) && empty($_POST["mfile4"])) ||
(isset($_POST["mfile5"]) && empty($_POST["mfile5"])) ||
(isset($_POST["mfile6"]) && empty($_POST["mfile6"])) || 
(isset($_POST["mfile7"]) && empty($_POST["mfile7"])) ||
(isset($_POST["mfile8"]) && empty($_POST["mfile8"]))||
(isset($_POST["mfile9"]) && empty($_POST["mfile9"]))||
 (isset($_POST["mfile10"]) && empty($_POST["mfile10"]))||
 (isset($_POST["mfile1"]) && $_POST["mfile1"]=='2') || 
 (isset($_POST["mfile2"]) && $_POST["mfile2"]=='2') || 
 (isset($_POST["mfile3"]) && $_POST["mfile3"]=='2') ||
 (isset($_POST["mfile4"]) && $_POST["mfile4"]=='2') ||
 (isset($_POST["mfile5"]) && $_POST["mfile5"]=='2') || 
 (isset($_POST["mfile6"]) && $_POST["mfile6"]=='2') || 
 (isset($_POST["mfile7"]) && $_POST["mfile7"]=='2') || 
 (isset($_POST["mfile8"]) && $_POST["mfile8"]=='2') ||
 (isset($_POST["mfile9"]) && $_POST["mfile9"]=='2') ||  
 (isset($_POST["mfile10"]) && $_POST["mfile10"]=='2') || 
 (isset($_POST["mfile1"]) && $_POST["mfile1"]=='3') ||
 (isset($_POST["mfile2"]) && $_POST["mfile2"]=='3') || 
 (isset($_POST["mfile3"]) && $_POST["mfile3"]=='3') ||
 (isset($_POST["mfile4"]) && $_POST["mfile4"]=='3') || 
 (isset($_POST["mfile5"]) && $_POST["mfile5"]=='3') ||
 (isset($_POST["mfile5"]) && $_POST["mfile6"]=='3') ||
 (isset($_POST["mfile7"]) && $_POST["mfile7"]=='3') ||
 (isset($_POST["mfile8"]) && $_POST["mfile8"]=='3') ||
 (isset($_POST["mfile9"]) && $_POST["mfile9"]=='3') ||
 (isset($_POST["mfile10"]) && $_POST["mfile10"]=='3') 
 ){
			echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'rfs_form3.php?tab=2';
			</script>";

	
	
	}else{
		$file1=clean($_POST["mfile1"]);$file2=clean($_POST["mfile2"]);$file3=clean($_POST["mfile3"]);$file4=clean($_POST["mfile4"]);$file5=clean($_POST["mfile5"]);$file6=clean($_POST["mfile6"]);$file7=clean($_POST["mfile7"]);$file8=clean($_POST["mfile8"]);$file9=clean($_POST["mfile9"]);$file10=clean($_POST["mfile10"]);
		$formFunctions->file_update($file1);$formFunctions->file_update($file2);$formFunctions->file_update($file3);$formFunctions->file_update($file4);$formFunctions->file_update($file5);$formFunctions->file_update($file6);
		$formFunctions->file_update($file7);$formFunctions->file_update($file7);
		$formFunctions->file_update($file8);$formFunctions->file_update($file8);
		$formFunctions->file_update($file9);$formFunctions->file_update($file9);
	    $formFunctions->file_update($file10);$formFunctions->file_update($file10);
		$query=$rfs->query("select form_id from rfs_form3 where user_id='$swr_id' and active='1'") or die("Error :". $rfs->error);
		if($query->num_rows>0){
			$values=$query->fetch_object();
			$form_id=$values->form_id;
		
			if($file1=="SC" || $file2=="SC" ||  $file3=="SC" ||  $file4=="SC" ||  $file5=="SC"|| $file6=="SC"||$file7=="SC"||$file8=="SC"||$file9=="SC"||$file10=="SC"){
				$save_query=$rfs->query("update rfs_form9 set courier_details='1',sub_date='$today',file1='$file1',file2='$file2',file3='$file3',file4='$file4',file5='$file5',file6='$file6',file7='$file7',file8='$file8' ,file9='$file9',file10='$file10'where form_id='$form_id'") or die($rfs->error);
			}else{
				$courier_details=NULL;
				$save_query=$rfs->query("update rfs_form9 set save_mode='D',courier_details='$courier_details', sub_date='$today',received_date='$today',file1='$file1',file2='$file2',file3='$file3',file4='$file4',file5='$file5' ,file6='$file6',file7='$file7',file8='$file8',file9='$file9',file10='$file10'where form_id='$form_id'") or die($rfs->error);
			}				
			if($save_query){
				echo "<script>
				alert('Successfully Saved.');
				window.location.href = 'preview.php?token=3';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'rfs_form3p?tab=2';
				</script>";
			}							
		}
	}
}

if(isset($_POST["proceed3"])){
	$sql=$rfs->query("select form_id,save_mode,courier_details from rfs_form3 where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'rfs_form3.php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'rfs','3');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$rfs->query("update rfs_form3 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($rfs->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=rfs&form=3';
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
			/*----------------SEND MAIL-----------------*/
			$user_email=$formFunctions->get_usermail($swr_id);
			$dept_email="esgoa.rfs@gmail.com";
			
			require_once "rfs_form3_print.php"; 
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
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=3&dept=rfs';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'rfs_form3.php';
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
if(isset($_POST["save6"])){
	
	if(isset($_POST["reg_no"]) || isset($_POST["reg_date"]) || isset($_POST["b_mouza"]) || isset($_POST["b_circle"]) || isset($_POST["b_patta"]) || isset($_POST["b_dag"]) ||isset($_POST["b_area"]) ||isset($_POST["b_locality"]) || isset($_POST["b_village"]) || isset($_POST["b_postoffice"])||isset($_POST["b_policestation"]) ||isset($_POST["b_district"]) || isset($_POST["b_pincode1"]) || isset($_POST["b_mobile"]) || isset($_POST["b_email1"])||isset($_POST["fathers_name"])||isset($_POST["deed"])||isset($_POST["date"])||isset($_POST["place_deed"])||isset($_POST["deed1"])||isset($_POST["date1"])||isset($_POST["place_deed1"])||isset($_POST["certificate"])||isset($_POST["issue"])||isset($_POST["date_issue"])){
		$b_mouza=$_POST["b_mouza"];$b_circle=$_POST["b_circle"];$b_patta=$_POST["b_patta"];$_POST["b_dag"];$b_area=$_POST["b_area"];$b_locality=$_POST["b_locality"];$fathers_name=$_POST["fathers_name"];$deed=$_POST["deed"];$date=$_POST["date"];$place_deed=$_POST["place_deed"];$deed1=$_POST["deed1"];$date1=$_POST["date1"];$place_deed1=$_POST["place_deed1"];
		$b_village=$_POST["b_village"];$b_postoffice=$_POST["b_postoffice"];$b_policestation=$_POST["b_policestation"];$b_district=$_POST["b_district"];$b_pincode1=$_POST["b_pincode1"];$b_mobile=	$_POST["b_mobile"];$b_email1=$_POST["b_email1"];	$reg_no=$_POST["reg_no"];$propsociety=$_POST["propsociety"];$reg_date=date("Y-m-d",strtotime($_POST["reg_date"]));
	}else{
		$previous_details=$rfs->query("select * from rfs_form2 a,rfs_form2_certificates b where a.user_id='$swr_id' and a.save_mode='C' and b.form_id=a.form_id") or die("Error : ".$rfs->error);
		if($previous_details->num_rows>0){
			$prev_results=$previous_details->fetch_assoc();
			$uain=$prev_results->uain;$reg_date=$prev_results->upload_date;
		}else{
			echo "<script>
					alert('Something went wrong!!! Please try again');
				</script>";
			exit();
		}
	}
	$post_office=$_POST["post_office"];$police_station=$_POST["police_station"];$propsociety=$_POST["propsociety"];$b_mouza=$_POST["b_mouza"];$b_circle=$_POST["b_circle"];$b_patta=$_POST["b_patta"];$_POST["b_dag"];$b_area=$_POST["b_area"];$b_locality=$_POST["b_locality"];$b_village=$_POST["b_village"];$b_postoffice=$_POST["b_postoffice"];$b_policestation=$_POST["b_policestation"];$b_district=$_POST["b_district"];$b_pincode1=$_POST["b_pincode1"];$b_mobile=	$_POST["b_mobile"];$b_email1=$_POST["b_email1"];	$reg_no=$_POST["reg_no"];$propsociety=$_POST["propsociety"];$fathers_name=$_POST["fathers_name"];$deed=$_POST["deed"];$date=$_POST["date"];$place_deed=$_POST["place_deed"];$deed1=$_POST["deed1"];$date1=$_POST["date1"];$place_deed1=$_POST["place_deed1"];
	
	$sql=$rfs->query("select form_id from rfs_form6 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$rfs->query("insert into rfs_form6(user_id,sub_date,reg_no,reg_date,post_office,police_station,propsociety,b_mouza,b_circle,b_patta,b_dag,b_area,b_locality,b_village,b_postoffice,b_policestation,b_district,b_pincode1,b_mobile,b_email1,fathers_name,deed,date,place_deed,deed1,date1,place_deed1) values ('$swr_id','$today', '$reg_no', '$reg_date', '$post_office','$propsociety','$police_station''$b_mouza','$b_circle','$b_patta','$b_dag','$b_area','$b_locality','$b_village','$b_postoffice,'$b_policestation','$b_district','$b_pincode1','$b_mobile','$b_email1','$fathers_name','$deed','$date','$place_deed','$deed1','$date1','$place_deed1'") OR die("Error: ".$rfs->error);
	}else{
		$form_id=$row["form_id"];	
		$query=$rfs->query("update rfs_form6 set sub_date='$today', reg_no='$reg_no', reg_date='$reg_date', post_office='$post_office',police_station='$police_station' ,b_mouza='$b_mouza',b_circle='$b_circle',b_patta='$b_patta',b_dag='$b_dag',b_area='$b_area',b_locality='$b_locality',b_village='$b_village',postoffice='$b_postoffice',b_policestation='$b_policestation',b_district='$b_district',b_pincode1='$b_pincode1',b_mobile='$b_mobile',b_email1=
		'$b_email1',propsociety='$propsociety' where form_id=$form_id") OR die("Error: ".$rfs->error);	
	}				
	if($query){
		$formFunctions->insert_incomplete_forms('rfs','6'); //rfs-- dept name and 1 -- form no 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = 'rfs_form6.php?tab=2';
		</script>";
		
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'rfs_form6.php?tab=1';
		</script>";
	}
}
if(isset($_POST["submit6"])){
if((isset($_POST["mfile1"]) && empty($_POST["mfile1"])) || (isset($_POST["mfile2"]) && empty($_POST["mfile2"])) || (isset($_POST["mfile3"]) && empty($_POST["mfile3"])) || (isset($_POST["mfile4"]) && empty($_POST["mfile4"])) || (isset($_POST["mfile5"]) && empty($_POST["mfile5"])||isset($_POST["mfile6"]) && empty($_POST["mfile6"]))  || (isset($_POST["mfile1"]) && $_POST["mfile1"]=='2') || (isset($_POST["mfile2"]) && $_POST["mfile2"]=='2') || (isset($_POST["mfile3"]) && $_POST["mfile3"]=='2') || (isset($_POST["mfile4"]) && $_POST["mfile4"]=='2') || (isset($_POST["mfile5"]) && $_POST["mfile5"]=='2') ||   (isset($_POST["mfile1"]) && $_POST["mfile1"]=='3') || (isset($_POST["mfile2"]) && $_POST["mfile2"]=='3') || (isset($_POST["mfile3"]) && $_POST["mfile3"]=='3') || (isset($_POST["mfile4"]) && $_POST["mfile4"]=='3') || (isset($_POST["mfile5"]) && $_POST["mfile5"]=='3') ){
			echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'rfs_form8.php?tab=2';
			</script>";

	
	
	}else{
		$file1=clean($_POST["mfile1"]);$file2=clean($_POST["mfile2"]);$file3=clean($_POST["mfile3"]);$file4=clean($_POST["mfile4"]);$file5=clean($_POST["mfile5"]);$$file6=clean($_POST["mfile6"]);
		$formFunctions->file_update($file1);$formFunctions->file_update($file2);$formFunctions->file_update($file3);$formFunctions->file_update($file4);$formFunctions->file_update($file5);$formFunctions->file_update($file6);
		$formFunctions->file_update($file7);$formFunctions->file_update($file7);
		$formFunctions->file_update($file8);$formFunctions->file_update($file8);
		$formFunctions->file_update($file9);$formFunctions->file_update($file9);
		$formFunctions->file_update($file10);$formFunctions->file_update($file10);
		$formFunctions->file_update($file11);$formFunctions->file_update($file11);
	
		$query=$rfs->query("select form_id from rfs_form9 where user_id='$swr_id' and active='1'") or die("Error :". $rfs->error);
		if($query->num_rows>0){
			$values=$query->fetch_object();
			$form_id=$values->form_id;
		
			if($file1=="SC" || $file2=="SC" ||  $file3=="SC" ||  $file4=="SC" ||  $file5=="SC"|| $file6=="SC"||$file7=="SC"||$file8=="SC"){
				$save_query=$rfs->query("update rfs_form9 set courier_details='1',sub_date='$today',file1='$file1',file2='$file2',file3='$file3',file4='$file4',file5='$file5',file6='$file6',file7='$file7',file8='$file8' where form_id='$form_id'") or die($rfs->error);
			}else{
				$courier_details=NULL;
				$save_query=$rfs->query("update rfs_form9 set save_mode='D',courier_details='$courier_details', sub_date='$today',received_date='$today',file1='$file1',file2='$file2',file3='$file3',file4='$file4',file5='$file5' ,file6='$file6',file7='$file7',file8='$file8'where form_id='$form_id'") or die($rfs->error);
			}				
			if($save_query){
				echo "<script>
				alert('Successfully Saved.');
				window.location.href = 'preview.php?token=9';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'rfs_form9.php?tab=2';
				</script>";
			}							
		}
	}
}

if(isset($_POST["proceed9"])){
	$sql=$rfs->query("select form_id,save_mode,courier_details from rfs_form9 where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'rfs_form9.php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'rfs','9');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$rfs->query("update rfs_form9 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($rfs->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=rfs&form=9';
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
			/*----------------SEND MAIL-----------------*/
			$user_email=$formFunctions->get_usermail($swr_id);
			$dept_email="esgoa.rfs@gmail.com";
			
			require_once "rfs_form9_print.php"; 
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
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=9&dept=rfs';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'rfs_form9.php';
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

if(isset($_POST["save8"])){
	
	if(isset($_POST["reg_no"]) || isset($_POST["reg_date"]) || isset($_POST["b_mouza"]) || isset($_POST["b_circle"]) || isset($_POST["b_patta"]) || isset($_POST["b_dag"]) ||isset($_POST["b_area"]) ||isset($_POST["b_locality"]) || isset($_POST["b_village"]) || isset($_POST["b_postoffice"])||isset($_POST["b_policestation"]) ||isset($_POST["b_district"]) || isset($_POST["b_pincode1"]) || isset($_POST["b_mobile"]) || isset($_POST["b_email1"])||isset($_POST["deed"])||isset($_POST["date"])||isset($_POST["place_deed"])){
		$b_mouza=$_POST["b_mouza"];$b_circle=$_POST["b_circle"];$b_patta=$_POST["b_patta"];$b_dag=$_POST["b_dag"];$b_area=$_POST["b_area"];$b_locality=$_POST["b_locality"];$deed=$_POST["b_deed"];$date=$_POST["date"];$place_deed=$_POST["place_deed"];
		$b_village=$_POST["b_village"];$b_postoffice=$_POST["b_postoffice"];$b_policestation=$_POST["b_policestation"];$b_district=$_POST["b_district"];$b_pincode1=$_POST["b_pincode1"];$b_mobile=	$_POST["b_mobile"];$b_email1=$_POST["b_email1"];	$reg_no=$_POST["reg_no"];$propsociety=$_POST["propsociety"];$reg_date=date("Y-m-d",strtotime($_POST["reg_date"]));
	}else{
		$previous_details=$rfs->query("select * from rfs_form2 a,rfs_form2_certificates b where a.user_id='$swr_id' and a.save_mode='C' and b.form_id=a.form_id") or die("Error : ".$rfs->error);
		if($previous_details->num_rows>0){
			$prev_results=$previous_details->fetch_assoc();
			$uain=$prev_results->uain;$reg_date=$prev_results->upload_date;
		}else{
			echo "<script>
					alert('Something went wrong!!! Please try again');
				</script>";
			exit();
		}
	}
	$post_office=$_POST["post_office"];$police_station=$_POST["police_station"];$propsociety=$_POST["propsociety"];$b_mouza=$_POST["b_mouza"];$b_circle=$_POST["b_circle"];$b_patta=$_POST["b_patta"];$_POST["b_dag"];$b_area=$_POST["b_area"];$b_locality=$_POST["b_locality"];$b_village=$_POST["b_village"];$b_postoffice=$_POST["b_postoffice"];$b_policestation=$_POST["b_policestation"];$b_district=$_POST["b_district"];$b_pincode1=$_POST["b_pincode1"];$b_mobile=	$_POST["b_mobile"];$b_email1=$_POST["b_email1"];	$reg_no=$_POST["reg_no"];$propsociety=$_POST["propsociety"];$deed=$_POST["deed"];$date=$_POST["date"];$place_deed=$_POST["place_deed"];
	
	$sql=$rfs->query("select form_id from rfs_form8 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$rfs->query("insert into rfs_form5(user_id,sub_date,reg_no,reg_date,post_office,police_station,propsociety,b_mouza,b_circle,b_patta,b_dag,b_area,b_locality,b_village,b_postoffice,b_policestation,b_district,b_pincode1,b_mobile,b_email1,deed,date,place_deed) values ('$swr_id','$today', '$reg_no', '$reg_date', '$post_office','$propsociety','$police_station''$b_mouza','$b_circle','$b_patta','$b_dag','$b_area','$b_locality','$b_village','$b_postoffice,'$b_policestation','$b_district','$b_pincode1','$b_mobile','$b_email1','$deed','$date','$place_deed'") OR die("Error: ".$rfs->error);
	}else{
		$form_id=$row["form_id"];	
		$query=$rfs->query("update rfs_form5 set sub_date='$today', reg_no='$reg_no', reg_date='$reg_date', post_office='$post_office',police_station='$police_station' ,b_mouza='$b_mouza',b_circle='$b_circle',b_patta='$b_patta',b_dag='$b_dag',b_area='$b_area',b_locality='$b_locality',b_village='$b_village',postoffice='$b_postoffice',b_policestation='$b_policestation',b_district='$b_district',b_pincode1='$b_pincode1',b_mobile='$b_mobile',b_email1=
		'$b_email1',propsociety='$propsociety',deed='$deed',date='$date',place_deed='$place_deed' where form_id=$form_id") OR die("Error: ".$rfs->error);	
	}				
	if($query){
		$formFunctions->insert_incomplete_forms('rfs','5'); //rfs-- dept name and 1 -- form no 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = 'rfs_form5.php?tab=2';
		</script>";
		
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'rfs_form5.php?tab=1';
		</script>";
	}
}
if(isset($_POST["submit5"])){
	if((isset($_POST["mfile1"]) && empty($_POST["mfile1"])) || (isset($_POST["mfile2"]) && empty($_POST["mfile2"])) || (isset($_POST["mfile3"]) && empty($_POST["mfile3"])) || (isset($_POST["mfile4"]) && empty($_POST["mfile4"])) || (isset($_POST["mfile5"]) && empty($_POST["mfile5"])||isset($_POST["mfile6"]) && empty($_POST["mfile6"]))  || (isset($_POST["mfile1"]) && $_POST["mfile1"]=='2') || (isset($_POST["mfile2"]) && $_POST["mfile2"]=='2') || (isset($_POST["mfile3"]) && $_POST["mfile3"]=='2') || (isset($_POST["mfile4"]) && $_POST["mfile4"]=='2') || (isset($_POST["mfile5"]) && $_POST["mfile5"]=='2') ||   (isset($_POST["mfile1"]) && $_POST["mfile1"]=='3') || (isset($_POST["mfile2"]) && $_POST["mfile2"]=='3') || (isset($_POST["mfile3"]) && $_POST["mfile3"]=='3') || (isset($_POST["mfile4"]) && $_POST["mfile4"]=='3') || (isset($_POST["mfile5"]) && $_POST["mfile5"]=='3') ){
			echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'rfs_form5.php?tab=2';
			</script>";

	
	
	}else{
		$file1=clean($_POST["mfile1"]);$file2=clean($_POST["mfile2"]);$file3=clean($_POST["mfile3"]);$file4=clean($_POST["mfile4"]);$file5=clean($_POST["mfile5"]);$$file6=clean($_POST["mfile6"]);
		$formFunctions->file_update($file1);$formFunctions->file_update($file2);$formFunctions->file_update($file3);$formFunctions->file_update($file4);$formFunctions->file_update($file5);$formFunctions->file_update($file6);
		$query=$rfs->query("select form_id from rfs_form8 where user_id='$swr_id' and active='1'") or die("Error :". $rfs->error);
		if($query->num_rows>0){
			$values=$query->fetch_object();
			$form_id=$values->form_id;
		
			if($file1=="SC" || $file2=="SC" ||  $file3=="SC" ||  $file4=="SC" ||  $file5=="SC"|| $file6=="SC"){
				$save_query=$rfs->query("update rfs_form8 set courier_details='1',sub_date='$today',file1='$file1',file2='$file2',file3='$file3',file4='$file4',file5='$file5',file6='$file6' where form_id='$form_id'") or die($rfs->error);
			}else{
				$courier_details=NULL;
				$save_query=$rfs->query("update rfs_form8 set save_mode='D',courier_details='$courier_details', sub_date='$today',received_date='$today',file1='$file1',file2='$file2',file3='$file3',file4='$file4',file5='$file5' file6='$file6'where form_id='$form_id'") or die($rfs->error);
			}				
			if($save_query){
				echo "<script>
				alert('Successfully Saved.');
				window.location.href = 'preview.php?token=5';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'rfs_form5.php?tab=2';
				</script>";
			}							
		}
	}
}

if(isset($_POST["proceed5"])){
	$sql=$rfs->query("select form_id,save_mode,courier_details from rfs_form5 where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'rfs_form5.php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'rfs','5');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$rfs->query("update rfs_form5 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($rfs->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=rfs&form=5';
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
			/*----------------SEND MAIL-----------------*/
			$user_email=$formFunctions->get_usermail($swr_id);
			$dept_email="esgoa.rfs@gmail.com";
			
			require_once "rfs_form5_print.php"; 
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
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=5&dept=rfs';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'rfs_form5.php';
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
if(isset($_POST["save9"])){
	
	if(isset($_POST["reg_no"]) || isset($_POST["reg_date"]) || isset($_POST["b_mouza"]) || isset($_POST["b_circle"]) || isset($_POST["b_patta"]) || isset($_POST["b_dag"]) ||isset($_POST["b_area"]) ||isset($_POST["b_locality"]) || isset($_POST["b_village"]) || isset($_POST["b_postoffice"])||isset($_POST["b_policestation"]) ||isset($_POST["b_district"]) || isset($_POST["b_pincode1"]) || isset($_POST["b_mobile"]) || isset($_POST["b_email1"])){
		$b_mouza=$_POST["b_mouza"];$b_circle=$_POST["b_circle"];$b_patta=$_POST["b_patta"];$_POST["b_dag"];$b_area=$_POST["b_area"];$b_locality=$_POST["b_locality"];
		$b_village=$_POST["b_village"];$b_postoffice=$_POST["b_postoffice"];$b_policestation=$_POST["b_policestation"];$b_district=$_POST["b_district"];$b_pincode1=$_POST["b_pincode1"];$b_mobile=	$_POST["b_mobile"];$b_email1=$_POST["b_email1"];	$reg_no=$_POST["reg_no"];$propsociety=$_POST["propsociety"];$reg_date=date("Y-m-d",strtotime($_POST["reg_date"]));
	}else{
		$previous_details=$rfs->query("select * from rfs_form2 a,rfs_form2_certificates b where a.user_id='$swr_id' and a.save_mode='C' and b.form_id=a.form_id") or die("Error : ".$rfs->error);
		if($previous_details->num_rows>0){
			$prev_results=$previous_details->fetch_assoc();
			$uain=$prev_results->uain;$reg_date=$prev_results->upload_date;
		}else{
			echo "<script>
					alert('Something went wrong!!! Please try again');
				</script>";
			exit();
		}
	}
	$post_office=$_POST["post_office"];$police_station=$_POST["police_station"];$propsociety=$_POST["propsociety"];$b_mouza=$_POST["b_mouza"];$b_circle=$_POST["b_circle"];$b_patta=$_POST["b_patta"];$_POST["b_dag"];$b_area=$_POST["b_area"];$b_locality=$_POST["b_locality"];$b_village=$_POST["b_village"];$b_postoffice=$_POST["b_postoffice"];$b_policestation=$_POST["b_policestation"];$b_district=$_POST["b_district"];$b_pincode1=$_POST["b_pincode1"];$b_mobile=	$_POST["b_mobile"];$b_email1=$_POST["b_email1"];	$reg_no=$_POST["reg_no"];$propsociety=$_POST["propsociety"];
	
	$sql=$rfs->query("select form_id from rfs_form9 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$rfs->query("insert into rfs_form8(user_id,sub_date,reg_no,reg_date,post_office,police_station,propsociety,b_mouza,b_circle,b_patta,b_dag,b_area,b_locality,b_village,b_postoffice,b_policestation,b_district,b_pincode1,b_mobile,b_email1) values ('$swr_id','$today', '$reg_no', '$reg_date', '$post_office','$propsociety','$police_station''$b_mouza','$b_circle','$b_patta','$b_dag','$b_area','$b_locality','$b_village','$b_postoffice,'$b_policestation','$b_district','$b_pincode1','$b_mobile','$b_email1'") OR die("Error: ".$rfs->error);
	}else{
		$form_id=$row["form_id"];	
		$query=$rfs->query("update rfs_form8 set sub_date='$today', reg_no='$reg_no', reg_date='$reg_date', post_office='$post_office',police_station='$police_station' ,b_mouza='$b_mouza',b_circle='$b_circle',b_patta='$b_patta',b_dag='$b_dag',b_area='$b_area',b_locality='$b_locality',b_village='$b_village',postoffice='$b_postoffice',b_policestation='$b_policestation',b_district='$b_district',b_pincode1='$b_pincode1',b_mobile='$b_mobile',b_email1=
		'$b_email1',propsociety='$propsociety' where form_id=$form_id") OR die("Error: ".$rfs->error);	
	}				
	if($query){
		$formFunctions->insert_incomplete_forms('rfs','8'); //rfs-- dept name and 1 -- form no 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = 'rfs_form8.php?tab=2';
		</script>";
		
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'rfs_form8.php?tab=1';
		</script>";
	}
}
if(isset($_POST["submit9"])){
if((isset($_POST["mfile1"]) && empty($_POST["mfile1"])) || (isset($_POST["mfile2"]) && empty($_POST["mfile2"])) || (isset($_POST["mfile3"]) && empty($_POST["mfile3"])) || (isset($_POST["mfile4"]) && empty($_POST["mfile4"])) || (isset($_POST["mfile5"]) && empty($_POST["mfile5"])||isset($_POST["mfile6"]) && empty($_POST["mfile6"]))  || (isset($_POST["mfile1"]) && $_POST["mfile1"]=='2') || (isset($_POST["mfile2"]) && $_POST["mfile2"]=='2') || (isset($_POST["mfile3"]) && $_POST["mfile3"]=='2') || (isset($_POST["mfile4"]) && $_POST["mfile4"]=='2') || (isset($_POST["mfile5"]) && $_POST["mfile5"]=='2') ||   (isset($_POST["mfile1"]) && $_POST["mfile1"]=='3') || (isset($_POST["mfile2"]) && $_POST["mfile2"]=='3') || (isset($_POST["mfile3"]) && $_POST["mfile3"]=='3') || (isset($_POST["mfile4"]) && $_POST["mfile4"]=='3') || (isset($_POST["mfile5"]) && $_POST["mfile5"]=='3') ){
			echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'rfs_form8.php?tab=2';
			</script>";

	
	
	}else{
		$file1=clean($_POST["mfile1"]);$file2=clean($_POST["mfile2"]);$file3=clean($_POST["mfile3"]);$file4=clean($_POST["mfile4"]);$file5=clean($_POST["mfile5"]);$$file6=clean($_POST["mfile6"]);
		$formFunctions->file_update($file1);$formFunctions->file_update($file2);$formFunctions->file_update($file3);$formFunctions->file_update($file4);$formFunctions->file_update($file5);$formFunctions->file_update($file6);
		$formFunctions->file_update($file7);$formFunctions->file_update($file7);
		$formFunctions->file_update($file8);$formFunctions->file_update($file8);
	
		$query=$rfs->query("select form_id from rfs_form9 where user_id='$swr_id' and active='1'") or die("Error :". $rfs->error);
		if($query->num_rows>0){
			$values=$query->fetch_object();
			$form_id=$values->form_id;
		
			if($file1=="SC" || $file2=="SC" ||  $file3=="SC" ||  $file4=="SC" ||  $file5=="SC"|| $file6=="SC"||$file7=="SC"||$file8=="SC"){
				$save_query=$rfs->query("update rfs_form9 set courier_details='1',sub_date='$today',file1='$file1',file2='$file2',file3='$file3',file4='$file4',file5='$file5',file6='$file6',file7='$file7',file8='$file8' where form_id='$form_id'") or die($rfs->error);
			}else{
				$courier_details=NULL;
				$save_query=$rfs->query("update rfs_form9 set save_mode='D',courier_details='$courier_details', sub_date='$today',received_date='$today',file1='$file1',file2='$file2',file3='$file3',file4='$file4',file5='$file5' ,file6='$file6',file7='$file7',file8='$file8'where form_id='$form_id'") or die($rfs->error);
			}				
			if($save_query){
				echo "<script>
				alert('Successfully Saved.');
				window.location.href = 'preview.php?token=9';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'rfs_form9.php?tab=2';
				</script>";
			}							
		}
	}
}

if(isset($_POST["proceed9"])){
	$sql=$rfs->query("select form_id,save_mode,courier_details from rfs_form9 where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'rfs_form9.php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'rfs','9');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$rfs->query("update rfs_form9 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($rfs->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=rfs&form=9';
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
			/*----------------SEND MAIL-----------------*/
			$user_email=$formFunctions->get_usermail($swr_id);
			$dept_email="esgoa.rfs@gmail.com";
			
			require_once "rfs_form9_print.php"; 
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
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=9&dept=rfs';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'rfs_form9.php';
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

if(isset($_POST["save10"])){
	
	if(isset($_POST["reg_no"]) || isset($_POST["reg_date"]) || isset($_POST["b_mouza"]) || isset($_POST["b_circle"]) || isset($_POST["b_patta"]) || isset($_POST["b_dag"]) ||isset($_POST["b_area"]) ||isset($_POST["b_locality"]) || isset($_POST["b_village"]) || isset($_POST["b_postoffice"])||isset($_POST["b_policestation"]) ||isset($_POST["b_district"]) || isset($_POST["b_pincode1"]) || isset($_POST["b_mobile"]) || isset($_POST["b_email1"])){
		$b_mouza=$_POST["b_mouza"];$b_circle=$_POST["b_circle"];$b_patta=$_POST["b_patta"];$_POST["b_dag"];$b_area=$_POST["b_area"];$b_locality=$_POST["b_locality"];
		$b_village=$_POST["b_village"];$b_postoffice=$_POST["b_postoffice"];$b_policestation=$_POST["b_policestation"];$b_district=$_POST["b_district"];$b_pincode1=$_POST["b_pincode1"];$b_mobile=	$_POST["b_mobile"];$b_email1=$_POST["b_email1"];	$reg_no=$_POST["reg_no"];$propsociety=$_POST["propsociety"];$reg_date=date("Y-m-d",strtotime($_POST["reg_date"]));
	}else{
		$previous_details=$rfs->query("select * from rfs_form2 a,rfs_form2_certificates b where a.user_id='$swr_id' and a.save_mode='C' and b.form_id=a.form_id") or die("Error : ".$rfs->error);
		if($previous_details->num_rows>0){
			$prev_results=$previous_details->fetch_assoc();
			$uain=$prev_results->uain;$reg_date=$prev_results->upload_date;
		}else{
			echo "<script>
					alert('Something went wrong!!! Please try again');
				</script>";
			exit();
		}
	}
	$post_office=$_POST["post_office"];$police_station=$_POST["police_station"];$propsociety=$_POST["propsociety"];$b_mouza=$_POST["b_mouza"];$b_circle=$_POST["b_circle"];$b_patta=$_POST["b_patta"];$_POST["b_dag"];$b_area=$_POST["b_area"];$b_locality=$_POST["b_locality"];$b_village=$_POST["b_village"];$b_postoffice=$_POST["b_postoffice"];$b_policestation=$_POST["b_policestation"];$b_district=$_POST["b_district"];$b_pincode1=$_POST["b_pincode1"];$b_mobile=	$_POST["b_mobile"];$b_email1=$_POST["b_email1"];	$reg_no=$_POST["reg_no"];$propsociety=$_POST["propsociety"];
	
	$sql=$rfs->query("select form_id from rfs_form10 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$rfs->query("insert into rfs_form10(user_id,sub_date,reg_no,reg_date,post_office,police_station,propsociety,b_mouza,b_circle,b_patta,b_dag,b_area,b_locality,b_village,b_postoffice,b_policestation,b_district,b_pincode1,b_mobile,b_email1,propsociety) values ('$swr_id','$today', '$reg_no', '$reg_date', '$post_office','$propsociety','$police_station''$b_mouza','$b_circle','$b_patta','$b_dag','$b_area','$b_locality','$b_village','$b_postoffice,'$b_policestation','$b_district','$b_pincode1','$b_mobile','$b_email1',$propsociety") OR die("Error: ".$rfs->error);
	}else{
		$form_id=$row["form_id"];	
		$query=$rfs->query("update rfs_form10 set sub_date='$today', reg_no='$reg_no', reg_date='$reg_date', post_office='$post_office',police_station='$police_station' ,b_mouza='$b_mouza',b_circle='$b_circle',b_patta='$b_patta',b_dag='$b_dag',b_area='$b_area',b_locality='$b_locality',b_village='$b_village',postoffice='$b_postoffice',b_policestation='$b_policestation',b_district='$b_district',b_pincode1='$b_pincode1',b_mobile='$b_mobile',b_email1=
		'$b_email1',propsociety='$propsociety' where form_id=$form_id") OR die("Error: ".$rfs->error);	
	}				
	if($query){
		$formFunctions->insert_incomplete_forms('rfs','10'); //rfs-- dept name and 1 -- form no 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = 'rfs_form10.php?tab=2';
		</script>";
		
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'rfs_form10.php?tab=1';
		</script>";
	}
}
if(isset($_POST["submit10"])){
if((isset($_POST["mfile1"]) && empty($_POST["mfile1"])) || (isset($_POST["mfile2"]) && empty($_POST["mfile2"])) || (isset($_POST["mfile3"]) && empty($_POST["mfile3"])) || (isset($_POST["mfile4"]) && empty($_POST["mfile4"])) || (isset($_POST["mfile5"]) && empty($_POST["mfile5"])||isset($_POST["mfile6"]) && empty($_POST["mfile6"]))  || (isset($_POST["mfile1"]) && $_POST["mfile1"]=='2') || (isset($_POST["mfile2"]) && $_POST["mfile2"]=='2') || (isset($_POST["mfile3"]) && $_POST["mfile3"]=='2') || (isset($_POST["mfile4"]) && $_POST["mfile4"]=='2') || (isset($_POST["mfile5"]) && $_POST["mfile5"]=='2') ||   (isset($_POST["mfile1"]) && $_POST["mfile1"]=='3') || (isset($_POST["mfile2"]) && $_POST["mfile2"]=='3') || (isset($_POST["mfile3"]) && $_POST["mfile3"]=='3') || (isset($_POST["mfile4"]) && $_POST["mfile4"]=='3') || (isset($_POST["mfile5"]) && $_POST["mfile5"]=='3') ){
			echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'rfs_form10.php?tab=2';
			</script>";

	
	
	}else{
		$file1=clean($_POST["mfile1"]);$file2=clean($_POST["mfile2"]);$file3=clean($_POST["mfile3"]);$file4=clean($_POST["mfile4"]);$file5=clean($_POST["mfile5"]);$$file6=clean($_POST["mfile6"]);
		$formFunctions->file_update($file1);$formFunctions->file_update($file2);$formFunctions->file_update($file3);$formFunctions->file_update($file4);$formFunctions->file_update($file5);$formFunctions->file_update($file6);
		$formFunctions->file_update($file7);$formFunctions->file_update($file7);
		$formFunctions->file_update($file8);$formFunctions->file_update($file8);
	
		$query=$rfs->query("select form_id from rfs_form10 where user_id='$swr_id' and active='1'") or die("Error :". $rfs->error);
		if($query->num_rows>0){
			$values=$query->fetch_object();
			$form_id=$values->form_id;
		
			if($file1=="SC" || $file2=="SC" ||  $file3=="SC" ||  $file4=="SC" ||  $file5=="SC"|| $file6=="SC"||$file7=="SC"||$file8=="SC"){
				$save_query=$rfs->query("update rfs_form10 set courier_details='1',sub_date='$today',file1='$file1',file2='$file2',file3='$file3',file4='$file4',file5='$file5',file6='$file6',file7='$file7',file8='$file8' where form_id='$form_id'") or die($rfs->error);
			}else{
				$courier_details=NULL;
				$save_query=$rfs->query("update rfs_form10 set save_mode='D',courier_details='$courier_details', sub_date='$today',received_date='$today',file1='$file1',file2='$file2',file3='$file3',file4='$file4',file5='$file5' ,file6='$file6',file7='$file7',file8='$file8'where form_id='$form_id'") or die($rfs->error);
			}				
			if($save_query){
				echo "<script>
				alert('Successfully Saved.');
				window.location.href = 'preview.php?token=10';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'rfs_form10.php?tab=2';
				</script>";
			}							
		}
	}
}

if(isset($_POST["proceed10"])){
	$sql=$rfs->query("select form_id,save_mode,courier_details from rfs_form9 where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'rfs_form10.php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'rfs','10');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$rfs->query("update rfs_form10 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($rfs->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=rfs&form=10';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');	
					window.location.href = 'preview.php?token=10';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$formFunctions->updateSubmit($uain,$form_id);	
			$formFunctions->insert_applications($uain);
			$str=$formFunctions->getEmail_str($uain);
			/*----------------SEND MAIL-----------------*/
			$user_email=$formFunctions->get_usermail($swr_id);
			$dept_email="esgoa.rfs@gmail.com";
			
			require_once "rfs_form10_print.php"; 
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
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=10&dept=rfs';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'rfs_form10.php';
				</script>";
			}
		}else{
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=10';
				</script>";
		}
	}
}	

if(isset($_POST["save12"])){		
	if(isset($_POST["reg_no"]) || isset($_POST["reg_date"])|| isset($_POST["propsociety"])){
		$reg_no=$_POST["reg_no"];$propsociety=$_POST["propsociety"];$reg_date=date("Y-m-d",strtotime($_POST["reg_date"]));
	}else{
		$previous_details=$rfs->query("select * from rfs_form2 a,rfs_form2_certificates b where a.user_id='$swr_id' and a.save_mode='C' and b.form_id=a.form_id") or die("Error : ".$rfs->error);
		if($previous_details->num_rows>0){
			$prev_results=$previous_details->fetch_assoc();
			$uain=$prev_results->uain;$reg_date=$prev_results->upload_date;
		}else{
			echo "<script>
					alert('Something went wrong!!! Please try again');
				</script>";
			exit();
		}
	}
	$post_office=$_POST["post_office"];$police_station=$_POST["police_station"];$propsociety=$_POST["propsociety"];
	
	$sql=$rfs->query("select form_id from rfs_form12 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$rfs->query("insert into rfs_form12(user_id,sub_date,reg_no,reg_date,post_office,police_station,propsociety) values ('$swr_id','$today', '$reg_no', '$reg_date', '$post_office','$propsociety','$police_station')") OR die("Error: ".$rfs->error);
	}else{
		$form_id=$row["form_id"];	
		$query=$rfs->query("update rfs_form12 set sub_date='$today', reg_no='$reg_no', reg_date='$reg_date', post_office='$post_office',police_station='$police_station' ,propsociety='$propsociety' where form_id=$form_id") OR die("Error: ".$rfs->error);	
	}				
	if($query){
		$formFunctions->insert_incomplete_forms('rfs','12'); //rfs-- dept name and 1 -- form no 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = 'form12.php?tab=2';
		</script>";
		
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'form12.php?tab=1';
		</script>";
	}
}
if(isset($_POST["submit12"])){
	if((isset($_POST["mfile1"]) && empty($_POST["mfile1"])) || (isset($_POST["mfile2"]) && empty($_POST["mfile2"])) || (isset($_POST["mfile3"]) && empty($_POST["mfile3"])) || (isset($_POST["mfile4"]) && empty($_POST["mfile4"])) || (isset($_POST["mfile5"]) && empty($_POST["mfile5"]))  || (isset($_POST["mfile1"]) && $_POST["mfile1"]=='2') || (isset($_POST["mfile2"]) && $_POST["mfile2"]=='2') || (isset($_POST["mfile3"]) && $_POST["mfile3"]=='2') || (isset($_POST["mfile4"]) && $_POST["mfile4"]=='2') || (isset($_POST["mfile5"]) && $_POST["mfile5"]=='2') ||   (isset($_POST["mfile1"]) && $_POST["mfile1"]=='3') || (isset($_POST["mfile2"]) && $_POST["mfile2"]=='3') || (isset($_POST["mfile3"]) && $_POST["mfile3"]=='3') || (isset($_POST["mfile4"]) && $_POST["mfile4"]=='3') || (isset($_POST["mfile5"]) && $_POST["mfile5"]=='3') ){
			echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'form12.php?tab=2';
			</script>";

	
	
	}else{
		$file1=clean($_POST["mfile1"]);$file2=clean($_POST["mfile2"]);$file3=clean($_POST["mfile3"]);$file4=clean($_POST["mfile4"]);$file5=clean($_POST["mfile5"]);
		$formFunctions->file_update($file1);$formFunctions->file_update($file2);$formFunctions->file_update($file3);$formFunctions->file_update($file4);$formFunctions->file_update($file5);
		$query=$rfs->query("select form_id from rfs_form12 where user_id='$swr_id' and active='1'") or die("Error :". $rfs->error);
		if($query->num_rows>0){
			$values=$query->fetch_object();
			$form_id=$values->form_id;
		
			if($file1=="SC" || $file2=="SC" ||  $file3=="SC" ||  $file4=="SC" ||  $file5=="SC" ){
				$save_query=$rfs->query("update rfs_form12 set courier_details='1',sub_date='$today',file1='$file1',file2='$file2',file3='$file3',file4='$file4',file5='$file5' where form_id='$form_id'") or die($rfs->error);
			}else{
				$courier_details=NULL;
				$save_query=$rfs->query("update rfs_form12 set save_mode='D',courier_details='$courier_details', sub_date='$today',received_date='$today',file1='$file1',file2='$file2',file3='$file3',file4='$file4',file5='$file5' where form_id='$form_id'") or die($rfs->error);
			}				
			if($save_query){
				echo "<script>
				alert('Successfully Saved.');
				window.location.href = 'preview.php?token=12';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'form12.php?tab=2';
				</script>";
			}							
		}
	}
}

if(isset($_POST["proceed12"])){
	$sql=$rfs->query("select form_id,save_mode,courier_details from rfs_form12 where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'form12.php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'rfs','12');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$rfs->query("update rfs_form12 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($rfs->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=rfs&form=12';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');	
					window.location.href = 'preview.php?token=12';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$formFunctions->updateSubmit($uain,$form_id);	
			$formFunctions->insert_applications($uain);
			$str=$formFunctions->getEmail_str($uain);
			/*----------------SEND MAIL-----------------*/
			$user_email=$formFunctions->get_usermail($swr_id);
			$dept_email="esgoa.rfs@gmail.com";
			
			require_once "rfs_form12_print.php"; 
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
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=12&dept=rfs';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'form12.php';
				</script>";
			}
		}else{
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=12';
				</script>";
		}
	}
}	



	
if(isset($_POST["submit13"])){
	if((isset($_POST["mfile1"]) && empty($_POST["mfile1"])) || (isset($_POST["mfile2"]) && empty($_POST["mfile2"])) || (isset($_POST["mfile3"]) && empty($_POST["mfile3"])) || (isset($_POST["mfile4"]) && empty($_POST["mfile4"])) || (isset($_POST["mfile5"]) && empty($_POST["mfile5"]))  || (isset($_POST["mfile1"]) && $_POST["mfile1"]=='2') || (isset($_POST["mfile2"]) && $_POST["mfile2"]=='2') || (isset($_POST["mfile3"]) && $_POST["mfile3"]=='2') || (isset($_POST["mfile4"]) && $_POST["mfile4"]=='2') || (isset($_POST["mfile5"]) && $_POST["mfile5"]=='2') ||   (isset($_POST["mfile1"]) && $_POST["mfile1"]=='3') || (isset($_POST["mfile2"]) && $_POST["mfile2"]=='3') || (isset($_POST["mfile3"]) && $_POST["mfile3"]=='3') || (isset($_POST["mfile4"]) && $_POST["mfile4"]=='3') || (isset($_POST["mfile5"]) && $_POST["mfile5"]=='3') ){
			echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'form14.php?tab=2';
			</script>";

	
	
	}else{
		$file1=clean($_POST["mfile1"]);$file2=clean($_POST["mfile2"]);$file3=clean($_POST["mfile3"]);$file4=clean($_POST["mfile4"]);$file5=clean($_POST["mfile5"]);
		$formFunctions->file_update($file1);$formFunctions->file_update($file2);$formFunctions->file_update($file3);$formFunctions->file_update($file4);$formFunctions->file_update($file5);
		$query=$rfs->query("select form_id from rfs_form13 where user_id='$swr_id' and active='1'") or die("Error :". $rfs->error);
		if($query->num_rows>0){
			$values=$query->fetch_object();
			$form_id=$values->form_id;
		
			if($file1=="SC" || $file2=="SC" ||  $file3=="SC" ||  $file4=="SC" ||  $file5=="SC" ){
				$save_query=$rfs->query("update rfs_form13 set courier_details='1',sub_date='$today',file1='$file1',file2='$file2',file3='$file3',file4='$file4',file5='$file5' where form_id='$form_id'") or die($rfs->error);
			}else{
				$courier_details=NULL;
				$save_query=$rfs->query("update rfs_form13 set save_mode='D',courier_details='$courier_details', sub_date='$today',received_date='$today',file1='$file1',file2='$file2',file3='$file3',file4='$file4',file5='$file5' where form_id='$form_id'") or die($rfs->error);
			}				
			if($save_query){
				echo "<script>
				alert('Successfully Saved.');
				window.location.href = 'preview.php?token=13';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'form13.php?tab=2';
				</script>";
			}							
		}
	}
}

if(isset($_POST["proceed13"])){
	$sql=$rfs->query("select form_id,save_mode,courier_details from rfs_form13 where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'form13.php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'rfs','13');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$rfs->query("update rfs_form13 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($rfs->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=rfs&form=13';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=13';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$formFunctions->updateSubmit($uain,$form_id);	
			$formFunctions->insert_applications($uain);
			$str=$formFunctions->getEmail_str($uain);
			/*----------------SEND MAIL-----------------*/
			$user_email=$formFunctions->get_usermail($swr_id);
			$dept_email="esgoa.rfs@gmail.com";
			
			require_once "rfs_form13_print.php"; 
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
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=13&dept=rfs';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'form13.php';
				</script>";
			}
		}else{
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=13';
				</script>";
		}
	}
}	



if(isset($_POST["save13"])){		
	if(isset($_POST["reg_no"]) || isset($_POST["reg_date"])|| isset($_POST["propsociety"])){
		$reg_no=$_POST["reg_no"];$propsociety=$_POST["propsociety"];$reg_date=date("Y-m-d",strtotime($_POST["reg_date"]));
	}else{
		$previous_details=$rfs->query("select * from rfs_form2 a,rfs_form2_certificates b where a.user_id='$swr_id' and a.save_mode='C' and b.form_id=a.form_id") or die("Error : ".$rfs->error);
		if($previous_details->num_rows>0){
			$prev_results=$previous_details->fetch_assoc();
			$uain=$prev_results->uain;$reg_date=$prev_results->upload_date;
		}else{
			echo "<script>
					alert('Something went wrong!!! Please try again');
				</script>";
			exit();
		}
	}
	$post_office=$_POST["post_office"];$police_station=$_POST["police_station"];$propsociety=$_POST["propsociety"];
	
	$sql=$rfs->query("select form_id from rfs_form13 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$rfs->query("insert into rfs_form13(user_id,sub_date,reg_no,reg_date,post_office,police_station,propsociety) values ('$swr_id','$today', '$reg_no', '$reg_date', '$post_office','$propsociety','$police_station')") OR die("Error: ".$rfs->error);
	}else{
		$form_id=$row["form_id"];	
		$query=$rfs->query("update rfs_form13 set sub_date='$today', reg_no='$reg_no', reg_date='$reg_date', post_office='$post_office',police_station='$police_station' ,propsociety='$propsociety' where form_id=$form_id") OR die("Error: ".$rfs->error);	
	}				
	if($query){
		$formFunctions->insert_incomplete_forms('rfs','13'); //rfs-- dept name and 1 -- form no 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = 'form13.php?tab=2';
		</script>";
		
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'form13.php?tab=1';
		</script>";
	}
}
if(isset($_POST["submit13"])){
	if((isset($_POST["mfile1"]) && empty($_POST["mfile1"])) || (isset($_POST["mfile2"]) && empty($_POST["mfile2"])) || (isset($_POST["mfile3"]) && empty($_POST["mfile3"])) || (isset($_POST["mfile4"]) && empty($_POST["mfile4"])) || (isset($_POST["mfile5"]) && empty($_POST["mfile5"]))  || (isset($_POST["mfile1"]) && $_POST["mfile1"]=='2') || (isset($_POST["mfile2"]) && $_POST["mfile2"]=='2') || (isset($_POST["mfile3"]) && $_POST["mfile3"]=='2') || (isset($_POST["mfile4"]) && $_POST["mfile4"]=='2') || (isset($_POST["mfile5"]) && $_POST["mfile5"]=='2') ||   (isset($_POST["mfile1"]) && $_POST["mfile1"]=='3') || (isset($_POST["mfile2"]) && $_POST["mfile2"]=='3') || (isset($_POST["mfile3"]) && $_POST["mfile3"]=='3') || (isset($_POST["mfile4"]) && $_POST["mfile4"]=='3') || (isset($_POST["mfile5"]) && $_POST["mfile5"]=='3') ){
			echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'form14.php?tab=2';
			</script>";

	
	
	}else{
		$file1=clean($_POST["mfile1"]);$file2=clean($_POST["mfile2"]);$file3=clean($_POST["mfile3"]);$file4=clean($_POST["mfile4"]);$file5=clean($_POST["mfile5"]);
		$formFunctions->file_update($file1);$formFunctions->file_update($file2);$formFunctions->file_update($file3);$formFunctions->file_update($file4);$formFunctions->file_update($file5);
		$query=$rfs->query("select form_id from rfs_form13 where user_id='$swr_id' and active='1'") or die("Error :". $rfs->error);
		if($query->num_rows>0){
			$values=$query->fetch_object();
			$form_id=$values->form_id;
		
			if($file1=="SC" || $file2=="SC" ||  $file3=="SC" ||  $file4=="SC" ||  $file5=="SC" ){
				$save_query=$rfs->query("update rfs_form13 set courier_details='1',sub_date='$today',file1='$file1',file2='$file2',file3='$file3',file4='$file4',file5='$file5' where form_id='$form_id'") or die($rfs->error);
			}else{
				$courier_details=NULL;
				$save_query=$rfs->query("update rfs_form13 set save_mode='D',courier_details='$courier_details', sub_date='$today',received_date='$today',file1='$file1',file2='$file2',file3='$file3',file4='$file4',file5='$file5' where form_id='$form_id'") or die($rfs->error);
			}				
			if($save_query){
				echo "<script>
				alert('Successfully Saved.');
				window.location.href = 'preview.php?token=13';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'form13.php?tab=2';
				</script>";
			}							
		}
	}
}

if(isset($_POST["proceed13"])){
	$sql=$rfs->query("select form_id,save_mode,courier_details from rfs_form13 where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'form13.php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'rfs','13');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$rfs->query("update rfs_form13 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($rfs->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=rfs&form=13';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=13';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$formFunctions->updateSubmit($uain,$form_id);	
			$formFunctions->insert_applications($uain);
			$str=$formFunctions->getEmail_str($uain);
			/*----------------SEND MAIL-----------------*/
			$user_email=$formFunctions->get_usermail($swr_id);
			$dept_email="esgoa.rfs@gmail.com";
			
			require_once "rfs_form13_print.php"; 
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
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=13&dept=rfs';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'form13.php';
				</script>";
			}
		}else{
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=13';
				</script>";
		}
	}
}	
if(isset($_POST["save14"])){		
	if(isset($_POST["reg_no"]) || isset($_POST["reg_date"])){
		$reg_no=$_POST["reg_no"];$reg_date=date("Y-m-d",strtotime($_POST["reg_date"]));
	}else{
		$previous_details=$rfs->query("select * from rfs_form2 a,rfs_form2_certificates b where a.user_id='$swr_id' and a.save_mode='C' and b.form_id=a.form_id") or die("Error : ".$rfs->error);
		if($previous_details->num_rows>0){
			$prev_results=$previous_details->fetch_assoc();
			$uain=$prev_results->uain;$reg_date=$prev_results->upload_date;
		}else{
			echo "<script>
					alert('Something went wrong!!! Please try again');
				</script>";
			exit();
		}
	}
	$post_office=$_POST["post_office"];$police_station=$_POST["police_station"];
	
	$sql=$rfs->query("select form_id from rfs_form14 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$rfs->query("insert into rfs_form14(user_id,sub_date,reg_no,reg_date,post_office,police_station) values ('$swr_id','$today', '$reg_no', '$reg_date', '$post_office','$police_station')") OR die("Error: ".$rfs->error);
	}else{
		$form_id=$row["form_id"];	
		$query=$rfs->query("update rfs_form14 set sub_date='$today', reg_no='$reg_no', reg_date='$reg_date', post_office='$post_office',police_station='$police_station' where form_id=$form_id") OR die("Error: ".$rfs->error);	
	}				
	if($query){
		$formFunctions->insert_incomplete_forms('rfs','14'); //rfs-- dept name and 1 -- form no 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = 'form14.php?tab=2';
		</script>";
		
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'form14.php?tab=1';
		</script>";
	}
}
if(isset($_POST["submit14"])){
	if((isset($_POST["mfile1"]) && empty($_POST["mfile1"])) || (isset($_POST["mfile2"]) && empty($_POST["mfile2"])) || (isset($_POST["mfile3"]) && empty($_POST["mfile3"])) || (isset($_POST["mfile4"]) && empty($_POST["mfile4"])) || (isset($_POST["mfile5"]) && empty($_POST["mfile5"])) ||  (isset($_POST["mfile6"]) && empty($_POST["mfile6"])) || (isset($_POST["mfile1"]) && $_POST["mfile1"]=='2') || (isset($_POST["mfile2"]) && $_POST["mfile2"]=='2') || (isset($_POST["mfile3"]) && $_POST["mfile3"]=='2') || (isset($_POST["mfile4"]) && $_POST["mfile4"]=='2') || (isset($_POST["mfile5"]) && $_POST["mfile5"]=='2') || (isset($_POST["mfile6"]) && $_POST["mfile6"]=='2') || (isset($_POST["mfile1"]) && $_POST["mfile1"]=='3') || (isset($_POST["mfile2"]) && $_POST["mfile2"]=='3') || (isset($_POST["mfile3"]) && $_POST["mfile3"]=='3') || (isset($_POST["mfile4"]) && $_POST["mfile4"]=='3') || (isset($_POST["mfile5"]) && $_POST["mfile5"]=='3') || (isset($_POST["mfile6"]) && $_POST["mfile6"]=='3')){
			echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'form14.php?tab=2';
			</script>";
	}else{
		$file1=clean($_POST["mfile1"]);$file2=clean($_POST["mfile2"]);$file3=clean($_POST["mfile3"]);$file4=clean($_POST["mfile4"]);$file5=clean($_POST["mfile5"]);$file6=clean($_POST["mfile6"]);
		$formFunctions->file_update($file1);$formFunctions->file_update($file2);$formFunctions->file_update($file3);$formFunctions->file_update($file4);$formFunctions->file_update($file5);$formFunctions->file_update($file6);		
		
		$query=$rfs->query("select form_id from rfs_form14 where user_id='$swr_id' and active='1'") or die("Error :". $rfs->error);
		if($query->num_rows>0){
			$values=$query->fetch_object();
			$form_id=$values->form_id;
		
			if($file1=="SC" || $file2=="SC" ||  $file3=="SC" ||  $file4=="SC" ||  $file5=="SC" ||  $file6=="SC"){
				$save_query=$rfs->query("update rfs_form14 set courier_details='1',sub_date='$today',file1='$file1',file2='$file2',file3='$file3',file4='$file4',file5='$file5',file6='$file6' where form_id='$form_id'") or die($rfs->error);
			}else{
				$courier_details=NULL;
				$save_query=$rfs->query("update rfs_form14 set save_mode='D',courier_details='$courier_details', sub_date='$today',received_date='$today',file1='$file1',file2='$file2',file3='$file3',file4='$file4',file5='$file5',file6='$file6' where form_id='$form_id'") or die($rfs->error);
			}				
			if($save_query){
				echo "<script>
				alert('Successfully Saved.');
				window.location.href = 'preview.php?token=14';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'form14.php?tab=2';
				</script>";
			}							
		}
	}
}
if(isset($_POST["proceed14"])){
	$sql=$rfs->query("select form_id,save_mode,courier_details from rfs_form14 where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'form14.php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'rfs','14');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$rfs->query("update rfs_form14 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($rfs->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=rfs&form=14';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=14';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$formFunctions->updateSubmit($uain,$form_id);	
			$formFunctions->insert_applications($uain);
			$str=$formFunctions->getEmail_str($uain);
			/*----------------SEND MAIL-----------------*/
			$user_email=$formFunctions->get_usermail($swr_id);
			$dept_email="esgoa.rfs@gmail.com";
			
			require_once "rfs_form14_print.php"; 
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
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=14&dept=rfs';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'form14.php';
				</script>";
			}
		}else{
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=14';
				</script>";
		}
	}	
}
?>