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
                width: 100px;
                height: 100px;
            }
            .alomheadertxt {
                font-size: 32px;
                font-weight: bold;
                text-align: center;
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
                                    <th>
                                        <img src="<?=base_url('public/imgs/logopcb.jpg')?>" class="alomlogoimg" />
                                    </th>
                                    <th class="alomheadertxt">
                                        Pollution Control Board<br />
                                        Assam
                                    </th>
                                    <th>&nbsp;</th>
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
                                                        UAIN : <strong>PCB/F50/KM/003334/04/2018</strong>
                                                    </td>
                                                    <td style="text-align: right; font-size: 16px">
                                                        Fees : <strong>Rs. 5100.00</strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style="padding-top: 40px; padding-bottom: 40px;">
                                                        <h1 style="text-align: center; text-decoration: underline; font-family: AlgerFont">
                                                            "CONSENT TO ESTABLISH"
                                                        </h1>
                                                        <p style="text-align:center; font-family: AlgerFont; font-size:1.3em; line-height:32px">
                                                            "<strong>CONSENT TO ESTABLISH</strong>" is hereby granted to <br />
                                                            <strong>Company</strong><br /> 
                                                            for setting up a <br />
                                                            <strong>Categoty</strong><br />
                                                            unit with production capacity of <strong>Capacity</strong><br />
                                                            to be located at <strong>Address</strong><br />
                                                            under section <strong>Section</strong><br />
                                                            as amended under the concerned terms &amp; conditions according to type of industry.
                                                        </p>
                                                        <p style="font-size:16px; line-height:25px;">            
                                                            This Consent to Establish is valid for a period of 5(five) years from the date of issue of this 
                                                            certificate or upto the date of commissioning of the unit, whichever is earlier, subject to terms 
                                                            and conditions annexed herewith.    
                                                        </p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size: 16px; line-height: 24px">
                                                        Place : <strong>Guwahati</strong><br />
                                                        Date : <strong>../../....</strong>
                                                    </td>
                                                    <td style="text-align: right; font-size: 16px">
                                                        Authorized Signature<br />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style="font-size: 16px; line-height: 24px; padding-top: 40px">
                                                        <strong style="text-decoration: underline;">Details of the fees</strong><br />
                                                        <ol>
                                                            <li>Regular Fees for the year : Rs. .00</li>
                                                            <li>Arrear Fees for the year : Rs. .00</li>
                                                            <li>Penalty/other charges : Rs. .00</li>
                                                        </ol>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style="font-size: 16px; line-height: 24px; text-align: center">
                                                        <strong style="text-decoration: underline;">Terms &AMP; Conditions</strong><br />
                                                        <ol>
                                                            <li>Condition Number-01</li>
                                                            <li>Condition Number-02</li>
                                                            <li>Condition Number-03</li>
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