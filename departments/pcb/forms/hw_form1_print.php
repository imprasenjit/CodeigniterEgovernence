<?php
if(!isset($get_file_name))
{
		ob_start();
		include("authorise.php");
		$sid=$_SESSION['id'];
		if(!isset($_SESSION["id"])){
			header("Location:../index.php");
		}
		require_once "../conf/dbconnect.php";
		$form_id=$_GET["form_id"];
}
$sql1=$mysqli->query("select * from singe_window_registration a,users b where a.user_id='$sid' and b.id='$sid'");
		$row1=$sql1->fetch_array();
		
		$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_std=$row1['Mobile_std'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];$email=$row1['email'];
		$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];
		
		$from=$key_person."<br/>".$street_name1." ".$street_name2.",".$vill."<br/>".$dist.",".$pincode;
		
		$q=$pollution->query("select * from t_deptt_pollution_hw_form1 a, t_deptt_pollution_hw_form1_upload b where a.user_id=$sid and b.form_id=$form_id") or die($pollution->error);
		$results=$q->fetch_assoc();
		if($q->num_rows<1)
		{	 
			$owner_name="";$qty_waste="";$manufac_process="";$is_gen_hazard="";$hw_generate="";
			
			$auth_req_col="";$auth_req_recept="";$auth_req_treatment="";$auth_req_trnsport="";$auth_req_stor="";$auth_req_disp="";$auth_req_tanks="";
			$ren_auth_no="";$ren_auth_dt="";			
			$total_cap_i="";$total_cap_prod_yr="";$total_cap_works="";
			$list_products="";$list_raw_mat="";	
			$hw_type="";$hw_qty="";	$hw_source="";$hw_storage_method="";	
			$hw_details_loc="";$hw_details_name="";	$hw_details_w_proc="";$hw_details_typ_qty="";	$hw_details_clr="";$hw_details_prgm="";	$hw_details_disp_method="";$hw_details_qty="";$hw_details_nature="";$hw_details_op="";	
				$hw_details_prevention="";$hw_details_i="";	$hw_details_safety="";	
		}
		else
		{
			$form_id=$results['form_id'];	
			$owner_name=$results['owner_name'];$local_activity=$results['local_activity'];$qty_waste=$results['qty_waste'];$manufac_process=$results['manufac_process'];$is_gen_hazard =$results['is_gen_hazard'];	$hw_generate =$results['hw_generate'];		
			
			if($is_gen_hazard=="Y") $is_gen_hazard="YES";
			else $is_gen_hazard="NO";
			
			if(!empty($results["auth_req"]))
			{
				$auth_req=json_decode($results["auth_req"]);
				if(isset($auth_req->col)) $auth_req_col=$auth_req->col;
				else $auth_req_col="";
				if(isset($auth_req->recept)) $auth_req_recept=$auth_req->recept;
				else $auth_req_recept="";
				if(isset($auth_req->treatment)) $auth_req_treatment=$auth_req->treatment;
				else $auth_req_treatment="";
				if(isset($auth_req->trnsport)) $auth_req_trnsport=$auth_req->trnsport;
				else $auth_req_trnsport="";
				if(isset($auth_req->stor)) $auth_req_stor=$auth_req->stor;
				else $auth_req_stor="";
				if(isset($auth_req->disp)) $auth_req_disp=$auth_req->disp;
				else $auth_req_disp="";
				if(isset($auth_req->tanks)) $auth_req_tanks=$auth_req->tanks;
				else $auth_req_tanks="";
			}
			else
			{
				$auth_req_col="";$auth_req_recept="";$auth_req_treatment="";$auth_req_trnsport="";$auth_req_stor="";$auth_req_disp="";$auth_req_tanks="";
			}	
			if(!empty($results["ren_auth"]))
			{
				$ren_auth=json_decode($results["ren_auth"]);
				$ren_auth_no=$ren_auth->no;$ren_auth_dt=$ren_auth->dt;
			}
			else
			{
				$ren_auth_no="";$ren_auth_dt="";
			}		
			if(!empty($results["total_cap"]))
			{
				$total_cap=json_decode($results["total_cap"]);
				$total_cap_i=$total_cap->i;$total_cap_prod_yr=$total_cap->prod_yr;$total_cap_works=$total_cap->works;
			}
			else
			{
				$total_cap_i="";$total_cap_prod_yr="";$total_cap_works="";
			}
			if(!empty($results["list"]))
			{
				$list=json_decode($results["list"]);
				$list_products=$list->products;$list_raw_mat=$list->raw_mat;
			}
			else
			{
				$list_products="";$list_raw_mat="";	
			}
			if(!empty($results["hw"]))
			{
				$hw=json_decode($results["hw"]);
				$hw_type=$hw->type;$hw_qty=$hw->qty;$hw_source=$hw->source;$hw_storage_method=$hw->storage_method;
			}
			else
			{
				$hw_type="";$hw_qty="";	$hw_source="";$hw_storage_method="";	
			}
			if(!empty($results["hw_details"]))
			{
				$hw_details=json_decode($results["hw_details"]);
				$hw_details_loc=$hw_details->loc;$hw_details_name=$hw_details->name;$hw_details_w_proc=$hw_details->w_proc;$hw_details_typ_qty=$hw_details->typ_qty;$hw_details_clr=$hw_details->clr;$hw_details_prgm=$hw_details->prgm;$hw_details_disp_method=$hw_details->disp_method;$hw_details_qty=$hw_details->qty;$hw_details_nature=$hw_details->nature;$hw_details_op=$hw_details->op;$hw_details_prevention=$hw_details->prevention;$hw_details_i=$hw_details->i;$hw_details_safety=$hw_details->safety;
			}
			else
			{
				$hw_details_loc="";$hw_details_name="";	$hw_details_w_proc="";$hw_details_typ_qty="";	$hw_details_clr="";$hw_details_prgm="";	$hw_details_disp_method="";$hw_details_qty="";$hw_details_nature="";$hw_details_op="";	
				$hw_details_prevention="";$hw_details_i="";	$hw_details_safety="";	
			}
				
		}
		
		
	if($results["file1"]==""){ $val1="Not Uploaded";}
	elseif($results["file1"]=="NA") {$val1="Not Applicable";}
	elseif($results["file1"]=="SM") {$val1="Manually Submit Later";}
	else $val1=$mysqli->query("SELECT name FROM digital_locker WHERE user_id='".$results['user_id']."' AND file='".$results['file1']."'")->fetch_object()->name;
	
	if($results["file2"]=="") $val2="Not Uploaded";
	elseif($results["file2"]=="NA") $val2="Not Applicable";
	elseif($results["file2"]=="SM") $val2="Manually Submit Later";
	else $val2=$mysqli->query("SELECT name FROM digital_locker WHERE user_id='".$results['user_id']."' AND file='".$results['file2']."'")->fetch_object()->name;
	
	if($results["file3"]=="") $val3="Not Uploaded";
	elseif($results["file3"]=="NA") $val3="Not Applicable";
	elseif($results["file3"]=="SM") $val3="Manually Submit Later";
	else $val3=$mysqli->query("SELECT name FROM digital_locker WHERE user_id='".$results['user_id']."' AND file='".$results['file3']."'")->fetch_object()->name;
	
	if($results["file4"]=="") $val4="Not Uploaded";
	elseif($results["file4"]=="NA") $val4="Not Applicable";
	elseif($results["file4"]=="SM") $val4="Manually Submit Later";
	else $val4=$mysqli->query("SELECT name FROM digital_locker WHERE user_id='".$results['user_id']."' AND file='".$results['file4']."'")->fetch_object()->name;
	
	if($results["file5"]=="") $val5="Not Uploaded";
	elseif($results["file5"]=="NA") $val5="Not Applicable";
	elseif($results["file5"]=="SM") $val5="Manually Submit Later";
	else $val5=$mysqli->query("SELECT name FROM digital_locker WHERE user_id='".$results['user_id']."' AND file='".$results['file5']."'")->fetch_object()->name;
	
	if($results["file6"]=="") $val6="Not Uploaded";
	elseif($results["file6"]=="NA") $val6="Not Applicable";
	elseif($results["file6"]=="SM") $val6="Manually Submit Later";
	else $val6=$mysqli->query("SELECT name FROM digital_locker WHERE user_id='".$results['user_id']."' AND file='".$results['file6']."'")->fetch_object()->name;
	
	if($results["file7"]=="") $val7="Not Uploaded";
	elseif($results["file7"]=="NA") $val7="Not Applicable";
	elseif($results["file7"]=="SM") $val7="Manually Submit Later";
	else $val7=$mysqli->query("SELECT name FROM digital_locker WHERE user_id='".$results['user_id']."' AND file='".$results['file7']."'")->fetch_object()->name;
	
	if($results["file8"]=="") $val8="Not Uploaded";
	elseif($results["file8"]=="NA") $val8="Not Applicable";
	elseif($results["file8"]=="SM") $val8="Manually Submit Later";
	else $val8=$mysqli->query("SELECT name FROM digital_locker WHERE user_id='".$results['user_id']."' AND file='".$results['file8']."'")->fetch_object()->name;
	
	if($results["file9"]=="") $val9="Not Uploaded";
	elseif($results["file9"]=="NA") $val9="Not Applicable";
	elseif($results["file9"]=="SM") $val9="Manually Submit Later";
	else $val9=$mysqli->query("SELECT name FROM digital_locker WHERE user_id='".$results['user_id']."' AND file='".$results['file9']."'")->fetch_object()->name;
	
	if($results["file10"]=="") $val10="Not Uploaded";
	elseif($results["file10"]=="NA") $val10="Not Applicable";
	elseif($results["file10"]=="SM") $val10="Manually Submit Later";
	else $val10=$mysqli->query("SELECT name FROM digital_locker WHERE user_id='".$results['user_id']."' AND file='".$results['file10']."'")->fetch_object()->name;
	
	if($results["file11"]=="") $val11="Not Uploaded";
	elseif($results["file11"]=="NA") $val11="Not Applicable";
	elseif($results["file11"]=="SM") $val11="Manually Submit Later";
	else $val11=$mysqli->query("SELECT name FROM digital_locker WHERE user_id='".$results['user_id']."' AND file='".$results['file11']."'")->fetch_object()->name;
	
	if($results["file12"]=="") $val12="Not Uploaded";
	elseif($results["file12"]=="NA") $val12="Not Applicable";
	elseif($results["file12"]=="SM") $val12="Manually Submit Later";
	else $val12=$mysqli->query("SELECT name FROM digital_locker WHERE user_id='".$results['user_id']."' AND file='".$results['file12']."'")->fetch_object()->name;
	if($results["file13"]=="") $val13="Not Uploaded";
	elseif($results["file13"]=="NA") $val13="Not Applicable";
	elseif($results["file13"]=="SM") $val13="Manually Submit Later";
	else $val13=$mysqli->query("SELECT name FROM digital_locker WHERE user_id='".$results['user_id']."' AND file='".$results['file13']."'")->fetch_object()->name;
