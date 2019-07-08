<link rel="icon" href="<?= base_url('public/'); ?>imgs/favicon.ico" type="image/ico">
<link rel="stylesheet" href="<?= base_url('public/'); ?>bootstrap-3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="<?= base_url('public/'); ?>font-awesome-4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="<?= base_url('public/'); ?>css/AdminLTE.min.css">
<link rel="stylesheet" href="<?= base_url('public/'); ?>css/skins/_all-skins.min.css">
<link rel="stylesheet" href="<?= base_url('public/'); ?>css/staffs.css">
<script src="<?= base_url('public/'); ?>js/jquery-3.2.1.min.js"></script>
<script src="<?= base_url('public/'); ?>js/notify.min.js"></script>
<script src="<?= base_url('public/'); ?>bootstrap-3.3.7/js/bootstrap.min.js"></script>
<script src="<?= base_url('public/'); ?>js/app.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $(document).on("click", ".conf", function () {
            if (confirm("Do you want to reject this application?")) {
                return true;
            } else {
                return false;
            }//End of if else
        }); //End of onclick .conf
        
        function blinkme() {
            $(".blinkme").fadeOut(500);
            $(".blinkme").fadeIn(500);
        }
        setInterval(blinkme, 1000);
    });
    /*********** GMC FEES LOGIC ******/	
	$('.sumRupees').on('change', function(){
		var sum = 0;
		$('.sumRupees').each(function(){
			if(!isNaN(parseInt($(this).val()))){
				sum = sum + parseInt($(this).val());
			}
			
		});
		$('#totalAmount2').val(sum);
	});
	var currentYear = new Date().getFullYear();
	for(var i = currentYear-10; i<=currentYear; i++){
		$('.arrearYear').append('<option value="'+i+'">'+i+'</option>')
	}
	$('#AssignCurrentYear').val(new Date().getFullYear());
	$('#AssignNextYear').val(new Date().getFullYear()+1);
	var currentMonth = new Date().getMonth();
	if(currentMonth > 2)
	$('#DynamicYear').val(new Date().getFullYear()+1);
	else
	$('#DynamicYear').val(new Date().getFullYear());
	
	/******* END **********/

</script>
