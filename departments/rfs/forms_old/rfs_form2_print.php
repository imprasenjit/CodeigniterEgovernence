<?php
if(!isset($get_file_name)){    
    ob_start();
  require_once "../../requires/login_session.php";
}
 $soc_reg=$rfs->query("select * from rfs_form2 where user_id='$swr_id'");
	$row=$soc_reg->fetch_array();
	$form_id=$row['form_id'];
	if(!empty($row["courier_details"])&& $row["courier_details"]!=1 ){
        $courier_details=json_decode($row["courier_details"]);
        $courier_details_cn=$courier_details->cn;$courier_details_rn=$courier_details->rn;$courier_details_dt=$courier_details->dt;
      }else{
        $courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
      }
	$soc_members=$rfs->query("select * from rfs_form2_members where form_id='$form_id'");
	$row3=$soc_members->fetch_array();  
     $partner=json_decode($row3['partner'],true);
	 $reg_date=$row3["est_date"];
	$soc_rules=$rfs->query("select * from rfs_form2_rules where form_id='$form_id'");
	$row4=$soc_rules->fetch_array();
	if(!empty($row4['bank_details'])) {
	 	$bank_details=json_decode($row4['bank_details']);
	 }
	if(!empty($row4["photo"])) {
	 	$photo=json_decode($row4["photo"]);
	 	$photo_presid=$photo->presid;
	 	$photo_secret=$photo->secret;
	 	$photo_sign1=$photo->sign1;
	 	$photo_sign2=$photo->sign2;
	 	$photo_sign3=$photo->sign3;
	 	
	 }
	$gen_meeting=json_decode($row4['gm_meeting']);
	$treasury_challan=json_decode($row4['treasury_challan']);
	
	if(!empty($row['soc_address']))
		{
			$soc_address=json_decode($row['soc_address']);
			$soc_address_mouza=$soc_address->mouza;
			$soc_address_circle=$soc_address->circle;
			$soc_address_patta=$soc_address->patta;
			$soc_address_dag=$soc_address->dag;
			$soc_address_area=$soc_address->area;
			$soc_address_locality=$soc_address->locality;

			$soc_address_village=$soc_address->village;
			$soc_address_dist=$soc_address->dist;
			$soc_address_pin=$soc_address->pin;
			$soc_address_ps=$soc_address->ps;
			$soc_address_po=$soc_address->po;
			
		}
	$soc_docs=$rfs->query("select * from rfs_form2_docs where form_id='$form_id'");
	$re=$soc_docs->fetch_array();
	if(!isset($css)){
     $val1=$formFunctions->get_uploadFile($re["file1"]);
     $val2=$formFunctions->get_uploadFile($re["file2"]);
     $val3=$formFunctions->get_uploadFile($re["file3"]);
     $val4=$formFunctions->get_uploadFile($re["file4"]);
     $val5=$formFunctions->get_uploadFile($re["file5"]);
     $val6=$formFunctions->get_uploadFile($re["file6"]);
    }else{
      $val1=$formFunctions->get_useruploadFile($re["file1"],$applicant_id);
      $val2=$formFunctions->get_useruploadFile($re["file2"],$applicant_id);
      $val3=$formFunctions->get_useruploadFile($re["file3"],$applicant_id);
      $val4=$formFunctions->get_useruploadFile($re["file4"],$applicant_id);
      $val5=$formFunctions->get_useruploadFile($re["file5"],$applicant_id);
      $val6=$formFunctions->get_useruploadFile($re["file6"],$applicant_id);
     
      
    }
	
	$upload=$server_url."departments/rfs/forms/upload/";
  $form_name=$formFunctions->get_formName('rfs','2');
