<?php  require_once "../../requires/login_session.php";

$check=$formFunctions->is_already_registered('tcp','9');
if($check==1){
	echo "<script>
				alert('Successfully Submitted');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=9&dept=tcp';
		</script>";	
}else if($check==2){
	echo "<script>				
				window.location.href = '".$server_url."departments/requires/courier_details.php?form=9&dept=tcp';
		</script>";
}else if($check==3){
	echo "<script>window.location.href = 'payment_section.php?token=9';</script>";
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
		
		$q=$tcp->query("select * from tcp_form9 where user_id='$swr_id' and active='1'") or die($tcp->error);
		$results=$q->fetch_array();
		if($q->num_rows<1){	
			$form_id="";
			$supervision="";$agency="";$pan="";
			$authority_addres_a="";$authority_addres_b="";$authority_addres_c="";
			$pre_add_sn1="";$pre_add_sn2="";$pre_add_v="";$pre_add_d="";$pre_add_p="";$pre_add_mno="";$pre_add_email="";$pre_add_pan="";
			$file1="";
			$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
		}else{			
			$form_id=$results["form_id"];
			$supervision=$results["supervision"];$agency=$results["agency"];$pan =$results["pan"];
			$file1=$results["file1"];
			if(!empty($results["authority_addres"])){
				$authority_addres=json_decode($results["authority_addres"]);
				$authority_addres_a=$authority_addres->a;$authority_addres_b=$authority_addres->b;$authority_addres_c=$authority_addres->c;
			}else{				
				$authority_addres_a="";$authority_addres_b="";$authority_addres_c="";
			}
			if(!empty($results["pre_add"])){
				$pre_add=json_decode($results["pre_add"]);
				$pre_add_sn1=$pre_add->sn1;$pre_add_sn2=$pre_add->sn2;$pre_add_v=$pre_add->v;$pre_add_d=$pre_add->d;$pre_add_p=$pre_add->p;$pre_add_mno=$pre_add->mno;$pre_add_email=$pre_add->email;$pre_add_pan=$pre_add->pan;	
			}else{				
				$pre_add_sn1="";$pre_add_sn2="";$pre_add_v="";$pre_add_d="";$pre_add_p="";$pre_add_mno="";$pre_add_email="";$pre_add_pan="";
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
	<?php include ("tcp_form9_Addmore.php"); ?> 
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
									<?php echo $form_name=$cms->query("select form_name from tcp_form_names where form_no='9'")->fetch_object()->form_name; ?>
								</h4>	
							</div>
							<div class="panel-body">
							    
								<br>
				<div class="tab-content">
					<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
						<form name="myform1" class="submit1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
                         <table class="table table-responsive">
								<tr>
									<td colspan="4" class="form-inline">
										To <br/>
										 <input type="text"  class="form-control text-uppercase" name="authority_addres[a]" value="<?php echo $authority_addres_a;?>"> <br/><br/><input type="text"  class="form-control text-uppercase" name="authority_addres[b]" value="<?php echo $authority_addres_b;?>"> <br/><br/><input type="text"  class="form-control text-uppercase" name="authority_addres[c]" value="<?php echo $authority_addres_c;?>">
									</td>
			                  <tr>
									<td colspan="4" class="form-inline">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;We hereby apply for enrolment of our Group or Agency in the name and style as mentioned below, as competent technical personnel to do the various works of schemes Building Permit and supervision in the <input type="text"  class=" form-control text-uppercase" name="supervision" value="<?php echo $supervision;?>"><br/>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;We do hereby also declare that we shall follow and shall abide by all the Rules and Regulations now in force and that may be framed from time to time. Name of the group and persons associated with personal bio-data are as follows-</td>
								</tr>
				              <tr>
									<td width="25%"> 1. Name of the Group or Agency:</td>
									<td width="25%"><input type="text"  class="form-control text-uppercase" name="agency" value="<?php echo $agency;?>"></td>
									<td width="25%"></td>
									<td width="25%"></td>
								</tr>
								<tr>
									<td colspan="4">2. Present and Permanent address</td>
								</tr>
								<tr>
									<td colspan="4">(a) Present Address:</td>
								</tr>
								<tr>
									<td>Street Name 1</td>
									<td><input type="text"  class="form-control text-uppercase" name="pre_add[sn1]" value="<?php echo $pre_add_sn1;?>"></td>
									<td>Street Name 2</td>
									<td><input type="text" name="pre_add[sn2]" class="form-control text-uppercase" value="<?php echo $pre_add_sn2;?>"></td>
								</tr>
								<tr>
									<td>Village/Town</td>
									<td><input type="text"  class="form-control text-uppercase" name="pre_add[v]" value="<?php echo $pre_add_v;?>"></td>
									<td>District</td>
									<td><?php $dstresult=$mysqli->query("SELECT * FROM district WHERE district !='' GROUP BY district ASC")OR die("Error : ".$mysqli->error); ?>
								   <select name="pre_add[d]" id="d" required class="form-control text-uppercase">
								   <option value="">Choose a district</option>
								   <?php
										  while($dstrows=$dstresult->fetch_object()) { 
										 if($pre_add_d==$dstrows->district) $s='selected'; else $s=''; ?>
										  <option value="<?php echo $dstrows->district; ?>" <?php echo $s;?>><?php echo $dstrows->district; ?></option>
									<?php } ?>					
								</select></td>
								</tr>
								<tr>
									<td>Pincode</td>
									<td><input validate="pincode" type="text"  class="form-control text-uppercase" name="pre_add[p]" maxlength="6" value="<?php echo $pre_add_p;?>"></td>
									<td>Mobile no.</td>
									<td><input validate="mobileNumber" type="text" name="pre_add[mno]" class="form-control text-uppercase" maxlength="10" value="<?php echo $pre_add_mno;?>" ></td>
								</tr>
								<tr>
									<td>Email ID :</td>
									<td><input  type="email"  class="form-control text-uppercase" name="pre_add[email]"  value="<?php echo $pre_add_email;?>"></td>
									<td>Pan No. :</td>
									<td><input  type="text"  class="form-control text-uppercase" name="pre_add[pan]" maxlength="10" value="<?php echo $pre_add_pan;?>"></td>
								</tr>
								<tr>
									<td colspan="4">(b) Permanent address:</td>
								</tr>
								<tr>
									<td width="25%">Street Name 1</td>
									<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $street_name1; ?>"></td>
									<td width="25%">Street Name 2</td>
									<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $street_name2; ?>"></td>
								</tr>
								<tr>
									<td>Village/Town</td>
									<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $vill; ?>"></td>
									<td>District</td>
									<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $dist; ?>"></td>
								</tr>
								<tr>
									<td>Pincode</td>
									<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $pincode; ?>"></td>
									<td>Mobile No.</td>
									<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $mobile_no; ?>"></td>
								</tr>
								<tr>
									<td>Email ID :</td>
									<td><input type="email" class="form-control text-uppercase" disabled="disabled" value="<?php echo $email; ?>"></td>
									<td>Pan No. :</td>
									<td><input type="text" class="form-control text-uppercase" name="pan" value="<?php echo $pan; ?>" maxlength="10"></td>
								</tr>
								<tr>
									<td colspan="4">3. Name of persons associated with his/ her personal capacity
									and rank and personal bio-data(Certificates enclosed):</td>
						       </tr>
							   <tr>
									<td colspan="4">
									<table name="objectTable1" id="objectTable1" class="table table-responsive text-center" >
										<tr>
											<th width="5%">Slno</th>
											<th width="35%">Name</th>
											<th width="30%">Personal capacity</th>
											<th width="30%">Rank</th>
										</tr>
										<?php
											$part1=$tcp->query("SELECT * FROM tcp_form9_t1 WHERE form_id='$form_id'");
											$num = $part1->num_rows;
											if($num>0){
											  $count=1;
											  while($row_1=$part1->fetch_array()){	?>
												<tr>
													<td><input readonly id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["slno"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>
													<td><input id="txtB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["name"]; ?>" validate="letters" name="txtB<?php echo $count;?>" ></td>
													<td><input value="<?php echo $row_1["personal_cap"]; ?>" id="txtC<?php echo $count;?>"  class="form-control text-uppercase" size="10" name="txtC<?php echo $count;?>"></td>
													<td><input value="<?php echo $row_1["rank"]; ?>" id="txtD<?php echo $count;?>"  class=" form-control text-uppercase" size="10" name="txtD<?php echo $count;?>"></td>
												</tr>	
											<?php $count++; } 
											}else{	?>
											<tr>
												<td><input value="1" id="txtA1" readonly="readonly" size="10" class="form-control text-uppercase" name="txtA1"></td>
												<td><input id="txtB1" size="10" class="form-control text-uppercase" name="txtB1" validate="letters"></td>
												<td><input id="txtC1" size="10"   class="form-control text-uppercase" name="txtC1"></td>	
												<td><input id="txtD1" size="10"  class="form-control text-uppercase" name="txtD1"></td>	
											</tr>
											<?php } ?>														
										</table>
									</td>
								</tr>
								<tr>
									<td colspan="4">													
										<button type="button" class="btn btn-default pull-right" href="#"  onclick="mydelfunction1()" value="">Delete</button>
										<button type="button" class="btn btn-default pull-right" href="#" onClick="addMore1()" value="">Add More</button>
										<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/>
									</td>
								</tr>	
							   <tr>
									<td colspan="4">4. We deposit herewith the annual enrolment fees of Rs.500/- (Five hundred) only in cash as required.</td>
						       </tr>
								<tr>
									<td colspan="4" class="text-bold">List of Documents to be enclosed <br/>(All documents mentioned here are mendatory. Please upload all proper documents before proceeding further).</td>
								</tr>
								<tr>
									<td colspan="2">1. Name of persons associated with his/ her personal capacity
									and rank and personal bio-data(Certificates enclosed):</td>
									<td>
										<select trigger="FileModal" id="file1" class="form-control">                                            
											<option value="0" selected="selected"><?php echo uploadinfo($file1); ?></option>
											<option value="1">From E-Locker</option>
											<option value="2">From PC</option>
											<option value="4">Send by Courier</option>
											<option value="3">Not Applicable</option>
										</select>
										<input type="hidden" name="mfile1" id="mfile1" value="<?php echo $file1 !== '' ? $file1 : ''; ?>" />
									</td>
									<td id="tdfile1">
										<?php if($file1!="" && $file1!="SC" && $file1!="NA"){ echo '<a href="'.$upload.$file1.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
									</td>
								</tr>
								<tr>
									<td colspan="2">Date:<strong><? echo date('d-m-Y',strtotime($today));?></strong></td>
									<td colspan="2">Signature:<strong><? echo strtoupper($key_person);?></strong></td>
								</tr>
						
								<tr>
									<td class="text-center" colspan="4">				
									<button type="submit" class="btn btn-success submit1" name="save9" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you want to save..?')" >Save and Next</button>
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
	
	/* ------------------------------------------------------ */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
</script>
</body>
</html>		
