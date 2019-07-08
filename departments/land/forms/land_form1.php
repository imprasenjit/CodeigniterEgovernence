<?php  require_once "../../requires/login_session.php";
$dept="land";
$form="1";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);

include "save_land_form.php";

	
	$q=$formFunctions->executeQuery($dept,"select * from land_form1 where user_id='$swr_id' and active='1'") ;
	
	if($q->num_rows<1){	 
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
		if($p->num_rows>0){
			$results=$p->fetch_assoc();	
			$form_id=$results['form_id'];

			$adhar_no=$results["adhar_no"];$post_office=$results["post_office"];$parties_result=$results["parties"];$desc_doc=$results["desc_doc"];$reg_off=$results["reg_off"];$rel_petition=$results["rel_petition"];$deed_no=$results["deed_no"];$deed_year=$results["deed_year"];$req_nature=$results["req_nature"];$remarks=$results["remarks"];
			$parties=Array();
			$parties=explode(",",$parties_result);
				
			$file1=$results["file1"];$file2=$results["file2"];$file3=$results["file3"];$file4=$results["file4"];
			
			
			if(!empty($results["courier_details"]) && $results["courier_details"]!=1){
					$courier_details=json_decode($results["courier_details"]);
					$courier_details_cn=$courier_details->cn;$courier_details_rn=$courier_details->rn;$courier_details_dt=$courier_details->dt;
				}else{
					$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
				}
		}else{
			
			$adhar_no="";$post_office="";$parties="";$desc_doc="";$reg_off="";$rel_petition="";$deed_no="";$deed_year="";$req_nature="";$remarks="";	
			$file1="";$file2="";$file3="";$file4="";
			$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
		}
	}else{
		$results=$q->fetch_array();
		$form_id=$results['form_id'];

		$adhar_no=$results["adhar_no"];$post_office=$results["post_office"];$parties_result=$results["parties"];$desc_doc=$results["desc_doc"];$reg_off=$results["reg_off"];$rel_petition=$results["rel_petition"];$deed_no=$results["deed_no"];$deed_year=$results["deed_year"];$req_nature=$results["req_nature"];$remarks=$results["remarks"];
		$parties=Array();
		$parties=explode(",",$parties_result);
				
		$file1=$results["file1"];$file2=$results["file2"];$file3=$results["file3"];$file4=$results["file4"];

		if(!empty($results["courier_details"]) && $results["courier_details"]!=1){
		   $courier_details=json_decode($results["courier_details"]);
		   $courier_details_cn=$courier_details->cn;$courier_details_rn=$courier_details->rn;$courier_details_dt=$courier_details->dt;
		}else{
			$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
		}
	}
