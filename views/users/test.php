<div class="col-sm-12">
    <div class="Panel_Box">
        <div class="info">
            <div class="heading">
                <h4 class="text-center"><font font-family="Book Antiqua,Palatino Linotype,Palatino, serif" font-size="12px" size="4" color="##1563A9">Apartmental Master Record</font></h4>
            </div>
            <hr style="border-color:#b7a2b8">    
            <form action="<?= base_url(); ?>user/addunit" method="post">

                <div class="row form-group">
                                    <div class="col-sm-12">
                                        <label class="col-sm-2"></label>
                                        <div class="col-sm-4 pull-left">
                                           

                                        </div>
                                        <label class="col-sm-2">Type Of Unit:</label>
                                        <div class="col-sm-4 pull-right">
                                            <select class="form-control" name="unit_type">
                                                <option value="">Please Select</option>
                                                <option value="H">Head Office</option>
                                                <option value="B">Branch Office</option>
                                                <option value="F">Factory</option>
                                                <option value="G">Godown</option>
                                                <option value="O">Others</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-sm-12">
                                            <label class="col-sm-2 text-right"> Unit Name  :</label>
                                            <div class="col-sm-4 pull-left">
                                                <input class="form-control" placeholder="Supply Required (liters/day)" name="supply_required" id="supply_required" value=""  type="text">
                                            </div>
                                            <label class="col-sm-2 text-right"> Address of the Unit :</label>
                                            <div class="col-sm-4 pull-right">

                                            </div>
                                        </div>
                                    </div> 

                                    <div class="row form-group">
                                        <div class="col-sm-12">
                                            <label class="col-sm-2 text-right"> Street 1 :<span class="mandatory_field">*</span></label>
                                            <div class="col-sm-4 pull-left">
                                                <input class="form-control"  name="street1" id="supply_required" value=""  type="text">
                                            </div>
                                            <label class="col-sm-2 text-right"> Street 2 :</label>
                                            <div class="col-sm-4 pull-right">
                                                <input class="form-control"  name="street2" id="avg_charge" value="" type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-sm-12">
                                            <label class="col-sm-2 text-right">Village/Town :<span class="mandatory_field">*</span></label>
                                            <div class="col-sm-4 pull-left">
                                                <input class="form-control"  name="vill" id="supply_required" value=""  type="text">
                                            </div>
                                            <label class="col-sm-2 text-right"> District : <span class="mandatory_field">*</span></label>
                                            <div class="col-sm-4 pull-right">
                                                <div><?php
                                                    $dstresult = $this->GetDistrict_model->getAllDistrict();
                                                    ?>
                                                    <select name="dist" id="insert_caf_dist" required="required" class="form-control text-uppercase" >
                                                        <option value="">Please Select</option>
                                                        <?php foreach ($dstresult as $key => $dstrows) { ?>
                                                            <option value="<?php echo $dstrows['district']; ?>" ><?php echo $dstrows['district']; ?></option>
                                                        <?php } ?>					
                                                    </select> 
                                                </div>
                                            </div>
                                        </div>              

                                        <div class="row form-group">
                                            <div class="col-sm-12">
                                                <label class="col-sm-2 text-right"> Block :</label>
                                                <div class="col-sm-4 pull-left">
                                                    <input class="form-control"  name="block" id="supply_required" value=""  type="text">
                                                </div>
                                                <label class="col-sm-2 text-right"> Pin Code :</label>
                                                <div class="col-sm-4 pull-right">
                                                    <input class="form-control"  name="pincode" id="avg_charge" value="" type="text">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-sm-12">
                                                <label class="col-sm-2 text-right"> Revenue Circle :</label>
                                                <div class="col-sm-4 pull-left">
                                                    <input class="form-control"  name="revenue" id="supply_required" value=""  type="text">
                                                </div>
                                                <label class="col-sm-2 text-right"> Subdivision :</label>
                                                <div class="col-sm-4 pull-right">
                                                    <input class="form-control"  name="subdivision" id="avg_charge" value="" type="text">
                                                </div>
                                            </div>
                                        </div>


                                        <hr style="border-color:#b7a2b8">    
                                        <div class="row form-group">
                                            <div class="col-sm-8">
                                                <button type="submit" class="btn btn-primary" name="addunit" id="addunit">Add Unit <span class=""></span></button>

                                            </div>
                                        </div>
                                        </form></div>
                                </div>
                                </div>
                                </div>
              
                <hr style="border-color:#b7a2b8">    
                <div class="row form-group">
                    <div class="col-sm-8">
                        <button type="submit" class="btn btn-primary" name="Amaster_submit" id="Amaster_submit">Save <span class=""></span></button>
                        <button type="submit" class="btn btn-primary" name="Anew" id="Anew">New<span class=""></span></button>
                        <button type="submit" class="btn btn-primary" name="Aback" id="Aback">Back <span class=""></span></button>
                    </div>
                </div>
            </form></div>
        </div>
    </div>