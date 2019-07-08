<?php
if(isset($_POST["save1a"])){		
	$nature=clean($_POST["nature"]);$ancillary=clean($_POST["ancillary"]);$installation_date=clean($_POST["installation_date"]);
	$sql=$dic->query("select form_id from dic_form1 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$dic->query("insert into dic_form1(user_id,sub_date,nature,ancillary,installation_date) values ('$swr_id','$today', '$nature', '$ancillary', '$installation_date')") OR die("Error: ".$dic->error);
	}else{
		$form_id=$row["form_id"];	
		$query=$dic->query("update dic_form1 set sub_date='$today', nature='$nature', ancillary='$ancillary', installation_date='$installation_date' where form_id=$form_id") OR die("Error: ".$dic->error);
	}				
	if($query){		
		$formFunctions->insert_incomplete_forms('dic','1'); //dic-- dept name and 1 -- form no
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
		$query=$dic->query("update dic_form1 set sub_date='$today', cat_enter='$cat_enter', manuf='$manuf', fixed_asset='$fixed_asset', power='$power' where form_id=$form_id") OR die("Error: ".$dic->error);
		
		if($query){
			if($input_size!=0){	
				$k=$dic->query("delete from dic_form1_t1 where form_id='$form_id'") or die($dic->error);
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
		$query=$dic->query("update dic_form1 set sub_date='$today', expect_date='$expect_date', source='$source' , expected='$expected' where form_id='$form_id'") OR die("Error: ".$dic->error);
		$k=$dic->query("select id from dic_form1_members where form_id='$form_id'");
		if($k->num_rows>0){
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$gender=$_POST["gender".$i.""];$edu=$_POST["edu".$i.""];$caste=$_POST["caste".$i.""];$equity_rs=$_POST["equity_rs".$i.""];$equity_per=$_POST["equity_per".$i.""];$is_stack=$_POST["is_stack".$i.""];
			
				$query1=$dic->query("update dic_form1_members set name='$name',gender='$gender',caste='$caste',edu='$edu',equity_rs='$equity_rs',equity_per='$equity_per',is_stack='$is_stack' where form_id='$form_id' and slno='$i'") or die($dic->error);
			}
		}else{		
			for($i=1;$i<=$hidden_value;$i++){
			$name=$_POST["name".$i.""];$gender=$_POST["gender".$i.""];$edu=$_POST["edu".$i.""];$caste=$_POST["caste".$i.""];$equity_rs=$_POST["equity_rs".$i.""];$equity_per=$_POST["equity_per".$i.""];$is_stack=$_POST["is_stack".$i.""];
			
			$query1=$dic->query("INSERT INTO dic_form1_members(id,form_id,slno,name,gender,caste,edu,equity_rs,equity_per,is_stack) VALUES ('','$form_id','$i','$name','$gender','$caste','$edu','$equity_rs','$equity_per','$is_stack')") or die($dic->error);
			}
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
			$save_query=$dic->query("update dic_form1 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($dic->error);
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
if(isset($_POST["save2a"])){		
	$hidden_value=clean($_POST["hidden_value"]);
	if(!empty($_POST["ack"]))	 $ack=json_encode($_POST["ack"]);
	else	$ack=NULL;
	$sql=$dic->query("select form_id from dic_form2 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$dic->query("insert into dic_form2(user_id,sub_date,ack) values ('$swr_id','$today', '$ack')") OR die("Error: 1".$dic->error);	
			$form_id=$dic->insert_id;
			$k=$dic->query("delete from dic_form2_members where form_id='$form_id'");
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$sn1=$_POST["sn1".$i.""];$sn2=$_POST["sn2".$i.""];$v=$_POST["v".$i.""];$d=$_POST["d".$i.""];$p=$_POST["p".$i.""];
				
				$query1=$dic->query("INSERT INTO dic_form2_members(id,form_id,slno,name,sn1,sn2,v,d,p) VALUES ('','$form_id','$i','$name','$sn1','$sn2','$v','$d','$p')") or die($dic->error);
				}
	}else{
		$form_id=$row["form_id"];	
		$query=$dic->query("update dic_form2 set sub_date='$today', ack='$ack' where form_id=$form_id") OR die("Error: ".$dic->error);
		for($i=1;$i<=$hidden_value;$i++){
			$name=$_POST["name".$i.""];$sn1=$_POST["sn1".$i.""];$sn2=$_POST["sn2".$i.""];$v=$_POST["v".$i.""];$d=$_POST["d".$i.""];$p=$_POST["p".$i.""];
			
			$query1=$dic->query("UPDATE dic_form2_members set name='$name',sn1='$sn1',sn2='$sn2',v='$v',d='$d',p='$p' where form_id='$form_id' and slno='$i'") or die($dic->error);
			}
		}		
	if($query){	
		$formFunctions->insert_incomplete_forms('dic','2'); //dic-- dept name and 2 -- form no
			echo "<script>
				alert('Successfully saved.');
				window.location.href = 'dic_form2.php?tab=2';
			</script>";
			
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'dic_form2.php?tab=1';
			</script>";
	}			
}
if(isset($_POST["save2b"])){		
	$power=clean($_POST["power"]);$raw_meterial=clean($_POST["raw_meterial"]);
	$input_size=$_POST["hiddenval"];$total_investment=$_POST["total_investment"];
	if(!empty($_POST["fixed_amount"]))	 $fixed_amount=json_encode($_POST["fixed_amount"]);
	else	$type=NULL;
	if(!empty($_POST["proposed"]))	 $proposed=json_encode($_POST["proposed"]);
	else	$proposed=NULL;

	$sql=$dic->query("select form_id from dic_form2 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$dic->query("insert into dic_form2(user_id,sub_date,power,raw_meterial,fixed_amount,total_investment,proposed) values ('$swr_id','$today', '$power', '$raw_meterial', '$fixed_amount','$total_investment', '$proposed')") OR die("Error: 1".$dic->error);
			
	}else{
			$form_id=$row["form_id"];	
			$query=$dic->query("update dic_form2 set sub_date='$today',power='$power', raw_meterial='$raw_meterial',fixed_amount='$fixed_amount',total_investment='$total_investment', proposed='$proposed' where form_id=$form_id") OR die("Error: ".$dic->error);
	}			
	if($query){
				if($input_size!=0){					
				$k=$dic->query("delete from dic_form2_t1 where form_id='$form_id'");
				for($i=1;$i<$input_size;$i++){
					//$vala=$_POST["txtA".$i];		
					$valb=$_POST["txtB".$i];
					$valc=$_POST["txtC".$i];
					$vald=$_POST["txtD".$i];
					$part1=$dic->query("INSERT INTO dic_form2_t1(id,form_id,slno,name,quantity,rupees) VALUES ('','$form_id','$i','$valb','$valc','$vald')") or die("error in insertion dic_form2_t1".$dic->error);
					}
				}
				echo "<script>
					alert('Successfully saved.');
					window.location.href = 'dic_form2.php?tab=3';
				</script>";
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'dic_form2.php?tab=2';
			</script>";
				
	}
}

if(isset($_POST["save2c"])){
		if(empty($_POST["mfile1"]) || empty($_POST["mfile2"]) || empty($_POST["mfile3"]) || empty($_POST["mfile4"]) || empty($_POST["mfile5"]) || empty($_POST["mfile6"]) || $_POST["mfile1"]=='2' || $_POST["mfile2"]=='2' || $_POST["mfile3"]=='2' || $_POST["mfile4"]=='2' || $_POST["mfile5"]=='2' || $_POST["mfile6"]=='2' || $_POST["mfile1"]=='3' || $_POST["mfile2"]=='3' || $_POST["mfile3"]=='3' || $_POST["mfile4"]=='3' || $_POST["mfile5"]=='3' || $_POST["mfile6"]=='3')
			{
				echo "<script>
					alert('Error in file / You didnot select any option.');
					window.location.href = 'dic_form2.php?tab=3';
				</script>";
			}
			else {		
			$file1=clean($_POST["mfile1"]);$file2=clean($_POST["mfile2"]);$file3=clean($_POST["mfile3"]);$file4=clean($_POST["mfile4"]);$file5=clean($_POST["mfile5"]);$file6=clean($_POST["mfile6"]);
			
			$sql=$dic->query("select form_id from dic_form2 where user_id='$swr_id' and active='1'")or die("Error :". $dic->error);		
			if($sql->num_rows<1){				
				echo "<script>
					alert('Please fill the first part of the form.');
					window.location.href = 'dic_form2.php';
				</script>";
			}else{
				$row=$sql->fetch_array();
				$form_id=$row["form_id"];
				$savequery=$dic->query("update dic_form2 set file1='$file1', file2='$file2', file3='$file3', file4='$file4',file5='$file5', file6='$file6' where form_id='$form_id'") or die($dic->error);
			}	
			if($savequery){
				$formFunctions->file_update($file1);$formFunctions->file_update($file2);$formFunctions->file_update($file3);$formFunctions->file_update($file4);$formFunctions->file_update($file5);$formFunctions->file_update($file6);

				if($file1=="SC" || $file2=="SC" ||  $file3=="SC" ||  $file4=="SC"||  $file5=="SC" ||  $file6=="SC"){
					$save_query=$dic->query("update dic_form2 set courier_details='1', sub_date='$today' where form_id='$form_id'") or die($dic->error);
				}else{
						$courier_details=NULL;
						$save_query=$dic->query("update dic_form2 set sub_date='$today',courier_details='$courier_details' where form_id='$form_id'") or die($dic->error);
				}
				if($save_query){
						echo "<script>
							alert('Successfully Saved....');
							window.location.href = 'preview.php?token=2';
						</script>";
				}else{
						echo "<script>
							alert('Something went wrong !!!');
							window.location.href ='dic_form2.php?tab=3';
						</script>";
				}			
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href ='dic_form2.php?tab=3';
				</script>";
			}
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
if(isset($_POST["save3a"])){		
	$hidden_value=clean($_POST["hidden_value"]);
	if(!empty($_POST["pmt"]))	 $pmt=json_encode($_POST["pmt"]);
	else	$pmt=NULL;
	if(!empty($_POST["fixed_amount"]))	 $fixed_amount=json_encode($_POST["fixed_amount"]);
	else	$fixed_amount=NULL;
	$sql=$dic->query("select form_id from dic_form3 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$dic->query("insert into dic_form3(user_id,sub_date,fixed_amount,pmt) values ('$swr_id','$today', '$fixed_amount', '$pmt')") OR die("Error: ".$dic->error);
		$form_id=$dic->insert_id;	
		$k=$dic->query("delete from dic_form3_members where form_id='$form_id'");
		for($i=1;$i<=$hidden_value;$i++){
			$name=$_POST["name".$i.""];$sn1=$_POST["sn1".$i.""];$sn2=$_POST["sn2".$i.""];$v=$_POST["v".$i.""];$d=$_POST["d".$i.""];$p=$_POST["p".$i.""];
			
			$query1=$dic->query("INSERT INTO dic_form3_members(id,form_id,slno,name,sn1,sn2,v,d,p) VALUES ('','$form_id','$i','$name','$sn1','$sn2','$v','$d','$p')") or die($dic->error);
		}
	}else{
		$form_id=$row["form_id"];	
		$query=$dic->query("update dic_form3 set sub_date='$today', fixed_amount='$fixed_amount', pmt='$pmt' where form_id=$form_id") OR die("Error: ".$dic->error);
	
		for($i=1;$i<=$hidden_value;$i++){
			$name=$_POST["name".$i.""];$sn1=$_POST["sn1".$i.""];$sn2=$_POST["sn2".$i.""];$v=$_POST["v".$i.""];$d=$_POST["d".$i.""];$p=$_POST["p".$i.""];			
			
			$query1=$dic->query("UPDATE dic_form3_members set name='$name',sn1='$sn1',sn2='$sn2',v='$v',d='$d',p='$p' where form_id='$form_id' and slno='$i'") or die($dic->error);
		}
	}				
	if($query){		
		$formFunctions->insert_incomplete_forms('dic','3'); //dic-- dept name and 3 -- form no
		echo "<script>
			alert('Successfully saved.');
			window.location.href = 'dic_form3.php?tab=2';
		</script>";			
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'dic_form3.php?tab=1';
		</script>";
	}			
}

if(isset($_POST["save3b"])){		
	$input_size=$_POST["hiddenval"];
	$input_size2=$_POST["hiddenval2"];
	
	if(!empty($_POST["land"]))	 $land=json_encode($_POST["land"]);
	else	$land=NULL;
	if(!empty($_POST["building"]))	 $building=json_encode($_POST["building"]);
	else	$building=NULL;
	if(!empty($_POST["electricity"]))	 $electricity=json_encode($_POST["electricity"]);
	else	$electricity=NULL;
	if(!empty($_POST["proposed"]))	 $proposed=json_encode($_POST["proposed"]);
	else	$proposed=NULL;

	$sql=$dic->query("select form_id from dic_form3 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		echo "<script>
			alert('Invalid Page Access !!!');
			window.location.href = 'dic_form3.php';
		</script>";
	}else{
		$form_id=$row["form_id"];	
		$query=$dic->query("update dic_form3 set sub_date='$today', land='$land' , building='$building', electricity='$electricity', proposed='$proposed' where form_id='$form_id'") OR die("Error: ".$dic->error);
	}				
	if($query){
		if($input_size!=0){					
			$k=$dic->query("delete from dic_form3_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
			//$vala=$_POST["textA".$i];			
			$valb=$_POST["txtB".$i];
			$valc=$_POST["txtC".$i];
			$vald=$_POST["txtD".$i];			
			$vale=$_POST["txtE".$i];			
			$valf=$_POST["txtF".$i];			
			$part=$dic->query("INSERT INTO dic_form3_t1(id,form_id,slno,name,quantity1,rupees1,quantity2,rupees2) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale','$valf')") or die($dic->error);
			}
		}
		if($input_size2!=0){					
			$k=$dic->query("delete from dic_form3_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
			//$vala=$_POST["textA".$i];			
			$valb=$_POST["textB".$i];
			$valc=$_POST["textC".$i];
			$vald=$_POST["textD".$i];	
			$vale=$_POST["textE".$i];			
			$valf=$_POST["textF".$i];
			$part2=$dic->query("INSERT INTO dic_form3_t2(id,form_id,slno,name,quantity1,rupees1,quantity2,rupees2) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale','$valf')") or die($dic->error);
			}
		}
		echo "<script>
			alert('Successfully saved.');
			window.location.href = 'dic_form3.php?tab=3';
		</script>";			
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'dic_form3.php?tab=2';
		</script>";
	}			
}
if(isset($_POST["save3c"])) {
		if(empty($_POST["mfile1"]) || empty($_POST["mfile2"]) || empty($_POST["mfile3"]) || empty($_POST["mfile4"]) || empty($_POST["mfile5"]) || empty($_POST["mfile6"]) || empty($_POST["mfile7"]) || empty($_POST["mfile8"]) || empty($_POST["mfile9"]) || empty($_POST["mfile10"]) || empty($_POST["mfile11"]) || empty($_POST["mfile12"])|| empty($_POST["mfile13"]) || $_POST["mfile1"]=='2' || $_POST["mfile2"]=='2' || $_POST["mfile3"]=='2' || $_POST["mfile4"]=='2' || $_POST["mfile5"]=='2' || $_POST["mfile6"]=='2' || $_POST["mfile7"]=='2' || $_POST["mfile8"]=='2' || $_POST["mfile9"]=='2' || $_POST["mfile10"]=='2' || $_POST["mfile11"]=='2' || $_POST["mfile12"]=='2'|| $_POST["mfile13"]=='2' || $_POST["mfile1"]=='3' || $_POST["mfile2"]=='3' || $_POST["mfile3"]=='3' || $_POST["mfile4"]=='3' || $_POST["mfile5"]=='3' || $_POST["mfile6"]=='3' || $_POST["mfile7"]=='3' || $_POST["mfile8"]=='3' || $_POST["mfile9"]=='3' || $_POST["mfile10"]=='3' || $_POST["mfile11"]=='3' || $_POST["mfile12"]=='3'|| $_POST["mfile13"]=='3')
			{
				echo "<script>
					alert('Error in file / You didnot select any option.');
					window.location.href = 'dic_form3.php?tab=3';
				</script>";
			}
			else {		
			$file1=clean($_POST["mfile1"]);
			$file2=clean($_POST["mfile2"]);
			$file3=clean($_POST["mfile3"]);
			$file4=clean($_POST["mfile4"]);
			$file5=clean($_POST["mfile5"]);
			$file6=clean($_POST["mfile6"]);
			$file7=clean($_POST["mfile7"]);
			$file8=clean($_POST["mfile8"]);
			$file9=clean($_POST["mfile9"]);
			$file10=clean($_POST["mfile10"]);
			$file11=clean($_POST["mfile11"]);
			$file12=clean($_POST["mfile12"]);
			$file13=clean($_POST["mfile13"]);
			
			$sql=$dic->query("select form_id from dic_form3 where user_id='$swr_id' and active='1'")or die("Error :". $dic->error);		
			if($sql->num_rows<1){				
				echo "<script>
					alert('Please fill the first part of the form.');
					window.location.href = 'dic_form3.php';
				</script>";
			}else{
				$row=$sql->fetch_array();
				$form_id=$row["form_id"];
				$savequery=$dic->query("update dic_form3 set file1='$file1', file2='$file2', file3='$file3', file4='$file4',file5='$file5', file6='$file6',file7='$file7', file8='$file8', file9='$file9', file10='$file10',file11='$file11', file12='$file12', file13='$file13' where form_id='$form_id'") or die($dic->error);
			}	
			if($savequery){
				$formFunctions->file_update($file1);$formFunctions->file_update($file2);$formFunctions->file_update($file3);$formFunctions->file_update($file4);$formFunctions->file_update($file5);$formFunctions->file_update($file6);$formFunctions->file_update($file7);$formFunctions->file_update($file8);$formFunctions->file_update($file9);$formFunctions->file_update($file10);$formFunctions->file_update($file11);$formFunctions->file_update($file12);$formFunctions->file_update($file13);

				if($file1=="SC" || $file2=="SC" ||  $file3=="SC" ||  $file4=="SC"||  $file5=="SC" ||  $file6=="SC" || $file7=="SC" || $file8=="SC" ||  $file9=="SC" ||  $file10=="SC"||  $file11=="SC" ||  $file12=="SC"||  $file13=="SC" ){
					$save_query=$dic->query("update dic_form3 set courier_details='1', sub_date='$today' where form_id='$form_id'") or die($dic->error);
				}else{
						$courier_details=NULL;
						$save_query=$dic->query("update dic_form3 set sub_date='$today',courier_details='$courier_details' where form_id='$form_id'") or die($dic->error);
					}
					if($save_query){
							echo "<script>
								alert('Successfully Saved....');
								window.location.href = 'preview.php?token=3';
							</script>";
						}else{
							echo "<script>
								alert('Something went wrong !!!');
								window.location.href ='dic_form3.php?tab=3';
							</script>";
						}			
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href ='dic_form3.php?tab=3';
				</script>";
			}
		} 
}
if(isset($_POST["proceed3"])){
	$query=$dic->query("select form_id,save_mode,courier_details from dic_form3 where user_id='$swr_id' and active='1'") or die("Error :". $dic->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'dic_form3.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'dic','3');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$dic->query("update dic_form3 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($dic->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=dic&form=3';
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
			$dept_email="esgoa.dic@gmail.com";
			require_once "dic_form3_print.php"; 
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
					window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=3&dept=dic';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'dic_form3.php';
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
if(isset($_POST["save4a"])){		
	$ack_no=clean($_POST["ack_no"]);$ack_date=clean($_POST["ack_date"]);
	
	$nature=clean($_POST["nature"]);$ancillary=clean($_POST["ancillary"]);$installation_date=clean($_POST["installation_date"]);$fact_act=clean($_POST["fact_act"]);$area_r=clean($_POST["area_r"]);
	$ack_date=date("Y-m-d",strtotime($ack_date));
	
	$sql=$dic->query("select form_id from dic_form4 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$save_query=$dic->query("insert into dic_form4(user_id,sub_date,ack_no,ack_date,nature,ancillary,installation_date,fact_act,area_r) values ('$swr_id','$today', '$ack_no', '$ack_date','$nature', '$ancillary', '$installation_date', '$fact_act', '$area_r')") OR die("Error: ".$dic->error);
	}else{
		$form_id=$row["form_id"];
		$save_query=$dic->query("update dic_form4 set ack_no='$ack_no',ack_date='$ack_date',nature='$nature',ancillary='$ancillary',installation_date='$installation_date',fact_act='$fact_act',area_r='$area_r' where form_id='$form_id'") or die($dic->error);
	}				
	if($save_query){		
		$formFunctions->insert_incomplete_forms('dic','4'); //dic-- dept name and 4 -- form no
		echo "<script>
			alert('Successfully saved.');
			window.location.href = 'dic_form4.php?tab=2';
		</script>";			
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'dic_form4.php';
		</script>";
	}			
}
if(isset($_POST["save4b"])){		
	$cat_enter=clean($_POST["cat_enter"]);$input_size=$_POST["hiddenval"];$input_size2=$_POST["hiddenval2"];
	if(!empty($_POST["manuf"]))	 $manuf=json_encode($_POST["manuf"]);
	else	$manuf=NULL;
	if(!empty($_POST["fixed_asset"]))	 $fixed_asset=json_encode($_POST["fixed_asset"]);
	else	$type=NULL;
	if(!empty($_POST["power"]))	 $power=json_encode($_POST["power"]);
	else	$power=NULL;
	if(!empty($_POST["source"]))	 $source=json_encode($_POST["source"]);
	else	$source=NULL;
	
	$sql=$dic->query("select form_id from dic_form4 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		echo "<script>
			alert('Invalid Page Access !!!');
			window.location.href = 'dic_form4.php';
		</script>";
	}else{
		$form_id=$row["form_id"];	
		$query=$dic->query("update dic_form4 set sub_date='$today', cat_enter='$cat_enter', manuf='$manuf', fixed_asset='$fixed_asset', power='$power' , source='$source' where form_id=$form_id") OR die("Error: ".$dic->error);
	}	
	if($query){
			if($input_size!=0){					
				$k=$dic->query("delete from dic_form4_t1 where form_id='$form_id'");
				for($i=1;$i<$input_size;$i++){
					//$vala=$_POST["txtA".$i];		
					$valb=$_POST["txtB".$i];
					$valc=$_POST["txtC".$i];
					$vald=$_POST["txtD".$i];
					$vale=$_POST["txtE".$i];
					$part1=$dic->query("INSERT INTO dic_form4_t1(id,form_id,slno,name,code,quantity,unit) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')") or die("error in insertion dic_form4_t1".$dic->error);
				}
			}
			if($input_size2!=0){					
				$k=$dic->query("delete from dic_form4_t2 where form_id='$form_id'");
				for($i=1;$i<$input_size2;$i++){
				//$vala=$_POST["textA".$i];			
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$vald=$_POST["textD".$i];			
				$part2=$dic->query("INSERT INTO dic_form4_t2(id,form_id,slno,name,quantity,unit) VALUES ('','$form_id','$i','$valb','$valc','$vald')") or die($dic->error);
				}
			}
			echo "<script>
				alert('Sucessfully Saved...');
				window.location.href = 'dic_form4.php?tab=3';
			</script>";		
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'dic_form4.php?tab=2';
			</script>";
		}
	}				
if(isset($_POST["save4c"])){		
	$annual_rupees=clean($_POST["annual_rupees"]);$export_rupees=clean($_POST["export_rupees"]);$expect_date=clean($_POST["expect_date"]);$is_unit_computer=clean($_POST["is_unit_computer"]);
	$hidden_value=clean($_POST["hidden_value"]);
	if(!empty($_POST["expected"]))	 $expected=json_encode($_POST["expected"]);
	else	$expected=NULL;

	$sql=$dic->query("select form_id from dic_form4 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		echo "<script>
			alert('Please fill up the first part of the form !!!');
			window.location.href = 'dic_form4.php';
		</script>"; 
	}else{
		$form_id=$row["form_id"];	
		$query=$dic->query("update dic_form4 set sub_date='$today', annual_rupees='$annual_rupees',export_rupees='$export_rupees',expected='$expected',expect_date='$expect_date',is_unit_computer='$is_unit_computer' where form_id='$form_id'") OR die("Error: ".$dic->error);
		$k=$dic->query("select id from dic_form4_members where form_id='$form_id'");
		if($k->num_rows>0){
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$gender=$_POST["gender".$i.""];$edu=$_POST["edu".$i.""];$caste=$_POST["caste".$i.""];$equity_rs=$_POST["equity_rs".$i.""];$equity_per=$_POST["equity_per".$i.""];$is_stack=$_POST["is_stack".$i.""];
			
				$query1=$dic->query("update dic_form4_members set name='$name',gender='$gender',caste='$caste',edu='$edu',equity_rs='$equity_rs',equity_per='$equity_per',is_stack='$is_stack' where form_id='$form_id' and slno='$i'") or die($dic->error);
			}
		}else{
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$gender=$_POST["gender".$i.""];$edu=$_POST["edu".$i.""];$caste=$_POST["caste".$i.""];$equity_rs=$_POST["equity_rs".$i.""];$equity_per=$_POST["equity_per".$i.""];$is_stack=$_POST["is_stack".$i.""];
			
				$query1=$dic->query("INSERT INTO dic_form4_members(id,form_id,slno,name,gender,caste,edu,equity_rs,equity_per,is_stack) VALUES ('','$form_id','$i','$name','$gender','$caste','$edu','$equity_rs','$equity_per','$is_stack')") or die($dic->error);
			}
		}
			
	}			
	if($query){
		echo "<script>
			alert('Successfully saved.');
			window.location.href = 'dic_form4.php?tab=4';
		</script>";			
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'dic_form4.php?tab=3';
		</script>";
	}			
}				
if(isset($_POST["save4d"])){		
	if(empty($_POST["mfile1"]) || empty($_POST["mfile2"]) || empty($_POST["mfile3"]) || empty($_POST["mfile4"]) || $_POST["mfile1"]=='2' || $_POST["mfile2"]=='2' || $_POST["mfile3"]=='2' || $_POST["mfile4"]=='2' || $_POST["mfile1"]=='3' || $_POST["mfile2"]=='3' || $_POST["mfile3"]=='3' || $_POST["mfile4"]=='3'){
		echo "<script>
			alert('Error in file / You didnot select any option.');
			window.location.href = 'dic_form4.php?tab=4';
		</script>";
	}else{		
		$file1=clean($_POST["mfile1"]);
		$file2=clean($_POST["mfile2"]);
		$file3=clean($_POST["mfile3"]);
		$file4=clean($_POST["mfile4"]);
		
		$sql=$dic->query("select form_id from dic_form4 where user_id='$swr_id' and active='1'")or die("Error :". $dic->error);		
		if($sql->num_rows<1){				
			echo "<script>
				alert('Please fill the first part of the form.');
				window.location.href = 'dic_form4.php';
			</script>";
		}else{
			$row=$sql->fetch_array();
			$form_id=$row["form_id"];
			$savequery=$dic->query("update dic_form4 set file1='$file1', file2='$file2', file3='$file3', file4='$file4' where form_id='$form_id'") or die($dic->error);
		}	
		if($savequery){
			$formFunctions->file_update($file1);$formFunctions->file_update($file2);$formFunctions->file_update($file3);$formFunctions->file_update($file4);

			if($file1=="SC" || $file2=="SC" ||  $file3=="SC" ||  $file4=="SC"){
				$save_query=$dic->query("update dic_form4 set courier_details='1', sub_date='$today' where form_id='$form_id'") or die($dic->error);
			}else{
				$courier_details=NULL;
				$save_query=$dic->query("update dic_form4 set sub_date='$today',courier_details='$courier_details' where form_id='$form_id'") or die($dic->error);
			}
			if($save_query){
				echo "<script>
					alert('Successfully Saved....');
					window.location.href = 'preview.php?token=4';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href ='dic_form4.php?tab=4';
				</script>";
			}			
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href ='dic_form4.php?tab=4';
			</script>";
		}
	} 
}
if(isset($_POST["proceed4"])){
	$query=$dic->query("select form_id,save_mode,courier_details from dic_form4 where user_id='$swr_id' and active='1'") or die("Error :". $dic->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'dic_form4.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'dic','4');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$dic->query("update dic_form4 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($dic->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=dic&form=4';
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
			$dept_email="esgoa.dic@gmail.com";
			require_once "dic_form4_print.php"; 
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
					window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=4&dept=dic';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'dic_form4.php';
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
	$hidden_value=clean($_POST["hidden_value"]);$is_implementaion=clean($_POST["is_implementaion"]);$is_owned=clean($_POST["is_owned"]);$area_sq_mtr=clean($_POST["area_sq_mtr"]);$area_project=clean($_POST["area_project"]);$location=clean($_POST["location"]);
	
	if(!empty($_POST["act"])) $act=json_encode($_POST["act"]);else $act=NULL;		
	if(!empty($_POST["provisional"])) $provisional=json_encode($_POST["provisional"]);else $provisional=NULL;
	if(!empty($_POST["permanent"])) $permanent=json_encode($_POST["permanent"]);else $permanent=NULL;
	if(!empty($_POST["indus"])) $indus=json_encode($_POST["indus"]);else $indus=NULL;
	if(!empty($_POST["consultant"])) $consultant=json_encode($_POST["consultant"]);else $consultant=NULL;
	if(!empty($_POST["organization"])) $organization=json_encode($_POST["organization"]);else $organization=NULL;
	if(!empty($_POST["detail_l"])) $detail_l=json_encode($_POST["detail_l"]);else $organization=NULL;
	$sql=$dic->query("select form_id from dic_form5 where user_id='$swr_id' and active='1'") or die("Error :". $dic->error);
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$dic->query("insert into dic_form5(user_id,act,provisional,permanent,indus,consultant,organization,is_implementaion,is_owned,area_sq_mtr,area_project,location,detail_l) values('$swr_id','$act','$provisional','$permanent','$indus','$consultant','$organization','$is_implementaion','$is_owned','$area_sq_mtr','$area_project','$location','$detail_l')")OR die("Error: ".$dic->error);
		$form_id=$dic->insert_id;
		//$k=$dic->query("delete from dic_form5_members where form_id='$form_id'");
		for($i=1;$i<=$hidden_value;$i++){
			$name=$_POST["name".$i.""];$sn1=$_POST["sn1".$i.""];$sn2=$_POST["sn2".$i.""];$vill=$_POST["vill".$i.""];$dist=$_POST["dist".$i.""];$pin=$_POST["pin".$i.""];$pan=$_POST["pan".$i.""];
			
			$query1=$dic->query("INSERT INTO dic_form5_members(id,form_id,sl_no,name,sn1,sn2,vill,dist,pin,pan) VALUES ('','$form_id','$i','$name','$sn1','$sn2','$vill','$dist','$pin','$pan')") or die("Error".$dic->error);
		}
		
	}else{
		$form_id=$row["form_id"];
		$query=$dic->query("UPDATE dic_form5 SET  sub_date='$today',act='$act',provisional='$provisional',permanent='$permanent',indus='$indus',consultant='$consultant',organization='$organization',is_implementaion='$is_implementaion',is_owned='$is_owned',area_sq_mtr='$area_sq_mtr',area_project='$area_project',location='$location',detail_l='$detail_l' WHERE user_id='$swr_id' AND form_id='$form_id'") OR die("Error: ".$dic->error);	
		for($i=1;$i<=$hidden_value;$i++){ 
			$name=$_POST["name".$i.""];$sn1=$_POST["sn1".$i.""];$sn2=$_POST["sn2".$i.""];$vill=$_POST["vill".$i.""];$dist=$_POST["dist".$i.""];$pin=$_POST["pin".$i.""];$pan=$_POST["pan".$i.""];
			
			$query1=$dic->query("update dic_form5_members set name='$name',sn1='$sn1',sn2='$sn2',vill='$vill',dist='$dist',pin='$pin',pan='$pan' where form_id='$form_id' and sl_no='$i'") or die("Error".$dic->error);
		}
	}	
	if($query){
			
			$formFunctions->insert_incomplete_forms('dic','5'); //dic-- dept name and 5 -- form no
			echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'dic_form5.php?tab=2';
			</script>";
	}else{
			echo "<script>
				alert('Invalid Entry');
				window.location.href = 'dic_form5.php';
			</script>";
	}
}
if(isset($_POST["save5b"])){
	$no_purchase_deed=clean($_POST["no_purchase_deed"]);$reg_purchase_deed=clean($_POST["reg_purchase_deed"]);$premium=clean($_POST["premium"]);$date_possesion=clean($_POST["date_possesion"]);$lease_duration=clean($_POST["lease_duration"]);$start_date_civconstruct=clean($_POST["start_date_civconstruct"]);$end_date_civconstruct=clean($_POST["end_date_civconstruct"]);$tot_area_underconstruct=clean($_POST["tot_area_underconstruct"]);$tot_cost_construct=clean($_POST["tot_cost_construct"]);$cost_manufacturing=clean($_POST["cost_manufacturing"]);$agency_area_covered=clean($_POST["agency_area_covered"]);$agency_annual_rent=clean($_POST["agency_annual_rent"]);$agency_regnum=clean($_POST["agency_regnum"]);$agency_regdate=clean($_POST["agency_regdate"]);$agency_loc=clean($_POST["agency_loc"]);$agency_lease_period=clean($_POST["agency_lease_period"]);$capital_invest_total=clean($_POST["capital_invest_total"]);
	
	if(!empty($_POST["reg_auth"])) $reg_auth=json_encode($_POST["reg_auth"]);else $reg_auth=NULL;
	if(!empty($_POST["owner"])) $owner=json_encode($_POST["owner"]);else $owner=NULL;		
	if(!empty($_POST["rent_auth"])) $rent_auth=json_encode($_POST["rent_auth"]);else $rent_auth=NULL;		
	if(!empty($_POST["agency"])) $agency=json_encode($_POST["agency"]);else $agency=NULL;		
	if(!empty($_POST["capital_invest"])) $capital_invest=json_encode($_POST["capital_invest"]);else $capital_invest=NULL;		
	
	$sql=$dic->query("select form_id from dic_form5 where user_id='$swr_id' and active='1'") or die("Error :". $dic->error);
	$row=$sql->fetch_array();
	if($sql->num_rows<1){
		$query=$dic->query("insert into dic_form5(user_id,owner,no_purchase_deed,reg_purchase_deed,reg_auth,premium,date_possesion,lease_duration,start_date_civconstruct,end_date_civconstruct,tot_area_underconstruct,tot_cost_construct,cost_manufacturing,agency,agency_area_covered,agency_annual_rent,agency_regnum,agency_regdate,rent_auth,agency_loc,agency_lease_period,capital_invest,capital_invest_total) values('$swr_id','$owner','$no_purchase_deed','$reg_purchase_deed','$reg_auth','$premium','$date_possesion','$lease_duration','$start_date_civconstruct','$end_date_civconstruct','$tot_area_underconstruct','$tot_cost_construct','$cost_manufacturing','$agency','$agency_area_covered','$agency_annual_rent','$agency_regnum','$agency_regdate','$rent_auth','$agency_loc','$agency_lease_period','$capital_invest','$capital_invest_total')") OR die("Error: ".$dic->error);
	}else{
		$form_id=$row["form_id"];
		$query=$dic->query("UPDATE dic_form5 SET  sub_date='$today', owner='$owner',no_purchase_deed='$no_purchase_deed',reg_purchase_deed='$reg_purchase_deed',reg_auth='$reg_auth',premium='$premium',date_possesion='$date_possesion',lease_duration='$lease_duration',start_date_civconstruct='$start_date_civconstruct',end_date_civconstruct='$end_date_civconstruct',tot_area_underconstruct='$tot_area_underconstruct',tot_cost_construct='$tot_cost_construct',cost_manufacturing='$cost_manufacturing',agency='$agency',agency_area_covered='$agency_area_covered',agency_annual_rent='$agency_annual_rent',agency_regnum='$agency_regnum',agency_regdate='$agency_regdate',rent_auth='$rent_auth',agency_loc='$agency_loc',agency_lease_period='$agency_lease_period',capital_invest='$capital_invest',capital_invest_total='$capital_invest_total' WHERE user_id='$swr_id' AND form_id='$form_id'") OR die("Error: ".$dic->error);	
	}
	if($query){
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = 'dic_form5.php?tab=3';
		</script>";
	}else{
		echo "<script>
			alert('Invalid Entry');
			window.location.href = 'dic_form5.php?tab=2';
		</script>";
	}
}
if(isset($_POST["save5c"])){
	
	$sources_f_finance_total=clean($_POST["sources_f_finance_total"]);$pow_line_expen=clean($_POST["pow_line_expen"]);$dg_details=clean($_POST["dg_details"]);$dg_make=clean($_POST["dg_make"]);$dg_rating=clean($_POST["dg_rating"]);$cost_of_dgset=clean($_POST["cost_of_dgset"]);$installation_date=clean($_POST["installation_date"]);$date_comm_prod=clean($_POST["date_comm_prod"]);
	
	if(!empty($_POST["sources_f_finance"])) $sources_f_finance=json_encode($_POST["sources_f_finance"]);else $sources_f_finance=NULL;		
	if(!empty($_POST["financial_details"])) $financial_details=json_encode($_POST["financial_details"]);else $financial_details=NULL;
	if(!empty($_POST["details_f_power"])) $details_f_power=json_encode($_POST["details_f_power"]);else $details_f_power=NULL;
	if(!empty($_POST["aseb"])) $aseb=json_encode($_POST["aseb"]);else $aseb=NULL;
	$sql=$dic->query("select form_id from dic_form5 where user_id='$swr_id' and active='1'") or die("Error :". $dic->error);
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		echo "<script>
			alert('Please fill up the first part of the form !!!');
			window.location.href = 'dic_form5.php';
		</script>";
	}else{		
		$form_id=$row["form_id"];
		$sql1=$dic->query("select id from dic_form5_part1 where form_id='$form_id'") or die("Error :". $dic->error);
		$row1=$sql1->fetch_array();
		if($sql1->num_rows<1){   ////////////table is empty//////////////
			$query=$dic->query("insert into dic_form5_part1(form_id,sources_f_finance,sources_f_finance_total,financial_details,details_f_power,aseb,pow_line_expen,dg_details,dg_make,dg_rating,cost_of_dgset,installation_date,date_comm_prod) values('$form_id','$sources_f_finance','$sources_f_finance_total','$financial_details','$details_f_power','$aseb','$pow_line_expen','$dg_details','$dg_make','$dg_rating','$cost_of_dgset','$installation_date','$date_comm_prod')") OR die("Error: ".$dic->error);	
		}else{
			$query=$dic->query("UPDATE dic_form5_part1 SET sources_f_finance='$sources_f_finance',sources_f_finance_total='$sources_f_finance_total',financial_details='$financial_details',details_f_power='$details_f_power',aseb='$aseb',pow_line_expen='$pow_line_expen',dg_details='$dg_details',dg_make='$dg_make',dg_rating='$dg_rating',cost_of_dgset='$cost_of_dgset',installation_date='$installation_date',date_comm_prod='$date_comm_prod' WHERE form_id='$form_id'") OR die("Error: ".$dic->error);	
		}		
	}	
	if($query){
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = 'dic_form5.php?tab=4';
		</script>";
	}else{
		echo "<script>
			alert('Invalid Entry');
			window.location.href = 'dic_form5.php?tab=3';
		</script>";
	}
}
if(isset($_POST["save5d"])){ 
	$details_prod=clean($_POST["details_prod"]);$input_size1=clean($_POST["hiddenval"]);$input_size2=clean($_POST["hiddenval2"]);$input_size3=clean($_POST["hiddenval3"]);$input_size4=clean($_POST["hiddenval4"]);$input_size4=clean($_POST["hiddenval4"]);$input_size5=clean($_POST["hiddenval5"]);$total_assam=clean($_POST["total_assam"]);$total_outsiders=clean($_POST["total_outsiders"]);$gross_total=clean($_POST["gross_total"]);$gross_remarks=clean($_POST["gross_remarks"]);$utilized_mandays=clean($_POST["utilized_mandays"]);
	
	if(!empty($_POST["managerial"])) $managerial=json_encode($_POST["managerial"]);else $managerial=NULL;		
	if(!empty($_POST["supervisory"])) $supervisory=json_encode($_POST["supervisory"]);else $supervisory=NULL;
	if(!empty($_POST["skilled"])) $skilled=json_encode($_POST["skilled"]);else $skilled=NULL;
	if(!empty($_POST["semi_skilled"])) $semi_skilled=json_encode($_POST["semi_skilled"]);else $semi_skilled=NULL;
	if(!empty($_POST["unskilled"])) $unskilled=json_encode($_POST["unskilled"]);else $unskilled=NULL;
	
	$sql=$dic->query("select form_id from dic_form5_part1 where user_id='$swr_id' and active='1'") or die("Error :". $dic->error);
	$row=$sql->fetch_array();
	if($sql->num_rows<1){  ////////////table is empty//////////////
		$query=$dic->query("insert into dic_form5_part1(user_id,details_prod,managerial,supervisory,skilled,semi_skilled,unskilled,total_assam,total_outsiders,gross_total,gross_remarks,utilized_mandays) values('$swr_id','$details_prod','$managerial','$supervisory','$skilled','$semi_skilled','$unskilled','$total_assam','$total_outsiders','$gross_total','$gross_remarks','$utilized_mandays')")OR die("Error: ".$dic->error);
		$form_id=$dic->insert_id;
	}else{
		$form_id=$row["form_id"];
		$query=$dic->query("UPDATE dic_form5_part1 SET  sub_date='$today', details_prod='$details_prod',managerial='$managerial',supervisory='$supervisory',skilled='$skilled',semi_skilled='$semi_skilled',unskilled='$unskilled',total_assam='$total_assam',total_outsiders='$total_outsiders',gross_total='$gross_total',gross_remarks='$gross_remarks',utilized_mandays='$utilized_mandays' WHERE user_id='$swr_id' AND form_id='$form_id'") OR die("Error: ".$dic->error);	
	}	
	if($query){
		if($input_size1!=0){					
		$k=$dic->query("delete from dic_form5_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size1;$i++){
				//$vala=$_POST["txtA".$i];	
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$valf=$_POST["txtF".$i];
				$valg=$_POST["txtG".$i];
				$part1=$dic->query("INSERT INTO dic_form5_t1(id,form_id,slno,items,annual_quantity,annual_rupees,actual_quantity,actual_rupees,remark) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg')") or die($dic->error);
			}
		}
		if($input_size2!=0){					
		$k=$dic->query("delete from dic_form5_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				//$vala=$_POST["textA".$i];	
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$vald=$_POST["textD".$i];	
				$vale=$_POST["textE".$i];	
				$valf=$_POST["textF".$i];	
				$valg=$_POST["textG".$i];	
				$part2=$dic->query("INSERT INTO dic_form5_t2(id,form_id,slno,items,annual_quantity,annual_rupees,utlised_quantity,utlised_rupees,remark) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg')") or die($dic->error);
			}
		}
		if($input_size3!=0){					
		$k=$dic->query("delete from dic_form5_t3 where form_id='$form_id'");
			for($i=1;$i<$input_size3;$i++){
				//$vala=$_POST["txxtA".$i];		
				$valb=$_POST["txxtB".$i];
				$valc=$_POST["txxtC".$i];
				$vald=$_POST["txxtD".$i];				
				$vale=$_POST["txxtE".$i];				
				$part3=$dic->query("INSERT INTO dic_form5_t3(id,form_id,slno,item,source,name,address) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')") or die($dic->error);
			}
		}
		if($input_size4!=0){					
		$k=$dic->query("delete from dic_form5_t4 where form_id='$form_id'");
			for($i=1;$i<$input_size4;$i++){
				//$vala=$_POST["txttA".$i];		
				$valb=$_POST["txttB".$i];
				$valc=$_POST["txttC".$i];
				$vald=$_POST["txttD".$i];				
				$vale=$_POST["txttE".$i];			
				$valf=$_POST["txttF".$i];				
				$valg=$_POST["txttG".$i];				
				$part4=$dic->query("INSERT INTO dic_form5_t4(id,form_id,slno,item,within_assam_quantity,within_assam_rupees,outside_assam_quantity,outside_assam_rupees,remarks) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg')") or die($dic->error);
			}
		}
		if($input_size5!=0){					
		$k=$dic->query("delete from dic_form5_t5 where form_id='$form_id'");
			for($i=1;$i<$input_size5;$i++){
				//$vala=$_POST["ttxtA".$i];		
				$valb=$_POST["ttxtB".$i];
				$valc=$_POST["ttxtC".$i];				
				$part5=$dic->query("INSERT INTO dic_form5_t5(id,form_id,slno,name,quantity) VALUES ('','$form_id','$i','$valb','$valc')") or die($dic->error);
			}
		}
		if(isset($part1) && $part1==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'dic_form5.php?tab=4';
			</script>";
		}else if(isset($part2) && $part2==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'dic_form5.php?tab=4';
			</script>";
		}else if(isset($part3) && $part3==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'dic_form5.php?tab=4';
			</script>";
		}else if(isset($part4) && $part4==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'dic_form4.php?tab=4';
			</script>";
		}else if(isset($part5) && $part5==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'dic_form5.php?tab=4';
			</script>";
		}else{
			 echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'preview.php?token=5';
			</script>";
			}	
	}else{
		   echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'dic_form5.php?tab=3';
			   </script>";
		}	
}
if(isset($_POST["proceed5"])) {
	$query=$dic->query("select form_id,save_mode,courier_details from dic_form5 where user_id='$swr_id' and active='1'") or die("Error :". $dic->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'dic_form5.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'dic','5');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$dic->query("update dic_form5 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($dic->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=dic&form=5';
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
			$dept_email="esgoa.dic@gmail.com";
			require_once "dic_form5_print.php"; 
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
					window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=5&dept=dic';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'dic_form5.php?tab=4';
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
if(isset($_POST["save6a"])){		
	$office_mob=clean($_POST["office_mob"]);$office_email=clean($_POST["office_email"]);$hidden_value=clean($_POST["hidden_value"]);

	if(!empty($_POST["act"])) $act=json_encode($_POST["act"]);else $act=NULL;		
	if(!empty($_POST["provisional"])) $provisional=json_encode($_POST["provisional"]);else $provisional=NULL;
	if(!empty($_POST["permanent"])) $permanent=json_encode($_POST["permanent"]);else $permanent=NULL;
	if(!empty($_POST["indus"])) $indus=json_encode($_POST["indus"]);else $indus=NULL;
	$sql=$dic->query("select form_id from dic_form6 where user_id='$swr_id' and active='1'") or die("Error :". $dic->error);
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$dic->query("insert into dic_form6(user_id,office_mob,office_email,act,provisional,permanent,indus) values('$swr_id','$office_mob','$office_email','$act','$provisional','$permanent','$indus')") or die("Error: ".$dic->error);
		$form_id=$dic->insert_id;
		$k=$dic->query("delete from dic_form6_members where form_id='$form_id'");
		for($i=1;$i<=$hidden_value;$i++){
			$name=$_POST["name".$i.""];$sn1=$_POST["sn1".$i.""];$sn2=$_POST["sn2".$i.""];$vill=$_POST["vill".$i.""];$dist=$_POST["dist".$i.""];$pin=$_POST["pin".$i.""];$pan=$_POST["pan".$i.""];
			
			$query1=$dic->query("INSERT INTO dic_form6_members(id,form_id,sl_no,name,sn1,sn2,vill,dist,pin,pan) VALUES ('','$form_id','$i','$name','$sn1','$sn2','$vill','$dist','$pin','$pan')") or die($dic->error);
		}
		$query2=$dic->query("insert into dic_form6_part1(form_id) values('$form_id')") or die("Error: ".$dic->error);
		$query3=$dic->query("insert into dic_form6_upload(form_id) values('$form_id')") or die("Error: ".$dic->error);
	}else{
		$form_id=$row["form_id"];
		$query=$dic->query("UPDATE dic_form6 SET  sub_date='$today', office_mob='$office_mob',office_email='$office_email',act='$act',provisional='$provisional',permanent='$permanent',indus='$indus' WHERE form_id='$form_id'") OR die("Error: ".$dic->error);	
		for($i=1;$i<=$hidden_value;$i++){
			$name=$_POST["name".$i.""];$sn1=$_POST["sn1".$i.""];$sn2=$_POST["sn2".$i.""];$vill=$_POST["vill".$i.""];$dist=$_POST["dist".$i.""];$pin=$_POST["pin".$i.""];$pan=$_POST["pan".$i.""];
			
			$query1=$dic->query("UPDATE  dic_form6_members set name='$name',sn1='$sn1',sn2='$sn2',vill='$vill',dist='$dist',pin='$pin',pan='$pan' where form_id='$form_id' and sl_no='$i'") or die($dic->error);
		}
	}
	if($query==true && $query1==true){
			
			$formFunctions->insert_incomplete_forms('dic','6'); //dic-- dept name and 1 -- form no
			echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'dic_form6.php?tab=2';
			</script>";
		}
		else
		{
			echo "<script>
				alert('Invalid Entry');
				window.location.href = 'dic_form6.php?tab=1';
			</script>";
		}
}
if(isset($_POST["save6b"])){		
	$intimation_letter_no=clean($_POST["intimation_letter_no"]);$intimation_date=clean($_POST["intimation_date"]);$note_substantial=clean($_POST["note_substantial"]);$ec_no=clean($_POST["ec_no"]);$ec_date=clean($_POST["ec_date"]);$land_owned=clean($_POST["land_owned"]);$total_area=clean($_POST["total_area"]);$area_under_use=clean($_POST["area_under_use"]);$area_loc=clean($_POST["area_loc"]);$no_pur_deed=clean($_POST["no_pur_deed"]);$dor_pur_deed=clean($_POST["dor_pur_deed"]);$pur_price=clean($_POST["pur_price"]);$pur_reg_fee=clean($_POST["pur_reg_fee"]);$stamp_duty=clean($_POST["stamp_duty"]);$date_possesion=clean($_POST["date_possesion"]);$lease_from=clean($_POST["lease_from"]);$lease_to=clean($_POST["lease_to"]);
	
	if(!empty($_POST["consultant"])) $consultant=json_encode($_POST["consultant"]);else $consultant=NULL;
	if(!empty($_POST["land_detail"])) $land_detail=json_encode($_POST["land_detail"]);else $land_detail=NULL;
	if(!empty($_POST["land_owner"])) $land_owner=json_encode($_POST["land_owner"]);else $land_owner=NULL;
	if(!empty($_POST["auth"])) $auth=json_encode($_POST["auth"]);else $auth=NULL;
	$sql=$dic->query("select form_id from dic_form6 where user_id='$swr_id' and active='1'") or die("Error :". $dic->error);
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		echo "<script>
			alert('Please Fill up the first part of the form .');
			window.location.href = 'dic_form6.php';
		</script>";
	}else{		
		$form_id=$row["form_id"];
		$query=$dic->query("UPDATE dic_form6 SET  sub_date='$today', intimation_letter_no='$intimation_letter_no',intimation_date='$intimation_date',note_substantial='$note_substantial',consultant='$consultant',ec_no='$ec_no',ec_date='$ec_date',land_owned='$land_owned',total_area='$total_area',area_under_use='$area_under_use',area_loc='$area_loc',land_detail='$land_detail',land_owner='$land_owner',no_pur_deed='$no_pur_deed',dor_pur_deed='$dor_pur_deed',auth='$auth',pur_price='$pur_price',pur_reg_fee='$pur_reg_fee',stamp_duty='$stamp_duty',date_possesion='$date_possesion',lease_from='$lease_from',lease_to='$lease_to' WHERE form_id='$form_id'") OR die("Error: ".$dic->error);	
	}	
	if($query){
			echo "<script>
			alert('Successfully Saved..');
			window.location.href = 'dic_form6.php?tab=3';
		</script>";
	}else{
			echo "<script>
			alert('Invalid Entry');
			window.location.href = 'dic_form6.php?tab=2';
		</script>";
	}
}
if(isset($_POST["save6c"])){		
	$tot_cov_area=clean($_POST["tot_cov_area"]);$ann_rent=clean($_POST["ann_rent"]);$build_loc=clean($_POST["build_loc"]);$total_f_coloumn=clean($_POST["total_f_coloumn"]);$total_fixed_capital=clean($_POST["total_fixed_capital"]);
	
	if(!empty($_POST["building_construction"])) $building_construction=json_encode($_POST["building_construction"]);
	else $building_construction=NULL;
	if(!empty($_POST["govt_agency"])) $govt_agency=json_encode($_POST["govt_agency"]);else $govt_agency=NULL;
	if(!empty($_POST["build_reg"])) $build_reg=json_encode($_POST["build_reg"]);else $build_reg=NULL;
	if(!empty($_POST["val_period"])) $val_period=json_encode($_POST["val_period"]);else $val_period=NULL;
	if(!empty($_POST["land"])) $land=json_encode($_POST["land"]);else $land=NULL;
	if(!empty($_POST["site"])) $site=json_encode($_POST["site"]);else $site=NULL;
	if(!empty($_POST["fact_direct"])) $fact_direct=json_encode($_POST["fact_direct"]);else $fact_direct=NULL;
	if(!empty($_POST["office_direct"])) $office_direct=json_encode($_POST["office_direct"]);else $office_direct=NULL;
	if(!empty($_POST["plant"])) $plant=json_encode($_POST["plant"]);else $plant=NULL;
	if(!empty($_POST["equip"])) $equip=json_encode($_POST["equip"]);else $equip=NULL;
	if(!empty($_POST["power"])) $power=json_encode($_POST["power"]);else $power=NULL;
	if(!empty($_POST["electrical"])) $electrical=json_encode($_POST["electrical"]);else $electrical=NULL;
	if(!empty($_POST["utility"])) $utility=json_encode($_POST["utility"]);else $utility=NULL;
	if(!empty($_POST["misc"])) $misc=json_encode($_POST["misc"]);else $misc=NULL;
	if(!empty($_POST["prelim"])) $prelim=json_encode($_POST["prelim"]);else $prelim=NULL;
	
	$sql=$dic->query("select form_id from dic_form6 where user_id='$swr_id' and active='1'") or die("Error :". $dic->error);
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		echo "<script>
			alert('Please Fill up the first part of the form .');
			window.location.href = 'dic_form6.php';
		</script>";
	}else{
		$form_id=$row["form_id"];
		$query=$dic->query("UPDATE dic_form6_part1 SET building_construction='$building_construction',govt_agency='$govt_agency',tot_cov_area='$tot_cov_area',ann_rent='$ann_rent',build_reg='$build_reg',build_loc='$build_loc',val_period='$val_period',land='$land',site='$site',fact_direct='$fact_direct',office_direct='$office_direct',plant='$plant',equip='$equip',power='$power',electrical='$electrical',utility='$utility',misc='$misc',prelim='$prelim',total_f_coloumn='$total_f_coloumn',total_fixed_capital='$total_fixed_capital' WHERE form_id='$form_id'") OR die("Error: ".$dic->error);	
	}
	if($query){
			echo "<script>
			alert('Successfully Saved..');
			window.location.href = 'dic_form6.php?tab=4';
		</script>";
	}else{
			echo "<script>
			alert('Invalid Entry');
			window.location.href = 'dic_form6.php?tab=3';
		</script>";
	}
}
if(isset($_POST["save6d"])){
	$total_contribution=clean($_POST["total_contribution"]);
	
	if(!empty($_POST["sources_f_finance"])) $sources_f_finance=json_encode($_POST["sources_f_finance"]); else $sources_f_finance=NULL;
	if(!empty($_POST["financial_ins"])) $financial_ins=json_encode($_POST["financial_ins"]); else $financial_ins=NULL;
	if(!empty($_POST["term"])) $term=json_encode($_POST["term"]);else $term=NULL;
	if(!empty($_POST["wc"])) $wc=json_encode($_POST["wc"]);else $wc=NULL;
	if(!empty($_POST["tl"])) $tl=json_encode($_POST["tl"]);else $tl=NULL;
	if(!empty($_POST["roi_tl"])) $roi_tl=json_encode($_POST["roi_tl"]);else $roi_tl=NULL;
	if(!empty($_POST["repayment"])) $repayment=json_encode($_POST["repayment"]);else $repayment=NULL;
	if(!empty($_POST["tl_amt"])) $tl_amt=json_encode($_POST["tl_amt"]);else $tl_amt=NULL;
	if(!empty($_POST["tl_date"])) $tl_date=json_encode($_POST["tl_date"]);else $tl_date=NULL;
	if(!empty($_POST["wor_cap"])) $wor_cap=json_encode($_POST["wor_cap"]);else $wor_cap=NULL;
	if(!empty($_POST["wor_dat"])) $wor_dat=json_encode($_POST["wor_dat"]);else $wor_dat=NULL;
	if(!empty($_POST["quant"])) $quant=json_encode($_POST["quant"]);else $quant=NULL;
	if(!empty($_POST["quant_let"])) $quant_let=json_encode($_POST["quant_let"]);else $quant_let=NULL;
	if(!empty($_POST["quant_dat"])) $quant_dat=json_encode($_POST["quant_dat"]);else $quant_dat=NULL;
	if(!empty($_POST["elec"])) $elec=json_encode($_POST["elec"]);else $elec=NULL;
	if(!empty($_POST["elec_dat"])) $elec_dat=json_encode($_POST["elec_dat"]);else $elec_dat=NULL;
	if(!empty($_POST["ser_en"])) $ser_en=json_encode($_POST["ser_en"]);else $ser_en=NULL;
	if(!empty($_POST["est_amt"])) $est_amt=json_encode($_POST["est_amt"]);else $est_amt=NULL;
	if(!empty($_POST["est_mr"])) $est_mr=json_encode($_POST["est_mr"]);else $est_mr=NULL;
	if(!empty($_POST["est_dat"])) $est_dat=json_encode($_POST["est_dat"]);else $est_dat=NULL;
	if(!empty($_POST["sub_expan"])) $sub_expan=json_encode($_POST["sub_expan"]);else $sub_expan=NULL;
	if(!empty($_POST["sub_dat"])) $sub_dat=json_encode($_POST["sub_dat"]);else $sub_dat=NULL;
	if(!empty($_POST["mr_subexpan"])) $mr_subexpan=json_encode($_POST["mr_subexpan"]);else $mr_subexpan=NULL;
	if(!empty($_POST["mr_subexpan_dat"])) $mr_subexpan_dat=json_encode($_POST["mr_subexpan_dat"]);else $mr_subexpan_dat=NULL;
	if(!empty($_POST["total_expenditure"])) $total_expenditure=json_encode($_POST["total_expenditure"]);else $total_expenditure=NULL;
	
	
	$sql=$dic->query("select form_id from dic_form6 where user_id='$swr_id' and active='1'") or die("Error :". $dic->error);
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		echo "<script>
			alert('Please Fill up the first part of the form .');
			window.location.href = 'dic_form6.php';
		</script>";
	}else{
		$form_id=$row["form_id"];
		$query=$dic->query("UPDATE dic_form6_part1 SET sources_f_finance='$sources_f_finance',total_contribution='$total_contribution', financial_ins='$financial_ins',term='$term',wc='$wc',tl='$tl',roi_tl='$roi_tl',repayment='$repayment',tl_amt='$tl_amt',tl_date='$tl_date',wor_cap='$wor_cap',wor_dat='$wor_dat', quant='$quant',quant_let='$quant_let',quant_dat='$quant_dat',elec='$elec',elec_dat='$elec_dat',ser_en='$ser_en',est_amt='$est_amt',est_mr='$est_mr',est_dat='$est_dat',sub_expan='$sub_expan',sub_dat='$sub_dat',mr_subexpan='$mr_subexpan',mr_subexpan_dat='$mr_subexpan_dat',total_expenditure='$total_expenditure' WHERE form_id='$form_id'") OR die("Error: ".$dic->error);	
	}
	if($query){
			echo "<script>
			alert('Successfully Saved..');
			window.location.href = 'dic_form6.php?tab=5';
		</script>";
	}else{
			echo "<script>
			alert('Invalid Entry');
			window.location.href = 'dic_form6.php?tab=4';
		</script>";
	}
}
if(isset($_POST["save6e"])){ 
	$bef_sub_expan=clean($_POST["bef_sub_expan"]);$after_sub_expan=clean($_POST["after_sub_expan"]);$input_size1=clean($_POST["hiddenval"]);$input_size2=clean($_POST["hiddenval2"]);$input_size3=clean($_POST["hiddenval3"]);$input_size4=clean($_POST["hiddenval4"]);$input_size5=clean($_POST["hiddenval5"]);$total_12d_prod=clean($_POST["total_12d_prod"]);
	
	$sql=$dic->query("select form_id from dic_form6 where user_id='$swr_id' and active='1'") or die("Error :". $dic->error);
	$row=$sql->fetch_array();
	if($sql->num_rows<1){  ////////////table is empty//////////////
		echo "<script>
			alert('Please fill up the first part of the form .');
			window.location.href = 'dic_form6.php';
		</script>";
	}else{
		$form_id=$row["form_id"];
		$query=$dic->query("UPDATE dic_form6_part1 SET bef_sub_expan='$bef_sub_expan',after_sub_expan='$after_sub_expan',total_12d_prod='$total_12d_prod' WHERE form_id='$form_id'") OR die("Error: ".$dic->error);	
	}	
	if($query){
		if($input_size1!=0){					
		$k=$dic->query("delete from dic_form6_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size1;$i++){
				//$vala=$_POST["txtA".$i];	
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$valf=$_POST["txtF".$i];
				$valg=$_POST["txtG".$i];
				$part1=$dic->query("INSERT INTO dic_form6_t1(id,form_id,slno,items,annual_quantity,annual_rupees,actual_quantity,actual_rupees,percentage) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg')") or die($dic->error);
			}
		}
		if($input_size2!=0){					
		$k=$dic->query("delete from dic_form6_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				//$vala=$_POST["textA".$i];	
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$vald=$_POST["textD".$i];	
				$vale=$_POST["textE".$i];	
				$valf=$_POST["textF".$i];	
				$valg=$_POST["textG".$i];	
				$part2=$dic->query("INSERT INTO dic_form6_t2(id,form_id,slno,items,annual_quantity,annual_rupees,actual_quantity,actual_rupees,percentage) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg')") or die($dic->error);
			}
		}
		if($input_size3!=0){					
		$k=$dic->query("delete from dic_form6_t3 where form_id='$form_id'");
			for($i=1;$i<$input_size3;$i++){
				//$vala=$_POST["txxtA".$i];		
				$valb=$_POST["txxtB".$i];
				$valc=$_POST["txxtC".$i];
				$vald=$_POST["txxtD".$i];				
				$vale=$_POST["txxtE".$i];				
				$part3=$dic->query("INSERT INTO dic_form6_t3(id,form_id,slno,items,physical_qty,cost_per_unit,total_value) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')") or die($dic->error);
			}
		}
		if($input_size4!=0){					
		$k=$dic->query("delete from dic_form6_t4 where form_id='$form_id'");
			for($i=1;$i<$input_size4;$i++){
				//$vala=$_POST["txttA".$i];		
				$valb=$_POST["txttB".$i];
				$valc=$_POST["txttC".$i];
				$vald=$_POST["txttD".$i];				
				$vale=$_POST["txttE".$i];							
				$part4=$dic->query("INSERT INTO dic_form6_t4(id,form_id,slno,items,physical_qty,cost_per_unit,total_value) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')") or die($dic->error);
			}
		}
		if($input_size5!=0){					
		$k=$dic->query("delete from dic_form6_t5 where form_id='$form_id'");
			for($i=1;$i<$input_size5;$i++){
				//$vala=$_POST["ttxtA".$i];		
				$valb=$_POST["ttxtB".$i];
				$valc=$_POST["ttxtC".$i];	
				$vald=$_POST["ttxtD".$i];	
				$vale=$_POST["ttxtE".$i];	
				$valf=$_POST["ttxtF".$i];				
				$valg=$_POST["ttxtG".$i];
				$part5=$dic->query("INSERT INTO dic_form6_t5(id,form_id,slno,items,actual_quantity,actual_rupees,utilise_quantity,utilise_rupees,remark) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg')") or die($dic->error);
			}
		}
		if((isset($part1) && $part1==false) || (isset($part2) && $part2==false) || (isset($part3) && $part3==false) || (isset($part4) && $part4==false) || (isset($part5) && $part5==false)){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'dic_form6.php?tab=5';
			</script>";
		}else{
			 echo "<script>
				alert('Successfully Saved..');
				window.location.href =  'dic_form6.php?tab=6';
			</script>";
		}	
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'dic_form6.php?tab=5';
		</script>";
	}	
}
if(isset($_POST["save6f"])){ 
	$input_size6=clean($_POST["hiddenval6"]);$input_size7=clean($_POST["hiddenval7"]);$input_size8=clean($_POST["hiddenval8"]);$input_size9=clean($_POST["hiddenval9"]);$input_size10=clean($_POST["hiddenval10"]);$mandays_utilized=clean($_POST["mandays_utilized"]);
	
	if(!empty($_POST["managerial"])) $managerial=json_encode($_POST["managerial"]);else $managerial=NULL;
	if(!empty($_POST["super"])) $super=json_encode($_POST["super"]);else $super=NULL;
	if(!empty($_POST["skilled"])) $skilled=json_encode($_POST["skilled"]);else $skilled=NULL;
	if(!empty($_POST["semiskilled"])) $semiskilled=json_encode($_POST["semiskilled"]);else $semiskilled=NULL;
	if(!empty($_POST["unskilled"])) $unskilled=json_encode($_POST["unskilled"]);else $unskilled=NULL;
	if(!empty($_POST["total"])) $total=json_encode($_POST["total"]);else $total=NULL;
	
	$sql=$dic->query("select form_id from dic_form6 where user_id='$swr_id' and active='1'") or die("Error :". $dic->error);
	$row=$sql->fetch_array();
	if($sql->num_rows<1){  ////////////table is empty//////////////
		echo "<script>
			alert('Please fill up the first part of the form .');
			window.location.href = 'dic_form6.php';
		</script>";
	}else{
		$form_id=$row["form_id"];
		$query=$dic->query("UPDATE dic_form6_part1 SET managerial='$managerial',super='$super',skilled='$skilled',semiskilled='$semiskilled',unskilled='$unskilled',total='$total',mandays_utilized='$mandays_utilized' WHERE form_id='$form_id'") OR die("Error : ".$dic->error);	
	}	
	if($query){
		if($input_size6!=0){					
		$k=$dic->query("delete from dic_form6_t6 where form_id='$form_id'");
			for($i=1;$i<$input_size6;$i++){
				//$vala=$_POST["txtA".$i];	
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$valf=$_POST["txtF".$i];
				$valg=$_POST["txtG".$i];
				$part6=$dic->query("INSERT INTO dic_form6_t6(id,form_id,slno,items,actual_quantity,actual_rupees,utilise_quantity,utilise_rupees,remark) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg')") or die($dic->error);
			}
		}
		if($input_size7!=0){					
		$k=$dic->query("delete from dic_form6_t7 where form_id='$form_id'");
			for($i=1;$i<$input_size7;$i++){
				//$vala=$_POST["textA".$i];	
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$vald=$_POST["textD".$i];	
				$vale=$_POST["textE".$i];	
				$valf=$_POST["textF".$i];	
				$valg=$_POST["textG".$i];	
				$valh=$_POST["textH".$i];	
				$part7=$dic->query("INSERT INTO dic_form6_t7(id,form_id,slno,items,source,name,hno,vill,dist,pin) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg','$valh')") or die($dic->error);
			}
		}
		if($input_size8!=0){					
		$k=$dic->query("delete from dic_form6_t8 where form_id='$form_id'");
			for($i=1;$i<$input_size8;$i++){
				//$vala=$_POST["txxtA".$i];		
				$valb=$_POST["txxtB".$i];
				$valc=$_POST["txxtC".$i];
				$vald=$_POST["txxtD".$i];				
				$vale=$_POST["txxtE".$i];				
				$valf=$_POST["txxtF".$i];				
				$valg=$_POST["txxtG".$i];				
				$part8=$dic->query("INSERT INTO dic_form6_t8(id,form_id,slno,items,within_assam_quantity,within_assam_value,outside_assam_quantity,outside_assam_value,remark) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg')") or die($dic->error);
			}
		}
		if($input_size9!=0){					
		$k=$dic->query("delete from dic_form6_t9 where form_id='$form_id'");
			for($i=1;$i<$input_size9;$i++){
				//$vala=$_POST["txttA".$i];		
				$valb=$_POST["txttB".$i];
				$valc=$_POST["txttC".$i];
				$vald=$_POST["txttD".$i];				
				$vale=$_POST["txttE".$i];							
				$valf=$_POST["txttF".$i];							
				$valg=$_POST["txttG".$i];							
				$part9=$dic->query("INSERT INTO dic_form6_t9(id,form_id,slno,items,within_assam_quantity,within_assam_value,outside_assam_quantity,outside_assam_value,remark) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg')") or die($dic->error);
			}
		}
		if($input_size10!=0){					
		$k=$dic->query("delete from dic_form6_t10 where form_id='$form_id'");
			for($i=1;$i<$input_size10;$i++){
				//$vala=$_POST["ttxtA".$i];		
				$valb=$_POST["ttxtB".$i];
				$valc=$_POST["ttxtC".$i];
				$part10=$dic->query("INSERT INTO dic_form6_t10(id,form_id,slno,name,remark) VALUES ('','$form_id','$i','$valb','$valc')") or die($dic->error);
			}
		}
		if((isset($part6) && $part6==false) || (isset($part7) && $part7==false) || (isset($part8) && $part8==false) || (isset($part9) && $part9==false) || (isset($part10) && $part10==false)){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'dic_form6.php?tab=6';
			</script>";
		}else{
			 echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'dic_form6.php?tab=7';
			</script>";
			}	
	}else{
	   echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'dic_form6.php?tab=6';
		   </script>";
	}	
}
if(isset($_POST["save6g"])){
	if((isset($_POST["mfile1"]) && empty($_POST["mfile1"])) || (isset($_POST["mfile2"]) && empty($_POST["mfile2"])) || (isset($_POST["mfile3"]) && empty($_POST["mfile3"])) || (isset($_POST["mfile4"]) && empty($_POST["mfile4"])) || (isset($_POST["mfile5"]) && empty($_POST["mfile5"])) || (isset($_POST["mfile6"]) && empty($_POST["mfile6"])) || (isset($_POST["mfile7"]) && empty($_POST["mfile7"])) || (isset($_POST["mfile8"]) && empty($_POST["mfile8"])) || (isset($_POST["mfile9"]) && empty($_POST["mfile9"])) || (isset($_POST["mfile10"]) && empty($_POST["mfile10"])) || (isset($_POST["mfile11"]) && empty($_POST["mfile11"])) || (isset($_POST["mfile12"]) && empty($_POST["mfile12"])) || (isset($_POST["mfile13"]) && empty($_POST["mfile13"])) || (isset($_POST["mfile14"]) && empty($_POST["mfile14"])) || (isset($_POST["mfile15"]) && empty($_POST["mfile15"])) || (isset($_POST["mfile16"]) && empty($_POST["mfile16"])) || (isset($_POST["mfile17"]) && empty($_POST["mfile17"])) || (isset($_POST["mfile18"]) && empty($_POST["mfile18"])) || (isset($_POST["mfile19"]) && empty($_POST["mfile19"])) || (isset($_POST["mfile20"]) && empty($_POST["mfile20"])) || (isset($_POST["mfile21"]) && empty($_POST["mfile21"])) || (isset($_POST["mfile22"]) && empty($_POST["mfile22"])) || (isset($_POST["mfile23"]) && empty($_POST["mfile23"])) || (isset($_POST["mfile1"]) && $_POST["mfile1"]=='2') || (isset($_POST["mfile2"]) && $_POST["mfile2"]=='2') || (isset($_POST["mfile3"]) && $_POST["mfile3"]=='2') || (isset($_POST["mfile4"]) && $_POST["mfile4"]=='2') || (isset($_POST["mfile5"]) && $_POST["mfile5"]=='2') || (isset($_POST["mfile6"]) && $_POST["mfile6"]=='2') || (isset($_POST["mfile7"]) && $_POST["mfile7"]=='2') || (isset($_POST["mfile8"]) && $_POST["mfile8"]=='2') || (isset($_POST["mfile9"]) && $_POST["mfile9"]=='2') || (isset($_POST["mfile10"]) && $_POST["mfile10"]=='2') || (isset($_POST["mfile11"]) && $_POST["mfile11"]=='2') || (isset($_POST["mfile12"]) && $_POST["mfile12"]=='2') || (isset($_POST["mfile13"]) && $_POST["mfile13"]=='2') || (isset($_POST["mfile14"]) && $_POST["mfile14"]=='2') || (isset($_POST["mfile15"]) && $_POST["mfile15"]=='2') || (isset($_POST["mfile16"]) && $_POST["mfile16"]=='2') || (isset($_POST["mfile17"]) && $_POST["mfile17"]=='2') || (isset($_POST["mfile18"]) && $_POST["mfile18"]=='2') || (isset($_POST["mfile19"]) && $_POST["mfile19"]=='2') || (isset($_POST["mfile20"]) && $_POST["mfile20"]=='2') || (isset($_POST["mfile21"]) && $_POST["mfile21"]=='2') || (isset($_POST["mfile22"]) && $_POST["mfile22"]=='2') || (isset($_POST["mfile23"]) && $_POST["mfile23"]=='2') || (isset($_POST["mfile1"]) && $_POST["mfile1"]=='3') || (isset($_POST["mfile2"]) && $_POST["mfile2"]=='3') || (isset($_POST["mfile3"]) && $_POST["mfile3"]=='3') || (isset($_POST["mfile4"]) && $_POST["mfile4"]=='3') || (isset($_POST["mfile5"]) && $_POST["mfile5"]=='3') || (isset($_POST["mfile6"]) && $_POST["mfile6"]=='3') || (isset($_POST["mfile7"]) && $_POST["mfile7"]=='3') || (isset($_POST["mfile8"]) && $_POST["mfile8"]=='3') || (isset($_POST["mfile9"]) && $_POST["mfile9"]=='3') || (isset($_POST["mfile10"]) && $_POST["mfile10"]=='3') || (isset($_POST["mfile11"]) && $_POST["mfile11"]=='3') || (isset($_POST["mfile12"]) && $_POST["mfile12"]=='3') || (isset($_POST["mfile13"]) && $_POST["mfile13"]=='3') || (isset($_POST["mfile14"]) && $_POST["mfile14"]=='3') || (isset($_POST["mfile15"]) && $_POST["mfile15"]=='3') || (isset($_POST["mfile16"]) && $_POST["mfile16"]=='3') || (isset($_POST["mfile17"]) && $_POST["mfile17"]=='3') || (isset($_POST["mfile18"]) && $_POST["mfile18"]=='3') || (isset($_POST["mfile19"]) && $_POST["mfile19"]=='3') || (isset($_POST["mfile20"]) && $_POST["mfile20"]=='3') || (isset($_POST["mfile21"]) && $_POST["mfile21"]=='3') || (isset($_POST["mfile22"]) && $_POST["mfile22"]=='3') || (isset($_POST["mfile23"]) && $_POST["mfile23"]=='3')){
		echo "<script>
			alert('Error in file / You didnot select any option.');
			window.location.href = 'dic_form6.php?tab=7';
		</script>";
	}else{
		$file1=$_POST["mfile1"];$file2=$_POST["mfile2"];$file3=$_POST["mfile3"];$file4=$_POST["mfile4"];$file5=$_POST["mfile5"];$file6=$_POST["mfile6"];$file7=$_POST["mfile7"];$file8=$_POST["mfile8"];$file9=$_POST["mfile9"];$file10=$_POST["mfile10"];$file11=$_POST["mfile11"];$file12=$_POST["mfile12"];$file13=$_POST["mfile13"];$file14=$_POST["mfile14"];$file15=$_POST["mfile15"];$file16=$_POST["mfile16"];$file17=$_POST["mfile17"];$file18=$_POST["mfile18"];$file19=$_POST["mfile19"];$file20=$_POST["mfile20"];$file21=$_POST["mfile21"];$file22=$_POST["mfile22"];$file23=$_POST["mfile23"];
		
		$sql=$dic->query("select form_id from dic_form6 where user_id='$swr_id' and active='1'");		
		if($sql->num_rows<1){				
			echo "<script>
				alert('Please fill the first part of the form.');
				window.location.href = 'dic_form6.php';
			</script>";
		}else{
			$row=$sql->fetch_array();
			$form_id=$row["form_id"];
			$savequery=$dic->query("update dic_form6_upload set file1='$file1',file2='$file2',file3='$file3',file4='$file4',file5='$file5',file6='$file6',file7='$file7',file8='$file8',file9='$file9',file10='$file10',file11='$file11',file12='$file12',file13='$file13',file14='$file14',file15='$file15',file16='$file16',file17='$file17',file18='$file18',file19='$file19',file20='$file20',file21='$file21',file22='$file22',file23='$file23' where form_id='$form_id'") or die($dic->error);
		}		
		if($savequery){
			$formFunctions->file_update($file1);$formFunctions->file_update($file2);$formFunctions->file_update($file3);$formFunctions->file_update($file4);$formFunctions->file_update($file5);$formFunctions->file_update($file6);$formFunctions->file_update($file7);$formFunctions->file_update($file8);$formFunctions->file_update($file9);$formFunctions->file_update($file10);$formFunctions->file_update($file11);$formFunctions->file_update($file12);$formFunctions->file_update($file13);$formFunctions->file_update($file14);$formFunctions->file_update($file15);$formFunctions->file_update($file16);$formFunctions->file_update($file17);$formFunctions->file_update($file18);$formFunctions->file_update($file19);$formFunctions->file_update($file20);$formFunctions->file_update($file21);$formFunctions->file_update($file22);$formFunctions->file_update($file23);
			
			if($file1="SC" || $file2="SC" ||  $file3="SC" ||  $file4="SC" ||  $file5="SC" ||  $file6="SC" ||  $file7="SC" ||  $file8="SC" ||  $file9="SC" || $file10="SC" || $file11="SC" || $file12="SC" ||  $file13="SC" ||  $file14="SC" ||  $file15="SC" ||  $file16="SC" ||  $file17="SC" ||  $file18="SC" ||  $file19="SC" ||  $file20="SC" ||  $file21="SC" ||  $file22="SC" ||  $file23="SC"){
				$save_query=$dic->query("update dic_form6 set courier_details='1', sub_date='$today' where form_id='$form_id'") or die($dic->error);
			}else{
				$save_query=$dic->query("update dic_form6 set sub_date='$today' where form_id='$form_id'") or die($dic->error);
			}
			if($save_query){
				echo "<script>
					alert('Successfully Saved....');
					window.location.href = 'preview.php?token=6';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'form1.php?tab=8';
				</script>";
			}			
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'form1.php?tab=7';
			</script>";
		}
	}
}
if(isset($_POST["proceed6"])){
	$query=$dic->query("select form_id,save_mode,courier_details from dic_form6 where user_id='$swr_id' and active='1'") or die("Error :". $dic->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'dic_form6.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'dic','6');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$dic->query("update dic_form6 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($dic->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=dic&form=6';
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
			$dept_email="esgoa.dic@gmail.com";
			require_once "dic_form6_print.php"; 
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
					window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=6&dept=dic';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'dic_form6.php';
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
if(isset($_POST["save7a"])){
	$manufac_service=clean($_POST["manufac_service"]);$post_office=clean($_POST["post_office"]);
	if(!empty($_POST["office_address"])) $office_address=json_encode($_POST["office_address"]);else $office_address=NULL;		
	if(!empty($_POST["partner_address"])) $partner_address=json_encode($_POST["partner_address"]);else $partner_address=NULL;
	$sql=$dic->query("select form_id from dic_form7 where user_id='$swr_id' and active='1'") or die("Error :". $dic->error);
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$dic->query("insert into dic_form7(user_id,post_office,office_address,partner_address,manufac_service) values('$swr_id','$post_office','$office_address','$partner_address','$manufac_service')")OR die("Error: ".$dic->error);
	}else{
		$form_id=$row["form_id"];
		$query=$dic->query("UPDATE dic_form7 SET  sub_date='$today', post_office='$post_office',office_address='$office_address',partner_address='$partner_address',manufac_service='$manufac_service' WHERE user_id='$swr_id' AND form_id='$form_id'") OR die("Error: ".$dic->error);	
	}
	if($query)
			{
				$formFunctions->insert_incomplete_forms('dic','7'); //dic-- dept name and 7 -- form no
				echo "<script>
					alert('Successfully Saved..');
					window.location.href = 'dic_form7.php?tab=2';
				</script>";
			}
			else
			{
				echo "<script>
					alert('Invalid Entry');
					window.location.href = 'dic_form7.php';
				</script>";
			}
}
if(isset($_POST["save7b"])){
	$mandtory_cert=clean($_POST["mandtory_cert"]);$registration_no=clean($_POST["registration_no"]);$total=clean($_POST["total"]);
		
	if(!empty($_POST["new_unit"])) $new_unit=json_encode($_POST["new_unit"]);else $new_unit=NULL;
	if(!empty($_POST["exist_unit"])) $exist_unit=json_encode($_POST["exist_unit"]);else $exist_unit=NULL;		
	if(!empty($_POST["land"])) $land=json_encode($_POST["land"]);else $land=NULL	;
	if(!empty($_POST["site"])) $site=json_encode($_POST["site"]);else $site=NULL	;
	if(!empty($_POST["off_building"])) $off_building=json_encode($_POST["off_building"]);else $off_building=NULL	;
	if(!empty($_POST["fac_building"])) $fac_building=json_encode($_POST["fac_building"]);else $fac_building=NULL	;
	if(!empty($_POST["plant_item"])) $plant_item=json_encode($_POST["plant_item"]);else $plant_item=NULL	;
	if(!empty($_POST["elec_ins"])) $elec_ins=json_encode($_POST["elec_ins"]);else $elec_ins=NULL	;
	if(!empty($_POST["operative"])) $operative=json_encode($_POST["operative"]);else $operative=NULL	;
	if(!empty($_POST["fixed_asset"])) $fixed_asset=json_encode($_POST["fixed_asset"]);else $fixed_asset=NULL	;
	if(!empty($_POST["total_invest"])) $total_invest=json_encode($_POST["total_invest"]);else $total_invest=NULL	;
	if(!empty($_POST["soruces"])) $soruces=json_encode($_POST["soruces"]);else $soruces=NULL	;
	
	$sql=$dic->query("select form_id from dic_form7 where user_id='$swr_id' and active='1'") or die("Error :". $dic->error);
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$dic->query("insert into dic_form7(user_id,new_unit,exist_unit,mandtory_cert,registration_no,land,site,off_building,fac_building,plant_item,elec_ins,operative,fixed_asset,total_invest,soruces,total) values('$swr_id','$new_unit','$exist_unit','$mandtory_cert','$registration_no','$land','$site','$off_building','$fac_building','$plant_item','$elec_ins','$operative','$fixed_asset','$total_invest','$soruces','$total')")OR die("Error: ".$dic->error);
	}else{
		$form_id=$row["form_id"];
		$query=$dic->query("UPDATE dic_form7 SET  sub_date='$today',new_unit='$new_unit', exist_unit='$exist_unit',mandtory_cert='$mandtory_cert',land='$land',registration_no='$registration_no',site='$site',off_building='$off_building',fac_building='$fac_building',plant_item='$plant_item',elec_ins='$elec_ins',operative='$operative',fixed_asset='$fixed_asset',total_invest='$total_invest',soruces='$soruces',total='$total' WHERE user_id='$swr_id' AND form_id='$form_id'") OR die("Error: ".$dic->error);	
	}
	if($query)
		{
			echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'dic_form7.php?tab=3';
			</script>";
		}
		else
		{
			echo "<script>
				alert('Invalid Entry');
				window.location.href = 'dic_form3.php?tab=2';
			</script>";
		}
}
if(isset($_POST["save7c"])){
	$input_size1=clean($_POST["hiddenval"]);$input_size2=clean($_POST["hiddenval2"]);$input_size3=clean($_POST["hiddenval3"]);
	$ownland_area=clean($_POST["ownland_area"]);$purchase_dt=clean($_POST["purchase_dt"]);$dt_of_reg=clean($_POST["dt_of_reg"]);$is_building=clean($_POST["is_building"]);$built_up_area=clean($_POST["built_up_area"]);$statement=clean($_POST["statement"]);
		
	if(!empty($_POST["power_a"])) $power_a=json_encode($_POST["power_a"]);else $power_a=NULL;
	if(!empty($_POST["under_expan"])) $under_expan=json_encode($_POST["under_expan"]);else $under_expan=NULL;		
	if(!empty($_POST["land_alloted"])) $land_alloted=json_encode($_POST["land_alloted"]);else $land_alloted=NULL	;
	if(!empty($_POST["lease_land"])) $lease_land=json_encode($_POST["lease_land"]);else $lease_land=NULL	;
	
	
	$sql=$dic->query("select form_id from dic_form7 where user_id='$swr_id' and active='1'") or die("Error :". $dic->error);
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$dic->query("insert into dic_form7(user_id,power_a,under_expan,ownland_area,purchase_dt,dt_of_reg,land_alloted,lease_land,is_building,built_up_area,statement,operative,fixed_asset,total_invest,soruces,total) values('$swr_id','$power_a','$under_expan','$ownland_area','$purchase_dt','$dt_of_reg','$land_alloted','$lease_land','$is_building','$built_up_area','$statement','$operative','$fixed_asset','$total_invest','$soruces','$total')")OR die("Error: ".$dic->error);
	}else{
		$form_id=$row["form_id"];
		$query=$dic->query("UPDATE dic_form7 SET  sub_date='$today',power_a='$power_a', under_expan='$under_expan',ownland_area='$ownland_area',purchase_dt='$purchase_dt',dt_of_reg='$dt_of_reg',land_alloted='$land_alloted',lease_land='$lease_land',is_building='$is_building',built_up_area='$built_up_area',statement='$statement' WHERE user_id='$swr_id' AND form_id='$form_id'") OR die("Error: ".$dic->error);	
	}
	if($query){
		if($input_size1!=0){					
		$k=$dic->query("delete from dic_form7_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size1;$i++){
				$vala=$_POST["txtA".$i];	
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$part1=$dic->query("INSERT INTO dic_form7_t1(id,form_id,bank_name,amount_of_term,letter_no,loan_disbursed) VALUES ('','$form_id','$vala','$valb','$valc','$vald')") or die($dic->error);
			}
		}
		if($input_size2!=0){					
		$k=$dic->query("delete from dic_form7_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				$vala=$_POST["textA".$i];	
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$vald=$_POST["textD".$i];	
				$part2=$dic->query("INSERT INTO dic_form7_t2(id,form_id,name,amount,pan_no,payment_mode) VALUES ('','$form_id','$vala','$valb','$valc','$vald')") or die($dic->error);
				//$part4=$dic->query("INSERT INTO dic_form7_t2 VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')") or die($dic->error);
			}
		}
		if($input_size3!=0){					
		$k=$dic->query("delete from dic_form7_t3 where form_id='$form_id'");
			for($i=1;$i<$input_size3;$i++){
				$vala=$_POST["txxtA".$i];		
				$valb=$_POST["txxtB".$i];
				$valc=$_POST["txxtC".$i];
				$vald=$_POST["txxtD".$i];				
				$part3=$dic->query("INSERT INTO dic_form7_t3(id,form_id,name,amount,pan_no,payment_mode) VALUES ('','$form_id','$vala','$valb','$valc','$vald')") or die($dic->error);
			}
		}
		if(isset($part1) && $part1==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'dic_form7.php?tab=4';
			</script>";
		}else if(isset($part2) && $part2==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'dic_form7.php?tab=4';
			</script>";
		}else if(isset($part3) && $part3==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'dic_form7.php?tab=4';
			</script>";
		}else{
			 echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'dic_form7.php?tab=4';
			</script>";
			}	
	}else{
	   echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'dic_form7.php?tab=3';
		   </script>";
	   }	
}
if(isset($_POST["submit7"])){
	if((isset($_POST["mfile1"]) && empty($_POST["mfile1"])) ||  (isset($_POST["mfile1"]) && $_POST["mfile1"]=='2') ||  (isset($_POST["mfile1"]) && $_POST["mfile1"]=='3')){
		echo "<script>
					alert('Error in file / You didnot select any option.');
					window.location.href = 'dic_form7.php?tab=4';
				</script>";
	}else {
		 $file1=clean($_POST["mfile1"]);
		
		$sql=$dic->query("select form_id from dic_form7 where user_id='$swr_id' and active='1'");		
		if($sql->num_rows<1){				
			echo "<script>
				alert('Please fill the first part of the form.');
				window.location.href = 'dic_form7.php';
			</script>";
		}else{
			$row=$sql->fetch_array();
			$form_id=$row["form_id"];
			$savequery=$dic->query("update dic_form7 set file1='$file1' where form_id='$form_id'") or die($dic->error);
		}		
		if($savequery){
			$formFunctions->file_update($file1);
			
			if($file1=="SC"){
				$save_query=$dic->query("update dic_form7 set courier_details='1', sub_date='$today' where form_id='$form_id'") or die($dic->error);
			}else{
				$courier_details=NULL;
				$save_query=$dic->query("update dic_form7 set sub_date='$today', courier_details='$courier_details' where form_id='$form_id'") or die($dic->error);
			}
			if($save_query){
				echo "<script>
					alert('Successfully Saved....');
					window.location.href = 'preview.php?token=7';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href ='dic_form7.php?tab=4';
				</script>";
			}			
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href ='dic_form7.php?tab=4';
			</script>";
		}
	}
}
if(isset($_POST["proceed7"])) {
	$query=$dic->query("select form_id,save_mode,courier_details from dic_form7 where user_id='$swr_id' and active='1'") or die("Error :". $dic->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'dic_form7.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'dic','7');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$dic->query("update dic_form7 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($dic->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=dic&form=7';
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
			$dept_email="esgoa.dic@gmail.com";
			require_once "dic_form7_print.php"; 
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
					window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=7&dept=dic';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'dic_form7.php?tab=4';
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
if(isset($_POST["save8a"])){
	$claim_period_form=clean($_POST["claim_period_form"]);$claim_period_to=clean($_POST["claim_period_to"]);$promoters_name=clean($_POST["promoters_name"]);$item_of_product=clean($_POST["item_of_product"]);
	if(!empty($_POST["office_address"])) $office_address=json_encode($_POST["office_address"]);else $office_address=NULL;		
	if(!empty($_POST["promoters_address"])) $promoters_address=json_encode($_POST["promoters_address"]);else $promoters_address=NULL;
	$sql=$dic->query("select form_id from dic_form8 where user_id='$swr_id' and active='1'") or die("Error :". $dic->error);
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$dic->query("insert into dic_form8(user_id,office_address,claim_period_form,claim_period_to,promoters_name,promoters_address,item_of_product) values('$swr_id','$office_address','$claim_period_form','$claim_period_to','$promoters_name','$promoters_address','$item_of_product')")OR die("Error: ".$dic->error);
	}else{
		$form_id=$row["form_id"];
		$query=$dic->query("UPDATE dic_form8 SET  sub_date='$today', office_address='$office_address',claim_period_form='$claim_period_form',claim_period_to='$claim_period_to',promoters_name='$promoters_name',promoters_address='$promoters_address',item_of_product='$item_of_product' WHERE user_id='$swr_id' AND form_id='$form_id'") OR die("Error: ".$dic->error);	
	}
	if($query)
			{
				$formFunctions->insert_incomplete_forms('dic','8'); //dic-- dept name and 8 -- form no
				echo "<script>
					alert('Successfully Saved..');
					window.location.href = 'dic_form8.php?tab=2';
				</script>";
			}
			else
			{
				echo "<script>
					alert('Invalid Entry');
					window.location.href = 'dic_form8.php';
				</script>";
			}
}
if(isset($_POST["save8b"])){
	$date_of_comm=clean($_POST["date_of_comm"]);$date_of_service=clean($_POST["date_of_service"]);$cert_no=clean($_POST["cert_no"]);$cert_date=clean($_POST["cert_date"]);$period_from=clean($_POST["period_from"]);$period_to=clean($_POST["period_to"]);$period_to=clean($_POST["period_to"]);$mothly_statement=clean($_POST["mothly_statement"]);$percentage_of_increase=clean($_POST["percentage_of_increase"]);
	if(!empty($_POST["new_unit"])) $new_unit=json_encode($_POST["new_unit"]);else $new_unit=NULL;		
	if(!empty($_POST["exist_unit"])) $exist_unit=json_encode($_POST["exist_unit"]);else $exist_unit=NULL;
	$sql=$dic->query("select form_id from dic_form8 where user_id='$swr_id' and active='1'") or die("Error :". $dic->error);
	$row=$sql->fetch_array();
	if($sql->num_rows<1){////////////table is empty//////////////
		if($mothly_statement=="SC"){
			$query=$dic->query("insert into dic_form8(user_id,sub_date,courier_details,date_of_comm,date_of_service,cert_no,cert_date,period_from,period_to,new_unit,exist_unit,mothly_statement,percentage_of_increase) values('$swr_id','$today','1','$date_of_comm','$date_of_service','$cert_no','$cert_date','$period_from','$period_to','$new_unit','$exist_unit','$mothly_statement','$percentage_of_increase')")OR die("Error: ".$dic->error);
		}else{
			$query=$dic->query("insert into dic_form8(user_id,sub_date,received_date,date_of_comm,date_of_service,cert_no,cert_date,period_from,period_to,new_unit,exist_unit,mothly_statement,percentage_of_increase) values('$swr_id','$today','$today','$date_of_comm','$date_of_service','$cert_no','$cert_date','$period_from','$period_to','$new_unit','$exist_unit','$mothly_statement','$percentage_of_increase')")OR die("Error: ".$dic->error);
		}
		$form_id=$dic->insert_id;
	}else{	////////////table is not empty//////////////			
		$form_id=$row["form_id"];		
		if($mothly_statement=="SC"){
			$query=$dic->query("UPDATE dic_form8 SET  sub_date='$today',courier_details='1',date_of_comm='$date_of_comm',date_of_service='$date_of_service',cert_no='$cert_no',cert_date='$cert_date',period_from='$period_from',period_to='$period_to',new_unit='$new_unit',exist_unit='$exist_unit',mothly_statement='$mothly_statement',percentage_of_increase='$percentage_of_increase' WHERE user_id='$swr_id' AND form_id='$form_id'") OR die("Error: ".$dic->error);	
		}else{
			$query=$dic->query("UPDATE dic_form8 SET  sub_date='$today',received_date='$today' , date_of_comm='$date_of_comm',date_of_service='$date_of_service',cert_no='$cert_no',cert_date='$cert_date',period_from='$period_from',period_to='$period_to',new_unit='$new_unit',exist_unit='$exist_unit',mothly_statement='$mothly_statement',percentage_of_increase='$percentage_of_increase' WHERE user_id='$swr_id' AND form_id='$form_id'") OR die("Error: ".$dic->error);
		}
	}
	if($query)
		{
			echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'preview.php?token=8';
			</script>";
		}
		else
		{
			echo "<script>
				alert('Invalid Entry');
				window.location.href = 'dic_form8.php?tab=2';
			</script>";
		}
}
if(isset($_POST["proceed8"])) {
	$query=$dic->query("select form_id,save_mode,courier_details from dic_form8 where user_id='$swr_id' and active='1'") or die("Error :". $dic->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'dic_form8.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'dic','8');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$dic->query("update dic_form8 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($dic->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=dic&form=8';
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
			$dept_email="esgoa.dic@gmail.com";
			require_once "dic_form8_print.php"; 
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
					window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=8&dept=dic';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'dic_form8.php?tab=2';
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
if(isset($_POST["save9a"])){
	$hidden_value=clean($_POST["hidden_value"]);$input_size1=clean($_POST["hiddenval"]);$post_office=clean($_POST["post_office"]);$reg_no=clean($_POST["reg_no"]);$reg_date=clean($_POST["reg_date"]);$investment=clean($_POST["investment"]);$total_invest=clean($_POST["total_invest"]);$plant_machinery=clean($_POST["plant_machinery"]);
	if(!empty($_POST["office_address"])) $office_address=json_encode($_POST["office_address"]);else $office_address=NULL;		
	$sql=$dic->query("select form_id from dic_form9 where user_id='$swr_id' and active='1'") or die("Error :". $dic->error);
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$dic->query("insert into dic_form9(user_id,post_office,office_address,reg_no,reg_date,investment,total_invest,plant_machinery) values('$swr_id','$post_office','$office_address','$reg_no','$reg_date','$investment','$total_invest','$plant_machinery')")OR die("Error: ".$dic->error);
		$form_id=$dic->insert_id;
		for($i=1;$i<=$hidden_value;$i++){
			$partner_name=$_POST["partner_name".$i.""];$partner_address=$_POST["partner_address".$i.""];$partner_pan_no=$_POST["partner_pan_no".$i.""];
			$query1=$dic->query("INSERT INTO dic_form9_partners(id,form_id,sl_no,partner_name,partner_address,partner_pan_no) VALUES ('','$form_id','$i','$partner_name','$partner_address','$partner_pan_no')") or die("error in insertion dic_form9_partners".$dic->error);
		}
	}else{
		$form_id=$row["form_id"];
		$query=$dic->query("UPDATE dic_form9 SET  sub_date='$today', post_office='$post_office',office_address='$office_address',reg_no='$reg_no',reg_date='$reg_date',investment='$investment',total_invest='$total_invest',plant_machinery='$plant_machinery' WHERE user_id='$swr_id' AND form_id='$form_id'") OR die("Error: ".$dic->error);
		for($i=1;$i<=$hidden_value;$i++){
			$partner_name=$_POST["partner_name".$i.""];$partner_address=$_POST["partner_address".$i.""];$partner_pan_no=$_POST["partner_pan_no".$i.""];
			$query1=$dic->query("update dic_form9_partners set partner_name='$partner_name',partner_address='$partner_address',partner_pan_no='$partner_pan_no' where form_id='$form_id' and sl_no='$i'") or die("error in insertion dic_form9_partners".$dic->error);
		}
	}
	if($query){
		$formFunctions->insert_incomplete_forms('dic','9'); //dic-- dept name and 8 -- form no
		if($input_size1!=0){					
			$k=$dic->query("delete from dic_form9_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size1;$i++){
				//$vala=$_POST["txtA".$i];	
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$part1=$dic->query("INSERT INTO dic_form9_t1(id,form_id,sl_no,bank_name,amount_of_term,working_capital,working_capital_limit) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')") or die($dic->error);
			}
		}		
		if(isset($part1) && $part1==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'dic_form9.php?tab=1';
			</script>";
		
		}else{
			 echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'dic_form9.php?tab=2';
			</script>";
			}	
	}else{
	   echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'dic_form9.php?tab=1';
		   </script>";
	   }	
}
if(isset($_POST["save9b"])){
	$input_size2=clean($_POST["hiddenval2"]);$input_size3=clean($_POST["hiddenval3"]);$input_size4=clean($_POST["hiddenval4"]);$s1=clean($_POST["s1"]);$reg_details=clean($_POST["reg_details"]);$date_of_production=clean($_POST["date_of_production"]);$other_incentives=clean($_POST["other_incentives"]);$total_amount=clean($_POST["total_amount"]);$total_year=clean($_POST["total_year"]);$transport_regno=clean($_POST["transport_regno"]);$period_of_val_f=clean($_POST["period_of_val_f"]);$period_of_val_t=clean($_POST["period_of_val_t"]);
	if(!empty($_POST["pmt_reg"])) $pmt_reg=json_encode($_POST["pmt_reg"]);else $pmt_reg=NULL;		
	if(!empty($_POST["under_neipp"])) $under_neipp=json_encode($_POST["under_neipp"]);else $under_neipp=NULL;
	$sql=$dic->query("select form_id from dic_form9 where user_id='$swr_id' and active='1'") or die("Error :". $dic->error);
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$dic->query("insert into dic_form9(user_id,s1,reg_details,pmt_reg,date_of_production,other_incentives,under_neipp,total_amount,total_year,transport_regno,period_of_val_f,period_of_val_t) values('$swr_id','$s1','$reg_details','$pmt_reg','$date_of_production','$other_incentives','$under_neipp','$total_amount','$total_year','$transport_regno','$period_of_val_f','$period_of_val_t')")OR die("Error: ".$dic->error);
	}else{
		$form_id=$row["form_id"];
		$query=$dic->query("UPDATE dic_form9 SET  sub_date='$today', s1='$s1',reg_details='$reg_details',pmt_reg='$pmt_reg',date_of_production='$date_of_production',other_incentives='$other_incentives',under_neipp='$under_neipp',total_amount='$total_amount',total_year='$total_year',transport_regno='$transport_regno',period_of_val_f='$period_of_val_f',period_of_val_t='$period_of_val_t' WHERE user_id='$swr_id' AND form_id='$form_id'") OR die("Error: ".$dic->error);	
	}
	if($query){
		if($input_size2!=0){					
			$k=$dic->query("delete from dic_form9_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				//$vala=$_POST["textA".$i];	
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$vald=$_POST["textD".$i];	
				$part2=$dic->query("INSERT INTO dic_form9_t2(id,form_id,sl_no,incentive_name,amount,year) VALUES ('','$form_id','$i','$valb','$valc','$vald')") or die($dic->error);
			}
		}
		if($input_size3!=0){					
			$k=$dic->query("delete from dic_form9_t3 where form_id='$form_id'");
			for($i=1;$i<$input_size3;$i++){
				//$vala=$_POST["txxtA".$i];		
				$valb=$_POST["txxtB".$i];
				$valc=$_POST["txxtC".$i];
				$vald=$_POST["txxtD".$i];				
				$vale=$_POST["txxtE".$i];				
				$part3=$dic->query("INSERT INTO dic_form9_t3(id,form_id,sl_no,item_name,ins_cap,value,capacity) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')") or die($dic->error);
			}
		}
		if($input_size4!=0){					
			$k=$dic->query("delete from dic_form9_t4 where form_id='$form_id'");
			for($i=1;$i<$input_size4;$i++){
				//$vala=$_POST["txttA".$i];		
				$valb=$_POST["txttB".$i];
				$valc=$_POST["txttC".$i];
				$vald=$_POST["txttD".$i];				
				$vale=$_POST["txttE".$i];				
				$part4=$dic->query("INSERT INTO dic_form9_t4(id,form_id,sl_no,raw_material,annual_req,value,joint_capacity) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')") or die($dic->error);
			}
		}
		if(isset($part2) && $part2==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'dic_form9.php?tab=2';
			</script>";
		
		}else if(isset($part3) && $part3==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'dic_form9.php?tab=2';
			</script>";
		
		}else if(isset($part4) && $part4==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'dic_form9.php?tab=2';
			</script>";
		
		}else{
			 echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'dic_form9.php?tab=3';
			</script>";
			}	
	}else{
	   echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'dic_form9.php?tab=2';
		   </script>";
	   }	
}
if(isset($_POST["save9c"])){
	$input_size5=clean($_POST["hiddenval5"]);$input_size6=clean($_POST["hiddenval6"]);$input_size7=clean($_POST["hiddenval7"]);$no_of_employee=clean($_POST["no_of_employee"]);$emp_under_contractor=clean($_POST["emp_under_contractor"]);$tan_n_unit=clean($_POST["tan_n_unit"]);$central_excise=clean($_POST["central_excise"]);$vat_reg=clean($_POST["vat_reg"]);$dist_f_focal=clean($_POST["dist_f_focal"]);$dist_f_rstation=clean($_POST["dist_f_rstation"]);$product_ext_from=clean($_POST["product_ext_from"]);
	if(!empty($_POST["power"])) $power=json_encode($_POST["power"]);else $power=NULL;		
	if(!empty($_POST["claim"])) $claim=json_encode($_POST["claim"]);else $claim=NULL;
	$sql=$dic->query("select form_id from dic_form9 where user_id='$swr_id' and active='1'") or die("Error :". $dic->error);
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$dic->query("insert into dic_form8(user_id,no_of_employee,emp_under_contractor,tan_n_unit,central_excise,vat_reg,power,claim,dist_f_focal,dist_f_rstation,product_ext_from) values('$swr_id','$no_of_employee','$emp_under_contractor','$tan_n_unit','$central_excise','$vat_reg','$power','$claim','$dist_f_focal','$dist_f_rstation','$product_ext_from')")OR die("Error: ".$dic->error);
	}else{
		$form_id=$row["form_id"];
		$query=$dic->query("UPDATE dic_form9 SET  sub_date='$today', no_of_employee='$no_of_employee',emp_under_contractor='$emp_under_contractor',tan_n_unit='$tan_n_unit',central_excise='$central_excise',vat_reg='$vat_reg',power='$power',claim='$claim',dist_f_focal='$dist_f_focal',dist_f_rstation='$dist_f_rstation',product_ext_from='$product_ext_from' WHERE user_id='$swr_id' AND form_id='$form_id'") OR die("Error: ".$dic->error);	
	}
	if($query){
		if($input_size5!=0){					
			$k=$dic->query("delete from dic_form9_t5 where form_id='$form_id'");
			for($i=1;$i<$input_size5;$i++){
				//$vala=$_POST["txttA".$i];		
				$valb=$_POST["txttB".$i];
				$valc=$_POST["txttC".$i];
				$vald=$_POST["txttD".$i];				
				$part5=$dic->query("INSERT INTO dic_form9_t5(id,form_id,sl_no,item,date,amount) VALUES ('','$form_id','$i','$valb','$valc','$vald')") or die($dic->error);
			}
		}
		if($input_size6!=0){					
			$k=$dic->query("delete from dic_form9_t6 where form_id='$form_id'");
			for($i=1;$i<$input_size6;$i++){
				//$vala=$_POST["txxtA".$i];		
				$valb=$_POST["txxtB".$i];
				$valc=$_POST["txxtC".$i];
				$vald=$_POST["txxtD".$i];				
				$vale=$_POST["txxtE".$i];				
				$valf=$_POST["txxtF".$i];				
				$part6=$dic->query("INSERT INTO dic_form9_t6(id,form_id,sl_no,raw_mat,qty,value,transport_charge,transport_charge_paid) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale','$valf')") or die($dic->error);
			}
		}
		if($input_size7!=0){					
			$k=$dic->query("delete from dic_form9_t7 where form_id='$form_id'");
			for($i=1;$i<$input_size7;$i++){
				//$vala=$_POST["textA".$i];	
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$vald=$_POST["textD".$i];	
				$vale=$_POST["textE".$i];	
				$valf=$_POST["textF".$i];	
				$part7=$dic->query("INSERT INTO dic_form9_t7(id,form_id,sl_no,product_name,quantity,value,transport_charge,transport_charge_paid) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale','$valf')") or die($dic->error);
			}
		}
		if(isset($part5) && $part5==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'dic_form9.php?tab=3';
			</script>";
		
		}else if(isset($part6) && $part6==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'dic_form9.php?tab=3';
			</script>";
		
		}else if(isset($part7) && $part7==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'dic_form9.php?tab=3';
			</script>";
		
		}else{
			 echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'dic_form9.php?tab=4';
			</script>";
			}	
	}else{
	   echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'dic_form9.php?tab=3';
		   </script>";
	   }	
			
}
if(isset($_POST["save9d"])){
	$input_size8=clean($_POST["hiddenval8"]);$input_size9=clean($_POST["hiddenval9"]);$input_size10=clean($_POST["hiddenval10"]);$input_size11=clean($_POST["hiddenval11"]);$unit_consumed=clean($_POST["unit_consumed"]);$dg_set_rating=clean($_POST["dg_set_rating"]);$diesel_consumed=clean($_POST["diesel_consumed"]);$dg_unit_consumed=clean($_POST["dg_unit_consumed"]);$total_elec_unit=clean($_POST["total_elec_unit"]);
	if(!empty($_POST["bank_details"])) $bank_details=json_encode($_POST["bank_details"]);else $bank_details=NULL;		
	
	$sql=$dic->query("select form_id from dic_form9 where user_id='$swr_id' and active='1'") or die("Error :". $dic->error);
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$dic->query("insert into dic_form8(user_id,unit_consumed,dg_set_rating,diesel_consumed,dg_unit_consumed,total_elec_unit,bank_details) values('$swr_id','$unit_consumed','$dg_set_rating','$diesel_consumed','$dg_unit_consumed','$total_elec_unit','$bank_details')")OR die("Error: ".$dic->error);
	}else{
		$form_id=$row["form_id"];
		$query=$dic->query("UPDATE dic_form9 SET  sub_date='$today', unit_consumed='$unit_consumed',dg_set_rating='$dg_set_rating',diesel_consumed='$diesel_consumed',dg_unit_consumed='$dg_unit_consumed',total_elec_unit='$total_elec_unit',bank_details='$bank_details' WHERE user_id='$swr_id' AND form_id='$form_id'") OR die("Error: ".$dic->error);	
	}
	if($query){
		if($input_size8!=0){					
			$k=$dic->query("delete from dic_form9_t8 where form_id='$form_id'");
			for($i=1;$i<$input_size8;$i++){
				//$vala=$_POST["textA".$i];	
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$vald=$_POST["textD".$i];	
				$vale=$_POST["textE".$i];
				$part8=$dic->query("INSERT INTO dic_form9_t8(id,form_id,sl_no,raw_mat,outside_qty,utilized_qty,subsidy_amount) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')") or die($dic->error);
			}
		}
		if($input_size9!=0){					
			$k=$dic->query("delete from dic_form9_t9 where form_id='$form_id'");
			for($i=1;$i<$input_size9;$i++){
				//$vala=$_POST["txxtA".$i];		
				$valb=$_POST["txxtB".$i];
				$valc=$_POST["txxtC".$i];
				$vald=$_POST["txxtD".$i];				
				$vale=$_POST["txxtE".$i];								
				$part9=$dic->query("INSERT INTO dic_form9_t9(id,form_id,sl_no,product_name,sold_qty,sold_during,amount) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')") or die($dic->error);
			}
		}
		if($input_size10!=0){					
			$k=$dic->query("delete from dic_form9_t10 where form_id='$form_id'");
			for($i=1;$i<$input_size10;$i++){
				//$vala=$_POST["txttA".$i];		
				$valb=$_POST["txttB".$i];
				$valc=$_POST["txttC".$i];
				$vald=$_POST["txttD".$i];				
				$vale=$_POST["txttE".$i];				
				$part10=$dic->query("INSERT INTO dic_form9_t10(id,form_id,sl_no,raw_mat,within_ner_qty,utilized_qty,amount) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')") or die($dic->error);
			}
		}
		if($input_size11!=0){					
			$k=$dic->query("delete from dic_form9_t11 where form_id='$form_id'");
			for($i=1;$i<$input_size11;$i++){
				//$vala=$_POST["txtA".$i];	
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$part1=$dic->query("INSERT INTO dic_form9_t11(id,form_id,sl_no,product_name,sold_ner_qty,sold_during,amount) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')") or die($dic->error);
			}
		}	
		if(isset($part8) && $part8==false){
				echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'dic_form9.php?tab=3';
			</script>";
		
		}else if(isset($part9) && $part9==false){
				echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'dic_form9.php?tab=3';
			</script>";
		
		}else if(isset($part10) && $part10==false){
				echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'dic_form9.php?tab=3';
			</script>";
		
		}else if(isset($part11) && $part11==false){
				echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'dic_form9.php?tab=3';
			</script>";
		
		}else{
				echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'preview.php?token=9';
			</script>";
			}	
	}else{
			echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'dic_form9.php?tab=4';
		   </script>";
	   }			
	
}
if(isset($_POST["proceed9"])) {
	$query=$dic->query("select form_id,save_mode,courier_details from dic_form9 where user_id='$swr_id' and active='1'") or die("Error :". $dic->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'dic_form9.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'dic','9');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$dic->query("update dic_form9 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($dic->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=dic&form=9';
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
			$dept_email="esgoa.dic@gmail.com";
			require_once "dic_form9_print.php"; 
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
					window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=9&dept=dic';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'dic_form9.php?tab=2';
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
	$indus_land=clean($_POST["indus_land"]);$actual_area=clean($_POST["actual_area"]);$lic_no=clean($_POST["lic_no"]);	$lic_date=clean($_POST["lic_date"]);$item_name=clean($_POST["item_name"]);$production_capacity=clean($_POST["production_capacity"]);$prod_export=clean($_POST["prod_export"]);$civil_works=clean($_POST["civil_works"]);$plant_n_machinery=clean($_POST["plant_n_machinery"]);$other_fixed_assets=clean($_POST["other_fixed_assets"]);$actual_prod_area=clean($_POST["actual_prod_area"]);$godown=clean($_POST["godown"]);$other_services=clean($_POST["other_services"]);$power_req=clean($_POST["power_req"]);$water_req=clean($_POST["water_req"]);$if_any=clean($_POST["if_any"]);
	
	if($if_any=="Y") $PI_indicate=clean($_POST["PI_indicate"]);
			else $PI_indicate="";
	
	
	$sql=$dic->query("select form_id from dic_form10 where user_id='$swr_id' and active='1'") or die("Error :". $dic->error);
	$row=$sql->fetch_array();
		if($sql->num_rows<1){   ////////////table is empty//////////////
			$query=$dic->query("insert into dic_form10(user_id,indus_land,actual_area,lic_no,lic_date,item_name,production_capacity,prod_export,civil_works,plant_n_machinery,other_fixed_assets,actual_prod_area,godown,other_services,power_req,water_req,if_any,PI_indicate) values('$swr_id','$indus_land','$actual_area','$lic_no','$lic_date','$item_name','$production_capacity','$prod_export','$civil_works','$plant_n_machinery','$other_fixed_assets','$actual_prod_area','$godown','$other_services','$power_req','$water_req','$if_any','$PI_indicate')")OR die("Error: ".$dic->error);
		}else{
			$form_id=$row["form_id"];
			$query=$dic->query("UPDATE dic_form10 SET  sub_date='$today', indus_land='$indus_land',actual_area='$actual_area',lic_no='$lic_no',lic_date='$lic_date',item_name='$item_name',production_capacity='$production_capacity',prod_export='$prod_export',civil_works='$civil_works',plant_n_machinery='$plant_n_machinery',other_fixed_assets='$other_fixed_assets',actual_prod_area='$actual_prod_area',godown='$godown',other_services='$other_services',power_req='$power_req',water_req='$water_req',if_any='$if_any',PI_indicate='$PI_indicate' WHERE user_id='$swr_id' AND form_id='$form_id'") OR die("Error: ".$dic->error);	
		}
		if($query)
				{
					$formFunctions->insert_incomplete_forms('dic','10'); //dic-- dept name and 1 -- form no
					echo "<script>
						alert('Successfully Saved..');
						window.location.href = 'dic_form10.php?tab=2';
					</script>";
				}
				else
				{
					echo "<script>
						alert('Invalid Entry');
						window.location.href = 'dic_form10.php';
					</script>";
				}
}
if(isset($_POST["submit10"])){
	if (empty($_POST["mfile1"]) || empty($_POST["mfile2"]) || empty($_POST["mfile3"]) || empty($_POST["mfile4"]) || empty($_POST["mfile5"]) || empty($_POST["mfile1"])=='2' || empty($_POST["mfile2"])=='2' || empty($_POST["mfile3"])=='2' || empty($_POST["mfile4"])=='2' || empty($_POST["mfile5"])=='2' || empty($_POST["mfile1"])=='3' || empty($_POST["mfile2"])=='3' || empty($_POST["mfile3"])=='3' || empty($_POST["mfile4"])=='3' || empty($_POST["mfile5"])=='3'){
		echo "<script>
					alert('Error in file / You didnot select any option.');
					window.location.href = 'dic_form10.php?tab=2';
				</script>";
	}else {
		 $file1=clean($_POST["mfile1"]);$file2=clean($_POST["mfile2"]);$file3=clean($_POST["mfile3"]);$file4=clean($_POST["mfile4"]);$file5=clean($_POST["mfile5"]);
		
		$sql=$dic->query("select form_id from dic_form10 where user_id='$swr_id' and active='1'");		
		if($sql->num_rows<1){				
			echo "<script>
				alert('Please fill the first part of the form.');
				window.location.href = 'dic_form10.php';
			</script>";
		}else{
			$row=$sql->fetch_array();
			$form_id=$row["form_id"];
			$savequery=$dic->query("update dic_form10 set file1='$file1',file2='$file2',file3='$file3',file4='$file4',file5='$file5' where form_id='$form_id'") or die($dic->error);
		}		
		if($savequery){
			$formFunctions->file_update($file1);$formFunctions->file_update($file2);$formFunctions->file_update($file3);$formFunctions->file_update($file4);$formFunctions->file_update($file5);
			
			if($file1=="SC" ||  $file2=="SC" ||  $file3=="SC" || $file4=="SC" ||  $file5=="SC"){
				$save_query=$dic->query("update dic_form10 set courier_details='1', sub_date='$today' where form_id='$form_id'") or die($dic->error);
			}else{
				$save_query=$dic->query("update dic_form10 set sub_date='$today', courier_details='' where form_id='$form_id'") or die($dic->error);
			}
			if($save_query){
				echo "<script>
					alert('Successfully Saved....');
					window.location.href = 'preview.php?token=10';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href ='dic_form10.php?tab=2';
				</script>";
			}			
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href ='dic_form10.php?tab=2';
			</script>";
		}
	}
}
if(isset($_POST["proceed10"])) {
	$query=$dic->query("select form_id,save_mode,courier_details from dic_form10 where user_id='$swr_id' and active='1'") or die("Error :". $dic->error);
	if($query->num_rows<1){
		echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'dic_form10.php';
			</script>";
	}else{
		$row=$query->fetch_array();
		$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];
		$uain=$formFunctions->create_uain($form_id,'dic','10');
		if($save_mode=="D" && $courier_details==1){
			$save_query=$dic->query("update dic_form10 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($dic->error);
			if($save_query){
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=dic&form=10';
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
			/////////////////////////////SEND MAIL////////////////////////////////
			$user_email=$formFunctions->get_usermail($swr_id);
			$dept_email="esgoa.dic@gmail.com";
			require_once "dic_form10_print.php"; 
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
					window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=10&dept=dic';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'dic_form10.php?tab=2';
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
?>