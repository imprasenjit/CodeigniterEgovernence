<div class="modal fade" id="queryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="box box-success">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Application Query</h4>
                </div>
                <div class="modal-body">
                    <input id="uain" type="hidden" />
                    <div class="form-group">
                        <label>Query Subject</label>
                        <select id="query_subject" class="form-control" required="required">
                            <option value="">Select</option>
                            <option value="General Query">General Query</option>
                            <option value="Fees and Payment Related">Fees and Payment Related</option>
                            <option value="Documents Related">Documents Related</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Message</label>
                        <textarea class="form-control" id="query_message" placeholder="Type your message here"></textarea>
                    </div>
                    <div id="query_fees" class="qry-input" style="display: none">
                        <label for="">Amount to be Paid :</label>
                        <div class="input-group">
                            <input id="fees_amount" placeholder="Please enter the amount here (in Rs.)" type="text" class="form-control">
                            <span class="input-group-addon">INR</span>
                        </div>
                    </div>
                    <div id="query_document" class="qry-input" style="display: none">
                        <div id="documentlist">
                            <div class="input-group">
                                <input placeholder="Description of the document to be uploaded" name="query_docs[]" class="form-control" type="text" />
                                <span class="input-group-btn">
                                    <button type="button" class="add_btn btn btn-info">
                                        <span class="glyphicon glyphicon-plus"></span>
                                    </button>                                                            
                                </span>
                            </div>
                        </div>
                    </div>
                    <div align="center">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">
                            <i class="fa fa-remove"></i> Close                                
                        </button>
                        <button id="query_submit" type="button" class="btn btn-primary">
                            <i class="fa fa-check"></i>Submit
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $("#queryModal").on("show.bs.modal", function (e) {
        $("#uain").val(e.relatedTarget.id);
    });
    $(document).on("change", "#query_subject", function () {
        var qsub = $(this).val();
        if (qsub === "") {
            $(this).notify("Please select a query subject");
        } else {
            var showid;            
            if(qsub == "Fees and Payment Related") {
                showid = "#query_fees";
            } else if(qsub == "Documents Related") {
                showid = "#query_document";
            }
            $(".qry-input").css("display", "none");
            $(showid).css("display", "block");
        }
    });
        
    var rows=1;
    var des = "Description of the document to be uploaded";
    $(document).on("click",".add_btn",function() {
        if(rows < 20){
            rows++;
            $("#documentlist").append("<div class='input-group' style='margin:2px 0px'><input type='text' placeholder='"+des+"' name='query_docs[]' class='form-control' /><span class='input-group-btn'><button type='button' class='del_btn btn btn-danger'><span class='glyphicon glyphicon-remove'></span></button></span></div>");
        }
    });

    $(document).on("click",".del_btn",function() {
        $(this).parent().parent("div").remove();
        rows--;
    });
                
    $(document).on("click", "#query_submit", function () {
        var uain = $("#uain").val();
        var qsub = $("#query_subject").val();
        var qmsg = $("#query_message").val();
        var qfamnt = $("#fees_amount").val();
        var qdocs = $("input[name='query_docs[]']").map(function(){return $(this).val();}).get();
        //alert("qsub : "+qsub);
        if (qsub === "") {
            $("#query_subject").notify("Please select a query subject");
        } else {
            $.ajax({
                type: "POST",
                url: "<?= base_url('staffs/queriedapplications/queryapp') ?>",
                data: {uain: uain, qsub: qsub, qmsg: qmsg, qfamnt: qfamnt, query_docs: qdocs},
                beforeSend: function () {
                    $(".storelandloader-wrapper").fadeIn("slow");
                },
                success: function (res) { //alert(res);
                    $(".storelandloader-wrapper").fadeOut("slow");
                    $("#queryModal").modal("hide");
                    $.notify("Application has been successfully querued!!!",{position: "bottom right"});
                    window.setTimeout(function(){ location.reload(true); }, 2000);
                }
            });//End of ajax()
        }            
    });
</script>