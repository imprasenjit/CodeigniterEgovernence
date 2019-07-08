<?php
if(isset($_POST["save1a"])){		
	$owner_name=clean($_POST["owner_name"]);$consultant_name=clean($_POST["consultant_name"]);$floor_details=clean($_POST["floor_details"]);$no_of_block=clean($_POST["no_of_block"]);$no_of_floor=clean($_POST["no_of_floor"]);$building_height=clean($_POST["building_height"]);$site_area=clean($_POST["site_area"]);$total_area=clean($_POST["total_area"]);
		
	if(!empty($_POST["owner_address"]))	 $owner_address=json_encode($_POST["owner_address"]);
	else	$owner_address="NULL";
	
	if(!empty($_POST["consultant_address"]))	 $consultant_address=json_encode($_POST["consultant_address"]);
	else	$consultant_address="NULL";

	$sql=$fire->query("select form_id from fire_form1 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){  ////////////table is empty//////////////			
			$query=$fire->query("insert into fire_form1(user_id,sub_date,owner_name,consultant_name,owner_address,consultant_address,no_of_block,no_of_floor,floor_details,building_height,site_area,total_area) values ('$swr_id','$today', '$owner_name', '$consultant_name', '$owner_address','$consultant_address','$no_of_block', '$no_of_floor','$floor_details', '$building_height', '$site_area','$total_area')") OR die("Error purabi: ".$fire->error);			
	}else{  ////////////table is not empty//////////////
			$form_id=$row["form_id"];	
			$query=$fire->query("update fire_form1 set sub_date='$today', owner_name='$owner_name', consultant_name='$consultant_name', owner_address='$owner_address',consultant_address='$consultant_address', no_of_block='$no_of_block',no_of_floor='$no_of_floor',floor_details='$floor_details', building_height='$building_height', site_area='$site_area', total_area='$total_area' where form_id='$form_id'") OR die("Error: ".$fire->error);	
	}		
	if($query){
			$formFunctions->insert_incomplete_forms('fire','1'); //fire-- dept name and 1 -- form no 
			echo "<script>
				alert('Successfully Saved.');
				window.location.href = 'fire_form1.php?tab=2';
			</script>";			
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'fire_form1.php';
			</script>";
	}						
}
if(isset($_POST["save1b"])){		
	$premise_access=clean($_POST["premise_access"]);$road_width=clean($_POST["road_width"]);$no_of_entrance=clean($_POST["no_of_entrance"]);$height_clearance=clean($_POST["height_clearance"]);$projection_height=clean($_POST["projection_height"]);$parking_argmnt=clean($_POST["parking_argmnt"]);$is_provided=clean($_POST["is_provided"]);
	if(isset($_POST["is_provided_details"])) $is_provided_details=clean($_POST["is_provided_details"]);
	else $is_provided_details= "NULL";
	
	if(!empty($_POST["surround_prop"])) $surround_prop=json_encode($_POST["surround_prop"]);
	else	$surround_prop="NULL";	
	if(!empty($_POST["os_width"]))	$os_width=json_encode($_POST["os_width"]);
	else	$os_width="NULL";
	if(!empty($_POST["no_of"])) $no_of=json_encode($_POST["no_of"]);
	else $no_of="NULL";
				
	$sql=$fire->query("select form_id from fire_form1 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){		
		echo "<script>
			alert('Please fill up the first part first !!!');
			window.location.href = 'fire_form1.php';
		</script>";			
	}else{  
		$form_id=$row["form_id"];	
		$query=$fire->query("update fire_form1 set sub_date='$today', premise_access='$premise_access', surround_prop='$surround_prop', road_width='$road_width',no_of_entrance='$no_of_entrance', height_clearance='$height_clearance', os_width='$os_width',projection_height='$projection_height', parking_argmnt='$parking_argmnt', is_provided='$is_provided', is_provided_details='$is_provided_details',no_of='$no_of' where form_id='$form_id'") OR die("Error: ".$fire->error);				
	}	
	if($query){
		echo "<script>
			alert('Successfully Saved.');
			window.location.href = 'fire_form1.php?tab=3';
		</script>";			
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'fire_form1.php?tab=2';
		</script>";
	}						
}
if(isset($_POST["save1c"])){		
	$handrail_height=clean($_POST["handrail_height"]);$sprinkler_system=clean($_POST["sprinkler_system"]);$portable_exting=clean($_POST["portable_exting"]);$public_address=clean($_POST["public_address"]);$nearest_station=clean($_POST["nearest_station"]);$other_info=clean($_POST["other_info"]);
			
	if(!empty($_POST["part"]))	 $part=json_encode($_POST["part"]);
	else	$part="NULL";
	
	if(!empty($_POST["type"]))	 $type=json_encode($_POST["type"]);
	else	$type="NULL";			
	
	$sql=$fire->query("select form_id from fire_form1 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
		
	if($sql->num_rows<1){				
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'fire_form1.php';
			</script>";				
	}else{
			$form_id=$row["form_id"];	
			$query=$fire->query("update fire_form1 set sub_date='$today', handrail_height='$handrail_height', part='$part',type='$type',sprinkler_system='$sprinkler_system', portable_exting='$portable_exting', public_address='$public_address' , nearest_station='$nearest_station'  , other_info='$other_info' where form_id='$form_id'") OR die("Error: ".$fire->error);
	}			
	if($query){
		echo "<script>
			alert('Successfully Saved.');
			window.location.href = 'fire_form1.php?tab=4';
		</script>";				
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'fire_form1.php?tab=3';
		</script>";
	}						
}
if(isset($_POST["submit1"])) {
	if(empty($_POST["mfile1"]) || empty($_POST["mfile2"]) || empty($_POST["mfile3"]) || empty($_POST["mfile4"]) || empty($_POST["mfile5"]) || $_POST["mfile1"]=='2' || $_POST["mfile2"]=='2' || $_POST["mfile3"]=='2' || $_POST["mfile4"]=='2' || $_POST["mfile5"]=='2'|| $_POST["mfile1"]=='3' || $_POST["mfile2"]=='3' || $_POST["mfile3"]=='3' || $_POST["mfile4"]=='3' || $_POST["mfile5"]=='3')
	{
		echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'fire_form1.php?tab=4';
			</script>";
	}else{			
		 $file1=clean($_POST["mfile1"]);$file2=clean($_POST["mfile2"]);$file3=clean($_POST["mfile3"]);$file4=clean($_POST["mfile4"]);$file5=clean($_POST["mfile5"]);

					
		$query=$fire->query("select form_id from fire_form1 where user_id='$swr_id' and active='1'") or die("Error :". $fire->error);

		if($query->num_rows<1){
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'fire_form1.php';
				</script>";
		}else{
			$form_id=$query->fetch_object()->form_id;
			$formFunctions->file_update($file1);$formFunctions->file_update($file2);$formFunctions->file_update($file3);$formFunctions->file_update($file4);$formFunctions->file_update($file5);		
			
			$query2=$fire->query("select id from fire_form1_upload where form_id='$form_id'") or die("Error :". $fire->error);
			if($query2->num_rows>0){ 
				$save_query=$fire->query("update fire_form1_upload set file1='$file1',file2='$file2',file3='$file3',file4='$file4',file5='$file5' where form_id='$form_id'") or die($fire->error);
				
							
			}else{
				$save_query=$fire->query("insert into fire_form1_upload(form_id,file1,file2,file3,file4,file5) values('$form_id','$file1','$file2','$file3','$file4','$file5') ") or die($fire->error);	
							
			}
              if($file1=="SC" || $file2=="SC" ||  $file3=="SC" ||  $file4=="SC" ||  $file5=="SC"){
					$received_date="NULL";
					$save_query=$fire->query("update fire_form1 set courier_details='1',sub_date='$today',received_date='$received_date' where form_id='$form_id'") or die($fire->error);
					
				}else{
					$courier_details="NULL";
					$save_query=$fire->query("update fire_form1 set sub_date='$today',received_date='$today',courier_details='$courier_details' where form_id='$form_id'") or die($fire->error);
				}
			 
		}

		if($save_query){
			echo "<script>
			window.location.href = 'preview.php?token=1';
			</script>";
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'fire_form1.php?tab=4';
			</script>";
		}
	}
}

if(isset($_POST["proceed1"])){
	echo "<script>
			window.location.href = 'compliance_report_details.php?token=1';
	</script>";
}
//////End of Fire Form1///////


/////Start of Fire Form2///////
if(isset($_POST['save2a'])){
		$clr_details=clean($_POST['clr_details']);$t_s_area=clean($_POST['t_s_area']);$p_o_name=clean($_POST['p_o_name']);$p_o_addr=json_encode($_POST['p_o_addr']);$stored=json_encode($_POST['stored']);
		$sql=$fire->query("select form_id from fire_form2 where user_id='$swr_id' and active='1'");
	    $row=$sql->fetch_array();
			
	if($sql->num_rows<1){  ////////////table is empty//////////////
			
			$query=$fire->query("insert into fire_form2(user_id,sub_date,p_o_name,p_o_addr,stored,clr_details,t_s_area) values ('$swr_id','$today', '$p_o_name', '$p_o_addr', '$stored','$clr_details','$t_s_area')") OR die("Error : ".$fire->error);		
			
	}else{  ////////////table is not empty//////////////
			$form_id=$row["form_id"];	
			$query=$fire->query("update fire_form2 set sub_date='$today', p_o_name='$p_o_name', p_o_addr='$p_o_addr', stored='$stored',clr_details='$clr_details', t_s_area='$t_s_area' where form_id='$form_id'") OR die("Error: ".$fire->error);	
	}			
		
	if($query){
		$formFunctions->insert_incomplete_forms('fire','2'); 
			echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'fire_form2.php?tab=2';
			</script>";
			
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'fire_form2.php?tab=1';
			</script>";
	}						
}

if(isset($_POST['save2b'])){
	$other_info=clean($_POST['other_info']);$license_no=clean($_POST['license_no']);$nearest_station=clean($_POST['nearest_station']);$segregate=clean($_POST['segregate']);$premise_access=clean($_POST['premise_access']);$surround_prop=json_encode($_POST['surround_prop']);$space_storage=json_encode($_POST['space_storage']);$details=json_encode($_POST['details']);

		$sql=$fire->query("select form_id from fire_form2 where user_id='$swr_id' and active='1'");
		$row=$sql->fetch_array();
		
	if($sql->num_rows<1){   
			
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'fire_form2.php';
			</script>";
			
	}else{  
			$form_id=$row["form_id"];	
			$query=$fire->query("update fire_form2 set sub_date='$today', other_info='$other_info', license_no='$license_no', nearest_station='$nearest_station',segregate='$segregate', premise_access='$premise_access', surround_prop='$surround_prop',space_storage='$space_storage', details='$details' where form_id='$form_id'") OR die("Error: ".$fire->error);				
	}	
	if($query){
			echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'fire_form2.php?tab=3';
			</script>";
			
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'fire_form2.php?tab=2';
			</script>";
	}						
}


if(isset($_POST["submit2"])) {		
		
	if(empty($_POST["mfile1"]) || empty($_POST["mfile2"]) || empty($_POST["mfile3"]) ||  empty($_POST["mfile5"]))
	{
		echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'fire_form2.php?tab=3';
			</script>";
	}else{
			
		$file1=clean($_POST["mfile1"]);$file2=clean($_POST["mfile2"]);$file3=clean($_POST["mfile3"]);$file5=clean($_POST["mfile5"]);
		$formFunctions->file_update($file1);$formFunctions->file_update($file2);$formFunctions->file_update($file3);$formFunctions->file_update($file5);
		
					
		$query=$fire->query("select form_id from fire_form2 where user_id='$swr_id' and active='1'") or die("Error :". $fire->error);
		if($query->num_rows<1){
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'fire_form2.php';
				</script>";
		}else{
			$form_id=$query->fetch_object()->form_id;
			$uain=$formFunctions->create_uain($form_id,'fire','2');
			$query2=$fire->query("select * from fire_form2 where form_id='$form_id'") or die("Error :". $fire->error);
			  if($query2->num_rows>0){
				
			
                  $save_query=$fire->query("update fire_form2 set file1='$file1',file2='$file2',file3='$file3',file5='$file5' where form_id='$form_id'") or die($fire->error);
				  
				  if($file1=="SC" || $file2=="SC" ||  $file3=="SC" ||    $file5=="SC"){
					//die("1");
					$received_date="NULL";
					$save=$fire->query("update fire_form2 set courier_details='1',sub_date='$today',received_date='$received_date' where form_id='$form_id'") or die($fire->error);
					
				}else{
					//die("2");
				$courier_details="NULL";
				$save_query=$fire->query("update fire_form2 set courier_details='$courier_details',sub_date='$today',received_date='$today' where form_id='$form_id'") or die($fire->error);}
                  
			}
		
			
			if($save_query ){
			
			
			echo "<script>
				window.location.href = 'preview.php?token=2';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'fire_form2.php?tab=3';
				</script>";
			}		
		}
	}
}
if(isset($_POST["proceed2"])){	
	echo "<script>
			window.location.href = 'compliance_report_details.php?token=2';
	</script>";
}

////////////////form2 ends////////////////
///////////////////////////form3 starts//////////////////

if(isset($_POST['save3a'])){
		
	$owner_name=$_POST["owner_name"];$license_no=$_POST["license_no"];$lic_date=$_POST["lic_date"];$owner_address=json_encode($_POST["owner_address"]);
	    $sql=$fire->query("select form_id from fire_form3 where user_id='$swr_id' and active='1'");
	    $row=$sql->fetch_array();
		
		if($sql->num_rows<1){  ////////////table is empty//////////////
			
			$query=$fire->query("insert into fire_form3(user_id,sub_date,owner_name,owner_address,license_no,lic_date) values ('$swr_id','$today', '$owner_name', '$owner_address','$license_no','$lic_date')") OR die("Error : ".$fire->error);		
			
	}else{  ////////////table is not empty//////////////
			$form_id=$row["form_id"];	
			$query=$fire->query("update fire_form3 set sub_date='$today', owner_name='$owner_name', owner_address='$owner_address',license_no='$license_no', lic_date='$lic_date' where form_id='$form_id'") OR die("Error: ".$fire->error);	
	}			
		
	if($query){
		    $formFunctions->insert_incomplete_forms('fire','3'); 
			echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'fire_form3.php?tab=2';
			</script>";
			
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'fire_form3.php?tab=1';
			</script>";
	}						
}
	
	if(isset($_POST['save3b'])){
   $surround_prop=json_encode($_POST['surround_prop']);$os_width=json_encode($_POST['os_width']);$site_area=clean($_POST['site_area']);$total_area=clean($_POST['total_area']);$premise_access=clean($_POST['premise_access']);$no_of_floor=clean($_POST['no_of_floor']);$floor_details=clean($_POST['floor_details']);$access_premises=clean($_POST['access_premises']);$width_entry=clean($_POST['width_entry']);$no_of_entrance=clean($_POST['no_of_entrance']);$parking=clean($_POST['parking']);$fire_name=clean($_POST['fire_name']);$fire_std=clean($_POST['fire_std']);$fire_land=clean($_POST['fire_land']);$system_details=clean($_POST['system_details']);$water_details=clean($_POST['water_details']);$personnel_details=clean($_POST['personnel_details']);$license_authority=clean($_POST['license_authority']);$other_info=clean($_POST['other_info']);
   
    if($parking=="Y") $two_wheeler=clean($_POST["two_wheeler"]);
			else $two_wheeler="";
	if($parking=="Y") $four_wheeler=clean($_POST["four_wheeler"]);
			else $four_wheeler="";
		 $sql=$fire->query("select form_id from fire_form3 where user_id='$swr_id' and active='1'");
			$row=$sql->fetch_array();
			
		if($sql->num_rows<1){   
				
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'fire_form3.php';
				</script>";
				
		}else{  
				$form_id=$row["form_id"];	
				$query=$fire->query("update fire_form3 set sub_date='$today', other_info='$other_info',premise_access='$premise_access', surround_prop='$surround_prop',os_width='$os_width', site_area='$site_area', total_area='$total_area', no_of_floor='$no_of_floor', floor_details='$floor_details', access_premises='$access_premises', width_entry='$width_entry', no_of_entrance='$no_of_entrance', parking='$parking', fire_name='$fire_name', fire_std='$fire_std', fire_land='$fire_land', system_details='$system_details', water_details='$water_details', personnel_details='$personnel_details' , license_authority='$license_authority', two_wheeler='$two_wheeler', four_wheeler='$four_wheeler' where form_id='$form_id'") OR die("Error: ".$fire->error);				
		}	
		if($query){
				echo "<script>
					alert('Successfully Saved..');
					window.location.href = 'fire_form3.php?tab=3';
				</script>";
				
		}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'fire_form3.php?tab=2';
				</script>";
		}						
}

