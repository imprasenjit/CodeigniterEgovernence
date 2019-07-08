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
	$reg_no = $formCertRow->reg_no;
	//$total_fees = $formCertRow->total_fees;
	//$sub_date = $formCertRow->sub_date;
	//$lic_no = $formCertRow->lic_no;
	//$licensed_area = $formCertRow->licensed_area;
	//$lic_exp_year = $formCertRow->lic_exp_year;
	//$regular_fees = $formCertRow->regular_fees;
	//$arrear_fees_details = $formCertRow->arrear_fees_details;
	 //$penalty_charge = $formCertRow->penalty_charge;
	
	//$arf = json_decode($arrear_fees_details);


	
} else {
	$reg_no = "";
	//$total_fees = 0;
	//$sub_date = "";
	//$lic_no = "";
	//$licensed_area = "";
	//$lic_exp_year = "";
	//$regular_fees = "";
	//$arrear_fee = "";
	//$penalty_charge = "";
}
$formProcessRow = $this->formprocess_model->get_row($this->dept_code, $form_table, $form_id);
if($formProcessRow) {
	$p_date = $formProcessRow->p_date;
} else {
	$p_date= "Not Found!";
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
								
		<div style="position:relative;text-align:center;">							
			<img src = "<?=base_url('public/imgs/assam.png')?>" class="alomlogoimg">
		</div>
		<br/>
		<h4 align = "center">OFFICE OF THE CONTROLLER OF LEGAL METROLOGY, ASSAM, GUWAHATI.<br/>[Certificate of nomination of Director of the Company under section 49(2) of the Legal Metrology Act, 2009]</h4>
		<br/>
		<table width="100%"  >
			<tr>
				<td>UBIN : <b><?php echo $ubin; ?></b></td>
				<td align="right">UAIN : <b><?php echo $uain; ?></b></td>
			</tr>
		<tr>
			<td>Registration No.:	<b><?=strtoupper($reg_no);?></b></td></br>
				</tr>
		</table>
		<br/>
		<p style="text-indent: 14px;" align="justify">Certified that <?php echo strtoupper($key_person);?> Director of <?php echo strtoupper($companyName);?> has been registered as nominated Director assigning Nomination Registration No. <?php echo strtoupper($reg_no);?> for the matter related with Legal Metrology in the said company.</p>
		<br/>
		<div class="col-sm-12" style="padding:0;">
			<div class="col-sm-6">
				<p>&nbsp;</p>
			</div>					
			<div class="col-sm-6 pull-right" >
				<p align="center"><?php echo strtoupper($companyOwner) ?><br/>Controller of Legal Metrology,<br/>Assam::Guwahati.</p>
			</div>	
		</div>
		<br/>
		<table width="100%">
			<tr>
				<td>Date : <?php echo date('d-m-Y',strtotime($p_date)); ?></td>
				<td></td>
			</tr>
			<tr>
				<td>Place : <?php echo $dist;?></td>
				<td></td>
			</tr>
		</table>
		<br/>
		<p align="justify"><b>Note :</b></p>
		<div align="justify">
			<ol>
				<li>Where an offence under this Act has been committed by a company, the person who has been nominated to be in charge of, and responsible to, the company for the conduct of the business of the company, shall be deemed to be guilty of the offence and shall be liable to be proceeded against and punished accordingly;</li>
				<li>The Director, so authorized by the company shall exercise all such powers and take all such steps as may be necessary or expedient to prevent the commission by the company of any offence under this Act.</li>
				<li>The person so nominated shall continue to be the person responsible until:
					<ol type="i">
						<li>Further notice cancelling such nomination is received from the company by the Director or the concerned Controller or the authorized officer; or</li>
						<li>He ceases to be the director of the Company; or</li>
						<li>He makes a request in writing to the Director or the concerned Controller or the Legal Metrology Officer under intimation to the Company, to cancel the nomination, which request shall be complied with the Director or the concerned Controller or the Legal Metrology Officer.</li>
					</ol>
				</li>
				<li>Notwithstanding anything contained in the foregoing notes, where an offence under this Act has been committed by a Company and it is proved that the offence has been committed with the consent or connivance of, or is attributable to the neglect on the part of, any Director, Manager, Secretary or other Officer, not being a person nominated, such Director, Manager, Secretary or other Officer shall also be deemed to be guilty of that offence and shall be liable to be proceeded against and punished accordingly.</li>
			</ol>
		</div>
		<div class="row" style="padding-left:5%;padding-bottom:20px;">
			<div style="width:70%;position:relative;float:left;text-align:left">
				&nbsp;
			</div>
			<div style="width:30%;position:relative;float:left;">
				 <img src="<?=base_url('storage/temps/qrcode.png')?>" height = "100px">
			</div>
		</div>
		<br/>
					   
					   
					   <!-- copied -->
                    </div><!--End of .box-body--> 
                </div><!--End of .box-->                    
            </div><!--End of .content-wrapper-->
            <?php $this->load->view("staffs/requires/footer"); ?>
        </div><!-- End of .wrapper-->
    </body>
</html>
