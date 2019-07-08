<?php 
if(isset($_POST["save1a"])){
	$website_name=clean($_POST["website_name"]); $owner_name=clean($_POST["owner_name"]); $o_street_name1=clean($_POST["o_street_name1"]); $o_street_name2=clean($_POST["o_street_name2"]); $o_vill=clean($_POST["o_vill"]); $o_block=clean($_POST["o_block"]); $o_dist=clean($_POST["o_dist"]); $o_pin=clean($_POST["o_pin"]); $o_mobile_no=clean($_POST["o_mobile_no"]); $o_email=clean($_POST["o_email"]);$starting_date=clean($_POST["starting_date"]);$o_landline_no=clean($_POST["o_landline_no"]);$input_size=clean($_POST["hiddenval"]);$location_type=clean($_POST["location_type"]);$fees_description=clean($_POST["fees_description"]);
			
	
	if(!empty($_POST["ownership"]))	$ownership=json_encode($_POST["ownership"]);
	else $ownership=NULL;
	if(!empty($_POST["ownership2"]))	$ownership2=json_encode($_POST["ownership2"]);
	else $ownership2=NULL;
	if(!empty($_POST["systems"]))	$systems=json_encode($_POST["systems"]);
	else $systems=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		$savequery=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,website_name,starting_date,location_type,fees_description,ownership,ownership2,owner_name,o_street_name1,o_street_name2,o_vill,o_block,o_dist,o_landline_no,o_pin,o_mobile_no,o_email,systems) values ('$swr_id','$today','$website_name','$starting_date','$location_type','$fees_description','$ownership','$ownership2','$owner_name','$o_street_name1','$o_street_name2','$o_vill','$o_block','$o_dist','$o_landline_no','$o_pin','$o_mobile_no','$o_email','$systems')");
		$form_id=$savequery;
	}else{	
		$form_id=$sql->fetch_object()->form_id;
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET sub_date='$today',website_name='$website_name',starting_date='$starting_date',location_type='$location_type',fees_description='$fees_description', ownership='$ownership',ownership2='$ownership2',owner_name='$owner_name',o_street_name1='$o_street_name1',o_street_name2='$o_street_name2',o_vill='$o_vill',o_block='$o_block',o_dist='$o_dist',o_landline_no='$o_landline_no',o_pin='$o_pin',o_mobile_no='$o_mobile_no',o_email='$o_email',systems='$systems' WHERE form_id='$form_id'");
	}
	
	if($savequery){
		$formFunctions->insert_incomplete_forms($dept,$form);
		if($input_size!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$valf=$_POST["txtF".$i];
				$valg=$_POST["txtG".$i];
				$valh=$_POST["txtH".$i];				
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,sl_no,name,designation,qualification,reg_no,name_of_central,mobile,email) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg','$valh')");
			}
		}	
		echo "<script>
				alert('Successfully Saved..');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=1';
		</script>";
	}	
}
if(isset($_POST["save1b"])){
	if(!empty($_POST["clinic"]))	$clinic=json_encode($_POST["clinic"]);
	else $clinic=NULL;
	if(!empty($_POST["facility"]))	$facility=json_encode($_POST["facility"]);
	else $facility=NULL;
	if(!empty($_POST["hospital"]))	$hospital=json_encode($_POST["hospital"]);
	else $hospital=NULL;
	if(!empty($_POST["dental"]))	$dental=json_encode($_POST["dental"]);
	else $dental=NULL;
	if(!empty($_POST["dentalcl"]))	$dentalcl=json_encode($_POST["dentalcl"]);
	else $dentalcl=NULL;
	if(!empty($_POST["medical"]))	$medical=json_encode($_POST["medical"]);
	else $medical=NULL;
	if(!empty($_POST["imaging"]))	$imaging=json_encode($_POST["imaging"]);
	else $imaging=NULL;
	if(!empty($_POST["imagingel"]))	$imagingel=json_encode($_POST["imagingel"]);
	else $imagingel=NULL;
	if(!empty($_POST["imagingul"]))	$imagingul=json_encode($_POST["imagingul"]);
	else $imagingul=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		$savequery=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,clinic,facility,hospital,dentalcl,dental,medical,imaging,imagingel,imagingul) values ('$swr_id','$clinic','$o_street_name1','$facility','$hospital','$dentalcl','$dental','$medical','$imaging','$imagingel','$imagingul')");
		$form_id=$savequery;
	}else{	
		$form_id=$sql->fetch_object()->form_id;
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET clinic='$clinic', facility='$facility', hospital='$hospital', dentalcl='$dentalcl',dental='$dental',medical='$medical',imaging='$imaging',imagingel='$imagingel',imagingul='$imagingul' WHERE form_id='$form_id'");
	}
	if($savequery){
		echo "<script>
				alert('Successfully Saved..');
				window.location.href = '".$table_name.".php?tab=3';
			</script>";
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=2';
		</script>";
	}	
}
if(isset($_POST["save1c"])){
	if(!empty($_POST["miscellaneous"]))	$miscellaneous=json_encode($_POST["miscellaneous"]);
	else $miscellaneous=NULL;
	 $is_clinical=clean($_POST["is_clinical"]);
	if(!empty($_POST["alliedh"]))	$alliedh=json_encode($_POST["alliedh"]);
	else $alliedh=NULL;
	if(!empty($_POST["ayush"]))	$ayush=json_encode($_POST["ayush"]);
	else $ayush=NULL;
	if(!empty($_POST["ayushyo"]))	$ayushyo=json_encode($_POST["ayushyo"]);
	else $ayushyo=NULL;
	if(!empty($_POST["ayushun"]))	$ayushun=json_encode($_POST["ayushun"]);
	else $ayushun=NULL;
	if(!empty($_POST["ayushsi"]))	$ayushsi=json_encode($_POST["ayushsi"]);
	else $ayushsi=NULL;
	if(!empty($_POST["ayushho"]))	$ayushho=json_encode($_POST["ayushho"]);
	else $ayushho=NULL;
	if(!empty($_POST["ayushna"]))	$ayushna=json_encode($_POST["ayushna"]);
	else $ayushna=NULL;
	if(!empty($_POST["collction_center"]) && $_POST["is_clinical"]=='Y')	$collction_center=$_POST["collction_center"];
	else	$collction_center=NULL;	
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		$savequery=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,miscellaneous,is_clinical,collction_center,alliedh,ayush,ayushyo,ayushun,ayushsi,ayushho,ayushna) values ('$swr_id','$miscellaneous','$is_clinical','$collction_center','$alliedh','$ayush','$ayushyo','$ayushun','$ayushsi','$ayushho','$ayushna')");
		$form_id=$savequery;
	}else{	
		$form_id=$sql->fetch_object()->form_id;
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET miscellaneous='$miscellaneous',is_clinical='$is_clinical',collction_center='$collction_center', alliedh='$alliedh',ayush='$ayush',ayushyo='$ayushyo',ayushun='$ayushun',ayushsi='$ayushsi',ayushho='$ayushho',ayushna='$ayushna' WHERE form_id='$form_id'");
	}
	if($savequery){
		echo "<script>
				alert('Successfully Saved..');
				window.location.href = '".$table_name.".php?tab=4';
			</script>";
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=3';
		</script>";
	}	
}
if(isset($_POST["save1d"])){
	if(!empty($_POST["service"]))	$service=json_encode($_POST["service"]);
	else $service=NULL;
	if(!empty($_POST["degree"]))	$degree=json_encode($_POST["degree"]);
	else $degree=NULL;
	if(!empty($_POST["surgical_special"]))	$surgical_special=json_encode($_POST["surgical_special"]);
	else $surgical_special=NULL;
	if(!empty($_POST["specialties"]))	$specialties=json_encode($_POST["specialties"]);
	else $specialties=NULL;
	if(!empty($_POST["surgical"]))	$surgical=json_encode($_POST["surgical"]);
	else $surgical=NULL;

	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		$savequery=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,service,degree,surgical_special,specialties,surgical) values ('$swr_id','$service','$degree','$surgical_special','$specialties','$surgical')");
		$form_id=$savequery;
	}else{	
		$form_id=$sql->fetch_object()->form_id;
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET service='$service',degree='$degree',surgical_special='$surgical_special',specialties='$specialties',surgical='$surgical' WHERE form_id='$form_id'") OR die("Error bhanita: ".$health->error);
	}
	if($savequery){
		echo "<script>
				alert('Successfully Saved..');
				window.location.href = '".$table_name.".php?tab=5';
			</script>";
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=4';
		</script>";
	}	
}
if(isset($_POST["save1e"])){
	$estarea=clean($_POST["estarea"]); $cnstarea=clean($_POST["cnstarea"]); $total_no=clean($_POST["total_no"]); 
	$input_size1=clean($_POST["hiddenval2"]); $input_size2=clean($_POST["hiddenval3"]); $total_no_bed=clean($_POST["total_no_bed"]); 
	if(!empty($_POST["biomedical"]))	$biomedical=json_encode($_POST["biomedical"]);
	else $biomedical=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		$savequery=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,estarea,cnstarea,total_no,total_no_bed,biomedical) values ('$swr_id',,'$estarea','$cnstarea','$total_no','$total_no_bed','$biomedical')");
		$form_id=$savequery;
	}else{	
		$form_id=$sql->fetch_object()->form_id;
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET estarea='$estarea',cnstarea='$cnstarea',total_no='$total_no',total_no_bed='$total_no_bed',biomedical='$biomedical' WHERE form_id='$form_id'");
	}
	
	if($savequery){
		if($input_size1!=0){					
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size1;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["textB".$i];
				$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(id,form_id,slno,special) VALUES ('','$form_id','$i','$valb')");
			}
		}
		if($input_size2!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t3 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["taB".$i];
				$valc=$_POST["taC".$i];
						
				$part3=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t3(id,form_id,slno,specialty,bed) VALUES ('','$form_id','$i','$valb','$valc')");
			}
		}
		echo "<script>
				alert('Successfully Saved..');
				window.location.href = '".$table_name.".php?tab=6';
			</script>";
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=5';
		</script>";
	}	
}
if(isset($_POST["save1f"])){
	$permanent_no=clean($_POST["permanent_no"]);$temporary_no=clean($_POST["temporary_no"]);
	$input_size3=clean($_POST["hiddenval4"]);$input_size4=clean($_POST["hiddenval5"]);
	$is_authorization=clean($_POST["is_authorization"]);
	$is_pollution=clean($_POST["is_pollution"]);
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		$savequery=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,is_authorization,is_pollution,permanent_no,temporary_no,sub_date) values ('$swr_id',,'$today','$pollution','$permanent_no','$temporary_no')");
		$form_id=$savequery;
	}else{	
		$form_id=$sql->fetch_object()->form_id;
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET sub_date='$today',is_authorization='$is_authorization',is_pollution='$is_pollution',permanent_no='$permanent_no',temporary_no='$temporary_no' WHERE form_id='$form_id'");
	}
	if($savequery){
		if($input_size3!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t4 where form_id='$form_id'");
			for($i=1;$i<$input_size3;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["tbB".$i];
				$valc=$_POST["tbC".$i];
				$vald=$_POST["tbD".$i];
				$vale=$_POST["tbE".$i];
				$valf=$_POST["tbF".$i];
						
				$part4=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t4(id,form_id,slno,name,select_category,qualification,registration,nature) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale','$valf')");
			}
		}	
	   if($input_size4!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t5 where form_id='$form_id'");
			for($i=1;$i<$input_size4;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["tfB".$i];
				$valc=$_POST["tfC".$i];
				$vald=$_POST["tfD".$i];
				$part5=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t5(id,form_id,slno,cate_gory,total_no,remark) VALUES ('','$form_id','$i','$valb','$valc','$vald')");
			}
		}	
	echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";						
	}else{
		   echo "<script>
		   alert('Invalid Entry');
		   window.location.href = '".$table_name.".php';
		</script>";
	}		
}

