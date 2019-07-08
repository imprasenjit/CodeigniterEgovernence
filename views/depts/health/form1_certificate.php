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
}

$formCertRow = $this->formprocess_model->get_row($this->dept_code, $form_table, $form_id);
if($formCertRow) {
	$p_date = $formCertRow->p_date;
	
} else {
	$p_date= "Not Found!";
}
$formCertRow = $this->formcertifcates_model->get_row($this->dept_code, $form_table, $form_id);
if($formCertRow) {
    $total_fees = $formCertRow->total_fees;
	 //$arrear_fees_details = json_decode($formCertRow->arrear_fees_details);
	 $lic_no = $formCertRow->file_auth_num;
	 $lic_exp_year = $formCertRow->lic_exp_year;
	 $regular_fees = $formCertRow->regular_fees;
	 $arrear_fees_details = json_decode($formCertRow->arrear_fees_details);
	 $penalty_charge = $formCertRow->penalty_charge;
} else {
    $total_fees = "Not found";
	$lic_no = "Not found";
	$lic_exp_year = "Not found";
	$regular_fees = "Not found";
	$penalty_charge = "Not found";
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
                        <div class="alomcertbl printcontent" style="padding:20px">>
                            <h2 class="text-uppercase" align = "center"><?php echo $this->dept_name; ?></h2>
								<div class="text-center">
                            <img src="<?= base_url('public/imgs/assam.png') ?>" width="110px" height="140px" alt="Ashok">
							</div>
                            <br/>
                            <h4><b></b></h4>
                            <br/>
                            <table width="100%"  >
                                <tr>
                                    <td>UBIN : <b><?= isset($ubin) ? $ubin : "NOT FOUND"; ?></b></td>
                                    <td align="right">UAIN : <b><?= isset($uain) ? $uain : "NOT FOUND"; ?></b></td>						
                                </tr>
                                <tr>
                                    <td></td>
                                    <td align="right"><b><?= ($total_fees) ? "Total Fee : Rs. " . $total_fees : ""; ?></b></td>
                                </tr>
                            </table>
                            <br/>
                            <p align="justify">This licence is hereby granted to <?php echo strtoupper($companyName); ?> .</p>
                            <br/>
                            <p>This licence shall remain in force till the Thirty-first day of December, <?php echo $lic_exp_year; ?> </p>
                            <br/>
                            <table width="100%">
                                <tr>	<td>Place of issue : GUWAHATI</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Date of issue : <?= date("d-m-Y", strtotime($p_date)); ?></td>
                                    <td align="right">Authorised Signatory</td>
                                </tr> 
                            </table>
                            <br/><br/>

                            <div class="row" style="padding-left:5%;padding-bottom:20px;">
                                <?php if ($total_fees != "") { ?>
                                    <div style="width:70%;position:relative;float:left;text-align:left">
                                        <span class="details" style="padding-bottom:5px"><u>Details of Fees Paid</u></span>
                                        <p style="margin-top:5px;font-family:sans-serif;font-size:14px;">1. Regular Fees for the year <?php echo $lic_exp_year; ?> : Rs. <?php echo $regular_fees; ?>.00</p>
                                        <p style="margin-top:5px;font-family:sans-serif;font-size:14px;">2. Arrear Fees for the year <?php echo $arrear_fees_details->y1 . " - " . substr($arrear_fees_details->y2, -2); ?> : Rs. <?php echo $arrear_fees_details->fees; ?>.00</p>
                                        <p style="margin-top:5px;font-family:sans-serif;font-size:14px;">3. Penalty/other charges : Rs. <?php echo $penalty_charge; ?>.00</p>
                                    </div>
                                <?php } else { ?>	
                                    <div style="width:70%;position:relative;float:left;text-align:left">
                                        <p>&nbsp;</p>
                                    </div>
                                <?php } ?>
                                <div style="width:30%;position:relative;float:left;">
                                            <img src="<?=base_url('storage/temps/qrcode.png')?>" style="width: 120px; height: 120px">
                                        </div>
                            </div>
                        </div><!-- End of .alomcertbl-->
                    </div><!--End of .box-body--> 
                </div><!--End of .box-->                    
            </div><!--End of .content-wrapper-->
            <?php $this->load->view("staffs/requires/footer"); ?>
        </div><!-- End of .wrapper-->
    </body>
</html>