if(isset($_POST["submit3"])) {		
		
	if(empty($_POST["mfile1"]) || empty($_POST["mfile2"]) || empty($_POST["mfile3"]) || empty($_POST["mfile4"]))
	{
		echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'fire_form3.php?tab=3';
			</script>";
	}else{
			
		$file1=clean($_POST["mfile1"]);$file2=clean($_POST["mfile2"]);$file3=clean($_POST["mfile3"]);$file4=clean($_POST["mfile4"]);
		$formFunctions->file_update($file1);$formFunctions->file_update($file2);$formFunctions->file_update($file3);$formFunctions->file_update($file4);
		
					
		$query=$fire->query("select form_id from fire_form3 where user_id='$swr_id' and active='1'") or die("Error :". $fire->error);
		if($query->num_rows<1){
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'fire_form3.php';
				</script>";
		}else{
			$form_id=$query->fetch_object()->form_id;
			$uain=$formFunctions->create_uain($form_id,'fire','3');
			$query2=$fire->query("select * from fire_form3 where form_id='$form_id'") or die("Error :". $fire->error);
			   if($query2->num_rows>0){
				
				$save_query=$fire->query("update fire_form3 set file1='$file1',file2='$file2',file3='$file3',file4='$file4' where form_id='$form_id'") or die($fire->error);
			    
			}
			if($file1=="SC" || $file2=="SC" ||  $file3=="SC" ||  $file4=="SC" ){
					$received_date="NULL";
					$save_query=$fire->query("update fire_form3 set courier_details='1',sub_date='$today',received_date='$received_date' where form_id='$form_id'") or die($fire->error);
					
				}else{
					$courier_details="NULL";
					$save_query=$fire->query("update fire_form3 set courier_details='$courier_details',sub_date='$today',received_date='$today' where form_id='$form_id'") or die($fire->error);
				}
			if($save_query ){
			
			echo "<script>
				alert('Successfully Submitted....');
				window.location.href = 'preview.php?token=3';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'fire_form3.php?tab=3';
				</script>";
			}		
		}
	}
}

