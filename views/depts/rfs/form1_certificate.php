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
                        <button class="btn btn-warning backbtn-alm printbtn">
                            <i class="fa fa-print"></i> Print
                        </button>
                    </h3><!--End of .boxalm-head-->
                    <div class="box-body">
                        <div class="alomcertbl printcontent">
                            <img src="<?= base_url('public/imgs/assam.png') ?>" class="alomlogoimg" />
                            <p style="margin-bottom:0px" class="text-uppercase"><?php echo $dept_name; ?></p>
                            <p><b>CERTIFIED COPY OF REGISTRATION OF FIRM</b></p>
                            <table width="100%"  >
                                <tr>
                                    <td>UBIN : <b><?=$ubin?></b></td>
                                    <td align="right">UAIN : <b><?=$uain?></b></td>
                                </tr>
                                <tr>
                                    <td>Issue Number : <b>--</b></td>
                                    <td align="right"></td>
                                </tr>
                            </table>

                            <p align="left">Number of the firm on the Register: <b>--</b> of --.</p>
                            <p align="left">Name of the Firm: <b><?php echo strtoupper($companyName); ?></b>.</p>
                            <p align="left">Nature of business: <b>--</b>.</p>
                            <p align="left">Date of Establishment: <b><?php echo date('d-m-Y'); ?></b>.</p>
                            <p align="left">Duration of the Firm: <b>Unlimited</b>.</p>

                            <table width="100%" class="table table-responsive" border="1">
                                <thead>
                                    <tr>
                                        <th width="25%">Serial No. of Document</th>
                                        <th width="25%">Date of Filling or Registration</th>
                                        <td rowspan="2">Despription of documents filled in the statement on Form No. <b>1</b> under section <b>58</b> the I.P. Act, 1932</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td><b><?= date('d-m-Y') ?></b></td>
                                    </tr>
                                </tbody>
                            </table>
                            <p align="justify">Name and permanent address of the partners and date of joining</p>
                            <table width="100%" class="table table-responsive" border="1">
                                <thead>
                                    <tr>
                                        <th>Sl No.</th>
                                        <th>Full Name of partners</th>
                                        <th>Permanent Address</th>
                                        <th>Date of Joining</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!--
                                    <?php
                                    $results1 = $admin_fetch_functions->executeQuery("rfs", "select * from rfs_form1_members where form_id='$form_id'") or die("Error : " . $rfs->error);
                                    $sl = 1;
                                    while ($rows = $results1->fetch_object()) {
                                        if ($rows->member_name != "") {
                                            ?>
                                            <tr>
                                                <td><?php echo $sl; ?></td>
                                                <td><?php echo strtoupper($rows->member_name); ?></td>
                                                <td><?php echo strtoupper($rows->member_address); ?></td>
                                                <td><?php echo date('d-m-Y', strtotime($rows->date_f_joining)); ?></td>
                                            </tr>
                                            <?php
                                            $sl++;
                                        }
                                    }
                                    ?>
                                    -->
                                </tbody>
                            </table>
                            <br/>
                            <p align="justify">Place of Business and Other Place of Business</p>
                            <table width="100%" class="table table-responsive" border="1">
                                <thead>
                                    <tr>
                                        <th width="50%">Principal place</th>
                                        <th width="25%">Other place</th>
                                        <th>Date of closing or opening</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?=$address?></td>                                        
                                    </tr>
                                </tbody>
                            </table>

                            <table width="100%">
                                <tr>
                                    <td>
                                        Place of issue : GUWAHATI<br/>
                                        Date of issue : <?php echo date("d-m-Y"); ?>
                                    </td>
                                    <td align="right"><center><b></b><br/><b>Registrar of Firms</b><br/>Assam, Dispur, Guwahati</center></td>
                                </tr>
                            </table>		
                            <div class="row" style="padding-left:5%;padding-bottom:20px;">
                                <div style="width:70%;position:relative;float:left;text-align:left">
                                    <p>&nbsp;</p>
                                </div>
                                <div style="width:30%;position:relative;float:left;">
                                    <img src="<?=base_url('storage/temps/qrcode.png')?>" style="width: 120px; height: 120px">
                                </div>
                            </div>
                            <p align="left">N.B. Registered number of the firm should not be stated as Govt. registered. It is registered under the I.P. Act, 1932</p>
                            <p align="center">This is a computer generated certificate and it does not require signature. This certificate can be verified by UAIN or the QR Code printed on it.</p>	
                        </div><!--End of .alomcertbl-->
                    </div><!--End of .box-body--> 
                </div><!--End of .box-->                    
            </div><!--End of .content-wrapper-->
            <?php $this->load->view("staffs/requires/footer"); ?>
        </div><!-- End of .wrapper-->
    </body>
</html>
