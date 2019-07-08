<?php
if(isset($_POST["save1a"])){		
	$owner_name=clean($_POST["owner_name"]);$consultant_name=clean($_POST["consultant_name"]);$floor_details=clean($_POST["floor_details"]);$no_of_block=clean($_POST["no_of_block"]);$no_of_floor=clean($_POST["no_of_floor"]);$building_height=clean($_POST["building_height"]);$site_area=clean($_POST["site_area"]);$total_area=clean($_POST["total_area"]);
		
		
	if(!empty($_POST["owner_address"]))	 $owner_address=json_encode($_POST["owner_address"]);
	else	$owner_address=NULL;
	
	if(!empty($_POST["consultant_address"]))	 $consultant_address=json_encode($_POST["consultant_address"]);
	else	$consultant_address=NULL;

	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){  ////////////table is empty//////////////			
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,owner_name,consultant_name,owner_address,consultant_address,no_of_block,no_of_floor,floor_details,building_height,site_area,total_area) values ('$swr_id','$today','$owner_name', '$consultant_name', '$owner_address','$consultant_address','$no_of_block', '$no_of_floor','$floor_details', '$building_height', '$site_area','$total_area')");			
	}else{  ////////////table is not empty//////////////
			$form_id=$row["form_id"];	
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',owner_name='$owner_name',consultant_name='$consultant_name', owner_address='$owner_address',consultant_address='$consultant_address', no_of_block='$no_of_block',no_of_floor='$no_of_floor',floor_details='$floor_details', building_height='$building_height', site_area='$site_area', total_area='$total_area' where form_id='$form_id'");	
	}		
	if($query){
			$formFunctions->insert_incomplete_forms($dept,$form); 
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
	$premise_access=clean($_POST["premise_access"]);$road_width=clean($_POST["road_width"]);$no_of_entrance=clean($_POST["no_of_entrance"]);$height_clearance=clean($_POST["height_clearance"]);$projection_height=clean($_POST["projection_height"]);$parking_argmnt=clean($_POST["parking_argmnt"]);$is_provided=clean($_POST["is_provided"]);
	if(isset($_POST["is_provided_details"])) $is_provided_details=clean($_POST["is_provided_details"]);
	else $is_provided_details= NULL;
	
	if(!empty($_POST["surround_prop"])) $surround_prop=json_encode($_POST["surround_prop"]);
	else	$surround_prop=NULL;	
	if(!empty($_POST["os_width"]))	$os_width=json_encode($_POST["os_width"]);
	else	$os_width=NULL;
	if(!empty($_POST["no_of"])) $no_of=json_encode($_POST["no_of"]);
	else $no_of=NULL;
				
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){		
		echo "<script>
			alert('Please fill up the first part first !!!');
			window.location.href = '".$table_name.".php';
		</script>";			
	}else{  
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', premise_access='$premise_access', surround_prop='$surround_prop', road_width='$road_width',no_of_entrance='$no_of_entrance', height_clearance='$height_clearance', os_width='$os_width',projection_height='$projection_height', parking_argmnt='$parking_argmnt', is_provided='$is_provided', is_provided_details='$is_provided_details',no_of='$no_of' where form_id='$form_id'");				
	}	
	if($query){
		echo "<script>
			alert('Successfully Saved.');
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
	$handrail_height=clean($_POST["handrail_height"]);$sprinkler_system=clean($_POST["sprinkler_system"]);$portable_exting=clean($_POST["portable_exting"]);$public_address=clean($_POST["public_address"]);$nearest_station=clean($_POST["nearest_station"]);$other_info=clean($_POST["other_info"]);
	
		
	
			
	if(!empty($_POST["part"]))	 $part=json_encode($_POST["part"]);
	else	$part=NULL;
	
	if(!empty($_POST["type"]))	 $type=json_encode($_POST["type"]);
	else	$type=NULL;	
	
	/* echo "<pre>";
	print_r($type);die(); */
	
   $officer_id = $formFunctions->executeQuery($dept,"select user_id from users where fire_station='$nearest_station'")->fetch_object();	
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
		
	if($sql->num_rows<1){				
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php';
			</script>";				
	}else{
			$form_id=$row["form_id"];
			$query = "update ".$table_name." set sub_date='$today',officer_id='$officer_id',handrail_height='$handrail_height', part='$part',type='$type',sprinkler_system='$sprinkler_system', portable_exting='$portable_exting', public_address='$public_address',nearest_station='$nearest_station', other_info='$other_info' where form_id='$form_id'";
			
			$query=$formFunctions->executeQuery($dept,$query);
	}			
	if($query){
	
		echo "<script>
			alert('Successfully Saved.');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";				
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=3';
		</script>";
	}						
}

