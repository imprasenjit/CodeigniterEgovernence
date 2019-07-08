<br/><br/><br/><br/><br/><br/>
<div class="container">
	<div class="row">
            <div class="col-md-12"><br>
                <div class="page-header">
  <h3>Search Available Land for Industry <small>,Assam</small></h3>
  <h4>To apply for Land Allotment in various Industrial Estates <a href="<?=base_url();?>/departments/requires/terms.php?form=10&dept=dic">CLICK HERE</a></h4>
</div>
<form class="form-inline" id="landSearch">
    <div class="form-group col-md-3">
        <h4>Select District</h4>
     <select class="form-control" name="district_id">
         <option value="">Select District</option>
         <option value="">Select All</option>
<?php 
$this->load->helper("address");
$query=get_district_by_state(4);
foreach($query as $row)
{
     echo '<option value="'.$row->dist_id.'">'.$row->dist_name.'</option>';
}
?>
</select>

  </div>
    <div class="form-group col-md-2">
        <h4>Select Agency</h4>
     <select class="form-control" name="Agency">
         
         <option value="">Select Agency</option>
         <option value="">Select All</option>
<?php 
$query=$this->landbank_model->getAllAgency();
foreach($query as $row)
{
     echo '<option value="'.$row['Agency'].'">'.$row['Agency'].'</option>';
}
?>
</select>
  
  </div>
      <div class="form-group col-md-1">
      </div>
    <div class="form-group col-md-3">
        <h4>Land requirement in sqft</h4>
      <input type="text" class="form-control" id="input3" placeholder="Sq Ft Require for business" name="sqft">
      
      
    </div>
    <div class="form-group col-md-2">
        <h4> &nbsp;</h4>
    <a class="btn btn-primary pull-right " id="search"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;&nbsp;<span id="search_text">Search</span></a>
    </div>
</form>
                 
                <div class="clearfix"></div>
                   <hr />  
                <br>

                <table id="example" class="display compact" style="display:none" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th >District</th>
                <th >Name of The infrastructure</th>
				<th>Type / Nature of Industries that can be set up in the Industrial Infrastructure</th>
                <th >Allotable Land Area (Sq Ft)</th>
                <th >Allotable Shed Area (Sq Ft)</th>
                <th >Agency</th>
				<th >Map</th>
                <th>Land</th>
                <th>Shed</th>
            </tr>
        </thead>
     
    </table>
            </div>
	</div>
</div>
<script>
    function json2array(json){
    var result = [];
    var keys = Object.keys(json);
    keys.forEach(function(key){
        result.push(json[key]);
    });
    return result;
}
    $(document).ready(function() {
        var dataSet;
        $('#search').click(function(){
            $('#search_text').empty();
            $('#search_text').append("Searching....");
             $("#example").hide();
            $("#example").dataTable().fnDestroy();
            var dataArray=$('#landSearch').serialize();
            $.ajax({
            method: "POST",
            data: dataArray,
            url: "<?php echo base_url();?>site/landbank/search/",
            dataType: "json"
                }).done(function(jsn){
            $('#search_text').empty();
            $('#search_text').append("Search");
                    console.log(json2array(jsn.data));
                    dataSet=json2array(jsn.data);
                           $('#example').fadeIn('slow');
             $('#example').DataTable( {
        data: dataSet,
        "columnDefs": [
    { "width": "5%", "targets": 0 }  ,    
    { "width": "35%", "targets": 1 },  
    { "width": "35%", "targets": 1 },
    { "width": "10%", "targets": 2 },
    { "width": "10%", "targets": 3 },
    { "width": "5%", "targets": 4 },
    { "width": "15%", "targets": 5 },
	{ "width": "5%", "targets": 6 },
	{ "width": "5%", "targets": 7 }
  ],
        "columns": [
            { "data": "district" },
            { "data": "Name_of_the_infrastructure_with_location" },
            { "data": "industry_type" },
            { "data": "Allotable_Land_Area" },
            { "data": "Allotable_shed_area" },
            { "data": "Agency" },
            { "data": "Link" },
			{ "data": "Link2" },
			{ "data": "Link3" }
        ]
    } );
                });
                

        
        });
        

});
    </script>