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
		$license_no = $formCertRow->lic_no;

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


$formRow = $this->forms_model->get_row($this->dept_code, $form_table, $form_id);
		
		$reg_no= $formRow->reg_no;
		$catrgories= $formRow->catrgories;
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
        <!--copied from sdc_certificate61.php-->
<div align="center" style="padding: 10px 30px;width:99%; border:2px solid black;">	
	<img src="<?=base_url('public/imgs/assam.png')?>" class="alomlogoimg" />			<br/>		<br/>
		<h4><b>STATE DRUGS CONTROL ADMINISTRATION</b></h4>
		<h4><b>FORM 20&ndash;BB</b></h4>
		<h4><b>[Rule&ndash;62&ndash;D]</b></h4>
		<h4><b>[Licence to, sell, stock or exhibit or offer for sale by Wholesale, or distribute] drugs other than those specified in Schedule C and Schedule C (1) to Drugs and Cosmetics Rules, 1945, from a motor vehicle</b></h4>
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
		<div align="justify">
			<ol>
			    <li>
			    	<b><?=strtoupper($companyName);?></b> is hereby [ licensed to sell, stock or exhibit or offer for by wholesale or distribute ] drugs other than those specified in Schedule C and Schedule C (1) from the vehicle bearing registration No <b><?=strtoupper($reg_no);?></b> assigned under Motor Vehicles Act , 1939 , subject to the conditions specified below and to the provisions of the Drugs and Cosmetics Act, 1940 and the Rules made there under.
			    </li>
			    <li>
			    	The licence unless suspended or cancelled shall remain valid perpetually. However, the compliance with the conditions of licence and the provisions of the Drugs and Cosmetics Act, 1940 (23 of 1940) and the Drugs and Cosmetics Rules, 1945 shall be assessed not less than once in three years or as needed as per risk based approach.
			    </li>
				<li>Catagories of the drugs :<br/>
				<b><?=strtoupper($catrgories);?></b></li>
			</ol>
		</div>
		<div class="col-sm-12" style="padding:0;">
			<div class="col-sm-6">
				<p align="justify"></p>
			</div>					
			<div class="col-sm-6 pull-right" >
				<p align="center"><?php echo strtoupper($sign); ?><br/>Licensing Authority</p>
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

	    <p align="center"><b><u><em>Condition of Licence</em></u></b></p>
	    <div align="justify">
	        <ol>
	            <li>The licence shall be displayed in a prominent place in a vehicle.</li>
	            <li>The licensee shall comply with the Provisions of the Drugs and Cosmetics Act , 1940 and the Rules made under for the time being in force.
                    <ol type="a">
                    	<li>No drug shall be sold by wholesale or distributed unless such drug is purchased under a cash or credit memo from a duly licensed dealer or dully licensed manufacturer.</li>
                    	<li>No sale by whole sale of distribution of any drug shall be made to a person not holding the requisite licence to sell stock or exhibit for sale or distribute the drug.</li>
                    </ol>
	            </li>
	            <li>Provided that this conditions shall not apply to the sale of any drug to:- 
                    <ol type="a">
                    	<li>
                    		An Officer or Authority purchasing on behalf of Government, or
                    	</li>
                    	<li>
                    		A hospital, medical, educational or research institution or a registered medical practioner for the purpose of supply to his patents, or 
                    	</li>
                    	<li>
                    		A manufacturer beverages , confectionary biscuits and other non medicinal products where such drugs are required for processing these products.
                    	</li>
                    </ol>
	            </li>
	            <li>The licence shall inform the Licensing Authority in writing in the event of any change in constitution of the firm operating under the licence. Where any change in the constitution of the firm takes place, the current licence shall be deemed to be valid for a maximum period of three months from the date on which the change takes place unless, in the meantime, a fresh licence has been taken from the Licensing Authority in the name of the firm with the changed constitution.</li>
	            <li>The licensee shall inform the Licensing Authority in the writing in the event of any change in ownership of the vehicle specified in this licence within seven days of such change.</li>
	        </ol>
	    </div>
	</div>	
	<br/>
	<!--copied-->
	
                        </div><!--End of .alomcertbl-->
                    </div><!--End of .box-body--> 
                </div><!--End of .box-->                    
            </div><!--End of .content-wrapper-->
            <?php $this->load->view("staffs/requires/footer"); ?>
        </div><!-- End of .wrapper-->
    </body>
</html>