if(isset($_POST["save2"])){
	$website_name=clean($_POST["website_name"]); $owner_name=clean($_POST["owner_name"]); $o_street_name1=clean($_POST["o_street_name1"]); $o_street_name2=clean($_POST["o_street_name2"]); $o_vill=clean($_POST["o_vill"]); $o_block=clean($_POST["o_block"]); $o_dist=clean($_POST["o_dist"]); $o_pin=clean($_POST["o_pin"]); $o_mobile_no=clean($_POST["o_mobile_no"]); $o_email=clean($_POST["o_email"]); $input_size=clean($_POST["hiddenval"]); $any_other=clean($_POST["any_other"]); $no_bed=clean($_POST["no_bed"]); $location_type=clean($_POST["location_type"]); $fees_description=clean($_POST["fees_description"]); 
	
	if(!empty($_POST["ownership"]))	$ownership=json_encode($_POST["ownership"]);
	else $ownership=NULL;
	if(!empty($_POST["ownership2"]))	$ownership2=json_encode($_POST["ownership2"]);
	else $ownership2=NULL;
	if(!empty($_POST["system"]))	$system=json_encode($_POST["system"]);
	else $system=NULL;
	if(!empty($_POST["clinical"]))	$clinical=json_encode($_POST["clinical"]);
	else $clinical=NULL;
	if(!empty($_POST["clinical_est"]))	$clinical_est=json_encode($_POST["clinical_est"]);
	else $clinical_est=NULL;
	if(!empty($_POST["inpatient"]))	$inpatient=json_encode($_POST["inpatient"]);
	else $inpatient=NULL;
	if(!empty($_POST["outpatient"]))	$outpatient=json_encode($_POST["outpatient"]);
	else $outpatient=NULL;
	if(!empty($_POST["laboratory"]))	$laboratory=json_encode($_POST["laboratory"]);
	else $laboratory=NULL;
	if(!empty($_POST["imaging_center"]))	$imaging_center=json_encode($_POST["imaging_center"]);
	else $imaging_center=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		$savequery=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,website_name,owner_name,o_street_name1,o_street_name2,o_vill,o_block,o_dist,o_pin,o_mobile_no,o_email,location_type,fees_description,ownership,ownership2,system,clinical,clinical_est,inpatient,no_bed,outpatient,laboratory,imaging_center,any_other) values ('$swr_id','$today','$website_name','$owner_name','$o_street_name1','$o_street_name2','$o_vill','$o_block','$o_dist','$o_pin','$o_mobile_no','$o_email','$location_type','$fees_description','$ownership','$ownership2','$system','$clinical','$clinical_est','$inpatient','$no_bed','$outpatient','$laboratory','$imaging_center','$any_other')");
		$form_id=$savequery;
	}else{	
		$form_id=$sql->fetch_object()->form_id;
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET sub_date='$today',website_name='$website_name', owner_name='$owner_name', o_street_name1='$o_street_name1', o_street_name2='$o_street_name2', o_vill='$o_vill', o_block='$o_block',o_dist='$o_dist',o_pin='$o_pin',o_mobile_no='$o_mobile_no', o_email='$o_email',location_type='$location_type',fees_description='$fees_description', ownership='$ownership', ownership2='$ownership2', system='$system', clinical='$clinical', clinical_est='$clinical_est',inpatient='$inpatient',no_bed='$no_bed',outpatient='$outpatient',laboratory='$laboratory',imaging_center='$imaging_center',any_other='$any_other' WHERE form_id='$form_id'");
	}
	
	if($savequery){
		$formFunctions->insert_incomplete_forms($dept,$form);
		if($input_size!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$valf=$_POST["txtF".$i];
				$valg=$_POST["txtG".$i];			
				$valh=$_POST["txtH".$i];			
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,sl_no,name,designation,qualification,reg_no,name_of_central,mobile,email) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg','$valh')");
			}
		}	
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";						
	}else{
		   echo "<script>
		   alert('Invalid Entry');
		   window.location.href = '".$table_name.".php';
		</script>";
	}
}

if(isset($_POST["save6"])){
	$website_name=clean($_POST["website_name"]); $owner_name=clean($_POST["owner_name"]); $o_street_name1=clean($_POST["o_street_name1"]); $o_street_name2=clean($_POST["o_street_name2"]); $o_vill=clean($_POST["o_vill"]); $o_block=clean($_POST["o_block"]); $o_dist=clean($_POST["o_dist"]); $o_pin=clean($_POST["o_pin"]); $o_mobile_no=clean($_POST["o_mobile_no"]); $o_email=clean($_POST["o_email"]); $input_size=clean($_POST["hiddenval"]); $any_other=clean($_POST["any_other"]); $no_bed=clean($_POST["no_bed"]); $location_type=clean($_POST["location_type"]); $fees_description=clean($_POST["fees_description"]); 
	
	if(!empty($_POST["ownership"]))	$ownership=json_encode($_POST["ownership"]);
	else $ownership=NULL;
	if(!empty($_POST["ownership2"]))	$ownership2=json_encode($_POST["ownership2"]);
	else $ownership2=NULL;
	if(!empty($_POST["system"]))	$system=json_encode($_POST["system"]);
	else $system=NULL;
	if(!empty($_POST["clinical"]))	$clinical=json_encode($_POST["clinical"]);
	else $clinical=NULL;
	if(!empty($_POST["clinical_est"]))	$clinical_est=json_encode($_POST["clinical_est"]);
	else $clinical_est=NULL;
	if(!empty($_POST["inpatient"]))	$inpatient=json_encode($_POST["inpatient"]);
	else $inpatient=NULL;
	if(!empty($_POST["outpatient"]))	$outpatient=json_encode($_POST["outpatient"]);
	else $outpatient=NULL;
	if(!empty($_POST["laboratory"]))	$laboratory=json_encode($_POST["laboratory"]);
	else $laboratory=NULL;
	if(!empty($_POST["imaging_center"]))	$imaging_center=json_encode($_POST["imaging_center"]);
	else $imaging_center=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		$savequery=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,website_name,owner_name,o_street_name1,o_street_name2,o_vill,o_block,o_dist,o_pin,o_mobile_no,o_email,location_type,fees_description,ownership,ownership2,system,clinical,clinical_est,inpatient,no_bed,outpatient,laboratory,imaging_center,any_other) values ('$swr_id','$today','$website_name','$owner_name','$o_street_name1','$o_street_name2','$o_vill','$o_block','$o_dist','$o_pin','$o_mobile_no','$o_email','$location_type','$fees_description','$ownership','$ownership2','$system','$clinical','$clinical_est','$inpatient','$no_bed','$outpatient','$laboratory','$imaging_center','$any_other')");
		$form_id=$savequery;
	}else{	
		$form_id=$sql->fetch_object()->form_id;
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET sub_date='$today',website_name='$website_name', owner_name='$owner_name', o_street_name1='$o_street_name1', o_street_name2='$o_street_name2', o_vill='$o_vill', o_block='$o_block',o_dist='$o_dist',o_pin='$o_pin',o_mobile_no='$o_mobile_no', o_email='$o_email',location_type='$location_type',fees_description='$fees_description', ownership='$ownership', ownership2='$ownership2', system='$system', clinical='$clinical', clinical_est='$clinical_est',inpatient='$inpatient',no_bed='$no_bed',outpatient='$outpatient',laboratory='$laboratory',imaging_center='$imaging_center',any_other='$any_other' WHERE form_id='$form_id'");
	}
	
	if($savequery){
		$formFunctions->insert_incomplete_forms($dept,$form);
		if($input_size!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$valf=$_POST["txtF".$i];
				$valg=$_POST["txtG".$i];			
				$valh=$_POST["txtH".$i];			
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,sl_no,name,designation,qualification,reg_no,name_of_central,mobile,email) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg','$valh')");
			}
		}	
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";						
	}else{
		   echo "<script>
		   alert('Invalid Entry');
		   window.location.href = '".$table_name.".php';
		</script>";
	}
}
 
