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
	 //$arrear_fees_details = json_decode($formCertRow->arrear_fees_details);
	 $lic_no = $formCertRow->file_auth_num;
	 $lic_exp_year = $formCertRow->lic_exp_year;
	 $regular_fees = $formCertRow->regular_fees;
	 $arrear_fees_details = json_decode($formCertRow->arrear_fees_details);
	 $penalty_charge = $formCertRow->penalty_charge;
} else {
    $total_fees = "Not found";
	$lic_no = "Not found";
	$lic_exp_year = "Not found";
	$regular_fees = "Not found";
	$penalty_charge = "Not found";
}//End of if else
	
$formProcessRow = $this->formprocess_model->get_row($this->dept_code, $form_table, $form_id);
if($formProcessRow) {
   $p_date = $formProcessRow->p_date;
} else {
    $p_date = "Not found";
}//End of if else

$formRow = $this->forms_model->get_row($this->dept_code, "mines_form9_members", $form_id);
if($formRow) {
	$name = $formRow->name;
	$sn1 = $formRow->sn1;
	$sn2 = $formRow->sn2;
	$vill = $formRow->vill;
	$dist = $formRow->dist;
    $district = $formRow->dist;
    $pin = $formRow->pin;
} else {
	$name = "Not found";
	$sn1 = "Not found";
	$sn2 = "Not found";
	$vill = "Not found";
	$dist = "Not found";
  	$district = "Not found";
  	$pin = "Not found";

}//End of if else


