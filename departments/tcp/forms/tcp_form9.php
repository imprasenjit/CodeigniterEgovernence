<?php  require_once "../../requires/login_session.php";
$dept="tcp";
$form="9";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);	
include "save_tcp_form.php";
		
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
	if($q->num_rows<1){	
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
		if($p->num_rows>0){
			$results=$p->fetch_array();
			$form_id=$results["form_id"];
			$supervision=$results["supervision"];$agency=$results["agency"];$pan =$results["pan"];
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
		}else{
			$form_id="";
			$supervision="";$agency="";$pan="";
			$authority_addres_a="";$authority_addres_b="";$authority_addres_c="";
			$pre_add_sn1="";$pre_add_sn2="";$pre_add_v="";$pre_add_d="";$pre_add_p="";$pre_add_mno="";$pre_add_email="";$pre_add_pan="";
		}
	}else{			
		$results=$q->fetch_array();
		$form_id=$results["form_id"];
		$supervision=$results["supervision"];$agency=$results["agency"];$pan =$results["pan"];
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
	}
?>
<?php require_once "../../requires/header.php";   ?>
    <?php include ("".$table_name."_Addmore.php"); ?> 
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
								<form name="myform1" class="submit1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
								<table class="table table-responsive">
									<tr>
										<td colspan="4" class="form-inline">
											To <br/>
											 <input type="text"  class="form-control text-uppercase" name="authority_addres[a]" value="<?php echo $authority_addres_a;?>"> <br/><br/><input type="text"  class="form-control text-uppercase" name="authority_addres[b]" value="<?php echo $authority_addres_b;?>"> <br/><br/><input type="text"  class="form-control text-uppercase" name="authority_addres[c]" value="<?php echo $authority_addres_c;?>">
										</td>
									</tr>	
									<tr>
										<td colspan="4" class="form-inline">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;We hereby apply for enrollment of our Group or Agency in the name and style as mentioned below, as competent technical personnel to do the various works of schemes Building Permit and supervision in the <input type="text"  class=" form-control text-uppercase" name="supervision" value="<?php echo $supervision;?>"><br/>
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
										<td>District<span class="mandatory_field">*</span></td>
                                        <td><input type="text"  class="form-control text-uppercase" name="pre_add[d]" id="d" value="<?php echo $pre_add_d;?>"></td>
										
									</tr>
									<tr>
										<td>Pincode</td>
										<td><input validate="pincode" type="text"  class="form-control text-uppercase" name="pre_add[p]" maxlength="6" value="<?php echo $pre_add_p;?>"></td>
										<td>Mobile no.</td>
										<td><input validate="mobileNumber" type="text" name="pre_add[mno]" class="form-control text-uppercase" maxlength="10" value="<?php echo $pre_add_mno;?>" ></td>
									</tr>
									<tr>
										<td>Email ID :</td>
										<td><input  type="email"  class="form-control" name="pre_add[email]"  value="<?php echo $pre_add_email;?>"></td>
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
											$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
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
										<td>Date : <strong><?=date('d-m-Y',strtotime($today));?></strong></td>
										<td></td>
										<td></td>
										<td align="right">Signature Of the Applicant : <strong><?php echo strtoupper($key_person);?></strong></td>
									</tr>
									<tr>
										<td class="text-center" colspan="4">				
										<button type="submit" class="btn btn-success submit1" name="save<?php echo $form;?>" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you want to save..?')" >Save and Next</button>
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
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	/* ---------------------Block all after submit operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>
