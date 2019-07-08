<?php require_once "../../requires/login_session.php";

$dicc_district=$_POST['dicc_district'];
$indus_land_result=$formFunctions->executeQuery("dicc","SELECT Name_of_the_infrastructure_with_location FROM LandBank WHERE district_id ='$dicc_district'"); ?>
<select name="indus_land" id="indus_land" onchange="select_infra()" class="form-control text-uppercase" required="required">
	<option value="">Please Select</option>
	<?php  
		if($indus_land_result->num_rows>0){
			while($rows_land=$indus_land_result->fetch_object()) {
				if(isset($indus_land) && ($indus_land==$rows_land->Name_of_the_infrastructure_with_location)){
					$s='selected'; 
				}else{
					$s='';
				}  ?>
			<option value="<?php echo $rows_land->Name_of_the_infrastructure_with_location; ?>" <?php echo $s;?>><?php echo $rows_land->Name_of_the_infrastructure_with_location; ?></option>
	<?php 	}	
		}else{
	?>
		<option value="">Not Found!!!</option>
	<?php
		}
	?>
</select>