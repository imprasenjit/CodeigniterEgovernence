<?php
if(isset($_POST["save1a"])){
	/* For disabled checkbox selection */
	if(isset($_POST["others_specify"])) $others_specify=clean($_POST["others_specify"]); 
	else $others_specify=""; 
			
	if(!empty($_POST["business"]))	 $business=json_encode($_POST["business"]);
	else	$business=NULL;
	if(!empty($_POST["premise_add"]))	 $premise_add=json_encode($_POST["premise_add"]);
	else	$premise_add=NULL;
	if(!empty($_POST["in_charge"]))	 $in_charge=json_encode($_POST["in_charge"]);
	else	$in_charge=NULL;
	if(!empty($_POST["comply"]))	$comply=json_encode($_POST["comply"]);
	else	$comply=NULL;	
	if(!empty($_POST["corr_add"]))	$corr_add=json_encode($_POST["corr_add"]);
	else	$corr_add=NULL;	
	
	$query=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$query->fetch_array();
	if($query->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,others_specify,business,premise_add,in_charge,comply,corr_add) values ('$swr_id','$today','$others_specify','$business','$premise_add','$in_charge','$comply','$corr_add')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',others_specify='$others_specify',business='$business',premise_add='$premise_add',in_charge='$in_charge',comply='$comply',corr_add='$corr_add' where form_id=$form_id");		
	}		
	if($query){
		echo "<script>
			alert('Successfully Saved.');
		    window.location.href = '".$table_name.".php?tab=2';
		</script>";
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php';
		</script>";
	}
}
if(isset($_POST["save1b"])){
	$input_size=clean($_POST["hiddenval"]);$input_size2=clean($_POST["hiddenval2"]);$input_size3=clean($_POST["hiddenval3"]);$input_size4=clean($_POST["hiddenval4"]);
	//$is_license=clean($_POST["is_license"]);
    $capacity=clean($_POST["capacity"]);	
	if(!empty($_POST["dairy"]))	 $dairy=json_encode($_POST["dairy"]);
	else	$dairy=NULL;
	
	$query=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$query->fetch_array();			
	if($query->num_rows<1){   ////////////table is empty////////////// 				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,capacity,dairy)values('$swr_id','$capacity','$dairy')");
		$form_id=$query;	
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set capacity='$capacity',dairy='$dairy' where form_id=$form_id");		
	}				
	if($query){		
		if($input_size!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["textA".$i];	
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,sl_no,name,qty) VALUES ('','$form_id','$i','$valb','$valc')");
			}
		}
		if($input_size2!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				//$vala=$_POST["text1A".$i];	
				$valb=$_POST["text1B".$i];
				$valc=$_POST["text1C".$i];
				$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(id,form_id,sl_no,name,qty) VALUES ('','$form_id','$i','$valb','$valc')");
			}
		}
		if($input_size3!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t3 where form_id='$form_id'");
			for($i=1;$i<$input_size3;$i++){
				//$vala=$_POST["text2A".$i];	
				$valb=$_POST["text2B".$i];
				$valc=$_POST["text2C".$i];
				$part3=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t3(id,form_id,sl_no,name,capacity) VALUES ('','$form_id','$i','$valb','$valc')");
			}
		}
		if($input_size4!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t4 where form_id='$form_id'");
			for($i=1;$i<$input_size4;$i++){
				//$vala=$_POST["text3A".$i];	
				$valb=$_POST["text3B".$i];
				$valc=$_POST["text3C".$i];
				$part4=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t4(id,form_id,sl_no,products,capacity) VALUES ('','$form_id','$i','$valb','$valc')");
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
if(isset($_POST["save1c"])){
	$input_size5=clean($_POST["hiddenval5"]);$input_size6=clean($_POST["hiddenval6"]);
	$electricity=clean($_POST["electricity"]);$is_unit=clean($_POST["is_unit"]);$is_unit_details=clean($_POST["is_unit_details"]);$rupees=clean($_POST["rupees"]);$draft=clean($_POST["draft"]);
	
	if(!empty($_POST["factory"]))	 $factory=json_encode($_POST["factory"]);
	else	$factory=NULL;
	
	$query=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$query->fetch_array();			
	if($query->num_rows<1){   ////////////table is empty////////////// 				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,electricity,is_unit,is_unit_details,factory,rupees,draft)values('$swr_id','$electricity','$is_unit','$is_unit_details','$factory','$rupees','$draft')");
		$form_id=$query;		
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set electricity='$electricity',is_unit='$is_unit',is_unit_details='$is_unit_details',factory='$factory',rupees='$rupees',draft='$draft' where form_id=$form_id");		
	}				
	if($query){		
		if($input_size5!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t5 where form_id='$form_id'");
			for($i=1;$i<$input_size5;$i++){
				//$vala=$_POST["text4A".$i];	
				$valb=$_POST["text4B".$i];
				$valc=$_POST["text4C".$i];
				$vald=$_POST["text4D".$i];
				$vale=$_POST["text4E".$i];
				$valf=$_POST["text4F".$i];
				$valg=$_POST["text4G".$i];
				$valh=$_POST["text4H".$i];
				$vali=$_POST["text4I".$i];
				$valj=$_POST["text4J".$i];
				$part5=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t5(id,form_id,sl_no,name,seed,crude,neutralized,bleached,refined,meat,flour,vegetable) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg','$valh','$vali','$valj')");
			}
		}
		if($input_size6!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t6 where form_id='$form_id'");
			for($i=1;$i<$input_size6;$i++){
				//$vala=$_POST["text5A".$i];	
				$valb=$_POST["text5B".$i];
				$valc=$_POST["text5C".$i];
				$part6=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t6(id,form_id,sl_no,name,qty) VALUES ('','$form_id','$i','$valb','$valc')");
			}
		}
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=2';
		</script>";
	}	
}

if(isset($_POST["save2"])){
	$input_size=clean($_POST["hiddenval"]);
	$applicant_name=clean($_POST["applicant_name"]);$identity_proof=clean($_POST["identity_proof"]);
	$area=clean($_POST["area"]);$start_date=clean($_POST["start_date"]);$opening=clean($_POST["opening"]);$closing=clean($_POST["closing"]);$is_power=clean($_POST["is_power"]);$is_power_details=clean($_POST["is_power_details"]);$rupees=clean($_POST["rupees"]);$draft=clean($_POST["draft"]);$supply=clean($_POST["supply"]);$fees=clean($_POST["fees"]);
	
	/* For disabled checkbox selection */
	if(isset($_POST["others_business"])) $others_business=clean($_POST["others_business"]); 
	else $others_business=""; 
	if(isset($_POST["others_desgn"])) $others_desgn=clean($_POST["others_desgn"]); 
	else $others_desgn=""; 
			
	if(!empty($_POST["business"]))	 $business=json_encode($_POST["business"]);
	else	$business=NULL;
	if(!empty($_POST["designation"]))	 $designation=json_encode($_POST["designation"]);
	else	$designation=NULL;
	if(!empty($_POST["corr_add"]))	$corr_add=json_encode($_POST["corr_add"]);
	else	$corr_add=NULL;	

	$query=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$query->fetch_array();
	if($query->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,others_business,others_desgn,applicant_name,identity_proof,area,start_date,opening,closing,is_power,is_power_details,rupees,draft,business,designation,supply,fees,corr_add) values ('$swr_id','$today','$others_business','$others_desgn','$applicant_name','$identity_proof','$area','$start_date','$opening','$closing','$is_power','$is_power_details','$rupees','$draft','$business','$designation','$supply','$fees','$corr_add')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',others_business='$others_business',others_desgn='$others_desgn',applicant_name='$applicant_name',identity_proof='$identity_proof',area='$area',start_date='$start_date',opening='$opening',closing='$closing',is_power='$is_power',is_power_details='$is_power_details',rupees='$rupees',draft='$draft',business='$business',designation='$designation',supply='$supply',fees='$fees',corr_add='$corr_add' where form_id=$form_id");		
	}		
	if($query){
		if($input_size!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["textA".$i];	
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,sl_no,name,qty) VALUES ('','$form_id','$i','$valb','$valc')");
			}
		}
		echo "<script>
			alert('Successfully Saved.');
		    window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php';
		</script>";
	}
}

