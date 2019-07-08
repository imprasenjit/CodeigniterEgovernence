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
    $area_alloted = $formCertRow->area_alloted;
	$dev_charge = $formCertRow->dev_charge;
	$spec_charge = $formCertRow->spec_charge;
	$ann_grnd_rent = $formCertRow->ann_grnd_rent;
	$security_money = $formCertRow->security_money;
    $regular_fees = $formCertRow->regular_fees;
    $lic_exp_year = $formCertRow->lic_exp_year;
    $arrear_fees_details = $formCertRow->arrear_fees_details;
    $penalty_charge = $formCertRow->penalty_charge;
	$total_dev_charge = $formCertRow->total_dev_charge;
	$total_charge = $formCertRow->total_charge;
	$total_security_money = $formCertRow->total_security_money;
	//$in_words = $formCertRow->in_words;
   
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
	
	$formRow = $this->forms_model->get_row($this->dept_code, $form_table, $form_id);
if($formRow) {
	$indus_land = $formRow->indus_land; 
	$item_name = $formRow->item_name;
	$authority = $formRow->authority;
	 }
 else {
	$indus_land = "Not found";
	$item_name = "Not found";
	$authority = "Not found";
}
}
//$formRow = $this->forms_model->get_row($this->dept_code, $form_table, $form_id);
else {	 
	
	$area_alloted = "Not Found";
	$dev_charge = "Not Found";
	$spec_charge = "Not Found";
	$ann_grnd_rent = "Not Found";
	$security_money = "Not Found";
	$total_dev_charge = "not found";
	$total_charge = "not found";
	$total_security_money = "not found";
	$total_fees=0;
		$regular_fees=0;
		$lic_exp_year=0;
}  
$formProcessRow = $this->formprocess_model->get_row($this->dept_code, $form_table, $form_id);
if($formProcessRow) {
	$p_date = $formProcessRow->p_date;
} else {
	$p_date= "Not Found!";

}

