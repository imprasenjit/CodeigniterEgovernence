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
include "save_form.php";
		
		$row1=$formFunctions->fetch_swr($swr_id);
		
		$full_name=$row1['Key_person'];$owner_type=$row1['Type_of_ownership'];$owner_name=$row1['Name_of_owner'];$pan_no=$row1['pan_no'];$trade_name=$row1['Name'];$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_pincode=$row1['b_pincode'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$pincode=$row1['Pincode'];$block=$row1['block'];$std_code=$row1['Landline_std'];$phone_no=$row1['Landline_no'];$mobile_no=$row1['Mobile_no'];$cap_investment=$row1['Size_of_Investment'];
		$tcp_zone=$row1['b_block'];$id_proof_doc=$row1['id_proof_doc'];
		$sector_classes_b=$row1['sector_classes_b'];
		
		$business_type=get_sector_classes_b_value($sector_classes_b);
		if($cap_investment==10) $cap_investment="Below INR 10 LAKH";
		else if($cap_investment==25) $cap_investment="INR 10 LAKH to 25 LAKH";
		else if($cap_investment==200) $cap_investment="INR 25 LAKH to 2.00 CRORE";
		else if($cap_investment==500) $cap_investment="INR 2.00 CRORE to 5.00 CRORE";
		else if($cap_investment==1000) $cap_investment="INR 5.00 CRORE to 10.00 CRORE";
		else $cap_investment="Above 10.00 CRORE";
		$tcp_zone_name=getZone($tcp_zone);
		
		switch($owner_type){
			case "PR": $owner_type_name="Proprietorship Firm";
			break;
			case "PP": $owner_type_name="Partnership Firm";
			break;
			case "LLP": $owner_type_name="Limited Liability Partnership";
			break;
			case "PTLC": $owner_type_name="Private Limited Company";
			break;
			case "PBLC": $owner_type_name="Public Limited Company";
			break;
			case "CS": $owner_type_name="Cooperative Society";
			break;
			case "AP": $owner_type_name="Association of Persons";
			break;
			case "T": $owner_type_name="Trust";
			break;
			case "C": $owner_type_name="Club";
			break;
			case "H": $owner_type_name="Hindu Undivided Family";
			break;
			case "PSU": $owner_type_name="Public Sector Undertaking";
			break;
			default : $owner_type_name="Proprietorship Firm";
			break;
		}
		$q=$tcp->query("select * from tcp_form1 where user_id='$swr_id' and active='1'");
		$results=$q->fetch_array();
		if($q->num_rows<1){	
			$form_id="";$from_year="";$to_year="";$family_name="";$premises="";$godown="";$old_trade="";$annual_income="";$it_payable="";$license_type="";$horse_power="";$parking="";			
			$dob="";$owner_age="";$street_name_3="";$street_name_4="";$vill2="";$dist2="";$pin2="";$parking="";
			$premises_details_a="";$premises_details_b="";$premises_details_c="";$premises_details_d="";$premises_details_e="";
			$old_trade_details_a="";$old_trade_details_b="";$old_trade_details_c="";
			$godown_details_a="";$godown_details_b="";$godown_details_c="";
			$file1="";$file2="";$file3="";$file4="";$file5="";$file6="";$file7="";$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
		}else{			
			$form_id=$results["form_id"];$from_year=$results["from_year"];$to_year=$results["to_year"];$family_name=$results["family_name"];$premises=$results["premises"];$godown=$results["godown"];$old_trade=$results["old_trade"];$annual_income=$results["annual_income"];$it_payable=$results["it_payable"];$license_type=$results["license_type"];	
						if($godown=="Y"){
				if(!empty($results["godown_details"])){
					$godown_details=json_decode($results["godown_details"]);
					$godown_details_b=$godown_details->b;$godown_details_c=$godown_details->c;
				}else{
					$godown_details_a="";$godown_details_b="";$godown_details_c="";
				}
			}else{
				$godown_details_a="";$godown_details_b="";$godown_details_c="";
			}
			if($old_trade=="Y"){
				if(!empty($results["old_trade_details"])){
					$old_trade_details=json_decode($results["old_trade_details"]);
					
					$old_trade_details_a=$old_trade_details->a;$old_trade_details_b=$old_trade_details->b;$old_trade_details_c=$old_trade_details->c;
				}else{
					$old_trade_details_a="";$old_trade_details_b="";$old_trade_details_c="";
				}
			}else{
				$old_trade_details_a="";$old_trade_details_b="";$old_trade_details_c="";
			}
			if(!empty($results["premises_details"])){
				$premises_details=json_decode($results["premises_details"]);
				$premises_details_a=$premises_details->a;$premises_details_b=$premises_details->b;$premises_details_c=$premises_details->c;$premises_details_d=$premises_details->d;$premises_details_e=$premises_details->e;	
			}else{				
				$premises_details_a="";$premises_details_b="";$premises_details_c="";$premises_details_d="";$premises_details_e="";
			}			
			
		$dob=$results["dob"];$owner_age=$results["owner_age"];

		$q3=$tcp->query("select * from tcp_form1_upload where form_id='$form_id'");
		$results3=$q3->fetch_array();
		if($q3->num_rows>0){	
			$file1=$results3["file1"];$file2=$results3["file2"];$file3=$results3["file3"];$file4=$results3["file4"];$file5=$results3["file5"];$file6=$results3["file6"];$file7=$results3["file7"];
			
		}else{
			$file1="";$file2="";$file3="";$file4="";$file5="";$file6="";$file7="";
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
									<?php echo $form_name=$cms->query("select form_name from tcp_form_names where form_no='1'")->fetch_object()->form_name; ?>
								</h4>	
							</div>
							<div class="panel-body">
							    <ul class="nav nav-pills">
									   <li class="<?php echo $tabbtn1; ?>"><a data-toggle="tab" href="#table1">Details of the Applicant</a></li>
									   <li class="<?php echo $tabbtn2; ?>"><a data-toggle="tab" href="#table2">Details of the Proposed Site</a>
									   </li>
									   <li class="<?php echo $tabbtn3; ?>"><a data-toggle="tab" href="#table3">Details of the Building Plan</a>
									   </li>
									   
									    <li class="<?php echo $tabbtn4; ?>"><a data-toggle="tab" href="#table4">Payment Section</a>
									   </li>
									    <li class="<?php echo $tabbtn5; ?>"><a data-toggle="tab" href="#table5">Upload Section</a>
									   </li>
									  
									</ul>
							
								<br>
								<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									
			 		      
                            <table class="table table-responsive">
						      <tr>
                              <td width="25%">1.  Name of the Applicant :</td>
							     <td width="25%"><input type="text"  class="form-control text-uppercase" name="society_name" value="<?php echo $unit_name; ?>" disabled >
								 </td>
							   </tr>
                              
							     <td width="25%">2. Applicant Address :</td>
							
					            <td> <span class="soc_alert"></span> </td>
				              </tr>
						       <tr>
						      <td> Mouza :</td><td><input type="text"  class="form-control" disabled value="<?php echo $mouza; ?>" ></td>
					   
						      <td>Circle :</td>
							   <td><input type="text"  class="form-control text-uppercase" disabled value="<?php echo $revenue; ?>" ></td>
					       </tr>
					      <tr>
						    <td> Patta no :</td><td><input type="text"  class="form-control text-uppercase" disabled value="<?php echo $pattano; ?>" ></td>
					
						    <td> Dag no :</td><td><input type="text"  class="form-control text-uppercase" disabled value="<?php echo $dagno; ?>" ></td> 
				
					    </tr>
					    <tr>
						   <td> Area : </td><td><input type="text"  class="form-control text-uppercase" disabled value="<?php echo $b_street_name1; ?>" ></td>
				
					
						   <td> Locality : </td><td><input type="text"  class="form-control text-uppercase" disabled value="<?php echo 	$b_street_name2; ?>" ></td>
				
					   </tr>
					   <tr>
						 <td> Village :</td><td><input type="text"  class="form-control text-uppercase" disabled value="<?php echo $b_vill; ?>" ></td>
				
					
						 <td> Post Office :</td><td><input type="text"  class="form-control text-uppercase" id="post_office" name="post_office" value="<?php  echo $post_office; ?>"/></td>
				
					</tr>
					<tr>
						 <td> Police Station :</td><td><input type="text" class="form-control text-uppercase" id="police_station" name="police_station" value="<?php  echo $police_station; ?>"/></td>
				
					    <td>District</td>
						 <td><input type="text"  class="form-control text-uppercase" disabled value="<?php echo $b_dist; ?>" ></td>
								
					</tr>
					<tr>
						 <td>Pin code :</td><td><input type="text"  class="form-control text-uppercase" disabled value="<?php echo $b_pincode; ?>" ></td>
						 </td>
				
				   	</tr>
								  
							  <tr>
							       <td class="25%">3. Father/Mother Name:</td>
									<td class="25%"><input type="text" id="dob" name="reg_date"  class="form-control text-uppercase class_disable" value="<?php echo $reg_date; ?>" <?php if(empty($reg_date)) echo "required";?>></td>
									<td class="half-width">4. Spouse Name:<td class="half-width"><input type="text" name="farm_es_date"  class="form-control text-uppercase" value="<?php if(isset($date_of_commencement)) echo $date_of_commencement; ?>" disabled>
									</td>
							 </tr>
							
			
					    <tr>
					    <td>Mobile No. :</td>
					    <td><input type="text" class="form-control text-uppercase" disabled value="<?php  echo $b_mobile_no; ?>"/></td>
			
					   <td>Email ID :</td>
					    <td><input type="text"  class="form-control text-uppercase" disabled value="<?php echo $b_email; ?>" ></td>
					  </tr>
			         <tr>
					   <td>Pan No. :</td>
					    <td><input type="text"  class="form-control text-uppercase" disabled value="<?php echo $b_email; ?>" ></td>
					  </tr>
					
					<tr>
					  <td class="text-center" colspan="4">				
					  <button type="submit" class="btn btn-success submit1" name="save14" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you want to save..?')" >Save and Next</button>
					  </td>
				   
				  </tr>

				  </table>			
				  </form>
				  </div>
			<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
		    <form name="myform" id="myform21" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
		
		         
		    <table  id=""  class="table table-responsive" >
	
			                             
				              <tr>
                             <td width="25%">1.  Name of the Owner of the Land :</td>
							     <td width="25%"><input type="text"  class="form-control text-uppercase" name="society_name" value="<?php echo $unit_name; ?>" disabled >
								 </td>
                              
							     <td width="25%">2. Name of the Joint Owner :</td>
							     <td width="25%"><input type="text"  class="form-control text-uppercase" name="society_name" value="<?php echo $unit_name; ?>" disabled >
								 </td>
					           
				              </tr>
							   <tr>
							    <td width="25%">2.Address of the Proposed Site:</td>
							
					            <td> <span class="soc_alert"></span> </td>
				              </tr>
							    <tr>
								 <td>House/Plotno:</td><td><input type="text"  class="form-control" disabled value="<?php echo $mouza; ?>" ></td>
								 <td> Dag no(New) :</td><td><input type="text"  class="form-control text-uppercase" disabled value="<?php echo $dagno; ?>" ></td> 
								 </tr>
								 <tr>
								 <td> Dag no(Old) :</td><td><input type="text"  class="form-control text-uppercase" disabled value="<?php echo $dagno; ?>" ></td>
								 <td> Patta no :</td><td><input type="text"  class="form-control text-uppercase" disabled value="<?php echo $pattano; ?>" ></td></tr>
								 <tr>
								 <td> Mouza :</td><td><input type="text"  class="form-control" disabled value="<?php echo $mouza; ?>" ></td>
						        <td> Ward no :</td><td><input type="text"  class="form-control text-uppercase" disabled value="<?php echo $dagno; ?>" ></td> 
								</tr>
								 <tr>
								 <td width="25%">Municipality/Gaon Panchayat Name  :</td>
							     <td width="25%"><input type="text"  class="form-control text-uppercase" name="society_name" value="<?php echo $unit_name; ?>" disabled >
								 </td>
								 <td width="25%">Zone:</td>
							     <td width="25%"><input type="text"  class="form-control text-uppercase" name="society_name" value="<?php echo $unit_name; ?>" disabled >
								 </td>
								 </tr>
								 <tr>
								 <td> Revenue Village :</td><td><input type="text"  class="form-control text-uppercase" disabled value="<?php echo $b_vill; ?>" ></td>
				               <td> Locality : </td><td><input type="text"  class="form-control text-uppercase" disabled value="<?php echo 	$b_street_name2; ?>" ></td>
							   </tr>
							     <tr>
								 <td width="25%">Land Use:</td> 
							     <tr>
										<td>Road/Street Name :</td>
										<td><input type="text" class="form-control text-uppercase" value="<?php echo $b_street_name2; ?>" disabled ></td>
										
										<td>Width of the Road:</td>
										 <td><input type="text" class="form-control text-uppercase" value="<?php echo $b_street_name2; ?>" disabled ></td>
								</tr>
								 <tr>
								 <td>
								(b) Name of owners of adjoining Land:</td></tr>
								
									
										<td>North :</td>
										<td><input type="text" class="form-control text-uppercase"  name="north" value="<?php echo $north; ?>"></td>
										<td>South :</td>
										<td><input type="text" class="form-control text-uppercase"  name="south" value="<?php echo $south; ?>"></td>
									</tr>
									<tr>
										<td>East :</td>
										<td><input type="text" class="form-control text-uppercase"  name="east" value="<?php echo $east; ?>" ></td>
										<td>West</td>
										<td><input type="text" class="form-control text-uppercase"  name="west" value="<?php echo $west; ?>"></td>
									</tr>
			                   </table>
			                   </form>
				               </div>
			 <div id="table3" class="tab-pane <?php echo $tabbtn3; ?>" role="tabpanel">
		    <form name="myform" id="myform21" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
		
		         
		    <table  id=""  class="table table-responsive" >
	
			                             
				               <tr>
                             <td width="25%">1. Building Category:</td>
							     <td width="25%"><input type="text"  class="form-control text-uppercase" name="society_name" value="<?php echo $unit_name; ?>" disabled >
								 </td>
						
								 <td width="25%">2. Proposed Use:</td>
								 <td width="25%"><input type="text"  class="form-control text-uppercase" name="society_name" value="<?php echo $unit_name; ?>" disabled >
								 </tr>
								 <tr>
								 <td>(a) Total plot area (in sq. meter) :</td>
										<td><input type="text" class="form-control text-uppercase" validate="decimal" name="plot_area" value="<?php echo $plot_area; ?>"></td>
										
							  
					
							
								 <td>(b)Document/Building Area (in sq. meter):</td>
										<td><input type="text" class="form-control text-uppercase" validate="decimal" name="plot_area" value="<?php echo $plot_area; ?>"></td>
										<td></td>
										<td></td>
								  </tr>
								    <tr>
								    <td>Type of Construction:</td><input type="text" class="form-control text-uppercase"  name="north" value="<?php echo $no_of_floor; ?>"></td>
								    <td>No. of Floors:</td>
								    <td><input type="text" class="form-control text-uppercase" validate="onlyNumbers" name="no_of_floor" value="<?php echo $no_of_floor; ?>"></td>
									</tr>
									<tr>
								   <td>Margin Set back:</td></tr>
								
									<tr>
										<td>North :</td>
										<td><input type="text" class="form-control text-uppercase"  name="north" value="<?php echo $north; ?>"></td>
										<td>South :</td>
										<td><input type="text" class="form-control text-uppercase"  name="south" value="<?php echo $south; ?>"></td>
									</tr>
									<tr>
										<td>East :</td>
										<td><input type="text" class="form-control text-uppercase"  name="east" value="<?php echo $east; ?>" ></td>
										<td>West</td>
										<td><input type="text" class="form-control text-uppercase"  name="west" value="<?php echo $west; ?>"></td>
									</tr>
								  <tr>
								  <td>Cantilever:</td></tr>
								  <tr>
										<td>North :</td>
										<td><input type="text" class="form-control text-uppercase"  name="north" value="<?php echo $north; ?>"></td>
										<td>South :</td>
										<td><input type="text" class="form-control text-uppercase"  name="south" value="<?php echo $south; ?>"></td>
									</tr>
									<tr>
										<td>East :</td>
										<td><input type="text" class="form-control text-uppercase"  name="east" value="<?php echo $east; ?>" ></td>
										<td>West</td>
										<td><input type="text" class="form-control text-uppercase"  name="west" value="<?php echo $west; ?>"></td>
									</tr>
								   <tr><td>Parking Details:</td></tr>
								    <tr>
 			                       <th>Area</th>
									 <th>Total No.</th>
									 <th>Total Area.(in sq mtrs)</th>
									 </tr>
									 <tr>
									 <td>Basement</td>
									 <td>        </td>
									 <td>        </td>
									 </tr>
									 <tr>
								     <td>Ground</td>
									 <td>     </td>
									 <td>   </td>
									 </tr>
									 <tr>
									 <td>Open</td>
									 <td> </td>
									 <td>  </td>
									 </tr>
								     <tr><td>Area of Floors:</td></tr>
								       <th>Floor</th>
									   <th>Area(in Sq mtr.)</th>
									    <th>Floor</th>
										<th>Area(in Sq mtr.)</th>
										<th>Floor </th>
										<th>Area(in Sq mtr)</th>
										</tr>
										<tr>
										<td>Ground</td>
										<td></td>
										<td>Third</td>
										<td></td>
										<td>Sixth</td>
										<td> </td>
										</tr>
										<tr>
										<td>First</td>
										<td></td>
										<td>Fourth</td>
										<td></td>
										<td>Seventh</td>
										<td></td>
										</tr>
										<tr>
										<td>Second</td>
										<td></td>
										<td>Fifth</td>
										<td></td>
										<td>Eight</td>
										<td></td>
										</tr>
										<tr>
								       <td>Total Area in Sq Mtr:</td><td><input type="text" class="form-control text-uppercase" validate="decimal" name="plot_area" value="<?php echo $plot_area; ?>"></td>
									 
								      <td>Boundary Wall Details(in mtrs):</td><td><input type="text" class="form-control text-uppercase" validate="decimal" name="plot_area" value="<?php echo $plot_area; ?>"></td>
								     
									
									</tr>
									<tr>
									
									 <td>Length:</td><td><input type="text" class="form-control text-uppercase" validate="decimal" name="plot_area" value="<?php echo $plot_area; ?>"></td>
								     <td>Height:</td><td><input type="text" class="form-control text-uppercase" validate="decimal" name="plot_area" value="<?php echo $plot_area; ?>"></td>
									 </tr>
									 
									 <tr>
									  <td colspan="4"> (c) Is there any future provision for :</td>
									     
									</tr>
									<tr>
								
										<td>(i) Vertical extension :</td>
										<td><label class="radio-inline"><input <?php if($is_v_ext=="" || $is_v_ext=="Y") echo "checked"; ?> type="radio" value="Y" id="" name="is_v_ext"> Yes </label>
												<label class="radio-inline"><input type="radio" <?php if($is_v_ext=="N") echo "checked"; ?> value="N" id="" name="is_v_ext"> No </label></td>
										<td>(ii) Horizontal extension :</td>
										<td><label class="radio-inline"><input <?php if($is_h_ext=="" || $is_h_ext=="Y") echo "checked"; ?> type="radio" value="Y" id="" name="is_h_ext"> Yes </label>
												<label class="radio-inline"><input type="radio" <?php if($is_h_ext=="N") echo "checked"; ?> value="N" id="" name="is_h_ext"> No </label></td>			  
										
									
									</tr>
										<tr>
									    <td>(iii) If yes No. of floors :</td>
									    <td><input type="text" class="form-control text-uppercase" validate="onlyNumbers" name="no_of_floor" value="<?php echo $no_of_floor; ?>"></td>
									    
									</tr>
										
							   </table>
							   </form>
							   
	</div>
	<div id="table4" class="tab-pane <?php echo $tabbtn4; ?>" role="tabpanel">
		    <form name="myform" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
		
		         
		    <table  id=""  class="table table-responsive" >
	
			                             
				              <tr>
                              <td width="25%">1. Registration No.:</td>
							     <td width="25%"><input type="text"  class="form-control text-uppercase" name="society_name" value="<?php echo $unit_name; ?>" disabled >
								 </td>
                              
							     <td width="25%">2. Name of RTP :</td>
							     <td width="25%"><input type="text"  class="form-control text-uppercase" name="society_name" value="<?php echo $unit_name; ?>" disabled >
								 </td>
					           </tr>
							   <tr>
					          <td>Mobile No. :</td>
					          <td><input type="text" class="form-control text-uppercase" disabled value="<?php  echo $b_mobile_no; ?>"/></td>
			                 <td>Email Id:</td>
							   <td><input type="text" class="form-control text-uppercase" disabled value="<?php  echo $b_mobile_no; ?>"/></td>
                            </tr>
							  <tr>
							   <td>Fees to be paid:</td>
							   <td><input type="text" class="form-control text-uppercase" disabled value="<?php  echo $b_mobile_no; ?>"/></td>

						      </tr>
							   <tr>
							   <td>Declaration:</td>
							   <td colspan="4">I/We hereby give notice that I intend to erect/re-erect or to make alteration in the House the details as given above which is in accordance with the Building Byelaws of Assamand I/We forward herewith,the following plans and specifications duly signed by me and Registered Technical person duly appointed by us, who have prepared the plans, statements/documents(as applicable).I/We request that the construction may be approved and permission accorded to me to execute the work.I hereby also declare that the contents of the above application and the enclosures are true and correct to my /our knowledge.No part of it is false and nothing has been concealed there form.I agree.
							   <td>
							   
							   </tr>
							   <tr>
							    <td>
							     Name of the Applicant(in Block Letters) :</td>
							    <td><label class="text-uppercase" ><?php echo $key_person; ?></label></td>
								<td>Date:</td>
								
								</tr>
							</table>
							</form>
							</div>
			<div id="table5" class="tab-pane <?php echo $tabbtn5; ?>" role="tabpanel">
		    <form name="myform" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
		
		         
		    <table  id=""  class="table table-responsive" >
           		          <tr>
									<td colspan="5">Documents to be enclosed <br/>(All documents mentioned here are mendatory. Please upload all proper documents before proceeding further).<br/><font color="red">*N/A--Not Available&emsp;*S/C--Send By Courier</td>
								</tr>
                  <tr>
					<td width="50%"> 1. A copy of site plan and building plan as required by building bye laws,ASSAM,and drawn by Technical Personal registered in MB/TC:</td>
					<td width="10%">
					<select trigger="FileModal" id="file1" class="file1" <?php if($file1!="" || $file1=="SC" || $file1=="NA") echo "disabled='disabled'"; ?>>
							<option value="0" selected="selected">Select</option>
							<option value="1">From E-Locker</option>
							<option value="2">From PC</option>
						</select>
					<input type="hidden" name="mfile1" value="<?php if($file1!="") echo $file1; ?>" id="mfile1" value=""/>					
					</td>
					<td width="20%" id="mfile1-chiranjit"><?php if($file1!="" && $file1!="SC" && $file1!="NA"){ echo '<a href="'.$upload.$file1.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file1" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
					<td width="10%"><input type="CheckBox" id="A1" class="file1" name="A1" <?php if($file1=="NA") echo "checked"; ?>  value='A1' <?php if($file1!="" && $file1!="NA") echo "disabled"; ?> onClick="checkData(this)">N/A</input></td>
					<td width="20%"><input type="CheckBox" id="A2" class="file1 cd" name="A2" <?php if($file1=="SC") echo "checked"; ?> value='A2' <?php if($file1!="" && $file1!="SC") echo "disabled"; ?> onClick="checkData(this)">S/C</input></td>	
				</tr>
			     <tr>
					<td>2.Photostat Copy of land document (Such as land deed,Mutation order or Patta).The photocopy is to be self- attested :</td>
					<td><select trigger="FileModal" class="file2" id="file2" <?php if($file2!="" || $file2=="SC" || $file2=="NA") echo "disabled='disabled'"; ?>>
							<option value="0" selected="selected">Select</option>
							<option value="1">From E-Locker</option>
							<option value="2">From PC</option>
						</select>
					<input type="hidden" name="mfile2" value="<?php if($file2!="") echo $file2; ?>" id="mfile2" readonly="readonly"/></td>
					<td width="20%" id="mfile2-chiranjit"><?php if($file2!="" && $file2!="SC" && $file2!="NA"){ echo '<a href="'.$upload.$file2.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file2" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
					<td><input type="CheckBox" id="B1"  class="file2" name="B1" <?php if($file2=="NA") echo "checked"; ?> <?php if($file2!="" && $file2!="NA") echo "disabled='disabled'"; ?> value='B1' onClick="checkData(this)">N/A</input></td>
					<td><input type="CheckBox" id="B2" class="file2 cd" name="B2" <?php if($file2=="SC") echo "checked"; ?> <?php if($file2!="" && $file2!="SC") echo "disabled='disabled'"; ?> value='B2' onClick="checkData(this)">S/C</input></td>
				</tr>
				<tr>
					<td>3.Structural Certificate(as per building bye laws of 2006 )issued by Technical/Personal/Group Agency Registered in MB/TC.: </td>
					<td><select trigger="FileModal" class="file3" id="file3" <?php if($file3!="" || $file3=="SC" || $file3=="NA") echo "disabled='disabled'"; ?> >
							<option value="0" selected="selected">Select</option>
							<option value="1">From E-Locker</option>
							<option value="2">From PC</option>
						</select>
					<input type="hidden" name="mfile3" value="<?php if($file3!="") echo $file3; ?>" id="mfile3" readonly="readonly"/></td>
					<td width="20%" id="mfile3-chiranjit"><?php if($file3!="" && $file3!="SC" && $file3!="NA"){ echo '<a href="'.$upload.$file3.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file3" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
					<td><input type="CheckBox" id="C1" class="file3" name="C1" <?php if($file3=="NA") echo "checked"; ?> <?php if($file3!="" && $file3!="NA") echo "disabled='disabled'"; ?> value='C1' onClick="checkData(this)">N/A</input></td>
					<td><input type="CheckBox" id="C2" class="file3 cd" name="C2" <?php if($file3=="SC") echo "checked"; ?> <?php if($file3!="" && $file3!="SC") echo "disabled='disabled'"; ?> value='C2' onClick="checkData(this)">S/C</input></td>
				</tr>
				<tr>
					<td>4. Service Plan for building when it is above 12:00 m high .:</td>
					<td><select trigger="FileModal" class="file4" id="file4" <?php if($file4!="" || $file4=="SC" || $file4=="NA") echo "disabled='disabled'"; ?> >
							<option value="0" selected="selected">Select</option>
							<option value="1">From E-Locker</option>
							<option value="2">From PC</option>
						</select>
					<input type="hidden" name="mfile4" value="<?php if($file4!="") echo $file4; ?>" id="mfile4" readonly="readonly"/></td>
					<td width="20%" id="mfile4-chiranjit"><?php if($file4!="" && $file4!="SC" && $file4!="NA"){ echo '<a href="'.$upload.$file4.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file4" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
					<td><input type="CheckBox" id="D1" class="file4" name="D1" <?php if($file4=="NA") echo "checked"; ?> <?php if($file4!="" && $file4!="NA") echo "disabled='disabled'"; ?> value='D1' onClick="checkData(this)">N/A</input></td>
					<td><input type="CheckBox" id="D2" class="file4 cd" name="D2" <?php if($file4=="SC") echo "checked"; ?> <?php if($file4!="" && $file4!="SC") echo "disabled='disabled'"; ?> value='D2' onClick="checkData(this)">S/C</input></td>
				</tr>
				<tr>
					<td>5. For boundary wall permission; an undertaking through affidavit shall be required particularly for road side wall.</td>
					<td><select trigger="FileModal" class="file5" id="file5" <?php if($file5!="" || $file5=="SC" || $file5=="NA") echo "disabled='disabled'"; ?>>
							<option value="0" selected="selected">Select</option>
							<option value="1">From E-Locker</option>
							<option value="2">From PC</option>
						</select>
					<input type="hidden" name="mfile5" value="<?php if($file5!="") echo $file5; ?>" id="mfile5" readonly="readonly"/></td>
					<td width="20%" id="mfile5-chiranjit"><?php if($file5!="" && $file5!="SC" && $file5!="NA"){ echo '<a href="'.$upload.$file5.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file5" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
					<td><input type="CheckBox" id="E1" class="file5" name="E1" <?php if($file5=="NA") echo "checked"; ?> <?php if($file5!="" && $file5!="NA") echo "disabled='disabled'"; ?> value='E1' onClick="checkData(this)">N/A</input></td>
					<td><input type="CheckBox" id="E2" class="file5 cd" name="E2" <?php if($file5=="SC") echo "checked"; ?> <?php if($file5!="" && $file5!="SC") echo "disabled='disabled'"; ?> value='E2' onClick="checkData(this)">S/C</input></td>
				</tr>
				<tr>
					<td>6. Key Plan of the Location:</td>
					<td><select trigger="FileModal" class="file6" id="file6" <?php if($file6!="" || $file6=="SC" || $file6=="NA") echo "disabled='disabled'"; ?>>
							<option value="0" selected="selected">Select</option>
							<option value="1">From E-Locker</option>
							<option value="2">From PC</option>
						</select>
					<input type="hidden" name="mfile6" value="<?php if($file6!="") echo $file6; ?>" id="mfile6" readonly="readonly"/></td>
					<td width="20%" id="mfile6-chiranjit"><?php if($file6!="" && $file6!="SC" && $file6!="NA"){ echo '<a href="'.$upload.$file6.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file6" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
					<td><input type="CheckBox" id="F1" class="file6" name="F1" <?php if($file6=="NA") echo "checked"; ?> <?php if($file6!="" && $file6!="NA") echo "disabled='disabled'"; ?> value='F1' onClick="checkData(this)">N/A</input></td>
					<td><input type="CheckBox" id="F2" class="file6 cd" name="F2" <?php if($file6=="SC") echo "checked"; ?> <?php if($file6!="" && $file6!="SC") echo "disabled='disabled'"; ?> value='F2' onClick="checkData(this)">S/C</input></td>
					
					
				</tr>
				<tr>
				<td>7. Soil Test report(Geo-Technical Report)in case of building above 12.00m high.: </td>
					<td><select trigger="FileModal" class="file7" id="file7" <?php if($file7!="" || $file7=="SC" || $file7=="NA") echo "disabled='disabled'"; ?>>
							<option value="0" selected="selected">Select</option>
							<option value="1">From E-Locker</option>
							<option value="2">From PC</option>
						</select>
					<input type="hidden" name="mfile7" value="<?php if($file7!="") echo $file7; ?>" id="mfile7" readonly="readonly"/></td>
					<td width="20%" id="mfile7-chiranjit"><?php if($file7!="" && $file7!="SC" && $file7!="NA"){ echo '<a href="'.$upload.$file7.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file7" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
					<td><input type="CheckBox" id="G1" class="file7" name="G1" <?php if($file7=="NA") echo "checked"; ?> <?php if($file7!="" && $file7!="NA") echo "disabled='disabled'"; ?> value='G1' onClick="checkData(this)">N/A</input></td>
					<td><input type="CheckBox" id="G2" class="file7 cd" name="G2" <?php if($file7=="SC") echo "checked"; ?> <?php if($file7!="" && $file7!="SC") echo "disabled='disabled'"; ?> value='G2' onClick="checkData(this)">S/C</input></td>
					</tr>
					<tr>
				    <td>8. Trace Map.: </td>
					<td><select trigger="FileModal" class="file8" id="file8" <?php if($file8!="" || $file8=="SC" || $file8=="NA") echo "disabled='disabled'"; ?>>
							<option value="0" selected="selected">Select</option>
							<option value="1">From E-Locker</option>
							<option value="2">From PC</option>
						</select>
					<input type="hidden" name="mfile8" value="<?php if($file8!="") echo $file8; ?>" id="mfile8" readonly="readonly"/></td>
					<td width="20%" id="mfile8-chiranjit"><?php if($file8!="" && $file8!="SC" && $file8!="NA"){ echo '<a href="'.$upload.$file8.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file8" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
					<td><input type="CheckBox" id="H1" class="file8" name="H1" <?php if($file8=="NA") echo "checked"; ?> <?php if($file8!="" && $file8!="NA") echo "disabled='disabled'"; ?> value='H1' onClick="checkData(this)">N/A</input></td>
					<td><input type="CheckBox" id="H2" class="file8 cd" name="H2" <?php if($file8=="SC") echo "checked"; ?> <?php if($file8!="" && $file8!="SC") echo "disabled='disabled'"; ?> value='H2' onClick="checkData(this)">S/C</input></td>
					</tr>
					<tr>
					<td>9.Receipt copy of up to date property tax.: </td>
					<td><select trigger="FileModal" class="file9" id="file9" <?php if($file9!="" || $file9=="SC" || $file9=="NA") echo "disabled='disabled'"; ?>>
							<option value="0" selected="selected">Select</option>
							<option value="1">From E-Locker</option>
							<option value="2">From PC</option>
						</select>
					<input type="hidden" name="mfile9" value="<?php if($file9!="") echo $file9; ?>" id="mfile9" readonly="readonly"/></td>
					<td width="20%" id="mfile9-chiranjit"><?php if($file9!="" && $file9!="SC" && $file9!="NA"){ echo '<a href="'.$upload.$file9.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file9" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
					<td><input type="CheckBox" id="I1" class="file9" name="I1" <?php if($file9=="NA") echo "checked"; ?> <?php if($file9!="" && $file9!="NA") echo "disabled='disabled'"; ?> value='I1' onClick="checkData(this)">N/A</input></td>
					<td><input type="CheckBox" id="I2" class="file9 cd" name="I2" <?php if($file9=="SC") echo "checked"; ?> <?php if($file9!="" && $file9!="SC") echo "disabled='disabled'"; ?> value='I2' onClick="checkData(this)">S/C</input></td>
					</tr>
		
				<tr>
				
					<td class="text-center" colspan="4">
						<a href="form2.php?tab=4" class="btn btn-primary">Go Back & Edit</a>										
						<button type="submit" class="btn btn-success submit1" name="submit2" title="Save it and fill up the form later and Go to the Next Part" onclick="return confirm('Do you want to save..?')"> SUBMIT</button>
					</td>
					</tr>
					</table>
					</form>
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
						
						
