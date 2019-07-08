<?php
if(isset($_POST["saveretention"])){	
	$prev_licno=clean($_POST["prev_licno"]);$prev_date=clean($_POST["prev_date"]);
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
	    $query=$formFunctions->executeQuery($dept,"insert into ".$table_name."(user_id,sub_date,prev_licno,prev_date) values ('$swr_id','$today','$prev_licno','$prev_date')");
		$form_id=$sdc->insert_id;
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',prev_licno='$prev_licno',prev_date='$prev_date' where form_id=$form_id");
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