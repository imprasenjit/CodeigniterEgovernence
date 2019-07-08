<?php  require_once "login_session.php";
if(isset($_POST["submit"])){
	$dept=$_POST["dept"];$form=$_POST["form"];	
	if(!empty($_POST["courier_details"])){		
		$courier_details=json_encode($_POST["courier_details"]);
	}else{
		echo "<script>
			alert('Please enter courier details !!!');
			window.location.href = '../../requires/courier_details.php?dept=".$dept."&form=".$form."';
		</script>";
	}
	$table=$formFunctions->getTableName($dept,$form);
	$query="select form_id,save_mode,uain,user_id from ".$table." where user_id='$swr_id' and active='1'";
	$saveQuery=$formFunctions->executeQuery($dept,$query);
	
	if($saveQuery->num_rows>0){
		$rows=$saveQuery->fetch_object();
		$form_id=$rows->form_id;$save_mode=$rows->save_mode;$uain=$rows->uain;$user_id=$rows->user_id;
		
		if($save_mode=="F"){
			switch($dept){
				case "pcb":
					if($form<3){
						$update_query="update ".$table." set courier_details='$courier_details',save_mode='P' where user_id='$swr_id' and form_id='$form_id'";
						$formpath="../".$dept."/forms/form".$form.".php";
					}elseif($form==3 || $form==47 || $form==48 || $form==49 || $form==50){
						$update_query="update ".$table." set courier_details='$courier_details',save_mode='P' where user_id='$swr_id' and form_id='$form_id'";
						$formpath="../".$dept."/forms/pcb_form".$form.".php";
					}else{
						$update_query="update ".$table." set courier_details='$courier_details',save_mode='C' where user_id='$swr_id' and form_id='$form_id'";					
						$formpath=$server_url."departments/requires/acknowledgement.php?form=".$form."&dept=pcb";
					}
				break;
				case "gmc":
						$update_query="update ".$table." set courier_details='$courier_details',save_mode='P' where user_id='$swr_id' and form_id='$form_id'";
						$formpath="../".$dept."/forms/gmc_form".$form.".php";
					
				break;
				case "dma":
						$update_query="update ".$table." set courier_details='$courier_details',save_mode='P' where user_id='$swr_id' and form_id='$form_id'";
						$formpath="../".$dept."/forms/dma_form".$form.".php";
					
				break;
				case "factory": $update_query="update ".$table." set courier_details='$courier_details',save_mode='C' where user_id='$swr_id' and form_id='$form_id'";
								$formpath=$server_url."departments/requires/acknowledgement.php?form=".$form."&dept=factory";
				break;
				case "excise": $update_query="update ".$table." set courier_details='$courier_details',save_mode='C' where user_id='$swr_id' and form_id='$form_id'";
								$formpath=$server_url."departments/requires/acknowledgement.php?form=".$form."&dept=excise";
				break;
				case "forest": 
								
								if($form==3){
									$update_query="update ".$table." set courier_details='$courier_details',save_mode='P' where user_id='$swr_id' and form_id='$form_id'";
									$formpath="../".$dept."/forms/".$dept."_form".$form.".php";
								}else{
									$update_query="update ".$table." set courier_details='$courier_details',save_mode='C' where user_id='$swr_id' and form_id='$form_id'";				$formpath=$server_url."departments/requires/acknowledgement.php?form=".$form."&dept=".$dept;
								}
								
				break;
				case "fire": $update_query="update ".$table." set courier_details='$courier_details',save_mode='C' where user_id='$swr_id' and form_id='$form_id'";
								$formpath=$server_url."departments/requires/acknowledgement.php?form=".$form."&dept=fire";
				break;
				case "land": 
							if($form==1 || $form==3){
								$update_query="update ".$table." set courier_details='$courier_details',save_mode='P' where user_id='$swr_id' and form_id='$form_id'";
							}else{
								$update_query="update ".$table." set courier_details='$courier_details',save_mode='C' where user_id='$swr_id' and form_id='$form_id'";
							}							
							$formpath="../".$dept."/forms/land_form".$form.".php";
				break;
				case "labour": $update_query="update ".$table." set courier_details='$courier_details',save_mode='P' where user_id='$swr_id' and form_id='$form_id'";
								if($form<6)	$formpath="../".$dept."/forms/lc_reg_form".$form.".php";
								else if($form>5 && $form<9)	$formpath="../".$dept."/forms/lc_license_form".$form.".php";
								else $formpath="../".$dept."/forms/lc_renewal_form".$form.".php";							
				break;
				case "cei": if($form==1 || $form==2  || $form==6 || $form==7 || $form==8 || $form==9 || $form==11 || $form==13 || $form==14 || $form==15 || $form==16 || $form==17 || $form==18 || $form==19 || $form==20 || $form==21 || $form==22|| $form==25 || $form==26){
								$update_query="update ".$table." set courier_details='$courier_details',save_mode='P' where user_id='$swr_id' and form_id='$form_id'";
							}else{
								$update_query="update ".$table." set courier_details='$courier_details',save_mode='C' where user_id='$swr_id' and form_id='$form_id'";
							}							
							$formpath="../".$dept."/forms/cei_form".$form.".php";
				break;
				case "dic": $update_query="update ".$table." set courier_details='$courier_details',save_mode='C' where user_id='$swr_id' and form_id='$form_id'";
								$formpath=$server_url."departments/requires/acknowledgement.php?form=".$form."&dept=dic";
				break;
				case "society": $update_query="update ".$table." set courier_details='$courier_details',save_mode='C' where user_id='$swr_id' and form_id='$form_id'";
								$formpath=$server_url."departments/requires/acknowledgement.php?form=".$form."&dept=society";
				break;
				case "fcs": $update_query="update ".$table." set courier_details='$courier_details',save_mode='C' where user_id='$swr_id' and form_id='$form_id'";
								$formpath=$server_url."departments/requires/acknowledgement.php?form=".$form."&dept=fcs";
				break;
				case "rfs": 
							$update_query="update ".$table." set courier_details='$courier_details',save_mode='P' where user_id='$swr_id' and form_id='$form_id'";
							$formpath="../".$dept."/forms/rfs_form".$form.".php";
						/* }else{
							$update_query="update ".$table." set courier_details='$courier_details' where user_id='$swr_id' and form_id='$form_id'";
							$formpath=$server_url."departments/requires/acknowledgement.php?form=".$form."&dept=rfs";
						} */
								
				break;
				case "tcp": if($form==1){
								$update_query="update ".$table." set courier_details='$courier_details',save_mode='P' where user_id='$swr_id' and form_id='$form_id'";
							}else{
								$update_query="update ".$table." set courier_details='$courier_details',save_mode='C' where user_id='$swr_id' and form_id='$form_id'";
							}							
							$formpath="../".$dept."/forms/tcp_form".$form.".php";
				break;
				case "dsedu": $update_query="update ".$table." set courier_details='$courier_details',save_mode='C' where user_id='$swr_id' and form_id='$form_id'";
								$formpath=$server_url."departments/requires/acknowledgement.php?form=".$form."&dept=dsedu";
				break;
				case "deedu": $update_query="update ".$table." set courier_details='$courier_details',save_mode='C' where user_id='$swr_id' and form_id='$form_id'";
								$formpath=$server_url."departments/requires/acknowledgement.php?form=".$form."&dept=deedu";
				break;
				case "dhedu": $update_query="update ".$table." set courier_details='$courier_details',save_mode='C' where user_id='$swr_id' and form_id='$form_id'";
								$formpath=$server_url."departments/requires/acknowledgement.php?form=".$form."&dept=dhedu";
				break;
				case "jalboard": if($form==1){
									$update_query="update ".$table." set courier_details='$courier_details',save_mode='P' where user_id='$swr_id' and form_id='$form_id'";
								}else{
									$update_query="update ".$table." set courier_details='$courier_details',save_mode='C' where user_id='$swr_id' and form_id='$form_id'";
								}							
							$formpath="../".$dept."/forms/jalboard_form".$form.".php";
				break;
				case "water": if($form==1){
									$update_query="update ".$table." set courier_details='$courier_details',save_mode='P' where user_id='$swr_id' and form_id='$form_id'";
								}else{
									$update_query="update ".$table." set courier_details='$courier_details',save_mode='C' where user_id='$swr_id' and form_id='$form_id'";
								}							
							$formpath="../".$dept."/forms/water_form".$form.".php";
				break;
				case "sdc": 
							$update_query="update ".$table." set courier_details='$courier_details',save_mode='P' where user_id='$swr_id' and form_id='$form_id'";
							$formpath="../".$dept."/forms/sdc_form".$form.".php";
				break;
				case "asam": 
							$update_query="update ".$table." set courier_details='$courier_details',save_mode='P' where user_id='$swr_id' and form_id='$form_id'";
							$formpath="../".$dept."/forms/asam_form".$form.".php";
				break;
				case "doa": 
							$update_query="update ".$table." set courier_details='$courier_details',save_mode='P' where user_id='$swr_id' and form_id='$form_id'";
							$formpath="../".$dept."/forms/doa_form".$form.".php";
				break;
				case "mines": 
							$update_query="update ".$table." set courier_details='$courier_details',save_mode='P' where user_id='$swr_id' and form_id='$form_id'";
							$formpath="../".$dept."/forms/mines_form".$form.".php";
				break;
				case "dmedu": 
							$update_query="update ".$table." set courier_details='$courier_details',save_mode='C' where user_id='$swr_id' and form_id='$form_id'";
							$formpath=$server_url."departments/requires/acknowledgement.php?form=".$form."&dept=dmedu";
				break;
				case "pwd": 
							$update_query="update ".$table." set courier_details='$courier_details',save_mode='C' where user_id='$swr_id' and form_id='$form_id'";
							$formpath=$server_url."departments/requires/acknowledgement.php?form=".$form."&dept=pwd";
				break;
				case "boiler": 
							$update_query="update ".$table." set courier_details='$courier_details',save_mode='P' where user_id='$swr_id' and form_id='$form_id'";
							$formpath="../".$dept."/forms/boiler_form".$form.".php";
				break;
				case "tourism": 
							$update_query="update ".$table." set courier_details='$courier_details',save_mode='C' where user_id='$swr_id' and form_id='$form_id'";
							$formpath=$server_url."departments/requires/acknowledgement.php?form=".$form."&dept=tourism";
				break;
				case "ayush": 
							if($form==2 || $form==4){
								$update_query="update ".$table." set courier_details='$courier_details',save_mode='P' where user_id='$swr_id' and form_id='$form_id'";
								$formpath="../".$dept."/forms/".$dept."_form".$form.".php";
							}else{
								$update_query="update ".$table." set courier_details='$courier_details',save_mode='C' where user_id='$swr_id' and form_id='$form_id'";				$formpath=$server_url."departments/requires/acknowledgement.php?form=".$form."&dept=".$dept;
							}
				break;
				case "clm": if($form==1 || $form==2 || $form==3 || $form==4 || $form==5 || $form==6 || $form==7 || $form==8 || $form==10){
								$update_query="update ".$table." set courier_details='$courier_details',save_mode='P' where user_id='$swr_id' and form_id='$form_id'";
							}else{
								$update_query="update ".$table." set courier_details='$courier_details',save_mode='C' where user_id='$swr_id' and form_id='$form_id'";
							}							
							$formpath="../".$dept."/forms/clm_form".$form.".php";
				break;
				case "pcpndt": if($form==1 || $form==2 || $form==3){
								$update_query="update ".$table." set courier_details='$courier_details',save_mode='P' where user_id='$swr_id' and form_id='$form_id'";
							}else{
								$update_query="update ".$table." set courier_details='$courier_details',save_mode='C' where user_id='$swr_id' and form_id='$form_id'";
							}							
							$formpath="../".$dept."/forms/pcpndt_form".$form.".php";
				break;
				default:
				break;
			}
			
			
			
			$updateQuery=$formFunctions->executeQuery($dept,$update_query);
			if($updateQuery){
				$insert_applications=$formFunctions->insert_applications($uain);
				if($insert_applications==false){					
					echo "<script>
						alert('Something went wrong !!!');
						window.location.href = '../../user_area/';
					</script>";
				}
				echo "<script>
					alert('Successfully Saved.');
					
					window.location.href = '".$formpath."';
				</script>";
				//window.location.href = '".$formpath."';
			}else{
				echo "<script>
					alert('Something went wrong !!!');
					window.location.href = '../../user_area/';
				</script>";
			}			
		}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '../../user_area/';
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
	$form=$_GET["form"];	
	$dept=$_GET["dept"];
	
	$check=$formFunctions->is_already_registered($dept,$form);
	if($check==1){
		echo "<script>
					alert('Successfully Submitted');
					window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=".$form."&dept=".$dept."';
			</script>";	
	}else if($check==3){
		echo "<script>window.location.href = '".$server_url."/departments/".$dept."/forms/payment_section.php?token=".$form."';</script>";
	}else{
		$showtab="";
	}
	
	$href="../".$dept."/forms/preview.php?token=".$form."";
	$table=$formFunctions->getTableName($dept,$form);
	$query="select uain from ".$table." where user_id='$swr_id' and active='1' and save_mode!='C'";
	$saveQuery=$formFunctions->executeQuery($dept,$query);
	if($saveQuery->num_rows<1){
		echo "<script>
			alert('Invalid page access !!!');
			window.location.href = '../../user_area/';
		</script>";
	}
	/**   ******** OFFICE ADDRESS ********/
	if($dept=="gmc"){
		$query_results=$mysqli->query("select b_block from singe_window_registration where id='$swr_id'");
		if($query_results->num_rows>0){
			$jurisdiction_parameter=$query_results->fetch_object()->b_block;
		}else{
			$jurisdiction_parameter="";
		}			
	}else if($dept=="revenue"){
		$query_results=$mysqli->query("select revenue from singe_window_registration_part1 where swr_id='$swr_id'");
		if($query_results->num_rows>0){
			$jurisdiction_parameter=$query_results->fetch_object()->revenue;
		}else{
			$jurisdiction_parameter="";
		}	
	}else if($dept=="tourism"){
		$query_results=$mysqli->query("select b_block from singe_window_registration where id='$swr_id'");
		if($query_results->num_rows>0){
			$jurisdiction_parameter=$query_results->fetch_object()->b_block;
		}else{
			$jurisdiction_parameter="";
		}
	}else{
		
		$query_results=$mysqli->query("select b_dist from singe_window_registration where id='$swr_id'");
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
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Ease of Doing Business | Govt. of Assam</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <?php require '../../user_area/includes/css.php';?>
  <style>
  .form-all{
	border: 1px solid #09f;
    border-radius: 5px;
    box-shadow: 0 0 5px #0099ff;
    box-sizing: border-box;
	background: #ffffff none repeat scroll 0 0;
    color: #00b1de !important;
    font-family: "Verdana";
    font-size: 12px;
    margin: 0 auto;
    padding-top: 0;
	  
  }
  </style>
</head>
<body class="hold-transition skin-blue fixed" data-target="#scrollspy" data-spy="scroll">
	<div class="wrapper">

	  <?php require '../../user_area/includes/header.php'; ?>
	  <?php require '../../user_area/includes/aside.php'; ?>

	  
		<div class="content-wrapper">
			<div class="row">				
				<div class="col-md-12">
					<div class="box box-primary">
						<div class="row">
							<div class="col-md-8 col-md-offset-2">
								<div style="text-align:center" class="alert alert-warning" role="alert">
									<i class="fa fa-2x fa-exclamation-triangle" aria-hidden="true"></i><h4>Please ensure that you send a printed copy of the application form (<a href="<?php echo $href; ?>" target="_blank">click here to print</a>) along with all the respective documents to be sent by courier at the office address : <font color="black"><?php echo $office_address; ?></font>.</h4>
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
									<select name="courier_details[cn]" class="form-dropdown form-control" required="required">
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
									</select>
									</div>
									<div class="form-group">
									<label for="exampleInputPassword1">Ref No./Consignment No.</label>
									<input type="text" class="form-control" validate="specialChar" name="courier_details[rn]" id="exampleInputPassword1" placeholder="Ref No./Consignment No." required="required">
									</div>
									<div class="form-group">
									<label for="exampleInputPassword1">Date of Courier</label>
										<input type="text" name="courier_details[dt]" readonly="readonly" class="form-control" id="dobn" placeholder="Please click here to select the date" required="required">
									</div>
									<center><button type="submit" name="submit" class="btn btn-primary">Submit</button></center>
									<br/>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	  
	  <?php require '../../user_area/includes/footer.php'; ?>
	</div>
<?php require '../../user_area/includes/js.php' ?>
<script>
$('#dobn').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-50:+50", minDate: 0});
</script>
</body>
</html>
