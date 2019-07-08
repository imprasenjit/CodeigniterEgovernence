<?php
$cafRow = $this->cafs_model->get_row($swr_id);
if($cafRow) {
    $ubin = $cafRow->ubin;
    $companyName = $cafRow->Name;
    $companyOwner = $cafRow->Name_of_owner;
    
}//End of if
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
                                        <span style="font-size:24px">REGISTRATION AND LICENCE TO WORK A FACTORY</span>
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
                                                        Registration No. : <strong>KAM/524</strong>
                                                    </td>
                                                    <td style="text-align: right; font-size: 16px; line-height: 24px">
                                                        UAIN : <strong><?=$uain?></strong> <br />
                                                        Fees : <strong>Rs. 5100.00</strong>
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td colspan="2" style="padding-top: 40px">
                                                        <p style="  text-align:justify; font-family: AlgerFont; font-size:1.3em; line-height:32px;">
                                                            This licence is hereby granted to <strong><?=$companyOwner?> </strong>of  <strong><?=$companyName?></strong> 
                                                            valid only for the premises described 
                                                            below for use as a factory employing not more than 250 persons 
                                                            on any one day during the year and using motive power not exceeding 
                                                            918 H.P subject to the provisions of the Factories Act. 1948 and the 
                                                            rules made thereunder.
                                                        </p>
                                                        <p style="font-size:16px; line-height:25px; text-align: center">            
                                                            This licence shall remain in force till the Thirty first day of December, 2018    
                                                        </p>
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td style="font-size: 16px; line-height: 24px">
                                                        Place : <strong>Guwahati</strong> <br />
                                                        Date : <strong>../../....</strong>
                                                    </td>
                                                    <td style="text-align: right; font-size: 16px">
                                                        CHIEF INSPECTOR OF FACTORIES, ASSAM <br />
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td colspan="2" style="padding-top: 40px; font-size: 16px; line-height: 24px; text-align: center">
                                                        <strong style="text-decoration: underline;">Description of the licensed premises</strong><br />
                                                        <div style="text-align: justify">
                                                            This licensed premises shown on Plan No .... dated 01-01-1970 are situated in 
                                                            NH37,SARPARA,KAMRUP (RURAL) and consist of .... .
                                                        </div>                                                            
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td colspan="2" style="font-size: 16px; line-height: 24px;">
                                                        <strong style="text-decoration: underline;">Details of the fees</strong><br />
                                                        <ol>
                                                            <li>Regular Fees for the year : Rs. .00</li>
                                                            <li>Arrear Fees for the year : Rs. .00</li>
                                                            <li>Penalty/other charges : Rs. .00</li>
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