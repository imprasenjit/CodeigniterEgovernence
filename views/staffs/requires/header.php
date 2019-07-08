<?php 
//print_r($this->session->userdata());die();
$staff_id = $dept_code = $this->session->staff_id;
$dept = $dept_code = $this->session->staff_dept;
$office_id = $this->session->office_id;
$rightsArray = explode(",", $this->session->staff_rights);
?>

<header class="main-header">
    <nav class="navbar navbar-static-top" role="navigation">
        <a href="<?= base_url('staffs/'); ?>" class="navbar-brand" style="padding-left: 10px; width: 210px; font-weight: bold; letter-spacing: 1px">
            <i class="glyphicon glyphicon-home"></i>&nbsp;DASHBOARD
        </a>
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="hidden-xs">
                    <form role="search" id="track_form" class="navbar-form navbar-left" action="<?= base_url('public/') . "homepage/ovs.php"; ?>" method="get" target="_blank">
                        <label class="trackyourApp">Track User </label>
                        <div class="form-group">
                            <input type="text" placeholder="Enter UBIN/UAIN" id="navbar-search-input" name="token" class="form-control custom-search" style="background: #fff">
                        </div>
                    </form>
                </li>
                <li class="hidden-xs">
                    <a href="<?=base_url('staffs/einspections')?>">
                        <i class="fa fa-envelope-o"></i> <span class="hidden-xs">E-Inspection</span>
                    </a>
                </li>
                <li class="messages-menu">
                    <a href="<?=base_url('staffs/myapplications')?>" class="dropdown-toggle"  data-toggle="tooltip" data-placement="bottom" title="Pending applications at your end which are not processed yet.">
                        <i class="fa fa-files-o"></i> <span class="hidden-xs">My Applications </span>
                        <span class="label label-warning " id="header_my_applications_total"></span>
                    </a>
                </li>
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="user-image fa fa-user fa-2x"></i>
                        <span class="hidden-xs"><?= $this->session->staff_name; ?></span>
                    </a>
                    <ul class="dropdown-menu"> 
                        <li class="user-body">
                            <a href="<?=base_url('staffs/myprofile')?>"><i class="fa fa-user pull-right"></i>My Profile</a>
                        </li>
                        <li class="user-body">
                            <a href="<?=base_url('staffs/editprofile')?>"><i class="fa fa-database pull-right"></i>Edit Profile</a>
                        </li>	
                        <li class="user-body">
                            <a href="javascript:void(0)" data-toggle="modal" data-target="#changepassModal"><i class="fa fa-cog pull-right"></i>Change Password</a>        
                        </li>
                        <li class="user-body">	
                            <a href="<?=base_url('staffs/login/logout')?>"><i class="fa fa-sign-out pull-right"></i>Sign Out</a>	
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
<?php $this->load->view('staffs/requires/changepassModal'); ?>