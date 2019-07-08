<?php
$cafRow = $this->cafs_model->get_row($swr_id);
if($cafRow) {
    $ubin = $cafRow->ubin;
    $companyName = $cafRow->Name;
    $companyOwner = $cafRow->Name_of_owner;
    $key_person=$cafRow->Key_person;
    $street_name1=$cafRow->b_street_name1.", ".$cafRow->b_street_name2;
    $dist=$cafRow->b_dist;
    $address=$street_name1." , ".$dist;
    
    $params['data'] = $uain;
    $params['level'] = 'H';
    $params['size'] = 10;
    $params['savename'] = 'storage/temps/qrcode.png';
    $this->ciqrcode->generate($params);
}//End of if 
$formCertRow = $this->formcertifcates_model->get_row($this->dept_code, $form_table, $form_id);
if($formCertRow) {
	$total_fees = $formCertRow->total_fees;
	
		$regular_fees = $formCertRow->regular_fees;
		$arrear_fees_details = $formCertRow->arrear_fees_details;
		$penalty_charge = $formCertRow->penalty_charge;
		
		$lic_exp_year = $formCertRow->lic_exp_year;
		
        $sub_date = $formCertRow->sub_date;
	//	$file_no = $formCertRow->file_no;
		$lic_no = $formCertRow->lic_no;
		$issue_number = $formCertRow->issue_number;
		$valid_from = $formCertRow->valid_from;
		$valid_upto = $formCertRow->valid_upto;
	   
	 if($formCertRow->penalty_charge == "")
	 {
		$penalty_charge="0.00";
		}
	else
	{
		$penalty_charge=$formCertRow->penalty_charge;
	}
    
	if($arrear_fees_details!="")
	{
		$arrear_fees_details=json_decode($arrear_fees_details);
		$arrear_fees_details_y1=$arrear_fees_details->y1; 
		$arrear_fees_details_y2=$arrear_fees_details->y2;
		if(isset($arrear_fees_details->fees) && !empty($arrear_fees_details->fees))  $arrear_fees_details_fees=$arrear_fees_details->fees; else $arrear_fees_details_fees=0;
	}
	else
	{
		$arrear_fees_details=0;
		$arrear_fees_details_y1=0;
		$arrear_fees_details_y2=0;
		$arrear_fees_details_fees=0;
	}
	
	
	}
	
	
	//end of looped if
	else
	{
		$total_fees=0;
		$regular_fees=0;
		$lic_exp_year=0;
   //$lic_exp_year = ;
	}	

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Staff Dashboard :: Certificate View </title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php $this->load->view("staffs/requires/cssjs"); ?>
        <link href="<?=base_url('public/css/certificate.css')?>" rel="stylesheet">        
        <script src="<?=base_url('public/js/jQuery.print.min.js')?>"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $(document).on("click", ".printbtn", function(){
                    $(".printcontent").print({
                        globalStyles : true,
                        mediaPrint : false,
                        stylesheet : null,
                        iframe : false,
                        noPrintSelector : ".avoidme",
                        append : null,
                        prepend : null
                    });
                });
            });
        </script>
    </head>
    <body class="hold-transition skin-blue fixed" data-target="#scrollspy" data-spy="scroll">
        <div class="wrapper">
            <?php
            $this->load->view("staffs/requires/header");
            $this->load->view("staffs/requires/sidebar");
            ?>
            <div class="content-wrapper">
                <div class="box box-primary box-alm">
                    <h3 class="boxalm-head">
                        Certificate
                        <a href="javascript:history.back(-1)" class="btn btn-default backbtn-alm">
                            <i class="fa fa-chevron-circle-left"></i> Back
                        </a>
                        <button class="btn btn-warning backbtn-alm printbtn">
                            <i class="fa fa-print"></i> Print
                        </button>
                    </h3><!--End of .boxalm-head-->
                    <div class="box-body">
                        <div class="alomcertbl printcontent">
                         <!-- copied contents from ayush_form2_certificate_print.php -->   
								
                  
		                     <div align="center" style="padding: 10px; border:2px solid black;">		
			
						
                           <img src="<?=base_url('public/imgs/assam.png')?>" width="110px" height="140px" alt="Ashok">
                           		<br/>
		<h4><b>FORM 25-D</b></h4>
		<h4>[See Rule 154]</h4>
		<h4><b>DIRECTORATE OF AYUSH</b></h4>
		<h4><b>License to manufacture for sale Ayurvedic (including Siddha) or Unani drugs</b></h4>
		<br/>
		<table width="100%">
			<tr>
				<td>UBIN : <b><?php echo $ubin; ?></b></td>
				<td align="right">UAIN : <b><?php echo $uain; ?></b></td>
			</tr>
			<tr>
				<td>
					License No. <?=strtoupper($lic_no);?>
					<br/>
					Issue Number : <?=strtoupper($issue_number);?>.
				</td>
				<td align="right"><?php if($total_fees!=""){?>Fees Paid : <b><?php echo "Rs. ".$total_fees; ?><?php }?></td>
			</tr>
		</table>
		<br/>
		<div align="justify">
			<ol type="1">
				<li><?=strtoupper($companyName);?> is hereby licensed to manufacture the following Ayurvedic (including Siddha) or Unani drugs on the premises situated at <?=strtoupper($address);?> under the direction and supervision of the following technical staff :-<br/>
					<ol type="a">
						<li>Technical staff (Name)<br/>
								<table  width="100%" class="table table-responsive">
									<thead>
										<tr>
											<th width="10%">Sl. No.</th>
											<th width="30%">Name</th>
											<th width="30%">Qualification</th>
											<th width="30%">Experience</th>					
										</tr>
									</thead>
									<tbody>
											<?php
											$formRows = $this->forms_model->get_frmrows($this->dept_code, "ayush_form2_t2", $form_id);
													//$part2=$ayush->query("SELECT * FROM ayush_form2_t2 WHERE form_id='$form_id'");
													//$num2 = $part2->num_rows;
													if($formRows){
													  $count=1;
													  foreach($formRows as $rows){	?>
											<tr>
												<td><?=strtoupper($rows->slno);?></td>
												<td><?=strtoupper($rows->name);?></td>
												<td><?=strtoupper($rows->qualification);?></td>
												<td><?=strtoupper($rows->experience);?></td>
											</tr>
											<?php }
											} ?>
									</tbody>
								</table>
							</li>
							<li>Names of Drugs (each item to be separately specified)
								<table width="100%" class="table table-responsive">				
									<thead>
										<tr>
											<th width="10%">Sl. No.</th>
											<th width="45%">Name</th>
											<th width="45%">Details</th>							
										</tr>
									</thead>
									<tbody>
										<?php
		$formRows = $this->forms_model->get_frmrows($this->dept_code, "ayush_form2_t1", $form_id);

										//	$part1=$ayush->query("SELECT * FROM ayush_form2_t1 WHERE form_id='$form_id'");
										//	$num = $part1->num_rows;
											if($formRows){
												  $count=1;
												   foreach($formRows as $rows){	?>
												<tr>
													<td><?=strtoupper($rows->slno);?></td>
													<td><?=strtoupper($rows->drugs_name);?></td>
													<td><?=strtoupper($rows->drugs_det);?></td>
												</tr>
											<?php }
											} ?>
									</tbody>
								</table>
							</li>
						</ol>
					</li>
					<li>The license shall be in force from <?php echo date('d-m-Y',strtotime($valid_from));?> to <?php echo date('d-m-Y',strtotime($valid_upto));?>.</li>
					<li>The license is subject to the conditions stated below and to such other conditions as may be specified in the Rules for the time being in force under the Drugs and Cosmetics Act, 1940.</li>
			</ol>
		</div>
		<div class="col-sm-12" style="padding:0;">
			<div class="col-sm-6">
				<p align="justify"></p>
			</div>					
			<div class="col-sm-6 pull-right" >
				<p align="center"><?php echo strtoupper($companyOwner); ?><br/><?php echo strtoupper($dist); ?><br/>Directorate of AYUSH<br/>Govt. of Assam</p>
			</div>	
		</div>
		<br/>
		<table width="100%">
			<tr>
				<td>Date : <?php echo date('d-m-Y',strtotime($sub_date)); ?></td>
				<td></td>
			</tr>
			<tr>
				<td>Place : Guwahati</td>
				<td></td>
			</tr>
		</table>
		<br/>
		<div class="row" style="padding-left:5%;padding-bottom:20px;">
			<?php if($total_fees!=""){?>
			<div style="width:70%;position:relative;float:left;text-align:left">
				<span class="details" style="padding-bottom:5px"><u>Details of Fees Paid</u></span>
				<p style="margin-top:5px;font-family:sans-serif;font-size:14px;">1. Regular Fees for the year <?php echo $lic_exp_year; ?> : Rs. <?php echo $regular_fees; ?>.00</p>
				<p style="margin-top:5px;font-family:sans-serif;font-size:14px;">2. Arrear Fees for the year <?php echo $arrear_fees_details_y1." - ".substr( $arrear_fees_details_y2, -2 );?> : Rs. <?php echo $arrear_fees_details_fees; ?>.00</p>
				<p style="margin-top:5px;font-family:sans-serif;font-size:14px;">3. Penalty/other charges : Rs. <?php echo $penalty_charge; ?>.00</p>
			</div>
			<?php }else{?>	
			<div style="width:70%;position:relative;float:left;text-align:left">
				<p>&nbsp;</p>
			</div>
			<?php }?>
			<div style="width:30%;position:relative;float:left;">
                                    <img src="<?=base_url('storage/temps/qrcode.png')?>" style="width: 120px; height: 120px">
                                </div>
		</div>
		<h4 class="newpage"><b>Conditions of Licence</b></h4>
		<div align="justify">
			<ol type="1">
				<li>This license and any certificate of renewal in force shall be kept on the approved premises and shall be produced at the request of an Inspector appointed under the Drugs and Cosmetics Act, 1940.</li>
				<li>Any change in the expert staff named in the license shall be forthwith reported to the Licensing Authority.</li>
				<li>This license shall be deemed to extend to such additional items as the licensee may intimate to the Licensing Authority from time to time, and as may be endorsed by the Licensing Authority.</li>
				<li>The license shall inform the Licensing Authority in writing in the event of any change in the constitution of the firm operating under the license. Where any change in the constitution of the firm takes place, the current license shall be deemed to be valid for a maximum period of three months from the date on which the change takes place unless, in the meantime, a fresh license has been taken from the Licensing Authority in the name of the form with the changed constitution.</li>
			</ol>
		</div>
							
				          


						  <!-- copied contents from ayush_form2_certificate_print.php -->   
			
                        </div> <!--End of .alomcertbl printcontent-->                       
                    </div><!--End of .box-body--> 
                </div><!--End of .box-->                    
            </div><!--End of .content-wrapper-->
            <?php $this->load->view("staffs/requires/footer"); ?>
        </div><!-- End of .wrapper-->
    </body>
</html>
