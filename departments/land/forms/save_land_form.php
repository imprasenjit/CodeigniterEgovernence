<?php
if(isset($_POST["save1"])){		
			$adhar_no=clean($_POST["adhar_no"]);$post_office=clean($_POST["post_office"]);$desc_doc=clean($_POST["desc_doc"]);$reg_off=clean($_POST["reg_off"]);$rel_petition=clean($_POST["rel_petition"]);$deed_no=clean($_POST["deed_no"]);$deed_year=clean($_POST["deed_year"]);$req_nature=clean($_POST["req_nature"]);$remarks=clean($_POST["remarks"]);
			$parties=Array();
			$parties=implode(",",$_POST["parties"]);
			
			$sql=$formFunctions->executeQuery($dept,"select form_id from land_form1 where user_id='$swr_id' and active='1'");
			$row=$sql->fetch_array();
		if($sql->num_rows<1){   ////////////table is empty//////////////
		  $query=$formFunctions->executeQueryInsertID($dept,"insert into land_form1(user_id,sub_date,adhar_no,post_office,parties,desc_doc,reg_off,rel_petition,deed_no,deed_year,req_nature,remarks) values ('$swr_id','$today','$adhar_no','$post_office','$parties','$desc_doc','$reg_off','$rel_petition','$deed_no','$deed_year','$req_nature','$remarks')");
		}else{  ////////////table is not empty//////////////
			$form_id=$row["form_id"];	
			$query=$formFunctions->executeQuery($dept,"update land_form1 set sub_date='$today', adhar_no='$adhar_no',post_office='$post_office',parties='$parties', desc_doc='$desc_doc',reg_off='$reg_off',rel_petition='$rel_petition',deed_no='$deed_no',deed_year='$deed_year' ,req_nature='$req_nature',remarks='$remarks' where form_id=$form_id") ;	
			}					
			if($query)
				{
					$formFunctions->insert_incomplete_forms('land','1'); //land commer-- dept name and 1 -- form no
					echo "<script>
						alert('Successfully Saved..');
						window.location.href = 'land_form1.php?tab=2';
					</script>";
				}
				else
				{
					echo "<script>
						alert('Invalid Entry');
						window.location.href = 'land_form1.php?tab=1';
					</script>";
				}	
}
if(isset($_POST["submit1"])){
	if(empty($_POST["mfile1"]) || empty($_POST["mfile2"]) || empty($_POST["mfile3"]) || empty($_POST["mfile4"]) || $_POST["mfile1"]=='2' || $_POST["mfile2"]=='2' || $_POST["mfile3"]=='2' || $_POST["mfile4"]=='2' ||  $_POST["mfile1"]=='3' || $_POST["mfile2"]=='3' || $_POST["mfile3"]=='3' || $_POST["mfile4"]=='3')
	{
	echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'land_form1.php?tab=2';
			</script>";
	}
	
	$file1=clean($_POST["mfile1"]);
	$file2=clean($_POST["mfile2"]);
	$file3=clean($_POST["mfile3"]);
	$file4=clean($_POST["mfile4"]);

	$sql=$formFunctions->executeQuery($dept,"select form_id from land_form1 where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'land_form1.php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];
		$savequery=$formFunctions->executeQuery($dept,"update land_form1 set file1='$file1',file2='$file2',file3='$file3',file4='$file4' where form_id='$form_id'");
	}	
	if($savequery){
		$formFunctions->file_update($file1);$formFunctions->file_update($file2);$formFunctions->file_update($file3);$formFunctions->file_update($file4);

		if($file1=="SC" || $file2=="SC" || $file3=="SC" || $file3=="SC" ){
			$save_query=$formFunctions->executeQuery($dept,"update land_form1 set courier_details='1', sub_date='$today' where form_id='$form_id'");
		}else{
				$courier_details=NULL;
				$save_query=$formFunctions->executeQuery($dept,"update land_form1 set sub_date='$today',courier_details='$courier_details' where form_id='$form_id'");
			}
			if($save_query){
					echo "<script>
						alert('Successfully Saved....');
						window.location.href = 'preview.php?token=1';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href ='land_form1.php?tab=2';
					</script>";
				}			
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href ='land_form1.php?tab=2';
		</script>";
	}
}
if(isset($_POST["proceed1"])){
	$query=$formFunctions->executeQuery($dept,"select form_id,save_mode,courier_details from land_form1 where user_id='$swr_id' and active='1'") ;
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'land_form1.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'land','1');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$formFunctions->executeQuery($dept,"update land_form1 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'");
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=land&form=1';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=1';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$formFunctions->executeQuery($dept,"update land_form1 set sub_date='$today',uain='$uain',save_mode='P' where form_id='$form_id'");
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
	
	$query=$formFunctions->executeQuery($dept,"select uain,form_id from land_form1 where user_id='$swr_id' and save_mode='P'");
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
			$save_query=$formFunctions->executeQuery($dept,"update land_form1 set offline_challan='$offline_challan',payment_mode='$payment_mode',save_mode='C',sub_date='$today' where form_id='$form_id'");
			if($save_query){
				$formFunctions->file_update($offline_challan);
				$formFunctions->insert_applications($uain);
				$str=$formFunctions->getEmail_str($uain);
				/////////////////////////////SEND MAIL////////////////////////////////
				$user_email=$formFunctions->get_usermail($swr_id);
				$dept_email="esgoa.land@gmail.com";
				require_once "land_form1_print.php"; 
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
						window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=1&dept=land';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'land_form1.php';
					</script>";
				}
			}else{
				echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'land_form1.php';
					</script>";
			}			
		}
	}
}		
if(isset($_POST["save2"])){		
			$father_name=clean($_POST["father_name"]);$police_station=clean($_POST["police_station"]);$post_office=clean($_POST["post_office"]);$pattadar_name=clean($_POST["pattadar_name"]);$pattadar_fname=clean($_POST["pattadar_fname"]);$is_ownership=clean($_POST["is_ownership"]);$area_land=clean($_POST["area_land"]);$p_date=clean($_POST["p_date"]);$total_land=clean($_POST["total_land"]);$add_info=clean($_POST["add_info"]);$remarks=clean($_POST["remarks"]);

			$sql=$formFunctions->executeQuery($dept,"select form_id from land_form2 where user_id='$swr_id' and active='1'");
			$row=$sql->fetch_array();
		    if($sql->num_rows<1){   ////////////table is empty//////////////
		    $query=$formFunctions->executeQueryInsertID($dept,"insert into land_form2(user_id,sub_date,father_name,police_station,post_office,pattadar_name,pattadar_fname,is_ownership,area_land,p_date,total_land,add_info,remarks) values ('$swr_id','$today','$father_name','$police_station','$post_office','$pattadar_name','$pattadar_fname','$is_ownership','$area_land','$p_date','$total_land','$add_info','$remarks')");
		    }else{  ////////////table is not empty//////////////
			$form_id=$row["form_id"];	
			$query=$formFunctions->executeQuery($dept,"update land_form2 set sub_date='$today', father_name='$father_name',police_station='$police_station',post_office='$post_office',pattadar_name='$pattadar_name', pattadar_fname='$pattadar_fname',is_ownership='$is_ownership',area_land='$area_land',p_date='$p_date',total_land='$total_land' ,add_info='$add_info',remarks='$remarks' where form_id=$form_id");	
			}					
			if($query)
				{
					$formFunctions->insert_incomplete_forms('land','2'); //land commer-- dept name and 1 -- form no
					echo "<script>
						alert('Successfully Saved..');
						window.location.href = 'land_form2.php?tab=2';
					</script>";
				}
				else
				{
					echo "<script>
						alert('Invalid Entry');
						window.location.href = 'land_form2.php?tab=1';
					</script>";
				}	
}
if(isset($_POST["submit2"])){
	if(empty($_POST["mfile1"]) || empty($_POST["mfile2"]) || empty($_POST["mfile3"]) || empty($_POST["mfile4"]) || $_POST["mfile1"]=='2' || $_POST["mfile2"]=='2' || $_POST["mfile3"]=='2' || $_POST["mfile4"]=='2' ||  $_POST["mfile1"]=='3' || $_POST["mfile2"]=='3' || $_POST["mfile3"]=='3' || $_POST["mfile4"]=='3')
	{
	echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'land_form2.php?tab=2';
			</script>";
	}
	
	$file1=clean($_POST["mfile1"]);
	$file2=clean($_POST["mfile2"]);
	$file3=clean($_POST["mfile3"]);
	$file4=clean($_POST["mfile4"]);
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from land_form2 where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'land_form2.php';
		</script>";	
	  }else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];
		$savequery=$formFunctions->executeQuery($dept,"update land_form2 set file1='$file1',file2='$file2',file3='$file3',file4='$file4' where form_id='$form_id'");
	  }
     	if($savequery){
		$formFunctions->file_update($file1);$formFunctions->file_update($file2);$formFunctions->file_update($file3);$formFunctions->file_update($file4);

		if($file1=="SC" || $file2=="SC" || $file3=="SC" || $file4=="SC" ){
			$save_query=$formFunctions->executeQuery($dept,"update land_form2 set courier_details='1', sub_date='$today' where form_id='$form_id'");
		}else{
				$courier_details=NULL;
				$save_query=$formFunctions->executeQuery($dept,"update land_form2 set sub_date='$today',courier_details='$courier_details' where form_id='$form_id'");
			}
			if($save_query){
					echo "<script>
						alert('Successfully Saved....');
						window.location.href = 'preview.php?token=2';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href ='land_form2.php?tab=2';
					</script>";
				}			
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href ='land_form2.php?tab=2';
		</script>";
	}
}
if(isset($_POST["proceed2"]))
{  
     
    $query=$formFunctions->executeQuery($dept,"select form_id,save_mode,courier_details from land_form2 where user_id='$swr_id' and active='1'");
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'land_form2.php';
			  </script>";	
	
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'land','2');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$formFunctions->executeQuery($dept,"update land_form2 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'");
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=land&form=2';
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
			$dept_email="esgoa.land@gmail.com";
			require_once "land_form1_print.php"; 
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
					window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=2&dept=land';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'land_form2.php?tab=2';
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
	
	   $father_name=$_POST["father_name"];$adhar_crd=$_POST["adhar_crd"];$registered_office=$_POST["registered_office"];$remarks=$_POST["remarks"];$nature_deed=$_POST["nature_deed"];$petitioner_deed=$_POST["petitioner_deed"];$year_inspection=$_POST["year_inspection"];$area_land=$_POST["area_land"];	

	   $sql=$formFunctions->executeQuery($dept,"select form_id from land_form3 where user_id='$swr_id' and active='1'");
	   $row=$sql->fetch_array();
			
	   if($sql->num_rows<1){  ////////////table is empty//////////////			
			$query=$formFunctions->executeQueryInsertID($dept,"insert into land_form3(user_id,father_name,adhar_crd,registered_office,remarks,nature_deed,petitioner_deed,year_inspection,area_land) values ('$swr_id','$father_name','$adhar_crd','$registered_office','$remarks','$nature_deed','$petitioner_deed','$year_inspection','$area_land')");			
	    }else{  ////////////table is not empty//////////////
			$form_id=$row["form_id"];	
			$query=$formFunctions->executeQuery($dept,"update land_form3 set father_name='$father_name',adhar_crd='$adhar_crd',registered_office='$registered_office',remarks='$remarks',nature_deed='$nature_deed',year_inspection='$year_inspection',area_land='$area_land' where form_id='$form_id'");	
	    }		
	   if($query){
			$formFunctions->insert_incomplete_forms('land','3');
			echo "<script>
				alert('Successfully Saved.');
				window.location.href = 'land_form3.php?tab=2';
			</script>";			
	   }else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'land_form3.php?tab=1';
			</script>";
	  }						
}
  if(isset($_POST["submit3"])){
	
	if(empty($_POST["mfile1"]) || empty($_POST["mfile2"]) || $_POST["mfile1"]=='2' || $_POST["mfile2"]=='2'  ||  $_POST["mfile1"]=='3' || $_POST["mfile2"]=='3')
	{
	echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'land_form3.php?tab=2';
			</script>";
	}
	
	$file1=clean($_POST["mfile1"]);
	$file2=clean($_POST["mfile2"]);
	
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from land_form3 where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'land_form3.php';
		</script>";	
	  }else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];
		$savequery=$formFunctions->executeQuery($dept,"update land_form3 set file1='$file1',file2='$file2' where form_id='$form_id'");
	  }
     	if($savequery){
		$formFunctions->file_update($file1);$formFunctions->file_update($file2);

		if($file1=="SC" || $file2=="SC" ){
			$save_query=$formFunctions->executeQuery($dept,"update land_form3 set courier_details='1', sub_date='$today' where form_id='$form_id'");
		}else{
				$courier_details=NULL;
				$save_query=$formFunctions->executeQuery($dept,"update land_form3 set sub_date='$today',courier_details='$courier_details' where form_id='$form_id'");
			}
			if($save_query){
					echo "<script>
						alert('Successfully Saved....');
						window.location.href = 'preview.php?token=3';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href ='land_form3.php?tab=2';
					</script>";
				}			
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href ='land_form3.php?tab=2';
		</script>";
	}
}
if(isset($_POST["proceed3"])){
	$query=$formFunctions->executeQuery($dept,"select form_id,save_mode,courier_details from land_form3 where user_id='$swr_id' and active='1'");
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'land_form3.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'land','3');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$formFunctions->executeQuery($dept,"update land_form3 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'");
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=land&form=3';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=3';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$formFunctions->executeQuery($dept,"update land_form3 set sub_date='$today',uain='$uain',save_mode='P' where form_id='$form_id'");
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'payment_section.php?token=3';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=3';
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
if(isset($_POST["payment3"])){
	
	$query=$formFunctions->executeQuery($dept,"select uain,form_id from land_form3 where user_id='$swr_id' and save_mode='P'");
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'payment_section.php?token=3';
			</script>";
	}else{
		if(empty($_POST["offline_challan"]) || $_POST["offline_challan"]=='2' || $_POST["offline_challan"]=='3'){
			echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'payment_section.php?token=3';
			</script>";
		}else{
			$row=$query->fetch_array();
			$form_id=$row["form_id"];$uain=$row["uain"];	
			$offline_challan=$_POST["offline_challan"];$payment_mode=0;
			$save_query=$formFunctions->executeQuery($dept,"update land_form3 set offline_challan='$offline_challan',payment_mode='$payment_mode',save_mode='C',sub_date='$today' where form_id='$form_id'");
			if($save_query){
				$formFunctions->file_update($offline_challan);
				$formFunctions->insert_applications($uain);
				$str=$formFunctions->getEmail_str($uain);
				/////////////////////////////SEND MAIL////////////////////////////////
				$user_email=$formFunctions->get_usermail($swr_id);
				$dept_email="esgoa.land@gmail.com";
				require_once "land_form3_print.php"; 
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
						window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=3&dept=land';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'land_form3.php';
					</script>";
				}
			}else{
				echo "<script>
						alert('Something went wrong !!!');
						window.location.href = 'land_form3.php';
					</script>";
			}			
		}
	}
}	
	if(isset($_POST["save4"])){		
	$father_name=clean($_POST["father_name"]);$sp_name=clean($_POST["sp_name"]);$adhar_no=clean($_POST["adhar_no"]);$police_station=clean($_POST["police_station"]);$post_office=clean($_POST["post_office"]);$land_circle=clean($_POST["land_circle"]);$land_mouza=clean($_POST["land_mouza"]);$revenue_vill=clean($_POST["revenue_vill"]);$land_pattano=clean($_POST["land_pattano"]);$land_area=clean($_POST["land_area"]);

	$sql=$formFunctions->executeQuery($dept,"select form_id from land_form4 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
	  $query=$formFunctions->executeQueryInsertID($dept,"insert into land_form4(user_id,sub_date,father_name,sp_name,adhar_no,police_station,post_office,land_circle,land_mouza,revenue_vill,land_pattano,land_area) values ('$swr_id','$today','$father_name','$sp_name','$adhar_no','$police_station','$post_office','$land_circle','$land_mouza','$revenue_vill','$land_pattano','$land_area')");
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update land_form4 set sub_date='$today', father_name='$father_name',sp_name='$sp_name',adhar_no='$adhar_no',police_station='$police_station',post_office='$post_office',land_circle='$land_circle', land_mouza='$land_mouza',revenue_vill='$revenue_vill',land_pattano='$land_pattano',land_area='$land_area' where form_id=$form_id");	
	}					
	if($query){
			$formFunctions->insert_incomplete_forms('land','4'); //land commer-- dept name and 1 -- form no
			echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'land_form4.php?tab=2';
			</script>";
	}else{
			echo "<script>
				alert('Invalid Entry');
				window.location.href = 'land_form4.php?tab=1';
			</script>";
	}	
}
if(isset($_POST["submit4"])){
	if(empty($_POST["mfile1"]) || empty($_POST["mfile2"]) || empty($_POST["mfile3"]) ||  $_POST["mfile1"]=='2' || $_POST["mfile2"]=='2' || $_POST["mfile3"]=='2' || $_POST["mfile1"]=='3' || $_POST["mfile2"]=='3' || $_POST["mfile3"]=='3')
	{
	echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'land_form4.php?tab=2';
			</script>";
	}
	$file1=clean($_POST["mfile1"]);
	$file2=clean($_POST["mfile2"]);
	$file3=clean($_POST["mfile3"]);	
	$sql=$formFunctions->executeQuery($dept,"select form_id from land_form4 where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'land_form4.php';
		</script>";	
	  }else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];
		$savequery=$formFunctions->executeQuery($dept,"update land_form4 set file1='$file1',file2='$file2',file3='$file3' where form_id='$form_id'");
	  }
     	if($savequery){
		$formFunctions->file_update($file1);$formFunctions->file_update($file2);$formFunctions->file_update($file3);
		if($file1=="SC" || $file2=="SC" || $file3=="SC" ){
			$save_query=$formFunctions->executeQuery($dept,"update land_form4 set courier_details='1', sub_date='$today' where form_id='$form_id'");
		}else{
				$courier_details=NULL;
				$save_query=$formFunctions->executeQuery($dept,"update land_form4 set sub_date='$today',courier_details='$courier_details' where form_id='$form_id'");
			}
			if($save_query){
					echo "<script>
						alert('Successfully Saved....');
						window.location.href = 'preview.php?token=4';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href ='land_form2.php?tab=3';
					</script>";
				}			
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href ='land_form4.php?tab=3';
		</script>";
	}
}

