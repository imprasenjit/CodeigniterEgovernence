<section class="middleSection">
    <div class="container">
	<div class="row">
            <div class="col-md-12">
		<div style="height:auto; margin: 120px auto 10px auto" class="box box-success">
                    <div class="box-header with-border">
			<h2 class="box-title text-bold">
                            Notifications
                            <span style="float: right; font-size: 16px; font-style: italic; font-weight: bold">
                                Total Records : <?php echo $this->notifications_model->getTotalNotifications(); ?>
                            </span>
                        </h2>
                    </div>
					
                    <div  class="box-body no-padding">
                        <div class="row" style="margin: 0px 0px 5px 0px;">
                            <div class="col-md-4" style="padding-left:0px">
                                <select id="dept" class="form-control">
                                    <option value="" selected="selected">Select Department</option>
                                     <?php foreach($this->getDepartments_model->get() as $depts) { ?>
                                        <option value="<?php echo $depts["id"]; ?>"><?php echo $depts["name"]; ?></option>
                                    <?php }//End of Foreach?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select id="sub_dept" class="form-control">
                                    <option value="" selected="selected">Select Sub Department</option>
                                </select>
                            </div>
                            <div class="col-md-4" style="padding-right:0px">
                                <div class="input-group">
                                    <input type="text" id="kw" class="form-control" placeholder="Search by Notification No." style="width: 100%" />
                                    <span class="input-group-btn">
                                        <input type="button" id="search_btn" value="Search!" class="btn btn-default" style="font-weight: bold" />
                                    </span>
                                </div><!-- .input-group -->
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
<script type="text/javascript">
$(document).ready(function() {
    $("[data-toggle='tooltip']").tooltip();
    function getDetails(page, dept, sub_dept) { //alert(dept+", "+sub_dept);
        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>site/notifications/getNotifications/",
            data: { page: page, dept: dept, sub_dept: sub_dept },
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
        $.ajax({
            type: "GET",
            url: "<?php echo base_url();?>site/approvals/getsubdept/"+dept+"/",
            data: { parent_id: dept },
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
        getDetails(1, dept, sub_dept);        
    });
    
    $("#search_btn").click(function(){
        var kw = $("#kw").val();
        if(kw == "") {
            alert("Field Cannot be Empty!");
            $("#kw").focus();
        } else {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url();?>site/notifications/searchNotifications/",
                data: { kw: kw },
                beforeSend:function(){
                    $("#notices").html("<img src='../../images/loading.gif' style='width:200px; height:150px;' />");
                },
                success:function(data){
                    $("#notices").html(data);
                }
            });
        }
    });
    
    $(document).on("click",".pl",function() {
        var page = $(this).attr("id");
        var dept=$("#dept").val();
        var sub_dept=$("#sub_dept").val();
        var cat=$("#app_cat").val();
        getDetails(page, dept, sub_dept);
        return false;
    });
    
    $('#navlist li').removeClass('current');
    $('#navlist li:nth-child(2)').addClass('current');
});
</script>
