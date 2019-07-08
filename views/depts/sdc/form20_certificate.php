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
	//$lic_exp_year = $formCertRow->$lic_exp_year;
		$regular_fees = $formCertRow->regular_fees;
		$arrear_fees_details = $formCertRow->arrear_fees_details;
		$penalty_charge = $formCertRow->penalty_charge;
		$lic_exp_year = $formCertRow->lic_exp_year;
		$lic_no = $formCertRow->lic_no;

		$valid_upto = $formCertRow->valid_upto;

				
		if($formCertRow->lic_no == "")
			{
				$license_no=" ";
			}
		else
		{
		$license_no=$formCertRow->lic_no;
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

if(!empty($formRow->drug)){
		$drug=json_decode($formRow->drug);
		$drug_licence_no=$drug->licence_no;
                $drug_form_no=$drug->form_no;
                $drug_validity=$drug->validity;
                $drug_doissue=$drug->doissue;
	}else{
		$drug_licence_no="";$drug_form_no="";$drug_validity="";$drug_doissue="";
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
<!---copied from sdc_certificate20.php--->
<div align="center" style="padding: 10px 20px;width:99%; border:2px solid black;">	

		<img src="<?=base_url('public/imgs/assam.png')?>" class="alomlogoimg" />		<br/>		<br/>
		<br/>
		<h4><b>STATE DRUGS CONTROL ADMINISTRATION (Assam State)</b></h4>
		<h4><b><u>Additional Product Permission</u></b></h4>
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
		<p align="justify"><b><?=strtoupper($companyName)?></b><br/>Address : <?=$address;?></p>
		<p align="justify">Ref : Your Inward Application vide UAIN : <b><?=strtoupper($uain)?></b></p>
		<p align="justify">With Reference to your Inward application, we have to inform you that your said application is considered &amp; following <b>PRODUCTS PERMISSION</b> have been granted, under the following <b>LICENCES</b>.</p>
		<table width="100%" class="table table-bordered">
			<tr>
				<th width="40%">Type</th>
				<th width="20%">Form</th>
				<th width="20%">LIC No/ Validity</th>
				<th width="20%">First Issue/ Raw</th>
			</tr>
			<tr>
				<td>Own : At my OWN Manufacturing Premises</td>
				<td><?=strtoupper($drug_form_no);?></td>
				<td><?=strtoupper($lic_no);?>, <?=date('d-m-Y',strtotime($valid_upto));?></td>
				<td><?=date('d-m-Y',strtotime($drug_doissue));?></td>
			</tr>
		</table>
		<table width="100%" class="table table-bordered">
			<tr>
				<th width="5%">Sl No.</th>
				<th width="30%">Name of the product</th>
				<th width="30%">Composition</th>
				<th width="15%">Strength</th>
				<th width="20%">Claim</th>
			</tr>
		
			<?php 
						$personalized_array = array("form_id"=>$form_id);
						$forms_t1_Row = $this->forms_model->get_personalized_rows($this->dept_code, $form_table."_t1", $personalized_array);
						$sl=1;
						if($forms_t1_Row){
							foreach($forms_t1_Row as $rows){ ?>
							<tr >
								<td><?=strtoupper($sl);?></td>
								<td><?=strtoupper($rows->name_of_product);?></td>
								<td><?=strtoupper($rows->coposition);?></td>
								<td><?=strtoupper($rows->strength);?></td>
								<td><?=strtoupper($rows->claim);?></td>


							</tr>
							<?php 
								$sl++;
							} 
						} 
						?>
			
			
			
					
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			
		</table>
		<div class="col-sm-12" style="padding:0;">
			<div class="col-sm-6">
				<p align="justify"></p>
			</div>					
			<div class="col-sm-6 pull-right" >
				<p align="center"><?php echo strtoupper($sign); ?><br/>State Licensing Authority<br/>
				State Drug Control Administration<br/>
				Hengrabari, Guwahati-36, Assam</p>
			</div>	
		</div>
		<br/>
		<table width="100%">
			<tr>
				<td>Date : <?php echo date('d-m-Y',strtotime($issue_date)); ?></td>
				<td></td>
			</tr>
			<tr>
				<td>Place : <?php echo $dist;?></td>
				<td></td>
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
	    <p align="center"><b><u>Condition of Licence</u></b></p>
	    <div align="justify">
	        <ol>
				<li>Licensee should comply with all the provisions of Drugs & Cosmetics Acts, 1940 &amp; Rules 1945 as amended up to date.</li>
				<li>Licensee should comply with all provisions of Drugs(Price Control) Order 2013 as amended up to date (wherever applicable).</li>
				<li>Licensee should abide by all the provisions of Drugs &amp; Magic Remedies (Objectionable Advertisement) Act, 1954 &amp;  Rules 1955 as amended up to date.</li>
				<li>Licensee should not manufacturing and drug/ cosmetics by a name belonging to another manufacturer.</li>
				<li>Licensee should not manufacturer or sell drug/ cosmetics even if it is included in the approved list of product, if it is or as and when banned by Licensing Authority or Drugs Controller General of India or Government of India.</li>
				<li>The Permission is granted subject the condition that, the product is safe for use in context of pharmaceutical Aids ,Additions and excipient used in the formulation.</li>
				<li>Any addition thereto or any detention therefore will not be carried out without permission of Licensing Authority</li>
	        </ol>
	    	</div>
	<!---copied--->
	</div>
                        </div><!--End of .alomcertbl-->
                    </div><!--End of .box-body--> 
                </div><!--End of .box-->                    
            </div><!--End of .content-wrapper-->
            <?php $this->load->view("staffs/requires/footer"); ?>
        </div><!-- End of .wrapper-->
    </body>
</html>