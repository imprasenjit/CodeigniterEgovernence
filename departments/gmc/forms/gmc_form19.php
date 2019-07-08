<?php  require_once "../../requires/login_session.php";
$dept="gmc";
$form="19";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);	
include "save_form_new.php";
	
	if(strtoupper($b_dist)!="KAMRUP METROPOLITAN"){ 
		echo "<script>
				alert('Since your business is not situated in Kamrup Metropolitan so you are not allowed to fill up the application form under Guwahati Municipal Corporation.');
				window.location.href = '".$server_url."user_area/';
		</script>";	
	}
	
	

	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
	if($q->num_rows<1){	 
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
		if($p->num_rows>0){
			$results=$p->fetch_assoc();
			
			$form_id=$results["form_id"];$house_number=$results["house_number"];$situ_road=$results["situ_road"];$of=$results["of"];$area_ward=$results["area_ward"];$dag_no=$results["dag_no"];$patta_no=$results["patta_no"];$rev_village=$results["rev_village"];$mouza=$results["mouza"];$signed=$results["signed"];$regis_no=$results["regis_no"];$no_floors=$results["no_floors"];

		  if(!empty($results["provision"])){
				$provision=json_decode($results["provision"]);
				if(isset($provision->a)) $provision_a=$provision->a; else $provision_a="";
				if(isset($provision->b)) $provision_b=$provision->b; else $provision_b="";
				
			}else{
				$provision_a="";$provision_b="";
			}
		if(!empty($results["total"])){
			$total=json_decode($results["total"]);
			$total_plot=$total->plot;$total_north=$total->north;$total_south=$total->south;$total_east=$total->east;$total_west=$total->west;
		}else{
			$total_plot="";$total_north="";$total_south="";$total_east="";$total_west="";
		}
		
		if(!empty($results["appli"])){
			$appli=json_decode($results["appli"]);
			$appli_nm=$appli->nm;$appli_father=$appli->father;$appli_mother=$appli->mother;$appli_address=$appli->address;$appli_mob=$appli->mob;$appli_mob=$appli->mob;$appli_pan=$appli->pan;$appli_sign=$appli->sign;
		}else{
			$appli_nm="";$appli_father="";$appli_mother="";$appli_address="";$appli_mob="";$appli_pan="";$appli_sign="";
		}
		
			
	 }else{
			$form_id="";$house_number="";$situ_road="";$of="";$area_ward="";$dag_no="";
			$patta_no="";$rev_village="";$mouza="";$signed="";
			$regis_no="";$no_floors="";
			
			$total_plot="";$total_north="";$total_south="";$total_east="";$total_west="";$provision_a="";$provision_b="";
			$appli_nm="";$appli_father="";$appli_mother="";$appli_address="";$appli_mob="";$appli_pan="";$appli_sign="";
		}
  }else{	
		$results=$q->fetch_array();		
		$form_id=$results["form_id"];$house_number=$results["house_number"];$situ_road=$results["situ_road"];$of=$results["of"];$area_ward=$results["area_ward"];$dag_no=$results["dag_no"];$patta_no=$results["patta_no"];$rev_village=$results["rev_village"];$mouza=$results["mouza"];$signed=$results["signed"];$regis_no=$results["regis_no"];$no_floors=$results["no_floors"];

		  if(!empty($results["provision"])){
				$provision=json_decode($results["provision"]);
				if(isset($provision->a)) $provision_a=$provision->a; else $provision_a="";
				if(isset($provision->b)) $provision_b=$provision->b; else $provision_b="";
			}else{
				$provision_a="";$provision_b="";
				 
			}
		
			if(!empty($results["total"])){
				$total=json_decode($results["total"]);
				$total_plot=$total->plot;$total_north=$total->north;$total_south=$total->south;$total_east=$total->east;$total_west=$total->west;
			}else{
				$total_plot="";$total_north="";$total_south="";$total_east="";$total_west="";
			}
			
			if(!empty($results["appli"])){
				$appli=json_decode($results["appli"]);
				$appli_nm=$appli->nm;$appli_father=$appli->father;$appli_mother=$appli->mother;$appli_address=$appli->address;$appli_mob=$appli->mob;$appli_mob=$appli->mob;$appli_pan=$appli->pan;$appli_sign=$appli->sign;
			}else{
				$appli_nm="";$appli_father="";$appli_mother="";$appli_address="";$appli_mob="";$appli_pan="";$appli_sign="";
			}
	}
	##PHP TAB management
	$showtab = isset($_GET['tab']) ? $_GET['tab'] : "";

	$tabbtn1 = "";
	$tabbtn2 = "";
	if ($showtab == "" || $showtab < 2 || $showtab > 5 || is_numeric($showtab) == false) {
		$tabbtn1 = "active";
		$tabbtn2 = "";
	}
	if ($showtab == 2) {
		$tabbtn1 = "";
		$tabbtn2 = "active";
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
								<h4 class="text-center text-bold" >
									<?php echo $form_name=$formFunctions->get_formName($dept,$form);?>
								</h4>	
							</div>
							<div class="panel-body">
								
								<br>
								<div class="tab-content">
								<div  role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
								<table id="" class="table table-responsive">
									<tr>
										<td colspan="4">To,<br/>
										The Commissioner,<br/>Guwahati Municipal Corporation,<br/>Panbazar, Guwahati.</td>
									</tr>
									<tr class="form-inline">
										<td colspan="4">Sir,<br/>I/We hereby give notice that I intend to erect/re-erect or to make alteration in the House No&nbsp;&nbsp;<input type="text" class="form-control text-uppercase" value="<?php echo $house_number; ?>" name="house_number" >&nbsp;&nbsp;situated at Road &nbsp;&nbsp;<input type="text" class="form-control text-uppercase" value="<?php echo $situ_road; ?>" name="situ_road" >&nbsp;&nbsp;of &nbsp;&nbsp;<input type="text" class="form-control text-uppercase" value="<?php echo $of; ?>" name="of" >&nbsp;&nbsp; area of Ward No&nbsp;&nbsp;<input type="text" value="<?php echo $area_ward; ?>" name="area_ward" >&nbsp;&nbsp;in Dag No&nbsp;&nbsp;<input type="text" class="form-control text-uppercase" value="<?php echo $dag_no; ?>" name="dag_no" >Patta No&nbsp;&nbsp;<input type="text" class="form-control text-uppercase" value="<?php echo $patta_no; ?>" name="patta_no" >of Revenue Village&nbsp;&nbsp;<input type="text" class="form-control text-uppercase" value="<?php echo $rev_village; ?>" name="rev_village" >Mouza&nbsp;&nbsp;<input type="text" class="form-control text-uppercase" value="<?php echo $mouza; ?>" name="mouza" >and in accordance with the Building Byelaws of Guwahati and I forward herewith, the following plans and specifications duly signed by me and &nbsp;&nbsp;<input type="text" class="form-control text-uppercase" value="<?php echo $signed; ?>" name="signed" >&nbsp;&nbsp;(Name in block letters)of the Registered Technical Personal, Registration No.&nbsp;&nbsp;<input type="text" class="form-control text-uppercase" value="<?php echo $regis_no; ?>" name="regis_no" >who have prepared the plans, statements/documents.<td>
									</tr>
										
								 <tr>
									<td colspan="4">The schedule of the land is also given below :</td>
								 </tr>
								<tr>
									<td>(a) Total plot area :</td>
									<td><input type="text" class="form-control text-uppercase"  name="total[plot]" value="<?php echo $total_plot; ?>"></td>
								</tr>
								<tr>
									<td colspan="4">(b) Name of owners of adjoining land :</td>
								</tr>
								<tr>
									<td>North :</td>
									<td><input type="text" class="form-control text-uppercase" name="total[north]" value="<?php echo $total_north; ?>"></td>
									<td>South :</td>
									<td><input type="text" class="form-control text-uppercase"  name="total[south]" value="<?php echo $total_south; ?>"></td>
								</tr>
								<tr>
									<td>East :</td>
									<td><input type="text" class="form-control text-uppercase"  name="total[east]" value="<?php echo $total_east; ?>"></td>
									<td>West :</td>
									<td><input type="text" class="form-control text-uppercase"  name="total[west]" value="<?php echo $total_west; ?>"></td>
								</tr>
								<tr>
									<td>(c) Is there any future provision for</td>
								
								       <td colspan="3">
												<label class="checkbox-inline"><input type="checkbox" <?php if($provision_a=="V") echo "checked"; ?> name="provision[a]" value="V">Vertical extension&nbsp;&nbsp; </label></br>
												<label class="checkbox-inline"><input type="checkbox" <?php if($provision_b=="H") echo "checked"; ?> name="provision[b]" value="H">Horizontal extension&nbsp;&nbsp; </label>
										</td>
								</tr>
								<tr>
									<td>(iii) If yes No. of floors</td>
									<td><input type="text" class="form-control text-uppercase"  name="no_floors" value="<?php echo $no_floors; ?>"></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td>Name of the Applicant (in block letters):</td>
									<td width="25%"><input type="text" class="form-control text-uppercase" validate="letters" name="appli[nm]" value="<?php echo  $appli_nm; ?>"></td>
								</tr>
								<tr>
									<td>Father/Husband Name :</td>
									<td><input type="text" class="form-control text-uppercase" validate="letters" name="appli[father]" value="<?php echo $appli_father; ?>"></td>
									<td>Mother Name :</td>
									<td><input type="text" class="form-control text-uppercase" validate="letters" name="appli[mother]" value="<?php echo $appli_mother; ?>"></td>
								</tr>
								<tr>
									<td>Postal Address of Applicant :</td>
									<td width="25%"><textarea class="form-control text-uppercase"  name="appli[address]"><?php echo $appli_address; ?></textarea></td>
									<td>Phone No / Mobile No :</td>
									<td><input type="text" class="form-control text-uppercase"  validate="onlyNumbers" maxlength="10" name="appli[mob]" value="<?php echo $appli_mob; ?>"></td>
								</tr>
								<tr>
									<td>PAN No. :</td>
									<td><input type="text" class="form-control text-uppercase"  name="appli[pan]" value="<?php echo $appli_pan; ?>"></td>
								</tr>
								<tr>
									<td colspan="4">I request that the construction may be approved and permission accorded to me to execute the work. I hereby also declare that contents of the above application and the enclosures are true and correct to my/our knowledge. No part of it is false and nothing has been concealed there from.</td>
								</tr>
								<tr>
								       <td>Signature of the Applicant</td>
										<td><input type="text" name="appli[sign]"  value="<?php echo $appli_sign; ?>" class="form-control text-uppercase"></td>
										<td colspan="2" align="right">Date :<?php echo date('d-m-Y',strtotime($today)); ?></td>
								</tr>
								
								<tr>										
										    <td class="text-center" colspan="4">
												<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
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
	  <?php require_once "../../../views/users/requires/footer.php";  ?>
<?php require '../../requires/js.php' ?>
<script>
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
	
	$('input[name="is_adjoining"]').on('change', function(){
		if($(this).val() == 'N')
			$('#details_adjoining').attr('disabled', 'disabled');
		else
			$('#details_adjoining').removeAttr('disabled');
	});
	$('input[name="is_felling"]').on('change', function(){
		if($(this).val() == 'N')
			$('#details_felling').attr('disabled', 'disabled');
		else
			$('#details_felling').removeAttr('disabled');
	});
	$('input[name="is_erection"]').on('change', function(){
		if($(this).val() == 'N')
			$('#details_erection').attr('disabled', 'disabled');
		else
			$('#details_erection').removeAttr('disabled');
	});
</script>