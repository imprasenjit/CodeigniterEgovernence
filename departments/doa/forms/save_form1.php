<?php
if(isset($_POST["save11"])){		
	$auth_desig=clean($_POST["auth_desig"]);$place=clean($_POST["place"]);$state=clean($_POST["state"]);$concern=clean($_POST["concern"]);$is_intimate=clean($_POST["is_intimate"]);$other=clean($_POST["other"]);$office_id=clean($_POST["office_id"]);
	$input_size=$_POST["hiddenval"];
	if(!empty($_POST["sale"]))	 $sale=json_encode($_POST["sale"]);
	else	$sale=NULL;
	if(!empty($_POST["storage"]))	 $storage=json_encode($_POST["storage"]);
	else	$storage=NULL;
	$officer_id_query = $formFunctions->executeQuery($dept,"select user_id from users where office_id='$office_id' and utype='2' and status='1'");
	if($officer_id_query->num_rows>0){
		$officer_id = $officer_id_query->fetch_object()->user_id;
	}else{
		echo "<script>
				alert('Please call helpdesk to resolve this problem.');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}		
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,office_id,officer_id,auth_desig,place,state,concern,sale,storage,is_intimate,other) values ('$swr_id','$today', '$office_id','$officer_id','$auth_desig', '$place', '$state', '$concern', '$sale', '$storage', '$is_intimate', '$other')") ;
			$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',office_id='$office_id',officer_id='$officer_id',  auth_desig='$auth_desig', place='$place',  state='$state',concern='$concern', sale='$sale', storage='$storage', is_intimate='$is_intimate', other='$other' where form_id=$form_id") ;
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
			if($input_size!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,slno,firm,stock) VALUES ('','$form_id','$i','$valb','$valc')");
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