if(!isset($css)){
$printContents='
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Form2</title>
<style>
input, text { 
  text-transform: uppercase;
}
.header{
  width: 100%;
  height: 130px;
  font-weight: bold;
}
.main_body {
  height: 500px;
 width="100%"
}
</style>
</head>
<body>';    
}else{
      $printContents='';
}
if(!empty($results["uain"])){
      $printContents=$printContents.'<p style="text-align:right;padding:20px 20px 0 0;">UAIN : '.strtoupper($results["uain"]).'</p>';
    }
    $printContents=$printContents.'<div>
    <link href="css/style.css" rel="stylesheet"/>
	
    </p>
	
		<h3 style="text-align:center">Form No I<br>'.$form_name.'<br>Fees Rs. 50.00</br>
                        (Registration Under Societies Registration Act, XXI of 1860)</br></h3>
        
       <table width="100%" class="table table-bordered table-responsive">  
                <tr>
                    <td>1. Name of the Society :</td>
                    <td>'.$row['soc_name'].'</td>
                </tr>
                <tr>
                    <td>2. Address of the Society: </td>
                </tr>    	
				<tr>
				    <td> Mouza :</td>
				    <td>'.strtoupper($soc_address_mouza).'</td>
				
				     <td>Circle :</td>
				     <td>'.strtoupper($soc_address_mouza).'</td>
				</tr>
				<tr>
					 <td> Patta no :</td>
					 <td>'.strtoupper($soc_address_patta).'</td>
				
					 <td> Dag no :</td>
					 <td>'.strtoupper($soc_address_dag).'</td>
			
				</tr>
				<tr>
					 <td> Area : </td>
					 <td>'.strtoupper($soc_address_area).'</td>			
					 <td> locality : </td>
					 <td>'.strtoupper($soc_address_locality).'</td>
			
				</tr>
				<tr>
					 <td> Village/town/city :</td>
					 <td>'.strtoupper($soc_address_village).'</td>			
					 <td> Post Office :</td>
					 <td>'.strtoupper($soc_address_po).'</td>
			
				</tr>
				<tr>
					 <td> Police Station :</td>
					 <td>'.strtoupper($soc_address_ps).'</td>
					 <td>District : </td>
					 <td>'.strtoupper($soc_address_dist).'</td>
			
				</tr>
				<tr>
					 <td>Pin code :</td>
					 <td>'.strtoupper($soc_address_pin).'</td>
			
				</tr>
       
			
		</table>
		<br/>
		 <p>  3.The Objects for which the Society is established are (The object must be Art & Culture, Environment,Science and Technology, Rural Development, Health, Women & Child Welfare, Agriculture etc.)</p>
			
		<table  width="100%"   class="table table-bordered table-responsive">	
			
			<tr>
				 <td> 1) Rural Development :</td>
				 <td>'.$row['obj_rural'].'</td>
			
				 <td>2) Health :</td>
				 <td>'.$row['obj_health'].'</td>
			</tr>
			<tr>
				 <td> 3) Women & Child Welfare  :</td>
				 <td>'.$row['obj_woman'].'</td>
			
				 <td> 4) Education :</td>
				 <td>'.$row['obj_education'].'</td>
		
			</tr>
			<tr>
				 <td>5) Science & Technology : </td>
				 <td>'.$row['obj_science'].'</td>
		
			
				 <td>6) Art & Culture : </td>
				 <td>'.$row['obj_arts'].'</td>
		
			</tr>
			<tr>
				 <td> 7) Sports:</td>
				 <td>'.$row['obj_sports'].'</td>
		
			
				 <td>8) Agriculture:</td>
				 <td>'.$row['obj_agri'].'</td>
		
			</tr>
			<tr>
				 <td>9) Environment:</td>
				 <td>'.$row['obj_env'].'</td>
		
			
				 <td>10) others: </td>
				 <td>'.$row['obj_other'].'</td>
		
			</tr>
			
	 </table>
	 
	 <p>4.  We the undersigned are desirous of forming a society in pursuance of this Memorandum of Association</p>
     <table  width="100%"  class="table table=bordered table-responsive">
					<tr>   
						<td>S.NO</td>
						<td>Name</td>
						<td>Address</td>
						<td>Occupation</td>
						<td>Designation</td>
						<td>Signature</th>	
					</tr>';
					$m=1;
					for($m=1;$m<=count($partner);$m++){	
					$printContents=$printContents.'
					<tr>
						<td>'.$m.'</td>
						
						<td>
							'.strtoupper($partner[$m]['pname']).'</td>
						
						
						<td >'.strtoupper($partner[$m]['paddr']).'</td>
						<td >'.strtoupper($partner[$m]['poccupation']).'</td>
						<td >'.strtoupper($partner[$m]['pdesig']).'</td>
						<td><img src="'.$upload.$partner[$m]['photo'].'" style="width:140px;height:35px;"/></td>
					</tr>
					';
					
					}
	$printContents=$printContents.'
				</table>';
	$printContents=$printContents.'
				<table  width="100%"  class="table table-bordered table-responsive">
					<tr>
						<td>Date of Establishment:- '.$reg_date.'</td>
					</tr>
                </table>
				
		<table   width="100%"  class="table table-responsive table-bordered">
			<tr>
				<td>5. MEMBERSHIP:</td>
			</tr>
			<tr>
			<td>(a) Qualification to become Members:- </td>
			<td>
				'.$row4['mem_qualification'].'
			</td>
		
			<td>(b) Subscription,Donation etc.:- </td>
			<td>
				'.$row4['mem_donation'].'
				
			</td>
		      </tr>
			<tr>
				<td>(c) Collection of Fund:- </td>
				<td>
					'.$row4['mem_fund'].'
				</td>
			
				<td valign="top">(d) Control of Fund:- </td>
				<td>
					'.$row4['mem_fund_control'].'
				</td>
			</tr>
		</table>
				
		<table   width="100%"  class="table table-responsive table-bordered">
			 <tr>
				<td>6. Procedure of the General Meeting: (How many times in a year the General Meeting will be held) 
					</td>
					<td width="50%">'.$row4['meeting_proc'].'</td>
				
			</tr>
			<tr>
				<td>7. Quorum of the General Meeting:-</td>
					
					<td>'.$row4['meeting_quorum'].'</td>		
			</tr>
			<tr>
				<td>8. Election procedure of the Executive Committee/ Governing body/Managing Committee:-
					</td>
					<td>'.$row4['election_proc'].'</td>
			</tr>
			<tr>
				<td>9. Short description of the Executive body:-(This description must tally with the list given in the item 4 of Memorandum copy)
					</td>
					<td>'.$row4['eb_desc'].'</td>
			</tr>
			<tr>
				<td>10. The term of the Executive body:
					</td>
					<td>'.$row4['eb_term'].'</td>		
			</tr>
			<tr>
				<td>11. Procedure of Re-election of the members of the Executive body:-
					</td>
					<td>'.$row4['reelect_proc'].'</td>
			</tr>
			<tr>
				<td>12. Procedure of the meeting of the Executive body:-(How many times in a year or month the meeting of the Executive body will be held)
					</td>
					<td>'.$row4['eb_meeting'].'</td>
			</tr>
			<tr>
				<td>13. Quorum of the meeting of the Executive body:- (How many of the members of the executive body requires to be present to form quorum of the meeting of the executive body)
				 </td>
					<td>'.$row4['eb_quorum'].'
				</td>
			</tr>
			<tr>
				<td>14. Expulsion of undesirable member:- Any member who goes against the Rules and Regulation of the organization may be expelled from the organization.
				</td>
					<td>
				'.$row4['mem_expulsion'].'
				</td>
			</tr>
			<tr>
				<td>15. Auditor: A qualified Auditor will be appointed by the Executive body who shall audit the accounts of the society at least once in a year and Annual Audit Report will be submitted to the Registrar of Societies Regulatory.
				</td>
					<td>'.$row4['auditor'].'
				</td>
			</tr>

			<tr>
				<td>16. Legal Procedure:- According to the provision laid down in the section 6 of the societies Registration Act-XXI of 1980, the Society may sue or may be used in the name of the President and Secretary of the Society.
				</td>
					<td>'.$row4['legal_proc'].'
				</td>
			</tr>
			<tr>
				<td>17. Dissolution:- If necessary, the Society may be dissolved and the properties remained after dissolution may be handed over according to the provision laid down in the Section 13 and 14 of the Societies Registration Act-XXI of 1860.
				</td>
					<td>'.$row4['dissolution'].'
				</td>
			</tr>
			
		</table>
		
		<p>18. General Meeting </p>
		<table  width="100%"  class="table table-bordered table-responsive">
			
			<tr><td>Date of holding the meeting :</td>
			<td>'.$gen_meeting->dh.'</td></tr>
			<tr><td>Place of meeting :</td>
			<td>'.strtoupper($gen_meeting->pm).'</td>
			</tr>
			<tr>
			<td>Number of public present:</td>
			<td>'.$gen_meeting->np.'</td>
			</tr>
		</table>';
	$printContents=$printContents.'
		
		<p> 19. Scanned Photographs of the President and Secretary of the society <br> </p>
		 <table  width="100%"  class="table table-bordered table-responsive">
			<tr>
				<td>
					1.President </td>
					<td><img src="'.$upload.$photo->presid.'"  style="width:100px;height:100px;" /></td>
					
				   
					
				
				<td>
					2.Secretary</td>
					<td>
					
					<img src="'.$upload.$photo->secret.'"  style="width:100px;height:100px;" />
					
				</td>
				
			</tr>
		</table>
		
		 20. Bank Account 	
			<table  width="100%"  class="table table-bordered table-responsive">
				<tr><td>No :</td><td>'.strtoupper($bank_details->no).' </tr>
				<tr><td>Bank :</td><td>'.strtoupper($bank_details->na).'</td></tr>
				<tr><td>branch:</td><td>'.strtoupper($bank_details->br).'</td></tr>
				<tr><td>Type of Account:</td><td>'.strtoupper($bank_details->ta).'</td></tr>
				<tr><td>Holding Account:</td><td>'.strtoupper($bank_details->ah).'</td></tr>
			</table>
		
		 21. Treasury Challan 	
			<table  width="100%"  class="table table-bordered table-responsive">
			<tr><td>No :</td><td>'.strtoupper($treasury_challan->n).'</td></tr>
			<tr><td>Date:</td><td>'.$treasury_challan->d.'</td></tr>
			<tr><td>Branch:</td><td>'.strtoupper($treasury_challan->b).'</td></tr>
			<tr><td>Amount:</td><td>'.strtoupper($treasury_challan->a).'</td></tr>
			
			</table>
			
			22. Certified to be the true copy of the Rules & Regulation of (NAME OF THE SAMITY)<br>
			<u>Signature of the three Executive Members.</u>:-
			<table  width="100%"  class="table table-bordered table-responsive">
				<tr>
					<td>Ist executive</td><td><img src="'.$upload.$photo->sign1.'" style="width:120px;height:35px;" /></td>
					<td>2nd  executive </td><td><img src="'.$upload.$photo->sign2.'" style="width:120px;height:35px;" /></td>
					<td>3rd executive </td><td><img src="'.$upload.$photo->sign3.'" style="width:120px;height:35px;" /></td>
				</tr>
				
			</table>
		
		<table  width="100%"  class="table table-bordered table-responsive">
			<tr>
				<th style="text-align:center;width:70%;" > Particulars</th>
				<th > Upload</th>
			</tr>
			<tr>
				<td > 1. Scanned copy of Witness paper in Memorandum of Association at item no. 5:</td>
				<td>'.$val1.'</td> 
			</tr>
			<tr>
				<td> 2. Copies of Resolutions regarding registration of the Society and election of the
