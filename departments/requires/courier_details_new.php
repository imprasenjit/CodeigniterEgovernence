<?php  require_once "login_session.php";
if(isset($_POST["submit"])){
	if(isset($_SESSION["dept"]) || isset($_SESSION["form"]) || $_SESSION["dept"]!="" || $_SESSION["form"]!=""){
		$dept=$_SESSION["dept"];
		$form=$_SESSION["form"];
	}else{
   
		echo "<script>
				alert('Something went wrong !!! Please try again');
				window.location.href = '".$server_url."user_area/';
		</script>";	
	}	
	
	$table_name=$formFunctions->getTableName($dept,$form);
	$sub_dept_id=$formFunctions->get_sub_dept_id($dept);
	
	if(!empty($_POST["courier_details"])){
		if($_POST["courier_details"]["cn"]=="O"){
			$_POST["courier_details"]["cn"]="Others - " . $_POST["courier_service_others"];
		}
		$courier_details=json_encode($_POST["courier_details"]);
		
	}else{
		echo "<script>
			alert('Please enter courier details !!!');
			window.location.href = '".$server_url."departments/requires/courier_details_new.php?dept=".$dept."&form=".$form."';
		</script>";
	}
	if(($dept=="cei" && ($form==3 || $form==6 || $form==7 || $form==8 || $form==10 || $form==11 || $form==12 || $form==13 || $form==14 || $form==15 || $form==16 || $form==25 || $form==26 || $form==27 || $form==28)) || ($dept=="sdc" && ($form==20 || $form==54 || $form==58))){
		$query="select form_id,save_mode,uain,user_id from ".$table_name." where user_id='$swr_id' and active='1' and save_mode='F' ORDER BY form_id DESC LIMIT 1";
	}else{
		$query="select form_id,save_mode,uain,user_id from ".$table_name." where user_id='$swr_id' and active='1' and save_mode='F'";
	}
	
	
	$saveQuery=$formFunctions->executeQuery($dept,$query);
	
	if($saveQuery->num_rows>0){
		
		$rows=$saveQuery->fetch_object();
		$form_id=$rows->form_id;$save_mode=$rows->save_mode;$uain=$rows->uain;$user_id=$rows->user_id;
		
		$update_query="update ".$table_name." set courier_details='$courier_details' where user_id='$swr_id' and form_id='$form_id' and active='1'";				
		$updateQuery=$formFunctions->executeQuery($dept,$update_query);
		if($updateQuery){	
			echo "<script>window.location.href = '".$server_url."departments/requires/final_submit.php';</script>";			
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$server_url."departments/requires/courier_details_new.php?dept=".$dept."&form=".$form."';
			</script>";
		}		
	}else{
    
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '../../user_area/';
		</script>";
	}
}
if(isset($_GET["form"]) && is_numeric($_GET["form"]) && $_GET["form"]>0 && isset($_GET["dept"]) && strlen($_GET["dept"])>0 && !preg_match('/[^A-Za-z]/', $_GET["dept"])){

	
	$_SESSION["dept"]=$dept=$_GET["dept"];
	$_SESSION["form"]=$form=$_GET["form"];
	
	$_SESSION["table_name"]=$table_name=$formFunctions->getTableName($dept,$form);
	$_SESSION["sub_dept_id"]=$sub_dept_id=$formFunctions->get_sub_dept_id($dept);
	
	require_once "check_form_save_mode.php";
	
	$table_name=$formFunctions->getTableName($dept,$form);
	$query="select save_mode from ".$table_name." where user_id='$swr_id' and active='1' and save_mode='F' ORDER BY form_id DESC LIMIT 1";
	$saveQuery=$formFunctions->executeQuery($dept,$query);
	if($saveQuery->num_rows>0){
		$save_mode=$saveQuery->fetch_object()->save_mode;
		if($save_mode=="C"){
			echo "<script>
				alert('Invalid page access !!!');
				window.location.href = '../../user_area/';
			</script>";
		}
	}else{
		echo "<script>
			alert('Invalid page access !!!');
			window.location.href = '../../user_area/';
		</script>";
	}
	/**   ******** OFFICE ADDRESS ********/
	if($dept=="gmc"){
		$query_results=$formFunctions->executeQuery("dicc","select b_block from singe_window_registration where id='$swr_id'");
		if($query_results->num_rows>0){
			$jurisdiction_parameter=$query_results->fetch_object()->b_block;
		}else{
			$jurisdiction_parameter="";
		}			
	}else if($dept=="revenue"){
		$query_results=$formFunctions->executeQuery("dicc","select revenue from singe_window_registration_part1 where swr_id='$swr_id'");
		if($query_results->num_rows>0){
			$jurisdiction_parameter=$query_results->fetch_object()->revenue;
		}else{
			$jurisdiction_parameter="";
		}	
	}else if($dept=="tourism"){
		$query_results=$formFunctions->executeQuery("dicc","select b_block from singe_window_registration where id='$swr_id'");
		if($query_results->num_rows>0){
			$jurisdiction_parameter=$query_results->fetch_object()->b_block;
		}else{
			$jurisdiction_parameter="";
		}
	}else{
		
		$query_results=$formFunctions->executeQuery("dicc","select b_dist from singe_window_registration where id='$swr_id'");
		if($query_results->num_rows>0){
			$jurisdiction_parameter=$query_results->fetch_object()->b_dist;
		}else{
			$jurisdiction_parameter="";
		}
	}
	
	$office_address="";
	
	if($jurisdiction_parameter!=""){  
		$query="SELECT * FROM `courier_information` WHERE `district` LIKE '%$jurisdiction_parameter%' LIMIT 1";
		$queryResults=$formFunctions->executeQuery($dept,$query);
		if($queryResults->num_rows>0){
			$queryResultsRow=$queryResults->fetch_object();
			$office_address= $queryResultsRow->courier_address;
		}
	}else{
		$office_address="";
		
	}
	
	
}
?>
<?php require_once "header.php"; ?>
<div class="content-wrapper">
    <section class="content-header"></section>
    <section class="content">
        <?php require 'banner.php'; ?>
			<div class="row">				
				<div class="col-md-12">
					<div class="box box-primary">
						<div class="row">
							<div class="col-md-8 col-md-offset-2">
								<div style="text-align:center" class="alert alert-warning" role="alert">
									<i class="fa fa-2x fa-exclamation-triangle" aria-hidden="true"></i><h4>Please ensure that you send a printed copy of the application form (<a href="preview.php?dept=<?php echo $dept; ?>&form=<?php echo $form; ?>" target="_blank">click here to print</a>) along with all the respective documents to be sent by courier at the office address : <font color="black"><?php echo $office_address; ?></font>.</h4>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4"></div>
							<div class="col-md-4 form-all">
								<h3 class="text-center">Please enter the Courier Details below </h3><br/>
								<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<input type="hidden" name="dept" value="<?php echo $dept; ?>"/>
									<input type="hidden" name="form" value="<?php echo $form; ?>"/>
									<div class="form-group">
										<label for="exampleInputEmail1">Name of Courier Service</label>
										<select name="courier_details[cn]" id="courier_service" class="form-dropdown form-control" required="required">
											<option selected value="">Please select one Courier Service</option>
											<option value="Indian Postal Service"> Indian Postal Service </option>
											<option value="DHL Express India Pvt. Ltd"> DHL Express India Pvt. Ltd </option>
											<option value="Blue Dart Express Limited."> Blue Dart Express Limited. </option>
											<option value="First Flight Courier Limited."> First Flight Courier Limited. </option>
											<option value="FedEx India."> FedEx India. </option>
											<option value="DTDC Courier and Cargo limited."> DTDC Courier and Cargo limited. </option>
											<option value="Gati Limited."> Gati Limited. </option>
											<option value="Overnite Express Limited."> Overnite Express Limited. </option>
											<option value="The Professional Courier Network Limited."> The Professional Courier Network Limited. </option>
											<option value="Palande Courier Services."> Palande Courier Services. </option>
											<option value="DTDC AIR CARGO APEX."> DTDC AIR CARGO APEX. </option>
											<option value="United Parcel Service (UPS)."> United Parcel Service (UPS). </option>
											<option value="Aramex."> Aramex. </option>
											<option value="Express Courier Services."> Express Courier Services. </option>
											<option value="I.B Courier and Cargo."> I.B Courier and Cargo. </option>
											<option value="Pitney Bowes India Pvt. Ltd."> Pitney Bowes India Pvt. Ltd. </option>
											<option value="On Dot Couriers &amp; Cargo Ltd."> On Dot Couriers &amp; Cargo Ltd. </option>
											<option value="Agarwal packers and movers."> Agarwal packers and movers. </option>
											<option value="Globe Express Services"> Globe Express Services </option>
											<option value="Professional Couriers."> Professional Couriers. </option>
											<option value="TNT Express."> TNT Express. </option>
											<option value="O"> Others </option>
										</select>
										<br/>
										<input type="text" id="courier_service_others" class="form-control text-uppercase" placeholder="Name of the courier service" name="courier_service_others"/>
									</div>
									<div class="form-group">
									<label for="exampleInputPassword1">Ref No./Consignment No.</label>
									<input type="text" class="form-control" validate="specialChar" name="courier_details[rn]" id="exampleInputPassword1" placeholder="Ref No./Consignment No." required="required">
									</div>
									<div class="form-group">
									<label for="exampleInputPassword1">Date of Courier</label>
										<input name="courier_details[dt]" class="form-control" id="dobn" placeholder="Please click here to select the date" required="required">
									</div>
									<center><button type="submit" name="submit" class="btn btn-primary">Submit</button></center>
									<br/>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
<?php require_once "../../views/users/requires/footer.php"; ?>
<?php require 'js.php' ?>		
<script>
$('#dobn').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-50:+50", minDate: 0});

$('#courier_service_others').hide();
$('#courier_service').on('change', function(){
	
	if($('#courier_service option:selected').val() == 'O'){
		$('#courier_service_others').show();
		$('#courier_service_others').attr("required","required");
	}else{
		$('#courier_service_others').hide();
		$('#courier_service_others').removeAttr("required","required");
	}
});
</script>
</body>
</html>
