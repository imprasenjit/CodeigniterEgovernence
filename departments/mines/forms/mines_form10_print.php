<?php
$dept="mines";
$form="10";
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
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name."  where user_id='$swr_id' and uain='$uain'");	
}else if(isset($form_id)){
	$form_id=$form_id;
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name."  where user_id='$swr_id' and form_id='$form_id'");
}else{
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name."  where user_id='$swr_id' and active='1' and form_id=form_id");
}
	
	
if($q->num_rows > 0){
	$results=$q->fetch_assoc();
	$form_id=$results["form_id"];$indenture_dt=$results["indenture_dt"];$acting_through=$results["acting_through"];
	$firstshri=$results["firstshri"];$son_shri=$results["son_shri"];$resi_dent=$results["resi_dent"];$dist_rict=$results["dist_rict"];$adminis_trators=$results["adminis_trators"];$second_part=$results["second_part"];$resident_of=$results["resident_of"];$dist_second=$results["dist_second"];$permit_h=$results["permit_h"];$hol_words=$results["hol_words"];$cubic_metre=$results["cubic_metre"];
	$divi_sion=$results["divi_sion"];$district_second=$results["district_second"];$holder_rs=$results["holder_rs"];$hold_rupees=$results["hold_rupees"];
	$instal_lment=$results["instal_lment"];$installment_rs=$results["installment_rs"];$install_rupees=$results["install_rupees"];
			
	if(!empty($results["permit_holder"])){
		$permit_holder=json_decode($results["permit_holder"]);
        if(isset($permit_holder->a)) $permit_holder_a=$permit_holder->a; else $permit_holder_a="";
        if(isset($permit_holder->b)) $permit_holder_b=$permit_holder->b; else $permit_holder_b="";
        if(isset($permit_holder->c)) $permit_holder_c=$permit_holder->c; else $permit_holder_c="";
        if(isset($permit_holder->d)) $permit_holder_d=$permit_holder->d; else $permit_holder_d="";
		
	}else{				
		$permit_holder_a="";$permit_holder_b="";$permit_holder_c="";$permit_holder_d="";
	}				
	if(!empty($results["suretyaddres"])){
		$suretyaddres=json_decode($results["suretyaddres"]);
        if(isset($suretyaddres->a)) $suretyaddres_a=$suretyaddres->a; else $suretyaddres_a="";
        if(isset($suretyaddres->b)) $suretyaddres_b=$suretyaddres->b; else $suretyaddres_b="";
        if(isset($suretyaddres->c)) $suretyaddres_c=$suretyaddres->c; else $suretyaddres_c="";
        if(isset($suretyaddres->d)) $suretyaddres_d=$suretyaddres->d; else $suretyaddres_d="";
		
	}else{				
		$suretyaddres_a="";$suretyaddres_b="";$suretyaddres_c="";$suretyaddres_d="";
	}		
}
$form_name=$formFunctions->get_formName($dept,$form);
$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);

