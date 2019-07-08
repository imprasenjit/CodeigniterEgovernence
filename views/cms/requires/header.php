<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?= $title; ?></title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="author" content="Single window Agency, Govt of Assam" />
        <meta name="description" content="ease of doing business assam eodb investment business industry factory registrations approvals applications" />
        <meta name="keywords" content="ease of doing business assam eodb investment business industry factory registrations approvals applications" />
        <meta name="Resource-type" content="Document" />
        <link rel="icon" href="<?= base_url('public/'); ?>imgs/favicon.ico" type="image/ico">
        <link rel="stylesheet" type="text/css" href="<?= base_url('public/'); ?>bootstrap-3.3.7/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="<?= base_url('public/'); ?>font-awesome-4.7.0/css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="<?= base_url('public/'); ?>css/AdminLTE.min.css" />
        <link rel="stylesheet" type="text/css" href="<?= base_url('public/'); ?>css/skins/_all-skins.min.css" />
        <link rel="stylesheet" type="text/css" href="<?= base_url('public/'); ?>css/datatables.css" />
        <link rel="stylesheet" type="text/css" href="<?= base_url('public/'); ?>css/cms.css" />
        <script src="<?= base_url('public/'); ?>js/jquery-3.2.1.min.js"></script>
        <script src="<?= base_url('public/'); ?>bootstrap-3.3.7/js/bootstrap.min.js"></script>
        <script src="<?= base_url('public/'); ?>js/notify.min.js"></script>
        <script src="<?= base_url('public/'); ?>js/jquery.slimscroll.min.js"></script>
        <script src='<?= base_url('public/'); ?>js/tinymce.min.js'></script>
    </head>
    <body class="hold-transition skin-blue fixed" data-target="#scrollspy" data-spy="scroll">

        <div class="wrapper">
            <!-- Main Header -->            

            <header class="main-header">
                <!-- Header Navbar -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->

                    <a href="<?php echo base_url(); ?>cms" class="navbar-brand" style="width: 210px; font-weight: bold; letter-spacing: 1px">
                        <i class="glyphicon glyphicon-home"></i> &nbsp; DASHBOARD
                    </a>

                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <a href="javascript:history.back(-1)" class="btn btn-warning" style="font-size:18px; font-weight:bold; margin: 5px">
                        <i class="fa fa-angle-double-left"></i> Back
                    </a>
                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <li class="hidden-xs">
                                <form role="search" id="track_form" class="navbar-form navbar-left" action="<?php echo base_url(); ?>track.php" method="get">
                                    <label class="trackyourApp">Track User </label>
                                    <div class="form-group">
                                        <input type="text" placeholder="Enter UBIN/UAIN" id="navbar-search-input" name="token" class="form-control custom-search"><!-- id="navbar-search-input"-->
                                    </div>
                                </form>
                            </li>

                           <!-- <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-files-o"></i><span class="hidden-xs">Know Your Approvals</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="user-body">
                                        <a href="<?= base_url(); ?>kya_industries.php">
                                            <i class="fa fa-calendar pull-right"></i>Business Classification
                                        </a>
                                    </li>
                                    <li class="user-body">
                                        <a href="<?= base_url(); ?>kya_list.php">
                                            <i class="fa fa-list pull-right"></i>KYA List
                                        </a>        
                                    </li>
                                    <li class="user-body">
                                        <a href="<?= base_url(); ?>kya_linkings.php">
                                            <i class="fa fa-sitemap pull-right"></i>KYA Linking
                                        </a>        
                                    </li>
                                </ul>
                            </li>

                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-files-o"></i><span class="hidden-xs">CAF Status</span>
                                </a>
                                <ul class="dropdown-menu">         			 
                                    <li class="user-body">
                                        <a href="<?php echo base_url(); ?>unapproved_unit_forms.php"><i class="fa fa-database pull-right"></i>Unapproved Forms</a>
                                    </li>    			 
                                    <li class="user-body">
                                        <a href="<?php echo base_url(); ?>underquery_unit_forms.php"><i class="fa fa-database pull-right"></i>Under Query Forms</a>
                                    </li>
                                    <li class="user-body">
                                        <a href="<?php echo base_url(); ?>unit_form.php"><i class="fa fa-database pull-right"></i>Approved Forms</a>
                                    </li>	
                                    <li class="user-body">
                                        <a href="<?php echo base_url(); ?>draft_unit_forms.php"><i class="fa fa-cog pull-right"></i>Draft Forms</a>        
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-users"></i><span class="hidden-xs">User Management</span>
                                </a>
                                <ul class="dropdown-menu">         			 
                                    <li class="user-body">
                                        <a href="<?php echo base_url(); ?>unverified_users.php"><i class="fa fa-database pull-right"></i>Unverified Users</a>
                                    </li>
                                    <li class="user-body">
                                        <a href="<?php echo base_url(); ?>verified_users.php"><i class="fa fa-database pull-right"></i>Verified Users</a>
                                    </li>
                                </ul>
                            </li>-->
                            <!-- Tasks Menu Removed From Here-->

                            <!-- User Account Menu -->
                            <li class="dropdown user user-menu">
                                <!-- Menu Toggle Button -->
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <!-- The user image in the navbar-->
                                    <i class="user-image fa fa-user fa-2x"></i>
                                    <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                    <span class="hidden-xs"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="user-body">
                                        <a href="#!" data-toggle="modal" data-target="#view_profile"><i class="fa fa-user pull-right"></i> My Profile</a>
                                    </li>
                                    <!--<li class="user-body">
                                    <a href="#!" data-toggle="modal" data-target="#edit_profile"><i class="fa fa-database pull-right"></i> Edit Profile</a>
                                    </li>	-->
                                    <li class="user-body">
                                        <a href="#!" data-toggle="modal" data-target="#changePassword"><i class="fa fa-cog pull-right"></i> Change Password</a>        
                                    </li>
                                    <li class="user-body">	
                                        <a href="<?php echo base_url(); ?>viewmail.php"><i class="fa fa-sign-out pull-right"></i> View Mails</a>	
                                    </li>
                                    <li class="user-body">	
                                        <a href="<?php echo base_url("cms/login/logout"); ?>"><i class="fa fa-sign-out pull-right"></i> Sign Out</a>	
                                    </li>	
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>

            <div id="loaderDiv"></div>
            <?php $this->load->view("cms/requires/aside"); ?>