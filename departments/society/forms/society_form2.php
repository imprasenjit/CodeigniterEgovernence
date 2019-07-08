<?php  require_once "../../requires/login_session.php";
$dept="society";
$form="2";
$table_name=$formFunctions->getTableName($dept,$form);
include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
include "save_form.php";

$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
if($q->num_rows<1){
	$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
	if($p->num_rows>0){
		$results=$p->fetch_assoc();
		$form_id=$results['form_id'];	
		$s_po=$results['s_po'];$s_ps=$results['s_ps'];$s_con=$results['s_con'];$operation_area=$results['operation_area'];$s_obj=$results['s_obj'];$language=$results['language'];$admn_fee=$results['admn_fee'];$share_value=$results['share_value'];
	}else{
		$form_id="";
		$s_po="";$s_ps="";$s_con="";$operation_area="";$s_obj="";$language="";$admn_fee="";$share_value="";	
	}
}else{
	$results=$q->fetch_assoc();
	$form_id=$results['form_id'];	
	$s_po=$results['s_po'];$s_ps=$results['s_ps'];$s_con=$results['s_con'];$operation_area=$results['operation_area'];$s_obj=$results['s_obj'];$language=$results['language'];$admn_fee=$results['admn_fee'];$share_value=$results['share_value'];		
}
	
