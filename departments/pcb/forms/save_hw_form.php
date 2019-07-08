<?php 
if(isset($_POST["save21a"])){		
	$year_of_comm=clean($_POST["year_of_comm"]);
	$input_size1=clean($_POST["hiddenval"]);$input_size2=clean($_POST["hiddenval2"]);
	
	if(!empty($_POST["occupier_add"]))	$occupier_add=json_encode($_POST["occupier_add"]);
	else	$occupier_add=NULL;	
	if(!empty($_POST["auth_req"])) $auth_req=json_encode($_POST["auth_req"]);
	else $auth_req=NULL;	
	if(!empty($_POST["ren_auth"]))	 $ren_auth=json_encode($_POST["ren_auth"]);
	else	$ren_auth=NULL;	
	if(!empty($_POST["ind_work"])) $ind_work=json_encode($_POST["ind_work"]);
	else $ind_work=NULL;			
			
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,occupier_add,auth_req,ren_auth,year_of_comm,ind_work) values ('$swr_id','$today','$occupier_add','$auth_req','$ren_auth','$year_of_comm','$ind_work')");
		$form_id=$query;
	}else{ 
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',occupier_add='$occupier_add',auth_req='$auth_req',ren_auth='$ren_auth',year_of_comm='$year_of_comm',ind_work='$ind_work' where user_id='$swr_id' and form_id=$form_id");
	}
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		if($input_size1!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size1;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];	
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,sl_no,particular,nature,qty,unit) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}
		if($input_size2!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				/*$vala=$_POST["txttA".$i];	*/		
				$valb=$_POST["txttB".$i];
				$valc=$_POST["txttC".$i];
				$vald=$_POST["txttD".$i];
				$vale=$_POST["txttE".$i];	
				$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(form_id,sl_no,particulars,nature,qty,unit) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}
		if(isset($part1) && $part1==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=1';
			</script>";
		}else if(isset($part2) && $part2==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=1';
			</script>";
		}else{
			 echo "<script>
				alert('Successfully Saved..');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";	
		}
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=1';
		   </script>";
	}						
}
if(isset($_POST["save21b"])){		
	$input_size3=clean($_POST["hiddenval3"]);$input_size4=clean($_POST["hiddenval4"]);$input_size5=clean($_POST["hiddenval5"]);$is_generator=clean($_POST["is_generator"]);
	
	if(!empty($_POST["mode_of_manage"]))	$mode_of_manage=json_encode($_POST["mode_of_manage"]);
	else	$mode_of_manage=NULL;
	$env_details=clean($_POST["env_details"]);
		
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = '".$table_name.".php';
		</script>";
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];
		$save_query="UPDATE ".$table_name." SET is_generator='$is_generator',mode_of_manage='$mode_of_manage' ,env_details='$env_details' WHERE form_id='$form_id'";
		$query = $formFunctions->executeQuery($dept,$save_query);
	}	
	if($query){
		if($input_size3!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t3 where form_id='$form_id'");
			for($i=1;$i<$input_size3;$i++){
				/*$vala=$_POST["txxtA".$i];	*/		
				$valb=$_POST["txxtB".$i];
				$valc=$_POST["txxtC".$i];
				$vald=$_POST["txxtD".$i];
				$vale=$_POST["txxtE".$i];	
				$part3=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t3(form_id,slno,name,product_type,qty,unit) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}
		if($input_size4!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t4 where form_id='$form_id'");
			for($i=1;$i<$input_size4;$i++){
				/*$vala=$_POST["textA".$i];	*/		
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$vald=$_POST["textD".$i];
				$vale=$_POST["textE".$i];	
				//$part4=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t4(id,form_id,slno,particulars,char,qty,unit) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')");
				$part4=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t4(form_id,slno,particulars,characteristics,qty,unit) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}
		if($input_size5!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t5 where form_id='$form_id'");
			for($i=1;$i<$input_size5;$i++){
				/*$vala=$_POST["text1A".$i];	*/		
				$valb=$_POST["text1B".$i];
				$valc=$_POST["text1C".$i];
				$vald=$_POST["text1D".$i];
				$vale=$_POST["text1E".$i];	
				$part5=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t5(form_id,slno,particulars,nature_type,qty,unit) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}
		if(isset($part3) && $part3==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
		}else if(isset($part4) && $part4==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
		}else if(isset($part5) && $part5==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
		}else{
			 echo "<script>
				alert('Successfully Saved..');
				window.location.href = '".$table_name.".php?tab=3';
			</script>";
			}	
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=2';
		   </script>";
	}						
}
if(isset($_POST["save21c"])){		
	$is_operator=clean($_POST["is_operator"]);$input_size6=clean($_POST["hiddenval6"]);$incineration=clean($_POST["incineration"]);$leachate=clean($_POST["leachate"]);$fire_system=clean($_POST["fire_system"]);$trans_arrangement=clean($_POST["trans_arrangement"]);$facility_detail=clean($_POST["facility_detail"]);		
			
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = '".$table_name.".php';
		</script>";
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];
		$save_query="UPDATE ".$table_name." SET is_operator='$is_operator',incineration='$incineration',leachate='$leachate',fire_system='$fire_system',trans_arrangement='$trans_arrangement',facility_detail='$facility_detail' WHERE form_id='$form_id'";
		$query = $formFunctions->executeQuery($dept,$save_query);
	}	
	if($query){
		if($input_size6!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t6 where form_id='$form_id'");
			for($i=1;$i<$input_size6;$i++){
				/*$vala=$_POST["textA".$i];	*/		
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$vald=$_POST["textD".$i];
				$part6=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t6(form_id,slno,particulars,capacity,unit) VALUES ('$form_id','$i','$valb','$valc','$vald')");
			}
		}			
		if(isset($part6) && $part6==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=3';
			</script>";
		}else{
			echo "<script>
				alert('Successfully Saved..');
				window.location.href = '".$table_name.".php?tab=4';
			</script>";
		}	
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=3';
		</script>";
	}	
} 						
if(isset($_POST["save21d"])){		
	$input_size7=clean($_POST["hiddenval7"]);$input_size8=clean($_POST["hiddenval8"]);$storage_detail=clean($_POST["storage_detail"]);$process_desc=clean($_POST["process_desc"]);$pcs_detail=clean($_POST["pcs_detail"]);$health_details=clean($_POST["health_details"]);$pcb_guidelines=clean($_POST["pcb_guidelines"]);$trans_arrange=clean($_POST["trans_arrange"]);$is_recycler=clean($_POST["is_recycler"]);		
	if(!empty($_POST["ins_capacity"]))	$ins_capacity=json_encode($_POST["ins_capacity"]);
	else	$ins_capacity=NULL;	
	if($pcb_guidelines=="Y") $pcb_guidelines=clean($_POST["pcb_guidelines"]);
			else $pcb_guidelines="";			
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = '".$table_name.".php';
		</script>";
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];
		$save_query="UPDATE ".$table_name." SET is_recycler='$is_recycler',ins_capacity='$ins_capacity',storage_detail='$storage_detail',process_desc='$process_desc',pcs_detail='$pcs_detail',health_details='$health_details',pcb_guidelines='$pcb_guidelines',trans_arrange='$trans_arrange' WHERE form_id='$form_id'";
		$query = $formFunctions->executeQuery($dept,$save_query);
	}	
	
	if($query){
		if($input_size7!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t7 where form_id='$form_id'");
			for($i=1;$i<$input_size7;$i++){
				/*$vala=$_POST["textA".$i];	*/		
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$vald=$_POST["textD".$i];
				$vale=$_POST["textE".$i];
				$valf=$_POST["textF".$i];
				$part7=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t7(form_id,slno,particulars,nature,qty,unit,source) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale','$valf')");
			}
		}
		if($input_size8!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t8 where form_id='$form_id'");
			for($i=1;$i<$input_size8;$i++){
				/*$vala=$_POST["txxtA".$i];	*/		
				$valb=$_POST["txxtB".$i];
				$valc=$_POST["txxtC".$i];
				$vald=$_POST["txxtD".$i];
				$vale=$_POST["txxtE".$i];
				$part8=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t8(form_id,slno,name,product_type,qty,unit) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}
		if(isset($part7) && $part7==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=4';
			</script>";
		}else if(isset($part8) && $part8==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=4';
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
			window.location.href = '".$table_name.".php?tab=4';
		   </script>";
	}
}		   

if(isset($_POST["save24a"]) ){
	$production=clean($_POST["production"]);
	if(!empty($_POST["ren_auth"])) $ren_auth=json_encode($_POST["ren_auth"]);
		else $ren_auth=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name." (user_id,ren_auth,production) values('$swr_id','$ren_auth','$production')");
	}else{
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET  sub_date='$today', ren_auth='$ren_auth',production='$production' WHERE user_id='$swr_id' AND form_id='$form_id'");	
	}
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$table_name.".php?tab=2';
		</script>";
	}else{
		echo "<script>
			alert('Invalid Entry');
			window.location.href = '".$table_name.".php';
		</script>";
	}
}
if(isset($_POST["save24b"]) ){
	$is_generator=clean($_POST["is_generator"]);$total_waste=clean($_POST["total_waste"]);$disposal=clean($_POST["disposal"]);$recycler=clean($_POST["recycler"]);$others=clean($_POST["others"]);$utilised=clean($_POST["utilised"]);$storage=clean($_POST["storage"]);
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name." (user_id,is_generator,total_waste,disposal,recycler,others,utilised,storage) values('$swr_id','$is_generator','$total_waste','$disposal','$recycler','$others','$utilised','$storage')");
	}else{
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET  sub_date='$today', is_generator='$is_generator',total_waste='$total_waste',disposal='$disposal',recycler='$recycler',others='$others',utilised='$utilised',storage='$storage' WHERE user_id='$swr_id' AND form_id='$form_id'");	
	}
	if($query){
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$table_name.".php?tab=3';
		</script>";
	}else{
		echo "<script>
			alert('Invalid Entry');
			window.location.href = '".$table_name.".php?tab=2';
		</script>";
	}
}
if(isset($_POST["save24c"])){
	$is_operator=clean($_POST["is_operator"]);$total_quantity=clean($_POST["total_quantity"]);$Stock_quantity=clean($_POST["Stock_quantity"]);$quantity_treated=clean($_POST["quantity_treated"]);$quantity_disposed=clean($_POST["quantity_disposed"]);$incinerated_q=clean($_POST["incinerated_q"]);$processed_q=clean($_POST["processed_q"]);$storage_q=clean($_POST["storage_q"]);
	
	$query=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$query->fetch_array();
	if($query->num_rows<1){   ////////////If first part is filled up////////////// 
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name." (sub_date,is_operator,total_quantity,Stock_quantity,quantity_treated,quantity_disposed,incinerated_q,processed_q,storage_q) values('$today','$is_operator','$total_quantity','$Stock_quantity','$quantity_treated','$quantity_disposed','$incinerated_q','$processed_q','$storage_q')");
	}else{
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET  sub_date='$today',is_operator='$is_operator',total_quantity='$total_quantity',Stock_quantity='$Stock_quantity',quantity_treated='$quantity_treated',quantity_disposed='$quantity_disposed',incinerated_q='$incinerated_q',processed_q='$processed_q',storage_q='$storage_q' WHERE user_id='$swr_id' AND form_id='$form_id'");
	}
	if($query){
		echo "<script>
			alert('Successfully Saved.');
		    window.location.href = '".$table_name.".php?tab=4';
		    </script>";
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=3';
			</script>";
	}
}
if(isset($_POST["save24d"])){
	$is_recycler=clean($_POST["is_recycler"]);$dom_src=clean($_POST["dom_src"]);$imported=clean($_POST["imported"]);$stock_q_begin=clean($_POST["stock_q_begin"]);$recycled_q=clean($_POST["recycled_q"]);$dispatched_q=clean($_POST["dispatched_q"]);$waste_q_gen=clean($_POST["waste_q_gen"]);$disposed_q=clean($_POST["disposed_q"]);$re_exported_q=clean($_POST["re_exported_q"]);$storage_q_recyle=clean($_POST["storage_q_recyle"]);
	
	$query=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$query->fetch_array();
	if($query->num_rows<1){   ////////////If first part is filled up////////////// 
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name." (sub_date,is_recycler,dom_src,imported,stock_q_begin,recycled_q,dispatched_q,waste_q_gen,disposed_q,re_exported_q,storage_q_recyle) values('$today','$is_recycler','$dom_src','$imported','$stock_q_begin','$recycled_q','$dispatched_q','$waste_q_gen','$disposed_q','$re_exported_q','$storage_q_recyle')");
	}else{
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET  sub_date='$today',is_recycler='$is_recycler',dom_src='$dom_src',imported='$imported',stock_q_begin='$stock_q_begin',recycled_q='$recycled_q',dispatched_q='$dispatched_q',waste_q_gen='$waste_q_gen',disposed_q='$disposed_q',re_exported_q='$re_exported_q',storage_q_recyle='$storage_q_recyle' WHERE user_id='$swr_id' AND form_id='$form_id'");
	}
	if($query){
		echo "<script>
			alert('Successfully Saved.');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=4';
		</script>";
	}
}

