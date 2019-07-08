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
		$sub_date = $formCertRow->sub_date;
		$lic_no=$formCertRow->lic_no;

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

if(!empty($formRow->mig_workmen)){				
		$mig_workmen=json_decode($formRow->mig_workmen);
		$mig_workmen_a=$mig_workmen->a;
		$mig_workmen_b=$mig_workmen->b;
		//$mig_workmen_c=$mig_workmen->c;
	}else{
		$mig_workmen_a="";
		$mig_workmen_b="";
		//$mig_workmen_c="";
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
						<!--copied from labour_form8_certificate.php-->
     <div align="center" style="padding: 10px 30px;width:99%; border:2px solid black;">	

	<img src="<?=base_url('public/imgs/assam.png')?>" class="alomlogoimg" />	
		<br/>
		<h4><b>Office of the Licensing Officer</b></h4>
		<br/>
		<table width="100%"  >
            <tr>
                <td>UBIN : <b><?php echo $ubin; ?></b></td>
                <td align="right">UAIN : <b><?php echo $uain; ?></b></td>
                
            </tr>
            <tr>
                <td></td>
                <td align="right"><b><?=($total_fees) ? "Rs. ".$total_fees : "" ;?></b></td>
            </tr>
		</table>
		<br/>
		<p align="justify">Licence No : <?=isset($lic_no) ? strtoupper($lic_no) : "NOT FOUND"; ?></p></br></br>
	<tr>
		<td colspan="4">
			<div style="text-align:justify;">
				<ol>
					<li>Licence is hereby granted <?=strtoupper($companyName);?> under Section 8(1) of the Inter-State Migrant Workman (Regulation of Employment and Conditions of Service) Act, 1979, subject to the
				   conditions specified in the annexure.</li>
					<li>This licence is for doing the work of  <b><?=strtoupper($mig_workmen_a);?></b> in the establishment of <b><?=strtoupper($key_person);?></b> at <b><?=strtoupper($companyName);?>, <?=strtoupper($address);?></b>.</li>
					<li>The licence shall remain in force till <?=date("d-m-",strtotime($issue_date));?><?=date("Y",strtotime($issue_date))+1?>.</li>
				</ol>
			</div>
		</td>
	</tr>
		<tr>
		<td colspan="4"><p align="center">ANNEXURE</p>
			
		<div style="text-align:justify;">
			<ol>
				<li>The licence shall be non-transferable.</li>
				<li>The number of workmen employed as migrant workman in the establishment shall not, on any day exceed the maximum number specified in the application for licence.</li>
				<li>Save as provided in these rules the fees paid for the grant or as the case may be for renewal of Licence shall be non refundable.</li>
				<li>The rates of wages payable to the migrant workmen by the Contractor shall not be less than the rates prescribed under the Minimum Wages Act, 1948 for such employment where applicable, and
               where the rates have been fixed by agreement, settlement or award,not less than the rates so fixe</li>
			   <li>(a) In cases where the migrant workmen employed by the Contractor perform the same or similar  kind of work as the workmen directly employed by the principal employer of the establishment the wages
              rates holidays, hours of work and other conditions of service of the migrant workmen of the contractor shall be the same as applicable to the workmen directly employed by the principal employer of the establishment on the same of or similar kind of work :</li>
			   <li>Every migrant workman shall be entitled to allowances, benefits,facilities,etc.,as prescribed in the Act and these rules.</li>
			   <li>No female migrant workmen shall be employed by any Contractorbefore 6 A.M. or after 7 P.M. :</br>
               Provided that this clause shall not apply to the employment of female migrant workmen in Pit head Baths, Creches and Canteens and as Midwives and Nurses in hospitals and dispensaries.</li>
			   <li>The Contractor shall notify any change in the number of migrant workmen or the conditions of work to the Licensing Officer.</li>
			   <li>The Contractor shall comply with all the provisions of the Act and these Rules.</li>
			   <li>A copy of the licence shall be displayed prominently at the premises where the migrant workmen are employed.</li>
			</ol>
		</div>
		</td>
	</tr>
		<br/>
		<table width="100%">
			<tr>
				<td>Place of issue : GUWAHATI</td>
				<td></td>
			</tr>
			<tr>
				<td>Date of issue : <?php echo date("d-m-Y",strtotime($issue_date)); ?></td>
				<td align="right"> Signature and seal of the Licensing Officer.</td>
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
		           <img src="<?=base_url('storage/temps/qrcode.png')?>" style="width: 120px; height: 120px" <?php echo encodeme($uain); ?> />
			</div>
		</div>
		</div>
		<!--copied-->
                        </div><!--End of .alomcertbl-->
                    </div><!--End of .box-body--> 
                </div><!--End of .box-->                    
            </div><!--End of .content-wrapper-->
            <?php $this->load->view("staffs/requires/footer"); ?>
        </div><!-- End of .wrapper-->
    </body>
</html>