if(isset($_POST["save3"])){
	$h_name=clean($_POST["h_name"]);$h_location=clean($_POST["h_location"]);$is_gov_private=clean($_POST["is_gov_private"]);$is_teaching_non=clean($_POST["is_teaching_non"]);$is_road=clean($_POST["is_road"]);$is_rail=clean($_POST["is_rail"]);$is_air=clean($_POST["is_air"]); $is_blood=clean($_POST["is_blood"]); $is_dialysis=clean($_POST["is_dialysis"]);$bed_strength=clean($_POST["bed_strength"]); $discipline=clean($_POST["discipline"]); $annual_budget=clean($_POST["annual_budget"]);$patient_year=clean($_POST["patient_year"]);$sur_bed=clean($_POST["sur_bed"]);$sur_operation=clean($_POST["sur_operation"]);$sur_organ=clean($_POST["sur_organ"]);$med_bed=clean($_POST["med_bed"]);$med_operation=clean($_POST["med_operation"]);$med_organ=clean($_POST["med_organ"]);$med_potential=clean($_POST["med_potential"]);$anaes_theatre=clean($_POST["anaes_theatre"]);$anaes_emergancy=clean($_POST["anaes_emergancy"]);$anaes_transplant=clean($_POST["anaes_transplant"]);$facility_present=clean($_POST["facility_present"]);$facility_not_present=clean($_POST["facility_not_present"]);$icu_bed=clean($_POST["icu_bed"]);$icu_equip=clean($_POST["icu_equip"]);$nurses=clean($_POST["nurses"]);$technicians=clean($_POST["technicians"]);$data=clean($_POST["data"]);$lab_investigation=clean($_POST["lab_investigation"]);$image_investigation=clean($_POST["image_investigation"]);$haematology_investigation=clean($_POST["haematology_investigation"]);
	$is_nephrologist=clean($_POST["is_nephrologist"]);$is_neurologist=clean($_POST["is_neurologist"]);
	$is_neuro_surgeon=clean($_POST["is_neuro_surgeon"]);$is_urologist=clean($_POST["is_urologist"]);
	$is_surgeon=clean($_POST["is_surgeon"]);
	$is_paediatrician=clean($_POST["is_paediatrician"]);$is_physiotherapist=clean($_POST["is_physiotherapist"]);$is_social=clean($_POST["is_social"]);$is_immunologists=clean($_POST["is_immunologists"]);
	$is_respiratory=clean($_POST["is_respiratory"]);$is_others=clean($_POST["is_others"]);$is_cardiologist=clean($_POST["is_cardiologist"]);
	
	$input_size=clean($_POST["hiddenval"]);$input_size1=clean($_POST["hiddenval2"]);
	$input_size2=clean($_POST["hiddenval3"]);$input_size3=clean($_POST["hiddenval4"]);$input_size4=clean($_POST["hiddenval5"]);$input_size5=clean($_POST["hiddenval6"]);$input_size6=clean($_POST["hiddenval7"]);$input_size7=clean($_POST["hiddenval8"]);$input_size8=clean($_POST["hiddenval9"]);$input_size9=clean($_POST["hiddenval10"]);
	$input_size10=clean($_POST["hiddenval11"]);$input_size11=clean($_POST["hiddenval12"]);$input_size12=clean($_POST["hiddenval13"]);$input_size13=clean($_POST["hiddenval14"]);$input_size14=clean($_POST["hiddenval15"]);$input_size15=clean($_POST["hiddenval16"]);$input_size16=clean($_POST["hiddenval17"]);
		
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		$savequery=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,h_name,h_location,is_gov_private,is_teaching_non,is_road,is_rail,is_air,bed_strength,discipline,annual_budget,patient_year,sur_bed,sur_operation,sur_organ,med_bed,med_operation,med_organ,med_potential,anaes_theatre,anaes_emergancy,anaes_transplant,facility_present,facility_not_present,icu_bed,nurses,technicians,icu_equip,data,lab_investigation,image_investigation,haematology_investigation,is_blood,is_dialysis,is_nephrologist,is_neurologist,is_neuro_surgeon,is_urologist,is_surgeon,is_paediatrician,is_physiotherapist,is_social,is_immunologists,is_cardiologist,is_respiratory,is_others) values ('$swr_id','$today','$h_name','$h_location','$is_gov_private','$is_teaching_non','$is_road','$is_rail','$is_air','$bed_strength','$discipline','$annual_budget','$patient_year','$sur_bed','$sur_operation','$sur_organ','$med_bed','$med_operation','$med_organ','$med_potential','$anaes_theatre','$anaes_emergancy','$anaes_transplant','$facility_present','$facility_not_present','$icu_bed','$nurses','$technicians','$icu_equip','$data','$lab_investigation','$image_investigation','$haematology_investigation','$is_blood','$is_dialysis','$is_nephrologist','$is_neurologist','$is_neuro_surgeon','$is_urologist','$is_surgeon','$is_paediatrician','$is_physiotherapist','$is_social','$is_immunologists','$is_cardiologist','$is_respiratory','$is_others')");
		$form_id=$savequery;
	}else{	
		$form_id=$sql->fetch_object()->form_id;
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET sub_date='$today',h_name='$h_name', h_location='$h_location', is_gov_private='$is_gov_private', is_teaching_non='$is_teaching_non', is_road='$is_road', is_rail='$is_rail', is_air='$is_air', bed_strength='$bed_strength',discipline='$discipline', annual_budget='$annual_budget',patient_year='$patient_year',sur_bed='$sur_bed',sur_operation='$sur_operation',sur_organ='$sur_organ',  med_bed='$med_bed',med_operation='$med_operation',med_organ='$med_organ',med_potential='$med_potential',anaes_theatre='$anaes_theatre',anaes_emergancy='$anaes_emergancy',anaes_transplant='$anaes_transplant',facility_present='$facility_present',facility_not_present='$facility_not_present',icu_bed='$icu_bed',nurses='$nurses',technicians='$technicians',icu_equip='$icu_equip',data='$data',lab_investigation='$lab_investigation',image_investigation='$image_investigation',haematology_investigation='$haematology_investigation',is_blood='$is_blood',is_dialysis='$is_dialysis',is_nephrologist='$is_nephrologist',is_neurologist='$is_neurologist',is_neuro_surgeon='$is_neuro_surgeon',is_urologist='$is_urologist',is_surgeon='$is_surgeon',is_paediatrician='$is_paediatrician',is_physiotherapist='$is_physiotherapist',is_immunologists='$is_immunologists',is_social='$is_social',is_cardiologist='$is_cardiologist',is_respiratory='$is_respiratory',is_others='$is_others' WHERE form_id='$form_id'");
	}
	
	if($savequery){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		if($input_size!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
							
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,sl_no,name,designation) VALUES ('','$form_id','$i','$valb','$valc')");
			}
		}
		if($input_size1!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size1;$i++){
						
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
							
				$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(id,form_id,sl_no,name,designation) VALUES ('','$form_id','$i','$valb','$valc')");
			}
		}		
		if($input_size2!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t3 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["taB".$i];
				$valc=$_POST["taC".$i];
					
				$part3=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t3(id,form_id,sl_no,name,designation) VALUES ('','$form_id','$i','$valb','$valc')");
			}
		}		
		if($input_size3!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t4 where form_id='$form_id'");
			for($i=1;$i<$input_size3;$i++){
					
				$valb=$_POST["tbB".$i];
				$valc=$_POST["tbC".$i];
							
				$part4=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t4(id,form_id,sl_no,name,designation) VALUES ('','$form_id','$i','$valb','$valc')");
			}
		}		
		if($input_size4!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t5 where form_id='$form_id'");
			for($i=1;$i<$input_size4;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["txxB".$i];
				$valc=$_POST["txxC".$i];
						
				$part5=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t5(id,form_id,sl_no,name,designation) VALUES ('','$form_id','$i','$valb','$valc')");
			}
		}
		if($input_size5!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t6 where form_id='$form_id'");
			for($i=1;$i<$input_size5;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["tdB".$i];
				$valc=$_POST["tdC".$i];
					
				$part6=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t6(id,form_id,sl_no,name,designation) VALUES ('','$form_id','$i','$valb','$valc')");
			}
		}
		if($input_size6!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t7 where form_id='$form_id'");
			for($i=1;$i<$input_size6;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["teB".$i];
				$valc=$_POST["teC".$i];
						
				$part7=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t7(id,form_id,sl_no,name,designation) VALUES ('','$form_id','$i','$valb','$valc')");
			}
		}			
		if($input_size7!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t8 where form_id='$form_id'");
			for($i=1;$i<$input_size7;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["tfB".$i];
				$valc=$_POST["tfC".$i];
				//$vald=$_POST["tfD".$i];			
				$part8=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t8(id,form_id,sl_no,name,designation) VALUES ('','$form_id','$i','$valb','$valc')");
			}
		}			
		if($input_size8!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t9 where form_id='$form_id'");
			for($i=1;$i<$input_size8;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["tgB".$i];
				$valc=$_POST["tgC".$i];
				//$vald=$_POST["tgD".$i];			
				$part9=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t9(id,form_id,sl_no,name,designation) VALUES ('','$form_id','$i','$valb','$valc')");
			}
		}			
		if($input_size9!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t10 where form_id='$form_id'");
			for($i=1;$i<$input_size9;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["thB".$i];
				$valc=$_POST["thC".$i];
				//$vald=$_POST["thD".$i];			
				$part10=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t10(id,form_id,sl_no,name,designation) VALUES ('','$form_id','$i','$valb','$valc')");
			}
		}			
		if($input_size10!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t11 where form_id='$form_id'");
			for($i=1;$i<$input_size10;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["taaB".$i];
				$valc=$_POST["taaC".$i];
				//$vald=$_POST["taaD".$i];			
				$part11=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t11(id,form_id,sl_no,name,designation) VALUES ('','$form_id','$i','$valb','$valc')");
			}
		}			
		if($input_size11!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t12 where form_id='$form_id'");
			for($i=1;$i<$input_size11;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["tabB".$i];
				$valc=$_POST["tabC".$i];
				//$vald=$_POST["tabD".$i];			
				$part12=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t12(id,form_id,sl_no,name,designation) VALUES ('','$form_id','$i','$valb','$valc')");
			}
		}
		if($input_size12!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t13 where form_id='$form_id'");
			for($i=1;$i<$input_size12;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["tkB".$i];
				$valc=$_POST["tkC".$i];
				//$vald=$_POST["tabD".$i];			
				$part13=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t13(id,form_id,sl_no,name,operation) VALUES ('','$form_id','$i','$valb','$valc')");
			}
		}	
		if($input_size13!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t14 where form_id='$form_id'");
			for($i=1;$i<$input_size13;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["tlB".$i];
				$valc=$_POST["tlC".$i];
				//$vald=$_POST["tabD".$i];			
				$part14=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t14(id,form_id,sl_no,name,equipment) VALUES ('','$form_id','$i','$valb','$valc')");
			}
		}	
		if($input_size14!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t15 where form_id='$form_id'");
			for($i=1;$i<$input_size14;$i++){
					
				$valb=$_POST["tmB".$i];
				$valc=$_POST["tmC".$i];
						
				$part15=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t15(id,form_id,sl_no,name,equipment) VALUES ('','$form_id','$i','$valb','$valc')");
			}
		}	
		if($input_size15!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t16 where form_id='$form_id'");
			for($i=1;$i<$input_size15;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["tnB".$i];
				$valc=$_POST["tnC".$i];
				//$vald=$_POST["tabD".$i];			
				$part16=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t16(id,form_id,sl_no,name,equipment) VALUES ('','$form_id','$i','$valb','$valc')");
			}
		}	
		if($input_size16!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t17 where form_id='$form_id'");
			for($i=1;$i<$input_size16;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["toB".$i];
				$valc=$_POST["toC".$i];
						
				$part17=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t17(id,form_id,sl_no,name,equipment) VALUES ('','$form_id','$i','$valb','$valc')");
			}
		}	
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";						
	}else{
		   echo "<script>
		   alert('Invalid Entry');
		   window.location.href = '".$table_name.".php';
		</script>";
	}
}

