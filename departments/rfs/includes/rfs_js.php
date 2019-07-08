
<script>

        $("#pan_no").on('blur',function(){
        var Obj = $('#pan_no').val();  
        if (Obj != "") {
            ObjVal = Obj;
            var panPat = /^([a-zA-Z]{5})(\d{4})([a-zA-Z]{1})$/;
            var code = /([C,P,H,F,A,T,B,L,J,G])/;
            var code_chk = ObjVal.substring(3,4);
            if (ObjVal.search(panPat) == -1) {
                alert("Invalid Pan No");
				$('#pan_no').val("");
                $("#pan_no").focus();
                return false;
            }
           
        }
		});

        var index,index2,index3;
        $(document).ready(function(){
			$('#modal1').on('click', function(){
		if($(this).val() != 2){
			$('#formupload_file').val($(this).attr('id'));						
			$('#file_from_pc').modal({
				show: true,			
				backdrop: true,
				keyboard: true
			});
		}else if($(this).val() == 1){
			$('#Elocker_file').val($(this).attr('id'));
			$('#filefromLocker').modal({
				show: true,			
				backdrop: true,
				keyboard: true
			});
		}
	});
			
			$("#firm_name").keyup(function(){
				var firm_name=$("#firm_name").val();
				var flag=0;
				var data='firm_name='+firm_name;
				$.ajax({
					type : "POST",
					url : "check_firm_name.php",
					data : data,
					beforeSend : function(){
						$(".firm_alert").html("<img src='css/loading.gif'/>");
					},
					success : function(result){
						if(result>0){
							$(".firm_alert").html('<b><font color="red">Sorry your requested Firm Name allready exist Choose another one</font></b>');
							flag=1;
						}else{
							$(".firm_alert").html('<b><font color="green">Ok You can Take this Firm Name</font></b>');
						}
						
					}
				});
				if(flag>0){
					alert("you have to choose another society name");
					return false;
				}
			});
			
            index=2;
            index2=2;
            index3=2;
            $('#join_date1').datepicker({changeMonth: true,changeYear: true,dateFormat:'yy-mm-d'});
			$('#farm_es_date').datepicker({changeMonth: true,changeYear:true,dateFormat:'yy-mm-d'});
			$('.date_picker').datepicker({changeMonth: true,changeYear:true,dateFormat:'yy-mm-d'});
        });
		
		//tab management.//
		function showMe(thisobj,id){
			$(".jstab").hide();
			$("#"+id).show();
			$(".jstabbtn").removeClass("active");
			$(thisobj).addClass("active");
		}
        function changedVal(){
            $("#firmname2").val($("#firmname").val());
        }
       
        var popup2;
        function chooseFile(divID) { 
            popup2 = window.open("fileFromPC.php?id="+divID, "Popup2", "width=500,height=300");
            popup2.moveTo(400, 200);
            popup2.focus();
            return false;
        }
        function chooseFile1(divID) { 
            popup2 = window.open("filefrompc.php?id="+divID, "Popup2", "width=500,height=300");
            popup2.moveTo(400, 200);
            popup2.focus();
            return false;
        }
		//chose sign functin //
		var popup50;
		/*function chooseSign(val,divID){

			popup50 = window.open("fileFromPC.php?id="+divID+"&sign=Y&pdf=n", "Popup50", "width=500,height=300");
			popup50.moveTo(400, 200);
			popup50.focus();
			return false;
		}*/

        function chooseSign(divID,pdf,type,sl){
           if(pdf=='pdf_y')
            	{pdf='y';}
            else
                {pdf='n';}

			if(type=='static')
			{
			popup50 = window.open("filefrompc.php?id="+divID+"&sign=Y&pdf="+pdf+"&sl="+sl, "Popup50", "width=500,height=300");
		     }
		     else
		     {
            popup50 = window.open("filefrompc.php?id="+divID+"&sign=Y&pdf="+pdf+"&type="+type+"&sl="+sl,  "Popup50", "width=500,height=300");
			}
			popup50.moveTo(400, 200);
			popup50.focus();
			return false;
		}

	  function chooseSign_pdf(val,divID){

			popup50 = window.open("fileFromPC.php?id="+divID+"&sign=Y&pdf=y", "Popup50", "width=500,height=300");
			popup50.moveTo(400, 200);
			popup50.focus();
			return false;
		}
		
		var popup1, popup2;
        var textc="";
		var mydata="";
      function chooseFile_doc(val, divID) { 
            if(val==1) {
                popup1 = window.open("fileFromElocker.php?id="+divID, "Popup1", "width=500,height=200");
                popup1.moveTo(400, 200);
                popup1.focus();		
                return false;
            }
            if(val==2) {
                popup2 = window.open("fileFromPC.php?sign=U&id="+divID, "Popup2", "width=500,height=200");
                popup2.moveTo(400, 200);
                popup2.focus();
                return false;
            }
        }

	 function removeRow(value){
			value = value + 1;
			 $('tr[id="'+value+'"]').remove();
		 }
	 function show_sales(id,flag) {
		 	
           if(flag=='Y'){
    	    for(var i=1;i<4;i++){
            $('#sales_tax'+i).show();
             }
         document.getElementById('c_no'+id).required = true;
         document.getElementById('c_by'+id).required = true;
         document.getElementById('c_date'+id).required = true;
        }else{
    	 document.getElementById('c_no'+id).required = false;
         document.getElementById('c_by'+id).required = false;
         document.getElementById('c_date'+id).required = false;
       for(var i=1;i<4;i++){
         document.getElementById('sales_tax'+i).style.display='none';
                           }
        }
    }
   function show_sales1(id,flag) {
    if(flag=='Y'){//false
        document.getElementById('c_no'+id).required = true;
        document.getElementById('c_by'+id).required = true;
        document.getElementById('c_date'+id).required = true;
    }
   else{
        document.getElementById('c_no'+id).required = false;
        document.getElementById('c_by'+id).required = false;
        document.getElementById('c_date'+id).required = false;
       }
        document.getElementById('sales_tax'+id).style.display='none';
      }    
    $(document).ready(function(){
			    var idd="Y";
			    var iddd="N";
				var serialNo;
				var moreindex = parseInt($("#indexval").val()); 	
			 if($('#field7 tbody tr:last-of-type').length>2){
				$('a[jsTag="deleteLast"]').show();  
			 }
			 else{ $('a[jsTag="deleteLast"]').hide(); }
			 
	    //CODE FOR ADD MORE OPERATION ON JAVASCRIPT..
			 $('a[jsTag="more"]').on('click', function(){   
				if(moreindex > 19){
					alert('Maximum Limit is 20');
				}else{
				serialNo = moreindex+1;
				
				
               
               var pdf_y='pdf_y';
               var pdf_n='pdf_n';
               var type1='p1';
               var type2='p2';
               var type3='p3';
               var type4='p4';			
				$('#parnerlast').before('<tr id="'+serialNo+'"><td width="5%">'+serialNo+'</td><td class="quarter-width"><input type="hidden" name="partner['+moreindex+'][pid]"><input type="text" required="" class="form-control text-uppercase" pattern="[a-zA-Z_/.\s]+$" value="" name="partner['+moreindex+'][pname]"></td><td  class="quarter-width"><textarea required="" class="form-control text-uppercase" value="" name="partner['+moreindex+'][paddr]" rows="3" cols="15"></textarea></td><td  class="quarter-width"><input type="text" required="" value="" name="partner['+moreindex+'][pdoj]" class="form-control date_picker text-uppercase" /></td><td class="quarter-width"><table><tr><td style="width: 40px;">Photo</td><td style="width: 100px;"><span><div class="cropme" style="width: 70px; height: 30px;" id="sp'+serialNo+'" ><input type="button" onclick="crop_test(\'p'+serialNo+'\')" name="upload3"  class="btn btn-primary"  value="upload2"  /></div><div class="cropme" style="display: none; width: 40px; height: 0px; " id="ep'+serialNo+'" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i><span onclick="crop_test(\'p'+serialNo+'\')">Edit</span></div><span id="vp'+serialNo+'" style="float: left;"></span><input type="hidden" value="" id="fp'+serialNo+'" name="partner['+moreindex+'][photo]" /></span></td></tr><tr><td>Sign</td><td style="width: 100px;"><span id="photo51"><div class="cropme" style="width: 70px; height: 30px;" id="ss'+serialNo+'" ><input type="button" onclick="crop_test(\'s'+serialNo+'\')"  name="upload1" class="btn btn-primary"  value="upload2"  /></div><span id="vs'+serialNo+'"></span><span class="cropme" style="display: none; width: 40px; height: 0px; " id="es'+serialNo+'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> <span onclick="crop_test(\'s'+serialNo+'\')">Edit</span></span><input type="hidden" value="" id="fs'+serialNo+'" name="partner['+moreindex+'][sign]" /></span></td></tr><tr><td>PAN</td><td style="width: 100px;"><div class="cropme" style="width: 70px; height: 30px;" id="sn'+serialNo+'" ><input type="button" onclick="crop_test(\'n'+serialNo+'\')"  name="upload1"  class="btn btn-primary"  value="upload2"  /></div><span id="vn'+serialNo+'"></span><span class="cropme" style="display: none; width: 40px; height: 0px; " id="en'+serialNo+'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i><span onclick="crop_test(\'n'+serialNo+'\')">Edit</span><input type="hidden" value="" id="fn'+serialNo+'" name="partner['+moreindex+'][pan]" /></span></td></tr></table></td></tr>');
               

				$('.date_picker').datepicker({changeMonth: true,changeYear:true,dateFormat:'yy-mm-d'});
				
				 $('#del_last').show();
				 $("input#indexval_validation").val(serialNo);
				//$('input:hidden[id="indexval"]').attr("value", $('.innerTbl tbody tr').length);
				if(moreindex>1)
				$('a[jsTag="deleteLast"]').show();
						
				moreindex++;
				}
			 });					
		    $('a[jsTag="deleteLast"]').on('click', function(){
				 
				var tr_no = parseInt($("#indexval").val());
				var serialNo = parseInt($("#indexval_validation").val());
			    //var serialNo=tr_no+1;
				var row=2;
                			
			    if(row<serialNo)
			    { 	
			     $('tr[id="'+serialNo+'"]').remove();
				 moreindex=moreindex-1;
				 serialNo=serialNo-1;
				 $("input#indexval_validation").val(serialNo);
				 
				 if(row==serialNo)
				 { $('#del_last').hide();}
			     //$("input#indexval_validation").val(serialNo);
             
				}
				else
				{   $('#del_last').hide();
					alert('There are no row to be deleted!!');}
			 });
		
			$('input[name="isCertificate"]').on('change', function(){
				if(this.value == 'Y'){
					
					$('#certificate').css('display','inline');
					
					$('#affidavit').css('display','none');
					$('input[name="affidavit"]').removeAttr("required");
					$('input[name="certificate_no"]').attr("required", "required");
					$('input[name="issued_by"]').attr("required", "required");	
					$('input[name="issue_date"]').attr("required", "required");						
				}else{
					
					$('#certificate').css('display','none');
					$('#affidavit').css('display','inline');
					$('input[name="affidavit"]').attr("required", "required");
					$('input[name="certificate_no"]').removeAttr("required");
					$('input[name="issued_by"]').removeAttr("required");
					$('input[name="issue_date"]').removeAttr("required");
				}
			});
			
			/* operation to hide show fields if 'own land is selected in tab 2'*/
			$('select[name="p_land_type"]').on('change', function(){
				if($('select[name="p_land_type"] option:selected').attr('value') == 'L' || $('select[name="p_land_type"] option:selected').attr('value') == 'R'){
					
					$('.visibleOnOwn').css('display', 'none');
					$('#p_circle, #p_patta_no, #p_dag_no, #p_mouza').removeAttr('required');
					
					$("input#p_mouza,input#p_circle,input#p_patta_no,input#p_dag_no").val("");
					
				}else{
					$('.visibleOnOwn').css('display', 'table-row');
					$('#p_circle, #p_patta_no, #p_dag_no, #p_mouza').attr('required', 'required');
					
				}
			});


			$('select[name="o_land_type"]').on('change', function(){
				if($('select[name="o_land_type"] option:selected').attr('value') == 'L' || $('select[name="o_land_type"] option:selected').attr('value') == 'R'){
					$('.visibleOnOwn2').css('display', 'none');
					$('#o_circle, #o_patta_no, #o_dag_no, #o_mouza').removeAttr('required');
					$("input#o_mouza,input#o_circle,input#o_patta_no,input#o_dag_no").val("");
					$("#E2").prop( "checked", false );
				}else{
					$('.visibleOnOwn2').css('display', 'table-row');
					$('#o_circle, #o_patta_no, #o_dag_no, #o_mouza').attr('required', 'required');
					$("#F2").prop( "checked", false );
				}
			});
		
			/* opearation to hide field 6 i.e. address field if 'No' is selected */
			$('.is_different').on('click', function(){
				if($(this).val() == 'N'){
					
					$( '#o_mouza, #o_circle, #o_patta_no, #o_dag_no, #o_area_no, #o_vill_t_c_name, #o_po, #o_ps, #o_pin_code').removeAttr('required');
					
					$('.visibleOnTrue').css('display', 'none');
					
					$("#ck1").hide();
                    $("#ck2").hide();
				}else{
					$('.visibleOnTrue').css('display', 'table-row');
					$( '#o_mouza, #o_circle, #o_patta_no, #o_dag_no, #o_area_no, #o_vill_t_c_name, #o_po, #o_ps, #o_pin_code').attr('required','required');
					//$('[name=o_land_type]').val( 'o' ).selected;
					$("#ck1").show();
                    $("#ck2").show();
				}
			});
		});

	
      $(document).ready(function(){
              $("#firm_duration1").on("change",function(){
        	  var selvalue=$(this).val();
              if(selvalue=='L')
            {
              $("#L1").fadeIn("slow");
              $( '#firm_date_expiry').attr('required','required');
			  }
         else
         	{ 
            $("#L1").fadeOut("slow");
            $( '#firm_date_expiry').removeAttr('required');
             }

         });

      });
    //FUNCTION FOR UPLOAD CROP IMAGE
    function crop_test(k)
	{$('.cropme').simpleCropper('',k);}
	//FUNCTION FOR VALIDATION FOR CROP IMAGE
	$("#myform3").submit(function(){
		var no_row=$("#indexval_validation").val();
        for(var i=1;i<=no_row;i++){
		if($('#fp'+i).val().length == 0){
			alert( i+"-No Partner's Photograph missing !!");
			$('#fp'+i).focus();
			return false;
		}
		if($('#fs'+i).val().length == 0){
			alert( i+"-No Partner's Sign Photograph missing !!");
			$('#fs'+i).focus();
			return false;
		}
		if($('#fn'+i).val().length == 0){
			alert( i+"-No Partner's PAN Photograph missing !!");
			$('#fn'+i).focus();
			return false;
		}
        
		
    }  
	});
	$("#myform5").submit(function(){
		if($('#mfile10').val().length == 0){
			alert( "Please upload Filled in Form No. I !!");
			return false;
		}
		if($('#mfile2').val().length == 0){
			alert( "Please upload Cerified copy of Registered Deed of Partnership !!");
			return false;
		}
		if($('#mfile3').val().length == 0){
			alert( "Please upload Land Document !!");
			return false;
		}
		if($('#mfile4').val().length == 0){
			alert( "Please upload select Line No 13.2 !!");
			return false;
		}
		if($('#mfile5').val().length == 0){
			alert( "Please upload select Line No 14.1 !!");
			return false;
		}
		if($('#mfile6').val().length == 0){
			alert( "Please upload select Line No 14.2 !!");
			return false;
		}
		if($('#mfile7').val().length == 0){
			alert( "Please upload select Line No 15 !!");
			return false;
		}
		if($('#mfile8').val().length == 0){
			alert( "Please upload select Line No 16 !!");
			return false;
		}
		if($('#mfile9').val().length == 0){
			alert( "Please select Line No 17 !!");
			return false;
		}
		return confirm('Do you want to save..?');
        
	});
	