if(isset($_POST["proceed3"])){	
	echo "<script>
			window.location.href = 'compliance_report_details.php?token=3';
	</script>";
}





                                               ///FORM4 starts/////
if(isset($_POST['save4a'])){
		$p_o_name=clean($_POST['p_o_name']);$p_o_addr=json_encode($_POST['p_o_addr']);$lc_no=clean($_POST['lc_no']);
		$lc_date=clean($_POST['lc_date']);
		$sql=$fire->query("select form_id from fire_form4 where user_id='$swr_id' and active='1'");
	    $row=$sql->fetch_array();
		
		if($sql->num_rows<1){  ////////////table is empty//////////////
			
			$query=$fire->query("insert into fire_form4(user_id,sub_date,p_o_name,p_o_addr,lc_no,lc_date) values ('$swr_id','$today', '$p_o_name', '$p_o_addr','$lc_no','$lc_date')") OR die("Error : ".$fire->error);		
			
	}else{  ////////////table is not empty//////////////
			$form_id=$row["form_id"];	
			$query=$fire->query("update fire_form4 set sub_date='$today', p_o_name='$p_o_name', p_o_addr='$p_o_addr',lc_no='$lc_no', lc_date='$lc_date' where form_id='$form_id'") OR die("Error: ".$fire->error);	
	}			
		
	if($query){
		    $formFunctions->insert_incomplete_forms('fire','4');
			echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'fire_form4.php?tab=2';
			</script>";
			
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'fire_form4.php?tab=1';
			</script>";
	}						
}
	
	
	if(isset($_POST['save4b'])){
		$t_s_area=clean($_POST['t_s_area']);$t_b_area=clean($_POST['t_b_area']);$p_accessibility=clean($_POST['p_accessibility']);
		$s_properties=json_encode($_POST['s_properties']);$n_o_floors=clean($_POST['n_o_floors']);$occupancy=clean($_POST['occupancy']);
		$o_s_a_storage=json_encode($_POST['o_s_a_storage']);$access=clean($_POST['access']);$w_premises=$_POST['w_premises'];
		$w_building=$_POST['w_building'];$emergency=clean($_POST['emergency']);$parking=$_POST['parking'];$n_fire_station=clean($_POST['n_fire_station']);$tel_no=json_encode($_POST['tel_no']);$details_f_f_system=clean($_POST['details_f_f_system']);$details_w_s=clean($_POST['details_w_s']);$details_p_t=clean($_POST['details_p_t']);$sl_c_details=json_encode($_POST['sl_c_details']);$other_info=clean($_POST['other_info']);
		
		if($parking=="Y") $two_wheeler=clean($_POST["two_wheeler"]);
			else $two_wheeler="";
		if($parking=="Y") $four_wheeler=clean($_POST["four_wheeler"]);
			else $four_wheeler="";
		$sql=$fire->query("select form_id from fire_form4 where user_id='$swr_id' and active='1'");
			$row=$sql->fetch_array();
			
		if($sql->num_rows<1){   
				
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'fire_form4.php';
				</script>";
				
		}else{  
				$form_id=$row["form_id"];	
		
		$suc1=$fire->query("update fire_form4 set t_s_area='$t_s_area',t_b_area='$t_b_area',p_accessibility='$p_accessibility',
		s_properties='$s_properties',n_o_floors='$n_o_floors',occupancy='$occupancy',o_s_a_storage='$o_s_a_storage',access='$access',
		w_premises='$w_premises',w_building='$w_building',emergency='$emergency',parking='$parking',two_wheeler='$two_wheeler',
		four_wheeler='$four_wheeler',n_fire_station='$n_fire_station',tel_no='$tel_no',details_f_f_system='$details_f_f_system',
		details_w_s='$details_w_s',details_p_t='$details_p_t',sl_c_details='$sl_c_details',other_info='$other_info' where form_id='$form_id'");
		
	}	
	if($suc1){
				echo "<script>
					alert('Successfully Saved..');
					window.location.href = 'fire_form4.php?tab=3';
				</script>";
				
		}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'fire_form4.php?tab=2';
				</script>";
		}						
}

if(isset($_POST["submit4"])){		
		
	if(empty($_POST["mfile1"]) || empty($_POST["mfile2"]) || empty($_POST["mfile3"]) || empty($_POST["mfile4"])|| empty($_POST["mfile5"])|| empty($_POST["mfile6"]))
	{
		echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'fire_form4.php?tab=3';
			</script>";
	}else{
			
		$file1=clean($_POST["mfile1"]);$file2=clean($_POST["mfile2"]);$file3=clean($_POST["mfile3"]);$file4=clean($_POST["mfile4"]);$file5=clean($_POST["mfile5"]);$file6=clean($_POST["mfile6"]);
		$formFunctions->file_update($file1);$formFunctions->file_update($file2);$formFunctions->file_update($file3);$formFunctions->file_update($file4);$formFunctions->file_update($file5);$formFunctions->file_update($file6);
		
					
		$query=$fire->query("select form_id from fire_form4 where user_id='$swr_id' and active='1'") or die("Error :". $fire->error);
		if($query->num_rows<1){
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'fire_form4.php';
				</script>";
		}else{
			$form_id=$query->fetch_object()->form_id;
			
			$query2=$fire->query("select * from fire_form4_docs where form_id='$form_id'") or die("Error :". $fire->error);
			if($query2->num_rows>0){       
				
               $save_query=$fire->query("update fire_form4_docs set file1='$file1',file2='$file2',file3='$file3',file4='$file4',file5='$file5',file6='$file6' where form_id='$form_id'") or die($fire->error);        		    
			}else{ 
                 $save_query=$fire->query("insert into fire_form4_docs(form_id,file1,file2,file3,file4,file5,file6) values('$form_id','$file1','$file2','$file3','$file4','$file5','$file6') ") or die($fire->error); 
			}
            if($file1=="SC" || $file2=="SC" ||  $file3=="SC" ||  $file4=="SC"||  $file5=="SC"||  $file6=="SC" ){
					$received_date="NULL";
					$save_query=$fire->query("update fire_form4 set courier_details='1',sub_date='$today',received_date='$received_date' where form_id='$form_id'") or die($fire->error);
					
				}else{
				$courier_details="NULL";
				$save_query=$fire->query("update fire_form4 set courier_details='$courier_details',sub_date='$today',received_date='$today' where form_id='$form_id'") or die($fire->error);
				}
				
			if($save_query ){
			
			echo "<script>
				alert('Successfully Submitted....');
				window.location.href = 'preview.php?token=4';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'fire_form4.php?tab=3';
				</script>";
		}		
		
	}
}
}
if(isset($_POST["proceed4"])){	
	echo "<script>
			window.location.href = 'compliance_report_details.php?token=4';
	</script>";
}

///////////////////////////////////////////////////////////form 4 ends//////////////////////////////////////////////////////////



