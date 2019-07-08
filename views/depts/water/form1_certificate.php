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
    
    //qrcode configuration
    $params['data'] = $uain;
    $params['level'] = 'H';
    $params['size'] = 10;
    $params['savename'] = 'storage/temps/qrcode.png';
    $this->ciqrcode->generate($params);
}//End of if

$formCertRow = $this->formcertifcates_model->get_row($this->dept_code, $form_table, $form_id);
if($formCertRow) {
    $total_fees = $formCertRow->total_fees;
    $lic_no = $formCertRow->file_auth_num;
    $regular_fees = $formCertRow->regular_fees;
    $lic_exp_year = $formCertRow->lic_exp_year;
    $arrear_fees_details = json_decode($formCertRow->arrear_fees_details);
    $penalty_charge = $formCertRow->penalty_charge;
    
} else {
    $total_fees = 0;
    $lic_no = "Not Found";
}//End of if else

$formProcessRow = $this->formprocess_model->get_row($this->dept_code, $form_table, $form_id);
if($formProcessRow) {
    $p_date = $formProcessRow->p_date;
} else {
    $p_date = "Not found";
}//End of if else

$formRow = $this->forms_model->get_row($this->dept_code, $form_table, $form_id);
if($formRow) {
    
} else {
    
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
                        <div class="alomcertbl printcontent" style="padding:10px">
                               <table width="100%" id="paddingdone">
                                <tr>
                                    <td colspan="4">
                                <center><img src="<?=base_url('public/imgs/assam.png')?>" width="110px" height="140px" alt="Ashok"></center>
                                <h2 align="center"><?=strtoupper($dist);?></h2>
                                <h2 align="center">Provisional Allotment of Land at <?=$address;?></h2>
                                </td>
                                </tr>
                                <tr>
                                    <td colspan="4">&nbsp;</td>
                                </tr>

                                <tr>
                                    <td>UBIN : <b><?=$ubin?></b></td>
                                    <td align="right">UAIN : <b><?=$uain?></b></td>

                                </tr>
                                <tr>
                                    <td></td>
                                    <td align="right">Fees Paid : <b><?=sprintf("%0.2f", $total_fees)?></b></td>
                                </tr>

                                <tr>
                                    <td colspan="4"> To </br> <b><?=strtoupper($companyName);?>,</b></br><?=strtoupper($address);?></td>
                                </tr>
                            </table>
                            <p align="justify">With reference to the recommendations from the Level II Field Officer, I hereby grant the sanction to <b><?php echo strtoupper($companyOwner); ?></b> for water connection to the premises located at <b><?php echo strtoupper($address);?></b>.</p>
										<br/>    
								
								<table width="100%">
									<tr>
									<td>Place of issue : GUWAHATI</td>
									</tr>
									<tr>
									<td>Date of issue : <?php echo date("d-m-Y",strtotime($p_date)); ?></td>
									<td align="right">Authorised Signatory</td>
									</tr> 
									</table>	
									
								<div class="row" style="padding-left:5%;padding-bottom:20px;">
                                <?php if($total_fees!=""){?>
                                <div style="width:70%;position:relative;float:left;text-align:left">
                                    <span class="details" style="padding-bottom:5px"><u>Details of Fees Paid</u></span>
                                    <p style="margin-top:5px;font-family:sans-serif;font-size:14px;">1. Regular Fees for the year <?php echo $lic_exp_year; ?> : Rs. <?php echo $regular_fees; ?>.00</p>
                                    <p style="margin-top:5px;font-family:sans-serif;font-size:14px;">2. Arrear Fees for the year <?php echo $arrear_fees_details->y1." - ".substr( $arrear_fees_details->y2, -2 );?> : Rs. <?=sprintf("%0.2f", $arrear_fees_details->fees)?></p>
                                    <p style="margin-top:5px;font-family:sans-serif;font-size:14px;">3. Penalty/other charges : Rs. <?=sprintf("%0.2f", $penalty_charge)?></p>
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
                            <div style="clear:both"></div>
                        </div>
                    </div><!--End of .box-body--> 
                </div><!--End of .box-->                    
            </div><!--End of .content-wrapper-->
            <?php $this->load->view("staffs/requires/footer"); ?>
        </div><!-- End of .wrapper-->
    </body>
</html>
