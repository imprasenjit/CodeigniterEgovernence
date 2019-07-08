<?php
$dept="pcb";
$form="17";
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

$form_name=$formFunctions->get_formName($dept,$form);
//$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
if(!isset($css)){
$printContents='
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
  	    <h4>'.$form_name.'</h4><br/>  		
  			<p style="font-size:16px;font-weight:normal;text-align:center">[To be submitted by producer or manufacturer or refurbisher or dismantler or recycler by 30 th day of June following the financial year to which that return relates].</p>
  			Quantity in Metric Tonnes (MT) and numbers
  	</div>
		<table class="table table-bordered table-responsive">
  		    <tr>
                <td width="50%">1. Name and address of the producer or manufacturer or refurbisher or dismantler or recycler</td>
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
   			<td valign="top" >2.Name of the authorized person and complete address with telephone and fax numbers and e-mail address</td>
    		<td>
    		    <table class="table table-bordered table-responsive">
      		    <tr>
        			<td>Name</td>
        			<td>'.strtoupper($key_person).'</td>
      		    </tr>
      		    <tr>
        			<td>Street Name 1</td>
        			<td>'.strtoupper($street_name1).'</td>
      		    </tr>
      		    <tr>
        			<td>Street Name 2</td>
        			<td>'.strtoupper($street_name2).'</td>
      		    </tr>
      		    <tr>
        			<td>Village/Town</td>
        			<td>'.strtoupper($vill).'</td>
      		    </tr>
      		    <tr>
        			<td>District</td>
        			<td>'.strtoupper($dist).'</td>
      		    </tr>
      		    <tr>
        			<td >Pincode</td>
        			<td>'.strtoupper($pincode).'</td>
      		    </tr>
      		    <tr>
        			<td>Mobile</td>
        			<td>+91&nbsp;'.strtoupper($mobile_no).'</td>
      		    </tr>
      		    <tr>
        			<td>Phone Number</td>
        			<td>'.strtoupper($landline_std).'&nbsp;'.strtoupper($landline_no).'</td>
      		    </tr>
      		    <tr>
        			<td >Email-id</td>
        			<td>'.$email.'</td>
      		    </tr>
    		    </table>
    	    </td>
	    </tr>
  	    <tr>
  	        <td valign="top" >3.Total quantity e-waste sold/purchased/sent for processing during the year for each category of electrical and electronic equipment listed in the Schedule 1 </td>
			<td>Document is Attached</td>  	        
  	    </tr>
  	    <tr>
            <td colspan="4">           
                <table class="table table-bordered table-responsive">
				<thead>
                <tr>
					<th align="center"><b>Details of the above</b></th>
                    <th align="center"><b>TYPE</b></th>
                    <th align="center"><b>QUANTITY</b></th>
                    <th align="center"><b>No</b></th>
                </tr>
				</thead>
				<tbody>
					<tr>
						<td>3(A)<sup>*</sup><b>BULK CONSUMERS:</b> Quantity of e-waste</td>
						<td>'.strtoupper($total_qty_b_typ).'</td>
						<td>'.strtoupper($total_qty_b_qty).'</td>
						<td>'.strtoupper($total_qty_b_no).'</td>
					</tr>
					<tr>
						<td>3(B)<sup>*</sup><b>REFURBISHERS:</b> Quantity of e-waste</td>
						<td>'.strtoupper($total_qty_ref_typ).'</td>
						<td>'.strtoupper($total_qty_ref_qty).'</td>
						<td>'.strtoupper($total_qty_ref_no).'</td>
					</tr>
					<tr>
						<td colspan="4">3(C)<sup>*</sup><b>DISMANTLERS:</b></td>
					</tr>
					<tr>
						<td>i. Quantity of e-waste processed (Code wise)</td>
						<td>'.strtoupper($total_qty_d_typ1).'</td>
						<td>'.strtoupper($total_qty_d_qty1).'</td>
						<td>'.strtoupper($total_qty_d_no1).'</td>
					</tr>
					<tr>
						<td>ii. Details of materials or components recovered and sold</td>
						<td>'.strtoupper($total_qty_d_typ2).'</td>
						<td>'.strtoupper($total_qty_d_qty2).'</td>
						<td>'.strtoupper($total_qty_d_no2).'</td>
					</tr>
					<tr>
						<td>iii. Quantity of e-waste sent to recycler</td>
						<td>'.strtoupper($total_qty_d_typ3).'</td>
						<td>'.strtoupper($total_qty_d_qty3).'</td>
						<td>'.strtoupper($total_qty_d_no3).'</td>
					</tr>
					<tr>
						<td>iv. Residual quantity of e-waste sent to Treatment, Storage and Disposal Facility.</td>
						<td>'.strtoupper($total_qty_d_typ4).'</td>
						<td>'.strtoupper($total_qty_d_qty4).'</td>
						<td>'.strtoupper($total_qty_d_no4).'</td>
					</tr>
					<tr>
						<td colspan="4">3(D)<sup>*</sup><b>RECYCLERS:</b></td>
					</tr>
					<tr>
						<td>i. Quantity of e-waste processed (Code wise)</td>
						<td>'.strtoupper($total_qty_r_typ1).'</td>
						<td>'.strtoupper($total_qty_r_qty1).'</td>
						<td>'.strtoupper($total_qty_r_no1).'</td>
					</tr>
					<tr>
						<td>ii.Details of materials recovered and sold in the market</td>
						<td>'.strtoupper($total_qty_r_typ2).'</td>
						<td>'.strtoupper($total_qty_r_qty2).'</td>
						<td>'.strtoupper($total_qty_r_no2).'</td>
					</tr>
					<tr>
						<td>iii.Details of residue sent to Treatment, Storage and Disposal Facility.</td>
						<td>'.strtoupper($total_qty_r_typ3).'</td>
						<td>'.strtoupper($total_qty_r_qty3).'</td>
						<td>'.strtoupper($total_qty_r_no3).'</td>
					</tr>
				</tbody>
                </table>
            </td>   
        </tr> 
  	    <tr>
  		    <td valign="top" >4. Name and full address of the destination with respect to 3(A)-3(D) above</td>
    		  <td>
    		  <table class="table table-bordered table-responsive">
      		<tr>
        			<td>Name</td>
        			<td>'.strtoupper($destn_add_name).'</td>
      		</tr>      		
      		<tr>
        			<td>Street Name 1</td>
        			<td>'.strtoupper($destn_add_sn1).'</td>
      		</tr>
      		<tr>
        			<td>Street Name 2</td>
        			<td>'.strtoupper($destn_add_sn2).'</td>
      		</tr>
      		<tr>
        			<td>Village/Town</td>
        			<td>'.strtoupper($destn_add_vt).'</td>
      		</tr>
      		<tr>
        			<td>District</td>
        			<td>'.strtoupper($destn_add_dist).'</td>
      		</tr>
      		<tr>
        			<td>Pincode</td>
        			<td>'.strtoupper($destn_add_pin).'</td>
      		</tr>
      		<tr>
        			<td>Mobile</td>
        			<td>+91&nbsp;'.strtoupper($destn_add_mob).'</td>
      		</tr>
      		<tr>
        			<td>Phone Number</td>
        			<td>'.strtoupper($destn_add_std).'&nbsp;'.strtoupper($destn_add_phn_no).'</td>
      		</tr>
    		</table>
    	    </td>
  	    </tr>
  	    <tr>
  		    <td valign="top" colspan="2">5. Type and quantity of materials segregated or recovered from e-waste of different codes as applicable to 3(A)-3(D)</td>
        </tr>
        <tr>
  		     <td>Type</td>
             <td>'.strtoupper($mat_seg_rcvr_typ).'</td>
        </tr>
        <tr>
             <td>Quantity</td>
             <td>'.strtoupper($mat_seg_rcvr_qty).'</td>
  	    </tr>
  	    <tr>
  		   <td valign="top" colspan="2"><b>Note:</b></td>
  	    </tr>
  	   ';				
			$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
			$printContents=$printContents.' 

  	 <tr>  		
  		<td valign="top">Place : <b>'.strtoupper($dist).'</b><br/>
  		Date : <b>'.strtoupper($results["sub_date"]).'</b></td>
  		<br/>
  		<td align="right" ><b>'.strtoupper($key_person).'</b><br/>Signature of the Authorized person</td>
    </tr>
    </table>
  	';
?>