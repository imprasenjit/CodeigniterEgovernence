<?php
$dept="labour";
$form="2";
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
		$nature_work=$results["nature_work"];$father_name=$results["father_name"];  $max_workers=$results["max_workers"];$nature_w_emp=$results["nature_w_emp"];        
		if(!empty($results["manager"])){
			$manager=json_decode($results["manager"]);
			$manager_name=$manager->name;$manager_sn1=$manager->sn1;$manager_sn2=$manager->sn2;$manager_v=$manager->v;$manager_d=$manager->d;$manager_pin=$manager->pin;            
		}else{
			$manager_name="";$manager_sn1="";$manager_sn2="";$manager_v="";$manager_d="";$manager_pin="";
		}   
		
		/*if(!empty($results["enclose"])){
			$enclose=json_decode($results["enclose"]);
			$enclose_treasury=$enclose->treasury;$enclose_amount=$enclose->amount;$enclose_date=$enclose->date;
		}else{
			$enclose_treasury="";$enclose_amount="";$enclose_date="";
		} */
    }
    $nature_work = wordwrap($results["nature_work"], 40, "<br/>", true);
    $form_name=$cms->query("select form_name from labour_form_names where form_no='2'")->fetch_object()->form_name;    
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
	<br/>
        '.$assamSarkarLogo.'<h4>'.$form_name.'</h4>
        </div><br/>
            <table width="99%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
                <tr>
                    <td width="50%"> 1.(a) Name of the Establishment</td>
                    <td colspan="2">'.strtoupper($unit_name).'</td>
                </tr>
				
                <tr>
                    <td width="40%" rowspan="5" valign="top"> &nbsp;&nbsp;&nbsp;(b) Location of the Establishment </td>
					<td width="25%">Street Name 1 </td>
                    <td width="25%">'.strtoupper($b_street_name1).'</td>
                </tr>
				<tr>
                                <td>Street Name 2 </td>
                                <td>'.strtoupper($b_street_name2).'</td>
                </tr>
                <tr>
                                <td>Vilage/Town </td>
                                <td>'.strtoupper($b_vill).'</td>
                </tr>
                <tr>
                                <td>District </td>
                                <td>'.strtoupper($b_dist).'</td>
                </tr>
                <tr>
                                <td>Pin Code </td>
                                <td>'.strtoupper($b_pincode).'</td>
                </tr>
                       
                <tr>
                    <td valign="top" rowspan="5">2. Postal address of the Establishment(Alternate Address)</td>
                  
                    <td>Street Name 1 </td>
                    <td>'.strtoupper($b_street_name3).'</td>
                </tr>
                <tr>
                                <td>Street Name 2 </td>
                                <td>'.strtoupper($b_street_name4).'</td>
                </tr>
                <tr>
                                <td>Vilage/Town </td>
                                <td>'.strtoupper($b_vill2).'</td>
                </tr>
                <tr>
                                <td>District </td>
                                <td>'.strtoupper($b_dist2).'</td>
                </tr>
                <tr>
                                <td>Pin Code </td>
                                <td>'.strtoupper($b_pincode2).'</td>
                </tr>
				

				<tr>
                    <td valign="top" rowspan="7">3. Full name and address of the Principal Employer (furnish father&apos;s name in the case of individuals).</td>
					<td>Full Name </td>
                    <td>'.strtoupper($key_person).'</td>
                </tr>
				<tr>
                                <td>Father&apos;s Name </td>
                                <td>'.strtoupper($father_name).'</td>
                </tr>
				<tr>
                                <td>Street Name 1 </td>
                                <td>'.strtoupper($street_name1).'</td>
                </tr>
                <tr>
                                <td>Street Name 2 </td>
                                <td>'.strtoupper($street_name2).'</td>
                </tr>
                <tr>
                                <td>Vilage/Town </td>
                                <td>'.strtoupper($vill).'</td>
                </tr>
                <tr>
                                <td>District </td>
                                <td>'.strtoupper($dist).'</td>
                </tr>
                <tr>
                                <td>Pin Code </td>
                                <td>'.strtoupper($pincode).'</td>
                </tr>
									
				<tr>
                    <td valign="top" rowspan="6">4.	Full name and address of the Manager or person responsible for the supervision and Control of the establishment. </td>
					<td>Full Name </td>
					<td>'.strtoupper($manager_name).'</td>
                </tr>
							<tr>
                                <td>Street Name 1 </td>
                                <td>'.strtoupper($manager_sn1).'</td>
                            </tr>
                            <tr>
                                <td>Street Name 2 </td>
                                <td>'.strtoupper($manager_sn2).'</td>
                            </tr>
                            <tr>
                                <td>Vilage/Town </td>
                                <td>'.strtoupper($manager_v).'</td>
                            </tr>
                            <tr>
                                <td>District </td>
                                <td>'.strtoupper($manager_d).'</td>
                            </tr>
                            <tr>
                                <td>Pin Code </td>
                                <td>'.strtoupper($manager_pin).'</td>
                    
                </tr>  
				
              
                 <tr>
                    <td  valign="top">5. Nature of work carried on in the Establishment. </td>
                    <td colspan="2">'.strtoupper($nature_work).'</td>
                </tr>
                 <tr>
                    <td  valign="top">6. Nature of work in which contract labour is employed or is to be employed.		 </td>
                    <td colspan="2">'.strtoupper($nature_w_emp).'				</td>
                </tr>
                 <tr>
                    <td  valign="top">7. Maximum no. of Contract Labour to be employed in the Establishment on any day (through all the contractors).</td>
                    <td colspan="2">	'.strtoupper($max_workers).'			</td>
                </tr>';
		
			$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
			$printContents=$printContents.' 
        		    
        <tr>
			<td valign="top" rowspan="2">Signatures and Dates:  </td>
            <td width="30%">Signature of Principal Employment  :</td>
            <td>'.strtoupper($key_person).'</td>
        </tr>
        <tr>
            <td>Date : </td>
            <td> '.date('d-m-Y',strtotime($results["sub_date"])).'</td>
        </tr> 
 </table>';
?>

