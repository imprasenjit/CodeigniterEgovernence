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
}
$formCertRow = $this->formcertifcates_model->get_row($this->dept_code, $form_table, $form_id);
if($formCertRow) {
	$lic_exp_year = $formCertRow->lic_exp_year;
	$sub_date = $formCertRow->sub_date;
    $total_fees = $formCertRow->total_fees;
    $arrear_fees_details = $formCertRow->arrear_fees_details;
    $regular_fees = $formCertRow->regular_fees;
    $penalty_charge = $formCertRow->penalty_charge;
    $reg_no = $formCertRow->reg_no;
   
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
	 $sub_date= $total_fees= $lic_exp_year= $reg_no= $regular_fees= $arrear_fees_details= $penalty_charge= "Not Found!";
}
$formCertRow = $this->formprocess_model->get_row($this->dept_code, $form_table, $form_id);
if ($formCertRow) {
    $issue_date = $formCertRow->p_date;
} else {
    $issue_date = "Not Found!";
}//End of if ?>
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
					<table class="alomcertbl printcontent">
                            <thead>
                                <tr>
                                    <th class="alomheadertxt" >
                                        <img src="<?= base_url('public/imgs/assam.png') ?>" class="alomlogoimg" /> <br />

                                       <h2 align="center" style="margin-top:10px;"><?=$this->dept_name?></h2>
                                        <h4><b>LICENSE TO CONSTRUCT AND WORK A DISTILLERY FOR MANUFACTURE OF COUNTRY SPIRIT</b></h4>
                                        <br/>
                                    </th>
                                </tr>
                            </thead>
							<tbody>   
                                <tr>
                                    <td colspan="3" style="padding: 1px 30px;">
                                        <table style="width: 100%;">
                                          
                                                <tr>
                                                    <td style="font-size: 16px; line-height: 24px">
                                                        UBIN : <strong><?= $ubin ?></strong> <br />
														Fees : <strong>Rs.<?= $total_fees; ?></strong>
                                                        
                                                    </td>
                                                    <td style="text-align: right; font-size: 16px; line-height: 24px">

                                                        UAIN : <strong><?= $uain ?></strong> 
                                                    </td>
                                                </tr>
                                        </table>
							<br/>
                            <p align="justify">District : <b><?= strtoupper($dist); ?></b><br/>
                                No. of licence in the register : <b></b><br/>
                                Name of distiller : <b><?= strtoupper($companyOwner); ?></b><br/>
                                Locality : <b><?= strtoupper($street_name1); ?></b></p>
                            <p align="justify">This licence is hereby granted to <b><?php echo strtoupper($companyName); ?></b> .
                                <br/>
                                resident of <b><?= strtoupper($address); ?></b> district <b><?= strtoupper($dist); ?></b> is hereby authorised by the Excise Commissioner , Assam to work a distillery at <b><?= strtoupper($address); ?></b> from <b><?= date("d-m-Y"); ?></b> to 31 st March <b><?=date("Y")?></b> for manufacture of country spirit on the following conditions :
                            </p>
                            <br/>
                            <div align="justify">
                                <ol type="I">
                                    <li>That he pay to Government in advance per annum a fee of Rs 0
                                    </li>

                                    <li>That he manufacture only country spirit and only at premises named herein.</li>

                                    <li>That he subject to the approval of the Provincial Government provide site, buildings and plant for the distillery to the satisfaction of the Excise Commissioner and that he erect the distillery at the site approved by the said Government on the advice of the Director of Public Health , Assam.</li>

                                    <li>That he bear the cost of excise establishment as may be fixed by the Excise Commissioner for the supervision of the distillery and provide suitable rent free accommodation for them to the satisfaction of the Excise Commissioner.</li>

                                    <li>That he keep regular and accurate daily accounts in such forms as may be prescribed by the Excise Commissioner, of all out turns and sales made by him.</li>

                                    <li>That he pay on demand for all spirit manufactured by him the duty at the prescribed rate or rates.</li>

                                    <li>That he permit any Excise officer of or above the rank of Sub-Inspector to have at all hours free access to the distillery and warehouses and other places appertaining thereto and that on demand by any such officer he produce for inspection his accounts of outturn and sale.</li>

                                    <li>That when required by any Excise officer of or above the rank of Sub-Inspector he assist him by a sufficient number of servants in taking account of his stock.</li>

                                    <li>That he permit any Excise officer of or above the rank of Sub- Inspector to take samples of any preparations manufactured under this licence on payment of the price thereof at the current rate.</li>

                                    <li>That the licensee shall be bound to make such general arrangements as may be prescribed in writing by the Collector of the district for removal of waste matter and refuse and the abatement of nuisance arising from the working of the distillery and in particular shall carry out the following directions-
                                        <ol type="i">
                                            <li>The waste matter and refuse and wash shall always be kept screened so as to eliminate all gross suspended matter getting into the setting tank.</li>

                                            <li>Two settling tanks (pucca) shall be constructed each of the sufficient size to hold at least the wash and waste matter produced during a period of 24 hours.</li>

                                            <li>Sufficient quantity of lime shall be added into the settling tank so as to render sedimentation more satisfactory and also to neutralize acid products.</li>

                                            <li>The effluent from the settling tank shall be dried up and used as manure and the manure shall be properly stored to the satisfaction of the Collector of the district, before taking to the fields.</li>
                                        </ol>
                                    </li>
                                    </br>
                                    <li>
                                        <ol type="i">
                                            <li>That all members of the executive and ministerial staff of the distillery and also all the menials and labourers shall be natives of or domiciled in the province to the full extent to which they are available subject to such details as may be prescribed by the Excise Commissioner.</li>

                                            <li>That the lists of appointments with necessary particulars of employees other than labourers and menials , shall from time to time be submitted to Government through the Excise Commissioner for their information once at least in every six months. In case of labourers and menials it will be sufficient to submit once a year the statistics of their number , rates of wages and native districts only.</li>
                                        </ol>
                                    </li>
                                    <li>That the licensee shall be bound to maintain such minimum stock of spirit in the distillery as may from time to time be fixed by the Excise Commissioner.</li>

                                    <li>That as security for the fulfillment of these conditions, the licensee shall deposit at the time of signing the counterpart agreement to this lease with the collector of the district a sum of Rs_____ and shall execute a bond pledging the distillery premises, stills and all apparatus and utensils employed in the manufacture of spirit for the due discharge of all payments which may become due to the Government of Assam. Provided that the Government do not undertake to arrange for the sale of any of the products manufactured in this distillery.</li>

                                    <li>That the licensee shall not be permitted to take any license of a retail country spirit shop or hold any interest in any such retail country spirit shop either directly or indirectly.</li>

                                    <li>That all sales from the distillery shall be subject to the conditions of the licensee's License for sale by whole sale of country spirit .</li>

                                    <li>That he duly and faithfully perform and abide by the conditions of this license and by the provisions of the Eastern Bengal and Assam Excise Act , 1910 (Act I of 1910) as subsequently amended from time to time and all notifications and rules which may from time to time be published or made thereunder so far as they are concerned with this license, and of any other law by which he is bound as holder of this license and owner or occupier of the distillery and cause all persons employed by him to abide by such laws , rules and notifications.</li>

                                    <li>That the breach of any of the above conditions renders him liable to forfeiture of this license and of the security deposit as mentioned in clause XIII of this license as well as to any of the penalties prescribed by any law or rule made under any law for the time being in force.</li>
                                </ol>
                            </div>
                            <br/>
                            <table width="100%">
                                <tr>
                                    <td>Place of issue : GUWAHATI</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Date of issue :<?php echo date("d-m-Y",strtotime($issue_date)); ?></td>
                                    <td align="right"><center>Commissioner of Excise<br/>Assam</center></td>
                                </tr> 
                            </table>
                            <br/><br/>		

                            <div class="row" style="padding-left:5%;padding-bottom:20px;">