if(isset($_POST['save2a'])){
		$clr_details=clean($_POST['clr_details']);$t_s_area=clean($_POST['t_s_area']);$p_o_name=clean($_POST['p_o_name']);$p_o_addr=json_encode($_POST['p_o_addr']);$stored=json_encode($_POST['stored']);
		
		
		$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	    $row=$sql->fetch_array();
		
	if($sql->num_rows<1){  ////////////table is empty//////////////
			
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,p_o_name,p_o_addr,stored,clr_details,t_s_area) values ('$swr_id','$today','$p_o_name', '$p_o_addr','$stored','$clr_details','$t_s_area')");		
			
	}else{  ////////////table is not empty//////////////
			$form_id=$row["form_id"];	
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',p_o_name='$p_o_name',  p_o_addr='$p_o_addr',stored='$stored',clr_details='$clr_details', t_s_area='$t_s_area' where form_id='$form_id'");	
	}			
		
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
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

if(isset($_POST['save2b'])){
	$other_info=clean($_POST['other_info']);$license_no=clean($_POST['license_no']);$nearest_station=clean($_POST['nearest_station']);$segregate=clean($_POST['segregate']);$premise_access=clean($_POST['premise_access']);$surround_prop=json_encode($_POST['surround_prop']);$space_storage=json_encode($_POST['space_storage']);$details=json_encode($_POST['details']);

	$officer_id = $formFunctions->executeQuery($dept,"select user_id from users where fire_station='$nearest_station'")->fetch_object();
	
		$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
		$row=$sql->fetch_array();
		
	if($sql->num_rows<1){   
			
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php';
			</script>";
			
	}else{  
			$form_id=$row["form_id"];	
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',officer_id='$officer_id', other_info='$other_info',license_no='$license_no', nearest_station='$nearest_station',segregate='$segregate', premise_access='$premise_access', surround_prop='$surround_prop',space_storage='$space_storage', details='$details' where form_id='$form_id'");				
	}	
	if($query){
			echo "<script>
				alert('Successfully Saved..');
				window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
			</script>";
			
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}						
}

if(isset($_POST['save3a'])){
		
	$owner_name=$_POST["owner_name"];$license_no=$_POST["license_no"];$lic_date=$_POST["lic_date"];
	
	 if(!empty($_POST["owner_address"]))	 $owner_address=json_encode($_POST["owner_address"]);
	 else	$owner_address=NULL;
	
	
	
	    $sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	    $row=$sql->fetch_array();
		
		if($sql->num_rows<1){  ////////////table is empty//////////////
			
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,owner_name,owner_address,license_no,lic_date) values ('$swr_id','$today','$owner_name','$owner_address','$license_no','$lic_date')");		
			
		}else{  ////////////table is not empty//////////////
				$form_id=$row["form_id"];	
				$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',owner_name='$owner_name',owner_address='$owner_address',license_no='$license_no', lic_date='$lic_date' where form_id='$form_id'");	
		}			
		
	if($query){
		    $formFunctions->insert_incomplete_forms($dept,$form); 
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
	
if(isset($_POST['save3b'])){
  $site_area=clean($_POST['site_area']);$total_area=clean($_POST['total_area']);$premise_access=clean($_POST['premise_access']);$no_of_floor=clean($_POST['no_of_floor']);$floor_details=clean($_POST['floor_details']);$access_premises=clean($_POST['access_premises']);$width_entry=clean($_POST['width_entry']);$no_of_entrance=clean($_POST['no_of_entrance']);$parking=clean($_POST['parking']);$nearest_station=clean($_POST['nearest_station']);$fire_std=clean($_POST['fire_std']);$fire_land=clean($_POST['fire_land']);$system_details=clean($_POST['system_details']);$water_details=clean($_POST['water_details']);$personnel_details=clean($_POST['personnel_details']);$license_authority=clean($_POST['license_authority']);$other_info=clean($_POST['other_info']);
   

	if(!empty($_POST["surround_prop"]))	 $surround_prop=json_encode($_POST["surround_prop"]);
	 else	$surround_prop=NULL;
	 
	if(!empty($_POST["os_width"]))	 $os_width=json_encode($_POST["os_width"]);
	 else	$os_width=NULL;
   
    if($parking=="Y") $two_wheeler=clean($_POST["two_wheeler"]);
		else $two_wheeler="";
	if($parking=="Y") $four_wheeler=clean($_POST["four_wheeler"]);
		else $four_wheeler="";
	
    $officer_id = $formFunctions->executeQuery($dept,"select user_id from users where fire_station='$nearest_station'")->fetch_object();
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
		if($sql->num_rows<1){   
				
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = '".$table_name.".php';
				</script>";
				
		}else{  
				$form_id=$row["form_id"];	
				$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',officer_id='$officer_id', other_info='$other_info',premise_access='$premise_access', surround_prop='$surround_prop',os_width='$os_width', site_area='$site_area', total_area='$total_area', no_of_floor='$no_of_floor', floor_details='$floor_details', access_premises='$access_premises', width_entry='$width_entry', no_of_entrance='$no_of_entrance', parking='$parking', nearest_station='$nearest_station', fire_std='$fire_std', fire_land='$fire_land', system_details='$system_details', water_details='$water_details', personnel_details='$personnel_details' , license_authority='$license_authority',two_wheeler='$two_wheeler', four_wheeler='$four_wheeler' where form_id='$form_id'");				
		}	
		if($query){
				echo "<script>
					alert('Successfully Saved..');
					window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
				</script>";
				
		}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = '".$table_name.".php?tab=2';
				</script>";
		}						
}


