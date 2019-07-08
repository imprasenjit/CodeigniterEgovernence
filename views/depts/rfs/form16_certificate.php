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
		$c_remarks = $formCertRow-> c_remarks;
	 $c_business_nature = $formCertRow-> c_business_nature;
	 $other_place = $formCertRow-> other_place;
	 $from_the_year = $formCertRow-> from_the_year;
	 $to_the_year = $formCertRow-> to_the_year;
        $sub_date = $formCertRow->sub_date;
		$issue_number = $formCertRow->issue_number;
		$regn_no= $formCertRow->regn_no;
	   $reg_name = $formCertRow->reg_name;
	   $date_of_o_n_c = $formCertRow->date_of_o_n_c;
	   $date_of_filling = $formCertRow->date_of_filling;
	   
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
						<!--copied from rfs_form16_certificate.php-->
                     <div align="center" style="padding: 10px; border:2px solid black;">		

                           							
                            <td>
									<h3>OFFICE OF THE REGISTARAR OF FIRMS &amp; SOCIETIES, ASSAM, GUWAHATI</h3>

                           </td>
                            <table width="100%"  >
                            <img src="<?=base_url('public/imgs/assam.png')?>" class="alomlogoimg" /> <br />
				<td width="45%"></td>				
		
		</table>
		
		<h3><b>CERTIFIED COPY OF REGISTARAR OF FIRMS, ASSAM</b></h3>
		<br/>
		<table width="100%"  >
			<tr>
				<td></td>
				<td align="right">Issue Number : <b><?php echo $issue_number; ?></b></td>				
			</tr>
			<tr>
				<td>UBIN : <b><?php echo $ubin; ?></b></td>
				<td align="right">UAIN : <b><?php echo $uain; ?></b></td>				
			</tr>
		</table>
		<br/>
			<p align="left">Number of the firm on the Register: <b><?php echo strtoupper($regn_no); ?></b> of <b><?=$from_the_year?>-<?=$to_the_year?></b>.</p>
			<p align="left">Name of the Firm: <b><?php echo strtoupper($companyName); ?> (<?php echo strtoupper($c_business_nature); ?>)</b>.</p>
			<p align="left">Date of Establishment: <b><?php echo date('d-m-Y',strtotime($sub_date)); ?></b>.</p>
			<!--<p align="left">Duration of the Firm: <b><?=strtoupper($firm_duration)?></b>.</p>
			-->
			<table width="100%" class="table table-responsive" border="1">
			<thead>
				<tr>
					<th width="25%">Serial No. of Document</th>
					<th width="25%">Date of Filling or Registration</th>
					<td rowspan="2">Despription of documents filled in the statement on Form No. <b>V</b> under section <b>63(1)</b> the I.P. Act, 1932</td>
				</tr>
			</thead>
			<tbody>
			<tr>
				<td></td>
					<td><?=date('d-m-Y',strtotime($date_of_filling))?></b></td>
				</tr>
			</tbody>
		</table>
		<p align="justify">Name and permanent address of the partners and date of joining</p>
		<table width="100%" class="table table-responsive text-center" border="1">
			<thead>
				<tr>
					<th>Sl No.</th>
					<th>Full Name of partners</th>
					<th>Permanent Address</th>
					<th>Date of Joining</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				    $formRows = $this->forms_model->get_frmrows($this->dept_code, "rfs_form16_t1", $form_id);
													//$part2=$ayush->query("SELECT * FROM ayush_form2_t2 WHERE form_id='$form_id'");
													//$num2 = $part2->num_rows;
													if($formRows){
													  $count=1;
													  foreach($formRows as $rows){	?>
											<tr>
												<td><?=strtoupper($rows->sl_no);?></td>
												<td><?=strtoupper($rows->member_name);?> <br/> <?=strtoupper($rows->member_name1);?></td>
												<td><?=strtoupper($rows->member_address);?> <br/> <?=strtoupper($rows->member_address1);?></td>
										<td><?=strtoupper($rows->date_f_joining);?></td>

											</tr>
						<?php }
											} ?>
							
			</tbody>
		</table>
		<br/>
		<p align="justify">Place of Business and Other Place of Business</p>
		<table width="100%" class="table table-responsive text-center" border="1">
			<thead>
				<tr>
					<th width="50%">Principal place</th>
					<th width="25%">Other place</th>
					<th>Date of closing or opening</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><?php echo strtoupper($c_business_nature); ?></td>
					<td><?=strtoupper($other_place);?>
					</td>
					<td><?=strtoupper($date_of_o_n_c);?></td>
				</tr>
			</tbody>
		</table>
		<table width="100%" class="table table-responsive text-center" border="1">
			<thead>
				<tr>
					<th width="50%">Recording of changes of constitution or dissolution and also withdrawal of minor Partners</th>
					<th width="25%">Remarks</th>
					<th>Signature of the Registrar of Firms</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>The Change in Constitution of the Firm has been recorded w.e.f. <?php echo date("d-m-Y",strtotime($sub_date)); ?> By <b><?=strtoupper($reg_name)?></b> , Registrar of Firms, Assam, Guwahati, under Sec. 63(I) and Rule 4(6), of Indian Partnership ct 1932.</td>
					<td>
						<?=strtoupper($c_remarks)?>
					</td>
					<td><center><b><?php echo strtoupper($reg_name); ?></b><br/>Registrar of Firms, Assam,<br/>Dispur Guwahati</center></td>
				</tr>
			</tbody>
		</table>
		<br/>
		<table width="100%">
			<tr>
				<td width="50%">
					Place of issue : GUWAHATI<br/></td>
				<td align="left">	Date of issue : <?php echo date("d-m-Y",strtotime($sub_date)); ?>
				</td>
				<td></td>
			</tr>
		</table>
		<br/><br/>
		
		<div class="row" style="padding-left:5%;padding-bottom:20px;">
			<div style="width:70%;position:relative;float:left;text-align:left">
				<p>&nbsp;</p>
			</div>
			<div style="width:30%;position:relative;float:left;">
                                    <img src="<?=base_url('storage/temps/qrcode.png')?>" style="width: 120px; height: 120px">
                                </div>
		</div>
		<br/>
		<br/>
		<p align="left">N.B.:- Registered number of the Firm should not be stated as Govt. registered. It is registered under I.P. Act, 1932.</p>
		<p align="center">This is a computer generated certificate and it does not require signature. This certificate can be verified by UAIN or the QR Code printed on it.</p>
		<p align="left">** Name of the registarar at the time of Initial Registration of the Firm <b><?=strtoupper($reg_name)?></b></p>		
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