?>





<?php $printContents='
<!DOCTYPE html>
<html>
<head>


<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="common.js"></script>
<link href="css/custom.css" rel="stylesheet"/> 


<style>
input, textarea {
  text-transform: uppercase;
}
</style>
</head>

<body>
		<div style="text-align:center">
  			FORM – I <br/>[See rules 5(3) and (7)] 
					
			<p>APPLICATION FOR AUTHORIZATION/ RENEWAL OF AUTHORIZATION OF COLLECTION RECEIPT/ TREATMENT/ TRANSPORT/ STORAGE DISPOSAL OF HAZARDOUS WASTE. </p>
  			<p style="text-align:right">UIAN : '.strtoupper($results["form_no"]).'</p>
  		</div>



  		
  		<div class="container"><br/>
    

<table width="99%" border="1" style="border-collapse: collapse">
	<tr>
    <td valign="top" width="90">From : </td>
    <td valign="top">'.strtoupper($from).'</td>
	</tr>
	
	<tr>
    <td valign="top">To</td>
    <td valign="top">The Member Secretary,<br/>
Pollution Control Board, Assam<br/>
<u>Bamunimaidam, Guwahati-21.</u></td>
	</tr>
	
	<tr>
    <td valign="top" colspan="2">
		Sir, <br> &nbsp;&nbsp;&nbsp; I/we hereby apply for authorization/ renewal of authorization under sub-rule (3) of rule 5 of the Hazardous Waste (Management, Handling and Transboundary Movement) Rules, 2008 for collection/ reception/ treatment/ transport/ storage disposal of hazardous waste. 
    </td>
	</tr>
   

