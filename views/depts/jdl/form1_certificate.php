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

$formCertRow = $this->formprocess_model->get_row($this->dept_code, $form_table, $form_id);
if($formCertRow) {
	$p_date = $formCertRow->p_date;
	
} else {
	$p_date= "Not Found!";
}
$formRow = $this->forms_model->get_row($this->dept_code, $form_table, $form_id);
if($formRow) {
	$case_no = $formRow->case_no;
} else {
   $case_no = "Not found";
}
$formRow = $this->forms_model->get_row($this->dept_code, "jdl_form1_petitioner", $form_id);
if($formRow) {
	$peti_name = $formRow->peti_name;
} else {
   $peti_name = "Not found";
}

$formRow = $this->forms_model->get_row($this->dept_code, "jdl_form1_respondent", $form_id);
if($formRow) {
	$resp_name = $formRow->resp_name;
} else {
   $resp_name = "Not found";
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
                        <div class="alomcertbl printcontent" style="padding:20px">
									<div class="text-center">
										<h2 class="text-uppercase"><?php echo $this->dept_name; ?></h2>
										
										<br/>
										</div>
										<h4 align = "center"><b>IN THE GAUHATI HIGH COURT AT GUWAHATI</b></h4>
										<h5 align = "center"><b>(HIGH COURT OF ASSAM, NAGALAND, MIZORAM AND ARUNACHAL PRADESH)</b></h5>
										<br/>
										<table width="100%">
											<tr>
												<td>Case Number : <b><?=strtoupper($case_no)?></b></td>
												<td align="right">UAIN : <b><?=strtoupper($uain)?></b></td>
											</tr>
										</table>
										<br/>
										<h4 align = "center"><b>Writ Petition (PIL) No. 000123 of <?=date('Y',strtotime(date("d-m-y")))?></b></h4>
										<table width="100%">
											<tr>
												<td width="50%"><?=strtoupper($peti_name)?></td>
												<td align="right"><b>Petitioner</b></td>
											</tr>
										</table>		
										<h4>Versus</h4>
										<table width="100%">
											<tr>
												<td width="50%"><?=strtoupper($resp_name)?></td>
												<td align="right"><b>Respondents</b></td>
											</tr>
										</table>
										<p align="justify">Heard , learned counsel for the appellant and Mr. M. Talukdar, the learned counsel for the substituted respondents No.1(i)and 1(ii). The name of Respondent No.2 had been struck of by order dated 23.06.2016.</p>
										<br/>
										<p>Dated : <?=date("d-m-Y",strtotime($p_date))?></p>
										<p align="left"><b><u>Coram: Hon&rsquo;ble <?=strtoupper($companyOwner)?></u></b></p>
										<br/>
										<table width="100%">
											<tr>	
												<td>Place of issue : GUWAHATI</td>
												<td></td>
											</tr>
											<tr>
												<td>Date of issue : <?php echo date("d-m-Y",strtotime($p_date)); ?></td>
												<td align="right"></td>
											</tr> 
										</table>
										<br/><br/>
										
										<div class="row" style="padding-left:5%;padding-bottom:20px;">
											<div style="width:70%;position:relative;float:left;text-align:left">
												&nbsp;
											</div>
											<div style="width:30%;position:relative;float:left;">
												
											</div>
										</div>
								
									
						    </div><!--End of .alomcertbl-->
                    </div><!--End of .box-body--> 
                </div><!--End of .box-->                    
            </div><!--End of .content-wrapper-->
            <?php $this->load->view("staffs/requires/footer"); ?>
        </div><!-- End of .wrapper-->
    </body>
</html>