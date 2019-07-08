<?php require_once "../../requires/login_session.php";

$indus_land=$_POST['indus_land'];
$authority_result = $formFunctions->executeQuery("dicc","SELECT Agency FROM LandBank WHERE Name_of_the_infrastructure_with_location ='$indus_land'"); 
$row_authority=$authority_result->fetch_object();
$authority=$row_authority->Agency;
	if($authority=="AIDC"){
		$authority_name = "Assam Industrial Development Corporation Limited";
	}elseif($authority=="AIIDC"){
		$authority_name = "Assam Industrial Infrastructure Development Corporation Limited";
	}elseif($authority=="ASIDC"){
		$authority_name = "Assam Small Industries Development Corporation Limited";
	}elseif($authority=="DICC"){
		$authority_name = "District Industries & Commerce Center";
	}else{
	}
?>
<td width="25%"><input type="text" class="form-control text-uppercase" name="authority_name" value="<?=strtoupper($authority_name);?>" readonly="readonly">
<input type="hidden" class="form-control text-uppercase" name="authority" value="<?=strtoupper($authority);?>" readonly="readonly">
</td>