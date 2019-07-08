<?php   
require_once "login_session.php"; 	
$_SESSION["form"]=$form_no=$_GET["form"];
$dept=$_GET["dept"];
switch($dept){
	case "pcb": $table_name="pcb";
				switch($form_no){
					case 1: $goto=$server_url."departments/pcb/forms/form1.php";
					break;
					case 2: $goto=$server_url."departments/pcb/forms/form2.php";
					break;
					default : $goto=$server_url."departments/pcb/forms/pcb_form".$form_no.".php";
					break;
				}
			break;
	case "sdc": $table_name="sdc";
				if($form_no==27 || $form_no==28 || $form_no==29 || $form_no==30 || $form_no==33 || $form_no==34){
					$goto=$server_url."departments/sdc/forms/sdc_retention_retail.php";
				}else if($form_no==35 || $form_no==36 || $form_no==38 || $form_no==39 || $form_no==40 || $form_no==41 || $form_no==42 || $form_no==44 || $form_no==45 || $form_no==47 || $form_no==48 || $form_no==51){
					$goto=$server_url."departments/sdc/forms/sdc_retention_manufacture.php";
				}else{
					$goto=$server_url."departments/sdc/forms/sdc_form".$form_no.".php";
				}
			break;
	case "labour": $table_name="labour";
				switch($form_no){
					case 1: $_SESSION["form_type"]="N";$goto=$server_url."departments/labour/forms/lc_reg_form1.php";
					break;
					case 2: $goto=$server_url."departments/labour/forms/lc_reg_form2.php";
					break;
					case 3: $goto=$server_url."departments/labour/forms/lc_reg_form3.php";
					break;
					case 4: $goto=$server_url."departments/labour/forms/lc_reg_form4.php";
					break;
					case 5: $goto=$server_url."departments/labour/forms/lc_reg_form5.php";
					break;
					case 6: $goto=$server_url."departments/labour/forms/lc_license_form6.php";
					break;
					case 7: $goto=$server_url."departments/labour/forms/lc_license_form7.php";
					break;
					case 8: $goto=$server_url."departments/labour/forms/lc_license_form8.php";
					break;
					case 9: $_SESSION["form_type"]="R";$goto=$server_url."departments/labour/forms/lc_renewal_form9.php";
					break;
					case 10: $goto=$server_url."departments/labour/forms/lc_renewal_form10.php";
					break;
					case 11: $goto=$server_url."departments/labour/forms/lc_renewal_form11.php";
					break;
					default : $goto="";
					break;
				}
			break;
	default : $table_name=$dept;
			$goto=$server_url."departments/".$dept."/forms/".$dept."_form".$form_no.".php";
	break;
}
/* $inst_query=$cms->query("select * from ".$table_name."_form_details where ipc='I'") or die("Error :".$cms->error);
$proc_query=$cms->query("select * from ".$table_name."_form_details where ipc='P' and form_number='$form_no'") or die("Error :".$cms->error);
$check_query=$cms->query("select * from ".$table_name."_form_details where ipc='C' and form_number='$form_no'") or die("Error :".$cms->error);
$agree_query=$cms->query("select * from ".$table_name."_form_details where ipc='A'") or die("Error :".$cms->error); */
$form_name=$formFunctions->get_formName($dept,$form_no);

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Ease of Doing Business | Govt. of Assam</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <?php require '../../user_area/includes/css.php';?>

