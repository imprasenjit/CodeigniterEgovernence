<?php  require_once "../../requires/login_session.php";
$dept="clm";
$form="9";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
include "save_clm_form.php";
	
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
	if($q->num_rows<1){	 
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
		if($p->num_rows>0){
			$results=$p->fetch_assoc();
			$form_id=$results['form_id'];	
			$meeting_date=$results['meeting_date'];$meeting_place=$results['meeting_place'];
		}else{		
			$form_id="";
			$meeting_date="";$meeting_place="";
		}
	}else{
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];	
		$meeting_date=$results['meeting_date'];$meeting_place=$results['meeting_place'];
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
								<h4 class="text-center" >
									<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form);?> </strong>
								</h4>	
							</div>
							<div class="panel-body">
							</br>
								<div id="table1" class="tab-pane" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table class="table table-responsive ">		
									<tr>
										<td colspan="4" class="form-inline">
										&emsp;&emsp;Notice is hereby given that Shri/Smt. / Ms <input type="text" class="form-control" disabled value="<?php echo strtoupper($key_person) ?>"> Director of the  <input type="text" class="form-control" value="<?php echo strtoupper($unit_name); ?>" disabled>
										<input type="text" class="form-control" value="<?php echo strtoupper($b_dist); ?>" disabled> (name and address of the company) has been nominated by the company by a Resolution passed at their meeting held on <input type="text" class="dob form-control" name="meeting_date" value="<?php echo $meeting_date; ?>"> at <input type="text" class="form-control text-uppercase" name="meeting_place" value="<?php echo $meeting_place;?>"> to be 
								       charge of, and be responsible for the conduct of business of the company or any establishment/ branch/unit thereof and authorized to exercise all such powers and take all such steps as may be necessary or expedient to prevent the commission any offence by the said company under the Legal Metrology Act, 2009.</td>
									</tr>
									<tr>
									   <td colspan="4" class="form-inline">
									   &emsp;&emsp;&emsp;&emsp;Shri/Smt./Ms<input type="text" class="form-control" disabled value="<?php echo $key_person;?>"> Designation <input type="text" class="form-control" disabled value="<?php echo $status_applicant; ?>"> has accepted the said nomination and copy of said acceptance is enclosed herewith.
									   </td>
									</tr>
							
									<tr>
										<td colspan="4">
										&emsp;&emsp;&emsp;&emsp;A certified copy of the said Resolution is also enclosed.</td>
									</tr>
									
								<tr>
									<td>Date : <label><?php echo date('d-m-Y',strtotime($today));?></label><br/>
									Place:<label><?php echo strtoupper($dist); ?></label></td>
															
									<td></td>
									<td></td>
									<td align="right"> <label><?php echo strtoupper($key_person) ?></label><br/>
									Managing Director/Secretary</br>

                                   (name of the company)</td>
								</tr>
								<tr>
									<td colspan="4">Note: Score out the portion which is not applicable.</td>
								</tr>
								<tr>
									<td colspan="4">&emsp;&emsp;&emsp;&emsp;I accept the above nomination in pursuance of sub – section (2) of Section 49 of the Legal Metrology Act, 2009 and Rule 29 of the Legal Metrology (General) Rules, 2011 made there under.</td>
								</tr>
								<tr>
									<td>Date : <label><?php echo date('d-m-Y',strtotime($today));?></label><br/>
									 Place:<label><?php echo strtoupper($dist); ?></label></td>
									<td></td>
									<td></td>
									<td align="right"> <label><?php echo strtoupper($key_person); ?></label><br/>
									Director of <?php echo $unit_name;?>
									</td>
								</tr>
								<tr>
									<td class="text-center" colspan="4">
										<button type="submit" name="save<?php echo $form; ?>" value="Save and Submit" class="btn btn-success submit1" title="Save it, if you want to complete it later" rel="tooltip" onclick="return confirm('Do you really want to save the form ?')" >Save &amp; Next</button>
									</td>
								</tr>
								</table>
								</form>
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
	/* ---------------------Block all after submit operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
	
	$('#resid').hide();
	$('input[name="premises"]').on('change', function(){
		if($(this).val() == 'O'){
			$('#resid').show();
		}else{
			$('#resid').hide();
		}
	});
	/* ------------------------------------------------------ */
	$('input[name="godown"]').on('change', function(){
		if($(this).val() == 'Y'){
			$('.GodownExists').css('display', 'table-row');			
		}else{
			$('.GodownExists').css('display', 'none');			
		}
	});
	/* ------------------------------------------------------ */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
</script>