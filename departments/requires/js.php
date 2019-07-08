
<script>
    $(document).ready(function () {
        $('#upload_from_pc').click(function () {
            //console.log("I am here");
            $("#filefromLocker").modal('hide');
            $("#upload_modal").modal({
                show: true,
                backdrop: true,
                keyboard: true
            });
            var tdid=$(this).attr("data-td-id");
            //alert(tdid);            
            $('#upload_mydocuments').attr('data-td-id',tdid);            
        });
    });
    $("select[trigger='FileModal']").on("change", function () {
        var fileID = $(this).attr("id");
        var mfile = "#m" + fileID;
        var tdfile = "#td" + fileID;
        var passval = $(this).val(); //alert(passval+", "+fileID);
        if (passval == "1") {
            $("#upload_from_pc").attr("data-td-id", fileID);
            $("#Elocker_file").val(fileID);
            $("#filefromLocker").modal({
                show: true,
                backdrop: true,
                keyboard: true
            });
        } else if (passval == "2") {
            $("#formupload_file").val(fileID);
            $("#filefromPC").modal({
                show: true,
                backdrop: true,
                keyboard: true
            });
        } else if (passval == "3") {
            $(mfile).val("NA");
            $(tdfile).html("Not Applicable");
        } else if (passval == "4") {
            $(mfile).val("SC");
            $(tdfile).html("Send by Courier");
        } else {
            alert("Please Select an Option!");
            $(this).focus();
        }
    });
	var currentYear = new Date().getFullYear();
	for(var i = currentYear-50; i<=currentYear+50; i++){
		if(currentYear==i){
			$('.dob_year').append('<option value="'+i+'">'+i+'</option>');
		}else{
			$('.dob_year').append('<option value="'+i+'">'+i+'</option>');
		}
	}
	$('.dob').datepicker({dateFormat: 'yy-mm-dd', changeMonth: true,changeYear: true, yearRange: "-100:+100"});
	$('.dobindia').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+100"});
	$('#dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+100"});
	$('#dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+100"});
</script>