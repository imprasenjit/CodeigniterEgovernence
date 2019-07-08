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
        <h2 style="margin-top:0px">Grievance_redressal Read</h2>
        <table class="table">
	    <tr><td>complaint_no</td><td><?php echo $complaint_no; ?></td></tr>
	    <tr><td>user_id</td><td><?php echo $user_id; ?></td></tr>
	    <tr><td>dept</td><td><?php echo $dept; ?></td></tr>
	    <tr><td>subject</td><td><?php echo $subject; ?></td></tr>
	    <tr><td>message</td><td><?php echo $message; ?></td></tr>
	    <tr><td>document</td><td><?php echo $document; ?></td></tr>
	    <tr><td>ip_address</td><td><?php echo $ip_address; ?></td></tr>
	    <tr><td>g_date</td><td><?php echo $g_date; ?></td></tr>
	    <tr><td>active</td><td><?php echo $active; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('grivance') ?>" class="btn btn-default">Cancel</button></td></tr>
	</table>
    </body>
</html>