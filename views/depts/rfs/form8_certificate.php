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
}


$formCertRow = $this->formcertifcates_model->get_row($this->dept_code, $form_table, $form_id);
if($formCertRow) {
    $total_fees = $formCertRow->total_fees;
    $reg_no = $formCertRow->reg_number;
    $regular_fees = $formCertRow->regular_fees;
    $lic_exp_year = $formCertRow->lic_exp_year;
    $arrear_fees_details = json_decode($formCertRow->arrear_fees_details);
    $penalty_charge = $formCertRow->penalty_charge;
    $sub_date = $formCertRow->sub_date;
    
} else {
    $total_fees = "Not found";
    $reg_no = "Not Found";
    $sub_date = "Not found";
}

$formProcessRow = $this->formprocess_model->get_row($this->dept_code, $form_table, $form_id);
if($formProcessRow) {
    $p_date = date("d-m-Y", strtotime($formProcessRow->p_date));
} else {
    $p_date = "";
}


//End of if ?>
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
                        <div class="alomcertbl printcontent" style="padding:20px">
            <!---copied from rfs_form6_certificate.php--->
			<!-- <div align="center" style="padding: 10px 30px;width:85%; border:2px solid black;"> -->
			<<div style="text-align: center;">
		 <img src="<?=base_url('public/imgs/assam.png')?>" width="110px" height="140px" alt="Ashok">
		<h3 class="text-uppercase"><?php echo $this->dept_name; ?></h3>
		<h3><b>CERTIFIED COPY OF REGISTRATION OF FIRM</b></h3>
		<br/>
	</div>
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
			<p align="center">This certificate of registration is issued to <?php echo $companyName; ?> bearing registration number on the regsiter if Firms <?php echo $uain; ?> OF <?php echo date("Y",strtotime($p_date))?> - <?php echo date("Y",strtotime($p_date))+1;?> for carrying out the business of Construction Material Supply.</p>
			<p align="center">The firm has been established on <?php echo date("d-m-Y",strtotime(date("D-M-Y")));?> for Unlimited as per the application submitted on <?php echo date("d-m-Y",strtotime($sub_date)); ?>.</p>
		<br/>
		<table width="100%">
			<tr>
				<td></td>
				<td align="right"><b>Registrar of Firms</b><br/>Assam, Dispur, Guwahati</td>
			</tr>
		</table>
		<br/><br/>
		
		<div class="row" style="padding-left:5%;padding-bottom:20px;">
			<?php if($total_fees!=""){?>
			<div style="width:70%;position:relative;float:left;text-align:left">
				<span class="details" style="padding-bottom:5px"><u>Details of Fees Paid</u></span>
				<p style="margin-top:5px;font-family:sans-serif;font-size:14px;">1. Regular Fees for the year <?php echo $lic_exp_year; ?> : Rs. <?php echo $regular_fees; ?>.00</p>
				<p style="margin-top:5px;font-family:sans-serif;font-size:14px;">2. Arrear Fees for the year <?php echo $arrear_fees_details->y1." - ".substr( $arrear_fees_details->y2, -2 );?> : Rs. <?php echo $arrear_fees_details->fees; ?>.00</p>
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
		
		
		<table width="100%">
			<tr>
				<td>Place of issue : GUWAHATI</td>
				<td></td>
			</tr>
			<tr>
				<td>Date of issue : <?php echo date("d-m-Y",strtotime($p_date)); ?></td>
				<td align="right"></td>
			</tr> 
		</table>
		<br/>
		<p align="left">N.B. Registered number of the firm should not be stated as Govt. registered. It is registered under the I.P. Act, 1932</p>
	
			<!--copied-->
                            <p align="left">N.B. Registered number of the firm should not be stated as Govt. registered. It is registered under the I.P. Act, 1932</p>
                            <p align="center">This is a computer generated certificate and it does not require signature. This certificate can be verified by UAIN or the QR Code printed on it.</p>	
                        </div><!--End of .alomcertbl-->
                    </div><!--End of .box-body--> 
                </div><!--End of .box-->                    
            </div><!--End of .content-wrapper-->
            <?php $this->load->view("staffs/requires/footer"); ?>
            </div>
        </div><!-- End of .wrapper-->
    </body>
</html>