if(isset($_POST["save12a"])){		
	$is_applicant=clean($_POST["is_applicant"]);$type_f_pest=clean($_POST["type_f_pest"]);$is_trade=clean($_POST["is_trade"]);$trade_particulars=clean($_POST["trade_particulars"]);$situation=clean($_POST["situation"]);$pest_control=clean($_POST["pest_control"]);$full_particular=clean($_POST["full_particular"]);$tech_person=clean($_POST["tech_person"]);$contact_no=clean($_POST["contact_no"]);$office_id=clean($_POST["office_id"]);
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	$officer_id_query = $formFunctions->executeQuery($dept,"select user_id from users where office_id='$office_id' and utype='2' and status='1'");
	if($officer_id_query->num_rows>0){
		$officer_id = $officer_id_query->fetch_object()->user_id;
	}else{
		echo "<script>
				alert('Please call helpdesk to resolve this problem.');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}				
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,office_id,officer_id,is_applicant,type_f_pest,is_trade,trade_particulars,situation,pest_control,full_particular,tech_person,contact_no) values ('$swr_id','$today','$office_id','$officer_id', '$is_applicant', '$type_f_pest', '$is_trade', '$trade_particulars', '$situation', '$pest_control', '$full_particular', '$tech_person', '$contact_no')") ;
			$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',office_id='$office_id',officer_id='$officer_id',is_applicant='$is_applicant',type_f_pest='$type_f_pest',is_trade='$is_trade',trade_particulars='$trade_particulars', situation='$situation', pest_control='$pest_control', full_particular='$full_particular',tech_person='$tech_person', contact_no='$contact_no' where form_id=$form_id") ;
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form);
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
if(isset($_POST["save12b"])){		
	$name=clean($_POST["name"]);$father_name=clean($_POST["father_name"]);$vill=clean($_POST["vill"]);$operation=clean($_POST["operation"]);$po=clean($_POST["po"]);$quali=clean($_POST["quali"]);
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		 echo "<script>
		   alert('Please fill up the first part of the form !!!');
		   window.location.href = '".$table_name.".php';
		</script>";				
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',  name='$name', father_name='$father_name',  vill='$vill',operation='$operation', po='$po', quali='$quali' where form_id=$form_id") ;
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
if(isset($_POST["save12c"])){		
	$report_year=clean($_POST["report_year"]);
	$input_size=$_POST["hiddenval"];
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////
		 echo "<script>
		   alert('Please fill up the first part of the form !!!');
		   window.location.href = '".$table_name.".php';
		</script>";
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',  report_year='$report_year' where form_id=$form_id") ;
	}				
	if($query){
			if($input_size!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$valf=$_POST["txtF".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,slno,name,position,safety,operator,job_done) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale','$valf')");
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

if(isset($_POST["save13"])){
	$is_convicted=clean($_POST["is_convicted"]);$is_convicted_details=clean($_POST["is_convicted_details"]);$seeds_detail=clean($_POST["seeds_detail"]);$office_id=clean($_POST["office_id"]);
	$hidden_value=clean($_POST["hidden_value"]); 
	if(!empty($_POST["sale"]))	 $sale=json_encode($_POST["sale"]);
	else	$sale=NULL;
	if(!empty($_POST["storage"]))	 $storage=json_encode($_POST["storage"]);
	else	$storage=NULL;
	if($is_convicted=="Y"){
			$is_convicted_details=clean($_POST["is_convicted_details"]);
		}else{
			$is_convicted_details=" ";			
		}
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	$officer_id_query = $formFunctions->executeQuery($dept,"select user_id from users where office_id='$office_id' and utype='2' and status='1'");
	if($officer_id_query->num_rows>0){
		$officer_id = $officer_id_query->fetch_object()->user_id;
	}else{
		echo "<script>
				alert('Please call helpdesk to resolve this problem.');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}		
	if($sql->num_rows<1){   ////////////table is empty//////////////
		
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,office_id,officer_id,is_convicted,is_convicted_details,seeds_detail,sale,storage) values ('$swr_id','$today','$office_id','$officer_id','$is_convicted', '$is_convicted_details', '$seeds_detail', '$sale', '$storage')") ;
		$form_id=$query;
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_members where form_id='$form_id'");
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$address=$_POST["address".$i.""];$contact=$_POST["contact".$i.""];
				
				$query1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_members(id,form_id,sl_no,name,address,contact) VALUES ('','$form_id','$i','$name','$address','$contact')");				
			}				
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',office_id='$office_id',officer_id='$officer_id', is_convicted='$is_convicted', is_convicted_details='$is_convicted_details', seeds_detail='$seeds_detail', sale='$sale' , storage='$storage'  where form_id='$form_id'") ;
           $members_check=$formFunctions->executeQuery($dept,"select id from ".$table_name."_members where form_id='$form_id'");
		   if($members_check->num_rows>0){
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$address=$_POST["address".$i.""];$contact=$_POST["contact".$i.""];
				
				$query1=$formFunctions->executeQuery($dept,"UPDATE ".$table_name."_members set name='$name',address='$address',contact='$contact' where form_id='$form_id' and sl_no='$i'");
              }	
		}else{
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_members where form_id='$form_id'");
			for($i=1;$i<=$hidden_value;$i++){
				$name=$_POST["name".$i.""];$address=$_POST["address".$i.""];$contact=$_POST["contact".$i.""];
				$query1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_members(form_id,sl_no,name,address,contact) VALUES ('$form_id','$i','$name','$address','$contact')");
			}  
		}	  
	}	
	if($query==true && $query1==true){
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

if(isset($_POST["save14"])){
	$business=clean($_POST["business"]);$licence_state=clean($_POST["licence_state"]);$licence_no=clean($_POST["licence_no"]);
	$day=clean($_POST["day"]);$year=clean($_POST["year"]);$licence_bearing_no=clean($_POST["licence_bearing_no"]);$situated=clean($_POST["situated"]);$renewed=clean($_POST["renewed"]);$office_id=clean($_POST["office_id"]);
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
    
    $officer_id_query = $formFunctions->executeQuery($dept,"select user_id from users where office_id='$office_id' and utype='2' and status='1'");
	if($officer_id_query->num_rows>0){
		$officer_id = $officer_id_query->fetch_object()->user_id;
	}else{
		echo "<script>
				alert('Please call helpdesk to resolve this problem.');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}		
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,office_id,officer_id,business,licence_state,licence_no,day,year,licence_bearing_no,situated,renewed) values ('$swr_id','$today','$office_id','$officer_id','$business','$licence_state','$licence_no','$day','$year','$licence_bearing_no','$situated','$renewed')") ;	
        $form_id=$query;	
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',office_id='$office_id',officer_id='$officer_id',business='$business',licence_state='$licence_state',  licence_no='$licence_no',day='$day',year='$year',licence_bearing_no='$licence_bearing_no',situated='$situated', renewed='$renewed' where form_id=$form_id") ;
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
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

if(isset($_POST["save15"])){
	$pr_name1=clean($_POST["pr_name1"]);$pr_name2=clean($_POST["pr_name2"]);$pr_vill=clean($_POST["pr_vill"]);
	$pr_dist=clean($_POST["pr_dist"]);$pr_pincode=clean($_POST["pr_pincode"]);$pr_mobile_no=clean($_POST["pr_mobile_no"]);$pr_email=clean($_POST["pr_email"]);$is_provisional_details=clean($_POST["is_provisional_details"]);$total_pesticides=clean($_POST["total_pesticides"]);$office_id=clean($_POST["office_id"]);
	if($is_provisional_details!=""){
		$is_provisional_details=date("Y-m-d",strtotime($is_provisional_details));
	}else{
		$is_provisional_details=NULL;
	}
	
	$is_provisional=clean($_POST["is_provisional"]);$is_facilities_details=clean($_POST["is_facilities_details"]);$is_facilities=clean($_POST["is_facilities"]);$son_of=clean($_POST["son_of"]);$capacity=clean($_POST["capacity"]);$competent=clean($_POST["competent"]);$i_verification=clean($_POST["i_verification"]);$input_size=clean($_POST["hiddenval"]);$input_size1=clean($_POST["hiddenval2"]);
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
    $officer_id_query = $formFunctions->executeQuery($dept,"select user_id from users where office_id='$office_id' and utype='2' and status='1'");
	if($officer_id_query->num_rows>0){
		$officer_id = $officer_id_query->fetch_object()->user_id;
	}else{
		echo "<script>
				alert('Please call helpdesk to resolve this problem.');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}		
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$savequery=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,office_id,officer_id,pr_name1,pr_name2,pr_vill,pr_dist,pr_pincode,pr_mobile_no,pr_email,is_provisional_details,is_provisional,is_facilities_details,is_facilities,son_of,capacity,competent,i_verification,total_pesticides) values ('$swr_id','$today','$office_id','$officer_id','$pr_name1','$pr_name2','$pr_vill','$pr_dist','$pr_pincode','$pr_mobile_no','$pr_email','$is_provisional_details','$is_provisional','$is_facilities_details','$is_facilities','$son_of','$capacity','$competent','$i_verification','$total_pesticides')") ;	
        $form_id=$savequery;		
	}else{
		$form_id=$row["form_id"];	
		$savequery=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',office_id='$office_id',officer_id='$officer_id',pr_name1='$pr_name1',pr_name2='$pr_name2',pr_vill='$pr_vill',pr_dist='$pr_dist',pr_pincode='$pr_pincode',pr_mobile_no='$pr_mobile_no', pr_email='$pr_email',is_provisional_details='$is_provisional_details',is_provisional='$is_provisional', is_facilities_details='$is_facilities_details',is_facilities='$is_facilities',son_of='$son_of', capacity='$capacity',competent='$competent',i_verification='$i_verification',total_pesticides='$total_pesticides' where form_id=$form_id") ;
	}
	
	if($savequery){
		$formFunctions->insert_incomplete_forms($dept,$form);
		if($input_size!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,slno,name,reg_no,date) VALUES ('','$form_id','$i','$valb','$valc','$vald')");
				}
			}
       
			if($input_size1!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size1;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$vald=$_POST["textD".$i];
				$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(id,form_id,slno,name,qualification,experience) VALUES ('','$form_id','$i','$valb','$valc','$vald')");
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

if(isset($_POST["save16"])){
	$concern=clean($_POST["concern"]);$loc=clean($_POST["loc"]);$total_pesticides=clean($_POST["total_pesticides"]);$license=clean($_POST["license"]);$declaration=clean($_POST["declaration"]);$father=clean($_POST["father"]);$designation=clean($_POST["designation"]);$photo=clean($_POST["photo"]);$office_id=clean($_POST["office_id"]);
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
    $officer_id_query = $formFunctions->executeQuery($dept,"select user_id from users where office_id='$office_id' and utype='2' and status='1'");
	if($officer_id_query->num_rows>0){
		$officer_id = $officer_id_query->fetch_object()->user_id;
	}else{
		echo "<script>
				alert('Please call helpdesk to resolve this problem.');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}		
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,office_id,officer_id,concern,loc,total_pesticides,license,declaration,father,designation,photo) values ('$swr_id','$today','$office_id','$officer_id','$concern','$loc','$total_pesticides','$license','$declaration','$father','$designation','$photo')");	
        $form_id=$query;		
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',office_id='$office_id',officer_id='$officer_id',concern='$concern',loc='$loc',total_pesticides='$total_pesticides',license='$license',declaration='$declaration',father='$father',designation='$designation',photo='$photo' where form_id=$form_id");
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form);
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