if(isset($_POST["proceed4"]))
{
   $query=$formFunctions->executeQuery($dept,"select form_id,save_mode,courier_details from land_form4 where user_id='$swr_id' and active='1'");
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'land_form4.php';
			  </script>";	
	
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'land','4');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$formFunctions->executeQuery($dept,"update land_form4 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'");
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=land&form=4';
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
			$dept_email="esgoa.land@gmail.com";
			require_once "land_form4_print.php"; 
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
					window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=4&dept=land';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'land_form4.php?tab=2';
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
if(isset($_POST["save5a"])){		
	
	 $father_name=$_POST["father_name"];
	 $name_seller=$_POST["name_seller"];
	 $adhar_crd=$_POST["adhar_crd"];
	 $gp=$_POST["gp"];


	$sql=$formFunctions->executeQuery($dept,"select form_id from land_form5 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){  ////////////table is empty//////////////			
			$query=$formFunctions->executeQueryInsertID($dept,"insert into land_form5(user_id,name_seller,father_name,adhar_crd,gp) values ('$swr_id','$name_seller','$father_name','$adhar_crd','$gp')");			
	}else{  ////////////table is not empty//////////////
			$form_id=$row["form_id"];	
			$query=$formFunctions->executeQuery($dept,"update land_form5 set name_seller='$name_seller',father_name='$father_name',adhar_crd='$adhar_crd',gp='$gp' where form_id='$form_id'");	
	}		
	if($query){
			$formFunctions->insert_incomplete_forms('land','5');
			echo "<script>
				alert('Successfully Saved.');
				window.location.href = 'land_form5.php?tab=2';
			</script>";			
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'land_form5.php?tab=1';
			</script>";
	}						
}