if(isset($_POST["save25a"]) ){
	$facility_loc=clean($_POST["facility_loc"]);$import_reason=clean($_POST["import_reason"]);$details_of_import=clean($_POST["details_of_import"]);$port_of_entry=clean($_POST["port_of_entry"]);	
	if(!empty($_POST["imp_outside_address"])) $imp_outside_address=json_encode($_POST["imp_outside_address"]);
		else $imp_outside_address=NULL;
	if(!empty($_POST["waste_detail"])) $waste_detail=json_encode($_POST["waste_detail"]);
		else $waste_detail=NULL;
	if(!empty($_POST["importer"])) $importer=json_encode($_POST["importer"]);
		else $importer=NULL;
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name." (user_id,facility_loc,import_reason,imp_outside_address,waste_detail,importer,details_of_import,port_of_entry) values('$swr_id','$facility_loc','$import_reason','$imp_outside_address','$waste_detail','$importer','$details_of_import','$port_of_entry')");
	}else{
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET  sub_date='$today',facility_loc='$facility_loc',import_reason='$import_reason',imp_outside_address='$imp_outside_address',waste_detail='$waste_detail',importer='$importer',details_of_import='$details_of_import',port_of_entry='$port_of_entry' WHERE user_id='$swr_id' AND form_id='$form_id'");	
	}
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$table_name.".php?tab=2';
		</script>";
	}else{	
		echo "<script>
			alert('Invalid Entry');
			window.location.href = '".$table_name.".php';
		</script>";
	}
}
if(isset ($_POST["save25b"])){
	echo "<script>
		alert('Successfully Submitted.');
		window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
	</script>";		
}