##PHP TAB management
	$showtab = isset($_GET['tab']) ? $_GET['tab'] : "";

	$tabbtn1 = "";
	$tabbtn2 = "";
	$tabbtn3 = "";
	$tabbtn4 = "";
	$tabbtn5 = "";
	if ($showtab == "" || $showtab < 2 || $showtab > 5 || is_numeric($showtab) == false) {
		$tabbtn1 = "active";
		$tabbtn2 = "";
		$tabbtn3 = "";
		$tabbtn4 = "";
		$tabbtn5 = "";
	}
	if ($showtab == 2) {
		$tabbtn1 = "";
		$tabbtn2 = "active";
		$tabbtn3 = "";
		$tabbtn4 = "";
		$tabbtn5 = "";
	}
	if ($showtab == 3) {
		$tabbtn1 = "";
		$tabbtn2 = "";
		$tabbtn3 = "active";
		$tabbtn4 = "";
		$tabbtn5 = "";
	}
	if ($showtab == 4) {
		$tabbtn1 = "";
		$tabbtn2 = "";
		$tabbtn3 = "";
		$tabbtn4 = "active";
		$tabbtn5 = "";
	}
	if ($showtab == 5) {
		$tabbtn1 = "";
		$tabbtn2 = "";
		$tabbtn3 = "";
		$tabbtn4 = "";
		$tabbtn5 = "active";
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
									<li class="<?php echo $tabbtn1; ?>"><a  href="#table1">PART 1</a></li>
									<li class="<?php echo $tabbtn2; ?>"><a  href="#table2">PART 2</a></li>
									<li class="<?php echo $tabbtn3; ?>"><a  href="#table4">SCHEDULE-A</a></li>
									<li class="<?php echo $tabbtn4; ?>"><a  href="#table5">SCHEDULE-B</a></li>
									<li class="<?php echo $tabbtn5; ?>"><a  href="#table6">Undertaking</a></li>
								</ul>
								<br>
								<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
								<table id="" class="table table-responsive">
									<tr>
										<td width="25%">1. Name of the proposed society:</td>
										<td width="25%"><input type="text"  class="form-control text-uppercase" disabled value="<?php echo $unit_name; ?>" ></td>
										<td width="25%"></td>
										<td width="25%"></td>	
									</tr>
									<tr>
										<td colspan="4">2. The registered address of the proposed society: </td>
									</tr>
									<tr>
										<td>a) House No./ Bye lane:</td>
										<td><input type="text"  class="form-control text-uppercase" disabled value="<?php echo $b_street_name1; ?>" ></td>
										<td>b) Locality:</td>
										<td><input type="text"  class="form-control text-uppercase" disabled value="<?php echo $b_street_name2; ?>" ></td>
									</tr>
									<tr>
										<td>c) Post office:</td>
										<td><input type="text"  class="form-control text-uppercase" name="s_po" value="<?php echo $s_po; ?>" ></td>
										<td>d)P.S:</td>
										<td><input type="text"  class="form-control text-uppercase" name="s_ps" value="<?php echo $s_ps; ?>" ></td>
									</tr>
									<tr>
										<td>e)Vill/ Town:</td>
										<td><input type="text"  class="form-control text-uppercase" disabled value="<?php echo $b_vill; ?>"  ></td>
										<td>f) Mouza:</td>
										<td><input type="text"  class="form-control" disabled value="<?php echo $mouza; ?>" ></td>
									</tr>
									<tr>
										<td>g)Circle:</td>
										<td><input type="text"  class="form-control text-uppercase" disabled value="<?php echo $circle; ?>" ></td>
										<td>h) Constituency:</td>
										<td><input type="text"  class="form-control text-uppercase" name="s_con" value="<?php echo $s_con; ?>" ></td>
									</tr>
									<tr>
										<td>i)Sub-division:</td>
										<td><input type="text"  class="form-control text-uppercase" disabled value="<?php echo $b_block; ?>"  ></td>
										<td>j)District:</td>
										<td><input type="text"  class="form-control" disabled value="<?php echo $b_dist; ?>" validate="email"></td>
									</tr>									
									<tr>
										<td>3. Area of operation of the society:</td>
										<td><input type="text"  class="form-control text-uppercase" name="operation_area" value="<?php echo $operation_area; ?>" ></td>
										<td>4.Objective of the society:</td>
										<td><textarea  class="form-control text-uppercase" name="s_obj" ><?php echo $s_obj; ?></textarea>255 Characters only</td>
									</tr>
									<tr>
										<td>5. Language in which the books &amp; records will be maintained:</td>
										<td><input type="text"  class="form-control text-uppercase" name="language" value="<?php echo $language; ?>" ></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td>6.(i). Each member shall pay an admission fee of Rs.:</td>
										<td><input type="text"  class="form-control text-uppercase" name="admn_fee" validate="decimal" value="<?php echo $admn_fee; ?>" ></td>
										<!--<td>(ii). Subscribe at least one share of the value of Rs.:</td>-->
										<td>Authorised Share Capital (in Rs.): <font class="mandatory">*</font></td>
										<td><input type="text"  class="form-control text-uppercase" name="share_value" validate="decimal" value="<?php echo $share_value; ?>" ></td>
									</tr>
									<tr>
										<td class="text-center" colspan="4">
										<a href="<?php echo $table_name; ?>.php?tab=1"><button type="submit" class="btn btn-primary">Go Back & Edit</button></a>	
										<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>a" title="Save it" onclick="return confirm('Do you really want to save the form ?')">Submit</button>
									</td>
									</tr>
								</table>
								</form>
								</div>
								<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
								<table id="" class="table table-responsive">
									<tr>
									<td colspan="4">
										<table name="objectTable1" id="objectTable1" class="text-center table table-responsive table-bordered">
											<thead>
												<tr>
													<th>Sl No.</th>
													<th>Name </th>
													<th>Father&#39;s/Husband&#39;s name</th>
													<th>Age</th>
													<th>Postal address</th>
													<th>Occupation</th>
													<th>Equity partipation</th>
													<th>Upload Signature</th>
												</tr>
											</thead>
											<tbody>
											<?php 
											$part1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_members where form_id='$form_id'");
												$num1 = $part1->num_rows;
												if($num1==0){ 
													for($gumo=1; $gumo<11; $gumo++){ ?>
													<tr>
														<td><input type="text" readonly id="txxtA<?=$gumo;?>" class="form-control text-uppercase" value="<?=$gumo;?>" name="txxtA<?=$gumo;?>" size="1"></td>
														<td><input type="text" id="txxtB<?=$gumo;?>" class="form-control text-uppercase" value="" name="txxtB<?=$gumo;?>" required="required"></td>
														<td><input type="text" value=""  id="txxtC<?=$gumo;?>" class="form-control text-uppercase" name="txxtC<?=$gumo;?>" required="required"></td>
														<td><input type="text" value="" id="txxtD<?=$gumo;?>" class="form-control text-uppercase" name="txxtD<?=$gumo;?>" validate="onlyNumbers" maxlength="2" required="required"></td>
														<td><input type="text" value="" id="txxtE<?=$gumo;?>" class="form-control text-uppercase" name="txxtE<?=$gumo;?>" required="required"></td>
														<td><input type="text" value="" id="txxtF<?=$gumo;?>" class="form-control text-uppercase" name="txxtF<?=$gumo;?>" required="required"></td>
														<td><input type="text" value="" id="txxtG<?=$gumo;?>" class="form-control text-uppercase" name="txxtG<?=$gumo;?>" required="required"></td>
														<td>
															<span></span>
															<a href="#!" class="btn btn-info mysign" data-width="360" data-height="120" data-name="member-sign<?=$gumo;?>" required="required">Upload</a>
														</td>
													</tr>
												<?php } ?>
												<?php }else{	
													$count=1;
													while($rows=$part1->fetch_object()){
														if($rows->upload_signature == ""){
															$upload_signature="";
															$sign_base64="";
														}else{
															$upload_signature=$rows->upload_signature;
															$sign_path = $server_url. 'departments/society/forms/upload/'.$upload_signature;
															$sign_data = file_get_contents($sign_path);
															$sign_base64 = 'data:image/png;base64,' . base64_encode($sign_data);
														}														 
														?>
														<tr>
															<td><input type="text" readonly value="<?=$count;?>" id="txxtA" size="1" class="form-control text-uppercase" name="txxtA<?=$count;?>"></td>
															<td><input type="text" id="txxtB<?=$count;?>" value="<?php echo strtoupper($rows->member_name);?>" class="form-control text-uppercase" name="txxtB<?=$count;?>" required="required"></td>
															<td><input type="text" id="txxtC<?=$count;?>" value="<?php echo strtoupper($rows->member_fname);?>" class="form-control text-uppercase" name="txxtC<?=$count;?>" required="required"></td>
															<td><input type="text" id="txxtD<?=$count;?>" value="<?php echo strtoupper($rows->member_age);?>" class="form-control text-uppercase" name="txxtD<?=$count;?>" validate="onlyNumbers" maxlength="2" required="required"></td>					
															<td><input type="text" id="txxtE<?=$count;?>" value="<?php echo strtoupper($rows->member_address);?>" class="form-control text-uppercase" name="txxtE<?=$count;?>" required="required"></td>
															<td><input type="text" id="txxtF<?=$count;?>" value="<?php echo strtoupper($rows->member_occupation);?>" class="form-control text-uppercase" name="txxtF<?=$count;?>" required="required"></td>
															<td><input type="text" id="txxtG<?=$count;?>" value="<?php echo strtoupper($rows->member_partition);?>" class="form-control text-uppercase" name="txxtG<?=$count;?>" required="required"></td>
															<td>
															<?php if($count<11){ ?>
																<span><input type="hidden" name="member-sign<?php echo $count;?>" value="<?php echo $sign_base64; ?>"><img width="360" height="120" src="upload/<?php echo $upload_signature; ?>"/><br><br></span>
																<a href="#!" class="btn btn-info mysign" data-width="360" data-height="120" data-name="member-sign<?php echo $count;?>" required="required">Upload</a>
															<?php } ?>
															</td>
														</tr>
													<?php  $count++;
													}  ?>
											<?php } ?>	
											</tbody>
										</table>
										<!--<div align="right" style="position:relative;right:10px">
											<button type="button" class="btn btn-default" onclick="addMorefunction1()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction1()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval1" name="hiddenval1" value=""/>
										</div>
										-->										
									</td>
									</tr>									
									<tr>
										<td class="text-center" colspan="4">
										<a href="<?php echo $table_name; ?>.php?tab=1"><button type="submit" class="btn btn-primary">Go Back & Edit</button></a>	
										<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>b" title="Save it" onclick="return confirm('Do you really want to save the form ?')">Submit</button>
									  </td>
									</tr>									
								</table>
								</form>
								</div>
								<div id="table3" class="tab-pane <?php echo $tabbtn3; ?>" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
								<table id="" class="table table-responsive">
									<tr>
										<td colspan="4" align="center"><u>SCHEDULE-A <br/>ASSAM COOPERATIVE SOCIETIES ACT, 2007 (ACT-IV OF 2012)</u></td>
									</tr>
									<tr>
										<td colspan="4">
											<h5 align="center"><u>COOPERATIVE PRINCIPLES</u></h5>
											<p>The cooperative principles are guidelines by which cooperative societies put their values into practice.</p>
											<p>1<sup>st</sup> Principle: <u>Voluntary and open membership:</u><br/>
												Cooperative societies are voluntary organization, open to all person able to use their service and willing to accept the responsibilitys of membership, without gender, social, racial, political or religious discrimination.</p>
											<p>2<sup>nd</sup> Principle: <u>Democratic member control:</u><br/>	
												Cooperative societies are democratic organization controlled by their members, to actively participate in setting their policies and making decisions. Men and women serving as elected representative are accountable to the members. In primary cooperative, members have equal voting rights. (one member, one vote) and cooperative society at other levels are also organized in a democratic manner.
											<p>3<sup>rd</sup> Principle: <u>Members&#39; economic participation:</u><br/>
												Members contribute equitably to and democratically control, the capital of their cooperative societies. At least part of that capital is usually the common property of the cooperative. Members usually receive limited compensation, if any, on capital subcribed as a condition of membership. Members allocate surpluses for any or all of the following purposes: developing their cooperative societies, possibly by setting up reserves, part of which at least would be invisible, benefitting members in proportion to their transaction with the cooperative society, and supporting other activities approved by the members.
											<p>4<sup>th</sup>Principle:<u> Autonomy and independence:</u><br/>
												Cooperative societies are autonomus, self help organization controlled by their members, If they enter into agreements with other organizations, including goverments, or raise capital from external sources, they do so on terms that ensure democratic control by their members and maintain their cooperative autonomy.
											<<p>5<sup>th</sup>Principle: <u>Education, Training and Information:</u><br/>
												Cooperative societies provide education and training for their members, elected representatives, managers, and employees so that they can contribute effectively to the developments of their cooperative societies. They inform the general public particularly young people and opinion leaders-about the nature and benefits of cooperation.
											<p>6<sup>th</sup> Principle:<u> Cooperation among cooperative societies:</u><br/>
												Cooperative societies provide education and training for their members, elected representatives, managers, and employees so they can contribute effectively to the development of their cooperative societies. They inform the general public particularly young people and opinion leaders- about the nature and benefits of cooperation.
											<p>7<sup>th</sup> Principle: <u>Cooperation among cooperative societies:</u><br/>
												Cooperative societies serve their members most effectively and strenthen the cooperative movement by working together through local, national, regional and international structures.
											<p>8<sup>th</sup> Principle:<u> Professional Management:</u><br/>
												Cooperative societies are managed in a professional manner in running their affairs.
										</td>
									</tr>
									<tr>
										<td colspan="4" align="center"><u><b>Undertaking</b></u></td>
									</tr>
									<tr>
										<td colspan="4" align="center"> I/We hereby  declare and undertake to abide by the eight principles of cooperation in case of default at our end,we shall be liable for legal action as stipulated under relevant law.<br/><br/>
										<input id="agree" type="checkbox" class="" required> I agree	</td>
									</tr>
									<tr>
										<td class="text-center" colspan="4">
										<a href="<?php echo $table_name; ?>.php?tab=2"><button type="submit" class="btn btn-primary">Go Back & Edit</button></a>	
										<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>c" title="Save it" onclick="return confirm('Do you really want to save the form ?')">Submit</button>
									</td>
									</tr>
								</table>
								</form>
								</div>
								<div id="table4" class="tab-pane <?php echo $tabbtn4; ?>" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
								<table id="" class="table table-responsive">
									<tr>
										<td colspan="4" align="center"><u>SCHEDULE-B <br/>Matters to be incorporated in Bye-Laws</u></td>
									</tr>
									<tr>
										<td colspan="4">
											<ol type="1">
												<li>Name and address</li>
												<li>Area of operation</li>
												<li>Objectives and function</li>
												<li>Membership</li>
												<li>Authorized share capital</li>
												<li>Capital and Fund</li>
												<li>Annual General meeting</li>
												<li>Special general meeting</li>
												<li>Amendment</li>
												<li>Board of Directors</li>
												<li>Chief Executive officer</li>
												<li>Appointment of net profit</li>
												<li>Investment of fund</li>
												<li>Reserve fund</li>
												<li>Dividend</li>
												<li>Books and Accounts</li>
												<li>Audit</li>
												<li>Liability of Members in case of winding up</li>
											</ol>
										<td>
									</tr>
									<tr>
										<td class="text-center" colspan="4">
										<a href="<?php echo $table_name; ?>.php?tab=3"><button type="submit" class="btn btn-primary">Go Back & Edit</button></a>	
										<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>d" title="Save it" onclick="return confirm('Do you really want to save the form ?')">Submit</button>
									</td>
									</tr>
								</table>
								</form>
								</div>
								<div id="table5" class="tab-pane <?php echo $tabbtn5; ?>" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
								<table id="" class="table table-responsive">
									<tr>
										<td colspan="4" align="center"><u>Undertaking</u></td>
									</tr>
									<tr>
										<td colspan="4" align="center">We, the members of the proposed <input type="text" class="text-uppercase" disabled  value="<?php echo $unit_name; ?>" > do hereby agree to incorporate all the matters as stated in Schedule B (Guidelines) in our bye-laws under the provisions of the Assam Cooperative Societies Act, 2007 and rules framed thereunder. We understand and agree, that any omission or misstatement in the same, shall attract legal action as stipulated under the relevant law.<br/><br/>
										<input id="agree" type="checkbox" class="" required> I agree</td>
									</tr>
									<tr>									    
									    <td colspan="4" align="right">  <label><?php echo  strtoupper($key_person)?></label><br/>Signature of the applicant</td>
									</tr>
									<tr>
										<td class="text-center" colspan="4">
										<a href="<?php echo $table_name; ?>.php?tab=4"><button type="submit" class="btn btn-primary">Go Back & Edit</button></a>	
										<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>e" title="Save it" onclick="return confirm('Do you really want to save the form ?')">Submit</button>
									</td>
									</tr>
								</table>
								</form>
								</div>
							</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	  <!-- /.content-wrapper -->
	 <div class="modal fade" tabindex="-1" role="dialog" id="myModal-photo">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Upload Photo</h4>
      </div>
      <div class="modal-body" style="height:500px;">
          <div class="col-md-12" >
                            <div class="upload-demo-wrap">
                                <div id="upload-demo"></div>
                            </div>
                        </div>
      </div>
      <div class="modal-footer">
           <a class="btn file-btn btn-danger">
                                    <span>Browse Photo</span>
                                    <input type="file" id="upload" value="Choose a file" accept="image/*">
           </a>       
          <a href="#!" class="btn btn-primary result">Submit</a>       
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
	  <!-- /.content-wrapper -->
	 <?php require_once "../../../views/users/requires/footer.php";  ?>
