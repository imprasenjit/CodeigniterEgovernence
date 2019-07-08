<div class="modal fade" id="changepassModal" tabindex="-1" role="dialog" aria-labelledby="changepassModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="changepassModalLabel">Chnage Password</h4>
            </div>
            <div class="modal-body">
                <form action="change_password.php" method="post" enctype="multipart/form-data"> 
                    <div class="form-group">
                        <label for="">Old Password</label>
                        <input type="password" required="required" class="form-control" id="" name="old_password" placeholder="Old Password">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword2">New Password</label>
                        <input type="password" required="required" class="form-control" id="" name="password" placeholder="New Password">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword3">Confirm Password</label>
                        <input type="password" required="required" class="form-control" id="" name="cfmPassword" placeholder="Retype New Password">
                    </div>
                    <div align="center">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">
                            <i class="fa fa-remove"></i> Close                                
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-check"></i>Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>