if(isset($_POST['save4a'])){
		$p_o_name=clean($_POST['p_o_name']);$p_o_addr=json_encode($_POST['p_o_addr']);$lc_no=clean($_POST['lc_no']);
		$lc_date=clean($_POST['lc_date']);

		
		//$officer_id = $formFunctions->executeQuery($dept,"select user_id from users where fire_station='$nearest_station'")->fetch_object();
		$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	    $row=$sql->fetch_array();
		if($sql->num_rows<1){  ////////////table is empty//////////////
			
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,p_o_name,p_o_addr,lc_no,lc_date) values ('$swr_id','$today', '$p_o_name', '$p_o_addr', '$lc_no','$lc_date')");		
			
	}else{  ////////////table is not empty//////////////
			$form_id=$row["form_id"];	
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', p_o_name='$p_o_name',  p_o_addr='$p_o_addr',lc_no='$lc_no', lc_date='$lc_date' where form_id='$form_id'");	
	}			
		
	if($query){
		    $formFunctions->insert_incomplete_forms($dept,$form); 
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
		
if(isset($_POST['save4b'])){
	$t_s_area=clean($_POST['t_s_area']);$t_b_area=clean($_POST['t_b_area']);$p_accessibility=clean($_POST['p_accessibility']);
		
		$s_properties=json_encode($_POST['s_properties']);
		
		$n_o_floors=clean($_POST['n_o_floors']);$occupancy=clean($_POST['occupancy']);
		
		$o_s_a_storage=json_encode($_POST['o_s_a_storage']);
		
		$access=clean($_POST['access']);$w_premises=$_POST['w_premises'];
		$w_building=$_POST['w_building'];$emergency=clean($_POST['emergency']);$parking=$_POST['parking'];$nearest_station=clean($_POST['nearest_station']);
		
		$tel_no=json_encode($_POST['tel_no']);
		
		$details_f_f_system=clean($_POST['details_f_f_system']);$details_w_s=clean($_POST['details_w_s']);$details_p_t=clean($_POST['details_p_t']);
		
		$sl_c_details=json_encode($_POST['sl_c_details']);
		
		$other_info=clean($_POST['other_info']);
		
		if($parking=="Y") $two_wheeler=clean($_POST["two_wheeler"]);
			else $two_wheeler="";
		if($parking=="Y") $four_wheeler=clean($_POST["four_wheeler"]);
			else $four_wheeler="";
        $officer_id = $formFunctions->executeQuery($dept,"select user_id from users where fire_station='$nearest_station'")->fetch_object();
		$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
        $row=$sql->fetch_array();
			
		if($sql->num_rows<1){   
				
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = '".$table_name.".php';
				</script>";
				
		}else{  
				$form_id=$row["form_id"];	
		
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set officer_id='$officer_id',t_s_area='$t_s_area',t_b_area='$t_b_area',p_accessibility='$p_accessibility',
		s_properties='$s_properties',n_o_floors='$n_o_floors',occupancy='$occupancy',o_s_a_storage='$o_s_a_storage',access='$access',
		w_premises='$w_premises',w_building='$w_building',emergency='$emergency',parking='$parking',two_wheeler='$two_wheeler',
		four_wheeler='$four_wheeler',nearest_station='$nearest_station',tel_no='$tel_no',details_f_f_system='$details_f_f_system',
		details_w_s='$details_w_s',details_p_t='$details_p_t',sl_c_details='$sl_c_details',other_info='$other_info' where form_id='$form_id'");
		
	}	
	if($query){
				echo "<script>
					alert('Successfully Saved..');
					window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
				</script>";
				
		}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = '".$table_name.".php?tab=2';
				</script>";
		}						
}

