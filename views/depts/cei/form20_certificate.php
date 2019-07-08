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
								<img src="departments/factory/images/ashok.png" width="110px" height="140px" alt="Ashok">		<br/>		<h4><b>GOVERNMENT OF ASSAM </b></h4>		<h4><b>OFFICE OF THE CHIEF INSPECTOR OF LIFTS AND ESCALATORS, ASSAM STATE </br>GUWAHATI : ASSAM</b></h4>		<h4><b>(See rule 11 of the Assam Lifts and Escalators Rules, 2010)</b></h4>		<h4><b>FORM-II </b></h4>		<h4><b>(ANNEXURE XIII)</b></h4>		<h4><b>ASSAM STATE</b></h4>		<br/>		<p>Certificate of authorization for erection and maintenance of Lifts.</p>		<p>(This certificate is to be renewed annually and must be returned to the Chief Inspector at the appropriate time)</p>				</br>				<table width="100%">		<tr>		<td>Authorization No: <?=strtoupper($autho_no);?></td>				</tr>            <tr>                <td>UBIN : <b><?php echo $ubin; ?></b></td>                <td align="right">UAIN : <b><?php echo $uain; ?></b></td>                            </tr>            <tr>                <td></td>                <td align="right"><?php if($total_fees!=""){?>Fees Paid : <b><?php echo "Rs. ".$total_fees; ?><?php }?></b></td>            </tr>		</table>		</br>		<p align="justify"><?=strtoupper($trade_name); ?> is/are hereby authorized to carry out the erection and maintenance of lifts within the State of Assam. This certificate of authorization is issued subject to compliance with the conditions set on the reverse page.</p> 		<br/>			<table width="100%">			<tr>					<td>Place of issue : GUWAHATI</td>				<td></td>			</tr>			<tr>				<td>Date of issue : <?php echo date("d-m-Y",strtotime($p_date)); ?></td>				<td align="right">Chief Inspector of Lifts and Escalators,</br> Assam State,</br> Guwahati.</td>			</tr> 		</table>		<br/>		<div class="row" style="padding-left:5%;padding-bottom:20px;">			<?php if($total_fees!=""){?>			<div style="width:70%;position:relative;float:left;text-align:left">				<span class="details" style="padding-bottom:5px"><u>Details of Fees Paid</u></span>				<p style="margin-top:5px;font-family:sans-serif;font-size:14px;">1. Regular Fees for the year <?php echo $lic_exp_year; ?> : Rs. <?php echo $regular_fees; ?>.00</p>				<p style="margin-top:5px;font-family:sans-serif;font-size:14px;">2. Arrear Fees for the year <?php echo $arrear_fees_details_y1." - ".substr( $arrear_fees_details_y2, -2 );?> : Rs. <?php echo $arrear_fees_details_fees; ?>.00</p>				<p style="margin-top:5px;font-family:sans-serif;font-size:14px;">3. Penalty/other charges : Rs. <?php echo $penalty_charge; ?>.00</p>			</div>			<?php }else{?>				<div style="width:70%;position:relative;float:left;text-align:left">				<p>&nbsp;</p>			</div>			<?php }?>			<div style="width:30%;position:relative;float:left;">				<img src="../qrcode/qrcode_generate.php?d=<?php echo $uain; ?>"/>			</div>		</div>				<div class="row">				<h4><b>CONDITIONS </b></h4>		<p align="justify">		1. It shall be the responsibility of the person authorized to ensure that all materials, fittings, appliances, equipments etc used in the lift which he undertakes to erect conform to the relevant specifications as laid down by the Bureau of Indian Standards, wherever they exist. In case, where such standards do not exist, it shall be of acceptable working standards to the satisfaction of the Chief Inspector. 		</p>				<p align="justify">		2. Every contract for erection or maintenance of a lift undertaken by the holder of this certificate of authorization shall be in writing and the holder thereof shall be responsible for the proper erection or maintenance of the lift and its installation for which the contract has been made.<br/>		</p>				<p align="justify">		3. The report of periodical inspection and tests of the lift and its installation shall be recorded in a register to be maintained for the purpose of inspection by the holder of the certificate of authorization and every such report shall be duly signed by the person making the inspection and tests.</br>		The report shall contain sufficient details so as to give a clear indication of the condition of the important component parts of the lift installation and of their fitness for safe working of the lift. If required by the Chief Inspector, such report shall be kept in a form approved by him for the purpose.		</br>		If as a result of inspection and test, any defect or breach of rules as may affect the safe working of the lift is found in the lift installation, the owner or agent thereof shall be intimated forthwith about the same by holder of the certificate of authorization and a copy of such intimation shall also be forwarded to the Chief Inspector.		</p>				<p align="justify">		4. The holder of this certificate of authorization shall maintain a register of technical personnel employed by him for erection and maintenance of lifts and register shall be produced for inspection on demand by the Chief Inspector or his any other person authorized by him in this behalf.		</p>				<p align="justify">		5. Any change in the address of the place of business of the holder of this certificate of authorization shall be communicated to the Chief Inspector within two weeks of such change. Any change of agent or manager, if any, shall be similarly notified.		</p>		<p align="justify">		6. At least three persons of the owner of the lift, who ordinarily are the occupants or residents of the premises in which the lift is installed, shall be trained by the holder of this certificate of authorization in respect of the rescue operation in case of power failure.		</p>				<p align="justify">		7. This certificate shall be returned to the Chief Inspector for renewal alongwith the application for the purpose and the original challan of the payment of renewal fee.		</p>				<p align="justify">		8. The holder of this certificate authorization shall not make any contract for the maintenance of the lift, which is not having the working licence.		</p>				<p align="justify">		9. The occurrence of any fatal or non fatal accident to any of the employees of the holder of this certificate of authorization during erection or maintenance shall be reported in writing to the Chief Inspector within 24 hours of the occurrence of such accident.		</p>				</div>	
						

						<!-- copied -->
                            </div>
                    </div><!--End of .box-body--> 
                </div><!--End of .box-->                    
            </div><!--End of .content-wrapper-->
            <?php $this->load->view("staffs/requires/footer"); ?>
        </div><!-- End of .wrapper-->
    </body>
</html>
