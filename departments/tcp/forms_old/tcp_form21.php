<?php  require_once "../../requires/login_session.php";

$check=$formFunctions->is_already_registered('tcp','1');
if($check==1){
	echo "<script>
				alert('Successfully Submitted');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=1&dept=tcp';
		</script>";	
}else if($check==2){
	echo "<script>				
				window.location.href = '".$server_url."departments/requires/courier_details.php?form=1&dept=tcp';
		</script>";
}else if($check==3){
	echo "<script>window.location.href = 'payment_section.php?token=1';</script>";
}else{
	$showtab="";
}

$get_file_name=basename(__FILE__);	
include "save_tcp_form.php";
		$email=$formFunctions->get_usermail($swr_id);
		$row1=$formFunctions->fetch_swr($swr_id);
		
		$key_person=$row1['Key_person'];$owner_type=$row1['Type_of_ownership'];$owner_name=$row1['Name_of_owner'];$pan_no=$row1['pan_no'];$trade_name=$row1['Name'];$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_pincode=$row1['b_pincode'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$pincode=$row1['Pincode'];$block=$row1['block'];$std_code=$row1['Landline_std'];$phone_no=$row1['Landline_no'];$mobile_no=$row1['Mobile_no'];$cap_investment=$row1['Size_of_Investment'];
		$tcp_zone=$row1['b_block'];$id_proof_doc=$row1['id_proof_doc'];
		$sector_classes_b=$row1['sector_classes_b'];
		
		$q=$tcp->query("select * from tcp_form1 where user_id='$swr_id' and active='1'") or die($tcp->error);
		$results=$q->fetch_array();
		if($q->num_rows<1){	
			$form_id="";
			$app_cat="";$fm_name="";$spouse_nm="";$own_name="";$j_own_name="";$prop_house_no="";$prop_new_dagno="";$prop_old_dagno="";$prop_pattano="";$prop_mouza="";$prop_wardno="";$prop_panchayat="";$prop_zone="";$vill_revenue="";$locality="";$land_use="";$road_name="";$road_width="";$adjoin_north="";$adjoin_south="";$adjoin_east="";$adjoin_west="";$build_cat="";$prop_use="";$plot_area="";$build_area="";$con_type="";$no_of_floor="";$margin_north="";$margin_south="";$margin_east="";$margin_west="";$canti_north="";$canti_south="";$canti_east="";$canti_west="";$park_no_base="";$park_no_grnd="";$park_no_open="";$park_area_base="";$park_area_grnd="";$park_area_open="";$area_grnd="";$area_first="";$area_second="";$area_thrid="";$area_fourth="";$area_fifth="";$area_sixth="";$area_sevnth="";$area_eight="";$total_area="";$b_wall="";$length="";$height="";$is_v_ext="";$v_no_floor="";$is_h_ext="";$h_no_floor="";$reg_no="";$rtp_name="";$tp_mobile_no="";$tp_email="";
			$file1="";$file2="";$file3="";$file4="";$file5="";$file6="";$file7="";$file8="";$file9="";$file10="";$file11="";

			$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
		}else{			
			$form_id=$results["form_id"];$app_cat=$results["app_cat"];$fm_name=$results["fm_name"];$spouse_nm=$results["spouse_nm"];$own_name=$results["own_name"];$j_own_name=$results["j_own_name"];$vill_revenue=$results["vill_revenue"];$locality=$results["locality"];$land_use=$results["land_use"];$road_name=$results["road_name"];$road_width=$results["road_width"];$build_cat=$results["build_cat"];$prop_use=$results["prop_use"];$plot_area=$results["plot_area"];$build_area=$results["build_area"];$con_type=$results["con_type"];$no_of_floor=$results["no_of_floor"];$total_area=$results["total_area"];$b_wall=$results["b_wall"];$length=$results["length"];$height=$results["height"];$is_v_ext=$results["is_v_ext"];$v_no_floor=$results["v_no_floor"];$is_h_ext=$results["is_h_ext"];$h_no_floor=$results["h_no_floor"];$reg_no=$results["reg_no"];$rtp_name=$results["rtp_name"];$tp_mobile_no=$results["tp_mobile_no"];$tp_email=$results["tp_email"];
			$file1=$results["file1"];$file2=$results["file2"];$file3=$results["file3"];$file4=$results["file4"];$file5=$results["file5"];$file6=$results["file6"];$file7=$results["file7"];$file8=$results["file8"];$file9=$results["file9"];
			
			if(!empty($results["prop"])){
				$prop=json_decode($results["prop"]);
				$prop_house_no=$prop->house_no;$prop_new_dagno=$prop->new_dagno;$prop_old_dagno=$prop->old_dagno;$prop_pattano=$prop->pattano;$prop_mouza=$prop->mouza;$prop_wardno=$prop->wardno;$prop_panchayat=$prop->panchayat;$prop_zone=$prop->zone;
			}else{				
				$prop_house_no="";$prop_new_dagno="";$prop_old_dagno="";$prop_pattano="";$prop_mouza="";$prop_wardno="";$prop_panchayat="";$prop_zone="";
			}
			if(!empty($results["adjoin"])){
				$adjoin=json_decode($results["adjoin"]);
				$adjoin_north=$adjoin->north;$adjoin_south=$adjoin->south;$adjoin_east=$adjoin->east;$adjoin_west=$adjoin->west;
			}else{				
				$adjoin_north="";$adjoin_south="";$adjoin_east="";$adjoin_west="";
			}
			if(!empty($results["margin"])){
				$margin=json_decode($results["margin"]);
				$margin_north=$margin->north;$margin_south=$margin->south;$margin_east=$margin->east;$margin_west=$margin->west;
			}else{				
				$margin_north="";$margin_south="";$margin_east="";$margin_west="";
			}
			if(!empty($results["canti"])){
				$canti=json_decode($results["canti"]);
				$canti_north=$canti->north;$canti_south=$canti->south;$canti_east=$canti->east;$canti_west=$canti->west;
			}else{				
				$canti_north="";$canti_south="";$canti_east="";$canti_west="";
			}
			if(!empty($results["park_no"])){
				$park_no=json_decode($results["park_no"]);
				$park_no_base=$park_no->base;$park_no_grnd=$park_no->grnd;$park_no_open=$park_no->open;
			}else{				
				$park_no_base="";$park_no_grnd="";$park_no_open="";
			}
			if(!empty($results["park_area"])){
				$park_area=json_decode($results["park_area"]);
				$park_area_base=$park_area->base;$park_area_grnd=$park_area->grnd;$park_area_open=$park_area->open;
			}else{				
				$park_area_base="";$park_area_grnd="";$park_area_open="";
			}
			if(!empty($results["area"])){
				$area=json_decode($results["area"]);
				$area_grnd=$area->grnd;$area_first=$area->first;$area_second=$area->second;$area_thrid=$area->thrid;$area_fourth=$area->fourth;$area_fifth=$area->fifth;$area_sixth=$area->sixth;$area_sevnth=$area->sevnth;$area_eight=$area->eight;
			}else{				
				$area_grnd="";$area_first="";$area_second="";$area_thrid="";$area_fourth="";$area_fifth="";$area_sixth="";$area_sevnth="";$area_eight="";
			}
			if(!empty($results["courier_details"]) && $results["courier_details"]!=1){
			$courier_details=json_decode($results["courier_details"]);
			$courier_details_cn=$courier_details->cn;$courier_details_rn=$courier_details->rn;$courier_details_dt=$courier_details->dt;
			}else{
				$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
			}
	}
		##PHP TAB management
	if(isset($_GET['tab'])) $showtab=$_GET['tab'];
	
	$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="";
	if($showtab=="" || $showtab<2 || $showtab>5 || is_numeric($showtab)==false){
		$tabbtn1="active";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="";
	}
	if($showtab==2){
		$tabbtn1="";$tabbtn2="active";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="";
	}
	if($showtab==3){
		$tabbtn1="";$tabbtn2="";$tabbtn3="active";$tabbtn4="";$tabbtn5="";$tabbtn6="";
	}
	if($showtab==4){
		$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="active";$tabbtn5="";$tabbtn6="";
	}
	if($showtab==5){
		$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="active";$tabbtn6="";
	}
	##PHP TAB management ends
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
		.form-control text-uppercase:focus{box-shadow:0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(102, 175, 233, 0.6)}
		.form-control text-uppercase{
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
<div id="gif"></div>
	<div class="wrapper">
	  <?php require '../../../user_area/includes/header.php'; ?>
	  <?php require '../../../user_area/includes/aside.php'; ?>
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<section class="content-header"></section>
			<section class="content">
				<?php require '../includes/banner.php'; ?>
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<h4 class="text-center text-bold" >
									<?php echo $form_name=$cms->query("select form_name from tcp_form_names where form_no='17'")->fetch_object()->form_name; ?>
								</h4>	
							</div>
							<div class="panel-body">
							    
								<br>
				<div class="tab-content">
					<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
						<form name="myform1" class="submit1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
                         <table class="table table-responsive">
								<tr>
									<td colspan="4"><b>By the Owner and Registered Architect,</b></td>
								</tr>
								<tr>
									<td colspan="4">(For above G+2)</td>
								</tr>
								<tr>
									<td>Classification of the Proposal<br/>(To erect/re-erect/demolition)</td>
									<td><input type="text"  class="form-control text-uppercase"></td>
									<td>Revenue Village:</td>
									<td><input type="text"  class="form-control text-uppercase"></td>
								</tr>
								<tr>
									<td>Mouza:</td>
									<td><input type="text"  class="form-control text-uppercase"></td>
									<td>Patta No.:</td>
									<td><input type="text"  class="form-control text-uppercase"></td>
								</tr>
								<tr>
									<td>Road facing the plot:</td>
									<td><input type="text"  class="form-control text-uppercase"></td>
								</tr>
			                  <tr>
									<td>Road facing the plot:</td>
									<td><input type="text"  class="form-control text-uppercase"></td>
								</tr>
			                  <tr>
									<td>Sl. No.</td>
									<td>Existing road width</td>
									<td>Office Building</td>
									<td>Remarks</td>
								</tr>	
                             <tr>
									<td><input type="text" class="form-control text-upercase" ></td>
									<td><input type="text" class="form-control text-upercase" ></td>
									<td><input type="text" class="form-control text-upercase" ></td>
									<td><input type="text" class="form-control text-upercase" ></td>
								</tr>								
								<tr>
									<td colspan="4">(1) Plot Area</td>
								</tr>
				
								<tr>
									<td width="25%"> (a) As per site plan:</td>
									<td width="25%"><input type="text"  class="form-control" ></td>
									<td>(b) As per land document:</td>
									<td><input type="text"  class="form-control text-uppercase"></td>
								</tr>
								<tr>
									<td colspan="4">(2) Area Statement</td>
								</tr>
								<tr>
									<td colspan="4">
										<table class="table table-responsive table-bordered">
											
											<tr>
												<td>Description</td>
												<td>Proposed sq. mt.</td>
												<td>Use</td>
												<td>Permissible(For office use)</td>
												<td>Remarks</td>
							
											</tr>
											<tr>
												<td>Max. ground coverage</td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
												
												
											</tr>
											<tr>
												<td>Basement</td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
												
												
										    </tr>
											<tr>
												<td>Ground floor</td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
												
												
											</tr>
											<tr>
												<td>Mezzanin</td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
												
												
											</tr>
											<tr>
												<td>First floor</td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
												
												
										    </tr>
										    <tr>
												<td>Second floor</td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
												
												
											</tr>
											<tr>
												<td>Thrid floor</td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
												
											</tr>
											<tr>
												<td>Fourth floor</td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
								           </tr>
											<tr>
												<td>Fifth floor</td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase"></td>			
											</tr>
											<tr>
												<td>Sixth floor</td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
										   </tr>
										   <tr>
												<td>Seventh floor</td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
											</tr>
											<tr>
												<td>Eight floor</td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
											</tr>
											<tr>
												<td>Ninth floor</td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
										    </tr>
											<tr>
												<td>Tenth floor</td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
										    </tr>
											
											
											<tr>
												<td>Service floor (if any)</td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
										    </tr>
											<tr>
												<td>Total floor area</td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
								           </tr>
											<tr>
												<td>Floor area ratio</td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
								           </tr>
										   <tr>
												<td>No. of Dwelling units</td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
								           </tr>
										
										</table>
									</td>
								</tr>
								<tr>
								   <td>(3) Height : </td>
								   
							    </tr>
								<tr>
									<td>(a) Maximum height of building (in meter):</td>
									<td><input type="text"  class="form-control text-uppercase"  ></td>
									<td>(b) Maximum height of the plinth (in meter):</td>
									<td><input type="text"  class="form-control text-uppercase"  ></td>
								</tr>
								<tr>
									<td colspan="4">(4) Set backs</td>
								</tr>
								<tr>
								<td colspan="6">
										<table class="table table-responsive table-bordered">
											
											<tr>
												<td>Setbacks</td>
												<td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Proposed</td>
												<td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Required as per bye laws(For office use)</td>
												<td>Remarks</td>
											 </td>
										    </tr>
										
											  <tr>
											    <td></td>
												<td>Cantilever projection over </br>setback(in meter)</td>
												<td>Clear setback(in meter)</td>
												<td>Required as per bye laws(For office use)</td>
												<td>Cantilever projection over setback(in meter)</td>
											
										     </tr>
											</td>
											<tr>
												<td>Front</td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
											    <td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
											</tr>
											<tr>
												<td>Rear</td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
											    <td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
										    </tr>
											<tr>
												<td>Left</td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
												 <td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
											</tr>
											<tr>
												<td>Right</td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
                                            <td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
											</tr>
											
								</table>
									</td>
								</tr>
								<tr>
									<td>(5) Duct:</td>
                                           
								</tr>
											
								<tr>
								<td colspan="4">
										<table class="table table-responsive table-bordered">
											
											<tr>
											
												<td>No. of Duct</td>
												<td>Vertical distance (in sq. meter)</td>
												<td>Minimum width of the shaft (in meter)</td>
												
										    </tr>
											<tr>
											
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
											</tr>
									</table>
									</td>
								</tr>
								<tr>
									<td>(6) Distance from the electric line (if any):</td>
                                           
								</tr>
											
								<tr>
								<td colspan="4">
										<table class="table table-responsive table-bordered">
											
											<tr>
											    
												<td>Nature of electric line</td>
												<td>Vertical distance (in meter)</td>
												<td>Horizontal distance (in meter)</td>
												
										    </tr>
											<tr>
											    
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
											
											</tr>
									</table>
								</td>
								</tr>
								<tr>
									<td>(7) Parking</td>
                                           
								</tr>
								<tr>
									<td>(A) Parking provided as per Building Byelaws:</td>
                                           
								</tr>			
								<tr>
								<td colspan="4">
										<table class="table table-responsive table-bordered">
											
											<tr>
											    <td>Open parking</td>
												<td>Stilt parking or ground floor covered parking</td>
												<td>Basement parking</td>
												<td>Total no. Of parking</td>
												
										    </tr>
											<tr>
											    <td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
											
											</tr>
									</table>
								</td>
								</tr>
								<tr>
									<td>(B) Parking required as per Appendix-I Byelaws (For office use):</td>
                             </tr>
								<tr>
								<td colspan="4">
										<table class="table table-responsive table-bordered">
											
											<tr>
											    <td>Sl. No.</td>
												<td>Type of use of building</td>
												<td>CAR parking</td>
												<td>Scooter parking</td>
												<td>Remarks</td>
										    </tr>
											<tr>
											    <td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
											    <td><input type="text" class="form-control text-upercase" ></td>
											</tr>
									</table>
								</td>
								</tr>
								<tr>
									<td>(C) Visitor's car/Scooter parking required as per the Byelaws:�</td>
                                           
								</tr>			
								<tr>
								<td colspan="4">
										<table class="table table-responsive table-bordered">
											
											<tr>
											    <td>Sl. No.</td>
												<td>Type of use of building</td>
												<td>CAR parking</td>
												<td>Scooter parking</td>
												
										    </tr>
											<tr>
											    <td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
												<td><input type="text" class="form-control text-upercase" ></td>
											
											</tr>
									</table>
								</td>
								</tr>
								
								<tr>
									<td colspan="4">N.B. For Educational building 20% of the total plot area is required to be kept for parking in organised manner with separate entry and exit gate.
                                           
								</tr>
								<tr>
									<td>(8) Fee and charges (For office use).</td>
                                           
								</tr>
								<tr>
									<td>(a) Building permit fee. &nbsp;&nbsp;&nbsp;&nbsp; Rs.</td>
									<td><input type="text" class="form-control text-upercase" ></td>
									<td>(b) Use of city infrastructure charges. &nbsp;&nbsp;&nbsp;&nbsp; Rs.</td>
									<td><input type="text" class="form-control text-upercase" ></td>		
                             </tr>
							    <tr>
									<td>(c) Additional floor space charges (provisional) Rs.</td>
									<td><input type="text" class="form-control text-upercase" ></td>
									<td>(d) Peripheral charges (if any) &nbsp;&nbsp;&nbsp;&nbsp; Rs.</td>
									<td><input type="text" class="form-control text-upercase" ></td>		
                             </tr>
							 <tr>
									<td>(e) Any other charges (if any, please specify) &nbsp;&nbsp;&nbsp;&nbsp;Rs.</td>
									<td><input type="text" class="form-control text-upercase" ></td>
									<td>Total amount (as per detail above) &nbsp;&nbsp;&nbsp;&nbsp;Rs.</td>
									<td><input type="text" class="form-control text-upercase" ></td>
							</tr>
							<tr>
									<td>Receipt No.<strong></strong></td>
									<td><input type="text" class="form-control text-upercase" ></td>
							       <td>Dated</td>
									<td><input type="text" class="form-control text-upercase" ></td>
							</tr>
							<tr>
								 <td>We hereby certify that-</td>
							</tr>
							<tr>
								 <td colspan="4">(1) The title document is to justify the ownership of land and its sub-division was

                           duly approved by the Authority before registration of the land sale deed.</td>
							</tr>
							<tr>
								 <td colspan="4">(2) Plot is lying vacant and no construction shall be started before sanction.</td>
							</tr>
							
							<tr>
								 <td colspan="4">(3) The plot is free from all encumbrances (owner responsibility)..</td>
							</tr>
							<tr>
								 <td colspan="4">(4) Building shall not be occupied before getting occupancy certificate dully issued by Authority.</td>
							</tr>
							<tr>
								 <td colspan="4">(5) Supervision in the manner prescribed shall be conducted with intimation to the Authority.</td>
							</tr>
							<tr>
							<td colspan="4">(6) Mandatory provision of rainwater harvesting is to be provided.</td>
						    </tr>
							<tr>
							<td colspan="4">(7) Special earthquake resistance measure (Like shear wall/breeching etc.) has been taken to make stilt parking as an earthquake resistance structure.</td>
						    </tr>
							<tr>
									<td>Name of owner(s):</td>
									<td><input type="text" class="form-control text-uppercase"></td>
									<td>Registration no. of the Architect/Engineer/supervisor:</td>
									<td><input type="text" class="form-control text-uppercase"></td>
								</tr>
								<tr>
									<td colspan="4">Address of the owner(s):</td>
								</tr>
								<tr>
									<td width="25%"> Steert Name 1 :</td>
									<td width="25%"><input type="text"  class="form-control" ></td>
									<td width="25%">Street Name 2 :</td>
									<td width="25%"><input type="text"  class="form-control text-uppercase" ></td>
								</tr>
								<tr>
									<td>Village/Town :</td>
									<td><input type="text"  class="form-control text-uppercase"  ></td>
									<td>District :</td>
									<td><input type="text"  class="form-control text-uppercase" ></td> 
								</tr>
								<tr>
								   <td>Pincode : </td>
								   <td><input type="text"  class="form-control text-uppercase" ></td>
								   <td>Mobile No. :</td>
									<td><input type="text" class="form-control text-uppercase" /></td>
							    </tr>
								<tr>
									<td>Email ID :</td>
									<td><input type="text" class="form-control" ></td>
									<td>Pan No. :</td>
									<td><input type="text"  class="form-control text-uppercase"  ></td>
								</tr>
					           <tr>
									<td colspan="4">Address of the Architect/Engineer/supervisor:</td>
								</tr>
								<tr>
									<td width="25%"> Steert Name 1 :</td>
									<td width="25%"><input type="text"  class="form-control" ></td>
									<td width="25%">Street Name 2 :</td>
									<td width="25%"><input type="text"  class="form-control text-uppercase" ></td>
								</tr>
								<tr>
									<td>Village/Town :</td>
									<td><input type="text"  class="form-control text-uppercase"  ></td>
									<td>District :</td>
									<td><input type="text"  class="form-control text-uppercase" ></td> 
								</tr>
								<tr>
								   <td>Pincode : </td>
								   <td><input type="text"  class="form-control text-uppercase" ></td>
								   <td>Mobile No. :</td>
									<td><input type="text" class="form-control text-uppercase" /></td>
							    </tr>
								<tr>
									<td>Email ID :</td>
									<td><input type="text" class="form-control" ></td>
									<td>Pan No. :</td>
									<td><input type="text"  class="form-control text-uppercase"  ></td>
								</tr>
								<tr>
									<td colspan="2">Date:<strong><? echo date('d-m-Y',strtotime($today));?></strong></td>
									<td colspan="2">Signature of the owners:</td>
								</tr>
								<tr>
								    <td colspan="2"></td>
									<td colspan="2">Signature of registered Architect/Engineer/supervisor:</td>
								</tr>
									<td class="text-center" colspan="4">				
									<button type="submit" class="btn btn-success submit1" name="save2" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you want to save..?')" >Save and Next</button>
									</td>
								</tr>									
							</table>
						</form>
					</div>
				</div>
			</div>
			</div>
			</div>
			</div>
			</section>
		</div>
	  <!-- /.content-wrapper -->
	  <?php require '../../../user_area/includes/footer.php'; ?>
	</div>
	<!-- ./wrapper -->
<?php require '../../../user_area/includes/js.php' ?>
<script>
	$('#tab2, #tab3, #tab4, #tab5').css('display', 'none');
	$('a[href="#tab1"]').on('click', function(){
		
		$('#tab1').css('display', 'table');
		$('#tab2, #tab3, #tab4, #tab5').css('display', 'none');
	});
	$('a[href="#tab2"]').on('click', function(){
		
		$('#tab2').css('display', 'table');
		$('#tab1, #tab3, #tab4, #tab5').css('display', 'none');
	});
	$('a[href="#tab3"]').on('click', function(){
		$('#tab3').css('display', 'table');
		$('#tab1, #tab2, #tab4, #tab5').css('display', 'none');
	});
	$('a[href="#tab4"]').on('click', function(){
		$('#tab4').css('display', 'table');
		$('#tab1, #tab2, #tab3, #tab5').css('display', 'none');
	});
	$('a[href="#tab5"]').on('click', function(){
		$('#tab5').css('display', 'table');
		$('#tab1, #tab2, #tab3, #tab4').css('display', 'none');
	});
	/* ----------------------------------------------------- */
		<?php if($is_v_ext=="N"){ ?>
	$('#v_no_floor').attr('disabled', 'disabled');
	<?php } ?>
	$('input[name="is_v_ext"]').on('change', function(){
		if($(this).val() == 'N')
			$('#v_no_floor').attr('disabled', 'disabled');
		else
			$('#v_no_floor').removeAttr('disabled');
	});
	<?php if($is_h_ext=="N"){ ?>
	$('#h_no_floor').attr('disabled', 'disabled');
	<?php } ?>
	$('input[name="is_h_ext"]').on('change', function(){
		if($(this).val() == 'N')
			$('#h_no_floor').attr('disabled', 'disabled');
		else
			$('#h_no_floor').removeAttr('disabled');
	});
	/* ---------------------upload S/C click operation-------------------- */
	
	$('#courierd input').attr('disabled', 'disabled');
	<?php if($file1=='SC' || $file2=='SC' || $file3=='SC' || $file4=='SC' || $file5=='SC' || $file6=='SC' || $file7=='SC' || $file8=='SC'){	?>		
		$('#courierd input').removeAttr('disabled', 'disabled');
	<?php }else{ ?>
		$('#courierd input').attr('disabled', 'disabled');
	<?php } ?>
	/* ------------------------------------------------------ */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
</script>
</body>
</html>		
