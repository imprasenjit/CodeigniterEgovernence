<div class="content-wrapper background-white">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h2>Change Password </h2>
            <?php if ($this->session->flashdata("flashMsg")) { ?>

                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <?= $this->session->flashdata("flashMsg"); ?>
                </div>

            <?php } ?>
            <form action="<?= base_url("users/home/dochangepassword/"); ?>" method="post" > 
                <div class="form-group">
                    <label for="">Old Password</label>
                    <input type="password" class="form-control" id="" name="old_password" placeholder="Old Password">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword2">New Password</label>
                    <input type="password" class="form-control" id="" name="password" placeholder="New Password">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword3">Confirm Password</label>
                    <input type="password" class="form-control" id="" name="cfmPassword" placeholder="Retype New Password">
                </div>
                <button type="submit" name="change" class="btn btn-primary pull-right">Submit</button>
            </form>  
        </div>
    </div>
</div>

