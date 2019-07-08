<!DOCTYPE html>
<html>
<head>
<title>Welcome to EODB</title>
<link href="<?= base_url()?>public/imgs/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<link href="<?= base_url('public/'); ?>bootstrap-3.3.7/css/bootstrap.min.css" rel="stylesheet">
<style type="text/css">
body { 
    background: #F5F5F5;
    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
}
.error-template {
    padding: 40px 15px;
    text-align: center;
}
h1 {
    margin-top: 10%;
    font-size: 36px;
    line-height: 38px;
}
h2 {
    border-bottom:2px solid #333;
}
.error-details {
    font-size: 16px;
}
.error-actions {
    margin-top:15px;
    margin-bottom:15px;
}
.error-actions .btn { 
    margin-right:10px; 
}
</style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="error-template">
                <h1><span class="glyphicon glyphicon-warning-sign"></span> EODB!</h1>
                <h2>Modules</h2>
                <div class="error-details">
                    Please choose one of the following module:
                </div>
                <div class="error-actions">
                    <a href="<?= base_url('admin/'); ?>" class="btn btn-primary btn-lg">
                        <span class="glyphicon glyphicon-home"></span>
                        Admin 
                    </a>
                    <a href="<?= base_url('cms/'); ?>" class="btn btn-primary btn-lg">
                        <span class="glyphicon glyphicon-credit-card"></span>
                        CMS 
                    </a>
                    <a href="<?= base_url('users/'); ?>" class="btn btn-primary btn-lg">
                        <span class="glyphicon glyphicon-user"></span>
                        Users 
                    </a>
                    <a href="<?= base_url('staffs/'); ?>" class="btn btn-primary btn-lg">
                        <span class="glyphicon glyphicon-pencil"></span>
                        Staff 
                    </a>
                    <a href="<?= base_url('forms/'); ?>" class="btn btn-primary btn-lg">
                        <span class="glyphicon glyphicon-file"></span>
                        Forms/Departments 
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>