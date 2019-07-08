<?php 
 require_once "../../requires/login_session.php"; 
$check=$formFunctions->is_already_registered('rfs','1');
if($check==1){
	echo "<script>
				alert('Already Registered');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=1&dept=rfs';
		</script>";	
}else if($check==2){
	echo "<script>				
				window.location.href = '".$server_url."departments/requires/courier_details.php?form=1&dept=rfs';
		</script>";
}else if($check==3){
	$showtab=10;
}else{
	$showtab="";
}	 

$chk_exist=0;## if firm not registered
	##if partner table blank
	$file1="";$file2="";$file3="";$file4="";$file5="";$file6="";$file7="";$file8="";$file9="";$certificate_affidafit="";$firm_duration="";
	
	$sql=$rfs->query("select * from rfs_form1 where user_id='$swr_id' and active='1'");
	
	if(mysqli_num_rows($sql)>0){
		$chk_exist=1;
	}
	
$get_file_name=basename(__FILE__);
   
    $dataStat=0;   //set $dataStat=1 if data needs to be updated else keep it default as $dataStat=0
	$iscomplete=0;//Save mode D than 

	$row1=$row1=$formFunctions->fetch_swr($swr_id);
	
	$Type_of_ownership=$row1['Type_of_ownership'];
	$pan=$row1['pan_doc'];
	if($Type_of_ownership=="PP"){
		$Name_of_owner=$row1['Name_of_owner'];
		$owners=Array();
		$owners=explode(",",$Name_of_owner);
	} 
	$sector_classes_b=$row1['sector_classes_b'];
	$sector_classes_b=get_sector_classes_b_value($sector_classes_b);
	
	$date_of_commencement=$row1['date_of_commencement'];
	$unit_name=$row1['Name'];$pan_no=$row1['pan_no'];
	
	///registered office///
	$land_type=$row1['w_l'];
	$mouza=$row1['mouza'];
    $patta_no=$row1['pattano'];
    $dag_no=$row1['dagno'];
	$b_street_name3=$row1['b_street_name3']; 
	$b_street_name4=$row1['b_street_name4'];
	$b_vill2=$row1['b_vill2'];
	$b_dist2=$row1['b_dist2'];
	
	$b_block2=$row1['b_block2'];
	$b_pincode2=$row1['b_pincode2'];
	$circle=$row1['revenue'];
	$area=$b_street_name3." ,".$b_street_name4;
	//////////
	
	///other than registered office///
	$b_street_name1=$row1['b_street_name1'];
	$b_street_name2=$row1['b_street_name2'];
	$b_vill=$row1['b_vill'];
	$b_dist=$row1['b_dist'];
	$b_block=$row1['b_block'];
	$b_pincode=$row1['b_pincode'];
	$area1=$b_street_name1." ,".$b_street_name2;
if($b_street_name1==$b_street_name3  && $b_street_name2==$b_street_name4 && $b_pincode==$b_pincode2 && $b_vill==$b_vill2)	{
	
	$checked11='disabled ';
	$checked22='checked';
	$style2='display:none';$style3='display:none'; 
}else{
	    $checked11='checked ';
	$checked22='disabled';
		
	  
}
	
if($chk_exist>0){		
	$rows=$sql->fetch_array();
	$firm_duration=$rows["firm_duration"];$firm_date_expiry=$rows["firm_date_expiry"];$form_id=$rows["form_id"];$save_mode=$rows["save_mode"];		
	$fir_addr=$rfs->query("select * from rfs_form1_address where form_id='$form_id' and address_type='P'");
	$adr=$fir_addr->fetch_array();
	$po_name=$adr['po_name'];$ps_name=$adr['ps_name'];$fir_o_addr=$rfs->query("select * from rfs_form1_address where form_id='$form_id' and address_type='O'");
	$adr1=$fir_o_addr->fetch_array();
	$land_type1=$adr1['land_type'];$mouza1=$adr1['mouza'];$circle1=$adr1['circle'];$patta_no1=$adr1['patta_no'];$dag_no1=$adr1['dag_no'];
	$po_name1=$adr1['po_name'];$ps_name1=$adr1['ps_name'];
	$dee=$rfs->query("select * from rfs_form1_credentials where form_id='$form_id'");
	$rodee=$dee->fetch_array();
	$deed_no=$rodee['deed_no'];$deed_date=$rodee['deed_date'];$deed_place=$rodee['deed_place'];$PAN=$rodee['PAN'];$challan_no=$rodee['challan_no'];$challan_date=$rodee['challan_date'];$challan_branch=$rodee['challan_branch'];$challan_amount=$rodee['challan_amount'];$is_certificate=$rodee['is_cer'];$certificate_no=$rodee['cer_no'];$certificate_issue=$rodee['issue_by'];$certificate_date=$rodee['issue_date'];$certificate_affidafit=$rodee['affidafit'];
	
	$firm_docs=$rfs->query("select * from  rfs_form1_docs where form_id='$form_id'");
	if($firm_docs->num_rows>0){
		$firm_docs=$firm_docs->fetch_object();
		//$si_tax_afdt=$firm_docs->si_tax_afdt;
	    $file1=$firm_docs->reg_form;;
	    $file2=$firm_docs->partnership_deed;
	    $file3=$firm_docs->principal_land;
	    $file4=$firm_docs->principal_land_afdt;
	    $file5=$firm_docs->other_land;
	    $file6=$firm_docs->other_land_afdt;
	    $file7=$firm_docs->trade_license;
	    $file8=$firm_docs->pan_card;
	    $file9=$firm_docs->treasury_challan;
	}
}else{
	$firm_name="";$business_nature="";$pan="";$firm_duration="";$farm_es_date="";$firm_date_expiry="";$form_id="";
}
	include("save_form.php");
	$members=$rfs->query("select * from rfs_form1_partners where form_id='$form_id'");
		
      $row4=$members->fetch_array();
  $memberCount=mysqli_num_rows($members); 

  $partner=json_decode($row4['partner_details'],true);
  $form_name=$formFunctions->get_formName("rfs","1");
 

