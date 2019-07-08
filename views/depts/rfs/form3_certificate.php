<?php
$cafRow = $this->cafs_model->get_row($swr_id);
if($cafRow) {
    $ubin = $cafRow->ubin;
    $companyName = $cafRow->Name;
    $companyOwner = $cafRow->Name_of_owner;
    $key_person=$cafRow->Key_person;
    $street_name1=$cafRow->b_street_name1 ." , ".$cafRow->b_street_name2;
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
	//$lic_exp_year = $formCertRow->$lic_exp_year;
		$regular_fees = $formCertRow->regular_fees;
		$arrear_fees_details = $formCertRow->arrear_fees_details;
		$penalty_charge = $formCertRow->penalty_charge;
		$lic_exp_year = $formCertRow->lic_exp_year;
		$valid_upto = $formCertRow-> valid_upto;
	 $lic_place = $formCertRow-> lic_place;
	 $license_no = $formCertRow-> license_no;
	 
        $sub_date = $formCertRow->sub_date;
		
	   
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
		$valid_upto="not found";
		$license_no="not found";
		$sub_date="not found";
		$lic_place="not found";
		
   //$lic_exp_year = ;
	}
$formProcessRow = $this->formprocess_model->get_row($this->dept_code, $form_table, $form_id);
if($formProcessRow) {
    $p_date = $formProcessRow->p_date;
} else {
    $p_date = "Not found";
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
                         <!--copied from rfs_form3_certificate.php-->
						 	<div align="center" style="padding: 10px 30px;width:85%; border:2px solid black;">
                            <img src="<?=base_url('public/imgs/assam.png')?>" class="alomlogoimg" /> <br />
		<tr><h2 class="text-uppercase"><?=$this->dept_name?></h2>
		<h3><b>CERTIFIED COPY OF REGISTRATION OF FIRM</b></h3>
		<br/>
		<table width="100%"  >
			<tr>
				<td>UBIN : <b><?php echo $ubin; ?></b></td>
				<td align="right">UAIN : <b><?php echo $uain; ?></b></td>
				
			</tr>
			<tr>
				<td></td>
				<td align="right"><?php if($total_fees!=""){?>Fees Paid : <b><?php echo "Rs. ".$total_fees; ?><?php }?></b></td>
			</tr>
		</table>
		<br/>
			<p align="center">This certificate of registration is issued to <?php echo $companyName; ?> bearing registration number on the regsiter if Firms <?php echo $uain; ?> OF <?php echo date("Y",strtotime($p_date))?> - <?php echo date("Y",strtotime($p_date))+1;?> for carrying out the business of Construction Material Supply.</p>
		<!--	<p align="center">The firm has been established on <?php echo date("d-m-Y",strtotime($date_of_commencement));?> for Unlimited as per the application submitted on <?php echo date("d-m-Y",strtotime($sub_date)); ?>.</p>
		--><br/>
		<table width="100%">
			<tr>
				<td></td>
				<td align="right"><b>Registrar of Firms</b><br/>Assam, Dispur, Guwahati</td>
			</tr>
		</table>
		<br/><br/>
		
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
		<p align="justify"><b>Enclosure-1:</b> Name, permanent address of the partners and date of joining as per <b>Annexure-01</b></p>
		<table width="100%" class="table table-responsive" border="1">
			<thead>
				<tr>
					<th width="5%">Sl No.</th>
					<th width="20%">Full Name of partners</th>
					<th width="50%">Photo uploaded</th>
					
				</tr>
			</thead>
			<tbody>
				<?php 
				    $formRows = $this->forms_model->get_frmrows($this->dept_code, "rfs_form3_members", $form_id);
													//$part2=$ayush->query("SELECT * FROM ayush_form2_t2 WHERE form_id='$form_id'");
													//$num2 = $part2->num_rows;
													if($formRows){
													  $count=1;
													  foreach($formRows as $rows){	?>
											<tr>
												<td><?=strtoupper($rows->sl_no);?></td>
												<td><?=strtoupper($rows->member_name);?> <br/> 
												<td><?=strtoupper($rows->upload_photo);?> <br/> 
										

											</tr>
						<?php }
											} ?>
			</tbody>
		</table>
		<br/>
		<!--<p align="justify"><b>Enclosure-2:</b> Principal Place of Business and Other Place of Business as per <b>Annexure-02</b></p>
		<table width="100%" class="table table-responsive" border="1">
			<thead>
				<tr>
					<th width="25%">Place of Business</th>
					<th width="25%">Principal place</th>
					<th width="25%">Other place</th>
					<th width="25%">Date of closing or opening</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td rowspan="2"><?=strtoupper(check_if_empty($dist));?></td>
					<td rowspan="2"><?php echo strtoupper($b_vill)."<br/>".strtoupper($dist).", PIN : ".$b_pincode; ?></td>
					<td><?php echo strtoupper(check_if_empty($closing_place_locality)).", ".strtoupper(check_if_empty($closing_place_vill))."<br/>PO : ".strtoupper(check_if_empty($closing_place_po)).", PS : ".strtoupper(check_if_empty($closing_place_ps))."<br/>".strtoupper(check_if_empty($closing_place_dist)).", PIN : ".check_if_empty($closing_place_pincode); ?></td>
					<td><?=strtoupper(check_if_empty($closing_place_dte))." (Closing Date)";?></td>
				</tr>
				<tr>
					<td><?php echo strtoupper(check_if_empty($opening_place_locality)).", ".strtoupper(check_if_empty($opening_place_vill))."<br/>PO : ".strtoupper(check_if_empty($opening_place_po)).", PS : ".strtoupper(check_if_empty($opening_place_ps))."<br/>".strtoupper(check_if_empty($opening_place_dist)).", PIN : ".check_if_empty($opening_place_pincode); ?></td>
					<td><?=strtoupper(check_if_empty($opening_place_dte))." (Opening Date)";?></td>
				</tr>
			</tbody>
		</table>
		<br/>-->
		<table width="100%">
			<tr>
				<td>Place of issue : GUWAHATI</td>
				<td></td>
			</tr>
			<tr>
				<td>Date of issue : <?php echo date("d-m-Y",strtotime($p_date)); ?></td>
				<td align="right"></td>
			</tr> 
		</table>
		<br/>
		
		<p align="left">N.B. Registered number of the firm should not be stated as Govt. registered. It is registered under the I.P. Act, 1932</p>
	</div>
						 <!--copied-->
                            <p align="left">N.B. Registered number of the firm should not be stated as Govt. registered. It is registered under the I.P. Act, 1932</p>
                            <p align="center">This is a computer generated certificate and it does not require signature. This certificate can be verified by UAIN or the QR Code printed on it.</p>	
                        </div><!--End of .alomcertbl-->
                    </div><!--End of .box-body--> 
                </div><!--End of .box-->                    
            </div><!--End of .content-wrapper-->
            <?php $this->load->view("staffs/requires/footer"); ?>
        </div><!-- End of .wrapper-->
    </body>
</html>
