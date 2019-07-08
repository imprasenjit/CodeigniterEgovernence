<!-- jQuery 3.1.1 -->
<script src="<?php echo $server_url;?>plugins/jQuery/jquery-3.1.1.min.js"></script>
<!-- datepicker -->
<script src="<?php echo $server_url;?>dist/datepicker/js/datepicker.js"></script>
<script src="<?php echo $server_url;?>dist/datepicker/js/jquery.timepicker.js"></script>
<script src="<?php echo $server_url;?>dist/datepicker/js/jquery.timepicker.min.js"></script>
<script src="<?php echo $server_url;?>dist/js/jQuery.print.js"></script>
<script src="<?php echo $server_url;?>dist/js/wickedpicker.js"></script>
<script src="<?php echo $server_url;?>dist/js/wickedpicker.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo $server_url;?>bootstrap/js/bootstrap.min.js"></script>

<script src="<?php echo $server_url;?>plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- AdminLTE App -->

<script src="<?php echo $server_url;?>dist/js/app.min.js"></script>
<script src="<?php echo $server_url;?>plugins/chartjs/Chart.min.js"></script>
<script src="<?php echo $server_url;?>plugins/iCheck/icheck.min.js"></script>

<script type="text/javascript" src="<?php echo $server_url; ?>user_area/pekeupload/js/pekeUpload.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $("#exampleInputFile").pekeUpload({
        bootstrap:true,
        limit: 1,
        maxSize: 5,
        url:"<?php echo $server_url; ?>user_area/pekeupload/upload.php"
    });
    
    $("#userImage").pekeUpload({
        bootstrap:true,
        limit: 1,
        maxSize: 5,
        url:"<?php echo $server_url; ?>user_area/pekeupload/upload.php"
    });
});
</script>


<script>
$(document).ready(function(){
    $('.menu-ul-li-items').click(function(){
        $(this).children('ul').slideToggle();
    });
});
	<?php $query="select active from singe_window_registration where id='$swr_id' and user_id='$sid' and active='1'";	
	$query_results=$mysqli->query($query);	
	?>
	$('#initModal').modal({
		<?php if($query_results->num_rows!=1){ ?>
			show: true,
		<?php }else{ ?>
			show: false,			
		<?php } ?>
		backdrop: false,
		keyboard: false
	});
	$('#navbar-search-input').on('change',function(){
	//$("#track_uian").change(function(){
			//var selectedValue = $(this).val(); //alert(selectedValue);
            $("#track_form").submit();
	});
	function checkFilename(filename) { 
		var user_id=<?php echo $sid; ?>;
		$.ajax({ 
			type: 'GET',
			url: '<?php echo $server_url; ?>ajax/check_filename.php', 
			data: { filename: filename,user_id:user_id },			
			success:function(res){ 	
				if(res == 1) {$('#filenameError').html('');
					$('button[name="upload"]').removeAttr('disabled');
				}
				
				else {$('#filenameError').html('<div class="text-center alert alert-danger" role="alert"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Filename Already Exists!  Please try a different file name</div>');
				$('button[name="upload"]').attr('disabled', 'disabled');				
				}				
			},
			error:function(){}			
		}); 
	}
	function checkFilename2(filename) { 
		var user_id=<?php echo $sid; ?>;
		$.ajax({ 
			type: 'GET',
			url: '<?php echo $server_url; ?>ajax/check_filename.php', 
			data: { filename: filename,user_id:user_id },			
			success:function(res){ 	
				if(res == 1) {$('#filenameError2').html('');
					$('button[name="upload"]').removeAttr('disabled');
				}
				
				else {$('#filenameError2').html('<div class="text-center alert alert-danger" role="alert"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Filename Already Exists!  Please try a different file name</div>');
				$('button[name="upload"]').attr('disabled', 'disabled');				
				}				
			},
			error:function(){}			
		}); 
	}
	/* ------------------aside menu operation------------------ */
	var href = window.location.href;
	var pos = href.lastIndexOf('/');
	var res = href.slice(0,pos+1);
	res+='index.php';
	$('a[href="'+res+'"]').parents('li[class="treeview"]').addClass('active');
	$('a[href="'+res+'"]').parent().addClass('active');
	
