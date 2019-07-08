<?php
$cafRow = $this->cafs_model->get_row($swr_id);
if($cafRow) {
    $ubin = $cafRow->ubin;
    $companyName = $cafRow->Name;
    $companyOwner = $cafRow->Name_of_owner;
    $street_name1 = $cafRow->b_street_name1;	$street_name2=$cafRow->b_street_name2;	$vill=$cafRow->b_vill;	$dist=$cafRow->b_dist;
    $address=$street_name1.",".$street_name2.",".$vill.",".$dist;
}//End of if
$formCertRow = $this->formcertifcates_model->get_row($this->dept_code, $form_table, $form_id);
if($formCertRow) {
	$lic_no = $formCertRow->lic_no;
	$lic_exp_year = $formCertRow->lic_exp_year;
	$sub_date = $formCertRow->sub_date;
    $total_fees = $formCertRow->total_fees;
    $arrear_fees_details = $formCertRow->arrear_fees_details;
    $plan_no = $formCertRow->plan_no;
    $plan_no_date = $formCertRow->plan_no_date;
    $consist_of = $formCertRow->consist_of;
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
	$lic_no= $sub_date= $total_fees= $lic_exp_year= $plan_no= $plan_no_date= $consist_of= $regular_fees= $arrear_fees_details= $penalty_charge= "Not Found!";
}
$formCertRow = $this->formprocess_model->get_row($this->dept_code, $form_table, $form_id);
if($formCertRow) {
	$issue_date = $formCertRow->p_date;
	
} else {
	$issue_date= "Not Found!";
}
$formCertRow = $this->forms_model->get_row($this->dept_code, $form_table, $form_id);
if($formCertRow) {
    
    if(!empty($formCertRow->manuf_prod)){		
        $manuf_prod=json_decode($formCertRow->manuf_prod);		
        $manuf_prod_nv=$manuf_prod->nv;
        $manuf_prod_max_emp=$manuf_prod->max_emp;		
        $manuf_prod_max_emp1=$manuf_prod->max_emp1;
        $manuf_prod_max_emp2=$manuf_prod->max_emp2;	
    }else{		
        $manuf_prod_nv="";
        $manuf_prod_max_emp="";
        $manuf_prod_max_emp1="";
        $manuf_prod_max_emp2="";	
    }	
    if(!empty($formCertRow->power)){		
        $power=json_decode($formCertRow->power);		
        $power_nature=$power->nature;
        $power_p=$power->p;
        $power_mp=$power->mp;	
    }else{		
        $power_nature="";
        $power_p="";
        $power_mp="";	
    }
	if(!empty($formCertRow->manuf_process)){	
        $manuf_process=json_decode($formCertRow->manuf_process);		
        $manuf_process_carried=$manuf_process->carried;$manuf_process_car_fac=$manuf_process->car_fac;$manuf_process_nat_fac=$manuf_process->nat_fac;	
        }else{		
        $manuf_process_carried="";$manuf_process_car_fac="";$manuf_process_nat_fac="";	
        }	
    if($manuf_process_nat_fac=='PGS' || $manuf_process_nat_fac=='ES'){	
            $power_unit="K.W";	
            }else{		
            $power_unit="H.P";
            }		
    $no_of_workers=$manuf_prod_max_emp;	
    $total_power=$power_p;
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
                        <table class="alomcertbl printcontent">
                            <thead>
                                <tr>
                                    <th class="alomheadertxt">
                                        <?=strtoupper($this->dept_name)?> <br />
                                        (GOVERNMENT OF ASSAM) <br />
                                        <img src="<?=base_url('public/imgs/assam.png')?>" class="alomlogoimg" /> <br />
                                        <span style="font-size:24px">RENEWAL OF LICENCE TO WORK A FACTORY</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="3" style="padding: 10px 30px;">
                                        <table style="width: 100%;">
                                            <tbody>
                                                <tr>
                                                    <td style="font-size: 16px; line-height: 24px">
                                                        UBIN : <strong><?=$ubin?></strong> <br />
                                                        Registration No. : <strong><?=$lic_no;?></strong>
                                                    </td>
                                                    <td style="text-align: right; font-size: 16px; line-height: 24px">
                                                        UAIN : <strong><?=$uain?></strong> <br />
                                                        Fees : <strong>Rs.<?=$total_fees;?></strong>
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td colspan="2" style="padding-top: 40px">
                                                        <p style="  text-align:justify; font-family: AlgerFont; font-size:1.3em; line-height:32px;">
                                                            This licence is hereby granted to <strong><?=$companyOwner?></strong> of <strong><?=$companyName?></strong> valid only for the premises described below for use as a factory employing not more than <?=$no_of_workers;?> persons on any one day during the year and using motive power not exceeding <?=$total_power?> <?=$power_unit;?> subject to the provisions of the Factories Act. 1948 and the rules made thereunder.
                                                        </p>
                                                        <p style="font-size:16px; line-height:25px; text-align: center">            
                                                            This licence shall remain in force till the Thirty first day of December, <?=$lic_exp_year;?>  
                                                        </p>
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td style="font-size: 16px; line-height: 24px">
                                                        Place : <strong>Guwahati</strong> <br />
                                                        Date : <strong><?=date("d-m-Y", strtotime($issue_date))?></strong>
                                                    </td>
                                                    <td style="text-align: right; font-size: 16px">
                                                        CHIEF INSPECTOR OF FACTORIES, ASSAM <br />
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td colspan="2" style="padding-top: 40px; font-size: 16px; line-height: 24px; text-align: center">
                                                        <strong style="text-decoration: underline;">Description of the licensed premises</strong><br />
                                                        <div style="text-align: justify">
                                                            This licensed premises shown on Plan No <?=$plan_no;?> dated <?=$plan_no_date;?> are situated in <?=$address;?> and consist of <?=$consist_of;?> .
                                                        </div>                                                            
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td colspan="2" style="font-size: 16px; line-height: 24px;">
                                                        <strong style="text-decoration: underline;">Details of the fees</strong><br />
                                                        <ol>
                                                            <li>Regular Fees for the year : Rs. <?=$regular_fees;?></li>
                                                            <li>Arrear Fees for the year : Rs. <?=$arrear_fees_details_fees;?></li>
                                                            <li>Penalty/other charges : Rs. <?=$penalty_charge;?></li>
                                                        </ol>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
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