if(isset($_POST["save17a"])){
	$is_application=clean($_POST["is_application"]);$name_of_training=clean($_POST["name_of_training"]);$duration_of_training=clean($_POST["duration_of_training"]);$training_certificate=clean($_POST["training_certificate"]);
	$registered_address=clean($_POST["registered_address"]);$zonal_address=clean($_POST["zonal_address"]);$branch_ofc_address=clean($_POST["branch_ofc_address"]);$premises_address=clean($_POST["premises_address"]);
	$is_approval=clean($_POST["is_approval"]);$is_approval_details=clean($_POST["is_approval_details"]);$is_approval_details1=clean($_POST["is_approval_details1"]);$is_approval_details2=clean($_POST["is_approval_details2"]);
	$name_of_insecticide=clean($_POST["name_of_insecticide"]);$name_of_res_technical=clean($_POST["name_of_res_technical"]);$is_qty=clean($_POST["is_qty"]);$is_qty_details=clean($_POST["is_qty_details"]);
	$is_qty_details1=clean($_POST["is_qty_details1"]);$office_id=clean($_POST["office_id"]);	
	$input_size=clean($_POST["hiddenval"]);

	if($is_approval_details1!="") $is_approval_details1=date("Y-m-d",strtotime($is_approval_details1)); 
	else $is_approval_details1=NULL;
	if(!empty($_POST["details"])) $details=json_encode($_POST["details"]); 
	else $details=NULL;	
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
    $officer_id_query = $formFunctions->executeQuery($dept,"select user_id from users where office_id='$office_id' and utype='2' and status='1'");
	if($officer_id_query->num_rows>0){
		$officer_id = $officer_id_query->fetch_object()->user_id;
	}else{
		echo "<script>
				alert('Please call helpdesk to resolve this problem.');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}		
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$savequery=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,office_id,officer_id,is_application,name_of_training,duration_of_training,training_certificate,registered_address,zonal_address,branch_ofc_address,premises_address,is_approval,is_approval_details,is_approval_details1,is_approval_details2,name_of_insecticide,name_of_res_technical,is_qty,is_qty_details,is_qty_details1,details) values ('$swr_id','$today','$office_id','$officer_id','$is_application','$name_of_training','$duration_of_training','$training_certificate','$registered_address','$zonal_address','$branch_ofc_address','$premises_address','$is_approval','$is_approval_details','$is_approval_details1','$is_approval_details2','$name_of_insecticide','$name_of_res_technical','$is_qty','$is_qty_details','$is_qty_details1','$details')") ;	
        $form_id=$savequery;		
	}else{
		$form_id=$row["form_id"];	
		$savequery=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',office_id='$office_id',officer_id='$officer_id',is_application='$is_application',name_of_training='$name_of_training',duration_of_training='$duration_of_training',training_certificate='$training_certificate',registered_address='$registered_address',zonal_address='$zonal_address',branch_ofc_address='$branch_ofc_address',premises_address='$premises_address',is_approval='$is_approval',is_approval_details='$is_approval_details',is_approval_details1='$is_approval_details1',is_approval_details2='$is_approval_details2',name_of_insecticide='$name_of_insecticide',name_of_res_technical='$name_of_res_technical',is_qty='$is_qty',is_qty_details='$is_qty_details',is_qty_details1='$is_qty_details1',details='$details' where form_id=$form_id") ;
	}
				
	if($savequery){
		$formFunctions->insert_incomplete_forms($dept,$form);
		if($input_size!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["textA".$i];	
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,slno,name,qualification) VALUES ('','$form_id','$i','$valb','$valc')");
			}
		}		
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
if(isset($_POST["save17b"])){	
	$insecticide_stored_add=clean($_POST["insecticide_stored_add"]);$insecticide_sold_add=clean($_POST["insecticide_sold_add"]);$is_residential_area=clean($_POST["is_residential_area"]);$is_premises=clean($_POST["is_premises"]);$licence_number=clean($_POST["licence_number"]);$date_of_grant=clean($_POST["date_of_grant"]);
	
	$input_size2=clean($_POST["hiddenval2"]);$input_size3=clean($_POST["hiddenval3"]);
	$date_of_grant=date("Y-m-d",strtotime($date_of_grant));
		
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();

	if($sql->num_rows<1){   ////////////table is empty//////////////
		$savequery=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,insecticide_stored_add,insecticide_sold_add,is_residential_area,is_premises,licence_number,date_of_grant) values ('$swr_id','$today','$insecticide_stored_add','$insecticide_sold_add','$is_residential_area','$is_premises','$licence_number','$date_of_grant')") ;	
        $form_id=$savequery;		
	}else{
		$form_id=$row["form_id"];	
		$savequery=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',insecticide_stored_add='$insecticide_stored_add',insecticide_sold_add='$insecticide_sold_add',is_residential_area='$is_residential_area',is_premises='$is_premises',licence_number='$licence_number',date_of_grant='$date_of_grant' where form_id=$form_id") ;
	}
				
	if($savequery){
		if($input_size2!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				//$vala=$_POST["txtA".$i];	
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(id,form_id,slno,parti_insecticide,name,registration_no,principal_cert) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}
		if($input_size3!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t3 where form_id='$form_id'");
			for($i=1;$i<$input_size3;$i++){
				//$vala=$_POST["txttA".$i];	
				$valb=$_POST["texttB".$i];
				$valc=$_POST["texttC".$i];
				$part3=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t3(id,form_id,slno,parti_licenses,st_government) VALUES ('','$form_id','$i','$valb','$valc')");
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

if(isset($_POST["save18a"])){
	$is_application=clean($_POST["is_application"]);$name_of_training=clean($_POST["name_of_training"]);$duration_of_training=clean($_POST["duration_of_training"]);$training_certificate=clean($_POST["training_certificate"]);
	$registered_address=clean($_POST["registered_address"]);$zonal_address=clean($_POST["zonal_address"]);$branch_ofc_address=clean($_POST["branch_ofc_address"]);$premises_address=clean($_POST["premises_address"]);
	$is_approval=clean($_POST["is_approval"]);$is_approval_details=clean($_POST["is_approval_details"]);$is_approval_details1=clean($_POST["is_approval_details1"]);$is_approval_details2=clean($_POST["is_approval_details2"]);
	$name_of_insecticide=clean($_POST["name_of_insecticide"]);$name_of_res_technical=clean($_POST["name_of_res_technical"]);$is_qty=clean($_POST["is_qty"]);$is_qty_details=clean($_POST["is_qty_details"]);
	$is_qty_details1=clean($_POST["is_qty_details1"]);$office_id=clean($_POST["office_id"]);
	
	$input_size=clean($_POST["hiddenval"]);

	if($is_approval_details1!="") $is_approval_details1=date("Y-m-d",strtotime($is_approval_details1)); 
	else $is_approval_details1=NULL;
	
	if(!empty($_POST["details"])) $details=json_encode($_POST["details"]); 
	else $details=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
      $officer_id_query = $formFunctions->executeQuery($dept,"select user_id from users where office_id='$office_id' and utype='2' and status='1'");
	if($officer_id_query->num_rows>0){
		$officer_id = $officer_id_query->fetch_object()->user_id;
	}else{
		echo "<script>
				alert('Please call helpdesk to resolve this problem.');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}	
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$savequery=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,office_id,officer_id,is_application,name_of_training,duration_of_training,training_certificate,registered_address,zonal_address,branch_ofc_address,premises_address,is_approval,is_approval_details,is_approval_details1,is_approval_details2,name_of_insecticide,name_of_res_technical,is_qty,is_qty_details,is_qty_details1,details) values ('$swr_id','$today','$office_id','$officer_id','$is_application','$name_of_training','$duration_of_training','$training_certificate','$registered_address','$zonal_address','$branch_ofc_address','$premises_address','$is_approval','$is_approval_details','$is_approval_details1','$is_approval_details2','$name_of_insecticide','$name_of_res_technical','$is_qty','$is_qty_details','$is_qty_details1','$details')") ;	
        $form_id=$savequery;		
	}else{
		$form_id=$row["form_id"];	
		$savequery=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', office_id='$office_id',officer_id='$officer_id',is_application='$is_application',name_of_training='$name_of_training',duration_of_training='$duration_of_training',training_certificate='$training_certificate',registered_address='$registered_address',zonal_address='$zonal_address',branch_ofc_address='$branch_ofc_address',premises_address='$premises_address',is_approval='$is_approval',is_approval_details='$is_approval_details',is_approval_details1='$is_approval_details1',is_approval_details2='$is_approval_details2',name_of_insecticide='$name_of_insecticide',name_of_res_technical='$name_of_res_technical',is_qty='$is_qty',is_qty_details='$is_qty_details',is_qty_details1='$is_qty_details1',details='$details' where form_id=$form_id") ;
	}
				
	if($savequery){
		$formFunctions->insert_incomplete_forms($dept,$form);
		if($input_size!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["textA".$i];	
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,slno,name,qualification) VALUES ('','$form_id','$i','$valb','$valc')");
			}
		}		
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
if(isset($_POST["save18b"])){	
	$insecticide_stored_add=clean($_POST["insecticide_stored_add"]);$insecticide_sold_add=clean($_POST["insecticide_sold_add"]);$is_residential_area=clean($_POST["is_residential_area"]);$is_premises=clean($_POST["is_premises"]);$licence_number=clean($_POST["licence_number"]);$date_of_grant=clean($_POST["date_of_grant"]);
	
	$input_size2=clean($_POST["hiddenval2"]);$input_size3=clean($_POST["hiddenval3"]);
	$date_of_grant=date("Y-m-d",strtotime($date_of_grant));
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();

	if($sql->num_rows<1){   ////////////table is empty//////////////
		$savequery=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,insecticide_stored_add,insecticide_sold_add,is_residential_area,is_premises,licence_number,date_of_grant) values ('$swr_id','$today','$insecticide_stored_add','$insecticide_sold_add','$is_residential_area','$is_premises','$licence_number','$date_of_grant')") ;	
        $form_id=$savequery;		
	}else{
		$form_id=$row["form_id"];	
		$savequery=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',insecticide_stored_add='$insecticide_stored_add',insecticide_sold_add='$insecticide_sold_add',is_residential_area='$is_residential_area',is_premises='$is_premises',licence_number='$licence_number',date_of_grant='$date_of_grant' where form_id=$form_id") ;
	}
				
	if($savequery){
		if($input_size2!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				//$vala=$_POST["txtA".$i];	
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(id,form_id,slno,parti_insecticide,name,registration_no,principal_cert) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}
		if($input_size3!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t3 where form_id='$form_id'");
			for($i=1;$i<$input_size3;$i++){
				//$vala=$_POST["txttA".$i];	
				$valb=$_POST["texttB".$i];
				$valc=$_POST["texttC".$i];
				$part3=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t3(id,form_id,slno,parti_licenses,st_government) VALUES ('','$form_id','$i','$valb','$valc')");
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

 
if(isset($_POST["save19"])){
	$day=clean($_POST["day"]);$year=clean($_POST["year"]);
	$licence=clean($_POST["licence"]);$licence_authority=clean($_POST["licence_authority"]);$operation=clean($_POST["operation"]);$expert=clean($_POST["expert"]);$insect=clean($_POST["insect"]);$stock=clean($_POST["stock"]);$branch=clean($_POST["branch"]);$new_branch=clean($_POST["new_branch"]);$other=clean($_POST["other"]);$total_pesticides=clean($_POST["total_pesticides"]);$engage=clean($_POST["engage"]);$name2=clean($_POST["name2"]);$son_of=clean($_POST["son_of"]);$designation=clean($_POST["designation"]);
	$office_id=clean($_POST["office_id"]);
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
    $officer_id_query = $formFunctions->executeQuery($dept,"select user_id from users where office_id='$office_id' and utype='2' and status='1'");
	if($officer_id_query->num_rows>0){
		$officer_id = $officer_id_query->fetch_object()->user_id;
	}else{
		echo "<script>
				alert('Please call helpdesk to resolve this problem.');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}		
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,office_id,officer_id,licence,licence_authority,day,year,operation,expert,insect,stock,branch,new_branch,other,total_pesticides,engage,name2,son_of,designation) values ('$swr_id','$today','$office_id','$officer_id','$licence','$licence_authority','$day','$year','$operation','$expert','$insect','$stock','$branch','$new_branch','$other','$total_pesticides','$engage','$name2','$son_of','$designation')") ;	
        $form_id=$query;		
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',office_id='$office_id',officer_id='$officer_id',licence='$licence',licence_authority='$licence_authority',day='$day',year='$year',operation='$operation',expert='$expert', insect='$insect', stock='$stock', branch='$branch', new_branch='$new_branch', other='$other', total_pesticides='$total_pesticides',engage='$engage',name2='$name2',son_of='$son_of',designation='$designation' where form_id=$form_id") ;
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form);
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

if(isset($_POST["save20"])){
	$state=clean($_POST["state"]);$licence_no=clean($_POST["licence_no"]);$premises=clean($_POST["premises"]);$premises1=clean($_POST["premises1"]);$pesticides=clean($_POST["pesticides"]);$principals=clean($_POST["principals"]);$day=clean($_POST["day"]);$year=clean($_POST["year"]);$office_id=clean($_POST["office_id"]);
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
    $officer_id_query = $formFunctions->executeQuery($dept,"select user_id from users where office_id='$office_id' and utype='2' and status='1'");
	if($officer_id_query->num_rows>0){
		$officer_id = $officer_id_query->fetch_object()->user_id;
	}else{
		echo "<script>
				alert('Please call helpdesk to resolve this problem.');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}		
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,office_id,officer_id,state,licence_no,premises,premises1,pesticides,principals,day,year) values ('$swr_id','$today','$office_id','$officer_id','$state','$licence_no','$premises','$premises1','$pesticides','$principals','$day','$year')");	
       $form_id=$query;	
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',office_id='$office_id',officer_id='$officer_id',state='$state', licence_no='$licence_no',day='$day',year='$year',premises='$premises',premises1='$premises1',pesticides='$pesticides',principals='$principals',day='$day',year='$year' where form_id=$form_id");
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form);
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

if(isset($_POST["save21a"])){
	$is_application=clean($_POST["is_application"]);$name_of_training=clean($_POST["name_of_training"]);$duration_of_training=clean($_POST["duration_of_training"]);$training_certificate=clean($_POST["training_certificate"]);
	$registered_address=clean($_POST["registered_address"]);$zonal_address=clean($_POST["zonal_address"]);$branch_ofc_address=clean($_POST["branch_ofc_address"]);$premises_address=clean($_POST["premises_address"]);
	$is_approval=clean($_POST["is_approval"]);$is_approval_details=clean($_POST["is_approval_details"]);$is_approval_details1=clean($_POST["is_approval_details1"]);$is_approval_details2=clean($_POST["is_approval_details2"]);
	$name_of_insecticide=clean($_POST["name_of_insecticide"]);$name_of_res_technical=clean($_POST["name_of_res_technical"]);$is_qty=clean($_POST["is_qty"]);$is_qty_details=clean($_POST["is_qty_details"]);
	$is_qty_details1=clean($_POST["is_qty_details1"]);$office_id=clean($_POST["office_id"]);
	
	$input_size=clean($_POST["hiddenval"]);

	if($is_approval_details1!="") $is_approval_details1=date("Y-m-d",strtotime($is_approval_details1)); 
	else $is_approval_details1=NULL;
	if(!empty($_POST["details"])) $details=json_encode($_POST["details"]); 
	else $details=NULL;
		
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
    $officer_id_query = $formFunctions->executeQuery($dept,"select user_id from users where office_id='$office_id' and utype='2' and status='1'");
	if($officer_id_query->num_rows>0){
		$officer_id = $officer_id_query->fetch_object()->user_id;
	}else{
		echo "<script>
				alert('Please call helpdesk to resolve this problem.');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}		
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$savequery=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,office_id,officer_id,is_application,name_of_training,duration_of_training,training_certificate,registered_address,zonal_address,branch_ofc_address,premises_address,is_approval,is_approval_details,is_approval_details1,is_approval_details2,name_of_insecticide,name_of_res_technical,is_qty,is_qty_details,is_qty_details1,details) values ('$swr_id','$today','$office_id','$officer_id','$is_application','$name_of_training','$duration_of_training','$training_certificate','$registered_address','$zonal_address','$branch_ofc_address','$premises_address','$is_approval','$is_approval_details','$is_approval_details1','$is_approval_details2','$name_of_insecticide','$name_of_res_technical','$is_qty','$is_qty_details','$is_qty_details1','$details')") ;	
        $form_id=$savequery;	
	}else{
		$form_id=$row["form_id"];	
		$savequery=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',office_id='$office_id',officer_id='$officer_id',is_application='$is_application',name_of_training='$name_of_training',duration_of_training='$duration_of_training',training_certificate='$training_certificate',registered_address='$registered_address',zonal_address='$zonal_address',branch_ofc_address='$branch_ofc_address',premises_address='$premises_address',is_approval='$is_approval',is_approval_details='$is_approval_details',is_approval_details1='$is_approval_details1',is_approval_details2='$is_approval_details2',name_of_insecticide='$name_of_insecticide',name_of_res_technical='$name_of_res_technical',is_qty='$is_qty',is_qty_details='$is_qty_details',is_qty_details1='$is_qty_details1',details='$details' where form_id=$form_id") ;
	}
				
	if($savequery){
		$formFunctions->insert_incomplete_forms($dept,$form);
		if($input_size!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["textA".$i];	
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,slno,name,qualification) VALUES ('','$form_id','$i','$valb','$valc')");
			}
		}	
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
if(isset($_POST["save21b"])){
	
	$insecticide_stored_add=clean($_POST["insecticide_stored_add"]);$insecticide_sold_add=clean($_POST["insecticide_sold_add"]);$is_residential_area=clean($_POST["is_residential_area"]);$is_premises=clean($_POST["is_premises"]);$licence_number=clean($_POST["licence_number"]);$date_of_grant=clean($_POST["date_of_grant"]);
	
	$input_size2=clean($_POST["hiddenval2"]);$input_size3=clean($_POST["hiddenval3"]);
	
	$date_of_grant=date("Y-m-d",strtotime($date_of_grant));
	
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();

	if($sql->num_rows<1){   ////////////table is empty//////////////
		$savequery=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,insecticide_stored_add,insecticide_sold_add,is_residential_area,is_premises,licence_number,date_of_grant) values ('$swr_id','$today','$insecticide_stored_add','$insecticide_sold_add','$is_residential_area','$is_premises','$licence_number','$date_of_grant')") ;	
        $form_id=$savequery;	
	}else{
		$form_id=$row["form_id"];	
		$savequery=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',insecticide_stored_add='$insecticide_stored_add',insecticide_sold_add='$insecticide_sold_add',is_residential_area='$is_residential_area',is_premises='$is_premises',licence_number='$licence_number',date_of_grant='$date_of_grant' where form_id=$form_id") ;
	}
				
	if($savequery){
		if($input_size2!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				//$vala=$_POST["txtA".$i];	
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(id,form_id,slno,parti_insecticide,name,registration_no,principal_cert) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}
		if($input_size3!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t3 where form_id='$form_id'");
			for($i=1;$i<$input_size3;$i++){
				//$vala=$_POST["txttA".$i];	
				$valb=$_POST["texttB".$i];
				$valc=$_POST["texttC".$i];
				$part3=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t3(id,form_id,slno,parti_licenses,st_government) VALUES ('','$form_id','$i','$valb','$valc')");
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


if(isset($_POST["save22a"])){
	$fertilizer_type=clean($_POST["fertilizer_type"]);$office_id=clean($_POST["office_id"]);
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
    $officer_id_query = $formFunctions->executeQuery($dept,"select user_id from users where office_id='$office_id' and utype='2' and status='1'");
	if($officer_id_query->num_rows>0){
		$officer_id = $officer_id_query->fetch_object()->user_id;
	}else{
		echo "<script>
				alert('Please call helpdesk to resolve this problem.');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}		
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,office_id,officer_id,fertilizer_type) values ('$swr_id','$today','$office_id','$officer_id','$fertilizer_type')");	
       $form_id=$query;		
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',office_id='$office_id',officer_id='$officer_id',fertilizer_type='$fertilizer_type' where form_id=$form_id");
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		if($fertilizer_type=="G"){
			echo "<script>
			window.location.href = '".$table_name.".php?tab=2';
		</script>";
		
	}else{
		echo "<script>
			window.location.href = '".$table_name.".php?tab=3';
		</script>";
	}			
  }else{
	  echo "<script>
		   alert('Invalid Entry');
		   window.location.href = '".$table_name.".php';
		</script>";
	}				
	  
}	
if(isset($_POST["save22b"])){		
	$name_concern=clean($_POST["name_concern"]);$relevant_detail=clean($_POST["relevant_detail"]);$is_renewal=clean($_POST["is_renewal"]);
	$input_size=clean($_POST["hiddenval"]);
	if(!empty($_POST["sale"]))	 $sale=json_encode($_POST["sale"]);
	else	$sale=NULL;
	if(!empty($_POST["storage"]))	 $storage=json_encode($_POST["storage"]);
	else	$storage=NULL;
	if(!empty($_POST["manufac_importer"]))	 $manufac_importer=json_encode($_POST["manufac_importer"]);
	else	$manufac_importer=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,name_concern,relevant_detail,is_renewal,sale,storage,manufac_importer) values ('$swr_id','$today', '$name_concern','$relevant_detail','$is_renewal','$sale','$storage','$manufac_importer')") ;
			$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',name_concern='$name_concern',relevant_detail='$relevant_detail',is_renewal='$is_renewal',sale='$sale',storage='$storage',manufac_importer='$manufac_importer' where form_id=$form_id") ;
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form);
			if($input_size!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,slno,fertilizer,is_certificate) VALUES ('$form_id','$i','$valb','$valc')");
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
if(isset($_POST["save22c"])){
	$is_micro_nutrient=clean($_POST["is_micro_nutrient"]);$period_validity=clean($_POST["period_validity"]);$is_applicant=clean($_POST["is_applicant"]);$is_corner=clean($_POST["is_corner"]);
	
	if(!empty($_POST["particulars"]))	 $particulars=json_encode($_POST["particulars"]);
	else	$particulars=NULL;
	if(!empty($_POST["applicant"]))	 $applicant=json_encode($_POST["applicant"]);
	else	$applicant=NULL;
	if(!empty($_POST["fertilisers"]))	 $fertilisers=json_encode($_POST["fertilisers"]);
	else	$fertilisers=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'") ;
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		echo "<script>
			alert('Please fill up the first part of the form !!!');
			window.location.href = '".$table_name.".php';
		</script>";
	}else{		
		$form_id=$row["form_id"];
		$sql1=$formFunctions->executeQuery($dept,"select id from ".$table_name."_part1 where form_id='$form_id'") ;
		$row1=$sql1->fetch_array();
		if($sql1->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQuery($dept,"insert into ".$table_name."_part1(form_id,is_applicant,is_corner,is_micro_nutrient,period_validity,particulars,applicant,fertilisers) values('$form_id','$is_applicant','$is_corner','$is_micro_nutrient','$period_validity','$particulars','$applicant','$fertilisers')") ;	
		}else{	
		   $query=$formFunctions->executeQuery($dept,"update ".$table_name."_part1 set is_applicant='$is_applicant',is_corner='$is_corner',is_micro_nutrient='$is_micro_nutrient',period_validity='$period_validity',particulars='$particulars',applicant='$applicant',fertilisers='$fertilisers' where form_id=$form_id") ;
	 }				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form);
			echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=3';
			</script>";
	}							
  }
}