</head>
<body class="hold-transition skin-blue fixed" data-target="#scrollspy" data-spy="scroll">
	<div class="wrapper">

	  <?php require 'header.php'; ?>
	  <?php //require '../../user_area/includes/aside.php'; ?>

	  
		<div class="content-wrapper">
			<section class="content-header">
				<h1>
				Terms and Conditions
					<small></small>
				</h1>
			</section>
			<section class="content">
			<div class="row">
				<div class="col-md-12">
					<div class="box box-primary">
					<h3 class="box-title text-center" style="padding-bottom:10px"><?php echo $form_name; ?></h3>
						<div class="tab-content">
							<div id="part1" class="tab-pane active box-header with-border" role="tabpanel">
								<h3 class="box-title" style="padding-bottom:10px">Instructions</h3>
								<table class="table table-responsive">
										<thead>
											<tr class="info">
												<th>#</th>
												<th>Information</th>
											</tr>
										</thead>
										<!--<tbody>
											<?php //$sl=1; 
										//while($procedures=$proc_query->fetch_object()){ ?>
											<tr>
												<td><?php// echo $procedures->sl_no; ?></td>
												<td><?php //echo $procedures->details; ?></td>
											</tr>
										<?php //$sl++;
										//} ?>
										</tbody>-->
										<tbody>
											<tr>
													<td>1</td>
													<td>Please check before you apply whether this is the correct form you are applying. In case of any doubts please call the nodal officer of the concerned department.</td>
											</tr>
											<tr>
													<td>2</td>
													<td>Kindly download a sample application form before you fill the online application and collect supporting documents required as per the check list.</td>
											</tr>
											<tr>
													<td>3</td>
													<td>* marks in check list are compulsory documents to be submitted others are optional.</td>
											</tr>
											<tr>
													<td>4</td>
													<td>All documents required as per checklist should be ready in a PDF format and uploaded in your e-locker. (Maximum size allowed is 2mb) (Multiple pages of the document should be merged into a single document).</td>
											</tr>
											<tr>
													<td>5</td>
													<td>While filing online, follow the instructions carefully and save it for future use before submission.</td>
											</tr>
											<tr>
													<td>6</td>
													<td>After completion of online filing save your documents and attach all the documents as per checklist before submission. </td>
											</tr>
											<tr>
													<td>7</td>
													<td>Recheck the form and attached documents before final submission as you will not be able to edit it once submitted. </td>
											</tr>
											<tr>
													<td>8</td>
													<td>If wrongly submitted you may have to re-apply the same.</td>
											</tr>
											<tr>
													<td>9</td>
													<td>Please keep your computer generated acknowledgement letter for your future correspondence.</td>
											</tr>
											<tr>
													<td>10</td>
													<td>You will get a confirmation mail in your email associated with login id and also in your personal log in inbox.</td>
											</tr>
										</tbody>
								</table>
								  <div class="row">
									<div class="col-md-4">
										<a style="width:50%" type="button" href="#!" onclick="window.history.back();" class="pull-left btn btn-block btn-primary btn-md"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
									</div>
									<div class="col-md-4">
									</div>								
									<div class="col-md-4">
										<button style="width:50%" type="button" href="#part2" data-toggle="tab" class="pull-right btn btn-block btn-primary btn-md"><i class="fa fa-arrow-right" aria-hidden="true"></i> Next</button>
									</div>
								  </div>
							</div>
							<div id="part2" class="tab-pane box-header with-border" role="tabpanel">
								<div class="row">
									<div class="col-md-12 text-center "><h3>Agreement</h3></div>
								</div>
								<br/>											
								<div class="row">
									<div class="col-md-2"></div>
									<div class="col-md-8">
										<p style="text-align:center">I do hereby solemnly declare to the best of my knowledge and belief that the information submitted in the online application form along with all the required documents as per the check list given are correct and complete and any misrepresentation of the fact will attract legal action as stipulated by the Department.<br/>I do hereby agree to abide by all the rules and regulations stipulated in the online application system.<br/>I further declare that I am submitting and verifying the information given above in my capacity as authorized signatory and that I am competent to do so.</p>
									</div>									
									<div class="col-md-2"></div>
								</div>
								<br/>
								<div class="row">
									<div class="col-md-12 text-center"><input id="agree" type="checkbox" class=""> I have fully read and agree to the above statement</div>
								</div>
								<br/>
								<div class="row">
									<div class="col-md-2"></div>
									<div class="col-md-8">
									<p>Authorised Signatory will be mean the following :</p>
									<ol type="a">
										<li> In case of proprietorship company the proprietor / individual himself or a person duly authorized by him</li>
										<li> In case of Hindu undivided family, by the Karta or a person duly authorized by him</li>
										<li> In case of a Partnership firm, by the Managing partner or a person duly authorized by him</li>
										<li> In case of a company, by a person duly authorized in that behalf by the Board of Directors</li>
										<li> and in any case, by a person in-charge of or responsible for the conduct of the business.</li>
									</ol>
									</div>
								</div><br/><br/>								
								<div class="row">
									<div class="col-md-4">
										<button style="width:50%" type="button" href="#part1" data-toggle="tab" class="pull-left btn btn-block btn-primary btn-md"><i class="fa fa-arrow-left" aria-hidden="true"></i> Previous</button>
									</div>
									<div class="col-md-4">
										
									</div>									
									<div class="col-md-4">
										<a id="" style="width:50%"  onclick="getStatus2()" href="#" class="pull-right btn btn-block btn-success btn-md"><i class="fa fa-arrow-right" aria-hidden="true"></i> Proceed to Form</a>
									</div>
								</div>
							</div>
							
						</div> <!-- tab-content closes --> 
					</div>
				</div>
			</div>
			</section>
		</div>
	  
		<?php require_once "../../views/users/requires/footer.php"; ?>
	</div>

<?php require 'js.php' ?>
<script>
	function getStatus2(){
		if(document.getElementById('agree').checked==true){
			window.location.href="<?php echo $goto; ?>";
			
		}else{
			alert("Please click on the checkbox ! I Agree");
			
		}
	}

	$('#fulltext').scroll(function () {
		if ($(this).scrollTop() == $(this)[0].scrollHeight - $(this).height()) {
			$('#scrollnext').removeAttr('disabled');
		}
	});
</script>
</body>
</html>
