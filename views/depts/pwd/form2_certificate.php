<?php
$staff_name =  $this->session->staff_name;
$staff_id = $this->session->staff_id;
$this->load->model("staffs/deptusers_model");
$staffRow = $this->deptusers_model->get_row($staff_id, $this->dept_code);
$staff_designation=$staffRow?$staffRow->udesig:"Not found";
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
    $reg_no = $formCertRow->reg_no;
    $regular_fees = $formCertRow->regular_fees;
    $lic_exp_year = $formCertRow->lic_exp_year;
    $arrear_fees_details = json_decode($formCertRow->arrear_fees_details);
    $penalty_charge = $formCertRow->penalty_charge;
    
} else {
    $total_fees = 0;
    $reg_no = "Not Found";
}//End of if else

$formProcessRow = $this->formprocess_model->get_row($this->dept_code, $form_table, $form_id);
if($formProcessRow) {
    $p_date = date("d-m-Y", strtotime($formProcessRow->p_date));
} else {
    $p_date = "";
}//End of if else


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
                        <div class="alomcertbl printcontent" style="padding:20px">
                            <div class="text-center">
                            <img src="<?= base_url('public/imgs/assam.png') ?>" width="110px" height="140px" alt="Ashok">
                            <br/>
                            <h4><b><?=$this->dept_name?></b></h4>
                            <h4><b>"<?=$form_name?>"</b></h4>
                            <br/>
                            </div>
                            <table width="100%">
                                <tr>
                                    <td>UBIN : <b><?=$ubin?></b></td>
                                    <td align="right">UAIN : <b><?=$uain?></b></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td align="right"><?=($total_fees>0)?"Rs.".sprintf("%0.2f", $total_fees):""?></td>
                                </tr>
                            </table>
                            <br/>
                            <br/>
                            <p align="left">
                                To,<br/>
                                <b><?= strtoupper($companyName)?></b><br/>
                                <b><?= strtoupper($address)?></b>
                            </p>
                            <p align="justify">
                                With reference to your application, the department hereby grants you Right of Way permission for 
                                
                            </p>
                            <p align="justify">
                                The permission granted is for laying of / drawing of 
                                <b></b> by the authorized contractor mentioned below:<br/>
                                License No. of Authorized Contractor : <b></b><br/>
                                Name of Authorized Contractor : <b></b>
                            </p>

                            <p align="justify">
                                This permission is subject to the following conditions:
                            </p>
                            <div align="justify">
                                <ol>
                                    <li>
                                        The cost of cutting, repairing and drawing of the line is to be borne by the applicant.
                                    </li>
                                    <li>
                                        Cost of repairs to be done to the state highway / road for any damage caused in the process of road cutting / drawing of overhead line shall be borne by the applicant.
                                    </li>
                                    <li>
                                        Upon completion of the road cutting / drawing of overhead line work and the subsequent repairs, an intimation of the same shall be filed with the department for assessment before commencing power supply through the line / cable.
                                    </li>
                                    <li>
                                        Upon assessment of the work done, if any discrepancy is found, the applicant shall be liable to reimburse the department for the additional cost of rectifying damages caused to the state highway / road.
                                    </li>
                                </ol>
                            </div>
                            <div class="col-sm-12" style="padding:0;">
                                <div class="col-sm-6">
                                    <p ailgn="left">Thanking You,</p>
                                </div>					
                                <div class="col-sm-6 pull-right" >
                                    <br/><br/>
                                    <p>Yours faithfully,<br/>
                                        For Public Works Road Department<br/>
                                        <b><?=strtoupper($staff_name)?></b><br/>
                                        <b><?=strtoupper($staff_designation)?></b></p>
                                </div>	
                            </div>
                            <br/>
                            <table width="100%">
                                <tr>
                                    <td>Date : <?=date('d-m-Y', strtotime($p_date))?></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Place : <?=$dist?></td>
                                    <td></td>
                                </tr>
                            </table>
                            <br/>
                            <div class="row" style="padding-left:5%;padding-bottom:20px;">
                                <?php if ($total_fees) { ?>
                                    <div style="width:70%;position:relative;float:left;text-align:left">
                                        <span class="details" style="padding-bottom:5px"><u>Details of Fees Paid</u></span>
                                        <p style="margin-top:5px;font-family:sans-serif;font-size:14px;">1. Regular Fees for the year <?=$lic_exp_year?> : Rs. <?=sprintf("%0.2f", $regular_fees)?></p>
                                        <p style="margin-top:5px;font-family:sans-serif;font-size:14px;">2. Arrear Fees for the year <?=$arrear_fees_details->y1 . " - " . substr($arrear_fees_details->y2, -2)?> : Rs. <?=sprintf("%0.2f", $arrear_fees_details->fees)?></p>
                                        <p style="margin-top:5px;font-family:sans-serif;font-size:14px;">3. Penalty/other charges : Rs. <?=sprintf("%0.2f", $penalty_charge)?></p>
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
                        </div><!--End of .alomcertbl-->
                    </div><!--End of .box-body--> 
                </div><!--End of .box-->                    
            </div><!--End of .content-wrapper-->
            <?php $this->load->view("staffs/requires/footer"); ?>
        </div><!-- End of .wrapper-->
    </body>
</html>