<?php
$dept="mines";
$form="15";
$table_name=getTableName($dept,$form);

if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
	echo "<script>
			alert('Invalid Page Access');
	</script>";	
	die();
}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
	$form_id=$_GET["ui"];
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name."  where user_id='$swr_id' and form_id='$form_id'");
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
        $results=$q->fetch_array();
		$form_id=$results["form_id"];
		$indenture_dt=$results["indenture_dt"];$acting_through=$results["acting_through"];$bid_rs=$results["bid_rs"];$words_rupees=$results["words_rupees"];$auction_dt=$results["auction_dt"];$mining_contract=$results["mining_contract"];$words_mining=$results["words_mining"];
		$officer_rs=$results["officer_rs"];$officer_rupees=$results["officer_rupees"];$security_name=$results["security_name"];$shri=$results["shri"];
		$resident=$results["resident"];$re_district=$results["re_district"];$veins_seam=$results["veins_seam"];
		$village_situated=$results["village_situated"];$sub_division=$results["sub_division"];$land_district=$results["land_district"];$dag_no=$results["dag_no"];$patta_no=$results["patta_no"];$an_area=$results["an_area"];$north=$results["north"];$south=$results["south"];$east=$results["east"];$west=$results["west"];$premises_dt=$results["premises_dt"];$for_term=$results["for_term"];$cubic_metres=$results["cubic_metres"];
		
		$rs_occupied=$results["rs_occupied"];$rent_rupees=$results["rent_rupees"];$contra_sig=$results["contra_sig"];$governor_assm=$results["governor_assm"];$surety_sig=$results["surety_sig"];	
	}
	$form_name=$formFunctions->get_formName($dept,$form);
	$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
		if(!isset($css)){
		$printContents='<!DOCTYPE html>
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
		<tbody>
		
		<tr>  				
			<td colspan="2">This indenture made on this day&nbsp;&nbsp;'.strtoupper($indenture_dt).'&nbsp;&nbsp;between the Governor of Assam acting through&nbsp;&nbsp;'.strtoupper($acting_through).'&nbsp;&nbsp; (hereinafter referred to as the "State Government") which expression shall where the context so admits, include the successors and assigns) of the one part; and.
			</td>
		</tr>
		
		<tr>  				
			<td>Enterprise Name and Address :</td>
			<td>
			<table class="table table-bordered table-responsive">
				<tr>
						<td>Enterprise Name :</td> 
						<td>'.strtoupper($unit_name).'</td>
				</tr>
				<tr>
						<td>Street Name1 :</td>
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
						<td>Mobile</td>
						<td>+91 - '.strtoupper($b_mobile_no).'</td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<table class="table table-bordered table-responsive">
					<thead>
						<tr>
							<th>Sl. No.</th>
							<th>Partners/Directors Name</th>
							<th>Street Name 1</th>
							<th>Street Name 2</th>
							<th>Village/Town</th>
							<th>District</th>
							<th>Pincode</th>
						</tr>
					</thead>';
					$results1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_members where form_id='$form_id'") ;
							$sl=1;
							while($rows=$results1->fetch_object()){
								$printContents=$printContents.'
					<tr align="center">
						<td>'.$sl.'</td>
						<td>'.strtoupper($rows->name).'</td>
						<td>'.strtoupper($rows->sn1).'</td>
						<td>'.strtoupper($rows->sn2).'</td>
						<td>'.strtoupper($rows->vill).'</td>
						<td>'.strtoupper($rows->dist).'</td>
						<td>'.strtoupper($rows->pin).'</td>
					</tr>';
						$sl++;
						}$printContents=$printContents.'
				</table>
			</td>
		</tr>
		<tr>  				
			<td colspan="2">Whereas the "permit holder" has offered the highest bid of Rs '.strtoupper($bid_rs).' (in words Rupees '.strtoupper($words_rupees).'  )in the bid/auction held on  '.strtoupper($auction_dt).' for obtaining a mining contract for '.strtoupper($mining_contract).' cu.m (in words '.strtoupper($words_mining).' cubic metres) '.strtoupper($cubic_metres).' (name of the minor minerals ) in respect of the lands hereinafterdescribed in clause 2 and such bid had been accepted by the officer authorized in this behalf and thePermit holder has deposited with the Government , a sum of Rs '.strtoupper($officer_rs).' (Rupees '.strtoupper($officer_rupees).') as initial bid security (10% of the annual bid amount ) and Shri '.strtoupper($security_name).' S/o Shri '.strtoupper($shri).' resident of '.strtoupper($resident).' District '.strtoupper($re_district).' (referred to as the surety which expression shall where the context so admits , include his heirs,executors , administrator ,representatives ) has been offered as solvent surety for the aforesaid amount ,and whereas the permit holder is in possession of a Income Tax Clearance Certificate. 			
			</td>
		</tr>
		
			<tr>  				
				<td colspan="2">Now, therefore, this deed witnesses and the parties hereby agree as follows:-</td>
			</tr>
		  <tr>  				
			   <td colspan="2">(1) In consideration of the permit money,covenants and agreements hereinafter contained and on the part of the permit holder to be paid, observed and performed the Government hereby grants and demises into the permit holder all those mines/beds/veins/seams of &nbsp;&nbsp;&nbsp;'.strtoupper($veins_seam).'&nbsp;&nbsp;&nbsp; (hereinafter referredto as the said minor minerals) situated, lying and being in or under the lands which are referred to inclause 2 together with the liberties and privileges to be executed or enjoyed in connection herewith whichare hereinafter mentioned in Part-I subject to the restrictions and conditions as to exercise and enjoymentof such liberties and privileges which are hereinafter mentioned in Part-II and subject to other provisions of this permit.			
			</td>
		</tr>
		 <tr>  				
			   <td colspan="2">(2) All the tract of land situated at village&nbsp;&nbsp;'.strtoupper($village_situated).'&nbsp;&nbsp;in Sub-Division&nbsp;&nbsp;&nbsp;'.strtoupper($sub_division).'&nbsp;&nbsp;&nbsp;District&nbsp;&nbsp;&nbsp;'.strtoupper($land_district).'&nbsp;&nbsp;&nbsp;bearing Dag and Patta Nos.&nbsp;&nbsp;'.strtoupper($dag_no).' and '.strtoupper($patta_no).'&nbsp;&nbsp;Containing an area of&nbsp;&nbsp;'.strtoupper($an_area).'&nbsp;&nbsp;or thereabouts delineated on the plan hereto annexed and bounded as follows:		
			</td>
		</tr>
		<tr>
				<td>On the North by</td>
				<td>'.strtoupper($north).'</td>
		</tr>
		<tr>
				<td>On the South by</td>
				<td>'.strtoupper($south).'</td>
		</tr>
		<tr>
				<td>On the East by</td>
				<td>'.strtoupper($east).'</td>
		</tr>
		<tr>
				<td>On the West by</td>
				<td>'.strtoupper($west).'</td>
		</tr>
		 <tr>  				
			   <td colspan="2">(3)The Contractor shall hold the premises hereby granted and demised from the day &nbsp;&nbsp;'.strtoupper($premises_dt).'&nbsp;&nbsp; for the term of&nbsp;&nbsp;'.strtoupper($for_term).'&nbsp;&nbsp;years thence next ensuing.</td>
		</tr>
		
	
		
		<h4 style="text-align:center">Part-I<br/>Liberties and Privileges</h4>
		<p>The following liberties and privileges may be exercised and enjoyed by the permit holder subject to the
        other provision of permit:-</p>
			
		<ol type="1">
		    <li><b>To enter upon Land and search for win, work:-</b><br/>Liberty at all times during the term hereby demised to enter upon the said lands and to search for mineral, bore, dig, drill for win, work, dress, process, convert, carry away and dispose of the said minor mineral (s).</li>
			<li><b> To sink, drive and make pit, shafts and inclines: </b><br/>Liberty to sink, drive, make, maintain and use in the said land and pits, shafts, inclines, drifts, levels waterways , airways , and other works and to use , maintain , deepen or extend any existing works of the like nature in the said lands.</li>
			<li><b>To bring and use machinery, equipment:</b><br/>Liberty to erect , construct , maintain and use on or under the said lands any engine, machinery, plan,dressing floors and furnaces , coke ovens , brick kilns, workshop, store houses, bungalows , godowns ,shed and other buildings and other works and conveniences of the like nature on or under the said lands.</li>
			<li><b> To use water from streams: </b><br/>Liberty but subject to the rights of any existing or future Permit holder and with the written permission of the Collector concerned to appropriate and use water from any streams, water course, springs :<br/>Provided that the permit holder shall not interfere with navigation in any navigable stream nor shall divert such stream without the previous written permission of the Government.</li>
			<li><b> To Fell undergrowth and utilize timber and trees:</b><br/>Liberty to clear undergrowth and brush wood. Permit holder shall not fell any trees or timber standing or found on the said lands without obtaining prior permission in writing from the Forest Department. In case such permission is granted, he shall pay in advance, the price of the trees or timber to be felled to the said Officer at the rates fixed by him.</li>
			<li><b> To get building and roads material:</b><br/>Liberty to quarry and get stones, gravel and other building and road materials and ordinary clay and to use and employ the same and to manufacture such clay into bricks or tiles and to use such bricks , tiles but not sell any such material, bricks, tiles.</li>
			<li><b> To use land for stacking purpose:</b><br/>Liberty to use a sufficient part of the surface of the said lands for the purpose of stocking , storing or depositing therein any produce of the mines including over burden or waste material and works carried on and tools, equipment and other materials needed for mining operations.</li>
			<li><b> To install fuel pumps or stations for Diesel or Petrol for self use:</b><br/>Liberty to use a sufficient part of the land for installing fuel pumps or stations for diesel or petrol for self use or consumption required for mining operations in the permit area, subject to permission of the authority.</li>
			<li><b> To construct magazine for explosive and storage sheds:</b><br/>Liberty to construct magazine for storage of explosive and storage sheds for explosive related substances with permission from the competent authority, in this behalf.</li>
			<li><b> Liberty to seek permission for diversion of public roads, overhead electric lines:</b><br/>Liberty to request to the competent authority for diversion of public road over head electric lines passing through the concession area at the expenses of permit holder to ensure scientific and systematic mining.</li>
		</ol>
        
	<h4 style="text-align:center">Part-II<br/>Restrictions</h4>
		<p>The liberties, powers and privileges granted under Part- I subject to the following restrictions and subject
          to other provisions of this permit:-</p>
		<ol type="N">
		  <li><b>No mining operations within the limit of public works:</b></li>
		  <p>The permit holder shall not carry on, or allowed to be carried on any mining:-</p>
		  <ol type="I">
			<li>Within a distance of fifty metres from the outer periphery of the defined limits of any village habitation, National Highway, State Highway and other roads where use of explosives is required, unless specifically relaxed and permitted by the competent authority</li>
			<li>within a distance of two hundred fifty metres from the outer periphery of the defined limits of any village habitation , National Highway , State Highway and other roads where use of explosives is required, unless specifically relaxed and permitted by the competent authority or any specific dispensation is obtained from the Director, Mines Safety; or</li>
			<li>Within a distance of 500 metres from major structures like R.C.C Bridges, Guide bund etc; or</li>
			<li>Within a distance of seventy metres from any railway line or bridge except under and in accordance with the written permission of the railway administration concerned . The Railway Administration or the government may in granting such permission, impose such conditions, as it may deem fit.</li>
		   </ol>
		 <br/>
		<p><b>Explanation:-</b>For the purpose of this clause , the expression  &#39;Railway Administration&#39;  shall have the same meanings as it is defined by the sub section (4) of the section 3 of the Indian Railway Act , 1890 ( ):</p>
		 
		<p>Provided that where the continuance of any mining operations in any area, in the opinion of the Government is likely to endanger the safety of any National or State Highway, road, bridge, drainage, reservoir, tank, canal or other public works or public or private buildings or in the public interest or in the interest of environment or ecology of the area, the Government may determine the permit after giving sixty days notice to the permit holder in this behalf and the permit shall stand terminated on the date mentioned in the notice.</p>
		<p> &nbsp;&nbsp;Provided further that in the State of National Emergency or War, the permit may be determined without giving such notice</p>
	
		
	      <li><b>Working in Sand zones:</b>That the permit holder in respect of sand zones, shall restrict the quarrying operations to maximum four villages of the zone at any point of time during the subsistence of the permit. The permit holder shall have a right to change the site at any time during the subsistence of the permit on settlement of compensation with the land owners of new site of the zone from where he intend to extract sand but ceiling of maximum four villages shall be adhered to strictly and such change of site shall be intimated to the competent authority.</li>
		  <li><b>Special Conditions for river bed mining:</b>In case of river bed mining or excavation of minor mineral(s), in order to ensure safety of river-beds, structures and the adjoining areas, the following special conditions shall be abide by the permit holder :-
		  <ol type="a">
		  <li>No mining would be permissible in a river- bed up to a distance of five times of the span of a bridge on up - stream and ten times the span of such bridge on downstream side , subject to a minimum of 250 metres on the up-stream side and 500 metres on downstream side;</li>
		  <li>there shall be maintained an un-mined block of 50 metres width after every block of 1000 metres over which mining is undertaken or at such distance as may be directed by the competent authority;;</li>
		  <li>The maximum depth of mining in the river- bed shall not exceed three metres measured from the un-mined bed level at any point in time with proper bench formation;</li>
		  <li>Mining shall be restricted within the central 3/4 th width of river/rivulet.</li>
		  <li>No mining shall be permissible in an area up to width specified by the competent authority in public interest.</li>
		</ol>
		</li>
		<li><b>Notice for surface operation in land not already in use:</b><br/>Before using for surface operations any land which has not already been used for such operation, the permit holder shall give notice in advance to the Collector of the district, the Director and the Officer-in-Charge___________ in writing along with copy of permission to undertake mining specifying the situation and extend of the land proposed to be so used and the purpose for which the same is required and the said land shall not be used, if objection is issued by the Collector.</li>
		<li><b>Not to use the land for the other purposes:</b><br/>The permit holder shall not cultivate or use the land for any other purpose other than those specified in the permit agreement.</li>
		<li><b>Disposal of mineral(s) only on issuance of mineral transit challan:</b><br/>The holder of mining permit shall not sell or dispose off any mineral or mineral products from the concession area without a mineral transit pass.</li>
		<li><b>Stacking of mineral(s) inside permit hold area :</b><br/>The permit holder shall not stock the mineral(s) excavated inside the permit hold area at the designated site more than twice the quantity of the average monthly production as per approved mining plan or scheme.</li>
		<li><b>Stacking of mineral (s) outside permit hold area: </b><br/>The permit holder shall not stock any minor mineral(s) granted under the permit, outside the permit hold area.</li>
		<li><b>Stacking and storage of incidentally extracted major minerals:</b><br/>In case of Permit holder, while extracting minor mineral given on permit, incidentally extracts any major mineral not given on permit, the same shall be the property of the Government and Permit holder shall be under an obligation to stack and store it and maintain its proper record in accordance with the direction of the competent authority who shall also be competent to prescribe the procedure for its disposal and in case it is detected that permit holder has disposed off incidentally extracted major mineral in this clause or in the rule , in whole or part there of or failed to maintain the record of stored mineral, he shall be liable to penalties under the act and also premature determination of mining permit in terms of the rules.</li>
		<li><b>Restrictions of mining operations above ground water table:</b><br/>A safety margin of two metres shall be maintained above the ground water table while undertaking mining and no mining operations shall be permissible below this level unless a specific permission is obtained from a competent authority in this behalf.</li>
		<li><b>Restrictions of surface operations:</b><br/>No mining operations shall be undertaken in any area prohibited by any authority or by the orders of any Court.</li>
		<li><b>No mining operations without requisite clearance: </b><br/> The permit holder shall not undertake any mining operations in the area granted on mining permit without obtaining requisite clearance from the competent authority as required for undertaking mining operations.</li>
	</ol>	

		<h4 style="text-align:center">Part-III<br/><br/><b>Covenants of the permit</b><br/><br/>The permit holder hereby covenant with the government as follows:-</h4>
		<ol type="1">
		<li><b>Surface rent:</b><br/>The permit holder shall pay for the surface area occupied by him, surface rent at the rate of Rs '.strtoupper($rs_occupied).' (Rupees '.strtoupper($rent_rupees).') Per annum.</li>
		<li><b>Security Deposit:</b><br/>The permit holder shall deposit 25% of the annual bid amount or rate of permit money as security. The security amount shall be deposited as per following:-</li>
        
		<ol type="I">
		<li>ten percent as initial bid security at the time of auction; and</li>
		<li>fifteen percent of the annual bid amount before commencement of mining operations or before the
         expiry of period allowed;</li>
		</ol>
		<li><b>Mode of Payment of permit money and surface rent:</b><br/></li>
		 <ol type="a">
		  <li>The permit holder shall deposit one advance installment of permit money before commencement of mining operations or before the expiry of period allowed along with fifteen percent of the balance security amount as per clause 2 above.</li>
		  <li>The permit holder, during the subsistence of the permit, shall pay in advance to the Government the
			installments of the permit money in respect of the said land given to him on mining permit in four
			quarterly installment on the 1 st April, 1 st of June, 1 st of September and 1 st of December.</li>
		 </ol>
		<p><b>Note: </b> The amount of one advance installment deposited at the time of commencement of the mining
			operations or within time allowed for the same shall be adjusted in a manner that the subsequent
			installments are payable for a full calendar month or quarter or year, as the case may be.</p>
		<li><b>Amount to be deposited on account of Fund</b><br/>Where the Permit holder is operating the area, he shall also pay an additional amount equal to 10% of the due permit money along with the amount of installments on account of the dead rent or royalty , towards the Fund.</li>
		
	<table style="width:100%">
		<tr>
		  <th>Serial Number</th>
		  <th>Period of delay</th>
		  <th>Rate of Interest applicable</th>
		</tr>
		<tr>
			<td>(i)</td>
			<td>If paid within a period of 7 days from the due date</td>
			<td>A grace period of up to 7 days is allowed without any interest.</td>
		</tr>
		<tr>
			<td>(ii)</td>
			<td>If paid after 7 days but up to 30 days of the due date</td>
			<td>15% on the amount of default for the period of default including the grace period.</td>
		</tr>
		<tr>
			<td>(iii)</td>
			<td>If paid after 30 days but within 60 days of the due date.</td>
			<td>18% on the amount of default for the period of default including the grace period.</td>
		</tr>
		<tr>
			<td>(iv)</td>
			<td>Delay beyond 60 days of the due date.</td>
			<td>It would amount to a &#39;breach&#39;, invite action for termination of teh contract and the entire outstanding amount would be recoverable along with interest calculated @ 21% for the entire period of default.
		    </td>
		</tr>
	</table>
	<li><b>Interest on delayed payments:</b><br/>In case of any default in payment of the installments of permit money contribution to the Fund on the due dates(s), the amount would be payable along with interest at the following rates:</li>
    <li><b>Working of newly discovered minerals:</b><br/>
	If any minor not specified in the permit, is discovered in the permit area, the Permit holder shall
	report the discovery without delay to the competent authority and shall not win or dispose of such
	minor mineral without obtaining a separate mineral concession/lease for such mineral. If he fails to
	apply for such mineral concession/lease for such mineral. If he fails to apply for such a mineral
	concession within six months from the discovery of the minor mineral, the competent authority may
	give the mineral concession in respect of such mineral, to any other person:<br/>Provided that the grant of such permit may be refused for reasons to be recorded in writing.</li>
	<li><b>To commence mining operations within one hundred eighty days and carry them on properly.</b><br/>Unless the competent authority for sufficient cause otherwise, the permit holder shall commence mining operations one hundred eighty days for the date of execution of the permit and shall thereafter conduct such operations in a proper, skilful and workman like manner.<br/>
	<b>Explanation:-</b>For the purpose of this clause, mining operations shall include the erections of machinery laying of a tramway or constructions of a road in connection with the working of the mine.</li>	
	<li><b>To erect and maintain boundary pillars :</b><br/>The permit holder shall at his own expenses, erect and at all times maintain and keep in good repairs boundary marks and pillars according to the plan annexed to the permit Each of the pillars should be numbered and every pillar shall have GPS reading.</li>	
	<li><b> Accounts :</b><br/>The permit holder shall keep correct accounts showing the quantity and other particulars of all the minerals obtained from the mines and the number of persons employed therein and a complete plan of the mine and shall allow any officer authorised by the Government of the Central Government or the competent authority in that behalf to examine at any time any accounts and records maintained by him, and shall furnish to the Government or the Central Government of the competent authority with such information and returns as it may be require.</li>
	<li><b>To allow facilities to other concession holders.</b><br/>The permit holder shall allow existing and future concession holders &#39;of any land which is comprised in or adjoins or is reached by the land, held by the lessee, reasonable facilities for access thereto.</li>	
	<li><b>To allow entry to officers:</b><br/>The permit holder shall allow any officer authorised by the Government or the Central Government or the competent authority to enter upon any building, excavation or land comprised in the permit area for the purpose of inspecting the mines.</li>	
	<li><b>Returns :</b><br/>The permit holder shall: -</li>
     <ol type="a">
	    <li>Submit a return in form `MMP1&#39; by the 7th of every month to the competent authority and also to
		other officer (s) specified giving the total quantity of minor mineral(s) raised and dispatched from the
		permit area in the preceding calendar month and its value.</li>
	   <li>Also furnish a statement giving information in Form `MMP2&#39; by the 15th April every year to the
		competent authority and to other Officer(s) regarding quantity and value of minor mineral obtained
		during last financial year average number of regular labourers employed (men and women separately)
		number of accidents, compensation paid and number of days worked separately.</li>
	</ol>	 
	<li><b>To strengthen and support the mines:</b><br/>The permit holder shall strengthen and support to the satisfaction of the Railway Administration or the State Government, as the case may be any part of the mine which in its opinion requires such, strengthening or support for the safety of any railway, bridge, national highway, reservoirs, canal, road or any other public work or building.</li>
    <li><b>Notice for use of explosives, etc:</b><br/>The permit holder shall immediately inform in writing in Form MSE1 in case of (a) working in the mines extends below superjacent ground; or (b) depth of any open cast excavation measured from its highest to the lowest point reaches six metres; or(c) number of persons employed on any day is more than 50 or (d) any explosives are used to the following:</li>
	
	<ol type="N">
		<li>The Controller General, Indian Bureau of mines, Government of India, Nagpur;</li>
		<li>The Director General of Mines Safety, Government of India, Dhanbad;</li>
		<li>The Director, Mines Safety, Government of India, Guwahati;</li>
		<li>The Regional Controller of Mines, Indian Bureau of Mines, Kolkata;</li>
		<li>The competent authority;</li>
		<li>The District Magistrate of the District concerned; and</li>
		<li>The Officer-in- Charge.</li>
   </ol>
   <li><b>Maintenance of sanitary conditions</b><br/>The permit holder shall maintain sanitary conditions in the area held by him under the permit.</li>
   <li><b>To pay compensation for damage and indemnify the Government:</b><br/>The permit holder shall make and pay such reasonable satisfaction and compensation for all damage, injury or disturbance which may be done by him in exercise of the powers granted by the lease and shall indemnify the Government against all claims which may be made by third parties in respect of such damage, injury or disturbance.</li>
   <li><b>Application of all Acts, Rules and Regulations to this permit :</b><br/>The Permit holder shall abide by the provisions of Mines Act, 1952 and the rules and regulations
		framed there under and also the provisions of other labour laws both Central and State as are
		applicable to the workmen engaged in the mines and quarries relating to the provisions of drinking
		water, rest shelters, dwelling houses, latrines and first-aid and medical facilities in particular and other
		safety and welfare provisions in general, to-the satisfaction of the competent authorities under the
		aforesaid Acts, Rules and Regulations and also to the satisfaction of the District Magistrate
		concerned. In case of non compliance of any of the provisions of the enactments as aforesaid, the
		competent authority may terminate the mining lease by giving one month&#39;s notice with forfeiture of
		security deposited:<br/>Provided that the permit holder shall carry out mining operations in accordance with all other provisions as applicable for undertaking mining including the provisions of Forest (Conservation) Act, 1980 and Environment (Protection) Act, 1986 and the rules made there under.</li>
   <li><b>To report accident :</b><br/>The permit holder shall without delay report to the Deputy Commissioner of the district concerned and the competent authority or any other officer authorised by him, any accident which may occur at or in the permit area.</li>
  <li><b>Delivery of possession of land and mines on the surrender or sooner determination of the permit:</b><br/>At the end or sooner determination or surrender of the permit, the permit holder shall deliver up the said lands and all mines (if any dug there) in a proper and workable state, save in respect of any working as to which the Government might have sanctioned abandonment.</li> 
  <li><b>To secure pits/shafts and not fill them up :</b><br/>The permit holder shall well and properly secure pits and shafts and will not without permission in writing, willfully close, fill up or close any mine of shaft.</li>
  <li><b>Not to enter upon or to commence operations in the reserved or protected forest.</b><br/>The permit holder shall not enter upon or commence any mining operations in any forest land comprised in the leased area except after previously obtaining permissions in writing of the Forest Department.</li>  
  <li><b>To respect water rights and not injure adjoining property :</b><br/>The permit holder shall not injure or cause to deteriorate any source of water, power or water supply and shall not in any other way render any spring or stream or water unfit to be used or to do anything to injure adjoining land, villages or houses.</li>
  <li><b>Stocks lying at the end of the permit :</b><br/>&nbsp;&nbsp;&nbsp;(a) The permit holder on expiry of the permit period (successful completion of the permit) shall remove already extracted the entire mineral from the premises of the quarry within a period of seven days. In case any quantity of the already extracted mineral, m the said land is left undisposed off and is
	not removed within seven days from the date of expiry of the period of permit the same shall be deemed
	to be the property of the Government and competent authority may dispose it off in any manner it may
	like without paying anything thereof to the Permit holder.<br/>&nbsp;&nbsp;&nbsp;(b) The permit holder on the termination or sooner determination of the permit shall not remove extracted mineral from the premises of the permit areas. All extracted minerals in the said lands left over un-disposed after the termination or determination of lease shall be deemed to be property of the Government and competent authority may dispose it off in any manner it may like without paying anything thereof to the Permit holder.</li>
  <li><b>Payment of taxes:</b><br/>The permit holder shall duly and regularly pay to the appropriate authority all taxes, cesses and local dues in respect of the permit area, said minor minerals or the working of the mines.</li>
  <li><b>Payment of additional amount for reclamation/restoration: </b><br/>The permit holder shall also pay additional amount equal to 10% of the amount of the permit money by the 7 th of every month to ensure the compliance of the Reclamation and Restoration works. This additional amount shall be refunded after satisfactory reclamation or restoration of the area after mining in accordance with the mine closure plan:<br/>Provided that in case the Permit holder fails to reclaim or restore the area the area as per mining plan to the satisfactions of the Government, the amount deposited in the joint account shall be forfeited and used for the restoration of the area.<br/>Provided further that in case no rehabilitation position of the mine comes during the tenure of the mining permit, the amount so deposited shall be kept by the Government in the mining area development fund for future use as when the mine reaches to a stage requiring restoration and rehabilitation.</li>
  <li><b>Assign sublet or transfer of the permit area :</b><br/>The permit holder shall not assign, sublet or transfer the permit area to any person without obtaining prior permission in writing from the competent authority.</li>
  <li><b>Fencing of working place :</b><br/>If a working place is found to be unsafe, all persons shall be withdrawn by the permit holder immediately from the dangerous area and all access to such working place except for the purpose of removing the danger or saving life shall be prevented by securely fencing the full width of all entrances to the place, at his own cost.</li>
  <li><b>Fencing of excavation after termination or sooner determination of the permit :</b><br/>The permit holder on termination or sooner determination of the permit, shall at his own cost, suitably fence the excavations for safety as instructed by the competent authority.</li>
  <li><b>Felling of trees:</b><br/>The permit holder shall not fell or cut any tree, standing on the land wherein the quarry is located without obtaining prior permission in writing from the Forest Department and paying its price as fixed.</li>
  <li><b>Security deposit shall carry no interest:</b><br/>The security deposited by the&#39; permit holder shall not carry any interest. It shall be refunded to the permit holder within three months from the date of expiry or sooner determination. of the permit in case the same is otherwise not forfeited or is not required to be detained for any other purpose.</li>
  <li><b>Government not responsible for loss to Permit holder :</b><br/>The Government shall not be responsible for any kind of loss to the Permit holder.</li>
