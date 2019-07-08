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
		$sub_date= $formCertRow->sub_date;
		$seeds_detail = $formCertRow->seeds_detail;
	   
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
			
		</table>
		<br/>
		<p align="center"><h4><b>FORM 'C' (Refer Clause 7)<br/>RENEWAL OF SEED DEALER LICENSE</b></h4></p>
		<br/>

		<p style="text-indent: 14px;" align="justify">Certified that the License bearing No. <b><?php echo strtoupper($license_no);?></b>, <b><?php echo strtoupper($key_person);?></b> granted on <b><?php echo date('d-m-Y',strtotime($sub_date)); ?></b> to carry on the business of a dealer in seeds at the premises situated <b><?php echo strtoupper($address);?></b> is hereby renewed upto <b><?php echo date('d-m-Y',strtotime($valid_upto)); ?></b> i.e, w.e.f. <b><?php echo date('d-m-Y',strtotime($sub_date)); ?></b> to <b><?php echo date('d-m-Y',strtotime($valid_upto)); ?></b> unless previously cancelled or suspended under the provisions of the Seeds (Control) Order, 1983.</p>
		</br>	   
		
		<p align="justify"><b>LIST OF SEEDS TO BE DEALT STATED BELOW:</b><br/><br/><?php echo strtoupper($seeds_detail);?></p>
		</br><br/>
		<table width="100%">
			<tr>
				<td width="50%">
					Renewal No. : <b><?php echo strtoupper($license_no); ?></b><br/>
					Date of issue : <b><?php echo date("d-m-Y",strtotime($sub_date)); ?></b>
				</td>
				<td><p align="center"><?php echo strtoupper($companyOwner) ?><br/>Licensing Authority for the State of Assam<br/>Directorate of Agriculture<br/>Govt. of Assam</p></td>
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
				<img src="<?=base_url('storage/temps/qrcode.png')?>?d=<?php echo $uain; ?>" style="width: 120px; height: 120px"/>
			</div>
		</div>
		<br/>
		<h4><b><u>Terms and Conditions of Licence:</u></b></h4>
		<div align="justify">
			<ol type="i">
				<li>The Licence shall be displayed at a prominent compicuous place in a part of the business premises open to the public.</li>
				<li>The holder of the licence shall comply with the provisions of the Seeds (Control) order, 1983 and the notification issued there under and for the time being in force.</li>
				<li>This licence comes into force with immediate effect and shall be valid up to&nbsp;<?=date('d-m-Y',strtotime($valid_upto)); ?>&nbsp;unless previously cancelled or suspended.</li>
				<li>The holder of the licence shall from time to time report to the licensing authority any change in the premises where he carries on his business of sale. Export, import or storage for the said purpose seeds.</li>
				<li>The licence shall give every facility to the licensing authority or any other officer acting under his authority for the purpose of inspecting his stock in any shop, depot or Godown or the place/ places used by him for the purpose of storage, sale or export of seeds.</li>
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