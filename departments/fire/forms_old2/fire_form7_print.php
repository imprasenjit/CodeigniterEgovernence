<?php
	if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
		echo "<script>
				alert('Invalid Page Access');
		</script>";	
		die();
	}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
		$form_id=$_GET["ui"];
		$q=$fire->query("select * from fire_form7 where user_id='$swr_id' and form_id='$form_id'") or die($fire->error);
	}else if(isset($_GET["uain"])){
		$uain=$_GET["uain"];
		$q=$fire->query("select * from fire_form7 where uain='$uain' and user_id='$swr_id'") or die($fire->error);
	}else if(isset($form_id)){
		$form_id=$form_id;
		$q=$fire->query("select * from fire_form7 where user_id='$swr_id' and form_id='$form_id'") or die($fire->error);		
	}else{
		$q=$fire->query("select * from fire_form7 where user_id='$swr_id' and active='1'") or die($fire->error);
	}
	if(!isset($css)){
		$email=$formFunctions->get_usermail($applicant_id);
	}else{
		$email=$formFunctions->get_usermail($sid);
	}
    $row1=$formFunctions->fetch_swr($swr_id);
		$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
		$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];$ownername=$row1["Name_of_owner"];
		//$sql=$fire->query("select * from fire_form7 where user_id=$swr_id");
    $row=$q->fetch_array();
    $form_id=$row["form_id"];$sub_date=$row["sub_date"];$p_o_name=$row['p_o_name'];
	if(empty($row['p_o_addr'])==false){
	$p_o_addr=json_decode($row['p_o_addr']);$p_o_addr_s1=$p_o_addr->s1;$p_o_addr_s2=$p_o_addr->s2;$p_o_addr_vt=$p_o_addr->vt;$p_o_addr_blk=$p_o_addr->blk;
			$p_o_addr_dist=$p_o_addr->dist;$p_o_addr_pin=$p_o_addr->pin;
			}
			
			if(empty($row['s_properties'])==false){
				$s_properties=json_decode($row['s_properties']);
				$s_properties_e=$s_properties->e;
				$s_properties_w=$s_properties->w;
				$s_properties_n=$s_properties->n;
				$s_properties_s=$s_properties->s;
            }
			if(empty($row['o_s_a_storage'])==false){
				$o_s_a_storage=json_decode($row['o_s_a_storage']);
				$o_s_a_storage_e=$o_s_a_storage->e;
				$o_s_a_storage_w=$o_s_a_storage->w;
				$o_s_a_storage_n=$o_s_a_storage->n;
				$o_s_a_storage_s=$o_s_a_storage->s;
			}
			if(empty($row['sl_c_details'])==false){
				$sl_c_details=json_decode($row['sl_c_details']);
				$sl_c_details_s=$sl_c_details->s;
			}
$ms="";$hsd="";$sk="";$fo="";
    
	$quantity_stored=$row['quantity_stored'];
	$type_of_storage=$row['type_of_storage'];
	if($type_of_storage=='Above the Ground'){$type_of_storage="Above the Ground";}else if($type_of_storage=='Under Ground'){$type_of_storage="Under Ground";}

		
		if(!empty($sl_c_details)){
		$sl_c_details=json_decode($row["sl_c_details"]);$sl_c_details_s=$sl_c_details->s;
		}
    $sql1=$fire->query("select * from fire_form7_docs where form_id='$form_id'");
    $rows=$sql1->fetch_array();
		
       if(!isset($css)){
     $val1=$formFunctions->get_uploadFile($rows["file1"]);
      $val2=$formFunctions->get_uploadFile($rows["file2"]);
      $val3=$formFunctions->get_uploadFile($rows["file3"]);
      $val4=$formFunctions->get_uploadFile($rows["file4"]);
    }else{
      $val1=$formFunctions->get_useruploadFile($rows["file1"],$applicant_id);
      $val2=$formFunctions->get_useruploadFile($rows["file2"],$applicant_id);
      $val3=$formFunctions->get_useruploadFile($rows["file3"],$applicant_id);
      $val4=$formFunctions->get_useruploadFile($rows["file4"],$applicant_id);
     
      
    }
        if(!empty($row["courier_details"])&& $row["courier_details"]!=1){
        $courier_details=json_decode($row["courier_details"]);
        $courier_details_cn=$courier_details->cn;$courier_details_rn=$courier_details->rn;$courier_details_dt=$courier_details->dt;
      }else{
        $courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
      }
 $form_name=$formFunctions->get_formName('fire','7');
 $assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
