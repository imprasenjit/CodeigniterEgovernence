<?php  require_once "../../requires/login_session.php";
$dept="gmc";
$form="10";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);	
include "save_form_new.php";
	if(strtoupper($b_dist)!="KAMRUP METROPOLITAN"){
		echo "<script>
				alert('Since your business is not situated in Kamrup Metropolitan so you are not allowed to fill up the application form under Guwahati Municipal Corporation.');
				window.location.href = '".$server_url."user_area/';
		</script>";	
	}

	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
	if($q->num_rows<1){	 
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
		if($p->num_rows>0){
			$results=$p->fetch_assoc();
			$form_id=$results["form_id"];$purpose_name=$results["purpose_name"];$reference_no=$results["reference_no"];$submitted_date=$results["submitted_date"];$received_dt=$results["received_dt"];$to_the=$results["to_the"];
			
	   if(!empty($results["developer"])){
			$developer=json_decode($results["developer"]);
			$developer_name=$developer->name;$developer_streetname1=$developer->streetname1;$developer_streetname2=$developer->streetname2;$developer_vill=$developer->vill;$developer_dist=$developer->dist;$developer_block=$developer->block;$developer_pin=$developer->pin;$developer_mobileno=$developer->mobileno;$developer_sign=$developer->sign;	
		}else{				
			$developer_name="";$developer_streetname1="";$developer_streetname2="";$developer_vill="";$developer_dist="";$developer_block="";$developer_pin="";$developer_mobileno="";$developer_sign="";
		} 
		
		if(!empty($results["owner1"])){
			$owner1=json_decode($results["owner1"]);
			$owner1_name=$owner1->name;$owner1_streetname1=$owner1->streetname1;$owner1_streetname2=$owner1->streetname2;$owner1_vill=$owner1->vill;$owner1_dist=$owner1->dist;$owner1_block=$owner1->block;$owner1_pin=$owner1->pin;$owner1_mobileno=$owner1->mobileno;$owner1_sign=$owner1->sign;	
		}else{				
			$owner1_name="";$owner1_streetname1="";$owner1_streetname2="";$owner1_vill="";$owner1_dist="";$owner1_block="";$owner1_pin="";$owner1_mobileno="";$owner1_sign="";
		}
			
		}else{			
			$form_id="";$reference_no="";$submitted_date="";$received_dt="";$purpose_name="";$developer_name="";$to_the="";$developer_streetname1="";$developer_streetname2="";$developer_vill="";$developer_dist="";$developer_block="";$developer_pin="";$developer_mobileno="";$developer_sign="";
			
			$owner1_name="";$owner1_streetname1="";$owner1_streetname2="";$owner1_vill="";$owner1_dist="";$owner1_block="";$owner1_pin="";$owner1_mobileno="";$owner1_sign="";
		}	
		
	}else{	
		$results=$q->fetch_array();		
		$form_id=$results["form_id"];$purpose_name=$results["purpose_name"];$reference_no=$results["reference_no"];$submitted_date=$results["submitted_date"];$received_dt=$results["received_dt"];$to_the=$results["to_the"];
			
	   if(!empty($results["developer"])){
			$developer=json_decode($results["developer"]);
			$developer_name=$developer->name;$developer_streetname1=$developer->streetname1;$developer_streetname2=$developer->streetname2;$developer_vill=$developer->vill;$developer_dist=$developer->dist;$developer_block=$developer->block;$developer_pin=$developer->pin;$developer_mobileno=$developer->mobileno;$developer_sign=$developer->sign;	
		}else{				
			$developer_name="";$developer_streetname1="";$developer_streetname2="";$developer_vill="";$developer_dist="";$developer_block="";$developer_pin="";$developer_mobileno="";$developer_sign="";
		}
		
		if(!empty($results["owner1"])){
			$owner1=json_decode($results["owner1"]);
			$owner1_name=$owner1->name;$owner1_streetname1=$owner1->streetname1;$owner1_streetname2=$owner1->streetname2;$owner1_vill=$owner1->vill;$owner1_dist=$owner1->dist;$owner1_block=$owner1->block;$owner1_pin=$owner1->pin;$owner1_mobileno=$owner1->mobileno;$owner1_sign=$owner1->sign;	
		}else{				
			$owner1_name="";$owner1_streetname1="";$owner1_streetname2="";$owner1_vill="";$owner1_dist="";$owner1_block="";$owner1_pin="";$owner1_mobileno="";$owner1_sign="";
		}
	}
	
