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
		
        $certificate_no = $formCertRow->certificate_no;
		$valid_upto = $formCertRow->valid_upto;
		$sub_date = $formCertRow->sub_date;
		$renewed_upto = $formCertRow->renewed_upto;
		
		
	   
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
						
                           <img src="<?=base_url('public/imgs/assam.png')?>" width="110px" height="140px">
                            <br/>
		<h4><b>OFFICE OF THE DIRECTORATE OF AGRICULTURE</b></h4>
		
		<br/>
		<p align="center"><b>FORM 'F'<br/>(See Clause 15(2) & 18(2))</b></p>
		<br/>
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
		<div class="col-sm-12" style="padding:0;">
			<div class="col-sm-6 pull-right">
				<p align="right">Renewal Registration Certificate No.:<?php echo strtoupper($certificate_no);?></p>
				<p align="right">Valid up to : <?=date('d-m-Y',strtotime($valid_upto)); ?> 
				<p align="right">Date of Issue : <?php echo date('d-m-Y',strtotime($sub_date));?></p>
			</div>					
		</div>
		<p align="center"><h4><b>CERTIFICATE OF MANUFACTURER IN RESPECT OF PHYSICAL/GRANULATED MIXTURES OF FERTILIZERS OR MIXTURE OF MICRO NUTRIENT FERTILIZERS OR BIO-FERTILIZERS</b></h4></p>
		 <br/>
		<p style="text-indent: 14px;" align="justify">M/S <?php echo strtoupper($companyName);?> is hereby given the certificate for manufacturer of the fertilizer specified below subject to the terms and condition of this certificate and to the provisions of the Fertilizer (Control) Order, 1985.</p>
       <br/>
     <div>
	 <div style="width:90%">
			
				<div class="pull-left"></div>
				<div class="pull-left">Full particulars of the Fertilizer:</div>
			<!--	<div class="col-sm-6 pull-right">Full Address of the premises where the Fertilizer will be made<br/><br/>M/S&nbsp;<?php echo strtoupper($companyName);?>ASSAM,<?php echo strtoupper($address);?></div>
			-->
		
		<tbody>
											<?php
											$formRows = $this->forms_model->get_frmrows($this->dept_code, "doa_form22_t1", $form_id);
													
													if($formRows){
													  $count=1;
													  foreach($formRows as $rows){	?>
											<tr>
												
												<td><?=strtoupper($rows->fertilizer);?></td>
												
											</tr>
											<?php }
											} ?>
									</tbody>
									
	  </div>
       	   
		</br></br></br>
		
		<div class="col-sm-12" style="padding:0;">
			<div class="col-sm-6">
				<p align="justify"></p>
			</div>					
			<div class="col-sm-6 pull-right">
				<p align="center"><?php echo strtoupper($key_person) ?><br/>Directorate of Agriculture<br/>Govt. of Assam</p>
			</div>	
		</div>
		<br/>
		<table width="100%">
			<tr>
				<td>Date : <?php echo date('d-m-Y',strtotime($sub_date));?></td>
				<td align="right">Registering Authority<br/>State : ASSAM</td>
			</tr>
			<tr>
				<td>Seal : </td></td>
				<td align="right">Renewed upto&nbsp;<?=date('d-m-Y',strtotime($renewed_upto));?></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			
			
		</table>
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
							<!-- copied -->
                        </div>
                    </div><!--End of .box-body--> 
                </div><!--End of .box-->                    
            </div><!--End of .content-wrapper-->
            <?php $this->load->view("staffs/requires/footer"); ?>
        </div><!-- End of .wrapper-->
    </body>
</html>