if(isset($_POST["save26a"])){
	$applicant_ref_no=clean($_POST["applicant_ref_no"]);$im_ex_country=clean($_POST["im_ex_country"]);
	
	if(!empty($_POST["exporter"]))	$exporter=json_encode($_POST["exporter"]);
	else	$exporter=NULL;
	if(!empty($_POST["generator"]))	$generator=json_encode($_POST["generator"]);
	else	$generator=NULL;
	if(!empty($_POST["trader"]))	$trader=json_encode($_POST["trader"]);
	else	$trader=NULL;
	if(!empty($_POST["actual"]))	$actual=json_encode($_POST["actual"]);
	else	$actual=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,exporter,generator,trader,actual,applicant_ref_no,im_ex_country) values('$swr_id','$exporter','$generator','$trader','$actual','$applicant_ref_no','$im_ex_country')");
	}else{
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET  sub_date='$today', exporter='$exporter',generator='$generator',trader='$trader',actual='$actual',applicant_ref_no='$applicant_ref_no',im_ex_country='$im_ex_country' WHERE user_id='$swr_id' AND form_id='$form_id'");	
	}
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$table_name.".php?tab=2';
		</script>";
	}else{	
		echo "<script>
			alert('Invalid Entry');
			window.location.href = '".$table_name.".php';
		</script>";
	}
}
if(isset($_POST["save26b"])){
	$spec_hndl_req=clean($_POST["spec_hndl_req"]);$ship_date=clean($_POST["ship_date"]);$total_qn=clean($_POST["total_qn"]);$trans_means=clean($_POST["trans_means"]);$transfer_date=clean($_POST["transfer_date"]);$rep_sign=clean($_POST["rep_sign"]);$export_date=clean($_POST["export_date"]);$exporter_sign=clean($_POST["exporter_sign"]);$exporter_name2=clean($_POST["exporter_name2"]);$received_by=clean($_POST["received_by"]);$quantity_rcvd=clean($_POST["quantity_rcvd"]);$rcvd_date=clean($_POST["rcvd_date"]);$importer_name=clean($_POST["importer_name"]);$importer_sign=clean($_POST["importer_sign"]);$recovery_method=clean($_POST["recovery_method"]);$r_code=clean($_POST["r_code"]);$employed_tech=clean($_POST["employed_tech"]);$importer_sign2=clean($_POST["importer_sign2"]);$import_date2=clean($_POST["import_date2"]);
	
	if(!empty($_POST["waste"]))	$waste=json_encode($_POST["waste"]);
	else	$waste=NULL;
	if(!empty($_POST["receiver"]))	$receiver=json_encode($_POST["receiver"]);
	else	$receiver=NULL;
	if(!empty($_POST["transporter"]))	$transporter=json_encode($_POST["transporter"]);
	else	$transporter=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,waste,receiver,spec_hndl_req,ship_date,total_qn,transporter,trans_means,transfer_date,rep_sign,export_date,exporter_sign,exporter_name2,received_by,quantity_rcvd,rcvd_date,importer_name,importer_sign,recovery_method,r_code,employed_tech,importer_sign2,import_date2) values('$swr_id','$waste','$receiver','$spec_hndl_req','$ship_date','$total_qn','$transporter','$trans_means','$transfer_date','$rep_sign','$export_date','$exporter_sign','$exporter_name2','$received_by','$quantity_rcvd','$rcvd_date','$importer_name','$importer_sign','$recovery_method','$r_code','$employed_tech','$importer_sign2','$import_date2')");
	}else{
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET  sub_date='$today', waste='$waste',receiver='$receiver',spec_hndl_req='$spec_hndl_req',ship_date='$ship_date',total_qn='$total_qn',transporter='$transporter',trans_means='$trans_means',transfer_date='$transfer_date',rep_sign='$rep_sign',export_date='$export_date',exporter_sign='$exporter_sign',exporter_name2='$exporter_name2',received_by='$received_by',quantity_rcvd='$quantity_rcvd',rcvd_date='$rcvd_date',importer_name='$importer_name',importer_sign='$importer_sign',recovery_method='$recovery_method',r_code='$r_code',employed_tech='$employed_tech',importer_sign2='$importer_sign2',import_date2='$import_date2' WHERE user_id='$swr_id' AND form_id='$form_id'");	
	}
	if($query){
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";
	}else{
		echo "<script>
			alert('Invalid Entry');
			window.location.href = '".$table_name.".php?tab=2';
		</script>";
	}
}

