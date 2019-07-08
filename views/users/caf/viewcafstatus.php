<br><br><br>
<div class="container">

    <!-- Page header -->
    <?php
    if ($caf_queries) {
        ?>
    <h3>Queries for the CAF from department</h3>
    <?php 
        foreach ($caf_queries as $caf_query) {
            ?>
            <div class="mybox">
                <p><?=$caf_query->query?></p>
                <p><?=date("D jS \ F Y h:i A", strtotime($caf_query->querytime));?></p>
                <a href="<?= base_url("users/home/editcaf/");?>">Edit CAF</a>
            </div>    
        <?php
        }
    }else{
    ?>
        <div class="row">   
        <div class="col-md-12"><h3>Your CAF is successfully submitted. Once it is approved you will be able to create units and apply for lisences</h3></h3></div>
    </div>
    <?php } ?>
    <div class="page-header">
        <h2>Common Application Form <small></small></h2>
    </div>

    <div class="row">
        <label class="col-md-5 control-label">Name of Enterprise</label>
        <div class="col-md-7">:<?= $caf->entp_name; ?></div>
    </div>
    <div class="row">
        <label class="col-md-5 control-label">Legal Entity of the business</label>
        <div class="col-md-7">:                        
            <?php
            $this->load->helper("entity");
            $entity = getAllEntity($caf->entity_id);
            ?>
            <div class="col-md-12">
                <div class="col-md-6">
<?= $entity->entity_name; ?>
                </div>
            </div>
            <?php get_entity_view($caf->entity_id, $caf->owner_names, $caf->cin_llpin);
            ?>
        </div>
    </div>
    <div class="row">
        <label class="col-md-5 control-label">Date of Incorporation</label>
        <div class="col-md-7">:<?= date("d-m-Y", strtotime($caf->date_of_commencement)) ?></div>
    </div>
    <div class="row">
        <label class="col-md-5 control-label">Income Tax Permanent Account Number(PAN) of the Enterprise </label>
        <div class="col-md-7">:<?= $caf->pan; ?></div>
    </div>
    <div class="row">
        <label class="col-md-5 control-label">Name as on PAN Card of the Enterprise </label>
        <div class="col-md-7">:<?= $caf->pan_name; ?></div>
    </div>
    <div class="row">
        <label class="col-md-5 control-label">Registered office address </label>

        <div class="col-md-7">:<?php $this->load->helper("address");
            view_address(get_address($caf->address)); ?></div>
    </div>
    <div class="row">
        <label class="col-md-5 control-label">Pan Card </label>        
        <div class="col-md-7">:<a href="<?= $caf->pan_card; ?>" >View</a></div>
    </div>
    <div class="row">
        <label class="col-md-5 control-label">Name of the Applicant/Authorised Person  </label>
        <div class="col-md-7">:<?= $caf->app_name; ?></div>
    </div>
    <div class="row">
        <label class="col-md-5 control-label">Designation </label>
        <div class="col-md-7">:<?= $caf->app_designation; ?></div>
    </div>
    <div class="row">
        <label class="col-md-5 control-label">Applicant Address </label>
        <div class="col-md-7">:<?php $this->load->helper("address");
            view_address(get_address($caf->app_address)); ?></div>
    </div>
    <div class="row">
        <label class="col-md-5 control-label">Mobile </label>
        <div class="col-md-7">:<?= $caf->app_mobile; ?></div>
    </div>
    <div class="row">
        <label class="col-md-5 control-label">Email </label>
        <div class="col-md-7">:<?= $caf->app_email; ?></div>
    </div>
    <div class="row">
        <label class="col-md-5 control-label">Authorization Letter </label>        
        <div class="col-md-7">:<a href="<?= $caf->app_authorisation_letter; ?>" >View</a></div>
    </div>
    <div class="row">
        <label class="col-md-5 control-label">ID proof </label>        
        <div class="col-md-7">:<a href="<?= $caf->app_id_proof; ?>" >View</a></div>
    </div>

</div>