//////////////////////////////////////////////////////////form 5 starts//////////////////////////////////////////////////////////////
if(isset($_POST['save5a'])){
		$owner_name=clean($_POST['owner_name']);$owner_address=json_encode($_POST['owner_address']);
		
		$flag=0;
		if(empty($owner_name)==true || empty($owner_address)==true){
			$flag=1;//validation fault
		}
		$sql=$fire->query("select form_id from fire_form5 where user_id='$swr_id' and active='1'");
	    $row=$sql->fetch_array();
		
		if($sql->num_rows<1){  ////////////table is empty//////////////
			
			$query=$fire->query("insert into fire_form5(user_id,sub_date,owner_name,owner_address) values ('$swr_id','$today', '$owner_name',  '$owner_address')") OR die("Error : ".$fire->error);		
			
	}else{  ////////////table is not empty//////////////
			$form_id=$row["form_id"];	
			$query=$fire->query("update fire_form5 set sub_date='$today', owner_name='$owner_name', owner_address='$owner_address' where form_id='$form_id'") OR die("Error: ".$fire->error);	
	}			
		
	if($query){
		   $formFunctions->insert_incomplete_forms('fire','5');
			echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'fire_form5.php?tab=2';
			</script>";
			
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'fire_form5.php?tab=1';
			</script>";
	}						
}
	
	if(isset($_POST['save5b'])){
		   $site_area=$_POST["site_area"];$total_area=$_POST["total_area"];$premise_access=$_POST["premise_access"];$no_of_floor=$_POST["no_of_floor"];$floor_details=$_POST["floor_details"];$access_premises=$_POST["access_premises"];$width_entry=$_POST["width_entry"];$no_of_entrance=$_POST["no_of_entrance"];$parking=$_POST["parking"];$fire_name=$_POST["fire_name"];
			$fire_std=$_POST["fire_std"];$fire_land=$_POST["fire_land"];$system_details=$_POST["system_details"];
			$water_details=$_POST["water_details"];$personnel_details=$_POST["personnel_details"];$license_authority=$_POST["license_authority"];$other_info=$_POST["other_info"];
			
			if($parking=="YES") $two_wheeler=clean($_POST["two_wheeler"]);
			else $two_wheeler="";
			if($parking=="YES") $four_wheeler=clean($_POST["four_wheeler"]);
			else $four_wheeler="";
			
              if(!empty($_POST["surround_prop"])){
	          $surround_prop=json_encode($_POST["surround_prop"]);
	
	         }else{
	        	$surround_prop="NULL";
	         }


			if(!empty($_POST["os_width"])){
			$os_width=json_encode($_POST["os_width"]);
			
			}else{
				$os_width="NULL";
			}


		    $sql=$fire->query("select form_id from fire_form5 where user_id='$swr_id' and active='1'");
			$row=$sql->fetch_array();
			
		if($sql->num_rows<1){   
				
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'fire_form5.php';
				</script>";
				
		}else{  
				$form_id=$row["form_id"];	
		
		   $update=$fire->query("update fire_form5 set site_area='$site_area',total_area='$total_area',premise_access='$premise_access',no_of_floor='$no_of_floor',floor_details='$floor_details',access_premises='$access_premises',width_entry='$width_entry',no_of_entrance='$no_of_entrance',parking='$parking',fire_name='$fire_name',fire_std='$fire_std',fire_land='$fire_land',system_details='$system_details',water_details='$water_details',personnel_details='$personnel_details',license_authority='$license_authority',other_info='$other_info',two_wheeler='$two_wheeler',four_wheeler='$four_wheeler',surround_prop='$surround_prop',os_width='$os_width' where form_id='$form_id'") or die("error:".$fire->error); 
		
	}	
	
	   if($update){
				echo "<script>
					alert('Successfully Saved..');
					window.location.href = 'fire_form5.php?tab=3';
				</script>";
				
		}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'fire_form5.php?tab=2';
				</script>";
		}						
}




if(isset($_POST["submit5"])) {		
		
	if(empty($_POST["mfile1"]) || empty($_POST["mfile2"]) || empty($_POST["mfile3"]) || empty($_POST["mfile4"]))
	{
		echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'fire_form5.php?tab=3';
			</script>";
	}else{
			
		$file1=clean($_POST["mfile1"]);$file2=clean($_POST["mfile2"]);$file3=clean($_POST["mfile3"]);$file4=clean($_POST["mfile4"]);
		$formFunctions->file_update($file1);$formFunctions->file_update($file2);$formFunctions->file_update($file3);$formFunctions->file_update($file4);
		
					
		$query=$fire->query("select form_id from fire_form5 where user_id='$swr_id' and active='1'") or die("Error :". $fire->error);
		if($query->num_rows<1){
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'fire_form5.php';
				</script>";
		}else{
			$form_id=$query->fetch_object()->form_id;
			$uain=$formFunctions->create_uain($form_id,'fire','5');
			$query2=$fire->query("select * from fire_form5 where form_id='$form_id'") or die("Error :". $fire->error);
			if($query2->num_rows>0){
				 
				$save_query=$fire->query("update fire_form5 set file1='$file1',file2='$file2',file3='$file3',file4='$file4' where form_id='$form_id'") or die($fire->error);
			   
			}
			if($file1=="SC" || $file2=="SC" ||  $file3=="SC" ||  $file4=="SC" ){
					$received_date="NULL";
					$save_query=$fire->query("update fire_form5 set courier_details='1',sub_date='$today',received_date='$received_date' where form_id='$form_id'") or die($fire->error);
					
				}else{
				$courier_details="NULL";
				$save_query=$fire->query("update fire_form5 set courier_details='$courier_details',sub_date='$today',received_date='$today' where form_id='$form_id'") or die($fire->error);
				}
			
			if($save_query ){
			
			echo "<script>
				alert('Successfully Submitted....');
				window.location.href = 'preview.php?token=5';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'fire_form5.php?tab=3';
				</script>";
			}		
		}
	}
}
if(isset($_POST["proceed5"])){	
	echo "<script>
			window.location.href = 'compliance_report_details.php?token=5';
	</script>";
}
///////////////////////////////////////////////// form 5 ends////////////////////////////////////////////////////////////////////////////



////////////////////////////////////////////////form6 starts/////////////////////////////////////////////////////////////////////////////


if(isset($_POST['save6a'])){ 
		$owner_name=clean($_POST['owner_name']);$owner_address=json_encode($_POST['owner_address']);
		
		
		$sql=$fire->query("select form_id from fire_form6 where user_id='$swr_id' and active='1'");
	    $row=$sql->fetch_array();
		
		if($sql->num_rows<1){  ////////////table is empty//////////////
			
			$query=$fire->query("insert into fire_form6(user_id,sub_date,owner_name,owner_address) values ('$swr_id','$today', '$owner_name',  '$owner_address')") OR die("Error : ".$fire->error);		
			
	}else{  ////////////table is not empty//////////////
			$form_id=$row["form_id"];	
			$query=$fire->query("update fire_form5 set sub_date='$today', owner_name='$owner_name', owner_address='$owner_address' where form_id='$form_id'") OR die("Error: ".$fire->error);	
	}			
		
	if($query){
		 $formFunctions->insert_incomplete_forms('fire','6');
			echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'fire_form6.php?tab=2';
			</script>";
			
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'fire_form6.php?tab=1';
			</script>";
	}						
}
	
	if(isset($_POST['save6b'])){
      $total_area=clean($_POST["total_area"]);$purpose_erect=$_POST["purpose_erect"];$distance_motor=$_POST["distance_motor"];$width_road=$_POST["width_road"];$parking=$_POST["parking"];$arrange_cook=$_POST["arrange_cook"];$distance_electric=clean($_POST["distance_electric"]);$fire_name=$_POST["fire_name"];$fire_std=$_POST["fire_std"];$fire_land=$_POST["fire_land"];$fire_details=$_POST["fire_details"];$water_details=$_POST["water_details"];$personnel_details=$_POST["personnel_details"];$s_no=$_POST["s_no"];$license_authority=$_POST["license_authority"];$license_name=$_POST["license_name"];$license_no=$_POST["license_no"];$other_info=$_POST["other_info"];
         if($parking=="Y") $two_wheeler=clean($_POST["two_wheeler"]);
			else $two_wheeler="";
			if($parking=="Y") $four_wheeler=clean($_POST["four_wheeler"]);
			else $four_wheeler="";
		  if(!empty($_POST["surround_prop"])){
		  $surround_prop=json_encode($_POST["surround_prop"]);
		  }else{
			$surround_prop="NULL";
		  }
		if(!empty($_POST["os_width"])){
		$os_width=json_encode($_POST["os_width"]);
		
		}else{
			$os_width="NULL";
		}
        $sql=$fire->query("select form_id from fire_form6 where user_id='$swr_id' and active='1'");
			$row=$sql->fetch_array();
			
		if($sql->num_rows<1){   
				
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'fire_form6.php';
				</script>";
				
		}else{  
				$form_id=$row["form_id"];	
		
		    $update=$fire->query("update fire_form6 set total_area='$total_area',purpose_erect='$purpose_erect',distance_motor='$distance_motor',width_road='$width_road',parking='$parking',two_wheeler='$two_wheeler',four_wheeler='$four_wheeler',arrange_cook='$arrange_cook',distance_electric='$distance_electric',fire_name='$fire_name',fire_std='$fire_std',fire_land='$fire_land',fire_details='$fire_details',water_details='$water_details',s_no='$s_no',personnel_details='$personnel_details',license_authority='$license_authority',license_name='$license_name',license_no='$license_no',other_info='$other_info',surround_prop='$surround_prop',os_width='$os_width' where form_id='$form_id'") or die("error:".$fire->error); 
		
	}	
	
	   if($update){
				echo "<script>
					alert('Successfully Saved..');
					window.location.href = 'fire_form6.php?tab=3';
				</script>";
				
		}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'fire_form6.php?tab=2';
				</script>";
		}						
}	
if(isset($_POST["submit6"])) {		
		
	if(empty($_POST["mfile1"]) || empty($_POST["mfile2"]) || empty($_POST["mfile3"]) || empty($_POST["mfile4"]))
	{
		echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'fire_form6.php?tab=3';
			</script>";
	}else{
			
		$file1=clean($_POST["mfile1"]);$file2=clean($_POST["mfile2"]);$file3=clean($_POST["mfile3"]);$file4=clean($_POST["mfile4"]);
		$formFunctions->file_update($file1);$formFunctions->file_update($file2);$formFunctions->file_update($file3);$formFunctions->file_update($file4);
		
					
		$query=$fire->query("select form_id from fire_form6 where user_id='$swr_id' and active='1'") or die("Error :". $fire->error);
		if($query->num_rows<1){
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'fire_form6.php';
				</script>";
		}else{
			$form_id=$query->fetch_object()->form_id;
			$uain=$formFunctions->create_uain($form_id,'fire','6');
			$query2=$fire->query("select * from fire_form6 where form_id='$form_id'") or die("Error :". $fire->error);
			if($query2->num_rows>0){
				
				$save_query=$fire->query("update fire_form6 set file1='$file1',file2='$file2',file3='$file3',file4='$file4' where form_id='$form_id'") or die($fire->error);
			
			}
			if($file1=="SC" || $file2=="SC" ||  $file3=="SC" ||  $file4=="SC" ){
					$received_date="NULL";
					$save_query=$fire->query("update fire_form6 set courier_details='1',sub_date='$today',received_date='$received_date' where form_id='$form_id'") or die($fire->error);
					
				}else{
				$courier_details="NULL";
				$save_query=$fire->query("update fire_form6 set courier_details='$courier_details',sub_date='$today',received_date='$today' where form_id='$form_id'") or die($fire->error);
				}
			
			if($save_query ){
			
			echo "<script>
				alert('Successfully Submitted....');
				window.location.href = 'preview.php?token=6';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'fire_form6.php?tab=3';
				</script>";
			}		
		}
	}
}
if(isset($_POST["proceed6"])){	
	echo "<script>
			window.location.href = 'compliance_report_details.php?token=6';
	</script>";
}
  /////////////////////////////////////////////////////form 6 ends////////////////////////////////////////////////////////////////////
  
  
  