/* ----------------trigger modal filefromPC---------------- */
/*
$("select[trigger='FileModal']").on("click", function(evt){
    var id = "#"+$(this).attr("id"); //alert(id);
    var selected_val = $(id +" option:selected").val();
    var selected_txt = $(id +" option:selected").text();
    if((selected_val == "0") && (selected_txt !="Select")) {
        $(id +" option[value='0']").remove();
        $(id +" option").filter(function() {
            return this.text == selected_txt; 
        }).attr("selected", true);
    }
});
*/
$("select[trigger='FileModal']").on("change", function(){
    var fileID = $(this).attr("id");
    var mfile = "#m"+fileID;
    var tdfile = "#td"+fileID;
    var passval = $(this).val(); //alert(passval+", "+fileID);
    if(passval == "1") {
        $("#Elocker_file").val(fileID);
        $("#filefromLocker").modal({
            show: true,			
            backdrop: true,
            keyboard: true
        });
    } else if(passval == "2") {
        $("#formupload_file").val(fileID);						
        $("#filefromPC").modal({
            show: true,			
            backdrop: true,
            keyboard: true
        });
    } else if(passval == "3") {
        $(mfile).val("NA");
        $(tdfile).html("Not Applicable");
    } else if(passval == "4") {
        $(mfile).val("SC");
        $(tdfile).html("Send by Courier");
    } else {
        alert("Please Select an Option!");
        $(this).focus();
    }
});

        
	$('input[upload="file"]').on('click', function(){
		$('#formupload_file').val($(this).attr('id'));	
		$('#filefromPC').modal({
			show: true,			
			backdrop: true,
			keyboard: true
		});
	});
	/*----------------prevent enter in textarea------------------*/
	/* $('textarea').on('keypress', function(event){
		$(this).val($(this).val().replace(/\v+/g, ''));
		if(event.keyCode === 59)
			event.preventDefault();
		if (event.keyCode === 10 || event.keyCode === 13) 
			event.preventDefault();
	}); */
	/* ------------------jQuery Validation--------------------- */
	// $('textarea[validate="textarea"]').on('keydown', function(e){
		// var specials=/[:'",:;]/;
		// var that = this;
		// var string = $(this).val();
		// var pattern = new RegExp(specials);
		// var res = pattern.exec(string);
		// if(res != null){
			// if(res.length>0){
				// alert(':\'",:; characters are not allowed');
				// $(that).val('');
			// }
		// }
		
	// });
	$('textarea[validate="jsonObj"]').on('change', function(e){
		var specials=/[:'",]/;
		var that = this;
		var string = $(this).val();
		var pattern = new RegExp(specials);
		var res = pattern.exec(string);
		if(res != null){
			if(res.length>0){
				alert(':\'", character are not allowed');
				$(that).val('');
			}
		}
		
	});
	$('input[validate="jsonObj"]').on('change', function(e){
		var specials=/[:'",]/;
		var that = this;
		var string = $(this).val();
		var pattern = new RegExp(specials);
		var res = pattern.exec(string);
		if(res != null){
			if(res.length>0){
				alert(':\'", character are not allowed');
				$(that).val('');
			}
		}
		
	});
	$('input[validate="specialChar"]').on('change', function(e){
		var specials=/[*|\":<>[\]{}`\\()';@&$,_#]/;
		var that = this;
		var string = $(this).val();
		var pattern = new RegExp(specials);
		var res = pattern.test(string);
		if(res == null){
			alert('Special Characters Are Not Allowed');
			$(that).val('');
		}
		if(res == true){
			alert('Special Characters Are Not Allowed');
			$(that).val('');
			setTimeout(function(){$(that).focus();}, 1);	
		}		
	});
	$('input[type="text"]').on('change', function(e){
		var specials=/[*|\":<>[\]{}`\\()';@&$,_#]/;
		var that = this;
		var string = $(this).val();
		var pattern = new RegExp(specials);
		var res = pattern.test(string);
		if(res == null){
			alert('Special Characters Are Not Allowed');
			$(that).val('');
		}
		if(res == true){
			alert('Special Characters Are Not Allowed');
			$(that).val('');
			setTimeout(function(){$(that).focus();}, 1);	
		}		
	});
	$('input[validate="onlyNumbers"]').on('change', function(e){
		var specials=/\d*/;
		var that = this;
		var string = $(this).val();
		var pattern = new RegExp(specials);
		var res = pattern.exec(string);
		if(res == null){
			alert('Only Whole Numbers Are Allowed. Eg 23');
		}
		if(!(res[0].length == string.length)){
			alert('Only Whole Numbers Are Allowed. Eg 23');
			$(that).val('');
			setTimeout(function(){$(that).focus();}, 1);	
		}	
	});
	$('input[validate="mobileNumber"]').on('change', function(e){
		var specials=/\d{10}/;
		var that = this;
		var string = $(this).val();
		var pattern = new RegExp(specials);
		var res = pattern.exec(string);
		if(res == null){
			alert('Only 10 Digit Phone Number Is Allowed');
			$(that).val('');
		}
		if(!(res[0].length == string.length)){
			alert('Only 10 Digit Phone Number Is Allowed');
			$(that).val('');
			setTimeout(function(){$(that).focus();}, 1);	
		}	
	});
	
	$('input[validate="pincode"]').on('change', function(e){
		var specials=/\d{6}/;
		var that = this;
		var string = $(this).val();
		var pattern = new RegExp(specials);
		var res = pattern.exec(string);
		if(res == null){
			alert('Only 6 Digit Pin Number Is Allowed');
			$(that).val('');
		}
		if(!(res[0].length == string.length)){
			alert('Only 6 Digit Pin Number Is Allowed');
			$(that).val('');
			setTimeout(function(){$(that).focus();}, 1);	
		}	
	});
	$('input[validate="letters"]').on('change', function(e){
		var specials=/^[A-Za-z\s]+$/;
		var that = this;
		var string = $(this).val();
		var pattern = new RegExp(specials);
		var res = pattern.exec(string);
		if(res == null){
			alert('Only Letters Are Allowed');
			$(that).val('');
		}
		if(!(res[0].length == string.length)){
			alert('Only Letters Are Allowed');
			$(that).val('');
			setTimeout(function(){$(that).focus();}, 1);	
		}
	});
	$('input[validate="decimal"]').on('change', function(e){
		var specials=/\d*\.\d{2}/;
		var numbers_specials=/\d*/;
		var that = this;
		var string = $(this).val();
		var pattern = new RegExp(specials);
		var res = pattern.exec(string);
		if(res == null){
			alert('Enter a valid number with 2 digits after point. Eg. 23.00');
			$(that).val('');
			setTimeout(function(){$(that).focus();}, 1);				
		}
		if(!(res[0].length == string.length)){
			alert('Enter a valid number with 2 digits after point. Eg. 23.00');
			$(that).val('');
			setTimeout(function(){$(that).focus();}, 1);	
		}
	});
	$('.dob').datepicker({dateFormat: 'yy-mm-dd', changeMonth: true,changeYear: true, yearRange: "-100:+100"});
	$('.dobindia').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+100"});
	$('#dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+100"});
	$('#dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+100"});
	
	
	//$('.dob_year').datepicker({dateFormat: 'yy',changeMonth: false,changeYear: true, yearRange: "-100:+100"});
	
	//$('.dob_year').datepicker({ dateFormat: 'yy' })
	var currentYear = new Date().getFullYear();
	
	for(var i = currentYear-20; i<=currentYear+20; i++){
		
		$('.dob_year').append('<option value="'+i+'">'+i+'</option>')
	}
	
	/**************** UPLOAD DOCUMENTS WITH FORM *********************/
	

	/* ---------------------upload S/C click operation-------------------- */
	
	$('.cd').on('click', function(){
		if($(this).prop('checked') == false){
			$('#courierd input').attr('disabled', 'disabled');
			$('.cd').each(function(){
				if($(this).prop('checked') == true){
					$('#courierd input').removeAttr('disabled');
					false;
				}
			});
		}else{
			$('#courierd input').removeAttr('disabled');
		}
		
	});
/*var popup1, popup2;
	function chooseFile(val, divID) { //alert(divID); mfile1
		if(val==1) {
			popup1 = window.open("<?php echo $server_url; ?>user_area/uploading/fileFromElocker.php?id="+divID, "Popup1", "width=950,height=700");
			popup1.moveTo(950, 700);
			popup1.focus();
			$('#'+divID+'-chiranjit').show();			
			return false;
		} else if(val==2) {
			popup2 = window.open("<?php echo $server_url; ?>user_area/uploading/fileFromPC.php?id="+divID, "Popup2", "width=600,height=300");
			popup2.moveTo(400, 200);
			popup2.focus();
			$('#'+divID+'-chiranjit').show();
			return false;
		} 		
	} */
   /*Brought click function of fileupload button when browse button is clicked*/
   $(document).ready(function(){		
		$('#uploadbrowsebutton').on('click', function(){
			popup2 = window.open("<?php echo $server_url; ?>user_area/uploading/fileFromPC.php?id=file_rishi", "Popup2", "width=600,height=300");
			popup2.moveTo(400, 200);
			popup2.focus();
			$('#file_rishi').show();
		});
   });	
	/***************** END*******************************/
	$('#b_dist').change(function(){
        var city=$(this).val();
		$('#b_block').empty();
        $.ajax({ 
            type: 'GET',
            url: '../ajax/district_blocks.php', 
            data: { city: city },
            beforeSend:function(){
                $("#b_block").html("Loading..");
            },
            success:function(data){
                $("#b_block").html(data);
            },
            error:function(){ }
        }); //ajax end
    });
    $('#dist').change(function(){
        var city=$(this).val();
		$('#block').empty();
        $.ajax({ 
            type: 'GET',
            url: '../ajax/district_blocks.php', 
            data: { city: city },
            beforeSend:function(){
                $("#block").html("Loading..");
            },
            success:function(data){
                $("#block").html(data);
            },
            error:function(){ }
        }); //ajax end
    });
    $('#b_dist2').change(function(){
        var city=$(this).val();
		$('#b_block2').empty();
        $.ajax({ 
            type: 'GET',
            url: '../ajax/district_blocks.php', 
            data: { city: city },
            beforeSend:function(){
                $("#b_block2").html("Loading..");
            },
            success:function(data){ 	//alert(data);
                $("#b_block2").html(data);
            },
            error:function(){ }
        }); //ajax end
    });
	$('#dist1').change(function(){
		var city=$(this).val();
		$('#block1').empty();
		$.ajax({ 
			type: 'GET',
			url: '../../../ajax/district_blocks.php', 
			data: { city: city },
			beforeSend:function(){
				$("#block1").html("Loading..");
			},
			success:function(data){
				$("#block1").html(data);
			},
			error:function(){ }
		}); //ajax end
	});
	$('#dist2').change(function(){
		var city=$(this).val();
		$('#block2').empty();
		$.ajax({ 
			type: 'GET',
			url: '../../../ajax/district_blocks.php', 
			data: { city: city },
			beforeSend:function(){
				$("#block2").html("Loading..");
			},
			success:function(data){
				$("#block2").html(data);
			},
			error:function(){ }
		}); //ajax end
	});
	//////////////// FETCH PINCODE BLOCK AND REVENUW ////////////////////
	$('#insert_caf_dist').change(function(){
        var city=$(this).val();
		$('#b_block').empty();
        $.ajax({ 
            type: 'GET',
            url: '<?php echo $server_url; ?>ajax/district_blocks.php', 
            data: { city: city },
            beforeSend:function(){
                $("#b_block").html("Loading..");
            },
            success:function(data){
                $("#b_block").html(data);
            },
            error:function(){ }
        }); //ajax end
		$('#b_pincode').empty();
        $.ajax({ 
            type: 'GET',
            url: '<?php echo $server_url; ?>ajax/district_pincodes.php', 
            data: { city: city },
            beforeSend:function(){
                $("#b_pincode").html("Loading..");
            },
            success:function(data){
                $("#b_pincode").html(data);
            },
            error:function(){ }
        }); //ajax end
		$('#revenue').empty();
        $.ajax({ 
            type: 'GET',
            url: '<?php echo $server_url; ?>ajax/district_revenue.php', 
            data: { city: city },
            beforeSend:function(){
                $("#revenue").html("Loading..");
            },
            success:function(data){
                $("#revenue").html(data);
            },
            error:function(){ }
        }); //ajax end
		$('#subdivision').empty();
        $.ajax({ 
            type: 'GET',
            url: '<?php echo $server_url; ?>ajax/district_subdivision.php', 
            data: { city: city },
            beforeSend:function(){
                $("#subdivision").html("Loading..");
            },
            success:function(data){
                $("#subdivision").html(data);
            },
            error:function(){ }
        }); //ajax end
    });
	///////////////////END END END END END /////////////////////
	$('#knowWard-3').hide();
	$('#dist').on('change', function(){	
	if($('#dist option:selected').val() == 'KAMRUP METROPOLITAN'){
		$('#knowWard-3').show();
	}else{
		$('#knowWard-3').hide();
	}
	});	
/****************** ELOCKER SELECT FILE ***************************/
	function getName(file){
            var fileID = $("#Elocker_file").val();                            
            var mfile = "#m"+fileID;
            var tdfile = "#td"+fileID;
            var fleTD = "#"+file;
            var fleName = $(fleTD).val();
            $(mfile).val(fleName); //alert(file+" = "+fleName);
            $(tdfile).html('<a href="<?php echo $server_url; ?>Document_locker/'+fleName+'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>');
            /*
            var doc1 = document.getElementById("m"+$('#Elocker_file').val());
            var uploadtext = document.getElementById("td"+$('#Elocker_file').val());
            //doc1.value = document.getElementById(file).innerHTML;
            doc1.value = $('#'+file+'').val();
			uploadtext.innerHTML = '<a href="<?php echo $server_url; ?>Document_locker/'+doc1.value+'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="'+$('#Elocker_file').val()+'" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>';
			$('.'+$("#Elocker_file").val()+'').attr('disabled', 'disabled');
                        */
	}	
/*********************** FILE FROM PC UPLOAD IN FORM UPLOAD SECTION *************************/
$(document).ready(function (e){
	$(".frmUpload").on('submit',(function(e){
		e.preventDefault();
		//$(".img-preview").html('<img src="<?php echo $server_url; ?>images/uploadImg.gif"></img>');	
		$('#filefromPC').modal('toggle');
		$('#gif').attr('visibility', 'visible');
		$.ajax({
			url: "<?php echo $server_url; ?>user_area/upload_pdf.php",        
			type: "POST",      
			data: new FormData(this), 
			contentType: false,       
			cache: false,             
			processData:false,        
			success: function(data) { //alert(data);
                            var fileID = $("#formupload_file").val();                            
                            var mfile = "#m"+fileID;
                            var tdfile = "#td"+fileID;
                            $(mfile).val(data);
                            $(tdfile).html('<a href="<?php echo $server_url; ?>Document_locker/'+data+'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>');
                            
                            /*
                            var doc1 = document.getElementById("m"+$('#formupload_file').val());
                            doc1.value = data;
                                
				var doc1 = document.getElementById("m"+$('#formupload_file').val());
				doc1.value = data;
				if(doc1.value=='2')
				{
					var uploadtext = document.getElementById("m"+$('#formupload_file').val()+"-chiranjit");
					uploadtext.innerHTML = '<font color="red">File Name Already Exist/Empty..!</font>';
				}else if(doc1.value=='3'){
					var uploadtext = document.getElementById("m"+$('#formupload_file').val()+"-chiranjit");
					uploadtext.innerHTML = '<font color="red">Invalid Size/Type</font>';
				}else{
					var uploadtext = document.getElementById("m"+$('#formupload_file').val()+"-chiranjit");
					uploadtext.innerHTML = '<a href="<?php echo $server_url; ?>Document_locker/'+doc1.value+'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="'+$('#formupload_file').val()+'" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>';
					$('.'+$("#formupload_file").val()+'').attr('disabled', 'disabled');
				}
                                */
				
			}
		});
		$('#userImage').val('');
		$('#filename').val('');
		$('#desc').val('');
		
	}
));

/*
$("#userImage").change(function() {
    var file = this.files[0];
    var imagefile = file.type;
    var imageTypes= ["image/jpeg","image/png","image/jpg","application/pdf"];
        if(imageTypes.indexOf(imagefile) == -1)
        {
                $(".filetype_Error").html("<div class='text-center alert alert-danger' role='alert'><i class='fa fa-exclamation-triangle' aria-hidden='true'></i> Please Select A valid Image File<br>Only pdf, jpeg, jpg and png Images type allowed</div>");
                $("#userImage").val('');
                return false;			
        }else{
                $(".filetype_Error").html("");
                return true;
        }
});
*/    
$('input[type="file"]').on('change', function(){
	var file = this.files[0];
	var imagefile = file.type;
	var imageTypes= ["image/jpeg","image/png","image/jpg","application/pdf"];
		if(imageTypes.indexOf(imagefile) == -1)
		{
			$(".filetype_Error").html("<div class='text-center alert alert-danger' role='alert'><i class='fa fa-exclamation-triangle' aria-hidden='true'></i> Please Select A valid Image File<br />Only pdf, jpeg, jpg and png Images type allowed</div>");
			$(this).val('');
			return false;			
		}else{
			$(".filetype_Error").html("");
			return true;
		}
});	

$('.btn-default').on('click', function(){
	$('input[type="text"]').on('change', function(e){
		var specials=/[*|\":<>[\]{}`\\()';@&$,_#]/;
		var that = this;
		var string = $(this).val();
		var pattern = new RegExp(specials);
		var res = pattern.test(string);
		if(res == null){
			alert('Special Characters Are Not Allowed');
			$(that).val('');
		}
		if(res == true){
			alert('Special Characters Are Not Allowed');
			$(that).val('');
			setTimeout(function(){$(that).focus();}, 1);	
		}		
	});
});	
	
});

$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});

$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
	  $( ".submit1" ).submit(function(e){ 
		$("#loader").show();
		$('.overlay-div').css('height',$(document).height()).show();
		$(this).hide();
	  });
});

//removes 'disable' attr from 'edit' button
function enableField(id){
	$('.'+id+'').removeAttr('disabled');
}
/********************* END *********************************/
</script>
<script type="text/javascript">
$("#submit_change_phone").hide();
function chechMobileNo(phone) { 
	if(phone.length == 10) {
	$.ajax({ 
		type: 'GET',
		url: '../ajax/check_mobile_no.php', 
		data: { phone: phone },
		beforeSend:function(){
			$("#mobile_no_checker").html("<i class='fa-li fa fa-spinner fa-spin'></i>");
		},
		success:function(res){ 	//alert(data);
			if(res == 1){
				$("#mobile_no_checker").html("<i style='color:green' class='fa fa-check' aria-hidden='true'></i>");
				$("#mobile_no_Exists").html("");	
				$("#submit_change_phone").show();
				
			}else{
				$("#mobile_no_checker").html("<i style='color:red' class='fa fa-times' aria-hidden='true'></i>");			
				$("#mobile_no_Exists").html("<font color='red'>This mobile number is already registered with us !!!</font>");			
				$("#phone").val('');
			} 
		},
		error:function(){}
	}); //End of AJAX call
	}else{
		$("#mobile_no_checker").html("<i style='color:red' class='fa fa-times' aria-hidden='true'></i>");			
		$("#mobile_no_Exists").html("<font color='red'>Please enter 10 digits mobile number.</font>");			
		$("#phone").val('');
	}
	
}
function view_notifications() { 
	var user_id=<?php echo $sid; ?>;
	$.ajax({ 
		type: 'GET',
		url: '../ajax/user_notifications.php', 
		data: { user_id: user_id },
		beforeSend:function(){
			$("#notifications-menu").html('<br/><p style="text-align:center"><i class="fa fa-spinner fa-spin fa-3x" aria-hidden="true"></i></p>&nbsp;&nbsp;<h4 style="text-align:center">Please wait....</h4>');
		},
		success:function(res){ 	//alert(data);
			$("#notifications-menu").html(res);
		},
		error:function(){}
	}); //End of AJAX call
}
$(document).ready(function() {   
     
    $('.fa-trash-o').on('click', function(e){
        console.log($(this).parents('li').remove());
    });
    $('.table_tr').click(function(){
        window.location = $(this).attr('href');
        return false;
    });
	
	
	
	$("#mobile_number_form").hide();
	$(".change_mobile_number").on("change", function(){
		var passval = $(this).val();
		if(passval=="Y"){
			$("#mobile_number_form").show();
		}else{
			$("#mobile_number_form").hide();
		}
	});
	
	
});

<?php 
if(isset($_SESSION["alert_modal"]) && $_SESSION["alert_modal"]==1)  $alert_modal=2; else $alert_modal=0;
/* 
if(basename($_SERVER['PHP_SELF'])=="index.php" && $alert_modal==0){ 
	$select_query=$mysqli->query("select file from digital_locker where user_id='$sid' ORDER BY id DESC") or die("Error : ".$mysqli->error);
	$sl=1;
	while($results=$select_query->fetch_assoc()){
		if(!file_exists($_SERVER['DOCUMENT_ROOT']."/Document_locker/".$results["file"])){  
			$_SESSION["alert_modal"]=$alert_modal=1;			
			//echo $results["file"];
		}
	} 
} */
?>
$('#updateDocumentAlert').modal({
	<?php 
	if(isset($alert_modal) && $alert_modal==1){ ?>
		show: true,
	<?php }else{ ?>
		show: false,			
	<?php } ?>
	backdrop: false,
	keyboard: false
}); 
	

</script>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/conf/close_connect.php"; ?>