?>
<?php require_once "../../requires/header.php";   ?>
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<section class="content-header"></section>
			<section class="content">
				<?php require '../../requires/banner.php'; ?>
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<h4 class="text-center text-bold" >
									FORM NO. 16<br/>COMPLETION REPORT
								</h4>	
							</div>
							<div class="panel-body">
								<div>
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table id="" class="table table-responsive">
										<tr>
									    	<td width="25%">Reference No:</td>
											<td width="25%"><input type="text" value="<?php echo $reference_no; ?>" name="reference_no" class="form-control text-uppercase" ></td>
									    </tr>
										<tr>
									    	<td width="25%">Submitted on:</td>
											<td width="25%"><input type="text" value="<?php echo $submitted_date; ?>" name="submitted_date" class="dob form-control text-uppercase" ></td>
											<td width="25%">Received on:</td>
											<td width="25%"><input type="text" value="<?php echo $received_dt; ?>" name="received_dt" class="dob form-control text-uppercase" ></td>
									    </tr>
										<tr>
									    	<td>To,</td>
									    	<td colspan="3"></td>
									    </tr>
										<tr>
										   <td><textarea class="form-control text-uppercase" id="state_details" name="to_the"><?php echo $to_the; ?></textarea></td>
										   <td colspan="3"></td>
										</tr>
									    <tr>
									    	<td colspan="4">Sir,<br/>The work of erection/re-erection of building as per approved plan is completed under the Supervision of Architect/Construction Engineer who have given the completion certificate which is enclosed herewith.</td>
									    </tr>
										<tr>
									    	<td colspan="4">&nbsp;&nbsp;We declare that the work is executed as per the provisions of the Act and Development Control Regulations / Byelaws and to our satisfaction. We declare that the construction is to be used for&nbsp;&nbsp;<input type="text" value="<?php echo $purpose_name; ?>" name="purpose_name" >&nbsp;&nbsp;the purpose as per approved plan and it shall not be changed without obtaining written permission.</td>
									    </tr>
										<tr>
									    	<td colspan="4">&nbsp;&nbsp;We hereby declare that the plan as per the building erected has been submitted andapproved. We have transferred the area of parking space provided as per approved plan to an individual/association before for occupancy certificate.</td>
									    </tr>
										<tr>
											<td colspan="4">Any subsequent change from the completion drawings will be our responsibility.</td>
											<td></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td colspan="2">1.Address and Name of Developer / Builder :</td>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td width="25%">Name of Developer / Builder :</td>
											<td width="25%"><input type="text" value="<?php echo $developer_name; ?>" name="developer[name]" class="form-control text-uppercase" ></td>
											<td width="25%"></td>
											<td width="25%"></td>
										</tr>
										<tr>
											<td width="25%">Street 1</td>
											<td width="25%"><input type="text" value="<?php echo $developer_streetname1; ?>" name="developer[streetname1]" class="form-control text-uppercase" ></td>
											<td width="25%">Street 2</td>
											<td width="25%"><input type="text" value="<?php echo $developer_streetname2; ?>" name="developer[streetname2]" class="form-control text-uppercase" ></td>
										</tr>
										<tr>
											<td width="25%">Village/Town</td>
											<td width="25%"><input type="text" value="<?php echo $developer_vill; ?>" name="developer[vill]" class="form-control text-uppercase" ></td>
											<td width="25%">District</td>
											<td width="25%"><input type="text" value="<?php echo $developer_dist; ?>" name="developer[dist]" class="form-control text-uppercase" ></td>
										</tr>
										<tr>
											<td width="25%">Block/Ward No.</td>
											<td width="25%"><input type="text" value="<?php echo $developer_block; ?>" name="developer[block]" class="form-control text-uppercase" ></td>
											<td width="25%">Pincode</td>
											<td width="25%"><input type="text" validate="pincode" maxlength="6" value="<?php echo $developer_pin; ?>" name="developer[pin]" class="form-control text-uppercase" ></td>
										</tr>
										<tr>
											<td width="25%">Mobile No.</td>
											<td width="25%"><input validate="mobileNumber" maxlength="10" type="text" class="form-control text-uppercase" name="developer[mobileno]" value="<?php echo $developer_mobileno; ?>" ></td>
										</tr>
										<tr>
											<td colspan="2">2.Address and Name of Owner :</td>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td width="25%">Name of Owner :</td>
											<td width="25%"><input type="text" value="<?php echo $owner1_name; ?>" name="owner1[name]" class="form-control text-uppercase" ></td>
											<td width="25%"></td>
											<td width="25%"></td>
										</tr>
										<tr>
											<td width="25%">Street 1</td>
											<td width="25%"><input type="text" value="<?php echo $owner1_streetname1; ?>" name="owner1[streetname1]" class="form-control text-uppercase" ></td>
											<td width="25%">Street 2</td>
											<td width="25%"><input type="text" value="<?php echo $owner1_streetname2; ?>" name="owner1[streetname2]" class="form-control text-uppercase" ></td>
										</tr>
										<tr>
											<td width="25%">Village/Town</td>
											<td width="25%"><input type="text" value="<?php echo $owner1_vill; ?>" name="owner1[vill]" class="form-control text-uppercase" ></td>
											<td width="25%">District</td>
											<td width="25%"><input type="text" value="<?php echo $owner1_dist; ?>" name="owner1[dist]" class="form-control text-uppercase" ></td>
										</tr>
										<tr>
											<td width="25%">Block/Ward No.</td>
											<td width="25%"><input type="text" value="<?php echo $owner1_block; ?>" name="owner1[block]" class="form-control text-uppercase" ></td>
											<td width="25%">Pincode</td>
											<td width="25%"><input type="text" validate="pincode" maxlength="6" value="<?php echo $owner1_pin; ?>" name="owner1[pin]" class="form-control text-uppercase" ></td>
										</tr>
										<tr>
											<td width="25%">Mobile No.</td>
											<td width="25%"><input validate="mobileNumber" maxlength="10" type="text" class="form-control text-uppercase" name="owner1[mobileno]" value="<?php echo $owner1_mobileno; ?>" ></td>
										</tr>
										<tr>
											<td width="25%"></td>
											<td width="25%"></td>
											<td width="25%"></td>
											<td width="25%"></td>
										</tr>
										<tr>
												<td>Developer's / Builder's Signature</td>
												<td><input type="text" name="developer[sign]"  value="<?php echo $developer_sign; ?>" class="form-control text-uppercase"></td>
												<td>Owner's Signature</td>
												<td><input type="text" name="owner1[sign]"  value="<?php echo $owner1_sign; ?>" class="form-control text-uppercase"></td>
										</tr>
										<tr>
												<td>Date</td>
												<td><?php echo date('d-m-Y',strtotime($today)); ?></td>
												<td></td>
										</tr>
										
										<tr>										
										    <td class="text-center" colspan="4">
												<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
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
	 <?php require_once "../../../views/users/requires/footer.php";  ?>
