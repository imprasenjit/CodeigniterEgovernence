<?php
$dept="pcb";
$form="79";
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

if($q->num_rows>0){
	$results=$q->fetch_assoc();
	$form_id=$results['form_id'];
	// Tab 1 //
	$city_name=$results['city_name'];$state_name=$results['state_name'];$population=$results['population'];$area=$results['area'];
	if(!empty($results["local"])){
		$local=json_decode($results["local"]);
		$local_name=$local->name;$local_sn1=$local->sn1;$local_sn2=$local->sn2;$local_vill=$local->vill;$local_dist=$local->dist;$local_pin=$local->pin;$local_mobile=$local->mobile;$local_tel=$local->tel;$local_fax=$local->fax;$local_email=$local->email;
	}else{				
		$local_name="";$local_sn1="";$local_sn2="";$local_vill="";$local_dist="";$local_pin="";$local_mobile="";$local_tel="";$local_fax="";$local_email="";
	}
	if(!empty($results["operator"])){
		$operator=json_decode($results["operator"]);
		$operator_name=$operator->name;$operator_sn1=$operator->sn1;$operator_sn2=$operator->sn2;$operator_vill=$operator->vill;$operator_dist=$operator->dist;$operator_pin=$operator->pin;$operator_mobile=$operator->mobile;
	}else{				
		$operator_name="";$operator_sn1="";$operator_sn2="";$operator_vill="";$operator_dist="";$operator_pin="";$operator_mobile="";
	}
	if(!empty($results["officer"])){
		$officer=json_decode($results["officer"]);
		$officer_name=$officer->name;$officer_phone=$officer->phone;$officer_fax=$officer->fax;$officer_email=$officer->email;
	}else{				
		$officer_name="";$officer_phone="";$officer_fax="";$officer_email="";
	}	
	// Tab 2 //		
	$household_no=$results['household_no'];$premise_no=$results['premise_no'];$election_no=$results['election_no'];$source=$results['source'];$is_stored=$results['is_stored'];$is_segregated=$results['is_segregated'];$is_segregated_details=$results['is_segregated_details'];$is_d2d=$results['is_d2d'];		
	if(!empty($results["quantity"])){
		$quantity=json_decode($results["quantity"]);
		$quantity_generate=$quantity->generate;$quantity_collect=$quantity->collect;$quantity_capita=$quantity->capita;$quantity_process=$quantity->process;$quantity_dispose=$quantity->dispose;
	}else{				
		$quantity_generate="";$quantity_collect="";$quantity_capita="";$quantity_process="";$quantity_dispose="";
	}		
	if(!empty($results["bins"])){
		$bins=json_decode($results["bins"]);
		$bins_domestic=$bins->domestic;$bins_commercial=$bins->commercial;$bins_households=$bins->households;$bins_premises=$bins->premises;
	}else{				
		$bins_domestic="";$bins_commercial="";$bins_households="";$bins_premises="";
	}		
	if(!empty($results["d2d"])){
		$d2d=json_decode($results["d2d"]);
		$d2d_ward=$d2d->ward;$d2d_households=$d2d->households;$d2d_premises=$d2d->premises;$d2d_vehicle=$d2d->vehicle;$d2d_handcart=$d2d->handcart;$d2d_other=$d2d->other;$d2d_method=$d2d->method;$d2d_sweep=$d2d->sweep;
	}else{				
		$d2d_ward="";$d2d_households="";$d2d_premises="";$d2d_vehicle="";$d2d_handcart="";$d2d_other="";$d2d_method="";$d2d_sweep="";
	}
	
	if($is_stored=="Y") $is_stored="Yes";
	else $is_stored="No";
	if($is_segregated=="Y") $is_segregated="Yes";
	else $is_segregated="No";
	if($is_d2d=="Y") $is_d2d="Yes";
	else $is_d2d="No";
		
	// Tab 3 //
	$length=$results['length'];$ratio=$results['ratio'];
	if(!empty($results["percent"])){
		$percent=json_decode($results["percent"]);
		$percent_daily=$percent->daily;$percent_days=$percent->days;$percent_week=$percent->week;$percent_occasion=$percent->occasion;
	}else{				
		$percent_daily="";$percent_days="";$percent_week="";$percent_occasion="";
	}
	if(!empty($results["tools"])){
		$tools=json_decode($results["tools"]);
		$tools_used=$tools->used;$tools_manual=$tools->manual;$tools_mech=$tools->mech;$tools_broom=$tools->broom;$tools_handcart=$tools->handcart;$tools_tricycle=$tools->tricycle;$tools_collect=$tools->collect;
	}else{				
		$tools_used="";$tools_manual="";$tools_mech="";$tools_broom="";$tools_handcart="";$tools_tricycle="";$tools_collect="";
	}
	if(!empty($results["storage"])){
		$storage=json_decode($results["storage"]);
		$storage_open=$storage->open;$storage_masonry=$storage->masonry;$storage_concrete=$storage->concrete;$storage_dhalao=$storage->dhalao;$storage_metal=$storage->metal;$storage_bins=$storage->bins;$storage_bins2=$storage->bins2;$storage_containers=$storage->containers;$storage_city=$storage->city;
	}else{				
		$storage_open="";$storage_masonry="";$storage_concrete="";$storage_dhalao="";$storage_metal="";$storage_bins="";$storage_bins2="";$storage_containers="";$storage_city="";
	}
	
	if($tools_broom=="Y") $tools_broom="Yes";
	else $tools_broom="No";
	if($tools_handcart=="Y") $tools_handcart="Yes";
	else $tools_handcart="No";
	if($tools_tricycle=="Y") $tools_tricycle="Yes";
	else $tools_tricycle="No";
	if($tools_collect=="Y") $tools_collect="Yes";
	else $tools_collect="No";
	
	// Tab 4 //
	$total_storage=$results['total_storage'];$total_waste=$results['total_waste'];$is_facility=$results['is_facility'];
	if(!empty($results["ward"])){
		$ward=json_decode($results["ward"]);
		$ward_depots=$ward->depots;$ward_number=$ward->number;$ward_area=$ward->area;$ward_population=$ward->population;$ward_bins_no=$ward->bins_no;$ward_bins_vol=$ward->bins_vol;
	}else{				
		$ward_depots="";$ward_number="";$ward_area="";$ward_population="";$ward_bins_no="";$ward_bins_vol="";
	}
	if(!empty($results["frequency"])){
		$frequency=json_decode($results["frequency"]);
		$frequency_daily=$frequency->daily;$frequency_days=$frequency->days;$frequency_twice=$frequency->twice;$frequency_once=$frequency->once;$frequency_occasion=$frequency->occasion;
	}else{				
		$frequency_daily="";$frequency_days="";$frequency_twice="";$frequency_once="";$frequency_occasion="";
	}
	if(!empty($results["number"])){
		$number=json_decode($results["number"]);
		$number_green=$number->green;$number_blue=$number->blue;$number_black=$number->black;
	}else{				
		$number_green="";$number_blue="";$number_black="";
	}
	if(!empty($results["lifting"])){
		$lifting=json_decode($results["lifting"]);
		$lifting_manual=$lifting->manual;$lifting_mech=$lifting->mech;$lifting_method=$lifting->method;$lifting_transport=$lifting->transport;$lifting_specify=$lifting->specify;
	}else{				
		$lifting_manual="";$lifting_mech="";$lifting_method="";$lifting_transport="";$lifting_specify="";
	}
	
	if($is_facility=="Y") $is_facility="Yes";
	else $is_facility="No";
	if($lifting_transport=="Y") $lifting_transport="Yes";
	else $lifting_transport="No";	
	if($lifting_method=="F") $lifting_method="Front-end loaders";
	else if($lifting_method=="T") $lifting_method="Top loaders";
	
	// Tab 5 //  
	$waste_treatment=$results['waste_treatment'];$waste_process=$results['waste_process'];$waste_process_qty=$results['waste_process_qty'];
	if(!empty($results["transport"])){
		$transport=json_decode($results["transport"]);
		$transport_daily=$transport->daily;$transport_days=$transport->days;$transport_twice=$transport->twice;$transport_once=$transport->once;$transport_occasion=$transport->occasion;$transport_qty=$transport->qty;$transport_percent=$transport->percent;
	}else{				
		$transport_daily="";$transport_days="";$transport_twice="";$transport_once="";$transport_occasion="";$transport_qty="";$transport_percent="";
	}
	if(!empty($results["vehicles"])){
		$vehicles=json_decode($results["vehicles"]);
		$vehicles_animal=$vehicles->animal;$vehicles_tractors=$vehicles->tractors;$vehicles_tipping=$vehicles->tipping;$vehicles_non_tipping=$vehicles->non_tipping;$vehicles_dumper=$vehicles->dumper;$vehicles_refuse=$vehicles->refuse;$vehicles_compactors=$vehicles->compactors;$vehicles_others=$vehicles->others;$vehicles_jcb=$vehicles->jcb;
	}else{				
		$vehicles_animal="";$vehicles_tractors="";$vehicles_tipping="";$vehicles_non_tipping="";$vehicles_dumper="";$vehicles_refuse="";$vehicles_compactors="";$vehicles_others="";$vehicles_jcb="";
	}
	if(!empty($results["process"])){
		$process=json_decode($results["process"]);
		$process_available=$process->available;$process_utilized=$process->utilized;$process_operation=$process->operation;$process_construction=$process->construction;$process_distance=$process->distance;
	}else{				
		$process_available="";$process_utilized="";$process_operation="";$process_construction="";$process_distance="";
	}
	if($waste_process=="Y") $waste_process="Yes";
	else $waste_process="No";
	
	// Tab 6 //
	$co_process_raw=$results['co_process_raw'];
	if(!empty($results["compost"])){
		$compost=json_decode($results["compost"]);
		$compost_raw=$compost->raw;$compost_product=$compost->product;$compost_sold=$compost->sold;$compost_residual=$compost->residual;
	}else{				
		$compost_raw="";$compost_product="";$compost_sold="";$compost_residual="";
	}
	if(!empty($results["vermi"])){
		$vermi=json_decode($results["vermi"]);
		$vermi_raw=$vermi->raw;$vermi_product=$vermi->product;$vermi_sold=$vermi->sold;$vermi_residual=$vermi->residual;
	}else{				
		$vermi_raw="";$vermi_product="";$vermi_sold="";$vermi_residual="";
	}
	if(!empty($results["bio"])){
		$bio=json_decode($results["bio"]);
		$bio_raw=$bio->raw;$bio_product=$bio->product;$bio_sold=$bio->sold;$bio_residual=$bio->residual;
	}else{				
		$bio_raw="";$bio_product="";$bio_sold="";$bio_residual="";
	}
	if(!empty($results["fuel"])){
		$fuel=json_decode($results["fuel"]);
		$fuel_raw=$fuel->raw;$fuel_product=$fuel->product;$fuel_sold=$fuel->sold;$fuel_residual=$fuel->residual;
	}else{				
		$fuel_raw="";$fuel_product="";$fuel_sold="";$fuel_residual="";
	}
	if(!empty($results["energy"])){
		$energy=json_decode($results["energy"]);
		$energy_raw=$energy->raw;$energy_product=$energy->product;$energy_sold=$energy->sold;$energy_residual=$energy->residual;
	}else{				
		$energy_raw="";$energy_product="";$energy_sold="";$energy_residual="";
	}
	if(!empty($results["combustible"])){
		$combustible=json_decode($results["combustible"]);
		$combustible_cement=$combustible->cement;$combustible_power=$combustible->power;
	}else{				
		$combustible_cement="";$combustible_power="";
	}
	// Tab 7 //
	$others_s_details=$results['others_s_details'];$others_t_details=$results['others_t_details'];$action_plan=$results['action_plan'];$slums=$results['slums'];$manpower=$results['manpower'];$difficulties=$results['difficulties'];$innovative=$results['innovative'];
	if(!empty($results["others"])){
		$others=json_decode($results["others"]);
		$others_a=$others->a;$others_b=$others->b;$others_c=$others->c;$others_d=$others->d;$others_e=$others->e;$others_f=$others->f;$others_g=$others->g;$others_h=$others->h;$others_i=$others->i;$others_j=$others->j;$others_k=$others->k;$others_l=$others->l;$others_m=$others->m;$others_n=$others->n;$others_o=$others->o;$others_p=$others->p;$others_q=$others->q;$others_r=$others->r;$others_s=$others->s;$others_t=$others->t;$others_u=$others->u;$others_v=$others->v;$others_w=$others->w;$others_x=$others->x;
	}else{				
		$others_a="";$others_b="";$others_c="";$others_d="";$others_e="";$others_f="";$others_g="";$others_h="";$others_i="";$others_j="";$others_k="";$others_l="";$others_m="";$others_n="";$others_o="";$others_p="";$others_q="";$others_r="";$others_s="";$others_t="";$others_u="";$others_v="";$others_w="";$others_x="";
	}
	if(!empty($results["provisions"])){
		$provisions=json_decode($results["provisions"]);
		$provisions_dairy=$provisions->dairy;$provisions_debris=$provisions->debris;$provisions_slaughter=$provisions->slaughter;
	}else{				
		$provisions_dairy="";$provisions_debris="";$provisions_slaughter="";
	}
	
	if($others_l=="Y") $others_l="Yes";
	else $others_l="No";
	if($others_m=="Y") $others_m="Yes";
	else $others_m="No";
	if($others_o=="Y") $others_o="Yes";
	else $others_o="No";
	if($others_p=="Y") $others_p="Yes";
	else $others_p="No";
	if($others_q=="Y") $others_q="Yes";
	else $others_q="No";
	if($others_s=="Y") $others_s="Yes";
	else $others_s="No";
	if($others_t=="Y") $others_t="Yes";
	else $others_t="No";
	if($others_v=="Y") $others_v="Yes";
	else $others_v="No";
	if($others_w=="Y") $others_w="Yes";
	else $others_w="No";
	if($others_x=="Y") $others_x="Yes";
	else $others_x="No";	
	if($action_plan=="Y") $action_plan="Yes";
	else $action_plan="No";
	if($provisions_dairy=="Y") $provisions_dairy="Yes";
	else $provisions_dairy="No";
	if($provisions_debris=="Y") $provisions_debris="Yes";
	else $provisions_debris="No";
	if($provisions_slaughter=="Y") $provisions_slaughter="Yes";
	else $provisions_slaughter="No";	
	if($slums=="Y") $slums="Yes";
	else $slums="No";	
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
<br>
<table class="table table-bordered table-responsive">
	<tr>
		<td width="50%">1. Name of the City/Town </td>
		<td>'.strtoupper($city_name).'</td>
	</tr>
	<tr>
		<td>2. Name of the State </td>
		<td>'.strtoupper($state_name).'</td>
	</tr>
	<tr>
		<td>3. Population </td>
		<td>'.strtoupper($population).'</td>
	</tr>
	<tr>
		<td>4. Area in sq. kilometers </td>
		<td>'.strtoupper($area).'</td>
	</tr>
	<tr>
		<td>5. Name of the local body </td>
		<td>'.strtoupper($local_name).'</td>
	</tr>
	<tr>
		<td colspan="2">6. Address of the local body : </td>
	</tr>
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<tr>
				<td width="25%">Street Name 1 </td>
				<td width="25%">'.strtoupper($local_sn1).'</td>
				<td width="25%">Street Name 2 </td>
				<td width="25%">'.strtoupper($local_sn2).'</td>
			</tr>
			<tr>
				<td>Village/Town </td>
				<td>'.strtoupper($local_vill).'</td>
				<td>District </td>
				<td>'.strtoupper($local_dist).'</td>
			</tr>
			<tr>
				<td>Pincode </td>
				<td>'.strtoupper($local_pin).'</td>
				<td>Mobile </td>
				<td>+91 - '.strtoupper($local_mobile).'</td>
			</tr>
			<tr>
				<td>Telephone No. </td>
				<td>'.strtoupper($local_tel).'</td>
				<td>Fax No. </td>
				<td>'.strtoupper($local_fax).'</td>
			</tr>
			<tr>
				<td>Email </td>
				<td colspan="3">'.strtoupper($local_email).'</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td>7. Name of operator of the facility </td>
		<td>'.strtoupper($operator_name).'</td>
	</tr>
	<tr>
		<td colspan="2">8. Address of operator of the facility : </td>
	</tr>
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<tr>
				<td width="25%">Street Name 1 </td>
				<td width="25%">'.strtoupper($operator_sn1).'</td>
				<td width="25%">Street Name 2 </td>
				<td width="25%">'.strtoupper($operator_sn2).'</td>
			</tr>
			<tr>
				<td>Village/Town </td>
				<td>'.strtoupper($operator_vill).'</td>
				<td>District </td>
				<td>'.strtoupper($operator_dist).'</td>
			</tr>
			<tr>
				<td>Pincode </td>
				<td>'.strtoupper($operator_pin).'</td>
				<td>Mobile </td>
				<td>+91 - '.strtoupper($operator_mobile).'</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td>9. Name of officer in-charge of the facility : </td>
		<td>'.strtoupper($officer_name).'</td>
	</tr>
	<tr>
		<td colspan="2">10. Details of officer in-charge of the facility : </td>
	</tr>
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<tr>
				<td width="50%">Phone No. </td>
				<td>'.strtoupper($officer_phone).'</td>
			</tr>
			<tr>
				<td>Fax No. </td>
				<td>'.strtoupper($officer_fax).'</td>
			</tr>
			<tr>
				<td>Email Id </td>
				<td>'.strtoupper($officer_email).'</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td>11. Number of households in the city/town </td>
		<td>'.strtoupper($household_no).'</td>
	</tr>
	<tr>
		<td>12. Number of non-residential premises in the city </td>
		<td>'.strtoupper($premise_no).'</td>
	</tr>
	<tr>
		<td>13. Number of election/ administrative wards in the city/town </td>
		<td>'.strtoupper($election_no).'</td>
	</tr>
	<tr>
		<td colspan="2">14. Quantity of Solid waste : </td>
	</tr>
	<tr>
		<td>(a) Estimated Quantity of solid waste generated in the local body area per day in metric tones </td>
		<td>'.strtoupper($quantity_generate).'&nbsp;/tpd</td>
	</tr>
	<tr>
		<td>(b) Quantity of solid waste collected per day </td>
		<td>'.strtoupper($quantity_collect).'&nbsp;/tpd</td>
	</tr>
	<tr>
		<td>(c) Per capita waste collected per day </td>
		<td>'.strtoupper($quantity_capita).'&nbsp;/gm/day</td>
	</tr>
	<tr>
		<td>(d) Quantity of solid waste processed </td>
		<td>'.strtoupper($quantity_process).'&nbsp;/tpd</td>
	</tr>
	<tr>
		<td>(e) Quantity of solid waste disposed at landfill </td>
		<td>'.strtoupper($quantity_dispose).'&nbsp;/tpd</td>
	</tr>
	<tr>
		<td colspan="2">15. Status of Solid Waste Management (SWM) service : </td>
	</tr>
	<tr>
		<td>(a) Segregation and storage of waste at source </td>
		<td>'.strtoupper($source).'</td>
	</tr>
	<tr>
		<td>(b) Whether solid waste is stored at source in domestic/commercial/institutional bins ? </td>
		<td>'.strtoupper($is_stored).'</td>
	</tr>';
	if($is_stored=="Yes"){
		$printContents=$printContents.'
	<tr>
		<td colspan="2"><strong>If Yes : </strong></td>
	</tr>
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<tr>
				<td width="50%">(i) Percentage of households practice storage of waste at source in domestic bins </td>
				<td>'.strtoupper($bins_domestic).'&nbsp;%</td>
			</tr>
			<tr>
				<td>(ii) Percentage of non-residential premises practice storage of waste at source in commercial/institutional bins </td>
				<td>'.strtoupper($bins_commercial).'&nbsp;%</td>
			</tr>
			<tr>
				<td>(iii) Percentage of households dispose of throw solid waste on the streets </td>
				<td>'.strtoupper($bins_households).'&nbsp;%</td>
			</tr>
			<tr>
				<td>(iv) Percentage of non-residential premises dispose of throw solid waste on the streets </td>
				<td>'.strtoupper($bins_premises).'&nbsp;%</td>
			</tr>
		</table>
		</td>
	</tr>';
	}else{
		$is_stored=="No";
	}
	$printContents=$printContents.'
	<tr>
		<td>(c) Whether solid waste is stored at source in a segregated form ? <br/> If yes, Percentage of premises segregating the waste at source</td>
		<td>'.strtoupper($is_segregated).'<br/>'.strtoupper($is_segregated_details).'</td>
	</tr>
	<tr>
		<td colspan="2">16. Door to Door Collection of solid waste : </td>
	</tr>
	<tr>
		<td>(a) Whether door to door collection (D2D) of solid waste is being done in the city/town ? </td>
		<td>'.strtoupper($is_d2d).'</td>
	</tr>';
	if($is_d2d=="Yes"){
		$printContents=$printContents.'
		<tr>
			<td colspan="2"><strong>If Yes : </strong></td>
		</tr>
		<tr>
			<td colspan="2">
			<table class="table table-bordered table-responsive">
				<tr>
					<td width="50%">(i) Number of wards covered in D2D collection of waste </td>
					<td>'.strtoupper($d2d_ward).'</td>
				</tr>
				<tr>
					<td>(ii) No. of households covered </td>
					<td>'.strtoupper($d2d_households).'</td>
				</tr>
				<tr>
					<td>(iii) No. of non-residential premises including commercial establishments ,hotels, restaurants educational institutions/ offices etc covered </td>
					<td>'.strtoupper($d2d_premises).'</td>
				</tr>
				<tr>
					<td>(iv) Percentage of residential and non-residential premises covered in door to door collection through </td>
					<td><b>Motorized vehicle : </b>'.strtoupper($d2d_vehicle).'&nbsp;%
					<br/><b>Containerized tricycle/handcart : </b>'.strtoupper($d2d_handcart).'&nbsp;%
					<br/><b>Other device : </b>'.strtoupper($d2d_other).'&nbsp;% </td>
				</tr>
			</table>
			</td>
		</tr>';
	}else{
		$printContents=$printContents.'
		<tr>
			<td><strong>If not : </strong></td>
			<td><b>Method of primary collection adopted : </b>'.strtoupper($d2d_method).'
			<br/><b>Sweeping of streets : </b>'.strtoupper($d2d_sweep).'</td>
		</tr>';
	}
	$printContents=$printContents.'
	<tr>
		<td>17. Length of roads, streets, lanes, bye-lanes in the city that need to be cleaned (in km) </td>
		<td>'.strtoupper($length).'&nbsp;km </td>
	</tr>
	<tr>
		<td colspan="2">18. Frequency of street sweepings and percentage of population covered : </td>
	</tr>	
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<thead>
				<tr>
					<th width="20%">Frequency</th>
					<th width="20%">Daily</th>
					<th width="20%">Alternate days</th>
					<th width="20%">Twice a week</th>
					<th width="20%">Occasionally</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>% of population covered</td>
					<td>'.strtoupper($percent_daily).'</td>
					<td>'.strtoupper($percent_days).'</td>
					<td>'.strtoupper($percent_week).'</td>
					<td>'.strtoupper($percent_occasion).'</td>
				</tr>
			</tbody>
		</table>
		</td>
	</tr>
	<tr>
		<td>19. Tools used </td>
		<td>'.strtoupper($tools_used).'</td>
	</tr>
	<tr>
		<td>(a) Manual sweeping </td>
		<td>'.strtoupper($tools_manual).'&nbsp;% </td>
	</tr>
	<tr>
		<td>(b) Mechanical sweeping </td>
		<td>'.strtoupper($tools_mech).'&nbsp;% </td>
	</tr>
	<tr>
		<td>(c) Whether long handle broom used by sanitation workers ? </td>
		<td>'.strtoupper($tools_broom).'</td>
	</tr>
	<tr>
		<td>(d) Whether each sanitation worker is given handcart/tricycle for collection of waste ? </td>
		<td>'.strtoupper($tools_handcart).'</td>
	</tr>
	<tr>
		<td>(e) Whether handcart / tricycle is containerized ? </td>
		<td>'.strtoupper($tools_tricycle).'</td>
	</tr>
	<tr>
		<td>(f) Whether the collection tool synchronizes with collection/ waste storage containers utilized ? </td>
		<td>'.strtoupper($tools_collect).'</td>
	</tr>
	<tr>
		<td colspan="2">20. Secondary Waste Storage facilities : </td>
	</tr>	
	<tr>
		<td>(a) No. and type of waste storage depots in the city/town </td>
		<td>
			<table class="table table-bordered table-responsive">
				<thead>
					<tr>
						<th>Sl No.</th>
						<th>Number </th>
						<th>Capacity in m3 </th>
					</tr>
				</thead>';
				$part1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t1 where form_id='$form_id'");
				$num = $part1->num_rows;
				if($num>0){
					while($row_1=$part1->fetch_array()){
						$printContents=$printContents.'
						<tr>  
							<td>'.strtoupper($row_1["sl_no"]).'</td>
							<td>'.strtoupper($row_1["number"]).'</td>
							<td>'.strtoupper($row_1["capacity"]).'</td>
						</tr>';
					}
				}else{
					$printContents=$printContents.'
					<tr>
						<td colspan="4">No records entered.</td>
					</tr>';
				}
				$printContents=$printContents.'
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<tr>
				<td width="50%">(b) Open waste storage sites </td>
				<td>'.strtoupper($storage_open).'</td>
			</tr>
			<tr>
				<td>(c) Masonry bins </td>
				<td>'.strtoupper($storage_masonry).'</td>
			</tr>
			<tr>
				<td>(d) Cement concrete cylinder bins </td>
				<td>'.strtoupper($storage_concrete).'</td>
			</tr>
			<tr>
				<td>(e) Dhalao/covered rooms/space </td>
				<td>'.strtoupper($storage_dhalao).'</td>
			</tr>
			<tr>
				<td>(f) Covered metal/plastic containers </td>
				<td>'.strtoupper($storage_metal).'</td>
			</tr>
			<tr>
				<td>(g) Upto 1.1 m3 bins </td>
				<td>'.strtoupper($storage_bins).'</td>
			</tr>
			<tr>
				<td>(h) 2 to 5 m3 bins </td>
				<td>'.strtoupper($storage_bins2).'</td>
			</tr>
			<tr>
				<td>(i) Above 5m3 containers </td>
				<td>'.strtoupper($storage_containers).'</td>
			</tr>
			<tr>
				<td>(j) Bin-less city </td>
				<td>'.strtoupper($storage_city).'</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td>21. Bin/population ratio : </td>
		<td>'.strtoupper($ratio).'</td>
	</tr>
	<tr>
		<td>22. Ward wise details of waste storage depots (Please attach) : </td>
		<td>'.strtoupper($ward_depots).'</td>
	</tr>
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<tr>
				<td width="25%">(a) Ward No </td>
				<td width="25%">'.strtoupper($ward_number).'</td>
				<td width="25%">(b) Area </td>
				<td width="25%">'.strtoupper($ward_area).'</td>
			</tr>
			<tr>
				<td>(c) Population </td>
				<td>'.strtoupper($ward_population).'</td>
				<td>(d) No. of bins placed </td>
				<td>'.strtoupper($ward_bins_no).'</td>
			</tr>
			<tr>
				<td colspan="2">(e) Total volume of bins placed </td>
				<td colspan="2">'.strtoupper($ward_bins_vol).'</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td>23. Total storage capacity of waste storage facilities in cubic meters </td>
		<td>'.strtoupper($total_storage).'</td>
	</tr>
	<tr>
		<td>24. Total waste actually stored at the waste storage depots daily </td>
		<td>'.strtoupper($total_waste).'</td>
	</tr>
	<tr>
		<td colspan="2">25. Give frequency of collection of waste from the depots : </td>
	</tr>
	<tr>
		<td>(a) Number of bins cleared </td>
		<td>
			<table class="table table-bordered table-responsive">
				<thead>
					<tr>
						<th width="25%">Frequency </th>
						<th width="25%">No. of bins </th>
					</tr>
				</thead>
				<tr>
					<td>Daily </td>
					<td>'.strtoupper($frequency_daily).'</td>
				</tr>
				<tr>
					<td>Alternate days </td>
					<td>'.strtoupper($frequency_days).'</td>
				</tr>
				<tr>
					<td>Twice a week </td>
					<td>'.strtoupper($frequency_twice).'</td>
				</tr>
				<tr>
					<td>Once a week </td>
					<td>'.strtoupper($frequency_once).'</td>
				</tr>
				<tr>
					<td>Occasionally </td>
					<td>'.strtoupper($frequency_occasion).'</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>(b) Whether storage depots have facility for storage of segregated waste in green, blue and black bins ? </td>
		<td>'.strtoupper($is_facility).'</td>
	</tr>';
	if($is_facility=="Yes"){
		$printContents=$printContents.'
		<tr>  
			<td>If yes, add details : </td>
			<td>No. of green bins : '.strtoupper($number_green).'<br/>No. of blue bins : '.strtoupper($number_blue).'<br/>No. of black bins : '.strtoupper($number_black).'</td>
		</tr>';
	}else{
		$is_facility=="No";
	}
	$printContents=$printContents.'
	<tr>
		<td colspan="2">26. Whether lifting of solid waste from storage depots is manual or mechanical. Give percentage : </td>
	</tr>
	<tr>
		<td>Percentage of Manual Lifting of solid waste (%) </td>
		<td>'.strtoupper($lifting_manual).'&nbsp;%</td>
	</tr>
	<tr>
		<td>Percentage of Mechanical lifting (%) </td>
		<td>'.strtoupper($lifting_mech).'&nbsp;%<br/><b>Specify the method used : </b>'.strtoupper($lifting_method).'</td>
	</tr>
	<tr>
		<td>27. Whether solid waste is lifted from door to door and transported to treatment plant directly in a segregated form ? <br/>If yes, specify </td>
		<td>'.strtoupper($lifting_transport).'<br/>'.strtoupper($lifting_specify).'</td>
	</tr>
	<tr>
		<td>28. Waste Transportation per day </td>
		<td>
			<table class="table table-bordered table-responsive">
				<thead>
					<tr>
						<th>Sl No. </th>
						<th>Waste transported </th>
						<th>Trips made </th>
					</tr>
				</thead>';
				$part2=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t2 where form_id='$form_id'");
				$num2 = $part2->num_rows;
				if($num2>0){
					while($row_1=$part2->fetch_array()){
						$printContents=$printContents.'
						<tr>  
							<td>'.strtoupper($row_1["sl_no"]).'</td>
							<td>'.strtoupper($row_1["waste"]).'</td>
							<td>'.strtoupper($row_1["trips"]).'</td>
						</tr>';
					}
				}else{
					$printContents=$printContents.'
					<tr>
						<td colspan="4">No records entered.</td>
					</tr>';
				}
				$printContents=$printContents.'
			</table>
		</td>
	</tr>
	<tr>
		<td>29. Type and Number of vehicles used </td>
		<td>
			<table class="table table-bordered table-responsive">
				<thead>
					<tr>
						<th width="25%">Type </th>
						<th width="25%">Number of vehicles </th>
					</tr>
				</thead>
				<tr>
					<td>Animal cart </td>
					<td>'.strtoupper($vehicles_animal).'</td>
				</tr>
				<tr>
					<td>Tractors </td>
					<td>'.strtoupper($vehicles_tractors).'</td>
				</tr>
				<tr>
					<td>Tipping Truck </td>
					<td>'.strtoupper($vehicles_tipping).'</td>
				</tr>
				<tr>
					<td>Non Tipping Truck </td>
					<td>'.strtoupper($vehicles_non_tipping).'</td>
				</tr>
				<tr>
					<td>Dumper Placers </td>
					<td>'.strtoupper($vehicles_dumper).'</td>
				</tr>
				<tr>
					<td>Refuse collectors </td>
					<td>'.strtoupper($vehicles_refuse).'</td>
				</tr>
				<tr>
					<td>Compactors </td>
					<td>'.strtoupper($vehicles_compactors).'</td>
				</tr>
				<tr>
					<td>Others </td>
					<td>'.strtoupper($vehicles_others).'</td>
				</tr>
				<tr>
					<td>JCB/loader </td>
					<td>'.strtoupper($vehicles_jcb).'</td>
				</tr>
			</table>
		</td>
	</tr>	
	<tr>
		<td>30. (a) Frequency of transportation of waste </td>
		<td>
			<table class="table table-bordered table-responsive">
				<thead>
					<tr>
						<th width="25%">Frequency </th>
						<th width="25%">(%) of waste transported </th>
					</tr>
				</thead>
				<tr>
					<td>Daily </td>
					<td>'.strtoupper($transport_daily).'</td>
				</tr>
				<tr>
					<td>Alternate days </td>
					<td>'.strtoupper($transport_days).'</td>
				</tr>
				<tr>
					<td>Twice a week </td>
					<td>'.strtoupper($transport_twice).'</td>
				</tr>
				<tr>
					<td>Once a week </td>
					<td>'.strtoupper($transport_once).'</td>
				</tr>
				<tr>
					<td>Occasionally </td>
					<td>'.strtoupper($transport_occasion).'</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>(b) Quantity of waste transported each day </td>
		<td>'.strtoupper($transport_qty).'&nbsp;/tpd</td>
	</tr>
	<tr>
		<td>(c) Percentage of total waste transported daily (%) </td>
		<td>'.strtoupper($transport_percent).'&nbsp;%</td>
	</tr>
	<tr>
		<td>31. Waste Treatment Technologies used </td>
		<td>'.strtoupper($waste_treatment).'</td>
	</tr>
	<tr>
		<td>32. Whether solid waste is processed ? <br/>If yes, Quantity of waste processed daily </td>
		<td>'.strtoupper($waste_process).'<br/>'.strtoupper($waste_process_qty).'</td>
	</tr>
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<tr>
				<td width="50%">33. (a) Land(s) available with the local body for waste processing (in Hectares) </td>
				<td>'.strtoupper($process_available).'&nbsp;hectares</td>
			</tr>
			<tr>
				<td>(b) Land currently utilized for waste processing </td>
				<td>'.strtoupper($process_utilized).'</td>
			</tr>
			<tr>
				<td>(c) Solid waste processing facilities in operation </td>
				<td>'.strtoupper($process_operation).'</td>
			</tr>
			<tr>
				<td>(d) Solid waste processing facilities under construction </td>
				<td>'.strtoupper($process_construction).'</td>
			</tr>
			<tr>
				<td>(e) Distance of processing facilities from city/town boundary </td>
				<td>'.strtoupper($process_distance).'</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td colspan="2">34. Details of technologies adopted : </td>					
	</tr>
	<tr>
		<td><strong>(a) Composting : </strong></td>
		<td>
			<table class="table table-bordered table-responsive">
				<tr>
					<td width="25%">Quantity raw material processed </td>
					<td>'.strtoupper($compost_raw).'</td>
				</tr>
				<tr>
					<td>Quantity final product produced </td>
					<td>'.strtoupper($compost_product).'</td>
				</tr>
				<tr>
					<td>Quantity sold </td>
					<td>'.strtoupper($compost_sold).'</td>
				</tr>
				<tr>
					<td>Quantity of residual waste landfilled </td>
					<td>'.strtoupper($compost_residual).'</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td><strong>(b) Vermi Composting : </strong></td>
		<td>
			<table class="table table-bordered table-responsive">
				<tr>
					<td width="25%">Quantity raw material processed </td>
					<td>'.strtoupper($vermi_raw).'</td>
				</tr>
				<tr>
					<td>Quantity final product produced </td>
					<td>'.strtoupper($vermi_product).'</td>
				</tr>
				<tr>
					<td>Quantity sold </td>
					<td>'.strtoupper($vermi_sold).'</td>
				</tr>
				<tr>
					<td>Quantity of residual waste landfilled </td>
					<td>'.strtoupper($vermi_residual).'</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td><strong>(c) Bio-methanation : </strong></td>
		<td>
			<table class="table table-bordered table-responsive">
				<tr>
					<td width="25%">Quantity raw material processed </td>
					<td>'.strtoupper($bio_raw).'</td>
				</tr>
				<tr>
					<td>Quantity final product produced </td>
					<td>'.strtoupper($bio_product).'</td>
				</tr>
				<tr>
					<td>Quantity sold </td>
					<td>'.strtoupper($bio_sold).'</td>
				</tr>
				<tr>
					<td>Quantity of residual waste landfilled </td>
					<td>'.strtoupper($bio_residual).'</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td><strong>(d) Refuse Derived Fuel : </strong></td>
		<td>
			<table class="table table-bordered table-responsive">
				<tr>
					<td width="25%">Quantity raw material processed </td>
					<td>'.strtoupper($fuel_raw).'</td>
				</tr>
				<tr>
					<td>Quantity final product produced </td>
					<td>'.strtoupper($fuel_product).'</td>
				</tr>
				<tr>
					<td>Quantity sold </td>
					<td>'.strtoupper($fuel_sold).'</td>
				</tr>
				<tr>
					<td>Quantity of residual waste landfilled </td>
					<td>'.strtoupper($fuel_residual).'</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td><strong>(e) Waste to Energy technology such as incineration, gasification, pyrolysis or any other technology (Give details) : </strong></td>
		<td>
			<table class="table table-bordered table-responsive">
				<tr>
					<td width="25%">Quantity raw material processed </td>
					<td>'.strtoupper($energy_raw).'</td>
				</tr>
				<tr>
					<td>Quantity final product produced </td>
					<td>'.strtoupper($energy_product).'</td>
				</tr>
				<tr>
					<td>Quantity sold </td>
					<td>'.strtoupper($energy_sold).'</td>
				</tr>
				<tr>
					<td>Quantity of residual waste landfilled </td>
					<td>'.strtoupper($energy_residual).'</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td><strong>(f) Co-processing : </strong></td>
		<td>
			<table class="table table-bordered table-responsive">
				<tr>
					<td width="25%">Quantity raw material processed </td>
					<td>'.strtoupper($co_process_raw).'</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>35. (a) Combustible waste supplied to cement plant </td>
		<td>'.strtoupper($combustible_cement).'</td>
	</tr>
	<tr>
		<td>(b) Combustible waste supplied to solid waste based power plants </td>
		<td>'.strtoupper($combustible_power).'</td>
	</tr>
	<tr>
		<td>36. (a) Solid waste disposal facilities </td>
		<td>'.strtoupper($others_a).'</td>
	</tr>
	<tr>
		<td>(b) No. of dumpsites sites available with the local body </td>
		<td>'.strtoupper($others_b).'</td>
	</tr>
	<tr>
		<td>(c) No. of sanitary landfill sites available with the local body </td>
		<td>'.strtoupper($others_c).'</td>
	</tr>
	<tr>
		<td>(d) Area of each such sites available for waste disposal </td>
		<td>'.strtoupper($others_d).'</td>
	</tr>
	<tr>
		<td>(e) Area of land currently used for waste disposal </td>
		<td>'.strtoupper($others_e).'</td>
	</tr>
	<tr>
		<td>(f) Distance of dumpsite/landfill facility from city/town kms </td>
		<td>'.strtoupper($others_f).'&nbsp;kms</td>
	</tr>
	<tr>
		<td>(g) Distance from the nearest habitation kms </td>
		<td>'.strtoupper($others_g).'&nbsp;kms</td>
	</tr>
	<tr>
		<td>(h) Distance from water body </td>
		<td>'.strtoupper($others_h).'&nbsp;kms</td>
	</tr>
	<tr>
		<td>(i) Distance from state/national highway : </td>
		<td>'.strtoupper($others_i).'&nbsp;kms</td>	
	</tr>
	<tr>
		<td>(j) Distance from Airport : </td>
		<td>'.strtoupper($others_j).'&nbsp;kms</td>
	</tr>
	<tr>
		<td>(k) Distance from important religious places or historical monument : </td>
		<td>'.strtoupper($others_k).'&nbsp;kms</td>
	</tr>
	<tr>
		<td>(l) Whether it falls in flood prone area ? </td>
		<td>'.strtoupper($others_l).'</td>
	</tr>
	<tr>
		<td>(m) Whether it falls in earthquake fault line area ? </td>
		<td>'.strtoupper($others_m).'</td>
	</tr>
	<tr>
		<td>(n) Quantity of waste landfilled each day </td>
		<td>'.strtoupper($others_n).'&nbsp;/tpd</td>
	</tr>
	<tr>
		<td>(o) Whether landfill site is fenced ? </td>
		<td>'.strtoupper($others_o).'</td>
	</tr>
	<tr>
		<td>(p) Whether Lighting facility is available on site ? </td>
		<td>'.strtoupper($others_p).'</td>
	</tr>
	<tr>
		<td>(q) Whether Weigh bridge facility available ? </td>
		<td>'.strtoupper($others_q).'</td>
	</tr>
	<tr>
		<td>(r) Vehicles and equipments used at landfill (Specify - Bulldozer, Compacters etc. available) ? </td>
		<td>'.strtoupper($others_r).'</td>
	</tr>
	<tr>
		<td>(s) Whether manpower deployed at landfill site ? <br/>If yes, attach details </td>
		<td>'.strtoupper($others_s).'<br/>'.strtoupper($others_s_details).'</td>
	</tr>
	<tr>
		<td>(t) Whether covering is done on daily basis ? <br/>If not, Frequency of covering the waste deposited at the landfill </td>
		<td>'.strtoupper($others_t).'<br/>'.strtoupper($others_t_details).'</td>
	</tr>
	<tr>
		<td>(u) Cover material used </td>
		<td>'.strtoupper($others_u).'</td>
	</tr>
	<tr>
		<td>(v) Whether adequate covering material is available ? </td>
		<td>'.strtoupper($others_v).'</td>
	</tr>
	<tr>
		<td>(w) Whether provisions for gas venting provided ? <br/>If yes, attach technical data sheet </td>
		<td>'.strtoupper($others_w).'</td>
	</tr>
	<tr>
		<td>(x) Whether provision for leachate collection ? <br/>If yes, attach technical data sheet </td>
		<td>'.strtoupper($others_x).'</td>
	</tr>
	<tr>
		<td>37. Whether an Action Plan has been prepared for improving solid waste management practices in the city ? <br/>If yes, attach Action Plan details </td>
		<td>'.strtoupper($action_plan).'</td>
	</tr>
	<tr>
		<td>38. What separate provisions are made for : <br/>(Attach details on Proposals, Steps taken) </td>
		<td><b>(a) Dairy related activities : </b>'.strtoupper($provisions_dairy).'<br/>
		<b>(b) Slaughter houses waste : </b>'.strtoupper($provisions_slaughter).'<br/>
		<b>(c) C&D waste (construction debris) : </b>'.strtoupper($provisions_debris).'</td>
	</tr>
	<tr>
		<td>39. Details of Post Closure Plan </td>
		<td>Attach Plan</td>
	</tr>
	<tr>
		<td>40. How many slums are identified and whether these are provided with Solid Waste Management facilities ? <br/>If yes, attach details</td>
		<td>'.strtoupper($slums).'</td>
	</tr>
	<tr>
		<td>41. Give details of manpower deployed for collection including street sweeping, secondary storage, transportation, processing and disposal of waste </td>
		<td>'.strtoupper($manpower).'</td>
	</tr>
	<tr>
		<td>42. Mention briefly, the difficulties being experienced by the local body in complying with provisions of these rules </td>
		<td>'.strtoupper($difficulties).'</td>
	</tr>
	<tr>
		<td>43. Mention briefly, if any innovative idea is implemented to tackle a problem related to solid waste, which could be replicated by other local bodies </td>
		<td>'.strtoupper($innovative).'</td>
	</tr>';
	
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'
		
	<tr>								
		<td align="left"> Date : <strong> '.date('d-m-Y',strtotime($results["sub_date"])).'</strong><br/>
		Place : <strong>'.strtoupper($dist).'</strong></td>
		<td align="right">Signature of Operator : <strong>'.strtoupper($key_person).'</strong></td>
	</tr>
</table>';
?>