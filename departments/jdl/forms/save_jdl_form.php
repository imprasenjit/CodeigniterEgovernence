<?php
if(isset($_POST["save1a"])){
	$total_value=$_POST["hiddenval1"];
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	
	if($sql->num_rows<1){   ////////////table is empty//////////////

		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id) values('$swr_id')");
        $form_id=$query;
        //$formFunctions->insert_incomplete_forms($dept,$form);	
		
	}else{
        $row=$sql->fetch_assoc();
		$form_id=$row["form_id"];
        
	
	if($form_id>0){
		
		//$total_value=$_POST["hiddenval1"];
		if($total_value!=0){				
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_petitioner where form_id='$form_id'");
			
			for($i=1;$i<$total_value;$i++){
            
				$peti_type=$_POST["peti_type".$i];	
				$peti_is=$_POST["peti_is".$i];
				$peti_name=$_POST["peti_name".$i];
				$peti_dob=$_POST["peti_dob".$i];
				$peti_nationality=$_POST["peti_nationality".$i];
				$peti_gender=$_POST["peti_gender".$i];
				$peti_caste=$_POST["peti_caste".$i];
				$peti_father_name=$_POST["peti_father_name".$i];
				$peti_mother_name=$_POST["peti_mother_name".$i];
				$peti_address=$_POST["peti_address".$i];	
				$peti_state=$_POST["peti_state".$i];	
				$peti_dist=$_POST["peti_dist".$i];	
				$peti_pin=$_POST["peti_pin".$i];
				$law_reg_no=$_POST["law_reg_no".$i];	
				$peti_occu=$_POST["peti_occu".$i];	
				$peti_email=$_POST["peti_email".$i];	
				$peti_mobile=$_POST["peti_mobile".$i];		
				
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_petitioner(form_id,peti_type,peti_is,peti_name,peti_dob,peti_nationality,peti_gender,peti_caste,peti_father_name,peti_mother_name,peti_address,peti_state,peti_dist,peti_pin,law_reg_no,peti_occu,peti_email,peti_mobile) VALUES ('$form_id','$peti_type','$peti_is','$peti_name','$peti_dob','$peti_nationality','$peti_gender','$peti_caste','$peti_father_name','$peti_mother_name','$peti_address','$peti_state','$peti_dist','$peti_pin','$law_reg_no','$peti_occu','$peti_email','$peti_mobile')");
			}
		}
        
	
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
}
if(isset($_POST["save1b"])){
    $total_value=$_POST["hiddenval2"];
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	
	if($sql->num_rows<1){   ////////////table is empty//////////////

		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id) values('$swr_id')");
        $form_id=$query;
		//$formFunctions->insert_incomplete_forms($dept,$form);
	}else{
		
		$row=$sql->fetch_assoc();
		$form_id=$row["form_id"];
	
	if($form_id>0){
		
		//$total_value=$_POST["hiddenval2"];
		if($total_value!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_respondent where form_id='$form_id'");
			
			
			for($i=1;$i<$total_value;$i++){
            //$peti_type=$_POST["peti_type".$i];	
				$resp_type=$_POST["resp_type".$i];	
				$resp_is=$_POST["resp_is".$i];
				$resp_name=$_POST["resp_name".$i];
				$resp_age=$_POST["resp_age".$i];
				$resp_father_name=$_POST["resp_father_name".$i];
				$resp_mother_name=$_POST["resp_mother_name".$i];
				$resp_address=$_POST["resp_address".$i];
				$resp_state=$_POST["resp_state".$i];
				$resp_dist=$_POST["resp_dist".$i];
				$resp_pin=$_POST["resp_pin".$i];	
				$resp_occu=$_POST["resp_occu".$i];	
				$resp_email=$_POST["resp_email".$i];
				$resp_mobile=$_POST["resp_mobile".$i];
				$resp_law_reg_no=$_POST["resp_law_reg_no".$i];	
				$resp_nationality=$_POST["resp_nationality".$i];	
				$resp_gender=$_POST["resp_gender".$i];	
				$resp_caste=$_POST["resp_caste".$i];		
				
				$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_respondent(form_id,resp_type,resp_is,resp_name,resp_age,resp_father_name,resp_mother_name,resp_address,resp_state,resp_dist,resp_pin,resp_law_reg_no,resp_occu,resp_email,resp_mobile,resp_nationality,resp_gender,resp_caste) VALUES ('$form_id','$resp_type','$resp_is','$resp_name','$resp_age','$resp_father_name','$resp_mother_name','$resp_address','$resp_state','$resp_dist','$resp_pin','$resp_law_reg_no','$resp_occu','$resp_email','$resp_mobile','$resp_nationality','$resp_gender','$resp_caste')");
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
	
}	
	
		
?>