if(isset($_POST['save5a'])){
		$owner_name=clean($_POST['owner_name']);
		
		if(!empty($_POST["owner_address"]))	 $owner_address=json_encode($_POST["owner_address"]);
	   else	 $owner_address=NULL;
	
		
		$flag=0;
		if(empty($owner_name)==true || empty($owner_address)==true){
			$flag=1;//validation fault
		}
		
		
		
		$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	    $row=$sql->fetch_array();
		
		if($sql->num_rows<1){  ////////////table is empty//////////////
			
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,owner_name,owner_address) values ('$swr_id','$today', '$owner_name','$owner_address')");		
			
	}else{  ////////////table is not empty//////////////
			$form_id=$row["form_id"];	
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', owner_name='$owner_name', owner_address='$owner_address' where form_id='$form_id'");	
	}			
		
	if($query){
		   $formFunctions->insert_incomplete_forms($dept,$form); 
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
	
if(isset($_POST['save5b'])){
	$site_area=$_POST["site_area"];$total_area=$_POST["total_area"];$premise_access=$_POST["premise_access"];$no_of_floor=$_POST["no_of_floor"];$floor_details=$_POST["floor_details"];$access_premises=$_POST["access_premises"];$width_entry=$_POST["width_entry"];$no_of_entrance=$_POST["no_of_entrance"];$parking=$_POST["parking"];$nearest_station=$_POST["nearest_station"];
	$fire_std=$_POST["fire_std"];$fire_land=$_POST["fire_land"];$system_details=$_POST["system_details"];
	$water_details=$_POST["water_details"];$personnel_details=$_POST["personnel_details"];$license_authority=$_POST["license_authority"];$other_info=$_POST["other_info"];
			
			if($parking=="YES") $two_wheeler=clean($_POST["two_wheeler"]);
				else $two_wheeler="";
			if($parking=="YES") $four_wheeler=clean($_POST["four_wheeler"]);
				else $four_wheeler="";
			
            if(!empty($_POST["surround_prop"])){
				$surround_prop=json_encode($_POST["surround_prop"]);
	        }else{
	        	$surround_prop=NULL;
	        }

			if(!empty($_POST["os_width"])){
			$os_width=json_encode($_POST["os_width"]);
			
			}else{
				$os_width=NULL;
			}

		$officer_id = $formFunctions->executeQuery($dept,"select user_id from users where fire_station='$nearest_station'")->fetch_object();	
			
			
		$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
		$row=$sql->fetch_array();
			
		if($sql->num_rows<1){   
				
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = '".$table_name.".php';
				</script>";
				
		}else{  
		
			$form_id=$row["form_id"];	
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set site_area='$site_area',officer_id='$officer_id',total_area='$total_area',premise_access='$premise_access',no_of_floor='$no_of_floor',floor_details='$floor_details',access_premises='$access_premises',width_entry='$width_entry',no_of_entrance='$no_of_entrance',parking='$parking',nearest_station='$nearest_station',fire_std='$fire_std',fire_land='$fire_land',system_details='$system_details',water_details='$water_details',personnel_details='$personnel_details',license_authority='$license_authority',other_info='$other_info',two_wheeler='$two_wheeler',four_wheeler='$four_wheeler',surround_prop='$surround_prop',os_width='$os_width' where form_id='$form_id'"); 
		
		}	
	
	   if($query){
				echo "<script>
					alert('Successfully Saved..');
					window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
				</script>";
				
		}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = '".$table_name.".php?tab=2';
				</script>";
		}						
}

if(isset($_POST['save6a'])){ 
		$owner_name=clean($_POST['owner_name']);
		
		if(!empty($_POST["owner_address"]))	 $owner_address=json_encode($_POST["owner_address"]);
        else	 $owner_address=NULL;
		
		//die($owner_address);
		
		
		
		$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	    $row=$sql->fetch_array();
		
		if($sql->num_rows<1){  ////////////table is empty//////////////
			
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,owner_name,owner_address) values ('$swr_id','$today', '$owner_name','$owner_address')");		
			
	}else{  ////////////table is not empty//////////////
			$form_id=$row["form_id"];	
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', owner_name='$owner_name',owner_address='$owner_address' where form_id='$form_id'");	
	}		
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
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
	
