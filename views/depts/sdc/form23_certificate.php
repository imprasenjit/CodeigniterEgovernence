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
		
	//	$homoeopathic = $formRow->homoeopathic;
		$crude_drugs = $formRow->crude_drugs;

		$mech_cont = $formRow->mech_cont;
		$sur_dressing = $formRow->sur_dressing;
		$chromatography = $formRow->chromatography;
		$disinfectants = $formRow->disinfectants;
		$other_drugs = $formRow->other_drugs;
		$antibiotics = $formRow->antibiotics;
		$vitamins = $formRow->vitamins;
		$parental = $formRow->parental;
		$suture = $formRow->suture;
		$test_animal = $formRow->test_animal;
		$microbiological = $formRow->microbiological;
		$photometer = $formRow->photometer;
		$homoeopathic = $formRow->homoeopathic;
		$cosmetics = $formRow->cosmetics;
		$products = $formRow->products;

		$drugs = $formRow->drugs;


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
						<!-- copied codes from sdc_form23_certificate_print.php -->
						
	<div align="center" style="padding: 10px 20px;width:99%; border:2px solid black;">	

		<img src="<?=base_url('public/imgs/assam.png')?>" class="alomlogoimg" />		<br/>
		<br/>
		<h4><b>STATE DRUGS CONTROL ADMINISTRATION</b></h4>
		<h4><b>FORM 37</b></h4>
		<h4><b>[Rule 150&ndash;C]</b></h4>
		<h4><b>Approval for carrying out tests on Drugs/Cosmetics and Raw Materials used in their manufacture on behalf of licensees for manufacture for sale of Drugs/ Cosmetics.</b></h4>
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
		<p align="justify">Number of licence and date of issue: <b><?=strtoupper($license_no); ?></b>, <b><?=date('d-m-Y',strtotime($issue_date)); ?></b></p>
		<div align="justify">
			<ol>
			    <li>Approval is hereby granted to <b><?=strtoupper($companyName); ?></b> for carrying out tests for identity, purity, quality and strength on the following catagories of drugs/item of cosmetics and the raw materials used in the manufacture thereof on the premises situated at <b><?=strtoupper($address); ?></b><br/>
                Catagories of drugs/items of cosmetics.
                    <ol type="a">
                    	<li>Drugs other than those specified in Schedules C and C(1)  and also excluding Homoeopathic Drugs  :<br/>
                            <ol type="i">
                            	<li>
                            		Crude vegetable drugs. : <b><?=strtoupper($crude_drugs); ?></b>
                            	</li>
                            	<li>
                            		Mechanical contraceptives : <b><?=strtoupper($mech_cont); ?></b>
                            	</li>
                            	<li>
                            		Surgical dressings : <b><?=strtoupper($sur_dressing); ?></b>
                            	</li>
                            	<li>
                            		Drugs requiring the use ultraviolet/Intra Red Spectro- photometer or Chromatography : <b><?=strtoupper($chromatography); ?></b>
                            	</li>
                            	<li>
                            		Disinfectants : <b><?=strtoupper($disinfectants); ?></b>
                            	</li>
                            	<li>
                            		Other drugs : <b><?=strtoupper($other_drugs); ?></b>
                            	</li>
                            </ol>
                    	</li>
                    	<li>Drugs specified in Schedules C and C(1)
                    		<ol type="i">
                    			<li>
                    				Sera, Vaccines, Antigens, Toxins, Antitoxins, Toxoids, Bacteriophages and similar Immunological Products. : <b><?=strtoupper($products); ?></b>
                    			</li>
                    			<li>
                    				Antibiotics : <b><?=strtoupper($antibiotics); ?></b>
                    			</li>
                    			<li>
                    				Vitamins : <b><?=strtoupper($vitamins); ?></b>
                    			</li>
                    			<li>
                    				Parenteral preparations : <b><?=strtoupper($parental); ?></b>
                    			</li>
                    			<li>
                    				Sterilised surgical ligature/suture : <b><?=strtoupper($suture); ?></b>
                    			</li>
                    			<li>
                    				Drugs requiring the use of animals for the test : <b><?=strtoupper($test_animal); ?></b>
                    			</li>
                    			<li>
                    				Drugs requiring microbiological tests. : <b><?=strtoupper($microbiological); ?></b>
                    			</li>
                    			<li>
                    				Drugs requiring the use of Ultraviolet/Infra Red Spectro-photometer or Chromatography : <b><?=strtoupper($photometer); ?></b>
                    			</li>
                    			<li>
                    				Other drugs : <b><?=strtoupper($drugs); ?></b>
                    			</li>
                    		</ol>
                    	</li>
                    	<li>
                    		Homoeopathic drugs. : <b><?=strtoupper($homoeopathic); ?></b>
                    	</li>
                    	<li>
                    		Cosmetics. : <b><?=strtoupper($cosmetics); ?></b>
                    	</li>
                    </ol>
			    </li>
			    <li>Names of approved [Competant Technical Staff] employed fot testing and the person-in-charge of testing.
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
             	<li>The licence unless sooner suspended or cancelled, shall remain valid perpetually. However, the compliance with the conditions of licence and the provisions of the Drugs and Cosmetics Act, 1940 (23 of 1940) and the Drug and Cosmetics Rules, 1945 shall be assessed not less than once in three years or as needed as per risk based approach.
                </li>
                <li>The approval is subject to the conditions started below and to such other conditions as may be specified in the Rules for the time being in force under the Act.</li>
			</ol>
		</div>
		<br/>
		<div class="col-sm-12" style="padding:0;">
			<div class="col-sm-6">
				<p align="justify"></p>
			</div>					
			<div class="col-sm-6 pull-right" >
				<p align="center"><?php echo strtoupper($sign); ?><br/>Licensing Authority / <br/>Central Licence Approving Authority</p>
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
		<p align="center"><b>[Conditions of Licence]</b></p>
		<div align="justify">
		    <ol>
		        <li>
		        	This approval and any certificate of renewal in Form 38 shall be kept in the approved premises and shall be produced at the request of the Inspector appointed under the Act.
		        </li>
		        <li>
		        	If the approved institution wishes to under take during the currency of the approval the approving authority for necessary endorsment as provided in the Rule 150&ndash;B. This approval will be deemed to extend to the items so endorsed.
		        </li>
		        <li>
		        	Any change in the analytical staff or in the person-in charge of the testing shall be forthwith reported to the approving authority.
		        </li>
		        <li>
		        	The approved institution shall inform the approving authority in writing in the event of any change of constitution of the institution operating under this Form. Where any change in the constitution of the institution take place, the current approved shall be deemed to be valid for a maximum period of three months from the date on which the changes take place unless in the meantime, a fresh approval ha been taken from the approving authority in the name of the institution with the changed constitution.
		        </li>
		    </ol>
		</div>
						
						
						
						<!-- copied codes from sdc_form23_certificate_print.php -->
</div>		
           
                        </div><!--End of .alomcertbl-->
                    </div><!--End of .box-body--> 
                </div><!--End of .box-->                    
            </div><!--End of .content-wrapper-->
            <?php $this->load->view("staffs/requires/footer"); ?>
        </div><!-- End of .wrapper-->
    </body>
</html>