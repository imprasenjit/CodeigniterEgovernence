<div class="content-wrapper">		

    <section class="content">

        <div class="box box-primary"> 

            <div class="box-header with-border">

                <h2>Feedback Details</h2>

            </div>
            <div class="box-body" id="boxbody">
                
                <table class="table">
                    <tr><td>Name</td><td><?php echo $name; ?></td></tr>
                    <tr><td>Business Name</td><td><?php echo $business_name; ?></td></tr>
                    <tr><td>Email</td><td><?php echo $email; ?></td></tr>
                    <tr><td>Phone</td><td><?php echo $phone_no; ?></td></tr>
                    <tr><td>Message</td><td><?php echo $enq_msg; ?></td></tr>
                    <tr><td>Dept</td><td><?php echo $dept; ?></td></tr>
                    <tr><td>Issue</td><td><?php echo $issue; ?></td></tr>
                    <tr><td>Date</td><td><?php echo $issue_date; ?></td></tr>
                    <tr><td></td><td><a href="<?php echo site_url('cms/feedback') ?>" class="btn btn-default">Close</button></td></tr>
                </table>
            </div>  
        </div>  
    </section>
</div>