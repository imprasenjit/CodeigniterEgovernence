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
		$reg_number = $formCertRow->reg_number;
		$lic_exp_year = $formCertRow->lic_exp_year;
		$max_evaporation = $formCertRow->max_evaporation;
        $sub_date = $formCertRow->sub_date;
		$ibs_no = $formCertRow->ibs_no;
		$tested_on = $formCertRow->tested_on;
		$repairs = $formCertRow->repairs;
		$remarks = $formCertRow->remarks;
		$boiler_type = $formCertRow->boiler_type;
		$not_exceed = $formCertRow->not_exceed;
		$valid_from = $formCertRow->valid_from;
		$valid_upto = $formCertRow->valid_upto;
		$loading_of = $formCertRow->loading_of;
	   
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
					<!-- copied contents from boiler_form2_certificate_print.php -->
						
 
<div align="center" style="padding: 10px; border:2px solid black;">				
						
                           <img src="<?=base_url('public/imgs/assam.png')?>" width="110px" height="140px" alt="Ashok">
                            <br/>

						   <table width="100%" id="paddingdone">
	<tr>
		<td colspan="4">
			<h3 align="center">FORM VI</h3>
			<h2 align="center">AssamBoiler Inspection Department</h2>
			<h2 align="center">CERTIFICATE FOR USE OF A BOILER</h2>
			<h3 align="center">(Regulation 389)</h3>
		</td>
	</tr>
	<tr>
		<td colspan="4">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2">UBIN : <?php echo $ubin; ?></td>
		<td align="right" colspan="2">UAIN : <?php echo $uain; ?></td>
	</tr>
	<tr>
		<td colspan="4">&nbsp;</td>
	</tr>
	<tr>
		<td>Registration Number</td> 
		<td><?=strtoupper($reg_number) ?></td>
		<!--<td>Type of Boiler</td>
		<td><?php if($row_certs[$boiler_type]!=NULL){ echo strtoupper($boiler_type)." - ".strtoupper($boiler_type);}else{ echo strtoupper($boiler_type); }?></td>
	-->
	</tr>
	<tr>
		
		<td>Maximum Continuous Evaporation </td>
		<td><?=strtoupper($max_evaporation); ?></td>
	</tr>
	<tr>
		<!--<td>Place and year of manufacture </td>
		<td><?=strtoupper($manu_name)." and ".strtoupper($manu_year); ?></td>-->
		<td> Name of Owner </td>
		<td colspan="3"><?=strtoupper($companyName); ?></td>
	</tr>
	<tr>
		<td> Situation of Boiler </td>
		<td colspan="3"><?=strtoupper($address); ?></td>
	</tr>
	<tr>
		<td> Repairs </td>
		<td colspan="3"><?=strtoupper($repairs); ?></td>
	</tr>
	<tr>
		<td> Remarks </td>
		<td colspan="3"><?=strtoupper($remarks); ?></td>
	</tr>
	<tr>
    <td colspan="4"> Hydraulically Tested on <?php echo $tested_on; ?> to <?php echo $ibs_no; ?> Ibs. per sq.inch</td>
	</tr>
	<tr>
		<td colspan="4">
			<p align="justify" style="padding:30px;">
						I hereby certify that the above described boiler is permitted by me/the Chief Inspector under the provisions of Section 7/8 of the Indian Boilers Act,No.V of 1923, to be worked at maximum pressure of <?=strtoupper($not_exceed); ?> kg/cm<sup>2</sup> to the square inch from the period from  <?=date("d-m-Y",strtotime($valid_from)); ?> to <?php echo $year=date("d-m-Y",strtotime($valid_upto));?>. <br/><br/>
				The loading of the  <?=strtoupper($loading_of); ?> safety valve is not to exceed <?=strtoupper($not_exceed); ?> kg/cm<sup>2</sup>.<br/><br/>
				Fee Rs. <?=strtoupper($total_fees)?> Paid.
			</p>
		</td>
	</tr>
</table>
		<table align="center" style="padding-top:10px;width:90%;font-family:sanserif;">
				<tr>
					<td style="width:50%;padding-left:10px;">Place : GUWAHATI<br/>Date : <?=date("d-m-Y",strtotime($sub_date));?></td>
					<td style="width:50%;padding-right:10px;text-align:right;"><?=strtoupper($key_person);?><br/><?=strtoupper($dist);?><br/>
			<br/>
			<br/>
			Competent Person<br/></td>
				</tr>                    
		</table>
		<br/>
		<div class="row" style="padding-left:5%;padding-bottom:20px;">
			<div style="width:70%;position:relative;float:left;text-align:left">
				<p>&nbsp;</p>
			</div>
			<div style="width:30%;position:relative;float:left;">
				<img src="<?=base_url('storage/temps/qrcode.png')?>?d=<?php echo $uain; ?>" style="width: 120px; height: 120px"/>
                                    </div>
		</div>
		<div style="clear:both"></div>
	</div>
		
<br/><br/>
<div align="left" style="padding: 10px; border:2px solid black;">
	<p style="text-align:center"><strong>CONDITIONS </strong> <br/> (REVERSE OF FORM VI) </p>
	<div align="justify">
		<ol>
			<li>No structural alternation, addition of renewal shall be made to the boiler otherwise than in accordance with section 12 of the Act.</li>
			<li>Under the provisions of Section 8 of the Act this certificate shall cease to be in force : 
				<ol type="a">
					<li>on the expiry of the period for which it was granted; or </li>
					<li>When any accident occurs to the boiler; or </li>
					<li>when the boiler is moved the boiler not being vertical boiler the heating surface of which is less than two hundread square feet, or a portable or vehicular boiler; or </li>
					<li>when any structural alternation, addition or renewal is made in or to the boiler; or </li>
					<li>if the Chief Inspector in any particular case so directs when any structural alternation, addition or renewal is made in or to any steam-pipe attached to the boiler; or </li>
					<li>on the communication to the owner of the boiler of an order of the Chief Inspector prohibiting its use on the ground that it or any steam-pipe attached thereto is in a dangerous condition.
					Under section 10 of the act, when the period of a certificate relating to a boiler  has expired, the owner shall, provided that he has applied before the expiry of that period  for a renewal of the certificate 
					be entitled to use the boiler at the maximum pressure entered in the former certificate, pending the issue of orders on the application but this shall not be deemed to authorize the use of a boiler in any of the cases 
					referred to in clauses (b), (c), (d), (e), and (f) of sub-section (1) of section 8 occurring after the expiry of the period of the certificate.</li>
				</ol>
			</li>
			<li>The boiler shall not be used at a pressure  greater than the pressure entered in the certificate as the maximum pressure nor with the safety valve set to a pressure exceeding such maximum pressure.</li>
			<li>The boiler shall not be used otherwise than in a condition which the owner reasonably believes to be compatible with safe working.</li>
		</ol>
	</div>
	<p>
		<strong>Note: </strong>The particulars and dimensions regarding this boiler may be obtained by the owner on payment in the prescribed manner on application to the Chief Inspector.
	</p>
</div>
					
					
					
							<!-- copied contents from boiler_form2_certificate_print.php -->

					</div> <!-- End of  alomcertbl printcontent -->
					</div><!--End of .box-body--> 
                </div><!--End of .box-->                    
            </div><!--End of .content-wrapper-->
            <?php $this->load->view("staffs/requires/footer"); ?>
        </div><!-- End of .wrapper-->
    </body>
</html>
