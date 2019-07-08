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
	

		

$formCertRow = $this->forms_model->get_row($this->dept_code, $form_table, $form_id);

if($formCertRow) {
		$category = $formCertRow->category;
}else {
	$category = "No record found" ;
}
	

if(!empty($formRow->supervision)){

		$supervision=json_decode($formRow->supervision);
		$supervision_n1=$supervision->n1;
		$supervision_n2=$supervision->n2;
		$supervision_q1=$supervision->q1;
		$supervision_q2=$supervision->q2;
		if(isset($supervision->reg) && !empty($supervision_reg->reg))  $supervision_reg=$supervision->reg; else $supervision_reg="";
	
	/*	if(isset($supervision->reg)) $supervision_reg=$supervision->reg; 
		else $supervision_reg=""; */
	}
	else{				
		$supervision_n1="hh";$supervision_n2="yy";$supervision_q1="zz";$supervision_q2="";$supervision_reg="kk";
	}

$formCertRow = $this->formcertifcates_model->get_row($this->dept_code, $form_table, $form_id);
if($formCertRow) {
		$total_fees = $formCertRow->total_fees;
	//$lic_exp_year = $formCertRow->$lic_exp_year;
		$regular_fees = $formCertRow->regular_fees;
		$arrear_fees_details = $formCertRow->arrear_fees_details;
		$penalty_charge = $formCertRow->penalty_charge;
		$lic_exp_year = $formCertRow->lic_exp_year;
		$license_no = $formCertRow->license_no;
		$license_no21 = $formCertRow->license_no21;
	
	
	if($formCertRow->license_no == "")
	 {
		$license_no=" ";
		}
	else
	{
		$license_no=$formCertRow->license_no;
	}
    if($formCertRow->license_no21 == "")
	 {
		$license_no21=" ";
		}
	else
	{
		$license_no=$formCertRow->license_no21;
	}
    
	
	
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

						<!--pasted from sdc_form3_certificate-->
<div align="center" style="padding: 10px 20px;width:99%; border:2px solid black;">


   <img src="<?=base_url('public/imgs/assam.png')?>" class="alomlogoimg" />		<br/>
		<br/>
		<h4><b>STATE DRUGS CONTROL ADMINISTRATION</b></h4>
		<h4><b>FORM 21&ndash;B</b></h4>
		<h4><b><em>Licence to sell, stock or exhibit [or offer] for sale, or distribute by wholesale drugs specified in Schedules C and C (1)[Excluding those specified in Schedule X]</em></b></h4>
		<br/>
		<table width="100%"  >
			<tr>
				<td>UBIN : <b><?php echo $ubin; ?></b></td>
				<td align="right">UAIN : <b><?php echo $uain; ?></b></td>
				
			</tr>
			<tr>
				<td>License No: <?=strtoupper($license_no21);?></td>
				<td align="right"><?php if($total_fees!=""){?>Fees Paid : <b><?php echo "Rs. ".$total_fees; ?><?php }?></b></td>
			</tr>
		</table>
		<br/>
		<p align="justify">1. <?php echo strtoupper($key_person);?> of <?=strtoupper($companyName);?> is hereby licensed to sell stock or exhibit [or offer] for sale, or distribute by wholesale on the premises situated at <?php echo strtoupper($address);?> the following categories of drugs specified in Schedules C and C(1) [excluding those specified in Schedule X] to the Drugs and Cosmetics Rules, 1945, subject to the conditions specified below and to the provisions of the Drugs and Cosmetics Rules 1940, and the Rules thereunder.</p>
		<p align="justify">2.The licence unless sooner suspended or cancelled, shall remain valid perpetually. However, the compliance with the conditions of licence and the provisions of the Drugs and Cosmetics Act, 1940 (23 of 1940) and the Drug and Cosmetics Rules, 1945 shall be assessed not less than once in three years or as needed as per risk based approach.</p>
		<p align="justify">3. Categories of drugs <br/><?php echo strtoupper($category);?></p>
		<p align="justify">4.The sale shall be made under the personal supervision of competent person. (Name of the competent persons)<br/>
		<?php echo strtoupper($supervision_n1); if($supervision_n2!=""){ echo ", ".strtoupper($supervision_n2);}?>
		</p>
		<br/>
		<br/>
		<table width="100%">
			<tr>	
				<td>Place of issue : GUWAHATI</td>
				<td align="right"><?=strtoupper($sign); ?></td>
			</tr>
			<tr>
				<td>Date of issue : <?php echo date("d-m-Y",strtotime($issue_date)); ?></td>
				<td align="right">Licensing authority</td>
			</tr> 
		</table>
		<br/>
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
		<h4 class="newpage"><b>Condition of Licence</b></h4>
		<p align="justify">1. This licence shall be displayed in a prominent place in a part of the premises open to the public.</p>
		<p align="justify">2. If the licensee wants to sell stock or exhibit for sale, or distribute, during the currency of the licence, additional categories of drugs listed in Schedules C and C (1) excluding those specified in Sch. X but not included in this licence, her should apply to the Licensing Authority for the necessary permission. This licence will be deemed to extend to the categories of drugs in respect of which such permission is given. This permission shall be endorsed on the licence by the Licensing Authority.</p>
		<p align="justify">3.i. No drug shall be sold unless such drug is purchased under a cash or credit memo from the duly licensed dealer or duly licensed manufacturer.</p>
		<p align="justify" style="text-indent:10px;">ii. No sale of any shall be made to a person not holding the requisite licence to sell,stock or exhibit for sale or distribute the drug.</p>
		<p align="justify">Provided that the conditions shall not apply to the sale of any drug to:-</p>
		
		<p align="justify" style="text-indent:24px;">a)An officer or authority purchasing on behalf of Government, or</p>
		<p align="justify" style="text-indent:24px;">b) A hospital, medical, educational or research institution or a registered medical practitioner for the purpose of supply to his patents, or,</p>
		<p align="justify" style="text-indent:24px;">c) A manufacturer beverages, confectionary biscuits and other non-medicinal products, where such drugs are required for processing these products.</p>
		
		<p align="justify">4. The sale shall be made under the personal supervision of a competent person. (Name of the competent person).</p>
		<p align="justify">5. The licence shall inform the Licensing Authority in writing in the event of any change in the constitution of the firm operating under licence. Where any change in the constitution of the firm takes place, the current licence shall be deemed to be valid for a maximum period of three months from the date on which the change takes place unless, in the meantime, a fresh licence has been taken from the Licensing Authority in the name of the firm with the changed constitution.</p>
	
	<!-- end of pasted codes from sdc_form3_certificate-->
</div>
                        </div><!--End of .alomcertbl-->
                    </div><!--End of .box-body--> 
                </div><!--End of .box-->                    
            </div><!--End of .content-wrapper-->
            <?php $this->load->view("staffs/requires/footer"); ?>
        </div><!-- End of .wrapper-->
    </body>
</html>