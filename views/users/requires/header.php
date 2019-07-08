<!DOCTYPE html>
<html>
    <head>
        <title><?= isset($title) ? $title : ""; ?> || USER AREA</title>
        <link rel="icon" href="<?= base_url('public/'); ?>imgs/favicon.ico" type="image/ico">
        <link rel="stylesheet" type="text/css" href="<?= base_url('public/'); ?>bootstrap-3.3.7/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="<?= base_url('public/'); ?>font-awesome-4.7.0/css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="<?= base_url('public/'); ?>css/animate.css" />
        <link rel="stylesheet" type="text/css" href="<?= base_url('public/'); ?>css/AdminLTE.min.css" />
        <link rel="stylesheet" type="text/css" href="<?= base_url('public/'); ?>css/datetimepicker.css" />
        <link rel="stylesheet" href="<?= base_url('public/'); ?>css/skins/_all-skins.min.css" />
        <link rel="stylesheet" href="<?= base_url('public/'); ?>css/users.css" />
        <link rel="stylesheet" href="<?= base_url('public/'); ?>css/userarea.css" />
        <script src="<?= base_url('public/'); ?>js/jquery-3.2.1.min.js"></script>
        <script src="<?= base_url('public/'); ?>bootstrap-3.3.7/js/bootstrap.min.js"></script>
        <script src="<?= base_url('public/'); ?>js/notify.min.js"></script>

        <?php //$this->load->view("users/requires/cssjs"); ?>
    </head>
    <body class="hold-transition skin-blue fixed" data-target="#scrollspy" data-spy="scroll">     
        <div class="wrapper">
            <header class="main-header">
                <nav class="navbar navbar-static-top" role="navigation">
                    <a href="<?= base_url('users/unit/'); ?>" class="logo"  style="width:120px; background: transparent; font-size: 14px !important; font-weight: bold">
                        <span class="logo-mini"><b>DASHBOARD</b></span>
                        <span class="logo-lg">DASHBOARD</span>
                    </a>
                    <a data-placement="bottom" title="EODB Website" href="<?= base_url('/'); ?>" class="homeTag">
                        <i class="fa fa-home fa-2x" style="color:#fff; line-height: 44px"></i> <span class="hidden-xs text-bold" style="color:#fff">EODB</span>
                    </a>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <?php if (isset($this->session->unit_id)) { ?>
                                <li class="hidden-xs">
                                    <form role="search" id="track_form" class="navbar-form navbar-left" action="<?= base_url('users/dashboard/'); ?>track_application" method="post">
                                        <label class="trackyourApp" style="color:#fff">Track Your Application <a href="#"><span style="color:#fff" data-toggle="tooltip" data-placement="bottom" title="Track your application status via Unique Application Identification Number" class="glyphicon glyphicon-question-sign"></span></a></label>
                                        <div class="form-group">
                                            <input type="text" placeholder="Enter UAIN" id="navbar-search-input" name="uain" class="form-control custom-search"><!-- id="navbar-search-input"-->
                                        </div>
										<button type="submit" class="btn btn-default">Track UAIN</button>
                                    </form>
                                </li>
                                <li data-toggle="tooltip" data-placement="bottom" title="Official Messages from the Department "  class="dropdown messages-menu">
                                    <a href="<?= base_url('users/dashboard/viewallmessages/' . $this->session->unit_id . ''); ?>">
                                        <i class="fa fa-envelope-o"></i> <span class="hidden-xs">My Inbox</span>
                                        <span class="label label-warning"><?= ""; //$unread_msg;     ?></span>
                                    </a>
                                </li>
                                <li  class="dropdown messages-menu">
                                    <a href="#!"  data-toggle="dropdown" class="dropdown-toggle">
                                        <i class="fa fa-files-o"></i> <span class="hidden-xs">My Applications</span>
                                        <span class="label label-warning"><?= ""; //$total_application;      ?></span>
                                    </a>
                                    <ul class="dropdown-menu" style="width: 220px;">     
                                        <li style="padding: 7px 0 7px 0;" data-toggle="tooltip" data-placement="left" title="All your submitted application forms are shown here for easy tracking and current status" class="user-body">
                                            <a href="<?= base_url("users/dashboard/viewallsubmittedapplications/" . $this->session->unit_id . ""); ?>"><i class="fa fa-database pull-right"></i>Submitted Applications</a>
                                        </li>     
                                        <li style="padding: 7px 0 7px 0;" data-toggle="tooltip" data-placement="left" title="All your incomplete application forms are shown here for edit and submit." class="user-body">
                                            <a href="<?= base_url("users/dashboard/viewallincompleteapplications/" . $this->session->unit_id . ""); ?>"><i class="fa fa-database pull-right"></i>Incomplete Applications</a>
                                        </li>  
                                    </ul>
                                </li>
                                <li data-toggle="tooltip" data-placement="bottom" title="E-Locker contains your uploaded documents for easy access." class="dropdown messages-menu">
                                    <!-- Menu toggle button -->
                                    <a  href="<?= base_url("users/dashboard/elocker/" . $this->session->unit_id . ""); ?>" class="">
                                        <i class="fa fa-lock"></i> <span class="hidden-xs">E-Locker</span>
                                        <span class="label label-success"></span>
                                    </a>

                                </li>
                                <li class="dropdown user user-menu">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="user-image fa fa-user fa-2x"></i>
                                        <span class="hidden-xs"><?= $this->session->user_name; ?></span>
                                    </a>
                                    <ul class="dropdown-menu" style="width: 220px;">
                                        <li class="user-body">
                                            <a href="<?= base_url('users/myprofile/'); ?>"><i class="fa fa-user pull-right"></i>My Profile</a>
                                        </li>
                                        <li class="user-body">
                                            <a href="<?= base_url("users/dashboard/changepassword/" . $this->session->unit_id . ""); ?>" ><i class="fa fa-cog pull-right"></i>Change Password</a>        
                                        </li>
                                        <li class="user-body">	
                                            <a href="<?= base_url('site/'); ?>login/logout"><i class="fa fa-sign-out pull-right"></i>Sign Out</a>	
                                        </li>
                                    </ul>
                                </li>
                            <?php } else { ?>
                                <li class="dropdown user user-menu">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="user-image fa fa-user fa-2x"></i>
                                        <span class="hidden-xs"><?= $this->session->user_name; ?></span>
                                    </a>
                                    <ul class="dropdown-menu" style="width: 220px;">
                                        <li class="user-body">
                                            <a href="<?= base_url("users/home/viewcaf/"); ?>" ><i class="fa fa-cog pull-right"></i>View CAF</a>        
                                        </li>
                                        <li class="user-body">
                                            <a href="<?= base_url("users/home/changepassword/"); ?>" ><i class="fa fa-cog pull-right"></i>Change Password</a>        
                                        </li>
                                        <li class="user-body">	
                                            <a href="<?= base_url('site/'); ?>login/logout"><i class="fa fa-sign-out pull-right"></i>Sign Out</a>	
                                        </li>
                                    </ul>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </nav>
            </header>
        </div>
