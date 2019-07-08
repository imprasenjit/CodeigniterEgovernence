<?php
$cafRow = $this->cafs_model->get_row($swr_id);
if($cafRow) {
    $ubin = $cafRow->ubin;
    $companyName = $cafRow->Name;
    $companyOwner = $cafRow->Name_of_owner;
    $key_person=$cafRow->Key_person;
   // $street_name1=$cafRow->b_street_name1 ." , ".$cafRow->b_street_name2;
    $dist=$cafRow->b_dist;
   // $address=$street_name1." , ".$dist;
    
    $params['data'] = $uain;
    $params['level'] = 'H';
    $params['size'] = 10;
    $params['savename'] = 'storage/temps/qrcode.png';
    $this->ciqrcode->generate($params);
	
	$Street_name1=$cafRow->Street_name1;
	$Street_name2=$cafRow->Street_name2;
	$Vill=$cafRow->Vill;
	$Dist=$cafRow->Dist;
	$u_address=$Street_name1." , ".$Street_name2." , ".$Vill." , ".$Dist;
	
	
	$b_street_name1=$cafRow->b_street_name1;
	$b_street_name2=$cafRow->b_street_name2;
	$b_vill=$cafRow->b_vill;
	$b_dist=$cafRow->b_dist;
	$b_address=$b_street_name1." , ".$b_street_name2." , ".$b_vill." , ".$b_dist;
}//End of if 


$formCertRow = $this->formcertifcates_model->get_row($this->dept_code, $form_table, $form_id);
if($formCertRow) {
		$total_fees = $formCertRow->total_fees;
		$regular_fees = $formCertRow->regular_fees;
		$arrear_fees_details = $formCertRow->arrear_fees_details;
		$penalty_charge = $formCertRow->penalty_charge;
		$lic_exp_year = $formCertRow->lic_exp_year;		
		$sub_date = $formCertRow->sub_date;
		$license_no = $formCertRow->license_no;
		$valid_upto = $formCertRow->valid_upto;
		

		

		
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

if(!empty($formRow->address)){
		$address=json_decode($formRow->address);
		$address_s1=$address->s1;
		$address_s2=$address->s2;
		$address_d=$address->d;
		$address_p=$address->p;
	}else{				
		$address_s1="";
		$address_s2="";
		$address_d="";
		$address_p="";
	}

	if(!empty($formRow->supplier)){
		$supplier=json_decode($formRow->supplier);
		$supplier_n=$supplier->n;
		$supplier_s1=$supplier->s1;
		$supplier_s2=$supplier->s2;
		$supplier_d=$supplier->d;
		$supplier_v=$supplier->v;
		$supplier_p=$supplier->p;
		$supplier_mno=$supplier->mno;
	}else{
		$supplier_n="";
		$supplier_s1="";
		$supplier_s2="";
		$supplier_d="";
		$supplier_v="";
		$supplier_p="";
		$supplier_mno="";
	}
	$supplier_address=$supplier_s1." , ".$supplier_s2." , ".$supplier_v." , ".$supplier_d;
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
<!--copied from fcs_form10_certificate.php-->
					<div align="center" style="padding: 10px 30px;width:99%; border:2px solid black;">
		<h2 class="text-uppercase">DIRECTORATE OF FOOD & CIVIL SUPPLIES</h2>
		<img src="<?=base_url('public/imgs/assam.png')?>" class="alomlogoimg" />	
			<br/>
			<h4><b>ASSAM : GUWAHATI- 781005</b></h4>
			<h4><b>FORM FOR LICENCE FOR AN EXISTING UNIT/ PROPOSED UNIT FOR TRADING FINISHED LUBRICATING OILS/ GREASES SPECIALITIES/ RENEWALS OF LICENCE</b></h4>
			<br/>
			<table width="100%">
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
			<p align="justify">Licence to carry on the business of a processor (only for the activity of sale) is hereby granted to the party at the place and subject to the terms and conditions below and provisions of the Lubricating Oils and Greases (Processing, Supply and Distribution Regulation) Order, 1987.</p>
			<br/>
			
			<p align="justify"><b>Description of the party, the location of the unit and product (s)</b></p>
			<p align="justify" style="text-indent: 14px;">1. Full name of the licence holder: <?=strtoupper($key_person);?></p>
			<p align="justify" style="text-indent: 14px;">2. Address in full: <?=strtoupper($u_address);?></p>
			<p align="justify" style="text-indent: 14px;">3. Location of the place (s) of business/ address: <?=strtoupper($b_address);?></p>
			<p align="justify" style="text-indent: 14px;">4. Licence No: <?=strtoupper($license_no);?></p>
			<p align="justify" style="text-indent: 14px;">5. Date of issue: <?=date('d-m-Y',strtotime($issue_date))?></p>
			<p align="justify" style="text-indent: 14px;">6. Valid upto: <?=date('d-m-Y',strtotime($valid_upto))?></p>
			<p align="justify" style="text-indent: 14px;">7. Name of the Company/ Companies whose product he is trading: <?=strtoupper($companyName)?></p>
			<p align="justify" style="text-indent: 14px;">8. Name of supplier & address in full: <?=strtoupper($supplier_n)?>, <?=strtoupper($supplier_address)?></p>
			<br/>
			<!---KK --->
			
			<table width="100%">
				<tr>	
					<td>Place of issue : GUWAHATI</td>
					<td></td>
				</tr>
				<tr>
					<td>Date of issue : <?php echo date("d-m-Y",strtotime($issue_date)); ?></td>
					<td align="right"><b>Competent Authority </br> State of Assam</b></td>
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
			
			<div class="row">
			
			<h4 class="newpage"><b>TERMS AND CONDITIONS OF THE LICENCE:</b></h4>
				<div align="justify">
					<ol>
						<li>The licence is issued subject to the provisions of the Lubricant Oils and Greases (Processing, Supply and Distribution Regulation) Order, 1987.</li>
						<li>The holder of the licence shall maintain correctly and completely such records as are necessary for verifying the particulars given in the application form of the applicant and this licence granted to him.</li>
						<li>The holder of the licence shall permit an Officer authorised by the competent authority under the provisions of the Lubricating Oils and Greases (Processing, Supply and Distribution Regulation) Order, 1987 to inspect the places where trading of lubricating Oils or greases is being undertaken, shall furnish samples thereof, shall permit on demand by such Officer such records or documents in his possession or under his control and shall allow to enter or search any premises and seize any articles to which this order applies.</li>
					</ol>
				</div>
			</div>
		</div>
		<!--copied-->
		    </div><!--End of .row-->
                        </div><!--End of .alomcertbl-->
                    </div><!--End of .box-body--> 
                </div><!--End of .box-->                    
            </div><!--End of .content-wrapper-->
            <?php $this->load->view("staffs/requires/footer"); ?>
        </div><!-- End of .wrapper-->
    </body>
</html>