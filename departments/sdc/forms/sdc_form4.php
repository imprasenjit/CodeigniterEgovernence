<?php  require_once "../../requires/login_session.php";
$dept="sdc";
$form="4";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);
include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
	
include "save_form.php";
		
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
	if($q->num_rows<1){	
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
		if($p->num_rows>0){
			$results=$p->fetch_array();
			$form_id=$results["form_id"];$auth_person=$results["auth_person"];$category=$results["category"];$particulars=$results["particulars"];
			if(!empty($results["supervision"])){
				$supervision=json_decode($results["supervision"]);
				$supervision_n1=$supervision->n1;$supervision_n2=$supervision->n2;
				$supervision_q1=$supervision->q1;$supervision_q2=$supervision->q2;
			}else{				
				$supervision_n1="";$supervision_n2="";$supervision_q1="";$supervision_q2="";
			}
		}else{
			$form_id="";$auth_person="";$category="";$particulars="";
			$supervision_n1="";$supervision_n2="";$supervision_q1="";$supervision_q2="";
		}
	}else{			
		$results=$q->fetch_array();
		$form_id=$results["form_id"];$auth_person=$results["auth_person"];$category=$results["category"];$particulars=$results["particulars"];
		if(!empty($results["supervision"])){
			$supervision=json_decode($results["supervision"]);
			$supervision_n1=$supervision->n1;$supervision_n2=$supervision->n2;
			$supervision_q1=$supervision->q1;$supervision_q2=$supervision->q2;
		}else{				
			$supervision_n1="";$supervision_n2="";$supervision_q1="";$supervision_q2="";
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
									<?php echo $form_name=$formFunctions->get_formName($dept,$form);?>
								</h4>	
							</div>
							<div class="panel-body">
								<div id="table1" class="tab-pane" role="tabpanel">
									<form name="myform1" class="submit1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
										<table class="table table-responsive">
											<tr class="form-inline">
												<td colspan="4">1.I/We &nbsp;<input type="text"  class="form-control text-uppercase" name="auth_person" required="required" value="<?php if($auth_person!="") { echo $auth_person; }else{ echo $key_person;}?>" validate="letters">&nbsp;of &nbsp;<input type="text"  disabled class="form-control text-uppercase"  value="<?php echo $unit_name;?>"> &nbsp;hereby apply for a licence to sell by wholesale/retail drugs specified in Schedule X to the Drugs and Cosmetics Rules, 1945. We operate a pharmacy on the premises, situated&nbsp;<input type="text"  class="form-control text-uppercase" disabled value="<?php echo $b_dist;?>">.</td>
											</tr>
											<tr>
												<td colspan="4">2. The sale and  dispensing of drugs will be made under the personal supervision of the qualified persons namely :-</td>
											</tr>
											<tr>
												<td width="25%">Name :</td>
												<td width="25%"><input type="text" class="form-control text-uppercase" name="supervision[n1]" value="<?php echo  $supervision_n1; ?>" validate="letters"	></td>
												<td width="25%">Qualification :</td>
												<td width="25%"><input type="text" class="form-control text-uppercase"name="supervision[q1]" value="<?php echo  $supervision_q1; ?>"></td>
											</tr>
											<tr>
												<td>Name :</td>
												<td><input type="text" class="form-control text-uppercase" name="supervision[n2]" value="<?php echo  $supervision_n2; ?>" validate="letters"></td>
												<td>Qualification :</td>
												<td><input type="text" class="form-control text-uppercase" name="supervision[q2]" value="<?php echo  $supervision_q2; ?>"></td>
											</tr>
											<tr>
												<td>3. Name of drugs to be sold. :</td>
												<td><textarea name="category" class="form-control text-uppercase"><?php echo  $category; ?></textarea></td>
												<td>4. Particulars for special storage accomodation.:</td>
												<td><textarea name="particulars" class="form-control text-uppercase"><?php echo  $particulars; ?></textarea></td>
											</tr>
											<tr>
												<td>Date :</td>
												<td><label ><?php echo $today;?></label></td>
												<td>Signature :</td>
												<td><label><?php echo strtoupper($key_person)?></label></td>
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