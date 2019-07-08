<?php
$dept="mines";
$form="9";
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
			$village_situated=$results["village_situated"];$sub_division=$results["sub_division"];$land_district=$results["land_district"];$dag_no=$results["dag_no"];$patta_no=$results["patta_no"];$north=$results["north"];$south=$results["south"];$east=$results["east"];$west=$results["west"];$premises_dt=$results["premises_dt"];$for_term=$results["for_term"];
			$rs_occupied=$results["rs_occupied"];$rent_rupees=$results["rent_rupees"];$contra_sig=$results["contra_sig"];
			$governor_assm=$results["governor_assm"];$surety_sig=$results["surety_sig"];
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
			
    	
	
		<tr>  				
			<td colspan="2">This indenture made on this day  '.strtoupper($indenture_dt).'  between the Governor of Assam acting through  '.strtoupper($acting_through).' (hereinafter referred to as the “State Government” which expression shall where the context so admits, include the successors and assigns) of the one part and.
			</td>
		</tr>
		
		<tr>  				
			<td valign="top" width="50%">Enterprise Name and Address :</td>
			<td>
			<table class="table table-bordered table-responsive">
				<tr>
						<td width="50%">Enterprise Name :</td> 
						<td>'.strtoupper($unit_name).'</td>
				</tr>
				<tr>
						<td width="50%">Street Name1 :</td>
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
							<th width="5%">Sl. No.</th>
							<th width="25%">Partners/Directors Name</th>
							<th width="20%">Street Name 1</th>
							<th width="15%">Street Name 2</th>
							<th width="15%">Village/Town</th>
							<th width="10%">District</th>
							<th width="10%">Pincode</th>
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
			<td colspan="2">Whereas the Contractor has offered the highest bid of Rs '.strtoupper($bid_rs).' (in words Rupees '.strtoupper($words_rupees).' )in the bid/auction held on  '.strtoupper($auction_dt).' for obtaining a mining contract for '.strtoupper($mining_contract).' cu.m(in words '.strtoupper($words_mining).') cubic metres(name of minor minerals) in respect of lands hereinafter described in clause 2 and such bid had been accepted by the officer authorized in this behalf and the Contractor has deposited with the Government,a sum of Rs '.strtoupper($officer_rs).' (Rupees '.strtoupper($officer_rupees).') as initial bid security (10% of the annual bid amount) and Shri '.strtoupper($security_name).' S/o Shri '.strtoupper($shri).' resident of '.strtoupper($resident).' District '.strtoupper($re_district).' (referred to as the ‘surety’which expression shall where the context so admits, include his heirs, executors, administrators,representatives) has been offered as solvent surety for the aforesaid amount, and whereas the contractor is in possession of an Income Tax Clearance Certificate. 			
			</td>
		</tr>
		
			<tr>  				
				<td colspan="2">Now, therefore, this deed witnesses and the parties hereby agree as follows:-</td>
			</tr>
			<tr>  				
				<td colspan="2"><b>Liberties and privileges to be exercised and enjoyed by the Contractor:-</b></td>
			</tr>
			<tr>  				
				<td colspan="2">The following liberties, powers and privileges may be exercised and enjoyed by the contractor subject to the other provisions of contract :-</td>
			</tr>
		  <tr>  				
			   <td colspan="2">(1) In consideration of the contract money , covenants and agreements hereinafter contained and on the part of Contractor to be paid, observed and performed the Government hereby grants and demises in to contractor all those mines/beds/veins/seams of '.strtoupper($veins_seam).' (hereinafter referred to as the said minor minerals), situated , lying and being in or under the lands which are referred to in clause (b) together with the liberties , powers and privileges to be executed or enjoyed in connection herewith which are hereinafter mentioned in Part-I subject to the restrictions and conditions as to exercise and enjoyment of such liberties, and privileges which are hereinafter mentioned in Part II and subject to other provisions of this contract. 			
			</td>
		</tr>
		<tr>  				
			<td colspan="2">(2)All the tract of the land situated at village&nbsp;&nbsp;'.strtoupper($village_situated).'&nbsp;&nbsp; in Sub-Division '.strtoupper($sub_division). ' District '.strtoupper($land_district). ' bearing Dag and Patta No.&nbsp;&nbsp;'.strtoupper($dag_no).'&nbsp;&nbsp;Containing an area of&nbsp;&nbsp;'.strtoupper($patta_no).'&nbsp;&nbsp;or thereabouts delineated on the plan hereto annexed and bounded as follows:		
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
			<td colspan="2">(3)The Contractor shall hold the premises hereby granted and demised from the day &nbsp;&nbsp;'.strtoupper($premises_dt).'&nbsp;&nbsp; for the term of&nbsp;&nbsp;'.strtoupper($for_term).'&nbsp;&nbsp;years thence next ensuing.		
			</td>
		</tr>
		
	
		<h4 style="text-align:center">Part-I<br/>Liberties and privileges to be exercised and enjoyed by the Contractor</h4>
		<p>The following liberties and privileges may be exercised and enjoyed by the contractor subject to other provision of contract:-</p>
			
		<h4>To enter upon land and search for win, work:</h4>
		<ol type="I">
			<li>Liberty at all times during the term hereby demised to enter upon the said lands and to search for mineral, bore, dig, drill for win, work, dress, process, convert, carry away and dispose of the said minor mineral(s).</li>
			<li><b>To Sink, drive and make pit, shafts and inclines : </b><br/>Liberty to sink ,drive, make, maintain and use in the said land and pits, shafts ,inclines, drifts, levels. Waterways, airways and other works and to use, maintain , deepen or extend any existing works of nay like nature in the said Lands.</li>
			<li><b>To Bring and Use machinery, equipment :</b><br/>Liberty to erect, constructs, maintains and use on or under the said lands any Engine, machinery, plan, dressing floors, furnaces, coke ovens, brick kilns, workshop, store houses, bungalows, godowns, shed and other buildings and other works and conveniences of the like nature on or under said lands.</li>
			<li><b>To use water from streams : </b><br/>Liberty but subject to the rights of any existing or future    Contractor and with the written permission of the Collector concerned to  appropriate and use water from any streams, water course, springs or other source in or upon the said lands and to divert, step up or dam any such stream or water -course and collect or impound any such water and to make, construct and maintain any water course, cultivated land, village buildings or watering places for livestock of a reasonable supply of water as before accustomed nor in any way to foul or pollute any streams or springs: provided that contractor/contractors shall not interfere with navigation in any navigable stream nor shall divert such stream without the previous written permission  of the Government.</li>
			<li><b>V. To fell undergrowth and utilize timber and trees :</b><br/>Liberty to clear undergrowth and brush wood. Contractor shall not fell any trees or timber standing or found on the said lands without obtaining prior permission in writing from the Forest Department. In case such permission is granted, he shall pay in advance, the price of the trees/timber to be felled to the said Officer at the rates, fixed by him.</li>
			<li><b>VI.To Get building and roads materials:</b><br/>Liberty to quarry and get stones, gravel and other building and road materials and ordinary clay and to use and  employ the same and to manufacture such clay into bricks or tiles and to use such bricks, tiles but not to sell any such material, bricks, tiles.</li>
			<li><b>VII. To use land for stacking purpose:</b><br/>Liberty to use a sufficient part of the surface of the said lands for the purpose of stocking, storing or depositing therein any produce of the mines including over burden/waste material and works carried on and tools, equipment and other materials needed for mining operations.</li>
			<li><b>VIII. To install fuel pumps or stations for Diesel or Petrol for Self use:</b><br/>Liberty to use a sufficient part of the land for installing fuel pumps or stations for diesel or petrol for self use/ consumption required for mining operations in the contract area, subject to permission of the authority</li>
			<li><b>IX. To construct magazine for explosive and storage sheds:</b><br/>Liberty to construct magazine for storage of explosive and storage sheds for explosive related substances with permission from licensing authority.</li>
			<li><b>X.Liberty to seek permission for diversion of public roads, overhead electric lines:</b><br/>Liberty to request to the competent authority for diversion of public road over head electric lines passing through the concession area at the expenses of lessee to ensure scientific and systematic mining.</li>
		</ol>
        
		<h4 style="text-align:center">Part-II<br/>Restrictions as to the Exercise of the Liberties by the contractor</h4>
		<p>The liberties and privileges granted under Part- I are subject to the following restrictions and subject to
		other provisions of this contract:-</p>
	<ol type="N">
		  <li><b>No Mining operations within the limit of public works:</b><br/>The Contractor shall not carry on, or allow to be carried on any mining operations:-</li>
		  <ol type="I">
			<li>Within a distance of 50 meters from the outer periphery of the defined limits of any village habitation, National Highway, State Highways and other Roads where such excavation does not require use of explosives, unless specifically relaxed and permitted by competent authority ; or</li>
			<li>Within a distance of 250 meters from the outer periphery of the defined limits of any village habitations, National Highway, State Highway and other Roads where use of explosives is required, unless  specifically relaxed and permitted by the competent authority or any specific dispensation is obtained from The Director, Mines Safety ; or</li>
			<li>Within a distance of 500 meters fro major structures like R.C.C bridges, Guide bund etc; or</li>
			<li>Within a distance of 75 meters from any railway line or bridge except under  and in accordance within the written permission of the railway administration concerned. The Railway Administration or the Government may in granting such permission, impose such conditions as it may deem fit.</li>
		  </ol>
		 
            <p><b>Explanation:-</b>For the purpose of this clause the expression Railway Administration shall have the same meanings as it is defined by sub section (4) of section 3 of the Indian Railways Act, 1890:<br/>Provide that where the continuance of any mining operations in any area, in the opinion
            of the Government is likely to endanger the safety of National or State Highway, road,
            bridge, drainage, reservoir, tank, canal or other public works or public or private
            buildings or in the public interest or in the interest of environment / ecology of the area,
            the Government may determine the contract after giving 60 days notice to the
            contractor in this behalf and the contract shall stand terminated on the date mentioned
            in the notice.</p>
            <li><b>Working in Sand Zones:</b><br/>That the contractor in respect of sand zones shall restrict the quarrying operations to maximum four villages of the zone at any point of time during the subsistence of the contract The contractor shall have a right to change the site at any time during the subsistence of the contract on settlement of compensation with the land owners of the new site of the zone from
            where he intend to extract sand but ceiling of maximum four villages shall be adhered to strictly
            and such change of site shall be intimated to the competent authority.</li>
            <li><b>Special conditions for river bed mining:</b><br/>In case of river bed mining/excavation of minor mineral(s),in order to ensure safety of river beds, structures and the adjoining areas, the following special conditions shall be abide by the contractor:-</li>
            <ol type="a">
              <li>No mining would be permissible in a river-bed up to a distance of five times of the span of a bridge on upstream side and ten times the span of such bridge on down –stream side, subject to a minimum of 250 meters on the up-stream side and 500 meters on the downstream side;</li>
              <li>There shall be maintained an un-mined block of 50 metres width after every block of 1000 metres over which mining is undertaken or at such distance as may be directed by the competent authority;</li>
              <li>The maximum depth of mining in the river-bed shall not exceed three metres measured from un-mined bed level at any point in time with proper bench formation;</li>
              <li>Mining shall be restricted within the central ¾ width of the river/rivulet.</li>
              <li>No mining shall be permissible in any area up to a width specified by the competent authority from the active edges of embankments;</li>
              <li>Any other condition(s), as may be required by the competent authority in public interest.</li>
            </ol>
            <li><b>Notice for Surface Operation in land not already use:</b><br/>Before using for surface operations any land which has not already been used for such operation, the contractor shall give notice in advance to the Collector of the district, the competent authority and the Officer-in – charge______________ in writing along with copy of permission to undertake mining specifying the situation and the extend of the land proposed to be so used and the purpose for which the same is required and the said land shall not be so used, if objection is issued by Collector.</li>
            <li><b>Not to use the Land for other purposes:</b>The Contractor shall not cultivate or use the land for any other purpose other than those specified in the contract –deed</li>
            <li><b>Disposal of mineral(s) only on issuance of Mineral Transit Pass:</b><br/>The holder of mining contract shall not sell/dispose off any mineral or mineral products from the concession area without a Mineral transit pass.</li>
            <li><b>Stacking of mineral(s) inside contract hold area:</b><br/>The Contractor shall not stock the mineral(s) excavated inside the contract hold area at designated site more than twice the quantity of the average monthly production as per approved mining plan/scheme.</li>
            <li><b>Stacking of mineral(s) outside contract hold area:</b>The contractor shall not stock any mineral(s) granted under the contract, outside the contract hold area.</li>
            <li><b>Stacking and storage of incidentally extracted major minerals:</b><br/>In Case contractor, while extracting minor mineral given on contract, incidentally extracts any major mineral not given on Contract, the same shall be the property of the Government and Contractor shall be under an obligation to stack and store it and maintain its proper record in accordance with the direction of the competent authority who shall also be competent to prescribe the procedure for its disposal.</li>
            <li><b>Penalties in case of non-compliance of Clause (9) :</b><br/>In case it is detected that contractor has disposed off incidentally extracted major mineral referred to in clause 9 above or in sub rule (15) of rule (38), in whole part or part there of failed to maintain the record of stored mineral, he shall be liable to penalties under the Act and also premature determination of mining contract in terms of sub rule (19) of rule 39 of the said rules.</li>
            <li><b>Restrictions of mining operations above ground Water Table:</b><br/>A safety margin of two metres shall be maintained above the ground water table while undertaking mining and no mining operations shall be permissible below this level unless a specific permission is obtained from the competent authority in this behalf.</li>
            <li><b>Restrictions of surface operations:</b><br/>No mining operations shall be undertaken in any area prohibited by any authority or by the orders of any Court.</li>
            <li><b>No mining operations without requisite clearance:</b><br/></li>
            <li>The contractor shall not undertake any mining operations in the rae granted on mining contract without obtaining requisite clearance from the competent authority as required for undertaking mining operations.</li>
    </ol>

		<h4 style="text-align:center">Part-III<br/><b>Covenants of the contract</b><br/>The Contractor hereby covenant with the Government as follows:-</h4>
	<ol type="1">
		<li><b>Surface Rent:</b><br/>The Contractor shall pay for the surface area occupied by him, surface rent at the rate of Rs '.strtoupper($rs_occupied).' (Rupees '.strtoupper($rent_rupees).') Per annum.</li>
		<li><b>Security Deposit:</b><br/><b>In case of mining contract granted through competitive bid/auction under rule 18:</b></li>
		<p>25% of the annual bid amount/rate of contract money. The security amount to be deposited as per the following:-</p>
		<ol type="I">
		<li>10% as initial bid security at the time of auction; and<br/>(ii) 15% of the annual bid amount before commencement of mining operations:</li>
		<li>Provided on enhancement of the contract money after expiry of every three year period of contract the contractor shall deposit the balance amount of security so as to up-scale the security amount equal to 25% of the revised annual contract money as applicable for one year with respect to next block of three years.</li>
		</ol>
		<li><b>Mode of payment of contract money and surface rent :</b><br/></li>
		 <ol type="a">
		  <li>The contractor shall deposit one advance installment of contract money before commencement of mining operations or before the expiry period allowed along with 15% of balance security amount as per clause 2 above.</li>
		  <li>The contractor, during the subsistence of the contract, shall pay in advance to the Government the installments of the contract money in respect of the said land given to him on mining contract in four quarterly installments on the  1st April, 1st of June, 1st of September and 1st of December of the Year.</li>
		  </ol>
	
		<p><b>Note:</b>The amount of one advance installment deposited at the time of commencement of the mining operations or within time allowed for the same shall be adjusted in manner that the subsequent installments are payable for a full calendar/month/quarter/year, as the case may be.</p>

		<li><b>Amount to be deposited on account of Fund</b>
		<br/>Where the contractor is operating the area, he shall also pay an additional amount, equal to 10% of the due contract money along with amount of installments on account of dead rent or royalty, towards the Fund.</li>
		<li><b>Interest on delayed payments.</b><br/>In case of any default in payments of the installments of contract money/ contribution to the Fund on the due date(s), the amount would be payable along with interest at the following rates:</li>
