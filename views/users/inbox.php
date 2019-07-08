<?php if ($this->session->flashdata("successMsg")) { ?>
    <script>$.notify("<?= $this->session->flashdata("successMsg"); ?>", "success");</script>
<?php } ?>
<?php if ($this->session->flashdata("errorMsg")) { ?>
    <script>$.notify("<?= $this->session->flashdata("errorMsg"); ?>", "error");</script>
<?php } ?>
<div class="content-wrapper" style="padding:80px 10px 20px 10px">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border text-center">
                    <h2>Inbox</h2>
                </div>
                <!-- /.box-header -->
                <div class="box-body" id="active_ubin">
                    
                </div>
            </div>
        </div> <!--End of .row -->
    </div> <!--End of .content-wrapper -->
</div> <!--End of .content-wrapper -->
</div> <!--End of .wrapper -->
    
<?php $this->load->view("users/requires/usersModal"); ?>

