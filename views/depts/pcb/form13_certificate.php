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
    $auth_no = $formCertRow->auth_no;
    $valid_upto = $formCertRow->valid_upto;
    $e_quantity = $formCertRow->e_quantity;
    $e_nature = $formCertRow->e_nature;
    $e_manner = $formCertRow->e_manner;
    $e_treated_at = $formCertRow->e_treated_at;
    $total_fees = $formCertRow->total_fees;
    $arrear_fees_details = $formCertRow->arrear_fees_details;
    $regular_fees = $formCertRow->regular_fees;
    $penalty_charge = $formCertRow->penalty_charge;
    
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
	 $auth_no= $valid_upto= $e_quantity= $e_nature= $e_manner= $e_treated_at= $sub_date= $total_fees= $lic_exp_year= $regular_fees= $arrear_fees_details= $penalty_charge= "Not Found!";
}
$formCertRow = $this->formprocess_model->get_row($this->dept_code, $form_table, $form_id);
if($formCertRow) {
	$issue_date = $formCertRow->p_date;
	
} else {
	$issue_date= "Not Found!";
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
                        <!--<a href="<?=base_url('staffs/certificates/getpdf/'.$uain)?>" class="btn btn-info backbtn-alm" target="_blank">
                            <i class="fa fa-file-pdf-o"></i> Download
                        </a>-->
                        <button class="btn btn-warning backbtn-alm printbtn">
                            <i class="fa fa-print"></i> Print
                        </button>
                    </h3><!--End of .boxalm-head-->
                    <div class="box-body">
                        <div class="alomcertbl printcontent">
						
						
						 <div align="center" style="padding: 10px; border:2px solid black;">
						
                           <img src="<?=base_url('public/imgs/assam.png')?>" width="110px" height="140px">
                            <br/>
                                <div id="header">
                                    <div style="font-family:lucidacalligraphy">
                                        <img class="logo" style="margin-left:30px;margin-top:10px;float:left;" src="<?=base_url('public/imgs/logopcb.jpg')?>"/>
                                        <h1 align="left" style="margin-top:10px;padding-left:190px">Pollution Control Board</h1>
                                        <h1 align="left" style="padding-left:300px">Assam</h1>
                                        <br/>
                                    </div>
                                </div>
                                <br/><br/>
                                <h3>FORM 1(bb)</h3>
                                <h3><em>[See rules 4(2), 8(2)(a), 13(2) (iii) and 13(4)(ii)]</em></h3>
                                <h2>FORMAT FOR GRANTING AUTHORISATION FOR GENERATION OR STORAGE OR TREATMENT OR REFURBISHING OR DISPOSAL OF E-WASTE BY MANUFACTURER OR REFURBISHER</h2>
                                <br/>
                                <p><b>Ref:   Your application for Grant of Authorisation</b></p>
                                <table width="90%" align="center">
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
                                <div align="justify">
                                <ol>
                                    <li>Authorisation no. : <b><?=strtoupper($auth_no);?></b></li>
                                    <li>
                                        <b><?=strtoupper($companyName);?></b> of <b><?=strtoupper($key_person);?></b> is hereby granted an authorisation for generation, storage, treatment, disposal of e-waste on the premises situated at <b><?=strtoupper($address);?></b> for the following:
                                        <ol type="a">
                                            <li>Quantity of e-waste : <b><?=strtoupper($e_quantity);?></b></li>
                                            <li>Nature of e-waste : <b><?=strtoupper($e_nature);?></b></li>
                                        </ol>
                                    </li>
                                    <li>
                                        The authorisation shall be valid for a period from <b><?=date('d-m-Y',strtotime($issue_date));?></b> to <b><?=date('d-m-Y',strtotime($valid_upto));?></b>
                                    </li>
                                    <li>
                                        The e-waste mentioned above shall be treated/ disposed off in a manner <b><?=strtoupper($e_manner);?></b> at <b><?=strtoupper($e_treated_at);?></b>.
                                    </li>
                                    <li>
                                        The authorisation is subject to the conditions stated below and such conditions as may be specified in the rules for the time being in force under the  Environment (Protection) Act, 1986.
                                    </li>
                                </ol>
                            </div>
                            <br/>
                            <table width="100%">
                                <tr>
                                    <td>Place of issue : GUWAHATI</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Date of issue : <?php echo date("d-m-Y",strtotime($issue_date)); ?></td>
                                    <td align="center"><?=strtoupper($key_person);?><br/>
                                    Authorized Signatory</td>
                                </tr> 
                            </table>
                            <br/>	
                            <div class="row" style="padding-left:5%;padding-bottom:20px;">
                                <?php if($total_fees!=""){?>
                                <div style="width:70%;position:relative;float:left;text-align:left">
                                    <span class="details" style="padding-bottom:5px"><u>Details of Fees Paid</u></span>
                                    <p style="margin-top:5px;font-family:sans-serif;font-size:14px;">
                                        1. Regular Fees for the year<?=$lic_exp_year; ?> : Rs. <?=$regular_fees; ?>.00</p>
                                    <p style="margin-top:5px;font-family:sans-serif;font-size:14px;">
                                        2. Arrear Fees for the year<?=$arrear_fees_details_y1;?> to <?=$arrear_fees_details_y2;?>:  Rs. <?=$arrear_fees_details_fees; ?>.00</p>
                                    <p style="margin-top:5px;font-family:sans-serif;font-size:14px;">
                                        3. Penalty/other charges : Rs. <?=$penalty_charge; ?>.00</p>
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
                            <p><b>Terms and conditions of authorisation</b></p>
                            <div align="justify">
                                <ol type="1">
                                    <li>The authorisation shall comply with the provisions of the Environment (Protection) Act, 1986, and the rules made thereunder.</li>
                                    <li>The authorisation or its renewal shall be produced for inspection at the request of an officer authorized by the concerned State Pollution Control Board.</li>
                                    <li>Any unauthorised change in personnel, equipment as working conditions as mentioned in the application by the person authorized shall constitute a breach of his authorisation.</li>
                                    <li>It is the duty of the authorised person to take prior permission of the concerned State Pollution Control Board to close down the operations.</li>
                                    <li>An application for the renewal of an authorisation shall be made as laid down in sub-rule (vi) of rule 13(2).</li>
                                </ol>
                            </div>
                            <br/><br/>
                            <div style="clear:both"></div>
                            </div>
                    </div><!--End of .box-body--> 
                </div><!--End of .box-->                    
            </div><!--End of .content-wrapper-->
            <?php $this->load->view("staffs/requires/footer"); ?>
        </div><!-- End of .wrapper-->
     
       

    </body>
</html>
