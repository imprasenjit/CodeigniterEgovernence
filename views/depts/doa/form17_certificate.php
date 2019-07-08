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
		
        $license_no = $formCertRow->license_no;
		//$valid_upto = $formCertRow->valid_upto;
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
                        
		 <div align="center" style="padding: 10px; border:2px solid black;">
						
                           <img src="<?=base_url('public/imgs/assam.png')?>" width="110px" height="140px">
                            <br/>
		<h4><b>OFFICE OF THE DIRECTORATE OF AGRICULTURE</b></h4>
		<br/>
		<table width="100%">
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
		<p align="center"><h4><b>FORM VIII<br/>LICENCE TO SELL OR EXHIBIT FOR SALE OR DISTRIBUTE INSECTICIDES, INCLUDING STOCK AND USE OF INSECTICIDES FOR COMMERCIAL PEST CONTROL OPERATIONS<br/>{See sub-rules (3A) and (4) of rule 10}</b></h4></p>
		<br/>
		<div class="col-sm-12" style="padding:0;">
			<div class="col-sm-6">
				<p align="justify">License number <?php echo strtoupper($license_no);?></p>
			</div>					
			<div class="col-sm-6 pull-right">
				<p align="right">Year - <?php echo date('Y',strtotime($sub_date));?></p>
			</div>	
		</div>
		<p style="text-indent: 14px;" align="justify">License to sell ,stock or exhibit for sale or distribute by retail the following insecticide (s) or carrying out commercial pest control operations on the premises situated at &nbsp;<?php echo strtoupper($dist);?></p>
		<p style="text-indent: 14px;" align="justify">Is granted to M/s <?php echo strtoupper($key_person);?> as specified hereunder </p>
		
	
		<table class="table table-bordered table-responsive">
		<tr align="center">
			<th  align="center">Sl. No.</th>
			<th  align="center">Particulars of the insecticide</th>
			<th  align="center">Registration number</th>
			<th  align="center">Name</th>
		</tr>
			<tbody>
											<?php
											$formRows = $this->forms_model->get_frmrows($this->dept_code, "doa_form17_t2", $form_id);
													
													if($formRows){
													  $count=1;
													  foreach($formRows as $rows){	?>
											<tr>
												<td><?=strtoupper($rows->slno);?></td>
												<td><?=strtoupper($rows->parti_insecticide);?></td>
												<td><?=strtoupper($rows->registration_no);?></td>
												<td><?=strtoupper($rows->name);?></td>
											</tr>
											<?php }
											} ?>
									</tbody>
			   
		</br>
		<p style="text-indent: 14px;" align="justify">2.The license is subject to the provisions of the Insecticides Act, 1968 and the rules made there under for time being in force as well as the conditions specified below
		
		<div class="col-sm-12" style="padding:0;">
			<div class="col-sm-6">
				<p align="justify"></p>
			</div>					
			<div class="col-sm-6 pull-right" >
				<p align="center"><?php echo strtoupper($key_person) ?><br/>Directorate of Agriculture<br/>Govt. of Assam</p>
			</div>	
		</div>
		<br/>
		<table width="100%">
			<tr>
				<td>Date : <?php echo date('d-m-Y',strtotime($sub_date)); ?></td>
				<td></td>
			</tr>
			<tr>
				<td>Place : <?php echo $dist;?></td>
				<td></td>
			</tr>
		</table>
		<br/>
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
		<br/>
		<h4><b><u>Conditions</u></b></h4>
		<div align="justify">
			<ol type="1">
				<li>The license shall be displayed in a conspicuous place in the premises.</li>
				<li>No insecticide shall be sold or exhibited for sale or distributed or issued for use in commercial pest control operations except in packages approved by the Registration Committee from time to time.</li>
				<li>If the licensee wants sell ,stock or exhibit for sale or distribute or use for commercial pest control operations any additional insecticide during the validity of the licence ,he may apply to the licensing officer for issuance of license for each such insecticide on payment of the prescribed fee.</li>
				<li>An application for the renewal of the licence for pest control operation shall be made as laid down in sub rule (3A) of rule 10 of the Insecticides Rules, 1971</li>
				<li>Any other condition (s) –may be specified by the Licensing Officer.</li>
			</ol>
		</div>
						
						<!-- copied -->
                        </div>
                    </div><!--End of .box-body--> 
                </div><!--End of .box-->                    
            </div><!--End of .content-wrapper-->
            <?php $this->load->view("staffs/requires/footer"); ?>
        </div><!-- End of .wrapper-->
    </body>
</html>