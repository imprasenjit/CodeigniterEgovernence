<div class="modal fade" id="verificationUploadModal" tabindex="-1" role="dialog" aria-labelledby="verificationUploadModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="verificationUploadModalLabel">Upload Verification Report</h4>
            </div>
            <form action="<?=base_url('staffs/uploadverificationreport/save')?>" method="post" enctype="multipart/form-data">
                <div class="modal-body text-left">
                    <input type="hidden" name="inspectionid" id="inspectionid" />
                    <input type="file" name="reportfile" id="file1" />                    
                    <textarea name="remarks" class="form-control" placeholder="Remarks" style="margin:4px auto"></textarea>
                </div><!--End of .modal-body-->
                <div class="modal-footer" style="text-align: center">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                        <i class="fa fa-remove"></i>
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-cloud-upload"></i>
                        Upload
                    </button>
                </div><!--End of modal-footer-->
            </form><!--End of form -->
        </div><!--End of .modal-content-->
    </div><!--End of modal-dialog-->
</div> <!-- End of #verificationUploadModal -->