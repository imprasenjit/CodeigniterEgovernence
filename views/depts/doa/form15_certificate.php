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
		$valid_upto = $formCertRow->valid_upto;
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
		<p align="center"><h4><b>FORM VI<br/>(Letterhead of the Licensing Officer)<br/>LICENCE TO MANUFACTURE INSECTICIDES<br/>[ See sub-rule (3) of rule 9]</b></h4></p>
		<br/>
		<div class="col-sm-12" style="padding:0;">
			<div class="col-sm-6">
				<p align="justify">Licence No. <?php echo strtoupper($license_no);?></p>
			</div>					
			<div class="col-sm-6 pull-right">
				<p align="right">Year - <?php echo date('Y',strtotime($sub_date));?></p>
			</div>	
		</div>
		<p style="text-indent: 14px;" align="justify">1.License to manufacture the following insecticides (s) on the premises situated at<?php echo strtoupper($address);?>(Complete address along with PIN Code)</p>
		<p style="text-indent: 14px;" align="justify">Is granted to M/s <?php echo strtoupper($key_person);?></p>
		<p style="text-indent: 14px;" align="justify">As specified hereunder:-</p>
		
		<table width="95%" align="center" class="table table-bordered table-responsive text-center" style="border-collapse: collapse" border="1">			
		<tr>
			<td colspan="2">
			
			<tr align="center">
				<th align="center">Slno</th>
				<th align="center">Particulars of the insecticide</th>
				<th align="center">Registration Number</th>
				<th  align="center">Date of grant of licence</th>
				<!--<th  align="center">Validity of licence</th>-->
			</tr>
				<tbody>
											<?php
											$formRows = $this->forms_model->get_frmrows($this->dept_code, "doa_form15_t1", $form_id);
													
													if($formRows){
													  $count=1;
													  foreach($formRows as $rows){	?>
											<tr>
												<td><?=strtoupper($rows->slno);?></td>
												<td><?=strtoupper($rows->name);?></td>
												<td><?=strtoupper($rows->reg_no);?></td>
												<td><?=strtoupper($rows->date);?></td>
											</tr>
											<?php }
											} ?>
									</tbody>
			</td>
		</tr>
		</table>
		<p style="text-indent: 14px;" align="justify">2.The insecticide (s) shall be manufactured under the direction and supervision of the following expert staff Name of insecticides and name(s) and designation of the expert staff:</p>
       <table width="70%">		
		<tr>
			
			<tr align="center">
				<th>Slno</th>
				<th>Name and Designation</th>
			</tr>
			<tbody>
			<?php
											$formRows = $this->forms_model->get_frmrows($this->dept_code, "doa_form15_t2", $form_id);
													
													if($formRows){
													  $count=1;
													  foreach($formRows as $rows){	?>
											<tr>
												<td><?=strtoupper($rows->slno);?></td>
												<td><?=strtoupper($rows->name);?></td>
												</tr>
											<?php }
											} ?>
											</tbody>
			
		</tr>
		</table>
		<br/><br/>
       <p style="text-indent: 14px;" align="justify">3. The licence is subject to such conditions as may be specified in the rules for the time being in force under the Insecticide Act, 1968 as well as the conditions stated below.</p>		
		</br>
		<div class="col-sm-12" style="padding:0;">
			<div class="col-sm-6">
				<p align="justify"></p>
			</div>					
			<div class="col-sm-6 pull-right" >
				<p align="center"><?php echo strtoupper($key_person) ?><br/>Directorate of Agriculture<br/>Govt. of Assam</p><br/><br/>
			</div>	
		</div>
	
		<table width="100%">
		    
			<tr>
				<td>Date : <?php echo date('d-m-Y',strtotime($sub_date)); ?></td>
				<td align="right">Signature of the Licensing Officer&nbsp;<?php echo strtoupper($key_person);?><br/>
               Seal</td>
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
		<p align="center"><h4><b><u>CONDITIONS</u></b></h4></p>
		<p align="justify">1. This licence shall be kept in the premises for which the licence is being issued and shall be produced for inspection as and when required by an Insecticide Inspector , licensing officer or any other officer authorised by the Government in this regard.</p>
		<p align="justify">2. Any change in the name of the expert staff ,named in the licence , shall forthwith be reported to the licensing officer.</p>
		<p align="justify">3. The licensee shall scrupulously comply with each and every condition of registration of the, insecticide ,failing which the licence of the insecticide is liable to be cancelled.</p>
		<p align="justify">4. The Licensee shall comply with the provisions of the Insecticides Act, 1968, and the rules made there under for the time being in force.</p>
		<p align="justify">5. The licence also authorizes the storage and stocking of insecticide (s) manufactured at the licensed premises, in the factory premises for sale by way of wholesale dealing by the licensee.</p>
		<p align="justify">6. The licensee shall obtain ISI Mark Certificate from Bureau of Indian Standard within three months of the commencement of the manufacture.</p>
		<p align="justify">7. No insecticide shall be sold or distributed without ISI Mark certification.</p>
		<p align="justify">8. Any other condition (s) may be specified by the licensing officer.</p>
		
						
						<!-- copied -->
                        </div>
                    </div><!--End of .box-body--> 
                </div><!--End of .box-->                    
            </div><!--End of .content-wrapper-->
            <?php $this->load->view("staffs/requires/footer"); ?>
        </div><!-- End of .wrapper-->
    </body>
</html>