</table>




    <p style="text-align: center"><b>PART  A  : GENERAL</b></p>

<table width="99%" border="1" style="border-collapse: collapse">
	<tr>
		<td valign="top" style="width:55%">1.(a) Name of Owner/ Occupier :</td>
		<td>'.strtoupper($owner_name).'</td>
	</tr>
	<tr>
		<td valign="top" style="width:55%"> (b) Name & Address of the unit & local activity :</td>
    <td>
    		<table width="99%" border="1" style="border-collapse: collapse">
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
        			<td height="29">Pincode</td>
        			<td>'.strtoupper($b_pincode).'</td>
      		</tr>
      		<tr>
        			<td>Mobile</td>
        			<td>+91'.strtoupper($b_mobile_no).'</td>
      		</tr>
      		<tr>
        			<td>Phone Number</td>
        			<td>'.strtoupper($b_landline_std).' '.strtoupper($b_landline_no).'</td>
      		</tr>
      		
      		<tr>
        			<td height="29">Email-id</td>
        			<td>'.strtoupper($b_email).'</td>
      		</tr>
    		</table>
    	</td>
	</tr>
	<tr>
		<td valign="top" style="width:55%">(ii) Local Activity :</td>
		<td>'.strtoupper($local_activity).'</td>
	</tr>
	
  	<tr>
    	<td valign="top" style="text-indent:14px">(c) Authorization required for (please tick mark appropriate activity/ activities.)
        </td>
    	<td>
            '.strtoupper($auth_req_col).'<br/>
            '.strtoupper($auth_req_recept).'<br/>
            '.strtoupper($auth_req_treatment).'<br/>
            '.strtoupper($auth_req_trnsport).'<br/>
            '.strtoupper($auth_req_stor).'<br/>
            '.strtoupper($auth_req_disp).'<br/>
            '.strtoupper($auth_req_tanks).'<br/>
    	</td>
  	</tr>
  	
  	
  	<tr>
   	<td valign="top" style="text-indent:14px">(d) In case of renewal of authorization,provision authorization number and date</td>
        <td>Authorization no. :'.strtoupper($ren_auth_no).'<br/>
           Authorization date :'.strtoupper($ren_auth_dt).'</td>
  	</tr>
  	
  	
  	<tr>
    	<td valign="top"><p>2. (a) Whether the process generating hazardous waste as defined in the these Rules.
      </td>
    	<td>'.strtoupper($is_gen_hazard).'</td>
  	</tr>	
	
	<tr>
    	<td valign="top"><p> (b) If so the type and quantity of waste (in Tonnes/KL).
      </td>
    	<td>
            '.strtoupper($qty_waste).'<br/>
        </td>
  	</tr>
  	
  	
  	<tr>
    	<td valign="top">3. (a) Total capacity invested at on the project.(in Rupees) :</td>
    	<td>'.strtoupper($total_cap_i).'</td>
  	</tr>
  <tr>
      <td valign="top" style="text-indent:14px;"> (b) Year of commencement of productions :</td>
    	<td>'.strtoupper($total_cap_prod_yr).'</td>
  	</tr>
    <tr>
    	<td valign="top" style="text-indent:14px;"> (c) Whether the industry works general/ 2 shifts/ round the clock :</td>
    	<td>'.strtoupper($total_cap_works).'</td>
  	</tr>
    <tr>
    	<td valign="top" style="text-indent:14px;">4.(a) List and quantum of products & bye-products (in Tonnes/KL):</td>
    	<td>'.strtoupper($list_products).'</td>
  	</tr>
	<tr>
    	<td valign="top" style="text-indent:14px;">  (b) List and quantum of the raw materials used (in Tonnes/KL) :</td>
    	<td>'.strtoupper($list_raw_mat).'</td>
  	</tr><tr>
    	<td valign="top" style="text-indent:14px;">  5. Furnish a flow diagram of manufacturing process showing input & output in terms of products, waste generated including for captive power generation & dematerialized water :</td>
    	<td>'.strtoupper($manufac_process).'</td>
  	</tr>
  	
  	</table>

