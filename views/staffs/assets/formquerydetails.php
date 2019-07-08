<?php $queryRows = $this->queriedapplications_model->get_uainrows($this->uain); ?>
<div class="box box-primary box-alm">
    <div class="text-center"><h3>Query Details</h3></div>
    <table class="table table-bordered table-responsive" id="appstbl">
        <thead>
            <tr class="success">
                <th>Query Date & Time</th>
                <th>Subject</th>
                <th>Message</th>
            </tr>
        </thead>
        <tbody>
            <?php if($queryRows) {
                foreach($queryRows as $qrows) {
                    $query_from = $qrows->query_from;
                    $subject = $qrows->subject;
                    $message = $qrows->msg;
                    $document = $qrows->document;
                    $queried_date = date("d-m-Y h:i A", strtotime($qrows->q_date)); ?>                    
                    <tr>
                        <td><?=$queried_date?></td>
                        <td><?=$subject?></td>
                        <td><?=$message?></td>
                    </tr><?php
                }//End of foreach()
            } ?>
        </tbody>
    </table>
</div><!--End of .box-alm-->