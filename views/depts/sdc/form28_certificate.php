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
		$license_no = $formCertRow->lic_no;
		$regd_no = $formCertRow->regd_no;

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
<!--copied from sdc_certificate28.php-->
	<div align="center" style="padding: 10px 20px;width:99%; border:2px solid black;">	

		<img src="<?=base_url('public/imgs/assam.png')?>" class="alomlogoimg" />		<br/>
		<br/>
		<h4><b>STATE DRUGS CONTROL ADMINISTRATION</b></h4>
		<h4><b>FORM 21&ndash;C</b></h4>
		<h4><b>[See rule 63&ndash;A]</b></h4>
		<h4><b>Certificate of renewal of License to sell stock or Exhibit for sell or to distribute Drugs</b></h4>
		<br/>
		<table width="100%"  >
			<tr>
				<td>UBIN : <b><?php echo $ubin; ?></b></td>
				<td align="right">UAIN : <b><?php echo $uain; ?></b></td>
			</tr>
			<tr>
				<td></td>
				<td align="right"><?php if($total_fees!=""){?>Fees Paid : <b><?php echo "Rs. ".$total_fees; ?><?php }?></td>
			</tr>
		</table>
		<br/>
		<p align="justify">Numbers of Licence and date of issue : <?=strtoupper($license_no);?>, <?=date('d-m-Y',strtotime($issue_date)); ?></p>
		<p align="justify">Certified that License No. <?=strtoupper($license_no); ?></p>
		<p align="justify">IN Form No. 20&ndash;B, 21&ndash;B, 20, 21, 20&ndash;A, 21&ndash;A and 20&ndash;F, 20&ndash;G granted on the <?=date('d-m-Y',strtotime($issue_date)); ?> to the M/s <?=strtoupper($companyName); ?> for sale of the following Drugs at the premises situated at <?php echo strtoupper($address); ?> Has been Renewed for a period from <?=date('d-m-Y',strtotime($issue_date)); ?> to <?=date('d-m-Y',strtotime($valid_upto)); ?>.</p>
		<p align="justify">Catagories of particulars of Drugs :
		<?=strtoupper($category); ?>
		</p>
		<p align="justify">Name(s) of qualified persons Incharge<br/>
		<?=strtoupper($supervision_n1); ?>,<?=strtoupper($supervision_n2); ?>
		<br/>
		Regd No. <?=strtoupper($regd_no); ?></p>
		<br/>
		<div class="col-sm-12" style="padding:0;">
			<div class="col-sm-6">
				<p align="justify"></p>
			</div>					
			<div class="col-sm-6 pull-right" >
				<p align="center"><?php echo strtoupper($sign); ?><br/>Licensing Authority</p>
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
		           <img src="<?=base_url('storage/temps/qrcode.png')?>" style="width: 120px; height: 120px" <?php echo encodeme($uain); ?> />
			</div>
		</div>

<!--copied-->
</div>
                        </div><!--End of .alomcertbl-->
                    </div><!--End of .box-body--> 
                </div><!--End of .box-->                    
            </div><!--End of .content-wrapper-->
            <?php $this->load->view("staffs/requires/footer"); ?>
        </div><!-- End of .wrapper-->
    </body>
</html>