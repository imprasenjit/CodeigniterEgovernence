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
    $lic_no = $formCertRow->license_no;
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
                        
                        <div class="alomcertbl printcontent">
<!---copied from sdc_certificate20.php--->
<div align="center" style="padding: 10px 20px;width:99%; border:2px solid black;">	

		<img src="<?=base_url('public/imgs/assam.png')?>" class="alomlogoimg" />		<br/>		<br/>
		<br/>
		<h4><b>STATE DRUGS CONTROL ADMINISTRATION (Assam State)</b></h4>
		<h4><b><u>Additional Product Permission</u></b></h4>
		
                            <br/>
                                <p>Certificate of authorization for erection and maintenance of Escalators.</p>		
                                <p>This certificate is to be renewed annually and must be returned to the Chief Inspector at the appropriate time)</p>								
                                <table width="100%">		
                                    <tr>		
                                        <td>Authorization No:  <?=$lic_no?></td>		 		
                                    </tr>
                                    <tr>				
                                        <td>UBIN : <b><?=$ubin?></b></td>				
                                        <td align="right">Fees Paid : <b><?=sprintf("%0.2f", $total_fees)?></b></td>			
                                    </tr>			
                                    <tr>				
                                        <td>UAIN : <b><?=$uain?></b></td>			
                                    </tr>		
                                </table>		
                                </br>		
                                <p align="justify">
                                   <h2 align="center">This is a dummy certificate</h2>
                                </p> 		
                                <br/>			
                                <table width="100%">			
                                    <tr>	
                                        <td>Place of issue : GUWAHATI</td>
                                        <td></td>
                                    </tr>			
                                    <tr>				
                                        <td>Date of issue : <?php echo date("d-m-Y"); ?></td>				
                                        <td align="right">Govt. of Assam<br></td>
                                    </tr> 		
                                </table>		
                                <br/>		
                                <div class="row" style="padding-left:5%;padding-bottom:20px;">			
                                    <div style="width:70%;position:relative;float:left;text-align:left">				
                                        <span class="details" style="padding-bottom:5px"><u>Details of Fees Paid</u></span>				
                                        <p style="margin-top:5px;font-family:sans-serif;font-size:14px;">
                                            1. Regular Fees for the year <?=date("Y")." : Rs.".sprintf("%0.2f", $regular_fees)?>
                                        </p>				
                                        <p style="margin-top:5px;font-family:sans-serif;font-size:14px;">
                                            2. Arrear Fees for the year <?=$arrear_fees_details->y1." to ".$arrear_fees_details->y2." : Rs.".sprintf("%0.2f", $arrear_fees_details->fees)?>
                                        </p>				
                                        <p style="margin-top:5px;font-family:sans-serif;font-size:14px;">
                                            3. Penalty/other charges : Rs. <?=sprintf("%0.2f", $penalty_charge)?>
                                        </p>			
                                    </div>			
                                    <div style="width:30%;position:relative;float:left;">				
                                        <img src="<?=base_url('storage/temps/qrcode.png')?>" style="width: 120px; height: 120px">			
                                    </div>		
                                </div>
                            </div>
                    </div><!--End of .box-body--> 
                </div><!--End of .box-->                    
            </div><!--End of .content-wrapper-->
            <?php $this->load->view("staffs/requires/footer"); ?>
        </div><!-- End of .wrapper-->
    </body>
</html>
