<?php
if(isset($_POST["save1"])){		
	$fac_situation=clean($_POST["fac_situation"]);$province=clean($_POST["province"]);$vill3=clean($_POST["vill3"]);$dist3=clean($_POST["dist3"]);$pin3=clean($_POST["pin3"]);$m_no=clean($_POST["m_no"]);$n_rail_station=clean($_POST["n_rail_station"]);$particulars=clean($_POST["particulars"]);$is_hazardous=clean($_POST["is_hazardous"]);
	
	$sql=$factory->query("select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$factory->query("insert into ".$table_name."(user_id,sub_date,fac_situation,province,vill3,dist3,pin3,m_no,n_rail_station,particulars,is_hazardous) values ('$swr_id','$today', '$fac_situation', '$province', '$vill3','$dist3', '$pin3', '$m_no', '$n_rail_station', '$particulars','$is_hazardous')") OR die("Error : ".$factory->error);
	}else{
		$form_id=$row["form_id"];	
		$query=$factory->query("update ".$table_name." set sub_date='$today',fac_situation='$fac_situation',province='$province', vill3='$vill3',dist3='$dist3', pin3='$pin3',m_no='$m_no',n_rail_station='$n_rail_station',particulars='$particulars',is_hazardous='$is_hazardous' where form_id=$form_id") OR die("Error : ".$factory->error);	
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		if($is_hazardous=="Y"){
			echo "<script>
			alert('Successfully Saved..');
			window.location.href = 'factory_form3.php';
		</script>";	
		}else{
			echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
		}
				
	}else{
		   echo "<script>
		   alert('Invalid Entry');
		   window.location.href = '".$table_name.".php';
		</script>";
	}							
}

