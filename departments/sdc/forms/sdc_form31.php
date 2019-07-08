<?php  require_once "../../requires/login_session.php";
$dept="sdc";
$form="31";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
	
include "save_form3.php";
	
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
	if($q->num_rows<1){	
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
		if($p->num_rows>0){
			$results=$p->fetch_array();	
			$form_id=$results["form_id"];$auth_person=$results["auth_person"];$location=$results["location"];$situated=$results["situated"];$drug_name=$results["drug_name"];$particulars=$results["particulars"];
			if(!empty($results["dealer"])){
				$dealer=json_decode($results["dealer"]);
				$dealer_name=$dealer->name;$dealer_lic_no=$dealer->lic_no;
			}else{				
				$dealer_name="";$dealer_lic_no="";
			}
			$prev_lic_no=$results["prev_lic_no"];
			if($results["prev_issue_date"]!="" || $results["prev_issue_date"]!='00-00-0000' || $results["prev_issue_date"]!='0000-00-00'){
				$prev_issue_date=date('d-m-Y',strtotime($results["prev_issue_date"]));
			}else{
				$prev_issue_date="";
			}
		}else{
			$form_id="";$auth_person="";$location="";$situated="";$drug_name="";$particulars="";$fee="";$acc_no="";
			$dealer_name="";$dealer_lic_no="";$prev_lic_no="";$prev_issue_date="";
		}
	}else{	
		$results=$q->fetch_array();	
		$form_id=$results["form_id"];$auth_person=$results["auth_person"];$location=$results["location"];$situated=$results["situated"];$drug_name=$results["drug_name"];$particulars=$results["particulars"];
		if(!empty($results["dealer"])){
			$dealer=json_decode($results["dealer"]);
			$dealer_name=$dealer->name;$dealer_lic_no=$dealer->lic_no;
		}else{				
			$dealer_name="";$dealer_lic_no="";
		}
		$prev_lic_no=$results["prev_lic_no"];
		if($results["prev_issue_date"]!="" || $results["prev_issue_date"]!='00-00-0000' || $results["prev_issue_date"]!='0000-00-00'){
			$prev_issue_date=date('d-m-Y',strtotime($results["prev_issue_date"]));
		}else{
			$prev_issue_date="";
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
									<?php echo $form_name=$formFunctions->get_formName($dept,$form);?>
								</h4>	
							</div>
							<div class="panel-body">
								<div id="table1" class="tab-pane" role="tabpanel">
									<form name="myform1" class="submit1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
										<table class="table table-responsive">
											<tr class="form-inline">
												<td colspan="4">1. I/We &nbsp;<input type="text"  class="form-control text-uppercase" name="auth_person" required="required" value="<?php if($auth_person!="") { echo $auth_person; }else{ echo $key_person;}?>" validate="letters">&nbsp;of &nbsp;<input type="text"  class="form-control text-uppercase"  value="<?php echo $unit_name;?>"> &nbsp;hereby apply for a licence sell by retail.</td>
											</tr> 
											<tr>
												<td>(i)  Drugs other than those specified in Schedules C, C(1) and X on the premises situated at &nbsp;</td>
												<td><textarea type="text" class="form-control text-uppercase" name="location"><?php echo $location;?></textarea></td>
												<td>(ii)  Drugs specified in [Schedule C(1)] on the situated &nbsp;</td>
												<td><textarea type="text"  class="form-control text-uppercase" name="situated"><?php echo $situated;?></textarea></td>
											</tr>
											<tr>
												<td colspan="4">2. Sales shall be restricted to such drugs as can be sold without the supervision of a qualified person under the Drugs and Cosmetics</td>
											</tr>
											<tr>
												<td>3. Names or classes of drugs proposed to be sold.:</td>
												<td><textarea type="text"  class="form-control text-uppercase" name="drug_name"><?php echo $drug_name;?></textarea></td>
												<td>4. Particulars of the storage accomodation for the storage of [Schedule C(1)] drugs on the premises referred to above.</td>
												<td><textarea type="text"  class="form-control text-uppercase" name="particulars"><?php echo $particulars;?></textarea></td>
											</tr>
											<tr>
												<td colspan="4">5. The drugs for sale will be purchased from the following dealers and such other dealers as may be endorsed on the license by the licensing authority from time to time.</td>
											</tr>
											<tr>
												<td width="25%">Name of the dealers :</td>
												<td width="25%"><input type="text" class="form-control text-uppercase" name="dealer[name]" validate="letters" value="<?php echo  $dealer_name; ?>"	></td>
												<td width="25%">Licence No. (If any) :</td>
												<td width="25%"><input type="text" class="form-control text-uppercase"name="dealer[lic_no]" value="<?php echo  $dealer_lic_no; ?>"></td>
											</tr>
											<tr>
												<td>Licence No.</td>
												<td><input class="form-control text-uppercase" name="prev_lic_no" value="<?=$prev_lic_no;?>" required="required"/></td>
												<td>Issue date :</td>
												<td><input class="dobindia form-control text-uppercase" name="prev_issue_date" value="<?=$prev_issue_date;?>" required="required"/></td>
											</tr>
											<tr>
												<td>Date :</td>
												<td><label ><?php echo $today;?></label></td>
												<td>Signature :</td>
												<td><label><?php echo strtoupper($key_person)?></label></td>
											</tr>	  
											<tr>
												<td></td>
												<td class="text-center" colspan="2">
													<button type="submit" style="font-weight:bold" name="save<?php echo $form;?>" class="btn btn-success">Save and Next</button>
												</td>
												<td></td>
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
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>