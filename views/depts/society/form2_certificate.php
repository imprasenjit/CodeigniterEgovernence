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
		
        $sub_date = $formCertRow->sub_date;
		$reg_no = $formCertRow->reg_no;
		$opp_area = $formCertRow->opp_area;
		$lic_place = $formCertRow->lic_place;
		$valid_upto  = $formCertRow->valid_upto;
	   
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
						<!--copied from society_form2_certificate.php-->
                       <div align="center" style="padding: 10px 30px;width:85%; border:2px solid black;">		
			
						
                           <img src="<?=base_url('public/imgs/assam.png')?>" width="110px" height="140px" alt="Ashok">
                            <br/>
		
		<br/>
		<h2>
		    OFFICE OF THE REGISTRAR OF COOPERATIVE SOCIETIES<br/>
		    KAHANAPARA, GUWAHATI
	    </h2>
		<h4>CERTIFICATE OF REGISTRATION</h4>
		<br/>
		<table width="100%"  >
			<tr>
				<td>UBIN : <b><?php echo $ubin; ?></b></td>	

		<td align="right"><?php if($total_fees!=""){?>Fees Paid : <b><?php echo "Rs. ".$total_fees; ?><?php }?></b></td>
			</tr>
			<tr>
				<td>UAIN : <b><?php echo $uain; ?></b></td>
	<td align="right">Registration No. :<b><?php echo $reg_no;?></b></td>

			</tr>
			
		</table>
		<br/>
		<p align="justify">
			In the office of the Registrar of Cooperative Societies, under the Assam Cooperative Societies Act 2007 (Act IV of 2012)
		</p>
		<!--<p align="justify">
			In the matter of application of Shri/Smti <b><?=strtoupper($key_person);?></b> and <b><?=strtoupper($companyName);;?></b> others for registration of a cooperative society at P.O <b><?=strtoupper($s_po);?></b> P.S <b><?=strtoupper($s_ps);?></b> Sub-Division <b><?=strtoupper($b_block);?></b> District <b><?=strtoupper($dist);?></b> in the state of Assam.
		</p>-->
		<p align="justify">
			I do hereby certify that in pursuance of Section 11 (b) of the Assam Cooperative Societies Act,2007 the said Society has been registered in the office of the undersigned with limited liability under the name and style of “<b><?=strtoupper($companyName);?></b>” with registration No. <b><?=strtoupper($reg_no);?></b>.
		</p>
		<div align="justify">            
			<ul>
				<li>The Bye-laws adopted by the said Society have also been registered.</li>
				<li>The area of operation of the society shall be confined to <b><?=strtoupper($opp_area);?></b></li>
				<li>Registration fees of Rs <b><?=strtoupper($total_fees);?></b> paid.<!-- vide TC No <b>(Treasury Challan No)</b>--></li>
			</ul>
		</div>
		<p align="justify">Given under my seal and signature on <b><?=date('j',strtotime($sub_date));?></b> of <b><?=date('M',strtotime($sub_date));?></b> of the year <b><?=date('Y',strtotime($sub_date));?></b> Anno Dommini.</p>
		<br/>
		<table width="100%">
			<tr>
				<td>Place of issue : GUWAHATI</td>
				<td></td>
			</tr>
			<tr>
				<td>Date of issue : <?php echo date("d-m-Y",strtotime($sub_date)); ?></td>
				<td align="center">Your Sincerly,<br/>
				Commissioner<br/>
				Industries and Commerce Department<br/>
				Udyog Bhawan<br/>
				Bamunimaidam, Guwahati - 781021</td>
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
                                    <img src="<?=base_url('storage/temps/qrcode.png')?>" style="width: 120px; height: 120px">
                                </div>
		</div>	
		<p align="justify">N.B. The registration may get cancelled if the provisions as laid down under Section 94 of the Assam Cooperative Societies Act, 2007 are fulfilled.</p>
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