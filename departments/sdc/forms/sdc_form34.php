<?php  require_once "../../requires/login_session.php";
$dept="sdc";
$form="34";
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
			$form_id=$results["form_id"];$auth_person=$results["auth_person"];$licence=$results["licence"];$name_incharge=$results["name_incharge"];$prev_lic_no=$results["prev_lic_no"];
			if($results["prev_issue_date"]!="" || $results["prev_issue_date"]!='00-00-0000' || $results["prev_issue_date"]!='0000-00-00'){
				$prev_issue_date=date('d-m-Y',strtotime($results["prev_issue_date"]));
			}else{
				$prev_issue_date="";
			}
		}else{
			$form_id="";$auth_person="";$licence="";$name_incharge="";$prev_lic_no="";$prev_issue_date="";
		}
	}else{			
		$results=$q->fetch_array();
		$form_id=$results["form_id"];$auth_person=$results["auth_person"];$licence=$results["licence"];$name_incharge=$results["name_incharge"];$prev_lic_no=$results["prev_lic_no"];
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
												<td colspan="4">1.I/We &nbsp;<input type="text"  class="form-control text-uppercase" name="auth_person" required="required" value="<?php if($auth_person!="") { echo $auth_person; }else{ echo $key_person;}?>" validate="letters">&nbsp; of &nbsp;<input type="text"  class="form-control text-uppercase" disabled value="<?php echo $unit_name;?>">&nbsp;hereby apply for a licence sell by wholesale/retail &nbsp;<input type="text"  class="form-control text-uppercase" name="licence" value="<?php echo $licence;?>">&nbsp; Homeopathic medicine premises situated at&nbsp;<input type="text"  class="form-control text-uppercase" value="<?php echo $b_dist;?>" disabled>.</td>
											</tr>
											<tr>
												<td colspan="4">2.  The sale and dispensing of Homoepathic medicines shall be made under the personal supervision of the following competent person-in-charge.</td>
											</tr>
											<tr>
												<td width="25%"> Names :</td>
												<td width="25%"><input type="text"  class="form-control text-uppercase" name="name_incharge" value="<?php echo $name_incharge;?>" validate="letters"></td>
												<td width="25%">&nbsp;</td>
												<td width="25%">&nbsp;</td>
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