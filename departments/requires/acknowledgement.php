<?php    require_once "login_session.php";
$ci->load->helper('get_uain_details');
if(isset($_GET["form"]) && is_numeric($_GET["form"]) && $_GET["form"]>0 && isset($_GET["dept"]) && strlen($_GET["dept"])>0 && !preg_match('/[^A-Za-z]/', $_GET["dept"])){
	$_SESSION["dept"]=$dept=$_GET["dept"];
	$_SESSION["form"]=$form=$_GET["form"];

	$_SESSION["table_name"]=$table_name=getTableName($dept,$form);
	$_SESSION["sub_dept_id"]=$sub_dept_id=$formFunctions->get_sub_dept_id($dept);
	
	
	//Check for form status
	require_once "check_form_save_mode.php";
	$get_file_name=basename(__FILE__);

	
	
}else{
	echo "<script>
				alert('Invalid Page Access !!!');
				window.location.href = '".$server_url."user_area/';
		</script>";	
}


$form=$_GET["form"];$dept=$_GET["dept"];
$form_name=$formFunctions->get_formName($dept,$form);
if($dept=="fire" && $form!=11 && $form!=12){
	$form_name="FORM OF APPLICATION FOR 'NO OBJECTION CERTIFICATE (NOC)' IN RESPECT OF FIRE SAFETY MEASURES IN ".$form_name." , ASSAM FIRE SAFETY SERVICE RULES, 1989";
}
//$dept_name=$formFunctions->get_deptName($dept);	
$query="select uain from ".$table_name." where user_id='$swr_id' and save_mode='C' and active='1' ORDER BY form_id DESC LIMIT 1";
$uains=$formFunctions->executeQuery($dept,$query);
$uain=$uains->fetch_object()->uain;		


?>
<?php require_once "header.php"; ?>
	  
		<div class="content-wrapper">
			<section class="content-header">
				
			</section>
			<section class="content">
			<?php require 'banner.php'; ?>
			<div class="row">
				<div class="col-md-12">
					<div class="box box-primary">
						<div class="row">
							<div class="col-md-8 col-md-offset-2">
								<h3 class="text-center">Acknowledgement</h3>
								<div class="well well-sm">
									<p class="text-center"><i style="color:#00A65A" class="fa fa-2x fa-check-square"></i></p>
									<p class="text-center"> <strong>Your <?php echo strtoupper($form_name); ?> has been submitted successfully to <?php echo strtoupper($dept_array["dept_name"])." , ".strtoupper($b_dist);?> , Assam.</strong></p>
								</div>
								<p class="text-center">Your <b>Unique Application Identification Number (UAIN)</b> is <b><?php echo $uain; ?></b></p>
								<p><a href="pdf_with_acknowledgement.php?uain=<?php echo $uain; ?>" target="_blank" >Click here</a> to take the print out of your application with your final acknowledgement receipt.</p>
								<p>You may track your application by entering this UAIN in the 'Track Your Application' search box or clicking on 'My Applications' in the dashboard. For any further query or help, you may contact us on our helpline number +91 70860 44425 and/or email us at eodb.assam@gmail.com.</p>
								<p align="justify"><b>Disclaimer : This is a computed generated acknowledgement, which is subject to granting of the final approval from the concerned authority. This acknowledgement should not be treated as the approval or its substitute for the purpose of any other application and/or approval. The concerned authority holds no responsibility if any other approvals are granted based on this acknowledgement.</b></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php require_once "../../views/users/requires/footer.php"; ?>
<?php require 'js.php' ?>
