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
}//End of if ?>
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
						<!--copied from labour_form1_certificate.php-->
                            <div align="center" style="padding: 10px 30px;width:85%; border:2px solid black;">
	
		<img src="<?php echo $admin_url; ?>departments/factory/images/ashok.png" width="110px" height="140px" alt="Ashok">
		<br/>
		<h4><b>Office of the Assistant Labour Commissioner – Cum Licensing  Officer</b></h4>
		<h4><b>FORM – Q</b></h4>
		<p>(See Rule 47)</p>
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
		<p align="justify">Name of Establishment : <?php echo strtoupper($trade_name); ?> </p>
		<p align="justify">Name of Employer : <?php echo strtoupper($key_person); ?> </p>
		<p align="justify">Address and location of the Establishment : <?php echo strtoupper($address); ?> </p>
		<p align="justify">Number of Employees : <?php echo strtoupper($total_employee); ?> </p>
		<p align="justify">Nature of Business : <?php echo strtoupper($trade_name); ?> </p>
		<p align="justify">Certified that under the Assam Shop and Establishment Act and the Rules framed thereunder :<br/>
		<p> The establishment bearing the above particulars has been registered on this <?=date('jS F, Y',strtotime($p_date));?> for a period of twelve months upto <?php echo date('jS F',strtotime($p_date)); ?>, <?php echo date('Y',strtotime($p_date))+1; ?> and the Registration number is <?=strtoupper($reg_no);?>
		</p>
		<br/>
		<p>The validity of the Certificate of Registration shall expire unless renewed before the expiry date.</p>
		<br/>
		<table width="100%">
			<tr>	<td>Place of issue : GUWAHATI</td>
					<td></td>
			</tr>
			<tr>
				<td>Date of issue : <?php echo date("d-m-Y",strtotime($p_date)); ?></td>
				<td align="right">Signature of the Inspector of<br/>Shops and Establishments</td>
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
				<img src="<?php echo $server_url; ?>qrcode/qrcode_generate.php?d=<?php echo $uain; ?>"/>
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