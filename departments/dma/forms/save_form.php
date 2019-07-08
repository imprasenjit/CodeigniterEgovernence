<?php
if(isset($_POST["save1a"])){		
	$from_year=$_POST["from_year"];$ulb=$_POST["ulb"];$to_year=$_POST["to_year"];$family_name=$_POST["family_name"];$dob=$_POST["dob"];$owner_age=$_POST["owner_age"];	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' order by form_id desc LIMIT 1");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){			
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,ulb,from_year,to_year,family_name,dob,owner_age) values ('$swr_id','$ulb','$from_year','$to_year','$family_name','$dob','$owner_age')");	
	}else{				
			$form_id=$row["form_id"];				
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set from_year='$from_year',ulb='$ulb',to_year='$to_year',family_name='$family_name', dob='$dob',owner_age='$owner_age' where form_id='$form_id'");	
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
if(isset($_POST["save1b"])){		
	$premises=$_POST["premises"];$godown=$_POST["godown"];			
	if(!empty($_POST["premises_details"])) $premises_details=json_encode($_POST["premises_details"]);
	else $premises_details=NULL;
	if(!empty($_POST["godown_details"])) $godown_details=json_encode($_POST["godown_details"]);
	else $godown_details=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' order by form_id desc LIMIT 1");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){			
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(premises,premises_details,godown,godown_details) values ('$premises','$premises_details','$godown','$godown_details')");
	}else{				
			$form_id=$row["form_id"];				
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set premises='$premises',premises_details='$premises_details',godown='$godown',godown_details='$godown_details' where form_id='$form_id'");		
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
if(isset($_POST["save1c"])){		
	$old_trade=$_POST["old_trade"];	
	if(!empty($_POST["old_trade_details"]))	 $old_trade_details=json_encode($_POST["old_trade_details"]);
	else	$old_trade_details=NULL;	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' order by form_id desc LIMIT 1");
	$row=$sql->fetch_array();
			
	if($sql->num_rows<1){			
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,old_trade,old_trade_details) values ('$swr_id','$old_trade', '$old_trade_details')");				
	}else{				
		$form_id=$row["form_id"];				
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set old_trade='$old_trade', old_trade_details='$old_trade_details' where form_id='$form_id'");			
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
if(isset($_POST["save1d"])){	
	$annual_income=$_POST["annual_income"];$it_payable=$_POST["it_payable"];$license_type=$_POST["license_type"];
	$sql=$formFunctions->executeQuery($dept,"select form_id,from_year,premises,old_trade from ".$table_name." where user_id='$swr_id' order by form_id desc LIMIT 1");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){			
		echo "<script>
				alert('Invalid Entry, please fill up all the parts of the form');
				window.location.href = '".$table_name.".php';
			</script>";				
	}else{
		$form_id=$row["form_id"];				
		if(!empty($row["from_year"]) && !empty($row["premises"]) && !empty($row["old_trade"]))
		{
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set annual_income='$annual_income', it_payable='$it_payable', license_type='$license_type' where form_id='$form_id'");	
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
		}else{
			echo "<script>
						alert('Please Fill Up all the parts of the form');
						window.location.href = '".$table_name.".php';
					</script>";		
		}						
	}		
}
if(isset($_POST["save2"])){		
	$father_name=$_POST["father_name"];$road_name=$_POST["road_name"];$cons_year=$_POST["cons_year"];$w_pipe=$_POST["w_pipe"];$build_use=$_POST["build_use"];$l_area=$_POST["l_area"];$dag_no=$_POST["dag_no"];$patta_no=$_POST["patta_no"];$l_vill=$_POST["l_vill"];$mouza=$_POST["mouza"];$hold_no=$_POST["hold_no"];$old_arv=$_POST["old_arv"];$b_owner_name=$_POST["b_owner_name"];
	if(!empty($_POST["plinth"]))	 $plinth=json_encode($_POST["plinth"]);
	else	$plinth=NULL;
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){			
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,father_name,road_name,plinth,cons_year,w_pipe,build_use,l_area,dag_no,patta_no,l_vill,mouza,hold_no,old_arv,b_owner_name) values ('$swr_id','$father_name','$road_name','$plinth','$cons_year','$w_pipe','$build_use','$l_area','$dag_no','$patta_no','$l_vill','$mouza','$hold_no','$old_arv','$b_owner_name')");	
	}else{				
		$form_id=$row["form_id"];				
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set father_name='$father_name', road_name='$road_name',plinth='$plinth',cons_year='$cons_year',w_pipe='$w_pipe',build_use='$build_use',l_area='$l_area' ,dag_no='$dag_no' ,patta_no='$patta_no' ,l_vill='$l_vill',mouza='$mouza',hold_no='$hold_no',old_arv='$old_arv',b_owner_name='$b_owner_name' where form_id='$form_id'") ;	
	}
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form);
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
	$holding_no=$_POST["holding_no"];$power=$_POST["power"];
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){			
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,holding_no,power) values ('$swr_id','$holding_no','$power')");	
	}else{				
			$form_id=$row["form_id"];				
			$query=$formFunctions->executeQuery($dept,"update ".$table_name." set holding_no='$holding_no', power='$power' where form_id='$form_id'") ;	
	}
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
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