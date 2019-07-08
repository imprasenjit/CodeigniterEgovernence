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
		$max_evaporation = $formCertRow->max_evaporation;
        $sub_date = $formCertRow->sub_date;
		$ibs_no = $formCertRow->ibs_no;
		$tested_on = $formCertRow->tested_on;
		$repairs = $formCertRow->repairs;
		$remarks = $formCertRow->remarks;
	   
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
                    <div class="box-body alomcertbl printcontent">
      <!--copied from boiler_form5_certificate.php-->
<div align="center" style="padding: 10px; border:2px solid black;">				
						
                           <img src="<?=base_url('public/imgs/assam.png')?>" width="110px" height="140px" alt="Ashok">
                            <br/>
 <table width="100%" id="paddingdone">
	<tr>
		<td colspan="4">
			<center><img src="departments/factory/images/ashok.png" width="110px" height="140px" alt="Ashok"></center>
			<h2 align="center">INSPECTORATE OF BOILERS</h2>
			<h2 align="center">Certificate for Recognition as Manufacturer of Boiler and Boiler Components under Indian Boiler Regulations, 1950</h2>
		</td>
	</tr>
	<tr>
		<td colspan="4">&nbsp;</td>
	</tr>
	
	<tr>
		<td>UBIN : <b><?php echo $ubin; ?></b></td>
		<td align="right">UAIN : <b><?php echo $uain; ?></b></td>
		
	</tr>
	<tr>
		<td></td>
		<td align="right"><?php if($total_fees!=""){?>Fees Paid : <b><?php echo "Rs. ".$total_fees; ?><?php }?></b></td>
	</tr>
	
	<tr>
		<td colspan="4"> To </br> <b><?=strtoupper($companyName);?>,</b></br><?=strtoupper($address);?></td>
	</tr>
	<tr>
	<td colspan="4">
       <p align="justify" style="padding:30px;text-indent:24px;">With reference to your application for Recognition as Manufacturer of Boiler and Boiler Components, I hereby grant approval to your firm / workshop for manufacturing of "<?=strtoupper($max_evaporation);?>" Boiler and Boiler Components, under IBR, 1950 including additional manufacturing facilities located at <?=strtoupper($address);?> for a period of 2 (two) Years, i.e. upto <?php echo date("d-m-",strtotime($sub_date)); echo date("Y",strtotime($sub_date))+2;?> subject to adherence of conditions mentioned in IBR, 1950.</p><br/>
	</td>
	</tr>
</table>
		<table align="center" style="padding-top:10px;width:90%;font-family:sans-serif;">
			<tr>
				<td style="width:50%;padding-left:10px;">Place : Guwahati<br/>Date : <?php echo date("d-m-Y",strtotime($sub_date)); ?></td>
				<td style="width:50%;padding-right:10px;text-align:right;"><center><?php echo strtoupper($key_person); ?><br/>Chief Inspector of Boilers<br/>Guwahati, Assam</center>
				</td>
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
				<img src="<?=base_url('storage/temps/qrcode.png')?>?d=<?php echo $uain; ?>" style="width: 120px; height: 120px"/>
                                    </div>
		</div>
		
		
		<div style="clear:both"></div>
	</div>
	<!--copied-->
                    </div><!--End of .box-body--> 
                </div><!--End of .box-->                    
            </div><!--End of .content-wrapper-->
            <?php $this->load->view("staffs/requires/footer"); ?>
        </div><!-- End of .wrapper-->
    </body>
</html>
