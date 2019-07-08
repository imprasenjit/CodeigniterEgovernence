<?php  require_once "../../requires/login_session.php"; 
$dept="fire";
$form="11";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);	
include "save_form.php";
	
	

	
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
	if($q->num_rows<1){
	$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
		if($p->num_rows>0){
			$row=$p->fetch_array();
            $form_id=$row['form_id'];
            $owner_name=$row['owner_name'];
			$holding_no=$row['holding_no'];$letter_no=$row['letter_no'];$renewal_year1=$row['renewal_year1'];$renewal_year2=$row['renewal_year2'];$letter_valid_date=$row['letter_valid_date'];$letter_date=$row['letter_date'];$nearest_station=$row['nearest_station'];  	   
			
		}else{
			$form_id="";$holding_no="";$letter_no="";$renewal_year1="";$renewal_year2="";$letter_valid_date="";$letter_date="";$nearest_station="";$owner_name="";
		}
	}else{
			$row=$q->fetch_array();
            $form_id=$row['form_id'];
            $owner_name=$row['owner_name'];
			$holding_no=$row['holding_no'];$letter_no=$row['letter_no'];$renewal_year1=$row['renewal_year1'];$renewal_year2=$row['renewal_year2'];$letter_valid_date=$row['letter_valid_date'];$letter_date=$row['letter_date'];$nearest_station=$row['nearest_station'];  	   
			
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
										<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form); ?></strong>
									</h4>	
								</div>
								<div class="panel-body">
									<div id="table1" class="tab-pane" role="tabpanel">
									<form name="myform1" id="myform1" class="form-inline submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table>
										<tr>
											<td colspan="4">
												<p style="line-height:20px" >&emsp;&emsp;I/We &nbsp;<strong name="owner_name" id="oname"><?php echo strtoupper($owner_name); ?></strong> &nbsp;on behalf of&nbsp; <strong><?php echo strtoupper($unit_name); ?></strong>&nbsp; located at &nbsp;<strong><?php  echo $from; ?></strong> &nbsp;holding No<span class="mandatory_field">*</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" class="form-control" name="holding_no" id="textfield3" required="required" placeholder="Holding No" value="<?php  echo $holding_no; ?>"/>&nbsp; District &nbsp; <strong><?php  echo strtoupper($b_dist); ?></strong>,&nbsp;  State &nbsp; <strong>Assam</strong> &nbsp; do hereby inform you  that No Objection Certificate (N.O.C.) issued vide your Letter No./UAIN<span class="mandatory_field">*</span>&nbsp;&nbsp;&nbsp;&nbsp &nbsp; <input type="text" name="letter_no" id="textfield6" style="width:200px;" class="form-control" required="required" placeholder="Letter No" value="<?php echo $letter_no; ?>"/>Dated<span class="mandatory_field">*</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<input type="text"  name="letter_date" class="dob form-control" readonly="readonly"  placeholder="YYYY/MM/DD" value="<?php  echo $letter_date;?>"/>&nbsp;valid up to<span class="mandatory_field">*</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; <input type="text" name="letter_valid_date" id="textfield8" readonly="readonly" placeholder="YYYY/MM/DD"  class="dob form-control" value="<?php echo $letter_valid_date;?>"/>&nbsp;(Copy of N.O.C. is Enclosed) and is due for renewal for a period of another 1(One) Year with effect from 1<sup>st</sup> of April  &nbsp;<input type="text" class="form-control"  required="required" id="textfield9" name="renewal_year1" value="<?php if(empty($renewal_year1)==false)  echo $renewal_year1; else echo date('Y');?>"/> to 31<sup>st</sup>  of March &nbsp; <input class="form-control"  type="text" id="textfield10" required="required" name="renewal_year2"  value="<?php if(empty($renewal_year2)==false)  echo $renewal_year2; else echo date('Y',strtotime('+1 year')); ?>" />.</p>
											</td>
										</tr>
										<tr>			
											<td> Nearest fire &amp; Emergency Service Station :<span class="mandatory_field">*</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                              <td><?php 
											//$b_dist_id=$formFunctions->get_district_id($b_dist);	
											$fire_stations=$formFunctions->executeQuery($dept,"select * from nearest_fire_stations where district_id='$b_dist_id'"); ?>
											<select name="nearest_station" class="form-control text-uppercase" required="required">
												<option value="">Please Select Nearest Fire Station</option>
												<?php while($rows=$fire_stations->fetch_object()) {
													if(isset($nearest_station) && ($nearest_station==$rows->id)){
														$s='selected'; 
													}else{
														$s='';
													}  ?>
													<option value="<?php echo $rows->id; ?>" <?php echo $s;?>><?php echo $rows->nearest_fire_station; ?></option>
												<?php }		?>
											</select></td>
																				
											<td></td>
											<td></td>
										</tr>
									
									</table><br/>
									<table id="" class="table table-responsive table-striped">
										<tr>
											<th>In this application it is submitted that-</th>
										</tr>
										<tr>
											<td>&#42; There is no change in trade for which license has been issued.</td>
										</tr>
										<tr>
											<td>&#42; There is no any structural change of the Building either horizontally or vertically affecting means of escapes/ Exits.</td>
										</tr>
										<tr>
											<td>&#42; There is no any change in existing Fire Fighting arrangement.</td>
										</tr>
										<tr>
											<td>&#42; Fire prevention &amp; Fire Safety Measures/ Arrangements have been tested and are in Good Working condition.</td>
										</tr>
										<tr>
											<td>&#42; You are requested kindly to take necessary action for grant of Renewal of N.O.C. for the above premises/building.</td>
										</tr>
									</table>
									<table id=""  class="table table-responsive">
										   <tr>
												<td colspan="4"><u>Contact Details</u></td>
										   </tr>
										<tr>
												<td> 1. Name in Full  :- &emsp;<strong><?php  echo strtoupper($key_person); ?></strong>
												</td>
											</tr>
											<tr>
												<td>2. Telephone No. :- &emsp;<strong><?php  echo $landline_std; ?>-<?php  echo $landline_no; ?></strong></td>
											</tr>
											<tr>
												<td>3. Mobile No. :- &emsp;<strong>+91-<?php  echo $mobile_no; ?> </strong></td>		
												<td></td>
												<td></td>
											</tr>
											<tr>
												<td></td><td></td><td></td>
												<td></td>
												<td align="right"><strong><?php echo strtoupper($key_person); ?></strong></td>
											</tr>
											<tr>
												<td></td><td></td><td></td>
												<td></td>
												<td align="right">Signature of the Applicant</td>
											</tr>
											<tr>
												<td class="text-center" colspan="5">
													<button type="submit" style="font-weight:bold" name="save<?php echo $form; ?>" class="btn btn-success submit1">Save and Next</button>
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

$('.dob').datepicker({dateFormat: 'yy-mm-dd', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});

/* ---------------------upload S/C click operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
	/* ------------------------------------------------------ */
	
$('#dist1').change(function(){
	var city=$(this).val();
	$('#block1').empty();
	$.ajax({ 
		type: 'GET',
		url: '../../../ajax/district_blocks.php', 
		data: { city: city },
		beforeSend:function(){
			$("#block1").html("Loading..");
		},
		success:function(data){
			$("#block1").html(data);
		},
		error:function(){ }
	}); //ajax end
});
</script>