if(isset($_POST["save7"])){
	$h_name=clean($_POST["h_name"]);$h_location=clean($_POST["h_location"]);$is_gov_private=clean($_POST["is_gov_private"]);$is_teaching_non=clean($_POST["is_teaching_non"]);$is_road=clean($_POST["is_road"]);$is_rail=clean($_POST["is_rail"]);$is_air=clean($_POST["is_air"]); $is_blood=clean($_POST["is_blood"]); $is_dialysis=clean($_POST["is_dialysis"]);$bed_strength=clean($_POST["bed_strength"]); $discipline=clean($_POST["discipline"]); $annual_budget=clean($_POST["annual_budget"]);$patient_year=clean($_POST["patient_year"]);$sur_bed=clean($_POST["sur_bed"]);$sur_operation=clean($_POST["sur_operation"]);$sur_organ=clean($_POST["sur_organ"]);$med_bed=clean($_POST["med_bed"]);$med_operation=clean($_POST["med_operation"]);$med_organ=clean($_POST["med_organ"]);$med_potential=clean($_POST["med_potential"]);$anaes_theatre=clean($_POST["anaes_theatre"]);$anaes_emergancy=clean($_POST["anaes_emergancy"]);$anaes_transplant=clean($_POST["anaes_transplant"]);$facility_present=clean($_POST["facility_present"]);$facility_not_present=clean($_POST["facility_not_present"]);$icu_bed=clean($_POST["icu_bed"]);$icu_equip=clean($_POST["icu_equip"]);$nurses=clean($_POST["nurses"]);$technicians=clean($_POST["technicians"]);$data=clean($_POST["data"]);$lab_investigation=clean($_POST["lab_investigation"]);$image_investigation=clean($_POST["image_investigation"]);$haematology_investigation=clean($_POST["haematology_investigation"]);
	$is_nephrologist=clean($_POST["is_nephrologist"]);$is_neurologist=clean($_POST["is_neurologist"]);
	$is_neuro_surgeon=clean($_POST["is_neuro_surgeon"]);$is_urologist=clean($_POST["is_urologist"]);
	$is_surgeon=clean($_POST["is_surgeon"]);
	$is_paediatrician=clean($_POST["is_paediatrician"]);$is_physiotherapist=clean($_POST["is_physiotherapist"]);$is_social=clean($_POST["is_social"]);$is_immunologists=clean($_POST["is_immunologists"]);
	$is_respiratory=clean($_POST["is_respiratory"]);$is_others=clean($_POST["is_others"]);$is_cardiologist=clean($_POST["is_cardiologist"]);
	
	$input_size=clean($_POST["hiddenval"]);$input_size1=clean($_POST["hiddenval2"]);
	$input_size2=clean($_POST["hiddenval3"]);$input_size3=clean($_POST["hiddenval4"]);$input_size4=clean($_POST["hiddenval5"]);$input_size5=clean($_POST["hiddenval6"]);$input_size6=clean($_POST["hiddenval7"]);$input_size7=clean($_POST["hiddenval8"]);$input_size8=clean($_POST["hiddenval9"]);$input_size9=clean($_POST["hiddenval10"]);
	$input_size10=clean($_POST["hiddenval11"]);$input_size11=clean($_POST["hiddenval12"]);$input_size12=clean($_POST["hiddenval13"]);$input_size13=clean($_POST["hiddenval14"]);$input_size14=clean($_POST["hiddenval15"]);$input_size15=clean($_POST["hiddenval16"]);$input_size16=clean($_POST["hiddenval17"]);
		
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		$savequery=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,h_name,h_location,is_gov_private,is_teaching_non,is_road,is_rail,is_air,bed_strength,discipline,annual_budget,patient_year,sur_bed,sur_operation,sur_organ,med_bed,med_operation,med_organ,med_potential,anaes_theatre,anaes_emergancy,anaes_transplant,facility_present,facility_not_present,icu_bed,nurses,technicians,icu_equip,data,lab_investigation,image_investigation,haematology_investigation,is_blood,is_dialysis,is_nephrologist,is_neurologist,is_neuro_surgeon,is_urologist,is_surgeon,is_paediatrician,is_physiotherapist,is_social,is_immunologists,is_cardiologist,is_respiratory,is_others) values ('$swr_id','$today','$h_name','$h_location','$is_gov_private','$is_teaching_non','$is_road','$is_rail','$is_air','$bed_strength','$discipline','$annual_budget','$patient_year','$sur_bed','$sur_operation','$sur_organ','$med_bed','$med_operation','$med_organ','$med_potential','$anaes_theatre','$anaes_emergancy','$anaes_transplant','$facility_present','$facility_not_present','$icu_bed','$nurses','$technicians','$icu_equip','$data','$lab_investigation','$image_investigation','$haematology_investigation','$is_blood','$is_dialysis','$is_nephrologist','$is_neurologist','$is_neuro_surgeon','$is_urologist','$is_surgeon','$is_paediatrician','$is_physiotherapist','$is_social','$is_immunologists','$is_cardiologist','$is_respiratory','$is_others')");
		$form_id=$savequery;
	}else{	
		$form_id=$sql->fetch_object()->form_id;
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET sub_date='$today',h_name='$h_name', h_location='$h_location', is_gov_private='$is_gov_private', is_teaching_non='$is_teaching_non', is_road='$is_road', is_rail='$is_rail', is_air='$is_air', bed_strength='$bed_strength',discipline='$discipline', annual_budget='$annual_budget',patient_year='$patient_year',sur_bed='$sur_bed',sur_operation='$sur_operation',sur_organ='$sur_organ',  med_bed='$med_bed',med_operation='$med_operation',med_organ='$med_organ',med_potential='$med_potential',anaes_theatre='$anaes_theatre',anaes_emergancy='$anaes_emergancy',anaes_transplant='$anaes_transplant',facility_present='$facility_present',facility_not_present='$facility_not_present',icu_bed='$icu_bed',nurses='$nurses',technicians='$technicians',icu_equip='$icu_equip',data='$data',lab_investigation='$lab_investigation',image_investigation='$image_investigation',haematology_investigation='$haematology_investigation',is_blood='$is_blood',is_dialysis='$is_dialysis',is_nephrologist='$is_nephrologist',is_neurologist='$is_neurologist',is_neuro_surgeon='$is_neuro_surgeon',is_urologist='$is_urologist',is_surgeon='$is_surgeon',is_paediatrician='$is_paediatrician',is_physiotherapist='$is_physiotherapist',is_immunologists='$is_immunologists',is_social='$is_social',is_cardiologist='$is_cardiologist',is_respiratory='$is_respiratory',is_others='$is_others' WHERE form_id='$form_id'");
	}
	
	if($savequery){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		if($input_size!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
							
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,sl_no,name,designation) VALUES ('','$form_id','$i','$valb','$valc')");
			}
		}
		if($input_size1!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size1;$i++){
						
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
							
				$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(id,form_id,sl_no,name,designation) VALUES ('','$form_id','$i','$valb','$valc')");
			}
		}		
		if($input_size2!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t3 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["taB".$i];
				$valc=$_POST["taC".$i];
					
				$part3=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t3(id,form_id,sl_no,name,designation) VALUES ('','$form_id','$i','$valb','$valc')");
			}
		}		
		if($input_size3!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t4 where form_id='$form_id'");
			for($i=1;$i<$input_size3;$i++){
					
				$valb=$_POST["tbB".$i];
				$valc=$_POST["tbC".$i];
							
				$part4=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t4(id,form_id,sl_no,name,designation) VALUES ('','$form_id','$i','$valb','$valc')");
			}
		}		
		if($input_size4!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t5 where form_id='$form_id'");
			for($i=1;$i<$input_size4;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["txxB".$i];
				$valc=$_POST["txxC".$i];
						
				$part5=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t5(id,form_id,sl_no,name,designation) VALUES ('','$form_id','$i','$valb','$valc')");
			}
		}
		if($input_size5!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t6 where form_id='$form_id'");
			for($i=1;$i<$input_size5;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["tdB".$i];
				$valc=$_POST["tdC".$i];
					
				$part6=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t6(id,form_id,sl_no,name,designation) VALUES ('','$form_id','$i','$valb','$valc')");
			}
		}
		if($input_size6!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t7 where form_id='$form_id'");
			for($i=1;$i<$input_size6;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["teB".$i];
				$valc=$_POST["teC".$i];
						
				$part7=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t7(id,form_id,sl_no,name,designation) VALUES ('','$form_id','$i','$valb','$valc')");
			}
		}			
		if($input_size7!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t8 where form_id='$form_id'");
			for($i=1;$i<$input_size7;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["tfB".$i];
				$valc=$_POST["tfC".$i];
				//$vald=$_POST["tfD".$i];			
				$part8=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t8(id,form_id,sl_no,name,designation) VALUES ('','$form_id','$i','$valb','$valc')");
			}
		}			
		if($input_size8!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t9 where form_id='$form_id'");
			for($i=1;$i<$input_size8;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["tgB".$i];
				$valc=$_POST["tgC".$i];
				//$vald=$_POST["tgD".$i];			
				$part9=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t9(id,form_id,sl_no,name,designation) VALUES ('','$form_id','$i','$valb','$valc')");
			}
		}			
		if($input_size9!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t10 where form_id='$form_id'");
			for($i=1;$i<$input_size9;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["thB".$i];
				$valc=$_POST["thC".$i];
				//$vald=$_POST["thD".$i];			
				$part10=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t10(id,form_id,sl_no,name,designation) VALUES ('','$form_id','$i','$valb','$valc')");
			}
		}			
		if($input_size10!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t11 where form_id='$form_id'");
			for($i=1;$i<$input_size10;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["taaB".$i];
				$valc=$_POST["taaC".$i];
				//$vald=$_POST["taaD".$i];			
				$part11=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t11(id,form_id,sl_no,name,designation) VALUES ('','$form_id','$i','$valb','$valc')");
			}
		}			
		if($input_size11!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t12 where form_id='$form_id'");
			for($i=1;$i<$input_size11;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["tabB".$i];
				$valc=$_POST["tabC".$i];
				//$vald=$_POST["tabD".$i];			
				$part12=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t12(id,form_id,sl_no,name,designation) VALUES ('','$form_id','$i','$valb','$valc')");
			}
		}
		if($input_size12!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t13 where form_id='$form_id'");
			for($i=1;$i<$input_size12;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["tkB".$i];
				$valc=$_POST["tkC".$i];
				//$vald=$_POST["tabD".$i];			
				$part13=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t13(id,form_id,sl_no,name,operation) VALUES ('','$form_id','$i','$valb','$valc')");
			}
		}	
		if($input_size13!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t14 where form_id='$form_id'");
			for($i=1;$i<$input_size13;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["tlB".$i];
				$valc=$_POST["tlC".$i];
				//$vald=$_POST["tabD".$i];			
				$part14=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t14(id,form_id,sl_no,name,equipment) VALUES ('','$form_id','$i','$valb','$valc')");
			}
		}	
		if($input_size14!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t15 where form_id='$form_id'");
			for($i=1;$i<$input_size14;$i++){
					
				$valb=$_POST["tmB".$i];
				$valc=$_POST["tmC".$i];
						
				$part15=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t15(id,form_id,sl_no,name,equipment) VALUES ('','$form_id','$i','$valb','$valc')");
			}
		}	
		if($input_size15!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t16 where form_id='$form_id'");
			for($i=1;$i<$input_size15;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["tnB".$i];
				$valc=$_POST["tnC".$i];
				//$vald=$_POST["tabD".$i];			
				$part16=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t16(id,form_id,sl_no,name,equipment) VALUES ('','$form_id','$i','$valb','$valc')");
			}
		}	
		if($input_size16!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t17 where form_id='$form_id'");
			for($i=1;$i<$input_size16;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["toB".$i];
				$valc=$_POST["toC".$i];
						
				$part17=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t17(id,form_id,sl_no,name,equipment) VALUES ('','$form_id','$i','$valb','$valc')");
			}
		}	
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";						
	}else{
		   echo "<script>
		   alert('Invalid Entry');
		   window.location.href = '".$table_name.".php';
		</script>";
	}
}
if(isset($_POST["save4a"])){	
	$eye_bnk_name=clean($_POST["eye_bnk_name"]);$eye_bnk_ad=clean($_POST["eye_bnk_ad"]);	
	$is_eye_bnk_gov=clean($_POST["is_eye_bnk_gov"]);$is_teaching=clean($_POST["is_teaching"]);
	$is_eye_bnk_iec=clean($_POST["is_eye_bnk_iec"]);
	$is_availability=clean($_POST["is_availability"]);$is_register_main=clean($_POST["is_register_main"]);$m_no=clean($_POST["m_no"]);$is_transport_facility=clean($_POST["is_transport_facility"]);$is_instrument=clean($_POST["is_instrument"]);$is_preservation=clean($_POST["is_preservation"]);$is_pre_media=clean($_POST["is_pre_media"]);$is_waste_disp=clean($_POST["is_waste_disp"]);$is_power_supply=clean($_POST["is_power_supply"]);$incharge=clean($_POST["incharge"]);$eye_technician=clean($_POST["eye_technician"]);$eye_don_counselors=clean($_POST["eye_don_counselors"]);$task_staff=clean($_POST["task_staff"]);$space_req=clean($_POST["space_req"]);
	
	$input_size1=$_POST["hiddenval"];
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$savequery=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,eye_bnk_name,eye_bnk_ad,is_eye_bnk_gov,is_teaching,is_eye_bnk_iec,is_availability,is_register_main,m_no,is_transport_facility,is_instrument,is_preservation,is_pre_media,is_waste_disp,is_power_supply,incharge,eye_technician,eye_don_counselors,task_staff,space_req) values ('$swr_id','$today','$eye_bnk_name', '$eye_bnk_ad', '$is_eye_bnk_gov','$is_teaching','$is_eye_bnk_iec','$is_availability','$is_register_main','$m_no','$is_transport_facility','$is_instrument','$is_preservation','$is_pre_media','$is_waste_disp','$is_power_supply','$incharge','$eye_technician','$eye_don_counselors','$task_staff','$space_req')");
		$form_id=$savequery;
	}else{
		$form_id=$row["form_id"];	
		$savequery=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', eye_bnk_name='$eye_bnk_name',eye_bnk_ad='$eye_bnk_ad',is_eye_bnk_gov='$is_eye_bnk_gov',is_teaching='$is_teaching', is_eye_bnk_iec='$is_eye_bnk_iec',is_availability='$is_availability', is_register_main='$is_register_main', m_no='$m_no', is_transport_facility='$is_transport_facility', is_instrument='$is_instrument', is_preservation='$is_preservation', is_pre_media='$is_pre_media', is_waste_disp='$is_waste_disp', is_power_supply='$is_power_supply', incharge='$incharge', eye_technician='$eye_technician', eye_don_counselors='$eye_don_counselors', task_staff='$task_staff', space_req='$space_req' where user_id='$swr_id' and form_id='$form_id'");	
	}				
	if($savequery){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		if($input_size1!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size1;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,slno,name,qualification,address) VALUES ('','$form_id','$i','$valb','$valc','$vald')");
			}
		}
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$table_name.".php?tab=2';
		</script>";
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=1';
		</script>";
	}			
}
if(isset($_POST["save4b"])){
	$is_records_main=clean($_POST["is_records_main"]);$is_reg_pledges=clean($_POST["is_reg_pledges"]);$is_comp_fac=clean($_POST["is_comp_fac"]);
	if(!empty($_POST["equip"]))  $equip=json_encode($_POST["equip"]);
	else $equip=NULL;
	if(!empty($_POST["lab_facility"]))	$lab_facility=json_encode($_POST["lab_facility"]);
	else $lab_facility=NULL;
	if(!empty($_POST["reg_renewal"]))	$reg_renewal=json_encode($_POST["reg_renewal"]);
	else $reg_renewal=NULL;
	$name_2=clean($_POST["name_2"]);$eye_ret_add=clean($_POST["eye_ret_add"]);$is_eye_ret_gov=clean($_POST["is_eye_ret_gov"]);$is_eye_ret_teaching=clean($_POST["is_eye_ret_teaching"]);$eye_ret_info=clean($_POST["eye_ret_info"]);$eye_ret_name=clean($_POST["eye_ret_name"]);$rem_incharge=clean($_POST["rem_incharge"]);$rem_technician=clean($_POST["rem_technician"]);$rem_mts=clean($_POST["rem_mts"]);$is_rem_trans=clean($_POST["is_rem_trans"]);
	$input_size2=$_POST["hiddenval2"];
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		$savequery=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,is_records_main,is_reg_pledges,is_comp_fac,equip,lab_facility,reg_renewal,name_2,eye_ret_add,is_eye_ret_gov,is_eye_ret_teaching,eye_ret_info,eye_ret_name,rem_incharge,rem_technician,rem_mts,is_rem_trans) values ('$swr_id','$is_records_main','$is_reg_pledges','$is_comp_fac','$equip','$lab_facility','$reg_renewal','$name_2','$eye_ret_add','$is_eye_ret_gov','$is_eye_ret_teaching','$eye_ret_info','$eye_ret_name','$rem_incharge','$rem_technician','$rem_mts','$is_rem_trans')");
		$form_id=$savequery;
	}else{	
		$form_id=$sql->fetch_object()->form_id;
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET  is_records_main='$is_records_main',is_reg_pledges='$is_reg_pledges',is_comp_fac='$is_comp_fac',equip='$equip', lab_facility='$lab_facility', reg_renewal='$reg_renewal', name_2='$name_2', eye_ret_add='$eye_ret_add', is_eye_ret_gov='$is_eye_ret_gov', is_eye_ret_teaching='$is_eye_ret_teaching', eye_ret_info='$eye_ret_info', eye_ret_name='$eye_ret_name', rem_incharge='$rem_incharge', rem_technician='$rem_technician', rem_mts='$rem_mts', is_rem_trans='$is_rem_trans' WHERE form_id='$form_id'");
	}
	
	if($savequery){
		if($input_size2!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$vald=$_POST["textD".$i];
				$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(id,form_id,slno,name2,qualification2,address2) VALUES ('','$form_id','$i','$valb','$valc','$vald')") or die("error in insertion ".$table_name."_t2".$health->error);
				}
			}
	
		echo "<script>
				alert('Successfully Saved..');
				window.location.href = '".$table_name.".php?tab=3';
			</script>";
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=2';
		</script>";
	}
}