<?php if ($total_fees != "") { ?>
                                    <div style="width:70%;position:relative;float:left;text-align:left">
                                        <span class="details" style="padding-bottom:5px"><u>Details of Fees Paid</u></span>
                                        <p style="margin-top:5px;font-family:sans-serif;font-size:14px;">1. Regular Fees for the year <?php echo $lic_exp_year; ?> : Rs. <?php echo $regular_fees; ?>.00</p>
                                        <p style="margin-top:5px;font-family:sans-serif;font-size:14px;">2. Arrear Fees for the year <?php echo $arrear_fees_details_y1 . " - " . substr($arrear_fees_details_y2, -2); ?> : Rs. <?php echo $arrear_fees_details_fees; ?>.00</p>
                                        <p style="margin-top:5px;font-family:sans-serif;font-size:14px;">3. Penalty/other charges : Rs. <?php echo $penalty_charge; ?>.00</p>
                                    </div>
<?php } else { ?>	
                                    <div style="width:70%;position:relative;float:left;text-align:left">
                                        <p>&nbsp;</p>
                                    </div>
<?php } ?>
                                <div style="width:30%;position:relative;float:left;">
										<img src="<?=base_url('storage/temps/qrcode.png')?>" style="width: 120px; height: 120px">
									</div>
                            </div>
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