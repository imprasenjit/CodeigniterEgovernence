<?php
$id = $this->uri->segment(4);
$notification = $this->notifications_model->getNotification($id);
?>
<link rel="stylesheet" type="text/css" href="<?= base_url('public/'); ?>css/datetimepicker.css" />
<div class="content-wrapper">		
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h2>
                    <a href="./" class="btn btn-default">
                        <i class="glyphicon glyphicon-chevron-left" style="font-weight: bold"></i>Back
                    </a>
                    View Notification
                </h2>
            </div>
            <div class="box-body">
                <div id="loader-wrapper">
                    <div id="loader"></div>
                </div>
                <form action="#!" id="addnotification">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Department <span class="text-danger">*</span></label>
                            <h4><?=$this->getDepartments_model->get($notification->dept)->name;?></h4>
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Sub Department <span class="text-danger">*</span></label>
                            <h4><?= $this->getSubDepartment_model->get_deptbyid($notification->sub_dept)->name;?></h4>
                        </div>
                    </div> <!-- End of .row -->

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <br />
                            <label>Please Select Type of Notification <span class="text-danger">*</span></label>

                            <label class="radio-inline">
                                <input type="radio" value="1" name="notification_type" <?php  if($notification->type==1)echo 'checked="checked" ';?> >Notification/Office Memo
                            </label>
                            <label class="radio-inline">
                                <input type="radio" value="2" name="notification_type" <?php  if($notification->type==2)echo 'checked="checked" ';?> >Draft / Policies
                            </label>

                        </div>

                        <div class="col-md-3 form-group">
                            <label>Notification/Publication Date <span class="text-danger">*</span></label>
                            <h4><?=date("d-m-Y", strtotime($notification->Noti_date)) ;?></h4>
                        </div>
                        <div class="col-md-3 form-group" id="endDate" style="display:none">
                            <label>End Date <span class="text-danger">*</span></label>
                            <h4><?=date("d-m-Y", strtotime($notification->valid_date)) ;?></h4>
                        </div>
                    </div> <!-- End of .row -->

                    <div class="row">
                        <div class=" col-md-6 form-group">
                            <label>Notification No <span class="text-danger">*</span></label>
                            <h4><?=$notification->Noti_no;?></h4>
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Issuing Authority <span class="text-danger">*</span></label>
                           <h4><?=$notification->issue_by;?></h4>
                        </div>
                    </div> <!-- End of .row -->

                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label>Subject <span class="text-danger">*</span></label>
                             <h4><?=$notification->post_name;?></h4>
                        </div>
                    </div> <!-- End of .row -->

                    <div class="row">
                        <div class=" col-md-12 form-group">
                            <label>Brief Description <span class="text-danger">*</span></label>
                            <h4><?=$notification->post;?></h4>
                        </div>
                    </div> <!-- End of .row -->

                    <div class="row">
                        <div class="col-md-12">
                             <a href="<?=$notification->pdf_file;?>" target="_blank" class="btn btn-primary">View File</a>
                        </div>
                    </div> <!-- End of .row -->

                    <div class="row" style="padding-top:10px">
                        <div class="col-md-12 text-center">
                            <a href="<?= base_url("cms/notifications/"); ?>" class="btn btn-info">
                                <i class="glyphicon glyphicon-eye-open" style="font-weight: bold"></i> View All
                            </a>
                        </div>
                    </div> <!-- End of .row -->
                </form>
            </div>
        </div>
    </section>
</div>