<p style="text-align: center"><b>PART B: HAZARDOUS WASTE </b></p>

<table width="99%" border="1" style="border-collapse: collapse">
      		<tr>
                <td style="width:55%">
                     6. (a)Type of hazardous wastes generated as defined under these Rules : 
                </td>
 
                    <td>'.strtoupper($hw_type).'</td>
      		</tr>
      		<tr>
                    <td>
                        (b) Quantum of hazardous waste generated :
                    </td>
        			
        			<td>'.strtoupper($hw_qty).'</td>
      		</tr>
      		<tr>
                    <td>
                        (c) Sources and waste characteristics (also indicate wastes amenable to recycling, re-processing and reuse):
                    </td>
        			
        			<td>'.strtoupper($hw_source).'</td>
      		</tr>
      		<tr>
                    <td>
                        (d) Mode of storage within the plant, method of disposal and capacity (provide details)
                    </td>
        			
        			<td>'.strtoupper($hw_storage_method).'</td>
      		</tr>
      		<tr>
                    <td>
                       7. Hazardous Wastes generated as per these Rules from storage of hazardous chemicals as defined under theManufacture, Storage and Import of Hazardous Chemicals Rules, 1989.
                    </td>
        			
        			<td>'.strtoupper($hw_generate).'</td>
      		</tr>
      		
    </table>
    
	
	
