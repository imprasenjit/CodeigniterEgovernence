<?php

//save dic form 12 old

if(isset($_POST["save12a"])){		
	$substantial_exp=clean($_POST["substantial_exp"]);$office_mob=clean($_POST["office_mob"]);$act_reg_date=clean($_POST["act_reg_date"]);$nature=clean($_POST["nature"]);$new_units_dt=clean($_POST["new_units_dt"]);$existing_units_dt=clean($_POST["existing_units_dt"]);
	$hidden_value=clean($_POST["hidden_value"]);
	
	if($act_reg_date!=""){
		$act_reg_date=date("Y-m-d",strtotime($act_reg_date));
	}else{
		$act_reg_date=NULL;
	}
		
	if(!empty($_POST["man_units"])) $man_units=json_encode($_POST["man_units"]);else $man_units=NULL;		
	if(!empty($_POST["ser_sector"])) $ser_sector=json_encode($_POST["ser_sector"]);else $ser_sector=NULL;
	
	$sql=$dic->query("select form_id from ".$table_name." where user_id='$swr_id' and active='1'") or die("Error :". $dic->error);
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$dic->query("insert into ".$table_name."(user_id,substantial_exp,office_mob,act_reg_date,nature,new_units_dt,existing_units_dt,man_units,ser_sector) values('$swr_id','$substantial_exp','$office_mob','$act_reg_date','$nature','$new_units_dt','$existing_units_dt','$man_units','$ser_sector')") or die("Error: ".$dic->error);
		$form_id=$dic->insert_id;
		$k=$dic->query("delete from ".$table_name."_members where form_id='$form_id'");
		for($i=1;$i<=$hidden_value;$i++){
			$name=$_POST["name".$i.""];$sn1=$_POST["sn1".$i.""];$sn2=$_POST["sn2".$i.""];$vill=$_POST["vill".$i.""];$dist=$_POST["dist".$i.""];$pin=$_POST["pin".$i.""];
			
			$query1=$dic->query("INSERT INTO ".$table_name."_members(id,form_id,sl_no,name,sn1,sn2,vill,dist,pin) VALUES ('','$form_id','$i','$name','$sn1','$sn2','$vill','$dist','$pin')") or die($dic->error);
		}
		
	}else{
		$form_id=$row["form_id"];
		$query=$dic->query("UPDATE ".$table_name." SET  sub_date='$today',substantial_exp='$substantial_exp', office_mob='$office_mob',act_reg_date='$act_reg_date',nature='$nature',new_units_dt='$new_units_dt',existing_units_dt='$existing_units_dt',man_units='$man_units',ser_sector='$ser_sector' WHERE form_id='$form_id'") OR die("Error: ".$dic->error);	
		for($i=1;$i<=$hidden_value;$i++){
			$name=$_POST["name".$i.""];$sn1=$_POST["sn1".$i.""];$sn2=$_POST["sn2".$i.""];$vill=$_POST["vill".$i.""];$dist=$_POST["dist".$i.""];$pin=$_POST["pin".$i.""];
			
			$query1=$dic->query("UPDATE ".$table_name."_members set name='$name',sn1='$sn1',sn2='$sn2',vill='$vill',dist='$dist',pin='$pin' where form_id='$form_id' and sl_no='$i'") or die($dic->error);
		}
	}
	if($query==true && $query1==true){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$table_name.".php?tab=2';
		</script>";
	}else{
		echo "<script>
			alert('Invalid Entry');
			window.location.href = '".$table_name.".php?tab=1';
		</script>";
	}
}
if(isset($_POST["save12b"])){	
	
	$input_size1=clean($_POST["hiddenval"]);$input_size2=clean($_POST["hiddenval2"]);	
	
	$bnk_ac_no=clean($_POST["bnk_ac_no"]);
	$acc_type=clean($_POST["acc_type"]);$bnk_name=clean($_POST["bnk_name"]);$bnk_branch=clean($_POST["bnk_branch"]);
	
	
	$period_of_claim_from=clean($_POST["period_of_claim_from"]);
	if($period_of_claim_from!=""){
		$period_of_claim_from=date("Y-m-d",strtotime($period_of_claim_from));
	}else{
		$period_of_claim_from=NULL;
	}
	
	$period_of_claim_to=clean($_POST["period_of_claim_to"]);
	if($period_of_claim_to!=""){
		$period_of_claim_to=date("Y-m-d",strtotime($period_of_claim_to));
	}else{
		$period_of_claim_to=NULL;
	}
	
	$period_of_power_subsidy_from=clean($_POST["period_of_power_subsidy_from"]);
	if($period_of_power_subsidy_from!=""){
		$period_of_power_subsidy_from=date("Y-m-d",strtotime($period_of_power_subsidy_from));
	}else{
		$period_of_power_subsidy_from=NULL;
	}
	
	$period_of_power_subsidy_to=clean($_POST["period_of_power_subsidy_to"]);
	if($period_of_power_subsidy_to!=""){
		$period_of_power_subsidy_to=date("Y-m-d",strtotime($period_of_power_subsidy_to));
	}else{
		$period_of_power_subsidy_to=NULL;
	}
	
	if(!empty($_POST["em_part1"])) $em_part1=json_encode($_POST["em_part1"]);else $em_part1=NULL;
	if(!empty($_POST["em_part2"])) $em_part2=json_encode($_POST["em_part2"]);else $em_part2=NULL;
	if(!empty($_POST["elig_cert"])) $elig_cert=json_encode($_POST["elig_cert"]);else $elig_cert=NULL;
	if(!empty($_POST["gstn"])) $gstn=json_encode($_POST["gstn"]);else $gstn=NULL;
	if(!empty($_POST["pan"])) $pan=json_encode($_POST["pan"]);else $pan=NULL;
	if(!empty($_POST["tot_elec"])) $tot_elec=json_encode($_POST["tot_elec"]);else $tot_elec=NULL;
	
	$tot_load_KVA1=clean($_POST["tot_load_KVA1"]);$sl_no_energy_met=clean($_POST["sl_no_energy_met"]);$ini_energy_meter=clean($_POST["ini_energy_meter"]);
	
	
	$sql=$dic->query("select form_id from ".$table_name." where user_id='$swr_id' and active='1'") or die("Error 313 :". $dic->error);
	$row=$sql->fetch_array();
	
	if($sql->num_rows<1){   ////////////table is empty//////////////
		echo "<script>
			alert('Please Fill up the first part of the form .');
			window.location.href = '".$table_name.".php';
		</script>";
	}else{		
		$form_id=$row["form_id"];
		
		$query=$dic->query("UPDATE ".$table_name." SET  sub_date='$today', bnk_ac_no='$bnk_ac_no',acc_type='$acc_type',bnk_name='$bnk_name',bnk_branch='$bnk_branch',period_of_claim_from='$period_of_claim_from',period_of_claim_to='$period_of_claim_to',period_of_power_subsidy_from='$period_of_power_subsidy_from',period_of_power_subsidy_to='$period_of_power_subsidy_to',em_part1='$em_part1',em_part2='$em_part2',elig_cert='$elig_cert',gstn='$gstn',pan='$pan',tot_elec='$tot_elec',tot_load_KVA1='$tot_load_KVA1',sl_no_energy_met='$sl_no_energy_met',ini_energy_meter='$ini_energy_meter' WHERE form_id='$form_id'") OR die("Error: ".$dic->error);	
	}	
	if($query){
		if($input_size1!=0){
				
		$k=$dic->query("delete from ".$table_name."_t1 where form_id='$form_id'");
		
			for($i=1;$i<$input_size1;$i++){
				//$vala=$_POST["txtA".$i];	
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$part1=$dic->query("INSERT INTO ".$table_name."_t1(id,form_id,slno,hsn_code,desc1) VALUES ('','$form_id','$i','$valb','$valc')") or die($dic->error);
				
			}
		}
		if($input_size2!=0){					
		$k=$dic->query("delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				//$vala=$_POST["textA".$i];	
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$part2=$dic->query("INSERT INTO ".$table_name."_t2(id,form_id,slno,nic_code,desc2) VALUES ('','$form_id','$i','$valb','$valc')") or die($dic->error);
			}
		}
		
			 echo "<script>
				alert('Successfully Saved..');
				window.location.href =  '".$table_name.".php?tab=3';
			</script>";	
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=2';
		</script>";
	}	
}

