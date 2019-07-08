<?php
if(isset($_POST["save1"])){		
	$from_year=$_POST["from_year"];$to_year=$_POST["to_year"];$family_name=$_POST["family_name"];$dob=$_POST["dob"];$owner_age=$_POST["owner_age"];	
	$sql=$gmc->query("select form_id from gmc_form1 where user_id='$swr_id' order by form_id desc LIMIT 1");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){			
			$query=$gmc->query("insert into gmc_form1(user_id,from_year,to_year,family_name,dob,owner_age) values ('$swr_id','$from_year','$to_year','$family_name','$dob','$owner_age')") OR die("Error: ".$gmc->error);	
	}else{				
			$form_id=$row["form_id"];				
			$query=$gmc->query("update gmc_form1 set from_year='$from_year', to_year='$to_year',family_name='$family_name', dob='$dob',owner_age='$owner_age' where form_id='$form_id'") OR die("Error: ".$gmc->error);	
	}
	if($query){
		$formFunctions->insert_incomplete_forms('gmc','1'); //gmc-- dept name and 1 -- form no
		echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'trade_license.php?tab=2';
			</script>";					
	}else{
		echo "<script>
				alert('Invalid Entry');
				window.location.href = 'trade_license.php';
			</script>";
	}		
}
if(isset($_POST["save2"])){		
	$premises=$_POST["premises"];$godown=$_POST["godown"];			
	if(!empty($_POST["premises_details"])) $premises_details=json_encode($_POST["premises_details"]);
	else $premises_details=NULL;
	if(!empty($_POST["godown_details"])) $godown_details=json_encode($_POST["godown_details"]);
	else $godown_details=NULL;
	
	$sql=$gmc->query("select form_id from gmc_form1 where user_id='$swr_id' order by form_id desc LIMIT 1");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){			
			$query=$gmc->query("insert into gmc_form1(premises,premises_details,godown,godown_details) values ('$sid','$premises','$premises_details','$godown','$godown_details')") OR die("Error: ".$gmc->error);
	}else{				
			$form_id=$row["form_id"];				
			$query=$gmc->query("update gmc_form1 set premises='$premises',godown='$godown',premises_details='$premises_details',godown_details='$godown_details' where form_id='$form_id'") OR die("Error: ".$gmc->error);		
	}
	if($query){					
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = 'trade_license.php?tab=3';
			</script>";					
	}else{
		echo "<script>
			alert('Invalid Entry');
			window.location.href = 'trade_license.php';
		</script>";
	}		
}
if(isset($_POST["save3"])){		
	$old_trade=$_POST["old_trade"];	
	if(!empty($_POST["old_trade_details"]))	 $old_trade_details=json_encode($_POST["old_trade_details"]);
	else	$old_trade_details=NULL;	
	$sql=$gmc->query("select form_id from gmc_form1 where user_id='$swr_id' order by form_id desc LIMIT 1");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){			
		$query=$gmc->query("insert into gmc_form1(user_id,old_trade,old_trade_details) values ('$swr_id','$old_trade', '$old_trade_details')") OR die("Error: ".$gmc->error);				
	}else{				
		$form_id=$row["form_id"];				
		$query=$gmc->query("update gmc_form1 set old_trade='$old_trade', old_trade_details='$old_trade_details' where form_id='$form_id'") OR die("Error: ".$gmc->error);			
	}
	if($query){					
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = 'trade_license.php?tab=4';
			</script>";					
	}else{
		echo "<script>
			alert('Invalid Entry');
			window.location.href = 'trade_license.php';
		</script>";
	}		
}
if(isset($_POST["save4"])){	
		$annual_income=$_POST["annual_income"];$it_payable=$_POST["it_payable"];$license_type=$_POST["license_type"];
		
		$sql=$gmc->query("select form_id,from_year,premises,old_trade from gmc_form1 where user_id='$swr_id' order by form_id desc LIMIT 1");
		$row=$sql->fetch_array();			
		if($sql->num_rows<1){			
				echo "<script>
								alert('Invalid Entry, please fill up all the parts of the form');
								window.location.href = 'trade_license.php';
							</script>";				
		}else{
				$form_id=$row["form_id"];				
				if(!empty($row["from_year"]) && !empty($row["premises"]) && !empty($row["old_trade"]))
				{
					$query=$gmc->query("update gmc_form1 set annual_income='$annual_income', it_payable='$it_payable', license_type='$license_type' where form_id='$form_id'") OR die("Error: ".$gmc->error);	
					if($query){
						echo "<script>
								alert('Successfully Saved..');
								window.location.href = 'trade_license.php?tab=5';
								</script>";		
					}else{
						echo "<script>
								alert('Invalid Entry');
								window.location.href = 'trade_license.php';
							</script>";
					}
				}else{
					echo "<script>
								alert('Please Fill Up all the parts of the form');
								window.location.href = 'trade_license.php';
							</script>";		
				}						
		}		
}
if(isset($_POST["save5"])){
	
		$form_id=$gmc->query("select form_id from gmc_form1 where user_id='$swr_id' order by form_id desc LIMIT 1")->fetch_object()->form_id;
		if((isset($_POST["mfile1"]) && empty($_POST["mfile1"])) || (isset($_POST["mfile2"]) && empty($_POST["mfile2"])) || (isset($_POST["mfile3"]) && empty($_POST["mfile3"])) || (isset($_POST["mfile4"]) && empty($_POST["mfile4"])) || (isset($_POST["mfile5"]) && empty($_POST["mfile5"])) || (isset($_POST["mfile6"]) && empty($_POST["mfile6"])) || (isset($_POST["mfile7"]) && empty($_POST["mfile7"])) || (isset($_POST["mfile1"]) && $_POST["mfile1"]=='2') || (isset($_POST["mfile2"]) && $_POST["mfile2"]=='2') || (isset($_POST["mfile3"]) && $_POST["mfile3"]=='2') || (isset($_POST["mfile4"]) && $_POST["mfile4"]=='2') || (isset($_POST["mfile5"]) && $_POST["mfile5"]=='2') || (isset($_POST["mfile6"]) && $_POST["mfile6"]=='2') || (isset($_POST["mfile7"]) && $_POST["mfile7"]=='2') || (isset($_POST["mfile1"]) && $_POST["mfile1"]=='3') || (isset($_POST["mfile2"]) && $_POST["mfile2"]=='3') || (isset($_POST["mfile3"]) && $_POST["mfile3"]=='3') || (isset($_POST["mfile4"]) && $_POST["mfile4"]=='3') || (isset($_POST["mfile5"]) && $_POST["mfile5"]=='3') || (isset($_POST["mfile6"]) && $_POST["mfile6"]=='3') || (isset($_POST["mfile7"]) && $_POST["mfile7"]=='3'))
		{
			echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'trade_license.php?tab=5';
			</script>";
		}else{		
			if(isset($_POST["mfile1"])){
				$file1=$_POST["mfile1"];
				$formFunctions->file_update($file1);
			}else{
				$file1="";
			}		
			if(isset($_POST["mfile2"])){
				$file2=$_POST["mfile2"];
				$formFunctions->file_update($file2);
			}else{
				$file2="";
			}		
			if(isset($_POST["mfile3"])){
				$file3=$_POST["mfile3"];
				$formFunctions->file_update($file3);
			}else{
				$file3="";
			}		
			if(isset($_POST["mfile4"])){
				$file4=$_POST["mfile4"];
				$formFunctions->file_update($file4);
			}else{
				$file4="";
			}		
			if(isset($_POST["mfile5"])){
				$file5=$_POST["mfile5"];
				$formFunctions->file_update($file5);
			}else{
				$file5="";
			}		
			if(isset($_POST["mfile6"])){
				$file6=$_POST["mfile6"];
				$formFunctions->file_update($file6);
			}else{
				$file6="";
			}		
			if(isset($_POST["mfile7"])){
				$file7=$_POST["mfile7"];
				$formFunctions->file_update($file7);
			}else{
				$file7="";
			}
			if(isset($_POST["courier_details"]) && !empty($_POST["courier_details"])){
				$courier_details=json_encode($_POST["courier_details"]);
			}else $courier_details=NULL;
			
			
			$query=$gmc->query("select file1 from gmc_form1_upload where form_id='$form_id'");
			if($query->num_rows>0){
				$in=$gmc->query("update gmc_form1_upload set file1='$file1',file2='$file2',file3='$file3',file4='$file4',file5='$file5',file6='$file6',file7='$file7' where form_id='$form_id'") or die($gmc->error);
			}else{
				$in=$gmc->query("insert into gmc_form1_upload(form_id,file1,file2,file3,file4,file5,file6,file7) values ('$form_id','$file1','$file2','$file3','$file4','$file5','$file6','$file7')") or die ($gmc->error);
			}		
			if($in){
				$form_no=$formFunctions->create_uain($form_id,'gmc','1');
				$gmc_zone=$mysqli->query("select b_block from singe_window_registration where id='$swr_id'")->fetch_object()->b_block;
				if($file1=="SC" || $file2=="SC" ||  $file3=="SC" ||  $file4=="SC" ||  $file5=="SC" ||  $file6=="SC" ||  $file7=="SC"){
					$save_query=$gmc->query("update gmc_form1 set courier_details='1',gmc_zone='$gmc_zone',uain='$form_no', sub_date='$today' where form_id='$form_id'") or die($gmc->error);
				}else{
					$save_query=$gmc->query("update gmc_form1 set save_mode='D',gmc_zone='$gmc_zone',uain='$form_no', sub_date='$today', received_date='$today' where form_id='$form_id'") or die($gmc->error);
				}
				
				echo "<script>
					alert('Successfully Saved....');
					window.location.href = 'preview.php?token=1';
				</script>";
			}else{
				echo "<script>
					alert('Invalid Entry....');
					window.location.href = 'trade_license.php?tab=5';
				</script>";
			}
		}
}
if(isset($_POST["proceed1"])){		
	$sql=$gmc->query("select form_id,save_mode,courier_details from gmc_form1 where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'trade_license.php';
		</script>";
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'gmc','1');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$gmc->query("update gmc_form1 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($gmc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=gmc&form=1';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=1';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$gmc->query("update gmc_form1 set sub_date='$today',uain='$uain',save_mode='P' where form_id='$form_id'") or die($gmc->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = 'trade_license.php?tab=6';
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
if(isset($_POST["submit"])){
	if($_POST["payment_mode"]==1){
		echo "<script>
				alert('Go to the online payment section and please do not click on the back button or do not refresh the web page.');
				window.location.href = 'form_payment.php?token=trade';
			</script>";
	}else if($_POST["payment_mode"]==0){
		if(empty($_POST["offline_challan"]) || $_POST["offline_challan"]=='2' || $_POST["offline_challan"]=='3'){
			echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'trade_license.php?tab=6';
			</script>";
		}else{
			$sql=$gmc->query("select form_id from gmc_form1 where user_id='$swr_id' order by form_id desc LIMIT 1");
			$row=$sql->fetch_array();			
			if($sql->num_rows>0){
				$form_id=$row["form_id"];
				
				$offline_challan=$_POST["offline_challan"];$payment_mode=$_POST["payment_mode"];
				$save_query=$gmc->query("update gmc_form1 set offline_challan='$offline_challan',payment_mode='$payment_mode',save_mode='C',sub_date='$today' where form_id='$form_id'") or die($gmc->error);
				if($save_query){
					$uain=$gmc->query("select uain from gmc_form1 where form_id='$form_id'")->fetch_object()->uain;
					
					$formFunctions->insert_applications($uain);
					$str=$formFunctions->getEmail_str($uain);
					/*----------------SEND MAIL-----------------*/
					$user_email=$formFunctions->get_usermail($swr_id);
					$dept_email="esgoa.gmc@gmail.com";
					
					require_once "trade_license_print.php"; 
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
						window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=1&dept=gmc';
					</script>";
				}else{
					echo $gmc->error;
					echo "<script>window.location.href = 'trade_license.php?tab=6';</script>";
				}
			}else{
				echo "<script>
					alert('Invalid Entry...2.');
					window.location.href = 'trade_license.php?tab=6';
				</script>";
			}
		}								
	}else{
			echo "<script>
				alert('Invalid Entry..4..');
				window.location.href = 'trade_license.php?tab=6';
			</script>";
	}
}

?>
