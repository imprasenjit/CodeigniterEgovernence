<?php  require_once "../../requires/login_session.php";
$dept="pcb";
$form="80";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);	
include "save_form_new.php";

$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
if($q->num_rows<1){	 
	$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
	if($p->num_rows>0){
		$results=$p->fetch_assoc();
		$form_id=$results['form_id'];
		// Tab 1 //
		$city_name=$results['city_name'];$state_name=$results['state_name'];$population=$results['population'];$area=$results['area'];
		if(!empty($results["local"])){
			$local=json_decode($results["local"]);
			$local_name=$local->name;$local_sn1=$local->sn1;$local_sn2=$local->sn2;$local_vill=$local->vill;$local_dist=$local->dist;$local_pin=$local->pin;$local_mobile=$local->mobile;$local_tel=$local->tel;$local_fax=$local->fax;$local_email=$local->email;
		}else{				
			$local_name="";$local_sn1="";$local_sn2="";$local_vill="";$local_dist="";$local_pin="";$local_mobile="";$local_tel="";$local_fax="";$local_email="";
		}
		if(!empty($results["officer"])){
			$officer=json_decode($results["officer"]);
			$officer_name=$officer->name;$officer_phone=$officer->phone;$officer_fax=$officer->fax;$officer_email=$officer->email;
		}else{				
			$officer_name="";$officer_phone="";$officer_fax="";$officer_email="";
		}    
		if(!empty($results["no"])){
			$no=json_decode($results["no"]);
			$no_household=$no->household;$no_premise=$no->premise;$no_election=$no->election;
		}else{				
			$no_household="";$no_premise="";$no_election="";
		}
		if(!empty($results["quantity"])){
			$quantity=json_decode($results["quantity"]);
			$quantity_generate=$quantity->generate;$quantity_collect=$quantity->collect;$quantity_capita=$quantity->capita;$quantity_process=$quantity->process;$quantity_dispose=$quantity->dispose;
		}else{				
			$quantity_generate="";$quantity_collect="";$quantity_capita="";$quantity_process="";$quantity_dispose="";
		}	
		// Tab 2 //		
		$source=$results['source'];$is_stored=$results['is_stored'];$is_segregated=$results['is_segregated'];$is_segregated_details=$results['is_segregated_details'];$is_d2d=$results['is_d2d'];$length=$results['length'];			
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
		// Tab 3 //
		$ratio=$results['ratio'];$total_storage=$results['total_storage'];$total_waste=$results['total_waste'];
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
		if(!empty($results["ward"])){
			$ward=json_decode($results["ward"]);
			$ward_depots=$ward->depots;$ward_number=$ward->number;$ward_area=$ward->area;$ward_population=$ward->population;$ward_bins_no=$ward->bins_no;$ward_bins_vol=$ward->bins_vol;
		}else{				
			$ward_depots="";$ward_number="";$ward_area="";$ward_population="";$ward_bins_no="";$ward_bins_vol="";
		}
		// Tab 4 //
		$is_facility=$results['is_facility'];
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
		if(!empty($results["vehicles"])){
			$vehicles=json_decode($results["vehicles"]);
			$vehicles_animal=$vehicles->animal;$vehicles_tractors=$vehicles->tractors;$vehicles_tipping=$vehicles->tipping;$vehicles_non_tipping=$vehicles->non_tipping;$vehicles_dumper=$vehicles->dumper;$vehicles_refuse=$vehicles->refuse;$vehicles_compactors=$vehicles->compactors;$vehicles_others=$vehicles->others;$vehicles_jcb=$vehicles->jcb;
		}else{				
			$vehicles_animal="";$vehicles_tractors="";$vehicles_tipping="";$vehicles_non_tipping="";$vehicles_dumper="";$vehicles_refuse="";$vehicles_compactors="";$vehicles_others="";$vehicles_jcb="";
		}
		// Tab 5 //  
		$waste_treatment=$results['waste_treatment'];$waste_process=$results['waste_process'];$waste_process_qty=$results['waste_process_qty'];$co_process_raw=$results['co_process_raw'];$treatment_by=$results['treatment_by'];
		if(!empty($results["transport"])){
			$transport=json_decode($results["transport"]);
			$transport_daily=$transport->daily;$transport_days=$transport->days;$transport_twice=$transport->twice;$transport_once=$transport->once;$transport_occasion=$transport->occasion;$transport_qty=$transport->qty;$transport_percent=$transport->percent;
		}else{				
			$transport_daily="";$transport_days="";$transport_twice="";$transport_once="";$transport_occasion="";$transport_qty="";$transport_percent="";
		}		
		if(!empty($results["process"])){
			$process=json_decode($results["process"]);
			$process_available=$process->available;$process_utilized=$process->utilized;$process_operation=$process->operation;$process_construction=$process->construction;$process_distance=$process->distance;
		}else{				
			$process_available="";$process_utilized="";$process_operation="";$process_construction="";$process_distance="";
		}		
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
		// Tab 6 //
		$others_s_details=$results['others_s_details'];$others_t_details=$results['others_t_details'];$action_plan=$results['action_plan'];$slums=$results['slums'];$manpower=$results['manpower'];$difficulties=$results['difficulties'];$innovative=$results['innovative'];
		if(!empty($results["combustible"])){
			$combustible=json_decode($results["combustible"]);
			$combustible_cement=$combustible->cement;$combustible_power=$combustible->power;
		}else{				
			$combustible_cement="";$combustible_power="";
		}
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
	}else{
		$form_id="";
		// Tab 1 //
		$city_name="";$state_name="";$population="";$area="";
		$local_name="";$local_sn1="";$local_sn2="";$local_vill="";$local_dist="";$local_pin="";$local_mobile="";$local_tel="";$local_fax="";$local_email="";
		$officer_name="";$officer_phone="";$officer_fax="";$officer_email="";
		$no_household="";$no_premise="";$no_election="";
		$quantity_generate="";$quantity_collect="";$quantity_capita="";$quantity_process="";$quantity_dispose="";
		// Tab 2 //
		$source="";$is_stored="";$is_segregated="";$is_segregated_details="";$is_d2d="";$length="";
		$bins_domestic="";$bins_commercial="";$bins_households="";$bins_premises="";
		$d2d_ward="";$d2d_households="";$d2d_premises="";$d2d_vehicle="";$d2d_handcart="";$d2d_other="";$d2d_method="";$d2d_sweep="";
		// Tab 3 //
		$ratio="";$total_storage="";$total_waste="";
		$percent_daily="";$percent_days="";$percent_week="";$percent_occasion="";
		$tools_used="";$tools_manual="";$tools_mech="";$tools_broom="";$tools_handcart="";$tools_tricycle="";$tools_collect="";
		$storage_open="";$storage_masonry="";$storage_concrete="";$storage_dhalao="";$storage_metal="";$storage_bins="";$storage_bins2="";$storage_containers="";$storage_city="";
		$ward_depots="";$ward_number="";$ward_area="";$ward_population="";$ward_bins_no="";$ward_bins_vol="";
		// Tab 4 //
		$is_facility="";
		$frequency_daily="";$frequency_days="";$frequency_twice="";$frequency_once="";$frequency_occasion="";
		$number_green="";$number_blue="";$number_black="";
		$lifting_manual="";$lifting_mech="";$lifting_method="";$lifting_transport="";$lifting_specify="";
		$vehicles_animal="";$vehicles_tractors="";$vehicles_tipping="";$vehicles_non_tipping="";$vehicles_dumper="";$vehicles_refuse="";$vehicles_compactors="";$vehicles_others="";$vehicles_jcb="";
		// Tab 5 //
		$waste_treatment="";$waste_process="";$waste_process_qty="";$co_process_raw="";$treatment_by="";
		$transport_daily="";$transport_days="";$transport_twice="";$transport_once="";$transport_occasion="";$transport_qty="";$transport_percent="";
		$process_available="";$process_utilized="";$process_operation="";$process_construction="";$process_distance="";
		$compost_raw="";$compost_product="";$compost_sold="";$compost_residual="";
		$vermi_raw="";$vermi_product="";$vermi_sold="";$vermi_residual="";
		$bio_raw="";$bio_product="";$bio_sold="";$bio_residual="";
		$fuel_raw="";$fuel_product="";$fuel_sold="";$fuel_residual="";
		$energy_raw="";$energy_product="";$energy_sold="";$energy_residual="";
		// Tab 6 //
		$others_s_details="";$others_t_details="";$action_plan="";$slums="";$manpower="";$difficulties="";$innovative="";
		$combustible_cement="";$combustible_power="";
		$others_a="";$others_b="";$others_c="";$others_d="";$others_e="";$others_f="";$others_g="";$others_h="";$others_i="";$others_j="";$others_k="";$others_l="";$others_m="";$others_n="";$others_o="";$others_p="";$others_q="";$others_r="";$others_s="";$others_t="";$others_u="";$others_v="";$others_w="";$others_x="";
		$provisions_dairy="";$provisions_debris="";$provisions_slaughter="";
	}
}else{
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
	if(!empty($results["officer"])){
		$officer=json_decode($results["officer"]);
		$officer_name=$officer->name;$officer_phone=$officer->phone;$officer_fax=$officer->fax;$officer_email=$officer->email;
	}else{				
		$officer_name="";$officer_phone="";$officer_fax="";$officer_email="";
	}    
	if(!empty($results["no"])){
		$no=json_decode($results["no"]);
		$no_household=$no->household;$no_premise=$no->premise;$no_election=$no->election;
	}else{				
		$no_household="";$no_premise="";$no_election="";
	}
	if(!empty($results["quantity"])){
		$quantity=json_decode($results["quantity"]);
		$quantity_generate=$quantity->generate;$quantity_collect=$quantity->collect;$quantity_capita=$quantity->capita;$quantity_process=$quantity->process;$quantity_dispose=$quantity->dispose;
	}else{				
		$quantity_generate="";$quantity_collect="";$quantity_capita="";$quantity_process="";$quantity_dispose="";
	}	
	// Tab 2 //		
	$source=$results['source'];$is_stored=$results['is_stored'];$is_segregated=$results['is_segregated'];$is_segregated_details=$results['is_segregated_details'];$is_d2d=$results['is_d2d'];$length=$results['length'];			
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
	// Tab 3 //
	$ratio=$results['ratio'];$total_storage=$results['total_storage'];$total_waste=$results['total_waste'];
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
	if(!empty($results["ward"])){
		$ward=json_decode($results["ward"]);
		$ward_depots=$ward->depots;$ward_number=$ward->number;$ward_area=$ward->area;$ward_population=$ward->population;$ward_bins_no=$ward->bins_no;$ward_bins_vol=$ward->bins_vol;
	}else{				
		$ward_depots="";$ward_number="";$ward_area="";$ward_population="";$ward_bins_no="";$ward_bins_vol="";
	}
	// Tab 4 //
	$is_facility=$results['is_facility'];
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
	if(!empty($results["vehicles"])){
		$vehicles=json_decode($results["vehicles"]);
		$vehicles_animal=$vehicles->animal;$vehicles_tractors=$vehicles->tractors;$vehicles_tipping=$vehicles->tipping;$vehicles_non_tipping=$vehicles->non_tipping;$vehicles_dumper=$vehicles->dumper;$vehicles_refuse=$vehicles->refuse;$vehicles_compactors=$vehicles->compactors;$vehicles_others=$vehicles->others;$vehicles_jcb=$vehicles->jcb;
	}else{				
		$vehicles_animal="";$vehicles_tractors="";$vehicles_tipping="";$vehicles_non_tipping="";$vehicles_dumper="";$vehicles_refuse="";$vehicles_compactors="";$vehicles_others="";$vehicles_jcb="";
	}
	// Tab 5 //  
	$waste_treatment=$results['waste_treatment'];$waste_process=$results['waste_process'];$waste_process_qty=$results['waste_process_qty'];$co_process_raw=$results['co_process_raw'];$treatment_by=$results['treatment_by'];
	if(!empty($results["transport"])){
		$transport=json_decode($results["transport"]);
		$transport_daily=$transport->daily;$transport_days=$transport->days;$transport_twice=$transport->twice;$transport_once=$transport->once;$transport_occasion=$transport->occasion;$transport_qty=$transport->qty;$transport_percent=$transport->percent;
	}else{				
		$transport_daily="";$transport_days="";$transport_twice="";$transport_once="";$transport_occasion="";$transport_qty="";$transport_percent="";
	}		
	if(!empty($results["process"])){
		$process=json_decode($results["process"]);
		$process_available=$process->available;$process_utilized=$process->utilized;$process_operation=$process->operation;$process_construction=$process->construction;$process_distance=$process->distance;
	}else{				
		$process_available="";$process_utilized="";$process_operation="";$process_construction="";$process_distance="";
	}		
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
	// Tab 6 //
	$others_s_details=$results['others_s_details'];$others_t_details=$results['others_t_details'];$action_plan=$results['action_plan'];$slums=$results['slums'];$manpower=$results['manpower'];$difficulties=$results['difficulties'];$innovative=$results['innovative'];
	if(!empty($results["combustible"])){
		$combustible=json_decode($results["combustible"]);
		$combustible_cement=$combustible->cement;$combustible_power=$combustible->power;
	}else{				
		$combustible_cement="";$combustible_power="";
	}
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
}

    ##PHP TAB management
	$showtab = isset($_GET['tab']) ? $_GET['tab'] : "";

	$tabbtn1 = "";
	$tabbtn2 = "";
	$tabbtn3 = "";
	$tabbtn4 = "";
	$tabbtn5 = "";
	$tabbtn6 = "";
	
	if ($showtab == "" || $showtab < 2 || $showtab > 8 || is_numeric($showtab) == false) {
		$tabbtn1 = "active";
		$tabbtn2 = "";
		$tabbtn3 = "";
		$tabbtn4 = "";
		$tabbtn5 = "";
		$tabbtn6 = "";
	}
	if ($showtab == 2) {
		$tabbtn1 = "";
		$tabbtn2 = "active";
		$tabbtn3 = "";
		$tabbtn4 = "";
		$tabbtn5 = "";
		$tabbtn6 = "";
	}
	if ($showtab == 3) {
		$tabbtn1 = "";
		$tabbtn2 = "";
		$tabbtn3 = "active";
		$tabbtn4 = "";
		$tabbtn5 = "";
		$tabbtn6 = "";
	}
	if ($showtab == 4) {
		$tabbtn1 = "";
		$tabbtn2 = "";
		$tabbtn3 = "";
		$tabbtn4 = "active";
		$tabbtn5 = "";
		$tabbtn6 = "";
	}
	if ($showtab == 5) {
		$tabbtn1 = "";
		$tabbtn2 = "";
		$tabbtn3 = "";
		$tabbtn4 = "";
		$tabbtn5 = "active";
		$tabbtn6 = "";
	}
	if ($showtab == 6) {
		$tabbtn1 = "";
		$tabbtn2 = "";
		$tabbtn3 = "";
		$tabbtn4 = "";
		$tabbtn5 = "";
		$tabbtn6 = "active";
	}
	##PHP TAB management ends
