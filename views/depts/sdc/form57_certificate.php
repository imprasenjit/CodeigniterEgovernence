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
		
		$drug_name = $formRow->drug_name;
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
<!--copied from sdc_certificate57.php-->
<div align="center" style="padding: 10px 30px;width:99%; border:2px solid black;">	
	<img src="<?=base_url('public/imgs/assam.png')?>" class="alomlogoimg" />		<br/>
		<h4><b>STATE DRUGS CONTROL ADMINISTRATION</b></h4>
		<h4><b>FORM 28&ndash;D</b></h4>
		<h4><b>[See Rule 76]</b></h4>
		<h4><b><em>Licence to manufacture for sale or for distribution of Large Volume Parenterals / Sera and Vaccines specified in Schedule C and C-1 excluding those specified in Schedule X.</em></b></h4>
		<br/>
		<table width="100%">
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
			    <li>
			        Number of licence <b><?=strtoupper($license_no);?></b> and Date of issue <b><?=date('d-m-Y',strtotime($issue_date)); ?></b>
			    </li>
			    <li>
			        M/S <b><?=strtoupper($companyName);?></b> is hereby licensed to manufacture at the premises    situated at <b><?=strtoupper($address);?></b>. The following large Volume Parenterals / Sera and Vaccines specified in Schedule C and C (1) excluding those specified in Schedule X to the Drugs and Cosmetics Rules, 1945.
			    </li>
			    <li>
			    	Name(s) of Drugs (s) Large Volume Parenterals (LVP) :- <b><?=strtoupper($drug_name);?></b> 
			    </li>
			    <li>Name (s) of competent technical staff 
			    	<ol type="a">
			    		<li>
			    			<table>
			            <thead class="table table-responsive" width="100%">
					        <tr>
					        	<th width="50%">Sl No.</th>
					        	<th width="50%">Name</th>
					        </tr>
				        </thead>
				        <tbody>
			    	    <?php
							$personalized_array = array("form_id"=>$form_id);
								$forms_t1_Row = $this->forms_model->get_personalized_rows($this->dept_code, $form_table."_t1", $personalized_array);
								$sl=1;
								if($forms_t1_Row){
									foreach($forms_t1_Row as $rows){ 
									if($rows->responsible == "M"){
									
										?> 
										<tr>
											<td><?=strtoupper($sl);?></td>
											<td><?=strtoupper($rows->name);?></td>
										</tr>
										<?php $sl++;
										}
									}
								} 
								?>
			    	    </tbody>
	    	        </table>
			    		</li>
			    		<li>
			    			<table>
		                    <thead class="table table-responsive" width="100%">
					            <tr>
					        	    <th width="50%">Sl No.</th>
					        	    <th width="50%">Name</th>
					            </tr>
				            </thead>
				            <tbody>
			    	       <?php
							$sl=1;
								if($forms_t1_Row){
									foreach($forms_t1_Row as $rows){ 
										if($rows->responsible == "T"){
										
											?> 
											<tr>
												<td><?=strtoupper($sl);?></td>
												<td><?=strtoupper($rows->name);?></td>
											</tr>
											<?php $sl++;
											}
									}
								} 
								?>
			    	        </tbody>
	    	                </table>
			    		</li>
			    	</ol>
			    </li>
			    <li>
			    	The licence authorizes the sale by way of wholesale dealing and storage of sale by the licensee of the drugs manufactured under the licence, subject to the conditions applicable to licence for sale.
			    </li>
	        	<li>
	        		The licence unless suspended or cancelled shall remain valid perpetually. However, the compliance with the conditions of licence and the provisions of the Drugs and Cosmetics Act, 1940 (23 of 1940) and the Drugs and Cosmetics Rules, 1945 shall be assessed not less than once in three years or as needed as per risk based approach.
	        	</li>
			    <li>
			    	The licence shall be subject to the conditions stated below and to such other conditions as shall be specified in the Rules for the time being in force under Drugs and Cosmetics Act, 1940. 
			    </li>
			</ol>
		</div>
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
		           <img src="<?=base_url('storage/temps/qrcode.png')?>" style="width: 120px; height: 120px" <?php echo encodeme($uain); ?> />
			</div>
		</div>
	    <p align="center"><b><u>Condition of Licence</u></b></p>
	    <div align="justify">
	        <ol>
	           <li>The licence and any certificate of renewal in force shall be kept on the approved premises and shall be produced at the request of an inspector appointed under the Drugs and Cosmetics Act, 1940.</li>
	           <li>If the licensee wishes to undertake during the currency of the licence to manufacture any drug specified in Schedule C and/ or C (1) excluding those specified in schedule X not included above, he should apply to the Licensing Authority and / or Central Licence Approving Authority for the necessary endorsement as provided in the Rules. The licence shall be deemed to extend to the items endorsed.</li> 	           
	           <li>Any change in the competent technical staff named in the licence shall be forthwith reported to the licensing Authority and / or Central Licence Approving Authority.</li>
	           <li>The licensee shall inform the Licensing Authority and / or Central Licence Approving Authority in writing in the event of any change in the constitution of the firm operating under the licence. Where any change in the constitution of the firm takes place, the current licence shall be deemed to be valid for a maximum period of three months from the date on which the change takes place unless, in the meantime, afresh licence has been applied for along with prescribed fee and necessary documents to the Licensing Authority and / or Central Licence Approving Authority in the name of the firm with Changed constitution]</li>
	        </ol>
	    </div>
	
	<!--copied-->
                        </div><!--End of .alomcertbl-->
                    </div><!--End of .box-body--> 
                </div><!--End of .box-->                    
            </div><!--End of .content-wrapper-->
            <?php $this->load->view("staffs/requires/footer"); ?>
        </div><!-- End of .wrapper-->
    </body>
</html>