if(isset($_POST["save12c"])){

	if(!empty($_POST["existing_sanction"])) $existing_sanction=json_encode($_POST["existing_sanction"]);
	else $existing_sanction=NULL;
	
	$existing_elec_load=clean($_POST["existing_elec_load"]);$tot_elec_load_con=clean($_POST["tot_elec_load_con"]);$sl_no_energy_met_all=clean($_POST["sl_no_energy_met_all"]);$ini_meter_reading=clean($_POST["ini_meter_reading"]);$last_meter_reading=clean($_POST["last_meter_reading"]);$mon_elec_consump=clean($_POST["mon_elec_consump"]);$per_increase_fix_cap=clean($_POST["per_increase_fix_cap"]);$ins_name=clean($_POST["ins_name"]);
	
	if(!empty($_POST["ins"])) $ins=json_encode($_POST["ins"]);else $ins=NULL;
	
	$comm_dt_first_fire=clean($_POST["comm_dt_first_fire"]);
	
	if(!empty($_POST["period_of_ins"])) $period_of_ins=json_encode($_POST["period_of_ins"]);else $period_of_ins=NULL;
	
	$fire_policy_no=clean($_POST["fire_policy_no"]);$basis_sum_insured=clean($_POST["basis_sum_insured"]);$tot_sum_ins1=clean($_POST["tot_sum_ins1"]);
	
	$sql=$dic->query("select form_id from ".$table_name." where user_id='$swr_id' and active='1'") or die("Error :". $dic->error);
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		echo "<script>
			alert('Please Fill up the first part of the form .');
			window.location.href = '".$table_name.".php';
		</script>";
	}else{
		$form_id=$row["form_id"];
		$query=$dic->query("UPDATE ".$table_name." SET existing_sanction='$existing_sanction',existing_elec_load='$existing_elec_load',tot_elec_load_con='$tot_elec_load_con',sl_no_energy_met_all='$sl_no_energy_met_all',ini_meter_reading='$ini_meter_reading',last_meter_reading='$last_meter_reading',mon_elec_consump='$mon_elec_consump',per_increase_fix_cap='$per_increase_fix_cap',ins_name='$ins_name',ins='$ins',comm_dt_first_fire='$comm_dt_first_fire',period_of_ins='$period_of_ins',fire_policy_no='$fire_policy_no',basis_sum_insured='$basis_sum_insured',tot_sum_ins1='$tot_sum_ins1' WHERE form_id='$form_id'") OR die("Error: ".$dic->error);	
	}
	if($query){
			echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$table_name.".php?tab=4';
		</script>";
	}else{
			echo "<script>
			alert('Invalid Entry');
			window.location.href = '".$table_name.".php?tab=3';
		</script>";
	}
}
if(isset($_POST["save12d"])){
	$boundary_wall=clean($_POST["boundary_wall"]);$buildings=clean($_POST["buildings"]);$plant_machinery=clean($_POST["plant_machinery"]);$misc_fixed_assets=clean($_POST["misc_fixed_assets"]);$net_pre_paid=clean($_POST["net_pre_paid"]);$amount_of_refund=clean($_POST["amount_of_refund"]);$is_cert_policy=clean($_POST["is_cert_policy"]);$reim_ins_premium=clean($_POST["reim_ins_premium"]);$work_capital_bnk_name=clean($_POST["work_capital_bnk_name"]);$work_capital_branch=clean($_POST["work_capital_branch"]);$cash_credit_acc_no=clean($_POST["cash_credit_acc_no"]);$work_capital_limit=clean($_POST["work_capital_limit"]);$sanction_number=clean($_POST["sanction_number"]);$sanction_dt2=clean($_POST["sanction_dt2"]);$tot_interest_charged_bnk=clean($_POST["tot_interest_charged_bnk"]);$tot_interest_subsidy_elig=clean($_POST["tot_interest_subsidy_elig"]);
	
	
	if($sanction_dt2!=""){
		$sanction_dt2=date("Y-m-d",strtotime($sanction_dt2));
	}else{
		$sanction_dt2=NULL;
	}
	
	
	$sql=$dic->query("select form_id from ".$table_name." where user_id='$swr_id' and active='1'") or die("Error :". $dic->error);
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		echo "<script>
			alert('Please Fill up the first part of the form .');
			window.location.href = '".$table_name.".php';
		</script>";
	}else{
		$form_id=$row["form_id"];
		$query=$dic->query("UPDATE ".$table_name." SET boundary_wall='$boundary_wall',buildings='$buildings', plant_machinery='$plant_machinery',misc_fixed_assets='$misc_fixed_assets',net_pre_paid='$net_pre_paid',amount_of_refund='$amount_of_refund',is_cert_policy='$is_cert_policy',reim_ins_premium='$reim_ins_premium',work_capital_bnk_name='$work_capital_bnk_name',work_capital_branch='$work_capital_branch',cash_credit_acc_no='$cash_credit_acc_no',work_capital_limit='$work_capital_limit', sanction_number='$sanction_number',sanction_dt2='$sanction_dt2',tot_interest_charged_bnk='$tot_interest_charged_bnk',tot_interest_subsidy_elig='$tot_interest_subsidy_elig' WHERE form_id='$form_id'") OR die("Error: ".$dic->error);	
	}
	if($query){
			echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$table_name.".php?tab=5';
		</script>";
	}else{
			echo "<script>
			alert('Invalid Entry');
			window.location.href = '".$table_name.".php?tab=4';
		</script>";
	}
}
if(isset($_POST["save12e"])){ 
	
	if(!empty($_POST["capital_investment"]))	 $capital_investment=json_encode($_POST["capital_investment"]);
	else	$capital_investment=NULL;
	
	$source_of_fin1=clean($_POST["source_of_fin1"]);
	$source_of_fin2=clean($_POST["source_of_fin2"]);$source_of_fin3=clean($_POST["source_of_fin3"]);$source_of_fin4=clean($_POST["source_of_fin4"]);$source_of_fin5=clean($_POST["source_of_fin5"]);$source_of_fin6=clean($_POST["source_of_fin6"]);
	
	$input_size3=clean($_POST["hiddenval3"]);$input_size4=clean($_POST["hiddenval4"]);$input_size5=clean($_POST["hiddenval5"]);
	
	$sql=$dic->query("select form_id from ".$table_name." where user_id='$swr_id' and active='1'") or die("Error :". $dic->error);
	$row=$sql->fetch_array();
	if($sql->num_rows<1){  ////////////table is empty//////////////
		echo "<script>
			alert('Please fill up the first part of the form .');
			window.location.href = '".$table_name.".php';
		</script>";
	}else{
		$form_id=$row["form_id"];
		$query=$dic->query("UPDATE ".$table_name." SET capital_investment='$capital_investment',source_of_fin1='$source_of_fin1',source_of_fin2='$source_of_fin2',source_of_fin3='$source_of_fin3',source_of_fin4='$source_of_fin4',source_of_fin5='$source_of_fin5',source_of_fin6='$source_of_fin6' WHERE form_id='$form_id'") OR die("Error: ".$dic->error);	
	}	
	if($query){
		if($input_size3!=0){					
		$k=$dic->query("delete from ".$table_name."_t3 where form_id='$form_id'");
			for($i=1;$i<$input_size3;$i++){
				//$vala=$_POST["txtA".$i];	
				$valb=$_POST["taB".$i];
				$valc=$_POST["taC".$i];
				$vald=$_POST["taD".$i];
				$vale=$_POST["taE".$i];
				$valf=$_POST["taF".$i];
				
				$part3=$dic->query("INSERT INTO ".$table_name."_t3(id,form_id,slno,bnk_fin_name,term_amount,sanction_letter_no,sanction_date_no,working_cap_term_amt) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale','$valf')") or die($dic->error);
			}
		}
		if($input_size4!=0){					
		$k=$dic->query("delete from ".$table_name."_t4 where form_id='$form_id'");
			for($i=1;$i<$input_size4;$i++){
				//$vala=$_POST["textA".$i];	
				$valb=$_POST["tbB".$i];
				$valc=$_POST["tbC".$i];
				$vald=$_POST["tbD".$i];	
				$vale=$_POST["tbE".$i];	
					
				$part4=$dic->query("INSERT INTO ".$table_name."_t4(id,form_id,slno,name_person,amt,pan_no,pay_mode) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')") or die($dic->error);
			}
		}
		if($input_size5!=0){					
		$k=$dic->query("delete from ".$table_name."_t5 where form_id='$form_id'");
			for($i=1;$i<$input_size5;$i++){
				//$vala=$_POST["txxtA".$i];		
				$valb=$_POST["tcB".$i];
				$valc=$_POST["tcC".$i];
				$vald=$_POST["tcD".$i];				
				$vale=$_POST["tcE".$i];				
				$part5=$dic->query("INSERT INTO ".$table_name."_t5(id,form_id,slno,name_person2,amt2,pan_no2,pay_mode2) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')") or die($dic->error);
			}
		}
		
		if((isset($part3) && $part3==false) || (isset($part4) && $part4==false) || (isset($part5) && $part5==false)){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=5';
			</script>";
		}else{
			 echo "<script>
				alert('Successfully Saved..');
				window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
			</script>";
		}	
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=5';
		</script>";
	}	
}




?>