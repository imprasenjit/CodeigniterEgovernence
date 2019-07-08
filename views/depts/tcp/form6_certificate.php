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
                        <button class="btn btn-warning backbtn-alm printbtn">
                            <i class="fa fa-print"></i> Print
                        </button>
                    </h3><!--End of .boxalm-head-->
                    <div class="box-body">
                        <div class="alomcertbl printcontent">
           <!--copied from tcp_form6_certificate.php-->
		   <div align="center" style="padding: 10px 30px;width:85%; border:2px solid black;">
			
			<img src="<?php echo $admin_url;?>departments/factory/images/ashok.png" width="80px" height="110px" alt="Ashok">
			<h2 class="text-uppercase" align="center"><?php echo $formFunctions->get_deptName($dept); ?></h2>
			<h2 align="center"><b>FORM 24</b></h2>
			<h4 align="center"><b>(See rule 24)</b></h4>
			<h3 align="center"><b>COMPLETION CUM OCCUPANCY CERTIFICATE</b></h3>
			<br/>
			<table width="100%" style="page-break-inside:avoid">
				<tr>
					<td>UBIN : <b><?php echo $ubin; ?></b></td>
					<td align="right">UAIN : <b><?php echo $uain; ?></b></td>
					
				</tr>
				<tr>
					<td>NOC No. <?php echo strtoupper($ref_uain); ?></td>
					<td align="right"><?php if($total_fees!=""){?>Fees Paid : <b><?php echo "Rs. ".$total_fees; ?><?php }?></b></td>
				</tr>
			</table>
			<br/>
			</br>
			<table width="100%" style="page-break-inside:avoid">
			<tr>
				<td colspan="4">	
					<p align="justify" style="text-indent:14px;">With reference to your notice of completion dated <?php echo date("d-m-Y",strtotime($received_date)); ?> I hereby certify that building, as per description below located at Plot No <?php echo $p_plot_no; ?> Block No <?php echo $p_block_no; ?> whose plans were sanctioned vide No. <?php echo strtoupper($ref_uain); ?> has been inspected with reference to building bye-law in respect to the structural safety, fire safety, hygienic and sanitary conditions inside and in the surroundings and is declared fit for occupation and release of regular water and electricity connection. The description of the construction work completed is given as under: </p> 
				</td>
			</tr>
			<tr>
				<td colspan="4"><p align="justify">Description of Construction Work Block-wise/Building wise</p>
					
					<div style="text-align:justify;">
						<ol>
							<li>Location of building : <?=strtoupper($location);?></li>
							<li>Details of completed work floor wise <br/>
							<?=strtoupper($work_details);?></li>
							<li>Enclosed : <a href="<?php echo $annexure;?>" target="_blank">Built Plan</a></li>
						</ol>
					</div>
				</td>
			</tr>
			<tr>
				<td colspan="4"><p align="justify">Note : NOC issued from the fire services to be renewed each year, failing which the occupancy certificate shall lapse.</p>
				</td>
			</tr>
			<br/>
			</table>
			<table width="100%" style="page-break-inside:avoid">
				<tr>
					<td>Place of issue : GUWAHATI</td>
					<td></td>
				</tr>
				<tr>
					<td>Date of issue : <?php echo date("d-m-Y",strtotime($p_date)); ?></td>
					<td align="right"><center>Your&apos;s faithfully, <br/>Chairman</center></td>
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
				<div style="width:30%;position:relative;float:right;">
					<img src="<?php echo $server_url;?>qrcode/qrcode_generate.php?d=<?php echo $uain; ?>"/><br/>
					Municipal Board/<br/>Town Committee
				</div>
			</div>
		</div>
		<br/>
<!--copied-->
                        </div><!--End of .alomcertbl-->
                    </div><!--End of .box-body--> 
                </div><!--End of .box-->                    
            </div><!--End of .content-wrapper-->
            <?php $this->load->view("staffs/requires/footer"); ?>
        </div><!-- End of .wrapper-->
    </body>
</html>
