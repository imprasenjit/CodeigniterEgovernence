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
		$regular_fees = $formCertRow->regular_fees;
		$arrear_fees_details = $formCertRow->arrear_fees_details;
		$penalty_charge = $formCertRow->penalty_charge;
		$lic_exp_year = $formCertRow->lic_exp_year;
		$license_no = $formCertRow->license_no;


	
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
	
	$formProcessRow = $this->formprocess_model->get_issue_row($this->dept_code, $form_table, $form_id);
if($formProcessRow) {
	$issue_date = $formProcessRow->p_date;
	$issuing_officer_id = $formProcessRow->user_id;
	$user_row = $this->deptusers_model->get_row($issuing_officer_id, $this->dept_code);
	$sign = $user_row->user_name;
} else {
	$issue_date= "Not Found!";
	$issuing_officer_id= "";
}	



$formRow = $this->forms_model->get_row($this->dept_code, $form_table, $form_id);
	
	$category = $formRow->category;


if(!empty($formRow->supervision)){

		$supervision=json_decode($formRow->supervision);
		$supervision_n1=$supervision->n1;
		$supervision_n2=$supervision->n2;
		$supervision_q1=$supervision->q1;
		$supervision_q2=$supervision->q2;
		if(isset($supervision->reg) && !empty($supervision_reg->reg))  $supervision_reg=$supervision->reg; else $supervision_reg="";
	
	}
	else{				
		$supervision_n1="";$supervision_n2="";$supervision_q1="";$supervision_q2="";$supervision_reg="";
	}	
	?>

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
                        <a href="<?=base_url('staffs/certificates/getpdf/'.encodeme($uain))?>" class="btn btn-info backbtn-alm" target="_blank">
                            <i class="fa fa-file-pdf-o"></i> Download
                        </a>
                        <button class="btn btn-warning backbtn-alm printbtn">
                            <i class="fa fa-print"></i> Print
                        </button>
                    </h3><!--End of .boxalm-head-->
                    <div class="box-body">
                        <div class="alomcertbl printcontent">
						
						<!-- copied codes from sdc_form2_certificate.php -->
<div align="center" style="padding: 10px 20px;width:99%; border:2px solid black;">
					
   <img src="<?=base_url('public/imgs/assam.png')?>" class="alomlogoimg" />		<br/>
		<h2 class="text-uppercase"><?=strtoupper($this->dept_name); ?></h2>
		<h4>Form 21</h4>
		<h4>Rule 61(2)</h4>
		<h4><em>License to sell stock or exhibit [or offer] for sale or distribute by retail drugs specified in Schedule C and C (1) [exceeding those specified in Sch. X]</em></h4>
		<br/>
		<table width="100%"  >
			<tr>
				<td>UBIN : <b><?php echo $ubin; ?></b></td>
				<td align="right">UAIN : <b><?php echo $uain; ?></b></td>				
			</tr>
			<tr>
				<td>License No: <?=strtoupper($license_no);?></td>
				<td align="right"><?php if($total_fees!=""){?>Fees Paid : <b><?php echo "Rs. ".$total_fees; ?><?php }?></b></td>
			</tr>
		</table>
		<br/>
		<p align="justify">1. <?php echo strtoupper($key_person);?> of <?php echo strtoupper($companyName);?> is hereby licensed to sell, stock or exhibit [or offer] for sale or distribute by retail drugs other than those specified in [Schedules C, C (1) and X] of the Drugs and Cosmetics Rules, 1945 and to operate a pharmacy on the premises situated at <?php echo strtoupper($address);?> subject to the conditions specified below and to the provisions of the Drugs and Cosmetics Act 1940 and rules thereunder.</p>
		<br/>
		<p align="justify">2. The licence unless sooner suspended or cancelled, shall remain valid perpetually. However, the compliance with the conditions of licence and the provisions of the Drugs and Cosmetics Act, 1940 (23 of 1940) and the Drug and Cosmetics Rules, 1945 shall be assessed not less than once in three years or as needed as per risk based approach.</p>
		<br/>
		<p align="justify">3. Name(s) of qualified person(s) in charge<br/>
		<?php echo strtoupper($supervision_n1); if($supervision_n2!=""){ echo ", ".strtoupper($supervision_n2);}?>
		</p>
		<br/>
		<p align="justify">4. Categories of drugs<br/><?php echo strtoupper($category);?></p>
		<br/>
		
		<table width="100%">
			<tr>
				<td>Place of issue : GUWAHATI</td>
				<td></td>
			</tr>
			<tr>
				<td>Date of issue : <?php echo date("d-m-Y",strtotime($issue_date)); ?></td>
				<td align="center"><?//=strtoupper($sign);?><br/><?//=strtoupper($design);?><br/>Authorised Signatory</td>
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
		<h4 class="newpage"><b>Conditions of License</b></h4>
		<p align="justify">1. This licence shall be displayed in a prominent place in a part of the premises open to the public.</p>
		<p align="justify">2. The licensee shall to the licensing authority any change in the qualified staff-in- charge within one month of such change.</p>
		<p align="justify">3. If the licensee wants to sell, stock, = or exhibit for sale or distribute, during the currency of the license, additional categories of drugs listed in Schedule C and C (1) [excluding those specified in Sch. X] but not included in this license, he should apply to the Licensing Authority for necessary permission. This license will be deemed to extent to the categories of drugs in respect of which such permission is given. This permission shall be endorsed on the license by the Licensing Authority.</p>
		<p align="justify">4. No drug shall be stocked or sold unless such drug has been purchased under cash/ credit memo from a duly licensed dealer or a duly licensed manufacturer.</p>
		<p align="justify">5. The license shall inform the licensing authority in writing in the event of any change in the constitution of the firm operating under the license. Where any change in the constitution of the firm takes place, the current license shall be deemed to be valid for a maximum period of three months from the date on which the change takes place unless in the meantime, a fresh license has been taken from the licensing authority in the name of the firm with the changed constitution.</p>
	</div>
                        </div><!--End of .alomcertbl-->
                    </div><!--End of .box-body--> 
                </div><!--End of .box-->                    
            </div><!--End of .content-wrapper-->
            <?php $this->load->view("staffs/requires/footer"); ?>
        </div><!-- End of .wrapper-->
    </body>
</html>