if(isset($_POST["save4c"])){
	$is_amb_col=clean($_POST["is_amb_col"]);$is_instr_set=clean($_POST["is_instr_set"]);$is_spc_bot_pres=clean($_POST["is_spc_bot_pres"]);
	$is_transit=clean($_POST["is_transit"]);$is_prev_med=clean($_POST["is_prev_med"]);$is_waste=clean($_POST["is_waste"]);$tel_number=clean($_POST["tel_number"]);$s_req=clean($_POST["s_req"]);$is_records=clean($_POST["is_records"]);$ster_facility=clean($_POST["ster_facility"]);$ref_temp=clean($_POST["ref_temp"]);$ret_centre=clean($_POST["ret_centre"]);$trans_name=clean($_POST["trans_name"]);$trans_add=clean($_POST["trans_add"]);
	$is_trans_gov=clean($_POST["is_trans_gov"]);$is_trans_teaching=clean($_POST["is_trans_teaching"]);$is_trans_iec=clean($_POST["is_trans_iec"]);$trans_reg_name=clean($_POST["trans_reg_name"]);$per_staff_no=clean($_POST["per_staff_no"]);$temp_staff_no=clean($_POST["temp_staff_no"]);$equip_det=clean($_POST["equip_det"]);
	$is_OT_facilities=clean($_POST["is_OT_facilities"]);$is_safe_sto_facilities=clean($_POST["is_safe_sto_facilities"]);$records_reg=clean($_POST["records_reg"]);$any_info=clean($_POST["any_info"]);
	$input_size3=$_POST["hiddenval3"];
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		$savequery=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,is_amb_col,is_instr_set,is_spc_bot_pres,is_transit,is_prev_med,is_waste,tel_number,s_req,is_records,ster_facility,ref_temp,ret_centre,trans_name,trans_add,is_trans_gov,is_trans_teaching,is_trans_iec,trans_reg_name,per_staff_no,temp_staff_no,equip_det,is_OT_facilities,is_safe_sto_facilities,records_reg,any_info) values ('$swr_id','$today','$is_amb_col','$is_instr_set','$is_spc_bot_pres','$is_transit','$is_prev_med','$is_waste','$tel_number','$s_req','$is_records','$ster_facility','$ref_temp','$ret_centre','$trans_name','$trans_add','$is_trans_gov','$is_trans_teaching','$is_trans_iec','$trans_reg_name','$per_staff_no','$temp_staff_no','$equip_det','$is_OT_facilities','$is_safe_sto_facilities','$records_reg','$any_info')");
		$form_id=$savequery;
	}else{	
		$form_id=$sql->fetch_object()->form_id;
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET sub_date='$today',is_amb_col='$is_amb_col',is_instr_set='$is_instr_set',is_spc_bot_pres='$is_spc_bot_pres', is_transit='$is_transit', is_prev_med='$is_prev_med', is_waste='$is_waste', tel_number='$tel_number',s_req='$s_req', is_records='$is_records', ster_facility='$ster_facility', ref_temp='$ref_temp', ret_centre='$ret_centre', trans_name='$trans_name', trans_add='$trans_add', is_trans_gov='$is_trans_gov', is_trans_teaching='$is_trans_teaching', is_trans_iec='$is_trans_iec', trans_reg_name='$trans_reg_name', per_staff_no='$per_staff_no', temp_staff_no='$temp_staff_no', equip_det='$equip_det', is_OT_facilities='$is_OT_facilities', is_safe_sto_facilities='$is_safe_sto_facilities', records_reg='$records_reg', any_info='$any_info' WHERE form_id='$form_id'");
	}
	
	if($savequery){
		if($input_size3!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t3 where form_id='$form_id'");
			for($i=1;$i<$input_size3;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txB".$i];
				$valc=$_POST["txC".$i];
				
				$part3=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t3(id,form_id,slno,name3,qualification3) VALUES ('','$form_id','$i','$valb','$valc')");
				}
			}
	
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";						
	}else{
		   echo "<script>
		   alert('Invalid Entry');
		   window.location.href = '".$table_name.".php';
		</script>";
	}	
}

