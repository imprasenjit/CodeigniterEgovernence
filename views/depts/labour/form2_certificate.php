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
		$nature_work = $formRow->nature_work;
		$nature_w_emp=$formRow->nature_w_emp;
		$max_workers=$formRow->max_workers;
	if(!empty($formRow->manager))
	{
		$manager=json_decode($formRow->manager);
		$manager_name=$manager->name;
		$manager_sn1=$manager->sn1;
		$manager_sn2=$manager->sn2;
		$manager_v=$manager->v;
		$manager_d=$manager->d;
		$manager_pin=$manager->pin;			
	}
	else
	{
		$manager_name="";
		$manager_sn1="";
		$manager_sn2="";
		$manager_v="";
		$manager_d="";
		$manager_pin="";
	}
	$cont_address=$manager_sn1." , ".$manager_sn2." , ".$manager_v." , ".$manager_d." , ".$manager_pin;


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
						<!--copied from labour_form2_certificate.php-->
                      <div align="center" style="padding: 10px 30px;width:99%; border:2px solid black;">	

	<img src="<?=base_url('public/imgs/assam.png')?>" class="alomlogoimg" />		
		<br/>
		<br/>
		<h4><b>OFFICE OF THE REGISTERED OFFICER</b></h4>
		<h4><b>FORM-II </b></h4>
		<p>(See rule 18 [1])</p>
		<h4><b> CERTIFICATE OF REGISTRATION </b></h4>
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
		<p align="justify">A certificate of Registration containing the following particulars is hereby granted under Sub- Section (2) of Section 7 of the Contract Labour (Regulation and Abolition) Act, 1970 and the rules made there under to:
		</p>
		<br/>
		<p align="justify">1. Nature of work carried on in the Establishment. </br>
		<?=strtoupper($nature_work);?></p>
		
		<p align="justify">2. Names and Addresses of Contractors. </br>
		<?php echo strtoupper($manager_name);?><br/>
		<?php echo strtoupper($cont_address);?><br/></p>
		
		<p align="justify">3. Nature of work in which contract labour is employed or is to be employed.</br>
		<?=strtoupper($nature_w_emp);?></br></p>
		
		<p align="justify">4. Maximum number of contract to be employed on any day through each contractor. </br>
		<?=strtoupper($max_workers);?></p>
		</br>
		<p align="justify">5. Other particulars relevant to the employment of contract labour<br/><?=strtoupper($other_particlr);?></p>
		<br/>
		<table width="100%">
			<tr>
				<td>Place of issue : GUWAHATI</td>
				<td></td>
			</tr>
			<tr>
				<td>Date of issue : <?php echo date("d-m-Y",strtotime($issue_date)); ?></td>
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
	<!--copied-->
                        </div><!--End of .alomcertbl-->
                    </div><!--End of .box-body--> 
                </div><!--End of .box-->                    
            </div><!--End of .content-wrapper-->
            <?php $this->load->view("staffs/requires/footer"); ?>
        </div><!-- End of .wrapper-->
    </body>
</html>