if(isset($_POST["save23"])){
	$name_concern=clean($_POST["name_concern"]);$relevant_detail=clean($_POST["relevant_detail"]);$is_renewal=clean($_POST["is_renewal"]);$office_id=clean($_POST["office_id"]);
	$input_size=clean($_POST["hiddenval"]);
	if(!empty($_POST["sale"]))	 $sale=json_encode($_POST["sale"]);
	else	$sale=NULL;
	if(!empty($_POST["storage"]))	 $storage=json_encode($_POST["storage"]);
	else	$storage=NULL;
	if(!empty($_POST["manufac_importer"]))	 $manufac_importer=json_encode($_POST["manufac_importer"]);
	else	$manufac_importer=NULL;
	$officer_id_query = $formFunctions->executeQuery($dept,"select user_id from users where office_id='$office_id' and utype='2' and status='1'");
	if($officer_id_query->num_rows>0){
		$officer_id = $officer_id_query->fetch_object()->user_id;
	}else{
		echo "<script>
				alert('Please call helpdesk to resolve this problem.');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}		
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,office_id,officer_id,name_concern,relevant_detail,is_renewal,sale,storage,manufac_importer) values ('$swr_id','$today', '$office_id','$officer_id','$name_concern','$relevant_detail','$is_renewal','$sale','$storage','$manufac_importer')") ;
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',office_id='$office_id',officer_id='$officer_id',name_concern='$name_concern',relevant_detail='$relevant_detail',is_renewal='$is_renewal',sale='$sale',storage='$storage',manufac_importer='$manufac_importer' where form_id=$form_id") ;
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form);
		if($input_size!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,slno,fertilizer,is_certificate) VALUES ('','$form_id','$i','$valb','$valc')");
			}
		}		
		echo "<script>
			alert('Successfully Saved !!');
			window.location.href = '".$table_name.".php?tab=2';
		</script>";	
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php';
		</script>";
	}			
}			
if(isset($_POST["submit23"])){
	echo "<script>
		alert('Successfully Saved !!');
		window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
	</script>";		
}