if(isset($_POST["save8a"])){	
	$eye_bnk_name=clean($_POST["eye_bnk_name"]);$eye_bnk_ad=clean($_POST["eye_bnk_ad"]);	
	$is_eye_bnk_gov=clean($_POST["is_eye_bnk_gov"]);$is_teaching=clean($_POST["is_teaching"]);
	$is_eye_bnk_iec=clean($_POST["is_eye_bnk_iec"]);
	$is_availability=clean($_POST["is_availability"]);$is_register_main=clean($_POST["is_register_main"]);$m_no=clean($_POST["m_no"]);$is_transport_facility=clean($_POST["is_transport_facility"]);$is_instrument=clean($_POST["is_instrument"]);$is_preservation=clean($_POST["is_preservation"]);$is_pre_media=clean($_POST["is_pre_media"]);$is_waste_disp=clean($_POST["is_waste_disp"]);$is_power_supply=clean($_POST["is_power_supply"]);$incharge=clean($_POST["incharge"]);$eye_technician=clean($_POST["eye_technician"]);$eye_don_counselors=clean($_POST["eye_don_counselors"]);$task_staff=clean($_POST["task_staff"]);$space_req=clean($_POST["space_req"]);
	
	$input_size1=$_POST["hiddenval"];
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$savequery=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,eye_bnk_name,eye_bnk_ad,is_eye_bnk_gov,is_teaching,is_eye_bnk_iec,is_availability,is_register_main,m_no,is_transport_facility,is_instrument,is_preservation,is_pre_media,is_waste_disp,is_power_supply,incharge,eye_technician,eye_don_counselors,task_staff,space_req) values ('$swr_id','$today','$eye_bnk_name', '$eye_bnk_ad', '$is_eye_bnk_gov','$is_teaching','$is_eye_bnk_iec','$is_availability','$is_register_main','$m_no','$is_transport_facility','$is_instrument','$is_preservation','$is_pre_media','$is_waste_disp','$is_power_supply','$incharge','$eye_technician','$eye_don_counselors','$task_staff','$space_req')");
		$form_id=$savequery;
	}else{
		$form_id=$row["form_id"];	
		$savequery=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', eye_bnk_name='$eye_bnk_name',eye_bnk_ad='$eye_bnk_ad',is_eye_bnk_gov='$is_eye_bnk_gov',is_teaching='$is_teaching', is_eye_bnk_iec='$is_eye_bnk_iec',is_availability='$is_availability', is_register_main='$is_register_main', m_no='$m_no', is_transport_facility='$is_transport_facility', is_instrument='$is_instrument', is_preservation='$is_preservation', is_pre_media='$is_pre_media', is_waste_disp='$is_waste_disp', is_power_supply='$is_power_supply', incharge='$incharge', eye_technician='$eye_technician', eye_don_counselors='$eye_don_counselors', task_staff='$task_staff', space_req='$space_req' where user_id='$swr_id' and form_id='$form_id'");	
	}				
	if($savequery){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		if($input_size1!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size1;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,slno,name,qualification,address) VALUES ('','$form_id','$i','$valb','$valc','$vald')");
			}
		}
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$table_name.".php?tab=2';
		</script>";
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=1';
		</script>";
	}			
}
if(isset($_POST["save8b"])){
	$is_records_main=clean($_POST["is_records_main"]);$is_reg_pledges=clean($_POST["is_reg_pledges"]);$is_comp_fac=clean($_POST["is_comp_fac"]);
	if(!empty($_POST["equip"]))  $equip=json_encode($_POST["equip"]);
	else $equip=NULL;
	if(!empty($_POST["lab_facility"]))	$lab_facility=json_encode($_POST["lab_facility"]);
	else $lab_facility=NULL;
	if(!empty($_POST["reg_renewal"]))	$reg_renewal=json_encode($_POST["reg_renewal"]);
	else $reg_renewal=NULL;
	$name_2=clean($_POST["name_2"]);$eye_ret_add=clean($_POST["eye_ret_add"]);$is_eye_ret_gov=clean($_POST["is_eye_ret_gov"]);$is_eye_ret_teaching=clean($_POST["is_eye_ret_teaching"]);$eye_ret_info=clean($_POST["eye_ret_info"]);$eye_ret_name=clean($_POST["eye_ret_name"]);$rem_incharge=clean($_POST["rem_incharge"]);$rem_technician=clean($_POST["rem_technician"]);$rem_mts=clean($_POST["rem_mts"]);$is_rem_trans=clean($_POST["is_rem_trans"]);
	$input_size2=$_POST["hiddenval2"];
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		$savequery=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,is_records_main,is_reg_pledges,is_comp_fac,equip,lab_facility,reg_renewal,name_2,eye_ret_add,is_eye_ret_gov,is_eye_ret_teaching,eye_ret_info,eye_ret_name,rem_incharge,rem_technician,rem_mts,is_rem_trans) values ('$swr_id','$is_records_main','$is_reg_pledges','$is_comp_fac','$equip','$lab_facility','$reg_renewal','$name_2','$eye_ret_add','$is_eye_ret_gov','$is_eye_ret_teaching','$eye_ret_info','$eye_ret_name','$rem_incharge','$rem_technician','$rem_mts','$is_rem_trans')");
		$form_id=$savequery;
	}else{	
		$form_id=$sql->fetch_object()->form_id;
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET  is_records_main='$is_records_main',is_reg_pledges='$is_reg_pledges',is_comp_fac='$is_comp_fac',equip='$equip', lab_facility='$lab_facility', reg_renewal='$reg_renewal', name_2='$name_2', eye_ret_add='$eye_ret_add', is_eye_ret_gov='$is_eye_ret_gov', is_eye_ret_teaching='$is_eye_ret_teaching', eye_ret_info='$eye_ret_info', eye_ret_name='$eye_ret_name', rem_incharge='$rem_incharge', rem_technician='$rem_technician', rem_mts='$rem_mts', is_rem_trans='$is_rem_trans' WHERE form_id='$form_id'");
	}
	
	if($savequery){
		if($input_size2!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$vald=$_POST["textD".$i];
				$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(id,form_id,slno,name2,qualification2,address2) VALUES ('','$form_id','$i','$valb','$valc','$vald')") or die("error in insertion ".$table_name."_t2".$health->error);
				}
			}
	
		echo "<script>
				alert('Successfully Saved..');
				window.location.href = '".$table_name.".php?tab=3';
			</script>";
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=2';
		</script>";
	}
}

