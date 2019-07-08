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
	$lic_exp_year = $formCertRow->lic_exp_year;
	$lic_no = $formCertRow->lic_no;
	$sub_date = $formCertRow->sub_date;
	$regular_fees = $formCertRow->regular_fees;
	$penalty_charge = $formCertRow->penalty_charge;
	$arrear_fees_details = $formCertRow->arrear_fees_details;
	$afd = json_decode($arrear_fees_details);
} else {
	$total_fees = "";
	$lic_no = "";
	$sub_date = "";
	$lic_exp_year = "";
	$regular_fees = "";
	$penalty_charge = "";
	$arrear_fees_details = "";
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
													
                        <div class="alomcertbl printcontent" style="position:relative;text-align:center;">
                            <img src="<?=base_url('public/imgs/assam.png')?>" class="alomlogoimg" style = "align:center">
                            <br/>
                            <h4 align = "center"><b>OFFICE OF THE CONTROLLER OF LEGAL METROLOGY</b></h4>
                            <br/>
                            <table width="100%"  >
                                <tr>
                                    <td>UBIN : <b><?=$ubin?></b></td>
                                    <td align="right">UAIN : <b><?=$uain?></b></td>
                                </tr>
                                <tr>
                                    <td></td>
						<td align="right"><?php if($total_fees!=""){?>Fees Paid : <b><?php echo "Rs. ".$total_fees; ?><?php }?></b></td>

                                </tr>
                            </table>
                            <br/>
                            <p><b>LICENCE TO MANUFACTURE, WEIGHTS, MEASURES, WEIGHING OR MEASURING INSTRUMENTS.</b></p>
                            <br/>
                            <div class="col-sm-12" style="padding:0;">
                                <div class="col-sm-6">
                                    <p align="justify">Licence No.:<?php echo $lic_no;?></p>
                                </div>					
                                <div class="col-sm-6 pull-right" >
                                    <p align="right">Year - <?php echo date('Y');?></p>
                                </div>	
                            </div>
                            <p style="text-indent: 14px;" align="justify">
                                1. The Controller of Legal Metrology hereby grants to <?php echo strtoupper($address);?> a 
                                licence to manufacture the following :-
                            </p>
                            <p style="text-indent: 14px;" align="justify">(i) Weights : ...</p>
                            <p style="text-indent: 14px;" align="justify">(ii) Measures : ...</p>
                            <p style="text-indent: 14px;" align="justify">(iii) Weighing Instruments : ..</p>
                            <p style="text-indent: 14px;" align="justify">(iv) Measuring Instruments with details in each case : ..</p>
                            <p style="text-indent: 14px;" align="justify">
                                2. The licence is valid for the party named above in respect of his workshop located at ...
                            </p>
                            <p style="text-indent: 14px;" align="justify">
                                3. This licence is valid from ...
                            </p>
                            <p style="text-indent: 14px;" align="justify">
                                4. The manufacturer shall comply with the conditions noted below. If he fails to comply with anyone of these, his licence is liable to be cancelled.
                            </p>
                            <p style="text-indent: 14px;" align="justify">
                                5. The trade mark monogram being used by the manufacturer is as under.
                            </p>
                            <br/>
                            <div class="col-sm-12" style="padding:0;">
                                <div class="col-sm-6">
                                    <p align="justify"></p>
                                </div>					
                                <div class="col-sm-6 pull-right" >
                                    <p align="center"><?php echo strtoupper($companyOwner) ?><br/>Controller of Legal Metrology<br/>Govt. of Assam</p>
                                </div>	
                            </div>
                            <br/>
                            <table width="100%">
                                <tr>
                                    <td>Date : <?php echo date('d-m-Y'); ?></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Place : <?php echo $dist;?></td>
                                    <td></td>
                                </tr>
                            </table>
                            <br/>
                            <p align="justify">Note: In the case of firm, its name with the names of all persons having interest in the business should be given in paragraph 1.</p>
                            <br/>
                            <div class="row" style="padding-left:5%;padding-bottom:20px;">
                                <?php if($total_fees!=""){?>
                                <div style="width:70%;position:relative;float:left;text-align:left">
                                    <span class="details" style="padding-bottom:5px"><u>Details of Fees Paid</u></span>
                                    <p style="margin-top:5px;font-family:sans-serif;font-size:14px;">1. Regular Fees for the year <?php echo $lic_exp_year; ?> : Rs. <?php echo $regular_fees; ?>.00</p>
                                    <p style="margin-top:5px;font-family:sans-serif;font-size:14px;">2. Arrear Fees for the year <?php echo $afd->y1." - ".substr( $afd->y2, -2 );?> : Rs. <?php echo $afd->fees; ?>.00</p>
                                    <p style="margin-top:5px;font-family:sans-serif;font-size:14px;">3. Penalty/other charges : Rs. <?php echo $penalty_charge; ?>.00</p>
                                </div>
                                <?php }else{?>	
                                <div style="width:70%;position:relative;float:left;text-align:left">
                                    <p>&nbsp;</p>
                                </div>
                                <?php }?>
                                <div style="width:30%;position:relative;float:left;">
                                    <img src="<?=base_url('storage/temps/qrcode.png')?>" height = "100px">
                                </div>
                            </div>
                            <br/>
                            <h4><b>Conditions of Licence</b></h4>
                            <p align="justify">1. The person in whose favour this licence is issued shall -</p>
                            <p style="text-indent: 14px;" align="justify">(a) Comply with all the relevant provisions of the Act and Rules for the time being in force;</p>
                            <p style="text-indent: 14px;" align="justify">(b) Not encourage or countenance any infringement of the provisions of the Act or the Rules amended from time to time;</p>
                            <p style="text-indent: 14px;" align="justify">(c) Exhibit this licence in some conspicuous part of the premises to which it relates;</p>
                            <p style="text-indent: 14px;" align="justify">(d) Comply with any general or special directions that may be given by the Controller of legal metrology;</p>
                            <p style="text-indent: 14px;" align="justify">(e) Surrender the licence in the event of closure of business and/or cancellation of Licence;</p>
                            <p style="text-indent: 14px;" align="justify">(f) Present the weights, measures, weighing or measuring instruments as the case may be manufactured and meant for use within the State, to the legal metrology officer for verification and stamping before sale;</p>
                            <p style="text-indent: 14px;" align="justify">(g) Submit the application for renewal of this licence as required under the rules within thirty days of expiry of the validity of the licence.</p>
                        </div>
                    </div><!--End of .box-body--> 
                </div><!--End of .box-->                    
            </div><!--End of .content-wrapper-->
            <?php $this->load->view("staffs/requires/footer"); ?>
        </div><!-- End of .wrapper-->
    </body>
</html>