</ol>
 <h4 style="text-align:center"><b>Part-IV</b><br/>Rights of the State Government</h4>
 <ol type="1">
   <li><b>The Suspension or Termination of the permit :</b><br/>The competent authority shall have the right to suspend or prematurely terminate the permit.</li>
   <ol type="a">
	   <li>If the permit money or royalty or surface rent or any other amount due to the Government are not paid.</li>
	   <li>if any of the terms and conditions of the permit agreement or conditions of grant or permission to undertake mining by any other statutory authority/Competent authority is violated.</li>
	   <li>if any of the provisions of these rules and other laws both Central and State as are applicable to mines and minerals, are not complied with :</li>
	   <p>Provided that no orders of suspension or termination of the permit shall be passed by the
		competent authority without giving reasonable opportunity to show cause and following the procedure
		prescribed in the Rules:</p>
	   <p>Provided further that in case of default in payment of Government dues such as permit money,
		royalty, dead rent or any other dues payable under these presents, the permit may be terminated by the
		competent authority without affording hearing to the permit after serving upon a notice to make good
		the payment within thirty days.</p>
		<p>Provided further that the competent authority may also at any time after issuance of the notice for
		default on account of nonpayment of dues, enter upon the said premises and detrain all or any of the
		mineral or movable property therein and may carry away, detain or order the sale of the property so
		detrained, or so much.of it as will suffice for the satisfaction i of the permit money or rent or royalty
		or both dues and all costs and expenses occasioned by the non-payment thereof.</p>
  </ol>
	  <li><b>Determination of permit area in public interest:</b><br/>The Government may be given six months prior notice in writing determine the permit if the Government consider that the minor mineral under the permit is required for establishing an Industry beneficial to the public.<br/>Provided that in the State of national emergency or war, the permit may be determined without giving such notice.</li> 
	  <li><b>Right of pre-emption :</b><br/>The government shall from time and at all times during the terms of permit have the rights (to be exercised by notice in writing to the permit holder) of pre-emption of the said mineral(s) and all
		products thereof lying in or upon the said lands hereby demised or elsewhere under the control of the
		permit holder and the permit holder shall deliver all minerals or products thereof to the Government at
		current market rates in such quantities and in the manner at the place specified in the notice exercising
		the said right.</li> 
	  <li><b>Penalty for not allowing entry to officers:</b><br/>If the permit holder or his transferee or assignee does not allow any entry or inspection under clause 11 of part-111, the competent authority may cancel the permit and forfeit in whole or inpart the security deposit paid by the permit holder.</li>
	  <li><b>Compensation and acquisition of land of third parties thereof :</b><br/>In case the occupier(s) or owner(s) of the said land refuses his consent to the exercise of the
		rights and powers reserved to the Government and demised to the permit holder under these presents,
		the permit holder shall report the matter to the competent authority who shall request the Collector of
		the district concerned to direct the occupier(s) or owner(s) to allow the permit holder to enter the said
		lands and to carry out such operations, as may be necessary for working the mine, on payment in
		advance of such compensation to the occupier or owner by the permit holder, as may be fixed by the
		Collector concerned under the rules.</li>
	  <li><b>Suspension of mining operations:</b><br/>The Director may order to suspend the mining operations after serving a notice to the permit holder, in case, the following violations are noticed:-</li>
	  <ol type="a">
	     <li>Unsafe and unscientific mining; or</li>
         <li>Non providing of safety appliances to the workers; or</li>
		 <li>Nonpayment of compensation to the surface owners; or</li>
		 <li>nNon submissions of monthly returns;</li>
      </ol>
     
      <p>In case of violations of the aforesaid conditions and also any other terms and conditions of the
		agreement deed and the provisions of the rules, the competent authority may give a notice to the
		permit holder to remedy the violations within a period of fifteen days from the date of issue of the
		notice. In case, the violations pointed out through notice, are not remedied within the stipulated period
		of fifteen days, the competent authority may after affording an opportunity of being heard to the
		Permit holder, order the suspension of the mining operations till such time, the defaults/ defects are
		removed by the Permit holder within the time frame granted by the competent authority. During the
		period of suspension of mining operations, the permit holder will be allowed only, to undertake
		rectification work for removal of the defects and shall not dispose off the mineral: During the
		suspension period, the Permit holder shall be under the obligation to deposit the amount of the Govt.
		dues on the due dates.<br/>On satisfactory removal of the defects, the competent authority may revoke the suspension orders
		with or without any modification. Non removal of the defects or defaults during the &#39;suspension
		period and within the time allowed by the competent authority, shall lead to premature termination of
		permit.</p>
  </ol>
  <h4 style="text-align:center"><b>Part-V</b><br/><b>General</b></h4>
    <ol type="1">
		 <li><b>Cancellation:</b><br/>The permit holder shall be liable to be cancelled by the competent authority if the permit holder cease to work the mine for a continued period of one hundred eighty days without obtaining written sanction.</li>
		 <li><b>Notices :</b><br/>Every notice by these presents required to be given to the permit holder shall be given in writing to such person resident on the said lands as the permit holder may appoint for the purpose of receiving such notices and if there shall have been no such appointment then every notice shall
			be sent to the permit holder by registered post addressed to the permit holder at the address
			recorded in this permit or at such other address in India as the permit holder may from time to
			time in writing to the competent authority designate for the receipt of notices and every such
			service shall be deemed to be proper and valid service upon the permit holder sand shall not be
			questioned or challenged by him.</li>
		 <li><b>Recovery of Government dues as arrears of land revenue :</b><br/>Without prejudice to any other mode of recovery authorised by any provision of this permit or by any law, all amounts, falling due hereunder against the Permit holder may be recovered as arrears of land revenue under the law in force for such recovery.</li>
		 <li><b>Forfeiture of property left more than three months after expiry or determination of permit:</b>The permit holder shall remove his property lying on the said lands within three months after the
			expiry or sooner determination of the permit. The property left after the aforesaid period of three
			months shall become the property of the Government and may be sold or disposed off in such
			manner , as the competent authority shall deem fit, without liability to pay any compensation
			therefore, to the permit holder.</li>
		<li>Security and forfeiture thereof:</li>
		 <ol type="a">
		   <li>The competent authority may forfeit the whole or any part of the amount deposited as security under this permit, in case the permit holder commits a breach of any covenants to be performed by permit holder under the permit.</li>
		   <li>Whenever the said security deposit or any part thereof or any further sum hereafter deposited
			with the Government in replenishment thereof is forfeited under sub clause (a) or applied by the
			competent authority under the permit (which the competent authority is hereby authorised to) the
			permit holder shall immediately deposit with the inappropriate part thereof to bring the amount
			in deposit with the Government up to the requisite amount of security at the point of time of
			permit .</li>
		  <li>The rights conferred to the competent authority by clause (a) shall be without prejudice to the rights conferred on the Government by any other provision of this permit or by any law.</li>
		  <li>On such date, as the competent authority may decide, within twelve calendar months after the
			determination of this permit or refusal of any renewal thereof, the amount of security deposit
			paid in respect of this permit and then remaining in deposit with the Government and not
			required to be applied to any of the purposes mentioned in this permit shall be refunded to the
			permit holder. No interest shall run on the security deposit.</li>
		</ol>
		<li><b>Survey and demarcation of the area:</b><br/>When a mining permit is granted, arrangement shall be made, if necessary, at the expense of the
		permit holder, for the survey and demarcation of the area granted under the permit. The permit
		holder shall have to bear actual expenses of the staff deputed for the work. Actual expenses will
		include travelling allowances, daily allowances and salary of staff plus ten percent as instrument
		charges.</li> 
		 <li><b>Surrender of a mining permit by the Permit holder:</b><br/>The Government may accept the request of the permit holder for surrender for surrender of a permit or part thereof in cases where it is established that it has not been found feasible to operate the permit grant for whatsoever reasons subject to the conditions that the permit holder:</li>
		 <ol type="I">
		    <li>has been regular in furnishing the production returns as required in the terms of the permit agreement ;</li>
		    <li>has been taking the requisite steps for the progressive mine closure plan as per the conditions of the permit grant;</li> 
		    <li>is not in default of payment of any dues of the Government as on the date of making such
				application and undertakes to pay all such dues till the date of expiry of the notice period either
				in cash in advance or by away of adjustment of the security or both;<br/>Provided that in case the permit holder makes an application for surrender of part area of
				the permit, it shall not result in any prorated reduction of the permit money and the rate of permit
				money payable and applicable for the entire area at the time of such application shall remain
				intact.</li>		
		 </ol>
	
		<li><b>Penalty for repeated breaches:</b><br/>In case of repeated breaches of covenants and agreements by the permit holder for which notice has been given by the competent authority in accordance with sub-rule (1) of rule 55 and/or clause (i) of the sub rule (1) of rule 56 on earlier occasions , the Director. Without giving any further notice, may impose such penalty not exceeding twice the amount of annual permit money.</li> 
		<li><b>Obtaining sales tax number :</b><br/>The permit holder shall get himself registered with the Taxation Department of Assam and shall obtain the Sales Tax number..</li> 
		 <li><b>Overriding effect :</b><br/>Unless otherwise specifically provided, it is agreed that this deed shall be Governed by the provisions of the Mines and Minerals (Development and Regulation) Act, 1957 (67 of 1957) and the rules made there under. The provisions of the and the rules shall prevail over the terms and conditions of the agreement.</li>
		 
    </ol>
  ';	
			
	$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
	$printContents=$printContents.'  
			
<table width="99%" align="center" border="0" class="table table-bordered table-responsive" style="margin:0px auto;">

	<tr>
		<td>Date : <strong> '.date('d-m-Y',strtotime($results["sub_date"])).'</strong></td>						
		<td align="right">Signature of the Permit holder:<strong>'.strtoupper($contra_sig).'</strong></td>				
	</tr>	
	<tr>
		<td>For and on behalf of the Governor of Assam : <strong>'.strtoupper($governor_assm).'</strong></td>						
		<td align="right">Signature of surety :<strong>'.strtoupper($surety_sig).'</strong></td>				
	</tr>
</table>
</tbody>	
</table>
';
?>

