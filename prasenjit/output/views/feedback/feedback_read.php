<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Feedback_records Read</h2>
        <table class="table">
	    <tr><td>name</td><td><?php echo $name; ?></td></tr>
	    <tr><td>business_name</td><td><?php echo $business_name; ?></td></tr>
	    <tr><td>email</td><td><?php echo $email; ?></td></tr>
	    <tr><td>phone_no</td><td><?php echo $phone_no; ?></td></tr>
	    <tr><td>enq_msg</td><td><?php echo $enq_msg; ?></td></tr>
	    <tr><td>dept</td><td><?php echo $dept; ?></td></tr>
	    <tr><td>issue</td><td><?php echo $issue; ?></td></tr>
	    <tr><td>issue_date</td><td><?php echo $issue_date; ?></td></tr>
	    <tr><td>ip_address</td><td><?php echo $ip_address; ?></td></tr>
	    <tr><td>active</td><td><?php echo $active; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('feedback_new') ?>" class="btn btn-default">Cancel</button></td></tr>
	</table>
    </body>
</html>