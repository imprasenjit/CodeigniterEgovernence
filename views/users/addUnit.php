<?php
$add_unit_name = set_value("add_unit_name");
$unit_type = set_value("unit_type");
$street1 = set_value("street1");
$street2 = set_value("street2");
$vill = set_value("vill");
$dist = set_value("dist");
$block = set_value("block");
$pincode = set_value("pincode");
$revenue = set_value("revenue");
$subdivision = set_value("subdivision");
              
?>
<?php
if ($this->session->flashdata("errorMsg")) { ?>
    <script type="text/javascript">        
        $.notify("<?= $this->session->flashdata('errorMsg')?>", "error");
       
    </script>
<?php } ?>
<?php
if ($this->session->flashdata("successMsg")) { ?>
    <script type="text/javascript">
        $.notify("<?= $this->session->flashdata('successMsg')?>", "success");
    </script>
<?php } ?>
<div class="content-wrapper" style="padding:80px 10px 20px 10px">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border text-center">
                    <h2>Add Unit</h2>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                <p class="text-bold text-success">If you have an additional unit (branch, godown, factory, regional head office etc.) then you can obtain an additional Unique Business Identification Number (UBIN) pertaining to your unit without having to file Common Application Form again.</p><p class="text-danger">Please Note : Add Unit feature can be availed only for units having the same business constitution (legal entity) and enterprise name as your initial registered enterprise.</p>
                <hr/>
                <form name="myform1" id="myform1" method="post" action="<?=base_url('users/addUnit/save')?>" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-12 col-md-8 col-md-offset-2">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label>Type Of Unit <span class="mandatory_field">*</span></label>
                                        <select class="form-control" name="unit_type">
                                            <option value="">Please Select</option>
                                            <option value="H" <?php if($unit_type=="H") echo "selected"; ?>>Head Office</option>
                                            <option value="B" <?php if($unit_type=="B") echo "selected"; ?>>Branch Office</option>
                                            <option value="F" <?php if($unit_type=="F") echo "selected"; ?>>Factory</option>
                                            <option value="G" <?php if($unit_type=="G") echo "selected"; ?>>Godown</option>
                                            <option value="O" <?php if($unit_type=="O") echo "selected"; ?>>Others</option>
                                        </select>                                        
                                        <?php echo form_error('unit_type'); ?>
                                    </div>                                        
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label>Unit Name </label>
                                        <input class="form-control" required="required" placeholder="Please enter the unit name for which you want to add." name="add_unit_name" id="add_unit_name" value="<?=$add_unit_name; ?>" type="text">
                                        <?php echo form_error('add_unit_name'); ?>
                                    </div>
                                </div>
                            </div>
                            <h4><u>Address of the Unit</u></h4>
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label>Street Name 1 <span class="mandatory_field">*</span></label>
                                        <input class="form-control" required="required"  name="street1" id="street1" value="<?=$street1; ?>"  type="text">                                  
                                        <?php echo form_error('street1'); ?>
                                    </div>                                        
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label> Street Name 2 </label>
                                        <input class="form-control"  name="street2" id="street2" value="<?=$street2; ?>" type="text">
                                    </div>
                                </div>
                            </div>   
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label>Village/Town <span class="mandatory_field">*</span></label>
                                        <input class="form-control" required="required"  name="vill" id="vill" value="<?=$vill; ?>"  type="text">                                  
                                        <?php echo form_error('vill'); ?>
                                    </div>                                        
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label>District </label>
                                        <?php
                                        $dstresult = $this->GetDistrict_model->getAllDistrict();
                                        ?>
                                        <select name="dist" id="insert_caf_dist" required="required" class="form-control text-uppercase" >
                                            <option value="">Please Select</option>
                                            <?php foreach ($dstresult as $key => $dstrows) { 
                                                if($dist==$dstrows['district']) $s="selected"; else $s="";
                                                ?>
                                                <option <?=$s;?> value="<?php echo $dstrows['district']; ?>" ><?php echo $dstrows['district']; ?></option>
                                            <?php } ?>					
                                        </select>
                                        <?php echo form_error('dist'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label>Block <span class="mandatory_field">*</span></label>
                                        <select name="block" id="b_block" required="required" class="form-control text-uppercase " >
                                            <?php 
                                            echo '<option value=""> Select Block / Ward </option>';
                                            if($block!=""){
                                                $block_results = $this->addUnit_model->get_blocks($dist);                                                
                                                echo '<option selected value="'.$block.'"> '.$block.' </option>';
                                                echo $block_results;
                                            }?>
                                            
                                        </select>
                                        
                                        <div class="help-block">
                                            <a style="text-decoration:none" href="<?=base_url();?>common/know_your_block.php" target="_blank"><span id="knowWard-block">Know your Block</span></a>
                                             | <a style="text-decoration:none" href="<?=base_url();?>common/know-your-ward.html" target="_blank"><span id="knowWard-3" class="tooltip-kyw knowWard">Know Your Ward (Only For Kamrup Metropolitan)</span></a>
                                          
                                        </div>
                                        <?php echo form_error('block'); ?>
                                                
                                    </div>                                        
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label>Pin Code </label>
                                        <select name="pincode" required="required" id="b_pincode" class="form-control text-uppercase">                                            
                                            <?php 
                                            echo '<option value=""> Select Pin code </option>';
                                            if($pincode!=""){
                                                echo '<option selected value="'.$pincode.'"> '.$pincode.' </option>';
                                                $pincodes_results = $this->addUnit_model->get_pincodes($dist); 
                                                echo $pincodes_results;
                                            } ?>
                                            
                                        </select>
                                        <?php echo form_error('pincode'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label>Revenue Circle <span class="mandatory_field">*</span></label>
                                        <select name="revenue" required="required" id="revenue" class="form-control text-uppercase">
                                     
                                            <?php 
                                            echo '<option value=""> Select Revenue Circle </option>';
                                            if($revenue!=""){
                                                echo '<option selected value="'.$revenue.'"> '.$revenue.' </option>';
                                                $revenue_results = $this->addUnit_model->get_revenues($dist); 
                                                echo $revenue_results;
                                            } ?>
                                            
                                        </select>
                                        <?php echo form_error('revenue'); ?>
                                    </div>                                        
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label>Sub-division </label>
                                        <select name="subdivision" id="subdivision" class="form-control text-uppercase">
                                            <?php 
                                            echo '<option value=""> Select Sub-division </option>';
                                            if($subdivision!=""){
                                                echo '<option selected value="'.$subdivision.'"> '.$subdivision.' </option>';
                                                $subdivision_results = $this->addUnit_model->get_subdivisions($dist); 
                                                echo $subdivision_results;
                                            } ?>
                                            
                                        </select>
                                        <?php echo form_error('subdivision'); ?>
                                    </div>
                                </div>
                            </div>
                            <hr>    
                            <div class="row">
                                <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 text-center">
                                    <button type="submit"  class="btn btn-primary btn-block" name="addunit" id="addunit"> Submit <span class=""></span></button>

                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div> <!--End of .row -->
</div> <!--End of .content-wrapper -->
</div> <!--End of .wrapper -->
<?php $this->load->view("users/requires/usersModal"); ?>

<script type="text/javascript">
$('#insert_caf_dist').change(function(){
    var district=$(this).val();
    $('#b_block').empty();
    $.ajax({ 
        type: 'GET',
        url: '<?=base_url();?>users/addUnit/get_district_blocks', 
        data: { district : district },
        beforeSend:function(){
            $("#b_block").html('<option value=""> Loading... </option>');
            
        },
        success:function(data){
            $("#b_block").html('<option value=""> Select Ward/Block </option>' + data);
        },
        error:function(){ }
    }); //ajax end
    
    $('#b_pincode').empty();
    $.ajax({ 
        type: 'GET',
        url: '<?=base_url();?>users/addUnit/get_district_pincodes', 
        data: { district: district },
        beforeSend:function(){
            $("#b_pincode").html('<option value=""> Loading... </option>');
        },
        success:function(data){
            $("#b_pincode").html('<option value=""> Select Pin code </option>' + data);
        },
        error:function(){ }
    }); //ajax end
    
    $('#revenue').empty();
    $.ajax({ 
        type: 'GET',
        url: '<?=base_url();?>users/addUnit/get_district_revenues', 
        data: { district: district },
        beforeSend:function(){
            $("#revenue").html('<option value=""> Loading... </option>');
        },
        success:function(data){
            $("#revenue").html('<option value=""> Select Revenue </option>' + data);
        },
        error:function(){ }
    }); //ajax end
    
    $('#subdivision').empty();
    $.ajax({ 
        type: 'GET',
        url: '<?=base_url();?>users/addUnit/get_district_subdivisions', 
        data: { district: district },
        beforeSend:function(){
            $("#subdivision").html('<option value=""> Loading... </option>');
        },
        success:function(data){
            $("#subdivision").html('<option value=""> Select Sub-division </option>' + data);
        },
        error:function(){ }
    }); //ajax end
    

});
</script>

