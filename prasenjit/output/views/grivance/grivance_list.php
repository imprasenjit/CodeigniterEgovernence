
        <h2 style="margin-top:0px">Grievance_redressal List</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('grivance/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <form action="<?php echo site_url('grivance/search/'); ?>" class="form-inline" method="post">
                    
<input name="keyword" class="form-control" value="<?php echo $keyword; ?>" />
                    <?php 
                    if ($keyword <> '')
                    {
                        ?>
                        <a href="<?php echo site_url('grivance'); ?>" class="btn btn-default">Reset</a>
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
		<th>no</th>
		<th>id</th>
		<th></th>
		<th></th>
		<th></th>
		<th></th>
		<th>address</th>
		<th>date</th>
		<th></th>
		<th width="27%">Action</th>
            </tr><?php
            foreach ($grivance_data as $grivance)
            {
                ?>
                <tr>
			<td><?php echo ++$start ?></td>
			<td><?php echo $grivance->complaint_no ?></td>
			<td><?php echo $grivance->user_id ?></td>
			<td><?php echo $grivance->dept ?></td>
			<td><?php echo $grivance->subject ?></td>
			<td><?php echo $grivance->message ?></td>
			<td><?php echo $grivance->document ?></td>
			<td><?php echo $grivance->ip_address ?></td>
			<td><?php echo $grivance->g_date ?></td>
			<td><?php echo $grivance->active ?></td>
			<td style="text-align:center">
				<?php 
				echo anchor(site_url('grivance/read/'.$grivance->g_id),'<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>&nbsp;View',array('class' => 'btn btn-primary'))."&nbsp;";
				
				echo anchor(site_url('grivance/update/'.$grivance->g_id),'<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>&nbsp;Edit',array('class' => 'btn btn-warning'))."&nbsp;"; 
				
				echo anchor(site_url('grivance/delete/'.$grivance->g_id),'<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>&nbsp;Delete',array('class' => 'btn btn-danger','onclick'=>'return confirm(\'Are You Sure you want to delete?\')'))."&nbsp;";
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