if(isset($_POST["save24"])){
	$name_concern=clean($_POST["name_concern"]);$relevant_detail=clean($_POST["relevant_detail"]);$is_renewal=clean($_POST["is_renewal"]);$office_id=clean($_POST["office_id"]);
	$input_size=clean($_POST["hiddenval"]);
	if(!empty($_POST["sale"]))	 $sale=json_encode($_POST["sale"]);
	else	$sale=NULL;
	if(!empty($_POST["storage"]))	 $storage=json_encode($_POST["storage"]);
	else	$storage=NULL;
	if(!empty($_POST["manufac_importer"]))	 $manufac_importer=json_encode($_POST["manufac_importer"]);
	else	$manufac_importer=NULL;
	$officer_id_query = $formFunctions->executeQuery($dept,"select user_id from users where office_id='$office_id' and utype='2' and status='1'");
	if($officer_id_query->num_rows>0){
		$officer_id = $officer_id_query->fetch_object()->user_id;
	}else{
		echo "<script>
				alert('Please call helpdesk to resolve this problem.');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}		
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,office_id,officer_id,name_concern,relevant_detail,is_renewal,sale,storage,manufac_importer) values ('$swr_id','$today', '$office_id','$officer_id','$name_concern','$relevant_detail','$is_renewal','$sale','$storage','$manufac_importer')") ;
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',office_id='$office_id',officer_id='$officer_id',name_concern='$name_concern',relevant_detail='$relevant_detail',is_renewal='$is_renewal',sale='$sale',storage='$storage',manufac_importer='$manufac_importer' where form_id=$form_id") ;
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form);
		if($input_size!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,slno,fertilizer,is_certificate) VALUES ('','$form_id','$i','$valb','$valc')");
			}
		}		
		echo "<script>
			alert('Successfully Saved !!');
			window.location.href = '".$table_name.".php?tab=2';
		</script>";	
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php';
		</script>";
	}			
}			
if(isset($_POST["submit24"])){
	echo "<script>
		alert('Successfully Saved !!');
		window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
	</script>";		
}

