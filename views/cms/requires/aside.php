<aside class="main-sidebar">

<section class="sidebar">
  <ul class="sidebar-menu"> 
	<!-- Optionally, you can add icons to the links -->
	<?php 
	/* if(in_array("2",$cms_user_rights)){ 
		echo '<li><a href="admin_settings.php"><i class="fa fa-file pull-right top60pc"></i> <span>Admin Settings</span></a></li>';	 
	}
	if(in_array("3",$cms_user_rights)){
		echo '<li><a href="applications_status.php"><i class="fa fa-link pull-right top60pc"></i> <span>Dept. Applications Status</span></a></li>';	 
	}
	if(in_array("4",$cms_user_rights)){
		echo '<li><a href="approvals.php"><i class="fa fa-link pull-right top60pc"></i> <span>List of Approvals</span></a></li>';	 
	}
	if(in_array("5",$cms_user_rights)){
		echo '<li><a href="notifications_list.php?ntype=1"><i class="fa fa-industry pull-right top60pc"></i> <span>Notifications</span></a></li>';	 
	}
	if(in_array("6",$cms_user_rights)){
		echo '<li><a href="notifications_list.php?ntype=2"><i class="fa fa-suitcase pull-right top60pc"></i> <span>Public Comments on Draft Notifications</span></a></li>';	 
	}
	if(in_array("7",$cms_user_rights)){
		echo '<li><a href="grievances.php"><i class="fa fa-file-o pull-right top60pc"></i> <span>Public Grievances</span></a></li>';	 
	}
	if(in_array("8",$cms_user_rights)){
		echo '<li><a href="feedbacks.php"><i class="fa fa-suitcase pull-right top60pc"></i> <span>Feedbacks</span></a></li>';	 
	}
	if(in_array("9",$cms_user_rights)){
		echo '<li><a href="department_reports.php"><i class="fa fa-suitcase pull-right top60pc"></i> <span>Status Report</span></a></li>';	 
	} */
	
	
	?>
        <li><a href="<?= base_url(); ?>cms/approvals"><i class="fa fa-certificate pull-right top60pc"></i> <span>Approvals</span></a></li>
        <li><a href="<?= base_url(); ?>cms/notifications"><i class="fa fa-clipboard pull-right top60pc"></i> <span>Notifications</span></a></li>
        <li><a href="<?= base_url(); ?>cms/feedback/"><i class="fa fa-feed pull-right top60pc"></i> <span>Feedback</span></a></li>
        <li><a href="<?= base_url(); ?>cms/grievance/"><i class="fa fa-certificate pull-right top60pc"></i> <span>Greivence</span></a></li>
        <li><a href="<?= base_url(); ?>cms/deptpayments/"><i class="fa fa-money pull-right top60pc"></i> <span>Payment Reports</span></a></li>
        <li><a href="<?= base_url(); ?>cms/deptreports/"><i class="fa fa-file pull-right top60pc"></i> <span>Application Reports</span></a></li>
  </ul>
  <!-- /.sidebar-menu -->
</section>
<!-- /.sidebar -->
</aside>
