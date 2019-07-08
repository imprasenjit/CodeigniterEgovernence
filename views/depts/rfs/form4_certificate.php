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
                         <!--copied from rfs_form4_certificate.php-->
						 <div align="center" style="padding: 10px 30px;width:85%; border:2px solid black;">
		<img src="<?php echo $server_url; ?>admin/departments/factory/images/ashok.png" width="110px" height="140px" alt="Ashok">
		<h3 class="text-uppercase"><?php echo $dept_name; ?></h3>
		<h3><b>CERTIFIED COPY OF REGISTRATION OF FIRM</b></h3>
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
			<p align="center">This certificate of registration is issued to <?php echo $trade_name; ?> bearing registration number on the regsiter if Firms <?php echo $uain; ?> OF <?php echo date("Y",strtotime($p_date))?> - <?php echo date("Y",strtotime($p_date))+1;?> for carrying out the business of Construction Material Supply.</p>
			<p align="center">The firm has been established on <?php echo date("d-m-Y",strtotime($date_of_commencement));?> for Unlimited as per the application submitted on <?php echo date("d-m-Y",strtotime($sub_date)); ?>.</p>
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
		<p align="justify"><b>Enclosure-1:</b> Name, permanent address of the partners and date of joining as per <b>Annexure-01</b></p>
		<table width="100%" class="table table-responsive" border="1">
			<thead>
				<tr>
					<th>Sl No.</th>
					<th>Full Name of partners</th>
					<th>Permanent Address</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$results1=$admin_fetch_functions->executeQuery("rfs","select * from rfs_form4_members where form_id='$form_id'") or die("Error : ".$rfs->error);
					$sl=1;
					while($rows=$results1->fetch_object()){
				?>
				<tr>
					<td><?php echo $sl; ?></td>
					<td><?php echo strtoupper($rows->member_p_name); ?></td>
					<td><?php echo strtoupper($rows->member_p_address); ?></td>
				</tr>
				<?php
					$sl++;
					}
				?>
			</tbody>
		</table>
		<br/>
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
	</div>
	</center>
</div>
<!--copied-->
                            <p align="left">N.B. Registered number of the firm should not be stated as Govt. registered. It is registered under the I.P. Act, 1932</p>
                            <p align="center">This is a computer generated certificate and it does not require signature. This certificate can be verified by UAIN or the QR Code printed on it.</p>	
                        </div><!--End of .alomcertbl-->
                    </div><!--End of .box-body--> 
                </div><!--End of .box-->                    
            </div><!--End of .content-wrapper-->
            <?php $this->load->view("staffs/requires/footer"); ?>
        </div><!-- End of .wrapper-->
    </body>
</html>