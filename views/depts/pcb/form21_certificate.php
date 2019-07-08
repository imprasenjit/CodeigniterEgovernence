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
    $auth_no = $formCertRow->file_no;
    $valid_upto = $formCertRow->valid_upto;
    $e_quantity = $formCertRow->e_quantity;
    $e_nature = $formCertRow->e_nature;
    $e_manner = $formCertRow->e_manner;
    $e_treated_at = $formCertRow->e_treated_at;
    $total_fees = $formCertRow->total_fees;
    $arrear_fees_details = $formCertRow->arrear_fees_details;
    $regular_fees = $formCertRow->regular_fees;
    $penalty_charge = $formCertRow->penalty_charge;
	$term = $formCertRow->term;
	$auth_details = json_decode($formCertRow->auth_details);
    
	
	
	
	if($formCertRow->term == ""){
		$term="0.00";
	}else{
		$term=$formCertRow->term;
	}
	
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
	 $auth_no= $valid_upto= $e_quantity= $e_nature= $e_manner= $e_treated_at= $sub_date= $total_fees= $lic_exp_year= $regular_fees= $arrear_fees_details= $penalty_charge= "Not Found!";
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
                        <div class="alomcertbl printcontent">
                             <div id="header">
                                    <div style="font-family:lucidacalligraphy">
									<div style = "text-align:center">
                                        <img src="<?=base_url('public/imgs/assam.png')?>" width="110px" height="140px">
										</div>
                                        <h1 align="left" style="margin-top:10px;padding-left:190px">Pollution Control Board</h1>
                                        <h1 align="left" style="padding-left:300px">Assam</h1>
                                        <br/>
                                    </div>
                                </div>
                                <h4 class="stl_line" style="padding-bottom:10px;font-family:fontdatafan;text-align:center;line-height:25px">AUTHORISATION BY STATE POLLUTION CONTROL BOARD TO THE OCCUPIERS, RECYCLERS, REPROCESSORS, REUSERS, USER AND OPERATIONS OF DISPOSAL FACILTIES</h4>
                            <table width="90%" align="center">
                                <tr>
                                    <td style="text-align:left;width:60%; line-height:30px">UBIN : <?php echo $ubin; ?></td>
                                    <td style="text-align:right;width:40%;line-height:30px">Number of authorisation : <?php echo $auth_no; ?></td>				
                                </tr>
                                <tr>				
                                    <td style="text-align:left;">UAIN : <?php echo $uain; ?></td>
                                    <td style="text-align:right;">Date of Issue :<?php echo date("d-m-Y",strtotime($issue_date)); ?></td>
                                </tr>
                                
                            </table>
                            <br/><br/>
                            <p align="center" style="padding:0px 20px 5px 20px;text-align:center;font-family:lucidacalligraphy;font-size:1em;line-height:22px">            
                                <?php echo $key_person; ?> of <?php echo $companyName; ?> is hereby granted an authorisation based on the enclosed signed inspection report for generation, collection, reception, storage, transport, reuse, recycling, recovery, pre-processing, co-processing, utilisation, treatment, disposal or any other use of hazardous or other wastes or both on the premises situated at <?php echo $address; ?> .
                            </p>
                            <center><h4 class="text-bold"><u>Details of Authorisation</u></h4></center>
                            <table width="95%" align="center" class="table table-bordered table-responsive text-center" style="border-collapse: collapse" border="1">			
                                <thead>
                                    <tr>
                                        <th width="5%" align="center">Sl No</th>
                                        <th width="25%" align="center">Category of Hazardous Waste as per the Schedules I, II and III of these rules</th>
                                        <th width="25%" align="center">Authorised mode of disposal or recycling or utilisation or co-processing, etc.</th>
                                        <th width="20%" align="center">Quantity(ton/annum)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td><?php echo $auth_details->a; ?></td>
                                        <td><?php echo $auth_details->b; ?></td>
                                        <td><?php echo $auth_details->c; ?></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td><?php echo $auth_details->d; ?></td>
                                        <td><?php echo $auth_details->e; ?></td>
                                        <td><?php echo $auth_details->f; ?></td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td><?php echo $auth_details->g; ?></td>
                                        <td><?php echo $auth_details->h; ?></td>
                                        <td><?php echo $auth_details->i; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                            <p align="justify" style="padding:20px 30px 5px 30px;font-family:lucidacalligraphy;line-height:25px">            
                                The authorisation shall be valid for a period of 5(five) years from the date of issue of this certificate.    
                            </p>
                            <div class="row" style="padding-right:10%;padding-bottom:20px;float:right">
                                <div style="width:30%;position:relative;float:left;">
                                    <img src="<?=base_url('storage/temps/qrcode.png')?>" style="width: 120px; height: 120px">
                                </div>
                            </div>
							<br><br><br><br>
                            <div style="padding:10px 30px 10px 30px">
                            <h3>A. General conditions of authorisation : </h3>
                            <ol>
                                <li>The authorised person shall comply with the provisions of the Environment    (Protection) Act,1986, and the rules made there under.</li>
                                <li>The authorisation or its renewal shall be produced for inspection at the request of an officer authorised by the State Pollution Control Board.</li>
                                <li>The person authorised shall not rent, lend, sell, transfer or otherwise transport the
                                    hazardous and other wastes except what is permitted through this authorisation.</li>
                                <li>Any unauthorised change in personnel, equipment or working conditions as mentioned in the application by the person authorised shall constitute a breach of his authorisation.</li>
                                <li>The person authorised shall implement Emergency Response Procedure (ERP) for which this authorisation is being granted considering all site specific possible scenarios such as spillages, leakages, fire etc. and their possible impacts and also carry out mock drill in this regard at regular interval of time.</li>
                                <li>The person authorised shall comply with the provisions outlined in the Central Pollution Control Board guidelines on “Implementing Liabilities for Environmental Damages due to Handling and Disposal of Hazardous Waste and Penalty”.</li>
                                <li>It is the duty of the authorised person to take prior permission of the State Pollution   Control Board to close down the facility.</li>
                                <li>The imported hazardous and other wastes shall be fully insured for transit as well as for any accidental occurrence and its clean-up operation.</li>
                                <li>The record of consumption and fate of the imported hazardous and other wastes shall be maintained.</li>
                                <li>The hazardous and other waste which gets generated during recycling or reuse or recovery or pre-processing or utilisation of imported hazardous or other wastes shall be treated disposed of as per specific conditions of authorisation.</li>
                                <li>The importer or exporter shall bear the cost of import or export and mitigation of damages if any.</li>
                                <li>An application for the renewal of an authorisation shall be made as laid down under these Rules.</li>
                                <li>Any other conditions for compliance as per the Guidelines issued by the Ministry of
                                Environment, Forest and Climate Change or Central Pollution Control Board from time to time.</li>
                                <li>Annual return shall be filed by June 30th for the period ensuring 31st March of the year.</li>
                            </ol>
                            <h3>B. Specific Conditions (Industry Specific) : </h3>
                            <ol>
                                <li><?php echo $term; ?></li>
                            </ol>
                        </div>
                           <br/><br/>
						   <table align="center" style="width:99%;font-family:sanserif;">
                                    <tr>
                                        <td style="width:50%;padding-left:40px;">Place : Guwahati<br/>Date : <?php echo date("d-m-Y"); ?></td>
                                        <td style="width:50%;padding-right:40px;text-align:right;"><?php echo strtoupper($companyOwner) ?><br/><br/>Authorized Signatory</td>
                                    </tr>                    
                            </table>
							<br><br><br>
                            <div style="clear:both"></div>
                            </div>
                    </div><!--End of .box-body--> 
                </div><!--End of .box-->                    
            </div><!--End of .content-wrapper-->
            <?php $this->load->view("staffs/requires/footer"); ?>
        </div><!-- End of .wrapper-->
     
       

    </body>
</html>