if(isset($_POST["save8c"])){
	$is_amb_col=clean($_POST["is_amb_col"]);$is_instr_set=clean($_POST["is_instr_set"]);$is_spc_bot_pres=clean($_POST["is_spc_bot_pres"]);
	$is_transit=clean($_POST["is_transit"]);$is_prev_med=clean($_POST["is_prev_med"]);$is_waste=clean($_POST["is_waste"]);$tel_number=clean($_POST["tel_number"]);$s_req=clean($_POST["s_req"]);$is_records=clean($_POST["is_records"]);$ster_facility=clean($_POST["ster_facility"]);$ref_temp=clean($_POST["ref_temp"]);$ret_centre=clean($_POST["ret_centre"]);$trans_name=clean($_POST["trans_name"]);$trans_add=clean($_POST["trans_add"]);
	$is_trans_gov=clean($_POST["is_trans_gov"]);$is_trans_teaching=clean($_POST["is_trans_teaching"]);$is_trans_iec=clean($_POST["is_trans_iec"]);$trans_reg_name=clean($_POST["trans_reg_name"]);$per_staff_no=clean($_POST["per_staff_no"]);$temp_staff_no=clean($_POST["temp_staff_no"]);$equip_det=clean($_POST["equip_det"]);
	$is_OT_facilities=clean($_POST["is_OT_facilities"]);$is_safe_sto_facilities=clean($_POST["is_safe_sto_facilities"]);$records_reg=clean($_POST["records_reg"]);$any_info=clean($_POST["any_info"]);
	$input_size3=$_POST["hiddenval3"];
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		$savequery=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,is_amb_col,is_instr_set,is_spc_bot_pres,is_transit,is_prev_med,is_waste,tel_number,s_req,is_records,ster_facility,ref_temp,ret_centre,trans_name,trans_add,is_trans_gov,is_trans_teaching,is_trans_iec,trans_reg_name,per_staff_no,temp_staff_no,equip_det,is_OT_facilities,is_safe_sto_facilities,records_reg,any_info) values ('$swr_id','$today','$is_amb_col','$is_instr_set','$is_spc_bot_pres','$is_transit','$is_prev_med','$is_waste','$tel_number','$s_req','$is_records','$ster_facility','$ref_temp','$ret_centre','$trans_name','$trans_add','$is_trans_gov','$is_trans_teaching','$is_trans_iec','$trans_reg_name','$per_staff_no','$temp_staff_no','$equip_det','$is_OT_facilities','$is_safe_sto_facilities','$records_reg','$any_info')");
		$form_id=$savequery;
	}else{	
		$form_id=$sql->fetch_object()->form_id;
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET sub_date='$today',is_amb_col='$is_amb_col',is_instr_set='$is_instr_set',is_spc_bot_pres='$is_spc_bot_pres', is_transit='$is_transit', is_prev_med='$is_prev_med', is_waste='$is_waste', tel_number='$tel_number',s_req='$s_req', is_records='$is_records', ster_facility='$ster_facility', ref_temp='$ref_temp', ret_centre='$ret_centre', trans_name='$trans_name', trans_add='$trans_add', is_trans_gov='$is_trans_gov', is_trans_teaching='$is_trans_teaching', is_trans_iec='$is_trans_iec', trans_reg_name='$trans_reg_name', per_staff_no='$per_staff_no', temp_staff_no='$temp_staff_no', equip_det='$equip_det', is_OT_facilities='$is_OT_facilities', is_safe_sto_facilities='$is_safe_sto_facilities', records_reg='$records_reg', any_info='$any_info' WHERE form_id='$form_id'");
	}
	
	if($savequery){
		if($input_size3!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t3 where form_id='$form_id'");
			for($i=1;$i<$input_size3;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txB".$i];
				$valc=$_POST["txC".$i];
				
				$part3=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t3(id,form_id,slno,name3,qualification3) VALUES ('','$form_id','$i','$valb','$valc')");
				}
			}
	
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";						
	}else{
		   echo "<script>
		   alert('Invalid Entry');
		   window.location.href = '".$table_name.".php';
		</script>";
	}	
}

