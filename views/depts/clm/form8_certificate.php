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

$formProcessRow = $this->formprocess_model->get_row($this->dept_code, $form_table, $form_id);
if($formProcessRow) {
	$p_date = $formProcessRow->p_date;
} else {
	$p_date= "Not Found!";
}

$formCertRow = $this->formcertifcates_model->get_row($this->dept_code, $form_table, $form_id);
if($formCertRow) {
	$reg_no = $formCertRow->reg_no;	
} else {
	$reg_no = "";
}
$formRow = $this->forms_model->get_row($this->dept_code, $form_table, $form_id);
if($formRow) {
	$details_f_pack = $formRow->details_f_pack; 
	$imp_country = $formRow->imp_country;
} else {
	$details_f_pack = "Not found";
	$imp_country = "";
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
		<h4 align = "center"><b>OFFICE OF THE CONTROLLER OF LEGAL METROLOGY, ASSAM, GUWAHATI.<br/>CERTIFICATE OF REGISTRATION<br/>Under rule 27 of the Legal Metrology (Packaged Commodities) Rules, 2011</b></h4>
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
		<p>LICENCE TO A DEALER IN WEIGHTS, MEASURES, WEIGHING INSTRUMENTS OR MEASURING INSTRUMENTS</p>
		<br/>
		<div class="col-sm-12" style="padding:0;">
			<div class="col-sm-6">
			</div>					
			<div class="col-sm-6 pull-right" >
				<p align="right">Year - <?php echo date('Y',strtotime($p_date));?></p>
			</div>	
		</div>
		<p style="text-indent: 14px;" align="justify">Certified that the name and address of  <?php echo strtoupper($companyName).", ".strtoupper($address);?>, <?php echo strtoupper($companyOwner);?> : <?php echo strtoupper($key_person);?> (Registered Office Address : <?php echo strtoupper($address);?> having its imporing/ packing unit(s) as given under for importing item(s) as mentioned, have been registered in this office assigning Registration No. <?php echo strtoupper($reg_no);?>.</p>
		<br/>
		<table class="table"  border="1">
			<thead>
				<tr>
					<th style="border-bottom:1px solid black; width:40%; text-align:center;">Manufacturing/ Packing Unit(s)</th>
					<th style="border-bottom:1px solid black; width:40%; text-align:center;">Items Packed.</th>
				</tr>
			</thead>
			<tbody style="border:1px solid black;">
				<tr>
					<td><?php echo strtoupper($details_f_pack);?></td>
					<td><?php echo strtoupper($imp_country);?></td>
				</tr>
			</tbody>
		</table>
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
		<br/>
		<p align="justify">1. The firm is requested to note that the registration in this office does not necessarily constitute acceptance or recognition by the Government of any of the facts stated in their application. Further the registration will not imply any commitment whether on the part of Government to provide subsidy or any other assistance.</p>
		<p align="justify">2. In case it is desired to suspend the activities, the registration certificate may be returned to this office for cancellation.</p>
		<p align="justify">3. In case of any addition/deletion of your units and for making any other alteration please apply for revised certificate. The units should be informed about the firm&#39;s registration number which may be required by the enforcement officials at the time of their inspection or at the time of net content checking of the samples of their product.</p>
		<br/>
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
