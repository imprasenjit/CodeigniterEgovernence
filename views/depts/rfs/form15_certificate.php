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
		$validity_extended_upto = $formCertRow->validity_extended_upto;
        $sub_date = $formCertRow->sub_date;
		$issue_number = $formCertRow->issue_number;
		$reg_number = $formCertRow->reg_number;
		$to_the_year = $formCertRow->to_the_year;
		$from_the_year = $formCertRow->from_the_year;
	   //$reg_name = $formCertRow->reg_name;
	   
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
<!--copied from rfs_form15_certificate.php-->               
			  <div align="center" style="padding: 10px; border:2px solid black;">		
		<table width="100%"  >
			<tr><h2 class="text-uppercase"><?=$this->dept_name?></h2>
				<td>
				<p style="text-indent:20px; font-size:12px">This registration however does not make the Registrar liable for any default/liable for any default/liability on loan from Banks, Private Societies, Govt. and Semi-Govt. Source of payment of I.T. and Sales Tax, as the case may be created by the society.</p>
				<p style="text-indent:20px; font-size:12px">Financial Institutions, Govt. and Semi-Govt. Deptts, extending financial Grants- in-aid etc. to the Society shall send copies of such sanction to the registrar for his record.</p>
				</td><table width="100%"  >
			<img src="<?=base_url('public/imgs/assam.png')?>" width="110px" height="140px" alt="Ashok"></td>			
				<td width="45%"></td>	</table>
			</tr>
		</table>
		
		<h3><b>CERTIFICATE OF REGISTRATION OF SOCIETIES ACT XXI OF 1860</b></h3>
		<br/>
		<table width="100%"  >
		
	
			<tr>
				<td>UBIN : <b><?php echo $ubin; ?></b></td>
				<td align="right">UAIN : <b><?php echo $uain; ?></b></td>				
			</tr>
		</table>
		<br/>
			<p align="left">Number of the firm on the Register: <b><?php echo strtoupper($reg_number); ?></b> of <b><?=$from_the_year?>-<?=$to_the_year?></b>.</p>
			<p align="left">Name of the Firm: <b><?php echo strtoupper($companyName); ?> (<?php echo strtoupper($companyOwner); ?>)</b>.</p>
			<p align="left">Date of Submission: <b><?php echo date('d-m-Y',strtotime($sub_date)); ?></b>.</p>
			<p align="left">valid upto: <b><?=strtoupper($valid_upto)?></b>.</p>
			
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
					<td>1</td>
					<td><b><?=date('d-m-Y',strtotime($sub_date))?></b></td>
				</tr>
			</tbody>
		</table>
		
		
		<table width="100%">
			<tr>
				<td width="50%">
					Place of issue : GUWAHATI<br/>
					Date of issue : <?php echo date("d-m-Y",strtotime($sub_date)); ?>
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
		<div>
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