?>

<?php require_once "../../requires/header.php";   ?>
  <?php include ("".$table_name."_addmore.php"); ?>
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<section class="content-header"></section>
		<section class="content">
			<?php require '../../requires/banner.php'; ?>
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h4 class="text-center text-bold" >
								<?php echo $form_name=$formFunctions->get_formName($dept,$form);?>
							</h4>	
						</div>
						<div class="panel-body">
							<ul class="nav nav-pills">
								<li class="<?php echo $tabbtn1; ?>"><a href="#table1">Part 1</a></li>
								<li class="<?php echo $tabbtn2; ?>"><a href="#table2">Part 2</a></li>
								<li class="<?php echo $tabbtn3; ?>"><a href="#table3">Part 3</a></li>
								<li class="<?php echo $tabbtn4; ?>"><a href="#table4">Part 4</a></li>
								<li class="<?php echo $tabbtn5; ?>"><a href="#table5">Part 5</a></li>
								<li class="<?php echo $tabbtn6; ?>"><a href="#table6">Part 6</a></li>
							</ul>
							<br>
							<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
									<form name="myform1" id="myform1" class="submit1" method="post" compliance="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
										<table id="" class="table table-responsive">
											<tr>
												<td width="25%">1. Name of the City/Town : </td>
												<td width="25%"><input type="text" class="form-control text-uppercase" name="city_name" value="<?php echo $city_name; ?>"></td>
												<td width="25%">2. Name of the State : </td>
												<td width="25%"><input type="text" class="form-control text-uppercase" name="state_name" value="<?php echo $state_name; ?>"></td>
											</tr>
											<tr>
												<td>3. Population : </td>
												<td><input type="text" class="form-control text-uppercase" name="population" value="<?php echo $population; ?>"></td>
												<td>4. Area in sq. kilometers : </td>
												<td><input type="text" class="form-control text-uppercase" name="area" value="<?php echo $area; ?>" placeholder="sq.kilometers" validate="decimal"></td>
											</tr>	
											<tr>
												<td>5. Name of the local body :</td>
												<td><input type="text" class="form-control text-uppercase" name="local[name]" value="<?php echo $local_name; ?>"></td>
												<td colspan="2"></td>
											</tr>
											<tr>
												<td colspan="4">6. Address of the local body : </td>								
											</tr>
											<tr>
												<td width="25%">Street Name1 :</td>
												<td width="25%"><input type="text" class="form-control text-uppercase" name="local[sn1]" value="<?php echo $local_sn1; ?>"></td>
												<td width="25%">Street Name2 :</td>
												<td width="25%"><input type="text" class="form-control text-uppercase" name="local[sn2]" value="<?php echo $local_sn2; ?>"></td>
											</tr>
											<tr>
												<td>Village/Town :</td>
												<td><input type="text" class="form-control text-uppercase" name="local[vill]" value="<?php echo $local_vill; ?>"></td>
												<td>District :</td>
												<td><input type="text" class="form-control text-uppercase" name="local[dist]" value="<?php echo $local_dist; ?>"></td>
											</tr>
											<tr>
												<td>Pin Code :</td>
												<td><input type="text" class="form-control text-uppercase" name="local[pin]" validate="pincode" maxlength="6" value="<?php echo $local_pin; ?>" ></td>
												<td>Mobile No. :</td>
												<td><input type="text" class="form-control text-uppercase" name="local[mobile]" validate="mobileNumber" maxlength="10" value="<?php echo $local_mobile; ?>" ></td>
											</tr>
											<tr>
												<td>Telephone No. : </td>
												<td><input type="text" class="form-control text-uppercase" name="local[tel]" value="<?php echo $local_tel; ?>" ></td>
												<td>Fax No. :</td>
												<td><input type="text" class="form-control text-uppercase" name="local[fax]" value="<?php echo $local_fax; ?>" ></td>
											</tr>
											<tr>
												<td>Email Id : </td>
												<td><input type="email" class="form-control" name="local[email]" value="<?php echo $local_email;?>" validate="email" ></td>
												<td colspan="2"></td>
											</tr>
											<tr>
												<td>7. Name of officer in-charge dealing with solid waste management (SOLID WASTEM) :</td>
												<td><input type="text" class="form-control text-uppercase" name="officer[name]" value="<?php echo $officer_name; ?>"></td>
												<td colspan="2"></td>
											</tr>
											<tr>
												<td colspan="4">8. Details of officer in-charge dealing with solid waste management (SOLID WASTEM) : </td>		
											</tr>
											<tr>
												<td>Phone No. : </td>
												<td><input type="text" class="form-control text-uppercase" name="officer[phone]" value="<?php echo $officer_phone; ?>" ></td>
												<td>Fax No. :</td>
												<td><input type="text" class="form-control text-uppercase" name="officer[fax]" value="<?php echo $officer_fax; ?>" ></td>
											</tr>
											<tr>
												<td>Email Id : </td>
												<td><input type="email" class="form-control" name="officer[email]" value="<?php echo $officer_email;?>" validate="email" ></td>
												<td colspan="2"></td>
											</tr>
											<tr>
												<td>9. (a) Number of households in the city/town : </td>
												<td><input type="text" class="form-control text-uppercase" name="no[household]" value="<?php echo $no_household; ?>"></td>
												<td>(b) Number of non-residential premises in the city : </td>
												<td><input type="text" class="form-control text-uppercase" name="no[premise]" value="<?php echo $no_premise; ?>"></td>
											</tr>
											<tr>
												<td colspan="2">(c) Number of election/ administrative wards in the city/town : </td>
												<td><input type="text" class="form-control text-uppercase" name="no[election]" value="<?php echo $no_election; ?>"></td>
												<td></td>
											</tr>
											<tr>
												<td colspan="4">10. Quantity of Solid waste (solid waste) : </td>
											</tr>
											<tr>
												<td>(a) Estimated Quantity of solid waste generated in the local body area per day in metric tones : </td>
												<td><input type="text" class="form-control text-uppercase" name="quantity[generate]" value="<?php echo $quantity_generate;?>" placeholder="/tpd"></td>
												<td>(b) Quantity of solid waste collected per day : </td>
												<td><input type="text" class="form-control text-uppercase" name="quantity[collect]" value="<?php echo $quantity_collect;?>" placeholder="/tpd"></td>
											</tr>
											<tr>
												<td>(c) Per capita waste collected per day : </td>
												<td><input type="text" class="form-control text-uppercase" name="quantity[capita]" value="<?php echo $quantity_capita;?>" placeholder="/gm/day"></td>
												<td>(d) Quantity of solid waste processed : </td>
												<td><input type="text" class="form-control text-uppercase" name="quantity[process]" value="<?php echo $quantity_process;?>" placeholder="/tpd"></td>
											</tr>
											<tr>
												<td colspan="2">(e) Quantity of solid waste disposed at dumpsite/landfill : </td>
												<td><input type="text" class="form-control text-uppercase" name="quantity[dispose]" value="<?php echo $quantity_dispose;?>" placeholder="/tpd"></td>
												<td></td>
											</tr>
											<tr>												
												<td class="text-center" colspan="4">
													<button type="submit" name="save<?php echo $form;?>a" class="btn btn-success text-bold submit1">Save and Next</button>
												</td>												
											</tr>
										</table>
									</form>
								</div>
								<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
									<form name="myform1" class="myform1 submit1" method="post"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
										<table class="table table-responsive table-bordered">
											<tr>
												<td colspan="4">11. Status of Solid Waste Management service : </td>
											</tr>
											<tr>
												<td width="25%">(a) Segregation and storage of waste at source : </td>
												<td width="25%"><input type="text" class="form-control text-uppercase" name="source" value="<?php echo $source;?>"></td>
												<td width="25%"></td>
												<td width="25%"></td>
											</tr>
											<tr>
												<td colspan="2">(b) Whether solid waste is stored at source in domestic/commercial/institutional bins ? <span class="mandatory_field">*</span></td>
												<td colspan="2">
													<label class="radio-inline"><input type="radio" name="is_stored" class="is_stored" value="Y" <?php if(isset($is_stored) && $is_stored=='Y') echo 'checked'; ?> /> Yes </label>
													<label class="radio-inline"><input type="radio" class="is_stored"  value="N"  name="is_stored" <?php if(isset($is_stored) && ($is_stored=='N' || $is_stored=='')) echo 'checked'; ?>/> No </label>
												</td>												
											</tr>
											<tr>
												<td>If yes, <br/>(i) Percentage of households practice storage of waste at source in domestic bins : </td>	
												<td><input type="text" name="bins[domestic]" id="bins_domestic" class="form-control text-uppercase" value="<?php echo $bins_domestic;?>" placeholder="%"></td>
												<td>(ii) Percentage of non-residential premises practice storage of waste at source in commercial/institutional bins : </td>	
												<td><input type="text" name="bins[commercial]" id="bins_commercial" class="form-control text-uppercase" value="<?php echo $bins_commercial;?>" placeholder="%"></td>
											</tr>
											<tr>
												<td>(iii) Percentage of households dispose of throw solid waste on the streets : </td>	
												<td><input type="text" name="bins[households]" id="bins_households" class="form-control text-uppercase" value="<?php echo $bins_households;?>" placeholder="%"></td>
												<td>(iv) Percentage of non-residential premises dispose of throw solid waste on the streets : </td>	
												<td><input type="text" name="bins[premises]" id="bins_premises" class="form-control text-uppercase" value="<?php echo $bins_premises;?>" placeholder="%"></td>
											</tr>
											<tr>
												<td>(c) Whether solid waste is stored at source in a segregated form ? <span class="mandatory_field">*</span></td>
												<td>
													<label class="radio-inline"><input type="radio" name="is_segregated" class="is_segregated" value="Y" <?php if(isset($is_segregated) && $is_segregated=='Y') echo 'checked'; ?> /> Yes </label>
													<label class="radio-inline"><input type="radio" class="is_segregated"  value="N"  name="is_segregated" <?php if(isset($is_segregated) && ($is_segregated=='N' || $is_segregated=='')) echo 'checked'; ?>/> No </label>
												</td>
												<td>If yes, Percentage of premises segregating the waste at source : </td>	
												<td><input type="text" name="is_segregated_details" id="is_segregated_details" class="form-control text-uppercase" value="<?php echo $is_segregated_details; ?>"></td>
											</tr>
											<tr>
												<td colspan="4">12. Door to Door Collection of solid waste : </td>
											</tr>
											<tr>
												<td colspan="2">(a) Whether door to door collection (D2D) of solid waste is being done in the city/town ? <span class="mandatory_field">*</span></td>
												<td colspan="2">
													<label class="radio-inline"><input type="radio" name="is_d2d" class="is_d2d" value="Y" <?php if(isset($is_d2d) && $is_d2d=='Y') echo 'checked'; ?> /> Yes </label>
													<label class="radio-inline"><input type="radio" class="is_d2d"  value="N"  name="is_d2d" <?php if(isset($is_d2d) && ($is_d2d=='N' || $is_d2d=='')) echo 'checked'; ?>/> No </label>
												</td>												
											</tr>
											<tr>
												<td>If yes, <br/>(i) Number of wards covered in D2D collection of waste : </td>	
												<td><input type="text" name="d2d[ward]" id="d2d_ward" class="form-control text-uppercase" value="<?php echo $d2d_ward;?>"></td>
												<td>(ii) No. of households covered : </td>	
												<td><input type="text" name="d2d[households]" id="d2d_households" class="form-control text-uppercase" value="<?php echo $d2d_households;?>"></td>
											</tr>
											<tr>
												<td colspan="2">(iii) No. of non-residential premises including commercial establishments ,hotels, restaurants, educational institutions/ offices etc covered : </td>	
												<td><input type="text" name="d2d[premises]" id="d2d_premises" class="form-control text-uppercase" value="<?php echo $d2d_premises;?>"></td>
												<td></td>
											</tr>
											<tr>
												<td colspan="4">(iv) Percentage of residential and non-residential premises covered in door to door collection through : </td>
											</tr>
											<tr>
												<td>Motorized vehicle : </td>	
												<td><input type="text" name="d2d[vehicle]" id="d2d_vehicle" class="form-control text-uppercase" value="<?php echo $d2d_vehicle;?>" placeholder="%"></td>
												<td>Containerized tricycle/handcart : </td>	
												<td><input type="text" name="d2d[handcart]" id="d2d_handcart" class="form-control text-uppercase" value="<?php echo $d2d_handcart;?>" placeholder="%"></td>
											</tr>
											<tr>
												<td>Other device : </td>	
												<td><input type="text" name="d2d[other]" id="d2d_other" class="form-control text-uppercase" value="<?php echo $d2d_other;?>" placeholder="%"></td>
												<td colspan="2"></td>
											</tr>
											<tr>
												<td>If not, method of primary collection adopted : </td>	
												<td><input type="text" name="d2d[method]" id="d2d_method" class="form-control text-uppercase" value="<?php echo $d2d_method; ?>"></td>
												<td>Sweeping of streets : </td>	
												<td><input type="text" name="d2d[sweep]" id="d2d_sweep" class="form-control text-uppercase" value="<?php echo $d2d_sweep; ?>"></td>
											</tr>
											<tr>
												<td colspan="2">13. Length of roads, streets, lanes, bye-lanes in the city that need to be cleaned (in km) : </td>
												<td><input type="text" name="length" class="form-control text-uppercase" value="<?php echo $length; ?>"></td>
												<td></td>
											</tr>
											<tr>
												<td class="text-center" colspan="4">
													<a href="<?php echo $table_name;?>.php?tab=1" class="btn btn-primary text-bold">Go Back & Edit</a>
													<button type="submit" name="save<?php echo $form;?>b" class="btn btn-success text-bold submit1">Save and Next</button>
												</td>
											</tr>
										</table>
									</form>
								</div>	
								<div id="table3" class="tab-pane <?php echo $tabbtn3; ?>" role="tabpanel">
									<form name="myform1" class="myform1 submit1" method="post"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
										<table class="table table-responsive table-bordered">
											<tr>
												<td colspan="4">14. Frequency of street sweepings and percentage of population covered : </td>
											</tr>
											<tr>
												<td colspan="4">
													<table class="table table-responsive table-bordered">
													<thead>
														<th width="20%">Frequency</th>
														<th width="20%">Daily</th>
														<th width="20%">Alternate days</th>
														<th width="20%">Twice a week</th>
														<th width="20%">Occasionally</th>
													</thead>
													<tbody>
														<tr>
															<td>% of population covered</td>
															<td><input type="text" name="percent[daily]" class="form-control text-uppercase" value="<?php echo $percent_daily;?>"></td>
															<td><input type="text" name="percent[days]" class="form-control text-uppercase" value="<?php echo $percent_days;?>"></td>
															<td><input type="text" name="percent[week]" class="form-control text-uppercase" value="<?php echo $percent_week;?>"></td>
															<td><input type="text" name="percent[occasion]" class="form-control text-uppercase" value="<?php echo $percent_occasion;?>"></td>
														</tr>
													</tbody>
													</table>
												</td>
											</tr>
											<tr>
												<td>15. Tools used : </td>
												<td colspan="2"><input type="text" name="tools[used]" class="form-control text-uppercase" value="<?php echo $tools_used;?>"></td>
												<td></td>
											</tr>
											<tr>
												<td>(a) Manual sweeping : </td>
												<td><input type="text" name="tools[manual]" class="form-control text-uppercase" value="<?php echo $tools_manual;?>"></td>
												<td>(b) Mechanical sweeping : </td>
												<td><input type="text" name="tools[mech]" class="form-control text-uppercase" value="<?php echo $tools_mech;?>"></td>
											</tr>
											<tr>
												<td>(c) Whether long handle broom used by sanitation workers ? <span class="mandatory_field">*</span></td>
												<td>
													<label class="radio-inline"><input type="radio" name="tools[broom]" value="Y" <?php if(isset($tools_broom) && $tools_broom=='Y') echo 'checked'; ?> /> Yes </label>
													<label class="radio-inline"><input type="radio" name="tools[broom]" value="N" <?php if(isset($tools_broom) && ($tools_broom=='N' || $tools_broom=='')) echo 'checked'; ?>/> No </label>
												</td>
												<td>(d) Whether each sanitation worker is given handcart/tricycle for collection of waste ? <span class="mandatory_field">*</span></td>
												<td>
													<label class="radio-inline"><input type="radio" name="tools[handcart]" value="Y" <?php if(isset($tools_handcart) && $tools_handcart=='Y') echo 'checked'; ?> /> Yes </label>
													<label class="radio-inline"><input type="radio"  name="tools[handcart]" value="N" <?php if(isset($tools_handcart) && ($tools_handcart=='N' || $tools_handcart=='')) echo 'checked'; ?>/> No </label>
												</td>
											</tr>
											<tr>
												<td>(e) Whether handcart / tricycle is containerized ? <span class="mandatory_field">*</span></td>
												<td>
													<label class="radio-inline"><input type="radio" name="tools[tricycle]" value="Y" <?php if(isset($tools_tricycle) && $tools_tricycle=='Y') echo 'checked'; ?> /> Yes </label>
													<label class="radio-inline"><input type="radio" name="tools[tricycle]" value="N" <?php if(isset($tools_tricycle) && ($tools_tricycle=='N' || $tools_tricycle=='')) echo 'checked'; ?>/> No </label>
												</td>
												<td>(f) Whether the collection tool synchronizes with collection/ waste storage containers utilized ? <span class="mandatory_field">*</span></td>
												<td>
													<label class="radio-inline"><input type="radio" name="tools[collect]" value="Y" <?php if(isset($tools_collect) && $tools_collect=='Y') echo 'checked'; ?> /> Yes </label>
													<label class="radio-inline"><input type="radio"  name="tools[collect]" value="N" <?php if(isset($tools_collect) && ($tools_collect=='N' || $tools_collect=='')) echo 'checked'; ?>/> No </label>
												</td>
											</tr>
											<tr>
												<td colspan="4">16. Secondary Waste Storage facilities : </td>
											</tr>
											<tr>
												<td>(a) No. and type of waste storage depots in the city/town : </td>
												<td colspan="3">
												<table name="objectTable1" class="table table-responsive table-bordered "id="objectTable1" >
													<thead>
														<th>Sl No.</th>
														<th>Number </th>
														<th>Capacity in m3 </th>
													</thead>
													<?php
													$part1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t1 where form_id='$form_id'");
													$num = $part1->num_rows;
													if($num>0){
														$count=1;
														while($row_1=$part1->fetch_array()){ ?>
														<tr>
															<td><input readonly="readonly" name="txtA<?php echo $count;?>" id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["sl_no"]; ?>" size="1"></td>
															<td><input name="txtB<?php echo $count;?>" id="txtB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["number"]; ?>" placeholder="Number"></td>
															<td><input name="txtC<?php echo $count;?>" id="txtC<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["capacity"]; ?>" placeholder="Capacity in m3" ></td>
														</tr>	
													<?php $count++; } 
													}else{	?>
														<tr>
															<td><input  name="txtA1" id="txtA1" value="1" readonly="readonly" size="1" class="form-control text-uppercase"></td>
															<td><input name="txtB1" id="txtB1" class="form-control text-uppercase" placeholder="Number"></td>					
															<td><input name="txtC1" id="txtC1" class="form-control text-uppercase" placeholder="Capacity in m3" ></td>
														</tr>
													<?php } ?>
													</table>	
													<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMorefunction1()" value="">Add More</button>
													<button type="button" href="#" onclick="mydelfunction1()" class="btn btn-default" value="">Delete</button>
													<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/></div>
												</td>
											</tr>
											<tr>
												<td>(b) Open waste storage sites : </td>
												<td><input type="text" name="storage[open]" class="form-control text-uppercase" value="<?php echo $storage_open;?>"></td>
												<td>(c) Masonry bins : </td>
												<td><input type="text" name="storage[masonry]" class="form-control text-uppercase" value="<?php echo $storage_masonry ;?>"></td>
											</tr>
											<tr>
												<td>(d) Cement concrete cylinder bins : </td>
												<td><input type="text" name="storage[concrete]" class="form-control text-uppercase" value="<?php echo $storage_concrete;?>"></td>
												<td>(e) Dhalao/covered rooms/space : </td>
												<td><input type="text" name="storage[dhalao]" class="form-control text-uppercase" value="<?php echo $storage_dhalao;?>"></td>
											</tr>
											<tr>
												<td>(f) Covered metal/plastic containers : </td>
												<td><input type="text" name="storage[metal]" class="form-control text-uppercase" value="<?php echo $storage_metal;?>"></td>
												<td>(g) Upto 1.1 m3 bins : </td>
												<td><input type="text" name="storage[bins]" class="form-control text-uppercase" value="<?php echo $storage_bins;?>"></td>
											</tr>
											<tr>
												<td>(h) 2 to 5 m3 bins : </td>
												<td><input type="text" name="storage[bins2]" class="form-control text-uppercase" value="<?php echo $storage_bins2;?>"></td>
												<td>(i) Above 5m3 containers : </td>
												<td><input type="text" name="storage[containers]" class="form-control text-uppercase" value="<?php echo $storage_containers;?>"></td>
											</tr>
											<tr>
												<td>(j) Bin-less city : </td>
												<td><input type="text" name="storage[city]" class="form-control text-uppercase" value="<?php echo $storage_city;?>"></td>
												<td colspan="2"></td>
											</tr>
											<tr>
												<td>17. Bin/ population ratio : </td>
												<td><input type="text" name="ratio" class="form-control text-uppercase" value="<?php echo $ratio;?>"></td>
												<td colspan="2"></td>
											</tr>
											<tr>
												<td width="25%">18. Ward wise details of waste storage depots (Please attach) : </td>
												<td width="25%"><input type="text" name="ward[depots]" class="form-control text-uppercase" value="<?php echo $ward_depots;?>"></td>
												<td width="25%">(a) Ward No : </td>
												<td width="25%"><input type="text" name="ward[number]" class="form-control text-uppercase" value="<?php echo $ward_number;?>"></td>
											</tr>
											<tr>
												<td>(b) Area : </td>
												<td><input type="text" name="ward[area]" class="form-control text-uppercase" value="<?php echo $ward_area;?>"></td>
												<td>(c) Population : </td>
												<td><input type="text" name="ward[population]" class="form-control text-uppercase" value="<?php echo $ward_population;?>"></td>
											</tr>
											<tr>
												<td>(d) No. of bins placed : </td>
												<td><input type="text" name="ward[bins_no]" class="form-control text-uppercase" value="<?php echo $ward_bins_no;?>"></td>
												<td>(e) Total volume of bins placed : </td>
												<td><input type="text" name="ward[bins_vol]" class="form-control text-uppercase" value="<?php echo $ward_bins_vol;?>"></td>
											</tr>
											<tr>
												<td>19. Total storage capacity of waste storage facilities in cubic meters : </td>
												<td><input type="text" name="total_storage" class="form-control text-uppercase" value="<?php echo $total_storage;?>"></td>
												<td>20. Total waste actually stored at the waste storage depots daily : </td>
												<td><input type="text" name="total_waste" class="form-control text-uppercase" value="<?php echo $total_waste;?>"></td>
											</tr>
											<tr>
												<td class="text-center" colspan="4">
													<a href="<?php echo $table_name;?>.php?tab=2" class="btn btn-primary text-bold">Go Back & Edit</a>
													<button type="submit" name="save<?php echo $form;?>c" class="btn btn-success text-bold submit1">Save and Next</button>
												</td>
											</tr>
										</table>
									</form>
								</div>
								<div id="table4" class="tab-pane <?php echo $tabbtn4; ?>" role="tabpanel">
									<form name="myform1" class="myform1 submit1" method="post"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
										<table class="table table-responsive table-bordered">
											<tr>
												<td colspan="4">21. Give frequency of collection of waste from the depots : </td>
											</tr>
											<tr>
												<td width="25%">(a) Number of bins cleared : </td>
												<td colspan="3">
													<table class="table table-responsive table-bordered">
													<thead>
														<th width="50%">Frequency </th>
														<th width="50%">No. of bins </th>
													</thead>
													<tbody>
														<tr>
															<td>Daily</td>
															<td><input type="text" name="frequency[daily]" class="form-control text-uppercase" value="<?php echo $frequency_daily;?>"></td>
														</tr>
														<tr>
															<td>Alternate days</td>
															<td><input type="text" name="frequency[days]" class="form-control text-uppercase" value="<?php echo $frequency_days;?>"></td>
														</tr>
														<tr>
															<td>Twice a week</td>
															<td><input type="text" name="frequency[twice]" class="form-control text-uppercase" value="<?php echo $frequency_twice;?>"></td>
														</tr>
														<tr>
															<td>Once a week</td>
															<td><input type="text" name="frequency[once]" class="form-control text-uppercase" value="<?php echo $frequency_once;?>"></td>
														</tr>
														<tr>
															<td>Occasionally</td>
															<td><input type="text" name="frequency[occasion]" class="form-control text-uppercase" value="<?php echo $frequency_occasion;?>"></td>
														</tr>
													</tbody>
													</table>
												</td>
											</tr>
											<tr class="form-inline">
												<td>(b) Whether storage depots have facility for storage of segregated waste in green, blue and black bins ? <span class="mandatory_field">*</span></td>
												<td>
													<label class="radio-inline"><input type="radio" name="is_facility" class="is_facility" value="Y" <?php if(isset($is_facility) && $is_facility=='Y') echo 'checked'; ?> /> Yes </label>
													<label class="radio-inline"><input type="radio" class="is_facility"  value="N"  name="is_facility" <?php if(isset($is_facility) && ($is_facility=='N' || $is_facility=='')) echo 'checked'; ?>/> No </label>
												</td>
												<td colspan="2">If yes, add details : <br/>
												No. of green bins : &nbsp;&nbsp;&nbsp;<input type="text" name="number[green]" id="number_green" class="form-control text-uppercase" value="<?php echo $number_green; ?>" validate="onlyNumbers"><br/>
												No. of blue bins : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="number[blue]" id="number_blue" class="form-control text-uppercase" value="<?php echo $number_blue; ?>" validate="onlyNumbers"><br/>
												No. of black bins : &nbsp;&nbsp;&nbsp;<input type="text" name="number[black]" id="number_black" class="form-control text-uppercase" value="<?php echo $number_black; ?>" validate="onlyNumbers"></td>
											</tr>
											<tr>
												<td colspan="4">22. Whether lifting of solid waste from storage depots is manual or mechanical. Give percentage : </td>
											</tr>
											<tr>
												<td>Percentage of Manual Lifting of solid waste (%) : </td>
												<td><input type="text" name="lifting[manual]" class="form-control text-uppercase" value="<?php echo $lifting_manual;?>"></td>
												<td>Percentage of Mechanical lifting (%) : </td>
												<td><input type="text" name="lifting[mech]" class="form-control text-uppercase" value="<?php echo $lifting_mech;?>"></td>
											</tr>
											<tr>
												<td>If mechanical - Specify the method used : </td>
												<td colspan="3">
													<label class="radio-inline"><input type="radio" name="lifting[method]"  value="F" <?php if(isset($lifting_method) && $lifting_method=='F') echo 'checked'; ?> /> Front-end loaders </label>
													<label class="radio-inline"><input type="radio" name="lifting[method]"  value="T" <?php if(isset($lifting_method) && $lifting_method=='T') echo 'checked'; ?>/> Top loaders </label>
												</td>
											</tr>
											<tr>
												<td>23. Whether solid waste is lifted from door to door and transported to treatment plant directly in a segregated form ? <span class="mandatory_field">*</span></td>
												<td>
													<label class="radio-inline"><input type="radio" name="lifting[transport]" class="lifting_transport" value="Y" <?php if(isset($lifting_transport) && $lifting_transport=='Y') echo 'checked'; ?> /> Yes </label>
													<label class="radio-inline"><input type="radio" name="lifting[transport]" class="lifting_transport"  value="N" <?php if(isset($lifting_transport) && ($lifting_transport=='N' || $lifting_transport=='')) echo 'checked'; ?>/> No </label>
												</td>
												<td>If yes, specify : </td>	
												<td><input type="text" name="lifting[specify]" id="lifting_specify" class="form-control text-uppercase" value="<?php echo $lifting_specify; ?>"></td>
											</tr>
											<tr>
												<td>24. Waste Transportation per day : </td>
												<td colspan="3">
												<table name="objectTable2" class="table table-responsive table-bordered "id="objectTable2" >
													<thead>
														<th>Sl No. </th>
														<th>Waste transported </th>
														<th>Trips made </th>
													</thead>
													<?php
													$part2=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t2 where form_id='$form_id'");
													$num2 = $part2->num_rows;
													if($num2>0){
														$count=1;
														while($row_1=$part2->fetch_array()){ ?>
														<tr>
															<td><input readonly="readonly" id="textA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["sl_no"]; ?>" name="textA<?php echo $count;?>" size="1"></td>
															<td><input name="textB<?php echo $count;?>" id="textB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["waste"]; ?>" placeholder="Waste transported"></td>
															<td><input name="textC<?php echo $count;?>" id="textC<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["trips"]; ?>" placeholder="Trips made" ></td>
														</tr>	
													<?php $count++; } 
													}else{?>
														<tr>
															<td><input name="textA1" id="textA1" value="1" readonly="readonly" size="1" class="form-control text-uppercase" ></td>
															<td><input name="textB1" id="textB1" class="form-control text-uppercase" placeholder="Waste transported"></td>				
															<td><input name="textC1" id="textC1" class="form-control text-uppercase" placeholder="Trips made" ></td>
														</tr>
													<?php } ?>
													</table>	
													<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMorefunction2()" value="">Add More</button>
													<button type="button" href="#" onclick="mydelfunction2()" class="btn btn-default" value="">Delete</button>
													<input type="hidden" id="hiddenval2" name="hiddenval2" value="<?php echo $hiddenval2; ?>"/></div>
												</td>
											</tr>
											<tr>
												<td>25. Type and Number of vehicles used : </td>
												<td colspan="3">
													<table class="table table-responsive table-bordered">
													<thead>  
														<th width="50%">Type </th>
														<th width="50%">Number of vehicles </th>
													</thead>
													<tbody>
														<tr>
															<td>Animal cart</td>
															<td><input type="text" name="vehicles[animal]" class="form-control text-uppercase" value="<?php echo $vehicles_animal;?>"></td>
														</tr>
														<tr>
															<td>Tractors</td>
															<td><input type="text" name="vehicles[tractors]" class="form-control text-uppercase" value="<?php echo $vehicles_tractors;?>"></td>
														</tr>
														<tr>
															<td>Tipping Truck</td>
															<td><input type="text" name="vehicles[tipping]" class="form-control text-uppercase" value="<?php echo $vehicles_tipping;?>"></td>
														</tr>
														<tr>
															<td>Non Tipping Truck</td>
															<td><input type="text" name="vehicles[non_tipping]" class="form-control text-uppercase" value="<?php echo $vehicles_non_tipping;?>"></td>
														</tr>
														<tr>
															<td>Dumper Placers</td>
															<td><input type="text" name="vehicles[dumper]" class="form-control text-uppercase" value="<?php echo $vehicles_dumper;?>"></td>
														</tr>
														<tr>
															<td>Refuse collectors</td>
															<td><input type="text" name="vehicles[refuse]" class="form-control text-uppercase" value="<?php echo $vehicles_refuse;?>"></td>
														</tr>
														<tr>
															<td>Compactors</td>
															<td><input type="text" name="vehicles[compactors]" class="form-control text-uppercase" value="<?php echo $vehicles_compactors;?>"></td>
														</tr>
														<tr>
															<td>Others</td>
															<td><input type="text" name="vehicles[others]" class="form-control text-uppercase" value="<?php echo $vehicles_others;?>"></td>
														</tr>
														<tr>
															<td>JCB/loader</td>
															<td><input type="text" name="vehicles[jcb]" class="form-control text-uppercase" value="<?php echo $vehicles_jcb;?>"></td>
														</tr>
													</tbody>
													</table>
												</td>
											</tr> 
											<tr>
												<td class="text-center" colspan="4">
													<a href="<?php echo $table_name;?>.php?tab=3" class="btn btn-primary text-bold">Go Back & Edit</a>
													<button type="submit" name="save<?php echo $form;?>d" class="btn btn-success text-bold submit1">Save and Next</button>
												</td>
											</tr>
										</table>
									</form>
								</div>
								<div id="table5" class="tab-pane <?php echo $tabbtn5; ?>" role="tabpanel">
									<form name="myform1" class="myform1 submit1" method="post"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
										<table class="table table-responsive table-bordered">
											<tr>
												<td>26. Frequency of transportation of waste : </td>
												<td colspan="3">
													<table class="table table-responsive table-bordered">
													<thead>
														<th width="50%">Frequency </th>
														<th width="50%">(%) of waste transported </th>
													</thead>
													<tbody>
														<tr>
															<td>Daily</td>
															<td><input type="text" name="transport[daily]" class="form-control text-uppercase" value="<?php echo $transport_daily;?>"></td>
														</tr>
														<tr>
															<td>Alternate days</td>
															<td><input type="text" name="transport[days]" class="form-control text-uppercase" value="<?php echo $transport_days;?>"></td>
														</tr>
														<tr>
															<td>Twice a week</td>
															<td><input type="text" name="transport[twice]" class="form-control text-uppercase" value="<?php echo $transport_twice;?>"></td>
														</tr>
														<tr>
															<td>Once a week</td>
															<td><input type="text" name="transport[once]" class="form-control text-uppercase" value="<?php echo $transport_once;?>"></td>
														</tr>
														<tr>
															<td>Occasionally</td>
															<td><input type="text" name="transport[occasion]" class="form-control text-uppercase" value="<?php echo $transport_occasion;?>"></td>
														</tr>
													</tbody>
													</table>
												</td>
											</tr>
											<tr>
												<td width="25%">27. Quantity of waste transported each day : </td>
												<td width="25%"><input type="text" name="transport[qty]" class="form-control text-uppercase" value="<?php echo $transport_qty;?>" placeholder="/tpd"></td>
												<td width="25%">28. Percentage of total waste transported daily (%) : </td>
												<td width="25%"><input type="text" name="transport[percent]" class="form-control text-uppercase" value="<?php echo $transport_percent;?>" placeholder="%"></td>
											</tr>
											<tr>
												<td>29. Waste Treatment Technologies used : </td>
												<td><input type="text" name="waste_treatment" class="form-control text-uppercase" value="<?php echo $waste_treatment;?>"></td>
												<td colspan="2"></td>
											</tr>
											<tr>
												<td>30. Whether solid waste is processed ? <span class="mandatory_field">*</span></td>
												<td>
													<label class="radio-inline"><input type="radio" name="waste_process" class="waste_process" value="Y" <?php if(isset($waste_process) && $waste_process=='Y') echo 'checked'; ?> /> Yes </label>
													<label class="radio-inline"><input type="radio" name="waste_process" class="waste_process"  value="N" <?php if(isset($waste_process) && ($waste_process=='N' || $waste_process=='')) echo 'checked'; ?>/> No </label>
												</td>
												<td>If yes, Quantity of waste processed daily : </td>	
												<td><input type="text" name="waste_process_qty" id="waste_process_qty" class="form-control text-uppercase" value="<?php echo $waste_process_qty; ?>" placeholder="/tpd"></td>
											</tr>
											<tr>
												<td colspan="2">31. Whether treatment is done by local body or through an agency ? </td>
												<td><input type="text" name="treatment_by" class="form-control text-uppercase" value="<?php echo $treatment_by;?>"></td>
												<td></td>
											</tr>
											<tr>
												<td>32. (a) Land(s) available with the local body for waste processing (in Hectares): </td>
												<td><input type="text" name="process[available]" class="form-control text-uppercase" value="<?php echo $process_available;?>" placeholder="In Hectares"></td>
												<td>(b) Land currently utilized for waste processing : </td>
												<td><input type="text" name="process[utilized]" class="form-control text-uppercase" value="<?php echo $process_utilized;?>"></td>
											</tr>
											<tr>
												<td>(c) Solid waste processing facilities in operation : </td>
												<td><input type="text" name="process[operation]" class="form-control text-uppercase" value="<?php echo $process_operation;?>"></td>
												<td>(d) Solid waste processing facilities under construction : </td>
												<td><input type="text" name="process[construction]" class="form-control text-uppercase" value="<?php echo $process_construction;?>"></td>
											</tr>
											<tr>
												<td colspan="2">(e) Distance of processing facilities from city/town boundary : </td>
												<td><input type="text" name="process[distance]" class="form-control text-uppercase" value="<?php echo $process_distance;?>"></td>
												<td></td>
											</tr>
											<tr>
												<td colspan="4">33. Details of technologies adopted : </td>					
											</tr>
											<tr>
												<td width="30%"><strong>(a) Composting : </strong></td>
												<td colspan="3">
													<table class="table table-responsive table-bordered">
														<tr>
															<td>Quantity raw material processed : </td>
															<td><input type="text" name="compost[raw]" class="form-control text-uppercase" value="<?php echo $compost_raw;?>"></td>
														</tr>
														<tr>
															<td>Quantity final product produced : </td>
															<td><input type="text" name="compost[product]" class="form-control text-uppercase" value="<?php echo $compost_product;?>"></td>
														</tr>
														<tr>
															<td>Quantity sold : </td>
															<td><input type="text" name="compost[sold]" class="form-control text-uppercase" value="<?php echo $compost_sold;?>"></td>
														</tr>
														<tr>
															<td>Quantity of residual waste landfilled : </td>
															<td><input type="text" name="compost[residual]" class="form-control text-uppercase" value="<?php echo $compost_residual;?>"></td>
														</tr>
													</table>
												</td>
											</tr>
											<tr>
												<td><strong>(b) Vermi Composting : </strong></td>
												<td colspan="3">
													<table class="table table-responsive table-bordered">
														<tr>
															<td>Quantity raw material processed : </td>
															<td><input type="text" name="vermi[raw]" class="form-control text-uppercase" value="<?php echo $vermi_raw;?>"></td>
														</tr>
														<tr>
															<td>Quantity final product produced : </td>
															<td><input type="text" name="vermi[product]" class="form-control text-uppercase" value="<?php echo $vermi_product;?>"></td>
														</tr>
														<tr>
															<td>Quantity sold : </td>
															<td><input type="text" name="vermi[sold]" class="form-control text-uppercase" value="<?php echo $vermi_sold;?>"></td>
														</tr>
														<tr>
															<td>Quantity of residual waste landfilled : </td>
															<td><input type="text" name="vermi[residual]" class="form-control text-uppercase" value="<?php echo $vermi_residual;?>"></td>
														</tr>
													</table>
												</td>
											</tr>
											<tr>
												<td><strong>(c) Bio-methanation : </strong></td>
												<td colspan="3">
													<table class="table table-responsive table-bordered">
														<tr>
															<td>Quantity raw material processed : </td>
															<td><input type="text" name="bio[raw]" class="form-control text-uppercase" value="<?php echo $bio_raw;?>"></td>
														</tr>
														<tr>
															<td>Quantity final product produced : </td>
															<td><input type="text" name="bio[product]" class="form-control text-uppercase" value="<?php echo $bio_product;?>"></td>
														</tr>
														<tr>
															<td>Quantity sold : </td>
															<td><input type="text" name="bio[sold]" class="form-control text-uppercase" value="<?php echo $bio_sold;?>"></td>
														</tr>
														<tr>
															<td>Quantity of residual waste landfilled : </td>
															<td><input type="text" name="bio[residual]" class="form-control text-uppercase" value="<?php echo $bio_residual;?>"></td>
														</tr>
													</table>
												</td>
											</tr>
											<tr>
												<td><strong>(d) Refuse Derived Fuel : </strong></td>
												<td colspan="3">
													<table class="table table-responsive table-bordered">
														<tr>
															<td>Quantity raw material processed : </td>
															<td><input type="text" name="fuel[raw]" class="form-control text-uppercase" value="<?php echo $fuel_raw;?>"></td>
														</tr>
														<tr>
															<td>Quantity final product produced : </td>
															<td><input type="text" name="fuel[product]" class="form-control text-uppercase" value="<?php echo $fuel_product;?>"></td>
														</tr>
														<tr>
															<td>Quantity sold : </td>
															<td><input type="text" name="fuel[sold]" class="form-control text-uppercase" value="<?php echo $fuel_sold;?>"></td>
														</tr>
														<tr>
															<td>Quantity of residual waste landfilled : </td>
															<td><input type="text" name="fuel[residual]" class="form-control text-uppercase" value="<?php echo $fuel_residual;?>"></td>
														</tr>
													</table>
												</td>
											</tr>
											<tr>
												<td><strong>(e) Waste to Energy technology such as incineration, gasification, pyrolysis or any other technology (Give details) : </strong></td>
												<td colspan="3">
													<table class="table table-responsive table-bordered">
														<tr>
															<td>Quantity raw material processed : </td>
															<td><input type="text" name="energy[raw]" class="form-control text-uppercase" value="<?php echo $energy_raw;?>"></td>
														</tr>
														<tr>
															<td>Quantity final product produced : </td>
															<td><input type="text" name="energy[product]" class="form-control text-uppercase" value="<?php echo $energy_product;?>"></td>
														</tr>
														<tr>
															<td>Quantity sold : </td>
															<td><input type="text" name="energy[sold]" class="form-control text-uppercase" value="<?php echo $energy_sold;?>"></td>
														</tr>
														<tr>
															<td>Quantity of residual waste landfilled : </td>
															<td><input type="text" name="energy[residual]" class="form-control text-uppercase" value="<?php echo $energy_residual;?>"></td>
														</tr>
													</table>
												</td>
											</tr>
											<tr>
												<td><strong>(f) Co-processing : </strong></td>
												<td>Quantity raw material processed : </td>
												<td><input type="text" name="co_process_raw" class="form-control text-uppercase" value="<?php echo $co_process_raw;?>"></td>
											</tr>
											<tr>
												<td class="text-center" colspan="4">
													<a href="<?php echo $table_name;?>.php?tab=4" class="btn btn-primary text-bold">Go Back & Edit</a>
													<button type="submit" name="save<?php echo $form;?>e" class="btn btn-success text-bold submit1">Save and Next</button>
												</td>
											</tr>																					
										</table>
									</form>
								</div>
								<div id="table6" class="tab-pane <?php echo $tabbtn6; ?>" role="tabpanel">
									<form name="myform1" class="myform1 submit1" method="post"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
										<table class="table table-responsive table-bordered">
											<tr>
												<td width="25%">34. (a) Combustible waste supplied to cement plant : </td>
												<td width="25%"><input type="text" name="combustible[cement]" class="form-control text-uppercase" value="<?php echo $combustible_cement;?>"></td>
												<td width="25%">(b) Combustible waste supplied to solid waste based power plants : </td>
												<td width="25%"><input type="text" name="combustible[power]" class="form-control text-uppercase" value="<?php echo $combustible_power;?>"></td>
											</tr>
											<tr>
												<td width="25%">35. (a) Solid waste disposal facilities : </td>
												<td width="25%"><input type="text" name="others[a]" class="form-control text-uppercase" value="<?php echo $others_a;?>"></td>
												<td width="25%">(b) No. of dumpsites sites available with the local body : </td>
												<td width="25%"><input type="text" name="others[b]" class="form-control text-uppercase" value="<?php echo $others_b;?>"></td>
											</tr>
											<tr>
												<td>(c) No. of sanitary landfill sites available with the local body : </td>
												<td><input type="text" name="others[c]" class="form-control text-uppercase" value="<?php echo $others_c;?>"></td>
												<td>(d) Area of each such sites available for waste disposal : </td>
												<td><input type="text" name="others[d]" class="form-control text-uppercase" value="<?php echo $others_d;?>"></td>
											</tr>
											<tr>
												<td>(e) Area of land currently used for waste disposal : </td>
												<td><input type="text" name="others[e]" class="form-control text-uppercase" value="<?php echo $others_e;?>"></td>
												<td>(f) Distance of dumpsite/landfill facility from city/town : </td>
												<td><input type="text" name="others[f]" class="form-control text-uppercase" value="<?php echo $others_f;?>" placeholder="kilometres"></td>
											</tr>
											<tr>
												<td>(g) Distance from the nearest habitation : </td>
												<td><input type="text" name="others[g]" class="form-control text-uppercase" value="<?php echo $others_g;?>" placeholder="kilometres"></td>
												<td>(h) Distance from water body : </td>
												<td><input type="text" name="others[h]" class="form-control text-uppercase" value="<?php echo $others_h;?>" placeholder="kilometres"></td>
											</tr>
											<tr>
												<td>(i) Distance from state/national highway : </td>
												<td><input type="text" name="others[i]" class="form-control text-uppercase" value="<?php echo $others_i;?>" placeholder="kilometres"></td>
												<td>(j) Distance from Airport : </td>
												<td><input type="text" name="others[j]" class="form-control text-uppercase" value="<?php echo $others_j;?>" placeholder="kilometres"></td>
											</tr>
											<tr>
												<td>(k) Distance from important religious places or historical monument : </td>
												<td><input type="text" name="others[k]" class="form-control text-uppercase" value="<?php echo $others_k;?>" placeholder="kilometres"></td>
												<td>(l) Whether it falls in flood prone area ? <span class="mandatory_field">*</span></td>
												<td>
													<label class="radio-inline"><input type="radio" name="others[l]" value="Y" <?php if(isset($others_l) && $others_l=='Y') echo 'checked'; ?> /> Yes </label>
													<label class="radio-inline"><input type="radio" name="others[l]"  value="N" <?php if(isset($others_l) && ($others_l=='N' || $others_l=='')) echo 'checked'; ?>/> No </label>
												</td>
											</tr>
											<tr>
												<td>(m) Whether it falls in earthquake fault line area ? <span class="mandatory_field">*</span></td>
												<td>
													<label class="radio-inline"><input type="radio" name="others[m]" value="Y" <?php if(isset($others_m) && $others_m=='Y') echo 'checked'; ?> /> Yes </label>
													<label class="radio-inline"><input type="radio" name="others[m]"  value="N" <?php if(isset($others_m) && ($others_m=='N' || $others_m=='')) echo 'checked'; ?>/> No </label>
												</td>
												<td>(n) Quantity of waste landfilled each day  : </td>
												<td><input type="text" name="others[n]" class="form-control text-uppercase" value="<?php echo $others_n;?>" placeholder="tpd"></td>
											</tr>
											<tr>
												<td>(o) Whether landfill site is fenced ? <span class="mandatory_field">*</span></td>
												<td>
													<label class="radio-inline"><input type="radio" name="others[o]" value="Y" <?php if(isset($others_o) && $others_o=='Y') echo 'checked'; ?> /> Yes </label>
													<label class="radio-inline"><input type="radio" name="others[o]"  value="N" <?php if(isset($others_o) && ($others_o=='N' || $others_o=='')) echo 'checked'; ?>/> No </label>
												</td>
												<td>(p) Whether Lighting facility is available on site ? <span class="mandatory_field">*</span></td>
												<td>
													<label class="radio-inline"><input type="radio" name="others[p]" value="Y" <?php if(isset($others_p) && $others_p=='Y') echo 'checked'; ?> /> Yes </label>
													<label class="radio-inline"><input type="radio" name="others[p]"  value="N" <?php if(isset($others_p) && ($others_p=='N' || $others_p=='')) echo 'checked'; ?>/> No </label>
												</td>
											</tr>
											<tr>
												<td>(q) Whether Weigh bridge facility available ? <span class="mandatory_field">*</span></td>
												<td>
													<label class="radio-inline"><input type="radio" name="others[q]" value="Y" <?php if(isset($others_q) && $others_q=='Y') echo 'checked'; ?> /> Yes </label>
													<label class="radio-inline"><input type="radio" name="others[q]"  value="N" <?php if(isset($others_q) && ($others_q=='N' || $others_q=='')) echo 'checked'; ?>/> No </label>
												</td>
												<td>(r) Vehicles and equipments used at landfill (Specify - Bulldozer, Compacters etc. available) ? <span class="mandatory_field">*</span></td>
												<td><input type="text" name="others[r]" class="form-control text-uppercase" value="<?php echo $others_r;?>"></td>
											</tr>
											<tr>
												<td>(s) Whether manpower deployed at landfill site ? <span class="mandatory_field">*</span></td>
												<td>
													<label class="radio-inline"><input type="radio" name="others[s]" class="others_s" value="Y" <?php if(isset($others_s) && $others_s=='Y') echo 'checked'; ?> /> Yes </label>
													<label class="radio-inline"><input type="radio" name="others[s]" class="others_s"  value="N" <?php if(isset($others_s) && ($others_s=='N' || $others_s=='')) echo 'checked'; ?>/> No </label>
												</td>
												<td>If yes, attach details : </td>	
												<td><input type="text" name="others_s_details" id="others_s_details" class="form-control text-uppercase" value="<?php echo $others_s_details; ?>"></td>
											</tr>
											<tr>
												<td>(t) Whether covering is done on daily basis ? <span class="mandatory_field">*</span></td>
												<td>
													<label class="radio-inline"><input type="radio" name="others[t]" class="others_t" value="Y" <?php if(isset($others_t) && ($others_t=='Y' || $others_t=='')) echo 'checked'; ?> /> Yes </label>
													<label class="radio-inline"><input type="radio" name="others[t]" class="others_t"  value="N" <?php if(isset($others_t) && $others_t=='N') echo 'checked'; ?>/> No </label>
												</td>
												<td>If not, Frequency of covering the waste deposited at the landfill : </td>	
												<td><input type="text" name="others_t_details" id="others_t_details" class="form-control text-uppercase" value="<?php echo $others_t_details; ?>"></td>
											</tr>
											<tr>
												<td>(u) Cover material used : </td>
												<td><input type="text" name="others[u]" class="form-control text-uppercase" value="<?php echo $others_u;?>"></td>
												<td>(v) Whether adequate covering material is available ? </td>
												<td>
													<label class="radio-inline"><input type="radio" name="others[v]" value="Y" <?php if(isset($others_v) && $others_v=='Y') echo 'checked'; ?> /> Yes </label>
													<label class="radio-inline"><input type="radio" name="others[v]"  value="N" <?php if(isset($others_v) && ($others_v=='N' || $others_v=='')) echo 'checked'; ?>/> No </label>
												</td>
											</tr>
											<tr>
												<td>(w) Whether provisions for gas venting provided ? </td>
												<td>
													<label class="radio-inline"><input type="radio" name="others[w]" value="Y" <?php if(isset($others_w) && $others_w=='Y') echo 'checked'; ?> /> Yes </label>
													<label class="radio-inline"><input type="radio" name="others[w]"  value="N" <?php if(isset($others_w) && ($others_w=='N' || $others_w=='')) echo 'checked'; ?>/> No </label>
												</td>
												<td colspan="2">If yes, attach technical data sheet</td>
											</tr>
											<tr>
												<td>(x) Whether provision for leachate collection ? </td>
												<td>
													<label class="radio-inline"><input type="radio" name="others[x]" value="Y" <?php if(isset($others_x) && $others_x=='Y') echo 'checked'; ?> /> Yes </label>
													<label class="radio-inline"><input type="radio" name="others[x]"  value="N" <?php if(isset($others_x) && ($others_x=='N' || $others_x=='')) echo 'checked'; ?>/> No </label>
												</td>
												<td colspan="2">If yes, attach technical data sheet</td>
											</tr>
											<tr>
												<td>36. Whether an Action Plan has been prepared for improving solid waste management practices in the city ? </td>
												<td>
													<label class="radio-inline"><input type="radio" name="action_plan" value="Y" <?php if(isset($action_plan) && $action_plan=='Y') echo 'checked'; ?> /> Yes </label>
													<label class="radio-inline"><input type="radio" name="action_plan"  value="N" <?php if(isset($action_plan) && ($action_plan=='N' || $action_plan=='')) echo 'checked'; ?>/> No </label>
												</td>
												<td colspan="2">If yes, attach Action Plan details</td>
											</tr>
											<tr>
												<td colspan="4">37. What separate provisions are made for : (Attach details on Proposals, Steps taken) </td>
											</tr>
											<tr>
												<td>(a) Dairy related activities :  </td>
												<td>
													<label class="radio-inline"><input type="radio" name="provisions[dairy]" value="Y" <?php if(isset($provisions_dairy) && $provisions_dairy=='Y') echo 'checked'; ?> /> Yes </label>
													<label class="radio-inline"><input type="radio" name="provisions[dairy]"  value="N" <?php if(isset($provisions_dairy) && ($provisions_dairy=='N' || $provisions_dairy=='')) echo 'checked'; ?>/> No </label>
												</td>
												<td>(b) Slaughter houses waste : </td>
												<td>
													<label class="radio-inline"><input type="radio" name="provisions[slaughter]" value="Y" <?php if(isset($provisions_slaughter) && $provisions_slaughter=='Y') echo 'checked'; ?> /> Yes </label>
													<label class="radio-inline"><input type="radio" name="provisions[slaughter]"  value="N" <?php if(isset($provisions_slaughter) && ($provisions_slaughter=='N' || $provisions_slaughter=='')) echo 'checked'; ?>/> No </label>
												</td>
											</tr>
											<tr>
												<td>(c) C&D waste (construction debris) : </td>
												<td colspan="3">
													<label class="radio-inline"><input type="radio" name="provisions[debris]" value="Y" <?php if(isset($provisions_debris) && $provisions_debris=='Y') echo 'checked'; ?> /> Yes </label>
													<label class="radio-inline"><input type="radio" name="provisions[debris]"  value="N" <?php if(isset($provisions_debris) && ($provisions_debris=='N' || $provisions_debris=='')) echo 'checked'; ?>/> No </label>
												</td>
											</tr>
											<tr>
												<td>38. Details of Post Closure Plan </td>
												<td colspan="3">Attach Plan</td>
											</tr>
											<tr>
												<td colspan="2">39. How many slums are identified and whether these are provided with Solid Waste Management facilities ? </td>
												<td>
													<label class="radio-inline"><input type="radio" name="slums" value="Y" <?php if(isset($slums) && $slums=='Y') echo 'checked'; ?> /> Yes </label>
													<label class="radio-inline"><input type="radio" name="slums"  value="N" <?php if(isset($slums) && ($slums=='N' || $slums=='')) echo 'checked'; ?>/> No </label>
												</td>
												<td>If yes, attach details</td>
											</tr>
											<tr>
												<td>40. Give details of Contractor/ concessionaire's manpower deployed for collection including street sweeping, secondary storage, transportation, processing and disposal of waste : </td>
												<td><input type="text" name="manpower" class="form-control text-uppercase" value="<?php echo $manpower;?>" ></td>
												<td>41. Mention briefly, the difficulties being experienced by the local body in complying with provisions of these rules : </td>
												<td><input type="text" name="difficulties" class="form-control text-uppercase" value="<?php echo $difficulties;?>"></td>
											</tr>
											<tr>
												<td colspan="3">42. Mention briefly, if any innovative idea is implemented to tackle a problem related to solid waste, which could be replicated by other local bodies : </td>
												<td><input type="text" name="innovative" class="form-control text-uppercase" value="<?php echo $innovative;?>" ></td>
											</tr>
											<tr>
												<td colspan="2" align="left">Date : <strong><?php echo date('d-m-Y',strtotime($today)); ?></strong><br/> Place : <strong><?php echo $dist;?></strong></td>
												<td colspan="2" align="right">Signature of CEO/Municipal Commissioner/ Executive Officer/Chief Officer : <strong><?php echo strtoupper($key_person)?></strong></td>
											</tr>
											<tr>
												<td class="text-center" colspan="4">
													<a href="<?php echo $table_name;?>.php?tab=5" class="btn btn-primary text-bold">Go Back & Edit</a>
													<button type="submit" name="save<?php echo $form;?>f" class="btn btn-success text-bold submit1">Save and Next</button>
												</td>
											</tr>
										</table>
									</form>
								</div>								
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
  <!-- /.content-wrapper -->
  <?php require_once "../../../views/users/requires/footer.php";  ?>
