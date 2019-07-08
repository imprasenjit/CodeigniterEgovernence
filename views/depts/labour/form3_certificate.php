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
		$other_particlr=$formCertRow->other_particlr;

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
		$nature_work=$formRow->nature_work;
	if(!empty($formRow->contractor)){				
		$contractor=json_decode($formRow->contractor);
		$contractor_nwm=$contractor->nwm;
		$contractor_wr_no=$contractor->wr_no;
		$contractor_d=$contractor->d;
		$contractor_d2=$contractor->d2;				
	}else{
		$contractor_nwm="";
		$contractor_wr_no="";
		$contractor_d="";
		$contractor_d2="";
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
						<!--copied from labour_form3_certificate.php-->
    <div align="center" style="padding: 10px 30px;width:99%; border:2px solid black;">	

	<img src="<?=base_url('public/imgs/assam.png')?>" class="alomlogoimg" />	
		<br/>
		<h4><b> CERTIFICATE OF REGISTRATION </b></h4>
		<h4><b>Office of the Registering Officer</b></h4>
		<br/>
		<table width="100%"  >
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
		<p align="justify">A certificate of registration containing the following particulars is hereby granted under clause (a) of sub-section (2) of Section 4 of the Inter-State Migrant Workmen (Regulation of Employment and Conditions of Service) Act, 1979, and the Rules made thereunder to : 
		</p>
		<br/>
		<p align="justify">1. Nature of work carried on the establishment.</br><?=strtoupper($nature_work);?>
		</p>
		<p align="justify">2. Name and addresses of contractors.</p>

	<!--	<?php// $part2=$admin_fetch_functions->executeQuery($dept,"SELECT * FROM labour_form3_t2 WHERE form_id='$form_id'") or die($labour->error);
			//while($row_2=$part2->fetch_array()){
		?>
		<p align="justify"><?//=strtoupper($row_2["field1"]);?> . <?//=strtoupper($row_2["field2"]);?> - <?//=strtoupper($row_2["field3"]);?> , <?//=strtoupper($row_2["field4"]);?> , <?//=strtoupper($row_2["field5"]);?> , <?//=strtoupper($row_2["field6"]);?> , <?//=strtoupper($row_2["field7"]);?></p>
		<?php// } ?> -->
		
		<?php 
						$personalized_array = array("form_id"=>$form_id);
						$forms_t2_Row = $this->forms_model->get_personalized_rows($this->dept_code, $form_table."_t2", $personalized_array);
						$sl=1;
						if($forms_t2_Row){
							foreach($forms_t2_Row as $rows){ ?>
							<tr >
								<td><?=strtoupper($rows->field1);?></td>
								<td><?=strtoupper($rows->field2);?></td>
								<td><?=strtoupper($rows->field3);?></td>
								<td><?=strtoupper($rows->field4);?></td>
								<td><?=strtoupper($rows->field5);?></td>
								<td><?=strtoupper($rows->field6);?></td>
								<td><?=strtoupper($rows->field7);?></td>

							</tr>
							<?php 
								$sl++;
							} 
						} 
						?>
		
		<p align="justify">3. Nature of work of which migrant workmen are to be employed or are employed.</br><?=strtoupper($contractor_nwm);?>
		</p>
		<p align="justify">4. Maximum number of migrant workmen to be employed on any day through each Contractor.</br><?=strtoupper($contractor_wr_no);?>
		</p>
		<p align="justify">5. Other particulars relevant to the employment of migrant workmen </br> 
			<?=strtoupper($other_particlr);?></br>
		</p>
		<br/>
		<table width="100%">
			<tr>
				<td>Place of issue : GUWAHATI</td>
				<td></td>
			</tr>
			<tr>
				<td>Date of issue : <?=date("d-m-Y",strtotime($issue_date)); ?></td>
				<td align="right">Signature of Registering Officer with Seal</td>
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
	</center>
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