/////////////////////////////////////////////////////////form 7 starts///////////////////////////////////////////////////////////////  
  
if(isset($_POST['save7a'])){
		$p_o_name=clean($_POST['p_o_name']);$p_o_addr=json_encode($_POST['p_o_addr']);
		
		
		$sql=$fire->query("select form_id from fire_form7 where user_id='$swr_id' and active='1'");
	    $row=$sql->fetch_array();
		
		if($sql->num_rows<1){  ////////////table is empty//////////////
			
			$query=$fire->query("insert into fire_form7(user_id,sub_date,p_o_name,p_o_addr) values ('$swr_id','$today', '$p_o_name',  '$p_o_addr')") OR die("Error : ".$fire->error);		
			
	}else{  ////////////table is not empty//////////////
			$form_id=$row["form_id"];	
			$query=$fire->query("update fire_form7 set sub_date='$today', p_o_name='$p_o_name', p_o_addr='$p_o_addr' where form_id='$form_id'") OR die("Error: ".$fire->error);	
	}			
		
	if($query){
		      $formFunctions->insert_incomplete_forms('fire','7');
			echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'fire_form7.php?tab=2';
			</script>";
			
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'fire_form7.php?tab=1';
			</script>";
	}						
}
if(isset($_POST['save7b'])){

  $type_of_storage=clean($_POST['type_of_storage']);$flash_point=clean($_POST['flash_point']);$electrification_details=clean($_POST['electrification_details']);$t_s_area=clean($_POST['t_s_area']);$p_accessibility=clean($_POST['p_accessibility']);$s_properties=json_encode($_POST['s_properties']);$o_s_a_storage=json_encode($_POST['o_s_a_storage']);$segregate=clean($_POST['segregate']);$n_fire_station=clean($_POST['n_fire_station']);$details_f_f_system=clean($_POST['details_f_f_system']);
	$details_w_s=clean($_POST['details_w_s']);$details_p_t=clean($_POST['details_p_t']);$sl_c_details=json_encode($_POST['sl_c_details']);$lc_no=clean($_POST['lc_no']);$other_info=clean($_POST['other_info']);$product_clasification=clean($_POST['product_clasification']);
	if(empty($_POST['quantity_stored'])==false){
		$quantity_stored=implode(',',$_POST['quantity_stored']);
	}else{
		$quantity_stored="";
	}


	$sql=$fire->query("select form_id from fire_form7 where user_id='$swr_id' and active='1'");
			$row=$sql->fetch_array();
			
		if($sql->num_rows<1){   
				
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'fire_form7.php';
				</script>";
				
		}else{  
				$form_id=$row["form_id"];	
		
		  $update=$fire->query("update fire_form7 set product_clasification='$product_clasification',quantity_stored='$quantity_stored',
			type_of_storage='$type_of_storage',flash_point='$flash_point',electrification_details='$electrification_details',t_s_area='$t_s_area',p_accessibility='$p_accessibility',
			s_properties='$s_properties',o_s_a_storage='$o_s_a_storage',segregate='$segregate',
			n_fire_station='$n_fire_station',details_f_f_system='$details_f_f_system',
			details_w_s='$details_w_s',details_p_t='$details_p_t',sl_c_details='$sl_c_details',lc_no='$lc_no',other_info='$other_info' where form_id='$form_id'")or die($fire->error);
		
	}	
	
	   if($update){
				echo "<script>
					alert('Successfully Saved..');
					window.location.href = 'fire_form7.php?tab=3';
				</script>";
				
		}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'fire_form7.php?tab=2';
				</script>";
		}						
}
  
  
if(isset($_POST["submit7"])) {		
		
	if(empty($_POST["mfile1"]) || empty($_POST["mfile2"]) || empty($_POST["mfile3"]) || empty($_POST["mfile4"]))
	{
		echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'fire_form7.php?tab=3';
			</script>";
	}else{
			
		$file1=clean($_POST["mfile1"]);$file2=clean($_POST["mfile2"]);$file3=clean($_POST["mfile3"]);$file4=clean($_POST["mfile4"]);
		$formFunctions->file_update($file1);$formFunctions->file_update($file2);$formFunctions->file_update($file3);$formFunctions->file_update($file4);
		
					
		$query=$fire->query("select form_id from fire_form7 where user_id='$swr_id' and active='1'") or die("Error :". $fire->error);
		if($query->num_rows<1){
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'fire_form7.php';
				</script>";
		}else{
			$form_id=$query->fetch_object()->form_id;
			$uain=$formFunctions->create_uain($form_id,'fire','7');
			$query2=$fire->query("select * from fire_form7_docs where form_id='$form_id'") or die("Error :". $fire->error);
			if($query2->num_rows>0){				
              $save_query=$fire->query("update fire_form7_docs set file1='$file1',file2='$file2',file3='$file3',file4='$file4' where form_id='$form_id'") or die($fire->error);			  
			}else{				
			      	$save_query=$fire->query("insert into fire_form7_docs(form_id,file1,file2,file3,file4) values('$form_id','$file1','$file2','$file3','$file4') ") or die($fire->error);       
			}
			if($file1=="SC" || $file2=="SC" ||  $file3=="SC" ||  $file4=="SC" ){
					$received_date="NULL";
					$save_query=$fire->query("update fire_form7 set courier_details='1',sub_date='$today',received_date='$received_date' where form_id='$form_id'") or die($fire->error);
					
				}else{
				$courier_details="NULL";
				$save_query=$fire->query("update fire_form7 set courier_details='$courier_details',sub_date='$today',received_date='$today' where form_id='$form_id'") or die($fire->error);
				}
			
			
			if($save_query ){
			
			echo "<script>
				alert('Successfully Submitted....');
				window.location.href = 'preview.php?token=7';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'fire_form7.php?tab=3';
				</script>";
			}		
		}
	}
}
if(isset($_POST["proceed7"])){	
	echo "<script>
			window.location.href = 'compliance_report_details.php?token=7';
	</script>";
}
/////////////////////////////////////////////////////form 7 ends//////////////////////////////////////////////////////////

