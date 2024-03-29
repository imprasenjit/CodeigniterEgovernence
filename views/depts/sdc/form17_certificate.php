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
		$lic_no = $formCertRow->lic_no;

		$valid_upto = $formCertRow->valid_upto;

				
		if($formCertRow->lic_no == "")
			{
				$license_no=" ";
			}
		else
		{
		$license_no=$formCertRow->lic_no;
		}
	
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
	
	
	$formProcessRow = $this->formprocess_model->get_issue_row($this->dept_code, $form_table, $form_id);
if($formProcessRow) {
	$issue_date = $formProcessRow->p_date;
	$issuing_officer_id = $formProcessRow->user_id;
	$user_row = $this->deptusers_model->get_row($issuing_officer_id, $this->dept_code);
	$sign = $user_row->user_name;
} else {
	$issue_date= "Not Found!";
	$issuing_officer_id= "";
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
                        <a href="<?=base_url('staffs/certificates/getpdf/'.encodeme($uain))?>" class="btn btn-info backbtn-alm" target="_blank">
                            <i class="fa fa-file-pdf-o"></i> Download
                        </a>
                        <button class="btn btn-warning backbtn-alm printbtn">
                            <i class="fa fa-print"></i> Print
                        </button>
                    </h3><!--End of .boxalm-head-->
                    <div class="box-body">
                        <div class="alomcertbl printcontent">
  <!-- copied contents from sdc_form17.php -->
<div align="center" style="padding: 10px 20px;width:99%; border:2px solid black;">	

		<img src="<?=base_url('public/imgs/assam.png')?>" class="alomlogoimg" />		<br/>		<br/>
		<h4><b>STATE DRUGS CONTROL ADMINISTRATION</b></h4>
		<h4><b>[FORM 28&ndash;C]</b></h4>
		<h4><b>[122-G]</b></h4>
		<h4><b>LICENCE TO OPERATE BLOOD BANK FOR COLLECTION, STORAGE AND PROCESSING OF WHOLE HUMAN BLOOD AND/OR*ITS COMPONENTS FOR SALE OR DISTRIBUTION</b></h4>
		<br/>
		<table width="100%"  >
			<tr>
				<td>UBIN : <b><?php echo $ubin; ?></b></td>
				<td align="right">UAIN : <b><?php echo $uain; ?></b></td>
			</tr>
			<tr>
				<td></td>
				<td align="right"><?php if($total_fees!=""){?>Fees Paid : <b><?php echo "Rs. ".$total_fees; ?><?php }?></td>
			</tr>
		</table>
		<br/>
		<div align="justify">
			<ol>
			    <li>Number of licence <b><?=strtoupper($lic_no); ?></b> Date of issue <b><?=date('d-m-Y',strtotime($issue_date)); ?></b> at the premises situated at <b><?=strtoupper($address); ?></b>
			    </li>
			    <li>M/S <b><?=strtoupper($companyName); ?></b> is hereby licensed to collect , store , process and distribute whole blood and / or components.</li>
			    <li>Name (s) of the items (s) <br/>                    
                    <table width="100%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
	                    <tr>
		                    <td >Sl No </td>
		                    <td > Name </td>			
	                    </tr>
	                   <?php 
						$personalized_array = array("form_id"=>$form_id);
						$forms_t1_Row = $this->forms_model->get_personalized_rows($this->dept_code, $form_table."_t1", $personalized_array);
						$sl=1;
						if($forms_t1_Row){
							foreach($forms_t1_Row as $rows){ ?>
							<tr >
								<td><?=strtoupper($sl);?></td>
								<td><?=strtoupper($rows->name);?></td>
							</tr>
							<?php 
								$sl++;
							} 
						} 
						?>
                    </table>
			    </li>
			    <li>Name (s) of the competent technical staff :
                    <table width="100%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
	                    <tr>
		                    <td >Sl No </td>
		                    <td > Name </td>			
	                    </tr>
	                    <?php 
						$personalized_array = array("form_id"=>$form_id);
						$forms_t2_Row = $this->forms_model->get_personalized_rows($this->dept_code, $form_table."_t2", $personalized_array);
						$sl=1;
						if($forms_t2_Row){
							foreach($forms_t2_Row as $rows){ ?>
							<tr >
								<td><?=strtoupper($sl);?></td>
								<td><?=strtoupper($rows->name);?></td>
							</tr>
							<?php 
								$sl++;
							} 
						} 
						?>
                    </table>
                </li>
                <li>The licence authorizes licensee to collect, store, distribute and processing of whole blood and/ or blood components subject to the conditions applicable to this licence.</li>
             	<li>The licence shall remain in force from <b><?=date('d-m-Y',strtotime($issue_date)); ?></b> to <b><?=date('d-m-Y',strtotime($valid_upto)); ?></b></li>
                <li>The licence shall be subject to the conditions stated below and to such other conditions as may be specified from time to time in the Rules made under the Drugs and Cosmetics Act, 1940.</li>
			</ol>
		</div>
		<br/>
		<div class="col-sm-12" style="padding:0;">
			<div class="col-sm-6">
				<p align="justify"></p>
			</div>					
			<div class="col-sm-6 pull-right" >
				<p align="center"><?php echo strtoupper($sign); ?><br/>Central Licence Approving Authority</p>
			</div>	
		</div>
		<br/>
		<table width="100%">
			<tr>
				<td>Date : <?php echo date('d-m-Y',strtotime($issue_date)); ?></td>
				<td></td>
			</tr>
			<tr>
				<td>Place : <?php echo $dist;?></td>
				<td></td>
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
           <img src="<?=base_url('storage/temps/qrcode.png')?>" style="width: 120px; height: 120px">
			</div>
		</div>
		<p align="center"><b><u>Conditions of Licence</u></b></p>
		<div align="justify">
		    <ol>
		    	<li>The Licensee shall neither collect blood from any professional donor paid donor nor shall the prepare the prepare blood components from the blood collected from the donor.</li>
		    	<li>The licence and any certificate or renewal in force shall be displayed on the approved premises and the original shall be produced at the request of an Inspector appointed under the drugs and cosmetics Act, 1940.</li>
		    	<li>Any change in the technical staff shall be forthwith reported to the Licensing Authority and / of Central Licence Approving Authority.</li>
		    	<li>The licensee shall inform the Licensing Authority and / or Central Licence Approving Authority writing in the event of any change in the constitution of the firm operating under the licence. Where any change in the constitution of the firm takes place, the current licence shall be deemed to valid for maximum period of three months from the date on which the change has taken place unless, in the mean time a licence has been taken from the Licensing Authority and / or Central Licence Approving Authority in the name of the firm with changed constitution.</li>
		    </ol>
		</div>
	
  
  <!-- copied contents from sdc_form17.php -->
							</div>
  
                        </div><!--End of .alomcertbl-->
                    </div><!--End of .box-body--> 
                </div><!--End of .box-->                    
            </div><!--End of .content-wrapper-->
            <?php $this->load->view("staffs/requires/footer"); ?>
        </div><!-- End of .wrapper-->
    </body>
</html>