if(isset($_POST["save27"]) ){ 
	$trader_name=clean($_POST["trader_name"]);$trader_st1=clean($_POST["trader_st1"]);$trader_st2=clean($_POST["trader_st2"]);$trader_vill=clean($_POST["trader_vill"]);$trader_dist=clean($_POST["trader_dist"]);$trader_pincode=clean($_POST["trader_pincode"]);$trader_mobile_no=clean($_POST["trader_mobile_no"]);$trader_phone_no=clean($_POST["trader_phone_no"]);$trader_email=clean($_POST["trader_email"]);$export_code=clean($_POST["export_code"]);$desc_n_quant_imported=clean($_POST["desc_n_quant_imported"]);$storage_details=clean($_POST["storage_details"]);
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name." (user_id,sub_date,trader_name,trader_st1,trader_st2,trader_vill,trader_dist,trader_pincode,trader_mobile_no,trader_phone_no,trader_email,export_code,desc_n_quant_imported,storage_details) values('$swr_id','$today','$trader_name','$trader_st1','$trader_st2','$trader_vill','$trader_dist','$trader_pincode','$trader_mobile_no','$trader_phone_no','$trader_email','$export_code','$desc_n_quant_imported','$storage_details')");
	}else{
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET  sub_date='$today', trader_name='$trader_name',trader_st1='$trader_st1',trader_st2='$trader_st2',trader_vill='$trader_vill',trader_dist='$trader_dist',trader_pincode='$trader_pincode',trader_mobile_no='$trader_mobile_no',trader_phone_no='$trader_phone_no',trader_email='$trader_email',export_code='$export_code',desc_n_quant_imported='$desc_n_quant_imported',storage_details='$storage_details' WHERE user_id='$swr_id' AND form_id='$form_id'");	
	}
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		echo "<script>
			alert('Successfully saved.');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";
	}else{
		echo "<script>
		alert('Something went wrong !!!');
		window.location.href = '".$table_name.".php';
		</script>";
	}
}