$formRow = $this->forms_model->get_row($this->dept_code, $form_table, $form_id);
if($formRow) {
  //$minerals = $formRow->minerals;
  //$period = json_decode($formRow->period);
} else {
   //$minerals = "Not found";
   //$period = "Not found";
}//End of if else
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
                       <div class="alomcertbl printcontent" style="padding:20px">
                            <div class="text-center">
                            <img src="<?= base_url('public/imgs/assam.png') ?>" width="110px" height="140px" alt="Ashok">
                            <br/>
                                <h4 align = "center"><b>DEPARTMENT OF MINES & MINERALS</b></h4>
                                <br/>
								</div>
										<table width="100%">
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
		<p align="center"><b>Form-G</b></p>
		<br/>
		
		<p><h4 align="center"><b>CERTIFICATE OF REGISTRATION OF DEALER</b></h4></p>
		<br/>
		<div class="col-sm-12" style="padding:0;">
			<div class="col-sm-6 pull-right">
			    <p>Name of the District: <?php echo strtoupper($district);?></p>
				<p>Mineral Dealer License No :</p>
				<p>Year :<?php echo date('Y',strtotime($p_date)); ?></p>
			</div>					
		</div>
     <div>
	  <table id="" class="table table-responsive">
	       <tr>
				<td>1. Name of dealer in full</td>
				<td><?php echo strtoupper($companyName);?></td>
			</tr>
			<tr>
				<td>2. Full address with residential proof</td>
				<td><?php echo strtoupper($address)?></td>
			</tr>
			<tr>
				<td>Street Name1 :</td>
				<td></td>
			</tr>
			<tr>
				<td>Street Name2 :</td>
				<td></td>
			</tr>
			<tr>
				<td>Village/Town :</td>
				<td></td>
			</tr>
			<tr>
				<td>District :</td>
				<td></td>
			</tr>
			<tr>
				<td>Pin Code :</td>
				<td></td>
			</tr>
			<tr>
				<td>Mobile No :</td>
				<td></td>
			</tr>										
			<tr>
				<td>3. Father&#39s name in full </td>
				<td></td>
				<td colspan="2"></td>
			</tr>
			<tr>
				<td>a) In case of firm, give name and address of partners and person holding powers of attorney to act on behalf of the firm
			</tr>
			<tr>
				<td>Name :</td>
				<td><?php echo strtoupper($name)?></td>
			</tr>
			<tr>
				<td>Address :</td>
				<td><?php echo strtoupper($sn1.",".$sn2.",".$vill.",".$dist.",".$pin)?></td>
			</tr>
			<tr>
			    <td>4. Profession of the dealer</td>
			    <td></td>
			</tr>
			<tr>
				<td>5. Specific place or places of business</td>
				<td></td>
			</tr>
			<tr>
				<td>6. Specific purpose for which registration is granted</td>
				<td></td>
			</tr>
			<tr>
				<td>7. Name of mineral/ ore covered under the license</td>
				<td></td>
				<td colspan="2"></td>
			</tr>
			<tr>
				<td>9. Name and address of person/ firm from whom the mineral/ ore will be purchased/ procured :</td>											
			</tr>
			<tr>
				<td>Name :</td>
				<td></td>
			</tr>
			<tr>
				<td>Address :</td>
				<td></td>
			</tr>
			<tr>
				<td>10. Period of registration :</td>
				<td><?php //echo strtoupper($period->from_dt);?>&nbsp; To &nbsp;<?php //echo strtoupper($period->to_dt);?> </td>
			</tr>
			<tr>
				<td>11.In case of renewal license, the number and date of the original registration</td>
				<td></td>
			</tr>
			<tr>
				<td>12. Number and date of application for this registration</td>
				<td></td>
			</tr>
			
       </table>   
		</br></br></br>
		
		<div class="col-sm-12" style="padding:0;">
			<div class="col-sm-6">
				<p align="justify"></p>
			</div>					
			<div class="col-sm-6 pull-right">
				<p align="center"><?php echo strtoupper($companyOwner) ?><br/>Department of Mines & Minerals<br/>Govt. of Assam</p>
			</div>	
		</div>
		<br/>
		<table width="100%">
			<tr>
				<td><br/>Date of grant : <?php echo strtoupper($p_date);?></td>
				<td></td>
			</tr>
			<tr>
				<td align="right">Signature of the competent authority to grant license with designation<?php echo $key_person;?></td>
				<td align="right"></td>
			</tr>
			
		</table>
		<br/>
		<br/>
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
		<br/>
		<div align="justify">
		  <h4><b>Terms and Conditions of this Certificate:</b></h4>
			<ol type="1">
			 <li>The holder of this certificate shall display the original thereof in a conspicuous place open to the public in a part of the principal's premises in which the business of making the physical/ granulated mixture of fertilizers or *mixture of Micro- nutrient fertilizers/ organic fertilizers is carried on and also a copy of such certificate in similar manner in every other premises in which that business is carried on. The required number of copies of the certificates shall be obtained on payment of the fees thereof.</li>
			 <li>The holder of this certificate shall not keep in the premises in which he carries on the business of making physical/ granulated mixture of fertilizers any mixture of fertilizers *or mixture of micro-nutrient fertilizers/ Organic Fertilizer/ Bio- Fertilizer in respect of which a certificate to registration has not been obtained under the Fertilizer (Control) Order, 1985.</li>
			 <li>The holder of this certificate shall comply with the provisions of the Fertilizer (Control) Order, 1985 and the notifications, order and director issued there under for the time being in force.</li>
			 <li>The holder of the certificate shall report forthwith to the Registering Authority any change in the premises specified in the certificate or any new premises in which he carried on the business of making physical/ granulated mixture of fertilizers or *mixture of Micro- nutrient fertilizers/ Organic Fertilizer/ Bio- Fertilizer and shall produce before the authority the original certificate and copies thereof so that necessary corrections may be made therein by that authority.</li>
			 <li>The holder of this certificate shall ensure that the physical/ granulated mixture of fertilizers Organic Fertilizer/ Bio- Fertilizer in respect of which a certificate of registration has been obtained is prepared by him or by a person having such qualifications, as may be prescribed by the State Government, from time to time or any other person under the direction, supervision and control of the holder, or the person having the said qualifications.</li>
			 <li>The certificate and copies thereof, of any, will be machine numbered and delivered against the signature of the holder thereof or his agent on the carbon copy of the certificate which will be kept intact bound in the "Certificate Book" by each Registering Authority.</li>
		</div>
	</div>
	</center>
</div>
						
							<!-- copied -->
                        </div><!--End of .alomcertbl-->
                    </div><!--End of .box-body--> 
                </div><!--End of .box-->                    
            </div><!--End of .content-wrapper-->
            <?php $this->load->view("staffs/requires/footer"); ?>
        </div><!-- End of .wrapper-->
    </body>
</html>