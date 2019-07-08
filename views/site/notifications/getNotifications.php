<?php if (count($results) < 0) { ?>
<div class="alert alert-warning alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <b style="color: red">No Records Found!</b>
</div>
<?php } else { ?>
<table class="table table-bordered">
    <thead>
        <tr>
            <th style="width:120px">Date</th>
            <th style="width:230px">Notification No.</th>
            <th>Subject</th>
            <th>Issuing Authority</th>
            <th style="text-align:center">Sample</th>
        </tr>
    </thead>
    <tbody>                        
    <?php 
    $sl=1;
   foreach ($results as $rows) {
        $id = $rows->id;
        $post_name = $rows->post_name;
        $pieces = explode(" ", $post_name);
        $post_name1 = implode(" ", array_splice($pieces, 0, 3));
        if(str_word_count($post_name) > 3) $post_name1=$post_name1."..."; 
        
        $post = $rows->post; 
        $dept = $rows->dept; 
        $sub_dept = $rows->sub_dept;
        $Noti_no = $rows->Noti_no;
        $Noti_date = $rows->Noti_date;
        $issue_by = $rows->issue_by;
        $pieces = explode(" ", $issue_by);
        $issue_by1 = implode(" ", array_splice($pieces, 0, 3));
        if(str_word_count($issue_by) > 3) $issue_by1=$issue_by1."...";
        
        $pdf_file = $rows->pdf_file;
        $ntype = $rows->type;
        if($ntype ==1) $dlink = base_url()."homepage/notifications/images/".$pdf_file;
        else $dlink = base_url()."homepage/draft_post/images/".$pdf_file;

        if($pdf_file =="") $dwnld = "<button type='button' class='btn btn-info' disabled='disabled'><i class='glyphicon glyphicon-download'></i>Unavailable!</button>";
        else $dwnld = "<a href='".$dlink."' class='btn btn-info' target='_blank' data-toggle='tooltip' title='Download ".$pdf_file."'><i class='glyphicon glyphicon-download'></i> Download</a>";
        ?>
        <tr>
            <td style="text-align: left"><?php echo date("d-m-Y", strtotime($Noti_date)); ?></td>
            <td style="text-align: left"><?php echo $Noti_no; ?></td>
            <td style="text-align: left" data-container="body" data-toggle="tooltip" title="<?php echo $post_name; ?>">
                <?php echo $post_name1; ?>                
            </td>
            <td style="text-align: left" data-container="body" data-toggle="tooltip" title="<?php echo $issue_by; ?>">
                <?php echo $issue_by1; ?>
            </td>
            <td style="text-align: center"><?php echo $dwnld; ?></td>
        </tr>
    <?php $sl++; } // End of while ?>
    </tbody>
</table>
<?php if (isset($links)) { ?>
                <?php echo $links ?>
            <?php } ?>
<?php } // End of if else ?>
<script>$("[data-toggle='tooltip']").tooltip();</script>
