<?php require_once "../../requires/login_session.php";
if(isset($_GET['transit_id'])){
	$transit_id=$_GET['transit_id'];
}else{
	echo "<script>
		alert('Something went wrong !!!');
		window.location.href = 'transit_pass.php';
	</script>";
}
	$se="SELECT * FROM transit_pass WHERE id='$transit_id'";
	$exec_se=$formFunctions->executeQuery("forest",$se);
	if($exec_se->num_rows>0){
		$row=$exec_se->fetch_array();
		$ref_uain=$row["ref_uain"];$permit_no=$row["permit_no"];$permit_date=$row["permit_date"];$locality_whence_collected=$row["locality_whence_collected"];$transported_place=$row["transported_place"];$destination=$row["destination"];$transport_route=$row["transport_route"];$transport_date=$row["transport_date"];$expire_date=$row["expire_date"];
	}
	
	$se2=$mysqli->query("select a.ubin,a.Key_person,a.status_applicant,a.Type_of_ownership,a.Name,a.b_street_name1,a.b_street_name2,a.b_vill,a.b_dist,b.sector_classes_b, b.revenue from singe_window_registration a,singe_window_registration_part1 b where a.id='$swr_id' and b.swr_id='$swr_id'") OR die("Error : ".$mysqli->error);
	
	$row2=$se2->fetch_object();
	$ubin=$row2->ubin;
			
	$trade_name=$row2->Name;
	$key_person=$row2->Key_person;
	$street_name1=$row2->b_street_name1;
	$street_name2=$row2->b_street_name2;
	$vill=$row2->b_vill;
	$dist=$row2->b_dist;
	$address=$street_name1.",".$street_name2.",".$vill.",".$dist;
	$revenue=$row2->revenue;
	
	$t_query="SELECT * FROM forest_form2_t1 a, transit_pass_transported_trees b WHERE a.id=b.species_id AND b.transit_id='$transit_id'";
	$exec_t_query=$formFunctions->executeQuery("forest",$t_query);
	if($exec_t_query->num_rows==0){
		echo "<script>
				alert('No tree selected !!!');
				window.location.href = 'transit_pass.php';
			</script>";
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Ease of doing business | Govt. of Assam</title>
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<?php  require '../../../admin/includes/css.php';?>
	<style>

	.details{
				  text-decoration: underline;
				  font-family:lucidacalligraphy,areal,sans-serif,Lohit-Assamese;
				  font-size:1.2em;
				  line-height:45px;
				  font-weight:400;
	}
	.font1{
				font-family:sans-serif;
				font-size:1.1em;
				font-weight:400;
	}
	</style>
	</head>
	<body>
		<div class="container">
			<center>	
			<div align="center" style="padding: 10px 30px;width:85%; border:2px solid black;">
			
				<h3 class="text-uppercase">TRANSIT PASS</h3>
				<h4><b>FOREST DEPARTMENT, ASSAM</b></h4>
				<br/>
				<p align="justify"><?=($dist) ? strtoupper($dist) : "NOT FOUND"?> Division <?=($revenue) ? $revenue : "NOT FOUND"?> Revenue Circle</p>
				<br/>
				<p align="justify">1. Name and residence of the passholder :<br/>
					<?=($key_person) ? strtoupper($key_person) : "NOT FOUND"?>
				<br/>
					<?=($address) ? strtoupper($address) : "NOT FOUND"?>
				</p>
				<p align="justify">2. Number and date of permit or Certificate of Origin :<br/>
				Number : <?=($permit_no) ? strtoupper($permit_no) : "NOT FOUND"?>
				<br/>
				Date : <?=($permit_date) ? strtoupper($permit_date) : "NOT FOUND"?>
				</p>
				<table width="100%" align="center" class="table table-bordered table-responsive text-center" style="margin:0px auto;border-collapse: collapse" border="1">
					<thead>
						<tr>
							<th>3. Kind of forest produce</th>
							<th>4. Number of pieces packages or bundles</th>
							<th>5. Measurement Cubic consents or weight</th>
							<th>6. Marks hammar or Other</th>
							<th>7. Rate</th>
							<th>8. Amount Paid</th>
						</tr>
					</thead>
					<?php 
						$t_query="SELECT * FROM forest_form2_t1 a, transit_pass_transported_trees b WHERE a.id=b.species_id AND b.transit_id='$transit_id'";
						$exec_t_query=$formFunctions->executeQuery("forest",$t_query);
						if($exec_t_query->num_rows>0){
							while($row_1=$exec_t_query->fetch_array()){
					?>
					<tbody>
						<tr>
							<td><?=($row_1["species"]) ? strtoupper($row_1["species"]) : "NOT FOUND"?></td>
							<td><?=($row_1["piece_no"]) ? strtoupper($row_1["piece_no"]) : "NOT FOUND"?></td>
							<td><?=($row_1["measurement"]) ? strtoupper($row_1["measurement"]) : "NOT FOUND"?></td>
							<td><?=($row_1["hammer_mark"]) ? strtoupper($row_1["hammer_mark"]) : "NOT FOUND"?></td>
							<td><?=($row_1["rate"]) ? strtoupper($row_1["rate"]) : "NOT FOUND"?></td>
							<td><?=($row_1["amount_paid"]) ? strtoupper($row_1["amount_paid"]) : "NOT FOUND"?></td>
						</tr>
					</tbody>
					<?php
							}
						}
					?>
				</table>
				<p align="justify">9. Locality Whence collected : <?=($locality_whence_collected) ? strtoupper($locality_whence_collected) : "NOT FOUND"?></p>
				<p align="justify">10. Place From which to be transported : <?=($transported_place) ? strtoupper($transported_place) : "NOT FOUND"?></p>
				<p align="justify">11. Destination : <?=($destination) ? strtoupper($destination) : "NOT FOUND"?></p>
				<p align="justify">12. Route Of Transport : <?=($transport_route) ? strtoupper($transport_route) : "NOT FOUND"?></p>
				<p align="justify">13. Date of transportation : <?=($transport_date) ? strtoupper($transport_date) : "NOT FOUND"?></p>
				<p align="justify">14. Date of Expiry : <?=($expire_date) ? strtoupper($expire_date) : "NOT FOUND"?></p>
				<br/>
				<table width="100%">
					<tr>	
						<td width="50%"></td>
						<td align="right"><center>Signature and Designation of the Issueing officer<br/>
						Range or Revenue Station</center  ></td>
					</tr>
				</table>
			</div>
			</center>
		</div>
		<hr/>
		<div class="text-center text-bold avoid_me"><input type="button" value="Print Certificate" class="btn btn-lg btn-info" onclick="printcontent()"/></div>
		<br/><br/>
		<?php require '../../../admin/includes/js.php' ?>
		<script type="text/javascript">    
			//Printing function
			function printcontent() {
				$("#printcontent").print({
					globalStyles : true,
					mediaPrint : true,
					stylesheet : "../dist/css/skins/AdminLTE.css",
					iframe : false,
					noPrintSelector : ".avoid_me",
				
			});
			} //End of printcontent()
		</script>
	</body>
</html>
