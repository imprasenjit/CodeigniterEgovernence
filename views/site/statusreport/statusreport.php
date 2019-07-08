<?php 
	$master_array=array();
	$resultArray=$this->statusReport_model->getAllOnlineDepartment();
	
	foreach($resultArray as $result) {
		$tab_list               = $data_array = explode(',', $result['form_tables']);
		$dept_data              = $this->statusReport_model->get_record_data($result['dept_code'], $tab_list);
		
		$dept_data['dept_name'] = $result['name'];
		$dept_data['dept_code'] = $result['dept_code'];
		array_push($master_array, $dept_data);
	}
?><br><br><br><br><br>
<div class="container-fluid">
	<section class="col-md-12">
		<div class="">
			<h3 class="welcomeText text-center text-uppercase">APPLICATIONS STATUS FOR ALL DEPARTMENTS</h3><br/>
		</div>
	</section>
	<section>
		<div class="row">
			<div class="col-md-12">
				<p class="text-center"></p>
			</div>
			<!-- DEPARTMENT ONLINE BLOCK START -->
			<div class="col-md-3 col-sm-6 col-xs-12" style="width:20%">
				<div class="small-box bg-aqua">
					<div class="inner">
						<h3 class="timer-b">35</h3>
						<p class="text-bold" style="font-size:22px">Departments Online</p>
					</div>
					<div class="icon">
						<i class="fa fa-files-o"></i>
					</div>
				</div>
			</div>
			<!-- CLOSE BLOCK -->
			<!-- 1.TOTAL ONLINE SERVICES BLOCK START -->
			<div class="col-md-2 col-sm-6 col-xs-12" style="width:20%">
				<div class="small-box bg-orange">
					<div class="inner">
						<h3 class="timer-c">360</h3>
						<p class="text-bold" style="font-size:22px">Online Services</p>
					</div>
					<div class="icon">
						<i class="fa fa-tv"></i>
					</div>
				</div>
			</div>
			<!-- CLOSE BLOCK -->
			<!-- 2.USER REGITRATION BLOCK START -->
			<div class="col-md-3 col-sm-6 col-xs-12" style="width:20%">
				<div class="small-box bg-green">
					<div class="inner">
						<h3 class="timer-d"><?php echo $total_user_registered=$this->statusReport_model->getTotalCAF();?></h3>
						<p class="text-bold" style="font-size:22px">Registered Users</p>
					</div>
					<div class="icon">
						<i class="fa fa-user"></i>
					</div>
				</div>
			</div>
			<!-- CLOSE BLOCK -->
			<!-- 3.COMMON APPLICATION BLOCK START -->
			<div class="col-md-2 col-sm-6 col-xs-12" style="width:20%">
				<div class="small-box bg-red">
					<div class="inner">
						<h3 class="timer-e"><?php echo $application_received=$this->statusReport_model->getApplicationReceived();?></h3>
						<p class="text-bold" style="font-size:22px">Common Application Forms</p>
					</div>
					<div class="icon">
						<i class="fa fa-check-square"></i>
					</div>
				</div>
			</div>
			<!-- CLOSE BLOCK -->
			<div class="col-md-2 col-sm-6 col-xs-12" style="width:20%">
				<div class="small-box bg-purple">
					<div class="inner">
						<h3 class="timer-f"><?php  echo $application_received=$this->statusReport_model->getApplicationReceived();?></h3>
						<p class="text-bold" style="font-size:22px">Applications Received</p>
					</div>
					<div class="icon">
						<i class="fa fa-envelope-o"></i>
					</div>
				</div>
			</div>
		</div>
		<!-- ALL DEPARTMENT ONLINE FORM STATUS GRAPH -->
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="box box-primary">
					<div class="box-header with-border">
						<div class="col-md-6 col-md-offset-3"> <h3 class="box-title text-center"><i class="fa fa-status"></i> Online Application Form Status</h3></div>
						<div class="col-md-3" style="padding-right: 0;"><span class="pull-right"><a href="<?php echo base_url(); ?>status2.php" target="_blank" class="btn btn-md btn-warning" style="font-size:20px" type="button"><i class="fa fa-pie-chart"></i> View Info-graphics</a></span></div>               
						<div class="box-tools pull-right">
							<div class="btn-group pull-left" style=" padding: 10px 0px;">
								<div class="dropdown">                            
									<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownExport" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
										<span class="glyphicon glyphicon-th-list"></span> Export
									</button>
									<ul class="dropdown-menu" aria-labelledby="dropdownExport">
										<li><a href=javascript:void(0) onclick="$('#export_table').tableExport({type: 'excel', escape: 'false'});">XLS</a></li>
										<li><a href="<?php echo base_url(); ?>status_report_to_pdf.php" target="_blank"> PDF</a></li>
									</ul>
								</div><!--End of .dropdown-->
							</div><!--End of .btn-group-->
						</div>
					</div>
					<div class="box-body">
                        <table class="table table-hover table-responsive table-bordered" id="export_table">
							<thead>
								<tr class="success">
									<th>Department Name</th>
									<th>Total Applications</th>
									<th>New</th>
									<th>Under Process</th>
									<th>Under Query</th>
									<th>Approved</th>
									<th>Rejected</th>
									<th>District wise Report</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$j = 1;
									foreach ($master_array as $key => $value) {   
										if ($value['total'] != 0) {
										?> 
										<tr>
											<td><h5><?php echo $value['dept_name'];?></h5></td>
											<td><h5><?php echo $value['total'];?></h5></td>
											<td><h5><?php echo ($value['total']-($value['total_underprocess']+$value['total_underquery']+$value['total_approved']+$value['total_rejected']));?></h5></td>
											<td><h5><?php echo $value['total_underprocess'];?></h5></td>
											<td><h5><?php echo $value['total_underquery'];?></h5></td>
											<td><h5><?php echo $value['total_approved'];?></h5></td>
											<td><h5><?php echo $value['total_rejected'];?></h5></td>
											<td><h5><a href="dist_report.php?id=<?php echo $value['dept_code'];?>" target="_blank">View</a></h5></td>
										</tr>
										<?php
										}
									}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<!-- CLOSE GRAPH -->
	</div>
	<div class="container-fluid">
		<div class="row">
		</div>
		<!-- INDIVIDUAL ALL DEPARTMENT STATUS REPORT GRAPH  -->
		<!-- CLOSE INDIVIDUAL GRAPH -->
	</section>
</div>
</div>	

<script type="text/javascript" src="<?= base_url();?>dist/tableExport/tableExport.js"></script>
<script type="text/javascript" src="<?= base_url();?>dist/tableExport/jquery.base64.js"></script>
<script type="text/javascript" src="<?= base_url();?>dist/tableExport/html2canvas.js"></script>
<script type="text/javascript" src="<?= base_url();?>dist/tableExport/jspdf/libs/sprintf.js"></script>
<script type="text/javascript" src="<?= base_url();?>dist/tableExport/jspdf/jspdf.js"></script>
<script type="text/javascript" src="<?= base_url();?>dist/tableExport/jspdf/libs/base64.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$(document).on("click",".toexcel",function() {
			$("#export_table").table2excel();
		}); // End of on click()
		$(document).on("click",".topdf",function() {
			doc.fromHTML($("#export_table").html(), 15, 15, {
				"width": 170,
                "elementHandlers": specialElementHandlers
			});
			doc.save("reports.pdf");
		});
	});
	</script>	