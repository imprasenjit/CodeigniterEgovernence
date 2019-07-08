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
								<img src="departments/factory/images/ashok.png" width="110px" height="140px" alt="Ashok">		<br/>		<h4><b>GOVERNMENT OF ASSAM </b></h4>		<h4><b>OFFICE OF THE CHIEF INSPECTOR OF LIFTS AND ESCALATORS, ASSAM STATE</br> GUWAHATI : ASSAM</b></h4>		<h4><b>(ANNEXURE VI)</b></h4>		<p>(See Rules 4 and 6 of the Assam Lifts and Escalators Rules, 2010)</p>		<h4><b>ASSAM STATE</b></h4>		<h4><b>License to use a lift</b></h4>		<br/>		<table width="100%">            <tr>                <td>UBIN : <b><?php echo $ubin; ?></b></td>                <td align="right">UAIN : <b><?php echo $uain; ?></b></td>                            </tr>            <tr>                <td></td>                <td align="right"><?php if($total_fees!=""){?>Fees Paid : <b><?php echo "Rs. ".$total_fees; ?><?php }?></b></td>            </tr>		</table>		</br>		<p align="justify">(This license is not transferable or assignable to any person or firm or company. This license is to be renewed at an interval of every three years and must be produced to the Licensing Authority before the prescribed time limit).</p> <br/>				<p align="justify">License No : <?=strtoupper($license_no); ?> </p>		<p align="justify">		M/S <?php echo $trade_name; ?> is/are hereby authorized to use the lift (the particulars of which are given below) installed at the premises owned by <?=strtoupper($key_person); ?> and situated at <?=strtoupper($address);  ?>  This licence shall remain valid from <?=strtoupper($validity_date_from); ?> to <?=strtoupper($validity_date_to); ?> and is issued subject to the conditions set out on the reverse page.		</p>		</br>		<p align="justify">		PARTICULARS  <br/> <br/>		Make:   <br/>		Type of lift : <?=strtoupper($related_load_no);?> Passenger <br/>		Rated load : <?=strtoupper($related_load_kg);?> Kg. <br/>		Rated speed : <?=strtoupper($rated_speed);?> meter per second.  		</p>		<table width="100%">			<tr>				<td>Place of issue : GUWAHATI</td>				<td></td>			</tr>			<tr>				<td>Date of issue : <?php echo date("d-m-Y",strtotime($p_date)); ?></td>				<td align="right">Chief Inspector of Lifts and Escalators,  <br/> Assam State,  <br/> Guwahati.</td>			</tr> 		</table>		<br/>		<div class="row" style="padding-left:5%;padding-bottom:20px;">			<?php if($total_fees!=""){?>			<div style="width:70%;position:relative;float:left;text-align:left">				<span class="details" style="padding-bottom:5px"><u>Details of Fees Paid</u></span>				<p style="margin-top:5px;font-family:sans-serif;font-size:14px;">1. Regular Fees for the year <?php echo $lic_exp_year; ?> : Rs. <?php echo $regular_fees; ?>.00</p>				<p style="margin-top:5px;font-family:sans-serif;font-size:14px;">2. Arrear Fees for the year <?php echo $arrear_fees_details_y1." - ".substr( $arrear_fees_details_y2, -2 );?> : Rs. <?php echo $arrear_fees_details_fees; ?>.00</p>				<p style="margin-top:5px;font-family:sans-serif;font-size:14px;">3. Penalty/other charges : Rs. <?php echo $penalty_charge; ?>.00</p>			</div>			<?php }else{?>				<div style="width:70%;position:relative;float:left;text-align:left">				<p>&nbsp;</p>			</div>			<?php }?>			<div style="width:30%;position:relative;float:left;">				<img src="../qrcode/qrcode_generate.php?d=<?php echo $uain; ?>"/>			</div>		</div>				<div class="row">				<h4><b>CONDITIONS </b></h4>		<p align="justify">		1. The lift and its installation shall be operated and maintained in conformity with the provisions of the Assam Lifts and Escalators Act, 2006 and the rules made thereunder. 		</p>				<p align="justify">		2. If the holder of this license does not normally reside in the town or village in which the lift has been erected, he shall within one month from the date of this license appoint an agent who shall be resident in the town or village in which the lift has been installed. The agent so appointed shall be responsible for the operation and maintenance of the lift in conformity with the provisions of the Assam Lifts and Escalators Act, 2006 and the rules made thereunder. The name of every such agent shall be communicated to the Chief Inspector. Any change of agent shall be similarly notified. <br/>		</p>				<p align="justify">		3. The holder of the license or his agent, if any, shall, within one month from the date of this license, appoint a person who is in possession of a valid authorization for maintenance of the lift installation and shall communicate the name of such person to the Chief Inspector. Any change of person so appointed, shall also be similarly notified. 		</p>				<p align="justify">		4. No additions or alterations to the lifts and its installation shall be carried out without prior approval of the Chief Inspector.		</p>				<p align="justify">		5. A Xerox copy of this license shall be permanently displayed in the lift car as well as in the machine room of the lift.		</p>		<p align="justify">		6. If the holder this license desires to have the change of name in the license once issued he shall apply to the Chief Inspector together with the license and the challan showing the payment of prescribed fee.		</p>		</div>	
						
						
                            </div>
                    </div><!--End of .box-body--> 
                </div><!--End of .box-->                    
            </div><!--End of .content-wrapper-->
            <?php $this->load->view("staffs/requires/footer"); ?>
        </div><!-- End of .wrapper-->
    </body>
</html>
