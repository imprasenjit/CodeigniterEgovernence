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
                        <iframe src="<?=base_url('staffs/certificates/test')?>" style="width: 100%; min-height: 800px"></iframe>
                    </div><!--End of .box-body--> 
                </div><!--End of .box-->                    
            </div><!--End of .content-wrapper-->
            <?php $this->load->view("staffs/requires/footer"); ?>
        </div>
    </body>
</html>