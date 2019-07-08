<?php
$processRow = $this->formprocess_model->get_formrows($this->dept_code, $this->frmtbl, $this->form_id);
$cafRow = $this->cafs_model->get_row($this->swr_id);
if($cafRow) {
    $ubin = $cafRow->ubin;
    $companyName = $cafRow->Name;
    $unit_type = $cafRow->unit_type;
    $unitName = get_unittype($unit_type);
    $b_dist = $cafRow->b_dist;
    $b_block = $cafRow->b_block;
    $companyOwner = $cafRow->Name_of_owner;
}//End of if
//die($this->dept_code.$this->frmtbl.$this->form_id.$this->swr_id)
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Staff Dashboard :: Application form </title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php $this->load->view("staffs/requires/cssjs"); ?>
        <script type="text/javascript">
            $(document).ready(function () { //alert("Hi");
                $.ajax({
                   type: "GET",
                   url: "<?=base_url('departments/requires/get_application_form_view.php')?>",
                   data : {
                       dept : "<?=$this->dept_code?>",
                       form : "<?=$this->frm_no?>",
                       form_id : "<?=$this->form_id?>",
                       swr_id: "<?=$this->swr_id?>"
                   },
                   beforeSend: function () {
                       $("#formdiv").html('<h3>Loading Form...</h3>');
                   },
                   success: function (values) {//alert(values);
                       $("#formdiv").html(values);
                   }
                }); //End of Ajax
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
                <div class="box box-primary box-alm" style="margin-top: 10px;">
                    <h3 class="boxalm-head">
                        Application form
                        <a href="javascript:history.back(-1)" class="btn btn-default backbtn-alm">
                            <i class="fa fa-chevron-circle-left"></i> Back
                        </a>
                    </h3>
                    <?php $this->load->view("staffs/assets/formunitdetails"); ?>
                </div>

                <div class="box box-primary box-alm">
                    <div class="text-center"><h3>Application Form Details</h3></div>
                    <div id="formdiv"></div>
                </div>
                
                <?php $this->load->view("staffs/assets/formquerydetails"); ?>
                <?php $this->load->view("staffs/assets/formprocessdetails"); ?>

                <?php $lasturl = explode("/", $_SERVER["HTTP_REFERER"]);
				
                $lastcontroller = end($lasturl); //die("lastcontroller : ".$lastcontroller);
                if($lastcontroller != "completedapplications" || $lastcontroller != "uploadverificationreport") { ?>
                    <div class="box box-primary box-alm" style="margin-top: 10px; min-height: 300px">
                        <div class="text-center"><h3>Application Processing</h3></div>
                        <?php $this->load->view("staffs/assets/formprocessing"); ?>
                    </div> 
                <?php } ?>               
            </div>
            <?php $this->load->view("staffs/requires/footer"); ?>
        </div>
    </body>
</html>
