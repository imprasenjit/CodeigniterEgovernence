<?php 
    if(isset($_POST["save18"])){
	$input_size1=$_POST["hiddenval1"];$regn_no=clean($_POST["regn_no"]);
	$date_regno=clean($_POST["date_regno"]);
	$nature_busi=clean($_POST["nature_busi"]);$post_office=clean($_POST["post_office"]);$police_station=clean($_POST["police_station"]);
	
    $sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();		
	if($sql->num_rows<1){   ////////////table is empty//////////////			
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,regn_no,date_regno,nature_busi,post_office,police_station) values ('$swr_id','$today','$regn_no','$date_regno','$nature_busi','$post_office','$police_station')");	
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',regn_no='$regn_no',date_regno='$date_regno',nature_busi='$nature_busi',post_office='$post_office',police_station='$police_station' where form_id='$form_id'");
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
					
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,sl_no,name_member,address,occupation,designation) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}
		
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
?>