if(!isset($css)){
	$printContents='
	<!DOCTYPE html>
	<html lang="en">
	<head>
	<title>Form '.$form.'</title>
	<style type="test/css">
	table, thead, td {
		border: 1px solid #000;
		border-collapse: collapse;
	}
	table {	border-spacing: 0;border-collapse: collapse;table-layout: fixed;width:1000px;border: 1px solid black;}table, th, td {border: 1px solid black;}</style>
	</head>
	<body>';		
}else{
	$printContents='';
}
if(!empty($results["uain"])){
	$printContents=$printContents.'<p style="text-align:right;padding:20px 20px 0 0;"> UAIN: '.strtoupper($results["uain"]).'</p>';
}
$printContents=$printContents.'
	<h4 align="center">'.$assamSarkarLogo.'<br/>'.$form_name.'</h4>
	<br/>
	<table class="table table-bordered table-responsive">
				
	    <tr>  				
	        <td colspan="2">This indenture made on this day &nbsp;&nbsp;'.strtoupper($indenture_dt).'&nbsp;&nbsp;between the Governor of Assam acting through &nbsp;&nbsp;'.strtoupper($acting_through).'&nbsp;&nbsp;(hereinafter called the "Government" which expression shall where the context so admits be deemed to include his successors in office and assigns of the first part, and Shri &nbsp;&nbsp;'.strtoupper($firstshri).'&nbsp;&nbsp;son of shri&nbsp;&nbsp;'.strtoupper($son_shri).'&nbsp;&nbsp; resident of &nbsp;&nbsp;'.strtoupper($resi_dent).'&nbsp;&nbsp;District&nbsp;&nbsp;'.strtoupper($dist_rict).'&nbsp;&nbsp;(hereinafter referred to as "Permit Holder" which expression shall, where the context so admits include his heirs, executors, administrators, representatives and permitted assigns) of the second part and Shri&nbsp;&nbsp;'.strtoupper($adminis_trators).' son of shri&nbsp;&nbsp;'.strtoupper($second_part).'&nbsp;&nbsp;resident of &nbsp;'.strtoupper($resident_of).' District '.strtoupper($dist_second).' ( herein afterreferred to as " the surety ", which expression shall , where the context so admits , include his heirs ,executors, administrators , representatives and permitted assigns) of the third part;
			</td>
       </tr>
       <tr>  				
	        <td colspan="2">And whereas the permit holder has offered the highest bid for the permit of '.strtoupper($permit_h).' cu.m ( in words '.strtoupper($hol_words).' cubic metre '.strtoupper($cubic_metre).' (name of the quarry) (hereinafter referred to as the "said lands") in Sub-divisions '.strtoupper($divi_sion).' district '.strtoupper($district_second).' and whereas the permit holder has paid Rs '.strtoupper($holder_rs).' (Rupees '.strtoupper($hold_rupees).') only first installment/ permit money in full for the first year '.strtoupper($instal_lment).' and Rs '.strtoupper($installment_rs).' (Rupees '.strtoupper($install_rupees).' ) only as security (equal to 25% of the Bid amount) for the due fulfillment of the terms and covenants hereinafter mentioned and the Government hasagreed to grant him the aforesaid permit.
	        </td>
       </tr>
	  
	
<table class="table table-bordered table-responsive">
	<tr>
	   <td>Now these present witnesses as follows:
            <ol type="1">
                <li><b>Amount and mode of payment of permit money : </b><br/>The permit holder shall during the subsistence of the permit pay in advance to the Government, the following permit money in respect of the said lands given to him on permit for the period from_______________ to ________________ on the dates mentioned below</li><br/>
            </ol>
            <table class="table table-bordered table-responsive">
                <tr>
                  <th>Serial Number</th>
                  <th>Value of Annual Permit money</th>
                  <th>Periodicity of payment</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>(i)</td>
                    <td>(ii)</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Up to rs 10.00 lakhs</td>
                    <td>Above Rs 10.00 lakhs</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Rs____________( Full amount of the permit
                        money in lump-sum to be deposited at the time of
                        auction along with the security amount )</td>
                    <td>Rs_____________(In two installments, one
                    at the time of auction and another by 15 th of May of the
                    year to which the permit pertains)</td>
                </tr>
            </table>
		</td>
    </tr>
	<tr>
        <td>
            <li><b>Amount to be deposited on account of Mines and Mineral Development, Restoration and
            Rehabilitation Fund (hereinafter referred to as "Fund") : </b><br/>Where the permit holder is operating the area, he shall also pay an additional amount, equal to ten percent of the due permit money, whichever is more along with amount of installments on account of dead rent or royalty, towards the Fund.</li>

            <li><b>Interest on delayed payments : </b><br/>In case of any default in payment of the installments of permit money or contribution to the fund on due date (s), the amount would be payable along with Interest at the following rates</li>
        </td>
	</tr>
	<tr>
	  <td>
		<table class="table table-bordered table-responsive">
			<tr>
			  <th>Serial no</th>
			  <th>Period of Delay</th>
			  <th>Rate of Interest applicable</th>
			</tr>
			<tr>
				<td>(i)</td>
				<td>If paid within a period of 7days from the due date</td>
				<td>A grace period of up to 7 days is allowed without any interest</td>
			</tr>
			<tr>
				<td>(ii)</td>
				<td>If paid after 7days but up to 30 days of the due date.</td>
				<td>15% on the amount of default for the period of default including the grace period;</td>
				
			</tr>
			<tr>
				<td>(iii)</td>
				<td>If paid after 30 days but within 60 days of the due date</td>
				<td>18% on the amount of default for the period of default including the grace period;</td>
			</tr>
			<tr>
				<td>(iv)</td>
				<td>Delay beyond 60 days of the due date</td>
				<td>Termination of the lease/contract and the entire
					outstanding amount would be recoverable along with
					interest calculated @21% for the entire period of
					default</td>
			</tr> 
		</table>
      </td>
    </tr>
	<tr>
		 <td>
         <ol>
		  <li><b>No quarrying operations in certain areas :</b><br/>No quarrying operations or working shall be carried on or permitted to be carried on by the permit holder in or under the said lands or to any point within a distance of ten metres from any railway line,bridge, National highway, reservoir, tank, canal or other public works, or other public or private buildings, the competent authority may terminate the permit after giving one month&rsquo;s notice to the permit holder in this behalf. The permit shall stand terminated on the date mentioned in the notice. In such an event the permit holder shall be refunded the permit money proportionate to the unexpired portion of the permit paid by him in advance if any.</li>
		
		 <li><b>To allow entry to Central Government and State Government Officers for Inspection :</b><br/>The permit holder shall at all reasonable times allow the competent authority any other officer authorised by the Central government or by the State government in that behalf to inspect the said lands and the buildings and plant erected thereon and the permit holder shall assist such person in conducting the inspection and afford them all information they may reasonably require and shall confirm to and observe all orders which the Central or State Government or the competent authority, as a result of such inspection or otherwise may from time to time pass.</li> 
	
		 <li><b>Assign, Sublet or transfer of the permit :</b><br/>TThe permit holder shall not assign, sublet or transfer the permit to any person without obtaining prior permission in writing from the competent authority.</li>
		
		 <li><b>To pay compensation for damage and indemnify the Government :</b><br/>The permit holder shall make and pay such reasonable satisfaction and compensation for all damage,injury or disturbance which may be done by him in exercise of the powers granted by the permit shall indemnify the Government against all claims which may be made by third parties in respect of such damage, injury or disturbance.</li>
		
		 <li><b>Not to carry on surface operation in prohibited areas:</b><br/>The permit holder shall not carry on surface operation in any area prohibited by any authority, without obtaining prior permission in writing from the concerned authority.</li>

		 <li><b>Not to enter and work in reserved and protected forest areas:</b><br/>The permit holder shall not enter and work in any forest land without obtaining prior permission in writing from the Forest Department.</li>
     
		
		 <li><b>Application of all Acts, rules and regulations to this permit:</b><br/>The permit holder shall abide by the provisions of the Mines Act, 1952 (35 of 1952), and the rules and regulations framed there under and also the provisions of other labour laws both Central and State as are applicable to the workmen engaged in the mines and quarries relating to the provisions of drinking water, rest shelters, dwelling houses, latrines and first aid and medical facilities in particular and other safety and welfare provisions in general , to the satisfaction of the authorities under the aforesaid acts , rules and regulations and also to the satisfaction of the District Magistrate Concerned. In case of non compliance of any of the provisions of the enactments as aforesaid, the competent authority may terminate the permit by giving one month&rsquo;s notice with forfeiture of the security deposited:<br/>Provided that the permit holder shall carry out mining operations in accordance with all other provisions as applicable for undertaking mining including the provisions of Forest (Conservation ) Act , 1980 and (Environment ) Protection Act , 1986 and the rules made there under.</li>
         </ol>
	  </td>
	</tr>
	<tr>
		 <td>
         <ol>
		 <li><b>Disposal of mineral(s) only on issuance of Mineral Transit Challan:</b><br/>The holder of mining permit shall not sell or dispose off any mineral or mineral products from the concession area without a Mineral Transit Pass.</li>

		 <li><b>Security deposit shall carry no interest:</b><br/>The Security deposited by the permit holder shall not carry any interest. It shall be refunded to the permit holder within three month&rsquo;s from the date of expiry or sooner determination of the permit in case the same is not forfeited or required to be detained for any other purposes under this deed.</li>

		 <li><b>Penalty for default. :</b><br/>In case of default in the due observance of the terms and conditions of the permit or in payment of the permit money on the due date, the permit money on the due date, the permit may be terminated by the competent authority by giving one month&rsquo;s notice. In such an event, the competent authority shall be at liberty to forfeit the security deposited and also the installment, paid in advance, if any the permit holder shall deliver the possession of the quarry to the Officer-in- Charge, concerned within seven days of the receipt of the order of termination of permit.</li>

		 <li><b>Termination of permit by Government in public interest:</b><br/>The permit may be terminated by the Government if considered by it to be in public interest, by giving one month&rsquo;s notice:<br/>Provided that in the State of National emergency or war, the permit may be terminated without giving such notice.</li>

		<li><b>Recovery of permit money as arrears of land revenue :</b><br/>Any sum due from the permit holder on account of permit money in respect of the permit shall be recoverable from him as arrears of Land revenue.</li>

		<li><b>To Submit reports :</b><br/>The permit holder shall furnish such reports and returns relating to output, labourers employed and other matters as the competent authority may prescribe from time to time.</li>

		<li><b>Returns :</b><br/>The permit holder shall submit a monthly return from on form &#39MMPI&#39 by 10 th day each month to the competent authority and to the Officer in charge concerned giving the total quantity of minor mineral(s) raised and dispatched from the specific area out the area under permit in the preceding calendar month, and its value and such other information relating to the permit as may be called for by the competent authority.</li>

		<li><b>State Government not responsible for loss to permit holder :</b><br/>The Government shall not be responsible for any kind of loss to the permit holder for any reason what-so-ever.</li>

		<li><b>Notices:</b><br/>Every notice by these presents required to be given to the permit holder shall be given in writing to such person, resident on the said lands as the Permit holder may appoint for the purpose of receiving of such notice and if there shall have been no such appointment then every such notice shall be sent to the Permit holder at the address recorded in this deed or at such other address, the permit holder may, from time to time, in writing to the officer authorised by the competent authority for the receipt of notices and every such service shall be deemed to be proper and valid service upon the permit holder and shall not be questioned by him.</li>
		
		<li><b>Compensation and acquisition of Land of third parties thereof:</b><br/>In case the occupier(s) or owner (s) of the said land refuses his / their consent to the exercise of the rights and powers reserved to the Government and demised to the permit holder under these presents, the Permit holder shall report the matter to the competent authority who shall request the Collector of the district concerned to direct the occupier(s) or owner(s) to allow the Permit holder to enter the said lands and to carry out such operations as may be necessary for working the mine , on payment in advance of such compensation to the occupier or owner by the Permit holder , as may be fixed by the Collector Concerned under the rules.</li>
        </ol>
	</td>
	</tr>
    <tr>
      <td>
		<li><b>Suspension of mining operations:</b><br/>The competent authority may order to suspend the mining operations after serving a notice to the permit holder, in case of the following;
			<ol type="a">
				<li>Unsafe and unscientific mining;</li>
				<li>Non providing of safety appliances to the workers;</li>
				<li>Nonpayment of compensation to the surface owners;</li>
				<li>Non submissions of monthly returns;</li>
			</ol>

			<p>In case of violations of the aforesaid conditions and also any other terms and conditions of the agreement deed and the provisions of the rule, the competent authority may give a notice to the permit holder to remedy the violations within a period of 15 days from the date of issue of the notice . In case, the violations pointed out through notice, are not remedied within the stipulated period of fifteen days, the competent authority may after affording an opportunity being heard to the permit holder, order the suspension of the mining operations till such time, the defaults/ defects are removed by the Permit holder within the time frame granted by the competent authority. During the period of suspension of mining operations, the Permit holder will be allowed only to undertake rectification work for removal of defects and shall not dispose of the mineral. During the suspension period, the permit holder shall be under the obligation to deposit the amount of the dead rent etc on the due dates.<br/>&nbsp;&nbsp;&nbsp;On satisfactory removal of the defects, the competent authority may revoke the suspension orders with or without any modification. Non removal of the defects or defaults during the suspension period and within the time allowed by the competent authority, shall lead to premature termination of permit holder.</p>
		</li>
	  </td>
     </tr>
    <tr>
      <td>
		<li><b>Stocks lying at the end of the permit: </b>
			<ol type="a">
				<li>The permit holder on the expiry of the permit period (successful completion of the 	permit) shall remove already extracted all of the mineral from the premises of the 	quarry within a period of seven days. In case any quantity of the already extracted mineral , in the said land is left undisposed off and is not removed within seven days from the date of expiry of the period of permit the same shall be deemed to be the property of the Government which will be disposed by the competent authority in any manner, without paying anything thereof to the permit holder</li>
	
				<li>The permit holder on the termination or sooner determination of the permit shall not remove extracted mineral from the premises of the permit areas. All extracted mineral in the said lands left over un-disposed after the termination or determination of permit lease shall be deemed to be property of the Government which will be disposed off by the competent authority in any manner without paying anything thereof to the permit holder.</li>
			</ol>
		</li>
	  </td>
	</tr>
	<tr>
      <td>
      <ol>
		<li><b>Recovery of Government dues as arrears of Land Revenue :</b><br/>This indenture further witnesseth that in further pursuance of agreement and covenants referred to above, the permit holder and the surety further covenant that if the permit holder shall make default in the payment of the permit money under these presents including any interest thereon on the date or dates on which the same shall be or become payable then the whole of the outstanding permit money and interest shall be payable by the permit holder and the surety jointly and severally. The Government shall be at liberty to recover the same from the permit holder or the surety irrespective of the fact whether Government shall have pursued all or any of its remedies against the Permit holder.</li>

		<li>Permit holder shall get himself registered with the Taxation Department of Assam shall obtain the Sales tax number.</li>
	
		<li><b>Overriding effect:</b><br/>Unless otherwise specifically provided, it agreed that this deed shall be governed by the provisions of the Mines and Minerals (Development and Regulation) Act, 1957 (67 of 1957) and the rules made there under. The provisions of the Act and rules shall prevail over the terms and conditions of the agreement.<br/>In witness whereof these presents have been executed in the manner hereunder appearing the day and year above written.</li>
	 </ol>
      </td>
	</tr>
</table>
	<table class="table table-bordered table-responsive">
		<tr>  				
			<td> Name and address of the Permit Holder.</td>
			<td>
			<table class="table table-bordered table-responsive">
				<tr>
						<td>Name</td> 
						<td>'.strtoupper($permit_holder_a).'</td>
				</tr>
				<tr>
						<td >Address 1</td>
						<td>'.strtoupper($permit_holder_b).'</td>
				</tr>
				<tr>
						<td > Name</td> 
						<td>'.strtoupper($permit_holder_c).'</td>
				</tr>
				<tr>
						<td >Address 2</td>
						<td>'.strtoupper($permit_holder_d).'</td>
				</tr>
			</table>
           </td>
        </tr>		
		<tr>  				
			<td> Name and address of the Surety.</td>
			<td>
			<table class="table table-bordered table-responsive">
				<tr>
						<td >1. Name</td> 
						<td>'.strtoupper($suretyaddres_a).'</td>
				</tr>
				<tr>
						<td >Address 1</td>
						<td>'.strtoupper($suretyaddres_b).'</td>
				</tr>
				<tr>
						<td >1. Name</td> 
						<td>'.strtoupper($suretyaddres_c).'</td>
				</tr>
				<tr>
						<td >Address 1</td>
						<td>'.strtoupper($suretyaddres_d).'</td>
				</tr>
			</table>
           </td>
        </tr>
     </table>
	';

		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'

		<tr>
			<td>Date : <strong> '.date('d-m-Y',strtotime($results["sub_date"])).'</strong></td>						
			<td align="right">Signature of Applicant :<strong>'.strtoupper($key_person).'</strong></td>				
		</tr>	
		<tr>
			<td>Place : <strong>'.strtoupper($dist).'</strong></td>						
			<td align="right"> Designation :<strong>'.strtoupper($status_applicant).'</strong></td>				
		</tr>						
	</table>';
?>