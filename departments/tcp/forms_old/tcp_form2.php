<?php  require_once "../../requires/login_session.php";

$check=$formFunctions->is_already_registered('tcp','2');
if($check==1){
	echo "<script>
				alert('Successfully Submitted');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=2&dept=tcp';
		</script>";	
}else if($check==2){
	echo "<script>				
				window.location.href = '".$server_url."departments/requires/courier_details.php?form=2&dept=tcp';
		</script>";
}else if($check==3){
	echo "<script>window.location.href = 'payment_section.php?token=2';</script>";
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
									<?php echo $form_name=$cms->query("select form_name from tcp_form_names where form_no='2'")->fetch_object()->form_name; ?>
								</h4>	
							</div>
							<div class="panel-body">
							    <ul class="nav nav-pills">
									   <li class="<?php echo $tabbtn1; ?>"><a href="#table1">Part 1</a></li>
									   <li class="<?php echo $tabbtn2; ?>"><a href="#table2">Upload Section</a>
									   </li>
									</ul>
								<br>
				<div class="tab-content">
					<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
						<form name="myform1" class="submit1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
                         <table class="table table-responsive">
								<tr>
									<td colspan="4" class="form-inline">
										I/We hereby give notice that I intend to erect/re-erect or to make alteration in the &nbsp; <input type="text"  class="form-control text-uppercase">&nbsp;House No nbsp<input type="text"  class="form-control text-uppercase"> &nbsp;situated at Road &nbsp;<input type="text"  class="form-control text-uppercase">&nbsp;of &nbsp;<input type="text"  class="form-control text-uppercase">&nbsp;area of Ward No &nbsp;<input type="text"  class="form-control text-uppercase">&nbsp;in Dag No&nbsp;<input type="text"  class="form-control text-uppercase">&nbsp;Patta No &nbsp;<input type="text"  class="form-control text-uppercase">&nbsp; of Revenue Village&nbsp;<input type="text"  class="form-control text-uppercase">&nbsp;Mouza &nbsp;<input type="text"  class="form-control text-uppercase">&nbsp;and in accordance with the Building Byelaws of Assam and I forward herewith, the following plans and specifications duly signed by me and &nbsp;<input type="text"  class="form-control text-uppercase">&nbsp;of the Registered Technical Personal, Registration No&nbsp;<input type="text"  class="form-control text-uppercase">&nbsp;who have prepared the plans, statements/documents (as applicable).
									</td>
								</tr>
								<tr>
									<td colspan="4">The schedule of the land is also given below</td>
								</tr>
								<tr>
									<td width="25%">a) Total plot area</td>
									<td width="25%"><input type="text"  class="form-control text-uppercase"></td>
									<td width="25%"></td>
									<td width="25%"></td>
								</tr>
								<tr>
									<td colspan="4">b) Name of owners of adjoining land</td>
								</tr>
								<tr>
									<td>North</td>
									<td><input type="text"  class="form-control text-uppercase"></td>
									<td>South</td>
									<td><input type="text"  class="form-control text-uppercase"></td>
								</tr>
								<tr>
									<td>East</td>
									<td><input type="text"  class="form-control text-uppercase"></td>
									<td>West</td>
									<td><input type="text"  class="form-control text-uppercase"></td>
								</tr>
								<tr>
									<td colspan="4">c) Is there any future provision for</td>
								</tr>
								<tr>
									<td>(i) Vertical extension</td>
									<td><input type="text"  class="form-control text-uppercase"></td>
									<td>(ii) Horizontal extension</td>
									<td><input type="text"  class="form-control text-uppercase"></td>
								</tr>
								<tr>
									<td>(iii) If yes No. Of floors</td>
									<td><input type="text"  class="form-control text-uppercase"></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td>Name of the Applicant</td>
									<td><input type="text"  class="form-control text-uppercase" value="<?php echo strtoupper($key_person) ?>"></td>
									<td>Father/Husband Name</td>
									<td><input type="text"  class="form-control text-uppercase" ></td>
								</tr>
								<tr>
									<td>Mother Name</td>
									<td><input type="text"  class="form-control text-uppercase"></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td colspan="4">Applicant Address :</td>
				              </tr>
						       <tr>
									<td width="25%"> Steert Name 1 :</td>
									<td width="25%"><input type="text"  class="form-control" disabled value="<?php echo $street_name1; ?>" ></td>
									<td width="25%">Street Name 2 :</td>
									<td width="25%"><input type="text"  class="form-control text-uppercase" disabled value="<?php echo $street_name2; ?>" ></td>
								</tr>
								<tr>
									<td>Village/Town :</td>
									<td><input type="text"  class="form-control text-uppercase" disabled value="<?php echo $vill; ?>" ></td>
									<td>District :</td>
									<td><input type="text"  class="form-control text-uppercase" disabled value="<?php echo $dist; ?>" ></td> 
								</tr>
								<tr>
								   <td>Pincode : </td>
								   <td><input type="text"  class="form-control text-uppercase" disabled value="<?php echo $pincode; ?>" ></td>
								   <td>Mobile No. :</td>
									<td><input type="text" class="form-control text-uppercase" disabled value="<?php  echo $mobile_no; ?>"/></td>
							    </tr>
								<tr>
									<td>Email ID :</td>
									<td><input type="text" class="form-control" disabled value="<?php  echo $email; ?>"/></td>
									<td>Pan No. :</td>
									<td><input type="text"  class="form-control text-uppercase" disabled value="<?php echo $pan_no; ?>" ></td>
								</tr>
								<tr>
									<td>Date : <strong><? echo date('d-m-Y',strtotime($today));?></strong></td>
									<td></td>
									<td></td>
									<td align="right">Name Of the Applicant : <strong><?php echo $key_person;?></strong></td>
								</tr>
								<tr>
									<td class="text-center" colspan="4">				
									<button type="submit" class="btn btn-success submit1" name="save2" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you want to save..?')" >Save and Next</button>
									</td>
								</tr>
							</table>			
						</form>
					</div>
					<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
						<form name="myform" id="myform21" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
							<table class="table table-responsive" >
           		          <tr>
									<td colspan="5">Documents to be enclosed <br/>(All documents mentioned here are mendatory. Please upload all proper documents before proceeding further).</td>
								</tr>
								<tr>
									<td width="50%">  Three copies of site plan and building plan as required by building bye laws, ASSAM, and drawn by Technical Personal registered in MB/TC.</td>
									<td width="30%">
                                   <select trigger="FileModal" id="file1" class="form-control">
                                       <option value="0" selected="selected"><?php echo uploadinfo($file1); ?></option>
                                       <option value="1">From E-Locker</option>
                                       <option value="2">From PC</option>
                                       <option value="4">Send by Courier</option>
                                       <option value="3">Not Applicable</option>
										</select>
                                    <input type="hidden" name="mfile1" id="mfile1" value="<?php echo $file1 !== '' ? $file1 : ''; ?>" />
									</td>
									<td width="20%" id="tdfile1">
                                 <?php if($file1!="" && $file1!="SC" && $file1!="NA"){ echo '<a href="'.$upload.$file1.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
									</td>
								</tr>
								<tr>
									<td></td>
									<td width="30%">
                                            <select trigger="FileModal" id="file2" class="form-control">                                            
                                                <option value="0" selected="selected"><?php echo uploadinfo($file2); ?></option>
                                                <option value="1">From E-Locker</option>
                                                <option value="2">From PC</option>
                                                <option value="4">Send by Courier</option>
                                                <option value="3">Not Applicable</option>
                                            </select>
                                            <input type="hidden" name="mfile2" id="mfile2" value="<?php echo $file2 !== '' ? $file2 : ''; ?>" />
									</td>
									<td width="20%" id="tdfile2">
                                            <?php if($file2!="" && $file2!="SC" && $file2!="NA"){ echo '<a href="'.$upload.$file2.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
									</td>
								</tr>
								<tr>
									<td></td>
									<td width="30%">
                                            <select trigger="FileModal" id="file3" class="form-control">                                            
                                                <option value="0" selected="selected"><?php echo uploadinfo($file3); ?></option>
                                                <option value="1">From E-Locker</option>
                                                <option value="2">From PC</option>
                                                <option value="4">Send by Courier</option>
                                                <option value="3">Not Applicable</option>
                                            </select>
                                            <input type="hidden" name="mfile3" id="mfile3" value="<?php echo $file3 !== '' ? $file3 : ''; ?>" />
										</td>
									<td width="20%" id="tdfile3">
                                            <?php if($file3!="" && $file3!="SC" && $file3!="NA"){ echo '<a href="'.$upload.$file3.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
									</td>
									</tr>
									<tr>
										<td>Photostat Copy of land document (Such as land deed, Mutation order or Patta). The photocopy is to be self attested.</td>
										<td width="30%">
                                            <select trigger="FileModal" id="file4" class="form-control">                                            
                                                <option value="0" selected="selected"><?php echo uploadinfo($file4); ?></option>
                                                <option value="1">From E-Locker</option>
                                                <option value="2">From PC</option>
                                                <option value="4">Send by Courier</option>
                                                <option value="3">Not Applicable</option>
                                            </select>
                                            <input type="hidden" name="mfile4" id="mfile4" value="<?php echo $file4 !== '' ? $file4 : ''; ?>" />
										</td>
					<td width="20%" id="tdfile4">
                                            <?php if($file4!="" && $file4!="SC" && $file4!="NA"){ echo '<a href="'.$upload.$file4.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
                     </td>
									</tr>
									<tr>
										<td>Structural Certificate (as per building bye laws of 2006) issued by Technical/Personal/Group Agency Registered in MB/TC.</td>
										<td width="30%">
                                            <select trigger="FileModal" id="file5" class="form-control">                                            
                                                <option value="0" selected="selected"><?php echo uploadinfo($file5); ?></option>
                                                <option value="1">From E-Locker</option>
                                                <option value="2">From PC</option>
                                                <option value="4">Send by Courier</option>
                                                <option value="3">Not Applicable</option>
                                            </select>
                                            <input type="hidden" name="mfile5" id="mfile5" value="<?php echo $file5 !== '' ? $file5 : ''; ?>" />
										</td>
					<td width="20%" id="tdfile5">
                                            <?php if($file5!="" && $file5!="SC" && $file5!="NA"){ echo '<a href="'.$upload.$file5.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
                     </td>
									</tr>
									<tr>
										<td>Service Plan for building when it is above 12:00 m high.</td>
										<td width="30%">
                                            <select trigger="FileModal" id="file6" class="form-control">                                            
                                                <option value="0" selected="selected"><?php echo uploadinfo($file6); ?></option>
                                                <option value="1">From E-Locker</option>
                                                <option value="2">From PC</option>
                                                <option value="4">Send by Courier</option>
                                                <option value="3">Not Applicable</option>
                                            </select>
                                            <input type="hidden" name="mfile6" id="mfile6" value="<?php echo $file6 !== '' ? $file6 : ''; ?>" />
										</td>
					<td width="20%" id="tdfile6">
                                            <?php if($file6!="" && $file6!="SC" && $file6!="NA"){ echo '<a href="'.$upload.$file6.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
                     </td>
										</td>
									</tr>
									<tr>
										<td>For boundary wall permission; an undertaking through affidavit shall be required particularly for road side wall.</td>
										<td width="30%">
                                            <select trigger="FileModal" id="file7" class="form-control">                                            
                                                <option value="0" selected="selected"><?php echo uploadinfo($file7); ?></option>
                                                <option value="1">From E-Locker</option>
                                                <option value="2">From PC</option>
                                                <option value="4">Send by Courier</option>
                                                <option value="3">Not Applicable</option>
                                            </select>
                                            <input type="hidden" name="mfile7" id="mfile7" value="<?php echo $file7 !== '' ? $file7 : ''; ?>" />
										</td>
					<td width="20%" id="tdfile7">
                                            <?php if($file7!="" && $file7!="SC" && $file7!="NA"){ echo '<a href="'.$upload.$file7.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
                     </td>
									</tr>
									<tr>
										<td>Key plan of the location.</td>
										<td width="30%">
                                            <select trigger="FileModal" id="file8" class="form-control">                                            
                                                <option value="0" selected="selected"><?php echo uploadinfo($file8); ?></option>
                                                <option value="1">From E-Locker</option>
                                                <option value="2">From PC</option>
                                                <option value="4">Send by Courier</option>
                                                <option value="3">Not Applicable</option>
                                            </select>
                                            <input type="hidden" name="mfile8" id="mfile8" value="<?php echo $file8 !== '' ? $file8 : ''; ?>" />
										</td>
					<td width="20%" id="tdfile8">
                                            <?php if($file8!="" && $file8!="SC" && $file8!="NA"){ echo '<a href="'.$upload.$file8.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
										</td>
									</tr>
									<tr>
										<td>Soil test report (Geo-Technical Report) in case of building above 12.00 m high.</td>
										<td width="30%">
                                            <select trigger="FileModal" id="file9" class="form-control">                                            
                                                <option value="0" selected="selected"><?php echo uploadinfo($file9); ?></option>
                                                <option value="1">From E-Locker</option>
                                                <option value="2">From PC</option>
                                                <option value="4">Send by Courier</option>
                                                <option value="3">Not Applicable</option>
                                            </select>
                                            <input type="hidden" name="mfile9" id="mfile9" value="<?php echo $file9 !== '' ? $file9 : ''; ?>" />
										</td>
										<td width="20%" id="tdfile9">
                                            <?php if($file9!="" && $file9!="SC" && $file9!="NA"){ echo '<a href="'.$upload.$file9.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
										</td>
									</tr>
									<tr>
										<td>Trace Map.</td>
										<td width="30%">
                                       <select trigger="FileModal" id="file10" class="form-control">                                            
                                                <option value="0" selected="selected"><?php echo uploadinfo($file10); ?></option>
                                                <option value="1">From E-Locker</option>
                                                <option value="2">From PC</option>
                                                <option value="4">Send by Courier</option>
                                                <option value="3">Not Applicable</option>
                                            </select>
                                            <input type="hidden" name="mfile10" id="mfile10" value="<?php echo $file10 !== '' ? $file10 : ''; ?>" />
										</td>
										<td width="20%" id="tdfile10">
                                            <?php if($file10!="" && $file10!="SC" && $file10!="NA"){ echo '<a href="'.$upload.$file10.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
										</td>
									</tr>
									<tr>
										<td>Receipt Copy of up-to- date property tax.</td>
										<td width="30%">
                                       <select trigger="FileModal" id="file11" class="form-control">                                            
                                                <option value="0" selected="selected"><?php echo uploadinfo($file11); ?></option>
                                                <option value="1">From E-Locker</option>
                                                <option value="2">From PC</option>
                                                <option value="4">Send by Courier</option>
                                                <option value="3">Not Applicable</option>
                                            </select>
                                            <input type="hidden" name="mfile11" id="mfile11" value="<?php echo $file10 !== '' ? $file10 : ''; ?>" />
										</td>
										<td width="20%" id="tdfile11">
                                            <?php if($file11!="" && $file11!="SC" && $file11!="NA"){ echo '<a href="'.$upload.$file11.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
										</td>
									</tr>
									<tr>
										<td class="text-center" colspan="4">
										<a href="form2.php?tab=4" class="btn btn-primary">Go Back & Edit</a>										
										<button type="submit" class="btn btn-success submit1" name="submit1" title="Save it and fill up the form later and Go to the Next Part" onclick="return confirm('Do you want to save..?')"> SUBMIT</button>
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
