<h2 style="margin-top:0px">Grievance_redressal <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
                <label for="varchar">no <?php echo form_error('complaint_no') ?></label>
                <input type="text" class="form-control" name="complaint_no" id="complaint_no" placeholder="no" value="<?php echo $complaint_no; ?>" />
            </div>
	    <div class="form-group">
                <label for="int">id <?php echo form_error('user_id') ?></label>
                <input type="text" class="form-control" name="user_id" id="user_id" placeholder="id" value="<?php echo $user_id; ?>" />
            </div>
	    <div class="form-group">
                <label for="varchar"> <?php echo form_error('dept') ?></label>
                <input type="text" class="form-control" name="dept" id="dept" placeholder="" value="<?php echo $dept; ?>" />
            </div>
	    <div class="form-group">
                <label for="varchar"> <?php echo form_error('subject') ?></label>
                <input type="text" class="form-control" name="subject" id="subject" placeholder="" value="<?php echo $subject; ?>" />
            </div>
	    <div class="form-group">
                <label for="varchar"> <?php echo form_error('message') ?></label>
                <input type="text" class="form-control" name="message" id="message" placeholder="" value="<?php echo $message; ?>" />
            </div>
	    <div class="form-group">
                <label for="varchar"> <?php echo form_error('document') ?></label>
                <input type="text" class="form-control" name="document" id="document" placeholder="" value="<?php echo $document; ?>" />
            </div>
	    <div class="form-group">
                <label for="varchar">address <?php echo form_error('ip_address') ?></label>
                <input type="text" class="form-control" name="ip_address" id="ip_address" placeholder="address" value="<?php echo $ip_address; ?>" />
            </div>
	    <div class="form-group">
                <label for="datetime">date <?php echo form_error('g_date') ?></label>
                <input type="text" class="form-control" name="g_date" id="g_date" placeholder="date" value="<?php echo $g_date; ?>" />
            </div>
	    <div class="form-group">
                <label for="enum"> <?php echo form_error('active') ?></label>
                <input type="text" class="form-control" name="active" id="active" placeholder="" value="<?php echo $active; ?>" />
            </div>
	    <input type="hidden" name="g_id" value="<?php echo $g_id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('grivance') ?>" class="btn btn-default">Cancel</a>
	</form>