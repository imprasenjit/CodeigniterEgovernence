<?php  require_once "../../requires/login_session.php";
$dept="tcp";
$form="8";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
	
include "save_tcp_form.php";
	
$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1' and save_mode='D'");
	if($q->num_rows<1){	
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
		if($p->num_rows>0){
			$results=$p->fetch_array();
			$form_id=$results["form_id"];
			$supervision=$results["supervision"];$name=$results["name"];$edu_quali =$results["edu_quali"];$past_exp =$results["past_exp"];$father_name =$results["father_name"];$pan =$results["pan"];$dob=$results["dob"];$owner_age=$results["owner_age"];
			if(!empty($results["authority_addres"])){
				$authority_addres=json_decode($results["authority_addres"]);
				$authority_addres_a=$authority_addres->a;$authority_addres_b=$authority_addres->b;
			}else{				
				$authority_addres_a="";$authority_addres_b="";
			}
			if(!empty($results["pre_add"])){
				$pre_add=json_decode($results["pre_add"]);
				$pre_add_sn1=$pre_add->sn1;$pre_add_sn2=$pre_add->sn2;$pre_add_v=$pre_add->v;$pre_add_d=$pre_add->d;$pre_add_p=$pre_add->p;$pre_add_mno=$pre_add->mno;$pre_add_email=$pre_add->email;
			}else{				
				$pre_add_sn1="";$pre_add_sn2="";$pre_add_v="";$pre_add_d="";$pre_add_p="";$pre_add_mno="";$pre_add_email="";
			}
			if(!empty($results["fees"])){
				$fees=json_decode($results["fees"]);
				$fees_n=$fees->n;$fees_r=$fees->r;
			}else{				
				$fees_n="";$fees_r="";
			}
		}else{
			$form_id="";
			$supervision="";$name="";$edu_quali="";$past_exp="";$father_name="";$pan="";$dob="";$owner_age="";
			$authority_addres_a="";$authority_addres_b="";
			$pre_add_sn1="";$pre_add_sn2="";$pre_add_v="";$pre_add_d="";$pre_add_p="";$pre_add_mno="";$pre_add_email="";
			$fees_n="";$fees_r="";
		}
	}else{			
		$results=$q->fetch_array();
		$form_id=$results["form_id"];
		$supervision=$results["supervision"];$name=$results["name"];$edu_quali =$results["edu_quali"];$past_exp =$results["past_exp"];$father_name =$results["father_name"];$pan =$results["pan"];$dob=$results["dob"];$owner_age=$results["owner_age"];
		if(!empty($results["authority_addres"])){
			$authority_addres=json_decode($results["authority_addres"]);
			$authority_addres_a=$authority_addres->a;$authority_addres_b=$authority_addres->b;
		}else{				
			$authority_addres_a="";$authority_addres_b="";
		}
		if(!empty($results["pre_add"])){
			$pre_add=json_decode($results["pre_add"]);
			$pre_add_sn1=$pre_add->sn1;$pre_add_sn2=$pre_add->sn2;$pre_add_v=$pre_add->v;$pre_add_d=$pre_add->d;$pre_add_p=$pre_add->p;$pre_add_mno=$pre_add->mno;$pre_add_email=$pre_add->email;
		}else{				
			$pre_add_sn1="";$pre_add_sn2="";$pre_add_v="";$pre_add_d="";$pre_add_p="";$pre_add_mno="";$pre_add_email="";
		}
		if(!empty($results["fees"])){
			$fees=json_decode($results["fees"]);
			$fees_n=$fees->n;$fees_r=$fees->r;
		}else{				
			$fees_n="";$fees_r="";
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
								<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form);?></strong>
							</h4>	
						</div>
						<div class="panel-body">
							<div id="table1" class="tab-pane" role="tabpanel">
								<form name="myform1" class="submit1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table class="table table-responsive">
										<tr>
											<td colspan="4" class="form-inline">
												To <br/>
												&nbsp;&nbsp;&nbsp;The Chairman,</br>
												&nbsp;&nbsp;&nbsp;<input type="text"  class="form-control text-uppercase" name="authority_addres[a]" value="<?php echo $authority_addres_a;?>"></br></br>
												&nbsp;&nbsp;&nbsp;<input type="text"  class="form-control text-uppercase" name="authority_addres[b]" value="<?php echo $authority_addres_b;?>"> 
											</td>
										</tr>
										<tr>
											<td colspan="4" class="form-inline">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I hereby apply for enrollment of my name as competent Technical personnel to do the various works of schemes for Building Permitand supervision in the
											<input type="text"  class="form-control text-uppercase" name="supervision" value="<?php echo $supervision;?>"><br/><br/>
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I do hereby also declare that I shall follow and shall abide by all the Rules and Regulations now in force and that may be framed from time.</td>
										</tr>
										<tr>
											<td colspan="4">My personal bio-data are as follows-</td>
										</tr>
										<tr>
											<td width="25%"> Name :</td>
											<td><input type="text"  class="form-control text-uppercase" validate="letters" name="name" value="<?php echo $name;?>"></td>
											<td width="25%">Qualification:<br/>(Certificate to be enclosed)</td>
											<td><input type="text"  class="form-control text-uppercase" name="edu_quali" validate="email"value="<?php echo $edu_quali;?>"></td>
										</tr>
										<tr>
											<td>Past experience : </td>
											<td><input type="text"  class="form-control text-uppercase" name="past_exp" value="<?php echo $past_exp;?>"></td>
											<td>Father's Name :</td>
											<td><input type="text"  class="form-control text-uppercase" name="father_name" validate="letters"  value="<?php echo $father_name;?>"></td>
										</tr>
										<tr>
											<td>Pan No. :</td>
											<td><input  type="text"  class="form-control text-uppercase" name="pan" maxlength="10" value="<?php echo $pan;?>"></td>
										</tr>
										<tr>
											<td>Date of Birth<span class="mandatory_field">*</span></td>
											<td><input type="date" name="dob" value="<?php echo $dob; ?>" id="dob" class="form-control text-uppercase" onchange="date_of_birth(this.id)" placeholder="DD/MM/YYYY" required="required" ></td>
											<td>Age</td>
											<td><input validate="onlyNumbers" type="number" readonly="readonly" id="owner_age" value="<?php echo $owner_age; ?>" name="owner_age" class="form-control text-uppercase"></td>
										</tr>
										<tr>
											<td colspan="4">Present Address:</td>
										</tr>
										<tr>
											<td>Street Name 1</td>
											<td><input type="text"  class="form-control text-uppercase" name="pre_add[sn1]" value="<?php echo $pre_add_sn1;?>"></td>
											<td>Street Name 2</td>
											<td><input type="text" name="pre_add[sn2]" class="form-control text-uppercase" value="<?php echo $pre_add_sn2;?>"></td>
										</tr>
										<tr>
											<td>Village/Town</td>
											<td><input type="text"  class="form-control text-uppercase" name="pre_add[v]" value="<?php echo $pre_add_v;?>"></td>
											<td>District<span class="mandatory_field">*</span></td>
                                            <td><input type="text"  class="form-control text-uppercase" name="pre_add[d]" id="d" value="<?php echo $pre_add_d;?>"></td>
											
										</tr>
										<tr>
											<td>Pincode</td>
											<td><input validate="pincode" type="text"  class="form-control text-uppercase" name="pre_add[p]" maxlength="6" value="<?php echo $pre_add_p;?>"></td>
											<td>Mobile no.</td>
											<td><input validate="mobileNumber" type="text" name="pre_add[mno]" class="form-control text-uppercase" maxlength="10" value="<?php echo $pre_add_mno;?>" ></td>
										</tr>
										<tr>
											<td>Email ID :</td>
											<td><input  type="email"  class="form-control" name="pre_add[email]" validate="email" value="<?php echo $pre_add_email;?>"></td>
											
										</tr>
										<tr>
											<td colspan="4"> Permanent address:</td>
										</tr>
										<tr>
											<td width="25%">Street Name 1</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $street_name1; ?>"></td>
											<td width="25%">Street Name 2</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $street_name2; ?>"></td>
										</tr>
										<tr>
											<td>Village/Town</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $vill; ?>"></td>
											<td>District</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $dist; ?>"></td>
										</tr>
										<tr>
											<td>Pincode</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $pincode; ?>"></td>
											<td>Mobile No.</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $mobile_no; ?>"></td>
										</tr>
										<tr>
											<td>Email ID :</td>
											<td><input type="email" class="form-control" disabled="disabled" value="<?php echo $email; ?>"></td>
											
										</tr>
										<tr>
											<td colspan="4" class="form-inline">
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I deposit herewith annual enrolment fees of Rs. <input type="text" class="form-control text-uppercase" name="fees[n]" validate="onlyNumbers" value="<?php echo $fees_n; ?>">(Rupees)<input type="text" class="form-control text-uppercase" name="fees[r]" value="<?php echo $fees_r; ?>" style="width:300px"> only in cash as required.
											</td>
										</tr>
										<tr>
											<td>Date : <strong><?=date('d-m-Y',strtotime($today));?></strong></td>
											<td></td>
											<td></td>
											<td align="right">Signature Of the Applicant : <strong><?php echo strtoupper($key_person);?></strong></td>
										</tr>
										<tr>
											<td class="text-center" colspan="4">				
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form;?>" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you want to save..?')" >Save and Next</button>
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
	function date_of_birth(obj){
		var str2=$('#'+obj).val();
		var str3 = str2.replace('-','');
		var str = str3.replace('-','');
		var day=Number(str.substr(0,2));		
		var month=Number(str.substr(2,2))-1;
		var year=Number(str.substr(4,4));
		var today=new Date();
		var age=today.getFullYear()-year;
		
		if((today.getMonth()< month) || (today.getMonth()==month && today.getDate()<day)) {
			age--;
		}
		if(age<18) {
			alert('Your age must be greater than 18 to fill up this form');
			$('#owner_age').val('');
			$('.dob').val('');
		}
		else {
			$('#owner_age').val(age);
		}	
	}
	
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
	/* ------------------------------------------------------ */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	/* ---------------------Block all after submit operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>
