<?php
$cafRow = $this->cafs_model->get_row($swr_id);
if($cafRow) {
    $ubin = $cafRow->ubin;
    $companyName = $cafRow->Name;
    $companyOwner = $cafRow->Name_of_owner;
    $status_applicant=$cafRow->status_applicant;
    $business_type = $cafRow->business_type;
    //$business_type=$cafRow->sector_classes_b;	
    //$business_type=get_sector_classes_b_value($business_type);	
    $l_o_business=$cafRow->Type_of_ownership;
    $key_person=$cafRow->Key_person;
    $street_name1=$cafRow->b_street_name1 ." , ".$cafRow->b_street_name2;
    $dist=$cafRow->b_dist;
    $address=$street_name1." , ".$dist;
}//End of if
$params['data'] = $uain;
$params['level'] = 'H';
$params['size'] = 10;
$params['savename'] = 'storage/temps/qrcode.png';
$this->ciqrcode->generate($params);
$formCertRow = $this->formcertifcates_model->get_row($this->dept_code, $form_table, $form_id);
if($formCertRow) {
	$lic_exp_year_from = $formCertRow->lic_exp_year_from;
	$lic_exp_year = $formCertRow->lic_exp_year;
    $sub_date = $formCertRow->sub_date;
    $total_fees = $formCertRow->total_fees;
    $arrear_fees_details = $formCertRow->arrear_fees_details;
    $regular_fees = $formCertRow->regular_fees;
    $penalty_charge = $formCertRow->penalty_charge;
    $production_capacity = $formCertRow->production_capacity;
    $act = $formCertRow->act;
    $penalty_charge = $formCertRow->penalty_charge;
    $terms = $formCertRow->terms;
    $industry_category = $formCertRow->industry_category;
    
   
	/*if(date("m")>3){
		$lic_exp_year_from=$lic_exp_year-1;
	}else{
		$lic_exp_year_from=$lic_exp_year;
	}*/
    if($formCertRow->act==1){
		$act="21 of Air (Prevention and Control of Pollution ) Act, 1981";
	}elseif($formCertRow->act==2){
		$act="25 of Water (Prevention and Control of Pollution ) Act, 1974";
	}elseif($formCertRow->act==3){
        $act="21 of Air (Prevention and Control of Pollution ) Act, 1981 and 25 of Water (Prevention and Control of Pollution ) Act, 1974";
    }else{
        $act=$formCertRow->act;
    }
 
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
	 $sub_date= $total_fees= $lic_exp_year= $regular_fees= $arrear_fees_details= $penalty_charge= $production_capacity= $act= $terms= "Not Found!";
}
$formCertRow = $this->formprocess_model->get_row($this->dept_code, $form_table, $form_id);
if($formCertRow) {
	$issue_date = $formCertRow->p_date;
	
} else {
	$issue_date= "Not Found!";
}