if(isset($_POST["save25a"])){
	$fertilizer_type=clean($_POST["fertilizer_type"]);$office_id=clean($_POST["office_id"]);
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
    $officer_id_query = $formFunctions->executeQuery($dept,"select user_id from users where office_id='$office_id' and utype='2' and status='1'");
	if($officer_id_query->num_rows>0){
		$officer_id = $officer_id_query->fetch_object()->user_id;
	}else{
		echo "<script>
				alert('Please call helpdesk to resolve this problem.');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}		
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,office_id,officer_id,fertilizer_type) values ('$swr_id','$today','$office_id','$officer_id','$fertilizer_type')");	
        $form_id=$query;		
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',office_id='$office_id',officer_id='$officer_id',fertilizer_type='$fertilizer_type' where form_id=$form_id");
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		if($fertilizer_type=="G"){
			echo "<script>
			window.location.href = '".$table_name.".php?tab=2';
		</script>";
		
	}else{
		echo "<script>
			window.location.href = '".$table_name.".php?tab=3';
		</script>";
	}			
  }else{
	  echo "<script>
		   alert('Invalid Entry');
		   window.location.href = '".$table_name.".php';
		</script>";
	}				
	  
}	
if(isset($_POST["save25b"])){		
	$name_concern=clean($_POST["name_concern"]);$relevant_detail=clean($_POST["relevant_detail"]);$is_renewal=clean($_POST["is_renewal"]);
	$input_size=clean($_POST["hiddenval"]);
	if(!empty($_POST["sale"]))	 $sale=json_encode($_POST["sale"]);
	else	$sale=NULL;
	if(!empty($_POST["storage"]))	 $storage=json_encode($_POST["storage"]);
	else	$storage=NULL;
	if(!empty($_POST["manufac_importer"]))	 $manufac_importer=json_encode($_POST["manufac_importer"]);
	else	$manufac_importer=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,name_concern,relevant_detail,is_renewal,sale,storage,manufac_importer) values ('$swr_id','$today', '$name_concern','$relevant_detail','$is_renewal','$sale','$storage','$manufac_importer')") ;
			$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',name_concern='$name_concern',relevant_detail='$relevant_detail',is_renewal='$is_renewal',sale='$sale',storage='$storage',manufac_importer='$manufac_importer' where form_id=$form_id") ;
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form);
			if($input_size!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,slno,fertilizer,is_certificate) VALUES ('','$form_id','$i','$valb','$valc')");
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
if(isset($_POST["save25c"])){
	
	$is_micro_nutrient=clean($_POST["is_micro_nutrient"]);$period_validity=clean($_POST["period_validity"]);$is_applicant=clean($_POST["is_applicant"]);$is_corner=clean($_POST["is_corner"]);
	
	if(!empty($_POST["particulars"]))	 $particulars=json_encode($_POST["particulars"]);
	else	$particulars=NULL;
	if(!empty($_POST["applicant"]))	 $applicant=json_encode($_POST["applicant"]);
	else	$applicant=NULL;
	if(!empty($_POST["fertilisers"]))	 $fertilisers=json_encode($_POST["fertilisers"]);
	else	$fertilisers=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'") ;
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		echo "<script>
			alert('Please fill up the first part of the form !!!');
			window.location.href = '".$table_name.".php';
		</script>";
	}else{		
		$form_id=$row["form_id"];
		$sql1=$formFunctions->executeQuery($dept,"select id from ".$table_name."_part1 where form_id='$form_id'") ;
		$row1=$sql1->fetch_array();
		if($sql1->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQuery($dept,"insert into ".$table_name."_part1(form_id,is_applicant,is_corner,is_micro_nutrient,period_validity,particulars,applicant,fertilisers) values('$form_id','$is_applicant','$is_corner','$is_micro_nutrient','$period_validity','$particulars','$applicant','$fertilisers')") ;	
		}else{	
		   $query=$formFunctions->executeQuery($dept,"update ".$table_name."_part1 set is_applicant='$is_applicant',is_corner='$is_corner',is_micro_nutrient='$is_micro_nutrient',period_validity='$period_validity',particulars='$particulars',applicant='$applicant',fertilisers='$fertilisers' where form_id=$form_id") ;
	 }				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form);
			echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=3';
			</script>";
	}							
  }
}

