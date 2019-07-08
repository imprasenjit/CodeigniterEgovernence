
        <h2 style="margin-top:0px">Feedback_records List</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('feedback_new/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <form action="<?php echo site_url('feedback_new/search/'); ?>" class="form-inline" method="post">
                    
<input name="keyword" class="form-control" value="<?php echo $keyword; ?>" />
                    <?php 
                    if ($keyword <> '')
                    {
                        ?>
                        <a href="<?php echo site_url('feedback_new'); ?>" class="btn btn-default">Reset</a>
                        <?php
                    }
                    ?>
                    <input type="submit" value="Search" class="btn btn-primary" />
                </form>
            </div>
        </div>
        <table class="table table-condensed table-hover" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th></th>
		<th>name</th>
		<th></th>
		<th>no</th>
		<th>msg</th>
		<th></th>
		<th></th>
		<th>date</th>
		<th>address</th>
		<th></th>
		<th width="27%">Action</th>
            </tr><?php
            foreach ($feedback_new_data as $feedback_new)
            {
                ?>
                <tr>
			<td><?php echo ++$start ?></td>
			<td><?php echo $feedback_new->name ?></td>
			<td><?php echo $feedback_new->business_name ?></td>
			<td><?php echo $feedback_new->email ?></td>
			<td><?php echo $feedback_new->phone_no ?></td>
			<td><?php echo $feedback_new->enq_msg ?></td>
			<td><?php echo $feedback_new->dept ?></td>
			<td><?php echo $feedback_new->issue ?></td>
			<td><?php echo $feedback_new->issue_date ?></td>
			<td><?php echo $feedback_new->ip_address ?></td>
			<td><?php echo $feedback_new->active ?></td>
			<td style="text-align:center">
				<?php 
				echo anchor(site_url('feedback_new/read/'.$feedback_new->id),'<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>&nbsp;View',array('class' => 'btn btn-primary'))."&nbsp;";
				
				echo anchor(site_url('feedback_new/update/'.$feedback_new->id),'<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>&nbsp;Edit',array('class' => 'btn btn-warning'))."&nbsp;"; 
				
				echo anchor(site_url('feedback_new/delete/'.$feedback_new->id),'<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>&nbsp;Delete',array('class' => 'btn btn-danger','onclick'=>'return confirm(\'Are You Sure you want to delete?\')'))."&nbsp;";
				?>
			</td>
		</tr>
                <?php
            }
            ?>
        </table>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>