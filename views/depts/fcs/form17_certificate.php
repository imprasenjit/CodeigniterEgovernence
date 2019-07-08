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
						<!--copied from fcs_form17_certificate.php-->
       <div align="center" style="padding: 10px 30px;width:99%; border:2px solid black;">
		<h2 class="text-uppercase">DIRECTORATE OF FOOD & CIVIL SUPPLIES</h2>
		<img src="<?=base_url('public/imgs/assam.png')?>" class="alomlogoimg" />
		<br/>
		<h4><b>ASSAM : GUWAHATI- 781005</b></h4>
		<h4><b>THE ASSAM TRADE ARTICLES (LICENSING AND CONTROL) ORDER, 1982 LICENSE</b></h4>
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
		<p align="justify">License No: <?=strtoupper($license_no);?> Retail</p>
		<br/>		
		<p align="justify">Name of dealer along with partners, if any 
         <?=strtoupper($companyOwner); ?></p>
		<p align="justify">are hereby authorised to purchase, sell or store for sale the under mentioned trade articles.</p>
        <p align="center">This Licence is valid upto 31<sup>st</sup> December of <?=date('Y',strtotime($lic_exp_year));?> </p>
		<p align="justify">
		Subject to the provisions of the Assam Trade Articles (Licensing and Control) Order, 1982 and to the terms and conditions of this license,  M/S <?=strtoupper($companyName);?> are hereby authorised to purchase, sell or store for sale the under mentioned trade articles.	
		</p> <br/>
		
		<table border="1" class="table">
			<thead>
			  <tr>
				<th>Sl No.</th>
				<th>As Wholesaler</th>
				<th>As Importer</th>
				<th>As Retailer</th>
			  </tr>
			</thead>
			<tbody>
				<?php 
						$personalized_array = array("form_id"=>$form_id);
						$forms_t1_Row = $this->forms_model->get_personalized_rows($this->dept_code, $form_table."_t1", $personalized_array);
						$sl=1;
						if($forms_t1_Row){
							foreach($forms_t1_Row as $rows){ ?>
							<tr >
								<td><?=strtoupper($sl);?></td>
								<td><?=strtoupper($rows->wholesaler);?></td>
								<td><?=strtoupper($rows->impoter);?></td>
								<td><?=strtoupper($rows->retailer);?></td>
							</tr>
							<?php 
								$sl++;
							} 
						} 
						?>	
			</tbody>
		</table> </br>
			  
			  
		<table width="100%">
			<tr>	
				<td>
				The licensee shall carry on the business of aforesaid trade articles at the following place : <?=strtoupper($dist);?> </br>
				Trade articles in which the aforesaid business is to be carried on shall not be stored at any    place other than the godown mentioned below:</br>
				Village/ Town : <?=strtoupper($address_s1);?>, P.S : <?=strtoupper($address_s2);?>, District : <?=strtoupper($address_d);?>, Pincode : <?=strtoupper($address_p);?><br/>
				</td>
			</tr>
			
		</table>
		<br/>
		<table width="100%">
			<tr>
				<td>Place of issue : <?=strtoupper($dist);?></td>
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
		
		<div class="row">
		
		<h4 class="newpage"><b>Terms & Conditions</b></h4>
			<div align="justify">
				<ol>
					<li>If the licensee intends to store the trade articles in place others than those specified above, he shall give intimation in writing to the licensing Authority within a period of seventy two hours of actually storing of these trade articles therein. He shall also produce the license before the Licensing Authority within a fortnight of his giving intimation mentioned above, for the purpose of making requisite changes.</li>
					<li>
						<ol type="a">
							<li>The licensee shall maintain a stock register of daily accounts in form &#96;F&acute; for the trade articles mentioned in paragraph 1 showing correctly :- <br/>
							<ol type="i">
								<li>The opening stock on each day;</li>
								<li>The quantities received on each day showing the place from where and the source from which received;</li>
								<li>The quantities delivered for otherwise removed more than one stock register for the various trade articles and may allot separate page (s) for each trade article.</li>
							</ol>
							EXPLANATION: - The licensee may maintain more than one stock register for the various trade articles and may allot separate page (s) for each trade article.  
							</li>
							<li>The licensee shall enter all the transactions held on telephone or through Billty or otherwise relating to purchase on sale of trade articles, in stock register. In case the purchased trade articles are not received physically by the licensee on the date of entering into any transaction, a note shall be recorded in this behalf in the stock register.</li>
							<li>The quantities of the various trade articles shall be entered in the stock register as under:-
							Oilseeds and pulses.<br/>
								<ol type="i">
									<li>Food- grains, Sugar, Gur, Khandsari, in quintals or Kg.</li>
									<li>Edible Oils	::		:: in tins/ Kgs. </li>
								</ol>
							</li>
							<li>The licensee shall complete the entries in the stock register for each day latest by the beginning of the transactions on the following day, unless prevented by reasonable cause, the burden of proving which shall lie upon him.</li>
							<li>A licensee, who himself is a producer of food- grains, oil-seeds or whole pulses, shall separately show the stocks of his own produce in the stock register, if such stocks are stored in his business premises.</li>
						</ol>
					</li>
					<li>The licensee shall not contravene the provisions of this Order or any other law relating to essential commodities for the time being in force.</li>
					<li>The licensee shall not-<br/>
						<ol type="i">
							<li>Enter into any transaction involving purchase, sale or storage for sale of trade articles in  speculative manner prejudicial to the maintenance and easy availability of their supplies in the market;</li>
							<li>Sell or offer to sell any trade articles at a price higher than that specified in respect of such article in the list of price and stocks;</li>
							<li>Refuse to sell to any person any trade articles kept for sale at the price specified in the list of prices and stocks; and </li>
							<li>Keep in his possession stocks of trade articles exceeding the limit fixed under clause 18.</li>
						</ol>
					</li>
					<li>The licensee shall display occupiously in form &#96;E&acute; legibly written in local language a list of prices and stocks of the trade article he deals with, in accordance with the provision of clause 15.</li>
					<li>The license shall issue in every customer of such a trade articles cash memo or invoice, as the case may be giving his own name and license no., name, address and license number (if any) of the customer, the date of transaction, the quantity sold and the price charged. He shall keep a duplicate of the same to be available for inspection on demand by the licensing authority or any other officer authorized in his behalf. </br>
					Provided that it shall not be necessary for a retailer to issue any such cash memo or invoice or to keep any such duplicate in respect of sale of trade articles costing not more than Rs. 10 unless demanded by the customer.</li>
					<li>The licensee shall furnish correctly such information relating to the business as may be demanded from him and shall carry out such instructions as may from time to time, be given by the licensing Authority.</li>
					<li>The licensee shall give all facilities at all reasonable times to the inspecting authority for the inspection of his stocks and accounts at any shop, godown or other places used by him for the storage, sale or purchase and for the taking of samples of the trade articles mentioned in paragraph 1 for examination.</li>
					<li>The licensee shall comply with any direction that may be given to him by the State Government or the Deputy Commissioner of the Licensing Authority with regard to the purchase, sale and storage for sale, of these trade articles and in regard to the Language in which the registers, returns, receipt of invoices shall be written and in regard to the authentication and maintenance of the register mentioned in paragraph 3 above.</li>
					<li>The licensee shall, in case when he functions in a regulated market, abide by such instructions relating to his business as are given by the marketing authority having jurisdiction, and in any other case by such body as may be recognised by the State Government in this behalf.</li>
					<li>Every licensee shall take adequate measures to ensure that the trade articles stored by his are maintained in proper condition and that damages to these articles due to ground moisture, rains, insects, rodent birds, fire and such other causes are avoided. The licensee shall also ensure that fertilizers, insecticides and poisonous chemicals likely to v=contaminate such articles are not shored along with these articles in the same godowns or in immediate juxtaposition to the stocks of the trade articles.</li>
					<li>
						<ol type="i">
							<li>The licensee shall supply or sell the trade articles to the consumer or dealer in the same quantity or weight and at a price marked on the container/ package, but if any shortage limit is allowed by any order of the central Government or State Government the same will be deducted from the marked quantity or weight.</li>
							<li>The licensee shall keep open his shop premises on all days except the day which has been declared weekly holiday under Assam Shops and Establishment Act, 1971. Provided that the licensee may keep his premises closed on any public holiday. Provided further that the Licensing Authority may by an order in writing permit any licensee to keep his shop premises closed on any-day other than the above mentioned holiday.</li>
						</ol>
					</li>
					<li>This Licensee shall be attached to an application for renewal.</li>
					<li>This Licensee shall be valid upto 31<sup>st</sup> December,<?=strtoupper($lic_exp_year); ?>.</li>
				</ol>
			</div>
		</div>
	</div>
	<!--copied-->
                            </div><!--End of .row-->
                        </div><!--End of .alomcertbl-->
                    </div><!--End of .box-body--> 
                </div><!--End of .box-->                    
            </div><!--End of .content-wrapper-->
            <?php $this->load->view("staffs/requires/footer"); ?>
        </div><!-- End of .wrapper-->
    </body>
</html>