////////////////////////////////////////////////////form 8 starts////////////////////////////////////////////////////////
if(isset($_POST['save8a'])){
		$owner_name=clean($_POST['owner_name']);$owner_address=json_encode($_POST['owner_address']);
		
		$sql=$fire->query("select form_id from fire_form8 where user_id='$swr_id' and active='1'");
	    $row=$sql->fetch_array();
		
		if($sql->num_rows<1){  ////////////table is empty//////////////
			
			$query=$fire->query("insert into fire_form8(user_id,sub_date,owner_name,owner_address) values ('$swr_id','$today', '$owner_name',  '$owner_address')") OR die("Error : ".$fire->error);		
			
	}else{  ////////////table is not empty//////////////
			$form_id=$row["form_id"];	
			$query=$fire->query("update fire_form8 set sub_date='$today', owner_name='$owner_name', owner_address='$owner_address' where form_id='$form_id'") OR die("Error: ".$fire->error);	
	}			
		
	if($query){
		   $formFunctions->insert_incomplete_forms('fire','8');
			echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'fire_form8.php?tab=2';
			</script>";
			
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'fire_form8.php?tab=1';
			</script>";
	}						
}
if(isset($_POST['save8b'])){

$chemical_stored=$_POST["chemical_stored"];$quantity_stored=$_POST["quantity_stored"];$type_storage=$_POST["type_storage"];$flash_stored=$_POST["flash_stored"];$details_electric=$_POST["details_electric"];$total_area=$_POST["total_area"];$access_premises=$_POST["access_premises"];$provision_segregate=$_POST["provision_segregate"];$size_exit=$_POST["size_exit"];$fire_name=$_POST["fire_name"];$fire_details=$_POST["fire_details"];$water_details=$_POST["water_details"];$personnel_details=$_POST["personnel_details"];$s_no=$_POST["s_no"];$license_no=$_POST["license_no"];$other_info=$_POST["other_info"];
				  if(!empty($_POST["surround_prop"])){
		          $surround_prop=json_encode($_POST["surround_prop"]);
		
		         }else{
		        	$surround_prop="NULL";
		         }


				if(!empty($_POST["os_width"])){
				$os_width=json_encode($_POST["os_width"]);
				
				}else{
					$os_width="NULL";
				}
 
			$sql=$fire->query("select form_id from fire_form8 where user_id='$swr_id' and active='1'");
			$row=$sql->fetch_array();	
		    if($sql->num_rows<1){   
				
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'fire_form8.php';
				</script>";
				
		  }else{  
		$form_id=$row["form_id"];	
		  $update=$fire->query("update fire_form8 set chemical_stored='$chemical_stored',quantity_stored='$quantity_stored',type_storage='$type_storage',flash_stored='$flash_stored',details_electric='$details_electric',total_area='$total_area',access_premises='$access_premises',provision_segregate='$provision_segregate',size_exit='$size_exit',fire_name='$fire_name',fire_details='$fire_details',water_details='$water_details',personnel_details='$personnel_details',s_no='$s_no',license_no='$license_no',other_info='$other_info',surround_prop='$surround_prop',os_width='$os_width' where form_id='$form_id'") or die("error:".$fire->error); 
		
	}	
	
	   if($update){
				echo "<script>
					alert('Successfully Saved..');
					window.location.href = 'fire_form8.php?tab=3';
				</script>";
				
		}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'fire_form8.php?tab=2';
				</script>";
		}						
}  
if(isset($_POST["submit8"])) {				
	if(empty($_POST["mfile1"]) || empty($_POST["mfile2"]) || empty($_POST["mfile3"]) || empty($_POST["mfile4"]))
	{
		echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'fire_form8.php?tab=3';
			</script>";
	}else{
			
		$file1=clean($_POST["mfile1"]);$file2=clean($_POST["mfile2"]);$file3=clean($_POST["mfile3"]);$file4=clean($_POST["mfile4"]);
		$formFunctions->file_update($file1);$formFunctions->file_update($file2);$formFunctions->file_update($file3);$formFunctions->file_update($file4);
		
					
		$query=$fire->query("select form_id from fire_form8 where user_id='$swr_id' and active='1'") or die("Error :". $fire->error);
		if($query->num_rows<1){
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'fire_form8.php';
				</script>";
		}else{
			$form_id=$query->fetch_object()->form_id;
			$uain=$formFunctions->create_uain($form_id,'fire','8');
			$query2=$fire->query("select * from fire_form8 where form_id='$form_id'") or die("Error :". $fire->error);
			if($query2->num_rows>0){
				
				$save_query=$fire->query("update fire_form8 set file1='$file1',file2='$file2',file3='$file3',file4='$file4' where form_id='$form_id'") or die($fire->error);
			  
			}
			if($file1=="SC" || $file2=="SC" ||  $file3=="SC" ||  $file4=="SC" ){
					$received_date="NULL";
					$save_query=$fire->query("update fire_form8 set courier_details='1',sub_date='$today',received_date='$received_date' where form_id='$form_id'") or die($fire->error);
					
				}else{
				$courier_details="NULL";
				$save_query=$fire->query("update fire_form8 set courier_details='$courier_details',sub_date='$today',received_date='$today' where form_id='$form_id'") or die($fire->error);
				}
			
			
			if($save_query ){
				
			echo "<script>
				alert('Successfully Submitted....');
				window.location.href = 'preview.php?token=8';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'fire_form8.php?tab=3';
				</script>";
			}		
		}
	}
}
if(isset($_POST["proceed8"])){	
	echo "<script>
			window.location.href = 'compliance_report_details.php?token=8';
	</script>";
}
/////////////////////////////////////////form 8 ends//////////////////////////////////////////////////////////


////////////////////////////////////////////form 9 starts/////////////////////////////////////////////
if(isset($_POST['save9a'])){
		$p_o_name=clean($_POST['p_o_name']);$p_o_addr=json_encode($_POST['p_o_addr']);
		
		$sql=$fire->query("select form_id from fire_form9 where user_id='$swr_id' and active='1'");
	    $row=$sql->fetch_array();
		
		if($sql->num_rows<1){  ////////////table is empty//////////////
			
			$query=$fire->query("insert into fire_form9(user_id,sub_date,p_o_name,p_o_addr) values ('$swr_id','$today', '$p_o_name',  '$p_o_addr')") OR die("Error : ".$fire->error);		
			
	}else{  ////////////table is not empty//////////////
			$form_id=$row["form_id"];	
			$query=$fire->query("update fire_form9 set sub_date='$today', p_o_name='$p_o_name', p_o_addr='$p_o_addr' where form_id='$form_id'") OR die("Error: ".$fire->error);	
	}			
		
	if($query){
		 $formFunctions->insert_incomplete_forms('fire','9');
			echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'fire_form9.php?tab=2';
			</script>";
			
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'fire_form9.php?tab=1';
			</script>";
	}						
}
	if(isset($_POST['save9b'])){
	$explosive_clasification=clean($_POST['explosive_clasification']);$quantity_stored=clean($_POST['quantity_stored']);$type_of_storage=clean($_POST['type_of_storage']);$room_size=clean($_POST['room_size']);$electrification_details=clean($_POST['electrification_details']);$t_s_area=clean($_POST['t_s_area']);$p_accessibility=clean($_POST['p_accessibility']);$s_properties=json_encode($_POST['s_properties']);$o_s_a_storage=json_encode($_POST['o_s_a_storage']);$segregate=clean($_POST['segregate']);$n_fire_station=clean($_POST['n_fire_station']);$details_f_f_system=clean($_POST['details_f_f_system']);$details_w_s=clean($_POST['details_w_s']);$details_p_t=clean($_POST['details_p_t']);$sl_c_details=json_encode($_POST['sl_c_details']);$lc_no=clean($_POST['lc_no']);$other_info=clean($_POST['other_info']);
	
	    $sql=$fire->query("select form_id from fire_form9 where user_id='$swr_id' and active='1'");
			$row=$sql->fetch_array();	
		    if($sql->num_rows<1){   
				
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'fire_form9.php';
				</script>";
				
		  }else{  
		$form_id=$row["form_id"];	
		  $update=$fire->query("update fire_form9 set explosive_clasification='$explosive_clasification',quantity_stored='$quantity_stored',
			type_of_storage='$type_of_storage',room_size='$room_size',electrification_details='$electrification_details',t_s_area='$t_s_area',p_accessibility='$p_accessibility',
			s_properties='$s_properties',o_s_a_storage='$o_s_a_storage',segregate='$segregate',
			n_fire_station='$n_fire_station',details_f_f_system='$details_f_f_system',
			details_w_s='$details_w_s',details_p_t='$details_p_t',sl_c_details='$sl_c_details',lc_no='$lc_no',other_info='$other_info' where form_id='$form_id'");
		
	}	
	
	   if($update){
				echo "<script>
					alert('Successfully Saved..');
					window.location.href = 'fire_form9.php?tab=3';
				</script>";
				
		}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'fire_form9.php?tab=2';
				</script>";
		}						
}
if(isset($_POST["submit9"])) {		
		
	if(empty($_POST["mfile1"]) || empty($_POST["mfile2"]) || empty($_POST["mfile3"]) || empty($_POST["mfile4"]))
	{
		echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'fire_form9.php?tab=3';
			</script>";
	}else{
			
		$file1=clean($_POST["mfile1"]);$file2=clean($_POST["mfile2"]);$file3=clean($_POST["mfile3"]);$file4=clean($_POST["mfile4"]);
		$formFunctions->file_update($file1);$formFunctions->file_update($file2);$formFunctions->file_update($file3);$formFunctions->file_update($file4);
		
					
		$query=$fire->query("select form_id from fire_form9 where user_id='$swr_id' and active='1'") or die("Error :". $fire->error);
		if($query->num_rows<1){
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'fire_form9.php';
				</script>";
		}else{
			$form_id=$query->fetch_object()->form_id;
			$uain=$formFunctions->create_uain($form_id,'fire','9');
			$query2=$fire->query("select * from fire_form9_docs where form_id='$form_id'") or die("Error :". $fire->error);
			   if($query2->num_rows>0){
					 
			   	$save_query=$fire->query("update fire_form9_docs set file1='$file1',file2='$file2',file3='$file3',file4='$file4' where form_id='$form_id'") or die($fire->error);
			     
			}else{
					
        	$save_query=$fire->query("insert into fire_form9_docs(form_id,file1,file2,file3,file4) values('$form_id','$file1','$file2','$file3','$file4') ") or die($fire->error);
			       
			}
			if($file1=="SC" || $file2=="SC" ||  $file3=="SC" ||  $file4=="SC" ){
					$received_date="NULL";
					$save_query=$fire->query("update fire_form9 set courier_details='1',sub_date='$today',received_date='$received_date' where form_id='$form_id'") or die($fire->error);
					
				}else{
				$courier_details="NULL";
				$save_query=$fire->query("update fire_form9 set courier_details='$courier_details',sub_date='$today',received_date='$today' where form_id='$form_id'") or die($fire->error);
				}
			
			
			if($save_query ){
			
			echo "<script>
				alert('Successfully Submitted....');
				window.location.href = 'preview.php?token=9';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'fire_form9.php?tab=3';
				</script>";
			}		
		}
	}
}
if(isset($_POST["proceed9"])){	
	echo "<script>
			window.location.href = 'compliance_report_details.php?token=9';
	</script>";
}
//////////////////////////////////form 9 ends//////////////////////////////////////////////