$(document).ready(function(){

		var moreindexq = parseInt($("#indexval_validation1").val());	
           
         if(moreindexq > 1){
					$('#del_last1').show();
				}

			 
			 $('a[jsTag="more1"]').on('click', function(){   
				if(moreindexq > 19){
					alert('Maximum Limit is 20');
				}else{
				serialNo = moreindexq+1;
			
				

				$('#sunil').before('<tr id="'+serialNo+'"><td width="5%">'+serialNo+'</td><td><input type="text" class="form-control text-uppercase" name="partner['+serialNo+'][pname]" pattern="[a-zA-Z_/.\\s]+$" required/></td><td><span><div class="cropme" style="width: 70px; height: 30px;" id="sp'+serialNo+'" ><input type="button" onclick="crop_test(\'p'+serialNo+'\')" name="upload3"  class="btn btn-primary" value="Upload"   /></div> <span id="vp1" style="float: left;" ></span><input type="hidden"  id="fp'+serialNo+'" name="partner['+serialNo+'][photo]" /></span><div class="cropme" style="display: none; width: 40px; height: 0px; " id="ep'+serialNo+'" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i><span onclick="crop_test(\'p'+serialNo+'\')">Edit</span></div><span id="vp'+serialNo+'" style="float: left;"></span></td><td ><input type="text" class="form-control text-uppercase" name="partner['+serialNo+'][paddr]" required/></td><td ><input type="text" class="form-control text-uppercase" name="partner['+serialNo+'][poccupation]" pattern="[a-zA-Z_/.\s]+$" required/></td><td ><input type="text" class="form-control text-uppercase" name="partner['+serialNo+'][pdesig]" pattern="[a-zA-Z_/.\s]+$" id=""required /></td></tr></table></td></tr>');
               

				moreindexq++;
				 $('#del_last1').show();
				
				 $("input#indexval_validation1").val(serialNo);

				}
			 });
			  $('a[jsTag="deleteLast1"]').on('click', function(){
				 
				var tr_no = parseInt($("#indexval_validation1").val());
				
			    if(tr_no>1)
			    { 
                   
				$('tr[id="'+tr_no+'"]').remove();
				  tr_no=tr_no-1;
                  $("input#indexval_validation1").val(tr_no);
				 moreindexq=moreindexq-1;
				 serialNo=serialNo-1;
				 
				 if(tr_no<2)
				 {$('#del_last').hide();
                   
			     }
			     $("input#indexval_validation1").val(serialNo);
             
				}
				else
				{   $('#del_last1').hide();
					alert('There are no row to be deleted!!');}
			 });
			  });


 //FUNCTION FOR UPLOAD CROP IMAGE
    function crop_test(k)
	{$('.cropme').simpleCropper('',k);}

	//FUNCTION FOR VALIDATION FOR CROP IMAGE
	$("#myform21").submit(function(){
		var j = parseInt($("#indexval_validation1").val());

		for(var i=1;i<=j;i++){
			
		if($('#fp'+i).val().length == 0){
			alert("Partner "+i+" Signature missing !!");
			
			return false;
		}      
      }
	});
	$("#myform22").submit(function(){
			
		if($('#fp21').val().length == 0){
			alert("President photo missing !!");
			
			return false;
		} 
		if($('#fp22').val().length == 0){
			alert("Secretary photo missimg !!");
			
			return false;
		} if($('#fp23').val().length == 0){
			alert("Ist Executive Signature missing!!");
			
			return false;
		} if($('#fp24').val().length == 0){
			alert("2nd Executive Signature missing!!");
			
			return false;
		} if($('#fp25').val().length == 0){
			alert("3rd Executive Signature missing !!");
			
			return false;
		}      
      
	});
	$('.date_picker').datepicker({changeMonth: true,changeYear:true,dateFormat:'yy-mm-d'});