<?php require '../../requires/js.php' ?>
<script src="../js/croppie.min.js" type="text/javascript"></script>
<script>
	$('#resid').hide();
	$('input[name="premises"]').on('change', function(){
		if($(this).val() == 'O'){
			$('#resid').show();
		}else{
			$('#resid').hide();
		}
	});
	/* ------------------------------------------------------ */
	/*function getStatus2(){
		if(document.getElementById('agree').checked==true){
			window.location.href="<?php echo $goto; ?>";
			
		}else{
			alert("Please click on the checkbox ! I Agree");
			
		}
	}*/
	/* ------------------------------------------------------ */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
</script>
<script>
    window.onload = function(e){ 
		var img,width,height;
		$('.myphoto').click(function(){
			width=$(this).attr("data-width");
			height=$(this).attr("data-height");
			$('#upload-demo').empty();
			$('#myModal-photo').modal('show');
			img=$(this);
			$uploadCrop = $('#upload-demo').croppie({
				viewport: {
					width: width,
					height: height							
				},
				boundary: {
					width: 350,
					height:350
				}			
			});
		});
		$('.mysign').click(function(){
			width=$(this).attr("data-width");
			height=$(this).attr("data-height");
			$('#upload-demo').empty();
			$('#myModal-photo').modal('show');
			img=$(this);
			$uploadCrop = $('#upload-demo').croppie({
				viewport: {
					width: width,
					height: height								
				},
				boundary: {
					width: 400,
					height:400
				}			
			});
		});
		$('#myModal-photo').on('shown.bs.modal', function () {
		  
		});
        var $uploadCrop;
		function readFile(input) {
 			if (input.files && input.files[0]) {
	            var reader = new FileReader();
	            
	            reader.onload = function (e) {
			$('.upload-demo').addClass('ready');
	            	$uploadCrop.croppie('bind', {
	            		url: e.target.result
	            	}).then(function(){
	            		console.log('jQuery bind complete');
	            	});
	            	
	            }
	            
	            reader.readAsDataURL(input.files[0]);
	        }
	        else {
		        swal("Sorry - you're browser doesn't support the FileReader API");
		    }
		}
		
		$('#upload').on('change', function () { readFile(this); });
		$('.result').on('click', function (ev) {
			$uploadCrop.croppie('result', {
				type: 'canvas',
				size: 'viewport'
			}).then(function (resp) {
				$('#myModal-photo').modal('show');
				$('.cr-image').attr('src','');
				$("#upload").val('');
				img.parent().children('span').empty();
			    img.parent().children('span').append('<input type="hidden" name="'+img.attr('data-name')+'" value="'+resp+'"> <img src="'+resp+'"><br><br>');			
			});
		});
	}     
/* ---------------------Block all after submit operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>	
</script>