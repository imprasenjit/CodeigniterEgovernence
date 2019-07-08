<?php 
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
?>