if(isset($_POST["save26"])){
	$name_concern=clean($_POST["name_concern"]);$relevant_detail=clean($_POST["relevant_detail"]);$is_renewal=clean($_POST["is_renewal"]);$office_id=clean($_POST["office_id"]);
	$input_size=clean($_POST["hiddenval"]);
	if(!empty($_POST["sale"]))	 $sale=json_encode($_POST["sale"]);
	else	$sale=NULL;
	if(!empty($_POST["storage"]))	 $storage=json_encode($_POST["storage"]);
	else	$storage=NULL;
	if(!empty($_POST["manufac_importer"]))	 $manufac_importer=json_encode($_POST["manufac_importer"]);
	else	$manufac_importer=NULL;
	$officer_id_query = $formFunctions->executeQuery($dept,"select user_id from users where office_id='$office_id' and utype='2' and status='1'");
	if($officer_id_query->num_rows>0){
		$officer_id = $officer_id_query->fetch_object()->user_id;
	}else{
		echo "<script>
				alert('Please call helpdesk to resolve this problem.');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}		
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,office_id,officer_id,name_concern,relevant_detail,is_renewal,sale,storage,manufac_importer) values ('$swr_id','$today', '$office_id','$officer_id','$name_concern','$relevant_detail','$is_renewal','$sale','$storage','$manufac_importer')") ;
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',office_id='$office_id',officer_id='$officer_id',name_concern='$name_concern',relevant_detail='$relevant_detail',is_renewal='$is_renewal',sale='$sale',storage='$storage',manufac_importer='$manufac_importer' where form_id=$form_id") ;
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form);
		if($input_size!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,slno,fertilizer,is_certificate) VALUES ('','$form_id','$i','$valb','$valc')");
			}
		}		
		echo "<script>
			alert('Successfully Saved !!');
			window.location.href = '".$table_name.".php?tab=2';
		</script>";	
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php';
		</script>";
	}			
}			
if(isset($_POST["submit26"])){
	echo "<script>
		alert('Successfully Saved !!');
		window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
	</script>";		
}

if(isset($_POST["save27"])){
	$name_concern=clean($_POST["name_concern"]);$relevant_detail=clean($_POST["relevant_detail"]);$is_renewal=clean($_POST["is_renewal"]);$office_id=clean($_POST["office_id"]);
	$input_size=clean($_POST["hiddenval"]);
	if(!empty($_POST["sale"]))	 $sale=json_encode($_POST["sale"]);
	else	$sale=NULL;
	if(!empty($_POST["storage"]))	 $storage=json_encode($_POST["storage"]);
	else	$storage=NULL;
	if(!empty($_POST["manufac_importer"]))	 $manufac_importer=json_encode($_POST["manufac_importer"]);
	else	$manufac_importer=NULL;
	$officer_id_query = $formFunctions->executeQuery($dept,"select user_id from users where office_id='$office_id' and utype='2' and status='1'");
	if($officer_id_query->num_rows>0){
		$officer_id = $officer_id_query->fetch_object()->user_id;
	}else{
		echo "<script>
				alert('Please call helpdesk to resolve this problem.');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}		
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,office_id,officer_id,name_concern,relevant_detail,is_renewal,sale,storage,manufac_importer) values ('$swr_id','$today', '$office_id','$officer_id','$name_concern','$relevant_detail','$is_renewal','$sale','$storage','$manufac_importer')") ;
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',office_id='$office_id',officer_id='$officer_id',name_concern='$name_concern',relevant_detail='$relevant_detail',is_renewal='$is_renewal',sale='$sale',storage='$storage',manufac_importer='$manufac_importer' where form_id=$form_id") ;
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form);
		if($input_size!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,slno,fertilizer,is_certificate) VALUES ('','$form_id','$i','$valb','$valc')");
			}
		}		
		echo "<script>
			alert('Successfully Saved !!');
			window.location.href = '".$table_name.".php?tab=2';
		</script>";	
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php';
		</script>";
	}			
}			
if(isset($_POST["submit27"])){
	echo "<script>
		alert('Successfully Saved !!');
		window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
	</script>";		
}

if(isset($_POST["save28"])){
	
	$office_id=clean($_POST["office_id"]);
	$input_size=$_POST["hiddenval"];
	$officer_id_query = $formFunctions->executeQuery($dept,"select user_id from users where office_id='$office_id' and utype='2' and status='1'");
	if($officer_id_query->num_rows>0){
		$officer_id = $officer_id_query->fetch_object()->user_id;
	}else{
		echo "<script>
				alert('Please call helpdesk to resolve this problem.');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}		
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,office_id,officer_id) values ('$swr_id','$today','$office_id','$officer_id')") ;
			$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',office_id='$office_id',officer_id='$officer_id' where form_id=$form_id") ;
	}
	
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
			if($input_size!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,slno,name_insecticides,reg_number,reg_date) VALUES ('','$form_id','$i','$valb','$valc','$vald')");
				}
			}
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php';
			</script>";
	}			
}

