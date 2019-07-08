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
        <title>Staff Dashboard :: Issue NOC </title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php $this->load->view("staffs/requires/cssjs"); ?>
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
                        Issue NOC for Form No. <?=$form_no?>
                        <a href="javascript:history.back(-1)" class="btn btn-default backbtn-alm">
                            <i class="fa fa-chevron-circle-left"></i> Back
                        </a>
                    </h3><!--End of .boxalm-head-->
                    <div class="box-body">
                        <form action="<?=base_url('staffs/issuenoc/save')?>" method="method">
                            <input name="uain" value="<?=$uain?>" type="hidden" />
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td>Occupation Details</td>
                                        <td><strong>:</strong></td>
                                        <td><input name="" class="form-control" type="text"></td>
                                        <td>Report No.</td>
                                        <td><strong>:</strong></td>
                                        <td><input name="" class="form-control" type="text"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" class="text-center">
                                            <button class="btn btn-danger" type="reset">
                                                <i class="fa fa-remove"></i> Reset
                                            </button>
                                            <button class="btn btn-success" type="submit">
                                                <i class="fa fa-remove"></i> Reset
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </div><!--End of .box-body--> 
                </div><!--End of .box-->                    
            </div><!--End of .content-wrapper-->
            <?php $this->load->view("staffs/requires/footer"); ?>
        </div><!-- End of .wrapper-->
    </body>
</html>
