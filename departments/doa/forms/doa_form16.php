<?php  require_once "../../requires/login_session.php";
$dept="doa";
$form="16";
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
		    $form_id=$results["form_id"];$concern=$results["concern"];$loc=$results["loc"];$license=$results["license"];$declaration=$results["declaration"];$father=$results["father"];$designation=$results["designation"];$photo=$results["photo"];$place=$results["place"];$total_pesticides=$results["total_pesticides"];
		}else{
			$concern="";$loc="";$license="";$declaration="";$father="";$designation="";$photo="";$place="";$total_pesticides="";
		}
	}else{	
		$results=$q->fetch_array();
		$form_id=$results["form_id"];$concern=$results["concern"];$loc=$results["loc"];$license=$results["license"];$declaration=$results["declaration"];$father=$results["father"];$designation=$results["designation"];$photo=$results["photo"];$place=$results["place"];$total_pesticides=$results["total_pesticides"];
			
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
									    <td colspan="4" class="form-inline">
										 &nbsp; I/We &nbsp;<input  type="text" name="concern" value="<?php echo $concern; ?>" class="form-control text-uppercase">&nbsp;of&nbsp;<input  type="text" name="unit_name" value="<?php echo $unit_name; ?>" class="form-control text-uppercase">hereby apply for the renewal of the license to manufacture insecticides on the premises  situated at <input  type="text" name="loc" value="<?php echo $loc; ?>" class="form-control text-uppercase">&nbsp;&nbsp;(License No. and date to be given )  
							
										</td>
									   </tr>	
										
										<tr>
											<td colspan="4">&nbsp; The other details regarding the manufacture of the insecticides continue to remain the same.</td>
										</tr>
										
										<tr>
											<td width="25%">&nbsp;Particulars of the license is enclosed herewith:</td>
											
											<td colspan="3"><textarea type="text" class="form-control text-uppercase" name="license"><?php echo $license; ?></textarea></td>
										</tr>
										<tr>
											<td>Total No. of Pesticides : <span class="mandatory_field">*</span><span class="mandatory_field">*</span> </td>
											<td><input type="text" name="total_pesticides" class="text-uppercase form-control" required="required" validate="onlyNumbers" value="<?php echo $total_pesticides; ?>"></td>
											<td></td>
											<td></td>
										</tr>
									    <tr>
											<td>
											</td>
										
											<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;VERIFICATION&nbsp;&nbsp;&nbsp;&nbsp;</td>
										 </tr>
										<tr>
									       <td colspan="4" class="form-inline">&nbsp;I&nbsp;  
											<input  type="text" name="declaration" value="<?php echo $declaration; ?>" class="form-control text-uppercase">&nbsp;S/O&nbsp;<input  type="text" value="<?php echo $father; ?>" name="father" class="form-control text-uppercase" >&nbsp;&nbsp;do hereby solemnly verify that what is stated above is &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;true and correct to the best of my knowledge and belief.I further declare that I am making this application in my capacity as &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;  <input type="text" name="designation" value="<?php echo $designation; ?>" class="form-control text-uppercase">(designation)and that I am competent to make this application and verify it,by virtue of <input type="text" name="photo" value="<?php echo $photo; ?>" class="form-control text-uppercase">a photo /attested copy of which is enclosed.</td>
											<td></td>
											<td></td>
										</tr>
										
										<tr>
								          <td>Date:</td>
									      <td><input type="datetime" value="<?php echo date('d-m-Y',strtotime($today)); ?>" class="form-control" disabled></td></td>
									      <td>&nbsp;</td>
									      <td>&nbsp;</td>

										<tr>
								     
											<td>Place:</td>
											<td><input type="text" value="<?php echo strtoupper($dist); ?>" class="form-control" disabled></td>
											
									   
										<td>Signature with Seal:</td>
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
	/* ---------------------Block all after submit operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
	
</script>