<?php require '../../requires/js.php' ?>

<script>
	$('#resid').hide();
	$('#per_value').hide();
	$('#oname').show();
	$('#pname').hide();
	<?php if($premises=="O"){ ?>
	$('#resid').show();
	$('#per_value').show();
	$('#oname').hide();
	$('#pname').show();
	<?php } ?>
	$('input[name="premises"]').on('change', function(){
		if($(this).val() == 'O'){
			$('#resid').show();
			$('#per_value').show();
			$('#oname').hide();
			$('#pname').show();
			$('#premises_details_b').val('<?php if($owner_type=="PR") echo $owner_name; else echo $trade_name; ?>');
		}else{
			$('#resid').hide();
			$('#per_value').hide();
			$('#pname').hide();
			$('#oname').show();
			$('#premises_details_b').val('');
		}
	});	
	/* ------------------------------------------------------ */
	$('#godown_details_b').attr('required','required');
	<?php if($godown=="N"){ ?> 
	$('.GodownExists').css('display', 'none');
	$('#godown_details_b').removeAttr('required','required');
	<?php } ?>
	$('input[name="godown"]').on('change', function(){
		if($(this).val() == 'Y'){
			$('.GodownExists').css('display', 'table-row');
			$('#godown_details_b').attr('required','required');			
		}else{
			$('.GodownExists').css('display', 'none');
			$('#godown_details_b').removeAttr('required','required');			
		}
	});
	/* ------------------------------------------------------ */
	$('.old_trade_details').attr('required','required');
	<?php if($old_trade=="N"){ ?>
	$('.oldTrade').hide();
	$('.old_trade_details').removeAttr('required','required');
	<?php } ?>
	
	$('input[name="old_trade"]').on('change', function(){
		if($(this).val() == 'Y'){
			$('.oldTrade').show();
			$('.old_trade_details').attr('required','required');
		}else{
			$('.oldTrade').hide();
			$('.old_trade_details').removeAttr('required','required');
		}
	});
	
	/* ------------------------------------------------------ */
	$('#Year, #Year2').on('click', function(){
		var i, d = new Date();
		d.getFullYear()
		if($(this).children('option').length == 1)
		for(i=d.getFullYear()-5; i<d.getFullYear()+5; i++){
			$(this).append($('<option />').val(i).html(i));
		}
	});
	/* ------------------------------------------------------ */	
	function calculateAge()
	{
		var dob = new Date(y,m.d);
		alert();
		dob.setFullYear(y, m-1, d);
		
		var today = new Date();
		today.setFullYear(today.getFullYear());
		var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
		return age;
	}

	function date_of_birth(obj){
		
		var str2=$('#'+obj).val();
		var str3 = str2.replace('-','');
		var str = str3.replace('-','');
		
		var day=Number(str.substr(0,2));		
		var month=Number(str.substr(2,2))-1;
		var year=Number(str.substr(4,4));
		
		var today=new Date();
		var age=today.getFullYear()-year;
		
		
		if((today.getMonth()< month) || (today.getMonth()==month && today.getDate()<day))
		{
			age--;
		}
		if(age<18)
		{
			alert('Your age must be greater than 18 to fill up this form');
			$('#owner_age').val('');
			$('.dob').val('');
			
		}
		else
		{
			$('#owner_age').val(age);
			
		}	
	}
	$('#dist').change(function(){
        var city=$(this).val();
		$('#block').empty();
        $.ajax({ 
            type: 'GET',
            url: '../../../ajax/district_blocks.php', 
            data: { city: city },
            beforeSend:function(){
                $("#block").html("Loading..");
            },
            success:function(data){
                $("#block").html(data);
            },
            error:function(){ }
        }); //ajax end
    });
	/* ---------------------Block all after submit operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("", true);
	<?php } ?>
	
</script>