</table>

<p style="text-align: center"><b>PART C: TREATMENT, STORAGE AND DISPOSAL FACILITY</b></p>

<table width="99%" border="1" style="border-collapse: collapse">
  <tr>
      <td valign="top">8.  Detailed Proposal of the facility (to be attached) to :
    
         
    	</td>
      <td>
         
      
  	
				<tr>
					<td colspan="2" height="50px"><font color="red">Submitted Documents Are---</font></td>
				</tr>
				<tr>
					<td width="40%" >(i). Location of site (provide map).</td>
					<td>
						'.$val1.'
					</td> 
				</tr>
				<tr>
					<td >(ii). Name of waste processing technology .</td>
					<td width="30%" >
						'.$val2.'
					</td> 
				</tr>
				<tr>
					<td >(iii). Details of waste processing technology.</td>
					<td width="30%" >
						'.$val3.'
					</td> 
				</tr>
				<tr>
					<td >(iv). Type and Quantity of waste to be processed per day.</td>
					<td width="30%" >
						'.$val4.'
					</td> 
				</tr>
				<tr>
					<td >(v). Site clearance (from local authority, if any).</td>
					<td width="30%" >
						'.$val5.'
					</td> 
				</tr>
				<tr>
					<td >(vi). Utilization programme for waste processed (Product Utilization) .</td>
					<td width="30%" >
						'.$val6.'
					</td> 
				</tr>
				<tr>
					<td >(vii). Method of disposal (details in brief be given).</td>
					<td width="30%" >
						'.$val7.'
					</td> 
				</tr>
				<tr>
					<td >(viii). Quantity of waste to be disposed per day.</td>
					<td width="30%" >
						'.$val8.'
					</td> 
				</tr>
				<tr>
					<td >(ix).Nature and composition of waste .</td>
					<td width="30%" >
						'.$val9.'
					</td> 
				</tr>
				<tr>
					<td >(x).Methodology and operational details of land filling/ incineration .</td>
					<td width="30%" >
						'.$val10.'
					</td> 
				</tr>
				<tr>
					<td >(xi). Measures to be taken for prevention and control of environmental pollution including treatment of leachate.</td>
					<td width="30%" >
						'.$val11.'
					</td> 
				</tr>
				<tr>
					<td >(xii).Investment on Project and expected returns .</td>
					<td width="30%" >
						'.$val12.'
					</td> 
				</tr>
				<tr>
					<td >(xiii). Measures to be taken for safety of workers working in the plant .</td>
					<td width="30%" >
						'.$val13.'
					</td> 
				</tr>
				<tr>
        <td>Place: '.strtoupper($dist).'<br/><br/> Date : '.strtoupper($results["sub_date"]).'</td>
      <td>
          Signature : '.strtoupper($key_person).'<br/><br/>
          Name : '.strtoupper($key_person).'<br/><br/>
         </td>
		</tr>
	</table>
	</body>
</html>
			
 	';
  	
if(!isset($get_file_name))
{ 	
		$mypdf="hw_form1".$sid.".pdf";
		ob_end_clean();
		include("../mpdf60/mpdf.php"); 
		$mpdf=new mPDF('c','A4','','' , 15, 15, 16, 16, 9, 9); 
		$mpdf->SetDisplayMode('fullpage');
		$mpdf->list_indent_first_level = 0;
		$mpdf->WriteHTML($printContents);         
		$mpdf->Output($mypdf,'I');

	$pollution->close();
}
?>