$formProcessRow = $this->formprocess_model->get_row($this->dept_code, $form_table, $form_id);
if($formProcessRow) {
    
} else {
    
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
                        <div class="alomcertbl printcontent">
							
	<div style="padding: 10px; border:2px solid black;">
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
				<td>UBIN : <b><?php echo $ubin; ?></b></td>
				<td align="right">UAIN : <b><?php echo $uain; ?></b></td>
				
			</tr>
			<tr>
				<td></td>
				<td align="right"><?php if($total_fees!=""){?>Fees Paid : <b><?php echo "Rs. ".$total_fees; ?><?php }?></b></td>
			</tr>
			
			<tr>
				<td colspan="4"> To </br> <b><?=strtoupper($companyName);?>,</b></br><?=strtoupper($address);?></td>
			</tr>
		</table>
		<br/>
		<p align="justify">The  is pleased to provisionally allot you a plot of land measuring <?=$area_alloted;?> Sq. Meter at <?=strtoupper($indus_land);?> on 20 (twenty) years lease basis as per the terms &amp; conditions stipulated in the AIDC&#39;s Land Management Rules, 2010 for setting up of a <?=strtoupper($item_name);?> Manufacturing unit subject to the following conditions:</p>
		<div style="text-align:justify;">
			<ol>
				<li>The allotment of land will be @ Rs. <?=$dev_charge;?> per Sq. Meter only towards Development charge. 100% of Development Charge has to be paid before taking over possession of the land. Further, you are to pay Annual Service charges @ 3% on Total Development Charge plus GST (as applicable), Special Maintenance charges @ Rs. <?=$spec_charge;?> per sq. Meter per month plus GST (as applicable) and Annual Ground Rent @ Rs. <?=$ann_grnd_rent;?> per 1000 Sq. Meter and part thereof as per the terms &amp; conditions as stipulated in the AIDC Land Management Rules. 2010.</li>
				<li>You shall have to take possession of the land within 60 (sixty) days from the date of allotment of land failing which the allotment shall be treated as cancelled.</li>
				<li>You shall have to deposit the Annual Service Charge as mentioned above, in advance from the date of handing over possession of land for the current financial year.</li>
				<li>You shall have to deposit post-dated cheques towards Special Maintenance Charge as mentioned above, for one year from the date of handing over possession of land.</li>
				<li>You shall have to deposit the Annual Ground Rent as mentioned above, from the date of handing over possession of land and before execution of Land Lease Agreement.</li>
				<li>Name of the Banker &amp; Solvency Certificate of the unit is to be submitted before handing over possession of land.</li>
				<li>You shall have to obtain &quot;No Objection Certificate / Consent&quot; from the Pollution Control Board within 3 (three) months from the date of allotment or the date of taking over possession of the land whichever is earlier.</li>
				<li>You shall have to submit an undertaking on an Non-Judicial Stamp Paper stating that you will not deviate from the product mix and manufacturing process for which the land has been allocated.</li>
			</ol>
		</div>
		<br/>
	   <p align="justify">Further, you are requested to deposit the following amounts in the manner as per terms &amp; mode of payment as stipulated in the AIDC Land Management Rules, 2010 as applicable to you prior to handing over the possession of the allotted land:</p>
		<table width="100%" align="center" style="padding-top:10px;width:90%;font-family:sans-serif;">
			<tr>
				<td style="width:70%;padding-left:10px;">a. Development Charges @ Rs. <?=$dev_charge;?> Per Sqm. for <?=$area_alloted;?> Sqm.</td>
				<td style="width:5%;"> = </td>
				<td style="width:5%;"> Rs. </td>
				<td style="padding-right:10px;" align="right"><?=sprintf("%0.2f",$total_dev_charge);?></td>
			</tr>
			<tr>
				<td style="width:70%;padding-left:10px;">b. Security Money @ Rs. <?=$security_money;?> for every 1000 Sqm. Or part thereof</td>
				<td style="width:5%;"> = </td>
				<td style="width:5%;"> Rs. </td>
				<td style="padding-right:10px;" align="right"><?=sprintf("%0.2f",$total_security_money);?></td>
			</tr>
			<tr>
				<td style="width:70%;padding-left:10px;">Total Payable Amount</td>
				<td style="width:5%;"> = </td>
				<td style="width:5%;"> Rs. </td>
				<td style="padding-right:10px;" align="right"><?=sprintf("%0.2f",$total_charge);?></td>
			</tr>
			<tr>
				<td colspan="4" align="right"><?=ucwords($in_words);?> Only</td>
			</tr>
		</table>
		<p align="justify" style="padding:30px;text-indent:24px;">
			You are requested to submit the lease agreement for execution along with incidental, stamped, registration charges etc. as per proforma approved by the Govt. of Assam for Industrial areas within 90 (Ninety) days from the date of issue of this provisional allotment letter failing which this allotment letter issued to you shall be treated as cancelled without further reference to you.
		</p>
		<table align="center" style="padding-top:10px;width:90%;font-family:sans-serif;">
			<tr>
				<td style="width:50%;padding-left:10px;">Thanking You,</td>
				<td style="width:50%;padding-right:10px;text-align:right;"><center>Yours faithfully<br/>
				For <?=strtoupper($dist);?></center></td>
			</tr>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
			<tr>
				<td style="width:50%;padding-left:10px;">Place : Guwahati<br/>Date : <?php echo date("d-m-Y",strtotime($p_date)); ?></td>
				<td style="width:50%;padding-right:10px;text-align:right;"><center><?=strtoupper($key_person); ?><br/><?php if($authority=="DICC"){ echo "General Manager";}else{ echo "Managing Director";}?><br/>Guwahati, Assam</center>
				</td>
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
		<div style="clear:both"></div>
	</div>
						
						<!-- copied -->
                        </div>
                    </div><!--End of .box-body--> 
                </div><!--End of .box-->                    
            </div><!--End of .content-wrapper-->
            <?php $this->load->view("staffs/requires/footer"); ?>
        </div><!-- End of .wrapper-->
    </body>
</html>
