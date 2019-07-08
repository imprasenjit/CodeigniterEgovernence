<?php

	if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
		echo "<script>
				alert('Invalid Page Access');
		</script>";	
		die();
	}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
		$form_id=$_GET["ui"];
		$q=$land->query("select * from land_form2 where user_id='$swr_id' and form_id='$form_id'") or die($land->error);
	}else if(isset($_GET["uain"])){
		$uain=$_GET["uain"];
		$q=$land->query("select * from land_form2 where uain='$uain' and user_id='$swr_id'") or die($land->error);
	}else if(isset($form_id)){
		$form_id=$form_id;
		$q=$land->query("select * from land_form2 where user_id='$swr_id' and form_id='$form_id'") or die($land->error);
	}else{
		$q=$land->query("select * from land_form2 where user_id='$swr_id' and active='1'") or die($land->error);
	} 
    
        $row1=$formFunctions->fetch_swr($swr_id);
        $key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];$revenue=$row1['revenue'];$pattano=$row1['pattano'];$dagno=$row1['dagno'];
        $b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];
        $b_street_name3=$row1['b_street_name3'];$b_street_name4=$row1['b_street_name4'];$b_vill2=$row1['b_vill2'];$b_dist2=$row1['b_dist2'];$b_block2=$row1['b_block2'];$b_pincode2=$row1['b_pincode2'];
        $from=$key_person."<br/>Address : ".$street_name1." ".$street_name2."<br/>Vill/Town : ".$vill.",".$dist."<br/>Pin Code : ".$pincode."<br/>Mobile Number : +91 ".$mobile_no;
        $unit_details=$unit_name."\n".$b_street_name1."  ".$b_street_name2."\nVill/Town :".$b_vill." , ".$b_dist."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
        $q=$land->query("select * from land_form2 where user_id=$swr_id") or die($land->error);

		$q=$land->query("select * from land_form2 where user_id=$swr_id and active='1'") or die($land->error);
		$results=$q->fetch_assoc();
        if($q->num_rows>0){
            $form_id=$results['form_id'];   
            $father_name=$results["father_name"];$police_station=$results["police_station"];$post_office=$results["post_office"];$pattadar_name=$results["pattadar_name"];$pattadar_fname=$results["pattadar_fname"];$is_ownership=$results["is_ownership"];$area_land=$results["area_land"];$p_date=$results["p_date"];$total_land=$results["total_land"];$add_info=$results["add_info"];$remarks=$results["remarks"];
        
            
            $file1=$results["file1"];$file2=$results["file2"];$file3=$results["file3"];$file4=$results["file4"];

        if($is_ownership=="D"){
            $is_ownership="Deed Mutation(Gift/Sale/Others)";
        }else{
            $is_ownership="Inheritance Mutation";
        } 

        if(!isset($css)){
            $val1=$formFunctions->get_uploadFile($file1);
            $val2=$formFunctions->get_uploadFile($file2);
            $val3=$formFunctions->get_uploadFile($file3);
            $val4=$formFunctions->get_uploadFile($file4);
            
        }else{
            $val1=$formFunctions->get_useruploadFile($file1,$applicant_id);
            $val2=$formFunctions->get_useruploadFile($file2,$applicant_id);
            $val3=$formFunctions->get_useruploadFile($file3,$applicant_id);
            $val4=$formFunctions->get_useruploadFile($file4,$applicant_id);
        }
		if(!empty($results["courier_details"]) && $results["courier_details"]!=1){
            $courier_details=json_decode($results["courier_details"]);
            $courier_details_cn=$courier_details->cn;$courier_details_rn=$courier_details->rn;$courier_details_dt=$courier_details->dt;
          }else{
            $courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
          }
       
        $add_info= wordwrap($add_info, 40, "<br/>", true);
        $remarks= wordwrap($remarks, 40, "<br/>", true);
    }
     
    $form_name=$cms->query("select form_name from land_form_names where form_no='2'")->fetch_object()->form_name;    
	$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
