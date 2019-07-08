<h2 style="margin-top:0px">Feedback_records <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
                <label for="varchar"> <?php echo form_error('name') ?></label>
                <input type="text" class="form-control" name="name" id="name" placeholder="" value="<?php echo $name; ?>" />
            </div>
	    <div class="form-group">
                <label for="varchar">name <?php echo form_error('business_name') ?></label>
                <input type="text" class="form-control" name="business_name" id="business_name" placeholder="name" value="<?php echo $business_name; ?>" />
            </div>
	    <div class="form-group">
                <label for="varchar"> <?php echo form_error('email') ?></label>
                <input type="text" class="form-control" name="email" id="email" placeholder="" value="<?php echo $email; ?>" />
            </div>
	    <div class="form-group">
                <label for="bigint">no <?php echo form_error('phone_no') ?></label>
                <input type="text" class="form-control" name="phone_no" id="phone_no" placeholder="no" value="<?php echo $phone_no; ?>" />
            </div>
	    <div class="form-group">
                <label for="enq_msg">msg <?php echo form_error('enq_msg') ?></label>
                <textarea class="form-control" rows="3" name="enq_msg" id="enq_msg" placeholder="msg"><?php echo $enq_msg; ?></textarea>
            </div>
	    <div class="form-group">
                <label for="varchar"> <?php echo form_error('dept') ?></label>
                <input type="text" class="form-control" name="dept" id="dept" placeholder="" value="<?php echo $dept; ?>" />
            </div>
	    <div class="form-group">
                <label for="varchar"> <?php echo form_error('issue') ?></label>
                <input type="text" class="form-control" name="issue" id="issue" placeholder="" value="<?php echo $issue; ?>" />
            </div>
	    <div class="form-group">
                <label for="datetime">date <?php echo form_error('issue_date') ?></label>
                <input type="text" class="form-control" name="issue_date" id="issue_date" placeholder="date" value="<?php echo $issue_date; ?>" />
            </div>
	    <div class="form-group">
                <label for="varchar">address <?php echo form_error('ip_address') ?></label>
                <input type="text" class="form-control" name="ip_address" id="ip_address" placeholder="address" value="<?php echo $ip_address; ?>" />
            </div>
	    <div class="form-group">
                <label for="enum"> <?php echo form_error('active') ?></label>
                <input type="text" class="form-control" name="active" id="active" placeholder="" value="<?php echo $active; ?>" />
            </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('feedback_new') ?>" class="btn btn-default">Cancel</a>
	</form>