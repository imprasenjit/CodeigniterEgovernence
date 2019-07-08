<div class="modal fade" id="inspectionViewModal" tabindex="-1" role="dialog" aria-labelledby="inspectionViewModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="inspectionViewModalLabel">Inspection Details</h4>
            </div>
            <div class="modal-body" id="inspectionViewModalBody">

            </div>
            <div class="modal-footer" style="text-align: center">
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    <i class="fa fa-remove"></i>
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="inspectionRescheduleModal" tabindex="-1" role="dialog" aria-labelledby="inspectionRescheduleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="inspectionRescheduleModalLabel">Inspection Rescheduling</h4>
            </div>
            <form action="<?=base_url('staffs/einspections/reschedule')?>" method="post">
                <div class="modal-body" id="inspectionRescheduleModalBody">
                    <input type="hidden" name="einspectionId" id="einspectionId" />
                    <input type="text" name="reschedule_date" placeholder="New Date of Inspection" class="form-control dp" required="required" />
                    <br />
                    <textarea name="reschedule_reason" class="form-control" placeholder="Reason for Re-scheduling" ></textarea>
                </div>
                <div class="modal-footer" style="text-align: center">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                        <i class="fa fa-remove"></i>
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-pencil"></i>
                        Request Now
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="inspectionUploadModal" tabindex="-1" role="dialog" aria-labelledby="inspectionUploadModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="inspectionUploadModalLabel">Inspection Report Uploading</h4>
            </div>
            <form action="<?=base_url('staffs/einspections/reportupload')?>" method="post" enctype="multipart/form-data">
                <div class="modal-body text-left">
                    <input type="hidden" name="inspectionid" id="inspectionid" />
                    <input type="file" name="reportfile" id="file1" />                    
                    <textarea name="remarks" class="form-control" placeholder="Remarks" style="margin:4px auto"></textarea>
                </div>
                <div class="modal-footer" style="text-align: center">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                        <i class="fa fa-remove"></i>
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-cloud-upload"></i>
                        Upload
                    </button>
                </div>
            </form>
        </div>
    </div>
</div> <!-- End of #inspectionUploadModal -->