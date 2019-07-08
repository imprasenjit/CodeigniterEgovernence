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
		//$valid_upto = $formCertRow->valid_upto;
		$sub_date = $formCertRow->sub_date;
	   
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
                        
                        <button class="btn btn-warning backbtn-alm printbtn">
                            <i class="fa fa-print"></i> Print
                        </button>
                    </h3><!--End of .boxalm-head-->
                    <div class="box-body">
                        <div class="alomcertbl printcontent">
									
		<div align="center" style="padding: 10px; border:2px solid black;">		


                                <img src="<?= base_url('public/imgs/assam.png') ?>" width="110px" height="140px">
                                <br/>
		<h4><b>OFFICE OF THE DIRECTORATE OF AGRICULTURE</b></h4>

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
		<p align="center"><b>Form - "A 2"<br/>ACKNOWLEDGEMENT</b></p>

		<p align="left"><u><b>AMENDMENT</u></b></p>
	
		<p style="text-indent: 14px;" align="justify"> Received from &nbsp;<?php echo strtoupper($companyName);?>&nbsp;a complete Memorandum of Intimation along with Form "O", fee of Rs. <?php echo strtoupper($total_fees);?>&nbsp; by license number <?php echo strtoupper($license_no);?> for issue of renewel of license dated <?=date("d-m-Y",strtotime($sub_date)); ?>.</p>
		
		<p style="text-indent: 14px;" align="justify">This acknowledgment shall be deemed to be letter of authorization entitling the applicant to carry on the business as applied for, (as given below) for a period of <u>3 years from the date of issue</u> of this Memo of acknowledgment unless suspended or revoked by the competent authority.</p>
		
			   
		</br>
		<div class="col-sm-12" style="padding:0;">
			<div class="col-sm-6">
				<table width="100%">
					<tr>
						<td>Date : <?php echo date('d-m-Y',strtotime($sub_date)); ?></td>
						<td width="30%">&nbsp;</td>
					</tr>
					<tr>
						<td>Place : <?php echo $dist;?></td>
						<td></td>
					</tr>
					<tr>
						<td>License No:&nbsp;&nbsp;<?php echo $license_no;?><br/>Date of issue :&nbsp;&nbsp;<?php echo date('d-m-Y',strtotime($sub_date)); ?><br/></td>
					</tr>
					
				</table>
			</div>					
			<div class="col-sm-6 pull-right" >
				<p align="center"><?php echo strtoupper($key_person) ?><br/>Directorate of Agriculture<br/>Govt. of Assam</p>
			</div>	
		</div>
		<br/>
		
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
				<img src="<?=base_url('storage/temps/qrcode.png')?>?d=<?php echo $uain; ?>" style="width: 120px; height: 120px"/>
			</div>
		</div>
		

<!--	

<h4 class="newpage">&nbsp;</h4>
<div class="container">
	<center>	
	<div align="center" style="padding: 10px 30px;width:85%; border:2px solid black;">
		<h3>Details of fertilizers which has been Amended</h3>
		<table name="objectTable1" id="objectTable1" class="table table-responsive text-center">
			<thead>
				<tr>
					<th width="20%">Sl. No.</th>
					<th width="40%">Name of Existing fertilizers</th>
					<th width="40%">Name of New fertilizers</th>													
				</tr>
			</thead>
			<tbody>
			<?php
				$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$dept."_form".$form . "_t1 WHERE form_id='$form_id'");
				$num = $part1->num_rows;
				if($num>0){
					$count=1;
					while($row_1=$part1->fetch_array()){ 
			?>
				<tr>
					<td width="10%"><?=$count?></td>
					<td width="45%"><?=$row_1["existing_fertilizer"]?></td>
					<td width="45%"><?=$row_1["new_fertilizer"]?></td>
				</tr>
			<?php 
				$count++; } 
				}else{	
			?>
				<tr>
					<td colspan="3">No Record Found</td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
</div>-->
						
						<!-- copied -->
                        </div>
                    </div><!--End of .box-body--> 
                </div><!--End of .box-->                    
            </div><!--End of .content-wrapper-->
            <?php $this->load->view("staffs/requires/footer"); ?>
        </div><!-- End of .wrapper-->
    </body>
</html>