if(isset($_POST["save5a"])){
	$website_name=clean($_POST["website_name"]); $owner_name=clean($_POST["owner_name"]); $o_street_name1=clean($_POST["o_street_name1"]); $o_street_name2=clean($_POST["o_street_name2"]); $o_vill=clean($_POST["o_vill"]); $o_block=clean($_POST["o_block"]); $o_dist=clean($_POST["o_dist"]); $o_pin=clean($_POST["o_pin"]); $o_mobile_no=clean($_POST["o_mobile_no"]); $o_email=clean($_POST["o_email"]);$starting_date=clean($_POST["starting_date"]);$o_landline_no=clean($_POST["o_landline_no"]);$input_size=clean($_POST["hiddenval"]);$location_type=clean($_POST["location_type"]);$fees_description=clean($_POST["fees_description"]);
			
	
	if(!empty($_POST["ownership"]))	$ownership=json_encode($_POST["ownership"]);
	else $ownership=NULL;
	if(!empty($_POST["ownership2"]))	$ownership2=json_encode($_POST["ownership2"]);
	else $ownership2=NULL;
	if(!empty($_POST["systems"]))	$systems=json_encode($_POST["systems"]);
	else $systems=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		$savequery=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,website_name,starting_date,location_type,fees_description,ownership,ownership2,owner_name,o_street_name1,o_street_name2,o_vill,o_block,o_dist,o_landline_no,o_pin,o_mobile_no,o_email,systems) values ('$swr_id','$today','$website_name','$starting_date','$location_type','$fees_description','$ownership','$ownership2','$owner_name','$o_street_name1','$o_street_name2','$o_vill','$o_block','$o_dist','$o_landline_no','$o_pin','$o_mobile_no','$o_email','$systems')");
		$form_id=$savequery;
	}else{	
		$form_id=$sql->fetch_object()->form_id;
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET sub_date='$today',website_name='$website_name',starting_date='$starting_date',location_type='$location_type',fees_description='$fees_description', ownership='$ownership',ownership2='$ownership2',owner_name='$owner_name',o_street_name1='$o_street_name1',o_street_name2='$o_street_name2',o_vill='$o_vill',o_block='$o_block',o_dist='$o_dist',o_landline_no='$o_landline_no',o_pin='$o_pin',o_mobile_no='$o_mobile_no',o_email='$o_email',systems='$systems' WHERE form_id='$form_id'");
	}
	
	if($savequery){
		$formFunctions->insert_incomplete_forms($dept,$form);
		if($input_size!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$valf=$_POST["txtF".$i];
				$valg=$_POST["txtG".$i];
				$valh=$_POST["txtH".$i];				
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,sl_no,name,designation,qualification,reg_no,name_of_central,mobile,email) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg','$valh')");
			}
		}	
		echo "<script>
				alert('Successfully Saved..');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=1';
		</script>";
	}	
}
if(isset($_POST["save5b"])){
	if(!empty($_POST["clinic"]))	$clinic=json_encode($_POST["clinic"]);
	else $clinic=NULL;
	if(!empty($_POST["facility"]))	$facility=json_encode($_POST["facility"]);
	else $facility=NULL;
	if(!empty($_POST["hospital"]))	$hospital=json_encode($_POST["hospital"]);
	else $hospital=NULL;
	if(!empty($_POST["dental"]))	$dental=json_encode($_POST["dental"]);
	else $dental=NULL;
	if(!empty($_POST["dentalcl"]))	$dentalcl=json_encode($_POST["dentalcl"]);
	else $dentalcl=NULL;
	if(!empty($_POST["medical"]))	$medical=json_encode($_POST["medical"]);
	else $medical=NULL;
	if(!empty($_POST["imaging"]))	$imaging=json_encode($_POST["imaging"]);
	else $imaging=NULL;
	if(!empty($_POST["imagingel"]))	$imagingel=json_encode($_POST["imagingel"]);
	else $imagingel=NULL;
	if(!empty($_POST["imagingul"]))	$imagingul=json_encode($_POST["imagingul"]);
	else $imagingul=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		$savequery=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,clinic,facility,hospital,dentalcl,dental,medical,imaging,imagingel,imagingul) values ('$swr_id','$clinic','$o_street_name1','$facility','$hospital','$dentalcl','$dental','$medical','$imaging','$imagingel','$imagingul')");
		$form_id=$savequery;
	}else{	
		$form_id=$sql->fetch_object()->form_id;
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET clinic='$clinic', facility='$facility', hospital='$hospital', dentalcl='$dentalcl',dental='$dental',medical='$medical',imaging='$imaging',imagingel='$imagingel',imagingul='$imagingul' WHERE form_id='$form_id'");
	}
	if($savequery){
		echo "<script>
				alert('Successfully Saved..');
				window.location.href = '".$table_name.".php?tab=3';
			</script>";
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=2';
		</script>";
	}	
}
if(isset($_POST["save5c"])){
	if(!empty($_POST["miscellaneous"]))	$miscellaneous=json_encode($_POST["miscellaneous"]);
	else $miscellaneous=NULL;
	 $is_clinical=clean($_POST["is_clinical"]);
	if(!empty($_POST["alliedh"]))	$alliedh=json_encode($_POST["alliedh"]);
	else $alliedh=NULL;
	if(!empty($_POST["ayush"]))	$ayush=json_encode($_POST["ayush"]);
	else $ayush=NULL;
	if(!empty($_POST["ayushyo"]))	$ayushyo=json_encode($_POST["ayushyo"]);
	else $ayushyo=NULL;
	if(!empty($_POST["ayushun"]))	$ayushun=json_encode($_POST["ayushun"]);
	else $ayushun=NULL;
	if(!empty($_POST["ayushsi"]))	$ayushsi=json_encode($_POST["ayushsi"]);
	else $ayushsi=NULL;
	if(!empty($_POST["ayushho"]))	$ayushho=json_encode($_POST["ayushho"]);
	else $ayushho=NULL;
	if(!empty($_POST["ayushna"]))	$ayushna=json_encode($_POST["ayushna"]);
	else $ayushna=NULL;
	if(!empty($_POST["collction_center"]) && $_POST["is_clinical"]=='Y')	$collction_center=$_POST["collction_center"];
	else	$collction_center=NULL;	
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		$savequery=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,miscellaneous,is_clinical,collction_center,alliedh,ayush,ayushyo,ayushun,ayushsi,ayushho,ayushna) values ('$swr_id','$miscellaneous','$is_clinical','$collction_center','$alliedh','$ayush','$ayushyo','$ayushun','$ayushsi','$ayushho','$ayushna')");
		$form_id=$savequery;
	}else{	
		$form_id=$sql->fetch_object()->form_id;
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET miscellaneous='$miscellaneous',is_clinical='$is_clinical',collction_center='$collction_center', alliedh='$alliedh',ayush='$ayush',ayushyo='$ayushyo',ayushun='$ayushun',ayushsi='$ayushsi',ayushho='$ayushho',ayushna='$ayushna' WHERE form_id='$form_id'");
	}
	if($savequery){
		echo "<script>
				alert('Successfully Saved..');
				window.location.href = '".$table_name.".php?tab=4';
			</script>";
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=3';
		</script>";
	}	
}
if(isset($_POST["save5d"])){
	if(!empty($_POST["service"]))	$service=json_encode($_POST["service"]);
	else $service=NULL;
	if(!empty($_POST["degree"]))	$degree=json_encode($_POST["degree"]);
	else $degree=NULL;
	if(!empty($_POST["surgical_special"]))	$surgical_special=json_encode($_POST["surgical_special"]);
	else $surgical_special=NULL;
	if(!empty($_POST["specialties"]))	$specialties=json_encode($_POST["specialties"]);
	else $specialties=NULL;
	if(!empty($_POST["surgical"]))	$surgical=json_encode($_POST["surgical"]);
	else $surgical=NULL;

	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		$savequery=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,service,degree,surgical_special,specialties,surgical) values ('$swr_id','$service','$degree','$surgical_special','$specialties','$surgical')");
		$form_id=$savequery;
	}else{	
		$form_id=$sql->fetch_object()->form_id;
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET service='$service',degree='$degree',surgical_special='$surgical_special',specialties='$specialties',surgical='$surgical' WHERE form_id='$form_id'") OR die("Error bhanita: ".$health->error);
	}
	if($savequery){
		echo "<script>
				alert('Successfully Saved..');
				window.location.href = '".$table_name.".php?tab=5';
			</script>";
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=4';
		</script>";
	}	
}
if(isset($_POST["save5e"])){
	$estarea=clean($_POST["estarea"]); $cnstarea=clean($_POST["cnstarea"]); $total_no=clean($_POST["total_no"]); 
	$input_size1=clean($_POST["hiddenval2"]); $input_size2=clean($_POST["hiddenval3"]); $total_no_bed=clean($_POST["total_no_bed"]); 
	if(!empty($_POST["biomedical"]))	$biomedical=json_encode($_POST["biomedical"]);
	else $biomedical=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		$savequery=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,estarea,cnstarea,total_no,total_no_bed,biomedical) values ('$swr_id',,'$estarea','$cnstarea','$total_no','$total_no_bed','$biomedical')");
		$form_id=$savequery;
	}else{	
		$form_id=$sql->fetch_object()->form_id;
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET estarea='$estarea',cnstarea='$cnstarea',total_no='$total_no',total_no_bed='$total_no_bed',biomedical='$biomedical' WHERE form_id='$form_id'");
	}
	
	if($savequery){
		if($input_size1!=0){					
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size1;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["textB".$i];
				$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(id,form_id,slno,special) VALUES ('','$form_id','$i','$valb')");
			}
		}
		if($input_size2!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t3 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["taB".$i];
				$valc=$_POST["taC".$i];
						
				$part3=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t3(id,form_id,slno,specialty,bed) VALUES ('','$form_id','$i','$valb','$valc')");
			}
		}
		echo "<script>
				alert('Successfully Saved..');
				window.location.href = '".$table_name.".php?tab=6';
			</script>";
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=5';
		</script>";
	}	
}
if(isset($_POST["save5f"])){
	$permanent_no=clean($_POST["permanent_no"]);$temporary_no=clean($_POST["temporary_no"]);
	$input_size3=clean($_POST["hiddenval4"]);$input_size4=clean($_POST["hiddenval5"]);
	$is_authorization=clean($_POST["is_authorization"]);
	$is_pollution=clean($_POST["is_pollution"]);
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		$savequery=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,is_authorization,is_pollution,permanent_no,temporary_no,sub_date) values ('$swr_id',,'$today','$pollution','$permanent_no','$temporary_no')");
		$form_id=$savequery;
	}else{	
		$form_id=$sql->fetch_object()->form_id;
		$savequery=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET sub_date='$today',is_authorization='$is_authorization',is_pollution='$is_pollution',permanent_no='$permanent_no',temporary_no='$temporary_no' WHERE form_id='$form_id'");
	}
	if($savequery){
		if($input_size3!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t4 where form_id='$form_id'");
			for($i=1;$i<$input_size3;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["tbB".$i];
				$valc=$_POST["tbC".$i];
				$vald=$_POST["tbD".$i];
				$vale=$_POST["tbE".$i];
				$valf=$_POST["tbF".$i];
						
				$part4=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t4(id,form_id,slno,name,select_category,qualification,registration,nature) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale','$valf')");
			}
		}	
	   if($input_size4!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t5 where form_id='$form_id'");
			for($i=1;$i<$input_size4;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["tfB".$i];
				$valc=$_POST["tfC".$i];
				$vald=$_POST["tfD".$i];
				$part5=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t5(id,form_id,slno,cate_gory,total_no,remark) VALUES ('','$form_id','$i','$valb','$valc','$vald')");
			}
		}	
	echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";						
	}else{
		   echo "<script>
		   alert('Invalid Entry');
		   window.location.href = '".$table_name.".php';
		</script>";
	}		
}
?>