##PHP TAB management
	$showtab=isset($_GET['tab'])?$_GET['tab']:"";
	
	$tabdiv1="";$tabbtn1="";$tabdiv2="";$tabbtn2="";$tabdiv3="";$tabbtn3="";$tabdiv4="";$tabbtn4="";
	if($showtab=="" || $showtab<2 || $showtab>5 || is_numeric($showtab)==false){
		$tabdiv1="style='display:block;'";$tabbtn1="active";$tabdiv2="style='display:none;'";$tabbtn2="";
		$tabdiv3="style='display:none;'";$tabbtn3="";$tabdiv4="style='display:none;'";$tabbtn4="";
	}
	if($showtab==2){
		$tabdiv1="style='display:none;'";$tabbtn1="";$tabdiv2="style='display:block;'";$tabbtn2="active";
		$tabdiv3="style='display:none;'";$tabbtn3="";$tabdiv4="style='display:none;'";$tabbtn4="";
	}
	if($showtab==3){
		$tabdiv1="style='display:none;'";$tabbtn1="";$tabdiv2="style='display:none;'";$tabbtn2="";
		$tabdiv3="style='display:block;'";$tabbtn3="active";$tabdiv4="style='display:none;'";$tabbtn4="";
	}
	 
	##PHP TAB management ends
	
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
							<ul class="nav nav-pills">
							   <li class="<?php echo $tabbtn1; ?>"><a href="#table1">PART I</a></li>
							    <li class="<?php echo $tabbtn2; ?>"><a href="#table2">Upload Section</a></li>
							</ul>
								<br>
								<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform1" id="landComF2" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table class="table table-responsive">
								    <tr>
										<td colspan="4"><strong>Applicant&apos;s Details</strong></td>
									</tr>
									<tr>
										<td > Applicant&apos;s Name </td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $key_person; ?>"></td>
										<td> Mobile Number</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $mobile_no; ?>"></td>
									</tr>
									
									<tr>
										<td>Mail Id</td>
										<td><input type="text" class="form-control " disabled value="<?php echo $email; ?>"></td>
										<td>Pan Number</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $pan_no; ?>"></td>
									</tr>
									<tr>
										<td>Aadhar card Number</td>
										<td><input type="text" name="adhar_no" class="form-control text-uppercase" value="<?php echo $adhar_no; ?>"></td>
										<td>Date of Application</td>
										<td><input type="text" readonly="readonly" class="form-control text-uppercase"  value="<?php echo date("d-m-Y"); ?>"></td>
									</tr>
									<tr>
										<td colspan="4"><strong>Address Details</strong></td>
									</tr>
									<tr>
									    <td>Street Name1</td>
									    <td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $b_street_name1; ?>" ></td>
									    <td>Street Name2</td>
										<td><input type="text" class="form-control text-uppercase" disabled  value="<?php echo $b_street_name2; ?>" /></td>
									</tr>
									<tr>
									    <td>State</td>
									    <td><input type="text"  class="form-control text-uppercase" disabled value="Assam" ></td>
									    <td>District</td>
										<td><input type="text" class="form-control text-uppercase" disabled  value="<?php echo $b_dist; ?>" /></td>
									</tr>
									<tr>
										
										<td>Sub-Division</td>
										<td><input type="text" class="form-control text-uppercase" disabled  value="<?php echo $b_block; ?>" /></td>
										<td>Circle Office</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $circle; ?>" /></td>
										
									</tr>
									<tr>
									    <td>Mouza</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $mouza; ?>"/> </td>
										<td>Village/Town</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $b_vill; ?>"></td>
										
									</tr>
									<tr>
									    <td>Post Office</td>
										<td><input type="text" name="post_office" class="form-control text-uppercase" required value="<?php echo $post_office; ?>"/> </td>
									    <td>Pincode</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $b_pincode; ?>"/> </td>
										
									</tr>									
									<tr>
										<td colspan="4"><strong>Other Details</strong></td>
									</tr>
									<tr>
										<td colspan="2">Name of the parties with concerned document</td>
										<td colspan="2">
											<table id="pp_more" class="table table-responsive">
											<?php if(!empty($parties_result)){
											for($sl=0;$sl<count($parties);$sl++){	?>
												<tr id="row<?php echo $sl+1; ?>">
													<td>
														<div class="input-group"><input class="form-control text-uppercase" id="extrafield<?php echo $sl+1; ?>" type="text" class="added_input" value="<?php echo $parties[$sl]; ?>" name="parties[]">
														<?php if($sl==0){ ?>
															<div class="input-group-addon">
																<a href="#!" class="mybtn" style="display:inline" id="add_pp_more" ><i class="fa fa-plus-square" aria-hidden="true"></i></a>
															</div>
														<?php }else{ ?>
															<div class="input-group-addon"><span onclick="removeRow(<?php echo $sl+1; ?>)" class="removeRow"><i style="cursor:pointer" class="fa fa-times" aria-hidden="true"></i></span></div>
														<?php } ?>
														</div></td>
												</tr>												
											<?php }
											}else{ ?>
												<tr id="row">
													<td>
														<div class="input-group">
															<input type="text" value="" class="form-control text-uppercase" name="parties[]" id="initField" />
															<div class="input-group-addon">
																<a href="#!" class="mybtn" style="display:inline"  id="add_pp_more" ><i class="fa fa-plus-square" aria-hidden="true"></i></a>
															</div>
														</div>
													</td>
												</tr>
											<?php } ?>
											</table>
										</td>
			                        </tr>									
									<tr>
										<td>Description of Document I / <br/>Land II / Marriage III</td>
										<td><textarea class="form-control text-uppercase" name="desc_doc"validate="textarea" required maxlength="255"><?php echo $desc_doc; ?></textarea>255 Characters Only</td>
									
										<td>Name of Registering office <br/>where deed is registered</td>
										<td><input type="text" required name="reg_off" class="form-control text-uppercase"  value="<?php echo $reg_off; ?>"></td>
									</tr>
									
									<tr>
										<td>Relation of Petitioner with the<br/> subject matter</td>
									
										<td><input type="text" required name="rel_petition"class="form-control text-uppercase" r value="<?php echo $rel_petition; ?>"></td>
									
										<td>Deed No</td>
										<td><input type="text" required  name="deed_no"class="form-control text-uppercase"  value="<?php echo $deed_no; ?>"></td>
									</tr>

									<tr>
										<td>Year of Deed</td>
										<td><input type="number" min="1960" max="2020"required  name="deed_year"class="form-control text-uppercase"  value="<?php echo $deed_year; ?>"></td>

                                        <td>Nature of Requirement</td>
										<td><input type="text" required  name="req_nature"class="form-control text-uppercase"  value="<?php echo $req_nature; ?>"></td>
									</tr>				
									<tr> 									
										<td>Remarks</td>
										<td><textarea class="form-control text-uppercase" name="remarks"validate="textarea" required maxlength="255"><?php echo $remarks; ?></textarea>255 Characters Only</td>
										<td></td>
										<td></td>
									</tr>
									
									<tr>
									    <td>Date : <?php echo date('d-m-Y', strtotime($today)); ?><br/>
											Place : <?php echo strtoupper($dist); ?>
										</td>
										<td></td>
										<td></td>
										<td><label><?php echo strtoupper($key_person); ?></label><br/>Signature of the Applicant</td>
										
									</tr>
									<tr>
										<td class="text-center" colspan="4">
											<button type="submit" name="save1" class="btn btn-success submit1" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
										</td>
									</tr>
								</table>
								</form>
								</div>
        <div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
        <form name="fileUpload" id="lc_reg2_upload" class="submit1" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
			<table id="" class="table table-responsive">	
				<tr>
					<td colspan="5">Documents to be enclosed <br/>(All documents mentioned here are mendatory. Please upload all proper documents before proceeding further).</td>
				</tr>
				<tr>
					<td width="40%">NOC of DC.</td>
					<td width="30%">
                                            <select trigger="FileModal" id="file1" class="form-control">                                            
                                                <option value="0" selected="selected"><?php echo uploadinfo($file1); ?></option>
                                                <option value="1">From E-Locker</option>
                                                <option value="2">From PC</option>
                                                <option value="4">Send by Courier</option>
                                                <option value="3">Not Applicable</option>
                                            </select>
                                            <input type="hidden" name="mfile1" id="mfile1" value="<?php echo $file1 !== '' ? $file1 : ''; ?>" />
										</td>
					<td width="20%" id="tdfile1">
                                            <?php if($file1!="" && $file1!="SC" && $file1!="NA"){ echo '<a href="'.$upload.$file1.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
                     </td>
				</tr>
				<tr>
					<td>NOC from GMDA/Permission from Municipality.</td>
					<td width="30%">
                                            <select trigger="FileModal" id="file2" class="form-control">                                            
                                                <option value="0" selected="selected"><?php echo uploadinfo($file2); ?></option>
                                                <option value="1">From E-Locker</option>
                                                <option value="2">From PC</option>
                                                <option value="4">Send by Courier</option>
                                                <option value="3">Not Applicable</option>
                                            </select>
                                            <input type="hidden" name="mfile2" id="mfile2" value="<?php echo $file2 !== '' ? $file2 : ''; ?>" />
										</td>
					<td width="20%" id="tdfile2">
                                            <?php if($file2!="" && $file2!="SC" && $file2!="NA"){ echo '<a href="'.$upload.$file2.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
                     </td>
				</tr>
				<tr>
					<td>Original deed in stamp paper (with stamp assessment).</td>
					<td width="30%">
                                            <select trigger="FileModal" id="file3" class="form-control">                                            
                                                <option value="0" selected="selected"><?php echo uploadinfo($file3); ?></option>
                                                <option value="1">From E-Locker</option>
                                                <option value="2">From PC</option>
                                                <option value="4">Send by Courier</option>
                                                <option value="3">Not Applicable</option>
                                            </select>
                                            <input type="hidden" name="mfile3" id="mfile3" value="<?php echo $file3 !== '' ? $file3 : ''; ?>" />
										</td>
					<td width="20%" id="tdfile3">
                                            <?php if($file3!="" && $file3!="SC" && $file3!="NA"){ echo '<a href="'.$upload.$file3.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
                     </td>
				</tr>
				<tr>
					<td>Any other document.</td>
						<td width="30%">
                                            <select trigger="FileModal" id="file4" class="form-control">                                            
                                                <option value="0" selected="selected"><?php echo uploadinfo($file4); ?></option>
                                                <option value="1">From E-Locker</option>
                                                <option value="2">From PC</option>
                                                <option value="4">Send by Courier</option>
                                                <option value="3">Not Applicable</option>
                                            </select>
                                            <input type="hidden" name="mfile4" id="mfile4" value="<?php echo $file4 !== '' ? $file4 : ''; ?>" />
										</td>
					<td width="20%" id="tdfile4">
                                            <?php if($file4!="" && $file4!="SC" && $file4!="NA"){ echo '<a href="'.$upload.$file4.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
                     </td>
				</tr>
				<tr>
					<td class="text-center" colspan="4">
						<a href="land_form2.php?tab=1"><button type="submit" class="btn btn-primary">Go Back & Edit</button></a>										
						<button type="submit" class="btn btn-success submit1" name="submit1" title="Save it and fill up the form later and Go to the Next Part" onclick="return confirm('Do you really want to save the form ?')">Submit</button>
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
		</div>
	  <!-- /.content-wrapper -->
	  <?php require_once "../../../views/users/requires/footer.php";  ?>
    <?php require '../../requires/js.php' ?>
<script>
	var incd=<?php if(!empty($parties)) echo count($parties); else echo "1"; ?>;
    $('#add_pp_more').click(function(){		
		$('table[id="pp_more"] tr:last-of-type').after('<tr id="row'+incd+'"><td><div class="input-group"><input class="form-control text-uppercase" id="extrafield'+incd+'" type="text" class="added_input" pattern="[a-zA-Z\\s]+" name="parties[]"><div class="input-group-addon"><span onclick="removeRow('+incd+')" class="removeRow"><i style="cursor:pointer" class="fa fa-times" aria-hidden="true"></i></span></div></div></td></tr>');
		incd++;
    });
	function removeRow(value){
		$('tr[id="row'+value+'"]').remove();
	}
	$('#tab2, #tab3, #tab4, #tab5, #tab6, #tab7, #tab8, #tab9').css('display', 'none');
	$('a[href="#tab1"]').on('click', function(){
		
		$('#tab1').css('display', 'table');
		$('#tab2, #tab3, #tab4, #tab5, #tab6, #tab7, #tab8, #tab9').css('display', 'none');
	});
	$('a[href="#tab2"]').on('click', function(){
		
		$('#tab2').css('display', 'table');
		$('#tab1, #tab3, #tab4, #tab5,#tab6,#tab7,#tab8,#tab9').css('display', 'none');
	});
	$('a[href="#tab3"]').on('click', function(){
		$('#tab3').css('display', 'table');
		$('#tab1, #tab2, #tab4, #tab5, #tab6, #tab7, #tab8, #tab9').css('display', 'none');
	});
	$('a[href="#tab4"]').on('click', function(){
		$('#tab4').css('display', 'table');
		$('#tab1, #tab2, #tab3, #tab5,#tab6,#tab7,#tab8,#tab9').css('display', 'none');
	});
	$('a[href="#tab5"]').on('click', function(){
		$('#tab5').css('display', 'table');
		$('#tab1, #tab2, #tab3, #tab4, #tab6, #tab7, #tab8, #tab9').css('display', 'none');
	});
	$('a[href="#tab6"]').on('click', function(){
		$('#tab6').css('display', 'table');
		$('#tab1, #tab2, #tab3, #tab4, #tab5, #tab7, #tab8, #tab9').css('display', 'none');
	});
	$('a[href="#tab7"]').on('click', function(){
		$('#tab7').css('display', 'table');
		$('#tab1, #tab2, #tab3,  #tab4, #tab5, #tab6, #tab8, #tab9').css('display', 'none');
	});
	$('a[href="#tab8"]').on('click', function(){
		$('#tab8').css('display', 'table');
		$('#tab1, #tab2, #tab3, #tab4, #tab5, #tab6, #tab7, #tab9').css('display', 'none');
	});
	$('a[href="#tab9"]').on('click', function(){
		$('#tab9').css('display', 'table');
		$('#tab1, #tab2, #tab3, #tab4, #tab5, #tab6, #tab7, #tab8').css('display', 'none');
	});
	/* ----------------------------------------------------- */
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
	
	/* ------------------------------------------------------ */
</script>