if(isset($_POST["save5b"])){		
	
	$name_intender=$_POST["name_intender"];$buyer=$_POST["buyer"];$sold_village=$_POST["sold_village"];$sold_mouza=$_POST["sold_mouza"];$sold_patta=$_POST["sold_patta"];$sold_dag=$_POST["sold_dag"];$sold_area=$_POST["sold_area"];$sold_class=$_POST["sold_class"];$purpose_sale=$_POST["purpose_sale"];$rate_biga=$_POST["rate_biga"];$total_value=$_POST["total_value"];

	$sql=$formFunctions->executeQuery($dept,"select form_id from land_form5 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	$form_id=$row["form_id"];	
	$query=$formFunctions->executeQuery($dept,"update land_form5 set name_intender='$name_intender',buyer='$buyer',sold_village='$sold_village',sold_mouza='$sold_mouza',sold_patta='$sold_patta',sold_dag='$sold_dag',sold_area='$sold_area',sold_class='$sold_class',purpose_sale='$purpose_sale',rate_biga='$rate_biga',total_value='$total_value' where form_id='$form_id'");	
	
	if($query){
			$formFunctions->insert_incomplete_forms('land','5');
			echo "<script>
				alert('Successfully Saved.');
				window.location.href = 'land_form5.php?tab=3';
			</script>";			
	}else {
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'land_form5.php?tab=2';
			</script>";
	}						
}		
if(isset($_POST["submit5"])){
	if( empty($_POST["mfile1"]) || empty($_POST["mfile2"]) || empty($_POST["mfile3"])|| empty($_POST["mfile4"])|| empty($_POST["mfile5"])|| empty($_POST["mfile6"])|| empty($_POST["mfile7"])|| empty($_POST["mfile8"])|| empty($_POST["mfile9"])|| empty($_POST["mfile10"])|| $_POST["mfile1"]=='2' || $_POST["mfile2"]=='2'|| $_POST["mfile3"]=='2'|| $_POST["mfile4"]=='2'|| $_POST["mfile5"]=='2'|| $_POST["mfile6"]=='2'|| $_POST["mfile7"]=='2'|| $_POST["mfile8"]=='2'|| $_POST["mfile9"]=='2'|| $_POST["mfile10"]=='2'|| $_POST["mfile1"]=='3' || $_POST["mfile2"]=='3' || $_POST["mfile3"]=='3'|| $_POST["mfile4"]=='3'|| $_POST["mfile5"]=='3'|| $_POST["mfile6"]=='3'|| $_POST["mfile7"]=='3'|| $_POST["mfile8"]=='3'|| $_POST["mfile9"]=='3'|| $_POST["mfile10"]=='3')
	{
	echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'land_form5.php?tab=3';
			</script>";
	}
	
	     $file1=clean($_POST["mfile1"]);$file2=clean($_POST["mfile2"]);$file3=clean($_POST["mfile3"]);$file4=clean($_POST["mfile4"]);$file5=clean($_POST["mfile5"]);$file6=clean($_POST["mfile6"]);$file7=clean($_POST["mfile7"]);$file8=clean($_POST["mfile8"]);$file9=clean($_POST["mfile9"]);$file10=clean($_POST["mfile10"]);
         $sql=$land->query("select form_id from land_form5 where user_id='$swr_id' and active='1'")or die("Error :". $land->error);		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'land_form5.php';
		</script>";
	  }else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];
		$savequery=$formFunctions->executeQuery($dept,"update land_form5 set file1='$file1',file2='$file2',file3='$file3',file4='$file4',file5='$file5',file6='$file6',file7='$file7',file8='$file8',file9='$file9',file10='$file10' where form_id='$form_id'") ;
	  }
     	if($savequery){
		$formFunctions->file_update($file1);$formFunctions->file_update($file2);$formFunctions->file_update($file3);$formFunctions->file_update($file4);
		$formFunctions->file_update($file5);$formFunctions->file_update($file6);
		$formFunctions->file_update($file7);$formFunctions->file_update($file8);
		$formFunctions->file_update($file9);$formFunctions->file_update($file10);
		if($file1=="SC" || $file2=="SC" || $file3=="SC" || $file4=="SC" || $file5=="SC" || $file6=="SC" || $file7=="SC" || $file8=="SC" || $file9=="SC" || $file10=="SC" ){
			$save_query=$formFunctions->executeQuery($dept,"update land_form5 set courier_details='1', sub_date='$today' where form_id='$form_id'");
		    }else{
				$courier_details=NULL;
				$save_query=$formFunctions->executeQuery($dept,"update land_form5 set sub_date='$today',courier_details='$courier_details' where form_id='$form_id'");
			}
		
		if($save_query){
					echo "<script>
						alert('Successfully Saved....');
						window.location.href = 'preview.php?token=5';
					</script>";
				}else{
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href ='land_form5.php?tab=3';
					</script>";
				}			
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href ='land_form5.php?tab=3';
		</script>";
	}
}
if(isset($_POST["proceed5"])){  
    $query=$formFunctions->executeQuery($dept,"select form_id,save_mode,courier_details from land_form5 where user_id='$swr_id' and active='1'");
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'land_form5.php';
			</script>";
	
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'land','5');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$formFunctions->executeQuery($dept,"update land_form5 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'");
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=land&form=5';
				</script>";
			}else{
				echo  "<script>
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
			$dept_email="esgoa.land@gmail.com";
			require_once "land_form5_print.php"; 
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
					window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=5&dept=land';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'land_form5.php?tab=2';
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