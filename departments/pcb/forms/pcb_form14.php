<?php  require_once "../../requires/login_session.php";
$dept="pcb";
$form="14";
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
		$s1=$results["s1"];$auth_issue_dt=$results["auth_issue_dt"];$auth_val_dt=$results["auth_val_dt"];			
		if(!empty($results["ew_handle"])){
			$ew_handle=json_decode($results["ew_handle"]);
			$ew_handle_cat=$ew_handle->cat;$ew_handle_qty=$ew_handle->qty;$ew_handle_item=$ew_handle->item;
		}else{
			$ew_handle_cat="";$ew_handle_qty="";$ew_handle_item="";
		}	
		if(!empty($results["ew_store"])){
			$ew_store=json_decode($results["ew_store"]);
			$ew_store_cat=$ew_store->cat;$ew_store_qty=$ew_store->qty;$ew_store_item=$ew_store->item;
		}else{
			$ew_store_cat="";$ew_store_qty="";$ew_store_item="";
		}	
		if(!empty($results["ew_auth_collection"])){
			$ew_auth_collection=json_decode($results["ew_auth_collection"]);
			$ew_auth_collection_cat=$ew_auth_collection->cat;$ew_auth_collection_qty=$ew_auth_collection->qty;$ew_auth_collection_item=$ew_auth_collection->item;
		}else{
			$ew_auth_collection_cat="";$ew_auth_collection_qty="";$ew_auth_collection_item="";
		}	
		if(!empty($results["ew_transport"])){
			$ew_transport=json_decode($results["ew_transport"]);
			$ew_transport_cat=$ew_transport->cat;$ew_transport_qty1=$ew_transport->qty1;$ew_transport_item=$ew_transport->item;$ew_transport_name=$ew_transport->name;$ew_transport_sn1=$ew_transport->sn1;$ew_transport_sn2=$ew_transport->sn2;$ew_transport_vt=$ew_transport->vt;$ew_transport_dist=$ew_transport->dist;
			$ew_transport_pin=$ew_transport->pin;$ew_transport_mob=$ew_transport->mob;$ew_transport_phn1=$ew_transport->phn1;$ew_transport_phn2=$ew_transport->phn2;
		}else{
			$ew_transport_cat="";$ew_transport_qty1="";$ew_transport_item="";$ew_transport_name="";$ew_transport_sn1="";$ew_transport_sn2="";$ew_transport_vt="";$ew_transport_dist="";$ew_transport_pin="";$ew_transport_mob="";$ew_transport_phn1="";$ew_transport_phn2="";
		}
		if(!empty($results["ew_refur"])){
			$ew_refur=json_decode($results["ew_refur"]);
			$ew_refur_cat=$ew_refur->cat;$ew_refur_qty=$ew_refur->qty;$ew_refur_item=$ew_refur->item;$ew_refur_name=$ew_refur->name;$ew_refur_sn1=$ew_refur->sn1;$ew_refur_sn2=$ew_refur->sn2;$ew_refur_vt=$ew_refur->vt;$ew_refur_dist=$ew_refur->dist;$ew_refur_pin=$ew_refur->pin;$ew_refur_mob=$ew_refur->mob;$ew_refur_phn1=$ew_refur->phn1;$ew_refur_phn2=$ew_refur->phn2;				
		}else{
			$ew_refur_cat="";$ew_refur_qty="";$ew_refur_item="";$ew_refur_name="";$ew_refur_sn1="";$ew_refur_sn2="";$ew_refur_vt="";$ew_refur_dist="";$ew_refur_pin="";$ew_refur_mob="";$ew_refur_phn1="";$ew_refur_phn2="";
		}
		if(!empty($results["ew_dismant"])){
			$ew_dismant=json_decode($results["ew_dismant"]);
			$ew_dismant_cat=$ew_dismant->cat;$ew_dismant_qty=$ew_dismant->qty;$ew_dismant_item=$ew_dismant->item;$ew_dismant_name=$ew_dismant->name;$ew_dismant_sn1=$ew_dismant->sn1;$ew_dismant_sn2=$ew_dismant->sn2;$ew_dismant_vt=$ew_dismant->vt;$ew_dismant_dist=$ew_dismant->dist;$ew_dismant_pin=$ew_dismant->pin;$ew_dismant_mob=$ew_dismant->mob;$ew_dismant_phn1=$ew_dismant->phn1;$ew_dismant_phn2=$ew_dismant->phn2;
		}else{
			$ew_dismant_cat="";$ew_dismant_qty="";$ew_dismant_item="";$ew_dismant_name="";$ew_dismant_sn1="";$ew_dismant_sn2="";$ew_dismant_vt="";$ew_dismant_dist="";$ew_dismant_pin="";$ew_dismant_mob="";$ew_dismant_phn1="";$ew_dismant_phn2="";
		}
		if(!empty($results["ew_recycle"])){
			$ew_recycle=json_decode($results["ew_recycle"]);
			$ew_recycle_cat=$ew_recycle->cat;$ew_recycle_qty1=$ew_recycle->qty1;$ew_recycle_item=$ew_recycle->item;$ew_recycle_name=$ew_recycle->name;$ew_recycle_sn1=$ew_recycle->sn1;$ew_recycle_sn2=$ew_recycle->sn2;$ew_recycle_vt=$ew_recycle->vt;$ew_recycle_dist=$ew_recycle->dist;$ew_recycle_pin=$ew_recycle->pin;$ew_recycle_mob=$ew_recycle->mob;$ew_recycle_phn1=$ew_recycle->phn1;$ew_recycle_phn2=$ew_recycle->phn2;
		}else{
			$ew_recycle_cat="";$ew_recycle_qty1="";$ew_recycle_qty2="";$ew_recycle_item="";$ew_recycle_name="";$ew_recycle_sn1="";$ew_recycle_sn2="";$ew_recycle_vt="";$ew_recycle_dist="";$ew_recycle_pin="";$ew_recycle_mob="";$ew_recycle_phn1="";$ew_recycle_phn2="";
		}
		if(!empty($results["ew_recover"])){
			$ew_recover=json_decode($results["ew_recover"]);
			$ew_recover_cat=$ew_recover->cat;$ew_recover_qty=$ew_recover->qty;$ew_recover_item=$ew_recover->item;
		}else{
			$ew_recover_cat="";$ew_recover_qty="";$ew_recover_item="";
		}
		if(!empty($results["ew_treated"])){
			$ew_treated=json_decode($results["ew_treated"]);
			$ew_treated_cat=$ew_treated->cat;$ew_treated_qty=$ew_treated->qty;$ew_treated_item=$ew_treated->item;
		}else{
			$ew_treated_cat="";$ew_treated_qty="";$ew_treated_item="";
		}		
	}else{				
		$s1=""; $auth_issue_dt=""; $auth_val_dt="";
		$ew_handle_cat="";$ew_handle_qty="";$ew_handle_item="";			
		$ew_store_cat="";$ew_store_qty="";$ew_store_item="";			
		$ew_auth_collection_cat="";$ew_auth_collection_qty="";$ew_auth_collection_item="";			
		$ew_transport_cat="";$ew_transport_qty1="";$ew_transport_name="";$ew_transport_sn1="";$ew_transport_sn2="";$ew_transport_vt="";$ew_transport_dist="";$ew_transport_pin="";$ew_transport_mob="";$ew_transport_phn1="";$ew_transport_phn2="";$ew_transport_item="";
		$ew_refur_cat="";$ew_refur_qty="";$ew_refur_item="";$ew_refur_name="";$ew_refur_sn1="";$ew_refur_sn2="";$ew_refur_vt="";$ew_refur_dist="";$ew_refur_pin="";$ew_refur_mob="";$ew_refur_phn1="";$ew_refur_phn2="";		
		$ew_dismant_cat="";$ew_dismant_qty="";$ew_dismant_item="";$ew_dismant_name="";$ew_dismant_sn1="";$ew_dismant_sn2="";$ew_dismant_vt="";$ew_dismant_dist="";$ew_dismant_pin="";$ew_dismant_mob="";$ew_dismant_phn1="";$ew_dismant_phn2="";		
		$ew_recycle_cat="";$ew_recycle_qty1="";$ew_recycle_qty2="";$ew_recycle_item="";$ew_recycle_name="";$ew_recycle_sn1="";$ew_recycle_sn2="";$ew_recycle_vt="";$ew_recycle_dist="";$ew_recycle_pin="";$ew_recycle_mob="";$ew_recycle_phn1="";$ew_recycle_phn2="";			
		$ew_recover_cat="";$ew_recover_qty="";$ew_recover_item="";
		$ew_treated_cat="";$ew_treated_qty="";$ew_treated_item="";
	}
}else{
	$results=$q->fetch_assoc();
	$form_id=$results['form_id'];			
	$s1=$results["s1"];$auth_issue_dt=$results["auth_issue_dt"];$auth_val_dt=$results["auth_val_dt"];			
	if(!empty($results["ew_handle"])){
		$ew_handle=json_decode($results["ew_handle"]);
		$ew_handle_cat=$ew_handle->cat;$ew_handle_qty=$ew_handle->qty;$ew_handle_item=$ew_handle->item;
	}else{
		$ew_handle_cat="";$ew_handle_qty="";$ew_handle_item="";
	}	
	if(!empty($results["ew_store"])){
		$ew_store=json_decode($results["ew_store"]);
		$ew_store_cat=$ew_store->cat;$ew_store_qty=$ew_store->qty;$ew_store_item=$ew_store->item;
	}else{
		$ew_store_cat="";$ew_store_qty="";$ew_store_item="";
	}	
	if(!empty($results["ew_auth_collection"])){
		$ew_auth_collection=json_decode($results["ew_auth_collection"]);
		$ew_auth_collection_cat=$ew_auth_collection->cat;$ew_auth_collection_qty=$ew_auth_collection->qty;$ew_auth_collection_item=$ew_auth_collection->item;
	}else{
		$ew_auth_collection_cat="";$ew_auth_collection_qty="";$ew_auth_collection_item="";
	}	
	if(!empty($results["ew_transport"])){
		$ew_transport=json_decode($results["ew_transport"]);
		$ew_transport_cat=$ew_transport->cat;$ew_transport_qty1=$ew_transport->qty1;$ew_transport_item=$ew_transport->item;$ew_transport_name=$ew_transport->name;$ew_transport_sn1=$ew_transport->sn1;$ew_transport_sn2=$ew_transport->sn2;$ew_transport_vt=$ew_transport->vt;$ew_transport_dist=$ew_transport->dist;
		$ew_transport_pin=$ew_transport->pin;$ew_transport_mob=$ew_transport->mob;$ew_transport_phn1=$ew_transport->phn1;$ew_transport_phn2=$ew_transport->phn2;
	}else{
		$ew_transport_cat="";$ew_transport_qty1="";$ew_transport_item="";$ew_transport_name="";$ew_transport_sn1="";$ew_transport_sn2="";$ew_transport_vt="";$ew_transport_dist="";$ew_transport_pin="";$ew_transport_mob="";$ew_transport_phn1="";$ew_transport_phn2="";
	}
	if(!empty($results["ew_refur"])){
		$ew_refur=json_decode($results["ew_refur"]);
		$ew_refur_cat=$ew_refur->cat;$ew_refur_qty=$ew_refur->qty;$ew_refur_item=$ew_refur->item;$ew_refur_name=$ew_refur->name;$ew_refur_sn1=$ew_refur->sn1;$ew_refur_sn2=$ew_refur->sn2;$ew_refur_vt=$ew_refur->vt;$ew_refur_dist=$ew_refur->dist;$ew_refur_pin=$ew_refur->pin;$ew_refur_mob=$ew_refur->mob;$ew_refur_phn1=$ew_refur->phn1;$ew_refur_phn2=$ew_refur->phn2;				
	}else{
		$ew_refur_cat="";$ew_refur_qty="";$ew_refur_item="";$ew_refur_name="";$ew_refur_sn1="";$ew_refur_sn2="";$ew_refur_vt="";$ew_refur_dist="";$ew_refur_pin="";$ew_refur_mob="";$ew_refur_phn1="";$ew_refur_phn2="";
	}
	if(!empty($results["ew_dismant"])){
		$ew_dismant=json_decode($results["ew_dismant"]);
		$ew_dismant_cat=$ew_dismant->cat;$ew_dismant_qty=$ew_dismant->qty;$ew_dismant_item=$ew_dismant->item;$ew_dismant_name=$ew_dismant->name;$ew_dismant_sn1=$ew_dismant->sn1;$ew_dismant_sn2=$ew_dismant->sn2;$ew_dismant_vt=$ew_dismant->vt;$ew_dismant_dist=$ew_dismant->dist;$ew_dismant_pin=$ew_dismant->pin;$ew_dismant_mob=$ew_dismant->mob;$ew_dismant_phn1=$ew_dismant->phn1;$ew_dismant_phn2=$ew_dismant->phn2;
	}else{
		$ew_dismant_cat="";$ew_dismant_qty="";$ew_dismant_item="";$ew_dismant_name="";$ew_dismant_sn1="";$ew_dismant_sn2="";$ew_dismant_vt="";$ew_dismant_dist="";$ew_dismant_pin="";$ew_dismant_mob="";$ew_dismant_phn1="";$ew_dismant_phn2="";
	}
	if(!empty($results["ew_recycle"])){
		$ew_recycle=json_decode($results["ew_recycle"]);
		$ew_recycle_cat=$ew_recycle->cat;$ew_recycle_qty1=$ew_recycle->qty1;$ew_recycle_item=$ew_recycle->item;$ew_recycle_name=$ew_recycle->name;$ew_recycle_sn1=$ew_recycle->sn1;$ew_recycle_sn2=$ew_recycle->sn2;$ew_recycle_vt=$ew_recycle->vt;$ew_recycle_dist=$ew_recycle->dist;$ew_recycle_pin=$ew_recycle->pin;$ew_recycle_mob=$ew_recycle->mob;$ew_recycle_phn1=$ew_recycle->phn1;$ew_recycle_phn2=$ew_recycle->phn2;
	}else{
		$ew_recycle_cat="";$ew_recycle_qty1="";$ew_recycle_qty2="";$ew_recycle_item="";$ew_recycle_name="";$ew_recycle_sn1="";$ew_recycle_sn2="";$ew_recycle_vt="";$ew_recycle_dist="";$ew_recycle_pin="";$ew_recycle_mob="";$ew_recycle_phn1="";$ew_recycle_phn2="";
	}
	if(!empty($results["ew_recover"])){
		$ew_recover=json_decode($results["ew_recover"]);
		$ew_recover_cat=$ew_recover->cat;$ew_recover_qty=$ew_recover->qty;$ew_recover_item=$ew_recover->item;
	}else{
		$ew_recover_cat="";$ew_recover_qty="";$ew_recover_item="";
	}
	if(!empty($results["ew_treated"])){
		$ew_treated=json_decode($results["ew_treated"]);
		$ew_treated_cat=$ew_treated->cat;$ew_treated_qty=$ew_treated->qty;$ew_treated_item=$ew_treated->item;
	}else{
		$ew_treated_cat="";$ew_treated_qty="";$ew_treated_item="";
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
							<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
								<table class="table table-responsive table-bordered">
									<tr>
										<td>1. Name & Address of the : </td>
										<td>
										<select name="s1">
										<option value="Producer" class="form-control text-uppercase" <?php if(isset($s1) && $s1=="Producer") echo 'selected'; ?>>Producer</option>
											<option value="Collection Centre"  class="form-control text-uppercase" <?php if(isset($s1) && $s1=="Collection Centre") echo 'selected'; ?>>Collection Centre</option>
											<option value="Dismantler" class="form-control text-uppercase" <?php if(isset($s1) && $s1=="Dismantler") echo 'selected'; ?>>Dismantler</option>
											<option value="Recycler" class="form-control text-uppercase" <?php if(isset($s1) && $s1=="Recycler") echo 'selected'; ?>>Recycler</option>
											<option value="Bulk consumer" class="form-control text-uppercase" <?php if(isset($s1) && $s1=="Bulk consumer") echo 'selected'; ?>>Bulk consumer</option>
										</select>
										</td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td>Name :</td>
									     <td><input type="text" disabled value="<?php echo $unit_name; ?>" class="form-control text-uppercase"></td>
									     <td>Street Name 1:</td>
									     <td><input type="text" disabled value="<?php echo $b_street_name1; ?>" class="form-control text-uppercase"></td>
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
										<td><input type="text" disabled value="<?php echo $b_landline_std.$b_landline_no; ?>" class="form-control text-uppercase"></td>
									</tr>
									<tr>
									    <td>Email Id:</td>
										<td><input type="text" disabled value="<?php echo $b_email; ?>" class="form-control "></td>
										<td></td>
										<td></td>
									</tr>
									
									<tr>
									    <td>2. Date of issue of<br> Authorization/Registration <span class="mandatory_field">*</span></td>
									    <td><input type="text" required class="dob form-control" name="auth_issue_dt" required value="<?php echo $auth_issue_dt; ?>" readonly /></td>
									    <td>3. Validity of Authorization/<br/>Registration <span class="mandatory_field">*</span></td> 
									    <td><input type="text" required name="auth_val_dt" required class="dob form-control" value="<?php  echo $auth_val_dt; ?>" readonly /></td>
									     
									</tr>
									<tr>
									     <td colspan="4">4. Types & Quantity of e-waste handled/generated</td>
									</tr>
									<tr>
									    <td>Category</td>
					                    <td><input type="text" validate="specialChar" class="form-control text-uppercase" name="ew_handle[cat]" value="<?php  echo $ew_handle_cat; ?>" /></td>
					                   <td>Quantity</td>
					                   <td><input type="text" class="form-control text-uppercase" name="ew_handle[qty]" validate="onlyNumbers" value="<?php  echo $ew_handle_qty; ?>" /></td>
									</tr>
									<tr>
									   <td>Item Description</td>  	
					                   <td><input type="text" class="form-control text-uppercase" name="ew_handle[item]" validate="specialChar"  value="<?php echo $ew_handle_item; ?>" /></td>
					                   <td></td>
					                   <td></td>
									</tr>
								
									<tr>
									    <td colspan="4">5. Types & Quantity of e-waste stored</td>
									</tr>
									<tr>
									    <td>Category</td>
					                    <td><input type="text" class="form-control text-uppercase" name="ew_store[cat]" validate="specialChar" value="<?php  echo $ew_store_cat; ?>" /></td>
					                   <td>Quantity</td>
					                   <td><input type="text" class="form-control text-uppercase" name="ew_store[qty]" validate="onlyNumbers" value="<?php  echo $ew_store_qty; ?>" /></td>
									</tr>
									<tr>
									   <td>Item Description</td>  	
					                   <td><input type="text" class="form-control text-uppercase" name="ew_store[item]" validate="specialChar"  value="<?php echo $ew_store_item; ?>" /></td>
					                   <td></td>
					                   <td></td>
									</tr>
									<tr>
									    <td colspan="4">6. Types & Quantity of e-waste sent to authorized collection centre/ registered dismantler or recycler</td>
									</tr>
									<tr>
									    <td>Category</td>
					                    <td><input type="text" class="form-control text-uppercase" name="ew_auth_collection[cat]" validate="specialChar" value="<?php  echo $ew_auth_collection_cat; ?>" /></td>
					                   <td>Quantity</td>
					                   <td><input type="text" class="form-control text-uppercase" name="ew_auth_collection[qty]" validate="onlyNumbers" value="<?php  echo $ew_auth_collection_qty; ?>" /></td>
									</tr>
									<tr>
									   <td>Item Description</td>  	
					                   <td><input type="text"  class="form-control text-uppercase" name="ew_auth_collection[item]" validate="specialChar"  value="<?php echo $ew_auth_collection_item; ?>" /></td>
					                   <td></td>
					                   <td></td>
									</tr>
									<tr>
									    <td colspan="4">7. Types & Quantity of e-waste transported</td>
									</tr>
									<tr>
									    <td>Category <span class="mandatory_field">*</span></td>
					                    <td><input type="text" class="form-control text-uppercase" required name="ew_transport[cat]" validate="specialChar" value="<?php  echo $ew_transport_cat; ?>" /></td>
					                   <td>Quantity <span class="mandatory_field">*</span></td>
					                   <td><input type="text" class="form-control text-uppercase" required name="ew_transport[qty1]" validate="onlyNumbers" value="<?php  echo $ew_transport_qty1; ?>" /></td>
									</tr>
									<tr>
									   <td>Item Description <span class="mandatory_field">*</span></td>  	
					                   <td><input type="text" class="form-control text-uppercase" required name="ew_transport[item]" validate="specialChar"  value="<?php echo $ew_transport_item; ?>" /></td>
					                   <td></td>
					                   <td></td>
									</tr>
									<tr>
				                       <td colspan="4">Name, address and contact details of the destination</td>
  			                        </tr>
									<tr>
									     <td> Name</td>
									     <td><input type="text" name="ew_transport[name]" class="form-control text-uppercase" value="<?php echo $ew_transport_name; ?>" /></td>
									     <td>Street Name 1</td> 
									     <td><input type="text" class="form-control text-uppercase" name="ew_transport[sn1]"  value="<?php  echo$ew_transport_sn1; ?>"></td>
									         
									</tr>
									<tr>
									    <td>Street Name 2:</td>
										<td><input type="text" class="form-control text-uppercase" name="ew_transport[sn2]" value="<?php  echo $ew_transport_sn2; ?>"></td>
										<td>Village/Town:</td>
										<td><input type="text" name="ew_transport[vt]" class="form-control text-uppercase" value="<?php  echo $ew_transport_vt; ?>"></td>
									</tr>
									<tr>
									    <td>District:</td>
                                        <td>
                                        <input type="text" class="form-control text-uppercase" value="<?php echo strtoupper($ew_transport_dist);?>"   name="ew_transport[dist]">    
                                        </td>
										
										<td>Pincode:</td>
										<td><input type="text" validate="pincode"  name="ew_transport[pin]" maxlength="6" value="<?php echo $ew_transport_pin; ?>" class="form-control"></td>
									</tr>
									<tr>
									    <td>Mobile No:</td>
										<td><input type="text"  name="ew_transport[mob]" validate="mobileNumber" value="<?php echo $ew_transport_mob; ?>" class="form-control"  maxlength="10"></td>
										<td>Phone No:</td>
										<td><div class="input-group">
										<input type="text" class="form-control" name="ew_transport[phn1]" validate="onlyNumbers" maxlength="5" style="width:60px" placeholder="03666" value="<?php  echo $ew_transport_phn1; ?>">
										<input style="width:120px" validate="onlyNumbers" class="form-control" type="text" name="ew_transport[phn2]"  placeholder="224534" maxlength="8" value="<?php  echo $ew_transport_phn2; ?>" /></div></td>
									</tr>
									<tr>
									    <td colspan="4">8. Types & Quantity of e-waste refurbished</td>
									</tr>
									<tr>
									    <td>Category <span class="mandatory_field">*</span></td>
					                    <td><input type="text" validate="specialChar"class="form-control text-uppercase" name="ew_refur[cat]" required value="<?php echo $ew_refur_cat; ?>"  /></td>
					                   <td>Quantity <span class="mandatory_field">*</span></td>
					                   <td><input type="text" class="form-control text-uppercase" validate="onlyNumbers" name="ew_refur[qty]" required value="<?php echo $ew_refur_qty; ?>"  /></td>
									</tr>
									<tr>
									   <td>Item Description <span class="mandatory_field">*</span></td>  	
					                   <td><input type="text" class="form-control text-uppercase" name="ew_refur[item]" required validate="specialChar" value="<?php echo $ew_refur_item; ?>"  /></td>
					                   <td></td>
					                   <td></td>
									</tr>
                                    <tr>
				                        <td colspan="4">Name, address and contact details of the destination of refurbished materials.</td>
  			                        </tr>
  			                        <tr>
									     <td> Name</td>
									     <td><input type="text" name="ew_refur[name]" class="form-control text-uppercase" value="<?php echo $ew_refur_name; ?>" /></td>
									     <td>Street Name 1</td> 
									     <td><input type="text" class="form-control text-uppercase" name="ew_refur[sn1]"  value="<?php  echo$ew_refur_sn1; ?>"></td>
									         
									</tr>
									<tr>
									    <td>Street Name 2:</td>
										<td><input type="text" class="form-control text-uppercase" name="ew_refur[sn2]" value="<?php  echo $ew_refur_sn2; ?>"></td>
										<td>Village/Town:</td>
										<td><input type="text" name="ew_refur[vt]" class="form-control text-uppercase" value="<?php  echo $ew_refur_vt; ?>"></td>
									</tr>
									<tr>
									    <td>District:</td>
                                         <td>
                                        <input type="text" class="form-control text-uppercase" value="<?php echo strtoupper($ew_refur_dist);?>"   name="ew_refur[dist]">    
                                        </td>
										<td>Pincode:</td>
										<td><input type="text" validate="pincode" name="ew_refur[pin]" maxlength="6" value="<?php echo $ew_refur_pin; ?>" class="form-control"></td>
									</tr>
									<tr>
									    <td>Mobile No:</td>
										<td><input type="text"  validate="mobileNumber" maxlength="10" name="ew_refur[mob]"  value="<?php echo $ew_refur_mob; ?>" class="form-control"></td>
										<td>Phone No:</td>
										<td><div class="input-group"><input type="text" class="form-control text-uppercase" name="ew_refur[phn1]"  validate="onlyNumbers" style="width:60px" maxlength="5" placeholder="03666" value="<?php echo $ew_refur_phn1; ?>"/>
										<input style="width:120px" type="text" class="form-control text-uppercase" name="ew_refur[phn2]" placeholder="225534" validate="onlyNumbers" maxlength="8" value="<?php echo $ew_refur_phn2; ?>" /></div></td>
									</tr>
									<tr>
									    <td colspan="4">9. Types & Quantity of e-waste dismantled</td>
									</tr>
									
									<tr>
									    <td>Category <span class="mandatory_field">*</span></td>
					                    <td><input type="text" validate="specialChar" class="form-control text-uppercase" name="ew_dismant[cat]" required value="<?php echo $ew_dismant_cat; ?>" ></td>
					                   <td>Quantity <span class="mandatory_field">*</span></td>
					                   <td><input type="text" validate="onlyNumbers" class="form-control text-uppercase" name="ew_dismant[qty]" required value="<?php  echo $ew_dismant_qty; ?>" ></td>
									</tr>
									<tr>
									   <td>Item Description <span class="mandatory_field">*</span></td>  	
					                   <td><input type="text" validate="specialChar" class="form-control text-uppercase" name="ew_dismant[item]"  required value="<?php echo $ew_dismant_item; ?>"></td>
					                   <td></td>
					                   <td></td>
									</tr>
									<tr>
				                        <td colspan="4">Name, address and contact details of the destination</td>
  			                        </tr>

								    <tr>
        			                   <td>Name</td>
        			                   <td><input type="text" class="form-control text-uppercase" name="ew_dismant[name]"  value="<?php  echo $ew_dismant_name; ?>" /></td>
        			                   <td>Street Name 1</td>
        			                   <td><input type="text" class="form-control text-uppercase" name="ew_dismant[sn1]"  value="<?php echo $ew_dismant_sn1; ?>" /></td>
      		                        </tr>
      		
      		                        <tr>
        			                    <td>Street Name 2</td>
        			                    <td><input type="text" class="form-control text-uppercase" name="ew_dismant[sn2]"  value="<?php echo $ew_dismant_sn2; ?>" /></td>
        			                    <td>Village/Town</td>
        			                    <td><input type="text" class="form-control text-uppercase" name="ew_dismant[vt]"  value="<?php echo $ew_dismant_vt; ?>" /></td>
      		                        </tr>
      		
      		                        <tr>
        			                   <td>District</td>
                                       <td>
                                        <input type="text" class="form-control text-uppercase" value="<?php echo strtoupper($ew_dismant_dist);?>"   name="ew_dismant[dist]">    
                                        </td>
        			                  
        			                    <td>Pincode</td>
        			                    <td><input type="text" validate="pincode" class="form-control text-uppercase" name="ew_dismant[pin]"  maxlength="6" value="<?php echo $ew_dismant_pin; ?>" /></td>
      		                        </tr>
      		
      		                        <tr>
        			                    <td>Mobile</td>
        			                    <td><input type="text" validate="mobileNumber" class="form-control text-uppercase" name="ew_dismant[mob]" placeholder="9876584512" maxlength="10" value="<?php echo $ew_dismant_mob; ?>" /></td>
        			                    <td>Phone Number</td>
        			                    <td><div class="input-group"><input type="text" class="form-control text-uppercase" name="ew_dismant[phn1]" id="textfield61" style="width:60px" validate="onlyNumbers" placeholder="03666" maxlength="5" value="<?php echo $ew_dismant_phn1; ?>"/><input style="width:120px" type="text" name="ew_dismant[phn2]" class="form-control text-uppercase"  placeholder="225534" maxlength="8" validate="onlyNumbers" value="<?php echo $ew_dismant_phn2; ?>" /></div></td>
      		                        </tr>
      		                            <td colspan="4">10. Types & Quantity of e-waste recycled</td>
      		                        </tr>
      		                        <tr>
  				                        <td>Category <span class="mandatory_field">*</span></td>
  				                        <td><input type="text"  validate="specialChar" class="form-control text-uppercase" name="ew_recycle[cat]" required value="<?php echo $ew_recycle_cat; ?>" /></td>
  				                        <td>Quantity <span class="mandatory_field">*</span></td>
  				                        <td><input type="text" validate="onlyNumbers" class="form-control text-uppercase" name="ew_recycle[qty1]" required  value="<?php echo $ew_recycle_qty1; ?>" /></td>
  			                        </tr>
  			                        <tr>
				                        <td>Item Description <span class="mandatory_field">*</span></td>  	
  				                        <td>
				                        <input type="text" validate="specialChar" class="form-control text-uppercase" name="ew_recycle[item]"  required value="<?php echo $ew_recycle_item; ?>" /></td>
				                        <td></td>
				                        <td></td>
  			                        </tr>
      		                        <tr>
                                       
        			                    <td>Name</td>
        			                    <td><input type="text" class="form-control text-uppercase" name="ew_recycle[name]"  value="<?php echo $ew_recycle_name; ?>" /></td>
        			                    <td >Street Name 1</td>
        			                    <td><input type="text" class="form-control text-uppercase" name="ew_recycle[sn1]"  value="<?php echo $ew_recycle_sn1; ?>" /></td>
      		                        </tr>
      		
      		                        <tr>
        			                    <td>Street Name 2</td>
        			                    <td><input type="text" class="form-control text-uppercase" name="ew_recycle[sn2]"  value="<?php echo $ew_recycle_sn2; ?>" /></td>
        			                    <td>Village/Town</td>
        			                    <td><input type="text" class="form-control text-uppercase" name="ew_recycle[vt]"  value="<?php echo $ew_recycle_vt; ?>" /></td>
      		                        </tr>
      		
      		                        <tr>
        			                    <td>District</td>
                                        <td>
                                        <input type="text" class="form-control text-uppercase" value="<?php echo strtoupper($ew_recycle_dist);?>"   name="ew_recycle[dist]">    
                                        </td>
        			                    
        			                    <td>Pincode</td>
        			                    <td><input type="text" maxlength="6" validate="pincode" class="form-control text-uppercase" name="ew_recycle[pin]" value="<?php echo $ew_recycle_pin; ?>"/></td>
      		                        </tr>
      		
      		                        <tr>
        			                    <td>Mobile</td>
        			                    <td><input type="text" validate="mobileNumber" name="ew_recycle[mob]" class="form-control text-uppercase"  placeholder="9876584512" maxlength="10" value="<?php echo $ew_recycle_mob; ?>" /></td>
        			                    <td>Phone Number</td>
        			                    <td><div class="input-group"><input type="text" class="form-control text-uppercase" name="ew_recycle[phn1]" validate="onlyNumbers" style="width:60px" placeholder="03666" maxlength="5" value="<?php echo strtoupper($ew_recycle_phn2); ?>"/><input style="width:120px" type="text" class="form-control text-uppercase" name="ew_recycle[phn2]" validate="onlyNumbers" maxlength="8"  placeholder="225534" value="<?php echo $ew_recycle_phn2; ?>" /></div></td>
      		                       </tr>
      		                       <tr>
  		
  		                               <td colspan="4">11. Types & Quantity of materials recovered</td>
		                            </tr>
  			                        <tr>
  				                        <td>Category</td>
  				                        <td><input type="text" validate="specialChar" class="form-control text-uppercase" name="ew_recover[cat]"  value="<?php echo $ew_recover_cat; ?>" /></td>
  				                        <td>Quantity</td>
  				                        <td><input type="text" validate="onlyNumbers" class="form-control text-uppercase" name="ew_recover[qty]"  value="<?php echo $ew_recover_qty; ?>" /></td>
  			                        </tr>
  			                        <tr>
				                       <td>Item Description</td>                  
				                       <td><input type="text" validate="specialChar" class="form-control text-uppercase" name="ew_recover[item]"   value="<?php echo $ew_recover_item; ?>" /></td>
				                    </tr>
				                    <tr>
				                        <td colspan="4">12. Types & Quantity of e-waste treated & disposed</td>
				                    </tr>
				                    <tr>
				                        <td>Category</td>
  				                        <td><input type="text" validate="specialChar" class="form-control text-uppercase" name="ew_treated[cat]" value="<?php echo $ew_treated_cat; ?>" /></td>
  				                        <td>Quantity</td>
  				                        <td><input type="text" validate="onlyNumbers" class="form-control text-uppercase" name="ew_treated[qty]"  value="<?php echo $ew_treated_qty; ?>" /></td>
  			                        </tr>
  			                        <tr>
				                        <td>Item Description</td>  	
  				                        <td><input type="text" validate="specialChar" class="form-control text-uppercase" name="ew_treated[item]"  value="<?php echo $ew_treated_item; ?>" /></td>
				                    </tr>
				                    <tr>
			                            <td>Place : <b> <?php echo strtoupper($dist); ?></b><br/>
			                            Date : <b><?php echo date('d-m-Y',strtotime($today)); ?> </b></td>
			                           <br/>
											<td></td>
											<td></td>
			                            <td align="right"><b><?php echo strtoupper($key_person); ?></b><br/>Signature of the Authorized Person</td>
  	                               </tr>
								<tr>	
									<td class="text-center" colspan="4">
										<button type="submit" class="btn btn-success submit1"  name="save<?php echo $form; ?>" title="Save it and Go to the next part" rel="tooltip" onclick="return confirm('Do you want to save..?')">Save and Next</button>
					               </td>
				                </tr>
					            </table>
							  </form>
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
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>