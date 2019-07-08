<?php  require_once "../../requires/login_session.php";
$dept="doa";
$form="20";
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
		    $form_id=$results["form_id"];$state=$results["state"];$licence_no=$results["licence_no"];$day=$results["day"];$year=$results["year"];$premises=$results["premises"];$premises1=$results["premises1"];$pesticides=$results["pesticides"];$principals=$results["principals"];
		}else{
			$form_id="";$state="";$licence_no="";$day="";$year="";$premises="";$premises1="";$pesticides="";$principals="";
		}
	}else{	
        $results=$q->fetch_array();		
		$form_id=$results["form_id"];$state=$results["state"];$licence_no=$results["licence_no"];$day=$results["day"];$year=$results["year"];$premises=$results["premises"];$premises1=$results["premises1"];$pesticides=$results["pesticides"];$principals=$results["principals"];
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
									    <td colspan="4">To,<br/>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The Licensing Authority,<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										State of Assam <br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I/We hereby apply for renewal of the license to sell stock or exhibit for sale or distribute insecticides under the name and style of   
							
										</td>
									   </tr>	
									
										<tr>
											<td colspan="4" class="form-inline">&nbsp;&nbsp;1.&nbsp;&nbsp; The license desired to be renewal was granted by the Licensing Authority for State of 
											<input  type="text" name="state" value="<?php echo $state; ?>" class="form-control text-uppercase">&nbsp;license No.<input  type="text" value="<?php echo $licence_no; ?>" name="licence_no" class="form-control text-uppercase" ><br/>&nbsp; on the day of &nbsp;<input type="text" name="day" value="<?php echo $day; ?>" class="form-control text-uppercase"> &nbsp; 20<input validate="onlyNumbers" maxlength="2"type="text" name="year" value="<?php echo $year; ?>" class="form-control text-uppercase"></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td colspan="4">&nbsp;2.&nbsp; The situation of applicant's premises where the insecticides are will be</td>
										</tr>
										<tr>
											<td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;a. Premises where insecticides are stored:</td>
										    <td colspan="2"><input  type="text" value="<?php echo $premises; ?>" name="premises" class="form-control text-uppercase" ></td>
										 </tr>
											<td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;b. Premises where insecticides are sold :</td>
											
											<td colspan="2"><input  type="text" value="<?php echo $premises1; ?>" class="form-control text-uppercase" name="premises1"></td>
										</tr>
										<tr>
											<td colspan="4">&nbsp;3.&nbsp;The insecticides in which I/am/we/are carrying on business and the name of the principals whom I/we represent are stated below:-  </td>
										</tr>
										<tr>
											<td width="25%">&nbsp;&nbsp;(a)Name of Pesticides :</td>
											<td width="25%"><input  type="text" value="<?php echo $pesticides; ?>" class="form-control text-uppercase" name="pesticides"></td>
											
									
											<td width="25%">&nbsp;&nbsp;(b)Name of Principals:</td>
											<td width="25%"><input  type="text" value="<?php echo $principals; ?>" class="form-control text-uppercase" name="principals"></td>
										</tr>
										
											
										<tr>
											<td colspan="2" width="50%">&nbsp;&nbsp;Full Name:<label ><?php echo $key_person;?></label><br/>
											
											<td colspan="2" width="50%">&nbsp;&nbsp;Address of the Applicant: <strong><?php echo strtoupper($street_name1)?></strong></td>
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