Members of the Executive body with the list of signatures of members present
in the General Meeting </td>
				<td>'.$val2.'</td>  
			</tr>
			<tr>
				<td>3. Land document (Jamabandi / Mutation Order / Registered Sale deed / Govt.
			allotment order) of the office of the society :
			Land Lease / Rent Agreement / Affidavit from the house owner if does not
			have own land
						
				</td>
				<td>'.$val3.'</td> 
			</tr>
			<tr>
				<td> 
				4.  Activity Report/Certificate from the DC/SDO of the concerned district/Sub
			Division if the organisation proposed to be registered as a society has been
			undertaking any activities during the preceding 12 months from the date of its application for
			registration.
				</td>
				<td>'.$val4.'</td> 
			</tr>
			<tr>
				<td> 5. Declaration from the President or the Secretary regarding the receipt of fund, if any from the Government or other agencies. There should be a categorical declaration in this respect.
						
				</td>
				<td>'.$val5.'</td> 
			</tr>
			<tr>
				<td> 
				6. Treasury Challan
				</td>
				<td>'.$val6.'</td> 
			</tr>
	</table>
		
     
';
 if(!empty($row["courier_details"])){
      $printContents=$printContents.'
      <tr>       
      <td>
        <table width="100%" class="table table-bordered table-responsive">
          <tr><td style="width:70%">Courier Details.</td></tr>
          <tr><td style="width:70%">Name of Courier Service </td><td>'.strtoupper($courier_details_cn).'</td></tr>
          <tr><td style="width:70%">Ref. No. / Consignment No. </td><td>'.strtoupper($courier_details_rn).'</td></tr>
          <tr><td style="width:70%">Dispatch Date </td><td>'.strtoupper($courier_details_dt).'</td></tr>
        </table>
      </td>
      </tr>'; 
    } 
 if(!isset($css)){
      $printContents=$printContents.'  
</body>
</html>';
}  
if(!isset($get_file_name))
{   
    $mypdf="society-".$sid.".pdf";
    ob_end_clean();
    include('../../../mpdf60/mpdf.php'); 
    $mpdf=new mPDF('c','A4','','' , 15, 15, 16, 16, 9, 9); 
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->list_indent_first_level = 0;
    $mpdf->WriteHTML($printContents);         
    $mpdf->Output($mypdf,'I');

  $rfs->close();
} 
?>