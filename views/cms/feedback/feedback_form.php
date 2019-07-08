<div class="content-wrapper">		

    <section class="content">

        <div class="box box-primary"> 

            <div class="box-header with-border">

                <h2>Feedback EDIT</h2>

            </div>

            <div class="box-body" id="boxbody">             
                <?php if($this->session->flashdata("message")){?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Success!</strong> <?= $this->session->flashdata("message"); ?>
                </div>
                <?php }?>

                <form action="<?php echo $action; ?>" method="post" class="form-horizontal">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label"> Name<?php echo form_error('name') ?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" id="name" placeholder="" value="<?php echo $name; ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="varchar" class="col-sm-2 control-label">Organization Name <?php echo form_error('business_name') ?></label>
                        <div class="col-sm-10"> <input type="text" class="form-control" name="business_name" id="business_name" placeholder="name" value="<?php echo $business_name; ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label"> Email<?php echo form_error('email') ?></label>
                        <div class="col-sm-10"> <input type="text" class="form-control" name="email" id="email" placeholder="" value="<?php echo $email; ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="bigint" class="col-sm-2 control-label">Phone No<?php echo form_error('phone_no') ?></label>
                        <div class="col-sm-10"> <input type="text" class="form-control" name="phone_no" id="phone_no" placeholder="no" value="<?php echo $phone_no; ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="enq_msg" class="col-sm-2 control-label">Feedback Message <?php echo form_error('enq_msg') ?></label>
                        <div class="col-sm-10"><textarea class="form-control" rows="3" name="enq_msg" id="enq_msg" placeholder="msg"><?php echo $enq_msg; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="varchar" class="col-sm-2 control-label"> Department<?php echo form_error('dept') ?></label>
                        <div class="col-sm-10"> <input type="text" class="form-control" name="dept" id="dept" placeholder="" value="<?php echo $dept; ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="varchar" class="col-sm-2 control-label">Issue <?php echo form_error('issue') ?></label>
                        <div class="col-sm-10"> <input type="text" class="form-control" name="issue" id="issue" placeholder="" value="<?php echo $issue; ?>" />
                        </div>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
                    <div class="form-group">
                        <label for="varchar" class="col-sm-2 control-label"></label>
                        <div class="col-sm-10"> 
                            <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                            <a href="<?php echo site_url('cms/feedback') ?>" class="btn btn-default">Cancel</a>
                        </div>
                    </div>

                </form>

            </div> </div>
    </section>
</div>