<?php require '../../requires/js.php' ?>
<script>
	/* ---------------------Block all after submit operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
	/* ------------------------------------------------------ */
	$('#bins_domestic').attr('readonly','readonly');
	<?php if($is_stored == 'Y') echo "$('#bins_domestic').removeAttr('readonly','readonly');"; ?>
	$('.is_stored').on('change', function(){
		if($(this).val() == 'Y'){
			$('#bins_domestic').removeAttr('readonly','readonly');
		}else{
			$('#bins_domestic').attr('readonly','readonly');
			$('#bins_domestic').val('');
		}			
	});
	/* ------------------------------------------------------ */
	$('#bins_commercial').attr('readonly','readonly');
	<?php if($is_stored == 'Y') echo "$('#bins_commercial').removeAttr('readonly','readonly');"; ?>
	$('.is_stored').on('change', function(){
		if($(this).val() == 'Y'){
			$('#bins_commercial').removeAttr('readonly','readonly');
		}else{
			$('#bins_commercial').attr('readonly','readonly');
			$('#bins_commercial').val('');
		}			
	});
	/* ------------------------------------------------------ */
	$('#bins_households').attr('readonly','readonly');
	<?php if($is_stored == 'Y') echo "$('#bins_households').removeAttr('readonly','readonly');"; ?>
	$('.is_stored').on('change', function(){
		if($(this).val() == 'Y'){
			$('#bins_households').removeAttr('readonly','readonly');
		}else{
			$('#bins_households').attr('readonly','readonly');
			$('#bins_households').val('');
		}			
	});
	/* ------------------------------------------------------ */
	$('#bins_premises').attr('readonly','readonly');
	<?php if($is_stored == 'Y') echo "$('#bins_premises').removeAttr('readonly','readonly');"; ?>
	$('.is_stored').on('change', function(){
		if($(this).val() == 'Y'){
			$('#bins_premises').removeAttr('readonly','readonly');
		}else{
			$('#bins_premises').attr('readonly','readonly');
			$('#bins_premises').val('');
		}			
	});
	/* ------------------------------------------------------ */
	$('#is_segregated_details').attr('readonly','readonly');
	<?php if($is_segregated == 'Y') echo "$('#is_segregated_details').removeAttr('readonly','readonly');"; ?>
	$('.is_segregated').on('change', function(){
		if($(this).val() == 'Y'){
			$('#is_segregated_details').removeAttr('readonly','readonly');
		}else{
			$('#is_segregated_details').attr('readonly','readonly');
			$('#is_segregated_details').val('');
		}			
	});
	/* ------------------------------------------------------ */
	$('#d2d_ward').attr('readonly','readonly');
	<?php if($is_d2d == 'Y') echo "$('#d2d_ward').removeAttr('readonly','readonly');"; ?>
	$('.is_d2d').on('change', function(){
		if($(this).val() == 'Y'){
			$('#d2d_ward').removeAttr('readonly','readonly');
		}else{
			$('#d2d_ward').attr('readonly','readonly');
			$('#d2d_ward').val('');
		}			
	});
	/* ------------------------------------------------------ */
	$('#d2d_households').attr('readonly','readonly');
	<?php if($is_d2d == 'Y') echo "$('#d2d_households').removeAttr('readonly','readonly');"; ?>
	$('.is_d2d').on('change', function(){
		if($(this).val() == 'Y'){
			$('#d2d_households').removeAttr('readonly','readonly');
		}else{
			$('#d2d_households').attr('readonly','readonly');
			$('#d2d_households').val('');
		}			
	});
	/* ------------------------------------------------------ */
	$('#d2d_premises').attr('readonly','readonly');
	<?php if($is_d2d == 'Y') echo "$('#d2d_premises').removeAttr('readonly','readonly');"; ?>
	$('.is_d2d').on('change', function(){
		if($(this).val() == 'Y'){
			$('#d2d_premises').removeAttr('readonly','readonly');
		}else{
			$('#d2d_premises').attr('readonly','readonly');
			$('#d2d_premises').val('');
		}			
	});
	/* ------------------------------------------------------ */
	$('#d2d_vehicle').attr('readonly','readonly');
	<?php if($is_d2d == 'Y') echo "$('#d2d_vehicle').removeAttr('readonly','readonly');"; ?>
	$('.is_d2d').on('change', function(){
		if($(this).val() == 'Y'){
			$('#d2d_vehicle').removeAttr('readonly','readonly');
		}else{
			$('#d2d_vehicle').attr('readonly','readonly');
			$('#d2d_vehicle').val('');
		}			
	});
	/* ------------------------------------------------------ */   
	$('#d2d_handcart').attr('readonly','readonly');
	<?php if($is_d2d == 'Y') echo "$('#d2d_handcart').removeAttr('readonly','readonly');"; ?>
	$('.is_d2d').on('change', function(){
		if($(this).val() == 'Y'){
			$('#d2d_handcart').removeAttr('readonly','readonly');
		}else{
			$('#d2d_handcart').attr('readonly','readonly');
			$('#d2d_handcart').val('');
		}			
	});
	/* ------------------------------------------------------ */
	$('#d2d_other').attr('readonly','readonly');
	<?php if($is_d2d == 'Y') echo "$('#d2d_other').removeAttr('readonly','readonly');"; ?>
	$('.is_d2d').on('change', function(){
		if($(this).val() == 'Y'){
			$('#d2d_other').removeAttr('readonly','readonly');
		}else{
			$('#d2d_other').attr('readonly','readonly');
			$('#d2d_other').val('');
		}			
	});
	/* ------------------------------------------------------ */
	$('#d2d_method').attr('readonly','readonly');
	<?php if($is_d2d == 'N') echo "$('#d2d_method').removeAttr('readonly','readonly');"; ?>
	$('.is_d2d').on('change', function(){
		if($(this).val() == 'N'){
			$('#d2d_method').removeAttr('readonly','readonly');
		}else{
			$('#d2d_method').attr('readonly','readonly');
			$('#d2d_method').val('');
		}			
	});
	/* ------------------------------------------------------ */
	$('#d2d_sweep').attr('readonly','readonly');
	<?php if($is_d2d == 'N') echo "$('#d2d_sweep').removeAttr('readonly','readonly');"; ?>
	$('.is_d2d').on('change', function(){
		if($(this).val() == 'N'){
			$('#d2d_sweep').removeAttr('readonly','readonly');
		}else{
			$('#d2d_sweep').attr('readonly','readonly');
			$('#d2d_sweep').val('');
		}			
	});
	/* ------------------------------------------------------ */
	$('#number_green').attr('readonly','readonly');
	<?php if($is_facility == 'Y') echo "$('#number_green').removeAttr('readonly','readonly');"; ?>
	$('.is_facility').on('change', function(){
		if($(this).val() == 'Y'){
			$('#number_green').removeAttr('readonly','readonly');
		}else{
			$('#number_green').attr('readonly','readonly');
			$('#number_green').val('');
		}			
	});
	/* ------------------------------------------------------ */
	$('#number_blue').attr('readonly','readonly');
	<?php if($is_facility == 'Y') echo "$('#number_blue').removeAttr('readonly','readonly');"; ?>
	$('.is_facility').on('change', function(){
		if($(this).val() == 'Y'){
			$('#number_blue').removeAttr('readonly','readonly');
		}else{
			$('#number_blue').attr('readonly','readonly');
			$('#number_blue').val('');
		}			
	});
	/* ------------------------------------------------------ */
	$('#number_black').attr('readonly','readonly');
	<?php if($is_facility == 'Y') echo "$('#number_black').removeAttr('readonly','readonly');"; ?>
	$('.is_facility').on('change', function(){
		if($(this).val() == 'Y'){
			$('#number_black').removeAttr('readonly','readonly');
		}else{
			$('#number_black').attr('readonly','readonly');
			$('#number_black').val('');
		}			
	});
	/* ------------------------------------------------------ */
	$('#lifting_specify').attr('readonly','readonly');
	<?php if($lifting_transport == 'Y') echo "$('#lifting_specify').removeAttr('readonly','readonly');"; ?>
	$('.lifting_transport').on('change', function(){
		if($(this).val() == 'Y'){
			$('#lifting_specify').removeAttr('readonly','readonly');
		}else{
			$('#lifting_specify').attr('readonly','readonly');
			$('#lifting_specify').val('');
		}			
	});
	/* ------------------------------------------------------ */
	$('#waste_process_qty').attr('readonly','readonly');
	<?php if($waste_process == 'Y') echo "$('#waste_process_qty').removeAttr('readonly','readonly');"; ?>
	$('.waste_process').on('change', function(){
		if($(this).val() == 'Y'){
			$('#waste_process_qty').removeAttr('readonly','readonly');
		}else{
			$('#waste_process_qty').attr('readonly','readonly');
			$('#waste_process_qty').val('');
		}			
	});
	/* ------------------------------------------------------ */
	$('#others_s_details').attr('readonly','readonly');
	<?php if($others_s == 'Y') echo "$('#others_s_details').removeAttr('readonly','readonly');"; ?>
	$('.others_s').on('change', function(){
		if($(this).val() == 'Y'){
			$('#others_s_details').removeAttr('readonly','readonly');
		}else{
			$('#others_s_details').attr('readonly','readonly');
			$('#others_s_details').val('');
		}			
	});
	/* ------------------------------------------------------ */
	$('#others_t_details').attr('readonly','readonly');
	<?php if($others_t == 'N') echo "$('#others_t_details').removeAttr('readonly','readonly');"; ?>
	$('.others_t').on('change', function(){
		if($(this).val() == 'N'){
			$('#others_t_details').removeAttr('readonly','readonly');
		}else{
			$('#others_t_details').attr('readonly','readonly');
			$('#others_t_details').val('');
		}			
	});	
</script>