</script>
<script>
	  $(document).ready(function(){

		var moreindexqq = parseInt($("#indexval").val());	
           
         if(moreindexqq > 1){
					$('#del').show();
				}

			 
			 $('a[jsTag="more1"]').on('click', function(){   
				if(moreindexqq > 19){
					alert('Maximum Limit is 20');
				}else{
				serialNo = moreindexqq+1;
			
				

				$('#sunil1').before('<tr id="'+serialNo+'"><td width="5%">'+serialNo+'</td><td><input type="text" class="form-control text-uppercase" style="width:170px;" name="partner['+serialNo+'][pname]" pattern="[a-zA-Z_/.\\s]+$" required/></td><td><span><div class="cropme" style="width: 70px; height: 30px;" id="sp'+serialNo+'" ><input type="button" onclick="crop_test(\'p'+serialNo+'\')" name="upload3"  class="btn btn-primary" value="Upload"   /></div> <span id="vp1" style="float: left;" ></span><input type="hidden"  id="fp'+serialNo+'" name="partner['+serialNo+'][photo]" /></span><div class="cropme" style="display: none; width: 40px; height: 0px; " id="ep'+serialNo+'" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i><span onclick="crop_test(\'p'+serialNo+'\')">Edit</span></div><span id="vp'+serialNo+'" style="float: left;"></span></td></tr>');
               

				moreindexqq++;
				 $('#del').show();
				
				 $("input#indexval").val(serialNo);

				}
			 });
			  $('a[jsTag="last"]').on('click', function(){
				 
				var tr_no = parseInt($("#indexval").val());
				
			    if(tr_no>1)
			    { 
                   
				$('tr[id="'+tr_no+'"]').remove();
				  tr_no=tr_no-1;
                  $("input#indexval").val(tr_no);
				 moreindexqq=moreindexqq-1;
				 serialNo=serialNo-1;
				 
				 if(tr_no<2)
				 {$('#del').hide();
                   
			     }
			     $("input#indexval").val(serialNo);
             
				}
					
				
			 });
			  });
	  </script>
	  <script>
	  $(document).ready(function(){

		var moreindexval = parseInt($("#index").val());	
           
         if(moreindexval > 1){
					$('#delete').show();
				}

			 
			 $('a[jsTag="addmore"]').on('click', function(){ 
                          			 
				if(moreindexval > 19){
					alert('Maximum Limit is 20');
				}else{
				serialNo = moreindexval+1;
			
				

				$('#ravi1').before('<tr id="a'+serialNo+'"><td>'+serialNo+'</td><td><input type="text" class="form-control text-uppercase"  name="partner_address['+serialNo+'][former_name]" pattern="[a-zA-Z_/.\\s]+$" required/></td><td><input type="text" class="form-control text-uppercase" name="partner_address['+serialNo+'][present_name]" pattern="[a-zA-Z_/.\\s]+$" required/></td><td><input type="text" class="form-control text-uppercase"  name="partner_address['+serialNo+'][remark]" pattern="[a-zA-Z_/.\\s]+$" required/></td></tr>');
               

				moreindexval++;
				 $('#delete').show();
				
				 $("input#index").val(serialNo);

				}
			 });
			  $('a[jsTag="deletelast"]').on('click', function(){ 
				 
				var tr_no = parseInt($("#index").val());
				
			    if(tr_no>1)
			    { 
                	$('tr[id="a'+tr_no+'"]').remove();
				
				  tr_no=tr_no-1;
                  $("input#index").val(tr_no);
				 moreindexval=moreindexval-1;
				 serialNo=serialNo-1;
				 
				 if(tr_no<2)
				 {$('#delete').hide();
                   
			     }
			     $("input#index").val(serialNo);
             
				}
					
				
			 });
			  });
	  </script>	 