/*$formRow = $this->forms_model->get_uainrow($this->dept_code, "pcb_form1", $uain);
$form_id = $formRow->form_id;
$swr_id=$formRow->user_id;
$sub_date=$formRow->sub_date;
$production_capacity="capacity";
$total_fees=1001;
$act=1;
$terms='{"obj":["cond2","cond3","cond4"]}';
if ($act == 1) {
    $act = "21 of Air (Prevention and Control of Pollution ) Act, 1981";
} elseif ($act == 2) {
    $act = "25 of Water (Prevention and Control of Pollution ) Act, 1974";
} elseif ($act == 3) {
    $act = "21 of Air (Prevention and Control of Pollution ) Act, 1981 and 25 of Water (Prevention and Control of Pollution ) Act, 1974";
} else {
    $act = "Not Found!";
}
$regular_fees=1000;
$lic_exp_year=2020;
if(date("m")>3){
        $lic_exp_year_from=$lic_exp_year-1;
}else{
        $lic_exp_year_from=$lic_exp_year;
}
$penalty_charge=1000;
$arrear_fees_details=json_decode('{"y1":"","y2":"","y3":"","y4":"","fees":""}');
$arrear_fees_details_y1=$arrear_fees_details->y1;
$arrear_fees_details_y2=$arrear_fees_details->y2;
$arrear_fees_details_y3=$arrear_fees_details->y3;
$arrear_fees_details_y4=$arrear_fees_details->y4;

$formProcessRow = $this->formprocess_model->get_row($this->dept_code, "pcb_form1", $form_id);
$p_date=$formProcessRow->p_date;*/
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
                        <!--<a href="<?=base_url('staffs/certificates/getpdf/'.$uain)?>" class="btn btn-info backbtn-alm" target="_blank">
                            <i class="fa fa-file-pdf-o"></i> Download
                        </a>-->
                        <button class="btn btn-warning backbtn-alm printbtn">
                            <i class="fa fa-print"></i> Print
                        </button>
                    </h3><!--End of .boxalm-head-->
                    <div class="box-body"> 
                        <div class="border alomcertbl printcontent">
                                <div id="header">
                                    <div style="font-family:lucidacalligraphy">
                                        <img class="logo" style="margin-left:30px;margin-top:10px;float:left;" src="<?=base_url('public/imgs/logopcb.jpg')?>"/>
                                        <h1 align="left" style="margin-top:10px;padding-left:190px">Pollution Control Board</h1>
                                        <h1 align="left" style="padding-left:300px">Assam</h1>
                                        <br/>
                                    </div>
                                </div>
                                <br/><br/>
                                <table width="90%" align="center">
                                    <tr>
                                        <td style="width:60%;padding-left:10px;line-height:30px">UBIN : <?=$ubin?><br/>UAIN : <?=$uain?></td>
                                        <td style="width:40%;text-align:right;">Fees :  <strong>Rs.<?=$total_fees;?></strong></td>
                                    </tr>
                                </table>
                                <h1 class="stl_line" style="padding-bottom:10px;font-family:fontdatafan;text-align:center;">
                                    <u>"CONSENT TO ESTABLISH"</u>
                                </h1>
                                <p align="center" style="padding:0px 20px 5px 20px;text-align:center;font-family:lucidacalligraphy;font-size:1.3em;line-height:32px">            
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    "<strong>CONSENT TO ESTABLISH</strong>" is hereby granted to <br/><strong><?=$companyName?></strong><br/>for setting up a <br/><strong><?=$business_type;?></strong><br/>unit with production capacity of <strong><?=$production_capacity;?></strong><br/>to be located at <strong><?=$address; ?></strong><br/>under section <strong><?=$act;?></strong><br/>as amended under the concerned terms & conditions according to type of industry.
                                </p>
                                <p align="justify" style="padding:20px 30px 5px 30px;font-family:lucidacalligraphy;line-height:25px">            
                                    This Consent to Establish is valid for a period of 5(five) years from the date of issue of this certificate or upto the date of commissioning of the unit, whichever is earlier, subject to terms and conditions annexed herewith.    
                                </p>
                                <br/><br/>
                                <table align="center" style="width:99%;font-family:sanserif;">
                                    <tr>
                                        <td style="width:50%;padding-left:40px;">
                                            Place : Guwahati<br/>
                                            Date : <strong><?=date("d-m-Y", strtotime($issue_date))?></strong>
                                        </td>
                                        <td style="width:50%;padding-right:40px;text-align:right;">
                                            <?php echo strtoupper($companyOwner) ?><br/><br/>Authorized Signatory
                                        </td>
                                    </tr>                    
                                </table>
                                <br/>
                                <div class="row" style="padding-left:5%;padding-bottom:20px;">
                                    <div style="width:70%;position:relative;float:left">
                                        <span class="details" style="padding-bottom:5px"><u>Details of Fees Paid</u></span>
                                        <p style="margin-top:5px;font-family:sans-serif;font-size:14px;">
                                            1. Regular Fees for the year 
                                               <?= $lic_exp_year_from;?> to <?=$lic_exp_year; ?> :  
                                                Rs. <?=$regular_fees;?>
                                        </p>
                                        <p style="margin-top:5px;font-family:sans-serif;font-size:14px;">
                                            2. Arrear Fees for the year 
                                                <?=$arrear_fees_details_y1;?> to <?=$arrear_fees_details_y2;?>: 
                                                Rs. <?=$arrear_fees_details_fees;?>
                                        </p>
                                        <p style="margin-top:5px;font-family:sans-serif;font-size:14px;">
                                            3. Penalty/other charges : Rs. <?=$penalty_charge;?></p>
                                    </div>
                                    <div style="width:30%;position:relative;float:left;">
                                        <img src="<?=base_url('storage/temps/qrcode.png')?>" style="width: 120px; height: 120px">
                                    </div>
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