if(!isset($css)){
$printContents='
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Form - VII</title>
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
if(!empty($row["uain"])){
      $printContents=$printContents.'<p style="text-align:right;padding:20px 20px 0 0;">UAIN : '.strtoupper($row["uain"]).'</p>';
    }
    $printContents=$printContents.'<div style="text-align:center">
        '.$assamSarkarLogo.'<h4>FORM - VII</h4>
        <h4>FORM OF APPLICATION FOR "NO OBJECTION CERTIFICATE (NOC)" IN RESPECT OF FIRE SAFETY MEASURES IN '.$form_name.' UNDER &lsquo;ASSAM FIRE SERVICE RULES 1989&rsquo;</h4>
        </div><br/>
  <table width="99%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1" >  
      <tr><td width="100%">
        <table width="100%" border="0" class="table table-bordered table-responsive" cellpadding="10" style="text-align:top;border-collapse:collapse;">
          <tr>
            <td width="5%" valign="top">To,</td>
      <td width="95%">
              <br>The Director,<br>Fire & Emergency Services, Assam<br>Through proper channel
            </td>
          </tr>
		<tr><td width="5%" valign="top">Sir,<br/></td>
			<td width="95%">
				<br/>I/We, &nbsp;'.strtoupper($key_person).'&nbsp; on behalf of &nbsp;
'.strtoupper($ownername).'&nbsp;apply for N.O.C. in respect of Fire Prevention & Fire Safety Measures under "Assam Fire Service Rules 1989" for the purpose of Existing/ Proposed storage &amp; handling of petroleum products(class-a, class-b and class-c). Required documents/information as per formate furnished below.
</p>
<p>&nbsp;</p>
		</td>
	</tr>
	</table>
<p>&nbsp;</p>
</td>
</tr>
<tr><td width="100%">
<table width="100%" border="1" class="table table-bordered table-responsive" style="text-align:top;border-collapse:collapse;">
<tr>
<td width="50%" valign="top">1. Name and address of the Applicant</td>
<td>
	<table width="100%" border="1" class="table table-bordered table-responsive" style="text-align:top;border-collapse:collapse;">
      <tr>
        <td width="20%">Name</td>
        <td>'.strtoupper($row1['Key_person']).'</td>
      </tr>

      <tr>
        <td valign="top">Address</td>
        <td><table width="100%" border="1" cellspacing="0" cellpadding="2" style="text-align:top;border-collapse:collapse;" class="table table-bordered table-responsive">
          <tr>
            <td width="50%">Street Name 1</td>
            <td>'.strtoupper($row1['Street_name1']).'</td>
          </tr>
          <tr>
            <td>Street Name 2</td>
            <td>'.strtoupper($row1['Street_name2']).'</td>
          </tr>
          <tr>
            <td>Village/Town</td>
            <td>'.strtoupper($row1['Vill']).'</td>
          </tr>
			<tr>
            <td>State</td>
            <td>'.strtoupper($row1['block']).'</td>
          </tr>
          <tr>
            <td>District</td>
            <td>'.strtoupper($row1['Dist']).'</td>
          </tr>
          <tr>
            <td>Pincode</td>
            <td>'.$row1['Pincode'].'</td>
          </tr>
        </table>
	</td>
      </tr>
    </table>
</td>
</tr>
</table>
</td>
</tr>

<tr><td width="100%">
<table width="100%" border="1" style="text-align:top;border-collapse:collapse;" class="table table-bordered table-responsive">
<tr>
<td width="50%" valign="top">2. Name and Address of the owner of the premises</td>
<td>
	<table width="100%" border="1" style="text-align:top;border-collapse:collapse;" class="table table-bordered table-responsive">
      <tr>
        <td width="20%">Name</td>
        <td>'.strtoupper($row['p_o_name']).'</td>
      </tr>

      <tr>
        <td valign="top">Address</td>
        <td><table width="100%" style="text-align:top;border-collapse:collapse;"  border="1" cellspacing="0" cellpadding="2" class="table table-bordered table-responsive">
          <tr>
            <td width="50%">Street Name 1</td>
            <td>'.strtoupper($p_o_addr->s1).'</td>
          </tr>
          <tr>
            <td>Street Name 2</td>
            <td>'.strtoupper($p_o_addr->s2).'</td>
          </tr>
          <tr>
            <td>Village/Town</td>
            <td>'.strtoupper($p_o_addr->vt).'</td>
          </tr>
	 <tr>
            <td>Block</td>
            <td>'.strtoupper($p_o_addr->blk).'</td>
          </tr>
          <tr>
            <td>District</td>
            <td>'.strtoupper($p_o_addr->dist).'</td>
          </tr>
          <tr>
            <td>PIN</td>
            <td>'.strtoupper($p_o_addr->pin).'</td>
          </tr>
        </table>
	</td>
      </tr>
    </table>
</td>
</tr>
</table>
</td>
</tr>
<tr><td width="100%">
<table width="100%" border="1" style="text-align:top;border-collapse:collapse;" class="table table-bordered table-responsive">
	<tr>
		<td width="50%" valign="top">3. Address of the premises</td>
		<td>
			<table width="100%" border="1" style="border-collapse:collapse;" class="table table-bordered table-responsive">
			<tr>
				<td width="50%">Street Name 1</td>
				<td>'.strtoupper($b_street_name1).'</td>
			</tr>
			<tr>
				<td>Street Name 2</td>'.strtoupper($key_person).'
				<td>'.strtoupper($b_street_name2).'</td>
			</tr>
			<tr>
				<td>Village/Town</td>
				<td>'.strtoupper($b_vill).'</td>
			</tr>
			<tr>
				<td>Block</td>
				<td>'.strtoupper($b_block).'</td>
			</tr>
			<tr>
				<td>District</td>
				<td>'.strtoupper($b_dist).'</td>
			</tr>
			<tr>
				<td>PIN</td>
				<td>'.$b_pincode.'</td>
			</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td width="50%" valign="top">4. Contact numbers of the applicant/occupier/owner</td>
		<td>Landline No: '.$landline_std.'-'.$landline_no.'
		<br>
		Mobile No: +91-'.$mobile_no.'
		</td>
	</tr>
	</table>
	</td>
  </tr>
</table>

</td>
</tr>

<tr><td>
<table width="100%" border="1" style="text-align:top;border-collapse:collapse;" class="table table-bordered table-responsive">
  <tr>
    <td width="50%">5. Classification of petroleum product</td>
    <td>'.strtoupper($row['product_clasification']).'</td>
  </tr>
</table>
</td>
</tr>

<tr><td>
<table width="100%" border="1" style="text-align:top;border-collapse:collapse;" class="table table-bordered table-responsive">
  <tr>
    <td width="50%">6. Quantity proposed to be Stored</td>
    <td>'.strtoupper($quantity_stored).'</td>
  </tr>
</table>
</td>
</tr>

<tr><td>
<table width="100%" style="text-align:top;border-collapse:collapse;" border="1" class="table table-bordered table-responsive">
  <tr>
    <td width="50%">7. Type of the Storage</td>
    <td>
	'.strtoupper($type_of_storage).'
    </td>
  </tr>
</table>
</td>
</tr>

<tr><td>
<table width="100%" style="text-align:top;border-collapse:collapse;" border="1" class="table table-bordered table-responsive">
  <tr>
    <td width="50%">8. Flash points of the product proposed to be Stored</td>
    <td>
	'.strtoupper($row['flash_point']).'
    </td>
  </tr>
</table>
</td>
</tr>

<tr><td>
<table width="100%" style="text-align:top;border-collapse:collapse;" border="1" class="table table-bordered table-responsive">
  <tr>
    <td width="50%">9. Details of the electrification in the proposed area</td>
    <td>
	'.strtoupper($row['electrification_details']).'
    </td>
  </tr>
</table>
</td>
</tr>


<tr><td>
<table width="100%" style="text-align:top;border-collapse:collapse;" border="1" class="table table-bordered table-responsive">
  <tr>
    <td width="50%">10. Total Storage Area/ Total area of the installation</td>
    <td>
	'.strtoupper($row['t_s_area']).'
    </td>
  </tr>
</table>
</td>
</tr>

<tr><td>
<table width="100%" style="text-align:top;border-collapse:collapse;" border="1" class="table table-bordered table-responsive">
  <tr>
    <td width="50%" valign="top">11. Surrounding properties:</td>
    <td><table width="100%" border="1" class="table table-bordered table-responsive" style="text-align:top;border-collapse:collapse;">
      <tr>
        <td width="50%">East</td>
        <td>'.strtoupper($s_properties->e).'</td>
      </tr>
      <tr>
        <td>West</td>
        <td>'.strtoupper($s_properties->w).'</td>
      </tr>
      <tr>
        <td>North</td>
        <td>'.strtoupper($s_properties->n).'</td>
      </tr>
      <tr>
        <td>South</td>
        <td>'.strtoupper($s_properties->s).'</td>
      </tr>
    </table></td>
  </tr>
</table>
</td>
</tr>

<tr><td>
<table width="100%" style="text-align:top;border-collapse:collapse;" border="1" class="table table-bordered table-responsive">
  <tr>
    <td width="50%">12. Accessibility to the premises</td>
    <td>
	'.strtoupper($row['p_accessibility']).'
    </td>
  </tr>
</table>
</td>
</tr>

<tr><td width="100%">
<table width="100%" style="text-align:top;border-collapse:collapse;" border="1" class="table table-bordered table-responsive">
  <tr>
    <td width="50%" valign="top">13. Open Space available around the Storage:</td>
    <td><table width="100%" border="1" class="table table-bordered table-responsive" style="text-align:top;border-collapse:collapse;">
      <tr>
        <td width="50%">Eastern Side</td>
        <td>'.strtoupper($o_s_a_storage->e).'</td>
      </tr>
      <tr>
        <td>Western Side</td>
        <td>'.strtoupper($o_s_a_storage->w).'</td>
      </tr>
      <tr>
        <td>Northern Side</td>
        <td>'.strtoupper($o_s_a_storage->n).'</td>
      </tr>
      <tr>
        <td>Southern Side</td>
        <td>'.strtoupper($o_s_a_storage->s).'</td>
      </tr>
    </table></td>
  </tr>
</table>
</td>
</tr>

<tr><td width="100%">
<table width="100%" style="text-align:top;border-collapse:collapse;" border="1" class="table table-bordered table-responsive">
  <tr>
    <td width="50%">14. Provision made of segregate the premises</td>
    <td>
	'.strtoupper($row['segregate']).'
    </td>
  </tr>
</table>
</td>
</tr>

<tr><td width="100%">
<table width="100%" style="text-align:top;border-collapse:collapse;" border="1" class="table table-bordered table-responsive">
  <tr>
    <td width="50%">15. Name of the nearest Fire Station</td>
    <td>
	'.strtoupper($row['n_fire_station']).'
    </td>
  </tr>
</table>
</td>
</tr>

<tr><td width="100%">
<table width="100%" style="text-align:top;border-collapse:collapse;" border="1" class="table table-bordered table-responsive">
  <tr>
    <td width="50%">16. Details of the Fire Fighting Equipments available in the premises</td>
    <td>
	'.strtoupper($row['details_f_f_system']).'
    </td>
  </tr>
</table>
</td>
</tr>

<tr><td width="100%">
<table width="100%" style="text-align:top;border-collapse:collapse;" border="1" class="table table-bordered table-responsive">
  <tr>
    <td width="50%" valign="top" align="left">17. Details of the water storages available in the premises</td>
    <td>'.strtoupper($row['details_w_s']).'</td>
  </tr>
    </table>
</td></tr>

<tr><td width="100%">
<table width="100%" style="text-align:top;border-collapse:collapse;" border="1" class="table table-bordered table-responsive">
  <tr>
    <td width="50%" valign="top" align="left">18. Details of the personnel trained in basic fire fighting (training certificate number)</td>
    <td width="50%">
	<table width="100%" style="text-align:top;border-collapse:collapse;" border="1" class="table table-bordered table-responsive">
	<tr>
	<td width="50%">Name </td><td>'.strtoupper($row['details_p_t']).'</td>
	</tr>
	<tr>
		<td>Sl No </td><td>'.strtoupper($sl_c_details->s).'</td>
	</tr>
	</table>

</td>
  </tr>
    </table>
</td></tr>

<tr><td width="100%">
<table width="100%" style="text-align:top;border-collapse:collapse;" border="1" class="table table-bordered table-responsive">
  <tr>
    <td width="50%" valign="top" align="left">19. License number (not applicable for new applicants)</td>
    <td>'.strtoupper($row['lc_no']).'</td>
  </tr>
    </table>
</td></tr>

<tr><td width="100%" >
<table width="100%" style="text-align:top;border-collapse:collapse;" border="1" class="table table-bordered table-responsive">
  <tr>
    <td width="50%" valign="top" align="left">20. Any other information that the applicant desires to provide</td>
    <td>
      '.strtoupper($row['other_info']).'
    </td>
  </tr>
</table>
</td></tr>
<table width="100%" style="text-align:top;border-collapse:collapse;" border="1" class="table table-bordered table-responsive">
<tr>
	<td valign="top" colspan="2">21. Checklists of Documents. <br/>* NA - Not Applicable <br/>* SC - Send by Courier</td>
</tr>
</table>
<tr><td width="100%">
<table  width="100%" style="text-align:top;border-collapse:collapse;" border="1"  class="table table-bordered table-responsive" cellpadding="10" style="text-align:top;border-collapse:collapse;">
        <tr>
        <td width="50%">1. Site plan</td>
        <td>'.$val1.'</td></tr>
        <tr>
        <td>2. Layout plan</td>
        <td>'.$val2.'</td></tr>
        <tr>
        <td>3. Service plan</td>
        <td>'.$val3.'</td></tr>
        <tr>
        <td>4. License/ Permission etc.</td>
        <td>'.$val4.'</td></tr>';

   if(!empty($row["courier_details"])&& $row["courier_details"]!=1){
      $printContents=$printContents.'
      <tr>       
      <td colspan="2">
        <table  width="100%" border="0" class="table table-bordered table-responsive" style="text-align:top;border-collapse:collapse;" >
          <tr><td colspan="2"><u>Courier Details.</u></td></tr>
          <tr><td width="50%">Name of Courier Service </td><td>'.strtoupper($courier_details_cn).'</td></tr>
          <tr><td>Ref. No. / Consignment No. </td><td>'.strtoupper($courier_details_rn).'</td></tr>
          <tr><td>Dispatch Date </td><td>'.strtoupper($courier_details_dt).'</td></tr>
        </table>
      </td>
      </tr>'; 
    } 
  $printContents=$printContents.'  
    </table>  
</td></tr>
<tr><td width="100%">
<p>&nbsp;</p>
<table width="100%" border="0" class="table table-bordered table-responsive">
      <tr>
         <td width="50%">Place: '.strtoupper($dist).'</td>
        <td align="right">'.strtoupper($key_person).'</td>
      </tr>
      <tr>
        <td valign="top">Date: '.strtoupper($sub_date).'</td>
        <td align="right">Signature of the Applicant<br/>
        (Owner/ Signing Authority)</td>
      </tr>
    </table>
</td></tr>
</table>';
?>