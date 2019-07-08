<?php
$cafRow = $this->cafs_model->get_row($swr_id);
if($cafRow) {
    $ubin = $cafRow->ubin;
    $companyName = $cafRow->Name;
    $companyOwner = $cafRow->Name_of_owner;
    $key_person=$cafRow->Key_person;
    $street_name1=$cafRow->b_street_name1.", ".$cafRow->b_street_name2;
    $dist=$cafRow->b_dist;
    $address=$street_name1." , ".$dist;
} 
    $params['data'] = $uain;
    $params['level'] = 'H';
    $params['size'] = 10;
    $params['savename'] = 'storage/temps/qrcode.png';
    $this->ciqrcode->generate($params); 
    $formCertRow = $this->formcertifcates_model->get_row($this->dept_code, $form_table, $form_id);
if($formCertRow) {
	$lic_exp_year = $formCertRow->lic_exp_year;
    $sub_date = $formCertRow->sub_date;
    $file_auth_num = $formCertRow->file_auth_num;
    $total_fees = $formCertRow->total_fees;
    $arrear_fees_details = $formCertRow->arrear_fees_details;
    $regular_fees = $formCertRow->regular_fees;
    $penalty_charge = $formCertRow->penalty_charge;
    
   
	if($formCertRow->penalty_charge == ""){
		$penalty_charge="0.00";
	}else{
		$penalty_charge=$formCertRow->penalty_charge;
	}
    
	if($arrear_fees_details!=""){
		$arrear_fees_details=json_decode($arrear_fees_details);
		$arrear_fees_details_y1=$arrear_fees_details->y1; 
		$arrear_fees_details_y2=$arrear_fees_details->y2;
		if(isset($arrear_fees_details->fees) && !empty($arrear_fees_details->fees))  $arrear_fees_details_fees=$arrear_fees_details->fees; else $arrear_fees_details_fees=0;
	}else{
		$arrear_fees_details=0;
		$arrear_fees_details_y1=0;
		$arrear_fees_details_y2=0;
		$arrear_fees_details_fees=0;
	}
	
    
} else {
	 $auth_no= $sub_date= $total_fees= $lic_exp_year= $regular_fees= $arrear_fees_details= $penalty_charge= "Not Found!";
}
$formCertRow = $this->forms_model->get_row($this->dept_code, $form_table, $form_id);
if($formCertRow) {
    $waste_sharp_quantity = $formCertRow->waste_sharp_quantity;
    $recycl_waste_quantity = $formCertRow->recycl_waste_quantity;
    $auth_sght_string="";
        if(!empty($formCertRow->auth_sght))
        {
		$auth_sght=json_decode($formCertRow->auth_sght);
		if(isset($auth_sght->gen)){
			$auth_sght_gen=$auth_sght->gen;
			$auth_sght_string = $auth_sght_gen.", ";
		} 
		else $auth_sght_gen="";

		if(isset($auth_sght->seg)){
			$auth_sght_seg=$auth_sght->seg;
			$auth_sght_string = $auth_sght_string.$auth_sght_seg.", ";
		}
		else $auth_sght_seg="";
		
		if(isset($auth_sght->coll)){
			$auth_sght_coll=$auth_sght->coll;
			$auth_sght_string = $auth_sght_string.$auth_sght_coll.", ";
		}
		else $auth_sght_coll="";
		
		if(isset($auth_sght->store)){
			 $auth_sght_store=$auth_sght->store;
			$auth_sght_string = $auth_sght_string.$auth_sght_store.", ";
		}
		else $auth_sght_store="";
		
		if(isset($auth_sght->packg)){
			$auth_sght_packg=$auth_sght->packg;
			$auth_sght_string = $auth_sght_string.$auth_sght_packg.", ";
		} 
		else $auth_sght_packg="";
		
		if(isset($auth_sght->recept)){
			$auth_sght_recept=$auth_sght->recept;
			$auth_sght_string = $auth_sght_string.$auth_sght_recept.", ";
		} 
		else $auth_sght_recept="";
		
		if(isset($auth_sght->trans)){
			$auth_sght_trans=$auth_sght->trans;
			$auth_sght_string = $auth_sght_string.$auth_sght_trans.", ";
		} 
		else $auth_sght_trans="";
		
		if(isset($auth_sght->treat)){
			$auth_sght_treat=$auth_sght->treat;
			$auth_sght_string = $auth_sght_string.$auth_sght_treat.", ";
		} 
		else $auth_sght_treat="";
		
		if(isset($auth_sght->proc)){
			$auth_sght_proc=$auth_sght->proc;
			$auth_sght_string = $auth_sght_string.$auth_sght_proc.", ";
		} 
		else $auth_sght_proc="";
		
		if(isset($auth_sght->con)){
			$auth_sght_con=$auth_sght->con;
			$auth_sght_string = $auth_sght_string.$auth_sght_con.", ";
		} 
		else $auth_sght_con="";
		
		if(isset($auth_sght->recyle)){
			$auth_sght_recyle=$auth_sght->recyle;
			$auth_sght_string = $auth_sght_string.$auth_sght_recyle.", ";
		} 
		else $auth_sght_recyle="";
		
		if(isset($auth_sght->dispose)){
			$auth_sght_dispose=$auth_sght->dispose;
			$auth_sght_string = $auth_sght_string.$auth_sght_dispose.", ";
		} 
		else $auth_sght_dispose="";
		
		if(isset($auth_sght->destruct)){
			$auth_sght_destruct=$auth_sght->destruct;
			$auth_sght_string = $auth_sght_string.$auth_sght_destruct.", ";
		} 
		else $auth_sght_destruct="";
		
		if(isset($auth_sght->uses)){
			$auth_sght_uses=$auth_sght->uses;
			$auth_sght_string = $auth_sght_string.$auth_sght_uses.", ";
		} 
		else $auth_sght_uses="";
		
		if(isset($auth_sght->sale)){
			$auth_sght_sale=$auth_sght->sale;
			$auth_sght_string = $auth_sght_string.$auth_sght_sale.", ";
		} 
		else $auth_sght_sale="";
		
		if(isset($auth_sght->transfer)){
			$auth_sght_transfer=$auth_sght->transfer;
			$auth_sght_string = $auth_sght_string.$auth_sght_transfer.", ";
		} 
		else $auth_sght_transfer="";
		
		if(isset($auth_sght->other)){
			$auth_sght_other=$auth_sght->other;
			$auth_sght_string = $auth_sght_string.$auth_sght_other;
		} 
		else $auth_sght_transfer="";
	}
	else
	{
		$auth_sght_gen="";$auth_sght_seg="";$auth_sght_coll="";$auth_sght_store="";$auth_sght_packg="";$auth_sght_recept="";$auth_sght_trans="";$auth_sght_treat="";$auth_sght_proc="";$auth_sght_con="";$auth_sght_recyle="";$auth_sght_dispose="";$auth_sght_destruct="";$auth_sght_uses="";$auth_sght_sale="";$auth_sght_transfer="";$auth_sght_other="";$auth_sght_string="";
	}
    $auth_sght_string = rtrim($auth_sght_string,", ");
    if(!empty($formCertRow->hcf))
	{
		$hcf=json_decode($formCertRow->hcf);
		$hcf_num_bed=$hcf->num_bed;$hcf_pt=$hcf->pt;$hcf_fac=$hcf->fac;
	}
	else
	{
		$hcf_num_bed="";$hcf_pt="";$hcf_fac="";
	}
    if(!empty($row["cbmwtf"]))
	{
		$cbmwtf=json_decode($row["cbmwtf"]);
		$cbmwtf_num_bed=$cbmwtf->num_bed;$cbmwtf_capacity=$cbmwtf->capacity;$cbmwtf_quantity=$cbmwtf->quantity;$cbmwtf_area=$cbmwtf->area;
	}
	else
	{
		$cbmwtf_num_bed="";$cbmwtf_capacity="";$cbmwtf_quantity="";$cbmwtf_area="";
	}
     if(!empty($formCertRow->yellow_qnt)){
		$yellow_qnt=json_decode($formCertRow->yellow_qnt);
		$yellow_qnt_haw=$yellow_qnt->haw;$yellow_qnt_aaw=$yellow_qnt->aaw;$yellow_qnt_sw=$yellow_qnt->sw;$yellow_qnt_edm=$yellow_qnt->edm;$yellow_qnt_csw=$yellow_qnt->csw;$yellow_qnt_clw=$yellow_qnt->clw;$yellow_qnt_discard=$yellow_qnt->discard;$yellow_qnt_microb=$yellow_qnt->microb;
	}else{
		$yellow_qnt_haw="";$yellow_qnt_aaw="";$yellow_qnt_sw="";$yellow_qnt_edm="";$yellow_qnt_csw="";$yellow_qnt_clw="";$yellow_qnt_discard="";$yellow_qnt_microb="";
	}
    if(!empty($formCertRow->blue_qnt)){
		$blue_qnt=json_decode($formCertRow->blue_qnt);
		$blue_qnt_glas=$blue_qnt->glas;$blue_qnt_metal=$blue_qnt->metal;
	}else{
		$blue_qnt_glas="";$blue_qnt_metal="";
	}
}
    
