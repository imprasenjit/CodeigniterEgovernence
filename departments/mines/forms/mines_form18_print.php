<?php
$dept="mines";
$form="18";
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
			$indenture_dt=$results["indenture_dt"];$acting_through=$results["acting_through"];$bid_rs=$results["bid_rs"];$words_rupees=$results["words_rupees"];$auction_dt=$results["auction_dt"];$mining_contract=$results["mining_contract"];
			$officer_rs=$results["officer_rs"];$officer_rupees=$results["officer_rupees"];$security_name=$results["security_name"];$shri=$results["shri"];
			$resident=$results["resident"];$re_district=$results["re_district"];$veins_seam=$results["veins_seam"];
			$village_situated=$results["village_situated"];$sub_division=$results["sub_division"];$land_district=$results["land_district"];$dag_no=$results["dag_no"];$patta_no=$results["patta_no"];$north=$results["north"];$south=$results["south"];$east=$results["east"];$west=$results["west"];$premises_dt=$results["premises_dt"];$for_term=$results["for_term"];
			
			$contra_sig=$results["contra_sig"];$an_area=$results["an_area"];
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
		<tbody>			
    	
	
		<tr>  				
			<td colspan="2">This indenture made on this day '.strtoupper($indenture_dt).' between the Governor of Assam acting through '.strtoupper($acting_through).' (hereinafter referred to as the State Government which expression shall where the context so admits, include the successors and assigns) of the one part and.
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
					$results1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_members where form_id='$form_id'") or die("Error : ".$mines->error);
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
			<td colspan="2">Whereas the lessee has offered the highest bid of Rs. '.strtoupper($bid_rs).' (in words Rupees '.strtoupper($words_rupees).' )in the bid/auction held on  '.strtoupper($auction_dt).' for obtaining a mining lease for '.strtoupper($mining_contract).' name of minor minerals) in respect of the lands hereafter described in clause 2 and such bid had been accepted by the officer authorized in this behalf and the lessee has deposited with the Government, as sum of Rs. '.strtoupper($officer_rs).' (Rupees '.strtoupper($officer_rupees).')as initial bid security (10% of the annual bid amount) and Shri '.strtoupper($security_name).' S/o Shri '.strtoupper($shri).' resident of '.strtoupper($resident).' District '.strtoupper($re_district).' (referred to as the surety which expression shall where the context so admits, include his heirs, executors, administrators, representatives) has been offered a solvent surety for the aforesaid amount, and whereas the lessee is in possession of a Income Tax Clearance Certificate. 			
			</td>
		</tr>
		
			<tr>  				
				<td colspan="2">Now, therefore, this deed witness and the parties hereby agree as follows :-</td>
			</tr>
			<tr>  				
				<td colspan="2"><b>Liberties and privileges to be exercised and enjoyed by the Lessee(s):-</b></td>
			</tr>
			<tr>  				
				<td colspan="2">The following liberties, powers and privileges may be exercised and enjoyed by the lessee subject to the other provisions.:-</td>
			</tr>
		    <tr>  				
				<td colspan="2">(1) In consideration of the contract money,covenants and agreements hereinafter contained and on the part of Contractor to be paid, observed and performed the Government hereby grants and demises in to contractor all those mines/beds/veins/seams of '.strtoupper($veins_seam).' (hereinafter referred to as the said minor minerals), situated , lying and being in or under the lands which are referred to in clause (b) together with the liberties , powers and privileges to be executed or enjoyed in connection herewith which are hereinafter mentioned in Part-I subject to the restrictions and conditions as to exercise and enjoyment of such liberties, and privileges which are hereinafter mentioned in Part II and subject to other provisions of this contract.</td>
			</tr>
		<tr>
			<td>2. The area of the said lands is as follows:</td>
		</tr>
		<tr>  				
			<td colspan="2">All the tract of land situated at village&nbsp;&nbsp;'.strtoupper($village_situated).'&nbsp;&nbsp; in Sub-Division '.strtoupper($sub_division).' District '.strtoupper($land_district).' bearing Dag and Patta Nos.&nbsp;&nbsp;'.strtoupper($dag_no).'&nbsp;and&nbsp;'.strtoupper($patta_no).' Containing an area of&nbsp;&nbsp;'.strtoupper($an_area).'&nbsp;&nbsp;or thereabouts delineated on the plan hereto annexed and bounded as follows:		
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
		
	
		
		<h4 style="text-align:center"><b>Part-I</b><br/><b>Liberties and privileges to be exercised and enjoyed by the Lessee(s)</b></h4>
		<p>The following liberties and privileges may be exercised and enjoyed by the lessee subject to the other provisions :</p>
			
		<ol type="N">
			<li><b>To enter upon land and search for win, work, etc. :</b>Liberty at all times during the term hereby demised to enter upon the said lands and to search for mineral, bore, dig, drill for win, work, dress, process, convert, carry away and dispose of the said minor mineral(s).</li>
			<li><b>To sink, drive and make pit, shafts and inclines, etc : </b><br/>Liberty for or in connection with any of the purposes mentioned in this clause to sink, drive, make, maintain and use in the said land and pits, shafts, inclines, drifts, levels, waterways and other works and to use, maintain, deepen or extend any existing works of the like nature in the said lands.</li>
			<li><b>To bring and use machinery, equipment :</b><br/>Liberty for or in connection with any of the purposes mentioned in this clause to erect,construct, maintain and use on or under the said lands any engine,machinery, plan,dressing floors,furnaces,coke, ovens,brick kilns,workshop, store houses, bunglows,godowns, shed and other buildings and other works and convenience of the like nature on or under the said lands.</li>
			<li><b>To use water from streams, etc.: </b><br/>Liberty for or in connection with any of the purposes mentioned in this clause but subject to the rights of any existing or future lessees and with the permission of the Collector concerned to appropriate and use water from any streams,water course, springs, or other source in or upon the said lands and to divert, step up or any such stream or water course, cultivated land, village buildings or watering places for livestock of a reasonable supply of water as before accustomed nor in any way to foul pollute any streams or springs :,<br/>&nbsp;&nbsp;&nbsp;Provided that the lessee shall not interfere with navigation in any navigable stream nor shall divert such stream without the the previous written permission of the Government.</li>
			<li><b>To fell undergrowth and utilize timber and trees, etc:</b><br/>Liberty for or in connection with any of the purposes mentioned in this lease deed, to clear undergrowth and brush wood. Lessee shall not fell any trees or timber standing or found on the said lands without obtaining prior permission in writing from the Forest Department. In case such permission is granted, he shall pay in advance, the price of the trees?timber to be felled to the said officer at the rates, fixed by him.</li>
			<li><b>To get building and roads material, etc. :</b><br/>Liberty for or in connection with any of the purposes, mentioned in this lease deed, to uarry and get stones, gravel and other building and road materials and ordinary clay and to use and employ the same and to manufacture such clay into bricks or tiles and to use such bricks, tiles but not to sell any such materials, bricks, tiles.</li>
			<li><b>To use land for stacking purpose :</b><br/>Liberty to enter upon and use a sufficient part of the surface of the said lands for the purpose of stocking, storing or depositing therein any produce of the mines including overburden or waste material and works carried on ad tools, equipment and other materials needed for mining operations.</li>
			<li><b>To install fuel pumps or stations for diesel or petrol for self use :</b><br/>Liberty to use a sufficient part of the land for installing fuel pumps or stations for diesel or petrol for self use or consumption required for mining operations in the lease area, subject to permission of the authority.</li>
			<li><b>To construct magazine for explosive and storage sheds :</b><br/>Liberty to construct magazine for storage of explosive and storage sheds for explosive related substances with permission from licensing authority.</li>
			<li><b>Liberty to,seek permission for diversion of public roads, overhead electric lines :</b><br/>Liberty and power to request to the competent authority for diversion of public road, overhead electric lines passing through the concession area at the expenses of the lessee to ensure scientific and systematic mining.</li>
		</ol>
        
	<h4 style="text-align:center"><b>Part-II</b><br/><b>Restrictions as to the exercise of the liberties by the lessee</b></h4>
		<p>The liberties and privileges granted under Part - 1 are subjected to the following restrictions and subject to other provisions of this lease :</p>
		<ol type="N">
		  <li><b>No mining operations within the limit of public works, etc. :</b><br/>The lessee shall not carry on, or allow to be carried on any mining operations:-</li>
		  <ol type="I">
			<li>within a distance of 50 meters from the outer periphery o defined limits of any village, habitation, National Highway, S Highway and other roads, where such excavation does not mg use of explosives, unless specifically relaxed and permitted by competent authority; or</li>
			<li>within a distance of 250 meters from the outer periphery of defined limits of any village, habitation, National- Highway, Highway and other roads, where use of explosives is required, specifically relaxed and permitted by the competent authority o specific dispensation is obtained from the Director, Mines Safety; or</li>
			<li>within a distance of 500 metres from major structures like R Bridges, Guide bund etc.; or</li>
			<li>within a distance of 75 meters from any railway line or bridge ex under and in accordance with the written permission of the rail administration concerned. The Railway Administration or Government may in granting such permission, impose conditions as it may deem fit.</li>
		  </ol>
		 <p><b>Explanation:-</b>For the purpose of this clause the expressi Railway Administration shall have the same meaning as it is defined by sub-section (4) of sect&#39;3 of the Indian Railway Act, 1890.<br/>Provided that where the continuance of any mining operations in any area, in opinion of the Government is likely to endanger the safety of any National or State Highway, road, bridge, drainage, reservoir, tank, canal or other public works, or public private buildings of in the public interest or in the interest of environment/ecology of area, the Government may determine the lease after giving 60 days notice to the lease in this behalf and the lease shall stand terminated on the date mentioned in this notice.</p>
		<li><b>Working in sand Zones :</b><br/>That the lessee in respect of sand zones,shall restrict the quarrying operations to maximum four villages of the zone at any point of time during the subsistence of the lease.The lessee shall have a right to change the site any time during the subsistence of the lease on settlement of compensation with the landowners of new site of the zone from where he intends to extract sand but ceiling of maximum four villages shall be adhered to strictly and such change of site shall be intimated to the competent authority.</li>
		<li><b>Special conditions for river bed mining :</b><br/>In case of river bed mining/excavation of minor mineral(s), in order to ensure safety of river-beds,structures and the adjoining areas, the following special conditions shall be abide by the lessee :</li>
		<ol type="a">
		  <li>No mining would be permissible in a river-bed up to a distance of five times of the span of a bridge on upstream side and ten times the span of such bridge on downstream side, subject to a minimum of 250 metres on the upstream side and 500 metres on the downstream side;</li>
		  <li>There shall be maintain an un-mined block of 50 metres width after every block of 1,000 metres over which mining is undertaken or at such distance as may be directed by the competent authority;</li>
		  <li>The maximum depth of mining in the river bed shall not exceed three metres measured from the un-mined bed level at any point of time with proper bench formation.</li>
		  <li>Mining shall be restricted within the central 314th width of the river/rivulet;</li>
		  <li>Mining shall be restricted within the central 314th width of the river/rivulet;</li>
		  <li>Any other condition(s) as may be required by the competent authority in public interest.</li>
		</ol>
		<li><b>Notice for surface operation in land not already in use :</b><br/>Before using for surface operations any land which has not already been used for such operation, the lessee shall give notice in advance to the Collector of the District, the competent authority and the officer-in- Charge____. in writing along with copy of permission to undertake mining specifying the situation and the extend land proposed to be so used and the purpose for which the same is required and tlb land shall not be so used, if objection is issued by the Collector.</li>
		<li><b>Not to use the land for other purposes :</b>The lessee shall not cultivate or use the land for any other purpose than those specified in the lease deed.</li>
		<li><b>Disposal of mineral(s) only on issuance of Mineral Transit Pass:</b><br/>The holder of mining lease shall not sell/dispose off any mineral or products from the concession area without a Mineral Transit Pass.</li>
		<li><b>Stacking of mineral(s) inside leasehold area :</b>The lessee shall not stock the mineral(s) excavated inside the lease hol at the designated site more than twice the quantity of the average monthly production approved mining plan/scheme.</li>
		<li><b>Stacking of mineral(s) outside leasehold area :</b><br/>The lessee shall not stock any minor mineral(s) granted under the outside the leasehold area.</li>
		<li><b>Stacking and storage of incidentally extracted major minerals :</b><br/>In case lessee, while extracting minor mineral(s) given on lease, incid extracts any major mineral not given on lease, the same shall be the property o Government and lessee shall be under an obligation to stack and store it and maintain proper record in accordance with the direction of the competent authority,who shall a competent to prescribe the procedure for its disposal.</li>
		<li><b>Penalties in case of non-compliance of clause (9) :</b><br/>In case it is detected that lessee has disposed off incidentally extracted mineral referred to in sub-rule (18) of rule 38 in whole or part thereof or failed to m the record of stored mineral, he shall be liable to penalties as specified in sub-section (4) and (5) of section 21 of the Mines and Minerals (Development and Regulation) 1957 and also premature determination of mining lease in terms of sub-rule (19) of rule 39 of the said rules.</li>
		<li><b>Restrictions of mining operations above Ground Water Table :</b><br/>A safety margin of two metres shall be maintained above the ground water table while undertaking mining and no mining operations shall be permissible below this level unless a specific permission is obtained from the competent authority in this behalf.</li>
		<li><b>Restrictions of surface operations :</b><br/>No mining operations shall be undertaken in any area prohibited by any authority or by the orders of any Court.</li>
		<li><b>No mining operations without requisite clearance :</b><br/>The lessee shall not undertake any mining operations in the area granted on mining lease without obtaining requisite clearance from the competent authority as required for undertaking mining operations.</li>
		
		</ol>

		<h4 style="text-align:center"><b>Part-III</b><br/><b>Covenants of the Lessee</b><br/>The lessee/ lessees hereby covenant(s) with the Government as follows:-</h4>
		<ol type="1">
		<li><b>Rate of Royalty :</b><br/>The lessee shall pay royalty on the quantity of the said minor mineral dispatched from the leased area at the rates as per First Schedule of the Assam Minor Mineral Concession Rules, 2012 and as may be revised by the State Government from time to time.</li>
		<li><b>Surface rent:</b><br/>The lessee shall pay Surface rent for the surface area occupied by him as per rule 44.</li>
		<li><b>Dead rent:</b><br/>The lessee shall pay for every year dead rent at the rate as fixed by the Government from time to time.<br/><b>Where the mining lease is granted by competitive bid/auction under rule 8:-</b><br/>&nbsp;&nbsp;&nbsp;The highest bid received in the open bid/auction at the rate of per annum shall become the &#39;annual dead rent&#39; amount payable by the lessee. The rate of annual dead rent initially determined on the basis of competitive bids/ auctions shall be increased @ 25% Qn completion of each block of three years.<br/>Explanation: If the initially determined amount of annual dead rent is Rs.100/, it shall be increased to Rs.125/- with the commencement of the fourth year and to Rs.156.25 with the commencement of the 7th year and so on and so forth for the next each block of three years :</li>
		<p><b>Explanation:</b> If the initially determined amount of annual dead rent is Rs.100/-, it shall be increased to Rs.125/- with the commencement of the fourth year and to Rs.156.25 with the commencement of the 7 th year and so on and so forth for the next each block of three years :<br/>Provided further that if the lease permits the working of more than one minor mineral in the same area, the Government may charge separate dead rent in respect of each minor mineral :<br/>Provided that the mining of one minor mineral does not involve the world] another minor mineral : Provided further that the lessee/lessees shall be liable to pay the dead re royalty in respect of each mineral, whichever be higher but not both:<br/>Provided further that lessee/ lessees shall deposit the dead rent at the rat revised and notified from time to time by the State Government.</p> 
		<li><b>Security deposit :</b><br/>25% of the annual bid amount/ rate, of dead rent The security amount to be deposit per following :-<br/>(i) 10% as initial bid security at the time of auction (ii) 15% of the annual bid amount before commencement of mining operatic)] before the expiry of period allowed, which shall not be more than 12 months, whichever is earlier :<br/>Provided on enhancement of the dead rent after expiry of every three year peril lease the lessee shall deposit the balance amount of security so as to upscale security amount equal to 25% of the revised annual dead rent as applicable for one with respect to next block of three years.</li>  
		<li><b>Mode of payment of dead rent/ royalty and surface rent :</b></li>
		<ol type="a">
		  <li>In case of mining lease granted under rule 8, the lessee shall deposit one adN instalment of dead rent before commencement of mining operations or before expiry of period allowed, which shall not be more than 12 months, whichever is earlier, along with 15% of the balance security amount as per clause 4(a) above.</li>
		  <li>The lessee during the subsistence of the lease, pay in advance to the Govern the instalments of the dead rent in respect of the said land given to him/ them mining lease in four quarterly instalments on the 1st of April, 1st of. June, : September and 1st of December of the year.<br/><b>Note:</b>he amount of one advance instalment deposited at the time of commence of the mining operations or within time allowed for the same shall be adji in a manner that the subsequent instalments are payable for a full scale month/quarter/year, as the case may be.</li>
		  <li>The lessee shall be liable to pay the amount of royalty on the mineral excavates dispatched at
          the rate specified in the first schedule or dead rent, whichever is more and not both.</li>
		  <li>Where the amount of royalty payable in respect of a month exceeds the amount of dead rent deposited in advance, the lessee shall deposit such amount of royalty on the mineral extracted and dispatched or consumed by The 7th day of the following month after adjusting the amount of advance dead rent already deposited.</li>
		  <li>In cases where the lessee has paid the amount of royalty or dead rent during a part of the year, which is equal to or more than the annual dead rent payable for the year, he shall not be required to deposit the advance dead rent for the remaining period of the said year and the royalty for the balance part of the year shall be deposited by the 7th day of the following month.</li>
		</ol>
		<li><b>Amount to be deposited on account of Mines and Minerals Development Restoration and Rehabilitation Fund :</b><br/>Where the lessee is operating the area, he shall also deposit/ pay an additional amount, equal to 10% of the due dead rent or royalty, whichever is more along with amount of instalments on account of dead rent or royalty, towards the Mines and Minerals Development Restoration and Rehabilitation Fund separately established under these rules.</li>
		<li><b>Interest on delayed payments :</b><br/>In case of any default in payment of the instalments of dead rent/contract money/ contribution to the Mines and Minerals Development (Restoration and Rehabilitation) Fund on the due date(s), the amount would be payable along with interest at the following rates :</li>
	     <table class="table table-bordered table-responsive">
		<tr>
		  <th>Serial Number</th>
		  <th>Period of delay</th>
		  <th>Rate of Interest applicable</th>
		</tr>
		<tr>
			<td>(i)</td>
			<td>If paid within a period of 7 days from the due date</td>
			<td>A grace period of up to 7 days is allowed without any interest;</td>
		</tr>
		<tr>
			<td>(ii)</td>
			<td>If paid after 7 days but up to 30 days of the due date</td>
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
			<td>It would amount to a breach&#39;s invite action for termination of the lease/ contract and the entire outstanding amount would be recoverable along with interest calculated @ 21% for the entire period of default.
		    </td>
		</tr>
	</table> 
		<li><b>Working of newly discovered minerals :</b><br/>If any minor mineral, not specified in the lease, is discovered in the leased area, the lessee shall report the discovery without delay to the competent authority and shall not win or dispose of such minor mineral without obtaining a lease therefor. If he fails to apply for such a lease within six months from the discovery of the minor mineral, the competent authority may give the lease in respect of such mineral, to any other person :<br/>Provided that the grant of such permit may be refused for reasons to be recorded in writing:</li>  
		<li><b>To commence mining operations within 180 days and carry them on properly:</b><br/>Unless the competent authority for sufficient cause allows otherwise, the lessee shall commence mining operations 180 days from the date of execution of the lease and shall thereafter conduct such operations in a proper, skilful and workman like manner.<br/><b>Explanation : </b>For the purpose of this clause, mining operations shall include the erection of machinery laying of a tramway or construction of a road in connection with the working of the mine.</li> 
		<li><b>To erect and maintain boundary pillars etc. :</b><br/>The lessee shall at his own expenses, erect and at all times maintain and good repairs boundary marks and pillars according to the plan annexed to the lease. Each of the pillars should be numbered and every pillar shall have GPS reading.</li> 
		<li><b>Accounts :</b><br/>The lessee shall keep correct accounts showing the quantity and other particulars minerals obtained from the mines and the number of persons employed therein complete plan of the mine and shall allow any officer authorised by the Government or the Central Government in that behalf to examine at any time accounts and records maintained by him, and shall furnish to the Assam Government or competent authority or the Central Government or the competent authority with such information and returns as it may require.</li>
		<li><b>To allow facilities to other lessees etc. :</b><br/>In addition to the concession holders under Rule -- 5 of the Assam Minor Concession Rules, 2012, the lessee shall allow existing and future licensees or holders/contractors of any land which is comprised in or adjoins or is reached land, held by the lessee, reasonable facilities for access thereto.</li>
		<li><b>To allow entry to officers :</b><br/>The lessee shall allow any officer authorised by the Assam Government and the Central Government or competent authority to enter upon any building, excavation or land comprised in the lease for the purpose of inspecting the mines.</li>
		<li><b>Returns :</b><br/>The lessee shall :-</li> 
		<ol type="a">
		  <li>submit a return in form &#39;WIMP1&#39; by the 7th of every month to the competent authority and also to other officer(s) specified giving the total quantity of minor minerals(s) raised and dispatched from the leased area in the preceding calendar month and its value ;</li>
		  <li>also furnish a statement giving information in Form &#39;MMP2&#39; by the 15th April every year to the competent authority and to other Officer(s), specified regarding quantity and value of minorineral(s) obtained during last financial year, average number of regular labourers employed (men and women separately) number of accidents, compensation paid and number of days worked separately.</li>
		</ol>
		<li><b>To strengthen and support the mines :</b><br/>The lessee shall strengthen and support to the satisfaction of the Railway Administration or the State Government, as the case may be any part of the mine which in its opinion requires such, strengthening or support for the safety of any railway, bridge, national highway, reservoirs, canal, road or any other public work or building.</li>
		<li><b>Notice for use of explosives.etc:</b><br/>The lessee shall immediately give notice in writing in Form &#39;IMSE1&#39; to the following:</li>
		<ol type="1">
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
		<li>The number of persons employed on any day is more than 50 <br/> or</li>
		<li>Any explosives are used.</li>
		</ol>
		</ol>
		<li><b>Maintenance of Sanitary Conditions:</b><br/>The Lessee shall maintain sanitary conditions in the area held by him under the lease.</li>
		<li><b>To Pay compensation for Damage and indemnify the Government:</b><br/>The lessee shall make and pay such reasonable satisfaction and compensation for all damage, injury
		or disturbance which may be done by him in exercise of the powers granted by the lease and shall
		indemnify the Government against all claims which may be made by third parties in respect of such
		damage, injury or disturbance.</li>
		<li><b>Application of all Acts, Rules and Regulations to this lease :</b><br/>The lessee shall abide by the provisions of Mines Act, 1952, and the rules there under and also the
		provisions of other labour laws both Central and State applicable to the workmen engaged in the mines
		and quarries relating to the pro of drinking water, rest shelters, dwelling houses, latrines and first-aid and
		m facilities in particular and other safety and welfare provisions in general, is satisfaction of the
		competent authorities under the aforesaid Acts, Rule Regulations and also to the satisfaction of the
		District Magistrate concerned. In non compliance of any of the provisions of the enactments as
		aforesaid, coma authority may terminate the mining lease by giving one month&#39;s notice with fo of
		security deposited : Provided that the lessee shall carry out mining operations in accordance other
		provisions as applicable for undertaking mining including the provisions of (Conservation) Act, 1980 and
		Environment (Protection) Act, 1986 and the rules thereunder.</li>
		<li><b>To report accident :</b><br/>The lessee shall without delay report to the Deputy Commissioner of the concerned and the competent authority or any other officer authorised by him accident which may occur at or in the leased area.</li>
		<li><b>Delivery of possession of land and mines on the surrender or sooner determin of the lease :</b><br/>At the end or sooner determination or surrender of the lease the Lessee shall up the said lands and all mines (if any dug there) in a proper and workable state, s respect of any working as to which the Government might have son abandonment.</li>
		<li><b> To provide electronic weighing machine :</b><br/>The lessee shall provide and at all times keep at or near the pit-head at which the mineral shall be brought to bank a properly constructed and efficient elec weighing machine and shall weigh or caused to be weighed thereon all the said minerals from time to time brought to bank, sold, exported and converted products shall at the close of each day cause the total weights, ascertained by such means said minor minerals, ores, products, raised, sold, exported and converted during, previous twenty four hours to be entered in the aforesaid books of accounts. The 1 shall permit the Government at all times during the said term to employ any person be present at the weighing of the said minor minerals, as aforesaid and to keep ac thereof and to check the accounts kept by the lessee. The lessee shall give 15 previous notice in writing to the Officer-in-Charge__________of every such mea or weighing in order that he or some officer on his behalf may be present thereat.</li>
		<li><b>To secure pits shafts not fill them up :</b><br/>The lessee shall well and properly secure pits and shafts and will not wi permission in writing, wilfully close, fill up or close any mine or shaft.</li>
		<li><b>Not to enter upon or to commence operations in the Forest land :</b><br/>The lessee shall not enter upon or commence any mining operations in any forest land comprised in the leased area except after obtaining permission in writing of the Forest Department, Assam.</li>
		<li><b> To respect water rights and not injure adjoining property :</b><br/>The lessee shall not injure or cause to deteriorate any source of water, power or water-supply and shall not in any other way render any spring or stream or water unfit to be used or to do anything to injure adjoining land, villages or houses.</li>
		<li><b>Stocks lying at the end of the lease :</b></li>
		<ol type="a">
		 <li>The lessee on expiry of the lease period (successful completion of the lease) shall remove already
			extracted all of the mineral from the premises of the quarry within a period of seven days. In case any
			quantity of the already extracted mineral, in the said land is left undisposed off and is not removed
			within seven days from the date of expiry of the period of lease the same shall be deemed to be the
			property of the Government who may dispose it off in any manner it may like without paying
			anything thereof to the lessee.</li>
		 <li>The lessee on the termination or sooner determination of the lease shall not remove extracted
			mineral from the premises of the leased areas. All extracted minerals in the said lands leftover un-
			disposed after the termination or determination of lease shall be deemed to be property of the
			Government and competent authority, may dispose it off in any manner it may like without paying
			anything thereof to the Lessee.</li>
		</ol>
		<li><b>Payment of Taxes:</b><br/>The lessee shall duly and regularly pay to the appropriate authority all taxes, cesses and local dues in respect of the leased area, said minor minerals or the working of the mines.</li>
		<li><b>Payment of additional amount for reclamation/ restoration :</b><br/>The lessee shall also deposit/pay additional amount equal to 10% of the amount of royalty/dead rent
		along with the payment of royalty or dead rent, whichever is more, by the 7 th of every month, to ensure
		the compliance of the Reclamation and Restoration works. This additional amount shall be refunded
		after satisfactory Reclamation/ Restoration of the area after mining in accordance with the Mine
		Closure Plan :<br/>Provided that in case the lessee fails to reclaim/ restore the area as per mining plan to the
        satisfactions of the State Government, the amount deposited shall be forfeited and used for the
        restoration of the area :<br/>Provided further that in case no rehabilitation position of the mine comes d tenure of the mining lease, the amount so deposited shall be kept by Government in the mining area development fund for future use as and when reaches to a stage requiring restoration and rehabilitation.</li>
		<li><b>Assign sublet or transfer of the lease:</b><br/>The lessee shall not assign, sublet or transfer the lease to any person obtaining prior permission in writing from the competent authority.</li>
		<li><b>Fencing of working place:</b><br/>If a working place is found to be unsafe all persons shall be withdrawn by immediately from the dangerous area and all access to such working place e the purpose of removing the danger or saving life shall be prevented by fencing the full width of all entrances to the place, at his own cost.</li>
		<li><b>Fencing of excavation after termination or sooner determination of the lease:</b><br/>The lessee on termination or sooner determination of the lease, shall at cost, suitably fence the excavations for safety as competent authority.</li>
		<li><b>Felling of trees:</b><br/>The lessee shall not fell or cut any tree, standing on the land wherein the located without obtaining prior permission in writing from the Forest Dep Assam and paying its price as fixed.</li>
		<li><b>Security deposit shall carry no interest:</b><br/>The security deposited by the lessee shall not carry any interest.</li>
		<li><b>State Government not responsible for loss to lessee:</b><br/>The Government shall not be responsible for any kind of loss to the lessee.</li>

		</ol>

		<h4 style="text-align:center"><b>Part-IV</b><br/><b>Rights of the State Government</b></h4>
		<ol type="1">
		 <li><b>Suspension or termination of the lease :</b><br/>The competent authority shall have the right to suspend or prematurely terminate the lease.</li>
		 <ol type="a">
		 <li>If the dead rent or royalty or surface rent or any other amount due t Government are not paid;</li>
		 <li>if any of the terms and conditions of the lease deed or conditions of grant or permission to undertake mining by any other statutory authority or competent authority is violated;</li>
		 <li>if any of the provisions of these rules and other laws both Central and State as are applicable to mines and minerals, are not complied with :<br/>Provided that no orders of suspension or termination of the lease shall be passed by the competent, Authority without giving reasonable opportunity to show cause and following the procedure prescribed in the Assam Minor Mineral Concession Rules, 2012.<br/>Provided further that the competent authority may also at any time after issuance of the notice for default on account of non payment of dues, enter upon the said premises and detrain all or any of the mineral(s) or movable property therein and may carry away; detain or order the sale of the property so detrained, or so much of it as will suffice for the satisfaction of the rent or royalty or both dues and all costs and expenses occasioned by the non-payment thereof and shall give proper receipt of the articles carried away.</li>
		</ol> 
		<li><b> Determination of lease in public interest :</b><br/>The Government may by giving &#39;six months&#39; prior notice in writing determine the lease if the
		Government consider that the minor mineral under the lease is required for establishing an Industry
		beneficial to the public<br/>
		Provided that in the State of National Emergency or War, the lease may be determined without giving such notice.</li>
		<li><b>Right of Pre-emption:</b><br/>The government shall from time to time and at all times during the terms of lease have the right (to be exercised by notice in writing to the lessee) of pre-emption of the said mineral(s) and all products
		thereof lying in or upon the said lands hereby demised or elsewhere under the control of the lessee
		and the lessee shall deliver all minerals or products thereof to the Government at current market rates
		in such quantities and in the manner at the place specified in the notice exercising the said right.</li>
		<li><b> Penalty for not allowing entry to officers:</b><br/>If the lessee or his transferee or assignee does not allow any entry or inspection under clause (13) of part-III, the competent authority may cancel the lease and forfeit in whole or in part the security deposit paid by the lessee.</li>
		<li><b>Settlement of Rent and Compensation Payable to third parties thereof :</b><br/>In case the occupier(s) or owner(s) of the said land refuses his/ their consent to the exercise of the rights and powers reserved to the Government and demised to the lessee under these presents, the lessee shall report the matter to the competent authority who shall request the Collector of the District concerned to direct the occupier(s) owner(s) to allow the lessee to enter the said lands and to carry out such operations may be, necessary for working the mine, on payment in advance of such rent compensation to the occupier or owner by the lessee, as may be fixed by the Collector as per the provisions of rules 46 and 47 of the rules.</li>
		<li><b>Suspension of mining operations :</b><br/>The competent authority may order to suspend the mining operations after serving notice to the lessee, in case, the following violations are noticed:-</li>
			<ol type="a">
			<li>Unsafe and unscientific mining;</li>
			<li>Non operations of weigh bridge</li>
			<li>Non providing of safety appliances to the workers</li>
			<li>Nonpayment of compensation to the surface Owners</li>
			<li>Non submissions of monthly returns;</li>
			</ol>
		
		</ol>
		<p>
		In case of violations of the aforesaid conditions and also any other terms conditions of the agreement
		deed and the provisions of the rules, the comp authority may give a notice to the lessee to remedy the
		violations within a period 15 days from the date of issue of the notice. In case, the violations pointed out
		thro notice, are not remedied within the stipulated period of 15 days, the corn authority may after
		affording an oppottun4 of being heard to the lessee, order suspension of the mining operations till such
		time, the defaults/ defects are remove the lessee within the time frame (within a maximum period of six
		months) granted the competent authority. During the period of suspension of mining operations,. lessee
		will be allowed only to undertake rectification work for removal of the de and shall not dispose of the
		mineral. During the suspension period, the lessee s under the obligation to deposit the amount of the
		dead rent on the due dates.</p>
		<p>On satisfactory removal of the defects, the competent authority may revoke suspension orders with or
		without any modification. Non removal of the def defaults during the suspension period and within the
		time allowed by the competent authority, shall lead to premature termination of lease.</p>
		
		
		<h4 style="text-align:center"><b>Part-V</b></h4>
		<ol type="1">
		 <li><b>Cancellation:</b><br/>The lease shall be liable to be cancelled by the competent authority if the le cease to work the mine for a continued period of six months without obtaining sanction.</li>
		 <li><b>Notices:</b><br/>Every notice by these presents required to be given to the lessee shall be given writing to such
			person resident on the said lands as the lessee may appoint for the purpose of receiving such
			notices and if there shall have been no such appointment then every such notice shall be sent to the
			lessee by registered post addressed to the lessee at the address recorded in this lease or at such
			other address in India as the lessee may from time to time in writing to the competent authority
			designate for the receipt of notices and every such service shall be deemed to be proper and valid
			smite upon the lessee and shall not be questioned or challenged by him.</li>
		 <li><b>Recovery of Government dues as arrears of land revenue:</b><br/>Without prejudice to any other mode of recovery authorised by any provision of this lease or by any law, all amounts, falling due hereunder against the lessee may be recovered as arrears of land revenue under the law in force for such recovery.</li>
		 <li><b>Forfeiture of property left more than three months after expiry or determination of lease :</b><br/>The lessee should remove his property lying on the said lands within three months after the expiry or
			sooner determination of the lease or after the date from Which any surrender by the lessee of the
			said lands under relevant rules of the Assam Minor Mineral Concession Rules, 2012 becomes
			effective, as the case may be, the property left after the aforesaid period shall become the property
			of the Government and may be sold or disposed of in such manner as the competent authority shall
			deem fit without liability to pay any compensation therefore, to the lessee.</li>
		<li><b>Security and forfeiture thereof:</b></li>
		 <ol type="a">
		 <li>the competent authority may forfeit the whole or any part of the amount deposited as &#39;Security&#39; under this lease, in case the lessee commits a breach(s) of any covenants to be performed by the lessee under this lease.</li>
		 <li>Whenever the said security deposit or any part thereof or any further sum hereafter deposited with
			the competent authority in replenishment thereof is forfeited under sub clause (a) or applied by the
			competent authority under this lease (which the Government is hereby authorised to do) the lessee
			shall immediately deposit with the inappropriate part thereof to bring the amount in deposit with the
			Government up to the requisite amount of security at that point of time of lease.</li>
		 <li>The rights conferred to the Government by clause (a) shall be without prejudice to
			the rights conferred on the State Government by any other provision of this lease or
			by any law.</li>
		 <li>On such date as the competent authority may elect within twelve calendar months after the
		determination of this lease or any renewal thereof, the amount of security deposit paid in respect of
		this lease and then remaining in deposit with the Government and not required to be applied to any
		of the purposes mentioned in this lease shall be refunded to the lessee. No interest shall run on the
		security deposit.</li>
		</ol>
		<li><b>Survey and demarcation of the area:</b><br/>When a mining lease is granted arrangement shall be made, if recess expense of the lessee, for the survey and demarcation of the area granted lease. The lessee shall have to bear actual expenses of the staff deputed for Actual expenses will include travelling allowances, daily allowances and sal plus 10 percent as instrument charges.</li>
		<li><b>Surrender of a mining lease by the lessee :</b><br/>The Government-may accept the request of a lease holder for surrender of part thereof in cases
		where it is established that it has not been found feasible the lease grant for whatsoever reasons
		subject.to the condition that the lessee :</li>
		<ol type="a"> 
		<li>has been regular in furnishing the production returns as required in the lease agreement;</li>
		<li>has been talking-the requisite steps for the progressive mine closure pl the conditions of the lease grant;</li>
		<li>is not in default of payment of any dues of the Government as on making such application and undertakes to pay all such dues till th expiry of the notice period either in cash in advance or by way of of the security or both;</li>
		<p>Provided that in case the lessee makes an application for surrender area of the lease, it shall not
		result in any prorated reduction of the and the rate of dead rent payable and applicable for the
		entire area at of such application shall remain intact.</p>

		</ol>
		<li><b>Penalty for repeated breaches :</b><br/>In case of repeated breaches of covenants and agreements by the lessee f notice has been given by
		the competent authority in accordance with Sub-rule Rule 55 and/ or sub rule(1) of rule 56 of the Assam
		Minor Mineral Concession 2012 on earlier occasions, the competent authority without giving any further
		may impose such penalty not exceeding twice the amount of annual dead rent specified in clause 3 of
		part-III of this form.</li>
		<li><b>Obtaining sales tax number :</b><br/>The lessee shall get himself registered with the commercial Taxes Department Assam State and shall obtain the Sales Tax Number. </li>
		<li><b>Overriding effect :</b><br/>Unless otherwise specifically provided, it is agreed that this deed shall be govern the provisions of the Mines and Minerals (Development and Regulation) Act, l9S of 1957) and the rules made thereunder.
         The provisions of the Act and the rules prevail over the terms and conditions of the agreement.<br/IN WITNESS WHEREOF:- These presents have been executed in the manner hereunder appearing the
         day and year first above written.></li>
		</ol>
		';	
			
	$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
	$printContents=$printContents.'
			
<table width="99%" align="center" border="0" class="table table-bordered table-responsive" style="margin:0px auto;">

	<tr>
		<td>Date : <strong> '.date('d-m-Y',strtotime($results["sub_date"])).'</strong></td>						
		<td align="right">Signature of the Lessee:<strong>'.strtoupper($contra_sig).'</strong></td>				
	</tr>	
	<tr>
		<td>For and on behalf of the Governor of Assam <strong>'.strtoupper($governor_assm).'</strong></td>						
		<td align="right">Signature of Surety :<strong>'.strtoupper($surety_sig).'</strong></td>				
	</tr>
</table>
</tbody>	
</table>
';
?>

