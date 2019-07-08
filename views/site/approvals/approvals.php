<section class="middleSection">
    <div class="container">
	<div class="row">
            <div class="col-md-12">
		<div style="height:auto; margin: 120px auto 10px auto" class="box box-success">
                    <div class="box-header with-border">
			<h2 class="box-title text-bold">
                            List of Approvals
                        </h2>
                    </div>
                    
                    <div class="box-body no-padding">
                        <div class="row" style="margin-bottom: 4px">
                            <div class="col-md-4">
                                <label>Select Department <span class="text-danger">*</span></label>
                                <select id="dept" class="form-control">
                                    <option value="" selected="selected">Select</option>
                                    <?php foreach($this->getDepartments_model->get() as $depts) { ?>
                                        <option value="<?php echo $depts["id"]; ?>"><?php echo $depts["name"]; ?></option>
                                    <?php } // End of foreach ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Select Sub Department <span class="text-danger">*</span></label>
                                <select id="sub_dept" class="form-control">
                                    <option value="" selected="selected">Select</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Select Category of Application <span class="text-danger">*</span></label>
                                <select id="app_cat" class="form-control">
                                    <option value="" selected="selected">Select</option>
                                    <option value="1">Pre-Establishment</option>
                                    <option value="2">Pre-Operation</option>
                                    <option value="3">Post-Commencement</option>
                                    <option value="4">Returns And Renewals</option>
                                    <option value="5">Other Approvals</option>
                                </select>
                            </div>                
                        </div> <!-- End of .row --> 
            
                        <div id="notices" style="text-align: center">
                        
                        </div>
                    </div> <!-- End of .box-body -->
                </div> <!-- End of .box -->
            </div> <!-- End of .col-md-12 -->
	</div> <!-- End of .row -->
    </div> <!-- End of .container -->
</section>

<!-- viewModal -->
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="viewModalLabel">View Details</h4>
            </div>
            <div class="modal-body" id="viewModalBody">
                
            </div>
            <div class="modal-footer" style="text-align: center">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div> <!-- End of #viewModal -->
<script type="text/javascript">
$(document).ready(function() {
    function getDetails(page, dept, sub_dept, cat) { //alert(dept+", "+sub_dept+", "+cat);
        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>site/approvals/getapprovals/",
            data: { page: page, dept: dept, sub_dept: sub_dept, cat: cat },
            beforeSend:function(){
                $("#notices").html("<img src='../../images/loading.gif' style='width:200px; height:150px; margin:250px auto' />");
            },
            success:function(data){
                $("#notices").html(data);
            }
        }); // End of ajax
    } // End of getDetails()
    
    $(document).on("change","#dept",function() {
        var dept=$(this).val();
        var sub_dept=$("#sub_dept").val();
        var cat=$("#app_cat").val();
        //getDetails(1, dept, sub_dept, cat);
    }).on("change","#dept",function() {
        var dept=$(this).val();
        $.ajax({
            type: "GET",
            url: "<?php echo base_url();?>site/approvals/getsubdept/"+dept+"/",
            beforeSend:function(){
                $("#sub_dept").html("<option value=''>Loading...</option>");
            },
            success:function(data){
                $("#sub_dept").html(data);
            }
        });
    });
    
    $("#sub_dept").change(function(){
        var dept=$("#dept").val();
        var sub_dept=$(this).val();
        var cat=$("#app_cat").val();
        getDetails(1, dept, sub_dept, cat);
    });
    
    $("#app_cat").change(function(){
        var dept=$("#dept").val();
        var sub_dept=$("#sub_dept").val();
        var cat=$(this).val();
        getDetails(1, dept, sub_dept, cat);
    });
    
    $(document).on("click",".pl",function() {
        var page = $(this).attr("id");
        var dept=$("#dept").val();
        var sub_dept=$("#sub_dept").val();
        var cat=$("#app_cat").val();
        //alert("page : "+page+", dept : "+dept+", sub_dept : "+sub_dept+", cat : "+cat);
        getDetails(page, dept, sub_dept, cat);
        return false;
    });
    
    $("#viewModal").on("show.bs.modal", function(e) {
        var res = e.relatedTarget.id.split("||");
        var id = res[0];
        var fld = res[1];
        var field = fld.replace("_", " ");
        var field_name = field.toUpperCase();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>ajaxapprovals/getfielddetails/",
            data: {id:id, fld:fld},
            beforeSend:function(){
                $("#viewModalBody").html("<img src='../images/loading.gif' style='width:200px; height:150px;' />");
            },
            success: function(res){ //alert(res);
                $("#viewModalLabel").html(field_name);
                $("#viewModalBody").html(res);
            }
        }); //End of Ajax
    }); // End of .on modal
    
    $('#navlist li').removeClass('current');
    $('#navlist li:nth-child(2)').addClass('current');
});
</script>