////////////////////////////////////form 10 starts//////////////////////////////////////////////
if(isset($_POST['save10a'])){
		$p_o_name=clean($_POST['p_o_name']);
		$p_o_addr=json_encode($_POST['p_o_addr']);
		
		$sql=$fire->query("select form_id from fire_form10 where user_id='$swr_id' and active='1'");
	    $row=$sql->fetch_array();
		
		if($sql->num_rows<1){  ////////////table is empty//////////////
			
			$query=$fire->query("insert into fire_form10(user_id,sub_date,p_o_name,p_o_addr) values ('$swr_id','$today', '$p_o_name',  '$p_o_addr')") OR die("Error : ".$fire->error);		
			
	}else{  ////////////table is not empty//////////////
			$form_id=$row["form_id"];	
			$query=$fire->query("update fire_form10 set sub_date='$today', p_o_name='$p_o_name', p_o_addr='$p_o_addr' where form_id='$form_id'") OR die("Error: ".$fire->error);	
	}			
		
	if($query){
		 $formFunctions->insert_incomplete_forms('fire','10');
			echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'fire_form10.php?tab=2';
			</script>";
			
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'fire_form10.php?tab=1';
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

	$type_of_storage=isset($_POST['type_of_storage'])? clean($_POST['type_of_storage']):"NULL";
	$flash_point=clean($_POST['flash_point']);
	$electrification_details=clean($_POST['electrification_details']);
	$t_s_area=clean($_POST['t_s_area']);
	$p_accessibility=clean($_POST['p_accessibility']);
	$s_properties=json_encode($_POST['s_properties']);
	$o_s_a_storage=json_encode($_POST['o_s_a_storage']);
	$segregate=clean($_POST['segregate']);
	$n_fire_station=clean($_POST['n_fire_station']);
	$details_f_f_system=clean($_POST['details_f_f_system']);
	$details_w_s=clean($_POST['details_w_s']);
	$details_p_t=clean($_POST['details_p_t']);
	$sl_c_details=json_encode($_POST['sl_c_details']);
	$lc_no=clean($_POST['lc_no']);
	$other_info=clean($_POST['other_info']);
	
	        $sql=$fire->query("select form_id from fire_form10 where user_id='$swr_id' and active='1'");
			$row=$sql->fetch_array();	
		    if($sql->num_rows<1){   
				
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'fire_form10.php';
				</script>";
				
		  }else{  
		$form_id=$row["form_id"];	
		  $update=$fire->query("update fire_form10 set chemicals='$chemicals',quantity_stored='$quantity_stored',
			type_of_storage='$type_of_storage',flash_point='$flash_point',electrification_details='$electrification_details',t_s_area='$t_s_area',p_accessibility='$p_accessibility',s_properties='$s_properties',o_s_a_storage='$o_s_a_storage',segregate='$segregate',n_fire_station='$n_fire_station',details_f_f_system='$details_f_f_system',details_w_s='$details_w_s',details_p_t='$details_p_t',sl_c_details='$sl_c_details',lc_no='$lc_no',other_info='$other_info' where user_id='$swr_id'");
		
	}	
	
	   if($update){
				echo "<script>
					alert('Successfully Saved..');
					window.location.href = 'fire_form10.php?tab=3';
				</script>";
				
		}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'fire_form10.php?tab=2';
				</script>";
		}						
}
if(isset($_POST["submit10"])) {		
		
	if(empty($_POST["mfile1"]) || empty($_POST["mfile2"]) || empty($_POST["mfile3"]) || empty($_POST["mfile4"]))
	{
		echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'fire_form10.php?tab=3';
			</script>";
	}else{
			
		$file1=clean($_POST["mfile1"]);$file2=clean($_POST["mfile2"]);$file3=clean($_POST["mfile3"]);$file4=clean($_POST["mfile4"]);
		$formFunctions->file_update($file1);$formFunctions->file_update($file2);$formFunctions->file_update($file3);$formFunctions->file_update($file4);
		
					
		$query=$fire->query("select form_id from fire_form10 where user_id='$swr_id' and active='1'") or die("Error :". $fire->error);
		if($query->num_rows<1){
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'fire_form10.php';
				</script>";
		}else{
			$form_id=$query->fetch_object()->form_id;
			$uain=$formFunctions->create_uain($form_id,'fire','10');
			$query2=$fire->query("select * from fire_form10_docs where form_id='$form_id'") or die("Error :". $fire->error);
			if($query2->num_rows>0){
				
			        	$save_query=$fire->query("update fire_form10_docs set  file1='$file1',file2='$file2',file3='$file3',file4='$file4' where form_id='$form_id'") or die($fire->error);  
			}else{				
			     	$save_query=$fire->query("insert into fire_form10_docs(form_id,file1,file2,file3,file4) values('$form_id','$file1','$file2','$file3','$file4') ") or die($fire->error);
			}
			if($file1=="SC" || $file2=="SC" ||  $file3=="SC" ||  $file4=="SC" ){
					$received_date="NULL";
					$save_query=$fire->query("update fire_form10 set courier_details='1',sub_date='$today',received_date='$received_date' where form_id='$form_id'") or die($fire->error);
					
				}else{
				$courier_details="NULL";
				$save_query=$fire->query("update fire_form10 set courier_details='$courier_details',sub_date='$today',received_date='$today' where form_id='$form_id'") or die($fire->error);
				}
			
			if($save_query ){
				
			echo "<script>
				alert('Successfully Submitted....');
				window.location.href = 'preview.php?token=10';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'fire_form10.php?tab=3';
				</script>";
			}		
		}
	}
}
if(isset($_POST["proceed10"])){	
	echo "<script>
			window.location.href = 'compliance_report_details.php?token=10';
	</script>";
}

if(isset($_POST['save11'])){
   $holding_no=$_POST['holding_no'];$letter_no=clean($_POST['letter_no']);$letter_date=date('Y-m-d',strtotime($_POST['letter_date']));$letter_valid_date=date('Y-m-d',strtotime($_POST['letter_valid_date']));$renewal_year1=clean($_POST['renewal_year1']);$renewal_year2=clean($_POST['renewal_year2']);



	$sql=$fire->query("select form_id from fire_form11 where user_id='$swr_id' and active='1'");
	    $row=$sql->fetch_array();
		
		if($sql->num_rows<1){  ////////////table is empty//////////////
			
			$query=$fire->query("insert into fire_form11(user_id,sub_date,holding_no,letter_no,letter_date,letter_valid_date,renewal_year1,renewal_year2) values ('$swr_id','$today','$holding_no','$letter_no','$letter_date','$letter_valid_date','$renewal_year1','$renewal_year2')") OR die("Error : ".$fire->error);		
			
	}else{  ////////////table is not empty//////////////
			$form_id=$row["form_id"];	
			$query=$fire->query("update fire_form11 set sub_date='$today', holding_no='$holding_no', letter_no='$letter_no', letter_date='$letter_date', letter_valid_date='$letter_valid_date', renewal_year1='$renewal_year1', renewal_year2='$renewal_year2' where form_id='$form_id'") OR die("Error: ".$fire->error);	
	}			
		
	if($query){
		$formFunctions->insert_incomplete_forms('fire','11');
			echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'fire_form11.php?tab=2';
			</script>";
			
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'fire_form11.php?tab=1';
			</script>";
	}						
}
if(isset($_POST['submit11'])){
	 $file2=$_POST["mfile2"]; 
	
	if(empty($_POST["mfile2"]))
	{
		echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'fire_form11.php?tab=2';
			</script>";
	}else{
			
		$file2=clean($_POST["mfile2"]);$formFunctions->file_update($file2);
		
					
		$query=$fire->query("select form_id from fire_form11 where user_id='$swr_id' and active='1'") or die("Error :". $fire->error);
		if($query->num_rows<1){
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'fire_form11.php';
				</script>";
		}else{
			$form_id=$query->fetch_object()->form_id;
			$uain=$formFunctions->create_uain($form_id,'fire','11');
			$query2=$fire->query("select * from fire_form11 where form_id='$form_id'") or die("Error :". $fire->error);
			if($query2->num_rows >0){
				
				$save_query=$fire->query("update fire_form11 set file2='$file2',courier_details='' where form_id='$form_id'") or die($fire->error);
			  
			}			
			if($file2=="SC" ){
				$received_date="NULL";
				$save_query1=$fire->query("update fire_form11 set courier_details='1',sub_date='$today',received_date='$received_date' where form_id='$form_id'") or die($fire->error);
				
			}else{
				$courier_details="NULL";
				$save_query=$fire->query("update fire_form11 set courier_details='$courier_details',sub_date='$today',received_date='$today' where form_id='$form_id'") or die($fire->error);
			}			
			if($save_query==true ){
				
			echo "<script>
				alert('Successfully Submitted....');
				window.location.href = 'preview.php?token=11';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'fire_form11.php?tab=2';
				</script>";
			}		
		}
	}
}
if(isset($_POST["proceed11"])){
	
	$sql=$fire->query("select form_id,save_mode,courier_details from fire_form11 where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'fire_form11.php';
		</script>";
	}else{
	$row=$sql->fetch_array();
	$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];	
	$uain=$formFunctions->create_uain($form_id,'fire','11');
	if($save_mode=="D" && $courier_details==1){
			$save_query=$fire->query("update fire_form11 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($fire->error);
			if($save_query){
				
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=fire&form=11';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=11';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$formFunctions->updateSubmit($uain,$form_id);	
			$formFunctions->insert_applications($uain);
			$str=$formFunctions->getEmail_str($uain);
			/*----------------SEND MAIL-----------------*/
			$user_email=$formFunctions->get_usermail($swr_id);
			$dept_email="esgoa.fire@gmail.com";
			
			require_once "fire_form11_print.php"; 
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
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=11&dept=fire';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'fire_form11.php';
				</script>";
			}
		}else{
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=11';
				</script>";
		}
	}	
}
///////////form12 ends ///////////////////////////////////////////////////////////////

///////////////////////////form 13 starts///////////////////////////////////////////
if(isset($_POST['save12a'])){
		 $caller_no=$_POST["caller_no"];$caller_name=$_POST["caller_name"];$occured_date=$_POST["occured_date"];$ocured_time=$_POST["ocured_time"];
	     $fire_station=$_POST["fire_station"];$distance_fire=$_POST["distance_fire"];
		
			if(!empty($_POST["owner_address"])){
				$owner_address=json_encode($_POST["owner_address"]);
			}else{
				$owner_address="NULL";
			}
		
			if(!empty($_POST["place_occurrence"])){
				$place_occurrence=json_encode($_POST["place_occurrence"]);
			}else{
				$place_occurrence="NULL";
			}
		
		$sql=$fire->query("select form_id from fire_form12 where user_id='$swr_id' and active='1'");
	    $row=$sql->fetch_array();
		
		if($sql->num_rows<1){  ////////////table is empty//////////////
			
			$query=$fire->query("insert into fire_form12(user_id,sub_date,caller_no,caller_name,occured_date,ocured_time,fire_station,distance_fire,owner_address,place_occurrence) values ('$swr_id','$today', '$caller_no','$caller_name','$occured_date','$ocured_time','$fire_station','$distance_fire','$owner_address','$place_occurrence')") OR die("Error : ".$fire->error);		
			
	}else{  ////////////table is not empty//////////////
			$form_id=$row["form_id"];	
			$query=$fire->query("update fire_form12 set caller_name='$caller_name',caller_no='$caller_no',occured_date='$occured_date',ocured_time='$ocured_time',fire_station='$fire_station',owner_address='$owner_address',place_occurrence='$place_occurrence',distance_fire='$distance_fire' where form_id='$form_id'") or die("error:".$fire->error); 
	}			
		
	if($query){
		$formFunctions->insert_incomplete_forms('fire','12');
			echo "<script>
				alert('Successfully Saved..');
				window.location.href = 'fire_form12.php?tab=2';
			</script>";
			
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'fire_form12.php?tab=1';
			</script>";
	}						
}
	
if(isset($_POST['save12b'])){
            $descript_property=$_POST["descript_property"];$description=$_POST["description"];$property_insured=$_POST["property_insured"];$holding_no=$_POST["holding_no"];$insurance=$_POST["insurance"];$noc=$_POST["noc"];
				$property_uninsured=$_POST["property_uninsured"];$human_life=$_POST["human_life"];if(!empty($_POST["occupant_address"])){
			  $occupant_address=json_encode($_POST["occupant_address"]);}else{
				$occupant_address="NULL";
			 }
			 if(!empty($_POST["fire_desc"])){
			  $fire_desc=json_encode($_POST["fire_desc"]);
	
			 }else{
				$fire_desc="NULL";
			 }




		     $sql=$fire->query("select form_id from fire_form12 where user_id='$swr_id' and active='1'");
			$row=$sql->fetch_array();	
		    if($sql->num_rows<1){   
				
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'fire_form12.php';
				</script>";
				
		  }else{  
		$form_id=$row["form_id"];	
		  $update=$fire->query("update fire_form12 set description='$description',descript_property='$descript_property',property_insured='$property_insured',property_uninsured='$property_uninsured',human_life='$human_life',fire_desc='$fire_desc',occupant_address='$occupant_address',holding_no='$holding_no',insurance='$insurance',noc='$noc' where form_id='$form_id'") or die("error:".$fire->error);
		
	}	
	
	   if($update){
				echo "<script>
					alert('Successfully Saved..');
					window.location.href = 'fire_form12.php?tab=3';
				</script>";
				
		}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'fire_form12.php?tab=2';
				</script>";
		}						
}