if(isset($_POST['save6b'])){
      $total_area=clean($_POST["total_area"]);$purpose_erect=$_POST["purpose_erect"];$distance_motor=$_POST["distance_motor"];$width_road=$_POST["width_road"];$parking=$_POST["parking"];$arrange_cook=$_POST["arrange_cook"];$distance_electric=clean($_POST["distance_electric"]);$nearest_station=$_POST["nearest_station"];$fire_std=$_POST["fire_std"];$fire_land=$_POST["fire_land"];$fire_details=$_POST["fire_details"];$water_details=$_POST["water_details"];$personnel_details=$_POST["personnel_details"];$s_no=$_POST["s_no"];$license_authority=$_POST["license_authority"];$license_name=$_POST["license_name"];$license_no=$_POST["license_no"];$other_info=$_POST["other_info"];
        if($parking=="Y") $two_wheeler=clean($_POST["two_wheeler"]);
		    else $two_wheeler="";
		if($parking=="Y") $four_wheeler=clean($_POST["four_wheeler"]);
			else $four_wheeler="";
		if(!empty($_POST["surround_prop"])){
		  $surround_prop=json_encode($_POST["surround_prop"]);
		}else{
			$surround_prop=NULL;
		}
		if(!empty($_POST["os_width"])){
			$os_width=json_encode($_POST["os_width"]);
		}else{
			$os_width=NULL;
		}
		$officer_id = $formFunctions->executeQuery($dept,"select user_id from users where fire_station='$nearest_station'")->fetch_object();
		
		
        $sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
		$row=$sql->fetch_array();
			
		if($sql->num_rows<1){   
				
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = '".$table_name.".php';
				</script>";
				
		}else{  
			$form_id=$row["form_id"];	
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set officer_id='$officer_id',total_area='$total_area',purpose_erect='$purpose_erect',distance_motor='$distance_motor',width_road='$width_road',parking='$parking',two_wheeler='$two_wheeler',four_wheeler='$four_wheeler',arrange_cook='$arrange_cook',distance_electric='$distance_electric',nearest_station='$nearest_station',fire_std='$fire_std',fire_land='$fire_land',fire_details='$fire_details',water_details='$water_details',s_no='$s_no',personnel_details='$personnel_details',license_authority='$license_authority',license_name='$license_name',license_no='$license_no',other_info='$other_info',surround_prop='$surround_prop',os_width='$os_width' where form_id='$form_id'"); 
		
		}	
	
	   if($query){
				echo "<script>
					alert('Successfully Saved..');
					window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
				</script>";
				
		}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = '".$table_name.".php?tab=2';
				</script>";
		}						
}	
  
if(isset($_POST['save7a'])){
	
		$p_o_name=clean($_POST['p_o_name']);
		
		if(!empty($_POST["owner_address"]))	 $owner_address=json_encode($_POST["owner_address"]);
	   else	 $owner_address=NULL;
		
		
		
		
		$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	    $row=$sql->fetch_array();
		
		if($sql->num_rows<1){  ////////////table is empty//////////////
			
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,p_o_name,owner_address) values ('$swr_id','$today', '$p_o_name','$owner_address')");		
			
	}else{  ////////////table is not empty//////////////
			$form_id=$row["form_id"];	
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', p_o_name='$p_o_name',owner_address='$owner_address' where form_id='$form_id'");	
	}	
	if($query){
		     $formFunctions->insert_incomplete_forms($dept,$form); 
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

if(isset($_POST['save7b'])){

	$type_of_storage=clean($_POST['type_of_storage']);$flash_point=clean($_POST['flash_point']);$electrification_details=clean($_POST['electrification_details']);$t_s_area=clean($_POST['t_s_area']);$p_accessibility=clean($_POST['p_accessibility']);$segregate=clean($_POST['segregate']);$nearest_station=clean($_POST['nearest_station']);$details_f_f_system=clean($_POST['details_f_f_system']);
	$details_w_s=clean($_POST['details_w_s']);$details_p_t=clean($_POST['details_p_t']);$sl_c_details=json_encode($_POST['sl_c_details']);$lc_no=clean($_POST['lc_no']);$other_info=clean($_POST['other_info']);$product_clasification=clean($_POST['product_clasification']);
	
    if(!empty($_POST["quantity_stored"]))	 $quantity_stored=json_encode($_POST["quantity_stored"]);
	   else	 $quantity_stored=NULL;
   
    if(!empty($_POST["s_properties"]))	 $s_properties=json_encode($_POST["s_properties"]);
	   else	 $s_properties=NULL;
	   
	if(!empty($_POST["o_s_a_storage"]))	 $o_s_a_storage=json_encode($_POST["o_s_a_storage"]);
	   else	 $o_s_a_storage=NULL;
   
   $officer_id = $formFunctions->executeQuery($dept,"select user_id from users where fire_station='$nearest_station'")->fetch_object();
   
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
		if($sql->num_rows<1){   
				
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = '".$table_name.".php';
				</script>";
				
		}else{  
			$form_id=$row["form_id"];	
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set officer_id='$officer_id',product_clasification='$product_clasification',quantity_stored='$quantity_stored',type_of_storage='$type_of_storage',flash_point='$flash_point',electrification_details='$electrification_details',t_s_area='$t_s_area',p_accessibility='$p_accessibility',s_properties='$s_properties',o_s_a_storage='$o_s_a_storage',segregate='$segregate',nearest_station='$nearest_station',details_f_f_system='$details_f_f_system',details_w_s='$details_w_s',details_p_t='$details_p_t',sl_c_details='$sl_c_details',lc_no='$lc_no',other_info='$other_info' where form_id='$form_id'");
		
		}	
	
	   if($query){
				echo "<script>
					alert('Successfully Saved..');
					window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
				</script>";
				
		}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = '".$table_name.".php?tab=2';
				</script>";
		}						
}
 
