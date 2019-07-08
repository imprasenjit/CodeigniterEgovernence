<?php
$dept="labour";
$form="11";
$table_name=$formFunctions->getTableName($dept,$form);

if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
		echo "<script>
				alert('Invalid Page Access');
		</script>";	
		die();
	}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
		$form_id=$_GET["ui"];
		$q=$labour->query("select * from ".$table_name." where user_id='$swr_id' and form_id='$form_id'") or die($labour->error);
	}else if(isset($_GET["uain"])){
		$uain=$_GET["uain"];
		$q=$labour->query("select * from ".$table_name." where uain='$uain' and user_id='$swr_id'") or die($labour->error);
	}else if(isset($form_id)){
		$form_id=$form_id;
		$q=$labour->query("select * from ".$table_name." where user_id='$swr_id' and form_id='$form_id'") or die($labour->error);
	}else{
		$q=$labour->query("select * from ".$table_name." where user_id='$swr_id' and active='1'") or die($labour->error);
	}
		
    $row1=$formFunctions->fetch_swr($swr_id);
    $email=$formFunctions->get_usermail($swr_id);
        $key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
        $b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];
        $b_street_name3=$row1['b_street_name3'];$b_street_name4=$row1['b_street_name4'];$b_vill2=$row1['b_vill2'];$b_dist2=$row1['b_dist2'];$b_block2=$row1['b_block2'];$b_pincode2=$row1['b_pincode2'];
        $from=$key_person."<br/>Address : ".$street_name1." ".$street_name2."<br/>Vill/Town : ".$vill.",".$dist."<br/>Pin Code : ".$pincode."<br/>Mobile Number : +91 ".$mobile_no;
        $unit_details=$unit_name."\n".$b_street_name1."  ".$b_street_name2."\nVill/Town :".$b_vill." , ".$b_dist."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;

		
		if($q->num_rows>0){	
			$results=$q->fetch_assoc();
			$form_id=$results['form_id'];	
			$prev_lic_date=$results["prev_lic_date"];$is_suspended=$results["is_suspended"];$max_workers=$results["max_workers"];
			
			if(!empty($results["contractor"]))
			{
				$contractor=json_decode($results["contractor"]);
				$contractor_sn1=$contractor->sn1;$contractor_sn2=$contractor->sn2;$contractor_v=$contractor->v;$contractor_d=$contractor->d;$contractor_pin=$contractor->pin;
			}
			else
			{
				$contractor_sn1="";$contractor_sn2="";$contractor_v="";$contractor_d="";$contractor_pin="";
			}
			if(!empty($results["license"]))
			{
				$license=json_decode($results["license"]);
				$license_no=$license->no;$license_dt=$license->dt;
			}
			else
			{
				$license_no="";$license_dt="";
			}
    }
    if($results["is_suspended"]=="Y"){
		$is_suspended="YES";
	}else{
		$is_suspended="NO";
	}
	
    //$nature_work = wordwrap($results["nature_work"], 40, "<br/>", true);
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
</style>
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
                '.$assamSarkarLogo.'<h4>'.$form_name.'</h4><br/>
       </div> 
             <table width="100%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
                <tr >
                    <td valign="top" width="50%"> 1.Name and address of the Contractor.</td>
                    <td>'.strtoupper($from).'</td>
                </tr>
                
                   <tr>
                     <td valign="top">2.Number and Date of the License </td>
					</tr>
					<tr>
						<td>Number </td>
						<td>'.strtoupper($license_no).'</td>
					</tr>
				
					<tr>
						<td>Date </td>
						<td>'.strtoupper($license_dt).'</td>
                </tr> 
                 <tr>
                    <td  valign="top">3. Date of expiry of the previous license. </td>
                    <td>'.strtoupper($prev_lic_date).'</td>
                </tr>
                 <tr>
                    <td  valign="top">4. Whether the license of the contractor was suspended or revoked.  </td>
                    <td>'.strtoupper($is_suspended).'</td>
                </tr>
                 <tr>
                    <td  valign="top">5. No. of workers employed on any day. </td>
                    <td>'.strtoupper($results["max_workers"]).'</td>
                </tr>
				
			';
		
			$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
			$printContents=$printContents.'   
        <tr>
            
            <td colspan="2">
              <table border="1" width="100%" style="margin:0px auto;border-collapse: collapse" class="table table-bordered table-responsive">
                     <tr>
                        <td valign="top" colspan="4"><br/><br/>Signatures and Dates:  </td>
                     </tr>
                    <tr>
                            <td>Date : '.date('d-m-Y',strtotime(($results["sub_date"]))).'</td>
							<td align="right">'.strtoupper($key_person).'</td>
                       </tr>
					   <tr>
                            <td>Place : '.strtoupper($dist).'</td>
                            <td align="right">Signature of the Applicant (Contractor)</td>
                       </tr>                  
                    </tbody>
                </table>
           </td>
        </tr>		
    </tbody>
</table>';
?>