if(!isset($css)){
$printContents='
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Form 2</title>
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
        '.$assamSarkarLogo.'<h4>FORM NO. 2</h4>
        <p  style="text-align:center"> Department: Revenue</p>
        <h4>'.$form_name.'</h4>
        </div><br/>
            <table width="99%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
                <tr>
                    <td> Applicant&apos;s Name</td>
                    <td>'.strtoupper($key_person).'</td>
				</tr>
				<tr>
                    <td>Mobile Number</td>
                    <td>'.strtoupper($mobile_no).'</td>
                </tr>
				<tr>
                    <td>Father&apos;s Name</td>
                    <td>'.strtoupper($father_name).'</td>                    
                </tr>
                <tr>
                    <td colspan="2"><strong>Address Details</strong></td>
                </tr>
                <tr>
					<td >Street Name 1 </td>
                    <td >'.strtoupper($b_street_name1).'</td>
				</tr>
				<tr>
                    <td>Street Name 2 </td>
                    <td>'.strtoupper($b_street_name2).'</td>
                </tr>
                <tr>
					<td>State </td>
					<td>ASSAM</td>
				</tr>
				<tr>
					<td>District </td>
					<td>'.strtoupper($b_dist).'</td>
                </tr>
                <tr>
					<td>Sub-Division </td>
					<td>'.strtoupper($b_vill).'</td>
				</tr>
				<tr>
					<td>Circle Office </td>
					<td>'.strtoupper($revenue).'</td>
                </tr>
                <tr>
					<td>Vilage/Town </td>
					<td>'.strtoupper($b_vill).'</td>
				</tr>
				<tr>
					<td>Police Station </td>
					<td>'.strtoupper($police_station).'</td>
                </tr>
                
                <tr>
					<td>Post Office</td>
					<td>'.strtoupper($post_office).'</td>
				</tr>
				<tr>
					<td>Pin Code </td>
					<td>'.strtoupper($b_pincode).'</td>
                </tr>
                       
                <tr>
                    <td colspan="2"><strong>Other Details</strong></td>
                </tr>
                <tr>                  
					<td>Patta No </td>
					<td>'.strtoupper($pattano).'</td>
				</tr>
				<tr>
					<td>Dag No </td>
					<td>'.strtoupper($dagno).'</td>
                </tr>
                <tr>
					<td>Pattadar Name </td>
					<td>'.strtoupper($pattadar_name).'</td>
				</tr>
				<tr>
					<td>Pattadar Father Name </td>
					<td>'.strtoupper($pattadar_fname).'</td>
                </tr>
                <tr>
					<td>Ownership got through</td>
					<td>'.strtoupper($is_ownership).'</td>
				</tr>
				<tr>
					<td>Area of Land (in sq. meter) </td>
					<td>'.strtoupper($area_land).'</td>
                </tr>
				<tr>
					<td>Date of Possession </td>
					<td>'.date('d-m-Y', strtotime($p_date)).'</td>
				</tr>
				<tr>
					<td>Total land of Applicant<br/> (in sq. meter) </td>
					<td>'.strtoupper($total_land).'</td>
                </tr>
                <tr>
					<td>Additional Information </td>
					<td>'.strtoupper($add_info).'</td>
                </tr>
                <tr>
					<td>Remarks </td>
					<td>'.strtoupper($remarks).'</td>                                
                </tr>';
			if($is_ownership=="D"){
            $printContents=$printContents.'
				<tr>
					<td colspan="2">
					<table border="0" width="100%">
						<tr><td colspan="2">Checklists. <br/>  * NA - Not Applicable   * SC - Send By Courier</td></tr>
						<tr><td width="50%">1. Scan Copy of Original  deed.</td><td >'.$val1.'</td></tr>
						<tr><td>2. Upto date Khajana ( Land revenue) Receipt.</td><td>'.$val2.'</td></tr>
						<tr><td>3. A Declaration as per Assam ceiling Act 1956 in Affidavit.</td><td>'.$val3.'</td></tr>  
						<tr><td>4. Scan copy of filled up downloadable eForm with Court fee stamp.</td><td>'.$val4.'</td></tr>
					</table>         
					</td>
				</tr>';
			}else{
				$printContents=$printContents.'
				<tr>
					<td colspan="2">
					<table border="0" width="100%">
						<tr><td colspan="2">Documents uploaded.   * NA - Not Applicable   * SC - Send By Courier</td></tr>						
						<tr><td width="50%">1. Affidavit (self-declaration) along with numbers of legal heir of the deceased and Legal heir Certificate</td><td >'.$val1.'</td></tr>
						<tr><td>2. Affidavit stating that “The land has not been sold or mortgage earlier”</td><td>'.$val2.'</td></tr>
						<tr><td>3. Upto date Khajana ( Land revenue) Receipt.</td><td>'.$val3.'</td></tr>  
						<tr><td>4. Scan copy of filled up downloadable e-Form with Court fee stamp.</td><td>'.$val4.'</td></tr>
					</table>         
					</td>
				</tr>';
			}
            if(!empty($results["courier_details"]) && $results["courier_details"]!=1){
            $printContents=$printContents.'
            <tr>           
            <td colspan="2">
                <table border="1" width="100%" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse">
                    <tr><td height="30px" colspan="2">Courier Details.</td></tr>
                    <tr><td width="50%">Name of Courier Service </td><td>'.strtoupper($courier_details_cn).'</td></tr>
                    <tr><td>Ref. No. / Consignment No. </td><td>'.strtoupper($courier_details_rn).'</td></tr>
                    <tr><td>Dispatch Date </td><td>'.strtoupper($courier_details_dt).'</td></tr>
                </table>
            </td>
            </tr>
            ';              
            }       
            $printContents=$printContents.'     
        <tr>            
            <td colspan="2" style="width:100%">
                <table width="100%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
                    <tbody>
                      <tr>
						<td rowspan="2" valign="top"><b>Signatures and Dates :</b></td>
						<td align="right">Signature of the Applicant : '.strtoupper($key_person).'<br/>
						Date : '.date('d-m-Y',strtotime(($results["sub_date"]))).'</td>
					</tr>
                     </tbody>
                </table>
            </td>
        </tr>        
    </tbody>
</table>
';
?>