$formCertRow = $this->formprocess_model->get_row($this->dept_code, $form_table, $form_id);
if($formCertRow) {
	$issue_date = $formCertRow->p_date;
	
} else {
	$issue_date= "Not Found!";
}
//End of if ?>
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
                        <!--<a href="<?=base_url('staffs/certificates/getpdf/'.$uain)?>" class="btn btn-info backbtn-alm" target="_blank">
                            <i class="fa fa-file-pdf-o"></i> Download
                        </a>-->
                        <button class="btn btn-warning backbtn-alm printbtn">
                            <i class="fa fa-print"></i> Print
                        </button>
                    </h3><!--End of .boxalm-head-->
                    <div class="box-body">
                         <table class="alomcertbl printcontent">
                            <thead>
                                <tr>
                                    <th>
                                        <img style="height:100px; width:100px; margin: " src="<?=base_url('public/imgs/assam.png')?>"/> <br/>
                                    </th>
                                    
                                    <th style="text-align: center;">
                                         <strong style="font-size: 30px;">Pollution Control Board</strong><br/>  
                                        <h4>Assam</h4>
                                    </th>
                                    
                                </tr>
                                <tr>
                                        <th colspan="2"><hr></th>
                                </tr>
                              
                            </thead>
                            <tbody>
                              <tr>
                                <td colspan="3" style="padding: 10px 30px;">
                                <table width="90%" align="center">
                                <tr>
                                    <td>UBIN : <b><?php echo $ubin; ?></b></td>
                                    <td align="right">UAIN : <b><?php echo $uain; ?></b></td>
                                    
                                </tr>
                                <tr>
                                    <td></td>
                                    <td align="right"><?php if($total_fees!=""){?>Fees Paid : <b><?php echo "Rs. ".$total_fees; ?><?php }?></b></td>
                                </tr>
                            </table>
                            <h2 class="stl_line" style="padding-bottom:10px;font-family:fontdatafan;text-align:center;">
                                <u>"AUTHORIZATION FOR HANDLING BIOMEDICAL WASTE UNDER THE BIO MEDICAL WASTE MANAGEMENT RULES"</u>
                            </h2>
                        <div style="text-align:justify;padding-left:5%;padding-bottom:20px;padding-right:5%;padding-top:20px;">
                            <ol>
                                <li>File number of authorisation : <?=strtoupper($file_auth_num);?></li>
                                <li>M/s <?=strtoupper($key_person);?> an occupier or operator of the facility located at <?=strtoupper($dist)?> is hereby granted an authorisation for :<br/><?=strtoupper($auth_sght_string);?></li>
                                <li>M/s <?=strtoupper($key_person);?> is hereby authorized for handling of biomedical waste as per the capacity given below :<br/>
                                    <ol type="i">
                                        <li>Number of beds of HCF : <?=strtoupper($hcf_num_bed);?></li>
                                        <li>Number healthcare facilities covered by CBMWTF : <?=strtoupper($hcf_fac);?></li>
                                        <li>Installed treatment and disposal capacity(Kg per day) : <?=strtoupper($cbmwtf_capacity);?></li>
                                        <li>Area or distance covered by CBMWTF : <?=strtoupper($cbmwtf_area);?></li>
                                        <li>Quantity of Biomedical waste handled, treated or disposed : <?=strtoupper($cbmwtf_quantity);?></li>
                                    </ol>
                                    <br/>
                                    <table width="100%" align="center" style="margin:0px auto;border-collapse: collapse" border="1">
                                        <thead>
                                          <tr>
                                            <th width="25%">Category</th>
                                            <th width="25%">Type of Waste</th>
                                            <th width="25%">Quantity permitted for Handling</th>
                                          </tr>
                                          <tr>
                                            <th width="25%">(1)</th>
                                            <th width="25%">(2)</th>
                                            <th width="25%">(3)</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td rowspan="8" width="25%" valign="top">Yellow</td>
                                                <td width="25%">(a) Human Anatomical Waste </td>
                                                <td width="25%"><?=strtoupper($yellow_qnt_haw);?></td>
                                            </tr>
                                            <tr>
                                                <td width="25%">(b) Animal Anatomical Waste </td>
                                                <td width="25%"><?=strtoupper($yellow_qnt_aaw);?></td>
                                            </tr>
                                            <tr>
                                                <td width="25%">(c) Soiled Waste </td>
                                                <td width="25%"><?=strtoupper($yellow_qnt_sw);?></td>
                                            </tr>
                                            <tr>
                                                <td width="25%">(d) Expired or Discarded Medicines </td>
                                                <td width="25%"><?=strtoupper($yellow_qnt_edm);?></td>
                                            </tr>
                                            <tr>
                                                <td width="25%">(e) Chemical Solid Waste </td>
                                                <td width="25%"><?=strtoupper($yellow_qnt_csw);?></td>
                                            </tr>
                                            <tr>
                                                <td width="25%">(f) Chemical Liquid Waste </td>
                                                <td width="25%"><?=strtoupper($yellow_qnt_clw);?></td>
                                            </tr>
                                            <tr>
                                                <td width="25%">(g) Discarded linen, mattresses, beddings contaminated with blood or body fluid </td>
                                                <td width="25%"><?=strtoupper($yellow_qnt_discard);?></td>
                                            </tr>
                                            <tr>
                                                <td width="25%">(h) Microbiology, Biotechnology and other clinical laboratory waste </td>
                                                <td width="25%"><?=strtoupper($yellow_qnt_microb);?></td>
                                            </tr>
                                            <tr>
                                                <td width="25%">Red</td>
                                                <td width="25%">Contaminated Waste (Recyclable) </td>
                                                <td width="25%"><?=strtoupper($recycl_waste_quantity);?></td>
                                            </tr>
                                            <tr>
                                                <td width="25%">White (Translucent)</td>
                                                <td width="25%">Waste sharps including Metals </td>
                                                <td width="25%"><?=strtoupper($waste_sharp_quantity);?></td>
                                            <tr>
                                                <td rowspan="2" width="25%">Blue</td>
                                                <td width="25%">Glassware </td>
                                                <td width="25%"><?=strtoupper($blue_qnt_glas);?></td>
                                            </tr>
                                            <tr>
                                                <td width="25%">Metallic Body Implants </td>
                                                <td width="25%"><?=strtoupper($blue_qnt_metal);?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <br/>
                                </li>
                                <li>This authorisation shall be in force for a period of 1 Years from the date of issue.</li>
                                <li>This authorisation is subject to the conditions stated below and to such other conditions as may be specified in the rules for the time being in force under the Environment (Protection) Act, 1986.</li>
                            </ol>
                        </div>
                        <br/><br/>
                        <table align="center" style="width:99%;font-family:sanserif;">
                                <tr>
                                    <td style="width:50%;padding-left:40px;">Place : Guwahati<br/>Date : <?php echo date("d-m-Y",strtotime($issue_date)); ?></td>
                                    <td style="width:50%;padding-right:40px;text-align:right;"><?php echo strtoupper($companyOwner) ?><br/><br/>Authorized Signatory</td>
                                </tr>                    
                        </table>
                        <br/>
                        <div class="row" style="padding-left:5%;padding-bottom:20px;">
                            <?php if($total_fees!=""){?>
                            <div style="width:70%;position:relative;float:left;text-align:left">
                                <span class="details" style="padding-bottom:5px"><u>Details of Fees Paid</u></span>
                                <p style="margin-top:5px;font-family:sans-serif;font-size:14px;">
                                    1. Regular Fees for the year<?php echo $lic_exp_year; ?> : Rs. <?php echo $regular_fees; ?>.00</p>
                                <p style="margin-top:5px;font-family:sans-serif;font-size:14px;">
                                    2. Arrear Fees for the year<?php echo $arrear_fees_details_y1." - ".substr( $arrear_fees_details_y2, -2 );?> : Rs. <?php echo $arrear_fees_details_fees; ?>.00</p>
                                <p style="margin-top:5px;font-family:sans-serif;font-size:14px;">
                                    3. Penalty/other charges : Rs.<?php echo $penalty_charge; ?>.00</p>
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
                        <br/><br/>
                        <div style="clear:both"></div>
                    
                        <div class="row" style="padding-left:5%;padding-bottom:20px;padding-right:5%;padding-top:20px;">	
                             <h3 align="center"><u>Terms and Conditions of Authorisation *</u></h3>
                                <div style="text-align:justify;">
                                    <ol>
                                        <li>The authorisation shall comply with the provisions of the Environment (Protection) Act, 1986 and the rules made there under.</li>
                                        <li>The authorisation or its renewal shall be produced for inspection at the request of an officer authorised by the prescribed authority.</li>
                                        <li>The person authorized shall not rent, lend, sell, transfer or otherwise transport the biomedical wastes without obtaining prior permission of the prescribed authority.</li>
                                        <li>Any unauthorised change in personnel, equipment or working conditions as mentioned in the application by the person authorised shall constitute a breach of his authorisation.</li>
                                        <li>It is the duty of the authorised person to take prior permission of the prescribed authority to close down the facility and such other terms and conditions may be stipulated by the prescribed authority.</li>
                                    </ol>
                                </div>
                        </div>
                        <br/><br/>
                            <div style="clear:both"></div>
                           <br/><br/>
                                    <div style="clear:both"></div>
                                     
                                     </td>
                               </tr>
                            </tbody>
                        </table>
                       
                    </div><!--End of .box-body--> 
                </div><!--End of .box-->                    
            </div><!--End of .content-wrapper-->
            <?php $this->load->view("staffs/requires/footer"); ?>
        </div><!-- End of .wrapper-->
     
       

    </body>
</html>