<script>
	  $(document).ready(function(){

		var moreindexval = parseInt($("#index").val());	
           
         if(moreindexval > 1){
					$('#DEL').show();
				}

			 
			 $('a[jsTag="ADD"]').on('click', function(){ 
                          			 
				if(moreindexval > 19){
					alert('Maximum Limit is 20');
				}else{
				serialNo = moreindexval+1;
			
				

				$('#sumit').before('<tr id="b'+serialNo+'"><td>'+serialNo+'</td><td><input type="text" class="form-control text-uppercase"  name="partner_address['+serialNo+'][name]" pattern="[a-zA-Z_/.\\s]+$" required/></td><td><input type="text" class="form-control text-uppercase" name="partner_address['+serialNo+'][address]" pattern="[a-zA-Z_/.\\s]+$" required/></td><td><input type="text" class="form-control text-uppercase" name="partner_address['+serialNo+'][present_name]" pattern="[a-zA-Z_/.\\s]+$" required/></td><td><input type="text" class="form-control text-uppercase" name="partner_address['+serialNo+'][present_address]" pattern="[a-zA-Z_/.\\s]+$" required/></td><td><input type="text" class="form-control text-uppercase"  name="partner_address['+serialNo+'][remark]" pattern="[a-zA-Z_/.\\s]+$" required/></td></tr>');
               

				moreindexval++;
				 $('#DEL').show();
				
				 $("input#index").val(serialNo);

				}
			 });
			  $('a[jsTag="DELETE"]').on('click', function(){ 
				 
				var tr_no = parseInt($("#index").val());
				
			    if(tr_no>1)
			    { 
                	$('tr[id="b'+tr_no+'"]').remove();
				
				  tr_no=tr_no-1;
                  $("input#index").val(tr_no);
				 moreindexval=moreindexval-1;
				 serialNo=serialNo-1;
				 
				 if(tr_no<2)
				 {$('#DEL').hide();
                   
			     }
			     $("input#index").val(serialNo);
             
				}
					
				
			 });
			  });
	  </script>	  	  