
    <div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4" style="padding:0px">
            <div class="panel panel-default" style="margin-top: 120px">
                <div class="panel-heading" style="padding:0px 2px">
                    <div align="center">
                        <strong><h2 style="color:#2086bf; margin-top:0px;  padding-top:5px">CMS Login</h2></strong>
                        <?php if ($this->session->flashdata("flashMsg")) { ?>
                        <div class="alert alert-danger" role="alert"><?= $this->session->flashdata("flashMsg"); ?></div>
                           
                        <?php } ?>
                    </div>
                </div>
                
                <div class="panel-body" style="padding-top:5px">
                    <form id="loginfrm" action="<?= base_url('cms/'); ?>login/process" method="post" style="text-align: center">                        
                        <input type="hidden" name="goto" value="" />
                        <fieldset>
                            <div class="row text-center" style="padding-bottom: 5px; border-bottom: none">
                                <img alt="" src="<?= base_url('public/'); ?>imgs/profile.png" style="width:100px; height: 100px;" >
                            </div>
                            
                            <div class="row" style="border-bottom: none">
                                <div class="col-sm-12 col-md-10  col-md-offset-1">
                                    <div class="form-group">
                                        <div class="input-group text-left">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-user" style="color: #2086bf"></i></span> 
                                            <input type="text" name="username" id="username" placeholder="Username or Email ID" class="form-control" autocomplete="off" />                                            
                                        </div>
                                        <?= form_error("username"); ?>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock" style="color: #2086bf"></i></span>
                                            <input type="password" name="password" id="password" placeholder="Password" class="form-control" autocomplete="off" />                                            
                                        </div>
                                        <?= form_error("password"); ?>
                                    </div>									
                                    <div class="form-group">
                                        <input type="submit" id="loginbtn" value="Sign in" class="btn btn-lg btn-primary btn-block" />
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="panel-footer" style="padding-bottom:2px">
                    <span class="text-left"><a href="<?= base_url('site/'); ?>forgotpassword">Forget password?</a></span>
                    <span style="float:right">New user? <a href="<?= base_url('site/'); ?>registration">Register Here</a></span>
                    
                </div>
            </div>
        </div>
    </div> <!--End of .row-->
</div> <!--End of .container-->