if(isset($_POST["save29"])){
	
	$adhar_no=clean($_POST["adhar_no"]);$office_id=clean($_POST["office_id"]);
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	$officer_id_query = $formFunctions->executeQuery($dept,"select user_id from users where office_id='$office_id' and utype='2' and status='1'");
	if($officer_id_query->num_rows>0){
		$officer_id = $officer_id_query->fetch_object()->user_id;
	}else{
		echo "<script>
				alert('Please call helpdesk to resolve this problem.');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}				
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,office_id,officer_id,adhar_no) values ('$swr_id','$today','$office_id','$officer_id','$adhar_no')") ;
			$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',office_id='$office_id',officer_id='$officer_id',adhar_no='$adhar_no' where form_id=$form_id") ;
	}
	
	if($query){
		
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php';
			</script>";
	}			
}

if(isset($_POST["save30"])){
	
	$is_change=clean($_POST["is_change"]);$license_no=clean($_POST["license_no"]);$license_dt=clean($_POST["license_dt"]);$office_id=clean($_POST["office_id"]);
	
	if(!empty($_POST["godown"]))	 $godown=json_encode($_POST["godown"]);
	else	$godown=NULL;
	if(!empty($_POST["address_change"]))	 $address_change=json_encode($_POST["address_change"]);
	else	$address_change=NULL;
	if(!empty($_POST["office"]))	 $office=json_encode($_POST["office"]);
	else	$office=NULL;
	if(!empty($_POST["godown_change"]))	 $godown_change=json_encode($_POST["godown_change"]);
	else	$godown_change=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	$officer_id_query = $formFunctions->executeQuery($dept,"select user_id from users where office_id='$office_id' and utype='2' and status='1'");
	if($officer_id_query->num_rows>0){
		$officer_id = $officer_id_query->fetch_object()->user_id;
	}else{
		echo "<script>
				alert('Please call helpdesk to resolve this problem.');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}				
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,office_id,officer_id,godown,license_no,license_dt,address_change,office,godown_change,is_change) values ('$swr_id','$today','$office_id','$officer_id','$godown','$license_no','$license_dt','$address_change','$office','$godown_change','$is_change')") ;
			$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',office_id='$office_id',officer_id='$officer_id',godown='$godown',license_no='$license_no',license_dt='$license_dt',address_change='$address_change',office='$office',godown_change='$godown_change',is_change='$is_change' where form_id=$form_id") ;
	}
	
	if($query){
		
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php';
			</script>";
	}			
}
if(isset($_POST["save31a"])){
	
	if(!empty($_POST["godown_add"]))	 $godown_add=json_encode($_POST["godown_add"]);
	else	$godown_add=NULL;
	
	$licence_number=clean($_POST["licence_number"]);$date_of_fertilizer=clean($_POST["date_of_fertilizer"]);$office_id=clean($_POST["office_id"]);
	
	if(!empty($_POST["address_change"]))	 $address_change=json_encode($_POST["address_change"]);
	else	$address_change=NULL;
	
	$existing_office_add=clean($_POST["existing_office_add"]);$new_office_add=clean($_POST["new_office_add"]);
	
	$date_of_fertilizer=date("Y-m-d",strtotime($date_of_fertilizer));
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
		
    $officer_id_query = $formFunctions->executeQuery($dept,"select user_id from users where office_id='$office_id' and utype='2' and status='1'");
	if($officer_id_query->num_rows>0){
		$officer_id = $officer_id_query->fetch_object()->user_id;
	}else{
		echo "<script>
				alert('Please call helpdesk to resolve this problem.');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,office_id,officer_id,godown_add,licence_number,date_of_fertilizer,address_change,existing_office_add,new_office_add) values ('$swr_id','$today','$office_id','$officer_id','$godown_add','$licence_number','$date_of_fertilizer','$address_change','$existing_office_add','$new_office_add')") ;
			$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',office_id='$office_id',officer_id='$officer_id',godown_add='$godown_add',licence_number='$licence_number',date_of_fertilizer='$date_of_fertilizer',address_change='$address_change',existing_office_add='$existing_office_add',new_office_add='$new_office_add' where form_id=$form_id") ;
	}
	
	if($query){
		
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
if(isset($_POST["save31b"])){
	
	$existing_godown_add=clean($_POST["existing_godown_add"]);$new_godown_add=clean($_POST["new_godown_add"]);
	
	if(!empty($_POST["fertilizer_amendment"]))	 $fertilizer_amendment=json_encode($_POST["fertilizer_amendment"]);
	else	$fertilizer_amendment=NULL;
	
	$existing_other_categories=clean($_POST["existing_other_categories"]);$new_other_categories=clean($_POST["new_other_categories"]);$is_affidavit=clean($_POST["is_affidavit"]);
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,existing_godown_add,new_godown_add,fertilizer_amendment,existing_other_categories,new_other_categories,is_affidavit) values ('$swr_id','$today','$existing_godown_add','$new_godown_add','$fertilizer_amendment','$existing_other_categories','$new_other_categories','$is_affidavit')") ;
			$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',existing_godown_add='$existing_godown_add',new_godown_add='$new_godown_add',fertilizer_amendment='$fertilizer_amendment',existing_other_categories='$existing_other_categories',new_other_categories='$new_other_categories',is_affidavit='$is_affidavit' where form_id=$form_id") ;
	}
	
	if($query){
		
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
if(isset($_POST["save32a"])){
	
	if(!empty($_POST["godown_add"]))	 $godown_add=json_encode($_POST["godown_add"]);
	else	$godown_add=NULL;
	
	$licence_number=clean($_POST["licence_number"]);$date_of_fertilizer=clean($_POST["date_of_fertilizer"]);$office_id=clean($_POST["office_id"]);
	
	if(!empty($_POST["address_change"]))	 $address_change=json_encode($_POST["address_change"]);
	else	$address_change=NULL;
	
	
	$date_of_fertilizer=date("Y-m-d",strtotime($date_of_fertilizer));
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	$officer_id_query = $formFunctions->executeQuery($dept,"select user_id from users where office_id='$office_id' and utype='2' and status='1'");
	if($officer_id_query->num_rows>0){
		$officer_id = $officer_id_query->fetch_object()->user_id;
	}else{
		echo "<script>
				alert('Please call helpdesk to resolve this problem.');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}				
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,office_id,officer_id,godown_add,licence_number,date_of_fertilizer,address_change) values ('$swr_id','$today','$office_id','$officer_id','$godown_add','$licence_number','$date_of_fertilizer','$address_change')") ;
			$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',office_id='$office_id',officer_id='$officer_id',godown_add='$godown_add',licence_number='$licence_number',date_of_fertilizer='$date_of_fertilizer',address_change='$address_change' where form_id=$form_id") ;
	}
	
	if($query){
		
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
if(isset($_POST["save32b"])){
	
	$existing_office_add=clean($_POST["existing_office_add"]);$new_office_add=clean($_POST["new_office_add"]);
	$existing_godown_add=clean($_POST["existing_godown_add"]);$new_godown_add=clean($_POST["new_godown_add"]);
	
	$is_affidavit=clean($_POST["is_affidavit"]);
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,existing_office_add,new_office_add,existing_godown_add,new_godown_add,is_affidavit) values ('$swr_id','$today','$existing_office_add','$new_office_add','$existing_godown_add','$new_godown_add','$is_affidavit')") ;
			$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',existing_office_add='$existing_office_add',new_office_add='$new_office_add',existing_godown_add='$existing_godown_add',new_godown_add='$new_godown_add',is_affidavit='$is_affidavit' where form_id=$form_id") ;
	}
	
	if($query){
		
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
?>