if(isset($_POST['save8a'])){
		$owner_name=clean($_POST['owner_name']);$owner_address=json_encode($_POST['owner_address']);
		
		
		
		
		$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	    $row=$sql->fetch_array();
		
		
		
		if($sql->num_rows<1){  ////////////table is empty//////////////
			
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,owner_name,owner_address) values ('$swr_id','$today','$owner_name',  '$owner_address')");		
			
		}else{  ////////////table is not empty//////////////
			$form_id=$row["form_id"];	
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', owner_name='$owner_name', owner_address='$owner_address' where form_id='$form_id'");	
		}				
	if($query){
		  $formFunctions->insert_incomplete_forms($dept,$form); 
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
if(isset($_POST['save8b'])){
	$chemical_stored=$_POST["chemical_stored"];$quantity_stored=$_POST["quantity_stored"];$type_storage=$_POST["type_storage"];$flash_stored=$_POST["flash_stored"];$details_electric=$_POST["details_electric"];$total_area=$_POST["total_area"];$access_premises=$_POST["access_premises"];$provision_segregate=$_POST["provision_segregate"];$size_exit=$_POST["size_exit"];$nearest_station=$_POST["nearest_station"];$fire_details=$_POST["fire_details"];$water_details=$_POST["water_details"];$personnel_details=$_POST["personnel_details"];$s_no=$_POST["s_no"];$license_no=$_POST["license_no"];$other_info=$_POST["other_info"];
	
				if(!empty($_POST["surround_prop"])){
		          $surround_prop=json_encode($_POST["surround_prop"]);
		
		        }else{
		        	$surround_prop=NULL;
		        }

				if(!empty($_POST["os_width"])){
					$os_width=json_encode($_POST["os_width"]);
				}else{
					$os_width=NULL;
				}
 
            $officer_id = $formFunctions->executeQuery($dept,"select user_id from users where fire_station='$nearest_station'")->fetch_object();
			$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
			$row=$sql->fetch_array();	
		    if($sql->num_rows<1){   
				
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = '".$table_name.".php';
				</script>";
				
			}else{  
				$form_id=$row["form_id"];	
				$query=$formFunctions->executeQuery($dept,"update ".$table_name." set officer_id='$officer_id',chemical_stored='$chemical_stored',quantity_stored='$quantity_stored',type_storage='$type_storage',flash_stored='$flash_stored',details_electric='$details_electric',total_area='$total_area',access_premises='$access_premises',provision_segregate='$provision_segregate',size_exit='$size_exit',nearest_station='$nearest_station',fire_details='$fire_details',water_details='$water_details',personnel_details='$personnel_details',s_no='$s_no',license_no='$license_no',other_info='$other_info',surround_prop='$surround_prop',os_width='$os_width' where form_id='$form_id'"); 
		
			}	
	
	   if($query){
				echo "<script>
					alert('Successfully Saved..');
				window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
				</script>";
				
		}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = '".$table_name.".php?tab=2';
				</script>";
		}						
}  
if(isset($_POST['save9a'])){
		$p_o_name=clean($_POST['p_o_name']);
		
		if(!empty($_POST["owner_address"]))	 $owner_address=json_encode($_POST["owner_address"]);
	   else	$owner_address=NULL;
		
		
		$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	    $row=$sql->fetch_array();
		
		if($sql->num_rows<1){  ////////////table is empty//////////////
			
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,p_o_name,owner_address) values ('$swr_id','$today','$p_o_name','$owner_address')");		
			
	}else{  ////////////table is not empty//////////////
			$form_id=$row["form_id"];	
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',p_o_name='$p_o_name', owner_address='$owner_address' where form_id='$form_id'");	
	}			
		
	if($query){
		 $formFunctions->insert_incomplete_forms($dept,$form); 
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
if(isset($_POST['save9b'])){
	$explosive_clasification=clean($_POST['explosive_clasification']);$quantity_stored=clean($_POST['quantity_stored']);$type_of_storage=clean($_POST['type_of_storage']);$room_size=clean($_POST['room_size']);$electrification_details=clean($_POST['electrification_details']);$t_s_area=clean($_POST['t_s_area']);$p_accessibility=clean($_POST['p_accessibility']);$s_properties=json_encode($_POST['s_properties']);$o_s_a_storage=json_encode($_POST['o_s_a_storage']);$segregate=clean($_POST['segregate']);$nearest_station=clean($_POST['nearest_station']);$details_f_f_system=clean($_POST['details_f_f_system']);$details_w_s=clean($_POST['details_w_s']);$details_p_t=clean($_POST['details_p_t']);$sl_c_details=json_encode($_POST['sl_c_details']);$lc_no=clean($_POST['lc_no']);$other_info=clean($_POST['other_info']);
	
	$officer_id = $formFunctions->executeQuery($dept,"select user_id from users where fire_station='$nearest_station'")->fetch_object();	
	
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();	
		    if($sql->num_rows<1){   
				
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = '".$table_name.".php';
				</script>";
				
			}else{  
				$form_id=$row["form_id"];	
				$query=$formFunctions->executeQuery($dept,"update ".$table_name." set officer_id='$officer_id',explosive_clasification='$explosive_clasification',quantity_stored='$quantity_stored',type_of_storage='$type_of_storage',room_size='$room_size',electrification_details='$electrification_details',t_s_area='$t_s_area',p_accessibility='$p_accessibility',s_properties='$s_properties',o_s_a_storage='$o_s_a_storage',segregate='$segregate',nearest_station='$nearest_station',details_f_f_system='$details_f_f_system',details_w_s='$details_w_s',details_p_t='$details_p_t',sl_c_details='$sl_c_details',lc_no='$lc_no',other_info='$other_info' where form_id='$form_id'");
		
			}	
	
	   if($query){
				echo "<script>
					alert('Successfully Saved..');
					window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
				</script>";
				
		}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = '".$table_name.".php?tab=2';
				</script>";
		}						
}
if(isset($_POST['save10a'])){
		$p_o_name=clean($_POST['p_o_name']);
		$p_o_addr=json_encode($_POST['p_o_addr']);
		
		$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	    $row=$sql->fetch_array();
		
		if($sql->num_rows<1){  ////////////table is empty//////////////
			
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,p_o_name,p_o_addr) values ('$swr_id','$today','$p_o_name','$p_o_addr')");		
			
	}else{  ////////////table is not empty//////////////
			$form_id=$row["form_id"];	
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',p_o_name='$p_o_name', p_o_addr='$p_o_addr' where form_id='$form_id'");	
	}			
		
	if($query){
		 $formFunctions->insert_incomplete_forms($dept,$form); 
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
if(isset($_POST['save10b'])){
	$chemicals=clean($_POST['chemicals']);
		if(!empty($_POST['quantity_stored']))
		{
			$quantity_stored=implode(',',$_POST['quantity_stored']);
		}else{
			$quantity_stored="";
		}

	$type_of_storage=isset($_POST['type_of_storage'])?clean($_POST['type_of_storage']):NULL;$flash_point=clean($_POST['flash_point']);$electrification_details=clean($_POST['electrification_details']);$t_s_area=clean($_POST['t_s_area']);$p_accessibility=clean($_POST['p_accessibility']);$s_properties=json_encode($_POST['s_properties']);$o_s_a_storage=json_encode($_POST['o_s_a_storage']);$segregate=clean($_POST['segregate']);$nearest_station=clean($_POST['nearest_station']);$details_f_f_system=clean($_POST['details_f_f_system']);$details_w_s=clean($_POST['details_w_s']);$details_p_t=clean($_POST['details_p_t']);$sl_c_details=json_encode($_POST['sl_c_details']);$lc_no=clean($_POST['lc_no']);$other_info=clean($_POST['other_info']);
	
	$officer_id = $formFunctions->executeQuery($dept,"select user_id from users where fire_station='$nearest_station'")->fetch_object();	
	
	
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();	
		    if($sql->num_rows<1){   
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = '".$table_name.".php';
				</script>";
				
			}else{  
				$form_id=$row["form_id"];	
				$query=$formFunctions->executeQuery($dept,"update ".$table_name." set officer_id='$officer_id',chemicals='$chemicals',quantity_stored='$quantity_stored',type_of_storage='$type_of_storage',flash_point='$flash_point',electrification_details='$electrification_details',t_s_area='$t_s_area',p_accessibility='$p_accessibility',s_properties='$s_properties',o_s_a_storage='$o_s_a_storage',segregate='$segregate',nearest_station='$nearest_station',details_f_f_system='$details_f_f_system',details_w_s='$details_w_s',details_p_t='$details_p_t',sl_c_details='$sl_c_details',lc_no='$lc_no',other_info='$other_info' where user_id='$swr_id'");
			}	
	
		if($query){
				echo "<script>
					alert('Successfully Saved..');
					window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
				</script>";
				
		}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = '".$table_name.".php?tab=2';
				</script>";
		}						
}
if(isset($_POST['save11'])){
	$holding_no=$_POST['holding_no'];$letter_no=clean($_POST['letter_no']);$letter_date=date('Y-m-d',strtotime($_POST['letter_date']));$letter_valid_date=date('Y-m-d',strtotime($_POST['letter_valid_date']));$renewal_year1=clean($_POST['renewal_year1']);$renewal_year2=clean($_POST['renewal_year2']);$nearest_station=clean($_POST['nearest_station']);
	
	$officer_id = $formFunctions->executeQuery($dept,"select user_id from users where fire_station='$nearest_station'")->fetch_object();
	
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
		
		if($sql->num_rows<1){  ////////////table is empty//////////////
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,owner_name,officer_id,holding_no,letter_no,letter_date,letter_valid_date,renewal_year1,nearest_station) values ('$swr_id','$today','$owner_name','$officer_id','$holding_no','$letter_no','$letter_date','$letter_valid_date','$renewal_year1','$nearest_station')");		
			
		}else{  ////////////table is not empty//////////////
			$form_id=$row["form_id"];	
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',officer_id='$officer_id',holding_no='$holding_no', letter_no='$letter_no', letter_date='$letter_date', letter_valid_date='$letter_valid_date', renewal_year1='$renewal_year1', renewal_year2='$renewal_year2',nearest_station='$nearest_station' where form_id='$form_id'");	
		}			
		
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
			echo "<script>
				alert('Successfully Saved..');
				window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
			</script>";
			
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=1';
			</script>";
	}						
}
if(isset($_POST['save12a'])){
	$caller_no=$_POST["caller_no"];$caller_name=$_POST["caller_name"];$occured_date=$_POST["occured_date"];$ocured_time=$_POST["ocured_time"];
	$nearest_station=$_POST["nearest_station"];$distance_fire=$_POST["distance_fire"];
		
			if(!empty($_POST["owner_address"])){
				$owner_address=json_encode($_POST["owner_address"]);
			}else{
				$owner_address=NULL;
			}
		
			if(!empty($_POST["place_occurrence"])){
				$place_occurrence=json_encode($_POST["place_occurrence"]);
			}else{
				$place_occurrence=NULL;
			}
			
		$officer_id = $formFunctions->executeQuery($dept,"select user_id from users where fire_station='$nearest_station'")->fetch_object();		
		
		$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	    $row=$sql->fetch_array();
		
		if($sql->num_rows<1){  ////////////table is empty//////////////
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,officer_id,caller_no,caller_name,occured_date,ocured_time,nearest_station,distance_fire,owner_address,place_occurrence) values ('$swr_id','$today','$officer_id','$caller_no','$caller_name','$occured_date','$ocured_time','$nearest_station','$distance_fire','$owner_address','$place_occurrence')");		
			
		}else{  ////////////table is not empty//////////////
			$form_id=$row["form_id"];	
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',officer_id='$officer_id',caller_no='$caller_no',caller_name='$caller_name',occured_date='$occured_date',ocured_time='$ocured_time',nearest_station='$nearest_station',owner_address='$owner_address',place_occurrence='$place_occurrence',distance_fire='$distance_fire' where form_id='$form_id'"); 
		}			
		
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
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
	
