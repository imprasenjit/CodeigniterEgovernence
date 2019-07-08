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
	$sub_date = $formCertRow->sub_date;
	$hear_dt = $formCertRow->hear_dt;
	$lic_exp_year = $formCertRow->lic_exp_year;
	$regular_fees = $formCertRow->regular_fees;
	$arrear_fees_details = $formCertRow->arrear_fees_details;
	$afd = json_decode($arrear_fees_details);
	$penalty_charge = $formCertRow->penalty_charge;
} else {
	$total_fees = "Not found";
	$sub_date = "Not found";
	$hear_dt = "Not found";
	$lic_exp_year = "Not found";
	$regular_fees = "Not found";
	$arrear_fees_details = "Not found";
	$penalty_charge = "Not found";
;}

$formProcessRow = $this->formprocess_model->get_row($this->dept_code, $form_table, $form_id);
if($formProcessRow) {
	$p_date = $formProcessRow->p_date;
} else {
	$p_date= "Not Found!";
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
							
									
		<div style="position:relative;text-align:center;">							
		<img src = "<?=base_url('public/imgs/assam.png')?>" class="alomlogoimg">
		</div>
		<br/>
		<h4 align = "center">OFFICE OF THE CONTROLLER OF LEGAL METROLOGY::ASSAM::GUWAHATI</h4>
		<h4 align = "center">(Office Address: Ram Krishna Mission Road, Ulubari, Guwahati-781007.)</h4>
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
			<tr>
				<td>
				From : <span style="padding-left : 20px;"><?php echo strtoupper($companyOwner);?></span></br>
				<span style="padding-left : 60px;">Controller of Legal Metrology,</span> </br>
				<span style="padding-left : 60px;">Assam, Guwahati-7. </br></span></br>
				
				To, </br>
				<span style="padding-left : 60px;"><?php echo strtoupper($key_person);?> </br></span>
				<span style="padding-left : 60px;"><?php echo strtoupper($address);?> </span>
				</br>
				Sub :<span style="padding-left : 30px;">Fixation of date for hearing of Appeal. </br></span></br>
				Ref :<span style="padding-left : 30px;"><?php echo $hear_dt; ?></span>
				</td>			
			</tr>
		</table>
		<br/>
		<p align="justify">
		This is in response to your appeal to the undersigned dated: <b><?php echo date('d-m-Y',strtotime($sub_date)); ?></b> you are hereby informed that, the date for hearing your appeal has been fixed on <?=$hear_dt; ?> in the office of the Controller of Legal Metrology, Ulubari, Guwahati, Assam.<br/><br/>
		As such you are requested to attend the hearing on the above mentioned date with your necessary testimonials as scheduled. Failing which appropriate action will be initiated.
		</p>
		<br/>
		<br/>		
		<div class="row">
			<div class="col-sm-12" style="padding:0">			
				<div class="col-sm-6">
					<br/><p align="left">Date: <b><?php echo date('d-m-Y',strtotime(date("h:i:sa")))?></b> </p>
				</div>					
				<div class="col-sm-6 pull-right" >
					<strong>Yours faithfully </br></br>
					Controller of Legal Metrology, </br>
					Assam, Guwahati  </strong>
				</div>			
			</div>
		</div>
		
		<div class="row" style="padding-left:5%;padding-bottom:20px;">
			<?php if($total_fees!=""){?>
			<div style="width:70%;position:relative;float:left;text-align:left">
				<span class="details" style="padding-bottom:5px"><u>Details of Fees Paid</u></span>
				<p style="margin-top:5px;font-family:sans-serif;font-size:14px;">1. Regular Fees for the year <?php echo $lic_exp_year; ?> : Rs. <?php echo $regular_fees; ?>.00</p>
				<p style="margin-top:5px;font-family:sans-serif;font-size:14px;">2. Arrear Fees for the year <?php echo $afd->y1." - ".substr( $afd->y2, -2 );?> : Rs. <?php echo $afd->fees; ?>.00</p>
				<p style="margin-top:5px;font-family:sans-serif;font-size:14px;">3. Penalty/other charges : Rs. <?php echo $penalty_charge; ?>.00</p>
			</div>
			<?php }else{?>	
			<div style="width:70%;position:relative;float:left;text-align:left">
				<p>&nbsp;</p>
			</div>
			<?php }?>
			<div style="width:30%;position:relative;float:left;">
				 <img src="<?=base_url('storage/temps/qrcode.png')?>" height = "100px">
			</div>
		</div>
						</div>
						<!-- copied -->
                    </div><!--End of .box-body--> 
                </div><!--End of .box-->                    
            </div><!--End of .content-wrapper-->
            <?php $this->load->view("staffs/requires/footer"); ?>
        </div><!-- End of .wrapper-->
    </body>
</html>
