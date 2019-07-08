<?php  require_once "../../requires/login_session.php";
$dept="doa";
$form="29";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";

$get_file_name=basename(__FILE__);	
include "save_form1.php";
	
		$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
		if($q->num_rows<1){
		 $p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
			if($p->num_rows>0){
				$results=$p->fetch_array();
				$form_id=$results["form_id"];$adhar_no=$results["adhar_no"];
			}else{
				 $form_id="";$adhar_no="";
			}
		}else{	
			$results=$q->fetch_array();
			$form_id=$results["form_id"];$adhar_no=$results["adhar_no"];				
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
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table id="" class="table table-responsive">
										<tr>
											<td colspan="4">To<br/>
											&nbsp;&nbsp;&nbsp;&nbsp;The Licencing Authority ,<br/><br/>
											 <select class="form-control" style="width:300px" name="office_id" required>
                                        <option value="">Please Select</option>
										<?php
										$rows = $formFunctions->getOffices($dept);
                                        foreach($rows as $key => $values ){
											if($values["id"]!=6 && $values["id"]!=1){
												$jurisdiction = $values["jurisdiction"];
												$jurisdiction_array = explode(",",$jurisdiction); 
												//print_r($jurisdiction_array);echo "<br/><br/>";
												if(in_array(strtoupper($b_dist),$jurisdiction_array)){
													$address = $values["street1"]." ".$values["street2"].", ".$values["district"]." - ".$values["pin"];
													echo '<option value="'.$values["id"].'">'.$values["office_name"].', '.$address.'</option>';
												}												
											}												
										}
										?>											
									</select>
											<br/></td>
										</tr>
										<tr>
											<td width="25%">1. Name of the Applicant :</td>
											<td width="25%"><input  type="text" value="<?php echo $key_person; ?>" class="form-control text-uppercase" disabled></td>
											<td width="25%"></td>
											<td width="25%"></td>
										</tr>
										<tr>
											<td colspan="4">2. Address of the Manufacturing unit:</td>
										</tr>
										<tr>
											<td width="25%">Street Name1 :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $b_street_name1; ?>"	></td>
											<td width="25%">Street Name2:</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $b_street_name2; ?>"></td>
										</tr>
										<tr>
											<td>Village/Town :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $b_vill; ?>"></td>
											<td>District :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $b_dist; ?>"></td>
										</tr>
										<tr>
											<td>Pin Code :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $b_pincode; ?>"></td>
											<td>Mobile No:</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo "+91-".$b_mobile_no; ?>"></td>
										</tr>
										<tr>
											<td>Email Id:</td>
											<td><input type="text" class="form-control" disabled="disabled" readonly="readonly" value="<?php echo  $b_email; ?>"></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td>3. EM-I/Udyog Aadhar no. Of Industry Department furnished</td>
											<td><input type="text" class="form-control text-uppercase" name="adhar_no" value="<?php echo  $adhar_no; ?>"></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td><u>Declaration</u></td>
										</tr>
										<tr>
											<td colspan="3">The above information are true and best of my knowledge and I will be responsible for any deviation found in the information & documents furnished here.</td>
											
										</tr>
										
										
									   <tr>
											<td colspan="3">Date :<label ><?php echo $today;?></label><br/>
											Place :<label><?php echo $dist;?></label></td>
											<td>Signature of the Applicant : <strong><?php echo strtoupper($key_person)?></strong></td>
											<td></td>
										</tr>					
									<tr>
										<td class="text-center" colspan="4">	
										 <button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>" title="Save it" onclick="return confirm('Do you really want to save the form ?')">Save and Next</button>
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
	
	
	$('#is_nonResidential_b').attr('readonly','readonly');
		<?php if($is_nonResidential_a == 'Y') echo "$('#is_nonResidential_b').removeAttr('readonly','readonly');"; ?>
		$('.is_nonResidential_a').on('change', function(){
			if($(this).val() == 'Y'){
				$('#is_nonResidential_b').removeAttr('readonly','readonly');
			}else{
				$('#is_nonResidential_b').attr('readonly','readonly');
				$('#is_nonResidential_b').val('');
			}			
		});
		
	$('#semi_residential_b').attr('readonly','readonly');
		<?php if($semi_residential_a == 'Y') echo "$('#semi_residential_b').removeAttr('readonly','readonly');"; ?>
		$('.semi_residential_a').on('change', function(){
			if($(this).val() == 'Y'){
				$('#semi_residential_b').removeAttr('readonly','readonly');
			}else{
				$('#semi_residential_b').attr('readonly','readonly');
				$('#semi_residential_b').val('');
			}			
		});
</script>