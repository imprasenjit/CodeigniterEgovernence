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
}
    $params['data'] = $uain;
    $params['level'] = 'H';
    $params['size'] = 10;
    $params['savename'] = 'storage/temps/qrcode.png';
    $this->ciqrcode->generate($params);

$formCertRow = $this->formcertifcates_model->get_row($this->dept_code, $form_table, $form_id);
if($formCertRow) {
	$lic_exp_year = $formCertRow->lic_exp_year;
	$sub_date = $formCertRow->sub_date;
    $total_fees = $formCertRow->total_fees;
    $arrear_fees_details = $formCertRow->arrear_fees_details;
    $regular_fees = $formCertRow->regular_fees;
    $penalty_charge = $formCertRow->penalty_charge;
    $production_capacity = $formCertRow->production_capacity;
    $act = $formCertRow->act;
	$terms = $formCertRow->terms;
    $inspection_category = $formCertRow->inspection_category;
   
    if($formCertRow->penalty_charge == ""){
		$penalty_charge="0.00";
	}else{
		$penalty_charge=$formCertRow->penalty_charge;
	}
    
	if($arrear_fees_details!=""){
		$arrear_fees_details=json_decode($arrear_fees_details);
		$arrear_fees_details_y1=$arrear_fees_details->y1; 
		$arrear_fees_details_y2=$arrear_fees_details->y2;
		if(isset($arrear_fees_details->fees) && !empty($arrear_fees_details->fees))  $arrear_fees_details_fees=$arrear_fees_details->fees; else $arrear_fees_details_fees=0;
	}else{
		$arrear_fees_details=0;
		$arrear_fees_details_y1=0;
		$arrear_fees_details_y2=0;
		$arrear_fees_details_fees=0;
	}
    
} else {
	 $sub_date= $total_fees= $lic_exp_year= $production_capacity= $act= $terms= $inspection_category= $regular_fees= $arrear_fees_details= $penalty_charge= "Not Found!";
}
$formCertRow = $this->formprocess_model->get_row($this->dept_code, $form_table, $form_id);
if ($formCertRow) {
    $issue_date = $formCertRow->p_date;
} else {
    $issue_date = "Not Found!";
}
//End of if ?>
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
                        <a href="<?=base_url('staffs/certificates/getpdf/'.encodeme($uain))?>" class="btn btn-info backbtn-alm" target="_blank">
                            <i class="fa fa-file-pdf-o"></i> Download
                        </a>
                        <button class="btn btn-warning backbtn-alm printbtn">
                            <i class="fa fa-print"></i> Print
                        </button>
                    </h3><!--End of .boxalm-head-->
                    <div class="box-body"> 
						 <table class="alomcertbl printcontent">
                            <thead>
                                <tr>
                                    <th class="alomheadertxt" >
                                        <img src="<?= base_url('public/imgs/assam.png') ?>" class="alomlogoimg" /> <br />

                                       <h1 align="center" style="margin-top:10px;"><?=$this->dept_name?></h1>
                                        <h1 align="center" >Assam</h1>
                                        <br/>
                                    </th>
                                </tr>
                            </thead>
							 <tbody>   
                                <tr>
                                    <td colspan="3" style="padding: 1px 30px;">
                                        <table style="width: 100%;">
                                          
                                                <tr>
                                                    <td style="font-size: 16px; line-height: 24px">
                                                        UBIN : <strong><?= $ubin ?></strong> <br />
														Fees : <strong>Rs.<?= $total_fees; ?></strong>
                                                        
                                                    </td>
                                                    <td style="text-align: right; font-size: 16px; line-height: 24px">

                                                        UAIN : <strong><?= $uain ?></strong> 
                                                    </td>
                                                </tr>
                                        </table>
                        
                        
                            <br/>
                            <p style="  text-align:justify; font-family: AlgerFont; font-size:16px; line-height:24px;">This licence is hereby granted to <?php echo strtoupper($companyName); ?> .</p>
							<br/>
							<p style="  text-align:justify; font-family: AlgerFont; font-size:16px; line-height:24px;">This licence shall remain in force till the Thirty-first day of December, <?=$lic_exp_year;?> </p>
                            <br/>
									<table align="center" style="width:99%;font-family:sanserif;">
													<tr>
														<td style="font-size: 16px; line-height: 24px">
															Place of issue : Guwahati<br/>
															Date : <strong><?= date("d-m-Y", strtotime($issue_date)) ?></strong>
														</td>
														<td style="text-align: right; font-size: 16px">
															<?php echo strtoupper($companyOwner) ?><br/>Authorized Signatory
														</td>
													</tr>                    
									</table>
									<br/><br/>

									<div class="row" style="padding-left:5%;padding-bottom:20px;">
										<div style="width:70%;position:relative;float:left;text-align:left">
											<span class="details" style="padding-bottom:5px"><u>Details of Fees Paid</u></span>
											<p style="margin-top:5px;font-family:sans-serif;font-size:14px;">
											1. Regular Fees for the year 
											<?php echo $lic_exp_year; ?> : 
											Rs. <?php echo $regular_fees; ?>.00</p>
											<p style="margin-top:5px;font-family:sans-serif;font-size:14px;">
											2. Arrear Fees for the year 
											<?= $arrear_fees_details_y1; ?> to <?= $arrear_fees_details_y2; ?>: 
                                            Rs. <?= $arrear_fees_details_fees; ?>
											<p style="margin-top:5px;font-family:sans-serif;font-size:14px;">
											3. Penalty/other charges : Rs. <?php echo $penalty_charge; ?>.00</p>
										</div>
										<div style="width:30%;position:relative;float:left;">
											<img src="<?=base_url('storage/temps/qrcode.png')?>" style="width: 120px; height: 120px">
										</div>
									</div>
							</td>
							</tr>
                         </tbody>
						</table>
                    </div><!--End of .box-body--> 
                </div><!--End of .box-->                    
            </div><!--End of .content-wrapper-->
            <?php $this->load->view("staffs/requires/footer"); ?>
        </div><!-- End of .wrapper-->
    </body>
</html>