</ol>


	<table class="table table-bordered table-responsive">
		<tr>
		  <th>Serial Number</th>
		  <th>Period of Delay</th>
		  <th>Rate of Interest applicable</th>
		</tr>
		<tr>
			<td>(i)</td>
			<td>If paid within a period of 7 days from the due date</td>
			<td>A grace period of  up to 7 days is allowed without any interest</td>
		</tr>
		<tr>
			<td>(ii)</td>
			<td>If paid after 7 days but up to 30 days of due date</td>
			<td>15% on the amount of default for the period of default including the grace period;</td>
		</tr>
		<tr>
			<td>(iii)</td>
			<td>If paid after 30 days but within 60 days of the due date</td>
			<td>18% on the amount of default for the period of default including the grace period;</td>
		</tr>
		<tr>
			<td>(iv)</td>
			<td>Delay beyond 60 days of due date</td>
			<td>It would amount to a ‘breach’, invite action for termination of the contract and the entire outstanding amount would be recoverable along with interest calculated @ 21% for the entire period of default.
		</td>
		</tr>
    </table>
    <ol type="1">
		<li><b>Working of newly discovered minerals:</b><br/>If any minor mineral, not specified in the contract is discovered in the contracted area, the contractor shall report the discovery without delay to the competent authority and shall not win or dispose of such minor mineral without obtaining a separate mineral concession thereof. If he fails to apply for such a mineral concession within 6 months from the discovery of minor mineral, the competent authority, the competent authority may give the mineral concession in respect of such mineral to any other person:<br/>Provide that the grant of such permit may be refused for reasons to be recorded in writing.</li>
		<li><b>To commence mining operations within 180 days and carry them on properly:</b><br/>
		Unless the competent authority for sufficient cause allows otherwise, the contractor shall commence mining operations 180 days from the date of execution of the contract and shall thereafter conduct such operations in a proper, skilful and workman like manner</li>
		<p><b>Explanation:-</b>For the purpose of the clause, mining operations shall include the erection of machinery laying of a tramway or construction of a road in connection with the working of the mine.</p>
		<li><b>To erect and maintain boundary pillars:</b>
		<br/>The contractor shall at his own expenses, erect and at all times maintain and keep in good repairs boundary marks and pillars according to the plan annexed to the contract. Each of the pillars should be numbered and every pillar shall have GPS reading.</li>
		<li><b> Accounts:</b><br/>The contractor shall keep correct accounts showing the quantity and other particulars of all minerals obtained from the mines and the number of persons employed therein and a complete plan of the mine and shall allow any officer authorised by the Government or the Central Government or the competent authority in that behalf to examine at any time any accounts and records maintained by him, and shall furnish to the Government or the Central Government or the competent authority with such information and returns as it may require.</li>
		<li><b>To allow facilities to other lessees etc.:</b><br/>In addition to the concession holders under Rule-5 of the Assam minor mineral Concession Rules, 2012, the lessee shall allow existing and future contractor of any land which is comprised in or adjoins or is reached by the land, held by the lessee, reasonable facilities for access thereto.</li>
		<li><b>To allow entry to Officers:</b><br/>The Contractor shall allow any Officer authorised by the Government or the Central Government or the competent authority to enter upon any building,
		excavation or land comprised in the contract for the purpose of inspection of
		mines.</li>
		<li><b>Returns: - </b>The Contractor shall:-</li>
        <ol type="a">
		<li>Submit A return in Form ’MMPI’ by the 7th of every month by the competent authority and also to other officer (s) giving the total quantity of minor mineral(s) raised and dispatched from the contracted area in preceding calendar month and its value;</li>
		<li>Also furnish a statement giving information in a Form ‘MMP2’ by the 15th April every year to the competent authority and to the other Officer(s), regarding quantity and value of minor mineral obtained during last financial year, average number of regular laborers employed (men and women separately) number of accidents, compensation paid and number of days worked separately.</li>
        </ol>
   
		<li><b>To Strengthen and support the mines:</b><br/>The contractor shall strengthen and support to the satisfaction of Railway Administration or the State Government, as the case may be any part of the mine which in its opinion requires such, strengthening or support for the safety of any railway, bridge, national highway. Reservoirs, canal, road or any other public work or building.</li>
		<li><b>Notice for use of explosives.etc:</b><br/>The Contractor shall immediately give notice in writing in Form ‘MSE-1’ to the following:</li>
	
		<li>The Controller General, Indian Bureau of  Mines, Government of India, Nagpur;</li>
		<li>The Director General of Mines Safety, Govt of India, Dhanbad;</li>
		<li>The Director , Mines Safety, Govt of India, Guwahati;</li>
		<li>The Regional Controller of Mines , Indian Bureau of Mines, Kolkata;</li>
		<li>The Competent Authority;</li>
		<li>The District Magistrate of the District Concerned ;and</li>
		<li>The office-in-charge as soon as:</li>
		<ol type="a">
		<li>The working in the mines extend below superjacent ground; or</li>
		<li>The depth of any open cast excavation measured from its highest to the lowest point reaches six metres; or</li>
		<li>The number of persons employed on any day is more than 50 or</li>
		<li>Any explosives are used.</li>
		</ol>
	</ol>
    
    
    <ol type="1"> 
		<li><b>Maintenance of Sanitary Conditions:</b><br/>The Contractor shall maintain sanitary conditions in area held by him under the contract.</li>
		<li><b>To Pay compensation for Damage and indemnify the Government:</b><br/>The Contractor shall make and pay such reasonable satisfaction and compensation for all damage , injury or disturbance which may be done by him in exercise of the powers granted by the contract and shall indemnify the Government against all Claims which may be made by third parties in respect of such damage, injury or disturbance.</li>
		<li><b>Applications of all Acts, Rules and Regulations to this Contract:</b><br/>The Contractor shall abide by the provisions of Mines Act, 1952 and the rules and regulations framed there under and also the provisions of other labour laws both Central and State as are applicable to the workmen engaged in the mines and quarries relating to the provisions of drinking water, rest shelters, dwelling houses, latrines and first aid and medical facilities in particular and other safety and welfare provisions in general, to the satisfaction of the competent authorities under the aforesaid Acts, Rules and Regulations and also to the satisfaction of the District Magistrate Concerned. In case of non compliance of any of the provisions of the enactments as aforesaid, the competent authority may terminate the mining contract by giving one month’s notice with forfeiture of security deposited or :<br/>Provided that the contractor shall carry out mining operations in accordance with all other provisions as applicable for undertaking mining including the provisions of Forest (Conservation) act , 1980 and Environment (Protection) Act , 1986 and the rules made there under.</li>
		<li><b>To report accident</b><br/>The Contractor shall without delay report to the Deputy Commissioner of the district concerned as the competent authority or any other office authorised by him, any accident which may occur at or in the contract area.</li>
		<li><b>Delivery possession of land and mines on the surrender or sooner determination of the contract:</b><br/>At the end or sooner determination or surrender of the contract, the contractor shall deliver up the said lands and all mines (if any dug there) in a proper or workable State, save in respect of any working as to which the Government might have sanctioned abandonment.</li>
		<li><b> To provide electronic weighing machine:</b><br/>The Contractor shall provide and at all times keep at or near the pit-head at which the said mineral shall be brought to bank a properly constructed and efficient weighing machine and shall weigh or caused to be weighed thereon all the said minor minerals from time to time brought to bank, sold, exported and converted products, and shall at the close of each day cause the total weights, ascertained by such means of the said minor minerals , ores, products, raised, sold , exported and converted during the previous twenty four hours to be entered in the aforesaid books of accounts. The contractor shall permit the Government at all times during the said term to employ any persons to be present at the weighing of the said minor minerals, as aforesaid and to keep accounts thereof and to check the accounts kept by him. The contractor shall give 15 days’ notice in writing to Officer-in-charge________ of every such measuring or weighing in order that he or some officer on his behalf may be present thereat.</li>
		<li><b>To Secure Pit Shafts not fill them up:</b><br/>The Contractor shall well and properly secure pits and shafts and will not without permission in writing, will fully close, fill up or close any mine or shaft.</li>
		<li><b>Not to enter upon or to commence operations in the reserved or protected Forest:</b><br/>The contractor shall not enter upon or commence any mining operations in any forest land comprised in the contracted area except after previously obtaining permission in writing of the Forest Department, Assam.</li>
		<li><b> To respect water rights and not injure adjoining property:</b><br/>The contractor shall not injure or cause to deteriorate any source of water, power or water supply and shall not in any other way render any spring or stream or water unfit to be used or to do anything to injure adjoining land, villages or houses.</li>
		<li><b>Stocks lying at the end of the Contract:-</b></li>
		<ol type="a">
		 <li>The Contractor on expiry of the Contract period (Successful completion of the contract) shall remove already extracted all of the minerals from the premises of the quarry within a period of seven days. In case any quantity of the already extracted mineral, in the said land is left un-disposed off and is not removed within seven days from the date of expiry of the period of contract the same shall be deemed to be property of the Government and competent authority may dispose it off in any manner it may like without paying anything thereof to the contractor.</li>
		 <li>The Contractor on the termination or sooner determination of the contract shall not remove extracted mineral from the premises of the contracted areas. All extracted minerals in the said lands left over un-disposed after the termination or determination of Contract shall be deemed to be property of the Government and competent authority may dispose it off or in any manner it may like without paying anything thereof to the contractor.</li>
		</ol>
		<li><b>Payment of Taxes:</b><br/>The Contractor shall duly or regularly pay to the appropriate authority all taxes, Cesses and local dues in respect of the contracted area,said minor minerals or the working of the mines.</li>
		<li><b>Payment of additional amount for reclamation/restoration:</b><br/>The contractor shall also deposit/ pay additional amount equal to 10% of the amount of contract money by the 7th of every month, to ensure the compliance of the Reclamation and Restoration works. The additional amount shall be refunded after satisfactory Reclamation / Restoration of the area after mining in accordance with the Mine Closure Plan:<br/>Provided that in case the contractor fails to reclaim/ restore the area as per mining plan to the satisfactions of the Government, the amount deposited shall be forfeited and used for restoration of the area:<br/>Provided further that in case no rehabilitation position of the mine comes during the tenure of the mining contract, the amount so deposited shall be kept by the Government in the mining area development fund for future use as and when the mine reaches to a stage requiring restoration and rehabilitation.</li>
		<li><b>Assign sublet or transfers of the Contract:</b><br/>The Contractor shall not assign, sublet or transfer the contract to any person without obtaining prior permission in writing from the competent authority.</li>
		<li><b>Fencing of working place:</b><br/>If a working place is found to be unsafe all persons shall be withdrawn by the contractor immediately from the dangerous area and all access to such working place except for the purpose of removing the danger or saving life shall be prevented by securely fencing the full width of all entrances to the place, at his own cost.</li>
		<li><b>Fencing of Excavation after termination or sooner determination of the contract:</b><br/>The Contractor on termination or sooner determination of the contract shall at his own cost, suitable fence the excavations for safety as instructed by the competent authority</li>
		<li><b>Felling of trees:</b><br/>The Contractor shall not fell or cut any tree, standing on the land wherein the quarry is located without obtaining prior permission in writing from the forest department, Assam and paying its price as fixed.</li>
		<li><b>Security Deposit shall carry no interest:</b><br/>The security deposited by the contractor shall not carry any interest.</li>
		<li><b> Government not responsible for loss to Contractor:</b><br/>The Government shall not be responsible for any kind of loss to the contractor.</li>

	</ol>

	<h4 style="text-align:center">Part-IV<br/>Rights of the State Government</h4>
	<ol type="1">
		 <li><b>Suspension or termination of the Contract:</b><br/>The competent authority shall have the right to prematurely terminate the contract</li>
            <ol type="a">
             <li>If the contract money or surface rent or any other amount due to the Government are not paid;</li>
             <li>If any of the terms and conditions of the contract agreement or conditions of grant or permission to undertake mining by any other statutory authority/Competent authority is violated;</li>
             <li>If any of the provisions of these rules and other laws both Central and State are as applicable to mines and minerals, are not complied with:<br/>Provided that no orders of suspension/termination of the contract shall be passed by the competent authority without giving reasonable opportunity to show cause and following the procedure prescribed in the Rules:<br/>Provided that in case of default in payment of Government due such as contract money / surface rent or any other dues payable under these presents, the contract may be terminated by the competent authority without affording hearing to the contractor after serving upon a notice to make good the payment within thirty days:<br/>Provided further that the competent authority may also at any time after issuance of the notice
            For default on account of nonpayment of dues, enter upon the said premises and detain all or any of the mineral or movable property therein and may carry away, detain or order the sale of the property so detained, or so much of it as will suffice for the satisfaction of the contract money or rent or royalty or both dues and all costs and expenses occasioned by the non-payment thereof.</li>
            </ol> 
            <li><b> Determination of Contract in public interest:</b><br/>The Government may be giving six months prior notice in writing determine the contract if the Government consider that the minor mineral under the contract is required for establishing an Industry beneficial to the public:<br/>
            Provided that in the State of National Emergency or War, the contract may be determined without giving such notice.</li>
            <li><b>Right of Pre-emption:</b><br/>The Government shall from time to time and at all times during the terms of contract have the right (to be exercised by notice in writing to the contractor) of pre-emption of the said mineral(s) and all products thereof lying in or upon the said lands hereby demised or elsewhere under the control of the contractor and the contractor shall deliver all minerals or products thereof to the Government at the current market rates in such quantities and in the manner at the place specified in the notice exercising the said right.</li>
            <li><b> Penalty for not allowing entry to officers:</b><br/>If the contractor or his transferee or assignee does not allow any entry or inspection under clause 11 of part – III, the competent authority may cancel the contract and forfeit in whole or in part the security deposit paid by the Contractor</li>
            <li><b>Compensation and acquisition of Land of third parties thereof:</b><br/>In case the Occupier(s) or Owner(s) of the said land refuses his / their consent to the exercise of the rights and powers reserved to the Government and demised to the contractor under these presents, the contractor shall report the matter to the competent authority who shall request the Collector of the district concerned to direct the Occupier(s) or Owner(s) to allow the contractor to enter the said lands and to carry out such operations as may be necessary for working the mine, on payment in advance of such compensation to the occupier or owner by the contractor, as may be fixed by the Collector under the rules.</li>
            <li><b>Suspension of mining operations:</b><br/>The Director may order to suspend the mining operations after serving a notice to the contractor, in case, the following violations are noticed:-</li>
            <ol type="a">
            <li>Unsafe and unscientific mining;</li>
            <li>Non operations of weigh bridge</li>
            <li>Non providing of safety appliances to the workers</li>
            <li>Nonpayment of compensation to the surface Owners</li>
            <li>Non submissions of monthly returns;</li>
            </ol>
		</ol>
		<p>
		In case of violations of the aforesaid conditions and also any other terms and conditions of the agreement deed and the provisions of the rules, the competent authority may give a notice to the contractor to remedy the violations within a period of 15days from the date of issue of the notice. In case, the violations pointed out through notice, are not remedied within the stipulated period of 15days the competent authority may after affording an opportunity of being heard to the contractor, order the suspension of the mining operations till such time, the defaults/defects are removed by the lessee within the time frame granted by competent authority. During the period of suspension of mining operations, the contractor, the contractor will be allowed only to undertake rectification work for removal of the defects and shall not dispose off the mineral. During the suspension period, the contractor shall be under the obligation to deposit the amount of the contract money etc on the due dates.</p>
		<p>On satisfactory removal of the defects, the competent authority may revoke the suspension orders with or without any modification. Non removal of the defects/defaults during the suspension period and within the time allowed by the competent authority, shall lead to premature termination of contract.</p>
	<h4 style="text-align:center">Part-V</h4>
	<ol type="1">
		 <li><b>Cancellation:</b><br/>The Contract shall be liable to be cancelled by the competent authority if the contractor cease to work the mine for a continued period of 180days without obtaining written sanction.</li>
		 <li><b>Notices:</b><br/>Every notice by this presents required to be given to the contractor shall be given in writing to such person resident on the said lands as the contractor may appoint for the purpose of receiving such notices and if there shall have been no such appointment then every such notice shall be sent to the contractor by registered post addressed to the Contractor at the address recorded in this contract or at such other address in India as the Contractor may from time to time in writing to the competent authority designate for the receipt of notices and every such services shall be deemed to be proper and valid service upon the Contractor and shall not be questioned or challenged by him.</li>
		 <li><b>Recovery of Government dues as arrears of land revenue:</b><br/>Without prejudice to any other mode of recovery authorised by any provision of this contract or by any law, all amounts, falling due hereunder against the contractor may be recovered as arrears of land revenue under the law in force for such recovery.</li>
		 <li><b>Forfeiture of property left more than three months after expiry or determination of contract:</b><br/>The Contractor should remove his property lying on the said lands within three months after the expiry or sooner determination of the contract or after the date from which any surrender by the contractor of the said lands becomes effective, as the case may be, the property left after the aforesaid period shall become the property of the Government and may be sold or disposed off in such a manner as the competent authority shall deem fit without liability to pay any compensation therefore , to the contractor.</li>
		 <li><b>Security and forfeiture thereof:</b></li>
		 <ol type="a">
		 <li>The competent authority may forfeit the whole or any part of the amount deposited as security under this contract, in case the contractor commits a breach of any covenants to be performed by the Contractor under the contract</li>
		 <li>Whenever the said security deposits or any part thereof or any further sum hereafter deposited with the Government in replenishment thereof is forfeited under sub clause (a) or applied by the competent authority under the contract (which the competent authority is hereby authorised to do ) The contractor shall immediately deposit the deficient amount thereof to bring the amount in deposit with the Government up to the requisite amount of security at that point of time of contract.</li>
		 <li>The rights conferred to the  Director by clause (a) shall be without prejudice to the rights conferred on the Government by any other provision of this contract or by any law</li>
		 <li>On such date as the competent authority may decide within twelve calendar months after the determination of the contract or refusal of any renewal thereof, the amount of security deposit paid in respect of this contract in case is the same is otherwise not forfeited or is not required to be detained for any purposes mentioned in this contract shall be refunded to the contractor. no interest shall run on the security deposit</li>
		</ol>
		<li><b>Survey and demarcation of the area:</b><br/>When a mining contract is granted, arrangement shall be made, if necessary, at the expense of the contractor, for the survey and demarcation of the area granted under the contract. The Contractor shall have to bear actual expenses of the staff deputed for the work. Actual expenses will include travelling allowances, daily allowances and salary of staff plus 10 percent as instrument charges.</li>
		<li><b>Surrender of a mining contract by the Contractor:</b><br/>The Government may accept the request of the Contractor for surrender of a contract or part thereof in cases where it is established that it has not been found feasible to operate the contract grant for whatsoever reasons subject to the condition that the contractor</li>
		<ol type="a"> 
		<li>has been regular in furnishing the production returns as required in terms of the contract agreement;</li>
		<li>has been taking the requisite steps for the progressive mine closure plan as per the conditions of the contract grant;</li>
		<li>Is not in default of payment of any dues  of the Government as on the date of making such application and undertakes to pay all such dues till the date of expiry of the notice period either in cash in advance or by way of adjustment of the security or both :</li>
		<p>Provided that in case the contractor makes an application for surrender of part area of the contract, it shall not result in any prorated reduction of the contract money and the rate of contract money payable and applicable for the entire area at the time of such application shall remain intact.</p>

		</ol>
		<li><b>Penalty for repeated breaches:</b><br/>In case of repeated breaches of covenants and agreements by the contractor for which notice has been given by the competent authority in accordance with sub-rule (1) of rule 55 and /or sub rule(1) of rule 56 on earlier occasions , the competent authority without giving any further notice , may impose such penalty not exceeding twice the amount of security deposited.</li>
		<li><b>Obtaining Sale tax number:</b><br/>The contractor shall get himself registered with the Taxation department of Assam and shall obtain the Sales Tax number. </li>
		<li><b>Overriding effect:</b><br/>Unless otherwise specifically provided, it is agreed this deed shall be governed by the provisions of the Mines and Minerals (Development and Regulation) Act, 1957 (67 of 1957) and the rules made there under.  The Provisions of the Act and the rules shall prevail over the terms and conditions of the agreement.</li>
	</ol>
	';	
			
	$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
	$printContents=$printContents.'
			


	<tr>
		<td>Date : <strong> '.date('d-m-Y',strtotime($results["sub_date"])).'</strong></td>						
		<td align="right">Signature of the Contractor:<strong> '.strtoupper($contra_sig).'</strong></td>				
	</tr>	
	<tr>
		<td>For and on behalf of the Governor of Assam : <strong> '.strtoupper($governor_assm).'</strong></td>						
		<td align="right">Signature of Surety :<strong> '.strtoupper($surety_sig).'</strong></td>				
	</tr>
</table>
';
?>

