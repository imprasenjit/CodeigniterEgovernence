<?php
$dept="gmc";
$form="17";
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
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where uain='$uain' and user_id='$swr_id'");
}else if(isset($form_id)){
	$form_id=$form_id;
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and form_id='$form_id'");
}else{
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
}
		
		
		if($q->num_rows > 0){
		$results=$q->fetch_array();		
		$form_id=$results["form_id"];$dag_number=$results["dag_number"];$pp_no=$results["pp_no"];$vil_lage=$results["vil_lage"];$mou_za=$results["mou_za"];$sign_attorney_holder=$results["sign_attorney_holder"];
			
			//tab2//
		if(!empty($results["appli"])){
			$appli=json_decode($results["appli"]);
            if(isset($appli->nm)) $appli_nm=$appli->nm; else $appli_nm="";
            if(isset($appli->address)) $appli_address=$appli->address; else $appli_address="";
            if(isset($appli->contactno)) $appli_contactno=$appli->contactno; else $appli_contactno="";
            if(isset($appli->emailid)) $appli_emailid=$appli->emailid; else $appli_emailid="";
			
		}else{
			$appli_nm="";$appli_address="";$appli_contactno="";$appli_emailid="";
		}
		if(!empty($results["full"])){
			$full=json_decode($results["full"]);
			$full_dagno=$full->dagno;$full_divno=$full->divno;$full_town=$full->town;$full_mouza=$full->mouza;$full_area=$full->area;
		}else{
			$full_dagno="";$full_divno="";$full_town="";$full_mouza="";$full_area="";
		}
		$is_adjoining=$results["is_adjoining"];$details_adjoining=$results["details_adjoining"];$present_land=$results["present_land"];$previous_land=$results["previous_land"];$number_dwelling=$results["number_dwelling"];$is_felling=$results["is_felling"];$details_felling=$results["details_felling"];$is_erection=$results["is_erection"];$details_erection=$results["details_erection"];$hindu_religious=$results["hindu_religious"];$signed_application=$results["signed_application"];$signed_architect=$results["signed_architect"];$owner_sign=$results["owner_sign"];
		
        if(!empty($results["extentland"])){
			$extentland=json_decode($results["extentland"]);
			$extentland_residential=$extentland->residential;$extentland_commercial=$extentland->commercial;$extentland_industrial=$extentland->industrial;$extentland_institutional=$extentland->institutional;$extentland_park=$extentland->park;$extentland_roads=$extentland->roads;
		}else{
			$extentland_residential="";$extentland_commercial="";$extentland_industrial="";$extentland_institutional="";$extentland_park="";$extentland_roads="";
		}
		
		if(!empty($results["architect"])){
			$architect=json_decode($results["architect"]);
            if(isset($architect->address)) $architect_address=$architect->address; else $architect_address="";
            if(isset($architect->email)) $architect_email=$architect->email; else $architect_email="";
            if(isset($architect->cont)) $architect_cont=$architect->cont; else $architect_cont="";
            if(isset($architect->sign)) $architect_sign=$architect->sign; else $architect_sign="";
			
		}else{
			$architect_address="";$architect_email="";$architect_cont="";$architect_sign="";
		}
			
			if($is_adjoining=="Y"){
				$is_adjoining="YES";
			}elseif($is_adjoining=="N"){
				$is_adjoining="NO";
			}
			if($is_felling=="Y"){
				$is_felling="YES";
			}elseif($is_felling=="N"){
				$is_felling="NO";
			}
			if($is_erection=="Y"){
				$is_erection="YES";
			}elseif($is_erection=="N"){
				$is_erection="NO";
			}
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
		<h2 align="center">'.$assamSarkarLogo.'<br/>'.$form_name.'</h2>
		<br/>
		<table class="table table-bordered table-responsive">
		<tbody>			
			<tr>
				<td colspan="2">To,<br/>
				<b>The Chief Executive Officer,</b><br/>Guwahati Metropolitan Development Authority,<br/>Bhangagarh, Guwahati.</td>
			</tr>
			<tr>
				<td colspan="4">Sir,<br/>I hereby apply for Planning Permission for laying out of my land in Dag No&nbsp;&nbsp;'.strtoupper($dag_number).'&nbsp;&nbsp;PP No &nbsp;&nbsp;'.strtoupper($pp_no).'&nbsp;&nbsp;Village &nbsp;&nbsp;'.strtoupper($vil_lage).'&nbsp;&nbsp; Mouza &nbsp;&nbsp;'.strtoupper($mou_za).'&nbsp;&nbsp;for building purposes/desire to find out whether under noted development is permissible.</td>
			</tr>
			<tr>
				<td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;I forward herewith the following particulars in quadruplicate duly signed by the Registered Technical Person and me.</td>
			</tr>
			<tr>
			 <td colspan="2">
			 <ul>
			  <ol type="a">
			   <li>A key map of the site showing adjoining areas of the proposed layout under reference, marking clearly therein the boundaries of the proposed layout in colour, existing roads, structures, landmarks, streams, H.T. or L.T. Power Lines, drains to passing through layout and levels of the site.</li>
			   <li>A detailed site plan to a scale of not less than 1:200 showing the proposed layout indicating size of plots, width of the proposed roads, open spaces and amenities provided and type of buildings be built, if any, and</li>
			   <li>The Trace map of the area. required under building byelaws.</li>
			   <li>Other documents, maps and drawings as required under building byelaws.</li>
			  </ol>
			 </ul>
			 </td>
			</tr>
			<tr>
				<td colspan="2">&nbsp;&nbsp;I/We the owner/legal representative of the land to which the accompanying application relates request that the layout may be approved and Planning Permission may be accorded.</td>
			</tr>
			<tr>
				<td> Date : '.date('d-m-Y',strtotime($results["sub_date"])).' </td>
				<td align="right">Signature of the Owner of the land/Power of attorney holder/Lease Holder :'.strtoupper($sign_attorney_holder).'</td>
			</tr>
			<tr>
			     <td align="center" colspan="2"><b>PART II</b></td>
			</tr>
			<tr>
			  <td colspan="2"><b>TO BE COMPLETED BY THE OWNER OF THE LAND / POWER OF ATTORNEY HOLDER / LEASE HOLDER</b></td>
			</tr>
			<tr>
					<td colspan="2">1. Applicant Details(in block capital) :</td>
			</tr>
			<tr>
				<td valign="top">5. Plinth area of the building, (Floor wise area in case of multi storied buildings) </td>
				<td>
					<table class="table table-bordered table-responsive">
						<tr>
							<td> Name </td>
							<td>'.strtoupper($appli_nm).'</td>
						</tr>
						<tr>
							<td>Communication address</td>
							<td>'.strtoupper($appli_address).'</td>
					    </tr>
						<tr>
							<td>Contact No </td>
							<td>'.strtoupper($appli_contactno).'</td>
						</tr>
						<tr>
							<td>Email ID</td>
							<td>'.$appli_emailid.'</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
			  <td colspan="2"><b>Particulars of proposal for which permission or approval is sought</b></td>
			</tr>
			<tr>
				<td>2. (a) Full address or location of the land to which this application relates and site area :</td>
			 <td>
			   <table class="table table-bordered table-responsive">
			
				<tr>
					<td>Dag No./PP No :</td>
					<td>'.strtoupper($full_dagno).'</td>
				</tr>
				<tr>
					<td>Division No./Ward No :</td>
					<td>'.strtoupper($full_divno).'</td>
				</tr>
				<tr>
					<td>Name of Town or village :</td>
					<td>'.strtoupper($full_town).'</td>
				</tr>
				<tr>
					<td>Mouza :</td>
					<td>'.strtoupper($full_mouza).'</td>
				</tr>
				<tr>
					<td>Land area :</td>
					<td>'.strtoupper($full_area).'</td>
				</tr>
				<tr>
					<td>(b) State whether the applicant owns or controls any adjoining land. If so give its location and extent.:</td>
					<td>'.strtoupper($is_adjoining).'  '.strtoupper($details_adjoining).'</td>
				</tr>
			 </table>
			</td>
			</tr>
			<tr>
				<td colspan="2">3. Particulars of present and previous use of land :</td>
			</tr>
			<tr>
				<td>(i) Present use of land: </td>
				<td>'.strtoupper($present_land).'</td>
			</tr>
			<tr>
				<td>(ii) If vacant, the last previous use:</td>
				<td>'.strtoupper($previous_land).'</td>
			</tr>	
           <tr>
				<td colspan="2">4. Information regarding the proposed use :</td>
			</tr>			
			<tr>
				<td>(i) State number and type of dwelling units : (whether bungalows, houses, flats, etc.) factories Shops, institutions, parks & play fields etc. proposed.</td>
				<td>'.strtoupper($number_dwelling).'</td>
			</tr>
			<tr>
				<td colspan="2">(ii) Extent of land use proposed : (extent in hectares) </td>
			</tr>
			<tr>
				<td valign="top">5. Plinth area of the building, (Floor wise area in case of multi storied buildings) </td>
				<td>
					<table class="table table-bordered table-responsive">
						<tr>
							<td> (a) Land allotted for residential purpose  </td>
							<td>'.strtoupper($extentland_residential).'</td>
						</tr>
						<tr>
							<td>(b) Land allotted for commercial purpose</td>
							<td>'.strtoupper($extentland_commercial).'</td>
					    </tr>
						<tr>
							<td>(c) Land allotted for industrial purpose</td>
							<td>'.strtoupper($extentland_industrial).'</td>
						</tr>
						<tr>
							<td>(d) Land allotted for institutional purpose</td>
							<td>'.strtoupper($extentland_institutional).'</td>
						</tr>
						<tr>
							<td>(e) Land allotted for park and play fields</td>
							<td>'.strtoupper($extentland_park).'</td>
						</tr>
						<tr>
							<td>(f) Land allotted for roads and pathways</td>
							<td>'.strtoupper($extentland_roads).'</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>5. Does the proposed development involve felling of any trees?If yes, indicate the position on plan.</td>
				<td>'.strtoupper($is_felling).'&nbsp;&nbsp;'.strtoupper($details_felling).'</td>
			</tr>
			<tr>
				<td>6. Does the proposed development involve erection of any advertisement board? If yes, indicate its position on plan and type of the Advertisement board to be erected.</td>
				<td>'.strtoupper($is_erection).'&nbsp;&nbsp;'.strtoupper($details_erection).'</td>
			</tr>
			<tr>
				<td>7. Whether the land in question is property belonging to a Wakf or a Hindu Religious Institution and if so whether proper prior approval or authority clearance has been obtained for the proposed development.</td>
				<td>'.strtoupper($hindu_religious).'</td>
			</tr>
			<tr>
				<td colspan="2">CONDITIONS</td>
			</tr>
            <tr>
				<td colspan="2">
					<ul>
					  <ol type="i">
					   <li>I agree not to proceed with laying out of land for building purposes until the planning permission is granted by the Authority under relevant provision of building byelaws and Guwahati Building Construction (Regulation) Act 2010.</li>
					   <li>I agree not to do any development otherwise than in accordance with the layout plan, specifications which have been approved or in contravention of any provision of the building byelaws, order or other declaration made there under or of any direction or requisition lawfully given or made under the said Act rules or by laws.</li>
					   <li>I agree to make any modification which may be required by any notice issued by any order confirmed by the Authority.</li>
					   <li>I agree to keep one copy of the approved layout plans at the site at all reasonable times when development is in progress and also agree to see that the plan is available and the site is open at all reasonable times for the inspection of the Authority or any officer authorized by him in that behalf.</li>
					   <li>I agree to furnish a set of completion plans within fifteen days from the date of completion of the development.</li>
					   <li>I agree to hand over all the proposed roads after duly forming them to the satisfaction of the local authority concerned and sites reserved for parks, play grounds, open spaces for public purpose free of cost to the local authority concerned in which the site falls when so directed by the authority.</li>
					  </ol>
					 </ul>
				</td>
			</tr>
			<tr>
				   <td colspan="2">I&nbsp;&nbsp;'.strtoupper($signed_application).'&nbsp;&nbsp;have signed this application in my capacity as the Owner/Power of Attorney Holder/Lease Holder and declare that the checklist and statement made therein are true to the best of my knowledge and belief.</td>
			</tr>
			<tr>
				   <td colspan="4">I&nbsp;&nbsp;'.strtoupper($signed_architect).'&nbsp;&nbsp;have signed this Architect/RTP of Attorney Holder/Lease Holder and declare that the checklist and statement made therein are true to the best of my knowledge and belief.</td>
			</tr>
			
			<tr>
				<td>Address Details of the Architect/RTP :</td>
		     <td>
			  <table class="table table-bordered table-responsive">
				<tr>
						<td>Address</td>
						<td>'.strtoupper($architect_address).'</td>
				</tr>
				<tr>
						<td>Email id</td>
						<td>'.$architect_email.'</td>
				</tr>
				<tr>
						<td>Contact No.</td>
						<td>'.$architect_cont.'</td>
				</tr>
			</table>
			</td>
			</tr>
			';
			
			$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
			$printContents=$printContents.'
			
			
				 <tr>
					    <td>Signature of the Architect/RTP: '.strtoupper($architect_sign).'</td>
						<td align="right">Signature of the Owner of the Land /Power of attorney holder / Lease holder: '.strtoupper($owner_sign).'</td>
				</tr>
				<tr>
					    <td> Date : '.date('d-m-Y',strtotime($results["sub_date"])).' </td>
						<td align="right">Place: '.strtoupper($dist).'</td>
				</tr>
			
		</tbody>
	</table>';
?>