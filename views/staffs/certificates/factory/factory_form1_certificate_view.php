<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Staff Dashboard :: Upload certificates </title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php $this->load->view("staffs/requires/cssjs"); ?>
        <style type="text/css">
            font-face {
                font-family: "AlgerFont";
                src: url("<?=base_url('public/fonts/Alger.ttf')?>");
            }
            td {
                font-family:"AlgerFont";
            }
            .alomcertbl {
                width: 210mm;
                border: 4px double #222;
                margin: 10px auto;                
            }
            table.alomcertbl th {
                padding: 10px;
            }
            .alomlogoimg {
                width: 120px;
                height: 120px;
            }
            .alomheadertxt {
                font-size: 32px;
                font-weight: bold;
                text-align: center;
                line-height:50px;
            }
        </style>
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
                    </h3>
                    <div class="box-body">
                        <table class="alomcertbl">
                            <thead>
                                <tr>
                                    <th class="alomheadertxt">
                                        INSPECTORATE OF FACTORIES<br />
                                        (GOVERNMENT OF ASSAM)<br />
                                        <img src="<?=base_url('public/imgs/assam.png')?>" class="alomlogoimg" /><br />
                                        <span style="font-size:24px">
                                            REGISTRATION AND LICENCE TO WORK A FACTORY
                                        </span>
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
                                                        UBIN : <strong>AA13338/AFVPA4108B/04/2018</strong><br />
                                                        Registration No. : <strong>KAM/524</strong>
                                                    </td>
                                                    <td style="text-align: right; font-size: 16px; line-height: 24px">
                                                        UAIN : <strong>PCB/F50/KM/003334/04/2018</strong><br />
                                                        Fees : <strong>Rs. 5100.00</strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style="padding-top: 40px">
                                                        <p style="  text-align:justify; font-family: AlgerFont; font-size:1.3em; line-height:32px;">
                                                            This licence is hereby granted to <strong>Name</strong> of 
                                                            <strong>Company</strong> valid only for the premises described 
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
                                                        Place : <strong>Guwahati</strong><br />
                                                        Date : <strong>../../....</strong>
                                                    </td>
                                                    <td style="text-align: right; font-size: 16px">
                                                        CHIEF INSPECTOR OF FACTORIES, ASSAM<br />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style="padding-top: 40px; font-size: 16px; line-height: 24px; text-align: center">
                                                        <strong style="text-decoration: underline;">Description of the licensed premises</strong><br />
                                                        <div style="text-align: justify">
                                                            This licensed premises shown on Plan No .... dated 01-01-1970 are situated in 
                                                            NH37,,SARPARA,KAMRUP (RURAL) and consist of .... .
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
        </div>
    </body>
</html>