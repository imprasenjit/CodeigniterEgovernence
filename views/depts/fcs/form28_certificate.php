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
		$sub_date = $formCertRow->sub_date;
		$license_no = $formCertRow->license_no;
		$godown_place = $formCertRow->godown_place;
		$lic_place = $formCertRow->lic_place;
		
	
		

		
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

if(!empty($formRow->address)){
		$address=json_decode($formRow->address);
		$address_s1=$address->s1;
		$address_s2=$address->s2;
		$address_d=$address->d;
		$address_p=$address->p;
	}else{				
		$address_s1="";
		$address_s2="";
		$address_d="";
		$address_p="";
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
			 <div align="center" style="padding: 10px 30px;width:99%; border:2px solid black;">
		<h2 class="text-uppercase">DIRECTORATE OF FOOD & CIVIL SUPPLIES</h2>
		<img src="<?=base_url('public/imgs/assam.png')?>" class="alomlogoimg" />
		<br/>
		<h4><b>ASSAM : GUWAHATI- 781005</b></h4>
		<h4><b>THE ASSAM PUBLISH DISTRIBUTION OF ARTICLES CRDERS, 1982 LICENSE</b></h4>
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
		<p align="justify">License No: <?=strtoupper($license_no);?></p>
		<p align="justify">Name of dealer along with partners, if any 
         <?=strtoupper($companyOwner); ?></p>
        <br/>
        <h4>FORM &apos;1&apos;</h4>
        <h4>TERMS AND CONDITIONS</h4>
        <br/>
        <div align="justify">
			<ol type="1">
				<li>Subject to the provisions of the Assam Public Distribution of Articles Order, 1982 and to the terms and conditions of the licence
				<br/>
				<?=strtoupper($key_person)?> is/ are hereby authorised to operate as a retailer for the area. The purchage and sales shall be carried on only as per directions to be given in writing by the Licencing Authority from time to time.</li>
				<li>
					<ol type="a">
						<li>The licence shall carry on retail business of notified articles at the following place.<br/>
						<?=strtoupper($lic_place);?></li>
						<li>The notified articles in which the aforesaid business is to be carried on shall not be stored at any place other than the god-owns mentioned below &ndash;<br/>
						<?=strtoupper($godown_place);?></li>
					</ol>
					Note :- If the licensee intends to store the notified articles in place other than those specified above , he shall give intimation in writing to the Licensing Authority within a period of seventy two hours of actual storing of these articles therein. He shall also produce the licence before the Licensing Authority within a fort-night of his giving intimation mentioned above for the purpose of making requisite changes.
				</li>
				<li>
					<ol type="a">
						<li>The licensee shall maintain daily stock register for the notified articles showing correctly :<br/>
							<ol type="i">
								<li>the opening stock on each day;</li>
								<li>the quantities received on each day showing the place from where and the source from which received;</li>
								<li>the quantities delivered or otherwise removed on each day showing the places of destination; and</li>
								<li>the closing stock on each day.</li>
							</ol>
						Explanation :- (a) The licensee may maintain more then one stock register for various notified articles and may allot separate page(s) for each notified articles. In case the purchased notified articles are not received physically by the licensee sold notified articles are not removed physically by the purchaser on the date of entering into any transaction a note should be recorded in this behalf in stock Register.</li>
						<li>The licensee shall not contravence the entries in the Stock Register for each day latest by the beginning of the transaction on the following day ,unless prevented by reasonable cause, the burden of proving which shall be upon him.</li>
					</ol>
				</li>
				<li>The licensee shall not contravene the provisions of the Assam Public Distribution of Articles Order 1982 or any law relating to essential commodities for the time in force.</li>
				<li>The licensee shall issue to every customer of such notified articles a cash memo giving his own name, licence number, Name, Address,and licence namber (if any ) of the customer, the date of transaction, the quantity sold an the price charged. He shall keep a duplicate copy of the same to be available for inspection on demand by the Licensing Authority or any other officer authoerised in this behalf.</li>
				<li>The licensee shall furnish correctly such information relating to the business as may be required from him and shall carry out such instructions as may , from time to time ,be given by the licensing Authority.</li>
				<li>The licensee shall give all facilities at all reasonable times to the inspecting authority for the inspection of his stocks and accounts at any shop, godown or other places used by him for the storage, sale or purchase and for the taking of samples of the notified articles for examination.</li>
				<li>
					<ol type="1">
						<li>The licensee shall comply with any direction that may be given to him by the state Government or by the Deputy Commissioner of purchase, sale and storage for sale , of the notified articles and inregard to the Language in which the registers returns, receipts or invoices shall be written and regard to the authentication and maintenance of the registers etc.</li>
						<li>The licensee shall, keep open his shop premises on all days except the day which has been declared weekly holiday under Assam Shops and Establishment Act,1971: <br/>
						Provided that the licensee may keep his premises closed on any public holiday.<br/>
						Provided further that the Licensing Authority may by an order in writing permit any licenses to keep his shop premises closed on any day other than any of the above mentioned holidays.</li>
					</ol>
				</li>
				<li>Every licensee shall take adequate measures to ensure that the notified articles stored by him are maintained in proper condition and that damages to these articles due to ground moisture, rains ,insects, rodents birds, fire and other causes are avoided. The licensee shall also ensure that fertilizers insecticide and poisonous chemicals likely to contaminate such articles are not stored along with these notified articles in the same godowns or in immediate juxtaposition to the stocks of the notified articles.</li>
				<li>This licence shall be attach to an application for renewal.</li>
				<li>This licence shall be valid upto 31<sup>st</sup> March, <?=strtoupper($lic_exp_year);?></li>
			</ol>
		 </div>
		<table width="100%">
			<tr>
				<td>Place of issue : GUWAHATI</td>
				<td></td>
			</tr>
			<tr>
				<td>Date of issue : <?php echo date("d-m-Y",strtotime($issue_date)); ?></td>
				<td align="right">Authorized Signatory</td>
			</tr> 
		</table>
		<br/><br/>
		
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
	
     
                        </div><!--End of .alomcertbl-->
                    </div><!--End of .box-body--> 
                </div><!--End of .box-->                    
            </div><!--End of .content-wrapper-->
            <?php $this->load->view("staffs/requires/footer"); ?>
        </div><!-- End of .wrapper-->
    </body>
</html>