if(isset($_POST["submit12"])) {		
		
	if(empty($_POST["mfile1"]) || empty($_POST["mfile2"]) || empty($_POST["mfile3"]))
	{
		echo "<script>
				alert('Error in file / You didnot select any option.');
				window.location.href = 'fire_form12.php?tab=3';
			</script>";
	}else{
			
		$file1=clean($_POST["mfile1"]);$file2=clean($_POST["mfile2"]);$file3=clean($_POST["mfile3"]);
		$formFunctions->file_update($file1);$formFunctions->file_update($file2);$formFunctions->file_update($file3);
		
					
		$query=$fire->query("select form_id from fire_form12 where user_id='$swr_id' and active='1'") or die("Error :". $fire->error);
		if($query->num_rows<1){
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'fire_form12.php';
				</script>";
		}else{
			$form_id=$query->fetch_object()->form_id;
			$uain=$formFunctions->create_uain($form_id,'fire','12');
			$query2=$fire->query("select * from fire_form12 where form_id='$form_id'") or die("Error :". $fire->error);
			if($query2->num_rows>0){
				
				$save_query=$fire->query("update fire_form12 set file1='$file1',file2='$file2',file3='$file3' where form_id='$form_id'") or die($fire->error);
			 
			}
			
			if($file1=="SC" || $file2=="SC" ||  $file3=="SC"  ){
					$received_date="NULL";
					$save_query=$fire->query("update fire_form12 set courier_details='1',sub_date='$today',received_date='$received_date' where form_id='$form_id'") or die($fire->error);
					
				}else{
					$courier_details="NULL";
				$save_query=$fire->query("update fire_form12 set courier_details='$courier_details',sub_date='$today',received_date='$today' where form_id='$form_id'") or die($fire->error);
				}
			if($save_query ){
			
			
			echo "<script>
				alert('Successfully Submitted....');
				window.location.href = 'preview.php?token=12';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'fire_form12.php?tab=3';
				</script>";
			}		
		}
	}
}

if(isset($_POST["proceed12"])){
	
	$sql=$fire->query("select form_id,save_mode,courier_details from fire_form12 where user_id='$swr_id' and active='1'");		
	if($sql->num_rows<1){				
		echo "<script>
			alert('Please fill the first part of the form.');
			window.location.href = 'fire_form12.php';
		</script>";
	}else{
	$row=$sql->fetch_array();
	$form_id=$row["form_id"];$save_mode=$row["save_mode"];$courier_details=$row["courier_details"];	
	$uain=$formFunctions->create_uain($form_id,'fire','12');
	if($save_mode=="D" && $courier_details==1){
			$save_query=$fire->query("update fire_form12 set sub_date='$today',uain='$uain',save_mode='F' where form_id='$form_id'") or die($fire->error);
			if($save_query){
				
				echo "<script>
					alert('Successfully Saved.');
					window.location.href = '../../requires/courier_details.php?dept=fire&form=12';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=12';
				</script>";
			}
		}else if($save_mode=="D" && $courier_details==""){
			$save_query=$formFunctions->updateSubmit($uain,$form_id);	
			$formFunctions->insert_applications($uain);
			$str=$formFunctions->getEmail_str($uain);
			/*----------------SEND MAIL-----------------*/
			$user_email=$formFunctions->get_usermail($swr_id);
			$dept_email="esgoa.fire@gmail.com";
			
			require_once "fire_form12_print.php"; 
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
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=12&dept=fire';
				</script>";
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'fire_form12.php';
				</script>";
			}
		}else{
			echo "<script>
					alert('Something went wrong !!!');
					window.location.href = 'preview.php?token=12';
				</script>";
		}
	}	
}
?>