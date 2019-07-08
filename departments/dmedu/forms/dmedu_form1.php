<?php  require_once "../../requires/login_session.php";
$dept="dmedu";
$form="1";
$table_name=$formFunctions->getTableName($dept,$form);
include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);

include "save_form.php";
	
	

	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
	if($q->num_rows<1){	
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
		if($p->num_rows>0){
			$results=$p->fetch_assoc();
			$form_id=$results["form_id"];$constitution=$results["constitution"];$objectives=$results["objectives"];
			
			if(!empty($results["mailing_address"])){
				$mailing_address=json_decode($results["mailing_address"]);
				$mailing_address_sn1=$mailing_address->sn1;$mailing_address_sn2=$mailing_address->sn2;$mailing_address_vil=$mailing_address->vil;$mailing_address_dist=$mailing_address->dist;$mailing_address_pincode=$mailing_address->pincode;$mailing_address_mno=$mailing_address->mno;$mailing_address_email=$mailing_address->email;
			}else{				
				$mailing_address_sn1="";$mailing_address_sn2="";$mailing_address_vil="";$mailing_address_dist="";$mailing_address_pincode="";$mailing_address_mno="";$mailing_address_email="";
			}	
			if(!empty($results["reg"])){
				$reg=json_decode($results["reg"]);
				$reg_number=$reg->number;$reg_dt=$reg->dt;
			}else{				
				$reg_number="";$reg_dt="";
			}			
			if(!empty($results["permission"])){
				$permission=json_decode($results["permission"]);
				$permission_number=$permission->number;$permission_issue=$permission->issue;$permission_dt=$permission->dt;
			}else{				
				$permission_number="";$permission_issue="";$permission_dt="";
			}
			if(!empty($results["affliation"])){
				$affliation=json_decode($results["affliation"]);
				$affliation_name=$affliation->name;$affliation_dt=$affliation->dt;$affliation_number=$affliation->number;
			}else{				
				$affliation_name="";$affliation_dt="";$affliation_number="";
			}
			
			if(!empty($results["banker"])){
				$banker=json_decode($results["banker"]);
				$banker_name=$banker->name;$banker_sn1=$banker->sn1;$banker_sn2=$banker->sn2;$banker_v=$banker->v;$banker_d=$banker->d;$banker_phn_no=$banker->phn_no;$banker_p=$banker->p;
			}else{				
				$banker_name="";$banker_sn1="";$banker_sn2="";$banker_v="";$banker_d="";$banker_phn_no="";$banker_p="";
			}	
		}else{	
			$form_id="";
			$mailing_address_sn1="";$mailing_address_sn2="";$mailing_address_vil="";$mailing_address_dist="";$mailing_address_pincode="";$mailing_address_mno="";$mailing_address_email="";
			$constitution="";$objectives="";
			$reg_number="";$reg_dt="";
			$permission_number="";$permission_issue="";$permission_dt="";
			$affliation_name="";$affliation_dt="";$affliation_number="";
			$banker_name="";$banker_sn1="";$banker_sn2="";$banker_v="";$banker_d="";$banker_phn_no="";$banker_p="";
		}
	}else{	
		$results=$q->fetch_array();		
		$form_id=$results["form_id"];$constitution=$results["constitution"];$objectives=$results["objectives"];
		
		if(!empty($results["mailing_address"])){
			$mailing_address=json_decode($results["mailing_address"]);
			$mailing_address_sn1=$mailing_address->sn1;$mailing_address_sn2=$mailing_address->sn2;$mailing_address_vil=$mailing_address->vil;$mailing_address_dist=$mailing_address->dist;$mailing_address_pincode=$mailing_address->pincode;$mailing_address_mno=$mailing_address->mno;$mailing_address_email=$mailing_address->email;
		}else{				
			$mailing_address_sn1="";$mailing_address_sn2="";$mailing_address_vil="";$mailing_address_dist="";$mailing_address_pincode="";$mailing_address_mno="";$mailing_address_email="";
		}	
		if(!empty($results["reg"])){
			$reg=json_decode($results["reg"]);
			$reg_number=$reg->number;$reg_dt=$reg->dt;
		}else{				
			$reg_number="";$reg_dt="";
		}			
		if(!empty($results["permission"])){
			$permission=json_decode($results["permission"]);
			$permission_number=$permission->number;$permission_issue=$permission->issue;$permission_dt=$permission->dt;
		}else{				
			$permission_number="";$permission_issue="";$permission_dt="";
		}
		if(!empty($results["affliation"])){
			$affliation=json_decode($results["affliation"]);
			$affliation_name=$affliation->name;$affliation_dt=$affliation->dt;$affliation_number=$affliation->number;
		}else{				
			$affliation_name="";$affliation_dt="";$affliation_number="";
		}
		
		if(!empty($results["banker"])){
			$banker=json_decode($results["banker"]);
			$banker_name=$banker->name;$banker_sn1=$banker->sn1;$banker_sn2=$banker->sn2;$banker_v=$banker->v;$banker_d=$banker->d;$banker_phn_no=$banker->phn_no;$banker_p=$banker->p;
		}else{				
			$banker_name="";$banker_sn1="";$banker_sn2="";$banker_v="";$banker_d="";$banker_phn_no="";$banker_p="";
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
									<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form);?></strong>
								</h4>	
							</div>
							<div class="panel-body">
								<div id="table1" class="tab-pane" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table id="" class="table table-responsive">
										<tr>
											<td width="25%">1.Name of the Applicant</td>
											<td><input type="text" class="form-control text-uppercase" value="<?php echo $key_person;?>" disabled="disabled"/></td>
											<td width="25%"></td>
											<td width="25%"></td>
										</tr>
										<tr>
											<td colspan="4">2. Address</td>
										</tr>
										<tr>
											<td>Street Name1 :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $street_name1; ?>"></td>
											<td>Street Name2:</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $street_name2; ?>" ></td>
										</tr>
										<tr>
											<td>Village/Town :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo $vill; ?>"></td>
											<td>District :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo $dist; ?>"></td>
										</tr>
										<tr>
											<td>Pin Code :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $pincode; ?>"></td>
											<td>Mobile No:</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo "+91-".$mobile_no; ?>"></td>
										</tr>
										<tr>
											<td>Email Id:</td>
											<td><input type="text" class="form-control" disabled="disabled"  value="<?php echo  $email; ?>"></td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td colspan="4">3. Registered Office</td>
										</tr>
										<tr>
											<td>Street Name1 :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo  $b_street_name1; ?>"	></td>
											<td>Street Name2:</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo  $b_street_name2; ?>"></td>
										</tr>
										<tr>
											<td>Village/Town :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled"value="<?php echo  $b_vill; ?>"></td>
											<td>District :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo  $b_dist; ?>"></td>
										</tr>
										<tr>
											<td>Pin Code :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo  $b_pincode; ?>"></td>
											<td>Mobile No:</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo "+91-".$b_mobile_no; ?>"></td>
										</tr>
										<tr>
										    <td>Email Id:</td>
											<td><input type="text" class="form-control" disabled="disabled"  value="<?php echo  $b_email; ?>"></td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td colspan="4">4. Mailing Address</td>
										</tr>
										<tr>
											<td>Street Name1 :</td>
											<td><input type="text" class="form-control text-uppercase" name="mailing_address[sn1]" value="<?php echo  $mailing_address_sn1; ?>"	></td>
											<td>Street Name2:</td>
											<td><input type="text" class="form-control text-uppercase" name="mailing_address[sn2]" value="<?php echo  $mailing_address_sn2; ?>"></td>
										</tr>
										<tr>
											<td>Village/Town :</td>
											<td><input type="text" class="form-control text-uppercase" name="mailing_address[vil]" value="<?php echo  $mailing_address_vil; ?>"></td>
											<td>District :</td>
											<td><input type="text" class="form-control text-uppercase" name="mailing_address[dist]" value="<?php echo  $mailing_address_dist; ?>"></td>
										</tr>
										<tr>
											<td>Pin Code :</td>
											<td><input type="text" class="form-control text-uppercase" name="mailing_address[pincode]" validate="pincode" maxlength="6" value="<?php echo  $mailing_address_pincode; ?>"></td>
											<td>Mobile No :</td>
											<td><input type="text" class="form-control text-uppercase" name="mailing_address[mno]" validate="mobileNumber" maxlength="10" value="<?php echo $mailing_address_mno; ?>"></td>
										</tr>
										<tr>
										    <td>Email Id :</td>
											<td><input type="email" class="form-control" name="mailing_address[email]" validate="email" value="<?php echo  $mailing_address_email; ?>"></td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
										
										<tr>
										    <td>5. Constitution</td>
											<td><select class="form-control text-uppercase" name="constitution">
											<option value="disabled">Please Select</option>
											<option value="University" <?php if($constitution=="University") echo "selected";?> >University</option>
											<option value="State Government" <?php if($constitution=="State Government") echo "selected";?>>State Government</option>
											<option value="Union Territories" <?php if($constitution=="Union Territories") echo "selected";?>>Union Territories</option>
											<option value="Autonomous Body" <?php if($constitution=="Autonomous Body") echo "selected";?>>Autonomous Body</option>
											<option value="Society" <?php if($constitution=="Society") echo "selected";?>>Society</option>
											<option value="Trust" <?php if($constitution=="Trust") echo "selected";?>>Trust</option>
											</select></td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
										<tr>
										    <td colspan="4">6. Registration / Incorporation</td>
										</tr>
										<tr>
										    <td >Number</td>
											<td><input type="text" class="form-control text-uppercase" name="reg[number]" value="<?php echo  $reg_number; ?>"></td>
											<td>Date</td>
											<td><input type="text" class="dobindia form-control text-uppercase" name="reg[dt]" value="<?php echo  $reg_dt; ?>"></td>
										</tr>
										<tr>
										    <td >7. Objectives</td>
											<td><input type="text" class="form-control text-uppercase"  name="objectives" value="<?php echo  $objectives; ?>"></td>
										</tr>
										<tr>
											<td colspan="4">8. Letter of essentiality/permission from the state government/union territory</td>
										</tr>
										<tr>
											<td width="25%">Number </td>
											<td><input type="text" class="form-control text-uppercase" name="permission[number]" value="<?php echo  $permission_number; ?>"></td>
											<td >Date </td>
											<td ><input type="text" class="dobindia text-uppercase form-control"  name="permission[dt]" value="<?php echo  $permission_dt; ?>"></td>
										</tr>
										<tr>
											<td >Issuing authority </td>
											<td ><input type="text" class="text-uppercase form-control"  name="permission[issue]" value="<?php echo  $permission_issue; ?>"></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td colspan="4">9. Letter of University Affliation </td>
										</tr >
										<tr>
											<td width="25%">Number </td>
											<td><input type="text" class="form-control text-uppercase" name="affliation[number]" value="<?php echo  $affliation_number; ?>"></td>
											<td >Date </td>
											<td><input type="text" class="dobindia form-control text-uppercase" name="affliation[dt]" value="<?php echo  $affliation_dt; ?>"></td>
										</tr>
										<tr>
											<td >Name of the Institution </td>
											<td><input type="text" class="form-control text-uppercase" name="affliation[name]" value="<?php echo  $affliation_name; ?>"></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td colspan="4">10. Bankers</td>
										</tr>
										<tr>
											<td>Name</td>
											<td><input type="text" class="form-control text-uppercase" name="banker[name]" value="<?php echo $banker_name; ?>"></td>
											<td>Street Name1</td>
											<td><input type="text" class=" form-control text-uppercase" name="banker[sn1]" value="<?php echo $banker_sn1; ?>"></td>
										</tr>
										<tr>
											<td>Street Name2</td>
											<td><input type="text" class="form-control text-uppercase" name="banker[sn2]" value="<?php echo $banker_sn2; ?>"></td>
											<td>Village</td>
											<td><input type="text" class=" form-control text-uppercase" name="banker[v]" value="<?php echo $banker_v; ?>"></td>
										</tr>
										<tr>
											<td>District</td>
                                            <td><input type="text" class=" form-control text-uppercase" name="banker[d]" value="<?php echo $banker_d; ?>"></td>
											
											<td>Contact No</td>
											<td><input type="text" class="form-control text-uppercase" name="banker[phn_no]" validate="mobileNumber" maxlength="10" value="<?php echo $banker_phn_no; ?>"></td>
										</tr>
										<tr>
											<td>Pincode</td>
											<td><input type="text" class="form-control text-uppercase" name="banker[p]" value="<?php echo $banker_p; ?>" maxlength="6" validate="pincode"></td>
											<td></td>
											<td></td>
										</tr>					
										<tr>
											<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>" title="Save it" onclick="return confirm('Do you really want to save the form ?')">Submit</button>
											</td>
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
	$('#Year, #Year2').on('click', function(){
		var i, d = new Date();
		d.getFullYear()
		if($(this).children('option').length == 1)
		for(i=d.getFullYear()-5; i<d.getFullYear()+5; i++){
			$(this).append($('<option />').val(i).html(i));
		}
	});
	/* ------------------------------------------------------ */	
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
	/* ----------------------------------------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
	/* ----------------------------------------------------- */
</script>
