<?php  require_once "../../requires/login_session.php";
$dept="factory";
$form="16";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__); 
include "save_form2.php";
	
$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
if($q->num_rows<1){
	$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
	if($p->num_rows>0){
		$results=$p->fetch_array();	
		$form_id=$results["form_id"];
		$week_end=$results['week_end'];$serial_no=$results['serial_no'];$nature=$results['nature'];$group_no=$results['group_no'];$transfers=$results['transfers'];$holidays=$results['holidays'];$lost_day=$results['lost_day'];$remarks=$results['remarks'];
		if(!empty($results["worker"])){
			$worker=json_decode($results["worker"]);
			$worker_name=$worker->name;$worker_sn1=$worker->sn1;$worker_sn2=$worker->sn2;$worker_vill=$worker->vill;$worker_dist=$worker->dist;$worker_pin=$worker->pin;$worker_mobile=$worker->mobile;
		}else{
			$worker_name="";$worker_sn1="";$worker_sn2="";$worker_vill="";$worker_dist="";$worker_pin="";$worker_mobile="";
		}
		if(!empty($results["in1"])){
			$in1=json_decode($results["in1"]);			
			$in1_sun=$in1->sun;$in1_mon=$in1->mon;$in1_tue=$in1->tue;$in1_wed=$in1->wed;$in1_thur=$in1->thur;$in1_fri=$in1->fri;$in1_sat=$in1->sat;
		}else{
			$in1_sun="";$in1_mon="";$in1_tue="";$in1_wed="";$in1_thur="";$in1_fri="";$in1_sat="";
		}
		if(!empty($results["in2"])){
			$in2=json_decode($results["in2"]);			
			$in2_sun=$in2->sun;$in2_mon=$in2->mon;$in2_tue=$in2->tue;$in2_wed=$in2->wed;$in2_thur=$in2->thur;$in2_fri=$in2->fri;$in2_sat=$in2->sat;
		}else{
			$in2_sun="";$in2_mon="";$in2_tue="";$in2_wed="";$in2_thur="";$in2_fri="";$in2_sat="";
		}
		if(!empty($results["in3"])){
			$in3=json_decode($results["in3"]);			
			$in3_sun=$in3->sun;$in3_mon=$in3->mon;$in3_tue=$in3->tue;$in3_wed=$in3->wed;$in3_thur=$in3->thur;$in3_fri=$in3->fri;$in3_sat=$in3->sat;
		}else{
			$in3_sun="";$in3_mon="";$in3_tue="";$in3_wed="";$in3_thur="";$in3_fri="";$in3_sat="";
		}
		if(!empty($results["in4"])){
			$in4=json_decode($results["in4"]);			
			$in4_sun=$in4->sun;$in4_mon=$in4->mon;$in4_tue=$in4->tue;$in4_wed=$in4->wed;$in4_thur=$in4->thur;$in4_fri=$in4->fri;$in4_sat=$in4->sat;
		}else{
			$in4_sun="";$in4_mon="";$in4_tue="";$in4_wed="";$in4_thur="";$in4_fri="";$in4_sat="";
		}
		if(!empty($results["out1"])){
			$out1=json_decode($results["out1"]);			
			$out1_sun=$out1->sun;$out1_mon=$out1->mon;$out1_tue=$out1->tue;$out1_wed=$out1->wed;$out1_thur=$out1->thur;$out1_fri=$out1->fri;$out1_sat=$out1->sat;
		}else{
			$out1_sun="";$out1_mon="";$out1_tue="";$out1_wed="";$out1_thur="";$out1_fri="";$out1_sat="";
		}
		if(!empty($results["out2"])){
			$out2=json_decode($results["out2"]);			
			$out2_sun=$out2->sun;$out2_mon=$out2->mon;$out2_tue=$out2->tue;$out2_wed=$out2->wed;$out2_thur=$out2->thur;$out2_fri=$out2->fri;$out2_sat=$out2->sat;
		}else{
			$out2_sun="";$out2_mon="";$out2_tue="";$out2_wed="";$out2_thur="";$out2_fri="";$out2_sat="";
		}
		if(!empty($results["out3"])){
			$out3=json_decode($results["out3"]);			
			$out3_sun=$out3->sun;$out3_mon=$out3->mon;$out3_tue=$out3->tue;$out3_wed=$out3->wed;$out3_thur=$out3->thur;$out3_fri=$out3->fri;$out3_sat=$out3->sat;
		}else{
			$out3_sun="";$out3_mon="";$out3_tue="";$out3_wed="";$out3_thur="";$out3_fri="";$out3_sat="";
		}
		if(!empty($results["out4"])){
			$out4=json_decode($results["out4"]);			
			$out4_sun=$out4->sun;$out4_mon=$out4->mon;$out4_tue=$out4->tue;$out4_wed=$out4->wed;$out4_thur=$out4->thur;$out4_fri=$out4->fri;$out4_sat=$out4->sat;
		}else{
			$out4_sun="";$out4_mon="";$out4_tue="";$out4_wed="";$out4_thur="";$out4_fri="";$out4_sat="";
		}		
	}else{
		$form_id="";
		$week_end="";$serial_no="";$nature="";$group_no="";$transfers="";$holidays="";$lost_day="";$remarks="";
		$worker_name="";$worker_sn1="";$worker_sn2="";$worker_vill="";$worker_dist="";$worker_pin="";$worker_mobile="";
		$in1_sun="";$in1_mon="";$in1_tue="";$in1_wed="";$in1_thur="";$in1_fri="";$in1_sat="";
		$in2_sun="";$in2_mon="";$in2_tue="";$in2_wed="";$in2_thur="";$in2_fri="";$in2_sat="";
		$in3_sun="";$in3_mon="";$in3_tue="";$in3_wed="";$in3_thur="";$in3_fri="";$in3_sat="";
		$in4_sun="";$in4_mon="";$in4_tue="";$in4_wed="";$in4_thur="";$in4_fri="";$in4_sat="";
		$out1_sun="";$out1_mon="";$out1_tue="";$out1_wed="";$out1_thur="";$out1_fri="";$out1_sat="";
		$out2_sun="";$out2_mon="";$out2_tue="";$out2_wed="";$out2_thur="";$out2_fri="";$out2_sat="";
		$out3_sun="";$out3_mon="";$out3_tue="";$out3_wed="";$out3_thur="";$out3_fri="";$out3_sat="";
		$out4_sun="";$out4_mon="";$out4_tue="";$out4_wed="";$out4_thur="";$out4_fri="";$out4_sat="";
	}
}else{	
	$results=$q->fetch_array();
	$form_id=$results["form_id"];
	$week_end=$results['week_end'];$serial_no=$results['serial_no'];$nature=$results['nature'];$group_no=$results['group_no'];$transfers=$results['transfers'];$holidays=$results['holidays'];$lost_day=$results['lost_day'];$remarks=$results['remarks'];
	if(!empty($results["worker"])){
		$worker=json_decode($results["worker"]);
		$worker_name=$worker->name;$worker_sn1=$worker->sn1;$worker_sn2=$worker->sn2;$worker_vill=$worker->vill;$worker_dist=$worker->dist;$worker_pin=$worker->pin;$worker_mobile=$worker->mobile;
	}else{
		$worker_name="";$worker_sn1="";$worker_sn2="";$worker_vill="";$worker_dist="";$worker_pin="";$worker_mobile="";
	}
	if(!empty($results["in1"])){
		$in1=json_decode($results["in1"]);			
		$in1_sun=$in1->sun;$in1_mon=$in1->mon;$in1_tue=$in1->tue;$in1_wed=$in1->wed;$in1_thur=$in1->thur;$in1_fri=$in1->fri;$in1_sat=$in1->sat;
	}else{
		$in1_sun="";$in1_mon="";$in1_tue="";$in1_wed="";$in1_thur="";$in1_fri="";$in1_sat="";
	}
	if(!empty($results["in2"])){
		$in2=json_decode($results["in2"]);			
		$in2_sun=$in2->sun;$in2_mon=$in2->mon;$in2_tue=$in2->tue;$in2_wed=$in2->wed;$in2_thur=$in2->thur;$in2_fri=$in2->fri;$in2_sat=$in2->sat;
	}else{
		$in2_sun="";$in2_mon="";$in2_tue="";$in2_wed="";$in2_thur="";$in2_fri="";$in2_sat="";
	}
	if(!empty($results["in3"])){
		$in3=json_decode($results["in3"]);			
		$in3_sun=$in3->sun;$in3_mon=$in3->mon;$in3_tue=$in3->tue;$in3_wed=$in3->wed;$in3_thur=$in3->thur;$in3_fri=$in3->fri;$in3_sat=$in3->sat;
	}else{
		$in3_sun="";$in3_mon="";$in3_tue="";$in3_wed="";$in3_thur="";$in3_fri="";$in3_sat="";
	}
	if(!empty($results["in4"])){
		$in4=json_decode($results["in4"]);			
		$in4_sun=$in4->sun;$in4_mon=$in4->mon;$in4_tue=$in4->tue;$in4_wed=$in4->wed;$in4_thur=$in4->thur;$in4_fri=$in4->fri;$in4_sat=$in4->sat;
	}else{
		$in4_sun="";$in4_mon="";$in4_tue="";$in4_wed="";$in4_thur="";$in4_fri="";$in4_sat="";
	}
	if(!empty($results["out1"])){
		$out1=json_decode($results["out1"]);			
		$out1_sun=$out1->sun;$out1_mon=$out1->mon;$out1_tue=$out1->tue;$out1_wed=$out1->wed;$out1_thur=$out1->thur;$out1_fri=$out1->fri;$out1_sat=$out1->sat;
	}else{
		$out1_sun="";$out1_mon="";$out1_tue="";$out1_wed="";$out1_thur="";$out1_fri="";$out1_sat="";
	}
	if(!empty($results["out2"])){
		$out2=json_decode($results["out2"]);			
		$out2_sun=$out2->sun;$out2_mon=$out2->mon;$out2_tue=$out2->tue;$out2_wed=$out2->wed;$out2_thur=$out2->thur;$out2_fri=$out2->fri;$out2_sat=$out2->sat;
	}else{
		$out2_sun="";$out2_mon="";$out2_tue="";$out2_wed="";$out2_thur="";$out2_fri="";$out2_sat="";
	}
	if(!empty($results["out3"])){
		$out3=json_decode($results["out3"]);			
		$out3_sun=$out3->sun;$out3_mon=$out3->mon;$out3_tue=$out3->tue;$out3_wed=$out3->wed;$out3_thur=$out3->thur;$out3_fri=$out3->fri;$out3_sat=$out3->sat;
	}else{
		$out3_sun="";$out3_mon="";$out3_tue="";$out3_wed="";$out3_thur="";$out3_fri="";$out3_sat="";
	}
	if(!empty($results["out4"])){
		$out4=json_decode($results["out4"]);			
		$out4_sun=$out4->sun;$out4_mon=$out4->mon;$out4_tue=$out4->tue;$out4_wed=$out4->wed;$out4_thur=$out4->thur;$out4_fri=$out4->fri;$out4_sat=$out4->sat;
	}else{
		$out4_sun="";$out4_mon="";$out4_tue="";$out4_wed="";$out4_thur="";$out4_fri="";$out4_sat="";
	}
}
?>