if(isset($_POST["save3a"])){
	/* For disabled checkbox selection */
	if(isset($_POST["others_specify"])) $others_specify=clean($_POST["others_specify"]); 
	else $others_specify=""; 
			
	if(!empty($_POST["business"]))	 $business=json_encode($_POST["business"]);
	else	$business=NULL;
	if(!empty($_POST["premise_add"]))	 $premise_add=json_encode($_POST["premise_add"]);
	else	$premise_add=NULL;
	if(!empty($_POST["in_charge"]))	 $in_charge=json_encode($_POST["in_charge"]);
	else	$in_charge=NULL;
	if(!empty($_POST["comply"]))	$comply=json_encode($_POST["comply"]);
	else	$comply=NULL;	
	if(!empty($_POST["corr_add"]))	$corr_add=json_encode($_POST["corr_add"]);
	else	$corr_add=NULL;	
	
	$query=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$query->fetch_array();
	if($query->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,others_specify,business,premise_add,in_charge,comply,corr_add) values ('$swr_id','$today','$others_specify','$business','$premise_add','$in_charge','$comply','$corr_add')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',others_specify='$others_specify',business='$business',premise_add='$premise_add',in_charge='$in_charge',comply='$comply',corr_add='$corr_add' where form_id=$form_id");		
	}		
	if($query){
		echo "<script>
			alert('Successfully Saved.');
		    window.location.href = '".$table_name.".php?tab=2';
		</script>";
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php';
		</script>";
	}
}
if(isset($_POST["save3b"])){
	$input_size=clean($_POST["hiddenval"]);$input_size2=clean($_POST["hiddenval2"]);$input_size3=clean($_POST["hiddenval3"]);$input_size4=clean($_POST["hiddenval4"]);
	$capacity=clean($_POST["capacity"]);	
	if(!empty($_POST["dairy"]))	 $dairy=json_encode($_POST["dairy"]);
	else	$dairy=NULL;
	
	$query=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$query->fetch_array();			
	if($query->num_rows<1){   ////////////table is empty////////////// 				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,capacity,dairy)values('$swr_id','$capacity','$dairy')");
		$form_id=$query;		
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set capacity='$capacity',dairy='$dairy' where form_id=$form_id");		
	}				
	if($query){		
		if($input_size!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["textA".$i];	
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,sl_no,name,qty) VALUES ('','$form_id','$i','$valb','$valc')");
			}
		}
		if($input_size2!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				//$vala=$_POST["text1A".$i];	
				$valb=$_POST["text1B".$i];
				$valc=$_POST["text1C".$i];
				$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(id,form_id,sl_no,name,qty) VALUES ('','$form_id','$i','$valb','$valc')");
			}
		}
		if($input_size3!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t3 where form_id='$form_id'");
			for($i=1;$i<$input_size3;$i++){
				//$vala=$_POST["text2A".$i];	
				$valb=$_POST["text2B".$i];
				$valc=$_POST["text2C".$i];
				$part3=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t3(id,form_id,sl_no,name,capacity) VALUES ('','$form_id','$i','$valb','$valc')");
			}
		}
		if($input_size4!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t4 where form_id='$form_id'");
			for($i=1;$i<$input_size4;$i++){
				//$vala=$_POST["text3A".$i];	
				$valb=$_POST["text3B".$i];
				$valc=$_POST["text3C".$i];
				$part4=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t4(id,form_id,sl_no,products,capacity) VALUES ('','$form_id','$i','$valb','$valc')");
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
if(isset($_POST["save3c"])){
	$input_size5=clean($_POST["hiddenval5"]);$input_size6=clean($_POST["hiddenval6"]);
	$electricity=clean($_POST["electricity"]);$is_unit=clean($_POST["is_unit"]);$is_unit_details=clean($_POST["is_unit_details"]);$period=clean($_POST["period"]);$rupees=clean($_POST["rupees"]);$draft=clean($_POST["draft"]);
	
	if(!empty($_POST["factory"]))	 $factory=json_encode($_POST["factory"]);
	else	$factory=NULL;
	
	$query=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$query->fetch_array();			
	if($query->num_rows<1){   ////////////table is empty////////////// 				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,electricity,is_unit,is_unit_details,period,factory,rupees,draft)values('$swr_id','$electricity','$is_unit','$is_unit_details','$period','$factory','$rupees','$draft')");
		$form_id=$query;		
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set electricity='$electricity',is_unit='$is_unit',is_unit_details='$is_unit_details',period='$period',factory='$factory',rupees='$rupees',draft='$draft' where form_id=$form_id");		
	}				
	if($query){		
		if($input_size5!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t5 where form_id='$form_id'");
			for($i=1;$i<$input_size5;$i++){
				//$vala=$_POST["text4A".$i];	
				$valb=$_POST["text4B".$i];
				$valc=$_POST["text4C".$i];
				$vald=$_POST["text4D".$i];
				$vale=$_POST["text4E".$i];
				$valf=$_POST["text4F".$i];
				$valg=$_POST["text4G".$i];
				$valh=$_POST["text4H".$i];
				$vali=$_POST["text4I".$i];
				$valj=$_POST["text4J".$i];
				$part5=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t5(id,form_id,sl_no,name,seed,crude,neutralized,bleached,refined,meat,flour,vegetable) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg','$valh','$vali','$valj')");
			}
		}
		if($input_size6!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t6 where form_id='$form_id'");
			for($i=1;$i<$input_size6;$i++){
				//$vala=$_POST["text5A".$i];	
				$valb=$_POST["text5B".$i];
				$valc=$_POST["text5C".$i];
				$part6=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t6(id,form_id,sl_no,name,qty) VALUES ('','$form_id','$i','$valb','$valc')");
			}
		}
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=2';
		</script>";
	}	
}

if(isset($_POST["save4"])){
	$input_size=clean($_POST["hiddenval"]);
	$applicant_name=clean($_POST["applicant_name"]);$identity_proof=clean($_POST["identity_proof"]);
	$area=clean($_POST["area"]);$start_date=clean($_POST["start_date"]);$opening=clean($_POST["opening"]);$closing=clean($_POST["closing"]);$is_power=clean($_POST["is_power"]);$is_power_details=clean($_POST["is_power_details"]);$rupees=clean($_POST["rupees"]);$draft=clean($_POST["draft"]);$supply=clean($_POST["supply"]);$fees=clean($_POST["fees"]);$turnover=clean($_POST["turnover"]);
	
	/* For disabled checkbox selection */
	if(isset($_POST["others_business"])) $others_business=clean($_POST["others_business"]); 
	else $others_business=""; 
	if(isset($_POST["others_desgn"])) $others_desgn=clean($_POST["others_desgn"]); 
	else $others_desgn=""; 
			
	if(!empty($_POST["business"]))	 $business=json_encode($_POST["business"]);
	else	$business=NULL;
	if(!empty($_POST["designation"]))	 $designation=json_encode($_POST["designation"]);
	else	$designation=NULL;
	if(!empty($_POST["corr_add"]))	$corr_add=json_encode($_POST["corr_add"]);
	else	$corr_add=NULL;	

	$query=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$query->fetch_array();
	if($query->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,others_business,others_desgn,applicant_name,identity_proof,area,start_date,opening,closing,is_power,is_power_details,rupees,draft,business,designation,supply,fees,corr_add,turnover) values ('$swr_id','$today','$others_business','$others_desgn','$applicant_name','$identity_proof','$area','$start_date','$opening','$closing','$is_power','$is_power_details','$rupees','$draft','$business','$designation','$supply','$fees','$corr_add','$turnover')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',others_business='$others_business',others_desgn='$others_desgn',applicant_name='$applicant_name',identity_proof='$identity_proof',area='$area',start_date='$start_date',opening='$opening',closing='$closing',is_power='$is_power',is_power_details='$is_power_details',rupees='$rupees',draft='$draft',business='$business',designation='$designation',supply='$supply',fees='$fees',corr_add='$corr_add',turnover='$turnover' where form_id=$form_id");		
	}		
	if($query){
		if($input_size!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["textA".$i];	
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,sl_no,name,qty) VALUES ('','$form_id','$i','$valb','$valc')");
			}
		}
		echo "<script>
			alert('Successfully Saved.');
		    window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php';
		</script>";
	}
}

?>