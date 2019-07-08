<?php  require_once "../../requires/login_session.php";
$dept="pcb";
$form="17";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);	
include "save_ew_form.php";

$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
if($q->num_rows<1){	 
	$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
	if($p->num_rows>0){
		$results=$p->fetch_assoc();
		$form_id=$results['form_id'];			
		if(!empty($results["total_qty"])){				
			$total_qty=json_decode($results["total_qty"]);
			$total_qty_b=$total_qty->b;$total_qty_ref=$total_qty->ref;
			$total_qty_d=$total_qty->d;$total_qty_r=$total_qty->r;
			$total_qty_b_typ=$total_qty_b->typ;$total_qty_b_qty=$total_qty_b->qty;$total_qty_b_no=$total_qty_b->no;				
			$total_qty_ref_typ=$total_qty_ref->typ;$total_qty_ref_qty=$total_qty_ref->qty;$total_qty_ref_no=$total_qty_ref->no;
			$total_qty_d_typ1=$total_qty_d->typ1;$total_qty_d_qty1=$total_qty_d->qty1;$total_qty_d_no1=$total_qty_d->no1;
			$total_qty_d_typ2=$total_qty_d->typ2;$total_qty_d_qty2=$total_qty_d->qty2;$total_qty_d_no2=$total_qty_d->no2;
			$total_qty_d_typ3=$total_qty_d->typ3;$total_qty_d_qty3=$total_qty_d->qty3;$total_qty_d_no3=$total_qty_d->no3;
			$total_qty_d_typ4=$total_qty_d->typ4;$total_qty_d_qty4=$total_qty_d->qty4;$total_qty_d_no4=$total_qty_d->no4;
			$total_qty_r_typ1=$total_qty_r->typ1;$total_qty_r_qty1=$total_qty_r->qty1;$total_qty_r_no1=$total_qty_r->no1;
			$total_qty_r_typ2=$total_qty_r->typ2;$total_qty_r_qty2=$total_qty_r->qty2;$total_qty_r_no2=$total_qty_r->no2;
			$total_qty_r_typ3=$total_qty_r->typ3;$total_qty_r_qty3=$total_qty_r->qty3;$total_qty_r_no3=$total_qty_r->no3;
		}else{
			$total_qty_b_typ="";$total_qty_b_qty="";$total_qty_b_no="";
			$total_qty_ref_typ="";$total_qty_ref_qty="";$total_qty_ref_no="";
			$total_qty_d_typ1="";$total_qty_d_qty1="";$total_qty_d_no1="";
			$total_qty_d_typ2="";$total_qty_d_qty2="";$total_qty_d_no2="";
			$total_qty_d_typ3="";$total_qty_d_qty3="";$total_qty_d_no3="";
			$total_qty_d_typ4="";$total_qty_d_qty4="";$total_qty_d_no4="";
			$total_qty_r_typ1="";$total_qty_r_qty1="";$total_qty_r_no1="";
			$total_qty_r_typ1="";$total_qty_r_qty1="";$total_qty_r_no1="";
			$total_qty_r_typ2="";$total_qty_r_qty2="";$total_qty_r_no2="";
			$total_qty_r_typ3="";$total_qty_r_qty3="";$total_qty_r_no3="";
		}	
		if(!empty($results["destn_add"])){
			$destn_add=json_decode($results["destn_add"]);
			$destn_add_name=$destn_add->name;$destn_add_sn1=$destn_add->sn1;$destn_add_sn2=$destn_add->sn2;$destn_add_vt=$destn_add->vt;$destn_add_dist=$destn_add->dist;$destn_add_pin=$destn_add->pin;$destn_add_mob=$destn_add->mob;$destn_add_std=$destn_add->std;$destn_add_phn_no=$destn_add->phn_no;
		}else{
			$destn_add_name="";$destn_add_sn1="";$destn_add_sn2="";$destn_add_vt="";$destn_add_dist="";$destn_add_pin="";$destn_add_mob="";$destn_add_std="";$destn_add_phn_no="";
		}
		if(!empty($results["mat_seg_rcvr"])){
			$mat_seg_rcvr=json_decode($results["mat_seg_rcvr"]);
			$mat_seg_rcvr_typ=$mat_seg_rcvr->typ;$mat_seg_rcvr_qty=$mat_seg_rcvr->qty;
		}else{
			$mat_seg_rcvr_typ="";$mat_seg_rcvr_qty="";
		}
	}else{
		 $form_id="";
		$total_qty_b_typ="";$total_qty_b_qty="";$total_qty_b_no="";
		$total_qty_ref_typ="";$total_qty_ref_qty="";$total_qty_ref_no="";
		$total_qty_d_typ1="";$total_qty_d_qty1="";$total_qty_d_no1="";
		$total_qty_d_typ2="";$total_qty_d_qty2="";$total_qty_d_no2="";
		$total_qty_d_typ3="";$total_qty_d_qty3="";$total_qty_d_no3="";
		$total_qty_d_typ4="";$total_qty_d_qty4="";$total_qty_d_no4="";
		$total_qty_r_typ1="";$total_qty_r_qty1="";$total_qty_r_no1="";
		$total_qty_r_typ1="";$total_qty_r_qty1="";$total_qty_r_no1="";
		$total_qty_r_typ2="";$total_qty_r_qty2="";$total_qty_r_no2="";
		$total_qty_r_typ3="";$total_qty_r_qty3="";$total_qty_r_no3="";
		$destn_add_name="";$destn_add_sn1="";$destn_add_sn2="";$destn_add_vt="";$destn_add_dist="";$destn_add_pin="";$destn_add_mob="";$destn_add_std="";$destn_add_phn_no="";
		$mat_seg_rcvr_typ="";$mat_seg_rcvr_qty="";
	}
}else{
	$results=$q->fetch_assoc();
	$form_id=$results['form_id'];			
	if(!empty($results["total_qty"])){				
		$total_qty=json_decode($results["total_qty"]);
		$total_qty_b=$total_qty->b;$total_qty_ref=$total_qty->ref;
		$total_qty_d=$total_qty->d;$total_qty_r=$total_qty->r;
		$total_qty_b_typ=$total_qty_b->typ;$total_qty_b_qty=$total_qty_b->qty;$total_qty_b_no=$total_qty_b->no;				
		$total_qty_ref_typ=$total_qty_ref->typ;$total_qty_ref_qty=$total_qty_ref->qty;$total_qty_ref_no=$total_qty_ref->no;
		$total_qty_d_typ1=$total_qty_d->typ1;$total_qty_d_qty1=$total_qty_d->qty1;$total_qty_d_no1=$total_qty_d->no1;
		$total_qty_d_typ2=$total_qty_d->typ2;$total_qty_d_qty2=$total_qty_d->qty2;$total_qty_d_no2=$total_qty_d->no2;
		$total_qty_d_typ3=$total_qty_d->typ3;$total_qty_d_qty3=$total_qty_d->qty3;$total_qty_d_no3=$total_qty_d->no3;
		$total_qty_d_typ4=$total_qty_d->typ4;$total_qty_d_qty4=$total_qty_d->qty4;$total_qty_d_no4=$total_qty_d->no4;
		$total_qty_r_typ1=$total_qty_r->typ1;$total_qty_r_qty1=$total_qty_r->qty1;$total_qty_r_no1=$total_qty_r->no1;
		$total_qty_r_typ2=$total_qty_r->typ2;$total_qty_r_qty2=$total_qty_r->qty2;$total_qty_r_no2=$total_qty_r->no2;
		$total_qty_r_typ3=$total_qty_r->typ3;$total_qty_r_qty3=$total_qty_r->qty3;$total_qty_r_no3=$total_qty_r->no3;
	}else{
		$total_qty_b_typ="";$total_qty_b_qty="";$total_qty_b_no="";
		$total_qty_ref_typ="";$total_qty_ref_qty="";$total_qty_ref_no="";
		$total_qty_d_typ1="";$total_qty_d_qty1="";$total_qty_d_no1="";
		$total_qty_d_typ2="";$total_qty_d_qty2="";$total_qty_d_no2="";
		$total_qty_d_typ3="";$total_qty_d_qty3="";$total_qty_d_no3="";
		$total_qty_d_typ4="";$total_qty_d_qty4="";$total_qty_d_no4="";
		$total_qty_r_typ1="";$total_qty_r_qty1="";$total_qty_r_no1="";
		$total_qty_r_typ1="";$total_qty_r_qty1="";$total_qty_r_no1="";
		$total_qty_r_typ2="";$total_qty_r_qty2="";$total_qty_r_no2="";
		$total_qty_r_typ3="";$total_qty_r_qty3="";$total_qty_r_no3="";
	}	
	if(!empty($results["destn_add"])){
		$destn_add=json_decode($results["destn_add"]);
		$destn_add_name=$destn_add->name;$destn_add_sn1=$destn_add->sn1;$destn_add_sn2=$destn_add->sn2;$destn_add_vt=$destn_add->vt;$destn_add_dist=$destn_add->dist;$destn_add_pin=$destn_add->pin;$destn_add_mob=$destn_add->mob;$destn_add_std=$destn_add->std;$destn_add_phn_no=$destn_add->phn_no;
	}else{
		$destn_add_name="";$destn_add_sn1="";$destn_add_sn2="";$destn_add_vt="";$destn_add_dist="";$destn_add_pin="";$destn_add_mob="";$destn_add_std="";$destn_add_phn_no="";
	}
	if(!empty($results["mat_seg_rcvr"])){
		$mat_seg_rcvr=json_decode($results["mat_seg_rcvr"]);
		$mat_seg_rcvr_typ=$mat_seg_rcvr->typ;$mat_seg_rcvr_qty=$mat_seg_rcvr->qty;
	}else{
		$mat_seg_rcvr_typ="";$mat_seg_rcvr_qty="";
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
							<h4 class="text-center" >
								<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form);?></strong>
							</h4>	
						</div>
						<div class="panel-body">
							<div id="table1" class="tab-pane" role="tabpanel">
							<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
							<table class="table table-responsive table-bordered">
								<tr>
									<td colspan="4">1. Name and address of the producer or manufacturer or refurbisher or dismantler or recycler</td>
								</tr>
								<tr>								 
									 <td width="25%">Name :</td>
									 <td width="25%"><input type="text" disabled value="<?php echo $unit_name; ?>" class="form-control text-uppercase"></td>
									 <td width="25%">Street Name 1:</td>
									 <td width="25%"><input type="text" disabled value="<?php echo $b_street_name1; ?>" class="form-control text-uppercase"></td>
								</tr>
								<tr>
									<td>Street Name 2:</td>
									<td><input type="text" disabled value="<?php echo $b_street_name2; ?>" class="form-control text-uppercase"></td>
									<td>Village/Town:</td>
									<td><input type="text" disabled value="<?php echo $b_vill; ?>"class="form-control text-uppercase"></td>
								</tr>
								<tr>
									<td>District:</td>
									<td><input type="text" disabled value="<?php echo $b_dist; ?>" class="form-control text-uppercase"></td>
									<td>Pincode:</td>
									<td><input type="text" disabled value="<?php echo $b_pincode; ?>" class="form-control"></td>
								</tr>
								<tr>
									<td>Mobile No:</td>
									<td><input type="text" disabled value="<?php echo '+91'.$b_mobile_no; ?>" class="form-control text-uppercase"></td>
									<td>Phone No:</td>
									<td><input type="text" disabled value="<?php echo $b_landline_std.-$b_landline_no; ?>" class="form-control text-uppercase"></td>
								</tr>
								<tr>
									<td>Email Id:</td>
									<td><input type="text" disabled value="<?php echo $b_email; ?>" class="form-control "></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td colspan="4">2. Name of the authorized person and complete address with telephone and fax numbers and e-mail address</td>									
								</tr>
								<tr>
									 <td>Name :</td>
									 <td><input type="text" disabled value="<?php echo $key_person; ?>" class="form-control text-uppercase"></td>
									 <td>Street Name 1:</td>
									 <td><input type="text" disabled value="<?php echo $street_name1; ?>" class="form-control text-uppercase"></td>
								</tr>
								<tr>
									<td>Street Name 2:</td>
									<td><input type="text" disabled value="<?php echo $street_name2; ?>" class="form-control text-uppercase"></td>
									<td>Village/Town:</td>
									<td><input type="text" disabled value="<?php echo $vill; ?>"class="form-control text-uppercase"></td>
								</tr>
								<tr>
									<td>District:</td>
									<td><input type="text" disabled value="<?php echo $dist; ?>" class="form-control text-uppercase"></td>
									<td>Pincode:</td>
									<td><input type="text" disabled value="<?php echo $pincode; ?>" class="form-control"></td>
								</tr>
								<tr>
									<td>Mobile No:</td>
									<td><input type="text" disabled value="<?php echo '+91'.$mobile_no; ?>" class="form-control text-uppercase"></td>
									<td>Phone No:</td>
									<td><input type="text" disabled value="<?php echo $landline_std.$landline_no; ?>" class="form-control text-uppercase"></td>
								</tr>
								<tr>
									<td>Email Id:</td>
									<td><input type="text" disabled value="<?php echo $email; ?>" class="form-control "></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td colspan="3">3. Total quantity of e-waste collected or channelised to recyclers or dismantlers for processing during the year for each category of electrical and electronic equipment listed in the Schedule I  by PRODUCERS</td>
									<td>(Upload Later in Upload Section)</td>
								</tr>									
								<tr>
									<td align="center"><b>Details of the above</b></td>
									<td align="center"><b>TYPE</b></td>
									<td align="center"><b>QUANTITY</b></td>			                           
									<td align="center"><b>No.</b></td>			                           
								</tr>
								<tr>
								   <td>3(A)<sup>*</sup><b>BULK CONSUMERS:</b> Quantity of e-waste</td>
								   <td><input type="text"  required class="form-control text-uppercase" name="total_qty[b][typ]" validate="specialChar" value="<?php  echo $total_qty_b_typ;  ?>"/></td>
								   <td><input type="text" required class="form-control text-uppercase" name="total_qty[b][qty]" validate="onlyNumbers"  value="<?php  echo $total_qty_b_qty; ?>" /></td><td><input type="text" required class="form-control text-uppercase" name="total_qty[b][no]" validate="onlyNumbers"  value="<?php  echo $total_qty_b_no; ?>" /></td>				                       
								</tr>
								<tr>
								   <td>3(B)<sup>*</sup><b>REFURBISHERS:</b> Quantity of e-waste</td>
								   <td><input type="text" required class="form-control text-uppercase" name="total_qty[ref][typ]" validate="specialChar" value="<?php  echo $total_qty_ref_typ; ?>" /></td>
								   <td><input type="text" required class="form-control text-uppercase" name="total_qty[ref][qty]" validate="onlyNumbers"  value="<?php  echo $total_qty_ref_qty; ?>" /></td>									
								   <td><input type="text" required class="form-control text-uppercase" name="total_qty[ref][no]" validate="onlyNumbers"  value="<?php  echo $total_qty_ref_no; ?>" /></td>									
								</tr>
								<tr>
									<td colspan="4">3(C)<sup>*</sup><b>DISMANTLERS:</b></td>
								</tr>
								<tr>
								   <td>	i. Quantity of e-waste processed (Code wise)</td>
								   <td><input type="text"  required class="form-control text-uppercase" name="total_qty[d][typ1]" validate="specialChar" value="<?php  echo $total_qty_d_typ1;  ?>"/></td>
								   <td><input type="text" required class="form-control text-uppercase" name="total_qty[d][qty1]" validate="onlyNumbers"  value="<?php  echo $total_qty_d_qty1; ?>" /></td><td><input type="text" required class="form-control text-uppercase" name="total_qty[d][no1]" validate="onlyNumbers"  value="<?php  echo $total_qty_d_no1; ?>" /></td>
								</tr>
								<tr>
								   <td>ii. Details of materials or components recovered and sold</td>
								   <td><input type="text"  required class="form-control text-uppercase" name="total_qty[d][typ2]" validate="specialChar" value="<?php  echo $total_qty_d_typ2;  ?>"/></td>
								   <td><input type="text" required class="form-control text-uppercase" name="total_qty[d][qty2]" validate="onlyNumbers"  value="<?php  echo $total_qty_d_qty2; ?>" /></td><td><input type="text" required class="form-control text-uppercase" name="total_qty[d][no2]" validate="onlyNumbers"  value="<?php  echo $total_qty_d_no2; ?>" /></td>
								</tr>
								<tr>
								   <td>iii. Quantity of e-waste sent to recycler</td>
								   <td><input type="text"  required class="form-control text-uppercase" name="total_qty[d][typ3]" validate="specialChar" value="<?php  echo $total_qty_d_typ3;  ?>"/></td>
								   <td><input type="text" required class="form-control text-uppercase" name="total_qty[d][qty3]" validate="onlyNumbers"  value="<?php  echo $total_qty_d_qty3; ?>" /></td><td><input type="text" required class="form-control text-uppercase" name="total_qty[d][no3]" validate="onlyNumbers"  value="<?php  echo $total_qty_d_no3; ?>" /></td>
								</tr>
								<tr>
								   <td>iv. Residual quantity of e-waste sent to Treatment, Storage and Disposal Facility.</td>
								   <td><input type="text"  required class="form-control text-uppercase" name="total_qty[d][typ4]" validate="specialChar" value="<?php  echo $total_qty_d_typ4;  ?>"/></td>
								   <td><input type="text" required class="form-control text-uppercase" name="total_qty[d][qty4]" validate="onlyNumbers"  value="<?php  echo $total_qty_d_qty4; ?>" /></td><td><input type="text" required class="form-control text-uppercase" name="total_qty[d][no4]" validate="onlyNumbers"  value="<?php  echo $total_qty_d_no4; ?>" /></td>
								</tr>
								<tr>
									<td colspan="4">3(D)<sup>*</sup><b>RECYCLERS:</b></td>
								</tr>
								<tr>
								   <td>i. Quantity of e-waste processed (Code wise)</td>
								   <td><input type="text" required class="form-control text-uppercase" name="total_qty[r][typ1]" validate="specialChar" value="<?php  echo $total_qty_r_typ1; ?>" /></td>
								   <td><input type="text" required class="form-control text-uppercase" name="total_qty[r][qty1]" validate="onlyNumbers"  value="<?php  echo $total_qty_r_qty1; ?>" /></td>									
								   <td><input type="text" required class="form-control text-uppercase" name="total_qty[r][no1]" validate="onlyNumbers"  value="<?php  echo $total_qty_r_no1; ?>" /></td>						
								</tr>	
								<tr>
								   <td>ii.Details of materials recovered and sold in the market</td>
								   <td><input type="text" required class="form-control text-uppercase" name="total_qty[r][typ2]" validate="specialChar" value="<?php  echo $total_qty_r_typ2; ?>" /></td>
								   <td><input type="text" required class="form-control text-uppercase" name="total_qty[r][qty2]" validate="onlyNumbers"  value="<?php  echo $total_qty_r_qty2; ?>" /></td>									
								   <td><input type="text" required class="form-control text-uppercase" name="total_qty[r][no2]" validate="onlyNumbers"  value="<?php  echo $total_qty_r_no2; ?>" /></td>						
								</tr>
								<tr>
								   <td>iii.Details of residue sent to Treatment, Storage and Disposal Facility.</td>
								   <td><input type="text" required class="form-control text-uppercase" name="total_qty[r][typ3]" validate="specialChar" value="<?php  echo $total_qty_r_typ3; ?>" /></td>
								   <td><input type="text" required class="form-control text-uppercase" name="total_qty[r][qty3]" validate="onlyNumbers"  value="<?php  echo $total_qty_r_qty3; ?>" /></td>									
								   <td><input type="text" required class="form-control text-uppercase" name="total_qty[r][no3]" validate="onlyNumbers"  value="<?php  echo $total_qty_r_no3; ?>" /></td>						
								</tr>	         		                       
								<tr>
								   <td colspan="4">4. Name and full address of the destination with respect to 3(A)-3(D) above</td>
								</tr>
								<tr>
								   <td>Name</td>
								   <td><input type="text" required class="form-control text-uppercase" validate="specialChar" name="destn_add[name]"  value="<?php  echo  $destn_add_name; ?>" /></td>					
								   <td>Street Name 1</td>
								   <td><input type="text"  validate="specialChar" required class="form-control text-uppercase" name="destn_add[sn1]" value="<?php  echo $destn_add_sn1; ?>" /></td>
								</tr>
								<tr>
									<td>Street Name 2</td>
									<td><input type="text" validate="specialChar" class="form-control text-uppercase" name="destn_add[sn2]" value="<?php echo $destn_add_sn2; ?>" /></td>
								   <td>Village/Town</td>
								   <td><input type="text" validate="specialChar" required name="destn_add[vt]" class="form-control text-uppercase" value="<?php  echo $destn_add_vt; ?>"/></td>
								</tr>
								<tr>
								   <td>District</td>
                                        <td>
                                        <input type="text" class="form-control text-uppercase" value="<?php echo strtoupper($destn_add_dist);?>"   name="destn_add[dist]">    
                                        </td>

								   <td>Pincode</td>
									<td><input type="text" required class="form-control text-uppercase" validate="pincode" name="destn_add[pin]"  maxlength="6" value="<?php  echo $destn_add_pin; ?>" /></td>
								</tr>
								<tr>
									<td>Mobile</td>
									<td><div class="input-group"><input type="text"  class="form-control text-uppercase" name="des"  style="width:60px" placeholder="+91" value="+91" readonly /><input style="width:180px" type="text" class="form-control text-uppercase" required validate="mobileNumber" maxlength="10" placeholder="9856700456" name="destn_add[mob]"  value="<?php  echo  $destn_add_mob; ?>" /></div></td>
									<td>Phone Number</td>
									<td><div class="input-group"><input type="text" validate="onlyNumbers" class="form-control text-uppercase" name="destn_add[std]"  style="width:60px" maxlength="5"  placeholder="03666" value="<?php echo $destn_add_std; ?>"/><input style="width:180px" type="text" class="form-control text-uppercase" maxlength="8" placeholder="223454" name="destn_add[phn_no]" validate="onlyNumbers" value="<?php  echo $destn_add_phn_no; ?>" /></div></td>
								</tr>									
								<tr>
									<td colspan="4">5. Type and quantity of materials segregated or recovered from e-waste of different codes as applicable to 3(A)-3(D)</td>
								</tr>
								<tr>
									<td>Type</td>
									<td><input class="form-control text-uppercase"name="mat_seg_rcvr[typ]" value="<?php  echo $mat_seg_rcvr_typ; ?>"></td>
									<td>Quantity</td>
									<td><input validate="onlyNumbers" class="form-control text-uppercase" name="mat_seg_rcvr[qty]" value="<?php  echo $mat_seg_rcvr_qty; ?>"></td>
								</tr>
								<tr>
								   <td colspan="2">Place : <b><?php echo strtoupper($dist); ?></b><br/>
								   Date : <b><?php echo date('d-m-Y',strtotime($today)); ?></b></td>
								   <td colspan="2" align="right"><b><?php echo strtoupper($key_person) ?></b><br/>Signature of the Authorized Person</td>
							   </tr>
								<tr>										
									<td class="text-center" colspan="4">
										<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you want to save..?')" >Save and Next</button>
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
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	/* ------------------------------------------------------ */	
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>