if(isset($_POST['save12b'])){
    $descript_property=$_POST["descript_property"];$description=$_POST["description"];$property_insured=$_POST["property_insured"];$holding_no=$_POST["holding_no"];$insurance=$_POST["insurance"];$noc=$_POST["noc"];$property_uninsured=$_POST["property_uninsured"];$human_life=$_POST["human_life"];
				
			if(!empty($_POST["occupant_address"])){
				$occupant_address=json_encode($_POST["occupant_address"]);}else{
				$occupant_address=NULL;
			}
			
			if(!empty($_POST["fire_desc"])){
			  $fire_desc=json_encode($_POST["fire_desc"]);
			}else{
				$fire_desc=NULL;
			}

		    $sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
			$row=$sql->fetch_array();	
		    if($sql->num_rows<1){   
				
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = '".$table_name.".php';
				</script>";
				
			}else{  
				$form_id=$row["form_id"];	
				$query=$formFunctions->executeQuery($dept,"update ".$table_name." set description='$description',descript_property='$descript_property',property_insured='$property_insured',property_uninsured='$property_uninsured',human_life='$human_life',fire_desc='$fire_desc',occupant_address='$occupant_address',holding_no='$holding_no',insurance='$insurance',noc='$noc' where form_id='$form_id'");
			}	
	
	   if($query){
				echo "<script>
					alert('Successfully Saved..');
					window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
				</script>";
				
		}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = '".$table_name.".php?tab=2';
				</script>";
		}						
}
?>