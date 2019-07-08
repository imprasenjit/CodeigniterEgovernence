<?php require_once "../../requires/login_session.php";
$dept="rfs";
$form="8";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);
include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
include("save_form.php");
	
	
	
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1' ");
	if($q->num_rows<1){	 
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
		if($p->num_rows>0){
			$results=$p->fetch_assoc();
			$form_id=$results["form_id"];$date_of_registration=$results["date_of_registration"];$post_office=$results["post_office"];$police_station=$results["police_station"];
			if(!empty($results['society'])){
				$society=json_decode($results['society']);
				$society_mouza=$society->mouza;$society_circle=$society->circle;$society_patta_no=$society->patta_no;$society_dag_no=$society->dag_no;$society_area=$society->area;$society_locality=$society->locality;$society_vill=$society->vill;$society_post_office=$society->post_office;$society_police_station=$society->police_station;$society_dist=$society->dist;$society_pincode=$society->pincode;
			}else{
				$society_mouza="";$society_circle="";$society_patta_no="";$society_dag_no="";$society_area="";$society_post_office="";$society_police_station="";$society_locality="";$society_vill="";$society_po="";$society_ps="";$society_dist="";$society_pincode="";
			}
		}else{
			$form_id="";
			$date_of_registration="";$post_office="";$police_station="";
			$society_mouza="";$society_circle="";$society_patta_no="";$society_dag_no="";$society_area="";$society_post_office="";$society_police_station="";$society_locality="";$society_vill="";$society_po="";$society_ps="";$society_dist="";$society_pincode="";
		}
	}else{
		$results=$q->fetch_assoc();
		$form_id=$results["form_id"];$date_of_registration=$results["date_of_registration"];$post_office=$results["post_office"];$police_station=$results["police_station"];
		if(!empty($results['society'])){
			$society=json_decode($results['society']);
			$society_mouza=$society->mouza;$society_circle=$society->circle;$society_patta_no=$society->patta_no;$society_dag_no=$society->dag_no;$society_area=$society->area;$society_locality=$society->locality;$society_vill=$society->vill;$society_post_office=$society->post_office;$society_police_station=$society->police_station;$society_dist=$society->dist;$society_pincode=$society->pincode;
		}else{
			$society_mouza="";$society_circle="";$society_patta_no="";$society_dag_no="";$society_area="";$society_post_office="";$society_police_station="";$society_locality="";$society_vill="";$society_po="";$society_ps="";$society_dist="";$society_pincode="";
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Ease of doing business | Govt. of Assam</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<?php require '../../../user_area/includes/css.php';?>
	<style>
		/* Over writes AdminLTE form styles */
		p{text-align: justify;}
		.form-control:focus{box-shadow:0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(102, 175, 233, 0.6)}
		.form-control{
			background-color: #fff;
			background-image: none;
			border: 1px solid #ccc;
			border-radius: 4px;
			box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
			color: #555;
			display: block;
			font-size: 14px;
			height: 34px;
			line-height: 1.42857;
			padding: 6px 12px;
			transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
			width: 100%;
		}
	</style>
</head>
<body class="hold-transition skin-blue fixed" data-target="#scrollspy" data-spy="scroll">
<div class="overlay-div"></div>
<div id="loader" class="loader" style="display:none;"></div>
<div class="wrapper">
<?php require_once "../../requires/header.php";   ?>
<?php require '../../../user_area/includes/aside.php'; ?>
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<section class="content-header"></section>
		<section class="content">
			<?php require '../../requires/banner.php'; ?>
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h4 class="text-center" >
								<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form);?></strong>
							</h4>	
						</div>
						<div class="panel-body">
							<div id="table1" class="tab-pane" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table class="table table-responsive">
									<tr>
										<td width="25%">1. Name of the Society</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled  value="<?php echo $unit_name;?>"></td>
										<td width="25%">2. Registration No.</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled value="<?php echo $ubin;?>"  ></td>
									</tr>
									<tr>
										<td width="25%">3. Date of Registration</td>
										<td width="25%"><input type="date" class="dob form-control text-uppercase" name="date_of_registration"  value="<?php echo $date_of_registration;?>"></td>
										<td width="25%">4. Date of Establishment</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled value="<?php echo $date_of_commencement;?>"  ></td>
									</tr>
									<tr>
										<td colspan="4">5. Address of the Society</td>
									</tr>
									<tr>
										<td>Mouza </td>
										<td><input type="text" class="form-control text-uppercase"  disabled value="<?php  echo $mouza; ?>"/></td>
										<td>Circle</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php  echo $circle; ?>"/></td>
									</tr>
									<tr>
										<td>Patta No. </td>
										<td><input type="text" class="form-control text-uppercase"  disabled value="<?php  echo $patta_no; ?>"/></td>
										<td>Dag No.</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php  echo $dag_no; ?>"/></td>
									</tr>
									<tr>
										<td>Area</td>
										<td><input type="text" class="form-control text-uppercase"  disabled value="<?php  echo $area; ?>"/></td>
										<td>Locality  </td>
										<td><input type="text" class="form-control text-uppercase"  disabled value="<?php  echo $b_street_name2; ?>"/></td>
									</tr>
									<tr>
										<td>Village/town/city </td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php  echo $b_vill; ?>"/></td>
										<td>Post Office </td>
										<td><input type="text"  class="form-control text-uppercase" id="post_office" name="post_office" value="<?php  echo $post_office; ?>"/></td>
									</tr>
									<tr> 
										<td>Police Station </td>
										<td><input type="text" class="form-control text-uppercase" id="police_station" name="police_station" value="<?php  echo $police_station; ?>"/></td>
										<td>District</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php  echo $b_dist; ?>"/></td>
									</tr>
									<tr>
										<td>Pin code </td>
										 <td><input type="text" class="form-control text-uppercase" disabled value="<?php  echo $b_pincode; ?>" ></td>
										 <td>Mobile No.</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php  echo $b_mobile_no; ?>"/></td>
									</tr>
									<tr>
										<td>Email ID</td>
										<td><input type="text" class="form-control" disabled value="<?php  echo $b_email; ?>"/></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4">6. Proposed Address of the Society</td>
									</tr>
									<tr>
										<td>Mouza </td>
										<td><input type="text" class="form-control text-uppercase"  name="society[mouza]" value="<?php  echo $society_mouza; ?>"/></td>
										<td>Circle</td>
										<td><input type="text" class="form-control text-uppercase" name="society[circle]" value="<?php  echo $society_circle; ?>"/></td>
									</tr>
									<tr>
										<td>Patta No. </td>
										<td><input type="text" class="form-control text-uppercase"  name="society[patta_no]" value="<?php  echo $society_patta_no; ?>"/></td>
										<td>Dag No.</td>
										<td><input type="text" class="form-control text-uppercase" name="society[dag_no]" value="<?php  echo $society_dag_no; ?>"/></td>
									</tr>
									<tr>
										<td>Area</td>
										<td><input type="text" class="form-control text-uppercase"  name="society[area]" value="<?php  echo $society_area; ?>"/></td>
										<td>Locality  </td>
										<td><input type="text" class="form-control text-uppercase" name="society[locality]" value="<?php  echo $society_locality; ?>"/></td>
									</tr>
									<tr>
										<td>Village/town/city </td>
										<td><input type="text" class="form-control text-uppercase" name="society[vill]" value="<?php  echo $society_vill; ?>"/></td>
										<td>Post Office </td>
										<td><input type="text"  class="form-control text-uppercase"  name="society[post_office]" value="<?php  echo $society_post_office; ?>"/></td>
									</tr>
									<tr>
										<td>Police Station </td>
										<td><input type="text" class="form-control text-uppercase"  name="society[police_station]" value="<?php  echo $society_police_station; ?>"/></td>
										<td>District<span class="mandatory_field">*</span></td>
                                         <td><input type="text" name="society[dist]" id="dist1" class="form-control text-uppercase is_different_yes_class" value="<?php  echo $society_dist; ?>"></td>
										
									</tr>
									<tr>
										<td>Pin code </td>
										<td><input type="text" class="form-control text-uppercase" name="society[pincode]" validate="pincode" maxlength="6" value="<?php  echo $society_pincode; ?>"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="2">Date : <strong><?php echo $today;?></strong><br/>
											Place : <strong><?php echo strtoupper($dist);?></strong></td>
										<td align="right" colspan="2">
											<b><?php echo strtoupper($key_person)?></b><br/>
												Signature of the Applicant               
										</td>
									</tr>
									<tr>
										<td colspan="4" class="text-center">
										<button type="submit" class="btn btn-success submit1" name="save<?php echo $form;?>" title="Save it and fill up the form later and Go to the Next Part" onclick="return confirm('Do you want to save..?')"> Save & Next</button></td>
									</tr>								
									</table>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
	<!-- /.content-wrapper -->
 <?php require_once "../../../views/users/requires/footer.php";  ?>
<?php require '../../requires/js.php' ?>
<script>
	/* ---------------------Block all after submit operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>
</body>	  
</html>