<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Login :: Ease of Doing Business in Assam</title>
    <link rel="icon" href="<?= base_url('public/'); ?>imgs/favicon.ico" type="image/ico" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/'); ?>bootstrap-3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/'); ?>font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/'); ?>css/animate.css" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/'); ?>css/eodb.css" />
    <script src="<?= base_url('public/'); ?>js/jquery-3.2.1.min.js"></script>
    <script src="<?= base_url('public/'); ?>js/notify.min.js"></script>
    <style type="text/css">
        font.error {
            font-size: 12px;
            color: #d43f3a;
            font-style: italic;
            font-weight: bold;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#dept").keypress(function (e) {
                if(e.which == 13) {
                    $("#adminloginbtn").click();
                }//End of if
           });//End of keypress
        });//End of ready
    </script>
</head>
<body class="hold-transition skin-blue fixed" data-target="#scrollspy" data-spy="scroll">
    <?php if ($this->session->flashdata("flashMsg")) { ?>
        <script>$.notify("<?= $this->session->flashdata("flashMsg"); ?>", "error");</script>
    <?php } ?>
         <?php $this->load->view("staffs/requires/login_header"); ?>
        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-offset-4 col-md-4 col-md-offset-4">
                        <div class="panel panel-default" style="margin-top: 120px">
                            <div class="panel-heading">
                                <div align="center">
                                    <strong><h2 style="color:#2086bf">Staff Login</h2></strong>
                                </div>
                            </div>
                            <div class="panel-body">
                                <form action="<?=base_url('staffs/login/process')?>" method="post" id="adminloginfrm" role="form">
                                    <input type="hidden" name="goto" value="" />
                                    <fieldset>
                                        <div class="row text-center">
                                            <img alt="" src="<?= base_url('public/'); ?>imgs/profile.png" style="width:100px; height: 100px;" >
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 col-md-10  col-md-offset-1 ">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i style="color:#2086bf" class="glyphicon glyphicon-user"></i>
                                                        </span> 
                                                        <input autofocus="" name="username" id="username" placeholder="Username" class="form-control" type="text">
                                                    </div>
                                                    <?=form_error("username")?>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i style="color:#2086bf" class="glyphicon glyphicon-lock"></i>
                                                        </span>
                                                        <input value="" name="password" id="password" placeholder="Password" class="form-control" type="password">
                                                    </div>
                                                    <?= form_error("password"); ?>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i style="color:#2086bf" class="glyphicon glyphicon-duplicate"></i>
                                                        </span>
                                                        <select name="dept" id="dept" class="form-control">
                                                            <option value="">Choose any Department</option>
															<?php $sub_departments = $this->GetSubDepartment_model->getActiveSubdepartment(); 
															print_r($sub_departments);
															foreach($sub_departments as $rows){
																echo '<option value="'.$rows["dept_code"].'">'.$rows["name"].'</option>';
															}
															
															
															?>
                                                            
                                                        </select>
                                                    </div>
                                                    <?= form_error("dept"); ?>
                                                </div>
                                                <div class="form-group">
                                                    <input value="Sign in" id="adminloginbtn" class="btn btn-lg btn-primary btn-block" type="submit" />
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                            <div class="panel-footer">
                                <span class="text-left"><a href="<?= base_url('staffs/'); ?>forgotpassword">Forget password?</a></span>
                                <span style="float:right"><a href="<?= base_url(''); ?>">Back to home</a></span>
                            </div>
                        </div>
                    </div>
                </div> <!--End of .row -->
            </div> <!--End of .content-wrapper -->
        </div> <!--End of .wrapper -->
<?php $this->load->view("staffs/requires/login_footer"); ?>
    </body>
</html>
