<?php  require_once "../../requires/login_session.php";
$dept="mines";
$form="9";
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
			$form_id=$results["form_id"];$indenture_dt=$results["indenture_dt"];$acting_through=$results["acting_through"];$bid_rs=$results["bid_rs"];$words_rupees=$results["words_rupees"];$auction_dt=$results["auction_dt"];$mining_contract=$results["mining_contract"];$words_mining=$results["words_mining"];
			$officer_rs=$results["officer_rs"];$officer_rupees=$results["officer_rupees"];$security_name=$results["security_name"];$shri=$results["shri"];
			$resident=$results["resident"];$re_district=$results["re_district"];$veins_seam=$results["veins_seam"];
			$village_situated=$results["village_situated"];$sub_division=$results["sub_division"];$land_district=$results["land_district"];$dag_no=$results["dag_no"];$patta_no=$results["patta_no"];$north=$results["north"];$south=$results["south"];$east=$results["east"];$west=$results["west"];$premises_dt=$results["premises_dt"];$for_term=$results["for_term"];
			$rs_occupied=$results["rs_occupied"];$rent_rupees=$results["rent_rupees"];$contra_sig=$results["contra_sig"];
			$governor_assm=$results["governor_assm"];$surety_sig=$results["surety_sig"];
			
		}else{
			$form_id="";$indenture_dt="";$acting_through=""; $bid_rs="";$words_rupees="";
			$auction_dt=""; $mining_contract=""; $words_mining="";$officer_rs=""; $officer_rupees="";$security_name="";
			$shri=""; $resident="";
			$re_district="";$veins_seam="";$village_situated="";$sub_division="";
			$land_district="";$dag_no="";
			$patta_no="";$north="";
			$south="";$east="";$west="";$premises_dt="";$for_term="";$rs_occupied="";$rent_rupees="";$contra_sig="";$governor_assm="";$surety_sig="";
		}
	}else{
            $results=$q->fetch_array();			
			$form_id=$results["form_id"];$indenture_dt=$results["indenture_dt"];$acting_through=$results["acting_through"];$bid_rs=$results["bid_rs"];$words_rupees=$results["words_rupees"];$auction_dt=$results["auction_dt"];$mining_contract=$results["mining_contract"];$words_mining=$results["words_mining"];
			$officer_rs=$results["officer_rs"];$officer_rupees=$results["officer_rupees"];$security_name=$results["security_name"];$shri=$results["shri"];
			$resident=$results["resident"];$re_district=$results["re_district"];$veins_seam=$results["veins_seam"];
			$village_situated=$results["village_situated"];$sub_division=$results["sub_division"];$land_district=$results["land_district"];$dag_no=$results["dag_no"];$patta_no=$results["patta_no"];$north=$results["north"];$south=$results["south"];$east=$results["east"];$west=$results["west"];$premises_dt=$results["premises_dt"];$for_term=$results["for_term"];
			$rs_occupied=$results["rs_occupied"];$rent_rupees=$results["rent_rupees"];$contra_sig=$results["contra_sig"];
			$governor_assm=$results["governor_assm"];$surety_sig=$results["surety_sig"];
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
								<ul class="nav nav-pills">
						        <li class="<?php echo $tabbtn1; ?>"><a  href="javascript:void(0)">Part 1</a></li>
								  <li class="<?php echo $tabbtn2; ?>"><a  href="javascript:void(0)">Part 2</a></li>
								</ul>
								<br>
								<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table id="" class="table table-responsive">
										<tr class="form-inline">
											<td colspan="4">This indenture made on this day&nbsp;<input type="text" name="indenture_dt" class="dob form-control text-uppercase" value="<?php echo $indenture_dt; ?>">&nbsp;&nbsp;between the Governor of Assam acting through<input type="text" name="acting_through" class="form-control text-uppercase" value="<?php echo $acting_through; ?>">(hereinafter referred to as the “State Government” which expression shall where the context so admits, include the successors and assigns) of the one part and</td>
										</tr>
										<tr>
											<td colspan="4"><?php echo $owner_type_name; ?></td>
										</tr>
										<tr>
											<td colspan="4">Enterprise Name and Address :</td>
										</tr>
										<tr>
											<td width="25%">Enterprise Name :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo  $unit_name; ?>" ></td>
										</tr>
										<tr>
											<td width="25%">Street Name1 :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo  $b_street_name1; ?>"	></td>
											<td width="25%">Street Name2 :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo  $b_street_name2; ?>"></td>
										</tr>
										<tr>
											<td>Village/Town :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo  $b_vill; ?>"></td>
											<td>District :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo  $b_dist; ?>"></td>
										</tr>
										<tr>
											<td>Pin Code :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo  $b_pincode; ?>"></td>
											<td>Mobile No :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_mobile_no; ?>"></td>
										</tr>
										<tr>
										<td colspan="4">
											<table  class="table table-responsive">
											<thead>
												<tr>
											<th width="5%">Sl. No.</th>
											<th width="25%">Partners/Directors Name</th>
											<th width="20%">Street Name 1</th>
											<th width="15%">Street Name 2</th>
											<th width="15%">Village/Town</th>
											<th width="10%">District</th>
											<th width="10%">Pincode</th>
													
												</tr>
											</thead>	
											<?php 
											$member_results=$formFunctions->executeQuery($dept,"select * from ".$table_name."_members where form_id='$form_id'") or die("Error : ".$mines->error);
											if($member_results->num_rows==0){
												for($i=1;$i<=count($owners);$i++){ ?>
												<tr>
													<td><?php echo $i; ?></td>
													<td><input type="text" name="name<?php echo $i;?>" readonly="readonly" class="form-control text-uppercase" value="<?php echo $owners[$i-1]; ?>" /></td>
													<td><input type="text" name="sn1<?php echo $i;?>" class="form-control text-uppercase" value="" /></td>
													<td><input type="text" name="sn2<?php echo $i;?>" class="form-control text-uppercase" value="" /></td>
													<td><input type="text" name="vill<?php echo $i;?>" class="form-control text-uppercase" value="" /></td>
													<td><input type="text" name="dist<?php echo $i;?>" class="form-control text-uppercase" value="" /></td>
													<td><input type="text" name="pin<?php echo $i;?>" class="form-control text-uppercase" value="" maxlength="6" validate="pincode" ></td>

												</tr>
												<?php } ?>
												<input type="hidden" name="hidden_value" value="<?php echo count($owners); ?>"/>
											<?php }else{
													$i=1;
											while($rows=$member_results->fetch_object()){ ?>
												<tr>
													<td><?php echo $i; ?></td>
													<td><input type="text" name="name<?php echo $i;?>" readonly="readonly" class="form-control text-uppercase" value="<?php echo $owners[$i-1]; ?>" /></td>
													<td><input type="text" name="sn1<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->sn1; ?>" /></td>
													<td><input type="text" name="sn2<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->sn2; ?>" /></td>
													<td><input type="text" name="vill<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->vill; ?>" /></td>
													<td><input type="text" name="dist<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->dist; ?>" /></td>
													<td><input type="text" name="pin<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->pin; ?>" maxlength="6" validate="pincode" ></td>
													
												</tr>
											<?php $i++;
											} ?>
												<input type="hidden" name="hidden_value" value="<?php echo $member_results->num_rows; ?>"/>
											<?php } ?>									
											
											</table>
											</td>
										</tr>
										<tr class="form-inline">
											<td colspan="4">Whereas the Contractor has offered the highest bid of Rs&nbsp;<input type="text" name="bid_rs" class="form-control text-uppercase" value="<?php echo $bid_rs; ?>">&nbsp;&nbsp;(in words Rupees<input type="text" name="words_rupees" class="form-control text-uppercase" value="<?php echo $words_rupees; ?>"> )in the bid/auction held on <input type="text" name="auction_dt" class="dob form-control text-uppercase" value="<?php echo $auction_dt; ?>">for obtaining a mining contract for<input type="text" name="mining_contract" class="form-control text-uppercase" value="<?php echo $mining_contract; ?>">cu.m(in words <input type="text" name="words_mining" class="form-control text-uppercase" value="<?php echo $words_mining; ?>">)cubic metres(name of minor minerals) in respect of lands hereinafter described in clause 2 and such bid had been accepted by the officer authorized in this behalf and the Contractor has deposited with the Government,a sum of Rs <input type="text" name="officer_rs" class="form-control text-uppercase" value="<?php echo $officer_rs; ?>">(Rupees <input type="text" name="officer_rupees" class="form-control text-uppercase" value="<?php echo $officer_rupees; ?>">)as initial bid security (10% of the annual bid amount) and Shri<input type="text" name="security_name" class="form-control text-uppercase" value="<?php echo $security_name; ?>">S/o Shri<input type="text" name="shri" class="form-control text-uppercase" value="<?php echo $shri; ?>">resident of <input type="text" name="resident" class="form-control text-uppercase" value="<?php echo $resident; ?>">District <input type="text" name="re_district" class="form-control text-uppercase" value="<?php echo $re_district; ?>">(referred to as the ‘surety’which expression shall where the context so admits, include his heirs, executors, administrators,representatives) has been offered as solvent surety for the aforesaid amount, and whereas the contractor is in possession of an Income Tax Clearance Certificate.  </td>
										</tr>
																					
										<tr>										
												<td class="text-center" colspan="4">
													<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>a" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
												</td>									
											</tr>
									</table>
									</form> 
								</div>
								<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table id="" class="table table-responsive">
									    <tr>
									       <td colspan="4">Now, therefore, this deed witnesses and the parties hereby agree as follows:-</td>
									    </tr>
										<tr>
									       <td colspan="4"><b>Liberties and privileges to be exercised and enjoyed by the Contractor:-</b></td>
									    </tr>
										<tr>
									       <td colspan="4">The following liberties, powers and privileges may be exercised and enjoyed by the contractor subject to the other provisions of contract :-</td>
									    </tr>
										<tr class="form-inline">
											<td colspan="4">(1) In consideration of the contract money , covenants and agreements hereinafter contained and on the part of Contractor to be paid, observed and performed the Government hereby grants and demises in to contractor all those mines/beds/veins/seams of&nbsp;<input type="text" name="veins_seam" class="form-control text-uppercase" value="<?php echo $veins_seam; ?>">(hereinafter referred to as the said minor minerals), situated , lying and being in or under the lands which are referred to in clause (b) together with the liberties , powers and privileges to be executed or enjoyed in connection herewith which are hereinafter mentioned in Part-I subject to the restrictions and conditions as to exercise and enjoyment of such liberties, and privileges which are hereinafter mentioned in Part II and subject to other provisions of this contract.</td>
										</tr>
										<tr class="form-inline">
											<td colspan="4">(2)All the tract of the land situated at village&nbsp;<input type="text" name="village_situated" class="form-control text-uppercase" value="<?php echo $village_situated; ?>">in Sub-Division<input type="text" name="sub_division" class="form-control text-uppercase" value="<?php echo $sub_division; ?>">District<input type="text" name="land_district" class="form-control text-uppercase" value="<?php echo $land_district; ?>">bearing Dag and Patta Nos.<input type="text" name="dag_no" class=" form-control text-uppercase" value="<?php echo $dag_no; ?>">&nbsp;&nbsp;&nbsp;  Containing an area of<input type="text" name="patta_no" class="form-control text-uppercase" value="<?php echo $patta_no; ?>">or thereabouts delineated on the plan hereto annexed and bounded as follows:</td>
										</tr>
										<tr>
										   <td>On the North by</td>
										   <td><input type="text" name="north" class=" form-control text-uppercase" value="<?php echo $north; ?>"></td>
										   <td>On the South by</td>
										   <td><input type="text" name="south" class=" form-control text-uppercase" value="<?php echo $south; ?>"></td>
										</tr>
										<tr>
										   <td>On the East by</td>
										   <td><input type="text" name="east" class=" form-control text-uppercase" value="<?php echo $east; ?>"></td>
										   <td>On the West by</td>
										   <td><input type="text" name="west" class=" form-control text-uppercase" value="<?php echo $west; ?>"></td>
										</tr>
										<tr class="form-inline">
											<td colspan="4">(3)The Contractor shall hold the premises hereby granted and demised from the day&nbsp;<input type="text" name="premises_dt" class="dob form-control text-uppercase" value="<?php echo $premises_dt; ?>">for the term of<input type="text" name="for_term" class="form-control text-uppercase" value="<?php echo $for_term; ?>">years thence next ensuing.</td>
										</tr>
										<tr class="form-inline">
						                  <td td colspan="4"><b>Surface Rent:</b></br>The Contractor shall pay for the surface area occupied by him, surface rent at the rate of Rs<input type="text" name="rs_occupied" class="form-control text-uppercase" value="<?php echo $rs_occupied; ?>">(Rupees<input type="text" name="rent_rupees" class=" form-control text-uppercase" value="<?php echo $rent_rupees; ?>">) Per annum.</td>
						             </tr>
										<tr>
											<td width="25%">Date :</td>
											<td width="25%"><label ><?php echo $today;?></label></td>
											<td width="25%">Signature of the Contractor:</td>
											<td><input type="text" name="contra_sig" class=" form-control text-uppercase" value="<?php echo $contra_sig; ?>"></td>
										</tr>
										<tr>
											<td width="25%">For and on behalf of the Governor of Assam</td>
											<td><input type="text" name="governor_assm" class=" form-control text-uppercase" value="<?php echo $governor_assm; ?>"></td>
											<td width="25%">Signature of Surety</td>
											<td><input type="text" name="surety_sig" class=" form-control text-uppercase" value="<?php echo $surety_sig; ?>"></td>
										</tr>
											  
										<tr>
												<td class="text-center" colspan="4">
													<a href="<?php echo $table_name; ?>.php?tab=1"><button type="submit" class="btn btn-primary">Go Back & Edit</button></a>	
													<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>b" title="Save it" onclick="return confirm('Do you really want to save the form ?')">Save & Next</button>
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
	$('#offlinePayDetials').hide();
	$(document).ready(function(){
		$('input[name="payment_mode"]').on('change', function(){
			if($(this).val() == 0){						
				$('#offlinePayDetials').show("fast");						
			}else{
				$('#offlinePayDetials').hide("slow");
			}	
			
		});
	});
	/* ---------------------Block all after submit operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>

</script>