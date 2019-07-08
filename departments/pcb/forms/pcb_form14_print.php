<?php
$dept="pcb";
$form="14";
$table_name=getTableName($dept,$form);

if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
	echo "<script>
			alert('Invalid Page Access');
	</script>";	
	die();
}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
	$form_id=$_GET["ui"];
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and form_id='$form_id'");
}else if(isset($_GET["uain"])){
	$uain=$_GET["uain"];
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where uain='$uain' and user_id='$swr_id'");
}else if(isset($form_id)){
	$form_id=$form_id;
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and form_id='$form_id'");
}else{
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
}		
		

if($q->num_rows>0){
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

$form_name=$formFunctions->get_formName($dept,$form);
$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
		
if(!isset($css)){
$printContents='
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Form '.$form.'</title>
<style>
input, textarea { 
  text-transform: uppercase;
}
.header{
  width: 100%;
  height: 130px;
  font-weight: bold;
}
.main_body {
  height: 700px;
  width: 100%;
}
#form1 table {
  vertical-align: middle;
}
table {	border-spacing: 0;border-collapse: collapse;table-layout: fixed;width:1000px;border: 1px solid black;}table, th, td {border: 1px solid black;}</style>
</head>
<body>';        
}else{
    $printContents='';
}
if(!empty($results["uain"])){
	$printContents=$printContents.'<p style="text-align:right">UAIN : '.strtoupper($results["uain"]).'</p>';
}
$printContents=$printContents.'
    <div style="text-align:center">
        '.$assamSarkarLogo.'<h4>'.$form_name.'</h4>
        </div><br/> 
	<table class="table table-bordered table-responsive">
  	<tr>
   			<td width="50%">1. Name & Address of the : '.strtoupper($results["s1"]).'</td>
    		<td>
                <table class="table table-bordered table-responsive">
                <tr>
                    <td>Name</td>
                    <td>'.strtoupper($unit_name).'</td>
                </tr>
                <tr>
                    <td>Street Name 1</td>
                    <td>'.strtoupper($b_street_name1).'</td>
                </tr>
                <tr>
                    <td>Street Name 2</td>   
                    <td>'.strtoupper($b_street_name2).'</td>
                </tr>
                <tr>
                    <td>Village/Town</td>
                    <td>'.strtoupper($b_vill).'</td>
                </tr>
                <tr>
                    <td>District</td>
                    <td>'.strtoupper($b_dist).'</td>
                </tr>
                <tr>
                    <td>Pincode</td>
                    <td>'.strtoupper($b_pincode).'</td>
                </tr>
                <tr>
                    <td>Mobile No</td>
                    <td>'.strtoupper($b_mobile_no).'</td>
                </tr>
                <tr>
                    <td>Phone No</td>
                    <td>'.strtoupper($b_landline_std.-$b_landline_no).'</td>
                </tr>
                <tr>
                    <td>Email Id</td>
                    <td>'.$b_email.'</td>
                </tr>
                </table>
            </td>
	</tr>
  	<tr>
  	    <td>2. Date of issue of Authorization*/Registration*</td>
  	    <td>'.strtoupper($auth_issue_dt).'</td>
  	</tr>
  	<tr>
  	    <td>3. Validity of Authorization*/Registration*</td>
  	    <td>'.strtoupper($auth_val_dt).'</td>
  	</tr>
   	<tr>
  		<td>4. Types & Quantity of e-waste handled/generated</td>
  		<td>	
  			<table class="table table-bordered table-responsive">
  			<tr>
  				<td>Category</td>
  				<td>'.strtoupper($ew_handle_cat).'</td>
            </tr>
            <tr>
  				<td>Quantity</td>
  				<td>'.strtoupper($ew_handle_qty).'</td>
  			</tr>
  			<tr>
				<td>Item Description</td>  	
  				<td>'.strtoupper($ew_handle_item).'</td>
  			</tr>
  			</table>
  		</td>
  	</tr>
   	<tr>
  		<td>5. Types & Quantity of e-waste stored</td>
  		<td>	
  			<table class="table table-bordered table-responsive">
  			<tr>
  				<td>Category</td>
  				<td>'.strtoupper($ew_store_cat).'</td>
            </tr>
            <tr>
  				<td>Quantity</td>
  				<td>'.strtoupper($ew_store_qty).'</td>
  			</tr>
  			<tr>
				<td>Item Description</td>  	
  				<td>'.strtoupper($ew_store_item).'</td>
  			</tr>
  			</table>
  		</td>
  	</tr>
  	<tr>
  		<td>6. Types & Quantity of e-waste sent to authorized collection centre/ registered dismantler or recycler</td>
  		<td>	
  			<table class="table table-bordered table-responsive">
  			<tr>
  				<td>Category</td>
  				<td>'.strtoupper($ew_auth_collection_cat).'</td>
            </tr>
            <tr>
  				<td>Quantity</td>
  				<td>'.strtoupper($ew_auth_collection_qty).'</td>
  			</tr>
  			<tr>
				<td>Item Description</td>  	
  				<td>'.strtoupper($ew_auth_collection_item).'</td>
  			</tr>
  			</table>
  		</td>
  	</tr>
  	<tr>
  		<td>7. Types & Quantity of e-waste transported<sup>*</sup></td>
  		<td>	
  			<table class="table table-bordered table-responsive">
  			<tr>
  				<td>Category</td>
  				<td>'.strtoupper($ew_transport_cat).'</td>
            </tr>
            <tr>
  				<td>Quantity</td>
  				<td>'.strtoupper($ew_transport_qty1).'</td>
  			</tr>
  			<tr>
				<td>Item Description</td>  	
  				<td>'.strtoupper($ew_transport_item).'</td>
  			</tr>
  			<tr>
				<td colspan="2">Name, address and contact details of the destination</td>
  			</tr>
  			<tr>
    			<td colspan="2">
    		    <table class="table table-bordered table-responsive">
      		    <tr>
        			<td>Name</td>
        			<td>'.strtoupper($ew_transport_name).'</td>
                </tr>
                <tr>
        			<td >Street Name 1</td>
        			<td>'.strtoupper($ew_transport_sn1).'</td>
      		    </tr>
      		    <tr>
        			<td>Street Name 2</td>
        			<td>'.strtoupper($ew_transport_sn2).'</td>
               </tr>
                <tr>   
        			<td>Village/Town</td>
        			<td>'.strtoupper($ew_transport_vt).'</td>
      		    </tr>
      		    <tr>
        			<td>District</td>
        			<td>'.strtoupper($ew_transport_dist).'</td>
               </tr>
                <tr>
        			<td >Pincode</td>
        			<td>'.strtoupper($ew_transport_pin).'</td>
      		    </tr>
      		    <tr>
        			<td>Mobile</td>
        			<td>+91&nbsp;'.strtoupper($ew_transport_mob).'</td>
                </tr>
                <tr>
        			<td>Phone Number</td>
        			<td>'.strtoupper($ew_transport_phn1).'&nbsp;'.strtoupper($ew_transport_phn2).'</td>
      		    </tr>
    			</table>
    		    </td>
			</tr>
  			</table>
  		</td>
  	</tr>	
  	<tr>
  		<td>8. Types & Quantity of e-waste refurbished<sup>*</sup></td>
  		<td>	
  			<table class="table table-bordered table-responsive">
  			<tr>
  				<td>Category</td>
  				<td>'.strtoupper($ew_refur_cat).'</td>
            </tr>
            <tr>
  				<td>Quantity</td>
  				<td>'.strtoupper($ew_refur_qty).'</td>
  			</tr>
            <tr>
				<td>Item Description</td>  	
  				<td>'.strtoupper($ew_refur_item).'</td>
  			</tr>
  			
  			<tr>
				<td colspan="2">Name, address and contact details of the destination of refurbished materials.</td>
  			</tr>
  			
  			<tr>
  				
    			<td colspan="2">
    		    <table class="table table-bordered table-responsive">
      		    <tr>
        			<td>Name</td>
        			<td>'.strtoupper($ew_refur_name).'</td>
                </tr>
                <tr>
        			<td >Street Name 1</td>
        			<td>'.strtoupper($ew_refur_sn1).'</td>
      		    </tr>
                 <tr>
        			<td>Street Name 2</td>
        			<td>'.strtoupper($ew_refur_sn2).'</td>
                </tr>
                <tr>
        			<td>Village/Town</td>
        			<td>'.strtoupper($ew_refur_vt).'</td>
      		    </tr>
      		    <tr>
        			<td>District</td>
        			<td>'.strtoupper($ew_refur_dist).'</td>
               </tr>
               <tr>
        			<td>Pincode</td>
        			<td>'.strtoupper($ew_refur_pin).'</td>
      		    </tr>
      		    <tr>
        			<td>Mobile</td>
        			<td>+91&nbsp;'.strtoupper($ew_refur_mob).'</td>
                </tr>
                <tr>
        			<td>Phone Number</td>
        			<td>'.strtoupper($ew_refur_phn1).'&nbsp;'.strtoupper($ew_refur_phn2).'</td>
      		    </tr>
      		    </table>
    		    </td>
			</tr>
  			</table>
  		</td>
  	</tr>  		
    <tr>  		
  		<td>9. Types & Quantity of e-waste dismantled<sup>*</sup></td>
  		<td>	
  			<table class="table table-bordered table-responsive">
  			<tr>
  				<td>Category</td>
  				<td>'.strtoupper($ew_dismant_cat).'</td>
            </tr>
            <tr>
  				<td>Quantity</td>
  				<td>'.strtoupper($ew_dismant_qty).'</td>
  			</tr>
  			<tr>
				<td>Item Description</td>  	
  				<td>'.strtoupper($ew_dismant_item).'</td>
  			</tr>
  			<tr>
				<td colspan="2">Name, address and contact details of the destination</td>
  			</tr>
  			<tr>
  				<td colspan="2">
    		    <table class="table table-bordered table-responsive">
      		    <tr>
        			<td>Name</td>
        			<td>'.strtoupper($ew_dismant_name).'</td>
                </tr>
                <tr>
        			<td>Street Name 1</td>
        			<td>'.strtoupper($ew_dismant_sn1).'</td>
      		    </tr>
           		<tr>
        			<td>Street Name 2</td>
        			<td>'.strtoupper($ew_dismant_sn2).'</td>
                </tr>
                <tr>
        			<td>Village/Town</td>
        			<td>'.strtoupper($ew_dismant_vt).'</td>
      		    </tr>
      		    <tr>
        			<td>District</td>
        			<td>'.strtoupper($ew_dismant_dist).'</td>
                </tr>
                <tr>
        			<td height="29">Pincode</td>
        			<td>'.strtoupper($ew_dismant_pin).'</td>
      		    </tr>
      		    <tr>
        			<td>Mobile</td>
        			<td>+91&nbsp;'.strtoupper($ew_dismant_mob).'</td>
                </tr>
                <tr>
        			<td>Phone Number</td>
        			<td>'.strtoupper($ew_dismant_phn1).'&nbsp;'.strtoupper($ew_dismant_phn2).'</td>
      		    </tr>
    			</table>
    		</td>
			</tr>
  			</table>
  		</td>
  	</tr>  	
  	<tr>
  		<td>10. Types & Quantity of e-waste recycled</td>
  		<td>	
  			<table class="table table-bordered table-responsive">
  			<tr>
  				<td>Category</td>
  				<td>'.strtoupper($ew_recycle_cat).'</td>
            </tr>
            <tr>
  				<td>Quantity</td>
  				<td>'.strtoupper($ew_recycle_qty1).'</td>
  			</tr>
  			<tr>
				<td>Item Description</td>  	
  				<td>'.strtoupper($ew_recycle_item).'</td>
  			</tr>
  			<tr>
				<td colspan="2">Name, address and contact details of the destination</td>
  			</tr>
  			<tr>
    		   <td colspan="2">
    		   <table class="table table-bordered table-responsive">
      		   <tr>
        			<td>Name</td>
        			<td>'.strtoupper($ew_recycle_name).'</td>
                </tr>
                <tr>
        			<td>Street Name 1</td>
        			<td>'.strtoupper($ew_recycle_sn1).'</td>
      		    </tr>
      		
      		    <tr>
        			<td>Street Name 2</td>
        			<td>'.strtoupper($ew_recycle_sn2).'</td>
                </tr>
                <tr>
        			<td>Village/Town</td>
        			<td>'.strtoupper($ew_recycle_vt).'</td>
      		   </tr>
      		    <tr>
        			<td>District</td>
        			<td>'.strtoupper($ew_recycle_dist).'</td>
                </tr>
                <tr>
        			<td >Pincode</td>
        			<td>'.strtoupper($ew_recycle_pin).'</td>
      		    </tr>
      		
      		    <tr>
        			<td>Mobile</td>
        			<td>+91&nbsp;'.strtoupper($ew_recycle_mob).'</td>
                </tr>
                <tr>
        			<td>Phone Number</td>
        			<td>'.strtoupper($ew_recycle_phn1).'&nbsp;'.strtoupper($ew_recycle_phn2).'</td>
      		   </tr>
      		   </table>
    		</td>
			</tr>
			</table>
  		</td>
  	</tr>  
  	<tr>
  		<td>11. Types & Quantity of materials recovered</td>
  		<td>	
  			<table class="table table-bordered table-responsive">
  			<tr>
  				<td>Category</td>
  				<td>'.strtoupper($ew_recover_cat).'</td>
            </tr>
            <tr>
  				<td>Quantity</td>
  				<td>'.strtoupper($ew_recover_qty).'</td>
  			</tr>
  			<tr>
				<td>Item Description</td>  	
  				<td>'.strtoupper($ew_recover_item).'</td>
  			</tr>
  			</table>
  		</td>
  	</tr>
  	<tr>
  		<td>12. Types & Quantity of e-waste treated & disposed</td>
  		<td>	
  			<table class="table table-bordered table-responsive">
  			<tr>
  				<td>Category</td>
  				<td>'.strtoupper($ew_treated_cat).'</td>
            </tr>
            <tr>
  				<td>Quantity</td>
  				<td>'.strtoupper($ew_treated_qty).'</td>
  			</tr>
  			<tr>
				<td>Item Description</td>  	
  				<td>'.strtoupper($ew_treated_item).'</td>
  			</tr>
  			</table>
  		</td>
  	</tr>';
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.' 
		
  	 <tr>  		
  		<td colspan="2"></td>
  	</tr>
  	 <tr>  		
			<td>Place : <b>'.strtoupper($dist).'</b><br/>
			Date : <b>'.strtoupper($results["sub_date"]).'</b></td>
			<br/>
			<td align="right"><b>'.strtoupper($key_person).'</b><br/>Signature of the Authorized Person</td>	
  	</tr>
</table>';
?>