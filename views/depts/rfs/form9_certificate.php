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
	//$lic_exp_year = $formCertRow->$lic_exp_year;
		$regular_fees = $formCertRow->regular_fees;
		$arrear_fees_details = $formCertRow->arrear_fees_details;
		$penalty_charge = $formCertRow->penalty_charge;
		
		$lic_exp_year = $formCertRow->lic_exp_year;
		$valid_upto = $formCertRow->valid_upto;
		$lic_place = $formCertRow->lic_place;
		$license_no = $formCertRow->license_no;
        $sub_date = $formCertRow->sub_date;
		
	   
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
$formProcessRow = $this->formprocess_model->get_row($this->dept_code, $form_table, $form_id);
if($formProcessRow) {
    $p_date = $formProcessRow->p_date;
} else {
    $p_date = "Not found";
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
                       <!--copied from rfs_form9_certificate.php-->
					   <div align="center" style="padding: 10px; border:2px solid black;">
           <img src="<?=base_url('public/imgs/assam.png')?>" class="alomlogoimg" /> <br />
			<h2 class="text-uppercase"><?=$this->dept_name?></h2>
		<h3>Changes in the Managing body, Constitution, Submission of Balance sheet and Auditors report of the Society<br/>Under Section 4, 4(A) & 4(B) of the S.R. Act XXI of 1860</h3>
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
			<p align="center">
			Certify that the society named <?php echo strtoupper($companyName); ?>, <?php echo strtoupper($address); ?> bearing Regn. No.<b><?=strtoupper($license_no)?></b> of <?=$valid_upto?> has submitted documents as per section 4, 4(A) & 4(B) of the S.R. Act XXI of 1860.</p>
		<br/>
		<table width="100%">
			<tr>
				<td align="left">Place of issue : GUWAHATI<br/>Date of issue : <?php echo date("d-m-Y",strtotime($p_date)); ?></td>
				<td align="right">REGISTRAR OF SOCIETIES<br/>ASSAM, GUWAHATI</td>
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
                                    <img src="<?=base_url('storage/temps/qrcode.png')?>" style="width: 120px; height: 120px">
                                </div>
		</div>
		<br/>
		<p align="left">N.B.:- Registered number of Societies should not be stated as Government registered. It is registered under S.R.Act, XXI of 1860.</p>	<br/>	
		<p align="center"><b>SOCIETIES REGISTRATION ACT, XXI OF 1860<br/>(some important provisions)</b></p>
		<p align="justify">Sec. 4:-<br/>
		Once in every, on or before the fourteenth day succeeding the day on which, according to the rules of the society, the annual general meeting of the Society is held, or, if the rules do not provide for an annual general meeting, in the month of January, a list shall be filed with the Registrar of societies, of the names, addresses and occupations of the Governors, Council, Directors, Committee, or other governing body then entrusted with the management of the affairs of the society.</p>
		<p align="justify">Sec. 4(A) (1):-<br/>
		Together with the list mentioned in Sec.4, there shall be sent to the Registrar of Societies a statement showing changes during the year to which the list relates in the personnel of governors, council, directors, committee or other governing body to whom the management of the affairs of the society is entrusted and also a copy of the rules of the society corrected upon date and certified to be a correct copy but not less then three of the members of governing body.</p>
		<p align="justify">Sec.4 (A) (2):-<br/>
		A copy of every alteration made in the rules of the society, certified to be a correct copy by less than three members of the governing body, shall be sent to the Registrar of Societies within fifteen days of making such alteration</p>
		<p align="justify">Sec. 4(B)(1) :-<br/>
		Within thirty days after the holding of every annual general meeting there shall be filed with the Registrar of Societies a copy each of the balance-sheet and auditors report certified by the auditor under such section (2) of Sec. 5.A.</p>
		<p align="justify">Sec.4(B)(2) :-<br/>
		If the President, Secretary or any other person authorized in this behalf by resolution of the governing body of the society fails to comply with the provisions of sub-section (1) he shall be punishable with fine which may extend to five hundred rupees.</p>
		<p align="justify">Sec. 5(A) (1):-<br/>
		Every society shall keep at its registered office proper books of account in which shall be entered accurately -
		(a) All sums of money received and the source thereof and all sums of money expended by the society and the object or purpose for which such sums are expended;<br/>
		(b)The assets and liabilities of the society.</p>
		<p align="justify">Sec.5(A) (2):-<br/> 
		Every society shall have its account audited once every year by a duly qualified auditor and have a balance sheet prepared by him. The auditor shall also submit a report showing the exact sate of the financial affairs of the society .Three copies of the balance sheet and auditor&#39;s report shall be certified by the auditor .</p>
		<p align="justify">Explanation :-<br/>
		A duty qualified auditor means chartered accountant within the meaning of the Chartered Accountants, Act, 1949 or a person approved by the Registrar of societies in this behalf.</p>
		<p align="justify">Sec.5(A)(3) :-<br/>
		If the President, Secretary or any other person authorized in this behalf by a resolution of the governing body of the society fails to comply with the provisions of sub-section(1) or sub-section (2) he shall be punishable with fine which may extend to twenty rupees for every day after the detection of the default during which the default continues.</p>
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
