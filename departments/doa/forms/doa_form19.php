<?php  require_once "../../requires/login_session.php";
$dept="doa";
$form="19";
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
				$form_id=$results["form_id"];$day=$results["day"];$year=$results["year"];
				$licence=$results["licence"];$licence_authority=$results["licence_authority"];$operation=$results["operation"];$expert=$results["expert"];$insect=$results["insect"];$stock=$results["stock"];$branch=$results["branch"];$new_branch=$results["new_branch"];$other=$results["other"];$total_pesticides=$results["total_pesticides"];$engage=$results["engage"];$name2=$results["name2"];$son_of=$results["son_of"];$designation=$results["designation"];
			}else{
				$form_id="";$business="";$licence_state="";$licence_no="";
				$day="";$year="";
				$licence="";$licence_authority="";$operation="";$expert="";$insect="";$stock="";$branch="";$new_branch="";$other="";$total_pesticides="";$engage="";$name2="";$son_of="";$designation="";
				$licence_bearing_no=""; $situated="";$renewed="";
			}
		}else{			
				$results=$q->fetch_array();
				$form_id=$results["form_id"];$day=$results["day"];$year=$results["year"];
				
				$licence=$results["licence"];$licence_authority=$results["licence_authority"];$operation=$results["operation"];$expert=$results["expert"];$insect=$results["insect"];$stock=$results["stock"];$branch=$results["branch"];$new_branch=$results["new_branch"];$other=$results["other"];$total_pesticides=$results["total_pesticides"];$engage=$results["engage"];$name2=$results["name2"];$son_of=$results["son_of"];$designation=$results["designation"];
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
								<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form);?></strong>
							</h4>	
						</div>
						<div class="panel-body">
							<div id="table1" class="tab-pane" role="tabpanel">
							<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
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
									 
									 <td colspan="4" class="form-inline">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1. I/We hereby apply for renewal of the licence to stock and use restricted insecticides for categories I, II and III, under the name and style of&nbsp;<input type="text" name="licence" value="<?php echo $licence; ?>" class="form-control"> &nbsp;The licence desired to be renewed was granted the Licensing Authority and alloted License No<input type="text" name="licence_authority" value="<?php echo $licence_authority; ?>" class="form-control">&nbsp;on the day of &nbsp;<input type="text" name="day" value="<?php echo $day; ?>" class="form-control"> &nbsp; 20<input type="text" name="year" validate="onlyNumbers" value="<?php echo $year; ?>" class="form-control text-uppercase">.</td>				 
												 
								</tr>
								<tr>
									<td colspan="4">2. State the, if any, in :</td>
								</tr>
								<tr>
									<td width="25%">&nbsp;(a) Category of operation</td>
									<td width="25%"><textarea name="operation" class="form-control text-uppercase" id="operation" validate="textarea" ><?php echo $operation; ?></textarea></td>
									<td width="25%">&nbsp;(b) Expert staff </td>
									<td width="25%"><textarea name="expert" class="form-control text-uppercase" id="expert" validate="textarea" ><?php echo $expert; ?></textarea></td>
								</tr>
								<tr>
									<td width="25%">(c) Restricted insecticides used</td>
									<td width="25%"><textarea name="insect" class="form-control text-uppercase" id="insect" validate="textarea" ><?php echo $insect; ?></textarea></td>
									<td width="25%">(d) Premises of stocking</td>
									<td width="25%"><textarea name="stock" class="form-control text-uppercase" id="stock" validate="textarea" ><?php echo $stock; ?></textarea></td>
								</tr>
								<tr>
									<td width="25%">(e) Address including branch officers</td>
									<td width="25%"><textarea name="branch" class="form-control text-uppercase" id="branch" validate="textarea" ><?php echo $branch; ?></textarea></td>
									<td width="25%">(f) Whether any new branch / unit has been opened after grant or renewal of license</td>
									<td width="25%"><textarea name="new_branch" class="form-control text-uppercase" id="new_branch" validate="textarea" ><?php echo $new_branch; ?></textarea></td>
								</tr>
								<tr>
									<td>(g) Any other change</td>
									<td><textarea name="other" class="form-control text-uppercase" id="other" validate="textarea" ><?php echo $other; ?></textarea></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td>3. Total No. of Pesticides : <span class="mandatory_field">*</span><span class="mandatory_field">*</span> </td>
									<td><input type="text" name="total_pesticides" class="text-uppercase form-control" required="required" validate="onlyNumbers" value="<?php echo $total_pesticides; ?>"></td>
									<td colspan="2"></td>
								</tr>
								<tr>
									<td>4. Give latest details of persons engaged (attach separate sheet, duly authenticated) :</td>
									<td><textarea name="engage" class="form-control text-uppercase" id="engage" validate="textarea"><?php echo $engage; ?></textarea></td>
									<td colspan="2"></td>
								</tr>
								<tr>
									<td colspan="4" align="center"><b>Verification</b></td>
								</tr>
								<tr>
									 
									 <td colspan="4" class="form-inline">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I&nbsp;<input type="text" name="name2" value="<?php echo $name2; ?>" class="form-control text-uppercase"> &nbsp;S/O<input type="text" name="son_of" value="<?php echo $son_of; ?>" class="form-control text-uppercase">&nbsp;do hereby solemnly verify that to the best of my knowledge and belief the information given in the application and the annexures and statements accompanying it is correct and complete.<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; I further declare that I am making this application in my capacity as&nbsp;<input type="text" name="designation" placeholder="designation" value="<?php echo $designation; ?>" class="form-control text-uppercase"> &nbsp;and that I am competent to make this application and verify it, by virtue of a photo/attested copy which has already been submitted.	
									</td>												 
								</tr>
								<tr>
								   <td>Date:</td>
									<td><input type="datetime" value="<?php echo date('d-m-Y',strtotime($today)); ?>" class="form-control" disabled></td>
									<td>Signature of applicant :</td>
									<td><input type="text" value="<?php echo strtoupper($key_person); ?>" class="form-control" disabled></td>
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
	/* ---------------------upload S/C click operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
	/* ------------------------------------------------------ */	
</script>