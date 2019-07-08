<?php
if(isset($result)) {
    $utype_id = $result->utype_id;
    $utype_name = $result->utype_name;
} else {
    $utype_id = "";
    $utype_name = set_value("utype_name");
}
$dept_code = $this->session->staff_dept; 
if ($this->session->flashdata("flashMsg")) { ?>
        <script>$.notify("<?= $this->session->flashdata("flashMsg"); ?>", "error");</script>
<?php } ?>
<div class="box box-primary box-alm">
    <h3 class="boxalm-head">
        Levels
        <a href="javascript:history.back(-1)" class="btn btn-default backbtn-alm">
            <i class="fa fa-chevron-circle-left"></i> Back
        </a>
    </h3>
    <form action="<?=base_url('admin/levels/save')?>" method="post">
        <input name="utype_id" value="<?=$utype_id?>" type="hidden" />
        <table class="table bg-gray-light" style="width:500px; margin: 5px auto">
            <tbody>
                <tr>
                    <td>
                        <input name="utype_name" value="<?=$utype_name?>" placeholder="Type a new level name" class="form-control dp" type="text" />
                        <font style="color: red; font-size: 10px"><?=form_error("utype_name")?></font>
                    </td>
                    <td style="width:100px; text-align: center">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-check-circle"></i>
                            Submit
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
    
    <table class="table table-bordered table-responsive" id="dtbl">
        <thead>
            <tr class="success">
                <th>#</th>
                <th>Level</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>            
            <?php
            if($this->utypes_model->get_rows($dept_code)) {
            $sl=1;
            foreach($this->utypes_model->get_rows($dept_code) as $rows) {
                $utype_id = $rows->utype_id;
                $utype_name = $rows->utype_name;
                ?>
            <tr>
                <td><?=sprintf("%02d", $sl)?></td>
                <td><?=$utype_name?></td>
                <td class="text-center">                    
                    <a class="btn btn-primary" href="<?=base_url('admin/levels/index/').$utype_id?>">
                        <i class="fa fa-pencil"></i> Modify
                    </a>
                </td>
            </tr>
            <?php $sl++; } } ?>
        </tbody>
    </table>
</div>