<?php require_once "../../requires/header.php";   ?>
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
							<div id="table1" class="tab-pane" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table id="" class="table table-responsive">
										<tr>
											<td width="25%">Name of factory : </td>
											<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $unit_name; ?>"></td>
											<td width="25%">Week ending : </td>
											<td width="25%"><input type="date" class="dob form-control" name="week_end" value="<?php echo $week_end; ?>"></td>
										</tr>
										<tr>
											<td>1. Serial No. : </td>
											<td><input type="text" class="form-control text-uppercase" name="serial_no" value="<?php echo $serial_no; ?>"></td>
											<td>2. Name of the worker : </td>
											<td><input type="text" class="form-control text-uppercase" name="worker[name]" value="<?php echo $worker_name; ?>"></td>	
										</tr>
										<tr>
											<td colspan="4">3. Residential Address of the Worker : </td>
										</tr>
										<tr>
											<td>Street Name 1 : </td>
											<td><input type="text" class="form-control text-uppercase" name="worker[sn1]" value="<?php echo $worker_sn1; ?>"></td>
											<td>Street Name 2 : </td>
											<td><input type="text" class="form-control text-uppercase" name="worker[sn2]" value="<?php echo $worker_sn2; ?>"></td>
										</tr>
										<tr>
											<td>Village/Town : </td>
											<td><input type="text" class="form-control text-uppercase" name="worker[vill]" value="<?php echo $worker_vill; ?>"></td>
											<td>District : </td>
											<td><input type="text" class="form-control text-uppercase" name="worker[dist]" value="<?php echo $worker_dist; ?>"></td>
										</tr>
										<tr>
											<td>Pin Code : </td>
											<td><input type="text" class="form-control text-uppercase" name="worker[pin]" value="<?php echo $worker_pin; ?>" validate="pincode" maxlength="6"></td>
											<td>Mobile No. : </td>
											<td><input type="text" class="form-control text-uppercase" name="worker[mobile]" value="<?php echo $worker_mobile; ?>" validate="mobileNumber" maxlength="10"></td>
										</tr>																					
										<tr>
											<td>4. Nature of work : </td>
											<td><input type="text" class="form-control text-uppercase" name="nature" value="<?php echo $nature; ?>"></td>
											<td>5. Group Number : </td>
											<td><input type="text" class="form-control text-uppercase" name="group_no" value="<?php echo $group_no; ?>"></td>
										</tr>	
										<tr>
											<td colspan="4">6. Period of Work : </td>
										</tr>
										<tr>
											<td colspan="4">
											<table class="table table-responsive table-bordered text-center">
												<thead>
													<tr>
														<th colspan="15">Actual times of starting and stopping for each period </th>
													</tr>
													<tr>
														<th rowspan="2"></th>
														<th colspan="2">Sunday </th>
														<th colspan="2">Monday </th>
														<th colspan="2">Tuesday </th>
														<th colspan="2">Wednesday </th>
														<th colspan="2">Thursday </th>
														<th colspan="2">Friday </th>
														<th colspan="2">Saturday </th>
													</tr>
													<tr>
														<th>In </th>
														<th>Out </th>
														<th>In </th>
														<th>Out </th>
														<th>In </th>
														<th>Out </th>
														<th>In </th>
														<th>Out </th>
														<th>In </th>
														<th>Out </th>
														<th>In </th>
														<th>Out </th>
														<th>In </th>
														<th>Out </th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>1st </td>
														<td><input type="text" class="form-control text-uppercase" name="in1[sun]" value="<?php echo $in1_sun; ?>"></td>
														<td><input type="text" class="form-control text-uppercase" name="out1[sun]" value="<?php echo $out1_sun; ?>"></td>
														<td><input type="text" class="form-control text-uppercase" name="in1[mon]" value="<?php echo $in1_mon; ?>"></td>
														<td><input type="text" class="form-control text-uppercase" name="out1[mon]" value="<?php echo $out1_mon; ?>"></td>
														<td><input type="text" class="form-control text-uppercase" name="in1[tue]" value="<?php echo $in1_tue; ?>"></td>
														<td><input type="text" class="form-control text-uppercase" name="out1[tue]" value="<?php echo $out1_tue; ?>"></td>
														<td><input type="text" class="form-control text-uppercase" name="in1[wed]" value="<?php echo $in1_wed; ?>"></td>
														<td><input type="text" class="form-control text-uppercase" name="out1[wed]" value="<?php echo $out1_wed; ?>"></td>
														<td><input type="text" class="form-control text-uppercase" name="in1[thur]" value="<?php echo $in1_thur; ?>"></td>
														<td><input type="text" class="form-control text-uppercase" name="out1[thur]" value="<?php echo $out1_thur; ?>"></td>
														<td><input type="text" class="form-control text-uppercase" name="in1[fri]" value="<?php echo $in1_fri; ?>"></td>
														<td><input type="text" class="form-control text-uppercase" name="out1[fri]" value="<?php echo $out1_fri; ?>"></td>
														<td><input type="text" class="form-control text-uppercase" name="in1[sat]" value="<?php echo $in1_sat; ?>"></td>
														<td><input type="text" class="form-control text-uppercase" name="out1[sat]" value="<?php echo $out1_sat; ?>"></td>
													</tr>
													<tr>
														<td>2nd </td>
														<td><input type="text" class="form-control text-uppercase" name="in2[sun]" value="<?php echo $in2_sun; ?>"></td>
														<td><input type="text" class="form-control text-uppercase" name="out2[sun]" value="<?php echo $out2_sun; ?>"></td>
														<td><input type="text" class="form-control text-uppercase" name="in2[mon]" value="<?php echo $in2_mon; ?>"></td>
														<td><input type="text" class="form-control text-uppercase" name="out2[mon]" value="<?php echo $out2_mon; ?>"></td>
														<td><input type="text" class="form-control text-uppercase" name="in2[tue]" value="<?php echo $in2_tue; ?>"></td>
														<td><input type="text" class="form-control text-uppercase" name="out2[tue]" value="<?php echo $out2_tue; ?>"></td>
														<td><input type="text" class="form-control text-uppercase" name="in2[wed]" value="<?php echo $in2_wed; ?>"></td>
														<td><input type="text" class="form-control text-uppercase" name="out2[wed]" value="<?php echo $out2_wed; ?>"></td>
														<td><input type="text" class="form-control text-uppercase" name="in2[thur]" value="<?php echo $in2_thur; ?>"></td>
														<td><input type="text" class="form-control text-uppercase" name="out2[thur]" value="<?php echo $out2_thur; ?>"></td>
														<td><input type="text" class="form-control text-uppercase" name="in2[fri]" value="<?php echo $in2_fri; ?>"></td>
														<td><input type="text" class="form-control text-uppercase" name="out2[fri]" value="<?php echo $out2_fri; ?>"></td>
														<td><input type="text" class="form-control text-uppercase" name="in2[sat]" value="<?php echo $in2_sat; ?>"></td>
														<td><input type="text" class="form-control text-uppercase" name="out2[sat]" value="<?php echo $out2_sat; ?>"></td>
													</tr>
													<tr>
														<td>3rd </td>
														<td><input type="text" class="form-control text-uppercase" name="in3[sun]" value="<?php echo $in3_sun; ?>"></td>
														<td><input type="text" class="form-control text-uppercase" name="out3[sun]" value="<?php echo $out3_sun; ?>"></td>
														<td><input type="text" class="form-control text-uppercase" name="in3[mon]" value="<?php echo $in3_mon; ?>"></td>
														<td><input type="text" class="form-control text-uppercase" name="out3[mon]" value="<?php echo $out3_mon; ?>"></td>
														<td><input type="text" class="form-control text-uppercase" name="in3[tue]" value="<?php echo $in3_tue; ?>"></td>
														<td><input type="text" class="form-control text-uppercase" name="out3[tue]" value="<?php echo $out3_tue; ?>"></td>
														<td><input type="text" class="form-control text-uppercase" name="in3[wed]" value="<?php echo $in3_wed; ?>"></td>
														<td><input type="text" class="form-control text-uppercase" name="out3[wed]" value="<?php echo $out3_wed; ?>"></td>
														<td><input type="text" class="form-control text-uppercase" name="in3[thur]" value="<?php echo $in3_thur; ?>"></td>
														<td><input type="text" class="form-control text-uppercase" name="out3[thur]" value="<?php echo $out3_thur; ?>"></td>
														<td><input type="text" class="form-control text-uppercase" name="in3[fri]" value="<?php echo $in3_fri; ?>"></td>
														<td><input type="text" class="form-control text-uppercase" name="out3[fri]" value="<?php echo $out3_fri; ?>"></td>
														<td><input type="text" class="form-control text-uppercase" name="in3[sat]" value="<?php echo $in3_sat; ?>"></td>
														<td><input type="text" class="form-control text-uppercase" name="out3[sat]" value="<?php echo $out3_sat; ?>"></td>
													</tr>
													<tr>
														<td>4th </td>
														<td><input type="text" class="form-control text-uppercase" name="in4[sun]" value="<?php echo $in4_sun; ?>"></td>
														<td><input type="text" class="form-control text-uppercase" name="out4[sun]" value="<?php echo $out4_sun; ?>"></td>
														<td><input type="text" class="form-control text-uppercase" name="in4[mon]" value="<?php echo $in4_mon; ?>"></td>
														<td><input type="text" class="form-control text-uppercase" name="out4[mon]" value="<?php echo $out4_mon; ?>"></td>
														<td><input type="text" class="form-control text-uppercase" name="in4[tue]" value="<?php echo $in4_tue; ?>"></td>
														<td><input type="text" class="form-control text-uppercase" name="out4[tue]" value="<?php echo $out4_tue; ?>"></td>
														<td><input type="text" class="form-control text-uppercase" name="in4[wed]" value="<?php echo $in4_wed; ?>"></td>
														<td><input type="text" class="form-control text-uppercase" name="out4[wed]" value="<?php echo $out4_wed; ?>"></td>
														<td><input type="text" class="form-control text-uppercase" name="in4[thur]" value="<?php echo $in4_thur; ?>"></td>
														<td><input type="text" class="form-control text-uppercase" name="out4[thur]" value="<?php echo $out4_thur; ?>"></td>
														<td><input type="text" class="form-control text-uppercase" name="in4[fri]" value="<?php echo $in4_fri; ?>"></td>
														<td><input type="text" class="form-control text-uppercase" name="out4[fri]" value="<?php echo $out4_fri; ?>"></td>
														<td><input type="text" class="form-control text-uppercase" name="in4[sat]" value="<?php echo $in4_sat; ?>"></td>
														<td><input type="text" class="form-control text-uppercase" name="out4[sat]" value="<?php echo $out4_sat; ?>"></td>
													</tr>
												</tbody>
											</table>
											</td>
										</tr>
										<tr>
											<td>7. Record of Transfers from one group to another : </td>
											<td><input type="text" class="form-control text-uppercase" name="transfers" value="<?php echo $transfers; ?>"></td>
											<td>8. Progressive total of compensatory holidays : </td>
											<td><input type="text" class="form-control text-uppercase" name="holidays" value="<?php echo $holidays; ?>"></td>
										</tr>
										<tr>
											<td>9. Progressive total of lost rest day : </td>
											<td><input type="text" class="form-control text-uppercase" name="lost_day" value="<?php echo $lost_day; ?>"></td>
											<td>10. Remarks : </td>
											<td><input type="text" class="form-control text-uppercase" name="remarks" value="<?php echo $remarks; ?>"></td>
										</tr>											
										<tr>
											<td colspan="2">Date : <strong><?php echo date('d-m-Y',strtotime($today)); ?></strong></td>
											<td colspan="2" align="right">Signature : <strong><?php echo $key_person; ?></strong></td>
										</tr>										
										<tr>										
											<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you want to save the form ?')" >Save & Next</button>
											</td>									
										</tr>
									</table>
								</form>
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
</script>