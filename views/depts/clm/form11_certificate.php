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
	$concern_ins = $formCertRow->concern_ins;
} else {
	$concern_ins = "Not found";
}
$formProcessRow = $this->formprocess_model->get_row($this->dept_code, $form_table, $form_id);
if($formProcessRow) {
	$p_date = $formProcessRow->p_date;
} else {
	$p_date= "Not Found!";
}
$formRow = $this->forms_model->get_row($this->dept_code, "clm_form11_t1", $form_id);
if($formRow) {
	$sl_no = $formRow->sl_no;
	$make = $formRow->make;
	$model_no = $formRow->model_no;
	$sl_f_du = $formRow->sl_f_du;
} else {
	$sl_no = "Not found";
	$make = "Not found";
	$model_no = "Not found";
	$sl_f_du = "Not found";	
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
		<h2 align = "center">GOVERNMENT OF ASSAM</h2>
		<h4 align = "center">OFFICE OF THE CONTROLLER OF LEGAL METROLOGY::ASSAM::GUWAHATI</h4>
		<h4 align = "center">(Office Address: Ram Krishna Mission Road, Ulubari, Guwahati-781007)</h4>
		<br/>
		<table width="100%"  >
			<tr>
				<td>UBIN : <b><?php echo $ubin; ?></b> </br> 
				
				UAIN : <b><?php echo $uain; ?></b> </br> </br>
				
				
				To, </br>
				<b><?=strtoupper($concern_ins);?></b></br>
				Sub:  Approval for Verification and Stamping of Dispensing Unit.</br> </br>
							
				</td>
				
				<td align="right"></br> 
				Dated Guwahati, the :  <b><?php echo date('d-m-Y',strtotime($p_date)); ?></b>
				</td>			
			</tr>
			
		</table>
		<br/>
		<p align="justify">
		With reference to the subject cited above, you are hereby allowed to verify and stamp the following Dispensing Unit as per rule after realization of verification and stamping fees.
		</p>
		<br/>
		
		
		<table class="table"  border="1">
    <thead>
      <tr>
		<th style="border-bottom:1px solid black; width:20%; text-align:center;">Sl No</th>
        <th style="border-bottom:1px solid black; width:30%; text-align:center;">Make</th>
        <th style="border-bottom:1px solid black; width:20%; text-align:center;">Model No.</th>
		<th style="border-bottom:1px solid black; width:30%; text-align:center;">Sl. No. of D.U</th>
       
      </tr>
    </thead>
    <tbody style="border:1px solid black;">
		<tr>
			<td> <?php echo strtoupper($sl_no);?></td>
			<td> <?php echo strtoupper($make);?></td>
			<td> <?php echo strtoupper($model_no);?></td>
			<td> <?php echo strtoupper($sl_f_du);?></td>
		</tr>
    </tbody>
  </table>
		<div class="row">
		<div class="col-sm-12" style="padding:0">			
			<div class="col-sm-6">
				<p align="left">Date: <b><?php echo date('d-m-Y',strtotime(date("h:i:sa")))?></b> </p>
			</div>					
			<div class="col-sm-6 pull-right" >
				<strong>Yours faithfully </br></br>
				Controller of Legal Metrology, </br>
				Assam, Guwahati-7  </strong>
			</div>			
		</div>
		</div>
						
						</div>
						<!-- copied -->
                    </div><!--End of .box-body--> 
                </div><!--End of .box-->                    
            </div><!--End of .content-wrapper-->
            <?php $this->load->view("staffs/requires/footer"); ?>
        </div><!-- End of .wrapper-->
    </body>
</html>