if(isset($_POST["save2a"])){
            
            $risk_category=clean($_POST["risk_category"]);			
			
			if(!empty($_POST["manuf_process"])) $manuf_process=json_encode($_POST["manuf_process"]);
			else $manuf_process=NULL;
			if(!empty($_POST["manuf_prod"])) $manuf_prod=json_encode($_POST["manuf_prod"]);
			else $manuf_prod=NULL;
			
			if(!empty($_POST["power"]))	 $power=json_encode($_POST["power"]);
			else	$power=NULL;
			
			if(!empty($_POST["manager"]))	 $manager=json_encode($_POST["manager"]);
			else	$manager=NULL;
			
			if(!empty($_POST["communication_address"]))	 $communication_address=json_encode($_POST["communication_address"]);
			else	$communication_address=NULL;
			
			$sql=$factory->query("select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
			$row=$sql->fetch_array();
			
		if($sql->num_rows == 0){   ////////////table is empty//////////////
			$query=$factory->query("insert into ".$table_name."(user_id,sub_date,communication_address,manuf_process,manuf_prod,power,manager,risk_category) values ('$swr_id','$today','$communication_address','$manuf_process','$manuf_prod', '$power', '$manager','$risk_category')") OR die("Error: ".$factory->error);				
		}else{
			$form_id=$row["form_id"];	
			$query=$factory->query("update ".$table_name." set sub_date='$today',communication_address='$communication_address',  manuf_process='$manuf_process', manuf_prod='$manuf_prod', power='$power', manager='$manager',risk_category='$risk_category' where form_id=$form_id") OR die("Error: ".$factory->error);
		}
	if($query){
		$formFunctions->insert_incomplete_forms('factory','2'); //factory-- dept name and 2 -- form no 
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
if(isset($_POST["save2b"])){	
			
			if(!empty($_POST["owner"]))	 $owner=json_encode($_POST["owner"]);
			else	$owner=NULL;
			
			if(!empty($_POST["ref_no"]))	 $ref_no=json_encode($_POST["ref_no"]);
			else	$ref_no=NULL;
			
			$managing_agents=clean($_POST['managing_agents']);
			$cah=clean($_POST["cah"]);
			
			$sql=$factory->query("select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
			$row=$sql->fetch_array();
			
		if($sql->num_rows<1){   ////////////table is empty//////////////				
				$query=$factory->query("insert into ".$table_name."(user_id,sub_date,managing_agents,cah,owner,ref_no) values ('$swr_id','$today','$managing_agents','$cah','$owner','$ref_no')") OR die("Error: ".$factory->error);
		}else{  ////////////table is not empty//////////////
				$form_id=$row["form_id"];	
				$query=$factory->query("update ".$table_name." set sub_date='$today',managing_agents='$managing_agents',cah='$cah',owner='$owner',ref_no='$ref_no' where user_id='$swr_id' and form_id=$form_id") OR die("Error: ".$factory->error);				
			}
	if($query){
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

if(isset($_POST["save3a"])) {
	
	if(!empty($_POST["ownership_data"])) $ownership_data=json_encode($_POST["ownership_data"]);
	else $ownership_data=NULL;
	if(!empty($_POST["site_plan"]))	 $site_plan=json_encode($_POST["site_plan"]);
	else	$site_plan=NULL;
	if(!empty($_POST["project_report"])) $project_report=json_encode($_POST["project_report"]);
	else $project_report=NULL;
	if(!empty($_POST["org_structure"]))	 $org_structure=json_encode($_POST["org_structure"]);
	else	$org_structure=NULL;
	if(!empty($_POST["supply"]))	 $supply=json_encode($_POST["supply"]);
	else	$supply=NULL;
	$sql=$factory->query("select * from factory_form3 where form_id='$form_id'");			
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$factory->query("insert into factory_form3(form_id,ownership_data,site_plan,project_report,org_structure,supply) values ('$form_id', '$ownership_data', '$site_plan', '$project_report', '$org_structure', '$supply')") OR die("Error: ".$factory->error);
	}else{  ////////////table is not empty//////////////	
		$query=$factory->query("update factory_form3 set ownership_data='$ownership_data', site_plan='$site_plan', project_report='$project_report', org_structure='$org_structure', supply='$supply' where form_id=$form_id") OR die("Error: ".$factory->error);				
	}
	if($query){
		$formFunctions->insert_incomplete_forms('factory','3'); //factory-- dept name and 3 -- form no 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = 'factory_form3.php?tab=2';
		</script>";
		
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = 'factory_form3.php?tab=1';
		</script>";
	}	
		
}
if(isset($_POST["save3b"])){
		$form_id=$factory->query("select form_id from factory_form1 where user_id='$swr_id' and active='1'")->fetch_object()->form_id;
		$other_info=clean($_POST["other_info"]);
		if(!empty($_POST["comm_link"]))	$comm_link=json_encode($_POST["comm_link"]);
		else	$comm_link=NULL;		
		$sql=$factory->query("select * from factory_form3 where form_id='$form_id'");
		$row=$sql->fetch_array();
		if($sql->num_rows<1){				
				$query=$factory->query("insert into factory_form3(form_id,other_info,comm_link) values ('$form_id','$other_info','$comm_link')") OR die("Error: ".$factory->error);
		}else{			
				$query=$factory->query("UPDATE factory_form3 SET other_info='$other_info', comm_link='$comm_link' WHERE form_id='$form_id'") OR die("Error: ".$factory->error);
		}
		if($query){
		 echo "<script>
		   alert('Successfully Saved.');
		   window.location.href = 'factory_form3.php?tab=3';
		</script>";					
	  }else{
		   echo "<script>
		   alert('Invalid Entry');
		   window.location.href = 'factory_form3.php?tab=2';
		</script>";
	}	
			
}
if(isset($_POST["submit3"])){		

	if(empty($_POST["mfile1"]) || empty($_POST["mfile2"]) || empty($_POST["mfile3"]) || empty($_POST["mfile4"]) || empty($_POST["mfile5"]) || empty($_POST["mfile6"]) || empty($_POST["mfile7"]) || empty($_POST["mfile8"]) || empty($_POST["mfile9"]) || empty($_POST["mfile10"]) || empty($_POST["mfile11"]) || empty($_POST["mfile12"]) || $_POST["mfile1"]=='2' || $_POST["mfile2"]=='2' || $_POST["mfile3"]=='2' || $_POST["mfile4"]=='2' || $_POST["mfile5"]=='2' || $_POST["mfile6"]=='2' || $_POST["mfile7"]=='2' || $_POST["mfile8"]=='2' || $_POST["mfile9"]=='2' || $_POST["mfile10"]=='2' || $_POST["mfile11"]=='2' || $_POST["mfile12"]=='2' || $_POST["mfile1"]=='3' || $_POST["mfile2"]=='3' || $_POST["mfile3"]=='3' || $_POST["mfile4"]=='3' || $_POST["mfile5"]=='3' || $_POST["mfile6"]=='3' || $_POST["mfile7"]=='3' || $_POST["mfile8"]=='3' || $_POST["mfile9"]=='3' || $_POST["mfile10"]=='3' || $_POST["mfile11"]=='3' || $_POST["mfile12"]=='3'){
		echo "<script>
			alert('Error in file / You didnot select any option.');
			window.location.href = 'factory_form3.php?tab=3';
		</script>";
	}else{
		
		$file1=clean($_POST["mfile1"]);$file2=clean($_POST["mfile2"]);$file3=clean($_POST["mfile3"]);$file4=clean($_POST["mfile4"]);$file5=clean($_POST["mfile5"]);$file6=clean($_POST["mfile6"]);$file7=clean($_POST["mfile7"]);$file8=clean($_POST["mfile8"]);$file9=clean($_POST["mfile9"]);$file10=clean($_POST["mfile10"]);$file11=clean($_POST["mfile11"]);$file12=clean($_POST["mfile12"]);
		
		$query=$factory->query("select * from factory_form3_upload where form_id=$form_id") or die("Error : ". $factory->error);
		$result=$query->fetch_array();
		$count=$query->num_rows;			
		if($count>0){
			$save_query=$factory->query("update factory_form3_upload set file1='$file1',file2='$file2',file3='$file3', file4='$file4',file5='$file5',file6='$file6',file7='$file7', file8='$file8',file9='$file9',file10='$file10',file11='$file11',file12='$file12' where form_id='$form_id'") or die($factory->error);
		}else{
			$save_query=$factory->query("insert into factory_form3_upload values('','$form_id','$file1','$file2','$file3','$file4','$file5','$file6','$file7','$file8','$file9','$file10','$file11','$file12')") or die($factory->error);
		}
		if($file1=="SC" || $file2=="SC" ||  $file3=="SC" ||  $file4=="SC" ||  $file5=="SC" || $file6=="SC" ||  $file7=="SC" ||  $file8=="SC" ||  $file9=="SC" ||  $file10=="SC" ||  $file11=="SC" ||  $file12=="SC"){
			$query="update factory_form1 set sub_date='$today',courier_details='1' where form_id='$form_id'";
			$save_query2=$factory->query($query) or die($factory->error);
		}
		
		if($save_query){
				echo "<script>
				alert('Successfully Saved....');
				window.location.href = '../../requires/upload_section.php?dept=factory&form=1';
				</script>";
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = 'factory_form3.php?tab=3';
			</script>";
		}
	}
}
if(isset($_POST["save4a"])){		
		$license_no=clean($_POST["license_no"]);
		$risk_category=clean($_POST["risk_category"]);	
		if(!empty($_POST["communication_address"])) $communication_address=json_encode($_POST["communication_address"]);
		else $communication_address=NULL;
		if(!empty($_POST["manuf_process"])) $manuf_process=json_encode($_POST["manuf_process"]);
		else $manuf_process=NULL;
		if(!empty($_POST["manuf_prod"])) $manuf_prod=json_encode($_POST["manuf_prod"]);
		else $manuf_prod=NULL;			
		if(!empty($_POST["power"]))	 $power=json_encode($_POST["power"]);
		else	$power=NULL;			
		if(!empty($_POST["manager"]))	 $manager=json_encode($_POST["manager"]);
		else	$manager=NULL;
		
		$sql=$factory->query("select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
		$row=$sql->fetch_array();
			
		if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$factory->query("insert into ".$table_name."(user_id,sub_date,license_no,communication_address,manuf_process,manuf_prod,power,manager,risk_category) values ('$swr_id','$today', '$license_no','$communication_address','$manuf_process', '$manuf_prod', '$power', '$manager','$risk_category')") OR die("Error: ".$factory->error);				
		}else{
			$form_id=$row["form_id"];	
			$query=$factory->query("update ".$table_name." set sub_date='$today', license_no='$license_no', communication_address='$communication_address', manuf_process='$manuf_process', manuf_prod='$manuf_prod', power='$power', manager='$manager',risk_category='$risk_category' where form_id=$form_id") OR die("Error: ".$factory->error);
		}
			if($query){
					$formFunctions->insert_incomplete_forms($dept,$form); //factory-- dept name and 2 -- form no
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
			
			if(!empty($_POST["owner"]))	 $owner=json_encode($_POST["owner"]);
			else	$owner=NULL;
			
			if(!empty($_POST["ref_no"]))	 $ref_no=json_encode($_POST["ref_no"]);
			else	$ref_no=NULL;
			$managing_agents=clean($_POST['managing_agents']);
			$cah=clean($_POST['cah']);
			$sql=$factory->query("select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
			$row=$sql->fetch_array();
			
		if($sql->num_rows<1){   ////////////table is empty//////////////				
				$query=$factory->query("insert into ".$table_name."(user_id,sub_date,managing_agents,cah,owner,ref_no) values ('$swr_id','$today','$managing_agents','$cah','$owner','$ref_no')") OR die("Error: ".$factory->error);
		}else{  ////////////table is not empty//////////////
				$form_id=$row["form_id"];	
				$query=$factory->query("update ".$table_name." set sub_date='$today',managing_agents='$managing_agents',cah='$cah',owner='$owner',ref_no='$ref_no' where user_id='$swr_id' and form_id=$form_id") OR die("Error: ".$factory->error);				
			}
	if($query){
		
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