if(isset($_POST["save33a"])){		
	$year_of_comm=clean($_POST["year_of_comm"]);
	$input_size1=clean($_POST["hiddenval"]);$input_size2=clean($_POST["hiddenval2"]);
	
	if(!empty($_POST["occupier_add"]))	$occupier_add=json_encode($_POST["occupier_add"]);
	else	$occupier_add=NULL;	
	if(!empty($_POST["auth_req"])) $auth_req=json_encode($_POST["auth_req"]);
	else $auth_req=NULL;	
	if(!empty($_POST["ren_auth"]))	 $ren_auth=json_encode($_POST["ren_auth"]);
	else	$ren_auth=NULL;	
	if(!empty($_POST["ind_work"])) $ind_work=json_encode($_POST["ind_work"]);
	else $list=NULL;			
			
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,occupier_add,auth_req,ren_auth,year_of_comm,ind_work) values ('$swr_id','$today','$occupier_add','$auth_req','$ren_auth','$year_of_comm','$ind_work')");
		$form_id=$query;
	}else{  ////////////table is not empty//////////////
			$form_id=$row["form_id"];	
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',occupier_add='$occupier_add',auth_req='$auth_req',ren_auth='$ren_auth',year_of_comm='$year_of_comm',ind_work='$ind_work' where user_id='$swr_id' and form_id=$form_id");
	}
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		if($input_size1!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size1;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];	
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,sl_no,particular,nature,qty,unit) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}
		if($input_size2!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				/*$vala=$_POST["txttA".$i];	*/		
				$valb=$_POST["txttB".$i];
				$valc=$_POST["txttC".$i];
				$vald=$_POST["txttD".$i];
				$vale=$_POST["txttE".$i];	
				$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(form_id,sl_no,particulars,nature,qty,unit) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}
		if(isset($part1) && $part1==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=1';
			</script>";
		}else if(isset($part2) && $part2==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=1';
			</script>";
		}else{
			 echo "<script>
				alert('Successfully Saved..');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";	
		}
	}else{
	   echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=1';
		   </script>";
   }						
}
if(isset($_POST["save33b"])){		
	$env_details=clean($_POST["env_details"]);$input_size3=clean($_POST["hiddenval3"]);$input_size4=clean($_POST["hiddenval4"]);$input_size5=clean($_POST["hiddenval5"]);$is_generator=clean($_POST["is_generator"]);
	if(!empty($_POST["mode_of_manage"]))	$mode_of_manage=json_encode($_POST["mode_of_manage"]);
	else	$mode_of_manage=NULL;	
		
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();	
	if($sql->num_rows<1){   ////////////table is empty//////////////
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = '".$table_name.".php';
		</script>";
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET is_generator='$is_generator',mode_of_manage='$mode_of_manage' ,env_details='$env_details' WHERE form_id='$form_id'");
	}
	if($query){
		if($input_size3!=0){					
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t3 where form_id='$form_id'");
			for($i=1;$i<$input_size3;$i++){
				/*$vala=$_POST["txxtA".$i];	*/		
				$valb=$_POST["txxtB".$i];
				$valc=$_POST["txxtC".$i];
				$vald=$_POST["txxtD".$i];
				$vale=$_POST["txxtE".$i];	
				$part3=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t3(form_id,slno,name,product_type,qty,unit) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}
		if($input_size4!=0){					
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t4 where form_id='$form_id'");
			for($i=1;$i<$input_size4;$i++){
				/*$vala=$_POST["textA".$i];	*/		
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$vald=$_POST["textD".$i];
				$vale=$_POST["textE".$i];	
				//$part4=$formFunctions->executeQuery($dept,"INSERT INTO pcb_form33_t4(id,form_id,slno,particulars,char,qty,unit) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')");
				$part4=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t4(form_id,slno,particulars,characteristics,qty,unit) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}
		if($input_size5!=0){					
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t5 where form_id='$form_id'");
			for($i=1;$i<$input_size5;$i++){
				/*$vala=$_POST["text1A".$i];	*/		
				$valb=$_POST["text1B".$i];
				$valc=$_POST["text1C".$i];
				$vald=$_POST["text1D".$i];
				$vale=$_POST["text1E".$i];	
				$part5=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t5(form_id,slno,particulars,nature_type,qty,unit) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}
		if(isset($part3) && $part3==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
		}else if(isset($part4) && $part4==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
		}else if(isset($part5) && $part5==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
		}else{
			 echo "<script>
				alert('Successfully Saved..');
				window.location.href = '".$table_name.".php?tab=3';
			</script>";
			}	
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=2';
		   </script>";
	}						
}
if(isset($_POST["save33c"])){		
	$is_operator=clean($_POST["is_operator"]);$input_size6=clean($_POST["hiddenval6"]);$incineration=clean($_POST["incineration"]);$leachate=clean($_POST["leachate"]);$fire_system=clean($_POST["fire_system"]);$trans_arrangement=clean($_POST["trans_arrangement"]);$facility_detail=clean($_POST["facility_detail"]);		
			
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = '".$table_name.".php';
		</script>";
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET is_operator='$is_operator',incineration='$incineration',leachate='$leachate',fire_system='$fire_system',trans_arrangement='$trans_arrangement',facility_detail='$facility_detail' WHERE form_id='$form_id'") ;
	}
	if($query){
		if($input_size6!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t6 where form_id='$form_id'");
			for($i=1;$i<$input_size6;$i++){
				/*$vala=$_POST["textA".$i];	*/		
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$vald=$_POST["textD".$i];
				$part6=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t6(form_id,slno,particulars,capacity,unit) VALUES ('$form_id','$i','$valb','$valc','$vald')");
			}
		}			
		if(isset($part6) && $part6==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=3';
			</script>";
		}else{
				echo "<script>
				alert('Successfully Saved..');
				window.location.href = '".$table_name.".php?tab=4';
			</script>";
		}	
	}else{
		echo "<script>
		alert('Something went wrong !!!');
		window.location.href = '".$table_name.".php?tab=3';
		</script>";
	}	
} 						
if(isset($_POST["save33d"])){		
	$input_size7=clean($_POST["hiddenval7"]);$input_size8=clean($_POST["hiddenval8"]);$storage_detail=clean($_POST["storage_detail"]);$process_desc=clean($_POST["process_desc"]);$pcs_detail=clean($_POST["pcs_detail"]);$health_details=clean($_POST["health_details"]);$pcb_guidelines=clean($_POST["pcb_guidelines"]);$trans_arrange=clean($_POST["trans_arrange"]);$is_recycler=clean($_POST["is_recycler"]);	
	
	if(!empty($_POST["ins_capacity"]))	$ins_capacity=json_encode($_POST["ins_capacity"]);
	else	$ins_capacity=NULL;	
	//if($pcb_guidelines=="Y") $pcb_guidelines=clean($_POST["pcb_guidelines"]);
		//	else $pcb_guidelines="";			
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = '".$table_name.".php';
		</script>";
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];
		$query=$formFunctions->executeQuery($dept,"UPDATE ".$table_name." SET is_recycler='$is_recycler',ins_capacity='$ins_capacity',storage_detail='$storage_detail',process_desc='$process_desc',pcs_detail='$pcs_detail',health_details='$health_details',pcb_guidelines='$pcb_guidelines',trans_arrange='$trans_arrange' WHERE form_id='$form_id'") ;
	}
	if($query){
		if($input_size7!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t7 where form_id='$form_id'");
			for($i=1;$i<$input_size7;$i++){
				/*$vala=$_POST["textA".$i];	*/		
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$vald=$_POST["textD".$i];
				$vale=$_POST["textE".$i];
				$valf=$_POST["textF".$i];
				$part7=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t7(form_id,slno,particulars,nature,qty,unit,source) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale','$valf')");
			}
		}
		if($input_size8!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t8 where form_id='$form_id'");
			for($i=1;$i<$input_size8;$i++){
				/*$vala=$_POST["txxtA".$i];	*/		
				$valb=$_POST["txxtB".$i];
				$valc=$_POST["txxtC".$i];
				$vald=$_POST["txxtD".$i];
				$vale=$_POST["txxtE".$i];
				$part8=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t8(form_id,slno,name,product_type,qty,unit) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}
		if(isset($part7) && $part7==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=4';
			</script>";
		}else if(isset($part8) && $part8==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=4';
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
			window.location.href = '".$table_name.".php?tab=4';
		   </script>";
	}
}		   

if(isset($_POST["save34a"])){		
	$year_of_comm=clean($_POST["year_of_comm"]);
	$input_size1=clean($_POST["hiddenval"]);$input_size2=clean($_POST["hiddenval2"]);
	if(!empty($_POST["occupier_add"]))	$occupier_add=json_encode($_POST["occupier_add"]);
	else	$occupier_add=NULL;	
	if(!empty($_POST["auth_req"])) $auth_req=json_encode($_POST["auth_req"]);
	else $auth_req=NULL;	
	if(!empty($_POST["ren_auth"]))	 $ren_auth=json_encode($_POST["ren_auth"]);
	else	$ren_auth=NULL;	
	if(!empty($_POST["ind_work"])) $ind_work=json_encode($_POST["ind_work"]);
	else $ind_work=NULL;			
			
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,occupier_add,auth_req,ren_auth,year_of_comm,ind_work) values ('$swr_id','$today','$occupier_add','$auth_req','$ren_auth','$year_of_comm','$ind_work')");
		$form_id=$query;
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',occupier_add='$occupier_add',auth_req='$auth_req',ren_auth='$ren_auth',year_of_comm='$year_of_comm',ind_work='$ind_work' where user_id='$swr_id' and form_id=$form_id");
	}
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form);
		if($input_size1!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size1;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];	
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,sl_no,particular,nature,qty,unit) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}
		if($input_size2!=0){					
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				/*$vala=$_POST["txttA".$i];	*/		
				$valb=$_POST["txttB".$i];
				$valc=$_POST["txttC".$i];
				$vald=$_POST["txttD".$i];
				$vale=$_POST["txttE".$i];	
				$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(form_id,sl_no,particulars,nature,qty,unit) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}
		if(isset($part1) && $part1==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=1';
			</script>";
		}else if(isset($part2) && $part2==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=1';
			</script>";
		}else{
			 echo "<script>
				alert('Successfully Saved..');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";	
		}
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=1';
		   </script>";
	}						
}
if(isset($_POST["save34b"])){		
	$env_details=clean($_POST["env_details"]);$input_size3=clean($_POST["hiddenval3"]);$input_size4=clean($_POST["hiddenval4"]);$input_size5=clean($_POST["hiddenval5"]);$is_generator=clean($_POST["is_generator"]);
	if(!empty($_POST["mode_of_manage"]))	$mode_of_manage=json_encode($_POST["mode_of_manage"]);
	else	$mode_of_manage=NULL;
			
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = '".$table_name.".php';
		</script>";
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];
		$save_query="UPDATE ".$table_name." SET is_generator='$is_generator',mode_of_manage='$mode_of_manage' ,env_details='$env_details' WHERE form_id='$form_id'";
		$query = $formFunctions->executeQuery($dept,$save_query);
	}	
	if($query){
		if($input_size3!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t3 where form_id='$form_id'");
			for($i=1;$i<$input_size3;$i++){
				/*$vala=$_POST["txxtA".$i];	*/		
				$valb=$_POST["txxtB".$i];
				$valc=$_POST["txxtC".$i];
				$vald=$_POST["txxtD".$i];
				$vale=$_POST["txxtE".$i];	
				$part3=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t3(form_id,slno,name,product_type,qty,unit) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}
		if($input_size4!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t4 where form_id='$form_id'");
			for($i=1;$i<$input_size4;$i++){
				/*$vala=$_POST["textA".$i];	*/		
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$vald=$_POST["textD".$i];
				$vale=$_POST["textE".$i];	
				//$part4=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t4(id,form_id,slno,particulars,char,qty,unit) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')");
				$part4=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t4(form_id,slno,particulars,characteristics,qty,unit) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}
		if($input_size5!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t5 where form_id='$form_id'");
			for($i=1;$i<$input_size5;$i++){
				/*$vala=$_POST["text1A".$i];	*/		
				$valb=$_POST["text1B".$i];
				$valc=$_POST["text1C".$i];
				$vald=$_POST["text1D".$i];
				$vale=$_POST["text1E".$i];	
				$part5=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t5(form_id,slno,particulars,nature_type,qty,unit) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}
		if(isset($part3) && $part3==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
		}else if(isset($part4) && $part4==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
		}else if(isset($part5) && $part5==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
		}else{
			 echo "<script>
				alert('Successfully Saved..');
				window.location.href = '".$table_name.".php?tab=3';
			</script>";
			}	
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=2';
		   </script>";
	}					
}
if(isset($_POST["save34c"])){		
	$is_operator=clean($_POST["is_operator"]);$input_size6=clean($_POST["hiddenval6"]);$incineration=clean($_POST["incineration"]);$leachate=clean($_POST["leachate"]);$fire_system=clean($_POST["fire_system"]);$trans_arrangement=clean($_POST["trans_arrangement"]);$facility_detail=clean($_POST["facility_detail"]);		
			
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = '".$table_name.".php';
		</script>";
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];
		$save_query="UPDATE ".$table_name." SET is_operator='$is_operator',incineration='$incineration',leachate='$leachate',fire_system='$fire_system',trans_arrangement='$trans_arrangement',facility_detail='$facility_detail' WHERE form_id='$form_id'";
		$query = $formFunctions->executeQuery($dept,$save_query);
	}	
	if($query){
		if($input_size6!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t6 where form_id='$form_id'");
			for($i=1;$i<$input_size6;$i++){
				/*$vala=$_POST["textA".$i];	*/		
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$vald=$_POST["textD".$i];
				$part6=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t6(form_id,slno,particulars,capacity,unit) VALUES ('$form_id','$i','$valb','$valc','$vald')");
			}
		}			
		if(isset($part6) && $part6==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=3';
			</script>";
		}else{
				echo "<script>
				alert('Successfully Saved..');
				window.location.href = '".$table_name.".php?tab=4';
			</script>";
		}	
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=3';
		</script>";
	}	
} 						
if(isset($_POST["save34d"])){		
	$input_size7=clean($_POST["hiddenval7"]);$input_size8=clean($_POST["hiddenval8"]);$storage_detail=clean($_POST["storage_detail"]);$process_desc=clean($_POST["process_desc"]);$pcs_detail=clean($_POST["pcs_detail"]);$health_details=clean($_POST["health_details"]);$pcb_guidelines=clean($_POST["pcb_guidelines"]);$trans_arrange=clean($_POST["trans_arrange"]);$is_recycler=clean($_POST["is_recycler"]);		
	if(!empty($_POST["ins_capacity"]))	$ins_capacity=json_encode($_POST["ins_capacity"]);
	else	$ins_capacity=NULL;	
	if($pcb_guidelines=="Y") $pcb_guidelines=clean($_POST["pcb_guidelines"]);
	else $pcb_guidelines="";			
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = '".$table_name.".php';
		</script>";
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];
		$save_query="UPDATE ".$table_name." SET is_recycler='$is_recycler',ins_capacity='$ins_capacity',storage_detail='$storage_detail',process_desc='$process_desc',pcs_detail='$pcs_detail',health_details='$health_details',pcb_guidelines='$pcb_guidelines',trans_arrange='$trans_arrange' WHERE form_id='$form_id'";
		$query = $formFunctions->executeQuery($dept,$save_query);
	}	
	if($query){
		if($input_size7!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t7 where form_id='$form_id'");
			for($i=1;$i<$input_size7;$i++){
				/*$vala=$_POST["textA".$i];	*/		
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$vald=$_POST["textD".$i];
				$vale=$_POST["textE".$i];
				$valf=$_POST["textF".$i];
				$part7=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t7(form_id,slno,particulars,nature,qty,unit,source) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale','$valf')");
			}
		}
		if($input_size8!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t8 where form_id='$form_id'");
			for($i=1;$i<$input_size8;$i++){
				/*$vala=$_POST["txxtA".$i];	*/		
				$valb=$_POST["txxtB".$i];
				$valc=$_POST["txxtC".$i];
				$vald=$_POST["txxtD".$i];
				$vale=$_POST["txxtE".$i];
				$part8=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t8(form_id,slno,name,product_type,qty,unit) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}
		if(isset($part7) && $part7==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=4';
			</script>";
		}else if(isset($part8) && $part8==false){
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=4';
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
			window.location.href = '".$table_name.".php?tab=4';
		</script>";
	}
}		   
?>