##PHP TAB management
	$showtab=isset($_GET['tab'])?$_GET['tab']:"";
	$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="";
	if($showtab=="" || $showtab<2 || $showtab>6 || is_numeric($showtab)==false){
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
	if($showtab==6){
		$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="active";
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
									<h4 class="text-center" >
										<strong><?php echo $form_name; ?></strong>
									</h4>	
								</div>
								<div class="panel-body">
									<ul class="nav nav-pills">
										<li class="<?php echo $tabbtn1; ?>"><a  href="#table1">DETAILS OF THE FIRM</a></li>
										<li class="<?php echo $tabbtn2; ?>"><a  href="#table2">REGISTERED OFFICE OF THE FIRM</a></li>
										<li class="<?php echo $tabbtn3; ?>"><a  href="#table3">PARTNER'S DETAILS</a></li>
										<li class="<?php echo $tabbtn4; ?>"><a  href="#table4">OTHER DETAILS</a></li>
										<li class="<?php echo $tabbtn5; ?>"><a  href="#table5">UPLOAD</a></li>
										<li class="<?php echo $tabbtn6; ?>"><a  href="#table6">PAYMENT SECTION</a></li>
										
									</ul>
									<br>
									<div class="tab-content">
									<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
			<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
							
							
								<table class="table table-responsive">

								<tr>
									<td>1. Name of the Proposed Firm :</td>
									<td><input type="text" id="firm_name" autofield="of" name="firm_name" class="form-control text-uppercase" pattern="[A-Za-z0-9\s]*" maxlength="30" class="half-text-width" value="<?php echo $unit_name;
									?>" disabled="disabled"/>
		                            
									</td>
								
									<td>2. Nature of Business  :</td>
									<td><input type="text" id="business_nature" name="business_nature" pattern="[A-Za-z\s]*"class="form-control text-uppercase" value="<?php  echo $sector_classes_b; ?>" disabled="disabled"/></td>
								</tr>
		                        
		                        <tr>
									<td>3. PAN No :</td>
									<td><input type="text" class="form-control text-uppercase" id="pan_no" name="pan_no" maxlength="10" value="<?php  echo $pan_no; ?>"  disabled="disabled"></td>
								
									<td >4. Duration of the Firm :</td>
									<td>
									<select  name="firm_duration" class="form-control text-uppercase" id="suni" required="true">
											<option value="">Please Select</option>
											<option  value="U" <?php if(isset($firm_duration)&& $firm_duration=='U') echo "selected"; ?>>UNLIMITED </option>
											<option  value="L" <?php if(isset($firm_duration)&& $firm_duration=='L') echo "selected"; ?>>LIMITED</option>																
									</select>
								</tr>
								<tr>
									<td class="half-width">5.(a) Date of Establishment :</td>
									<td class="half-width"><input type="text" id="dob" name="farm_es_date"  class="form-control text-uppercase" disabled="disabled" value="<?php if(isset($date_of_commencement)) echo date("d-m-Y",strtotime($date_of_commencement)); ?>" required>
									</td>
								<?php if($firm_duration=='U') 
								   { $style1="display:none;";
		                             $req_exp=""; }
									else if($firm_duration=='L'){
									 $style1="display:block:";
									 $req_exp=""; 
									 } else{ $req_exp="required"; }
									 ?>
									<td id="sun" style="<?php echo $style1;?>">(b) Date of Expiry of the firm :</td>
									<td id="su1" style="<?php echo $style1;?>"><input type="text" class="dob form-control" id="su" name="firm_date_expiry"  value="<?php  echo $firm_date_expiry; ?>" <?php echo $req_exp; ?>></td>
									<td></td>
								</tr>
									<tr>
										<td></td>
										<td class="text-center" colspan="2">
											<button type="submit" style="font-weight:bold" name="save1a" class="btn btn-success">Save and Next</button>
										</td>
										<td></td>
									</tr>
								</table>
								</form>
							</div>
    <div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
	<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
								<table id=""  class="table table-responsive">
						<tr>
							<td >
								<b>5. Principle place of the proposed firm</b>
							</td>
						</tr>
						<tr>
							<td>
								Own Land/leased/rented Premises
							</td>
							<td>
								:
							</td>
							<td>
								<select name="p_land_type"id="land_type" disabled="disabled" class="form-control text-uppercase" required >
								    <option  value="">Select Premises</option>
									<option <?php if(isset($land_type)&& $land_type=='O') echo "selected"; ?> value="O">Owned Premises</option>
									<option <?php if(isset($land_type)&& $land_type=='L') echo "selected"; ?> value="L">Leased Premises</option>
									<option <?php  if(isset($land_type)&& $land_type=='R') echo "selected"; ?> value="R">Rented Premises</option>
								</select>
							</td>
						</tr>
						<?php 
                         if(isset($land_type)&& $land_type=='O')
                         {$style1="display:block:";
                          //$required='required';
                     }
                         else
                         {$style1="display:none;";
                          //$required='required';
                     }

						?>
						<tr class="visibleOnOwn" style="<?php echo $style1; ?>">
							<td>Mouza </td>
							<td> : </td>
							<td><input type="text"  readonly="readonly" name="p_mouza" id="p_mouza" class="form-control text-uppercase" value="<?php if(isset($mouza)) echo $mouza; ?>" <?php if(!isset($mouza)) {?>required <?php } ?> />
						
							<td>Circle </td>
							<td> : </td>
							<td><input type="text" readonly="readonly" name="p_circle" id="p_circle" class="form-control text-uppercase" value="<?php if(isset($circle)) echo $circle; ?>"  <?php if(!isset($circle)) {?>required <?php } ?>  />
						</tr>
						<tr class="visibleOnOwn" style="<?php echo $style1; ?>">
							<td>Patta No. </td>
							<td> : </td>
							<td><input type="text" readonly="readonly" name="p_patta_no" id="p_patta_no" class="form-control text-uppercase" value="<?php if(isset($patta_no)) echo $patta_no; ?>" <?php if(!isset($patta_no)) {?>required <?php } ?> />
						
							<td>Dag No. </td>
							<td> : </td>
							<td><input type="text" readonly="readonly" name="p_dag_no" id="p_dag_no" class="form-control text-uppercase" value="<?php if(isset($dag_no)) echo $dag_no; ?>" <?php if(!isset($circle)) {?>required <?php } ?> />
						</tr>
						<tr>
							<td>Area </td>
							<td> : </td>
							<td><input type="text" readonly="readonly" name="p_area_no" class="form-control text-uppercase" value="<?php if(isset($area) && $area!='FA') echo $area; ?>" required />
						
							<td>Village/Town/City </td>
							<td> : </td>
							<td><input type="text" readonly="readonly" name="p_vill_t_c_name" id="p_vill_t_c_name" class="form-control text-uppercase" value="<?php  echo $b_vill2; ?>" required="required" />
						</tr>
						<tr>
							<td>Post Office </td>
							<td> : </td>
							<td><input type="text" name="p_po" id="p_po" class="form-control text-uppercase" value="<?php if(isset($po_name)) echo $po_name; ?>" required="required" />
						
							<td>Police Station </td>
							<td> : </td>
							<td><input type="text" name="p_ps" id="p_ps" class="form-control text-uppercase" value="<?php if(isset($ps_name)) echo $ps_name; ?>" required="required" />
						</tr>
						<tr>
							<td>District </td>
							<td> : </td>
							<td>
								<input type="text"  class="form-control text-uppercase" value="<?php echo $b_dist2; ?>" readonly="readonly"   />
								
							</td>
						
							<td>Pin Code </td>
							<td> : </td>
							<td><input type="text" readonly="readonly" name="p_pin_code" id="p_pin_code" maxlength="6" pattern="[0-9]{6}" class="form-control text-uppercase" value="<?php echo $b_pincode2; ?>" required />
						
						</tr>
						<tr>
							<td colspan="3"><strong>6. Does the proposed firm carry out its business in any other place apart from the registered office ?	</strong></td>
							<td>:</td>
							<td>
								<table>
									<tr>
										<td><input id="is_dif_y" class="is_different" type="radio" value="Y" name="is_different" <?php echo $checked11; ?>>Yes</td>
										<td><input id="is_dif_n" class="is_different" type="radio" value="N" name="is_different" <?php echo $checked22; ?>>No</td>
										
									</tr>
								</table>
							</td>
						</tr>

                    

						
						<tr class="visibleOnTrue" style="<?php echo $style3; ?>">
							<td style="width:40%;">
								Own Land/leased/rented premises
							</td>
							<td style="width:5%;">
								:
							</td>
							<td>
								<select  class="form-control text-uppercase" name="o_land_type" id="o_land_type" >
								    
									<option <?php if(isset($land_type1)&& $land_type1=='O') echo "selected"; ?> value="O">Owned Premises</option>
									<option <?php if(isset($land_type1)&& $land_type1=='L') echo "selected"; ?> value="L">Leased Premises</option>
									<option <?php if(isset($land_type1)&& $land_type1=='R') echo "selected"; ?> value="R">Rented Premises</option>
								</select>
							</td>
						</tr><?php 
                         if(isset($land_type1)&& $land_type1=='O')
                         {$style2="display:block:";
                          //$required='required';
                     }
                         else
                         {$style2="display:none;";
                          //$required='required';
                     }

						?>
                   

						<tr class="visibleOnOwn2 visibleOnTrue" style="<?php echo $style2; ?>">
							<td>Mouza </td>
							<td> : </td>
							<td><input type="text" name="o_mouza" id="o_mouza" class="form-control text-uppercase" value="<?php if(isset($mouza1)) echo $mouza1; ?>" <?php if(!isset($mouza1) && !isset($checked22)) {?>required <?php } ?> />
						
							<td>Circle </td>
							<td> : </td>
							<td><input type="text" name="o_circle" id="o_circle" class="form-control text-uppercase" value="<?php if(isset($circle1)) echo $circle1; ?>" <?php if(!isset($circle1) && !isset($checked22)) {?>required <?php } ?> />
						</tr>
						<tr class="visibleOnOwn2 visibleOnTrue" style="<?php echo $style2; ?>">
							<td>Patta No. </td>
							<td> : </td>
							<td><input type="text" name="o_patta_no" id="o_patta_no" class="form-control text-uppercase" value="<?php if(isset($patta_no1))  echo $patta_no1; ?>" <?php if(!isset($patta_no1) && !isset($checked22)) {?>required <?php } ?> />
						
							<td>Dag No. </td>
							<td> : </td>
							<td><input type="text" name="o_dag_no" id="o_dag_no" class="form-control text-uppercase" value="<?php if(isset($dag_no1)) echo $dag_no1; ?>" <?php if(!isset($dag_no1) && !isset($checked22)) {?>required <?php } ?> />
						</tr>
						<tr class="visibleOnTrue" style="<?php echo $style3; ?>">
							<td>Area </td>
							<td> : </td>
							<td><input type="text" name="o_area_no" id="o_area_no" class="form-control text-uppercase"  value="<?php  echo $area1; ?>" readonly="readonly"/>
						
							<td>Village/Town/City </td>
							<td> : </td>
							<td><input type="text" name="o_vill_t_c_name" id="o_vill_t_c_name" class="form-control text-uppercase" value="<?php echo $b_vill; ?>" readonly="readonly"/>
						</tr>
						<tr class="visibleOnTrue" style="<?php echo $style3; ?>">
							<td>Post Office </td>
							<td> : </td>
							<td><input type="text" name="o_po" id="o_po" class="form-control text-uppercase" value="<?php if(isset($po_name1)) echo $po_name1; ?>" <?php if(!isset($checked22)){ ?> required <?php } ?> />
						
							<td>Police Station </td>
							<td> : </td>
							<td><input type="text" name="o_ps" id="o_ps" class="form-control text-uppercase" value="<?php if(isset($ps_name1)) echo $ps_name1; ?>" <?php if(!isset($checked22)){ ?> required <?php } ?> />
						</tr>
						<tr class="visibleOnTrue" style="<?php echo $style3; ?>">
							<td>District</td>
							<td> : </td>
							<td>
								<input type="text"  class="form-control text-uppercase" value="<?php echo $b_dist; ?>" readonly="readonly"   />
								</select>
							</td>
						
							<td>Pin Code </td>
							<td> : </td>
							<td><input type="text" class="form-control text-uppercase" value="<?php echo $b_pincode ?>" readonly="readonly" />
									
						</tr>
						</table>			
								
								<div align="center">
								<a type="button" href="form1.php?tab=1" class="btn btn-primary">Go Back & Edit</a>
								<button type="submit"  style="font-weight:bold" name="save1b" class="btn btn-success">Save and Next</button>
									</div>	
							</form>
							</div>
							
			<div id="table3" class="tab-pane <?php echo $tabbtn3; ?>" role="tabpanel">
			<form name="myform1" id="myform3" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
			<b>7. Name in full and permanent address of all the partners of the firm alongwith the date of
joining, their passport size photograph and scanned copy of signature of each partner:</b>
			<table id="field7"  class="table table-responsive">
				<thead>
						<tr>
							<td>Sl. No.</td>
							<td>Full Name of partners</td>
							<td>Permanent Address</td>
							<td>Date of Joining</td>
							<td>Uploads</td>
							
						</tr>
					</thead>
					
							<?php
				if(!(empty($partner))){
					
                   
					$moreindex1=count($partner); 
					for($m=1;$m<=count($partner);$m++){					
	                    $p="p$m";
						$upload1="upload/";
						?>
						
						<tr >
						<td><?php echo ($m); ?></td>
						<td>
						
						<input type="text" validate="specialChar" class="form-control text-uppercase" name="partner[<?php echo $m; ?>][pname]" pattern="[a-zA-Z_/.\s]+$" value="<?php echo $partner[$m]['pname']; ?>" readonly="readonly"/>
						</td>

						
						<td ><textarea class="form-control text-uppercase" name="partner[<?php echo $m; ?>][paddr]"  ><?php echo $partner[$m]['paddr']; ?></textarea></td>
						<td ><input type="text" class="dob form-control text-uppercase" name="partner[<?php echo $m; ?>][dateofjoin]"  value="<?php echo $partner[$m]['dateofjoin'];  ?>" required/></td>
						<td class="quarter-width">
											 <table>
											  <tr>
											   <td>Photo</td>
											   <td>
										  <span id="photo<?php echo $m;?>a">
										   <div class="cropme" style=" width: 40px; height: 0px; " id="ep<?php echo $m;?>a" >
											  <i class="fa fa-pencil-square-o" aria-hidden="true"></i><span onclick="crop_test('p<?php echo $m;?>a')">Edit</span>
											  </div>
											  <span id="vp<?php echo $m;?>a" style="float: left;">
											  <a href="../forms/upload/<?php echo $partner[$m]['photo'];  ?>" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>
											  </span>
											  </span>
										   <input type="hidden" value="<?php echo $partner[$m]['photo'];  ?>" id="fp<?php echo $m;?>a" name="partner[<?php echo $m;?>][photo]" />
									   </td>
									  </tr>
							  <tr>
							   <td>Sign</td>
							   <td>
							     <span id="sign<?php echo $m;?>b">
								   <div class="cropme" style=" width: 40px; height: 0px; " id="ep<?php echo $m;?>b" >
									  <i class="fa fa-pencil-square-o" aria-hidden="true"></i><span onclick="crop_test('p<?php echo $m;?>b')">Edit</span>
									  </div>
									  <span id="vp<?php echo $m;?>b" style="float: left;">
									  <a href="../forms/upload/<?php echo $partner[$m]['sign'];  ?>" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>
									  </span>
									  </span>
							       <input type="hidden" value="<?php echo $partner[$m]['sign'];  ?>" id="fp<?php echo $m;?>b" name="partner[<?php echo $m;?>][sign]" />
							   </td>
							  </tr>
							  <tr>
							   <td>Pan</td>
							   <td>
							     <span id="pan<?php echo $m;?>c">
								   <div class="cropme" style=" width: 40px; height: 0px; " id="ep<?php echo $m;?>c" >
									  <i class="fa fa-pencil-square-o" aria-hidden="true"></i><span onclick="crop_test('p<?php echo $m;?>c')">Edit</span>
									  </div>
									  <span id="vp<?php echo $m;?>c" style="float: left;">
									  <a href="../forms/upload/<?php echo $partner[$m]['pan'];  ?>" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>
									  </span>
							       <input type="hidden" value="<?php echo $partner[$m]['pan'];  ?>" id="fp<?php echo $m;?>c" name="partner[<?php echo $m;?>][pan]" />
											   </td>
											  </tr>
											 </table>
											
											</td>
						
						
					</tr>
						
				<?php
					
					}
				}else { 
                  for($i=1;$i<=count($owners);$i++){ ?>
						
				
			
					<tr>
						<td><?php echo $i; ?></td>
						<td>
						
						<input type="text" class="form-control text-uppercase" name="partner[<?php echo $i; ?>][pname]" pattern="[a-zA-Z_/.\s]+$" readonly="readonly" value="<?php echo $owners[$i-1]; ?>"/>
						</td>
						
						<td ><textarea class="form-control text-uppercase" name="partner[<?php echo $i; ?>][paddr]" ></textarea></td>
						<td ><input type="text"  style="width:140px" class="dob form-control text-uppercase" name="partner[<?php echo $i; ?>][dateofjoin]"  required/></td>
						
						<td colspan="3">
							<table class="table table-responsive">
							<tr>
							<td>Photo</td><td>
							<span id="photo<?php echo $i; ?>a"><div class="cropme" style="width: 70px; height: 30px;" id="sp<?php echo $i; ?>a" >
										  <input type="button" onclick="crop_test('p<?php echo $i; ?>a')"  name="upload<?php echo $i; ?>a" id="test"  class="btn btn-primary"  value="upload"  />
							
										  </div><div class="cropme" style="display: none; width: 40px; height: 0px; " id="ep<?php echo $i; ?>a" >
										  <i class="fa fa-pencil-square-o" aria-hidden="true"></i><span onclick="crop_test('p<?php echo $i; ?>a')">Edit</span>
										  
										  </div>
										  <span id="vp<?php echo $i; ?>a" style="float: left;" ></span>
										  <input type="hidden"  id="fp<?php echo $i; ?>a"  required="required" name="partner[<?php echo $i; ?>][photo]" />
							
							</span>
							</td>
							</tr>
							<tr>
							<td>Sign</td><td>
							<span id="sign<?php echo $i; ?>b"><div class="cropme" style="width: 70px; height: 30px;" id="sp<?php echo $i; ?>b" >
										  <input type="button" onclick="crop_test('p<?php echo $i; ?>b')"  name="upload<?php echo $i; ?>b" id="test"  class="btn btn-primary"  value="upload"  />
							
										  </div><div class="cropme" style="display: none; width: 40px; height: 0px; " id="ep<?php echo $i; ?>b" >
										  <i class="fa fa-pencil-square-o" aria-hidden="true"></i><span onclick="crop_test('p<?php echo $i; ?>b')">Edit</span>
										  
										  </div>
										  <span id="vp<?php echo $i; ?>b" style="float: left;" ></span>
										  <input type="hidden"  id="fp<?php echo $i; ?>b"  required="required" name="partner[<?php echo $i; ?>][sign]" />
							
							</span>
							</td>
							</tr>
							<tr>
							<td>Pan</td><td>
							<span id="pan<?php echo $i; ?>c"><div class="cropme" style="width: 70px; height: 30px;" id="sp<?php echo $i; ?>c" >
										  <input type="button" onclick="crop_test('p<?php echo $i; ?>c')"  name="upload<?php echo $i; ?>c" id="test"  class="btn btn-primary"  value="upload"  />
							
										  </div><div class="cropme" style="display: none; width: 40px; height: 0px; " id="ep<?php echo $i; ?>c" >
										  <i class="fa fa-pencil-square-o" aria-hidden="true"></i><span onclick="crop_test('p<?php echo $i; ?>c')">Edit</span>
										  
										  </div>
										  <span id="vp<?php echo $i; ?>c" style="float: left;" ></span>
										  <input type="hidden"  id="fp<?php echo $i; ?>c"  required="required" name="partner[<?php echo $i; ?>][pan]" />
							
							</span>
							</td>
							</tr>	
							</table>
						</td>
						</tr>
						
				<?php  } }?>
				
				         <tr id="sunil" colspan="6">&nbsp;</tr>
					</tbody>
				</table>	
												
							<div align="center">
							<a type="button" href="form1.php?tab=2" class="btn btn-primary">Go Back & Edit</a>
							<button type="submit"  style="font-weight:bold" name="save1c" class="btn btn-success">Save and Next</button>
						</div>	
					</form>
				</div>



			<div id="table4" class="tab-pane <?php echo $tabbtn4; ?>" role="tabpanel">
			<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
			<b>8. Registered Deed of Partnership </b>
			<table id=""  class="table table-responsive">
				<tr>
							<td>Deed No. </td>
							
							<td> <input type="text" class="form-control text-uppercase" name="deed_no"  value="<?php if(isset($deed_no)){ echo $deed_no;} ?>" required/>
						
							<td>Date </td>
							
							<td> <input type="text" class="form-control text-uppercase" id="dob2" name="deed_date" value="<?php if(isset($deed_date)){ echo $deed_date;} ?>" required/>
						</tr>
						<tr>
							<td>Place of Deed Registration </td>
						
							<td> <input type="text" class="form-control text-uppercase" name="deed_reg_place" id="deed_reg_place" value="<?php if(isset($deed_place)){ echo $deed_place;} ?>" required /></td>
						</tr>
					</table>
					<br/>
					
					<table class="table table-responsive">
						

                        <?php
                        if(isset($is_certificate)){
						if($is_certificate=='Y')
							{$cheked_certificate_y="checked";$cheked_certificate_n="";$style_c="display: blocked:";$requiredc="required";}
						else{$cheked_certificate_y="";$cheked_certificate_n="checked";$style_c="display: none;";$requiredc="";}
					        }
					     else
					        {$cheked_certificate_y="checked";$cheked_certificate_n="";$style_c="display: blocked:";$requiredc="required";}

						?>
                        
						<tr>
							<td><b>9. Sales tax clearance / Affidavit<b></td>
							<td> <input onclick="show_sales(1,'Y')"  class="afid1" type='radio' name='piscertificate' value='Y' <?php echo $cheked_certificate_y; ?> />Yes</td>
							<td><input onclick="show_sales(1,'N')" class="afid1" type='radio' name='piscertificate' value='N' <?php echo $cheked_certificate_n; ?>/>No</td>
						</tr>

						
						
		

                       
						<tr id='sales_tax1' style="<?php echo $style_c; ?>">
							<td style="<?php //echo $style_c; ?>">Enter Certificate No </td>
							
							<td colspan="2"><input type='text' id="c_no1" class="form-control text-uppercase" name="pcertificateno" value="<?php if(isset($certificate_no)){echo $certificate_no;} ?>" <?php echo $requiredc; ?> /></td>
						
							<td>Certificate Issue By </td>
							
							<td colspan="2"><input type='text' id="c_by1" name="pcer_issuedby" class="form-control text-uppercase"  value="<?php if(isset($certificate_issue)){echo $certificate_issue;} ?>"   <?php echo $requiredc; ?> /></td>
						</tr>
						
						<tr id='sales_tax2' style="<?php echo $style_c; ?>">
							<td style="<?php // echo $style_c; ?>">Certificate Issue Date </td>
							
							<td colspan="2"><input type='text' id="c_date1" class="dob form-control text-uppercase"  name="pcer_issuedate" value="<?php if(isset($certificate_date)){echo $certificate_date;} ?>"   <?php echo $requiredc; ?> /></td></td>
						
							<td>Upload File</td>
							
							<td><select trigger="FileModal" id="file1" class="file1 form-control text-uppercase" <?php if($certificate_affidafit!="" || $certificate_affidafit=="SC" || $certificate_affidafit=="NA") echo "disabled='disabled'"; ?>>
									<option value="0" selected="selected">Select</option>
									<option value="1">From E-Locker</option>
									<option value="2">From PC</option>
								</select>
							<input type="hidden" name="paffidavid" value="<?php if($certificate_affidafit!="") echo $certificate_affidafit; ?>" id="mfile1" value=""/>					
						</td>
						<td id="mfile1-chiranjit"><?php if($certificate_affidafit!="" && $certificate_affidafit!="SC" && $certificate_affidafit!="NA"){ echo '<a href="'.$upload.$certificate_affidafit.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file1" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
			
							</tr>
						
				
					
			           <tr>
							<td colspan="4">
							  <b>10. Treasury Challan </b>
							</td>
						</tr>
						<tr>
							<td> No.</td>
							
							<td colspan="2"><input type="text" class="form-control text-uppercase" name="t_challan_no" value="<?php if(isset($challan_no)){echo $challan_no;} ?>" required/></td>
						
							
							<td>Date</td>
							
							<td colspan="2"><input type="text" class="date_picker form-control text-uppercase" name="t_challan_date" value="<?php if(isset($challan_date)){echo $challan_date;} ?>" required/></td>
						</tr>
						<tr>
							
							<td> Branch</td>
							
							<td colspan="2"><input type="text" class="form-control text-uppercase" name="branch_name" value="<?php if(isset($challan_branch)){echo $challan_branch;} ?>" required/></td>
						
							<?php //if(isset($challan_amount)){echo $challan_amount;} ?>
							<td> Amount</td>
							
							<td colspan="2"><input type="text" class="form-control text-uppercase" name="t_amount" id="t_amount" value="Rs 50/-" readonly  required/></td>
						</tr>
									
								</table>
								<div align="center">
								<a type="button" href="form1.php?tab=3" class="btn btn-primary">Go Back & Edit</a>
											<button type="submit"  style="font-weight:bold" name="save1d" class="btn btn-success">Save and Next</button>
									</div>	
							</form>
			</div>		


			<div id="table5" class="tab-pane <?php echo $tabbtn5; ?>" role="tabpanel">
			<form name="myform1" id="myform5" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
				<table  id=""  class="table table-responsive" >										
								<tr>
									<td colspan="5">Documents to be enclosed <br/>(All documents mentioned here are mendatory. Please upload all proper documents before proceeding further).<br/><font color="red">*N/A--Not Available&emsp;*S/C--Send By Courier</td>
								</tr>
								<tr>
					<td width="50%">   Filled in Form No. I and witnessed by either a judicial Magistrate or a Chartered Accountant </td>
					<td width="10%">
					<select trigger="FileModal" id="file10" class="file10" <?php if($file1!="" || $file1=="SC" || $file1=="NA") echo "disabled='disabled'"; ?>  >
							<option value="0" selected="selected">Select</option>
							<option value="1">From E-Locker</option>
							<option value="2">From PC</option>
						</select>
					<input type="hidden" name="mfile10" value="<?php if($file1!="") echo $file1; ?>" id="mfile10" value=""/>					
					</td>
					<td width="20%" id="mfile10-chiranjit"><?php if($file1!="" && $file1!="SC" && $file1!="NA"){ echo '<a href="'.$upload.$file1.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file10" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
					<td width="10%"><input type="CheckBox" id="J1" class="file10" name="J1" <?php if($file1=="NA") echo "checked"; ?>  value='J1' <?php if($file1!="" && $file1!="NA") echo "disabled"; ?> onClick="checkData(this)">N/A</input></td>
					<td width="20%"><input type="CheckBox" id="J2" class="file10 cd" name="J2" <?php if($file1=="SC") echo "checked"; ?> value='J2' <?php if($file1!="" && $file1!="SC") echo "disabled"; ?> onClick="checkData(this)">S/C</input></td>	
				</tr>
				
				<tr>
			     <tr>
					<td>Cerified copy of Registered Deed of Partnership</td>
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
				<tr><?php if ($land_type=="O"){ echo ""?>
					<td>Land Document (Jamabandi / Mutation Order / Registered Sale deed/Govt allotment order) for office accomodation of the principal place of business.</td>
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
				<?php ; }else if ($land_type=="L"){?>
				<tr>
					<td>	if not Land Lease Agreement/Affidavit from the house owner if does not have own land for principal place of business </td>
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
				<?php ;}?>
				<?php if ($land_type1!="") {
					if ($land_type1=="O"){ echo "" ?>
				<tr>
					<td> Land Document (Jamabandi / Mutation Order / Registered Sale deed/Govt allotment order) for office accomodation of any other place of business.</td>
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
				<?php ; }else if ($land_type1=="L" ||$land_type1=="R"){?>
				<tr>
					<td>	if not Land Lease Agreement/Affidavit from the house owner if does not have own land for any other place of business.</td>
					<td><select trigger="FileModal" class="file6" id="file6" <?php if($file6!="" || $file6=="SC" || $file6=="NA") echo "disabled='disabled'"; ?>>
							<option value="0" selected="selected">Select</option>
							<option value="1">From E-Locker</option>
							<option value="2">From PC</option>
						</select>
					<input type="hidden" name="mfile6" value="<?php if($file6!="") echo $file6; ?>" id="mfile6" readonly="readonly"/></td>
					<td width="20%" id="mfile6-chiranjit"><?php if($file6!="" && $file6!="SC" && $file6!="NA"){ echo '<a href="'.$upload.$file6.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file6" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
					<td><input type="CheckBox" id="F1" class="file6" name="F1" <?php if($file6=="NA") echo "checked"; ?> <?php if($file6!="" && $file6!="NA") echo "disabled='disabled'"; ?> value='E1' onClick="checkData(this)">N/A</input></td>
					<td><input type="CheckBox" id="F2" class="file6 cd" name="F2" <?php if($file6=="SC") echo "checked"; ?> <?php if($file6!="" && $file6!="SC") echo "disabled='disabled'"; ?> value='E2' onClick="checkData(this)">S/C</input></td>
				</tr>
				<?php ;}} else{ null;}?>
				<tr>
					<td> Trade License obtained from the Municipal Corporation/ Municipal Board / Town commitee or Gaon Panchayat</td>
					<td><select trigger="FileModal" class="file7" id="file7" <?php if($file7!="" || $file7=="SC" || $file7=="NA") echo "disabled='disabled'"; ?>>
							<option value="0" selected="selected">Select</option>
							<option value="1">From E-Locker</option>
							<option value="2">From PC</option>
						</select>
					<input type="hidden" name="mfile7" value="<?php if($file7!="") echo $file7; ?>" id="mfile7" required="required"/></td>
					<td width="20%" id="mfile7-chiranjit"><?php if($file7!="" && $file7!="SC" && $file7!="NA"){ echo '<a href="'.$upload.$file7.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file7" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
					<td><input type="CheckBox" id="G1" class="file7" name="G1" <?php if($file7=="NA") echo "checked"; ?> <?php if($file7!="" && $file7!="NA") echo "disabled='disabled'"; ?> value='E1' onClick="checkData(this)">N/A</input></td>
					<td><input type="CheckBox" id="G2" class="file7 cd" name="G2" <?php if($file7=="SC") echo "checked"; ?> <?php if($file7!="" && $file7!="SC") echo "disabled='disabled'"; ?> value='E2' onClick="checkData(this)">S/C</input></td>
				</tr>
				<tr>
					<td>PAN Card of the firm</td>
					<td><a href="<?php echo $upload.$pan;?>" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;</td>
					
				</tr>
			
				 
				<tr>
					<td class="text-center" colspan="4">
						<a href="form1.php?tab=4"><button type="submit" class="btn btn-primary">Go Back & Edit</button></a>										
						<button type="submit" class="btn btn-success" name="submit1e" title="Save it and fill up the form later and Go to the Next Part" > SUBMIT</button>
					</td>
					</tr>
					        </table>
			             </form>
		               </div>
					   
					
				
<div id="table6" class="tab-pane <?php echo $tabbtn6; ?>" role="tabpanel">
	<form name="myform1" id="" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
	<table  id=""  class="table table-responsive" >
	<tr>
		<td>
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<div class="form-inline">
						<strong>Select your mode of payment &nbsp; &nbsp; &nbsp;</strong>
						<input type="radio" name="payment_mode" value="1"> Online Payment
						<input type="radio" name="payment_mode" value="0" checked> Offline Payment
					</div>
				</div>
			</div>
			<br>
			<div id="offlinePayDetials">
				<div class="row">
					<div class="col-md-6 col-md-offset-4">
						<!--<strong>Application Fee Payment Reciept ( <i class="fa fa-1x fa-inr"></i> 50 )</strong>
						<p>Bank Name : <br/>
							Bank Account No. :<br/>
							Entity Name : <br/>
							RTGS IFSC Code : <br/>
							NEFT IFSC Code : 
						</p>-->
						<div class="uploadfieldtrick">
							<b>Upload Treasary Challan :</b>
							<input type="button" upload="file" class="file" id="file" value="Browse">
							<input type="hidden" required name="offline_challan" value="" id="mfile" readonly="readonly"/>
							<span id="mfile-chiranjit">No File Selected</span>
						</div>
					</div>
				</div>
			</div>
			<br><br>
		</td>
		</tr>
		<tr>
		<td class="text-center">
			<a type="button" href="gmc_form1.php?tab=5" class="btn btn-primary avoid_me">Go Back & Edit</a>&nbsp;<button type="submit" style="font-weight:bold" name="submit1f" class="btn btn-success">Save and Next</button>
		</td>
		</tr>
		</table>
	</form>
	</div></div>
			</div></div>
		</div>
	</div>
</section>
</div>
  <!-- /.content-wrapper -->
  <?php require '../../../user_area/includes/footer.php'; ?>
</div>
<!-- ./wrapper -->
<?php require '../../../user_area/includes/js.php'; ?>
<link rel="stylesheet" type="text/css" href="../crop_image/css/style.css" />
    <link rel="stylesheet" type="text/css" href="../crop_image/css/style-example.css" />
    <link rel="stylesheet" type="text/css" href="../crop_image/css/jquery.Jcrop.css" />

    <!-- Js files-->
    <script type="text/javascript" src="../crop_image/scripts/jquery-1.10.2.min1.js"></script>
    <script type="text/javascript" src="../crop_image/scripts/jquery.Jcrop.js"></script>
    <script type="text/javascript" src="../crop_image/scripts/jquery.SimpleCropper.js"></script>
<?php require '../includes/rfs_js.php'; ?>
<script>
$(document).ready(function(){
  
  $('#suni').on('change', function(){

  	if($('#suni option:selected').val() == 'U')
  	{ 
  		
      $('#su').prop('disabled',true);
      $('#su1').css('display','none');
      $('#sun').css('display','none');
     }else if($('#suni option:selected').val() == 'L') 
     {
	  $('#su').prop('disabled',false);
      //$('#su1').css('display','block');
	   $('#su1').show();
	  $('#sun').css('display','block');
		 
     }
     
    });
  });

$('#tab2, #tab3, #tab4').css('display', 'none');
$('a[href="#tab1"]').on('click', function(){
	$('#tab1').css('display', 'table');
	$('#tab2, #tab3, #tab4').css('display', 'none');
});
$('a[href="#tab2"]').on('click', function(){
	$('#tab2').css('display', 'table');
	$('#tab1, #tab3, #tab4').css('display', 'none');
});
$('a[href="#tab3"]').on('click', function(){
	$('#tab3').css('display', 'table');
	$('#tab1, #tab2, #tab4').css('display', 'none');
});
$('a[href="#tab4"]').on('click', function(){
	$('#tab4').css('display', 'table');
	$('#tab1, #tab2, #tab3').css('display', 'none');
});

/* ----------------------------------------------------- */

</script>
        </body>
</html>