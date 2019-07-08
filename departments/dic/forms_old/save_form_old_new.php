<?php 
if(isset($_POST["save1a"])){		
	$nature=clean($_POST["nature"]);$ancillary=clean($_POST["ancillary"]);$installation_date=clean($_POST["installation_date"]);
	$sql=$dic->query("select form_id from dic_form1 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$dic->query("insert into dic_form1(user_id,sub_date,nature,ancillary,installation_date) values ('$swr_id','$today', '$nature', '$ancillary', '$installation_date')") OR die("Error: ".$dic->error);
	}else{
		$form_id=$row["form_id"];	
		$query=$dic->query("update dic_form1 set sub_date='$today', nature='$nature', ancillary='$ancillary', installation_date='$installation_date' where form_id=$form_id") OR die("Error: ".$clm->error);
	}				
	if($query){		
		$formFunctions->insert_incomplete_forms('dic','1'); //clm-- dept name and 1 -- form no
		echo "<script>
			alert('Successfully saved.');
			window.location.href = 'dic_form1.php?tab=2';
		</script>";			
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'dic_form1.php';
		</script>";
	}			
}
if(isset($_POST["save1b"])){		
	$cat_enter=clean($_POST["cat_enter"]);$input_size=$_POST["hiddenval"];
	if(!empty($_POST["manuf"]))	 $manuf=json_encode($_POST["manuf"]);
	else	$manuf=NULL;
	if(!empty($_POST["fixed_asset"]))	 $fixed_asset=json_encode($_POST["fixed_asset"]);
	else	$type=NULL;
	if(!empty($_POST["power"]))	 $power=json_encode($_POST["power"]);
	else	$power=NULL;
	
	$sql=$dic->query("select form_id from dic_form1 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		echo "<script>
			alert('Invalid Page Access !!!');
			window.location.href = 'dic_form1.php';
		</script>";
	}else{
		$form_id=$row["form_id"];	
		$query=$dic->query("update dic_form1 set sub_date='$today', cat_enter='$cat_enter', manuf='$manuf', fixed_asset='$fixed_asset', power='$power' where form_id=$form_id") OR die("Error: ".$clm->error);
		
		if($query){
			if($input_size!=0){					
				$k=$dic->query("delete from dic_form1_t1 where form_id='$form_id'");
				for($i=1;$i<$input_size;$i++){
					//$vala=$_POST["txtA".$i];		
					$valb=$_POST["txtB".$i];
					$valc=$_POST["txtC".$i];
					$vald=$_POST["txtD".$i];
					$vale=$_POST["txtE".$i];
					$part1=$dic->query("INSERT INTO dic_form1_t1(id,form_id,slno,name,code,quantity,unit) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')") or die("error in insertion dic_form1_t1".$dic->error);
				}
			}
			echo "<script>
				alert('Successfully saved.');
				window.location.href = 'dic_form1.php?tab=3';
			</script>";			
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'dic_form1.php';
			</script>";
		}
	}				
}
if(isset($_POST["save1c"])){		
	$expect_date=clean($_POST["expect_date"]);
	$hidden_value=clean($_POST["hidden_value"]);$input_size2=$_POST["hiddenval2"];
	
	if(!empty($_POST["source"]))	 $source=json_encode($_POST["source"]);
	else	$source=NULL;
	if(!empty($_POST["expected"]))	 $expected=json_encode($_POST["expected"]);
	else	$expected=NULL;

	$sql=$dic->query("select form_id from dic_form1 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		echo "<script>
			alert('Invalid Page Access !!!');
			window.location.href = 'dic_form1.php';
		</script>";
	}else{
		$form_id=$row["form_id"];	
		$query=$dic->query("update dic_form1 set sub_date='$today', expect_date='$expect_date', source='$source' , expected='$expected' where form_id=$form_id") OR die("Error: ".$clm->error);
		for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$gender=$_POST["gender".$i.""];$caste=$_POST["caste".$i.""];$equity_rs=$_POST["equity_rs".$i.""];$equity_per=$_POST["equity_per".$i.""];$is_stack=$_POST["is_stack".$i.""];
			
				$query1=$dic->query("update dic_form1_members set name='$name',gender='$gender',caste='$caste',equity_rs='$equity_rs',equity_per='$equity_per' ,is_stack='$is_stack' where form_id='$form_id' and sl_no='$i'") or die("error in insertion dic_form1_members".$dic->error);
		}
	}				
	if($query){
		if($input_size2!=0){					
			$k=$dic->query("delete from dic_form1_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
			//$vala=$_POST["textA".$i];			
			$valb=$_POST["textB".$i];
			$valc=$_POST["textC".$i];
			$vald=$_POST["textD".$i];			
			$part2=$dic->query("INSERT INTO dic_form1_t2(id,form_id,slno,name,quantity,unit) VALUES ('','$form_id','$i','$valb','$valc','$vald')") or die($dic->error);
			}
		}
		echo "<script>
			alert('Successfully saved.');
			window.location.href = 'preview.php?token=1';
		</script>";			
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'dic_form1.php';
		</script>";
	}			
}
if(isset($_POST["proceed1"])){
	$query=$dic->query("select form_id,save_mode,courier_details from dic_form1 where user_id='$swr_id' and active='1'") or die("Error :". $dic->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'dic_form1.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'dic','1');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$clm->query("update dic_form1 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($clm->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=dic&form=1';
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
			$dept_email="esgoa.dic@gmail.com";
			require_once "dic_form1_print.php"; 
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
					window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=1&dept=dic';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'dic_form1.php';
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
if(isset($_POST["save2"])){		
	$power=clean($_POST["power"]);$raw_meterial=clean($_POST["raw_meterial"]);
	$hidden_value=clean($_POST["hidden_value"]);$input_size=$_POST["hiddenval"];$input_size2=$_POST["hiddenval2"];
	if(!empty($_POST["ack"]))	 $ack=json_encode($_POST["ack"]);
	else	$ack=NULL;
	if(!empty($_POST["fixed_amount"]))	 $fixed_amount=json_encode($_POST["fixed_amount"]);
	else	$type=NULL;
	if(!empty($_POST["proposed"]))	 $proposed=json_encode($_POST["proposed"]);
	else	$proposed=NULL;

	$sql=$dic->query("select form_id from dic_form2 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$dic->query("insert into dic_form2(user_id,sub_date,power,raw_meterial,ack,fixed_amount,proposed) values ('$swr_id','$today', '$power', '$raw_meterial', '$ack','$fixed_amount', '$proposed')") OR die("Error: 1".$dic->error);
			$form_id=$dic->insert_id;
			$k=$dic->query("delete from dic_form1_members where form_id='$form_id'");
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$gender=$_POST["gender".$i.""];$edu=$_POST["edu".$i.""];$caste=$_POST["caste".$i.""];$equity_rs=$_POST["equity_rs".$i.""];$equity_per=$_POST["equity_per".$i.""];$is_stack=$_POST["is_stack".$i.""];
				
				$query1=$dic->query("INSERT INTO dic_form1_members(id,form_id,slno,name,gender,caste,edu,equity_rs,equity_per,is_stack) VALUES ('','$form_id','$i','$name','$gender','$caste','$edu','$equity_rs','$equity_per','$is_stack')") or die($dic->error);
			}
	}else{
		$form_id=$row["form_id"];	
		$query=$dic->query("update dic_form2 set sub_date='$today',power='$power', raw_meterial='$raw_meterial', ack='$ack',fixed_amount='$fixed_amount', proposed='$proposed' where form_id=$form_id") OR die("Error: ".$dic->error);
		for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$gender=$_POST["gender".$i.""];$caste=$_POST["caste".$i.""];$equity_rs=$_POST["equity_rs".$i.""];$equity_per=$_POST["equity_per".$i.""];$is_stack=$_POST["is_stack".$i.""];
			
				$query1=$dic->query("update dic_form2_members set name='$name',gender='$gender',caste='$caste',equity_rs='$equity_rs',equity_per='$equity_per' ,is_stack='$is_stack' where form_id='$form_id' and sl_no='$i'") or die("error in insertion dic_form1_members".$dic->error);
		} 
	}				
	if($query){
					if($input_size!=0){					
					$k=$dic->query("delete from dic_form2_t1 where form_id='$form_id'");
					for($i=1;$i<$input_size;$i++){
						//$vala=$_POST["txtA".$i];		
						$valb=$_POST["txtB".$i];
						$valc=$_POST["txtC".$i];
						$vald=$_POST["txtD".$i];
						$vale=$_POST["txtE".$i];
						$part1=$dic->query("INSERT INTO dic_form2_t1(id,form_id,slno,name,code,quantity,unit) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')") or die("error in insertion dic_form1_t1".$dic->error);
						}
					}
					if($input_size2!=0){					
						$k=$dic->query("delete from dic_form2_t2 where form_id='$form_id'");
						for($i=1;$i<$input_size2;$i++){
						//$vala=$_POST["textA".$i];			
						$valb=$_POST["textB".$i];
						$valc=$_POST["textC".$i];
						$vald=$_POST["textD".$i];
						$vale=$_POST["textE".$i];
						
							$part2=$dic->query("INSERT INTO dic_form2_t2(id,form_id,slno,name,quantity,unit) VALUES ('','$form_id','$i','$valb','$valc','$vald'')") or die($dic->error);
							}
						}
		$formFunctions->insert_incomplete_forms('dic','2'); //dic-- dept name and 1 -- form no
			echo "<script>
				alert('Successfully saved.');
				window.location.href = 'preview.php?token=2';
			</script>";
			
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'dic_form2.php';
			</script>";
	}			
}
if(isset($_POST["proceed2"])){
	$query=$dic->query("select form_id,save_mode,courier_details from dic_form2 where user_id='$swr_id' and active='1'") or die("Error :". $dic->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'dic_form2.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'dic','2');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$dic->query("update dic_form2 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($dic->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=dic&form=2';
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
			$dept_email="esgoa.dic@gmail.com";
			require_once "dic_form2_print.php"; 
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
					window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=2&dept=dic';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'dic_form2.php';
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
?>