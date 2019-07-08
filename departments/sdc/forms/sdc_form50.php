<?php  require_once "../../requires/login_session.php";
$dept="sdc";
$form="50";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
include "save_form4.php";
	
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
	if($q->num_rows<1){	
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
		if($p->num_rows>0){
			$results=$p->fetch_array();
			$form_id=$results["form_id"];$drugs_name=$results["drugs_name"];$auth_person=$results["auth_person"];
		}else{
			$form_id="";$drugs_name="";$auth_person="";
		}
	}else{		
		$results=$q->fetch_array();
		$form_id=$results["form_id"];$drugs_name=$results["drugs_name"];$auth_person=$results["auth_person"];
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
												<td colspan="4">1. I/We &nbsp;<input type="text"  class="form-control text-uppercase" name="auth_person" required="required" value="<?php if($auth_person!="") { echo $auth_person; }else{ echo $key_person;}?>" validate="letters">&nbsp; of &nbsp;<input type="text"  class="form-control text-uppercase"  value="<?php echo $unit_name;?>"> &nbsp;hereby apply for a licence to manufacture the drugs specified below for purposes examination, test or analysis at &nbsp;<input type="text"  class="form-control text-uppercase" value="<?php echo $dist;?>" disabled>&nbsp; and I undertake to comply with the conditions applicable to the licence .</td>
											</tr> 
											<tr>
												<td colspan="2">Name of drugs :</td>
												<td colspan="2"><textarea class="form-control text-uppercase" name="drugs_name"><?php echo $drugs_name;?></textarea></td>
											</tr>
											<tr>
												<td colspan="2" width="50%">Place :&nbsp; <strong> <?php echo strtoupper($dist);?></strong><br/>
												Date : &nbsp;<strong><?php echo date('d-m-Y',strtotime($today)); ?></strong> </td>
												<td colspan="2" align="right">Signature : <strong><?php echo strtoupper($key_person); ?></strong><br/>Signature of the Applicant</td>
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